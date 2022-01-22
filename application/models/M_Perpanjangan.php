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

	public static function get_label($key)
	{
		switch ($key) {
			case 'nama_penyidik':
				return 'Nama Penyidik';
			case 'nip_nrp':
				return 'NIP/NRP';
			case 'nomor_telepon_wa':
				return 'Nomor Telepon WA';
			case 'email':
				return 'Email';

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

			case 'polres_polsek_pengaju':
				return 'Polres Polsek Pengaju';
			case 'jenis_permohonan':
				return 'Jenis Permohonan';
			case 'surat_permohonan_dari_penyidik':
				return 'Surat Permohonan Dari Penyidik';
			case 'surat_perintah_penyitaan':
				return 'Surat Perintah Penyitaan';
			case 'laporan_polisi':
				return 'Laporan Polisi';
			case 'surat_pemberitahuan_dimulainya_penyidikan':
				return 'Surat Pemberitahuan Dimulainya Penyidikan';
			case 'ba_penyitaan':
				return 'BA Penyitaan';
			case 'surat_tanda_terima_barang_bukti':
				return 'Surat Tanda Terima Barang Bukti';
			case 'surat_perintah_penyidik':
				return 'Surat Perintah Penyidik';
			case 'resume_singkat':
				return 'Resume Singkat';
			default:
				return $key;
		}
	}
}

/**
 * perpanjangan
 * to convert data from M_Perpanjangan
 * @property int $id_penyitaan
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
class Penyitaan_DTO
{
	public $id_penyitaan;
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
	public $kebangsaan;
	public $tempat_tinggal;
	public $agama;
	public $pekerjaan;

	public $files_json;
	public $created_at;
	public $is_dibaca;

	public function __construct($data)
	{
		$this->id_penyitaan = @$data->id_penyitaan;
		$this->user_id = @$data->user_id;

		$this->nama_penyidik = @$data->nama_penyidik;
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
		$this->kebangsaan = @$data->kebangsaan;
		$this->tempat_tinggal = @$data->tempat_tinggal;
		$this->agama = @$data->agama;
		$this->pekerjaan = @$data->pekerjaan;

		$this->files_json = json_decode(@$data->files_json, true);

		$this->created_at = @$data->created_at;
		$this->is_dibaca = (int)@$data->is_dibaca === 1;
	}
}
