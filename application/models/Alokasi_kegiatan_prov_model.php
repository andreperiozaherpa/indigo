<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alokasi_kegiatan_prov_model extends CI_Model
{
	public $id_alokasi_kegiatan_prov;
	public $tahun_alokasi_kegiatan_prov;
	public $id_provinsi;
	public $id_kabupaten;
	public $alokasi_rp;
	public $keterangan_alokasi;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all(){
		// $this->db->join('ref_instansi','ref_instansi.id_instansi=alokasi_kegiatan_prov.id_instansi');
		$query = $this->db->get('alokasi_kegiatan_prov');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_alokasi_kegiatan_prov',$this->id_alokasi_kegiatan_prov);
		// $this->db->join('ref_instansi','ref_instansi.id_instansi=alokasi_kegiatan_prov.id_instansi');
		$query = $this->db->get('alokasi_kegiatan_prov');
		return $query->row();
	}

	public function insert(){
		$this->db->set('tahun_alokasi_kegiatan_prov',$this->tahun_alokasi_kegiatan_prov);
		$this->db->set('id_instansi',$this->id_instansi);
		$this->db->set('alokasi_rp',$this->alokasi_rp);
		$this->db->set('keterangan_alokasi',$this->keterangan_alokasi);
		$this->db->set('id_user',$this->id_user);
		$this->db->set('tanggal_buat',date('Y-m-d'));
		$this->db->set('waktu_buat',date('H:i:s'));
		$this->db->insert('alokasi_kegiatan_prov');
	}

	public function update(){
		$this->db->where('id_alokasi_kegiatan_prov',$this->id_alokasi_kegiatan_prov);
		$this->db->set('tahun_alokasi_kegiatan_prov',$this->tahun_alokasi_kegiatan_prov);
		$this->db->set('id_instansi',$this->id_instansi);
		$this->db->set('alokasi_rp',$this->alokasi_rp);
		$this->db->set('keterangan_alokasi',$this->keterangan_alokasi);
		$this->db->update('alokasi_kegiatan_prov');
	}

	public function delete(){
		$this->db->where('id_alokasi_kegiatan_prov',$this->id_alokasi_kegiatan_prov);
		$this->db->delete('alokasi_kegiatan_prov');
	}

}