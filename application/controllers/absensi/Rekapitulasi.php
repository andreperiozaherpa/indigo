<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller
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
    }

    public function index()
    {
        if (!$this->user_id) {
            redirect("admin");
        }
        $data['title']        = "Presensi - Rekapitulasi";
        $data['content']    = "absensi/rekapitulasi";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;


        $param = array();

        $bulan = date("m");
        $tahun = date("Y");

        //var_dump( $this->session->userdata("id_pegawai"));

        $param['where']['id_pegawai'] = $this->session->userdata("id_pegawai");

        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }

        $download = $this->input->get("download", true);
        if ($download) {
            $user = $this->db->where("user_id", $this->user_id)->get("user")->row();
            $url = "http://localhost/absensi/rekapitulasi/generate_download/$bulan/$tahun/$user->api_key";
            $path = "data/absen/rekapitulasi/" . $user->api_key . ".pdf";
            exec("xvfb-run -a wkhtmltopdf $url " . FCPATH . "$path");
            redirect($path);
        } else {

            $param['where']['month(tanggal)'] = $bulan;
            $param['where']['year(tanggal)'] = $tahun;

            $data['dt_log'] = $this->absen_model->get_log($param)->result();

            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;

            $data['log_absen'] = $this->absen_model->get_ket_log_pegawai($param['where']['id_pegawai'],$bulan,$tahun);
            // print_r($data['log_absen']);die;

            function cmp($a, $b){
                $ad = strtotime($a->tanggal);
                $bd = strtotime($b->tanggal);
                return ($ad-$bd);
            }
            $arr = array_merge($data['dt_log'], $data['log_absen'] );
            usort($arr, 'cmp');

            // print_r($arr);die;

            $data['dt_log'] = $arr;
            //echo "<pre>";print_r($data['dt_log']);die;

            $summary = $this->absen_model->get_log_summary($param)->row();
            if ($summary) {
                $data['masuk_telat'] = $summary->total_masuk_telat;
                $data['pulang_cepat'] = $summary->total_pulang_cepat;
                $data['waktu_kerja'] = $summary->total_waktu_kerja;
            }
            //echo "<pre>";print_r($data);die;
            $this->load->view('admin/index', $data);
        }
    }

    public function download($bulan = null, $tahun = null)
    {
        if (!$this->user_id) {
            redirect("admin");
        }

        $user = $this->db->where("user_id", $this->user_id)->get("user")->row();


        if ($bulan == null || $tahun == null || !$user) {
            show_404();
        }



        $url = "http://localhost/absensi/rekapitulasi/generate_download/$bulan/$tahun/$user->api_key";
        $path = "data/absen/rekapitulasi/" . $user->api_key . ".pdf";
        exec("xvfb-run -a wkhtmltopdf $url " . FCPATH . "$path");
        redirect($path);
    }

    public function generate_download($bulan = null, $tahun = null, $api_key = null, $id_pegawai = null)
    {
        if ($bulan != null && $tahun != null && ($api_key != null || $id_pegawai !== null)) {

            $this->load->model("user_model");
            $user = $this->user_model->checkApiKey($api_key);

            $param = array();
            if ($user) {
                $param['where']['id_pegawai'] = $user->id_pegawai;
            } else{
                if ($id_pegawai !== null) {
                    $param['where']['id_pegawai'] = base64_decode(urldecode($id_pegawai));
                    $this->load->model('master_pegawai_model');
                    $user = $this->master_pegawai_model->get_by_id($param['where']['id_pegawai']);
                } else {
                    $param['where']['id_pegawai'] = null;
                }
            }

            if(isset($_GET['testing'])){
                print_r($user);die;
            }

            $param['where']['month(tanggal)'] = $bulan;
            $param['where']['year(tanggal)'] = $tahun;

            $data = array(
                'title'     => 'Download Rekapitulasi Absen'
            );
            $data['user'] = $user;
            $data['dt_log'] = $this->absen_model->get_log($param)->result();

            $data['log_absen'] = $this->absen_model->get_ket_log_pegawai($param['where']['id_pegawai'],$bulan,$tahun);
            // print_r($data['log_absen']);die;

            function cmp($a, $b){
                $ad = strtotime($a->tanggal);
                $bd = strtotime($b->tanggal);
                return ($ad-$bd);
            }
            $arr = array_merge($data['dt_log'], $data['log_absen'] );
            usort($arr, 'cmp');

            // print_r($arr);die;

            $data['dt_log'] = $arr;

            if (!empty($data['dt_log'])) {
                $data['bulan'] = date("M", strtotime(date("Y") . "-" . $bulan . "-01"));
                $data['tahun'] = $tahun;

                $this->load->view('admin/absensi/download', $data);
            }
        }
    }

    public function test_download()
    {

        //echo "test";die;
        $url = "https://www.google.com/";
        $path = "data/absen/rekapitulasi/google.pdf";
        exec("xvfb-run -a wkhtmltopdf $url " . FCPATH . "$path");
        redirect($path);
    }
}
