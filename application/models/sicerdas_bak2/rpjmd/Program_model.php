<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                ref_program.nama_program like '%".$param['search']."%' 
                OR ref_program.kode_program like '%".$param['search']."%' 
            )");
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
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_program.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");
        $this->db->join("sc_rpjmd_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_rpjmd = program.id_indikator_sasaran_rpjmd","left");
        $this->db->join("sc_rpjmd_sasaran sasaran","sasaran.id_sasaran_rpjmd = sasaran_indikator.id_sasaran_rpjmd","left");
        $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = indikator.id_tujuan","left");
        $this->db->join("sc_rpjmd_misi misi","misi.id_misi = tujuan.id_misi","left");
        $this->db->join("sc_rpjmd_visi visi","visi.id_visi = misi.id_visi","left");
        
        
        $query = $this->db->get("sc_rpjmd_program program");

        return $query;
    }

    public function get_ref($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                ref_program.nama_program like '%".$param['search']."%' 
                OR program.kode_program like '%".$param['search']."%' 
            )");
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
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_program.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");
        
        
        $query = $this->db->get("sc_ref_program ref_program");

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_program",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_program_rpjmd",$id);
       $this->db->update("sc_rpjmd_program",$data);
    }
    public function delete($id)
    {
       $this->db->where("id_program_rpjmd",$id)->delete("sc_rpjmd_program");
       return true;
    }
}