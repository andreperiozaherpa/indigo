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

                $this->load->model("kinerja/Lkh_model");

                $id_renaksi_detail = $this->input->post("id_renaksi_detail");
                $valid_realisasi = true;

                if ($id_renaksi_detail) {
                    $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                    $total = $total_realisasi + (int) $hasil;
                    if ($total > 100) {
                        $valid_realisasi = false;
                    }
                }

                $today = date("Y-m-d");
                $cut_off = date("Y-m-d", strtotime($today . " -6 days"));

                //$bypass = true;// (date("Y")==2023 && date("n")==1) ? true : false;
                // $bypass = ($tanggal >= "2023-03-01") ? true : false;
                $bypass = true;

                if (!$bypass && $tanggal <= $cut_off) {
                    $response = [
                        'error' => true,
                        'message' => 'Pengisian LKH hanya bisa dilakukan maksimal 5 hari kebelakang',
                    ];
                } else if (!$valid_realisasi) {
                    $response = [
                        'error' => true,
                        'message' => 'Gagal. Akumuliasi pencapaian/realisasi melebihi 100%',
                    ];
                } else if (strlen($uraian) < 255) {
                    $response = [
                        'error' => true,
                        'message' => 'Laporan Hasil Kegiatan Minimal Harus 255 Karakter',
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
                        $file = $this->upload->data('file_name');
                    } else if (!empty($_FILES['file']['tmp_name'])) {
                        //else{
                        $error = true;
                        $response = [
                            'error' => true,
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

                            if ($id_renaksi_detail) {
                                $dt_lkh = array(
                                    'id_renaksi_detail' => $id_renaksi_detail,
                                    'id_laporan_kerja_harian' => $insert
                                );
                                $this->db->insert("ekinerja_lkh", $dt_lkh);

                                $this->Lkh_model->updateCapaian($id_renaksi_detail);
                            }

                            $response = [
                                'error' => false,
                                'message' => 'Laporan berhasil ditambahkan',
                            ];
                        } else {
                            $response = [
                                'error' => true,
                                'message' => 'Gagal menyimpan data.',
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    'error' => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error' => true,
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
                'error' => false,
                'verifikator' => $verifikator,
            ];
        } else {
            $response = [
                'error' => true,
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
                'error' => false,
                'list' => $list,
            ];
        } else {
            $response = [
                'error' => true,
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
                    $file = $this->upload->data('file_name');

                    $path = "./data/kegiatan_personal/$id_pegawai/" . $detail->lampiran;
                    if (file_exists($path) && $detail->lampiran) {
                        unlink($path);
                    }
                } else if (!empty($_FILES['file']['tmp_name'])) {
                    //else{
                    $error = true;
                    $response = [
                        'error' => true,
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

                    $this->load->model("kinerja/Lkh_model");

                    if ($tanggal && $tanggal != "") {

                        $id_renaksi_detail = $this->input->post("id_renaksi_detail");
                        $valid_realisasi = true;

                        $param_lkh['where']['lkh.id_laporan_kerja_harian'] = $id;
                        $lkh = $this->Lkh_model->get($param_lkh)->row();
                        if ($lkh) {
                            $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                            $total = $total_realisasi - (int) $lkh->hasil_kegiatan + (int) $hasil;
                            if ($total > 100) {
                                $valid_realisasi = false;
                            }
                        }


                        $today = date("Y-m-d");
                        $cut_off = date("Y-m-d", strtotime($today . " -3 days"));
                        if ($tanggal <= $cut_off) {
                            $response = [
                                'error' => true,
                                'message' => 'Pengisian LKH hanya bisa dilakukan maksimal 3 hari kebelakang',
                            ];
                            $error = true;
                        } else if (!$valid_realisasi) {
                            $response = [
                                'error' => true,
                                'message' => 'Gagal. Akumuliasi pencapaian/realisasi melebihi 100%',
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

                            // Kinerja > LKH
                            if ($id_renaksi_detail) {

                                $dt_lkh = array(
                                    'id_renaksi_detail' => $id_renaksi_detail
                                );
                                $this->db
                                    ->where("id_laporan_kerja_harian", $id)
                                    ->update("ekinerja_lkh", $dt_lkh);

                                $this->Lkh_model->updateCapaian($id_renaksi_detail);
                            }

                            $response = [
                                'error' => false,
                                'message' => 'Laporan berhasil diubah',
                            ];
                        } else {
                            $response = [
                                'error' => true,
                                'message' => 'Gagal mengubah laporan.',
                            ];
                        }
                    }
                }
            } else {
                $response = [
                    'error' => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error' => true,
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
                if ($detail->lampiran && file_exists($path)) {
                    unlink($path);
                }
                $delete = $this->laporan_kinerja_harian_model->delete($id);
                if ($delete) {
                    $response = [
                        'error' => false,
                        'message' => 'Laporan berhasil dihapus',
                    ];
                } else {
                    $response = [
                        'error' => true,
                        'message' => 'Gagal menghapus laporan.',
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error' => true,
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
                'error' => false,
                'list' => $list,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential' . $api_key,
                'header' => $headers
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

                $rating = $this->input->post("rating");
                if ($rating) {
                    $dt_rating = array(
                        'id_laporan_kerja_harian' => $id,
                        'rating' => $rating,
                        'komentar' => $this->input->post("komentar"),
                    );
                    $this->db->insert("laporan_kerja_harian_rating", $dt_rating);
                }

                $update = $this->laporan_kinerja_harian_model->update($data, $id);
                if ($update) {

                    $id_pegawai = $detail->id_pegawai;
                    $bulan = date("m", strtotime($detail->tanggal));
                    $tahun = date("Y", strtotime($detail->tanggal));
                    $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);
                    $response = [
                        'error' => false,
                        'message' => $message,
                    ];
                } else {
                    $response = [
                        'error' => true,
                        'message' => 'Gagal memeverifikasi laporan.',
                    ];
                }
            } else {
                $response = [
                    'error' => true,
                    'message' => 'Invalid data',
                ];
            }
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential',
            ];
        }

        $this->response($response);
    }

    public function rencana_hasil_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tanggal = $this->input->post("tanggal");

        if ($api_key != null && $cekApi && $tanggal) {

            $this->load->model("kinerja/Kinerja_utama_model");
            $this->load->model("kinerja/Kinerja_tambahan_model");
            $this->load->model("kinerja/Instruksi_model");

            $tahun = date("Y", strtotime($tanggal));

            $id_pegawai = $cekApi->id_pegawai;
            if (in_array($cekApi->username, ['demo_kepala'])) {
                $param['limit'] = 10;
                $param['offset'] = 0;
            } else {
                $param['where']['skp.id_pegawai'] = $id_pegawai;
            }
            $param['where']['skp.tahun_desc'] = $tahun;
            $param['where']['skp.status'] = 'Sudah Diverifikasi';

            $dt_kinerja_utama = $this->Kinerja_utama_model->get($param)->result();
            $dt_kinerja_tambahan = $this->Kinerja_tambahan_model->get($param)->result();
            $dt_instruksi = $this->Instruksi_model->get_instruksi_khusus($param)->result();

            $data = array();

            foreach ($dt_kinerja_utama as $row) {
                if ($row->flag == "sasaran") {
                    $_rencana_hasil = $row->nama_indikator_sasaran_renstra;
                } else {
                    $_rencana_hasil = $row->rencana_hasil_kerja;
                }

                $temp = array(
                    'flag' => 'Kinerja Utama',
                    'id' => $row->id_kinerja_utama,
                    'nama' => $_rencana_hasil
                );

                $data[] = $temp;
            }

            foreach ($dt_instruksi as $row) {

                $temp = array(
                    'flag' => 'Instruksi Khusus',
                    'id' => $row->id_instruksi_khusus,
                    'nama' => $row->indikator_kinerja_individu
                );

                $data[] = $temp;
            }

            foreach ($dt_kinerja_tambahan as $row) {

                $temp = array(
                    'flag' => 'Kinerja Tambahan',
                    'id' => $row->id_kinerja_tambahan,
                    'nama' => $row->rencana_hasil_kerja
                );

                $data[] = $temp;
            }

            $response = [
                'error' => false,
                'data' => $data,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential / request',
            ];
        }

        $this->response($response);
    }

    public function renaksi_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $tanggal = $this->input->post("tanggal");
        $id_rencana_hasil = $this->input->post("id_rencana_hasil");
        $flag = $this->input->post("flag");

        if ($api_key != null && $cekApi && $tanggal && $id_rencana_hasil && $flag) {

            $this->load->model("kinerja/Kinerja_utama_model");
            $this->load->model("kinerja/Kinerja_tambahan_model");
            $this->load->model("kinerja/Instruksi_model");
            $this->load->model("kinerja/Renaksi_model");
            $this->load->model("kinerja/Lkh_model");

            $tahun = date("Y", strtotime($tanggal));
            $bulan = date("n", strtotime($tanggal));


            if ($flag == "Kinerja Utama") {
                $param['where']['renaksi.id_kinerja_utama'] = $id_rencana_hasil;
            }

            if ($flag == "Kinerja Tambahan") {
                $param['where']['renaksi.id_kinerja_tambahan'] = $id_rencana_hasil;
            }

            if ($flag == "Instruksi Khusus") {
                $param['where']['renaksi.id_instruksi_khusus'] = $id_rencana_hasil;
            }

            $param['where']['renaksi.tahun_desc'] = $tahun;
            $param['where']['renaksi_detail.bulan'] = $bulan;
            $param['where']['renaksi_detail.status_jadwal'] = "Y";

            $data = $this->Renaksi_model->get_detail($param)->result();

            $realisasi = [];
            $param['group_by'] = "renaksi_detail.id_renaksi_detail";
            $dt_realisasi = $this->Lkh_model->getSummaryRealisasi($param)->result();
            foreach ($dt_realisasi as $row) {
                $realisasi[$row->id_renaksi_detail] = $row->total;
            }

            foreach ($data as $row) {
                $capaian = (!empty($realisasi[$row->id_renaksi_detail])) ? $realisasi[$row->id_renaksi_detail] : 0;
                $row->realisasi = $capaian;
            }


            $response = [
                'error' => false,
                'data' => $data,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential / request',
            ];
        }

        $this->response($response);
    }

    public function list_v2_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $param = array();
            $param['where']['pegawai.id_pegawai'] = $id_pegawai;

            $today = date("Y-m-d");
            $tanggal = date('Y-m-d', strtotime($today . ' - 14 day'));
            $param['where']["laporan_kerja_harian.tanggal >= "] = $tanggal;

            $this->load->model("kinerja/Lkh_model");
            $list = $this->Lkh_model->get($param)->result();

            $response = [
                'error' => false,
                'list' => $list,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential. ' . $api_key,
            ];
        }

        $this->response($response);
    }

    public function verifikasi_list_v2_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $param = array();
            if ($id_pegawai != 315) {
                $param['where']['laporan_kerja_harian.id_verifikator'] = $id_pegawai;
            } else {
                $param['limit'] = 10;
                $param['offset'] = 0;
                $param['where']['laporan_kerja_harian.status_verifikasi'] = "sudah_diverifikasi";
                //$param['str_where'] = "(laporan_kerja_harian.catatan is not null)";
            }

            $today = date("Y-m-d");
            $tanggal = date('Y-m-d', strtotime($today . ' - 14 day'));
            $param['where']["laporan_kerja_harian.tanggal >= "] = $tanggal;

            $this->load->model("kinerja/Lkh_model");
            $list = $this->Lkh_model->get($param)->result();

            $response = [
                'error' => false,
                'list' => $list,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential. ' . $api_key,
            ];
        }

        $this->response($response);
    }


    public function verifikasi_list_v3_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);


        if ($api_key != null && $cekApi) {
            $id_pegawai = $cekApi->id_pegawai;
            $param = array();

            $param['verifikasi'] = true;
            $param['where']['laporan_kerja_harian.id_verifikator'] = $id_pegawai;


            $today = date("Y-m-d");
            $tanggal = date('Y-m-d', strtotime($today . ' - 14 day'));
            $param['where']["laporan_kerja_harian.tanggal >= "] = $tanggal;

            $this->load->model("kinerja/Lkh_model");
            $list = $this->Lkh_model->get($param)->result();

            foreach ($list as $key => $row) {
                $status = ($row->sudah_diverifikasi == $row->jumlah_laporan) ? "Sudah Diverifikasi" : "Belum Diverifikasi";
                $list[$key]->status = $status;
                $list[$key]->tanggal_desc = date("d M", strtotime($row->tanggal));
            }


            $response = [
                'error' => false,
                'list' => $list,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential. ' . $api_key,
            ];
        }

        $this->response($response);
    }

    public function detail_list_get()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);

        $id_pegawai = $this->input->get("id_pegawai");
        $tanggal = $this->input->get("tanggal");


        if ($api_key != null && $cekApi && $id_pegawai && $tanggal) {

            $param = array();

            $param['where']['laporan_kerja_harian.id_pegawai'] = $id_pegawai;
            $param['where']['laporan_kerja_harian.tanggal'] = $tanggal;
            $this->db->group_by("laporan_kerja_harian.id_laporan_kerja_harian");

            $this->load->model("kinerja/Lkh_model");
            $result = $this->Lkh_model->get($param)->result();

            $response = [
                'error' => false,
                'list' => $result,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential. ' . $api_key,
            ];
        }

        $this->response($response);
    }


    public function verifikasi_v2_post()
    {
        $headers = $this->input->request_headers();
        $api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
        $api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
        $cekApi = $this->user_model->checkApiKey($api_key);
        $id_pegawai = $this->input->post("id_pegawai");
        $tanggal = $this->input->post("tanggal");

        if ($api_key != null && $cekApi && $id_pegawai && $tanggal) {

            $param['where']['laporan_kerja_harian.id_pegawai'] = $id_pegawai;
            $param['where']['laporan_kerja_harian.tanggal'] = $tanggal;
            $this->db->group_by("laporan_kerja_harian.id_laporan_kerja_harian");
            $this->load->model("kinerja/Lkh_model");
            $result = $this->Lkh_model->get($param)->result();
            foreach ($result as $key => $row) {
                $id_laporan_kerja_harian = $row->id_laporan_kerja_harian;

                if ($this->input->post("rating")) {
                    $dt_rating = array(
                        'id_laporan_kerja_harian' => $id_laporan_kerja_harian,
                        'rating' => $this->input->post("rating"),
                        'komentar' => $this->input->post("komentar"),
                    );
                    $this->db->insert("laporan_kerja_harian_rating", $dt_rating);
                }
                $data = array(
                    'status_verifikasi' => 'sudah_diverifikasi',
                );

                $update = $this->laporan_kinerja_harian_model->update($data, $id_laporan_kerja_harian);



                $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
                $detail = (array) $detail;
                $insert_log = $this->laporan_kinerja_harian_model->insert_log($detail, $id_laporan_kerja_harian);

                $id_pegawai = $detail['id_pegawai'];
                $bulan = date("m", strtotime($detail['tanggal']));
                $tahun = date("Y", strtotime($detail['tanggal']));
                $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);
            }

            $response = [
                'error' => false,
                'message' => "Laporan berhasil diverifikasi",
            ];


        } else {
            $response = [
                'error' => true,
                'message' => 'Invalid credential / data',
            ];
        }

        $this->response($response);
    }
}