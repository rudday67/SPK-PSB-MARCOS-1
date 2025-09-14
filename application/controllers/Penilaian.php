<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // PERUBAHAN DI SINI:
        // Memastikan hanya Admin (1) dan Petugas (4) yang bisa mengakses.
        if (!in_array($this->session->userdata('id_user_level'), ['1', '4'])) {
            redirect('Login');
        }
        $this->load->model('Penilaian_model');
        $this->load->model('Alternatif_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Prestasi_model');
    }

    public function index()
    {
        $data = [
            'page' => "Penilaian",
            'list' => $this->Penilaian_model->get_alternatif_dinilai(),
        ];
        $this->load->view('penilaian/index', $data);
    }

    public function tambah()
    {
        $alternatifs_belum_dinilai = $this->Alternatif_model->get_alternatif_belum_dinilai();
        $alternatifs_with_prestasi = [];
        
        foreach ($alternatifs_belum_dinilai as $siswa) {
            $total_poin = $this->Prestasi_model->get_total_poin($siswa->id_alternatif);
            $nilai_prestasi = ($total_poin == 0) ? 0.1 : $total_poin;
            $siswa->poin_prestasi = $nilai_prestasi;
            $alternatifs_with_prestasi[] = $siswa;
        }

        $data = [
            'page' => "Penilaian",
            'alternatifs' => $alternatifs_with_prestasi,
            'kriterias' => $this->Kriteria_model->tampil(),
            'url_action' => base_url('Penilaian/simpan')
        ];
        $this->load->view('penilaian/form_penilaian', $data);
    }

    public function edit($id_alternatif)
    {
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
    
    public function simpan()
    {
        $this->proses_simpan();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data penilaian berhasil ditambahkan!</div>');
        redirect('Penilaian');
    }
    
    public function update()
    {
        $this->proses_simpan();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data penilaian berhasil diupdate!</div>');
        redirect('Penilaian');
    }

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

            if ($kriteria->kode_kriteria == 'K3') {
                $nilai_final = ($nilai_input == 0) ? 0.1 : $nilai_input;
            } elseif ($kriteria->kode_kriteria == 'K4') {
                $nilai_final = ($nilai_input == 0) ? 0.1 : $nilai_input;
            } else {
                $nilai_final = $nilai_input;
            }

            $cek = $this->Penilaian_model->data_penilaian($id_alternatif, $id_kriteria_saat_ini);
            if ($cek == 0) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria_saat_ini, $nilai_final);
            } else {
                $this->Penilaian_model->edit_penilaian($id_alternatif, $id_kriteria_saat_ini, $nilai_final);
            }
        }
    }

    public function destroy($id_alternatif)
    {
        $this->Penilaian_model->delete_by_alternatif($id_alternatif);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Seluruh data penilaian untuk siswa tersebut berhasil dihapus!</div>');
        redirect('Penilaian');
    }
}