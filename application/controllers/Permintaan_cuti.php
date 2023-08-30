<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");
use Dompdf\Dompdf;

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
class Permintaan_cuti extends CI_Controller
{

    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->load->model('master_pegawai_model');
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('ref_hari_kerja_efektif_model');
        $this->load->model('ref_skpd_model');
        $this->load->model('permintaan_cuti/ref_jenis_cuti_model');
        $this->load->model('permintaan_cuti/permintaan_cuti_model');
        $this->load->model('permintaan_cuti/ref_persyaratan_model');
        $this->load->model('surat_keluar_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;
        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        //$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
    }


    public function index($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Permintaan Cuti";
            $data['content']    = "permintaan_cuti/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->permintaan_cuti_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function verifikasi($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Verifikasi Permintaan Cuti";
            $data['content']    = "permintaan_cuti/verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->permintaan_cuti_model->get_verifikasi('kepegawaian');
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function laporan($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Laporan Permintaan Cuti";
            $data['content']    = "permintaan_cuti/laporan";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->permintaan_cuti_model->get_all();
            $data['skpd'] = $this->ref_skpd_model->get_all();
            $data['jenis_cuti'] = $this->ref_jenis_cuti_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function add($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Buat Permintaan Cuti";
            $data['content']    = "permintaan_cuti/add";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['jenis_cuti'] = $this->ref_jenis_cuti_model->get_all();
            if (!empty($_POST)) {
                if (isset($_POST['jenis_hari'])) {
                    $jenis_hari = 'multi';
                } else {
                    $jenis_hari = 'single';
                }
                $id_pegawai =  $_POST['id_pegawai'];
                $detail_pegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row();
                $data_insert = ['id_ref_jenis_cuti' => $_POST['id_ref_jenis_cuti'], 'keterangan' => $_POST['keterangan'], 'jenis_tanggal' => $jenis_hari, 'tanggal_awal' => $_POST['tanggal_awal'], 'tanggal_akhir' => $_POST['tanggal_akhir'], 'alamat' => $_POST['alamat'], 'id_pegawai' => $_POST['id_pegawai'], 'id_skpd' => $detail_pegawai->id_skpd];
                $insert = $this->permintaan_cuti_model->insert($data_insert);
                if ($insert) {
                    $success = true;
                    $config['upload_path']          = './data/berkas_cuti/';
                    $config['allowed_types']        = 'pdf|gif|jpg|png|doc|docx|xls|xlsx|zip|rar';
                    $config['max_size']             = 10000;
                    $config['remove_spaces']           = false;
                    $persyaratan = $this->ref_persyaratan_model->get_by_jenis($_POST['id_ref_jenis_cuti']);
                    // print_r($persyaratan);die;
                    foreach ($persyaratan as $p) {
                        $formName = 'persyaratan_' . $p->id_ref_persyaratan;
                        if (isset($_FILES[$formName]['tmp_name'])) {
                            if (empty($_FILES[$formName]['tmp_name'])) {
                                $data['message'] = "GAGAL : Masih ada berkas yang kosong";
                                $data['type'] = "danger";
                                $success = false;
                                break;
                            } else {
                                $path = $_FILES[$formName]['name'];
                                $fileExt = pathinfo($path, PATHINFO_EXTENSION);
                                $config['file_name'] = code_string($p->nama_persyaratan) . $insert . time() . "." . $fileExt;
                                $this->load->library('upload', $config);
                                $this->upload->initialize($config);
                                if (!$this->upload->do_upload($formName)) {
                                    $tmp_name = $_FILES[$formName]['tmp_name'];
                                    if ($tmp_name != "") {
                                        $data['message'] = $this->upload->display_errors();
                                        $data['type'] = "danger";
                                        $success = false;
                                        break;
                                    }
                                } else {
                                    $fileName = $this->upload->data('file_name');
                                    $save = $this->permintaan_cuti_model->save_persyaratan($insert, $p->id_ref_persyaratan, $fileName);
                                }
                            }
                        }
                    }
                    if ($success) {
                        redirect('permintaan_cuti');
                    } else {
                        $delete = $this->permintaan_cuti_model->delete($insert);
                    }
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }


    public function edit($id_permintaan_cuti)
    {

        if ($this->user_id) {
            $data['title']        = "Edit Permintaan Cuti";
            $data['content']    = "permintaan_cuti/edit";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['jenis_cuti'] = $this->ref_jenis_cuti_model->get_all();
            if (!empty($_POST)) {
                if (isset($_POST['jenis_hari'])) {
                    $jenis_hari = 'multi';
                } else {
                    $jenis_hari = 'single';
                }
                $data_update = ['keterangan' => $_POST['keterangan'], 'jenis_tanggal' => $jenis_hari, 'tanggal_awal' => $_POST['tanggal_awal'], 'tanggal_akhir' => $_POST['tanggal_akhir'], 'alamat' => $_POST['alamat']];
                $insert = $this->permintaan_cuti_model->update($data_update, $id_permintaan_cuti);
                if ($insert) {
                    $data['message'] = 'Permintaan Cuti berhasil diubah';
                    $data['message_type'] = 'success';
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $data['detail'] = $this->permintaan_cuti_model->get_by_id($id_permintaan_cuti);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function delete($id_permintaan_cuti)
    {
        $delete = $this->permintaan_cuti_model->delete($id_permintaan_cuti);
        redirect('permintaan_cuti');
    }


    public function detail($id_permintaan_cuti)
    {

        if ($this->user_id) {
            $data['title']        = "Detail Permintaan Cuti";
            $data['content']    = "permintaan_cuti/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['detail'] = $this->permintaan_cuti_model->get_by_id($id_permintaan_cuti);
            $data['persyaratan'] = $this->permintaan_cuti_model->get_persyaratan($id_permintaan_cuti);
            if (!empty($_POST)) {
                $id_permintaan_cuti_persyaratan = $_POST['id_permintaan_cuti_persyaratan'];
                $detail_persyaratan = $this->permintaan_cuti_model->get_detail_persyaratan($id_permintaan_cuti_persyaratan);
                $formName = 'file_persyaratan';
                if (isset($_FILES[$formName]['tmp_name'])) {
                    $success = true;
                    $config['upload_path']          = './data/berkas_cuti/';
                    $config['allowed_types']        = 'pdf|gif|jpg|png|doc|docx|xls|xlsx|zip|rar';
                    $config['max_size']             = 10000;
                    $config['remove_spaces']           = false;
                    if (!empty($_FILES[$formName]['tmp_name'])) {
                        $path = $_FILES[$formName]['name'];
                        $fileExt = pathinfo($path, PATHINFO_EXTENSION);
                        $config['file_name'] = code_string($detail_persyaratan->nama_persyaratan) . $id_permintaan_cuti . time() . "." . $fileExt;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($formName)) {
                            $tmp_name = $_FILES[$formName]['tmp_name'];
                            if ($tmp_name != "") {
                                $data['message'] = $this->upload->display_errors();
                                $data['type'] = "danger";
                                $success = false;
                            }
                        } else {
                            $fileName = $this->upload->data('file_name');
                            $save = $this->permintaan_cuti_model->update_persyaratan($id_permintaan_cuti_persyaratan, $fileName);
                        }
                    }
                }
            }
            // print_r($data['detail']);die;
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function detail_verifikasi($id_permintaan_cuti)
    {

        if ($this->user_id) {
            $data['title']        = "Detail Verifikasi Permintaan Cuti";
            $data['content']    = "permintaan_cuti/detail_verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "permintaan_cuti";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['detail'] = $this->permintaan_cuti_model->get_by_id($id_permintaan_cuti);
            $data['persyaratan'] = $this->permintaan_cuti_model->get_persyaratan($id_permintaan_cuti);
            $data['kelengkapan'] = $this->permintaan_cuti_model->cek_kelengkapan_persyaratan($id_permintaan_cuti);
            // print_r($data['detail']);die;
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function getDetailPersyaratanByID($id_permintaan_cuti_persyaratan = '')
    {
        if ($id_permintaan_cuti_persyaratan !== '') {
            $detail = $this->permintaan_cuti_model->get_detail_persyaratan($id_permintaan_cuti_persyaratan);
            echo json_encode($detail);
        }
    }

    public function getPersyaratan($id_ref_jenis_cuti)
    {
        $get = $this->ref_persyaratan_model->get_by_jenis($id_ref_jenis_cuti);
        $res = '';
        foreach ($get as $g) {
            $res .= ' <div class="form-group ">
            <label>' . $g->nama_persyaratan . '</label>
            <input required data-height="80" name="persyaratan_' . $g->id_ref_persyaratan . '" type="file" class="dropify">
            </div>';
        }
        // print_r($get);
        // die;
        if (empty($res)) {
            $res = 'Tidak memerlukan berkas persyaratan';
        }
        echo $res;
    }

    public function ajukan_permintaan($id_permintaan_cuti = '')
    {
        if ($id_permintaan_cuti !== '') {
            $data_update = ['status_pengajuan' => 'sudah_diajukan'];
            $update = $this->db->update('pc_permintaan_cuti', $data_update, ['id_permintaan_cuti' => $id_permintaan_cuti]);
            redirect('permintaan_cuti/detail/' . $id_permintaan_cuti);
        }
    }

    public function actionPermintaan($id_permintaan_cuti)
    {
        if (!empty($_POST)) {
            $status_verifikasi_kepegawaian = $_POST['status_verifikasi_kepegawaian'];
            $data_update = ['status_verifikasi_kepegawaian' => $status_verifikasi_kepegawaian];
            if (isset($_POST['alasan_penolakan_kepegawaian'])) {
                $alasan_penolakan = $_POST['alasan_penolakan_kepegawaian'];
                $data_update['alasan_penolakan_kepegawaian'] = $alasan_penolakan;
            } else {
                $alasan_penolakan = NULL;
            }

            $update = $this->db->update('pc_permintaan_cuti', $data_update, ['id_permintaan_cuti' => $id_permintaan_cuti]);
            if ($update) {
                echo true;
            } else {
                echo false;
            }
        }
    }
    public function actionFile($id_permintaan_cuti_persyaratan)
    {
        if (!empty($_POST)) {
            $status_verifikasi = $_POST['status_verifikasi'];
            $data_update = ['status_verifikasi' => $status_verifikasi];
            if (isset($_POST['alasan_penolakan'])) {
                $alasan_penolakan = $_POST['alasan_penolakan'];
                $data_update['alasan_penolakan'] = $alasan_penolakan;
            } else {
                $alasan_penolakan = NULL;
            }

            $update = $this->db->update('pc_permintaan_cuti_persyaratan', $data_update, ['id_permintaan_cuti_persyaratan' => $id_permintaan_cuti_persyaratan]);
            if ($update) {
                echo true;
            } else {
                echo false;
            }
        }
    }
}
