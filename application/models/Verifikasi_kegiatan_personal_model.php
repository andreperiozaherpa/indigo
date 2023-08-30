<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi_kegiatan_personal_model extends CI_Model
{

	public function get_by_id($id_keg){
		return $this->db->get_where('kegiatan_personal', ["id_kegiatan_personal" => $id_keg])->row();
	}

	public function get_kegiatan_by_id($id_pegawai, $id_kegiatan){
		$this->db->select('*, kegiatan_personal.id_pegawai_input as id_pegawai');
		$this->db->where('kegiatan_personal.id_kegiatan_personal', $id_kegiatan);
		$this->db->where('kegiatan_personal.id_pegawai_input', $id_pegawai);
		$this->db->join('pegawai', 'pegawai.id_pegawai=kegiatan_personal.id_pegawai_input');
		$this->db->join('iki_indikator', 'iki_indikator.id_iki=kegiatan_personal.id_iki_tautan', 'left');
		$this->db->join('iki_sasaran', 'iki_sasaran.id_sasaran_iki=iki_indikator.id_sasaran_iki', 'left');
		return $this->db->get('kegiatan_personal')->row();
	}

	public function insert_kegiatan($data)
	{
		$this->db->set('tgl_input',$this->tgl_input);
		$this->db->set('id_pegawai_input',$this->id_pegawai);
		$this->db->set('id_skpd',$this->id_skpd);
		$this->db->set('nama_kegiatan',$this->nama_kegiatan);
		$this->db->set('deskripsi',$this->deskripsi);
		$this->db->set('tgl_kegiatan_mulai',$this->tgl_kegiatan_mulai);
		$this->db->set('tgl_kegiatan_akhir',$this->tgl_kegiatan_akhir);
		$this->db->set('target_kegiatan',$this->target_kegiatan);
		$this->db->set('id_verifikator',$this->id_verifikator);
		$this->db->set('status_kegiatan',$this->status_kegiatan);
		$this->db->insert('kegiatan_personal');

	}

	public function get_verifikator_kegiatan($id_skpd, $where){
		$this->db->where('id_pegawai !=', $where);
		$this->db->where('id_skpd', $id_skpd);
		return $this->db->get('pegawai')->result_array();
	}

	public function get_all_by_id($id_pegawai){
		$this->db->where('id_pegawai_input', $id_pegawai);
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_revisi_kegiatan($id_pegawai, $mulai, $hal, $tgl, $nama){
		if($nama!='') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal,$mulai);
		}if($tgl!='') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal,$mulai);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->join('pegawai', 'pegawai.id_pegawai = kegiatan_personal.id_pegawai_verifikator');
		$this->db->where('kegiatan_personal.id_pegawai_verifikator', $id_pegawai);
		$this->db->where('kegiatan_personal.status_kegiatan', 'BELUM DIKERJAKAN');
		$this->db->where('kegiatan_personal.catatan_verifikator !=', NULL);
		$this->db->order_by('kegiatan_personal.id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_menunggu_verifikasi_all($id_pegawai){
		$this->db->join('pegawai', 'kegiatan_personal.id_pegawai_input = pegawai.id_pegawai');
		$this->db->where('kegiatan_personal.id_pegawai_verifikator', $id_pegawai);
		$this->db->where('kegiatan_personal.status_kegiatan', 'MENUNGGU VERIFIKASI');
		$this->db->order_by('kegiatan_personal.id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_menunggu_verifikasi($id_pegawai, $mulai, $hal, $tgl, $nama){
		if($nama!='') {
			$this->db->like('kegiatan_personal.nama_kegiatan', $nama);
			$this->db->limit($hal,$mulai);
		}if($tgl!='') {
			$this->db->where('kegiatan_personal.tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal,$mulai);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->join('pegawai', 'kegiatan_personal.id_pegawai_input = pegawai.id_pegawai');
		$this->db->where('kegiatan_personal.id_pegawai_verifikator', $id_pegawai);
		$this->db->where('kegiatan_personal.status_kegiatan', 'MENUNGGU VERIFIKASI');
		$this->db->order_by('kegiatan_personal.id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_selesai_diverifikasi($id_pegawai, $mulai, $hal, $tgl, $nama){
		if($nama!='') {
			$this->db->like('kegiatan_personal.nama_kegiatan', $nama);
			$this->db->limit($hal,$mulai);
		}if($tgl!='') {
			$this->db->where('kegiatan_personal.tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal,$mulai);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->join('pegawai', 'kegiatan_personal.id_pegawai_input = pegawai.id_pegawai');
		$this->db->where('kegiatan_personal.id_pegawai_verifikator', $id_pegawai);
		$this->db->where('kegiatan_personal.status_kegiatan', 'SELESAI DIVERIFIKASI');
		$this->db->order_by('kegiatan_personal.id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_daftar_kegiatan($id_pegawai, $mulai, $hal, $tgl, $nama){

		if($nama!='') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal,$mulai);
		}if($tgl!='') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal,$mulai);
		}else{
			$this->db->limit($hal,$mulai);
		}
		$this->db->where('id_pegawai_verifikator', $id_pegawai);
		$this->db->order_by('id_pegawai_input', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function verifikasi_kegiatan($id_keg, $id_user){
		$data = array(
			'tgl_verifikasi' => date('Y-m-d'),
			'status_kegiatan' => 'SELESAI DIVERIFIKASI'
		);
		$this->db->where('id_kegiatan_personal', $id_keg);
		$this->db->update('kegiatan_personal', $data);

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Memverifikasi kegiatan',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function batalkan($id_keg, $id_user){
		$data = array(
			'tgl_verifikasi' => NULL,
			'status_kegiatan' => 'MENUNGGU VERIFIKASI'
		);
		$this->db->where('id_kegiatan_personal', $id_keg);
		$this->db->update('kegiatan_personal', $data);

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Membatalkan verifikasi',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function tolak($id_keg, $id_user){
		$data = array(
			'catatan_verifikator' => $this->input->post('catatan'),
			'status_kegiatan' => 'BELUM DIKERJAKAN'
		);
		$this->db->where('id_kegiatan_personal', $id_keg);
		$this->db->update('kegiatan_personal', $data);

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Menolak kegiatan serta memberi catatan',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function kerjakan_kegiatan_personal($id_keg, $id_pegawai){

		$data = array(
			'deskripsi_hasil' => $this->input->post('deskripsi_hasil'),
			'tgl_selesai_kegiatan' => $this->input->post('tgl_selesai_kegiatan'),
			'status_kegiatan' => 'MENUNGGU VERIFIKASI'
		);

		if (!empty($_FILES['lampiran']['name'])) {
				$this->_deleteFile($id_keg, $id_pegawai);
				$data['lampiran'] = $this->_uploadFile($id_pegawai);
		} else {
				$data['lampiran'] = $this->input->post('lampiran_lama');
		}
		$this->db->where('id_kegiatan_personal', $id_keg);
		$this->db->update('kegiatan_personal', $data);
	}

	private function _uploadFile($id_pegawai){

		mkdir("./data/kegiatan_personal/$id_pegawai");

		$config = array(
		'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
		'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip",
		'overwrite' => TRUE,
		'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
		// 'max_height' => "2000",
		// 'max_width' => "2000"
		);

	$this->load->library('upload', $config);

	if($this->upload->do_upload('lampiran'))
		{
			$data = array('lampiran' => $this->upload->data());
			return $this->upload->data('file_name');
		}
	else
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$error['error']);
			return "default";
		}


	}

	private function _deleteFile($id_keg, $id_pegawai){

			$data = $this->get_by_id($id_keg);
			if ($data->lampiran != "default") {
				$filename = explode(".", $data->lampiran)[0];
			return array_map('unlink', glob(FCPATH."data/kegiatan_personal/$id_pegawai/$filename.*"));
			}
	}

	public function logs($id_kegiatan){
		$this->db->select('
		kegiatan_personal_logs.id_kegiatan_personal_logs, kegiatan_personal_logs.id_kegiatan_personal,
		kegiatan_personal_logs.status, kegiatan_personal_logs.date, kegiatan_personal_logs.time, kegiatan_personal_logs.id_user,
		user.user_id, user.id_pegawai, user.full_name, pegawai.id_pegawai, pegawai.nama_lengkap, pegawai.foto_pegawai
		');

		$this->db->where('kegiatan_personal_logs.id_kegiatan_personal', $id_kegiatan);
		$this->db->join('user', 'user.user_id = kegiatan_personal_logs.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		return $this->db->get('kegiatan_personal_logs')->result();
	}

}
?>
