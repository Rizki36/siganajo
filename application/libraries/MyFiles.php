<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MyFiles
{
	public static $penyitaan = 'assets/data/penyitaan';
	public static $penggeledahan = 'assets/data/penggeledahan';
	public static $perpanjangan = 'assets/data/perpanjangan';

	/**
	 * upload
	 * @param File $file
	 * @param File $file
	 * @return string
	 */
	public function upload($file, $file_name, $path, $type = 'pdf', $max_size = 10000)
	{

		$this->load->helper('url');

		if (!empty($file['name'])) {
			// Set preference 
			$config['upload_path'] = $path;
			$config['allowed_types'] = $type;
			$config['max_size'] = $max_size; // max_size in kb 
			$config['file_name'] = $file_name;

			// Load upload library 
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('file')) {
				// Get data about the file
				$uploadData = $this->upload->data();
				$filename = $uploadData['file_name'];
				return $filename;
			} else {
				throw new Error($this->upload->display_errors());
			}
		} else {
			throw new Error('File Kosong.');
		}
	}
}
