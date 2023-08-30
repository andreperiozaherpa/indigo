<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function total_digunakan($id_kegiatan=null)
    {
        if($id_kegiatan)
        {
            $this->db->where("id_kegiatan",$id_kegiatan);
        }
        $this->db->select("sum(total) as 'total' ");
        $rs = $this->db->get("sigesit_realisasi_anggaran")->row();
        return $rs;
    }

    public function get_total_pagu($kode_sub_kegiatan,$tahun)
    {
        $this->db->select("sum(jumlah_pagu) as 'total' ");
        $this->db->where("tahun_pagu",$tahun);
        $this->db->where(" (kode_kodering LIKE '%".$kode_sub_kegiatan."%' ) ");
        $rs = $this->db->get("sipd_master_pagu")->row();

        if($rs)
        {
            return $rs->total;
        }
        else{
            return 0;
        }
    }

    public function get_total($param)
    {
        $select = "sum(realisasi.total) as 'total' ";

        if(isset($param['group_by']))
        {
            if($param['group_by']=="id_kegiatan")
            {
                $select .= ", realisasi.id_kegiatan";
                $this->db->group_by("realisasi.id_kegiatan");
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
        return $this->db->get("sigesit_realisasi_anggaran realisasi");
    }
}