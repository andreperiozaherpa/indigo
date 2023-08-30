<?php
	class Notice_model extends CI_Model{

		public $notice_id;
		public $text;
		public $date;
		public $status;

		public function get_all(){
			$query = $this->db->get('notice_board');
			return $query;
		}

		public function insert(){
			$this->db->set('text',$this->text);
			$this->db->set('date',$this->date);
			$this->db->set('status',$this->status);
			$this->db->insert('notice_board');
		}

		public function delete(){
			$this->db->where('notice_id',$this->notice_id);
			$this->db->delete('notice_board');
		}

		public function set_id(){
			$notice_id = $this->uri->segment(3);
			$this->db->select('*');
			$this->db->where('notice_id',$notice_id);
			$query= $this->db->get('notice_board');
			foreach ($query->result() as $row) {
				$this->text = $row->text;
				$this->date = $row->date;
				$this->status = $row->status;
			}
		}
		public function update(){
			$this->db->where('notice_id',$this->notice_id);
			$this->db->set('text',$this->text);
			$this->db->set('date',$this->date);
			$this->db->set('status',$this->status);
			$this->db->update('notice_board');
		}
	}