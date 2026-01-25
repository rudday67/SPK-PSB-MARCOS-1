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
    // Pengecekan login
    if (!$this->session->userdata('id_user')) {
        redirect('Login');
    }

    // HITUNG: Berapa siswa yang status_verifikasinya masih 0
    $this->db->where('status_verifikasi', 0);
    $jumlah_belum_verif = $this->db->count_all_results('alternatif');

    $data = [
        'page'  => "Hasil",
        'hasil' => $this->Perhitungan_model->get_hasil(),
        'belum_verif' => $jumlah_belum_verif // Kirim hasil hitungan ke view
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

    public function verifikasi($id_alternatif)
{
    // Cek Hak Akses: Hanya Pimpinan (3) atau Admin (1)
    if (!in_array($this->session->userdata('id_user_level'), ['1', '3'])) {
        redirect('Login');
    }

    $this->load->model('Alternatif_model');
    $this->Alternatif_model->update_verifikasi($id_alternatif, 1);
    
    $this->session->set_flashdata('message', '<div class="alert alert-success">Siswa berhasil diverifikasi oleh Pimpinan!</div>');
    redirect('Perhitungan/hasil');
}

public function batal_verifikasi($id_alternatif)
{
    if (!in_array($this->session->userdata('id_user_level'), ['1', '3'])) {
        redirect('Login');
    }

    $this->load->model('Alternatif_model');
    $this->Alternatif_model->update_verifikasi($id_alternatif, 0);
    
    $this->session->set_flashdata('message', '<div class="alert alert-warning">Verifikasi dibatalkan!</div>');
    redirect('Perhitungan/hasil');
}

public function verifikasi_semua()
{
    // Keamanan: Hanya Pimpinan (Level 3) yang bisa akses
    if ($this->session->userdata('id_user_level') != '3') {
        redirect('Login');
    }

    $this->load->model('Alternatif_model');
    $this->Alternatif_model->verifikasi_semua();

    $this->session->set_flashdata('message', '<div class="alert alert-success">Seluruh data berhasil diverifikasi!</div>');
    redirect('Perhitungan/hasil');
}

public function batal_verifikasi_semua()
{
    // Keamanan: Hanya Pimpinan (Level 3) yang bisa akses
    if ($this->session->userdata('id_user_level') != '3') {
        redirect('Login');
    }

    $this->load->model('Alternatif_model');
    $this->Alternatif_model->batal_verifikasi_semua();

    $this->session->set_flashdata('message', '<div class="alert alert-danger">Seluruh verifikasi telah dibatalkan!</div>');
    redirect('Perhitungan/hasil');
}
}