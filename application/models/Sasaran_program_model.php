<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sasaran_program_model extends CI_Model
{
	public $tahun;

	public function get_all_data($limit=0, $offset=0,$id_sasaran_strategis=0,$id_unit=0)
	{
		if($id_unit!==0){
			if ($this->session->userdata('level_unit_kerja') == 0) {
				$this->db->where('sasaran_strategis.id_unit',$id_unit);
			} else {
				$this->db->where('sasaran_program.id_unit',$id_unit);
			}
		}
		if (isset($this->tahun)) {
			$this->db->where('sasaran_program.tahun',$this->tahun);
		}
		$this->db->select("*, sasaran_program.status_verifikasi AS status_verifikasi");
		$this->db->join("sasaran_strategis", "sasaran_program.id_sasaran_strategis = sasaran_strategis.id_sasaran_strategis", "left");
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit','left');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_program');
		return $query->result();
	}

	public function get_all_data_sasaran_strategis($limit=0, $offset=0)
	{
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_strategis');
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->join('target_sasaran','sasaran_program.uid_ss = target_sasaran.uid_ss','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit','left');
		$this->db->join('indikator_turunan','indikator_turunan.uid_ss_bawahan = sasaran_program.uid_ss','left');
		$this->db->join('sasaran_strategis','indikator_turunan.uid_ss_atasan = sasaran_strategis.uid_ss','left');
		$this->db->where("id_sasaran_program", $id);
		$this->db->select("sasaran_program.*, ref_unit_kerja.*, indikator_turunan.*,
			sasaran_strategis.id_misi, sasaran_strategis.id_sasaran_strategis, 
			sasaran_strategis.kode_sasaran_strategis, sasaran_strategis.sasaran_strategis,
			sasaran_strategis.id_unit as id_unit_ss, sasaran_strategis.status_verifikasi as status_verifikasi_ss,
			sasaran_strategis.uid_ss as uid_ss_ss,
			sasaran_strategis.deskripsi as deskripsi_ss, sasaran_strategis.tahun as tahun_ss");
		$query = $this->db->get('sasaran_program');
		return $query->result();
	}

	public function get_indikator_by_id($id)
	{
		$this->db->where("id_sasaran", $id);
		$this->db->join("ref_satuan", "sasaran_program_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$this->db->order_by('kode_indikator','ASC');
		$query = $this->db->get('sasaran_program_indikator');
		return $query->result();
	}


	public function get_iku($id){
		$this->db->where("id_sasaran", $id);
		$this->db->join("pencapaian_indikator", "pencapaian_indikator.uid_iku = sasaran_program_indikator.uid_iku", "left");
		$this->db->join("ref_satuan", "sasaran_program_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$query = $this->db->get('sasaran_program_indikator');
		return $query->result();
	}
	public function insert_data($data)
	{
		if ($data) {
			if(!isset($data['uid_ss'])) {
				$insertData = array('uid_ss' => strtoupper(uniqid("SP-")));
				$data = array_merge($data,$insertData);
			}
			$query = $this->db->insert('sasaran_program', $data);
			return true;
		}
	}
	public function insert_indikator($data)
	{
		if ($data) {
			
			$query = $this->db->insert('sasaran_program_indikator', $data);
			return true;
		}
	}

	public function update_data($data, $id=null)
	{
		if ($data AND $id > 0) {
			$this->db->where("id_sasaran_program", $id);
			$query = $this->db->update('sasaran_program', $data);
			return true;
		}
	}

	public function delete_data($id=null)
	{
		if ($id > 0) {
			$this->db->where("id_sasaran_program", $id);
			$query = $this->db->delete('sasaran_program');
			$this->db->where("id_sasaran", $id);
			$query = $this->db->delete('sasaran_program_indikator');
			return true;
		}
	}

	public function verifikasi_data($id=null)
	{
		if ($id > 0) {
			$this->db->set("status_verifikasi", "Y");
			$this->db->where("id_sasaran_program", $id);
			$query = $this->db->update('sasaran_program');
			return true;
		}
	}

	public function batal_verifikasi_data($id=null)
	{
		if ($id > 0) {
			$this->db->set("status_verifikasi", "");
			$this->db->where("id_sasaran_program", $id);
			$query = $this->db->update('sasaran_program');
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
						$update_row = $this->db->update('sasaran_program_indikator', $item_row);
						array_push($ignore, "{$data['id_indikator'.$i]}");
					} else {
						$insert_row = $this->db->insert('sasaran_program_indikator', $item_row);
						array_push($ignore, "{$this->db->insert_id()}");
					}

				}
				//unset($data['ws'.$i]);
			}
			$this->db->where('id_sasaran', $id);
			if ($ignore) $this->db->where_not_in('id_indikator', $ignore, false);
			$delete_row = $this->db->delete('sasaran_program_indikator');
		}
	}
	public function getByUnit($id_unit)
	{
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit','left');
		$query = $this->db->get('sasaran_program');
		return $query->result();
	}
	public function getSpInduk($id_unit)
	{
		$this->db->where('tahun',0);
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit','left');
		$query = $this->db->get('sasaran_program');
		return $query->result();
	}
	public function getData($param,$id_rkt=null)
	{
		if($param!=null){
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit','left');
		if($id_rkt!=null)
		{
			$this->db->join('bobot_sasaran','sasaran_program.uid_ss = bobot_sasaran.uid_ss AND bobot_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('target_sasaran','sasaran_program.uid_ss = target_sasaran.uid_ss AND target_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('pencapaian_sasaran','sasaran_program.uid_ss = pencapaian_sasaran.uid_ss AND pencapaian_sasaran.id_rkt = '.$id_rkt,'left');
		}
		$query = $this->db->get('sasaran_program');
		return $query->result();
	} 

	public function getTotalByUnit($id_unit=null,$tahun=null)
	{
		if($id_unit!=null && $tahun!=null){
			//$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit) AND sasaran_strategis.tahun=$tahun");
			$this->db->where("(id_unit = $id_unit) AND sasaran_program.tahun=$tahun");
		}
		$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = sasaran_program.id_unit","left");
		$this->db->select("count(sasaran_program.id_sasaran_program) as total");
		$query = $this->db->get("sasaran_program");
		$rs = $query->result();
		$total = 0;
		if($rs!=null){
			$total = $rs[0]->total;
		}
		return $total;
	}
	public function gDataW($where){
		$this->db->where($where);
		$q = $this->db->get('sasaran_program_indikator');
		return $q;
	}

	public function cek_kode($kode)
	{
		$this->db->where('kode_sasaran_program',$kode);
		$query = $this->db->get('sasaran_program');
		return $query->num_rows();
	}

	public function cek_kode_indikator($kode)
	{
		$this->db->where('kode_indikator',$kode);
		$query = $this->db->get('sasaran_program_indikator');
		return $query->num_rows();
	}
}
?>