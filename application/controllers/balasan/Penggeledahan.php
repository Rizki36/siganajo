<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penggeledahan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::user)) redirect('login');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('M_Penggeledahan');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'balasan/penggeledahan/v_penggeledahan',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('balasan/penggeledahan/v_penggeledahan_scripts', [], true)
		]);
	}


	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'penggeledahan';

		## where -> has effect with total row
		$configData['where'] = [];

		$configData['where'][] = ['user_id' => $_SESSION['user_id']];

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

		if ($_POST['status_user'] === 'read') $configData['filters'][] = ['is_dibaca_user' => 1];
		if ($_POST['status_user'] === 'unread') $configData['filters'][] = ['is_dibaca_user' => 0];


		## group by
		// $configData['group_by'] = 'awb_no';

		## order by 
		// $configData['use_custom_order'] = true;
		// $configData['custom_column_name_order'] = 'awb_no';
		// $configData['custom_column_sort_order'] = 'DESC';

		## select -> fill with all column you need

		$configData['selected_column'][] = 'penggeledahan.*';

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
			'nama_pihak'
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$penggeledahan = new Penggeledahan_DTO($record);
			$temp = (array)$record;
			$temp['no'] = ++$num_start_row;
			$temp['created_at'] = $penggeledahan->created_at_text;
			$temp['penyidik'] = '<div><b>Data Penyidik</b></div>';
			$temp['penyidik'] .= "<div>Nama : $penggeledahan->nama_penyidik</div>";
			$temp['penyidik'] .= "<div>NIP/NRP : $penggeledahan->nip_nrp</div>";
			$temp['penyidik'] .= "<div>No WA : $penggeledahan->nomor_telepon_wa</div>";
			$temp['penyidik'] .= "<div>Email : $penggeledahan->email</div>";
			$temp['penyidik'] .= "<br>";

			$temp['penyidik'] .= '<div><b>Data Berkas</b></div>';
			$files = "";
			if (is_array($penggeledahan->files_json)) {
				foreach ($penggeledahan->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$penggeledahan . '/' . $val) . ">" . M_Penggeledahan::get_label($key) . "</a></div>";
				}
			}
			$temp['penyidik'] .= $files;

			$temp['pihak'] = '<div><b>Data Pihak</b></div>';
			$temp['pihak'] .= "<div>Nama : $penggeledahan->nama_pihak</div>";

			$temp['aksi'] = '';

			if ($penggeledahan->is_dibaca) {
				if ($penggeledahan->alasan_ditolak != '') {
					$temp['aksi'] .= "<button onclick='detail_tolak($penggeledahan->id_penggeledahan)' class='btn btn-block btn-sm btn-primary'>Detail Tolak</button>";
				}

				if ($penggeledahan->upload != '') {
					$temp['aksi'] .= "<a style='text-decoration: none;' href='" . base_url(MyFiles::$penggeledahan . '/' . $penggeledahan->upload) . "' class='btn btn-block btn-sm btn-primary'>Detail Upload</a>";
				}

				if ($penggeledahan->is_dibaca_user) {
					$temp['aksi'] .= "<button onclick='mark_read($penggeledahan->id_penggeledahan,0)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Belum Dibaca</button>";
				} else {
					$temp['aksi'] .= "<button onclick='mark_read($penggeledahan->id_penggeledahan,1)' class='btn btn-block btn-sm btn-primary'>Tandai <br> Sudah Dibaca</button>";
				}
			} else {
			}

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}

	public function detail_tolak()
	{
		$id = filter_xss($_POST['id']);

		$m_penggeledahan = new M_Penggeledahan();
		$data = $m_penggeledahan->getOne('*', [
			'id_penggeledahan' => $id
		]);

		if (!$data) setresponse(404, [
			'msg' => 'Data tidak ada'
		]);

		setresponse(200, [
			'msg' => 'Aksi berhasil',
			'data' => $data
		]);
	}

	public function mark_read()
	{
		$m_penggeledahan = new M_Penggeledahan();
		$id = filter_xss($_POST['id']);
		$is_read = (int)filter_xss($_POST['is_read']);

		$res = $m_penggeledahan->update([
			'is_dibaca_user' => $is_read
		], [
			'id_penggeledahan' => $id,
			'user_id' => $_SESSION['user_id']
		]);

		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}
}
