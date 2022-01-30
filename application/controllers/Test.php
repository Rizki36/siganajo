<?php
defined('BASEPATH') or exit('No direct script access allowed');

class test extends CI_Controller
{
    public function email($email)
    {
        $this->load->library('MyEmail');
        MyEmail::send($email, 'Form Penggeledahan', 'Test Email.');
    }
}
