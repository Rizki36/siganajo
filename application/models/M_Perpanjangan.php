<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_Perpanjangan
 */
class M_Perpanjangan extends MY_Model
{
	private $table = 'perpanjangan';

	public function __construct()
	{
		parent::__construct($this->table);
	}

	/**
	 * get_count_read
	 *
	 * @param bool $is_dibaca
	 * @return int
	 */
	public function get_count_read($is_dibaca)
	{
		return $this->getOne('count(id_perpanjangan) as jml', ['is_dibaca' => $is_dibaca ? 1 : 0])->jml ?? 0;
	}

	public static function get_label($key)
	{
		switch ($key) {
			case 'tgl_surat':
				return 'Tanggal Surat';
			case 'alasan_perpanjangan':
				return 'Alasan Perpanjangan';
			case 'nomor_surat':
				return 'Nomor Surat';
			case 'nama_penyidik':
				return 'Nama Penyidik';
			case 'polres_polsek_pengaju':
				return 'Polres/Polsek Pengaju';
			case 'nip_nrp':
				return 'NIP/NRP';
			case 'nomor_telepon_wa':
				return 'Nomor Telepon WA';
			case 'email':
				return 'Email';
			case 'tanggal_ba':
				return 'Tanggal BA';
			case 'nama_pihak':
				return 'Nama Pihak';
			case 'tempat_lahir':
				return 'Tempat Lahir';
			case 'tanggal_lahir':
				return 'Tanggal Lahir';
			case 'jenis_kelamin':
				return 'Jenis Kelamin';
			case 'tempat_tinggal':
				return 'Tampat Tinggal';
			case 'pekerjaan':
				return 'Pekerjaan';
			case 'agama':
				return 'Agama';
			case 'kebangsaan':
				return 'Kebangsaan';

			case 'surat_permohonan_penyidik':
				return 'Upload surat permohonan penyidik';
			case 'laporan_polisi':
				return 'Upload laporan polisi';
			case 'surat_perintah_penahanan':
				return 'Upload surat perintah penahanan';
			case 'surat_permintaan_perpanjangan_penuntut_umum':
				return 'Upload surat permintaan perpanjangan penuntut umum';
			case 'resume_singkat':
				return 'Upload resume singkat';
			default:
				return $key;
		}
	}
}

/**
 * perpanjangan
 * to convert data from M_Perpanjangan
 * @property int $id_perpanjangan
 * @property int $user_id
 * 
 * @property string $nama_penyidik
 * @property string $nip_nrp
 * @property string $nomor_telepon_wa
 * @property string $email
 * @property string $nama_pihak
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string $tempat_tinggal
 * @property string $pekerjaan
 * @property string $agama
 * @property string $kebangsaan
 * @property string $polres_polsek_pengaju
 * @property string $jenis_permohonan
 * @property string $surat_permohonan_dari_penyidik
 * @property string $surat_perintah_penyitaan
 * @property string $laporan_polisi
 * @property string $surat_pemberitahuan_dimulainya_penyidikan
 * @property string $ba_penyitaan
 * @property string $surat_tanda_terima_barang_bukti
 * @property string $surat_perintah_penyidik
 * @property string $resume_singkat
 * 
 * @property array $files_json
 * @property string $created_at
 * @property bool $is_dibaca
 */
class Perpanjangan_DTO
{
	public $id_perpanjangan;
	public $user_id;

	public $tgl_surat;
	public $nomor_surat;
	public $alasan_perpanjangan;
	public $nama_penyidik;
	public $nip_nrp;
	public $nomor_telepon_wa;
	public $email;
	public $polres_polsek_pengaju;
	public $tanggal_ba;
	public $nama_pihak;
	public $tempat_lahir;
	public $tanggal_lahir;
	public $jenis_kelamin;
	public $tempat_tinggal;
	public $pekerjaan;
	public $agama;
	public $kebangsaan;

	public $files_json;
	public $created_at;
	public $is_dibaca;

	public function __construct($data)
	{
		$this->id_perpanjangan = @$data->id_perpanjangan;
		$this->user_id = @$data->user_id;

		$this->tgl_surat = @$data->tgl_surat;
		$this->nomor_surat = @$data->nomor_surat;
		$this->alasan_perpanjangan = @$data->alasan_perpanjangan;
		$this->nama_penyidik = @$data->nama_penyidik;
		$this->nip_nrp = @$data->nip_nrp;
		$this->nomor_telepon_wa = @$data->nomor_telepon_wa;
		$this->email = @$data->email;
		$this->polres_polsek_pengaju = @$data->polres_polsek_pengaju;
		$this->tanggal_ba = @$data->tanggal_ba;
		$this->nama_pihak = @$data->nama_pihak;
		$this->tempat_lahir = @$data->tempat_lahir;
		$this->tanggal_lahir = @$data->tanggal_lahir;
		$this->jenis_kelamin = @$data->jenis_kelamin;
		$this->tempat_tinggal = @$data->tempat_tinggal;
		$this->pekerjaan = @$data->pekerjaan;
		$this->agama = @$data->agama;
		$this->kebangsaan = @$data->kebangsaan;

		$this->files_json = json_decode(@$data->files_json, true);

		$this->created_at = @$data->created_at;
		$this->created_at_text = date('d-m-Y', strtotime(@$data->created_at));
		$this->is_dibaca = (int)@$data->is_dibaca === 1;
	}
}
