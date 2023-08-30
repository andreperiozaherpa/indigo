<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capaian_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function init($data)
    {
        if(!isset($data['tahun']) || !isset($data['tahun_desc']) || (!empty($data['tahun']) && $data['tahun'] == 0 ))
        {
            $skp = $this->db->where("id_skp",$data['id_skp'])->get("ekinerja_skp")->row();
            $data['tahun'] = $skp->tahun;
            $data['tahun_desc'] = $skp->tahun_desc;
        }

        for($i=1;$i<=12;$i++)
        {
            $data['bulan'] = $i;

            $this->db->where("id_skp",$data['id_skp']);
            $this->db->where("bulan",$i);
            if(!empty($data['id_kinerja_utama']))
            {
                $this->db->where("id_kinerja_utama",$data['id_kinerja_utama']);
            }
            else if(!empty($data['id_instruksi_khusus']))
            {
                $this->db->where("id_instruksi_khusus",$data['id_instruksi_khusus']);
            }
            else if(!empty($data['id_kinerja_tambahan']))
            {
                $this->db->where("id_kinerja_tambahan",$data['id_kinerja_tambahan']);
            }

            $cek = $this->db->get("ekinerja_capaian");

            if($cek->num_rows() == 0)
            {
                $data['capaian'] = null;
                $this->db->insert("ekinerja_capaian",$data);
            }
            

        }
    }

    public function update($data)
    {
        $id = $value = "";
        
        $bulan = $data->bulan;
        $id_skp = $data->id_skp;

        if(!empty($data->id_kinerja_utama))
        {
            $id = "id_kinerja_utama";
            $value = $data->id_kinerja_utama;
        }
        else if(!empty($data->id_instruksi_khusus))
        {
            $id = "id_instruksi_khusus";
            $value = $data->id_instruksi_khusus;
        }
        else if(!empty($data->id_kinerja_tambahan))
        {
            $id = "id_kinerja_tambahan";
            $value = $data->id_kinerja_tambahan;
        }

        

        if($id!="")
        {
            $capaian = 0;
            $status_jadwal = "N";

            $this->db->select("avg(capaian_lkh) as 'capaian' ");
            $this->db->where("renaksi.".$id,$value);
            $this->db->where("renaksi_detail.bulan",$bulan);
            $this->db->where("renaksi_detail.status_jadwal","Y");
            $this->db->join("ekinerja_renaksi renaksi","renaksi.id_renaksi = renaksi_detail.id_renaksi","left");
            $summary = $this->db->get("ekinerja_renaksi_detail renaksi_detail")->row();
            
            if($summary && $summary->capaian)
            {
                $capaian = $summary->capaian;
                $status_jadwal = "Y";
            }



            $update = array(
                'capaian'       => $capaian,
                'status_jadwal' => $status_jadwal
            );
            

            if(!empty($data->tahun))
            {
                $update['tahun'] = $data->tahun;
            }

            if(!empty($data->tahun_desc))
            {
                $update['tahun_desc'] = $data->tahun_desc;
            }
    
            $this->db
            ->where($id,$value)
            ->where("bulan",$bulan)
            ->where("id_skp",$id_skp)
            ->update("ekinerja_capaian",$update);


            // hitung ulang skp..
            /* $this->load->model("kinerja/Skp_model");
            $this->Skp_model->hitung_capaian($id_skp); */

            //echo "<pre>";print_r($summary);

        }

    }

    /* public function getSummary($param=null)
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


        $this->db->join("ekinerja_renaksi renaksi","renaksi.id_renaksi = renaksi_detail.id_renaksi","left");
        
        $this->db->join("ekinerja_skp skp","skp.id_skp = renaksi.id_skp","left");
        $this->db->join("pegawai","pegawai.id_pegawai = skp.id_pegawai","left");

        

        $select = "";

        // select data

        if(!empty($param['bulan']))
        {
            if(is_array($param['bulan']))
            {
                $this->db->where_in("renaksi_detail.bulan",$param['bulan']);
            }
            else{
                $this->db->where("renaksi_detail.bulan",$param['bulan']);
            }
            $select = "AVG(capaian_lkh) as 'capaian' ";
        }
        else{
            $select = "AVG(capaian_lkh) as 'capaian' ";
        }

        // rating
        $this->db->join("ekinerja_lkh lkh","renaksi_detail.id_renaksi_detail = lkh.id_renaksi_detail","left");
        $this->db->join("laporan_kerja_harian_rating rating","lkh.id_laporan_kerja_harian = rating.id_laporan_kerja_harian","left");

        $select .= ", AVG(rating) as 'rating',
            CASE 
                WHEN AVG(rating) >= 5 THEN 'Sangat Puas'
                WHEN (AVG(rating) >= 4 AND AVG(rating) < 5) THEN 'Puas'
                WHEN (AVG(rating) >= 3 AND AVG(rating) < 4) THEN 'Cukup Puas' 
                WHEN (AVG(rating) >= 2 AND AVG(rating) < 3) THEN 'Tidak Puas'
                WHEN AVG(rating) <= 1 THEN 'Kecewa'
            END as 'rating_desc'
        ";

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
                $select .= ", renaksi.id_kinerja_utama" ;
                $this->db->group_by("renaksi.id_kinerja_utama");
            }

            if($param['group_by'] == "kinerja_tambahan")
            {
                $select .= ", renaksi.id_kinerja_tambahan" ;
                $this->db->group_by("renaksi.id_kinerja_tambahan");
            }

            if($param['group_by'] == "instruksi_khusus")
            {
                $select .= ", renaksi.id_instruksi_khusus" ;
                $this->db->group_by("renaksi.id_instruksi_khusus");
            }
    
            if($param['group_by'] == "skpd")
            {
                $this->db->join("ref_skpd skpd","skpd.id_skpd = pegawai.id_skpd","left");
                $select .= ", skpd.id_skpd, skpd.nama_skpd" ;
                $this->db->group_by("skpd.id_skpd");
            }
    
            if(in_array($param['group_by'],['kegiatan','sub_kegiatan','id_kegiatan_indikator']))
            {
                $this->db->where("renaksi.id_kinerja_utama is not null");
                $this->db->where("cascading.id_kegiatan is not null");

                    
                $this->db->join("ekinerja_utama kinerja_utama","kinerja_utama.id_kinerja_utama = renaksi.id_kinerja_utama","left");
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

        if(!empty($param['bulan']))
        {
            $this->db->where("renaksi_detail.status_jadwal","Y");
            $query = $this->db->get("ekinerja_renaksi_detail renaksi_detail");    
        }
        else{ 
            $query = $this->db->get("ekinerja_renaksi_detail renaksi_detail");    
        }
        
        return $query;
    } */
}