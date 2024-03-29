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


	public function __construct()
	{
		parent::__construct($this->table);
	}

	/**
	 *
	 * @param bool $is_verified
	 * @return int
	 */
	public function get_count_verified($is_verified)
	{
		return $this->getOne('count(id) jml', ['is_verified' => $is_verified ? 1 : 0])->jml ?? 0;
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

class User_DTO
{
	public $id;
	public $role;
	public $name;
	public $is_verified;
	public $username;
	public $password;
	public $origin_unit;
	public $file;
	public $file_json;


	public function __construct($data)
	{
		$this->id = @$data->id;
		$this->role = @$data->role;
		$this->name = @$data->name;
		$this->is_verified = (int)@$data->is_verified === 1;
		$this->username = @$data->username;
		$this->password = @$data->password;
		$this->origin_unit = @$data->origin_unit;
		$this->file = @$data->file;
		$this->file_json = @$data->file_json;
		$this->file_array = [];

		$json = json_decode($data->file_json, true);

		if (is_array($json)) {
			foreach ($json as $key => $value) {
				$this->file_array[$key] = $value;
			}
		}

		return $this;
	}
}
