<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instruksi extends CI_Controller
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
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);




        $hasPrivilege = ($this->user_level == 'Administrator' || in_array('program', $array_privileges)) ;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
		$this->load->model("kinerja/Skpd");
		$this->load->model("kinerja/Instruksi_model");

		$this->load->model("sicerdas/Pegawai_model");
        $this->load->model("sicerdas/Cascading_model");
		$this->load->model("sicerdas/Ref_satuan_model");
        
	}

    public function index()
    {
        $data['title']		    = 'Instruksi Khusus | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/instruksi/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "instruksi";

		$param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

		$data['dt_satuan'] = $this->Ref_satuan_model->get();

        $this->load->view('admin/main', $data);
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
                        'field' => 'id_skpd',
                        'label' => 'SKPD',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                    [
                        'field' => 'nama_instruksi',
                        'label' => 'Nama instruksi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],

                    
                    [
                        'field' => 'target',
                        'label' => 'Target',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'satuan',
                        'label' => 'Satuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],


                    [
                        'field' => 'tahun',
                        'label' => 'Tahun',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                    
                ];

                

                $this->form_validation->set_rules( $validation_rules );

				$errors = array();

                $cascading = $this->input->post("cascading");

				if(!$cascading)
				{
                    /* if($this->input->post("id_instruksi_atasan"))
                    {
                        $errors['cascading'] = "Cascading diperlukan";
                    }
                    else{
                        $kepala = $this->Skpd->get_kepala($this->input->post("id_skpd"));
                        if($kepala)
                        {
                            $cascading = array($kepala->id_pegawai);
                        }
                    } */
                    $errors['cascading'] = "Cascading diperlukan";
				}

				if(!$this->input->post("bulan"))
				{
					$errors['bulan'] = "Jadwal diperlukan";
				}
                
                if( $this->form_validation->run() && !$errors)
                {

					$bulan = '';
					if($this->input->post("bulan"))
					{
						$bulan = implode(",",$this->input->post("bulan"));
					}

                    $dt_tahun = $this->Globalvar->get_tahun();
                    $tahun_ = $post_data['tahun'] - 1;
                    $tahun_desc = $dt_tahun[$tahun_];
                    
                    $dt = array(
                        'nama_instruksi'  	=> $post_data['nama_instruksi'],
                        'target'  			=> $post_data['target'],
                        'satuan'    		=> $post_data['satuan'],
                        'tahun'    		    => $post_data['tahun'],
                        'tahun_desc'        => $tahun_desc,
						'id_instruksi_atasan'=> ($this->input->post("id_instruksi_atasan")) ? $this->input->post("id_instruksi_atasan") : null,
                        'bulan'            	=> $bulan,
						'id_skpd'			=> ($this->input->post("id_skpd")) ? $this->input->post("id_skpd") : null,
                    );

					$id_instruksi = null;
                    
                    if($this->input->post("action")=="edit"){
						$id_instruksi = $post_data['id_instruksi'];
                        $this->Instruksi_model->update($dt,$post_data['id_instruksi']);
                        $data['message'] = "Instruksi berhasil diubah";
                    }
                    else if($this->input->post("action")=="add"){
                        $this->Instruksi_model->insert($dt);
                        $id_instruksi = $this->db->insert_id();
                        $data['message'] = "Instruksi berhasil disimpan";


                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_instruksi)
                    {
                        $this->db
                        ->where("id_instruksi",$id_instruksi)
                        ->where("flag","instruksi")
                        ->delete("sc_cascading");
                        if($cascading)
                        {
                            $param_pegawai['str_where'] = "(pegawai.id_pegawai in (".implode(",",$cascading).") )";
                            $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->result();

                            foreach($dt_pegawai as $row)
                            {
                                $this->db
                                ->set("id_pegawai",$row->id_pegawai)
                                ->set("id_unit_kerja",$row->id_unit_kerja)
								->set("id_instruksi",$id_instruksi)
                                ->set("tahun",$post_data['tahun'])
                                ->set("tahun_desc",$tahun_desc)
                                ->set("flag","instruksi")
                                ->insert("sc_cascading");
                            }
                        }
                    }

                }
                else{
                    $err = $this->form_validation->error_array();
					$errors = array_merge($errors,$err);
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
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
    
            if($this->input->post("id_skpd"))
            {
                $param['where']['instruksi.id_skpd'] = $this->input->post("id_skpd");
            }

            if($this->input->post("tahun"))
            {
                $param['where']['instruksi.tahun'] = $this->input->post("tahun");
            }

			if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            

            $result = $this->Instruksi_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $param_cascading['where']['cascading.id_instruksi'] = $row->id_instruksi;
                $param_cascading['where']['cascading.flag'] = "instruksi";
                $dt_cascading = $this->Cascading_model->get($param_cascading)->result();
                $cascading = array();

				$cascading_list = array();

                foreach($dt_cascading as $cas)
                {
                    $cascading[] = $cas->id_pegawai;
					$cascading_list[] = $cas->nama_lengkap . ' (' .$cas->jabatan . ')';
                }
                $result[$key]->cascading = $cascading;

				$bulan = ($row->bulan != "") ? explode(",",$row->bulan) : [];
				$result[$key]->bulan  = $bulan;

				$bulan_desc = array();
				foreach($bulan as $k => $value)
				{
					$bulan_desc[] = $this->Config->bulan[$value];
				}

				$offset++;

                $content .= '
				<tr>
					<td>'.$offset.'</td>
					<td>'.$row->nama_instruksi.'</td>
					<td>'.implode(", ",$bulan_desc).'</td>
                    <td>'.$row->tahun_desc.'</td>
					<td>'.$row->target.'</td>
					<td>'.$row->satuan_desc.'</td>
					<td>
						<ul style="padding-left:20px">
							<li>
							'.implode("</li><li>",$cascading_list).'
							</li>
						</ul>
					</td>
					<td>
						<div class="btn-group m-b-20">
							<button onclick="edit('.$key.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></button>
							<button onclick="hapus('.$row->id_instruksi.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></button>
						</div>
					</td>
				</tr>
				';

               
            }

			if(!$result)
			{
				$content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Instruksi_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Config->pagination_config());
            
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


	public function get_pegawai()
    {
        $content = '';//'<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
			$ids_pegawai = $this->input->post("ids_pegawai");
			//$param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
            $param['str_where'] = "(pegawai.id_skpd = '".$this->input->post("id_skpd")."' OR ref_skpd.id_skpd_induk = '".$this->input->post("id_skpd")."')";
            $dt = $this->Pegawai_model->get($param);
            foreach($dt->result() as $row)
            {
                $selected = ($ids_pegawai && in_array($row->id_pegawai,$ids_pegawai)) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

	public function delete()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Instruksi_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Instruksi berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus instruksi";
                    }
                
                echo json_encode($data);
            }           
        }
    }

    public function get_rencana_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
			$param['where']['instruksi.id_skpd'] = $this->input->post("id_skpd");
            $dt = $this->Instruksi_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_instruksi.'">'.$row->nama_instruksi.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}