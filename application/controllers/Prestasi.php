<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi extends CI_Controller {

    public function __construct()
{
    parent::__construct();
    if (!in_array($this->session->userdata('id_user_level'), ['1', '4'])) {
        redirect('Login');
    }
    $this->load->model('Prestasi_model');
    $this->load->model('Alternatif_model');
}

    /**
     * Menampilkan halaman utama CRUD Prestasi (Daftar Prestasi).
     */
    public function index()
    {
        $data = [
            'page' => "Prestasi",
            'list' => $this->Prestasi_model->tampil(),
            'alternatif' => $this->Alternatif_model->tampil()
        ];
        $this->load->view('prestasi/index', $data);
    }
    
    /**
     * Menyimpan data prestasi baru dari form modal.
     */
    public function store()
    {
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
    
    /**
     * Menampilkan halaman form untuk mengedit data prestasi.
     */
    public function edit($id_prestasi)
    {
        $data['page'] = "Prestasi";
        // Mengambil data spesifik yang akan diedit dari model
        $data['prestasi'] = $this->Prestasi_model->show($id_prestasi);
        // Memuat view form edit dan mengirim data prestasi ke dalamnya
        $this->load->view('prestasi/form_edit_prestasi', $data);
    }

    /**
     * Memproses data yang dikirim dari form edit.
     */
    public function update()
    {
        $id_prestasi = $this->input->post('id_prestasi');
        $data = [
            'id_alternatif' => $this->input->post('id_alternatif'),
            'nama_prestasi' => $this->input->post('nama_prestasi'),
            'tingkat' => $this->input->post('tingkat'),
            'juara' => $this->input->post('juara'),
            'nilai_poin' => $this->input->post('nilai_poin'),
        ];

        $this->Prestasi_model->update($id_prestasi, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data prestasi berhasil diupdate!</div>');
        redirect('Prestasi');
    }

    /**
     * Menghapus data prestasi berdasarkan ID.
     */
    public function destroy($id_prestasi)
    {
        $this->Prestasi_model->delete($id_prestasi);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data prestasi berhasil dihapus!</div>');
        redirect('Prestasi');
    }
}