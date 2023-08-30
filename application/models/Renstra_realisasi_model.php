<?php
class Renstra_realisasi_model extends CI_Model{
	public function name($jenis){
		if($jenis=='ss'){
			$name = 'sasaran_strategis';
			$nSasaran = 'Sasaran Strategis';
		}elseif($jenis=='sp'){
			$name = 'sasaran_program';
			$nSasaran = 'Sasaran Program';
		}elseif($jenis=='sk'){
			$name = 'sasaran_kegiatan';
			$nSasaran = 'Sasaran Kegiatan';
		}
		$tSasaran = $name.'_renstra';
		$cSasaran = 'id_'.$tSasaran;
		$tIku = 'iku_'.$jenis.'_renstra';
		$cIku = 'id_'.$tIku;
		$cUnitKerja = 'casecade_unit_kerja_'.$tIku;
		return array('cSasaran'=>$cSasaran,'tSasaran'=>$tSasaran,'tIku'=>$tIku,'cIku'=>$cIku,'cUnitKerja'=>$cUnitKerja,'name'=>$name,'nSasaran'=>$nSasaran);

	}
	public function get_sasaran_by_id($jenis,$id_sasaran){
		$name = $this->name($jenis);
		$this->db->where($name['cSasaran'],$id_sasaran);
		$query = $this->db->get($name['tSasaran']);
		return $query->row();
	}
	public function get_sasaran_by_id_skpd($jenis,$id_skpd){
		$name = $this->name($jenis);
		$this->db->where('id_skpd',$id_skpd);
		$query = $this->db->get($name['tSasaran']);
		return $query->result();
	}
	public function get_iku($jenis,$id_sasaran){
		$name = $this->name($jenis);
		$this->db->where($name['cSasaran'],$id_sasaran);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$query = $this->db->get($name['tIku']);
		return $query->result();
	}
	public function get_iku_by_id($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['cIku'],$id_iku);
		$this->db->join('ref_satuan','ref_satuan.id_satuan = '.$name['tIku'].'.id_satuan');
		$query = $this->db->get($name['tIku']);
		return $query->row();
	}
	public function get_unit_iku($jenis,$id_iku){
		$name = $this->name($jenis);
		$this->db->where($name['cIku'],$id_iku);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = '.$name['cUnitKerja'].'.id_unit_kerja');
		$query = $this->db->get($name['cUnitKerja']);
		return $query->result();
	}
	public function update_realisasi_iku($jenis,$id_iku,$data){
		$name = $this->name($jenis);
		return $this->db->update($name['tIku'],$data,array($name['cIku']=>$id_iku));
	}
}