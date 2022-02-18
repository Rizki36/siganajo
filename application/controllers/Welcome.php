<?php
defined('BASEPATH') or exit('No direct script access allowed');

class welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::user)) redirect('login');
		$this->load->model('M_Setting');
		$this->load->model('M_Penyitaan');
		$this->load->model('M_Penggeledahan');
	}

	public function index()
	{
		$m_setting = new M_Setting();
		$m_penyitaan = new M_Penyitaan();
		$m_penggeledahan = new M_Penggeledahan();

		$id = @$_SESSION['user_id'];

		$penyitaan_unread = $m_penyitaan->count_unread($id);
		$penyitaan_accepted = $m_penyitaan->count_accepted($id);
		$penyitaan_rejected = $m_penyitaan->count_rejected($id);

		$penggeledahan_unread = $m_penggeledahan->count_unread($id);
		$penggeledahan_accepted = $m_penggeledahan->count_accepted($id);
		$penggeledahan_rejected = $m_penggeledahan->count_rejected($id);

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
					'balasan' => [
						'penyitaan' => [
							'unread' => $penyitaan_unread,
							'accepted' => $penyitaan_accepted,
							'rejected' => $penyitaan_rejected,
						],
						'penggeledahan' => [
							'unread' => $penggeledahan_unread,
							'accepted' => $penggeledahan_accepted,
							'rejected' => $penggeledahan_rejected,
						],
					],
					'jumlah_balasan' => ($penyitaan_accepted + $penyitaan_rejected) + ($penggeledahan_accepted + $penggeledahan_rejected),
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
