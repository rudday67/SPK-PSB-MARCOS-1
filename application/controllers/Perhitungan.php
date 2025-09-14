<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Hanya memuat model, tidak ada pengecekan login di sini
        $this->load->model('Perhitungan_model');
    }

    /**
     * Fungsi index default, bisa diarahkan ke hasil publik
     */
    public function index()
    {
        redirect('Perhitungan/hasil_publik');
    }
    
    /**
     * Halaman Hasil Akhir untuk ADMIN PANEL
     * Fungsi ini memerlukan user untuk login.
     */
    public function hasil()
    {
        // Pengecekan login ditaruh di sini, khusus untuk fungsi ini
        if (!$this->session->userdata('id_user')) {
            redirect('Login');
        }

        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        // Memuat view dengan layout admin
        $this->load->view('perhitungan/hasil_admin', $data);
    }

    /**
     * Halaman Hasil Akhir untuk PUBLIK
     * Fungsi ini TIDAK memerlukan user untuk login.
     */
    public function hasil_publik()
    {
        $data = [
            'page' => "Hasil", // Anda bisa sesuaikan judulnya
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        // Memuat view dengan layout publik (contoh)
        $this->load->view('layouts/header_publik', $data); // Sesuaikan dengan nama file header publik Anda
        $this->load->view('perhitungan/hasil_publik', $data); // Anda mungkin perlu membuat view ini
        $this->load->view('layouts/footer_publik', $data); // Sesuaikan dengan nama file footer publik Anda
    }
}