<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_wilayah_model extends CI_Model
{
	public function get_provinsi($id=null){
		if ($id!=null) $this->db->where('id_provinsi',$id);
		$this->db->order_by('provinsi','ASC');
		$query = $this->db->get('provinsi');
		return $query->result();
	}
	public function get_kabupaten($id=null,$id_provinsi=null)
	{
		if ($id!=null) $this->db->where('id_kabupaten',$id);
		if ($id_provinsi!=null) $this->db->where('id_provinsi',$id_provinsi);
		$this->db->order_by('kabupaten','ASC');
		$query = $this->db->get('kabupaten');
		return $query->result();
	}
	public function get_kecamatan($id=null,$id_kabupaten=null)
	{
		if ($id!=null) $this->db->where('id_kecamatan',$id);
		if ($id_kabupaten!=null) $this->db->where('id_kabupaten',$id_kabupaten);
		$this->db->order_by('kecamatan','ASC');
		$query = $this->db->get('kecamatan');
		return $query->result();
	}
	public function get_desa($id=null,$id_kecamatan=null)
	{
		if ($id!=null) $this->db->where('id_desa',$id);
		if ($id_kecamatan!=null) $this->db->where('id_kecamatan',$id_kecamatan);
		
		$this->db->order_by('desa','ASC');
		$query = $this->db->get('desa');
		return $query->result();
	}

	public function get_kecamatan_single($id_kecamatan)
	{
		$this->db->where('id_kecamatan',$id_kecamatan);
		$query = $this->db->get('kecamatan');
		return $query->row();
	}

	public function get_desa_single($id_desa){
		$this->db->where('id_desa',$id_desa);
		$query = $this->db->get('desa');
		return $query->row();
	}

	public function get_id_kabupaten($id_kecamatan){
		$this->db->where('id_kecamatan',$id_kecamatan);
		$query = $this->db->get('kecamatan');
		return $query->row()->id_kabupaten;
	}

	public function get_id_kecamatan($id_desa){
		$this->db->where('id_desa',$id_desa);
		$query = $this->db->get('desa');
		return $query->row()->id_kecamatan;
	}
	public function get_nama_provinsi($id_provinsi){
		$this->db->where('id_provinsi',$id_provinsi);
		$a = $this->db->get('provinsi')->num_rows();
		if($a>0){
			$this->db->where('id_provinsi',$id_provinsi);
			$query = $this->db->get('provinsi')->row()->provinsi;
		}else{
			$query = '';
		}
		return $query;
	}

	public function get_nama_kabupaten($id_kabupaten){
		$this->db->where('id_kabupaten',$id_kabupaten);
		$a = $this->db->get('kabupaten')->num_rows();
		if($a>0){
			$this->db->where('id_kabupaten',$id_kabupaten);
			$query = $this->db->get('kabupaten')->row()->kabupaten;
		}else{
			$query = '';
		}
		return $query;

	}

	public function get_nama_kecamatan($id_kecamatan){
		$this->db->where('id_kecamatan',$id_kecamatan);
		$a = $this->db->get('kecamatan')->num_rows();
		if($a>0){
			$this->db->where('id_kecamatan',$id_kecamatan);
			$query = $this->db->get('kecamatan')->row()->kecamatan;
		}else{
			$query = '';
		}
		return $query;
	}

	public function get_nama_desa($id_desa){
		$this->db->where('id_desa',$id_desa);
		$a = $this->db->get('desa')->num_rows();
		if($a>0){
			$this->db->where('id_desa',$id_desa);
			$query = $this->db->get('desa')->row()->desa;
		}else{
			$query = '';
		}
		return $query;
	}
}