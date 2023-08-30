<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

defined('BASEPATH') or exit('No direct script access allowed');

class Surat_internal extends CI_Controller
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
		$this->load->model('surat_masuk_model');
		$this->load->model('ref_surat_model');
		$this->load->model('surat_keluar_model');
		$this->load->model('data_model');
		$this->load->model('logs_model');
		$this->load->model('notification_model');
		$this->load->model('master_pegawai_model');
		$this->load->model('permintaan_cuti/ref_jenis_cuti_model');
		$this->load->model('permintaan_cuti/permintaan_cuti_model');
		$this->load->model('permintaan_cuti/ref_persyaratan_model');
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->level_id	= $this->user_model->level_id;
		// if ($this->level_id > 2) redirect("admin");
		$sekda = $this->master_pegawai_model->get_pegawai_kepala_skpd(1);
		if ($sekda) {
			$id_pegawai_sekda = $sekda->id_pegawai;
		} else {
			$id_pegawai_sekda = 77;
		}

		$this->id_pegawai_sekda = $id_pegawai_sekda;
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
	}
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])) {
			$id_induk = $_POST['id_induk'] == 9999 ? 0 : $_POST['id_induk'];
			$data = $this->skpd_model->get_induk($id_induk);
			if (!empty($data)) $obj = "<option value='' selected>Pilih</option>";
			foreach ($data as $row) {
				$obj .= "<option value=" . $row->kd_skpd . ">" . $row->nama_skpd . "</option>";
			}
		}
		die($obj);
	}
	public function index()
	{
		if ($this->user_id) {
			show_404();
			// $data['title']		= "Surat Internal";
			// $data['content']	= "surat_internal/masuk/index" ;
			// $data['user_picture'] = $this->user_picture;
			// $data['full_name']		= $this->full_name;
			// $data['user_level']		= $this->user_level;
			// $data['active_menu'] = "surat_internal";
			//
			// $data['total_surat_masuk'] = $this->surat_masuk_model->get_total_surat_masuk();
			// $data['total_surat_dibaca'] = $this->surat_masuk_model->get_total_surat_dibaca();
			// $data['total_surat_belum_dibaca'] = $this->surat_masuk_model->get_total_surat_belum_dibaca();
			//
			// $this->load->view('admin/index',$data);

		} else {
			redirect('admin');
		}
	}


	public function view()
	{
		if ($this->user_id) {
			$data['title']		= "skpd ";
			$data['content']	= "renstra/perencanaan/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	//Surat Masuk

	public function surat_masuk($summary_field = '', $summary_value = '', $testing = '')
	{
		if ($this->user_id) {
			$summary_value = urldecode($summary_value);
			$data['title']		= "Surat Masuk Internal";
			$data['content']	= "surat_internal/masuk/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_internal($summary_field, $summary_value));
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

			$data['total'] = $this->surat_masuk_model->get_all_internal();
			$data['unread'] = $this->surat_masuk_model->get_all_internal_unread();
			$data['read'] = $this->surat_masuk_model->get_all_internal_read();
			$data['mustread'] = $this->surat_masuk_model->get_all_internal_mustread();
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}
			// if($testing=1){
			// echo "$mulai  $hal ";die;
			// }
			$data['list'] = $this->surat_masuk_model->get_page_internal($mulai, $hal, $filter, $summary_field, $summary_value, $testing);



			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_surat_masuk($id, $testing = "")
	{
		if ($this->user_id) {
			$this->filter_surat_masuk($id);

			$read = $this->notification_model->read('surat_internal/detail_surat_masuk', $id, $this->session->userdata('user_id'));
			if ($read) {
				$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
			}
			$data['title']		= "Detail Surat Masuk Internal ";
			$data['content']	= "surat_internal/masuk/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal/detail";

			$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);
			if (!empty($_POST)) {

				$post_data = $_POST;

				if (isset($post_data['unit_kerja'])) {
					$unit_kerja = $post_data['unit_kerja'];
					unset($post_data['unit_kerja']);
				} else {
					$unit_kerja = array();
				}
				if (isset($post_data['pegawai'])) {
					$pegawai = $post_data['pegawai'];
					unset($post_data['pegawai']);
				} else {
					$pegawai = array();
				}

				if (isset($post_data['skpd'])) {
					$skpd = $post_data['skpd'];
					unset($post_data['skpd']);
				} else {
					$skpd = array();
				}
				unset($post_data['instruksi']);
				$post_data['instruksi'] = implode(";", $_POST['instruksi']);

				$post_data['id_surat_masuk'] = $id;
				$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($id);
				$post_data['status_surat'] = "Belum Dibaca";
				$post_data['id_pegawai_disposisi'] = $this->session->userdata('id_pegawai');

				$delete = $this->surat_masuk_model->delete_disposisi($post_data);

				$post_data['jenis_penerima_disposisi'] = "internal";
				foreach ($pegawai as $key) {
					$expl_id = explode('-', $key);
					$post_data['id_unit_kerja'] = $expl_id[0];
					$post_data['id_pegawai'] = $expl_id[1];
					$query = $this->surat_masuk_model->add_disposisi($post_data);
					// kirim notif ke pegawai disposisi surat
					$this->load->model('user_model');
					$this->user_model->id_pegawai = $post_data['id_pegawai'];
					$usr = $this->user_model->get_by_pegawai();
					$notif_post_data = array();
					$notif_post_data['title'] = 'Disposisi Surat';
					$notif_post_data['message'] = 'Ada disposisi surat baru dengan perihal ' . $detail_surat_masuk->perihal;
					$notif_post_data['data'] = 'surat_disposisi/detail';
					$notif_post_data['data_id'] = $query;
					$notif_post_data['ntime'] = date('H:i:s');
					$notif_post_data['ndate'] = date('Y-m-d');
					$notif_post_data['user_id'] = $usr->user_id;
					$notif_post_data['category'] = 'surat_disposisi/internal';
					$this->notification_model->insert($notif_post_data);
					$notif_post_data['link'] = base_url($notif_post_data['data'] . '/' . $notif_post_data['data_id']);
					$this->socketio->send('new_notification', $notif_post_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_post_data['user_id']));
				}

				unset($post_data['id_pegawai']);
				foreach ($unit_kerja as $key) {
					$post_data['id_unit_kerja'] = $key;
					$query = $this->surat_masuk_model->add_disposisi($post_data);
				}

				unset($post_data['id_unit_kerja']);
				$post_data['jenis_penerima_disposisi'] = "eksternal";
				foreach ($skpd as $key) {
					$post_data['id_skpd'] = $key;
					$query = $this->surat_masuk_model->add_disposisi($post_data);
				}
				$data['message'] = "Surat berhasil di disposisikan";
				$data['type'] = 'success';
			}

			if ($data['detail']->id_pegawai_penerima == $this->session->userdata('id_pegawai') and (!$data['detail']->tgl_dibaca or $data['detail']->status_surat == "Belum Dibaca")) {
				$this->surat_masuk_model->baca_surat($id);
			}

			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($id);

			if ($testing == 1) {
				print_r($data['disposisi']);
				die;
			}

			$id_skpd = ($this->user_level !== "Administrator") ? $this->session->userdata('id_skpd') : $data['detail']->id_skpd_penerima;
			$this->load->model('ref_skpd_model');

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
			// $data['pegawai'][0] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja(0);
			foreach ($data['unit_kerja'] as $key => $value) {
				$data['pegawai'][$value->id_unit_kerja] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja($value->id_unit_kerja, $id_skpd);
			}
			$data['skpd'] = $this->ref_skpd_model->get_skpd_except_this_id_skpd($id_skpd);
			//echo "<pre>";print_r($data);die;

			$data['catatan_disposisi'] = array(
				'Wakili / Hadiri / Terima / Laporkan Hasilnya',
				'Agendakan / Persiapan / Koordinasi',
				'Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku',
				'Pelajari / Telaah / Sarannya',
				'Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan',
				'Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan',
				'Untuk Dijawab / Dicatat / FILE',
				'Siapkan Pointer / Sambutan / Bahan Lebih Lanjut',
				'Untuk Dibantu Sesuai Kemampuan dan Ketentuan',
				'ACC, Sesuai Ketentuan yang Berlaku',
				'ACC, Saran Saudara',
				'AMM'
			);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function add_disposisi($id_surat_masuk)
	{
		if ($this->user_id) {

			$data = $_POST;

			$unit_kerja = $data['unit_kerja'];
			unset($data['unit_kerja']);
			$pegawai = $data['pegawai'];
			unset($data['pegawai']);
			$skpd = $data['skpd'];
			unset($data['skpd']);
			unset($data['instruksi']);
			$data['instruksi'] = implode(";", $_POST['instruksi']);

			$data['id_surat_masuk'] = $id_surat_masuk;
			$data['status_surat'] = "Belum Dibaca";
			$data['id_pegawai_disposisi'] = $this->session->userdata('id_pegawai');

			$delete = $this->surat_masuk_model->delete_disposisi($data);

			$data['jenis_penerima_disposisi'] = "internal";
			foreach ($pegawai as $key) {
				$expl_id = explode('-', $key);
				$data['id_unit_kerja'] = $expl_id[0];
				$data['id_pegawai'] = $expl_id[1];
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			unset($data['id_pegawai']);
			foreach ($unit_kerja as $key) {
				$data['id_unit_kerja'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			unset($data['id_unit_kerja']);
			$data['jenis_penerima_disposisi'] = "eksternal";
			foreach ($skpd as $key) {
				$data['id_skpd'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			redirect('surat_internal/detail_surat_masuk/' . $id_surat_masuk);
		}
	}

	public function hapus_surat_masuk($home, $id)
	{
		if ($this->user_id) {

			$this->filter_surat_masuk($id);
			$this->surat_masuk_model->id_surat_masuk = $id;
			$this->surat_masuk_model->hapus_surat_masuk($id);
			redirect('surat_internal/surat_masuk/');
		} else {
			redirect('home');
		}
	}

	public function tambah_surat_masuk()
	{
		if ($this->user_id) {
			$data['title']		= "Surat internal";
			$data['content']	= "surat_internal/masuk/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function edit_surat_masuk()
	{
		if ($this->user_id) {
			$data['title']		= "Surat internal";
			$data['content']	= "surat_internal/masuk/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail_masuk()
	{
		if ($this->user_id) {
			$data['title']		= "detail Surat ";
			$data['content']	= "surat_internal/masuk/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal/detail";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	//Surat Keluar

	public function surat_keluar($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$summary_value = urldecode($summary_value);
			$data['title']		= "Surat Keluar Internal";
			$data['content']	= "surat_internal/keluar/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_internal($summary_field, $summary_value));
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
			$data['total'] = $this->surat_keluar_model->get_all_internal();
			$data['perlu_tanggapan'] = $this->surat_keluar_model->get_all_internal('status_surat', 'perlu_tanggapan');
			$data['dalam_proses'] = $this->surat_keluar_model->get_all_internal('status_surat', 'dalam_proses');
			$data['selesai'] = $this->surat_keluar_model->get_all_internal('status_surat', 'selesai');
			$list_keluar = $this->surat_keluar_model->get_page_internal($mulai, $hal, $filter, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}
			// $list_masuk = $this->surat_masuk_model->get_page_internal($mulai,$hal,$filter);
			// $data['list'] = (object) array_merge((array) $list_keluar, (array) $list_masuk);
			$data['list'] = $list_keluar;

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function kategori_surat_keluar()
	{
		if ($this->user_id) {
			$data['title']		= "Pilih Kategori Surat Keluar ";
			$data['content']	= "surat_internal/keluar/kategori";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal/kategori";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_surat_model->get_all_j('internal'));
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
			$data['list'] = $this->ref_surat_model->get_page_internal($mulai, $hal, $filter);


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function tambah_surat_keluar($id_ref_surat, $testing = 0)
	{
		if ($this->user_id) {
			$data['title']		= "Tambah Surat Keluar Internal ";
			$data['content']	= "surat_internal/keluar/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal/tambah";
			if ($id_ref_surat !== 'custom') {
				$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
				$data['field'] = $this->ref_surat_model->get_field($id_ref_surat);
				$field = $data['field'];

				$data['fe'] = $this->ref_surat_model->get_field_with_event($id_ref_surat);
			} else {
				$data['detail'] = array('nama_surat' => 'Surat Kustom');
				$data['detail'] = json_decode(json_encode($data['detail']));
			}


			if (!empty($_POST)) {

				if ($testing == 1) {
					$template = $data['detail']->template_file;
					$template_path = './data/template_surat/' . $template;
					$img_qr = get_qr_code($template_path, 0, 'jpeg');
					print_r($img_qr);
					die;
				}
				foreach ($data['field'] as $f) {
					if (!empty($f->r_value) && !empty($f->r_table)) {
						if (isset($_POST[$f->field_name])) {
							if ($f->r_value == 'id_pegawai' && $f->r_table == 'pegawai') {
								$gp = $this->db->get_where('pegawai', array('id_pegawai' => $_POST[$f->field_name]))->row();
								$_POST[$f->field_name] =  $gp->nama_lengkap;
							}
						}
					}
				}

				$not_required = array('_wysihtml5_mode', 'draft', 'download', 'tembusan_surat', 'lampiran_surat', 'jenis_sasaran_tautan', 'id_sasaran_tautan', 'id_unit_kerja_tautan', 'id_iku_tautan', 'id_renaksi_tautan', 'check_tautan');
				$cekform = isFormEmpty($not_required, $_POST);
				if ($cekform) {
					$data['type'] = 'warning';
					$data['messages'] = 'Ada form yang belum diisi';
				} else {

					if (!empty($_POST['id_sasaran_tautan']) and isset($_POST['check_tautan'])) {
						$e = explode('_', $_POST['id_sasaran_tautan']);
						$_POST['id_sasaran_tautan'] = $e[1];
						$_POST['jenis_sasaran_tautan'] = $e[0];
					} else {
						unset($_POST['id_unit_kerja_tautan']);
						unset($_POST['id_sasaran_tautan']);
						unset($_POST['id_iku_tautan']);
						unset($_POST['id_renaksi_tautan']);
						unset($_POST['jenis_sasaran_tautan']);
					}
					unset($_POST['check_tautan']);

					$insert = $_POST;
					unset($insert['tembusan_surat']);
					unset($insert['id_penerima']);
					// unset($insert['kop_surat']);
					$kop_surat = $insert['kop_surat'];
					if (isset($_POST['draft'])) {
						unset($insert['draft']);
					}
					if (isset($_POST['_wysihtml5_mode'])) {
						unset($insert['_wysihtml5_mode']);
					}
					if (isset($_POST['download'])) {
						unset($insert['download']);
					}
					$insert['tgl_buat'] = date('Y-m-d');
					$insert['tgl_surat'] = date('Y-m-d');
					$insert['id_ref_surat'] = $id_ref_surat;
					$insert['jenis_surat'] = 'internal';
					$insert['status_surat'] = 'Belum Dibaca';
					if (!empty($this->session->userdata('id_skpd'))) {
						$insert['id_skpd_pengirim'] = $this->session->userdata('id_skpd');
					} else {
						$insert['id_skpd_pengirim'] = 1;
					}
					if (!empty($this->session->userdata('id_pegawai'))) {
						$insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
					} else {
						$insert['id_pegawai_input'] = 0;
					}
					if (!empty($this->session->userdata('id_unit_kerja'))) {
						$insert['id_unit_kerja_pengirim'] = $this->session->userdata('id_unit_kerja');
					} else {
						$insert['id_unit_kerja_pengirim'] = 0;
					}
					if (isset($_POST['id_kerja_luar_kantor'])) {
						unset($insert['id_kerja_luar_kantor']);
					}
					if (isset($_POST['id_permintaan_cuti'])) {
						unset($insert['id_permintaan_cuti']);
					}

					if (!empty($_FILES['file_lampiran']['name'])) {
						$new_name = time() . $_FILES["file_lampiran"]['name'];
						$config['file_name'] = $new_name;
						$config['upload_path']          = './data/surat_internal/lampiran/';
						$config['allowed_types']        = 'doc|docx|pdf|xls|xlsx|ppt|pptx|txt|zip|rar';
						$config['max_size']				= 10 * 1024;
						$input = array();
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file_lampiran')) {
							$tmp_name = $_FILES['file_lampiran']['tmp_name'];
							if ($tmp_name != "") {
								redirect('surat_internal/tambah_surat_keluar/' . $id_ref_surat . '?error');
								die;
							}
						} else {
							$insert['file_lampiran'] = $this->upload->data('file_name');
						}
					}


					$in = $this->surat_keluar_model->insert_surat_keluar($insert);
					// print_r($in);die;
					$hash_id = generate_hash($in);
					$this->surat_keluar_model->update_surat_keluar(array('hash_id' => $hash_id), $in);
					if (isset($_POST['id_penerima'])) {
						$id_penerima = $_POST['id_penerima'];
					} else {
						$id_penerima = array();
					}
					foreach ($id_penerima as $p) {
						$this->surat_keluar_model->insert_penerima_surat(array('id_pegawai' => $p), $in, 'internal');
					}
					if (isset($_POST['tembusan_surat'])) {
						$tembusan_surat = $_POST['tembusan_surat'];
						foreach ($tembusan_surat as $t) {
							$this->surat_keluar_model->insert_tembusan_surat($t, $in);
						}
					}
					$sk = $this->surat_keluar_model->get_detail_by_id_d($in);


					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);



					if ($kop_surat == "bupati") {
						$template = $data['detail']->template_file_bupati;
					} else {
						$template = $data['detail']->template_file;
					}
					if ($kop_surat == "sekda") {
						$skpd = $this->ref_skpd_model->get_by_id(1);
					} else {
						$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);
					}

					$filename = $data['detail']->nama_surat . '_' . time() . rand(1, 9999) . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);

					$template_path = './data/template_surat/' . $template;
					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('nama_skpd', $skpd->nama_skpd);
					$template->setValue('no_telp', $skpd->telepon_skpd);
					$template->setValue('email', $skpd->email_skpd);
					$template->setValue('alamat', $skpd->alamat_skpd);
					$template->setValue('nomer_surat', $sk->nomer_surat);
					$template->setValue('nomor_registrasi', $sk->hash_id);
					$template->setValue('website', $skpd->website);
					$template->setValue('kode_pos', $skpd->kode_pos);
					$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));
					$template->setValue('dikeluarkan_di', 'Sumedang');
					$template->setValue('lampiran', ($sk->lampiran));
					$template->setValue('perihal', ($sk->perihal));
					$template->setValue('sifat_surat', ucwords($sk->sifat_surat));

					if ($id_ref_surat == 903 && isset($_POST['id_kerja_luar_kantor'])) {
						$id_kerja_luar_kantor = $_POST['id_kerja_luar_kantor'];
						$this->load->model('kerja_luar_kantor_model');
						$detail_klk = $this->kerja_luar_kantor_model->get_by_id($id_kerja_luar_kantor);
						$kepala_skpd = $this->master_pegawai_model->get_pegawai_kepala_skpd($detail_klk->id_skpd);
						$det_pegawai = $this->master_pegawai_model->get_by_id($detail_klk->id_pegawai);
						// print_r($detail_klk);die;

						$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
						$template->setValue('nama_pemberi_perintah', $pegawai_ttd->nama_lengkap);
						$template->setValue('jabatan_pemberi_perintah', $pegawai_ttd->jabatan);
						$template->setValue('nama', $det_pegawai->nama_lengkap);
						$template->setValue('nip', $det_pegawai->nip);
						$template->setValue('pangkat', $det_pegawai->pangkat);
						$template->setValue('golongan', $det_pegawai->golongan);
						$template->setValue('jabatan', $det_pegawai->jabatan);
						$template->setValue('lokasi_pekerjaan', normal_string($detail_klk->lokasi_pengerjaan));
						$template->setValue('nama_kegiatan', $detail_klk->nama_kegiatan);
						$template->setValue('tgl_awal', tanggal($detail_klk->tanggal_awal));
						$template->setValue('tgl_akhir', tanggal($detail_klk->tanggal_akhir));
						$template->setValue('target_kegiatan', $detail_klk->target_kegiatan);
						$this->kerja_luar_kantor_model->update(array('id_surat_keluar' => $in), $id_kerja_luar_kantor);
					} else if ($id_ref_surat == 905 && isset($_POST['id_permintaan_cuti'])) {
						$id_permintaan_cuti = $_POST['id_permintaan_cuti'];
						$this->load->model('kerja_luar_kantor_model');
						$template->setValue('nomor_surat', $sk->nomer_surat);
						$detail_cuti = $this->permintaan_cuti_model->get_by_id($id_permintaan_cuti);
						$kepala_skpd = $this->master_pegawai_model->get_pegawai_kepala_skpd($detail_cuti->id_skpd);
						$det_pegawai = $this->master_pegawai_model->get_by_id($detail_cuti->id_pegawai);
						// print_r($detail_klk);die;
						$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
						$template->setValue('nama_jenis_cuti_title', strtoupper($detail_cuti->nama_jenis_cuti));
						$template->setValue('nama_jenis_cuti', strtolower($detail_cuti->nama_jenis_cuti));
						$template->setValue('nama_lengkap', $det_pegawai->nama_lengkap);
						$template->setValue('nip', $det_pegawai->nip);
						$template->setValue('pangkat', $det_pegawai->pangkat);
						$template->setValue('golongan', $det_pegawai->golongan);
						$template->setValue('jabatan', $det_pegawai->jabatan);
						$template->setValue('nama_skpd', $det_pegawai->nama_skpd);
						$tgl1 = new DateTime($detail_cuti->tanggal_awal);
						$tgl2 = new DateTime($detail_cuti->tanggal_akhir);
						$jarak = $tgl2->diff($tgl1);
						$jumlah_hari = $jarak->d;
						$template->setValue('jml_hari', $jumlah_hari . " hari");
						$template->setValue('tanggal_awal', tanggal($detail_cuti->tanggal_awal));
						$template->setValue('tanggal_akhir', tanggal($detail_cuti->tanggal_akhir));
						$this->permintaan_cuti_model->update(array('id_surat_keluar' => $in), $id_permintaan_cuti);
					} else {
						if (isset($field)) {
							foreach ($field as $f) {
								$field_name = $f->field_name;
								$sk->$field_name = str_replace('’', "'", $sk->$field_name);
								$sk->$field_name = str_replace('–', "-", $sk->$field_name);
								$sk->$field_name = str_replace('<div>', ' ', $sk->$field_name);
								$sk->$field_name = str_replace('</div>', '<br>', $sk->$field_name);
								if ($f->input_type == 'textarea') {
									$parser = new \HTMLtoOpenXML\Parser();
									$field_value = $parser->fromHTML($sk->$field_name);
									$template->setValue($field_name, $field_value, null, true);
								} elseif ($f->input_type == 'date') {
									$template->setValue($field_name, tanggal($sk->$field_name));
								} else {
									$template->setValue($field_name, $sk->$field_name);
								}
							}
						}
					}

					if ($id_ref_surat !== 'custom') {
						$template->setValue('penutup', $sk->penutup);
					}

					$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
					$template->setValue('nip_ttd', $pegawai_ttd->nip);
					$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
					$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);
					$detail = $this->surat_keluar_model->get_detail_by_id($in);
					$template->setValue('tgl_surat', $sk->tgl_surat);

					$hash_id = $detail->hash_id;
					$img_qr = get_qr_code($template_path, 0, 'jpeg'); //helper/general_helper.php
					$qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/' . $hash_id);
					$template->setImageValue($img_qr, $qrcode);

					// $hash_id = $detail->hash_id;
					// $img_qr = get_qr_code($template_path,1,'jpeg');
					// $qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/not_found');
					// $template->setImageValue($img_qr, $qrcode);
					// $img_qr_footer = get_qr_code($template_path,0,'jpeg');
					// $qrcode_footer = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/not_found');
					// $template->setImageValue($img_qr_footer, $qrcode_footer);

					// $img_qr = get_qr_code($template_path,0,'jpeg');
					// $qrcode = generate_qr($detail->hash_id);
					// echo $qrcode; exit();
					// $template->setImageValue($img_qr, './data/images/blank.png');
					// $template->setImageValue($img_qr, $qrcode);

					ob_clean();
					$template->saveAs("./data/surat_internal/keluar/" . $filename);
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $in);
					if (isset($_POST['download'])) {
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename=' . $filename);
						header('Content-Transfer-Encoding: binary');
						header('Expires: 0');
						header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
						header('Pragma: public');
						header('Content-Length: ' . filesize("./data/surat_internal/keluar/" . $filename));
						flush();
						readfile("./data/surat_internal/keluar/" . $filename);
					}

					$data['type'] = 'success';
					$data['messages'] = '<i class="ti-check"></i> Surat Keluar berhasil ditambahkan, klik <a style="color:#fff;font-weight:bold" target="blank" href="' . base_url('surat_internal/detail_surat_keluar/' . $in) . '">disini</a> untuk melihat detail surat.';


					$log_data = array(
						'action' => 'membuat',
						'function' => 'surat keluar internal',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
				}
			}

			$data['skpd'] = $this->ref_skpd_model->get_all();

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($this->session->userdata('id_skpd'));
			$id_unit_kerja = $this->session->userdata('id_unit_kerja');

			$this->load->model('renja_perencanaan_model');
			$jenis = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			$data['sasaran'] = '';
			foreach ($jenis as $j => $v) {
				$name = $this->renja_perencanaan_model->name($j);
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, date('Y'));
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if (!empty($sasaran)) {
					$data['sasaran'] .= '<optgroup label="' . $v . '">';
					foreach ($sasaran as $s) {
						$data['sasaran'] .= '<option value="' . $j . '_' . $s->$cSasaran . '">' . $s->$tSasaran . '</option>';
					}
					$data['sasaran'] .= "</optgroup>";
				}
			}

			$this->load->model('master_pegawai_model');
			$id_skpd = $this->session->userdata('id_skpd');
			$d_pegawai1 = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
			$d_pegawai2 = $this->master_pegawai_model->get_by_id_skpd(33, true);
			$data['pegawai'] = array_merge($d_pegawai1, $d_pegawai2);

			$data['pegawai1'] = $this->master_pegawai_model->get_by_id($this->id_pegawai_sekda);
			$data['pegawai_tembusan'] = $this->master_pegawai_model->get_by_id_skpd(33, true);
			$data['pegawai_tembusan'][] = $data['pegawai1'];
			// print_r($data['pegawai_tembusan']);
			// $data['pegawai_tembusan'] = array_merge($data['pegawai1'],$data['pegawai_tembusan']);
			$data['id_ref_surat'] = $id_ref_surat;
			$data['skpd_pegawai'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['detail_cuti'] = false;

			$data['klk'] = false;
			if ($id_ref_surat == 903) {
				$id_kerja_luar_kantor = @$_GET['id_kerja_luar_kantor'];
				$this->load->model('kerja_luar_kantor_model');
				$data['klk'] = $this->kerja_luar_kantor_model->get_by_id($id_kerja_luar_kantor);
			} elseif ($id_ref_surat == 905) {
				$id_permintaan_cuti = @$_GET['id_permintaan_cuti'];
				$data['detail_cuti'] = $this->permintaan_cuti_model->get_by_id($id_permintaan_cuti);
			}
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function edit_surat_keluar($id_ref_surat, $id_surat_keluar)
	{
		if ($this->user_id) {
			$this->filter_surat_keluar($id_surat_keluar);
			$data['title']		= "Edit Surat Keluar Internal ";
			$data['content']	= "surat_internal/keluar/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal/surat_keluar";
			if ($id_ref_surat !== 'custom') {
				$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
				$data['field'] = $this->ref_surat_model->get_field($id_ref_surat);
				$field = $data['field'];
			} else {
				$data['detail'] = array('nama_surat' => 'Surat Kustom');
				$data['detail'] = json_decode(json_encode($data['detail']));
			}

			if (!empty($_POST)) {
				$not_required = array('_wysihtml5_mode', 'draft', 'download', 'tembusan_surat');
				$cekform = isFormEmpty($not_required, $_POST);
				if ($cekform) {
					$data['type'] = 'warning';
					$data['messages'] = 'Ada form yang belum diisi';
				} else {
					$insert = $_POST;
					unset($insert['tembusan_surat']);
					unset($insert['id_penerima']);
					if (isset($_POST['draft'])) {
						unset($insert['draft']);
					}
					if (isset($_POST['_wysihtml5_mode'])) {
						unset($insert['_wysihtml5_mode']);
					}
					if (isset($_POST['download'])) {
						unset($insert['download']);
					}
					$insert['tgl_buat'] = date('Y-m-d');
					$insert['tgl_surat'] = date('Y-m-d');
					$insert['id_ref_surat'] = $id_ref_surat;
					$insert['jenis_surat'] = 'internal';
					$insert['status_surat'] = 'Belum Dibaca';
					if (!empty($this->session->userdata('id_skpd'))) {
						$insert['id_skpd_pengirim'] = $this->session->userdata('id_skpd');
					} else {
						$insert['id_skpd_pengirim'] = 1;
					}
					if (!empty($this->session->userdata('id_pegawai'))) {
						$insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
					} else {
						$insert['id_pegawai_input'] = 0;
					}
					if (!empty($this->session->userdata('id_unit_kerja'))) {
						$insert['id_unit_kerja_pengirim'] = $this->session->userdata('id_unit_kerja');
					} else {
						$insert['id_unit_kerja_pengirim'] = 0;
					}
					$in = $this->surat_keluar_model->update_surat_keluar($insert, $id_surat_keluar);
					$id_penerima = $_POST['id_penerima'];
					$this->surat_keluar_model->delete_penerima_surat($id_surat_keluar);
					foreach ($id_penerima as $p) {
						$this->surat_keluar_model->insert_penerima_surat(array('id_pegawai' => $p), $id_surat_keluar, 'internal');
					}
					if (isset($_POST['tembusan_surat'])) {
						$tembusan_surat = $_POST['tembusan_surat'];
						$this->surat_keluar_model->delete_tembusan_surat($id_surat_keluar);
						foreach ($tembusan_surat as $t) {
							$this->surat_keluar_model->insert_tembusan_surat($t, $id_surat_keluar);
						}
					}

					$sk = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);
					$phpWord = new \PhpOffice\PhpWord\PhpWord();
					$phpWord->getCompatibility()->setOoxmlVersion(14);
					$phpWord->getCompatibility()->setOoxmlVersion(15);

					$template = $data['detail']->template_file;
					$filename = $data['detail']->nama_surat . '_' . time() . ".docx";
					$filename = str_replace(",", "", $filename);
					$filename = str_replace(" ", "_", $filename);

					$template_path = './data/template_surat/' . $template;
					$template = $phpWord->loadTemplate($template_path);

					$template->setValue('nama_skpd', $skpd->nama_skpd);
					$template->setValue('no_telp', $skpd->telepon_skpd);
					$template->setValue('email', $skpd->email_skpd);
					$template->setValue('alamat', $skpd->alamat_skpd);
					$template->setValue('nomer_surat', $sk->nomer_surat);
					$template->setValue('website', $skpd->website);
					$template->setValue('kode_pos', $skpd->kode_pos);
					$template->setValue('dikeluarkan_di', 'Sumedang');
					$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));

					if (isset($field)) {
						foreach ($field as $f) {
							$field_name = $f->field_name;
							$sk->$field_name = str_replace('’', "'", $sk->$field_name);
							$sk->$field_name = str_replace('–', "-", $sk->$field_name);
							$sk->$field_name = str_replace('<div>', ' ', $sk->$field_name);
							$sk->$field_name = str_replace('</div>', '<br>', $sk->$field_name);
							if ($f->input_type == 'textarea') {
								$parser = new \HTMLtoOpenXML\Parser();
								$field_value = $parser->fromHTML($sk->$field_name);
								$template->setValue($field_name, $field_value, null, true);
							} elseif ($f->input_type == 'date') {
								$template->setValue($field_name, tanggal($sk->$field_name));
							} else {
								$template->setValue($field_name, $sk->$field_name);
							}
						}
					}
					if ($id_ref_surat !== 'custom') {
						$template->setValue('penutup', $sk->penutup);
					}

					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
					$template->setValue('nip_ttd', $pegawai_ttd->nip);
					$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
					$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);
					$detail = $this->surat_keluar_model->get_detail_by_id($in);
					$template->setValue('tgl_surat', $sk->tgl_surat);

					// $img_qr = get_qr_code($template_path);
					// $qrcode = generate_qr($detail->hash_id);
					// $template->setImageValue($img_qr, $qrcode);

					ob_clean();
					$template->saveAs("./data/surat_internal/keluar/" . $filename);
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $id_surat_keluar);

					$data['type'] = 'success';
					$data['messages'] = 'Surat Keluar berhasil diubah <b><a style="color:white" href="https://e-office.sumedangkab.go.id/surat_internal/detail_surat_keluar/' . $id_surat_keluar . '">Lihat</a></b>';


					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'memperbarui',
						'function' => 'surat keluar internal',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
				}
			}

			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->model('master_pegawai_model');
			$id_skpd = $this->session->userdata('id_skpd');
			$data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
			$data['pegawai_tembusan'] = $this->master_pegawai_model->get_by_id_skpd(33);
			$data['id_ref_surat'] = $id_ref_surat;

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

			$data['tembusan_surat'] = $this->surat_keluar_model->get_surat_tembusan(array('surat_keluar_tembusan.id_surat_keluar' => $id_surat_keluar));
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);



			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function buat_ulang_surat($id_surat_keluar, $testing = '')
	{
		$sk = $this->surat_keluar_model->get_detail_by_id_d($id_surat_keluar);
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);

		$this->load->model('ref_surat_model');
		$detail_template = $this->ref_surat_model->get_by_id($sk->id_ref_surat);
		$field = $this->ref_surat_model->get_field($sk->id_ref_surat);
		$kop_surat = $sk->kop_surat;
		if ($kop_surat == "bupati") {
			$template = $detail_template->template_file_bupati;
		} else {
			$template = $detail_template->template_file;
		}
		if ($kop_surat == "sekda") {
			$skpd = $this->ref_skpd_model->get_by_id(1);
		} else {
			$skpd = $this->ref_skpd_model->get_by_id($sk->id_skpd_pengirim);
		}

		$filename = $detail_template->nama_surat . '_' . time() . ".docx";
		$filename = str_replace(",", "", $filename);
		$filename = str_replace(" ", "_", $filename);

		$template_path = './data/template_surat/' . $template;
		$template = $phpWord->loadTemplate($template_path);

		$template->setValue('nama_skpd', $skpd->nama_skpd);
		$template->setValue('no_telp', $skpd->telepon_skpd);
		$template->setValue('email', $skpd->email_skpd);
		$template->setValue('alamat', $skpd->alamat_skpd);
		$template->setValue('nomer_surat', trim($sk->nomer_surat));
		$template->setValue('nomor_registrasi', $sk->hash_id);
		$template->setValue('website', $skpd->website);
		$template->setValue('kode_pos', $skpd->kode_pos);
		$template->setValue('tanggal_surat', tanggal($sk->tgl_surat));
		$template->setValue('dikeluarkan_di', 'Sumedang');
		$template->setValue('lampiran', ($sk->lampiran));
		$template->setValue('perihal', ($sk->perihal));
		$template->setValue('sifat_surat', ucwords($sk->sifat_surat));


		if (isset($field)) {
			foreach ($field as $f) {
				$field_name = $f->field_name;
				$sk->$field_name = str_replace('’', '', $sk->$field_name);
				$sk->$field_name = str_replace('–', "-", $sk->$field_name);
				$sk->$field_name = str_replace('<div>', ' ', $sk->$field_name);
				$sk->$field_name = str_replace('</div>', '<br>', $sk->$field_name);
				if ($f->input_type == 'textarea') {
					$parser = new \HTMLtoOpenXML\Parser();
					// $sk->$field_name = str_replace("&nbsp;", '', $sk->$field_name);
					$field_value = $parser->fromHTML($sk->$field_name);
					$template->setValue($field_name, $field_value, null, true);
				} elseif ($f->input_type == 'date') {
					$template->setValue($field_name, tanggal($sk->$field_name));
				} else {
					$template->setValue($field_name, $sk->$field_name);
				}
			}
		}

		$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
		if ($detail->id_ref_surat !== 'custom') {
			$template->setValue('penutup', $sk->penutup);
		}

		$pegawai_ttd = $this->master_pegawai_model->get_by_id($sk->id_pegawai_ttd);
		$template->setValue('nip_ttd', $pegawai_ttd->nip);
		$template->setValue('nama_ttd', $pegawai_ttd->nama_lengkap);
		$template->setValue('jabatan_ttd', $pegawai_ttd->jabatan);

		$template->setValue('tgl_surat', $sk->tgl_surat);

		$hash_id = $detail->hash_id;
		$img_qr = get_qr_code($template_path, 0, 'jpeg');
		$qrcode = generate_qr('https://e-office.sumedangkab.go.id/verifikasi_surat/id/' . $hash_id);
		$template->setImageValue($img_qr, $qrcode);
		// if($testing==1){
		// }
		ob_clean();
		$template->saveAs("./data/surat_internal/keluar/" . $filename);
		$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => ($filename)), $id_surat_keluar);
		redirect('surat_internal/detail_surat_keluar/' . $id_surat_keluar);
	}

	public function notif()
	{

		$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
	}

	public function detail_surat_keluar($id_surat_keluar)
	{
		if ($this->user_id) {
			$this->filter_surat_keluar($id_surat_keluar);
			$read = $this->notification_model->read('surat_internal/detail_surat_keluar', $id_surat_keluar);
			if ($read) {
				$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
			}
			$data['title']		= "Detail Surat Keluar Internal ";
			$data['content']	= "surat_internal/keluar/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal";
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

			if (!empty($_FILES)) {
				// echo "string";die;

				$config['upload_path']          = './data/surat_internal/keluar/';
				$config['allowed_types']        = 'docx';

				$input = array();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_verifikasi')) {
					$tmp_name = $_FILES['file_verifikasi']['tmp_name'];
					if ($tmp_name != "") {
						$data['message'] = $this->upload->display_errors();
						$data['type'] = "danger";
					}
				} else {
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => $this->upload->data('file_name'), 'status_verifikasi' => 'menunggu_verifikasi', 'status_penomoran' => 'N'), $id_surat_keluar);

					$data['message'] = "File berhasil diupload";
					$data['type'] = "success";

					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Ada surat menunggu diverifikasi oleh Anda dengan nomor registrasi ' . $data['detail']->hash_id;
					$notif_data['data'] = 'surat_internal/verifikasi_surat_detail';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_verifikator;
					$notif_data['category'] = 'surat_internal/verifikasi_surat';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));


					$app_token = $data['detail']->app_token_verifikator;
					if ($app_token != null) {
						require_once(APPPATH . 'libraries/PushNotification/Firebase.php');
						$judul = $data['detail']->full_name_verifikator . ", ada surat menunggu verifikasi dari anda.";
						$pesan = "Perihal : " . $data['detail']->perihal;
						$click_action = "verifikasi";
						$data_id = $id_surat_keluar;
						$file = "";
						$file_verifikasi = "";
						$file_draft = "";

						if ($data["detail"]->jenis_surat == "internal")
							$file_verifikasi = base_url() . "data/surat_internal/draf_pdf/" . $this->upload->data('file_name');
						else
							$file_verifikasi = base_url() . "data/surat_eksternal/draf_pdf/" . $this->upload->data('file_name');

						$dataa = array(
							'tanggal'	=> $data['detail']->tgl_surat,
							'file'		=> $file,
							'perihal'	=> $data['detail']->perihal,
							'jenis'		=> $data['detail']->jenis_surat,
							'id_surat_keluar'	=> $id_surat_keluar,
							'file_verifikasi'	=> $file_verifikasi,
							'file_draft'		=> $file_draft,
							'status'			=> strtoupper(str_replace("_", " ", $data['detail']->status_verifikasi)),

						);
						$raw_data = json_encode($dataa);
						$firebase = new Firebase();
						$respone = $firebase->send($app_token, $judul, $pesan, $click_action, $data_id, $raw_data);
						//var_dump($respone);die;
					}
				}
			}

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
			$data['status_surat'] = $this->surat_keluar_model->get_status_surat($id_surat_keluar);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	// Verifikasi Surat

	public function verifikasi_surat($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$summary_value = urldecode($summary_value);
			$data['title']		= "Verifikasi Surat Keluar Internal ";
			$data['content']	= "surat_internal/verifikasi/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal/verifikasi_surat";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_internal_verifikasi($summary_field, $summary_value));
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
			$data['total'] = $this->surat_keluar_model->get_all_internal_verifikasi();
			$data['sudah_diverifikasi'] = $this->surat_keluar_model->get_internal_verifikasi('sudah_diverifikasi');
			$data['menunggu_verifikasi'] = $this->surat_keluar_model->get_internal_verifikasi('menunggu_verifikasi');
			$data['ditolak'] = $this->surat_keluar_model->get_internal_verifikasi('ditolak');
			$data['list'] = $this->surat_keluar_model->get_page_internal_verifikasi($mulai, $hal, $filter, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function verifikasi_surat_detail($id_surat_keluar, $testing = "")
	{
		if ($this->user_id) {

			$this->filter_verifikator($id_surat_keluar);
			$data['title']		= "Detail Verifikasi Surat Internal ";
			$data['content']	= "surat_internal/verifikasi/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal";

			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if ($testing == 1) {
				$reg = $this->user_model->get_user_tu_pimpinan(1, $data['detail']->kop_surat);
				print_r($reg);
				die;
			}
			if (!empty($_FILES)) {
				$config['upload_path']          = './data/surat_internal/keluar/';
				$config['allowed_types']        = 'docx';

				$input = array();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('file_verifikasi')) {
					$tmp_name = $_FILES['file_verifikasi']['tmp_name'];
					if ($tmp_name != "") {
						$data['message'] = $this->upload->display_errors();
						$data['type'] = "danger";
					}
				} else {
					$this->surat_keluar_model->update_surat_keluar(array('file_draft_surat' => $this->upload->data('file_name'), 'status_verifikasi' => 'menunggu_verifikasi', 'status_penomoran' => 'N'), $id_surat_keluar);
					$data['message'] = "File berhasil diupload";
					$data['type'] = "success";
				}
			}
			if (!empty($_POST)) {

				$read = $this->notification_model->read('surat_internal/verifikasi_surat_detail', $id_surat_keluar);
				if ($read) {
					$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
				}
				if (isset($_POST['terima'])) {

					$copy = copy('./data/surat_internal/keluar/' . $data['detail']->file_draft_surat, './data/surat_internal/draf_pdf/' . $data['detail']->file_draft_surat);
					$this->surat_keluar_model->update_surat_keluar(array('file_verifikasi' => $data['detail']->file_draft_surat, 'status_verifikasi' => 'sudah_diverifikasi', 'status_ttd' => 'menunggu_verifikasi', 'tgl_verifikasi' => date('Y-m-d'), 'alasan_penolakan_penomoran' => NULL), $id_surat_keluar);
					$data['message'] = "Surat telah disetujui";
					$data['type'] = "success";

					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menyetujui',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);

					//kirim notif ke pembuat surat
					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah disetujui oleh verifikator surat';
					$notif_data['data'] = 'surat_internal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_internal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

					//kirim notif ke register surat

					$reg = $this->user_model->get_user_tu_pimpinan($this->session->userdata('id_skpd'), $data['detail']->kop_surat);
					foreach ($reg as $r) {
						$notif_data = array();
						$notif_data['title'] = 'Penomoran Surat';
						$notif_data['message'] = 'Ada surat menunggu untuk dilakukan penomoran dengan nomor registrasi ' . $data['detail']->hash_id;
						$notif_data['data'] = 'penomoran_surat/detail';
						$notif_data['data_id'] = $id_surat_keluar;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $r->user_id;
						$notif_data['category'] = 'penomoran_surat';
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->socketio->send('new_notification', $notif_data);
						$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
					}
				} elseif (isset($_POST['tolak'])) {
					$this->surat_keluar_model->update_surat_keluar(array('status_verifikasi' => 'ditolak', 'alasan_penolakan_verifikasi' => $_POST['alasan_penolakan_verifikasi'], 'alasan_penolakan_penomoran' => NULL), $id_surat_keluar);
					$data['message'] = "Surat telah ditolak";
					$data['type'] = "danger";


					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menolak',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);

					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' ditolak oleh verifikator surat';
					$notif_data['data'] = 'surat_internal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_internal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
				} elseif (isset($_POST['teruskan'])) {
					$this->surat_keluar_model->update_surat_keluar(
						array(
							'file_verifikasi' => $data['detail']->file_draft_surat,
							'status_verifikasi' => 'menunggu_verifikasi',
							'alasan_penolakan_penomoran' => NULL
						),
						$id_surat_keluar,
						array(
							'update' => 'verifikasi',
							'data' => array(
								'id_pegawai_verifikasi_teruskan' => $_POST['id_pegawai_verifikasi_teruskan'],
								'file_verifikasi' => $data['detail']->file_draft_surat,
								'status_verifikasi' => 'sudah_diverifikasi',
								'tgl_verifikasi' => date('Y-m-d')
							)
						)
					);
					$data['message'] = "Surat telah diteruskan";
					$data['type'] = "info";



					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'meneruskan',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);

					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah disetujui dan diteruskan oleh verifikator surat';
					$notif_data['data'] = 'surat_internal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_internal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
				}
			}
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['detail_verifikasi'] = $this->surat_keluar_model->get_detail_verifikasi_by_id($id_surat_keluar);
			$data['array_id_verifikasi'] = explode(',', $data['detail']->id_verifikasi);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);

			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
			$data['unit_kerja'] = $this->surat_masuk_model->get_all_unit_kerja_by_skpd($this->session->userdata('id_skpd'));
			array_push($data['unit_kerja'], (object) array('id_unit_kerja' => "0", 'nama_unit_kerja' => 'Kepala SKPD'));
			$a = $this->ref_skpd_model->get_kepala_skpd($this->session->userdata('id_skpd'));

			$lastvalue = end($data['unit_kerja']);
			$lastkey = count($data['unit_kerja']) - 1;

			$arr1 = array($lastkey => $lastvalue);

			array_pop($data['unit_kerja']);

			$arr1 = array_merge($arr1, $data['unit_kerja']);

			$data['unit_kerja'] = $arr1;

			foreach ($data['unit_kerja'] as $u) {
				$data['pegawai'][$u->id_unit_kerja] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
				// $data['pegawai'][0] = $this->surat_masuk_model->get_all_pegawai_by_unit_kerja($u->id_unit_kerja);
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	//Tanda Tangan
	public function tanda_tangan($summary_field = '', $summary_value = '')
	{
		if ($this->user_id) {
			$summary_value = urldecode($summary_value);
			$data['title']		= "Tandatangan Surat Internal ";
			$data['content']	= "surat_internal/tanda_tangan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal/tanda tangan";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_keluar_model->get_all_internal_ttd($summary_field, $summary_value));
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
			$data['total'] = $this->surat_keluar_model->get_all_internal_ttd();
			$data['unsign'] = $this->surat_keluar_model->get_all_internal_unsign();
			$data['sign'] = $this->surat_keluar_model->get_all_internal_sign();
			$data['tolak'] = $this->surat_keluar_model->get_all_internal_tolak();
			$data['list'] = $this->surat_keluar_model->get_page_internal_ttd($mulai, $hal, $filter, $summary_field, $summary_value);
			if (!empty($summary_value) && !empty($summary_field)) {
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function tanda_tangan_detail($id_surat_keluar, $testing = "")
	{
		if ($this->user_id) {
			$this->filter_ttd($id_surat_keluar);


			$data['title']		= "Detail Tandatangan Surat ";
			$data['content']	= "surat_internal/tanda_tangan/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat internal";
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			if ($data['detail']->jenis_surat == "eksternal") {
				redirect('surat_eksternal/tanda_tangan_detail/' . $id_surat_keluar);
			}
			if (!empty($_POST)) {
				if (isset($_POST['terima'])) {
					$this->load->model('user_model');
					$berkas 	 = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$user 		 = $this->user_model->get_current_sertifikat_user();
					$cur_date 	 = date("Ymdhis");
					$src 		 = "./data/surat_internal/draf_pdf/{$berkas->file_verifikasi}";
					//$certificate = "./data/sertifikat/{$user->certificate}";
					$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
					$input_name	 = $berkas->file_verifikasi;
					$output_name = "surat{$cur_date}{$berkas->hash_id}_(signed).pdf";
					$dest 		 = "./data/surat_internal/ttd";
					$passkey  	 = $_POST['passkey'];
					$pegawai 	 = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));
					$nik		 = $pegawai->nik;

					if ($pegawai->ttd_cloud == "Y") {
						$ttd = tanda_tangan_cloud($src, $dest, $nik, $passkey, $output_name);
						// $ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, $testing);
					} else {
						if (empty($user->certificate) && $data['detail']->id_ref_surat == '903') {
							$ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, 264358);
						} else {
							$ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, $testing);
						}
					}

					if($testing == 1){
						print_r($ttd);die;
					}



					if (!$ttd['error']) {
						$file_ttd = $ttd['file_ttd'];
						$source = "./data/surat_internal/ttd/{$file_ttd}";
						$dest = "./data/surat_internal/surat_masuk/{$file_ttd}";
						copy($source, $dest);
						//baca notifikasi
						$read = $this->notification_model->read('surat_internal/tanda_tangan_detail', $id_surat_keluar);
						if ($read) {
							$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
						}

						$this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'sudah_ditandatangani', 'tgl_ttd' => date('Y-m-d'), 'file_ttd' => $file_ttd), $id_surat_keluar);
						$data['message'] = $ttd['message'];
						$data['type'] = "success";


						//kirim notif ke pembuat surat
						$notif_data = array();
						$notif_data['title'] = 'Tandatangan Surat';
						$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' telah selesai ditandatangani dan di teruskan ke penerima';
						$notif_data['data'] = 'surat_internal/detail_surat_keluar';
						$notif_data['data_id'] = $id_surat_keluar;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $data['detail']->id_user_input;
						$notif_data['category'] = 'surat_internal/surat_keluar';
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->socketio->send('new_notification', $notif_data);
						$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));


						$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
						$log_data = array(
							'action' => 'melakukan',
							'function' => 'tandatangan surat',
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $detail->hash_id,
							'category' => $this->uri->segment(1),
						);
						$this->logs_model->insert_log($log_data);

						$send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);
						// print_r($send_surat);die;
						foreach ($send_surat as $s) {
							//kirim notif ke penerima
							$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
							$notif_data = array();
							$notif_data['title'] = 'Surat Masuk';
							$notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
							$notif_data['data'] = 'surat_internal/detail_surat_masuk';
							$notif_data['data_id'] = $s['id_surat_masuk'];
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $s['id_user'];
							$notif_data['category'] = 'surat_internal/surat_masuk';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
						}

						$tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
						// print_r($send_surat);die;
						foreach ($tembusan_s as $t) {
							//kirim notif ke penerima
							$notif_data = array();
							$notif_data['title'] = 'Surat Tembusan';
							$notif_data['message'] = 'Ada surat tembusan baru dengan perihal ' . $t->perihal;
							$notif_data['data'] = 'surat_tembusan/detail';
							$notif_data['data_id'] = $t->id_surat_keluar_tembusan;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $t->id_user;
							$notif_data['category'] = 'surat_tembusan/index/' . $t->jenis_surat;
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->socketio->send('new_notification', $notif_data);
							$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));
						}
					} else {
						$data['message'] = $ttd['message'];
						$data['type'] = "info";
						$log_data = array(
							'action' => 'gagal melakukan',
							'function' => 'tandatangan surat dikarenakan ' . $ttd['message'],
							'key_name' => 'nomor registrasi sistem',
							'key_value' => $data['detail']->hash_id,
							'category' => 'surat_' . $data['detail']->jenis_surat,
						);

						$this->logs_model->insert_log($log_data);
					}
				} elseif (isset($_POST['tolak'])) {

					//baca notifikasi
					$read = $this->notification_model->read('surat_internal/tanda_tangan_detail', $id_surat_keluar);
					if ($read) {
						$this->socketio->send('refresh_notification', array('user_id' => $this->session->userdata('user_id')));
					}
					$this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'ditolak', 'tgl_ttd' => date('Y-m-d'), 'alasan_penolakan_ttd' => $_POST['alasan_penolakan_ttd']), $id_surat_keluar);
					$data['message'] = "Surat telah ditolak";
					$data['type'] = "danger";


					//kirim notif ke pembuat surat
					$notif_data = array();
					$notif_data['title'] = 'Tandatangan Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $data['detail']->hash_id . ' ditolak oleh penandatangan surat';
					$notif_data['data'] = 'surat_internal/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $data['detail']->id_user_input;
					$notif_data['category'] = 'surat_internal/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->socketio->send('new_notification', $notif_data);
					$this->socketio->send('refresh_notification', array('user_id' => $notif_data['user_id']));

					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$log_data = array(
						'action' => 'menolak',
						'function' => 'tandatangan surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => $this->uri->segment(1),
					);
					$this->logs_model->insert_log($log_data);
				}
			}
			$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			$data['penerima'] = $this->surat_keluar_model->get_penerima($id_surat_keluar);
			$data['tembusan'] = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function tanda_tangan_surat($id)
	{
		// GET DATA
		$berkas 	= $this->surat_keluar_model->get_detail_by_id($id);

		$this->load->model('user_model');
		$user 		= $this->user_model->get_current_sertifikat_user();

		if (empty($user->user_id) or empty($user->certificate) or empty($user->dot_key) or empty($user->pass_key)) {
			return false;
		} else {

			//load tcpdf
			$this->load->library("Pdf");

			// https://github.com/pauln/tcpdi
			// create new PDF document
			$pdf = new TCPDI('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

			// Add a page from a PDF by file path.
			$pdfdata = file_get_contents("./data/surat_internal/draf_pdf/{$berkas->file_verifikasi}"); // Simulate only having raw data available.
			$pagecount = $pdf->setSourceData($pdfdata);
			for ($i = 1; $i <= $pagecount; $i++) {
				$tplidx = $pdf->importPage($i);
				$pdf->AddPage();
				$pdf->useTemplate($tplidx);
			}

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('SEKRETARIAT DAERAH');
			$pdf->SetTitle('KABUPATEN SUMEDANG');
			$pdf->SetSubject('');
			$pdf->SetKeywords('');

			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

			// set header and footer fonts
			//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			/*
		NOTES:
		 - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
		 - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
		 - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
		*/

			// set certificate file
			$certificate = "file://data/sertifikat/{$user->user_id}/{$user->certificate}";

			$key = "file://data/sertifikat/{$user->user_id}/{$user->dot_key}";

			$this->load->helper('encryption_helper');
			$ps = decode($user->pass_key);

			// set additional information
			$server = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']), array('off', 'no'))) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
			$info = array(
				'Name' => 'SEKRTERARIAT DAERAH',
				'Location' => 'KABUPATEN SUMEDANG',
				'Reason' => 'SURAT DIGITAL',
				'ContactInfo' => $server,
			);

			// set document signature
			$pdf->setSignature($certificate, $key, $ps, '', 2, $info);

			// set font
			$pdf->SetFont('helvetica', '', 12);

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// *** set signature appearance ***

			// create content for signature (image and/or text)
			//$pdf->Image('data/sertifikat/ttd.png', 180, 60, 15, 15, 'PNG');

			// define active area for signature appearance
			//$pdf->setSignatureAppearance(180, 60, 15, 15);

			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

			// *** set an empty signature appearance ***
			//$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

			// ---------------------------------------------------------

			// make folder if not exist
			if (!file_exists("./data/surat_internal/ttd")) {
				mkdir("./data/surat_internal/ttd", 0777, true);
			}

			//Close and output PDF document
			ob_clean();

			$hash_id = strtoupper(hash("crc32b", crypt($id, str_pad('$1$sprazuto', 16, "0", STR_PAD_LEFT))));
			$cur_date = date("Ymdhis");
			$filename = "surat{$cur_date}{$berkas->hash_id}(verified).pdf";
			$pdf->Output($_SERVER['DOCUMENT_ROOT'] . "/data/surat_internal/ttd/{$filename}", 'F');

			// backup to owner
			$source = "./data/surat_internal/ttd/{$filename}";
			$dest = "./data/surat_internal/surat_masuk/{$filename}";
			// $dest_raw = "./../global/berkas_sk/{$berkas[0]->no_ktp}/{$berkas[0]->berkas_revisi_sk}";
			// $last_space = strrpos($dest_raw, '/');
			// $file = substr($dest_raw, $last_space);
			// $dest = substr($dest_raw, 0, $last_space);

			//   	if (!file_exists($dest)) {
			//     mkdir($dest, 0777, true);
			// }
			copy($source, $dest);
			// readfile(".data/surat_keluar/{$id}/{$filename}");
			return $filename;
		}
		//============================================================+
		// END OF FILE
		//============================================================+

	}


	public function get_unit_kerja()
	{
		if (!empty($_POST)) {
			$id_skpd = $_POST['id_skpd'];
			$get = $this->data_model->get_unit_kerja(null, $id_skpd);
			echo '<option value="0">Pilih Unit Kerja</option>';
			foreach ($get as $g) {
				echo '<option value="' . $g->id_unit_kerja . '">' . $g->nama_unit_kerja . '</option>';
			}
		}
	}

	public function get_pegawai()
	{
		if (!empty($_POST)) {
			$id_unit_kerja = $_POST['id_unit_kerja'];
			$get = $this->data_model->get_pegawai(null, $id_unit_kerja);
			echo '<option value="0">Pilih Pegawai</option>';
			foreach ($get as $g) {
				echo '<option value="' . $g->id_pegawai . '">' . $g->nama_lengkap . '</option>';
			}
		}
	}

	public function decode_test()
	{
		$this->load->helper('encryption_helper');
		//32rfqa11ucH3b2yI_AU0BQJq_JvE_GL51bTLAWo9ed4
		//gbnOWdA1KXsH-32rfqa11ucH3b2yI_AU0BQJq_JvE_GL51bTLAWo9ed4
		echo $ps = decode("32rfqa11ucH3b2yI_AU0BQJq_JvE_GL51bTLAWo9ed4");
	}

	public function delete_surat_keluar($id)
	{

		if ($this->user_id) {
			$this->filter_surat_keluar($id);
			$detail = $this->surat_keluar_model->get_detail_by_id($id);
			$log_data = array(
				'action' => 'menghapus',
				'function' => 'surat keluar internal',
				'key_name' => 'nomor registrasi sistem',
				'key_value' => $detail->hash_id,
				'category' => $this->uri->segment(1),
			);
			$this->logs_model->insert_log($log_data);

			$this->surat_keluar_model->delete_surat_keluar($id);
			echo json_encode(array('status' => true));
		}
	}


	public function filter_surat_masuk($id)
	{
		$data['detail'] = $this->surat_masuk_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_input !== $this->id_pegawai && $data['detail']->id_pegawai_penerima !== $this->id_pegawai) {
				show_404();
			}
		}
	}

	public function filter_surat_keluar($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_input !== $this->id_pegawai) {
				show_404();
			}
		}
	}

	public function filter_verifikator($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_verifikasi !== $this->id_pegawai && !empty($data['detail']->status_verifikasi)) {
				show_404();
			}
		}
	}



	public function filter_ttd($id)
	{

		$data['detail'] = $this->surat_keluar_model->get_detail_by_id($id);

		if (empty($data['detail'])) {
			show_404();
		}
		if ($this->user_level !== "Administrator") {
			if ($data['detail']->id_pegawai_ttd !== $this->id_pegawai && !empty($data['detail']->status_ttd)) {
				show_404();
			}
		}
	}

	function qr()
	{
		$qrcode = generate_qr("51235");
		echo $qrcode;
	}

	function bsre()
	{
		print_r(file_get_contents('http://cvs-bsre.bssn.go.id/ocsp'));
	}
}