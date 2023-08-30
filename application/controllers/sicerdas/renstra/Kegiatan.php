<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
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

      

        $this->load->model("sicerdas/renstra/Program_model");
        $this->load->model("sicerdas/renstra/Kegiatan_model");
        $this->load->model("sicerdas/renstra/Kegiatan_indikator_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("sicerdas/Pegawai_model");
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

		$data['title']		= "sicerdas - " . app_name;
		$data['content']	= "sicerdas/renstra/kegiatan/index";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;

		$data['active_menu'] = "renstra_kegiatan";
		$data['plugins'] = ['sweetalert','select'];

        $param_program['where']['sasaran.id_skpd'] = $dt_skpd->id_skpd;
		$data['dt_program_renstra'] = $this->Program_model->get($param_program)->result();

        //echo "<pre>";print_r($dt_skpd);die;
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

            $result = $this->Kegiatan_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $token = md5("SC".$row->id_kegiatan);
                $param_indikator['where']['indikator.id_kegiatan'] = $row->id_kegiatan;
                $jml_indikator = $this->Kegiatan_indikator_model->get($param_indikator)->num_rows();
                $content .= '
					<tr>
                     	<td>'.($offset+1).'</td>
                     	<td>'.$row->kode_kegiatan.'</td>
                     	<td>'.$row->nama_kegiatan.'</td>
                        <td>'.$row->nama_program.'</td>
                        <td>'.$jml_indikator.'</td>
                     	<td>
                            <a href="'.base_url().'sicerdas/renstra/kegiatan/detail/'.$token.'" class="btn btn-info btn-circle"><i class="ti-eye"></i></a>
                            <a href="javascript:void(0)" onclick="edit('.$key.')" class="btn btn-success btn-circle"><i class="ti-pencil"></i></a>
                            <a href="javascript:void(0)" onclick="hapus('.$row->id_kegiatan.')" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
                        </td>
                  	</tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '<tr><td colspan="6" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Kegiatan_model->get($param)->num_rows();


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
                        'field' => 'id_program_renstra',
                        'label' => 'Program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_indikator_program_renstra',
                        'label' => 'Indikator',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
					[
                        'field' => 'id_ref_kegiatan',
                        'label' => 'Kegiatan',
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
						'id_indikator_program_renstra'	=> $post_data['id_indikator_program_renstra'],
						'id_ref_kegiatan'	=> $post_data['id_ref_kegiatan'],
					);
                    $id_kegiatan = null;
					if($this->input->post("action")=="edit"){
						$this->Kegiatan_model->update($dt,$post_data['id_kegiatan']);
						$data['message'] = "Kegiatan berhasil diubah";
                        $id_kegiatan = $post_data['id_kegiatan'];
					}
					else if($this->input->post("action")=="add"){
						$status = $this->Kegiatan_model->insert($dt);
                        if($status){
                            $data['message'] = "Kegiatan berhasil disimpan";    
                            $id_kegiatan = $this->db->insert_id();
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

                    if($id_kegiatan)
                    {
                        $this->db->where("id_kegiatan",$id_kegiatan)->delete("sc_renstra_kegiatan_unit_kerja");
                        if($this->input->post("ids_unit_kerja"))
                        {
                            foreach($_POST['ids_unit_kerja'] as $key => $value)
                            {
                                $this->db
                                ->set("id_kegiatan",$id_kegiatan)
                                ->set("id_unit_kerja",$value)
                                ->insert("sc_renstra_kegiatan_unit_kerja");
                            }
                            $this->db->where("(id_unit_kerja not in (".implode(",",$_POST['ids_unit_kerja']).") )")
                            ->where("flag","kegiatan")
                            ->where("id_kegiatan",$id_kegiatan)
                            ->delete("sc_cascading");
                        }
                        
                        // update cascading
                        $param_detail['where']['renstra_kegiatan.id_kegiatan'] = $id_kegiatan;
                        $detail = $this->Kegiatan_model->get($param_detail)->row();
                        if($detail)
                        {
                            $this->db
                            ->where("id_kegiatan",$id_kegiatan)   
                            ->set("id_sasaran_renstra",$detail->id_sasaran_renstra)
                            ->set("id_indikator_sasaran_renstra",$detail->id_indikator_sasaran_renstra)
                            ->set("id_program_renstra",$detail->id_program_renstra)
                            ->set("id_indikator_program_renstra",$detail->id_indikator_program_renstra)
                            ->update("sc_cascading");
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
                
                $status = $this->Kegiatan_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Kegiatan berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus data";
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
        $data['content']	= "sicerdas/renstra/kegiatan/detail";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']		= $this->full_name;
        $data['user_level']		= $this->user_level;
        $data['plugins'] = ['sweetalert','select'];
        $data['active_menu'] = "renstra_kegiatan";

        $this->load->model("sicerdas/Ref_satuan_model");
        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        $param['where']["md5(CONCAT('SC',renstra_kegiatan.id_kegiatan))"] = $token;
        $detail = $this->Kegiatan_model->get($param)->row();

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
        
        //echo "<pre>";print_r($dt_skpd);die;
        $param_indikator_sasaran['where']['indikator.id_program_renstra'] = $detail->id_program_renstra;
        $data['dt_indikator_sasaran'] = $this->Program_model->get_indikator_sasaran($param_indikator_sasaran);

        $param_indikator_rpjmd['where']['indikator.id_program_renstra'] = $detail->id_program_renstra;
        $data['dt_indikator_rpjmd'] = $this->Program_model->get_indikator_rpjmd($param_indikator_rpjmd);


        $data['unit_kerja'] = $this->Kegiatan_model->getUnitKerja($detail->id_kegiatan);

        //echo "<pre>";print_r($data['unit_kerja']);die;

        
        if($data['unit_kerja'])
        {
            $__param['str_where'] = "(unit_kerja.id_unit_kerja in (".implode(",",$data['unit_kerja']).") AND skpd.jenis_skpd in ('uptd','kelurahan') )";

            $__skpd = $this->Skpd_model->get_skpd_by_unit($__param)->result();
            if($__skpd)
            {
                $ids_skpd = array();
                foreach($__skpd as $row)
                {
                    $ids_skpd[] = $row->id_skpd;
                }
                $param_pegawai['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$data['unit_kerja']).") OR pegawai.id_skpd in (".implode(",",$ids_skpd)."))";
            }
            else{
                $param_pegawai['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$data['unit_kerja']).") )";
            }

            $data['dt_pegawai'] = $this->Pegawai_model->get($param_pegawai)->result();
        }
        else{
            $data['dt_pegawai'] = [];
        }

        $this->load->view('admin/main', $data);
		
	}

	public function get_kegiatan()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_program_renstra"))
        {
            $param_program['where']['renstra_program.id_program_renstra'] = $this->input->post("id_program_renstra");
            $dt_program = $this->Program_model->get($param_program)->row();

            $param = array();
            if($dt_program){
                $param['where']['ref_kegiatan.id_sub_urusan'] = $dt_program->id_sub_urusan;
            }
            
            $dt = $this->Kegiatan_model->get_ref($param);
            foreach($dt->result() as $row)
            {
                $selected = ($row->id_ref_kegiatan == $this->input->post("id_ref_kegiatan"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_ref_kegiatan.'">'.$row->kode_kegiatan.' - '.$row->nama_kegiatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }


    public function get_unit_kerja()
    {
        $id_kegiatan = $this->input->post("id_kegiatan");
        $id_program_renstra = $this->input->post("id_program_renstra");
        if($this->input->is_ajax_request() && $id_program_renstra && $this->input->post('id_skpd'))
        {
            $this->db->where("(ref_unit_kerja.nama_unit_kerja not like '%kelurahan%' AND ref_unit_kerja.nama_unit_kerja not like '%upt%' )");
            $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($this->input->post('id_skpd'));

            

            //$unit_kerja = $this->Program_model->getUnitKerja($id_program_renstra);
            $unit_kerja_active = array();
            if($id_kegiatan)
            {
                $unit_kerja_active = $this->Kegiatan_model->getUnitKerja($id_kegiatan);
            }

            
            
            $content = '
            <div class="col-md-12">
                <div class="form-group" style="display:block;">
                <label class="">Unit Penanggung Jawab</label>
                    <div class="col-lg-12">';

                    $content .= $this->get_unit_kerja_checkbox($dt_unit_kerja, $unit_kerja_active);

                $content .='       
                </div>
            
                </div>
            </div>';

            $jenis_skpd = $this->input->post("jenis_skpd");
            $nama_skpd_alias = $this->input->post("nama_skpd_alias");
            //if($jenis_skpd == "kecamatan" || $nama_skpd_alias == "DINKES")
            //{
                $dt_skpd = $this->db->where("id_skpd_induk",$this->input->post('id_skpd'))->get("ref_skpd")->result();
                foreach($dt_skpd as $row)
                {
                    $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($row->id_skpd);

                    $content .= '
                    <div class="col-md-12 mt-2">
                        <div class="form-group" style="display:block;marging-top:30px">
                        
                            <div class="col-lg-12">
                            <strong class="">'.$row->nama_skpd.'</strong>';

                            $content .= $this->get_unit_kerja_checkbox($dt_unit_kerja, $unit_kerja_active);

                        $content .='       
                        </div>
                    
                        </div>
                    </div>';
                }
           //}

            $data['content'] = $content;

            echo json_encode($data);         
        }
    }

    private function get_unit_kerja_checkbox($dt_unit_kerja, $unit_kerja_active)
    {
        $content = '';
        foreach($dt_unit_kerja as $key=>$value){

//                    if(in_array($value->id_unit_kerja,$unit_kerja)){
            $margin_left = '0';
            if($value->level_unit_kerja==2)
            {
            $margin_left = '20';
            }
            else if($value->level_unit_kerja==3)
            {
            $margin_left = '40';
            }
            else if($value->level_unit_kerja==4)
            {
            $margin_left = '60';
            }

            $checked = ($unit_kerja_active && in_array($value->id_unit_kerja,$unit_kerja_active)) ? "checked" : "";

            $content .= '
            <div class="checkbox checkbox-primary" style="margin-left:'.$margin_left.'px">
                <input '.$checked.' onclick="check('.$value->id_unit_kerja.')" class="checkbox '.$value->class_unit.'" id="checkbox_'.$value->id_unit_kerja.'" type="checkbox" name="ids_unit_kerja[]" value="'.$value->id_unit_kerja.'">
                <label for="checkbox_'.$value->id_unit_kerja.'"> '.$value->nama_unit_kerja.' </label>
            </div>
            ';                                    
//                    }
            
            if($key < (count($dt_unit_kerja) -1 ))
            {
              $key_next = $key + 1;
              $level_unit_kerja_next = $dt_unit_kerja[$key_next]->level_unit_kerja;
              if($level_unit_kerja_next==1)
              {
                //$content .= '<hr style="margin-top:10px; margin-bottom:10px">';
              }
            }
        }
        return $content;
    }
}