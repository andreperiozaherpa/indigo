<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matrik extends CI_Controller
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

        //echo "<pre>";print_r($dt_pegawai);die;

        $this->pegawai = $dt_pegawai;

        $hasPrivilege = true;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("sicerdas/Pegawai_model");

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("sicerdas/Cascading_model");

	}

    public function index()
    {
        $data['title']		    = 'Matrik Pembagian Peran Hasil | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/matrik/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "pk";


        $data['role_pimpinan']  = $this->role_pimpinan;

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        $this->load->view('admin/main', $data);
    }

    public function get_data()
    {
        
        if($this->input->is_ajax_request() && $this->input->post("tahun"))
        {
            $id_pegawai = null;
            if($this->input->post("id_pegawai"))
            {
                $id_pegawai = $this->input->post("id_pegawai");
            }
            else{
                $id_pegawai = $this->pegawai->id_pegawai;
                
            }

            $tahun = $this->input->post("tahun");

            $rowData = $this->getRowData($tahun,$id_pegawai,false);

            $data['content'] = $rowData['content'];
            $data['data'] = $rowData['data'];
            
            $data['rowData'] = $rowData;
        }
        
        echo json_encode($data);
    }

    function getRowData($tahun,$id_pegawai,$download=false)
    {
        $content = '';
        $param_pegawai['where']['pegawai.id_pegawai'] = $id_pegawai;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));

            $param = array();
            
            
            $param['where']['cascading.id_pegawai'] = $id_pegawai;
            $param['where']['cascading.tahun']      = $tahun;
            $param['str_where'] = "(cascading.flag in ('sasaran','kegiatan','instruksi') )";

            $dt_cascading = $this->Cascading_model->get($param)->result();

            $col_header = '';

            
            $id_atasan_value    = "";
            $id_atasan_field    = "";
            $flag               = "";

            $cascading          = array();
            $jml_col            = 0;

            $ids_pegawai        = array();

            foreach($dt_cascading as $key => $row)
            {
                $nama_renja = '';
                $indikator_individu = '';
                $jml_col    = $key;
                
                if($row->flag=="sasaran")
                {
                    $nama_renja     = $row->nama_indikator_sasaran_renstra;
                    $id_atasan_value   = $row->id_indikator_sasaran_renstra;
                    $id_atasan_field = "cascading.id_indikator_sasaran_renstra";
                    $flag           = "kegiatan";
                    $indikator_individu = 'nama_indikator_kegiatan';
                }
                elseif($row->flag=="kegiatan")
                {
                    $nama_renja     = $row->nama_indikator_kegiatan;
                    $id_atasan_value   = $row->id_kegiatan_indikator;
                    $id_atasan_field = "cascading.id_kegiatan_indikator";
                    $indikator_individu = "nama_indikator_sub_kegiatan";
                    $flag = "sub_kegiatan";
                }
                else if($row->flag=="instruksi")
                {
                    $nama_renja     = $row->nama_instruksi;
                    $id_atasan_value   = $row->id_instruksi;
                    $id_atasan_field = "instruksi.id_instruksi_atasan";
                    $flag           = "instruksi";
                    $indikator_individu = 'nama_instruksi';
                } 
                

                $col_header .= '<th>'.$nama_renja.'</th>';
                $param_cascading = array();
                $param_cascading['where']['cascading.flag'] = $flag;
                $param_cascading['where']['cascading.tahun'] = $tahun;
                $param_cascading['where'][$id_atasan_field] = $id_atasan_value;
                $dt_cascading_bawahan = $this->Cascading_model->get($param_cascading)->result();

                $dt_cascading[$key]->cascading = $dt_cascading_bawahan;
                $dt_cascading[$key]->indikator_individu = $indikator_individu;
                $dt_cascading[$key]->param = $param_cascading;
                
                foreach($dt_cascading_bawahan as $k => $cas)
                {
                    $ids_pegawai[] = $cas->id_pegawai;
                }

            }

            $list = '';


            $param_pegawai = array();
            $pegawai = array();
            

            if($ids_pegawai && $dt_cascading)
            {
                $param_pegawai['str_where']  = "(pegawai.id_pegawai in (".implode(",",$ids_pegawai).") )";
                $pegawai = $this->Pegawai_model->get($param_pegawai)->result();
    
                foreach($pegawai as $row)
                {
                    $list .= '
                        <tr>
                            <td>'.$row->nama_lengkap.'</td>
                            <td>'.$row->jabatan.'</td>';
                            
                            foreach($dt_cascading as $cas)
                            {
                                $indikator_individu = '';
                                $indikator_individu_field = $cas->indikator_individu;
                                $indikator_individuArr = array();
                                foreach($cas->cascading as $c)
                                {
                                    
                                    if($c->id_pegawai == $row->id_pegawai)
                                    {
                                        $indikator_individuArr[] = $c->$indikator_individu_field;
                                    }
                                }
                                if($indikator_individuArr)
                                {
                                    $list .= '<td><ul style="padding:10px"><li>'.implode("</li><li>",$indikator_individuArr).'</li></ul></td>';
                                }
                                else{
                                    $list .= '<td></td>';
                                }
                            }
                    $list .='</tr>';
                }

                $btn_download ='';
                $btn_download = ($download) ? '' : '<button class="btn btn-outline btn-default pull-right" onclick="download()"><i class="fa fa-download"></i> Download</button>';

                $title = ($download) ? '<h2>MATRIK PEMBAGIAN PERAN HASIL</h2>' : '';
                $border = ($download) ? '1' : '0';

                $content = '
                '.$btn_download.'
                '.$title.'
                <table class="table table-striped" width="100%" border="'.$border.'" cellpadding="5" id="row-data">
                    <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            '.$col_header.'
                        </tr>
                    </thead>
                    <tbody>
                    '.$list.'
                    </tbody>
                </table>
                ';
            }
            else{
                $content = '
                    <div class="col-md-12">
                    <hr>
                        <div class="well_ well-sm text-center">
                            <h4>Oppss</h4>
                            <p>Tidak ada data</p>
                        </div>
                    </div>';
            }

        return [
            'content'   => $content,
            'data'      => $dt_cascading,
            'param_pegawai' => $param_pegawai,
            'pegawai'   => $pegawai
        ];
    }
    
    public function download()
    {
        $id_pegawai = null;

        if(!$this->role_pimpinan && $this->pegawai)
        {
            $id_pegawai = $this->pegawai->id_pegawai;
        }
        else{
            if($this->input->get("id_pegawai"))
            {
                $id_pegawai = $this->input->get("id_pegawai");
            }
            else{
                $id_pegawai = $this->pegawai->id_pegawai;
                
            }

            

        }

        $tahun = $this->input->get("tahun");

        if($tahun && $id_pegawai)
        {

            $rowData = $this->getRowData($tahun,$id_pegawai,true);

            $data = $rowData['content'];

            $this->load->library('pdf');

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->setPrintFooter(false);
                $pdf->setPrintHeader(false);
                $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                $pdf->AddPage('L');

                $pdf->writeHTML($data);
                ob_end_clean();
                $pdf->Output('Matrik.pdf', 'D');
        
        }
        else{
            show_404();
        }
    }

    public function get_pegawai()
    {
        $content = '';//'<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
			$param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
            if(!$this->role_pimpinan && $this->pegawai)
            {
                $param['where']['pegawai.id_pegawai'] = $this->pegawai->id_pegawai;
            }
            $dt = $this->Pegawai_model->get($param);
            foreach($dt->result() as $row)
            {
                $selected = ($this->pegawai && $this->pegawai->id_pegawai == $row->id_pegawai) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}