<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Api_pegawai extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");

	}

	public function get_pegawai_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$api_key = (!empty($headers['Api-Key'])) ? $headers['Api-Key'] : $api_key;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if ($api_key != null && $cekApi) {
			$this->db->select("pegawai.id_pegawai, pegawai.nama_lengkap, ref_unit_kerja.nama_unit_kerja, user.user_picture");
			if (!empty($this->post("kd_skpd"))) {
				$this->db->where("pegawai.id_skpd", $this->post("kd_skpd"));
			}
			$this->db->join('user', 'pegawai.id_pegawai = user.id_pegawai', 'left');
			$this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
			$this->db->order_by("pegawai.nama_lengkap", 'ASC');
			$data = $this->db->get("pegawai")->result();


			$this->db->where("pegawai.id_pegawai", 77);
			$this->db->select("pegawai.id_pegawai, pegawai.nama_lengkap, ref_unit_kerja.nama_unit_kerja, user.user_picture");
			$this->db->join('user', 'pegawai.id_pegawai = user.id_pegawai', 'left');
			$this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja', 'left');
			$res = $this->db->get("pegawai")->row();

			$data[] = $res;

			$response = array(
				'error' => false,
				'data' => $data,
			);
		} else {
			$response = [
				'error' => true,
				'message' => 'Invalid credential',
			];
		}

		$this->response($response);
	}

}