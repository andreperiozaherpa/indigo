<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getSummary($param=null)
    {
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

        
        $this->db->join("ekinerja_skp skp","skp.id_skp = capaian.id_skp","left");
        $this->db->join("pegawai","pegawai.id_pegawai = skp.id_pegawai","left");



        $select = "";

        // select data

        if(!empty($param['bulan']))
        {
            if(is_array($param['bulan']))
            {
                $this->db->where_in("capaian.bulan",$param['bulan']);
            }
            else{
                $this->db->where("capaian.bulan",$param['bulan']);
            }

            $this->db->where("capaian.status_jadwal","Y");

        }

        $select = "AVG(capaian) as 'capaian' ";


        if(!empty($param['group_by']))
        {
            if($param['group_by'] == "ASN")
            {
                $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
                $select .= ", skp.id_pegawai, pegawai.nama_lengkap, pegawai.nip, pegawai.jabatan,ref_unit_kerja.nama_unit_kerja" ;
                $this->db->group_by("skp.id_pegawai");
            }

            if($param['group_by'] == "kinerja_utama")
            {
                $select .= ", capaian.id_kinerja_utama" ;
                $this->db->group_by("capaian.id_kinerja_utama");
            }

            if($param['group_by'] == "kinerja_tambahan")
            {
                $select .= ", capaian.id_kinerja_tambahan" ;
                $this->db->group_by("capaian.id_kinerja_tambahan");
            }

            if($param['group_by'] == "instruksi_khusus")
            {
                $select .= ", capaian.id_instruksi_khusus" ;
                $this->db->group_by("capaian.id_instruksi_khusus");
            }
    
            if($param['group_by'] == "skpd")
            {
                $this->db->join("ref_skpd skpd","skpd.id_skpd = pegawai.id_skpd","left");
                $select .= ", skpd.id_skpd, skpd.nama_skpd" ;
                $this->db->group_by("skpd.id_skpd");
            }
    
            if(in_array($param['group_by'],['kegiatan','sub_kegiatan','id_kegiatan_indikator']))
            //if($param['group_by'] == "kegiatan")
            {
                $this->db->where("capaian.id_kinerja_utama is not null");
                $this->db->where("cascading.id_kegiatan is not null");

                    
                $this->db->join("ekinerja_utama kinerja_utama","kinerja_utama.id_kinerja_utama = capaian.id_kinerja_utama","left");
                $this->db->join("ekinerja_cascading cascading","cascading.id_cascading = kinerja_utama.id_cascading","left");
    
                 // renstra
                $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = cascading.id_sasaran_renstra","left");
    
                 // program
                $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = cascading.id_indikator_program_renstra","left");
                $this->db->join("ref_satuan program_satuan","program_satuan.id_satuan = program_indikator.satuan","left");
                $this->db->join("sc_renstra_program program","program.id_program_renstra = cascading.id_program_renstra","left");
                $this->db->join("sc_rpjmd_program program_rpjmd","program_rpjmd.id_program_rpjmd = program.id_program_rpjmd","left");
                $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program_rpjmd.id_ref_program","left");
                $this->db->join("sc_rpjmd_program_indikator program_indikator_rpjmd","program_indikator_rpjmd.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");
                
                // kegiatan
                $this->db->join("sc_renstra_kegiatan kegiatan","kegiatan.id_kegiatan = cascading.id_kegiatan","left");
                $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = kegiatan.id_ref_kegiatan","left");
    
                
                
                $select .= ", 
                pegawai.id_skpd,
                cascading.id_program_renstra, cascading.id_indikator_program_renstra, cascading.id_kegiatan,
                sasaran.nama_sasaran_renstra, ref_program.nama_program,
                program_indikator_rpjmd.nama_indikator_program_rpjmd, 
                ref_kegiatan.nama_kegiatan" ;
    
                if($param['group_by'] == "kegiatan")
                {
                    $this->db->group_by("cascading.id_kegiatan");
                }
                else if($param['group_by'] == "id_kegiatan_indikator")
                {
                    $select .= ",cascading.id_kegiatan_indikator";
                    $this->db->where("cascading.id_kegiatan_indikator is not null");
                    $this->db->group_by("cascading.id_kegiatan_indikator");
                }
                else if($param['group_by'] == "sub_kegiatan")
                {
                    $this->db->where("cascading.id_sub_kegiatan_renja is not null");
    
                    // sub kegiatan
                    $this->db->join("sc_renstra_kegiatan_indikator kegiatan_indikator","kegiatan_indikator.id_indikator_kegiatan = cascading.id_kegiatan_indikator","left");
                    $this->db->join("sc_renja_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan_renja = cascading.id_sub_kegiatan_renja","left");
                    $this->db->join("sc_ref_sub_kegiatan ref_sub_kegiatan","ref_sub_kegiatan.id_sub_kegiatan = sub_kegiatan.id_ref_sub_kegiatan","left");
    
                    $select .= ", ref_sub_kegiatan.nama_sub_kegiatan,
                    kegiatan_indikator.nama_indikator_kegiatan,
                    cascading.id_sub_kegiatan_renja";
    
                    $this->db->group_by("cascading.id_sub_kegiatan_renja");
    
                    $this->db->order_by("cascading.id_kegiatan_indikator","ASC");
                    $this->db->order_by("cascading.id_kegiatan","ASC");
                }
    
                $this->db->order_by("cascading.id_indikator_program_renstra","ASC");
                $this->db->order_by("cascading.id_program_renstra","ASC");
            }

        }



        

        $this->db->select($select);

        $query = $this->db->get("ekinerja_capaian capaian"); 

        return $query;
    }

    public function _capaian_skpd($capaian)
    {
        $desc = "";
        if($capaian > 100)
        {
            $desc = "ISTIMEWA";
        }
        else if($capaian >= 70)
        {
            $desc = "BAIK";
        }
        else if($capaian >= 50)
        {
            $desc = "BUTUH PERBAIKAN";
        }
        else if($capaian >= 30)
        {
            $desc = "KURANG";
        }
        else {
            $desc = "SANGAT KURANG";
        }
        return $desc;
    }

    public function _rating_hasil_kerja($capaian)
    {
        $desc = "";
        if($capaian >= 90)
        {
            $desc = "DIATAS EKSPEKTASI";
        }
        else if($capaian >= 50)
        {
            $desc = "SESUAI EKSPEKTASI";
        }
        else {
            $desc = "DIBAWAH EKSPEKTASI";
        }
        return $desc;
    }

    public function _rating_perilaku($capaian)
    {
        $desc = "";
        if($capaian > 4)
        {
            $desc = "DIATAS EKSPEKTASI";
        }
        else if($capaian >= 3)
        {
            $desc = "SESUAI EKSPEKTASI";
        }
        else {
            $desc = "DIBAWAH EKSPEKTASI";
        }
        return $desc;
    }

    public function _predikat_kinerja($hasil_kerja, $prilaku)
    {
        $desc = "";

        if($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI")
        {
            $desc = "SANGAT BAIK";
        }

        if(
            ($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI") ||
            ($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI") ||
            ($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI")
        )
        {
            $desc = "BAIK";
        }
        
        if(
            ($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI") ||
            ($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI")
        )
        {
            $desc = "BUTUH PERBAIKAN ";
        }

        if(
            ($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI") ||
            ($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI")
        )
        {
            $desc = "KURANG (MISCONDUCT)";
        }

        if($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI")
        {
            $desc = "SANGAT KURANG";
        }

        return $desc;
    }

    public function _get_box($hasil_kerja, $prilaku)
    {
        $box = 1;

        if($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI"){
            $box = 1;
        }
        else if($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI"){
            $box = 2;
        }
        else if($hasil_kerja == "DIBAWAH EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI"){
            $box = 3;
        }
        else if($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI"){
            $box = 4;
        }
        else if($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI"){
            $box = 5;
        }
        else if($hasil_kerja == "SESUAI EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI"){
            $box = 6;
        }
        else if($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="DIBAWAH EKSPEKTASI"){
            $box = 7;
        }
        else if($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="SESUAI EKSPEKTASI"){
            $box = 8;
        }
        else if($hasil_kerja == "DIATAS EKSPEKTASI" && $prilaku=="DIATAS EKSPEKTASI"){
            $box = 9;
        }

        return $box;
    }
}