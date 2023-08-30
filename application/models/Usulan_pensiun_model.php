<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usulan_pensiun_model extends CI_Model{

	public function get_all($verifikasi=false){
		if($verifikasi){
			$this->db->where('usulan_pensiun.status_usulan !=','upload');
		}
		$this->db->join('pegawai','pegawai.id_pegawai = usulan_pensiun.id_pegawai');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('usulan_pensiun');
		return $query->result();
	}
	public function get_page($mulai,$hal,$nama, $skpd,$verifikasi=false,$status=''){
		if($nama!='') {
			$this->db->like('pegawai.nama_lengkap', $nama);
		}if($skpd!=''){
			$this->db->where('pegawai.id_skpd', $skpd);
		}
		if($verifikasi){
			$this->db->where('usulan_pensiun.status_usulan !=','upload');
		}
		if($status!=''){
			$this->db->where('usulan_pensiun.status_usulan',$status);
		}
		if($nama==''&&$skpd==''&&$status==''){
			$this->db->limit($hal,$mulai);
		}
		$this->db->order_by('usulan_pensiun.id_usulan','DESC');
		$this->db->join('pegawai','pegawai.id_pegawai = usulan_pensiun.id_pegawai');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('data_bkd','data_bkd.nip = pegawai.nip','left');
		$this->db->join('ref_alasan_pensiun','ref_alasan_pensiun.id_alasan_pensiun = usulan_pensiun.id_alasan_pensiun');
		$this->db->select("*, 
			@masa_pensiun:=IF((SUBSTR(data_bkd.nama_eselon,1,'2')='II') OR (data_bkd.jenis_jabatan='Fungsional' AND INSTR(data_bkd.nama_jabatan,'Madya')>0),'60','58') as masa_pensiun
			");
		$this->db->select('@prediksi_pensiun:=DATE_SUB(
			LAST_DAY(
			DATE_ADD(DATE_ADD(data_bkd.tgllahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			), 
			INTERVAL DAY(
			LAST_DAY(
			DATE_ADD(DATE_ADD(data_bkd.tgllahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			)
			)-1 DAY
		) as prediksi_pensiun',false);
		$this->db->select('@tahun_pensiun:=YEAR(@prediksi_pensiun) as tahun_pensiun',false);
		$query = $this->db->get('usulan_pensiun');
		return $query->result();
	}
	public function get_by_status($status){
		$this->db->where('status_usulan',$status);
		$query = $this->db->get('usulan_pensiun');
		return $query->result();
	}
	public function get_diterima($id_skpd){
		if($id_skpd!=''){
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->where('usulan_pensiun.status_usulan', 'terima');
		$this->db->join('pegawai','pegawai.id_pegawai = usulan_pensiun.id_pegawai');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('data_bkd','data_bkd.nip = pegawai.nip');
		$this->db->join('ref_alasan_pensiun','ref_alasan_pensiun.id_alasan_pensiun = usulan_pensiun.id_alasan_pensiun');
		$query = $this->db->get('usulan_pensiun');
		return $query->result();
	}
	public function get_by_id($id_usulan){
		$this->db->where('id_usulan',$id_usulan);
		$this->db->join('pegawai','pegawai.id_pegawai = usulan_pensiun.id_pegawai');
		$this->db->join('ref_skpd','ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan','ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('data_bkd','data_bkd.nip = pegawai.nip');
		$this->db->join('ref_alasan_pensiun','ref_alasan_pensiun.id_alasan_pensiun = usulan_pensiun.id_alasan_pensiun');
		$query = $this->db->get('usulan_pensiun');
		return $query->row();
	}

	public function get_by_id_skpd($id_skpd){
		if($id_skpd!=''&&$id_skpd!=0){
			$this->db->where('pegawai.id_skpd',$id_skpd);
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
	public function insert($data){
		return $this->db->insert('usulan_pensiun',$data);
	}
	public function update($data,$id_usulan){
		return $this->db->update('usulan_pensiun',$data,array('id_usulan'=>$id_usulan));
	}
	public function delete($id_usulan){
		$this->db->delete('usulan_pensiun',array('id_usulan'=>$id_usulan));
	}

	public function insert_berkas($data){
		return $this->db->insert('berkas_usulan_pensiun',$data);
	}
	public function get_berkas($id_usulan,$id_persyaratan){
		$this->db->join('ref_persyaratan_pensiun','ref_persyaratan_pensiun.id_persyaratan_pensiun = berkas_usulan_pensiun.id_persyaratan_pensiun');
		return $this->db->get_where('berkas_usulan_pensiun',array('id_usulan'=>$id_usulan,'berkas_usulan_pensiun.id_persyaratan_pensiun'=>$id_persyaratan))->row();
	}

}
