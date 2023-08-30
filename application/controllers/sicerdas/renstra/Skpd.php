<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skpd extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
		$this->id_skpd = $this->session->userdata('id_skpd');
        if (!$this->user_id) {
            redirect('admin');
        }

		$this->user_model->user_id = $this->user_id;
		$this->user_model->set_user_by_user_id();
		

		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->user_privileges	= $this->user_model->user_privileges;
		$this->array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('sicerdas_renstra', $this->array_privileges)) {	}
		else{show_404();}

		$this->load->model("sicerdas/Skpd_model");
		$this->load->model("sicerdas/Globalvar");
	}

	public function sasaran()
	{
		if($this->id_skpd)
		{
			$token = md5("SC".$this->id_skpd);
			redirect("sicerdas/renstra/sasaran?token=".$token);
		}
		$this->view("sasaran");
	}
	public function program()
	{
		if($this->id_skpd)
		{
			$token = md5("SC".$this->id_skpd);
			redirect("sicerdas/renstra/program?token=".$token);
		}
		$this->view("program");
	}
	public function kegiatan()
	{
		if($this->id_skpd)
		{
			$token = md5("SC".$this->id_skpd);
			redirect("sicerdas/renstra/kegiatan?token=".$token);
		}
		$this->view("kegiatan");
	}
	public function view($type)
	{
		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/renstra/skpd/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "renstra_".$type;
		$data['plugins'] = [];
		$data['type'] = $type;

		$this->load->view('admin/main', $data);
	}

	public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 9;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();
            
            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }
            
            $param['str_where'] = "(skpd.jenis_skpd in ('skpd','kecamatan') )";

            if($this->session->userdata('id_skpd'))
            {
            	$param['where']['skpd.id_skpd'] = $this->session->userdata('id_skpd');
            }

            $result = $this->Skpd_model->get($param)->result();

			$content = '';
			$type=$this->input->post("type");
            foreach($result as $key=>$row)
            {
                $token = md5("SC".$row->id_skpd);
                $content .= '
					<div class="col-md-4 col-sm-6">
						<div class="white-box">
							<div class="row b-b" style="min-height: 150px;">
								<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 150px;">
									<img src="'.base_url().'data/logo/skpd/sumedang.png" alt="user" class="img-circle img-responsive">
								</div>
								<div class="col-md-8 col-sm-8">
									<p>&nbsp;</p>
									<h3 class="box-title m-b-0">'.$row->nama_skpd.'</h3>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<br>
									<address>
										<a href="'.base_url().'sicerdas/renstra/'.$type.'?token='.$token.'">
											<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail</button>
										</a>
									</address>
								</div>
							</div>
						</div>
					</div>
				';
            }

			if(!$result)
			{
				$content = '';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Skpd_model->get($param)->num_rows();


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
}