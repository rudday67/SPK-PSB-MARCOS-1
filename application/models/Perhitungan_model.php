<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan_model extends CI_Model {
public function get_hasil()
{
    // Mengosongkan tabel 'hasil' untuk perhitungan baru
    $this->db->empty_table('hasil');
    
    // Mengambil semua data mentah yang diperlukan dari database
    $kriterias = $this->db->get('kriteria')->result();
    $alternatifs = $this->db->get('alternatif')->result();
    $penilaian_raw = $this->db->get('penilaian')->result();

    // Pengecekan awal, jika salah satu data penting kosong, hentikan proses
    if (empty($kriterias) || empty($alternatifs) || empty($penilaian_raw)) {
        return [];
    }

    // --- LANGKAH 1: Membangun Matriks Keputusan (X) ---
    // Mengubah format data penilaian mentah agar mudah diakses berdasarkan [id_alternatif][id_kriteria]
    $penilaian = [];
    foreach ($penilaian_raw as $p) {
        $penilaian[$p->id_alternatif][$p->id_kriteria] = (float)$p->nilai;
    }
    
    // Membuat matriks X, yaitu tabel virtual berisi nilai setiap alternatif pada setiap kriteria
    $matriks_x = [];
    foreach ($alternatifs as $alt) {
        foreach ($kriterias as $kri) {
            // Jika siswa punya nilai, gunakan. Jika tidak, anggap 0.
            $matriks_x[$alt->id_alternatif][$kri->id_kriteria] = $penilaian[$alt->id_alternatif][$kri->id_kriteria] ?? 0;
        }
    }

    // --- LANGKAH 2: Menentukan Solusi Ideal (AI) dan Anti-Ideal (AAI) ---
    // Mencari nilai terbaik (ideal) dan terburuk (anti-ideal) untuk setiap kriteria sebagai pembanding
    $ideal = []; 
    $anti_ideal = [];
    foreach ($kriterias as $kri) {
        // Mengambil semua nilai dari satu kriteria (satu kolom di matriks X)
        $column_values = array_column($matriks_x, $kri->id_kriteria);
        if (empty($column_values)) {
            $ideal[$kri->id_kriteria] = 0; $anti_ideal[$kri->id_kriteria] = 0; continue;
        }
        
        // Jika jenis kriteria 'Benefit', nilai ideal adalah yang terbesar (max)
        if ($kri->jenis == 'Benefit') {
            $ideal[$kri->id_kriteria] = max($column_values);
            $anti_ideal[$kri->id_kriteria] = min($column_values);
        } else { // Jika 'Cost', nilai ideal adalah yang terkecil (min)
            $ideal[$kri->id_kriteria] = min($column_values);
            $anti_ideal[$kri->id_kriteria] = max($column_values);
        }
    }

    // --- LANGKAH 3: Melakukan Normalisasi Matriks Keputusan ---
    // Mengubah setiap nilai dalam matriks X menjadi skala 0-1 berdasarkan nilai ideal dan anti-ideal
    $matriks_normalisasi = [];
    foreach ($alternatifs as $alt) {
        foreach ($kriterias as $kri) {
            $nilai_x = $matriks_x[$alt->id_alternatif][$kri->id_kriteria];
            $normalisasi = 0;

            if ($kri->jenis == 'Benefit') {
                $pembagi = $ideal[$kri->id_kriteria];
                if ($pembagi != 0) { $normalisasi = $nilai_x / $pembagi; }
            } else { // Rumus normalisasi untuk 'Cost' berbeda
                if ($nilai_x != 0) { $normalisasi = $anti_ideal[$kri->id_kriteria] / $nilai_x; }
            }
            $matriks_normalisasi[$alt->id_alternatif][$kri->id_kriteria] = $normalisasi;
        }
    }
    
    // --- LANGKAH 4: Menghitung Matriks Terbobot ---
    // Mengalikan setiap nilai yang sudah dinormalisasi dengan bobot kriteria masing-masing
    $matriks_terbobot = [];
    foreach ($alternatifs as $alt) {
        foreach ($kriterias as $kri) {
            $nilai_normalisasi = $matriks_normalisasi[$alt->id_alternatif][$kri->id_kriteria];
            $matriks_terbobot[$alt->id_alternatif][$kri->id_kriteria] = $nilai_normalisasi * (float)$kri->bobot;
        }
    }
    
    // --- LANGKAH 5: Menghitung Nilai S (Sum) untuk Setiap Alternatif, S_ideal, dan S_anti_ideal ---
    // Menjumlahkan semua nilai terbobot untuk setiap alternatif (Si)
    $s_values = [];
    foreach($alternatifs as $alt) { 
        $s_values[$alt->id_alternatif] = array_sum($matriks_terbobot[$alt->id_alternatif]);
    }

    // Menghitung nilai S untuk solusi ideal (S_ideal)
    $s_ideal_components = [];
    foreach ($kriterias as $kri) {
        $bobot = (float)$kri->bobot;
        if ($kri->jenis == 'Benefit') {
            $s_ideal_components[$kri->id_kriteria] = 1 * $bobot;
        } else { // Cost
            $pembagi = $anti_ideal[$kri->id_kriteria];
            $s_ideal_components[$kri->id_kriteria] = ($pembagi != 0) ? ($ideal[$kri->id_kriteria] / $pembagi) * $bobot : 0;
        }
    }
    $s_ideal = array_sum($s_ideal_components);

    // Menghitung nilai S untuk solusi anti-ideal (S_anti_ideal)
    $s_anti_ideal_components = [];
    foreach ($kriterias as $kri) {
        $bobot = (float)$kri->bobot;
        if ($kri->jenis == 'Benefit') {
            $pembagi = $ideal[$kri->id_kriteria];
            $s_anti_ideal_components[$kri->id_kriteria] = ($pembagi != 0) ? ($anti_ideal[$kri->id_kriteria] / $pembagi) * $bobot : 0;
        } else { // Cost
             $s_anti_ideal_components[$kri->id_kriteria] = 1 * $bobot;
        }
    }
    $s_anti_ideal = array_sum($s_anti_ideal_components);


    // --- LANGKAH 6: Menghitung Nilai Utilitas (K+ dan K-) ---
    // Membandingkan nilai S setiap alternatif dengan S_ideal dan S_anti_ideal
    $k_plus = []; 
    $k_minus = [];
    foreach($alternatifs as $alt) {
        $id_alt = $alt->id_alternatif;
        $k_plus[$id_alt] = ($s_ideal != 0) ? ($s_values[$id_alt] / $s_ideal) : 0;
        $k_minus[$id_alt] = ($s_anti_ideal != 0) ? ($s_values[$id_alt] / $s_anti_ideal) : 0;
    }

    // --- LANGKAH 7: Menghitung Nilai Akhir (Ki) dan Menyimpan Hasil ---
    // Menggabungkan semua nilai utilitas menjadi satu skor akhir (Ki) untuk setiap alternatif
    foreach ($alternatifs as $alt) {
        $id_alt = $alt->id_alternatif;
        $kp = $k_plus[$id_alt]; 
        $km = $k_minus[$id_alt];
        
        // Menghitung fungsi utilitas f(K+) dan f(K-)
        $penyebut_f_ki = $kp + $km;
        $f_kp = ($penyebut_f_ki != 0) ? $km / $penyebut_f_ki : 0;
        $f_km = ($penyebut_f_ki != 0) ? $kp / $penyebut_f_ki : 0;

        // Menghitung nilai Ki
        $ki = 0;
        if($f_kp > 0 && $f_km > 0) {
            $pembilang_ki = $kp + $km;
            $penyebut_ki = 1 + ((1 - $f_kp) / $f_kp) + ((1 - $f_km) / $f_km);
            if($penyebut_ki != 0) { 
                $ki = $pembilang_ki / $penyebut_ki; 
            }
        }
        
        // Menyimpan hasil akhir ke dalam tabel 'hasil'
        $this->db->insert('hasil', ['id_alternatif' => $id_alt, 'nilai' => $ki]);
    }
    
    $this->db->select('alternatif.id_alternatif, alternatif.nama, alternatif.status_verifikasi, alternatif.rank_pimpinan, hasil.nilai');
        $this->db->from('hasil');
        $this->db->join('alternatif', 'hasil.id_alternatif = alternatif.id_alternatif');
        $this->db->order_by('CASE WHEN alternatif.rank_pimpinan IS NULL THEN 1 ELSE 0 END', 'ASC', FALSE);
        $this->db->order_by('alternatif.rank_pimpinan', 'ASC');
        $this->db->order_by('hasil.nilai', 'DESC');
        return $this->db->get()->result();
    }

    // TAMBAHKAN DI SINI (Di bawah fungsi get_hasil)
    public function get_hasil_laporan()
    {
        $this->db->select('alternatif.id_alternatif, alternatif.nama, alternatif.status_verifikasi, alternatif.rank_pimpinan, hasil.nilai');
        $this->db->from('hasil');
        $this->db->join('alternatif', 'hasil.id_alternatif = alternatif.id_alternatif');
        
        // Filter: Hanya yang sudah di-ACC (verifikasi) pimpinan
        $this->db->where('alternatif.status_verifikasi', 1); 
        
        // Urutan: Mengikuti keputusan pimpinan (Rank Akhir)
        $this->db->order_by('CASE WHEN alternatif.rank_pimpinan IS NULL THEN 1 ELSE 0 END', 'ASC', FALSE);
        $this->db->order_by('alternatif.rank_pimpinan', 'ASC');
        $this->db->order_by('hasil.nilai', 'DESC');
        
        return $this->db->get()->result();
    }
}