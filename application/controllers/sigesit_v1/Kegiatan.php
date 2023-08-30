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
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);

		if ($this->user_level == "Administrator" OR in_array('sigesit', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sigesit/Globalvar");
		$this->load->model("sigesit/Program_model");
        $this->load->model("sigesit/Kegiatan_model");
        $this->load->model("sigesit/Penerima_model");
		$this->load->model("Ref_skpd_model");
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

            $param['where']['kegiatan.id_skpd'] = $this->input->post("id_skpd");
            $result = $this->Kegiatan_model->get($param)->result();

            /* if($this->input->post("penganggaran")==1){
                $ids_kegiatan = array();
                foreach($result as $row)
                {
                    $ids_kegiatan[] = $row->id_kegiatan;
                }
    
                $total = array();
                if($ids_kegiatan)
                {
                    $param_total['str_where'] = "(penerima.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_total['group_by'] = "id_kegiatan";
                    $dt_total = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total as $row)
                    {
                        $total[$row->id_kegiatan] = $row->total;
                    }
                }
            } */

			$content = '';
            foreach($result as $key=>$row)
            {
				$token = md5("KEGIATAN".$row->id_kegiatan) ;

                $btn_action = '';
                $target_penyesuaian = '';

                $total_anggaran = '<td>'.number_format($row->total_anggaran).'</td>';

                if($this->input->post("perencanaan")==1)
                {
                    $total_anggaran = '';
                }
                if($this->input->post("penganggaran")==1)
                {
                    //$target = (isset($total[$row->id_kegiatan])) ? $total[$row->id_kegiatan] : 0;
                    $target = ($row->target_anggaran) ? $row->target_anggaran." ".$row->satuan_anggaran : $row->target.' '.$row->satuan;
                    $target_penyesuaian = '<td>'.$target.'</td>';
                    $btn_action = '<a class="btn btn-outline btn-primary" href="'.base_url().'sigesit/penganggaran/detail/'.$token.'">Detail</a>';
                }
                else{
                    $btn_action = '<a class="btn btn-outline btn-primary" href="'.base_url().'sigesit/kegiatan/detail/'.$token.'">Detail</a>';
                }

                $content .= '
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$row->nama_program.'</td>
                        <td>'.$row->nama_kegiatan.'</td>
                        <td>'.$row->nama_sub_kegiatan.'</td>
                        <td>'.$row->output_kegiatan.'</td>
                        <td>'.$row->target.' '.$row->satuan.'</td>
                        '.$target_penyesuaian.'
                        <td>'.$row->sasaran.'</td>
                        <td>'.number_format($row->rencana_anggaran).'</td>
                        '.$total_anggaran.'
                        <td>
                            '.$btn_action.'
                        </td>
                    </tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<tr>
                    <td colspan="11" align="center">Belum ada data</td>
                </tr>
				';
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

    public function detail($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/perencanaan/kegiatan/detail";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['select','sweetalert','rangeslider','rangeslider_sigesit'];

		$data['token'] = $token;

		$param['where']["md5(concat('KEGIATAN',kegiatan.id_kegiatan))"] = $token;
		$detail = $this->Kegiatan_model->get($param)->row();

        //echo "<pre>";print_r($param);die;
		if($detail)
		{
            $data['dt_kecamatan'] = $this->Globalvar->get_kecamatan();
            $data['dt_rts'] = $this->Globalvar->get_rts();
			$data['dt_sasaran'] = $this->Globalvar->get_sasaran();

            $data['dt_alokasi_anggaran'] = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_alokasi_anggaran")->result();


			$data['detail'] = $detail;
			
			$this->load->view('admin/main', $data);
		}
		else{
			show_404();
		}
		
		
	}


	public function add($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/perencanaan/kegiatan/add";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['sweetalert','select','rangeslider','rangeslider_sigesit'];

		$param['where']["md5(concat('SKPD',id_skpd))"] = $token;
		$detail = $this->Ref_skpd_model->get($param)->row();

		if($detail)
		{
            $this->Penerima_model->clear_temp($this->user_id);

			$data['dt_program'] = $this->Program_model->get_perencanaan($detail->id_skpd)->result();
			$data['dt_tahun'] = $this->Globalvar->get_tahun();
            $data['dt_sumber_anggaran'] = $this->Globalvar->get_sumber_anggaran();
            $data['dt_kecamatan'] = $this->Globalvar->get_kecamatan();
            $data['dt_rts'] = $this->Globalvar->get_rts();
            $data['dt_sasaran'] = $this->Globalvar->get_sasaran();
			
			$data['detail'] = $detail;
            $data['token'] = $token;
			//echo "<pre>";print_r($detail);die;
			$this->load->view('admin/main', $data);
		}
		else{
			show_404();
		}
		
	}

    public function edit($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/perencanaan/kegiatan/edit";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['sweetalert','select','rangeslider','rangeslider_sigesit'];

		$param['where']["md5(concat('KEGIATAN',kegiatan.id_kegiatan))"] = $token;
		$detail = $this->Kegiatan_model->get($param)->row();

		if($detail)
		{
            $this->Penerima_model->clear_temp($this->user_id);
            $this->Penerima_model->add_temp($detail->id_kegiatan, $this->user_id);
            

			$data['dt_program'] = $this->Program_model->get_perencanaan($detail->id_skpd)->result();
            $data['dt_kegiatan'] = $this->Kegiatan_model->get_kegiatan($detail->id_ref_program)->result();
            $data['dt_sub_kegiatan'] = $this->Kegiatan_model->get_sub_kegiatan($detail->id_ref_kegiatan)->result();
			$data['dt_tahun'] = $this->Globalvar->get_tahun();
            $data['dt_sumber_anggaran'] = $this->Globalvar->get_sumber_anggaran();
            $data['dt_kecamatan'] = $this->Globalvar->get_kecamatan();
            $data['dt_rts'] = $this->Globalvar->get_rts();
            $data['dt_sasaran'] = $this->Globalvar->get_sasaran();
            $data['dt_alokasi_anggaran'] = $this->Kegiatan_model->get_alokasi_anggaran($detail->id_kegiatan)->result();
			
			$data['detail'] = $detail;
            $data['token'] = $token;
			//echo "<pre>";print_r($detail);die;
			$this->load->view('admin/main', $data);
		}
		else{
			show_404();
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
                        'field' => 'tahun',
                        'label' => 'Tahun',
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
                    [
                        'field' => 'id_ref_kegiatan',
                        'label' => 'Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_ref_sub_kegiatan',
                        'label' => 'Sub Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'output_kegiatan',
                        'label' => 'Output Kegiatan',
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
                        'field' => 'id_sumber_anggaran',
                        'label' => 'Sumber Anggaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'rencana_anggaran',
                        'label' => 'Total Anggaran',
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
                    $alokasi_anggaran = $this->input->post("alokasi_anggaran");
                    $total_alokasi = 0;
                    if(isset($alokasi_anggaran['nama_kegiatan']))
                    {
                        foreach($alokasi_anggaran['nama_kegiatan'] as $key => $value)
                        {
                            $jumlah = isset($alokasi_anggaran['jumlah'][$key]) ? $alokasi_anggaran['jumlah'][$key] : 0;
                            $harga = isset($alokasi_anggaran['harga'][$key]) ? str_replace(",","",$alokasi_anggaran['harga'][$key]) : 0;
                            $total = ($jumlah * $harga);
                            $total_alokasi += $total;
                        }
                        
                    }

                    $rencana_anggaran = str_replace(",","",$post_data['rencana_anggaran']);

                    if($rencana_anggaran == $total_alokasi)
                    {
                        $dt = array(
                            'tahun'   => $post_data['tahun'],
                            'id_ref_program'    => $post_data['id_ref_program'],
                            'id_ref_kegiatan'    => $post_data['id_ref_kegiatan'],
                            'id_ref_sub_kegiatan'    => $post_data['id_ref_sub_kegiatan'],
                            'output_kegiatan'    => $post_data['output_kegiatan'],
                            'target'    => $post_data['target'],
                            'satuan'    => $post_data['satuan'],
                            'id_sumber_anggaran'    => $post_data['id_sumber_anggaran'],
                            'rencana_anggaran'    => str_replace(",","",$post_data['rencana_anggaran']),
                            'sasaran'    => $post_data['sasaran'],
                            'id_skpd'    => $post_data['id_skpd'],
                        );
                        if($this->input->post("action")=="edit"){
                            $this->Kegiatan_model->update($dt,$post_data['id_kegiatan']);
                            $data['message'] = "Kegiatan berhasil diubah";
                            $id_kegiatan = $post_data['id_kegiatan'];
                        }
                        else if($this->input->post("action")=="add"){
                            $id_kegiatan = $this->Kegiatan_model->insert($dt);
                            $data['message'] = "Kegiatan berhasil disimpan";
                        }
                        else{
                            $data['message'] = "Error";
                            $data['status'] = FALSE;
                        }

                        if(!empty($id_kegiatan))
                        {
                            // alokasi
                            
                            if(isset($alokasi_anggaran['nama_kegiatan']))
                            {
                                foreach($alokasi_anggaran['nama_kegiatan'] as $key => $value)
                                {
                                    $jumlah = isset($alokasi_anggaran['jumlah'][$key]) ? $alokasi_anggaran['jumlah'][$key] : 0;
                                    $harga = isset($alokasi_anggaran['harga'][$key]) ? str_replace(",","",$alokasi_anggaran['harga'][$key]) : 0;
                                    $satuan = isset($alokasi_anggaran['satuan'][$key]) ? $alokasi_anggaran['satuan'][$key] : '';
                                    $total = ($jumlah * $harga);
                                    $alokasi = array(
                                        'nama_kegiatan'     => $value,
                                        'jumlah'            => $jumlah,
                                        'harga'             => $harga,
                                        'satuan'            => $satuan,
                                        'total'             => $total,
                                        'id_kegiatan'       => $id_kegiatan
                                    );

                                    $id_alokasi_anggaran = isset($alokasi_anggaran['id_alokasi_anggaran'][$key]) ? $alokasi_anggaran['id_alokasi_anggaran'][$key] : 0;

                                    if($id_alokasi_anggaran)
                                    {
                                        $this->db
                                        ->where("id_alokasi_anggaran",$id_alokasi_anggaran)
                                        ->update("sigesit_alokasi_anggaran",$alokasi);
                                    }
                                    else{
                                        $this->db->insert("sigesit_alokasi_anggaran",$alokasi);
                                    }

                                    
                                }
                            }

                            // penerima
                            $this->db->where("id_kegiatan",$id_kegiatan)->delete("sigesit_penerima_bantuan");

                            $param_temp['where']['temp.user_id'] = $this->user_id;
                            $dt_temp = $this->Penerima_model->get_temp($param_temp)->result();
                            foreach($dt_temp as $row)
                            {
                                $penerima = array(
                                    'id_kegiatan'   => $id_kegiatan,
                                    'id_dtks'       => $row->id_dtks,
                                );
                                $this->db->insert("sigesit_penerima_bantuan",$penerima);
                            }

                            $this->db->where("user_id",$this->user_id)->delete("sigesit_penerima_bantuan_temp");
                        }
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Jumlah anggaran dan rincian harus sama.";
                    }
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }

    public function get_kegiatan()
    {
        $content = '<option value="">Pilih</option>';
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $dt = $this->Kegiatan_model->get_kegiatan($id);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_ref_kegiatan.'">'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }


    public function get_sub_kegiatan()
    {
        $content = '<option value="">Pilih</option>';
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $dt = $this->Kegiatan_model->get_sub_kegiatan($id);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_ref_sub_kegiatan.'">'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_desa()
    {
        $content = '<option value="">Pilih</option>';
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $dt = $this->Globalvar->get_desa($id);
            foreach($dt as $row)
            {
                $content .= '<option value="'.$row->id_desa.'">'.$row->desa.'</option>';
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
                
                $status = $this->Kegiatan_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Kegiatan berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus program";
                    }
                
                echo json_encode($data);
            }           
        }
    }

}