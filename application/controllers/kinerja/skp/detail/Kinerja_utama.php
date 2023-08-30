<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kinerja_utama extends CI_Controller
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
        $this->load->model("kinerja/Kinerja_utama_model");
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
                <th>Kegiatan / Sub Kegiatan</th>
                <th>Indikator Kinerja Individu</th>
                <th>Target</th>
                <th>Satuan</th>
            </tr>';
        }

        

        $content = $this->Kinerja_utama_model->getContent($detail);
        
        $html = '
            <p style="text-align:center"><b>KINERJA UTAMA</b><br>
            TAHUN '.$detail->tahun_desc.'</p>
            <table width="100%" border="0" cellpadding="3">
                <tr>
                    <td width="50%" align="left" colspan="3"><b>PEGAWAI YANG DINILAI</b></td>
                    <td width="50%" align="left" colspan="3"><b>PEJABAT PENILAI KERJA</b></td>
                </tr>
                <tr>
                    <td width="14%">NAMA</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nama_lengkap).'</td>
                    <td width="14%">NAMA</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nama_lengkap_atasan).'</td>
                </tr>
                <tr>
                    <td width="14%">NIP</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nip).'</td>
                    <td width="14%">NIP</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nip_atasan).'</td>
                </tr>
                <tr>
                    <td width="14%">PANGKAT/Gol</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->pangkat).'</td>
                    <td width="14%">PANGKAT/Gol</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->pangkat_atasan).'</td>
                </tr>
                <tr>
                    <td width="14%">JABATAN</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->jabatan).'</td>
                    <td width="14%">JABATAN</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->jabatan_atasan).'</td>
                </tr>
                <tr>
                    <td width="14%">UNIT KERJA</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nama_unit_kerja).'</td>
                    <td width="14%">UNIT KERJA</td>
                    <td width="1%">:</td>
                    <td width="35%">'.strtoupper($detail->nama_unit_kerja_atasan).'</td>
                </tr>
            </table>
            
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    '.$header.'
                </thead>
                <tbody id="row-data-kinerja-utama">
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
        $pdf->Output('Kinerja_Utama_'.$detail->nama_lengkap.'_tahun_'.$detail->tahun_desc.'.pdf', 'D');
    }

    
    public function get_data()
    {
        $id_skp = $this->input->post("id_skp");
        if($this->input->is_ajax_request() && $id_skp)
        {
            $param_detail['where']['skp.id_skp'] = $id_skp;
            $detail = $this->Skp_model->get($param_detail)->row();
            
            $content = $this->Kinerja_utama_model->getContent($detail);
            
            
            //$data['result']     = $result;
            $data['content'] 	= $content;
            echo json_encode($data);


        }
    }
   
}