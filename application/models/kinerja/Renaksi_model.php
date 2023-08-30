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
            $this->db->where("(renaksi.renaksi like '%".$param['search']."%')");
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

        $this->db->join("ekinerja_utama kinerja_utama","kinerja_utama.id_kinerja_utama = renaksi.id_kinerja_utama","left");
        $this->db->join("ekinerja_tambahan kinerja_tambahan","kinerja_tambahan.id_kinerja_tambahan = renaksi.id_kinerja_tambahan","left");
        $this->db->join("ekinerja_instruksi_khusus instruksi_khusus","instruksi_khusus.id_instruksi_khusus = renaksi.id_instruksi_khusus","left");
        $this->db->join("ref_satuan satuan","satuan.id_satuan = renaksi.satuan","left");

        $this->db->select("*, renaksi.id_skp");

        $query = $this->db->get("ekinerja_renaksi renaksi");    
        
        
        

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

        $this->db->join("ekinerja_renaksi renaksi","renaksi.id_renaksi = renaksi_detail.id_renaksi","left");

        $this->join();

        $this->db->where("(
            (renaksi.id_kinerja_utama is not null AND kinerja_utama.id_kinerja_utama is not null)
            OR (renaksi.id_instruksi_khusus is not null AND instruksi_khusus.id_instruksi_khusus is not null)
            OR (renaksi.id_kinerja_tambahan is not null AND kinerja_tambahan.id_kinerja_tambahan is not null)
        )");


        $this->db->select("*, renaksi_detail.target, renaksi_detail.bulan, renaksi_satuan.satuan,
            renaksi_detail.id_renaksi_detail,
            renaksi.id_skp,
            kinerja_tambahan.indikator_kinerja_individu as 'indikator_kinerja_individu_tambahan' 
        ");

        $this->db->order_by("renaksi.id_kinerja_tambahan","ASC");
        $this->db->order_by("renaksi.id_instruksi_khusus","ASC");
        $this->db->order_by("renaksi.id_kinerja_utama","ASC");
        
        $this->db->group_by("renaksi_detail.id_renaksi_detail");

        $query = $this->db->get("ekinerja_renaksi_detail renaksi_detail");    
        
        return $query;
    }

    private function join()
    {
        $this->db->join("ref_satuan renaksi_satuan","renaksi_satuan.id_satuan = renaksi.satuan","left");

        $this->db->join("ekinerja_utama kinerja_utama","kinerja_utama.id_kinerja_utama = renaksi.id_kinerja_utama","left");
        $this->db->join("ekinerja_tambahan kinerja_tambahan","kinerja_tambahan.id_kinerja_tambahan = renaksi.id_kinerja_tambahan","left");
        $this->db->join("ekinerja_instruksi_khusus instruksi_khusus","instruksi_khusus.id_instruksi_khusus = renaksi.id_instruksi_khusus","left");

        $this->db->join("ekinerja_skp skp","skp.id_skp = renaksi.id_skp","left");

        $this->db->join("ekinerja_lkh lkh","lkh.id_renaksi_detail = renaksi_detail.id_renaksi_detail","left");
        $this->db->join("laporan_kerja_harian","(laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian AND laporan_kerja_harian.status_verifikasi ='sudah_diverifikasi')","left");

        // cascading
        $this->db->join("ekinerja_cascading cascading","cascading.id_cascading = kinerja_utama.id_cascading","left");

        // renstra
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = cascading.id_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = cascading.id_indikator_sasaran_renstra","left");
        $this->db->join("ref_satuan sasaran_satuan","sasaran_satuan.id_satuan = sasaran_indikator.satuan","left");

        //instruksi
        $this->db->join("ekinerja_instruksi instruksi","instruksi.id_instruksi = cascading.id_instruksi","left");
        $this->db->join("ref_satuan instruksi_satuan","instruksi_satuan.id_satuan = instruksi.satuan","left");
        $this->db->join("ekinerja_instruksi instruksi_atasan","instruksi_atasan.id_instruksi = instruksi.id_instruksi_atasan","left");

        // kegiatan
        $this->db->join("sc_renstra_kegiatan kegiatan","kegiatan.id_kegiatan = cascading.id_kegiatan","left");
        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = kegiatan.id_ref_kegiatan","left");

        $this->db->join("sc_renstra_kegiatan_indikator kegiatan_indikator","kegiatan_indikator.id_indikator_kegiatan = cascading.id_kegiatan_indikator","left");
        $this->db->join("ref_satuan kegiatan_satuan","kegiatan_satuan.id_satuan = kegiatan_indikator.satuan","left");

        // sub kegiatan
        $this->db->join("sc_renja_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan_renja = cascading.id_sub_kegiatan_renja","left");
        $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = sub_kegiatan.id_ref_sub_kegiatan","left");

        $this->db->join("sc_renja_sub_kegiatan_indikator sub_kegiatan_indikator","sub_kegiatan_indikator.id_indikator_sub_kegiatan = cascading.id_sub_kegiatan_indikator","left");
        $this->db->join("ref_satuan sub_kegiatan_satuan","sub_kegiatan_satuan.id_satuan = sub_kegiatan_indikator.satuan","left");
    }
    
    public function insert($data)
    {
       $this->db->insert("ekinerja_renaksi",$data);
    }
    public function update($data,$id)
    {
       $this->db->where("id_renaksi",$id);
       $this->db->update("ekinerja_renaksi",$data);
    }
    public function delete($id)
    {
        $param['where']['renaksi_detail.id_renaksi'] = $id;
        $dt_detail = $this->get_detail($param)->result();

        $ids_renaksi_detail = array();
        foreach($dt_detail as $row)
        {
            $ids_renaksi_detail[] = $row->id_renaksi_detail;
        }

        if($ids_renaksi_detail)
        {
            // delete LKH

            $dt_lkh = $this->db->where_in("id_renaksi_detail",$ids_renaksi_detail)->get("ekinerja_lkh")->result();
            $ids_laporan_kerja_harian = array();
            foreach($dt_lkh as $lkh)
            {
                $ids_laporan_kerja_harian[] = $lkh->id_laporan_kerja_harian;
            }

            if($ids_laporan_kerja_harian)
            {
                $this->db->where_in("id_laporan_kerja_harian",$ids_laporan_kerja_harian)->delete("laporan_kerja_harian");
            }

            $this->db->where_in("id_renaksi_detail",$ids_renaksi_detail)->delete("ekinerja_lkh");
        }
        
        // delete detail
        $this->db->where("id_renaksi",$id)->delete("ekinerja_renaksi_detail");

        // delete renaksi
        $status = $this->db->where("id_renaksi",$id)->delete("ekinerja_renaksi");
        return $status;
    }

    public function updateCapaianRenaksi($id_renaksi_detail,$capaian_lkh)
    {
        $this->db
        ->set("capaian_lkh",$capaian_lkh)
        ->where("id_renaksi_detail",$id_renaksi_detail)
        ->update("ekinerja_renaksi_detail");
    }
}