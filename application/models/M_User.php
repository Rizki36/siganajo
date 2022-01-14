<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_User
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $origin_unit
 * @property string $file
 * @property json $file_json
 */
class M_User extends MY_Model
{
	private $table = 'user';

	public $id;
	public $name;
	public $username;
	public $password;
	public $origin_unit;
	public $file;
	public $file_json;


	public function __construct()
	{
		parent::__construct($this->table);
	}

	/**
	 * to_format
	 * 
	 * @param object $data
	 * @param bool $show_guard
	 * @return $this
	 */
	public function format_to($data, $show_guard = false)
	{
		$this->id = $data->id;
		$this->name = $data->name;
		$this->username = $data->username;
		$this->origin_unit = $data->origin_unit;
		$this->file = $data->file;
		$this->file_json = $data->file_json;

		if ($show_guard) $this->password = $data->password;

		return $this;
	}
}
