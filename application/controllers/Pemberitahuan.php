<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemberitahuan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->level_id	= $this->user_model->level_id;
		// if ($this->level_id >2 ) redirect("admin");
		$this->load->library('socketio', array('host' => "e-office.sumedangkab.go.id", 'port' => 3000));
	}

	public function index()
	{
		if ($this->user_id) {
			$data['title']		= "Pemberitahuan";
			$data['content']	= "pemberitahuan/index";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_internal";
			$data['notif'] = $this->notification_model->get_all();

			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}

	public function fetch_all()
	{
		if ($this->user_id) {
			$notif = $this->notification_model->get_all();
			if (empty($notif)) {
				echo json_encode(array('status' => false));
			} else {
				$list = array('status' => true);
				foreach ($notif as $n) {
					$list['data'][] = array(
						'notification_id' => $n->notification_id,
						'title' => $n->title,
						'message' => $n->message,
						'link' => base_url($n->data . '/' . $n->data_id),
						'time' => waktu_lalu($n->ndate . ' ' . $n->ntime),
						'read_status' => $n->read_status
					);
				}
				echo json_encode($list);
			}
		}
	}

	public function delete_notification($notification_id)
	{
		if ($this->user_id) {
			$this->notification_model->delete($notification_id);
			echo json_encode(array('status' => true));
		}
	}

	public function fetch_some_unread()
	{
		if ($this->user_id) {
			$notif = $this->notification_model->get_some_unread();
			if (empty($notif)) {
				echo json_encode(array('status' => false));
			} else {
				$list = array('status' => true);
				foreach ($notif as $n) {
					$list['data'][] = array(
						'title' => $n->title,
						'message' => $n->message,
						'link' => base_url($n->data . '/' . $n->data_id),
						'time' => waktu_lalu($n->ndate . ' ' . $n->ntime)
					);
				}
				echo json_encode($list);
			}
		}
	}
	public function fetch_count()
	{
		if ($this->user_id) {
			$category = array('surat_internal/surat_keluar', 'surat_internal/verifikasi_surat', 'surat_internal/tanda_tangan', 'surat_internal/surat_masuk', 'surat_disposisi/internal', 'surat_eksternal/surat_keluar', 'surat_eksternal/verifikasi_surat', 'surat_eksternal/tanda_tangan', 'surat_eksternal/surat_masuk', 'surat_disposisi/eksternal', 'penomoran_surat', 'arsip_surat', 'register_surat');
			$result = array();
			foreach ($category as $c) {
				$get = $this->notification_model->get_by_category($c);
				// print_r($get);
				$ex = explode('/', $c);

				$count = 0;
				$verify = false;
				if (isset($ex[1])) {
					$ses = $ex[1];
					foreach ($get as $g) {
						$keluar = $this->db->get_where('surat_keluar', array('id_surat_keluar' => $g->data_id))->row();
						if ($ses == 'tanda_tangan') {
							$verify = true;
							if ($keluar && ($keluar->status_ttd == "menunggu_verifikasi" && $keluar->status_penomoran == "Y")) {
								// echo $g->data_id."<br>";
								$count++;
							}
						}elseif($ses=="verifikasi_surat"){
							$verify = true;
							if ($keluar && $keluar->status_verifikasi == "menunggu_verifikasi") {
								// echo $g->data_id."<br>";
								$count++;
							}
						}
					}
				}

				if ($verify) {
					$result[$c] = $count;
				} else {
					$result[$c] = count($get);
				}
			}
			echo json_encode($result);
		}
	}
}
