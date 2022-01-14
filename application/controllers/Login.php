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

		if ($this->form_validation->run() == TRUE) {
			$u = filter_xss($this->input->post('username'));
			$p = Auth::enc(filter_xss($this->input->post('password')));

			$m_user = new M_User();
			$user = $m_user->getOne('*', ['username' => $u, 'password' => $p]);

			if ($user) {
				$row = $user;
				$waktu = time() + 25200;
				$expired = 30000;
				$row['timeout']  = ($waktu + $expired);

				$this->session->set_userdata($row);
				redirect('welcome');
			} else {
				## user not found
				setresponse(404, [
					'msg' => 'User tidak ada !'
				]);
			}
		} else {
			## validatoon error
			setresponse(400, [
				'validation' => $this->form_validation->error_array()
			]);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		if (@$_SESSION['role'] === 'admin') return redirect('login/admin');
		if (@$_SESSION['role'] === 'branch') return redirect('login/branch');
		if (@$_SESSION['role'] === 'supplier') return redirect('login/supplier');
		if (@$_SESSION['role'] === 'reseller') return redirect('login');
		redirect('login');
	}
}
