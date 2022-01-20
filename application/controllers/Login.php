<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
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
				'main' => $this->load->view('v_login', [], true),
				'use_footer' => false,
				'scripts' => $this->load->view('v_login_scripts', [], true)
			]);

			return;
		}

		## validation rule
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

		## validation error
		if (!$this->form_validation->run()) setresponse(400, [
			'validation' => $this->form_validation->error_array()
		]);

		$u = filter_xss($this->input->post('username'));
		$p = Auth::enc(filter_xss($this->input->post('password')));

		$m_user = new M_User();
		$user = $m_user->getOne('*', ['username' => $u]);

		## user not found
		if (!$user) setresponse(400, [
			'msg' => 'User tidak ada !'
		]);

		$user = new User_DTO($user);

		## wrong password
		if ($user->password !== $p) setresponse(400, [
			'msg' => 'Password salah !'
		]);

		## not verified
		if (!$user->is_verified) setresponse(400, [
			'msg' => 'Akun belum diverifikasi !'
		]);

		$waktu = time() + 25200;
		$expired = 30000;

		## set session
		$this->session->set_userdata([
			'user_id' => $user->id,
			'name' => $user->name,
			'username' => $user->username,
			'role' => User_Role::user,
			'timeout' => $waktu + $expired
		]);

		setresponse(200, ['msg' => 'Berhasil login']);
	}

	function admin()
	{
		## return view when post empty
		if (!$this->input->post()) {
			$this->load->view('layout', [
				'use_nav' => false,
				'main' => $this->load->view('v_login', [], true),
				'use_footer' => false,
				'scripts' => $this->load->view('v_login_scripts', [
					'is_admin' => true
				], true)
			]);

			return;
		}


		## validation rule
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

		## validation error
		if (!$this->form_validation->run()) setresponse(400, [
			'validation' => $this->form_validation->error_array()
		]);

		$u = filter_xss($this->input->post('username'));
		$p = Auth::enc(filter_xss($this->input->post('password')));

		$waktu = time() + 25200;
		$expired = 30000;

		## set session
		$this->session->set_userdata([
			'role' => User_Role::admin,
			'timeout' => $waktu + $expired
		]);

		setresponse(200, ['msg' => 'Berhasil login']);
	}
}
