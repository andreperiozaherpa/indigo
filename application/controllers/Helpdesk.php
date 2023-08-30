<?php
class Helpdesk extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->load->model('dashboard_model');
		$this->load->model('helpdesk_model');
		$this->load->model('user_model');
		$this->load->model('absen_model');
		$this->load->model('pegawai_posisi_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->user_privileges = $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title'] = "Helpdesk - " . app_name;
			$data['content'] = "helpdesk/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "helpdesk";

			if (!empty($_POST)) {
				$filter = $_POST;
				$subjek = $_POST["subjek"];
				$status = $_POST["status"];
				$data['filter'] = true;
				$data['subjek'] = $_POST['subjek'];
				$data['status'] = $_POST['status'];
			} else {
				$subjek = '';
				$status = '';
				$data['filter'] = false;
			}
			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			if ($this->user_level == "Administrator") {
				$total = count($this->helpdesk_model->get_all_helpdesk($subjek, $status));
			} elseif (in_array('kepegawaian', $this->array_privileges)) {
				$total = count($this->helpdesk_model->get_all_by_skpd($subjek, $status, $this->session->userdata('id_skpd')));
			} else {
				$total = count($this->helpdesk_model->get_all_by_user($subjek, $status, $this->user_id));
			}
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if ($this->user_level == "Administrator") {
				$data['list'] = $this->helpdesk_model->get_page_helpdesk($mulai, $hal, $subjek, $status);
			} elseif (in_array('kepegawaian', $this->array_privileges)) {
				$data['list'] = $this->helpdesk_model->get_by_skpd($mulai, $hal, $subjek, $status, $this->session->userdata('id_skpd'));
			} else {
				$data['list'] = $this->helpdesk_model->get_by_user($mulai, $hal, $subjek, $status, $this->user_id);
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function add()
	{
		if ($this->user_id) {
			$data['title'] = "Buat Bantuan - " . app_name;
			$data['content'] = "helpdesk/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "helpdesk";
			if (!empty($_POST)) {
				if ($_POST['subjek'] == '' && $_POST['kategori'] == '' && $_POST['isi'] == '') {
					$data['type'] = 'warning';
					$data['message'] = 'Masih ada form yang kosong';
				} else {
					$insert = $_POST;
					unset($insert['_wysihtml5_mode']);
					$insert['id_user'] = $this->session->userdata('id_user');
					$insert['jam_laporan'] = date('H:i:s');
					$insert['tgl_laporan'] = date('Y-m-d');
					$insert['status'] = 'menunggu_respon';
					$in = $this->helpdesk_model->insert_helpdesk($insert);
					$no_bantuan = str_pad($in, 4, '0', STR_PAD_LEFT);
					$up = $this->helpdesk_model->update_helpdesk(array('no_bantuan' => $no_bantuan), $in);

					$this->load->library('upload');
					$number_of_files_uploaded = count($_FILES['file']['name']);
					for ($i = 0; $i < $number_of_files_uploaded; $i++) {
						if (!empty($_FILES['file']['name'][$i])) {
							$_FILES['userfile']['name'] = $_FILES['file']['name'][$i];
							$_FILES['userfile']['type'] = $_FILES['file']['type'][$i];
							$_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
							$_FILES['userfile']['error'] = $_FILES['file']['error'][$i];
							$_FILES['userfile']['size'] = $_FILES['file']['size'][$i];
							$config = array(
								'allowed_types' => 'jpg|jpeg|png|doc|docx|ppt|pptx|txt|xls|xlsx|pdf',
								'max_size' => 3000,
								'overwrite' => FALSE,
								'upload_path' => './data/helpdesk/'
							);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload()) {
								$error[] = $this->upload->display_errors();
							} else {
								$file_name = $this->upload->data()['file_name'];
								$insert_file = array('id_helpdesk' => $in, 'file' => $file_name);
								$this->helpdesk_model->insert_helpdesk_file($insert_file);
							}
						}
					}

					if (isset($error)) {
						if (!empty($error)) {
							$message = '';
							foreach ($error as $e) {
								$message .= $e;
							}
							$this->helpdesk_model->delete_helpdesk($in);
							$data['type'] = 'danger';
							$data['message'] = $message;
						}
					} else {

						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', '<i class="ti-check"></i> Permintaan bantuan berhasil dibuat, silahkan cek secara berkala status bantuan anda');
						redirect('helpdesk');
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function ubah($id_helpdesk)
	{
		if ($this->user_id) {
			if ($id_helpdesk) {
				redirect("helpdesk");
			}
			$data['title'] = "Buat Bantuan - " . app_name;
			$data['content'] = "helpdesk/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "helpdesk";
			$data['detail'] = $this->helpdesk_model->get_by_id($id_helpdesk);
			if (empty($data['detail'])) {
				show_404();
			}
			if ($this->user_level !== "Administrator") {
				if (!in_array('kepegawaian', $this->array_privileges) || $data['detail']->id_user !== $this->user_id) {
					show_404();
				}
			}
			$data['lampiran'] = $this->helpdesk_model->get_lampiran($id_helpdesk);

			if (!empty($_POST)) {
				if ($_POST['subjek'] == '' && $_POST['kategori'] == '' && $_POST['isi'] == '') {
					$data['type'] = 'warning';
					$data['message'] = 'Masih ada form yang kosong';
				} else {
					$insert = $_POST;
					unset($insert['_wysihtml5_mode']);
					$insert['id_user'] = $this->session->userdata('id_user');
					$insert['jam_laporan'] = date('H:i:s');
					$insert['tgl_laporan'] = date('Y-m-d');
					$insert['status'] = 'menunggu_respon';
					$in = $this->helpdesk_model->insert_helpdesk($insert);
					$no_bantuan = str_pad($in, 4, '0', STR_PAD_LEFT);
					$up = $this->helpdesk_model->update_helpdesk(array('no_bantuan' => $no_bantuan), $in);

					$this->load->library('upload');
					$number_of_files_uploaded = count($_FILES['file']['name']);
					for ($i = 0; $i < $number_of_files_uploaded; $i++) {
						if (!empty($_FILES['file']['name'][$i])) {
							$_FILES['userfile']['name'] = $_FILES['file']['name'][$i];
							$_FILES['userfile']['type'] = $_FILES['file']['type'][$i];
							$_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
							$_FILES['userfile']['error'] = $_FILES['file']['error'][$i];
							$_FILES['userfile']['size'] = $_FILES['file']['size'][$i];
							$config = array(
								'allowed_types' => 'jpg|jpeg|png|doc|docx|ppt|pptx|txt|xls|xlsx|pdf',
								'max_size' => 3000,
								'overwrite' => FALSE,
								'upload_path' => './data/helpdesk/'
							);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload()) {
								$error[] = $this->upload->display_errors();
							} else {
								$file_name = $this->upload->data()['file_name'];
								$insert_file = array('id_helpdesk' => $in, 'file' => $file_name);
								$this->helpdesk_model->insert_helpdesk_file($insert_file);
							}
						}
					}

					if (isset($error)) {
						if (!empty($error)) {
							$message = '';
							foreach ($error as $e) {
								$message .= $e;
							}
							$this->helpdesk_model->delete_helpdesk($in);
							$data['type'] = 'danger';
							$data['message'] = $message;
						}
					} else {

						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', '<i class="ti-check"></i> Permintaan bantuan berhasil dibuat, silahkan cek secara berkala status bantuan anda');
						redirect('helpdesk');
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($id_helpdesk)
	{
		if ($this->user_id) {
			if ($id_helpdesk == "") {
				redirect("helpdesk");
			}
			$data['title'] = "Detail Helpdesk - " . app_name;
			$data['content'] = "helpdesk/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "helpdesk";
			$data['detail'] = $this->helpdesk_model->get_by_id($id_helpdesk);
			$data['privileges'] = $this->array_privileges;

			$jenis_skpd = '';
			if ($this->user_level !== 'Administrator' && $this->user_level !== 'Operator') {
				$jenis_skpd = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'))->jenis_skpd;
			}
			$data['jenis_skpd'] = $jenis_skpd;
			if (empty($data['detail'])) {
				show_404();
			}
			if ($this->user_level !== "Administrator") {
				if (!in_array('kepegawaian', $this->array_privileges) && $data['detail']->id_user !== $this->user_id) {
					show_404();
				}
			}
			$data['shift'] = $this->db->get('absen_shift')->result();
			$data['lampiran'] = $this->helpdesk_model->get_lampiran($id_helpdesk);
			$data['respons'] = $this->helpdesk_model->get_respons($id_helpdesk);

			if (isset($_POST['respons'])) {
				$this->helpdesk_model->respons($id_helpdesk, $this->user_id);
				echo '<script>javascript:alert("Komentar berhasil di tambahkan");window.location = window.location.href;</script>';
			}

			if (isset($_POST['hapusRespons'])) {
				$this->helpdesk_model->deleteRespons($this->input->post('id_helpdesk_respons'), $id_helpdesk);
				echo '<script>javascript:alert("Komentar berhasil di hapus");window.location = window.location.href;</script>';
			}

			if (isset($_POST['tutup'])) {
				$this->helpdesk_model->close($id_helpdesk);
				echo '<script>javascript:alert("Berhasil ditutup!");window.location = window.location.href;</script>';
			}

			if (isset($_POST['prosess'])) {
				$this->helpdesk_model->prosess($id_helpdesk);
				echo '<script>javascript:alert("Status berhasil diupdate!");window.location = window.location.href;</script>';
			}

			if (isset($_POST['selesai'])) {
				$this->helpdesk_model->solved($id_helpdesk);
				echo '<script>javascript:alert("Berhasil diselesaikan!");window.location = window.location.href;</script>';
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function get_pegawai()
	{
		if ($this->user_id) {
			$search = $_GET['search'];
			$this->db->like('nip', $search);
			$this->db->or_like('nama_lengkap', $search);
			if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian', $this->array_privileges)) {
				$id_skpd = $this->session->userdata('id_skpd');
			} else {
				$id_skpd = '';
			}
			$jabatan = $this->pegawai_posisi_model->get_posisi($id_skpd, '', '');
			$list = array();
			foreach ($jabatan as $k => $j) {
				$list[$k]['id'] = $j->id_pegawai;
				$list[$k]['text'] = $j->nama_lengkap . " - " . $j->nip;
			}
			echo json_encode($list);
		} else {
			redirect('admin');
		}
	}
	public function get_shift($id_shift = '')
	{
		if ($this->user_id) {
			if ($id_shift == '') {
				$res = array('status' => false);
			} else {
				$get_shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
				if ($get_shift) {
					$res = $get_shift;
					$res->status = true;
				} else {
					$res = array('status' => false);
				}
			}
			echo json_encode($res);
		} else {
			redirect('admin');
		}
	}

	// public function get_shift($id_pegawai = '',$tanggal='')
	// {
	// 	if ($this->user_id) {
	// 		if ($id_pegawai == '') {
	// 			$res = array('status' => false);
	// 		} else {
	// 			$id_shift = 1;
	// 			$get = $this->db->get_where('absen_log',['id_pegawai'=>$id_pegawai,'tanggal'=>$tanggal])->row();
	// 			if($get){
	// 				if(!empty($get->id_shift)){
	// 					$id_shift = $get->id_shift;
	// 				}
	// 			}
	// 			$setting = $this->db->get_where('absen_shift_setting', array('absen_shift_setting.id_pegawai' => $id_pegawai))->row();
	// 			if($setting){
	// 				$id_shift = $setting->aktif_shift;
	// 			}

	// 			$get_shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
	// 			if ($get_shift) {
	// 				$res = $get_shift;
	// 				$res->status = true;
	// 			} else {
	// 				$res = array('status' => false);
	// 			}
	// 		}
	// 		echo json_encode($res);
	// 	} else {
	// 		redirect('admin');
	// 	}
	// }

	public function simpanKoreksi($id_helpdesk)
	{
		if (!empty($_POST)) {
			$this->load->model("tpp/Tpp_model");
			$id_pegawai = $_POST['id_pegawai'];
			$id_shift = $_POST['id_shift'];
			$tanggal = $_POST['tanggal'];

			$cek = $this->absen_model->if_absen_exist($tanggal, $id_pegawai);
			$data_koreksi = array();
			if ($cek) {
				// $jam_masuk = !empty($cek->jam_masuk) ? $cek->jam_masuk : $_POST['jam_masuk'];
				// $jam_pulang = !empty($cek->jam_pulang) ? $cek->jam_pulang : $_POST['jam_pulang'];
				$jam_masuk = $_POST['jam_masuk'];
				$jam_pulang = $_POST['jam_pulang'];
				$data_update = array('jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang, 'id_shift' => $id_shift);
				$data_update['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk, $tanggal, $id_shift);
				$data_update['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang, $tanggal, $id_shift);
				$data_update['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang, $tanggal, $id_shift);
				$up = $this->db->update('absen_log', $data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
				$data_koreksi[] = array_merge($data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
			} else {
				$jam_masuk = $_POST['jam_masuk'];
				$jam_pulang = $_POST['jam_pulang'];
				$data_insert = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal, 'jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang, 'id_shift' => $id_shift);
				$data_insert['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk, $tanggal, $id_shift);
				$data_insert['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang, $tanggal, $id_shift);
				$data_insert['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang, $tanggal, $id_shift);
				$in = $this->db->insert('absen_log', $data_insert);
				$data_koreksi[] = $data_insert;
			}


			$param = array(
				'id_pegawai' => $id_pegawai,
				'bulan' => date("m", strtotime($tanggal)),
				'tahun' => date("Y", strtotime($tanggal)),
				'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
			);
			$this->Tpp_model->simpan($param);

			$param_tap = array(
				'id_pegawai' => $id_pegawai,
				'bulan' => date("m", strtotime($tanggal)),
				'tahun' => date("Y", strtotime($tanggal)),
				'id_ket_log' => "A3", //Tidak Absen Pulang
			);
			$this->Tpp_model->simpan($param_tap);


			// $param_tk5 = array(
			// 	'id_pegawai'  => $id_pegawai,
			// 	'bulan'       => date("m", strtotime($tanggal)),
			// 	'tahun'       => date("Y", strtotime($tanggal)),
			// 	'id_ket_log'  => "A4", //Tanpa Keterangan lebih dari 5 hari
			// );
			// $this->Tpp_model->simpan($param_tk5);
			// echo $id_pegawai;die;

			//Hapus Tanpa Keterangan
			$this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
			foreach ($data_koreksi as $d) {
				$cek_koreksi = $this->db->get_where('absen_koreksi', array('id_helpdesk' => $id_helpdesk, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal']))->num_rows();
				if ($cek_koreksi > 0) {
					$this->db->update('absen_koreksi', array('jam_masuk' => $d['jam_masuk'], 'jam_pulang' => $d['jam_pulang']), array('id_helpdesk' => $id_helpdesk, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal']));
				} else {
					$this->db->insert('absen_koreksi', array('id_helpdesk' => $id_helpdesk, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal'], 'jam_masuk' => $d['jam_masuk'], 'jam_pulang' => $d['jam_pulang']));
				}
			}
		}
	}

	public function checkAbsensi($id_pegawai, $tanggal)
	{
		$cek = $this->absen_model->if_absen_exist($tanggal, $id_pegawai);
		if ($cek) {
			$res = $cek;
			$res->status = true;
		} else {
			$res = array('status' => false);
		}
		echo json_encode($res);
	}
}