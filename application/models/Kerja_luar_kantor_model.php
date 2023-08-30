<?php

class Kerja_luar_kantor_model extends CI_Model{

	public function get_all(){
		if($this->session->userdata('level')!=='Administrator'){
			$this->db->where('id_pegawai',$this->session->userdata('id_pegawai'));
		}
		$query = $this->db->get('kerja_luar_kantor');
		return $query->result();
	}

	public function get_page($mulai,$hal,$filter=''){
		$this->db->order_by('id_kerja_luar_kantor','desc');
		if($filter!=''){
			foreach($filter as $key => $value){
				$this->db->like($key,$value);
			}
		}else{
			$this->db->limit($hal,$mulai);
		}
		if($this->session->userdata('level')!=='Administrator'){
			$this->db->where('id_pegawai',$this->session->userdata('id_pegawai'));
		}
		$query = $this->db->get('kerja_luar_kantor');
		return $query->result();
	}
	
	
	public function get_by_id($id_kerja_luar_kantor){
		$this->db->where('id_kerja_luar_kantor',$id_kerja_luar_kantor);
		$this->db->select('kerja_luar_kantor.*,pegawai.nama_lengkap as nama_pegawai_verifikator, pegawai.jabatan as jabatan_pegawai_verifikator');
		$this->db->join('pegawai','pegawai.id_pegawai = kerja_luar_kantor.id_pegawai_verifikator_kegiatan');
		$query = $this->db->get('kerja_luar_kantor');
		return $query->row();
	}

	public function get_verifered(){
		$this->db->where('id_pegawai',$this->session->userdata('id_pegawai'));
		$this->db->where('kerja_luar_kantor.id_surat_keluar !=',NULL);
		$this->db->where('surat_keluar.status_ttd','sudah_ditandatangani');
		$this->db->join('surat_keluar','surat_keluar.id_surat_keluar = kerja_luar_kantor.id_surat_keluar');
		$query = $this->db->get('kerja_luar_kantor');
		return $query->result();
	}

	public function get_by_id_verifered($id_kerja_luar_kantor){
		$this->db->where('id_kerja_luar_kantor',$id_kerja_luar_kantor);
		$this->db->join('surat_keluar','surat_keluar.id_surat_keluar = kerja_luar_kantor.id_surat_keluar');
		$query = $this->db->get('kerja_luar_kantor');
		return $query->row();
	}

	public function insert($data){
		$this->db->set('tgl_input',date('Y-m-d'));
		$this->db->set('waktu_input',date('H:i:s'));
		$query = $this->db->insert('kerja_luar_kantor',$data);
		return $this->db->insert_id();
	}
	
	public function update($data,$id_kerja_luar_kantor){
		return $query = $this->db->update('kerja_luar_kantor',$data,array('id_kerja_luar_kantor'=>$id_kerja_luar_kantor));
	}

	public function delete($id_kerja_luar_kantor){
		return $this->db->delete('kerja_luar_kantor',array('id_kerja_luar_kantor'=>$id_kerja_luar_kantor));
	}

	public function get_kegiatan_personal($id_kerja_luar_kantor){
		$this->db->where('id_kerja_luar_kantor',$id_kerja_luar_kantor);
		$query = $this->db->get('kegiatan_personal');
		return $query->result();
	}
	
}
