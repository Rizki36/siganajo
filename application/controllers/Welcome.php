<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::user)) redirect('login');
		$this->load->model('M_Setting');
	}

	public function index()
	{
		$m_setting = new M_Setting();

		$this->load->view('layout', [
			'main' => $this->load->view(
				'v_welcome',
				[
					'redaksi' => [
						'utama' => $m_setting->getByKey('redaksi_utama'),
						'penyitaan' => $m_setting->getByKey('redaksi_penyitaan'),
						'penggeledahan' => $m_setting->getByKey('redaksi_penggeledahan'),
						'perpanjangan_penahanan' => $m_setting->getByKey('redaksi_perpanjangan_penahanan'),
					],
					'link_form' => [
						'penyitaan' => $m_setting->getByKey('link_penyitaan'),
						'penggeledahan' => $m_setting->getByKey('link_penggeledahan'),
						'perpanjangan_penahanan' => $m_setting->getByKey('link_perpanjangan_penahanan'),
					],
					'sosmed' => [
						'instagram' => $m_setting->getByKey('sosmed_instagram'),
						'whatsapp' => $m_setting->getByKey('sosmed_whatsapp'),
						'facebook' => $m_setting->getByKey('sosmed_facebook'),
						'twitter' => $m_setting->getByKey('sosmed_twitter'),
					],
					'quotes' => $m_setting->getByKey('quotes'),
					'link_tutorial_yt' => $m_setting->getByKey('quotes'),
					'marquee' => $m_setting->getByKey('marquee'),
					'images' => json_decode($m_setting->getByKey('images'), true) ?? []
				],
				true
			)
		]);
	}
}
