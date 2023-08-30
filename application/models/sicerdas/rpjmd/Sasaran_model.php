<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(sasaran.nama_sasaran_rpjmd like '%".$param['search']."%' )");
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

        $this->db->join("sc_rpjmd_tujuan_indikator indikator","indikator.id_indikator_tujuan = sasaran.id_indikator_tujuan","left");
        $this->db->join("sc_rpjmd_tujuan tujuan","tujuan.id_tujuan = indikator.id_tujuan","left");
        $this->db->join("sc_rpjmd_misi misi","misi.id_misi = tujuan.id_misi","left");
        $this->db->join("sc_rpjmd_visi visi","visi.id_visi = misi.id_visi","left");
        

        $this->db->select("sasaran.*, 
            indikator.nama_indikator_tujuan, indikator.id_indikator_tujuan,
            tujuan.tujuan, tujuan.id_tujuan,
            misi.misi, misi.id_misi,
            visi.visi");

        
        $query = $this->db->get("sc_rpjmd_sasaran sasaran");

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_sasaran",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_sasaran_rpjmd",$id);
       $this->db->update("sc_rpjmd_sasaran",$data);
    }
    public function delete($id)
    {
       $this->db->where("id_sasaran_rpjmd",$id)->delete("sc_rpjmd_sasaran");
       return true;
    }
}