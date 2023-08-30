<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kode_model extends CI_Model
{
	public $id_kode;
	public $kode;
	public $keterangan;
	public $status;


	public function get_all()
	{
		if ($this->kode!="") $this->db->like('kode',$this->kode);
		if ($this->keterangan!="") $this->db->like('keterangan',$this->telepon);

		// if ($this->status!="") $this->db->where('tema',$this->status);
		$query = $this->db->get('ref_kode');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('id_kode',$this->id_kode);
		$query = $this->db->get('ref_kode');
		return $query->row();
	}

	

	public function insert()
	{
		$this->db->set('kode',$this->kode);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->insert('ref_kode');
	}
	public function update()
	{
		$this->db->where('id_kode',$this->id_kode);
		$this->db->set('kode',$this->kode);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->update('ref_kode');
	}

	public function set_by_id()
	{
		$this->db->where('id_kode',$this->id_kode);
		$query = $this->db->get('ref_kode');
		foreach ($query->result() as $row) {
			$this->kode 	= $row->kode;
			$this->keterangan= $row->keterangan;
			$this->status	= $row->status;
		}
	}
	public function delete()
	{
		$this->db->where('id_kode',$this->id_kode);
		$query = $this->db->delete('ref_kode');	
		return $query;
	}
}