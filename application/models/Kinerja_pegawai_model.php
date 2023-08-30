<?php
class Kinerja_pegawai_model extends CI_Model{
	public function insert($data){
		$this->db->insert('kinerja_pegawai',$data);
	}
	public function get_jumlah_indikator_pegawai($nip){
		$this->db->where('nip',$nip);
		$this->db->group_by(array('jenis_sasaran','id_iku'));
		$get = $this->db->get('kinerja_pegawai')->result();
		return count($get);
	}
	public function get_kinerja($jenis,$nip){
		$this->db->where('jenis_sasaran',$jenis);
		$this->db->where('nip',$nip);
		$this->db->group_by(array('jenis_sasaran','id_iku','nip'));
		$this->db->join('iku_'.$jenis.'_renja','iku_'.$jenis.'_renja.id_iku_'.$jenis.'_renja = kinerja_pegawai.id_iku');
		$this->db->join('iku_'.$jenis.'_renstra','iku_'.$jenis.'_renstra.id_iku_'.$jenis.'_renstra = iku_'.$jenis.'_renja.id_iku_'.$jenis.'_renstra');
		$get = $this->db->get('kinerja_pegawai')->result();
		return $get;
	}
	public function get_iku($jenis,$nip,$id_iku){
		$this->db->where('jenis_sasaran',$jenis);
		$this->db->where('nip',$nip);
		$get = $this->db->get('kinerja_pegawai')->result();
		return $get;

	}
}