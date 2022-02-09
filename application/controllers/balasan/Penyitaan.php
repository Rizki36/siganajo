<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyitaan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('M_Penyitaan');
	}

	public function index()
	{
		$this->load->view('layout', [
			'main' => $this->load->view(
				'balasan/penyitaan/v_penyitaan',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('balasan/penyitaan/v_penyitaan_scripts', [], true)
		]);
	}


	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'penyitaan';

		## where -> has effect with total row
		$configData['where'] = [];

		$configData['where'][] = ['user_id' => $_SESSION['user_id']];

		## join
		// $configData['join'] = [
		// 	[
		// 		'table' => 'customer_person cp',
		// 		'on' => "cp.person_code = mp.person_code AND cp.customer_code = '$person_code'",
		// 		'param' => 'left'
		// 	]
		// ];


		## custom filter -> has effect with total filtered row 
		$configData['filters'] = [];

		if ($_POST['status'] === 'read') $configData['filters'][] = ['is_dibaca' => 1];
		if ($_POST['status'] === 'unread') $configData['filters'][] = ['is_dibaca' => 0];
		if ($_POST['status'] === 'rejected') $configData['filters'][] = "alasan_ditolak IS NOT NULL";


		## group by
		// $configData['group_by'] = 'awb_no';

		## order by 
		// $configData['use_custom_order'] = true;
		// $configData['custom_column_name_order'] = 'awb_no';
		// $configData['custom_column_sort_order'] = 'DESC';

		## select -> fill with all column you need

		$configData['selected_column'][] = 'penyitaan.*';

		## display column -> Represent column in view
		// set false if column not in db table (column number, action, etc)
		$num_start_row = $configData['start'];
		$configData['display_column'] = [
			// false,
			'created_at',
			'nama_penyidik',
			'nip_nrp',
			'nomor_telepon_wa',
			'email',
			'polres_polsek_pengaju',
			'jenis_permohonan',
			'nama_pihak'
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$penyitaan = new Penyitaan_DTO($record);
			$temp = (array)$record;
			$temp['no'] = ++$num_start_row;
			$temp['created_at'] = $penyitaan->created_at_text;
			$temp['penyidik'] = '<div><b>Data Penyidik</b></div>';
			$temp['penyidik'] .= "<div>Nama : $penyitaan->nama_penyidik</div>";
			$temp['penyidik'] .= "<div>NIP/NRP : $penyitaan->nip_nrp</div>";
			$temp['penyidik'] .= "<div>No WA : $penyitaan->nomor_telepon_wa</div>";
			$temp['penyidik'] .= "<div>Email : $penyitaan->email</div>";
			$temp['penyidik'] .= "<br>";

			$temp['penyidik'] .= '<div><b>Data Berkas</b></div>';
			$files = "";
			if (is_array($penyitaan->files_json)) {
				foreach ($penyitaan->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$penyitaan . '/' . $val) . ">" . M_Penyitaan::get_label($key) . "</a></div>";
				}
			}
			$temp['penyidik'] .= $files;

			$temp['pihak'] = '<div><b>Data Pihak</b></div>';
			$temp['pihak'] .= "<div>Nama : $penyitaan->nama_pihak</div>";

			$temp['aksi'] = '';

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}
}
