<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model
{
	public $gallery_id;
	public $album_id;
	public $gallery_title;
	public $picture;
	public $album_title;	
	public $album_description;
	public $album_picture;
	public $pict_count;
	public function get_album()
	{
		$query = $this->db->get('album');
		return $query->result();
	}
	public function get_gallery_by_album()
	{
		$this->db->where('album_id',$this->album_id);
		$query = $this->db->get('album');
		return $query->result();
	}
	public function create_album()
	{
		$this->db->set('album_title',$this->album_title);
		$this->db->set('description',$this->album_description);
		$this->db->set('picture',$this->album_picture);
		$this->db->insert('album');
	}
	public function update_album()
	{
		$this->db->where('album_id',$this->album_id);
		$this->db->set('album_title',$this->album_title);
		$this->db->set('description',$this->album_description);
		if ($this->album_picture!="") $this->db->set('picture',$this->album_picture);
		$this->db->update('album');
	}
	public function delete_album()
	{
		$this->db->where('album_id',$this->album_id);
		$this->db->delete('album');
	}
	public function set_album_by_id()
	{
		$this->db->where('album_id',$this->album_id);
		$query = $this->db->get('album');
		foreach ($query->result() as $row) {
			$this->album_title = $row->album_title;
			$this->album_picture = $row->picture;
			$this->album_description = $row->description;
			$this->pict_count = $row->pict_count;
		}
	}
	public function get_gallery($limit=null)
	{
		if ($this->album_id!="") $this->db->where('album_id',$this->album_id);
		if (!empty($limit)) $this->db->limit($limit);
		$query = $this->db->get('gallery');
		return $query->result();
	}
	public function delete_gallery()
	{
		$this->db->where('picture',$this->picture);
		$query = $this->db->get('gallery');
		$album_id = "";
		foreach ($query->result() as $row) {
			$album_id = $row->album_id;
		}
		$this->db->where('picture',$this->picture);
		$this->db->delete('gallery');
		$this->update_pict_count($album_id,'delete');
	}
	public function insert_gallery()
	{
		$this->db->set('picture',$this->picture);
		$this->db->set('gallery_title',$this->picture);
		$this->db->set('album_id',$this->album_id);
		$this->db->insert('gallery');
		$this->update_pict_count($this->album_id,'insert');
	}
	public function update_pict_count($album_id,$act)
	{
		$this->db->where('album_id',$album_id);
		$query = $this->db->get('album');
		$pict_count = 0 ;
		foreach ($query->result() as $row) {
			$pict_count = $row->pict_count;
		}
		if ($act=='insert')
			$pict_count = $pict_count + 1;
		else
			$pict_count = $pict_count - 1;
		$this->db->where('album_id',$album_id);
		$this->db->set('pict_count',$pict_count);
		$this->db->update('album');
	}
}
?>