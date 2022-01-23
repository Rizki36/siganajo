<?php
defined('BASEPATH') or exit('No direct script access allowed');

class logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->session->sess_destroy();
		if ($_SESSION['role'] === User_Role::admin)
			redirect('login/admin');

		redirect('login/admin');
	}
}
