<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan_indikator_model extends CI_Model
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

        $query = null;
        if(isset($param['id_skpd']))
        {
            $this->db->join("sc_rpjmd_program_indikator program_indikator","program_indikator.id_indikator_program_rpjmd = skpd.id_indikator_program_rpjmd ","left");
            $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = program_indikator.id_program_rpjmd ","left");
            $this->db->join("sc_rpjmd_program_sasaran_indikator program_sasaran_indikator","program_sasaran_indikator.id_program_rpjmd = program.id_program_rpjmd ","left");
            $this->db->join("sc_rpjmd_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_rpjmd = program_sasaran_indikator.id_indikator_sasaran_rpjmd ","left");
            $this->db->join("sc_rpjmd_sasaran sasaran","sasaran.id_sasaran_rpjmd = sasaran_indikator.id_sasaran_rpjmd ","left");
            $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan ","left");
            
            $this->db->group_by("indikator.id_indikator_tujuan");

            $this->db->where("skpd.id_skpd",$param['id_skpd']);

            $this->db->select("indikator.*");

            $query = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");    
        }
        else{
            $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");
            $this->db->select("indikator.*, satuan.satuan as 'satuan_desc' ");
            $query = $this->db->get("sc_rpjmd_tujuan_indikator indikator");    
        }
        
        

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_tujuan_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_tujuan",$id);
       $this->db->update("sc_rpjmd_tujuan_indikator",$data);
    }
    public function delete($id)
    {
       $this->db->where("id_indikator_tujuan",$id)->delete("sc_rpjmd_tujuan_indikator");
       return true;
    }
}