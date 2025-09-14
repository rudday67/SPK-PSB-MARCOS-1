<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Memuat model-model yang mungkin dibutuhkan oleh dashboard
        $this->load->model('Alternatif_model');
        $this->load->model('Kriteria_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        // Cek apakah user sudah login atau belum
        if ($this->session->userdata('id_user')) 
        {
            // --- JIKA SUDAH LOGIN: TAMPILKAN DASHBOARD INTERNAL ---
            
            $user_level = $this->session->userdata('id_user_level');
            $data['page'] = "Dashboard";

            // Menyiapkan data hanya jika yang login adalah Admin
            if ($user_level == '1') {
                $data['alternatif'] = $this->Alternatif_model->getTotal();
                $data['kriteria'] = $this->Kriteria_model->getTotal();
                $data['user'] = $this->User_model->getTotal();
            }
            
            // Memuat view dashboard internal (admin/index.php)
            $this->load->view('admin/index', $data);

        } 
        else 
        {
            // --- JIKA BELUM LOGIN: TAMPILKAN HOMEPAGE PUBLIK ---
            
            // Anda bisa menyiapkan data untuk halaman publik di sini jika perlu
            $data['page'] = "Homepage";

            // Memuat view untuk publik
            $this->load->view('layouts/header_publik', $data);
            $this->load->view('v_homepage');
            $this->load->view('layouts/footer_publik');
        }
    }
}