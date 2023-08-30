<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Urusan extends CI_Controller
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
		$array_privileges = explode(';', $this->user_privileges);


		if ($this->user_level == "Administrator" OR in_array('sicedas_rpjmd', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sicerdas/rpjmd/Urusan_model");
        $this->load->model("sicerdas/Globalvar");
	}


	public function index()
	{
		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/rpjmd/urusan/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "rpjmd_urusan";
		$data['plugins'] = [];

		$data['dt_urusan'] = $this->Urusan_model->get_urusan()->result();

		$this->load->view('admin/main', $data);
		
	}

	public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 10;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();
            
            


			if($this->input->post("id_urusan"))
            {
                $param['where']['urusan.id_urusan'] = $this->input->post("id_urusan");
            } 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
                unset($param['where']['urusan.id_urusan']);
            }           

            $result = $this->Urusan_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $content .= '
					<tr>
                     	<td>'.($key+1).'</td>
                     	<td>'.$row->kode_sub_urusan.'</td>
                     	<td>'.$row->nama_sub_urusan.'</td>
                  	</tr>
				';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="3" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Urusan_model->get($param)->num_rows();


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

    public function get_sub_urusan_by_urusan()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_urusan"))
        {
            $param['where']['urusan.id_urusan'] = $this->input->post("id_urusan");
            $dt = $this->Urusan_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_sub_urusan.'">'.$row->kode_sub_urusan.' - '.$row->nama_sub_urusan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

}