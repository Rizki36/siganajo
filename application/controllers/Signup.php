<?php
defined('BASEPATH') or exit('No direct script access allowed');

class signup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_User');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	function index()
	{
		## return view when post empty
		if (!$this->input->post()) {
			$this->load->view('layout', [
				'use_nav' => false,
				'main' => $this->load->view('v_signup', [], true),
				'use_footer' => false,
				'scripts' => $this->load->view('v_signup_scripts', [], true)
			]);

			return;
		}

		## validation rule
		$this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('origin_unit', 'Unit Asal', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Kofirmasi Password', 'required|matches[password]');

		## validatoon error
		if (!$this->form_validation->run()) {
			setresponse(400, [
				'validation' => $this->form_validation->error_array()
			]);
		}

		$this->load->library('MyFiles');
		## upload file
		$libFiles = new MyFiles();
		try {
			$filename = $libFiles->upload('file', 'file_user_' . $_POST['username'] . '_' . time(), MyFiles::$user_path);
		} catch (\Throwable $th) {
			setresponse(400, ['msg' => $th->getMessage()]);
		}

		$data = [
			'name' => filter_xss($_POST['name']),
			'username' => filter_xss($_POST['username']),
			'password' => Auth::enc(filter_xss($_POST['password'])),
			'origin_unit' => filter_xss($_POST['origin_unit']),
			'file' => $filename
		];

		$m_user = new M_User();
		$user = $m_user->insert($data);

		if (!$user) setresponse(404, [
			'msg' => 'Gagal membuat akun !'
		]);

		$this->load->library('MyEmail');;
		MyEmail::send(EMAIL_SENDER, 'User Register', $this->load->view('emails/v_register', [
			'name' => $data['name'],
			'origin_unit' => $data['origin_unit'],
			'link' => base_url('admin/users?s=unverified')
		], true));

		setresponse(200, [
			'msg' => 'Akun berhasil dibuat. Hubungi admin untuk konfirmasi akun.'
		]);
	}
}
