<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Proyeksi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['Secret-Key'])) ? $headers['Secret-Key'] : null;
    }

    public function validate_post()
    {
        
        if($this->is_valid($this->api_key))
        {
            $id_pegawai = $this->input->post("id_pegawai");
            $id_jabatan = $this->input->post("id_jabatan");

            if($id_jabatan && $id_pegawai){

                $validate = true;
                $message = '';

                if($validate)
                {
                    $this->load->model("Pegawai_model");
                    $this->load->model("Ref_jabatan_model");

                    $param_pegawai = array();
                    $param_pegawai['where']['pegawai.id_pegawai'] = $id_pegawai;
                    $pegawai = $this->Pegawai_model->get_pegawai($param_pegawai)->row();


                    $param_jabatan_baru = array();
                    $param_jabatan_baru['where']['jabatan.id_jabatan'] = $id_jabatan;
                    $jabatan_baru = $this->Ref_jabatan_model->get($param_jabatan_baru)->row();

                    $master_pegawai = $this->db->where("nip_baru",$pegawai->nip)->get("master_pegawai")->row();

                    $pegawai->tempat_lahir = $master_pegawai->tempat_lahir;
                    $pegawai->tgl_lahir = $master_pegawai->tgl_lahir;

                    $response = [
                        'error'         => false,
                        'pegawai'       => $pegawai,
                        'jabatan_baru'  => $jabatan_baru,
                    ];
                }
                else{
                    $response = [
                        'error'    => true,
                        'message'   => $message,
                    ];
                }
                   
            }
            else{
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
            

            
        }
        else{
            $response = [
                'error'    => true,
                'message' => 'Invalid credential',
            ];
        }
        //echo "<pre>";print_r($this->input->request_headers());die;
        $this->response($response);
    }

    public function release_post()
    {
        
        if($this->is_valid($this->api_key))
        {
            $id_pegawai = $this->input->post("id_pegawai");
            $id_jabatan_baru = $this->input->post("id_jabatan_baru");
            $nama_jabatan_baru = $this->input->post("nama_jabatan_baru");
            $id_skpd_baru = $this->input->post("id_skpd_baru");
            $id_unit_kerja_baru = $this->input->post("id_unit_kerja_baru");

            if($id_jabatan_baru && $id_pegawai && $nama_jabatan_baru && $id_skpd_baru && $id_unit_kerja_baru){

                $this->db
                ->set("id_jabatan",$id_jabatan_baru)
                ->set("jabatan",$nama_jabatan_baru)
                ->set("id_skpd",$id_skpd_baru)
                ->set("id_unit_kerja",$id_unit_kerja_baru)
                ->where("id_pegawai",$id_pegawai)->update("pegawai");

                $this->db
                ->set("id_pegawai",$id_pegawai)
                ->where("id_jabatan",$id_jabatan_baru)
                ->update("ref_jabatan_baru");

                $response = [
                    'error'    => false,
                ];
                   
            }
            else{
                $response = [
                    'error'    => true,
                    'message' => 'Invalid data',
                ];
            }
            

            
        }
        else{
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
        $check = $this->db->where("api_key",$api_key)->get("keys")->row();
        
        if($check && $api_key)
        {
            $hit = $check->hit + 1;
            $this->db->set("hit",$hit)->where("api_key",$api_key)->update("keys");
            return true;
        }
        else{
            return false;
        }
    }



}