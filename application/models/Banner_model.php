<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model
{
	public $id_banner;
	public $judul;
	public $url;
	public $gambar;
	public $tgl_posting;

	public function get_all()
	{
		$query = $this->db->get('banner');
		return $query->result();
	}
	public function insert()
	{
		$this->db->set('judul',$this->judul);
		$this->db->set('url',$this->url);
		$this->db->set('gambar',$this->gambar);
		$this->db->set('tgl_posting',date('Y-m-d'));
		$this->db->insert('banner');
	}
	public function update()
	{
		$this->db->where('id_banner',$this->id_banner);
		$this->db->set('judul',$this->judul);
		$this->db->set('url',$this->url);
		if ($this->gambar!="") $this->db->set('gambar',$this->gambar);
		$this->db->update('banner');
	}
	public function delete()
	{
		$this->db->where('id_banner',$this->id_banner);
		$this->db->delete('banner');
	}
	public function set()
	{
		$this->db->where('id_banner',$this->id_banner);
		$query= $this->db->get('banner');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->url = $row->url;
			$this->gambar=$row->gambar;
			$this->tgl_posting = $row->tgl_posting;
		}
	}
}
?>