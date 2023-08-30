<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_rkt_model extends CI_Model
{

	public $tahun_rkt;
	public $id_unit_penanggungjawab;
	public $sWhere;

	public function get_all()
	{
		if($this->tahun_rkt!=''){
			$this->db->where('tahun_rkt',$this->tahun_rkt);
		}
		if($this->id_unit_penanggungjawab!=''){
			$this->db->where('id_unit_penanggungjawab',$this->id_unit_penanggungjawab);
		}
		// $this->db->join('ref_renstra','ref_renstra.id_renstra = ref_rkt.id_renstra');
		if($this->sWhere)
		{
			$this->db->where($this->sWhere);
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab');
		$this->db->order_by("ref_unit_kerja.level_unit_kerja","ASC");
		$this->db->order_by("ref_rkt.tahun_rkt","ASC");
		$query = $this->db->get('ref_rkt');
		return $query->result();
	}

	public function get_ss_atasan()
	{
		if($this->session->userdata('unit_kerja_id')>0){
			$this->db->where("FIND_IN_SET('{$this->session->userdata('unit_kerja_id')}', rkt_sasaran.penanggung_jawab) !=", 0);
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = rkt_sasaran.id_unit_kerja');
		$query = $this->db->get('rkt_sasaran');
		return $query->result();
	}

	public function insert($data)
	{
		$query = $this->db->insert('ref_rkt',$data);
		return $query;
	}

	public function select_by_id($id = NULL) {
		if(!empty($id)){
			$this->db->where('id_rkt', $id);
		}        
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab');
		$query = $this->db->get('ref_rkt');
		return $query->row();   
	}

	public function update($data,$id = NULL)
	{
		$this->db->where('id_rkt', $id);
		$query = $this->db->update('ref_rkt',$data);
	}
	
	public function delete($id = NULL)
	{
		$this->db->where('id_rkt',$id);
		$query = $this->db->delete('ref_rkt');	
		// redirect('ref_rkt');
		echo true;
	}

	public function get_tahun(){
		$this->db->distinct();

		$this->db->select('tahun_rkt');
		$query = $this->db->get('ref_rkt');
		return $query->result();
	}

	public function select_for_id($id_unit_kerja = NULL, $tahun_rkt = NULL) {
		if(!empty($id_unit_kerja) AND !empty($tahun_rkt)){
			$this->db->where('id_unit_kerja', $id_unit_kerja);
			$this->db->where('tahun_rkt', $tahun_rkt);
		}        
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = ref_rkt.id_unit_penanggungjawab');
		$query = $this->db->get('ref_rkt');
		return $query->row();   
	}

	public function insert_data($data)
	{
		if ($data) {
			$this->db->where("tahun_rkt",$data['tahun_rkt']);
			$this->db->where("id_unit_penanggungjawab",$data['id_unit_penanggungjawab']);
			$qry_cek = $this->db->get("ref_rkt");
			$rs_cek = $qry_cek->result();
			//var_dump($rs_cek);
			if($rs_cek==null){
				$this->db->insert('ref_rkt',$data);
				return true;
			}
			else{
				return false;
			}
		}
	}

	public function update_data($data, $id=null)
	{
		if ($data AND $id > 0) {
			$this->db->where("id_rkt", $id);
			$query = $this->db->update('ref_rkt', $data);
			return true;
		}
	}

	public function delete_data($id=null)
	{
		if ($id > 0) {
			$this->db->where("id_rkt", $id);
			$query = $this->db->delete('ref_rkt');
			return true;
		}
	}
}
?>