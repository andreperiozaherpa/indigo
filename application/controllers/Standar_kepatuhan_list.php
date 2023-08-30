<?php
class Standar_kepatuhan_list extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('standar_kepatuhan_list_model', 'sklm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Standar Kepatuhan - " . app_name;
			$data['content']	= "standar_kepatuhan_list/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_list";

			$data['list'] = $this->sklm->get_all();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function add()
	{
		if ($this->user_id) {
			$data['title']		= "Standar Kepatuhan - " . app_name;
			$data['content']	= "standar_kepatuhan_list/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_list";
			if (!empty($_POST)) {
				if ($_POST['judul'] == '' && $_POST['kategori'] == '' && $_POST['isi'] == '') {
					$data['type'] = 'warning';
					$data['message'] = 'Masih ada form yang kosong';
				} else {
					$insert = $_POST;
					unset($insert['_wysihtml5_mode']);
					$insert['id_user'] = $this->session->userdata('id_user');
					$insert['created_at'] = date('Y-m-d');
					$insert['status'] = 'N';
					$in = $this->sklm->insert_standar_kepatuhan_list($insert);

					if ($in) {
						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', '<i class="ti-check"></i> Permintaan bantuan berhasil dibuat, silahkan cek secara berkala tahun bantuan anda');
						redirect('standar_kepatuhan_list');
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function ubah($id_standar_kepatuhan_list)
	{
		if ($this->user_id) {
			if ($id_standar_kepatuhan_list) {
				redirect("standar_kepatuhan_list");
			}
			$data['title']		= "Buat Bantuan - " . app_name;
			$data['content']	= "standar_kepatuhan_list/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_list";
			$data['detail'] = $this->sklm->get_by_id($id_standar_kepatuhan_list);
			if (empty($data['detail'])) {
				show_404();
			}
			if ($this->user_level !== "Administrator") {
				if (!in_array('kepegawaian', $this->array_privileges) || $data['detail']->id_user !== $this->user_id) {
					show_404();
				}
			}
			$data['lampiran'] = $this->sklm->get_lampiran($id_standar_kepatuhan_list);

			if (!empty($_POST)) {
				if ($_POST['judul'] == '' && $_POST['kategori'] == '' && $_POST['isi'] == '') {
					$data['type'] = 'warning';
					$data['message'] = 'Masih ada form yang kosong';
				} else {
					$insert = $_POST;
					unset($insert['_wysihtml5_mode']);
					$insert['id_user'] = $this->session->userdata('id_user');
					$insert['jam_laporan'] = date('H:i:s');
					$insert['tgl_laporan'] = date('Y-m-d');
					$insert['tahun'] = 'menunggu_respon';
					$in = $this->sklm->insert_helpdesk($insert);
					$no_bantuan = str_pad($in, 4, '0', STR_PAD_LEFT);
					$up = $this->sklm->update_helpdesk(array('no_bantuan' => $no_bantuan), $in);

					$this->load->library('upload');
					$number_of_files_uploaded = count($_FILES['file']['name']);
					for ($i = 0; $i < $number_of_files_uploaded; $i++) {
						if (!empty($_FILES['file']['name'][$i])) {
							$_FILES['userfile']['name']     = $_FILES['file']['name'][$i];
							$_FILES['userfile']['type']     = $_FILES['file']['type'][$i];
							$_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
							$_FILES['userfile']['error']    = $_FILES['file']['error'][$i];
							$_FILES['userfile']['size']     = $_FILES['file']['size'][$i];
							$config = array(
								'allowed_types' => 'jpg|jpeg|png|doc|docx|ppt|pptx|txt|xls|xlsx|pdf',
								'max_size'      => 3000,
								'overwrite'     => FALSE,
								'upload_path' => './data/standar_kepatuhan_list/'
							);
							$this->upload->initialize($config);
							if (!$this->upload->do_upload()) {
								$error[] = $this->upload->display_errors();
							} else {
								$file_name = $this->upload->data()['file_name'];
								$insert_file = array('id_standar_kepatuhan_list' => $in, 'file' => $file_name);
								$this->sklm->insert_helpdesk_file($insert_file);
							}
						}
					}

					if (isset($error)) {
						if (!empty($error)) {
							$message = '';
							foreach ($error as $e) {
								$message .= $e;
							}
							$this->sklm->delete_helpdesk($in);
							$data['type'] = 'danger';
							$data['message'] = $message;
						}
					} else {

						$this->session->set_flashdata('type', 'success');
						$this->session->set_flashdata('message', '<i class="ti-check"></i> Permintaan bantuan berhasil dibuat, silahkan cek secara berkala tahun bantuan anda');
						redirect('helpdesk');
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($id_standar_kepatuhan_list)
	{
		if ($this->user_id) {
			if ($id_standar_kepatuhan_list == "") {
				redirect("standar_kepatuhan_list");
			}
			$data['title']		= "Detail Standar Kepatuhan - " . app_name;
			$data['content']	= "standar_kepatuhan_list/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "standar_kepatuhan_list";
			$data['detail'] = $this->sklm->get_by_id($id_standar_kepatuhan_list);
			$data['privileges'] = $this->array_privileges;
			
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}
	public function get_pegawai()
	{
		if ($this->user_id) {
			$search = $_GET['search'];
			if ($this->user_level != "Administrator") {
				$this->db->group_start();
				$this->db->where('sekarang.id_skpd', $this->session->userdata('id_skpd'));
				$this->db->or_where('lama.id_skpd', $this->session->userdata('id_skpd'));
				$this->db->group_end();
				$this->db->join('ref_jabatan_baru as sekarang','sekarang.id_jabatan = pegawai.id_jabatan');
				$this->db->join('ref_jabatan_baru as lama','lama.id_jabatan = pegawai.id_jabatan_lama');
			}
			$this->db->group_start();
			$this->db->like('nama_lengkap', $search);
			$this->db->or_like('nip', $search);
			$this->db->group_end();
			$jabatan = $this->db->get('pegawai')->result();
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

	public function get_shift($id_pegawai = '')
	{
		if ($this->user_id) {
			if ($id_pegawai == '') {
				$res = array('tahun' => false);
			} else {
				$setting = $this->db->get_where('absen_shift_setting', array('absen_shift_setting.id_pegawai' => $id_pegawai))->row();
				if($setting){
					$id_shift = $setting->id_shift;
				}else{
					$id_shift = 1;
				}
				$get_shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
				if ($get_shift) {
					$res = $get_shift;
					$res->tahun = true;
				} else {
					$res = array('tahun' => false);
				}
			}
			echo json_encode($res);
		} else {
			redirect('admin');
		}
	}

	public function simpanKoreksi($id_standar_kepatuhan_list)
	{
		if (!empty($_POST)) {
			$this->load->model("tpp/Tpp_model");
			$id_pegawai = $_POST['id_pegawai'];
			$tanggal = $_POST['tanggal'];

			$cek = $this->absen_model->if_absen_exist($tanggal, $id_pegawai);
			$data_koreksi = array();
			if ($cek) {
				// $jam_masuk = !empty($cek->jam_masuk) ? $cek->jam_masuk : $_POST['jam_masuk'];
				// $jam_pulang = !empty($cek->jam_pulang) ? $cek->jam_pulang : $_POST['jam_pulang'];
				$jam_masuk = $_POST['jam_masuk'];
				$jam_pulang = $_POST['jam_pulang'];
				$data_update = array('jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang,'flag'=>'H');
				$data_update['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk);
				$data_update['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang);
				$data_update['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang);
				$up = $this->db->update('absen_log', $data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
				$data_koreksi[] = array_merge($data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
			} else {
				$jam_masuk = $_POST['jam_masuk'];
				$jam_pulang = $_POST['jam_pulang'];
				$data_insert = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal, 'jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang,'flag'=>'H');
				$data_insert['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk);
				$data_insert['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang);
				$data_insert['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang);
				$in = $this->db->insert('absen_log', $data_insert);
				$data_koreksi[] = $data_insert;
			}
			

			$param = array(
				'id_pegawai'  => $id_pegawai,
				'bulan'       => date("m", strtotime($tanggal)),
				'tahun'       => date("Y", strtotime($tanggal)),
				'id_ket_log'  => "A1", //Terlambat dan Pulang Cepat
			);
			$this->Tpp_model->simpan($param);

			$param_tap = array(
				'id_pegawai'  => $id_pegawai,
				'bulan'       => date("m", strtotime($tanggal)),
				'tahun'       => date("Y", strtotime($tanggal)),
				'id_ket_log'  => "A3", //Tidak Absen Pulang
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
			$this->absen_model->delete_tanpa_keterangan($id_pegawai,$tanggal);
			foreach ($data_koreksi as $d) {
				$cek_koreksi = $this->db->get_where('absen_koreksi', array('id_standar_kepatuhan_list' => $id_standar_kepatuhan_list, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal']))->num_rows();
				if ($cek_koreksi > 0) {
					$this->db->update('absen_koreksi', array('jam_masuk' => $d['jam_masuk'], 'jam_pulang' => $d['jam_pulang']), array('id_standar_kepatuhan_list' => $id_standar_kepatuhan_list, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal']));
				} else {
					$this->db->insert('absen_koreksi', array('id_standar_kepatuhan_list' => $id_standar_kepatuhan_list, 'id_pegawai' => $d['id_pegawai'], 'tanggal' => $d['tanggal'], 'jam_masuk' => $d['jam_masuk'], 'jam_pulang' => $d['jam_pulang']));
				}
			}
		}
	}

	public function checkAbsensi($id_pegawai, $tanggal)
	{
		$cek = $this->absen_model->if_absen_exist($tanggal, $id_pegawai);
		if ($cek) {
			$res = $cek;
			$res->tahun = true;
		} else {
			$res = array('tahun' => false);
		}
		echo json_encode($res);
	}
}
