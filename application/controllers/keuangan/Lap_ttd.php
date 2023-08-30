<?php

include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
//include_once(APPPATH."core/Front_end.php");

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_ttd extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');


		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('ref_skpd_model');
		$this->load->model('lap_operasional_model');
		$this->load->model('lap_realisasi_anggaran_model');
		$this->load->model('lap_neraca_model');
		$this->load->model('logs_model');
		$this->load->library('encryption');
		$this->load->helper('encryption_helper');

		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$array_privileges = explode(';', $this->user_privileges);


		// if (($this->user_level != "Administrator" && $this->user_level != "Admin Web") && !in_array('keuangan', $array_privileges)) redirect('welcome');
	}


	public function index()
	{
		if ($this->user_id) {

			$data['title']		= "Keuangan - " . app_name;
			$data['content']	= "keuangan/lap_ttd/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$hal = 3;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page > 1) ? ($page * $hal) - $hal : 0;
			$total1 = count($this->lap_operasional_model->get_all_ttd());
			$total2 = count($this->lap_realisasi_anggaran_model->get_all_ttd());
			$total3 = count($this->lap_neraca_model->get_all_ttd());
			// echo $total3;
			// echo $this->db->last_query();
			$total = ($total1 > $total2) ? $total1 : $total2;
			$total = ($total > $total3) ? $total : $total3;
			$data['pages'] = ceil($total / $hal);
			$data['current'] = $page;
			if (!empty($_POST)) {
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			} else {
				$filter = '';
				$data['filter'] = false;
			}
			$data['list1'] = $this->lap_operasional_model->get_page_ttd($mulai, $hal, $filter);
			$data['list2'] = $this->lap_realisasi_anggaran_model->get_page_ttd($mulai, $hal, $filter);
			$data['list3'] = $this->lap_neraca_model->get_page_ttd($mulai, $hal, $filter);


			$data['active_menu'] = "lap_ttd";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

}
