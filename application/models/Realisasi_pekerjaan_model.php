<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_pekerjaan_model extends CI_Model
{
	public $id_realisasi_pekerjaan;
	public $id_pekerjaan;
	public $id_target_pekerjaan;

	public $id_realisasi_pekerjaan_detail;
	// public $id_realisasi_pekerjaan;
	public $nama_kegiatan_realisasi;
	public $kuantitas_realisasi;
	public $kualitas_realisasi;
	public $waktu_realisasi;
	public $id_satuan_kuantitas;
	public $id_satuan_kualitas;
	public $id_satuan_waktu;
	public $biaya_realisasi;
	public $tgl_kegiatan_realisasi;
	public $file_pendukung;
	public $uraian_realisasi;
	public $nama_lokasi_realisasi;
	public $id_provinsi_realisasi;
	public $id_kabupaten_realisasi;
	public $id_kecamatan_realisasi;
	public $id_desa_realisasi;

	public $tgl_awal;
	public $tgl_akhir;

	public function get_all()
	{
		// if($this->nama_kegiatan_realisasi!='') $this->db->like('nama_kegiatan_realisasi',$this->nama_kegiatan_realisasi);
		if($this->id_target_pekerjaan!='') $this->db->where('realisasi_pekerjaan.id_target_pekerjaan',$this->id_target_pekerjaan);
		// if($this->tgl_awal!='') $this->db->where('tgl_kegiatan_realisasi >=',$this->tgl_awal);
		// if($this->tgl_akhir!='') $this->db->where('tgl_kegiatan_realisasi <=',$this->tgl_akhir);
		$this->db->join('target_pekerjaan','target_pekerjaan.id_target_pekerjaan = realisasi_pekerjaan.id_target_pekerjaan');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = target_pekerjaan.id_pekerjaan');
		$query = $this->db->get('realisasi_pekerjaan');
		return $query->result();
	}

	public function get_for_verif()
	{
		$this->db->join('user','user.user_id = realisasi_pekerjaan.id_user');
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('target_pekerjaan','target_pekerjaan.id_target_pekerjaan = realisasi_pekerjaan.id_target_pekerjaan');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = target_pekerjaan.id_pekerjaan');
		$query = $this->db->get('realisasi_pekerjaan');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_realisasi_pekerjaan',$this->id_realisasi_pekerjaan);
		$query = $this->db->get('realisasi_pekerjaan');
		return $query->row();
	}

	public function get_by_id_v(){
		$this->db->join('user','user.user_id = realisasi_pekerjaan.id_user');
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('target_pekerjaan','target_pekerjaan.id_target_pekerjaan = realisasi_pekerjaan.id_target_pekerjaan');
		$this->db->join('ref_pekerjaan','ref_pekerjaan.id_pekerjaan = target_pekerjaan.id_pekerjaan');
		$query = $this->db->get('realisasi_pekerjaan');
		return $query->row();
	}

	public function insert($data){
		$this->db->insert('realisasi_pekerjaan',$data);
		return $this->db->insert_id();
	}

	public function update($data)
	{
		$this->db->where('id_realisasi_pekerjaan',$this->id_realisasi_pekerjaan);
		$this->db->update('realisasi_pekerjaan',$data);
	}
	public function delete()
	{
		$this->db->where('id_realisasi_pekerjaan',$this->id_realisasi_pekerjaan);
		$this->db->delete('realisasi_pekerjaan');
	}

	public function insert_detail(){
		$this->db->set('id_realisasi_pekerjaan',$this->id_realisasi_pekerjaan);
		$this->db->set('nama_kegiatan_realisasi',$this->nama_kegiatan_realisasi);
		$this->db->set('kuantitas_realisasi',$this->kuantitas_realisasi);
		$this->db->set('kualitas_realisasi',$this->kualitas_realisasi);
		$this->db->set('waktu_realisasi',$this->waktu_realisasi);
		$this->db->set('id_satuan_kuantitas',$this->id_satuan_kuantitas);
		$this->db->set('id_satuan_kualitas',$this->id_satuan_kualitas);
		$this->db->set('id_satuan_waktu',$this->id_satuan_waktu);
		$this->db->set('biaya_realisasi',$this->biaya_realisasi);
		$this->db->set('tgl_kegiatan_realisasi',$this->tgl_kegiatan_realisasi);
		$this->db->set('file_pendukung',$this->file_pendukung);
		$this->db->set('uraian_realisasi',$this->uraian_realisasi);
		$this->db->set('nama_lokasi_realisasi',$this->nama_lokasi_realisasi);
		$this->db->set('id_provinsi_realisasi',$this->id_provinsi_realisasi);
		$this->db->set('id_kabupaten_realisasi',$this->id_kabupaten_realisasi);
		$this->db->set('id_kecamatan_realisasi',$this->id_kecamatan_realisasi);
		$this->db->set('id_desa_realisasi',$this->id_desa_realisasi);
		$this->db->insert('realisasi_pekerjaan_detail');
	}

	public function update_detail(){
		$this->db->where('id_realisasi_pekerjaan_detail',$this->id_realisasi_pekerjaan_detail);
		$this->db->set('id_realisasi_pekerjaan',$this->id_realisasi_pekerjaan);
		$this->db->set('nama_kegiatan_realisasi',$this->nama_kegiatan_realisasi);
		$this->db->set('kuantitas_realisasi',$this->kuantitas_realisasi);
		$this->db->set('kualitas_realisasi',$this->kualitas_realisasi);
		$this->db->set('waktu_realisasi',$this->waktu_realisasi);
		$this->db->set('id_satuan_kuantitas',$this->id_satuan_kuantitas);
		$this->db->set('id_satuan_kualitas',$this->id_satuan_kualitas);
		$this->db->set('id_satuan_waktu',$this->id_satuan_waktu);
		$this->db->set('biaya_realisasi',$this->biaya_realisasi);
		$this->db->set('tgl_kegiatan_realisasi',$this->tgl_kegiatan_realisasi);
		$this->db->set('file_pendukung',$this->file_pendukung);
		$this->db->set('uraian_realisasi',$this->uraian_realisasi);
		$this->db->set('nama_lokasi_realisasi',$this->nama_lokasi_realisasi);
		$this->db->set('id_provinsi_realisasi',$this->id_provinsi_realisasi);
		$this->db->set('id_kabupaten_realisasi',$this->id_kabupaten_realisasi);
		$this->db->set('id_kecamatan_realisasi',$this->id_kecamatan_realisasi);
		$this->db->set('id_desa_realisasi',$this->id_desa_realisasi);
		$this->db->insert('realisasi_pekerjaan_detail');
	}

	public function delete_detail()
	{
		$this->db->where('id_realisasi_pekerjaan_detail',$this->id_realisasi_pekerjaan_detail);
		$this->db->delete('realisasi_pekerjaan_detail');
	}

}
?>