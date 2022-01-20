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
					$files .= "<div><a target='_blank' href=" . base_url(MyFiles::$penyitaan . '/' . $val) . ">" . M_Penyitaan::get_label($key) . "</a></div>";
				}
			}

			$temp['aksi'] = '';
			$temp['aksi'] .= $files;
			$temp['aksi'] .= "<a href='" . base_url('admin/penyitaan/print/' . $penyelidik->id_penyitaan)  . "' class='btn btn-sm btn-primary'>Cetak File</a>";

			$data['data'][] = $temp;
		}

		unset($data['records']);
		echo json_encode($data);
	}

	public function print($id)
	{
		$id = filter_xss(base64_decode($id));
		$this->load->model('M_Penyitaan');
		$m_penyitaan = new M_Penyitaan();

		$data = $m_penyitaan->getOne('*', ['id_penyitaan' => $id]);
		if (!$data) exit('Data tidak ada !');
		$data = new Penyitaan_DTO($data);

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [210, 297],
		]);

		$pageNumber = 1;
		foreach ($data->files_json as $key => $value) {
			## check if exist file
			if ($value == '') continue;
			$path = APPPATH . '../assets/data/penyitaan/' . $value;
			if (!file_exists($path)) continue;
			try {
				$mpdf->SetSourceFile($path);
				$tplIdx = $mpdf->importPage($pageNumber);
				$mpdf->useTemplate($tplIdx, 0, 0, 210, 297, true);
				$mpdf->AddPage();
			} catch (\Throwable $th) {
			}
		}

		$mpdf->Output('out', 'I');
	}
}
