<?php
defined('BASEPATH') or exit('No direct script access allowed');

class penggeledahan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('M_Penggeledahan');
	}

	public function index()
	{
		$form1['nama_penyidik'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Nama Penyidik'];
		$form1['nip_nrp'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'NIP/NRP'];
		$form1['nomor_telepon_wa'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Nomor Telepon Wa'];
		$form1['email'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Email'];

		$optionsPolres = [
			['value' => '', 'label' => 'Pilih Polres Pengaju'],
			['value' => 'Polres Sat Reskrim', 'label' => 'Polres Sat Reskrim'],
			['value' => 'Polres Sat Narkoba', 'label' => 'Polres Sat Narkoba'],
			['value' => 'Polres Sat Lantas', 'label' => 'Polres Sat Lantas'],
			['value' => 'Polsek Jombang Kota', 'label' => 'Polsek Jombang Kota'],
			['value' => 'Polsek Ploso', 'label' => 'Polsek Ploso'],
			['value' => 'Polsek Tembelang', 'label' => 'Polsek Tembelang'],
			['value' => 'Polsek Plandaan', 'label' => 'Polsek Plandaan'],
			['value' => 'Polsek Mojoagung', 'label' => 'Polsek Mojoagung'],
			['value' => 'Polsek Kesamben', 'label' => 'Polsek Kesamben'],
			['value' => 'Polsek Ngoro', 'label' => 'Polsek Ngoro'],
			['value' => 'Polsek Ngusikan', 'label' => 'Polsek Ngusikan'],
			['value' => 'Polsek Sumobito', 'label' => 'Polsek Sumobito'],
			['value' => 'Polsek Bandar Kedung Mulyo', 'label' => 'Polsek Bandar Kedung Mulyo'],
			['value' => 'Polsek Peterongan', 'label' => 'Polsek Peterongan'],
			['value' => 'Polsek Kabuh', 'label' => 'Polsek Kabuh'],
			['value' => 'Polsek Kudu', 'label' => 'Polsek Kudu'],
			['value' => 'Polsek Bareng', 'label' => 'Polsek Bareng'],
			['value' => 'Polsek Diwek', 'label' => 'Polsek Diwek'],
			['value' => 'Polsek Jogoroto', 'label' => 'Polsek Jogoroto'],
			['value' => 'Polsek Megaluh', 'label' => 'Polsek Megaluh'],
			['value' => 'Polsek Gudo', 'label' => 'Polsek Gudo'],
			['value' => 'Posek Perak', 'label' => 'Posek Perak'],
			['value' => 'Mabes Polri/Polda/Kejaksaan/Penyidik PNS', 'label' => 'Mabes Polri/Polda/Kejaksaan/Penyidik PNS'],
			['value' => 'Lain-lain', 'label' => 'Lain-lain'],
		];

		$form1['polres_polsek_pengaju'] = ['class_container' => 'col-6', 'type' => 'select', 'options' => $optionsPolres, 'label' => 'Polres Polsek Pengaju'];

		$optionsJenis = [
			['value' => '', 'label' => 'Pilih Jenis Permohonan'],
			['value' => 'Izin Penggeledahan', 'label' => 'Izin Penggeledahan'],
			['value' => 'Persetujuan Penggeledahan', 'label' => 'Persetujuan Penggeledahan']
		];

		$form1['jenis_permohonan'] = [
			'class_container' => 'col-6', 'type' => 'select', 'options' => $optionsJenis, 'label' => 'Jenis Permohonan',
			'attr' => [
				'x-model' => 'jenis_permohonan'
			]
		];

		$steps['penyidik']['forms']['first']['input'] = $form1;
		$steps['penyidik']['forms']['first']['template_attr'] = ['x-if' => 'true'];
		$steps['penyidik']['validation_link'] = base_url('penggeledahan/validation_penyidik');
		$steps['penyidik']['name'] = 'Data Penyidik';

		$step2Form1['surat_permohonan_dari_penyidik'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => 'Surat Permohonan Dari Penyidik', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form1['surat_perintah_penggeledahan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => 'Surat Perintah Penggeledahan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form1['ba_penggeledahan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => 'BA Penggeledahan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form1['surat_pemberitahuan_dimulainya_penyidikan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => 'Surat Pemberitahuan Dimulainya Penyidikan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form1['resume_singkat'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => 'Resume Singkat', 'attr' => ['accept' => ".pdf",]];
		$step2Form1['jenis_permohonan_'] = ['class_container' => 'd-none', 'type' => 'hidden', 'label' => ''];

		$step2Form2['surat_permohonan_dari_penyidik'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Surat Permohonan Dari Penyidik', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['surat_perintah_penggeledahan'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Surat Perintah Penggeledahan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['laporan_polisi'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Laporan Polisi', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['surat_pemberitahuan_dimulainya_penyidikan'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Surat Pemberitahuan Dimulainya Penyidikan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['ba_penggeledahan'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'BA Penggeledahan', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['surat_tanda_terima_barang_bukti'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Surat Tanda Terima Barang Bukti', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['surat_perintah_penyidik'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Surat Perintah Penyidik', 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form2['resume_singkat'] = ['class_container' => 'col-12', 'class' => '', 'type' => 'file', 'label' => 'Resume Singkat', 'attr' => ['accept' => ".pdf"]];
		$step2Form2['jenis_permohonan_'] = ['class_container' => 'd-none', 'type' => 'hidden', 'label' => ''];

		$steps['berkas']['forms']['berkas1']['input'] = $step2Form1;
		$steps['berkas']['forms']['berkas1']['template_attr'] = ['x-if' => "jenis_permohonan === 'Izin Penggeledahan'"];
		$steps['berkas']['forms']['berkas2']['input'] = $step2Form2;
		$steps['berkas']['forms']['berkas2']['template_attr'] = ['x-if' => "jenis_permohonan === 'Persetujuan Penggeledahan'"];
		$steps['berkas']['validation_link'] = base_url('penggeledahan/validation_berkas');
		$steps['berkas']['name'] = 'Data Berkas';

		$this->load->view('layout', [
			'main' => $this->load->view(
				'v_form',
				[
					'header_with_bg' => true,
					'steps' => $steps,
					'data_alpine' => [
						'jenis_permohonan' => ''
					]
				],
				true
			),
			'scripts' => $this->load->view('v_form_scripts', [], true)
		]);
	}

	public function validation_penyidik()
	{
		## validation rule
		$this->form_validation->set_rules('nama_penyidik', 'Nama Penyidik', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nip_nrp', 'NIP/NRP', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nomor_telepon_wa', 'Nomor Telepon WA', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('polres_polsek_pengaju', 'Polres Polsek Pengaju', 'trim|required');
		$this->form_validation->set_rules('jenis_permohonan', 'Jenis Permohonan', 'trim|required');

		## validatoon error
		if (!$this->form_validation->run()) {
			setresponse(400, [
				'validation' => $this->form_validation->error_array()
			]);
		}
		setresponse(200, []);
	}

	public function validation_berkas()
	{
		## validation rule
		$this->form_validation->set_rules('nama_penyidik', 'Nama Penyidik', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nip_nrp', 'NIP/NRP', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nomor_telepon_wa', 'Nomor Telepon WA', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('polres_polsek_pengaju', 'Polres Polsek Pengaju', 'trim|required');
		$this->form_validation->set_rules('jenis_permohonan', 'Jenis Permohonan', 'trim|required');

		## validatoon error
		if (!$this->form_validation->run()) setresponse(400, [
			'validation' => $this->form_validation->error_array()
		]);

		## upload file
		if ($_POST['jenis_permohonan'] === 'Izin Penggeledahan') {
			$inpNames = [
				'surat_permohonan_dari_penyidik',
				'surat_perintah_penggeledahan',
				'ba_penggeledahan',
				'surat_pemberitahuan_dimulainya_penyidikan',
				'resume_singkat',
			];
		} else {
			$inpNames = [
				'surat_permohonan_dari_penyidik',
				'surat_perintah_penggeledahan',
				'laporan_polisi',
				'surat_pemberitahuan_dimulainya_penyidikan',
				'ba_penggeledahan',
				'surat_tanda_terima_barang_bukti',
				'surat_perintah_penyidik',
				'resume_singkat',
			];
		}

		$file_json = [];
		$time = time();
		foreach ($inpNames as $inpName) {
			try {
				$filename = MyFiles::upload($inpName, $time . '_' . @$_SESSION['username'] . '_' . $inpName, MyFiles::$penggeledahan);
				$file_json[$inpName] = $filename;
			} catch (\Throwable $th) {
				if ($inpName !== 'resume_singkat') setresponse(400, ['msg' => M_Penggeledahan::get_label($inpName) . ' : ' . $th->getMessage()]);
			}
		}

		$data = [
			'user_id' => @$_SESSION['user_id'],
			'nama_penyidik' => filter_xss($this->input->post('nama_penyidik')),
			'nip_nrp' => filter_xss($this->input->post('nip_nrp')),
			'nomor_telepon_wa' => filter_xss($this->input->post('nomor_telepon_wa')),
			'email' => filter_xss($this->input->post('email')),
			'polres_polsek_pengaju' => filter_xss($this->input->post('polres_polsek_pengaju')),
			'jenis_permohonan' => filter_xss($this->input->post('jenis_permohonan')),
			'files_json' => json_encode($file_json)
		];


		$m_penggeledahan = new M_Penggeledahan();
		$m_penggeledahan->insert($data);


		$enc_id = base64_encode($this->db->insert_id());
		$this->load->library('MyEmail');

		unset($data['user_id']);
		unset($data['files_json']);

		$body = $this->load->view('emails/v_penggeledahan', [
			'title' => 'Form Penggeledahan',
			'text' => 'Pastikan login terlebih dahulu untuk mengakses link dibawah.',
			'data' => $data,
			'files' => $file_json,
			'path' => MyFiles::$penggeledahan,
			'is_admin' => true,
			'link' => base_url('admin/penggeledahan/print/' . $enc_id)
		], true);
		MyEmail::send('sigenajo.pn.jombang@gmail.com', 'Form Penggeledahan', $body);
		$body = $this->load->view('emails/v_penggeledahan', [
			'title' => 'Form Penggeledahan',
			'text' => 'Pastikan login terlebih dahulu untuk mengakses link dibawah.',
			'data' => $data,
			'files' => $file_json,
			'path' => MyFiles::$penggeledahan,
			'is_admin' => false,
			'link' => base_url('admin/penggeledahan/print/' . $enc_id)
		], true);
		MyEmail::send($data['email'], 'Form Penggeledahan', $body);

		setresponse(200, $data);
	}
}
