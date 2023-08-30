<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pengukuran_kinerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->default_tahun = 2019;
		$this->load->model('visitor_model');
		$this->load->model('berkas_model');
		$this->load->model('berkas_file_model');
		$this->load->model('ref_kategori_berkas_model');
	 	$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_skpd_model');
		$this->load->model('renja_perencanaan_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->helper('file');
		$this->visitor_model->cek_visitor();

		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index($tahun=null,$level=0,$id_induk=null)
	{
		if ($tahun == null) {
			redirect('pengukuran_kinerja/index/'.$this->default_tahun);
		}
		$valid_tahun = [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
		if (!in_array($tahun, $valid_tahun)) {
			$tahun = $this->default_tahun;
		}
		$data['title'] = "Pengukuran Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="pengukuran_kinerja";
		$data['level'] = $level;
		$data['id_induk'] = $id_induk;
		$data['list'] = $this->ref_skpd_model->get_multiple_jenis(array('skpd','kecamatan'));
		$tahun = (empty($tahun)) ? $this->default_tahun : $tahun;

		$this->load->model('berkas_unit_kerja_model');
		$data['tahun'] = $this->berkas_unit_kerja_model->get_tahun();
		$data['tahun_'] = $tahun;

		// if($level<=1){
		// 	$this->ref_unit_kerja_model->level_unit_kerja = array(-1,0);
		// 	$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_level($tahun);
		// }else{
		// 	$this->ref_unit_kerja_model->id_induk = $id_induk;
		// 	$data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_parent($tahun);
		// }
		// if(!empty($_POST['id_unit']) && $_POST['id_unit']!=""){
		// 	$data['id_unit'] = $_POST['id_unit'];
		// 	$data['unit_kerja']= $this->ref_unit_kerja_model->get_result_by_id($_POST['id_unit']);
		// }
		// $data['unitk'] = $this->ref_unit_kerja_model->get_all();

		foreach ($data['list'] as $uk) {
			$jenis = array('ss','sp','sk');

			$data['rencana_kerja'][$tahun] = $this->renja_perencanaan_model->get_rencana_kerja_by_tahun($tahun,$uk->id_skpd);
			$total_capaian = 0;
			$count_total_capaian = 0;
			$total_capaian_ss = 0;
			$count_total_capaian_ss = 0;

			foreach ($jenis as $j) {
				$data['grafik_rencana_kerja_ss'][$tahun] = $this->renja_perencanaan_model->get_grafik_rencana_kerja_by_tahun($j,$tahun,$uk->id_skpd);
				$name = $this->renja_perencanaan_model->name($j);
				$taIkuRenja = $name['taIkuRenja'];
				$rIkuRenja = $name['rIkuRenja'];

				if ($j == "ss") {
					foreach ($data['grafik_rencana_kerja_ss'][$tahun] as $i) {
						$target = $i->$taIkuRenja;
						$realisasi = $i->$rIkuRenja;
						$pola = $i->polorarisasi;
	   					$s_capaian = 'capaian_'.$tahun;
						$capaian = $i->capaian;
						$total_capaian_ss += $capaian;
						$count_total_capaian_ss++;
					}
				} else {
					foreach ($data['grafik_rencana_kerja_ss'][$tahun] as $i) {
						$target = $i->$taIkuRenja;
						$realisasi = $i->$rIkuRenja;
						$pola = $i->polorarisasi;
	   					$s_capaian = 'capaian_'.$tahun;
						$capaian = $i->capaian;
						$total_capaian += $capaian;
						$count_total_capaian++;
					}
				}
			}

			$data['grafik_capaian_ss'][$uk->id_skpd] = ($count_total_capaian_ss>0) ? $total_capaian_ss/$count_total_capaian_ss : 0;
			$data['grafik_capaian'][$uk->id_skpd] = ($count_total_capaian>0) ? $total_capaian/$count_total_capaian : 0;
		}

		// print_r($data['grafik_capaian']);die;

		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/pengukuran_kinerja',$data);
		$this->load->view('blog/src/footer',$data);
	}

	public function detail($id_skpd=null,$tahun=null,$iframe=false)
	{
		if ($id_skpd == null || $tahun ==null) {
			redirect('pengukuran_kinerja/index/'.date("Y"));
		}
		$valid_tahun = [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
		if (!in_array($tahun, $valid_tahun)) {
			show_404();
		}
		$data['title'] = "Detail Pengukuran Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="pengukuran_kinerja";
		// $data['level'] = $level;
		// $data['id_induk'] = $id_induk;
		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);

		$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		if(!empty($_POST)){
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				if(!empty($_POST[$name['cIku']])){
					$id = $_POST[$name['cIku']];
					foreach($id as $i){
						$insert = array(
							$name['cIku']  => $i,
							$name['taIkuRenja'] => $_POST[$name['taIkuRenja'].$i],
							$name['aIkuRenja'] =>$_POST[$name['aIkuRenja'].$i],
							'id_unit_kerja' => $_POST['id_unit_kerja'],
							'tahun_renja' => $_POST['tahun_renja']
						);
						$cek_iku = $this->renja_perencanaan_model->cek_iku_renja($j,$i);
						if(!$cek_iku){
							$in = $this->renja_perencanaan_model->insert_iku_renja($j,$insert);
						}
					}
				}
			}
		}

		$data['tahun'] = $tahun;
		$data['id_skpd'] = $id_skpd;
		$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
		$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
		$data['jumlah_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
		$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);

		$data['jenis'] = $jenis;

		$this->load->view('blog/src/header',$data);
		if($iframe==false) $this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/pengukuran_kinerja_detail2',$data);
		if($iframe==false) $this->load->view('blog/src/footer',$data);
	}

	public function download_file($id_berkas_file){
		$id_berkas_file = explode('_', $id_berkas_file);
		$id_berkas_file = $id_berkas_file[0];
		$this->berkas_file_model->id_berkas_file = $id_berkas_file;
		$data = $this->berkas_file_model->get_by_id();
		$file = urldecode($data->hash_file);
		$filepath = $data->path_file . $file;
		echo $filepath;
		if(file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($data->nama_file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush();
			readfile($filepath);
			exit;
		}
	}

}
?>
