<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model{

	public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(pegawai.nama_lengkap like '%".$param['search']."%' || pegawai.nip like '%".$param['search']."%' )");
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

        $this->db->where("pegawai.pensiun",0);

        $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
        $this->db->join("ref_skpd","ref_skpd.id_skpd = pegawai.id_skpd","left");

        if(isset($param['select']))
        {
            $this->db->select($param['select']);
        }

        $query = $this->db->get("pegawai");

        return $query;
    }

}