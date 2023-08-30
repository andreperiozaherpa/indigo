<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_renstra extends CI_Controller {
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

		$this->load->model('ref_renstra_model');
		if ($this->user_level=="Admin Web"); 

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Rencana Strategis - Admin ";
			$data['content']	= "ref_renstra/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_renstra";

			$data['result'] = $this->ref_renstra_model->get_all_data();
			$data['misi'] = $this->ref_renstra_model->get_all_data_misi();

			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	public function add_data()
	{
		if (!$this->input->post('renstra') OR !$this->input->post('id_misi') OR !$this->input->post('id_tahun')) {
			echo FALSE;
		} else {
			$query = $this->ref_renstra_model->insert_data($this->input->post());
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function get_data($id)
	{
        $query = $this->ref_renstra_model->get_data_by_id($id);

        if ( !empty($query) )
        {
			echo json_encode($query);
        }
        else
        {
			echo FALSE;
        }
	}

	public function update_data($id=null)
	{
		if (!$this->input->post('renstra') OR !$this->input->post('id_misi') OR !$this->input->post('id_tahun') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->ref_renstra_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
			 	echo "not found";
			} else {
				$query = $this->ref_renstra_model->update_data($this->input->post(),$id);
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
			$check_data = $this->ref_renstra_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
			 	echo "not found";
			} else {
				$query = $this->ref_renstra_model->delete_data($id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}
}
?>