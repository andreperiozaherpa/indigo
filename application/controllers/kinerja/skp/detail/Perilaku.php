<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perilaku extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Skp_model");
        
	}


    public function download($token)
    {
        
        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }
        $header = '
            <tr>
                <th width="5%">No</th>
                <th width="40%">Perilaku</th>
                <th width="26%">Ekspektasi Khusus Pimpinan / Leader</th>
            </tr>';

        
        

        $content = $this->Perilaku_model->getContent($detail->id_skp,true);
        
        $html = '
            <p style="text-align:center"><b>PERILAKU KERJA/BEHAVIOR</b><br>
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

        //echo $html;die;

        $this->load->library('pdf');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('L');

        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('Perilaku_kerja_'.$detail->nama_lengkap.'_tahun_'.$detail->tahun_desc.'.pdf', 'I');
    }

    public function get_data()
    {
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request() && $id_skp)
        {
            
            $content = $this->Perilaku_model->getContent($id_skp);
            
            
            //$data['result']     = $result;
            $data['content'] 	= $content;
            echo json_encode($data);


        }
    }

    
}