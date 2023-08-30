<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seleksi extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;

		$this->load->model("talenta/kebutuhan_model");
		$this->load->model("talenta/pendaftaran_model");
		$this->load->model("talenta/skor_model");
		
    }
    
    public function index()
	{		
        if ($this->user_id)
		{
			$data['title']		= "Pendaftaran seleksi - Manajemen Talenta";
			$data['content']	= "talenta/seleksi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";
			

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
			
			$where = array();			
			if($_POST)
			{
				
				$data = array_merge($data,$_POST);

				if($this->input->post("eselon")){
					$where['mt_kebutuhan.eselon'] = $this->input->post("eselon");
				}
				
				if($this->input->post("id_skpd")){
					$where['ref_skpd.id_skpd'] = $this->input->post("id_skpd");
					$this->load->model("ref_unit_kerja_model");
					$param = array("id_skpd" => $this->input->post("id_skpd"));
					$data['dt_unit_kerja'] = $this->ref_unit_kerja_model->getUnit($param);
				}
				if($this->input->post("id_unit_kerja")){
					$where['ref_unit_kerja.id_unit_kerja'] = $this->input->post("id_unit_kerja");
					$this->load->model("ref_jabatan_model");
					$param = array("id_unit_kerja" => $this->input->post("id_unit_kerja"));
					$data['dt_jabatan'] = $this->ref_jabatan_model->get($param);
				}
				if($this->input->post("id_jabatan")){
					$where['ref_jabatan.id_jabatan'] = $this->input->post("id_jabatan");
				}
				
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->kebutuhan_model->get_total_seleksi();
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;


			$data['dt_kebutuhan'] = $this->kebutuhan_model->getSeleksi($where,$hal,$mulai);
			$this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();

			$dt_pendaftaran = $this->pendaftaran_model->get(array('mt_pendaftaran.id_pegawai' => $this->session->userdata("id_pegawai")));

			$ids_kebutuhan = array();
			foreach($dt_pendaftaran as $row)
			{
				$ids_kebutuhan[] = $row->id_kebutuhan;
			}
			$data['ids_kebutuhan'] = $ids_kebutuhan;
			
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	
	public function detail($id_kebutuhan=null)
	{		
        if ($this->user_id)
		{
			$data['title']		= "Seleksi talent - Manajemen Talenta";
			$data['content']	= "talenta/seleksi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
            $param = array('mt_kebutuhan.id_kebutuhan' => $id_kebutuhan);
            $detail = $this->kebutuhan_model->get($param);
			

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
			if($id_kebutuhan!=null && !empty($detail[0])){
                $data['detail'] = $detail[0];
				$data['dt_persyaratan'] = $this->kebutuhan_model->get_persyaratan($param);
				
				$data['dt_pendaftaran'] = $this->pendaftaran_model->get(array('mt_pendaftaran.id_kebutuhan' => $id_kebutuhan , 'mt_pendaftaran.id_pegawai' => $this->session->userdata("id_pegawai")));

				
                $this->load->view('admin/index',$data);
            }
            else{
                show_404();
            }

		}
		else
		{
			redirect('admin');
		}
	}

	public function daftar($id_kebutuhan=null)
	{
		
		if($this->user_id && $id_kebutuhan!=null){
			$param = array('mt_kebutuhan.id_kebutuhan' => $id_kebutuhan);
			$kebutuhan = $this->kebutuhan_model->get($param);

			$this->load->model("pegawai_model");
			$pegawai = $this->pegawai_model->get($this->session->userdata("id_pegawai"));
			//echo "<pre>";print_r($pegawai);
			//echo "<pre>";print_r($kebutuhan);die;
			$success = false;
			if(!empty($pegawai) && !empty($kebutuhan))
			{
				$level_pendidikan_pegawai = (int)$pegawai[0]['riwayat_pendidikan_level'];
				$level_golongan_pegawai = (int)$pegawai[0]['riwayat_pangkat_level'];

				$level_pendidikan_kebutuhan = (int)$kebutuhan[0]->level_pendidikan;
				$level_golongan_kebutuhan = (int)$kebutuhan[0]->level_golongan;

				//var_dump($level_pendidikan_pegawai);
				//var_dump($level_golongan_pegawai);
				//var_dump($level_pendidikan_kebutuhan);
				//var_dump($level_golongan_kebutuhan);
				//die;
				if($level_golongan_pegawai >= $level_golongan_kebutuhan && $level_pendidikan_pegawai <= $level_pendidikan_kebutuhan)
				{
					
					$data = array(
						'id_kebutuhan' 	=> $id_kebutuhan,
						'id_pegawai'	=> $this->session->userdata("id_pegawai"),
						'tgl_daftar'	=> date('Y-m-d H:i:s'),
					);
					$success = $this->pendaftaran_model->insert($data);
				}
			}
			
			if($success)
				$this->session->set_flashdata("message_success","Anda telah ikut serta pada seleksi ini");
			else
				$this->session->set_flashdata("message_error","Anda tidak memenuhi syarat ikut serta seleksi ini");
			redirect("/talenta/seleksi/detail/".$id_kebutuhan);
			//redirect("/talenta/seleksi/status/");
		}
		else{
			redirect("admin");
		}
		
	}

	public function status()
	{		
        if ($this->user_id)
		{
			$data['title']		= "Status seleksi - Manajemen Talenta";
			$data['content']	= "talenta/seleksi/status" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";
			

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
			
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->pendaftaran_model->get_total(array('mt_pendaftaran.id_pegawai' => $this->session->userdata("id_pegawai")));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;

			$data['dt_pendaftaran'] = $this->pendaftaran_model->get(array('mt_pendaftaran.id_pegawai' => $this->session->userdata("id_pegawai")),$hal,$mulai);

			//echo "<pre>";print_r($data['dt_pendaftaran']);die;
			
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	
	public function upload_kompetensi()
	{
		
		if($this->user_id && $this->input->post("id_pendaftaran")){
			$data['title']		= "Upload berkas Kompetensi - Manajemen Talenta";
			$data['content']	= "talenta/seleksi/upload_kompetensi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['id_pendaftaran'] = $id_pendaftaran;
			//$data['active_menu'] = "ref_persyaratan";
			
			$dt_pendaftaran = $this->pendaftaran_model->get(['mt_pendaftaran.id_pendaftaran' => $this->input->post("id_pendaftaran")]);

			if(!$dt_pendaftaran || $dt_pendaftaran[0]->id_pegawai != $this->session->userdata("id_pegawai")){
				show_404();
			}

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
			if($_POST && $this->input->post("id_pendaftaran")){

				
				$assessment = $this->db->where("id_pendaftaran",$this->input->post("id_pendaftaran"))->get("mt_assessment")->result();

				$config['upload_path']="./data/talent/berkas/kompetensi/"; 
			    $config['allowed_types']="pdf|jpg|png|jpeg"; 
			    $config['encrypt_name'] = TRUE; 
			    $config['max_size']     = 1000;
			        
				$this->load->library('upload',$config); 
				
			        if($this->upload->do_upload("file_kompetensi")){ 
			            $file_kompetensi = $this->upload->data('file_name'); 

			            if(!empty($assessment) && $assessment[0]->file_kompetensi!=""){
			            	$path = "./data/talent/berkas/kompetensi/".$assessment[0]->file_kompetensi;
			            	if(file_exists($path)){
			            		unlink($path);
			            	}
			            }
			        }
			        else if (!empty($_FILES['file']['tmp_name'])){
			        	$error_kompetensi = $this->upload->display_errors();
			        }

				if(empty($error_kompetensi) && !empty($file_kompetensi)) {
					
					$update['file_kompetensi'] = $file_kompetensi;
					$this->pendaftaran_model->updateAssessment($update,$this->input->post("id_pendaftaran"));
					$this->session->set_flashdata("message_success","Upload berhasil");
				}
				else{
					//die($error_kompetensi);
					$this->session->set_flashdata("message_error",$error_kompetensi);
				}
				
				
					
				redirect("/talenta/seleksi/detail/".$dt_pendaftaran[0]->id_kebutuhan);
			}
			
		}
		else{
			redirect("admin");
		}
		
	}

	public function upload_potensi()
	{
		
		if($this->user_id && $this->input->post("id_pendaftaran")){
			
			
			$dt_pendaftaran = $this->pendaftaran_model->get(['mt_pendaftaran.id_pendaftaran' => $this->input->post("id_pendaftaran")]);

			if(!$dt_pendaftaran || $dt_pendaftaran[0]->id_pegawai != $this->session->userdata("id_pegawai")){
				show_404();
			}

			if($_POST && $this->input->post("id_pendaftaran")){

				
				$assessment = $this->db->where("id_pendaftaran",$this->input->post("id_pendaftaran"))->get("mt_assessment")->result();

				$config['upload_path']="./data/talent/berkas/potensi/"; 
			    $config['allowed_types']="pdf|jpg|png|jpeg"; 
			    $config['encrypt_name'] = TRUE; 
			    $config['max_size']     = 1000;
			        
				$this->load->library('upload',$config); 
				
			        if($this->upload->do_upload("file_potensi")){ 
			            $file_potensi = $this->upload->data('file_name'); 

			            if(!empty($assessment) && $assessment[0]->file_potensi!=""){
			            	$path = "./data/talent/berkas/potensi/".$assessment[0]->file_potensi;
			            	if(file_exists($path)){
			            		unlink($path);
			            	}
			            }
			        }
			        else if (!empty($_FILES['file']['tmp_name'])){
			        	$error_potensi = $this->upload->display_errors();
			        }

				if(empty($error_potensi) && !empty($file_potensi)) {
					
					$update['file_potensi'] = $file_potensi;
					$this->pendaftaran_model->updateAssessment($update,$this->input->post("id_pendaftaran"));
					$this->session->set_flashdata("message_success","Upload berhasil");
				}
				else{
					//die($error_potensi);
					$this->session->set_flashdata("message_error",$error_potensi);
				}

					
				redirect("/talenta/seleksi/detail/".$dt_pendaftaran[0]->id_kebutuhan);
			}
			
		}
		else{
			redirect("admin");
		}
		
	}
	
}
?>