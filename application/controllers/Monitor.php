<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitor extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->user_level = $this->session->userdata('user_level');
		$this->load->model('visitor_model');
		$this->visitor_model->cek_visitor();
		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();

		$this->bulan = array(
							1 => 'Januari',
							2 => 'Februari',
							3 => 'Maret',
							4 => 'April',
							5 => 'Mei',
							6 => 'Juni',
							7 => 'Juli',
							8 => 'Agustus',
							9 => 'September',
							10 => 'Oktober',
							11 => 'Nopember',
							12 => 'Desember',
						);

	}

	public function index()
	{
		$data['active_menu'] = "monitor";
		$data['title'] = $this->company_profile_model->nama;


		//grafik
		$this->load->model('dashboard_model');

		if ($this->input->get('tahun')) {
			$tahun = $this->input->get('tahun');
		}
		$tahun = (empty($tahun)) ? date("Y") : $tahun;
		
		$data['tahun'] = $tahun;
		$data['bulan'] = $this->bulan;


		$data['data_koordinator'] = $this->dashboard_model->get_data_koordinator();

		foreach ($data['data_koordinator'] as $row) {
			$num = $row->id_instansi;

			$id_koordinator = $row->id_instansi;
			$data['data_lembaga'][$id_koordinator] = $this->dashboard_model->get_data_lembaga($id_koordinator);

			for ($i=1; $i <= 4; $i++) { 
				$get = $this->dashboard_model->get_triwulan($i,$tahun,$id_koordinator);
				$data['grafik1'][$num][$i] = ($get) ? $get : 0;

				if (!isset($data['totalgrafik'][$num])) $data['totalgrafik'][$num] = 0;
				$data['totalgrafik'][$num] = ($get) ? $data['totalgrafik'][$num]+$get : $data['totalgrafik'][$num]+0;
			}

			$grafik2 = array();
			$grafik3 = array();
			$grafik4 = array();
			$grafik5 = array();

			for($i=1;$i<=count($this->bulan);$i++)
			{
				$grafik3[$i] = 0;
			}

			foreach ($data['data_lembaga'][$id_koordinator] as $key => $value) {
				$id_sub_koordinator = $value->id_instansi;

				for($i=1;$i<=count($this->bulan);$i++)
				{
					$get = $this->dashboard_model->get_realisasi($i,$tahun,$id_koordinator,$id_sub_koordinator);
					$grafik2[$key][$i] = ($get) ? $get : 0;

					if (!isset($grafik3[$i])) $grafik3[$i] = 0;
					$grafik3[$i] = ($get) ? $grafik3[$i]+$get : $grafik3[$i]+0;
				}

				$get = $this->dashboard_model->get_realisasi(NULL,$tahun,$id_koordinator,$id_sub_koordinator);
				$grafik4[$key] = ($get) ? $get : 0;

				$get = $this->dashboard_model->get_target(NULL,$tahun,$id_koordinator,$id_sub_koordinator);
				$grafik5[$key] = ($get) ? $get : 0;
			}

			$data['grafik2'][$num] = $grafik2;
			$data['grafik3'][$num] = $grafik3;
			$data['grafik4'][$num] = $grafik4;
			$data['grafik5'][$num] = $grafik5;

		}
		
		//echo count($data['grafik2'][6]); exit();


		//view
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/monitor',$data);
		$this->load->view('blog/src/footer',$data);
		$this->load->view('blog/monitor_grafik',$data);
	}
	
}
?>