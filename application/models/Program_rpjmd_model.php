<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_rpjmd_model extends CI_Model{
	
	public function get_all(){
		$query = $this->db->get('program_rpjmd');
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
		$query = $this->db->get('program_rpjmd');
		return $query->result();
	}
	public function get_by_id($id_program_rpjmd){
		$this->db->where('id_program_rpjmd',$id_program_rpjmd);
		$query = $this->db->get('program_rpjmd');
		return $query->row();
	}

	public function get_total_anggaran($id_program_rpjmd){
		$this->db->where('id_program_rpjmd',$id_program_rpjmd);
		$row = $this->db->get('program_rpjmd')->row();
		$jumlah = $row->target_anggaran_2019 + $row->target_anggaran_2020 + $row->target_anggaran_2021 + $row->target_anggaran_2022 + $row->target_anggaran_2023;
		return $jumlah;
	}

	public function get_program_by_id_s($id_sasaran_rpjmd){
		return $this->db->get_where('program_rpjmd',array('id_sasaran_rpjmd'=>$id_sasaran_rpjmd))->result();
	}
	public function get_program_by_id($id_program_rpjmd){
		return $this->db->get_where('program_rpjmd',array('id_program_rpjmd'=>$id_program_rpjmd))->row();
	}

	public function delete_program($id_program_rpjmd){
		$this->db->delete('program_rpjmd',array('id_program_rpjmd'=>$id_program_rpjmd));
	}

	public function insert_program($data){
		return $this->db->insert('program_rpjmd',$data);

	}

	public function update_program($data,$id_program_rpjmd){
		if(isset($data['id_program_rpjmd'])){
			unset($data['id_program_rpjmd']);
		}
		return $this->db->update('program_rpjmd',$data,array('id_program_rpjmd'=>$id_program_rpjmd));

	}

	public function get_indikator_by_id_p($id_program_rpjmd){
		$this->db->join('ref_satuan','ref_satuan.id_satuan = iku_program_rpjmd.id_satuan');
		// $this->db->join('ref_skpd','ref_skpd.id_skpd = iku_program_rpjmd.id_skpd');
		$query =  $this->db->get_where('iku_program_rpjmd',array('id_program_rpjmd'=>$id_program_rpjmd))->result();
		foreach($query as $k => $q){
			$skpd = explode(',', $q->id_skpd);
			foreach($skpd as $s){
				$detail_skpd = $this->db->get_where('ref_skpd',array('id_skpd'=>$s))->row();
				$query[$k]->skpd[] = $detail_skpd;
			}
		}
		return $query;
	}

	public function get_indikator_by_id($id_iku_program_rpjmd){
		return $this->db->get_where('iku_program_rpjmd',array('id_iku_program_rpjmd'=>$id_iku_program_rpjmd))->row();
	}

	public function delete_indikator($id_iku_program_rpjmd){
		$this->db->delete('iku_program_rpjmd',array('id_iku_program_rpjmd'=>$id_iku_program_rpjmd));
	}

	public function insert_indikator($data,$id_program_rpjmd){
		$this->db->set('id_program_rpjmd',$id_program_rpjmd);
		return $this->db->insert('iku_program_rpjmd',$data);

	}

	public function update_indikator($data,$id_iku_program_rpjmd){
		unset($data['id_iku_program_rpjmd']);
		return $this->db->update('iku_program_rpjmd',$data,array('id_iku_program_rpjmd'=>$id_iku_program_rpjmd));

	}


}