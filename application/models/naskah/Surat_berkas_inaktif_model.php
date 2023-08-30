<?php


class Surat_berkas_inaktif_model extends CI_Model {

    public $id_surat_berkas,
            $nama_berkas,
            $id_surat_klasifikasi,
            $kategori_berkas,
            $arsip_vital,
            $arsip_terjaga,
            $mkb,
            $uraian,
            $lokasi_fisik,
            $status_berkas,
            $status_pinjam,
            $status_pindah,
            $nomor_berkas,
            $id_skpd;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function get_all_file_inactive(){
        $this->db->select('*');
        $this->db->from('surat_berkas');
	    $this->db->join('surat_klasifikasi', 'surat_berkas.id_surat_klasifikasi = surat_klasifikasi.id_surat_klasifikasi');
        $this->db->where('surat_berkas.status_berkas', "inaktif");
        // $this->db->where('id_skpd', "inaktif");
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_all_file_musnah(){
        $this->db->select('*');
        $this->db->from('surat_berkas');
	    $this->db->join('surat_klasifikasi', 'surat_berkas.id_surat_klasifikasi = surat_klasifikasi.id_surat_klasifikasi');
        $this->db->where('surat_berkas.status_berkas', "musnah");
        // $this->db->where('id_skpd', "inaktif");
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_all_file_pemindahan(){
        $this->db->select('*');
        $this->db->from('surat_berkas');
	    $this->db->join('surat_klasifikasi', 'surat_berkas.id_surat_klasifikasi = surat_klasifikasi.id_surat_klasifikasi');
        $this->db->where('surat_berkas.status_berkas', "pemindahan");
        // $this->db->where('id_skpd', "inaktif");
        $query = $this->db->get();
        return $query->result_array();

    }
    public function get_all_file_permanen(){
        $this->db->select('*');
        $this->db->from('surat_berkas');
	    $this->db->join('surat_klasifikasi', 'surat_berkas.id_surat_klasifikasi = surat_klasifikasi.id_surat_klasifikasi');
        $this->db->where('surat_berkas.status_berkas', "permanen");
        // $this->db->where('id_skpd', "inaktif");
        $query = $this->db->get();
        return $query->result_array();

    }


}