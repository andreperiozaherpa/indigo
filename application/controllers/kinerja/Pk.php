<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pk extends CI_Controller
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


        $hasPrivilege = ($this->user_level == 'Administrator' || $this->role_pimpinan) ;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");

        $this->load->model("sicerdas/renstra/Sasaran_model");
        $this->load->model("sicerdas/renstra/Sasaran_indikator_model");
	}

    public function index()
    {
        $data['title']		    = 'Perjanjian Kerja | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/pk/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "pk";

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
    
            if($this->input->post("id_skpd"))
            {
                $param['where']['sasaran.id_skpd'] = $this->input->post("id_skpd");
            }

            

            $result = $this->Sasaran_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $param_indikator['where']['indikator.id_sasaran_renstra'] = $row->id_sasaran_renstra;
                $dt_indikator = $this->Sasaran_indikator_model->get($param_indikator)->result();

                $content .= '
					<tr>
                     	<td><b>'.($offset+1).'</b></td>
                     	<td><b>'.$row->nama_sasaran_renstra.'</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                  	</tr>
				';

                foreach($dt_indikator as $indikator)
                {
                    $tahun = "target_tahun_" . $this->input->post("tahun");
                    $content .= '
					<tr>
                     	<td></td>
                     	<td></td>
                        <td>'.$indikator->nama_indikator_sasaran_renstra.'</td>
                        <td>'.$indikator->$tahun.'</td>
                        <td>'.$indikator->satuan_desc.'</td>
                  	</tr>
				';
                }


                $offset++;
            }

			if(!$result)
			{
				$content = '<tr><td colspan="5" align="center">-Belum ada data-</td></tr>';
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

    public function download()
    {
        

        $param = array();
            
        $data = array();

        if($this->input->get("id_skpd") && $this->input->get("tahun"))
        {
            $param['where']['sasaran.id_skpd'] = $this->input->get("id_skpd");
        

            $result = $this->Sasaran_model->get($param)->result();

            


            $content = '';
            $offset = 0;
            foreach($result as $key=>$row)
            {
                $param_indikator['where']['indikator.id_sasaran_renstra'] = $row->id_sasaran_renstra;
                $dt_indikator = $this->Sasaran_indikator_model->get($param_indikator)->result();

                $content .= '
                    <tr>
                        <td width="5%"><b>'.($offset+1).'</b></td>
                        <td width="30%"><b>'.$row->nama_sasaran_renstra.'</b></td>
                        <td width="35%"></td>
                        <td width="15%"></td>
                        <td width="15%"></td>
                    </tr>
                ';

                foreach($dt_indikator as $indikator)
                {
                    $tahun = "target_tahun_" . $this->input->get("tahun");
                    $content .= '
                    <tr>
                        <td width="5%"></td>
                        <td width="30%"></td>
                        <td width="35%">'.$indikator->nama_indikator_sasaran_renstra.'</td>
                        <td width="15%">'.$indikator->$tahun.'</td>
                        <td width="15%">'.$indikator->satuan_desc.'</td>
                    </tr>
                ';
                }


                $offset++;
            }

            if(!$result)
            {
                $content = '<tr><td colspan="5" align="center">-Belum ada data-</td></tr>';
            }

            $param_skpd['where']['skpd.id_skpd'] = $this->input->get("id_skpd");
            $dt_skpd = $this->Skpd->get($param_skpd)->row();
            $nama_skpd = ($dt_skpd) ? $dt_skpd->nama_skpd : "";


            $data = '
            <p style="text-align:center"><b>PERJANJIAN KINERJA TAHUN '.$this->input->get("label_tahun").'</b><br>'.$nama_skpd.'</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th width="5%">No</th>
                        <th width="30%">Sasaran Kinerja</th>
                        <th width="35%">Indikator Kinerja</th>
                        <th width="15%">Target</th>
                        <th width="15%">Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    '.$content.'
                </tbody>
            </table>
            ';

            //echo $data;

            $this->load->library('pdf');

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->setPrintFooter(false);
                $pdf->setPrintHeader(false);
                $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                $pdf->AddPage('L');

                $pdf->writeHTML($data);
                ob_end_clean();
                $pdf->Output('Perjanjian_Kerja.pdf', 'D');
        }
    }
}