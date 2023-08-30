<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Program extends CI_Controller
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

		$this->load->model("sicerdas/rpjmd/Program_model");
		$this->load->model("sicerdas/rpjmd/Urusan_model");
        $this->load->model("sicerdas/Globalvar");
	}


	public function index()
	{
		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/rpjmd/program/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "rpjmd_program";
		$data['plugins'] = ['sweetalert','select'];

		$this->load->model("sicerdas/rpjmd/Misi_model");
		$data['dt_misi'] = $this->Misi_model->get();

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
            
            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }
            

            $result = $this->Program_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $token = md5("SC".$row->id_program_rpjmd);
                $content .= '
					<tr>
                     	<td>'.($key+1).'</td>
                     	<td>'.$row->kode_program.'</td>
                     	<td>'.$row->nama_program.'</td>
                     	<td><a href="'.base_url().'sicerdas/rpjmd/program/detail/'.$token.'" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                  	</tr>
				';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="4" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Program_model->get($param)->num_rows();


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

	public function save()
    {
        if($this->input->is_ajax_request()  )
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
                        'field' => 'id_misi',
                        'label' => 'Misi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_tujuan',
                        'label' => 'Tujuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_indikator_tujuan',
                        'label' => 'Indikator Tujuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_sasaran_rpjmd',
                        'label' => 'Sasaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_indikator_sasaran_rpjmd',
                        'label' => 'Indikator Sasaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_urusan',
                        'label' => 'Urusan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_sub_urusan',
                        'label' => 'Sub urusan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_ref_program',
                        'label' => 'Program',
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
						'id_ref_program'	=> $post_data['id_ref_program'],
						'id_indikator_sasaran_rpjmd'	=> $post_data['id_indikator_sasaran_rpjmd'],
					);
					if($this->input->post("action")=="edit"){
						$this->Program_model->update($dt,$post_data['id_program_rpjmd']);
						$data['message'] = "Program berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Program_model->insert($dt);
						$data['message'] = "Program berhasil disimpan";
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    //$data['post'] = $_POST;
                }
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
                
                $status = $this->Program_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Program berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus program";
                    }
                
                echo json_encode($data);
            }           
        }
    }


	public function detail($token = null)
	{

	
        $data['title']		= "sicerdas - " . app_name;
        $data['content']	= "sicerdas/rpjmd/program/detail";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']		= $this->full_name;
        $data['user_level']		= $this->user_level;
        $data['plugins'] = ['sweetalert','select'];
        $data['active_menu'] = "rpjmd_program";

        $this->load->model("sicerdas/Ref_satuan_model");
        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        $param['where']["md5(CONCAT('SC',program.id_program_rpjmd))"] = $token;
        $detail = $this->Program_model->get($param)->row();

        if(!$token || !$detail)
        {
            show_404();
        }


        //echo "<pre>";print_r($detail);die;

        $data['detail'] = $detail;

        $data['dt_tahun'] = $this->Globalvar->get_tahun();

        $data['dt_skpd'] = $this->db->where("jenis_skpd","skpd")->get("ref_skpd")->result();

        $this->load->model("sicerdas/rpjmd/Misi_model");
        $data['dt_misi'] = $this->Misi_model->get();

        $data['dt_urusan'] = $this->Urusan_model->get_urusan()->result();


        $this->load->model("sicerdas/rpjmd/Tujuan_model");
        $param_tujuan['where']['tujuan.id_misi'] = $detail->id_misi;
        $data['dt_tujuan'] = $this->Tujuan_model->get($param_tujuan)->result();

        $this->load->model("sicerdas/rpjmd/Tujuan_indikator_model");
        $param_indikator_tujuan['where']['indikator.id_tujuan'] = $detail->id_tujuan;
        $data['dt_indikator_tujuan'] = $this->Tujuan_indikator_model->get($param_indikator_tujuan)->result();

        $this->load->model("sicerdas/rpjmd/Sasaran_model");
        $param_sasaran['where']['sasaran.id_indikator_tujuan'] = $detail->id_indikator_tujuan;
        $data['dt_sasaran'] = $this->Sasaran_model->get($param_sasaran);

        $this->load->model("sicerdas/rpjmd/Sasaran_indikator_model");
        $param_sasaran_indikator['where']['indikator.id_sasaran_rpjmd'] = $detail->id_sasaran_rpjmd;
        $data['dt_sasaran_indikator'] = $this->Sasaran_indikator_model->get($param_sasaran_indikator);

        $this->load->model("sicerdas/rpjmd/Urusan_model");
        $param_sub['where']['urusan.id_urusan'] = $detail->id_urusan;
        $data['dt_sub_urusan'] = $this->Urusan_model->get($param_sub);


        $param_program['where']['ref_program.id_sub_urusan'] = $detail->id_sub_urusan;
        $data['dt_program'] = $this->Program_model->get_ref($param_program);

        $this->load->view('admin/main', $data);
		
	}

	public function get_program_by_sub_urusan()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_sub_urusan"))
        {
            $param['where']['ref_program.id_sub_urusan'] = $this->input->post("id_sub_urusan");
            $dt = $this->Program_model->get_ref($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_ref_program.'">'.$row->kode_program.' - '.$row->nama_program.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
    
}