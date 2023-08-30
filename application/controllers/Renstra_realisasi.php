<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renstra_realisasi extends CI_Controller {
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
		$this->load->model('renstra_perencanaan_model');

		$this->level_id	= $this->user_model->level_id;
		$this->jenis = array('ss'=>'sasaran_strategis','sp'=>'sasaran_program','sk'=>'sasaran_kegiatan');
		// if ($this->level_id >2 ) redirect("admin");
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Realisasi Renstra SKPD ";
			$data['content']	= "renstra/realisasi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renstra_realisasi";



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
			$data['title']		= "Detail Realisasi Renstra - Admin ";
			$data['content']	= "renstra/realisasi/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";
			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);

			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
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

	public function detail($jenis,$id_iku,$id_skpd,$testing='')
	{
		if ($this->user_id)
		{
			$data['title']		= "detail - Admin ";
			$data['content']	= "renstra/realisasi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$data['detail'] = $this->renstra_realisasi_model->get_iku_by_id($jenis,$id_iku);
			if(!empty($_POST)){
				if(isset($_POST['perhitungan_capaian'])){
					if($_POST['perhitungan_capaian']=="otomatis"){
						$s_target = 'target_'.$_POST['tahun'];
						$target = $data['detail']->$s_target;
						$realisasi = $_POST['realisasi_'.$_POST['tahun']];
						$pola = $data['detail']->polorarisasi;
						$capaian = get_capaian($target,$realisasi,$pola);
						$_POST['capaian_'.$_POST['tahun']] = $capaian;
					}
				}else{
					$_POST['perhitungan_capaian'] = 'manual';
				}
				unset($_POST['tahun']);

				$update = $this->renstra_realisasi_model->update_realisasi_iku($jenis,$id_iku,$_POST);
			}

			$data['jenis'] = $jenis;
			$name = $this->renstra_realisasi_model->name($jenis);
			$data['sasaran_n'] = $name['nSasaran'];
			$data['sasaran_u'] = $name['name'];
			$data['detail'] = $this->renstra_realisasi_model->get_iku_by_id($jenis,$id_iku);
			$id = 'id_'.$data['sasaran_u'].'_renstra';
			$data['sasaran'] = $this->renstra_realisasi_model->get_sasaran_by_id($jenis,$data['detail']->$id);
			if($testing==1){
			print_r($data['sasaran']);die;
			}
			$data['var'] = $data['sasaran_u'].'_renstra';

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
