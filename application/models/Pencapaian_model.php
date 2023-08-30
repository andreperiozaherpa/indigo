<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencapaian_model extends CI_Model
{
	public function insertDetail($data)
	{
		$this->db->insert('pencapaian_indikator_detail',$data);
	}
	public function insertIndikator($data)
	{
		$this->db->insert('pencapaian_indikator',$data);
	}
	public function insertSasaran($data)
	{
		$this->db->insert('pencapaian_sasaran',$data);
	}
	public function updateSasaranDetail($data,$id)
	{
		$this->db->where("id_capaian_sasaran_detail",$id);
		$this->db->update('pencapaian_sasaran_detail',$data);
	}
	public function getSasaranDetail($id)
	{
		$this->db->where("id_capaian_sasaran_detail",$id);
		$query = $this->db->get('pencapaian_sasaran_detail');
		return $query->row();
	}
	public function getSasaranDetail2($id)
	{
		$type = explode("-", $id);

		switch ($type[0]) {
			case 'SS':
				$this->db->select("sasaran_strategis AS sasaran, id_unit");
				$this->db->where("uid_ss",$id);
				$query = $this->db->get('sasaran_strategis');
				break;

			case 'SP':
				$this->db->select("sasaran_program AS sasaran, id_unit");
				$this->db->where("uid_ss",$id);
				$query = $this->db->get('sasaran_program');
				break;

			case 'SK':
				$this->db->select("sasaran_kegiatan AS sasaran, id_unit");
				$this->db->where("uid_ss",$id);
				$query = $this->db->get('sasaran_kegiatan');
				break;
			
			default:
				$this->db->where("uid_ss",null);
				$query = $this->db->get('pencapaian_sasaran_detail');
				break;
		}
		return $query->row();
	}
	public function getCapaianIndikatorDetail($param)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->join('renaksi','renaksi.id_renaksi=pencapaian_indikator_detail.id_renaksi','left');
		$this->db->join('ref_satuan','renaksi.id_satuan=ref_satuan.id_satuan','left');
		$query = $this->db->get('pencapaian_indikator_detail');
		return $query->result();
	}
	public function getCapaianSasaranDetail($param,$type)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		if($type=="SS"){
			$this->db->join("sasaran_strategis","sasaran_strategis.uid_ss=pencapaian_sasaran_detail.uid_ss","left");
		}
		else if($type=="SP"){
			$this->db->join("sasaran_program","sasaran_program.uid_ss=pencapaian_sasaran_detail.uid_ss","left");
		}
		else if($type=="SK"){
			$this->db->join("sasaran_kegiatan","sasaran_kegiatan.uid_ss=pencapaian_sasaran_detail.uid_ss","left");
		}
		$query = $this->db->get('pencapaian_sasaran_detail');
		return $query->result();
	}
	public function getCapaianIndikator($param,$type)
	{
		foreach ($param as $key => $value) {
			$this->db->where($key,$value);
		}
		if($type=="SS"){
			$this->db->join("sasaran_strategis_indikator","sasaran_strategis_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_strategis_indikator.id_satuan','left');
		}
		else if($type=="SP"){
			$this->db->join("sasaran_program_indikator","sasaran_program_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_program_indikator.id_satuan','left');
		}
		else if($type=="SK"){
			$this->db->join("sasaran_kegiatan_indikator","sasaran_kegiatan_indikator.uid_iku=pencapaian_indikator.uid_iku","left");
			$this->db->join('ref_satuan','ref_satuan.id_satuan=sasaran_kegiatan_indikator.id_satuan','left');
		}
		
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja=pencapaian_indikator.id_unit','left');
		$query = $this->db->get('pencapaian_indikator');
		return $query->result();
	}
	public function updateCapaianDetail($param,$id)
	{
		//return var_dump($param);
		if($param!=null && $id!=null){
			$this->db->where('id_capaian_indikator',$id);
			$this->db->update('pencapaian_indikator_detail',$param);
		}
		return true;
	}

	public function deleteDetail($uid_iku)
	{
		$this->db->where("uid_iku",$uid_iku);
		$this->db->delete('pencapaian_indikator_detail');
	}
	public function deleteIndikator($uid_iku)
	{
		$this->db->where("uid_iku",$uid_iku);
		$this->db->delete('pencapaian_indikator');
	}
	public function updateCapaianIndikator($indikator=array())
	{
		if(!empty($indikator)){
			$uid_iku = $indikator[0]->uid_iku;
			$formula = $indikator[0]->formula;
			$tahun = $indikator[0]->tahun;
			$id_unit_kerja = $indikator[0]->id_unit_kerja;
			//var_dump($tahun);

			//$select = "";
			//if($formula=="A") $select = ",sum(realisasi) as 'realisasi' ";
			//$this->db->select("avg(capaian) as 'capaian' ".$select);
			$this->db->where("uid_iku",$uid_iku);
			$this->db->where("dijadwalkan",1);
			//$this->db->where("status_evaluasi",1);
			$qry = $this->db->get('pencapaian_indikator_detail');
			$rs = $qry->result();
			//var_dump($rs);
			if($rs!=null)
			{
				$jml_capaian = 0;
				$total_capaian = 0;
				foreach ($rs as $r) {
					$temp_capaian = ($r->status_evaluasi==1)? $r->capaian : 0;
					$total_capaian = $total_capaian + $temp_capaian;
					$jml_capaian++;
				}
				$capaian_rata2 = 0;
				if($jml_capaian >0){
					$capaian_rata2 = $total_capaian / $jml_capaian;
				}
				//$capaian_rata2 = $rs[0]->capaian;
				$this->db->where("uid_iku",$uid_iku);
				$qry_cek = $this->db->get('pencapaian_indikator');
				$rs_cek = $qry_cek->result();
				if($rs_cek==null){

					$this->db->where("tahun_rkt",$tahun);
					$this->db->where("id_unit_penanggungjawab",$id_unit_kerja);
					$qry_rkt = $this->db->get("ref_rkt");
					$rs_rkt = $qry_rkt->result();
					$id_rkt = !empty($rs_rkt[0]) ? $rs_rkt[0]->id_rkt : 0;


					$this->db->set("capaian",$capaian_rata2);
					$this->db->set("id_rkt",$id_rkt);
					$this->db->set("tahun",$tahun);
					$this->db->set("id_unit",$id_unit_kerja);
					$this->db->set("uid_iku",$uid_iku);
					$this->db->set("target",$indikator[0]->target);
					if($formula=="A") 
						$this->db->set("realisasi",$rs[0]->realisasi);
					$this->db->insert("pencapaian_indikator");
				}
				else{
					$this->db->where("uid_iku",$uid_iku);
					$this->db->set("capaian",$capaian_rata2);
					if($formula=="A") 
						$this->db->set("realisasi",$rs[0]->realisasi);
					$this->db->update("pencapaian_indikator");
				}
			}
		}
		
	}
	public function updateCapaianSasaran($uid_ss,$type,$id_sasaran)
	{
		$this->load->model("indikator_model");
		$param = array("type" => $type, 'id_sasaran' => $id_sasaran);
		$indikator = $this->indikator_model->getIndikator($param);

		if($indikator!=null)
		{
			$bobotArr = array();
			foreach ($indikator as $row) {
				$bobotArr[$row->uid_iku] = $row->bobot;
			}
			$inArrUIDiku = "'".implode("','", array_keys($bobotArr))."'";
			$this->db->where("pencapaian_indikator.uid_iku in ($inArrUIDiku)");
			$qry = $this->db->get("pencapaian_indikator");
			$rs = $qry->result();

			$capaian = 0;
			//var_dump($inArrUIDiku);
			foreach ($rs as $row) {
				$temp = $bobotArr[$row->uid_iku] * $row->capaian / 100;
				$capaian = $capaian + $temp;
				//var_dump($temp);
			}

			// cek
			$this->db->where("uid_ss",$uid_ss);
			$qry_cek = $this->db->get("pencapaian_sasaran");
			$rs_cek = $qry_cek->result();

			if($rs_cek==null){

				
				$tahun = !empty($indikator[0]) ? $indikator[0]->tahun : 0;
				$id_unit_kerja =!empty($indikator[0]) ? $indikator[0]->id_unit_kerja : 0 ;
				

				$this->db->where("tahun_rkt",$tahun);
				$this->db->where("id_unit_penanggungjawab",$id_unit_kerja);
				$qry_rkt = $this->db->get("ref_rkt");
				$rs_rkt = $qry_rkt->result();
				$id_rkt = !empty($rs_rkt[0]) ? $rs_rkt[0]->id_rkt : 0;


				
				if($type=="SS")
				{
					$paramSS = array("sasaran_strategis.uid_ss" => $uid_ss);
					$this->load->model("sasaran_strategis_model");
					$dataSS = $this->sasaran_strategis_model->getData($paramSS,$id_rkt);
				}
				else if($type=="SP")
				{
					$paramSS = array("sasaran_program.uid_ss" => $uid_ss);
					$this->load->model("sasaran_program_model");
					$dataSS = $this->sasaran_program_model->getData($paramSS,$id_rkt);
				}
				else 
				{
					$paramSS = array("sasaran_kegiatan.uid_ss" => $uid_ss);
					$this->load->model("sasaran_kegiatan_model");
					$dataSS = $this->sasaran_kegiatan_model->getData($paramSS,$id_rkt);
				}

				$target =!empty($dataSS[0]->target) ? $dataSS[0]->target : "" ;

				$this->db->set("id_rkt",$id_rkt);
				$this->db->set("uid_ss",$uid_ss);
				$this->db->set("target",$target);
				//$this->db->set("realisasi",$realisasi);
				$this->db->set("capaian",$capaian);
				$this->db->insert("pencapaian_sasaran");
			}
			else{
				$this->db->where("uid_ss",$uid_ss);
				$this->db->set("capaian",$capaian);
				$this->db->update("pencapaian_sasaran");
			}
		}
		
	}
	public function updateCapaianUnit($id_unit,$type,$tahun)
	{
		$param = array("id_unit" => $id_unit, "tahun" => $tahun);
		if($type=="SS")
		{
			$this->load->model('sasaran_strategis_model');
			$sasaran = $this->sasaran_strategis_model->getData($param);
		}
		else if($type=="SP")
		{
			$this->load->model('sasaran_program_model');
			$sasaran = $this->sasaran_program_model->getData($param);
		}
		else if($type=="SK")
		{
			$this->load->model('sasaran_kegiatan_model');
			$sasaran = $this->sasaran_kegiatan_model->getData($param);
		}
		if(!empty($sasaran)){
			$uid_ssArr = array();
			foreach ($sasaran as $row) {
				$uid_ssArr[] = $row->uid_ss;
			}
			$inArrUidSS = "'".implode("','", $uid_ssArr)."'";
			$this->db->where("pencapaian_sasaran.uid_ss in ($inArrUidSS)");
			$this->db->join("bobot_sasaran","bobot_sasaran.uid_ss=pencapaian_sasaran.uid_ss","left");
			$query= $this->db->get("pencapaian_sasaran");
			$rs = $query->result();
			
			$capaian = 0;
			foreach ($rs as $row) {
				$temp = $row->bobot * $row->capaian / 100;
				$capaian = $capaian + $temp;
			}

			$this->db->where("id_unit",$id_unit);
			$this->db->where("tahun",$tahun);
			$cek = $this->db->get("pencapaian_unit");
			$rs_cek = $cek->result();
			if($rs_cek==null){
				$this->db->set("id_unit",$id_unit);
				$this->db->set("tahun",$tahun);
				$this->db->set("nilai",$capaian);
				$this->db->insert("pencapaian_unit");
			}
			else{
				$this->db->where("id_unit",$id_unit);
				$this->db->where("tahun",$tahun);
				$this->db->set("nilai",$capaian);
				$this->db->update("pencapaian_unit");
			}
		}
	}
	public function updateCapaianIndikatorAtasan($uid_iku_atasan, $iku_bawahan=array(), $indikator, $type)
	{
		$perhitungan = $indikator[0]->perhitungan;
		$formula = $indikator[0]->formula;
		$tahun = $indikator[0]->tahun;
		$id_unit_kerja = $indikator[0]->id_unit_kerja;

		if($perhitungan=="AK" && $formula=="A"){ // Akumulasi
			$select = "sum(realisasi) as realisasi";
		}
		else if($perhitungan=="RR" && $formula=="A"){ // Rata2
			$select = "avg(realisasi) as realisasi";
		}
		else if($perhitungan=="AK" && $formula=="A"){ // SP
			$select = "realisasi";
		}
		if(!empty($select)){
			$whereIn = "'".implode("','", $iku_bawahan)."'";
			//var_dump($formula);
			$this->db->select($select);
			$this->db->where("uid_iku in ($whereIn)");
			$query = $this->db->get('pencapaian_indikator');
			$res = $query->result();
			if($res[0]->realisasi!=null){
				$realisasi = $res[0]->realisasi;

				$this->db->where("uid_iku",$uid_iku_atasan);
				$qry_cek = $this->db->get('pencapaian_indikator');
				$rs_cek = $qry_cek->result();
				if($rs_cek==null){

					

					$this->db->where("tahun_rkt",$tahun);
					$this->db->where("id_unit_penanggungjawab",$id_unit_kerja);
					$qry_rkt = $this->db->get("ref_rkt");
					$rs_rkt = $qry_rkt->result();
					$id_rkt = !empty($rs_rkt[0]) ? $rs_rkt[0]->id_rkt : 0;


					//$this->db->set("capaian",$capaian_rata2);
					$this->db->set("id_rkt",$id_rkt);
					$this->db->set("tahun",$tahun);
					$this->db->set("id_unit",$id_unit_kerja);
					$this->db->set("uid_iku",$uid_iku_atasan);
					$this->db->set("target",$indikator[0]->target);
					$this->db->set("realisasi",$realisasi);
					$this->db->insert("pencapaian_indikator");
				}
				else{
					$this->db->set("realisasi",$realisasi);
					$this->db->where("uid_iku",$uid_iku_atasan);
					$this->db->update("pencapaian_indikator");
				}

				
			}
			//var_dump($where);
		}
	}
	public function updateCapaianSasaranDetail($uid_ss,$tahun,$id_unit)
	{
		$GLOBALVAR = GLOBALVAR;
		foreach ($GLOBALVAR['bulan'] as $key => $value) {
			$bulan = $key;

			$this->db->select("avg(capaian) as capaian");
			$this->db->where("uid_ss",$uid_ss);
			$this->db->where("tahun",$tahun);
			$this->db->where("bulan",$bulan);
			$this->db->where("dijadwalkan",1);
			$this->db->where("status_evaluasi",1);
			$qry = $this->db->get("pencapaian_indikator_detail");
			$res = $qry->result();
			$capaian = 0;
			if(!empty($res[0]->capaian)){
				$capaian = $res[0]->capaian;
			}

			$this->db->where("uid_ss",$uid_ss);
			$this->db->where("tahun",$tahun);
			$this->db->where("bulan",$bulan);
			$qrySS = $this->db->get("pencapaian_sasaran_detail");
			$resSS = $qrySS->result();
			//var_dump($resSS);die;
			if($resSS!=null){
				$id_capaian_sasaran_detail = $resSS[0]->id_capaian_sasaran_detail;
				$this->db->where("id_capaian_sasaran_detail",$id_capaian_sasaran_detail);
				$this->db->set("capaian",$capaian);
				$this->db->update("pencapaian_sasaran_detail");
			}
			else{
				$this->db->set("uid_ss",$uid_ss);
				$this->db->set("id_unit",$id_unit);
				$this->db->set("tahun",$tahun);
				$this->db->set("bulan",$bulan);
				$this->db->set("capaian",$capaian);
				$this->db->insert("pencapaian_sasaran_detail");
			}
		}
	}

	public function updateCapaianUnitDetail($id_unit,$tahun)
	{
		$GLOBALVAR = GLOBALVAR;
		foreach ($GLOBALVAR['bulan'] as $key => $value) {
			$bulan = $key;

			$this->db->select("avg(p.capaian) as capaian, p.uid_ss, avg(b.bobot) as bobot");
			$this->db->where("id_unit",$id_unit);
			$this->db->where("tahun",$tahun);
			$this->db->where("bulan",$bulan);
			$this->db->where("p.dijadwalkan",1);
			$this->db->where("p.status_evaluasi",1);
			$this->db->join("bobot_sasaran as b","b.uid_ss=p.uid_ss","left");
			$this->db->group_by("p.uid_ss");
			$qry = $this->db->get("pencapaian_indikator_detail as p");
			$res = $qry->result();
			//echo "<pre>";print_r($res);die;
			
			$capaian = 0;

			if($res!=null)
			{
				
				foreach ($res as $row) {
					$cap = ($row->capaian > 0 && $row->bobot > 0 ) ? ($row->capaian * $row->bobot / 100) : 0;
					$capaian = $capaian + $cap;
				}
			}
				$this->db->where("id_unit",$id_unit);
				$this->db->where("tahun",$tahun);
				$this->db->where("bulan",$bulan);
				$qrySS = $this->db->get("pencapaian_unit_detail");
				$resSS = $qrySS->result();
				//var_dump($resSS);die;
				if($resSS!=null){
					$id_capaian_unit_detail = $resSS[0]->id_capaian_unit_detail;
					$this->db->where("id_capaian_unit_detail",$id_capaian_unit_detail);
					$this->db->set("capaian",$capaian);
					$this->db->update("pencapaian_unit_detail");
				}
				else{
					$this->db->set("id_unit",$id_unit);
					$this->db->set("tahun",$tahun);
					$this->db->set("bulan",$bulan);
					$this->db->set("capaian",$capaian);
					$this->db->insert("pencapaian_unit_detail");
				}
			
		}
	}

	public function getCapaianTriwulan($id_unit,$tahun,$bulan1,$bulan2)
	{
		$capaian = 0;
		//$this->db->where("tahun",$tahun);
		//$this->db->where("id_unit",$id_unit);
		//$this->db->where("bulan >= ".$bulan1);
		//$this->db->where("bulan <= ".$bulan2);
		$this->db->select("avg(capaian) as capaian");
		$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pencapaian_unit_detail.id_unit","left");
		$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit) AND (bulan >= $bulan1 AND bulan <= $bulan2) AND tahun = $tahun ");
		$qry = $this->db->get("pencapaian_unit_detail");
		$res = $qry->result();
		if(!empty($res[0]->capaian)){
			$capaian = number_format($res[0]->capaian,2);
		}
		return $capaian;
	}
	public function getCapaianTahunan($id_unit,$tahun)
	{
		$capaian = 0;
		$this->db->where("tahun",$tahun);
		$this->db->where("id_unit",$id_unit);
		//$this->db->select("avg(capaian) as capaian");
		//$this->db->join("ref_unit_kerja","ref_unit_kerja.id_unit_kerja = pencapaian_unit_detail.id_unit","left");
		//$this->db->where("(ref_unit_kerja.ket_induk like '%|$id_unit|%' OR id_unit = $id_unit)");
		$qry = $this->db->get("pencapaian_unit");
		$res = $qry->result();
		if(!empty($res[0]->nilai)){
			$capaian = $res[0]->nilai;
		}
		return $capaian;
	}

	/// FUNGSI TRIGER CAPAIAN 
	/*
				$params = array(
		            	'data_indikator_detail'	=> array,
		            	'id_capaian_indikator'	=> int,
		            	'indikator'				=> array,
		            	'type'					=> string,
		            );
		            */

	public function updateAll($params=array())
	{
		$indikator = $params['indikator'];
		//var_dump($indikator);
		$type = $params['type'];
		$this->updateCapaianDetail($params['data_indikator_detail'],$params['id_capaian_indikator']);
		$this->updateCapaianIndikator($indikator);
		$this->updateCapaianIKUAtasan($type, $indikator);
		$this->updateCapaianSasaran($indikator[0]->uid_ss,$type,$indikator[0]->id_sasaran);
		$this->updateCapaianSasaranDetail($indikator[0]->uid_ss,$indikator[0]->tahun,$indikator[0]->id_unit_kerja);
		$this->updateCapaianUnit($indikator[0]->id_unit_kerja,$type,$indikator[0]->tahun);
		$this->updateCapaianUnitDetail($indikator[0]->id_unit_kerja,$indikator[0]->tahun);
	}

	private function updateCapaianIKUAtasan($type, $indikator)
	{
//		$this->load->model('indikator_model');
//		$params = array(
//			'type' => $type,
//			'id_indikator' => $id_indikator,
//			'id_rkt'		=> $id_rkt,
//		);
//		$indikator = $this->indikator_model->getIndikator($params);


		$param1 = array(
			'type'	=> $type,
			'where'	=> array(
				'indikator_turunan.uid_iku_bawahan' => $indikator[0]->uid_iku,
			)
		);
		$iku_atasan1 = $this->indikator_model->getIndikatorTurunan($param1);
		$this->prosesUpdateCapaianIKUAtasan($iku_atasan1);

		if(!empty($iku_atasan1[0])){
			$param2 = array(
				'type'	=> $iku_atasan1[0]->type_atasan,
				'where'	=> array(
					'indikator_turunan.uid_iku_bawahan' => $iku_atasan1[0]->uid_iku_atasan,
				)
			);
			$iku_atasan2 = $this->indikator_model->getIndikatorTurunan($param2);
			$this->prosesUpdateCapaianIKUAtasan($iku_atasan2);

			if(!empty($iku_atasan2)){
				$param3 = array(
					'type'	=> $iku_atasan2[0]->type_atasan,
					'where'	=> array(
						'indikator_turunan.uid_iku_bawahan' => $iku_atasan2[0]->uid_iku_atasan,
					)
				);
				$iku_atasan3 = $this->indikator_model->getIndikatorTurunan($param3);
				$this->prosesUpdateCapaianIKUAtasan($iku_atasan3);

				if(!empty($iku_atasan3)){
					$param4 = array(
						'type'	=> $iku_atasan3[0]->type_atasan,
						'where'	=> array(
							'indikator_turunan.uid_iku_bawahan' => $iku_atasan3[0]->uid_iku_atasan,
						)
					);
					$iku_atasan4 = $this->indikator_model->getIndikatorTurunan($param4);
					$this->prosesUpdateCapaianIKUAtasan($iku_atasan4);
				}
			}
		}

	}

	private function prosesUpdateCapaianIKUAtasan($iku_atasan)
	{
		if(!empty($iku_atasan[0])){
			$uid_iku_atasan = $iku_atasan[0]->uid_iku_atasan;
			$type_atasan = $iku_atasan[0]->type_atasan;

			$indikator_atasan = $this->indikator_model->getIndikator(array('type'=>$type_atasan, 'uid_iku' => $uid_iku_atasan));
			if(!empty($indikator_atasan[0]) && $indikator_atasan[0]->metode_penurunan=="AL" ){
				// select iku bawahan
					$param3 = array(
						'type'	=> $type,
						'where'	=> array(
							'indikator_turunan.uid_iku_atasan' => $indikator_atasan[0]->uid_iku,
						)
					);
					$iku_bawahan = $this->indikator_model->getIndikatorTurunan($param3,"indikator_turunan.uid_iku_bawahan is not null");
					$uid_iku_bawahanArr = array();
					foreach ($iku_bawahan as $row) {
						$uid_iku_bawahanArr[] = $row->uid_iku_bawahan;
					}
					// bypass
					//$uid_iku_bawahanArr[] = "ISS-5BDF06544595A";
					if($uid_iku_bawahanArr){
						$this->updateCapaianIndikatorAtasan($uid_iku_atasan, $uid_iku_bawahanArr,$indikator_atasan,$type);
						//$this->pencapaian_model->updateCapaianIndikatorAtasan($uid_iku_atasan, $uid_iku_bawahanArr,"AK", "A");
					}	
			}
		}
	}

	public function getFile($param=null)
	{
		if($param!=null) {
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->where("berkas is not null");
		$qry = $this->db->get("pencapaian_indikator_detail");
		$result = $qry->result();
		return $result;
	}
}