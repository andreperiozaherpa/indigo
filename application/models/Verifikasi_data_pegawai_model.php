<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_data_pegawai_model extends CI_Model{

	public function get_all(){
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_page($mulai,$hal,$nama,$nip,$skpd,$summary_field='',$summary_value='',$where=''){

		if($nama!='') {
			$this->db->like('nama_lengkap', $nama);
		}
		if($nip!='') {
			$this->db->like('nama_lengkap', $nama);
		}
		if($skpd!=''){
				$this->db->where('pegawai.id_skpd', $skpd);
		}

		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('pegawai.'.$summary_field,$summary_value);
		}

		if($where!==''){
			$this->db->where($where);
		}

		if($nama=="" && $nip=="" && $skpd==""){
			$this->db->limit($hal,$mulai);
		}

		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->where('length(nip)=18');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_pages($summary_field='',$summary_value=''){

		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		if($summary_field!=''&&$summary_value!=''){
			$this->db->where('pegawai.'.$summary_field,$summary_value);
		}
		$this->db->where('length(nip)=18');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_total_pegawai(){
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->where('length(nip)=18');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}
	public function get_total_pegawai_true(){
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->where('length(nip)=18');
		$this->db->where('pegawai.status_verifikasi_data', 'true');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}
	public function get_total_pegawai_process(){
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->where('length(nip)=18');
		$this->db->where('pegawai.status_verifikasi_data', 'process');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}
	public function get_total_pegawai_false(){
		$this->db->join('master_pegawai', 'master_pegawai.nip_baru = pegawai.nip');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->where('length(nip)=18');
		$this->db->where('pegawai.status_verifikasi_data', 'false');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}


	public function get_by_id($id_pegawai){
		$this->db->where('id_pegawai',$id_pegawai);
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function get_by_id_skpd($id_skpd,$registered=false){
		if($id_skpd!=''&&$id_skpd!=0){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		if($registered==true){
			$this->db->where('id_user !=',0);
		}
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap','ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_jml_by_id_skpd($id_skpd){
		if($id_skpd!=''&&$id_skpd!=0){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap','ASC');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}

	public function get_registered_by_id_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('id_user !=',0);
		$query = $this->db->get('pegawai');
		return $query->num_rows();

	}

	public function get_not_registered_by_id_skpd($id_skpd){
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('id_user',0);
		$query = $this->db->get('pegawai');
		return $query->num_rows();

	}

	public function insert($data){
		return $this->db->insert('pegawai',$data);
	}
	public function update($data,$id_pegawai){
		return $this->db->update('pegawai',$data,array('id_pegawai'=>$id_pegawai));
	}
	public function delete($id_pegawai){
		$this->db->delete('pegawai',array('id_pegawai'=>$id_pegawai));
	}

}
