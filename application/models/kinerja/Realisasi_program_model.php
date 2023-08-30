<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_program_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    

    public function getSummary($param)
    {
        $this->db->join("sc_renstra_program_indikator indikator","indikator.id_indikator_program_renstra = realisasi.id_indikator_program_renstra","left");
        

        $select = "avg(realisasi.capaian) as 'capaian', avg(realisasi.capaian_rp) as 'capaian_rp' ";
        if($param['group_by']=="program")
        {
            $this->db->group_by("indikator.id_program_renstra");
            $select .= ", indikator.id_program_renstra";
        }
        else if($param['group_by']=="indikator")
        {
            $this->db->group_by("realisasi.id_indikator_program_renstra");
            $select .= ", realisasi.id_indikator_program_renstra";
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
        $this->db->select($select);

        $query = $this->db->get("sc_renstra_program_realisasi realisasi");
        return $query;
    }

    public function get($param)
    {
        $this->db->join("sc_renstra_program_indikator indikator","indikator.id_indikator_program_renstra = realisasi.id_indikator_program_renstra","left");
        $this->db->join("sc_renstra_program renstra_program","renstra_program.id_program_renstra = indikator.id_program_renstra","left");
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = renstra_program.id_sasaran_renstra","left");

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
        $this->db->select("realisasi.*, indikator.*");

        $query = $this->db->get("sc_renstra_program_realisasi realisasi");
        return $query;
    }

    public function save($post_data)
    {
        $capaian = 0;
        
        if($post_data['hitung_otomatis']=="N")
        {
            $capaian = $post_data['capaian'];
        }
        else{
            $capaian = get_capaian($post_data['target'],$post_data['realisasi'],$post_data['metode']); 
        }

        $capaian_rp = get_capaian($post_data['target_rp'],$post_data['realisasi_rp'],$post_data['metode']);

        $dt = array(
            'capaian'   => $capaian,
            'capaian_rp' => $capaian_rp,
            'id_indikator_program_renstra'  => $post_data['id_indikator_program_renstra'],
            'tahun'       => $post_data['tahun'],
            'tahun_desc'       => $post_data['tahun_desc'],
            'target'       => $post_data['target'],
            'realisasi'       => $post_data['realisasi'],
            'target_rp'       => $post_data['target_rp'],
            'realisasi_rp'       => $post_data['realisasi_rp'],
            'faktor_pendorong'  => !empty($post_data['faktor_pendorong']) ? $post_data['faktor_pendorong'] : null,
            'faktor_penghambat'  => !empty($post_data['faktor_penghambat']) ? $post_data['faktor_penghambat'] : null,
            'tindak_lanjut_rkpd'  => !empty($post_data['tindak_lanjut_rkpd']) ? $post_data['tindak_lanjut_rkpd'] : null,
            'tindak_lanjut_rpjmd'  => !empty($post_data['tindak_lanjut_rpjmd']) ? $post_data['tindak_lanjut_rpjmd'] : null,
        );

        $cek = $this->db
        ->where("id_indikator_program_renstra",$post_data['id_indikator_program_renstra'])
        ->where("tahun",$post_data['tahun'])
        ->get("sc_renstra_program_realisasi");

        if($cek->num_rows()==0)
        {
            return $this->db->insert("sc_renstra_program_realisasi",$dt);
        }
        else{
            $row = $cek->row();
            return $this->db->where("id_realisasi_program",$row->id_realisasi_program)->update("sc_renstra_program_realisasi",$dt);
        }

    }

    private function hitungCapaian($target, $realisasi, $metode="Maximum")
    {
        $capaian = 0;
        if($metode == "Maximum")
        {
            $capaian = $realisasi / $target * 100;
        }
        return $capaian;
    }
}