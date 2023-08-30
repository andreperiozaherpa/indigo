<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sasaran_strategis_model extends CI_Model
{
	public $tahun;

	public function get_all_data($limit=0, $offset=0,$id_unit_kerja=0,$level_unit_kerja=0)
	{
		if($id_unit_kerja!==0 && $level_unit_kerja!==0){
			if($level_unit_kerja==1){
				// $this->db->where("CONCAT('|', ket_induk, '|') like '%|".$id_unit_kerja."|%'", NULL, FALSE);	
				// $this->db->or_where("sasaran_strategis.id_unit",$id_unit_kerja);
				$this->db->where('id_unit',$id_unit_kerja);
			}else{
				$this->db->where('id_unit',$id_unit_kerja);
			}
		}elseif($id_unit_kerja!==0){
			$this->db->where('id_unit',$id_unit_kerja);
		}
		if (isset($this->tahun)) {
			$this->db->where('tahun',$this->tahun);
		}
		$this->db->join("misi", "sasaran_strategis.id_misi = misi.id_misi", "left");
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}
	public function get_all_disposisi($limit=0, $offset=0,$id_unit_kerja=0,$level_unit_kerja=0)
	{
		if($id_unit_kerja!==0 && $level_unit_kerja!==0){
			if($level_unit_kerja==1){
				$this->db->where("CONCAT('|', ket_induk, '|') like '%|".$id_unit_kerja."|%'", NULL, FALSE);	
			}else{
				$this->db->where('id_unit',$id_unit_kerja);
			}
		}
		$this->db->join("misi", "sasaran_strategis.id_misi = misi.id_misi", "left");
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}

	public function get_all_data_misi($limit=0, $offset=0)
	{
		$this->db->limit($limit,$offset);
		$query = $this->db->get('misi');
		return $query->result();
	}
	public function insert_indikator($data)
	{
		if ($data) {
			
			$query = $this->db->insert('sasaran_strategis_indikator', $data);
			return true;
		}
	}

	public function get_data_by_id($id)
	{
		$this->db->where("id_sasaran_strategis", $id);
		$this->db->join('target_sasaran','sasaran_strategis.uid_ss = target_sasaran.uid_ss','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$this->db->select("sasaran_strategis.*, ref_unit_kerja.*, target_sasaran.target");
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}

	public function get_indikator_by_id($id)
	{
		$this->db->where("id_sasaran", $id);
		$this->db->join("ref_satuan", "sasaran_strategis_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$this->db->order_by('kode_indikator','ASC');
		$query = $this->db->get('sasaran_strategis_indikator');
		return $query->result();
	}

	public function get_iku($id){
		$this->db->where("id_sasaran", $id);
		$this->db->join("pencapaian_indikator", "pencapaian_indikator.uid_iku = sasaran_strategis_indikator.uid_iku", "left");
		$this->db->join("ref_satuan", "sasaran_strategis_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$query = $this->db->get('sasaran_strategis_indikator');
		return $query->result();
	}

	public function insert_data($data)
	{
		if ($data) {
			if(empty($data['uid_ss'])){
				$insertData = array('uid_ss' => strtoupper(uniqid("SS-")));
				$data = array_merge($data,$insertData);
			}
			$query = $this->db->insert('sasaran_strategis', $data);
			return true;
		}
	}

	public function update_data($data, $id=null)
	{
		if ($data AND $id > 0) {
			$this->db->where("id_sasaran_strategis", $id);
			$query = $this->db->update('sasaran_strategis', $data);
			return true;
		}
	}

	public function delete_data($id=null)
	{
		if ($id > 0) {
			$this->db->where("id_sasaran_strategis", $id);
			$query = $this->db->delete('sasaran_strategis');
			$this->db->where("id_sasaran", $id);
			$query = $this->db->delete('sasaran_strategis_indikator');
			return true;
		}
	}

	public function update_indikator($data,$id,$kode)
	{
		if ($data['jumlah_row']!=0) {
			$jumlah_row = $data['jumlah_row'];
			$ignore = array();
			for ($i=$jumlah_row; $i > 0; $i--) { 
				
				if (!empty($data['kode_indikator'.$i])) {
					$new_kode = $data['kode_indikator'.$i];
				} else {
					$n=1;
					while ($n) {
						$new_kode = $kode.str_pad($n, 3, '0', STR_PAD_LEFT); 
						$query = $this->cek_kode_indikator($new_kode);
						if ($query==0) {
							break;
						}
						$n++;
					}
				}

				if (!empty($new_kode) AND !empty($data['nama_indikator'.$i])) {
					$item_row = array(	'id_sasaran' => $id,
						'kode_indikator' => $new_kode,
						'nama_indikator' => $data['nama_indikator'.$i],
						'indikator_target_1' => $data['indikator_target_1'.$i],
						'indikator_target_2' => $data['indikator_target_2'.$i],
						'indikator_target_3' => $data['indikator_target_3'.$i],
						'indikator_target_4' => $data['indikator_target_4'.$i],
						'indikator_target_5' => $data['indikator_target_5'.$i],
						'id_satuan' => $data['id_satuan'.$i],
						'status' => "Y",
					);
					
					if (!empty($data['id_indikator'.$i])) {
						$this->db->where('id_indikator', $data['id_indikator'.$i]);
						$update_row = $this->db->update('sasaran_strategis_indikator', $item_row);
						array_push($ignore, "{$data['id_indikator'.$i]}");
					} else {
						$insert_row = $this->db->insert('sasaran_strategis_indikator', $item_row);
						array_push($ignore, "{$this->db->insert_id()}");
					}

				}
				//unset($data['ws'.$i]);
			}
			$this->db->where('id_sasaran', $id);
			if ($ignore) $this->db->where_not_in('id_indikator', $ignore, false);
			$delete_row = $this->db->delete('sasaran_strategis_indikator');
		}
	}
	public function getByUnit($id_unit)
	{
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}	
	public function getSsInduk($id_unit)
	{
		$this->db->where('tahun',0);
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}
	public function getData($param=null,$id_rkt=null)
	{
		if($param!=null){
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit','left');
		$select = "sasaran_strategis.*, ref_unit_kerja.*";
		if($id_rkt!=null)
		{
			$this->db->join('bobot_sasaran','sasaran_strategis.uid_ss = bobot_sasaran.uid_ss AND bobot_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('target_sasaran','sasaran_strategis.uid_ss = target_sasaran.uid_ss AND target_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('pencapaian_sasaran','sasaran_strategis.uid_ss = pencapaian_sasaran.uid_ss AND pencapaian_sasaran.id_rkt = '.$id_rkt,'left');
			$select .=", bobot_sasaran.bobot, target_sasaran.target, pencapaian_sasaran.realisasi, capaian";
		}
		$this->db->select($select);
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	} 

	public function getTotalByUnit($id_unit=null,$tahun=null)
	{
		if($id_unit!=null && $tahun!=null){//$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit) AND sasaran_strategis.tahun=$tahun");
			$this->db->where("(id_unit = $id_unit) AND sasaran_strategis.tahun=$tahun");
		}
		$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = sasaran_strategis.id_unit","left");
		$this->db->select("count(sasaran_strategis.id_sasaran_strategis) as total");
		$query = $this->db->get("sasaran_strategis");
		$rs = $query->result();
		$total = 0;
		if($rs!=null){
			$total = $rs[0]->total;
		}
		return $total;
	}

	public function getAllSasaran($params=null){
		$array = array();
		if(isset($params['tahun'])){
			$this->db->where('tahun',$params['tahun']);
		}else{
			$this->db->where('tahun !=',0);
		}
		if(isset($params['id_unit'])){
			$this->db->where('id_unit',$params['id_unit']);
		}
		$this->db->join('bobot_sasaran','bobot_sasaran.uid_ss = sasaran_strategis.uid_ss');
		$ss = $this->db->get('sasaran_strategis')->result();
		$no=0;
		foreach($ss as $s){
			$ss[$no]->jenis = 'SS';
			$no++;
		}
		// array_push($array,$ss);
		if(isset($params['tahun'])){
			$this->db->where('tahun',$params['tahun']);
		}else{
			$this->db->where('tahun !=',0);
		}
		if(isset($params['id_unit'])){
			$this->db->where('id_unit',$params['id_unit']);
		}
		$this->db->join('bobot_sasaran','bobot_sasaran.uid_ss = sasaran_kegiatan.uid_ss');
		$sk = $this->db->get('sasaran_kegiatan')->result();
		$no=0;
		foreach($sk as $s){
			$sk[$no]->jenis = 'SK';
			$no++;
		}
		// array_push($array,$sk);
		if(isset($params['tahun'])){
			$this->db->where('tahun',$params['tahun']);
		}else{
			$this->db->where('tahun !=',0);
		}
		if(isset($params['id_unit'])){
			$this->db->where('id_unit',$params['id_unit']);
		}
		$this->db->join('bobot_sasaran','bobot_sasaran.uid_ss = sasaran_program.uid_ss');
		$sp = $this->db->get('sasaran_program')->result();
		$no=0;
		foreach($sp as $s){
			$sp[$no]->jenis = 'SP';
			$no++;
		}
		// array_push($array,$sp);
		return array_merge($ss,$sk,$sp);
	}

	public function gDataW($where){
		$this->db->where($where);
		$q = $this->db->get('sasaran_strategis_indikator');
		return $q;
	}

	public function cek_kode($kode)
	{
		$this->db->where('kode_sasaran_strategis',$kode);
		$query = $this->db->get('sasaran_strategis');
		return $query->num_rows();
	}

	public function cek_kode_indikator($kode)
	{
		$this->db->where('kode_indikator',$kode);
		$query = $this->db->get('sasaran_strategis_indikator');
		return $query->num_rows();
	}

	public function getByMisi($id_misi,$tahun)
	{
		$this->db->select("s1.id_sasaran_strategis, s2.id_misi, s1.id_ss_induk, s1.sasaran_strategis, s1.tahun ");
		$this->db->join('sasaran_strategis s2','s2.id_sasaran_strategis = s1.id_ss_induk','left');
		$this->db->where("s2.id_misi",$id_misi);
		$this->db->where("s1.tahun",$tahun);
		$query = $this->db->get("sasaran_strategis s1");
		return $query->result();
	}
}
?>