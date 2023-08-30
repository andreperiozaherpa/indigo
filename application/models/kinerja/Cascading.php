<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cascading extends CI_Model{

	public function get($param=null)
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

        $this->db->join("pegawai","pegawai.id_pegawai = cascading.id_pegawai","left");
        
        $this->db->join("ekinerja_skp skp","skp.id_skp = cascading.id_skp","left");

        // renstra
        $this->db->join("sc_renstra_sasaran sasaran","sasaran.id_sasaran_renstra = cascading.id_sasaran_renstra","left");
        $this->db->join("sc_renstra_sasaran_indikator sasaran_indikator","sasaran_indikator.id_indikator_sasaran_renstra = cascading.id_indikator_sasaran_renstra","left");
        $this->db->join("ref_satuan sasaran_satuan","sasaran_satuan.id_satuan = sasaran_indikator.satuan","left");

        // program
        $this->db->join("sc_renstra_program_indikator program_indikator","program_indikator.id_indikator_program_renstra = cascading.id_indikator_program_renstra","left");
        $this->db->join("ref_satuan program_satuan","program_satuan.id_satuan = program_indikator.satuan","left");
        
        $this->db->join("sc_rpjmd_program_indikator program_indikator_rpjmd","program_indikator_rpjmd.id_indikator_program_rpjmd = program_indikator.id_indikator_program_rpjmd","left");

        $this->db->join("sc_renstra_program program","program.id_program_renstra = cascading.id_program_renstra","left");
        $this->db->join("sc_rpjmd_program program_rpjmd","program_rpjmd.id_program_rpjmd = program.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program_rpjmd.id_ref_program","left");

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

        $this->db->select("cascading.*, pegawai.*, 
            sasaran.nama_sasaran_renstra, sasaran.id_skpd,
            
            ref_program.nama_program,
            program_indikator_rpjmd.nama_indikator_program_rpjmd,

            ref_kegiatan.nama_kegiatan,
            kegiatan_indikator.nama_indikator_kegiatan,

            ref_sub_kegiatan.nama_sub_kegiatan,
            sub_kegiatan_indikator.nama_indikator_sub_kegiatan,
            
            instruksi.nama_instruksi,
            instruksi_satuan.satuan as 'instruksi_satuan',
            instruksi.target as 'instruksi_target',
            instruksi_atasan.nama_instruksi as 'nama_instruksi_atasan',
            

            sasaran_indikator.nama_indikator_sasaran_renstra, 
            sasaran_satuan.satuan as 'sasaran_satuan',
            sasaran_indikator.target_tahun_1 as 'sasaran_target_tahun_1',
            sasaran_indikator.target_tahun_2 as 'sasaran_target_tahun_2',
            sasaran_indikator.target_tahun_3 as 'sasaran_target_tahun_3',
            sasaran_indikator.target_tahun_4 as 'sasaran_target_tahun_4',
            sasaran_indikator.target_tahun_5 as 'sasaran_target_tahun_5',

            program_satuan.satuan as 'program_satuan',
            program_indikator.target_tahun_1 as 'program_target_tahun_1',
            program_indikator.target_tahun_2 as 'program_target_tahun_2',
            program_indikator.target_tahun_3 as 'program_target_tahun_3',
            program_indikator.target_tahun_4 as 'program_target_tahun_4',
            program_indikator.target_tahun_5 as 'program_target_tahun_5',

            kegiatan_satuan.satuan as 'kegiatan_satuan',
            kegiatan_indikator.target_tahun_1 as 'kegiatan_target_tahun_1',
            kegiatan_indikator.target_tahun_2 as 'kegiatan_target_tahun_2',
            kegiatan_indikator.target_tahun_3 as 'kegiatan_target_tahun_3',
            kegiatan_indikator.target_tahun_4 as 'kegiatan_target_tahun_4',
            kegiatan_indikator.target_tahun_5 as 'kegiatan_target_tahun_5',

            sub_kegiatan_satuan.satuan as 'sub_kegiatan_satuan',
            sub_kegiatan_indikator.target as 'sub_kegiatan_target'
            
            
        ");


        $this->db->order_by("cascading.id_pegawai","ASC");
        $this->db->order_by("cascading.id_instruksi","ASC");
        $this->db->order_by("cascading.id_sub_kegiatan_indikator","ASC");
        $this->db->order_by("cascading.id_sub_kegiatan_renja","ASC");
        $this->db->order_by("cascading.id_kegiatan_indikator","ASC");
        $this->db->order_by("cascading.id_kegiatan","ASC");
        $this->db->order_by("cascading.id_indikator_program_renstra","ASC");
        $this->db->order_by("cascading.id_program_renstra","ASC");
        $this->db->order_by("cascading.id_indikator_sasaran_renstra","ASC");
        $this->db->order_by("cascading.id_sasaran_renstra","ASC"); 

        $query = $this->db->get("ekinerja_cascading cascading");

        return $query;
    }

    public function insertFromKinerja($id_cascading, $id_skp)
    {
        $sc_cascading = $this->db->where("id_cascading",$id_cascading)->get("sc_cascading")->row();
        foreach($sc_cascading as $field => $value)
        {
            if(!in_array($field,['id_cascading','tahun','tahun_desc']))
            {
                $this->db->set($field,$value);
            }
        }
        $this->db->set("id_skp",$id_skp);
        $this->db->insert("ekinerja_cascading");
        return $this->db->insert_id();
    }

    public function insertFromInstruksi($id_instruksi, $id_skp)
    {
        $dt_cascading = $this->db->where("id_instruksi",$id_instruksi)->get("sc_cascading")->result();
        foreach($dt_cascading as $sc_cascading)
        {
            foreach($sc_cascading as $field => $value)
            {
                if(!in_array($field,['id_cascading','tahun','tahun_desc']))
                {
                    $this->db->set($field,$value);
                }
            }
            $this->db->set("id_skp",$id_skp);
            $this->db->insert("ekinerja_cascading");
        }
    }

    public function delete_sub_kegiatan_indikator($id_sub_kegiatan_indikator)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_sub_kegiatan_indikator",$id_sub_kegiatan_indikator)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_sub_kegiatan_indikator",$id_sub_kegiatan_indikator)->delete("ekinerja_cascading");
    }

    public function delete_sub_kegiatan($id_sub_kegiatan_renja)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_sub_kegiatan_renja",$id_sub_kegiatan_renja)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_sub_kegiatan_renja",$id_sub_kegiatan_renja)->delete("ekinerja_cascading");
    }


    public function delete_kegiatan_indikator($id_kegiatan_indikator)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_kegiatan_indikator",$id_kegiatan_indikator)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_kegiatan_indikator",$id_kegiatan_indikator)->delete("ekinerja_cascading");
    }

    public function delete_kegiatan($id_kegiatan)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_kegiatan",$id_kegiatan)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("ekinerja_cascading");
    }

    public function delete_indikator_program_renstra($id_indikator_program_renstra)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_indikator_program_renstra",$id_indikator_program_renstra)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_indikator_program_renstra",$id_indikator_program_renstra)->delete("ekinerja_cascading");
    }

    public function delete_program_renstra($id_program_renstra)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_program_renstra",$id_program_renstra)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_program_renstra",$id_program_renstra)->delete("ekinerja_cascading");
    }

    public function delete_indikator_sasaran_renstra($id_indikator_sasaran_renstra)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_indikator_sasaran_renstra",$id_indikator_sasaran_renstra)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_indikator_sasaran_renstra",$id_indikator_sasaran_renstra)->delete("ekinerja_cascading");
    }

    public function delete_sasaran_renstra($id_sasaran_renstra)
    {
    
        $ids_cascading = array();
        $dt_cascading = $this->db
        ->where("id_sasaran_renstra",$id_sasaran_renstra)
        ->get("ekinerja_cascading")->result();

        foreach($dt_cascading as $row)
        {
            $ids_cascading[] = $row->id_cascading;
        }

        $this->delete_cascading($ids_cascading);
        $this->db->where("id_sasaran_renstra",$id_sasaran_renstra)->delete("ekinerja_cascading");
    }


    public function delete_instruksi($id_instruksi)
    {
    
        $ids_instruksi_khusus = array();
        $dt = $this->db
        ->where("id_instruksi",$id_instruksi)
        ->get("ekinerja_instruksi_khusus")->result();

        foreach($dt as $row)
        {
            $ids_instruksi_khusus[] = $row->id_instruksi_khusus;
        }

        if($ids_instruksi_khusus)
        {
            // delete renaksi

            $ids_renaksi = array();
            $dt_renaksi = $this->db->where_in("id_instruksi_khusus",$ids_instruksi_khusus)->get("ekinerja_renaksi")->result();
            foreach($dt_renaksi as $row)
            {
                $ids_renaksi[]  = $row->id_renaksi;
            }

            if($ids_renaksi)
            {
                $this->db->where_in("id_renaksi",$ids_renaksi)->delete("ekinerja_renaksi_detail");    
            }

            $this->db->where_in("id_instruksi_khusus",$ids_instruksi_khusus)->delete("ekinerja_renaksi");

            $this->db->where_in("id_instruksi_khusus",$ids_instruksi_khusus)->delete("ekinerja_capaian");            
        }

        $this->db->where("id_instruksi",$id_instruksi)->delete("ekinerja_instruksi_khusus");

        $this->db->where("id_instruksi",$id_instruksi)->delete("ekinerja_cascading");
    }


    private function delete_cascading($ids_cascading=array())
    {
        if($ids_cascading)
        {

            $ids_kinerja_utama = array();
            $dt_kinerja = $this->db
            ->where_in("id_cascading",$ids_cascading)
            ->get("ekinerja_utama")->result();
    
            foreach($dt_kinerja as $row)
            {
                $ids_kinerja_utama[] = $row->id_kinerja_utama;
            }
    
            if($ids_kinerja_utama)
            {
                // delete renaksi

                $ids_renaksi = array();
                $dt_renaksi = $this->db->where_in("id_kinerja_utama",$ids_kinerja_utama)->get("ekinerja_renaksi")->result();
                foreach($dt_renaksi as $row)
                {
                    $ids_renaksi[]  = $row->id_renaksi;
                }

                if($ids_renaksi)
                {
                    $this->db->where_in("id_renaksi",$ids_renaksi)->delete("ekinerja_renaksi_detail");    
                }

                $this->db->where_in("id_kinerja_utama",$ids_kinerja_utama)->delete("ekinerja_renaksi");

                $this->db->where_in("id_kinerja_utama",$ids_kinerja_utama)->delete("ekinerja_capaian");
            }

            
            $this->db->where_in("id_cascading",$ids_cascading)->delete("ekinerja_utama");
            
        }
    }

    
}