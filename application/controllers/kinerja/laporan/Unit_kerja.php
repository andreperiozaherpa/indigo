<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_kerja extends CI_Controller
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


        $this->acl_pegawai = ($this->user_level == "Administrator" || $this->role_pimpinan) ? true : false;

        $hasPrivilege = true;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Laporan_model");
	}

    public function index()
    {
        $data['title']		    = 'Laporan Pencapaian Unit Kerja | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/unit_kerja/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";

        $param = array();
        /* if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        } */

        $data['dt_skpd']        = $this->Skpd->get($param);

        $this->load->view('admin/main', $data);
    }

    public function get_data()
    {
        if($this->input->is_ajax_request())
        {
         $param = array();
            
			$data = array();

            $id_skpd = $this->input->post("id_skpd");
            $tahun = $this->input->post("tahun");
            $bulan = $this->input->post("bulan");

			$content = $this->getContent($id_skpd,$tahun,$bulan);
			
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
            $bulan = $this->input->get("bulan");

			$content = $this->getContent($id_skpd,$tahun,$bulan,true);

            $data = '
            <p style="text-align:center"><b>LAPORAN KINERJA UNIT KERJA '.'</b><br>PEMERINTAH KABUPATEN SUMEDANG<br>'.$nama_skpd.'</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>Unit Kerja</th>
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
            $pdf->Output('Laporan_pencapaian_unit_kerja.pdf', 'D');
        }
    }


    private function getContent($id_skpd,$tahun,$bulan,$download=false)
    {
        $this->load->model("sicerdas/Skpd_model");
        $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($id_skpd);

        $content = '';
        foreach($dt_unit_kerja as $key=>$row)
        {
            $btn_aksi = '';
            if(!$download && $this->acl_pegawai)
            {
                $link =  base_url()."/kinerja/laporan/pegawai?id_skpd=".$row->id_skpd.'&id_unit_kerja='.$row->id_unit_kerja."&tahun=".$tahun."&bulan=".$bulan;
                $btn_aksi = '<td><a target="_blank" href="'.$link.'" class="btn btn-default btn-outline btn-sm">Detail</a></td>';
            }

            

            $margin_left = '0';
            $pad='';
            if($row->level_unit_kerja==2)
            {
              $margin_left = '20';
              $pad = ($download) ? '&nbsp;&nbsp;' : '';
            }
            else if($row->level_unit_kerja==3)
            {
              $margin_left = '40';
              $pad = ($download) ? '&nbsp;&nbsp;&nbsp;&nbsp;' : '';
            }
            else if($row->level_unit_kerja==4)
            {
              $margin_left = '60';
              $pad = ($download) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '';
            }

            $capaian = 0;
            
            

            $param = array();
            $param['where']['pegawai.id_skpd'] = $id_skpd;
            $param['where']['skp.tahun'] = $tahun;

            $ids_unit_kerja = array($row->id_unit_kerja);
            if($row->id_unit_kerja_bawahan)
            {
                $ids_unit_kerja = array_merge($ids_unit_kerja,$row->id_unit_kerja_bawahan);
            }

            $param['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$ids_unit_kerja).") )";

            if($bulan)
            {
                $param['bulan'] = $bulan;
            }
            
            $result = $this->Laporan_model->getSummary($param)->row();

            if($result)
            {
                $capaian = $result->capaian;
            }


            $content .= '
            <tr>
                <td><span style="margin-left:'.$margin_left.'px">'.$pad.$row->nama_unit_kerja.'</span></td>
                <td>'.number_format($capaian,1).'</td>
                '.$btn_aksi.'
            </tr>
            ';
        }

        return $content;
    }

    public function test()
    {
        $this->load->model("sicerdas/Skpd_model");
        $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,278);
        echo "<pre>";print_r($dt_unit_kerja[0]->id_unit_kerja_bawahan);die;
    }
    

}