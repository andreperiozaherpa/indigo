<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instruksi extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Laporan_model");
        
        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();
        $this->pegawai = $dt_pegawai;

        
	}

    public function download($token)
    {
        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }

        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));

        $header = '';

        if($role_pimpinan){
            $header = '
                <tr>
                <th>No</th>
                <th>Rencana Hasil Kerja</th>
                <th>Indikator Kinerja Individu</th>
                <th>Target</th>
                <th>Satuan</th>
                <th>Perspektif</th>
            </tr>';
        }
        else{
            $header ='
            <tr>
                <th>No</th>
                <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                <th>Rencana Hasil Kerja</th>
                <th>Aspek</th>
                <th>Indikator Kinerja Individu</th>
                <th>Target</th>
                <th>Satuan</th>
            </tr>';
        }

        

        $content = $this->Instruksi_model->getContent($detail,true);
        
        $html = '
            <p style="text-align:center"><b>INSTRUKSI KHUSUS PIMPINAN</b><br>
            '.strtoupper($detail->nama_lengkap).'<br>
            TAHUN '.$detail->tahun_desc.'</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    '.$header.'
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

        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('Instruksi_khusus_pimpinan_'.$detail->nama_lengkap.'_tahun_'.$detail->tahun_desc.'.pdf', 'D');
    }


    public function get_data()
    {
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request() && $id_skp)
        {
            $param_detail['where']['skp.id_skp'] = $id_skp;
            $detail = $this->Skp_model->get($param_detail)->row();
            
            $content = $this->Instruksi_model->getContent($detail);
            
            //$data['result']     = $result;
            $data['content'] 	= $content;
            echo json_encode($data);


        }
    }

}