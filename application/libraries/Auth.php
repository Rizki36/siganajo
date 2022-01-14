<?php
defined('BASEPATH') or exit('No direct script access allowed');

use MyCLabs\Enum\Enum;

class User_Role extends Enum
{
	const admin = "admin";
	const user = "user";
}

class Auth
{
	private static $secret_key_pin = 'pOn3oMhmYbg17uXk';

	/**
	 * has_access
	 *
	 * @param string $role - User_Role enum
	 * @return boolean
	 */
	public static function has_access($role)
	{
		$CI = &get_instance();
		$session_role = $CI->session->userdata('role');
		$time = time() + 25200;
		$expired  = 30000;
		$timeout = $CI->session->userdata('timeout');
		if ($session_role === $role) {
			if ($time < $timeout) {
				$CI->session->unset_userdata('timeout');
				$CI->session->set_userdata('timeout', ($time + $expired));
				return true;
			} else {
				$CI->session->sess_destroy();
				return false;
			}
		} else {
			return false;
		}
	}

	public static function enc($data)
	{
		return openssl_encrypt($data, 'aes128', self::$secret_key_pin, false, self::$secret_key_pin);
	}

	public static function dec($data)
	{
		return openssl_decrypt($data, 'aes128', self::$secret_key_pin, false, self::$secret_key_pin);
	}
}
