<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
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


    $this->load->model('bangkom/Peserta_model');

	}
	public function index()
	{
    $data['title']        = "Penilaian Mandiri - Bangkom";
    $data['content']    = "bangkom/penilaian/index";
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
        $param['like']['bangkom_peserta.jenis_kompetensi'] = $this->input->post("search");
			}

			$param['where']['pegawai.id_pegawai'] = $this->session->userdata("id_pegawai");

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

	public function kompetensi()
	{

			if($_POST)
			{

				$validasi = $this->validasi_kompetensi();

				if($validasi['error'] == false)
				{
					$data['title']        = "Kompetensi Penilaian Mandiri - Bangkom";
			    $data['content']    = "bangkom/penilaian/kompetensi";
			    $data['user_picture'] = $this->user_picture;
			    $data['full_name']        = $this->full_name;
			    $data['user_level']        = $this->user_level;

					$data['active_menu'] = "bangkom";

					$dt_indikator = $validasi['indikator'];

					if(!empty($dt_indikator)){
						$data['dt_indikator'] = $dt_indikator;
					}
					$data = array_merge($data,$_POST);
					$this->load->view('admin/index', $data);
				}
				else{
					$this->session->set_flashdata("error",$validasi['error']);
					redirect("bangkom/penilaian");
				}


			}
			else{
				show_404();
			}
	}

	private function validasi_kompetensi()
	{
		$error = false;
		$dt_indikator = null;
		if(!$this->input->post("jenis_kompetensi") || !$this->input->post("tahun_kegiatan"))
		{
			$error = "Jenis kompetensi dan tahun kegiatan diperlukan";
		}
		else if($this->input->post("tahun_kegiatan") < date("Y"))
		{
			$error = "Tahun kegiatan minimal ".date("Y");
		}
		else if($this->input->post("tahun_kegiatan") > (date("Y") + 1))
		{
			$error = "Tahun kegiatan maksimal ".(date("Y") + 1);
		}
		else{
			$param['where']['bangkom_peserta.id_pegawai'] = $this->session->userdata('id_pegawai');
			$param['where']['year(bangkom_peserta.tahun_kegiatan)'] = $this->input->post("tahun_kegiatan");
			$param['where']['bangkom_peserta.jenis_kompetensi'] = $this->input->post("jenis_kompetensi");

			$cek = $this->Peserta_model->get($param)->num_rows();
			if($cek>0)
			{
				$error = "Kompetensi sudah pernah dibuat";
			}
			else{
				$pegawai = $this->db->where("id_pegawai",$this->session->userdata('id_pegawai'))->get("pegawai")->row();
				if($pegawai)
				{
					$eselon = $this->Peserta_model->get_eselon($pegawai->eselon);
					$this->load->model("bangkom/Indikator_model");
					$param_indikator['where']['bangkom_indikator.jenis_kompetensi'] = $this->input->post("jenis_kompetensi");
					$param_indikator['where']['bangkom_indikator.jabatan'] = $eselon;

					$dt_indikator = $this->Indikator_model->get($param_indikator);
					if($dt_indikator->num_rows()==0)
					{
						$error = "Mohon maaf. Data belum tersedia.";
					}
				}
				else{
					$error = "Pegawai tidak ditemukan";
				}


			}
		}
		return array(
			'error'	=> $error,
			'indikator' => $dt_indikator,
		);
	}

	public function submit_kompetensi()
	{
		if($_POST)
		{
			$validasi = $this->validasi_kompetensi();
			if($validasi['error'] == false)
			{
				$dt_indikator = $validasi['indikator'];
				$selected = $this->input->post("centang");

				$jawaban = count($selected);
				$jumlah = $dt_indikator->num_rows();

				$nilai_kesenjangan = $this->kalkulasi_nilai_kesenjangan($jumlah,$jawaban);

				$tahun_kegiatan = $this->input->post('tahun_kegiatan');
				$data_peserta = array(
					'id_pegawai'				=> $this->session->userdata('id_pegawai'),
					'jenis_kompetensi'	=> $this->input->post('jenis_kompetensi'),
					'tahun_kegiatan'		=> date($tahun_kegiatan."-m-d H:i:s"),
					'nilai_kompetensi'	=> $nilai_kesenjangan,
					'status'						=> 9, // belum terverifikasi
					'token'							=> md5(uniqid()),
				);

				// insert peserta
				$this->db->insert("bangkom_peserta",$data_peserta);
				$id_peserta = $this->db->insert_id();

				foreach ($dt_indikator->result() as $row) {
					$data_indikator = array(
						'id_peserta'		=> $id_peserta,
						'id_indikator'	=> $row->id_indikator,
						'status'				=> (in_array($row->id_indikator,$selected)) ? 'Y' : 'N',
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

					if(in_array($row->id_indikator,$selected))
					{
						$jml_jawaban++;
					}

					$data_detail[$nama_kompetensi]['jumlah'] = $jml_indikator;
					$data_detail[$nama_kompetensi]['jawaban'] = $jml_jawaban;
					$data_detail[$nama_kompetensi]['nilai_kesenjangan'] = $this->kalkulasi_nilai_kesenjangan($jml_indikator,$jml_jawaban);

				}

				foreach ($data_detail as $key => $row) {
					$insert_data_detail = array (
						'id_peserta'	=> $id_peserta,
						'nama_kompetensi'	=> $key,
						'nilai_kesenjangan'	=> $row['nilai_kesenjangan'],
					);

					// insert detail
					$this->db->insert("bangkom_peserta_detail",$insert_data_detail);
				}

				$this->session->set_flashdata("success","Kompetensi Berhasil Dibuat dan akan diteruskan ke atasan anda");
				redirect("bangkom/penilaian");

			}
			else{
				$this->session->set_flashdata("error",$validasi['error']);
				redirect("bangkom/penilaian");
			}
		}
		else{
			show_404();
		}
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

	public function detail($token=null)
	{
    $data['title']        = "Detail Kompetensi ASN - Bangkom";
    $data['content']    = "bangkom/penilaian/detail";
    $data['user_picture'] = $this->user_picture;
    $data['full_name']        = $this->full_name;
    $data['user_level']        = $this->user_level;

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

		//echo "<pre>";print_r($data);die;

    $this->load->view('admin/index', $data);

	}

}
