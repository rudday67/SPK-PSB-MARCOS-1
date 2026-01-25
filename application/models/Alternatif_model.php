<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif_model extends CI_Model {

    public function tampil()
    {
        $query = $this->db->get('alternatif');
        return $query->result();
    }
    
    public function getTotal()
    {
        return $this->db->count_all('alternatif');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('alternatif', $data);
        return $result;
    }

    public function show($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $query = $this->db->get('alternatif');
        return $query->row();
    }

    public function update($id_alternatif, $data = [])
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->update('alternatif', $data);
    }
    
    public function delete($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->delete('alternatif');
    }
    
    // ======================================================================
    // ===== FUNGSI BARU YANG DIBUTUHKAN ADA DI SINI =====
    // ======================================================================
    public function get_alternatif_belum_dinilai()
    {
        $this->db->select('id_alternatif, nama');
        $this->db->from('alternatif');
        $this->db->where("id_alternatif NOT IN (SELECT id_alternatif FROM penilaian GROUP BY id_alternatif)", NULL, FALSE);
        return $this->db->get()->result();
    }
//verifikasi
    public function update_verifikasi($id_alternatif, $status)
{
    $this->db->where('id_alternatif', $id_alternatif);
    return $this->db->update('alternatif', ['status_verifikasi' => $status]);
}
    public function verifikasi_semua()
{
    // Mengubah semua data alternatif menjadi status_verifikasi = 1
    return $this->db->update('alternatif', ['status_verifikasi' => 1]);
}
public function batal_verifikasi_semua()
{
    // Mengubah semua data alternatif menjadi status_verifikasi = 0
    return $this->db->update('alternatif', ['status_verifikasi' => 0]);
}
}