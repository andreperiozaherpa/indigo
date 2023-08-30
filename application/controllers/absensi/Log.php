<?php
defined('BASEPATH') or exit('No direct script access allowed');

class log extends CI_Controller
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
        $this->load->model("ref_ket_absen_model");
        $this->load->model("master_pegawai_model");
        $this->load->model("tpp/tpp_model");
        $this->load->model("tpp/tpp_perhitungan_model");
        $this->load->model("laporan_kinerja_harian_model");
        $this->load->model('ref_hari_kerja_efektif_model');
        $this->load->model('pegawai_posisi_model');

        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        if (!$this->user_id) {
            redirect("admin");
        }
        // if ($this->user_level !== "Administrator" ){
        //     $this->maintenance();
        //     $this->output->_display();
        //     exit();
        // }
        if ($this->user_level !== "Administrator" && !in_array('kepegawaian', $this->user_privileges) && !in_array('op_kepegawaian', $this->user_privileges)) {
            show_404();
        }
    }

    public function maintenance()
    {
        $data['title']        = "Presensi - Data Log Absensi Pegawai";
        $data['content']    = "perbaikan";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;
        $this->load->view('admin/index', $data);
    }

    public function index()
    {

        $data['title']        = "Presensi - Data Log Absensi Pegawai";
        $data['content']    = "absensi/log/index";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;

        $this->load->model('ref_skpd_model');
        $id_skpd = '';
        if (in_array('kepegawaian', $this->user_privileges)) {
            $data['skpd_kepegawaian'] = $this->session->userdata('id_skpd');
            $data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
            $id_skpd = $data['skpd'][0]->id_skpd;
        } else {
            $data['skpd'] = $this->ref_skpd_model->get_all();
            $data['all_skpd'] = true;
        }
        $param = array();

        $bulan = date("m");
        $tahun = date("Y");

        //var_dump( $this->session->userdata("id_pegawai"));


        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("id_skpd")) {
            $id_skpd = $this->input->get("id_skpd", true);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }

        $download = $this->input->get("download");
        if ($download) {
            $this->download($id_skpd, $bulan, $tahun);
        }
        $data['dt_pegawai'] = $this->absen_model->get_ket_log($id_skpd, $bulan, $tahun);

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['id_skpd'] = $id_skpd;

        $this->load->view('admin/index', $data);
    }

    public function add()
    {

        $data['title']        = "Presensi - Data Log Absensi Pegawai";
        $data['content']    = "absensi/log/add";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;

        $paramA['where']['ref_ket_absen.show'] = 1;
        $data['alasan'] = $this->ref_ket_absen_model->get($paramA)->result();
        //$data['alasan'] = $this->ref_ket_absen_model->get_all();


        if (!empty($_POST)) {
            if ($_POST['id_pegawai'] == '' || $_POST['tanggal_awal'] == '' || $_POST['id_ket_absen'] == '') {
                $data['message_type'] = 'warning';
                $data['message'] = 'Masih ada form yang kosong';
            } else {
                // foreach ($range as $tanggal) {
                $error_upload = false;
                $ket_absen = $this->ref_ket_absen_model->get_by_id($_POST['id_ket_absen']);
                $data_insert = $_POST;
                unset($data_insert['tanggal_awal']);
                unset($data_insert['tanggal_akhir']);
                // $data_insert['tanggal'] = $tanggal;
                if ($ket_absen->satuan == 'hari') {
                    $range = getDatesFromRange($_POST['tanggal_awal'], $_POST['tanggal_akhir']);
                    $data_insert['jumlah'] = count($range);
                } else {
                    $data_insert['jumlah'] = 1;
                }


                $tanggal_list = array();
                if ($ket_absen->satuan == 'bulan' && $ket_absen->continuous > 0) {
                    $tanggal_awal = $_POST['tanggal_awal'];
                    for ($i = 1; $i <= $ket_absen->continuous; $i++) {
                        $tanggal_list[] = array('tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => NULL);
                        $tanggal_awal = nextMonth($tanggal_awal);
                    }
                } else {
                    if ($ket_absen->satuan == 'bulan') {
                        $tanggal_list[] = array('tanggal_awal' => $_POST['tanggal_awal'], 'tanggal_akhir' => NULL);
                    } else {
                        $tanggal_list[] = array('tanggal_awal' => $_POST['tanggal_awal'], 'tanggal_akhir' => $_POST['tanggal_akhir']);
                    }
                }

                foreach ($tanggal_list as $t) {
                    $id_pegawai = $_POST['id_pegawai'];
                    $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
                    $data_insert['id_skpd'] = $pegawai->id_skpd;
                    $data_insert['tanggal_awal'] = $t['tanggal_awal'];
                    $data_insert['tanggal_akhir'] = $t['tanggal_akhir'];
                    if (!empty($_FILES['bukti']['name'])) {
                        if (!file_exists("./data/log_absen/$id_pegawai")) {
                            mkdir("./data/log_absen/$id_pegawai", 0777, true);
                        }
                        $config = array(
                            'upload_path' => "./data/log_absen/$id_pegawai/",
                            'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                            'max_size' => "50480000",
                            'overwrite' => TRUE,
                            'file_name' => $id_pegawai . $_FILES['bukti']['name']
                        );
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('bukti')) {
                            $data_insert['bukti'] =  $this->upload->data('file_name');
                        } else {
                            $data['message'] =  $this->upload->display_errors();
                            $data['message_type'] = 'danger';
                            $error_upload = true;
                        }
                    }
                    // echo "<pre>".print_r($data_insert)."</pre>";
                    if (!$error_upload) {
                        $insert = $this->absen_model->insert_ket_log($data_insert);
                        if ($insert) {
                            $bulan = date("m", strtotime($data_insert['tanggal_awal']));
                            $tahun = date("Y", strtotime($data_insert['tanggal_awal']));
                            // pengecualian :
                            // DL = Dinas Luar; DD = Dinas Dalam; WH = Work from home, IM = Isolasi mandiri
                            // Dianggap hadir (tidak masuk potongan TPP)
                            if (in_array($_POST['id_ket_absen'], ['DL', 'DD', 'WH', 'IM'])) {
                                $tanggal = $t['tanggal_awal'];
                                $tanggal_akhir = $t['tanggal_akhir'];
                                while ($tanggal <= $tanggal_akhir) {
                                    $this->absen_model->insert_absen($id_pegawai, $tanggal);
                                    $tanggal = date("Y-m-d", strtotime($tanggal . " +1 days"));
                                }

                                $param_tap = array(
                                    'id_pegawai'  => $id_pegawai,
                                    'bulan'       => date("m", strtotime($data_insert['tanggal_awal'])),
                                    'tahun'       => date("Y", strtotime($data_insert['tanggal_awal'])),
                                    'id_ket_log'  => "A3", //Tidak Absen Pulang
                                );
                                $this->tpp_model->simpan($param_tap);
                            } else {
                                $param = array(
                                    'id_pegawai'  => $id_pegawai,
                                    'bulan'       => date("m", strtotime($data_insert['tanggal_awal'])),
                                    'tahun'       => date("Y", strtotime($data_insert['tanggal_awal'])),
                                    'id_ket_log'  => $_POST['id_ket_absen'],
                                    'jumlah' => $data_insert['jumlah']
                                );
                                $save_tpp = $this->tpp_model->simpan($param);
                            }


                            //Sakit dan Cuti
                            if (in_array($_POST['id_ket_absen'], [5, 6, 7, 8, 9, 'IM'])) {
                                $range = getDatesFromRange($t['tanggal_awal'], $t['tanggal_akhir']);
                                foreach ($range as $tgl_lkh) {
                                    $data_lkh = array(
                                        'id_pegawai' => $id_pegawai,
                                        'id_skpd' => $pegawai->id_skpd,
                                        'tanggal' => $tgl_lkh,
                                        'rincian_kegiatan' => $ket_absen->ket_absen,
                                        'hasil_kegiatan' => '-',
                                        'lampiran' => NULL,
                                        'id_verifikator' => 0,
                                        'status_verifikasi' => 'sudah_diverifikasi',
                                        'automated' => 1
                                    );
                                    //Insert ke Laporan Kinerja Harian
                                    $insert_lkh = $this->laporan_kinerja_harian_model->insert($data_lkh);

                                    //Hitung ulang TPP LKH
                                    $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);

                                    if ($_POST['id_ket_absen'] !== 'IM') {
                                        //Hapus Absen
                                        $where_absen = array(
                                            'id_pegawai' => $id_pegawai,
                                            'tanggal' => $tgl_lkh,
                                        );
                                        $delete_absen = $this->absen_model->delete_log($where_absen);
                                    }
                                }
                            }

                            // Jika sudah input log Sakit, Cuti, DL, DD, Isolasi dan WFH
                            // Hapus log Tanpa Keterangan JIKA ADA
                            if ($ket_absen->jenis == 'absen' && $_POST['id_ket_absen'] !== 'A2') {
                                $range = getDatesFromRange($t['tanggal_awal'], $t['tanggal_akhir']);
                                foreach ($range as $tgl_log) {
                                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tgl_log);
                                }
                            }
                            // die;
                            $data['message'] = 'Log Absensi Pegawai berhasil ditambahkan';
                            $data['message_type'] = 'success';
                        } else {
                            $data['message'] = 'Terjadi kesalahan';
                            $data['message_type'] = 'danger';
                        }
                    }
                }
                // die;
                // }
            }
        }

        $bulan = date("m");
        $tahun = date("Y");

        //var_dump( $this->session->userdata("id_pegawai"));


        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('admin/index', $data);
    }
    public function get_pegawai($bulan, $tahun)
    {
        $search = $_GET['search'];
        if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian', $this->user_privileges)) {
            $id_skpd = $this->session->userdata('id_skpd');
        } else {
            $id_skpd = '';
        }
        $jabatan = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun, true, $search);
        $list = array();
        foreach ($jabatan as $k => $j) {
            $list[$k]['id'] = $j->id_pegawai;
            $list[$k]['text'] = $j->nama_lengkap . ' - ' . $j->nip . ' - ' . $j->jabatan;
        }
        echo json_encode($list);
    }


    public function get_pegawai_current()
    {
        $search = $_GET['search'];
        if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian', $this->user_privileges)) {
            $id_skpd = $this->session->userdata('id_skpd');
        } else {
            $id_skpd = '';
        }
        // $jabatan = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun, true, $search);
        $this->db->group_start();
            $this->db->or_like('nama_lengkap',$search);
            $this->db->or_like('nip',$search);
            $this->db->or_like('jabatan',$search);
        $this->db->group_end();
        if($id_skpd !== ''){
            $this->db->where('id_skpd',$id_skpd);
        }
        $jabatan = $this->db->get('pegawai')->result();
        $list = array();
        foreach ($jabatan as $k => $j) {
            $list[$k]['id'] = $j->id_pegawai;
            $list[$k]['text'] = $j->nama_lengkap . ' - ' . $j->nip . ' - ' . $j->jabatan;
        }
        echo json_encode($list);
    }

    public function cekAlasan($id_ket_absen)
    {
        $get = $this->ref_ket_absen_model->get_by_id($id_ket_absen);
        echo json_encode($get);
    }

    public function deleteKetLog($id_ket_log, $testing = '')
    {
        $data = $this->absen_model->get_ket_log_by_id($id_ket_log);
        // print_r($data);die;
        $data_delete = (array) $data;
        $delete = $this->absen_model->delete_ket_log($id_ket_log, $data_delete);
        $ket_absen = $this->ref_ket_absen_model->get_by_id($data->id_ket_absen);
        if ($delete) {
            // if($testing==1){
            $bulan = date("m", strtotime($data->tanggal_awal));
            $tahun = date("Y", strtotime($data->tanggal_awal));
            $this->absen_model->generate_tanpa_keterangan_pegawai($data->id_pegawai, $bulan, $tahun);
            // }
            $range = getDatesFromRange($data->tanggal_awal, $data->tanggal_akhir);
            foreach ($range as $tanggal) {
                $where_lkh = array(
                    'id_pegawai' => $data->id_pegawai,
                    'tanggal' => $tanggal,
                    'rincian_kegiatan' => $ket_absen->ket_absen,
                    'automated' => 1
                );
                $delete_lkh = $this->laporan_kinerja_harian_model->delete_where($where_lkh);
            }
            echo true;
        }
    }

    public function listLog($id_skpd = 0, $bulan, $tahun)
    {

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
            0 => 'nip',
            1 => 'nama_lengkap',
            2 => 'ref_ket_absen.ket_absen'
        );
        if (!isset($valid_columns[$col])) {
            $order = null;
        } else {
            $order = $valid_columns[$col];
        }
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id_ket_log', 'desc');
        }

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
        if (!empty($id_skpd)) {
            $this->db->where('pegawai.id_skpd', $id_skpd);
        }
        $this->db->where('MONTH(tanggal_awal)', $bulan);
        $this->db->where('YEAR(tanggal_awal)', $tahun);
        $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_ket_log.id_pegawai', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
        $log = $this->db->get('absen_ket_log');
        $data = array();
        $no = 1;
        foreach ($log->result() as $rows) {

            $dates = $this->absen_model->get_tgl_detail_log($rows->id_ket_log);
            $list_date = !empty($dates) ? groupDate($dates) : null;
            $data[] = array(
                $no,
                $rows->nip,
                $rows->nama_lengkap,
                $list_date,
                $rows->ket_absen,
                '
                <a href="javascript:void(0)" onclick="detailLog(' . $rows->id_ket_log . ')" class="btn btn-primary btn-icon btn-circle"><i class="ti-eye"></i></a>
                <a href="javascript:void(0)" onclick="deleteLog(' . $rows->id_ket_log . ')" class="btn btn-danger btn-icon btn-circle"><i class="ti-trash"></i></a>
           '
            );
            $no++;
        }
        $total_log = $this->totalLog($id_skpd, $bulan, $tahun);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_log,
            "recordsFiltered" => $total_log,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalLog($id_skpd, $bulan, $tahun)
    {
        if (!empty($id_skpd)) {
            $this->db->where('pegawai.id_skpd', $id_skpd);
        }
        $this->db->where('MONTH(tanggal_awal)', $bulan);
        $this->db->where('YEAR(tanggal_awal)', $tahun);
        $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_ket_log.id_pegawai', 'left');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
        $query = $this->db->select("COUNT(*) as num")->get("absen_ket_log");
        $result = $query->row();
        if (isset($result)) return $result->num;
        return 0;
    }

    public function getDetailLog($id_ket_log)
    {
        $res = $this->absen_model->get_ket_log_by_id($id_ket_log);
        $tanggal = $this->absen_model->get_detail_log($id_ket_log);
        foreach ($tanggal as $k => $t) {
            $tanggal[$k]->tanggal_string = tanggal_hari($t->tanggal);
        }
        $res->list_tanggal = $tanggal;
        echo json_encode($res);
    }
}
