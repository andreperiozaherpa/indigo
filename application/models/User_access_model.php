<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_access_model extends CI_Model
{
	public $access_id;
	public $access_parent;
	public $access_level;
	public $access_name;

	public $alamat;

	public $telp;
	public $email;
	public $access_status;
	public $ket_induk;

	public function get_data_controller($name=null, $limit=0, $offset=0)
	{
		$this->db->where("access_parent", "0");
		$this->db->where("access_level", "1");
		if ($name) $this->db->where("access_name", strtolower($name));
		$this->db->order_by("access_id", "DESC");
		$this->db->limit($limit,$offset);
		$query = $this->db->get('user_access');
		return $query->result();
	}

	public function get_data_method($parent=null, $name=null)
	{
		if ($parent) $this->db->where("access_parent", $parent);
		$this->db->where("access_level", "2");
		if ($name) $this->db->where("access_name", strtolower($name));
		$this->db->order_by("access_id", "DESC");
		$query = $this->db->get('user_access');
		return $query->result();
	}

	public function get_data_by_id($id)
	{
		$this->db->where("access_id", $id);
		$query = $this->db->get('user_access');
		return $query->result();
	}

	public function get_data_by_name($parent, $name)
	{
		$this->db->where("access_parent", $parent);
		$this->db->where("access_name", strtolower($name));
		$query = $this->db->get('user_access');
		return $query->result();
	}

	public function check_access($parent, $name=null, $id=null)
	{
		$this->db->where("access_parent", $parent);
		if ($name) $this->db->where("access_name", url_title(strtolower($name), 'underscore'));
		if ($id) $this->db->where("access_id !=", $id);
		$query = $this->db->get('user_access');
		return $query->num_rows();
	}

	public function insert_access($data, $access=null)
	{
		if ($data) {
			if ($access == "controller") {
				$data['access_name'] = url_title(strtolower($data['access_name']), 'underscore');
				$data['access_parent'] = "0";
				$data['access_level'] = "1";
			} elseif ($access > 0) {
				$data['access_name'] = url_title(strtolower($data['access_name']), 'underscore');
				$data['access_parent'] = $access;
				$data['access_level'] = "2";
			}

			$query = $this->db->insert('user_access', $data);
			return true;
		}
	}

	public function update_access($data, $access_id=null)
	{
		if ($data AND $access_id > 0) {
			$data['access_name'] = url_title(strtolower($data['access_name']), 'underscore');
			$this->db->where("access_id", $access_id);
			$query = $this->db->update('user_access', $data);
			return true;
		}
	}

	public function update_status($data, $access_id=null)
	{
		if ($data AND $access_id > 0) {
			$this->db->where("access_id", $access_id);
			$query = $this->db->update('user_access', $data);

			$this->db->where("access_parent", $access_id);
			$query = $this->db->update('user_access', $data);
			return true;
		}
	}

	public function delete_access($access_id=null, $access_level=null)
	{
		if ($access_id > 0 AND $access_level > 0) {
			if ($access_level == "1") {
				$this->db->where("access_id", $access_id);
				$query = $this->db->delete('user_access');

				$this->db->where("access_parent", $access_id);
				$query2 = $this->db->delete('user_access');
			} elseif ($access_level == "2") {
				$this->db->where("access_id", $access_id);
				$query = $this->db->delete('user_access');
			}
			return true;
		}
	}

	public function auto_insert_access($data, $access=null)
	{
		if ($data) {
			$access_name = url_title(strtolower($data), 'underscore');
			$data = array();

			if ($access == "controller") {
				$data['access_parent'] = "0";
				$data['access_level'] = "1";

				$class_c['B'] = array('pengajuan', 'konfirmasi', 'front_office', 'back_office', 'survey_lapangan', 'draftsk', 'lampiransk', 'berkas', 'timteknis', 'rekomendasi', 'koordinator', 'kabid', 'kadis', 'tu', 'helpdesk'); //Back-End Apllication
				$class_c['F'] = array('manage_', ); //Front-End Apllication
				$class_c['J'] = array('rekap', 'laporan'); //Journal Report
				$class_c['I'] = array('ref_', ); //Index Reference
				$class_c['S'] = array('user', 'admin', 'dashboard', 'home', 'master_'); //System Setting

				foreach ($class_c as $class => $array_class) {
					foreach ($class_c[$class] as $find) {
						if (strpos($access_name, $find) !== false) {
						    $data['access_class'] = $class;
						}
					}
				}
			} elseif ($access) {
				$data['access_parent'] = $access[0]->access_id;
				$data['access_level'] = "2";
				$data['access_message'] = $access[0]->access_message;
				$data['access_redirect'] = $access[0]->access_name;

				$class_m['C'] = array('add', 'insert', 'create', 'tambah', 'register'); //Create
				$class_m['U'] = array('update', 'ubah', 'ganti', 'change', 'edit', 'berkas', 'verifikasi', 'perbaharui', 'perbarui', 'open', 'close', 'registrasi'); //Update
				$class_m['D'] = array('delete', 'hapus'); //Delete
				$class_m['A'] = array('upload', 'download', 'dekrip', 'enkrip', 'konversi', 'logout', 'login', 'email', 'tanda_tangan', 'unlink', 'index'); //Additional
				$class_m['R'] = array('view', 'lihat', 'get', 'form', 'list', 'detail', 'daftar', 'select', 'persyaratan', 'check', 'cek', 'print', 'cari', 'search', 'laporan', 'paging', 'last', 'cetak', 'surat'); //Read

				foreach ($class_m as $class => $array_class) {
					foreach ($class_m[$class] as $find) {
						if (strpos($access_name, $find) !== false) {
						    $data['access_class'] = $class;
						}
					}
				}
			}

			$data['access_name'] = $access_name;
			$data['access_status'] = "N"; // Accessible by Admin
			$data['access_login'] = "Y"; // Login as Admin

			if ($access_name == "error") {
				$data['access_status'] = "O";
				$data['access_login'] = "N";
				$data['access_class'] = "S";
			}

			$query = $this->db->insert('user_access', $data);
		}
	}
	
}
?>