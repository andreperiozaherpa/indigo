<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_unit_kerja_model extends CI_Model
{
	public $id_unit_kerja;
	public $id_induk;
	public $level_unit_kerja;
	public $nama_unit_kerja;
	public $telp;
	public $email;
	public $status;
	public $ket_induk;

	public function get_all()
	{
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_parent()
	{
		$this->db->where('id_induk',$this->id_induk);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_level()
	{
		$this->db->where('level_unit_kerja',$this->level_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		return $query->row();
	}

	public function get_koordinator(){
		$this->db->where('id_koordinator',0);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function get_lembaga($id_koordinator){
		$this->db->where('id_koordinator',$id_koordinator);
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('nama_unit_kerja',$this->nama_unit_kerja);
		$this->db->set('telepon',$this->telepon);
		$this->db->set('email',$this->email);
		$this->db->set('website',$this->website);
		$this->db->set('keterangan',($this->keterangan));
		$this->db->set('logo',($this->logo));
		$this->db->set('status',$this->status);
		$this->db->set('level',$this->level);
		$this->db->set('id_koordinator',$this->id_koordinator);
		$this->db->insert('ref_unit_kerja');
	}
	public function update()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$this->db->set('nama_unit_kerja',$this->nama_unit_kerja);
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
		$this->db->update('ref_unit_kerja');
	}

	public function set_by_id()
	{
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->get('ref_unit_kerja');
		foreach ($query->result() as $row) {
			$this->nama_unit_kerja 	= $row->tema;
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
		$this->db->where('id_unit_kerja',$this->id_unit_kerja);
		$query = $this->db->delete('ref_unit_kerja');	
		return $query;
	}

	public function get_all_unit_kerja()
	{
		$this->db->order_by('level','ASC');
		$this->db->order_by('id_koordinator','ASC');
		$this->db->order_by('nama_unit_kerja','ASC');
		$query = $this->db->get('ref_unit_kerja');
		return $query->result();
	}
}