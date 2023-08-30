<?php
class Ref_ket_absen_model extends CI_Model{
    public function get_all(){
        return $this->db->get('ref_ket_absen')->result();
    }
    public function get($param)
    {
      if(isset($param['where']))
      {
        $this->db->where($param['where']);
      }
      $rs = $this->db->get('ref_ket_absen');
      return $rs;
    }

    public function get_by_id($id_ket_absen){
      return $this->db->get_where('ref_ket_absen',array('id_ket_absen'=>$id_ket_absen))->row();
    }
}
