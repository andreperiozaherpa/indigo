<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /*
    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(indikator.nama_indikator_program_rpjmd like '%".$param['search']."%' )");
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

        $this->db->join("sc_rpjmd_program_indikator indikator","indikator.id_indikator_program_rpjmd=skpd.id_indikator_program_rpjmd","left");
        $this->db->join("ref_satuan satuan","satuan.id_satuan = indikator.satuan","left");

        $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd=indikator.id_program_rpjmd","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program=program.id_ref_program","left");
        $this->db->join("sc_ref_sub_urusan sub_urusan","sub_urusan.id_sub_urusan=ref_program.id_sub_urusan","left");
        $this->db->join("sc_ref_urusan urusan","sub_urusan.id_urusan=sub_urusan.id_urusan","left");


        $this->db->group_by("indikator.id_indikator_program_rpjmd");
        $this->db->where("skpd.id_skpd",$param['id_skpd']);
        $this->db->select("*, satuan.satuan as 'satuan_desc',  skpd.*");

        $this->db->order_by("urusan.id_urusan","ASC");
        $this->db->order_by("sub_urusan.id_urusan","ASC");
        $this->db->order_by("ref_program.id_ref_program","ASC");
        $this->db->order_by("program.id_program_rpjmd","ASC");
        $this->db->order_by("indikator.id_indikator_program_rpjmd","ASC");

        $query = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");  
        
        
        return $query;
    }
    */

    public function generate($id_skpd=null)
    {
        $this->load->model("sicerdas/rpjmd/Urusan_model");
        $this->load->model("sicerdas/rpjmd/Program_indikator_model");
        $this->load->model("sicerdas/Globalvar");


        $dt_tahun = $this->Globalvar->get_tahun();
        $data = array();

        
        $dt_urusan = $this->Urusan_model->get_urusan()->result();

        // urusan
        foreach($dt_urusan as $row)
        {
            
            $total_target_urusan = $this->get_total_target($row->id_urusan,null,$id_skpd)->row();

            $target_tahun = array();
            foreach($dt_tahun as $t => $tahun)
            {
                $total_target_tahun = "total_target_tahun_".($t+1)."_rp";
                $col_tahun = array(
                    'target'        => '',
                    'satuan'        => '',
                    'rp'            => ($total_target_urusan && $total_target_urusan->$total_target_tahun) ? number_format($total_target_urusan->$total_target_tahun) : 0,
                );
                $target_tahun[] = $col_tahun;
            }


            $target_akhir = array(
                'target'        => '',
                'satuan'        => '',
                'rp'            => ($total_target_urusan && $total_target_urusan->total_target_akhir_rp) ? number_format($total_target_urusan->total_target_akhir_rp) : 0,
            );


            $skpd = '';

            $column = array(
                'level'             => 1,
                'kode'              => $row->kode_urusan,
                'urusan_program'    => $row->nama_urusan,
                'indikator'         => '',
                'target_tahun'      => $target_tahun,
                'target_akhir'      => $target_akhir, 
                'skpd'              => $skpd,
            );
            $data[] = $column;


            // sub urusan
            $param_sub['where']['sub_urusan.id_urusan'] = $row->id_urusan;
            $dt_sub_urusan = $this->Urusan_model->get($param_sub)->result();

            foreach($dt_sub_urusan as $sub)
            {
                
                $total_target_sub_urusan = $this->get_total_target($row->id_urusan,$sub->id_sub_urusan,$id_skpd)->row();

                $target_tahun = array();
                foreach($dt_tahun as $t => $tahun)
                {
                    $total_target_tahun = "total_target_tahun_".($t+1)."_rp";
                    $col_tahun = array(
                        'target'        => '',
                        'satuan'        => '',
                        'rp'            => ($total_target_sub_urusan && $total_target_sub_urusan->$total_target_tahun) ? number_format($total_target_sub_urusan->$total_target_tahun) : 0,
                    );
                    $target_tahun[] = $col_tahun;
                }


                $target_akhir = array(
                    'target'        => '',
                    'satuan'        => '',
                    'rp'            => ($total_target_sub_urusan && $total_target_sub_urusan->total_target_akhir_rp) ? number_format($total_target_sub_urusan->total_target_akhir_rp) : 0,
                );


                $skpd = '';

                $column = array(
                    'level'             => 2,
                    'kode'              => $sub->kode_sub_urusan,
                    'urusan_program'    => $sub->nama_sub_urusan,
                    'indikator'         => '',
                    'target_tahun'      => $target_tahun,
                    'target_akhir'      => $target_akhir, 
                    'skpd'              => $skpd,
                );
                $data[] = $column;


                // program
                $dt_program = $this->get_program($sub->id_sub_urusan);

                foreach($dt_program->result() as $program)
                {
                    
                    // indikator
                    $param_indikator = array();
                    $param_indikator['id_ref_program'] = $program->id_ref_program;
                    if($id_skpd){
                        $param_indikator['id_skpd'] = $id_skpd;
                    }
                    $dt_indikator = $this->Program_indikator_model->get($param_indikator);
                    $jml_indikator = $dt_indikator->num_rows();
                    $indikator = $dt_indikator->result();


                    $target_tahun = array();
                    foreach($dt_tahun as $t => $tahun)
                    {

                        $_target = '';
                        $_satuan = '';
                        $_target_rp = '';

                        if($indikator)
                        {
                            $target = "target_tahun_".($t +1);
                            $target_rp = "target_tahun_".($t+1)."_rp";

                            $_target = $indikator[0]->$target;
                            $_satuan = $indikator[0]->satuan_desc;
                            $_target_rp = number_format($indikator[0]->$target_rp);
                        }

                        $col_tahun = array(
                            'target'        => $_target,
                            'satuan'        => $_satuan,
                            'rp'            => $_target_rp,
                        );
                        $target_tahun[] = $col_tahun;
                    }


                    $__target = '';
                    $__satuan = '';
                    $__target_rp = '';

                    if($indikator)
                    {
                        $__target = $indikator[0]->target_akhir;
                        $__satuan = $indikator[0]->satuan_desc;
                        $__target_rp = number_format($indikator[0]->target_akhir_rp);
                    }

                    $target_akhir = array(
                        'target'        => $__target,
                        'satuan'        => $__satuan,
                        'rp'            => $__target_rp,
                    );
                    

                    $skpd = ($indikator) ? $this->get_skpd($indikator[0]->id_indikator_program_rpjmd) : '';

                    $column = array(
                        'level'             => 3,
                        'kode'              => $program->kode_program,
                        'urusan_program'    => $program->nama_program,
                        'indikator'         => ($indikator) ?  $indikator[0]->nama_indikator_program_rpjmd : '', 
                        'target_tahun'      => $target_tahun,
                        'target_akhir'      => $target_akhir, 
                        'skpd'              => $skpd,
                        'jml_indikator'     => $jml_indikator,
                    );
                    $data[] = $column;

                    

                    foreach($dt_indikator->result() as $i => $indikator)
                    {
                        if($i>0){
                        $target_tahun = array();
                            foreach($dt_tahun as $t => $tahun)
                            {

                                $target = "target_tahun_".($t+1);
                                $target_rp = "target_tahun_".($t+1)."_rp";
                                $col_tahun = array(
                                    'target'        => $indikator->$target,
                                    'satuan'        => $indikator->satuan_desc,
                                    'rp'            => number_format($indikator->$target_rp),
                                );
                                $target_tahun[] = $col_tahun;
                            }


                            $target_akhir = array(
                                'target'        => $indikator->target_akhir,
                                'satuan'        => $indikator->satuan_desc,
                                'rp'            => number_format($indikator->target_akhir_rp),
                            );


                            $skpd = $this->get_skpd($indikator->id_indikator_program_rpjmd);

                            $column = array(
                                'level'             => 3,
                                'kode'              => '',
                                'urusan_program'    => '',
                                'indikator'         => $indikator->nama_indikator_program_rpjmd,
                                'target_tahun'      => $target_tahun,
                                'target_akhir'      => $target_akhir, 
                                'skpd'              => $skpd,
                            );
                            $data[] = $column;

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


    private function get_skpd($id)
    {
        $this->db->join("ref_skpd","ref_skpd.id_skpd = indikator_skpd.id_skpd","left");
        $this->db->where("id_indikator_program_rpjmd",$id);
        $dt_skpd = $this->db->get("sc_rpjmd_program_indikator_skpd indikator_skpd");
        
        $skpdArr = array();
        foreach($dt_skpd->result() as $res)
        {
            $skpdArr[] = $res->nama_skpd;
        }

        return implode(",<br>",$skpdArr);
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