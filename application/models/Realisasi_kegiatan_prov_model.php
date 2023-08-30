<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_prov_model extends CI_Model
{
	public $id_realisasi_kegiatan_prov;
	public $id_target_kegiatan_prov;
	public $tahun_realisasi_kegiatan_prov;
	public $id_provinsi;
	public $id_kabupaten;
	public $triwulan;
	public $tanggal_awal;
	public $tanggal_akhir;
	public $target;
	public $tempat;
	public $keterangan_realisasi;
	public $progres_pelaksanaan;
	public $nilai_kegiatan;
	public $id_volume_kegiatan;
	public $nilai_triwulan_1;
	public $nilai_triwulan_2;
	public $nilai_triwulan_3;
	public $nilai_triwulan_4;
	public $status;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all(){
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=realisasi_kegiatan_prov.id_koordinator');
		$query = $this->db->get('realisasi_kegiatan_prov');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_realisasi_kegiatan_prov',$this->id_realisasi_kegiatan_prov);
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=realisasi_kegiatan_prov.id_koordinator');
		$query = $this->db->get('realisasi_kegiatan_prov');
		return $query->row();
	}

	public function insert(){
		$this->db->set('tahun_realisasi_kegiatan_prov',$this->tahun_realisasi_kegiatan_prov);
		$this->db->set('id_koordinator',$this->id_koordinator);
		$this->db->set('id_target_kegiatan_prov',$this->id_target_kegiatan_prov);
		$this->db->set('id_lembaga',$this->id_lembaga);
		$this->db->set('triwulan',$this->triwulan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('target',$this->target);
		$this->db->set('progres_pelaksanaan',$this->progres_pelaksanaan);
		$this->db->set('tempat',$this->tempat);
		$this->db->set('keterangan_realisasi',$this->keterangan_realisasi);
		$this->db->set('id_user',$this->id_user);
		$this->db->set('tanggal_buat',date('Y-m-d'));
		$this->db->set('waktu_buat',date('H:i:s'));
		$this->db->insert('realisasi_kegiatan_prov');
	}

	public function update(){
		$this->db->where('id_realisasi_kegiatan_prov',$this->id_realisasi_kegiatan_prov);
		$this->db->set('tahun_realisasi_kegiatan_prov',$this->tahun_realisasi_kegiatan_prov);
		$this->db->set('id_target_kegiatan_prov',$this->id_target_kegiatan_prov);
		$this->db->set('id_koordinator',$this->id_koordinator);
		$this->db->set('id_lembaga',$this->id_lembaga);
		$this->db->set('triwulan',$this->triwulan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('progres_pelaksanaan',$this->progres_pelaksanaan);
		$this->db->set('target',$this->target);
		$this->db->set('tempat',$this->tempat);
		$this->db->set('keterangan_realisasi',$this->keterangan_realisasi);
		$this->db->update('realisasi_kegiatan_prov');
	}

	public function delete(){
		$this->db->where('id_realisasi_kegiatan_prov',$this->id_realisasi_kegiatan_prov);
		$this->db->delete('realisasi_kegiatan_prov');
	}

}