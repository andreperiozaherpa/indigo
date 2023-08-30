<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ref_skpd extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('ref_skpd_model');

		$this->level_id	= $this->user_model->level_id;
		if ($this->user_level == 'User') {
			redirect('admin');
		}

		$this->jenis_skpd = array('demo', 'kecamatan', 'kelurahan', 'kota', 'skpd', 'uptd', 'desa', 'dprd', 'bumd');
	}
	public function index()
	{
		if ($this->user_id) {
			if ($this->user_level !== 'Administrator') redirect('admin');

			$data['title']		= "Ref. SKPD - Admin ";
			$data['content']	= "ref_skpd/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all());
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->ref_skpd_model->get_page($mulai, $hal, $filter);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function add()
	{
		if ($this->user_id) {
			if ($this->user_level !== 'Administrator') redirect('admin');
			$data['title']		= "Tambah SKPD - Admin ";
			$data['content']	= "ref_skpd/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$data['jenis_skpd'] = $this->jenis_skpd;
			$data['skpd'] = $this->ref_skpd_model->get_all();

			if (!empty($_POST)) {
				$cek = $_POST;
				unset($cek['nama_skpd_alias']);
				unset($cek['instagram_skpd']);
				unset($cek['facebook_skpd']);
				unset($cek['twitter_skpd']);
				unset($cek['website']);
				unset($cek['fax']);
				unset($cek['kode_pos']);
				unset($cek['id_skpd_induk']);
				// print_r($cek);
				// die;
				if (cekForm($cek)) {
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				} else {
					$insert = $_POST;
					unset($insert['logo_skpd']);
					$insert['logo_skpd'] = "sumedang.png";

					$config['upload_path']          = './data/logo/skpd/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('logo_skpd')) {
						$tmp_name = $_FILES['logo_skpd']['tmp_name'];
						if ($tmp_name != "") {
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					} else {
						$insert['logo_skpd'] = $this->upload->data('file_name');
					}

					$in = $this->ref_skpd_model->insert($insert);
					$data['message'] = 'SKPD berhasil ditambahkan';
					$data['type'] = 'success';
				}
			}



			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function view($id_skpd)
	{
		if ($this->user_id) {
			$data['title']		= "Detail SKPD - Admin ";
			$data['content']	= "ref_skpd/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$data['active_tab'] = 'unit_kerja';

			$data['map'] = true;

			if (!empty($_POST)) {
				if (isset($_POST['id_unit_kerja']) && isset($_POST['nama_unit_kerja'])) {
					$update = $this->ref_skpd_model->update_unit_kerja($_POST, $_POST['id_unit_kerja']);
					if ($update) {
						$data['message'] = 'Unit Kerja berhasil diperbarui';
						$data['type'] = 'success';
						$data['active_tab'] = 'unit_kerja';
					}
				} elseif (!isset($_POST['id_unit_kerja']) && isset($_POST['nama_unit_kerja'])) {
					$insert = $this->ref_skpd_model->insert_unit_kerja($_POST, $id_skpd);
					if ($insert) {
						$data['message'] = 'Unit Kerja berhasil ditambahkan';
						$data['type'] = 'success';
						$data['active_tab'] = 'unit_kerja';
					}
				} elseif (!isset($_POST['id_jabatan']) && isset($_POST['nama_jabatan'])) {
					unset($_POST['level_unit_kerja']);
					$insert = $this->ref_skpd_model->insert_jabatan($_POST, $id_skpd);
					if ($insert) {
						$data['message'] = 'Jabatan berhasil ditambahkan';
						$data['type'] = 'success';
						$data['active_tab'] = 'jabatan';
					}
				} elseif (isset($_POST['id_jabatan']) && isset($_POST['nama_jabatan'])) {
					$insert = $this->ref_skpd_model->update_jabatan($_POST, $_POST['id_jabatan']);
					if ($insert) {
						$data['message'] = 'Jabatan berhasil diperbaharui';
						$data['type'] = 'success';
						$data['active_tab'] = 'jabatan';
					}
				} elseif (!isset($_POST['id_ref_skpd_sub']) && isset($_POST['nama_sub'])) {
					unset($_POST['level_unit_kerja']);
					$insert = $this->ref_skpd_model->insert_sub($_POST, $id_skpd);
					if ($insert) {
						$data['message'] = 'Sub Office berhasil ditambahkan';
						$data['type'] = 'success';
						$data['active_tab'] = 'sub_office';
					}
				} elseif (isset($_POST['id_ref_skpd_sub']) && isset($_POST['nama_sub'])) {
					$insert = $this->ref_skpd_model->update_sub($_POST, $_POST['id_ref_skpd_sub']);
					if ($insert) {
						$data['message'] = 'Sub Office berhasil diperbaharui';
						$data['type'] = 'success';
						$data['active_tab'] = 'sub_office';
					}
				} else {
					$update = $this->ref_skpd_model->update($_POST, $id_skpd);
					if ($update) {
						$data['message'] = 'SKPD berhasil diperbarui';
						$data['type'] = 'success';
					}
				}
			}
			if (isset($_GET['active_tab'])) {
				$data['active_tab'] = $_GET['active_tab'];
			}
			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_level($id_skpd, 1);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id_skpd($id_skpd);
			$data['jenis_skpd'] = $this->jenis_skpd;
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['sub_office'] = $this->ref_skpd_model->get_skpd_sub($id_skpd);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function delete($id_skpd)
	{
		if ($this->user_id) {
			$this->ref_skpd_model->delete($id_skpd);
			redirect('ref_skpd');
		} else {
			redirect('admin');
		}
	}

	public function delete_unit_kerja($id_unit_kerja)
	{
		if ($this->user_id) {
			$get = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$id_skpd = $get->id_skpd;
			$this->ref_skpd_model->delete_unit_kerja($id_unit_kerja);
			redirect('ref_skpd/view/' . $id_skpd);
		} else {
			redirect('admin');
		}
	}

	public function get_unit_kerja_by_level($id_skpd, $level)
	{
		$get = $this->ref_skpd_model->get_unit_kerja_by_level($id_skpd, $level);
		echo '<option value="0">Pilih Unit Kerja</option>';
		foreach ($get as $g) {
			echo '<option value="' . $g->id_unit_kerja . '">' . $g->nama_unit_kerja . '</option>';
		}
	}

	public function get_unit_kerja($id_unit_kerja)
	{
		echo json_encode($this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja));
	}

	public function get_jabatan($id_jabatan)
	{
		$get = $this->ref_skpd_model->get_jabatan_by_id($id_jabatan);
		$level_uk = $this->ref_skpd_model->get_unit_kerja_by_id($get->id_unit_kerja)->level_unit_kerja;
		$get->level_unit_kerja = $level_uk;
		echo json_encode($get);
	}

	public function delete_jabatan($id_jabatan)
	{
		if ($this->user_id) {
			$get = $this->ref_skpd_model->get_jabatan_by_id($id_jabatan);
			$id_skpd = $get->id_skpd;
			$this->ref_skpd_model->delete_jabatan($id_jabatan);
			redirect('ref_skpd/view/' . $id_skpd . '?active_tab=jabatan');
		} else {
			redirect('admin');
		}
	}

	public function get_sub($id_ref_skpd_sub)
	{
		$get = $this->ref_skpd_model->get_sub_by_id($id_ref_skpd_sub);
		echo json_encode($get);
	}

	public function delete_sub($id_ref_skpd_sub)
	{
		if ($this->user_id) {
			$get = $this->ref_skpd_model->get_sub_by_id($id_ref_skpd_sub);
			$id_skpd = $get->id_skpd;
			$this->ref_skpd_model->delete_sub($id_ref_skpd_sub);
			redirect('ref_skpd/view/' . $id_skpd . '?active_tab=sub_office');
		} else {
			redirect('admin');
		}
	}
}
