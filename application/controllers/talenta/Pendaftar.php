<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends CI_Controller {
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

		$this->load->model("talenta/kebutuhan_model");
		$this->load->model("talenta/pendaftaran_model");
		$this->load->model("talenta/skor_model");

		$user_privileges = explode(";", $this->session->userdata('user_privileges'));
		if ($this->user_level=="Administrator" OR in_array('talenta', $user_privileges) ){

		} 
		else{
			redirect ('welcome');
		}
    }
    
    public function index()
	{		
		//var_dump($this->session->userdata("id_pegawai"));die;
        if ($this->user_id)
		{
			$data['title']		= "Data Pendaftar seleksi - Manajemen Talenta";
			$data['content']	= "talenta/pendaftar/index" ;
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;
			//$data['active_menu'] = "ref_persyaratan";
			

			if($this->session->flashdata("message_success")){
				$data["message_success"]  = $this->session->flashdata("message_success");
			}
			if($this->session->flashdata("message_error")){
				$data["message_error"]  = $this->session->flashdata("message_error");
			}
			
			$where = array();			
			if($_POST)
			{
				if($this->input->post("eselon")){
					$where['mt_kebutuhan.eselon'] = $this->input->post("eselon");
				}

				$data = array_merge($data,$_POST);
				if($this->input->post("id_skpd")){
					$where['ref_skpd.id_skpd'] = $this->input->post("id_skpd");
					
					$param = array("mt_kebutuhan.id_skpd" => $this->input->post("id_skpd"));
					$dt_jabatan = $this->kebutuhan_model->getSeleksi($param);
					$data['dt_jabatan'] = $dt_jabatan;
				}
				
				if($this->input->post("id_jabatan")){
					$where['ref_jabatan.id_jabatan'] = $this->input->post("id_jabatan");
				}
				
			}

			$hal = 6;
			$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
			$mulai = ($page>1) ? ($page * $hal) - $hal : 0;
			$total = $this->pendaftaran_model->get_total();
			$data['pages'] = ceil($total/$hal);
			$data['current'] = $page;


			$dt_pendaftaran = $this->pendaftaran_model->get($where,$hal,$mulai);
			foreach($dt_pendaftaran as $key=>$value)
			{
				if($value->status_seleksi=="Lolos" && $value->verifikasi==1){
					$param = array(
						'id_pendaftaran'	=> $value->id_pendaftaran,
					);
					$dt_pendaftaran[$key]->skor = $this->skor_model->getTotal($param);
				}
			}
			$data['dt_pendaftaran'] = $dt_pendaftaran;
			$this->load->model("ref_skpd_model");
			$data['dt_skpd'] = $this->ref_skpd_model->get_all();
            
            //echo $this->session->userdata('id_pegawai');die;
            //echo "<pre>";print_r($data['dt_pendaftaran']);die;

			$this->load->view('admin/index',$data);

		}
		else
		{
			redirect('admin');
		}
	}

	public function detail($id_pendaftaran=null)
	{
		if ($this->user_id)
		{
			$dt_pendaftaran = $this->pendaftaran_model->get(['mt_pendaftaran.id_pendaftaran' => $id_pendaftaran]);
			if($id_pendaftaran!=null && $dt_pendaftaran){
				$data['dt_pendaftaran'] = $dt_pendaftaran[0];
				$id_pegawai = $dt_pendaftaran[0]->id_pegawai;
				
				$this->load->model("pegawai_model");
				$pegawai = $this->pegawai_model->get($dt_pendaftaran[0]->id_pegawai);
				$data['pegawai'] = $pegawai[0];
				$data['dt_riwayat_pendidikan'] = $this->pegawai_model->get_riwayat_pendidikan_by_id($id_pegawai);
				$data['dt_riwayat_pangkat'] = $this->pegawai_model->get_riwayat_pangkat_by_id($id_pegawai);
				$data['dt_riwayat_jabatan'] = $this->pegawai_model->get_riwayat_jabatan_by_id($id_pegawai);
				$data['dt_riwayat_diklat'] = $this->pegawai_model->get_riwayat_diklat_by_id($id_pegawai);
				$data['dt_riwayat_penataran'] = $this->pegawai_model->get_riwayat_penataran($id_pegawai);
				$data['dt_riwayat_seminar'] = $this->pegawai_model->get_riwayat_seminar($id_pegawai);
				$data['dt_riwayat_kursus'] = $this->pegawai_model->get_riwayat_kursus($id_pegawai);
				$data['dt_riwayat_unit_kerja'] = $this->pegawai_model->get_riwayat_unit_kerja_by_id($id_pegawai);
				$data['dt_riwayat_penghargaan'] = $this->pegawai_model->get_riwayat_penghargaan_by_id($id_pegawai);
				$data['dt_riwayat_penugasan'] = $this->pegawai_model->get_riwayat_penugasan($id_pegawai);
				$data['dt_riwayat_cuti'] = $this->pegawai_model->get_riwayat_cuti($id_pegawai);
				$data['dt_riwayat_hukuman'] = $this->pegawai_model->get_riwayat_hukuman($id_pegawai);
				$data['dt_riwayat_bahasa'] = $this->pegawai_model->get_riwayat_bahasa($id_pegawai);
				$data['dt_riwayat_bahasa_asing'] = $this->pegawai_model->get_riwayat_bahasa_asing($id_pegawai);
				$data['dt_riwayat_pernikahan'] = $this->pegawai_model->get_riwayat_pernikahan($id_pegawai);
				$data['dt_riwayat_anak'] = $this->pegawai_model->get_riwayat_anak($id_pegawai);
				$data['dt_riwayat_orangtua'] = $this->pegawai_model->get_riwayat_orangtua($id_pegawai);
				$data['dt_riwayat_mertua'] = $this->pegawai_model->get_riwayat_mertua($id_pegawai);
				
				//echo "<pre>";print_r($data['data_jabatan']);die;
				$this->user_model->user_id = 350;
				$this->user_model->set_user_by_user_id();
				$data['title']		= "Detail Talent";
				$data['content']	= "talenta/pendaftar/detail" ;
				$data['user_picture'] = $this->user_picture;
				$data['foto_pegawai'] = $this->user_model->foto_pegawai;
				$data['full_name']		= $this->full_name;
				$data['user_level']		= $this->user_level;
				$data['user_id'] = $this->user_model->id_pegawai;
				$data['active_menu'] = "talenta";
				
				$data['id_pendaftaran'] = $id_pendaftaran;
				$this->load->view('admin/index',$data);
			}
			else{
				show_404();
			}
		}
		else
		{
			redirect('admin');
		}
	}

	public function verifikasi($id_pendaftaran=null)
	{
		if ($this->user_id)
		{
			$dt_pendaftaran = $this->pendaftaran_model->get(['mt_pendaftaran.id_pendaftaran' => $id_pendaftaran]);
			if($id_pendaftaran!=null && $dt_pendaftaran){
				$data['dt_pendaftaran'] = $dt_pendaftaran[0];
				$id_pegawai = $dt_pendaftaran[0]->id_pegawai;
				
				$this->load->model("pegawai_model");
				$pegawai = $this->pegawai_model->get($dt_pendaftaran[0]->id_pegawai);
				$data['pegawai'] = $pegawai[0];

				
				$this->user_model->user_id = 350;
				$this->user_model->set_user_by_user_id();
				$data['title']		= "Verifikasi Talent";
				$data['content']	= "talenta/pendaftar/verifikasi" ;
				$data['user_picture'] = $this->user_picture;
				$data['foto_pegawai'] = $this->user_model->foto_pegawai;
				$data['full_name']		= $this->full_name;
				$data['user_level']		= $this->user_level;
				$data['user_id'] = $this->user_model->id_pegawai;

				
				$dt_verifikasi = $this->skor_model->getVariabel();
				
				$this->load->library('form_validation');

				//echo "<pre>";print_r($dt_pendaftaran);die;
				foreach($dt_verifikasi as $key=>$value)
				{
					$param = array(
						'id_variabel' 			=> $value->id_variabel,
						'id_kategori_jabatan'	=> $dt_pendaftaran[0]->id_kategori_jabatan,
					);
					$dt_verifikasi[$key]->kriteria = $this->skor_model->getKriteria($param);


				}

				$data['dt_verifikasi'] = $dt_verifikasi;
				//echo "<pre>";print_r($data['dt_verifikasi']);die;

				if($_POST)
				{
					$this->form_validation->set_rules(
						"submit",
						"Submit",
						'required',
						[
							'required' => '%s harus diisi',
						]
					);

					if($this->input->post("lolos"))
					{
						foreach($dt_verifikasi as $key=>$value)
						{
							
							$this->form_validation->set_rules(
								"kriteria_".$value->id_variabel,
								$value->variabel,
								'required',
								[
									'required' => '%s harus diisi',
								]
							);

						}
					}	
					if($this->form_validation->run() ==true) {
					
						$this->skor_model->deleteSkor($id_pendaftaran);

						$update = array(
							'verifikasi' 	=> 1,
							'status'		=> 'Tidak Lolos',
							'tgl_verifikasi'	=> date("Y-m-d H:i:s"),
							'verifikator'	=> $this->session->userdata("id_pegawai"),
						);

						if($this->input->post("lolos"))
						{

							foreach($dt_verifikasi as $key=>$value)
							{
								$kriteria = "kriteria_".$value->id_variabel;
								$insert = array(
									'id_pendaftaran'	=> $id_pendaftaran,
									'id_kriteria'		=> $this->input->post($kriteria)
								);
								$this->skor_model->insertSkor($insert);
							}

							$update['status'] = "Lolos";
						}

						

						$this->pendaftaran_model->update($update,$id_pendaftaran);


						// 9 box
						$n_kompetensi = $this->input->post("kompetensi");
						$n_potensi = $this->input->post("potensi");
						$posisi = 1;
						//box 1
						if($n_kompetensi==1&&$n_potensi==1){ 
							$posisi = 1;
						}
						//box 2 
						elseif($n_kompetensi==2&&$n_potensi==1)
						{
							$posisi = 2;
						}
						//box 3
						elseif($n_kompetensi==3&&$n_potensi==1)
						{
							$posisi = 3;
						}
						//box 4
						elseif($n_kompetensi==1&&$n_potensi==2)
						{
							$posisi = 4;
						}
						//box 5
						elseif($n_kompetensi==1&&$n_potensi==3)
						{
							$posisi = 5;
						}
						//box 6
						elseif($n_kompetensi==2&&$n_potensi==2)
						{
							$posisi = 6;
						}
						//box 7
						elseif($n_kompetensi==3&&$n_potensi==2)
						{
							$posisi = 7;
						}
						//box 8
						elseif($n_kompetensi==2&&$n_potensi==3)
						{
							$posisi = 8;
						}
						//box 9
						elseif($n_kompetensi==3&&$n_potensi==3)
						{
							$posisi = 9;
						}
						$assessment = array(
							'kompetensi'	=> $this->input->post("kompetensi"),
							'potensi'		=> $this->input->post("potensi"),
							'box'			=> $posisi
						);
						$this->db->where("id_pendaftaran",$id_pendaftaran)->update("mt_assessment",$assessment);
						
						$this->session->set_flashdata("message_success","Verifikasi berhasil.");
						redirect("talenta/pendaftar");
	
					}
					else{
						//echo validation_errors();die;
						
						$data['input'] = $_POST;
					}
					//echo "<pre>";print_r($_POST);die;
				}
				else{
					$param = array(
						'id_pendaftaran' => $id_pendaftaran,
					);
					$dt_skor = $this->skor_model->get($param);
					$input = array();
					foreach($dt_skor as $row)
					{
						$kriteria = "kriteria_".$row->id_variabel;
						$input[$kriteria] = $row->id_kriteria;
					}

					if($dt_pendaftaran[0]->status_seleksi=="Lolos")
					{
						$input['lolos'] = "1";
					}

					$data['input'] = $input;
				}

				$this->load->view('admin/index',$data);
			}
			else{
				show_404();
			}
		}
		else
		{
			redirect('admin');
		}
	}

	public function simpan_nilai()
	{
	//	if($this->input->is_ajax_request() )
	//	{
			if($_POST)
			{
				$data['status'] = true;
				$data['errors'] = array();
				$html_escape = html_escape($_POST);
				$post_data = array();
				$post_data['kompetensi'] = $this->input->post("kompetensi");
				$post_data['kinerja'] = $this->input->post("kinerja");
				$post_data['perilaku'] = $this->input->post("perilaku");
				$post_data['sasaran_kinerja'] = $this->input->post("sasaran_kinerja");
					
							$this->db->update('mt_assessment',$post_data,['id_pendaftaran' => $this->input->post("id_pendaftaran")]);
							
							$data['message'] = "Nilai berhasil disimpan";
					
					
					
					

				
				echo json_encode($data);
			}			
		//}
		//echo "error";	
	}
	
}
    ?>