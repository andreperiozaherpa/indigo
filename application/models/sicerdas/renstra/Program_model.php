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


        //$this->db->join("sc_rpjmd_program_indikator program_indikator","program_indikator.id_indikator_program_rpjmd = renstra_program.id_indikator_program_rpjmd","left");
        $this->db->join("sc_rpjmd_program rpjmd_program","rpjmd_program.id_program_rpjmd = renstra_program.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = rpjmd_program.id_ref_program","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_program.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");

        //$this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = renstra_program.id_indikator_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");
        $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = indikator.id_tujuan","left");
        $this->db->join("sc_rpjmd_misi misi","misi.id_misi = tujuan.id_misi","left");
        $this->db->join("sc_rpjmd_visi visi","visi.id_visi = misi.id_visi","left");


        $this->db->select("*,sub_urusan.id_sub_urusan as 'id_sub_urusan' ");
        
        $query = $this->db->get("sc_renstra_program renstra_program");

        return $query;
    }

    public function get_by_skpd($id_skpd)
    {

        $this->db->join("sc_rpjmd_program_indikator program_indikator","program_indikator.id_indikator_program_rpjmd = skpd.id_indikator_program_rpjmd ","left");
        $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = program_indikator.id_program_rpjmd ","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");

        $this->db->group_by("program.id_program_rpjmd");

        $this->db->where("skpd.id_skpd",$id_skpd);

        $this->db->select("program.*, ref_program.*");

        $rs = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");
        return $rs;
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
        $this->db->insert("sc_renstra_program",$data);
        return true;    
       
    }
    public function update($data,$id)
    {
       $this->db->where("id_program_renstra",$id);
       $this->db->update("sc_renstra_program",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_program_renstra($id);

        // delete cascading
        $this->db->where("id_program_renstra",$id)
        ->where_in("flag",["program","kegiatan","sub_kegiatan"])
        ->delete("sc_cascading");

        // delete unit kerja
        $this->db->where("id_program_renstra",$id)->delete("sc_renstra_program_unit_kerja");

        $this->db->where("id_program_renstra",$id)->delete("sc_renstra_program");
        return true;
    }

    public function get_indikator_rpjmd($param)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        $this->db->join("sc_rpjmd_program_indikator","sc_rpjmd_program_indikator.id_indikator_program_rpjmd = indikator.id_indikator_program_rpjmd","left");
        $rs = $this->db->get("sc_renstra_program_indikator_rpjmd indikator");
        return $rs;
    }

    public function get_indikator_sasaran($param)
    {
        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        $this->db->join("sc_renstra_sasaran_indikator","sc_renstra_sasaran_indikator.id_indikator_sasaran_renstra = indikator.id_indikator_sasaran_renstra","left");
        $rs = $this->db->get("sc_renstra_program_indikator_sasaran indikator");
        return $rs;
    }

    public function getUnitKerja($id_program_renstra)
    {
        $rs = $this->db->where("id_program_renstra",$id_program_renstra)->get("sc_renstra_program_unit_kerja")->result();
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