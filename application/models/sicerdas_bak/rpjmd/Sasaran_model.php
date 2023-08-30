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