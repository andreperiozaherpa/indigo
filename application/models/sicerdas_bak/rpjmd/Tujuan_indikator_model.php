<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan_indikator_model extends CI_Model
{
    public function get($param=null)
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
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        
        $query = $this->db->get("sc_rpjmd_tujuan_indikator indikator");

        return $query;
    }

    public function insert($data)
    {
       $this->db->insert("sc_rpjmd_tujuan_indikator",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_indikator_tujuan",$id);
       $this->db->update("sc_rpjmd_tujuan_indikator",$data);
    }
    public function delete($id)
    {
       $this->db->where("id_indikator_tujuan",$id)->delete("sc_rpjmd_tujuan_indikator");
       return true;
    }
}