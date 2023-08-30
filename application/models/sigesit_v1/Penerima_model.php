<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_dtks($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                dtks.nik like '%".$param['search']."%' 
                OR dtks.nama like '%".$param['search']."%' 
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
        
        $this->db->join("desa","desa.id_desa = dtks.kddesa ","left");

        $this->db->select("
            dtks.*, desa.desa,
            CASE 
                WHEN dtks.jnskel='1' THEN 'Laki-laki'
                ELSE 'Perempuan'
            END as 'jenis_kelamin'
        ");
        
        $query = $this->db->get("sigesit_dtks dtks");

        return $query;
    }


    public function get_temp($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                dtks.nik like '%".$param['search']."%' 
                OR dtks.nama like '%".$param['search']."%' 
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
        
        $this->db->join("sigesit_dtks dtks","dtks.id_dtks = temp.id_dtks ","left");
        $this->db->join("desa","desa.id_desa = dtks.kddesa ","left");

        $this->db->select("dtks.*, desa.desa, temp.*");
        $this->db->order_by("temp.id","DESC");
        $query = $this->db->get("sigesit_penerima_bantuan_temp temp");

        return $query;
    }

    public function get_penerima($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                dtks.nik like '%".$param['search']."%' 
                OR dtks.nama like '%".$param['search']."%' 
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
        
        $this->db->join("sigesit_dtks dtks","dtks.id_dtks = penerima.id_dtks ","left");
        $this->db->join("desa","desa.id_desa = dtks.kddesa ","left");

        $this->db->select("dtks.*, desa.desa, penerima.*, penerima.id_penerima_bantuan as 'id' ");
        $this->db->order_by("penerima.id_penerima_bantuan","DESC");
        $query = $this->db->get("sigesit_penerima_bantuan penerima");

        return $query;
    }

    public function clear_temp($user_id)
    {
        $this->db->where("user_id",$user_id);
        $this->db->delete("sigesit_penerima_bantuan_temp");
    }

    public function add_temp($id_kegiatan,$user_id)
    {
        $dt = $this->db->where("id_kegiatan",$id_kegiatan)->get("sigesit_penerima_bantuan")->result();
        foreach($dt as $row)
        {
            $data = array(
                'id_dtks'   => $row->id_dtks,
                'user_id'   => $user_id,
            );
            $this->db->insert("sigesit_penerima_bantuan_temp",$data);
        }
    }
    
    public function get_total($param)
    {
        $select = "count(penerima.id_penerima_bantuan) as 'total' ";

        if(isset($param['group_by']))
        {
            if($param['group_by']=="id_kegiatan")
            {
                $select .= ", penerima.id_kegiatan";
                $this->db->group_by("penerima.id_kegiatan");
            }
        }

        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        $this->db->select($select);
        return $this->db->get("sigesit_penerima_bantuan penerima");
    }
}