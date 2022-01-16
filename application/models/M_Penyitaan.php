<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_Penyitaan
 */
class M_Penyitaan extends MY_Model
{
	private $table = 'penyitaan';

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function format_data($data)
	{
	}
}

