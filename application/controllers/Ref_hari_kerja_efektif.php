<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_hari_kerja_efektif extends CI_Controller {
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
        $this->load->model('ref_hari_kerja_efektif_model','ref_hari_kerja_efektif_m');
        
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. Hari Kerja Efektif - Admin ";
			$data['content']	= "ref_hari_kerja_efektif/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_hari_kerja_efektif";
			$data['item'] = $this->ref_hari_kerja_efektif_m->get_all();
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
    }
    

	public function edit(){
			$data['title']		= "Edit Ref. Hari Kerja Efektif - Admin ";
			$data['content']	= "ref_hari_kerja_efektif/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_hari_kerja_efektif";

			if(!empty($_POST)){
                foreach($_POST as $k => $p){
                    $this->db->update('ref_hari_kerja_efektif',array('jumlah'=>$p),array('id_bulan'=>$k));
                }
                $data['message_type'] = 'success';
                $data['message'] = '<i class="ti ti-check"></i> Jumlah Hari Kerja Efektif berhasil diubah';
			}

			$data['item'] = $this->ref_hari_kerja_efektif_m->get_all();
			$this->load->view('admin/index',$data);
	}
}
?>