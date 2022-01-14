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
		## retrurn view when post empty
		if (!$this->input->post())  $this->load->view('layout', [
			'use_nav' => false,
			'main' => $this->load->view('v_login', true),
			'use_footer' => false
		]);

		## validation rule
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$u = filter_xss($this->input->post('username'));
			$p = Auth::enc(filter_xss($this->input->post('password')));

			$m_user = new M_User();
			$user = $m_user->getOne('*', ['user_name' => $u, 'user_password' => $p]);

			if ($user) {
				$row = $user;
				$waktu = time() + 25200;
				$expired = 30000;
				$row['timeout']  = ($waktu + $expired);

				$this->session->set_userdata($row);
				redirect('welcome');
			} else {
				$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Data user tidak ditemukan', 'type' => 'warning']);
			}
		} else {
			$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Harap isi input dengan benar', 'type' => 'warning']);
		}
	}

	function admin()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$username = strip_tags(str_replace("'", "", escape($this->input->post('username'))));
				$password = strip_tags(str_replace("'", "", escape($this->input->post('password'))));
				$u = $username;
				$p = base64_encode($password);
				$cadmin = $this->admin->get_login_admin(['user_name' => $u, 'password' => $p, 'is_aktif' => 1]);

				if ($cadmin) {
					$row = $cadmin;
					$row['is_admin'] = true;
					$row['role'] = 'admin';
					$waktu = time() + 25200;
					$expired = 30000;
					$row['timeout']  = ($waktu + $expired);
					$this->session->set_userdata($row);
					redirect('admin/welcome');
				} else {
					$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Data user tidak ditemukan', 'type' => 'warning']);
				}
			} else {
				$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Harap isi input dengan benar', 'type' => 'warning']);
			}
		}

		$this->load->view('v_login_admin');
	}


	function branch()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$this->load->model('M_Branch', 'branch');

				$username = strip_tags(str_replace("'", "", escape($this->input->post('username'))));
				$password = strip_tags(str_replace("'", "", escape($this->input->post('password'))));
				$u = $username;
				$p = base64_encode($password);
				$cadmin = $this->branch->get_login_branch(['district_code' => $u, 'psw_vendor' => $p]);

				if ($cadmin) {
					$row = $cadmin;
					$row['role'] = 'branch';
					$row['is_admin'] = true;
					$waktu = time() + 25200;
					$expired = 30000;
					$row['timeout']  = ($waktu + $expired);
					$this->session->set_userdata($row);
					redirect('branch/welcome');
				} else {
					$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Data user tidak ditemukan', 'type' => 'warning']);
				}
			} else {
				$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Harap isi input dengan benar', 'type' => 'warning']);
			}
		}

		$this->load->view('v_login_branch');
	}

	function supplier()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$username = strip_tags(str_replace("'", "", escape($this->input->post('username'))));
				$password = strip_tags(str_replace("'", "", escape($this->input->post('password'))));
				$u = $username;
				$p = base64_encode($password);
				$cadmin = $this->login->get_login_person(['user_name' => $u, 'user_password' => $p, 'status_active' => 1, 'status' => 'SUPPLIER']);

				if ($cadmin) {
					$row = $cadmin;
					$row['role'] = 'supplier';
					$row['is_admin'] = false;
					$waktu = time() + 25200;
					$expired = 30000;
					$row['timeout']  = ($waktu + $expired);
					$this->session->set_userdata($row);
					redirect('supplier/welcome');
				} else {
					$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Data user tidak ditemukan', 'type' => 'warning']);
				}
			} else {
				$this->session->set_flashdata('msg', ['title' => 'Gagal Login !', 'text' => 'Harap isi input dengan benar', 'type' => 'warning']);
			}
		}

		$this->load->view('v_login_supplier');
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
