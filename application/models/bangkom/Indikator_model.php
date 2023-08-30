<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator_model extends CI_Model
{
    public function get($param=null,$keyword=null)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}

      $this->db->order_by("bangkom_indikator.nama_kompetensi","ASC");
      $this->db->order_by("bangkom_indikator.id_indikator","ASC");

      $this->db->join("ref_skpd","ref_skpd.id_skpd = bangkom_indikator.id_skpd","left");
      $this->db->select("bangkom_indikator.*, ref_skpd.nama_skpd");

      return $this->db->get("bangkom_indikator");
    }

  }
