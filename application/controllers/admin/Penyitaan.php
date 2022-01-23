<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyitaan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_Penyitaan');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/penyitaan/v_penyitaan',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('admin/penyitaan/v_penyitaan_scripts', [], true)
		]);
	}

	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'penyitaan';

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

		$configData['selected_column'][] = 'penyitaan.*';

		## display column -> Represent column in view
		// set false if column not in db table (column number, action, etc)
		$num_start_row = $configData['start'];
		$configData['display_column'] = [
			// false,
			'created_at',
			'nama_penyidik',
			'nip_nrp',
			'nomor_telepon_wa',
			'email',
			'polres_polsek_pengaju',
			'jenis_permohonan',
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$penyitaan = new Penyitaan_DTO($record);
			$temp = (array)$record;
			$temp['no'] = ++$num_start_row;
			$temp['created_at'] = $penyitaan->created_at;
			$temp['penyidik'] = '';
			$temp['penyidik'] .= "<div>Nama : $penyitaan->nama_penyidik</div>";
			$temp['penyidik'] .= "<div>NIP/NRP : $penyitaan->nip_nrp</div>";
			$temp['penyidik'] .= "<div>No WA : $penyitaan->nomor_telepon_wa</div>";
			$temp['penyidik'] .= "<div>Email : $penyitaan->email</div>";

			$files = "";
			if (is_array($penyitaan->files_json)) {
				foreach ($penyitaan->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$penyitaan . '/' . $val) . ">" . M_Penyitaan::get_label($key) . "</a></div>";
				}
			}
			$temp['penyidik'] .= $files;

			$temp['aksi'] = '';
			$temp['aksi'] .= "<a style='text-decoration: none;' href='" . base_url('admin/penyitaan/print/' . base64_encode($penyitaan->id_penyitaan))  . "' class='btn btn-block btn-sm btn-primary'>Cetak File</a>";

			if ($penyitaan->is_dibaca) {
				$temp['aksi'] .= "<button onclick='mark_read($penyitaan->id_penyitaan,0)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Belum Dibaca</button>";
			} else {
				$temp['aksi'] .= "<button onclick='mark_read($penyitaan->id_penyitaan,1)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Sudah Dibaca</button>";
			}

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}

	public function print($id)
	{
		$id = filter_xss(base64_decode($id));
		$this->load->model('M_Penyitaan');
		$m_penyitaan = new M_Penyitaan();

		$data = $m_penyitaan->getOne('*', ['id_penyitaan' => $id]);
		if (!$data) exit('Data tidak ada !');
		$data = new Penyitaan_DTO($data);

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [210, 297],
		]);

		foreach ($data->files_json as $key => $value) {
			## check if exist file
			if ($value == '') continue;
			$path = APPPATH . '../assets/data/penyitaan/' . $value;
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
		$m_penyitaan = new M_Penyitaan();
		$id = filter_xss($_POST['id']);
		$res = $m_penyitaan->update(['is_dibaca' => 1], ['id_penyitaan' => $id]);
		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}
}
