<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_User');
		$this->load->model('M_Penyitaan');
		$this->load->model('M_Penggeledahan');
		$this->load->model('M_Perpanjangan');
	}

	public function index()
	{
		$m_user = new M_User();
		$m_penyitaan = new M_Penyitaan();
		$m_penggeledahan = new M_Penggeledahan();
		$m_perpanjangan = new M_Perpanjangan();
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/v_welcome',
				[
					'header_with_bg' => true,
					'unverified' => $m_user->get_count_verified(false),
					'verified' => $m_user->get_count_verified(true),

					'unread_penyitaan' => $m_penyitaan->get_count_read(false),
					'unread_penggeledahan' => $m_penggeledahan->get_count_read(false),
					'unread_perpanjangan' => $m_perpanjangan->get_count_read(false),
				],
				true
			)
		]);
	}
}
