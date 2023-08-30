
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_pegawai_model extends CI_Model
{

	public function get_all($pensiun = false)
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->session->userdata('level') != 'Administrator' && in_array('op_kepegawaian', $user_privileges) == false) {
			if ($this->session->userdata('level') == 'Operator') {
				$this->db->where('pegawai.id_skpd', $this->session->userdata('kd_skpd'));
			} else {
				if ($this->session->userdata('id_skpd') == 5) { //Dinas Kesehatan
					$this->db->group_start();
					$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
					$this->db->or_where('ref_skpd.id_skpd_induk', $this->session->userdata('id_skpd'));
					$this->db->group_end();
				} else {
					$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
				}
			}
		}
		if ($pensiun == false) {
			$this->db->where('pensiun', 0);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_page_dewan($mulai, $hal, $nama, $nip, $skpd, $where = '', $pensiun = false)
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($nama != '') {
			$this->db->like('nama_lengkap', $nama);
		}
		if ($nip != '') {
			$this->db->where('nip', $nip);
		}
		if ($skpd != '') {
			$this->db->where('pegawai.id_skpd', 231);
		} else {
			$this->db->limit($hal, $mulai);
		}
		if ($where !== '') {
			$this->db->where($where);
		}
		if ($pensiun == false) {
			$this->db->where('pensiun', 0);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_page($mulai, $hal, $nama, $nip, $skpd, $where = '', $pensiun = false)
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->session->userdata('level') != 'Administrator' && in_array('op_kepegawaian', $user_privileges) == false) {
			if ($this->session->userdata('level') == 'Operator') {
				$this->db->where('pegawai.id_skpd', $this->session->userdata('kd_skpd'));
			} else {
				if ($this->session->userdata('id_skpd') == 5) { //DINKES
					$this->db->group_start();
					$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
					$this->db->or_where('ref_skpd.id_skpd_induk', $this->session->userdata('id_skpd'));
					$this->db->group_end();
				} else {
					$this->db->where('pegawai.id_skpd', $this->session->userdata('id_skpd'));
				}
			}
		}
		if ($nama != '') {
			$this->db->like('nama_lengkap', $nama);
		}
		if ($nip != '') {
			$this->db->where('nip', $nip);
		}
		if ($skpd != '') {
			$this->db->where('pegawai.id_skpd', $skpd);
		} else {
			$this->db->limit($hal, $mulai);
		}
		if ($where !== '') {
			$this->db->where($where);
		}
		if ($pensiun == false) {
			$this->db->where('pensiun', 0);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$query = $this->db->get('pegawai');
		return $query->result();
	}
	public function get_by_id($id_pegawai)
	{
		$this->db->where('pegawai.id_pegawai', $id_pegawai);
		$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->select('pegawai.*,ref_skpd.nama_skpd,ref_unit_kerja.nama_unit_kerja,user.user_id, user.employee_id, user.instansi_id, user.unit_kerja_id, user.kd_skpd, user.id_ketersediaan, user.username, user.password, user.full_name, user.email, user.phone, user.bio, user.certificate, user.dot_key, user.pass_key, user.scan_ttd, user.user_picture, user.user_level, user.user_group_menu, user.user_privileges, user.reg_date, user.user_status, user.api_key, user.app_token');
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function search($search)
	{
		$this->db->group_start();
		$this->db->like('nip', $search);
		$this->db->or_like('nama_lengkap', $search);
		$this->db->or_like('jabatan', $search);
		$this->db->group_end();
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_by_jabatan($jabatan)
	{
		$this->db->group_start();
		$this->db->or_where('pegawai.jabatan', $jabatan);
		$this->db->or_where('pegawai.jabatan', 'Plt. '.$jabatan);
		$this->db->group_end();
		$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->select('pegawai.*,ref_skpd.nama_skpd,ref_unit_kerja.nama_unit_kerja,user.user_id, user.employee_id, user.instansi_id, user.unit_kerja_id, user.kd_skpd, user.id_ketersediaan, user.username, user.password, user.full_name, user.email, user.phone, user.bio, user.certificate, user.dot_key, user.pass_key, user.scan_ttd, user.user_picture, user.user_level, user.user_group_menu, user.user_privileges, user.reg_date, user.user_status, user.api_key, user.app_token');
		$query = $this->db->get('pegawai');
		return $query->row();
	}

	public function get_by_id_user($id_user)
	{
		$this->db->where('user_id', $id_user);
		$query = $this->db->get('user');
		return $query->row();
	}

	public function get_kepala_skpd($registered = false)
	{
		if ($registered == true) {
			$this->db->where('id_user !=', 0);
		}
		$this->db->where('pegawai.kepala_skpd', 'Y');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap', 'ASC');
		$query = $this->db->get('pegawai');
		return $query->result();
	}

	public function get_pegawai_kepala_skpd($id_skpd)
	{
		$this->db->where("pegawai.id_skpd", $id_skpd);
		$this->db->where("pegawai.kepala_skpd", "Y");
		$this->db->where("pegawai.pensiun !=", "1");
		$rs = $this->db->get("pegawai")->row();
		return $rs;
	}

	public function get_by_id_skpd($id_skpd, $registered = false, $fix_primary = false, $include_uptd = true, $bulan = '', $tahun = '')
	{
		if ($bulan == 8 && $tahun == 2021) {
			if ($id_skpd != '' && $id_skpd != 0) {
				if ($this->session->userdata('id_skpd') == 5 && $include_uptd) { //DINKES
					$this->db->group_start();
					$this->db->where('pegawai.id_skpd', $id_skpd);
					$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
					$this->db->group_end();
				} else {
					$this->db->having('id_skpd_pencairan', $id_skpd);
				}
			} else {
				$this->db->where('pegawai.id_skpd', 34);
			}
			$this->db->where('pensiun', 0);
			$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
			$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
			$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');

			$this->db->join('ref_jabatan_baru as sekarang', 'sekarang.id_jabatan = pegawai.id_jabatan', 'left');
			$this->db->join('ref_jabatan_baru as lama', 'lama.id_jabatan = pegawai.id_jabatan_lama', 'left');
			// $this->db->order_by('pegawai.id_jabatan','ASC');
			$this->db->order_by('nama_lengkap', 'ASC');
			$this->db->select('pegawai.*,
		IF(lama.id_jabatan IS NULL, sekarang.id_jabatan, lama.id_jabatan) as id_jabatan_pencairan,
	  IF(lama.id_jabatan IS NULL, sekarang.nama_jabatan, lama.nama_jabatan) as nama_jabatan_pencairan,
	  IF(lama.id_jabatan IS NULL, sekarang.id_skpd, lama.id_skpd) as id_skpd_pencairan');
			$query = $this->db->get('pegawai');

			$res = $query->result();
			foreach($res as $k => $v){
				$res[$k]->jabatan = $v->nama_jabatan_pencairan;
			}
			return $res;
		} else {

			// if($id_skpd==16){
			// $this->db->like('nama_lengkap','ARIEF SYAM');
			// }
			// if($this->session->userdata('level')=='Administrator'){
			// $this->db->limit(50);
			// }
			if ($id_skpd != '' && $id_skpd != 0) {
// fixing by Arif. 12 Mei 2023. 
//				if ($this->session->userdata('id_skpd') == 5 && $include_uptd) { //DINKES
					$this->db->group_start();
					$this->db->where('pegawai.id_skpd', $id_skpd);
					$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
					$this->db->group_end();
//				} else {
//					$this->db->where('pegawai.id_skpd', $id_skpd);
//				}
// end of fixing
			} else {
				$this->db->where('pegawai.id_skpd', 34);
			}
			if ($registered == true) {
				$this->db->where('id_user !=', 0);
			}
			if ($fix_primary == true) {
				$this->db->or_where('pegawai.id_skpd', 33);
				$this->db->or_where('pegawai.id_pegawai', 77);
			}
			$this->db->where('pensiun', 0);
			$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
			$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan', 'left');
			$this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai', 'left');

			// $this->db->order_by('pegawai.id_jabatan','ASC');
			$this->db->order_by('nama_lengkap', 'ASC');
			$query = $this->db->get('pegawai');

			return $query->result();
		}
	}

	public function get_jml_by_id_skpd($id_skpd = '')
	{

		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($id_skpd != '' && $id_skpd != 0 && in_array('op_kepegawaian', $user_privileges) == false) {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan', 'left');
		// $this->db->order_by('pegawai.id_jabatan','ASC');
		$this->db->order_by('nama_lengkap', 'ASC');
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}

	public function get_registered_by_id_skpd($id_skpd = '')
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if (in_array('op_kepegawaian', $user_privileges) == false) {
			$this->db->where('id_skpd', $id_skpd);
		}
		$this->db->where('id_user !=', 0);
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}

	public function get_not_registered_by_id_skpd($id_skpd = '')
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if (in_array('op_kepegawaian', $user_privileges) == false) {
			$this->db->where('id_skpd', $id_skpd);
		}
		$this->db->where('id_user', 0);
		$query = $this->db->get('pegawai');
		return $query->num_rows();
	}

	public function insert($data)
	{
		return $this->db->insert('pegawai', $data);
	}
	public function update($data, $id_pegawai)
	{
		$up = $this->db->update('pegawai', $data, array('id_pegawai' => $id_pegawai));
		if($up){
			$data_update = [];
			if (isset($data['id_unit_kerja'])) {
				$data_update['unit_kerja_id'] = $data['id_unit_kerja'];
			}
			if (isset($data['id_skpd'])) {
				$data_update['kd_skpd'] = $data['id_skpd'];
			}
			if (isset($data['nama_lengkap'])) {
				$data_update['full_name'] = $data['nama_lengkap'];
			}
			if(!empty($data_update)){
				$this->db->update('user',$data_update,array('id_pegawai'=>$id_pegawai));
			}
			return true;
		}else{
			return false;
		}
		
	}
	public function delete($id_pegawai)
	{
		$this->db->delete('pegawai', array('id_pegawai' => $id_pegawai));
	}

	public function ceknip($nip)
	{
		$this->db->where('nip', $nip);
		return ($this->db->get('pegawai')->num_rows() > 0) ? true : false;
	}

	public function get_by_name_jabatan($params)
	{
		$this->db->like('jabatan', $params);
		return $this->db->get('pegawai')->result_array();
	}
}
