<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idp_model extends CI_Model
{
    public function get($param=null, $hal=null,$mulai=null,$sWhere='')
    {
        if($param!=null)
        {
            foreach($param as $key=>$value){
                $this->db->where($key,$value);
            }
        }

        if($sWhere!="")
        {
            $this->db->where($sWhere);
        }

        $this->db->select("mt_idp.*, pegawai.*, ref_skpd.*, mentor_tetap.nama_lengkap as nama_mentor_tetap, atasan_mentor.nama_lengkap as nama_atasan_mentor ");

        $this->db->join('pegawai','pegawai.id_pegawai=mt_idp.id_pegawai','left');
        $this->db->join('ref_skpd','ref_skpd.id_skpd=pegawai.id_skpd','left');

        $this->db->join('pegawai mentor_tetap','mentor_tetap.id_pegawai=mt_idp.rencana_mentor_tetap','left');
        $this->db->join('pegawai atasan_mentor','atasan_mentor.id_pegawai=mt_idp.rencana_atasan_mentor','left');

        if($hal && $mulai)
        {
            $this->db->limit($hal,$mulai);
        }

        $query = $this->db->get("mt_idp");
        return $query->result();
    }

    public function get_total(){
		$query = $this->db->get('mt_idp');
		return $query->num_rows();
    }
    
    public function save($id_pegawai,$data)
    {
        $cek = $this->get(['mt_idp.id_pegawai' => $id_pegawai]);
        if(!empty($cek[0]))
        {
            $this->db->where("id_pegawai",$id_pegawai);
            $this->db->update("mt_idp",$data);
        }
        else{
            $data['id_pegawai'] = $id_pegawai;
            $this->db->insert("mt_idp",$data);
        }
    }
}

?>