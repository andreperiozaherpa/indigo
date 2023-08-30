<?php
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Surat extends REST_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('user_model');
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['SKey'])) ? $headers['SKey'] : null;
        $this->username = $this->input->server('PHP_AUTH_USER');
        $this->password = $this->input->server('PHP_AUTH_PW');
        $this->passwordSalt = 'mKashj89@1';
        $this->load->library('splpjabar', ['clientId' => '5djCAeA9fCW6TrLQqDbTtyhZufMa', 'clientSecret' => 'weM6Tf_mIEHucn0ILgIVCcDYmEAa']);



    }

    public function klasifikasi_get()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $response_code = REST_Controller::HTTP_OK;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = isset($_GET['name']) ? $_GET['name'] : null;

                if (!empty($id)) {
                    $this->db->where('kode_gabungan', $id);
                }
                if (!empty($name)) {
                    $this->db->like('nama_klasifikasi', $name);
                }
                $this->db->select('kode_gabungan as id, nama_klasifikasi as name');
                $ref_skpd = $this->db->get('surat_klasifikasi')->result();
                $response = $ref_skpd;
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }
    public function tujuan_get()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $response_code = REST_Controller::HTTP_OK;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = isset($_GET['name']) ? $_GET['name'] : null;

                $this->db->group_start();
                $this->db->or_where('jenis_skpd !=', 'demo');
                $this->db->or_where('jenis_skpd !=', 'kota');
                $this->db->group_end();
                if (!empty($id)) {
                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_skpd))', $id);
                }
                if (!empty($name)) {
                    $this->db->like('nama_skpd', $name);
                }
                $this->db->select('md5(concat(\'' . $this->passwordSalt . '\',id_skpd)) as id, nama_skpd as name');
                $ref_skpd = $this->db->get('ref_skpd')->result();
                $response = $ref_skpd;
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }

    public function jenis_get()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $response_code = REST_Controller::HTTP_OK;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = isset($_GET['name']) ? $_GET['name'] : null;

                if (!empty($id)) {
                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat))', $id);
                }
                if (!empty($name)) {
                    $this->db->like('nama_surat', $name);
                }
                $this->db->select('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat)) as id, nama_surat as name');
                $ref_skpd = $this->db->get('ref_surat')->result();
                $response = $ref_skpd;
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }
    public function sifat_get()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $response_code = REST_Controller::HTTP_OK;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = isset($_GET['name']) ? $_GET['name'] : null;

                if (!empty($id)) {
                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_sifat))', $id);
                }
                if (!empty($name)) {
                    $this->db->like('nama_sifat', $name);
                }
                $this->db->select('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_sifat)) as id, nama_sifat as name');
                $ref_skpd = $this->db->get('ref_surat_sifat')->result();
                $response = $ref_skpd;
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }

    public function jenis_lampiran_get()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $response_code = REST_Controller::HTTP_OK;
                $id = isset($_GET['id']) ? $_GET['id'] : null;
                $name = isset($_GET['name']) ? $_GET['name'] : null;

                if (!empty($id)) {
                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_jenis_lampiran))', $id);
                }
                if (!empty($name)) {
                    $this->db->like('nama_jenis_lampiran', $name);
                }
                $this->db->select('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_jenis_lampiran)) as id, nama_jenis_lampiran as name');
                $ref_skpd = $this->db->get('ref_surat_jenis_lampiran')->result();
                $response = $ref_skpd;
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }

    public function kirim_post()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                $unit_pencipta = isset($_POST['unit_pencipta']) ? $_POST['unit_pencipta'] : null;
                $tid = isset($_POST['tid']) ? $_POST['tid'] : null;
                $nomor_naskah = isset($_POST['nomor_naskah']) ? $_POST['nomor_naskah'] : null;
                $kode_klasifikasi = isset($_POST['kode_klasifikasi']) ? $_POST['kode_klasifikasi'] : null;
                $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
                $tujuan = isset($_POST['tujuan']) ? $_POST['tujuan'] : null;
                $hal = isset($_POST['hal']) ? $_POST['hal'] : null;
                $jenis_naskah = isset($_POST['jenis_naskah']) ? $_POST['jenis_naskah'] : null;
                $isi = isset($_POST['isi']) ? $_POST['isi'] : null;
                $sifat_naskah = isset($_POST['sifat_naskah']) ? $_POST['sifat_naskah'] : null;
                $jenis_lampiran = isset($_POST['jenis_lampiran']) ? $_POST['jenis_lampiran'] : null;
                $jumlah_lampiran = isset($_POST['jumlah_lampiran']) ? $_POST['jumlah_lampiran'] : null;
                $tembusan = isset($_POST['tembusan']) ? $_POST['tembusan'] : null;
                $penandatangan = isset($_POST['penandatangan']) ? $_POST['penandatangan'] : null;
                $tempat_penandatangan = isset($_POST['tempat_penandatangan']) ? $_POST['tempat_penandatangan'] : null;
                $tanggal_persetujuan = isset($_POST['tanggal_persetujuan']) ? $_POST['tanggal_persetujuan'] : null;
                $nip_pejabat = isset($_POST['nip_pejabat']) ? $_POST['nip_pejabat'] : null;
                $nama_pejabat = isset($_POST['nama_pejabat']) ? $_POST['nama_pejabat'] : null;
                $jabatan = isset($_POST['jabatan']) ? $_POST['jabatan'] : null;
                // $file = isset($_FILES['file']['name']) ? $_POST['file']['name'] : null;
                $kode_wilayah = isset($_POST['kode_wilayah']) ? $_POST['kode_wilayah'] : null;
                //if some field is empty


                $get_eo = $this->db->get_where('surat_penerima_jabar', ['kode_wilayah' => $kode_wilayah])->row();

                if (!$get_eo) {
                    $response['message'] = 'Kode Wilayah tidak ditemukan';
                    $response_code = REST_Controller::HTTP_BAD_REQUEST;
                } else {
                    $getTujuan = $this->splpjabar->getTujuan($get_eo->path_endpoint);
                    if (!$getTujuan) {
                        $response['message'] = 'Gagal mengambil data Tujuan dari Ekosistem ' . $get_eo->nama_instansi;
                        $response_code = REST_Controller::HTTP_BAD_REQUEST;
                        $this->set_response($response, $response_code);
                        return;
                    }

                    $unitPencipta = array_values(array_filter($getTujuan, function ($tujuan) use ($unit_pencipta) {
                        return $tujuan->id == $unit_pencipta;
                    }));


                    if (!empty($unitPencipta)) {
                        $nama_pencipta = $unitPencipta[0]->name . ' - ' . $get_eo->nama_instansi;
                    } else {
                        $response['message'] = 'Unit Pencipta tidak ditemukan';
                        $response_code = REST_Controller::HTTP_BAD_REQUEST;
                        $this->set_response($response, $response_code);
                        return;
                    }


                    // $getKlasifikasi = $this->splpjabar->getKlasifikasi($get_eo->path_endpoint);
                    // if (!$getKlasifikasi) {
                    //     $response['message'] = 'Gagal mengambil data Klasifikasi dari Ekosistem ' . $get_eo->nama_instansi;
                    //     $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    //     $this->set_response($response, $response_code);
                    //     return;
                    // }

                    // $getJenisNaskah = $this->splpjabar->getJenisNaskah($get_eo->path_endpoint);
                    // if (!$getJenisNaskah) {
                    //     $response['message'] = 'Gagal mengambil data Jenis Naskah dari Ekosistem ' . $get_eo->nama_instansi;
                    //     $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    //     $this->set_response($response, $response_code);
                    //     return;
                    // }

                    // $getJenisLampiran = $this->splpjabar->getJenisLampiran($get_eo->path_endpoint);
                    // if (!$getJenisLampiran) {
                    //     $response['message'] = 'Gagal mengambil data Jenis Lampiran dari Ekosistem ' . $get_eo->nama_instansi;
                    //     $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    //     $this->set_response($response, $response_code);
                    //     return;
                    // }

                    // $getSifatNaskah = $this->splpjabar->getSifatNaskah($get_eo->path_endpoint);
                    // if (!$getSifatNaskah) {
                    //     $response['message'] = 'Gagal mengambil data Sifat Naskah dari Ekosistem ' . $get_eo->nama_instansi;
                    //     $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    //     $this->set_response($response, $response_code);
                    //     return;
                    // }
                    if (empty($unit_pencipta) || empty($tid) || empty($nomor_naskah) || empty($kode_klasifikasi) || empty($tanggal) || empty($tujuan) || empty($hal) || empty($jenis_naskah) || empty($isi) || empty($sifat_naskah) || empty($jenis_lampiran) || empty($penandatangan) || empty($tempat_penandatangan) || empty($tanggal_persetujuan) || empty($nip_pejabat) || empty($nama_pejabat) || empty($jabatan) || empty($kode_wilayah)) {
                        $response['message'] = 'Parameter required';
                        $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    } else {
                        $check_klasifikasi = $this->db->get_where('surat_klasifikasi', array('kode_gabungan' => $kode_klasifikasi))->row();
                        if (empty($check_klasifikasi)) {
                            $response['message'] = 'Kode Klasifikasi tidak ditemukan';
                            $response_code = REST_Controller::HTTP_BAD_REQUEST;
                        } else {

                            //if tujuan is json

                            if (is_json($tujuan)) {
                                $tujuan = json_decode($tujuan);
                            }


                            $tujuan_status = true;
                            $tujuan_message = "";
                            if (is_array($tujuan) && count($tujuan) > 0) {
                                foreach ($tujuan as $t) {
                                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_skpd))', $t);
                                    $check_tujuan = $this->db->get('ref_skpd')->row();
                                    if (!$check_tujuan) {
                                        $tujuan_status = false;
                                        $tujuan_message = 'Tujuan tidak ditemukan : ' . $t;
                                        break;
                                    }
                                }
                            } else {
                                $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_skpd))', "$tujuan");
                                $check_tujuan = $this->db->get('ref_skpd')->row();
                                if (!$check_tujuan) {
                                    $tujuan_status = false;
                                    $tujuan_message = 'Tujuan tidak ditemukan';
                                }
                            }
                            if (!$tujuan_status) {
                                $response['message'] = $tujuan_message;
                                $response_code = REST_Controller::HTTP_BAD_REQUEST;
                            } else {
                                // if (is_json($tembusan)) {
                                //     $tembusan = json_decode($tembusan);
                                // }
                                // $tembusan_status = true;
                                // $tembusan_message = "";
                                // if (is_array($tembusan) && count($tembusan) > 0) {
                                //     foreach ($tembusan as $t) {
                                //         $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_skpd))', $t);
                                //         $check_tembusan = $this->db->get('ref_skpd')->row();
                                //         if (!$check_tembusan) {
                                //             $tembusan_status = false;
                                //             $tembusan_message = 'Tembusan tidak ditemukan : ' . $t;
                                //             break;
                                //         }
                                //     }
                                // } else {
                                //     $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_skpd))', "$tembusan");
                                //     $check_tembusan = $this->db->get('ref_skpd')->row();
                                //     if (!$check_tembusan) {
                                //         $tembusan_status = false;
                                //         $tembusan_message = 'Tembusan tidak ditemukan';
                                //     }
                                // }
                                // if (!$tembusan_status) {
                                //     $response['message'] = $tembusan_message;
                                //     $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                // } else {
                                    $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat))', $jenis_naskah);
                                    $check_jenis_naskah = $this->db->get('ref_surat')->row();
                                    if (empty($check_jenis_naskah)) {
                                        $response['message'] = 'Jenis Naskah tidak ditemukan';
                                        $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                    } else {
                                        $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_sifat))', $sifat_naskah);
                                        $check_sifat_naskah = $this->db->get('ref_surat_sifat')->row();
                                        if (empty($check_sifat_naskah)) {
                                            $response['message'] = 'Sifat Naskah tidak ditemukan';
                                            $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                        } else {
                                            $this->db->where('md5(concat(\'' . $this->passwordSalt . '\',id_ref_surat_jenis_lampiran))', $jenis_lampiran);
                                            $check_jenis_lampiran = $this->db->get('ref_surat_jenis_lampiran')->row();
                                            if (empty($check_jenis_lampiran)) {
                                                $response['message'] = 'Jenis Lampiran tidak ditemukan';
                                                $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                            } else {
                                                //upload file with name file to /data/surat_eksternal/surat_masuk/ only allow pdf
                                                $config['upload_path'] = './data/surat_eksternal/surat_masuk/';
                                                $config['allowed_types'] = 'pdf';
                                                $config['max_size'] = 10000;
                                                $config['file_name'] = $tid;
                                                $config['overwrite'] = false;
                                                $this->load->library('upload', $config);
                                                if (!$this->upload->do_upload('file')) {
                                                    $response['message'] = $this->upload->display_errors();
                                                    //non html
                                                    $response['message'] = str_replace('<p>', '', $response['message']);
                                                    $response['message'] = str_replace('</p>', '\n', $response['message']);
                                                    $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                                } else {
                                                    $upload_data = $this->upload->data();
                                                    $file_name = $upload_data['file_name'];
                                                    $kepala_skpd = $this->db->get_where('pegawai', ['id_skpd' => $check_tujuan->id_skpd, 'kepala_skpd' => 'Y'])->result();
                                                    foreach ($kepala_skpd as $k) {
                                                        $data = array(
                                                            'jenis_surat' => 'eksternal',
                                                            'perihal' => $hal,
                                                            'pengirim' => $nama_pencipta,
                                                            'tanggal_surat' => $tanggal,
                                                            'nomer_surat' => $nomor_naskah,
                                                            'sifat' => $check_sifat_naskah->kode,
                                                            'file_surat' => $file_name,
                                                            'lampiran' => $jumlah_lampiran,
                                                            'id_pegawai_input' => 0,
                                                            'isi_ringkasan' => $isi,
                                                            'tgl_input' => date('Y-m-d'),
                                                            'status_surat' => 'Belum Dibaca',
                                                            'id_skpd_penerima' => $check_tujuan->id_skpd,
                                                            'id_unitkerja_penerima' => 0,
                                                            'id_pegawai_penerima' => $k->id_pegawai,
                                                            'hash_id' => $tid,
                                                            'surat_jabar' => 1,
                                                            'kode_klasifikasi' => $kode_klasifikasi,
                                                            'jenis_lampiran' => $check_jenis_lampiran->id_ref_surat_jenis_lampiran,
                                                            'ext_data' => json_encode($_POST)
                                                        );
                                                        // print_r($data);
                                                        // die;
                                                        $insert = $this->db->insert('surat_masuk', $data);

                                                        if ($insert) {
                                                            $id_surat_masuk = $this->db->insert_id();
                                                            $notif_data = array();
                                                            $notif_data['title'] = 'Surat Masuk';
                                                            $notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $data['perihal'];
                                                            $notif_data['data'] = 'surat_' . $data['jenis_surat'] . '/detail_surat_masuk';
                                                            $notif_data['data_id'] = $id_surat_masuk;
                                                            $notif_data['ntime'] = date('H:i:s');
                                                            $notif_data['ndate'] = date('Y-m-d');
                                                            $notif_data['user_id'] = $k->id_user;
                                                            $notif_data['category'] = 'surat_' . $data['jenis_surat'] . '/surat_masuk';
                                                            $this->notification_model->insert($notif_data);
                                                            $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
                                                            $this->emit('new_notification', $notif_data);
                                                            $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
                                                            $response['success'] = true;
                                                        } else {
                                                            $response['message'] = 'Terjadi kesalahan saat menyimpan data';
                                                            $response_code = REST_Controller::HTTP_BAD_REQUEST;
                                                        }

                                                    }
                                                }

                                            }
                                        }
                                    }
                                // }
                            }
                        }
                    }

                }

            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }

    public function cek_status_post()
    {
        $response['success'] = false;
        $response_code = REST_Controller::HTTP_BAD_REQUEST;
        if ($this->username != '' && $this->password != '') {
            $check = $this->check_basic_auth($this->username, $this->password);
            if ($check) {
                //get body raw json
                $body = $this->input->raw_input_stream;
                if (is_json($body)) {
                    $body = json_decode($body);
                    if (isset($body->tids) && count($body->tids) > 0) {
                        $tids = $body->tids;

                        $response = array();

                        foreach ($tids as $k => $v) {
                            $get_surat_masuk = $this->db->get_where('surat_masuk', ['hash_id' => $v])->row();
                            $temp_response = [
                                'tid' => $v,
                                'is_exist' => $get_surat_masuk ? true : false,
                                'data' => $get_surat_masuk ? json_decode($get_surat_masuk->ext_data) : null
                            ];

                            $response[] = $temp_response;
                        }

                    } else {
                        $response['message'] = 'Data Not ';
                        $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    }
                } else {
                    $response['message'] = 'Invalid JSON';
                    $response_code = REST_Controller::HTTP_BAD_REQUEST;
                    $this->set_response($response, $response_code);
                    return;
                }
            } else {
                $response['message'] = 'Invalid Credential';
                $response_code = REST_Controller::HTTP_UNAUTHORIZED;
            }
        } else {
            $response['message'] = 'Authentication is required';
            $response_code = REST_Controller::HTTP_UNAUTHORIZED;
        }
        $this->set_response($response, $response_code);
    }

    function emit($name, $notif_data)
    {

        $client = new Client(new Version2X('https://localhost:3000', ['context' => ['ssl' => ['verify_peer_name' => false, 'verify_peer' => false]]]));
        $client->initialize();
        $client->emit($name, $notif_data);
        $client->close();
    }
    private function check_api_key($params = '')
    {
        if ($params) {
            if ($params == '1919e7f6a95c15a718109517f77411de') {
                return true;
            } else {
                return false;
            }
        } else {
            return 'No Params';
        }
    }


    private function check_basic_auth($username = '', $password = '')
    {
        if (empty($userame)) {
            $username = $this->input->server('PHP_AUTH_USER');
        }
        if (empty($password)) {
            $password = $this->input->server('PHP_AUTH_PW');
        }
        if ($username == 'splpjabar' && $password == 'Aa12@jsP!') {
            return true;
        } else {
            return false;
        }
    }


}