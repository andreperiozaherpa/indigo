<?php
class Renstra_realisasi_model extends CI_Model{
	public function get_ss_by_id($id_sasaran_strategis_renstra){
		$this->db->where('id_sasaran_strategis_renstra',$id_sasaran_strategis_renstra);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->row();
	}
	public function get_sp_by_id($id_sasaran_program_renstra){
		$this->db->where('id_sasaran_program_renstra',$id_sasaran_program_renstra);
		$query = $this->db->get('sasaran_program_renstra');
		return $query->row();
	}
	public function get_sk_by_id($id_sasaran_kegiatan_renstra){
		$this->db->where('id_sasaran_kegiatan_renstra',$id_sasaran_kegiatan_renstra);
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->row();
	}
	public function get_ss_by_id_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_strategis_renstra');
		return $query->result();
	}
	public function get_sp_by_id_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_program_renstra');
		return $query->result();
	}
	public function get_sk_by_id_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get('sasaran_kegiatan_renstra');
		return $query->result();
	}
	public function get_iku_ss($id_sasaran_strategis_renstra){
		$this->db->where('id_sasaran_strategis_renstra',$id_sasaran_strategis_renstra);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$query = $this->db->get('iku_ss_renstra');
		return $query->result();
	}
	public function get_iku_sp($id_sasaran_program_renstra){
		$this->db->where('id_sasaran_program_renstra',$id_sasaran_program_renstra);
		$query = $this->db->get('iku_sp_renstra');
		return $query->result();
	}
	public function get_iku_sk($id_sasaran_kegiatan_renstra){
		$this->db->where('id_sasaran_kegiatan_renstra',$id_sasaran_kegiatan_renstra);
		$query = $this->db->get('iku_sk_renstra');
		return $query->result();
	}
	public function get_iku_ss_by_id($id_iku_ss_renstra){
		$this->db->where('id_iku_ss_renstra',$id_iku_ss_renstra);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_ss_renstra.id_satuan');
		$query = $this->db->get('iku_ss_renstra');
		return $query->row();
	}
	public function get_iku_sp_by_id($id_iku_sp_renstra){
		$this->db->where('id_iku_sp_renstra',$id_iku_sp_renstra);
		$query = $this->db->get('iku_sp_renstra');
		return $query->row();
	}
	public function get_iku_sk_by_id($id_iku_sk_renstra){
		$this->db->where('id_iku_sk_renstra',$id_iku_sk_renstra);
		$query = $this->db->get('iku_sk_renstra');
		return $query->row();
	}
	public function get_unit_iku_ss($id_iku_ss_renstra){
		$this->db->where('id_iku_ss_renstra',$id_iku_ss_renstra);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_ss_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_ss_renstra');
		return $query->result();
	}
	public function get_unit_iku_sp($id_iku_sp_renstra){
		$this->db->where('id_iku_sp_renstra',$id_iku_sp_renstra);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sp_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_sp_renstra');
		return $query->result();
	}
	public function get_unit_iku_sk($id_iku_sk_renstra){
		$this->db->where('id_iku_sk_renstra',$id_iku_sk_renstra);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = casecade_unit_kerja_iku_sk_renstra.id_unit_kerja');
		$query = $this->db->get('casecade_unit_kerja_iku_sk_renstra');
		return $query->result();
	}
}