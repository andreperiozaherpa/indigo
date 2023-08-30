<?php
class Ref_jenis_cuti_model extends CI_Model{
    public function get_all(){
        return $this->db->get('pc_ref_jenis_cuti')->result();
    }
}