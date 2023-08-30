<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
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
		if ($_SERVER['HTTP_HOST'] == "e-office.sumedangkab.go.id") {
			redirect("https://e-office.sumedangkab.go.id/admin");
		}

	}

	public function index()
	{
		$data['active_menu'] = "home";
		$data['title'] = $this->company_profile_model->nama;

		//agenda
		$this->load->model('agenda_model');
		$data['agenda'] = $this->agenda_model->get_some();

		//header
		$this->load->model('img_header_model');
		$data['header'] = $this->img_header_model->get_all();

		//sambutan
		$this->load->model('company_profile_model');
		$data['sambutan'] = $this->company_profile_model->get_all_sambutan();

		//download
		$this->load->model('download_model');
		$data['download'] = $this->download_model->get_some_download();


		//download
		$this->load->model('banner_model');
		$data['banner'] = $this->banner_model->get_all();


		
		//video
		$this->load->model('video_model');
		$data['video'] = $this->video_model->get_limit($limit=1);



		//berita
		$this->load->model('post_model');
		if (!empty($_GET['s'])) {
			$this->post_model->search = $_GET['s'];
			$data['search'] = $_GET['s'];
		}




		//grafik

		/* $this->load->model('dashboard_model');

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
*/


		$this->post_model->external = 'true';
		$this->post_model->post_status = "Publish";
		$data['per_page']	= 3;
		$data['total_rows']	= $this->post_model->get_total_row();
		$offset = 0;
		if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
		$data['posts']		= $this->post_model->get_for_page($data['per_page'],$offset);
		$this->post_model->channel_id = "2";
		$data['posts2']		= $this->post_model->get_for_page($data['per_page'],$offset);
		$this->post_model->channel_id = "3";
		$data['posts3']		= $this->post_model->get_for_page($data['per_page'],$offset);
		$this->load->model('tag_model');
		$data['Qtag']	= $this->tag_model->get_all();
		$this->load->model('category_model');
		$this->category_model->category_status = "Active";
		$data['categories']	= $this->category_model->get_all();
		$data['tags_']	= $this->tag_model->get_all();
		$data['popular']	= $this->post_model->get_popular();



		//view
		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/home',$data);
		$this->load->view('blog/src/footer',$data);
	}

	
}
?>