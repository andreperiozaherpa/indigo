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
        $this->load->model("sicerdas/renstra/Kegiatan_model");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Laporan_model");
	}

    public function index()
    {
        $data['title']		    = 'Laporan Kegiatan | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/kegiatan/index";
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

            if($this->input->post("id_skpd"))
            {
                $param['where']['sasaran.id_skpd'] = $this->input->post("id_skpd");
            }
    
            if($this->input->post("id_program_renstra"))
            {
                $param['where']['renstra_program.id_program_renstra'] = $this->input->post("id_program_renstra");
            }

            if($this->input->post("id_indikator_program_renstra"))
            {
                $param['where']['program_indikator.id_indikator_program_renstra'] = $this->input->post("id_indikator_program_renstra");
            }

           
			if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }


            $result = $this->Kegiatan_model->get($param)->result();

			$content = $this->getContent($result,$offset,false,$_POST);
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
        $tahun = $this->input->get("tahun");
        $bulan = $this->input->get("bulan");
        $id_skpd = $this->input->get("id_skpd");
        $nama_skpd = $this->input->get("nama_skpd");
        if($tahun && $id_skpd)
        {
            $param = array();
            if($this->input->get("id_skpd"))
            {
                $param['where']['sasaran.id_skpd'] = $this->input->get("id_skpd");
            }
    
            if($this->input->get("id_program_renstra"))
            {
                $param['where']['renstra_program.id_program_renstra'] = $this->input->get("id_program_renstra");
            }

            if($this->input->get("id_indikator_program_renstra"))
            {
                $param['where']['program_indikator.id_indikator_program_renstra'] = $this->input->get("id_indikator_program_renstra");
            }

           
			if($this->input->get("search"))
            {
                $param['search'] = $this->input->get("search");
            }

            $result = $this->Kegiatan_model->get($param)->result();

            $content = $this->getContent($result,0,true,$_GET);

            $data = '
            <p style="text-align:center"><b>LAPORAN KEGIATAN</b></p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>Sasaran</th>
                        <th>Program / Indikator</th>
                        <th>Kegiatan</th>
                        <th>Capaian (%)</th>
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
            $pdf->Output('Laporan_kegiatan.pdf', 'D');
        }
    }


    private function getContent($data,$offset=0,$download=false,$filter=array())
    {
        $content = '';
        $ids = array();
        foreach($data as $row)
        {
            $ids[] = $row->id_kegiatan;
        }

        if($ids)
        {
            $param = array();
            $tahun = '';
            $bulan = '';
            if(!empty($filter['tahun']))
            {
                $param['where']['skp.tahun'] = $filter['tahun'];
                $tahun = $filter['tahun'];
            }
            if(!empty($filter['bulan']))
            {
                $param['bulan'] = $filter['bulan'];
                $bulan = $filter['bulan'];
            }

           

            $param['group_by'] = "kegiatan";
            $param['str_where'] = "(cascading.id_kegiatan in (".implode(",",$ids).") )";

            $summary = $this->Laporan_model->getSummary($param)->result();

            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_kegiatan] = $s;
            }

            foreach($data as $key=>$row)
            {
                
                $btn_aksi = '';
                if(!$download)
                {
                    $link = base_url()."/kinerja/laporan/sub_kegiatan?id_program_renstra=".$row->id_program_renstra."&id_indikator_program_renstra=".$row->id_indikator_program_renstra."&id_kegiatan=".$row->id_kegiatan.'&id_skpd='.$row->id_skpd.'&tahun='.$tahun."&bulan=".$bulan;
                    $btn_aksi = '<td>
                        <a href="'.$link.'" target="_blank" class="btn btn-sm btn-default" >Detail</a>
                    </td>';
                }
    
                $offset++;
    
                $capaian = 0;

                if(!empty($dt_capaian[$row->id_kegiatan]))
                {
                    $capaian = number_format($dt_capaian[$row->id_kegiatan]->capaian,2);
                }

                $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.$row->nama_sasaran_renstra.'</td>
                    <td>'.$row->nama_program.' /<br>'.$row->nama_indikator_program_rpjmd.'</td>
                    <td><b>'.$row->nama_kegiatan.'</b></td>
                    <td>'.$capaian.'</td>
                    '.$btn_aksi.'
                </tr>
                ';
            }
        }

        return $content;
    }
    
}