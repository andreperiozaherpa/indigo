<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Pegawai extends REST_Controller
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

            $rowno = ($this->input->post("page")) ? $this->input->post("page") : 1;

            $this->load->model("Pegawai_model");
            $param = array();

            $rowperpage = ($this->input->post("limit")) ? $this->input->post("limit") : 10;
		    $offset = ($rowno-1) * $rowperpage;

			$param = array();
			$param['limit']		= $rowperpage;
			$param['offset']	= $offset;

            //$param['where']['pegawai.nip'] = '197903102008011005';
            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }
            if($this->input->post("id_skpd"))
            {
                $param['where']['skpd.id_skpd'] = $this->input->post("id_skpd");
            }
            if($this->input->post("ptoken"))
            {
                $param['where']['md5(pegawai.id_pegawai)'] = $this->input->post("ptoken");
            }
            

            if($this->input->post("jenis_jabatan"))
            {
                $param['where']['jabatan.jenis_jabatan'] = $this->input->post("jenis_jabatan");
            }

            $this->db->order_by("skpd.id_skpd","ASC");

            $data = $this->Pegawai_model->get_pegawai($param);

            unset($param['limit']);
			unset($param['offset']);
			
			$total_rows	= $this->Pegawai_model->get_pegawai($param)->num_rows();

            $response = [
                'error'    => false,
                'data' => $data->result(),
                'total_rows'    => $total_rows
            ];   
        }
        else{
            $response = [
                'error'    => true,
                'message' => 'Invalid credential ',
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