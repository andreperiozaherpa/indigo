<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model
{
	public $id_download;
	public $judul;
	public $nama_file;
	public $hits;
	public $tgl_posting;
	public $category_id;
	public $detail;
	public $link;
	public $author;
	public $search;
	public $search_c;

	public function get_all()
	{
		$query = $this->db->get('download');
		return $query->result();
	}
	public function get_some_download()
	{
		$this->db->limit(5,0);
		$query = $this->db->get('download');
		return $query->result();
	}
	public function insert()
	{
		$this->db->set('judul',$this->judul);
		$this->db->set('link',$this->link);
		$this->db->set('nama_file',$this->nama_file);
		$this->db->set('category_id',$this->category_id);
		$this->db->set('detail',$this->detail);
		$this->db->set('hits','0');
		$this->db->set('tgl_posting',date('Y-m-d'));
		$this->db->set('author',$this->session->userdata('user_id'));
		$this->db->insert('download');
	}
	public function update()
	{
		$this->db->where('id_download',$this->id_download);
		$this->db->set('judul',$this->judul);
		$this->db->set('link',$this->link);
		$this->db->set('category_id',$this->category_id);
		$this->db->set('detail',$this->detail);
		
		if ($this->nama_file!="") $this->db->set('nama_file',$this->nama_file);
		$this->db->update('download');
	}
	public function delete()
	{
		$this->db->where('id_download',$this->id_download);
		$this->db->delete('download');
	}
	public function set()
	{
		$this->db->where('id_download',$this->id_download);
		$query= $this->db->get('download');
		foreach ($query->result() as $row) {
			$this->judul = $row->judul;
			$this->nama_file = $row->nama_file;
			$this->link = $row->link;
			$this->category_id = $row->category_id;
			$this->detail = $row->detail;
			$this->hits=$row->hits;
			$this->tgl_posting = $row->tgl_posting;
			$this->author = $row->author;
		}
	}

	public function get_by_id()
	{
		$this->db->join('category_download','category_download.category_id = download.category_id','left');
		$this->db->where('id_download',$this->id_download);
		$query = $this->db->get('download');
		return $query->result();
	}

	public function hits()
	{
		$this->db->set('hits', 'hits+1', FALSE);
		$this->db->where('id_download',$this->id_download);
		$this->db->update('download');
	}

	public function get_for_page($limit,$offset)
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_download','category_download.category_id = download.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->search_c!="") $this->db->where('download.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$this->db->order_by('tgl_posting','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('download');
		return $query->result();
	}

	public function get_total_row()
	{

		// $this->db->join('channel','channel.channel_id = post.channel_id','left');
		$this->db->join('category_download','category_download.category_id = download.category_id','left');
		// $this->db->join('user','user.user_id = post.author','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" judul like '%$this->search%' OR detail like '%$this->search%'  ");
			$this->db->group_end();
		}
		// if ($this->author!="") $this->db->where('author',$this->author);
		// if ($this->post_status!="") $this->db->where('post_status',$this->post_status);
		// if ($this->external!="") $this->db->where('category.category_id > 0');
		
		if ($this->search_c!="") $this->db->where('download.category_id',$this->search_c);
		// if ($this->channel_id!="") $this->db->where('channel.channel_id',$this->channel_id);
		// if ($this->tag!="") $this->db->where(" tag like '%$this->tag%' ");
		$query = $this->db->get('download');
		return $query->num_rows();
	}
}
?>