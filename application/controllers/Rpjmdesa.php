<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rpjmdesa extends CI_Controller {
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
			$this->load->model('rpjmdesa_model');
			$this->load->model('ref_unit_kerja_model');

		$this->level_id	= $this->user_model->level_id;

		$this->sasaran = json_decode(json_encode(array(
			array('nama_sasaran'=>'Menurunnya Jumlah Rumah Tangga Miskin','indikator'=>array(array('nama_indikator'=>'Jumlah Rumah Tangga Miskin (Desil 1 dan Desil 2)','satuan'=>'KK'))),
			array('nama_sasaran'=>'Meningkatnya pencegahan Stunting Terintegrasi','indikator'=>array(array('nama_indikator'=>'Cakupan layanan konvergensi stunting ','satuan'=>'%'))),
			array('nama_sasaran'=>'Meningkatnya kualitas pelayanan publik di Desa','indikator'=>array(array('nama_indikator'=>'Indeks Kepuasan Masyarakat','satuan'=>'Point')))
		)));
		

		if ($this->level_id >2 ) redirect("admin");
	}
	public function perencanaan()
	{
		if ($this->user_id)
		{
			$data['title']		= "RPJM Desa ";
			$data['content']	= "rpjmdesa/perencanaan/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rpjmdesa/perencanaan";

			$this->load->model('ref_skpd_model');
			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = count($this->ref_skpd_model->get_all('desa',true));
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
			$data['list'] = $this->ref_skpd_model->get_page($mulai,$hal,$filter,'desa');

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}


	public function perencanaan_view($id_skpd)
	{
		if ($this->user_id)
		{
			$data['title']		= "Detail Rencana Strategis SKPD";
			$data['content']	= "rpjmdesa/perencanaan/view" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			$data['active_menu'] = "rpjmdesa/perencanaan";
			$data['sasaran'] = $this->sasaran;
			$this->load->view('admin/index',$data);
		}
		else
		{
			redirect('admin');
		}
	}

	function get_iku_ss_by_unit_kerja($id=null)
	{
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_ss_renstra'] = $this->rpjmdesa_model->get_iku_ss_by_unit_kerja($id);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_ss_renstra'] as $key) {
			echo "<option value='{$key->id_iku_ss_renstra}'>{$key->iku_ss_renstra}</option>";
		}
	}

	function get_iku_sp_by_unit_kerja($id=null)
	{
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_sp_renstra'] = $this->rpjmdesa_model->get_iku_sp_by_unit_kerja($id);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_sp_renstra'] as $key) {
			echo "<option value='{$key->id_iku_sp_renstra}'>{$key->iku_sp_renstra}</option>";
		}
	}

	function get_iku_sk_by_unit_kerja($id=null)
	{
		if($id==null){
			$id = $this->input->get('id_unit_kerja');
		}
		$data['iku_sk_renstra'] = $this->rpjmdesa_model->get_iku_sk_by_unit_kerja($id);
		echo '<option value="">Pilih Sasaran</option>';
		foreach ($data['iku_sk_renstra'] as $key) {
			echo "<option value='{$key->id_iku_sk_renstra}'>{$key->iku_sk_renstra}</option>";
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


			$this->load->model('rpjmdesa_model');
			switch ($jenis_s) {
				case 'ss':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_strategis_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_ss_renstra($id_iku);
					break;

				case 'sp':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_program_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_sp_renstra($id_iku);
					break;

				case 'sk':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_kegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_sk_renstra($id_iku);
					break;
				
				default:
					redirect('rpjmdesa');
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

			$this->load->model('rpjmdesa_model');
			switch ($jenis_s) {
				case 'ss':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_strategis_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_ss_renstra($id_iku);
					$data['list_sasaran'] = $this->rpjmdesa_model->get_sasaran_strategis_by_id_skpd($data['detail']->id_skpd);
					break;

				case 'sp':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_program_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_sp_renstra($id_iku);
					$data['list_sasaran'] = $this->rpjmdesa_model->get_sasaran_program_by_id_skpd($data['detail']->id_skpd);
					break;

				case 'sk':
					$data['detail'] = $this->rpjmdesa_model->get_iku_sasaran_kegiatan_by_id_iku($id_iku);
					$data['iku_unit_kerja'] = $this->rpjmdesa_model->get_casecade_unit_kerja_iku_sk_renstra($id_iku);
					$data['list_sasaran'] = $this->rpjmdesa_model->get_sasaran_kegiatan_by_id_skpd($data['detail']->id_skpd);
					break;
				
				default:
					redirect('rpjmdesa');
					break;
			}
			$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_level($data['detail']->id_skpd,1);
			$data['perencanaan'] = $this->rpjmdesa_model->get_perencanaan_by_id_skpd($id_iku);
			$this->load->model('ref_satuan_model');
			$data['ref_satuan'] = $this->ref_satuan_model->get_all();


			$this->load->view('admin/index',$data);


		}
		else
		{
			redirect('admin');
		}
	}


	public function add_sasaran_strategis_renstra($id_skpd)
	{
		if (!$this->input->post('sasaran_strategis_renstra') OR !$this->input->post('id_iku_sasaran_rpjmd')) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_tujuan'] = '';
			$data['id_skpd'] = $id_skpd;
			$query = $this->rpjmdesa_model->insert_sasaran_strategis_renstra($data);
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
			$query = $this->rpjmdesa_model->update_sasaran_strategis_renstra($data,$id);
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
			$query = $this->rpjmdesa_model->insert_indikator_sasaran_strategis($data);
			if ($query) {
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_ss_renstra($query,$id_unit_kerja);
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
			$query = $this->rpjmdesa_model->update_indikator_sasaran_strategis($data,$id_iku);
			if ($query) {
				$this->rpjmdesa_model->delete_casecade_unit_kerja_iku_ss_renstra($query);
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_ss_renstra($query,$id_unit_kerja);
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
				$query = $this->rpjmdesa_model->update_bobot_iku_ss($key,$value);
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
			$this->rpjmdesa_model->id_sasaran_strategis_renstra = $id;
			$this->rpjmdesa_model->hapus_ss();
			$home = $this->uri->segment(3);
			redirect('rpjmdesa/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_strategis_renstra($id){
		$get =  $this->rpjmdesa_model->get_sasaran_strategis_by_id($id);
		echo json_encode($get);
	}


	public function add_sasaran_program_renstra($id_skpd)
	{
		if (!$this->input->post('sasaran_program_renstra') OR !$this->input->post('id_iku_ss_renstra') OR empty($this->input->post('id_unit_kerja'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->rpjmdesa_model->insert_sasaran_program_renstra($data);
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
			$query = $this->rpjmdesa_model->update_sasaran_program_renstra($data,$id);
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
			$query = $this->rpjmdesa_model->insert_indikator_sasaran_program($data);
			if ($query) {
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_sp_renstra($query,$id_unit_kerja);
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
			$query = $this->rpjmdesa_model->update_indikator_sasaran_program($data,$id_iku);
			if ($query) {
				$this->rpjmdesa_model->delete_casecade_unit_kerja_iku_sp_renstra($query);
				foreach ($casecade_unit_kerja as $id_unit_kerja) {
					$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_sp_renstra($query,$id_unit_kerja);
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
				$query = $this->rpjmdesa_model->update_bobot_iku_sp($key,$value);
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
			$this->rpjmdesa_model->id_sasaran_program_renstra = $id;
			$this->rpjmdesa_model->hapus_sp();
			// $home = $this->uri->segment(3);
			redirect('rpjmdesa/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_program_renstra($id){
		$get =  $this->rpjmdesa_model->get_sasaran_program_by_id($id);
		echo json_encode($get);
	}


	public function add_sasaran_kegiatan_renstra($id_skpd)
	{
		if (!$this->input->post('sasaran_kegiatan_renstra') OR !$this->input->post('id_iku_sp_renstra') OR empty($this->input->post('id_unit_kerja'))) {
			echo FALSE;
		} else {
			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			unset($data['id_unit_kerja']);
			$data['id_unit_kerja'] = implode(',', $_POST['id_unit_kerja']);
			$query = $this->rpjmdesa_model->insert_sasaran_kegiatan_renstra($data);
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
			$query = $this->rpjmdesa_model->update_sasaran_kegiatan_renstra($data,$id);
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

			for($tahun=2019;$tahun<=2023;$tahun++){
				$_POST['anggaran_'.$tahun] = str_replace('.', "", $_POST['anggaran_'.$tahun]);
				$_POST['anggaran_'.$tahun] = str_replace(',', "", $_POST['anggaran_'.$tahun]);
			}

			$data = $_POST;
			$data['id_skpd'] = $id_skpd;
			// $casecade_unit_kerja = (isset($data['casecade_unit_kerja'])) ? $data['casecade_unit_kerja'] : array() ;
			unset($data['casecade_unit_kerja']);
			$query = $this->rpjmdesa_model->insert_indikator_sasaran_kegiatan($data);
			if ($query) {
				// foreach ($casecade_unit_kerja as $id_unit_kerja) {
				// 	$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				// }
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
			// $casecade_unit_kerja = $data['casecade_unit_kerja'];
			unset($data['casecade_unit_kerja']);
			$query = $this->rpjmdesa_model->update_indikator_sasaran_kegiatan($data,$id_iku);
			if ($query) {
				// $this->rpjmdesa_model->delete_casecade_unit_kerja_iku_sk_renstra($query);
				// foreach ($casecade_unit_kerja as $id_unit_kerja) {
				// 	$query2 = $this->rpjmdesa_model->insert_casecade_unit_kerja_iku_sk_renstra($query,$id_unit_kerja);
				// }
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
				$query = $this->rpjmdesa_model->update_bobot_iku_sk($key,$value);
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
			$this->rpjmdesa_model->id_sasaran_kegiatan_renstra = $id;
			$this->rpjmdesa_model->hapus_sk();
			// $home = $this->uri->segment(3);
			redirect('rpjmdesa/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}

	public function hapus_iku($jenis_s,$home,$id_iku)
	{
		if ($this->user_id)
		{
			switch ($jenis_s) {
				case 'ss':
					$this->rpjmdesa_model->id_iku_ss_renstra = $id_iku;
					$this->rpjmdesa_model->hapus_iku_ss();
					break;
				case 'sp':
					$this->rpjmdesa_model->id_iku_sp_renstra = $id_iku;
					$this->rpjmdesa_model->hapus_iku_sp();
					break;
				case 'sk':
					$this->rpjmdesa_model->id_iku_sk_renstra = $id_iku;
					$this->rpjmdesa_model->hapus_iku_sk();
					break;
				
				default:
					# code...
					break;
			}			// $home = $this->uri->segment(3);
			redirect('rpjmdesa/view/'.$home);
		}
		else
		{
			redirect('home');
		}
	}


	public function get_sasaran_kegiatan_renstra($id){
		$get =  $this->rpjmdesa_model->get_sasaran_kegiatan_by_id($id);
		echo json_encode($get);
	}

	


}
