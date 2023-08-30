<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Api_skpd extends REST_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model("user_model");

	}

	public function get_skpd_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if($api_key!=null && $cekApi){
			$this->db->where("id_skpd != '".$cekApi->id_skpd."' ");
			$this->db->order_by("ref_skpd.nama_skpd",'ASC');

			$data = $this->db->get("ref_skpd")->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credential',
    		];
		}
		
		$this->response($response);
	}

}