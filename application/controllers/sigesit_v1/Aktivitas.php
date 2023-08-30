<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktivitas extends CI_Controller
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
		$this->load->model("sigesit/Aktivitas_model");
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
                        'field' => 'id_kegiatan',
                        'label' => 'Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_skpd',
                        'label' => 'SKPD',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'tanggal',
                        'label' => 'Tanggal',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'deskripsi',
                        'label' => 'Deskripsi',
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
                        'id_kegiatan'   => $post_data['id_kegiatan'],
                        'user_id'    => $this->user_id,
                        'tanggal'    => $post_data['tanggal'],
                        'deskripsi'    => $post_data['deskripsi'],
                        'id_skpd'    => $post_data['id_skpd'],
                    );
                    
					if($this->input->post("action")=="add")
					{
						$this->db->insert("sigesit_aktivitas",$dt);
						$id_aktivitas = $this->db->insert_id();

						$token = md5($id_aktivitas);

						$path = "./data/sigesit/$token";
						
						if (!file_exists($path)) {
							mkdir($path, 0777, true);
						}


						$config['upload_path']          = $path;
						$config['allowed_types']        = 'jpeg|jpg|png';
						$config['max_size']             = 10000;
						
						$this->load->library('upload', $config);

						$n = count($_FILES['foto']['name']);

						for($i = 0; $i < $n ; $i++)
						{
							$_FILES['file']['name']  	= $_FILES['foto']['name'][$i];
							$_FILES['file']['type']  	= $_FILES['foto']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
							$_FILES['file']['error']  	= $_FILES['foto']['error'][$i];
							$_FILES['file']['size']  	= $_FILES['foto']['size'][$i];
							
							$this->upload->do_upload('file');
						}


					}

                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
					$data['file'] = $_FILES;
                }
                echo json_encode($data);
            }           
        }   
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

			if($this->input->post("id_kegiatan"))
			{
				$param['where']['aktivitas.id_kegiatan'] = $this->input->post("id_kegiatan");
			}
			
            $result = $this->Aktivitas_model->get($param)->result();

			

			$content = '';
            foreach($result as $key=>$row)
            {
				$foto_pegawai = ($row->foto_pegawai) ? $row->foto_pegawai : 'user-default.png';
				$token = md5($row->id_aktivitas);
				$path = "./data/sigesit/".$token."/";

				$foto = '';
				if(is_dir($path))
				{
					
					$dh = opendir($path);
					if($dh)
					{
						
						$i=1;
						while(($file = readdir($dh)) !== false)
						{
							if(is_file($path.$file))
							{
								$foto .= '
									<img src="'.base_url().'data/sigesit/'.$token.'/'.$file.'" alt="foto"
									class="col-md-3 col-xs-12" /> 
								';
							}
						}
					}
				}

				$btn_action = '<a href="javascript:remove(\''.$token.'\')" class="text-muted m-l-2" style="margin-left:5px" ><i class="fa fa-trash"></i></a>';

                $content .= '
				<div class="sl-item">
					<div class="sl-left"> <img src="'.base_url().'/data/foto/pegawai/'.$foto_pegawai.'" alt="user"
							class="img-circle" /> </div>
					<div class="sl-right">
						<div class="m-l-40"><a href="#" class="text-info">'.$row->full_name.'</a><br> <span class="sl-date">'.date("d M Y",strtotime($row->tanggal)).'</span>
							'.$btn_action.'
							<p>'.$row->deskripsi.' </p>
							<div class="m-t-20 row">
								'.$foto.'
							</div>
						</div>
					</div>
				</div>
				<hr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<div class="col-md-12 col-sm-12">
					<div class="white-box">
						<p class="text-center">Belum ada data</p>
					</div>
				</div>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Aktivitas_model->get($param)->num_rows();

			$data['content'] 	= $content;

			$last_row = $offset + $rowperpage;

			$load_more = false;
			if($last_row <= $total_rows)
			{
				$load_more = true;
			}
			$data['load_more'] = $load_more;

            echo json_encode($data);


        }
    }

	public function delete()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
				$token = $this->input->post("token");
                $status = $this->db->where("md5(id_aktivitas)",$token)->delete("sigesit_aktivitas");
                    
                    if($status){
                        $data['message'] = "Data berhasil dihapus";
						$path = "./data/sigesit/".$token."/";
                        $this->delTree($path);
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus program";
                    }
                
                echo json_encode($data);
            }           
        }
    }

	private function delTree($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		 foreach ($files as $file) {
		   (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
		 }
		 return rmdir($dir);
	   } 


}