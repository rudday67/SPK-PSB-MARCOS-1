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
        
        // 1. Ambil daftar siswa yang belum dinilai
        $alternatifs_belum_dinilai = $this->Alternatif_model->get_alternatif_belum_dinilai();
        
        // 2. Siapkan array baru untuk menampung data siswa beserta total poin prestasinya
        $alternatifs_with_prestasi = [];
        
        // 3. Looping untuk setiap siswa, hitung total poinnya, dan masukkan ke array baru
        foreach ($alternatifs_belum_dinilai as $siswa) {
            $total_poin = $this->Prestasi_model->get_total_poin($siswa->id_alternatif);
            $nilai_prestasi = ($total_poin == 0) ? 0.1 : $total_poin;
            
            // Tambahkan properti baru 'poin_prestasi' ke data siswa
            $siswa->poin_prestasi = $nilai_prestasi;
            $alternatifs_with_prestasi[] = $siswa;
        }

        $data = [
            'page' => "Penilaian",
            'alternatifs' => $alternatifs_with_prestasi, // Gunakan array baru yang sudah ada poin prestasinya
            'kriterias' => $this->Kriteria_model->tampil(),
            'url_action' => base_url('Penilaian/simpan')
        ];
        $this->load->view('penilaian/form_penilaian', $data);
    }

    // Menampilkan form penilaian TERISI untuk edit data
    public function edit($id_alternatif)
    {
        if ($this->session->userdata('id_user_level') != "1") { redirect('Login'); }

        $penilaian_raw = $this->Penilaian_model->get_penilaian_by_alternatif($id_alternatif);
        
        $penilaian_map = [];
        foreach($penilaian_raw as $item) {
            $penilaian_map[$item->id_kriteria] = $item->nilai;
        }
        
        $data = [
            'page' => "Penilaian",
            'kriterias' => $this->Kriteria_model->tampil(),
            'edit_data' => $this->Alternatif_model->show($id_alternatif),
            'penilaian_map' => $penilaian_map,
            'url_action' => base_url('Penilaian/update')
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
        if(!$id_alternatif) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan pilih alternatif terlebih dahulu!</div>');
            redirect('Penilaian/tambah');
        }

        $kriterias = $this->Kriteria_model->tampil();
        
        foreach ($kriterias as $kriteria) {
            $nilai_input = $this->input->post($kriteria->kode_kriteria);
            
            $nilai_final = 0;
            $id_kriteria_saat_ini = $kriteria->id_kriteria;

            // Logika khusus untuk kriteria tertentu (jika ada)
            if ($kriteria->kode_kriteria == 'K3') { // Asumsi K3 adalah Prestasi
                // Nilai prestasi diambil dari JavaScript, tidak dihitung ulang di sini
                // Namun, kita tetap ambil dari POST untuk keamanan
                $nilai_final = ($nilai_input == 0) ? 0.1 : $nilai_input;
            } elseif ($kriteria->kode_kriteria == 'K4') { // Asumsi K4 adalah Absensi
                $nilai_final = ($nilai_input == 0) ? 0.1 : $nilai_input;
            } else {
                $nilai_final = $nilai_input;
            }

            // Simpan ke database dengan ID Kriteria yang benar
            $cek = $this->Penilaian_model->data_penilaian($id_alternatif, $id_kriteria_saat_ini);
            if ($cek == 0) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria_saat_ini, $nilai_final);
            } else {
                $this->Penilaian_model->edit_penilaian($id_alternatif, $id_kriteria_saat_ini, $nilai_final);
            }
        }
    }
    // (Letakkan fungsi ini di dalam class Penilaian, misalnya setelah fungsi update())

    public function destroy($id_alternatif)
    {
        if ($this->session->userdata('id_user_level') != "1") {
            redirect('Login');
        }

        $this->Penilaian_model->delete_by_alternatif($id_alternatif);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seluruh data penilaian untuk siswa tersebut berhasil dihapus!</div>');
        redirect('Penilaian');
    }
}