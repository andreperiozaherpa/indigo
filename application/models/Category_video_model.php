<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_video_model extends CI_Model
{
	public $category_video_id;
	public $category_video_name;
	public $category_video_status;

	public function get_all()
	{
		if ($this->category_video_status!="") $this->db->where('category_video_status',$this->category_video_status);
		$query = $this->db->get('category_video');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('category_video_name',$this->category_video_name);
		$this->db->set('category_video_status',$this->category_video_status);
		$this->db->insert('category_video');
	}
	public function update()
	{
		$this->db->where('category_video_id',$this->category_video_id);
		$this->db->set('category_video_name',$this->category_video_name);
		$this->db->set('category_video_status',$this->category_video_status);
		$this->db->update('category_video');
	}
	
	public function check_availability($old_category_video,$category_video_name){
		if ($old_category_video==$category_video_name){
			return true;
		}
		else{
			$this->db->where('category_video_name',$category_video_name);
			$query = $this->db->get('category_video');
			if ($query->num_rows() == 0){
				return true;
			}
			else{
				return false;
			}
		}
	}
	public function set_by_id()
	{
		$this->db->where('category_video_id',$this->category_video_id);
		$query = $this->db->get('category_video');
		foreach ($query->result() as $row) {
			$this->category_video_name 	= $row->category_video_name;
			$this->category_video_status	= $row->category_video_status;
		}
	}
	public function delete()
	{
		$this->db->where('category_video_id',$this->category_video_id);
		$query = $this->db->delete('category_video');	
	}
}
?>