<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends CI_Controller {
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
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}
        if ($this->user_id)
		{
			$data['title']		= "Data Assessment - Manajemen Talenta";
			$data['content']	= "talenta/assessment/index" ;
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
			$data['filter'] = false;
			$sWhere = "";
			$where = array();			
			if($_POST)
			{
				$data['filter'] = true;
				
				if($this->input->post("nip")){
					$sWhere= "pegawai.nip like '%".$this->input->post('nip')."%' ";
				}

				$data = array_merge($data,$_POST);
				
				if($this->input->post("id_skpd")){
					$where['mt_kebutuhan.id_skpd'] = $this->input->post("id_skpd");
                }
                if($this->input->post("nama_lengkap")){
					if($sWhere!="") $sWhere .= " AND ";
					$sWhere .="pegawai.nama_lengkap like '% ".$this->input->post("nama_lengkap")."%'";
				}
				
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->pendaftaran_model->get_total();
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;


			$data['dt_pendaftaran'] = $this->pendaftaran_model->get($where,$hal,$mulai,$sWhere);
			$this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();
            
            //echo $this->session->userdata('id_pegawai');die;
            //echo "<pre>";print_r($data['dt_pendaftaran']);die;

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_pendaftaran=null)
	{		
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}

        if ($this->user_id)
		{
			$data['title']		= "Detail Assessment - Manajemen Talenta";
			$data['content']	= "talenta/assessment/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
            
            $param = array('mt_pendaftaran.id_pendaftaran' => $id_pendaftaran);
            $detail = $this->pendaftaran_model->get($param);
			
			if($id_pendaftaran!=null && !empty($detail[0])){
				$data['detail'] = $detail[0];
				$this->load->model("pegawai_model");
				$data['pegawai'] = $this->pegawai_model->get($data['detail']->id_pegawai); 
				
				$data['peringkat'] = $this->skor_model->getPeringkat($data['detail']->id_pegawai,$detail[0]->id_kebutuhan);

				$param = array(
					'mt_kebutuhan.id_kebutuhan'	=> $detail[0]->id_kebutuhan,
				);
				$data['dt_summary'] = $this->skor_model->getSummary($param);

				//echo "<pre>";print_r($data['dt_summary']);die;
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

	public function download($id_pedaftaran=null)
	{
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}

        if ($this->user_id)
		{
			$url = base_url("talenta/assessment/cetak/".$id_pedaftaran."/".$this->config->item('app_token'));
			$filename = md5(uniqid()) . ".pdf";
			$path = "./data/talent/".$filename;
			$output = array();
			$result = false;
			exec("xvfb-run wkhtmltopdf -T 20 -B 20 -L 20 -R 20 $url $path",$output,$result);
			if(!$result)
			{
				header("Content-type: application/download");
				header("Content-Disposition: inline; filename=".$filename);
				@readfile($path);

				unlink($path);
			}
			else{
				//echo "<pre>";print_r($output);
				die("Error download");
			}
		}
		else
		{
			redirect('admin');
		}
	}

	public function cetak($id_pendaftaran=null,$token=null)
	{		
        
            
            $param = array('mt_pendaftaran.id_pendaftaran' => $id_pendaftaran);
            $detail = $this->pendaftaran_model->get($param);
			
			if($id_pendaftaran!=null && !empty($detail[0]) && $token!=null && $token==$this->config->item('app_token')){
				$data['detail'] = $detail[0];
				$this->load->model("pegawai_model");
				$data['pegawai'] = $this->pegawai_model->get($data['detail']->id_pegawai); 
				
				$data['peringkat'] = $this->skor_model->getPeringkat($data['detail']->id_pegawai,$detail[0]->id_kebutuhan);

				$param = array(
					'mt_kebutuhan.id_kebutuhan'	=> $detail[0]->id_kebutuhan,
				);
				$data['dt_summary'] = $this->skor_model->getSummary($param);

				//echo "<pre>";print_r($data['dt_summary']);die;
                $this->load->view('admin/talenta/assessment/cetak',$data);
            }
            else{
                show_404();
            }

		
	}
}
?>