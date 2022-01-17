<?php
defined('BASEPATH') or exit('No direct script access allowed');

class konten extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!Auth::has_access(User_Role::admin)) redirect('login/admin');
		$this->load->model('M_Setting');
		$this->load->library('MyFiles');
	}

	public function index()
	{
		$m_setting = new M_Setting();

		if ($this->input->post()) {
			foreach ($_POST as $key => $val) {
				$m_setting->update(['value' => $val], ['key' => $key]);
			}
			setresponse(200, []);
		}

		$setting = (array)$m_setting->get('*');

		## map data
		$mapSetting = [];
		foreach ($setting as $set) {
			$mapSetting[$set->key] = $set->value;
		}

		$imgJson = json_decode($mapSetting['images'], true);
		if (!$imgJson) $imgJson = [];

		## display view
		$this->load->view('layout', [
			'main' => $this->load->view(
				'admin/konten/v_konten',
				[
					'header_with_bg' => true,
					'setting' => $mapSetting,
					'images' => $imgJson
				],
				true
			),
			'scripts' => $this->load->view('admin/konten/v_konten_scripts', [], true)
		]);
	}

	public function update_image()
	{
		$type = filter_xss($_POST['type']);
		$m_setting = new M_Setting();
		$data = json_decode($m_setting->getByKey('images'), true);

		if ($type === 'delete') {
			$enc = json_decode(base64_decode($_POST['enc']), true);
			$deleteId = $enc['id'];

			$newData = [];
			foreach ($data as $row) {
				if ((int)$row['id'] === $deleteId) continue;
				$newData[] = $row;
			}

			$res = $m_setting->setByKey('images', json_encode($newData));
			if (!$res)  setresponse(400, ['msg' => 'Gagal']);
			setresponse(200, ['msg' => 'Berhasil']);
		} elseif ($type === 'add') {
			try {
				$fileName = MyFiles::upload('file', time() . '_konten', MyFiles::$konten, 'jpg|jpeg|png', 1000);
			} catch (\Throwable $th) {
				setresponse(400, ['msg' => $th->getMessage()]);
			}

			$data[] = [
				'id' => time(),
				'file_name' => $fileName
			];
			$res = $m_setting->setByKey('images', json_encode($data));
			if (!$res)  setresponse(400, ['msg' => 'Gagal']);
			setresponse(200, ['msg' => 'Berhasil']);
		}
	}
}
