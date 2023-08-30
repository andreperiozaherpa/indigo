<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen_rapat extends CI_Controller
{

    public $user_id;

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
        $this->load->model('ref_unit_kerja_model');
        $this->load->model('rapat_model');
        $this->load->model('master_pegawai_model');
        if ($this->user_level == "Admin Web");
        // $this->load->model('ref_pekerjaan_model','ref_pekerjaan_m');
    }
    public function index()
    {
        if ($this->user_id) {
            $data['title']        = "Manajemen Jadwal Rapat";
            $data['content']    = "manajemen_rapat/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "manajemen_rapat";

            $data_filter = [];
            if(!empty($_GET['tema_rapat']) && is_string($_GET['tema_rapat'])){
                $data_filter['tema_rapat'] = $_GET['tema_rapat'];
            }
            if(!empty($_GET['tanggal_awal']) && is_string($_GET['tema_rapat'])){
                $data_filter['tanggal_awal'] = $_GET['tanggal_awal'];
            }
            if(!empty($_GET['tanggal_akhir']) && is_string($_GET['tema_rapat'])){
                $data_filter['tanggal_akhir'] = $_GET['tanggal_akhir'];
            }
            $data['filter'] = $data_filter;
            $data['list'] = $this->rapat_model->get_all(true,$data_filter);

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function add()
    {
        if ($this->user_id) {
            $data['title']        = "Buat Jadwal Rapat";
            $data['content']    = "manajemen_rapat/add";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "manajemen_rapat";

            $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd(231);

            if (!empty($_POST)) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('tema_rapat', 'Tema Rapat', 'required');
                $this->form_validation->set_rules('deskripsi_rapat', 'Deskripsi Rapat', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pelaksanaan', 'required');
                $this->form_validation->set_rules('jam', 'Jam Mulai', 'required');
                $this->form_validation->set_rules('jenis_rapat', 'Jenis Rapat', 'required|in_list[online,offline]');
                $this->form_validation->set_rules('list_peserta[]', 'Daftar Peserta', 'required');
                $this->form_validation->set_message('required', '{field} harus diisi');
                if ($this->form_validation->run() !== FALSE) {
                    $data_insert = [
                        'tema_rapat' => $_POST['tema_rapat'],
                        'deskripsi_rapat' => $_POST['deskripsi_rapat'],
                        'tanggal' => $_POST['tanggal'],
                        'jam' => $_POST['jam'],
                        'jenis_rapat' => $_POST['jenis_rapat'],
                    ];

                    if ($data_insert['jenis_rapat'] == 'online') {
                        $data_insert['link_meeting'] = $_POST['link_meeting'];
                        if (isset($_POST['autentikasi'])) {
                            $data_insert['autentikasi'] = 'Y';
                            $data_insert['username'] = $_POST['username'];
                            $data_insert['password'] = $_POST['password'];
                        }
                    } elseif ($data_insert['jenis_rapat'] == 'offline') {
                        $data_insert['lokasi'] = $_POST['lokasi'];
                    }
                    $insert = $this->rapat_model->insert($data_insert);
                    if ($insert) {
                        $list_peserta = $_POST['list_peserta'];
                        foreach ($list_peserta as $l) {
                            $this->rapat_model->insert_peserta($insert, $l);
                        }
                        $_POST = [];
                        $data['message'] = 'Jadwal Rapat berhasil disimpan';
                        $data['type'] = 'success';
                    } else {
                        $data['message'] = 'Terjadi kesalahan';
                        $data['type'] = 'danger';
                    }
                    // $this->load->view('myform');
                    // print_r(validation_errors());
                    // die;
                }
            }

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function edit($id_rapat)
    {
        if ($this->user_id) {
            $data['title']        = "Edit Jadwal Rapat";
            $data['content']    = "manajemen_rapat/edit";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "manajemen_rapat";

            $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd(231);

            if (!empty($_POST)) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('tema_rapat', 'Tema Rapat', 'required');
                $this->form_validation->set_rules('deskripsi_rapat', 'Deskripsi Rapat', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pelaksanaan', 'required');
                $this->form_validation->set_rules('jam', 'Jam Mulai', 'required');
                $this->form_validation->set_rules('jenis_rapat', 'Jenis Rapat', 'required|in_list[online,offline]');
                $this->form_validation->set_rules('list_peserta[]', 'Daftar Peserta', 'required');
                $this->form_validation->set_message('required', '{field} harus diisi');
                if ($this->form_validation->run() !== FALSE) {
                    $data_update = [
                        'tema_rapat' => $_POST['tema_rapat'],
                        'deskripsi_rapat' => $_POST['deskripsi_rapat'],
                        'tanggal' => $_POST['tanggal'],
                        'jam' => $_POST['jam'],
                        'jenis_rapat' => $_POST['jenis_rapat'],
                    ];

                    if ($data_update['jenis_rapat'] == 'online') {
                        $data_update['link_meeting'] = $_POST['link_meeting'];
                        if (isset($_POST['autentikasi'])) {
                            $data_update['autentikasi'] = 'Y';
                            $data_update['username'] = $_POST['username'];
                            $data_update['password'] = $_POST['password'];
                        }
                    } elseif ($data_update['jenis_rapat'] == 'offline') {
                        $data_update['lokasi'] = $_POST['lokasi'];
                    }
                    $update = $this->rapat_model->update($data_update, $id_rapat);
                    if ($update) {
                        $list_peserta = $_POST['list_peserta'];
                        foreach ($list_peserta as $l) {
                            $this->rapat_model->clear_peserta($id_rapat);
                            $this->rapat_model->insert_peserta($id_rapat, $l);
                        }
                        $data['message'] = 'Jadwal Rapat berhasil diperbaharui';
                        $data['type'] = 'success';
                    } else {
                        $data['message'] = 'Terjadi kesalahan';
                        $data['type'] = 'danger';
                    }
                    // $this->load->view('myform');
                    // print_r(validation_errors());
                    // die;
                }
            }

            $data['notulensi'] = $this->rapat_model->get_notulen($id_rapat);
            $data['detail'] = $this->rapat_model->get_by_id($id_rapat);
            $data['peserta'] = $this->rapat_model->get_peserta($id_rapat);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function detail($id_rapat)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Jadwal Rapat";
            $data['content']    = "manajemen_rapat/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "manajemen_rapat";

            $data['detail'] = $this->rapat_model->get_by_id($id_rapat);
            $data['peserta'] = $this->rapat_model->get_peserta($id_rapat);

            if (!empty($_POST)) {
                $method = $_POST['method'];
                if ($method == 'update_notulen') {
                    $notulensi = $_POST['notulensi'];
                    $error_upload = false;
                    if (!empty($_FILES['lampiran']['name'])) {
                        $config = array(
                            'upload_path' => "./data/lampiran_rapat/",
                            'allowed_types' => "jpeg|zip|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                            'overwrite' => TRUE,
                            'max_size' => "50480000"
                        );
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('lampiran')) {
                            $lampiran =  $this->upload->data('file_name');
                        } else {
                            $data['message'] =  $this->upload->display_errors();
                            $data['type'] = 'danger';
                            $error_upload = true;
                        }
                    } else {
                        $lampiran = NULL;
                    }

                    if (!$error_upload) {
                        $save_notulensi = $this->rapat_model->save_notulen($id_rapat, $notulensi, $lampiran);
                        if ($save_notulensi) {
                            $data['message'] =  'Notulensi berhasil diupdate';
                            $data['type'] = 'success';
                        }
                    }
                }
            }

            $data['notulensi'] = $this->rapat_model->get_notulen($id_rapat);

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function delete($id_rapat=''){
        if($id_rapat!==''){
            $delete = $this->rapat_model->delete($id_rapat);
            if($delete){
                redirect('manajemen_rapat');
            }else{
                redirect('manajemen_rapat/detail/'.$id_rapat);
            }
        }
    }
}
