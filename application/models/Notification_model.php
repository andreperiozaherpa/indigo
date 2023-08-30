<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	public function get_all(){
		$this->db->order_by('ndate desc, ntime desc'); 
		$this->db->where('web',1);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$q = $this->db->get('notification');
		return $q->result();
	}
	public function get_by_module($data){
		if ($this->uri->segment(1) == 'simpeg' OR $this->uri->segment(1) == 'peer_review') {
			return array();
		}
		$this->db->where('data',$data);		
		$this->db->where('read_status',0);
		$this->db->where('web',1);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$get = $this->db->get('notification');
		return $get->result();
	}
	public function get_by_id($notification_id){
		$this->db->where('notification_id',$notification_id);
		$q = $this->db->get('notification');
		return $q->row();
	}
	public function delete($notification_id){
		$this->db->where('notification_id',$notification_id);
		return $this->db->delete('notification');
	}
	public function get_some_unread(){
		if ($this->uri->segment(1) == 'simpeg' OR $this->uri->segment(1) == 'peer_review') {
			return array();
		}
		$this->db->order_by('ndate desc, ntime desc'); 
		$this->db->limit(5);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->where('read_status',0);
		$this->db->where('web',1);
		$q = $this->db->get('notification');
		return $q->result();
	}
	public function insert($data){
		$dataa = $data['data'];
		$data_id = $data['data_id'];
		$this->db->where('data',$dataa);
		$this->db->where('data_id',$data_id);
		$this->db->where('read_status',0);
		$this->db->where('web',1);
		$get = $this->db->get('notification');
		if($get->num_rows()==0){
			$this->db->set('web',1);
			$this->db->set('notification_id','N-'.rand(10,9999).time());
			$this->db->insert('notification',$data);
		}else{
			$this->db->where('notification_id',$get->row()->notification_id);
			$this->db->update('notification',$data);
		}
	}

	public function read($data,$data_id,$user_id=''){
		if($user_id!=''){
			$this->db->where('user_id',$user_id);
		}
		$this->db->where('data',$data);
		$this->db->where('data_id',$data_id);
		$this->db->where('read_status',0);
		$this->db->where('web',1);
		$get = $this->db->get('notification');
		if($get->num_rows()==0){
			return false;
		}else{
			$this->db->where('notification_id',$get->row()->notification_id);
			$this->db->set('read_status',1);
			$this->db->update('notification');
			return true;
		}
	}

	public function get_by_category($category){
		$this->db->where('category',$category);
		$this->db->where('web',1);
		$this->db->where('read_status',0);
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$q = $this->db->get('notification');
		return $q->result();
	}
}