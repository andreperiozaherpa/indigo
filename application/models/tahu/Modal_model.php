<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modal_model extends CI_Model
{
	public $id_modal;
	public $id_skpd;
	public $judul;
	public $deskripsi;
	public $status;
	public $gambar;
	//public $id_services;

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}

	public function get_all($where = null, $limit = null)
	{
		$this->db_tahu->where('id_skpd',$this->session->userdata('id_skpd'));
		if (!empty($this->id_modal)) $this->db_tahu->where('modal.id_modal',$this->id_modal);
		//if (!empty($this->id_services)) $this->db_tahu->where('modal.id_services',$this->id_services);
		$this->db_tahu->select("*");
		if (!empty($where)) {
			$this->db_tahu->where($where);
		}
		if (!empty($limit)) {
			$this->db_tahu->limit($limit);
		}
		//$this->db_tahu->join("services","header.id_services = services.id_services", "left");
		$this->db_tahu->order_by('id_modal','DESC');
		$query = $this->db_tahu->get('modal');
		return $query->result();
	}

	public function insert()
	{
		$this->db_tahu->set('judul',$this->judul);
		$this->db_tahu->set('deskripsi',$this->deskripsi);
		$this->db_tahu->set('status',$this->status);
		$this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->set('id_skpd',$this->session->userdata('id_skpd'));
		$this->db_tahu->insert('modal');
	}
	public function update()
	{
		$this->db_tahu->where('id_modal',$this->id_modal);
		$this->db_tahu->set('judul',$this->judul);
		$this->db_tahu->set('deskripsi',$this->deskripsi);
		$this->db_tahu->set('status',$this->status);
		//$this->db_tahu->set('id_services',$this->id_services);
		if ($this->gambar!="") $this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->update('modal');
	}
	public function delete()
	{
		$this->db_tahu->where('id_modal',$this->id_modal);
		$this->db_tahu->delete('modal');
	}
	public function set()
	{
		$this->db_tahu->where('id_modal',$this->id_modal);
		$query= $this->db_tahu->get('modal');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->deskripsi = $row->deskripsi;
			$this->status = $row->status;
			$this->gambar=$row->gambar;
			//$this->id_services=$row->id_services;
		}
	}

	public function set_iklan()
	{
		//$this->db_tahu->where('id_services',$this->id_services);
		$this->db_tahu->where('id_skpd',$this->session->userdata('id_skpd'));
		$query= $this->db_tahu->get('modal');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->deskripsi = $row->deskripsi;
			$this->status = $row->status;
			$this->gambar=$row->gambar;
			//$this->id_services=$row->id_services;
		}
	}


}
?>