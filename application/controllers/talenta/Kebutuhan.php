<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kebutuhan extends CI_Controller {
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
		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}
	}
	public function index()
	{		
        if ($this->user_id)
		{
			$data['title']		= "Analisis Kebutuhan - Manajemen Talenta";
			$data['content']	= "talenta/kebutuhan/index" ;
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
			$data['dt_kebutuhan'] = $this->kebutuhan_model->get();
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
    }
    
    public function add()
	{		
		if ($this->user_id)
		{
			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

			$data['title']		= "Tambah Analisis Kebutuhan - Manajemen Talenta";
			$data['content']	= "talenta/kebutuhan/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";
			$data['dt_persyaratan'] = array();
            
			$this->load->library('form_validation');
			if(!empty($_POST))
			{
                //var_dump($this->input->post("persyaratan"));die;
				$this->form_validation->set_rules(
					'eselon',
					'Eselon',
					'required|in_list[I,II,III,IV]',
					[
						'required' => '%s harus diisi',
						'in_list'	=> '%s tidak valid',
					]
				);
				$this->form_validation->set_rules(
					'id_skpd',
					'SKPD',
					'required',
					[
						'required' => '%s harus diisi',
					]
                );
                
                $this->form_validation->set_rules(
					'id_jabatan',
					'Jabatan',
					'required',
					[
						'required' => '%s harus diisi',
					]
                );
                
                $this->form_validation->set_rules(
					'tanggal_buka',
					'Tanggal',
					'required',
					[
						'required' => '%s harus diisi',
					]
                );
                
                $this->form_validation->set_rules(
					'tanggal_tutup',
					'Tanggal',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'id_kategori_jabatan',
					'Kategori Jabatan',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'kualifikasi_golongan',
					'Golongan',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'kualifikasi_pendidikan',
					'Tingkat pedidikan',
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
                    unset($insert['persyaratan']);
					//echo "<pre>";print_r($insert);die;
					$id_kebutuhan = $this->kebutuhan_model->insert($insert);	
                    if($this->input->post("persyaratan"))
                    {
                        $persyaratan = $this->input->post("persyaratan");
                        foreach($persyaratan as $key=>$id_peryaratan)
                        {
                            $insert_persyaratan = array(
                                'id_kebutuhan'  => $id_kebutuhan,
                                'id_persyaratan' => $id_peryaratan,
                            );
                            $this->kebutuhan_model->insert_persyaratan($insert_persyaratan);
                        }
                    }
					$this->session->set_flashdata("message_success","Analisa kebutuhan berhasil ditambahkan.");
					redirect("talenta/kebutuhan/add");

				}
				else{

					$this->load->model("talenta/persyaratan_model");
					$param = array("eselon" => $this->input->post('eselon'));
					$data['dt_persyaratan'] = $this->persyaratan_model->get($param);
					
					$data = array_merge($data,$_POST);
				}
            }
            

            $this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();
			
			$this->load->model("talenta/skor_model");
			$data['dt_kategori_jabatan'] = $this->skor_model->getKategoriJabatan();

			
			$data['dt_pendidikan'] = $this->db->where("status","Y")->order_by("tkt","ASC")->order_by("id_jenjangpendidikan","DESC")->get("ref_jenjangpendidikan")->result();
			$data['dt_golongan'] = $this->db->where("status","Y")->order_by("level","DESC")->get("ref_golongan")->result();
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
			$data['title']		= "Analisis Kebutuhan - Manajemen Talenta";
			$data['content']	= "talenta/kebutuhan/detail" ;
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
	public function edit($id_kebutuhan=null)
	{		
		if ($this->user_id)
		{
			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}

			$data['title']		= "Edit Analisis Kebutuhan - Manajemen Talenta";
			$data['content']	= "talenta/kebutuhan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";

			
			$param = array('mt_kebutuhan.id_kebutuhan' => $id_kebutuhan);
			$detail = $this->kebutuhan_model->get($param);

			$e_persyaratan = $this->kebutuhan_model->get_persyaratan($param);
			$persyaratan = array();
			foreach($e_persyaratan as $row)
			{
				$persyaratan[] = $row->id_persyaratan;
			}
			$data['persyaratan'] = $persyaratan;

			$this->load->model("talenta/persyaratan_model");
			$param = array("eselon" => $detail[0]->eselon);
            $data['dt_persyaratan'] = $this->persyaratan_model->get($param);

			foreach($detail[0] as $key => $value){
				$data[$key]  = $value;
			}
            
			$this->load->library('form_validation');
			if(!empty($_POST))
			{
               
                
                $this->form_validation->set_rules(
					'tanggal_buka',
					'Tanggal',
					'required',
					[
						'required' => '%s harus diisi',
					]
                );
                
                $this->form_validation->set_rules(
					'tanggal_tutup',
					'Tanggal',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'kualifikasi_golongan',
					'Golongan',
					'required',
					[
						'required' => '%s harus diisi',
					]
				);

				$this->form_validation->set_rules(
					'kualifikasi_pendidikan',
					'Tingkat pedidikan',
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
                    unset($insert['persyaratan']);
					//echo "<pre>";print_r($insert);die;
					$this->kebutuhan_model->update($insert,$id_kebutuhan);	
                    if($this->input->post("persyaratan"))
                    {
						$this->kebutuhan_model->delete_persyaratan($id_kebutuhan);
                        $persyaratan = $this->input->post("persyaratan");
                        foreach($persyaratan as $key=>$id_peryaratan)
                        {
                            $insert_persyaratan = array(
                                'id_kebutuhan'  => $id_kebutuhan,
                                'id_persyaratan' => $id_peryaratan,
                            );
                            $this->kebutuhan_model->insert_persyaratan($insert_persyaratan);
                        }
                    }
					$this->session->set_flashdata("message_success","Analisa kebutuhan berhasil diubah.");
					redirect("talenta/kebutuhan/detail/".$id_kebutuhan);

				}
				else{
					$data = array_merge($data,$_POST);
				}
            }
            

            $this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();
			
			$data['dt_pendidikan'] = $this->db->where("status","Y")->order_by("tkt","ASC")->order_by("id_jenjangpendidikan","DESC")->get("ref_jenjangpendidikan")->result();
			$data['dt_golongan'] = $this->db->where("status","Y")->order_by("level","DESC")->get("ref_golongan")->result();
			
			
			if($id_kebutuhan!=null && !empty($detail[0])){
				$this->load->view('admin/index',$data);
			}
			else{
				show_404;
			}

		}
		else
		{
			redirect('admin');
		}
	}
	
	public function delete($id_kebutuhan=null)
	{
		
		if($this->user_id && $id_kebutuhan!=null){
			
			$success = $this->kebutuhan_model->delete($id_kebutuhan);
			if($success)
				$this->session->set_flashdata("message_success","Analisis kebutuhan berhasil dihapus.");
			else
				$this->session->set_flashdata("message_error","Analisis kebutuhan gagal dihapus.");
			redirect("/talenta/kebutuhan");
		}
		else{
			redirect("admin");
		}
		
	}
}
?>