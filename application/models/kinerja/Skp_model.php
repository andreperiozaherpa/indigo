<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        
    }


    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(pegawai.nama_lengkap like '%".$param['search']."%' OR pegawai.nip like '%".$param['search']."%' )");
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

        $this->db->join("pegawai","pegawai.id_pegawai = skp.id_pegawai","left");
        $this->db->join("pegawai atasan","atasan.id_pegawai = skp.id_pegawai_atasan","left");

        $this->db->join("ref_unit_kerja unit_kerja","unit_kerja.id_unit_kerja = pegawai.id_unit_kerja","left");
        $this->db->join("ref_unit_kerja unit_kerja_atasan","unit_kerja_atasan.id_unit_kerja = atasan.id_unit_kerja","left");

        $this->db->join("ref_skpd skpd","skpd.id_skpd = pegawai.id_skpd","left");
        $this->db->join("ref_skpd skpd_atasan","skpd_atasan.id_skpd = atasan.id_skpd","left");
        
        $this->db->select("skp.*, pegawai.*, unit_kerja.*, skp.status as 'status',
            concat(pegawai.pangkat,' - ',pegawai.golongan) as 'pangkat',
            atasan.nama_lengkap as 'nama_lengkap_atasan',
            atasan.nip as 'nip_atasan',
            atasan.jabatan as 'jabatan_atasan',
            concat(atasan.pangkat,' - ',atasan.golongan) as 'pangkat_atasan',
            unit_kerja_atasan.nama_unit_kerja as 'nama_unit_kerja_atasan',
            skpd.id_skpd,skpd_atasan.id_skpd as 'id_skpd_atasan',
            skpd.nama_skpd, skpd_atasan.nama_skpd as 'nama_skpd_atasan', skpd.jenis_skpd
        ");

        $this->db->order_by("skp.tahun","ASC");

        $query = $this->db->get("ekinerja_skp skp");    
        
        
        

        return $query;
    }

    
    
    public function insert($data)
    {
       $this->db->insert("ekinerja_skp",$data);
       return $this->db->insert_id();
    }
    public function update($data,$id)
    {
       $this->db->where("id_skp",$id);
       $this->db->update("ekinerja_skp",$data);
    }
    public function delete($id)
    {
        // delete renaksi
        $this->load->model("kinerja/Renaksi_model");
        $param['where']['renaksi.id_skp'] = $id;
        $dt_renaksi = $this->Renaksi_model->get($param)->result();
        foreach($dt_renaksi as $row)
        {
            $this->Renaksi_model->delete($row->id_renaksi);
        }

        $this->db->where("id_skp",$id)->delete("ekinerja_utama");
        $this->db->where("id_skp",$id)->delete("ekinerja_tambahan");
        $this->db->where("id_skp",$id)->delete("ekinerja_perilaku");
        $this->db->where("id_skp",$id)->delete("ekinerja_lampiran");
        $this->db->where("id_skp",$id)->delete("ekinerja_instruksi_khusus");
        $this->db->where("id_skp",$id)->delete("ekinerja_cascading");
        $this->db->where("id_skp",$id)->delete("ekinerja_capaian");

        $status = $this->db->where("id_skp",$id)->delete("ekinerja_skp");
        return $status;
    }

    public function hitung_capaian($id_skp)
    {
        
        $param['where']['skp.id_skp'] = $id_skp;
        $param['str_where'] = "(skp.hitung_capaian is null)";
        $skp = $this->get($param)->row();

        if($skp)
        {
            $this->load->model("kinerja/Kinerja_utama_model");
            $this->load->model("kinerja/Kinerja_tambahan_model");
            $this->load->model("kinerja/Instruksi_model");
            $this->load->model("kinerja/Capaian_model");

            $param_kinerja_utama['where']['kinerja_utama.id_skp'] = $skp->id_skp;
            $dt_kinerja_utama = $this->Kinerja_utama_model->get($param_kinerja_utama)->result();
            $ids_kinerja_utama = array();
            
            foreach($dt_kinerja_utama as $row)
            {
              $this->do_init_capaian_kinerja($row);
              $ids_kinerja_utama[] = $row->id_kinerja_utama;
            }
      
            if($ids_kinerja_utama)
            {
              $this->db
              ->where_not_in("id_kinerja_utama",$ids_kinerja_utama)
              ->where("id_skp",$skp->id_skp)
              ->delete("ekinerja_capaian");
            }
      
      
            // IKP
            
            $param_ikp['where']['instruksi_khusus.id_skp'] = $skp->id_skp;
            $dt_ikp = $this->Instruksi_model->get_instruksi_khusus($param_ikp)->result();
            $ids_instruksi_khusus = array();
            foreach($dt_ikp as $row)
            {
              $this->do_init_capaian_kinerja($row);
              $ids_instruksi_khusus[] = $row->id_instruksi_khusus;
            }
      
            if($ids_instruksi_khusus)
            {
              $this->db
              ->where_not_in("id_instruksi_khusus",$ids_instruksi_khusus)
              ->where("id_skp",$skp->id_skp)
              ->delete("ekinerja_capaian");
            }
      
      
            // tambahan
            $param_kinerja_tambahan['where']['kinerja_tambahan.id_skp'] = $skp->id_skp;
            $dt_kinerja_tambahan = $this->Kinerja_tambahan_model->get($param_kinerja_tambahan)->result();
            $ids_kinerja_tambahan = array();
            foreach($dt_kinerja_tambahan as $row)
            {
              $this->do_init_capaian_kinerja($row);
              $ids_kinerja_tambahan[] = $row->id_kinerja_tambahan;
            }
      
            if($ids_kinerja_tambahan)
            {
              $this->db
              ->where_not_in("id_kinerja_tambahan",$ids_kinerja_tambahan)
              ->where("id_skp",$skp->id_skp)
              ->delete("ekinerja_capaian");
            }

            $this->db->set("hitung_capaian",date("Y-m-d H:i:s"));
            $this->db->where("id_skp",$skp->id_skp);
            $this->db->update("ekinerja_skp");


        }
        //echo "<pre>";print_r($skp);
    }

    private function do_init_capaian_kinerja($data)
    {
        //echo "<pre>";print_r($data);die;
        
        for($i=1; $i<=12 ;$i++)
        {
            $insert = array(
                'capaian' => null,
                'id_skp'  => $data->id_skp,
                'bulan'   => $i,
                'tahun'   => $data->tahun,
                'tahun_desc'   => $data->tahun_desc,
            );

            $this->db->where("id_skp",$data->id_skp);
            $this->db->where("bulan",$i);
            if(!empty($data->id_kinerja_utama))
            {
                $this->db->where("id_kinerja_utama",$data->id_kinerja_utama);
                $insert['id_kinerja_utama'] = $data->id_kinerja_utama;
            }
            else if(!empty($data->id_instruksi_khusus))
            {
                $this->db->where("id_instruksi_khusus",$data->id_instruksi_khusus);
                $insert['id_instruksi_khusus'] = $data->id_instruksi_khusus;
            }
            else if(!empty($data->id_kinerja_tambahan))
            {
                $this->db->where("id_kinerja_tambahan",$data->id_kinerja_tambahan);
                $insert['id_kinerja_tambahan'] = $data->id_kinerja_tambahan;
            }

            $cek = $this->db->get("ekinerja_capaian");

            if($cek->num_rows() == 0)
            {
                
                $this->db->insert("ekinerja_capaian",$insert);
            }

            //echo "<pre>";print_r($data);

            $data->bulan = $i;
            $this->Capaian_model->update($data);
        }
    }

    
}