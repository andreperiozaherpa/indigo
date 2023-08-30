<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
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

class Simpeg extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('simpeg_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name = $this->user_model->full_name;
		$this->user_level = $this->user_model->level;
		$this->user_privileges = explode(";", $this->user_model->user_privileges);

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->db_simpeg = $this->load->database('simpeg', TRUE);
		$this->case_riwayat = array(
			'pangkat',
			'jabatan',
			'pendidikan',
			'latihan',
			'organisasi',
			'penghargaan',
			// 'absen',
			// 'bahasa',
			// 'keluarga',
			// 'kedudukan',
			// 'indikator'
		);
		// var_dump(file_exists('./data/simpeg/riwayat_pangkat/')); die();

		if (!$this->user_id) {
			redirect("admin/login");
		}

		if ($this->user_level != "Administrator") {
			// show_404();
		}
	}

	public function index()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('kepegawaian', $this->user_privileges))) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$get_data = $this->simpeg_model->get_recent_update();
			$skpd = (isset($_GET['skpd'])) ? $_GET['skpd'] : $this->session->userdata('id_skpd');
			if ($this->user_level != "Administrator" and $this->session->userdata('id_skpd') != 24 and $this->session->userdata('id_skpd') != 4) {
				$skpd = $this->session->userdata('id_skpd');
				$_GET['id_unit'] = $skpd;
				$data['skpd'] = $this->ref_skpd_model->get_all();
			}
			$_GET['skpd'] = $skpd;

			$per_page = 6;
			$offset = (isset($_GET['per_page'])) ? $_GET['per_page'] : 0;
			$s = (isset($_GET['s'])) ? $_GET['s'] : "";

			for ($i = $offset; $i < ($per_page + $offset); $i++) {
				$page[] = @$get_data[$i];
			}
			$search = implode(',', $get_data);
			$_POST['s'] = $search;
			// echo $this->input->post('s'); die();
			// echo 'master_pegawai_recent?per_page='.$per_page.'&offset='.$offset.'&s=&skpd='.$skpd; die();
			$get_api = curlSimpeg('master_pegawai_recent?per_page=' . $per_page . '&offset=' . $offset . '&s=' . $s . '&skpd=' . $skpd, $_POST);
			$get_api = json_decode($get_api);
			// var_dump($get_api);die();
			// echo 'master_pegawai_recent?per_page='.$per_page.'&offset='.$offset.'&s='.$search.'&skpd='.$skpd;die();

			$this->load->library('pagination');
			$config['base_url'] = base_url($this->router->fetch_class() . "/" . $this->router->fetch_method());
			$config['total_rows'] = $get_api->total_rows;
			$config['per_page'] = $per_page;
			$data['master_pegawai'] = $get_api->master_pegawai;

			$this->pagination->initialize($config);
			// echo $this->pagination->create_links(); die();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function cari()
	{
		if ($this->user_id and ($this->user_level == "Administrator" or in_array('kepegawaian', $this->user_privileges))) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";


			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$skpd = (isset($_GET['skpd'])) ? $_GET['skpd'] : "";
			if ($this->user_level != "Administrator" and $this->session->userdata('id_skpd') != 24 and $this->session->userdata('id_skpd') != 4) {
				$skpd = $this->session->userdata('id_skpd');
				$_GET['id_unit'] = $skpd;
				$data['skpd'] = $this->ref_skpd_model->get_all();
			}
			$_GET['skpd'] = $skpd;

			$per_page = 6;
			$offset = (isset($_GET['per_page'])) ? $_GET['per_page'] : 0;
			$search = (isset($_GET['s'])) ? $_GET['s'] : "";
			$search = strtolower($search);
			$get_api = curlSimpeg('master_pegawai?per_page=' . $per_page . '&offset=' . $offset . '&s=' . $search . '&skpd=' . $skpd);
			$get_api = json_decode($get_api);
			// var_dump($get_api);die();

			// echo 'master_pegawai?per_page='.$per_page.'&offset='.$offset.'&s='.$search.'&skpd='.$skpd;die();

			$this->load->library('pagination');
			$config['base_url'] = base_url($this->router->fetch_class() . "/" . $this->router->fetch_method());
			$config['total_rows'] = $get_api->total_rows;
			$config['per_page'] = $per_page;

			$data['master_pegawai'] = $get_api->master_pegawai;

			$this->pagination->initialize($config);

			// echo $this->pagination->create_links(); die();

			$this->load->view('admin/index', $data);


		} else {
			redirect('admin');
		}
	}

	public function my_profiles()
	{
		$nip = $this->session->userdata('username');
		// $data = $this->simpeg_model->get_by_nip($nip);
		$db_simpeg = $this->load->database('simpeg', TRUE);
		$db_simpeg->select('*');

		// $db_simpeg->join('master_pegawai', 'master_pegawai.id_orang = master_orang.id_orang', 'left');

		$data = $db_simpeg->get_where('master_orang', array('master_orang.nip_pns' => $nip));
		echo $this->session->userdata('id_skpd');
		var_dump($data->row());
		die();
		if ($data) {
			$this->detail($data->id_orang);
		} else {
			show_404();
		}
	}

	public function my_profile()
	{
		$nip = $this->session->userdata('username');
		// $data = $this->simpeg_model->get_by_nip($nip);
		// var_dump($data);
		// die();
		$get_api = curlSimpeg('get_id_by_nip?nip=' . $nip);
		$get_api = json_decode($get_api);
		// print_r($get_api->pegawai);
		// die();
		$data = @$get_api->pegawai;

		if ($data) {
			$t = date('j');
			$s = $this->session->userdata('id_skpd');
			if (date('Y-m') == '2021-05' and $s != 24 and date('H') >= 7 and date('H') <= 17) {
				switch (true) {
					case in_array($t, range(1, 3)):
						switch ($s) {
							case 1:
							case 3:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(4, 5)):
						switch ($s) {
							case 4:
							case 13:
								break;
							default:
								show_404();
								break;
						}
						break;
					// case in_array($t, range(6,7)):
					// switch ($s) {
					// 	case 5: case 9: break;
					// 	default: show_404(); break;
					// }
					// break;
					// case in_array($t, range(10,11)):
					// switch ($s) {
					// 	case 5: case 9: break;
					// 	default: show_404(); break;
					// }
					// break;
					case in_array($t, range(17, 17)):
						switch ($s) {
							case 6:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(18, 18)):
						switch ($s) {
							case 7:
							case 10:
							case 12:
							case 17:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(19, 19)):
						switch ($s) {
							case 11:
							case 16:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(20, 20)):
						switch ($s) {
							case 14:
							case 15:
							case 18:
							case 19:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(21, 21)):
						switch ($s) {
							case 21:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(24, 24)):
						switch ($s) {
							case 20:
							case 22:
							case 23:
							case 25:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(25, 25)):
						switch ($s) {
							case 26:
							case 2:
							case 8:
							case 35:
							case 36:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(26, 27)):
						switch ($s) {
							case 30:
							case 110:
							case 111:
							case 65:
							case 67:
							case 71:
							case 66:
							case 70:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(28, 28)):
						switch ($s) {
							case 51:
							case 60:
							case 43:
							case 38:
							case 59:
							case 56:
							case 50:
							case 45:
							case 58:
							case 53:
							case 37:
							case 52:
							case 40:
								break;
							default:
								show_404();
								break;
						}
						break;
					case in_array($t, range(31, 31)):
						switch ($s) {
							case 44:
							case 48:
							case 46:
							case 57:
							case 41:
							case 42:
							case 62:
							case 49:
							case 61:
							case 39:
							case 54:
							case 55:
							case 47:
								break;
							default:
								show_404();
								break;
						}
						break;
				}
			}
			$this->detail($data->id_orang);
		} else {
			show_404();
		}
	}



	public function detail($id)
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$get_api = curlSimpeg('detail?id=' . $id);
			// var_dump($get_api);
			// die();
			$get_api = json_decode($get_api);

			if ($this->user_level != "Administrator" and (!in_array('kepegawaian', $this->user_privileges) or $this->session->userdata('id_skpd') != 24 and $this->session->userdata('id_skpd') != 4 /*$get_api->pegawai->id_skpd*/) and $this->session->userdata('username') != $get_api->pegawai->nip_baru) {
				redirect('admin');
			}

			$data['recent_update'] = $this->simpeg_model->get_recent_update($id);

			$data['pegawai'] = $get_api->pegawai;

			$data['ref_agama'] = $get_api->ref_agama;
			$data['ref_kelahiran'] = $get_api->ref_kelahiran;
			$data['ref_kawin'] = $get_api->ref_kawin;
			$data['ref_tingkatpendidikan'] = $get_api->ref_tingkatpendidikan;

			$data['ref_eselon'] = $get_api->ref_eselon;
			// dd($data['ref_eselon']);
			$data['ref_golongan'] = $get_api->ref_golongan;
			$data['ref_instansi'] = $get_api->ref_instansi;
			$data['ref_satuankerja'] = $get_api->ref_satuankerja;
			$data['ref_jabatan'] = $get_api->ref_jabatan;

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}

	public function cetak_profil($id)
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$get_api = curlSimpeg('detail?id=' . $id);
			$get_api = json_decode($get_api);

			if ($this->user_level != "Administrator" and (!in_array('kepegawaian', $this->user_privileges) or $this->session->userdata('id_skpd') != 24 /*$get_api->pegawai->id_skpd*/) and $this->session->userdata('username') != $get_api->pegawai->nip_baru) {
				redirect('admin');
			}

			$data['recent_update'] = $this->simpeg_model->get_recent_update($id);

			$data['pegawai'] = $pegawai = $get_api->pegawai;

			$data['ref_agama'] = $ref_agama = $get_api->ref_agama;
			$data['ref_kelahiran'] = $ref_kelahiran = $get_api->ref_kelahiran;
			$data['ref_kawin'] = $ref_kawin = $get_api->ref_kawin;
			$data['ref_tingkatpendidikan'] = $ref_tingkatpendidikan = $get_api->ref_tingkatpendidikan;

			$data['ref_eselon'] = $ref_eselon = $get_api->ref_eselon;
			$data['ref_golongan'] = $ref_golongan = $get_api->ref_golongan;
			$data['ref_instansi'] = $ref_instansi = $get_api->ref_instansi;
			$data['ref_satuankerja'] = $ref_satuankerja = $get_api->ref_satuankerja;
			$data['ref_jabatan'] = $ref_jabatan = $get_api->ref_jabatan;

			foreach ($this->case_riwayat as $case) {
				$riwayat[$case] = $this->get_riwayat_biodata($case, $pegawai->id_pns, $pegawai->nip_pns);
			}
			// print_r($riwayat['latihan']);die;


			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$phpWord->getCompatibility()->setOoxmlVersion(14);
			$phpWord->getCompatibility()->setOoxmlVersion(15);

			//$template = $detail->file_draft;
			$filename = 'biodata_' . $pegawai->nama_lengkap . time() . ".docx";
			$filename = str_replace(",", "", $filename);
			$filename = str_replace(" ", "_", $filename);
			$filename = str_replace("/", "_", $filename);
			//$filename = 'tes.docx';	
			$template_path = './data/simpeg_profile/template/biodata_pegawai.docx';

			$template = $phpWord->loadTemplate($template_path);

			$foto_pegawai = get_foto_pegawai_path_by_nip($pegawai->nip_pns);
			// print_r($foto_pegawai); die();
			$template->setImageValue('image1.png', $foto_pegawai);

			// $template->setValue('hari', poee(date('N', strtotime($pegawai->tgl_pengesahan))));
			// $template->setValue('nama_lengkap', $pegawai->nama_lengkap);

			$pegawai->jenis_kelamin = ($pegawai->jenis_kelamin == "L") ? "Laki-laki" : "Perempuan";
			$pegawai->nama_agama = convert_data($ref_agama, 'kode_agama', $pegawai->id_agama, 'nama_agama');
			$pegawai->nama_kelahiran = convert_data($ref_kelahiran, 'kode_kelahiran', $pegawai->id_tempat_lahir, 'nama_kelahiran');
			$pegawai->nama_kawin = convert_data($ref_kawin, 'kode_kawin', $pegawai->id_status_kawin, 'nama_kawin');
			$pegawai->nama_tingkatpendidikan = convert_data($ref_tingkatpendidikan, 'kode_tingkatpendidikan', $pegawai->id_tingkat_pendidikan, 'nama_tingkatpendidikan');

			$pegawai->nama_eselon = convert_data($ref_eselon, 'kode_eselon', $pegawai->id_eselon, 'nama_eselon');
			$pegawai->jabatan_asn = convert_data($ref_eselon, 'kode_eselon', $pegawai->id_eselon, 'jabatan_asn');
			$pegawai->pangkat_golongan = convert_data($ref_golongan, 'kode_golongan', $pegawai->id_golongan_akhir, 'pangkat_golongan');
			$pegawai->nama_golongan = convert_data($ref_golongan, 'kode_golongan', $pegawai->id_golongan_akhir, 'nama_golongan');
			$pegawai->nama_instansi = convert_data($ref_instansi, 'kode_instansi', $pegawai->id_instansi_kerja, 'nama_instansi');
			$pegawai->nama_satuankerja = convert_data($ref_satuankerja, 'kode_satuankerja', $pegawai->id_satuan_kerja, 'nama_satuankerja');
			$pegawai->nama_jabatan = convert_data($ref_jabatan, 'kode_jabatan', $pegawai->id_jabatan, 'nama_jabatan');


			if (count($riwayat['pangkat']['pangkat']) > 0) {
				$no_riwayat_pangkat = 1;
				$template->cloneRow('no_riwayat_pangkat', count($riwayat['pangkat']['pangkat']));
				$array = get_object_vars($riwayat['pangkat']['pangkat'][0]);
				$pangkat_keys = array_keys($array);
				foreach ($riwayat['pangkat']['pangkat'] as $row) {
					$template->setValue('no_riwayat_pangkat#' . $no_riwayat_pangkat, $no_riwayat_pangkat);
					$row->tmt_pangkat = tanggal($row->tmt_pangkat);
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($pangkat_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_pangkat, $row->$value);
						}
					}
					$no_riwayat_pangkat++;
				}
			}

			if (count($riwayat['pangkat']['kredit']) > 0) {
				$no_riwayat_kredit = 1;
				$template->cloneRow('no_riwayat_kredit', count($riwayat['pangkat']['kredit']));
				$array = get_object_vars($riwayat['pangkat']['kredit'][0]);
				$kredit_keys = array_keys($array);
				foreach ($riwayat['pangkat']['kredit'] as $row) {
					$template->setValue('no_riwayat_kredit#' . $no_riwayat_kredit, $no_riwayat_kredit);
					$sd_penilaian = ($row->bulan_mulai_penilaian == $row->bulan_selesai_penilaian and $row->tahun_mulai_penilaian == $row->tahun_selesai_penilaian) ? "" : " s/d " . bulan($row->bulan_selesai_penilaian) . " " . $row->tahun_selesai_penilaian;
					$row->bulan_mulai_penilaian = bulan($row->bulan_mulai_penilaian) . " " . $row->tahun_mulai_penilaian . $sd_penilaian;
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($kredit_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_kredit, $row->$value);
						}
					}
					$no_riwayat_kredit++;
				}
			}

			if (count($riwayat['jabatan']['jabatan']) > 0) {
				$no_riwayat_jabatan = 1;
				$template->cloneRow('no_riwayat_jabatan', count($riwayat['jabatan']['jabatan']));
				$array = get_object_vars($riwayat['jabatan']['jabatan'][0]);
				$jabatan_keys = array_keys($array);
				foreach ($riwayat['jabatan']['jabatan'] as $row) {
					$template->setValue('no_riwayat_jabatan#' . $no_riwayat_jabatan, $no_riwayat_jabatan);
					$row->id_skpd = ($row->id_skpd > 0) ? $row->nama_skpd : $row->skpd_lainnya;
					$row->id_unit_kerja = ($row->id_unit_kerja > 0) ? $row->nama_unit_kerja : $row->unit_kerja_lainnya;
					$row->id_ref_jabatan = ($row->id_ref_jabatan > 0) ? $row->nama_jabatan : $row->ref_jabatan_lainnya;
					$row->plt = ($row->plt == "Y") ? "(PLT)" : "";
					$row->tmt_berlaku = tanggal($row->tmt_berlaku);
					$row->tmt_berakhir = ($row->tmt_berakhir) ? tanggal($row->tmt_berakhir) : "Sampai sekarang";
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($jabatan_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_jabatan, $row->$value);
						}
					}
					$no_riwayat_jabatan++;
				}
			}

			if (count($riwayat['jabatan']['mutasi']) > 0) {
				$no_riwayat_mutasi = 1;
				$template->cloneRow('no_riwayat_mutasi', count($riwayat['jabatan']['mutasi']));
				$array = get_object_vars($riwayat['jabatan']['mutasi'][0]);
				$mutasi_keys = array_keys($array);
				foreach ($riwayat['jabatan']['mutasi'] as $row) {
					$template->setValue('no_riwayat_mutasi#' . $no_riwayat_mutasi, $no_riwayat_mutasi);
					$row->id_skpd = ($row->id_skpd > 0) ? $row->nama_skpd : $row->skpd_lainnya;
					$row->id_unit_kerja = ($row->id_unit_kerja > 0) ? $row->nama_unit_kerja : $row->unit_kerja_lainnya;
					$row->id_skpd_asal = ($row->id_skpd > 0) ? $row->nama_skpd_asal : $row->skpd_lainnya_asal;
					$row->id_unit_kerja_asal = ($row->id_unit_kerja > 0) ? $row->nama_unit_kerja_asal : $row->unit_kerja_lainnya_asal;
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($mutasi_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_mutasi, $row->$value);
						}
					}
					$no_riwayat_mutasi++;
				}
			}

			if (count($riwayat['pendidikan']['pendidikan']) > 0) {
				$no_riwayat_pendidikan = 1;
				$template->cloneRow('no_riwayat_pendidikan', count($riwayat['pendidikan']['pendidikan']));
				$array = get_object_vars($riwayat['pendidikan']['pendidikan'][0]);
				$pendidikan_keys = array_keys($array);
				foreach ($riwayat['pendidikan']['pendidikan'] as $row) {
					$template->setValue('no_riwayat_pendidikan#' . $no_riwayat_pendidikan, $no_riwayat_pendidikan);

					$kecuali = array('', );
					foreach ($pendidikan_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_pendidikan, $row->$value);
						}
					}
					$no_riwayat_pendidikan++;
				}
			}

			if (count($riwayat['pendidikan']['profesi']) > 0) {
				$no_riwayat_profesi = 1;
				$template->cloneRow('no_riwayat_profesi', count($riwayat['pendidikan']['profesi']));
				$array = get_object_vars($riwayat['pendidikan']['profesi'][0]);
				$profesi_keys = array_keys($array);
				foreach ($riwayat['pendidikan']['profesi'] as $row) {
					$template->setValue('no_riwayat_profesi#' . $no_riwayat_profesi, $no_riwayat_profesi);

					$kecuali = array('', );
					foreach ($profesi_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_profesi, $row->$value);
						}
					}
					$no_riwayat_profesi++;
				}
			}

			if (count($riwayat['latihan']['diklat']) > 0) {
				$no_riwayat_diklat = 1;
				$template->cloneRow('no_riwayat_diklat', count($riwayat['latihan']['diklat']));
				$array = get_object_vars($riwayat['latihan']['diklat'][0]);
				$diklat_keys = array_keys($array);
				foreach ($riwayat['latihan']['diklat'] as $row) {
					$template->setValue('no_riwayat_diklat#' . $no_riwayat_diklat, $no_riwayat_diklat);
					$row->tmt_mulai = tanggal($row->tmt_mulai);
					$row->tmt_berakhir = tanggal($row->tmt_berakhir);

					$kecuali = array('', );
					foreach ($diklat_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_diklat, $row->$value);
						}
					}
					$no_riwayat_diklat++;
				}
			}

			if (count($riwayat['latihan']['kursus']) > 0) {
				$no_riwayat_kursus = 1;
				$template->cloneRow('no_riwayat_kursus', count($riwayat['latihan']['kursus']));
				$array = get_object_vars($riwayat['latihan']['kursus'][0]);
				$kursus_keys = array_keys($array);
				foreach ($riwayat['latihan']['kursus'] as $row) {
					$template->setValue('no_riwayat_kursus#' . $no_riwayat_kursus, $no_riwayat_kursus);
					$row->tmt_mulai = tanggal($row->tmt_mulai);
					$row->tmt_berakhir = tanggal($row->tmt_berakhir);
					$row->jenis_sertifikat = ($row->jenis_sertifikat == "K") ? "Kursus" : "Sertifikat";

					$kecuali = array('', );
					foreach ($kursus_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_kursus, $row->$value);
						}
					}
					$no_riwayat_kursus++;
				}
			}

			if (count($riwayat['organisasi']['organisasi']) > 0) {
				$no_riwayat_organisasi = 1;
				$template->cloneRow('no_riwayat_organisasi', count($riwayat['organisasi']['organisasi']));
				$array = get_object_vars($riwayat['organisasi']['organisasi'][0]);
				$organisasi_keys = array_keys($array);
				foreach ($riwayat['organisasi']['organisasi'] as $row) {
					$template->setValue('no_riwayat_organisasi#' . $no_riwayat_organisasi, $no_riwayat_organisasi);
					$row->tmt_mulai = tanggal($row->tmt_mulai);
					$row->tmt_berakhir = ($row->tmt_berakhir and $row->tmt_berakhir != "0000-00-00") ? tanggal($row->tmt_berakhir) : "Sampai sekarang";

					$kecuali = array('', );
					foreach ($organisasi_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_organisasi, $row->$value);
						}
					}
					$no_riwayat_organisasi++;
				}
			}

			if (count($riwayat['organisasi']['penugasan']) > 0) {
				$no_riwayat_penugasan = 1;
				$template->cloneRow('no_riwayat_penugasan', count($riwayat['organisasi']['penugasan']));
				$array = get_object_vars($riwayat['organisasi']['penugasan'][0]);
				$penugasan_keys = array_keys($array);
				foreach ($riwayat['organisasi']['penugasan'] as $row) {
					$template->setValue('no_riwayat_penugasan#' . $no_riwayat_penugasan, $no_riwayat_penugasan);
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($penugasan_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_penugasan, $row->$value);
						}
					}
					$no_riwayat_penugasan++;
				}
			}

			if (count($riwayat['penghargaan']['penghargaan']) > 0) {
				$no_riwayat_penghargaan = 1;
				$template->cloneRow('no_riwayat_penghargaan', count($riwayat['penghargaan']['penghargaan']));
				$array = get_object_vars($riwayat['penghargaan']['penghargaan'][0]);
				$penghargaan_keys = array_keys($array);
				foreach ($riwayat['penghargaan']['penghargaan'] as $row) {
					$template->setValue('no_riwayat_penghargaan#' . $no_riwayat_penghargaan, $no_riwayat_penghargaan);
					$row->sk_tanggal = tanggal($row->sk_tanggal);

					$kecuali = array('', );
					foreach ($penghargaan_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_penghargaan, $row->$value);
						}
					}
					$no_riwayat_penghargaan++;
				}
			}

			if (count($riwayat['penghargaan']['prestasi']) > 0) {
				$no_riwayat_prestasi = 1;
				$template->cloneRow('no_riwayat_prestasi', count($riwayat['penghargaan']['prestasi']));
				$array = get_object_vars($riwayat['penghargaan']['prestasi'][0]);
				$prestasi_keys = array_keys($array);
				foreach ($riwayat['penghargaan']['prestasi'] as $row) {
					$template->setValue('no_riwayat_prestasi#' . $no_riwayat_prestasi, $no_riwayat_prestasi);

					$kecuali = array('', );
					foreach ($prestasi_keys as $value) {
						if (!in_array($value, $kecuali)) {
							$template->setValue($value . '#' . $no_riwayat_prestasi, $row->$value);
						}
					}
					$no_riwayat_prestasi++;
				}
			}


			$array = get_object_vars($pegawai);
			$pegawai_keys = array_keys($array);
			$kecuali = array('', );
			foreach ($pegawai_keys as $value) {
				if (!in_array($value, $kecuali)) {
					$template->setValue($value, $pegawai->$value);
				}
			}


			ob_clean();
			$template->saveAs("./data/simpeg_profile/tmp/" . $filename);

			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize("./data/simpeg_profile/tmp/" . $filename));
			flush();
			readfile("./data/simpeg_profile/tmp/" . $filename);

			// shell_exec("lowriter  --convert-to pdf ./data/simpeg_profile/tmp/{$filename} --outdir ./data/simpeg_profile/pegawai/ 2>&1");
			// $berkas_pdf  = pathinfo("./data/simpeg_profile/tmp/{$filename}", PATHINFO_FILENAME).".pdf";
			// unlink("./data/simpeg_profile/tmp/" . $filename);

			// header('Content-Description: File Transfer');
			// header('Content-Type: application/octet-stream');
			// header('Content-Disposition: attachment; filename=' . $berkas_pdf);
			// header('Content-Transfer-Encoding: binary');
			// header('Expires: 0');
			// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			// header('Pragma: public');
			// header('Content-Length: ' . filesize("./data/simpeg_profile/pegawai/" . $berkas_pdf));
			// flush();
			// readfile("./data/simpeg_profile/pegawai/" . $berkas_pdf);

			// $this->load->view('admin/index',$data);

		} else {
			redirect('admin');
		}
	}


	public function add()
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/add";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}


	public function add_orang()
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/add_orang";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			if ($_POST) {

				$html_escape = html_escape($_POST);
				$postdata = array();
				foreach ($html_escape as $key => $value) {
					$postdata[$key] = $this->security->xss_clean($value);
				}
				$this->form_validation->set_data($postdata);
				$check_data['id_kartu_identitas'] = $postdata['id_kartu_identitas'];
				$check_data['no_kartu_identitas'] = $postdata['no_kartu_identitas'];

				$validation_rules = [
					[
						'field' => 'id_kartu_identitas',
						'rules' => 'trim|required|numeric',
					],
					[
						'field' => 'no_kartu_identitas',
						'rules' => 'trim|required|callback_check_unique_id_card[' . json_encode($check_data) . ']',
					],
					[
						'field' => 'nama_lengkap',
						'rules' => 'required',
					],
					[
						'field' => 'jenis_kelamin',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_agama',
						'rules' => 'trim|required',
					],
					[
						'field' => 'tanggal_lahir',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_tempat_lahir',
						'rules' => 'trim|required',
					],
					[
						'field' => 'alamat',
						'rules' => 'required',
					],
					[
						'field' => 'nama_ayah',
						'rules' => 'required',
					],
					[
						'field' => 'nama_ibu',
						'rules' => 'required',
					],

				];

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run()) {

					$dt = $postdata;
					switch ($dt['id_kartu_identitas']) {
						case 1:
							$dt['no_ktp'] = $postdata['no_kartu_identitas'];
							break;
						case 2:
							$dt['no_paspor'] = $postdata['no_kartu_identitas'];
							break;
						case 3:
							$dt['no_sim'] = $postdata['no_kartu_identitas'];
							break;
					}
					unset($dt['no_kartu_identitas']);

					$config['upload_path'] = './data/user_picture/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2000;
					$config['max_width'] = 2000;
					$config['max_height'] = 2000;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('foto')) {
						$dt['foto'] = "useravatar.png";
						$tmp_name = $_FILES['foto']['tmp_name'];
						if ($tmp_name != "") {
							$data['message_type'] = "warning";
							$data['message'] = $this->upload->display_errors();
							print_r($this->upload->display_errors());
							die();
						}
					} else {
						$dt['foto'] = $this->upload->data('file_name');
					}


					// echo "<pre>";print_r($dt);die;
					$this->db_simpeg->insert("master_orang", $dt);
					$id_ref = $this->db_simpeg->insert_id();

					if ($id_ref) {
						$this->session->set_flashdata("success", "Master Orang berhasil ditambahkan");
						redirect($this->router->fetch_class() . "/add");
					} else {
						$this->session->set_flashdata("error", "Data gagal disimpan ");
					}

				} else {
					// echo validation_errors();
					// echo form_error('no_kartu_identitas');
					// echo set_value('no_kartu_identitas');
					$this->session->set_flashdata("error", "Data gagal disimpan ");
				}

				// echo "<pre>";
				// print_r($postdata);exit();
			}


			$this->load->model('ref_agama_model');
			$data['ref_agama'] = $this->ref_agama_model->get_active();

			$this->load->model('ref_kelahiran_model');
			$data['ref_kelahiran'] = $this->ref_kelahiran_model->get_active();

			$this->load->model('ref_tingkatpendidikan_model');
			$data['ref_tingkatpendidikan'] = $this->ref_tingkatpendidikan_model->get_active();

			$this->load->model('ref_pendidikan_model');
			$data['ref_pendidikan'] = $this->ref_pendidikan_model->get_active();

			$this->load->model('ref_kawin_model');
			$data['ref_kawin'] = $this->ref_kawin_model->get_active();

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}

	public function add_pegawai()
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/add_pegawai";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$data['search_id'] = urldecode($this->uri->segment(3));
			$data['search_no'] = urldecode($this->uri->segment(4));

			if ($_POST) {

				$html_escape = html_escape($_POST);
				$postdata = array();
				foreach ($html_escape as $key => $value) {
					$postdata[$key] = $this->security->xss_clean($value);
				}
				$this->form_validation->set_data($postdata);

				$validation_rules = [
					[
						'field' => 'id_kartu_identitas',
						'rules' => 'trim|required|numeric',
					],
					[
						'field' => 'no_kartu_identitas',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_orang',
						'rules' => 'trim|required|is_unique[master_pegawai.id_orang]',
					],
					[
						'field' => 'nip_baru',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_jenis_pegawai',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_kedudukan_hukum',
						'rules' => 'trim|required',
					],
					[
						'field' => 'status_cpns_pns',
						'rules' => 'trim|required',
					],
					[
						'field' => 'no_sk_cpns',
						'rules' => 'trim|required',
					],
					[
						'field' => 'tanggal_sk_cpns',
						'rules' => 'trim|required',
					],
					[
						'field' => 'tmt_cpns',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_kpkn',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_instansi_kerja',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_instansi_induk',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_satuan_kerja',
						'rules' => 'trim|required',
					],
					[
						'field' => 'id_satuan_kerja_induk',
						'rules' => 'trim|required',
					],
					// [
					// 	'field' => 'id_unit_kerja',
					// 	'rules' => 'trim|required',
					// ],
					[
						'field' => 'id_lokasi_kerja',
						'rules' => 'trim|required',
					],
					// [
					// 	'field' => 'id_jabatan',
					// 	'rules' => 'trim|required',
					// ],
					[
						'field' => 'tmt_jabatan',
						'rules' => 'trim|required',
					],
					[
						'field' => 'masa_kerja_tahun',
						'rules' => 'trim|required|numeric',
					],
					[
						'field' => 'masa_kerja_bulan',
						'rules' => 'trim|required|numeric',
					],

				];

				$this->form_validation->set_rules($validation_rules);

				if ($this->form_validation->run()) {

					$dt = $postdata;
					unset($dt['id_kartu_identitas']);

					// echo "<pre>";print_r($dt);die;
					$this->db_simpeg->insert("master_pegawai", $dt);
					$id_ref = $this->db_simpeg->insert_id();

					$dte = array(
						'pns' => 'Y',
						'id_pns' => $id_ref,
						'nip_pns' => $dt['nip_baru'],
					);
					$this->db_simpeg->where("id_orang", $dt['id_orang']);
					$query = $this->db_simpeg->update("master_orang", $dte);

					if ($id_ref or $dte) {
						$this->session->set_flashdata("success", "Master Pegawai berhasil ditambahkan");
						redirect($this->router->fetch_class() . "/add");
					} else {
						$this->session->set_flashdata("error", "Data gagal disimpan ");
					}

				} else {
					// echo validation_errors();
					// echo form_error('no_kartu_identitas');
					// echo set_value('no_kartu_identitas');
					$this->session->set_flashdata("error", "Data gagal disimpan ");
				}

				// echo "<pre>";
				// print_r($postdata);exit();
			}

			if ($data['search_id'] and $data['search_no']) {
				$this->db_simpeg->select('id_orang,pns,foto,nama_lengkap,kode_bkn_orang');
				$this->db_simpeg->from('master_orang');
				$this->db_simpeg->where('id_kartu_identitas', $data['search_id']);
				switch ($data['search_id']) {
					case 1:
						$this->db_simpeg->where('no_ktp', $data['search_no']);
						break;
					case 2:
						$this->db_simpeg->where('no_paspor', $data['search_no']);
						break;
					case 3:
						$this->db_simpeg->where('no_sim', $data['search_no']);
						break;

					default:
						$this->session->unmark_flash("primary");
						$this->session->set_flashdata("danger", "Jenis Kartu belum diisi.");
						break;
				}

				$query = $this->db_simpeg->get();
				$num = $query->num_rows();
				if ($num > 0) {
					$data['search_data'] = $query->row();
					if ($data['search_data']->pns != 'Y') {
						$this->session->unmark_flash("danger");
						$this->session->set_flashdata("primary", "Data dapat digunakan.");
					} else {
						$this->session->unmark_flash("primary");
						$this->session->set_flashdata("danger", "Data tidak dapat digunakan.");
					}
				} else {
					$this->session->unmark_flash("primary");
					$this->session->set_flashdata("danger", "Data tidak ditemukan.");
				}
			}

			$this->load->model('ref_jenispegawai_model');
			$data['ref_jenispegawai'] = $this->ref_jenispegawai_model->get_active();

			$this->load->model('ref_kedudukan_model');
			$data['ref_kedudukan'] = $this->ref_kedudukan_model->get_active();

			$this->load->model('ref_jenispengadaan_model');
			$data['ref_jenispengadaan'] = $this->ref_jenispengadaan_model->get_active();

			$this->load->model('ref_golongan_model');
			$data['ref_golongan'] = $this->ref_golongan_model->get_active();

			$this->load->model('ref_eselon_model');
			$data['ref_eselon'] = $this->ref_eselon_model->get_active();

			$this->load->model('ref_kpkn_model');
			$data['ref_kpkn'] = $this->ref_kpkn_model->get_active();

			$this->load->model('ref_instansi_model');
			$data['ref_instansi'] = $this->ref_instansi_model->get_active();

			$this->load->model('ref_satuankerja_model');
			$data['ref_satuankerja'] = $this->ref_satuankerja_model->get_active();

			$this->load->model('ref_kelahiran_model');
			$data['ref_kelahiran'] = $this->ref_kelahiran_model->get_active();

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}


	public function edit_orang()
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/edit_orang";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}


	public function edit_pegawai()
	{
		if ($this->user_id) {
			$data['title'] = "Master Pegawai";
			$data['content'] = "simpeg/edit_pegawai";
			$data['user_picture'] = $this->user_picture;
			$data['full_name'] = $this->full_name;
			$data['user_level'] = $this->user_level;
			$data['active_menu'] = "simpeg";

			$this->load->view('admin/index', $data);

		} else {
			redirect('admin');
		}
	}




	function check_unique_id_card($key, $check_data)
	{
		$check_data = json_decode($check_data, true);
		$return = TRUE;
		if (!empty($key) and !empty($check_data['id_kartu_identitas']) and !empty($check_data['no_kartu_identitas'])) {
			$this->db_simpeg->select('id_orang');
			$this->db_simpeg->from('master_orang');
			$this->db_simpeg->where('id_kartu_identitas', $check_data['id_kartu_identitas']);
			switch ($check_data['id_kartu_identitas']) {
				case 1:
					$this->db_simpeg->where('no_ktp', $check_data['no_kartu_identitas']);
					break;
				case 2:
					$this->db_simpeg->where('no_paspor', $check_data['no_kartu_identitas']);
					break;
				case 3:
					$this->db_simpeg->where('no_sim', $check_data['no_kartu_identitas']);
					break;

				default:
					$this->form_validation->set_message('check_unique_id_card', "Jenis Kartu belum diisi.");
					$return = FALSE;
					break;
			}

			$query = $this->db_simpeg->get();
			$num = $query->num_rows();
			if ($num > 0) {
				$this->form_validation->set_message('check_unique_id_card', "%s sudah dipakai.");
				$return = FALSE;
			}
		} else {
			$this->form_validation->set_message('check_unique_id_card', "%s belum diisi.");
			$return = FALSE;
		}
		return $return;
	}



	function get_riwayat($item, $id, $nip)
	{
		$this->simpeg_model->id = $data['id'] = $id;
		$this->simpeg_model->nip = $data['nip'] = $nip;

		$get_api = curlSimpeg('riwayat?item=' . $item . '&id=' . $id . '&nip=' . $nip);
		$get_api = json_decode($get_api);

		switch ($item) {
			case 'pangkat':
				$data['ref_golongan'] = $get_api->ref_golongan;

				$data['pangkat'] = $get_api->pangkat;
				$data['kredit'] = $get_api->kredit;

				$data['dump_pangkat']['insert'] = $this->simpeg_model->get_riwayat_pangkat('insert');
				$data['dump_pangkat']['update'] = $this->simpeg_model->get_riwayat_pangkat('update');
				$data['dump_pangkat']['delete'] = $this->simpeg_model->get_riwayat_pangkat('delete');
				$data['dump_kredit']['insert'] = $this->simpeg_model->get_riwayat_kredit('insert');
				$data['dump_kredit']['update'] = $this->simpeg_model->get_riwayat_kredit('update');
				$data['dump_kredit']['delete'] = $this->simpeg_model->get_riwayat_kredit('delete');
				break;

			case 'jabatan':
				$data['ref_skpd'] = $get_api->ref_skpd;
				$data['ref_unit_kerja'] = $get_api->ref_unit_kerja;
				$data['ref_jabatan'] = $get_api->ref_jabatan;
				$data['ref_kpkn'] = $get_api->ref_kpkn;
				$data['ref_eselon'] = $get_api->ref_eselon;
				// dd($data['ref_eselon']);
				// die();

				$data['jabatan'] = $get_api->jabatan;
				$data['mutasi'] = $get_api->mutasi;
				$data['pwk'] = $get_api->pwk;

				$data['dump_jabatan']['insert'] = $this->simpeg_model->get_riwayat_jabatan('insert');
				$data['dump_jabatan']['update'] = $this->simpeg_model->get_riwayat_jabatan('update');
				$data['dump_jabatan']['delete'] = $this->simpeg_model->get_riwayat_jabatan('delete');
				$data['dump_mutasi']['insert'] = $this->simpeg_model->get_riwayat_mutasi('insert');
				$data['dump_mutasi']['update'] = $this->simpeg_model->get_riwayat_mutasi('update');
				$data['dump_mutasi']['delete'] = $this->simpeg_model->get_riwayat_mutasi('delete');
				$data['dump_pwk']['insert'] = $this->simpeg_model->get_riwayat_pwk('insert');
				$data['dump_pwk']['update'] = $this->simpeg_model->get_riwayat_pwk('update');
				$data['dump_pwk']['delete'] = $this->simpeg_model->get_riwayat_pwk('delete');
				break;

			case 'pendidikan':
				$data['ref_tingkatpendidikan'] = $get_api->ref_tingkatpendidikan;
				$data['ref_pendidikan'] = $get_api->ref_pendidikan;
				$data['ref_profesi'] = $get_api->ref_profesi;

				$data['pendidikan'] = $get_api->pendidikan;
				$data['profesi'] = $get_api->profesi;

				$data['dump_pendidikan']['insert'] = $this->simpeg_model->get_riwayat_pendidikan('insert');
				$data['dump_pendidikan']['update'] = $this->simpeg_model->get_riwayat_pendidikan('update');
				$data['dump_pendidikan']['delete'] = $this->simpeg_model->get_riwayat_pendidikan('delete');
				$data['dump_profesi']['insert'] = $this->simpeg_model->get_riwayat_profesi('insert');
				$data['dump_profesi']['update'] = $this->simpeg_model->get_riwayat_profesi('update');
				$data['dump_profesi']['delete'] = $this->simpeg_model->get_riwayat_profesi('delete');
				break;

			case 'latihan':
				$data['ref_latihan'] = $get_api->ref_latihan;
				$data['ref_kompetensi'] = $get_api->ref_kompetensi;
				$data['ref_jeniskursus'] = $get_api->ref_jeniskursus;
				$data['ref_instansi'] = $get_api->ref_instansi;

				$data['diklat'] = $get_api->diklat;
				$data['kursus'] = $get_api->kursus;

				$data['dump_diklat']['insert'] = $this->simpeg_model->get_riwayat_diklat('insert');
				$data['dump_diklat']['update'] = $this->simpeg_model->get_riwayat_diklat('update');
				$data['dump_diklat']['delete'] = $this->simpeg_model->get_riwayat_diklat('delete');
				$data['dump_kursus']['insert'] = $this->simpeg_model->get_riwayat_kursus('insert');
				$data['dump_kursus']['update'] = $this->simpeg_model->get_riwayat_kursus('update');
				$data['dump_kursus']['delete'] = $this->simpeg_model->get_riwayat_kursus('delete');
				break;

			case 'organisasi':
				$data['ref_kepanitiaan'] = $get_api->ref_kepanitiaan;
				$data['ref_penugasan'] = $get_api->ref_penugasan;

				$data['organisasi'] = $get_api->organisasi;
				$data['kepanitiaan'] = $get_api->kepanitiaan;
				$data['penugasan'] = $get_api->penugasan;

				$data['dump_organisasi']['insert'] = $this->simpeg_model->get_riwayat_organisasi('insert');
				$data['dump_organisasi']['update'] = $this->simpeg_model->get_riwayat_organisasi('update');
				$data['dump_organisasi']['delete'] = $this->simpeg_model->get_riwayat_organisasi('delete');
				$data['dump_kepanitiaan']['insert'] = $this->simpeg_model->get_riwayat_kepanitiaan('insert');
				$data['dump_kepanitiaan']['update'] = $this->simpeg_model->get_riwayat_kepanitiaan('update');
				$data['dump_kepanitiaan']['delete'] = $this->simpeg_model->get_riwayat_kepanitiaan('delete');
				$data['dump_penugasan']['insert'] = $this->simpeg_model->get_riwayat_penugasan('insert');
				$data['dump_penugasan']['update'] = $this->simpeg_model->get_riwayat_penugasan('update');
				$data['dump_penugasan']['delete'] = $this->simpeg_model->get_riwayat_penugasan('delete');
				break;

			case 'penghargaan':
				$data['ref_penghargaan'] = $get_api->ref_penghargaan;

				$data['penghargaan'] = $get_api->penghargaan;
				$data['prestasi'] = $get_api->prestasi;

				$data['dump_penghargaan']['insert'] = $this->simpeg_model->get_riwayat_penghargaan('insert');
				$data['dump_penghargaan']['update'] = $this->simpeg_model->get_riwayat_penghargaan('update');
				$data['dump_penghargaan']['delete'] = $this->simpeg_model->get_riwayat_penghargaan('delete');
				$data['dump_prestasi']['insert'] = $this->simpeg_model->get_riwayat_prestasi('insert');
				$data['dump_prestasi']['update'] = $this->simpeg_model->get_riwayat_prestasi('update');
				$data['dump_prestasi']['delete'] = $this->simpeg_model->get_riwayat_prestasi('delete');
				break;

			case 'absen':
				$data['ref_cuti'] = $get_api->ref_cuti;
				$data['ref_jenishukuman'] = $get_api->ref_jenishukuman;

				$data['cuti'] = $get_api->cuti;
				$data['hukuman'] = $get_api->hukuman;

				$data['dump_cuti']['insert'] = $this->simpeg_model->get_riwayat_cuti('insert');
				$data['dump_cuti']['update'] = $this->simpeg_model->get_riwayat_cuti('update');
				$data['dump_cuti']['delete'] = $this->simpeg_model->get_riwayat_cuti('delete');
				$data['dump_hukuman']['insert'] = $this->simpeg_model->get_riwayat_hukuman('insert');
				$data['dump_hukuman']['update'] = $this->simpeg_model->get_riwayat_hukuman('update');
				$data['dump_hukuman']['delete'] = $this->simpeg_model->get_riwayat_hukuman('delete');
				break;

			case 'bahasa':
				$data['bahasa'] = $get_api->bahasa;

				$data['dump_bahasa']['insert'] = $this->simpeg_model->get_riwayat_bahasa('insert');
				$data['dump_bahasa']['update'] = $this->simpeg_model->get_riwayat_bahasa('update');
				$data['dump_bahasa']['delete'] = $this->simpeg_model->get_riwayat_bahasa('delete');
				break;

			case 'keluarga':
				$data['master_orang'] = $this->simpeg_model->get_active();

				$data['ref_kelahiran'] = $get_api->ref_kelahiran;
				$data['ref_tingkatpendidikan'] = $get_api->ref_tingkatpendidikan;
				$data['master_pegawai'] = $this->simpeg_model->get_active_pegawai();

				$data['orangtua'] = $get_api->orangtua;
				$data['pernikahan'] = $get_api->pernikahan;
				$data['anak'] = $get_api->anak;

				$data['dump_orangtua']['insert'] = $this->simpeg_model->get_riwayat_orangtua('insert');
				$data['dump_orangtua']['update'] = $this->simpeg_model->get_riwayat_orangtua('update');
				$data['dump_orangtua']['delete'] = $this->simpeg_model->get_riwayat_orangtua('delete');
				$data['dump_pernikahan']['insert'] = $this->simpeg_model->get_riwayat_pernikahan('insert');
				$data['dump_pernikahan']['update'] = $this->simpeg_model->get_riwayat_pernikahan('update');
				$data['dump_pernikahan']['delete'] = $this->simpeg_model->get_riwayat_pernikahan('delete');
				$data['dump_anak']['insert'] = $this->simpeg_model->get_riwayat_anak('insert');
				$data['dump_anak']['update'] = $this->simpeg_model->get_riwayat_anak('update');
				$data['dump_anak']['delete'] = $this->simpeg_model->get_riwayat_anak('delete');
				break;

			case 'kedudukan':
				$data['ref_kedudukan'] = $get_api->ref_kedudukan;

				$data['kedudukan'] = $get_api->kedudukan;

				$data['dump_kedudukan']['insert'] = $this->simpeg_model->get_riwayat_kedudukan('insert');
				$data['dump_kedudukan']['update'] = $this->simpeg_model->get_riwayat_kedudukan('update');
				$data['dump_kedudukan']['delete'] = $this->simpeg_model->get_riwayat_kedudukan('delete');
				break;

			case 'indikator':
				$data['indikator'] = $get_api->indikator;

				$data['dump_indikator']['insert'] = $this->simpeg_model->get_riwayat_indikator('insert');
				$data['dump_indikator']['update'] = $this->simpeg_model->get_riwayat_indikator('update');
				$data['dump_indikator']['delete'] = $this->simpeg_model->get_riwayat_indikator('delete');
				break;

			default:
				# code...
				break;
		}


		$this->load->view('admin/simpeg/riwayat/riwayat_' . $item, $data);
	}

	function submit_riwayat($item)
	{
		if ($this->input->is_ajax_request()) {
			$html_escape = html_escape($_POST);
			$postdata = array();
			foreach ($html_escape as $key => $value) {
				$postdata[$key] = $this->security->xss_clean($value);
			}
			$dt = $postdata;

			if (isset($dt['tmt_berakhir']))
				$dt['tmt_berakhir'] = ($dt['tmt_berakhir'] == "") ? NULL : $dt['tmt_berakhir'];

			$upload = $this->do_upload($item);

			if (isset($upload['file_name'])) {
				$dt['berkas'] = $upload['file_name'];
				$data['error'] = '';
			} else {
				$dt['berkas'] = NULL;
				$data['error'] = $upload['error'];
			}

			if ($dt['verifikasi'] == "verifikasi") {
				$dt['status_verifikasi'] = "Diterima";
			} elseif ($dt['verifikasi'] == "tolak") {
				$dt['status_verifikasi'] = "Ditolak";
			} else {
				$dt['status_verifikasi'] = "Proses";
			}
			unset($dt['verifikasi']);

			$id_update = $this->input->post("id_" . $item);
			$id_dump = $this->input->post("id_update");
			if ($id_update == "") {
				$dt['status_update'] = "INSERT";
				$query = $this->db_simpeg->insert("riwayat_" . $item, $dt);
			} elseif ($id_dump == "") {
				if ($dt['berkas'] == NULL)
					unset($dt['berkas']);
				$dt['status_update'] = "UPDATE";
				$query = $this->db_simpeg->insert("riwayat_" . $item, $dt);
			} else {
				if ($dt['berkas'] == NULL)
					unset($dt['berkas']);
				$query = $this->db_simpeg->where("id_update", $id_dump)
					->update("riwayat_" . $item, $dt);
			}

			if ($query) {
				$data['status'] = TRUE;
			} else {
				$data['status'] = FALSE;
			}
		} else {
			$data['status'] = FALSE;
		}
		echo json_encode($data);
	}

	public function do_upload($item)
	{
		$config['upload_path'] = './data/simpeg/riwayat_' . $item . '/';
		$config['allowed_types'] = 'pdf';
		// $config['allowed_types']        = 'pjp|jpg|pjpeg|jpeg|jfif|gif|png|pdf';
		$config['max_size'] = 20000;
		$config['encrypt_name'] = TRUE;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		if (!file_exists($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('berkas')) {
			$error = array('error' => $this->upload->display_errors());

			return $error;
		} else {
			$data = $this->upload->data();

			return $data;
		}
	}


	function delete_riwayat($item)
	{
		if ($this->input->is_ajax_request()) {
			$dt['id_' . $item] = $this->input->post("id");
			$dt['id_pegawai'] = $this->input->post("id_pegawai");
			$dt['nip_pegawai'] = $this->input->post("nip_pegawai");
			$dt['status_verifikasi'] = "Proses";
			$dt['status_update'] = "DELETE";
			$dt['alasan'] = "Permintaan dari " . $this->session->userdata('full_name');

			$data['status'] = FALSE;

			if ($this->input->post("id") && $dt) {
				$query = $this->db_simpeg->insert("riwayat_" . $item, $dt);

				if ($this->db_simpeg->affected_rows() == 1) {
					$data['status'] = TRUE;
				}
			}

			echo json_encode($data);
		}
	}

	function verif_delete_riwayat($item)
	{
		if ($this->input->is_ajax_request()) {
			$dt['status_verifikasi'] = "Diterima";

			$data['status'] = FALSE;

			if ($this->input->post("id") && $dt) {
				$this->db_simpeg->where("id_update", $this->input->post("id"));
				$query = $this->db_simpeg->update("riwayat_" . $item, $dt);

				if ($this->db_simpeg->affected_rows() == 1) {
					$data['status'] = TRUE;
				}
			}

			echo json_encode($data);
		}
	}

	function cancel_riwayat($item)
	{
		if ($this->input->is_ajax_request()) {
			$dt = $this->db_simpeg->where("id_update", $this->input->post("id"))->get("riwayat_" . $item)->row();

			$data['status'] = FALSE;

			if ($this->input->post("id") && $dt) {
				$this->db_simpeg->delete("riwayat_" . $item, ['id_update' => $this->input->post("id")]);

				if ($this->db_simpeg->affected_rows() == 1) {
					$data['status'] = TRUE;
				}
			}

			echo json_encode($data);
		}
	}


	function get_riwayat_biodata($item, $id, $nip)
	{
		$this->simpeg_model->id = $data['id'] = $id;
		$this->simpeg_model->nip = $data['nip'] = $nip;

		$get_api = curlSimpeg('riwayat?item=' . $item . '&id=' . $id . '&nip=' . $nip);
		$get_api = json_decode($get_api);

		switch ($item) {
			case 'pangkat':
				$data['ref_golongan'] = $get_api->ref_golongan;

				$data['pangkat'] = $get_api->pangkat;
				$data['kredit'] = $get_api->kredit;
				break;

			case 'jabatan':
				$data['ref_skpd'] = $get_api->ref_skpd;
				$data['ref_unit_kerja'] = $get_api->ref_unit_kerja;
				$data['ref_jabatan'] = $get_api->ref_jabatan;
				$data['ref_kpkn'] = $get_api->ref_kpkn;
				$data['ref_eselon'] = $get_api->ref_eselon;

				$data['jabatan'] = $get_api->jabatan;
				$data['mutasi'] = $get_api->mutasi;
				$data['pwk'] = $get_api->pwk;
				break;

			case 'pendidikan':
				$data['ref_tingkatpendidikan'] = $get_api->ref_tingkatpendidikan;
				$data['ref_pendidikan'] = $get_api->ref_pendidikan;
				$data['ref_profesi'] = $get_api->ref_profesi;

				$data['pendidikan'] = $get_api->pendidikan;
				$data['profesi'] = $get_api->profesi;
				break;

			case 'latihan':
				$data['ref_latihan'] = $get_api->ref_latihan;
				$data['ref_kompetensi'] = $get_api->ref_kompetensi;
				$data['ref_jeniskursus'] = $get_api->ref_jeniskursus;
				$data['ref_instansi'] = $get_api->ref_instansi;

				$data['diklat'] = $get_api->diklat;
				$data['kursus'] = $get_api->kursus;
				break;

			case 'organisasi':
				$data['ref_kepanitiaan'] = $get_api->ref_kepanitiaan;
				$data['ref_penugasan'] = $get_api->ref_penugasan;

				$data['organisasi'] = $get_api->organisasi;
				$data['kepanitiaan'] = $get_api->kepanitiaan;
				$data['penugasan'] = $get_api->penugasan;
				break;

			case 'penghargaan':
				$data['ref_penghargaan'] = $get_api->ref_penghargaan;

				$data['penghargaan'] = $get_api->penghargaan;
				$data['prestasi'] = $get_api->prestasi;
				break;

			case 'absen':
				$data['ref_cuti'] = $get_api->ref_cuti;
				$data['ref_jenishukuman'] = $get_api->ref_jenishukuman;

				$data['cuti'] = $get_api->cuti;
				$data['hukuman'] = $get_api->hukuman;
				break;

			case 'bahasa':
				$data['bahasa'] = $get_api->bahasa;
				break;

			case 'keluarga':
				$data['master_orang'] = $this->simpeg_model->get_active();

				$data['ref_kelahiran'] = $get_api->ref_kelahiran;
				$data['ref_tingkatpendidikan'] = $get_api->ref_tingkatpendidikan;
				$data['master_pegawai'] = $this->simpeg_model->get_active_pegawai();

				$data['orangtua'] = $get_api->orangtua;
				$data['pernikahan'] = $get_api->pernikahan;
				$data['anak'] = $get_api->anak;
				break;

			case 'kedudukan':
				$data['ref_kedudukan'] = $get_api->ref_kedudukan;

				$data['kedudukan'] = $get_api->kedudukan;
				break;

			case 'indikator':
				$data['indikator'] = $get_api->indikator;
				break;

			default:
				# code...
				break;
		}

		return $data;
		// $this->load->view('admin/simpeg/riwayat/riwayat_'.$item, $data);
	}



}
?>