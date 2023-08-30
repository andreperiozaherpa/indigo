<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;
use Dompdf\Options;
use Dompdf\Dompdf;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();


include APPPATH . 'third_party/pe/PHPExcel.php';
include_once(APPPATH . "third_party/pe/PHPExcel.php");


defined('BASEPATH') or exit('No direct script access allowed');

class Perjalanan_dinas extends CI_Controller
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
        $this->load->model('perjalanan_dinas_model');
        if ($this->user_level == "Admin Web");
        // $this->load->model('ref_pekerjaan_model','ref_pekerjaan_m');
    }
    public function index()
    {
        if ($this->user_id) {
            $data['title']        = "Usulan Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            $data['list'] = $this->perjalanan_dinas_model->get_all();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function verifikasi()
    {
        if ($this->user_id) {
            $data['title']        = "Verifikasi Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            $data['list'] = $this->perjalanan_dinas_model->get_all();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function ttd()
    {
        if ($this->user_id) {
            $data['title']        = "Pengaturan Penandatangan ";
            $data['content']    = "perjalanan_dinas/ttd";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            if (!empty($_POST)) {
                $data_update = $_POST;
                foreach ($data_update as $k => $v) {
                    $ex = explode('_', $k);
                    $id_perjalanan_dinas_ttd = trim($ex[1]);
                    $this->db->update('perjalanan_dinas_ttd', array('id_pegawai' => $v), array('id_perjalanan_dinas_ttd' => $id_perjalanan_dinas_ttd));
                }
                $data['message'] = '<i class="ti-check"></i> Penandatangan berhasil disimpan';
                $data['message_type'] = 'success';
            }
            $data['list'] = $this->perjalanan_dinas_model->get_all_ttd();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function add()
    {
        if ($this->user_id) {
            $data['title']        = "Tambah Usulan Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/add";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            if (!empty($_POST)) {
                $data_insert = $_POST;
                $waktu = $_POST['jenis_waktu'];
                $perjalanan = $_POST['jenis_perjalanan'];
                if ($waktu == 'single') {
                    $data_insert['tanggal_awal'] = $_POST['tanggal_pelaksanaan'];
                }
                if ($perjalanan == "biasa") {
                    $data_insert['kode_rekening'] = '5.1.02.04.01.000';
                } else {
                    $data_insert['kode_rekening'] = '5.1.02.04.02.000';
                }
                unset($data_insert['tanggal_pelaksanaan']);
                unset($data_insert['id_pegawai']);
                unset($data_insert['no_sp']);
                unset($data_insert['tanggal_sp']);
                unset($data_insert['volume_uh']);
                unset($data_insert['nominal_uh']);
                unset($data_insert['volume_bp']);
                unset($data_insert['nominal_bp']);
                unset($data_insert['jenis_pegawai']);
                unset($data_insert['koordinator']);
                unset($data_insert['nama_pegawai']);
                unset($data_insert['nama_jabatan']);
                unset($data_insert['id_pegawai_atasan']);

                $data_insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
                // $data_insert['id_pegawai_input'] = $this->session->userdata('id_pegawai');
                $data_insert['tanggal'] = date('Y-m-d H:i:s');

                $insert = $this->perjalanan_dinas_model->insert($data_insert);

                $list_pegawai = $_POST['no_sp'];
                $this->perjalanan_dinas_model->clear_pembiayaan($insert);
                foreach ($list_pegawai as $k => $v) {
                    $id_pegawai = $_POST['id_pegawai'][$k];
                    $volume_uh = $_POST['volume_uh'][$k];
                    $no_sp = $_POST['no_sp'][$k];
                    $tanggal_sp = $_POST['tanggal_sp'][$k];
                    $nominal_uh = $_POST['nominal_uh'][$k];
                    $volume_bp = $_POST['volume_bp'][$k];
                    $nominal_bp = $_POST['nominal_bp'][$k];
                    $data_insert_pembiayaan = array('volume_uh' => $volume_uh, 'no_sp' => $no_sp, 'tanggal_sp' => $tanggal_sp, 'nominal_uh' => $nominal_uh, 'volume_bp' => $volume_bp, 'nominal_bp' => $nominal_bp);

                    if ($_POST['jenis_pegawai'][$k] == 'Y') {
                        $jenis_pegawai = 'non_pns';
                        $data_insert_pembiayaan['nama_pegawai'] = $id_pegawai;
                        $data_insert_pembiayaan['nama_jabatan'] = $_POST['nama_jabatan'][$k];
                        $data_insert_pembiayaan['id_pegawai_atasan'] = $_POST['id_pegawai_atasan'][$k];
                    } else {
                        $data_insert_pembiayaan['id_pegawai'] = $id_pegawai;
                        $jenis_pegawai = 'pns';
                    }
                    if ($_POST['koordinator'][$k] == "Y") {
                        $is_koordinator = 'Y';
                    } else {
                        $is_koordinator = 'N';
                    }

                    $data_insert_pembiayaan['jenis_pegawai'] = $jenis_pegawai;
                    $data_insert_pembiayaan['is_koordinator'] = $is_koordinator;
                    $in = $this->perjalanan_dinas_model->insert_pembiayaan($data_insert_pembiayaan, $insert);
                }



                if ($insert) {
                    $data['message'] = '<i class="ti-check"></i> Perjalanan Dinas berhasil ditambahkan, <a target="blank" href="' . base_url('perjalanan_dinas/detail/' . $insert) . '">Klik Disini</a> untuk melihat detail';
                    $data['message_type'] = 'success';
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }


            $this->db->group_start();
            $this->db->where('level_unit_kerja', 1);
            $this->db->or_where('level_unit_kerja', 2);
            $this->db->group_end();
            $data['bagian'] = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->result();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function detail($id_perjalanan_dinas)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            if (!empty($_POST)) {
                $type = $_POST['type'];
                if ($type == 'pembiayaan') {
                    $data_update = array('biaya_transport' => $_POST['biaya_transport'], 'jenis_transportasi' => $_POST['jenis_transportasi']);
                    $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);
                    // print_r($_POST);die;
                    if ($update) {
                        $list_pegawai = $_POST['id_pegawai'];
                        // print_r($list_pegawai);die;
                        $this->perjalanan_dinas_model->clear_pembiayaan($id_perjalanan_dinas);
                        foreach ($list_pegawai as $k => $v) {
                            $volume_uh = $_POST['volume_uh'][$k];
                            $nominal_uh = $_POST['nominal_uh'][$k];
                            $volume_bp = $_POST['volume_bp'][$k];
                            $nominal_bp = $_POST['nominal_bp'][$k];
                            $data_insert_pembiayaan = array('id_pegawai' => $v, 'volume_uh' => $volume_uh, 'nominal_uh' => $nominal_uh, 'volume_bp' => $volume_bp, 'nominal_bp' => $nominal_bp);
                            $in = $this->perjalanan_dinas_model->insert_pembiayaan($data_insert_pembiayaan, $id_perjalanan_dinas);
                        }
                        $data['message_pembiayaan'] = 'Pembiayaan berhasil disimpan';
                        $data['message_type_pembiayaan'] = 'success';
                    } else {
                        $data['message_pembiayaan'] = 'Terjadi Kesalahan';
                        $data['message_type_pembiayaan'] = 'danger';
                    }
                } elseif ($type == 'file') {
                    $files = $_FILES['path'];
                    $config['upload_path']          = './data/file_pendukung_perjalanan_dinas/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|zip|rar|xls|xlsx|ppt|pptx|doc|docx';
                    $config['max_size']             = 2000;
                    $config['max_width']            = 2000;
                    $config['max_height']           = 2000;
                    $this->load->library('upload', $config);
                    $images = array();
                    // print_r($_POST['nama_file']);
                    // print_r($files);
                    // die;
                    foreach ($files['name'] as $key => $image) {
                        $_FILES['path[]']['name'] = $files['name'][$key];
                        $_FILES['path[]']['type'] = $files['type'][$key];
                        $_FILES['path[]']['tmp_name'] = $files['tmp_name'][$key];
                        $_FILES['path[]']['error'] = $files['error'][$key];
                        $_FILES['path[]']['size'] = $files['size'][$key];
                        $fileName = 'file_' . time() . rand(0, 9999);
                        $images[] = $files['name'][$key];
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('path[]')) {
                            $this->upload->data();
                            $data_insert_file = array('nama_file' => $_POST['nama_file'][$key], 'path' => $this->upload->data('file_name'), 'tanggal_upload' => date('Y-m-d H:i:s'));
                            // print_r($data_insert_file);
                            $in = $this->perjalanan_dinas_model->insert_file($data_insert_file, $id_perjalanan_dinas);
                        } else {
                            $data['message_type_file']  =  'danger';
                            $data['message_file'] = $this->upload->display_errors();
                        }
                    }
                }
            }
            $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
            $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
            $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
            $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();

            $data['files'] = $this->perjalanan_dinas_model->get_files($id_perjalanan_dinas);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }


    public function edit($jenis = "informasi", $id_perjalanan_dinas)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/edit_" . $jenis;
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";



            if (!empty($_POST)) {
                $data_insert = $_POST;
                unset($data_insert['id_pegawai']);
                unset($data_insert['no_sp']);
                unset($data_insert['tanggal_sp']);
                unset($data_insert['volume_uh']);
                unset($data_insert['nominal_uh']);
                unset($data_insert['volume_bp']);
                unset($data_insert['nominal_bp']);
                unset($data_insert['jenis_pegawai']);
                unset($data_insert['koordinator']);
                unset($data_insert['nama_pegawai']);
                unset($data_insert['nama_jabatan']);
                unset($data_insert['id_pegawai_atasan']);

                $data_update = array('biaya_transport' => $_POST['biaya_transport'], 'jenis_transportasi' => $_POST['jenis_transportasi'], 'uang_refresentasi' => $_POST['uang_refresentasi']);
                $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);

                $list_pegawai = $_POST['no_sp'];
                $this->perjalanan_dinas_model->clear_pembiayaan($id_perjalanan_dinas);
                foreach ($list_pegawai as $k => $v) {
                    $id_pegawai = $_POST['id_pegawai'][$k];
                    $volume_uh = $_POST['volume_uh'][$k];
                    $no_sp = $_POST['no_sp'][$k];
                    $tanggal_sp = $_POST['tanggal_sp'][$k];
                    $nominal_uh = $_POST['nominal_uh'][$k];
                    $volume_bp = $_POST['volume_bp'][$k];
                    $nominal_bp = $_POST['nominal_bp'][$k];
                    $data_insert_pembiayaan = array('volume_uh' => $volume_uh, 'no_sp' => $no_sp, 'tanggal_sp' => $tanggal_sp, 'nominal_uh' => $nominal_uh, 'volume_bp' => $volume_bp, 'nominal_bp' => $nominal_bp);

                    if ($_POST['jenis_pegawai'][$k] == 'Y') {
                        $jenis_pegawai = 'non_pns';
                        $data_insert_pembiayaan['nama_pegawai'] = $id_pegawai;
                        $data_insert_pembiayaan['nama_jabatan'] = $_POST['nama_jabatan'][$k];
                        $data_insert_pembiayaan['id_pegawai_atasan'] = $_POST['id_pegawai_atasan'][$k];
                    } else {
                        $data_insert_pembiayaan['id_pegawai'] = $id_pegawai;
                        $jenis_pegawai = 'pns';
                    }
                    if ($_POST['koordinator'][$k] == "Y") {
                        $is_koordinator = 'Y';
                    } else {
                        $is_koordinator = 'N';
                    }

                    $data_insert_pembiayaan['jenis_pegawai'] = $jenis_pegawai;
                    $data_insert_pembiayaan['is_koordinator'] = $is_koordinator;
                    $in = $this->perjalanan_dinas_model->insert_pembiayaan($data_insert_pembiayaan, $id_perjalanan_dinas);
                }



                if ($update) {
                    $data['message'] = '<i class="ti-check"></i> Perjalanan Dinas berhasil disimpan';
                    $data['message_type'] = 'success';
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
            $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
            $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
            $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }


    public function edit_verifikasi($jenis = "informasi", $id_perjalanan_dinas)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/edit_" . $jenis;
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";
            $data['verifikasi'] = true;


            if (!empty($_POST)) {
                $data_insert = $_POST;
                unset($data_insert['id_pegawai']);
                unset($data_insert['no_sp']);
                unset($data_insert['tanggal_sp']);
                unset($data_insert['volume_uh']);
                unset($data_insert['nominal_uh']);
                unset($data_insert['volume_bp']);
                unset($data_insert['nominal_bp']);
                unset($data_insert['jenis_pegawai']);
                unset($data_insert['koordinator']);
                unset($data_insert['nama_pegawai']);
                unset($data_insert['nama_jabatan']);
                unset($data_insert['id_pegawai_atasan']);

                $data_update = array('kode_rekening' => $_POST['kode_rekening'], 'no_bku' => $_POST['no_bku'], 'biaya_transport' => $_POST['biaya_transport'], 'jenis_transportasi' => $_POST['jenis_transportasi'], 'uang_refresentasi' => $_POST['uang_refresentasi']);
                $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);

                $list_pegawai = $_POST['no_sp'];
                $this->perjalanan_dinas_model->clear_pembiayaan($id_perjalanan_dinas);
                foreach ($list_pegawai as $k => $v) {
                    $id_pegawai = $_POST['id_pegawai'][$k];
                    $volume_uh = $_POST['volume_uh'][$k];
                    $no_sp = $_POST['no_sp'][$k];
                    $tanggal_sp = $_POST['tanggal_sp'][$k];
                    $nominal_uh = $_POST['nominal_uh'][$k];
                    $volume_bp = $_POST['volume_bp'][$k];
                    $nominal_bp = $_POST['nominal_bp'][$k];
                    $data_insert_pembiayaan = array('volume_uh' => $volume_uh, 'no_sp' => $no_sp, 'tanggal_sp' => $tanggal_sp, 'nominal_uh' => $nominal_uh, 'volume_bp' => $volume_bp, 'nominal_bp' => $nominal_bp);

                    if ($_POST['jenis_pegawai'][$k] == 'Y') {
                        $jenis_pegawai = 'non_pns';
                        $data_insert_pembiayaan['nama_pegawai'] = $id_pegawai;
                        $data_insert_pembiayaan['nama_jabatan'] = $_POST['nama_jabatan'][$k];
                        $data_insert_pembiayaan['id_pegawai_atasan'] = $_POST['id_pegawai_atasan'][$k];
                    } else {
                        $data_insert_pembiayaan['id_pegawai'] = $id_pegawai;
                        $jenis_pegawai = 'pns';
                    }
                    if ($_POST['koordinator'][$k] == "Y") {
                        $is_koordinator = 'Y';
                    } else {
                        $is_koordinator = 'N';
                    }

                    $data_insert_pembiayaan['jenis_pegawai'] = $jenis_pegawai;
                    $data_insert_pembiayaan['is_koordinator'] = $is_koordinator;
                    $in = $this->perjalanan_dinas_model->insert_pembiayaan($data_insert_pembiayaan, $id_perjalanan_dinas);
                }



                if ($update) {
                    $data['message'] = '<i class="ti-check"></i> Perjalanan Dinas berhasil disimpan';
                    $data['message_type'] = 'success';
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
            $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
            $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
            $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function verifikasi_detail($id_perjalanan_dinas)
    {
        if ($this->user_id) {
            $data['title']        = "Detail Verifikasi Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/detail_verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            if (!empty($_POST)) {
                $type = $_POST['type'];
                if ($type == 'pembiayaan') {
                    $data_update = array('biaya_transport' => $_POST['biaya_transport'], 'jenis_transportasi' => $_POST['jenis_transportasi']);
                    $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);
                    if ($update) {
                        $list_pegawai = $_POST['id_pegawai'];
                        // print_r($list_pegawai);die;
                        $this->perjalanan_dinas_model->clear_pembiayaan($id_perjalanan_dinas);
                        foreach ($list_pegawai as $k => $v) {
                            $volume_uh = $_POST['volume_uh'][$k];
                            $nominal_uh = $_POST['nominal_uh'][$k];
                            $volume_bp = $_POST['volume_bp'][$k];
                            $nominal_bp = $_POST['nominal_bp'][$k];
                            $data_insert_pembiayaan = array('id_pegawai' => $v, 'volume_uh' => $volume_uh, 'nominal_uh' => $nominal_uh, 'volume_bp' => $volume_bp, 'nominal_bp' => $nominal_bp);
                            $in = $this->perjalanan_dinas_model->insert_pembiayaan($data_insert_pembiayaan, $id_perjalanan_dinas);
                        }
                        $data['message_pembiayaan'] = 'Pembiayaan berhasil disimpan';
                        $data['message_type_pembiayaan'] = 'success';
                    } else {
                        $data['message_pembiayaan'] = 'Terjadi Kesalahan';
                        $data['message_type_pembiayaan'] = 'danger';
                    }
                } elseif ($type == 'file') {
                    $files = $_FILES['path'];
                    $config['upload_path']          = './data/file_pendukung_perjalanan_dinas/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|zip|rar|xls|xlsx|ppt|pptx|doc|docx';
                    $config['max_size']             = 2000;
                    $config['max_width']            = 2000;
                    $config['max_height']           = 2000;
                    $this->load->library('upload', $config);
                    $images = array();
                    foreach ($files['name'] as $key => $image) {
                        $_FILES['path[]']['name'] = $files['name'][$key];
                        $_FILES['path[]']['type'] = $files['type'][$key];
                        $_FILES['path[]']['tmp_name'] = $files['tmp_name'][$key];
                        $_FILES['path[]']['error'] = $files['error'][$key];
                        $_FILES['path[]']['size'] = $files['size'][$key];
                        $fileName = 'file_' . time() . rand(0, 9999);
                        $images[] = $files['name'][$key];
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('path[]')) {
                            $this->upload->data();
                            $data_insert_file = array('nama_file' => $_POST['nama_file'][$key], 'path' => $this->upload->data('file_name'), 'tanggal_upload' => date('Y-m-d H:i:s'));
                            $in = $this->perjalanan_dinas_model->insert_file($data_insert_file, $id_perjalanan_dinas);
                        } else {
                            $data['message_type_file']  =  'danger';
                            $data['message_file'] = $this->upload->display_errors();
                        }
                    }
                } elseif ($type == 'sudah_dicairkan') {
                    $data_update = array('status_pencairan' => 'sudah_dicairkan', 'tanggal_pencairan' => $_POST['tanggal_pencairan']);
                    $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);
                    $data['message'] = 'Perjalanan Dinas berhasil disimpan';
                    $data['message_type'] = 'success';
                }
            }
            $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
            $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
            $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
            $data['files'] = $this->perjalanan_dinas_model->get_files($id_perjalanan_dinas);
            $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();
            $data['status_file'] = $this->perjalanan_dinas_model->cek_verifikasi_file($id_perjalanan_dinas);
            // var_dump($data['status_file']);die;

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function get_pegawai()
    {
        $search = $_GET['search'];
        $this->db->like('nip', $search);
        $this->db->or_like('nama_lengkap', $search);
        if ($this->user_level !== "Administrator") {
            $this->db->where('id_skpd', $this->session->userdata('id_skpd'));
        }
        $jabatan = $this->db->get('pegawai')->result();
        $list = array();
        foreach ($jabatan as $k => $j) {
            $list[$k]['id'] = $j->id_pegawai;
            $list[$k]['text'] = $j->nama_lengkap;
        }
        echo json_encode($list);
    }

    public function ajuan_rekap($jenis = 'non_ttd', $id_perjalanan_dinas)
    {
        $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        if (!empty($_POST['tanggal_titimangsa'])) {
            $tanggal_titimangsa = $_POST['tanggal_titimangsa'];
        } else {
            $tanggal_titimangsa = date('Y-m-d');
        }
        $data['jenis'] = $jenis;
        $data['tanggal_titimangsa'] = $tanggal_titimangsa;
        $filename = "Ajuan Perjalanan Dinas.pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_ajuan_rekap', $data, TRUE);
        // echo $html;die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }


    public function ajuan_rekap_bagian($id_unit_kerja, $bulan, $tahun, $list_id = array(),$jenis_perjalanan='')
    {
        $data['list'] = $this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun);

        if (!empty($list_id)) {
            foreach ($data['list'] as $k => $p) {
                if (!in_array($p->id_perjalanan_dinas, $list_id)) {
                    unset($data['list'][$k]);
                }
            }
        }

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['jenis_perjalanan'] = $jenis_perjalanan;

        $data['uk'] = $this->db->get_where('ref_unit_kerja', array('id_unit_kerja' => $id_unit_kerja))->row();
        // $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        // $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        // $data['jenis'] = $jenis;
        $filename = "Rekap Ajuan Perjalanan Dinas " . $data['uk']->nama_unit_kerja . ".pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_ajuan_rekap_bagian', $data, TRUE);
        // echo $html;die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }


    public function laporan_pegawai($id_pegawai, $bulan, $tahun)
    {
        $data['list'] = $this->perjalanan_dinas_model->get_by_pegawai($id_pegawai, $bulan, $tahun);


        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        // $data['uk'] = $this->db->get_where('ref_unit_kerja', array('id_unit_kerja' => $id_unit_kerja))->row();
        // // $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        // // $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        // $data['jenis'] = $jenis;
        $data['pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);
        $filename = "Rekap Ajuan Perjalanan Dinas " . $data['pegawai']->nama_lengkap . ".pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_laporan_pegawai', $data, TRUE);
        // echo $html;die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }



    public function buku_kas_umum($id_unit_kerja, $bulan, $tahun, $list_id = array())
    {
        $data['list'] = $this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun);

        if (!empty($list_id)) {
            foreach ($data['list'] as $k => $p) {
                if (!in_array($p->id_perjalanan_dinas, $list_id)) {
                    unset($data['list'][$k]);
                }
            }
        }
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['uk'] = $this->db->get_where('ref_unit_kerja', array('id_unit_kerja' => $id_unit_kerja))->row();
        // $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        // $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        // $data['jenis'] = $jenis;
        $filename = "Buku Kas Umum " . $data['uk']->nama_unit_kerja . ".pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_bku', $data, TRUE);
        // echo $html;
        // die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function buku_kas_umum_2($id_unit_kerja, $bulan, $tahun, $list_id = array())
    {
        $data['list'] = $this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun);

        if (!empty($list_id)) {
            foreach ($data['list'] as $k => $p) {
                if (!in_array($p->id_perjalanan_dinas, $list_id)) {
                    unset($data['list'][$k]);
                }
            }
        }
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        $data['uk'] = $this->db->get_where('ref_unit_kerja', array('id_unit_kerja' => $id_unit_kerja))->row();
        // $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        // $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        $filename = "Buku Kas Umum " . $data['uk']->nama_unit_kerja . " " . bulan($bulan) . " $tahun.xlsx";
        $excel = PHPExcel_IOFactory::load("./data/template_perjalanan_dinas/template_bku.xlsx");

        $style_row = array(
            'font' => array(
                'size' => 8
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );


        $style_row_jml = array(
            'font' => array(
                'size' => 8,
                'bold' => true
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $bold = array(
            'font' => array(
                'bold' => true
            )
        );

        $tengah = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('C7', ": " . strtoupper($data['uk']->nama_unit_kerja) . " Setda Kabupaten Sumedang");
        $excel->setActiveSheetIndex(0)->setCellValue('C8', ": " . $data['kabag']->nama_lengkap);
        $excel->setActiveSheetIndex(0)->setCellValue('C10', ": " . $data['bpp']->nama_lengkap);
        $excel->setActiveSheetIndex(0)->setCellValue('C11', ": " . $tahun);


        $no = 1;
        $numrow = 15;
        $t = 0;
        foreach ($data['list'] as $l) {
            $detail = $this->perjalanan_dinas_model->get_by_id($l->id_perjalanan_dinas);
            $pembiayaan = $this->perjalanan_dinas_model->get_pembiayaan($l->id_perjalanan_dinas);
            $jumlah_transport = 0;
            $jumlah_refresentasi = 0;
            $jumlah_uh = 0;
            $jumlah_total_uh = 0;
            $jumlah_bp = 0;
            $jumlah_total_bp = 0;
            $jumlah_total = 0;
            foreach ($pembiayaan as $k => $p) {
                $jumlah_uh += $p->nominal_uh;
                $jumlah_total_uh += ($p->nominal_uh * $p->volume_uh);
                $jumlah_bp += $p->nominal_bp;
                $jumlah_total_bp += ($p->nominal_bp * $p->volume_bp);
                if ($k == 0) {
                    $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh) + $detail->biaya_transport + $detail->uang_refresentasi;
                    $jumlah_transport += $detail->biaya_transport;
                    $jumlah_refresentasi += $detail->uang_refresentasi;
                } else {
                    $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh);
                }
                $jumlah_total += $total;
            }

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $l->deskripsi_kegiatan);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $l->kode_rekening);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $jumlah_total);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->getAlignment()->setWrapText(true);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
            $t += $jumlah_total;
        }

        $excel->setActiveSheetIndex(0)->mergeCells("A$numrow:D$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, "JUMLAH");
        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $t);

        $excel->getActiveSheet()->getStyle('A' . $numrow . ':' . 'D' . $numrow)->applyFromArray($style_row_jml);
        $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row_jml);
        $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row_jml);
        $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row_jml);
        $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row_jml);

        $numrow += 2;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("D$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "Kas di Bendahara Pengeluaran");
        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, "-");
        $numrow += 2;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("D$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "Terdiri dari");
        $numrow += 1;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("D$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "a. Tunai");
        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, "-");
        $numrow += 1;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("D$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "b. Saldo di bank");
        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, "-");
        $numrow += 1;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("D$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "c. Surat berharga");
        $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, "-");

        $numrow += 2;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("F$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "Mengetahui");
        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, "Sumedang, ".tanggal(date('Y-m-d')));
        $excel->getActiveSheet()->getStyle('B' . $numrow . ':F' . $numrow)->applyFromArray($tengah);
        $numrow += 1;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("F$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "Kuasa Pengguna Anggaran");
        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, "Bendahara Pengeluaran Pembantu");
        $excel->getActiveSheet()->getStyle('B' . $numrow . ':F' . $numrow)->applyFromArray($tengah);
        $numrow += 4;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("F$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data['kabag']->nama_lengkap);
        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data['bpp']->nama_lengkap);
        $excel->getActiveSheet()->getStyle('B' . $numrow . ':F' . $numrow)->applyFromArray($tengah);
        $excel->getActiveSheet()->getStyle('B' . $numrow . ':F' . $numrow)->applyFromArray($bold);
        $numrow += 1;
        $excel->setActiveSheetIndex(0)->mergeCells("B$numrow:C$numrow");
        $excel->setActiveSheetIndex(0)->mergeCells("F$numrow:H$numrow");
        $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, "NIP. " . $data['kabag']->nip);
        $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, "NIP. " . $data['bpp']->nip);
        $excel->getActiveSheet()->getStyle('B' . $numrow . ':F' . $numrow)->applyFromArray($tengah);

        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet(0)->setTitle("Buku Kas Umum");
        $excel->setActiveSheetIndex(0);

        ob_clean();
        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save("./data/template_perjalanan_dinas/draft/" . $filename);
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize("./data/template_perjalanan_dinas/draft/" . $filename));
        flush();
        readfile("./data/template_perjalanan_dinas/draft/" . $filename);
        unlink("./data/template_perjalanan_dinas/draft/" . $filename);
    }

    public function ceklis_pemeriksaan($id_perjalanan_dinas)
    {
        $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
        $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();
        $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $lkode = array('kabag', 'pptk', 'bendahara', 'bpp');
        foreach ($lkode as $l) {
            $data[$l] = $this->perjalanan_dinas_model->get_ttd($l);
        }
        $filename = "Ceklis Pemeriksaan.pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_ceklis_pemeriksaan', $data, TRUE);
        // echo $html;die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
    }



    public function fakta_integritas($id_perjalanan_dinas_pembiayaan)
    {
        $pembiayaan = $this->perjalanan_dinas_model->get_pembiayaan_by_id($id_perjalanan_dinas_pembiayaan);
        $perdin = $this->perjalanan_dinas_model->get_by_id($pembiayaan->id_perjalanan_dinas);
        $this->load->model('ref_skpd_model');
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getCompatibility()->setOoxmlVersion(14);
        $phpWord->getCompatibility()->setOoxmlVersion(15);
        // print_r($pembiayaan);die;
        if ($pembiayaan->jenis_pegawai_p == 'pns') {
            $skpd = $this->ref_skpd_model->get_by_id($pembiayaan->id_skpd);
            $nama_pegawai = $pembiayaan->nama_lengkap;
            $nip = $pembiayaan->nip;
            $pangkat = $pembiayaan->pangkat;
            $golongan = $pembiayaan->golongan;
            $jabatan = $pembiayaan->jabatan;
            $nama_skpd = $skpd->nama_skpd;
            $atasan_langsung = $pembiayaan->id_pegawai_atasan_langsung;
            $template_path = './data/template_perjalanan_dinas/template_fakta_integritas.docx';
        } else if ($pembiayaan->jenis_pegawai_p == 'non_pns') {
            $id_skpd = $this->db->get_where('ref_unit_kerja', array('id_unit_kerja' => $perdin->id_unit_kerja))->row()->id_skpd;
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_pegawai = $pembiayaan->nama_pegawai;
            $nip = '-';
            $pangkat = '-';
            $golongan = '';
            $jabatan = $pembiayaan->nama_jabatan;
            $nama_skpd = $skpd->nama_skpd;
            $atasan_langsung = $pembiayaan->id_pegawai_atasan;
            $template_path = './data/template_perjalanan_dinas/template_fakta_integritas_np.docx';
        }

        // print_r($atasan_langsung);die;
        $pegawai_atasan = $this->db->get_where('pegawai', array('id_pegawai' => $atasan_langsung))->row();
        $nama_pegawai_atasan = $pegawai_atasan->nama_lengkap;
        $nip_atasan = $pegawai_atasan->nip;
        $pangkat_atasan = $pegawai_atasan->pangkat;


        $filename = 'Fakta_Integritas_' . $nama_pegawai . '_' . time() . ".docx";
        $filename = str_replace(",", "", $filename);
        $filename = str_replace(" ", "_", $filename);

        $template = $phpWord->loadTemplate($template_path);

        $template->setValue('nama_pegawai', $nama_pegawai);
        $template->setValue('nip', $nip);
        $template->setValue('pangkat', $pangkat);
        $template->setValue('golongan', $golongan);
        $template->setValue('jabatan', $jabatan);
        $template->setValue('nama_skpd', $nama_skpd);
        $template->setValue('no_sp', $pembiayaan->no_sp);
        $template->setValue('tanggal_sp', tanggal($pembiayaan->tanggal_sp));
        $template->setValue('tanggal', tanggal(date('Y-m-d')));
        $template->setValue('nama_pegawai_atasan', $nama_pegawai_atasan);
        $template->setValue('nip_atasan', $nip_atasan);
        $template->setValue('pangkat_atasan', $pangkat_atasan);
        ob_clean();
        $template->saveAs("./data/temp_surat/" . $filename);
        // if(isset($_POST['download'])){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize("./data/temp_surat/" . $filename));
        flush();
        readfile("./data/temp_surat/" . $filename);
        unlink("./data/temp_surat/" . $filename);
    }


    public function bku()
    {

        if ($this->user_id) {
            $data['title']        = "Buku Kas Umum";
            $data['content']    = "perjalanan_dinas/bku";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            $bulan = date("m");
            $tahun = date("Y");
            $id_unit_kerja = '';

            if ($this->input->get("bulan")) {
                $bulan = $this->input->get("bulan", true);
            }

            if ($this->input->get("tahun")) {
                $tahun = $this->input->get("tahun", true);
            }
            if ($this->input->get("id_unit_kerja")) {
                $id_unit_kerja = $this->input->get("id_unit_kerja", true);
            }

            if (!empty($id_unit_kerja)) {
                $data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_id($id_unit_kerja);
            }


            $data['list'] = $this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun);

            if (!empty($list_id)) {
                foreach ($data['list'] as $k => $p) {
                    if (!in_array($p->id_perjalanan_dinas, $list_id)) {
                        unset($data['list'][$k]);
                    }
                }
            }
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['id_unit_kerja'] = $id_unit_kerja;
            //var_dump( $this->session->userdata("id_pegawai"));

            if (!empty($_POST)) {
                if (isset($_POST['action'])) {
                    $id_unit_kerja = $_POST['id_unit_kerja'];
                    $bln = $_POST['bln'];
                    $thn = $_POST['thn'];
                    $this->buku_kas_umum_2($id_unit_kerja, $bln, $thn, $_POST['id_perjalanan_dinas']);
                }
            }



            $this->db->group_start();
            $this->db->where('level_unit_kerja', 1);
            $this->db->or_where('level_unit_kerja', 2);
            $this->db->group_end();
            $data['bagian'] = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->result();


            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function bku_spj_detail($id_perjalanan_dinas)
    {

        if ($this->user_id) {
            $data['title']        = "Buku Kas Umum";
            $data['content']    = "perjalanan_dinas/bku_spj_detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";

            $data['detail'] = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
            $data['pembiayaan'] = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
            $data['file'] = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
            $data['ref_file'] = $this->perjalanan_dinas_model->get_ref_file();

            $data['files'] = $this->perjalanan_dinas_model->get_files($id_perjalanan_dinas);

            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function getBuktiSPJ($id_perjalanan_dinas)
    {

        $detail = $this->perjalanan_dinas_model->get_by_id($id_perjalanan_dinas);
        $pembiayaan = $this->perjalanan_dinas_model->get_pembiayaan($id_perjalanan_dinas);
        $file = $this->perjalanan_dinas_model->get_file($id_perjalanan_dinas);
        $ref_file = $this->perjalanan_dinas_model->get_ref_file();
        $files = $this->perjalanan_dinas_model->get_files($id_perjalanan_dinas);
        foreach ($file as $f) {
            echo '<div style="margin-bottom:20px;border:solid 1px #cdcdcd;padding:15px">
            <span class="text-purple" style="font-size:15px;font-weight:500;margin-bottom:20px">' . $f->nama_file . '</span>
            <iframe style="border:none" width="100%" height="700px" src="https://docs.google.​com/viewerng/viewer?url=' . base_url('data/file_pendukung_perjalanan_dinas/' . $f->path) . '&embedded=true"></iframe></div>';
        }
    }

    public function laporan($jenis = 'rekap')
    {
        if ($this->user_id) {
            $data['title']        = "Laporan Perjalanan Dinas ";
            $data['content']    = "perjalanan_dinas/laporan_" . $jenis;
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "perjalanan_dinas";


            $bulan = date("m");
            $tahun = date("Y");
            $id_unit_kerja = '';
            $jenis_perjalanan = '';

            if ($this->input->get("bulan")) {
                $bulan = $this->input->get("bulan", true);
            }

            if ($this->input->get("tahun")) {
                $tahun = $this->input->get("tahun", true);
            }
            if ($this->input->get("id_unit_kerja")) {
                $id_unit_kerja = $this->input->get("id_unit_kerja", true);
            }
            if ($this->input->get("jenis_perjalanan")) {
                $jenis_perjalanan = $this->input->get("jenis_perjalanan", true);
            }

            if (!empty($id_unit_kerja)) {
                $data['unit_kerja'] = $this->ref_unit_kerja_model->get_by_id($id_unit_kerja);
            }


            $data['list'] = $this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun,$jenis_perjalanan);
            if ($jenis == 'pegawai') {
                if (empty($id_unit_kerja)) {
                    $id_unit_kerja = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->row()->id_unit_kerja;
                }
                $data['pegawai'] = $this->perjalanan_dinas_model->list_pegawai($id_unit_kerja);
            }

            if (!empty($list_id)) {
                foreach ($data['list'] as $k => $p) {
                    if (!in_array($p->id_perjalanan_dinas, $list_id)) {
                        unset($data['list'][$k]);
                    }
                }
            }
            $data['tahun'] = $tahun;
            $data['bulan'] = $bulan;
            $data['id_unit_kerja'] = $id_unit_kerja;
            $data['jenis_perjalanan'] = $jenis_perjalanan;
            //var_dump( $this->session->userdata("id_pegawai"));

            // if (!empty($_POST)) {
            //     if (isset($_POST['action'])) {
            //         $id_unit_kerja = $_POST['id_unit_kerja'];
            //         $bln = $_POST['bln'];
            //         $thn = $_POST['thn'];
            //         $this->buku_kas_umum($id_unit_kerja, $bln, $thn, $_POST['id_perjalanan_dinas']);
            //     }
            // }



            $this->db->group_start();
            $this->db->where('level_unit_kerja', 1);
            $this->db->or_where('level_unit_kerja', 2);
            $this->db->group_end();
            $data['bagian'] = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->result();

            $laporan_per_bagian = $this->perjalanan_dinas_model->get_per_bagian($bulan, $tahun);

            $data['jumlah_bagian'] = $laporan_per_bagian['jumlah_bagian'];
            $data['total_row'] = $laporan_per_bagian['total_row'];

            if ($jenis == 'rekap') {
                if (!empty($_POST)) {
                    if (isset($_POST['action'])) {
                        if ($_POST['action'] == 'rekap_pencairan') {
                            $id_unit_kerja = $_POST['id_unit_kerja'];
                            $bln = $_POST['bln'];
                            $thn = $_POST['thn'];
                            $this->ajuan_rekap_bagian($id_unit_kerja, $bln, $thn, $_POST['id_perjalanan_dinas'],$jenis_perjalanan);
                        } elseif ($_POST['action'] == 'bku') {
                            $id_unit_kerja = $_POST['id_unit_kerja'];
                            $bln = $_POST['bln'];
                            $thn = $_POST['thn'];
                            $this->buku_kas_umum($id_unit_kerja, $bln, $thn, $_POST['id_perjalanan_dinas']);
                        }
                    }
                }
            }


            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }



    public function rekap_bagian($bulan, $tahun)
    {

        $this->db->group_start();
        $this->db->where('level_unit_kerja', 1);
        $this->db->or_where('level_unit_kerja', 2);
        $this->db->group_end();
        $data['bagian'] = $this->db->get_where('ref_unit_kerja', array('id_skpd' => 1))->result();
        $data['list'] = $this->perjalanan_dinas_model->get_all();
        $laporan_per_bagian = $this->perjalanan_dinas_model->get_per_bagian($bulan, $tahun);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['jumlah_bagian'] = $laporan_per_bagian['jumlah_bagian'];
        $data['total_row'] = $laporan_per_bagian['total_row'];
        $filename = "Rekap Per Bagian.pdf";
        $options = new Options();
        $html = $this->load->view('admin/perjalanan_dinas/template_per_bagian', $data, TRUE);
        // echo $html;die;
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename);
    }

    public function getPerjalananDinas($id_unit_kerja, $bulan, $tahun,$jenis_perjalanan='')
    {
        $data = ($this->perjalanan_dinas_model->get_by_unit_kerja($id_unit_kerja, $bulan, $tahun,$jenis_perjalanan));
        $res = '';
        $no = 1;
        foreach ($data as $d) {
            $akhir = !empty($d->tanggal_akhir) ? " s.d " . tanggal($d->tanggal_akhir) : '';
            $res .= '<tr>';
            $res .= '<td style="text-align:center"><input type="checkbox" value="' . $d->id_perjalanan_dinas . '" name="id_perjalanan_dinas[]"></td>';
            $res .= '<td>' . $no . '</td>';
            $res .= '<td>' . $d->deskripsi_kegiatan . '</td>';
            $res .= '<td>' . normal_string($d->jenis_perjalanan) . '</td>';
            $res .= '<td>' . tanggal($d->tanggal_awal) . $akhir . '</td>';
            $res .= '<td>' . $d->tujuan . '</td>';
            $res .= '</tr>';
            $no++;
        }
        if ($res == '') {
            $res .= ' <tr>
              
            <td colspan="6">
              <center>Belum Ada Perjalanan Dinas</center>
          </td>
            </tr>';
        }
        echo $res;
    }

    public function action_verifikasi($id_perjalanan_dinas = '', $status)
    {
        if (!empty($id_perjalanan_dinas)) {
            if ($status == 'sudah_diverifikasi') {
                $data_update = array('status_verifikasi' => $status);
                $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);
                redirect('perjalanan_dinas/verifikasi_detail/' . $id_perjalanan_dinas);
            } elseif ($status == 'ditolak') {
                if (!empty($_POST)) {
                    $data_update = array('status_verifikasi' => $status, 'alasan_penolakan' => $_POST['alasan_penolakan']);
                    $update = $this->perjalanan_dinas_model->update($data_update, $id_perjalanan_dinas);
                }
                redirect('perjalanan_dinas/verifikasi_detail/' . $id_perjalanan_dinas);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function action_verifikasi_file($id_perjalanan_dinas = '', $id_perjalanan_dinas_file = '', $status)
    {
        if ((!empty($id_perjalanan_dinas)) && (!empty($id_perjalanan_dinas_file))) {
            if ($status == 'sudah_diverifikasi') {
                $data_update = array('status_verifikasi' => $status);
                $update = $this->perjalanan_dinas_model->update_file($data_update, $id_perjalanan_dinas_file);
                redirect('perjalanan_dinas/verifikasi_detail/' . $id_perjalanan_dinas . '#tableFile');
            } elseif ($status == 'ditolak') {
                if (!empty($_POST)) {
                    $data_update = array('status_verifikasi' => $status, 'alasan_penolakan' => $_POST['alasan_penolakan']);
                    $update = $this->perjalanan_dinas_model->update_file($data_update, $id_perjalanan_dinas_file);
                }
                redirect('perjalanan_dinas/verifikasi_detail/' . $id_perjalanan_dinas . '#tableFile');
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function cek_name()
    {
        if (!empty($_POST)) {
            $id_pegawai = $_POST['id_pegawai'];
            $jenis_waktu = $_POST['jenis_waktu'];
            if (is_numeric($id_pegawai)) {
                $jenis_pegawai = 'pns';
                $this->db->where('id_pegawai', $id_pegawai);
            } else {
                $jenis_pegawai = 'non_pns';
                $this->db->where('nama_pegawai', $id_pegawai);
            }
            if ($jenis_waktu == 'single') {
                $this->db->where('tanggal_awal', $_POST['tanggal_pelaksanaan']);
            } elseif ($jenis_waktu == 'multi') {
                $this->db->where('tanggal_awal >=', $_POST['tanggal_awal']);
                $this->db->where('tanggal_akhir <=', $_POST['tanggal_akhir']);
            }
            $this->db->join('perjalanan_dinas', 'perjalanan_dinas.id_perjalanan_dinas = perjalanan_dinas_pembiayaan.id_perjalanan_dinas');
            $search = $this->db->get('perjalanan_dinas_pembiayaan')->num_rows();
            if ($search > 0) {
                $res = array('result' => false, 'message' => 'Pegawai sudah melakukan perjalanan dinas pada tanggal terpilih', 'jenis_pegawai' => $jenis_pegawai);
            } else {
                $res = array('result' => true);
            }
            echo json_encode($res);
        }
    }
}
