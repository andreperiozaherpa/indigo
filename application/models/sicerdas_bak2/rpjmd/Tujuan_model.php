<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan_model extends CI_Model
{
    public function get($param=null)
    {

        
        if(!empty($param['where']))
        {
            foreach ($param['where'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        
        $query = $this->db->get("sc_rpjmd_tujuan tujuan");

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_tujuan",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_tujuan",$id);
       $this->db->update("sc_rpjmd_tujuan",$data);
    }
    public function delete($id)
    {
       $this->db->where("id_tujuan",$id)->delete("sc_rpjmd_tujuan");
       return true;
    }
    public function get_by_skpd($id_skpd)
    {
        $this->db->join("sc_rpjmd_program_indikator program_indikator","program_indikator.id_indikator_program_rpjmd = skpd.id_indikator_program_rpjmd ","left");
        $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = program_indikator.id_program_rpjmd ","left");
        $this->db->join("sc_rpjmd_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_rpjmd = program.id_indikator_sasaran_rpjmd ","left");
        $this->db->join("sc_rpjmd_sasaran sasaran","sasaran.id_sasaran_rpjmd = sasaran_indikator.id_sasaran_rpjmd ","left");
        $this->db->join("sc_rpjmd_tujuan_indikator tujuan_indikator","tujuan_indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan ","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = tujuan_indikator.id_tujuan ","left");

        $this->db->group_by("tujuan.id_tujuan");

        $this->db->where("skpd.id_skpd",$id_skpd);

        $this->db->select("tujuan.*");

        $rs = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");
        return $rs;
    }
}