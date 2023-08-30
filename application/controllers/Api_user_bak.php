<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Api_user extends REST_Controller {
	function login_post()
	{
		$headers = $this->input->request_headers();
		$authorization = (!empty($headers['app_key'])) ? $headers['app_key'] : null;
		//var_dump($authorization);
		//var_dump($this->config->item('authorization'));
		//die($this->config->item('authorization'));
		$username = $this->post('username');
		$password = $this->post('password');
		$app_token = $this->post('app_token');
		
		if($authorization!=null && $authorization== $this->config->item('authorization') && !empty($username) && !empty($password) && !empty($app_token))
		{
			
			$data = $this->db->where('username',$username)->where("password",md5($password))->get("user")->result();
			if(!empty($data[0]))
			{
				if($data[0]->app_token ==null){
					$update = array("api_key" => md5(uniqid()), 'app_token' => $app_token);
					$where = array('user_id' => $data[0]->user_id);
					$this->db->update("user",$update,$where);

					$this->db->select("user.*,ref_skpd.nama_skpd,ref_skpd.id_skpd, ref_unit_kerja.nama_unit_kerja,pegawai.id_jabatan,pegawai.jabatan as 'nama_jabatan', pegawai.nama_lengkap, pegawai.nip, pegawai.foto_pegawai as user_picture");

					
					
					$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai','left');
					$this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja','left');
					$this->db->join('ref_skpd', 'pegawai.id_skpd = ref_skpd.id_skpd','left');
					$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
					$data = $this->db->where("user_id",$data[0]->user_id)->get("user")->result();
					$response = array('error' => false,'data' => !empty($data[0]) ? $data[0] : null);
				}
				else{
					$response = [
		    			'error'	=> true,
		    			'message' => 'User sedang login',
		    		];
				}
			}
			else{
				$response = [
	    			'error'	=> true,
	    			'message' => 'Username / password salah',
	    		];
			}
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid data :'.$app_token,
    		];
		}
		
		
		
		$this->response($response);
	}

	function logout_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$cekApi = $this->user_model->checkApiKey($api_key);
		if($api_key!=null && $cekApi){
			$this->db->update('user',array('app_token' => null),array('api_key' => $api_key));
			$response = array(
				'error'		=> false,
				'message'	=> "Logout berhasil",
			);
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credential',
    		];
		}

		

		$this->response($response);
	}

	function change_password_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$cekApi = $this->user_model->checkApiKey($api_key);
		
		$password_confirmation = $this->post('password_confirmation');
		$password = $this->post('password');
		$current_password = $this->post('current_password');
		if($api_key!=null && $cekApi)
		{
			if(!empty($password_confirmation) && !empty($password) && !empty($current_password)){
			
				if($password_confirmation!= $password){
					$response = [
		    			'error'	=> true,
		    			'message' => 'Konfirmasi password salah',
		    		];
				}
				else if(md5($current_password)  !=  $cekApi->password){
					$response = [
		    			'error'	=> true,
		    			'message' => 'Password salah',
		    		];
				}
				else{
					
					$this->db->update('user',array('password' => md5($password)),array('user_id' => $cekApi->user_id));

					$response = array(
						'error'		=> false,
					);
				}
				
			}
			else{
				$response = [
	    			'error'	=> true,
	    			'message' => 'Data tidak lengkap',
	    		];
			}
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credential',
    		];
		}

		

		$this->response($response);
	}

	function get_notification_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$cekApi = $this->user_model->checkApiKey($api_key);

		
		if($api_key!=null && $cekApi){
			
			$this->db->where('user_id', $cekApi->user_id);
			$this->db->where('web',0);
			$this->db->order_by("ndate","DESC");
			$this->db->order_by("ntime","DESC");
			$data = $this->db->get('notification')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credential',
    		];
		}

		

		$this->response($response);
	}

	function get_pengumuman_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$cekApi = $this->user_model->checkApiKey($api_key);

		
		if($api_key!=null && $cekApi){
			
			$this->db->where('tanggal', date('Y-m-d'));
			$data = $this->db->get('pengumuman')->result();

			$response = array(
				'error'		=> false,
				'data'		=> $data,
			);
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credential',
    		];
		}

		

		$this->response($response);
	}

	function profile_post()
	{
		$headers = $this->input->request_headers();
		$api_key = (!empty($headers['api_key'])) ? $headers['api_key'] : null;
		$cekApi = $this->user_model->checkApiKey($api_key);

		if($api_key!=null && $cekApi){
			
			$this->db->select("user.*,ref_skpd.nama_skpd,ref_skpd.id_skpd, ref_unit_kerja.nama_unit_kerja,pegawai.id_jabatan,pegawai.jabatan as 'nama_jabatan', pegawai.nama_lengkap, pegawai.nip, pegawai.foto_pegawai as user_picture");#user.user_picture

					
					
					$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai','left');
					$this->db->join('ref_unit_kerja', 'pegawai.id_unit_kerja = ref_unit_kerja.id_unit_kerja','left');
					$this->db->join('ref_skpd', 'pegawai.id_skpd = ref_skpd.id_skpd','left');
					$this->db->join('ref_jabatan', 'ref_jabatan.id_jabatan = pegawai.id_jabatan','left');
					$user = $this->db->where("user_id",$cekApi->user_id)->get("user")->result();
					$data = null;
					if($user[0])
					{
						$data = $user[0];
						$data->path_foto = base_url()."data/foto/pegawai/".$data->user_picture;
					}
					$response = array('error' => false,'data' => $data);
		}
		else{
			$response = [
    			'error'	=> true,
    			'message' => 'Invalid credentials:',
    		];
		}

		

		$this->response($response);
	}


}