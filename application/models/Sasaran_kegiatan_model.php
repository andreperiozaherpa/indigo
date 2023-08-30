<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sasaran_kegiatan_model extends CI_Model
{
	public $tahun;

	public function get_all_data($limit=0, $offset=0,$id_unit_kerja=0)
	{
		if($id_unit_kerja!==0){
			if ($this->session->userdata('level_unit_kerja') == 0) {
				$this->db->where('sasaran_strategis.id_unit',$id_unit_kerja);
			} elseif ($this->session->userdata('level_unit_kerja') == 1) {
				$this->db->where('sasaran_program.id_unit',$id_unit_kerja);
			} else {
				$this->db->where('sasaran_kegiatan.id_unit',$id_unit_kerja);
			}
		}
		if (isset($this->tahun)) {
			$this->db->where('sasaran_kegiatan.tahun',$this->tahun);
		}
		$this->db->select("*, sasaran_kegiatan.status_verifikasi AS status_verifikasi");
		$this->db->join("sasaran_program", "sasaran_kegiatan.id_sasaran_program = sasaran_program.id_sasaran_program", "left");
		$this->db->join("sasaran_strategis", "sasaran_program.id_sasaran_strategis = sasaran_strategis.id_sasaran_strategis", "left");
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit','left');
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_kegiatan');
		return $query->result();
	}

	public function get_all_data_sasaran_program($limit=0, $offset=0)
	{
		$this->db->limit($limit,$offset);
		$query = $this->db->get('sasaran_program');
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit','left');
		$this->db->join('target_sasaran','sasaran_kegiatan.uid_ss = target_sasaran.uid_ss','left');
		$this->db->join('indikator_turunan','indikator_turunan.uid_ss_bawahan = sasaran_kegiatan.uid_ss','left');
		$this->db->join('sasaran_program','sasaran_kegiatan.id_sasaran_program = sasaran_program.id_sasaran_program','left');
		$this->db->where("id_sasaran_kegiatan", $id);
		$this->db->select("sasaran_kegiatan.*, ref_unit_kerja.*,  indikator_turunan.*,
			sasaran_program.id_sasaran_strategis, 
			sasaran_program.kode_sasaran_program, sasaran_program.sasaran_program,
			sasaran_program.id_unit as id_unit_sp, sasaran_program.status_verifikasi as status_verifikasi_sp,
			sasaran_program.uid_ss as uid_ss_sp,
			sasaran_program.deskripsi as deskripsi_sp, sasaran_program.tahun as tahun_sp");
		$query = $this->db->get('sasaran_kegiatan');
		return $query->result();
	}

	public function get_indikator_by_id($id)
	{
		$this->db->where("id_sasaran", $id);
		$this->db->join("ref_satuan", "sasaran_kegiatan_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$this->db->order_by('kode_indikator','ASC');
		$query = $this->db->get('sasaran_kegiatan_indikator');
		return $query->result();
	}



	public function get_iku($id){
		$this->db->where("id_sasaran", $id);
		$this->db->join("pencapaian_indikator", "pencapaian_indikator.uid_iku = sasaran_kegiatan_indikator.uid_iku", "left");
		$this->db->join("ref_satuan", "sasaran_kegiatan_indikator.id_satuan = ref_satuan.id_satuan", "left");
		$query = $this->db->get('sasaran_kegiatan_indikator');
		return $query->result();
	}

	public function insert_data($data)
	{
		if ($data) {
			$data["status_verifikasi"] = "";
			if(empty($data['uid_ss'])){
				$insertData = array('uid_ss' => strtoupper(uniqid("SK-")));
				$data = array_merge($data,$insertData);
			}
			$query = $this->db->insert('sasaran_kegiatan', $data);
			return true;
		}
	}
	public function insert_indikator($data)
	{
		if ($data) {
			
			$query = $this->db->insert('sasaran_kegiatan_indikator', $data);
			return true;
		}
	}

	public function update_data($data, $id=null)
	{
		if ($data AND $id > 0) {
			$this->db->where("id_sasaran_kegiatan", $id);
			$query = $this->db->update('sasaran_kegiatan', $data);
			return true;
		}
	}

	public function delete_data($id=null)
	{
		if ($id > 0) {
			$this->db->where("id_sasaran_kegiatan", $id);
			$query = $this->db->delete('sasaran_kegiatan');
			$this->db->where("id_sasaran", $id);
			$query = $this->db->delete('sasaran_kegiatan_indikator');
			return true;
		}
	}

	public function verifikasi_data($id=null)
	{
		if ($id > 0) {
			$this->db->set("status_verifikasi", "Y");
			$this->db->where("id_sasaran_kegiatan", $id);
			$query = $this->db->update('sasaran_kegiatan');
			return true;
		}
	}

	public function batal_verifikasi_data($id=null)
	{
		if ($id > 0) {
			$this->db->set("status_verifikasi", "");
			$this->db->where("id_sasaran_kegiatan", $id);
			$query = $this->db->update('sasaran_kegiatan');
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
						$update_row = $this->db->update('sasaran_kegiatan_indikator', $item_row);
						array_push($ignore, "{$data['id_indikator'.$i]}");
					} else {
						$insert_row = $this->db->insert('sasaran_kegiatan_indikator', $item_row);
						array_push($ignore, "{$this->db->insert_id()}");
					}

				}
				//unset($data['ws'.$i]);
			}
			$this->db->where('id_sasaran', $id);
			if ($ignore) $this->db->where_not_in('id_indikator', $ignore, false);
			$delete_row = $this->db->delete('sasaran_kegiatan_indikator');
		}
	}
	public function getByUnit($id_unit)
	{
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit','left');
		$query = $this->db->get('sasaran_kegiatan');
		return $query->result();
	}
	public function getSkInduk($id_unit)
	{
		$this->db->where('tahun',0);
		$this->db->where('id_unit',$id_unit);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit','left');
		$query = $this->db->get('sasaran_kegiatan');
		return $query->result();
	}
	public function getData($param=null,$id_rkt=null)
	{
		if($param!=null){
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit','left');
		if($id_rkt!=null)
		{
			$this->db->join('bobot_sasaran','sasaran_kegiatan.uid_ss = bobot_sasaran.uid_ss AND bobot_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('target_sasaran','sasaran_kegiatan.uid_ss = target_sasaran.uid_ss AND target_sasaran.id_rkt = '.$id_rkt,'left');
			$this->db->join('pencapaian_sasaran','sasaran_kegiatan.uid_ss = pencapaian_sasaran.uid_ss AND pencapaian_sasaran.id_rkt = '.$id_rkt,'left');
		}
		$query = $this->db->get('sasaran_kegiatan');
		return $query->result();
	} 
	public function getTotalByUnit($id_unit=null,$tahun=null)
	{
		if($id_unit!=null && $tahun!=null){
			//$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit) AND sasaran_kegiatan.tahun=$tahun");
			$this->db->where("(id_unit = $id_unit) AND sasaran_kegiatan.tahun=$tahun");
		}
		$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = sasaran_kegiatan.id_unit","left");
		$this->db->select("count(sasaran_kegiatan.id_sasaran_kegiatan) as total");
		$query = $this->db->get("sasaran_kegiatan");
		$rs = $query->result();
		$total = 0;
		if($rs!=null){
			$total = $rs[0]->total;
		}
		return $total;
	}
	public function gDataW($where){
		$this->db->where($where);
		$q = $this->db->get('sasaran_kegiatan_indikator');
		return $q;
	}

	public function cek_kode($kode)
	{
		$this->db->where('kode_sasaran_kegiatan',$kode);
		$query = $this->db->get('sasaran_kegiatan');
		return $query->num_rows();
	}

	public function cek_kode_indikator($kode)
	{
		$this->db->where('kode_indikator',$kode);
		$query = $this->db->get('sasaran_kegiatan_indikator');
		return $query->num_rows();
	}
}
?>