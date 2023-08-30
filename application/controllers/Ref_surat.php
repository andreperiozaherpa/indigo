<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_surat extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->load->model('user_model');
		$this->load->model('ref_surat_model');
		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		if ($this->user_level=="Admin Web");

		//$this->load->model('Ref_renstra','ref_kode_kegiatan_m');
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Ref. Surat - Admin ";
			$data['content']	= "ref_surat/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_surat";

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_surat_model->get_all());
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
			$data['list'] = $this->ref_surat_model->get_page($mulai,$hal,$filter);

			$data['total_surat'] = $this->ref_surat_model->get_total_surat();
			$data['total_internal'] = $this->ref_surat_model->get_total_internal();
			$data['total_eksternal'] = $this->ref_surat_model->get_total_eksternal();



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
			$data['title']		= "Tambah Ref. Surat - Admin ";
			$data['content']	= "ref_surat/add" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_surat";
			$data['kolom'] = $this->ref_surat_model->get_field_all();

			if(!empty($_POST)){
				$cek = array('nama_surat'=>$_POST['nama_surat'],'jenis_surat'=>$_POST['jenis_surat'],'json_form'=>$_POST['json_form']);
				// print_r($_POST['json_form']);die;
				print_r($cek);die;
				if(cekForm($cek)){
					$data['message'] = 'Masih ada form yang kosong';
					$data['type'] = 'warning';
				}else{
					$config['upload_path']          = './data/template_surat/';
					$config['allowed_types']        = 'docx|doc';

					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('template_file')){
						$tmp_name = $_FILES['template_file']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file'] = $this->upload->data('file_name');
					}
					if ( ! $this->upload->do_upload('template_file_bupati')){
						$tmp_name = $_FILES['template_file_bupati']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_bupati'] = $this->upload->data('file_name');
					}
					if ( ! $this->upload->do_upload('template_file_kel')){
						$tmp_name = $_FILES['template_file_kel']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_kel'] = $this->upload->data('file_name');
					}
					
					if ( ! $this->upload->do_upload('template_file_pus')){
						$tmp_name = $_FILES['template_file_pus']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_pus'] = $this->upload->data('file_name');
					}
					if ( ! $this->upload->do_upload('template_file_uptd')){
						$tmp_name = $_FILES['template_file_uptd']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_uptd'] = $this->upload->data('file_name');
					}
					if ( ! $this->upload->do_upload('template_file_dprd')){
						$tmp_name = $_FILES['template_file_dprd']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_dprd'] = $this->upload->data('file_name');
					}
					$in = $this->ref_surat_model->insert($cek);
					$data['message'] = 'Surat berhasil ditambahkan';
					$data['type'] = 'success';
				}
			}

			$this->load->view('admin/index',$data);



		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_ref_surat){
		$data['title']		= "Detail Ref. Surat - Admin ";
		$data['content']	= "ref_surat/detail_surat" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "ref_surat";
		$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
		$data['field'] = $this->ref_surat_model->get_field($id_ref_surat);
		$data['fe'] = $this->ref_surat_model->get_field_with_event($id_ref_surat);
		// print_r($data['fe']);
		// die;
		$this->load->view('admin/index',$data);


	}

	public function get_reference($r_field,$r_value,$table,$value){
		if($value=='id_jabatan'){
			// $this->db->where($r_field,$r_value);
			// $pegawai = $this->db->get($table)->row();
			// if($pegawai->id_jabatan==0&&$pegawai->kepala_skpd=="Y"){
			// 	$skpd = $this->db->get_where('ref_skpd',array('id_skpd'=>$pegawai->id_skpd))->row();
			// 	echo "Kepala SKPD ".$skpd->nama_skpd;
			// }else{
			// 	$this->db->where('id_jabatan',$pegawai->id_jabatan);
			// 	$q = $this->db->get('ref_jabatan')->row();
			// 	if($q){
			// 		if($pegawai->jenis_pegawai=="staff"){
			// 			echo "(Staff) ".$q->nama_jabatan;
			// 		}else{
			// 			echo $q->nama_jabatan;
			// 		}
			// 	}else{
			// 		echo "Belum ada jabatan";
			// 	}
			// }

			$this->db->where($r_field,$r_value);
			$q = $this->db->get($table)->row();
			echo $q->jabatan;
		}else{
			$this->db->where($r_field,$r_value);
			$q = $this->db->get($table)->row();
			echo $q->$value;
		}
	}

	public function edit($id_ref_surat){
		$data['title']		= "Detail Ref. Surat - Admin ";
		$data['content']	= "ref_surat/edit" ;
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['active_menu'] = "ref_surat";



		if(!empty($_POST)){
			$cek = array('nama_surat'=>$_POST['nama_surat'],'jenis_surat'=>$_POST['jenis_surat'],'json_form'=>$_POST['json_form']);
			if(cekForm($cek)){
				$data['message'] = 'Masih ada form yang kosong';
				$data['type'] = 'warning';
			}else{
				$config['upload_path']          = './data/template_surat/';
				$config['allowed_types']        = 'docx|doc';
					$this->load->library('upload', $config);
				if (!empty($_FILES['template_file']['name'])){
					if ( ! $this->upload->do_upload('template_file')){
						$tmp_name = $_FILES['template_file']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file'] = $this->upload->data('file_name');
					}
				}
				if (!empty($_FILES['template_file_bupati']['name'])){
					if ( ! $this->upload->do_upload('template_file_bupati')){
						$tmp_name = $_FILES['template_file_bupati']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_bupati'] = $this->upload->data('file_name');
					}
				}
				if (!empty($_FILES['template_file_kel']['name'])){
					if ( ! $this->upload->do_upload('template_file_kel')){
						$tmp_name = $_FILES['template_file_kel']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_kel'] = $this->upload->data('file_name');
					}
				}
				if (!empty($_FILES['template_file_pus']['name'])){
					if ( ! $this->upload->do_upload('template_file_pus')){
						$tmp_name = $_FILES['template_file_pus']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_pus'] = $this->upload->data('file_name');
					}
				}
				if (!empty($_FILES['template_file_uptd']['name'])){
					if ( ! $this->upload->do_upload('template_file_uptd')){
						$tmp_name = $_FILES['template_file_uptd']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_uptd'] = $this->upload->data('file_name');
					}
				}
				
				if (!empty($_FILES['template_file_dprd']['name'])){
					if ( ! $this->upload->do_upload('template_file_dprd')){
						$tmp_name = $_FILES['template_file_dprd']['tmp_name'];
						if ($tmp_name!=""){
							$data['message'] = $this->upload->display_errors();
							$data['type'] = "danger";
						}
					}else{
						$cek['template_file_dprd'] = $this->upload->data('file_name');
					}
				}
				$in = $this->ref_surat_model->update($cek,$id_ref_surat);
				$data['message'] = 'Surat berhasil diperbarui';
				$data['type'] = 'success';
			}
		}


		$data['detail'] = $this->ref_surat_model->get_by_id($id_ref_surat);
		$field = $this->ref_surat_model->get_field($id_ref_surat);
		$data['fields'] = '';
		$c = count($field);
		$num=1;
		foreach($field as $f){
			if($c!==$num){
				$comma = ',';
			}else{
				$comma = '';
			}
			if($f->r_value!==''&&$f->r_table!==''&&$f->r_label!==''){
				$r = ',"table":"'.$f->r_table.'","t_value":"'.$f->r_value.'","t_label":"'.$f->r_label.'"';
				$l = 'database';
			}else{
				$r = '';
				$l = 'costumize';
			}
			if($f->re_r_value!==''&&$f->re_table!==''&&$f->re_value!==''&&$f->re_event!==''){
				$re = ',"reference_value":"'.$f->re_r_value.'","re_table":"'.$f->re_table.'","re_value":"'.$f->re_value.'","re_event":"'.$f->re_event.'"';
				$a = 'aktif';
			}else{
				$re = '';
				$a = 'nonaktif';
			}
			if($f->input_type=='select'||$f->input_type=='checkbox-group'||$f->input_type=='radio-group'){
				$option = $this->ref_surat_model->get_option($f->id_field);
				$op = '';
				$cc = count($option);
				$numm=1;
				foreach($option as $o){
					if($cc!==$numm){
						$commaa = ',';
					}else{
						$commaa = '';
					}
					$op .= '{"label":"'.$o->option_label.'","value":"'.$o->option_value.'"}'.$commaa.'';
					$numm++;
				}
				$opp = ',"values":['.$op.']';
			}else{
				$opp ='';
			}

			if($f->input_type=='checkbox-group'||$f->input_type=='radio-group'||$f->input_type=='header'){
				$class = '';
			}else{
				$class = $f->field_class;
			}

			$f->field_label = preg_replace("/[^ \w]+/", "", $f->field_label);
			$data['fields'] .= '{"type":"'.$f->input_type.'","label":"'.$f->field_label.'","name":"'.$f->field_name.'","placeholder":"'.$f->field_placeholder.'","className":"'.$class.'","lookup":"'.$l.'","autofill":"'.$a.'"'.$r.$opp.$re.'}'.$comma.'';
			$num++;
		}
		$this->load->view('admin/index',$data);


	}

	public function delete($id_ref_surat){
		$this->ref_surat_model->delete($id_ref_surat);
		redirect('ref_surat');
	}	

	public function get_db(){
		$this->load->view('admin/ref_formulir/get_db');
	}
	public function get_column($table){
		$data['column'] = $this->db->query("SHOW COLUMNS FROM $table")->result();
		$this->load->view('admin/ref_formulir/get_column',$data);
	}
	public function get_columnn($table){
		$column = $this->db->query("SHOW COLUMNS FROM $table")->result();
		$count = count($column);
		$no=1;
		foreach($column as $c){
			$field = $c->Field;
			echo '<option value="'.$field.'">'.$field.'</option>';
		}
	}
	public function get_selected($type,$field_name,$id_ref_surat=0){
		if($id_ref_surat!==0){
			$q = $this->db->get_where('ref_formulir_field',array('field_name'=>$field_name,'id_ref_surat'=>$id_ref_surat))->row();
		}else{
			$q = $this->db->get_where('ref_formulir_field',array('field_name'=>$field_name))->row();

		}
		if($type=='label'){
			echo $q->r_label;
		}elseif($type=='value'){
			echo $q->r_value;
		}
	}
	
	public function get_reference_value($field_name,$id_ref_surat=0){
		if($id_ref_surat!==0){
			// echo $id_ref_surat;
			// echo $field_name;
			$q = $this->db->get_where('ref_formulir_field',array('field_name'=>$field_name,'id_ref_surat'=>$id_ref_surat))->row();
			// print_r($q);
			echo $q->re_value;
		}
	}
	public function test(){
		$q = $this->db->query('DESCRIBE tbl_perizinan')->result();
		$i = 1;
		foreach($q as $row) {
		    // echo "{$row['Field']} - {$row['Type']}\n";
			if($row->Type == 'varchar(255)'){
		    	// echo $row->Field.' - '.$row->Type.'<br>';
				$name_field = $row->Field;
				if (strpos($name_field, '-') == false) {
		    		// echo $row->Field.' - '.$row->Type.'<br>';
		    		// $this->db->query("ALTER TABLE tbl_perizinan MODIFY COLUMN $name_field TEXT");
					// $i++;
					// if($i>5) {
					// 	break;
					// }
				}
		    	// $this->db->query("ALTER TABLE tbl_perizinan MODIFY COLUMN $name_field TEXT");
			}
		}
	}
	public function testt(){
		// $this->db->query("ALTER TABLE tbl_perizinan MODIFY COLUMN ukuran_reklame TEXT");
		$q = $this->db->query('DESCRIBE tbl_perizinan')->result();
		$i = 1;
		foreach($q as $row) {
		    // echo "{$row['Field']} - {$row['Type']}\n";
			if($row->Type == 'varchar(255)'){
		    	// echo $row->Field.' - '.$row->Type.'<br>';
				$name_field = $row->Field;
				if (strpos($name_field, '-') == false) {
					echo $row->Field.' - '.$row->Type.'<br>';
		    		// $this->db->query("ALTER TABLE tbl_perizinan MODIFY COLUMN $name_field TEXT");
					// $i++;
					// if($i>5) {
					// 	break;
					// }
				}
		    	// $this->db->query("ALTER TABLE tbl_perizinan MODIFY COLUMN $name_field TEXT");
			}
		}

	}
	// public function get_exist_column(){
	// 	$field = $this->ref_surat_model->get_field_all();
	// 	foreach($field as $f){
	// 		echo '<option value="'.$f->id_field.'">'.$f->field_label.'</option>';
	// 	}
	// }
	public function json_input($id_field){
		$f = $this->ref_surat_model->get_field_single($id_field);
		if($f->r_value!==''&&$f->r_table!==''&&$f->r_label!==''){
			$r = ',"table":"'.$f->r_table.'","t_value":"'.$f->r_value.'","t_label":"'.$f->r_label.'"';
			$l = 'database';
		}else{
			$r = '';
			$l = 'costumize';
		}
		if($f->input_type=='select'||$f->input_type=='checkbox-group'||$f->input_type=='radio-group'){
			$option = $this->ref_surat_model->get_option($f->id_field);
			$op = '';
			$cc = count($option);
			$numm=1;
			foreach($option as $o){
				if($cc!==$numm){
					$commaa = ',';
				}else{
					$commaa = '';
				}
				$op .= '{"label":"'.$o->option_label.'","value":"'.$o->option_value.'"}'.$commaa.'';
				$numm++;
			}
			$opp = ',"values":['.$op.']';
		}else{
			$opp ='';
		}
		if($f->input_type=='checkbox-group'||$f->input_type=='radio-group'||$f->input_type=='header'){
			$class = '';
		}else{
			$class = $f->field_class;
		}

		$f->field_label = preg_replace("/[^ \w]+/", "", $f->field_label);
		$fields = '{"type":"'.$f->input_type.'","label":"'.$f->field_label.'","name":"'.$f->field_name.'","placeholder":"'.$f->field_placeholder.'","className":"'.$class.'","lookup":"'.$l.'","subtype":"'.$f->field_subtype.'"'.$r.$opp.'}';

		$b = $_POST['data'];
		$b = json_decode($b);
		$b = json_encode($b);
		$b = substr($b,1,-1);
		if(empty($b)){
			$coma = '';
		}else{
			$coma = ',';
		}
		$json_one =  '['.$b.$coma.$fields.']';
		echo $json_one;
			//    $a = $fields;
			// $b = $_POST['data'];
			// $b = json_decode($b);
			// $b = json_encode($b);
			// $data = "";
			// $data[] = json_decode($b);
			// $data[] = json_decode($a);
			// $merge_data = json_encode($data);
			// // echo $merge_data;
			// print_r($merge_data);
	}
	public function json_output($id){
		$field = $this->ref_surat_model->get_field($id);
		$fields = '';
		$c = count($field);
		$num=1;
		foreach($field as $f){
			if($c!==$num){
				$comma = ',';
			}else{
				$comma = '';
			}
			if($f->r_value!==''&&$f->r_table!==''&&$f->r_label!==''){
				$r = ',"table":"'.$f->r_table.'","t_value":"'.$f->r_value.'","t_label":"'.$f->r_label.'"';
				$l = 'database';
			}else{
				$r = '';
				$l = 'costumize';
			}
			if($f->input_type=='select'||$f->input_type=='checkbox-group'||$f->input_type=='radio-group'){
				$option = $this->ref_surat_model->get_option($f->id_field);
				$op = '';
				$cc = count($option);
				$numm=1;
				foreach($option as $o){
					if($cc!==$numm){
						$commaa = ',';
					}else{
						$commaa = '';
					}
					$op .= '{"label":"'.$o->option_label.'","value":"'.$o->option_value.'"}'.$commaa.'';
					$numm++;
				}
				$opp = ',"values":['.$op.']';
			}else{
				$opp ='';
			}
			if($f->input_type=='checkbox-group'||$f->input_type=='radio-group'||$f->input_type=='header'){
				$class = '';
			}else{
				$class = $f->field_class;
			}

			$f->field_label = preg_replace("/[^ \w]+/", "", $f->field_label);
			$fields .= '{"type":"'.$f->input_type.'","label":"'.$f->field_label.'","name":"'.$f->field_name.'","placeholder":"'.$f->field_placeholder.'","className":"'.$class.'","lookup":"'.$l.'","subtype":"'.$f->field_subtype.'"'.$r.$opp.'}'.$comma.'';
			$num++;
		}

		echo '['.$fields.']';
	}


}
?>