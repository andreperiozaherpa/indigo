<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prediksi_pensiun_model extends CI_Model
{

	public function get_count()
	{
		if ($this->session->userdata('level') != 'Administrator') {
			$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->join('data_bkd','data_bkd.nip = pegawai.nip','left');
		return $this->db->get('pegawai')->num_rows();
	}

	public function get_all()
	{
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->join('data_bkd','data_bkd.nip = pegawai.nip','left');
		$query = $this->db->get('pegawai')->result();
		return $query;
	}
	public function get_page($mulai, $hal, $nama, $skpd, $tahun, $bulan)
	{
		if ($this->session->userdata('level') != 'Administrator') {
			$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
		}
		if ($nama != '') {
			$this->db->like('pegawai.nama_lengkap', $nama);
		}
		if ($skpd != '') {
			$this->db->where('pegawai.id_skpd', $skpd);
		}
		if ($tahun != '') {
			$tahun_clause = "YEAR(DATE_SUB(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') YEAR), INTERVAL 1 MONTH)
			), 
			INTERVAL DAY(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') YEAR), INTERVAL 1 MONTH)
			)
			)-1 DAY
		))";
			$this->db->where($tahun_clause . " = ", $tahun, false);
		}
		if ($bulan != '') {
			$bulan_clause = "MONTH(DATE_SUB(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') YEAR), INTERVAL 1 MONTH)
			), 
			INTERVAL DAY(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') YEAR), INTERVAL 1 MONTH)
			)
			)-1 DAY
		))";
			$this->db->where($bulan_clause . " = ", $bulan, false);
		}

		if ($nama == '' && $skpd == '' && $tahun == '') {
			$this->db->limit($hal, $mulai);
		}

		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->join('data_bkd', 'data_bkd.nip = pegawai.nip', 'left');
		$this->db->select("*, 
			@masa_pensiun:=IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') as masa_pensiun
			");
		$this->db->select('@prediksi_pensiun:=DATE_SUB(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			), 
			INTERVAL DAY(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			)
			)-1 DAY
		) as prediksi_pensiun', false);
		$this->db->select('@tahun_pensiun:=YEAR(@prediksi_pensiun) as tahun_pensiun', false);
		$query = $this->db->get('pegawai')->result();
		return $query;
	}
	public function get_by_id($id_pegawai)
	{
		$this->db->where('pegawai.id_pegawai', $id_pegawai);
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->join('data_bkd', 'data_bkd.nip = pegawai.nip');
		$this->db->select("*, 
			@masa_pensiun:=IF((SUBSTR(pegawai.eselon,1,'2')='II') OR (ref_jabatan_baru.jenis_jabatan='Fungsional' AND INSTR(ref_jabatan_baru.nama_jabatan,'Madya')>0),'60','58') as masa_pensiun
			");
		$this->db->select('@prediksi_pensiun:=DATE_SUB(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			), 
			INTERVAL DAY(
			LAST_DAY(
			DATE_ADD(DATE_ADD(pegawai.tanggal_lahir, INTERVAL @masa_pensiun YEAR), INTERVAL 1 MONTH)
			)
			)-1 DAY
		) as prediksi_pensiun', false);
		$this->db->select('@tahun_pensiun:=YEAR(@prediksi_pensiun) as tahun_pensiun', false);
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function get_by_id_skpd($id_skpd)
	{
		if ($id_skpd != '' && $id_skpd != 0) {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap', 'ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_jml_by_id_skpd($id_skpd)
	{
		if ($id_skpd != '' && $id_skpd != 0) {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap', 'ASC');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}
	public function insert($data)
	{
		$this->db->insert('usulan_pensiun', $data);
		return $this->db->insert_id();
	}
	public function update($data, $id_pegawai)
	{
		return $this->db->update('pegawai', $data, array('id_pegawai' => $id_pegawai));
	}
	public function delete($id_pegawai)
	{
		$this->db->delete('pegawai', array('id_pegawai' => $id_pegawai));
	}

}