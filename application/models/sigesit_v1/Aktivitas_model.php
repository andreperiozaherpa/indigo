<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivitas_model extends CI_Model
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
                aktivitas.deskripsi like '%".$param['search']."%' 
            )");
        }

        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }
        
        $this->db->join("user","user.user_id = aktivitas.user_id ","left");
        $this->db->join("pegawai","pegawai.id_pegawai = user.id_pegawai ","left");

        $this->db->select("
            aktivitas.*,
            user.full_name,
            pegawai.foto_pegawai
        ");

        $this->db->order_by("aktivitas.tanggal","ASC");
        
        $query = $this->db->get("sigesit_aktivitas aktivitas");

        return $query;
    }

}