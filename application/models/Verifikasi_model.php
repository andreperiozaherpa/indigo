<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class verifikasi_model extends CI_Model
{

	function get_by_no_surat($no_surat)
    {
        $this->db->where('nomer_surat',$no_surat);

        $this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
        $this->db->join('ref_surat','ref_surat.id_ref_surat = surat_keluar.id_ref_surat');
        $query  =  $this->db->get('surat_keluar');
        return $query->row();
    }

    function get_by_hash_id($hash_id)
    {   
        $this->db->select('surat_keluar.*, ref_skpd.*, ref_surat.nama_surat');
        $this->db->where('hash_id',$hash_id);
        $this->db->join('ref_skpd', 'surat_keluar.id_skpd_pengirim = ref_skpd.id_skpd');
        $this->db->join('ref_surat','ref_surat.id_ref_surat = surat_keluar.id_ref_surat');
        $query  =  $this->db->get('surat_keluar');
        $row =  $query->row();
        if(!empty($row)){
            
        $row->jenis_surat = 'surat_'.$row->jenis_surat;
        }
        return $row;
    }

}
?>