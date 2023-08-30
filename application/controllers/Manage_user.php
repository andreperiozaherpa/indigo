<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_user extends CI_Controller {
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
		$this->email	= $this->user_model->email;/*ADD BY AYU*/
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->load->model('master_pegawai_model'); /*ADD BY AYU*/
		$array_privileges = explode(';', $this->user_privileges);

		if (($this->user_level!="Administrator" && $this->user_level!="User") && !in_array('user', $array_privileges)) redirect ('welcome');
		
	}

	public function index()
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$data['title']		= "Users - ". app_name;
			$data['content']	= "user/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$filter = '';
			if (!empty($_POST)) {
				$filter = $_POST;

				$data['filter'] = $filter;
			}
			
			$data['per_page']	= 10;
			$data['total_rows']	= $this->user_model->get_total_row($filter);
			$data['level']	= $this->user_model->get_user_level();
			$offset = 0;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['query']		= $this->user_model->get_for_page($data['per_page'],$offset,$filter);
			$data['active_menu'] = "user";
			$data['email'] = $this->email;/*ADD BY AYU*/
			$data['detail'] = $this->master_pegawai_model->get_by_id($id_pegawai);/*ADD BY AYU*/
			$this->load->view('admin/index', $data);					
		}
		else
		{
			redirect('admin');
		}
	}

	

	public function profile()
	{
		if (!$this->user_id)
		{
			redirect('admin/login');
		}
		else
		{

			$data['title']		= "Your profile - ". app_name;
			$data['content']	= "user/profile" ;

			$this->user_model->set_employee();
			$data['username']	= $this->user_model->username;
			$data['employee_id']	= $this->user_model->employee_id;
			$data['user_picture'] = $this->user_model->user_picture;
			$data['full_name']		= $this->user_model->full_name;
			$data['user_level']		= $this->user_model->level;
			$data['phone']			= $this->user_model->phone;
			$data['user_status']	= $this->user_model->user_status;
			$data['email']			= $this->user_model->email;
			$data['bio']			= $this->user_model->bio;
			$data['reg_date']		= $this->user_model->reg_date;
			$data['employee_name']		= $this->user_model->employee_name;
			$data['employee_email']		= $this->user_model->employee_email;
			$data['employee_phone']		= $this->user_model->employee_phone;
			$data['employee_address']		= $this->user_model->employee_address;
			$data['employee_designation']		= $this->user_model->employee_designation;
			$data['birthday']		= $this->user_model->birthday;
			$data['gender']		= $this->user_model->gender;
			$data['date_joining']		= $this->user_model->date_joining;
			$data['date_leaving']		= $this->user_model->date_leaving;
			$data['ktp']		= $this->user_model->ktp;
			$data['npwp']		= $this->user_model->npwp;
			$data['bpjs']		= $this->user_model->bpjs;
			$data['bpjs_kesehatan']		= $this->user_model->bpjs_kesehatan;
			$data['facebook']		= $this->user_model->facebook;
			$data['twitter']		= $this->user_model->twitter;
			$data['google']		= $this->user_model->google;
			$data['youtube']		= $this->user_model->youtube;
			$data['moto']		= $this->user_model->moto;
			$data['nama_departemen']		= $this->user_model->nama_departemen;
			$data['status_name']		= $this->user_model->status_name;
			$data['employee_identity']		= $this->user_model->employee_identity;
			$data['bank_account']		= $this->user_model->bank_account;
			$data['bank_name']		= $this->user_model->bank_name;
			$data['bank_account_holder']		= $this->user_model->bank_account_holder;
			$data['picture']		= $this->user_model->picture;
			$data['active_menu'] = "";
			$data['top_nav']	= "NO";
			$this->load->model('post_model');
			$data['total_post']		= $this->post_model->getTotalByAuthor($this->user_id);

			//activity
			$this->load->model('logs_model');
			$data['logs']		= $this->logs_model->get_some_id($this->user_model->user_id);


			//education
			$this->load->model('user_model');
			$data['education']		= $this->user_model->get_education($this->user_model->employee_id);

			//family
			$this->load->model('user_model');
			$data['family']		= $this->user_model->get_family($this->user_model->employee_id);

			//work experience
			$this->load->model('user_model');
			$data['work_ex']		= $this->user_model->get_work_ex($this->user_model->employee_id);




			$this->load->view('admin/index',$data);
		}
	}

	public function add()
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$data['title']		= "Add new user - ". app_name;
			$data['content']	= "user/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "user";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->model('employee_model');
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if (($_POST['employee_name'] !="" &&
					$_POST['employee_identity'] !="") || ($_POST['password']!=$_POST['repassword'])
			)
				{
					
					

					$config['upload_path']          = './data/user_picture/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload())
					{
						$this->employee_model->picture 	= "user_default.png";
						$tmp_name				= $_FILES['picture']['tmp_name'];
						if ($tmp_name!="")
						{
							$data['message_type'] = "warning";
							$data['message']			= $this->upload->display_errors();
						}
					}
					else
					{
						$this->employee_model->picture = $this->upload->data('file_name');
					}


					$this->employee_model->employee_name = $_POST['employee_name'];
					$this->employee_model->employee_identity = $_POST['employee_identity'];
					$this->employee_model->status_id = $_POST['status_id'];
					$this->employee_model->employee_departement = $_POST['employee_departement'];
					$this->employee_model->employee_designation = $_POST['employee_designation'];
					$this->employee_model->employee_phone = $_POST['employee_phone'];
					$this->employee_model->employee_email = $_POST['employee_email'];
					$this->employee_model->employee_address = $_POST['employee_address'];
					$this->employee_model->birthday = $_POST['birthday'];
					$this->employee_model->gender = $_POST['gender'];
					$this->employee_model->date_joining = $_POST['date_joining'];
					$this->employee_model->date_leaving = $_POST['date_leaving'];
					$this->employee_model->ktp = $_POST['ktp'];
					$this->employee_model->status_id = $_POST['status_id'];
					$this->employee_model->npwp = $_POST['npwp'];
					$this->employee_model->bpjs = $_POST['bpjs'];
					$this->employee_model->bpjs_kesehatan = $_POST['bpjs_kesehatan'];
					$this->employee_model->bank_name = $_POST['bank_name'];
					$this->employee_model->bank_account = $_POST['bank_account'];
					$this->employee_model->bank_account_holder = $_POST['bank_account_holder'];
					$this->employee_model->facebook = $_POST['facebook'];
					$this->employee_model->twitter = $_POST['twitter'];
					$this->employee_model->google = $_POST['google'];
					$this->employee_model->youtube = $_POST['youtube'];

					$this->employee_model->username = $_POST['username'];
					$this->employee_model->password = md5($_POST['password']);
					$this->employee_model->user_level = $_POST['user_level'];
					$this->employee_model->user_status = $_POST['user_status'];

					$this->employee_model->insert();
					$data['message_type'] = "success";
					$data['message']		= "User has been added successfully.";






			                 //logs
					$this->load->model('logs_model');
					$this->logs_model->user_id	 = $this->session->userdata('user_id');
					$this->logs_model->activity = "has been add employee";
					$this->logs_model->category = "add";
					$desc = $_POST['employee_name'];
					$this->logs_model->description = "with names ".$desc;
					$this->logs_model->insert();




				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}

			//departmen
			$this->load->model('departemen_model');
			$data['departemen']		= $this->departemen_model->get_all();

			//departmen
			$this->load->model('status_employee_model');
			$data['status_employee']		= $this->status_employee_model->get_all();


			//education
			$this->load->model('user_model');
			$data['education']		= $this->user_model->get_education($this->user_model->employee_id);

			//family
			$this->load->model('user_model');
			$data['family']		= $this->user_model->get_family($this->user_model->employee_id);

			//work experience
			$this->load->model('user_model');
			$data['work_ex']		= $this->user_model->get_work_ex($this->user_model->employee_id);





			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}


	public function register()
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$data['title']		= "Add new user - ". app_name;
			$data['content']	= "user/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "user";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['username'] !="" &&
					$_POST['full_name'] !="" &&
					$_POST['user_level'] !="" 
				)
				{
					
					
					$avaliable = $this->user_model->check_avaliable("",$_POST['username'])	;
					if ($avaliable){
						$config['upload_path']          = './data/user_picture/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;

						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload())
						{
							$this->user_model->user_picture 	= "user_default.png";
							$tmp_name				= $_FILES['userfile']['tmp_name'];
							if ($tmp_name!="")
							{
								$data['message_type'] = "warning";
								$data['message']			= $this->upload->display_errors();
							}
						}
						else
						{
							$this->user_model->user_picture = $this->upload->data('file_name');
						}

						$this->user_model->username = $_POST['username'];
						if ($_POST['password']=="")
							$this->user_model->password = "123456";
						else
							$this->user_model->password = $_POST['password'];
						$this->user_model->user_status = $_POST['user_status'];
						$this->user_model->insert();
						$data['message_type'] = "success";
						$data['message']		= "User has been added successfully.";






			                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
						$this->logs_model->activity = "has been add user";
						$this->logs_model->category = "add";
						$desc = $_POST['full_name'];
						$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();


					}
					else{
						$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Username has been used by another user.";
					}

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}

			//departmen
			$this->load->model('departemen_model');
			$data['departmen']		= $this->departemen_model->get_all();

			//departmen
			$this->load->model('status_employee_model');
			$data['status_employee']		= $this->status_employee_model->get_all();


			//education
			$this->load->model('user_model');
			$data['education']		= $this->user_model->get_education($this->user_model->employee_id);

			//family
			$this->load->model('user_model');
			$data['family']		= $this->user_model->get_family($this->user_model->employee_id);

			//work experience
			$this->load->model('user_model');
			$data['work_ex']		= $this->user_model->get_work_ex($this->user_model->employee_id);





			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}


	public function edit($employee_id)
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$data['title']		= "Edit user - ". app_name;
			$data['content']	= "user/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "user";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			$this->user_model->user_id = $employee_id;
			$this->load->model('employee_model');
			
			if (!empty($_POST))
			{
				if ($_POST['username'] !="" &&
					$_POST['full_name'] !="" &&
					$_POST['user_level'] !="" 
					
				)
				{
					
					$avaliable = $this->user_model->check_avaliable($_POST['old_username'],$_POST['username'])	;
					if ($avaliable){
						$config['upload_path']          = './data/user_picture/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;

						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload())
						{
							$this->user_model->user_picture 	= "";
							$tmp_name				= $_FILES['picture']['tmp_name'];
							if ($tmp_name!="")
							{
								$data['error']			= $this->upload->display_errors();
							}
						}
						else
						{
							$this->user_model->set_user_by_user_id();
							if ($this->user_model->user_picture !="user_default.png") unlink('./data/user_picture/'.$this->user_model->user_picture);
							$this->user_model->user_picture = $this->upload->data('file_name');
						}

						$this->employee_model->employee_name = $_POST['employee_name'];
						$this->employee_model->employee_identity = $_POST['employee_identity'];
						$this->employee_model->status_id = $_POST['status_id'];
						$this->employee_model->employee_departement = $_POST['employee_departement'];
						$this->employee_model->employee_designation = $_POST['employee_designation'];
						$this->employee_model->employee_phone = $_POST['employee_phone'];
						$this->employee_model->employee_email = $_POST['employee_email'];
						$this->employee_model->employee_address = $_POST['employee_address'];
						$this->employee_model->birthday = $_POST['birthday'];
						$this->employee_model->gender = $_POST['gender'];
						$this->employee_model->date_joining = $_POST['date_joining'];
						$this->employee_model->date_leaving = $_POST['date_leaving'];
						$this->employee_model->ktp = $_POST['ktp'];
						$this->employee_model->status_id = $_POST['status_id'];
						$this->employee_model->npwp = $_POST['npwp'];
						$this->employee_model->bpjs = $_POST['bpjs'];
						$this->employee_model->bpjs_kesehatan = $_POST['bpjs_kesehatan'];
						$this->employee_model->bank_name = $_POST['bank_name'];
						$this->employee_model->bank_account = $_POST['bank_account'];
						$this->employee_model->bank_account_holder = $_POST['bank_account_holder'];
						$this->employee_model->facebook = $_POST['facebook'];
						$this->employee_model->twitter = $_POST['twitter'];
						$this->employee_model->google = $_POST['google'];
						$this->employee_model->youtube = $_POST['youtube'];

						$this->employee_model->update();
						$data['message_type'] = "success";
						$data['message']		= "User has been updated successfully.";


						$this->user_model->update_privileges();


			                //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
						$this->logs_model->activity = "has been updated user";
						$this->logs_model->category = "update";
						$desc = $_POST['full_name'];
						$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();




					}
					else{
						$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Username has been used by another user.";
					}

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->user_model->set_employee();
			$data['username']	= $this->user_model->username;
			$data['employee_id']	= $this->user_model->employee_id;
			$data['user_picture'] = $this->user_model->user_picture;
			$data['full_name']		= $this->user_model->full_name;
			$data['user_level']		= $this->user_model->level;
			$data['user_privileges']		= $this->user_model->user_privileges;
			$data['user_group_menu']		= $this->user_model->user_group_menu;
			$data['phone']			= $this->user_model->phone;
			$data['user_status']	= $this->user_model->user_status;
			$data['email']			= $this->user_model->email;
			$data['bio']			= $this->user_model->bio;
			$data['reg_date']		= $this->user_model->reg_date;
			$data['employee_name']		= $this->user_model->employee_name;
			$data['employee_email']		= $this->user_model->employee_email;
			$data['employee_phone']		= $this->user_model->employee_phone;
			$data['employee_address']		= $this->user_model->employee_address;
			$data['employee_designation']		= $this->user_model->employee_designation;
			$data['birthday']		= $this->user_model->birthday;
			$data['gender']		= $this->user_model->gender;
			$data['date_joining']		= $this->user_model->date_joining;
			$data['date_leaving']		= $this->user_model->date_leaving;
			$data['ktp']		= $this->user_model->ktp;
			$data['npwp']		= $this->user_model->npwp;
			$data['bpjs']		= $this->user_model->bpjs;
			$data['bpjs_kesehatan']		= $this->user_model->bpjs_kesehatan;
			$data['facebook']		= $this->user_model->facebook;
			$data['twitter']		= $this->user_model->twitter;
			$data['google']		= $this->user_model->google;
			$data['youtube']		= $this->user_model->youtube;
			$data['moto']		= $this->user_model->moto;
			$data['nama_departemen']		= $this->user_model->nama_departemen;
			$data['status_name']		= $this->user_model->status_name;
			$data['employee_identity']		= $this->user_model->employee_identity;
			$data['bank_account']		= $this->user_model->bank_account;
			$data['bank_name']		= $this->user_model->bank_name;
			$data['bank_account_holder']		= $this->user_model->bank_account_holder;
			$data['picture']		= $this->user_model->picture;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function edit_profile()
	{
		if ($this->user_id)
		{
			$data['title']		= "Edit user - ". app_name;
			$data['content']	= "user/edit_profile" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "user";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			$this->user_model->user_id = $this->user_id;
			if (!empty($_POST))
			{
				if ($_POST['username'] !="" &&
					$_POST['full_name'] !="" 
				)
				{
					$avaliable = $this->user_model->check_avaliable($_POST['old_username'],$_POST['username'])	;
					if ($avaliable){
						$config['upload_path']          = './data/user_picture/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;

						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload())
						{
							$this->user_model->user_picture 	= "";
							$tmp_name				= $_FILES['userfile']['tmp_name'];
							if ($tmp_name!="")
							{
								$data['error']			= $this->upload->display_errors();
							}
						}
						else
						{
							$this->user_model->set_user_by_user_id();
							if ($this->user_model->user_picture !="user_default.png") unlink('./data/user_picture/'.$this->user_model->user_picture);
							$this->user_model->user_picture = $this->upload->data('file_name');
						}

						$this->user_model->username = $_POST['username'];
						$this->user_model->password = $_POST['password'];
						$this->user_model->full_name = $_POST['full_name'];
						$this->user_model->user_level= "";
						$this->user_model->user_status = "";
						$this->user_model->email 	= $_POST['email'];
						$this->user_model->phone 	= $_POST['phone'];
						$this->user_model->bio 	= $_POST['bio'];
						$this->user_model->update();
						$data['message_type'] = "success";
						$data['message']		= "Your profile has been updated successfully.";


		                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
						$this->logs_model->activity = "has been updated user";
						$this->logs_model->category = "update";
						$desc = $_POST['full_name'];
						$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();


					}
					else{
						$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Username has been used by another user.";
					}
				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}
			$this->user_model->set_user_by_user_id();
			$data['username']	= $this->user_model->username;
			$data['full_name']	= $this->user_model->full_name;
			$data['user_picture']	= $this->user_model->user_picture;
			$data['email']	= $this->user_model->email;
			$data['phone']	= $this->user_model->phone;
			$data['bio']	= $this->user_model->bio;
			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}

	public function privileges()
	{
		if ($this->user_id)
		{

			$this->user_model->update_privileges();


		                 //logs
			$this->load->model('logs_model');
			$this->logs_model->user_id	 = $this->session->userdata('user_id');
			$this->logs_model->activity = "has been updated user";
			$this->logs_model->category = "update";
			$desc = "privileges";
			$this->logs_model->description = "with names ".$desc;
			$this->logs_model->insert();

			redirect('manage_user/edit/'.$this->uri->segment(3));	

			
		}
		else
		{
			redirect('admin');	
		}
	}


	public function add_education() {



	}








	public function delete($user_id)
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$this->user_model->user_id = $user_id;
			$this->user_model->set_user_by_user_id();
			if ($this->user_model->user_picture !="user_default.png") unlink('./data/user_picture/'.$this->user_model->user_picture);
			$this->user_model->delete();
			if (strpos(strtolower($this->input->get('source')), 'master_pegawai') !== false) {
				redirect($this->input->get('source'));
			} else {
				redirect('manage_user');
			}
		}
		else
		{
			redirect('home');
		}
	}

	public function save_education($employee_id)
	{
		if ($employee_id && !empty($_POST)) {
			$this->load->model('employee_model');
			$this->employee_model->save_education($employee_id);
		}
	}

	public function save_family($employee_id)
	{
		if ($employee_id && !empty($_POST)) {
			$this->load->model('employee_model');
			$this->employee_model->save_family($employee_id);
		}
	}

	public function save_work_ex($employee_id)
	{
		if ($employee_id && !empty($_POST)) {
			$this->load->model('employee_model');
			$this->employee_model->save_work_ex($employee_id);
		}
	}

	public function reload_table($employee_id,$table)
	{
		if ($table && $employee_id) {
			$this->load->library('table');
			switch ($table) {
				case 'education':
				$data 	= $this->user_model->get_education($employee_id);
				$template = array('table_open' => '<table id="table-education" class="table table-striped">', );
				$this->table->set_template($template);
				$this->table->set_heading(array('No.',
					'Grade',
					'Institution Name',
					'Start Year',
					'End Year',
					'Score'));
				foreach ($data as $num => $row) {
					$this->table->add_row(array(++$num,
						$row->grade,
						$row->institution_name,
						$row->start_year,
						$row->end_year,
						$row->score));
				}
				echo $this->table->generate();
				break;
				
				case 'family':
				$data 	= $this->user_model->get_family($employee_id);
				$template = array('table_open' => '<table id="table-family" class="table table-striped">', );
				$this->table->set_template($template);
				$this->table->set_heading(array('No.',
					'Full Name',
					'Gender',
					'Relationship',
					'Birthday',
					'Marital Status',
					'Jobs'));
				foreach ($data as $num => $row) {
					$this->table->add_row(array(++$num,
						$row->fullname,
						$row->gender,
						$row->relationship,
						$row->birthday,
						$row->marital_status,
						$row->jobs));
				}
				echo $this->table->generate();
				break;
				
				case 'work_ex':
				$data 	= $this->user_model->get_work_ex($employee_id);
				$template = array('table_open' => '<table id="table-work_ex" class="table table-striped">', );
				$this->table->set_template($template);
				$num=1;
				$this->table->set_heading(array('No.',
					'Company Name',
					'Position',
					'Start Date',
					'End Dater',
					'Description'));
				foreach ($data as $num => $row) {
					$this->table->add_row(array(++$num,
						$row->company_name,
						$row->position,
						$row->start_date,
						$row->end_date,
						$row->description));
				}
				echo $this->table->generate();
				break;
				
				default:
					# code...
				break;
			}
		}
	}

	public function save_setting($employee_id){
		$this->user_model->set_employee();
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conf_password = $_POST['conf_password'];
		if(!empty($password)){
			if($password !== $conf_password){
				echo '<div class="alert alert-danger">Password Confirmation Not Match</div>';
			}else{	
				$this->user_model->username = $username;
				$this->user_model->password = md5($password);
				$this->user_model->update_setting();
				echo '<div class="alert alert-success">User Setting successfully changed</div>';	
			}
		}else{
			$this->user_model->username = $username;
			$this->user_model->update_setting();
			echo '<div class="alert alert-success">User Setting successfully changed</div>';	
		}	
	}

	public function new()
	{
		if ($this->user_id && $this->user_level=="Administrator")
		{
			if ($this->user_level!="Administrator" && $this->user_level!="Admin Web") redirect ('promkes'); 
			$data['title']		= "Add new user - ". app_name;
			$data['content']	= "user/new" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "user";
			$data['level'] = $this->user_model->get_user_level();
			$this->load->helper('form');
			if (!empty($_POST))
			{
				if ($_POST['username'] !="" &&
					$_POST['employee_name'] !="" &&
					$_POST['user_level'] !="" && ($_POST['password']==$_POST['repassword'])
				)
				{
					
					
					$avaliable = $this->user_model->check_avaliable("",$_POST['username'])	;
					if ($avaliable){
						$config['upload_path']          = './data/user_picture/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;

						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload())
						{
							$this->user_model->user_picture 	= "user_default.png";
							$tmp_name				= $_FILES['userfile']['tmp_name'];
							if ($tmp_name!="")
							{
								$data['message_type'] = "warning";
								$data['message']			= $this->upload->display_errors();
							}
						}
						else
						{
							$this->user_model->user_picture = $this->upload->data('file_name');
						}

						$this->user_model->username = $_POST['username'];
						if ($_POST['password']=="")
							$this->user_model->password = "123456";
						else
							$this->user_model->password = $_POST['password'];
						$this->user_model->user_status = $_POST['user_status'];
						$this->user_model->id_skpd = $_POST['id_skpd'];
						$this->user_model->full_name = $_POST['employee_name'];
						$this->user_model->user_level = $_POST['user_level'];
						$this->user_model->bio = $_POST['employee_address'];
						$this->user_model->phone = $_POST['employee_phone'];
						$this->user_model->email = $_POST['employee_email'];
						// print_r($_POST);die;
						$this->user_model->save();
						$data['message_type'] = "success";
						$data['message']		= "User has been added successfully.";






			                 //logs
						$this->load->model('logs_model');
						$this->logs_model->user_id	 = $this->session->userdata('user_id');
						$this->logs_model->activity = "has been add user";
						$this->logs_model->category = "add";
						$desc = $_POST['employee_name'];
						$this->logs_model->description = "with names ".$desc;
						$this->logs_model->insert();


					}
					else{
						$data['message_type'] = "danger";
						$data['message'] = "<strong>Opps..</strong> Username has been used by another user.";
					}

				}
				else
				{
					$data['message_type'] = "warning";
					$data['message'] = "<strong>Opps..</strong> Data not complete. Please complete it!";
				}
			}

			//departmen
			$this->load->model('ref_unit_kerja_model');
			$data['unit_kerja']		= $this->ref_unit_kerja_model->get_all();

			$this->load->model('ref_skpd_model');
			$data['skpd'] = $this->ref_skpd_model->get_all();


			$this->load->view('admin/index',$data);
			
		}
		else
		{
			redirect('admin');	
		}
	}



	public function contact()
	{
		if (!$this->user_id)
		{
			redirect('admin/login');
		}
		else
		{

			$data['title']		= "Your profile - ". app_name;
			$data['content']	= "user/contact" ;

			$user_id = $this->uri->segment(3);
			$detail = $this->db->get_where('user',['user_id'=>$user_id])->row();

			// $this->user_model->user_id = $this->uri->segment(3);
			// $this->user_model->set_user_by_user_id();

			// $data['user_privileges']		= $this->user_model->user_privileges;
			// $data['user_group_menu']		= $this->user_model->user_group_menu;
			// $data['nama_unit_kerja']		= $this->user_model->nama_unit_kerja;
			
			// $data['user_id']	= $this->user_model->user_id;
			// $data['username']	= $this->user_model->username;
			// $data['unit_kerja_id']	= $this->user_model->unit_kerja_id;
			// $data['id_pegawai']	= $this->user_model->id_pegawai;
			// $data['user_picture'] = $this->user_model->user_picture;
			// $data['full_name']		= $this->user_model->full_name;
			// $data['user_level']		= $this->user_model->level;
			// $data['phone']			= $this->user_model->phone;
			// $data['user_status']	= $this->user_model->user_status;
			// $data['email']			= $this->user_model->email;
			// $data['bio']			= $this->user_model->bio;
			// $data['reg_date']		= $this->user_model->reg_date;
			// $data['picture']		= $this->user_model->user_picture;
			// $data['certificate']	= $this->user_model->certificate;
			// $data['dot_key']		= $this->user_model->dot_key;
			// $data['scan_ttd']		= $this->user_model->scan_ttd;

			foreach($detail as $k => $v){
				$data[$k] = $v;
			}


			$data['active_menu'] = "";
			$data['top_nav']	= "NO";
			$this->load->model('post_model');
			$data['total_post']		= $this->post_model->getTotalByAuthor($this->user_id);

			//activity
			$this->load->model('logs_model');
			$data['logs']		= $this->logs_model->get_some_id($this->user_model->user_id);


			//departmen
			$this->load->model('ref_unit_kerja_model');
			$data['get_unit_kerja']		= $this->ref_unit_kerja_model->get_all();





			$this->load->view('admin/index',$data);
		}
	}

	public function add_skpd(){
		$this->load->model('ref_skpd_model');
		$skpd = $this->ref_skpd_model->get_all();
		foreach($skpd as $s){
			$alias = str_replace(' ', '_', strtolower($s->nama_skpd_alias));
			$array = array('username'=>'admin_'.$alias,'password'=>123456,'user_status'=>'Active','id_skpd'=>$s->id_skpd,'employee_name'=>'Operator '.ucwords(strtolower($s->nama_skpd)),'user_level'=>3,'employee_address'=>'A','employee_phone'=>'A','employee_email'=>'A');

			$this->user_model->username = $array['username'];
			$this->user_model->password = $array['password'];
			$this->user_model->user_status = $array['user_status'];
			$this->user_model->id_skpd = $array['id_skpd'];
			$this->user_model->full_name = $array['employee_name'];
			$this->user_model->user_level = $array['user_level'];
			$this->user_model->bio = $array['employee_address'];
			$this->user_model->phone = $array['employee_phone'];
			$this->user_model->email = $array['employee_email'];
			$this->user_model->user_picture = '';
			$this->user_model->save();
			echo "admin_".$alias." has been created<br>";
		}
	}


	public function change_password($user_id){
		$isSuccess = false; //EDIT BY AYU
		
		$this->user_model->user_id = $user_id;
		$username = $_POST['username'];
		$old_username = $_POST['old_username'];
		$password = $_POST['password'];
		$conf_password = $_POST['conf_password'];
		
		/*ADD BY AYU*/
		$jsonMsg = array();
			
		if ($this->user_model->check_avaliable($old_username, $username)==false) {
			$username = $old_username;
			$jsonMsg = array(
			   "username" => $username,
			   "msg" => "<div class='alert alert-warning'>Username is not available, taking back to <b>".$old_username."</b></div>",
			   "isSuccess" => false
			);
			$isSuccess = false;
		}		
		
		if(!empty($password))
		{
			if($password !== $conf_password)
			{
				$jsonMsg = array(
				   "username" => $username,
				   "msg" => "<div class='alert alert-danger'>Password Confirmation Not Match</div>",
				   "isSuccess" => false
				);
				$isSuccess = false;
		}
			else
			{	
				$this->user_model->username = $username;
				$this->user_model->password = md5($password);
				$this->user_model->update_setting();
				$isSuccess = true;
				//echo '<div class="alert alert-success">User Setting successfully changed</div>';	//COMMENT BY AYU
			}
		}else{
			$this->user_model->username = $username;
			$this->user_model->password = $password; //ADD BY AYU, FIX BUG
			$this->user_model->update_setting();
			$isSuccess = true;
			//echo '<div class="alert alert-success">User Setting successfully changed</div>';	//COMMENT BY AYU
		}
		
		if($isSuccess)
		{			
			$jsonMsg = array(
				   "username" => $username,
				   "password" => $password,
				   "msg" => "<div class='alert alert-success'>User Setting successfully changed</div>",
				   "isSuccess" => true
			);
			//echo '<div class="alert alert-success">User Setting successfully changed</div>';	
	}

		echo json_encode($jsonMsg);
		
		/*ADD BY AYU*/
	}

	public function change_sertifikat($user_id){
		$this->user_model->user_id = $user_id;

		$data['error_certificate'] = "";
		$data['error_key'] = "";
		$data['error_scan_ttd'] = "";

		//$config['upload_path']          = './data/sertifikat/'.$user_id.'/';
		$config['upload_path']          = '/sertifikat/'.$user_id.'/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 10000;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000;

		$this->load->library('upload', $config);

		if (!file_exists($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, true);
		}

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('certificate'))
		{
            // $this->user_model->certificate = "";
			$data['error_certificate']			= "certificate : ".$this->upload->display_errors();
		}
		else
		{
			$this->user_model->certificate = $this->upload->data('file_name');
		}

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('dot_key'))
		{
            // $this->user_model->key = "";
			$data['error_key']			= "key : ".$this->upload->display_errors();
		}
		else
		{
			$this->user_model->dot_key = $this->upload->data('file_name');
		}

		$config['allowed_types']        = 'png';

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('scan_ttd'))
		{
            // $this->user_model->scan_ttd = "";
			$data['error_scan_ttd']			= "scan_ttd : ".$this->upload->display_errors();
		}
		else
		{
			$this->user_model->scan_ttd = $this->upload->data('file_name');
		}

		$this->load->helper('encryption_helper');
		if (!empty($_POST['pass_key'])) {
			$this->user_model->pass_key = encode($_POST['pass_key']);
		}


		$this->user_model->update_sertifikat();

		foreach ($data as $key => $value) {
			if ($value) {
				echo "<div class='alert alert-info'>{$value}</div>";
			}
		}
		echo '<div class="alert alert-success">User Setting successfully changed</div>';	
	}

	public function update_privileges()
	{
		if ($this->user_id)
		{

			$this->user_model->update_privileges();


		                 //logs
			$this->load->model('logs_model');
			$this->logs_model->user_id	 = $this->session->userdata('user_id');
			$this->logs_model->activity = "has been updated user";
			$this->logs_model->category = "update";
			$desc = "privileges";
			$this->logs_model->description = "with names ".$desc;
			$this->logs_model->insert();

			redirect($this->input->get('source'));	

			
		}
		else
		{
			redirect('admin');	
		}
	}

	function x_update_profile() {
		if ($this->input->post('id') AND $this->input->post('name') AND $this->input->post('value')) {
			$this->user_model->x_update_profile();
		}
	}

	function x_update_profile_image($id) {
		if($id!=NULL){
			$config['upload_path']          = './data/user_picture/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;
			$config['max_width']            = 2000;
			$config['max_height']           = 2000;

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('userfile'))
			{
				$_POST['userfile'] = "";
				echo "Error : ".$this->upload->display_errors();
			}
			else
			{
				$_POST['userfile'] = $this->upload->data('file_name');
				$res = $this->user_model->x_update_profile_image($id);
				if ($res) {
					echo "Berhasil mengganti foto profil.";
				} else {
					echo "Gagal mengganti foto profil.";
				}
			}

			echo $_POST['userfile'];

		}
	}
}
