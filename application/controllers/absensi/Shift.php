<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shift extends CI_Controller {
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

		$this->load->model("absen_model");

		if (!$this->user_id || $this->user_level != "Administrator")
		{
						redirect("admin");
		}

		$this->hariArr = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');

	}

	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Pengaturan shift - ". app_name;
			$data['content']	= "absensi/shift/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['query']		= $this->absen_model->get_shift()->result();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}
	public function add()
	{
		if ($this->user_id)
		{

			$data['title']		= "Tambah Shift - ". app_name;
			$data['content']	= "absensi/shift/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;


			$data['hariArr'] = $this->hariArr;
			if($_POST)
			{
				$dt = array(
					'nama_shift'	=> $this->input->post("nama_shift"),
					'jam_masuk'	=> $this->input->post("jam_masuk"),
					'jam_pulang'	=> $this->input->post("jam_pulang"),
				);
				if($dt['jam_pulang'] < $dt['jam_masuk'])
				{
					$dt['flag'] = "beda_hari";
				}
				else{
					$dt['flag'] = null;
				}
				foreach ($this->hariArr as $key => $value) {
					$id=$key+1;
					$hari = "hari".$id;
					//var_dump($hari);
					$dt[$hari] = ($this->input->post($hari)) ? "Y" : null;
				}
				$this->db->insert("absen_shift",$dt);
				$data['message_type'] = "success";
				$data['message']		= "Shift berhasil disimpan.";

			}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($id_shift=null)
	{
		if ($this->user_id && $id_shift)
		{

			$data['title']		= "Edit Shift - ". app_name;
			$data['content']	= "absensi/shift/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;


			$data['hariArr'] = $this->hariArr;
			if($_POST)
			{
				$dt = array(
					'nama_shift'	=> $this->input->post("nama_shift"),
					'jam_masuk'	=> $this->input->post("jam_masuk"),
					'jam_pulang'	=> $this->input->post("jam_pulang"),
				);

				foreach ($this->hariArr as $key => $value) {
					$id=$key+1;
					$hari = "hari".$id;
					//var_dump($hari);
					$dt[$hari] = ($this->input->post($hari)) ? "Y" : null;
				}
				if($dt['jam_pulang'] < $dt['jam_masuk'])
				{
					$dt['flag'] = "beda_hari";
				}
				else{
					$dt['flag'] = null;
				}
				$this->db->where("id_shift",$id_shift)->update("absen_shift",$dt);
				$data['message_type'] = "success";
				$data['message']		= "Shift berhasil disimpan.";

			}

			$data['detail'] = $this->db->where("id_shift",$id_shift)->get("absen_shift")->row();

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id=null)
	{
		if ($this->user_id && $id)
		{
			$this->db->where("id_shift",$id)->delete("absen_shift");
			$this->db->where("id_shift",$id)->delete("absen_shift_setting");
			redirect('absensi/shift');
		}
		else
		{
			redirect('home');
		}
	}
}
?>
