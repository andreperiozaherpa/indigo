<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('sigesit', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sigesit/Globalvar");
		$this->load->model("sigesit/Kegiatan_model");
		$this->load->model("Ref_skpd_model");
	}


	public function index()
	{
		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/perencanaan/index";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

		if($this->id_skpd)
		{
			$token = md5("SKPD".$this->id_skpd);
			redirect('/sigesit/perencanaan/detail/'.$token);
		}
		
		$this->load->view('admin/main_lite', $data);
		
	}

	public function get_skpd($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 6;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array(); 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

			
            $result = $this->Ref_skpd_model->get($param)->result();

			$ids_skpd = array();
			foreach($result as $row)
			{
				$ids_skpd[] = $row->id_skpd;
			}

			$total = array();
			if($ids_skpd)
			{
				$param_total['str_where'] = "(kegiatan.id_skpd in (".implode(",",$ids_skpd)."))";
				$param_total['group_by'] = "skpd";
				$dt_total = $this->Kegiatan_model->get_total($param_total)->result();
				foreach($dt_total as $row)
				{
					$total[$row->id_skpd] = $row->total;
				}
			}

			$content = '';
            foreach($result as $key=>$row)
            {
				$jml_kegiatan = isset($total[$row->id_skpd]) ? $total[$row->id_skpd] : 0 ;
                $content .= '
				<div class="col-md-4 col-sm-6">
					<div class="white-box">
						<div class="row b-b" style="min-height: 150px;">
							<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 150px;">
								<img src="'.base_url().'/data/logo/skpd/sumedang.png" alt="user"
									class="img-circle img-responsive">
							</div>
							<div class="col-md-8 col-sm-8">
								<p>&nbsp;</p>
								<h3 class="box-title m-b-0">'.strtoupper($row->nama_skpd).'</h3>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-md-12 text-center">
								
								<h3 class="box-title m-b-0">'.$jml_kegiatan.'</h3>
								<p>Jumlah Kegiatan</p>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<br>
								<address>
									<a href="'.base_url().'/sigesit/perencanaan/detail/'.md5("SKPD".$row->id_skpd).'">
										<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail
										</button>
									</a>
								</address>
							</div>
						</div>
					</div>
				</div>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<div class="col-md-12 col-sm-12">
					<div class="white-box">
						<p class="text-center">Data tidak ditemukan</p>
					</div>
				</div>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Ref_skpd_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Globalvar->pagination_config());
            
            // Initialize
            $this->pagination->initialize($config);

            $link = $this->pagination->create_links();
            $link = str_replace("<strong>", "<button type='button' class='btn btn-primary btn-xm secondary' >", $link);
            $link = str_replace("</strong>", "</button>", $link);

            // Initialize $data Array
            $data['pagination'] = $link;
            $data['result']     = $result;
            $data['row']        = $offset;
            $data['csrf_hash']  = $this->security->get_csrf_hash();
            $data['param'] 		= $param;
			$data['content'] 	= $content;
            echo json_encode($data);


        }
    }

	public function detail($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/perencanaan/detail_skpd";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

		$data['token'] = $token;

		$param['where']["md5(concat('SKPD',id_skpd))"] = $token;
		$detail = $this->Ref_skpd_model->get($param)->row();

		if($detail)
		{

			$data['kepala'] = $this->db
			->where("jenis_pegawai","kepala")
			->where("id_unit_kerja",0)
			->where("pensiun",0)
			->where("id_skpd",$detail->id_skpd)
			->get("pegawai")
			->row();

			$data['detail'] = $detail;
			//echo "<pre>";print_r($detail);die;
			$this->load->view('admin/main_lite', $data);
		}
		else{
			show_404();
		}
		
		
	}





}