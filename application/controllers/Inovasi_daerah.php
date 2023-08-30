<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inovasi_daerah extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('sikomplit/inovasi_daerah_model', 'iim');
		$this->load->model('sikomplit/parameter_penilaian_indeks_inovasi_model', 'ppiim');
		$this->load->model('ref_skpd_model', 'rsm');
		$this->load->model('buka_tutup_form_model', 'btfm');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->id_skpd = $this->user_model->id_skpd;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->form_setting = $this->btfm->get_by_slug('inovasi');
		$this->load->library('pdf');


		if ($this->user_level == "Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Inovasi Daerah - Admin ";
			$data['content']	= "sikomplit/inovasi_daerah/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "inovasi_daerah";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$array_privileges = explode(';', $this->user_privileges);

			// $data['sklm'] = $this->sklm->get_first();
			$data['status_form'] = $this->form_setting;
			$data['skpd'] = $this->rsm->get_all(['skpd', 'kecamatan', 'kelurahan']);
			$filter = array();
			if (isset($_POST['filter'])) {
				$filter = $_POST;
				unset($filter['filter']);
			}
			$this->iim->id_skpd = $this->id_skpd;
			if ($this->user_level == 'Administrator' || in_array('admin_indeks_inovasi', $array_privileges)) {
				$this->iim->id_skpd = null;
			}
			$this->iim->status_kirim = null;
			if (in_array('admin_indeks_inovasi', $array_privileges)) {
				$this->iim->status_kirim = 'Y';
			}
			$data['list'] = $this->iim->get_inovasi_daerah($filter);
			$data['inisiatif'] = $this->iim->get_inovasi_daerah(['tahapan' => 'Inisiatif']);
			$data['ujicoba'] = $this->iim->get_inovasi_daerah(['tahapan' => 'Uji Coba']);
			$data['penerapan'] = $this->iim->get_inovasi_daerah(['tahapan' => 'Penerapan']);

			if (isset($_POST['setting-form'])) {

				$insert['tanggal_mulai'] = $_POST['tanggal_mulai'];
				$insert['tanggal_tutup'] = $_POST['tanggal_tutup'];

				if ($this->btfm->update('inovasi', $insert)) {
					return redirect('inovasi_daerah', 'refresh');
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function add()
	{
		if ($this->user_id) {
			$data['title']		= "Tambah Inovasi Daerah - Admin ";
			$data['content']	= "sikomplit/inovasi_daerah/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "inovasi_daerah";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);
			$status_form = $this->form_setting;

			$date = date('Y-m-d');
			if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}


			if ($data['user_level'] == 'Administrator' || in_array('admin_indeks_inovasi', $data['user_privileges']) || in_array('indeks_inovasi', $data['user_privileges'])) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}

			// $data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all(['skpd', 'kecamatan', 'kelurahan']);
			// $data['column'] = $this->iim->get_column_name();

			if (isset($_POST['submit'])) {
				$this->load->helper(array('form', 'url'));

				$this->load->library('form_validation');

				if ($data['user_level'] == 'Administrator' || in_array('admin_indeks_inovasi', $data['user_privileges'])) {
					$this->form_validation->set_rules('id_skpd', 'Perangkat Daerah', 'required');
					$insert['id_skpd'] = $this->input->post('id_skpd');
				} else {
					$insert['id_skpd'] = $this->id_skpd;
				}
				$this->form_validation->set_rules('nama', 'Nama Inovasi', 'required');
				$this->form_validation->set_rules('tahapan', 'Tahapan Inovasi', 'required');
				$this->form_validation->set_rules('inisiator', 'Inisiator Inovasi', 'required');
				$this->form_validation->set_rules('jenis', 'Jenis Inovasi', 'required');
				$this->form_validation->set_rules('bentuk', 'Bentuk Inovasi', 'required');
				$this->form_validation->set_rules('urusan', 'Urusan Inovasi', 'required');
				$this->form_validation->set_rules('waktu_ujicoba', 'Waktu Uji Coba Inovasi', 'required');
				$this->form_validation->set_rules('waktu_implementasi', 'Waktu Implementasi Coba Inovasi', 'required');
				$this->form_validation->set_rules('rancang_bangun', 'Rancang Bangun Inovasi', 'required|min_length[1000]');
				$this->form_validation->set_rules('tujuan', 'Tujuan Inovasi', 'required');
				$this->form_validation->set_rules('manfaat', 'Manfaat Inovasi', 'required');
				$this->form_validation->set_rules('hasil', 'Hasil Inovasi', 'required');


				if ($this->form_validation->run() != FALSE) {
					$word_count = str_word_count($this->input->post('rancang_bangun'));
					if ($word_count < 300) {
						$this->session->set_flashdata('rancang_bangun_error', 'Rancang bangun minimal 300 kata');
						redirect('inovasi_daerah/add');
						die;
					}
					$insert['nama'] = $this->input->post('nama');
					$insert['nama_desa'] = $this->input->post('nama_desa');
					$insert['tahapan'] = $this->input->post('tahapan');
					$insert['inisiator'] = $this->input->post('inisiator');
					$insert['jenis'] = $this->input->post('jenis');
					$insert['bentuk'] = $this->input->post('bentuk');
					$insert['urusan'] = $this->input->post('urusan');
					$insert['waktu_ujicoba'] = $this->input->post('waktu_ujicoba');
					$insert['waktu_implementasi'] = $this->input->post('waktu_implementasi');
					$insert['rancang_bangun'] = $this->input->post('rancang_bangun');
					$insert['tujuan'] = $this->input->post('tujuan');
					$insert['manfaat'] = $this->input->post('manfaat');
					$insert['hasil'] = $this->input->post('hasil');

					if (!empty($_FILES['anggaran_file']['name'])) {
						$config = array(
							'allowed_types' => 'jpg|jpeg|png|pdf',
							'max_size'      => 10000,
							'overwrite'     => FALSE,
							'upload_path' 	=> './data/inovasi_daerah/'
						);
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('anggaran_file')) {
							$error[] = $this->upload->display_errors();
							$insert['anggaran_file'] = $file_name;
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['anggaran_file'] = $file_name;
						}
					}
					if (!empty($_FILES['profile_file']['name'])) {
						$config = array(
							'allowed_types' => 'ppt|xls|doc|pdf',
							'max_size'      => 10000,
							'overwrite'     => FALSE,
							'upload_path' 	=> './data/inovasi_daerah/'
						);
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('profile_file')) {
							$error[] = $this->upload->display_errors();
							$insert['profile_file'] = $file_name;
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['profile_file'] = $file_name;
						}
					}
					$insert['no_register'] = uniqid();

					//Create QR Code
					$this->load->library('ciqrcode'); //pemanggilan library QR CODE

					$config_qr['cacheable']    = true; //boolean, the default is true
					$config_qr['cachedir']     = './data/inovasi_daerah/'; //string, the default is application/cache/
					$config_qr['errorlog']     = './data/inovasi_daerah/'; //string, the default is application/logs/
					$config_qr['imagedir']     = './data/inovasi_daerah/qr/'; //direktori penyimpanan qr code
					$config_qr['quality']      = true; //boolean, the default is true
					$config_qr['size']         = '1024'; //interger, the default is 1024
					$config_qr['black']        = array(224, 255, 255); // array, default is array(255,255,255)
					$config_qr['white']        = array(70, 130, 180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config_qr);

					$insert['qr_code'] = $insert['no_register'] . '.png'; //buat name dari qr code sesuai dengan nim

					$params_qr['data'] = $insert['no_register']; //data yang akan di jadikan QR CODE
					$params_qr['level'] = 'H'; //H=High
					$params_qr['size'] = 10;
					$params_qr['savename'] = FCPATH . $config_qr['imagedir'] . $insert['qr_code']; //simpan image QR CODE ke folder assets/images/
					$this->ciqrcode->generate($params_qr); // fungsi untuk generate QR CODE

					$insert['creator'] = $this->user_id;
					$insert['created_at'] = date('Y-m-d H:i:s');

					if ($this->iim->insert($insert)) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Terimakasih sudah mengisi, inputan anda berhasil terekam di sistem.');
						redirect('inovasi_daerah');
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function edit($id)
	{
		if ($this->user_id) {

			$data['title']		= "Ubah Inovasi Daerah - Admin ";
			$data['content']	= "sikomplit/inovasi_daerah/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "inovasi_daerah";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$status_form = $this->form_setting;

			$date = date('Y-m-d');
			if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}

			// $data['sklm'] = $this->sklm->get_first();
			$data['skpd'] = $this->rsm->get_all(['skpd', 'kecamatan', 'kelurahan']);
			$data['detail'] = $this->iim->get_inovasi_daerah_by_id($id);
			// $data['column'] = $this->iim->get_column_name();

			if ($data['user_level'] == 'Administrator' || in_array('admin_indeks_inovasi', $data['user_privileges']) || in_array('indeks_inovasi', $data['user_privileges'])) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}

			if (in_array('indeks_inovasi', $data['user_privileges'])) {
				if ($data['detail']->id_skpd != $this->id_skpd) {
					redirect('inovasi_daerah');
					die;
				}
			}

			if (isset($_POST['submit'])) {
				$this->load->helper(array('form', 'url'));

				$this->load->library('form_validation');

				if ($data['user_level'] == 'Administrator' || in_array('admin_indeks_inovasi', $data['user_privileges'])) {
					$this->form_validation->set_rules('id_skpd', 'Perangkat Daerah', 'required');
					$insert['id_skpd'] = $this->input->post('id_skpd');
				} else {
					$insert['id_skpd'] = $this->id_skpd;
				}
				$this->form_validation->set_rules('nama', 'Nama Inovasi', 'required');
				$this->form_validation->set_rules('tahapan', 'Tahapan Inovasi', 'required');
				$this->form_validation->set_rules('inisiator', 'Inisiator Inovasi', 'required');
				$this->form_validation->set_rules('jenis', 'Jenis Inovasi', 'required');
				$this->form_validation->set_rules('bentuk', 'Bentuk Inovasi', 'required');
				$this->form_validation->set_rules('urusan', 'Urusan Inovasi', 'required');
				$this->form_validation->set_rules('waktu_ujicoba', 'Waktu Uji Coba Inovasi', 'required');
				$this->form_validation->set_rules('waktu_implementasi', 'Waktu Implementasi Coba Inovasi', 'required');
				$this->form_validation->set_rules('rancang_bangun', 'Rancang Bangun Inovasi', 'required|min_length[1000]');
				$this->form_validation->set_rules('tujuan', 'Tujuan Inovasi', 'required');
				$this->form_validation->set_rules('manfaat', 'Manfaat Inovasi', 'required');
				$this->form_validation->set_rules('hasil', 'Hasil Inovasi', 'required');


				if ($this->form_validation->run() != FALSE) {
					$word_count = str_word_count($this->input->post('rancang_bangun'));
					if ($word_count < 300) {
						$this->session->set_flashdata('rancang_bangun_error', 'Rancang bangun minimal 300 kata');
						redirect(current_url());
						die;
					}
					$insert['nama'] = $this->input->post('nama');
					$insert['nama_desa'] = $this->input->post('nama_desa');
					$insert['tahapan'] = $this->input->post('tahapan');
					$insert['inisiator'] = $this->input->post('inisiator');
					$insert['jenis'] = $this->input->post('jenis');
					$insert['bentuk'] = $this->input->post('bentuk');
					$insert['urusan'] = $this->input->post('urusan');
					$insert['waktu_ujicoba'] = $this->input->post('waktu_ujicoba');
					$insert['waktu_implementasi'] = $this->input->post('waktu_implementasi');
					$insert['rancang_bangun'] = $this->input->post('rancang_bangun');
					$insert['tujuan'] = $this->input->post('tujuan');
					$insert['manfaat'] = $this->input->post('manfaat');
					$insert['hasil'] = $this->input->post('hasil');

					if (!empty($_FILES['anggaran_file']['name'])) {
						$config = array(
							'allowed_types' => 'ppt|xls|doc|pptx|xlsx|docx|pdf',
							'max_size'      => 10000,
							'overwrite'     => FALSE,
							'upload_path' 	=> './data/inovasi_daerah/'
						);
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('anggaran_file')) {
							$error[] = $this->upload->display_errors();
							print_r($error);
							die;
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['anggaran_file'] = $file_name;
						}
					}
					if (!empty($_FILES['profile_file']['name'])) {
						$config = array(
							'allowed_types' => 'ppt|xls|doc|pptx|xlsx|docx|pdf',
							'max_size'      => 10000,
							'overwrite'     => FALSE,
							'upload_path' 	=> './data/inovasi_daerah/'
						);
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('profile_file')) {
							$error[] = $this->upload->display_errors();
							print_r($error);
							die;
						} else {
							$file_name = $this->upload->data('file_name');
							$insert['profile_file'] = $file_name;
						}
					}

					$insert['no_register'] = uniqid();

					//Create QR Code
					$this->load->library('ciqrcode'); //pemanggilan library QR CODE

					$config_qr['cacheable']    = true; //boolean, the default is true
					$config_qr['cachedir']     = './data/inovasi_daerah/'; //string, the default is application/cache/
					$config_qr['errorlog']     = './data/inovasi_daerah/'; //string, the default is application/logs/
					$config_qr['imagedir']     = './data/inovasi_daerah/qr/'; //direktori penyimpanan qr code
					$config_qr['quality']      = true; //boolean, the default is true
					$config_qr['size']         = '1024'; //interger, the default is 1024
					$config_qr['black']        = array(224, 255, 255); // array, default is array(255,255,255)
					$config_qr['white']        = array(70, 130, 180); // array, default is array(0,0,0)
					$this->ciqrcode->initialize($config_qr);

					$insert['qr_code'] = $insert['no_register'] . '.png'; //buat name dari qr code sesuai dengan nim

					$params_qr['data'] = $insert['no_register']; //data yang akan di jadikan QR CODE
					$params_qr['level'] = 'H'; //H=High
					$params_qr['size'] = 10;
					$params_qr['savename'] = FCPATH . $config_qr['imagedir'] . $insert['qr_code']; //simpan image QR CODE ke folder assets/images/
					$this->ciqrcode->generate($params_qr); // fungsi untuk generate QR CODE

					// print_r($insert);die;
					if ($this->iim->update($insert, $id)) {
						$this->session->set_flashdata('success', '<i class="ti-check"></i> Data berhasil diubah.');
						redirect('inovasi_daerah');
					}
				}
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function indikator($id)
	{
		if ($this->user_id) {
			$data['title']		= "Indikator Penilaian Inovasi - Admin ";
			$data['content']	= "sikomplit/inovasi_daerah/indikator";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "inovasi_daerah";
			$data['id_pegawai'] = $this->id_pegawai;
			$data['id_skpd'] = $this->id_skpd;
			$data['user_id'] = $this->user_id;
			$data['user_privileges'] = explode(';', $this->user_privileges);

			$data['detail'] = $this->iim->get_inovasi_daerah_by_id($id);
			$data['indikator'] = $this->ppiim->get_parameter_penilaian_indeks_inovasi();
			$data['total_skor'] = $this->ppiim->get_total_skor($id);

			if ($data['user_level'] == 'Administrator' || in_array('admin_indeks_inovasi', $data['user_privileges']) || in_array('indeks_inovasi', $data['user_privileges'])) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}

			if (in_array('indeks_inovasi', $data['user_privileges'])) {
				if ($data['detail']->id_skpd != $this->id_skpd) {
					redirect('inovasi_daerah');
					die;
				}
			}

			if (isset($_POST['kematangan'])) {
				$update['kematangan'] = $_POST['kematangan'];
				$update['id_penilai'] = $this->user_id;
				if ($this->iim->update_kematangan($id, $update)) {
					$this->session->set_flashdata('success', '<i class="ti-check"></i> Skor verifikasi berhasil diperbaharui.');
					redirect('inovasi_daerah/indikator/' . $id);
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function tambah_skor()
	{
		header('Content-Type: application/json');

		$data['data'] = $_POST;
		$data['data']['created_at'] = date('Y-m-d H:i:s');
		if ($data['data']['type'] == 'document') {

			if (!empty($_FILES['file']['name'])) {
				$config = array(
					'allowed_types' => 'jpg|jpeg|png|pdf|doc|ppt',
					'max_size'      => 10000,
					'overwrite'     => FALSE,
					'upload_path' 	=> './data/skor_penilaian/'
				);
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file')) {
					$error[] = $this->upload->display_errors();
					return print_r($error);
					die;
				} else {
					$file_name = $this->upload->data('file_name');
					$data['data']['isi'] = $file_name;
				}
			}
		} else {
			$data['data']['isi'] = $data['data']['file'];
			unset($data['data']['file']);
		}
		$check = $this->ppiim->get_skor_parameter_by($_POST['id_inovasi_daerah'], $_POST['id_parameter_penilaian']);
		if ($check) {
			if (file_exists('./data/skor_penilaian/' . $check[0]->isi)) {
				unlink('./data/skor_penilaian/' . $check[0]->isi);
			}
			$this->ppiim->delete_skor($_POST['id_inovasi_daerah'], $_POST['id_parameter_penilaian']);
		}

		unset($data['data']['type']);

		if ($this->ppiim->insert_skor($data['data'])) {
			$skor = $this->ppiim->get_total_skor($_POST['id_inovasi_daerah']);
			$data['total_skor'] = $skor->total;
			if ($_POST['type'] == 'document') {
				$data['data']['link'] = base_url('data/skor_penilaian/' . $file_name);
			} else {
				$data['data']['link'] = $data['data']['isi'];
			}
			$data['tipe'] = $_POST['type'];
			$data['status'] = 'berhasil';
		} else {
			$data['total_skor'] = 0;
			$data['status'] = 'gagal';
		}

		echo json_encode($data);
	}

	public function kirim($id)
	{
		if ($this->user_id) {

			$status_form = $this->form_setting;

			$date = date('Y-m-d');
			if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) {
				null;
			} else {
				redirect('inovasi_daerah');
				die;
			}

			$insert['status_kirim'] = 'Y';

			if ($this->iim->update($insert, $id)) {
				$this->session->set_flashdata('success', '<i class="ti-check"></i> Proposal telah terkirim.');
				redirect('inovasi_daerah');
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function delete($id)
	{
		if ($this->user_id) {

			$data['detail'] = $this->iim->get_inovasi_daerah_by_id($id);
			$parameter = $this->ppiim->get_skor_parameter_by_inovasi($id);

			foreach ($parameter as $key => $v) {
				if (file_exists('./data/skor_penilaian/' . $v->isi)) {
					unlink('./data/skor_penilaian/' . $v->isi);
				}
				$this->ppiim->delete_skor($id, $v->id);
			}

			if (file_exists('./data/inovasi_daerah/' . $detail['anggaran_file'])) {
				unlink('./data/inovasi_daerah/' . $detail['anggaran_file']);
			}

			if (file_exists('./data/inovasi_daerah/' . $detail['profile_file'])) {
				unlink('./data/inovasi_daerah/' . $detail['profile_file']);
			}

			if ($this->iim->delete($id)) {
				redirect('inovasi_daerah');
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function update_sklm($id)
	{
		if ($this->user_id) {

			$data['detail'] = $this->sklm->get_by_id($id);

			if ($data['detail']->status == 'Y') {
				$status = 'N';
			} else {
				$status = 'Y';
			}

			if ($this->sklm->update_status_sklm($id, $status)) {
				redirect('inovasi_daerah');
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function updateFormStatus($id)
	{
		if ($this->user_id) {

			$data['detail'] = $this->btfm->get_by_id($id);

			if ($data['detail']->status == 'Y') {
				$status = 'N';
			} else {
				$status = 'Y';
			}

			if ($this->btfm->update_status($id, $status)) {
				redirect('inovasi_daerah');
				die;
			}
		} else {
			redirect('admin');
		}
	}

	// public function ubah($id)
	// {
	// 	if ($this->user_id)
	// 	{
	// 		if ($id == "") {
	// 			redirect('pengumuman');
	// 		}
	// 		$data['title']		= "Edit Inovasi Daerah - Admin ";
	// 		$data['content']	= "sikomplit/inovasi_daerah/edit" ;
	// 		$data['user_picture'] = $this->user_picture;
	// 		$data['full_name']		= $this->full_name;
	// 		$data['user_level']		= $this->user_level;
	// 		$data['active_menu'] = "inovasi_daerah";
	// 		$data['id_pegawai'] = $this->id_pegawai;
	// 		$data['id_skpd'] = $this->id_skpd;
	// 		$this->load->model('ref_skpd_model');
	// 		$data['skpd'] = $this->ref_skpd_model->get_all();

	// 		if(isset($_POST['update'])){
	// 			$this->iim->update($_POST, $id);
	// 			$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
	// 			redirect("inovasi_daerah");
	// 		}
	// 		$data['pengumuman'] = $this->iim->get_by_id($id);
	// 		if(empty($data['pengumuman'])){
	// 			show_404();
	// 		}
	// 		if($this->user_level!=="Administrator"){
	// 			if($data['pengumuman']->id_pegawai!==$this->id_pegawai){
	// 				show_404();
	// 			}
	// 		}
	// 		$this->load->view('admin/index',$data);

	// 	}
	// 	else
	// 	{
	// 		redirect('admin');
	// 	}
	// }


	public function detail($id)
	{
		if ($this->user_id) {
			if ($id == "") {
				redirect('inovasi_daerah');
			}
			$data['title']		= "Detail Inovasi Daerah - Admin ";
			$data['content']	= "sikomplit/inovasi_daerah/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "inovasi_daerah";

			$data['detail'] = $this->iim->get_inovasi_daerah_by_id($id);
			$data['total_skor'] = $this->ppiim->get_total_skor($id);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	// public function delete($id){
	// 	$detail = $this->iim->get_by_id($id);
	// 	if ($detail->) {
	// 		# code...
	// 	}

	// 	$this->iim->delete($id);
	// 	$this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
	// 	redirect("inovasi_daerah");
	// }

	// public function randomize(){
	// 	$this->db->limit(6);
	// 	$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

	// 	$array_pegawai = $pegawai;

	// 	$menilaian = array();
	// 	$count = array();
	// 	$apr = array();

	// 	foreach($pegawai as $p){
	// 		$list_menilai = array();
	// 		$apr = $array_pegawai;
	// 		// print_r($apr);

	// 		while(count($list_menilai)!=4){
	// 			if (count($apr)==0) {
	// 				break;
	// 			}

	// 			$random = array_rand($apr);
	// 			$menilai = $pegawai[$random];

	// 			if (!isset($pegawai[$random])) {
	// 				echo $random;
	// 				print_r($pegawai[$random]);die();
	// 				break;
	// 			}

	// 			if (!array_key_exists($random, $count)) {
	// 				$count[$random] = 0;
	// 			}

	// 			if ($menilai->id_pegawai!=$p->id_pegawai) {
	// 				if (!in_array($menilai->id_pegawai, $list_menilai)) {
	// 					unset($apr[$random]);
	// 					$list_menilai[] = $menilai->id_pegawai;
	// 					$count[$random]++;
	// 					if ($count[$random]==4) {
	// 						unset($array_pegawai[$random]);
	// 					}
	// 				} else {
	// 					unset($apr[$random]);
	// 				}
	// 			} else {
	// 				unset($apr[$random]);
	// 			}
	// 		}

	// 		$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

	// 	}

	// 	echo "<pre>";
	// 	print_r($menilaian);
	// }

	// public function randomize2(){
	// 	$this->db->limit(5);
	// 	$pegawai = $this->db->get_where('pegawai',array('id_skpd'=>16,'pensiun'=>0))->result();

	// 	$menilaian = array();

	// 	foreach($pegawai as $p){
	// 		$list_menilai = array();

	// 		$selected = array();

	// 		while(count($list_menilai)!=4){

	// 			// if(in_array($list_menilai))

	// 			$menilai = $pegawai[rand(0,count($pegawai)-1)];

	// 			$selected[] = $menilai->id_pegawai;
	// 			if(count($selected)==count($pegawai)){
	// 				break;
	// 			}

	// 			if(!in_array($menilai->id_pegawai,$list_menilai)){
	// 				if($menilai->id_pegawai!==$p->id_pegawai){

	// 					$count = 0;
	// 					foreach($menilaian as $pp){
	// 						foreach($pp['menilai'] as $pe){
	// 							if($menilai->id_pegawai==$pe){
	// 								$count++;
	// 							}
	// 						}
	// 					}						

	// 					if($count!=4){
	// 						// echo $count;
	// 						$list_menilai[] = $menilai->id_pegawai;
	// 					}
	// 				}
	// 			}

	// 		}

	// 		$menilaian[] = array('id_pegawai'=>$p->id_pegawai,'menilai'=>$list_menilai);

	// 	}

	// 	print_r($menilaian);
	// }

	public function pdf($id)
	{
		$detail = $this->iim->get_inovasi_daerah_by_id($id);
		$skor = $this->ppiim->get_total_skor($id);
		$indikator = $this->ppiim->get_parameter_penilaian_indeks_inovasi();

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setPrintFooter(false);
		$pdf->setPrintHeader(false);
		$pdf->SetTitle($detail->nama_skpd . '_' . time());
		$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		$pdf->AddPage('');
		$pdf->Write(0, 'SIKOMPLIT', '', 0, 'L', true, 0, false, false, 0);
		$pdf->SetFont('');

		$tabel = '
        <table border="0">
              <tr>
                    <th colspan="2"> <h2>Laporan Inovasi Daerah</h2> </th>
                    <th rowspan="3"><img src="' . base_url('data/inovasi_daerah/qr/' . $detail->qr_code) . '" width="300" height="300"/></th>
              </tr>
			  <br>
              <tr>
                    <td><b>SKPD :</b> </td>
                    <td>' . $detail->nama_skpd . '</td>
					<td></td>
              </tr>
              <tr>
                    <td><b>Nomor Registrasi :</b> </td>
                    <td>' . $detail->no_register . '</td>
					<td></td>
              </tr>
        </table>
		<br>
		<b>1. PROFIL INOVASI</b>
		<br>
		<b><small>1.1 NAMA INOVASI</small></b>
		<div><small>' . $detail->nama . '</small></div>
		<b><small>1.2 Dibuat Oleh</small></b>
		<div><small>' . $detail->full_name . '</small></div>
		<b><small>1.3 Tahapan Inovasi</small></b>
		<div><small>' . $detail->tahapan . '</small></div>
		<b><small>1.4 Inisiator Inovasi</small></b>
		<div><small>' . $detail->inisiator . '</small></div>
		<b><small>1.5 Jenis Inovasi</small></b>
		<div><small>' . $detail->jenis . '</small></div>
		<b><small>1.6 Bentuk Inovasi</small></b>
		<div><small>' . $detail->bentuk . '</small></div>
		<b><small>1.7 Urusan Inovasi</small></b>
		<div><small>' . $detail->urusan . '</small></div>
		<b><small>1.8 Rancang Bangun dan Pokok Perubahan Ynag Dilakukan</small></b>
		<div><small>' . $detail->rancang_bangun . '</small></div>
		<b><small>1.9 Tujuan Inovasi</small></b>
		<div><small>' . $detail->tujuan . '</small></div>
		<b><small>1.10 Manfaat Inovasi</small></b>
		<div><small>' . $detail->manfaat . '</small></div>
		<b><small>1.11 Hasil Inovasi</small></b>
		<div><small>' . $detail->hasil . '</small></div>
		<b><small>1.12 Waktu Ujicoba</small></b>
		<div><small>' . $detail->waktu_ujicoba . '</small></div>
		<b><small>1.13 Waktu Implementasi</small></b>
		<div><small>' . $detail->waktu_implementasi . '</small></div>
		<b><small>1.14 Anggaran</small></b>
		<div><small>' . $detail->anggaran_file . '</small></div>
		<b><small>1.15 Profile Bisnis</small></b>
		<div><small>' . $detail->profile_file . '</small></div>
		<b><small>1.16 Kematangan</small></b>
		<div><small>' . $detail->kematangan . '</small></div>
		<hr>
		<br>
		<br>
		<br>
		<b>2. INDIKATOR INOVASI</b>
		<br>
		<br>
		<table border="1" cellpadding="5">
			<thead>
				<tr>
					<th><b><small>No.</small></b></th>
					<th><b><small>Indikator SPD</small></b></th>
					<th><b><small>Informasi</small></b></th>
					<th><b><small>Bukti Dukung</small></b></th>
				</tr>
			</thead>
			<tbody>
				';
		$no = 1;
		foreach ($indikator as $key => $v) {
			$skor = $this->ppiim->get_skor_parameter_by($id, $v->id);
			if ($skor) {
				$isi = $skor[0]->isi;
				if ($skor[0]->parameter == 1) {
					$parameter = $v->parameter_pertama;
				} elseif ($skor[0]->parameter == 2) {
					$parameter = $v->parameter_kedua;
				} elseif ($skor[0]->parameter == 3) {
					$parameter = $v->parameter_ketiga;
				}
			} else {
				$parameter = '-';
				$isi = '-';
			}
			$tabel .= '<tr>
						<td><small>' . $no++ . '</small></td>
						<td><small>' . $v->indikator . '</small></td>
						<td><small>' . $parameter . '</small></td>
						<td><small>' . $isi . '</small></td>
					</tr>';
		}


		$tabel .=	'</tbody>
		</table>
		';
		$pdf->writeHTML($tabel);
		ob_clean();
		$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'data/inovasi_daerah/' . $detail->nama_skpd . '_' . time() . '.pdf', 'FI');
	}
}
