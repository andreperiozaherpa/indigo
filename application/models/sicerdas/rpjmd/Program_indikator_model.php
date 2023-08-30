<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_indikator_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(indikator.nama_indikator_program_rpjmd like '%".$param['search']."%' )");
        }

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


        $this->db->order_by("indikator.group_pagu","ASC");
        $this->db->order_by("indikator.sumber_pagu","ASC");
        
        $this->db->select("indikator.*, satuan.satuan as 'satuan_desc' ");

        $query = null;
        if(isset($param['id_skpd']))
        {
            $this->db->join("sc_rpjmd_program_indikator indikator","indikator.id_indikator_program_rpjmd=skpd.id_indikator_program_rpjmd","left");
            $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");
            $this->db->group_by("indikator.id_indikator_program_rpjmd");
            $this->db->where("skpd.id_skpd",$param['id_skpd']);

            if(isset($param['id_ref_program']))
            {
                $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = indikator.id_program_rpjmd","left");
                $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");

                $this->db->where("ref_program.id_ref_program",$param['id_ref_program']);
            }

            $this->db->select("indikator.*, satuan.satuan as 'satuan_desc',  skpd.*");
            $query = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");    
        }
        else{
            $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");

            if(isset($param['id_ref_program']))
            {
                $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = indikator.id_program_rpjmd","left");
                $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");

                $this->db->where("ref_program.id_ref_program",$param['id_ref_program']);
            }

            
            $query = $this->db->get("sc_rpjmd_program_indikator indikator");    
        }
        

        return $query;
    }

    public function get_skpd($id)
    {
        $this->db->join("ref_skpd","ref_skpd.id_skpd = indikator_skpd.id_skpd","left");
        $this->db->where("id_indikator_program_rpjmd",$id);
        return $this->db->get("sc_rpjmd_program_indikator_skpd indikator_skpd");
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_program_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_program_rpjmd",$id);
       $this->db->update("sc_rpjmd_program_indikator",$data);
    }
    public function delete($id)
    {
       $status = $this->db->where("id_indikator_program_rpjmd",$id)->delete("sc_rpjmd_program_indikator");
       return $status;
    }
}