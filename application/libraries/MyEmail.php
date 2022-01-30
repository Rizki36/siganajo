<?php
defined('BASEPATH') or exit('No direct script access allowed');


class MyEmail
{
	public static function send($to, $subject, $message)
	{
		$CI = &get_instance();

		$CI->load->library('email');
		$CI->email->initialize([
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_user' => EMAIL_SENDER,
			'smtp_pass'   => '123456Ra@ma',
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		]);

		$CI->email->from(EMAIL_SENDER, 'Sistem Sigenajo');
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($message);

		return $CI->email->send();
	}
}
