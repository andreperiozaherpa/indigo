<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumentasi extends CI_Controller
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
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("kinerja/Lkh_model");
	}

    public function index()
    {
        $data['title']		    = 'Pendokumentasian Kinerja | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/dokumentasi/index";
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
        else{
            $param['all'] = true;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        $this->load->view('admin/main', $data);
    }

    public function get_data()
    {
        $tahun = $this->input->post("tahun");
        $bulan = $this->input->post("bulan");
        $id_pegawai = $this->input->post("id_pegawai");
        if($this->input->is_ajax_request() && $tahun && $bulan && $id_pegawai)
        {
            $data['content'] = $this->getContent($tahun,$bulan,$id_pegawai);
            echo json_encode($data);
        }
    }

    public function download()
    {
        $tahun = $this->input->get("tahun");
        $bulan = $this->input->get("bulan");
        $id_pegawai = $this->input->get("id_pegawai");
        $nama_skpd = $this->input->get("nama_skpd");
        if($tahun && $bulan && $id_pegawai)
        {
            $content = $this->getContent($tahun,$bulan,$id_pegawai,true);

            $data = '
            <p style="text-align:center"><b>PENDOKUMENTASIAN KINERJA '.'</b><br>PEMERINTAH KABUPATEN SUMEDANG<br>'.$nama_skpd.'</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <!-- <th>No</th> -->
                        <th>Hasil Kerja</th>
                        <th>Rencana Aksi</th>
                        <th>Realisasi</th>
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
            $pdf->Output('Perjanjian_Kerja.pdf', 'D');
        }
    }

    function getContent($tahun, $bulan, $id_pegawai,$download=false)
    {
        $this->load->model("kinerja/Dokumentasi_model");
        $content = $this->Dokumentasi_model->getContent($tahun, $bulan, $id_pegawai,$download);
        return $content;
    }
}