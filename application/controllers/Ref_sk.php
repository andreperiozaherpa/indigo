<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_sk extends CI_Controller {
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
		$this->user_privileges	= $this->user_model->user_privileges;
		if ($this->user_level=="Admin Web"); 

		$this->load->model('ref_sk_model','sk_m');
		
		if (!$this->user_id OR ($this->session->userdata('user_level') != 1 && !in_array('referensi_umum', $this->user_privileges))) {
			redirect('admin/login');
		}
	}

	public function get_bidang($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_get_bidangizin_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_get_bidangizin_model->get_bidang(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_bidang."'>$row->nama_bidang</option>";
		}
		die ($obj);
	} 


	public function get_izin($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_get_bidangizin_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_get_bidangizin_model->get_izin(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_jenis_izin."'>$row->nama_jenisizin</option>";
		}
		die ($obj);
	}

	public function get_sub_izin($parent_id){
		$obj = '<option value="">Pilih</option>';
		$this->load->model('ref_get_bidangizin_model');
		$id = explode("-",$parent_id);
		$data = $this->ref_get_bidangizin_model->get_sub_izin(null,$id[0]);
		foreach($data as $row){
			$obj .= "<option value='".$row->id_sub_jenis_izin."'>$row->nama_sub_jenisizin</option>";
		}
		die ($obj);
	}


	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. SK - Admin ";
			$data['content']	= "ref_sk/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_Sk";

			$offset = 0;
			$limit = $data['per_page']	= 0;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$this->load->model('ref_sk_model','sk_m');
			$data['result'] = $this->sk_m->get_for_page($limit,$offset);
			$data['all_result'] = $this->sk_m->get_for_page();
			
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;

			$this->load->model('ref_bidang_izin_model','bidang_m');
			$data['bidang_izin'] = $this->bidang_m->get_all();

			$this->load->model('ref_jenis_izin_model','jenis_izin_m');
			$data['jenis_izin'] = $this->jenis_izin_m->get_with_bidang();

			$this->load->model('ref_sub_jenis_izin_model','ref_sub_jenis_izin_m');
			$data['sub_jenis_izin'] = $this->ref_sub_jenis_izin_m->get_all();
			
			$this->load->model('ref_layanan_model','layanan_m');

			$this->load->model('ref_formulir_model','formulir_m');
			$data['layanan'] = $this->layanan_m->get_all();
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function lihat($id_jenis_izin){
		if ($this->user_id)
		{
			$data['title']		= "Ref. SK - Admin ";
			$data['content']	= "ref_sk/index2" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_Sk";

			$offset = 0;
			$limit = $data['per_page']	= 30;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$this->load->model('ref_sk_model','sk_m');
			$data['result'] = $this->sk_m->get_for_page($limit,$offset,array('ref_sk.id_jenis_izin'=>$id_jenis_izin));
			$data['all_result'] = $this->sk_m->get_for_page();
			
			$data['total_rows']	= count($data['all_result']);
			$data['offset']	= $offset;

			$this->load->model('ref_bidang_izin_model','bidang_m');
			$data['bidang_izin'] = $this->bidang_m->get_all();

			$this->load->model('ref_jenis_izin_model','jenis_izin_m');
			$data['jenis_izin'] = $this->jenis_izin_m->get_with_bidang();
			$data['i_jenis_izin'] = $this->jenis_izin_m->select_by_id($id_jenis_izin);

			$this->load->model('ref_sub_jenis_izin_model','ref_sub_jenis_izin_m');
			$data['sub_jenis_izin'] = $this->ref_sub_jenis_izin_m->get_all();
			
			$this->load->model('ref_layanan_model','layanan_m');

			$this->load->model('ref_formulir_model','formulir_m');
			$form = $this->formulir_m->get_formulir_w(array('id_jenis_izin'=>$id_jenis_izin))->result();
			$data['field'] = array();
			foreach($form as $f){
				$this->db->where('id_formulir',$f->id_formulir);
				$data['field'][] = $this->db->get('ref_formulir_field')->result();
			}
			$data['layanan'] = $this->layanan_m->get_all();

			$this->load->model('ref_tabel_select_model','t_select_m');
			$data['t_relasi'] = $this->t_select_m->get_all();
			
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function add(){
		$data = $this->input->post();
		$cek = $this->sk_m->sk_exists($data);
		//echo $cek->num_rows();exit();
		if ($cek->num_rows() == 0 AND ($_FILES['file']['name']!='' OR !empty($data['id_bidang_izin']) OR $this->input->post('id_bidang_izin')!=0)){
			$upload_file = $this->upload_file('file');
			if ($upload_file['status'] == 'sukses'){
				$data['file'] = $upload_file['nama_file'];
				$this->sk_m->insert($data);
				redirect(base_url('ref_sk?msg=success'));
			}
		}
		redirect(base_url('ref_sk?msg=error'));
	}

	public function update($id){
		$set_data = $this->sk_m->select_by_id($id);
		if (count($set_data) != 1) {
			redirect(base_url('ref_sk?msg=error'));
		}
		$_POST['id_sub_jenis_izin'] = $set_data[0]->id_sub_jenis_izin;
		$_POST['id_jenis_izin']  	= $set_data[0]->id_jenis_izin;
		$_POST['id_bidang_izin']  	= $set_data[0]->id_bidang_izin;
		$_POST['id_layanan']  		= $set_data[0]->id_layanan;

		$data = $this->input->post();
		//$cek = $this->sk_m->sk_exists($data);
		//echo $cek->num_rows();exit();
		if ($_FILES['file']['name']!=''){
			$upload_file = $this->upload_file('file');
			if ($upload_file['status'] == 'sukses'){
				$data['file'] = $upload_file['nama_file'];
				$this->sk_m->update($data,$id);
				redirect(base_url('ref_sk?msg=success'));
			}
		}
		redirect(base_url('ref_sk?msg=error'));
	}

	function upload_file($name)
	{
		if (!empty($this->input->post('id_sub_jenis_izin')) OR $this->input->post('id_sub_jenis_izin')!=0) {
			$query = $this->db->get_where('ref_sub_jenis_izin', array('id_sub_jenis_izin' => $this->input->post('id_sub_jenis_izin')));
			$data = $query->result();
			$sk_name = $data[0]->nama_sub_jenisizin;
		} elseif (!empty($this->input->post('id_jenis_izin')) OR $this->input->post('id_jenis_izin')!=0) {
			$query = $this->db->get_where('ref_jenis_izin', array('id_jenis_izin' => $this->input->post('id_jenis_izin')));
			$data = $query->result();
			$sk_name = $data[0]->nama_jenisizin;
		} elseif (!empty($this->input->post('id_bidang_izin')) OR $this->input->post('id_bidang_izin')!=0) {
			$query = $this->db->get_where('ref_bidang_izin', array('id_bidang' => $this->input->post('id_bidang_izin')));
			$data = $query->result();
			$sk_name = $data[0]->nama_bidang;
		} else {
			$sk_name = "unknown";
		}

		$sk = url_title($sk_name, "underscore", true);
		/*$sk = str_replace(" ", "_", $sk);
		$sk = str_replace("/", "_", $sk);
		$sk = str_replace("(", "", $sk);
		$sk = str_replace(")", "", $sk);
		$sk = strtolower($sk);*/

		if (!empty($this->input->post('id_layanan')) OR $this->input->post('id_layanan')>0) {
			$query = $this->db->get_where('ref_layanan', array('id_layanan' => $this->input->post('id_layanan')));
			$data = $query->result();
			$layanan_name = $data[0]->nama_layanan;
		} else {
			$layanan_name = "";
		}

		$layanan = "_".url_title($layanan_name, "underscore", true);
		/*$layanan = str_replace(" ", "_", $layanan);
		$layanan = str_replace("/", "_", $layanan);
		$layanan = str_replace("(", "", $layanan);
		$layanan = str_replace(")", "", $layanan);
		$layanan = strtolower($layanan);*/

		$new_name = date('ymdhis')."_sk_".$sk.$layanan;
		$config['file_name'] = $new_name;
		$config['upload_path'] = './../app/data/template_sk';
		$config['allowed_types'] = 'doc|docx';
		$config['max_size'] = 0;
		$config['overwrite'] = FALSE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($name)) {
		 	$status = 'failed';
		 	$data = '';
		 	$filename = '';
		 	$error = array('error' => $this->upload->display_errors());
		 	$return = array('status' => $status, 'nama_file' => $filename, 'msg' => $this->upload->display_errors() );
		 } else {
		 	$status = 'sukses';
		 	$data = $this->upload->data();
		 	$filename = $data['file_name'];
		 	//$error = array('error' => $this->upload->display_errors());
		 	$return = array('status' => $status, 'nama_file' => $filename, 'msg' => $this->upload->data() );
		 }
		 return $return;
		  
	}


	public function view()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. SK - Admin ";
			$data['content']	= "ref_sk/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_sk";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function edit()
	{
		if ($this->user_id)
		{
			$id = $this->uri->segment(3);
	        if(empty($id)){
	            redirect(base_url('ref_sk'));
	        }

	        $data['item'] = $this->sk_m->select_by_id($id);
	        
	        if(empty($data['item'])){
	            redirect(base_url('ref_sk'));
	        }
	        
	        //load jenis izin
			$this->load->model('ref_bidang_izin_model','bidang_m');
			$this->bidang_m->status = "Y";
			$data['bidang']	= $this->bidang_m->get_all();
			//


	        //load bidang izin
			$this->load->model('ref_jenis_izin_model','jenis_izin_m');
			$this->jenis_izin_m->status = "Y";
			$data['jenisizin']	= $this->jenis_izin_m->get_all();
			//


			//load sub jenis izin
			$this->load->model('ref_sub_jenis_izin_model','sub_jenis_izin_m');
			$this->sub_jenis_izin_m->status = "Y";
			$data['sub_jenis_izin']	= $this->sub_jenis_izin_m->get_all();
			//


			//load sub jenis izin
			$this->load->model('ref_layanan_model','layanan_m');
			$this->layanan_m->status = "Y";
			$data['sub_jenis_izin']	= $this->layanan_m->get_all();
			//


			$data['title']		= "ref SK - Admin ";
			$data['content']	= "ref_sk/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_sub_jenis_izin";
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function delete($id)
	{
		if ($this->user_id)
		{
			$this->sk_m->id_sk = $id;
			$this->sk_m->delete();
			
		}
		else
		{
			redirect('home');
		}
	}
}
?>