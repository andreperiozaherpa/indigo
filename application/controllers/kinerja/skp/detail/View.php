<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("kinerja/Config");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("sicerdas/Globalvar");
        
	}


    public function index()
    {
        $token = $this->input->get("token");


        $data['title']		    = 'Detail SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/detail/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "detail_skp";

        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }

        $data['detail'] = $detail;

        $data['token']  = $token;

        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));

        $data['role_pimpinan']  = $role_pimpinan;

        $this->load->view('admin/main', $data);
    }
    
}