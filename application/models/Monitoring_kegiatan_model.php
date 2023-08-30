<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_kegiatan_model extends CI_Model{
	
	public function get_all($id_unit_kerja='',$tgl_awal='',$tgl_akhir=''){
		if($id_unit_kerja != '') $this->db->where('kegiatan.id_unit_kerja',$id_unit_kerja);
		if($tgl_awal != '') $this->db->where('tgl_mulai_kegiatan >=',$tgl_awal);
		if($tgl_akhir != '') $this->db->where('tgl_mulai_kegiatan <=',$tgl_akhir);
		$this->db->join('pegawai','pegawai.id_pegawai = kegiatan.id_ketua_tim');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = kegiatan.id_unit_kerja_tautan');
		$query = $this->db->get('kegiatan');
		return $query->result();
	}

	public function get_monitoring($where=array(),$sWhere="")
	{
		$this->db
							->where($where)
							//->where($sWhere)
							->where("lat is not null AND lng is not null")
							->join("pegawai", "pegawai.id_pegawai = kegiatan_personal.id_pegawai_input","left")
							->order_by("id_kegiatan_personal","DESC")
							->group_by("kegiatan_personal.id_pegawai_input");
		if($sWhere)
			$this->db->where($sWhere);

		$kegiatan = $this->db
							->get("kegiatan_personal")
							->result();
		return $kegiatan;
	}

	public function total_pekerjaan($type=''){
		$this->db->where('id_kerja_luar_kantor is not null');
		if($this->session->userdata('kepala_skpd')=="Y"){
			$this->db->where('id_skpd',$this->session->userdata('id_skpd'));
		}
		if($type=='pegawai'){
			$this->db->group_by('id_pegawai_input');
		}elseif($type=='selesai'){
			$this->db->where('status_kegiatan','SELESAI DIVERIFIKASI');
		}
		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	public function total_hari_ini($type=''){
		$this->db->where('id_kerja_luar_kantor is not null');
		if($this->session->userdata('kepala_skpd')=="Y"){
			$this->db->where('id_skpd',$this->session->userdata('id_skpd'));
		}
		$this->db->where('tgl_kegiatan_mulai <=',date('Y-m-d'));
		$this->db->where('tgl_kegiatan_akhir >=',date('Y-m-d'));

		if($type=='belum'){
			$this->db->where('status_kegiatan','BELUM DIKERJAKAN');
		}elseif($type=='sudah'){
			$this->db->group_start();
			$this->db->where('status_kegiatan','MENUNGGU VERIFIKASI');
			$this->db->or_where('status_kegiatan','SELESAI DIVERIFIKASI');
			$this->db->group_end();
		}else{
			
			$this->db->group_by('id_pegawai_input');
		}

		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	public function total_markonah(){
		if($this->session->userdata('kepala_skpd')=="Y"){
			$this->db->where('id_skpd',$this->session->userdata('id_skpd'));
		}
		$q = $this->db->get('kerja_luar_kantor');
		return $q->result();
	}

}