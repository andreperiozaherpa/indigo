<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_personal_model extends CI_Model
{

	public function get_by_id($id_keg)
	{	
		$this->db->join('pegawai as pegawai_verifikator','pegawai_verifikator.id_pegawai = kegiatan_personal.id_pegawai_verifikator');
		$this->db->select('kegiatan_personal.*,pegawai_verifikator.nama_lengkap as nama_lengkap_verifikator,pegawai_verifikator.jabatan as jabatan_verifikator');
		return $this->db->get_where('kegiatan_personal', ["id_kegiatan_personal" => $id_keg])->row();
	}

	public function get_kegiatan_by_id($id_pegawai, $id_kegiatan)
	{
		$this->db->where('kegiatan_personal.id_kegiatan_personal', $id_kegiatan);
		$this->db->where('kegiatan_personal.id_pegawai_input', $id_pegawai);
		$this->db->join('pegawai', 'pegawai.id_pegawai=kegiatan_personal.id_pegawai_verifikator', 'left');
		$this->db->join('iki_indikator', 'iki_indikator.id_iki=kegiatan_personal.id_iki_tautan', 'left');
		$this->db->join('iki_sasaran', 'iki_sasaran.id_sasaran_iki=iki_indikator.id_sasaran_iki', 'left');
		return $this->db->get('kegiatan_personal')->row();
	}


	public function insert_kegiatan($data)
	{
		$this->db->set('tgl_input', $this->tgl_input);
		$this->db->set('id_pegawai_input', $this->id_pegawai);
		$this->db->set('id_skpd', $this->id_skpd);
		$this->db->set('nama_kegiatan', $this->nama_kegiatan);
		$this->db->set('deskripsi', $this->deskripsi);
		$this->db->set('tgl_kegiatan_mulai', $this->tgl_kegiatan_mulai);
		$this->db->set('tgl_kegiatan_akhir', $this->tgl_kegiatan_akhir);
		$this->db->set('target_kegiatan', $this->target_kegiatan);
		$this->db->set('id_verifikator', $this->id_verifikator);
		$this->db->set('status_kegiatan', $this->status_kegiatan);
		$this->db->insert('kegiatan_personal');
	}

	public function get_verifikator_kegiatan($id_skpd, $where)
	{
		$this->db->where('id_pegawai !=', $where);
		$this->db->where('id_skpd', $id_skpd);
		return $this->db->get('pegawai')->result_array();
	}

	public function get_all_by_id($id_pegawai)
	{
		$this->db->join('pegawai', 'kegiatan_personal.id_pegawai_verifikator = pegawai.id_pegawai');
		$this->db->where('kegiatan_personal.id_pegawai_input', $id_pegawai);
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_all_by_id_verif($id_pegawai)
	{
		$this->db->where('status_kegiatan', 'SELESAI DIVERIFIKASI');
		$this->db->where('id_pegawai_input', $id_pegawai);
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_all_by_id_unverif($id_pegawai)
	{
		$this->db->where('status_kegiatan !=', 'SELESAI DIVERIFIKASI');
		$this->db->where('id_pegawai_input', $id_pegawai);
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_belum_dikerjakan($id_pegawai, $mulai, $hal, $tgl, $nama)
	{
		if ($nama != '') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal, $mulai);
		}
		if ($tgl != '') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal, $mulai);
		} else {
			$this->db->limit($hal, $mulai);
		}
		$this->db->join('pegawai', 'pegawai.id_pegawai = kegiatan_personal.id_pegawai_verifikator');
		$this->db->where('kegiatan_personal.id_pegawai_input', $id_pegawai);
		$this->db->where('kegiatan_personal.status_kegiatan', 'BELUM DIKERJAKAN');
		$this->db->order_by('kegiatan_personal.id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_menunggu_verifikasi($id_pegawai, $mulai, $hal, $tgl, $nama)
	{
		if ($nama != '') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal, $mulai);
		}
		if ($tgl != '') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal, $mulai);
		} else {
			$this->db->limit($hal, $mulai);
		}
		$this->db->where('id_pegawai_input', $id_pegawai);
		$this->db->where('status_kegiatan', 'MENUNGGU VERIFIKASI');
		$this->db->order_by('id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_selesai_diverifikasi($id_pegawai, $mulai, $hal, $tgl, $nama)
	{
		if ($nama != '') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal, $mulai);
		}
		if ($tgl != '') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal, $mulai);
		} else {
			$this->db->limit($hal, $mulai);
		}
		$this->db->where('id_pegawai_input', $id_pegawai);
		$this->db->where('status_kegiatan', 'SELESAI DIVERIFIKASI');
		$this->db->order_by('id_kegiatan_personal', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function get_daftar_kegiatan($id_pegawai, $mulai, $hal, $tgl, $nama)
	{

		if ($nama != '') {
			$this->db->like('nama_kegiatan', $nama);
			$this->db->limit($hal, $mulai);
		}
		if ($tgl != '') {
			$this->db->where('tgl_kegiatan_mulai', $tgl);
			$this->db->limit($hal, $mulai);
		} else {
			$this->db->limit($hal, $mulai);
		}
		$this->db->where('id_pegawai_input', $id_pegawai);
		$this->db->order_by('id_pegawai_input', 'DESC');
		return $this->db->get('kegiatan_personal')->result();
	}

	public function tambah_kegiatan_personal($id_skpd, $id_pegawai, $id_user)
	{

		if (!empty($_POST['id_sasaran'])) {
			$e = explode('_', $_POST['id_sasaran']);
			$_POST['id_sasaran'] = $e[1];
			$_POST['jenis_sasaran'] = $e[0];
		}
		$data = array(
			'tgl_input' => date('Y-m-d H:m:s'),
			'id_pegawai_input' => $id_pegawai,
			'id_skpd' => $id_skpd,
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tgl_kegiatan_mulai' => $this->input->post('tgl_kegiatan_mulai'),
			'tgl_kegiatan_akhir' => $this->input->post('tgl_kegiatan_akhir'),
			'target_kegiatan' => $this->input->post('target_kegiatan'),
			'id_pegawai_verifikator' => $this->input->post('id_verifikator'),
			'jenis_sasaran_tautan' => $this->input->post('jenis_sasaran'),
			'id_unit_kerja_tautan' => $this->input->post('id_unit_kerja'),
			'id_sasaran_tautan' => $this->input->post('id_sasaran'),
			'id_iku_tautan' => $this->input->post('id_iku'),
			'id_renaksi_tautan' => $this->input->post('id_renaksi'),
			'id_iki_tautan' => ($this->input->post('id_iki'))?$this->input->post('id_iki'):0,
			'status_kegiatan' => 'BELUM DIKERJAKAN',
			'lokasi_pengerjaan' => $this->input->post('lokasi_pengerjaan'),
			'id_kerja_luar_kantor' => $this->input->post('id_kerja_luar_kantor'),
			'alamat'			=> $this->input->post('alamat'),
			'lat'			=> $this->input->post('lat'),
			'lng'			=> $this->input->post('lng'),
		);
		$this->db->insert('kegiatan_personal', $data);
		$insert_id = $this->db->insert_id();

		$data_logs = array(
			'id_kegiatan_personal' => $insert_id,
			'status' => 'Menambah kegiatan personal baru',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function update_kegiatan_personal($id_skpd, $id_pegawai, $id_keg, $id_user)
	{
		$data = array(
			'tgl_update' => date('Y-m-d H:m:s'),
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
			'deskripsi' => $this->input->post('deskripsi'),
			'tgl_kegiatan_mulai' => $this->input->post('tgl_kegiatan_mulai'),
			'tgl_kegiatan_akhir' => $this->input->post('tgl_kegiatan_akhir'),
			'target_kegiatan' => $this->input->post('target_kegiatan'),
			'id_pegawai_verifikator' => $this->input->post('id_verifikator')
		);
		$this->db->where('id_kegiatan_personal', $id_keg);
		$this->db->update('kegiatan_personal', $data);

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Mengubah kegiatan personal',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function hapus_kegiatan_personal($id_kegiatan)
	{
		$this->db->where('id_kegiatan_personal', $id_kegiatan);
		$this->db->delete('kegiatan_personal');
	}

	public function kerjakan_kegiatan_personal($id_keg, $id_pegawai, $id_user)
	{

		$data = array(
			'uraian_aktifitas' => $this->input->post('uraian_aktifitas'),
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

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Menyelesaikan kegiatan',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	public function revisi_kegiatan_personal($id_keg, $id_pegawai, $id_user)
	{

		$data = array(
			'catatan_verifikator' => NULL,
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

		$data_logs = array(
			'id_kegiatan_personal' => $id_keg,
			'status' => 'Menyelesaikan revisi kegiatan',
			'date' => date('Y-m-d'),
			'time' => date('h:i:s'),
			'id_user' => $id_user
		);
		$this->db->insert('kegiatan_personal_logs', $data_logs);
	}

	private function _uploadFile($id_pegawai)
	{

		if (!file_exists("./data/kegiatan_personal/$id_pegawai")) {
			mkdir("./data/kegiatan_personal/$id_pegawai", 0777, true);
		}

		$config = array(
			'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
			'allowed_types' => "gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
			'overwrite' => TRUE,
			'max_size' => "20480000"
		);

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('lampiran')) {
			$data = array('lampiran' => $this->upload->data());
			return $this->upload->data('file_name');
		} else {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', $error['error']);
			return "default";
		}
	}

	private function _deleteFile($id_keg, $id_pegawai)
	{

		$data = $this->get_by_id($id_keg);
		if ($data->lampiran != "default") {
			$filename = explode(".", $data->lampiran)[0];
			return array_map('unlink', glob(FCPATH . "data/kegiatan_personal/$id_pegawai/$filename.*"));
		}
	}

	public function logs($id_kegiatan)
	{
		$this->db->where('kegiatan_personal_logs.id_kegiatan_personal', $id_kegiatan);
		$this->db->join('user', 'user.user_id = kegiatan_personal_logs.id_user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		return $this->db->get('kegiatan_personal_logs')->result();
	}


	public function total_pekerjaan($type = '')
	{
		// $this->db->where('id_kerja_luar_kantor is not null');
		if($this->session->userdata('kepala_skpd')=="Y"){
			$this->db->where('kegiatan_personal.id_skpd', $this->session->userdata('id_skpd'));
		}
		if ($type == 'pegawai') {
			$this->db->group_by('id_pegawai_input');
			$this->db->join('pegawai', 'pegawai.id_pegawai = kegiatan_personal.id_pegawai_input');
			$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		} elseif ($type == 'selesai') {
			$this->db->where('status_kegiatan', 'SELESAI DIVERIFIKASI');
		}
		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	public function get_pekerjaan_pegawai_page($mulai, $hal, $bulan, $tahun, $nama)
	{
		if($bulan=='' && $tahun=='' && $nama==''){

			$this->db->limit($hal, $mulai);
		}
		// $this->db->where('id_kerja_luar_kantor is not null');
		if($this->session->userdata('kepala_skpd')=="Y"){
			$this->db->where('kegiatan_personal.id_skpd', $this->session->userdata('id_skpd'));
		}
		if ($bulan != '') {
			$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
			$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
		}

		if($tahun != ''){
			$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
			$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
		}

		if($nama !=''){
			$this->db->like('pegawai.nama_lengkap',$nama);
		}

		$this->db->where('pegawai.id_skpd', 5);
		
		$this->db->group_by('id_pegawai_input');
		$this->db->join('pegawai', 'pegawai.id_pegawai = kegiatan_personal.id_pegawai_input');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	public function total_by_pegawai($id_pegawai, $status = '')
	{
		// $this->db->where('id_kerja_luar_kantor is not null');
		// if ($this->session->userdata('level') !== 'Administrator') {
		// 	$this->db->where('id_skpd', $this->session->userdata('id_skpd'));
		// }
		$this->db->where('id_pegawai_input', $id_pegawai);
		if ($status != '') $this->db->where('status_kegiatan', $status);
		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	public function list_by_pegawai($id_pegawai, $status = '')
	{
		$this->db->order_by('id_kegiatan_personal','desc');
		$this->db->where('id_pegawai_input', $id_pegawai);
		$q = $this->db->get('kegiatan_personal');
		return $q->result();
	}

	
	public function get_all_pekerjaan( $bulan, $tahun, $id_skpd)
	{
		if ($bulan != '') {
			$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
			$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
		}

		if($tahun != ''){
			$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
			$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
		}

		if($id_skpd !=''){
			$this->db->where('pegawai.id_skpd',$id_skpd);
		}
		$this->db->order_by('pegawai.nama_lengkap','asc');
		$this->db->group_by('id_pegawai_input');
		$this->db->join('pegawai', 'pegawai.id_pegawai = kegiatan_personal.id_pegawai_input');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$q = $this->db->get('kegiatan_personal')->result();
		foreach($q as $k => $res){
			if ($bulan != '') {
				$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
				$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
			}
	
			if($tahun != ''){
				$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
				$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
			}
			$q[$k]->diusulkan = $this->db->get_where('kegiatan_personal',array('id_pegawai_input'=>$res->id_pegawai))->num_rows();
			
			if ($bulan != '') {
				$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
				$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
			}
	
			if($tahun != ''){
				$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
				$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
			}
			$q[$k]->belum_dikerjakan = $this->db->get_where('kegiatan_personal',array('id_pegawai_input'=>$res->id_pegawai,'status_kegiatan'=>'BELUM DIKERJAKAN'))->num_rows();
			
			if ($bulan != '') {
				$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
				$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
			}
	
			if($tahun != ''){
				$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
				$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
			}
			$q[$k]->verifikasi = $this->db->get_where('kegiatan_personal',array('id_pegawai_input'=>$res->id_pegawai,'status_kegiatan'=>'MENUNGGU VERIFIKASI'))->num_rows();
			
			if ($bulan != '') {
				$this->db->where('MONTH(tgl_kegiatan_mulai) <=', $bulan);
				$this->db->where('MONTH(tgl_kegiatan_akhir) >=', $bulan);
			}
	
			if($tahun != ''){
				$this->db->where('YEAR(tgl_kegiatan_mulai) <=', $tahun);
				$this->db->where('YEAR(tgl_kegiatan_akhir) >=', $tahun);
			}
			$q[$k]->selesai = $this->db->get_where('kegiatan_personal',array('id_pegawai_input'=>$res->id_pegawai,'status_kegiatan'=>'SELESAI DIVERIFIKASI'))->num_rows();
		}
		return $q;
	}
}