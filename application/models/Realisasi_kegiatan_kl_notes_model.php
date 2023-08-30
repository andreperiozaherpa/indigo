<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_kl_notes_model extends CI_Model
{
	public $id_realisasi_kegiatan_kl_notes;
	public $id_realisasi_kegiatan_kl;
	public $nama_notes;
	public $keterangan_notes;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all(){
		$query = $this->db->get('realisasi_kegiatan_kl_notes');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_realisasi_kegiatan_kl_notes',$this->id_realisasi_kegiatan_kl_notes);
		$query = $this->db->get('realisasi_kegiatan_kl_notes');
		return $query->row();
	}

	public function insert(){
		$this->db->set('nama_notes',$this->nama_notes);
		$this->db->set('id_realisasi_kegiatan_kl',$this->id_realisasi_kegiatan_kl);
		$this->db->set('keterangan_notes',$this->keterangan_notes);
		$this->db->set('id_user',$this->id_user);
		$this->db->set('tanggal_buat',date('Y-m-d'));
		$this->db->set('waktu_buat',date('H:i:s'));
		$this->db->insert('realisasi_kegiatan_kl_notes');
		return $this->db->insert_id();
	}

	public function update(){
		$this->db->where('id_realisasi_kegiatan_kl_notes',$this->id_realisasi_kegiatan_kl_notes);
		$this->db->set('nama_notes',$this->nama_notes);
		// $this->db->set('id_realisasi_kegiatan_kl',$this->id_realisasi_kegiatan_kl);
		$this->db->set('keterangan_notes',$this->keterangan_notes);
		$this->db->update('realisasi_kegiatan_kl_notes');
	}

	public function delete(){
		$this->db->where('id_realisasi_kegiatan_kl_notes',$this->id_realisasi_kegiatan_kl_notes);
		$this->db->delete('realisasi_kegiatan_kl_notes');
	}

}