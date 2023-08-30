<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rkt_model extends CI_Model
{
	public function setTargetSS($param)
	{
		$this->db->where('id_rkt',$param['id_rkt']);
		$this->db->where('uid_ss',$param['uid_ss']);
		$this->db->delete('target_sasaran');
		$this->db->insert('target_sasaran',$param);
	}
	public function getTarget($param)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		$q = $this->db->get('target_sasaran');
		return $q->result();
	}

	public function setBobotSS($param)
	{
		$this->db->where('id_rkt',$param['id_rkt']);
		$this->db->where('uid_ss',$param['uid_ss']);
		$this->db->delete('bobot_sasaran');

		$this->db->insert('bobot_sasaran',$param);
	}
	public function getBobot($param)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		$q = $this->db->get('bobot_sasaran');
		return $q->result();
	}
	public function delete($rkt=null)
	{
		if($rkt!=null)
		{
			// Sasaran 

			$paramSS = array('id_unit' => $rkt->id_unit_kerja, 'tahun' => $rkt->tahun_rkt);

			if($rkt->level_unit_kerja == 0)
			{
				$type = "SS";
				$this->load->model("sasaran_strategis_model");
				$dataSS = $this->sasaran_strategis_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_strategis";
				$tabelIKU = "sasaran_strategis_indikator";
				$tabel_sasaran = "sasaran_strategis";
			}
			
			else if($rkt->level_unit_kerja == 1)
			{
				$type = "SP";
				$this->load->model("sasaran_program_model");
				$dataSS = $this->sasaran_program_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_program";
				$tabelIKU = "sasaran_program_indikator";
				$tabel_sasaran = "sasaran_program";
			}
			else{
				$type = "SK";
				$this->load->model("sasaran_kegiatan_model");
				$dataSS = $this->sasaran_kegiatan_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_kegiatan";
				$tabelIKU = "sasaran_kegiatan_indikator";
				$tabel_sasaran = "sasaran_kegiatan";
			}

			$id_sasaranArr = array();
			$uid_ssArr = array();
			if($dataSS!=null)
			{
				foreach ($dataSS as $row) {
					$id_sasaranArr[] = $row->$id_sasaran;
					$uid_ssArr[] = $row->uid_ss;
				}
			}

			if(!empty($id_sasaranArr)) $whereIn_id_sasaran = $id_sasaran. " in ('".implode("','", $id_sasaranArr)."')";
			if(!empty($uid_ssArr)) $whereIn_uid_ss = "uid_ss in ('".implode("','", $uid_ssArr)."')";

			// indikator
			$uid_ikuArr = array();
			if(!empty($id_sasaranArr))
			{
				$this->load->model("indikator_model");
				$whereInIKU = $tabelIKU.".id_sasaran in ('".implode("','", $id_sasaranArr)."')";
				$paramIKU = array("type" => $type);
				$indikator = $this->indikator_model->getIndikator($paramIKU,$whereInIKU);
				if($indikator!=null)
				{
					foreach ($indikator as $row) {
						$uid_ikuArr[] = $row->uid_iku;
					}
				}
			}

			if(!empty($uid_ikuArr)) $whereIn_uid_iku = "uid_iku in ('".implode("','", $uid_ikuArr)."')";

			// proses delete
			
			
			if(!empty($whereIn_uid_ss)) {
				$whereIn_uid_ss_turunan = "uid_ss_atasan in ('".implode("','", $uid_ssArr)."') OR uid_ss_bawahan in ('".implode("','", $uid_ssArr)."')";

				// 10. Indikator Turunan SS
				$this->db->where($whereIn_uid_ss_turunan);
				$this->db->delete("indikator_turunan");
				
				// 9. Target
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("target_sasaran");

				// 8. Bobot
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("bobot_sasaran");

				// 7. Pencapaian Sasaran Detail
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("pencapaian_sasaran_detail");

				// 6. Pencapaian Sasaran
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("pencapaian_sasaran");
			}
			if(!empty($whereIn_uid_iku)) {
				$whereIn_uid_iku_turunan = "uid_iku_atasan in ('".implode("','", $uid_ikuArr)."') OR uid_iku_bawahan in ('".implode("','", $uid_ikuArr)."')";

				// 10. Indikator Turunan SS
				$this->db->where($whereIn_uid_ss_turunan);
				$this->db->delete("indikator_turunan");

				// 5. Pencapaian Indikator Detail
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("pencapaian_indikator_detail");



				// 4. Pencapaian Indikator
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("pencapaian_indikator");

				// 3. Renaksi
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("renaksi");

				// 2. Indikator
				$this->db->where($whereIn_uid_iku);
				$this->db->delete($tabelIKU);
			}

			// 1. Sasaran
			if(!empty($whereIn_id_sasaran)){
				$this->db->where($whereIn_id_sasaran);
				$this->db->delete($tabel_sasaran);
			}

			// 8. Update Capaian Unit
			$this->load->model("pencapaian_model");
			$this->pencapaian_model->updateCapaianUnit($rkt->id_unit_kerja,$type,$rkt->tahun_rkt);
			$this->pencapaian_model->updateCapaianUnitDetail($rkt->id_unit_kerja,$rkt->tahun_rkt);

			// 9. Ref_rkt
			$this->db->where("id_rkt",$rkt->id_rkt);
			$this->db->delete("ref_rkt");
			

		}
	}

	public function delete_ss($rkt=null,$id_sasaran)
	{
		if($rkt!=null)
		{
			// Sasaran 

			

			if($rkt->level_unit_kerja == 0)
			{
				$paramSS = array('id_sasaran_strategis' => $id_sasaran);
				$type = "SS";
				$this->load->model("sasaran_strategis_model");
				$dataSS = $this->sasaran_strategis_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_strategis";
				$tabelIKU = "sasaran_strategis_indikator";
				$tabel_sasaran = "sasaran_strategis";
			}
			
			else if($rkt->level_unit_kerja == 1)
			{
				$paramSS = array('id_sasaran_program' => $id_sasaran);
				$type = "SP";
				$this->load->model("sasaran_program_model");
				$dataSS = $this->sasaran_program_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_program";
				$tabelIKU = "sasaran_program_indikator";
				$tabel_sasaran = "sasaran_program";
			}
			else{
				$paramSS = array('id_sasaran_kegiatan' => $id_sasaran);
				$type = "SK";
				$this->load->model("sasaran_kegiatan_model");
				$dataSS = $this->sasaran_kegiatan_model->getData($paramSS,$rkt->id_rkt);
				$id_sasaran = "id_sasaran_kegiatan";
				$tabelIKU = "sasaran_kegiatan_indikator";
				$tabel_sasaran = "sasaran_kegiatan";
			}

			$id_sasaranArr = array();
			$uid_ssArr = array();
			if($dataSS!=null)
			{
				foreach ($dataSS as $row) {
					$id_sasaranArr[] = $row->$id_sasaran;
					$uid_ssArr[] = $row->uid_ss;
				}
			}
			//echo "<pre>";print_r($uid_ssArr);echo "</pre>";die;
			if(!empty($id_sasaranArr)) $whereIn_id_sasaran = $id_sasaran. " in ('".implode("','", $id_sasaranArr)."')";
			if(!empty($uid_ssArr)) $whereIn_uid_ss = "uid_ss in ('".implode("','", $uid_ssArr)."')";

			// indikator
			$uid_ikuArr = array();
			if(!empty($id_sasaranArr))
			{
				$this->load->model("indikator_model");
				$whereInIKU = $tabelIKU.".id_sasaran in ('".implode("','", $id_sasaranArr)."')";
				$paramIKU = array("type" => $type);
				$indikator = $this->indikator_model->getIndikator($paramIKU,$whereInIKU);
				if($indikator!=null)
				{
					foreach ($indikator as $row) {
						$uid_ikuArr[] = $row->uid_iku;
					}
				}
			}

			if(!empty($uid_ikuArr)) $whereIn_uid_iku = "uid_iku in ('".implode("','", $uid_ikuArr)."')";

			// proses delete
			
			
			if(!empty($whereIn_uid_ss)) {

				$whereIn_uid_ss_turunan = "uid_ss_atasan in ('".implode("','", $uid_ssArr)."')";

				// 10. Indikator Turunan SS
				$this->db->where($whereIn_uid_ss_turunan);
				$this->db->delete("indikator_turunan");

				$this->db->set("uid_ss_bawahan",null);
				$this->db->set("uid_iku_bawahan",null);
				$this->db->where("uid_ss_bawahan in ('".implode("','", $uid_ssArr)."')");
				$this->db->update("indikator_turunan");

				// 9. Target
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("target_sasaran");

				// 8. Bobot
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("bobot_sasaran");

				// 7. Pencapaian Sasaran Detail
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("pencapaian_sasaran_detail");

				// 6. Pencapaian Sasaran
				$this->db->where($whereIn_uid_ss);
				$this->db->delete("pencapaian_sasaran");
			}
			if(!empty($whereIn_uid_iku)) {
				$whereIn_uid_iku_turunan = "uid_iku_atasan in ('".implode("','", $uid_ikuArr)."') OR uid_iku_bawahan in ('".implode("','", $uid_ikuArr)."')";

				// 10. Indikator Turunan SS
				$this->db->where($whereIn_uid_ss_turunan);
				$this->db->delete("indikator_turunan");

				// 5. Pencapaian Indikator Detail
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("pencapaian_indikator_detail");



				// 4. Pencapaian Indikator
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("pencapaian_indikator");

				// 3. Renaksi
				$this->db->where($whereIn_uid_iku);
				$this->db->delete("renaksi");

				// 2. Indikator
				$this->db->where($whereIn_uid_iku);
				$this->db->delete($tabelIKU);
			}

			// 1. Sasaran
			if(!empty($whereIn_id_sasaran)){

				$this->db->where($whereIn_id_sasaran);
				$this->db->delete($tabel_sasaran);
			}

			// 8. Update Capaian Unit
			$this->load->model("pencapaian_model");
			$this->pencapaian_model->updateCapaianUnit($rkt->id_unit_kerja,$type,$rkt->tahun_rkt);
			$this->pencapaian_model->updateCapaianUnitDetail($rkt->id_unit_kerja,$rkt->tahun_rkt);

			
			

		}
	}
}