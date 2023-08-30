<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_kgb extends CI_Controller {
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
		if ($this->user_level=="Admin Web"); 

		$this->load->model('ref_golongan_model','golongan_m');
		$this->load->model('ref_pp_model','pp_m');
		$this->load->model('ref_kgb_model','kgb_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Gaji Pokok - Admin ";
			$data['content']	= "ref_kgb/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kgb";

			// $data['item'] = $this->kgb_m->get_all();
			$data['golongan'] = $this->golongan_m->get_all();
			$data['pp'] = $this->pp_m->get_all();

			for ($g=1; $g <= 4; $g++) { 
				$data['golongan_golongan'][$g] = $this->golongan_m->get_all_by_golongan($g);
			}

			foreach ($data['pp'] as $row) {
				for ($g=1; $g <= 4; $g++) { 
					$data['mkg'][$row->id_pp][$g] = $this->kgb_m->get_max_mkg_by_pp_golongan($row->id_pp,$g);
				}
			}

			foreach ($data['pp'] as $r_pp) {
				$data['item'.$r_pp->id_pp] = array();
				foreach ($data['mkg'][$r_pp->id_pp] as $key_g => $r_max) {
					// echo $r_max.$key_g;
					if ($r_max>=0) {
						for ($i=0; $i <= $r_max; $i++) {
							foreach ($data['golongan'] as $r_gol) {
								if ($r_gol->id_golongan>=$key_g.'0' AND $r_gol->id_golongan<=$key_g.'9') {
									$data['item'.$r_pp->id_pp][$key_g][$i][$r_gol->id_golongan] = $this->kgb_m->get_item($r_pp->id_pp,$i,$r_gol->id_golongan);
								}
							}
						}
					}
				}
				// echo '<pre>';
				// print_r($data['item'.$r_pp->id_pp]);
				// echo '</pre>';
			}
			// exit();

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$insert = $this->kgb_m->insert($data);
		if ($insert===false) {
			$this->session->set_flashdata('msg',"Data sudah ada.");
			$this->session->set_flashdata('msg_type',"danger");
		} else {
			$this->session->set_flashdata('msg',"Data berhasil ditambahkan.");
			$this->session->set_flashdata('msg_type',"success");
		}
		redirect(base_url('ref_kgb?id_golongan='.$this->input->post('id_golongan').'&&mkg='.$this->input->post('mkg')));
	}

	public function view()
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Gaji Pokok - Admin ";
			$data['content']	= "ref_kgb/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kgb";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_kgb'));
	        }

			$data['golongan'] = $this->golongan_m->get_all();
			$data['pp'] = $this->pp_m->get_all();
	        $data['item'] = $this->kgb_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_kgb'));
	        }

			$data['title']		= "Gaji Pokok - Admin ";
			$data['content']	= "ref_kgb/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_kgb";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function update(){
		$id = $this->uri->segment(3);
		if(empty($id)){
	            redirect(base_url('ref_kgb'));
	        }
		$data = $this->input->post();
		$this->kgb_m->update($data,$id);
		redirect(base_url('ref_kgb'));
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_kgb_model');
			$this->ref_kgb_model->id_kgb = $id;
			$this->ref_kgb_model->delete();
			$data['message_type'] = "success";
			$data['message']	= "Record Ref kgb berhasil dihapus.";
		
			redirect('ref_kgb');
			
		}
		else
		{
			redirect('home');
		}
	}
}
?>