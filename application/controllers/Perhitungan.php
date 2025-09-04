<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perhitungan_model');
    }

    // Fungsi index sekarang langsung mengarah ke halaman hasil
    public function index()
    {
        redirect('Perhitungan/hasil');
    }
    
    // Fungsi untuk admin melihat hasil akhir
    public function hasil()
    {
        if ($this->session->userdata('id_user_level') != "1") { 
            redirect('Login'); 
        }
        
        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        // --- LOKASI KODE DEBUGGING ---
        // Tiga baris ini akan menghentikan program dan menampilkan
        // isi data hasil perhitungan sebelum dikirim ke halaman.
        echo "<pre>";
        var_dump($data['hasil']);
        die();
        // --- BATAS KODE DEBUGGING ---
        
        $this->load->view('perhitungan/hasil_admin', $data);
    }

    // Fungsi untuk publik melihat hasil akhir
    public function hasil_publik()
    {
        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        $this->load->view('layouts/header_publik', $data);
        $this->load->view('perhitungan/hasil_publik', $data);
    }
}