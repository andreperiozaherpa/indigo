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

class Renja_perencanaan extends CI_Controller
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
		$this->load->model('master_pegawai_model');

		$this->load->model('renja_perencanaan_model');
		$this->load->model('renja_rka_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('ref_visi_misi_model');


		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id > 2) redirect("admin");
	}
	public function index($jenis_skpd = '')
	{
		if ($this->user_id) {
			$data['title']		= "Renja SKPD ";
			$data['content']	= "renja/perencanaan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renja_perencanaan";

			$this->load->model('ref_skpd_model');


			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			if ($jenis_skpd !== '') {
				$total = count($this->ref_skpd_model->get_by_jenis($jenis_skpd));
			} else {
				$total = count($this->ref_skpd_model->get_all());
			}
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
			if ($jenis_skpd !== '') {
				$data['list'] = $this->ref_skpd_model->get_page($mulai, $hal, $filter, $jenis_skpd, true);
			} else {
				$data['list'] = $this->ref_skpd_model->get_page($mulai, $hal, $filter, $jenis_skpd);
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function rekap($jenis_skpd = '')
	{
		if ($this->user_id) {
			$data['title']		= "Renja SKPD ";
			$data['content']	= "renja/perencanaan/rekap";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renja_perencanaan";

			$this->load->model('ref_skpd_model');


			$hal = 6;
			$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			if ($jenis_skpd !== '') {
				$data['list'] = ($this->ref_skpd_model->get_by_jenis($jenis_skpd));
			} else {
				$data['list'] = ($this->ref_skpd_model->get_all());
			}

			$default_tahun = date('Y') - 1;
			$data['default_tahun'] = $default_tahun;
			
			$tahun = (empty($_GET['tahun'])) ? $default_tahun: $_GET['tahun'];

			foreach ($data['list'] as $k => $uk) {
				$jenis = array('ss', 'sp', 'sk');

				$data['rencana_kerja'][$tahun] = $this->renja_perencanaan_model->get_rencana_kerja_by_tahun($tahun, $uk->id_skpd);
				$total_capaian = 0;
				$count_total_capaian = 0;

				foreach ($jenis as $j) {
					$data['grafik_rencana_kerja_ss'][$tahun] = $this->renja_perencanaan_model->get_grafik_rencana_kerja_by_tahun($j, $tahun, $uk->id_skpd);
					$name = $this->renja_perencanaan_model->name($j);
					$taIkuRenja = $name['taIkuRenja'];
					$rIkuRenja = $name['rIkuRenja'];

					foreach ($data['grafik_rencana_kerja_ss'][$tahun] as $i) {
						$target = $i->$taIkuRenja;
						$realisasi = $i->$rIkuRenja;
						$pola = $i->polorarisasi;
						$s_capaian = 'capaian_' . $tahun;
						$capaian = $i->capaian;
						$total_capaian += $capaian;
						$count_total_capaian++;
					}
				}

				$data['grafik_capaian'][$uk->id_skpd] = ($count_total_capaian > 0) ? $total_capaian / $count_total_capaian : 0;
				$data['list'][$k]->grafik_capaian = ($count_total_capaian > 0) ? $total_capaian / $count_total_capaian : 0;
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function view($id_skpd)
	{
		if ($this->user_id) {
			$data['title']		= "Detail Rencana Kerja SKPD";
			$data['content']	= "renja/perencanaan/view";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$this->load->model('ref_skpd_model');
			$this->load->model('renja_perencanaan_model');

			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);

			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['perencanaan'] = $this->renja_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);
			$data['sasaran_strategis'] = $this->renja_perencanaan_model->get_sasaran_strategis_by_id_skpd($id_skpd);
			$data['iku_sasaran_strategis'] = array();
			foreach ($data['sasaran_strategis'] as $key => $value) {
				$data['iku_sasaran_strategis'][$key] = $this->renja_perencanaan_model->get_iku_sasaran_strategis_by_id_ss($value['id_sasaran_strategis_renstra']);
			}

			$jenis = array('ss', 'sp', 'sk');

			for ($tahun = 2019; $tahun <= 2023; $tahun++) {
				$data['rencana_kerja'][$tahun] = $this->renja_perencanaan_model->get_rencana_kerja_by_tahun($tahun, $id_skpd);
				$total_capaian = 0;
				$count_total_capaian = 0;

				foreach ($jenis as $j) {
					$data['grafik_rencana_kerja_ss'][$tahun] = $this->renja_perencanaan_model->get_grafik_rencana_kerja_by_tahun($j, $tahun, $id_skpd);
					$name = $this->renja_perencanaan_model->name($j);
					$taIkuRenja = $name['taIkuRenja'];
					$rIkuRenja = $name['rIkuRenja'];

					foreach ($data['grafik_rencana_kerja_ss'][$tahun] as $i) {
						$target = $i->$taIkuRenja;
						$realisasi = $i->$rIkuRenja;
						$pola = $i->polorarisasi;
						// $capaian = get_capaian($target, $realisasi, $pola);
						$capaian = $i->capaian;
						$total_capaian += $capaian;
						$count_total_capaian++;
					}
				}


				$data['grafik_capaian'][$tahun] = ($count_total_capaian > 0) ? $total_capaian / $count_total_capaian : 0;
			}

			$data['misi'] = $this->ref_visi_misi_model->get_all_m();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function detail($id_skpd, $tahun)
	{
		if ($this->user_id) {
			$data['title']		= "Detail Renja Unit Kerja - Admin ";
			$data['content']	= "renja/perencanaan/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$jenis = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			if (!empty($_POST)) {
				$up = false;
				$del = false;
				$insert_kinerja = false;
				if (isset($_POST['update_realisasi'])) {
					$id_iku_renja = $_POST['id_iku'];
					$jj = $_POST['jenis'];
					$name = $this->renja_perencanaan_model->name($jj);

					$iku = $this->renja_perencanaan_model->get_iku_renja_by_id($jj, $id_iku_renja);
					if (isset($_POST['perhitungan_capaian_renja'])) {
						$_POST['perhitungan_capaian_renja'] = 'manual';
					} else {
						$target = $name['taIkuRenja'];
						$target = $iku->$target;
						$realisasi = $_POST['realisasi'];
						$pola = $iku->polorarisasi;
						$capaian = get_capaian($target, $realisasi, $pola);
						$_POST['capaian'] = $capaian;
						$_POST['perhitungan_capaian_renja'] = 'otomatis';
					}

					// print_r($_POST);die;


					$update = array($name['rIkuRenja'] => $_POST['realisasi'], 'capaian' => $_POST['capaian'], 'perhitungan_capaian_renja' => $_POST['perhitungan_capaian_renja']);
					// print_r($update);die;
					$realisasi = $name['rIkuRenja'];
					$realisasi_before_update = $iku->$realisasi;
					$up = $this->renja_perencanaan_model->update_iku_renja($jj, $update, $id_iku_renja);

					//INSERT KINERJA PEGAWAI
					$id_pegawai = $_POST['id_pegawai'];
					$this->load->model('master_pegawai_model');
					$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
					if ($pegawai) {
						$iku = $this->renja_perencanaan_model->get_iku_renja_by_id($jj, $id_iku_renja);
						$target = $name['taIkuRenja'];
						$target = $iku->$target;
						$realisasi_pegawai = $_POST['realisasi'] - $realisasi_before_update;
						$kinerja_pegawai = array(
							'id_pegawai' => $id_pegawai,
							'nip' => $pegawai->nip,
							'id_skpd' => $pegawai->id_skpd,
							'id_unit_kerja' => $pegawai->id_unit_kerja,
							'jenis_sasaran' => $jj,
							'id_iku' => $id_iku_renja,
							'realisasi' => $realisasi_pegawai,
							'target' => $target
						);

						$this->load->model('kinerja_pegawai_model');
						$insert_kinerja = $this->kinerja_pegawai_model->insert($kinerja_pegawai);
					}
					// print_r($kinerja_pegawai);
					// die;
					if (isset($iku->id_unit_kerja)) {
						redirect('renja_perencanaan/detail/' . $id_skpd . '/' . $tahun . '#unit_kerja_' . $iku->id_unit_kerja);
					}
				} else {
					foreach ($jenis as $j => $v) {
						$name = $this->renja_perencanaan_model->name($j);
						if (!empty($_POST[$name['cIku']])) {
							$id = $_POST[$name['cIku']];
						} else {
							$id = array();
						}
						$id_iku_from_post = array();
						$id_iku_from_database = array();
						if (isset($_POST['id_unit_kerja'])) {
							$renja = $this->renja_perencanaan_model->get_renja_unit_kerja($j, $_POST['id_unit_kerja'], $tahun);
							$cIkuRenja = $name['cIkuRenja'];
							foreach ($renja as $r) {
								$id_iku_from_database[] = $r->$cIkuRenja;
							}
							foreach ($id as $i) {
								$cek_iku = $this->renja_perencanaan_model->cek_iku_renja($j, $i, $_POST['id_unit_kerja'], $tahun);
								if (!$cek_iku) {
									$insert = array(
										$name['cIku']  => $i,
										$name['taIkuRenja'] => $_POST[$name['taIkuRenja'] . $i],
										$name['aIkuRenja'] => $_POST[$name['aIkuRenja'] . $i],
										'id_skpd' => $id_skpd,
										'id_unit_kerja' => $_POST['id_unit_kerja'],
										'tahun_renja' => $_POST['tahun_renja'],
										'id_pegawai_input' => $this->session->userdata('id_pegawai')
									);
									$in = $this->renja_perencanaan_model->insert_iku_renja($j, $insert);
								} else {
									$id_iku_renja = $_POST[$name['cIkuRenja'] . $i];
									$update = array(
										$name['taIkuRenja'] => $_POST[$name['taIkuRenja'] . $i],
										$name['aIkuRenja'] => $_POST[$name['aIkuRenja'] . $i]
									);
									$up = $this->renja_perencanaan_model->update_iku_renja($j, $update, $id_iku_renja);
									foreach ($renja as $r) {
										if ($r->$cIkuRenja == $id_iku_renja) {
											$id_iku_from_post[] = $id_iku_renja;
										}
									}
								}
							}
						} elseif (isset($_POST['id_skpd'])) {
							$renja = $this->renja_perencanaan_model->get_renja_skpd($j, $_POST['id_skpd'], $tahun);
							$cIkuRenja = $name['cIkuRenja'];
							foreach ($renja as $r) {
								$id_iku_from_database[] = $r->$cIkuRenja;
							}
							foreach ($id as $i) {
								$cek_iku = $this->renja_perencanaan_model->cek_iku_renja_skpd($j, $i, $_POST['id_skpd'], $tahun);
								if (!$cek_iku) {
									$insert = array(
										$name['cIku']  => $i,
										$name['taIkuRenja'] => $_POST[$name['taIkuRenja'] . $i],
										$name['aIkuRenja'] => $_POST[$name['aIkuRenja'] . $i],
										'id_skpd' => $_POST['id_skpd'],
										'jenis_renja' => 'skpd',
										'tahun_renja' => $_POST['tahun_renja'],
										'id_pegawai_input' => $this->session->userdata('id_pegawai')
									);
									$in = $this->renja_perencanaan_model->insert_iku_renja($j, $insert);
								} else {
									$id_iku_renja = $_POST[$name['cIkuRenja'] . $i];
									$update = array(
										$name['taIkuRenja'] => $_POST[$name['taIkuRenja'] . $i],
										$name['aIkuRenja'] => $_POST[$name['aIkuRenja'] . $i]
									);
									$up = $this->renja_perencanaan_model->update_iku_renja($j, $update, $id_iku_renja);
									foreach ($renja as $r) {
										if ($r->$cIkuRenja == $id_iku_renja) {
											$id_iku_from_post[] = $id_iku_renja;
										}
									}
								}
							}
						}
						// if(count($id_iku_from_database)>count($id_iku_from_post)){
						$array_hapus = (array_diff($id_iku_from_database, $id_iku_from_post));
						// }else{
						// $array_hapus = (array_diff($id_iku_from_post, $id_iku_from_database));
						// }
						foreach ($array_hapus as $id_iku_renja) {
							$del = $this->renja_perencanaan_model->hapus_iku_renja($j, $id_iku_renja);
						}
					}
				}
				if (isset($_POST['id_unit_kerja'])) {
					redirect('renja_perencanaan/detail/' . $id_skpd . '/' . $tahun . '#unit_kerja_' . $_POST['id_unit_kerja']);
				}

				// if (isset($_POST['id_unit_kerja'])) {
				// 	if ($up || $del || $insert_kinerja) {
				// 		redirect('renja_perencanaan/detail/' . $id_skpd . '/' . $tahun . '?jumpto=' . $_POST['id_unit_kerja']);
				// 	}
				// }
			}

			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;
			$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
			$data['jumlah_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);

			$is_renja_exist = false;
			foreach ($jenis as $key => $value) {
				$renja = $this->renja_perencanaan_model->get_renja_skpd($key, $id_skpd, $tahun);
				if (!empty($renja)) {
					$is_renja_exist = true;
					break;
				}
			}

			$data['is_renja_skpd_exist'] = $is_renja_exist;

			$data['jenis'] = $jenis;
			$data['unit_kerja'] = $this->ref_skpd_model->get_all_unit_kerja_by_id_skpd($id_skpd);

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function sasaran_inisiatif($id_skpd, $tahun)
	{
		if ($this->user_id) {

			$this->load->model('renstra_perencanaan_model');
			$this->load->model('ref_satuan_model');

			$data['title']		= "Tambah Sasaran Inisiatif - Admin ";
			$data['content']	= "renja/perencanaan/inisiatif";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$data['unit_kerja'] = $this->ref_skpd_model->get_all_unit_kerja_by_id_skpd($id_skpd);
			$data['ref_satuan'] = $this->ref_satuan_model->get_all();
			$data['tahun'] = $tahun;
			$data['id_skpd'] = $id_skpd;


			$data['visi'] = $this->ref_visi_misi_model->get_visi();
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();
			$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($data['misi'][0]->id_misi);

			$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);

			$data['jenis_sasaran'] = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			if (!empty($_POST)) {
				if (cekForm($_POST)) {
					$data['message'] = 'Oops.. masih ada data yang kosong';
					$data['message_type'] = 'warning';
				} else {
					$jenis = $_POST['jenis_sasaran'];
					if ($jenis == 'ss') {
						$d_in = array('id_tujuan' => $_POST['id_tujuan']);
					} elseif ($jenis == 'sp') {
						$d_in = array('id_unit_kerja' => $_POST['id_unit_kerja'], 'id_iku_ss_renstra' => $_POST['id_iku_ss_renstra']);
					} elseif ($jenis == 'sk') {
						$d_in = array('id_unit_kerja' => $_POST['id_unit_kerja'], 'id_iku_sp_renstra' => $_POST['id_iku_sp_renstra']);
					}
					$d_in['nama_sasaran'] = $_POST['nama_sasaran'];
					$d_in['id_skpd'] = $id_skpd;
					$d_in['tahun'] = $tahun;
					$in = $this->renja_perencanaan_model->insert_sasaran_inisiatif($jenis, $d_in);
					$name = $this->renja_perencanaan_model->name($jenis);
					if ($in) {
						$data['message'] = 'Sasaran Inisiatif berhasil ditambahkan';
						$data['message_type'] = 'success';
						foreach ($_POST['nama_indikator'] as $k => $v) {
							$id_satuan = $_POST['id_satuan'][$k];
							$target = $_POST['target'][$k];
							$nama_indikator = $_POST['nama_indikator'][$k];
							$cascading = $_POST['id_unit_kerja_casecading_' . $k];
							$cascading = implode(",", $cascading);
							$polorarisasi = $_POST['polorarisasi_' . $k];

							$code_name = $name['name'];
							$field_iku_renstra = $name['cIku'];
							$field_target_renja = $name['taIkuRenja'];
							$field_anggaran_renja = $name['aIkuRenja'];
							$data_indikator = array(
								'inisiatif' => 1,
								'nama_indikator_inisiatif' => $nama_indikator,
								'id_' . $code_name . '_inisiatif' => $in,
								'id_satuan_inisiatif' => $id_satuan,
								'polorarisasi_inisiatif' => $polorarisasi,
								'unit_kerja_casecade_inisiatif' => $cascading,
								$field_iku_renstra => 0,
								$field_target_renja => $target,
								$field_anggaran_renja => 0,
								'tahun_renja' => $tahun,
								'id_skpd' => $id_skpd,
								'id_pegawai_input' => $this->session->userdata('id_pegawai')
							);
							if ($jenis !== 'ss') {
								$data_indikator['id_unit_kerja'] = $_POST['id_unit_kerja'];
								$data['jenis_renja'] = 'unit_kerja';
							} else {
								$data['jenis_renja'] = 'skpd';
							}
							$this->renja_perencanaan_model->insert_iku_renja($jenis, $data_indikator);
						}
					} else {
						$data['message'] = 'Terjadi kesalahan';
						$data['message_type'] = 'danger';
					}
				}
			}

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function getIkuUnitKerja($jenis = '', $id_unit_kerja = '', $tahun = '')
	{
		if ($jenis !== '' && $id_unit_kerja !== '' && $tahun !== '') {
			$this->load->model('renstra_perencanaan_model');
			$res = $this->renstra_perencanaan_model->get_iku_ss_by_unit_kerja($id_unit_kerja);
			if ($jenis == 'ss') {
				$name = "Sasaran Strategis";
				$res = $this->renstra_perencanaan_model->get_iku_ss_by_unit_kerja($id_unit_kerja);
			} elseif ($jenis == 'sp') {
				$name = "Sasaran Program";
				$res = $this->renstra_perencanaan_model->get_iku_sp_by_unit_kerja($id_unit_kerja);
			} elseif ($jenis == 'sk') {
				$name = "Sasaran Kegiatan";
				$res = $this->renstra_perencanaan_model->get_iku_sk_by_unit_kerja($id_unit_kerja);
			}
			echo json_encode(array('jenis' => $name, 'detail' => $res));
		} else {
			show_404();
		}
	}

	public function download_pk_renja($jenis, $id_skpd, $tahun, $id_unit_kerja = '')
	{

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$phpWord->getCompatibility()->setOoxmlVersion(14);
		$phpWord->getCompatibility()->setOoxmlVersion(15);

		$kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
		if ($jenis == 'skpd') {
			$template = 'PK_Kepala';
			$detail = $this->ref_skpd_model->get_by_id($id_skpd);
			$namafile = "Perjanjian Kinerja SKPD " . $detail->nama_skpd . " Tahun " . $tahun;
		} elseif ($jenis == 'unit_kerja') {
			$template = 'PK_pegawai';
			$detail = $this->ref_skpd_model->get_unit_kerja_by_id($id_unit_kerja);
			$namafile = "Perjanjian Kinerja Unit Kerja " . $detail->nama_unit_kerja . " Tahun " . $tahun;
			$kepala_unit_kerja = $this->ref_skpd_model->get_kepala_unit_kerja($id_unit_kerja);
		} else {
			show_404();
		}
		$jenis_sasaran = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
		$filename = $namafile . ".docx";

		$template_path = './template/' . $template . '.docx';
		$template = $phpWord->loadTemplate($template_path);


		$template->setValue('tahun', $tahun);
		$template->setValue('tanggal_unduh', tanggal(date('Y-m-d')));
		$template->setValue('nama_skpd', $detail->nama_skpd);
		$template->setValue('nama_pegawai', $kepala->nama_lengkap);
		$template->setValue('nama_jabatan', "Kepala SKPD " . $detail->nama_skpd);
		if ($jenis == 'unit_kerja') {
			$template->setValue('nama_pegawai_a', $kepala_unit_kerja->nama_lengkap);
			$template->setValue('nama_jabatan_a', $kepala_unit_kerja->nama_jabatan);
		}

		$total_iku = 0;
		$array_iku = array();
		foreach ($jenis_sasaran as $j => $v) {
			$name = $this->renja_perencanaan_model->name($j);
			if ($jenis == 'skpd') {
				$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
			} else {
				$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
			}
			$jumlah_iku = 0;
			foreach ($sasaran as $s) {
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				if ($jenis == 'skpd') {
					$iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
				} else {
					$iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $id_unit_kerja);
					foreach ($iku as $k => $v) {
						$iku[$k]->$tSasaran = $s->$tSasaran;
					}
				}

				foreach ($iku as $i) {
					$jumlah_iku++;
				}


				if ($jumlah_iku != 0) {
					foreach ($iku as $i) {
						$i->j = $j;
						$array_iku[] = $i;
					}
				}
			}

			$total_iku += $jumlah_iku;
		}
		$template->cloneRow('nama_sasaran', $total_iku);
		foreach ($array_iku as $k => $i) {
			$no = $k + 1;
			$j = $i->j;
			// echo $no.' '.$j.'<br>';
			$name = $this->renja_perencanaan_model->name($j);
			$tSasaran = $name['tSasaran'];
			$cSasaran = $name['cSasaran'];
			$tIku = $name['tIku'];
			$cIku = $name['cIku'];
			$cIkuRenja = $name['cIkuRenja'];
			$taIkuRenja = $name['taIkuRenja'];
			$aIkuRenja = $name['aIkuRenja'];
			$rIkuRenja = $name['rIkuRenja'];

			$rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd);
			$total_rka[$i->$cIkuRenja] = 0;
			foreach ($rka as $r) {
				$total_rka[$i->$cIkuRenja] += $r->anggaran;
			}
			if ($j == 'ss') {
				$program = $this->renja_perencanaan_model->get_program_by_iku_ss($i->$cIku);
				$list_program = "";
				foreach ($program as $p) {
					$list_program .= "- " . $p->sasaran_program_renstra . "</w:t><w:br/><w:t>";
				}
				if (empty($list_program)) {
					$list_program = "-";
				}
				$template->setValue('list_program#' . $no, $list_program, 1, true);
				// $template->setValue('anggaran_indikator#'.$no,rupiah($i->anggaran_kegiatan));
			} elseif ($j == 'sp') {
				$kegiatan = $this->renja_perencanaan_model->get_kegiatan_by_iku_sp($i->$cIku);
				$list_kegiatan = "";
				$anggaran_program = "";
				foreach ($kegiatan as $p) {
					$list_kegiatan .= "- " . $p->sasaran_kegiatan_renstra . "</w:t><w:br/><w:t>";
				}

				if (empty($list_kegiatan)) {
					$list_kegiatan = "-";
				}
				$template->setValue('list_kegiatan#' . $no, $list_kegiatan, 1, true);
				// $template->setValue('anggaran_indikator#'.$no,rupiah($i->anggaran_kegiatan));
			} else {
				$template->setValue('list_kegiatan#' . $no, "-", 1, true);
				// $template->setValue('anggaran_indikator#'.$no,rupiah($i->$aIkuRenja));
			}

			$template->setValue('anggaran_indikator#' . $no, rupiah(round($total_rka[$i->$cIkuRenja])));
			$template->setValue('no_rkt#' . $no, $no);
			$template->setValue('nama_sasaran#' . $no, $i->$tSasaran);
			$template->setValue('nama_indikator#' . $no, $i->$tIku);
			$template->setValue('target_indikator#' . $no, $i->$taIkuRenja);
		}
		// die; 
		ob_clean();
		$template->saveAs("./data/perjanjian_kinerja/" . $filename);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize("./data/perjanjian_kinerja/" . $filename));
		flush();
		readfile("./data/perjanjian_kinerja/" . $filename);
	}

	public function edit()
	{
		if ($this->user_id) {
			$data['title']		= "edit renja - Admin ";
			$data['content']	= "renja/perencanaan/edit";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


	public function detail_iku($id_skpd, $jenis, $id_iku)
	{
		if ($this->user_id) {
			$data['title']		= "Detail IKU Renja - Admin ";
			$data['content']	= "renja/perencanaan/detail_iku";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$name = $this->renja_perencanaan_model->name($jenis);

			$data['name'] = $name;

			foreach ($data['name'] as $k => $v) {
				$data[$k] = $v;
				$$k = $v;
			}

			$iku = $this->db->get_where($data['tIkuRenja'], array($data['cIkuRenja'] => $id_iku))->row();
			$is_inisiatif = $iku->inisiatif;
			$data['is_inisiatif'] = $is_inisiatif;

			if (!empty($_POST)) {
				if (isset($_POST['tambah_renaksi'])) {
					$insert_renaksi = array($tRenaksi => $_POST['renaksi'], $cIkuRenja => $id_iku, 'perhitungan_atasan' => $_POST['perhitungan_atasan']);
					$insert_renaksi = $this->renja_perencanaan_model->insert_renaksi($jenis, $insert_renaksi);
					for ($i = 1; $i <= 12; $i++) {
						if (!isset($_POST['status_jadwal_' . $i])) {
							$_POST['status_jadwal_' . $i] = 'tidak_dijadwalkan';
						}
						if (!isset($_POST['target_' . $i])) {
							$_POST['target_' . $i] = 0;
						}
						$insert_target_renaksi = array('bulan' => $i, $cRenaksi => $insert_renaksi, 'status_jadwal' => $_POST['status_jadwal_' . $i], 'target' => $_POST['target_' . $i]);
						$insert_target_renaksi = $this->renja_perencanaan_model->insert_target_renaksi($jenis, $insert_target_renaksi);
					}
				} elseif (isset($_POST['ubah_renaksi'])) {
					$id_renaksi = $_POST['id_renaksi'];
					$update_renaksi = array($tRenaksi => $_POST['renaksi']);
					$update_renaksi = $this->renja_perencanaan_model->update_renaksi($jenis, $update_renaksi, $id_renaksi);
					for ($i = 1; $i <= 12; $i++) {
						if (!isset($_POST['status_jadwal_' . $i])) {
							$_POST['status_jadwal_' . $i] = 'tidak_dijadwalkan';
						}
						if (!isset($_POST['target_' . $i])) {
							$_POST['target_' . $i] = 0;
						}
						$update_target_tenaksi = array('status_jadwal' => $_POST['status_jadwal_' . $i], 'target' => $_POST['target_' . $i]);
						$update_target_tenaksi = $this->renja_perencanaan_model->update_target_renaksi($jenis, $update_target_tenaksi, $id_renaksi, $i);
					}
				} elseif (isset($_POST['update_target_renaksi'])) {
					$name = $this->renja_perencanaan_model->name($jenis);
					$id_target_renaksi = $_POST['id_target_renaksi'];

					$target = $this->renja_perencanaan_model->get_target_renaksi_by_id($jenis, $id_target_renaksi, $is_inisiatif);

					if (isset($_POST['perhitungan_capaian_renaksi'])) {
						$_POST['perhitungan_capaian_renaksi'] = 'manual';
					} else {
						$t = $target->target;
						$realisasi = $_POST['realisasi_target'];
						$pola = $target->polorarisasi;
						$capaian = get_capaian($t, $realisasi, $pola);
						$_POST['capaian'] = $capaian;
						$_POST['perhitungan_capaian_renaksi'] = 'otomatis';
					}

					$id_renaksi = $name['cRenaksi'];
					$id_renaksi = $target->$id_renaksi;

					$realisasi_before_update = $target->realisasi;
					$realisasi_after_update = $_POST['realisasi_target'];
					$hasil_realisasi = $realisasi_after_update - $realisasi_before_update;


					$update = array('realisasi' => $_POST['realisasi_target'], 'link_dokumen_pendukung' => $_POST['link_dokumen_pendukung'], 'capaian' => $_POST['capaian'], 'perhitungan_capaian_renaksi' => $_POST['perhitungan_capaian_renaksi']);
					if ($_FILES['dokumen_pendukung']['tmp_name'] != '') {
						$config['upload_path']          = './data/dokumen_renaksi/';
						$config['allowed_types']        = 'docx|doc|xls|xlsx|pdf|jpg|jpeg|png|gif|rar|zip|ppt|pptx';
						$config['overwrite'] = false;
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('dokumen_pendukung')) {
							$data['message_type'] = "danger";
							$data['message'] 	= $this->upload->display_errors();
							print_r($data['message']);
							die;
						} else {
							$update['dokumen_pendukung'] = $this->upload->data('file_name');
						}
					}
					$update_target_tenaksi = $this->renja_perencanaan_model->update_target_renaksi_by_id($jenis, $update, $id_target_renaksi);



					$name = $this->renja_perencanaan_model->name($jenis);

					$detail_iku = $this->renja_perencanaan_model->get_iku_renja_by_id($jenis, $id_iku, $is_inisiatif);
					//INSERT KINERJA PEGAWAI
					if ($jenis == "ss") {
						$data_kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
					} else {
						$data_kepala = $this->ref_skpd_model->get_kepala_unit_kerja($detail_iku->id_unit_kerja);
					}
					if (isset($data_kepala->id_pegawai)) {
						$id_pegawai = $data_kepala->id_pegawai;
						$this->load->model('master_pegawai_model');
						$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
						$iku = $this->renja_perencanaan_model->get_iku_renja_by_id($jenis, $id_iku, $is_inisiatif);
						$target = $name['taIkuRenja'];
						$target = $iku->$target;
						$realisasi = $name['rIkuRenja'];
						$realisasi = $iku->$realisasi;
						$total_realisasi = $realisasi + $hasil_realisasi;

						$renaksi = $this->renja_perencanaan_model->get_renaksi_by_id($jenis, $id_renaksi);
						if (empty($renaksi->perhitungan_atasan)) {
							//
						} else {
							$update_iku = array($name['rIkuRenja'] => $total_realisasi);
							$update_iku = $this->renja_perencanaan_model->update_iku_renja($jenis, $update_iku, $id_iku);

							$kinerja_pegawai = array(
								'id_pegawai' => $id_pegawai,
								'nip' => $pegawai->nip,
								'id_skpd' => $pegawai->id_skpd,
								'id_unit_kerja' => $pegawai->id_unit_kerja,
								'jenis_sasaran' => $jenis,
								'id_iku' => $id_iku,
								'realisasi' => $hasil_realisasi,
								'target' => $target
							);

							$this->load->model('kinerja_pegawai_model');
							$insert_kinerja = $this->kinerja_pegawai_model->insert($kinerja_pegawai);
						}
					}
				} elseif (isset($_POST['hapus_renaksi'])) {
					$delete = $this->renja_perencanaan_model->hapus_renaksi($jenis, $_POST['id_renaksi']);
				}
			}


			$data['id_skpd'] = $id_skpd;
			$data['detail'] = $this->renja_perencanaan_model->get_iku_renja_by_id($jenis, $id_iku, $is_inisiatif);
			if ($data['detail']->jenis_renja == 'skpd') {
				$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
				$data['kepala'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
				$data['staff'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
				$data['detail']->nama_unit_kerja = $data['skpd']->nama_skpd;
			} else {
				$data['kepala'] = $this->ref_skpd_model->get_kepala_unit_kerja($data['detail']->id_unit_kerja);
				$data['staff'] = count($this->ref_skpd_model->get_staff_unit_kerja($data['detail']->id_unit_kerja));
			}
			$data['renaksi'] = $this->renja_perencanaan_model->get_renaksi($jenis, $id_iku);
			$jj = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
			foreach ($jj as $n => $j) {
				if ($n == $jenis) {
					$data['nama_jenis'] = $j;
					$data['jenis'] = $n;
				}
			}

			if (isset($data['kepala']->id_pegawai)) {
				$data['id_kepala'] = $data['kepala']->id_pegawai;
			} else {
				$data['id_kepala'] = 0;
			}


			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function get_iku_renja($jenis, $id_iku)
	{
		$get = $this->renja_perencanaan_model->get_iku_renja_by_id($jenis, $id_iku);
		$name = $this->renja_perencanaan_model->name($jenis);
		$realisasi_renja = $name['rIkuRenja'];
		$get->realisasi = $get->$realisasi_renja;
		echo json_encode($get);
	}

	public function get_renaksi($jenis, $id_renaksi)
	{
		$q = $this->renja_perencanaan_model->get_renaksi_by_id($jenis, $id_renaksi);
		$target = $this->renja_perencanaan_model->get_target_renaksi_by_renaksi($jenis, $id_renaksi);
		$name = $this->renja_perencanaan_model->name($jenis);
		$tRenaksi = $name['tRenaksi'];
		$cRenaksi = $name['cRenaksi'];
		foreach ($target as $t) {
			$bulan = $t->bulan;
			$sStatusJadwal = 'status_jadwal_' . $bulan;
			$sTarget = 'target_' . $bulan;
			$q->renaksi = $q->$tRenaksi;
			$q->id_renaksi = $q->$cRenaksi;
			$q->$sStatusJadwal = $t->status_jadwal;
			$q->$sTarget = $t->target;
		}
		echo json_encode($q);
	}

	public function get_target_renaksi($jenis, $id_target_renaksi, $is_inisiatif = 0)
	{
		$target = $this->renja_perencanaan_model->get_target_renaksi_by_id($jenis, $id_target_renaksi, $is_inisiatif);
		echo json_encode($target);
	}

	public function get_iku_sasaran_by_unit_kerja($id_unit_kerja, $tahun, $testing = "")
	{
		$jenis = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
		foreach ($jenis as $key => $value) {
			$name = $this->renja_perencanaan_model->name($key);
			// $iku = $this->renja_perencanaan_model->get_casecade_sasaran_by_unit_kerja($key,$id_unit_kerja);
			// if($testing==1){
			$iku = $this->renja_perencanaan_model->get_iku_by_penanggungjawab($key, $id_unit_kerja);
			// }else{

			// 	$iku = $this->renja_perencanaan_model->get_casecade_sasaran_by_unit_kerja($key,$id_unit_kerja);
			// }
			if (!empty($iku)) {
				$renja = $this->renja_perencanaan_model->get_renja_unit_kerja($key, $id_unit_kerja, $tahun);
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				$id_iku = $name['cIku'];
				echo '
				<input type="hidden" name="id_unit_kerja" value="' . $id_unit_kerja . '">
				<input type="hidden" name="tahun_renja" value="' . $tahun . '">
				<span style="font-weight:500;">
				<i style="font-size:15px;color:#fff;background-color:#6003c8;padding:5px;border-radius:50%" class="ti-target"></i> <span style="border-bottom:solid 2px #6003c8;padding-bottom:3px;">
				' . ($value) . '</span></span><br>';
				echo '<table style="margin-top:15px;margin-bottom:30px" class="table color-table muted-table table-bordered text-center" >
				<thead>
				<tr>
				<th>
				<div class="checkbox checkbox-primary text-center">
				<input id="checkbox1" type="checkbox" class="checkall" checked onclick="checkAll()">
				<label for="checkbox1"></label>
				</div>
				</th>
				<th class="text-center">Indikator</th>
				<th class="text-center">Target</th>
				<th class="text-center">Satuan</th>
				<th class="text-center">Anggaran</th>
				</tr>
				</thead>
				<tbody id="tablePKPerubahan">';
				if (empty($renja)) {
					$no = 1;
					$group = array();
					foreach ($iku as $element) {
						$group[$element->$cSasaran][] = $element;
					}


					foreach ($group as $id_sasaran => $iku) {
						$detail_sasaran = $this->renja_perencanaan_model->get_detail_sasaran($key, $id_sasaran);
						$label_apbd = ($detail_sasaran->apbd) ? '<span class="badge badge-purple pull-right">RENSTRA:'.$detail_sasaran->apbd.'</span>' : '' ;
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">' . $value . '</span> ' . $detail_sasaran->$tSasaran . $label_apbd.'</td>
						</tr>';
						foreach ($iku as $i) {
							$iku = $name['tIku'];
							$id_iku = $name['cIku'];
							$taIkuRenja = $name['taIkuRenja'];
							$vTarget = 'target_' . $tahun;
							$vAnggaran = 'anggaran_' . $tahun;
							$id = "'$key$no'";
							echo '<tr>
							<td>
							<div class="checkbox checkbox-primary">
							<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" checked class="child">
							<label for="checkbox2"></label>
							</div>
							</td>
							<td style="vertical-align:middle">' . $i->$iku . '</td>
							<td>
							<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vTarget . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
							</td>
							<td style="vertical-align:middle">' . $i->satuan . '</td>
							<td>
							<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vAnggaran . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
							</td>
							</tr>';
							$no++;
						}
					}
				} else {

					$no = 1;

					$group = array();

					foreach ($renja as $element) {
						$element->jenis = 'renja';
						$group[$element->$cSasaran][] = $element;
					}
					foreach ($iku as $element) {
						foreach ($renja as $r) {
							if ($element->$id_iku == $r->$id_iku) {
								continue (2);
							}
						}
						$element->jenis = 'iku';
						$group[$element->$cSasaran][] = $element;
					}

					foreach ($group as $id_sasaran => $iku) {
						$detail_sasaran = $this->renja_perencanaan_model->get_detail_sasaran($key, $id_sasaran);
						$label_apbd = ($detail_sasaran->apbd) ? '<span class="badge badge-purple pull-right">RENSTRA:'.$detail_sasaran->apbd.'</span>' : '' ;
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">' . $value . '</span> ' . $detail_sasaran->$tSasaran . $apbd. '</td>
						</tr>';
						foreach ($iku as $i) {
							if ($i->jenis == 'renja') {
								$tIku = $name['tIku'];
								$cIkuRenja = $name['cIkuRenja'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$aIkuRenja = $name['aIkuRenja'];
								$vTarget = 'target_' . $tahun;
								$vAnggaran = 'anggaran_' . $tahun;
								$id = "'$key$no'";
								echo '
								<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input type="hidden" value="' . $i->$cIkuRenja . '" name="' . $cIkuRenja . $i->$id_iku . '">
								<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" checked class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">' . $i->$tIku . '</td>
								<td>
								<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$taIkuRenja . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">' . $i->satuan . '</td>
								<td>
								<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$aIkuRenja . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							} elseif ($i->jenis == 'iku') {

								$tIku = $name['tIku'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$vTarget = 'target_' . $tahun;
								$vAnggaran = 'anggaran_' . $tahun;
								$id = "'$key$no'";
								echo '<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">' . $i->$tIku . '</td>
								<td>
								<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vTarget . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">' . $i->satuan . '</td>
								<td>
								<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vAnggaran . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}
							$no++;
						}
					}
				}
				echo '
				</tbody>
				</table>';
			}
		}
	}



	function get_tujuan_by_misi($id_misi = null)
	{
		if ($id_misi == null) {
			$id_misi = $this->input->get('id_misi');
		}
		$this->load->model('ref_visi_misi_model');
		$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($id_misi);
		echo '<option value="">Pilih Tujuan</option>';
		foreach ($data['tujuan'] as $key) {
			echo "<option value='{$key->id_tujuan}'>{$key->tujuan}</option>";
		}
	}

	public function get_iku_sasaran_by_skpd($id_skpd, $tahun)
	{
		$jenis = array('ss' => 'Sasaran Strategis');
		foreach ($jenis as $key => $value) {
			$name = $this->renja_perencanaan_model->name($key);
			$iku = $this->renja_perencanaan_model->get_casecade_sasaran_by_skpd($key, $id_skpd);
			if (!empty($iku)) {
				$renja = $this->renja_perencanaan_model->get_renja_skpd($key, $id_skpd, $tahun);
				// print_r($renja);die;
				$tSasaran = $name['tSasaran'];
				$cSasaran = $name['cSasaran'];
				$id_iku = $name['cIku'];
				echo '
				<input type="hidden" name="id_skpd" value="' . $id_skpd . '">
				<input type="hidden" name="tahun_renja" value="' . $tahun . '">
				<span style="font-weight:500;">
				<i style="font-size:15px;color:#fff;background-color:#6003c8;padding:5px;border-radius:50%" class="ti-target"></i> <span style="border-bottom:solid 2px #6003c8;padding-bottom:3px;">
				' . ($value) . '</span></span><br>';
				echo '<table style="margin-top:15px;margin-bottom:30px" class="table color-table muted-table table-bordered text-center" >
				<thead>
				<tr>
				<th>
				<div class="checkbox checkbox-primary text-center">
				<input id="checkbox1" type="checkbox" class="checkall" checked onclick="checkAll()">
				<label for="checkbox1"></label>
				</div>
				</th>
				<th class="text-center">Indikator</th>
				<th class="text-center">Target</th>
				<th class="text-center">Satuan</th>
				<th class="text-center">Anggaran</th>
				</tr>
				</thead>
				<tbody id="tablePKPerubahan">';
				if (empty($renja)) {
					$no = 1;
					$group = array();
					foreach ($iku as $element) {
						$group[$element->$cSasaran][] = $element;
					}


					foreach ($group as $id_sasaran => $iku) {
						$detail_sasaran = $this->renja_perencanaan_model->get_detail_sasaran($key, $id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">' . $value . '</span> ' . $detail_sasaran->$tSasaran . '</td>
						</tr>';
						foreach ($iku as $i) {
							$iku = $name['tIku'];
							$id_iku = $name['cIku'];
							$taIkuRenja = $name['taIkuRenja'];
							$vTarget = 'target_' . $tahun;
							$vAnggaran = 'anggaran_' . $tahun;
							$id = "'$key$no'";
							echo '<tr>
							<td>
							<div class="checkbox checkbox-primary">
							<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" checked class="child">
							<label for="checkbox2"></label>
							</div>
							</td>
							<td style="vertical-align:middle">' . $i->$iku . '</td>
							<td>
							<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vTarget . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
							</td>
							<td style="vertical-align:middle">' . $i->satuan . '</td>
							<td>
							<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vAnggaran . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
							</td>
							</tr>';
							$no++;
						}
					}
				} else {
					$no = 1;

					$group = array();

					foreach ($renja as $element) {
						$element->jenis = 'renja';
						$group[$element->$cSasaran][] = $element;
					}
					foreach ($iku as $element) {
						foreach ($renja as $r) {
							if ($element->$id_iku == $r->$id_iku) {
								continue (2);
							}
						}
						$element->jenis = 'iku';
						$group[$element->$cSasaran][] = $element;
					}

					foreach ($group as $id_sasaran => $iku) {
						$detail_sasaran = $this->renja_perencanaan_model->get_detail_sasaran($key, $id_sasaran);
						echo '
						<tr style="background-color:#f1e7fe	;">
						<td colspan="5" style="text-align:left"><span style="color:#6003C8;font-weight:700;">' . $value . '</span> ' . $detail_sasaran->$tSasaran . '</td>
						</tr>';
						foreach ($iku as $i) {
							if ($i->jenis == 'renja') {
								$tIku = $name['tIku'];
								$cIkuRenja = $name['cIkuRenja'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$aIkuRenja = $name['aIkuRenja'];
								$vTarget = 'target_' . $tahun;
								$vAnggaran = 'anggaran_' . $tahun;
								$id = "'$key$no'";
								echo '
								<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input type="hidden" value="' . $i->$cIkuRenja . '" name="' . $cIkuRenja . $i->$id_iku . '">
								<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" checked class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">' . $i->$tIku . '</td>
								<td>
								<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$taIkuRenja . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">' . $i->satuan . '</td>
								<td>
								<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$aIkuRenja . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							} elseif ($i->jenis == 'iku') {

								$tIku = $name['tIku'];
								$id_iku = $name['cIku'];
								$taIkuRenja = $name['taIkuRenja'];
								$vTarget = 'target_' . $tahun;
								$vAnggaran = 'anggaran_' . $tahun;
								$id = "'$key$no'";
								echo '<tr>
								<td>
								<div class="checkbox checkbox-primary">
								<input id="cb_' . $key . $no . '" onclick="cekParent(' . $id . ')" name="' . $id_iku . '[]" value="' . $i->$id_iku . '" type="checkbox" class="child">
								<label for="checkbox2"></label>
								</div>
								</td>
								<td style="vertical-align:middle">' . $i->$tIku . '</td>
								<td>
								<input id="target_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vTarget . '" name="' . $taIkuRenja . $i->$id_iku . '" placeholder="Masukkan Target">
								</td>
								<td style="vertical-align:middle">' . $i->satuan . '</td>
								<td>
								<input id="anggaran_' . $key . $no . '" type="text" class="form-control" value="' . $i->$vAnggaran . '" name="anggaran_' . $key . '_renja' . $i->$id_iku . '" placeholder="Masukkan Anggaran">
								</td>
								</tr>';
							}
							$no++;
						}
					}
					// if(count($iku)!==count($renja)){
					// 	echo'
					// 	<tr>
					// 	<td style="background-color:#98A6AD;color:#fff" colspan="5"><center><b><i class="ti-alert"></i> Indikator yang tidak diturunkan</b></center></td>
					// 	</tr>
					// 	';
					// }


				}
				echo '
				</tbody>
				</table>';
			}
		}
	}
}
