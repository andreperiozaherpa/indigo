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
		$this->array_privileges = explode(';', $this->user_privileges);


		

		$this->load->model("sicerdas/renstra/Sasaran_model");
        $this->load->model("sicerdas/renstra/Sasaran_indikator_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("sicerdas/rpjmd/Tujuan_model");
        $this->load->model("sicerdas/rpjmd/Urusan_model");
        $this->load->model("sicerdas/Globalvar");
	}


	public function index()
	{
        if ($this->user_level == "Administrator" OR in_array('sicerdas_renstra', $this->array_privileges)) {	}
		else{show_404();}

        $token = $this->input->get("token");
        $param_skpd["where"]["md5(CONCAT('SC',skpd.id_skpd))"] = $token;
        $dt_skpd = $this->Skpd_model->get($param_skpd)->row();

        if(!$token || !$dt_skpd)
        {
            show_404();
        }
        
        $dt_skpd->kepala = $this->Skpd_model->get_kepala($dt_skpd->id_skpd);
        $data['dt_skpd'] = $dt_skpd;
        $data['dt_tujuan'] = $this->Tujuan_model->get_by_skpd($dt_skpd->id_skpd)->result();

        $data['dt_urusan'] = $this->Urusan_model->get_urusan()->result();

        //echo "<pre>";print_r($data['dt_tujuan']);die;


		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/renstra/sasaran/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "renstra_sasaran";
		$data['plugins'] = ['sweetalert','select'];

        $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($dt_skpd->id_skpd);
        $data['dt_unit_kerja'] = $dt_unit_kerja;

		
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

            if($this->session->userdata('id_skpd'))
            {
                $param['where']['sasaran.id_skpd'] = $this->session->userdata('id_skpd');
            }
            

            $result = $this->Sasaran_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $token = md5("SC".$row->id_sasaran_renstra);
                $param_indikator['where']['indikator.id_sasaran_renstra'] = $row->id_sasaran_renstra;
                $jumlah_indikator = $this->Sasaran_indikator_model->get($param_indikator)->num_rows();

                $content .= '
					<tr>
                     	<td>'.($offset+1).'</td>
                     	<td>-</td>
                     	<td>'.$row->nama_sasaran_renstra.'</td>
                        <td>'.$row->tujuan.'</td>
                        <td>'.$row->nama_urusan.'</td>
                        <td>'.$jumlah_indikator.'</td>
                     	<td><a href="'.base_url().'sicerdas/renstra/sasaran/detail/'.$token.'" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '<tr><td colspan="7" align="center">-Belum ada data-</td></tr>';
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
                        'field' => 'nama_sasaran_renstra',
                        'label' => 'Sasaran',
                        'rules' => 'required|regex_match[/^[a-z\d\-_\s\()\/\+\-.,"]+$/i]',
                        'errors' => [
                            'required' => '%s diperlukan',
                            'regex_match'   => '%s harus berupa huruf, angka, spasi, atau karakter lainya seperti ()/+-_',
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
                        'label' => 'Sasaran RPJMD',
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
                        'field' => 'id_skpd',
                        'label' => 'SKPD',
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
                        'id_sasaran_rpjmd'	=> $post_data['id_sasaran_rpjmd'],
                        'id_sub_urusan'   => $post_data['id_sub_urusan'],
                        'id_skpd'   => $post_data['id_skpd'],
						'nama_sasaran_renstra'	=> $post_data['nama_sasaran_renstra'],
					);
                    $id_sasaran_renstra = null;
					if($this->input->post("action")=="edit"){
						$this->Sasaran_model->update($dt,$post_data['id_sasaran']);
						$data['message'] = "Sasaran berhasil diubah";
                        $id_sasaran_renstra = $post_data['id_sasaran'];
					}
					else if($this->input->post("action")=="add"){
						$this->Sasaran_model->insert($dt);
						$data['message'] = "Sasaran berhasil disimpan";
                        $id_sasaran_renstra = $this->db->insert_id();
					}
					else{
						$data['message'] = "Error";
						$data['status'] = FALSE;
					}
                    if($id_sasaran_renstra)
                    {
                        /* $this->db->where("id_sasaran_renstra",$id_sasaran_renstra)->delete("sc_renstra_sasaran_unit_kerja");
                        if($this->input->post("ids_unit_kerja"))
                        {
                            foreach($_POST['ids_unit_kerja'] as $key => $value)
                            {
                                $this->db
                                ->set("id_sasaran_renstra",$id_sasaran_renstra)
                                ->set("id_unit_kerja",$value)
                                ->insert("sc_renstra_sasaran_unit_kerja");
                            }
                            $this->db->where("(id_unit_kerja not in (".implode(",",$_POST['ids_unit_kerja']).") )")
                            ->where("flag","sasaran")
                            ->delete("sc_cascading");
                        } */

                        /* $cek = $this->db
                        ->where("id_sasaran_renstra",$id_sasaran_renstra)
                        ->where("flag","pk")
                        ->get("sc_cascading")->row();

                        $kepala = $this->Skpd_model->get_kepala($post_data['id_skpd']);

                        $cascading_pk = array(
                            "id_sasaran_renstra"    => $id_sasaran_renstra,
                            "id_pegawai"            => $kepala->id_pegawai,
                            "flag"                  => "pk"  
                        );

                        if($cek)
                        {
                            $this->db->where("id_cascading",$cek->id_cascading)->update("sc_cascading",$cascading_pk);
                        }
                        else{
                            $this->db->insert("sc_cascading",$cascading_pk);
                        } */

                        // penanggung jawab otomatis semua unit kerja
                        $this->db->where("id_sasaran_renstra",$id_sasaran_renstra)->delete("sc_renstra_sasaran_unit_kerja");
                        $dt_unit_kerja = $this->db->where("id_skpd",$post_data['id_skpd'])->get("ref_unit_kerja")->result();
                        foreach($dt_unit_kerja as $row)
                        {
                            $this->db
                            ->set("id_sasaran_renstra",$id_sasaran_renstra)
                            ->set("id_unit_kerja",$row->id_unit_kerja)
                            ->insert("sc_renstra_sasaran_unit_kerja");
                        }

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
                
                $status = $this->Sasaran_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Sasaran berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus sasaran";
                    }
                
                echo json_encode($data);
            }           
        }
    }


	public function detail($token = null)
	{

        if ($this->user_level == "Administrator" OR in_array('sicerdas_renstra', $this->array_privileges)) {	}
		else{show_404();}
	
        $data['title']		= "sicerdas - " . app_name;
        $data['content']	= "sicerdas/renstra/sasaran/detail";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']		= $this->full_name;
        $data['user_level']		= $this->user_level;
        $data['plugins'] = ['sweetalert','select'];
        $data['active_menu'] = "rpjmd_sasaran";

        $this->load->model("sicerdas/Ref_satuan_model");
        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        $param['where']["md5(CONCAT('SC',sasaran.id_sasaran_renstra))"] = $token;
        $detail = $this->Sasaran_model->get($param)->row();

        if(!$token || !$detail)
        {
            show_404();
        }

        $data['detail'] = $detail;

        $data['dt_tahun'] = $this->Globalvar->get_tahun();

        $param_skpd["where"]["skpd.id_skpd"] = $detail->id_skpd;
        $dt_skpd = $this->Skpd_model->get($param_skpd)->row();
        $dt_skpd->kepala = $this->Skpd_model->get_kepala($dt_skpd->id_skpd);
        $data['dt_skpd'] = $dt_skpd;

        $data['dt_tujuan'] = $this->Tujuan_model->get_by_skpd($dt_skpd->id_skpd)->result();

        $data['dt_urusan'] = $this->Urusan_model->get_urusan()->result();

        $this->load->model("sicerdas/rpjmd/Tujuan_indikator_model");
        $param_indikator['where']['indikator.id_tujuan'] = $detail->id_tujuan;
        $data['dt_indikator_tujuan'] = $this->Tujuan_indikator_model->get($param_indikator);


        $param_sasaran['where']['sasaran.id_indikator_tujuan'] = $detail->id_indikator_tujuan;
        $data['dt_sasaran'] = $this->Sasaran_model->get($param_sasaran);
        
        //echo "<pre>";print_r($data['dt_sasaran']->result());die;

        $param_urusan['where']['urusan.id_urusan'] = $detail->id_urusan;
        $data['dt_sub_urusan'] = $this->Urusan_model->get($param_urusan);

        $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($dt_skpd->id_skpd);
        $data['dt_unit_kerja'] = $dt_unit_kerja;

        $data['unit_kerja'] = $this->Sasaran_model->getUnitKerja($detail->id_sasaran_renstra);

        
        if($data['unit_kerja'])
        {
            //$param_pegawai['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$data['unit_kerja']).") )";
            $param_pegawai['where']['pegawai.id_skpd'] = $detail->id_skpd;
            $param_pegawai['where']['pegawai.kepala_skpd'] = "Y";
            $data['dt_pegawai'] = $this->Pegawai_model->get($param_pegawai)->result();
        }
        else{
            $data['dt_pegawai'] = [];
        }

        //echo "<pre>";print_r($data['dt_pegawai']);die;

        $this->load->view('admin/main', $data);
		
	}

    public function get_sasaran_by_indikator()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_indikator_tujuan"))
        {
            $param['where']['sasaran.id_indikator_tujuan'] = $this->input->post("id_indikator_tujuan");
            $dt = $this->Sasaran_model->get($param);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_sasaran_rpjmd.'">'.$row->nama_sasaran_rpjmd.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    

}