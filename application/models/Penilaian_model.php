<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penilaian_model extends CI_Model {
      
        public function tambah_penilaian($id_alternatif,$id_kriteria,$nilai)
        {
            $query = $this->db->simple_query("INSERT INTO penilaian VALUES (DEFAULT,'$id_alternatif','$id_kriteria',$nilai);");
            return $query;	
        }
       
        public function edit_penilaian($id_alternatif,$id_kriteria,$nilai)
        {
            $query = $this->db->simple_query("UPDATE penilaian SET nilai=$nilai WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query;	
        }
       
        public function get_kriteria()
        {
            $query = $this->db->get('kriteria');
            return $query->result();
        }
        public function get_alternatif()
        {
            $query = $this->db->query("SELECT * FROM alternatif");
            return $query->result();
        }
        public function get_sub_kriteria()
        {
            $query = $this->db->get('sub_kriteria');
            return $query->result();
        }

        public function data_penilaian($id_alternatif,$id_kriteria)
        {
            $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query->row_array();
        }
        public function untuk_tombol($id_alternatif)
		{
			$query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif';");
			return $query->num_rows();
		}
		public function data_sub_kriteria($id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai DESC;");
			return $query->result_array();
		}

        // FUNGSI BARU UNTUK MENGAMBIL DAFTAR SISWA YANG SUDAH DINILAI
         public function get_alternatif_dinilai()
       {
        $this->db->select('DISTINCT(penilaian.id_alternatif), alternatif.nama');
        $this->db->from('penilaian');
        $this->db->join('alternatif', 'penilaian.id_alternatif = alternatif.id_alternatif');
        $query = $this->db->get();
        return $query->result();
        }

        // FUNGSI BARU UNTUK MENGAMBIL DATA PENILAIAN SPESIFIK BERDASARKAN ID SISWA
	    public function get_penilaian_by_alternatif($id_alternatif)
	    {
		$this->db->where('id_alternatif', $id_alternatif);
		$query = $this->db->get('penilaian');
		return $query->result();
	    }

        // FUNGSI BARU UNTUK MENGAMBIL NILAI SPESIFIK
    public function get_nilai($id_alternatif, $id_kriteria)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->where('id_kriteria', $id_kriteria);
        $query = $this->db->get('penilaian');
        $result = $query->row();
        return ($result) ? $result->nilai : 0; // Jika tidak ada nilai, kembalikan 0
    }
    
    // (Letakkan fungsi ini di dalam class Penilaian_model)

    public function delete_by_alternatif($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->delete('penilaian');
    }

    }
    
    