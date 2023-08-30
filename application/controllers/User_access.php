<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();	
		$this->load->model('user_access_model');
		// $this->load->library('user_lib');
	}

	public function index()
	{
		$data['title']		= "User Access - Admin ";
		$data['content']	= "user_access/index" ;
		$data['active_menu']	= "user_access" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		
		$data['controller'] = $this->user_access_model->get_data_controller();

		$data['total_rows']	= count($data['controller']);
		$data['total_updated']	= 0;
		$data['result'] = array();
		foreach ($data['controller'] as $controller) {
			$data['result'][$controller->access_id] = $this->user_access_model->get_data_method($controller->access_id);
			$data['total_rows']	+= count($data['result'][$controller->access_id]);

			if ($controller->access_class == "") {
				$data['total_updated']++;
			}
			foreach ($data['result'][$controller->access_id] as $method) {
				if ($method->access_class == "") {
					$data['total_updated']++;
				}
			}
		}
		
				
		$this->load->view('admin/index',$data);
	}

	public function add_access()
	{
		if (!$this->input->post('access_name') OR !$this->input->post('access_status') OR !$this->input->post('access_login') OR !$this->input->post('access_class')) {
			echo FALSE;
		} else {
			$check_access = $this->user_access_model->check_access("0", $this->input->post('access_name'));
			if ($check_access > 0) {
				echo "taken";
			} else {
				$query = $this->user_access_model->insert_access($this->input->post(),"controller");
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function add_method($id=null)
	{
		if (!$this->input->post('access_name') OR !$this->input->post('access_status') OR !$this->input->post('access_login') OR !$this->input->post('access_class') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_access = $this->user_access_model->check_access($id, $this->input->post('access_name'));
			if ($check_access > 0) {
				echo "taken";
			} else {
				$query = $this->user_access_model->insert_access($this->input->post(),$id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function get_data_access($id)
	{
        $query = $this->user_access_model->get_data_by_id($id);

        if ( !empty($query) )
        {
			echo json_encode($query);
        }
        else
        {
			echo FALSE;
        }
	}

	public function update_access($id=null)
	{
		if (!$this->input->post('access_name') OR !$this->input->post('access_status') OR !$this->input->post('access_login') OR !$this->input->post('access_class') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->user_access_model->get_data_by_id($id);
			$check_access = $this->user_access_model->check_access($check_data[0]->access_parent, $this->input->post('access_name'), $id);
			if (count($check_data) <= 0) {
			 	echo "not found";
			} elseif ($check_access > 0) {
				echo "taken";
			} else {
				$query = $this->user_access_model->update_access($this->input->post(),$id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function update_status($id=null)
	{
		if (!$this->input->post('access_status') OR !$this->input->post('access_login') OR $id <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->user_access_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
			 	echo "not found";
			} else {
				$query = $this->user_access_model->update_status($this->input->post(),$id);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function delete_access($id=null, $level=null)
	{
		if ($id <= 0 OR $level <= 0) {
			echo FALSE;
		} else {
			$check_data = $this->user_access_model->get_data_by_id($id);
			if (count($check_data) <= 0) {
			 	echo "not found";
			} else {
				$query = $this->user_access_model->delete_access($id, $level);
				if ($query) {
					echo TRUE;
				}
			}
		}
	}

	public function check_update()
	{
		$this->load->library('controllerlist');
		$res = $this->controllerlist->getControllers();
		var_dump($res); die();
		$updated = 0;
		foreach ($res as $key => $array_value) {
			$check_access = $this->user_access_model->check_access("0", $key);
			if ($check_access == 0) {
				$query = $this->user_access_model->auto_insert_access($key,"controller");
				$updated++;
			}

			foreach ($res[$key] as $value) {
				$check_data2 = $this->user_access_model->get_data_by_name("0", $key);
				$check_access2 = $this->user_access_model->check_access($check_data2[0]->access_id, $value);
				if (count($check_data2) > 0 AND $check_access2 == 0) {
					$query2 = $this->user_access_model->auto_insert_access($value, $check_data2);
					$updated++;
				}
			}
		}
		echo $updated;
	}
	
}
?>