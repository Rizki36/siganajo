<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/v_welcome',
				[
					'header_with_bg' => true
				],
				true
			)
		]);
	}
}
