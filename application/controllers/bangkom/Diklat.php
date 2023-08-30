<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat extends CI_Controller
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

    if ($this->user_level !== "Administrator" && !in_array('op_kepegawaian',$this->user_privileges)) {
        show_404();
    }

    $this->load->model('bangkom/Diklat_model');

	}
	public function index()
	{
    $data['title']        = "Data Diklat - Bangkom";
    $data['content']    = "bangkom/diklat/index";
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

		    // Initialize $data Array
		    $data['pagination'] = $link;
		    $data['result'] 	= $result;
		    $data['row'] 		= $offset;
		    $data['csrf_hash']	= $this->security->get_csrf_hash();

		    echo json_encode($data);



	}

	public function save()
	{
		if($this->input->is_ajax_request() )
		{
			if($_POST)
			{
				$data['status'] = true;
				$data['errors'] = array();
				$html_escape = html_escape($_POST);
				$post_data = array();
				foreach($html_escape as $key=>$value)
				{
					$post_data[$key] = $this->security->xss_clean($value);
				}


				$this->load->library('form_validation');

				$this->form_validation->set_data( $post_data );


					$validation_rules = [
						[
							'field' => 'nama_diklat',
							'label' => 'Nama Diklat',
							'rules' => 'required|max_length[255]|regex_match[/^[a-z\d\-_\s\'\"]+$/i]', //  alphanumeric space, dash',
							'errors' => [
								'required' => '%s diperlukan',
								'max_length' => 'Maximal 255 Char',
								'regex_match' => '%s tidak valid',
							]
						],
						[
							'field' => 'kategori_diklat',
							'label' => 'Kategori',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
						[
							'field' => 'nilai_kesenjangan',
							'label' => 'Nilai Kesenjangan',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
						[
							'field' => 'model_penyelenggara',
							'label' => 'Penyelenggara',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
						[
							'field' => 'jadwal',
							'label' => 'Jadwal',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
            [
							'field' => 'jam_pelajaran',
							'label' => 'Jam Pelajaran',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
            [
							'field' => 'anggaran',
							'label' => 'Anggaran',
							'rules' => 'required|numeric',
							'errors' => [
								'required' => '%s diperlukan',
                'numeric' => '%s harus angka',
							]
						],
            [
							'field' => 'dpa',
							'label' => 'Sumber DPA',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
            [
							'field' => 'kesesuaian',
							'label' => 'Kesesuaian PK',
							'rules' => 'required',
							'errors' => [
								'required' => '%s diperlukan',
							]
						],
					];



				$this->form_validation->set_rules( $validation_rules );

				if( $this->form_validation->run() )
				{

					$dt = array(
						'nama_diklat'	=> $post_data['nama_diklat'],
						'kategori_diklat'	=> $post_data['kategori_diklat'],
						'jenis_pelatihan'	=> $post_data['jenis_pelatihan'],
						'nilai_kesenjangan'	=> $post_data['nilai_kesenjangan'],
						'model_penyelenggara'	=> $post_data['model_penyelenggara'],
            'penyelenggara'	=> $post_data['penyelenggara'],
            'jadwal'	=> $post_data['jadwal']."-01 00:00:00",
            'jam_pelajaran'	=> $post_data['jam_pelajaran'],
            'anggaran'	=> $post_data['anggaran'],
            'dpa'	=> $post_data['dpa'],
            'kesesuaian'	=> $post_data['kesesuaian'],
					);

          $data['data'] = $dt;


			    if($this->input->post("action")=="edit"){


							$this->db->set($dt)
								->where("id_diklat",$post_data['id_diklat'])
								->update("bangkom_diklat");

							$data['message'] = "Data Berhasil Diubah";
					}
					else if($this->input->post("action")=="add" ){

						$this->db->set($dt)
							->insert('bangkom_diklat');
							$data['message'] = "Data Berhasil Disimpan";

					}
					else{
						$data['message'] = 'Data tidak valid';
						$data['status'] = FALSE;
					}


				}
				else{
					$errors = $this->form_validation->error_array();
					$data['status']	= FALSE;
					$data['errors'] = $errors;
				}

				$data['csrf_hash']	= $this->security->get_csrf_hash();
				echo json_encode($data);
			}
		}
	}

	public function delete()
	{
		if($this->input->is_ajax_request())
		{
			if($_POST)
			{
				$data['status'] = true;

				$this->db->where_in("id_diklat",$this->input->post("ids"))
							->delete("bangkom_diklat");

				$data['message'] = "Data Berhasil Dihapus";

				$data['csrf_hash']	= $this->security->get_csrf_hash();
				echo json_encode($data);
			}
		}
	}


}
