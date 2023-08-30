<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visimisi extends CI_Controller
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

		$this->load->model("sicerdas/rpjmd/Visi_model");
		$this->load->model("sicerdas/rpjmd/Misi_model");
	}


	public function index()
	{
        $data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/rpjmd/visimisi/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "sc_visimisi";
		$data['plugins'] = ['sweetalert'];
        
        $this->load->view('admin/main', $data);
	}

	public function get_visi()
    {
        if($this->input->is_ajax_request())
        {
            $data = array();

			$data['dt_visi'] = $this->Visi_model->get();

            echo json_encode($data);

        }
    }


	public function update_visi()
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
                        'field' => 'visi',
                        'label' => 'Visi',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
                    
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
                    $dt = array(
						'visi'	=> $post_data['visi']
					);

					$this->db->update("sc_rpjmd_visi",$dt);
					$data['message'] = "Visi berhasil diubah";
					$data['status'] = true;
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

	public function get_misi()
    {
        if($this->input->is_ajax_request())
        {
            $data = array();

			$result = $this->Misi_model->get();
			$content = '';

			foreach($result as $key => $row)
			{
				$content .= '
				<tr>
					<td>'.($key+1).'</td>
					<td>'.$row->misi.'</td>
					<td style="width:150px">
						<a href="javascript:void(0)" onclick="editMisi('.$key.')" class="btn btn-warning btn-rounded btn-outline btn-sm"><i class="fa fa-pencil"></i></a> 
						<a href="javascript:void(0)" onclick="deleteMisi('.$key.')" class="btn btn-danger btn-rounded btn-sm btn-outline"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				';
			}

			$data['content']  = $content;
			$data['result'] = $result;

            echo json_encode($data);

        }
    }

	public function save_misi()
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
                        'field' => 'misi',
                        'label' => 'Misi',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
                        ]
                    ],
                    
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
					$dt = array(
						'misi'	=> $post_data['misi'],
						'id_visi'	=> 1,
					);
					if($this->input->post("action")=="edit"){
						$this->Misi_model->update($dt,$post_data['id_misi']);
						$data['message'] = "Misi berhasil diubah";
					}
					else if($this->input->post("action")=="add"){
						$this->Misi_model->insert($dt);
						$data['message'] = "Misi berhasil disimpan";
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

	public function delete_misi()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Misi_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Misi berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus misi";
                    }
                
                echo json_encode($data);
            }           
        }
    }

}