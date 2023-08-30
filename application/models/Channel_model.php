<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel_model extends CI_Model
{
	public $channel_id;
	public $channel_name;
	public $channel_slug;
	public $channel_status;

	public function get_all()
	{
		if ($this->channel_status!="") $this->db->where('channel_status',$this->channel_status);
		$query = $this->db->get('channel');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('channel_name',$this->channel_name);
		$this->db->set('channel_status',$this->channel_status);
		$this->db->set('channel_slug',$this->channel_slug);
		$this->db->insert('channel');
	}
	public function update()
	{
		$this->db->where('channel_id',$this->channel_id);
		$this->db->set('channel_name',$this->channel_name);
		$this->db->set('channel_status',$this->channel_status);
		$this->db->set('channel_slug',$this->channel_slug);
		$this->db->update('channel');
	}
	
	public function check_availability($old_channel,$channel_name){
		if ($old_channel==$channel_name){
			return true;
		}
		else{
			$this->db->where('channel_name',$channel_name);
			$query = $this->db->get('channel');
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
		$this->db->where('channel_id',$this->channel_id);
		$query = $this->db->get('channel');
		foreach ($query->result() as $row) {
			$this->channel_name 	= $row->channel_name;
			$this->channel_slug	= $row->channel_slug;
			$this->channel_status	= $row->channel_status;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('channel_slug',$this->channel_slug);
		$query = $this->db->get('channel');
		foreach ($query->result() as $row) {
			$this->channel_name 	= $row->channel_name;
			$this->channel_slug	= $row->channel_slug;
			$this->channel_status	= $row->channel_status;
		}
	}
	public function delete()
	{
		$this->db->where('channel_id',$this->channel_id);
		$query = $this->db->delete('channel');	
	}
}
?>