<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Target_kegiatan_kl_model extends CI_Model
{
	public $id_target_kegiatan_kl;
	public $id_kode;
	public $tahun_target_kegiatan_kl;
	public $id_koordinator;
	public $id_sub_koordinator;
	public $rencana_kegiatan;
	public $tanggal_awal;
	public $tanggal_akhir;
	public $jumlah_target_kegiatan;
	public $id_provinsi_target;
	public $id_kabupaten_target;
	public $id_kecamatan_target;
	public $id_desa_target;
	public $alokasi_anggaran;
	public $tempat;
	public $volume_kegiatan;
	public $id_satuan;
	public $nilai_triwulan_1;
	public $nilai_triwulan_2;
	public $nilai_triwulan_3;
	public $nilai_triwulan_4;
	public $keterangan_kegiatan;
	public $status;
	public $id_user;
	public $tanggal_buat;
	public $waktu_buat;

	public function get_all($id_user='',$user_level=''){
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=target_kegiatan_kl.id_koordinator');

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

		$this->db->join('ref_kode','ref_kode.id_kode=target_kegiatan_kl.id_kode');
		$query = $this->db->get('target_kegiatan_kl');
		return $query->result();
	}


	public function get_sisa_target(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$q = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$q2 = $this->db->get('target_kegiatan_kl')->row();
		$sisa = $q2->jumlah_target_kegiatan - $q;
		return $sisa;
	}

	public function get_sisa_anggaran(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$this->db->select_sum('jumlah_anggaran','total_semua');
		$q = $this->db->get('realisasi_kegiatan_kl')->row()->total_semua; 
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$q2 = $this->db->get('target_kegiatan_kl')->row();
		$sisa = $q2->alokasi_anggaran - $q;
		return $sisa;
	}

	public function get_presentasi(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$q = $this->db->get('realisasi_kegiatan_kl')->num_rows();
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$q2 = $this->db->get('target_kegiatan_kl')->row();
		$sisa = $q2->jumlah_target_kegiatan - $q;
		$persen = $q/$q2->jumlah_target_kegiatan*100;
		return round($persen,2);
	}

	public function get_by_id(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		// $this->db->join('ref_instansi','ref_instansi.id_koordinator=target_kegiatan_kl.id_koordinator');
		$this->db->join('ref_kode','ref_kode.id_kode=target_kegiatan_kl.id_kode');
		// $this->db->join('provinsi','provinsi.id_provinsi=target_kegiatan_kl.id_provinsi_target');
		// $this->db->join('kabupaten','kabupaten.id_kabupaten=target_kegiatan_kl.id_kabupaten_target');
		// $this->db->join('kecamatan','kecamatan.id_kecamatan=target_kegiatan_kl.id_kecamatan_target');
		// $this->db->join('desa','desa.id_desa=target_kegiatan_kl.id_desa_target');
		// $this->db->join('ref_satuan','ref_satuan.id_satuan=target_kegiatan_kl.id_satuan');
		$query = $this->db->get('target_kegiatan_kl');
		return $query->row();
	}

	public function insert(){
		$this->db->set('tahun_target_kegiatan_kl',$this->tahun_target_kegiatan_kl);
		$this->db->set('id_kode',$this->id_kode);
		$this->db->set('id_koordinator',$this->id_koordinator=='' ? 0 : $this->id_koordinator);
		$this->db->set('id_sub_koordinator',$this->id_sub_koordinator=='' ? 0 : $this->id_sub_koordinator);
		$this->db->set('rencana_kegiatan',$this->rencana_kegiatan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('jumlah_target_kegiatan',$this->jumlah_target_kegiatan=='' ? 0 : $this->jumlah_target_kegiatan);
		$this->db->set('id_provinsi_target',$this->id_provinsi_target=='' ? 0 : $this->id_provinsi_target);
		$this->db->set('id_kabupaten_target',$this->id_kabupaten_target=='' ? 0 : $this->id_kabupaten_target);
		$this->db->set('id_kecamatan_target',$this->id_kecamatan_target=='' ? 0 : $this->id_kecamatan_target);
		$this->db->set('id_desa_target',$this->id_desa_target=='' ? 0 : $this->id_desa_target);
		$this->db->set('alokasi_anggaran',$this->alokasi_anggaran=='' ? 0 : $this->alokasi_anggaran);
		$this->db->set('tempat',$this->tempat);
		$this->db->set('volume_kegiatan',$this->volume_kegiatan=='' ? 0 : $this->volume_kegiatan);
		$this->db->set('keterangan_kegiatan',$this->keterangan_kegiatan);
		$this->db->set('id_satuan',$this->id_satuan=='' ? 0 : $this->id_satuan);
		$this->db->set('id_user',$this->id_user);
		$this->db->set('tanggal_buat',date('Y-m-d'));
		$this->db->set('waktu_buat',date('H:i:s'));
		$this->db->insert('target_kegiatan_kl');
	}

	public function update(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$this->db->set('tahun_target_kegiatan_kl',$this->tahun_target_kegiatan_kl);
		$this->db->set('id_kode',$this->id_kode);
		$this->db->set('id_koordinator',$this->id_koordinator=='' ? 0 : $this->id_koordinator);
		$this->db->set('id_sub_koordinator',$this->id_sub_koordinator=='' ? 0 : $this->id_sub_koordinator);
		$this->db->set('rencana_kegiatan',$this->rencana_kegiatan);
		$this->db->set('tanggal_awal',$this->tanggal_awal);
		$this->db->set('tanggal_akhir',$this->tanggal_akhir);
		$this->db->set('jumlah_target_kegiatan',$this->jumlah_target_kegiatan);
		$this->db->set('id_provinsi_target',$this->id_provinsi_target);
		$this->db->set('id_kabupaten_target',$this->id_kabupaten_target);
		$this->db->set('id_kecamatan_target',$this->id_kecamatan_target);
		$this->db->set('id_desa_target',$this->id_desa_target);
		$this->db->set('alokasi_anggaran',$this->alokasi_anggaran);
		$this->db->set('tempat',$this->tempat);
		$this->db->set('volume_kegiatan',$this->volume_kegiatan);
		$this->db->set('keterangan_kegiatan',$this->keterangan_kegiatan);
		$this->db->set('id_satuan',$this->id_satuan);
		$this->db->update('target_kegiatan_kl');
	}

	public function delete(){
		$this->db->where('id_target_kegiatan_kl',$this->id_target_kegiatan_kl);
		$this->db->delete('target_kegiatan_kl');
	}

}