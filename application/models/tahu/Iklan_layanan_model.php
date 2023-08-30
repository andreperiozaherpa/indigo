<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iklan_layanan_model extends CI_Model
{
	public $id_iklan;
	public $id_skpd;
	public $nama_iklan;
	public $deskripsi;
	public $status;
	public $gambar;
	public $chanel;
	//public $id_services;

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}


	public function get_all($where = null, $limit = null)
	{
		$this->db_tahu->where('id_skpd',$this->session->userdata('id_skpd'));
		if (!empty($this->id_iklan)) $this->db_tahu->where('iklan_layanan.id_iklan',$this->id_iklan);
		//if (!empty($this->id_services)) $this->db_tahu->where('iklan_layanan.id_services',$this->id_services);
		$this->db_tahu->select("*");
		if (!empty($where)) {
			$this->db_tahu->where('status', 'Y');
		}
		if (!empty($limit)) {
			$this->db_tahu->limit($limit);
		}
		//$this->db_tahu->join("services","header.id_services = services.id_services", "left");
		$this->db_tahu->order_by('id_iklan','DESC');
		$query = $this->db_tahu->get('iklan_layanan');
		return $query->result();
	}

	public function get_chanel($chanel){
		$this->db_tahu->where('id_skpd',$this->session->userdata('id_skpd'));
		$this->db_tahu->where(['status' => 'Active', 'chanel' => $chanel]);
		$this->db_tahu->limit(1);
		return $this->db_tahu->get('iklan_layanan')->result();
	}

	public function insert()
	{
		$this->db_tahu->set('nama_iklan',$this->nama_iklan);
		$this->db_tahu->set('deskripsi',$this->deskripsi);
		$this->db_tahu->set('status',$this->status);
		$this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->set('chanel',$this->chanel);
		$this->db_tahu->set('id_skpd',$this->session->userdata('id_skpd'));
		$this->db_tahu->insert('iklan_layanan');
	}
	public function update()
	{
		$this->db_tahu->where('id_iklan',$this->id_iklan);
		$this->db_tahu->set('nama_iklan',$this->nama_iklan);
		$this->db_tahu->set('deskripsi',$this->deskripsi);
		$this->db_tahu->set('status',$this->status);
		$this->db_tahu->set('chanel',$this->chanel);
		//$this->db_tahu->set('id_services',$this->id_services);
		if ($this->gambar!="") $this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->update('iklan_layanan');
	}
	public function delete()
	{
		$this->db_tahu->where('id_iklan',$this->id_iklan);
		$this->db_tahu->delete('iklan_layanan');
	}
	public function set()
	{
		$this->db_tahu->where('id_iklan',$this->id_iklan);
		$query= $this->db_tahu->get('iklan_layanan');
		foreach ($query->result() as $row) {
			$this->nama_iklan = $row->nama_iklan;
			$this->deskripsi = $row->deskripsi;
			$this->status = $row->status;
			$this->gambar=$row->gambar;
			$this->chanel=$row->chanel;
			//$this->id_services=$row->id_services;
		}
	}

	public function set_iklan()
	{
		$this->db_tahu->where('id_skpd',$this->session->userdata('id_skpd'));
		//$this->db_tahu->where('id_services',$this->id_services);
		$query= $this->db_tahu->get('iklan_layanan');
		foreach ($query->result() as $row) {
			$this->nama_iklan = $row->nama_iklan;
			$this->deskripsi = $row->deskripsi;
			$this->status = $row->status;
			$this->gambar=$row->gambar;
			$this->chanel=$row->chanel;
			//$this->id_services=$row->id_services;
		}
	}


}
?>