<?php
include_once(APPPATH."third_party/Common/Autoloader.php");
include_once(APPPATH."third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader AS CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_gaji_berkala extends CI_Controller {
	public $user_id;
	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('kenaikan_gaji_berkala_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('pegawai_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->level_id	= $this->user_model->level_id;
		$this->load->model('ref_golongan_model','golongan_m');
		$this->load->model('ref_pp_model','pp_m');
		$this->load->model('ref_kgb_model','kgb_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Kenaikan Gaji Berkala - Admin ";
			$data['content']	= "kenaikan_gaji_berkala/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'kenaikan_gaji_berkala';

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->kenaikan_gaji_berkala_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$nama = $_POST['nama_lengkap'];
				$nip = $_POST['nip'];
				$skpd = (@$_POST['id_skpd'])?$_POST['id_skpd']:'';
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data['nip'] = $_POST['nip'];
				$data['id_skpd'] = $skpd;
			}else{
				$filter = '';
				$nama = '';
				$nip = '';
				$skpd = '';
				$data['filter'] = false;
			}

			$data['pp'] = $this->pp_m->get_all();

			foreach ($data['pp'] as $row) {
				if ($row->status=="Y") {
					$pp = $row->id_pp;
				}
				for ($g=1; $g <= 4; $g++) { 
					$data['mkg'][$row->id_pp][$g] = $this->kgb_m->get_max_mkg_by_pp_golongan($row->id_pp,$g);
				}
			}

			$data['list'] = $this->kenaikan_gaji_berkala_model->get_page($mulai,$hal,$nama,$nip,$skpd);
			foreach ($data['list'] as $l) {
				$data['riwayat_kgb'][$l->id_pegawai] = $this->kenaikan_gaji_berkala_model->get_riwayat_kgb($l->id_pegawai,$limit=2);
				$data['data_by_bkd'][$l->id_pegawai] = $this->kenaikan_gaji_berkala_model->get_data_bkd($l->id_pegawai);
				$data['data_pegawai'][$l->id_pegawai] = $this->kenaikan_gaji_berkala_model->get_data_pegawai_by_id($l->id_pegawai);

		        $data['prediksi_kgb'][$l->id_pegawai] = NULL;
				$pangkat_pns	= NULL;
				if (@$data['data_by_bkd'][$l->id_pegawai]->gol) {
					$pangkat_pns = $data['data_by_bkd'][$l->id_pegawai]->gol;
				}
				if (@$data['data_pegawai'][$l->id_pegawai]->pangkat_pns) {
					$pangkat_pns = $data['data_pegawai'][$l->id_pegawai]->pangkat_pns;
				}
				if (@$data['data_pegawai'][$l->id_pegawai]->golongan_pns) {
					$pangkat_pns = $data['data_pegawai'][$l->id_pegawai]->golongan_pns;
				}
				$golongan_cpns 	= (@$data['data_pegawai'][$l->id_pegawai]->cpns_id_golongan) ? $data['data_pegawai'][$l->id_pegawai]->cpns_id_golongan : NULL ;

				if ($pangkat_pns AND $golongan_cpns AND ($data['data_by_bkd'][$l->id_pegawai] OR isset($data['data_pegawai'][$l->id_pegawai]->cpns_tmt))) {
					$riwayat_kgb 	= $this->kenaikan_gaji_berkala_model->get_riwayat_kgb($l->id_pegawai,$limit=1);
					$cpns_tmt		= (@$data['data_pegawai'][$l->id_pegawai]->cpns_tmt) ? $data['data_pegawai'][$l->id_pegawai]->cpns_tmt : $data['data_by_bkd'][$l->id_pegawai]->tmtcpns ;
					$golongan 		= $this->kenaikan_gaji_berkala_model->get_id_golongan_by_name($pangkat_pns)->id_golongan;
					$max_mkg 		= max($data['mkg'][$pp]);

					$pengurangan_awal = date("Y-m-d", strtotime("{$cpns_tmt} -{$data['data_pegawai'][$l->id_pegawai]->mkg_tahun_awal} year -{$data['data_pegawai'][$l->id_pegawai]->mkg_bulan_awal} month"));
					// echo $pengurangan_awal;
					// echo $data['data_by_bkd']->tmtcpns; die();
			        $awal = new DateTime ($pengurangan_awal);
			        $skrng = new DateTime (date("Y-m-d"));
			        $hasil = $skrng->diff($awal);
			        $mkg = $hasil->y;
			        $tahun_mkg = $hasil->y;

			        if ($golongan_cpns<20 AND $golongan>=20) $mkg-=6;
			        if ($golongan_cpns<30 AND $golongan>=30) $mkg-=5;
			        if ($mkg<0) $mkg = 0;

			        if ($riwayat_kgb) {
			        	if ($riwayat_kgb[0]->id_golongan == $golongan AND $riwayat_kgb[0]->mkg == $mkg) $mkg++;$tahun_mkg++;
			        }

			        for ($m=$mkg; $m <= $max_mkg; $m++) { 
			        	$data['prediksi_kgb'][$l->id_pegawai] = $this->kenaikan_gaji_berkala_model->get_prediksi_kgb($pp,$golongan,$m);
			        	if ($data['prediksi_kgb'][$l->id_pegawai]) break;
			        	$tahun_mkg++;
			        }

			        $data['prediksi_mkg'][$l->id_pegawai] = $tahun_mkg;
			    }

			}
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function view($id_pegawai=0)
	{
		if ($this->user_id && !empty($id_pegawai) && $id_pegawai>0)
		{

			$data['title']		= "Kenaikan Gaji Berkala - Admin ";
			$data['content']	= "kenaikan_gaji_berkala/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu']		= 'kenaikan_gaji_berkala';


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
			$data['jenisbahasa']= $this->pegawai_model->get_jenisbahasa();
			$data['jenisbahasa_asing']= $this->pegawai_model->get_jenisbahasa_asing();

			$data['data_pegawai'] = $this->kenaikan_gaji_berkala_model->get_data_pegawai_by_id($id_pegawai);
			//
			$data['data_pangkat'] = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
			$data['data_jabatan'] = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
			$data['data_pendidikan'] = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
			$data['data_diklat'] = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
			$data['data_penataran'] = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
			$data['data_seminar'] = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
			$data['data_kursus'] = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
			$data['data_unit_kerja'] = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
			$data['data_penghargaan'] = $this->pegawai_model->get_riwayat_penghargaan_by_id($id_pegawai);
			$data['data_penugasan'] = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
			$data['data_cuti'] = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
			$data['data_hukuman'] = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
			$data['pendidikan_last'] = $this->pegawai_model->get_riwayat_pendidikan($id_pegawai,1);
			$data['pangkat_last'] = $this->pegawai_model->get_riwayat_pangkat($id_pegawai,1);
			$data['jabatan_last'] = $this->pegawai_model->get_riwayat_jabatan($id_pegawai,1);
			$data['unit_kerja_last'] = $this->pegawai_model->get_riwayat_unit_kerja($id_pegawai,1);
			$data['data_bahasa']= $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
			$data['data_bahasa_asing']= $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
			$data['data_pernikahan'] = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
			$data['data_anak'] = $this->pegawai_model->get_riwayat_anak($id_pegawai);
			$data['data_orangtua'] = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
			$data['data_mertua'] = $this->pegawai_model->get_riwayat_mertua($id_pegawai);


			$data['detail'] = $this->kenaikan_gaji_berkala_model->get_by_id($id_pegawai);
			$data['data_by_bkd'] = $this->kenaikan_gaji_berkala_model->get_data_bkd($id_pegawai);

			
			$data['skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
			$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id($data['detail']->id_jabatan);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id($data['detail']->id_unit_kerja);
			$data['cek_user'] = $this->pegawai_model->cek_user($id_pegawai);

			$data['riwayat_kgb'] = $this->kenaikan_gaji_berkala_model->get_riwayat_kgb($id_pegawai);

			$data['golongan2'] = $this->golongan_m->get_all();
			$data['pp'] = $this->pp_m->get_all();

			for ($g=1; $g <= 4; $g++) { 
				$data['golongan_golongan'][$g] = $this->golongan_m->get_all_by_golongan($g);
			}

			foreach ($data['pp'] as $row) {
				if ($row->status=="Y") {
					$pp = $row->id_pp;
				}
				for ($g=1; $g <= 4; $g++) { 
					$data['mkg'][$row->id_pp][$g] = $this->kgb_m->get_max_mkg_by_pp_golongan($row->id_pp,$g);
				}
			}

			foreach ($data['pp'] as $r_pp) {
				$data['item'.$r_pp->id_pp] = array();
				foreach ($data['mkg'][$r_pp->id_pp] as $key_g => $r_max) {
					if ($r_max>=0) {
						for ($i=0; $i <= $r_max; $i++) {
							foreach ($data['golongan2'] as $r_gol) {
								if ($r_gol->id_golongan>=$key_g.'0' AND $r_gol->id_golongan<=$key_g.'9') {
									$data['item'.$r_pp->id_pp][$key_g][$i][$r_gol->id_golongan] = $this->kgb_m->get_item($r_pp->id_pp,$i,$r_gol->id_golongan);
								}
							}
						}
					}
				}
			}

	        $data['prediksi_kgb'] = NULL;
			$pangkat_pns	= NULL;
			if (@$data['data_by_bkd']->gol) {
				$pangkat_pns = $data['data_by_bkd']->gol;
			}
			if (@$data['data_pegawai']->pangkat_pns) {
				$pangkat_pns = $data['data_pegawai']->pangkat_pns;
			}
			if (@$data['data_pegawai']->golongan_pns) {
				$pangkat_pns = $data['data_pegawai']->golongan_pns;
			}
			$golongan_cpns 	= (@$data['data_pegawai']->cpns_id_golongan) ? $data['data_pegawai']->cpns_id_golongan : NULL ;

			if ($pangkat_pns AND $golongan_cpns AND ($data['data_by_bkd'] OR isset($data['data_pegawai']->cpns_tmt))) {
				$riwayat_kgb 	= $this->kenaikan_gaji_berkala_model->get_riwayat_kgb($id_pegawai,$limit=1);
				$cpns_tmt		= (@$data['data_pegawai']->cpns_tmt) ? $data['data_pegawai']->cpns_tmt : $data['data_by_bkd']->tmtcpns ;
				$golongan 		= $this->kenaikan_gaji_berkala_model->get_id_golongan_by_name($pangkat_pns)->id_golongan;
				$max_mkg 		= max($data['mkg'][$pp]);

				$pengurangan_awal = date("Y-m-d", strtotime("{$cpns_tmt} -{$data['data_pegawai']->mkg_tahun_awal} year -{$data['data_pegawai']->mkg_bulan_awal} month"));
				// echo $pengurangan_awal;
				// echo $data['data_by_bkd']->tmtcpns; die();
		        $awal = new DateTime ($pengurangan_awal);
		        $skrng = new DateTime (date("Y-m-d"));
		        $hasil = $skrng->diff($awal);
		        $mkg = $hasil->y;
		        $tahun_mkg = $hasil->y;

		        if ($golongan_cpns<20 AND $golongan>=20) $mkg-=6;
		        if ($golongan_cpns<30 AND $golongan>=30) $mkg-=5;
		        if ($mkg<0) $mkg = 0;

		        if ($riwayat_kgb) {
		        	if ($riwayat_kgb[0]->id_golongan == $golongan AND $riwayat_kgb[0]->mkg == $mkg) $mkg++;$tahun_mkg++;
		        }

		        for ($m=$mkg; $m <= $max_mkg; $m++) { 
		        	$data['prediksi_kgb'] = $this->kenaikan_gaji_berkala_model->get_prediksi_kgb($pp,$golongan,$m);
		        	if ($data['prediksi_kgb']) break;
		        	$tahun_mkg++;
		        }

		        $data['prediksi_mkg'] = $tahun_mkg;
		    }

			// print_r($data['prediksi_mkg']);die;



			$this->user_model->id_pegawai = $id_pegawai;
			$data['id_pegawai'] = $id_pegawai;
			if ($data['cek_user']) {

			$data['user'] = $this->kenaikan_gaji_berkala_model->get_user_by_id_pegawai($id_pegawai);
			$data['detail_user'] = $this->user_model->get_by_pegawai();

			$data['u'] = $this->user_model->get_user_by_user_id($data['detail_user']->user_id);


			$data['active_menu'] = "";
			$data['top_nav']	= "NO";
			$this->load->model('post_model');
			$data['total_post']	= $this->post_model->getTotalByAuthor($this->user_id);

			//activity
			$this->load->model('logs_model');
			$data['logs']		= $this->logs_model->get_some_id($this->user_model->user_id);

			//departmen
			$this->load->model('ref_unit_kerja_model');
			$data['get_unit_kerja']		= $this->ref_unit_kerja_model->get_all();
			}

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	function pilih_kgb($id)
	{
		$query = $this->kenaikan_gaji_berkala_model->get_detail_kgb_by_id($id);
		echo json_encode($query);
	}

	function update_kgb($id)
	{
		$query = $this->kenaikan_gaji_berkala_model->get_riwayat_kgb_by_id($id);
		echo json_encode($query);
	}

	function input_kgb($id_pegawai=0)
	{
		if ($_POST) {
			if ($_POST['id_riwayat_kgb_lama']==0) { //add riwayat
				$data_lama = array(	'id_pegawai'	=> $id_pegawai,
										'id_pp'			=> $_POST['id_pp_lama'],
										'id_golongan'	=> $_POST['id_golongan_lama'],
										'id_kgb'		=> ($_POST['id_kgb_lama']>0) ? $_POST['id_kgb_lama'] : null,
										'nomor_kgb'		=> $_POST['nomor_kgb_lama'],
										'tanggal_buat'	=> $_POST['tanggal_buat_lama'],
										'gaji_pokok'	=> $_POST['gaji_pokok_lama'],
										'mkg'			=> $_POST['mkg_lama'],
										'terhitung_mulai_tanggal'	=> $_POST['terhitung_mulai_tanggal_lama'],
										 );
				$insert_id = $this->kenaikan_gaji_berkala_model->insert_riwayat_kgb($data_lama);
			}

			if ($_POST['id_riwayat_kgb']>0) { //update
				$data = array(	'id_riwayat_kgb_lama'	=> (@$insert_id>0) ? $insert_id : $_POST['id_riwayat_kgb_lama'] );
				$update = $this->kenaikan_gaji_berkala_model->update_riwayat_kgb($_POST['id_riwayat_kgb'],$data);
			} else { //insert
				$data = array(	'id_pegawai'	=> $id_pegawai,
								'id_pp'			=> $_POST['id_pp'],
								'id_golongan'	=> $_POST['id_golongan'],
								'id_kgb'		=> ($_POST['id_kgb']>0) ? $_POST['id_kgb'] : null,
								'id_riwayat_kgb_lama'	=> (@$insert_id>0) ? $insert_id : $_POST['id_riwayat_kgb_lama'],
								'nomor_kgb'		=> $_POST['nomor_kgb'],
								'tanggal_buat'	=> $_POST['tanggal_buat'],
								'gaji_pokok'	=> $_POST['gaji_pokok'],
								'mkg'			=> $_POST['mkg'],
								'terhitung_mulai_tanggal'	=> $_POST['terhitung_mulai_tanggal'],
								 );
				$insert = $this->kenaikan_gaji_berkala_model->insert_riwayat_kgb($data);
			}
		}
		redirect('kenaikan_gaji_berkala/view/'.$id_pegawai);
	}

	public function cetak_kgb($id)
	{
		$kgb = $this->kenaikan_gaji_berkala_model->get_detail_riwayat_kgb_by_id($id);
		$kgb_lama = $this->kenaikan_gaji_berkala_model->get_detail_riwayat_kgb_by_id($kgb->id_riwayat_kgb_lama);
		$data_pegawai = $this->kenaikan_gaji_berkala_model->get_data_pegawai_by_id($kgb->id_pegawai);
		$data_by_bkd = $this->kenaikan_gaji_berkala_model->get_data_bkd($kgb->id_pegawai);
		// echo "<pre>";
		// print_r($kgb);
		// print_r($kgb_lama);
		// print_r($data_pegawai);
		// print_r($data_by_bkd);
		// echo "</pre>";
		// die();

		if ($kgb->file_surat AND file_exists("./data/surat_kgb/".$kgb->file_surat)) {
			$filename = $kgb->file_surat;
		} else {
			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$phpWord->getCompatibility()->setOoxmlVersion(14);
			$phpWord->getCompatibility()->setOoxmlVersion(15);

			$template = "surat_kgb.docx";
			$filename = $data_by_bkd->nama_lengkap.'_'.$kgb->terhitung_mulai_tanggal.'_'.time().".docx";
			$filename = str_replace(",","", $filename);
			$filename = str_replace(" ","_", $filename);

			$template_path = './data/template_surat/'.$template;
			$template = $phpWord->loadTemplate($template_path);

			$template->setValue('nama_lengkap', $data_by_bkd->nama_lengkap);
			$template->setValue('tempat_lahir', $data_by_bkd->temlahir);
			$template->setValue('tgl_lahir', date("d-m-Y", strtotime($data_by_bkd->tgllahir)));
			$template->setValue('nip', $data_by_bkd->nip);
			$template->setValue('karpeg', $data_pegawai->karpeg);
			$template->setValue('pangkat', $data_by_bkd->pangkat);
			$template->setValue('gol', $data_by_bkd->gol);
			$template->setValue('nama_jabatan', $data_by_bkd->nama_jabatan);
			$template->setValue('unitkerja', $data_by_bkd->unitkerja);

			$template->setValue('gaji_pokok_lama', 'Rp.'.number_format($kgb_lama->gaji_pokok,0,',','.').',-');
			$template->setValue('pp_lama', $kgb_lama->nama_pp);
			$template->setValue('tanggal_buat_lama', tanggal($kgb_lama->tanggal_buat));
			$template->setValue('nomor_kgb_lama', $kgb_lama->nomor_kgb);
			$template->setValue('terhitung_mulai_tanggal_lama', tanggal($kgb_lama->terhitung_mulai_tanggal));
			$template->setValue('mkg_lama', sprintf("%02d", $kgb_lama->mkg).' Tahun 00 Bulan');

			$template->setValue('gaji_pokok', 'Rp.'.number_format($kgb->gaji_pokok,0,',','.').',-');
			$template->setValue('pp', $kgb->nama_pp);
			$template->setValue('tanggal_buat', tanggal($kgb->tanggal_buat));
			$template->setValue('nomor_kgb', $kgb->nomor_kgb);
			$template->setValue('terhitung_mulai_tanggal', tanggal($kgb->terhitung_mulai_tanggal));
			$template->setValue('mkg', sprintf("%02d", $kgb->mkg).' Tahun 00 Bulan');
			$template->setValue('golongan', $kgb->pangkat);

			$terhitung_mulai_tanggal_baru = date("Y-m-d", strtotime(date("Y-m-d", strtotime($kgb->terhitung_mulai_tanggal)) . " + 2 year"));
			$template->setValue('terhitung_mulai_tanggal_baru', tanggal($terhitung_mulai_tanggal_baru));


			ob_clean();
			$template->saveAs("./data/surat_kgb/".$filename);

			$data['file_surat'] = $filename;
		}

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize("./data/surat_kgb/".$filename));
		flush();
		readfile("./data/surat_kgb/".$filename);

		$data['terakhir_dicetak'] = date('Y-m-d');
		$update = $this->kenaikan_gaji_berkala_model->update_riwayat_kgb($kgb->id_riwayat_kgb,$data);
	}

	public function update_cpns($id,$id_pegawai)
	{
		$data = array(	'cpns_id_golongan'	=> $_POST['cpns_id_golongan'],
						'cpns_tmt'			=> $_POST['cpns_tmt'],
						'mkg_tahun_awal'	=> $_POST['mkg_tahun_awal'],
						'mkg_bulan_awal'	=> $_POST['mkg_bulan_awal'],
						 );
		$update = $this->kenaikan_gaji_berkala_model->update_cpns($id,$id_pegawai,$data);
		redirect('kenaikan_gaji_berkala/view/'.$id_pegawai);
	}

	public function hapus_kgb($id,$id_pegawai)
	{
		$delete = $this->kenaikan_gaji_berkala_model->delete_riwayat_kgb($id,$id_pegawai);
		redirect('kenaikan_gaji_berkala/view/'.$id_pegawai);
	}


}
?>
