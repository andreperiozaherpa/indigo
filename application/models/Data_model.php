<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{
	public function get_skpd($id=null){
		if ($id!=null) $this->db->where('id_skpd',$id);
		$this->db->order_by('nama_skpd','ASC');
		$query = $this->db->get('id_skpd');
		return $query->result();
	}
	public function get_unit_kerja($id=null,$id_skpd=null)
	{
		if ($id!=null) $this->db->where('id_unit_kerja',$id);
		if ($id_skpd!=null) $this->db->where('id_skpd',$id_skpd);
		$this->db->order_by('nama_unit_kerja','ASC');
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
	public function get_pegawai($id=null,$id_unit_kerja=null)
	{
		if ($id!=null) $this->db->where('id_pegawai',$id);
		if ($id_unit_kerja!=null) $this->db->where('id_unit_kerja',$id_unit_kerja);
		$this->db->order_by('nama_lengkap','ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	

	public function get_nama_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$a = $this->db->get('skpd')->num_rows();
		if($a>0){
			$this->db->where('id_skpd',$id_skpd);
			$query = $this->db->get('skpd')->row()->skpd;
		}else{
			$query = '-';
		}
		return $query;
	}

	public function get_nama_unit_kerja($id_unit_kerja){
		$this->db->where('id_unit_kerja',$id_unit_kerja);
		$a = $this->db->get('ref_unit_kerja')->num_rows();
		if($a>0){
			$this->db->where('id_unit_kerja',$id_unit_kerja);
			$query = $this->db->get('ref_unit_kerja')->row()->ref_unit_kerja;
		}else{
			$query = '-';
		}
		return $query;

	}

	public function get_nama_pegawai($id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$a = $this->db->get('pegawai')->num_rows();
		if($a>0){
			$this->db->where('id_pegawai',$id_pegawai);
			$query = $this->db->get('pegawai')->row()->pegawai;
		}else{
			$query = '-';
		}
		return $query;
	}

}