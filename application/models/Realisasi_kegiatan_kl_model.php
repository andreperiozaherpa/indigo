<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realisasi_kegiatan_kl_model extends CI_Model
{
	public $id_realisasi_kegiatan_kl;
	public $id_target_kegiatan_kl;
	public $tahun_realisasi_kegiatan_kl;
	public $id_koordinator;
	public $id_sub_koordinator;
	public $triwulan;
	public $tanggal_awal;
	public $tanggal_akhir;
	public $jumlah_anggaran;
	public $id_provinsi_realisasi;
	public $id_kabupaten_realisasi;
	public $id_kecamatan_realisasi;
	public $id_desa_realisasi;
	public $keterangan_realisasi;
	public $tempat_realisasi;
	public $volume;
	public $id_satuan;
	public $nilai_triwulan_1;
	public $nilai_triwulan_2;
	public $nilai_triwulan_3;
	public $nilai_triwulan_4;
	public $status;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all($id_user='',$user_level=''){
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=realisasi_kegiatan_kl.id_koordinator');
		if($id_user!=='' && $user_level!==''){
			$this->db->where('user_id',$id_user);
			$user = $this->db->get('user')->row();

			if($user_level!=='Administrator'){
				$this->db->where('id_instansi',$user->instansi_id);
				$level = $this->db->get('ref_instansi')->row()->level;

				if($level=='lembaga'){
					// $this->db->where('target_kegiatan_kl.id_user',$id_user);

					$this->db->where('id_sub_koordinator',$user->instansi_id);
				}elseif($level=='koordinator'){
					// $this->db->where('instansi_id',$user->instansi_id);
					// $u = $this->db->get('user')->result();
					// $user_id = array();
					// foreach($u as $uu){
					// 	$user_id[] = $uu->user_id; 
					// }

					// $this->db->where_in('target_kegiatan_kl.id_user',$user_id);
					$this->db->where('id_koordinator',$user->instansi_id);
				}
			}
		}
		$query = $this->db->get('realisasi_kegiatan_kl');
		return $query->result();
	}

	public function get_by_id(){
		$this->db->where('id_realisasi_kegiatan_kl',$this->id_realisasi_kegiatan_kl);
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=realisasi_kegiatan_kl.id_koordinator');
		// $this->db->join('provinsi','provinsi.id_provinsi=realisasi_kegiatan_kl.id_provinsi_realisasi');
		// $this->db->join('kabupaten','kabupaten.id_kabupaten=realisasi_kegiatan_kl.id_kabupaten_realisasi');
		// $this->db->join('kecamatan','kecamatan.id_kecamatan=realisasi_kegiatan_kl.id_kecamatan_realisasi');
		// $this->db->join('desa','desa.id_desa=realisasi_kegiatan_kl.id_desa_realisasi');
		// $this->db->join('ref_satuan','ref_satuan.id_satuan=realisasi_kegiatan_kl.id_satuan');
		$query = $this->db->get('realisasi_kegiatan_kl');
		return $query->row();
	}

	public function insert(){
		$this->db->set('tahun_realisasi_kegiatan_kl',$this->tahun_realisasi_kegiatan_kl);
		$this->db->set('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$this->db->set('id_koordinator',$this->id_koordinator=='' ? 0 : $this->id_koordinator);
		$this->db->set('id_sub_koordinator',$this->id_sub_koordinator=='' ? 0 : $this->id_sub_koordinator);
		$this->db->set('triwulan',$this->triwulan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('jumlah_anggaran',$this->jumlah_anggaran=='' ? 0 : $this->jumlah_anggaran);
		$this->db->set('id_provinsi_realisasi',$this->id_provinsi_realisasi=='' ? 0 : $this->id_provinsi_realisasi);
		$this->db->set('id_kabupaten_realisasi',$this->id_kabupaten_realisasi=='' ? 0 : $this->id_kabupaten_realisasi);
		$this->db->set('id_kecamatan_realisasi',$this->id_kecamatan_realisasi=='' ? 0 : $this->id_kecamatan_realisasi);
		$this->db->set('id_desa_realisasi',$this->id_desa_realisasi=='' ? 0 : $this->id_desa_realisasi);
		$this->db->set('keterangan_realisasi',$this->keterangan_realisasi);
		$this->db->set('tempat_realisasi',$this->tempat_realisasi);
		$this->db->set('volume',$this->volume=='' ? 0 : $this->volume);
		$this->db->set('id_satuan',$this->id_satuan=='' ? 0 : $this->id_satuan);
		$this->db->set('id_user',$this->id_user);
		$this->db->set('tanggal_buat',date('Y-m-d'));
		$this->db->set('waktu_buat',date('H:i:s'));
		$this->db->insert('realisasi_kegiatan_kl');
	}

	public function update(){
		$this->db->where('id_realisasi_kegiatan_kl',$this->id_realisasi_kegiatan_kl);
		$this->db->set('tahun_realisasi_kegiatan_kl',$this->tahun_realisasi_kegiatan_kl);
		$this->db->set('id_koordinator',$this->id_koordinator=='' ? 0 : $this->id_koordinator);
		$this->db->set('id_sub_koordinator',$this->id_sub_koordinator=='' ? 0 : $this->id_sub_koordinator);
		$this->db->set('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$this->db->set('triwulan',$this->triwulan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('jumlah_anggaran',$this->jumlah_anggaran=='' ? 0 : $this->jumlah_anggaran);
		$this->db->set('id_provinsi_realisasi',$this->id_provinsi_realisasi=='' ? 0 : $this->id_provinsi_realisasi);
		$this->db->set('id_kabupaten_realisasi',$this->id_kabupaten_realisasi=='' ? 0 : $this->id_kabupaten_realisasi);
		$this->db->set('id_kecamatan_realisasi',$this->id_kecamatan_realisasi=='' ? 0 : $this->id_kecamatan_realisasi);
		$this->db->set('id_desa_realisasi',$this->id_desa_realisasi=='' ? 0 : $this->id_desa_realisasi);
		$this->db->set('keterangan_realisasi',$this->keterangan_realisasi);
		$this->db->set('tempat_realisasi',$this->tempat_realisasi);
		$this->db->set('volume',$this->volume=='' ? 0 : $this->volume);
		$this->db->set('id_satuan',$this->id_satuan=='' ? 0 : $this->id_satuan);
		$this->db->update('realisasi_kegiatan_kl');
	}

	public function delete(){
		$this->db->where('id_realisasi_kegiatan_kl',$this->id_realisasi_kegiatan_kl);
		$this->db->delete('realisasi_kegiatan_kl');
	}

	public function get_total_target($tahun,$id_koordinator,$id_sub_koordinator){
		$this->db->where('tahun_realisasi_kegiatan_kl',$tahun);
		$this->db->where('id_koordinator',$id_koordinator);
		$this->db->where('id_sub_koordinator',$id_sub_koordinator);
		$query = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		return $query;
	}

	public function get_triwulan($triwulan,$tahun,$id_koordinator,$id_sub_koordinator){
		if($triwulan==1){
			$this->db->where('MONTH(tanggal_akhir) >=', '1');
			$this->db->where('MONTH(tanggal_akhir) <=', '3');
		} elseif($triwulan==2){
			$this->db->where('MONTH(tanggal_akhir) >=', '4');
			$this->db->where('MONTH(tanggal_akhir) <=', '6');
		} elseif($triwulan==3){
			$this->db->where('MONTH(tanggal_akhir) >=', '7');
			$this->db->where('MONTH(tanggal_akhir) <=', '9');
		} elseif($triwulan==4){
			$this->db->where('MONTH(tanggal_akhir) >=', '10');
			$this->db->where('MONTH(tanggal_akhir) <=', '12');
		}
		$this->db->where('tahun_realisasi_kegiatan_kl',$tahun);
		$this->db->where('id_koordinator',$id_koordinator);
		$this->db->where('id_sub_koordinator',$id_sub_koordinator);
		$query = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		return $query;
	}

	public function get_informasi(){
		$this->db->order_by('tahun_realisasi_kegiatan_kl','DESC');
		$this->db->group_by(array('tahun_realisasi_kegiatan_kl','id_koordinator','id_sub_koordinator'));
		$query = $this->db->get('realisasi_kegiatan_kl');
		return $query->result();
	}

}