<?php
class Ref_persyaratan_model extends CI_Model{
    public function get_all(){
        $get = $this->db->get('ic_ref_persyaratan')->result();
        return $get;
    }
}