<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_User
 * @property int $id
 * @property admin|user $role
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
	public $role;
	public $name;
	public $is_verified;
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
	 * fill_data
	 * fill object with data
	 * 
	 * @param object $data
	 * @param bool $show_guard
	 * @return $this
	 */
	public function fill_data($data)
	{
		$this->id = @$data->id;
		$this->role = @$data->role;
		$this->name = @$data->name;
		$this->is_verified = (int)@$data->is_verified;
		$this->username = @$data->username;
		$this->password = @$data->password;
		$this->origin_unit = @$data->origin_unit;
		$this->file = @$data->file;
		$this->file_json = @$data->file_json;

		return $this;
	}


	/**
	 * format_data
	 *
	 * @param object $data
	 * @param boolean $show_guard
	 * @return object
	 */
	public function format_data($data, $show_guard = false)
	{
		$this->load->library('MyFiles');

		$out = [
			'id' => $data->id,
			'role' => $data->role,
			'name' => $data->name,
			'is_verified' => (int)$data->is_verified,
			'username' => $data->username,
			'origin_unit' => $data->origin_unit,
			'file' => base_url(MyFiles::$user_path . '/' . $data->file),
			'file_json' => [],
		];

		$json = json_decode($data->file_json, true);

		if (is_array($json)) {
			foreach ($json as $key => $value) {
				$out['file_json'][$key] = $value;
			}
		}

		if ($show_guard) $out['password'] = $data->password;

		return $out;
	}

	/**
	 * getData
	 * 
	 * Use it instead get()
	 * 
	 * @param array $where
	 * @param string|array $column
	 * @return object
	 */
	public function getData($where, $column = '*')
	{
		return $this->get($column, array_merge($where, [
			'is_verified' => 1,
		]));
	}
}
