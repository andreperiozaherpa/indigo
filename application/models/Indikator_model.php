<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indikator_model extends CI_Model
{

	public function getFreeSSAtasan($id_unit,$level)
	{
		$select = "indikator_turunan.*";
		$this->db->where('id_unit_kerja',$id_unit);
		$this->db->where('uid_ss_bawahan',null);
		if($level<=1){
			$select .=" , sasaran_strategis.id_sasaran_strategis as id_sasaran, sasaran_strategis.kode_sasaran_strategis as kode, sasaran_strategis.sasaran_strategis as nama_sasaran, 'SS' as type";
			$this->db->join('sasaran_strategis','sasaran_strategis.uid_ss = indikator_turunan.uid_ss_atasan','left');
		}
		else{
			$select .=" , sasaran_program.id_sasaran_program as id_sasaran, sasaran_program.kode_sasaran_program as kode, sasaran_program.sasaran_program as nama_sasaran, 'SP' as type";
			$this->db->join('sasaran_program','sasaran_program.uid_ss = indikator_turunan.uid_ss_atasan','left');
		}
		$this->db->select($select);
		$query = $this->db->get('indikator_turunan');
		return $query->result();
	}

	public function updateIndikatorTurunan($param=null,$data)
	{
		if($param!=null){
			foreach ($param as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$this->db->update('indikator_turunan',$data);
		return true;
	}

	public function deleteIndikatorTurunan($uid_iku)
	{
		$this->db->where("uid_iku_bawahan = '$uid_iku'  OR uid_iku_atasan='$uid_iku'");
		
		$this->db->delete('indikator_turunan');
		return true;
	}

	public function getIndikatorTurunan($param=null,$sWhere="")
	{
		if($param!=null){
			if($param['type']=="SS"){
				$JoinIndikatorAtas		= false;
				$JoinIndikatorBawah 	= "sasaran_program_indikator";
				$JoinSasaranAtas 		= "sasaran_strategis";
				$JoinSasaranBawah 		= "sasaran_program";
				//$selectSS 				= "'' as id_sasaran_atasan, '' as nama_sasaran_atasan,'' as kode_sasaran_atasan, '' as type_atasan,";
				$selectSS 				= $JoinSasaranAtas.".id_sasaran_strategis as id_sasaran_atasan,".$JoinSasaranAtas.".sasaran_strategis as nama_sasaran_atasan, ".$JoinSasaranAtas.".kode_sasaran_strategis as kode_sasaran_atasan, 'SS' as type_atasan, ".$JoinSasaranAtas.".id_unit as id_unit_atasan,";
				$selectSS 				.= $JoinSasaranBawah.".id_sasaran_program as id_sasaran_bawahan,".$JoinSasaranBawah.".sasaran_program as nama_sasaran_bawahan, ".$JoinSasaranBawah.".kode_sasaran_program as kode_sasaran_bawahan, 'SP' as type_bawahan";
				
				
			}
			else if($param['type']=="SP"){
				$JoinIndikatorAtas		= 'sasaran_strategis_indikator';
				$JoinIndikatorBawah 	= "sasaran_kegiatan_indikator";
				$JoinSasaranAtas 		= "sasaran_strategis";
				$JoinSasaranBawah 		= "sasaran_kegiatan";
				$selectSS 				= $JoinSasaranAtas.".id_sasaran_strategis as id_sasaran_atasan,".$JoinSasaranAtas.".sasaran_strategis as nama_sasaran_atasan, ".$JoinSasaranAtas.".kode_sasaran_strategis as kode_sasaran_atasan, 'SS' as type_atasan,";
				$selectSS 				.= $JoinSasaranBawah.".id_sasaran_kegiatan as id_sasaran_bawahan,".$JoinSasaranBawah.".sasaran_kegiatan as nama_sasaran_bawahan, ".$JoinSasaranBawah.".kode_sasaran_kegiatan as kode_sasaran_bawahan, 'SK' as type_bawahan";
			}
			else {
				$JoinIndikatorAtas 		= "sasaran_program_indikator";
				$JoinIndikatorBawah 	= false;
				$JoinSasaranAtas 		= "sasaran_program";
				$JoinSasaranBawah		= false;
				$selectSS 				= $JoinSasaranAtas.".id_sasaran_program as id_sasaran_atasan,".$JoinSasaranAtas.".sasaran_program as nama_sasaran_atasan, ".$JoinSasaranAtas.".kode_sasaran_program as kode_sasaran_atasan";
				$selectSS 				.= ", '' as id_sasaran_bawahan, '' as nama_sasaran_bawahan, '' as kode_sasaran_bawahan,'SP' as type_atasan";
			}
			if($JoinIndikatorAtas!=false) $this->db->join($JoinIndikatorAtas,$JoinIndikatorAtas.".uid_iku=indikator_turunan.uid_iku_atasan",'left');
			if($JoinIndikatorBawah!=false) $this->db->join($JoinIndikatorBawah,$JoinIndikatorBawah.".uid_iku=indikator_turunan.uid_iku_bawahan",'left');
			if($JoinSasaranAtas!=false) {
				$this->db->join($JoinSasaranAtas,$JoinSasaranAtas.".uid_ss=indikator_turunan.uid_ss_atasan",'left');
				$this->db->join("ref_unit_kerja as uss", "uss.id_unit_kerja = ".$JoinSasaranAtas.".id_unit",'left');
				$selectSS 				.= ",uss.nama_unit_kerja as nama_unit_kerja_atasan";
			}
			if($JoinSasaranBawah!=false) $this->db->join($JoinSasaranBawah,$JoinSasaranBawah.".uid_ss=indikator_turunan.uid_ss_bawahan",'left');
			$this->db->join('ref_unit_kerja as c','c.id_unit_kerja = indikator_turunan.id_unit_kerja','left');

			if($sWhere!="") $this->db->where($sWhere);
			if(!empty($param['where'])){
				foreach ($param['where'] as $key => $value) {
					$this->db->where($key,$value);
				}
			}
			//if(isset($param['id_unit_kerja']))  $this->db->where('indikator_turunan.id_unit_kerja',$param['id_unit_kerja']);
			//if(isset($param['uid_iku_bawahan'])) $this->db->where('indikator_turunan.uid_iku_bawahan',$param['uid_iku_bawahan']);
			//if(isset($param['uid_ss_bawahan'])) $this->db->where('indikator_turunan.uid_ss_bawahan',$param['uid_ss_bawahan']);
			//var_dump($param);die;
			$select = "indikator_turunan.*, c.nama_unit_kerja ";
			if($JoinIndikatorAtas!=false) $select .= ",".$JoinIndikatorAtas.".uid_iku as uid_iku_atasan,".$JoinIndikatorAtas.".id_indikator as id_indikator_atasan, ".$JoinIndikatorAtas.".kode_indikator as kode_indikator_atasan, ".$JoinIndikatorAtas.".nama_indikator as nama_indikator_atasan, ".$JoinIndikatorAtas.".target as target_indikator_atasan, ".$JoinIndikatorAtas.".id_satuan as id_satuan_indikator_atasan";
			if($JoinIndikatorBawah!=false) $select .= ",".$JoinIndikatorBawah.".kode_indikator as kode_indikator_bawahan, ".$JoinIndikatorBawah.".nama_indikator as nama_indikator_bawahan, ".$JoinIndikatorBawah.".target as target_bawahan";

			
			$select .= ",".$selectSS;
			$this->db->select($select);
			$query = $this->db->get('indikator_turunan');
			return $query->result();
		}
		else return false;
	}
	
	public function getIndikator($param=null,$sWhere="")
	{
		if($param!=null){
			if($param['type']=="SS"){
				$table = "sasaran_strategis_indikator";
				$fTable = "sasaran_strategis";
				$fKey = "id_sasaran_strategis";
				$select = "sasaran_strategis.id_sasaran_strategis, sasaran_strategis.kode_sasaran_strategis, sasaran_strategis.sasaran_strategis, sasaran_strategis.uid_ss, sasaran_strategis.tahun as tahun";
				$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_strategis_indikator.id_sasaran','left');
			}
			else if($param['type']=="SP"){
				$table = "sasaran_program_indikator";
				$fTable = "sasaran_program";
				$fKey = "id_sasaran_program";
				$select ="sasaran_program.id_sasaran_program, sasaran_program.kode_sasaran_program, sasaran_program.sasaran_program, sasaran_program.uid_ss, sasaran_program.tahun as tahun";
				$select .= ", sasaran_strategis.id_sasaran_strategis, sasaran_strategis.kode_sasaran_strategis, sasaran_strategis.sasaran_strategis";
				$this->db->join('sasaran_program','sasaran_program.id_sasaran_program=sasaran_program_indikator.id_sasaran','left');
				$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_program.id_sasaran_strategis','left');
			}
			else {
				$table = "sasaran_kegiatan_indikator";
				$fTable = "sasaran_kegiatan";
				$fKey = "id_sasaran_kegiatan";
				$select ="sasaran_kegiatan.id_sasaran_kegiatan,sasaran_kegiatan.kode_sasaran_kegiatan, sasaran_kegiatan.sasaran_kegiatan, sasaran_kegiatan.uid_ss, sasaran_kegiatan.tahun as tahun ";
				$select .=", sasaran_program.id_sasaran_program, sasaran_program.kode_sasaran_program, sasaran_program.sasaran_program";
				$select .= ", sasaran_strategis.id_sasaran_strategis, sasaran_strategis.kode_sasaran_strategis, sasaran_strategis.sasaran_strategis";
				$this->db->join('sasaran_kegiatan','sasaran_kegiatan.id_sasaran_kegiatan=sasaran_kegiatan_indikator.id_sasaran','left');
				$this->db->join('sasaran_program','sasaran_program.id_sasaran_program=sasaran_kegiatan.id_sasaran_program','left');
				$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_program.id_sasaran_strategis','left');
			}
			//$this->db->join($fTable, $fTable.'.'.$fKey .'='.$table.'.id_sasaran', 'left');
			$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$fTable.".id_unit");
			$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$table.'.id_satuan','left');

			if(isset($param['id_sasaran'])) $this->db->where($table.'.id_sasaran',$param['id_sasaran']);
			if(isset($param['id_unit'])) $this->db->where($fTable.'.id_unit',$param['id_unit']);
			if(isset($param['id_indikator'])) $this->db->where($table.'.id_indikator',$param['id_indikator']);
			if(isset($param['uid_iku'])) $this->db->where($table.'.uid_iku',$param['uid_iku']);

			if(isset($param['id_rkt'])){
				$select .= ",pencapaian_indikator.realisasi, pencapaian_indikator.capaian, pencapaian_indikator.status_capaian";
				$this->db->join('pencapaian_indikator','pencapaian_indikator.uid_iku = '.$table.'.uid_iku AND pencapaian_indikator.id_rkt='.$param['id_rkt'],'left');
			}
			if($sWhere!="") $this->db->where($sWhere);
			$this->db->select($table.".*, ref_unit_kerja.id_unit_kerja, ref_unit_kerja.nama_unit_kerja, ref_satuan.satuan, ".$select);
			$query = $this->db->get($table);
			return $query->result();
		}
		else return false;
	}
	public function insert_data($table, $param)
	{
		$id = $this->db->insert($table,$param);
		return $id;
	}
	public function insert_data_turunan($param)
	{
		$id = $this->db->insert('indikator_turunan',$param);
		return $id;
	}
	public function hapus($id_indikator,$type)
	{
		if($type=="SS"){
			$table="sasaran_strategis_indikator";
		}
		else if($type=="SP"){
			$table = "sasaran_program_indikator";
		}
		else{
			$table ="sasaran_kegiatan_indikator";
		}
		$this->db->where('id_indikator',$id_indikator);
		$query = $this->db->delete($table);
		//var_dump($type);
	}

	public function update($data,$id_indikator,$type)
	{
		if($type=="SS"){
			$table="sasaran_strategis_indikator";
		}
		else if($type=="SP"){
			$table = "sasaran_program_indikator";
		}
		else{
			$table ="sasaran_kegiatan_indikator";
		}
		$this->db->where('id_indikator',$id_indikator);
		$query = $this->db->update($table,$data);
		//var_dump($type);
	}

	public function getTotal($type,$id_unit,$tahun,$uid_ss=null)
	{
		$this->db->select("count(id_indikator) as total");
		if($type=="SS"){
			$this->db->join('sasaran_strategis','sasaran_strategis.id_sasaran_strategis=sasaran_strategis_indikator.id_sasaran','left');
			$this->db->where("sasaran_strategis.id_unit",$id_unit);
			$this->db->where("sasaran_strategis.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_strategis.uid_ss",$uid_ss);
			$query = $this->db->get("sasaran_strategis_indikator");
		}
		else if($type=="SP")
		{
			$this->db->join('sasaran_program','sasaran_program.id_sasaran_program=sasaran_program_indikator.id_sasaran','left');
			$this->db->where("sasaran_program.id_unit",$id_unit);
			$this->db->where("sasaran_program.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_program.uid_ss",$uid_ss);
			$query = $this->db->get("sasaran_program_indikator");
		}
		else{
			$this->db->join('sasaran_kegiatan','sasaran_kegiatan.id_sasaran_kegiatan=sasaran_kegiatan_indikator.id_sasaran','left');
			$this->db->where("sasaran_kegiatan.id_unit",$id_unit);
			$this->db->where("sasaran_kegiatan.tahun",$tahun);
			if($uid_ss!=null) $this->db->where("sasaran_kegiatan.uid_ss",$uid_ss);
			$query = $this->db->get("sasaran_kegiatan_indikator");
		}
		$total = 0;
		$result = $query->result();
		if(!empty($result[0]))
		{
			$total = $result[0]->total;
		}
		return $total;
	}
}
