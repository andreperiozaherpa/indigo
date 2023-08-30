<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Api_surat extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model('surat_masuk_model');
		$this->load->model('surat_keluar_model');
		$this->load->model('logs_model');
		$this->load->model('master_pegawai_model');
		$sekda = $this->master_pegawai_model->get_pegawai_kepala_skpd(1);
		if ($sekda) {
			$id_pegawai_sekda = $sekda->id_pegawai;
		} else {
			$id_pegawai_sekda = 401;
		}

		$this->id_pegawai_sekda = $id_pegawai_sekda;
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
	}

	function ka_post(){
		$response['a'] = "asd";
		$this->response($response);
	}

	function masuk_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);


		if ($api_key != null && $cekApi) {
			// $this->db->limit(10);
			$id_pegawai = $cekApi->id_pegawai; // $this->post('id_pegawai');

			//$pegawai = $this->getPegawai($id_pegawai);



			$this->db->select("surat_masuk.*, pegawai.foto_pegawai as user_picture, pegawai.nama_lengkap as 'pengirim' ");
			//$this->db->where('surat_masuk.id_pegawai_input', $id_pegawai);
			$this->db->where('surat_masuk.id_pegawai_penerima', $id_pegawai);
			//			if($pegawai->id_jabatan=="0")
			//			{
			//				$this->db->or_where("surat_masuk.id_skpd_penerima",$pegawai->id_skpd);
			//			}

			//			$this->db->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd','left');
			$this->db->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai', 'left');
			$this->db->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai', 'left');
			$this->db->order_by("tanggal_surat", 'DESC');
			$this->db->group_by("surat_masuk.id_surat_masuk");
			$data = $this->db->get('surat_masuk')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function masuk_v2_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);


		if ($api_key != null && $cekApi) {

			$userdata = array(
				'id_pegawai' 		=> $cekApi->id_pegawai,
				'id_skpd'			=> $cekApi->id_skpd,
				'id_unit_kerja'		=> $cekApi->id_unit_kerja,
				'kepala_skpd'		=> $cekApi->kepala_skpd,
				'user_privileges'	=> $cekApi->user_privileges
			);
			$this->surat_masuk_model->user_data = $userdata;

			$data = $this->surat_masuk_model->get_surat_masuk(null, null, '', '', '', true);

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);

		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	private function getPegawai($id_pegawai)
	{
		$this->db->where("id_pegawai", $id_pegawai);
		$rs = $this->db->get("pegawai");
		return $rs->row();
	}

	function add_disposisi_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);
		$jenis = (!empty($headers['jenis'])) ? $headers['jenis'] : null;
		$jenis = (!empty($headers['Jenis'])) ? $headers['Jenis'] : $jenis;

		if ($api_key != null && $cekApi && $jenis != null) {
			//$req = '{"data":[{"id_surat_masuk":"3","id_skpd":"33","id_pegawai":"47","instruksi":"testing2"},{"id_surat_masuk":"3","id_skpd":"33","id_pegawai":null,"instruksi":"testing2"}]}';
			$req = file_get_contents('php://input');
			$json = json_decode($req, true);
			$data = !empty($json['data']) ? $json['data'] : null;
			//echo print_r($data);die;
			if ($data != null) {
				$param = array(
					'status_surat' 	=> 'Belum Dibaca',
				);

				$id_pegawaiArr = array();
				$id_skpdArr = array();
				foreach ($data as $row) {
					$insert_data = array_merge($param, $row);
					// utk notif
					if (!empty($insert_data['id_pegawai']) && $insert_data['id_pegawai'] != null) {
						$id_pegawaiArr[] = $insert_data['id_pegawai'];
						$insert_data['jenis_penerima_disposisi'] = "internal";
					} else {
						$id_skpdArr[] = $insert_data['id_skpd'];
						$insert_data['jenis_penerima_disposisi'] = "eksternal";
					}



					if ($jenis == "surat_masuk") {
						unset($insert_data['id_surat_keluar']);
						$this->db->insert("disposisi_surat_masuk", $insert_data);
					} else {
						unset($insert_data['id_surat_masuk']);
						unset($insert_data['jenis_penerima_disposisi']);
						$this->db->insert("disposisi_surat_keluar", $insert_data);
					}
				}

				//$this->db->where("app_token is not null");
				if (count($id_skpdArr) > 0) {
					$this->db->or_where_in("id_skpd", $id_skpdArr);
				}
				if (count($id_pegawaiArr) > 0) {
					$this->db->or_where_in("pegawai.id_pegawai", $id_pegawaiArr);
				}
				$this->db->join("user", "user.id_pegawai = pegawai.id_pegawai", 'left');
				$rs = $this->db->get("pegawai")->result();

				$app_tokenArr = array();
				foreach ($rs as $row) {
					if ($row->app_token != null) {
						$app_tokenArr[] = $row->app_token;
					}
				}

				// Mengirimkan notifikasi ke Android
				if (count($app_tokenArr) > 0) {

					$gambar = "";

					$tanggal = "";
					$ringkasan = "";
					$file = "";
					$id_surat_masuk = "";
					$id_surat_keluar = "";
					$flag_disposisi = "";
					$id_disposisi = "";

					if ($jenis == "surat_masuk") {
						$this->db->where("id_surat_masuk", $data[0]['id_surat_masuk']);
						$this->db->select("surat_masuk.*, pegawai.foto_pegawai as user_picture");
						// $this->db->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai','left');
						$this->db->join('pegawai', 'pegawai.id_pegawai = surat_masuk.id_pegawai_input', 'left');
						$this->db->group_by("surat_masuk.id_surat_masuk");
						$sm = $this->db->get("surat_masuk")->result();

						if ($sm[0]->user_picture != null)
							$gambar = base_url() . "data/foto/pegawai/" . $sm[0]->user_picture;
						$tanggal = $sm[0]->tanggal_surat;
						if ($sm[0]->isi_ringkasan != null)
							$ringkasan = $sm[0]->isi_ringkasan;
						if ($sm[0]->jenis_surat == "internal")
							$file = base_url() . "data/surat_internal/surat_masuk/" . $sm[0]->file_surat;
						else
							$file = base_url() . "data/surat_eksternal/surat_masuk/" . $sm[0]->file_surat;

						$flag_disposisi = "masuk";

						$last = $this->db->limit(1)
							->order_by("id_disposisi_masuk", "DESC")
							->get("disposisi_surat_masuk")
							->row();

						$id_disposisi = $last->id_disposisi_masuk;
					} else {
						$this->db->where("id_surat_keluar", $data[0]['id_surat_keluar']);
						$sm = $this->db->get("surat_keluar")->result();
						$tanggal = $sm[0]->tgl_surat;
						$id_surat_keluar = $sm[0]->id_surat_keluar;
						if ($sm[0]->jenis_surat == "internal")
							$file = base_url() . "data/surat_internal/ttd/" . $sm[0]->file_ttd;
						else
							$file = base_url() . "data/surat_internal/surat_masuk/" . $sm[0]->file_ttd;

						$flag_disposisi = "keluar";

						$last = $this->db->limit(1)
							->order_by("id_disposisi_keluar", "DESC")
							->get("disposisi_surat_keluar")
							->row();
						$id_disposisi = $last->id_disposisi_keluar;
					}

					//require(APPPATH.'libraries/PushNotification/Firebase.php');
					$judul = "Disposisi surat";
					$pesan = "Perihal : " . $sm[0]->perihal;
					$click_action = "disposisi";
					$data_id = '';




					$data = array(
						'gambar'	=> $gambar,
						'judul'		=> $sm[0]->perihal,
						'tanggal'	=> $tanggal,
						'ringkasan'	=> $ringkasan,
						'file'		=> $file,
						'id_surat_masuk'	=> $id_surat_masuk,
						'flag'		=> "disposisi",
						'perihal'	=> $sm[0]->perihal,
						'jenis'		=> $sm[0]->jenis_surat,
						'id_surat_keluar'	=> $id_surat_keluar,
						'file_verifikasi'	=> "",
						'file_draft'		=> "",
						'flag_disposisi'	=> $flag_disposisi,
						"catatan"			=> $data[0]["instruksi"],
						"id_disposisi"		=> $id_disposisi,

					);
					$raw_data = json_encode($data);
					$firebase = new Firebase();
					$firebase->sendMulti($app_tokenArr, $judul, $pesan, $click_action, $data_id, $raw_data);
				}


				$response = array(
					'error'		=> false,
					'message'	=> 'Disposisi berhasil',
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential' .$api_key . $jenis,
			];
		}



		$this->response($response);
	}

	function get_disposisi_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_surat_masuk = $this->post('id_surat_masuk');

			/*
			$this->db->select("disposisi_surat_masuk.*, pegawai.foto_pegawai as user_picture, pegawai.nama_lengkap,ref_unit_kerja.nama_unit_kerja,ref_skpd.nama_skpd,ref_skpd.alamat_skpd, pegawai_disposisi.nama_lengkap as 'pengirim' ");
	//$this->db->where('surat_masuk.id_pegawai_input', $id_pegawai);
			$this->db->where('disposisi_surat_masuk.id_surat_masuk', $id_surat_masuk);

			$this->db->join('ref_skpd', 'disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd','left');
			// $this->db->join('user', 'disposisi_surat_masuk.id_pegawai = user.id_pegawai','left');
			$this->db->join('pegawai', 'disposisi_surat_masuk.id_pegawai = pegawai.id_pegawai','left');
			$this->db->join('pegawai as pegawai_disposisi', 'disposisi_surat_masuk.id_pegawai_disposisi = pegawai.id_pegawai','left');
			$this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja','left');
*/
			//$data = $this->db->get('disposisi_surat_masuk')->result();
			$data = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($id_surat_masuk);
			foreach ($data as $key => $row) {
				if ($row->tgl_terima) {
					$data[$key]->_tgl_terima = date("d M Y", strtotime($row->tgl_terima));
				} else {
					$data[$key]->_tgl_terima = "";
				}
				$data[$key]->user_picture = $row->foto_pegawai;

				if ($row->jenis_penerima_disposisi == "internal") {
					if ($row->id_pegawai > 0) {
						$penerima_disposisi = $row->nama_lengkap;
					} else {
						$penerima_disposisi = $row->nama_unit_kerja;
					}
				} else {
					$penerima_disposisi = $row->nama_skpd;
				}

				$data[$key]->penerima_disposisi = $penerima_disposisi;
			}

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}
	function keluar_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_pegawai = $this->post('id_pegawai');

			$this->db->where('surat_keluar.id_pegawai_input', $id_pegawai);
			$this->db->where('status_register !=', "Sudah Diregistrasi");

			$Date = date("Y-m-d");
			$tanggal_surat = date('Y-m-d', strtotime($Date . ' - 30 day'));
			$this->db->where("tgl_surat >= ", $tanggal_surat);

			$this->db->order_by("tgl_surat", 'DESC');

			$data = $this->db->get('surat_keluar')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_disposisi_surat_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_pegawai = $this->post('id_pegawai');
			$id_skpd = $this->post('id_skpd');

			if (!empty($id_pegawai) && !empty($id_skpd)) {

				$this->db->select("disposisi_surat_masuk.*, disposisi_surat_masuk.status_surat as 'status_surat_disposisi', surat_masuk.*, pegawai.foto_pegawai as user_picture, 'masuk' as 'disposisi' ");
				$this->db->where("(disposisi_surat_masuk.id_pegawai='" . $id_pegawai . "' OR (disposisi_surat_masuk.id_pegawai is null AND disposisi_surat_masuk.id_skpd='" . $id_skpd . "') )");

				$this->db->where("surat_masuk.id_surat_masuk is not null");

				$this->db->join('surat_masuk', 'surat_masuk.id_surat_masuk = disposisi_surat_masuk.id_surat_masuk', 'left');
				$this->db->join('ref_skpd', 'disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd', 'left');
				// $this->db->join('user', 'disposisi_surat_masuk.id_pegawai = user.id_pegawai','left');
				$this->db->join('pegawai', 'disposisi_surat_masuk.id_pegawai = pegawai.id_pegawai', 'left');

				$this->db->order_by("surat_masuk.tanggal_surat", "DESC");

				$this->db->group_by("disposisi_surat_masuk.id_disposisi_masuk");

				$disposisi_surat_masuk = $this->db->get('disposisi_surat_masuk')->result();

				///////////

				$this->db->select("disposisi_surat_keluar.*,disposisi_surat_keluar.status_surat as 'status_surat_disposisi',surat_keluar.*, pegawai.foto_pegawai as user_picture, 'keluar' as 'disposisi' ");
				$this->db->where("(disposisi_surat_keluar.id_pegawai='" . $id_pegawai . "' OR (disposisi_surat_keluar.id_pegawai is null AND disposisi_surat_keluar.id_skpd='" . $id_skpd . "') )");

				$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = disposisi_surat_keluar.id_surat_keluar', 'left');
				$this->db->join('ref_skpd', 'disposisi_surat_keluar.id_skpd = ref_skpd.id_skpd', 'left');
				// $this->db->join('user', 'disposisi_surat_keluar.id_pegawai = user.id_pegawai','left');
				$this->db->join('pegawai', 'disposisi_surat_keluar.id_pegawai = pegawai.id_pegawai', 'left');
				$this->db->group_by("disposisi_surat_keluar.id_disposisi_keluar");

				$disposisi_surat_keluar = $this->db->get('disposisi_surat_keluar')->result();

				$data = array_merge($disposisi_surat_masuk, $disposisi_surat_keluar);

				$response = array(
					'error'		=> false,
					'data'		=> $data,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_disposisi_masuk_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {


			$userdata = array(
				'id_pegawai' 		=> $cekApi->id_pegawai,
				'id_skpd'			=> $cekApi->id_skpd,
				'id_unit_kerja'		=> $cekApi->id_unit_kerja,
				'kepala_skpd'		=> $cekApi->kepala_skpd,
				'user_privileges'	=> $cekApi->user_privileges
			);
			$this->surat_masuk_model->user_data = $userdata;
			$this->surat_masuk_model->jenis_surat = "ALL";
			$data = $this->surat_masuk_model->get_page_internal_disposisi(null, null, '', '', '', true);

			foreach ($data as $key => $row) {
				$data[$key]->_tanggal = date("d M", strtotime($row->tanggal_surat));
				$jenis_surat = "surat_" . $row->jenis_surat;
				$data[$key]->_url_surat = base_url() . "data/" . $jenis_surat . "/surat_masuk/" . $row->file_surat;
			}

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_disposisi_keluar_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {


			$userdata = array(
				'id_pegawai' 		=> $cekApi->id_pegawai
			);
			$this->surat_masuk_model->user_data = $userdata;
			$data = $this->surat_masuk_model->get_page_disposisi_keluar();

			foreach ($data as $key => $row) {
				$data[$key]->_tanggal = date("d M", strtotime($row->tanggal_surat));
				$data[$key]->_url_surat = base_url() . "data/surat_internal/surat_masuk/" . $row->file_surat;
			}

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function tembusan_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_pegawai = $this->post('id_pegawai');


			if (!empty($id_pegawai)) {

				$this->db->select("surat_keluar_tembusan.*, surat_keluar_tembusan.status_surat as 'status_tembusan', surat_keluar.*, pegawai.foto_pegawai as user_picture");
				$this->db->where("surat_keluar_tembusan.id_pegawai", $id_pegawai);
				$this->db->where("surat_keluar.id_surat_keluar is not null");
				$this->db->where('surat_keluar.status_ttd', "sudah_ditandatangani");
				$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
				$this->db->join('pegawai', 'pegawai.id_pegawai =surat_keluar_tembusan.id_pegawai', 'left');
				// $this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai','left');

				$data = $this->db->get('surat_keluar_tembusan')->result();

				$response = array(
					'error'		=> false,
					'data'		=> $data,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_verifikasi_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_pegawai = $this->post('id_pegawai');

			$this->db->where('surat_keluar.id_pegawai_verifikasi', $id_pegawai);
			$this->db->where('status_register !=', "Sudah Diregistrasi");
			//$this->db->where('status_verifikasi', "menunggu_verifikasi");

			$Date = date("Y-m-d");
			//$tanggal_surat = date('Y-m-d', strtotime($Date . ' - 30 day')); //240
			//$this->db->where("tgl_surat >= ", $tanggal_surat);
			$this->db->limit(40,0);

			$this->db->where_in("status_verifikasi", array('menunggu_verifikasi', 'sudah_diverifikasi'));
			$this->db->order_by("surat_keluar.id_surat_keluar", "DESC");
			$data = $this->db->get('surat_keluar')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function emit($name, $notif_data)
	{

		// $client = new Client(new Version2X('https://localhost:3000', ['context' => ['ssl' => ['verify_peer_name' => false, 'verify_peer' => false]]]));
		// $client->initialize();
		// $client->emit($name, $notif_data);
		// $client->close();
	}



	function verifikasi_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			//$req = '{"data":[{"id_surat_masuk":"1","id_skpd":"2","id_pegawai":"3","instruksi":"testing"},{"id_surat_masuk":"1","id_skpd":"2","id_pegawai":null,"instruksi":"testing"}]}';
			$id_surat_keluar = $this->post("id_surat_keluar");

			$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
			//var_dump($detail);die;
			if ($detail->jenis_surat == "internal") {
				$detail->jenis_surat = "surat_internal";
			} elseif ($detail->jenis_surat == "eksternal") {
				$detail->jenis_surat = "surat_eksternal";
			}
			$read = $this->notification_model->read($detail->jenis_surat . '/verifikasi_surat_detail', $id_surat_keluar);
			if ($read) {
				$this->emit('refresh_notification', array('user_id' => $detail->id_user_verifikator));
			}
			$aksi = $this->post("aksi");
			if (!empty($id_surat_keluar) && !empty($aksi)) {
				$where = array(
					'id_surat_keluar'	=> $id_surat_keluar
				);
				if ($aksi == "terima") {

					$id_pegawai = $cekApi->id_pegawai;
					if ($detail->jenis_surat == 'surat_eksternal' && $detail->kop_surat == 'bupati' && $id_pegawai != $this->id_pegawai_sekda) {
						$error = true;
						$message = "Khusus Surat Bupati harus mendapatkan verifikasi dari Sekretaris Daerah sebelum masuk ke Bagian Penomoran, silahkan Teruskan verifikasi surat ini ke Sekretaris Daerah";
					} else {
						$copy = copy('./data/' . $detail->jenis_surat . '/keluar/' . $detail->file_draft_surat, './data/' . $detail->jenis_surat . '/draf_pdf/' . $detail->file_draft_surat);
						$data = array(
							'status_verifikasi'	=> 'sudah_diverifikasi',
							'status_ttd'		=> 'menunggu_verifikasi',
							'file_verifikasi' => $detail->file_draft_surat,
							'tgl_verifikasi'	=> date('Y-m-d')
						);
						$message = "Surat berhasil diverifikasi";

						//kirim notif ke pembuat
						$notif_data = array();
						$notif_data['title'] = 'Verifikasi Surat';
						$notif_data['message'] = 'Surat dengan nomor registrasi ' . $detail->hash_id . ' telah disetujui dan diteruskan oleh verifikator surat';
						$notif_data['data'] = $detail->jenis_surat . '/detail_surat_keluar';
						$notif_data['data_id'] = $id_surat_keluar;
						$notif_data['ntime'] = date('H:i:s');
						$notif_data['ndate'] = date('Y-m-d');
						$notif_data['user_id'] = $detail->id_user_input;
						$notif_data['category'] = $detail->jenis_surat . '/surat_keluar';
						$this->notification_model->insert($notif_data);
						$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
						$this->emit('new_notification', $notif_data);
						$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));

						$pegawai = $this->db->get_where('pegawai', array('id_user' => $detail->id_user_input))->row();

						//kirim notif ke register surat
						$reg = $this->user_model->get_user_tu_pimpinan($pegawai->id_skpd, $detail->kop_surat);
						foreach ($reg as $r) {
							$notif_data = array();
							$notif_data['title'] = 'Penomoran Surat';
							$notif_data['message'] = 'Ada surat menunggu untuk dilakukan penomoran dengan nomor registrasi ' . $detail->hash_id;
							$notif_data['data'] = 'penomoran_surat/detail';
							$notif_data['data_id'] = $id_surat_keluar;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $r->user_id;
							$notif_data['category'] = 'penomoran_surat';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
							$this->emit('new_notification', $notif_data);
							$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
						}
					}
				} else if ($aksi == "tolak") {
					$data = array(
						'status_verifikasi'	=> 'ditolak',
						'alasan_penolakan_verifikasi' => $this->post("alasan"),
					);
					$message = "Surat telah ditolak";

					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Surat dengan nomor registrasi ' . $detail->hash_id . ' ditolak oleh verifikator surat';
					$notif_data['data'] = $detail->jenis_surat . '/detail_surat_keluar';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $detail->id_user_input;
					$notif_data['category'] = $detail->jenis_surat . '/surat_keluar';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->emit('new_notification', $notif_data);
					$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
				} else if ($aksi == "teruskan") {

					$this->surat_keluar_model->update_surat_keluar(
						array(
							'file_verifikasi' => $detail->file_draft_surat,
							'status_verifikasi' => 'menunggu_verifikasi'
						),
						$id_surat_keluar,
						array(
							'update' => 'verifikasi',
							'data' => array(
								'id_pegawai_verifikasi_teruskan' => $this->post('id_pegawai'),
								'file_verifikasi' => $detail->file_draft_surat,
								'status_verifikasi' => 'sudah_diverifikasi',
								'tgl_verifikasi' => date('Y-m-d')
							)
						)
					);
					$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

					$notif_data = array();
					$notif_data['title'] = 'Verifikasi Surat';
					$notif_data['message'] = 'Ada surat menunggu diverifikasi oleh Anda dengan nomor registrasi ' . $detail->hash_id;
					$notif_data['data'] = 'surat_' . $detail->jenis_surat . '/verifikasi_surat_detail';
					$notif_data['data_id'] = $id_surat_keluar;
					$notif_data['ntime'] = date('H:i:s');
					$notif_data['ndate'] = date('Y-m-d');
					$notif_data['user_id'] = $detail->id_user_verifikator;
					$notif_data['category'] = 'surat_' . $detail->jenis_surat . '/verifikasi_surat';
					$this->notification_model->insert($notif_data);
					$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
					$this->emit('new_notification', $notif_data);
					$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));

					$this->load->model("logs_model");


					$log_data = array(
						'action' => 'meneruskan',
						'function' => 'verifikasi surat',
						'key_name' => 'nomor registrasi sistem',
						'key_value' => $detail->hash_id,
						'category' => '',
					);
					$this->logs_model->insert_log($log_data);



					$app_token = $detail->app_token_verifikator;
					if ($app_token != null) {
						//require_once(APPPATH.'libraries/PushNotification/Firebase.php');
						$judul = $detail->full_name_verifikator . ", ada surat menunggu verifikasi dari anda.";
						$pesan = "Perihal : " . $detail->perihal;
						$click_action = "verifikasi";
						$data_id = $id_surat_keluar;
						$file = "";
						$file_verifikasi = "";
						$file_draft = "";

						if ($detail->jenis_surat == "internal")
							$file_verifikasi = base_url() . "data/surat_internal/draf_pdf/" . $detail->file_draft_surat;
						else
							$file_verifikasi = base_url() . "data/surat_eksternal/draf_pdf/" . $detail->file_draft_surat;

						$dataa = array(
							'tanggal'	=> $detail->tgl_surat,
							'file'		=> $file,
							'perihal'	=> $detail->perihal,
							'jenis'		=> $detail->jenis_surat,
							'id_surat_keluar'	=> $id_surat_keluar,
							'file_verifikasi'	=> $file_verifikasi,
							'file_draft'		=> $file_draft,
							'status'			=> strtoupper(str_replace("_", " ", $detail->status_verifikasi)),

						);
						$raw_data = json_encode($dataa);
						$firebase = new Firebase();
						$respone = $firebase->send($app_token, $judul, $pesan, $click_action, $data_id, $raw_data);
						//var_dump($respone);die;


					}

					$message = "Surat telah diteruskan";
				}
				if (!empty($data)) {
					$this->db->update("surat_keluar", $data, $where);
				}


				$e = isset($error) ? $error : false;
				$response = array(
					'error'		=> $e,
					'message'	=> $message,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}



	function get_ttd_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);


		if ($api_key != null && $cekApi) {
			$id_pegawai = $this->post('id_pegawai');

			$this->db->where('surat_keluar.id_pegawai_ttd', $id_pegawai);
			$this->db->where('status_verifikasi', "sudah_diverifikasi");
			//$this->db->where("status_ttd","menunggu_verifikasi");
			$this->db->where_in("status_ttd", array('menunggu_verifikasi', 'sudah_ditandatangani'));
			$this->db->where('status_penomoran', "Y");
			$this->db->where('status_register !=', "Sudah Diregistrasi");

			$Date = date("Y-m-d");
			
			if ($id_pegawai != 316) { //361 = Demo TTD
				$tanggal_surat = date('Y-m-d', strtotime($Date . ' - 30 day'));
				$this->db->where("tgl_surat >= ", $tanggal_surat);
			}


			$this->db->order_by("surat_keluar.tgl_buat", "DESC");
			$this->db->select("* , REPLACE(status_ttd,'verifikasi','tandatangan') as status_ttd");
			$data = $this->db->get('surat_keluar')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function ttd_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_surat_keluar = $this->post("id_surat_keluar");
			$aksi = $this->post("aksi");
			$passpharse = $this->post("passpharse");
			if (!empty($id_surat_keluar) && !empty($aksi)) {
				$where = array(
					'id_surat_keluar'	=> $id_surat_keluar
				);
				$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

				if ($aksi == "terima") {
					//$file_ttd = $this->tanda_tangan_surat($id_surat_keluar,$cekApi);
					if (!empty($passpharse)) {

						$jenis_surat = $detail->jenis_surat;
						//var_dump($jenis_surat);
						$this->load->model('surat_keluar_model');
						$berkas 	 = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
						$user 		 = $cekApi;
						$cur_date 	 = date("Ymdhis");

						$src = "";
						$dest = "";
						if ($jenis_surat == "internal") {
							$src 		 = "./data/surat_internal/draf_pdf/{$berkas->file_verifikasi}";
							$dest 		 = "./data/surat_internal/ttd";
						} else {
							$src 		 = "./data/surat_eksternal/draf_pdf/{$berkas->file_verifikasi}";
							$dest 		 = "./data/surat_eksternal/ttd";
						}
						//$certificate = "./data/sertifikat/{$user->certificate}";
						$certificate = "/sertifikat/{$user->user_id}/{$user->certificate}";
						$input_name	 = $berkas->file_verifikasi;
						$output_name = "surat{$cur_date}{$berkas->hash_id}_(signed).pdf";

						$pegawai 	 = $this->master_pegawai_model->get_by_id($cekApi->id_pegawai);
						$nik		 = $pegawai->nik;
						$passkey  	 = $passpharse;

						if ($pegawai->ttd_cloud == "Y") {
							$ttd = tanda_tangan_cloud($src, $dest, $nik, $passkey, $output_name);
						} else {
							if (empty($user->certificate) && $detail->id_ref_surat == '903') {
								$ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name, 264358);
							} else {
								$ttd = tanda_tangan_digital($src, $certificate, $dest, $passkey, $input_name, $output_name);
							}
						}


						if (!$ttd['error']) {
							$file_ttd = $ttd['file_ttd'];
							$data = array(
								'status_ttd'	=> 'sudah_ditandatangani',
								'file_ttd'		=> $file_ttd,
								'tgl_ttd'	=> date('Y-m-d')
							);
							$this->db->update("surat_keluar", $data, $where);
							//$message = "Surat berhasil ditanda tangani secara elektronik";
							$this->load->model("surat_masuk_model");
							$send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);

							$source = "";
							$dest = "";
							if ($jenis_surat == "internal") {
								$source = "./data/surat_internal/ttd/{$file_ttd}";
								$dest = "./data/surat_internal/surat_masuk/{$file_ttd}";
							} else {
								$source = "./data/surat_eksternal/ttd/{$file_ttd}";
								$dest = "./data/surat_eksternal/surat_masuk/{$file_ttd}";
							}
							copy($source, $dest);

							$detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);

							//baca notifikasi
							$read = $this->notification_model->read('surat_internal/tanda_tangan_detail', $id_surat_keluar);
							if ($read) {
								$this->emit('refresh_notification', array('user_id' => $detail->id_user_ttd));
							}

							$log_data = array(
								'action' => 'melakukan',
								'function' => 'tandatangan surat',
								'key_name' => 'nomor registrasi sistem',
								'key_value' => $detail->hash_id,
								'category' => 'surat_' . $detail->jenis_surat,
							);
							$this->logs_model->insert_log($log_data);


							//kirim notif ke pembuat surat
							$notif_data = array();
							$notif_data['title'] = 'Tandatangan Surat';
							$notif_data['message'] = 'Surat dengan nomor registrasi ' . $detail->hash_id . ' telah selesai ditandatangani dan di teruskan ke penerima';
							$notif_data['data'] = 'surat_' . $detail->jenis_surat . '/detail_surat_keluar';
							$notif_data['data_id'] = $id_surat_keluar;
							$notif_data['ntime'] = date('H:i:s');
							$notif_data['ndate'] = date('Y-m-d');
							$notif_data['user_id'] = $detail->id_user_input;
							$notif_data['category'] = 'surat_' . $detail->jenis_surat . '/surat_keluar';
							$this->notification_model->insert($notif_data);
							$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);

							$this->emit('new_notification', $notif_data);
							$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));

							// print_r($send_surat);die;
							foreach ($send_surat as $s) {
								//kirim notif ke penerima
								$detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
								$notif_data = array();
								$notif_data['title'] = 'Surat Masuk';
								$notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
								$notif_data['data'] = 'surat_' . $detail->jenis_surat . '/detail_surat_masuk';
								$notif_data['data_id'] = $s['id_surat_masuk'];
								$notif_data['ntime'] = date('H:i:s');
								$notif_data['ndate'] = date('Y-m-d');
								$notif_data['user_id'] = $s['id_user'];
								$notif_data['category'] = 'surat_' . $detail->jenis_surat . '/surat_masuk';
								$this->notification_model->insert($notif_data);
								$notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);

								$this->emit('new_notification', $notif_data);
								$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
							}


							$tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);
							// print_r($send_surat);die;
							foreach ($tembusan_s as $t) {
								//kirim notif ke penerima tembusan
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
								$this->emit('new_notification', $notif_data);
								$this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
							}
						} else {
							$log_data = array(
								'user_id'	=> $cekApi->user_id,
								'action' => 'gagal melakukan',
								'function' => 'tandatangan surat dikarenakan ' . $ttd['message'],
								'key_name' => 'nomor registrasi sistem',
								'key_value' => $detail->hash_id,
								'category' => 'surat_' . $detail->jenis_surat,
							);
							$this->logs_model->insert_log($log_data);
						}

						$response = array(
							'error'		=> $ttd['error'],
							'message'	=> $ttd['message'],
						);
					} else {
						$response = [
							'error'	=> true,
							'message' => 'Passpharse diperlukan',
						];
					}
				} else {
					$data = array(
						'status_ttd'	=> 'ditolak',
						'alasan_penolakan_ttd' => $this->post("alasan"),
					);
					$this->db->update("surat_keluar", $data, $where);
					$message = "Surat telah ditolak";
					$response = array(
						'error'		=> false,
						'message'	=> $message,
					);
				}
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	public function test_get()
	{
		$api_key = "950ebe5d228a5173360a4c683008121c";
		$id_surat_keluar = "49";
		$cekApi = $this->user_model->checkApiKey($api_key);
		$filename = $this->tanda_tangan_surat($id_surat_keluar, $cekApi);
		echo "<pre>";
		print_r($filename);
	}



	private function tanda_tangan_surat($id, $user)
	{
		$this->load->model('surat_keluar_model');
		// GET DATA
		$berkas 	= $this->surat_keluar_model->get_detail_by_id($id);

		//$user 		= $this->get_current_sertifikat_user($user_id);

		if (empty($user->user_id) or empty($user->certificate) or empty($user->dot_key) or empty($user->pass_key)) {
			return false;
		} else {

			//load tcpdf
			$this->load->library("Pdf");

			// https://github.com/pauln/tcpdi
			// create new PDF document
			$pdf = new TCPDI('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

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
			$pdf->Output($_SERVER['DOCUMENT_ROOT'] . "data/surat_internal/ttd/{$filename}", 'F');

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



	function get_unread_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);


		if ($api_key != null && $cekApi) {
			$id_skpd = $this->post('id_skpd');
			$id_pegawai = $this->post('id_pegawai');

			$pegawai = $this->getPegawai($id_pegawai);

			///// surat masuk
			/*			
			if($pegawai->id_jabatan=="0")
			{
				$this->db->group_start();
				$this->db->where('surat_masuk.id_pegawai_penerima', $id_pegawai);
				$this->db->or_where("surat_masuk.id_skpd_penerima",$pegawai->id_skpd);
				$this->db->group_end();
			}
			else{
*/
			$Date = date("Y-m-d");
			$tanggal_surat = date('Y-m-d', strtotime($Date . ' - 30 day'));

			$this->db->where("surat_masuk.tanggal_surat >= ", $tanggal_surat);
			$this->db->where('surat_masuk.id_pegawai_penerima', $id_pegawai);
			$this->db->where('surat_masuk.status_surat', "Belum Dibaca");
			$surat_masuk = $this->db->get('surat_masuk')->num_rows();


			///// disposisi
			$this->db->where('disposisi_surat_masuk.status_surat', "Belum Dibaca");
			$this->db->where("(disposisi_surat_masuk.id_pegawai='" . $id_pegawai . "' OR (disposisi_surat_masuk.id_pegawai is null AND disposisi_surat_masuk.id_skpd='" . $id_skpd . "') )");
			$this->db->join("surat_masuk", "surat_masuk.id_surat_masuk = disposisi_surat_masuk.id_surat_masuk", "left");
			$this->db->where("surat_masuk.tanggal_surat >= ", $tanggal_surat);
			$disposisi_surat_masuk = $this->db->get('disposisi_surat_masuk')->num_rows();

			$this->db->where('disposisi_surat_keluar.status_surat', "Belum Dibaca");
			$this->db->where("(disposisi_surat_keluar.id_pegawai='" . $id_pegawai . "' OR (disposisi_surat_keluar.id_pegawai is null AND disposisi_surat_keluar.id_skpd='" . $id_skpd . "') )");
			$disposisi_surat_keluar = $this->db->get('disposisi_surat_keluar')->num_rows();


			///// tembusan

			$this->db->where("surat_keluar_tembusan.id_pegawai", $id_pegawai);
			$this->db->where("surat_keluar.id_surat_keluar is not null");
			$this->db->where("surat_keluar.status_register", "Sudah Diregistrasi");
			$this->db->where('surat_keluar_tembusan.status_surat', "Belum Dibaca");
			$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');
			$this->db->where("surat_keluar.tgl_surat >= ", $tanggal_surat);
			$tembusan = $this->db->get('surat_keluar_tembusan')->num_rows();

			/// ttd
			$this->db->where('surat_keluar.id_pegawai_ttd', $id_pegawai);
			$this->db->where('status_verifikasi', "sudah_diverifikasi");
			//$this->db->where("status_ttd","menunggu_verifikasi");
			$this->db->where_in("status_ttd", array('menunggu_verifikasi'));
			$this->db->where('status_penomoran', "Y");
			$this->db->where('status_register !=', "Sudah Diregistrasi");
			$this->db->where("surat_keluar.tgl_surat >= ", $tanggal_surat);

			$ttd = $this->db->get('surat_keluar')->num_rows();

			// verifikasi
			$this->db->where('surat_keluar.id_pegawai_verifikasi', $id_pegawai);
			$this->db->where('status_register !=', "Sudah Diregistrasi");
			$this->db->where('status_verifikasi', "menunggu_verifikasi");
			$this->db->where("surat_keluar.tgl_surat >= ", $tanggal_surat);

			$verifikasi = $this->db->get('surat_keluar')->num_rows();

			$data = array(
				'surat_masuk'	=> $surat_masuk,
				'disposisi'		=> ($disposisi_surat_masuk + $disposisi_surat_keluar),
				'tembusan' 		=> $tembusan,
				'ttd'			=> $ttd,
				'verifikasi'	=> $verifikasi,
			);

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_detail_surat_masuk_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		$id_surat_masuk = $this->post('id_surat_masuk');
		if ($api_key != null && $cekApi && !empty($id_surat_masuk)) {

			$this->db->select("surat_masuk.*, pegawai.foto_pegawai as user_picture")
				->where('surat_masuk.id_surat_masuk', $id_surat_masuk)
				->join('ref_skpd', 'surat_masuk.id_skpd_penerima = ref_skpd.id_skpd', 'left')
				->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai', 'left')
				->group_by("surat_masuk.id_surat_masuk");
			// ->join('user', 'surat_masuk.id_pegawai_input = user.id_pegawai','left')
			$data = $this->db->get('surat_masuk')->row();
			if ($data) {
				if($data->surat_desa=="1"){
					$data->url_surat = $this->config->item('url_desa'). "data/surat_" . $data->jenis_surat . "/surat_masuk/" . $data->file_surat;
					$data->_url_lampiran = $this->config->item('url_desa'). "data/" . $data->jenis_surat . "/lampiran/" . $data->lampiran;
				}else{
					$data->url_surat = base_url(). "data/surat_" . $data->jenis_surat . "/surat_masuk/" . $data->file_surat;
					$data->_url_lampiran = base_url() . "data/" . $data->jenis_surat . "/lampiran/" . $data->lampiran;
				}

				$this->surat_masuk_model->baca_surat($id_surat_masuk);
				$response = array(
					'error'		=> false,
					'data'		=> $data,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Surat tidak ditemukan.',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_detail_surat_keluar_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		$id_surat_keluar = $this->post('id_surat_keluar');
		if ($api_key != null && $cekApi && !empty($id_surat_keluar)) {

			$this->db->where('surat_keluar.id_surat_keluar', $id_surat_keluar);
			$data = $this->db->get('surat_keluar')->row();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_detail_disposisi_surat_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$jenis = $this->post('jenis');
			$id_disposisi = $this->post('id_disposisi');
			$data = null;

			if (!empty($jenis) && !empty($id_disposisi)) {
				if ($jenis == "masuk") {
					$this->db->update("disposisi_surat_masuk", array('status_surat' => 'Sudah Dibaca'), array('id_disposisi_masuk' => $id_disposisi));
					$this->db->select("disposisi_surat_masuk.*,surat_masuk.*, pegawai.foto_pegawai as user_picture, 'masuk' as 'disposisi' ")
						->where("id_disposisi_masuk", $id_disposisi)
						->join('surat_masuk', 'surat_masuk.id_surat_masuk = disposisi_surat_masuk.id_surat_masuk', 'left')
						->join('ref_skpd', 'disposisi_surat_masuk.id_skpd = ref_skpd.id_skpd', 'left')
						->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai', 'left')
						->group_by("disposisi_surat_masuk.id_surat_masuk");
					// ->join('user', 'disposisi_surat_masuk.id_pegawai = user.id_pegawai','left')

					$data = $this->db->get('disposisi_surat_masuk')->row();
				} else {
					$this->db->update("disposisi_surat_keluar", array('status_surat' => 'Sudah Dibaca'), array('id_disposisi_keluar' => $id_disposisi));
					$this->db->select("disposisi_surat_keluar.*,surat_keluar.*, pegawai.foto_pegawai as user_picture, 'keluar' as 'disposisi' ")
						->where("id_disposisi_keluar", $id_disposisi)
						->join('surat_keluar', 'surat_keluar.id_surat_keluar = disposisi_surat_keluar.id_surat_keluar', 'left')
						->join('ref_skpd', 'disposisi_surat_keluar.id_skpd = ref_skpd.id_skpd', 'left')
						->join('pegawai', 'surat_masuk.id_pegawai_input = pegawai.id_pegawai', 'left')
						->group_by("disposisi_surat_keluar.id_surat_keluar");
					// ->join('user', 'disposisi_surat_keluar.id_pegawai = user.id_pegawai','left')

					$data = $this->db->get('disposisi_surat_keluar')->row();
				}

				$response = array(
					'error'		=> false,
					'data'		=> $data,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Invalid data',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_detail_disposisi_surat_v2_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_disposisi = $this->post('id_disposisi');
			$jenis = $this->post('jenis');
			$data = null;

			if (!empty($id_disposisi) && !empty($jenis)) {

				$userdata = array(
					'id_pegawai' 		=> $cekApi->id_pegawai,
					'id_skpd'			=> $cekApi->id_skpd,
					'id_unit_kerja'		=> $cekApi->id_unit_kerja,
					'kepala_skpd'		=> $cekApi->kepala_skpd,
					'user_privileges'	=> $cekApi->user_privileges
				);
				$this->surat_masuk_model->user_data = $userdata;


				if ($jenis == "masuk") {
					$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_by_id($id_disposisi);
				} else {
					$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_keluar_by_id($id_disposisi);
				}
				if ($data['detail']) {

					if (($data['detail']->id_pegawai == $cekApi->id_pegawai or ($data['detail']->id_pegawai < 1
							and $data['detail']->id_unit_kerja == $cekApi->id_unit_kerja) or ($data['detail']->id_pegawai < 1
							and $data['detail']->id_unit_kerja < 1 and $data['detail']->id_skpd == $cekApi->id_skpd))
						and (!$data['detail']->tgl_terima or $data['detail']->status_surat == "Belum Dibaca")
					) {

						$this->surat_masuk_model->baca_surat_disposisi($id_disposisi);
					}

					if ($jenis == "masuk") {
						$detail = $this->surat_masuk_model->get_detail_disposisi_by_id($id_disposisi);
					} else {
						$detail = $this->surat_masuk_model->get_detail_disposisi_keluar_by_id($id_disposisi);
					}

					//var_dump($userdata);
					$detail->_tanggal_surat = date('d M Y', strtotime($detail->tanggal_surat));
					$detail->_tanggal_terima = date('d M Y', strtotime($detail->tgl_terima));
					$detail->_tanggal_input = date('d M Y', strtotime($detail->tgl_input));
					$detail->_tanggal_dibaca = date('d M Y', strtotime($detail->tgl_dibaca));

					$jenis_surat = "surat_" . $detail->jenis_surat;

					$base_url = base_url();
					if($detail->surat_desa==1)
					{
						$base_url = "https://e-officedesa.sumedangkab.go.id";
					}

					$detail->_url_surat = $base_url . "/data/" . $jenis_surat . "/surat_masuk/" . $detail->file_surat;
					$detail->_url_lampiran = $base_url . "/data/" . $jenis_surat . "/lampiran/" . $detail->lampiran;

					$response = array(
						'error'		=> false,
						'data'		=> $detail,

					);
				} else {
					$response = [
						'error'	=> true,
						'message' => 'Data tidak ditemukan',
					];
				}
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Invalid data',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}

	function get_detail_tembusan_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$id_surat_keluar_tembusan = $this->post('id_surat_keluar_tembusan');


			if (!empty($id_surat_keluar_tembusan)) {
				$this->surat_keluar_model->baca_surat_tembusan($id_surat_keluar_tembusan);

				$this->db->select("surat_keluar_tembusan.*,surat_keluar.*, pegawai.foto_pegawai as user_picture");
				$this->db->where("surat_keluar_tembusan.id_surat_keluar_tembusan", $id_surat_keluar_tembusan);
				$this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = surat_keluar_tembusan.id_surat_keluar', 'left');

				// $this->db->join('user', 'user.id_pegawai = surat_keluar_tembusan.id_pegawai','left');
				$this->db->join('pegawai', 'pegawai.id_pegawai = surat_keluar_tembusan.id_pegawai', 'left');

				$data = $this->db->get('surat_keluar_tembusan')->row();

				$response = array(
					'error'		=> false,
					'data'		=> $data,
				);
			} else {
				$response = [
					'error'	=> true,
					'message' => 'Data tidak lengkap',
				];
			}
		} else {
			$response = [
				'error'	=> true,
				'message' => 'Invalid credential',
			];
		}



		$this->response($response);
	}
}
