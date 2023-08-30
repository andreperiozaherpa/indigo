<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_kl_notes_file_model extends CI_Model
{
	public $id_realisasi_kegiatan_kl_notes_file;
	public $id_realisasi_kegiatan_kl_notes;
	public $file_hash;
	public $file_name;
	public $file_ext;
	public $file_type;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all(){
		$query = $this->db->get('realisasi_kegiatan_kl_notes_file');
		return $query->result();
	}

	public function get_by_n(){
		$this->db->where('id_realisasi_kegiatan_kl_notes',$this->id_realisasi_kegiatan_kl_notes);
		$query = $this->db->get('realisasi_kegiatan_kl_notes_file');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_realisasi_kegiatan_kl_notes_file',$this->id_realisasi_kegiatan_kl_notes_file);
		$query = $this->db->get('realisasi_kegiatan_kl_notes_file');
		return $query->row();
	}

	public function insert(){
		$this->db->set('id_realisasi_kegiatan_kl_notes',$this->id_realisasi_kegiatan_kl_notes);
		$this->db->set('file_hash',$this->file_hash);
		$this->db->set('file_name',$this->file_name);
		$this->db->set('file_ext',$this->file_ext);
		$this->db->set('file_type',$this->file_type);
		$this->db->insert('realisasi_kegiatan_kl_notes_file');
	}

	public function update(){
		$this->db->where('id_realisasi_kegiatan_kl_notes_file',$this->id_realisasi_kegiatan_kl_notes_file);
		$this->db->set('file_hash',$this->file_hash);
		$this->db->set('file_name',$this->file_name);
		$this->db->set('file_ext',$this->file_ext);
		$this->db->set('file_type',$this->file_type);
		$this->db->update('realisasi_kegiatan_kl_notes_file');
	}

	public function delete(){
		$this->db->where('id_realisasi_kegiatan_kl_notes_file',$this->id_realisasi_kegiatan_kl_notes_file);
		$this->db->delete('realisasi_kegiatan_kl_notes_file');
	}

}