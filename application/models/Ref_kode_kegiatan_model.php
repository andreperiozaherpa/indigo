<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kode_kegiatan_model extends CI_Model
{

	public $kode_kegiatan;
	public $nama_lokasi;

	public function get_all()
	{
		if($this->kode_kegiatan!=''){
			$this->db->like('kode_kegiatan',$this->kode_kegiatan);
		}
		if($this->nama_lokasi!=''){
			$this->db->like('nama_lokasi',$this->nama_lokasi);
		}
		$query = $this->db->get('ref_kode_kegiatan');
		return $query->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_kode_kegiatan',$data);
	}

	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_kode_kegiatan', $id);
		}        
		$query = $this->db->get('ref_kode_kegiatan');
		return $query->row();   
	}

	public function get_id(){
		$maxid = 0;
		$row = $this->db->query('SELECT MAX(id_kode_kegiatan) AS `maxid` FROM `ref_kode_kegiatan`')->row();
		if ($row) {
			$maxid = $row->maxid; 
		}
		return $maxid+1;
	}

	public function update($data,$id = NULL)
	{
		$this->db->where('id_kode_kegiatan', $id);
		$query = $this->db->update('ref_kode_kegiatan',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_kode_kegiatan',$id);
		$query = $this->db->delete('ref_kode_kegiatan');	
		redirect('ref_kode_kegiatan');
	}
}
?>