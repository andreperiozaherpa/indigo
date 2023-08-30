<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urusan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_urusan()
    {
        return $this->db->get("sc_ref_urusan");
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                sub_urusan.kode_sub_urusan like '%".$param['search']."%' 
                OR sub_urusan.nama_sub_urusan like '%".$param['search']."%' 
                OR urusan.nama_urusan like '%".$param['search']."%' 
                OR urusan.bidang like '%".$param['search']."%' 
                OR urusan.kode_urusan like '%".$param['search']."%' 
                
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

        $this->db->join("sc_ref_urusan urusan","urusan.id_urusan = sub_urusan.id_urusan","left");

        
        $query = $this->db->get("sc_ref_sub_urusan sub_urusan");

        return $query;
    }

    
}