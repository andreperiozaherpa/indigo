<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
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
                ref_kegiatan.nama_kegiatan like '%".$param['search']."%' 
                OR ref_kegiatan.kode_kegiatan like '%".$param['search']."%' 
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


        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = renstra_kegiatan.id_ref_kegiatan","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_kegiatan.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");

        $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = renstra_kegiatan.id_indikator_program_renstra","left");
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = program_indikator.id_program_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = program_indikator.id_indikator_sasaran_renstra","left");            
        
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");
        $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = indikator.id_tujuan","left");
        $this->db->join("sc_rpjmd_misi misi","misi.id_misi = tujuan.id_misi","left");
        $this->db->join("sc_rpjmd_visi visi","visi.id_visi = misi.id_visi","left");
        
        $this->db->join("sc_rpjmd_program_indikator rpjmd_program_indikator","rpjmd_program_indikator.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");
        $this->db->join("sc_rpjmd_program rpjmd_program","rpjmd_program.id_program_rpjmd = renstra_program.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = rpjmd_program.id_ref_program","left");

        
        $query = $this->db->get("sc_renstra_kegiatan renstra_kegiatan");

        return $query;
    }

    
    public function get_ref($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                ref_kegiatan.nama_kegiatan like '%".$param['search']."%' 
                OR ref_kegiatan.kode_kegiatan like '%".$param['search']."%' 
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
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_kegiatan.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");
        
        
        $query = $this->db->get("sc_ref_kegiatan ref_kegiatan");

        return $query;
    }


    public function insert($data)
    {
        $cek = $this->db
        ->where("id_indikator_program_renstra",$data['id_indikator_program_renstra'])
        ->where("id_ref_kegiatan",$data['id_ref_kegiatan'])
        ->get("sc_renstra_kegiatan");
        if($cek->num_rows()==0)
        {
            $this->db->insert("sc_renstra_kegiatan",$data);
            return true;    
        }
        else{
            return false;
        }
       
    }
    public function update($data,$id)
    {
       $this->db->where("id_kegiatan",$id);
       $this->db->update("sc_renstra_kegiatan",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_kegiatan($id);

        // delete cascading
        $this->db->where("id_kegiatan",$id)
        ->where_in("flag",["kegiatan","sub_kegiatan"])
        ->delete("sc_cascading");

        // delete unit kerja
        $this->db->where("id_kegiatan",$id)->delete("sc_renstra_kegiatan_unit_kerja");

       $this->db->where("id_kegiatan",$id)->delete("sc_renstra_kegiatan");
       return true;
    }

    public function getUnitKerja($id_kegiatan,$field='')
    {
        $rs = $this->db
        ->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = sc_renstra_kegiatan_unit_kerja.id_unit_kerja","left")
        ->where("id_kegiatan",$id_kegiatan)->get("sc_renstra_kegiatan_unit_kerja")->result();
        if($rs)
        {
            $unit_kerja = array();
            foreach($rs as $row)
            {
                $unit_kerja[] = ($field!='') ? $row->$field : $row->id_unit_kerja;
            }
            return $unit_kerja;
        }
        else{
            return [];
        }
    }
}