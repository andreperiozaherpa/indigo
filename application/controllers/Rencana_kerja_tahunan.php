<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana_kerja_tahunan extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_rkt_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_renstra_model');
		$this->load->model('indikator_model');
		$this->load->model('rkt_model');
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
			$data['content']	= "rencana_kerja_tahunan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			//$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$where = ($this->session->userdata('unit_kerja_id')<=0) ? "" : "id_unit_kerja = ".$this->session->userdata('unit_kerja_id')." OR ket_induk like '%|".$this->session->userdata('unit_kerja_id')."|%'";
			
			
			if($this->user_level=='Administrator'){
				if(!empty($_POST)){
					$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
					$this->ref_rkt_model->id_unit_penanggungjawab = $_POST['id_unit_penanggungjawab'];
				}
			}else{
				$this->ref_rkt_model->id_unit_penanggungjawab = $this->session->userdata('unit_kerja_id');
				$this->ref_unit_kerja_model->session_unit_kerja_only = true;
				if(!empty($_POST)){
					$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
				}
			}
			$data['unit_kerja'] = $this->ref_unit_kerja_model->getUnit(null,$where);
			$data['item'] = $this->ref_rkt_model->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add_data()
	{
		if (!$this->input->post('tahun_rkt') OR !$this->input->post('id_unit_penanggungjawab') ) {
			echo FALSE;
		} else {
			
			$data = $_POST;
			$query = $this->ref_rkt_model->insert_data($data);
			//var_dump($data);
			if ($query) {
				echo TRUE;
			}
			else{
				echo "Data sudah ada.";
			}
		}
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rencana Kerja Tahunan - Admin ";
			$data['content']	= "ref_rkt/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			//if(!empty($_POST)){
			//	$this->ref_rkt_m->nama_lokasi = $_POST['nama_lokasi'];
			//	$this->ref_rkt_m->kode_kegiatan = $_POST['kode_kegiatan'];
			//}
			//$data['item'] = $this->ref_rkt_m->get_all();
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_unitkerja($id_rkt)
	{
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		
		if ($this->user_id && $rkt!=null)
		{
			$data['title']		= "Rencana Kerja Tahunan - Admin ";
			$data['content']	= "rencana_kerja_tahunan/detail_unitkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			if(!empty($_POST)){
				// todo
			}
			
			$data['rkt'] = $rkt;

			$this->load->model('pegawai_model');
			$this->load->model('ref_jabatan_model');
			$this->pegawai_model->id_pegawai = $this->session->userdata('id_pegawai');
			$pegawai = $this->pegawai_model->get_by_id();

			$jabatan = $this->ref_jabatan_model->select_by_id(!empty($pegawai) ? $pegawai->id_jabatan : "");
			$data['nama_jabatan'] = $jabatan[0]->nama_jabatan;
			//print_r($data['rkt']->nama_kegiatan);die;
			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

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

			$paramsIn = array(
				'type'			=> $data['_type'],
				'where'			=> array(
					'indikator_turunan.id_unit_kerja' => $rkt->id_unit_kerja,
				),

			);
			$indikator_turunan = $this->indikator_model->getIndikatorTurunan($paramsIn);
			if(!$indikator_turunan){
				$data['message'] = "Tidak ada Cascading ke unit ini.";
				$data['message_type'] = "warning";
			}
			
			$data['detail_unit'] = $this->ref_unit_kerja_model->detail_unit($rkt->id_unit_kerja);

			//echo "<pre>";print_r($paramsIn);die;

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}



	public function add_sasaran($type,$id_rkt)
	{
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		
		if ($this->user_id && $rkt!=null)
		{
			$data['title']		= "Rencana Kerja Tahunan - Admin ";
			$data['content']	= "rencana_kerja_tahunan/add_sasaran" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";
			$data['_type']  = $type;

			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			$validasi = true;

			
			
			if(!empty($_POST)){
				//echo "<pre>";print_r($_POST);die;
				$dataSSA=null;
				$uid_ss = strtoupper(uniqid());
				$metode = "";
				if(!empty($_POST['ss_atasan']) && $_POST['ss_atasan']!=""){
					$expl = explode(",", $_POST['ss_atasan']);
					$id_sasaran_atasan = $expl[0];
					$type_atasan = $expl[1];
					$metode = $expl[2];
					$uid_ss_atasan = $expl[3];

					if($type_atasan=="SS"){
						$dataSSA = $this->sasaran_strategis_model->get_data_by_id($id_sasaran_atasan);
					}
					else if($type_atasan=="SP"){
						$dataSSA = $this->sasaran_program_model->get_data_by_id($id_sasaran_atasan);
					}
					else if($type_atasan=="SK"){
						$dataSSA = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran_atasan);
					}
					$dataSSA_copy = $dataSSA;
					//var_dump($dataSSA[0]->uid_ss);die;
					if($metode!="AL") $dataSSA = null;
				}

				if($_POST['id_ss_induk']=="" || $_POST['id_indikator_induk']==""){
					$validasi = false;
				}

				if($rkt->level_unit_kerja>0 && (empty($_POST['ss_atasan']) ||  $_POST['uid_iku_atasan']=="")){
					$validasi = false;
				}
				if($metode!="AL" && ($_POST['kode_sasaran']=="" || $_POST['nama_sasaran']=="")){
					$validasi = false;
				}
				if($validasi==false)
				{
					$data['message_type'] = "warning";
					$data['message'] = "Data belum lengkap";
					$data = array_merge($data,$_POST);
				}

				if($validasi==true){
					if($rkt->level_unit_kerja<=0){
						$uid_ss = "SS-".$uid_ss;
						$insertData = array(
							'id_misi'					=> 0,
							'kode_sasaran_strategis' 	=> ($dataSSA!=null) ? $dataSSA[0]->kode_sasaran_strategis : $_POST['kode_sasaran'],
							'id_ss_induk' 	=> $_POST['id_ss_induk'],
							'sasaran_strategis'			=> ($dataSSA!=null) ? $dataSSA[0]->sasaran_strategis : $_POST['nama_sasaran'],
							'id_unit'					=> $rkt->id_unit_kerja,
							'deskripsi'					=> ($dataSSA!=null) ? $dataSSA[0]->deskripsi : $_POST['deskripsi_sasaran'],
							'tahun'						=> $rkt->tahun_rkt,
							//'target'					=> $_POST['target'],
							'uid_ss'					=> $uid_ss,
							'id_indikator_induk' 	=> $_POST['id_indikator_induk'],
						);

						$this->sasaran_strategis_model->insert_data($insertData);
						$data['message']		= "Sasaran strategis berhasil ditambahakan.";
					}
					else if($rkt->level_unit_kerja==1){
						$uid_ss = "SP-".$uid_ss;
						$insertData = array(
							'id_sp_induk' 	=> $_POST['id_ss_induk'],
							'id_sasaran_strategis'		=> !empty($id_sasaran_atasan) ? $id_sasaran_atasan : 0,
							'kode_sasaran_program' 		=> ($dataSSA!=null) ? $dataSSA[0]->kode_sasaran_strategis : $_POST['kode_sasaran'],
							'sasaran_program'			=> ($dataSSA!=null) ? $dataSSA[0]->sasaran_strategis : $_POST['nama_sasaran'],
							'id_unit'					=> $rkt->id_unit_kerja,
							'deskripsi'					=> ($dataSSA!=null) ? $dataSSA[0]->deskripsi : $_POST['deskripsi_sasaran'],
							'tahun'						=> $rkt->tahun_rkt,
							//'target'						=> $_POST['target'],
							'uid_ss'					=> $uid_ss,
							'id_indikator_induk' 	=> $_POST['id_indikator_induk'],
							'uid_ss_atasan'				=> !empty($uid_ss_atasan) ? $uid_ss_atasan : null,
							'uid_iku_atasan'			=> (!empty($_POST['uid_iku_atasan'])) ? $_POST['uid_iku_atasan'] : null,
						);
						//var_dump($dataSSA[0]->uid_ss);die;
						$this->sasaran_program_model->insert_data($insertData);
						$data['message']		= "Sasaran program berhasil ditambahakan.";
					}
					else {
						$uid_ss = "SK-".$uid_ss;
						$insertData = array(
							'id_sk_induk' 	=> $_POST['id_ss_induk'],
							'id_sasaran_program'		=> !empty($id_sasaran_atasan) ? $id_sasaran_atasan : 0,
							'kode_sasaran_kegiatan' 	=> ($dataSSA!=null) ? $dataSSA[0]->kode_sasaran_program : $_POST['kode_sasaran'],
							'sasaran_kegiatan'			=> ($dataSSA!=null) ? $dataSSA[0]->sasaran_program : $_POST['nama_sasaran'],
							'id_unit'					=> $rkt->id_unit_kerja,
							'deskripsi'					=> ($dataSSA!=null) ? $dataSSA[0]->deskripsi : $_POST['deskripsi_sasaran'],
							'tahun'						=> $rkt->tahun_rkt,
							//'target'					=> $_POST['target'],
							'uid_ss'					=> $uid_ss,
							'id_indikator_induk' 	=> $_POST['id_indikator_induk'],
							'uid_ss_atasan'				=> !empty($uid_ss_atasan) ? $uid_ss_atasan : null,
							'uid_iku_atasan'			=> (!empty($_POST['uid_iku_atasan'])) ? $_POST['uid_iku_atasan'] : null,
						);

						$this->sasaran_kegiatan_model->insert_data($insertData);
						$data['message']		= "Sasaran kegiatan berhasil ditambahakan.";
					}
					//echo "<pre>";print_r($_POST);die;
					if(!empty($uid_ss_atasan)){
						$updateIKUA = array(
							'uid_ss_bawahan'	=> $uid_ss,
						);
						$whereIKUA = array(
							'uid_ss_atasan'			=> $uid_ss_atasan,
							'id_unit_kerja'			=> $rkt->id_unit_kerja,
							'uid_iku_atasan'		=> $_POST['uid_iku_atasan'],
						);
						$this->indikator_model->updateIndikatorTurunan($whereIKUA,$updateIKUA);
					}

					// set target
					$paramTarget = array(
						'id_rkt'	=> $rkt->id_rkt,
						'uid_ss'	=> $uid_ss,
						//'target'	=> $_POST['target'],
					);
					if($dataSSA!=null)
					{
						$Dtarget = $this->rkt_model->getTarget(array('id_rkt' => $rkt->id_rkt , 'uid_ss' => $dataSSA[0]->uid_ss));
						if(!empty($Dtarget)){
							$paramTarget['target'] = $Dtarget[0]->target;
						}
						else{
							$paramTarget['target'] = 0;
						}
					}
					else{
						$paramTarget['target'] = $_POST['target'];
					}
					//var_dump($paramTarget);die;
					$this->rkt_model->setTargetSS($paramTarget);
					//var_dump($s);die;
					// set bobot
					$paramBobot = array(
						'id_rkt'	=> $rkt->id_rkt,
						'uid_ss'	=> $uid_ss,
						'bobot'		=> 0,
					);
					$this->rkt_model->setBobotSS($paramBobot);

					// set capaian
					$this->load->model('pencapaian_model');
					$dataCapaianSS = array(
						'id_rkt'	=> $rkt->id_rkt,
						'uid_ss'	=> $uid_ss,
						'target'	=> $paramTarget['target'],
					);
					$this->pencapaian_model->insertSasaran($dataCapaianSS);


					$data['message_type'] = "success";
				}
				
			}
			$data['renstra'] = $this->ref_renstra_model->get_all_data();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_induk($rkt->id_unit_kerja);

			$data['rkt'] = $rkt;
			$GLOBALVAR = GLOBALVAR;
			$data['metode_penurunanArr'] = $GLOBALVAR['metode_penurunan'];

			$params = array(
				'type'			=> $type,
				'where'			=> array(
					'indikator_turunan.id_unit_kerja' => $rkt->id_unit_kerja,
					// 'indikator_turunan.uid_ss_bawahan' => null,
				),
			);
			$ss_atasan = $this->indikator_model->getIndikatorTurunan($params);
			$uniq_uid_ss_atasan = array();
			$key = 0;
			//echo "<pre>";print_r($ss_atasan);die;
			foreach ($ss_atasan as $row) {
				if(!in_array($row->uid_ss_atasan, $uniq_uid_ss_atasan)){
					$key++;
					$uniq_uid_ss_atasan[] = $row->uid_ss_atasan;
				}
				else{
					unset($ss_atasan[$key]);
				}
			}
			//echo "<pre>";print_r($data);die;
			//echo "<pre>";print_r($uniq_uid_ss_atasan);
			//echo "<pre>";print_r($data['ss_atasan']);die;
			$data['ss_atasanArr'] = $ss_atasan;
			$this->load->model('ref_visi_misi_model');
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();

			/*
			$unit_induk = $rkt->id_induk;
			if($rkt->level_unit_kerja==0){

			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk($this->session->userdata('unit_kerja_id'));
			}else{

			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk($unit_induk);
			}
			if($rkt->level_unit_kerja==1){
				//$ket_induk = explode("|", $rkt->ket_induk);
				//$unit_induk = $ket_induk[2];
				//var_dump($ket_induk);die;
				$data['sasaran_program'] = $this->sasaran_program_model->getSpInduk($this->session->userdata('unit_kerja_id'));
			}else{
				$data['sasaran_program'] = $this->sasaran_program_model->getSpInduk($unit_induk);
			}
			*/
			$data['kode_sasaran'] = $this->get_kode("{$type}-{$rkt->kode_unit_kerja}.", $type);
			
			$unit_induk = $rkt->id_unit_penanggungjawab;
			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk($unit_induk);
			$data['sasaran_program'] = $this->sasaran_program_model->getSpInduk($unit_induk);
			$data['sasaran_kegiatan'] = $this->sasaran_kegiatan_model->getSkInduk($unit_induk);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function get_kode($cek, $type)
	{
		$kode = (isset($_POST['kode'])) ? $_POST['kode'] : $cek;
		$i=1;
		while ($i) {
			$new_kode = $kode.str_pad($i, 3, '0', STR_PAD_LEFT); 
			switch ($type) {
				case 'SS':
					$query = $this->sasaran_strategis_model->cek_kode($new_kode);
					break;
				case 'SP':
					$query = $this->sasaran_program_model->cek_kode($new_kode);
					break;
				case 'SK':
					$query = $this->sasaran_kegiatan_model->cek_kode($new_kode);
					break;
				
				default:
					$query = 0;
					break;
			}
			
			if ($query==0) {
				break;
			}
			$i++;
		}
		return $new_kode;
	}

	public function get_kode_indikator($cek, $type)
	{
		$kode = (isset($_POST['kode'])) ? $_POST['kode'] : $cek;
		$i=1;
		while ($i) {
			$new_kode = $kode.str_pad($i, 3, '0', STR_PAD_LEFT); 
			switch ($type) {
				case 'SS':
					$query = $this->sasaran_strategis_model->cek_kode_indikator($new_kode);
					break;
				case 'SP':
					$query = $this->sasaran_program_model->cek_kode_indikator($new_kode);
					break;
				case 'SK':
					$query = $this->sasaran_kegiatan_model->cek_kode_indikator($new_kode);
					break;
				
				default:
					$query = 0;
					break;
			}
			
			if ($query==0) {
				break;
			}
			$i++;
		}
		return $new_kode;
	}

	public function edit_sasaran($type, $id_rkt, $id_sasaran)
	{
		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');

		if($type=="SS"){
			$editdata = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_strategis;
			$data['nama_sasaran'] = $editdata[0]->sasaran_strategis;
			$id_ss_induk = $editdata[0]->id_ss_induk;
		}
		else if($type=="SP"){
			$editdata = $this->sasaran_program_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_program;
			$data['nama_sasaran'] = $editdata[0]->sasaran_program;
			$id_ss_induk = $editdata[0]->id_sp_induk;
		}
		else if($type=="SK"){
			$editdata = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_kegiatan;
			$data['nama_sasaran'] = $editdata[0]->sasaran_kegiatan;
			$id_ss_induk = $editdata[0]->id_sk_induk;
		}
		else{
			$editdata = null;
		}
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if ($this->user_id && $editdata!=null && $rkt!=null)
		{
			$data['title']		= "Rencana Kerja Tahunan - Admin ";
			$data['content']	= "rencana_kerja_tahunan/edit_sasaran" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$this->load->model('sasaran_strategis_model');
			$this->load->model('sasaran_program_model');
			$this->load->model('sasaran_kegiatan_model');

			if(!empty($_POST)){
				$dataSSA=null;
				if(!empty($_POST['ss_atasan']) && $_POST['ss_atasan']!=""){
					$expl = explode("-", $_POST['ss_atasan']);
					$id_sasaran_atasan = $expl[0];
					$type_atasan = $expl[1];
					$metode = $expl[2];
					
					if($type_atasan=="SS"){
						$dataSSA = $this->sasaran_strategis_model->get_data_by_id($id_sasaran_atasan);
					}
					else if($type_atasan=="SP"){
						$dataSSA = $this->sasaran_program_model->get_data_by_id($id_sasaran_atasan);
					}
					else if($type_atasan=="SK"){
						$dataSSA = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran_atasan);
					}
					
					$updateIKUA = array(
						'uid_ss_bawahan'	=> $editdata[0]->uid_ss,
					);
					$whereIKUA = array(
						'uid_ss_atasan'			=> $dataSSA[0]->uid_ss,
						'id_unit_kerja'			=> $editdata[0]->id_unit_kerja,
					);
					$this->indikator_model->updateIndikatorTurunan($whereIKUA,$updateIKUA);

					if($metode!="AL") $dataSSA = null;
				}
				//var_dump($dataSSA[0]);die; 
				if($editdata[0]->level_unit_kerja<=0){
					$insertData = array(
						//'id_misi'					=> $_POST['id_misi'],
//						'id_ss_induk'					=> !empty($_POST['id_ss_induk']) ? $_POST['id_ss_induk'] : null,
//						'kode_sasaran_strategis' 	=> $_POST['kode_sasaran'],
						'sasaran_strategis'			=> $_POST['nama_sasaran'],
						//'id_unit'					=> $editdata[0]->id_unit_kerja,
						'deskripsi'					=> $_POST['deskripsi_sasaran'],
						//'tahun'						=> $_POST['tahun_rkt'],
						//'target'						=> $_POST['target']
					);
					$this->sasaran_strategis_model->update_data($insertData,$id_sasaran);
					$data['message']		= "Sasaran strategis berhasil diubah.";
				}
				else if($editdata[0]->level_unit_kerja==1){
					$insertData = array(
//						'id_sasaran_strategis'		=> $_POST['id_sasaran_strategis'],
//						'id_sp_induk'					=> !empty($_POST['id_sp_induk']) ? $_POST['id_sp_induk'] : null,
						'kode_sasaran_program' 		=> ($dataSSA!=null) ? $dataSSA[0]->kode_sasaran_strategis : $_POST['kode_sasaran'],
						'sasaran_program'			=> ($dataSSA!=null) ? $dataSSA[0]->sasaran_strategis : $_POST['nama_sasaran'],
						//'id_unit'					=> $editdata[0]->id_unit_kerja,
						'deskripsi'					=> ($dataSSA!=null) ? $dataSSA[0]->deskripsi : $_POST['deskripsi_sasaran'],
						//'tahun'						=> $_POST['tahun_rkt'],
						//'target'						=> $_POST['target']
					);
					$this->sasaran_program_model->update_data($insertData,$id_sasaran);
					$data['message']		= "Sasaran program berhasil diubah.";
				}
				else {
					$insertData = array(
//						'id_sasaran_program'		=> $_POST['id_sasaran_program'],
//						'id_sk_induk'					=> !empty($_POST['id_sk_induk']) ? $_POST['id_sk_induk'] : null,
						'kode_sasaran_kegiatan' 	=> ($dataSSA!=null) ? $dataSSA[0]->kode_sasaran_program : $_POST['kode_sasaran'],
						'sasaran_kegiatan'			=> ($dataSSA!=null) ? $dataSSA[0]->sasaran_program : $_POST['nama_sasaran'],
						//'id_unit'					=> $editdata[0]->id_unit_kerja,
						'deskripsi'					=> ($dataSSA!=null) ? $dataSSA[0]->deskripsi : $_POST['deskripsi_sasaran'],
						//'tahun'						=> $_POST['tahun_rkt'],
						//'target'						=> $_POST['target']
					);
					$this->sasaran_kegiatan_model->update_data($insertData,$id_sasaran);


					//var_dump($id_sasaran);die;
					$data['message']		= "Sasaran kegiatan berhasil diubah.";
				}
				//echo "<pre>";print_r($editdata);die;

				
				// set target
				$paramTarget = array(
					'id_rkt'	=> $id_rkt,
					'uid_ss'	=> $editdata[0]->uid_ss,
					//'target'	=> $_POST['target'],
				);
				if($dataSSA!=null)
				{
					$Dtarget = $this->rkt_model->getTarget(array('id_rkt' => $id_rkt , 'uid_ss' => $dataSSA[0]->uid_ss));
					if(!empty($Dtarget)){
						$paramTarget['target'] = $Dtarget[0]->target;
					}
					else{
						$paramTarget['target'] = 0;
					}
				}
				else{
					$paramTarget['target'] = $_POST['target'];
				}

				$this->rkt_model->setTargetSS($paramTarget);

				
				


				$data['message_type'] = "success";
				if($type=="SS"){
					$editdata = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_strategis;
					$data['nama_sasaran'] = $editdata[0]->sasaran_strategis;
				}
				else if($type=="SP"){
					$editdata = $this->sasaran_program_model->get_data_by_id($id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_program;
					$data['nama_sasaran'] = $editdata[0]->sasaran_program;
				}
				else if($type=="SK"){
					$editdata = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
					$data['kode_sasaran'] = $editdata[0]->kode_sasaran_kegiatan;
					$data['nama_sasaran'] = $editdata[0]->sasaran_kegiatan;
				}
				//var_dump($editdata);die;
			}
			
			$params = array(
				'type'			=> $type,
				'where'			=> array(
					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_ss_bawahan' => null,
				),
			);
			$data['ss_atasan'] = $this->indikator_model->getIndikatorTurunan($params);
			
			$this->load->model('ref_visi_misi_model');
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();

			
			//$unit_induk = $editdata[0]->id_induk;
			// $data['sasaran_strategis'] = $this->sasaran_strategis_model->getByUnit($unit_induk);
			// if($editdata[0]->level_unit_kerja>2){
			// 	//$ket_induk = explode("|", $editdata[0]->ket_induk);
			// 	//var_dump($ket_induk);die;
			// 	//$unit_induk = $ket_induk[2];
				
			// 	$data['sasaran_program'] = $this->sasaran_program_model->getByUnit($unit_induk);
			// }

			//$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk($this->session->userdata('unit_kerja_id'));
			//$data['sasaran_program'] = $this->sasaran_program_model->getSpInduk($this->session->userdata('unit_kerja_id'));
			//$data['sasaran_kegiatan'] = $this->sasaran_kegiatan_model->getSkInduk($this->session->userdata('unit_kerja_id'));


			$params2 = array(
				'type' => $type,
				'id_sasaran' => $id_ss_induk,
			);
			$data['indikator_induk'] = $this->indikator_model->getIndikator($params2);

			$unit_induk = $rkt->id_unit_penanggungjawab;
			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk($unit_induk);
			$data['sasaran_program'] = $this->sasaran_program_model->getSpInduk($unit_induk);
			$data['sasaran_kegiatan'] = $this->sasaran_kegiatan_model->getSkInduk($unit_induk);

			$data['editdata'] = $editdata;
			$data['id_rkt'] = $id_rkt;
			$data['_type'] = $type;
			

			$paramTarget2 = array(
				'id_rkt' 	=> $id_rkt,
				'uid_ss'	=> $editdata[0]->uid_ss,
			);
			$data['target'] = $this->rkt_model->getTarget($paramTarget2);
			//echo "<pre>";print_r($params2);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_sasaran($type, $id_rkt, $id_sasaran)
	{
		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');
		$this->load->model('indikator_model');

		if($type=="SS"){
			$editdata = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_strategis;
			$data['nama_sasaran'] = $editdata[0]->sasaran_strategis;
		}
		else if($type=="SP"){
			$editdata = $this->sasaran_program_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_program;
			$data['nama_sasaran'] = $editdata[0]->sasaran_program;
		}
		else if($type=="SK"){
			$editdata = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
			$data['kode_sasaran'] = $editdata[0]->kode_sasaran_kegiatan;
			$data['nama_sasaran'] = $editdata[0]->sasaran_kegiatan;
		}
		else{
			$editdata = null;
		}
		
		if ($this->user_id && $editdata!=null)
		{
			$data['title']		= "Rencana Kerja Tahunan - Admin ";
			$data['content']	= "rencana_kerja_tahunan/detail_sasaran" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

	
			
			$data['ss_atasan'] = $this->indikator_model->getFreeSSAtasan($editdata[0]->id_unit_kerja,$editdata[0]->level_unit_kerja);
			
			$this->load->model('ref_visi_misi_model');
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();

			
			$unit_induk = $editdata[0]->id_induk;
			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getByUnit($unit_induk);
			if($editdata[0]->level_unit_kerja>2){
				$ket_induk = explode("|", $editdata[0]->ket_induk);
				//var_dump($ket_induk);die;
				$unit_induk = $ket_induk[2];
				
				$data['sasaran_program'] = $this->sasaran_program_model->getByUnit($unit_induk);
			}

			$data['editdata'] = $editdata;
			$data['id_rkt'] = $id_rkt;
			$data['_type'] = $type;
			$data['id_sasaran'] = $id_sasaran;

			$params = array(
				'id_unit'	=> $editdata[0]->id_unit_kerja,
				'type'		=> $type,
				'id_sasaran' => $id_sasaran
			);
			
			
			$data['indikator'] = $this->indikator_model->getIndikator($params);
			//echo "<pre>";print_r($data['indikator']);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function hapus_indikator($type,$id_rkt,$id_sasaran,$id_indikator)
	{
		if($this->user_id){
			$this->load->model('indikator_model');
			$this->load->model('pencapaian_model');

			$indikator = $this->indikator_model->getIndikator(array('id_indikator'=>$id_indikator, 'type' => $type));
			if($indikator!=null){
				$uid_iku = $indikator[0]->uid_iku;
				$this->indikator_model->deleteIndikatorTurunan($uid_iku);
				$this->pencapaian_model->deleteDetail($uid_iku);
				$this->pencapaian_model->deleteIndikator($uid_iku);

				$params = array(
		            	'data_indikator_detail'	=> null,
		            	'id_capaian_indikator'	=> null,
		            	'indikator'				=> $indikator,
		            	'type'					=> $type,
		            );

		        $this->pencapaian_model->updateAll($params);
			}

			//var_dump($type);
			$this->indikator_model->hapus($id_indikator,$type);
			//var_dump($type);
			//echo "<script>alert('indikator berhasil dihapus');</script>";
			redirect(base_url().'/rencana_kerja_tahunan/detail_sasaran/'.$type.'/'.$id_rkt.'/'.$id_sasaran);
		}
	}



	public function add_indikator($type,$id_rkt,$id_sasaran)
	{

		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);

		if($type=="SS"){
			$this->load->model('sasaran_strategis_model');
			$ss = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
			$tks = "kode_sasaran_strategis";
		}
		else if($type=="SP"){
			$this->load->model('sasaran_program_model');
			$ss = $this->sasaran_program_model->get_data_by_id($id_sasaran);
			$tks = "kode_sasaran_program";
		}
		else if($type=="SK"){
			$this->load->model('sasaran_kegiatan_model');
			$ss = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
			$tks = "kode_sasaran_kegiatan";
		}
		if ($this->user_id && $rkt!=null)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/add_indikator" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";
			$this->load->model('indikator_model');
			

			if(!empty($_POST)){
				$params = array();
				$adobe_langsung = false;
				if(!empty($_POST['iku_atasan']) && $_POST['iku_atasan']!=""){
					$paramIKU = array('type'=>$type,'uid_iku' => $_POST['iku_atasan']);
					$IKUA = $this->indikator_model->getIndikator($paramIKU);
					if(!empty($IKUA) && $IKUA[0]->metode_penurunan=="AL"){
						$adobe_langsung = true;
						
						$params['metode_penurunan'] = "TD";
						$params['kode_indikator'] = $IKUA[0]->kode_indikator;
						$params['nama_indikator'] = $IKUA[0]->nama_indikator;
						$params['deskripsi'] = $IKUA[0]->deskripsi;
						$params['id_satuan'] = $IKUA[0]->id_satuan;
						$params['frekuensi'] = $IKUA[0]->frekuensi;
						$params['perhitungan'] = $IKUA[0]->perhitungan;
						$params['cara_perhitungan'] = $IKUA[0]->cara_perhitungan;
						$params['polaritas'] = $IKUA[0]->polaritas;

						$params['target'] = $IKUA[0]->target;
						

					}
					//echo "<pre>";print_r($params);die;
				}

				if($adobe_langsung==false){
					$params = array( 
						'id_sasaran'			=> $id_sasaran,
						'kode_indikator'		=> $_POST['kode_indikator'],
						'nama_indikator'		=> $_POST['nama_indikator'],
						'deskripsi'				=> $_POST['deskripsi'],
						'id_satuan'				=> $_POST['id_satuan'],
						'frekuensi'				=> $_POST['frekuensi'],
						'perhitungan'			=> $_POST['perhitungan'],
						'cara_perhitungan'		=> $_POST['cara_perhitungan'],
						'polaritas'				=> $_POST['polaritas'],
						'metode_penurunan'		=> $_POST['metode_penurunan'],
						'target'		=> $_POST['target'],

					);
				}

				//var_dump(count($_POST['unit_kerja_bawah']));die;
				if($params['kode_indikator']=="" || $params['nama_indikator']=="" || $params['id_satuan']==""){
					$data['message_type'] = "warning";
					$data['message'] = "Data belum lengkap";
					$data = array_merge($data,$_POST);
				}
				else{
					$cek = true;

					if($type=="SS"){
						$this->load->model('sasaran_strategis_model');
						$dtSasaran = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
						$table = "sasaran_strategis_indikator";
						$new_uid = uniqid("ISS-");
					}
					else if($type=="SP"){
						$this->load->model('sasaran_program_model');
						$dtSasaran = $this->sasaran_program_model->get_data_by_id($id_sasaran);
						$table = "sasaran_program_indikator";
						$new_uid = uniqid("ISP-");
					}
					else if($type=="SK"){
						$this->load->model('sasaran_kegiatan_model');
						$dtSasaran = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
						$table = "sasaran_kegiatan_indikator";
						$new_uid = uniqid("ISK-");
					}
					if(empty($dtSasaran)){
						$cek = false;
					}

					if(!empty($_POST['unit_kerja_bawah']) && $params['metode_penurunan']=="AL" && count($_POST['unit_kerja_bawah']) >1 && $params['perhitungan']=="SP")
					{
						$cek = false;
						$error = "Perhitungan keatasan sama percis tidak bisa diturunkan ke lebih dari 1 unit kerja";
					}
					if($cek){
						$params['uid_iku'] = strtoupper($new_uid);
						$params['status'] = "Y";
						$params['formula'] = (is_numeric($params['target'])) ? "A" : "M"; 
						if($type=="SS"){
							$status = $this->sasaran_strategis_model->insert_indikator($params);
							// print_r($params);die;
						}elseif($type=="SP"){
							$status = $this->sasaran_program_model->insert_indikator($params);
						}elseif($type=="SK"){
							$status = $this->sasaran_kegiatan_model->insert_indikator($params);
						}
						if($params['metode_penurunan']!='TD'){
							if(!empty($_POST['unit_kerja_bawah'])){
								$params_copy = $params;
								foreach ($_POST['unit_kerja_bawah'] as $val) {
									$paramIT = array(
										'uid_ss_atasan'			=> $dtSasaran[0]->uid_ss,
										'uid_iku_atasan'		=> $params['uid_iku'],
										'id_unit_kerja'			=> $val,
										'metode'				=> $params['metode_penurunan'],
									);
									$this->indikator_model->insert_data_turunan($paramIT);


								}
							}
							
						}
						if(!empty($_POST['iku_atasan']) && $_POST['iku_atasan']!=""){
							$whereIKUA = array(
								'id_unit_kerja'		=> $rkt->id_unit_kerja,
								'uid_iku_bawahan'	=> null,
								'uid_iku_atasan'	=> $_POST['iku_atasan'],
							);
							$updateIKUA = array('uid_iku_bawahan' => $params['uid_iku']);
							$this->indikator_model->updateIndikatorTurunan($whereIKUA,$updateIKUA);
						}

						$this->load->model('pencapaian_model');
						$paramCapaian = array(
							'id_unit'		=> $rkt->id_unit_kerja,
							'id_rkt'		=> $id_rkt,
							'tahun'			=> $rkt->tahun_rkt,
							'uid_iku'		=> $params['uid_iku'],
							'target'		=> $params['target'],
						);
						$this->pencapaian_model->insertIndikator($paramCapaian);

						$data['message_type'] = "success";
						$data['message']		= "Indikator berhasil ditambahakan.";
					}
					else{
						$data['message_type'] = "warning";
						$data['message'] = !empty($error) ? $error : "Error. Data tidak valid.";
						$data = array_merge($data,$_POST);
					}
				}
			}
			
			$paramInd = array(
				
				'type'				=> $type,
				'where'				=> array(
					'indikator_turunan.id_unit_kerja'		=> $rkt->id_unit_kerja,
					'indikator_turunan.uid_iku_bawahan'	=> null,
					'indikator_turunan.uid_ss_bawahan'	=> $ss[0]->uid_ss,
				),
			);
			//$stringParam = "metode != 'AL'";
			$data['id_rkt'] = $id_rkt;
			$data['_type'] = $type;
			$data['id_sasaran'] = $id_sasaran;
			$data['indikator_atasan'] = $this->indikator_model->getIndikatorTurunan($paramInd);

			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['GLOBALVAR'] = GLOBALVAR;
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_induk();

			$data['new_kode_indikator'] = $this->get_kode_indikator("I{$ss[0]->$tks}.", $type);
			//echo "<pre>";print_r($data['indikator_atasan']);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}



	public function detail_indikator($type, $id_rkt, $id_indikator)
	{
		$this->load->model('indikator_model');
		
		
		$params = array(
			'type' => $type,
			'id_indikator' => $id_indikator
		);
		$detail = $this->indikator_model->getIndikator($params);
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if ($this->user_id && $detail!=null && $rkt!=null)
		{
			$this->load->model('renaksi_model');
			$paramR = array('uid_iku' => $detail[0]->uid_iku);
			$data['dRenaksi'] = $this->renaksi_model->get($paramR);
			$id_renaksi = (!empty($data['dRenaksi'])) ?  $data['dRenaksi'][0]->id_renaksi : null;
			$data['dRenaksiDetail'] = $this->renaksi_model->getDetail(array('pencapaian_indikator_detail.id_renaksi' => $id_renaksi));

			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/detail_indikator" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['_type'] = $type;
			$data['id_rkt'] = $id_rkt;
			$data['detail'] = $detail;
			$data['GLOBALVAR'] = GLOBALVAR;
			$params2 = array(
				'type'	=> $type,
				'where'	=> array(
					'indikator_turunan.uid_iku_bawahan' => $detail[0]->uid_iku,
				)
			);

			$data['indikator_atasan'] = $this->indikator_model->getIndikatorTurunan($params2);

			$params3 = array(
				'type'	=> $type,
				'where'	=> array(
					'indikator_turunan.uid_iku_atasan' => $detail[0]->uid_iku,
				)
			);
			$data['indikator_bawahan'] = $this->indikator_model->getIndikatorTurunan($params3);
			$data['id_indikator'] = $id_indikator;
			$this->load->view('admin/index',$data);

			//echo "<pre>";print_r($data);die;
		}
		else
		{
			redirect('admin');
		}
	}


	public function add_renaksi($type,$id_rkt,$id_indikator)
	{
		$this->load->model('indikator_model');
		$this->load->model('renaksi_model');
		$this->load->model('pencapaian_model');
		//$id_renaksi = $this->renaksi_model->getLastId();
		//var_dump($id_renaksi);die;
		$params = array(
			'type'	=> $type,
			'id_indikator' => $id_indikator
		);
		$indikator = $this->indikator_model->getIndikator($params);
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if ($this->user_id && $indikator!=null && $rkt!=null)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/add_renaksi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			if(!empty($_POST)){
				//echo "<pre>";print_r($_POST);die;
				$GLOBALVAR = GLOBALVAR;
				$validasi = true;
				if ($indikator[0]->formula=="A")
				{
					$total_target = 0;
					foreach ($GLOBALVAR['bulan'] as $key => $value) {
						$total_target += $_POST['target'][$key];
					}
					if($total_target!=$indikator[0]->target)
					{
						$validasi = false;
						$data['message'] = "Gagal disimpan. Total target perbulan tidak sesuai dengan target 1 tahun : ".$indikator[0]->target;
						$data['message_type'] = "danger";
					}
				}
				if($validasi==true){
					$renaksi = array(
						'uid_iku'		=> $indikator[0]->uid_iku,
						//'output'		=> $_POST['output'],
						//'komponen'		=> $_POST['komponen'],
						//'sub_komponen'	=> $_POST['sub_komponen'],
						//'jumlah_pagu'	=> $_POST['jumlah_pagu'],
						'keterangan'	=> $_POST['keterangan'],
						'id_satuan'		=> $_POST['id_satuan'],
					);
					$this->renaksi_model->insert_renaksi($renaksi);
					$id_renaksi = $this->renaksi_model->getLastId();
					
					foreach ($GLOBALVAR['bulan'] as $key => $value) {
						$dijadwalkan = (in_array($key, $_POST['bulan'])) ? 1 : 0;
						$target = $_POST['target'][$key];
						/*
						$renaksi_detail = array(
							'id_renaksi'	=> $id_renaksi,
							'bulan'			=> $key,
							'tahun'			=> $rkt->tahun_rkt,
							'target'		=> $target,
							'realisasi'		=> $realisasi,
						);
						$this->renaksi_model->insert_renaksi_detail($renaksi_detail);
						*/
						$pencapaian_detail = array(
							'id_unit'		=> $rkt->id_unit_kerja,
							'id_renaksi'	=> $id_renaksi,
							'uid_ss'		=> $indikator[0]->uid_ss,
							'uid_iku'		=> $indikator[0]->uid_iku,
							'bulan'			=> $key,
							'tahun'			=> $rkt->tahun_rkt,
							'target'		=> $target,
							'dijadwalkan'	=> $dijadwalkan,
						);
						$this->pencapaian_model->insertDetail($pencapaian_detail);
					}
					
					$data['message_type'] = "success";
					$data['message']		= "Renaksi berhasil ditambahakan.";
				}
			}
			$data['id_rkt'] = $id_rkt;
			$data['rkt'] = $rkt;
			$data['indikator'] = $indikator;
			$data['id_indikator'] = $id_indikator;
			$data['_type'] = $type;
			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();

			$data['GLOBALVAR'] = GLOBALVAR;

			$paramR = array('uid_iku' => $indikator[0]->uid_iku);
			$dRenaksi = $this->renaksi_model->get($paramR);
			if($dRenaksi)
			{
				redirect('rencana_kerja_tahunan/detail_indikator/'.$type.'/'.$id_rkt.'/'.$id_indikator);
			}
			
			//echo "<pre>";print_r($indikator);die;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function pembobotan($type, $id_rkt)
	{
		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);

		$this->load->model('ref_jabatan_model');

			
		
		if ($this->user_id && $rkt!=null && !empty($id_rkt))
		{

						$jabatan = $this->ref_jabatan_model->select_by_id(!empty($pegawai) ? $pegawai->id_jabatan : "");
			$data['nama_jabatan'] = $jabatan[0]->nama_jabatan;

			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/pembobotan" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";



			$params = array(
				'id_unit' 	=> $rkt->id_unit_kerja,
				'tahun'		=> $rkt->tahun_rkt,
			);

			if(!empty($_POST)){
				//echo "<pre>"; print_r($_POST);die;
				$bobot = $_POST['bobot'];
				// validasi total
				$total = 0;
				foreach ($bobot as $key => $value) {
					$total = $total + $value;
				}
				if ($total<=100){
					foreach ($bobot as $id => $value) {
						$bobotData = array('bobot' => $value);
						if($rkt->level_unit_kerja<=0){
							$dataSS = $this->sasaran_strategis_model->get_data_by_id($id);
						}
						else if($rkt->level_unit_kerja==1){
							$dataSS = $this->sasaran_program_model->get_data_by_id($id);
						}
						else{
							$dataSS = $this->sasaran_kegiatan_model->get_data_by_id($id);
						}
						if($dataSS){
							$paramBobot = array(
								'id_rkt'	=> $id_rkt,
								'uid_ss'	=> $dataSS[0]->uid_ss,
								'bobot'		=> $value,
							);
							$this->rkt_model->setBobotSS($paramBobot);
						}
					}
					
					$data['message_type'] = "success";
					$data['message']		= "Pembobotan berhasil dilakukan.";
				}
				else{
					$data['message_type'] = "warning";
					$data['message']		= "Total bobot tidak boleh lebih dari 100%.";
				}
			}
			

			if($rkt->level_unit_kerja<=0){
				$sasaran = $this->sasaran_strategis_model->getData($params,$id_rkt);
			}
			else if($rkt->level_unit_kerja==1){
				$sasaran = $this->sasaran_program_model->getData($params,$id_rkt);
			}
			else{

				$sasaran = $this->sasaran_kegiatan_model->getData($params,$id_rkt);
				
			}
			//var_dump($params);die;
			$data['sasaran'] = $sasaran;
			$data['rkt'] = $rkt;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function pembobotan_iku($type, $id_rkt, $id_sasaran)
	{
		$this->load->model('indikator_model');
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		
		if ($this->user_id && $rkt!=null)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/pembobotan_iku" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$params = array(
				'type' 			=> $type,
				'id_sasaran'	=> $id_sasaran,
			);


			if(!empty($_POST)){
				//echo "<pre>"; print_r($_POST);die;
				$bobot = $_POST['bobot'];
				// validasi total
				$total = 0;
				foreach ($bobot as $key => $value) {
					$total = $total + $value;
				}
				if ($total<=100){
					foreach ($bobot as $id => $value) {
						$bobotData = array('bobot' => $value);
						$this->indikator_model->update($bobotData,$id,$type);
					}
					
					$data['message_type'] = "success";
					$data['message']		= "Pembobotan berhasil dilakukan.";
				}
				else{
					$data['message_type'] = "warning";
					$data['message']		= "Total bobot tidak boleh lebih dari 100%.";
				}
			}
			

			
			//var_dump($params);die;
			$data['indikator'] = $this->indikator_model->getIndikator($params);
			$data['rkt'] = $rkt;
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function cetak_ss($id_rkt)
	{
		if ($this->user_id)
		{
		$this->load->model('sasaran_strategis_model');
		$this->load->model('sasaran_program_model');
		$this->load->model('sasaran_kegiatan_model');
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "rencana_kerja_tahunan/cetak_ss" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";
			$data['renstra'] = $this->ref_renstra_model->get_all_data();
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['detail'] = $this->ref_rkt_model->select_by_id($id_rkt);


			$params = array(
				'id_unit' 	=> $data['detail']->id_unit_kerja,
				'tahun'		=> $data['detail']->tahun_rkt,
			);

			if($data['detail']->level_unit_kerja<=0){
				$data['sasaran'] = $this->sasaran_strategis_model->getData($params);
				$data['n'] = 'sasaran_strategis';
				$data['j'] = 'Sasaran Strategis';
				$data['type'] = 'SS';
			}elseif($data['detail']->level_unit_kerja==1){
				$data['sasaran'] = $this->sasaran_program_model->getData($params);
				$data['n'] = 'sasaran_program';
				$data['j'] = 'Sasaran Program';
				$data['type'] = 'SP';
			}else{
				$data['sasaran'] = $this->sasaran_kegiatan_model->getData($params);
				$data['n'] = 'sasaran_kegiatan';
				$data['j'] = 'Sasaran Kegiatan';
				$data['type'] = 'SK';
				
			}

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}





	public function getss()
	{
		if($_POST){
			$id_sasaran = $_POST['id_sasaran'];
			$type = $_POST['type'];
			if($type=="SS"){
				$this->load->model('sasaran_strategis_model');
				$data = $this->sasaran_strategis_model->get_data_by_id($id_sasaran);
			}
			else if($type=="SP"){
				$this->load->model('sasaran_program_model');
				$data = $this->sasaran_program_model->get_data_by_id($id_sasaran);
			}
			else if($type=="SK"){
				$this->load->model('sasaran_kegiatan_model');
				$data = $this->sasaran_kegiatan_model->get_data_by_id($id_sasaran);
			}


			$result = array(
				'status' => 1,
				'data'	=> $data,
			);
			echo json_encode($result);
		}
	}

	public function getiku()
	{
		if($_POST){
			$id_indikator = $_POST['id_indikator'];
			$this->load->model('indikator_model');
			$params = array('id_indikator' => $id_indikator);
			$data = $this->indikator_model->getIndikator($params);


			$result = array(
				'status' => 1,
				'data'	=> $data,
			);
			echo json_encode($result);
		}
	}

	public function delete_renaksi($id_renaksi,$type,$id_rkt,$id_indikator)
	{
		if(!empty($id_renaksi) && $this->user_id)
		{
			$this->load->model('renaksi_model');
			$status = $this->renaksi_model->delete($id_renaksi);
			if($status){
				redirect(base_url().'/rencana_kerja_tahunan/detail_indikator/'.$type.'/'.$id_rkt.'/'.$id_indikator);
			}
		}
	}

	public function delete_rkt($id_rkt=null)
	{
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if($this->user_id && $id_rkt!=null && $rkt!=null)
		{
			$this->rkt_model->delete($rkt);
			echo true;
		}
		else{
			echo false;
		}
	}

	public function delete_ss($id_sasaran=null,$id_rkt=null)
	{
		
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);
		if($this->user_id && $id_rkt!=null && $rkt!=null && $id_sasaran !=null)
		{
			$this->rkt_model->delete_ss($rkt,$id_sasaran);
			echo true;
		}
		else{
			echo false;
		}
	}

	public function getikuinduk()
	{
		if(!empty($_POST['id_ss_induk']) && !empty($_POST['type']))
		{
			$type = $_POST['type'];
			$id_ss_induk = $_POST['id_ss_induk'];
			$this->load->model("indikator_model");
			$params = array(
				'type' => $_POST['type'],
				'id_sasaran' => $_POST['id_ss_induk'],
			);
			$indikator = $this->indikator_model->getIndikator($params);

			//$opt = "<option value=''>Pilih</option>";
			$opt = "";
			foreach ($indikator as $row) {
				$opt .= "<option value='$row->id_indikator'>$row->nama_indikator</option>";
			}
			die ($opt);
		}
	}

	public function getikuatasan()
	{
		if(!empty($_POST['uid_ss_atasan']) && !empty($_POST['type']))
		{
			$this->load->model("indikator_model");
			$params3 = array(
				'type'	=> $_POST['type'],
				'where'	=> array(
					'indikator_turunan.uid_ss_atasan' => $_POST['uid_ss_atasan'],
					'indikator_turunan.id_unit_kerja' => $_POST['id_unit_kerja'],
				)
			);
			$indikator= $this->indikator_model->getIndikatorTurunan($params3/*,"indikator_turunan.uid_ss_bawahan is null"*/);

			//$opt = "<option value=''>Pilih</option>";
			$opt = "";
			foreach ($indikator as $row) {
				$opt .= "<option value='$row->uid_iku_atasan'>$row->nama_indikator_atasan</option>";
			}
			die ($opt);
		}
	}
}
?>