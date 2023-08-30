<?php
class Surat_desa_model extends CI_Controller{
    public function insert($data){
        $this->db->insert('surat_desa',$data);
        return $this->db->insert_id();
    }
}