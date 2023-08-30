<?php
class Ref_persyaratan_model extends CI_Model
{
    public function get_by_jenis($id_ref_jenis_cuti)
    {
        $detail = $this->db->get_where('pc_ref_jenis_cuti', ['id_ref_jenis_cuti' => $id_ref_jenis_cuti])->row();
        if ($detail->persyaratan == "Y") {
            $this->db->group_start();
            $this->db->or_where('pc_ref_persyaratan.id_ref_jenis_cuti', $id_ref_jenis_cuti);
            $this->db->or_where('pc_ref_persyaratan.id_ref_jenis_cuti', 0);
            $this->db->group_end();
            $get = $this->db->get('pc_ref_persyaratan')->result();
            return $get;
        } else {
            return array();
        }
    }
}
