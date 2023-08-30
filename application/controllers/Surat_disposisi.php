<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_disposisi extends CI_Controller {
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
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->load->model('skpd_model');
		$this->load->model('surat_masuk_model');

		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
		$this->load->library('socketio',array('host'=>"e-office.sumedangkab.go.id",'port'=>3000));
	}
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])){
			$id_induk = $_POST['id_induk']==9999 ? 0 : $_POST['id_induk'];
			$data = $this->skpd_model->get_induk($id_induk);
			if (!empty($data)) $obj = "<option value='' selected>Pilih</option>";
			foreach($data as $row){
				$obj .="<option value=".$row->kd_skpd.">".$row->nama_skpd."</option>";
			}
		}
		die ($obj);
	}

	public function eksternal($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{
			$data['title']		= "Surat Disposisi";
			$data['content']	= "surat_disposisi/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_disposisi";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_eksternal_disposisi($summary_field,$summary_value));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_eksternal_disposisi();
			$data['unread'] = $this->surat_masuk_model->get_all_eksternal_unread_disposisi();
			$data['read'] = $this->surat_masuk_model->get_all_eksternal_read_disposisi();
			$data['mustread'] = $this->surat_masuk_model->get_all_eksternal_mustread_disposisi();
			$data['list'] = $this->surat_masuk_model->get_page_eksternal_disposisi($mulai,$hal,$filter,$summary_field,$summary_value);

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function internal($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{
			$summary_value = urldecode($summary_value);
			$data['title']		= "Surat Disposisi Internal - Admin";
			$data['content']	= "surat_disposisi/index_internal" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_disposisi/internal";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_internal_disposisi($summary_field,$summary_value));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_internal_disposisi();
			$data['unread'] = $this->surat_masuk_model->get_all_internal_unread_disposisi();
			$data['read'] = $this->surat_masuk_model->get_all_internal_read_disposisi();
			$data['mustread'] = $this->surat_masuk_model->get_all_internal_mustread_disposisi();
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}
			$data['list'] = $this->surat_masuk_model->get_page_internal_disposisi($mulai,$hal,$filter,$summary_field,$summary_value);

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}



	public function internal_keluar($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{
			$summary_value = urldecode($summary_value);
			$data['title']		= "Surat Disposisi Internal - Admin";
			$data['content']	= "surat_disposisi/index_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_disposisi/internal";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_disposisi_keluar($summary_field,$summary_value,'internal'));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_disposisi_keluar('','','internal');
			$data['unread'] = $this->surat_masuk_model->get_status_disposisi_keluar('Belum Dibaca','internal');
			$data['read'] = $this->surat_masuk_model->get_status_disposisi_keluar('Sudah Dibaca','internal');
			$data['mustread'] = $this->surat_masuk_model->get_status_disposisi_keluar('Perlu Tanggapan','internal');
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}
			$data['list'] = $this->surat_masuk_model->get_page_disposisi_keluar($mulai,$hal,$filter,$summary_field,$summary_value,'internal');

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function eksternal_keluar($summary_field='',$summary_value='')
	{
		if ($this->user_id)
		{
			$summary_value = urldecode($summary_value);
			$data['title']		= "Surat Disposisi Eksternal - Admin";
			$data['content']	= "surat_disposisi/index_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_disposisi/eksternal_keluar";
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->surat_masuk_model->get_all_disposisi_keluar($summary_field,$summary_value,'eksternal'));
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;
			if(!empty($_POST)){
				$filter = $_POST;
				$data['filter'] = true;
				$data['filter_data'] = $_POST;
			}else{
				$filter = '';
				$data['filter'] = false;
			}
			$data['total'] = $this->surat_masuk_model->get_all_disposisi_keluar('','','eksternal');
			$data['unread'] = $this->surat_masuk_model->get_status_disposisi_keluar('Belum Dibaca','eksternal');
			$data['read'] = $this->surat_masuk_model->get_status_disposisi_keluar('Sudah Dibaca','eksternal');
			$data['mustread'] = $this->surat_masuk_model->get_status_disposisi_keluar('Perlu Tanggapan','eksternal');
			if(!empty($summary_value)&&!empty($summary_field)){
				$data['summary_field'] = $summary_field;
				$data['summary_value'] = $summary_value;
			}
			$data['list'] = $this->surat_masuk_model->get_page_disposisi_keluar($mulai,$hal,$filter,$summary_field,$summary_value,'eksternal');

			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id)
	{
		if ($this->user_id)
		{
			$this->filter_disposisi($id);
				$read = $this->notification_model->read('surat_disposisi/detail',$id,$this->session->userdata('user_id'));
			if($read){
				$this->socketio->send('refresh_notification',array('user_id'=>$this->session->userdata('user_id')));
			}
			$data['title']		= "Surat Disposisi";
			$data['content']	= "surat_disposisi/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_by_id($id);
			$data['active_menu'] = "surat_disposisi/".$data['detail']->jenis_surat;

			if (($data['detail']->id_pegawai == $this->session->userdata('id_pegawai') OR ($data['detail']->id_pegawai < 1 AND $data['detail']->id_unit_kerja == $this->session->userdata('id_unit_kerja')) OR ($data['detail']->id_pegawai < 1 AND $data['detail']->id_unit_kerja < 1 AND $data['detail']->id_skpd == $this->session->userdata('id_skpd'))) AND (!$data['detail']->tgl_terima OR $data['detail']->status_surat == "Belum Dibaca")) {
				$this->surat_masuk_model->baca_surat_disposisi($id);
			}

			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($data['detail']->id_surat_masuk);

			$id_skpd = ($this->user_level!=="Administrator") ? $this->session->userdata('id_skpd') : $data['detail']->id_skpd_penerima;
			$this->load->model('ref_skpd_model');

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
			// $data['pegawai'][0] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja(0,$id_skpd);
			foreach ($data['unit_kerja'] as $key => $value) {
				$data['pegawai'][$value->id_unit_kerja] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja($value->id_unit_kerja,$id_skpd);
			}
			// echo "<pre>";print_r($data['pegawai']);die;
			$data['skpd'] = $this->ref_skpd_model->get_skpd_except_this_id_skpd($id_skpd);

			$data['catatan_disposisi'] = array(
												'Wakili / Hadiri / Terima / Laporkan Hasilnya',
												'Agendakan / Persiapan / Koordinasi',
												'Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku',
												'Pelajari / Telaah / Sarannya',
												'Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan',
												'Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan',
												'Untuk Dijawab / Dicatat / FILE',
												'Siapkan Pointer / Sambutan / Bahan Lebih Lanjut',
												'Untuk Dibantu Sesuai Kemampuan dan Ketentuan',
												'ACC, Sesuai Ketentuan yang Berlaku',
												'ACC, Saran Saudara',
												'AMM'
											);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function detail_keluar($id)
	{
		if ($this->user_id)
		{
			$this->filter_disposisi_keluar($id);
			$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_keluar_by_id($id);
			$data['title']		= "Detail Surat Disposisi";
			$data['content']	= "surat_disposisi/detail_keluar" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "surat_disposisi/".$data['detail']->jenis_surat."_keluar";


			$data['disposisi'] = $this->surat_masuk_model->get_disposisi_surat_masuk_by_id_surat($data['detail']->id_surat_masuk);

			$id_skpd = ($this->user_level!=="Administrator") ? $this->session->userdata('id_skpd') : $data['detail']->id_skpd_penerima;
			$this->load->model('ref_skpd_model');

			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);
			// $data['pegawai'][0] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja(0,$id_skpd);
			foreach ($data['unit_kerja'] as $key => $value) {
				$data['pegawai'][$value->id_unit_kerja] = $this->ref_skpd_model->get_pegawai_by_id_unit_kerja($value->id_unit_kerja,$id_skpd);
			}
			$data['skpd'] = $this->ref_skpd_model->get_skpd_except_this_id_skpd($id_skpd);

			$data['catatan_disposisi'] = array(
												'Wakili / Hadiri / Terima / Laporkan Hasilnya',
												'Agendakan / Persiapan / Koordinasi',
												'Selesaikan Sesuai Ketentuan / Peraturan yang Berlaku',
												'Pelajari / Telaah / Sarannya',
												'Untuk Ditindaklanjuti / Dipedomani / Dipenuhi sesuai Ketentuan',
												'Untuk Dibantu / Difasilitasi / Dipenuhi sesuai Ketentuan',
												'Untuk Dijawab / Dicatat / FILE',
												'Siapkan Pointer / Sambutan / Bahan Lebih Lanjut',
												'Untuk Dibantu Sesuai Kemampuan dan Ketentuan',
												'ACC, Sesuai Ketentuan yang Berlaku',
												'ACC, Saran Saudara',
												'AMM'
											);
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add_disposisi($id_surat_masuk,$redirect)
	{
		if($this->user_id)
		{
			$this->filter_disposisi($redirect);

			$data = $_POST;
			$unit_kerja = $data['unit_kerja'];
			unset($data['unit_kerja']);
			$pegawai = $data['pegawai'];
			unset($data['pegawai']);
			$skpd = $data['skpd'];
			unset($data['skpd']);
			unset($data['instruksi']);
			$data['instruksi'] = implode(";", $_POST['instruksi']);

			$data['id_surat_masuk'] = $id_surat_masuk;
			$data['status_surat'] = "Belum Dibaca";
			$data['id_pegawai_disposisi'] = $this->session->userdata('id_pegawai');

			$delete = $this->surat_masuk_model->delete_disposisi($data);

			$data['jenis_penerima_disposisi'] = "internal";
			foreach ($pegawai as $key) {
				$expl_id = explode('-', $key);
				$data['id_unit_kerja'] = $expl_id[0];
				$data['id_pegawai'] = $expl_id[1];
				$query = $this->surat_masuk_model->add_disposisi($data);
			}
			
			unset($data['id_pegawai']);
			foreach ($unit_kerja as $key) {
				$data['id_unit_kerja'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			unset($data['id_unit_kerja']);
			$data['jenis_penerima_disposisi'] = "eksternal";
			foreach ($skpd as $key) {
				$data['id_skpd'] = $key;
				$query = $this->surat_masuk_model->add_disposisi($data);
			}

			redirect('surat_disposisi/detail/'.$redirect);
			



		}
	}



	public function filter_disposisi($id){
		$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_by_id($id);
		
		if(empty($data['detail'])){
			show_404();
		}
		// if($this->user_level!=="Administrator"){
		// 	if($data['detail']->id_pegawai!==$this->id_pegawai || $data['detail']->id_unit_kerja!==$this->session->userdata('id_unit_kerja') || $data['detail']->id_skpd!==$this->session->userdata('id_skpd')){
		// 		show_404();
		// 	}
		// }
	}
	public function filter_disposisi_keluar($id){
		$data['detail'] = $this->surat_masuk_model->get_detail_disposisi_keluar_by_id($id);
		
		if(empty($data['detail'])){
			show_404();
		}
		// if($this->user_level!=="Administrator"){
		// 	if($data['detail']->id_pegawai!==$this->id_pegawai || $data['detail']->id_unit_kerja!==$this->session->userdata('id_unit_kerja') || $data['detail']->id_skpd!==$this->session->userdata('id_skpd')){
		// 		show_404();
		// 	}
		// }
	}

}
?>