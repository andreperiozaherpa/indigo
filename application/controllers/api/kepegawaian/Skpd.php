<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Skpd extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['Secret-Key'])) ? $headers['Secret-Key'] : null;
    }

    public function list_post()
    {
        if($this->is_valid($this->api_key))
        {

            $this->load->model("Ref_skpd_model");
            $param = array();

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            $data = $this->Ref_skpd_model->get($param);

            $response = [
                'error'    => false,
                'data' => $data->result(),
                'total_rows'    => $data->num_rows(),
            ];   
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