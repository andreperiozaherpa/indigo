<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Img_header_model extends CI_Model
{
	public $id_header;
	public $judul;
	public $deskripsi;
	public $link;
	public $status;
	public $gbr_header;
	//public $id_services;

	public function get_all()
	{
		if (!empty($this->id_header)) $this->db->where('header.id_header',$this->id_header);
		//if (!empty($this->id_services)) $this->db->where('header.id_services',$this->id_services);
		$this->db->select("*");
		//$this->db->join("services","header.id_services = services.id_services", "left");
		$query = $this->db->get('header');
		return $query->result();
	}
	public function insert()
	{
		$this->db->set('judul',$this->judul);
		$this->db->set('deskripsi',$this->deskripsi);
		$this->db->set('link',$this->link);
		$this->db->set('status',$this->status);
		$this->db->set('gbr_header',$this->gbr_header);
		$this->db->insert('header');
	}
	public function update()
	{
		$this->db->where('id_header',$this->id_header);
		$this->db->set('judul',$this->judul);
		$this->db->set('deskripsi',$this->deskripsi);
		$this->db->set('link',$this->link);
		$this->db->set('status',$this->status);
		//$this->db->set('id_services',$this->id_services);
		if ($this->gbr_header!="") $this->db->set('gbr_header',$this->gbr_header);
		$this->db->update('header');
	}
	public function delete()
	{
		$this->db->where('id_header',$this->id_header);
		$this->db->delete('header');
	}
	public function set()
	{
		$this->db->where('id_header',$this->id_header);
		$query= $this->db->get('header');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->deskripsi = $row->deskripsi;
			$this->link = $row->link;
			$this->status = $row->status;
			$this->gbr_header=$row->gbr_header;
			//$this->id_services=$row->id_services;
		}
	}

	public function set_header()
	{
		//$this->db->where('id_services',$this->id_services);
		$query= $this->db->get('header');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->deskripsi = $row->deskripsi;
			$this->link = $row->link;
			$this->status = $row->status;
			$this->gbr_header=$row->gbr_header;
			//$this->id_services=$row->id_services;
		}
	}


}
?>