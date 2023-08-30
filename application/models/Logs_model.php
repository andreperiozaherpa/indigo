<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model
{
	public $logs_id;
	public $user_id;
	public $activity;
	public $category;
	public $description;
	public $time;


	public function get_all()
	{
		$this->db->join('user','user.user_id = logs.user_id','left');
		$this->db->order_by('time','DESC');
		$query = $this->db->get('logs');
		return $query->result();
	}

	public function set_by_id()
	{
		$user = $this->uri->segment(3);
		$this->db->where('logs.user_id',$user);
		$this->db->join('user','user.user_id = logs.user_id','left');
		$this->db->order_by('time','DESC');
		$query = $this->db->get('logs');
		return $query->result();
	}

	public function get_some()
	{
		$this->db->limit(5,0);
		$this->db->join('user','user.user_id = logs.user_id','left');
		// $this->db->join('employee','employee.employee_id = user.employee_id','left');
		$this->db->order_by('time','DESC');
		$query = $this->db->get('logs');
		return $query->result();
	}

	public function get_some_id($user)
	{
		$this->db->where('logs.user_id',$user);
		$this->db->limit(5,0);
		$this->db->join('user','user.user_id = logs.user_id','left');
		$this->db->order_by('time','DESC');
		$query = $this->db->get('logs');
		return $query->result();
	}

	public function get_some_ids($user)
	{
		$this->db->where('logs.user_id',$user);
		$this->db->join('user','user.user_id = logs.user_id','left');
		$this->db->order_by('time','DESC');
		$query = $this->db->get('logs');
		return $query->result();
	}

	public function insert()
	{
		$this->db->set('user_id',$this->user_id);
		$this->db->set('activity',$this->activity);
		$this->db->set('description',$this->description);
		$this->db->set('category',$this->category);
		$this->db->insert('logs');
	}

	public function insert_log($data){
		if(!empty($data['user_id'])){
			$this->db->set('user_id',$data['user_id']);
		}
		else{
			$this->db->set('user_id',$this->session->userdata('user_id'));
		}
		$this->db->set('activity',$data['action']." ".$data['function']);
		$this->db->set('description',"dengan ".$data['key_name']." ".$data['key_value']);
		$this->db->set('category',$data['category']);
		$this->db->insert('logs');
	}



}
?>
