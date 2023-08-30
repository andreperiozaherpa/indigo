<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cascading_model extends CI_Model{

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

        $query = $this->db->get("sc_cascading cascading");

        return $query;
    }

}