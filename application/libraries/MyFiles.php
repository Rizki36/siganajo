<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MyFiles
{
	public static $user_path = 'assets/data/user';
	public static $penyitaan = 'assets/data/penyitaan';
	public static $penggeledahan = 'assets/data/penggeledahan';
	public static $perpanjangan = 'assets/data/perpanjangan';

	/**
	 * upload
	 * @param string $input_name
	 * @param string $file_name
	 * @param string $path
	 * @param string $type
	 * @param int $max_size
	 * @return string
	 */
	public static function upload($input_name, $file_name, $path, $type = 'pdf', $max_size = 10000)
	{
		$file = $_FILES[$input_name];
		$CI = &get_instance();
		if (!empty($file['name'])) {
			// Set preference 
			$config['upload_path'] = $path;
			$config['allowed_types'] = $type;
			$config['max_size'] = $max_size; // max_size in kb 
			$config['file_name'] = $file_name;

			// Load upload library 
			$CI->load->library('upload', $config);

			// File upload
			if ($CI->upload->do_upload($input_name)) {
				// Get data about the file
				$uploadData = $CI->upload->data();
				$filename = $uploadData['file_name'];
				return $filename;
			} else {
				throw new Error($CI->upload->display_errors());
			}
		} else {
			throw new Error('File Kosong.');
		}
	}
}
