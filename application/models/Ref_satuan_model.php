<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_satuan_model extends CI_Model
{
	public $id_satuan;
	public $satuan;
	public $keterangan;
	public $status;


	public function get_all()
	{
		if ($this->satuan!="") $this->db->like('satuan',$this->satuan);
		if ($this->keterangan!="") $this->db->like('keterangan',$this->telepon);

		// if ($this->status!="") $this->db->where('tema',$this->status);
		$query = $this->db->get('ref_satuan');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('id_satuan',$this->id_satuan);
		$query = $this->db->get('ref_satuan');
		return $query->row();
	}

	

	public function insert()
	{
		$this->db->set('satuan',$this->satuan);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->insert('ref_satuan');
	}
	public function update()
	{
		$this->db->where('id_satuan',$this->id_satuan);
		$this->db->set('satuan',$this->satuan);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('status',$this->status);
		$this->db->update('ref_satuan');
	}

	public function set_by_id()
	{
		$this->db->where('id_satuan',$this->id_satuan);
		$query = $this->db->get('ref_satuan');
		foreach ($query->result() as $row) {
			$this->satuan 	= $row->satuan;
			$this->keterangan= $row->keterangan;
			$this->status	= $row->status;
		}
	}
	public function delete()
	{
		$this->db->where('id_satuan',$this->id_satuan);
		$query = $this->db->delete('ref_satuan');	
		return $query;
	}
}