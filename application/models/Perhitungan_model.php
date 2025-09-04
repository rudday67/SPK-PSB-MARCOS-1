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
        
        // 4. Hitung S ideal (Sai) dan S anti-ideal (Saai)
        // Langkah ini belum ada di kodemu dan sangat penting.
        $matriks_terbobot_ideal = [];
        $matriks_terbobot_anti_ideal = [];
        foreach ($kriterias as $kri) {
            $pembagi_ideal = $ideal[$kri->id_kriteria];
            $pembagi_anti_ideal = $anti_ideal[$kri->id_kriteria];
            
            // Hitung Normalisasi untuk Solusi Ideal (AI)
            $normalisasi_ideal = 0;
            if ($pembagi_ideal != 0) {
                $normalisasi_ideal = ($kri->jenis == 'Benefit') ? ($ideal[$kri->id_kriteria] / $pembagi_ideal) : ($pembagi_ideal / $ideal[$kri->id_kriteria]);
            }
            $matriks_terbobot_ideal[$kri->id_kriteria] = $normalisasi_ideal * $kri->bobot;

            // Hitung Normalisasi untuk Solusi Anti-Ideal (AAI)
            $normalisasi_anti_ideal = 0;
            if ($pembagi_ideal != 0) {
                 $normalisasi_anti_ideal = ($kri->jenis == 'Benefit') ? ($anti_ideal[$kri->id_kriteria] / $pembagi_ideal) : ($pembagi_ideal / $anti_ideal[$kri->id_kriteria]);
            }
            $matriks_terbobot_anti_ideal[$kri->id_kriteria] = $normalisasi_anti_ideal * $kri->bobot;
        }

        $s_ideal = array_sum($matriks_terbobot_ideal);
        $s_anti_ideal = array_sum($matriks_terbobot_anti_ideal);

        // 5. Hitung Utilitas K+ dan K-
        $s_values = [];
        foreach($alternatifs as $alt) {
            $s_values[$alt->id_alternatif] = array_sum($matriks_terbobot[$alt->id_alternatif]);
        }

        $k_plus = [];
        $k_minus = [];
        foreach($alternatifs as $alt) {
            $id_alt = $alt->id_alternatif;
            // Ini adalah rumus K+ dan K- yang benar
            $k_plus[$id_alt] = ($s_ideal != 0) ? ($s_values[$id_alt] / $s_ideal) : 0;
            $k_minus[$id_alt] = ($s_anti_ideal != 0) ? ($s_values[$id_alt] / $s_anti_ideal) : 0;
        }

        // 6. Hitung Fungsi Utilitas f(K) dan Nilai Akhir (Ki)
        foreach ($alternatifs as $alt) {
            $id_alt = $alt->id_alternatif;
            $kp = $k_plus[$id_alt];
            $km = $k_minus[$id_alt];
            
            // Rumus Fungsi Utilitas f(Ki)
            $penyebut_f_ki = $kp + $km;
            $f_kp = ($penyebut_f_ki != 0) ? $km / $penyebut_f_ki : 0; // f(K+)
            $f_km = ($penyebut_f_ki != 0) ? $kp / $penyebut_f_ki : 0; // f(K-)

            // Rumus Nilai Akhir Ki
            $pembilang_ki = $kp + $km;
            $penyebut_ki = 1 + ((1 - $f_kp) / $f_kp) + ((1 - $f_km) / $f_km);
            
            $ki = 0; // Nilai default jika terjadi pembagian dengan nol
            if($penyebut_ki != 0 && $f_kp > 0 && $f_km > 0) {
                $ki = $pembilang_ki / $penyebut_ki;
            }
            
            $this->db->insert('hasil', ['id_alternatif' => $id_alt, 'nilai' => $ki]);
        }
        
        // 7. Ambil hasil akhir yang sudah diurutkan
        $this->db->select('alternatif.nama_alternatif, hasil.nilai');
        $this->db->from('hasil');
        $this->db->join('alternatif', 'hasil.id_alternatif = alternatif.id_alternatif');
        $this->db->order_by('hasil.nilai', 'DESC');
        return $this->db->get()->result();
    }
}
