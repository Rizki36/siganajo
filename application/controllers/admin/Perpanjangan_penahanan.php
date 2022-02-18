<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perpanjangan_penahanan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_Perpanjangan');
		$this->load->library('form_validation');
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
		if ($_POST['status'] === 'read') $configData['filters'][] = ['is_dibaca' => 1];
		if ($_POST['status'] === 'unread') $configData['filters'][] = ['is_dibaca' => 0];
		if ($_POST['status'] === 'uploaded') $configData['filters'][] = "upload IS NOT NULL";
		if ($_POST['status'] === 'accepted') $configData['filters'][] = "upload IS NOT NULL";
		if ($_POST['status'] === 'rejected') $configData['filters'][] = "alasan_ditolak IS NOT NULL";

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
			$temp['penyidik'] .= '<br>';


			$files = "";
			if (is_array($perpanjangan->files_json)) {
				foreach ($perpanjangan->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$perpanjangan . '/' . $val) . ">" . M_Perpanjangan::get_label($key) . "</a></div>";
				}
			}
			$temp['penyidik'] .= '<div><b>Data Berkas</b></div>';
			$temp['penyidik'] .= $files;

			$temp['pihak'] = '<div><b>Data Pihak</b></div>';
			$temp['pihak'] .= "<div>Nama Pihak : $perpanjangan->nama_pihak</div>";
			$temp['pihak'] .= "<div>Tempat Lahir : $perpanjangan->tempat_lahir</div>";
			$temp['pihak'] .= "<div>Tanggal Lahir : $perpanjangan->tanggal_lahir_text</div>";
			$temp['pihak'] .= "<div>Jenis Kelamin : $perpanjangan->jenis_kelamin</div>";
			$temp['pihak'] .= "<div>Tempat Tinggal : $perpanjangan->tempat_tinggal</div>";
			$temp['pihak'] .= "<div>Pekerjaan : $perpanjangan->pekerjaan</div>";
			$temp['pihak'] .= "<div>Agama : $perpanjangan->agama</div>";
			$temp['pihak'] .= "<div>Kebangsaan : $perpanjangan->kebangsaan</div>";

			$temp['aksi'] = '';
			$temp['aksi'] .= "<a style='text-decoration: none;' href='" . base_url('admin/perpanjangan-penahanan/print/' . base64_encode($perpanjangan->id_perpanjangan))  . "' class='btn btn-block btn-sm btn-primary'>Cetak File</a>";

			if ($perpanjangan->is_dibaca) {
				if ($perpanjangan->alasan_ditolak != '') {
					$temp['aksi'] .= "<button onclick='detail_tolak($perpanjangan->id_perpanjangan)' class='btn btn-block btn-sm btn-primary'>Detail Tolak</button>";
					$temp['aksi'] .= "<button onclick='reset($perpanjangan->id_perpanjangan)' class='btn btn-block btn-sm btn-primary'>Batalkan Tolak</button>";
				}

				if ($perpanjangan->upload != '') {
					$temp['aksi'] .= "<a style='text-decoration: none;' href='" . base_url(MyFiles::$perpanjangan . '/' . $perpanjangan->upload) . "' class='btn btn-block btn-sm btn-primary'>Detail Upload</a>";
					$temp['aksi'] .= "<button onclick='reset($perpanjangan->id_perpanjangan)' class='btn btn-block btn-sm btn-primary'>Batalkan Upload</button>";
				}
			} else {
				$temp['aksi'] .= "<button onclick='tolak($perpanjangan->id_perpanjangan)' class='btn btn-block btn-sm btn-primary'>Tolak</button>";
				$temp['aksi'] .= "<button onclick='upload($perpanjangan->id_perpanjangan)' class='btn btn-block btn-sm btn-primary'>Upload</button>";
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

	public function tolak()
	{
		$id = filter_xss($_POST['id']);
		$nomor_surat_tolak = protect_input_xss(escape($_POST['nomor_surat_tolak']));
		$alasan_ditolak = $_POST['alasan_ditolak'];

		## validation rule
		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('nomor_surat_tolak', 'Nomor Surat', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('alasan_ditolak', 'Alasan Ditolak', 'trim|required|min_length[1]');

		## validation error
		if (!$this->form_validation->run()) {
			$errors = '';
			foreach ($this->form_validation->error_array() as $key => $value) {
				$errors .= $value . '<br>';
			}
			setresponse(400, [
				'msg' => $errors
			]);
		}

		$m_perpanjangan = new M_Perpanjangan();
		$is_updated = $m_perpanjangan->update([
			'nomor_surat_tolak' => $nomor_surat_tolak,
			'alasan_ditolak' => $alasan_ditolak,
			'is_dibaca' => 1
		], [
			'id_perpanjangan' => $id
		]);

		if (!$is_updated) setresponse(400, [
			'msg' => 'Aksi gagal'
		]);

		$data = $m_perpanjangan->getOne('*', ['id_perpanjangan' => $id]);
		$perpanjangan = new Perpanjangan_DTO($data);

		$this->load->library('MyEmail');
		$body = $this->load->view('emails/balasan/v_perpanjangan_ditolak', [
			'title' => 'Pengajuan Perpanjangan Penahanan Ditolak',
			'text' => 'Pastikan login terlebih dahulu',
			'nomor_surat_tolak' => $nomor_surat_tolak,
			'alasan_ditolak' => $alasan_ditolak,
			'link_detail' => base_url('balasan/perpanjangan-penahanan?s=rejected'),
		], true);
		MyEmail::send($perpanjangan->email, 'Perpanjangan Penahanan Ditolak', $body);

		setresponse(200, [
			'msg' => 'Aksi berhasil'
		]);
	}

	public function detail_tolak()
	{
		$id = filter_xss($_POST['id']);

		$m_perpanjangan = new M_Perpanjangan();
		$data = $m_perpanjangan->getOne('*', [
			'id_perpanjangan' => $id
		]);

		if (!$data) setresponse(404, [
			'msg' => 'Data tidak ada'
		]);

		setresponse(200, [
			'msg' => 'Aksi berhasil',
			'data' => $data
		]);
	}

	public function upload()
	{
		$id = filter_xss($_POST['id']);

		if ($_FILES['upload']['name'] == '') {
			setresponse(400, [
				'msg' => 'File belum diisi'
			]);
		}

		## validation rule
		$this->form_validation->set_rules('id', 'ID', 'trim|required');

		## validation error
		if (!$this->form_validation->run()) {
			$errors = '';
			foreach ($this->form_validation->error_array() as $key => $value) {
				$errors .= $value . '<br>';
			}
			setresponse(400, [
				'msg' => $errors
			]);
		}

		$time = time();
		$filename = MyFiles::upload('upload', $time .  '_' . 'upload', MyFiles::$perpanjangan);

		$m_perpanjangan = new M_Perpanjangan();
		$is_updated = $m_perpanjangan->update([
			'upload' => $filename,
			'is_dibaca' => 1
		], [
			'id_perpanjangan' => $id
		]);

		if (!$is_updated) setresponse(400, [
			'msg' => 'Aksi gagal'
		]);

		$data = $m_perpanjangan->getOne('*', ['id_perpanjangan' => $id]);
		$perpanjangan = new Perpanjangan_DTO($data);

		$this->load->library('MyEmail');
		$body = $this->load->view('emails/balasan/v_perpanjangan_diterima', [
			'title' => 'Pengajuan Perpanjangan Penahanan Diterima',
			'text' => 'Pastikan login terlebih dahulu',
			'link_download' => base_url(MyFiles::$perpanjangan . '/' . $filename),
			'link_detail' => base_url('balasan/perpanjangan-penahanan?s=accepted'),
		], true);
		MyEmail::send($perpanjangan->email, 'Perpanjangan Penahanan Diterima', $body);

		setresponse(200, [
			'msg' => 'Aksi berhasil'
		]);
	}

	public function reset()
	{
		$id = filter_xss($_POST['id']);
		$m_perpanjangan = new M_Perpanjangan();

		$is_updated = $m_perpanjangan->update([
			'nomor_surat_tolak' => null,
			'alasan_ditolak' => null,
			'upload' => null,
			'is_dibaca' => 0
		], [
			'id_perpanjangan' => $id
		]);

		if (!$is_updated) setresponse(400, [
			'msg' => 'Aksi gagal'
		]);

		setresponse(200, [
			'msg' => 'Aksi berhasil'
		]);
	}
}
