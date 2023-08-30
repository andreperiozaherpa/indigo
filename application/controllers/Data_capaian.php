<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_capaian extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_rkt_model');
		$this->load->model('ref_unit_kerja_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_renstra_model');
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
			$data['title']		= "Data Capaian - Admin ";
			$data['content']	= "data_capaian/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['tahun'] = $this->ref_rkt_model->get_tahun();
			
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
				$this->ref_unit_kerja_model->session_unit_kerja_only = true;
				if(!empty($_POST)){
					$this->ref_rkt_model->tahun_rkt = $_POST['tahun_rkt'];
				}
			}
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['item'] = $this->ref_rkt_model->get_all();
			//echo "<pre>";print_r($data);die;
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
		if ($this->user_id && $id_rkt!=null)
		{
			$data['title']		= "Data Capaian - Admin ";
			$data['content']	= "data_capaian/detail_unitkerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

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
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "data_capaian/detail_sasaran" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['editdata'] = $editdata;
			$data['id_rkt'] = $id_rkt;
			$data['_type'] = $type;
			$data['id_sasaran'] = $id_sasaran;

			$params = array(
				'id_unit'	=> $editdata[0]->id_unit_kerja,
				'type'		=> $type,
				'id_sasaran' => $id_sasaran,
				'id_rkt'	=> $id_rkt,
			);
			
			$params1 = array(
				'type'			=> $type,
				'where'			=> array(
//					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_ss_bawahan' => $editdata[0]->uid_ss,
				),
			);
			$data['ss_atasan'] = $this->indikator_model->getIndikatorTurunan($params1);

			$params2 = array(
				'type'			=> $type,
				'where'			=> array(
//					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_ss_atasan' => $editdata[0]->uid_ss,
				),
			);
			$data['ss_bawahan'] = $this->indikator_model->getIndikatorTurunan($params2);

			
			$data['indikator'] = $this->indikator_model->getIndikator($params);
			//echo "<pre>";print_r($data['indikator']);die;
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
		$this->load->model('pencapaian_model');
		$params = array(
			'type' => $type,
			'id_indikator' => $id_indikator,
			'id_rkt'		=> $id_rkt,
		);
		$detail = $this->indikator_model->getIndikator($params);
		$rkt = $this->ref_rkt_model->select_by_id($id_rkt);

		
		if ($this->user_id && $detail!=null && $rkt!=null)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "data_capaian/detail_indikator" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_rkt";

			$data['detail'] = $detail;
			$data['rkt']	= $rkt;
			$data['_type'] = $type;
			$data['GLOBALVAR'] = GLOBALVAR;

			$params1 = array(
				'type'			=> $type,
				'where'			=> array(
//					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_iku_bawahan' => $detail[0]->uid_iku,
				),
			);
			$data['iku_atasan'] = $this->indikator_model->getIndikatorTurunan($params1);

			$params2 = array(
				'type'			=> $type,
				'where'			=> array(
//					'indikator_turunan.id_unit_kerja' => $editdata[0]->id_unit_kerja,
					'indikator_turunan.uid_iku_atasan' => $detail[0]->uid_iku,
				),
			);
			$data['iku_bawahan'] = $this->indikator_model->getIndikatorTurunan($params2);

			$this->load->model('rkt_model');
			$paramBobot = array(
				'uid_ss' => $detail[0]->uid_ss,
				'bobot'	=> 0,
				'id_rkt'	=> $id_rkt,

			);
			$bobotSS = $this->rkt_model->getBobot($paramBobot);

			if(!empty($bobotSS) || $detail[0]->bobot==0)
			{
				$data['belum_bobot'] = true;
			}
			//echo "<pre>";print_r($bobotSS);die;

			$data['pencapaian_detail'] = $this->pencapaian_model->getCapaianIndikatorDetail(array('pencapaian_indikator_detail.uid_iku' => $detail[0]->uid_iku));

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	
	public function update_capaian()
	{
		if($this->user_id && !empty($_POST) && !empty($_POST['id_indikator']) && !empty($_POST['id_capaian_indikator']) && !empty($_POST['realisasi']) && !empty($_POST['type']))
		{
			$this->load->model('indikator_model');
			$params = array('id_indikator' => $_POST['id_indikator'], 'type' => $_POST['type']);
			$indikator = $this->indikator_model->getIndikator($params);
			if($indikator!=null){
				if($indikator[0]->formula=="M" && empty($_POST['capaian'])){
					echo "Data tidak lengkap";
				}
				else{
					$this->load->model('pencapaian_model');
					if($indikator[0]->formula =="M"){
						$capaian = $_POST['capaian'];
					}
					else{
						$detail = $this->pencapaian_model->getCapaianIndikatorDetail(array('id_capaian_indikator' => $_POST['id_capaian_indikator']));
						$target = !empty($detail) ? $detail[0]->target : 0 ;
						$polaritas = $indikator[0]->polaritas;
						$realisasi = $_POST['realisasi'];

						
						
						if($polaritas=="MAX"){
							$capaian = ($target>0) ? (($realisasi / $target) *100) : 0;
						}
						else if($polaritas=="MIN"){
							$capaian = ($target>0) ? (($target / $realisasi) * 100) : 0;
						}
						else{
							if($target >= $realisasi){
								$capaian = ($target>0) ? (($realisasi / $target) * 100) : 0;
							}
							else{
								$capaian = ($target>0) ? (($target / $realisasi) * 100) : 0;
							}
						}
					}
					$GLOBALVAR = GLOBALVAR;
					if($capaian > $GLOBALVAR['max_capaian']) $capaian = $GLOBALVAR['max_capaian'];
					
					$data = array(
						'capaian'	=> $capaian,
						'realisasi'	=> $_POST['realisasi'],
					);

					$config['upload_path']          = './data/capaian/';
					$config['allowed_types']        = '*';
		            $config['max_size']             = 200000;
		            $config['max_width']            = 200000;
		            $config['max_height']           = 200000;

		            $this->load->library('upload', $config);
		            $upload=$this->upload->do_upload('berkas');
		            if($upload)
		            {
		            	$data['berkas'] = $this->upload->data('file_name');
		            	$pencapaian_detail = $this->pencapaian_model->getCapaianIndikatorDetail(array('id_capaian_indikator' => $_POST['id_capaian_indikator']));
		            	if(!empty($pencapaian_detail[0]->berkas) && $pencapaian_detail[0]->berkas!="")
		            	{
		            		if(file_exists($config['upload_path'].$pencapaian_detail[0]->berkas))
		            			unlink($config['upload_path'].$pencapaian_detail[0]->berkas);
		            	}
		            }

		            $params = array(
		            	'data_indikator_detail'	=> $data,
		            	'id_capaian_indikator'	=> $_POST['id_capaian_indikator'],
		            	'indikator'				=> $indikator,
		            	'type'					=> $_POST['type'],
		            );

		            $this->pencapaian_model->updateAll($params);
		            /*
					$status = $this->pencapaian_model->updateCapaianDetail($data,$_POST['id_capaian_indikator']);

					$this->pencapaian_model->updateCapaianIndikator($indikator[0]->uid_iku,$indikator[0]->formula);
					$this->updateCapaianIKUAtasan($_POST['type'], $indikator[0]->id_indikator);
					$this->pencapaian_model->updateCapaianSasaran($indikator[0]->uid_ss,$_POST['type']);
					$this->pencapaian_model->updateCapaianSasaranDetail($indikator[0]->uid_ss,$indikator[0]->tahun,$indikator[0]->id_unit_kerja);
					$this->pencapaian_model->updateCapaianUnit($indikator[0]->id_unit_kerja,$_POST['type'],$indikator[0]->tahun);
					$this->pencapaian_model->updateCapaianUnitDetail($indikator[0]->id_unit_kerja,$indikator[0]->tahun);
					*/
					echo true;
				}
			}
			else{
				"Data tidak valid";
			}
		}
		else{
			echo "Data tidak lengkap";
		}
	}

	public function test()
	{
		$uid_ss= "SS-5bdf06056ed1f";
		$tahun = 2018;
		$id_unit = 1;
		$this->load->model("pencapaian_model");
		//$this->pencapaian_model->updateCapaianSasaran($uid_ss,"SS");

	}
}
?>