<?php
defined('BASEPATH') or exit('No direct script access allowed');

class users extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_User');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/users/v_users',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('admin/users/v_users_scripts', [], true)
		]);
	}

	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'user';

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

		## group by
		// $configData['group_by'] = 'awb_no';

		## order by 
		// $configData['use_custom_order'] = true;
		// $configData['custom_column_name_order'] = 'awb_no';
		// $configData['custom_column_sort_order'] = 'DESC';

		## select -> fill with all column you need

		$configData['selected_column'][] = 'user.*';

		## display column -> Represent column in view
		// set false if column not in db table (column number, action, etc)
		$num_start_row = $configData['start'];
		$configData['display_column'] = [
			// false,
			'name',
			'origin_unit',
			'password',
			'file',
			'is_verified',
			false
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$temp = (array)$record;
			$user = new User_DTO($record);
			$temp['no'] = ++$num_start_row;
			// $temp['password'] = ;
			$temp['file_link'] = 'Tidak ada berkas';
			if ($user->file != '') $temp['file_link'] = "<a href='" . base_url(MyFiles::$user_path . '/' . $user->file) . "'>Berkas</a>";
			$temp['data'] = '';
			$temp['data'] .= '<b>Nama : </b>';
			$temp['data'] .= $user->name . '<br>';
			$temp['data'] .= '<b>Username : </b>';
			$temp['data'] .= $user->username . '<br>';
			$temp['data'] .= '<b>Password : </b>';
			$temp['data'] .= Auth::dec($user->password) . '<br>';
			$temp['data'] .= '<b>Unit Asal : </b>';
			$temp['data'] .= $user->origin_unit . '<br>';

			if ($user->is_verified) $temp['is_verified'] = "<button onclick='verifikasi($user->id,0)' class='btn btn-sm btn-primary' style='text-decoration:none' title='Klik untuk membatalkan verifikasi'>Terverifikasi</button>";
			else $temp['is_verified'] = "<button onclick='verifikasi($user->id,1)' class='btn btn-sm btn-warning' style='text-decoration:none' title='Klik untuk memverifikasi'>Belum Diverifikasi</button>";
			$temp['aksi'] = '<button onclick="hapus(' . $user->id . ')" class="btn btn-sm btn-block btn-danger">Hapus</button>';
			$temp['aksi'] .= '<button onclick="ubah_password(' . $user->id . ')" class="btn btn-sm btn-block btn-warning">Ubah Password</button>';

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}

	public function verifikasi()
	{
		$id = $_POST['id'];
		$new_status = $_POST['new_status'];
		$m_user = new M_User();
		$res = $m_user->update(['is_verified' => (int)$new_status], ['id' => (int)$id]);
		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}

	public function delete()
	{
		$m_user = new M_User();
		$id = filter_xss($_POST['id']);
		$res = $m_user->delete(['id' => $id]);
		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}

	public function update_pass()
	{
		$m_user = new M_User();
		$id = filter_xss($_POST['id']);
		$pass = filter_xss($_POST['pass']);
		$res = $m_user->update(['password' => Auth::enc($pass)], ['id' => $id]);
		if (!$res) setresponse(400, []);
		setresponse(200, []);
	}
}
