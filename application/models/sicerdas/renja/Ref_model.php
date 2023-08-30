<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_urusan($id_skpd=null)
    {
        if($id_skpd)
        {
            $this->db->where("sasaran.id_skpd",$id_skpd);
        }
        $this->db->select("urusan.*");
        $this->db->group_by("urusan.id_urusan");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = sasaran.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");
        $rs = $this->db->get("sc_renstra_sasaran sasaran");
        return $rs;
    }

    public function get_sub_urusan($id_urusan)
    {
        $this->db->where("id_urusan",$id_urusan);
        $this->db->select("sub_urusan.*");
        $this->db->group_by("sub_urusan.id_sub_urusan");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = sasaran.id_sub_urusan","left");
        $rs = $this->db->get("sc_renstra_sasaran sasaran");
        return $rs;
    }

    public function get_sasaran($id_sub_urusan,$id_skpd=null)
    {
        if($id_skpd)
        {
            $this->db->where("sasaran.id_skpd",$id_skpd);
        }
        $this->db->where("sasaran.id_sub_urusan",$id_sub_urusan);
        $rs = $this->db->get("sc_renstra_sasaran sasaran");
        return $rs;
    }

    
    public function get_sub_kegiatan($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                ref_sub_kegiatan.nama_sub_kegiatan like '%".$param['search']."%' 
                OR ref_sub_kegiatan.kode_sub_kegiatan like '%".$param['search']."%' 
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
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan = ref_sub_kegiatan.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = ref_sub_kegiatan.id_urusan","left");
        
        
        $query = $this->db->get("sc_ref_sub_kegiatan ref_sub_kegiatan");

        return $query;
    }

    public function get_sumber_anggaran()
    {
        $rs = $this->db->get("sigesit_sumber_anggaran");
        return $rs;
    }


    public function get_prioritas_daerah()
    {
        $rs = $this->db->get("sc_ref_prioritas_daerah");
        return $rs;
    }

    public function get_prioritas_nasional()
    {
        $rs = $this->db->get("sc_ref_prioritas_nasional");
        return $rs;
    }
    
}