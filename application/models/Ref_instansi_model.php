<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_instansi_model extends CI_Model
{
	public $id_instansi;
	public $nama_instansi;
	public $telepon;
	public $email;
	public $website;
	public $keterangan;
	public $logo;
	public $status;
	public $level;
	public $id_koordinator;

	public function get_all()
	{
		if ($this->nama_instansi!="") $this->db->like('nama_instansi',$this->nama_instansi);
		if ($this->telepon!="") $this->db->like('telepon',$this->telepon);
		if ($this->email!="") $this->db->like('email',$this->email);
		if ($this->website!="") $this->db->like('website',$this->website);
		if ($this->keterangan!="") $this->db->like('keterangan',$this->keterangan);
		// if ($this->status!="") $this->db->where('tema',$this->status);
		if ($this->level!="") $this->db->where('level',$this->level);
		if ($this->id_koordinator!="") $this->db->where('id_koordinator',$this->id_koordinator);
		$query = $this->db->get('ref_instansi');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('id_instansi',$this->id_instansi);
		$query = $this->db->get('ref_instansi');
		return $query->row();
	}

	public function get_koordinator(){
		$this->db->where('id_koordinator',0);
		$query = $this->db->get('ref_instansi');
		return $query->result();
	}

	public function get_lembaga($id_koordinator){
		$this->db->where('id_koordinator',$id_koordinator);
		$query = $this->db->get('ref_instansi');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('nama_instansi',$this->nama_instansi);
		$this->db->set('telepon',$this->telepon);
		$this->db->set('email',$this->email);
		$this->db->set('website',$this->website);
		$this->db->set('keterangan',($this->keterangan));
		$this->db->set('logo',($this->logo));
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->set('id_koordinator',$this->id_koordinator);
		$this->db->insert('ref_instansi');
	}
	public function update()
	{
		$this->db->where('id_instansi',$this->id_instansi);
		$this->db->set('nama_instansi',$this->nama_instansi);
		$this->db->set('telepon',$this->telepon);
		$this->db->set('email',$this->email);
		$this->db->set('website',$this->website);
		$this->db->set('keterangan',($this->keterangan));
		if($this->logo!=''){
			$this->db->set('logo',($this->logo));
		}
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->set('id_koordinator',$this->id_koordinator);
		$this->db->update('ref_instansi');
	}

	public function set_by_id()
	{
		$this->db->where('id_instansi',$this->id_instansi);
		$query = $this->db->get('ref_instansi');
		foreach ($query->result() as $row) {
			$this->nama_instansi 	= $row->tema;
			$this->telepon	= $row->email;
			$this->email	= $row->email;
			$this->website	= $row->website;
			$this->keterangan	= $row->keterangan;
			$this->logo	= $row->logo;
			$this->status	= $row->status;
			$this->level	= $row->level;
			$this->id_koordinator	= $row->id_koordinator;
		}
	}
	public function delete()
	{
		$this->db->where('id_instansi',$this->id_instansi);
		$query = $this->db->delete('ref_instansi');	
		return $query;
	}

	public function get_all_instansi()
	{
		$this->db->order_by('level','ASC');
		$this->db->order_by('id_koordinator','ASC');
		$this->db->order_by('nama_instansi','ASC');
		$query = $this->db->get('ref_instansi');
		return $query->result();
	}
}