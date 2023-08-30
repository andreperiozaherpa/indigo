<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_model extends CI_Model
{
	public $id_berkas;
	public $id_unit_kerja;
	public $id_kategori_berkas;
	public $nama_kegiatan;
	public $keterangan;
	public $tanggal_input;
	public $waktu_input;
	public $data_rahasia;
	public $sharing_berkas;
	public $id_user;

	public $tanggal_awal;
	public $tanggal_akhir;

	public $search;
	public $search_c;

	public function get_all($level=NULL){
		if($this->id_unit_kerja!='') $this->db->where('berkas.id_unit_kerja',$this->id_unit_kerja);
		if($this->nama_kegiatan!='') $this->db->like('nama_kegiatan',$this->nama_kegiatan);
		if(!empty($level)){
			if($level!='Administrator'){
				$this->db->where('user_id',$this->id_user);
				$user = $this->db->get('user')->row();
				$this->db->where('id_user',$this->user_id);
				$this->db->or_where("CONCAT(';', sharing_berkas,';') LIKE '%;".$user->unit_kerja_id.";%'", NULL, FALSE); 
			}
		}
		if(($this->user_id!='' && $level==NULL)){
			$this->db->where('berkas.id_user',$this->id_user);
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja=berkas.id_unit_kerja');
		$query = $this->db->get('berkas');
		return $query->result();

	}

	public function get_for_export($level=NULL){
		if($this->tanggal_awal!='' && $this->tanggal_akhir!=''){
			$this->db->where('tanggal_input >=', $this->tanggal_awal);
			$this->db->where('tanggal_input <=', $this->tanggal_akhir);
		}

		if(!empty($level)){
			if($level!='Administrator'){
				$this->db->where('user_id',$this->id_user);
				$user = $this->db->get('user')->row();
				$this->db->where('id_user',$this->user_id);
				$this->db->or_where("CONCAT(';', sharing_berkas,';') LIKE '%;".$user->unit_kerja_id.";%'", NULL, FALSE); 
			}
		}

		if($this->id_unit_kerja!='') $this->db->where('id_unit_kerja',$this->id_unit_kerja);

		$query = $this->db->get('berkas');
		return $query->result();
	}


	public function get_by_id(){
		$this->db->where('id_berkas',$this->id_berkas);
		$this->db->join('ref_kategori_berkas','ref_kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas.id_unit_kerja','left');
		$query = $this->db->get('berkas');
		return $query->row();
	}


	public function get_for_detail(){
		$this->db->where('id_berkas',$this->id_berkas);
		$this->db->join('ref_kategori_berkas','ref_kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas.id_unit_kerja','left');
		$this->db->join('user','user.user_id = berkas.id_user');
		$query = $this->db->get('berkas');
		return $query->row();
	}

	public function insert(){
		$this->db->set('id_unit_kerja',$this->id_unit_kerja=='' ? 0 : $this->id_unit_kerja);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('tanggal_input',$this->tanggal_input);
		$this->db->set('waktu_input',$this->waktu_input);
		$this->db->set('id_kategori_berkas',$this->id_kategori_berkas);
		$this->db->set('data_rahasia',$this->data_rahasia);
		$this->db->set('sharing_berkas',$this->sharing_berkas);
		$this->db->set('id_user',$this->id_user=='' ? 0 : $this->id_user);
		$this->db->insert('berkas');
		return $this->db->insert_id();
	}

	public function update(){
		$this->db->where('id_berkas',$this->id_berkas);
		$this->db->set('id_unit_kerja',$this->id_unit_kerja=='' ? 0 : $this->id_unit_kerja);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('keterangan',$this->keterangan);
		$this->db->set('id_kategori_berkas',$this->id_kategori_berkas);
		$this->db->set('data_rahasia',$this->data_rahasia);
		$this->db->set('sharing_berkas',$this->sharing_berkas);
		$this->db->update('berkas');
	}

	public function delete(){
		$this->db->where('id_berkas',$this->id_berkas);
		$this->db->delete('berkas');
		$this->db->where('id_berkas',$this->id_berkas);
		$get = $this->db->get('berkas_file')->result();
		foreach($get as $g){
			unlink($g->path_file.$g->hash_file);
		}
		$this->db->where('id_berkas',$this->id_berkas);
		$this->db->delete('berkas_file');
	}

	public function get_for_page($limit,$offset)
	{

		$this->db->join('ref_kategori_berkas','ref_kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = berkas.id_unit_kerja','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" nama_kegiatan like '%$this->search%' OR berkas.keterangan like '%$this->search%'  ");
			$this->db->group_end();
		}
		if ($this->search_c!="") $this->db->where('berkas.id_kategori_berkas',$this->search_c);
		$this->db->where('data_rahasia',0);
		$this->db->order_by('tanggal_input','DESC');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('berkas');
		return $query->result();
	}

	public function get_total_row()
	{
		$this->db->join('ref_kategori_berkas','ref_kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas','left');
		if ($this->search!=""){
			$this->db->group_start();
			$this->db->where(" nama_kegiatan like '%$this->search%' OR berkas.keterangan like '%$this->search%'  ");
			$this->db->group_end();
		}
		if ($this->search_c!="") $this->db->where('berkas.id_kategori_berkas',$this->search_c);
		$this->db->where('data_rahasia',0);
		$query = $this->db->get('berkas');
		return $query->num_rows();
	}

}