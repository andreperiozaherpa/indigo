<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
        $this->id_skpd = $this->session->userdata('id_skpd');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("kinerja/Skp_model");

        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));

        $this->pegawai = $dt_pegawai;

	}

    public function index()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Skp_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "SKP berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus SKP";
                    }
                
                echo json_encode($data);
            }           
        }
    }
    
}