<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kategori_berkas_model extends CI_Model
{
	public $id_kategori_berkas;
	public $kategori_berkas;
	public $keterangan;
	public $status;


	public function get_all()
	{
		if ($this->kategori_berkas!="") $this->db->like('kategori_berkas',$this->kategori_berkas);
		if ($this->keterangan!="") $this->db->like('keterangan',$this->telepon);

		// if ($this->status!="") $this->db->where('tema',$this->status);
		$query = $this->db->get('ref_kategori_berkas');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('id_kategori_berkas',$this->id_kategori_berkas);
		$query = $this->db->get('ref_kategori_berkas');
		return $query->row();
	}

	

	public function insert()
	{
		$this->db->set('kategori_berkas',$this->kategori_berkas);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->insert('ref_kategori_berkas');
	}
	public function update()
	{
		$this->db->where('id_kategori_berkas',$this->id_kategori_berkas);
		$this->db->set('kategori_berkas',$this->kategori_berkas);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->update('ref_kategori_berkas');
	}

	public function set_by_id()
	{
		$this->db->where('id_kategori_berkas',$this->id_kategori_berkas);
		$query = $this->db->get('ref_kategori_berkas');
		foreach ($query->result() as $row) {
			$this->kategori_berkas 	= $row->kategori_berkas;
			$this->keterangan= $row->keterangan;
			$this->status	= $row->status;
		}
	}
	public function delete()
	{
		$this->db->where('id_kategori_berkas',$this->id_kategori_berkas);
		$query = $this->db->delete('ref_kategori_berkas');	
		return $query;
	}
}