<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_indikator_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(indikator.nama_indikator_sasaran_renstra like '%".$param['search']."%' )");
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

        $this->db->select("indikator.*, satuan.satuan as 'satuan_desc' ");
        
        $query = $this->db->get("sc_renstra_sasaran_indikator indikator");

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_renstra_sasaran_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_sasaran_renstra",$id);
       $this->db->update("sc_renstra_sasaran_indikator",$data);
    }
    public function delete($id)
    {
        $this->load->model("kinerja/Cascading");
        $this->Cascading->delete_indikator_sasaran_renstra($id);


        $this->db
        ->where("id_indikator_sasaran_renstra",$id)
//        ->where("flag","sasaran")
        ->delete("sc_cascading");

       $this->db->where("id_indikator_sasaran_renstra",$id)->delete("sc_renstra_sasaran_indikator");
       return true;
    }
}