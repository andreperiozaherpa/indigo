<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{
	public $category_id;
	public $category_name;
	public $category_slug;
	public $category_status;

	public function get_all()
	{
		if ($this->category_status!="") $this->db->where('category_status',$this->category_status);
		$query = $this->db->get('category');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('category_name',$this->category_name);
		$this->db->set('category_status',$this->category_status);
		$this->db->set('category_slug',$this->category_slug);
		$this->db->insert('category');
	}
	public function update()
	{
		$this->db->where('category_id',$this->category_id);
		$this->db->set('category_name',$this->category_name);
		$this->db->set('category_status',$this->category_status);
		$this->db->set('category_slug',$this->category_slug);
		$this->db->update('category');
	}
	
	public function check_availability($old_category,$category_name){
		if ($old_category==$category_name){
			return true;
		}
		else{
			$this->db->where('category_name',$category_name);
			$query = $this->db->get('category');
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
		$this->db->where('category_id',$this->category_id);
		$query = $this->db->get('category');
		foreach ($query->result() as $row) {
			$this->category_name 	= $row->category_name;
			$this->category_slug	= $row->category_slug;
			$this->category_status	= $row->category_status;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('category_slug',$this->category_slug);
		$query = $this->db->get('category');
		foreach ($query->result() as $row) {
			$this->category_name 	= $row->category_name;
			$this->category_slug	= $row->category_slug;
			$this->category_status	= $row->category_status;
		}
	}
	public function delete()
	{
		$this->db->where('category_id',$this->category_id);
		$query = $this->db->delete('category');	
	}
}
?>