<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model
{
	public $tag_id;
	public $tag_name;
	public $tag_slug;

	public function get_all()
	{
		$query = $this->db->get('tag');
		return $query->result();
	}
	public function insert()
	{
		$this->db->set('tag_name',$this->tag_name);
		$this->db->set('tag_slug',$this->tag_slug);
		$this->db->insert('tag');
	}
	public function update()
	{
		$this->db->where('tag_id',$this->tag_id);
		$this->db->set('tag_name',$this->tag_name);
		$this->db->set('tag_slug',$this->tag_slug);
		$this->db->update('tag');
	}
	public function check_availability($old_tag,$tag_name){
		if ($old_tag==$tag_name){
			return true;
		}
		else{
			$this->db->where('tag_name',$tag_name);
			$query = $this->db->get('tag');
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
		$this->db->where('tag_id',$this->tag_id);
		$query = $this->db->get('tag');
		foreach ($query->result() as $row) {
			$this->tag_name 	= $row->tag_name;
			$this->tag_slug	= $row->tag_slug;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('tag_slug',$this->tag_slug);
		$query = $this->db->get('tag');
		foreach ($query->result() as $row) {
			$this->tag_name 	= $row->tag_name;
			$this->tag_slug	= $row->tag_slug;
		}
	}
	public function delete()
	{
		$this->db->where('tag_id',$this->tag_id);
		$query = $this->db->delete('tag');	
	}
}

?>