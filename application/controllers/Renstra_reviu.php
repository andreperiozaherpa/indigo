<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renstra_reviu extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->load->model('ref_skpd_model');
		$this->load->model('renstra_realisasi_model');
		$this->load->model('renstra_reviu_model');
		$this->load->model('renstra_perencanaan_model');
                                  $this->load->model('ref_visi_misi_model');
		$this->jenis = array('ss'=>'sasaran_strategis','sp'=>'sasaran_program','sk'=>'sasaran_kegiatan');

		$this->level_id	= $this->user_model->level_id;
		// if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Renstra Reviu";
			$data['content']	= "renstra/reviu/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renstra_reviu";


			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['list'] = $this->ref_skpd_model->get_page($mulai,$hal,$filter);

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function view($id_skpd)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Renstra Reviu - Admin ";
			$data['content']	= "renstra/reviu/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->model('sasaran_rpjmd_model');


			if(!empty($_POST)){
				$up = $_POST;
				$name = $this->renstra_realisasi_model->name($_POST['jenis']);
				unset($up['id_iku']);
				unset($up['jenis']);
				$arr = array('s','m','a','r','t','c');
				foreach($arr as $a){
					if(isset($up['status_'.$a])){
						$status = $up['status_'.$a];
						if($status==1){
							$up['catatan_'.$a] = ''; 
						}
					}
				}
				$update = $this->renstra_reviu_model->update_reviu_iku($_POST['jenis'],$_POST['id_iku'],$up);
			}
			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['unit_kerja'] = $this->renstra_perencanaan_model->get_unit_kerja_by_id_skpd($id_skpd);
			$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);

			$jumlah_reviu = $this->renstra_reviu_model->get_jumlah_reviu($id_skpd);
			$data['belum_diriviu'] = $jumlah_reviu['belum_diriviu'];
			$data['disetujui'] = $jumlah_reviu['disetujui'];
			$data['ditolak'] = $jumlah_reviu['ditolak'];

			foreach ($this->jenis as $key => $value) {
				$data[$value] = $this->renstra_realisasi_model->get_sasaran_by_id_skpd($key,$id_skpd);
			}
			
			$data['a_jenis'] = $this->jenis;

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail()
	{
		if ($this->user_id)
		{
			$data['title']		= "detail Renstra - Admin ";
			$data['content']	= "renstra/reviu/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$data['title']		= "edit Renstra - Admin ";
			$data['content']	= "renstra/reviu/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
	public function get_iku($jenis,$id_iku){
		echo json_encode($this->renstra_realisasi_model->get_iku_by_id($jenis,$id_iku));
	}


}
?>
