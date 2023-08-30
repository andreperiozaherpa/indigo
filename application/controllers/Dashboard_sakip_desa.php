<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_sakip_desa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;

        $this->load->model("absen_model");
        $this->load->model("ref_ket_absen_model");
        $this->load->model("master_pegawai_model");
        $this->load->model("tpp/tpp_model");
        $this->load->model("tpp/tpp_perhitungan_model");
        $this->load->model("laporan_kinerja_harian_model");
        $this->load->model('ref_hari_kerja_efektif_model');
    }

    public function index(){
        $data['title']        = "SAKIP Desa";
        $data['content']    = "perbaikan";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;
        $this->load->view('admin/index', $data);
    }
}