<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Jabatan extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['Secret-Key'])) ? $headers['Secret-Key'] : null;
    }

    public function update_jabatan_post()
    {
        $status = false;
        $message = '';
        $data = array();

        if (isset($_POST['nip']) && isset($_POST['nama_jabatan']) && isset($_POST['jenis_jabatan']) && isset($_POST['nama_skpd']) && isset($_POST['tpp']) && isset($_POST['grade']) && isset($_POST['jenis_pegawai'])) {
            $nip = $_POST['nip'];
            $check_pegawai = $this->db->get_where('pegawai', ['nip' => $nip])->row();
            if ($check_pegawai) {
                $nama_skpd = $_POST['nama_skpd'];
                $check_skpd = $this->db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd])->row();
                if ($check_skpd) {

                    $list_jenis_jabatan = ['struktural', 'fungsional', 'pelaksana'];
                    $list_jenis_pegawai = ['kepala', 'staff'];

                    $nama_jabatan = $_POST['nama_jabatan'];
                    $jenis_jabatan = strtolower($_POST['jenis_jabatan']);
                    $jenis_pegawai = strtolower($_POST['jenis_pegawai']);
                    if (in_array($jenis_jabatan, $list_jenis_jabatan)) {
                        $jenis_jabatan = ucwords($jenis_jabatan);
                        if (in_array($jenis_pegawai, $list_jenis_pegawai)) {
                            $tpp = $_POST['tpp'];
                            $grade = $_POST['grade'];
                            $id_unit_kerja = 0;
                            if (isset($_POST['nama_unit_kerja'])) {
                                $nama_unit_kerja = $_POST['nama_unit_kerja'];
                                $check_unit_kerja = $this->db->get_where('ref_unit_kerja', ['nama_unit_kerja' => $nama_unit_kerja, 'id_skpd' => $check_skpd->id_skpd])->row();
                                if ($check_unit_kerja) {
                                    $id_unit_kerja = $check_unit_kerja->id_unit_kerja;
                                }
                            }
                            $get_jabatan = $this->db->get_where('ref_jabatan_baru', ['id_skpd' => $check_skpd->id_skpd, 'nama_jabatan' => $nama_jabatan])->row();
                            if ($get_jabatan) {
                                $update = $this->db->update('ref_jabatan_baru', ['id_unit_kerja' => $id_unit_kerja, 'jenis_jabatan' => $jenis_jabatan, 'grade' => $grade, 'tpp' => $tpp], ['id_jabatan' => $get_jabatan->id_jabatan]);
                                $id_jabatan = $get_jabatan->id_jabatan;
                                $id_unit_kerja = $get_jabatan->id_unit_kerja;
                                $nama_jabatan = $get_jabatan->nama_jabatan;
                            } else {
                                $insert = $this->db->insert('ref_jabatan_baru', ['id_skpd' => $check_skpd->id_skpd, 'id_unit_kerja' => $id_unit_kerja, 'jenis_jabatan' => $jenis_jabatan, 'grade' => $grade, 'tpp' => $tpp, 'nama_jabatan' => $nama_jabatan]);
                                $id_jabatan = $this->db->insert_id();
                            }

                            $update_pegawai = $this->db->update('pegawai', ['jenis_pegawai' => $jenis_pegawai, 'id_unit_kerja' => $id_unit_kerja, 'id_jabatan' => $id_jabatan, 'jabatan' => $nama_jabatan], ['id_pegawai' => $check_pegawai->id_pegawai]);
                            if ($update_pegawai) {
                                $status = true;
                                $message = "Jabatan berhasil diperbaharui";
                            } else {
                                $message = "Terjadi kesalahan saat update pegawai";
                            }
                        } else {
                            $message = 'Jenis Pegawai yang diizinkan (' . implode(', ', $list_jenis_pegawai) . ")";
                        }
                    } else {
                        $message = 'Jenis Jabatan yang diizinkan (' . implode(', ', $list_jenis_jabatan) . ")";
                    }
                } else {
                    $message = 'SKPD tidak ditemukan';
                }
            } else {
                $message = 'Pegawai tidak ditemukan';
            }
        } else {
            $message = 'Parameter tidak lengkap';
        }

        $response = ['status' => $status, 'message' => $message, 'data' => $data];
        $this->response($response);
    }

    public function tersedia_post()
    {
        if ($this->is_valid($this->api_key)) {

            $rowno = ($this->input->post("page")) ? $this->input->post("page") : 1;

            $this->load->model("Ref_jabatan_model");
            $rowperpage = ($this->input->post("limit")) ? $this->input->post("limit") : 10;
            $offset = ($rowno - 1) * $rowperpage;

            $param = array();
            $param['limit']        = $rowperpage;
            $param['offset']    = $offset;

            if ($this->input->post("search")) {
                $param['search'] = $this->input->post("search");
            }

            if ($this->input->post("id_skpd")) {
                $param['where']['skpd.id_skpd'] = $this->input->post("id_skpd");
            }

            if ($this->input->post("jtoken")) {
                $param['where']['md5(jabatan.id_jabatan)'] = $this->input->post("jtoken");
            }

            $param_exclude = "";
            if ($this->input->post("exclude")) {
                $param_exclude = " AND jabatan.id_jabatan not in (" . $this->input->post("exclude") . ") ";
            }

            $param['str_where'] = "(jabatan.jenis_jabatan = 'Struktural' AND pegawai.nama_lengkap IS NULL AND jabatan.nama_jabatan != ''  $param_exclude )";

            $this->db->order_by("jabatan.id_skpd");

            $data = $this->Ref_jabatan_model->get($param);

            unset($param['limit']);
            unset($param['offset']);

            $total_rows    = $this->Ref_jabatan_model->get($param)->num_rows();

            $response = [
                'error'    => false,
                'data' => $data->result(),
                'total_rows'    => $total_rows,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function list_post()
    {
        if ($this->is_valid($this->api_key)) {

            if ($this->input->post("id_skpd")) {
                $this->load->model("Ref_jabatan_model");

                $param = array();
                $param['where']['skpd.id_skpd'] = $this->input->post("id_skpd");
                $param['where']['jabatan.jenis_jabatan'] = 'Struktural';

                $struktur = $this->input->post("struktur");
                if ($struktur && $struktur == "Y") {
                    $param['str_where'] = "(jabatan.id_jabatan_induk is not null )";
                }
                if ($struktur && $struktur == "N") {
                    $param['str_where'] = "(jabatan.id_jabatan_induk is null )";
                }


                $this->db->order_by("jabatan.id_skpd");

                $data = $this->Ref_jabatan_model->get($param);

                $response = [
                    'error'    => false,
                    'data' => $data->result(),
                    'total_rows'    => $data->num_rows(),
                ];
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
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function pejabat_ttd_proyeksi_post()
    {
        if ($this->is_valid($this->api_key)) {


            $this->load->model("Ref_jabatan_model");

            $ids = implode(",", [
                5274, // Bupati
                33, // Sekretaris Daerah
                102, // Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia
                464, // Kepala Bidang Kinerja dan Penempatan Dalam Jabatan
                775, // Kepala Sub Bidang Penempatan Dalam Jabatan
            ]);

            $param['str_where'] = "jabatan.id_jabatan in ($ids) and pegawai.id_pegawai != '10518' "; //  10518 : testing

            $this->db->order_by("jabatan.id_skpd");

            $data = $this->Ref_jabatan_model->get($param)->result();

            foreach ($data as $key => $row) {
                $alias = "";
                if ($row->id_jabatan == 5274) {
                    $alias = "bupati";
                } else if ($row->id_jabatan == 33) {
                    $alias = "setda";
                } else if ($row->id_jabatan == 102) {
                    $alias = "kadis";
                } else if ($row->id_jabatan == 464) {
                    $alias = "kabid";
                } else if ($row->id_jabatan == 775) {
                    $alias = "kasubid";
                }
                $data[$key]->alias = $alias;
            }


            $response = [
                'error'    => false,
                'data' => $data,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function skpd_post()
    {
        if ($this->is_valid($this->api_key)) {


            $this->load->model("Ref_jabatan_model");

            $param = array();

            if ($this->input->post("limit")) {
                $rowno = ($this->input->post("page")) ? $this->input->post("page") : 1;
                $rowperpage = ($this->input->post("limit")) ? $this->input->post("limit") : 10;
                $offset = ($rowno - 1) * $rowperpage;

                $param['limit']        = $rowperpage;
                $param['offset']    = $offset;
            }
            $param_exclude = "";
            if ($this->input->post("exclude")) {
                $param_exclude = " AND jabatan.id_jabatan not in (" . $this->input->post("exclude") . ") ";
            }

            $param['str_where'] = "(jabatan.jenis_jabatan = 'Struktural' AND pegawai.nama_lengkap IS NULL AND jabatan.nama_jabatan != ''  $param_exclude )";


            $data = $this->Ref_jabatan_model->get_skpd($param);

            $total_rows    = $this->Ref_jabatan_model->get($param)->num_rows();

            $response = [
                'error'    => false,
                'data' => $data->result(),
                'total_rows'    => $total_rows,
            ];
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function struktur_post()
    {
        if ($this->is_valid($this->api_key)) {

            $id_skpd = $this->input->post("id_skpd");
            if ($id_skpd) {
                $this->load->model("Ref_jabatan_model");

                $data = $this->Ref_jabatan_model->get_struktur($id_skpd);

                $response = [
                    'error'    => false,
                    'data'      => $data,
                ];
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'SKPD dibutuhkan',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function update_post()
    {
        if ($this->is_valid($this->api_key)) {

            $id_jabatan = $this->input->post("id_jabatan");
            if ($id_jabatan) {
                $id_jabatan_induk = ($this->input->post("id_jabatan_induk")) ? $this->input->post("id_jabatan_induk") : 0;
                $tunjangan = ($this->input->post("tunjangan")) ? $this->input->post("tunjangan") : 0;

                $dt = array(
                    'id_jabatan_induk'  => $id_jabatan_induk,
                    'tunjangan'         => $tunjangan,
                );
                $this->load->model("Ref_jabatan_model");
                $this->Ref_jabatan_model->update_ref($dt, $id_jabatan);

                $response = [
                    'error'    => false,
                ];
            } else {
                $response = [
                    'error'    => true,
                    'message' => 'SKPD dibutuhkan',
                ];
            }
        } else {
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    private function is_valid($api_key)
    {
        //return true;
        $check = $this->db->where("api_key", $api_key)->get("keys")->row();

        if ($check && $api_key) {
            $hit = $check->hit + 1;
            $this->db->set("hit", $hit)->where("api_key", $api_key)->update("keys");
            return true;
        } else {
            return false;
        }
    }
}
