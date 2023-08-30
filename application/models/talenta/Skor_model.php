<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skor_model extends CI_Model
{
    public function getKategoriJabatan()
    {
        $rs = $this->db->get("mt_skor_kategori_jabatan");
        return $rs->result();
    }

    public function getVariabel()
    {
        $rs = $this->db->get("mt_skor_variabel");
        return $rs->result();
    }

    public function getKriteria($param=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value)
            {
                $this->db->where($key,$value);
            }
        }
        $this->db->order_by("id_kriteria","ASC");
        $this->db->order_by("skor","DESC");
        $rs = $this->db->get("mt_skor_kriteria");
        return $rs->result();
    }
    public function insertSkor($data)
    {
        $this->db->insert("mt_skor",$data);
    }

    public function deleteSkor($id_pendaftaran)
    {
        $this->db->where("id_pendaftaran",$id_pendaftaran);
        $this->db->delete("mt_skor");
    }

    public function get($param=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value)
            {
                $this->db->where($key,$value);
            }
        }

        $this->db->join("mt_skor_kriteria","mt_skor_kriteria.id_kriteria=mt_skor.id_kriteria","left");
        
        $rs = $this->db->get("mt_skor");
        return $rs->result();
    }
    public function getTotal($param=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value)
            {
                $this->db->where($key,$value);
            }
        }
        $this->db->select("sum(mt_skor_kriteria.skor) as total ");
        $this->db->join("mt_skor_kriteria","mt_skor_kriteria.id_kriteria=mt_skor.id_kriteria","left");
        
        $rs = $this->db->get("mt_skor")->result();
        return $rs[0]->total;
    }
    public function getSummary($param=null, $hal=null,$mulai=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value)
            {
                $this->db->where($key,$value);
            }
        }

        if($hal && $mulai)
        {
            $this->db->limit($hal,$mulai);
        }

        $this->db->select("sum(mt_skor_kriteria.skor) as total, mt_pendaftaran.id_pegawai, 
            pegawai.nip, pegawai.nama_lengkap, ref_skpd.nama_skpd,ref_jabatan.nama_jabatan, mt_pendaftaran.id_pendaftaran ");
        $this->db->join("mt_skor_kriteria","mt_skor_kriteria.id_kriteria=mt_skor.id_kriteria","left");
        
        $this->db->join("mt_pendaftaran","mt_pendaftaran.id_pendaftaran=mt_skor.id_pendaftaran","left");

        $this->db->join('mt_kebutuhan','mt_kebutuhan.id_kebutuhan=mt_pendaftaran.id_kebutuhan','left');
        $this->db->join('pegawai','pegawai.id_pegawai=mt_pendaftaran.id_pegawai','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd=mt_kebutuhan.id_skpd','left');
        $this->db->join('ref_jabatan','ref_jabatan.id_jabatan=mt_kebutuhan.id_jabatan','left');


        $this->db->group_by("mt_pendaftaran.id_pegawai");
        $this->db->order_by("sum(mt_skor_kriteria.skor)","DESC");
        $rs = $this->db->get("mt_skor")->result();
        return $rs;
    }
    public function getTotalSummary($param)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value)
            {
                $this->db->where($key,$value);
            }
        }
        $this->db->select("sum(mt_skor_kriteria.skor) as total, mt_pendaftaran.id_pegawai");
        $this->db->join("mt_skor_kriteria","mt_skor_kriteria.id_kriteria=mt_skor.id_kriteria","left");
        $this->db->join("mt_pendaftaran","mt_pendaftaran.id_pendaftaran=mt_skor.id_pendaftaran","left");
        
        $this->db->join('mt_kebutuhan','mt_kebutuhan.id_kebutuhan=mt_pendaftaran.id_kebutuhan','left');
        $this->db->join('pegawai','pegawai.id_pegawai=mt_pendaftaran.id_pegawai','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd=mt_kebutuhan.id_skpd','left');
        $this->db->join('ref_jabatan','ref_jabatan.id_jabatan=mt_kebutuhan.id_jabatan','left');


        $rs = $this->db->get("mt_skor")->num_rows();
        return $rs;
    }

    public function getPeringkat($id_pegawai,$id_kebutuhan)
    {
        $param = array(
            'mt_pendaftaran.id_kebutuhan'   => $id_kebutuhan,
        );
        $summary = $this->getSummary($param);
        foreach($summary as $key=>$value)
        {
            if($value->id_pegawai==$id_pegawai){
                return ($key+1);
            }
        }
        return 0;
    }
}
?>