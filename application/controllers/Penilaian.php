<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penilaian_model');
        $this->load->model('Alternatif_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Prestasi_model');
    }

    // Menampilkan daftar siswa yang sudah dinilai
    public function index()
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }
        
        $data = [
            'page' => "Penilaian",
            'list' => $this->Penilaian_model->get_alternatif_dinilai(),
        ];
        $this->load->view('penilaian/index', $data);
    }

    // Menampilkan form penilaian KOSONG untuk data baru
    public function tambah()
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }
        
        $alternatif_list = $this->Alternatif_model->tampil();
        $data_alternatif_prestasi = [];
        foreach ($alternatif_list as $siswa) {
            $total_poin = $this->Prestasi_model->get_total_poin($siswa->id_alternatif);
            $nilai_prestasi = ($total_poin == 0) ? 0.1 : $total_poin;
            $data_alternatif_prestasi[] = ['id_alternatif' => $siswa->id_alternatif, 'nama' => $siswa->nama, 'nilai_prestasi' => $nilai_prestasi];
        }

        $data = [
            'page' => "Penilaian",
            'alternatif_prestasi' => $data_alternatif_prestasi,
            'url_action' => base_url('Penilaian/simpan') // URL untuk menyimpan data BARU
        ];
        $this->load->view('penilaian/form_penilaian', $data);
    }

    // Menampilkan form penilaian TERISI untuk edit data
    public function edit($id_alternatif)
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }

        $data_penilaian = $this->Penilaian_model->get_penilaian_by_alternatif($id_alternatif);
        
        // Ubah data penilaian dari array menjadi format yang mudah dibaca di view
        $penilaian_map = [];
        foreach($data_penilaian as $item) {
            $penilaian_map[$item->id_kriteria] = $item->nilai;
        }
        
        $data = [
            'page' => "Penilaian",
            'edit_data' => $this->Alternatif_model->show($id_alternatif),
            'penilaian_map' => $penilaian_map,
            'url_action' => base_url('Penilaian/update') // URL untuk menyimpan data EDIT
        ];
        $this->load->view('penilaian/form_penilaian', $data);
    }
    
    // Fungsi untuk menyimpan data BARU
    public function simpan()
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }
        $this->proses_simpan();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data penilaian berhasil ditambahkan!</div>');
        redirect('Penilaian');
    }
    
    // Fungsi untuk menyimpan data EDIT
    public function update()
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }
        $this->proses_simpan();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data penilaian berhasil diupdate!</div>');
        redirect('Penilaian');
    }

    // Fungsi inti untuk proses simpan (digunakan oleh simpan() dan update())
    private function proses_simpan()
    {
        $id_alternatif = $this->input->post('id_alternatif');
        $absensi = ($this->input->post('absensi') == 0) ? 0.1 : $this->input->post('absensi');
        $prestasi = $this->Prestasi_model->get_total_poin($id_alternatif);
        $nilai_prestasi = ($prestasi == 0) ? 0.1 : $prestasi;

        $data_penilaian = [
            '1' => $this->input->post('nilai_raport'),
            '2' => $this->input->post('nilai_ipc'),
            '3' => $nilai_prestasi,
            '4' => $absensi,
            '5' => $this->input->post('ekstrakurikuler')
        ];

        foreach ($data_penilaian as $id_kriteria => $nilai) {
            $cek = $this->Penilaian_model->data_penilaian($id_alternatif, $id_kriteria);
            if ($cek == 0) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria, $nilai);
            } else {
                $this->Penilaian_model->edit_penilaian($id_alternatif, $id_kriteria, $nilai);
            }
        }
    }
}