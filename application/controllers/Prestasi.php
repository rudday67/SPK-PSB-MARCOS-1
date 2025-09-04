<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prestasi_model');
        $this->load->model('Alternatif_model');
    }

    // Menampilkan halaman utama CRUD Prestasi
    public function index()
    {
        if ($this->session->userdata('id_user_level') != "1") {
            redirect('Login');
        }

        $data = [
            'page' => "Prestasi",
            'list' => $this->Prestasi_model->tampil(),
            'alternatif' => $this->Alternatif_model->tampil()
        ];

        // Nanti kita akan membuat view 'prestasi/index.php'
        $this->load->view('prestasi/index', $data);
    }
    
    // Menyimpan data prestasi baru
    public function store()
    {
        if ($this->session->userdata('id_user_level') != "1") {
            redirect('Login');
        }

        $data = [
            'id_alternatif' => $this->input->post('id_alternatif'),
            'nama_prestasi' => $this->input->post('nama_prestasi'),
            'tingkat' => $this->input->post('tingkat'),
            'juara' => $this->input->post('juara'),
            'nilai_poin' => $this->input->post('nilai_poin'),
        ];

        $this->Prestasi_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data prestasi berhasil ditambahkan!</div>');
        redirect('Prestasi');
    }
    
    // (Fungsi edit dan hapus akan kita buat setelah halaman utamanya jadi)
}