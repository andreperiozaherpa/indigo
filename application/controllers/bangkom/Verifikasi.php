<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
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
		$this->id_skpd = $this->session->userdata('id_skpd');
    if (!$this->user_id) {
        redirect("admin");
    }

    if ($this->user_level == "Administrator" || in_array("kepegawaian",$this->user_privileges)) {
        $this->load->model('bangkom/Diklat_model');
        $this->load->model('bangkom/Peserta_model');
    }
    else{
      show_404();
    }



	}
	public function index()
	{
    $data['title']        = "Verifikasi PYB - Bangkom";
    $data['content']    = "bangkom/verifikasi/index";
    $data['user_picture'] = $this->user_picture;
    $data['full_name']        = $this->full_name;
    $data['user_level']        = $this->user_level;

		$data['active_menu'] = "bangkom";

    $this->load->view('admin/index', $data);

	}

	public function get_list($rowno=1)
	{

			// Row per page
		  $rowperpage = 20;
		  $offset = ($rowno-1) * $rowperpage;

			$param = array();
			$param['limit']		= $rowperpage;
			$param['offset']	= $offset;
			//echo $offset;
			$data = array();
			//var_dump($this->input("fusername"));


			if($this->input->post("search"))
			{
        $param['like']['bangkom_diklat.nama_diklat'] = $this->input->post("search");
			}


			if($this->input->post("kategori_diklat")!="")
			{
				$param['where']['bangkom_diklat.kategori_diklat'] = $this->input->post("kategori_diklat");
			}
      if($this->input->post("nilai_kesenjangan")!="")
			{
				$param['where']['bangkom_diklat.nilai_kesenjangan'] = $this->input->post("nilai_kesenjangan");
			}

			$result = $this->Diklat_model->get($param)->result();

			unset($param['limit']);
			unset($param['offset']);
			$total_rows	= $this->Diklat_model->get($param)->num_rows();


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


        foreach ($result as $key => $row) {
          $param_total = array();
					if($this->id_skpd)
					{
							$param_total['where']['pegawai.id_skpd'] = $this->id_skpd;
					}
          $param_total['where']['bangkom_peserta_diklat.id_diklat'] = $row->id_diklat;
          $param_total['where']['bangkom_peserta_diklat.status'] = 1;
          $result[$key]->jumlah_rekomendasi = $this->Peserta_model->get_diklat($param_total)->num_rows();

          $param_total['where']['bangkom_peserta_diklat.status_diklat != '] = null;
          $result[$key]->jumlah_ikut = $this->Peserta_model->get_diklat($param_total)->num_rows();;
        }

		    // Initialize $data Array
		    $data['pagination'] = $link;
		    $data['result'] 	= $result;
		    $data['row'] 		= $offset;
		    $data['csrf_hash']	= $this->security->get_csrf_hash();

		    echo json_encode($data);



	}

	public function detail($tahun=null,$id_diklat=null)
	{
    $data['title']        = "Daftar Peserta Pengembangan Kompetensi - Bangkom";
    $data['content']    = "bangkom/verifikasi/detail";
    $data['user_picture'] = $this->user_picture;
    $data['full_name']        = $this->full_name;
    $data['user_level']        = $this->user_level;
		$data['tahun'] = $tahun;
		$data['id_diklat'] = $id_diklat;

		$data['active_menu'] = "bangkom";

		$param_diklat['where']['bangkom_diklat.id_diklat'] = $id_diklat;
		$diklat = $this->Diklat_model->get($param_diklat)->result();

		if($tahun && $id_diklat && $diklat){
			$data['training'] = $diklat;

			$param['where']['year(bangkom_peserta.tahun_kegiatan)'] = $tahun;
			$param['where']['bangkom_peserta_diklat.id_diklat'] = $id_diklat;
			if($this->id_skpd)
			{
				$param['where']['pegawai.id_skpd'] = $this->id_skpd;
			}
			$peserta_diklat = $this->Peserta_model->get_diklat($param);

			$data['peserta'] = $peserta_diklat;


			$pesertaIkut = 0;
			$pesertaTidakIkut = 0;
			$ada = 0;
			foreach ($peserta_diklat->result() as $row) {
					// hitung peserta ikut/disetujui ppk
					if($row->status == 1 || $row->status == 2){
							$pesertaIkut = $pesertaIkut + 1;
					} else if($row->status == 0){
							$pesertaTidakIkut = $pesertaTidakIkut + 1;
					}
					// cek data baru masuk
					if ($row->status_diklat === null) {
							$ada = $ada + 1;
					}
			}

			if ($ada == 0) {
					$disable = true;
			}else{
					$disable = false;
			}
			$data['total_anggaran'] = $diklat[0]->anggaran * $pesertaIkut;

			$data['pesertaIkut'] = $pesertaIkut;
			$data['pesertaTidakIkut'] = $pesertaTidakIkut;
			$data['disable'] = $disable;

			$this->load->view('admin/index', $data);
		}
		else{
			show_404();
		}




	}

	public function submit_verifikasi()
	{
		if($_POST)
		{
			$centang = $this->input->post("centang");
			$tahun = $this->input->post("tahun");
			$id_diklat = $this->input->post("id_diklat");

			$param_diklat['where']['bangkom_diklat.id_diklat'] = $id_diklat;
			$diklat = $this->Diklat_model->get($param_diklat)->row();

			if($tahun && $id_diklat && $diklat)
			{
				$param['where']['year(bangkom_peserta.tahun_kegiatan)'] = $tahun;
				$param['where']['bangkom_peserta_diklat.id_diklat'] = $id_diklat;
				if($this->id_skpd)
				{
					$param['where']['pegawai.id_skpd'] = $this->id_skpd;
				}
				$peserta_diklat = $this->Peserta_model->get_diklat($param);

				foreach ($peserta_diklat->result() as $row) {
					if($row->status_diklat != 1)
					{
						$status_diklat = 0;
						$status = 0;
						if(in_array($row->id,$centang)){
							$status = 1;
						}

						$update = array(
							'status_diklat'		=> $status_diklat,
							'status'					=> $status,
						);

						$this->db
						->where("id",$row->id)
						->update("bangkom_peserta_diklat",$update);
					}
				}

				$this->session->set_flashdata("success","Verifikasi Berhasil");
				redirect("bangkom/verifikasi");

			}
			else{
				$this->session->set_flashdata("error","Invalid data");
				redirect("bangkom/verifikasi");
			}
		}
		else{
			show_404();
		}
	}


}
