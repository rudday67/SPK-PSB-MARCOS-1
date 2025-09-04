<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_model extends CI_Model {

    // Fungsi untuk menampilkan semua data prestasi
    public function tampil()
    {
        $this->db->select('prestasi.*, alternatif.nama as nama_alternatif');
        $this->db->from('prestasi');
        $this->db->join('alternatif', 'prestasi.id_alternatif = alternatif.id_alternatif');
        $query = $this->db->get();
        return $query->result();
    }

    // Fungsi untuk menyimpan data
    public function insert($data)
    {
        return $this->db->insert('prestasi', $data);
    }

    // Fungsi untuk mengambil data berdasarkan ID
    public function show($id_prestasi)
    {
        return $this->db->where('id_prestasi', $id_prestasi)->get('prestasi')->row();
    }

    // Fungsi untuk mengedit data
    public function update($id_prestasi, $data)
    {
        return $this->db->where('id_prestasi', $id_prestasi)->update('prestasi', $data);
    }

    // Fungsi untuk menghapus data
    public function delete($id_prestasi)
    {
        return $this->db->where('id_prestasi', $id_prestasi)->delete('prestasi');
    }

    // Fungsi untuk menghitung total poin prestasi per siswa
    public function get_total_poin($id_alternatif)
    {
        $this->db->select_sum('nilai_poin');
        $this->db->where('id_alternatif', $id_alternatif);
        $result = $this->db->get('prestasi')->row();
        return ($result->nilai_poin) ? $result->nilai_poin : 0;
    }
}