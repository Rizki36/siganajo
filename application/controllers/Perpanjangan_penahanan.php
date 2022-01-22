<?php
defined('BASEPATH') or exit('No direct script access allowed');

class perpanjangan_penahanan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('M_Perpanjangan');
	}

	public function index()
	{
		$step1Form['title'] = ['class_container' => 'col-12', 'type' => 'heading', 'text' => 'PENDAFTARAN PERPANJANGAN PENAHANAN', 'attr' => ['required']];
		$step1Form['tgl_surat'] = ['class_container' => 'col-6', 'type' => 'date', 'label' => 'Tanggal Surat Permohonan', 'attr' => ['required']];
		$step1Form['nomor_surat'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Nomor Surat Perintah Perpanjangan Penahanan', 'attr' => ['required']];
		$step1Form['alasan_perpanjangan'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Alasan Perpanjangan Penahanan', 'attr' => ['required']];

		$step1Form['nama_penyidik'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Nama Penyidik', 'attr' => ['required']];
		$step1Form['nip_nrp'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'NIP/NRP', 'attr' => ['required']];
		$step1Form['nomor_telepon_wa'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Nomor Telepon Wa', 'attr' => ['required']];
		$step1Form['email'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => 'Email', 'attr' => ['required']];

		$step1Form['tanggal_ba'] = ['class_container' => 'col-6', 'type' => 'date', 'label' => 'Tanggal BA Perpanjangan Penahanan', 'attr' => ['required']];

		$step1Form['polres_polsek_pengaju'] = [
			'class_container' => 'col-6', 'type' => 'select', 'label' => 'Polres Polsek Pengaju',
			'options' =>  [
				['value' => '', 'label' => 'Pilih Polres Pengaju'],
				['value' => 'Kejaksaan Negeri Jombang', 'label' => 'Kejaksaan Negeri Jombang'],
				['value' => 'Polres Jombang', 'label' => 'Polres Jombang'],
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
			],
			'attr' => ['required']
		];

		$step1Form['heading_pihak'] = ['class_container' => 'col-12 mt-5', 'type' => 'heading', 'text' => 'DATA PIHAK', 'attr' => ['required']];
		$step1Form['nama_pihak'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('nama_pihak'), 'attr' => ['required']];
		$step1Form['tempat_lahir'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('tempat_lahir'), 'attr' => ['required']];
		$step1Form['tanggal_lahir'] = ['class_container' => 'col-6', 'type' => 'date', 'label' => M_Perpanjangan::get_label('tanggal_lahir'), 'attr' => ['required']];
		$step1Form['jenis_kelamin'] = [
			'class_container' => 'col-6', 'type' => 'select', 'label' => M_Perpanjangan::get_label('jenis_kelamin'),
			'options' => [
				['value' => '', 'label' => 'Jenis Kelamin'],
				['value' => 'Laki-Laki', 'label' => 'Laki-Laki'],
				['value' => 'Perempuan', 'label' => 'Perempuan'],
			],
			'attr' => ['required']
		];
		$step1Form['kebangsaan'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('kebangsaan'), 'attr' => ['required']];
		$step1Form['tempat_tinggal'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('tempat_tinggal'), 'attr' => ['required']];
		$step1Form['agama'] = [
			'class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('agama'),
			'options' => [
				['value' => '', 'label' => 'Pilih Agama'],
				['value' => 'Islam', 'label' => 'Islam'],
				['value' => 'Protestan', 'label' => 'Protestan'],
				['value' => 'Katolik', 'label' => 'Katolik'],
				['value' => 'Budha', 'label' => 'Budha'],
				['value' => 'Hindu', 'label' => 'Hindu'],
				['value' => 'Kong Hu Chu', 'label' => 'Kong Hu Chu'],
				['value' => 'Lainnya', 'label' => 'Lainnya'],
			],
			'attr' => ['required']
		];
		$step1Form['pekerjaan'] = ['class_container' => 'col-6', 'type' => 'text', 'label' => M_Perpanjangan::get_label('pekerjaan'), 'attr' => ['required']];

		$steps['penyidik']['forms']['step2Form']['input'] = $step1Form;
		$steps['penyidik']['forms']['step2Form']['template_attr'] = ['x-if' => 'true'];
		$steps['penyidik']['validation_link'] = base_url('perpanjangan_penahanan/validation_first');
		$steps['penyidik']['name'] = 'PERPANJANGAN PENAHANAN';

		// ---- step 2 ---- //
		$step2Form['surat_permohonan_dari_penyidik'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('surat_permohonan_dari_penyidik'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['surat_perintah_penyitaan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('surat_perintah_penyitaan'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['laporan_polisi'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('laporan_polisi'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['surat_pemberitahuan_dimulainya_penyidikan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('surat_pemberitahuan_dimulainya_penyidikan'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['ba_penyitaan'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('ba_penyitaan'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['surat_tanda_terima_barang_bukti'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('surat_tanda_terima_barang_bukti'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['surat_perintah_penyidik'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('surat_perintah_penyidik'), 'attr' => ['accept' => ".pdf", 'required']];
		$step2Form['resume_singkat'] = ['class_container' => 'col-12', 'type' => 'file', 'label' => M_Perpanjangan::get_label('resume_singkat'), 'attr' => ['accept' => ".pdf"]];
		$steps['berkas']['forms']['step2Form']['input'] = $step2Form;
		$steps['berkas']['forms']['step2Form']['template_attr'] = ['x-if' => "true"];
		$steps['berkas']['validation_link'] = base_url('perpanjangan_penahanan/validation_berkas');
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

	public function validation_first()
	{
		## validation rule
		$this->form_validation->set_rules('tgl_surat', M_Perpanjangan::get_label('tgl_surat'), 'trim|required');
		$this->form_validation->set_rules('nama_penyidik', M_Perpanjangan::get_label('nama_penyidik'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nip_nrp', M_Perpanjangan::get_label('nip_nrp'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nomor_telepon_wa', M_Perpanjangan::get_label('nomor_telepon_wa'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', M_Perpanjangan::get_label('email'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nama_pihak', M_Perpanjangan::get_label('nama_pihak'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('tempat_lahir', M_Perpanjangan::get_label('tempat_lahir'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('tanggal_lahir', M_Perpanjangan::get_label('tanggal_lahir'), 'trim|required');
		$this->form_validation->set_rules('jenis_kelamin', M_Perpanjangan::get_label('jenis_kelamin'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('tempat_tinggal', M_Perpanjangan::get_label('tempat_tinggal'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('pekerjaan', M_Perpanjangan::get_label('pekerjaan'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('agama', M_Perpanjangan::get_label('agama'), 'trim|required|min_length[3]');
		$this->form_validation->set_rules('kebangsaan', M_Perpanjangan::get_label('kebangsaan'), 'trim|required|min_length[3]');

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
		## upload file
		$inpNames = [
			'surat_permohonan_dari_penyidik',
			'surat_perintah_penyitaan',
			'laporan_polisi',
			'surat_pemberitahuan_dimulainya_penyidikan',
			'ba_penyitaan',
			'surat_tanda_terima_barang_bukti',
			'surat_perintah_penyidik',
			'resume_singkat',
		];

		$file_json = [];
		$time = time();
		foreach ($inpNames as $inpName) {
			try {
				$filename = MyFiles::upload($inpName, $time . '_' . @$_POST['username'] . '_' . $inpName, MyFiles::$penggeledahan);
				$file_json[$inpName] = $filename;
			} catch (\Throwable $th) {
				if ($inpName !== 'resume_singkat') setresponse(400, ['msg' => M_Perpanjangan::get_label($inpName) . ' : ' . $th->getMessage()]);
			}
		}

		$data = [
			'user_id' => @$_SESSION['user_id'],
			'tgl_surat' => filter_xss(@$_POST['tgl_surat']),
			'nama_penyidik' => filter_xss(@$_POST['nama_penyidik']),
			'nip_nrp' => filter_xss(@$_POST['nip_nrp']),
			'nomor_telepon_wa' => filter_xss(@$_POST['nomor_telepon_wa']),
			'email' => filter_xss(@$_POST['email']),
			'nama_pihak' => filter_xss(@$_POST['nama_pihak']),
			'tempat_lahir' => filter_xss(@$_POST['tempat_lahir']),
			'tanggal_lahir' => filter_xss(@$_POST['tanggal_lahir']),
			'jenis_kelamin' => filter_xss(@$_POST['jenis_kelamin']),
			'tempat_tinggal' => filter_xss(@$_POST['tempat_tinggal']),
			'pekerjaan' => filter_xss(@$_POST['pekerjaan']),
			'agama' => filter_xss(@$_POST['agama']),
			'kebangsaan' => filter_xss(@$_POST['kebangsaan']),
			'files_json' => json_encode($file_json)
		];


		$m_perpanjangan = new M_Perpanjangan();
		$m_perpanjangan->insert($data);


		$enc_id = base64_encode($this->db->insert_id());
		$this->load->library('MyEmail');

		unset($data['user_id']);
		unset($data['files_json']);

		$body = $this->load->view('emails/v_perpanjangan', [
			'title' => 'Form Baru',
			'text' => 'Pastikan login terlebih dahulu untuk mengakses link dibawah.',
			'data' => $data,
			'files' => $file_json,
			'path' => MyFiles::$perpanjangan,
			'is_admin' => true,
			'link' => base_url('admin/perpanjangan-penahanan/print/' . $enc_id)
		], true);
		MyEmail::send('sigenajo.pn.jombang@gmail.com', 'Form baru', $body);
		$body = $this->load->view('emails/v_perpanjangan', [
			'title' => 'Form Baru',
			'text' => 'Pastikan login terlebih dahulu untuk mengakses link dibawah.',
			'data' => $data,
			'files' => $file_json,
			'path' => MyFiles::$perpanjangan,
			'is_admin' => false,
			'link' => base_url('admin/perpanjangan-penahanan/print/' . $enc_id)
		], true);
		MyEmail::send($data['email'], 'Salinan Form', $body);

		setresponse(200, $data);
	}
}
