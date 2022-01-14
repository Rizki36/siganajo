<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('escape')) { // escape string input injection
	function escape($str)
	{
		$str = get_instance()->db->escape_str($str);
		return $str;
	}
}

if (!function_exists('protect_input_xss')) { // protect input xss
	function protect_input_xss($str)
	{
		$str = htmlentities(strip_tags(htmlspecialchars($str)), ENT_QUOTES, 'UTF-8');
		return $str;
	}
}

if (!function_exists('filter_xss')) { // protect input xss
	function filter_xss($str)
	{
		return protect_input_xss(escape($str));
	}
}
