<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * M_User
 * @property string $key
 * @property string $value
 * @property json $file_json
 */
class M_Setting extends MY_Model
{
	private $table = 'setting';

	public $key;
	public $value;

	public function __construct()
	{
		parent::__construct($this->table);
	}

	/**
	 * get_by_key
	 * to get one data by key
	 * @param string $key
	 * @return string|null
	 */
	public function getByKey($key)
	{
		return $this->getOne(['value'], ['key' => $key])->value ?? null;
	}

	/**
	 * set_by_key
	 * to get one data by key
	 * @param string $key
	 * @param mixed $value
	 * @return bool
	 */
	public function setByKey($key, $value)
	{
		return $this->update(['value' => $value], ['key' => $key]);
	}
}
