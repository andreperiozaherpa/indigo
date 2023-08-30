<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Identifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


    $this->user_id = $this->session->userdata('user_id');
    $this->load->model('user_model');
    $this->user_model->user_id = $this->user_id;
    $this->user_model->set_user_by_user_id();
    $this->user_picture = $this->user_model->user_picture;
    $this->full_name    = $this->user_model->full_name;
    $this->user_level    = $this->user_model->level;

    $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

    if (!$this->user_id) {
        redirect("admin");
    }

		$bawahan = $this->db->where("id_pegawai_atasan_langsung",$this->session->userdata("id_pegawai"))->get("pegawai");
		if($this->user_level == 'Administrator' || $bawahan->num_rows()>0){
			$this->load->model('bangkom/Peserta_model');
			$this->load->model('bangkom/Diklat_model');
		}
		else{
			show_404();
		}




	}
	public function index()
	{
    $data['title']        = "Identifikasi Penilaian Mandiri - Bangkom";
    $data['content']    = "bangkom/identifikasi/index";
    $data['user_picture'] = $this->user_picture;
    $data['full_name']        = $this->full_name;
    $data['user_level']        = $this->user_level;

		$data['active_menu'] = "bangkom";


    $this->load->view('admin/index', $data);

	}

	public function get_list($rowno=1)
	{

			// Row per page
		  $rowperpage = 5;
		  $offset = ($rowno-1) * $rowperpage;

			$param = array();
			$param['limit']		= $rowperpage;
			$param['offset']	= $offset;
			//echo $offset;
			$data = array();
			//var_dump($this->input("fusername"));


			if($this->input->post("search"))
			{
        $param['like']['pegawai.nama_lengkap'] = $this->input->post("search");
			}

			$param['where']['pegawai.id_pegawai_atasan_langsung'] = $this->session->userdata("id_pegawai");


			if($this->input->post("status")!="")
			{
				$param['where']['bangkom_peserta.status'] = $this->input->post("status");
			}
      if($this->input->post("nilai_kesenjangan")!="")
			{
				$param['where']['bangkom_peserta.nilai_kompetensi'] = $this->input->post("nilai_kesenjangan");
			}

			$result = $this->Peserta_model->get($param)->result();

			unset($param['limit']);
			unset($param['offset']);
			$total_rows	= $this->Peserta_model->get($param)->num_rows();


			$this->load->library('pagination');



		    // Pagination Configuration
		    $config['base_url'] = "#";
		    $config['use_page_numbers'] = TRUE;
		    $config['total_rows'] = $total_rows;
		    $config['per_page'] = $rowperpage;
		    $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

		    // Initialize
		    $this->pagination->initialize($config);

		    $link = $this->pagination->create_links();
			  $link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm disabled' >", $link);
			  $link = str_replace("</strong>", "</button>", $link);

		    // Initialize $data Array
		    $data['pagination'] = $link;
		    $data['result'] 	= $result;
		    $data['row'] 		= $offset;
		    $data['csrf_hash']	= $this->security->get_csrf_hash();

		    echo json_encode($data);



	}





	public function detail($token=null)
	{
    $data['title']        = "Form Penilaian Kompetensi Bawahan - Bangkom";
    $data['content']    = "bangkom/identifikasi/detail";
    $data['user_picture'] = $this->user_picture;
    $data['full_name']        = $this->full_name;
    $data['user_level']        = $this->user_level;
		$data['token'] = $token;

		$data['active_menu'] = "bangkom";

		$param['where']['bangkom_peserta.token'] = $token;

		$data['detail'] = $this->Peserta_model->get($param)->row();

		if($token==null || !$data['detail']){
			show_404();
		}

		$data['riwayat_diklat'] = $this->db
		->where("id_pegawai",$data['detail']->id_pegawai)
		->order_by("id","DESC")
		->limit(1)
		->get("riwayat_diklat")
		->row();

		$param_indikator['where']['bangkom_peserta_indikator.id_peserta'] = $data['detail']->id_peserta;
		$data['dt_indikator'] = $this->Peserta_model->get_indikator($param_indikator)->result();

		$param_detail['where']['bangkom_peserta_detail.id_peserta'] = $data['detail']->id_peserta;
		$data['dt_detail'] = $this->Peserta_model->get_detail($param_detail)->result();

		$param_diklat['where']['bangkom_peserta_diklat.id_peserta'] = $data['detail']->id_peserta;
		$data['dt_diklat'] = $this->Peserta_model->get_diklat($param_diklat);

		$status_title = 1;

		foreach ($data['dt_diklat']->result() as $row) {
			if($row->status_diklat == 0 || $row->status_diklat == null){
				$status_title = 0;
			}
		}

		$data['status_title'] = $status_title;

		if($data['detail']->status!=1)
		{
			$jenjang = "";
			$pendidikan = $data['detail']->pendidikan;

			if($pendidikan=="S3"){
				$jenjang = "";
			}
			else if($pendidikan=="S2"){
				$jenjang = "S3";
			}
			else if($pendidikan=="S1"){
				$jenjang = "S2";
			}
			else{
				$jenjang = "S1";
			}

			$str_where = "";
			if($jenjang!=""){
				$str_where = "(bangkom_diklat.kategori_diklat='Pendidikan' AND bangkom_diklat.nama_diklat ='$jenjang' )";
			}

			if($str_where!="") $str_where .= " OR ";

			$str_where .= " (bangkom_diklat.kategori_diklat='Pelatihan' AND bangkom_diklat.nilai_kesenjangan = '".$data['detail']->nilai_kompetensi."' ) ";

			$param_training['str_where'] = $str_where;

			$training = $this->Diklat_model->get($param_training);

			$data['training'] = $training;
			//echo "<pre>";print_r($training);die;

		}



		//echo "<pre>";print_r($data);die;

    $this->load->view('admin/index', $data);

	}

	private function kalkulasi_nilai_kesenjangan($jumlah,$jawaban)
	{
		$nilai_kesenjangan = "";
		if ($jawaban == $jumlah) {
				$nilai_kesenjangan = 'Tidak ada kesenjangan' ;
		} elseif ($jawaban >= floor($jumlah*(3/4))) {
				$nilai_kesenjangan = 'Rendah' ;
		} elseif ($jawaban >= floor($jumlah/2)) {
				$nilai_kesenjangan = 'Sedang' ;
		} elseif ($jawaban < floor($jumlah/2)) {
				$nilai_kesenjangan = 'Tinggi' ;
		}
		return $nilai_kesenjangan;
	}

	public function submit_identifikasi()
	{
		if($_POST)
		{
			$selected = $this->input->post("centang");
			$centang_indikator = $this->input->post("centang_indikator");
			$token = $this->input->post("token");

			$peserta = $this->db->where("token",$token)->get("bangkom_peserta")->row();

			if($selected && $token && $peserta)
			{
				// request : atasan bisa centang indikator
				$pegawai = $this->db->where("id_pegawai",$peserta->id_pegawai)->get("pegawai")->row();
				$eselon = $this->Peserta_model->get_eselon($pegawai->eselon);
				$this->load->model("bangkom/Indikator_model");
				$param_indikator['where']['bangkom_indikator.jenis_kompetensi'] = $peserta->jenis_kompetensi;
				$param_indikator['where']['bangkom_indikator.jabatan'] = $eselon;

				$dt_indikator = $this->Indikator_model->get($param_indikator);

				$jawaban = count($centang_indikator);
				$jumlah = $dt_indikator->num_rows();
				$nilai_kesenjangan = $this->kalkulasi_nilai_kesenjangan($jumlah,$jawaban);

				$this->db->set("nilai_kompetensi",$nilai_kesenjangan);
				$this->db->where("id_peserta",$peserta->id_peserta);
				$this->db->update("bangkom_peserta");

				$id_peserta = $peserta->id_peserta;
				$this->db->where("id_peserta",$peserta->id_peserta)->delete("bangkom_peserta_indikator");
				foreach ($dt_indikator->result() as $row) {
					$data_indikator = array(
						'id_peserta'		=> $id_peserta,
						'id_indikator'	=> $row->id_indikator,
						'status'				=> (in_array($row->id_indikator,$centang_indikator)) ? 'Y' : 'N',
					);
					// insert indikator
					$this->db->insert("bangkom_peserta_indikator",$data_indikator);
				}


				$data_detail = array();
				$nama_kompetensi = "";
				$jml_indikator = 0;
				$jml_jawaban = 0;
				foreach ($dt_indikator->result() as $row) {

					if($nama_kompetensi!=$row->nama_kompetensi)
					{
						$jml_indikator = 0;
						$jml_jawaban = 0;
						$nama_kompetensi = $row->nama_kompetensi;
					}
					$jml_indikator++;

					if(in_array($row->id_indikator,$centang_indikator))
					{
						$jml_jawaban++;
					}

					$data_detail[$nama_kompetensi]['jumlah'] = $jml_indikator;
					$data_detail[$nama_kompetensi]['jawaban'] = $jml_jawaban;
					$data_detail[$nama_kompetensi]['nilai_kesenjangan'] = $this->kalkulasi_nilai_kesenjangan($jml_indikator,$jml_jawaban);

				}

				$this->db->where("id_peserta",$peserta->id_peserta)->delete("bangkom_peserta_detail");
				foreach ($data_detail as $key => $row) {
					$insert_data_detail = array (
						'id_peserta'	=> $id_peserta,
						'nama_kompetensi'	=> $key,
						'nilai_kesenjangan'	=> $row['nilai_kesenjangan'],
					);

					// insert detail
					$this->db->insert("bangkom_peserta_detail",$insert_data_detail);
				}

				// end of request

				$id_peserta = $peserta->id_peserta;
				foreach ($selected as $key => $value) {
					$dt_diklat = array(
						'id_peserta'		=> $id_peserta,
						'id_diklat'			=> $value,
						'status'				=> 1,
						'status_diklat'	=> null,
					);

					$this->db->insert("bangkom_peserta_diklat",$dt_diklat);
				}

				$this->db->set("status",1);
				$this->db->where("id_peserta",$id_peserta);
				$this->db->update("bangkom_peserta");


				$this->session->set_flashdata("success","Identifikasi Berhasil");
				redirect("bangkom/identifikasi");

			}
			else{
				$this->session->set_flashdata("error","Rekomendasi harus diisi");
				redirect("bangkom/identifikasi");
			}
		}
		else{
			show_404();
		}
	}

}
