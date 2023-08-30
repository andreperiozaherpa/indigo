<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_dewan extends CI_Controller
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
        $this->load->model('kegiatan_dewan_model');
        $this->load->model('master_pegawai_model');
        if ($this->user_level == "Admin Web");
        // $this->load->model('ref_pekerjaan_model','ref_pekerjaan_m');
    }
    public function index()
    {
        if ($this->user_id) {
            $data['title']        = "Manajemen Catatan Kegiatan";
            $data['content']    = "kegiatan_dewan/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "kegiatan_dewan";

            $data_filter = [];
            if (!empty($_GET['nama_kegiatan']) && is_string($_GET['nama_kegiatan'])) {
                $data_filter['nama_kegiatan'] = $_GET['nama_kegiatan'];
            }
            if (!empty($_GET['tanggal_awal']) && is_string($_GET['nama_kegiatan'])) {
                $data_filter['tanggal_awal'] = $_GET['tanggal_awal'];
            }
            if (!empty($_GET['tanggal_akhir']) && is_string($_GET['nama_kegiatan'])) {
                $data_filter['tanggal_akhir'] = $_GET['tanggal_akhir'];
            }
            $data['filter'] = $data_filter;
            $data['list'] = $this->kegiatan_dewan_model->get_all(true, $data_filter);

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function add()
    {
        if ($this->user_id) {
            $data['title']        = "Buat Catatan Kegiatan";
            $data['content']    = "kegiatan_dewan/add";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "kegiatan_dewan";

            $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd(231);

            if (!empty($_POST)) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
                $this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pelaksanaan', 'required');
                $this->form_validation->set_rules('lokasi', 'Lokasi Pelaksanaan', 'required');
                $this->form_validation->set_rules('list_peserta[]', 'Daftar Peserta', 'required');
                $this->form_validation->set_message('required', '{field} harus diisi');
                if ($this->form_validation->run() !== FALSE) {
                    $data_insert = [
                        'nama_kegiatan' => $_POST['nama_kegiatan'],
                        'deskripsi_kegiatan' => $_POST['deskripsi_kegiatan'],
                        'tanggal' => $_POST['tanggal']
                    ];
                    $data_insert['lokasi'] = $_POST['lokasi'];


                    $error_upload_lampiran = false;
                    if (!empty($_FILES['lampiran']['name'])) {
                        $config = array(
                            'upload_path' => "./data/lampiran_kegiatan_dewan/",
                            'allowed_types' => "jpeg|zip|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                            'overwrite' => FALSE,
                            'max_size' => "50480000"
                        );
                        $this->load->library('upload', $config, 'upload_lampiran');
                        if ($this->upload_lampiran->do_upload('lampiran')) {
                            $data_insert['lampiran'] =  $this->upload_lampiran->data('file_name');
                        } else {
                            $data['message'] =  $this->upload_lampiran->display_errors();
                            $data['type'] = 'danger';
                            $error_upload_lampiran = true;
                        }
                    }


                    $error_upload_foto = false;
                    if (!empty($_FILES['foto_kegiatan']['name'])) {
                        $config = array(
                            'upload_path' => "./data/foto_kegiatan_dewan/",
                            'allowed_types' => "jpeg|zip|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                            'overwrite' => FALSE,
                            'max_size' => "50480000"
                        );
                        $this->load->library('upload', $config, 'upload_foto');
                        if ($this->upload_foto->do_upload('foto_kegiatan')) {
                            $data_insert['foto_kegiatan'] =  $this->upload_foto->data('file_name');
                        } else {
                            $data['message'] =  $this->upload_foto->display_errors();
                            $data['type'] = 'danger';
                            $error_upload_foto = true;
                        }
                    }


                    if (!$error_upload_lampiran && !$error_upload_foto) {
                        $insert = $this->kegiatan_dewan_model->insert($data_insert);
                        if ($insert) {
                            $list_peserta = $_POST['list_peserta'];
                            foreach ($list_peserta as $l) {
                                $this->kegiatan_dewan_model->insert_peserta($insert, $l);
                            }
                            $_POST = [];
                            $data['message'] = 'Catatan Kegiatan berhasil disimpan';
                            $data['type'] = 'success';
                            redirect('kegiatan_dewan/detail/' . $insert);
                        } else {
                            $data['message'] = 'Terjadi kesalahan';
                            $data['type'] = 'danger';
                        }
                    }
                }
            }

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function edit($id_kegiatan_dewan)
    {
        if ($this->user_id) {
            $data['title']        = "Edit Catatan Kegiatan";
            $data['content']    = "kegiatan_dewan/edit";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "kegiatan_dewan";

            $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd(231);

            if (!empty($_POST)) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
                $this->form_validation->set_rules('deskripsi_kegiatan', 'Deskripsi Kegiatan', 'required');
                $this->form_validation->set_rules('tanggal', 'Tanggal Pelaksanaan', 'required');
                $this->form_validation->set_rules('list_peserta[]', 'Daftar Peserta', 'required');
                $this->form_validation->set_message('required', '{field} harus diisi');
                if ($this->form_validation->run() !== FALSE) {
                    $data_update = [
                        'nama_kegiatan' => $_POST['nama_kegiatan'],
                        'deskripsi_kegiatan' => $_POST['deskripsi_kegiatan'],
                        'tanggal' => $_POST['tanggal']
                    ];

                    $data_update['lokasi'] = $_POST['lokasi'];
                    $update = $this->kegiatan_dewan_model->update($data_update, $id_kegiatan_dewan);
                    if ($update) {
                        $list_peserta = $_POST['list_peserta'];
                        foreach ($list_peserta as $l) {
                            $this->kegiatan_dewan_model->clear_peserta($id_kegiatan_dewan);
                            $this->kegiatan_dewan_model->insert_peserta($id_kegiatan_dewan, $l);
                        }
                        $data['message'] = 'Catatan Kegiatan berhasil diperbaharui';
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

            $data['notulensi'] = $this->kegiatan_dewan_model->get_notulen($id_kegiatan_dewan);
            $data['detail'] = $this->kegiatan_dewan_model->get_by_id($id_kegiatan_dewan);
            $data['peserta'] = $this->kegiatan_dewan_model->get_peserta($id_kegiatan_dewan);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function detail($id_kegiatan_dewan)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Catatan Kegiatan";
            $data['content']    = "kegiatan_dewan/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "kegiatan_dewan";

            $data['detail'] = $this->kegiatan_dewan_model->get_by_id($id_kegiatan_dewan);
            $data['peserta'] = $this->kegiatan_dewan_model->get_peserta($id_kegiatan_dewan);

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function delete($id_kegiatan_dewan = '')
    {
        if ($id_kegiatan_dewan !== '') {
            $delete = $this->kegiatan_dewan_model->delete($id_kegiatan_dewan);
            if ($delete) {
                redirect('kegiatan_dewan');
            } else {
                redirect('kegiatan_dewan/detail/' . $id_kegiatan_dewan);
            }
        }
    }
}
