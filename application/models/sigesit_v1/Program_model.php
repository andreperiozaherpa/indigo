<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /* public function get_perencanaan($id_skpd)
    {
        $this->db->where("skpd.id_skpd",$id_skpd);
        $this->db->join("sc_rpjmd_program_indikator indikator","indikator.id_indikator_program_rpjmd = skpd.id_indikator_program_rpjmd","left");
        $this->db->join("sc_rpjmd_program program","program.id_program_rpjmd = indikator.id_program_rpjmd ","left");
        $this->db->join("sc_ref_program ref_program","ref_program.id_ref_program = program.id_ref_program ","left");
        $this->db->group_by("ref_program.id_ref_program");
        $this->db->select("ref_program.*");
        $rs = $this->db->get("sc_rpjmd_program_indikator_skpd skpd");
        return $rs;
    } */

    public function get_perencanaan($id_skpd)
    {
        $dt_unit = $this->db
        ->select("SUBSTRING(unit.kode_unit,1,4) as 'kode' ")
        ->where("id_skpd",$id_skpd)
        ->get("sipd_ref_unit unit")->row();
        if($dt_unit)
        {
            $kode_unit = $dt_unit->kode;
            $rs = $this->db
            ->select("program.*, program.id_program as 'id_ref_program' ")
            ->where("(program.kode_program LIKE '".$kode_unit."%' )")
            ->get("sipd_ref_program program");

            return $rs;
        }
        else{
            return null;
        }
    }

    public function get_penganggaran($id_skpd)
    {
        $dt_unit = $this->db
        ->select("SUBSTRING(unit.kode_unit,1,4) as 'kode' ")
        ->where("id_skpd",$id_skpd)
        ->get("sipd_ref_unit unit")->row();
        if($dt_unit)
        {
            $kode_unit = $dt_unit->kode;
            $rs = $this->db
            ->where("(program.kode_program LIKE '".$kode_unit."%' )")
            ->get("sipd_ref_program program");

            return $rs;
        }
        else{
            return null;
        }
    }
}