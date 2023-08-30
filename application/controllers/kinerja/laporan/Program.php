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
		$this->id_skpd	= $this->user_model->id_skpd;
		$array_privileges = explode(';', $this->user_privileges);

        $this->load->model("sicerdas/Pegawai_model");
        $param_pegawai['where']['pegawai.id_user'] = $this->session->id_user;
        $param_pegawai['where']['pegawai.pensiun'] = 0;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        $hasPrivilege = ($this->user_level == "Administrator" || $this->role_pimpinan || in_array('program', $array_privileges)) ? true : false;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Laporan_model");
        $this->load->model("kinerja/Realisasi_program_model");
        $this->load->model("sicerdas/renstra/Program_model");
        $this->load->model("sicerdas/renstra/Program_indikator_model");
	}

    public function test()
    {
        $ids = [17,18,19];
        $param['str_where'] = "(indikator.id_program_renstra in (".implode(",",$ids).") )";
            $param['group_by'] = "program";
            $param['where']['realisasi.tahun'] = 4;
            $summary = $this->Realisasi_program_model->getSummary($param)->result();

            echo "<pre>";print_r($summary);
    }

    public function index()
    {
        $data['title']		    = 'Laporan Program | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/program/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        $this->load->view('admin/main', $data);
    }

    public function detail()
    {
        $data['title']		    = 'Laporan Program | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/program/detail";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

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
            if($this->input->post("id_sasaran_renstra"))
            {
                $param['where']['sasaran.id_sasaran_renstra'] = $this->input->post("id_sasaran_renstra");
            }
            

            $result = $this->Program_model->get($param)->result();

			$content = $this->getContent($result,$this->input->post("tahun"),$offset);
            

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


    public function download()
    {
        $tahun = $this->input->get("tahun");
        $id_skpd = $this->input->get("id_skpd");
        $nama_skpd = $this->input->get("nama_skpd");
        if($tahun && $id_skpd)
        {
            $param = array();
            if($this->input->get("id_sasaran_renstra"))
            {
                $param['where']['sasaran.id_sasaran_renstra'] = $this->input->get("id_sasaran_renstra");
            }

            $param['where']['sasaran.id_skpd'] = $id_skpd;

            $result = $this->Program_model->get($param)->result();

            $content = $this->getContent($result,$tahun,0,true);

            $data = '
            <p style="text-align:center"><b>LAPORAN PROGRAM</b></p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>Sasaran</th>
                        <th>Program</th>
                        <th>Kinerja (%)</th>
                        <th>Anggaran (%)</th>
                    </tr>
                </thead>
                <tbody>
                    '.$content.'
                </tbody>
            </table>
            ';

            $this->load->library('pdf');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(false);
            $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
            $pdf->AddPage('L');

            $pdf->writeHTML($data);
            ob_end_clean();
            $pdf->Output('Laporan_program.pdf', 'D');
        }
    }

    public function download_detail()
    {
        $tahun = $this->input->get("tahun");
        $id_skpd = $this->input->get("id_skpd");
        $nama_skpd = $this->input->get("nama_skpd");
        if($tahun && $id_skpd)
        {
            $param = array();
            if($this->input->get("id_sasaran_renstra"))
            {
                $param['where']['sasaran.id_sasaran_renstra'] = $this->input->get("id_sasaran_renstra");
            }
            if($this->input->get("id_program_renstra"))
            {
                $param['where']['indikator.id_program_renstra'] = $this->input->get("id_program_renstra");
            }

            $param['where']['sasaran.id_skpd'] = $id_skpd;

            $result = $this->Program_indikator_model->get($param)->result();

            
            foreach($result as $key => $row)
            {
                

                $param_realisasi['where']['realisasi.tahun'] = $tahun;
                $param_realisasi['where']['indikator.id_program_renstra'] = $row->id_program_renstra;
                $dt_realisasi = $this->Realisasi_program_model->get($param_realisasi)->row();

                $result[$key]->realisasi = $dt_realisasi;

                $result[$key]->capaian = ($dt_realisasi) ? $dt_realisasi->capaian : 0;
                $result[$key]->capaian_rp = ($dt_realisasi) ? $dt_realisasi->capaian_rp : 0;
            }

            $content = $this->getContentDetail($result,0,true);

            $data = '
            <p style="text-align:center"><b>LAPORAN DETAIL PROGRAM</b></p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>Sasaran</th>
                        <th>Program</th>
                        <th>Indikator</th>
                        <th>Metode</th>
                        <th>Kinerja (%)</th>
                        <th>Anggaran (%)</th>
                    </tr>
                </thead>
                <tbody>
                    '.$content.'
                </tbody>
            </table>
            ';

            $this->load->library('pdf');

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setPrintFooter(false);
            $pdf->setPrintHeader(false);
            $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
            $pdf->AddPage('L');

            $pdf->writeHTML($data);
            ob_end_clean();
            $pdf->Output('Laporan_program_detail.pdf', 'D');
        }
    }


    private function getContent($data,$tahun,$offset=0,$download=false)
    {
        $content = '';
        $ids = array();
        foreach($data as $row)
        {
            $ids[] = $row->id_program_renstra;
        }

        if($ids)
        {
            $param['str_where'] = "(indikator.id_program_renstra in (".implode(",",$ids).") )";
            $param['group_by'] = "program";
            $param['where']['realisasi.tahun'] = $tahun;
            $summary = $this->Realisasi_program_model->getSummary($param)->result();
            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_program_renstra] = $s;
            }

            
    
            foreach($data as $key=>$row)
            {
                $link = base_url().'/kinerja/laporan/program/detail?id_program_renstra='.$row->id_program_renstra.'&id_skpd='.$row->id_skpd.'&id_sasaran_renstra='.$row->id_sasaran_renstra.'&tahun='.$tahun;
                $capaian = 0;
                $capaian_rp = 0;


                if(!empty($dt_capaian[$row->id_program_renstra]))
                {
                    $capaian = number_format($dt_capaian[$row->id_program_renstra]->capaian,0);
                    $capaian_rp = number_format($dt_capaian[$row->id_program_renstra]->capaian_rp,0);
                }

                $content .= '
                    <tr>
                        <td>'.($offset+1).'</td>
                        <td>'.$row->nama_sasaran_renstra.'</td>
                        <td>'.$row->kode_program.' - '.$row->nama_program.'</td>
                        <td>'.$capaian.'</td>
                        <td>'.$capaian_rp.'</td>
                        <td><a href="'.$link.'" class="btn btn-default btn-outline btn-sm" ><i class="ti-eye"></i> Detail</a></td>
                    </tr>
                ';
                $offset++;
            }

        }

        return $content;
    }

    private function getContentDetail($data,$offset=0,$download=false)
    {
        $content = '';

        foreach($data as $key=>$row)
        {

            $content .= '
                <tr>
                    <td>'.($offset+1).'</td>
                    <td>'.$row->nama_sasaran_renstra.'</td>
                    <td>'.$row->kode_program.' - '.$row->nama_program.'</td>
                    <td>'.$row->nama_indikator_program_renstra.'</td>
                    <td>'.$row->metode.'</td>
                    <td>'.$row->capaian.'</td>
                    <td>'.$row->capaian_rp.'</td>
                    <td><a href="javascript:update_capaian('.$key.')"class="btn btn-default btn-outline btn-sm" ><i class="ti-pencil"></i> Update Capaian</a></td>
                </tr>
            ';
            $offset++;
        }

        return $content;
    }
    

    public function get_sasaran()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
            $this->load->model("sicerdas/renstra/Sasaran_model");
            $param['where']['sasaran.id_skpd'] = $this->input->post("id_skpd");
		    $dt = $this->Sasaran_model->get($param);

            foreach($dt->result() as $row)
            {
                $selected = ($row->id_sasaran_renstra == $this->input->post("id_sasaran_renstra"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_sasaran_renstra.'">'.$row->nama_sasaran_renstra.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
    
    public function get_program()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_sasaran_renstra"))
        {
            $param['where']['renstra_program.id_sasaran_renstra'] = $this->input->post("id_sasaran_renstra");

            $dt = $this->Program_model->get($param);

            foreach($dt->result() as $row)
            {
                $selected = ($row->id_program_renstra == $this->input->post("id_program_renstra"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_program_renstra.'">'.$row->nama_program.'</option>';
            }          
        }
        $data['post']=$_POST;
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_detail($rowno=1)
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
            if($this->input->post("id_sasaran_renstra"))
            {
                $param['where']['sasaran.id_sasaran_renstra'] = $this->input->post("id_sasaran_renstra");
            }
            if($this->input->post("id_program_renstra"))
            {
                $param['where']['indikator.id_program_renstra'] = $this->input->post("id_program_renstra");
            }
            

            $result = $this->Program_indikator_model->get($param)->result();

            $tahun = $this->input->post("tahun");

            foreach($result as $key => $row)
            {
                

                $param_realisasi['where']['realisasi.tahun'] = $tahun;
                $param_realisasi['where']['indikator.id_program_renstra'] = $row->id_program_renstra;
                $dt_realisasi = $this->Realisasi_program_model->get($param_realisasi)->row();

                $result[$key]->realisasi = $dt_realisasi;

                $result[$key]->capaian = ($dt_realisasi) ? $dt_realisasi->capaian : 0;
                $result[$key]->capaian_rp = ($dt_realisasi) ? $dt_realisasi->capaian_rp : 0;
            }

			$content = $this->getContentDetail($result,$offset);
            

			if(!$result)
			{
				$content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Program_indikator_model->get($param)->num_rows();


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

    public function save_realisasi()
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

                $post_data['hitung_otomatis'] = ($this->input->post("hitung_otomatis")) ? $this->input->post("hitung_otomatis") : "N";

                $this->load->library('form_validation');

                $this->form_validation->set_data( $post_data );

                
                $validation_rules = [
                    [
                        'field' => 'id_indikator_program_renstra',
                        'label' => 'Indikator',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'realisasi',
                        'label' => 'Realisasi kinerja',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'realisasi_rp',
                        'label' => 'Realisasi anggaran',
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
                    [
                        'field' => 'tahun_desc',
                        'label' => 'Tahun',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target',
                        'label' => 'Target kinerja',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'target_rp',
                        'label' => 'Target anggaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'hitung_otomatis',
                        'label' => 'Hitung otomatis',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                ];

                

                $this->form_validation->set_rules( $validation_rules );

				$errors = array();

                $data['post_data'] = $post_data;
                
                if( $this->form_validation->run() && !$errors)
                {
                    $status = $this->Realisasi_program_model->save($post_data);

                    if($status)
                    {
                        $data['message'] = "Realisasi berhasil disimpan";
                    }
                    else{
                        $data['status'] = false;
                        $data['message'] = "Gagal menyimpan data";
                    }
                }
                else{
                    $err = $this->form_validation->error_array();
					$errors = array_merge($errors,$err);
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                }
                
                echo json_encode($data);
            }           
        }   
    }
}