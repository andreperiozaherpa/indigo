<?php
class Standar_kepatuhan_list_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}

	public function get_first()
	{
		$this->db->limit(1);
		$query = $this->db->get('standar_kepatuhan_list')->row();
		return $query;
	}

	public function get_by_id($id)
	{
		
		$this->db->where('id_standar_kepatuhan_list', $id);
		$query = $this->db->get('standar_kepatuhan_list')->row();
		return $query;
	}

	public function update_status_sklm($id, $status)
	{
		$this->db->where('id_standar_kepatuhan_list', $id);
		$query = $this->db->update('standar_kepatuhan_list', ['status' => $status]);
		return $query;
	}

	public function get_all_by_user($judul, $status, $id_user)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}
	public function get_by_user($mulai, $hal, $judul, $status, $id_user)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}

	public function get_all_standar_kepatuhan_list($judul, $status)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}
	public function get_all_by_skpd($judul, $status, $id_skpd)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$this->db->join('user', 'user.user_id = standar_kepatuhan_list.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		if ($id_skpd == 5) { //Dinkes
			$this->db->group_start();
			$this->db->where('ref_skpd.id_skpd', $id_skpd);
			$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
			$this->db->group_end();
		} else {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->select('standar_kepatuhan_list.*');
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}
	public function get_by_skpd($mulai, $hal, $judul, $status, $id_skpd)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$this->db->join('user', 'user.user_id = standar_kepatuhan_list.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
		if ($id_skpd == 5) { //Dinkes
			$this->db->group_start();
			$this->db->where('ref_skpd.id_skpd', $id_skpd);
			$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
			$this->db->group_end();
		} else {
			$this->db->where('pegawai.id_skpd', $id_skpd);
		}
		$this->db->select('standar_kepatuhan_list.*');
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}

	public function get_page_standar_kepatuhan_list($mulai, $hal, $judul, $status)
	{

		if ($judul != '') {
			$this->db->like('judul', $judul);
		}
		if ($status != '') {
			$this->db->where('created_at', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_standar_kepatuhan_list', 'desc');
		$query = $this->db->get('standar_kepatuhan_list')->result();
		return $query;
	}

	public function insert_standar_kepatuhan_list($data)
	{
		$this->db->insert('standar_kepatuhan_list', $data);
		return $this->db->insert_id();
	}

	public function get_respons_file_by_id($id_standar_kepatuhan_list)
	{
		$this->db->where('id_standar_kepatuhan_list_file', $id_standar_kepatuhan_list);
		$this->db->join('standar_kepatuhan_list', 'standar_kepatuhan_list.id_standar_kepatuhan_list = standar_kepatuhan_list_file.id_standar_kepatuhan_list_file');
		$q = $this->db->get('standar_kepatuhan_list_file');
		return $q->row();
	}

	public function get_respons_file_by_id_respons($id_standar_kepatuhan_list_respons)
	{
		$this->db->where('standar_kepatuhan_list_file.id_standar_kepatuhan_list_respon', $id_standar_kepatuhan_list_respons);
		$this->db->join('standar_kepatuhan_list_respons', 'standar_kepatuhan_list_respons.id_standar_kepatuhan_list_respons = standar_kepatuhan_list_file.id_standar_kepatuhan_list_respon');
		return $this->db->get('standar_kepatuhan_list_file')->row();
	}

	public function get_lampiran($id_standar_kepatuhan_list)
	{
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->where('id_standar_kepatuhan_list_respon', NULL);
		$q = $this->db->get('standar_kepatuhan_list_file');
		return $q->result();
	}
	public function update_standar_kepatuhan_list($data, $id_standar_kepatuhan_list)
	{
		$this->db->update('standar_kepatuhan_list', $data, array('id_standar_kepatuhan_list' => $id_standar_kepatuhan_list));
	}
	public function delete_standar_kepatuhan_list($id_standar_kepatuhan_list)
	{
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->delete('standar_kepatuhan_list');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->delete('standar_kepatuhan_list_file');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->delete('standar_kepatuhan_list_respons');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->delete('standar_kepatuhan_list_status_log');
	}
	public function insert_standar_kepatuhan_list_file($data)
	{
		$this->db->insert('standar_kepatuhan_list_file', $data);
	}

	public function close($id_standar_kepatuhan_list)
	{
		$data = array('status' => 'tutup');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->update('standar_kepatuhan_list', $data);
	}

	public function solved($id_standar_kepatuhan_list)
	{
		$data = array('status' => 'selesai');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->update('standar_kepatuhan_list', $data);
	}

	public function prosess($id_standar_kepatuhan_list)
	{
		$data = array('status' => 'sedang_diproses');
		$this->db->where('id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->update('standar_kepatuhan_list', $data);
	}

	public function get_respons($id_standar_kepatuhan_list)
	{
		$this->db->where('standar_kepatuhan_list_respons.id_standar_kepatuhan_list', $id_standar_kepatuhan_list);
		$this->db->join('user', 'user.user_id = standar_kepatuhan_list_respons.id_user');
		$this->db->join('user_level', 'user_level.level_id = user.user_level');
		return $this->db->get('standar_kepatuhan_list_respons')->result();
	}

	public function get_respons_file($id_standar_kepatuhan_list_respons)
	{
		$this->db->where('standar_kepatuhan_list_file.id_standar_kepatuhan_list_respon', $id_standar_kepatuhan_list_respons);
		return $this->db->get('standar_kepatuhan_list_file')->row_array();
	}

	public function respons($id_standar_kepatuhan_list, $id_user)
	{
		$data = array(
			'id_standar_kepatuhan_list' => $id_standar_kepatuhan_list,
			'tgl_respon' => date('Y-m-d'),
			'waktu_respon' => date('H:i:s'),
			'id_user' => $id_user,
			'isi' => $this->input->post('isi')
		);
		$this->db->insert('standar_kepatuhan_list_respons', $data);
		$id_standar_kepatuhan_list_respons = $this->db->insert_id();

		if (!empty($_FILES['file_respons']['name'])) {
			$data_file = array(
				'id_standar_kepatuhan_list' => $id_standar_kepatuhan_list,
				'id_standar_kepatuhan_list_respon' => $id_standar_kepatuhan_list_respons
			);
			if (!empty($_FILES['file_respons']['name'])) {
				$this->_deleteFile($id_standar_kepatuhan_list);
				$data_file['file'] = $this->_uploadFile($id_standar_kepatuhan_list);
				if ($data_file['file'] != "default") {
					$this->db->insert('standar_kepatuhan_list_file', $data_file);
				}
			} else {
				$data_file['file'] = $this->input->post('file_lama');
			}
		}
	}

	public function deleteRespons($id_standar_kepatuhan_list_respons, $id_standar_kepatuhan_list)
	{
		$this->_deleteResponsFile($id_standar_kepatuhan_list_respons, $id_standar_kepatuhan_list);
		$this->db->where('id_standar_kepatuhan_list_respons', $id_standar_kepatuhan_list_respons);
		$this->db->delete('standar_kepatuhan_list_respons');
		$this->db->where('id_standar_kepatuhan_list_respon', $id_standar_kepatuhan_list_respons);
		$this->db->delete('standar_kepatuhan_list_file');
	}

	private function _uploadFile($id_standar_kepatuhan_list)
	{

		if (empty(mkdir("./data/standar_kepatuhan_list/respons/$id_standar_kepatuhan_list"))) {
			mkdir("./data/standar_kepatuhan_list/respons/$id_standar_kepatuhan_list");
		}

		$config = array(
			'upload_path' => "./data/standar_kepatuhan_list/respons/$id_standar_kepatuhan_list/",
			'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "2000",
			// 'max_width' => "2000"
		);

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file_respons')) {
			$data = array('file_respons' => $this->upload->data());
			return $this->upload->data('file_name');
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			return "default";
		}
	}

	private function _deleteFile($id_standar_kepatuhan_list)
	{

		$data = $this->get_respons_file_by_id($id_standar_kepatuhan_list);
		if ($data->file != "default") {
			$filename = explode(".", $data->file)[0];
			return array_map('unlink', glob(FCPATH . "data/standar_kepatuhan_list/respons/$id_standar_kepatuhan_list/$filename.*"));
		}
	}

	private function _deleteResponsFile($id_standar_kepatuhan_list_respons, $id_standar_kepatuhan_list)
	{

		$data = $this->get_respons_file_by_id_respons($id_standar_kepatuhan_list_respons);
		if ($data->file != "default") {
			$filename = explode(".", $data->file)[0];
			return array_map('unlink', glob(FCPATH . "data/standar_kepatuhan_list/respons/$id_standar_kepatuhan_list/$filename.*"));
		}
	}
}
