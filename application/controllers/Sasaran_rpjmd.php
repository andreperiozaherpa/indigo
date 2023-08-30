<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_rpjmd extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('sasaran_rpjmd_model');
		$this->load->model('ref_visi_misi_model');
		$this->load->model('ref_satuan_model');
		$this->load->model('ref_skpd_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_unit_kerja	= $this->user_model->unit_kerja_id;
		$this->level_unit_kerja	= $this->user_model->level_unit_kerja;
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_sasaran_rpjmd','ref_kode_kegiatan_m');
	}


	public function index()
	{
		if ($this->user_id)
		{
			$this->load->model('ref_visi_misi_model');
			$this->load->model('ref_skpd_model');

			$data['title']		= "Sasaran - Admin ";
			$data['content']	= "sasaran_rpjmd/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_rpjmd";
			$data['skpd'] = $this->sasaran_rpjmd_model->get_all();

			$data['visi'] = $this->ref_visi_misi_model->get_visi();
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();
			$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($data['misi'][0]->id_misi);

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->sasaran_rpjmd_model->get_all());
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
			$data['list'] = $this->sasaran_rpjmd_model->get_page($mulai,$hal,$filter);

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function detail($id_sasaran_rpjmd)
	{
		if ($this->user_id)
		{
			$this->load->model('ref_unit_kerja_model');
			$data['title']		= "Sasaran - Admin ";
			$data['content']	= "sasaran_rpjmd/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_rpjmd";
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();
			$data['detail'] = $this->sasaran_rpjmd_model->get_by_id($id_sasaran_rpjmd);

			$data['tujuan'] = $this->ref_visi_misi_model->get_t_by_id($data['detail']->id_tujuan);
			$data['misi'] = $this->ref_visi_misi_model->select_by_id_m($data['tujuan']->id_misi);
			$data['visi'] = $this->ref_visi_misi_model->select_by_id_v($data['misi']->id_visi);
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['skpd'] = $this->ref_skpd_model->get_all();
			if(!empty($_POST)){
				if(isset($_POST['id_iku_sasaran_rpjmd'])){
					foreach($_POST['id_skpd'] as $k => $v){
						if(empty($v)){
							unset($_POST['id_skpd'][$k]);
						}
					}
					$_POST['id_skpd'] = implode(',', $_POST['id_skpd']);
					$update = $this->sasaran_rpjmd_model->update_indikator($_POST,$_POST['id_iku_sasaran_rpjmd']);
					if($update){
						$data['message'] = 'Indikator berhasil diperbarui';
						$data['type'] = 'success';
					}
				}else{
					foreach($_POST['id_skpd'] as $k => $v){
						if(empty($v)){
							unset($_POST['id_skpd'][$k]);
						}
					}
					$_POST['id_skpd'] = implode(',', $_POST['id_skpd']);
					$insert = $this->sasaran_rpjmd_model->insert_indikator($_POST,$id_sasaran_rpjmd);
					if($insert){
						$data['message'] = 'Indikator berhasil ditambahkan';
						$data['type'] = 'success';
					}
				}
			}
			$data['indikator'] = $this->sasaran_rpjmd_model->get_indikator_by_id_s($id_sasaran_rpjmd);
			// print_r($data['indikator']);die;
			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}



	function get_tujuan_by_misi($id_misi=null)
	{
		if($id_misi==null){
			$id_misi = $this->input->get('id_misi');
		}
		$this->load->model('ref_visi_misi_model');
		$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($id_misi);
		echo '<option value="">Pilih Tujuan</option>';
		foreach ($data['tujuan'] as $key) {
			echo "<option value='{$key->id_tujuan}'>{$key->tujuan}</option>";
		}
	}


	public function add_data()
	{
		if (!$this->input->post('sasaran_rpjmd') OR !$this->input->post('id_tujuan')) {
			echo FALSE;
		} else {
			$data = $_POST;
			$query = $this->sasaran_rpjmd_model->insert($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function update_data($id_sasaran_rpjmd)
	{
		if (!$this->input->post('sasaran_rpjmd') OR !$this->input->post('id_tujuan')) {
			echo FALSE;
		} else {
			$data = $_POST;
			$query = $this->sasaran_rpjmd_model->update($data,$id_sasaran_rpjmd);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function get_data($id_sasaran_rpjmd){
		$this->load->model('ref_visi_misi_model');
		$get = $this->sasaran_rpjmd_model->get_by_id($id_sasaran_rpjmd);
		$id_misi = $this->ref_visi_misi_model->get_t_by_id($get->id_tujuan)->id_misi;
		$get->id_misi = $id_misi;
		echo json_encode($get);
	}


	public function get_indikator_by_id($id_iku_sasaran_rpjmd){
		echo json_encode($this->sasaran_rpjmd_model->get_indikator_by_id($id_iku_sasaran_rpjmd));
	}

	public function delete_indikator($id_iku_sasaran_rpjmd)
	{
		if ($this->user_id)
		{
			$get = $this->sasaran_rpjmd_model->get_indikator_by_id($id_iku_sasaran_rpjmd);
			$id_sasaran_rpjmd = $get->id_sasaran_rpjmd;
			$this->sasaran_rpjmd_model->delete_indikator($id_iku_sasaran_rpjmd);
			redirect('sasaran_rpjmd/detail/'.$id_sasaran_rpjmd);
		}
		else
		{
			redirect('admin');
		}
	}


	public function delete_data($id)
	{
		if ($this->user_id)
		{
			
			$this->sasaran_rpjmd_model->delete_ss($id);
			redirect('sasaran_rpjmd');
		}
		else
		{
			redirect('admin');
		}
	}





}
?>