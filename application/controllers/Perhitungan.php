<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Perhitungan_model');
    }

    // FUNGSI INDEX INI TETAP UNTUK ADMIN
    public function index()
    {
        if ($this->session->userdata('id_user_level') != "1") {
        ?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location='<?php echo base_url("Login/home"); ?>'
            </script>
        <?php
        }
        
        $data = [
            'page' => "Perhitungan",
            'kriterias'=> $this->Perhitungan_model->get_kriteria(),
            'alternatifs'=> $this->Perhitungan_model->get_alternatif(),
        ];
        
        $this->load->view('perhitungan/perhitungan', $data);
    }
    
    // FUNGSI INI UNTUK ADMIN (TIDAK DIUBAH)
    public function hasil()
    {
        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        // Memuat view 'hasil.php' yang menggunakan template admin
        $this->load->view('perhitungan/hasil', $data);
    }

    // INI FUNGSI BARU YANG KITA TAMBAHKAN UNTUK PUBLIK
    public function hasil_publik()
    {
        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];
        
        // Membungkus view 'hasil.php' dengan template publik
        $this->load->view('layouts/header_publik', $data);
        $this->load->view('perhitungan/hasil_publik', $data); // Kontennya pakai file yang sama
        $this->load->view('layouts/footer_publik');
    }
}