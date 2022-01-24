<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perpanjangan_penahanan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_Perpanjangan');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/perpanjangan/v_perpanjangan',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('admin/perpanjangan/v_perpanjangan_scripts', [], true)
		]);
	}

	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'perpanjangan';

		## where -> has effect with total row
		$configData['where'] = [];

		if ($_POST['status'] === 'read') $configData['where'][] = ['is_dibaca' => 1];
		if ($_POST['status'] === 'unread') $configData['where'][] = ['is_dibaca' => 0];
		## join
		// $configData['join'] = [
		// 	[
		// 		'table' => 'customer_person cp',
		// 		'on' => "cp.person_code = mp.person_code AND cp.customer_code = '$person_code'",
		// 		'param' => 'left'
		// 	]
		// ];


		## custom filter -> has effect with total filtered row 
		$configData['filters'] = [];

		## group by
		// $configData['group_by'] = 'awb_no';

		## order by 
		// $configData['use_custom_order'] = true;
		// $configData['custom_column_name_order'] = 'awb_no';
		// $configData['custom_column_sort_order'] = 'DESC';

		## select -> fill with all column you need

		$configData['selected_column'][] = 'perpanjangan.*';


		## search column
		$num_start_row = $configData['start'];
		$configData['display_column'] = [
			'tgl_surat',
			'nomor_surat',
			'alasan_perpanjangan',
			'nama_penyidik',
			'nip_nrp',
			'nomor_telepon_wa',
			'email',
			'polres_polsek_pengaju',
			'tanggal_ba',
			'nama_pihak',
			'tempat_lahir',
			'tanggal_lahir',
			'jenis_kelamin',
			'tempat_tinggal',
			'pekerjaan',
			'agama',
			'kebangsaan',
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$perpanjangan = new Perpanjangan_DTO($record);
			$temp = (array)$record;
			$temp['no'] = ++$num_start_row;
			$temp['created_at'] = date('d-m-Y', strtotime($perpanjangan->created_at_text));
			$temp['penyidik'] = '<div><b>Data Penyidik</b></div>';
			$temp['penyidik'] .= "<div>Nama : $perpanjangan->nama_penyidik</div>";
			$temp['penyidik'] .= "<div>NIP/NRP : $perpanjangan->nip_nrp</div>";
			$temp['penyidik'] .= "<div>No WA : $perpanjangan->nomor_telepon_wa</div>";
			$temp['penyidik'] .= "<div>Email : $perpanjangan->email</div>";
			$temp['penyidik'] .= "<div>Alasan Perpanjangan : <br> $perpanjangan->alasan_perpanjangan</div> <br>";

			$temp['pihak'] = '';
			$temp['pihak'] .= "<div>Nama Pihak : $perpanjangan->nama_pihak</div>";
			$temp['pihak'] .= "<div>Tempat Lahir : $perpanjangan->tempat_lahir</div>";
			$temp['pihak'] .= "<div>Tanggal Lahir : $perpanjangan->tanggal_lahir_text</div>";
			$temp['pihak'] .= "<div>Jenis Kelamin : $perpanjangan->jenis_kelamin</div>";
			$temp['pihak'] .= "<div>Tempat Tinggal : $perpanjangan->tempat_tinggal</div>";
			$temp['pihak'] .= "<div>Pekerjaan : $perpanjangan->pekerjaan</div>";
			$temp['pihak'] .= "<div>Agama : $perpanjangan->agama</div>";
			$temp['pihak'] .= "<div>Kebangsaan : $perpanjangan->kebangsaan</div>";

			$files = "";
			if (is_array($perpanjangan->files_json)) {
				foreach ($perpanjangan->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$perpanjangan . '/' . $val) . ">" . M_Perpanjangan::get_label($key) . "</a></div>";
				}
			}
			$temp['penyidik'] .= '<div></div>';
			$temp['penyidik'] .= '<div>Berkas</div>';
			$temp['penyidik'] .= $files;

			$temp['aksi'] = '';
			$temp['aksi'] .= "<a style='text-decoration: none;' href='" . base_url('admin/perpanjangan-penahanan/print/' . base64_encode($perpanjangan->id_perpanjangan))  . "' class='btn btn-block btn-sm btn-primary'>Cetak File</a>";
			if ($perpanjangan->is_dibaca) {
				$temp['aksi'] .= "<button onclick='mark_read($perpanjangan->id_perpanjangan,0)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Belum Dibaca</button>";
			} else {
				$temp['aksi'] .= "<button onclick='mark_read($perpanjangan->id_perpanjangan,1)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Sudah Dibaca</button>";
			}

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}


	public function print($id)
	{
		$id = filter_xss(base64_decode($id));
		$is_all_file = (int)@$_GET['all'] === 1;

		$m_perpanjangan = new M_Perpanjangan();

		$data = $m_perpanjangan->getOne('*', ['id_perpanjangan' => $id]);
		if (!$data) exit('Data tidak ada !');
		$data = new Perpanjangan_DTO($data);

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [210, 297],
		]);

		foreach ($data->files_json as $key => $value) {
			## check if exist file
			if ($value == '') continue;
			if (!$is_all_file && $key === 'resume_singkat') continue;

			$path = APPPATH . '../assets/data/perpanjangan/' . $value;
			if (!file_exists($path)) continue;
			try {
				$pageCount = $mpdf->SetSourceFile($path);
				for ($i = 1; $i <= $pageCount; $i++) {
					$tplIdx = $mpdf->importPage($i, '/MediaBox');
					$mpdf->useTemplate($tplIdx, 0, 0, 210, 297, true);
					$mpdf->AddPage();
				}
			} catch (\Throwable $th) {
			}
		}

		$mpdf->Output('out', 'I');
	}

	public function mark_read()
	{
		$m_perpanjangan = new M_Perpanjangan();
		$id = filter_xss($_POST['id']);
		$is_read = (int)filter_xss($_POST['is_read']);
		$res = $m_perpanjangan->update(['is_dibaca' => $is_read], ['id_perpanjangan' => $id]);
		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}
}
