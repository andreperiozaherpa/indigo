<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_indikator_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(indikator.nama_indikator_kegiatan like '%".$param['search']."%' )");
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

        $this->db->join("sc_renstra_kegiatan renstra_kegiatan","renstra_kegiatan.id_kegiatan = indikator.id_kegiatan","left");
        $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = renstra_kegiatan.id_indikator_program_renstra","left");
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = program_indikator.id_program_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = program_indikator.id_indikator_sasaran_renstra","left");            
        
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");

        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = renstra_kegiatan.id_ref_kegiatan","left");

        $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");            
        $this->db->select("indikator.*, satuan.satuan as 'satuan_desc',
        ref_kegiatan.nama_kegiatan,
        sasaran.nama_sasaran_renstra
        ");


        $query = $this->db->get("sc_renstra_kegiatan_indikator indikator");    
        
        
        

        return $query;
    }

    public function get_unit_kerja($id)
    {
        $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = indikator_unit_kerja.id_unit_kerja","left");
        $this->db->where("id_indikator_kegiatan",$id);
        return $this->db->get("sc_renstra_kegiatan_indikator_unit_kerja indikator_unit_kerja");
    }

    
    public function insert($data)
    {
       $this->db->insert("sc_renstra_kegiatan_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_kegiatan",$id);
       $this->db->update("sc_renstra_kegiatan_indikator",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_kegiatan_indikator($id);

        $this->db
        ->where("id_kegiatan_indikator",$id)
        ->where_in("flag",["kegiatan","sub_kegiatan"])
        ->delete("sc_cascading");
        
       $status = $this->db->where("id_indikator_kegiatan",$id)->delete("sc_renstra_kegiatan_indikator");
       return $status;
    }
}