<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_model extends CI_Model
{

	public function get_by_kegiatan($id_kegiatan,$status=''){
		if($status!==''){
		$this->db->where('kegiatan_realisasi.status',$status);
		}
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$query = $this->db->get('kegiatan_realisasi');
		return $query->result();
	}
	public function get_progress($id_kegiatan){
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$jumlah = $this->db->get('kegiatan_realisasi')->num_rows();
		$this->db->where('kegiatan_realisasi.status','disetujui');
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$verifikasi = $this->db->get('kegiatan_realisasi')->num_rows();
		$progress = @($verifikasi/$jumlah)*100;
		return round($progress);
	}
	public function get_progress_fd($id_kegiatan){
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$jumlah = $this->db->get('kegiatan_realisasi')->num_rows();
		$this->db->where('kegiatan_realisasi.status','disetujui');
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$verifikasi = $this->db->get('kegiatan_realisasi')->num_rows();
		$progress = ($verifikasi/$jumlah)*100;
		return round($progress);

	}
	public function get_jumlah($id_kegiatan){
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$jumlah = $this->db->get('kegiatan_realisasi')->num_rows();
		$this->db->where('kegiatan_realisasi.status','disetujui');
		$this->db->where('kegiatan_realisasi.id_kegiatan',$id_kegiatan);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$verifikasi = $this->db->get('kegiatan_realisasi')->num_rows();
		return array('jumlah'=>$jumlah, 'verifikasi'=>$verifikasi);

	}

	public function get_by_id($id_realisasi){
		$this->db->where('kegiatan_realisasi.id_realisasi',$id_realisasi);
		$this->db->join('kegiatan_anggota','kegiatan_anggota.id_kegiatan_anggota = kegiatan_realisasi.id_kegiatan_anggota','left');
		$query = $this->db->get('kegiatan_realisasi');
		return $query->row();
	}
	public function get_realisasi_file($id_realisasi){
		$this->db->where('id_realisasi',$id_realisasi);
		$query = $this->db->get('kegiatan_realisasi_file');
		return $query->result();
	}
	public function update($id_realisasi,$data){
		$this->db->where('id_realisasi',$id_realisasi);
		$this->db->update('kegiatan_realisasi',$data);
	}
	public function insert_file($data){
		$this->db->insert('kegiatan_realisasi_file',$data);
	}

	public function get_last($id_kegiatan){
		$this->db->where_in('id_kegiatan','SELECT MAX(id_realisasi) FROM kegiatan_realisasi',false);
		$q = $this->db->get('kegiatan_realisasi');
		return $q->row();
	}

}
