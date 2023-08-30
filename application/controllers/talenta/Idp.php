<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idp extends CI_Controller {
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

		$this->load->model("talenta/idp_model");
		
    }

    public function index()
	{		
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
        if ($this->user_id && ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges)))
		{
			$data['title']		= "Individual Development Plan - Manajemen Talenta";
			$data['content']	= "talenta/idp/index" ;
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
					$where['pegawai.id_skpd'] = $this->input->post("id_skpd");
                }
                if($this->input->post("nama_lengkap")){
					if($sWhere!="") $sWhere .= " AND ";
					$sWhere .="pegawai.nama_lengkap like '% ".$this->input->post("nama_lengkap")."%'";
				}
				
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->idp_model->get_total();
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;


			$data['dt_idp'] = $this->idp_model->get($where,$hal,$mulai,$sWhere);
			$this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();
			
			//echo "<pre>";print_r($data['dt_idp']);die;
			$this->load->view('admin/index',$data);

		}
		else
		{
			show_404();
		}
    }
    
    public function form()
	{		
		if ($this->user_id && $this->user_level!="Administrator")
		{
            //var_dump($this->session->userdata("id_pegawai"));die;
			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

			$data['title']		= "Form Individual Development Plan - Manajemen Talenta";
			$data['content']	= "talenta/idp/form" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";
            $data['dt_persyaratan'] = array();
            
            $this->load->model("pegawai_model");
            $data['dt_pegawai'] = $this->pegawai_model->get_all_by_skpd($this->session->userdata("id_skpd"));
            
            $this->load->library('form_validation');
            
            $dt_idp = $this->idp_model->get(['mt_idp.id_pegawai' => $this->session->userdata("id_pegawai")]);
            //echo "<pre>";print_r($dt_idp);die;
            if(!empty($dt_idp[0]))
            {
                foreach($dt_idp[0] as $key=>$value){
                    $data[$key] = $value;
                }
            }
            
			if(!empty($_POST))
			{
                
                $this->form_validation->set_rules(
					'tanggal_mulai',
					'Mulai periode',
					'required',
					[
						'required' => '%s harus diisi',
					]
                );
                
                $this->form_validation->set_rules(
					'tanggal_akhir',
					'Akhir periode',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				


				if($this->form_validation->run() ==true) {
					
					$insert = array();
					foreach($_POST as $key=>$value)
					{
						$insert[$key] = $this->security->xss_clean($value);
                    }
                    unset($insert['_wysihtml5_mode']);
					//echo "<pre>";print_r($insert);die;
					$this->idp_model->save($this->session->userdata("id_pegawai"),$insert);	
                    //die;
					$this->session->set_flashdata("message_success","Formulir IDP berhasil disimpan.");
					redirect("talenta/idp/detail/".$this->session->userdata("id_pegawai"));

				}
				else{
					
					$data = array_merge($data,$_POST);
				}
            }
            
			$this->load->view('admin/index',$data);

		}
		else
		{
			show_404();
		}
    }
    public function detail($id_pegawai=null)
	{	
        $param = array(
            'mt_idp.id_pegawai'        => $id_pegawai
        );
        $detail = $this->idp_model->get($param);

        if ($this->user_id && $id_pegawai!=null && $detail &&
            ($this->user_level=="Administrator" || 
            ($this->user_level!="Administrator" && $detail[0]->id_pegawai== $this->session->userdata("id_pegawai")) )
        )
		{
			$data['title']		= "Individual Development Plan - Manajemen Talenta";
			$data['content']	= "talenta/idp/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
            $data['user_level']		= $this->user_level;
            
            $data['detail'] = $detail[0];
            
            $data['level'] = $this->user_level;

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
            

            
                
                $this->load->view('admin/index',$data);
            
                
                
            

		}
		else
		{
                      
            if($this->user_level!="Administrator" && $this->session->userdata("id_pegawai")== $id_pegawai){
                redirect("talenta/idp/form");
            }
            else{
                
                show_404();
            }
		}
	}

	
}
?>