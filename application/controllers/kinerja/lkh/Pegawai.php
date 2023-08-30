<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');

        if (!$this->user_id) {
            redirect('admin');
        }

        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();

        $this->user_picture = $this->user_model->user_picture;
        $this->full_name = $this->user_model->full_name;
        $this->user_level = $this->user_model->level;
        $this->user_privileges = $this->user_model->user_privileges;
        $this->id_skpd = $this->user_model->id_skpd;
        $array_privileges = explode(';', $this->user_privileges);


        $this->load->model("sicerdas/Pegawai_model");
        $param_pegawai['where']['pegawai.id_user'] = $this->session->id_user;
        $param_pegawai['where']['pegawai.pensiun'] = 0;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd, ['skpd', 'kecamatan']));


        $hasPrivilege = ($dt_pegawai) ? true : false;

        $this->pegawai = $dt_pegawai;

        if (!$hasPrivilege) {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Lkh_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("laporan_kinerja_harian_model");


        $this->_max_days = 14;
    }


    public function index()
    {
        $data['title'] = 'LKH | ' . $this->Config->app_name;
        $data['content'] = "kinerja/lkh/pegawai/index";
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;
        $data['plugins'] = ['select', 'sweetalert', 'dropify', 'wysihtml5'];
        $data['active_menu'] = "lkh";

        $data['dt_verifikator'] = $this->Lkh_model->getVerifikator($this->pegawai->id_pegawai);

        $today = date("Y-m-d");
        $data['date1'] = date('Y-m-d', strtotime($today . ' -' . $this->_max_days . '  day'));
        $data['date2'] = $today;

        $this->load->view('admin/main', $data);
    }


    public function get_list($rowno = 1)
    {
        if ($this->input->is_ajax_request()) {
            // Row per page
            $rowperpage = 10;
            $offset = ($rowno - 1) * $rowperpage;

            $param = array();
            $param['limit'] = $rowperpage;
            $param['offset'] = $offset;


            $data = array();


            if ($this->input->post("search")) {
                $param['search'] = $this->input->post("search");
            }

            if ($this->input->post("date1")) {
                $param['where']['laporan_kerja_harian.tanggal >= '] = $this->input->post("date1");
            }
            if ($this->input->post("date2")) {
                $param['where']['laporan_kerja_harian.tanggal <= '] = $this->input->post("date2");
            }


            if ($this->pegawai) {
                $param['where']['pegawai.id_pegawai'] = $this->pegawai->id_pegawai;
            }

            if ($this->input->post("status_verifikasi")) {
                $param['where']['laporan_kerja_harian.status_verifikasi'] = $this->input->post("status_verifikasi");
            }


            $result = $this->Lkh_model->get($param)->result();

            $content = '';

            foreach ($result as $key => $row) {

                $offset++;


                $status_desc = ($row->status_verifikasi == "sudah_diverifikasi") ? '<span class="text-success">Sudah Diverifikasi</span>' : '<span class="text-danger">Belum Diverifikasi</span>';



                $btn_action = '<div class="btn-group m-b-20">';

                if ($row->status_verifikasi == 'sudah_diverifikasi') {
                    $btn_action .= '<button onclick="detail(' . $key . ')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="ti-eye"></i></button>';
                } else {
                    $btn_action .= '<button onclick="edit(' . $key . ')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></button>
                    <button onclick="hapus(' . $row->id_laporan_kerja_harian . ')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></button>';
                }

                $btn_action .= ' </div>';

                $hasil_kegiatan = '';
                if ($row->hasil_kegiatan) {
                    $hasil_kegiatan = number_format($row->hasil_kegiatan);
                }

                $content .= '
                <tr>
                    <td>' . $offset . '</td>
                    <td>' . tanggal_hari($row->tanggal) . '</td>
                    <td>' . $row->rencana_hasil_kerja . '</td>
                    <td>' . $row->renaksi . '</td>
                    <td>' . $hasil_kegiatan . '</td>
                    <td>' . status_lkh($row->status_verifikasi) . '</td>
                    <td>' . $btn_action . '</td>
                </tr>
                ';
            }

            if (!$result) {
                $content = '<tr><td colspan="7" align="center">-Belum ada data-</td></tr>';
            }

            unset($param['limit']);
            unset($param['offset']);


            $total_rows = $this->Lkh_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config, $this->Config->pagination_config());

            // Initialize
            $this->pagination->initialize($config);

            $link = $this->pagination->create_links();
            $link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm secondary' >", $link);
            $link = str_replace("</strong>", "</button>", $link);

            // Initialize $data Array
            $data['pagination'] = $link;
            $data['result'] = $result;
            $data['row'] = $offset;
            $data['csrf_hash'] = $this->security->get_csrf_hash();
            $data['param'] = $param;
            $data['content'] = $content;
            echo json_encode($data);


        }
    }



    public function submit()
    {
        if ($this->input->is_ajax_request()) {
            if ($_POST) {
                $data['status'] = true;
                $data['errors'] = array();
                $html_escape = html_escape($_POST);
                $post_data = array();
                foreach ($html_escape as $key => $value) {
                    $post_data[$key] = $this->security->xss_clean($value);
                }

                $this->load->library('form_validation');

                $this->form_validation->set_data($post_data);


                $validation_rules = [
                    [
                        'field' => 'tanggal',
                        'label' => 'Tanggal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'rencana_hasil',
                        'label' => 'Rencana Hasil',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],


                    [
                        'field' => 'id_renaksi_detail',
                        'label' => 'Rencana Aksi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'rincian_kegiatan',
                        'label' => 'Laporan Hasil Kegiatan',
                        'rules' => 'required|min_length[255]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'min_length' => '%s minimal harus 255 Karakter',
                        ]
                    ],


                    [
                        'field' => 'hasil_kegiatan',
                        'label' => 'Realisasi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    [
                        'field' => 'id_verifikator',
                        'label' => 'Verifikator',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                ];



                $this->form_validation->set_rules($validation_rules);

                $max_days = 6;

                $errors = array();
                $today = date("Y-m-d");
                $cut_off = date("Y-m-d", strtotime($today . " -" . $max_days . " days"));
                //$bypass = true;// (date("Y")==2023 && date("n")==1) ? true : false;
                // $bypass = ($tanggal >= "2023-03-01") ? true : false;
                $bypass = true;

                $id_skpd = $this->session->userdata('id_skpd');
                $id_pegawai = $this->session->userdata('id_pegawai');

                $id_renaksi_detail = $this->input->post("id_renaksi_detail");
                $tanggal = $this->input->post("tanggal");
                $hasil_kegiatan = $this->input->post("hasil_kegiatan");

                $id_laporan_kerja_harian = $this->input->post("id_laporan_kerja_harian");

                if ($tanggal && (!$bypass && $tanggal <= $cut_off)) {
                    $errors['tanggal'] = 'Pengisian LKH hanya bisa dilakukan maksimal ' . $max_days . ' hari kebelakang';
                }

                if ($this->input->post("action") == "add") {

                    if ($id_renaksi_detail && $hasil_kegiatan) {
                        $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                        $total = $total_realisasi + (int) $hasil_kegiatan;
                        if ($total > 100) {
                            $errors['hasil_kegiatan'] = 'Akumuliasi pencapaian/realisasi melebihi 100%';
                        }
                    }

                } else if ($this->input->post("action") == "edit") {
                    if ($id_renaksi_detail) {
                        if ($this->input->post("id_lkh")) {
                            $param_lkh['where']['lkh.id_lkh'] = $this->input->post("id_lkh");
                            $lkh = $this->Lkh_model->get($param_lkh)->row();
                            if ($lkh) {
                                $total_realisasi = $this->Lkh_model->getTotalRealisasi($id_renaksi_detail);
                                $total = $total_realisasi - (int) $lkh->hasil_kegiatan + (int) $hasil_kegiatan;
                                if ($total > 100) {
                                    $errors['hasil_kegiatan'] = 'Akumuliasi pencapaian/realisasi melebihi 100%';
                                }
                            }
                        }
                    }
                }




                if ($this->form_validation->run() && !$errors) {
                    $rincian_kegiatan = $post_data['rincian_kegiatan'];
                    $hasil_kegiatan = $post_data['hasil_kegiatan'];
                    $id_verifikator = $post_data['id_verifikator'];

                    if ($this->input->post("action") == "add") {

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
                                $lampiran = $this->upload->data('file_name');
                            } else {
                                $data['message'] = $this->upload->display_errors();
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

                                // Kinerja > LKH

                                if ($id_renaksi_detail) {
                                    $dt_lkh = array(
                                        'id_renaksi_detail' => $id_renaksi_detail,
                                        'id_laporan_kerja_harian' => $insert
                                    );
                                    $this->db->insert("ekinerja_lkh", $dt_lkh);

                                    $this->Lkh_model->updateCapaian($id_renaksi_detail);
                                }

                                $data['message'] = "Laporan Kinerja Harian berhasil ditambahkan";
                                $data['status'] = true;

                            } else {
                                $data['message'] = 'Terjadi kesalahan';
                            }
                        }
                    } else if ($this->input->post("action") == "edit" && $id_laporan_kerja_harian) {

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
                                $lampiran = $this->upload->data('file_name');
                            } else {
                                $data['message'] = $this->upload->display_errors();
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

                                // Kinerja > LKH
                                $id_renaksi_detail = $this->input->post("id_renaksi_detail");
                                if ($id_renaksi_detail) {

                                    $dt_lkh = array(
                                        'id_renaksi_detail' => $id_renaksi_detail
                                    );
                                    $this->db
                                        ->where("id_laporan_kerja_harian", $id_laporan_kerja_harian)
                                        ->update("ekinerja_lkh", $dt_lkh);

                                    $this->Lkh_model->updateCapaian($id_renaksi_detail);
                                }

                                $data['message'] = "Laporan Kinerja Harian berhasil diupdate";
                                $data['status'] = true;
                            } else {
                                $data['message'] = 'Terjadi kesalahan';
                            }
                        }
                    }

                } else {
                    $err = $this->form_validation->error_array();
                    $errors = array_merge($errors, $err);
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }
        }
    }

    public function delete()
    {
        if ($this->input->is_ajax_request()) {
            $id_laporan_kerja_harian = $this->input->post("id");
            if ($id_laporan_kerja_harian) {
                $data['status'] = true;


                $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);

                $detail = (array) $detail;
                $id_pegawai = $detail['id_pegawai'];
                $bulan = date("m", strtotime($detail['tanggal']));
                $tahun = date("Y", strtotime($detail['tanggal']));

                $this->laporan_kinerja_harian_model->delete($id_laporan_kerja_harian);

                $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);

                $data['message'] = "LKH berhasil dihapus";

                echo json_encode($data);
            }
        }
    }
}