<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pohon_kerja_model extends CI_Model
{
	public function getTujuan($id_misi){
		$this->db->where('id_misi',$id_misi);
		$query = $this->db->get('ref_tujuan');
		return $query->result();
	}
	public function getSasaranRPJMD($id_tujuan){
		$this->db->where('id_tujuan',$id_tujuan);
		$query = $this->db->get('ref_sasaran_rpjmd');
		return $query->result();
	}
	public function getIndikatorRPJMD($id_sasaran_rpjmd){
		$this->db->where('id_sasaran_rpjmd',$id_sasaran_rpjmd);
		$query = $this->db->get('ref_indikator_rpjmd');
		return $query->result();
	}
	public function getSasaranSKPD($id_indikator_rpjmd){
		$this->db->where('id_indikator_rpjmd',$id_indikator_rpjmd);
		$this->db->join('ref_skpd','ref_skpd.id_skpd = ref_sasaran_skpd.id_skpd');
		$query = $this->db->get('ref_sasaran_skpd');
		return $query->result();
	}
	public function getIndikatorSKPD($id_sasaran_skpd){
		$this->db->where('id_sasaran_skpd',$id_sasaran_skpd);
		$query = $this->db->get('ref_indikator_skpd');
		return $query->result();
	}
}
?>