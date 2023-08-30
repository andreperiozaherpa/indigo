<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_file_model extends CI_Model
{
	public $id_berkas_file;
	public $id_berkas;
	public $hash_file;
	public $eks_file;
	public $type_file;
	public $path_file;
	public $nama_file;

	public function get_all(){
		$query = $this->db->get('berkas_file');
		return $query->result();
	}

	public function get_by_n(){
		$this->db->where('id_berkas',$this->id_berkas);
		$query = $this->db->get('berkas_file');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_berkas_file',$this->id_berkas_file);
		$query = $this->db->get('berkas_file');
		return $query->row();
	}

	public function insert(){
		$this->db->set('id_berkas',$this->id_berkas);
		$this->db->set('hash_file',$this->hash_file);
		$this->db->set('eks_file',$this->eks_file);
		$this->db->set('type_file',$this->type_file);
		$this->db->set('path_file',$this->path_file);
		$this->db->set('nama_file',$this->nama_file);
		$this->db->set('tanggal_upload',date('Y-m-d'));
		$this->db->set('waktu_upload',date('H:i:s'));
		$this->db->insert('berkas_file');
	}

	public function update(){
		$this->db->where('id_berkas_file',$this->id_berkas_file);
		$this->db->set('id_berkas',$this->id_berkas);
		$this->db->set('hash_file',$this->hash_file);
		$this->db->set('eks_file',$this->eks_file);
		$this->db->set('type_file',$this->type_file);
		$this->db->set('path_file',$this->path_file);
		$this->db->set('nama_file',$this->nama_file);
		$this->db->update('berkas_file');
	}

	public function delete(){
		$this->db->where('id_berkas_file',$this->id_berkas_file);
		$get = $this->db->get('berkas_file')->row();
		unlink($get->path_file.$get->hash_file);
		$this->db->where('id_berkas_file',$this->id_berkas_file);
		$this->db->delete('berkas_file');
	}

}