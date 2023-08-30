<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Api_standar_kepatuhan extends REST_Controller {

	public function __construct(){
		parent ::__construct();
		$this->load->model("user_model");
		$this->load->model('standar_kepatuhan_2_model', 'skm');
	}

	public function detail_post()
	{
		$Input = $_POST;
		$data['column'] = $this->skm->get_column_name();
		$data['detail'] = $this->skm->get_standar_kepatuhan_by_id_skpd($Input['id']);
		$data['indikator'] = $this->skm->get_indikator();
		$data['isi'] = [];
		foreach ($data['indikator'] as $value) {
			foreach ($value['indikator'] as $key => $v) {
				$data['isi'][] = $this->skm->get_standar_kepatuhan_isi($data['detail']['id_standar_kepatuhan'],$v['id_standar_kepatuhan_indikator']);
			}
		}
		$this->response($data);
	}

}