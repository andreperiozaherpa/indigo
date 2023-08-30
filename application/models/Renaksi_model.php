<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renaksi_model extends CI_Model
{
	public function insert_renaksi($data)
	{
		$this->db->insert('renaksi',$data);
	}
	public function insert_pencapaian_indikator_detail($data)
	{
		$this->db->insert('pencapaian_indikator_detail',$data);
	}
	public function getLastId()
	{
		$this->db->limit(1);
		$this->db->order_by('id_renaksi','DESC');
		$query = $this->db->get('renaksi');
		$rs = $query->result();
		if($rs!=null){
			return $rs[0]->id_renaksi;
		}
		else return 0;
	}
	public function get($param)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->join('ref_satuan','ref_satuan.id_satuan=renaksi.id_satuan','left');
		$query = $this->db->get('renaksi');
		return $query->result();
	}
	public function get_renaksi_all($params=null)
	{
		if(isset($params['tahun'])){
			$this->db->where('tahun',$params['tahun']);
		}else{
			$this->db->where('tahun !=',0);
		}
		if(isset($params['id_unit'])){
			$this->db->where('id_unit',$params['id_unit']);
		}
		$this->db->group_by('renaksi.id_renaksi');
		$this->db->join('pencapaian_indikator_detail','pencapaian_indikator_detail.id_renaksi=renaksi.id_renaksi','left');
		$this->db->join('ref_satuan','ref_satuan.id_satuan=renaksi.id_satuan','left');
		$query = $this->db->get('renaksi');
		return $query->result();
	}
	public function getDetail($param)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->join('renaksi','renaksi.id_renaksi=pencapaian_indikator_detail.id_renaksi','left');
		$query = $this->db->get('pencapaian_indikator_detail');
		return $query->result();
	}
	public function delete($id_renaksi){
		$this->db->where("id_renaksi",$id_renaksi);
		$delete1 = $this->db->delete("renaksi");
		$this->db->where("id_renaksi",$id_renaksi);
		$delete2 = $this->db->delete("pencapaian_indikator_detail");
		if($delete1 && $delete2){
			return true;
		}
		else{
			return false;
		}
	}
	public function getTotalPagu($type,$id_unit,$tahun,$uid_ss=null,$uid_iku=null)
	{
		$this->db->select("sum(jumlah_pagu) as total");
		if($type=="SS"){
			$this->db->join('sasaran_strategis_indikator','sasaran_strategis_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_strategis_indikator.id_sasaran','left');
			$this->db->where("sasaran_strategis.id_unit",$id_unit);
			$this->db->where("sasaran_strategis.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_strategis.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_strategis_indikator.uid_iku",$uid_iku);
			//var_dump($uid_ss);
			//var_dump($uid_iku);die;
		}
		else if($type=="SP")
		{
			$this->db->join('sasaran_program_indikator','sasaran_program_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_program','sasaran_program.id_sasaran_program=sasaran_program_indikator.id_sasaran','left');
			$this->db->where("sasaran_program.id_unit",$id_unit);
			$this->db->where("sasaran_program.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_program.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_program_indikator.uid_iku",$uid_iku);
		}
		else{
			$this->db->join('sasaran_kegiatan_indikator','sasaran_kegiatan_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_kegiatan','sasaran_kegiatan.id_sasaran_kegiatan=sasaran_kegiatan_indikator.id_sasaran','left');
			$this->db->where("sasaran_kegiatan.id_unit",$id_unit);
			$this->db->where("sasaran_kegiatan.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_kegiatan.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_kegiatan_indikator.uid_iku",$uid_iku);
		}
		$query = $this->db->get("renaksi");
		$total = 0;
		$result = $query->result();
		if(!empty($result[0]))
		{
			$total = $result[0]->total;
		}
		return $total;
	}
	public function getTotalRenaksi($type,$id_unit,$tahun,$uid_ss=null,$uid_iku=null)
	{
		$this->db->select("count(id_renaksi) as total");
		if($type=="SS"){
			$this->db->join('sasaran_strategis_indikator','sasaran_strategis_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_strategis_indikator.id_sasaran','left');
			$this->db->where("sasaran_strategis.id_unit",$id_unit);
			$this->db->where("sasaran_strategis.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_strategis.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_strategis_indikator.uid_iku",$uid_iku);
			//var_dump($uid_ss);
			//var_dump($uid_iku);die;
		}
		else if($type=="SP")
		{
			$this->db->join('sasaran_program_indikator','sasaran_program_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_program','sasaran_program.id_sasaran_program=sasaran_program_indikator.id_sasaran','left');
			$this->db->where("sasaran_program.id_unit",$id_unit);
			$this->db->where("sasaran_program.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_program.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_program_indikator.uid_iku",$uid_iku);
		}
		else{
			$this->db->join('sasaran_kegiatan_indikator','sasaran_kegiatan_indikator.uid_iku=renaksi.uid_iku','left');
			$this->db->join('sasaran_kegiatan','sasaran_kegiatan.id_sasaran_kegiatan=sasaran_kegiatan_indikator.id_sasaran','left');
			$this->db->where("sasaran_kegiatan.id_unit",$id_unit);
			$this->db->where("sasaran_kegiatan.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_kegiatan.uid_ss",$uid_ss);
			if($uid_iku!=null) $this->db->where("sasaran_kegiatan_indikator.uid_iku",$uid_iku);
		}
		$query = $this->db->get("renaksi");
		$total = 0;
		$result = $query->result();
		if(!empty($result[0]))
		{
			$total = $result[0]->total;
		}
		return $total;
	}
}