<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_kegiatan_indikator_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(indikator.nama_indikator_sub_kegiatan like '%".$param['search']."%' )");
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

        $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");

        $this->db->join("sc_renja_sub_kegiatan renja_sub_kegiatan","indikator.id_sub_kegiatan_renja = renja_sub_kegiatan.id_sub_kegiatan_renja","left");
        $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = renja_sub_kegiatan.id_ref_sub_kegiatan","left");
        
        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = ref_sub_kegiatan.id_kegiatan","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_sub_kegiatan.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = ref_sub_kegiatan.id_urusan","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = ref_sub_kegiatan.id_program","left");
        
        $this->db->join("sc_renstra_kegiatan_indikator renstra_kegiatan_indikator","renstra_kegiatan_indikator.id_indikator_kegiatan = renja_sub_kegiatan.id_indikator_kegiatan","left");
        $this->db->join("sc_renstra_kegiatan renstra_kegiatan","renstra_kegiatan.id_kegiatan = renstra_kegiatan_indikator.id_kegiatan","left");
        $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = renstra_kegiatan.id_indikator_program_renstra","left");
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = program_indikator.id_program_renstra","left");
        
        //$this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = renstra_program.id_indikator_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");
        $this->db->join("ref_skpd skpd","skpd.id_skpd = sasaran.id_skpd","left");


        $this->db->select("indikator.*, 
        renja_sub_kegiatan.tahun,
        ref_sub_kegiatan.*,
        sasaran.id_skpd,
        skpd.nama_skpd,
        urusan.nama_urusan,
        ref_program.nama_program,
        ref_program.id_ref_program,
        ref_kegiatan.id_ref_kegiatan,
        ref_kegiatan.nama_kegiatan,
        satuan.satuan as 'satuan_desc' ");


        $query = $this->db->get("sc_renja_sub_kegiatan_indikator indikator");    
        
        
        

        return $query;
    }

    
    
    public function insert($data)
    {
       $this->db->insert("sc_renja_sub_kegiatan_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_sub_kegiatan",$id);
       $this->db->update("sc_renja_sub_kegiatan_indikator",$data);
    }
    public function delete($id)
    {

        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_sub_kegiatan_indikator($id);

        $this->db
        ->where("id_sub_kegiatan_indikator",$id)
        ->where("flag","sub_kegiatan")
        ->delete("sc_cascading");

        // delete renaksi
        $this->load->model("sicerdas/renja/Renaksi_model");
        $param['where']['indikator.id_indikator_sub_kegiatan'] = $id;
        $dt_renaksi_detail = $this->Renaksi_model->get_detail($param);
        $ids_renaksi_detail = array();
        foreach($dt_renaksi_detail->result() as $row)
        {
            $ids_renaksi_detail[] = $row->id_renaksi_detail;
        }

        if($ids_renaksi_detail)
        {
            $this->db->where_in("id_renaksi_detail",$ids_renaksi_detail)->delete("sc_renaksi_detail");
        }
        $this->db->where("id_indikator_sub_kegiatan",$id)->delete("sc_renaksi");

        $status = $this->db->where("id_indikator_sub_kegiatan",$id)->delete("sc_renja_sub_kegiatan_indikator");
        return $status;
    }
}