<?php
// Load plugin PHPExcel nya
include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
include_once(APPPATH . "third_party/PHPExcel/PHPExcel.php");

class Lembar_kerja_evaluasi extends CI_Controller
{

    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->load->model('master_pegawai_model');
        $this->load->model('lembar_kerja_evaluasi_model');
        $this->load->model('ref_skpd_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;
        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));
        // $this->session->set_userdata('id_skpd', 1);
        // $this->session->set_userdata('id_pegawai', 400);

        //$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
    }

    public function rb()
    {

        if ($this->user_id) {
            $data['nama'] = 'Reformasi Birokrasi';
            $data['title']        = "Laporan Kerja Evaluasi - " . $data['nama'];
            $data['content']    = "lembar_kerja_evaluasi/lke";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "lembar_kerja_evaluasi";
            $data['id_skpd'] = $this->session->userdata('id_skpd');
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['indikator'] = $this->lembar_kerja_evaluasi_model->get_indikator('rb', 1);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }


    public function zi_wbk()
    {

        if ($this->user_id) {
            $data['nama'] = 'ZI-WBK';
            $data['title']        = "Laporan Kerja Evaluasi - " . $data['nama'];
            $data['content']    = "lembar_kerja_evaluasi/lke";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "lembar_kerja_evaluasi";
            $data['id_skpd'] = $this->session->userdata('id_skpd');
            $id_skpd = $this->session->userdata('id_skpd');
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['indikator'] = $this->lembar_kerja_evaluasi_model->get_indikator('zi_wbk', 1);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function koreksi($jenis_lke = '', $jenis_skpd = '')
    {
        if (!empty($jenis_lke)) {
            $data['nama'] = $jenis_lke == 'rb' ? 'Reformasi Birokrasi' : 'ZI-WBK';
            $data['title']        = "Koreksi Laporan Kerja Evaluasi - " . $data['nama'];
            $data['content']    = "lembar_kerja_evaluasi/koreksi";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "lembar_kerja_evaluasi";
            $data['jenis_lke'] = $jenis_lke;

            $hal = 6;
            $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
            $mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
            if ($jenis_skpd !== '') {
                $total = count($this->ref_skpd_model->get_by_jenis($jenis_skpd));
            } else {
                $total = count($this->ref_skpd_model->get_all());
            }
            $data['pages'] = ceil($total / $hal);
            $data['current'] = $page;
            if (!empty($_POST)) {
                $filter = $_POST;
                $data['filter'] = true;
                $data['filter_data'] = $_POST;
            } else {
                $filter = '';
                $data['filter'] = false;
            }
            if ($jenis_skpd !== '') {
                $data['list'] = $this->ref_skpd_model->get_page($mulai, $hal, $filter, $jenis_skpd, true);
            } else {
                $data['list'] = $this->ref_skpd_model->get_page($mulai, $hal, $filter, '', true);
            }
            $this->load->view('admin/index', $data);
        } else {
            show_404();
        }
    }


    public function rekap($jenis_lke = '', $jenis_skpd = '')
    {
        if (!empty($jenis_lke)) {
            $data['nama'] = $jenis_lke == 'rb' ? 'Reformasi Birokrasi' : 'ZI-WBK';
            $data['title']        = "Koreksi Laporan Kerja Evaluasi - " . $data['nama'];
            $data['content']    = "lembar_kerja_evaluasi/rekap";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "lembar_kerja_evaluasi";
            $data['jenis_lke'] = $jenis_lke;
            if ($jenis_skpd !== '') {
                $data['list'] = ($this->ref_skpd_model->get_by_jenis($jenis_skpd));
            } else {
                $data['list'] = ($this->ref_skpd_model->get_all());
            }
            $this->load->view('admin/index', $data);
        } else {
            show_404();
        }
    }

    public function koreksi_detail($jenis_lke, $id_skpd)
    {

        if ($this->user_id) {
            $data['nama'] = $jenis_lke == 'rb' ? 'Reformasi Birokrasi' : 'ZI-WBK';
            $data['title']        = "Laporan Kerja Evaluasi - " . $data['nama'];
            $data['content']    = "lembar_kerja_evaluasi/koreksi_detail";
            $data['user_picture'] = $this->user_picture;
            $data['full_name']        = $this->full_name;
            $data['user_level']        = $this->user_level;
            $data['active_menu'] = "lembar_kerja_evaluasi";
            $data['id_skpd'] = $id_skpd;
            $data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
            $data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
            $id_pegawai = $this->session->userdata('id_pegawai');
            $data['indikator'] = $this->lembar_kerja_evaluasi_model->get_indikator($jenis_lke, 1, $id_skpd);
            $this->load->view('admin/index', $data);
        } else {
            redirect('admin');
        }
    }

    public function get_jawaban($id_lke_indikator = '')
    {
        if ($id_lke_indikator !== '') {
            $detail = $this->lembar_kerja_evaluasi_model->get_by_id($id_lke_indikator);
            $jawaban = $this->lembar_kerja_evaluasi_model->get_jawaban_indikator($id_lke_indikator);
            if ($detail->jenis_jawaban == 'multiple') {
                $detail->jawaban = $jawaban->result();
            } else {
                $detail->jawaban = $jawaban->row();
            }
            echo json_encode($detail);
        } else {
            show_404();
        }
    }

    public function post_jawaban($method = 'add')
    {
        $res = array();
        if (cekForm($_POST)) {
            $res = array('status' => 0, 'message' => 'Masih ada form yang kosong', 'data' => $_POST);
        } else {
            if (empty($_FILES['lampiran']['name']) && $method == "add") {
                $res = array('status' => 0, 'message' => 'Lampiran masih kosong');
            } else {
                $error_upload = false;
                if ($method == "add") {
                    $config = array(
                        'upload_path' => "./data/lampiran_lke/",
                        'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                        'max_size' => "50480000"
                    );
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('lampiran')) {
                        $lampiran =  $this->upload->data('file_name');
                    } else {
                        $res = array('status' => 0, 'message' => $this->upload->display_errors());
                        $lampiran = NULL;
                        $error_upload = true;
                    }
                }
                if (!$error_upload) {
                    if ($method == 'add') {
                        $insert = [
                            'id_skpd' => $this->session->userdata('id_skpd'),
                            'id_pegawai' => $this->session->userdata('id_pegawai'),
                            'id_lke_indikator' => $_POST['id_lke_indikator'],
                            'jawaban' => $_POST['jawaban'],
                            'catatan' => $_POST['catatan'],
                            'lampiran' => $lampiran,
                            'tanggal_waktu' => date('Y-m-d H:i:s'),
                        ];
                        $insert = $this->lembar_kerja_evaluasi_model->insert_jawaban($insert);
                    } else {
                        $insert = [
                            'id_skpd' => $this->session->userdata('id_skpd'),
                            'id_pegawai' => $this->session->userdata('id_pegawai'),
                            // 'id_lke_indikator' => $_POST['id_lke_indikator'],
                            'jawaban' => $_POST['jawaban'],
                            'catatan' => $_POST['catatan'],
                            // 'lampiran' => $lampiran,
                            'tanggal_waktu' => date('Y-m-d H:i:s'),
                        ];

                        if (!empty($_FILES['lampiran']['name'])) {

                            $config = array(
                                'upload_path' => "./data/lampiran_lke/",
                                'allowed_types' => "jpeg|gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx",
                                'max_size' => "50480000"
                            );
                            $this->load->library('upload', $config);
                            if ($this->upload->do_upload('lampiran')) {
                                $insert['lampiran'] =  $this->upload->data('file_name');
                            } else {
                                $res = array('status' => 0, 'message' => $this->upload->display_errors());
                                $insert['lampiran'] = NULL;
                                $error_upload = true;
                            }
                        }
                        $insert = $this->lembar_kerja_evaluasi_model->update_jawaban($insert, $_POST['id_lke_jawaban']);
                    }
                    if ($insert) {
                        if ($method == 'add') {

                            $id_induk = $_POST['id_induk'];
                        } else {
                            $detail = $this->lembar_kerja_evaluasi_model->get_jawaban_by_id($_POST['id_lke_jawaban']);
                            $id_induk = $detail->id_induk;
                        }
                        $tabel = $_POST['tabel'];
                        $indikator_jawaban = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($id_induk, true, $this->session->userdata('id_skpd'));
                        $data = '';
                        foreach ($indikator_jawaban as $k => $j) {
                            $no = $k + 1;
                            $data .= '
                            <tr>
                                <td class="text-center">' . $no . '</td>
                                <td>' . $j->nama_indikator . '</td>
                                <td>' . normal_string($j->alias_jenis_jawaban) . '</td>
                                <td>' . $j->jawaban . '</td>
                                <td>' . $j->nilai . '</td>
                                <td class="text-center">
                                ';
                            if ($j->jawaban == "Belum diisi") {
                                $data .= '<a href="javascript:void(0)" onclick="isiJawaban(' . $j->id_lke_indikator . ',\'' . $tabel . '\',' . $id_induk . ')" class="btn btn-primary">Isi Jawaban</a>';
                            } else {
                                $data .= '
                                <a href="javascript:void(0)" onclick="lihatJawaban(' . $j->id_lke_jawaban . ')" class="btn btn-success">Detail Jawaban</a>
                                <a href="javascript:void(0)" onclick="editJawaban(' . $j->id_lke_jawaban . ',\'' . $tabel . '\')" class="btn btn-info">Edit Jawaban</a>
                                ';
                            }
                            $data .= '</td>
                            </tr>';
                        }
                        $res = array('status' => 1, 'message' => 'Jawaban berhasil disimpan', 'tabel' => $tabel, 'data' => $data);
                    } else {
                        $res = array('status' => 0, 'message' => 'Terjadi kesalahan');
                    }
                }
            }
        }
        echo json_encode($res);
    }


    public function post_jawaban_koreksi()
    {
        $res = array();
        if (cekForm($_POST)) {
            $res = array('status' => 0, 'message' => 'Masih ada form yang kosong');
        } else {
            $insert = [
                'id_skpd' => $_POST['id_skpd'],
                'id_pegawai_koreksi' => $this->session->userdata('id_pegawai'),
                'id_lke_indikator' => $_POST['id_lke_indikator'],
                'jawaban' => $_POST['jawaban'],
                'catatan' => $_POST['catatan'],
                'tanggal_waktu' => date('Y-m-d H:i:s'),
            ];
            $insert = $this->lembar_kerja_evaluasi_model->insert_jawaban_koreksi($insert);
            if ($insert) {
                $id_induk = $_POST['id_induk'];
                $tabel = $_POST['tabel'];
                $indikator_jawaban = $this->lembar_kerja_evaluasi_model->get_indikator_by_induk($id_induk, true, $_POST['id_skpd'], true);
                $data = '';
                foreach ($indikator_jawaban as $k => $j) {
                    $no = $k + 1;
                    $data .= '
                    <tr>
                        <td class="text-center">' . $no . '</td>
                        <td>' . $j->nama_indikator . '</td>
                        <td>' . normal_string($j->alias_jenis_jawaban) . '</td>
                        <td>';
                    $data .= $j->jawaban;
                    if ($j->jawaban_koreksi !== "Belum diisi") {
                        $data .= '<div class="alert alert-success" style="margin-top:10px">
                            <b>Koreksi :</b> <br>
                                ' . $j->jawaban_koreksi . '
                            </div>';
                    }
                    $data .= '</td>
                    <td>';
                    $data .= $j->nilai;
                    if ($j->jawaban_koreksi !== "Belum diisi") {
                        $data .= '<div class="alert alert-success" style="margin-top:10px">
                            ' . $j->nilai_koreksi . '
                        </div>';
                    }
                    $data .= '</td>
                        <td class="text-center">
                        ';
                    if ($j->jawaban !== "Belum diisi") {
                        $data .= '<a href="javascript:void(0)" onclick="lihatJawaban(' . $j->id_lke_jawaban . ')" class="btn  btn-block mb-2 btn-sm btn-success">Detail Jawaban</a>';
                        if ($j->jawaban_koreksi == "Belum diisi") {
                            $data .= '<a href="javascript:void(0)" onclick="isiKoreksi(' . $j->id_lke_indikator . ',\'' . $tabel . '\',' . $id_induk . ')" class="btn btn-block mb-2  btn-sm btn-warning">Koreksi</a>';
                        } else {
                            $data .= '<a href="javascript:void(0)" onclick="lihatJawabanKoreksi(' . $j->id_lke_jawaban_koreksi . ')" class="btn btn-block mb-2  btn-sm btn-success">Detail Koreksi</a>';
                        }
                    }
                    $data .= '</td>
                    </tr>';
                }
                $res = array('status' => 1, 'message' => 'Jawaban berhasil disimpan', 'tabel' => $tabel, 'data' => $data);
            } else {
                $res = array('status' => 0, 'message' => 'Terjadi kesalahan');
            }
        }
        echo json_encode($res);
    }


    public function get_detail_jawaban($id_lke_jawaban = '')
    {
        if ($id_lke_jawaban !== '') {
            $detail = $this->lembar_kerja_evaluasi_model->get_jawaban_by_id($id_lke_jawaban);
            if ($detail->jenis_jawaban == 'multiple') {
                $get_pilihan = $this->lembar_kerja_evaluasi_model->get_pilihan_by_id($detail->jawaban);
                $detail->id_jawaban = $detail->jawaban;
                $detail->jawaban = ($get_pilihan) ? $get_pilihan->penjelasan : '-';
            } else {
                $detail->jawaban = $detail->jawaban;
            }
            $jawaban = $this->lembar_kerja_evaluasi_model->get_jawaban_indikator($detail->id_lke_indikator);
            if ($detail->jenis_jawaban == 'multiple') {
                $detail->list_jawaban = $jawaban->result();
            } else {
                $detail->list_jawaban = $jawaban->row();
            }
            echo json_encode($detail);
        } else {
            show_404();
        }
    }
    public function get_detail_jawaban_koreksi($id_lke_jawaban = '')
    {
        if ($id_lke_jawaban !== '') {
            $detail = $this->lembar_kerja_evaluasi_model->get_jawaban_koreksi_by_id($id_lke_jawaban);
            if ($detail->jenis_jawaban == 'multiple') {
                $get_pilihan = $this->lembar_kerja_evaluasi_model->get_pilihan_by_id($detail->jawaban);
                $detail->jawaban = ($get_pilihan) ? $get_pilihan->penjelasan : '-';
            } else {
                $detail->jawaban = $detail->jawaban;
            }

            echo json_encode($detail);
        } else {
            show_404();
        }
    }

    public function excel()
    {
        // $excelreader     = new PHPExcel_Reader_Excel2007();
        // $loadexcel         = $excelreader->load('data/rb.xlsx');
        // $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        // $induk = array();
        // $jenis_lke = 'rb';
        // foreach($sheet as $k => $s){
        //     if((!empty($s['A'])) && (!empty($s['B']))){
        //         $level = 1;
        //         $data_in = array('level'=>$level,'nama_indikator'=>$s['B'],'jenis_lke'=>$jenis_lke,'bobot'=>$s['G']);
        //         $id = $this->lembar_kerja_evaluasi_model->insert_indikator($data_in);
        //         $induk[$level] = $id;
        //     }
        //     if((!empty($s['B'])) && (!empty($s['C']))){
        //         $level = 2;
        //         $id_induk = $induk[$level-1];
        //         $data_in = array('id_induk'=>$id_induk,'level'=>$level,'nama_indikator'=>$s['C'],'jenis_lke'=>$jenis_lke,'bobot'=>$s['G']);
        //         $id = $this->lembar_kerja_evaluasi_model->insert_indikator($data_in);
        //         $induk[$level] = $id;
        //     }
        //     if((!empty($s['C'])) && (!empty($s['D']))){
        //         $level = 3;
        //         $id_induk = $induk[$level-1];
        //         $data_in = array('id_induk'=>$id_induk,'level'=>$level,'nama_indikator'=>$s['D'],'jenis_lke'=>$jenis_lke,'bobot'=>$s['G']);
        //         $id = $this->lembar_kerja_evaluasi_model->insert_indikator($data_in);
        //         $induk[$level] = $id;
        //     }
        //     if((!empty($s['D'])) && (!empty($s['E']))){
        //         $level = 4;
        //         $id_induk = $induk[$level-1];
        //         $data_in = array('id_induk'=>$id_induk,'level'=>$level,'nama_indikator'=>$s['E'],'jenis_lke'=>$jenis_lke,'bobot'=>$s['G']);
        //         $id = $this->lembar_kerja_evaluasi_model->insert_indikator($data_in);
        //         $induk[$level] = $id;
        //     }
        //     if((!empty($s['F']))){
        //         $level = 5;
        //         $id_induk = $induk[$level-1];
        //         $data_in = array('id_induk'=>$id_induk,'level'=>$level,'nama_indikator'=>$s['F'],'jenis_lke'=>$jenis_lke,'bobot'=>0);
        //         $data_in['jenis_jawaban'] = trim(strtolower($s['I']));
        //         $data_in['alias_jenis_jawaban'] = trim($s['J']);
        //         $id = $this->lembar_kerja_evaluasi_model->insert_indikator($data_in);
        //         $pilihan = $s['H'];
        //         if(!empty($pilihan)){
        //             $pilihan = explode(PHP_EOL, $pilihan);
        //             $bobot_jawaban = NULL;
        //             foreach($pilihan as $p){
        //                 if(strpos($p,'.')){
        //                     $ex = explode('.',$p);
        //                     $pil = trim($ex[0]);
        //                     if($data_in['alias_jenis_jawaban']=='A/B/C'){
        //                         if($pil=='a'||$pil=='A'){
        //                             $bobot_jawaban = 1;
        //                         }elseif($pil=='b'||$pil=='B'){
        //                             $bobot_jawaban = 0.5;
        //                         }elseif($pil=='c'||$pil=='C'){
        //                             $bobot_jawaban = 0;
        //                         }
        //                     }elseif($data_in['alias_jenis_jawaban']=='A/B/C/D'){
        //                         if($pil=='a'||$pil=='A'){
        //                             $bobot_jawaban = 1;
        //                         }elseif($pil=='b'||$pil=='B'){
        //                             $bobot_jawaban = 0.67;
        //                         }elseif($pil=='c'||$pil=='C'){
        //                             $bobot_jawaban = 0.33;
        //                         }elseif($pil=='d'||$pil=='D'){
        //                             $bobot_jawaban = 0;
        //                         }
        //                     }elseif($data_in['alias_jenis_jawaban']=='A/B/C/D/E'){
        //                         if($pil=='a'||$pil=='A'){
        //                             $bobot_jawaban = 1;
        //                         }elseif($pil=='b'||$pil=='B'){
        //                             $bobot_jawaban = 0.75;
        //                         }elseif($pil=='c'||$pil=='C'){
        //                             $bobot_jawaban = 0.5;
        //                         }elseif($pil=='d'||$pil=='D'){
        //                             $bobot_jawaban = 0.25;
        //                         }elseif($pil=='e'||$pil=='E'){
        //                             $bobot_jawaban = 0;
        //                         }
        //                     }
        //                 }
        //                 $in = $this->lembar_kerja_evaluasi_model->insert_pilihan(array('id_lke_indikator'=>$id,'penjelasan'=>$p,'bobot_jawaban'=>$bobot_jawaban));
        //             }
        //         }
        //     }

        // }
    }
}
