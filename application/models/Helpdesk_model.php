<?php
class Helpdesk_model extends CI_Model
{
	public function get_all()
	{
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}

	public function get_all_by_user($subjek, $status, $id_user)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->order_by('id_helpdesk', 'desc');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}
	public function get_by_user($mulai, $hal, $subjek, $status, $id_user)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_helpdesk', 'desc');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}

	public function get_all_helpdesk($subjek, $status)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->order_by('id_helpdesk', 'desc');
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}
	public function get_all_by_skpd($subjek, $status, $id_skpd)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->order_by('id_helpdesk', 'desc');
		$this->db->join('user', 'user.user_id = helpdesk.id_user');
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
		$this->db->select('helpdesk.*');
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}
	public function get_by_skpd($mulai, $hal, $subjek, $status, $id_skpd)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_helpdesk', 'desc');
		$this->db->join('user', 'user.user_id = helpdesk.id_user');
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
		$this->db->select('helpdesk.*');
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}

	public function get_page_helpdesk($mulai, $hal, $subjek, $status)
	{

		if ($subjek != '') {
			$this->db->like('subjek', $subjek);
		}
		if ($status != '') {
			$this->db->where('status', $status);
		}

		$this->db->limit($hal, $mulai);
		$this->db->order_by('id_helpdesk', 'desc');
		$query = $this->db->get('helpdesk')->result();
		return $query;
	}

	public function insert_helpdesk($data)
	{
		$this->db->insert('helpdesk', $data);
		return $this->db->insert_id();
	}
	public function get_by_id($id_helpdesk)
	{
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->join('user', 'user.user_id = helpdesk.id_user');
		$q = $this->db->get('helpdesk');
		return $q->row();
	}

	public function get_respons_file_by_id($id_helpdesk)
	{
		$this->db->where('id_helpdesk_file', $id_helpdesk);
		$this->db->join('helpdesk', 'helpdesk.id_helpdesk = helpdesk_file.id_helpdesk_file');
		$q = $this->db->get('helpdesk_file');
		return $q->row();
	}

	public function get_respons_file_by_id_respons($id_helpdesk_respons)
	{
		$this->db->where('helpdesk_file.id_helpdesk_respon', $id_helpdesk_respons);
		$this->db->join('helpdesk_respons', 'helpdesk_respons.id_helpdesk_respons = helpdesk_file.id_helpdesk_respon');
		return $this->db->get('helpdesk_file')->row();
	}

	public function get_lampiran($id_helpdesk)
	{
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->where('id_helpdesk_respon', NULL);
		$q = $this->db->get('helpdesk_file');
		return $q->result();
	}
	public function update_helpdesk($data, $id_helpdesk)
	{
		$this->db->update('helpdesk', $data, array('id_helpdesk' => $id_helpdesk));
	}
	public function delete_helpdesk($id_helpdesk)
	{
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->delete('helpdesk');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->delete('helpdesk_file');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->delete('helpdesk_respons');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->delete('helpdesk_status_log');
	}
	public function insert_helpdesk_file($data)
	{
		$this->db->insert('helpdesk_file', $data);
	}

	public function close($id_helpdesk)
	{
		$data = array('status' => 'tutup');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->update('helpdesk', $data);
	}

	public function solved($id_helpdesk)
	{
		$data = array('status' => 'selesai');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->update('helpdesk', $data);
	}

	public function prosess($id_helpdesk)
	{
		$data = array('status' => 'sedang_diproses');
		$this->db->where('id_helpdesk', $id_helpdesk);
		$this->db->update('helpdesk', $data);
	}

	public function get_respons($id_helpdesk)
	{
		$this->db->where('helpdesk_respons.id_helpdesk', $id_helpdesk);
		$this->db->join('user', 'user.user_id = helpdesk_respons.id_user');
		$this->db->join('user_level', 'user_level.level_id = user.user_level');
		return $this->db->get('helpdesk_respons')->result();
	}

	public function get_respons_file($id_helpdesk_respons)
	{
		$this->db->where('helpdesk_file.id_helpdesk_respon', $id_helpdesk_respons);
		return $this->db->get('helpdesk_file')->row_array();
	}

	public function respons($id_helpdesk, $id_user)
	{
		$data = array(
			'id_helpdesk' => $id_helpdesk,
			'tgl_respon' => date('Y-m-d'),
			'waktu_respon' => date('H:i:s'),
			'id_user' => $id_user,
			'isi' => $this->input->post('isi')
		);
		$this->db->insert('helpdesk_respons', $data);
		$id_helpdesk_respons = $this->db->insert_id();

		if (!empty($_FILES['file_respons']['name'])) {
			$data_file = array(
				'id_helpdesk' => $id_helpdesk,
				'id_helpdesk_respon' => $id_helpdesk_respons
			);
			if (!empty($_FILES['file_respons']['name'])) {
				$this->_deleteFile($id_helpdesk);
				$data_file['file'] = $this->_uploadFile($id_helpdesk);
				if ($data_file['file'] != "default") {
					$this->db->insert('helpdesk_file', $data_file);
				}
			} else {
				$data_file['file'] = $this->input->post('file_lama');
			}
		}
	}

	public function deleteRespons($id_helpdesk_respons, $id_helpdesk)
	{
		$this->_deleteResponsFile($id_helpdesk_respons, $id_helpdesk);
		$this->db->where('id_helpdesk_respons', $id_helpdesk_respons);
		$this->db->delete('helpdesk_respons');
		$this->db->where('id_helpdesk_respon', $id_helpdesk_respons);
		$this->db->delete('helpdesk_file');
	}

	private function _uploadFile($id_helpdesk)
	{

		if (empty(mkdir("./data/helpdesk/respons/$id_helpdesk"))) {
			mkdir("./data/helpdesk/respons/$id_helpdesk");
		}

		$config = array(
			'upload_path' => "./data/helpdesk/respons/$id_helpdesk/",
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

	private function _deleteFile($id_helpdesk)
	{

		$data = $this->get_respons_file_by_id($id_helpdesk);
		if ($data->file != "default") {
			$filename = explode(".", $data->file)[0];
			return array_map('unlink', glob(FCPATH . "data/helpdesk/respons/$id_helpdesk/$filename.*"));
		}
	}

	private function _deleteResponsFile($id_helpdesk_respons, $id_helpdesk)
	{

		$data = $this->get_respons_file_by_id_respons($id_helpdesk_respons);
		if ($data->file != "default") {
			$filename = explode(".", $data->file)[0];
			return array_map('unlink', glob(FCPATH . "data/helpdesk/respons/$id_helpdesk/$filename.*"));
		}
	}
}
