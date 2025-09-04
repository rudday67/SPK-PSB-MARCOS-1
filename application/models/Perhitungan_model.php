<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan_model extends CI_Model {

    // Fungsi bantu privat untuk mengambil semua data mentah sekaligus
    private function get_all_data() {
        $data['kriterias']   = $this->db->get('kriteria')->result();
        $data['alternatifs'] = $this->db->get('alternatif')->result();
        $data['penilaian']   = $this->db->get('penilaian')->result();
        return $data;
    }

    // FUNGSI UTAMA UNTUK MENGHITUNG DAN MENDAPATKAN HASIL AKHIR
    public function get_hasil()
    {
        $this->db->empty_table('hasil');
        $all_data = $this->get_all_data();
        $kriterias = $all_data['kriterias'];
        $alternatifs = $all_data['alternatifs'];

        if (empty($kriterias) || empty($alternatifs) || empty($all_data['penilaian'])) {
            return []; // Kembalikan array kosong jika data tidak lengkap
        }
        
        // 1. Matriks Keputusan (X)
        $matriks_x = [];
        foreach ($alternatifs as $alt) { // Inisialisasi
            foreach ($kriterias as $kri) { $matriks_x[$alt->id_alternatif][$kri->id_kriteria] = 0; }
        }
        foreach($all_data['penilaian'] as $pen) { // Isi nilai
            if (isset($matriks_x[$pen->id_alternatif][$pen->id_kriteria])) {
                $matriks_x[$pen->id_alternatif][$pen->id_kriteria] = $pen->nilai;
            }
        }

        // 2. Matriks Ideal (AI) dan Anti-Ideal (AAI)
        $ideal = []; $anti_ideal = [];
        foreach ($kriterias as $kri) {
            $column_values = array_column($matriks_x, $kri->id_kriteria);
            if (empty($column_values)) {
                $ideal[$kri->id_kriteria] = 0;
                $anti_ideal[$kri->id_kriteria] = 0;
                continue;
            }
            if ($kri->jenis == 'Benefit') {
                $ideal[$kri->id_kriteria] = max($column_values);
                $anti_ideal[$kri->id_kriteria] = min($column_values);
            } else { // Cost
                $ideal[$kri->id_kriteria] = min($column_values);
                $anti_ideal[$kri->id_kriteria] = max($column_values);
            }
        }

        // 3. Normalisasi & Pembobotan
        $matriks_terbobot = [];
        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $kri) {
                $pembagi = $ideal[$kri->id_kriteria];
                $nilai_x = $matriks_x[$alt->id_alternatif][$kri->id_kriteria];
                $normalisasi = 0;
                if ($pembagi != 0) {
                    $normalisasi = ($kri->jenis == 'Benefit') ? ($nilai_x / $pembagi) : ($pembagi / ($nilai_x ?: 1));
                }
                $matriks_terbobot[$alt->id_alternatif][$kri->id_kriteria] = $normalisasi * $kri->bobot;
            }
        }
        
        // 4. Hitung Utilitas dan Nilai Akhir (Ki)
        $s_values = []; $k_plus = []; $k_minus = [];
        foreach($alternatifs as $alt) { $s_values[$alt->id_alternatif] = array_sum($matriks_terbobot[$alt->id_alternatif]); }
        $sum_s = array_sum($s_values);
        foreach($alternatifs as $alt) {
            $k_plus[$alt->id_alternatif] = ($sum_s != 0) ? ($s_values[$alt->id_alternatif] / $sum_s) : 0;
            $k_minus[$alt->id_alternatif] = ($sum_s != 0) ? ($s_values[$alt->id_alternatif] / $sum_s) : 0;
        }

        foreach ($alternatifs as $alt) {
            $id_alt = $alt->id_alternatif; $kp = $k_plus[$id_alt]; $km = $k_minus[$id_alt];
            $ki = 0;
            if ($kp > 0 && $km > 0) {
                $pembagi_ki = (1 + ((1 - $kp) / $kp) + ((1 - $km) / $km));
                if ($pembagi_ki != 0) { $ki = ($kp + $km) / $pembagi_ki; }
            }
            $this->db->insert('hasil', ['id_alternatif' => $id_alt, 'nilai' => $ki]);
        }
        
        // 5. Ambil hasil akhir yang sudah diurutkan
        $this->db->select('alternatif.nama, hasil.nilai')->from('hasil')->join('alternatif', 'hasil.id_alternatif = alternatif.id_alternatif')->order_by('hasil.nilai', 'DESC');
        return $this->db->get()->result();
    }
}