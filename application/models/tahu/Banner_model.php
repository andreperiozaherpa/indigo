<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model
{
	public $id_banner;
	public $judul;
	public $url;
	public $gambar;
	public $tgl_posting;

	public function __construct()
	{
		parent::__construct();
		$this->db_tahu = $this->load->database('tahu', TRUE);
	}

	public function get_all()
	{
		$query = $this->db_tahu->get('banner');
		return $query->result();
	}
	public function insert()
	{
		$this->db_tahu->set('judul',$this->judul);
		$this->db_tahu->set('url',$this->url);
		$this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->set('tgl_posting',date('Y-m-d'));
		$this->db_tahu->insert('banner');
	}
	public function update()
	{
		$this->db_tahu->where('id_banner',$this->id_banner);
		$this->db_tahu->set('judul',$this->judul);
		$this->db_tahu->set('url',$this->url);
		if ($this->gambar!="") $this->db_tahu->set('gambar',$this->gambar);
		$this->db_tahu->update('banner');
	}
	public function delete()
	{
		$this->db_tahu->where('id_banner',$this->id_banner);
		$this->db_tahu->delete('banner');
	}
	public function set()
	{
		$this->db_tahu->where('id_banner',$this->id_banner);
		$query= $this->db_tahu->get('banner');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->url = $row->url;
			$this->gambar=$row->gambar;
			$this->tgl_posting = $row->tgl_posting;
		}
	}
}
?>