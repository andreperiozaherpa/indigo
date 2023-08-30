<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_program extends CI_Controller {
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
		$this->id_unit_kerja	= $this->user_model->unit_kerja_id;
		$this->level_unit_kerja	= $this->user_model->level_unit_kerja;

		$this->load->model('sasaran_program_model');
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Sasaran Program - Admin ";
			$data['content']	= "sasaran_program/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_program";

			$this->load->model('ref_unit_kerja_model');
			$this->load->model('sasaran_strategis_model');
				$this->sasaran_program_model->tahun = "0";

			if($this->user_level=='Administrator'){
				$data['ss'] = $this->sasaran_strategis_model->get_all_disposisi();
				$data['result'] = $this->sasaran_program_model->get_all_data();
			}else{

			$uk = $this->id_unit_kerja;
				$ket_induk = $this->ref_unit_kerja_model->get_unit_kerja_by_id($uk)[0]->ket_induk;
				if($this->level_unit_kerja==3 || $this->level_unit_kerja==4){
					$ket_induk = explode('|', $ket_induk);
					$ket_induk = $ket_induk[2];
				}else{
					$ket_induk = $uk;
				}



				$data['ss'] = $this->sasaran_strategis_model->get_all_disposisi(0,0,$ket_induk,$this->level_unit_kerja);
				$a = array();
				foreach($data['ss'] as $s){
					$a[] = $s->id_sasaran_strategis;
				}
				$data['result'] = $this->sasaran_program_model->get_all_data(0,0,$a,$this->session->userdata('unit_kerja_id'));
			}
			$data['sasaran_strategis'] = $this->sasaran_program_model->get_all_data_sasaran_strategis();
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function indikator($id_sasaran_program)
	{
		if ($this->user_id)
		{
			$data['title']		= "Sasaran Program - Admin ";
			$data['content']	= "sasaran_program/add_indikator" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_program";
			$data['detail'] = $this->sasaran_program_model->get_data_by_id($id_sasaran_program)[0];


			if (!empty($this->input->post()))
			{
				$data_row = $this->input->post();
				$this->sasaran_program_model->update_indikator($data_row,$id_sasaran_program,"I{$data['detail']->kode_sasaran_program}.");
				redirect('sasaran_program/detail/'.$id_sasaran_program);

			}

			$data['data'] = $this->sasaran_program_model->get_indikator_by_id($id_sasaran_program);

			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	
	public function detail($id_sasaran_program)
	{
		if ($this->user_id)
		{
			$data['title']		= "Sasaran Program - Admin ";
			$data['content']	= "sasaran_program/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_program";
			$data['detail'] = $this->sasaran_program_model->get_data_by_id($id_sasaran_program)[0];
			
			$data['data'] = $this->sasaran_program_model->get_indikator_by_id($id_sasaran_program);

			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	


	public function add_data()
	{
		if (!$this->input->post('sasaran_program') OR !$this->input->post('id_sasaran_strategis') OR !$this->input->post('kode_sasaran_program')) {
			echo FALSE;
		} else {
			$query = $this->sasaran_program_model->insert_data($this->input->post());
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function get_data($id)
	{
		$query = $this->sasaran_program_model->get_data_by_id($id);

		if ( !empty($query) )
		{
			echo json_encode($query);
		}
		else
		{
			echo FALSE;
		}
	}

	public function get_kode($cek="SP-")
	{
		$kode = (isset($_POST['kode'])) ? $_POST['kode'] : $cek;
		$i=1;
		while ($i) {
			$new_kode = $kode.str_pad($i, 3, '0', STR_PAD_LEFT);
			$query = $this->sasaran_program_model->cek_kode($new_kode);
			if ($query==0) {
				break;
			}
			$i++;
		}
		echo $new_kode;
	}

	public function update_data($id=null)
	{
		if (!$this->input->post('sasaran_program') OR !$this->input->post('id_sasaran_strategis') OR !$this->input->post('kode_sasaran_program') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->sasaran_program_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_program_model->update_data($this->input->post(),$id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function delete_data($id=null)
	{
		if ($id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->sasaran_program_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_program_model->delete_data($id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function verifikasi_data($id=null)
	{
		if ($id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->sasaran_program_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_program_model->verifikasi_data($id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function batal_verifikasi_data($id=null)
	{
		if ($id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->sasaran_program_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_program_model->batal_verifikasi_data($id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}
}
?>