<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_pribadi extends CI_Controller {
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
		$this->id_pegawai	= $this->user_model->id_pegawai;
		$this->table   = 'calendar_pribadi';
 		$this->load->model('Agenda_pribadi_model', 'modeldb');
		if ($this->user_level=="Admin Web");

		// $this->load->model('agenda_harian_model','agenda_harian_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$id_pegawai = $this->id_pegawai;
			$data_calendar = $this->modeldb->get_list($this->table, $id_pegawai);
			$calendar = array();
			foreach ($data_calendar as $key => $val)
			{
			$calendar[] = array(
				'id'  => intval($val->id),
				'id_pegawai' => $this->id_pegawai,
				'title' => $val->title,
				'description' => trim($val->description),
				'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
				'end'  => date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),
				'color' => $val->color,
			);
			}

			$data = array();

			$data['title']		= "Agenda ";
			$data['content']	= "agenda_kegiatan/pribadi" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['id_pegawai'] = $this->id_pegawai;
			$data['active_menu'] = "agenda_pribadi";
			$data['get_data']   = json_encode($calendar);
			$this->load->view('admin/index',$data);
			$this->load->view('admin/agenda_kegiatan/bottom_pribadi');


		}
		else
		{
			redirect('admin');
		}
	}

	public function save()
	{
		$response = array();
		$this->form_validation->set_rules('title', 'Title cant be empty ', 'required');
		if ($this->form_validation->run() == TRUE)
		{
		$param = $this->input->post();
		$calendar_id = $param['calendar_id'];
		unset($param['calendar_id']);

		if($calendar_id == 0)
		{
			$param['create_at']    = date('Y-m-d H:i:s');
			$insert = $this->modeldb->insert($this->table, $param);

			if ($insert > 0)
			{
			$response['status'] = TRUE;
			$response['notif'] = 'Success add calendar';
			$response['id']  = $insert;
			}
			else
			{
			$response['status'] = FALSE;
			$response['notif'] = 'Server wrong, please save again';
			}
		}
		else
		{
			$where   = [ 'id'  => $calendar_id];
			$param['modified_at']    = date('Y-m-d H:i:s');
			$update = $this->modeldb->update($this->table, $param, $where);

			if ($update > 0)
			{
			$response['status'] = TRUE;
			$response['notif'] = 'Success add calendar';
			$response['id']  = $calendar_id;
			}
			else
			{
			$response['status'] = FALSE;
			$response['notif'] = 'Server wrong, please save again';
			}

		}
		}
		else
		{
		$response['status'] = FALSE;
		$response['notif'] = validation_errors();
		}

		echo json_encode($response);
		}


		public function delete()
		{
		$response   = array();
		$calendar_id  = $this->input->post('id');
		if(!empty($calendar_id))
		{
		$where = ['id' => $calendar_id];
		$delete = $this->modeldb->delete($this->table, $where);

		if ($delete > 0)
		{
			$response['status'] = TRUE;
			$response['notif'] = 'Success delete calendar';
		}
		else
		{
			$response['status'] = FALSE;
			$response['notif'] = 'Server wrong, please save again';
		}
		}
		else
		{
		$response['status'] = FALSE;
		$response['notif'] = 'Data not found';
		}

		echo json_encode($response);
		}

}
?>
