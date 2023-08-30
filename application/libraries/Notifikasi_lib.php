<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_lib {
	public $user_id;

	public function __construct(){
		$CI =& get_instance();
		$CI->load->model('notifikasi_model');
		$CI->user_id = $CI->session->userdata('user_id');
		$CI->load->model('user_model');
		$CI->user_model->user_id = $CI->user_id;
		$CI->user_model->set_user_by_user_id();
		if ($CI->user_id>0) {
			$CI->user_picture = $CI->user_model->user_picture;
			$CI->full_name	= $CI->user_model->full_name;
			$CI->user_level	= $CI->user_model->level;
			$CI->unit_kerja_id	= $CI->user_model->unit_kerja_id;
		}
		// $user_privileges = ($CI->user_id>0)?$CI->user_privileges:array();
		// $sector_privileges = ($CI->user_id>0)?$CI->sector_privileges:array();
		// $level_privileges = ($CI->user_id>0)?$CI->level_privileges:array();
		// $all_privileges = array_unique(array_merge($level_privileges,$sector_privileges,$user_privileges));
		//$array_privileges = explode(';', $CI->user_privileges);

		$current_uri = strtolower($CI->uri->uri_string());
		$current_controller = strtolower($CI->router->fetch_class());
		$current_method = strtolower($CI->router->fetch_method());

		if ($current_uri) {
			$data['current_uri'] 	= $current_uri;
			$data['user_id'] 		= (!empty($CI->user_id) AND $CI->user_id>0) ? $CI->user_id : null;
			$data['unit_kerja_id'] 	= (!empty($CI->unit_kerja_id) AND $CI->unit_kerja_id>0) ? $CI->unit_kerja_id : null;
			$data['is_admin'] 		= (!empty($CI->user_level) AND $CI->user_level == "Administrator") ? true : false;
			$CI->notifikasi_model->read($data);
		}

		// if ($current_controller) {
		// 	$data_controller = $CI->user_model->get_data_controller($current_controller);

		// 	if (!$CI->user_id AND $data_controller[0]->access_login == "Y") {
		// 		$this->alert("login");
		// 	} elseif (count($data_controller) == 0 OR ($data_controller[0]->access_status == "N" AND $CI->user_level != "Administrator")) {
		// 		$this->alert("400", $data_controller);
		// 	} else {
		// 		if (!in_array(strtoupper(hash("crc32b", crypt($current_controller, '$1$sprazuto'))), $all_privileges) AND $data_controller[0]->access_status == "Y" AND $CI->user_level != "Administrator") {
		// 			$this->alert("403", $data_controller);
		// 		}
		// 	}
		// }

		// if ($current_method) {
		// 	$current_access = "{$current_controller}-{$current_method}";
		// 	$data_method = $CI->user_model->get_data_method($data_controller[0]->access_id, $current_method);
			
		// 	if (!$CI->user_id AND $data_method[0]->access_login == "Y") {
		// 		$this->alert("login");
		// 	} elseif (count($data_method) == 0 OR ($data_method[0]->access_status == "N" AND $CI->user_level != "Administrator")) {
		// 		$this->alert("400", $data_method);
		// 	} else {
		// 		if (!in_array(strtoupper(hash("crc32b", crypt($current_access, '$1$sprazuto'))), $all_privileges) AND $data_method[0]->access_status == "Y" AND $CI->user_level != "Administrator") {
		// 			$this->alert("403", $data_method);
		// 		}
		// 	}
			 
		// }

	}

	public function alert($type=null, $data=null)
	{
		$CI =& get_instance();

		$alert_message = "Sorry, you dont have permission.";
		$alert_redirect = "window.history.back();";

		if ($data OR count($data) > 0) {

			if (isset($data[0]->access_message)) {
				$data_message = $data[0]->access_message;
			}
			if (isset($data[0]->access_redirect)) {
				$data_redirect = $data[0]->access_redirect;
			}

			if ($data_message) {
				$alert_message = $this->replace_user($data_message);
				$CI->session->set_flashdata('alert_message', $alert_message);
			}

			if ($data_redirect) {
				$data_redirect = base_url().$data_redirect;
				$alert_redirect = "window.location = '{$data_redirect}';";
				$CI->session->set_flashdata('alert_redirect', $data_redirect);
			}
		}

		switch ($type) {
			case '400':
				redirect('400');
				break;

			case '403':
				redirect('403');
				break;

			case '404':
				redirect('404');
				break;

			case 'login':
				echo "<script>alert('You are not Logged In, please Login to see this page.');window.location = '".base_url('logout?direct='.current_url())."';</script>";
				break;
			
			default:
				echo "<script>alert('{$alert_message}');{$alert_redirect}</script>";
				break;
		}

		die();
	}

	public function replace_user($text)
	{
		$CI =& get_instance();

		$text = str_replace("{user_id}", $CI->user_id, $text);
		$text = str_replace("{full_name}", $CI->full_name, $text);
		$text = str_replace("{user_level}", $CI->user_level, $text);

		return $text;
	}

	public function sent_notifikasi($data)
	{
		$CI =& get_instance();

		$data['user_id'] 			= ($CI->user_id>0) ? $CI->user_id : "unknown";
		$data['target_notifikasi']	= $this->set_target($data['target_notifikasi']);
		$data['link_notifikasi']	= strtolower($data['link_notifikasi']);
		$data['spam_notifikasi'] 	= "";
		$data['read_notifikasi'] 	= "";

		$CI->notifikasi_model->add($data);
	}

	public function set_target($target)
	{
		$CI =& get_instance();

		switch ($target) {
			case 'user_unit_kerja':
				$target = "unit_kerja-{$CI->unit_kerja_id}";
				break;
			
			default:
				// $target = "unknown";
				break;
		}
		return $target;
	}

	public function get_notifikasi($tipe=null,$limit=null,$offset=null)
	{
		$CI =& get_instance();

		if (!empty($tipe)) $data['tipe'] 	= $tipe;
		if ($limit>=0) $data['limit'] 		= $limit;
		if ($offset>=0) $data['offset'] 	= $offset;

		$data['user_id'] 		= ($CI->user_id>0) ? $CI->user_id : null;
		$data['unit_kerja_id'] 	= ($CI->unit_kerja_id>0) ? $CI->unit_kerja_id : null;
		$data['is_admin'] 		= ($CI->user_level == "Administrator") ? true : false;

		return $CI->notifikasi_model->get($data);
	}
}
?>