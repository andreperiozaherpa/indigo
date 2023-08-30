<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_kinerja_model extends CI_Model{


	public function get_all(){
		$query = $this->db->get('evaluasi');
		return $query->result();
	}

	public function get_all_by_tahun($tahun)
	{
		$this->db->where('tahun_evaluasi', $tahun);
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = evaluasi.id_skpd');
		$query = $this->db->get('evaluasi');
		return $query->result_array();
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_evaluasi');
		$this->db->order_by('tahun_evaluasi', 'ASC');
		$query = $this->db->get('evaluasi');
		return $query->result();
	}

	public function get_default($id){

	$sql = $this->db->query("SELECT * FROM evaluasi WHERE id_evaluasi = ".intval($id));

	if($sql->num_rows() > 0)
		return $sql->row_array();
	return false;
	}

	public function update($post, $id){

	$nilai = $this->db->escape($post = $this->input->post('nilai'));
	$sql = $this->db->query("UPDATE evaluasi SET nilai = $nilai WHERE id_evaluasi = ".intval($id));

	return true;
	}

}
