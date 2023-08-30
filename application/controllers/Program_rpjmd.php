<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_rpjmd extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->load->model('program_rpjmd_model');
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
			$this->load->model('ref_unit_kerja_model');
			$this->load->model('sasaran_rpjmd_model');

			$this->load->model('ref_unit_kerja_model');
			$data['title']		= "Program - Admin ";
			$data['content']	= "program_rpjmd/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "program_rpjmd";
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$data['visi'] = $this->ref_visi_misi_model->get_visi();
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();


			if(!empty($_POST)){
				unset($_POST['id_misi']);
				unset($_POST['id_tujuan']);
				if(isset($_POST['id_program_rpjmd'])){
					$update = $this->program_rpjmd_model->update_program($_POST,$_POST['id_program_rpjmd']);
					if($update){
						$data['message'] = 'Program berhasil diperbarui';
						$data['type'] = 'success';
					}
				}elseif(
					(!isset($_POST['id_program_rpjmd'])) && (isset($_POST['program_rpjmd']))&& (isset($_POST['id_sasaran_rpjmd']))){
					$insert = $this->program_rpjmd_model->insert_program($_POST);
					if($insert){
						$data['message'] = 'Program berhasil ditambahkan';
						$data['type'] = 'success';
					}
				}
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->program_rpjmd_model->get_all());
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			$filter = '';
			$data['filter'] = false;
			if(!empty($_POST)){
				if(isset($_POST['filter'])){
					unset($_POST['filter']);
					$filter = $_POST;
					$data['filter'] = true;
					$data['filter_data'] = $_POST;
				}else{
					$filter = '';
					$data['filter'] = false;
				}
			}
			$data['list'] = $this->program_rpjmd_model->get_page($mulai,$hal,$filter);



			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function detail($id_program_rpjmd)
	{
		if ($this->user_id)
		{
			$this->load->model('sasaran_rpjmd_model');
			$this->load->model('ref_visi_misi_model');
			$this->load->model('ref_satuan_model');
			$this->load->model('ref_skpd_model');
			$data['title']		= "Program - Admin ";
			$data['content']	= "program_rpjmd/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "program_rpjmd";
			$data['detail'] = $this->program_rpjmd_model->get_by_id($id_program_rpjmd);
			$data['sasaran'] = $this->sasaran_rpjmd_model->get_by_id($data['detail']->id_sasaran_rpjmd);
			$data['tujuan'] = $this->ref_visi_misi_model->get_t_by_id($data['sasaran']->id_tujuan);
			$data['misi'] = $this->ref_visi_misi_model->select_by_id_m($data['tujuan']->id_misi);
			$data['satuan'] = $this->ref_satuan_model->get_all();
			$data['skpd'] = $this->ref_skpd_model->get_all();
			if(!empty($_POST)){
				if(isset($_POST['id_iku_program_rpjmd'])){
					foreach($_POST['id_skpd'] as $k => $v){
						if(empty($v)){
							unset($_POST['id_skpd'][$k]);
						}
					}
					$_POST['id_skpd'] = implode(',', $_POST['id_skpd']);
					$update = $this->program_rpjmd_model->update_indikator($_POST,$_POST['id_iku_program_rpjmd']);
					if($update){
						$data['message'] = 'Indikator berhasil diperbarui';
						$data['type'] = 'success';
					}
				}elseif(isset($_POST['target_anggaran_2019'])){
					$update = $this->program_rpjmd_model->update_program($_POST,$id_program_rpjmd);
					if($update){
						$data['message'] = 'Target Anggaran berhasil diperbarui';
						$data['type'] = 'success';
					}
				}else{
					foreach($_POST['id_skpd'] as $k => $v){
						if(empty($v)){
							unset($_POST['id_skpd'][$k]);
						}
					}
					$_POST['id_skpd'] = implode(',', $_POST['id_skpd']);
					$insert = $this->program_rpjmd_model->insert_indikator($_POST,$id_program_rpjmd);
					if($insert){
						$data['message'] = 'Indikator berhasil ditambahkan';
						$data['type'] = 'success';
					}
				}
			}
			$data['detail'] = $this->program_rpjmd_model->get_by_id($id_program_rpjmd);
			$data['indikator'] = $this->program_rpjmd_model->get_indikator_by_id_p($id_program_rpjmd);
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

	function get_sasaran_by_tujuan($id_tujuan=null)
	{
		if($id_tujuan==null){
			$id_tujuan = $this->input->get('id_tujuan');
		}
		$this->load->model('sasaran_rpjmd_model');
		$data['sasaran'] = $this->sasaran_rpjmd_model->get_sasaran_by_tujuan($id_tujuan);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['sasaran'] as $key) {
			echo "<option value='{$key->id_sasaran_rpjmd}'>{$key->sasaran_rpjmd}</option>";
		}
	}


	public function get_program_by_id($id_program_rpjmd){
		$this->load->model('ref_visi_misi_model');
		$this->load->model('sasaran_rpjmd_model');
		$get = $this->program_rpjmd_model->get_program_by_id($id_program_rpjmd);
		$id_tujuan = $this->sasaran_rpjmd_model->get_by_id($get->id_sasaran_rpjmd)->id_tujuan;
		$id_misi = $this->ref_visi_misi_model->get_t_by_id($id_tujuan)->id_misi;
		$get->id_misi = $id_misi;
		$get->id_tujuan = $id_tujuan;
		echo json_encode($get);
	}

	public function delete_program($id_program_rpjmd)
	{
		if ($this->user_id)
		{
			$this->program_rpjmd_model->delete_program($id_program_rpjmd);
			redirect('program_rpjmd');
		}
		else
		{
			redirect('admin');
		}
	}


	public function get_indikator_by_id($id_iku_program_rpjmd){
		echo json_encode($this->program_rpjmd_model->get_indikator_by_id($id_iku_program_rpjmd));
	}

	public function delete_indikator($id_iku_program_rpjmd)
	{
		if ($this->user_id)
		{
			$get = $this->program_rpjmd_model->get_indikator_by_id($id_iku_program_rpjmd);
			$id_program_rpjmd = $get->id_program_rpjmd;
			$this->program_rpjmd_model->delete_indikator($id_iku_program_rpjmd);
			redirect('program_rpjmd/detail/'.$id_program_rpjmd);
		}
		else
		{
			redirect('admin');
		}
	}



}
?>
