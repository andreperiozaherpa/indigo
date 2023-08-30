<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class evaluasi_capaian extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_rkt_model');
		$this->load->model('ref_unit_kerja_model');

		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','ref_rkt_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rencana Kerja tahunan - Admin ";
			$data['content']	= "evaluasi_capaian/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			if(!empty($_POST)){
				$data['id_unit_penanggungjawab'] = $_POST['id_unit_penanggungjawab'];
				$data['tahun_rkt'] = $_POST['tahun_rkt'];
				$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
				$this->ref_rkt_model->id_unit_penanggungjawab = $_POST['id_unit_penanggungjawab'];
			}
			if($this->user_level=='Administrator'){
				if(!empty($_POST)){
					$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
					$this->ref_rkt_model->id_unit_penanggungjawab = $_POST['id_unit_penanggungjawab'];
				}
			}else{
				$this->ref_rkt_model->id_unit_penanggungjawab = $this->session->userdata('unit_kerja_id');
				//$this->ref_unit_kerja_model->session_unit_kerja_only = true;
				if(!empty($_POST)){
					$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
				}
				$data['unit_kerja'] = $this->ref_unit_kerja_model->getUnit(null,"id_unit_kerja = '".$this->session->userdata('unit_kerja_id')."' OR ket_induk like '%|".$this->session->userdata('unit_kerja_id')."|%'");
				$unitArr = array();
				$unitArr[] = $this->session->userdata('unit_kerja_id');
				foreach ($data['unit_kerja'] as $row) {
					$unitArr[] = $row->id_unit_kerja;
				}
				if($unitArr){
					$sWhere = "id_unit_penanggungjawab in ('".implode("','", $unitArr)."')";
					$this->ref_rkt_model->sWhere = $sWhere;

				}
			}
			
			$data['item'] = $this->ref_rkt_model->get_all();
			$this->load->view('admin/index',$data);

			//echo "<pre>";print_r($this->session->userdata);die;
		}
		else
		{
			redirect('admin');
		}
	}



	public function detail_unitkerja($id_rkt)
	{
		
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if ($this->user_id && $id_rkt!=null)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "evaluasi_capaian/detail_unitkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			if(!empty($_POST)){
				
			}
			$data['rkt'] = $rkt;
			$params = array('id_unit' => $rkt->id_unit_kerja, 'tahun' => $rkt->tahun_rkt);
			if($rkt->level_unit_kerja<=0){
				$data['sasaran'] = $this->sasaran_strategis_model->getData($params,$id_rkt);
				$data['kode_sasaran'] = "kode_sasaran_strategis";
				$data['nama_sasaran'] = "sasaran_strategis";
				$data['id_sasaran'] = "id_sasaran_strategis";
				$data['_type'] = "SS";
			}
			else if($rkt->level_unit_kerja==1){
				$data['sasaran'] = $this->sasaran_program_model->getData($params,$id_rkt);
				$data['kode_sasaran'] = "kode_sasaran_program";
				$data['nama_sasaran'] = "sasaran_program";
				$data['id_sasaran'] = "id_sasaran_program";
				$data['_type'] = "SP";
			}
			else {
				$data['sasaran'] = $this->sasaran_kegiatan_model->getData($params,$id_rkt);
				$data['kode_sasaran'] = "kode_sasaran_kegiatan";
				$data['nama_sasaran'] = "sasaran_kegiatan";
				$data['id_sasaran'] = "id_sasaran_kegiatan";
				$data['_type'] = "SK";
			}
			$data['detail_unit'] = $this->ref_unit_kerja_model->detail_unit($rkt->id_unit_kerja);
			//echo "<pre>";print_r($data['sasaran']);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function update_status($id_unit_kerja)
	{
		if($this->user_id && !empty($_POST) && !empty($_POST['id_capaian_indikator']))
		{
			$this->load->model("pencapaian_model");
			$data = array(
				'status_evaluasi' => $_POST['status_evaluasi'],
			);
			if($_POST['status_evaluasi']==2)
			{
				//$data['status_evaluasi'] = 0; 
				if(!empty($_POST['alasan_penolakan']))
					$data['alasan_penolakan'] = $_POST['alasan_penolakan'];
			}
			//die("here");

			$source = $this->pencapaian_model->getCapaianIndikatorDetail(array('id_capaian_indikator' => $_POST['id_capaian_indikator']));

			$this->load->model('indikator_model');
			$paramsI = array('uid_iku' => $source[0]->uid_iku, 'type' => $_POST['type']);
			$indikator = $this->indikator_model->getIndikator($paramsI);

			$params = array(
		            	'data_indikator_detail'	=> $data,
		            	'id_capaian_indikator'	=> $_POST['id_capaian_indikator'],
		            	'indikator'				=> $indikator,
		            	'type'					=> $_POST['type'],
		            );

		    $this->pencapaian_model->updateAll($params);

			//$this->pencapaian_model->updateCapaianDetail($data,$_POST['id_capaian_indikator']);

			// Kirim Notifikasi
			
			$source2 = $this->pencapaian_model->getSasaranDetail2($source[0]->uid_ss);
			$current_controller = strtolower($this->router->fetch_class());
			$type = explode('-', $source[0]->uid_ss);
			$notifikasi = array(
				'target_notifikasi'	=> "unit_kerja-{$source2->id_unit}",
				'subjek_notifikasi'	=> "Evaluasi Capaian",
				'link_notifikasi'	=> "data_capaian/detail_indikator/{$type[0]}/{$id_unit_kerja}/"
			);
			switch ($data['status_evaluasi']) {
				case 0:
					$notifikasi['pesan_notifikasi'] = "Capaian <b>{$source2->sasaran}</b> tahun <b>{$source[0]->tahun}</b> bulan <b>".bulan($source[0]->bulan)."</b> telah dibatalkan.";
					$notifikasi['status_notifikasi'] = "Dibatalkan";
					break;

				case 1:
					$notifikasi['pesan_notifikasi'] = "Capaian <b>{$source2->sasaran}</b> tahun <b>{$source[0]->tahun}</b> bulan <b>".bulan($source[0]->bulan)."</b> telah disetujui.";
					$notifikasi['status_notifikasi'] = "Disetujui";
					break;

				case 2:
					$notifikasi['pesan_notifikasi'] = "Capaian <b>{$source2->sasaran}</b> tahun <b>{$source[0]->tahun}</b> bulan <b>".bulan($source[0]->bulan)."</b> telah ditolak.";
					$notifikasi['status_notifikasi'] = "Ditolak";
					break;
				
				default:
					$notifikasi['pesan_notifikasi'] = "";
					$notifikasi['status_notifikasi'] = "-";
					break;
			}
			$this->notifikasi_lib->sent_notifikasi($notifikasi);

			echo true;
		}
		else{
			echo "Data tidak valid";
		}
	}
	
}
?>