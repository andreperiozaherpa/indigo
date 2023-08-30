<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function generate($id_skpd=null)
    {
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/rpjmd/Misi_model");
        $this->load->model("sicerdas/rpjmd/Tujuan_model");
        $this->load->model("sicerdas/rpjmd/Tujuan_indikator_model");
        $this->load->model("sicerdas/renstra/Sasaran_model");
        $this->load->model("sicerdas/renstra/Sasaran_indikator_model");
        $this->load->model("sicerdas/renstra/Program_model");
        $this->load->model("sicerdas/renstra/Program_indikator_model");
        $this->load->model("sicerdas/renstra/Kegiatan_model");
        $this->load->model("sicerdas/renstra/Kegiatan_indikator_model");

        $dt_tahun = $this->Globalvar->get_tahun();
        $data = array();

        $index = 0;
        
        $index_tujuan = 0;
        $nama_tujuan = '';

        $index_sasaran = 0;
        $nama_sasaran = '';

        // misi
        $dt_misi = $this->Misi_model->get();
        foreach($dt_misi as $m => $misi)
        {
            
            $target_awal = '';

            $target_tahun = array();
            foreach($dt_tahun as $t => $tahun)
            {
                $col_tahun = array(
                    'target'        => '',
                    'satuan'        => '',
                    'rp'            => '',
                );
                $target_tahun[] = $col_tahun;
            }


            $target_akhir = array(
                'target'        => '',
                'satuan'        => '',
                'rp'            => '',
            );


            $unit_kerja = '';
            $lokasi = '';

            $column = array(
                'level'             => 0,
                'misi'              => 'Misi '.($m+1).' : ' . $misi->misi,
                'tujuan'            => '',
                'sasaran'           => '',
                'kode'              => '',
                'program_kegiatan'  => '',
                'indikator'         => '',
                'target_awal'       => $target_awal,
                'target_tahun'      => $target_tahun,
                'target_akhir'      => $target_akhir, 
                'unit_kerja'        => $unit_kerja,
                'lokasi'            => $lokasi,
            );
            $data[] = $column;
            $index++;

            // tujuan
            $param_tujuan['where']['tujuan.id_misi'] = $misi->id_misi;
            $dt_tujuan = $this->Tujuan_model->get($param_tujuan);
            foreach($dt_tujuan->result() as $tujuan)
            {
                
                // indikator tujuan
                $param_indikator_tujuan['where']['indikator.id_tujuan'] = $tujuan->id_tujuan;
                $param_indikator_tujuan['id_skpd'] = $id_skpd;
                $dt_indikator_tujuan = $this->Tujuan_indikator_model->get($param_indikator_tujuan);
                
                if($dt_indikator_tujuan->num_rows()==0){
                    $target_awal = '';
                    $target_tahun = array();
                    foreach($dt_tahun as $t => $tahun)
                    {
                        $col_tahun = array(
                            'target'        => '',
                            'rp'            => ''
                        );
                        $target_tahun[] = $col_tahun;
                    }


                    $target_akhir = array(
                        'target'        => '',
                        'rp'            => '',
                    );


                    $unit_kerja = '';
                    $lokasi = '';

                    $column = array(
                        'level'             => 1,
                        'misi'              => '',
                        'tujuan'            => $tujuan->tujuan,
                        'sasaran'           => '',
                        'kode'              => '',
                        'program_kegiatan'  => '',
                        'indikator'         => '',
                        'target_awal'       => $target_awal,
                        'target_tahun'      => $target_tahun,
                        'target_akhir'      => $target_akhir, 
                        'unit_kerja'        => $unit_kerja,
                        'lokasi'            => $lokasi,
                    );
                    $data[] = $column;

                    if($nama_tujuan != $tujuan->tujuan)
                    {
                        $nama_tujuan = $tujuan->tujuan;
                        $index_tujuan = $index;
                        $data[$index]['rowspans_tujuan'] = 1;
                    }
                    else{
                        $data[$index_tujuan]['rowspans_tujuan']++;
                    }

                    $index++;
                }

                
                foreach($dt_indikator_tujuan->result() as $it => $indikator_tujuan)
                {
                    

                    $target_awal = $indikator_tujuan->target_awal;

                    $target_tahun = array();
                    foreach($dt_tahun as $t => $tahun)
                    {

                        $_target = "target_tahun_".($t+1);
                        $col_tahun = array(
                            'target'        => $indikator_tujuan->$_target,
                            'rp'            => '',
                        );
                        $target_tahun[] = $col_tahun;
                    }


                    $target_akhir = array(
                        'target'        => $indikator_tujuan->target_akhir,
                        'rp'            => '',
                    );


                    $unit_kerja = '';
                    $lokasi = '';

                    $column = array(
                        'level'             => 2,
                        'misi'              => '',
                        'tujuan'            => $tujuan->tujuan,
                        'sasaran'           => '',
                        'kode'              => '',
                        'program_kegiatan'  => '',
                        'indikator'         => $indikator_tujuan->nama_indikator_tujuan,
                        'target_awal'       => $target_awal,
                        'target_tahun'      => $target_tahun,
                        'target_akhir'      => $target_akhir, 
                        'unit_kerja'        => $unit_kerja,
                        'lokasi'            => $lokasi,
                    );
                    $data[] = $column;

                    if($nama_tujuan != $tujuan->tujuan)
                    {
                        $nama_tujuan = $tujuan->tujuan;
                        $index_tujuan = $index;
                        $data[$index]['rowspans_tujuan'] = 1;
                    }
                    else{
                        $data[$index_tujuan]['rowspans_tujuan']++;
                    }

                    $index++;


                    // sasaran
                    $param_sasaran['where']['sasaran.id_indikator_tujuan'] = $indikator_tujuan->id_indikator_tujuan;
                    $param_sasaran['where']['sasaran.id_skpd'] = $id_skpd;
                    $dt_sasaran = $this->Sasaran_model->get($param_sasaran);
                    
                    foreach($dt_sasaran->result() as $s => $sasaran)
                    {

                        // indikator sasaran
                        $param_indikator_sasaran['where']['indikator.id_sasaran_renstra'] = $sasaran->id_sasaran_renstra;
                        $dt_indikator_sasaran = $this->Sasaran_indikator_model->get($param_indikator_sasaran);                        

                        if($dt_indikator_sasaran->num_rows()==0){

                            $target_awal = '';
                            $target_tahun = array();
                            foreach($dt_tahun as $t => $tahun)
                            {
                                $col_tahun = array(
                                    'target'        => '',
                                    'rp'            => '',
                                );
                                $target_tahun[] = $col_tahun;
                            }


                            $target_akhir = array(
                                'target'        => '',
                                'rp'            => '',
                            );


                            $unit_kerja = '';
                            $lokasi = '';

                            $column = array(
                                'level'             => 3,
                                'misi'              => '',
                                'tujuan'            => $tujuan->tujuan,
                                'sasaran'           => $sasaran->nama_sasaran_renstra,
                                'kode'              => '',
                                'program_kegiatan'  => '',
                                'indikator'         => '',
                                'target_awal'       => $target_awal,
                                'target_tahun'      => $target_tahun,
                                'target_akhir'      => $target_akhir, 
                                'unit_kerja'        => $unit_kerja,
                                'lokasi'            => $lokasi,
                            );
                            $data[] = $column;

                            if($nama_tujuan != $tujuan->tujuan)
                            {
                                $nama_tujuan = $tujuan->tujuan;
                                $index_tujuan = $index;
                                $data[$index]['rowspans_tujuan'] = 1;
                            }
                            else{
                                $data[$index_tujuan]['rowspans_tujuan']++;
                            }

                            if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                            {
                                $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                $index_sasaran = $index;
                                $data[$index]['rowspans_sasaran'] = 1;
                            }
                            else{
                                $data[$index_sasaran]['rowspans_sasaran']++;
                            }

                            $index++;

                        }

                        foreach($dt_indikator_sasaran->result() as $is => $indikator_sasaran)
                        {
                            $target_awal = $indikator_sasaran->target_awal;

                            $target_tahun = array();
                            foreach($dt_tahun as $t => $tahun)
                            {

                                $_target = "target_tahun_".($t+1);
                                $col_tahun = array(
                                    'target'        => $indikator_sasaran->$_target,
                                    'rp'            => '',
                                );
                                $target_tahun[] = $col_tahun;
                            }


                            $target_akhir = array(
                                'target'        => $indikator_sasaran->target_akhir,
                                'rp'            => '',
                            );


                            $unit_kerja = '';
                            $lokasi = '';

                            $column = array(
                                'level'             => 4,
                                'misi'              => '',
                                'tujuan'            => $tujuan->tujuan,
                                'sasaran'           => $sasaran->nama_sasaran_renstra,
                                'kode'              => '',
                                'program_kegiatan'  => '',
                                'indikator'         => $indikator_sasaran->nama_indikator_sasaran_renstra,
                                'target_awal'       => $target_awal,
                                'target_tahun'      => $target_tahun,
                                'target_akhir'      => $target_akhir, 
                                'unit_kerja'        => $unit_kerja,
                                'lokasi'            => $lokasi,
                            );
                            $data[] = $column;

                            if($nama_tujuan != $tujuan->tujuan)
                            {
                                $nama_tujuan = $tujuan->tujuan;
                                $index_tujuan = $index;
                                $data[$index]['rowspans_tujuan'] = 1;
                            }
                            else{
                                $data[$index_tujuan]['rowspans_tujuan']++;
                            }

                            if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                            {
                                $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                $index_sasaran = $index;
                                $data[$index]['rowspans_sasaran'] = 1;
                            }
                            else{
                                $data[$index_sasaran]['rowspans_sasaran']++;
                            }

                            $index++;

                            // program
                            $param_program['where']['renstra_program.id_indikator_sasaran_renstra'] = $indikator_sasaran->id_indikator_sasaran_renstra;
                            $dt_program = $this->Program_model->get($param_program);
                            
                            foreach($dt_program->result() as $p => $program)
                            {

                                // indikator program
                                $param_indikator_program['where']['indikator.id_program_renstra'] = $program->id_program_renstra;
                                $dt_indikator_program = $this->Program_indikator_model->get($param_indikator_program);                        

                                if($dt_indikator_program->num_rows()==0){

                                    $target_awal = '';
                                    $target_tahun = array();
                                    foreach($dt_tahun as $t => $tahun)
                                    {
                                        $col_tahun = array(
                                            'target'        => '',
                                            'rp'            => '',
                                        );
                                        $target_tahun[] = $col_tahun;
                                    }


                                    $target_akhir = array(
                                        'target'        => '',
                                        'rp'            => '',
                                    );


                                    $unit_kerja = '';
                                    $lokasi = '';

                                    $column = array(
                                        'level'             => 5,
                                        'misi'              => '',
                                        'tujuan'            => $tujuan->tujuan,
                                        'sasaran'           => $sasaran->nama_sasaran_renstra,
                                        'kode'              => $program->kode_program,
                                        'program_kegiatan'  => $program->nama_program,
                                        'indikator'         => '',
                                        'target_awal'       => $target_awal,
                                        'target_tahun'      => $target_tahun,
                                        'target_akhir'      => $target_akhir, 
                                        'unit_kerja'        => $unit_kerja,
                                        'lokasi'            => $lokasi,
                                    );
                                    $data[] = $column;

                                    if($nama_tujuan != $tujuan->tujuan)
                                    {
                                        $nama_tujuan = $tujuan->tujuan;
                                        $index_tujuan = $index;
                                        $data[$index]['rowspans_tujuan'] = 1;
                                    }
                                    else{
                                        $data[$index_tujuan]['rowspans_tujuan']++;
                                    }

                                    if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                                    {
                                        $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                        $index_sasaran = $index;
                                        $data[$index]['rowspans_sasaran'] = 1;
                                    }
                                    else{
                                        $data[$index_sasaran]['rowspans_sasaran']++;
                                    }

                                    $index++;

                                }

                                foreach($dt_indikator_program->result() as $is => $indikator_program)
                                {
                                    $target_awal = $indikator_program->target_awal;

                                    $target_tahun = array();
                                    foreach($dt_tahun as $t => $tahun)
                                    {

                                        $_target = "target_tahun_".($t+1);
                                        $_target_rp = "target_tahun_".($t+1)."_rp";
                                        $col_tahun = array(
                                            'target'        => $indikator_program->$_target,
                                            'rp'            => number_format($indikator_program->$_target_rp),
                                        );
                                        $target_tahun[] = $col_tahun;
                                    }


                                    $target_akhir = array(
                                        'target'        => $indikator_program->target_akhir,
                                        'rp'            => number_format($indikator_program->target_akhir_rp),
                                    );


                                    $unit_kerja = $this->get_unit_kerja($indikator_program->id_indikator_program_renstra);
                                    $lokasi = $indikator_program->lokasi;

                                    $column = array(
                                        'level'             => 5,
                                        'misi'              => '',
                                        'tujuan'            => $tujuan->tujuan,
                                        'sasaran'           => $sasaran->nama_sasaran_renstra,
                                        'kode'              => $program->kode_program,
                                        'program_kegiatan'  => $program->nama_program,
                                        'indikator'         => $indikator_program->nama_indikator_program_renstra,
                                        'target_awal'       => $target_awal,
                                        'target_tahun'      => $target_tahun,
                                        'target_akhir'      => $target_akhir, 
                                        'unit_kerja'        => $unit_kerja,
                                        'lokasi'            => $lokasi,
                                    );
                                    $data[] = $column;

                                    if($nama_tujuan != $tujuan->tujuan)
                                    {
                                        $nama_tujuan = $tujuan->tujuan;
                                        $index_tujuan = $index;
                                        $data[$index]['rowspans_tujuan'] = 1;
                                    }
                                    else{
                                        $data[$index_tujuan]['rowspans_tujuan']++;
                                    }

                                    if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                                    {
                                        $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                        $index_sasaran = $index;
                                        $data[$index]['rowspans_sasaran'] = 1;
                                    }
                                    else{
                                        $data[$index_sasaran]['rowspans_sasaran']++;
                                    }

                                    $index++;


                                    // kegiatan
                                    $param_kegiatan['where']['renstra_kegiatan.id_indikator_program_renstra'] = $indikator_program->id_indikator_program_renstra;
                                    $dt_kegiatan = $this->Kegiatan_model->get($param_kegiatan);
                                    
                                    foreach($dt_kegiatan->result() as $k => $kegiatan)
                                    {

                                        // indikator kegiatan
                                        $param_indikator_kegiatan['where']['indikator.id_kegiatan'] = $kegiatan->id_kegiatan;
                                        $dt_indikator_kegiatan = $this->Kegiatan_indikator_model->get($param_indikator_kegiatan);                        

                                        if($dt_indikator_kegiatan->num_rows()==0){

                                            $target_awal = '';
                                            $target_tahun = array();
                                            foreach($dt_tahun as $t => $tahun)
                                            {
                                                $col_tahun = array(
                                                    'target'        => '',
                                                    'rp'            => '',
                                                );
                                                $target_tahun[] = $col_tahun;
                                            }


                                            $target_akhir = array(
                                                'target'        => '',
                                                'rp'            => '',
                                            );


                                            $unit_kerja = '';
                                            $lokasi = '';

                                            $column = array(
                                                'level'             => 6,
                                                'misi'              => '',
                                                'tujuan'            => $tujuan->tujuan,
                                                'sasaran'           => $sasaran->nama_sasaran_renstra,
                                                'kode'              => $program->kode_program,
                                                'program_kegiatan'  => $program->nama_program,
                                                'indikator'         => '',
                                                'target_awal'       => $target_awal,
                                                'target_tahun'      => $target_tahun,
                                                'target_akhir'      => $target_akhir, 
                                                'unit_kerja'        => $unit_kerja,
                                                'lokasi'            => $lokasi,
                                            );
                                            $data[] = $column;

                                            if($nama_tujuan != $tujuan->tujuan)
                                            {
                                                $nama_tujuan = $tujuan->tujuan;
                                                $index_tujuan = $index;
                                                $data[$index]['rowspans_tujuan'] = 1;
                                            }
                                            else{
                                                $data[$index_tujuan]['rowspans_tujuan']++;
                                            }

                                            if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                                            {
                                                $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                                $index_sasaran = $index;
                                                $data[$index]['rowspans_sasaran'] = 1;
                                            }
                                            else{
                                                $data[$index_sasaran]['rowspans_sasaran']++;
                                            }
                                            $index++;

                                        }

                                        foreach($dt_indikator_kegiatan->result() as $is => $indikator_kegiatan)
                                        {
                                            $target_awal = $indikator_kegiatan->target_awal;

                                            $target_tahun = array();
                                            foreach($dt_tahun as $t => $tahun)
                                            {

                                                $_target = "target_tahun_".($t+1);
                                                $_target_rp = "target_tahun_".($t+1)."_rp";
                                                $col_tahun = array(
                                                    'target'        => $indikator_kegiatan->$_target,
                                                    'rp'            => number_format($indikator_kegiatan->$_target_rp),
                                                );
                                                $target_tahun[] = $col_tahun;
                                            }


                                            $target_akhir = array(
                                                'target'        => $indikator_kegiatan->target_akhir,
                                                'rp'            => number_format($indikator_kegiatan->target_akhir_rp),
                                            );


                                            $unit_kerja = $this->get_unit_kerja($indikator_kegiatan->id_indikator_kegiatan);
                                            $lokasi = $indikator_kegiatan->lokasi;

                                            $column = array(
                                                'level'             => 5,
                                                'misi'              => '',
                                                'tujuan'            => $tujuan->tujuan,
                                                'sasaran'           => $sasaran->nama_sasaran_renstra,
                                                'kode'              => $kegiatan->kode_kegiatan,
                                                'program_kegiatan'  => $kegiatan->nama_kegiatan,
                                                'indikator'         => $indikator_kegiatan->nama_indikator_kegiatan,
                                                'target_awal'       => $target_awal,
                                                'target_tahun'      => $target_tahun,
                                                'target_akhir'      => $target_akhir, 
                                                'unit_kerja'        => $unit_kerja,
                                                'lokasi'            => $lokasi,
                                            );
                                            $data[] = $column;

                                            if($nama_tujuan != $tujuan->tujuan)
                                            {
                                                $nama_tujuan = $tujuan->tujuan;
                                                $index_tujuan = $index;
                                                $data[$index]['rowspans_tujuan'] = 1;
                                            }
                                            else{
                                                $data[$index_tujuan]['rowspans_tujuan']++;
                                            }

                                            if($nama_sasaran != $sasaran->nama_sasaran_renstra)
                                            {
                                                $nama_sasaran = $sasaran->nama_sasaran_renstra;
                                                $index_sasaran = $index;
                                                $data[$index]['rowspans_sasaran'] = 1;
                                            }
                                            else{
                                                $data[$index_sasaran]['rowspans_sasaran']++;
                                            }
                                            $index++;
                                        }
                                    }

                                }
                            }
                        }
                    }
                    
                }   
            }
            
        }

        return $data;
    }

    private function get_program($id_sub_urusan)
    {
        return $this->db->where("id_sub_urusan",$id_sub_urusan)->get("sc_ref_program");
    }


    private function get_unit_kerja($id)
    {
        $this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = indikator_unit_kerja.id_unit_kerja","left");
        $this->db->where("id_indikator_program_renstra",$id);
        $dt =  $this->db->get("sc_renstra_program_indikator_unit_kerja indikator_unit_kerja");
        
        $Arr = array();
        foreach($dt->result() as $res)
        {
            $Arr[] = $res->nama_unit_kerja;
        }

        return implode(",<br>",$Arr);
    }


    public function get_total_target($id_urusan,$id_sub_urusan=null,$id_skpd=null)
    {

        $this->db->select("
            sum(indikator.target_awal_rp) as 'total_target_awal_rp',
            sum(indikator.target_akhir_rp) as 'total_target_akhir_rp',

            sum(indikator.target_tahun_1_rp) as 'total_target_tahun_1_rp',
            sum(indikator.target_tahun_2_rp) as 'total_target_tahun_2_rp',
            sum(indikator.target_tahun_3_rp) as 'total_target_tahun_3_rp',
            sum(indikator.target_tahun_4_rp) as 'total_target_tahun_4_rp',
            sum(indikator.target_tahun_5_rp) as 'total_target_tahun_5_rp',

        ");

        $query=null;

        if($id_skpd)
        {
            $this->db->join("sc_rpjmd_program_indikator indikator","indikator.id_indikator_program_rpjmd=skpd.id_indikator_program_rpjmd","left");
            $this->db->group_by("indikator.id_indikator_program_rpjmd");
            $this->db->where("skpd.id_skpd",$id_skpd);

            $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = indikator.id_program_rpjmd","left");
            $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");

            $this->db->where("ref_program.id_urusan",$id_urusan);
            if($id_sub_urusan)
            {
                $this->db->where("ref_program.id_sub_urusan",$id_sub_urusan);
            }
        
            $query = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");    
        }
        else{
            
            $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = indikator.id_program_rpjmd","left");
            $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program","left");

            $this->db->where("ref_program.id_urusan",$id_urusan);
            if($id_sub_urusan)
            {
                $this->db->where("ref_program.id_sub_urusan",$id_sub_urusan);
            }
            
            $query = $this->db->get("sc_rpjmd_program_indikator indikator");    
        }
        return $query;
    }
}