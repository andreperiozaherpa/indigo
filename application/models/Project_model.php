<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model
{
	public $project_id;
	public $project_name;
	public $project_description;
	public $id_services;
	public $id_client;
	public $priority;
	public $date_start;
	public $date_end;
	public $project_leader;
	public $file;
	public $project_status;
	public $team;

	public function get_all()
	{
		if($this->project_name!='') $this->db->like('project.project_name',$this->project_name);
		if($this->id_services!='') $this->db->where('project.id_services',$this->id_services);
		if($this->id_client!='') $this->db->where('project.id_client',$this->id_client);
		if($this->priority!='') $this->db->where('project.priority',$this->priority);
		if ($this->session->userdata('level') != "Administrator") {
			$this->db->where('project_leader',$this->session->userdata('employee_id'));
		}
		$this->db->join('services','services.id_services = project.id_services','left');
		$this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('employee','employee.employee_id = project.project_leader','left');
		$this->db->order_by('project.project_id',"desc");
		$query = $this->db->get('project');
		return $query->result();
	}

	public function get_by_id($project_id)
	{
		$this->db->where('project_id',$project_id);
		$this->db->join('services','services.id_services = project.id_services','left');
		$this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('employee','employee.employee_id = project.project_leader','left');
		$query = $this->db->get('project');
		return $query->result();
	}

	public function get_all_page()
	{		
		$this->db->join('services','services.id_services = project.id_services','left');
		$this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('employee','employee.employee_id = project.project_leader','left');
		$query = $this->db->get('project');
		return $query->result();
	}

	public function insert()
	{
		//$this->db->set('project_id',$this->project_id);
		$this->db->set('project_name',$this->project_name);
		$this->db->set('project_description',$this->project_description);
		$this->db->set('id_services',$this->id_services);
		$this->db->set('id_client',$this->id_client);
		$this->db->set('priority',$this->priority);
		$this->db->set('date_start',$this->date_start);
		$this->db->set('date_end',$this->date_end);
		$this->db->set('project_leader',$this->project_leader);
		$this->db->set('file',$this->file);
		$this->db->set('project_status','Y');
		$this->db->set('team',$this->team);
		$this->db->insert('project');

		return $this->db->insert_id();
	}
	public function update()
	{
		$this->db->where('project_id',$this->uri->segment(3));
		//$this->db->set('project_id',$this->project_id);
		$this->db->set('project_name',$this->project_name);
		$this->db->set('project_description',$this->project_description);
		$this->db->set('id_services',$this->id_services);
		$this->db->set('id_client',$this->id_client);
		$this->db->set('priority',$this->priority);
		$this->db->set('date_start',$this->date_start);
		$this->db->set('date_end',$this->date_end);
		$this->db->set('project_leader',$this->project_leader);
		if ($this->file!="") $this->db->set('file',$this->file);
		$this->db->set('project_status','Y');
		$this->db->set('team',$this->team);
		$this->db->update('project');

		return $this->uri->segment(3);
	}
	public function delete()
	{
		$this->db->where('project_id',$this->project_id);
		$this->db->delete('project');
	}
	public function set_by_id()
	{
		$this->db->join('services','services.id_services = project.id_services','left');
		$this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('employee','employee.employee_id = project.project_leader','left');
		$this->db->where('project_id',$this->project_id);
		$query= $this->db->get('project');
		foreach ($query->result() as $row) {
			$this->project_id = $row->project_id;
			$this->project_name = $row->project_name;
			$this->project_description = $row->project_description;
			$this->id_services = $row->id_services;
			$this->id_client = $row->id_client;
			$this->priority = $row->priority;
			$this->date_start = $row->date_start;
			$this->date_end = $row->date_end;
			$this->project_leader = $row->project_leader;
			$this->file = $row->file;
			$this->project_status = $row->project_status;

		}
	}

	public function set_id()
	{

		$this->db->join('services','services.id_services = project.id_services','left');
		$this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('employee','employee.employee_id = project.project_leader','left');
		$this->db->where('project_id',$this->project_id);
		$query= $this->db->get('project');
		foreach ($query->result() as $row) {
			$this->project_id = $row->project_id;
			$this->project_name = $row->project_name;
			$this->project_description = $row->project_description;
			$this->id_services = $row->id_services;
			$this->id_client = $row->id_client;
			$this->priority = $row->priority;
			$this->date_start = $row->date_start;
			$this->date_end = $row->date_end;
			$this->project_leader = $row->project_leader;
			$this->file = $row->file;
			$this->project_status = $row->project_status;
		}
	}


	public function getDate($date)
	{
		
		$s = explode(",", $date);
		$newDate = $s[1];
		$s2 = explode(" ", $newDate);
		$day = $s2[1];
		$month = $s2[2];
		$year = $s2[3];
		$months = array(
			'January' => '1',
			'February' => '2',
			'March' => '3',
			'April' => '4',
			'May' => '5',
			'June' => '6',
			'July' => '7',
			'August' => '8',
			'September' => '9',
			'October' => '10',
			'November' => '11',
			'December' => '12',
		);
		$numMonth = $months[$month];
		return $year."-".$numMonth."-".$day;
	}


}
?>