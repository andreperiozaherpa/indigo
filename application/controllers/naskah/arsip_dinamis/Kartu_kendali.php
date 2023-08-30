<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Kartu_kendali extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->load->model('ref_skpd_model');
        $this->load->model('naskah/Kartu_kendali_model', 'kartu_kendali');

        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name = $this->user_model->full_name;
        $this->user_level = $this->user_model->level;
        $this->id_pegawai = $this->user_model->id_pegawai;
        $this->level_id = $this->user_model->level_id;
        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
        // if ($this->level_id > 2) redirect("admin");
        $this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));

        if (!$this->user_id) {
            redirect('admin');
        } elseif (!in_array('tu_pimpinan', $this->user_privileges)) {
            redirect('admin');
        }
    }

    public function internal_masuk()
    {
        $data['title'] = 'Kartu Kendali Masuk - Naskah Internal';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/internal_masuk";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";
        $data['cards'] = $this->kartu_kendali->get_all_where();

        $this->load->view('admin/index', $data);
    }

    public function internal_keluar()
    {
        $data['title'] = 'Kartu Kendali Keluar - Naskah Internal';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/internal_keluar";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";

        $this->load->view('admin/index', $data);
    }

    public function keluar()
    {
        $data['title'] = 'Kartu Kendali Keluar';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/keluar";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";

        $this->load->view('admin/index', $data);
    }

    public function masuk()
    {
        $data['title'] = 'Kartu Kendali Masuk';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/masuk";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";

        $this->load->view('admin/index', $data);
    }

    public function eksternal_masuk()
    {
        $data['title'] = 'Kartu Kendali Masuk - Naskah Eksternal';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/eksternal_masuk";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";

        $this->load->view('admin/index', $data);
    }

    public function eksternal_keluar()
    {
        $data['title'] = 'Kartu Kendali Keluar - Naskah Eksternal';
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['active_menu'] = "naskah/arsip_dinamis/kartu_kendali/eksternal_keluar";
        $data['content'] = "naskah/arsip_dinamis/kartu_kendali/index";
        $data['cards'] = $this->kartu_kendali->get_all_where();

        $this->load->view('admin/index', $data);
    }

    public function disposisi($id_surat_masuk)
    {
        $disposisi = $this->db->get_where('disposisi_surat_masuk', array('id_surat_masuk' => $id_surat_masuk))->result();

        if (!empty($disposisi)) {
            foreach ($disposisi as $dis) {
                $dis->id_pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $dis->id_pegawai))->row();
                $dis->id_pegawai->id_jabatan = $this->db->get_where('ref_jabatan_baru', array('id_jabatan' => $dis->id_pegawai->id_jabatan))->row();
                $dis->id_pegawai_disposisi = $this->db->get_where('pegawai', array('id_pegawai' => $dis->id_pegawai_disposisi))->row();
            }
        }

        $surat = $this->db->get_where('surat_masuk', array('id_surat_masuk' => $id_surat_masuk))->row();
        $surat->id_skpd_penerima = $this->db->get_where('ref_skpd', array('id_skpd' => $surat->id_skpd_penerima))->row();
        $data['skpd'] = $this->db->get_where('ref_skpd', array('id_skpd' => $this->session->userdata('id_skpd')))->row();
        $data['surat'] = $surat;
        $data['disposisi'] = $disposisi;
        $data['title'] = 'Cetak Disposisi - ' . $surat->perihal;

        //        echo json_encode($data); die;
        $this->load->view('admin/arsip_dinamis/kartu_kendali/disposisi', $data);
    }

    public function get_kartu_kendali()
    {
        $uriSegment = $this->input->post('params');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $klasifikasi = $this->input->post('classification');
        $jenis = null;
        $tipe = null;
        $tglParam = null;

        switch ($uriSegment) {
            case "keluar":
                $tipe = "keluar";
                $tglParam = "tgl_buat";
                break;
            case "masuk":
                $tipe = "masuk";
                $tglParam = "tanggal_surat";
                break;
        }

        $where = array(
            'skpd' => $this->session->userdata('id_skpd'),
            'tipe_kendali' => $tipe,
            'temp' => 'N',
            'nomor_urut !=' => 'NULL'
        );

        if (!empty($klasifikasi)) {
            $where['klasifikasi'] = $klasifikasi;
        }

        $filter = array();
        if (!empty($startDate) && !empty($endDate)) {
            $filter = array(
                $tglParam => ">= $startDate AND <= $endDate",
            );
        } else if (!empty($startDate)) {
            $filter = array(
                $tglParam . ">= " => $startDate
            );
        } else if (!empty($endDate)) {
            $filter = array(
                $tglParam . "<= " => $endDate
            );
        }

        $columns = array(
            0 => 'no',
            1 => 'tanggal_buat',
            2 => 'nomer_surat',
            3 => 'klasifikasi',
            4 => 'perihal',
            5 => 'isi_ringkasan',
            6 => 'surat_id',
            7 => 'disposisi_surat_masuk',
            8 => 'file_surat',
            9 => 'kartu_kendali'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = (!empty($columns[$this->input->post('order')])) ? $columns[$this->input->post('order')[0]['column']] : "";
        $dir = (!empty($this->input->post('order'))) ? $this->input->post('order')[0]['dir'] : "";

        $totalData = $this->kartu_kendali->get_count(null, $where, $filter);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
            $posts = $this->kartu_kendali->get_all_search_where($where, $filter, $limit, $start, null, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts = $this->kartu_kendali->get_all_search_where($where, $filter, $limit, $start, $search, $order, $dir);
            $totalFiltered = $this->kartu_kendali->get_count($search, $where, $filter);
        }

        $data = array();
        if (!empty($posts)) {
            $detailBtn = null;
            $detailDisposisiBtn = null;
            $detailSuratBtn = null;

            foreach ($posts as $post) {
                if ($post->jenis_surat == "internal" && $post->kartu_kendali_tipe_kendali == "keluar") {
                    $detailBtn = "<a class='waves-effect waves-light btn btn-block btn-info' href='" . base_url('surat_internal/detail_surat_keluar/') . $post->surat . "' target='_blank'>Lihat</a>";
                    $detailSuratBtn = "<a class='waves-effect waves-light btn btn-block btn-danger' href='" . base_url('data/surat_internal/ttd/') . $post->file_ttd . "' target='_blank'>Lihat</a>";
                } else if ($post->jenis_surat == "eksternal" && $post->kartu_kendali_tipe_kendali == "keluar") {
                    $detailBtn = "<a class='waves-effect waves-light btn btn-block btn-info' href='" . base_url('surat_eksternal/detail_surat_keluar/') . $post->surat . "' target='_blank'>Lihat</a>";
                    $detailSuratBtn = "<a class='waves-effect waves-light btn btn-block btn-danger' href='" . base_url('data/surat_eksternal/ttd/') . $post->file_ttd . "' target='_blank'>Lihat</a>";
                } else if ($post->kartu_kendali_tipe_kendali == "masuk") {
                    $detailBtn = "<a class='waves-effect waves-light btn btn-block btn-info' href='" . base_url('arsip_surat/detail_surat_masuk/') . $post->surat . "' target='_blank'>Lihat</a>";
                    $detailSuratBtn = "<a class='waves-effect waves-light btn btn-block btn-danger' href='" . base_url('data/surat_eksternal/surat_masuk/') . $post->file_surat . "' target='_blank'>Lihat</a>";
                }

                if (!empty($post->disposisi_surat_masuk)) {
                    $detailDisposisiBtn = "<a class='waves-effect waves-light btn btn-block btn-primary' href='" . base_url('arsip_dinamis/kartu_kendali/disposisi/') . $post->disposisi_surat_masuk . "' target='_blank'>Lihat</a>";
                } else {
                    $detailDisposisiBtn = "<span class='text-center align-content-center align-items-center'>-</span>";
                }

                if ($post->kartu_kendali_tipe_kendali == "masuk" && empty($post->kartu_kendali_pengolah)) {
                    $cetakKendaliBtn = "<button type='button' class='waves-effect waves-light btn btn-block btn-info btn-pengolah' id='" . $post->id . "'>Cetak</button>";
                } else {
                    $cetakKendaliBtn = "<a class='waves-effect waves-light btn btn-block btn-info' href='" . base_url('arsip_dinamis/kartu_kendali/cetak_kendali/') . $post->id . "' target='_blank'>Cetak</a>";
                }

                $nestedData['no'] = $post->kartu_kendali_nomor_urut;
                $nestedData['tanggal_buat'] = (isset($post->tgl_buat)) ? tanggal_hari($post->tgl_buat) : tanggal_hari($post->tanggal_surat);
                $nestedData['nomer_surat'] = $post->nomer_surat;
                $nestedData['jenis_surat'] = $post->jenis_surat;
                $nestedData['klasifikasi'] = $post->klasifikasi->kode_gabungan . " - " . $post->klasifikasi->nama_klasifikasi;
                $nestedData['perihal'] = $post->perihal;
                $nestedData['isi_ringkasan'] = $post->kartu_kendali_isi_ringkasan;
                $nestedData['surat_id'] = $detailBtn;
                $nestedData['disposisi_surat_masuk'] = $detailDisposisiBtn;
                $nestedData['file_surat'] = $detailSuratBtn;
                $nestedData['kartu_kendali'] = $cetakKendaliBtn;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);

    }

    public function updatePengolah()
    {
        $kartuKendaliId = $this->input->post('kartuKendali');
        $pengolah = $this->input->post('pengolah');

        $update = $this->kartu_kendali->update_pengolah($kartuKendaliId, $pengolah);

        if ($update) {
            redirect("arsip_dinamis/kartu_kendali/cetak_kendali/$kartuKendaliId");
        } else {
            echo "Terjadi Kesalahan! Silahkan kembali dan coba lagi";
        }
    }

    public function cetak_kendali($kendaliId)
    {
        if (empty($kendaliId)) {
            redirect('admin');
        }

        $kendali = $this->kartu_kendali->get_single_where(array('id' => $kendaliId));
        $data['title'] = 'Cetak Kartu Kendali - ' . $kendali->surat->perihal;

        $receiversArr = [];
        if ($kendali->tipe_kendali == "keluar") {
            $this->load->model('surat_keluar_model');

            if ($kendali->jenis_surat == "eksternal") {
                $getReceivers = $this->surat_keluar_model->get_penerima($kendali->surat->id_surat_keluar);

                foreach ($getReceivers as $receiver) {
                    if ($receiver->jenis_penerima == "skpd" || $receiver->jenis_penerima == "desa") {
                        //                        $receivers['receivers'] = "Kepala " . $receiver->nama_skpd;
                        array_push($receiversArr, (object) [
                            'name' => "Kepala " . $receiver->nama_skpd
                        ]);
                    } else {
                        array_push($receiversArr, (object) [
                            'name' => $receiver->nama_penerima
                        ]);
                    }
                }

            } else {
                $getReceivers = $this->surat_keluar_model->get_penerima($kendali->surat->id_surat_keluar);

                foreach ($getReceivers as $receiver) {
                    array_push($receiversArr, (object) [
                        'name' => $receiver->nama_lengkap . " - " . $receiver->jabatan
                    ]);
                }
            }

        } else {
            $this->load->model('surat_masuk_model');
            $getSender = $this->surat_masuk_model->get_detail_by_id($kendali->surat->id_surat_masuk);
            array_push($receiversArr, (object) [
                'name' => $getSender->nama_lengkap_input . " - " . $getSender->jabatan_input
            ]);
        }

        $data['kendali'] = $kendali;
        $data['receivers'] = $receiversArr;

        $dompdf = new Dompdf();
        $html = $this->output->get_output();

        if ($kendali->tipe_kendali == "keluar") {
            $this->load->view('admin/arsip_dinamis/kartu_kendali/cetak_keluar', $data);
            //            $html       = $this->load->view('admin/arsip_dinamis/kartu_kendali/cetak_keluar', $data, true);
        } else if ($kendali->tipe_kendali == "masuk") {
            //            $html       = $this->load->view('admin/arsip_dinamis/kartu_kendali/cetak_masuk', $data, true);
            $this->load->view('admin/arsip_dinamis/kartu_kendali/cetak_masuk', $data);
        }

        //        $filenameTemp       = $data['title'] . date('Ymdhis');
//        $filename           = str_replace(' ', '_', $filenameTemp);
//
//        $dompdf->load_html($html);
//        $dompdf->set_paper('A5', 'landscape');
//        $dompdf->render();
//        $dompdf->stream($filename.".pdf", array('Attachment' => false));
    }

    // for testing data
    public function cari_data()
    {
        $search = $this->input->get('search');
        $tipe_kendali = $this->input->get('tipe');
        $startDate = $this->input->get('startDate');
        $endDate = $this->input->get('endDate');
        $klasifikasi = $this->input->get('klasifikasi');

        $where = array(
            'temp' => 'N',
            'tipe_kendali' => $tipe_kendali,
            'skpd' => $this->session->userdata('id_skpd'),
            'nomor_urut != ' => null
        );

        if (!empty($klasifikasi)) {
            $where['klasifikasi'] = $klasifikasi;
        }
        $this->db->where($where);
        $cards = $this->db->get('kartu_kendali');

        if ($cards->num_rows() > 0) {
            foreach ($cards->result() as $card) {
                if ($card->sumber_surat == "surat_masuk" && $card->tipe_kendali == "masuk") {
                    if (!empty($startDate) && !empty($endDate)) {
                        $this->db->where("tanggal_surat BETWEEN $startDate AND $endDate");
                    } else if (!empty($startDate)) {
                        $this->db->where("tanggal_surat >=", $startDate);
                    } else if (!empty($endDate)) {
                        $this->db->where("tanggal_surat <=", $endDate);
                    }
                    $this->db->select('surat_masuk.*');
                    $this->db->join('surat_masuk', 'surat_masuk.id_surat_masuk = kartu_kendali.surat');
                } else if ($card->sumber_surat == "surat_keluar" && $card->tipe_kendali == "keluar") {
                    $this->db->select('surat_keluar.*');
                    $this->db->join('surat_keluar', 'surat_keluar.id_surat_keluar = kartu_kendali.surat');
                }

                if (!empty($search)) {
                    $this->db->like('perihal', $search);
                    $this->db->or_like('nomer_surat', $search);
                }

                if (!empty($where)) {
                    $this->db->where($where);
                }

                //                if (!empty($startDate) && !empty($endDate)) {
//                    $this->db->where("tgl_buat >= ", $startDate);
//                    $this->db->where("tgl_buat <= ", $endDate);
//                } else if (!empty($startDate)) {
//                    $this->db->where("surat_keluar.tgl_buat >= ", $startDate);
//                } else if (!empty($endDate)) {
//                    $this->db->where("surat_keluar.tgl_buat <= ", $endDate);
//                }

                $where['deleted_at'] = null;
                $this->db->select('id, kartu_kendali.indeks as kartu_kendali_indeks, nomor_urut as kartu_kendali_nomor_urut, kartu_kendali.isi_ringkasan as kartu_kendali_isi_ringkasan, kartu_kendali.catatan as kartu_kendali_catatan, kartu_kendali.lembar as kartu_kendali_lembar, kartu_kendali.jenis_surat as kartu_kendali_jenis_surat, sumber_surat, tipe_kendali as kartu_kendali_tipe_kendali, pengolah as kartu_kendali_pengolah, surat, klasifikasi, skpd, temp, created_at, updated_at, deleted_at');
                $cards_post = $this->db->get_where('kartu_kendali', $where)->result();

                if (!empty($cards_post)) {
                    foreach ($cards_post as $cp) {
                        $cp->klasifikasi = $this->db->get_where('surat_klasifikasi', array('id_surat_klasifikasi' => $cp->klasifikasi))->row();
                        ////                        $cp->id_pegawai_input = $this->db->select('nama_lengkap, jabatan')->where(array('id_pegawai' => $cp->id_pegawai_input))->get('pegawai')->row();
                    }
                }

                echo json_encode($cards_post);
            }
        } else {
            echo json_encode($cards);
        }
    }

    public function get_single_row()
    {
        //        $where['surat']         = $id_surat_keluar;
//        $where['temp']          = 'Y';
//        $kartu_kendali_get      = $this->kartu_kendali->get_single_where($where);
//
//        $kartu_kendali_data['temp']         = 'N';
//        $kartu_kendali_data['updated_at']   = date('Y-m-d H:i:s');
//
//        echo json_encode($kartu_kendali_get);

        $this->load->model('surat_masuk_model');
        $receiver = $this->surat_masuk_model->get_single_row(5);

        echo json_encode($receiver);
    }
}