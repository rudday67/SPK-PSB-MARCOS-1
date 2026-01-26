<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Laporan extends CI_Controller {
    
        public function __construct()
        {
            parent ::__construct();
            // Model sudah dimuat di sini, jadi tinggal pakai
            $this->load->model('Perhitungan_model');
        }

        public function index()
        {
            $data = [
                'page' => "Laporan", // Tambahan label halaman agar rapi
                // GANTI 'get_hasil' menjadi 'get_hasil_laporan'
                'hasil'=> $this->Perhitungan_model->get_hasil_laporan(),
            ];
            
            $this->load->view('laporan', $data);
        } 
        
    }