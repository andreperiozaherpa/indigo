<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_rpjmd_model extends CI_Model{

	public function get_all(){
		$query = $this->db->get('sasaran_rpjmd');
		return $query->result();
	}

	public function get_page($mulai,$hal,$filter=''){
		// $this->db->offsett(0,6);
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->order_by('id_sasaran_rpjmd','ASC');
		$query = $this->db->get('sasaran_rpjmd');
		return $query->result();
	}
	public function get_by_id($id_sasaran_rpjmd){
		$this->db->where('id_sasaran_rpjmd',$id_sasaran_rpjmd);
		$query = $this->db->get('sasaran_rpjmd');
		return $query->row();
	}

	public function get_sasaran_by_tujuan($id = NULL)
	{
		$this->db->where('id_tujuan',$id);
		$query = $this->db->get('sasaran_rpjmd');
		return $query->result();
	}

	public function set_by_id($id_sasaran_rpjmd)
	{
		$this->db->where('id_sasaran_rpjmd',$id_sasaran_rpjmd);
		$this->db->join('tujuan','tujuan.id_tujuan = sasaran_rpjmd.id_tujuan');
		$query = $this->db->get('sasaran_rpjmd');
		return $query->result();
	}

	public function insert($data)
	{
		if ($data) {
			$query = $this->db->insert('sasaran_rpjmd', $data);
			return true;
		}
	}

	public function update($data,$id_sasaran_rpjmd)
	{
		if ($data) {
			$query = $this->db->update('sasaran_rpjmd', $data, array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd));
			return true;
		}
	}

	public function delete($id_sasaran_rpjmd){
		return $this->db->delete('sasaran_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd));
	}

	public function delete_ss($id){
		return $this->db->delete('sasaran_rpjmd',array('id_sasaran_rpjmd'=>$id));
		$this->db->delete('iku_sasaran_rpjmd',array('id_sasaran_rpjmd'=>$id));
	}

	

	public function get_indikator_by_id_s($id_sasaran_rpjmd){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sasaran_rpjmd.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		$query =  $this->db->get_where('iku_sasaran_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd))->result();
		foreach($query as $k => $q){
			$skpd = explode(',', $q->id_skpd);
			foreach($skpd as $s){
				$detail_skpd = $this->db->get_where('ref_skpd',array('id_skpd'=>$s))->row();
				$query[$k]->skpd[] = $detail_skpd;
			}
		}
		return $query;
	}

	public function get_indikator_by_id($id_iku_sasaran_rpjmd){
		return $this->db->get_where('iku_sasaran_rpjmd',array('id_iku_sasaran_rpjmd'=>$id_iku_sasaran_rpjmd))->row();
	}

	public function delete_indikator($id_iku_sasaran_rpjmd){
		$this->db->delete('iku_sasaran_rpjmd',array('id_iku_sasaran_rpjmd'=>$id_iku_sasaran_rpjmd));
	}

	public function insert_indikator($data,$id_sasaran_rpjmd){
		$this->db->set('id_sasaran_rpjmd',$id_sasaran_rpjmd);
		return $this->db->insert('iku_sasaran_rpjmd',$data);

	}

	public function update_indikator($data,$id_iku_sasaran_rpjmd){
		unset($data['id_iku_sasaran_rpjmd']);
		return $this->db->update('iku_sasaran_rpjmd',$data,array('id_iku_sasaran_rpjmd'=>$id_iku_sasaran_rpjmd));

	}

	public function get_program_by_id_s($id_sasaran_rpjmd){
		return $this->db->get_where('program_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd))->result();
	}

	public function hey_ho(){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_sasaran_rpjmd.id_satuan');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = iku_sasaran_rpjmd.id_skpd');
		return $this->db->get('iku_sasaran_rpjmd')->result();
	}


}
