<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebutuhan_model extends CI_Model
{
    public function get($param=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->select("*, ref_golongan.level as 'level_golongan',  ref_jenjangpendidikan.tkt as 'level_pendidikan' ");
        $this->db->join('ref_skpd','ref_skpd.id_skpd=mt_kebutuhan.id_skpd','left');
        $this->db->join('ref_jabatan','ref_jabatan.id_jabatan=mt_kebutuhan.id_jabatan','left');

        $this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan=mt_kebutuhan.kualifikasi_pendidikan','left');
        $this->db->join('ref_golongan','ref_golongan.id_golongan=mt_kebutuhan.kualifikasi_golongan','left');

        $this->db->order_by("mt_kebutuhan.eselon","ASC");
        $query = $this->db->get("mt_kebutuhan");
        return $query->result();
    }

    public function getSeleksi($param=null, $hal=null,$mulai=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->where("'".date('Y-m-d')."' >= mt_kebutuhan.tanggal_buka AND mt_kebutuhan.tanggal_tutup >= '".date('Y-m-d')."' ");

        $this->db->join('ref_skpd','ref_skpd.id_skpd=mt_kebutuhan.id_skpd','left');
        $this->db->join('ref_jabatan','ref_jabatan.id_jabatan=mt_kebutuhan.id_jabatan','left');
        
        $this->db->join('ref_jenjangpendidikan','ref_jenjangpendidikan.id_jenjangpendidikan=mt_kebutuhan.kualifikasi_pendidikan','left');
        $this->db->join('ref_golongan','ref_golongan.id_golongan=mt_kebutuhan.kualifikasi_golongan','left');

        
        $this->db->order_by("mt_kebutuhan.eselon","ASC");
        if($hal && $mulai)
        {
            $this->db->limit($hal,$mulai);
        }
        $query = $this->db->get("mt_kebutuhan");
        return $query->result();
    }

    public function get_total(){
		$query = $this->db->get('mt_kebutuhan');
		return $query->num_rows();
    }
    public function get_total_seleksi(){
        $this->db->where("'".date('Y-m-d')."' >= mt_kebutuhan.tanggal_buka AND mt_kebutuhan.tanggal_tutup >= '".date('Y-m-d')."' ");
		$query = $this->db->get('mt_kebutuhan');
		return $query->num_rows();
	}

    public function insert($data)
    {
        $this->db->insert("mt_kebutuhan",$data);
        return $this->db->insert_id();
    }
    public function insert_persyaratan($data)
    {
        $this->db->insert("mt_persyaratan_kebutuhan",$data);

    }

    public function update($data,$id_kebutuhan)
    {
        $this->db->where("id_kebutuhan",$id_kebutuhan);
        $this->db->update("mt_kebutuhan",$data);
    }

    public function delete($id_kebutuhan)
    {
        $this->db->where("id_kebutuhan",$id_kebutuhan);
        $this->db->delete("mt_persyaratan_kebutuhan");

        $this->db->where("id_kebutuhan",$id_kebutuhan);
        $status = $this->db->delete("mt_kebutuhan");
        return $status;
    }

    public function delete_persyaratan($id_kebutuhan)
    {
        $this->db->where("id_kebutuhan",$id_kebutuhan);
        $this->db->delete("mt_persyaratan_kebutuhan");
    }

    public function get_persyaratan($param=null)
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }
        $this->db->join('mt_persyaratan','mt_persyaratan.id_persyaratan = mt_persyaratan_kebutuhan.id_persyaratan','left');
        $this->db->join('mt_kebutuhan','mt_kebutuhan.id_kebutuhan = mt_persyaratan_kebutuhan.id_kebutuhan','left');
        
        $this->db->order_by("mt_persyaratan.eselon","ASC");
        $query = $this->db->get("mt_persyaratan_kebutuhan");
        return $query->result();
    }
}
?>