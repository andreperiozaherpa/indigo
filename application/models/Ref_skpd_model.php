<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_skpd_model extends CI_Model
{

	public function get_all($jenis_skpd = '', $user = false, $id_skpd_induk = '')
	{
		if (isset($_GET['id_unit'])) {
			if ($_GET['id_unit'] == 4) {
				$this->db->group_start();
				$this->db->where('id_skpd', $_GET['id_unit']);
				$this->db->or_where('jenis_skpd', 'sekolah');
				$this->db->group_end();
			} else {
				$this->db->where('id_skpd', $_GET['id_unit']);
			}
		}
		if ($jenis_skpd != '') {
			$this->db->where_in('jenis_skpd', $jenis_skpd);
		}
		if ($id_skpd_induk != '') {
			$this->db->group_start();
			$this->db->where('id_skpd_induk', $id_skpd_induk);
			$this->db->or_where('id_skpd', $this->session->userdata('id_skpd'));
			$this->db->group_end();
		} else {
			if ($user == true && $this->session->userdata('level') == 'User') {
				$this->db->where('id_skpd', $this->session->userdata('id_skpd'));
			}
		}
		$query = $this->db->get('ref_skpd');
		return $query->result();
	}

	public function get_unit_kerja_by_skpd_level($id_skpd, $level_unit_kerja)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('level_unit_kerja', $level_unit_kerja);
		$this->db->order_by('nama_unit_kerja', 'ASC');
		$r = $this->db->get('ref_unit_kerja')->result();
		foreach ($r as $k => $x) {
			if ($x->nama_unit_kerja == 'Sekretaris') {
				unset($r[$k]);
			}
		}
		return $r;
	}
	public function get_unit_kerja_by_skpd_level_array($id_skpd, $level_unit_kerja)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('level_unit_kerja', $level_unit_kerja);
		$this->db->order_by('nama_unit_kerja', 'ASC');
		$r = $this->db->get('ref_unit_kerja')->result_array();
		foreach ($r as $k => $x) {
			if ($x['nama_unit_kerja'] == 'Sekretaris') {
				unset($r[$k]);
			}
		}
		return $r;
	}
	public function get_page($mulai, $hal, $filter = '', $jenis_skpd = '', $all = false)
	{
		if (!$all) {
			if ($this->session->userdata('level') == 'User') {
				$this->db->where('id_skpd', $this->session->userdata('id_skpd'));
			}
		}
		if ($jenis_skpd != '') {
			$this->db->where('jenis_skpd', $jenis_skpd);
		}
		// $this->db->offsett(0,6);
		if ($filter != '') {
			foreach ($filter as $key => $value) {
				$this->db->like($key, $value);
			}
		} else {
			$this->db->limit($hal, $mulai);
		}
		$query = $this->db->get('ref_skpd');
		return $query->result();
	}
	public function get_by_id($id_skpd)
	{
		$this->db->where('ref_skpd.id_skpd', $id_skpd);
		$this->db->join('ref_skpd as induk', 'induk.id_skpd = ref_skpd.id_skpd_induk', 'left');
		$this->db->select('ref_skpd.*, induk.nama_skpd as nama_skpd_induk');
		$query = $this->db->get('ref_skpd');
		return $query->row();
	}
	public function get_by_jenis($jenis)
	{
		$this->db->where('jenis_skpd', $jenis);
		$query = $this->db->get('ref_skpd');
		return $query->result();
	}
	public function get_multiple_jenis($list_jenis)
	{
		foreach ($list_jenis as $k => $j) {
			if ($k == 0) {
				$this->db->where('jenis_skpd', $j);
			} else {
				$this->db->or_where('jenis_skpd', $j);
			}
		}
		$query = $this->db->get('ref_skpd');
		$list = $query->result();
		foreach ($list as $k => $l) {
			if ($l->id_skpd == 64 || $l->id_skpd == 72) {
				unset($list[$k]);
			}
		}
		return $list;
	}
	public function insert($data)
	{
		return $this->db->insert('ref_skpd', $data);
	}
	public function update($data, $id_skpd)
	{
		return $this->db->update('ref_skpd', $data, array('id_skpd' => $id_skpd));
	}
	public function delete($id_skpd)
	{
		$this->db->delete('ref_skpd', array('id_skpd' => $id_skpd));
		$this->db->delete('ref_unit_kerja', array('id_skpd' => $id_skpd));
	}
	public function delete_unit_kerja($id_unit_kerja)
	{
		$this->db->delete('ref_unit_kerja', array('id_unit_kerja' => $id_unit_kerja));
		$this->db->delete('ref_unit_kerja', array('id_induk' => $id_unit_kerja));
	}

	public function insert_unit_kerja($data, $id_skpd)
	{
		$this->db->set('id_skpd', $id_skpd);
		return $this->db->insert('ref_unit_kerja', $data);
	}

	public function update_unit_kerja($data, $id_unit_kerja)
	{
		unset($data['id_unit_kerja']);
		return $this->db->update('ref_unit_kerja', $data, array('id_unit_kerja' => $id_unit_kerja));
	}

	public function get_unit_kerja_by_id($id_unit_kerja)
	{
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = ref_unit_kerja.id_skpd');
		$q = $this->db->get('ref_unit_kerja');
		return $q->row();
	}

	public function get_unit_kerja_by_level($id_skpd, $level)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('level_unit_kerja', $level);
		$q = $this->db->get('ref_unit_kerja');
		return $q->result();
	}

	public function get_unit_kerja_by_id_induk($id_skpd, $id_induk)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('id_induk', $id_induk);
		$q = $this->db->get('ref_unit_kerja');
		return $q->result();
	}

	public function get_skpd_except_this_id_skpd($id_skpd)
	{
		$this->db->where('id_skpd !=', $id_skpd);
		$this->db->order_by('nama_skpd', 'ASC');
		$q = $this->db->get('ref_skpd');
		return $q->result();
	}

	public function get_all_unit_kerja_by_id_skpd($id_skpd)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->order_by('nama_unit_kerja', 'ASC');
		$r = $this->db->get('ref_unit_kerja');
		return $r->result();
	}
	public function get_unit_kerja_by_id_skpd($id_skpd)
	{
		// GET KEPALA SKPD
		$this->db->where('id_unit_kerja', '0');
		$results1 = $this->db->get('ref_unit_kerja');

		$this->db->where('id_skpd', $id_skpd);
		$this->db->order_by('nama_unit_kerja', 'ASC');
		$results2 = $this->db->get('ref_unit_kerja');

		$results = array();

		if ($results1->num_rows()) {
			$results = array_merge($results, $results1->result());
		}

		if ($results2->num_rows()) {
			$results = array_merge($results, $results2->result());
		}

		return $results;
	}


	public function get_pegawai_by_id_unit_kerja($id_unit_kerja, $id_skpd)
	{
		$this->db->select('*, pegawai.id_pegawai as id_pegawai');
		$this->db->where('pegawai.id_unit_kerja', $id_unit_kerja);
		if ($id_unit_kerja == "0") {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->order_by('pegawai.jenis_pegawai', 'ASC');
		$this->db->order_by('pegawai.nama_lengkap', 'ASC');
		$this->db->join('ref_jabatan_baru', 'pegawai.id_jabatan = ref_jabatan_baru.id_jabatan', 'left');
		$q = $this->db->get('pegawai');
		return $q->result();
	}

	public function get_count_pegawai_by_id_skpd($id_skpd)
	{
		return $this->db->get_where('pegawai', array('id_skpd' => $id_skpd))->num_rows();
	}

	public function get_kepala_skpd($id_skpd)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('jenis_pegawai', 'kepala');
		$this->db->where('kepala_skpd', 'Y');
		$q = $this->db->get('pegawai')->row();
		if (empty($q)) {
			$q = array('nama_lengkap' => 'Data belum tersedia');
			$q = (object) $q;
		}
		return $q;
	}
	public function get_all_kepala_skpd($id_skpd)
	{
		$this->db->where('id_skpd', $id_skpd);
		$this->db->where('kepala_skpd', 'Y');
		$q = $this->db->get('pegawai')->result();
		return $q;
	}

	public function get_kepala_unit_kerja($id_unit_kerja)
	{
		$this->db->where('pegawai.id_unit_kerja', $id_unit_kerja);
		$this->db->where('jenis_pegawai', 'kepala');
		// $this->db->join('ref_jabatan_baru','ref_jabatan_baru.id_jabatan = pegawai.id_jabatan');
		$q = $this->db->get('pegawai')->row();
		if (empty($q)) {
			$q = array('nama_lengkap' => 'Data belum tersedia', 'nama_jabatan' => 'Data belum tersedia');
			$q = (object) $q;
		}
		return $q;
	}

	public function get_staff_unit_kerja($id_unit_kerja)
	{
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$this->db->where('jenis_pegawai', 'staff');
		$q = $this->db->get('pegawai');
		return $q->result();
	}

	public function delete_jabatan($id_jabatan)
	{
		$this->db->delete('ref_jabatan_baru', array('id_jabatan' => $id_jabatan));
	}

	public function insert_jabatan($data, $id_skpd)
	{
		$this->db->set('id_skpd', $id_skpd);
		return $this->db->insert('ref_jabatan_baru', $data);
	}

	public function update_jabatan($data, $id_jabatan)
	{
		unset($data['id_jabatan']);
		unset($data['level_unit_kerja']);
		return $this->db->update('ref_jabatan_baru', $data, array('id_jabatan' => $id_jabatan));
	}
	public function get_jabatan_by_id($id_jabatan)
	{
		$this->db->where('id_jabatan', $id_jabatan);
		$q = $this->db->get('ref_jabatan_baru');
		return $q->row();
	}

	public function get_jabatan_by_id_skpd($id_skpd)
	{
		$this->db->where('ref_jabatan_baru.id_skpd', $id_skpd);
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = ref_jabatan_baru.id_unit_kerja');
		$q = $this->db->get('ref_jabatan_baru');
		return $q->result();
	}

	public function get_jabatan_by_unit_kerja($id_unit_kerja)
	{
		$this->db->where('id_unit_kerja', $id_unit_kerja);
		$q = $this->db->get('ref_jabatan_baru');
		return $q->result();
	}

	public function get_perencanaan_by_id_skpd($id_skpd)
	{
		// $this->db->select("iku_sasaran_rpjmd.id_iku_sasaran_rpjmd, iku_sasaran_rpjmd.iku_sasaran_rpjmd, sasaran_rpjmd.id_sasaran_rpjmd, sasaran_rpjmd.sasaran_rpjmd, tujuan.id_tujuan, tujuan.tujuan, misi.id_misi, misi.misi, visi.id_visi, visi.visi");
		$this->db->where('iku_sasaran_rpjmd.id_skpd', $id_skpd);
		$this->db->join('sasaran_rpjmd', 'sasaran_rpjmd.id_sasaran_rpjmd = iku_sasaran_rpjmd.id_sasaran_rpjmd');
		$this->db->join('tujuan', 'tujuan.id_tujuan = sasaran_rpjmd.id_tujuan');
		$this->db->join('misi', 'misi.id_misi = tujuan.id_misi');
		$this->db->join('visi', 'visi.id_visi = misi.id_visi');
		$query = $this->db->get('iku_sasaran_rpjmd');
		return $query->result_array();
	}

	public function is_induk($id_skpd)
	{
		$get = $this->db->get_where('ref_skpd', array('id_skpd_induk' => $id_skpd))->num_rows();
		if ($get > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function insert_sub($data, $id_skpd)
	{
		$this->db->set('id_skpd', $id_skpd);
		return $this->db->insert('ref_skpd_sub', $data);
	}

	public function update_sub($data, $id_ref_skpd_sub)
	{
		unset($data['id_ref_skpd_sub']);
		return $this->db->update('ref_skpd_sub', $data, array('id_ref_skpd_sub' => $id_ref_skpd_sub));
	}
	public function get_skpd_sub($id_skpd)
	{
		return $this->db->get_where('ref_skpd_sub', array('id_skpd' => $id_skpd))->result();
	}
	public function get_sub_by_id($id_ref_skpd_sub)
	{
		return $this->db->get_where('ref_skpd_sub', array('id_ref_skpd_sub' => $id_ref_skpd_sub))->row();
	}

	public function delete_sub($id_ref_skpd_sub)
	{
		$this->db->delete('ref_skpd_sub', array('id_ref_skpd_sub' => $id_ref_skpd_sub));
	}

	public function get($param)
	{
		if (isset($param['where'])) {
			$this->db->where($param['where']);
		}

		if (isset($param['search'])) {
			$this->db->where("(
				skpd.nama_skpd like '%" . $param['search'] . "%' 
			)");
		}

		if (isset($param['limit']) && isset($param['offset'])) {
			$this->db->limit($param['limit'], $param['offset']);
		}

		$rs = $this->db->get("ref_skpd skpd");
		return $rs;
	}

	public function get_by_name($nama)
	{
		$this->db->like('nama_skpd', $nama, 'both');
		$this->db->limit(1);
		return $this->db->get('ref_skpd')->row();
	}

}