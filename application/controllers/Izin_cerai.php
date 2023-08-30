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
class Izin_cerai extends CI_Controller
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
        $this->load->model('izin_cerai/ref_jenis_cuti_model');
        $this->load->model('izin_cerai/izin_cerai_model');
        $this->load->model('izin_cerai/ref_persyaratan_model');
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
            $data['title']        = "Izin Cerai";
            $data['content']    = "izin_cerai/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->izin_cerai_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function verifikasi($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Verifikasi Izin Cerai";
            $data['content']    = "izin_cerai/verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->izin_cerai_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }
    public function laporan($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Laporan Izin Cerai";
            $data['content']    = "izin_cerai/laporan";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['list'] = $this->izin_cerai_model->get_all();
            $data['skpd'] = $this->ref_skpd_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function add($testing = 0)
    {

        if ($this->user_id) {
            $data['title']        = "Buat Izin Cerai";
            $data['content']    = "izin_cerai/add";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            if (!empty($_POST)) {
                $data_insert = [ 'keterangan' => $_POST['keterangan'], 'id_pegawai' => $_POST['id_pegawai']];
                $insert = $this->izin_cerai_model->insert($data_insert);
                if ($insert) {
                    $success = true;
                    $config['upload_path']          = './data/berkas_izin_cerai/';
                    $config['allowed_types']        = 'pdf|gif|jpg|png|doc|docx|xls|xlsx|zip|rar';
                    $config['max_size']             = 10000;
                    $config['remove_spaces']           = false;
                    $persyaratan = $this->ref_persyaratan_model->get_all();
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
                                    $save = $this->izin_cerai_model->save_persyaratan($insert,$p->id_ref_persyaratan,$fileName);
                                }
                            }
                        }
                    }
                    if ($success) {
                        $data['message'] = 'Izin Cerai berhasil dibuat';
                        $data['message_type'] = 'success';
                        redirect('izin_cerai/index');
                    } else {
                        $delete = $this->izin_cerai_model->delete($insert);
                    }
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $data['persyaratan'] = $persyaratan = $this->ref_persyaratan_model->get_all();
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    
    public function edit($id_izin_cerai)
    {

        if ($this->user_id) {
            $data['title']        = "Edit Izin Cerai";
            $data['content']    = "izin_cerai/edit";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            if (!empty($_POST)) {
                $data_update = ['keterangan' => $_POST['keterangan']];
                $insert = $this->izin_cerai_model->update($data_update,$id_izin_cerai);
                if ($insert) {
                    $data['message'] = 'Izin Cerai berhasil diubah';
                    $data['message_type'] = 'success';
                } else {
                    $data['message'] = 'Terjadi Kesalahan';
                    $data['message_type'] = 'danger';
                }
            }
            $data['detail'] = $this->izin_cerai_model->get_by_id($id_izin_cerai);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function delete($id_izin_cerai){
        $delete = $this->izin_cerai_model->delete($id_izin_cerai);
        redirect('izin_cerai');
    }


    public function detail($id_izin_cerai)
    {

        if ($this->user_id) {
            $data['title']        = "Detail Izin Cerai";
            $data['content']    = "izin_cerai/detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['detail'] = $this->izin_cerai_model->get_by_id($id_izin_cerai);
            $data['persyaratan'] = $this->izin_cerai_model->get_persyaratan($id_izin_cerai);
            if(!empty($_POST)){
                $id_izin_cerai_persyaratan = $_POST['id_izin_cerai_persyaratan'];
                $detail_persyaratan = $this->izin_cerai_model->get_detail_persyaratan($id_izin_cerai_persyaratan);
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
                        $config['file_name'] = code_string($detail_persyaratan->nama_persyaratan) . $id_izin_cerai . time() . "." . $fileExt;
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
                            $save = $this->izin_cerai_model->update_persyaratan($id_izin_cerai_persyaratan,$fileName);
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

    public function detail_verifikasi($id_izin_cerai)
    {

        if ($this->user_id) {
            $data['title']        = "Detail Verifikasi Izin Cerai";
            $data['content']    = "izin_cerai/detail_verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "izin_cerai";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['detail'] = $this->izin_cerai_model->get_by_id($id_izin_cerai);
            $data['persyaratan'] = $this->izin_cerai_model->get_persyaratan($id_izin_cerai);
            $data['kelengkapan'] = $this->izin_cerai_model->cek_kelengkapan_persyaratan($id_izin_cerai);
            // print_r($data['detail']);die;
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function getDetailPersyaratanByID($id_izin_cerai_persyaratan=''){
        if($id_izin_cerai_persyaratan!==''){
            $detail = $this->izin_cerai_model->get_detail_persyaratan($id_izin_cerai_persyaratan);
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
        echo $res;
    }

    public function actionPermintaan($id_izin_cerai){
        if(!empty($_POST)){
            $status_verifikasi = $_POST['status_verifikasi'];
            $data_update = ['status_verifikasi'=>$status_verifikasi];
            if(isset($_POST['alasan_penolakan'])){
                $alasan_penolakan = $_POST['alasan_penolakan'];
                $data_update['alasan_penolakan_verifikasi'] = $alasan_penolakan; 
            }else{
                $alasan_penolakan = NULL;
            }

            $update = $this->db->update('pc_izin_cerai',$data_update,['id_izin_cerai'=>$id_izin_cerai]);
            if($update){
                echo true;
            }else{
                echo false;
            }
        }
    }
    public function actionFile($id_izin_cerai_persyaratan){
        if(!empty($_POST)){
            $status_verifikasi = $_POST['status_verifikasi'];
            $data_update = ['status_verifikasi'=>$status_verifikasi];
            if(isset($_POST['alasan_penolakan'])){
                $alasan_penolakan = $_POST['alasan_penolakan'];
                $data_update['alasan_penolakan'] = $alasan_penolakan; 
            }else{
                $alasan_penolakan = NULL;
            }

            $update = $this->db->update('ic_izin_cerai_persyaratan',$data_update,['id_izin_cerai_persyaratan'=>$id_izin_cerai_persyaratan]);
            if($update){
                echo true;
            }else{
                echo false;
            }
        }
    }
}
