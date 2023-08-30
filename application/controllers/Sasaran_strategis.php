<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasaran_strategis extends CI_Controller {
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

		$this->load->model('sasaran_strategis_model');
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_sasaran_strategis','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$this->load->model('ref_unit_kerja_model');
			$data['title']		= "Sasaran Strategis - Admin ";
			$data['content']	= "sasaran_strategis/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_strategis";


				$this->load->model('ref_unit_kerja_model');
				$this->sasaran_strategis_model->tahun = "0";
			if($this->user_level=='Administrator'){
				$data['result'] = $this->sasaran_strategis_model->get_all_data();
			}else{
				$uk = $this->id_unit_kerja;
				$ket_induk = $this->ref_unit_kerja_model->get_unit_kerja_by_id($uk)[0]->ket_induk;
				if($this->level_unit_kerja==3 || $this->level_unit_kerja==4){
					$ket_induk = explode('|', $ket_induk);
					$ket_induk = $ket_induk[2];
				}else{
					$ket_induk = $uk;
				}
				

				$data['result'] = $this->sasaran_strategis_model->get_all_data(0,0,$ket_induk,$this->level_unit_kerja);	
			}

			$data['misi'] = $this->sasaran_strategis_model->get_all_data_misi();
			$data['sasaran_strategis'] = $this->sasaran_strategis_model->getSsInduk(89);
			$data['unit_kerja'] = $this->ref_unit_kerja_model->get_all();

			$this->load->view('admin/index',$data);
		}else{
			redirect('admin');
		}
	}

	public function indikator($id_sasaran_strategis)
	{
		if ($this->user_id)
		{
			$data['title']		= "Sasaran Strategis - Admin ";
			$data['content']	= "sasaran_strategis/add_indikator" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_strategis";
			$data['detail'] = $this->sasaran_strategis_model->get_data_by_id($id_sasaran_strategis)[0];


			if (!empty($this->input->post()))
			{
				$data_row = $this->input->post();
				$this->sasaran_strategis_model->update_indikator($data_row,$id_sasaran_strategis,"I{$data['detail']->kode_sasaran_strategis}.");
				redirect('sasaran_strategis/detail/'.$id_sasaran_strategis);

			}

			$data['data'] = $this->sasaran_strategis_model->get_indikator_by_id($id_sasaran_strategis);

			$this->load->model('ref_satuan_model');
			$data['satuan'] = $this->ref_satuan_model->get_all();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}
	
	public function detail($id_sasaran_strategis)
	{
		if ($this->user_id)
		{
			$data['title']		= "Sasaran Strategis - Admin ";
			$data['content']	= "sasaran_strategis/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "sasaran_strategis";
			$data['detail'] = $this->sasaran_strategis_model->get_data_by_id($id_sasaran_strategis)[0];
			
			$data['data'] = $this->sasaran_strategis_model->get_indikator_by_id($id_sasaran_strategis);

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
		if (!$this->input->post('id_unit') OR !$this->input->post('sasaran_strategis') OR (!$this->input->post('id_misi') AND (!$this->input->post('id_ss_induk') OR !$this->input->post('kode_sasaran_strategis')))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$query = $this->sasaran_strategis_model->insert_data($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function get_data($id)
	{
		$query = $this->sasaran_strategis_model->get_data_by_id($id);

		if ( !empty($query) )
		{
			echo json_encode($query);
		}
		else
		{
			echo FALSE;
		}
	}

	public function get_kode($cek="SS-")
	{
		$kode = (isset($_POST['kode'])) ? $_POST['kode'] : $cek;
		$i=1;
		while ($i) {
			$new_kode = $kode.str_pad($i, 3, '0', STR_PAD_LEFT); 
			$query = $this->sasaran_strategis_model->cek_kode($new_kode);
			if ($query==0) {
				break;
			}
			$i++;
		}
		echo $new_kode;
	}

	public function update_data($id=null)
	{
		if (!$this->input->post('sasaran_strategis') OR !$this->input->post('id_ss_induk') OR !$this->input->post('kode_sasaran_strategis') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->sasaran_strategis_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_strategis_model->update_data($this->input->post(),$id);
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
			$check_data = $this->sasaran_strategis_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
				echo "not found";
			} else {
				$query = $this->sasaran_strategis_model->delete_data($id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}
}
?>