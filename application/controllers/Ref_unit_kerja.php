<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_unit_kerja extends CI_Controller {
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
		$array_privileges = explode(';', $this->user_privileges);
		$this->load->model('ref_unit_kerja_model');
		
		// $this->level_id	= $this->user_model->level_id;
		// if ($this->level_id >2 ) redirect("admin");

			if (($this->user_level!="Administrator" && $this->user_level!="User") && !in_array('unit_kerja', $array_privileges)) redirect ('welcome');
	}
	public function get_induk()
	{
		$obj = "";
		if (!empty($_POST['id_induk'])){
			$id_induk = $_POST['id_induk']==9999 ? 0 : $_POST['id_induk'];
			$data = $this->ref_unit_kerja_model->get_induk($id_induk);
			if (!empty($data)) $obj = "<option value='' selected>Pilih</option>";
			foreach($data as $row){
				$obj .="<option value=".$row->id_unit_kerja.">".$row->nama_unit_kerja."</option>";
			}
		}
		die ($obj);
	}
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Unit Kerja - Admin ";
			$data['content']	= "ref_unit_kerja/index" ;
			$data['active_menu']	= "ref_unit_kerja" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['action']		= (!empty($_GET['action'])) ? $_GET['action'] : "Tambah";
			if (!empty($_POST)){
					if ( $data['action']=="Tambah" && $_POST['level_unit_kerja']!=0){
						$unit_kerja_level = "unit_kerja_level".($_POST['level_unit_kerja']-1);
						$id_induk = $_POST[$unit_kerja_level];
					}
					else{
						$id_induk="";
					}
				if ($_POST['nama_unit_kerja']==""
					|| ($data['action']=="Tambah" && $_POST['level_unit_kerja']=="")
					|| ($data['action']=="Tambah" && $_POST['level_unit_kerja']!="0" && $id_induk=="") 
				)
				{
					$data['pesan'] = "Data belum lengkap.";
					$data['error'] = true;
					$data['nama_unit_kerja'] = $_POST['nama_unit_kerja'];
					if ($data['action']=="Tambah"){
						$data['level_unit_kerja'] = $_POST['level_unit_kerja'];
					}
					// $data['telp'] = $_POST['telp'];
					// $data['email'] = $_POST['email'];
					// $data['alamat'] = $_POST['alamat'];
					$data['set_renstra'] = $_POST['set_renstra'];
					$data['set_rkt'] = $_POST['set_rkt'];
					$data['set_pk'] = $_POST['set_pk'];
					$data['set_lkj'] = $_POST['set_lkj'];
					if ($data['action']=="Tambah"){
						$data['unit_kerja_level']=array();
						for ($i=0;$i<=4;$i++)
						{					
							$unit_kerja_level = "unit_kerja_level".$i;
							$this->ref_unit_kerja_model->id_unit_kerja = $_POST[$unit_kerja_level];
							$this->ref_unit_kerja_model->set_by_id();
							$data['unit_kerja_level'][$i] = $_POST[$unit_kerja_level] . '-' . $this->ref_unit_kerja_model->nama_unit_kerja;
							
						}
					}
				}
				else{
					$this->ref_unit_kerja_model->nama_unit_kerja = $_POST['nama_unit_kerja'];
					if ($data['action']=="Tambah"){
						$this->ref_unit_kerja_model->level_unit_kerja = $_POST['level_unit_kerja'];
						$this->ref_unit_kerja_model->id_induk = $id_induk;
					}
					// $this->ref_unit_kerja_model->telp = $_POST['telp'];
					// $this->ref_unit_kerja_model->email = $_POST['email'];
					// $this->ref_unit_kerja_model->alamat = $_POST['alamat'];
					$this->ref_unit_kerja_model->set_renstra = $_POST['set_renstra'];
					$this->ref_unit_kerja_model->set_rkt = $_POST['set_rkt'];
					$this->ref_unit_kerja_model->set_pk = $_POST['set_pk'];
					$this->ref_unit_kerja_model->set_lkj = $_POST['set_lkj'];
					if ($data['action']=="Tambah"){
						$cek = true; //$this->ref_unit_kerja_model->cek_unit_kerja($_POST['id_unit_kerja']);
						if ($cek){
							$this->ref_unit_kerja_model->insert();
							$this->update_kode($_POST['level_unit_kerja']);
							$data['pesan'] = "Tambah data berhasil.";
						}
						else{
							$data['error'] = true;
							$data['pesan'] = "Kode unit kerja telah digunakan.";
							$data['nama_unit_kerja'] = $_POST['nama_unit_kerja'];
							if ($data['action']=="Tambah"){
								$data['level_unit_kerja'] = $_POST['level_unit_kerja'];
							}
							// $data['telp'] = $_POST['telp'];
							// $data['alamat'] = $_POST['alamat'];
							$data['set_renstra'] = $_POST['set_renstra'];
							$data['set_rkt'] = $_POST['set_rkt'];
							$data['set_pk'] = $_POST['set_pk'];
							$data['set_lkj'] = $_POST['set_lkj'];
							if ($data['action']=="Tambah"){
								$data['unit_kerja_level']=array();
								for ($i=0;$i<=4;$i++)
								{					
									$unit_kerja_level = "unit_kerja_level".$i;
									$this->ref_unit_kerja_model->id_unit_kerja = $_POST[$unit_kerja_level];
									$this->ref_unit_kerja_model->set_by_id();
									$data['unit_kerja_level'][$i] = $_POST[$unit_kerja_level] . '-' . $this->ref_unit_kerja_model->nama_unit_kerja;
									
								}
							}
						}
					}
					else{
						if (!empty($_GET['id']) && $_GET['id']>0){
							$this->ref_unit_kerja_model->id_unit_kerja=$_GET['id'];
							$this->ref_unit_kerja_model->update();
							$data['pesan'] = "Update data berhasil.";
						}
					}
				}
				
			}
			
			if ($data['action']=="Edit"){
				if (!empty($_GET['id']) && $_GET['id']>0){
					$this->ref_unit_kerja_model->id_unit_kerja=$_GET['id'];
					$this->ref_unit_kerja_model->set_by_id();
					$data['nama_unit_kerja'] = $this->ref_unit_kerja_model->nama_unit_kerja;
					$data['level_unit_kerja'] = $this->ref_unit_kerja_model->level_unit_kerja;
					// $data['telp'] = $this->ref_unit_kerja_model->telp;
					// $data['email'] = $this->ref_unit_kerja_model->email;
					// $data['alamat'] = $this->ref_unit_kerja_model->alamat;
					$data['set_renstra'] = $this->ref_unit_kerja_model->set_renstra;
					$data['set_rkt'] = $this->ref_unit_kerja_model->set_rkt;
					$data['set_pk'] = $this->ref_unit_kerja_model->set_pk;
					$data['set_lkj'] = $this->ref_unit_kerja_model->set_lkj;
				}
			}
			
			$offset = 0;
			if (!empty($_GET['per_page'])) $offset = $_GET['per_page'] ;
			$data['result'] = $this->ref_unit_kerja_model->get_all_ref(1);
			$data['per_page']	= 20;
			$data['total_rows']	= count($data['result']);
			$data['offset']	= $offset;
			
					
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}
	public function view($id)
	{
		if ($this->user_id)
		{
			
			$data['title']		= "Unit Kerja - Admin ";
			$data['content']	= "ref_unit_kerja/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['active_menu']	= "ref_unit_kerja" ;
			$data['user_level']		= $this->user_level;
			if (!empty($_POST) && $id!="" && $id>0){
				$this->ref_unit_kerja_model->id_unit_kerja = $id;
				$this->ref_unit_kerja_model->status = $_POST['status'];
				$this->ref_unit_kerja_model->ubah_status();
			}
				if ($id!="" && $id>0){
					$this->ref_unit_kerja_model->id_unit_kerja=$id;
					$this->ref_unit_kerja_model->set_by_id();
					$data['id_unit_kerja'] = $id;
					$data['nama_unit_kerja'] = $this->ref_unit_kerja_model->nama_unit_kerja;
					$data['level_unit_kerja'] = $this->ref_unit_kerja_model->level_unit_kerja;
					// $data['telp'] = $this->ref_unit_kerja_model->telp;
					// $data['email'] = $this->ref_unit_kerja_model->email;
					// $data['alamat'] = $this->ref_unit_kerja_model->alamat;
					$data['set_renstra'] = $this->ref_unit_kerja_model->set_renstra;
					$data['set_rkt'] = $this->ref_unit_kerja_model->set_rkt;
					$data['set_pk'] = $this->ref_unit_kerja_model->set_pk;
					$data['set_lkj'] = $this->ref_unit_kerja_model->set_lkj;
					$data['status'] = $this->ref_unit_kerja_model->status;
					if ($data['level_unit_kerja']>0) { 
						$key_induk = explode('|', $this->ref_unit_kerja_model->ket_induk);
						for ($i=0; $i < $data['level_unit_kerja']; $i++) { 
							$key = $i+1;
							$data['data_unit_kerja'][$i] = $this->ref_unit_kerja_model->get_result_by_id($key_induk[$key]);
						}
					}
				}
			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function update_kode($level)
	{
		$updated = 0;
		if ($level=="all") {
			for ($i=0; $i <= 4; $i++) { 
				$get = $this->ref_unit_kerja_model->get_all_level($i);
				$updated += $this->generate_kode($get);
			}
		} elseif ($level>=0) {
			$get = $this->ref_unit_kerja_model->get_all_level($level);
			$updated += $this->generate_kode($get);
		}

		//echo "Success! {$updated} data has been updated.";
		
	}

	public function generate_kode($get)
	{
		$updated = 0;
		foreach ($get as $row) {
			if (empty($row->kode_unit_kerja)) {
				for ($i=1; $i <= count($get); $i++) { 
					if ($row->level_unit_kerja == 0) {
						$kode = $i;
					} elseif ($row->level_unit_kerja > 0) {
						$parent = $this->ref_unit_kerja_model->get_by_id($row->id_induk);
						if ($row->level_unit_kerja > 2) {
							$kode = $parent->kode_unit_kerja.str_pad($i, 2, '0', STR_PAD_LEFT);
						} else {
							$kode = $parent->kode_unit_kerja.$i;
						}
					}

					if ($kode) {
						$cek = $this->ref_unit_kerja_model->get_by_kode($kode);
						if (count($cek)==0) {
							$update = $this->ref_unit_kerja_model->update_kode($row->id_unit_kerja, $kode);
							$updated++;
							break;
						}
					}
				}
			}
		}
		return $updated;
	}

	public function delete_duplicate(){
		$uk = $this->db->get_where('ref_unit_kerja2',array('id_induk !=' =>0))->result();
		foreach($uk as $u){
			echo $u->nama_unit_kerja." - ";
			$id_induk = $u->id_induk;
			$cek = $this->db->get_where('ref_unit_kerja2',array('id_unit_kerja'=>$id_induk))->num_rows();
			if($cek==0){
				echo "Induk Tidak Ditemukan";
				$this->db->delete('ref_unit_kerja2',array('id_unit_kerja'=>$u->id_unit_kerja));
			}else{
				echo "Induk Ditemukan";
			}
			echo "<br>";
		}
	}

	
}
?>