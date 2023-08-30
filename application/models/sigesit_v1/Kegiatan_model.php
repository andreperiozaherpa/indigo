<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(
                program.nama_program like '%".$param['search']."%' OR skpd.nama_skpd like '%".$param['search']."%' 
            )");
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
        
        $this->db->join("ref_skpd skpd","skpd.id_skpd = kegiatan.id_skpd ","left");
        /* $this->db->join("sc_ref_program program","program.id_ref_program = kegiatan.id_ref_program ","left");
        $this->db->join("sc_ref_kegiatan ref_kegiatan","ref_kegiatan.id_ref_kegiatan = kegiatan.id_ref_kegiatan ","left");
        $this->db->join("sc_ref_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan = kegiatan.id_ref_sub_kegiatan ","left"); */
        $this->db->join("sipd_ref_program program","program.id_program = kegiatan.id_ref_program ","left");
        $this->db->join("sipd_ref_kegiatan ref_kegiatan","ref_kegiatan.id_kegiatan = kegiatan.id_ref_kegiatan ","left");
        $this->db->join("sipd_ref_sub_kegiatan sub_kegiatan","sub_kegiatan.id_sub_kegiatan = kegiatan.id_ref_sub_kegiatan ","left");
        $this->db->join("sigesit_sumber_anggaran sumber_anggaran","sumber_anggaran.id_sumber_anggaran = kegiatan.id_sumber_anggaran ","left");
        $this->db->join("sigesit_anggaran anggaran","anggaran.id_kegiatan = kegiatan.id_kegiatan ","left");

        $this->db->select("kegiatan.*, program.*, ref_kegiatan.*, sub_kegiatan.*, sumber_anggaran.*,
            anggaran.total_anggaran, anggaran.target_anggaran, anggaran.satuan_anggaran,
            kegiatan.id_kegiatan as 'id_kegiatan', skpd.nama_skpd ");
        
        $query = $this->db->get("sigesit_kegiatan kegiatan");

        return $query;
    }

    public function insert($data)
    {
        $this->db->insert("sigesit_kegiatan",$data);
        return $this->db->insert_id();
    }

    public function update($data,$id_kegiatan)
    {
        $this->db->where("id_kegiatan",$id_kegiatan);
        $this->db->update("sigesit_kegiatan",$data);
        return true;
    }

    public function delete($id_kegiatan)
    {
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_aktivitas");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_alokasi_anggaran");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_anggaran");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_anggaran_detail");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_penerima_bantuan");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_realisasi_anggaran");
        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_kegiatan");
        return true;
    }

    public function get_kegiatan($id,$perencanaan=true)
    {
        /* if($perencanaan)
        {
            $this->db->where("kegiatan.id_ref_program",$id);
            $rs = $this->db->get("sc_ref_kegiatan kegiatan");
            return $rs;
        }
        else
        { */
            $program = $this->db->where("id_program",$id)->get("sipd_ref_program")->row();
            if($program)
            {
                $this->db->where("(kegiatan.kode_kegiatan LIKE '".$program->kode_program."%' )");
                $this->db->select("kegiatan.*, kegiatan.id_kegiatan as 'id_ref_kegiatan' ");
                $rs = $this->db->get("sipd_ref_kegiatan kegiatan");
                return $rs;
            }
            else{
                return null;
            }
        //}
        
    }

    public function get_sub_kegiatan($id,$perencanaan=true)
    {
        /* if($perencanaan)
        {
            $this->db->where("sub_kegiatan.id_kegiatan",$id);
            $this->db->select("sub_kegiatan.*, sub_kegiatan.id_sub_kegiatan as 'id_ref_sub_kegiatan' ");
            $rs = $this->db->get("sc_ref_sub_kegiatan sub_kegiatan");
            return $rs;
        }
        else{ */
            $kegiatan = $this->db->where("id_kegiatan",$id)->get("sipd_ref_kegiatan")->row();
            if($kegiatan)
            {
                $this->db->where("(sub_kegiatan.kode_sub_kegiatan LIKE '".$kegiatan->kode_kegiatan."%' )");
                $this->db->select("sub_kegiatan.*, sub_kegiatan.id_sub_kegiatan as 'id_ref_sub_kegiatan' ");
                $rs = $this->db->get("sipd_ref_sub_kegiatan sub_kegiatan");
                return $rs;
            }
            else{
                return null;
            }
        //}
    }

    public function get_alokasi_anggaran($id_kegiatan)
    {
        $this->db->where("alokasi_anggaran.id_kegiatan",$id_kegiatan);
        return $this->db->get("sigesit_alokasi_anggaran alokasi_anggaran");
    }

    public function get_total($param)
    {
        $select = "count(kegiatan.id_kegiatan) as 'total' ";

        if(isset($param['group_by']))
        {
            if($param['group_by']=="skpd")
            {
                $select .= ", kegiatan.id_skpd";
                $this->db->group_by("kegiatan.id_skpd");
            }
        }

        if(!empty($param['where']))
        {
            $this->db->where($param['where']);
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        $this->db->select($select);
        return $this->db->get("sigesit_kegiatan kegiatan");
    }

}