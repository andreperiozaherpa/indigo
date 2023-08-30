<?php
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('user_model');
        // $this->load->model('kegawatdaruratan_model');
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['Sijagur-Key'])) ? $headers['Sijagur-Key'] : null;
        $this->api_key = (!empty($headers['sijagur-key'])) ? $headers['sijagur-key'] : $headers['Sijagur-Key'];
    }

    public function login_post()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            $response['status'] = false;
            if ($check) {
                $username = isset($_POST['username']) ? $_POST['username'] : null;
                $password = isset($_POST['password']) ? $_POST['password'] : null;
                $app_token = isset($_POST['app_token']) ? $_POST['app_token'] : null;
                if (!empty($username) && !empty($password)) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('username', 'Username', 'trim|required');
                    $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required');
                    $this->form_validation->set_message('required', '{field} harus diisi');
                    if ($this->form_validation->run() == FALSE) {
                        $response['message'] = validation_errors();
                    } else {
                        $username = trim($_POST['username']);
                        $password = md5(trim($_POST['password']));
                        $validate = $this->user_model->validateAccount($username, $password);
                        if ($validate) {
                            // if ($validate->app_token) {
                            //     $update = array("api_key" => md5(uniqid()), 'app_token' => $app_token);
                            //     $where = array('user_id' => $validate->user_id);
                            //     $this->db->update("user", $update, $where);
                            // }
                            $user = $this->user_model->get_by_id_param($validate->user_id);
                            // if ($user->kepala_skpd == 'Y' || $user->id_pegawai == 10472) {
                                unset($user->password);
                                $response['status'] = true;
                                $response['message'] = "Berhasil login ke aplikasi";
                                $response['data'] = $user;
                            // } else {
                            //     $response['message'] = 'Anda tidak memiliki Akses';
                            // }
                        } else {
                            $response['message'] = 'Username atau Password salah';
                        }
                    }
                } else {
                    $response['message'] = 'Parameter is required';
                }
            } else {
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['message'] = $this->input->request_headers();
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
    public function logout_post()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            $response['status'] = false;
            if ($check) {

                $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

                if (!empty($user_id)) {
                    $update = array("api_key" => NULL, 'app_token' => NULL);
                    $where = array('user_id' => $user_id);
                    $this->db->update("user", $update, $where);
                    $response['status'] = true;
                    $response['message'] = "Berhasil logout";
                } else {
                    $response['message'] = 'Parameter is required';
                }
            } else {
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['message'] = 'No API key provided';
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function update_user_post()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            $response['status'] = false;
            if ($check) {

                $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
                $state = isset($_POST['state']) ? $_POST['state'] : null;

                if (!empty($user_id) && !empty($state)) {
                    $user = $this->user_model->get_by_id($user_id);
                    if ($state == 'token') {
                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('api_key', 'Api Key', 'trim|required');
                        $this->form_validation->set_rules('app_token', 'App Token', 'trim|required');
                        if ($this->form_validation->run() == FALSE) {
                            $response['message'] = validation_errors();
                        } else {

                            $api_key = isset($_POST['api_key']) ? $_POST['api_key'] : null;
                            $app_token = isset($_POST['app_token']) ? $_POST['app_token'] : null;

                            $update = array("api_key" => $api_key, 'app_token' => $app_token);
                            $where = array('user_id' => $user_id);
                            $this->db->update("user", $update, $where);

                            $user = $this->db->get_where('user', ['user_id' => $user_id])->row();

                            $response['status'] = true;
                            $response['message'] = "Berhasil login ke aplikasi";
                            $response['data'] = $user;
                        }
                    }else if($state == 'password'){
                        $user = $this->user_model->get_by_id($user_id);
                        $password = isset($_POST['password']) ? trim($_POST['password']) : null;
                        $c_password = isset($_POST['c_password']) ? trim($_POST['c_password']) : null;
                        $password_sekarang = $user->password;
                        $password_lama = isset($_POST['password_lama']) ? trim($_POST['password_lama']) : null;
                        if (md5($password_lama) !== $password_sekarang) {
                            $response['message'] = 'Password lama salah';
                        }elseif ($password !== $c_password) {
                            $response['message'] = 'Konfirmasi password tidak sama';
                        } else {
                            $update_password = md5($password);
                            $update = $this->db->update('user',['password'=>$update_password],['user_id'=>$user_id]);
                            if ($update) {
                                $response['message'] = 'Password berhasil diupdate';
                                $response['status'] = true;
                            } else {
                                $response['message'] = 'Uh oh, terjadi kesalahan';
                            }
                        }
                    }
                } else {
                    $response['message'] = 'Parameter is required';
                }
            } else {
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['message'] = 'No API key provided';
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function statistik_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            $response['status'] = false;
            if ($check) {
                $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
                if (!empty($user_id)) {
                    $user = $this->user_model->get_by_id($user_id);
                    $this->load->model('kegiatan_dewan_model');
                    $this->load->model('rapat_model');
                    $kegiatan = $this->kegiatan_dewan_model->get_by_pegawai($user->id_pegawai);
                    $rapat = $this->rapat_model->get_by_pegawai($user->id_pegawai);
                    $surat_masuk = $this->db->get_where('surat_masuk',['id_pegawai_penerima'=>$user->id_pegawai])->num_rows();
                    $disposisi = $this->db->get_where('disposisi_surat_masuk',['id_pegawai'=>$user->id_pegawai])->num_rows();

                    $res = ['kegiatan'=>count($kegiatan),'rapat'=>count($rapat),'surat_masuk'=>$surat_masuk,'disposisi'=>$disposisi];
                    $response['status'] = true;
                    $response['data'] = $res;

                } else {
                    $response['message'] = 'Parameter is required';
                }
            } else {
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['message'] = 'No API key provided';
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }


    public function update_lokasi_post()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            $response['status'] = false;
            if ($check) {

                $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
                $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
                $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;

                if (!empty($user_id) && !empty($latitude) && !empty($longitude)) {
                    $user = $this->user_model->get_by_id_param($user_id);
                    if($user){
                        $id_pegawai = $user->id_pegawai;
                        $data_in = ['id_pegawai'=>$id_pegawai,'latitude'=>$latitude,'longitude'=>$longitude,'last_update'=>date('Y-m-d H:i:s')];
                        $cek = $this->db->get_where('sijagur_lokasi',['id_pegawai'=>$id_pegawai])->row();
                        if($cek){
                            $this->db->update('sijagur_lokasi',$data_in,['id_pegawai'=>$id_pegawai]);
                        }else{
                            $this->db->insert('sijagur_lokasi',$data_in);
                        }

                        $response['status'] = true;
                        $response['message'] = 'Data berhasil diperbaharui';
                    }else{
                        $response['message'] = 'User not found';
                    }
                } else {
                    $response['message'] = 'Parameter is required';
                }
            } else {
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['message'] = 'No API key provided';
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function check_api_key($params = '')
    {
        if ($params) {
            if ($params == 'password') {
                return true;
            }else{
                return false;
            }
        }else{
            return 'No Params';
        }
    }

}