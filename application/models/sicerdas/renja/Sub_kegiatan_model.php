<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_kegiatan_model extends CI_Model
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
                sc_ref_sub_kegiatan.nama_sub_kegiatan like '%".$param['search']."%' 
                OR sc_ref_sub_kegiatan.kode_sub_kegiatan like '%".$param['search']."%' 
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

        $this->db->order_by("renja_sub_kegiatan.id_sub_kegiatan_renja","DESC");

        $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = renja_sub_kegiatan.id_ref_sub_kegiatan","left");
        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = ref_sub_kegiatan.id_kegiatan","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_sub_kegiatan.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = ref_sub_kegiatan.id_urusan","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = ref_sub_kegiatan.id_program","left");
        
        $this->db->join("sc_renstra_kegiatan_indikator renstra_kegiatan_indikator","renstra_kegiatan_indikator.id_indikator_kegiatan = renja_sub_kegiatan.id_indikator_kegiatan","left");
        $this->db->join("sc_renstra_kegiatan renstra_kegiatan","renstra_kegiatan.id_kegiatan = renstra_kegiatan_indikator.id_kegiatan","left");
        $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = renstra_kegiatan.id_indikator_program_renstra","left");
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = program_indikator.id_program_renstra","left");
        
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = program_indikator.id_indikator_sasaran_renstra","left");            
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");
        
        $this->db->join("sc_rpjmd_program_indikator rpjmd_program_indikator","rpjmd_program_indikator.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");

        /* 
        $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = indikator.id_tujuan","left");
        $this->db->join("sc_rpjmd_misi misi","misi.id_misi = tujuan.id_misi","left");
        $this->db->join("sc_rpjmd_visi visi","visi.id_visi = misi.id_visi","left");
        
        $this->db->join("sc_rpjmd_program_indikator rpjmd_program_indikator","rpjmd_program_indikator.id_indikator_program_rpjmd = renstra_program.id_indikator_program_rpjmd","left");
        $this->db->join("sc_rpjmd_program rpjmd_program","rpjmd_program.id_program_rpjmd = rpjmd_program_indikator.id_program_rpjmd","left");
         */
        $query = $this->db->get("sc_renja_sub_kegiatan renja_sub_kegiatan");

        return $query;
    }

    public function getTotal($param=null)
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

        $select = "count(renja_sub_kegiatan.id_sub_kegiatan_renja) as 'total' ";
        
        if(isset($param["group_by"]))
        {
            if($param["group_by"] == "skpd")
            {
                $this->db->group_by("sasaran.id_skpd");
                $select .= ",sasaran.id_skpd";
            }
        }
        $this->db->select($select);

        $query = $this->db->get("sc_renja_sub_kegiatan renja_sub_kegiatan");

        return $query;
    }

    
    


    public function insert($data)
    {
        $cek = $this->db
        ->where("id_indikator_kegiatan",$data['id_indikator_kegiatan'])
        ->where("id_ref_sub_kegiatan",$data['id_ref_sub_kegiatan'])
        ->get("sc_renja_sub_kegiatan");
        if($cek->num_rows()==0)
        {
            $this->db->insert("sc_renja_sub_kegiatan",$data);
            return true;    
        }
        else{
            return false;
        }
       
    }
    public function update($data,$id)
    {
       $this->db->where("id_sub_kegiatan_renja",$id);
       $this->db->update("sc_renja_sub_kegiatan",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_sub_kegiatan($id);

        // delete cascading
        $this->db->where("id_sub_kegiatan_renja",$id)
        ->where("flag","sub_kegiatan")
        ->delete("sc_cascading");

        // delete unit kerja
        $this->db->where("id_sub_kegiatan_renja",$id)->delete("sc_renja_sub_kegiatan_unit_kerja");


        // delete renaksi
        $this->load->model("sicerdas/renja/Renaksi_model");
        $param['where']['indikator.id_sub_kegiatan_renja'] = $id;
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

        $dt_renaksi = $this->Renaksi_model->get($param);
        $ids_renaksi = array();
        foreach($dt_renaksi->result() as $row)
        {
            $ids_renaksi[] = $row->id_renaksi;
        }

        if($ids_renaksi)
        {
            $this->db->where_in("id_renaksi",$ids_renaksi)->delete("sc_renaksi");
        }

        $this->db->where("id_sub_kegiatan_renja",$id)->delete("sc_renja_sub_kegiatan_indikator");
        $this->db->where("id_sub_kegiatan_renja",$id)->delete("sc_renja_sub_kegiatan_unit_kerja");
        $this->db->where("id_sub_kegiatan_renja",$id)->delete("sc_renja_sub_kegiatan");


        return true;
    }

    public function get_unit_kerja($id)
    {
        $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = indikator_unit_kerja.id_unit_kerja","left");
        $this->db->where("id_sub_kegiatan_renja",$id);
        return $this->db->get("sc_renja_sub_kegiatan_unit_kerja indikator_unit_kerja");
    }

    public function getUnitKerja($id_sub_kegiatan_renja)
    {
        $rs = $this->db->where("id_sub_kegiatan_renja",$id_sub_kegiatan_renja)->get("sc_renja_sub_kegiatan_unit_kerja")->result();
        if($rs)
        {
            $unit_kerja = array();
            foreach($rs as $row)
            {
                $unit_kerja[] = $row->id_unit_kerja;
            }
            return $unit_kerja;
        }
        else{
            return [];
        }
    }
}