<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sasaran extends CI_Controller
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

		$this->load->model("sicerdas/rpjmd/Sasaran_model");
	}


	public function index()
	{
		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/rpjmd/sasaran/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "rpjmd_sasaran";
		$data['plugins'] = ['sweetalert'];

		$this->load->model("sicerdas/rpjmd/Misi_model");
		$data['dt_misi'] = $this->Misi_model->get();
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
            

            $result = $this->Sasaran_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $content .= '
					<tr>
                     	<td>'.($key+1).'</td>
                     	<td>-</td>
                     	<td>'.$row->nama_sasaran_rpjmd.'</td>
                     	<td><a href="'.base_url().'sicerdas/rpjmd/sasaran/detail/'.$row->id_sasaran_rpjmd.'" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                  	</tr>
				';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="3" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Sasaran_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            // Initialize
            $this->pagination->initialize($config);

            $link = $this->pagination->create_links();
            $link = str_replace("<strong>", "<button type='button' class='btn btn-gradient-01 btn-xm secondary' >", $link);
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
                        'field' => 'nama_sasaran_rpjmd',
                        'label' => 'Sasaran',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
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
                    
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
					$dt = array(
						'id_indikator_tujuan'	=> $post_data['id_indikator_tujuan'],
						'nama_sasaran_rpjmd'	=> $post_data['nama_sasaran_rpjmd'],
					);
					if($this->input->post("action")=="edit"){
						$this->Sasaran_model->update($dt,$post_data['id_sasaran']);
						$data['message'] = "Sasaran berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Sasaran_model->insert($dt);
						$data['message'] = "Sasaran berhasil disimpan";
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

	public function detail()
	{
		if ($this->user_id) {

			$data['title']		= "sicerdas - " . app_name;
			$data['content']	= "sicerdas/rpjmd/sasaran/detail";
			$data['user_picture'] = $this->user_picture;
			$data['full_name']		= $this->full_name;
			$data['user_level']		= $this->user_level;

			$data['active_menu'] = "rpjmd_sasaran";
			$this->load->view('admin/index', $data);
		} else {
			redirect('admin');
		}
	}


}