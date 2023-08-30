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
            $this->db->where("(indikator.nama_indikator_program_renstra like '%".$param['search']."%' )");
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

       
        $this->db->join("sc_rpjmd_program_indikator program_indikator","program_indikator.id_indikator_program_rpjmd = indikator.id_indikator_program_rpjmd","left");            
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = indikator.id_indikator_sasaran_renstra","left");            
        $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");   
        
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = indikator.id_program_renstra","left");
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");
        $this->db->join("ref_skpd skpd","skpd.id_skpd = sasaran.id_skpd","left");

        $this->db->join("sc_rpjmd_program rpjmd_program","rpjmd_program.id_program_rpjmd = renstra_program.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = rpjmd_program.id_ref_program","left");
        
        $this->db->select("indikator.*,
        ref_program.kode_program, ref_program.nama_program,
        sasaran.nama_sasaran_renstra, skpd.nama_skpd,
        program_indikator.nama_indikator_program_rpjmd as 'nama_indikator_program_renstra',
        sasaran_indikator.nama_indikator_sasaran_renstra,
        sasaran_indikator.id_sasaran_renstra,
        satuan.satuan as 'satuan_desc' ");


        $query = $this->db->get("sc_renstra_program_indikator indikator");    
        
        return $query;
    }

    public function get_unit_kerja($id)
    {
        $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = indikator_unit_kerja.id_unit_kerja","left");
        $this->db->where("id_indikator_program_renstra",$id);
        return $this->db->get("sc_renstra_program_indikator_unit_kerja indikator_unit_kerja");
    }

    
    public function insert($data)
    {
       $this->db->insert("sc_renstra_program_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_program_renstra",$id);
       $this->db->update("sc_renstra_program_indikator",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_indikator_program_renstra($id);

        $this->db
        ->where("id_indikator_program_renstra",$id)
        ->where_in("flag",["program","kegiatan","sub_kegiatan"])
        ->delete("sc_cascading");
        
       $status = $this->db->where("id_indikator_program_renstra",$id)->delete("sc_renstra_program_indikator");
       return $status;
    }
}