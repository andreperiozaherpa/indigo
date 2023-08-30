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


		if ($this->user_level == "Administrator" OR in_array('sicedas_renstra', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sicerdas/renstra/Program_model");
        $this->load->model("sicerdas/renstra/Program_indikator_model");
        $this->load->model("sicerdas/renstra/Sasaran_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("sicerdas/Globalvar");
	}


	public function index()
	{
        $token = $this->input->get("token");
        $param_skpd["where"]["md5(CONCAT('SC',skpd.id_skpd))"] = $token;
        $dt_skpd = $this->Skpd_model->get($param_skpd)->row();

        if(!$token || !$dt_skpd)
        {
            show_404();
        }
        
        $dt_skpd->kepala = $this->Skpd_model->get_kepala($dt_skpd->id_skpd);
        $data['dt_skpd'] = $dt_skpd;

		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/renstra/program/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "renstra_program";
		$data['plugins'] = ['sweetalert','select'];


		$data['dt_program_rpjmd'] = $this->Program_model->get_by_skpd($dt_skpd->id_skpd)->result();

        $param_sasaran['where']['sasaran.id_skpd'] = $dt_skpd->id_skpd;
        $data['dt_sasaran'] = $this->Sasaran_model->get($param_sasaran)->result();
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

            if($this->input->post("id_skpd"))
            {
                $param['where']['sasaran.id_skpd'] = $this->input->post("id_skpd");
            }
            

            $result = $this->Program_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $token = md5("SC".$row->id_program_renstra);
                $param_indikator['where']['indikator.id_program_renstra'] = $row->id_program_renstra;
                $jml_indikator = $this->Program_indikator_model->get($param_indikator)->num_rows();
                $content .= '
					<tr>
                     	<td>'.($key+1).'</td>
                     	<td>'.$row->kode_program.'</td>
                     	<td>'.$row->nama_program.'</td>
                        <td>'.$row->nama_sasaran_renstra.'</td>
                        <td>'.$row->nama_indikator_program_rpjmd.'</td>
                        <td>'.$jml_indikator.'</td>
                     	<td><a href="'.base_url().'sicerdas/renstra/program/detail/'.$token.'" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                  	</tr>
				';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="7" align="center">-Belum ada data-</td></tr>';
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
                        'field' => 'id_program_rpjmd',
                        'label' => 'Program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_indikator_program_rpjmd',
                        'label' => 'Indikator',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_sasaran_renstra',
                        'label' => 'Sasaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                    [
                        'field' => 'id_indikator_sasaran_renstra',
                        'label' => 'Indikator Sasaran',
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
						'id_indikator_program_rpjmd'	=> $post_data['id_indikator_program_rpjmd'],
						'id_indikator_sasaran_renstra'	=> $post_data['id_indikator_sasaran_renstra'],
					);
					if($this->input->post("action")=="edit"){
						$this->Program_model->update($dt,$post_data['id_program_renstra']);
						$data['message'] = "Program berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$status = $this->Program_model->insert($dt);
                        if($status){
                            $data['message'] = "Program berhasil disimpan";    
                        }
						else{
                            $data['message'] = "Data sudah ada";
                            $data['status'] = FALSE;    
                        }
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
        $data['content']	= "sicerdas/renstra/program/detail";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']		= $this->full_name;
        $data['user_level']		= $this->user_level;
        $data['plugins'] = ['sweetalert','select'];
        $data['active_menu'] = "renstra_program";

        $this->load->model("sicerdas/Ref_satuan_model");
        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        $param['where']["md5(CONCAT('SC',renstra_program.id_program_renstra))"] = $token;
        $detail = $this->Program_model->get($param)->row();

        if(!$token || !$detail)
        {
            show_404();
        }

        
        $data['dt_tahun'] = $this->Globalvar->get_tahun();

        
        $data['detail'] = $detail;

        $param_skpd["where"]["skpd.id_skpd"] = $detail->id_skpd;
        $dt_skpd = $this->Skpd_model->get($param_skpd)->row();
               
        $dt_skpd->kepala = $this->Skpd_model->get_kepala($dt_skpd->id_skpd);
        $data['dt_skpd'] = $dt_skpd;
    

        $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($dt_skpd->id_skpd);
        $data['dt_unit_kerja'] = $dt_unit_kerja;
        
        //echo "<pre>";print_r($dt_unit_kerja);die;


        $this->load->view('admin/main', $data);
		
	}

	

}