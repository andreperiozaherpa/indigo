<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_Pegawai extends CI_Controller
{
	public $user_id;
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('kegiatan_model', 'km');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('realisasi_kegiatan_model', 'rkm');
		$this->load->model('pegawai_model');
		$this->load->model('ref_jabatan_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->email = $this->user_model->email; /*ADD BY AYU*/
		$this->user_level = $this->user_model->level;
		$this->foto_pegawai = $this->user_model->foto_pegawai;
		$this->level_id = $this->user_model->level_id;
		$this->user_privileges = $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);

		// if (($this->user_level!="Administrator" && $this->user_level!="User") && !in_array('kepegawaian', $this->array_privileges)) redirect ('welcome');
		if ($this->user_level !== 'Administrator' && $this->user_level !== 'Operator' && !in_array('kepegawaian', $this->array_privileges))
			redirect('home');
	}
	public function index()
	{
		if ($this->user_id) {
			$data['title'] = "Master_Pegawai - Admin ";
			$data['content'] = "master_pegawai/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai/index';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->master_pegawai_model->get_all(true));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$nip = $_POST['nip'];
				$skpd = @$_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['nip'] = $_POST['nip'];
				$data['id_skpd'] = $skpd;
			} else {
				$filter = '';
				$nama = '';
				$nip = '';
				$skpd = '';
				$data['filter'] = false;
			}

			$data['list'] = $this->master_pegawai_model->get_page($mulai, $hal, $nama, $nip, $skpd, '', true);

			if ($this->session->userdata('id_skpd') == 5) { //Dinas Kesehatan
				$data['skpd'] = $this->ref_skpd_model->get_all('', false, $this->session->userdata('id_skpd'));
			} else {
				$data['skpd'] = $this->ref_skpd_model->get_all('', true);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function dewan()
	{
		if ($this->user_id) {
			$data['title'] = "Master_Pegawai - Admin ";
			$data['content'] = "master_pegawai/dewan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai/dewan';
			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->master_pegawai_model->get_by_id_skpd(231));
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$nip = $_POST['nip'];
				$skpd = @$_POST['id_skpd'];
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['nip'] = $_POST['nip'];
				$data['id_skpd'] = $skpd;
			} else {
				$filter = '';
				$nama = '';
				$nip = '';
				$skpd = '';
				$data['filter'] = false;
			}
			$skpd = 231;

			$data['list'] = $this->master_pegawai_model->get_page_dewan($mulai, $hal, $nama, $nip, $skpd, '', true);

			if ($this->session->userdata('id_skpd') == 5) { //Dinas Kesehatan
				$data['skpd'] = $this->ref_skpd_model->get_all('', false, 3);
			} else {
				$data['skpd'] = $this->ref_skpd_model->get_all('', true);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function add()
	{
		if ($this->user_id) {
			if ($this->user_level !== 'Administrator' && $this->user_level !== 'Operator')
				redirect('home');
			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['active_menu'] = 'master_pegawai';
			$data['user_level'] = $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if (!empty($_POST)) {
				$cek = $_POST;
				unset($cek['grade']);
				unset($cek['tpp']);
				unset($cek['id_unit_kerja']);
				if (cekForm($cek)) {
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				} elseif ($this->master_pegawai_model->ceknip($_POST['nip'])) {
					$data['message'] = 'NIP yang anda gunakan sudah terdaftar.';
					$data['type'] = 'info';
				} else {
					$insert = $_POST;
					$get_jabatan = $this->ref_jabatan_model->get_by_id($_POST['id_jabatan']);
					$insert['jabatan'] = $get_jabatan->nama_jabatan;
					unset($insert['foto_pegawai'], $insert['grade'], $insert['tpp']);
					$insert['foto_pegawai'] = "user-default.png";

					$config['upload_path'] = './data/foto/pegawai/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('foto_pegawai')) {
						$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
						if ($tmp_name != "") {
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					} else {
						$insert['foto_pegawai'] = $this->upload->data('file_name');
						$filename = $this->upload->data('file_name');
						$old_path = './data/foto/pegawai/';
						$new_path = './data/user_picture/';
						if (!copy($old_path . $filename, $new_path . $filename)) {
							$data['message'] = "failed to copy $file...\n";
							$data['type'] = 'warning';
						}
					}

					$in = $this->master_pegawai_model->insert($insert);
					$id_pegawai = $this->db->insert_id();
					$update_jabatan = $this->ref_jabatan_model->update_ref(array('grade' => $_POST['grade'], 'tpp' => $_POST['tpp'], 'id_pegawai' => $id_pegawai), $_POST['id_jabatan']);
					$data['message'] = 'Pegawai berhasil ditambahkan';
					$data['type'] = 'success';
				}
			}

			if ($this->user_level == 'Operator') {
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			}
			// $data['jabatan_list'] = $this->ref_jabatan_model->get_by_id_skpd($data['detail']->id_skpd);
			// $data['jabatan_list'] = $this->ref_jabatan_model->get_by_id_skpd($data['detail']->id_skpd);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function dewan_add()
	{
		if ($this->user_id) {

			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/dewan/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['active_menu'] = 'master_pegawai';
			$data['user_level'] = $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if (!empty($_POST)) {
				$cek = $_POST;
				unset($cek['grade']);
				unset($cek['tpp']);
				unset($cek['id_unit_kerja']);
				if (cekForm($cek)) {
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				} elseif ($this->master_pegawai_model->ceknip($_POST['nip'])) {
					$data['message'] = 'NIP yang anda gunakan sudah terdaftar.';
					$data['type'] = 'info';
				} else {
					$insert = $_POST;
					$get_jabatan = $this->ref_jabatan_model->get_by_id($_POST['id_jabatan']);
					$insert['jabatan'] = $get_jabatan->nama_jabatan;
					unset($insert['foto_pegawai'], $insert['grade'], $insert['tpp']);
					$insert['foto_pegawai'] = "user-default.png";

					$config['upload_path'] = './data/foto/pegawai/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('foto_pegawai')) {
						$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
						if ($tmp_name != "") {
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					} else {
						$insert['foto_pegawai'] = $this->upload->data('file_name');
						$filename = $this->upload->data('file_name');
						$old_path = './data/foto/pegawai/';
						$new_path = './data/user_picture/';
						if (!copy($old_path . $filename, $new_path . $filename)) {
							$data['message'] = "failed to copy $file...\n";
							$data['type'] = 'warning';
						}
					}

					$in = $this->master_pegawai_model->insert($insert);
					$id_pegawai = $this->db->insert_id();
					$update_jabatan = $this->ref_jabatan_model->update_ref(array('grade' => $_POST['grade'], 'tpp' => $_POST['tpp'], 'id_pegawai' => $id_pegawai), $_POST['id_jabatan']);
					$data['message'] = 'Pegawai berhasil ditambahkan';
					$data['type'] = 'success';
				}
			}

			if ($this->user_level == 'Operator') {
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			}
			// $data['jabatan_list'] = $this->ref_jabatan_model->get_by_id_skpd($data['detail']->id_skpd);
			// $data['jabatan_list'] = $this->ref_jabatan_model->get_by_id_skpd($data['detail']->id_skpd);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}



	public function edit($id_pegawai = 0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai > 0) {
			$data['title'] = "Edit Pegawai - Admin ";
			$data['content'] = "master_pegawai/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['active_menu'] = 'master_pegawai';
			$data['user_level'] = $this->user_level;

			if ($this->user_level == 'Administrator') {
				$data['skpd'] = $this->ref_skpd_model->get_all();
			} else {
				if ($this->session->userdata('id_skpd') == 5) { //Dinas Kesehatan
					$data['skpd'] = $this->ref_skpd_model->get_all('', false, $this->session->userdata('id_skpd'));
				} else {
					$data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
				}
			}
			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);

			if (!$data['detail']) {
				show_404();
			}

			if ($this->user_level !== 'Administrator') {
				if (($this->user_level == 'User' && $data['detail']->id_skpd !== $this->session->userdata('id_skpd')) || ($this->user_level == 'Operator' && $data['detail']->id_skpd !== $this->session->userdata('kd_skpd'))) {
					show_404();
				}
			}


			if (!empty($_POST)) {
				$cek = $_POST;
				unset($cek['nik']);
				unset($cek['id_unit_kerja']);
				unset($cek['tpp']);
				unset($cek['grade']);
				unset($cek['id_ref_skpd_sub']);
				if (cekForm($cek)) {
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				} else {
					$update = $_POST;
					$get_jabatan = $this->ref_jabatan_model->get_by_id($_POST['id_jabatan']);
					$update['jabatan'] = $get_jabatan->nama_jabatan;

					if ($_POST['id_jabatan'] !== $data['detail']->id_jabatan) {
						$update['id_jabatan_lama'] = $data['detail']->id_jabatan;
					}

					unset($update['foto_pegawai']);
					unset($update['grade']);
					unset($update['tpp']);
					if (!empty($_POST['nik']) && strlen($_POST['nik']) !== 16) {
						$data['message'] = 'NIK harus 16 digit';
						$data['type'] = 'warning';
					} else {
						if (!empty($_FILES['file_ktp']['tmp_name'])) {
							$config2['file_name'] = 'ktp_' . md5($id_pegawai);
							$config2['upload_path'] = './data/ktp/';
							$config2['allowed_types'] = 'gif|jpg|png|jpeg';
							$config2['max_size'] = 2000;
							$config2['max_width'] = 2000;
							$config2['max_height'] = 2000;
							$config2['overwrite'] = TRUE;
							$this->load->library('upload', $config2);
							if (!$this->upload->do_upload('file_ktp')) {
								$tmp_name = $_FILES['file_ktp']['tmp_name'];
								if ($tmp_name != "") {
									$data['message'] = $this->upload->display_errors();
									$data['type'] = "danger";
								}
							} else {
								$update['file_ktp'] = $this->upload->data('file_name');
							}
						}

						if (!empty($_FILES['foto_pegawai']['tmp_name'])) {
							unset($this->upload);
							$config['file_name'] = 'foto_' . md5($id_pegawai);
							$config['upload_path'] = './data/foto/pegawai/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['max_size'] = 2000;
							$config['max_width'] = 2000;
							$config['max_height'] = 2000;
							$this->load->library('upload', $config);
							if (!$this->upload->do_upload('foto_pegawai')) {
								$tmp_name = $_FILES['foto_pegawai']['tmp_name'];
								if ($tmp_name != "") {
									$data['message'] = $this->upload->display_errors();
									$data['type'] = "danger";
								}
							} else {
								$update['foto_pegawai'] = $this->upload->data('file_name');
								$filename = $this->upload->data('file_name');
								$old_path = './data/foto/pegawai/';
								$new_path = './data/user_picture/';
								if (!copy($old_path . $filename, $new_path . $filename)) {
									$data['message'] = "failed to copy $file...\n";
									$data['type'] = 'warning';
								}
							}
						}


						if (empty($update['kepala_skpd'])) {
							$update['kepala_skpd'] = NULL;
						}

						if (isset($update['golongan'])) {
							$g_golongan = $this->db->get_where('ref_golongan', array('pangkat' => $update['golongan']))->row();
							if ($g_golongan) {
								$update['pangkat'] = $g_golongan->golongan;
							}
						}

						$in = $this->master_pegawai_model->update($update, $id_pegawai);
						$update_jabatan = $this->ref_jabatan_model->update_ref(array('grade' => $_POST['grade'], 'tpp' => $_POST['tpp'], 'id_pegawai' => $id_pegawai), $_POST['id_jabatan']);

						$bulan = date('m');
						$tahun = date('Y');
						$cek = $this->db->get_where('pegawai_posisi', ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $id_pegawai])->row();

						$this->load->model('tpp/tpp_perhitungan_model');
						$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
						$data_insert = ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $id_pegawai, 'id_skpd' => $data['detail']->id_skpd, 'id_jabatan' => $data['detail']->id_jabatan, 'jabatan' => $data['detail']->jabatan];
						// $get_tpp = $this->tpp_perhitungan_model->get_tpp($id_pegawai);
						// var_dump($get_tpp);
						$tpp = $_POST['tpp'];
						$grade = $_POST['grade'];
						$pajak = $this->tpp_perhitungan_model->get_pajak($id_pegawai);
						$data_insert['grade'] = $grade;
						$data_insert['tpp'] = $tpp;
						$data_insert['pph'] = $pajak;
						// print_r($data_insert);die;
						if (!$cek) {
							$this->db->insert('pegawai_posisi', $data_insert);
						} else {
							if ($cek->lock == "N") {
								$this->db->update('pegawai_posisi', $data_insert, ['id_pegawai_posisi' => $cek->id_pegawai_posisi]);
							}
						}

						// if($update_jabatan){
						if (isset($_GET['testing'])) {
							// $this->load->model('tpp/tpp_perhitungan_model');
							// $this->tpp_perhitungan_model->hitung_ulang_pegawai($id_pegawai);
						}
						// }

						$data['message'] = 'Pegawai berhasil diubah';
						$data['type'] = 'success';
					}
				}
			}



			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['jabatan_list'] = $this->ref_jabatan_model->get_by_id_skpd($data['detail']->id_skpd);
			// print_r($data['jabatan_list']);die;
			// echo $data['detail']
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($data['detail']->id_skpd);
			$data['sub_office'] = $this->ref_skpd_model->get_skpd_sub($data['detail']->id_skpd);

			$data['golongan_list'] = $this->db->get('ref_golongan')->result();
			$data['eselon_list'] = $this->db->get('ref_eselon')->result();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function view($id_pegawai = 0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai > 0) {


			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai';
			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			if (!$data['detail']) {
				show_404();
			}
			//echo "<pre>";print_r($data['detail']);die;
			foreach ($data['detail'] as $k => $d) {
				if (empty($d)) {
					$data['detail']->$k = "-";
				}
			}

			if ($this->user_level !== 'Administrator') {
				if (($this->user_level == 'User' && $data['detail']->id_skpd !== $this->session->userdata('id_skpd')) || ($this->user_level == 'Operator' && $data['detail']->id_skpd !== $this->session->userdata('kd_skpd'))) {
					show_404();
				}
			}

			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);
			$data['cek_user'] = $this->pegawai_model->cek_user($id_pegawai);
			$this->user_model->id_pegawai = $id_pegawai;
			$data['id_pegawai'] = $id_pegawai;
			if ($data['cek_user']) {
				$data['detail_user'] = $this->user_model->get_by_pegawai();

				$data['u'] = $this->user_model->get_user_by_user_id($data['detail_user']->user_id);

				$data['active_menu'] = "";
				$data['top_nav'] = "NO";
				$this->load->model('post_model');
				$data['total_post'] = $this->post_model->getTotalByAuthor($this->user_id);

				//activity
				$this->load->model('logs_model');
				$data['logs'] = $this->logs_model->get_some_id($this->user_model->user_id);

				//departmen
				$this->load->model('ref_unit_kerja_model');
				$data['get_unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function dewan_view($id_pegawai = 0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai > 0) {

			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/dewan/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai/dewan';
			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);
			//echo "<pre>";print_r($data['detail']);die;
			foreach ($data['detail'] as $k => $d) {
				if (empty($d)) {
					$data['detail']->$k = "-";
				}
			}
			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);
			$data['cek_user'] = $this->pegawai_model->cek_user($id_pegawai);
			$this->user_model->id_pegawai = $id_pegawai;
			$data['id_pegawai'] = $id_pegawai;
			if ($data['cek_user']) {
				$data['detail_user'] = $this->user_model->get_by_pegawai();

				$data['u'] = $this->user_model->get_user_by_user_id($data['detail_user']->user_id);

				$data['active_menu'] = "";
				$data['top_nav'] = "NO";
				$this->load->model('post_model');
				$data['total_post'] = $this->post_model->getTotalByAuthor($this->user_id);

				//activity
				$this->load->model('logs_model');
				$data['logs'] = $this->logs_model->get_some_id($this->user_model->user_id);

				//departmen
				$this->load->model('ref_unit_kerja_model');
				$data['get_unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			}



			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function simpanJabatan()
	{
		if (!empty($_POST)) {
			$status = false;
			$message = '';
			$data = array();
			$cek_jabatan = $this->ref_jabatan_model->cek($_POST);
			if ($cek_jabatan) {
				$status = false;
				$message = 'Jabatan Sudah Terdaftar';
			} else {
				$insert = $this->ref_jabatan_model->insert_ref($_POST);
				if ($insert) {
					$status = true;
					$data = array('id_jabatan' => $insert);
				}
			}
			echo json_encode(array('status' => $status, 'message' => $message, 'data' => $data));
		}
	}

	public function get_unit_kerja_by_skpd($id_skpd)
	{
		$get = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
		echo '<option value="0">Pilih Unit Kerja</option>';
		foreach ($get as $g) {
			echo '<option value="' . $g->id_unit_kerja . '">' . $g->nama_unit_kerja . '</option>';
		}
	}


	public function get_jabatan_by_skpd($id_skpd)
	{
		$get = $this->ref_jabatan_model->get_by_id_skpd($id_skpd);
		echo '<option value="">Pilih Jabatan</option>';
		foreach ($get as $g) {
			echo '<option value="' . $g->id_jabatan . '">' . $g->nama_jabatan . '</option>';
		}
	}


	public function get_pegawai_by_skpd($id_skpd)
	{
		$get = $this->master_pegawai_model->get_by_id_skpd($id_skpd);
		echo '<option value="0">Pilih Pegawai</option>';
		foreach ($get as $g) {
			echo '<option value="' . $g->id_pegawai . '"><br>' . $g->nip . ' : ' . $g->nama_lengkap . ' - ' . $g->jabatan . '</option>';
		}
	}


	public function get_jabatan_by_unit_kerja($id_unit_kerja)
	{
		$get = $this->ref_skpd_model->get_jabatan_by_unit_kerja($id_unit_kerja);
		echo '<option value="0">Pilih Jabatan</option>';
		foreach ($get as $g) {
			echo '<option value="' . $g->id_jabatan . '">' . $g->nama_jabatan . '</option>';
		}
	}

	public function getFromMaster()
	{
		$nip_master = $_POST['nip_master'];
		$data = $this->pegawai_model->getFromMaster($nip_master);
		print(json_encode($data));
	}
	public function get_pegawai_for_pengajuan()
	{
		$nip_baru = $_POST['nip_baru'];
		$data = $this->pegawai_model->get_pegawai_for_pengajuan($nip_baru);
		print(json_encode($data));
	}


	public function getDetailJabatan($id_jabatan)
	{
		$get = $this->ref_jabatan_model->get_by_id($id_jabatan);
		echo json_encode($get);
	}

	public function pensiunkan($id_pegawai, $pensiun)
	{
		$this->db->update('pegawai', array('pensiun' => $pensiun), array('id_pegawai' => $id_pegawai));
		echo true;
	}

	// public function register_sigeol($id_pegawai){
	// $this->db->update('user', array('is_expired' => 1,'sigeol'=>1), array('id_pegawai' => $id_pegawai));
	// echo true;
	// }


	public function action_esign_cloud($id_pegawai, $aktif)
	{
		if ($aktif == "Y" || $aktif == "N") {
			if ($aktif == "Y") {
				$status_aktif = "Y";
			} else {
				$status_aktif = NULL;
			}
			$this->db->update('pegawai', array('ttd_cloud' => $status_aktif), array('id_pegawai' => $id_pegawai));
			echo true;
		}
	}


	public function delete($id)
	{
		if ($this->user_id) {
			$this->master_pegawai_model->delete($id);
			redirect('master_pegawai');
		} else {
			redirect('home');
		}
	}

	public function reg_account()
	{
		$this->load->model('user_model');
		$id_pegawai = $_POST['id_pegawai'];

		// $this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id($id_pegawai);
		$cek_username = $this->user_model->cek_username($_POST['username']);
		$cek_user = $this->pegawai_model->cek_user($id_pegawai);

		if (cekForm($_POST) == TRUE) {
			echo json_encode(array("status" => FALSE, "message" => "Masih ada form yang kosong"));
		} elseif ($_POST['password'] !== $_POST['c_password']) {
			echo json_encode(array("status" => FALSE, "message" => "Konfirmasi Password tidak sama"));
		} elseif ($cek_username == FALSE) {
			echo json_encode(array("status" => FALSE, "message" => "Username sudah terdaftar"));
		} elseif ($cek_user) {
			echo json_encode(array("status" => FALSE, "message" => "pegawai ini telah didaftarkan"));
		} else {
			$this->user_model->username = $_POST['username'];
			$this->user_model->full_name = $detail->nama_lengkap;
			$this->user_model->password = $_POST['password'];
			$this->user_model->user_picture = 'user_default.png';
			$this->user_model->user_status = 'Active';
			$this->user_model->user_level = 2;
			$this->user_model->id_pegawai = $id_pegawai;
			$this->user_model->user_privileges = '';
			$this->user_model->unit_kerja_id = $detail->id_unit_kerja;
			$this->user_model->id_skpd = $detail->id_skpd;
			$insert = $this->user_model->insert();
			$data = array('id_user' => $insert);
			$update = $this->pegawai_model->update($data, $id_pegawai);
			echo json_encode(array("status" => TRUE));
		}
	}


	public function mutasi()
	{
		if ($this->user_id) {
			$this->load->model('ref_unit_kerja_model');
			$this->load->model('ref_skpd_model');
			$data['title'] = "Master_Pegawai - Admin ";
			$data['content'] = "master_pegawai/mutasi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai';
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->db->not_like('nama_jabatan', 'guru', false);
			$data['jabatan'] = $this->db->get('ref_jabatan_baru')->result();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function posisi()
	{
		if ($this->user_id) {
			$this->load->model('ref_unit_kerja_model');
			$this->load->model('ref_skpd_model');
			$data['title'] = "Posisi - Admin ";
			$data['content'] = "master_pegawai/posisi";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai/posisi';
			$data['skpd'] = $this->ref_skpd_model->get_all();


			$bulan = date("m");
			$tahun = date("Y");

			//var_dump( $this->session->userdata("id_pegawai"));
			$id_skpd = 0;

			if ($this->input->get("bulan")) {
				$bulan = $this->input->get("bulan", true);
			}

			if ($this->input->get("id_skpd_filter")) {
				$id_skpd = $this->input->get("id_skpd_filter", true);
			}

			if ($this->input->get("tahun")) {
				$tahun = $this->input->get("tahun", true);
			}

			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$this->db->not_like('nama_jabatan', 'guru', false);
			$data['jabatan'] = $this->db->get('ref_jabatan_baru')->result();


			if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian', $this->array_privileges)) {
				$id_skpd = $this->session->userdata('id_skpd');
				$data['skpd'] = array();
				$data['skpd'][] = $this->ref_skpd_model->get_by_id($id_skpd);
				$all_skpd = false;
			} else {
				$id_skpd = $id_skpd;
				$all_skpd = true;
			}

			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['all_skpd'] = $all_skpd;

			if ($id_skpd !== '') {
				$data['selected_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
			} else {
				$data['selected_skpd'] = array();
			}
			// print_r($data['selected_skpd']);die;
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_jabatan_baru($id_skpd = '', $id_unit_kerja = '', $selected_jabatan = '')
	{

		$detail_skpd = $this->db->get_where('ref_skpd', array('id_skpd' => $id_skpd))->row();
		$this->db->group_start();
		$this->db->or_where('ref_jabatan_baru.id_skpd', $id_skpd);
		$this->db->or_where('ref_jabatan_baru.id_skpd', $detail_skpd->id_skpd_induk);
		$this->db->group_end();
		if (!empty($id_unit_kerja)) {
			$this->db->where('id_unit_kerja', $id_unit_kerja);
		}
		$jabatan = $this->db->get('ref_jabatan_baru')->result();
		$list = array();
		$list = '<option value="">Pilih Jabatan</option>';
		foreach ($jabatan as $k => $j) {
			$selected = '';
			if ($selected_jabatan !== '') {
				$selected = $j->id_jabatan == $selected_jabatan ? ' selected' : null;
			}
			$list .= '<option value="' . $j->id_jabatan . '"' . $selected . '>' . $j->nama_jabatan . '</option>';
		}
		$res = array('list' => $list);
		echo json_encode($res);
	}

	public function get_detail_jabatan($id_jabatan)
	{
		$get = $this->db->get_where('ref_jabatan_baru', array('id_jabatan' => $id_jabatan))->row();
		echo json_encode($get);
	}

	public function fetch_pegawai($id_pegawai = '')
	{
		if ($id_pegawai !== '') {
			echo json_encode($this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->row());
		}
	}

	public function insert_mutasi()
	{
		if (!empty($_POST)) {
			$pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $_POST['id_pegawai']))->row();
			$jabatan = $this->db->get_where('ref_jabatan_baru', array('id_jabatan' => $_POST['id_jabatan']))->row();
			$update = $this->db->update(
				'pegawai',
				array(
					'id_skpd' => $_POST['id_skpd'],
					'id_unit_kerja' => $_POST['id_unit_kerja'],
					'id_jabatan' => $_POST['id_jabatan'],
					'jabatan' => $jabatan->nama_jabatan,
					'id_jabatan_lama' => $pegawai->id_jabatan,
					'jenis_pegawai' => 'kepala'
				),
				array('id_pegawai' => $_POST['id_pegawai'])
			);
			if ($update) {
				$update_jabatan = $this->ref_jabatan_model->update_ref(array('grade' => $_POST['grade'], 'tpp' => $_POST['tpp'], 'id_pegawai' => $_POST['id_pegawai']), $_POST['id_jabatan']);
				$res = array('result' => 1);
			} else {
				$res = array('result' => 0);
			}
			echo json_encode($res);
		}
	}
	public function update_posisi($bulan = '', $tahun = '')
	{
		if ($bulan !== '' && $tahun !== '') {
			if (!empty($_POST)) {
				$pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $_POST['id_pegawai']))->row();
				$jabatan = $this->db->get_where('ref_jabatan_baru', array('id_jabatan' => $_POST['id_jabatan']))->row();
				$this->load->model('tpp/Tpp_perhitungan_model');
				$pajak = $this->Tpp_perhitungan_model->hitung_pajak($_POST['golongan']);

				$update = $this->db->update(
					'pegawai_posisi',
					array(
						'id_skpd' => $_POST['id_skpd'],
						'id_jabatan' => $_POST['id_jabatan'],
						'jabatan' => $jabatan->nama_jabatan,
						'grade' => $_POST['grade'],
						'tpp' => $_POST['tpp'],
						'golongan' => $_POST['golongan'],
						'pph' => $pajak
					),
					array('id_pegawai_posisi' => $_POST['id_pegawai_posisi'])
				);
				if ($update) {
					$res = array('result' => 1);
				} else {
					$res = array('result' => 0);
				}
				echo json_encode($res);
			}
		}
	}

	public function list_pegawai()
	{
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = array(
			0 => 'nip',
			1 => 'nama_lengkap',
			2 => 'ref_skpd.nama_skpd',
			3 => 'ref_unit_kerja.nama_unit_kerja',
			4 => 'jabatan'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
			$this->db->order_by('id', 'desc');
		}

		if (!empty($search)) {
			$x = 0;
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
		}
		$this->db->limit($length, $start);
		$this->db->select('*');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
		$pegawai = $this->db->get("pegawai");
		$data = array();
		$no = 1;
		foreach ($pegawai->result() as $rows) {

			$data[] = array(
				$no,
				$rows->nip,
				$rows->nama_lengkap,
				$rows->nama_skpd,
				$rows->nama_unit_kerja,
				$rows->jabatan,
				'
                <a href="javascript:void(0)" onclick="mutasi(' . $rows->id_pegawai . ')" class="btn btn-primary btn-rounded">Mutasi</a>
           '
			);
			$no++;
		}
		$total_pegawai = $this->totalPegawai();
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_pegawai,
			"recordsFiltered" => $total_pegawai,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function totalPegawai()
	{
		$query = $this->db->select("COUNT(*) as num")->get("pegawai");
		$result = $query->row();
		if (isset($result))
			return $result->num;
		return 0;
	}


	public function list_pegawai_posisi($id_skpd = '', $bulan, $tahun)
	{


		if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian', $this->array_privileges)) {
			$id_skpd = $this->session->userdata('id_skpd');
		} else {
			$id_skpd = $id_skpd;
		}

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$search = $search['value'];
		$col = 0;
		$dir = "";
		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc") {
			$dir = "desc";
		}
		$valid_columns = array(
			0 => 'nip',
			1 => 'nama_lengkap',
			2 => 'nama_skpd',
			3 => 'pegawai.jabatan'
		);
		if (!isset($valid_columns[$col])) {
			$order = null;
		} else {
			$order = $valid_columns[$col];
		}
		if ($order != null) {
			$this->db->order_by($order, $dir);
		} else {
			$this->db->order_by('id', 'desc');
		}

		if (!empty($search)) {
			$x = 0;
			$this->db->group_start();
			foreach ($valid_columns as $sterm) {
				if ($x == 0) {
					$this->db->like($sterm, $search);
				} else {
					$this->db->or_like($sterm, $search);
				}
				$x++;
			}
			$this->db->group_end();
		}
		$this->db->limit($length, $start);
		$this->db->where('pegawai_posisi.bulan', $bulan);
		$this->db->where('pegawai_posisi.tahun', $tahun);
		if (!empty($id_skpd)) {
			$this->db->group_start();
			$this->db->or_where('pegawai_posisi.id_skpd', $id_skpd);
			$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
			$this->db->group_end();
		}
		$this->db->select('pegawai_posisi.*,pegawai.nama_lengkap,pegawai.nip,ref_jabatan_baru.*,ref_skpd.*');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai');
		$this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai_posisi.id_jabatan');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai_posisi.id_skpd', 'left');
		$pegawai = $this->db->get("pegawai_posisi");
		$data = array();
		$no = 1;
		foreach ($pegawai->result() as $rows) {

			$data[] = array(
				$no,
				$rows->nip,
				$rows->nama_lengkap,
				$rows->nama_skpd,
				$rows->jabatan,
				'
                <a href="javascript:void(0)" onclick="posisi(' . $rows->id_pegawai_posisi . ')" class="btn btn-primary btn-rounded"><i class="ti-pencil"></i> Edit</a>
           '
			);
			$no++;
		}
		$total_pegawai = $this->totalPegawaiPosisi($bulan, $tahun, $id_skpd);
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_pegawai,
			"recordsFiltered" => $total_pegawai,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	public function totalPegawaiPosisi($bulan, $tahun, $id_skpd)
	{
		$this->db->where('bulan', $bulan);
		$this->db->where('tahun', $tahun);
		if (!empty($id_skpd)) {
			$this->db->group_start();
			$this->db->or_where('pegawai_posisi.id_skpd', $id_skpd);
			$this->db->or_where('ref_skpd.id_skpd_induk', $id_skpd);
			$this->db->group_end();
		}
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai_posisi.id_skpd', 'left');
		$query = $this->db->select("COUNT(*) as num")->get("pegawai_posisi");
		$result = $query->row();
		if (isset($result))
			return $result->num;
		return 0;
	}



	public function fetch_pegawai_posisi($id_pegawai_posisi = '')
	{
		if ($id_pegawai_posisi !== '') {
			$this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai');
			$this->db->select('pegawai_posisi.*,pegawai.nama_lengkap,pegawai.nip');
			echo json_encode($this->db->get_where('pegawai_posisi', array('id_pegawai_posisi' => $id_pegawai_posisi))->row());
		}
	}

	public function del_account($id_pegawai)
	{
		$this->load->model('user_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$this->user_model->user_id = $detail->id_user;
		$this->user_model->delete();
		$data = array('id_user' => 0);
		$update = $this->pegawai_model->update($data, $id_pegawai);
		echo json_encode(array("status" => TRUE));
	}

	public function reset_token($id_pegawai)
	{
		$this->load->model('user_model');
		$this->pegawai_model->id_pegawai = $id_pegawai;
		$detail = $this->pegawai_model->get_by_id();
		$id_user = $detail->id_user;
		$this->user_model->reset_token($id_user);
		echo json_encode(array("status" => TRUE));
	}
	public function reset_password($id_user)
	{
		$get = $this->db->get_where('user', array('user_id' => $id_user))->row();
		$this->db->update('user', array('password' => md5($get->username)), array('user_id' => $id_user));
		echo json_encode(array("status" => TRUE));
	}

	public function get_pegawai($nip)
	{
		$get = file_get_contents("http://simpeg.sumedangkab.go.id/api/public/pegawai?key=050610");
		$data = (array) json_decode($get);
		$key = array_search($nip, array_column($data, 'nip'));
		if (is_numeric($key)) {
			$result = (array) $data[$key];
			$result['result'] = 1;
		} else {
			$result = array('result' => 0, 'message' => 'Pegawai tidak ditemukan');
		}

		echo json_encode($result);
	}



	public function setda()
	{
		include_once(APPPATH . "third_party/Spreadsheet_Excel_Reader.php");
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
		$json = json_decode($content);
		$setda = array();
		foreach ($json as $j) {
			if ($j->unitkerja == 'Sekretariat Daerah') {
				$setda[] = $j;
			}
		}
		$pegawai = $this->db->get_where('pegawai_update', array('id_skpd' => 1))->result();
		$peg = (array) $pegawai;
		$set = (array) $setda;

		$tmp = 'es.xls';
		$z = new Spreadsheet_Excel_Reader($tmp, false);
		$jumlah_baris = $z->rowcount($sheet_index = 0);
		$berhasil = 0;
		$gagal = 0;
		for ($i = 3; $i <= $jumlah_baris; $i++) {
			$nip = $z->val($i, 2);
			$nama = $z->val($i, 3);
			$jabatan = $z->val($i, 7);
			$e_jabatan = explode(' pada ', $jabatan);
			$jabatan = $e_jabatan[0];
			$key = array_search($nip, array_column($peg, 'nip'));
			$jehehe = $peg[$key]->nama_jabatan;
			// if($jabatan!==$jehehe){
			if ($key !== 0) {
				echo "<b>" . $key . "</b> " . $nip . " - " . $nama . "<br>";
				echo $jabatan . " - " . $jehehe . "<hr>";
			}
			// }

		}
		// foreach($pegawai as $p){
		// 	$key = array_search($p->nip, array_column($set, 'nip'));
		// 	if(!is_numeric($key)){
		// 		$nip = $p->nip;
		// 		preg_match("/^19(.*?)/i", $nip,$e);
		// 		if(!empty($e)){
		// 			echo $nip." - ".$p->nama_lengkap."<br>";
		// 		}
		// 	}
		// }
		// print_r($peg);die;
		// foreach($setda as $s){
		// 	$key = array_search($s->nip, array_column($peg, 'nip'));
		// 	echo $s->nip." - ".$s->nama_lengkap." <b>".$key."</b><br>";
		// }
		// $this->db->where('pegawai_update.id_skpd',1);
		// $this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = pegawai_update.id_unit_kerja');
		// $query = $this->db->get('pegawai_update')->result();
		// foreach($query as $q){

		// 	echo $q->nip." : ".$q->nama_lengkap." - <b>".$q->nama_jabatan."</b> pada <b>".$q->nama_unit_kerja."</b><br>";
		// }
		// $this->db->where('unitkerja','Sekretariat Daerah');
		// $setda = $this->db->get('data_bkd')->result();
		// foreach($setda as $s){
		// $key = array_search($s->nip, array_column($peg, 'nip'));
		// if(!is_numeric($key)){

		// 	$jabatan = $s->nama_jabatan;
		// 	$e_jabatan = explode(' pada ', $jabatan);
		// 	$jabatan = $e_jabatan[0];

		// 	$this->db->set('nip',$s->nip);
		// 	$this->db->set('nama_lengkap',$s->nama_lengkap);
		// 	$this->db->set('jenis_pegawai','staff');
		// 	$this->db->set('id_skpd',1);
		// 	$this->db->set('id_jabatan',0);
		// 	$this->db->set('id_unit_kerja',0);
		// 	$this->db->set('nama_jabatan',$jabatan);
		// 	$this->db->set('id_user',0);
		// 	$this->db->set('kepala_skpd',NULL);
		// 	$this->db->set('foto_pegawai','user-default.png');
		// 	$this->db->set('golongan',$s->gol);
		// 	$this->db->set('pangkat',$s->pangkat);
		// 	$this->db->set('status',NULL);
		// 	$this->db->set('status_verifikasi_data','false');
		// 	$this->db->insert('pegawai_update');
		// 	echo "sukses<br>";
		// 	// echo $peg[$key]->nama_lengkap."<br>";
		// 	// echo $s->nama_lengkap."<br>";
		// }
		// }

	}

	public function kominfo()
	{
		$url = 'http://124.158.175.50/publik/public/pegawai?key=208c462feb15040fc75fcb951c74e87a7f850f97a7ee933a362edca77f7ab744';
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$kominfo = array();
		foreach ($json as $j) {
			if ($j['unitkerja'] == 'Dinas Komunikasi, Informatika, Persandian dan Statistik') {
				$kominfo[] = $j;
			}
		}
		print_r($kominfo);
	}

	public function testing()
	{
		$this->db->where('golongan is null');
		$query = $this->db->get('pegawai')->result();
		foreach ($query as $q) {
			$this->db->where('nip', $q->nip);
			$a = $this->db->get('data_bkd')->row();
			print_r($q);

			// $this->db->where('nip',$q->nip);
			// $this->db->set('golongan',$a->gol);
			// $this->db->set('pangkat',$a->pangkat);
			// $this->db->update('pegawai');
			// echo "success<br>";
		}
	}

	public function details_kepegawaian($id_pegawai = 0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai > 0) {
			$data['title'] = "Details User";
			$data['content'] = "master_pegawai/views";
			$data['user_picture'] = $this->user_picture;
			$data['foto_pegawai'] = $this->foto_pegawai;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['user_id'] = $this->id_pegawai;
			$data['active_menu'] = "dashboard_user";

			//Read
			$data['golongan'] = $this->pegawai_model->get_golongan();
			$data['gelardepan'] = $this->pegawai_model->get_gelardepan();
			$data['gelarbelakang'] = $this->pegawai_model->get_gelarbelakang();
			$data['agama'] = $this->pegawai_model->get_agama();
			$data['provinsi'] = $this->pegawai_model->get_provinsi();
			$data['kecamatan'] = $this->pegawai_model->get_kecamatan();
			$data['desa'] = $this->pegawai_model->get_desa();
			$data['kabupaten'] = $this->pegawai_model->get_kabupaten();
			$data['statusmenikah'] = $this->pegawai_model->get_statusmenikah();
			// $this->load->model('ref_jabatan_model');
			// $data['jabatan'] = $this->ref_jabatan_model->getAll(1);
			// $data['jab_level1'] = $this->ref_jabatan_model->get_all(1);
			// $data['arr_jenis_jabatan'] = $this->ref_jabatan_model->arr_jenis_jabatan;
			$data['eselon'] = $this->pegawai_model->get_eselon();
			$data['jenjangpendidikan'] = $this->pegawai_model->get_jenjangpendidikan();
			$data['tempatpendidikan'] = $this->pegawai_model->get_tempatpendidikan();
			$data['jurusan'] = $this->pegawai_model->get_jurusan();
			$data['jenisdiklat'] = $this->pegawai_model->get_jenisdiklat();
			$data['jenispenataran'] = $this->pegawai_model->get_jenispenataran();
			$data['jenisseminar'] = $this->pegawai_model->get_jenisseminar();
			$data['jeniskursus'] = $this->pegawai_model->get_jeniskursus();
			$data['unit_kerja1'] = $this->pegawai_model->get_unit_kerja();
			$data['jenispenghargaan'] = $this->pegawai_model->get_jenispenghargaan();
			$data['jenispenugasan'] = $this->pegawai_model->get_jenispenugasan();
			$data['jeniscuti'] = $this->pegawai_model->get_jeniscuti();
			$data['jenishukuman'] = $this->pegawai_model->get_jenishukuman();
			$data['jenisbahasa'] = $this->pegawai_model->get_jenisbahasa();
			$data['jenisbahasa_asing'] = $this->pegawai_model->get_jenisbahasa_asing();
			$data['data_pegawai'] = $this->pegawai_model->get_data_pegawai_by_id($id_pegawai);
			$data['data_pangkat'] = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
			$data['data_jabatan'] = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
			$data['data_pendidikan'] = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
			$data['data_diklat'] = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
			$data['data_penataran'] = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
			$data['data_seminar'] = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
			$data['data_kursus'] = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
			$data['data_unit_kerja'] = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
			$data['data_penghargaan'] = $this->pegawai_model->get_riwayat_penghargaan($id_pegawai);
			$data['data_penugasan'] = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
			$data['data_cuti'] = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
			$data['data_hukuman'] = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
			$data['pendidikan_last'] = $this->pegawai_model->get_riwayat_pendidikan($id_pegawai, 1);
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai, 1);
			$data['jabatan_last'] = $this->pegawai_model->get_riwayat_jabatan($id_pegawai, 1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai, 1);
			$data['data_bahasa'] = $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
			$data['data_bahasa_asing'] = $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
			$data['data_pernikahan'] = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
			$data['data_anak'] = $this->pegawai_model->get_riwayat_anak($id_pegawai);
			$data['data_orangtua'] = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
			$data['data_mertua'] = $this->pegawai_model->get_riwayat_mertua($id_pegawai);
			$data['jenisbahasa'] = $this->pegawai_model->get_jenisbahasa();
			$data['jenisbahasa_asing'] = $this->pegawai_model->get_jenisbahasa_asing();
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			//CREATE
			if (isset($_POST['submit_pangkat'])) {
				$this->dm->add_riwayat_pangkat_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_jabatan'])) {
				$this->dm->add_riwayat_jabatan_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pendidikan'])) {
				$this->dm->add_riwayat_pendidikan_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_diklat'])) {
				$this->dm->add_riwayat_diklat_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penataran'])) {
				$this->dm->add_riwayat_penataran_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_seminar'])) {
				$this->dm->add_riwayat_seminar_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_kursus'])) {
				$this->dm->add_riwayat_kursus_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_unit_kerja'])) {
				$this->dm->add_riwayat_unit_kerja_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penghargaan'])) {
				$this->dm->add_riwayat_penghargaan_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_penugasan'])) {
				$this->dm->add_riwayat_penugasan_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_cuti'])) {
				$this->dm->add_riwayat_cuti_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_hukuman'])) {
				$this->dm->add_riwayat_hukuman_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa'])) {
				$this->dm->add_riwayat_bahasa_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_bahasa_asing'])) {
				$this->dm->add_riwayat_bahasa_asing_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_pernikahan'])) {
				$this->dm->add_riwayat_pernikahan_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_anak'])) {
				$this->dm->add_riwayat_anak_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_orangtua'])) {
				$this->dm->add_riwayat_orangtua_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['submit_mertua'])) {
				$this->dm->add_riwayat_mertua_by_operator($id_pegawai);
				echo '<script>javascript:alert("Berhasil ditambahkan!");window.location = window.location.href;</script>';
			}

			//UPDATE
			if (isset($_POST['update_master_pegawai'])) {
				$nip = $this->input->post('nip');
				$this->dm->update_master_pegawai_by_nip($nip);
				echo '<script>javascript:alert("Berhasil diupdate!");window.location = window.location.href;</script>';
			}

			//verif
			if (isset($_POST['verif_pangkat'])) {
				$id_pangkat = $this->input->post('id_pangkat');
				$this->dm->verif_riwayat_pangkat_by_operator($id_pangkat);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_jabatan'])) {
				$id_jabatan = $this->input->post('id_jabatan');
				$this->dm->verif_riwayat_jabatan_by_operator($id_jabatan);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pendidikan'])) {
				$id_pendidikan = $this->input->post('id_pendidikan');
				$this->dm->verif_riwayat_pendidikan_by_operator($id_pendidikan);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_diklat'])) {
				$id_diklat = $this->input->post('id_diklat');
				$this->dm->verif_riwayat_diklat_by_operator($id_diklat);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penataran'])) {
				$id_penataran = $this->input->post('id_penataran');
				$this->dm->verif_riwayat_penataran_by_operator($id_penataran);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_seminar'])) {
				$id_seminar = $this->input->post('id_seminar');
				$this->dm->verif_riwayat_seminar_by_operator($id_seminar);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_kursus'])) {
				$id_kursus = $this->input->post('id_kursus');
				$this->dm->verif_riwayat_kursus_by_operator($id_kursus);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_unit_kerja'])) {
				$id_unit_kerja = $this->input->post('id_unit_kerja');
				$this->dm->verif_riwayat_unit_kerja_by_operator($id_unit_kerja);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penghargaan'])) {
				$id_penghargaan = $this->input->post('id_penghargaan');
				$this->dm->verif_riwayat_penghargaan_by_operator($id_penghargaan);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_penugasan'])) {
				$id_penugasan = $this->input->post('id_penugasan');
				$this->dm->verif_riwayat_penugasan_by_operator($id_penugasan);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_cuti'])) {
				$id_cuti = $this->input->post('id_cuti');
				$this->dm->verif_riwayat_cuti_by_operator($id_cuti);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_hukuman'])) {
				$id_hukuman = $this->input->post('id_hukuman');
				$this->dm->verif_riwayat_hukuman_by_operator($id_hukuman);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa'])) {
				$id_bahasa = $this->input->post('id_bahasa');
				$this->dm->verif_riwayat_bahasa_by_operator($id_bahasa);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_bahasa_asing'])) {
				$id_bahasa_asing = $this->input->post('id_bahasa_asing');
				$this->dm->verif_riwayat_bahasa_asing_by_operator($id_bahasa_asing);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_pernikahan'])) {
				$id_pernikahan = $this->input->post('id_pernikahan');
				$this->dm->verif_riwayat_pernikahan_by_operator($id_pernikahan);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_anak'])) {
				$id_anak = $this->input->post('id_anak');
				$this->dm->verif_riwayat_anak_by_operator($id_anak);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_orangtua'])) {
				$id_orangtua = $this->input->post('id_orangtua');
				$this->dm->verif_riwayat_orangtua_by_operator($id_orangtua);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['verif_mertua'])) {
				$id_mertua = $this->input->post('id_mertua');
				$this->dm->verif_riwayat_mertua_by_operator($id_mertua);
				echo '<script>javascript:alert("Berhasil diverifikasi!");window.location = window.location.href;</script>';
			}

			//catat
			if (isset($_POST['catat_pangkat'])) {
				$id_pangkat = $this->input->post('id_pangkat');
				$this->dm->catat_riwayat_pangkat_by_operator($id_pangkat);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_jabatan'])) {
				$id_jabatan = $this->input->post('id_jabatan');
				$this->dm->catat_riwayat_jabatan_by_operator($id_jabatan);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pendidikan'])) {
				$id_pendidikan = $this->input->post('id_pendidikan');
				$this->dm->catat_riwayat_pendidikan_by_operator($id_pendidikan);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_diklat'])) {
				$id_diklat = $this->input->post('id_diklat');
				$this->dm->catat_riwayat_diklat_by_operator($id_diklat);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penataran'])) {
				$id_penataran = $this->input->post('id_penataran');
				$this->dm->catat_riwayat_penataran_by_operator($id_penataran);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_seminar'])) {
				$id_seminar = $this->input->post('id_seminar');
				$this->dm->catat_riwayat_seminar_by_operator($id_seminar);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_kursus'])) {
				$id_kursus = $this->input->post('id_kursus');
				$this->dm->catat_riwayat_kursus_by_operator($id_kursus);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_unit_kerja'])) {
				$id_unit_kerja = $this->input->post('id_unit_kerja');
				$this->dm->catat_riwayat_unit_kerja_by_operator($id_unit_kerja);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penghargaan'])) {
				$id_penghargaan = $this->input->post('id_penghargaan');
				$this->dm->catat_riwayat_penghargaan_by_operator($id_penghargaan);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_penugasan'])) {
				$id_penugasan = $this->input->post('id_penugasan');
				$this->dm->catat_riwayat_penugasan_by_operator($id_penugasan);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_cuti'])) {
				$id_cuti = $this->input->post('id_cuti');
				$this->dm->catat_riwayat_cuti_by_operator($id_cuti);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_hukuman'])) {
				$id_hukuman = $this->input->post('id_hukuman');
				$this->dm->catat_riwayat_hukuman_by_operator($id_hukuman);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa'])) {
				$id_bahasa = $this->input->post('id_bahasa');
				$this->dm->catat_riwayat_bahasa_by_operator($id_bahasa);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_bahasa_asing'])) {
				$id_bahasa_asing = $this->input->post('id_bahasa_asing');
				$this->dm->catat_riwayat_bahasa_asing_by_operator($id_bahasa_asing);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_pernikahan'])) {
				$id_pernikahan = $this->input->post('id_pernikahan');
				$this->dm->catat_riwayat_pernikahan_by_operator($id_pernikahan);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_anak'])) {
				$id_anak = $this->input->post('id_anak');
				$this->dm->catat_riwayat_anak_by_operator($id_anak);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_orangtua'])) {
				$id_orangtua = $this->input->post('id_orangtua');
				$this->dm->catat_riwayat_orangtua_by_operator($id_orangtua);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['catat_mertua'])) {
				$id_mertua = $this->input->post('id_mertua');
				$this->dm->catat_riwayat_mertua_by_operator($id_mertua);
				echo '<script>javascript:alert("Catatan berhasil dikirim!");window.location = window.location.href;</script>';
			}

			//DELETE
			if (isset($_POST['delete_pangkat'])) {
				$id_pangkat = $this->input->post('id_pangkat');
				$this->dm->delete_riwayat_pangkat_by_id($id_pangkat);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_jabatan'])) {
				$id_jabatan = $this->input->post('id_jabatan');
				$this->dm->delete_riwayat_jabatan_by_id($id_jabatan);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_pendidikan'])) {
				$id_pendidikan = $this->input->post('id_pendidikan');
				$this->dm->delete_riwayat_pendidikan_by_id($id_pendidikan);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_diklat'])) {
				$id_diklat = $this->input->post('id_diklat');
				$this->dm->delete_riwayat_diklat_by_id($id_diklat);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penataran'])) {
				$id_penataran = $this->input->post('id_penataran');
				$this->dm->delete_riwayat_penataran_by_id($id_penataran);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_seminar'])) {
				$id_seminar = $this->input->post('id_seminar');
				$this->dm->delete_riwayat_seminar_by_id($id_seminar);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_kursus'])) {
				$id_kursus = $this->input->post('id_kursus');
				$this->dm->delete_riwayat_kursus_by_id($id_kursus);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_unit_kerja'])) {
				$id_unit_kerja = $this->input->post('id_unit_kerja');
				$this->dm->delete_riwayat_unit_kerja_by_id($id_unit_kerja);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penghargaan'])) {
				$id_penghargaan = $this->input->post('id_penghargaan');
				$this->dm->delete_riwayat_penghargaan_by_id($id_penghargaan);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_penugasan'])) {
				$id_penugasan = $this->input->post('id_penugasan');
				$this->dm->delete_riwayat_penugasan_by_id($id_penugasan);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_cuti'])) {
				$id_cuti = $this->input->post('id_cuti');
				$this->dm->delete_riwayat_cuti_by_id($id_cuti);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_hukuman'])) {
				$id_hukuman = $this->input->post('id_hukuman');
				$this->dm->delete_riwayat_hukuman_by_id($id_hukuman);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_bahasa'])) {
				$id_bahasa = $this->input->post('id_bahasa');
				$this->dm->delete_riwayat_bahasa_by_id($id_bahasa);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_bahasa_asing'])) {
				$id_bahasa_asing = $this->input->post('id_bahasa_asing');
				$this->dm->delete_riwayat_bahasa_asing_by_id($id_bahasa_asing);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_pernikahan'])) {
				$id_pernikahan = $this->input->post('id_pernikahan');
				$this->dm->delete_riwayat_pernikahan_by_id($id_pernikahan);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_anak'])) {
				$id_anak = $this->input->post('id_anak');
				$this->dm->delete_riwayat_anak_by_id($id_anak);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_orangtua'])) {
				$id_orangtua = $this->input->post('id_orangtua');
				$this->dm->delete_riwayat_orangtua_by_id($id_orangtua);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			if (isset($_POST['delete_mertua'])) {
				$id_mertua = $this->input->post('id_mertua');
				$this->dm->delete_riwayat_mertua_by_id($id_mertua);
				echo '<script>javascript:alert("Berhasil dihapus!");window.location = window.location.href;</script>';
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function verifikasi_data_pegawai($id_pegawai = 0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai > 0) {

			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/verifikasi_data_pegawai";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = 'master_pegawai';

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function mass_reset()
	{
		if ($this->user_id) {

			$data['title'] = "Master Pegawai - Admin ";
			$data['content'] = "master_pegawai/mass_reset";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['active_menu'] = 'master_pegawai';
			$data['user_level'] = $this->user_level;
			$data['skpd'] = $this->ref_skpd_model->get_all();



			if (!empty($_POST)) {
				$cek = $_POST;
				if (cekForm($cek)) {
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				} else {
					$list_nip = $_POST['list_nip'];
					$list_nip = explode("\n", $list_nip);
					$result = array();
					foreach ($list_nip as $nip) {
						$nip = trim($nip);
						if ($nip !== '') {
							$cek_username = $this->user_model->cek_username($nip);

							if ($cek_username) {
								$status = 'warning';
								$text = 'NIP / Username tidak ditemukan';
							} else {
								$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
								$get = $this->db->get_where('user', array('username' => $nip))->row();


								if ($get) {
									if ($this->user_level !== 'Administrator') {
										if ($this->session->userdata('id_skpd') == $get->id_skpd) {
											$check_skpd = true;
										} else {
											$check_skpd = false;
										}
									} else {
										$check_skpd = true;
									}
									if ($check_skpd) {
										$this->db->update('user', array('password' => md5($get->username), 'api_key' => NULL, 'app_token' => NULL), array('username' => $nip));
										$status = 'success';
										$text = 'Berhasil direset';
									} else {
										$status = 'warning';
										$text = 'NIP / Username tidak ditemukan pada SKPD';
									}
								} else {
									$status = 'danger';
									$text = 'Terjadi kesalahan';
								}
							}

							$result[] = array('username' => $nip, 'status' => $status, 'text' => $text);
						}
					}

					$data['result'] = $result;

					// $this->master_pegawai_model->ceknip($_POST['nip']);
					// $in = $this->master_pegawai_model->insert($insert);
					// $data['message'] = 'Pegawai berhasil ditambahkan';
					// $data['type'] = 'success';
				}
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function testCmd()
	{
		$this->load->library('Cmdbuild');
		$token = $this->cmdbuild->getByUsername('ayuditya');
		var_dump($token);
	}
}