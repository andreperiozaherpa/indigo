<?php
defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Lkh extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('master_pegawai_model');
        $this->load->model('ref_skpd_model');
    }

    public function add_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tanggal = $this->input->post("tanggal");
        $verifikator = $this->input->post("verifikator");
        $uraian = $this->input->post("uraian");
        $hasil = $this->input->post("hasil");
        $foto = $this->input->post("foto");

        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;

            if ($tanggal && $verifikator && $uraian && $hasil) {

                $today = date("Y-m-d");
                $cut_off = date("Y-m-d", strtotime($today . " -4 days"));
                if ($tanggal <= $cut_off) {
                    $response = [
                        'error'    => true,
                        'message' => 'Pengisian LKH hanya bisa dilakukan maksimal 3 hari kebelakang',
                    ];
                } else {
                    if (!file_exists("./data/kegiatan_personal/$id_pegawai")) {
                        mkdir("./data/kegiatan_personal/$id_pegawai", 0777, true);
                    }

                    $config = array(
                        'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
                        'allowed_types' => "gif|jpg|jpeg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                        'overwrite' => TRUE,
                        'max_size' => "50480000"
                    );
                    $error = false;
                    $file = "";
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('lampiran')) {
                        $file =  $this->upload->data('file_name');
                    } else if (!empty($_FILES['file']['tmp_name'])) {
                        //else{
                        $error = true;
                        $response = [
                            'error'    => true,
                            'message' => $this->upload->display_errors(),
                        ];
                    }

                    if ($file == "" && $foto != "") {
                        $file = md5(uniqid()) . ".png";
                        $ImagePath = $config['upload_path'] . $file;
                        file_put_contents($ImagePath, base64_decode($foto));
                    }


                    if ($error == false) {
                        $data_in = array(
                            'id_pegawai' => $id_pegawai,
                            'id_skpd' => $cekApi->id_skpd,
                            'tanggal' => $tanggal,
                            'rincian_kegiatan' => $uraian,
                            'hasil_kegiatan' => $hasil,
                            'lampiran' => $file,
                            'id_verifikator' => $verifikator,
                            'status_verifikasi' => 'belum_diverifikasi'
                        );
                        $insert = $this->laporan_kinerja_harian_model->insert($data_in);
                        if ($insert) {
                            $response = [
                                'error'    => false,
                                'message' => 'Laporan berhasil ditambahkan',
                            ];
                        } else {
                            $response = [
                                'error'    => true,
                                'message' => 'Gagal menyimpan data.',
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential:' . $api_key,
            ];
        }

        $this->response($response);
    }

    public function verifikator_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_skpd = $cekApi->id_skpd;
            $id_pegawai = $cekApi->id_pegawai;
            $kepala_skpd = $cekApi->kepala_skpd;

            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $jenis_skpd = $skpd->jenis_skpd;
            $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);

            $atasan = $this->master_pegawai_model->get_by_id($id_pegawai)->id_pegawai_atasan_langsung;
            if (!empty($atasan)) {
                $verifikator[] = $this->master_pegawai_model->get_by_id($atasan);
            } else {
                if ($kepala_skpd == "Y" && $pegawai->jabatan != 'Sekretaris Daerah') {
                    $verifikator_kepala = array('Asisten Administrasi Umum' => array(3, 12, 18, 25, 26, 24, 20), 'Asisten Pembangunan' => array(4, 5, 6, 7, 9, 10, 11, 17, 19, 21, 22, 14, 30), 'Asisten Pemerintahan' => array(8, 13, 15, 16, 23, 35, 36, 2));
                    $verifikator = array();
                    foreach ($verifikator_kepala as $k => $v) {
                        if (in_array($id_skpd, $v)) {
                            $verifikator[] = $this->master_pegawai_model->get_by_jabatan($k);
                        }
                    }
                    if ($jenis_skpd == 'kecamatan') {
                        $verifikator[] = $this->master_pegawai_model->get_by_id(88);
                    } elseif ($jenis_skpd == 'puskesmas') {
                        $verifikator[] = $this->master_pegawai_model->get_by_id(538);
                    } elseif ($jenis_skpd == 'kelurahan' || $jenis_skpd == 'uptd') {
                        $verifikator[] = $this->master_pegawai_model->get_pegawai_kepala_skpd($skpd->id_skpd_induk);
                    }
                    // $verifikator[] = $this->master_pegawai_model->get_by_id(77);
                } elseif ($pegawai->jabatan == 'Sekretaris Daerah') {
                    $verifikator = $this->master_pegawai_model->get_by_id_skpd(33, true);
                } elseif ($pegawai->jabatan == 'Staff Ahli' || $pegawai->jabatan == 'Asisten Administrasi Umum' || $pegawai->jabatan == 'Asisten Pembangunan' || $pegawai->jabatan == 'Asisten Pemerintahan') {
                    $verifikator[0] = $this->master_pegawai_model->get_by_id(77);
                } else {
                    $verifikator = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
                }
                // $verifikator = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);
            }

            // $verifikator = $this->master_pegawai_model->get_by_id_skpd($id_skpd, true);

            $response = [
                'error'                => false,
                'verifikator'       => $verifikator,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function list_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $list = $this->laporan_kinerja_harian_model->get_by_pegawai($id_pegawai, true);

            $response = [
                'error'         => false,
                'list'       => $list,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function edit_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tanggal = $this->input->post("tanggal");
        $verifikator = $this->input->post("verifikator");
        $uraian = $this->input->post("uraian");
        $hasil = $this->input->post("hasil");
        $id = $this->input->post("id");
        $foto = $this->input->post("foto");


        if ($api_key != null && $cekApi && $id) {
            $id_pegawai = $cekApi->id_pegawai;

            $detail = $this->laporan_kinerja_harian_model->get_by_id($id);

            if ($uraian && $hasil && $detail && $detail->status_verifikasi == "belum_diverifikasi") {


                $config = array(
                    'upload_path' => "./data/kegiatan_personal/$id_pegawai/",
                    'allowed_types' => "gif|jpg|jpeg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                    'overwrite' => TRUE,
                    'max_size' => "50480000"
                );
                $error = false;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('lampiran')) {
                    $file =  $this->upload->data('file_name');

                    $path = "./data/kegiatan_personal/$id_pegawai/" . $detail->lampiran;
                    if (file_exists($path) && $detail->lampiran) {
                        unlink($path);
                    }
                } else if (!empty($_FILES['file']['tmp_name'])) {
                    //else{
                    $error = true;
                    $response = [
                        'error'    => true,
                        'message' => $this->upload->display_errors(),
                    ];
                }

                if (!$error) {
                    $data = array(
                        'rincian_kegiatan' => $uraian,
                        'hasil_kegiatan' => $hasil,
                        'status_verifikasi' => 'belum_diverifikasi'
                    );

                    if (isset($file)) {
                        $data['lampiran'] = $file;
                    } else if ($foto != "") {
                        $file = md5(uniqid()) . ".png";
                        $ImagePath = $config['upload_path'] . $file;
                        file_put_contents($ImagePath, base64_decode($foto));
                        $data['lampiran'] = $file;

                        $path = "./data/kegiatan_personal/$id_pegawai/" . $detail->lampiran;
                        if (file_exists($path) && $detail->lampiran) {
                            unlink($path);
                        }
                    }

                    $error = false;

                    if ($tanggal && $tanggal != "") {

                        $today = date("Y-m-d");
                        $cut_off = date("Y-m-d", strtotime($today . " -3 days"));
                        if ($tanggal <= $cut_off) {
                            $response = [
                                'error'    => true,
                                'message' => 'Pengisian LKH hanya bisa dilakukan maksimal 3 hari kebelakang',
                            ];
                            $error = true;
                        } else {
                            $data['tanggal'] = $tanggal;
                        }
                    }

                    if ($verifikator && $verifikator != "") {
                        $data['id_verifikator'] = $verifikator;
                    }

                    if ($error == false) {
                        $update = $this->laporan_kinerja_harian_model->update($data, $id);
                        if ($update) {
                            $response = [
                                'error'    => false,
                                'message' => 'Laporan berhasil diubah',
                            ];
                        } else {
                            $response = [
                                'error'    => true,
                                'message' => 'Gagal mengubah laporan.',
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function delete_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $id = $this->input->post("id");

        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;

            $detail = $this->laporan_kinerja_harian_model->get_by_id($id);

            if ($id && $detail && $detail->status_verifikasi == "belum_diverifikasi") {

                $path = "./data/kegiatan_personal/$id_pegawai/" . $detail->lampiran;
                if (file_exists($path)) {
                    unlink($path);
                }
                $delete = $this->laporan_kinerja_harian_model->delete($id);
                if ($delete) {
                    $response = [
                        'error'    => false,
                        'message' => 'Laporan berhasil dihapus',
                    ];
                } else {
                    $response = [
                        'error'    => true,
                        'message' => 'Gagal menghapus laporan.',
                    ];
                }
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function verifikasi_list_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $list = $this->laporan_kinerja_harian_model->get_verifikasi_by_pegawai($id_pegawai, true);

            $response = [
                'error'         => false,
                'list'       => $list,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function verifikasi_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);
        $id = $this->input->post("id");
        $catatan = $this->input->post("catatan");
        $alasan_penolakan = $this->input->post("alasan_penolakan");

        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;

            $detail = $this->laporan_kinerja_harian_model->get_by_id($id);

            if ($id && $detail && $detail->status_verifikasi == "belum_diverifikasi") {


                $data = array(
                    'status_verifikasi' => 'sudah_diverifikasi'
                );

                $message = "Laporan berhasil diverifikasi";
                if ($alasan_penolakan) {
                    $data['status_verifikasi'] = "ditolak";
                    $data['alasan_penolakan'] = $alasan_penolakan;
                    $message = "Laporan telah ditolak";
                }

                if ($catatan) {
                    $data['catatan'] = $catatan;
                }

                $update = $this->laporan_kinerja_harian_model->update($data, $id);
                if ($update) {
                    $rating = $this->input->post("rating");
                    if ($rating) {
                        $dt_rating = array(
                            'id_laporan_kerja_harian'   => $id,
                            'rating'                    => $rating,
                            'komentar'                    => $this->input->post("komentar"),
                        );
                        $this->db->insert("laporan_kerja_harian_rating", $dt_rating);
                    }
                    $id_pegawai = $detail->id_pegawai;
                    $bulan = date("m", strtotime($detail->tanggal));
                    $tahun = date("Y", strtotime($detail->tanggal));
                    $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);
                    $response = [
                        'error'    => false,
                        'message' => $message,
                    ];
                } else {
                    $response = [
                        'error'    => true,
                        'message' => 'Gagal memeverifikasi laporan.',
                    ];
                }
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }
}
