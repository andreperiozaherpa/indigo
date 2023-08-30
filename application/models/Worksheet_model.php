<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Worksheet_model extends CI_Model
{
	public $worksheet_id;
	public $worksheet_name;
	public $worksheet_slug;
	public $worksheet_status;

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
		$team = $this->session->userdata('id_pegawai');
		if ($this->worksheet_status!="") $this->db->where('worksheet_status',$this->worksheet_status);
		if($this->project_name!='') $this->db->like('project.project_name',$this->project_name);
		// if($this->id_services!='') $this->db->where('project.id_services',$this->id_services);
		// if($this->id_client!='') $this->db->where('project.id_client',$this->id_client);
		if($this->priority!='') $this->db->where('project.priority',$this->priority);
		//$this->db->where(" project.team like '%$team%' ");
		$this->db->select("*,IF(FIND_IN_SET({$this->session->userdata('id_pegawai')},worksheet.member)>0,1,0) AS ME",FALSE);
		$this->db->join('project','project.project_id = worksheet.id_project');
		// $this->db->join('services','services.id_services = project.id_services','left');
		// $this->db->join('client','client.id_client = project.id_client','left');
		$this->db->join('pegawai','pegawai.id_pegawai = project.project_leader','left');
		$this->db->having('ME',"1");
		$this->db->order_by('worksheet.id_project','ASC');
		$query = $this->db->get('worksheet');
		return $query->result();
	}

	public function get_by_id($project_id)
	{
		$this->db->where('id_project',$project_id);
		if ($this->worksheet_status!="") $this->db->where('worksheet_status',$this->worksheet_status);
		// $this->db->select("*,IF(FIND_IN_SET({$this->session->userdata('id_pegawai')},worksheet.member)>0,1,0) AS ME",FALSE);
		// $this->db->having('ME',"1");
		$this->db->join('pegawai','pegawai.id_pegawai = worksheet.employee_id','left');
		$this->db->order_by('worksheet_order','ASC');
		$query = $this->db->get('worksheet');
		return $query->result();
	}

	public function update($data,$id)
	{
		if ($data['jumlah_worksheet']!=0) {
			$jumlah_ws = $data['jumlah_worksheet'];
			$this->db->where('id_project', $id);
			$this->db->group_start();
				$this->db->or_where('status_worksheet !=', "approved");
				$this->db->or_where('status_worksheet IS NULL');
			$this->db->group_end();
			$delete_ws = $this->db->delete('worksheet');
			for ($i=$jumlah_ws; $i > 0; $i--) { 
				if (!empty($data['worksheet_order'.$i])) {
	                $daterange = explode(" - ", $data['daterange'.$i]);
	                $date_start = date_format(date_create_from_format("m/d/Y",$daterange[0]),'Y-m-d');
	                $date_exp = date_format(date_create_from_format("m/d/Y",$daterange[1]),'Y-m-d');
					$item_ws = array(	'id_project' => $id,
										'worksheet_order' => $data['worksheet_order'.$i],
										'jobs' => $data['jobs'.$i],
										'member' => implode(",", $data['member'.$i]),
										'date_start' => $date_start,
										'date_exp' => $date_exp,
										'note' => $data['note'.$i],
										'file' => $data['file'.$i],
									);
					$insert_ws = $this->db->insert('worksheet', $item_ws);
				}
				//unset($data['ws'.$i]);
			}
		}
	}
	
	public function check_availability($old_worksheet,$worksheet_name){
		if ($old_worksheet==$worksheet_name){
			return true;
		}
		else{
			$this->db->where('worksheet_name',$worksheet_name);
			$query = $this->db->get('worksheet');
			if ($query->num_rows() == 0){
				return true;
			}
			else{
				return false;
			}
		}
	}
	public function set_by_id()
	{
		$this->db->where('worksheet_id',$this->worksheet_id);
		$query = $this->db->get('worksheet');
		foreach ($query->result() as $row) {
			$this->worksheet_name 	= $row->worksheet_name;
			$this->worksheet_slug	= $row->worksheet_slug;
			$this->worksheet_status	= $row->worksheet_status;
		}
	}
	public function set_by_slug()
	{
		$this->db->where('worksheet_slug',$this->worksheet_slug);
		$query = $this->db->get('worksheet');
		foreach ($query->result() as $row) {
			$this->worksheet_name 	= $row->worksheet_name;
			$this->worksheet_slug	= $row->worksheet_slug;
			$this->worksheet_status	= $row->worksheet_status;
		}
	}
	public function delete()
	{
		$this->db->where('worksheet_id',$this->worksheet_id);
		$query = $this->db->delete('worksheet');	
	}


    function verifikasi($id,$status)
    {   
    	switch ($status) {
    		case 'setuju':
    			$kode_status = 'approved';
    			$this->db->set('date_done', date('Y-m-d'));
    			break;
    		
    		case 'tolak':
    			$kode_status = 'rejected';
    			break;
    		
    		case 'batal':
    			$kode_status = 'progress';
    			$this->db->set('date_done', NULL);
    			break;
    		
    		case 'kirim':
    			$kode_status = 'progress';
    			break;

    		case 'cancel':
    			$kode_status = '';
    			break;

    		default:
    			$kode_status = '';
    			break;
    	}

		if ($status=="kirim") {
        	$this->db->set('report', $this->input->post('report'));
        	$this->db->set('job_file', $this->input->post('job_file'));
        	$this->db->set('employee_id', $this->session->userdata('id_pegawai'));
        } elseif ($status=="cancel") {
        	$this->db->set('report', '');
        	$this->db->set('job_file', '');
        	$this->db->set('employee_id', '0');
        } else {
        	if ($status=='tolak') {$this->db->set('note', $this->input->post('note'));}
        	else {$this->db->set('note', '');}
        }

        $date = date('Y-m-d H:i:s');

        $this->db->set('status_worksheet', $kode_status);
        //$this->db->set('user_verifikasi', $this->session->userdata('full_name'));

        
        $this->db->where('worksheet_id', $id);
        $this->db->update('worksheet');
        return true;
    }
}
?>