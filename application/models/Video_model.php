<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video_model extends CI_Model
{
	public $id_video;
	public $judul;
	public $link;
	public $category_video_id;
	public $date_video;
	public $time_video;
	public $content;
	public $search;
	public $search_c;

	public function get_all()
	{
		if ($this->judul!="") $this->db->like('judul',$this->judul);
		if ($this->category_video_id!="") $this->db->where('video.category_video_id',$this->category_video_id);
		$this->db->join('category_video','category_video.category_video_id = video.category_video_id');
		$query = $this->db->get('video');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('video.id_video',$this->id_video);
		$this->db->join('category_video','category_video.category_video_id = video.category_video_id');
		$query = $this->db->get('video');
		return $query->row();
	}
	public function insert()
	{
		$this->db->set('judul',$this->judul);
		$this->db->set('link',$this->link);
		$this->db->set('content',$this->content);
		$this->db->set('category_video_id',$this->category_video_id);
		$this->db->set('date_video',$this->date_video);
		$this->db->set('time_video',$this->time_video);
		$this->db->insert('video');
	}
	public function update()
	{
		$this->db->where('id_video',$this->id_video);
		$this->db->set('judul',$this->judul);
		$this->db->set('link',$this->link);
		$this->db->set('content',$this->content);
		$this->db->set('category_video_id',$this->category_video_id);
		$this->db->update('video');
	}
	
	
	public function set_by_id()
	{
		$this->db->where('id_video',$this->id_video);
		$query = $this->db->get('video');
		foreach ($query->result() as $row) {
			$this->judul 	= $row->judul;
			$this->link	= $row->link;
			$this->category_video_id	= $row->category_video_id;
			$this->content	= $row->content;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('link',$this->link);
		$query = $this->db->get('video');
		foreach ($query->result() as $row) {
			$this->judul 	= $row->judul;
			$this->link	= $row->link;
		}
	}


	public function get_limit($limit=null)
	{
		if ($this->id_video!="") $this->db->where('id_video',$this->id_video);
		if (!empty($limit)) $this->db->limit($limit);
		$this->db->order_by('id_video','DESC');
		$query = $this->db->get('video');
		return $query->result();
	}

	public function delete()
	{
		$this->db->where('id_video',$this->id_video);
		$query = $this->db->delete('video');	
	}

	public function get_for_page($limit,$offset)
	{

		$this->db->join('category_video','category_video.category_video_id = video.category_video_id');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR content like '%$this->search%'  ");
			$this->db->group_end();
		}
		if ($this->search_c!="") $this->db->where('video.category_video_id',$this->search_c);
		$this->db->order_by('date_video','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('video');
		return $query->result();
	}

	public function get_total_row()
	{

		$this->db->join('category_video','category_video.category_video_id = video.category_video_id');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR content like '%$this->search%'  ");
			$this->db->group_end();
		}
		if ($this->search_c!="") $this->db->where('video.category_video_id',$this->search_c);
		$query = $this->db->get('video');
		return $query->num_rows();
	}
}

?>