<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skpd extends CI_Controller
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

        $hasPrivilege = true;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("kinerja/Laporan_model");
	}

    public function index()
    {
        $data['title']		    = 'Laporan Pencapaian Kinerja SKPD | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/skpd/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";


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

            $result = $this->Skpd_model->get($param)->result();

			$content = $this->getContent($result,$offset,false,$_POST);
			if(!$result)
			{
				$content = '<tr><td colspan="4" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Skpd_model->get($param)->num_rows();


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
        if($tahun)
        {
            $param = array();
            if($this->input->get("search"))
            {
                $param['search'] = $this->input->get("search");
            }

            $result = $this->Skpd_model->get($param)->result();

			$content = $this->getContent($result,0,false,$_GET);

            $data = '
            <p style="text-align:center"><b>LAPORAN PENCAPAIAN KINERJA SKPD '.'</b><br>PEMERINTAH KABUPATEN SUMEDANG</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>Nama SKPD</th>
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
            $pdf->AddPage('P');

            $pdf->writeHTML($data);
            ob_end_clean();
            $pdf->Output('Laporan_pencapaian_kinerja_skpd.pdf', 'D');
        }
    }


    private function getContent($data,$offset=0,$download=false,$filter=array())
    {
        $content = '';

        $ids = array();

        foreach($data as $row)
        {
            $ids[] = $row->id_skpd;
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

            $param['group_by'] = "skpd";

            $summary = $this->Laporan_model->getSummary($param)->result();

            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_skpd] = $s;
            }

            foreach($data as $key=>$row)
            {
                $btn_aksi = '';
                if(!$download)
                {
                    $link =  base_url()."/kinerja/laporan/unit_kerja?id_skpd=".$row->id_skpd.'&tahun='.$tahun."&bulan=".$bulan;
                    $btn_aksi = '<td><a target="_blank" href="'.$link.'" class="btn btn-default btn-outline btn-sm">Detail</a></td>';
                }
    
                $offset++;

                $capaian = 0;

                if(!empty($dt_capaian[$row->id_skpd]))
                {
                    $capaian = number_format($dt_capaian[$row->id_skpd]->capaian,2);
                }
    
                $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.$row->nama_skpd.'</td>
                    <td>'.$capaian.'</td>
                    '.$btn_aksi.'
                </tr>
                ';
            }
        }


        return $content;
    }
    
}