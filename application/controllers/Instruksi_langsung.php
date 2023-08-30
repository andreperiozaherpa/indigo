<?php
class Instruksi_langsung extends CI_Controller
{

    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->load->model('master_pegawai_model');
        // $this->load->model('instruksi_langsung_model');
        $this->load->model('ref_hari_kerja_efektif_model');
        $this->load->model('ref_skpd_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;
        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        //$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
    }
    public function index()
    {

        if ($this->user_id) {
            $data['title']        = "Instruksi Langsung";
            $data['content']    = "instruksi_langsung/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "instruksi_langsung";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function detail()
    {
        if ($this->user_id) {
            $data['title']        = "Instruksi Langsung";
            $data['content']    = "instruksi_langsung/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "instruksi_langsung";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
}
