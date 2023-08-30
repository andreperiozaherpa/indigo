<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public $user_id;
	public $username;
	public $password;
	public $full_name;
	public $nama_lengkap;
	public $email;
	public $phone;
	public $bio;
	public $user_picture;
	public $user_level;
	public $user_group_menu;
	public $user_privileges;
	public $reg_date;
	public $user_status;
	public $employee_id;
	public $foto_pegawai;
	
	/*EDIT BY AYU*/
	public $is_expired;
	public $tokenCmdbuild;
	/*EDIT BY AYU*/

	public $unit_kerja_id;
	public $id_pegawai;
	public $id_skpd;
	// public $id_jabatan;

	public $level;
	public $level_unit_kerja;
	public $kode_unit_kerja;

	public $search;

	public $unit_kerja_level;

	public $certificate;
	public $dot_key;
	public $pass_key;
	public $scan_ttd;

	public function validasi_login()
	{
		$this->db->where('username',$this->username);
		$this->db->where('password',md5($this->password));
		$query = $this->db->get('user');
		if ($query->num_rows() > 0)
		{
			return true;
		}
	}

	public function cek_status_user()
	{
		// $this->db->join('employee','employee.employee_id = user.employee_id','left');
		$this->db->where('user.username',$this->username);
		$this->db->where('user.user_status','Active');
		$query = $this->db->get('user');
		if ($query->num_rows() > 0)
		{
			$this->set_user_by_username();
			$this->login_sukses();
			return true;
		}
		else
		{
			return false;
		}
	}

	public function login_sukses()
	{
		$CI =& get_instance();
		$CI->session->set_userdata('user_id',$this->user_id);
		$CI->session->set_userdata('employee_id',$this->employee_id);
		$CI->session->set_userdata('unit_kerja_id',$this->unit_kerja_id);
		$CI->session->set_userdata('level_unit_kerja',$this->level_unit_kerja);
		$CI->session->set_userdata('kode_unit_kerja',$this->kode_unit_kerja);
		$CI->session->set_userdata('ket_induk',$this->ket_induk);
		$CI->session->set_userdata('nama_unit_kerja',$this->nama_unit_kerja);
		$CI->session->set_userdata('username',$this->username);
		$CI->session->set_userdata('user_level',$this->user_level);
		$CI->session->set_userdata('level',$this->level);
		$CI->session->set_userdata('user_group_menu',$this->user_group_menu);
		$CI->session->set_userdata('user_privileges',$this->user_privileges);
		$CI->session->set_userdata('full_name',$this->full_name);
		$CI->session->set_userdata('nama_lengkap',$this->nama_lengkap);
		$CI->session->set_userdata('email',$this->email);
		$CI->session->set_userdata('phone',$this->phone);
		$CI->session->set_userdata('id_user',$this->user_id);
		$CI->session->set_userdata('id_pegawai',$this->id_pegawai);
		$CI->session->set_userdata('kd_skpd',$this->kd_skpd);
		$CI->session->set_userdata('id_skpd',$this->id_skpd);
		$CI->session->set_userdata('id_unit_kerja',$this->unit_kerja_id);
		$CI->session->set_userdata('id_jabatan',$this->id_jabatan);
		$CI->session->set_userdata('kepala_skpd',$this->kepala_skpd);
		//echo $this->employee_id;exit();
		
		/*EDIT BY AYU*/
		$CI->session->set_userdata('is_expired', $this->is_expired);	
		
		$urlToken = $this->config->item("urlToken");
		$responseToken = $this->getToken($urlToken);
		$arrResponse = json_decode($responseToken,true);				
		$token = $arrResponse['data']['_id'];
		$CI->session->set_userdata('tokenCmdbuild', $token);					
		/*EDIT BY AYU*/
	}

	/*EDIT BY AYU*/
	public function getToken($url)
	{
		$url = $url;
		$ch = curl_init($url);

		$userAPI = $this->config->item("adminCmdbuild");
		$passAPI = $this->config->item("passwordCmdbuild");
		
		$data = array('username' => $userAPI, 'password' => $passAPI);
		
		$postdata = json_encode($data);

		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	/*EDIT BY AYU*/
	
	public function set_user_by_username()
	{
		//$this->db->select("*, employee.employee_id as employee_id");
		// $this->db->join('employee','employee.employee_id = user.employee_id','left');
		// $this->db->join('departemen','departemen.id_departemen = employee.employee_department','left');
		// $this->db->join('employee_status','employee_status.status_id = employee.status_id','left');
		// $this->db->select("*, pegawai.kd_skpd AS kd_skpd");
		$this->db->join('user_level','user_level.level_id = user.user_level','left','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = user.unit_kerja_id','left');
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai','left');
		$this->db->where('username',$this->username);
		$query = $this->db->get('user');
		foreach ($query->result() as $row)
		{

			$this->user_id 		= $row->user_id;
			$this->username		= $row->username;
			$this->user_level	= $row->user_level;
			$this->level 		= $row->level;
			$this->full_name	= $row->full_name;
			$this->nama_lengkap	= $row->nama_lengkap;
			$this->email 		= $row->email;
			$this->phone		= $row->phone;
			$this->bio 			= $row->bio;
			$this->user_picture = $row->foto_pegawai;
			$this->user_group_menu	= $row->user_group_menu;
			$this->user_privileges	= $row->user_privileges;
			$this->reg_date		= $row->reg_date;
			$this->user_status	= $row->user_status;
			$this->employee_id	= $row->employee_id;
			$this->unit_kerja_id	= $row->unit_kerja_id;
			$this->picture	= $row->picture;
			$this->level_unit_kerja	= $row->level_unit_kerja;
			$this->kode_unit_kerja	= $row->kode_unit_kerja;
			$this->ket_induk	= $row->ket_induk;
			$this->nama_unit_kerja	= $row->nama_unit_kerja;
			$this->id_pegawai	= $row->id_pegawai;
			$this->id_skpd	= $row->id_skpd;
			$this->kd_skpd	= $row->kd_skpd;
			$this->kepala_skpd	= $row->kepala_skpd;
			$this->foto_pegawai	= $row->foto_pegawai;
			$this->id_jabatan	= $row->id_jabatan;

			$this->is_expired = $row->is_expired;
			
		}
	}

	public function set_user_by_user_id()
	{
		$employee_id = $this->uri->segment(3);
		$this->db->select('user.*, user_level.*, ref_unit_kerja.nama_unit_kerja, ref_unit_kerja.level_unit_kerja as unit_kerja_level, pegawai.foto_pegawai as foto_pegawai, pegawai.nama_lengkap, pegawai.id_skpd, pegawai.id_jabatan, pegawai.kepala_skpd');
		$this->db->join('user_level','user_level.level_id = user.user_level','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = user.unit_kerja_id','left');
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai','left');
		$this->db->where('user.user_id',$this->user_id);
		$query = $this->db->get('user');
		foreach ($query->result() as $row)
		{
			$this->username		= $row->username;
			$this->full_name	= $row->full_name;
			$this->email 		= $row->email;
			$this->phone		= $row->phone;
			$this->bio 			= $row->bio;
			$this->user_picture = $row->foto_pegawai;
			$this->user_level	= $row->user_level;
			$this->level_id	= $row->user_level;
			$this->user_group_menu	= $row->user_group_menu;
			$this->user_privileges	= $row->user_privileges;
			$this->reg_date		= $row->reg_date;
			$this->user_status	= $row->user_status;
			$this->level 		= $row->level;
			$this->password 	= $row->password;
			$this->employee_id	= $row->employee_id;

			$this->foto_pegawai	= $row->foto_pegawai;



			$this->certificate	= $row->certificate;
			$this->dot_key		= $row->dot_key;
			$this->scan_ttd		= $row->scan_ttd;

			$this->id_pegawai		= $row->id_pegawai;

			$this->unit_kerja_id		= $row->unit_kerja_id;
			$this->nama_unit_kerja		= $row->nama_unit_kerja;
			$this->unit_kerja_level		= $row->unit_kerja_level;
			$this->level_unit_kerja		= $row->unit_kerja_level;

			$this->id_skpd	= $row->id_skpd;
			$this->kd_skpd	= $row->kd_skpd;
			$this->id_pegawai	= $row->id_pegawai;

			$this->nama_lengkap	= $row->nama_lengkap;
			$this->id_jabatan	= $row->id_jabatan;
			$this->kepala_skpd	= $row->kepala_skpd;
			//$this->user_id 		= $row->user_id;
		}

		if ($this->user_level == 6) {
			$return = $this->get_data_user_pemohon($this->username);
			return $return->result();
		}
	}

	public function get_user_by_user_id($user_id)
	{
		$this->db->select('user.*, user_level.*, ref_unit_kerja.nama_unit_kerja, ref_unit_kerja.level_unit_kerja as unit_kerja_level');
		$this->db->join('user_level','user_level.level_id = user.user_level','left');
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = user.unit_kerja_id','left');
		$this->db->where('user.user_id',$user_id);
		$query = $this->db->get('user');
		return $query->row();
	}

	public function set_employee()
	{
		$employee_id = $this->uri->segment(3);
		$this->db->join('employee','employee.employee_id = user.employee_id','left');
		$this->db->join('departemen','departemen.id_departemen = employee.employee_department','left');
		$this->db->join('employee_education','employee_education.employee_id = employee.employee_id','left');
		$this->db->join('employee_status','employee_status.status_id = employee.status_id','left');
		$this->db->join('user_level','user_level.level_id = user.user_level','left');
		$this->db->where('user.employee_id',$employee_id);
		$query = $this->db->get('user');
		foreach ($query->result() as $row)
		{
			$this->username		= $row->username;
			$this->full_name	= $row->full_name;
			$this->user_id	 = $row->user_id;
			$this->email 		= $row->email;
			$this->phone		= $row->phone;
			$this->bio 			= $row->bio;
			$this->user_picture = $row->user_picture;
			$this->user_level	= $row->user_level;
			$this->user_group_menu	= $row->user_group_menu;
			$this->user_privileges	= $row->user_privileges;
			$this->reg_date		= $row->reg_date;
			$this->user_status	= $row->user_status;
			$this->level 		= $row->level;
			$this->password 	= $row->password;
			$this->employee_id	= $employee_id;
			$this->employee_name	= $row->employee_name;
			$this->employee_designation	= $row->employee_designation;
			$this->employee_phone	= $row->employee_phone;
			$this->employee_email	= $row->employee_email;
			$this->employee_address	= $row->employee_address;
			$this->gender	= $row->gender;
			$this->date_joining	= $row->date_joining;
			$this->ktp	= $row->ktp;
			$this->npwp	= $row->npwp;
			$this->bpjs	= $row->bpjs;
			$this->bpjs_kesehatan	= $row->bpjs_kesehatan;
			$this->facebook	= $row->facebook;
			$this->twitter	= $row->twitter;
			$this->youtube	= $row->youtube;
			$this->moto	= $row->moto;
			$this->picture	= $row->picture;
			$this->nama_departemen	= $row->nama_departemen;
			$this->status_name	= $row->status_name;
			$this->employee_identity	= $row->employee_identity;
			$this->bank_name	= $row->bank_name;
			$this->bank_account	= $row->bank_account;
			$this->bank_account_holder	= $row->bank_account_holder;




			//$this->user_id 		= $row->user_id;
			$this->date_leaving	= $row->date_leaving;
			$this->birthday	= $row->birthday;
			$this->google	= $row->google;
		}

		if ($this->user_level == 6) {
			$return = $this->get_data_user_pemohon($this->username);
			return $return->result();
		}
	}




		public function get_education()
	{
		$user = $this->uri->segment(3);
		$this->db->where('employee_education.employee_id',$user);
		$this->db->join('employee','employee.employee_id = employee_education.employee_id','left');
		$query = $this->db->get('employee_education');
		return $query->result();
	}

		public function get_family()
	{
		$user = $this->uri->segment(3);
		$this->db->where('employee_family.employee_id',$user);
		$this->db->join('employee','employee.employee_id = employee_family.employee_id','left');
		$query = $this->db->get('employee_family');
		return $query->result();
	}

	public function get_work_ex()
	{
		$user = $this->uri->segment(3);
		$this->db->where('employee_work_ex.employee_id',$user);
		$this->db->join('employee','employee.employee_id = employee_work_ex.employee_id','left');
		$query = $this->db->get('employee_work_ex');
		return $query->result();
	}




	public function get_data_user_pemohon($id=null)
	{
		$this->db->where('no_ktp', $id);
		$this->db->join('provinsi','user_pemohon.kd_provinsi_pemohon = provinsi.id_provinsi', 'left');
		$this->db->join('kabupaten','user_pemohon.kd_kabupaten_pemohon = kabupaten.id_kabupaten', 'left');
		$this->db->join('kecamatan','user_pemohon.kd_desa_kecamatan = kecamatan.id_kecamatan', 'left');
		$this->db->join('desa','user_pemohon.kd_desa_pemohon = desa.id_desa', 'left');
		$query = $this->db->get('user_pemohon');
		return $query;
	}


	public function select_by_pemohon() {
        $this->db->where('user_pemohon.user_id', $this->session->userdata('user_id'));


       $this->db->join('provinsi','user_pemohon.kd_provinsi_pemohon = provinsi.id_provinsi', 'left');
		$this->db->join('kabupaten','user_pemohon.kd_kabupaten_pemohon = kabupaten.id_kabupaten', 'left');
        //$this->db->join('respons_helpdesk','respons_helpdesk.id_helpdesk = helpdesk.id_helpdesk','left');
        $query = $this->db->get('user_pemohon');
        return $query->result();
    }


	public function insert()
		{

			$this->db->set('username',$this->username);
			$this->db->set('full_name',$this->full_name);
			$this->db->set('email',$this->email);
			$this->db->set('phone',$this->phone);
			$this->db->set('user_picture',$this->user_picture);
			$this->db->set('user_level',$this->user_level);
			$this->db->set('user_status',$this->user_status);
			$this->db->set('id_pegawai',$this->id_pegawai);
			$this->db->set('unit_kerja_id',$this->unit_kerja_id);
			$this->db->set('kd_skpd',$this->id_skpd);
			$this->db->set('reg_date',date('Y-m-d'));
			$this->db->set('password',md5($this->password));
			//$this->db->set('api_key',$this->generate_api_key());
			$this->db->set('user_privileges','default');
			$this->db->insert('user');

			if ($this->input->post('user_level') == 3) {
				$id = $this->db->insert_id();
				$count = $this->db->get('departemen');
				for ($i=1;$i<=$count->num_rows();$i++){
					if ($this->input->post('departemen'.$i) != NULL) {
						$this->db->set('user_id',$id);
						$this->db->set('id_departemen',$this->input->post('departemen'.$i));
						$this->db->insert('user_departemen');
					}
				}
			}

			return $this->db->insert_id();
		}
	private function generate_api_key()
	{
		return md5(uniqid(rand(), true));
	}
	public function update()
	{

		if ($this->username!="") $this->db->set('username',$this->username);
		if ($this->password!="") $this->db->set('password',md5($this->password));
		if ($this->full_name!="") $this->db->set('full_name',$this->full_name);
		if ($this->email!="") $this->db->set('email',$this->email);
		if ($this->phone!="") $this->db->set('phone',$this->phone);
		if ($this->bio!="") $this->db->set('bio',$this->bio);
		if ($this->user_picture!="") $this->db->set('user_picture',$this->user_picture);
		if ($this->user_status!="") $this->db->set('user_status',$this->user_status);
		if ($this->user_level!="") $this->db->set('user_level',$this->user_level);
		$this->db->where('user_id',$this->user_id);
		$this->db->update('user');

		if ($this->input->post('user_level') == 3) {
			$id = $this->user_id;
			$count = $this->db->get('departemen');
			$this->db->where('user_id', $id);
			$this->db->delete('user_departemen');
			for ($i=1;$i<=$count->num_rows();$i++){
				if ($this->input->post('departemen'.$i) != NULL) {
					$this->db->set('user_id',$id);
					$this->db->set('id_departemen',$this->input->post('departemen'.$i));
					$this->db->insert('user_departemen');
				}
			}
		}

		return true;
	}

	public function delete()
		{
			$this->db->where('user_id',$this->user_id);
			$this->db->delete('user');
		}

	public function get_all()
	{
		if ($this->search!=""){
			$this->db->where(" username like '%$this->search%' OR full_name like '%$this->search%' ");
		}
		$this->db->join('user_level','user_level.level_id = user.user_level','left');
		$this->db->order_by('user_level','ASC');
		$query = $this->db->get('user');
		return $query->result();
	}

	public function get_by_id()
	{
		$this->db->where('user_id',$this->user_id);
		$query = $this->db->get('user');
		return $query->row();
	}


	public function get_by_id_param($id)
	{
		$this->db->where('user.user_id', $id);
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai');
		$query = $this->db->get('user');
		return $query->row();
	}

	public function get_by_pegawai(){
		$this->db->where('id_pegawai',$this->id_pegawai);
		$query = $this->db->get('user');
		return $query->row();
	}

	public function delete_from_pegawai(){
		$this->db->where('id_pegawai',$this->id_pegawai);
		$query = $this->db->delete('user');
		// return $query->row();
	}
	public function get_for_page($limit,$offset,$filter='')
	{

		// $this->db->join('employee','employee.employee_id = user.employee_id','left');
		if($filter!=''){
			foreach($filter as $k => $f){
				if($f!=''){
					$this->db->like($k,$f);
				}
			}
		}
		$this->db->select("*, user.email AS email");
		$this->db->limit($limit,$offset);
		$this->db->join('ref_unit_kerja','ref_unit_kerja.id_unit_kerja = user.unit_kerja_id','left');
		$query = $this->db->get('user');
		return $query->result();
	}

	public function cek_username($username)
	{
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if ($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_user_level()
	{
		$query = $this->db->get('user_level');
		return $query->result();
	}


	public function get_total_row($filter='')
	{
		if($filter!=''){
			foreach($filter as $k => $f){
				if($f!=''){
					$this->db->where($k,$f);
				}
			}
		}
		$query = $this->db->get('user');
		return $query->num_rows();
	}

	public function check_avaliable($old_username,$username)
	{
		if ($old_username == $username){
			return true;
		}
		else{
			return $this->cek_username($username);
		}
	}

	public function update_privileges()
	{
		//if ($this->session->userdata('user_level') == "1") {
		// die;
			foreach($this->input->post('user_privileges') as $p){
				if($p == 'sigeol') {
					$pegawai = $this->db->get_where('pegawai', array('id_user' => $this->uri->segment(3)))->row();
					if($pegawai) {
					$this->load->library('Cmdbuild');
						$detail_sigeol = $this->cmdbuild->getByUsername($pegawai->nip);
						if (empty($detail_sigeol)) {
							$this->db->set('is_expired', 1);
							$this->db->set('sigeol', 1);
						}
					}
				}
			}

			$this->db->set('user_group_menu',implode(";", $this->input->post('user_group_menu')));
			$this->db->set('user_privileges',implode(";", $this->input->post('user_privileges')));
			$this->db->where('user_id',$this->uri->segment(3));
			$this->db->update('user');
		//}
	}

	public function update_setting(){
		$this->db->set('username',$this->username);
		$this->db->set('password',$this->password);
		$this->db->where('user_id',$this->user_id);
		if($this->password != '')//ADD BY AYU, FIX BUG
		{
			$this->db->set('password', $this->password);
		}
		$this->db->update('user');
	}

	/*EDIT BY AYU */
	public function reset_password_expired()
	{
		$this->db->set('username', $this->username);
		$this->db->set('password', $this->password);
		$this->db->set('is_expired', $this->is_expired);
		$this->db->where('user_id', $this->user_id);
		$this->db->update('user');
	}
	/*EDIT BY AYU */

	public function update_sertifikat(){
		$this->db->set('user_id', $this->user_id);
		if ($this->certificate) $this->db->set('certificate',$this->certificate);
		if ($this->dot_key) $this->db->set('dot_key',$this->dot_key);
		if ($this->scan_ttd) $this->db->set('scan_ttd',$this->scan_ttd);
		if ($this->pass_key) $this->db->set('pass_key',$this->pass_key);
		$this->db->where('user_id',$this->user_id);
		$this->db->update('user');
	}


	public function save()
		{

			$this->db->set('username',$this->username);
			$this->db->set('full_name',$this->full_name);
			$this->db->set('email',$this->email);
			$this->db->set('phone',$this->phone);
			$this->db->set('user_picture',$this->user_picture);
			$this->db->set('user_level',$this->user_level);
			$this->db->set('user_status',$this->user_status);
			$this->db->set('reg_date',date('Y-m-d'));
			$this->db->set('password',md5($this->password));
			$this->db->set('kd_skpd',$this->id_skpd);
			$this->db->set('bio',$this->bio);
			//$this->db->set('api_key',$this->generate_api_key());
			$this->db->set('user_privileges','default');
			$this->db->insert('user');

			return true;
		}

	public function x_update_profile()
	{
		if ($this->input->post('id') AND $this->input->post('name') AND $this->input->post('value')) {
			$this->db->set($this->input->post('name'),$this->input->post('value'));
			$this->db->where('user_id',$this->input->post('id'));
			$this->db->update('user');
		}
	}

	public function x_update_profile_image($id)
	{
		if ($id AND $this->input->post('userfile')) {
			$this->db->set('user_picture',$this->input->post('userfile'));
			$this->db->where('user_id',$id);
			$this->db->update('user');
			return true;
		}
	}



	public function get_current_sertifikat_user()
	{
		$this->db->select('user_id, certificate, dot_key, pass_key, scan_ttd');
		 $this->db->where('user_id',$this->session->userdata('user_id'));
		//$this->db->where('user_id',23);
		$query = $this->db->get('user');
		$data = $query->row();
		return $data;
	}

	public function get_user_by_id_new(){
		$this->db->where('user_id', $this->user_id);
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai');
		$this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd', 'left');
		$this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja','left');
		$this->db->join('ketersediaan_user', 'ketersediaan_user.id_ketersediaan = user.id_ketersediaan', 'left');
		$query = $this->db->get('user');
		$res = $query->row();
		if($res->kepala_skpd=='Y'){
			$res->nama_unit_kerja = $res->nama_skpd;
		}
		if($res->id_unit_kerja==0&&$res->kepala_skpd!=='Y'){
			$res->nama_unit_kerja = "-";
		}
		return $res;
	}

	public function checkApiKey($api_key)
	{
		$this->db->select("user.*,pegawai.*");
		$this->db->join("pegawai","pegawai.id_pegawai = user.id_pegawai","left");
		$this->db->where("api_key",$api_key);
		$cek = $this->db->get("user")->row();
		if($cek){
			return $cek;
		}
		return false;
	}

	public function reset_token($id_user){
		$this->db->where('user_id',$id_user);
		$this->db->update('user',array('api_key'=>NULL,'app_token'=>NULL));
	}

	public function get_user_tu_pimpinan($id_skpd,$kop_surat=""){
		if($kop_surat=="sekda"||$kop_surat=="bupati"){
			$id_skpd = 1;
		}
		if($kop_surat=="231"){
			$id_skpd = 3;
		}
		$this->db->join('pegawai','pegawai.id_pegawai = user.id_pegawai','left');
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where("FIND_IN_SET('tu_pimpinan' ,REPLACE(user_privileges, ';', ',') )");
		$q = $this->db->get('user');
		return $q->result();
	}



	public function validateAccount($username = '',$password = '')
	{
		if (!empty($username) && !empty($password)) {
			$this->db->where(['username' => $username, 'password' => $password]);
			return $this->db->get('user')->row();
		}else{
			return false;
		}
	}

}
?>
