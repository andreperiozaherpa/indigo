<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renaksi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(renaksi.nama_renaksi like '%".$param['search']."%' )");
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

        $this->db->join("sc_renja_sub_kegiatan_indikator indikator","indikator.id_indikator_sub_kegiatan = renaksi.id_indikator_sub_kegiatan","left");
        
        
        $this->db->select("renaksi.*");

        $query = $this->db->get("sc_renaksi renaksi");    
        
        return $query;
    }

    public function get_detail($param=null)
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

        $this->db->join("sc_renaksi renaksi","renaksi.id_renaksi = detail.id_renaksi","left");
        $this->db->join("sc_renja_sub_kegiatan_indikator indikator","indikator.id_indikator_sub_kegiatan = renaksi.id_indikator_sub_kegiatan","left");
        
        $this->db->select("renaksi.*, detail.*, indikator.metode, indikator.target_min, indikator.target_anggaran_min");

        $this->db->order_by("detail.id_renaksi","ASC");
        $this->db->order_by("detail.month","ASC");

        $query = $this->db->get("sc_renaksi_detail detail");    
        
        return $query;
    }

    public function hitung_capaian($target=0,$realisasi=0,$metode="Maximize",$target_min=null)
    {
        $capaian = 0;

        if($target==0)
        {
            $capaian = 100;
        }
        else{
            if($metode=="Maximize")
            {
                if($realisasi>0){
                    $capaian = ($realisasi/$target)*100;
                }
            }
    
            if($metode=="Minimize" && $target_min)
            {
                $range = $target_min - $target;
                $range_achive = $target_min - $realisasi;
                $capaian = ($range_achive / $range)*100;
            }
    
            if($metode=="Optimize")
            {
                if($realisasi > $target)
                {
                    $capaian = (($target - ($realisasi-$target) ) / $target ) * 100;
                }
                else{
                    if($realisasi>0){
                        $capaian = ($realisasi/$target)*100;
                    }
                }
            }
        }


        return $capaian;
    }
}