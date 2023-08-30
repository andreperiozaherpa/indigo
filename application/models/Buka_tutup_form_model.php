<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buka_tutup_form_model extends CI_Model
{
	public $id_agenda;
	public $tema;
	public $tema_slug;
	public $isi_agenda;
	public $tempat;
	public $pengirim;
	public $penerima;
	public $tgl_mulai;
	public $tgl_selesai;
	public $tgl_posting;
	public $jam;
	public $nama_file;
	public $user_id;

	public function get_all()
	{
		// $this->db->join('user','user.user_id = agenda.user_id','left');
		if ($this->tema!="") $this->db->like('tema',$this->tema);
		if ($this->session->userdata('level')!="Administrator") $this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->order_by('tgl_mulai','ASC');
		$query = $this->db->get('agenda');
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('buka_tutup_form');
		return $query->row();
	}

	public function get_by_slug($slug)
	{
		$this->db->where('slug',$slug);
		$query = $this->db->get('buka_tutup_form');
		return $query->row();
	}

	public function update_status($id,$status)
	{
		$this->db->where('id',$id);
		$this->db->set('status', $status);
		return $this->db->update('buka_tutup_form');
	}

	public function get_all_filter()
	{
		$this->db->join('user','user.user_id = agenda.user_id','left');
		if ($this->tema!="") $this->db->like('tema',$this->tema);
		// if ($this->session->userdata('level') != "Administrator") {
		// 	$this->db->like('');
		// }
		$this->db->order_by('tgl_mulai','ASC');
		$query = $this->db->get('agenda');
		return $query->result();
	}
	public function get_some()
	{
		if ($this->session->userdata('level')!="Administrator") $this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->limit(5,0);
		$this->db->order_by('tgl_mulai','ASC');
		$query = $this->db->get('agenda');
		return $query->result();
	}
	public function insert()
	{
		$this->db->set('tema',$this->tema);
		$this->db->set('tema_slug',$this->tema_slug);
		$this->db->set('isi_agenda',$this->isi_agenda);
		$this->db->set('tempat',$this->tempat);
		$this->db->set('pengirim',$this->pengirim);
		$this->db->set('penerima',$this->penerima);
		$this->db->set('tgl_mulai',($this->tgl_mulai));
		$this->db->set('tgl_selesai',($this->tgl_selesai));
		$this->db->set('tgl_posting',date('Y-m-d'));
		$this->db->set('jam',$this->jam);
		$this->db->set('nama_file',$this->nama_file);
		$this->db->set('user_id',$this->user_id);
		$this->db->insert('agenda');
	}
	public function getDate($date)
	{
		
		$s = explode(",", $date);
		$newDate = $s[1];
		$s2 = explode(" ", $newDate);
		$day = $s2[1];
		$month = $s2[2];
		$year = $s2[3];
		$months = array(
			'January' => '1',
			'February' => '2',
			'March' => '3',
			'April' => '4',
			'May' => '5',
			'June' => '6',
			'July' => '7',
			'August' => '8',
			'September' => '9',
			'October' => '10',
			'November' => '11',
			'December' => '12',
		);
		$numMonth = $months[$month];
		return $year."-".$numMonth."-".$day;
	}
	public function update($slug,$data)
	{
		$this->db->where('slug',$slug);
		$this->db->limit(1);
		return $this->db->update('buka_tutup_form',$data);
	}
	
	public function check_availability($old_tema,$tema){
		if ($old_tema==$tema){
			return true;
		}
		else{
			$this->db->where('tema',$tema);
			$query = $this->db->get('agenda');
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
		$this->db->where('id_agenda',$this->id_agenda);
		$query = $this->db->get('agenda');
		foreach ($query->result() as $row) {
			$this->tema 	= $row->tema;
			$this->tema_slug	= $row->tema_slug;
			$this->isi_agenda	= $row->isi_agenda;
			$this->tempat	= $row->tempat;
			$this->pengirim	= $row->pengirim;
			$this->penerima	= $row->penerima;
			$this->tgl_mulai	= $row->tgl_mulai;
			$this->tgl_selesai	= $row->tgl_selesai;
			$this->tgl_posting	= $row->tgl_posting;
			$this->jam	= $row->jam;
			$this->nama_file	= $row->nama_file;
			$this->user_id	= $row->user_id;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('tema_slug',$this->tema_slug);
		$query = $this->db->get('agenda');
		foreach ($query->result() as $row) {
			$this->tema 	= $row->tema;
			$this->tema_slug	= $row->tema_slug;
			$this->isi_agenda	= $row->isi_agenda;
			$this->tempat	= $row->tempat;
			$this->pengirim	= $row->pengirim;
			$this->penerima	= $row->penerima;
			$this->tgl_mulai	= $row->tgl_mulai;
			$this->tgl_selesai	= $row->tgl_selesai;
			$this->tgl_posting	= $row->tgl_posting;
			$this->jam	= $row->jam;
			$this->nama_file	= $row->nama_file;
			$this->user_id	= $row->user_id;
		}
	}
	public function delete()
	{
		$this->db->where('id_agenda',$this->id_agenda);
		$query = $this->db->delete('agenda');	
	}
}
?>