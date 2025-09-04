<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestasi_model extends CI_Model {

    public function tampil()
    {
        $this->db->select('prestasi.*, alternatif.nama');
        $this->db->from('prestasi');
        $this->db->join('alternatif', 'prestasi.id_alternatif = alternatif.id_alternatif', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insert($data = [])
    {
        $result = $this->db->insert('prestasi', $data);
        return $result;
    }

    public function get_total_poin($id_alternatif)
    {
        $this->db->select_sum('nilai_poin');
        $this->db->where('id_alternatif', $id_alternatif);
        $query = $this->db->get('prestasi');
        return (float)$query->row()->nilai_poin;
    }
    
    /**
     * Mengambil satu baris data prestasi berdasarkan ID-nya.
     * Digunakan untuk halaman edit.
     */
    public function show($id_prestasi)
    {
        $this->db->select('prestasi.*, alternatif.nama');
        $this->db->from('prestasi');
        $this->db->join('alternatif', 'prestasi.id_alternatif = alternatif.id_alternatif', 'left');
        $this->db->where('prestasi.id_prestasi', $id_prestasi);
        $query = $this->db->get();
        return $query->row();
    }
    
    /**
     * Memperbarui data prestasi di database.
     */
    public function update($id_prestasi, $data = [])
    {
        $this->db->where('id_prestasi', $id_prestasi);
        $this->db->update('prestasi', $data);
    }

    /**
     * Menghapus data prestasi dari database.
     */
    public function delete($id_prestasi)
    {
        $this->db->where('id_prestasi', $id_prestasi);
        $this->db->delete('prestasi');
    }
}