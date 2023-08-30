<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('logs_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('laporan_sakip_model');
		$this->load->model('kegiatan_personal_model', 'kpm');
		$this->load->model('dashboard_model', 'dm');
		$this->load->model('Laporan_model', 'lm');
		
		$this->load->model('renja_rka_model');
		
		$this->load->model('renja_perencanaan_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('ref_visi_misi_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		$this->load->model('ref_absensi_model','ref_absensi_m');
	}
	public function index()
	{
		$this->pegawai($tahun=null);
	}

	public function perencanaan()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Perencanaan - Admin ";
			$data['content']	= "laporan/renstra/perencanaan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			
			$data['misi'] = $this->laporan_sakip_model->get_misi();

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['jenis'] = array('ss','sk','sp');

			if($this->user_level!=='Administrator'){
				$data['id_skpd'] = $this->session->userdata('id_skpd');
			}else{
				$data['id_skpd'] = 0;
			}

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function cetak_perencanaan()
	{
		if ($this->user_id)
		{
			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			include APPPATH.'third_party/PHPExcel.php';
			include APPPATH.'third_party/PHPExcel/IOFactory.php';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel = PHPExcel_IOFactory::load("./template/template_perencanaan.xlsx");
			$baris  = 8;
			$params = array();
			if(!empty($_POST)){
				if(!empty($_POST['tahun_rkt'])){
					$params['tahun'] = $_POST['tahun_rkt'];
				}
				if(!empty($_POST['id_unit_kerja'])){
					$params['id_unit'] = $_POST['id_unit_kerja'];
				}
			// print_r($params);die;
			}
			if($this->user_level!=='Administrator'){
				$params['id_unit'] = $this->session->userdata('unit_kerja_id');
			}
			$item = $this->sasaran_strategis_model->getAllSasaran($params);
			$no=1;

			foreach ($item as $i){
				// print_r($i);
				if($i->jenis=='SS'){
					$n = 'sasaran_strategis';
					$iku = $this->sasaran_strategis_model->get_iku($i->id_sasaran_strategis);
				}elseif($i->jenis=='SP'){
					$n = 'sasaran_program';
					$iku = $this->sasaran_program_model->get_iku($i->id_sasaran_program);
				}elseif($i->jenis=='SK'){
					$n = 'sasaran_kegiatan';
					$iku = $this->sasaran_kegiatan_model->get_iku($i->id_sasaran_kegiatan);
				}
				$nama_unit_kerja = $this->ref_unit_kerja_model->get_by_id($i->id_unit)->nama_unit_kerja;
				$kode = 'kode_'.$n;
				$styleArray = array(
                  // 'borders' => array(
                  //   'allborders' => array(
                  //     'style' => PHPExcel_Style_Border::BORDER_THIN
                  //   )
                  // )
				);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, $no);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, $i->$kode);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, $i->$n);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, $i->bobot."%");

				if(count($iku)>0){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, 1);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, $iku[0]->kode_indikator);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, $iku[0]->nama_indikator);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, $iku[0]->bobot."%");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, $iku[0]->target);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, $iku[0]->satuan);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, ($iku[0]->polaritas=='MAX') ? 'Maximize' : (($iku[0]->polaritas=='MIN') ? 'Minimize' : '-'));
				}else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, "-");
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$baris, $nama_unit_kerja);


				$no++;
				$baris++;


				if(count($iku)>1){
					$noo=1;
					foreach($iku as $ii){
						if($noo!==1){
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, $noo);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, $ii->kode_indikator);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, $ii->nama_indikator);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, $ii->bobot."%");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, $ii->target);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, $ii->satuan);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, ($ii->polaritas=='MAX') ? 'Maximize' : (($ii->polaritas=='MIN') ? 'Minimize' : '-'));
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$baris, $nama_unit_kerja);
							$baris++;
						}
						$noo++;
					}
				}


			}


			if($this->user_level!=='Administrator'){

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Unit Kerja '.$nama_unit_kerja);
			}
			$objPHPExcel->getActiveSheet()->setTitle('Data');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$filename = 'Laporan Perencanaan SIKAP.xlsx';
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			$objWriter->save("php://output");


		}
		else
		{
			redirect('admin');
		}
	}

	public function pencapaian()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Pencapaian - Admin ";
			$data['content']	= "laporan/renstra/pencapaian" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['jenis'] = array('ss','sk','sp');
						if($this->user_level!=='Administrator'){
				$data['id_skpd'] = $this->session->userdata('id_skpd');
			}else{
				$data['id_skpd'] = 0;
			}

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function lap_renja()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Perencanaan - Admin ";
			$data['content']	= "laporan/renja/renja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$data['jenis'] = array('ss','sp','sk');
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function cetak_pencapaian()
	{
		if ($this->user_id)
		{
			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			include APPPATH.'third_party/PHPExcel.php';
			include APPPATH.'third_party/PHPExcel/IOFactory.php';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel = PHPExcel_IOFactory::load("./template/template_pencapaian.xlsx");
			$baris  = 8;
			$params = array();
			if(!empty($_POST)){
				if(!empty($_POST['tahun_rkt'])){
					$params['tahun'] = $_POST['tahun_rkt'];
				}
				if(!empty($_POST['id_unit_kerja'])){
					$params['id_unit'] = $_POST['id_unit_kerja'];
				}
			// print_r($params);die;
			}
			if($this->user_level!=='Administrator'){
				$params['id_unit'] = $this->session->userdata('unit_kerja_id');
			}
			$item = $this->sasaran_strategis_model->getAllSasaran($params);
			$no=1;

			foreach ($item as $i){
				// print_r($i);
				if($i->jenis=='SS'){
					$n = 'sasaran_strategis';
					$iku = $this->sasaran_strategis_model->get_iku($i->id_sasaran_strategis);
				}elseif($i->jenis=='SP'){
					$n = 'sasaran_program';
					$iku = $this->sasaran_program_model->get_iku($i->id_sasaran_program);
				}elseif($i->jenis=='SK'){
					$n = 'sasaran_kegiatan';
					$iku = $this->sasaran_kegiatan_model->get_iku($i->id_sasaran_kegiatan);
				}
				$nama_unit_kerja = $this->ref_unit_kerja_model->get_by_id($i->id_unit)->nama_unit_kerja;
				$kode = 'kode_'.$n;
				$styleArray = array(
                  // 'borders' => array(
                  //   'allborders' => array(
                  //     'style' => PHPExcel_Style_Border::BORDER_THIN
                  //   )
                  // )
				);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, $no);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, $i->$kode);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, $i->$n);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, $i->bobot."%");

				if(count($iku)>0){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, 1);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, $iku[0]->kode_indikator);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, $iku[0]->nama_indikator);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, $iku[0]->bobot."%");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, $iku[0]->target);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, $iku[0]->satuan);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, ($iku[0]->polaritas=='MAX') ? 'Maximize' : (($iku[0]->polaritas=='MIN') ? 'Minimize' : '-'));
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$baris, $iku[0]->realisasi);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$baris, round($iku[0]->capaian,2)."%");
				}else{
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$baris, "-");
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$baris, "-");
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("N".$baris, $nama_unit_kerja);


				$no++;
				$baris++;


				if(count($iku)>1){
					$noo=1;
					foreach($iku as $ii){
						if($noo!==1){
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, "");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, $noo);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("F".$baris, $ii->kode_indikator);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("G".$baris, $ii->nama_indikator);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("H".$baris, $ii->bobot."%");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("I".$baris, $ii->target);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("J".$baris, $ii->satuan);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("K".$baris, ($ii->polaritas=='MAX') ? 'Maximize' : (($ii->polaritas=='MIN') ? 'Minimize' : '-'));
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("L".$baris, $ii->realisasi);
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("M".$baris, round($ii->capaian,2)."%");
							$objPHPExcel->setActiveSheetIndex(0)->setCellValue("N".$baris, $nama_unit_kerja);
							$baris++;
						}
						$noo++;
					}
				}


			}

			if($this->user_level!=='Administrator'){

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Unit Kerja '.$nama_unit_kerja);
			}
			$objPHPExcel->getActiveSheet()->setTitle('Data');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$filename = 'Laporan Pencapaian SIKAP.xlsx';
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			$objWriter->save("php://output");


		}
		else
		{
			redirect('admin');
		}
	}

	public function renaksi(){

		if ($this->user_id)
		{
			$data['title']		= "Laporan Rencana Aksi - Admin ";
			$data['content']	= "laporan/renaksi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			// if(!empty($_POST)){
			// 	$this->ref_absensi_m->nama_absensi = $_POST['nama_absensi'];
			// 	$this->ref_absensi_m->uraian = $_POST['uraian'];
			// }
			// $data['item'] = $this->ref_absensi_m->get_all();


			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['jenis'] = array('ss','sk','sp');

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function cetak_renaksi(){

		if ($this->user_id)
		{
			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			include APPPATH.'third_party/PHPExcel.php';
			include APPPATH.'third_party/PHPExcel/IOFactory.php';

			$objPHPExcel = new PHPExcel();
			$objPHPExcel = PHPExcel_IOFactory::load("./template/template_renaksi.xlsx");
			$baris  = 8;
			$params = array();
			if(!empty($_POST)){
				if(!empty($_POST['tahun_rkt'])){
					$params['tahun'] = $_POST['tahun_rkt'];
				}
				if(!empty($_POST['id_unit_kerja'])){
					$params['id_unit'] = $_POST['id_unit_kerja'];
				}
			// print_r($params);die;
			}
			if($this->user_level!=='Administrator'){
				$params['id_unit'] = $this->session->userdata('unit_kerja_id');
			}
			$item = $this->renaksi_model->get_renaksi_all($params);
			$no=1;

			foreach ($item as $i){

				$uid = $i->uid_iku;
				$kode = substr($uid,1,2);
				if($kode=="SS"){
					$r = $this->sasaran_strategis_model->gDataW(array('uid_iku'=>$uid))->row();
					$nama_u = $this->sasaran_strategis_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
                // print_r($id_unit);
				}elseif($kode=="SK"){
					$r = $this->sasaran_kegiatan_model->gDataW(array('uid_iku'=>$uid))->row();
					$nama_u = $this->sasaran_kegiatan_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
				}elseif ($kode=="SP") {
					$r = $this->sasaran_program_model->gDataW(array('uid_iku'=>$uid))->row();
					$nama_u = $this->sasaran_program_model->get_data_by_id($r->id_sasaran)[0]->nama_unit_kerja;
				}

				$re = $this->renaksi_model->getDetail(array('renaksi.id_renaksi'=>$i->id_renaksi));
				$styleArray = array(
                  // 'borders' => array(
                  //   'allborders' => array(
                  //     'style' => PHPExcel_Style_Border::BORDER_THIN
                  //   )
                  // )
				);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("A".$baris, $no);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("B".$baris, $r->kode_indikator);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("C".$baris, $r->nama_indikator);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("D".$baris, $nama_u);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue("E".$baris, $i->satuan);

				$noo=0;
				$field = array('F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC');
				foreach($re as $rr){
					if(empty($rr->target)){
						$jadwal = 'N';
					}else{
						$jadwal = 'Y';
					}
					$realisasi = ($rr->realisasi==''||empty($rr->realisasi)) ? '-' : $rr->realisasi;
					$target = ($rr->target==''||empty($rr->target)) ? '-' : $rr->target;
					if($jadwal=="Y"){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($field[$noo].$baris, $target);
						$noo++;
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($field[$noo].$baris, $realisasi);
						$noo++;
					}else{
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($field[$noo].$baris, "-");
						$noo++;
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($field[$noo].$baris, "-");
						$noo++;
					}
				}

				$no++;
				$baris++;


			}
			// die;
			if($this->user_level!=='Administrator'){

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Unit Kerja '.$nama_unit_kerja);
			}
			$objPHPExcel->getActiveSheet()->setTitle('Data');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$filename = 'Laporan Renaksi SIKAP.xlsx';
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'"');
			$objWriter->save("php://output");


		}
		else
		{
			redirect('admin');
		}
	}


	public function pohonkerja()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Pohon Kerja - Admin ";
			$data['content']	= "laporan/renja/pohonkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();
			$data['visi'] = $this->laporan_sakip_model->get_visi();



			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function get_indikator($type,$id){
		if ($this->user_id)
		{

			if($type=='ss'){
				$iku = $this->laporan_sakip_model->get_iku_sasaran($type,$id,2019);
				$sasaran = $this->laporan_sakip_model->get_sasaran_strategis_by_id($id);
				$res['sasaran_renstra'] = $sasaran->sasaran_strategis_renstra;
			}elseif($type=='sp'){
				$iku = $this->laporan_sakip_model->get_iku_sasaran($type,$id,2019);
				$sasaran = $this->laporan_sakip_model->get_sasaran_program_by_id($id);
				$res['sasaran_renstra'] = $sasaran->sasaran_program_renstra;
			}elseif($type=='sk'){
				$iku = $this->laporan_sakip_model->get_iku_sasaran($type,$id,2019);
				$sasaran = $this->laporan_sakip_model->get_sasaran_kegiatan_by_id($id);
				$res['sasaran_renstra'] = $sasaran->sasaran_kegiatan_renstra;
			}else{
				$res = array('status'=>false);
			}
			// print_r($iku);die;
			$name = $this->laporan_sakip_model->name($type);
			$this->load->model('renstra_realisasi_model');
			$res['html'] = '';
			if($iku){
				$n=1;
				$tIku = $name['tIku'];
				$cIku = $name['cIku'];
				$cIkuRenja = $name['cIkuRenja'];
				$taIkuRenja = $name['taIkuRenja'];
				$aIkuRenja = $name['aIkuRenja'];
				$rIkuRenja = $name['rIkuRenja'];
				$total_capaian = 0;
				foreach($iku as $i){
					$uk = $this->renstra_realisasi_model->get_unit_iku($type,$i->$cIku);
					$a_unit_kerja = array();
					foreach($uk as $u){
						$a_unit_kerja[] = $u->nama_unit_kerja;
					}
					$uk = implode(', ', $a_unit_kerja);
					$target = $i->$taIkuRenja;
					$realisasi = $i->$rIkuRenja;
					$pola = $i->polorarisasi;

					$capaian = get_capaian($target,$realisasi,$pola);
					$total_capaian += $capaian;
					$res['html'] .= '
					<tr>
					<td>'.$n.'</td>
					<td>'.$i->$tIku.'</td>
					<td>'.$i->satuan.'</td>
					<td>'.$i->$taIkuRenja.'</td>
					<td>'.$i->$rIkuRenja.'</td>
					<td>'.$i->polorarisasi.'</td>
					<td>'.$i->bobot_tertimbang.'%</td>
					<td>2</td>
					<td>'.$i->jenis_casecading.'</td>
					<td>'.$uk.'</td>
					</tr>';
				}
			}else{
				$res['html'] .= '	
				<tr>
				<td colspan="10">
				<center>Indikator Belum diturunkan dari Renstra</center>
				
				</td>
				</tr>';
			}


			echo json_encode($res);

		}else{
			redirect('admin');
		}
	}

	public function cascading_iku()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan Pohon Kerja - Admin ";
			$data['content']	= "laporan/cascading_iku" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$data['tahun'] = $this->ref_rkt_model->get_tahun();

			$data['tahun_rkt'] = date('Y');

			if(!empty($_POST)){
				$data = array_merge($data,$_POST);

				$this->load->model("ref_unit_kerja_model");
				$this->load->model("indikator_model");
				$unit = $this->ref_unit_kerja_model->getUnit(array('id_unit_kerja' => $_POST['id_unit_penanggungjawab']));

				if($unit[0]->level_unit_kerja==0){
					$type = "SS";
				}
				elseif($unit[0]->level_unit_kerja==1){
					$type = "SP";
				}
				else{
					$type = "SK";
				}
				$params = array(
					'type' => $type,
					'id_unit' => $_POST['id_unit_penanggungjawab'],
				);
				$data['_type'] = $type;
				$data['indikator'] = $this->indikator_model->getIndikator($params,"uid_iku is not null");

			}

			if($this->user_level=='Administrator'){
				$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			}
			else{
				$data['unit_kerja'] = $this->ref_unit_kerja_model->getUnit(null,"id_unit_kerja = '".$this->session->userdata('unit_kerja_id')."' OR ket_induk like '%|".$this->session->userdata('unit_kerja_id')."|%'");
			}

//echo "<pre>";print_r($data);die;

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function getiku()
	{
	//die($_POST['id_unit']);
		if(!empty($_POST['id_unit']))
		{
			$this->load->model("indikator_model");
			$this->load->model("ref_unit_kerja_model");
			$unit = $this->ref_unit_kerja_model->getUnit(array('id_unit_kerja' => $_POST['id_unit']));

			if(!empty($unit)){
				if($unit[0]->level_unit_kerja==0){
					$type = "SS";
				}
				elseif($unit[0]->level_unit_kerja==1){
					$type = "SP";
				}
				else{
					$type = "SK";
				}
				$params = array(
					'type' => $type,
					'id_unit' => $_POST['id_unit'],
				);
				$indikator = $this->indikator_model->getIndikator($params,"uid_iku is not null");

				$opt = "";
				foreach ($indikator as $row) {
					$opt .= "<option value='$row->id_indikator'>$row->nama_indikator</option>";
				}
				die ($opt);
			}
		}
	}

	public function pengukuran_unitkerja()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan unitkerja - Admin ";
			$data['content']	= "laporan/renja/unitkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$this->load->model('master_pegawai_model');
			$data['ref_skpd'] = $this->ref_skpd_model->get_all();

			if ($_GET AND $this->input->get('id_skpd')) {
				$id_skpd = $this->input->get('id_skpd');
				$tahun = $this->input->get('tahun');

				$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');

				$data['jenis'] = $jenis;

				$data['tahun'] = $tahun;
				$data['id_skpd'] = $id_skpd;
				$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
				$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
				$data['jumlah_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);

				$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
				$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_level($id_skpd,1);
				$data['jabatan'] = $this->ref_skpd_model->get_jabatan_by_id_skpd($id_skpd);
			}

			// print_r($data['unit_kerja']); exit();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function lap_renaksi()
	{
		if ($this->user_id)
		{
			$data['title']		= "Laporan unitkerja - Admin ";
			$data['content']	= "laporan/renaksi/renaksi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			if(!empty($_POST)){
				$filter = $_POST;
				$tahun = $_POST["tahun"];
				$id_skpd = $_POST["id_skpd"];
				$data['filter'] = true;
				$data['tahun'] = $_POST['tahun'];
				$data['id_skpd'] = $_POST['id_skpd'];
			}else{
				$tahun= '';
				$id_skpd = '';
				$data['filter'] = false;
			}

			if($this->user_level=='User'){
				$id_skpd = $this->session->userdata('id_skpd');
			}


			$data['list'] = $this->lm->get_laporan_renaksi($id_skpd, $tahun);
			$data['bulan'] = $this->lm->get_bulan_renaksi($id_skpd, $tahun);
			$data['list_sp'] = $this->lm->get_laporan_renaksi_sp($id_skpd, $tahun);
			$data['bulan_sp'] = $this->lm->get_bulan_renaksi_sp($id_skpd, $tahun);
			$data['list_sk'] = $this->lm->get_laporan_renaksi_sk($id_skpd, $tahun);
			$data['bulan_sk'] = $this->lm->get_bulan_renaksi_sk($id_skpd, $tahun);


			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();

			$data['jenis'] = array('ss','sk','sp');
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function detail_unitkerja($id_unit_kerja=null,$tahun_rkt=null)
	{
		$unit = $this->ref_unit_kerja_model->getUnit(array('id_unit_kerja' => $id_unit_kerja));


		if ($this->user_id && $id_unit_kerja!=null && $tahun_rkt!=null && $unit!=null)
		{
			$data['title']		= "Laporan unitkerja - Admin ";
			$data['content']	= "laporan/detail_unitkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			if(!empty($_POST['tahun_rkt'])) $tahun_rkt = $_POST['tahun_rkt'];
			$data['tahun_rkt'] = $tahun_rkt;

			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['unit'] = $unit[0];

			$this->ref_rkt_model->id_unit_penanggungjawab=$id_unit_kerja;
			$this->ref_rkt_model->tahun_rkt = $tahun_rkt;
			$data['rkt'] = $this->ref_rkt_model->get_all();
			$data['id_rkt'] = $data['rkt'][0]->id_rkt;
			$data['detail_unit'] = $this->ref_unit_kerja_model->detail_unit($id_unit_kerja);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function pegawai($tahun=null)
	{
		if ($this->user_id)
		{
			if ($tahun == null) {
				redirect('laporan/pegawai/index/'.date("Y"));
			}
			$data['title']		= "Laporan Unit Kerja - Admin ";
			$data['content']	= "laporan/pegawai" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
	//$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['skpd'] = $this->ref_skpd_model->get_all();


			$this->load->model('pegawai_model');
			if(!empty($_POST)){
				$id_skpd = $_POST['id_skpd'];
				$nama_lengkap = $_POST['nama_lengkap'];
				$data['id_skpd'] = $_POST['id_skpd'];
				$data['nama_lengkap'] = $_POST['nama_lengkap'];
				$data = array_merge($data,$_POST);
			}else{
				$id_skpd='';
				$nama_lengkap='';
				$data['id_skpd'] = '';
				$data['nama_lengkap'] = '';
			}
			$this->load->model('kinerja_pegawai_model');
			$data['pegawai'] = $this->pegawai_model->get_all($id_skpd, $nama_lengkap);


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_pegawai($id_pegawai, $tahun=null)
	{
		if ($this->user_id)
		{
			if (!($id_pegawai)) {
				redirect(base_url('laporan/pegawai'));
			}
			if ($tahun == null) {
				redirect('laporan/detail_pegawai/'.$id_pegawai.'/'.date("Y"));
			}
			$data['title']		= "Laporan Unit Kerja - Admin ";
			$data['content']	= "laporan/detail_pegawai" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['user_id'] = $id_pegawai;
			$data['active_menu'] = "laporan";

			$this->load->model('realisasi_kegiatan_model');
			$this->load->model('kegiatan_model');
			$this->load->model('pegawai_model');
			$this->load->model('kinerja_pegawai_model');
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			if (empty($data['data_by_bkd'])) {
// show_404();
			}
			$data['kegiatan_personal'] = $this->kpm->get_all_by_id($id_pegawai);

			$data['kegiatan']		= $this->kegiatan_model->get_all_pegawai($id_pegawai);
			$data['details_pegawai'] = $this->pegawai_model->get_by_id($id_pegawai);
			$id_unit_kerja = $data['details_pegawai']->id_unit_kerja;
			$data['iku_ss'] = $this->kinerja_pegawai_model->get_kinerja('ss',$data['details_pegawai']->nip);
			$data['iku_sp'] = $this->kinerja_pegawai_model->get_kinerja('sp',$data['details_pegawai']->nip);
			$data['iku_sk'] = $this->kinerja_pegawai_model->get_kinerja('sk',$data['details_pegawai']->nip);
// print_r($data['iku_sp']);die;
			$data['total_indikator'] = $this->kinerja_pegawai_model->get_jumlah_indikator_pegawai($data['details_pegawai']->nip);
// echo $data['total_indikator'];die;
			$this->load->model('master_pegawai_model');
			$pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);

			$data['logs']	= $this->logs_model->get_some_id($pegawai->id_user);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_kegiatan_personal($id_pegawai)
	{
		if ($this->user_id)
		{
			if (!($id_pegawai)) {
				redirect(base_url('laporan/pegawai'));
			}
			$data['title']		= "Kegiatan Personal - Admin ";
			$data['content']	= "laporan/detail_kegiatan_personal" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			if (empty($data['data_by_bkd'])) {
				show_404();
			}
			$data['kegiatan_personal'] = $this->kpm->get_all_by_id($id_pegawai);
			$data['kegiatan_personal_unverif'] = $this->kpm->get_all_by_id_unverif($id_pegawai);
			$data['kegiatan_personal_verif'] = $this->kpm->get_all_by_id_verif($id_pegawai);
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_kegiatan_tim($id_pegawai)
	{
		if ($this->user_id)
		{
			$data['title']		= "Kegiatan Personal - Admin ";
			$data['content']	= "laporan/detail_kegiatan_tim" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";

			$this->load->model('kegiatan_model');
			$this->load->model('realisasi_kegiatan_model');

			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			if (empty($data['data_by_bkd'])) {
				show_404();
			}

			if(!empty($_POST)){
				$filter = $_POST;
			}else{
				$filter = '';
			}

			$data['kegiatan']		= $this->kegiatan_model->get_all_pegawai($id_pegawai,$filter);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function biodata_pegawai($id_pegawai)
	{
		if ($this->user_id)
		{
			$this->load->model('kegiatan_model');
			$this->load->model('realisasi_kegiatan_model');
			$this->load->model('pegawai_model');
			$data = array();
			$pegawai = $this->pegawai_model->get($id_pegawai);
			$pendidikan = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
			$pangkat = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
			$jabatan = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
			$unit_kerja = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
			$diklat = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
			$penghargaan = $this->pegawai_model->get_riwayat_penghargaan_by_id($id_pegawai);
			$cuti = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
			$penataran = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
			$seminar = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
			$bahasa = $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
			$bahasa_asing = $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
			$kursus = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
			$penugasan = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
			$hukuman = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
			$pernikahan = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
			$anak = $this->pegawai_model->get_riwayat_anak($id_pegawai);
			$orangtua = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
			$mertua = $this->pegawai_model->get_riwayat_mertua($id_pegawai);
			$data['title']		= "Biodata Pegawai - Admin ";
			$data['content']	= "laporan/biodata_pegawai" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "laporan";
			$data['pegawai'] = $pegawai[0];
			$data['pendidikan']= $pendidikan;
			$data['pangkat']= $pangkat;
			$data['jabatan']= $jabatan;
			$data['unit_kerja']= $unit_kerja;
			$data['diklat']= $diklat;
			$data['penghargaan']= $penghargaan;
			$data['cuti']= $cuti;
			$data['penataran']= $penataran;
			$data['seminar']= $seminar;
			$data['bahasa']= $bahasa;
			$data['bahasa_asing']= $bahasa_asing;
			$data['kursus']= $kursus;
			$data['penugasan']= $penugasan;
			$data['hukuman']= $hukuman;
			$data['pernikahan']= $pernikahan;
			$data['anak']= $anak;
			$data['orangtua']= $orangtua;
			$data['mertua']= $mertua;
			$data['data_by_bkd'] = $this->dm->get_data_bkd($id_pegawai);
			if (empty($data['data_by_bkd'])) {
				show_404();
			}

			if(!empty($_POST)){
				$filter = $_POST;
			}else{
				$filter = '';
			}

			$data['kegiatan']		= $this->kegiatan_model->get_all_pegawai($id_pegawai,$filter);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	function dragscroll()
	{
		$this->load->view('admin/laporan/renja/dragscroll');
	}


}
?>
