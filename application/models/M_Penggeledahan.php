<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_Penggeledahan
 */
class M_Penggeledahan extends MY_Model
{
	private $table = 'penggeledahan';

	public function __construct()
	{
		parent::__construct($this->table);
	}


	/**
	 * for admin
	 * @param bool $is_dibaca
	 * @return int
	 */
	public function get_count_read($is_dibaca)
	{
		return $this->getOne('count(id_penggeledahan) as jml', ['is_dibaca' => $is_dibaca ? 1 : 0])->jml ?? 0;
	}

	/**
	 * @param string $user_id
	 * @return int
	 */
	public function count_read($user_id)
	{
		return $this->getOne('count(id_penggeledahan) as jml', [
			'is_dibaca' =>  1,
			'user_id' => $user_id
		])->jml ?? 0;
	}

	/**
	 * @param string $user_id
	 * @return int
	 */
	public function count_unread($user_id)
	{
		return $this->getOne('count(id_penggeledahan) as jml', [
			'is_dibaca' =>  0,
			'user_id' => $user_id
		])->jml ?? 0;
	}

	/**
	 * @param string $user_id
	 * @return int
	 */
	public function count_rejected($user_id)
	{
		$where = "alasan_ditolak IS NOT NULL AND user_id = '$user_id' AND is_dibaca_user = 0";
		return $this->getOne('count(id_penggeledahan) as jml', $where)->jml ?? 0;
	}

	/**
	 * @param string $user_id
	 * @return int
	 */
	public function count_accepted($user_id)
	{
		$where = "upload IS NOT NULL AND user_id = '$user_id' AND is_dibaca_user = 0";
		return $this->getOne('count(id_penggeledahan) as jml', $where)->jml ?? 0;
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
			case 'polres_polsek_pengaju':
				return 'Polres Polsek Pengaju';
			case 'jenis_permohonan':
				return 'Jenis Permohonan';
			case 'surat_permohonan_dari_penyidik':
				return 'Surat Permohonan Dari Penyidik / PPNS';
			case 'surat_perintah_penggeledahan':
				return 'Surat Perintah Penggeledahan';
			case 'laporan_polisi':
				return 'Laporan Polisi';
			case 'surat_pemberitahuan_dimulainya_penyidikan':
				return 'Surat Pemberitahuan Dimulainya Penyidikan (SPDP)';
			case 'ba_penggeledahan':
				return 'BA Penggeledahan';
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
 * Penyitaan
 * to convert data from M_Penyitaan
 * @property int $id_penggeledahan
 * @property int $user_id
 * @property string $nama_penyidik
 * @property string $nip_nrp
 * @property string $nomor_telepon_wa
 * @property string $email
 * @property string $polres_polsek_pengaju
 * @property string $jenis_permohonan
 * @property array $files_json
 * @property int $created_at
 * @property bool $is_dibaca
 * 
 */
class Penggeledahan_DTO
{
	public $id_penggeledahan;
	public $user_id;
	public $nama_penyidik;
	public $nip_nrp;
	public $nomor_telepon_wa;
	public $email;
	public $nama_pihak;
	public $polres_polsek_pengaju;
	public $jenis_permohonan;
	public $files_json;
	public $created_at;
	public $is_dibaca;
	public $alasan_ditolak;
	public $nomor_surat_penolakan;
	public $upload;

	// custom
	public $created_at_text;


	public function __construct($data)
	{
		$this->id_penggeledahan = @$data->id_penggeledahan;
		$this->user_id = @$data->user_id;
		$this->nama_penyidik = @$data->nama_penyidik;
		$this->nip_nrp = @$data->nip_nrp;
		$this->nomor_telepon_wa = @$data->nomor_telepon_wa;
		$this->email = @$data->email;
		$this->nama_pihak = @$data->nama_pihak;
		$this->polres_polsek_pengaju = @$data->polres_polsek_pengaju;
		$this->jenis_permohonan = @$data->jenis_permohonan;
		$this->files_json = json_decode(@$data->files_json, true);
		$this->created_at = @$data->created_at;
		$this->is_dibaca = (int)@$data->is_dibaca === 1;
		$this->is_dibaca_user = (int)@$data->is_dibaca_user === 1;

		$this->alasan_ditolak = $data->alasan_ditolak;
		$this->nomor_surat_penolakan = $data->nomor_surat_penolakan;
		$this->upload = $data->upload;

		$this->created_at_text = date('d-m-Y', strtotime(@$data->created_at));
	}
}
