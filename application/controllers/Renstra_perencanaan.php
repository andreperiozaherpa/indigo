<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Renstra_perencanaan extends CI_Controller {
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
		$this->load->model('skpd_model');
			$this->load->model('ref_skpd_model');
			$this->load->model('renstra_perencanaan_model');
			$this->load->model('ref_unit_kerja_model');

		$this->level_id	= $this->user_model->level_id;
		if ($this->level_id >2 ) redirect("admin");
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
	public function index()
	{
		if ($this->user_id)
		{
			$data['title']		= "Renstra SKPD ";
			$data['content']	= "renstra/perencanaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "renstra_perencanaan";

			$this->load->model('ref_skpd_model');
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all());
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
			$data['list'] = $this->ref_skpd_model->get_page($mulai,$hal,$filter);

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function view($id_skpd,$apbd='')
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			if($apbd == "murni") {
				$data['content']	= "renstra/perencanaan/view_murni";
			} elseif($apbd == "perubahan") {
				$data['content']	= "renstra/perencanaan/view_perubahan";
			} else {
				$data['content']	= "renstra/perencanaan/view";
			}
			$data['apbd'] = ucwords($apbd);
			
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);

			$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_level($id_skpd,1);
			$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_skpd);
			$data['sasaran_strategis'] = $this->renstra_perencanaan_model->get_sasaran_strategis_by_id_skpd($id_skpd,$apbd);
			$data['iku_sasaran_strategis'] = array();
			$data['iku_sasaran_strategis_unit_kerja'] = array();
			$data['unit_kerja_ss'] = array();
			foreach ($data['sasaran_strategis'] as $key => $value) {
				$data['iku_sasaran_strategis'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_strategis_by_id_ss($value['id_sasaran_strategis_renstra']);
				foreach ($data['iku_sasaran_strategis'][$key] as $keys => $values) {
					$data['iku_sasaran_strategis_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ss_renstra($values['id_iku_ss_renstra']);
					foreach ($data['iku_sasaran_strategis_unit_kerja'][$key][$keys] as $row) {
						$data['unit_kerja_ss'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
					}
				}
			}
			$data['unit_kerja_ss'] = array_unique($data['unit_kerja_ss'], SORT_REGULAR);

			$data['sasaran_program'] = $this->renstra_perencanaan_model->get_sasaran_program_by_id_skpd($id_skpd,$apbd);
			$data['iku_sasaran_program'] = array();
			$data['iku_sasaran_program_unit_kerja'] = array();
			$data['unit_kerja_sp'] = array();
			foreach ($data['sasaran_program'] as $key => $value) {
				$data['iku_sasaran_program'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_program_by_id_sp($value['id_sasaran_program_renstra']);
				foreach ($data['iku_sasaran_program'][$key] as $keys => $values) {
					$data['iku_sasaran_program_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sp_renstra($values['id_iku_sp_renstra']);
					foreach ($data['iku_sasaran_program_unit_kerja'][$key][$keys] as $row) {
						$data['unit_kerja_sp'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
					}
				}
			}
			$data['unit_kerja_sp'] = array_unique($data['unit_kerja_sp'], SORT_REGULAR);

			$data['sasaran_kegiatan'] = $this->renstra_perencanaan_model->get_sasaran_kegiatan_by_id_skpd($id_skpd,$apbd);
			$data['iku_sasaran_kegiatan'] = array();
			$data['iku_sasaran_kegiatan_unit_kerja'] = array();
			$data['unit_kerja_sk'] = array();
			foreach ($data['sasaran_kegiatan'] as $key => $value) {
				$data['iku_sasaran_kegiatan'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_kegiatan_by_id_sk($value['id_sasaran_kegiatan_renstra']);
				foreach ($data['iku_sasaran_kegiatan'][$key] as $keys => $values) {
					$data['iku_sasaran_kegiatan_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sk_renstra($values['id_iku_sk_renstra']);
					foreach ($data['iku_sasaran_kegiatan_unit_kerja'][$key][$keys] as $row) {
						$data['unit_kerja_sk'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
					}
				}
			}
			$data['unit_kerja_sk'] = array_unique($data['unit_kerja_sk'], SORT_REGULAR);

			$data['sasaran_subkegiatan'] = $this->renstra_perencanaan_model->get_sasaran_subkegiatan_by_id_skpd($id_skpd,$apbd);
			$data['iku_sasaran_subkegiatan'] = array();
			$data['iku_sasaran_subkegiatan_unit_kerja'] = array();
			// $data['unit_kerja_sk'] = array();
			foreach ($data['sasaran_subkegiatan'] as $key => $value) {
				$data['iku_sasaran_subkegiatan'][$key] = $this->renstra_perencanaan_model->get_iku_sasaran_subkegiatan_by_id_ssk($value['id_sasaran_subkegiatan_renstra']);
				foreach ($data['iku_sasaran_subkegiatan'][$key] as $keys => $values) {
					$data['iku_sasaran_subkegiatan_unit_kerja'][$key][$keys] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ssk_renstra($values['id_iku_ssk_renstra']);
					// foreach ($data['iku_sasaran_kegiatan_unit_kerja'][$key][$keys] as $row) {
					// 	$data['unit_kerja_sk'][] = array('id_unit_kerja' => $row['id_unit_kerja'], 'nama_unit_kerja' => $row['nama_unit_kerja'] );
					// }
				}
			}
			// $data['unit_kerja_sk'] = array_unique($data['unit_kerja_sk'], SORT_REGULAR);

			$this->load->model('ref_satuan_model');
			$data['ref_satuan'] = $this->ref_satuan_model->get_all();

			$this->load->model('ref_visi_misi_model');
			$data['misi'] = $this->ref_visi_misi_model->get_all_m();
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	function get_iku_ss_by_unit_kerja($id=null,$apbd="Murni")
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$apbd = $id;
			$id = $this->input->get('id_unit_kerja');
		}
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_ss_renstra'] = $this->renstra_perencanaan_model->get_iku_ss_by_unit_kerja($id,$apbd);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_ss_renstra'] as $key) {
			echo "<option value='{$key->id_iku_ss_renstra}'>{$key->iku_ss_renstra}</option>";
		}
	}

	function get_iku_sp_by_unit_kerja($id=null,$apbd="Murni")
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$apbd = $id;
			$id = $this->input->get('id_unit_kerja');
		}
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_sp_renstra'] = $this->renstra_perencanaan_model->get_iku_sp_by_unit_kerja($id,$apbd);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_sp_renstra'] as $key) {
			echo "<option value='{$key->id_iku_sp_renstra}'>{$key->iku_sp_renstra}</option>";
		}
	}

	function get_iku_sk_by_unit_kerja($id=null,$apbd="Murni")
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$apbd = $id;
			$id = $this->input->get('id_unit_kerja');
		}
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_sk_renstra'] = $this->renstra_perencanaan_model->get_iku_sk_by_unit_kerja($id,$apbd);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_sk_renstra'] as $key) {
			echo "<option value='{$key->id_iku_sk_renstra}'>{$key->iku_sk_renstra}</option>";
		}
	}

	function get_iku_ssk_by_unit_kerja($id=null,$apbd="Murni")
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$apbd = $id;
			$id = $this->input->get('id_unit_kerja');
		}
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_ssk_renstra'] = $this->renstra_perencanaan_model->get_iku_ssk_by_unit_kerja($id,$apbd);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_ssk_renstra'] as $key) {
			echo "<option value='{$key->id_iku_ssk_renstra}'>{$key->iku_ssk_renstra}</option>";
		}
	}

	function get_sipd_program_by_sasaran($id=null)
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$id = $this->input->get('id_sasaran');
		}
		if($id==null){
			$id = $this->input->get('id_sasaran');
		}
		$data['sipd_program'] = $this->renstra_perencanaan_model->get_sipd_program_by_sasaran($id);
		echo '<option value="">Pilih Program</option>';
		foreach ($data['sipd_program'] as $key) {
			echo "<option value='{$key->kode_program}'>{$key->nama_program}</option>";
		}
	}

	function get_sipd_kegiatan_by_sasaran($id=null)
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$id = $this->input->get('id_sasaran');
		}
		if($id==null){
			$id = $this->input->get('id_sasaran');
		}
		$data['sipd_kegiatan'] = $this->renstra_perencanaan_model->get_sipd_kegiatan_by_sasaran($id);
		echo '<option value="">Pilih Kegiatan</option>';
		foreach ($data['sipd_kegiatan'] as $key) {
			echo "<option value='{$key->kode_kegiatan}'>{$key->nama_kegiatan}</option>";
		}
	}

	function get_sipd_subkegiatan_by_sasaran($id=null)
	{
		if($id == "Murni" OR $id == "Perubahan"){
			$id = $this->input->get('id_sasaran');
		}
		if($id==null){
			$id = $this->input->get('id_sasaran');
		}
		$data['sipd_subkegiatan'] = $this->renstra_perencanaan_model->get_sipd_subkegiatan_by_sasaran($id);
		echo '<option value="">Pilih Sub Kegiatan</option>';
		foreach ($data['sipd_subkegiatan'] as $key) {
			echo "<option value='{$key->kode_sub_kegiatan}'>{$key->nama_sub_kegiatan}</option>";
		}
	}

	public function detail($jenis_s,$id_ss,$id_iku,$testing="")
	{
		if ($this->user_id)
		{
			$data['title']		= "detail Renstra - Admin ";
			$data['content']	= "renstra/perencanaan/detail" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";


			$this->load->model('renstra_perencanaan_model');
			switch ($jenis_s) {
				case 'ss':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_strategis_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ss_renstra($id_iku);
					break;

				case 'sp':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_program_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sp_renstra($id_iku);
					break;

				case 'sk':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_kegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sk_renstra($id_iku);
					break;

				case 'ssk':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_subkegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ssk_renstra($id_iku);
					break;
				
				default:
					redirect('renstra_perencanaan');
					break;
			}

			$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($data['detail']->id_skpd);

			$data['detail_skpd'] = $this->ref_skpd_model->get_by_id($data['detail']->id_skpd);
		
			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}

	public function edit($jenis_s,$id_ss,$id_iku)
	{
		if ($this->user_id)
		{
			$data['title']		= "edit Renstra - Admin ";
			$data['content']	= "renstra/perencanaan/edit" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "ref_skpd";

			$this->load->model('renstra_perencanaan_model');
			switch ($jenis_s) {
				case 'ss':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_strategis_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ss_renstra($id_iku);
					$data['list_sasaran'] = $this->renstra_perencanaan_model->get_sasaran_strategis_by_id_skpd($data['detail']->id_skpd,$data['detail']->apbd);
					break;

				case 'sp':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_program_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sp_renstra($id_iku);
					$data['list_sasaran'] = $this->renstra_perencanaan_model->get_sasaran_program_by_id_skpd($data['detail']->id_skpd,$data['detail']->apbd);
					break;

				case 'sk':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_kegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_sk_renstra($id_iku);
					$data['list_sasaran'] = $this->renstra_perencanaan_model->get_sasaran_kegiatan_by_id_skpd($data['detail']->id_skpd,$data['detail']->apbd);
					break;

				case 'ssk':
					$data['detail'] = $this->renstra_perencanaan_model->get_iku_sasaran_subkegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->renstra_perencanaan_model->get_casecade_unit_kerja_iku_ssk_renstra($id_iku);
					$data['list_sasaran'] = $this->renstra_perencanaan_model->get_sasaran_subkegiatan_by_id_skpd($data['detail']->id_skpd,$data['detail']->apbd);
					break;
				
				default:
					redirect('renstra_perencanaan');
					break;
			}
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_level($data['detail']->id_skpd,1);
			$data['perencanaan'] = $this->renstra_perencanaan_model->get_perencanaan_by_id_skpd($id_iku);
			$this->load->model('ref_satuan_model');
			$data['ref_satuan'] = $this->ref_satuan_model->get_all();


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function add_sasaran_strategis_renstra($id_skpd,$apbd="Murni")
	{
		if (!$this->input->post('sasaran_strategis_renstra') OR ($apbd=="murni" AND !$this->input->post('id_iku_sasaran_rpjmd')) OR ($apbd=="perubahan" AND !$this->input->post('nama_tujuan_skpd'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_tujuan'] = '';
			$data['id_skpd'] = $id_skpd;
			$data['apbd'] = $apbd;
			$query = $this->renstra_perencanaan_model->insert_sasaran_strategis_renstra($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function update_sasaran_strategis_renstra($id)
	{
		if (!$this->input->post('sasaran_strategis_renstra') OR !$this->input->post('id_iku_sasaran_rpjmd')) {
			echo FALSE;
		} else {
			$data = $_POST;
			$query = $this->renstra_perencanaan_model->update_sasaran_strategis_renstra($data,$id);
			if ($query) {
				echo TRUE;
			}
		}
	}

	
	public function add_indikator_sasaran_strategis($id_skpd)
	{
		if (!$this->input->post('id_sasaran_strategis_renstra') OR !$this->input->post('iku_ss_renstra') /*OR ($this->input->post('target_2019')=="") OR ($this->input->post('target_2020')=="") OR ($this->input->post('target_2021')=="") OR ($this->input->post('target_2022')=="") OR ($this->input->post('target_2023')=="")*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_indikator_sasaran_strategis($data);
			if ($query) {
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_ss_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}


	public function update_indikator_sasaran_strategis($id_iku)
	{
		if (!$this->input->post('iku_ss_renstra') /*OR ($this->input->post('target_2019')=="") OR ($this->input->post('target_2020')=="") OR ($this->input->post('target_2021')=="") OR ($this->input->post('target_2022')=="") OR ($this->input->post('target_2023')=="")*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			unset($data['id_sasaran_strategis_renstra']);
			$query = $this->renstra_perencanaan_model->update_indikator_sasaran_strategis($data,$id_iku);
			if ($query) {
				$this->renstra_perencanaan_model->delete_casecade_unit_kerja_iku_ss_renstra($query);
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_ss_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}

	public function lakukan_pembobotan_ss($id_skpd)
	{
		if (!$this->input->post('bobot')) {
			echo FALSE;
		} elseif (array_sum($this->input->post('bobot')) != '100') {
			echo "nothing";
		} else {
			$data = $_POST;
			foreach ($data['bobot'] as $key => $value) {
				$query = $this->renstra_perencanaan_model->update_bobot_iku_ss($key,$value);
			}
			if ($query) {
				echo TRUE;
			}
		}
	}


	public function hapus_ss($home,$id)
	{
		if ($this->user_id)
		{
			$this->renstra_perencanaan_model->id_sasaran_strategis_renstra = $id;
			$this->renstra_perencanaan_model->hapus_ss();
			$home = $this->uri->segment(3);
			redirect('renstra_perencanaan/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_strategis_renstra($id){
		$get =  $this->renstra_perencanaan_model->get_sasaran_strategis_by_id($id);
		echo json_encode($get);
	}


	public function add_sasaran_program_renstra($id_skpd,$apbd="Murni")
	{
		if (!$this->input->post('sasaran_program_renstra') OR !$this->input->post('id_iku_ss_renstra') OR empty($this->input->post('id_unit_kerja'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$data['apbd'] = $apbd;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_sasaran_program_renstra($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function update_sasaran_program_renstra($id)
	{
		if (!$this->input->post('sasaran_program_renstra') OR !$this->input->post('id_iku_ss_renstra') OR !$this->input->post('id_unit_kerja')) {
			echo FALSE;
		} else {
			$data = $_POST;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->update_sasaran_program_renstra($data,$id);
			if ($query) {
				echo TRUE;
			}
		}
	}
	public function add_indikator_sasaran_program($id_skpd)
	{
		if (!$this->input->post('id_sasaran_program_renstra') OR !$this->input->post('iku_sp_renstra') /*OR ($this->input->post('target_2019')=="") OR ($this->input->post('target_2020')=="") OR ($this->input->post('target_2021')=="") OR ($this->input->post('target_2022')=="") OR ($this->input->post('target_2023')=="")*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_indikator_sasaran_program($data);
			if ($query) {
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sp_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}

	public function update_indikator_sasaran_program($id_iku)
	{
		if (!$this->input->post('iku_sp_renstra') /*OR ($this->input->post('target_2019')=="") OR ($this->input->post('target_2020')=="") OR ($this->input->post('target_2021')=="") OR ($this->input->post('target_2022')=="") OR ($this->input->post('target_2023')=="")*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			unset($data['id_sasaran_program_renstra']);
			$query = $this->renstra_perencanaan_model->update_indikator_sasaran_program($data,$id_iku);
			if ($query) {
				$this->renstra_perencanaan_model->delete_casecade_unit_kerja_iku_sp_renstra($query);
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sp_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}

	public function lakukan_pembobotan_sp($id_skpd)
	{
		if (!$this->input->post('bobot')) {
			echo FALSE;
		} elseif (array_sum($this->input->post('bobot')) != '100') {
			echo "nothing";
		} else {
			$data = $_POST;
			foreach ($data['bobot'] as $key => $value) {
				$query = $this->renstra_perencanaan_model->update_bobot_iku_sp($key,$value);
			}
			if ($query) {
				echo TRUE;
			}
		}
	}



	function get_tujuan_by_misi($id_misi=null)
	{
		if($id_misi==null){
			$id_misi = $this->input->get('id_misi');
		}
		$this->load->model('ref_visi_misi_model');
		$data['tujuan'] = $this->ref_visi_misi_model->get_all_t_by_id_m($id_misi);
		echo '<option value="">Pilih Tujuan</option>';
		foreach ($data['tujuan'] as $key) {
			echo "<option value='{$key->id_tujuan}'>{$key->tujuan}</option>";
		}
	}

	public function hapus_sp($home,$id)
	{
		if ($this->user_id)
		{
			$this->renstra_perencanaan_model->id_sasaran_program_renstra = $id;
			$this->renstra_perencanaan_model->hapus_sp();
			// $home = $this->uri->segment(3);
			redirect('renstra_perencanaan/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_program_renstra($id){
		$get =  $this->renstra_perencanaan_model->get_sasaran_program_by_id($id);
		echo json_encode($get);
	}


	public function add_sasaran_kegiatan_renstra($id_skpd,$apbd="Murni")
	{
		if (!$this->input->post('sasaran_kegiatan_renstra') OR !$this->input->post('id_iku_sp_renstra') OR empty($this->input->post('id_unit_kerja'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$data['apbd'] = $apbd;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_sasaran_kegiatan_renstra($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function update_sasaran_kegiatan_renstra($id)
	{
		if (!$this->input->post('sasaran_kegiatan_renstra') OR !$this->input->post('id_iku_sp_renstra') OR !$this->input->post('id_unit_kerja')) {
			echo FALSE;
		} else {
			$data = $_POST;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->update_sasaran_kegiatan_renstra($data,$id);
			if ($query) {
				echo TRUE;
			}
		}
	}


	public function add_indikator_sasaran_kegiatan($id_skpd)
	{
		if (!$this->input->post('id_sasaran_kegiatan_renstra') OR !$this->input->post('iku_sk_renstra') /*OR !$this->input->post('anggaran_sk_renstra') OR !$this->input->post('target_2019') OR !$this->input->post('target_2020') OR !$this->input->post('target_2021') OR !$this->input->post('target_2022') OR !$this->input->post('target_2023')*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_indikator_sasaran_kegiatan($data);
			if ($query) {
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}

	public function update_indikator_sasaran_kegiatan($id_iku)
	{
		if (!$this->input->post('iku_sk_renstra') /*OR !$this->input->post('target_2019') OR !$this->input->post('target_2020') OR !$this->input->post('target_2021') OR !$this->input->post('target_2022') OR !$this->input->post('target_2023')*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			$casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			unset($data['id_sasaran_kegiatan_renstra']);
			$query = $this->renstra_perencanaan_model->update_indikator_sasaran_kegiatan($data,$id_iku);
			if ($query) {
				$this->renstra_perencanaan_model->delete_casecade_unit_kerja_iku_sk_renstra($query);
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				}
				echo TRUE;
			}
		}
	}

	public function lakukan_pembobotan_sk($id_skpd)
	{
		if (!$this->input->post('bobot')) {
			echo FALSE;
		} elseif (array_sum($this->input->post('bobot')) != '100') {
			echo "nothing";
		} else {
			$data = $_POST;
			foreach ($data['bobot'] as $key => $value) {
				$query = $this->renstra_perencanaan_model->update_bobot_iku_sk($key,$value);
			}
			if ($query) {
				echo TRUE;
			}
		}
	}


	public function hapus_sk($home,$id)
	{
		if ($this->user_id)
		{
			$this->renstra_perencanaan_model->id_sasaran_kegiatan_renstra = $id;
			$this->renstra_perencanaan_model->hapus_sk();
			// $home = $this->uri->segment(3);
			redirect('renstra_perencanaan/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_kegiatan_renstra($id){
		$get =  $this->renstra_perencanaan_model->get_sasaran_kegiatan_by_id($id);
		echo json_encode($get);
	}



	public function add_sasaran_subkegiatan_renstra($id_skpd,$apbd="Murni")
	{
		if (!$this->input->post('sasaran_subkegiatan_renstra') OR !$this->input->post('id_iku_sk_renstra') OR empty($this->input->post('id_unit_kerja'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			$data['apbd'] = $apbd;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_sasaran_subkegiatan_renstra($data);
			if ($query) {
				echo TRUE;
			}
		}
	}

	public function update_sasaran_subkegiatan_renstra($id)
	{
		if (!$this->input->post('sasaran_subkegiatan_renstra') OR !$this->input->post('id_iku_sk_renstra') OR !$this->input->post('id_unit_kerja')) {
			echo FALSE;
		} else {
			$data = $_POST;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->renstra_perencanaan_model->update_sasaran_subkegiatan_renstra($data,$id);
			if ($query) {
				echo TRUE;
			}
		}
	}


	public function add_indikator_sasaran_subkegiatan($id_skpd)
	{
		if (!$this->input->post('id_sasaran_subkegiatan_renstra') OR !$this->input->post('iku_ssk_renstra') /*OR !$this->input->post('anggaran_sk_renstra') OR !$this->input->post('target_2019') OR !$this->input->post('target_2020') OR !$this->input->post('target_2021') OR !$this->input->post('target_2022') OR !$this->input->post('target_2023')*/) {
			echo FALSE;
		} else {

			for($tahun=2019;$tahun<=2023;$tahun++){
				$_POST['anggaran_'.$tahun] = str_replace('.', "", $_POST['anggaran_'.$tahun]);
				$_POST['anggaran_'.$tahun] = str_replace(',', "", $_POST['anggaran_'.$tahun]);
			}

			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			// $casecade_unit_kerja = (isset($data['casecade_unit_kerja'])) ? $data['casecade_unit_kerja'] : array() ;
			unset($data['casecade_unit_kerja']);
			$query = $this->renstra_perencanaan_model->insert_indikator_sasaran_subkegiatan($data);
			if ($query) {
				// foreach ($casecade_unit_kerja as $id_unit_kerja) {
				// 	$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				// }
				echo TRUE;
			}
		}
	}

	public function update_indikator_sasaran_subkegiatan($id_iku)
	{
		if (!$this->input->post('iku_ssk_renstra') /*OR !$this->input->post('target_2019') OR !$this->input->post('target_2020') OR !$this->input->post('target_2021') OR !$this->input->post('target_2022') OR !$this->input->post('target_2023')*/) {
			echo FALSE;
		} else {
			$data = $_POST;
			// $casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			unset($data['id_sasaran_subkegiatan_renstra']);
			$query = $this->renstra_perencanaan_model->update_indikator_sasaran_subkegiatan($data,$id_iku);
			if ($query) {
				// $this->renstra_perencanaan_model->delete_casecade_unit_kerja_iku_sk_renstra($query);
				// foreach ($casecade_unit_kerja as $id_unit_kerja) {
				// 	$query2 = $this->renstra_perencanaan_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				// }
				echo TRUE;
			}
		}
	}

	public function lakukan_pembobotan_ssk($id_skpd)
	{
		if (!$this->input->post('bobot')) {
			echo FALSE;
		} elseif (array_sum($this->input->post('bobot')) != '100') {
			echo "nothing";
		} else {
			$data = $_POST;
			foreach ($data['bobot'] as $key => $value) {
				$query = $this->renstra_perencanaan_model->update_bobot_iku_ssk($key,$value);
			}
			if ($query) {
				echo TRUE;
			}
		}
	}


	public function hapus_ssk($home,$id)
	{
		if ($this->user_id)
		{
			$this->renstra_perencanaan_model->id_sasaran_subkegiatan_renstra = $id;
			$this->renstra_perencanaan_model->hapus_ssk();
			// $home = $this->uri->segment(3);
			redirect('renstra_perencanaan/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_subkegiatan_renstra($id){
		$get =  $this->renstra_perencanaan_model->get_sasaran_subkegiatan_by_id($id);
		echo json_encode($get);
	}

	public function hapus_iku($jenis_s,$home,$id_iku)
	{
		if ($this->user_id)
		{
			switch ($jenis_s) {
				case 'ss':
					$this->renstra_perencanaan_model->id_iku_ss_renstra = $id_iku;
					$this->renstra_perencanaan_model->hapus_iku_ss();
					break;
				case 'sp':
					$this->renstra_perencanaan_model->id_iku_sp_renstra = $id_iku;
					$this->renstra_perencanaan_model->hapus_iku_sp();
					break;
				case 'sk':
					$this->renstra_perencanaan_model->id_iku_sk_renstra = $id_iku;
					$this->renstra_perencanaan_model->hapus_iku_sk();
					break;
				case 'ssk':
					$this->renstra_perencanaan_model->id_iku_ssk_renstra = $id_iku;
					$this->renstra_perencanaan_model->hapus_iku_ssk();
					break;
				
				default:
					# code...
					break;
			}			// $home = $this->uri->segment(3);
			redirect('renstra_perencanaan/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}

	


}
