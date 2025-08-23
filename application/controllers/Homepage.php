<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function index()
	{
		// Memuat template publik dan view untuk homepage
		$this->load->view('layouts/header_publik');
		$this->load->view('v_homepage'); // Ini adalah file view yang akan kita buat selanjutnya
		$this->load->view('layouts/footer_publik');
	}
}