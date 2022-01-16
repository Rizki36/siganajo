<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penyitaan extends CI_Controller
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
				'admin/penyitaan/v_penyitaan',
				[
					'header_with_bg' => true
				],
				true
			),
			'scripts' => $this->load->view('admin/penyitaan/v_penyitaan_scripts', [], true)
		]);
	}

	public function get_datatable()
	{
		$this->load->library('MyFiles');
		$this->load->model('M_Datatables');
		$this->load->model('M_Penyitaan');
		$configData = $this->input->post();

		## table
		$configData['table'] = 'penyitaan';

		## where -> has effect with total row
		$configData['where'] = [];


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
		];

		## get data
		$data = $this->M_Datatables->get_data_assoc($configData);

		$records = $data['records'];

		$data['data'] = [];
		foreach ($records as $record) {
			$penyelidik = new Penyitaan_DTO($record);
			$temp = (array)$record;
			$temp['no'] = ++$num_start_row;
			$temp['created_at'] = $penyelidik->created_at;
			$temp['penyidik'] = '';
			$temp['penyidik'] .= "<div>Nama : $penyelidik->nama_penyidik</div>";
			$temp['penyidik'] .= "<div>NIP/NRP : $penyelidik->nip_nrp</div>";
			$temp['penyidik'] .= "<div>No WA : $penyelidik->nomor_telepon_wa</div>";
			$temp['penyidik'] .= "<div>Email : $penyelidik->email</div>";

			$files = "";
			if (is_array($penyelidik->files_json)) {
				foreach ($penyelidik->files_json as $key => $val) {
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$penyitaan . '/' . $val) . ">" . M_Penyitaan::get_name_file($key) . "</a></div>";
				}
			}

			$temp['aksi'] = '';
			$temp['aksi'] .= $files;
			$temp['aksi'] .= "<button class='btn btn-sm btn-primary'>Cetak File</button>";

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}
}
