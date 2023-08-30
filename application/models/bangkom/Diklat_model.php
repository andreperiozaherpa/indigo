<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diklat_model extends CI_Model
{
    public function get($param=null,$keyword=null)
    {
      if(!empty($param['where']))
    	{
        $this->db->where($param['where']);
    	}
      if(!empty($param['str_where']))
    	{
        $this->db->where($param['str_where']);
    	}
    	if(!empty($param['like']))
    	{
        $this->db->like($param['like']);
    	}
    	if(isset($param['limit']) && isset($param['offset']))
    	{
    		$this->db->limit($param['limit'],$param['offset']);
    	}

      $this->db->select("*,date_format(jadwal,'%Y-%m') as'jadwal_df' ");

      return $this->db->get("bangkom_diklat");
    }

    

  }
