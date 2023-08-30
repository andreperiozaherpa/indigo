<?php
include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");
use Dompdf\Options;
use Dompdf\Dompdf;
use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
class Laporan_kinerja_harian extends CI_Controller
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
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;
        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        //$this->load->model('Ref_renstra','ref_kode_kegiatan_m');

        $this->_max_days = 14;

        $this->rating_desc = $this->laporan_kinerja_harian_model->getRatingDesc();

        $sekda = $this->master_pegawai_model->get_pegawai_kepala_skpd(1);
        if ($sekda) {
            $id_pegawai_sekda = $sekda->id_pegawai;
        } else {
            $id_pegawai_sekda = 77;
        }
        $this->id_pegawai_sekda = $id_pegawai_sekda;
    }

    public function download_rekap_lkh($id_pegawai = '', $bulan = '', $tahun = '', $save = false, $testing = '')
    {

        if ($id_pegawai !== '' || isset($_POST['id_pegawai'])) {
            if (isset($_POST['id_pegawai'])) {
                $id_pegawai = $this->session->userdata('id_pegawai');
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
            }
            $data['detail_pegawai'] = $this->master_pegawai_model->get_by_id($id_pegawai);

            $data['detail'] = $this->laporan_kinerja_harian_model->get_rekap($id_pegawai, $bulan, $tahun);

            $filename = "Rekap LKH " . $data['detail_pegawai']->nama_lengkap;
            if (!empty($bulan)) {
                $filename .= " Bulan " . bulan($bulan);
                $data['bulan'] = bulan($bulan);
            }
            if (!empty($tahun)) {
                $filename .= " Tahun $tahun";
                $data['tahun'] = $tahun;
            }
            $filename .= "_" . time() . ".pdf";
            $filename = str_replace(",", "", $filename);
            // $filename = str_replace(".","", $filename);
            // $filename = str_replace(" ","_", $filename);
            $filename = str_replace("/", "_", $filename);
            $filename = str_replace(" ", "_", $filename);

            $html = $this->load->view('admin/laporan_kinerja_harian/s', $data, TRUE);
            if ($testing == 1) {
                echo $html;
                die;
            }
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            if ($save == true) {
                $output = $dompdf->output();
                $savename = "./data/laporan_lkh/" . $filename;
                if (file_put_contents($savename, $output)) {
                    return array('savename' => $savename, 'filename' => $filename);
                } else {
                    return false;
                }
            } else {
                $dompdf->stream($filename);
            }
        } else {
            show_404();
        }
    }

    public function index($testing = 0)
    {

        if ($this->user_id) {

            $data['title']        = "Laporan Kinerja Harian";
            $data['content']    = "laporan_kinerja_harian/index";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "laporan_kinerja_harian";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');

            $today = date("Y-m-d");
            $data['tanggal_awal'] = date('Y-m-d', strtotime($today . ' -' . $this->_max_days . '  day'));
            $data['tanggal_akhir'] = $today;

            $v = "";

            if ($this->input->get("v") == 2) {
                $data['content']    = "laporan_kinerja_harian/index_v2";
                $v = "?v=2";
            }

            if (!empty($_POST)) {
                //echo "<pre>";print_r($_POST);die;
                $this->load->model("kinerja/Lkh_model");

                $type = $_POST['type'];
                $cut_off = date("Y-m-d", strtotime($today . " -6 days"));
                $bypass = true;// (date("Y")==2023 && date("n")==1) ? true : false;

                $id_renaksi_detail = $this->input->post("id_renaksi_detail");


                if ($type == 'add') {
                    $tanggal = $_POST['tanggal'];
                    $id_skpd = $this->session->userdata('id_skpd');
                    // if($id_skpd == 34){
                    // $id_skpd = "16";
                    // die;
                    // }

                    $valid_realisasi = true;

                    if ($id_renaksi_detail) {
                        $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                        $total = $total_realisasi + (int)  $_POST['hasil_kegiatan'];
                        if ($total > 100) {
                            $valid_realisasi = false;
                        }
                    }

                    if ((!$bypass && $tanggal <= $cut_off) && $id_skpd != 16) {
                        $data['message'] =  'Pengisian LKH hanya bisa dilakukan maksimal 5 hari kebelakang';
                        $data['message_type'] = 'danger';
                    } else {
                        if (!$valid_realisasi) {
                            $data['message'] =  'Gagal. Akumuliasi pencapaian/realisasi melebihi 100%';
                            $data['message_type'] = 'danger';
                        } else {
                            $rincian_kegiatan = $_POST['rincian_kegiatan'];
                            $hasil_kegiatan = $_POST['hasil_kegiatan'];
                            $id_verifikator = $_POST['id_verifikator'];
                            $error_upload = false;
                            if (!empty($_FILES['lampiran']['name'])) {
                                if (!file_exists("./data/kegiatan_personal/$id_pegawai")) {
                                    mkdir("./data/kegiatan_personal/$id_pegawai", 0777, true);
                                }
                                $config = array(
                                    'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
                                    'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                                    'overwrite' => TRUE,
                                    'max_size' => "50480000"
                                );
                                $this->load->library('upload', $config);
                                if ($this->upload->do_upload('lampiran')) {
                                    $lampiran =  $this->upload->data('file_name');
                                } else {
                                    $data['message'] =  $this->upload->display_errors();
                                    $data['message_type'] = 'danger';
                                    $error_upload = true;
                                }
                            } else {
                                $lampiran = NULL;
                            }
                            if (!$error_upload) {
                                $data_in = array('id_pegawai' => $id_pegawai, 'id_skpd' => $id_skpd, 'tanggal' => $tanggal, 'rincian_kegiatan' => $rincian_kegiatan, 'hasil_kegiatan' => $hasil_kegiatan, 'lampiran' => $lampiran, 'id_verifikator' => $id_verifikator, 'status_verifikasi' => 'belum_diverifikasi');
                                $insert = $this->laporan_kinerja_harian_model->insert($data_in);
                                if ($insert) {
                                    $insert_log = $this->laporan_kinerja_harian_model->insert_log($data_in, $insert);
                                    //$data['message'] = 'Laporan Kinerja Harian berhasil ditambahkan.';
                                    //$data['message_type'] = 'success';

                                    // Kinerja > LKH

                                    if ($id_renaksi_detail) {
                                        $dt_lkh = array(
                                            'id_renaksi_detail'         => $id_renaksi_detail,
                                            'id_laporan_kerja_harian'   => $insert
                                        );
                                        $this->db->insert("ekinerja_lkh", $dt_lkh);

                                        $this->Lkh_model->updateCapaian($id_renaksi_detail);
                                    }

                                    $this->session->set_flashdata("message_success", "Laporan Kinerja Harian berhasil ditambahkan");
                                    redirect("laporan_kinerja_harian" . $v);
                                } else {
                                    $data['message'] = 'Terjadi kesalahan';
                                    $data['message_type'] = 'danger';
                                }
                            }
                        }
                    }
                } elseif ($type == 'edit') {

                    $tanggal = $_POST['tanggal'];

                    $valid_realisasi = true;

                    if ($id_renaksi_detail) {
                        if ($this->input->post("id_lkh")) {
                            $param_lkh['where']['lkh.id_lkh'] = $this->input->post("id_lkh");
                            $lkh = $this->Lkh_model->get($param_lkh)->row();
                            if ($lkh) {
                                $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                                $total = $total_realisasi - (int)$lkh->hasil_kegiatan + (int)  $_POST['hasil_kegiatan'];
                                if ($total > 100) {
                                    $valid_realisasi = false;
                                }
                            }
                        }
                    }


                    if ((!$bypass && $tanggal <= $cut_off) && $id_skpd != 16) {
                        $data['message'] =  'Pengisian LKH hanya bisa dilakukan maksimal 5 hari kebelakang';
                        $data['message_type'] = 'danger';
                    } else {
                        if (!$valid_realisasi) {
                            $data['message'] =  'Gagal. Akumuliasi pencapaian/realisasi melebihi 100%';
                            $data['message_type'] = 'danger';
                        } else {
                            $id_laporan_kerja_harian = $_POST['id_laporan_kerja_harian'];
                            $rincian_kegiatan = $_POST['rincian_kegiatan'];
                            $hasil_kegiatan = $_POST['hasil_kegiatan'];
                            $id_verifikator = $_POST['id_verifikator'];
                            $error_upload = false;
                            if (!empty($_FILES['lampiran']['name'])) {
                                if (!file_exists("./data/kegiatan_personal/$id_pegawai")) {
                                    mkdir("./data/kegiatan_personal/$id_pegawai", 0777, true);
                                }
                                $config = array(
                                    'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
                                    'allowed_types' => "jpeg|zip|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                                    'overwrite' => TRUE,
                                    'max_size' => "50480000"
                                );
                                $this->load->library('upload', $config);
                                if ($this->upload->do_upload('lampiran')) {
                                    $lampiran =  $this->upload->data('file_name');
                                } else {
                                    $data['message'] =  $this->upload->display_errors();
                                    $data['message_type'] = 'danger';
                                    $error_upload = true;
                                }
                            } else {
                                $lampiran = NULL;
                            }
                            if (!$error_upload) {
                                $data_in = array('id_pegawai' => $id_pegawai, 'id_skpd' => $id_skpd, 'tanggal' => $tanggal, 'rincian_kegiatan' => $rincian_kegiatan, 'hasil_kegiatan' => $hasil_kegiatan, 'id_verifikator' => $id_verifikator, 'status_verifikasi' => 'belum_diverifikasi', 'alasan_penolakan' => '');
                                if (!empty($lampiran)) {
                                    $data_in['lampiran'] = $lampiran;
                                }
                                $insert = $this->laporan_kinerja_harian_model->update($data_in, $id_laporan_kerja_harian);
                                if ($insert) {
                                    $insert_log = $this->laporan_kinerja_harian_model->insert_log($data_in, $id_laporan_kerja_harian);
                                    //$data['message'] = 'Laporan Kinerja Harian berhasil diupdate';
                                    //$data['message_type'] = 'success';

                                    // Kinerja > LKH
                                    $id_renaksi_detail = $this->input->post("id_renaksi_detail");
                                    if ($id_renaksi_detail) {

                                        $dt_lkh = array(
                                            'id_renaksi_detail'         => $id_renaksi_detail
                                        );
                                        $this->db
                                            ->where("id_laporan_kerja_harian", $id_laporan_kerja_harian)
                                            ->update("ekinerja_lkh", $dt_lkh);

                                        $this->Lkh_model->updateCapaian($id_renaksi_detail);
                                    }

                                    $this->session->set_flashdata("message_success", "Laporan Kinerja Harian berhasil diupdate");
                                    redirect("laporan_kinerja_harian" . $v);
                                } else {
                                    $data['message'] = 'Terjadi kesalahan';
                                    $data['message_type'] = 'danger';
                                }
                            }
                        }
                    }
                } elseif ($type == 'filter') {
                    $awal = $data['tanggal_awal']  = $_POST['tanggal_awal'];
                    $akhir = $data['tanggal_akhir'] = $_POST['tanggal_akhir'];
                    $status = $_POST['status_verifikasi'];

                    $date1 = date_create($awal);
                    $date2 = date_create($akhir);
                    $diff = date_diff($date1, $date2);
                    $range =  $diff->format("%a");

                    $data['list']  = array();
                    if ($awal <= $akhir) {
                        if ($range > $this->_max_days) {
                            $data['message'] =  'Tanggal tidak valid. Maksimal pengambilan data ' . $this->_max_days . ' hari.';
                            $data['message_type'] = 'danger';
                        } else {
                            $data['list'] = $this->laporan_kinerja_harian_model->get_by_pegawai($id_pegawai, false, array('awal' => $awal, 'akhir' => $akhir, 'status_verifikasi' => $status));
                        }
                    } else {
                        $data['message'] =  'Tanggal tidak valid';
                        $data['message_type'] = 'danger';
                    }
                }
            }

            if ($this->user_level != 'Administrator') {
                $skpd = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
                $jenis_skpd = $skpd->jenis_skpd;
                $pegawai = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'));

                $atasan = $this->master_pegawai_model->get_by_id($this->session->userdata('id_pegawai'))->id_pegawai_atasan_langsung;
                // print_r($atasan);die;
                if (!empty($atasan)) {
                    $data['pegawai'][] = $this->master_pegawai_model->get_by_id($atasan);
                } else {
                    if ($this->session->userdata('kepala_skpd') == "Y" && $pegawai->jabatan != 'Sekretaris Daerah') {
                        $verifikator_kepala = array('Asisten Administrasi Umum' => array(3, 12, 18, 25, 26, 24, 20), 'Asisten Pembangunan' => array(4, 5, 6, 7, 9, 10, 11, 17, 19, 21, 22, 14, 30), 'Asisten Pemerintahan' => array(8, 13, 15, 16, 23, 35, 36, 2));
                        $data['pegawai'] = array();
                        foreach ($verifikator_kepala as $k => $v) {
                            if (in_array($this->session->userdata('id_skpd'), $v)) {
                                $data['pegawai'][] = $this->master_pegawai_model->get_by_jabatan($k);
                            }
                        }
                        if ($jenis_skpd == 'kecamatan') {
                            $data['pegawai'][] = $this->master_pegawai_model->get_by_id(88);
                        } elseif ($jenis_skpd == 'puskesmas') {
                            $data['pegawai'][] = $this->master_pegawai_model->get_by_id(538);
                        } elseif ($jenis_skpd == 'kelurahan' || $jenis_skpd == 'uptd') {
                            $data['pegawai'][] = $this->master_pegawai_model->get_pegawai_kepala_skpd($skpd->id_skpd_induk);
                        }
                        // $data['pegawai'][] = $this->master_pegawai_model->get_by_id(77);
                    } elseif ($pegawai->jabatan == 'Sekretaris Daerah') {
                        $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd(33, true);
                    } elseif ($pegawai->jabatan == 'Staff Ahli' || $pegawai->jabatan == 'Asisten Administrasi Umum' || $pegawai->jabatan == 'Asisten Pembangunan' || $pegawai->jabatan == 'Asisten Pemerintahan') {
                        $data['pegawai'][0] = $this->master_pegawai_model->get_by_id($this->id_pegawai_sekda);
                    } else {
                        $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
                    }
                }
                if (empty($_POST)) {
                    $where = array(
                        'awal'  => $data['tanggal_awal'],
                        'akhir' => $data['tanggal_akhir'],
                    );
                    //echo "<pre>";print_r($where);die;
                    // $data['list'] = $this->laporan_kinerja_harian_model->get_by_pegawai($id_pegawai,false,$where);

                }
                if ($testing == 1) {
                    echo $jenis_skpd;
                    die;
                }
                //echo "<pre>";print_r($data['list']);die;

                if ($this->session->flashdata("message_success")) {
                    $data["message"]  = $this->session->flashdata("message_success");
                    $data['message_type'] = 'success';
                }
                if ($this->session->flashdata("message_error")) {
                    $data["message"]  = $this->session->flashdata("message_error");
                    $data['message_type'] = 'danger';
                }

                $this->load->view('admin/index', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function verifikasi()
    {

        if ($this->user_id) {
            $data['title']        = "Laporan Kinerja Harian";
            $data['content']    = "laporan_kinerja_harian/verifikasi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "laporan_kinerja_harian";
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');

            $today = date("Y-m-d");
            $data['tanggal_awal'] = date('Y-m-d', strtotime($today . ' -' . $this->_max_days . '  day'));
            $data['tanggal_akhir'] = $today;

            if (!empty($_POST)) {
                $data['list'] = array();
                $type = $_POST['type'];
                if ($type == 'filter') {
                    $awal = $data['tanggal_awal']  = $_POST['tanggal_awal'];
                    $akhir = $data['tanggal_akhir'] = $_POST['tanggal_akhir'];
                    $status = $_POST['status_verifikasi'];
                    $nama_pegawai = $_POST['nama_pegawai'];


                    $date1 = date_create($awal);
                    $date2 = date_create($akhir);
                    $diff = date_diff($date1, $date2);
                    $range =  $diff->format("%a");

                    $data['list']  = array();
                    if ($awal <= $akhir) {
                        if ($range > $this->_max_days) {
                            $data['message'] =  'Tanggal tidak valid. Maksimal pengambilan data ' . $this->_max_days . ' hari.';
                            $data['message_type'] = 'danger';
                        } else {
                            $data['list'] = $this->laporan_kinerja_harian_model->get_verifikasi_by_pegawai($id_pegawai, false, array('nama_pegawai' => $nama_pegawai, 'awal' => $awal, 'akhir' => $akhir, 'status_verifikasi' => $status));
                        }
                    } else {
                        $data['message'] =  'Tanggal tidak valid';
                        $data['message_type'] = 'danger';
                    }
                }
            } else {
                $where = array(
                    'awal'  => $data['tanggal_awal'],
                    'akhir' => $data['tanggal_akhir'],
                );
                $data['list'] = $this->laporan_kinerja_harian_model->get_verifikasi_by_pegawai($id_pegawai, false, $where);
            }
            // print_r($this->session->userdata('level'));die;
            $data['pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);

            $data['rating_desc']    = $this->rating_desc;
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function rekap()
    {

        if ($this->user_level !== "Administrator" && !in_array('kepegawaian', $this->user_privileges) && !in_array('op_kepegawaian', $this->user_privileges)) {
            show_404();
        } else {

            if ($this->user_id) {

                $data['title']        = "Rekap Laporan Kinerja Harian";
                $data['content']    = "laporan_kinerja_harian/rekap";
                $data['user_picture'] = $this->user_picture;
                $data['full_name']        = $this->full_name;
                $data['user_level']        = $this->user_level;
                $data['active_menu'] = "laporan_kinerja_harian";
                $this->load->model('ref_skpd_model');
                if (in_array('kepegawaian', $this->user_privileges)) {
                    $data['skpd_kepegawaian'] = $this->session->userdata('id_skpd');
                    $data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
                } else {
                    $data['skpd'] = $this->ref_skpd_model->get_all();
                }
                if (!empty($_POST)) {
                    $bulan = $_POST['bulan'];
                    $tahun = $_POST['tahun'];
                    if (in_array('kepegawaian', $this->user_privileges)) {
                        $_POST['id_skpd'] = $this->session->userdata('id_skpd');
                    }
                    $id_skpd = $_POST['id_skpd'];
                    if (!empty($id_skpd)) {
                        $data['nama_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
                    }
                    $data['list'] = $this->laporan_kinerja_harian_model->get_all_pegawai($id_skpd, $bulan, $tahun);
                    // print_r($data['list']);die;
                }

                $this->load->view('admin/index', $data);
            } else {
                redirect('admin');
            }
        }
    }

    public function delete($id_laporan_kerja_harian = '')
    {
        if (!empty($id_laporan_kerja_harian)) {
            $this->laporan_kinerja_harian_model->delete($id_laporan_kerja_harian);
            $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
            $detail = (array) $detail;
            $id_pegawai = $detail['id_pegawai'];
            $bulan = date("m", strtotime($detail['tanggal']));
            $tahun = date("Y", strtotime($detail['tanggal']));
            $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);

            $v = "";

            if ($this->input->get("v") == 2) {
                $v = "?v=2";
            }

            redirect('laporan_kinerja_harian' . $v);
        } else {
            show_404();
        }
    }

    public function verifikasi_laporan($id_laporan_kerja_harian = '')
    {
        if (!empty($id_laporan_kerja_harian)) {
            $this->laporan_kinerja_harian_model->update(array('status_verifikasi' => 'sudah_diverifikasi'), $id_laporan_kerja_harian);
            $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
            $detail = (array) $detail;
            $insert_log = $this->laporan_kinerja_harian_model->insert_log($detail, $id_laporan_kerja_harian);

            $id_pegawai = $detail['id_pegawai'];
            $bulan = date("m", strtotime($detail['tanggal']));
            $tahun = date("Y", strtotime($detail['tanggal']));
            $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);

            redirect('laporan_kinerja_harian/verifikasi');
        } else {
            show_404();
        }
    }

    public function saveVerifikasi($id_laporan_kerja_harian = '')
    {
        if (!empty($_POST) && !empty($id_laporan_kerja_harian)) {
            if ($this->input->post("rating")) {
                $dt_rating = array(
                    'id_laporan_kerja_harian'   => $id_laporan_kerja_harian,
                    'rating'                    => $this->input->post("rating"),
                    'komentar'                  => $this->input->post("komentar"),
                );
                $this->db->insert("laporan_kerja_harian_rating", $dt_rating);
            }
            $data = array(
                'status_verifikasi' => $this->input->post("status_verifikasi"),
            );

            $update = $this->laporan_kinerja_harian_model->update($data, $id_laporan_kerja_harian);



            $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
            $detail = (array) $detail;
            $insert_log = $this->laporan_kinerja_harian_model->insert_log($detail, $id_laporan_kerja_harian);

            $id_pegawai = $detail['id_pegawai'];
            $bulan = date("m", strtotime($detail['tanggal']));
            $tahun = date("Y", strtotime($detail['tanggal']));
            $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);

            echo true;
        } else {
            show_404();
        }
    }


    public function get_detail_json($id_laporan_kerja_harian = '')
    {
        if (!empty($id_laporan_kerja_harian)) {
            $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
            $detail->tanggal_text = tanggal_hari($detail->tanggal);


            $lkh = $this->db->where("id_laporan_kerja_harian", $id_laporan_kerja_harian)->get("ekinerja_lkh")->row();
            if ($lkh) {
                $this->load->model("kinerja/Renaksi_model");
                $param['where']['renaksi_detail.id_renaksi_detail'] = $lkh->id_renaksi_detail;
                $renaksi = $this->Renaksi_model->get_detail($param)->row();

                $satuan = "satuan_desc";

                $dt_lkh = null;

                if ($renaksi->id_kinerja_utama) {
                    $this->load->model("kinerja/Kinerja_utama_model");
                    $param_detail['where']['kinerja_utama.id_kinerja_utama']  = $renaksi->id_kinerja_utama;
                    $dt_lkh = $this->Kinerja_utama_model->get($param_detail)->row();

                    if ($dt_lkh->flag == "program") {
                        $satuan = "program_satuan";
                    }
                    if ($dt_lkh->flag == "kegiatan") {
                        $satuan = "kegiatan_satuan";
                    }
                    if ($dt_lkh->flag == "sub_kegiatan") {
                        $satuan = "sub_kegiatan_satuan";
                    }
                    $renaksi->rencana_hasil = $renaksi->id_kinerja_utama;
                }

                if ($dt_lkh) {
                    $renaksi->satuan = $dt_lkh->$satuan;
                    $renaksi->indikator_kinerja_individu = $dt_lkh->indikator_kinerja_individu;
                }

                $detail->renaksi    = $renaksi;
            }



            echo json_encode($detail);
        } else {
            show_404();
        }
    }

    // public function download_rekap()
    // {
    //     if ($this->user_id && !empty($_POST)) {

    //         $id_pegawai = $this->session->userdata('id_pegawai');
    //         $tahun = $_POST['tahun'];
    //         $bulan = $_POST['bulan'];
    //         $detail_pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);

    //         $detail = $this->laporan_kinerja_harian_model->get_rekap($id_pegawai, $bulan, $tahun);
    //         // print_r($detail);die;
    //         $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //         $phpWord->getCompatibility()->setOoxmlVersion(14);
    //         $phpWord->getCompatibility()->setOoxmlVersion(15);

    //         $filename = "Rekap LKH " . $detail_pegawai->nama_lengkap;
    //         if (!empty($bulan)) {
    //             $filename .= " Bulan " . bulan($bulan);
    //         }
    //         if (!empty($tahun)) {
    //             $filename .= " Tahun $tahun";
    //         }
    //         $filename .= "_" . time() . ".docx";
    //         $filename = str_replace(",", "", $filename);
    //         // $filename = str_replace(".","", $filename);
    //         // $filename = str_replace(" ","_", $filename);
    //         $filename = str_replace("/", "_", $filename);
    //         $filename = str_replace(" ", "_", $filename);

    //         $template_path = './template/chkp.docx';
    //         $template = $phpWord->loadTemplate($template_path);

    //         $template->setValue('bulan', strtoupper(bulan($bulan)));
    //         $template->setValue('tahun', $tahun);
    //         $template->setValue('nama_lengkap', $detail_pegawai->nama_lengkap);
    //         $template->setValue('nip', $detail_pegawai->nip);
    //         $template->setValue('jabatan', $detail_pegawai->jabatan);
    //         $template->setValue('nama_unit_kerja', $detail_pegawai->nama_unit_kerja);

    //         $template->cloneRow('tanggal', count($detail));
    //         foreach ($detail as $k => $v) {
    //             $parser = new \HTMLtoOpenXML\Parser();
    //             $no = $k + 1;
    //             $template->setValue('n#' . $no, $no);
    //             $template->setValue('tanggal#' . $no, tanggal_hari($v->tanggal));
    //             $v->hasil_kegiatan = str_replace('<blockquote>', '', $v->hasil_kegiatan);
    //             $v->hasil_kegiatan = str_replace('</blockquote>', '', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<blockquote>', '', $v->rincian_kegiatan);
    //             $v->rincian_kegiatan = str_replace('</blockquote>', '', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<div>', ' ', $v->hasil_kegiatan);
    //             $v->hasil_kegiatan = str_replace('</div>', '<br>', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<div>', ' ', $v->rincian_kegiatan);
    //             $v->rincian_kegiatan = str_replace('</div>', '<br>', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('< ', ' kurang dari ', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('< ', ' kurang dari ', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<2', ' kurang dari 2', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<2', ' kurang dari 2', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<8', ' kurang dari 8', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<8', ' kurang dari 8', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<1', ' kurang dari 1', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<1', ' kurang dari 1', $v->rincian_kegiatan);
    //             $template->setValue('rincian_kegiatan#' . $no,  $parser->fromHTML($v->rincian_kegiatan), null, true);
    //             $template->setValue('hasil#' . $no, $parser->fromHTML($v->hasil_kegiatan), null, true);
    //             // echo $parser->fromHTML($v->hasil_kegiatan);
    //         }

    //         ob_clean();
    //         $template->saveAs("./data/laporan_lkh/" . $filename);
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename=' . $filename);
    //         header('Content-Transfer-Encoding: binary');
    //         header('Expires: 0');
    //         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize("./data/laporan_lkh/" . $filename));
    //         flush();
    //         readfile("./data/laporan_lkh/" . $filename);
    //         unlink("./data/laporan_lkh/" . $filename);
    //     } else {
    //         show_404();
    //     }
    // }
    // public function download_rekap_by_pegawai($id_pegawai, $bulan = '', $tahun = '', $testing = '')
    // {
    //     if (isset($id_pegawai)) {
    //         $detail_pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);

    //         $detail = $this->laporan_kinerja_harian_model->get_rekap($id_pegawai, $bulan, $tahun);
    //         $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //         $phpWord->getCompatibility()->setOoxmlVersion(14);
    //         $phpWord->getCompatibility()->setOoxmlVersion(15);
    //         $filename = "Rekap LKH " . $detail_pegawai->nama_lengkap;
    //         if (!empty($bulan)) {
    //             $filename .= " Bulan " . bulan($bulan);
    //         }
    //         if (!empty($tahun)) {
    //             $filename .= " Tahun $tahun";
    //         }
    //         $filename .= "_" . time() . ".docx";
    //         $filename = str_replace(",", "", $filename);
    //         // $filename = str_replace(".","", $filename);
    //         // $filename = str_replace(" ","_", $filename);
    //         $filename = str_replace("/", "_", $filename);
    //         $filename = str_replace(" ", "_", $filename);

    //         $template_path = './template/chkp.docx';
    //         $template = $phpWord->loadTemplate($template_path);

    //         $template->setValue('bulan', strtoupper(bulan($bulan)));
    //         $template->setValue('tahun', $tahun);
    //         $template->setValue('nama_lengkap', $detail_pegawai->nama_lengkap);
    //         $template->setValue('nip', $detail_pegawai->nip);
    //         $template->setValue('jabatan', $detail_pegawai->jabatan);
    //         $template->setValue('nama_unit_kerja', $detail_pegawai->nama_unit_kerja);
    //         $template->cloneRow('tanggal', count($detail));
    //         if ($testing == 1) {
    //             print_r($detail);
    //             die;
    //         }
    //         foreach ($detail as $k => $v) {
    //             $parser = new \HTMLtoOpenXML\Parser();
    //             $no = $k + 1;
    //             $template->setValue('n#' . $no, $no);
    //             $template->setValue('tanggal#' . $no, tanggal_hari($v->tanggal));
    //             $v->hasil_kegiatan = str_replace('<blockquote>', '', $v->hasil_kegiatan);
    //             $v->hasil_kegiatan = str_replace('</blockquote>', '', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<blockquote>', '', $v->rincian_kegiatan);
    //             $v->rincian_kegiatan = str_replace('</blockquote>', '', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<div>', ' ', $v->hasil_kegiatan);
    //             $v->hasil_kegiatan = str_replace('</div>', '<br>', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<div>', ' ', $v->rincian_kegiatan);
    //             $v->rincian_kegiatan = str_replace('</div>', '<br>', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('< ', ' kurang dari ', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('< ', ' kurang dari ', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<2', ' kurang dari 2', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<2', ' kurang dari 2', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<8', ' kurang dari 8', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<8', ' kurang dari 8', $v->rincian_kegiatan);
    //             $v->hasil_kegiatan = str_replace('<1', ' kurang dari 1', $v->hasil_kegiatan);
    //             $v->rincian_kegiatan = str_replace('<1', ' kurang dari 1', $v->rincian_kegiatan);
    //             $template->setValue('rincian_kegiatan#' . $no,  $parser->fromHTML($v->rincian_kegiatan), null, true);
    //             $template->setValue('hasil#' . $no, $parser->fromHTML($v->hasil_kegiatan), null, true);
    //         }
    //         ob_clean();
    //         $template->saveAs("./data/laporan_lkh/" . $filename);
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename=' . $filename);
    //         header('Content-Transfer-Encoding: binary');
    //         header('Expires: 0');
    //         header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize("./data/laporan_lkh/" . $filename));
    //         flush();
    //         readfile("./data/laporan_lkh/" . $filename);
    //         unlink("./data/laporan_lkh/" . $filename);
    //     } else {
    //         show_404();
    //     }
    // }


    public function rekap_ekspor($id_skpd = '', $bulan = '', $tahun = '')
    {
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        $this->load->library('pdf');
        $bulan = $bulan == 0 ? '' : $bulan;
        $tahun = $tahun == 0 ? '' : $tahun;
        $id_skpd = $id_skpd == 0 ? '' : $id_skpd;
        $list = $this->laporan_kinerja_harian_model->get_all_pegawai($id_skpd, $bulan, $tahun);
        // $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('P');
        $pdf->Write(0, 'Rekapitulasi Laporan Kinerja Harian', '', 0, 'C', true, 0, false, false, 0);
        $filename = "Rekapitulasi Kegiatan Personal";
        if ($id_skpd !== '') {
            $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
            $filename .= " SKPD " . $nama_skpd;
            $pdf->Write(0, 'SKPD ' . $nama_skpd, '', 0, 'C', true, 0, false, false, 0);
        }
        if ($bulan !== '') {
            $filename .= " Bulan " . bulan($bulan);
            $pdf->Write(0, 'Bulan ' . bulan($bulan), '', 0, 'C', true, 0, false, false, 0);
        }
        if ($tahun !== '') {
            $filename .= " Tahun " . $tahun;
            $pdf->Write(0, 'Tahun ' . $tahun, '', 0, 'C', true, 0, false, false, 0);
        }

        $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);

        $pdf->SetFont('');

        $tabel = '
		<br><br>
		<table border="1" style="width: 1261px;">
		<thead>
		<tr>
		  <th width="3%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>No</b></span>
		  </th>
		  <th width="11%" style="vertical-align: middle;text-align:center;line-height:30px">
		  <b>NIP</b>
		  </th>
		  <th width="12%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Nama</b></span></th>
		  <th width="5%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>LKH</b></span></th>
		  <th width="6%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Efektif</b></span></th>
		  <th width="7%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Persentase</b></span></th>
		</tr>
	  </thead>
		<tbody>
		';

        $no = 1;
        foreach ($list as $l) {
            // set_time_limit(60);
            if ($l->jumlah_lkh == 0 || $efektif == 0) {
                $persentase = 0;
            } else {
                $persentase = round(($l->jumlah_lkh / $efektif) * 100, 2);
            }

            $tabel .= '
		<tr>
			  <td width="3%" style="text-align:center">' . $no . '</td>
			  <td width="11%" >' . $l->nip . '</td>
			  <td width="12%" >' . $l->nama_lengkap . '</td>
			  <td width="5%" style="vertical-align: middle;text-align:center">' . $l->jumlah_lkh . '</td>
			  <td width="6%" style="vertical-align: middle;text-align:center">' . $efektif . '</td>
			  <td width="7%" style="vertical-align: middle;text-align:center">' . $persentase . '%</td>
			</tr>';
            $no++;
        }

        $tabel .= '
			</tbody>
	  </table>
		';
        $pdf->writeHTML($tabel, true, false, false, false, '');
        ob_end_clean();
        $pdf->Output($filename . '.pdf', 'D');
    }



    public function rekap_ekspor_v2($id_skpd = '', $bulan = '', $tahun = '')
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        // $this->load->library('pdf');
        $bulan = $bulan == 0 ? '' : $bulan;
        $tahun = $tahun == 0 ? '' : $tahun;
        $id_skpd = $id_skpd == 0 ? '' : $id_skpd;
        $list = $this->laporan_kinerja_harian_model->get_all_pegawai($id_skpd, $bulan, $tahun);
        $tabel = '<style>h4{margin:0px;padding:0px}</style>';
        $tabel .= '<center>';
        // $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;

        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // $pdf->setPrintFooter(false);
        // $pdf->setPrintHeader(false);
        // $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        // $pdf->AddPage('P');
        // $pdf->Write(0, 'Rekapitulasi Laporan Kinerja Harian', '', 0, 'C', true, 0, false, false, 0);
        $filename = "Rekapitulasi Kegiatan Personal";
        // if ($id_skpd !== '') {
        //     $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
        //     $filename .= " SKPD " . $nama_skpd;
        //     $pdf->Write(0, 'SKPD ' . $nama_skpd, '', 0, 'C', true, 0, false, false, 0);
        // }
        // if ($bulan !== '') {
        //     $filename .= " Bulan " . bulan($bulan);
        //     $pdf->Write(0, 'Bulan ' . bulan($bulan), '', 0, 'C', true, 0, false, false, 0);
        // }
        // if ($tahun !== '') {
        //     $filename .= " Tahun " . $tahun;
        //     $pdf->Write(0, 'Tahun ' . $tahun, '', 0, 'C', true, 0, false, false, 0);
        // }

        $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);

        // $pdf->SetFont('');

        $tabel .= '<h4>Rekapitulasi Laporan Kinerja Harian</h4>';
        if ($id_skpd !== '') {
            $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
            $filename .= " " . $nama_skpd;
            $tabel .= '<h4 style="font-size:20px">' . $nama_skpd . '</h4>';
        }
        if ($bulan !== '') {
            $filename .= " Bulan " . bulan($bulan);

            $tabel .= '<h4>' . 'Bulan ' . bulan($bulan) . '</h4>';
        }
        if ($tahun !== '') {
            $filename .= " Tahun " . $tahun;
            $tabel .= '<h4>' . " Tahun " . $tahun . '</h4>';
        }

        $tabel .= '</center>
		<br>
		<table border="1" style="border-collapse:collapse">
		<tr style="page-break-after: always">
		  <th width="3%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>No</b></span>
		  </th>
		  <th width="11%" style="vertical-align: middle;text-align:center;line-height:30px">
		  <b>NIP</b>
		  </th>
		  <th width="12%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Nama</b></span></th>
		  <th width="5%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>LKH</b></span></th>
		  <th width="6%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Efektif</b></span></th>
		  <th width="7%" style="vertical-align: middle;text-align:center">
		  <span style="line-height:30px"><b>Persentase</b></span></th>
		</tr>
		';

        $no = 1;
        foreach ($list as $k => $l) {

            if ($l->jumlah_lkh == 0 || $efektif == 0) {
                $persentase = 0;
            } else {
                $persentase = round(($l->jumlah_lkh / $efektif) * 100, 2);
            }
            $tabel .= '
            <tr>
			  <td width="3%" style="text-align:center">' . $no . '</td>
			  <td width="11%" >' . $l->nip . '</td>
			  <td width="12%" >' . $l->nama_lengkap . '</td>
			  <td width="5%" style="vertical-align: middle;text-align:center">' . $l->jumlah_lkh . '</td>
			  <td width="6%" style="vertical-align: middle;text-align:center">' . $efektif . '</td>
			  <td width="7%" style="vertical-align: middle;text-align:center">' . $persentase . '%</td>
			</tr>';
            $no++;
        }

        $tabel .= '
	  </table>
		';
        echo $tabel;
        die;
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        // $paper_orientation = 'landscape';
        // $customPaper = array(0,0,950,950);
        // $dompdf->set_paper($customPaper,$paper_orientation);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($tabel);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename);
        // $pdf->writeHTML($tabel);
        // ob_end_clean();
        // $pdf->Output($filename . '.pdf', 'D');
    }

    public function rekap_zip($id_skpd = '', $bulan = '', $tahun = '')
    {
        $bulan = $bulan == 0 ? '' : $bulan;
        $tahun = $tahun == 0 ? '' : $tahun;
        $id_skpd = $id_skpd == 0 ? '' : $id_skpd;
        $list = $this->laporan_kinerja_harian_model->get_all_pegawai($id_skpd, $bulan, $tahun);
        $filename = "Rekapitulasi Kinerja Harian";
        if ($id_skpd !== '') {
            $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
            $filename .= " SKPD " . $nama_skpd;
        }
        if ($bulan !== '') {
            $filename .= " Bulan " . bulan($bulan);
        }
        if ($tahun !== '') {
            $filename .= " Tahun " . $tahun;
        }
        $filedir = './data/' . $filename . '.zip';
        $zip = new ZipArchive;
        $arr_file = array();
        if ($zip->open($filedir, ZipArchive::CREATE) === TRUE) {
            foreach ($list as $l) {
                $id_pegawai = $l->id_pegawai;
                $pdf = $this->download_rekap_lkh($id_pegawai, $bulan, $tahun, TRUE);
                $zip->addFile($pdf['savename'], $pdf['filename']);
                $arr_file[] = $pdf['savename'];
            }
            // die;
            ob_clean();
            $zip->close();
            foreach ($arr_file as $f) {
                unlink($f);
            }
            // die;
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($filedir) . '"');
            header('Content-Length: ' . filesize($filedir));

            flush();
            readfile($filedir);
            // delete file
            unlink($filedir);
        }
    }

    public function progress()
    {
        $this->load->view('admin/laporan_kinerja_harian/progress');
    }
    public function progressbar()
    {

        ini_set('max_execution_time', 0); // to get unlimited php script execution time

        if (empty($_SESSION['i'])) {
            $_SESSION['i'] = 0;
        }

        $total = 100;
        for ($i = $_SESSION['i']; $i < $total; $i++) {
            $_SESSION['i'] = $i;
            $percent = intval($i / $total * 100) . "%";

            sleep(1); // Here call your time taking function like sending bulk sms etc.

            echo $percent . "<br>";
            ob_flush();
            flush();
        }
        echo '<script>parent.document.getElementById("information").innerHTML="<div style=\"text-align:center; font-weight:bold\">Process completed</div>"</script>';
    }


    public function listLKH()
    {

        $id_pegawai = $this->session->userdata('id_pegawai');

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search = $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if (!empty($order)) {
            foreach ($order as $o) {
                $col = $o['column'];
                $dir = $o['dir'];
            }
        }

        if ($dir != "asc" && $dir != "desc") {
            $dir = "desc";
        }
        $valid_columns = array(
            0 => 'tanggal',
            1 => 'rincian_kegiatan',
            2 => 'hasil_kegiatan',
            3 => 'status_verifikasi'
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }
        // if ($order != null) {
        // $this->db->order_by($order, $dir);
        // } else {
        $this->db->order_by('tanggal', 'desc');
        // }

        if (!empty($search)) {
            $x = 0;
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
        }
        $this->db->limit($length, $start);
        $this->db->where('laporan_kerja_harian.id_pegawai', $id_pegawai);

        $this->db->select('laporan_kerja_harian.*,rating.komentar');

        if ($this->input->get("tanggal_awal")) {
            $this->db->where("laporan_kerja_harian.tanggal >= '" . $this->input->get("tanggal_awal") . "' ");
        }
        if ($this->input->get("tanggal_akhir")) {
            $this->db->where("laporan_kerja_harian.tanggal <= '" . $this->input->get("tanggal_akhir") . "' ");
        }

        if ($this->input->get("status_verifikasi")) {
            $this->db->where("laporan_kerja_harian.status_verifikasi", $this->input->get("status_verifikasi"));
        }

        if ($this->input->get("v") == 2) {
            $this->db->join("laporan_kerja_harian", "laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian", "left");
            $this->db->join("laporan_kerja_harian_rating rating", "rating.id_laporan_kerja_harian =laporan_kerja_harian.id_laporan_kerja_harian", "left");
            $log = $this->db->get('ekinerja_lkh lkh');
        } else {
            $this->db->join("laporan_kerja_harian_rating rating", "rating.id_laporan_kerja_harian =laporan_kerja_harian.id_laporan_kerja_harian", "left");
            $log = $this->db->get('laporan_kerja_harian');
        }
        $data = array();
        $no = 1;
        foreach ($log->result() as $rows) {
            if ($rows->status_verifikasi == 'sudah_diverifikasi') {
                $buttonLKH = '<a data-toggle="tooltip" data-placement="top" title="Detail" href="javascript:void(0)" onclick="detailLaporan(' . $rows->id_laporan_kerja_harian . ')" class="btn btn-primary btn-sm btn-circle"><i class="ti-eye"></i></a>';
            } else {
                $buttonLKH = '<a data-toggle="tooltip" data-placement="top" title="Edit" href="javascript:void(0)" onclick="editLaporan(' . $rows->id_laporan_kerja_harian . ')" class="btn btn-info btn-sm btn-circle"><i class="ti-pencil"></i></a><a data-toggle="tooltip" data-placement="top" title="Hapus" href="javascript:void(0)" onclick="deleteLaporan(' . $rows->id_laporan_kerja_harian . ')" class="btn btn-danger btn-sm btn-circle"><i class="ti-trash"></i></a>';
            }
            $data[] = array(
                $no,
                tanggal_hari($rows->tanggal),
                short_text($rows->rincian_kegiatan),
                short_text($rows->hasil_kegiatan),
                $rows->komentar,
                status_lkh($rows->status_verifikasi),
                $buttonLKH
            );
            $no++;
        }
        $total_log = $this->totalLKH($search, $valid_columns);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_log,
            "recordsFiltered" => $total_log,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalLKH($search, $valid_columns)
    {
        if (!empty($search)) {
            $x = 0;
            $this->db->group_start();
            foreach ($valid_columns as $sterm) {
                if ($x == 0) {
                    $this->db->like($sterm, $search);
                } else {
                    $this->db->or_like($sterm, $search);
                }
                $x++;
            }
            $this->db->group_end();
        }
        $id_pegawai = $this->session->userdata('id_pegawai');
        $this->db->where('id_pegawai', $id_pegawai);

        if ($this->input->get("tanggal_awal")) {
            $this->db->where("laporan_kerja_harian.tanggal >= '" . $this->input->get("tanggal_awal") . "' ");
        }
        if ($this->input->get("tanggal_akhir")) {
            $this->db->where("laporan_kerja_harian.tanggal <= '" . $this->input->get("tanggal_akhir") . "' ");
        }

        if ($this->input->get("status_verifikasi")) {
            $this->db->where("laporan_kerja_harian.status_verifikasi", $this->input->get("status_verifikasi"));
        }

        if ($this->input->get("v") == 2) {
            $this->db->join("laporan_kerja_harian", "laporan_kerja_harian.id_laporan_kerja_harian = lkh.id_laporan_kerja_harian", "left");
            $query = $this->db->select("COUNT(*) as num")->get("ekinerja_lkh lkh");
        } else {
            $query = $this->db->select("COUNT(*) as num")->get("laporan_kerja_harian");
        }


        $result = $query->row();
        if (isset($result)) return $result->num;
        return 0;
    }
}
