<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_model extends CI_Model{

	public $tahun_evaluasi;
	public $id_skpd;

	public function get_all(){
		$query = $this->db->get('evaluasi');
		return $query->result();
	}

	public function get_all_by_tahun($tahun)
	{
		if($this->id_skpd!=''){
			$this->db->where('evaluasi.id_skpd',$this->id_skpd);
		}

		$this->db->where('tahun_evaluasi', $tahun);
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = evaluasi.id_skpd');
		$query = $this->db->get('evaluasi');
		return $query->result_array();
	}

	public function get_by_tahun($id_skpd,$tahun){
		
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('tahun_evaluasi', $tahun);
		$query = $this->db->get('evaluasi');
		return $query->row();
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_evaluasi');
		$this->db->order_by('tahun_evaluasi', 'ASC');
		$query = $this->db->get('evaluasi');
		return $query->result();
	}

	public function get_all_skpd(){
		return $this->db->get('ref_skpd')->result_array();
	}

	public function get_default($id){

	$sql = $this->db->query("SELECT * FROM evaluasi WHERE id_evaluasi = ".intval($id));

	if($sql->num_rows() > 0)
		return $sql->row_array();
	return false;
	}

	public function insertMass(){
		$id_skpd = $this->input->post('id_skpd[]');
		$data = array();
			foreach ($id_skpd as $id) {
				array_push($data, array(
					'id_skpd' => $id,
					'tahun_evaluasi' => $this->input->post('tahun_evaluasi')
				));
			}
		 $this->db->insert_batch('evaluasi', $data);
	}

	public function updateMass(){
		$nilai = $this->input->post('nilai[]');
		$id_evaluasi = $this->input->post('id_evaluasi[]');

		$data = array();
			foreach (array_combine($nilai, $id_evaluasi) as $id => $nilai) {
				array_push($data, array(
					'id_evaluasi' => $id,
					'nilai' => $nilai
				));
			}
		 $this->db->update_batch('evaluasi', $data, 'id_evaluasi');
	}

	public function update($post, $id){

	$nilai = $this->db->escape($post = $this->input->post('nilai'));
	$sql = $this->db->query("UPDATE evaluasi SET nilai = $nilai WHERE id_evaluasi = ".intval($id));

	return true;
	}

}
