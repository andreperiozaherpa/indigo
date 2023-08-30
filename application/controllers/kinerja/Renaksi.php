<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renaksi extends CI_Controller
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


        $this->pegawai = $dt_pegawai;


        $this->load->model("kinerja/Config");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Kinerja_utama_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("kinerja/Lkh_model");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("sicerdas/Ref_satuan_model");
	}

    public function index()
    {
        $data['title']		    = 'Renaksi | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/renaksi/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "renaksi";

        $data['role_pimpinan']  = $this->role_pimpinan;

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

    public function detail()
    {
        $data['title']		    = 'Renaksi | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/renaksi/detail";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert','switchery'];
        $data['active_menu']    = "renaksi";

        $detail = null;

        if($this->input->get("utoken"))
        {
            $token = $this->input->get("utoken");
            $param_detail['where']["md5(CONCAT('K',kinerja_utama.id_kinerja_utama))"]  = $token;
            $detail = $this->Kinerja_utama_model->get($param_detail)->row();
        }
        else if($this->input->get("itoken"))
        {
            $token = $this->input->get("itoken");
            $param_detail['where']["md5(CONCAT('K',instruksi_khusus.id_instruksi_khusus))"]  = $token;
            $detail = $this->Instruksi_model->get_instruksi_khusus($param_detail)->row();
        }
        else if($this->input->get("ttoken"))
        {
            $token = $this->input->get("ttoken");
            $param_detail['where']["md5(CONCAT('K',kinerja_tambahan.id_kinerja_tambahan))"]  = $token;
            $detail = $this->Kinerja_tambahan_model->get($param_detail)->row();
        }


        if(!$detail)
        {
            show_404();
        }

        $data['detail'] = $detail;

        $param_kinerja_utama['where']['kinerja_utama.id_skp'] = $detail->id_skp;
        $data['dt_kinerja_utama'] = $this->Kinerja_utama_model->get($param_kinerja_utama)->result();

        $param_kinerja_tambahan['where']['kinerja_tambahan.id_skp'] = $detail->id_skp;
        $data['dt_kinerja_tambahan'] = $this->Kinerja_tambahan_model->get($param_kinerja_tambahan)->result();
        
        $param_instruksi['where']['instruksi_khusus.id_skp'] = $detail->id_skp;
        $data['dt_instruksi'] = $this->Instruksi_model->get_instruksi_khusus($param_instruksi)->result();
        

        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        //echo "<pre>";print_r($detail);die;

        $this->load->view('admin/main', $data);
    }

    public function get_data()
    {
        $tahun = $this->input->post("tahun");
        $bulan = $this->input->post("bulan");
        $id_pegawai = $this->input->post("id_pegawai");
        if($this->input->is_ajax_request() && $tahun)
        {
            $param_skp['where']['skp.tahun_desc'] = $tahun;
            $param_skp['where']['skp.id_pegawai'] = $id_pegawai;
            $param_skp['where']['skp.status'] = 'Sudah Diverifikasi';
            $dt_skp = $this->Skp_model->get($param_skp)->row();
            $pegawai = '';
            if($dt_skp)
            {
                $pegawai = '
                <div class="col-md-6">
                    <div class="white-box" style="min-height:380px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                                <table width="100%" class="table">
                                    <thead>
                                        <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td>'.$dt_skp->nama_lengkap.'</td></tr>
                                        <tr valign="top"><td>NIP</td><td>:</td><td>'.$dt_skp->nip.'</td></tr>
                                        <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td>'.$dt_skp->pangkat.'</td></tr>
                                        <tr valign="top"><td>Jabatan</td><td>:</td><td>'.$dt_skp->jabatan.'></td></tr>
                                        <tr valign="top"><td>Unit Kerja</td><td>:</td><td>'.$dt_skp->nama_unit_kerja.'</td></tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="white-box" style="min-height:380px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title m-t-5">Pejabat penilai kerja</h3>
                                <table width="100%" class="table">
                                    <thead>
                                        <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td>'.$dt_skp->nama_lengkap_atasan.'</td></tr>
                                        <tr valign="top"><td>NIP</td><td>:</td><td>'.$dt_skp->nip_atasan.'</td></tr>
                                        <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td>'.$dt_skp->pangkat_atasan.'</td></tr>
                                        <tr valign="top"><td>Jabatan</td><td>:</td><td>'.$dt_skp->jabatan_atasan.'</td></tr>
                                        <tr valign="top"><td>Unit Kerja</td><td>:</td><td>'.$dt_skp->nama_unit_kerja_atasan.'</td></tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
    
                    </div>
                </div>
               ';

            }

            $data['skp'] = $dt_skp;

           $data['pegawai'] = $pegawai;

           
            
        }
        $data['post'] = $_POST;
        echo json_encode($data);
    }

    public function save()
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

                $this->load->library('form_validation');

                $this->form_validation->set_data( $post_data );

                
                $validation_rules = [
                    [
                        'field' => 'renaksi',
                        'label' => 'Rencana Aksi',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'satuan',
                        'label' => 'Satuan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ]
                    
                ];

                

                $this->form_validation->set_rules( $validation_rules );

				$errors = array();

                

				if(!$this->input->post("target"))
				{
					$errors['bulan'] = "Target diperlukan";
				}
                
                if( $this->form_validation->run() && !$errors)
                {

					
                    
                    $dt = array(
                        'renaksi'       => $post_data['renaksi'],
                        'satuan'       => $post_data['satuan'],
                        'tahun'       => $post_data['tahun'],
                        'tahun_desc'       => $post_data['tahun_desc'],
                        'id_skp'       => $post_data['id_skp']
                    );

                    $rencana_hasil = $this->input->post("rencana_hasil");
                    $rencana_hasilArr = explode("-",$rencana_hasil);
                    if($rencana_hasilArr[0]=="U")
                    {
                        $dt['id_kinerja_utama']     = $rencana_hasilArr[1];
                        $dt['id_kinerja_tambahan']  = null;
                        $dt['id_instruksi_khusus']  = null;
                    }
            
                    if($rencana_hasilArr[0]=="T")
                    {
                        $dt['id_kinerja_utama']     = null;
                        $dt['id_kinerja_tambahan']  = $rencana_hasilArr[1];
                        $dt['id_instruksi_khusus']  = null;
                    }
            
                    if($rencana_hasilArr[0]=="I")
                    {
                        $dt['id_kinerja_utama']     = null;
                        $dt['id_kinerja_tambahan']  = null;
                        $dt['id_instruksi_khusus']  = $rencana_hasilArr[1];
                    }

					$id_renaksi = null;
                    
                    if($this->input->post("action")=="edit"){
						$id_renaksi = $post_data['id_renaksi'];
                        $this->Renaksi_model->update($dt,$post_data['id_renaksi']);
                        $data['message'] = "Renaksi berhasil diubah";
                    }
                    else if($this->input->post("action")=="add"){
                        $this->Renaksi_model->insert($dt);
                        $id_renaksi = $this->db->insert_id(); 
                        $data['message'] = "Renaksi berhasil disimpan";


                    }
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    if($id_renaksi && $this->input->post("target"))
                    {
                        $data['id_renaksi'] = $id_renaksi;
                        $update = array();
                        $status = $this->input->post("status");

                        $dt_bulan = $this->Config->bulan;
                        foreach($_POST['target'] as $bulan => $target)
                        {
                            $cek = $this->db
                            ->where("id_renaksi",$id_renaksi)
                            ->where("bulan",$bulan)
                            ->get("ekinerja_renaksi_detail")->row();

                            
                            $status_jadwal = (!empty($status[$bulan]) &&  $status[$bulan]=="Y") ? "Y" : "N";

                            $bulan_desc = $dt_bulan[$bulan];

                            $this->db->set("id_renaksi",$id_renaksi);
                            $this->db->set("bulan",$bulan);
                            $this->db->set("bulan_desc",$bulan_desc);
                            $this->db->set("target",$target);
                            $this->db->set("status_jadwal",$status_jadwal);


                            if($cek)
                            {
                                $this->db->where("id_renaksi_detail",$cek->id_renaksi_detail);
                                $this->db->update("ekinerja_renaksi_detail");

                                $id_renaksi_detail = $cek->id_renaksi_detail;
                            }
                            else{
                                $this->db->insert("ekinerja_renaksi_detail");
                                $id_renaksi_detail = $this->db->insert_id();
                                
                            }
                            // update capaian
                            $this->Lkh_model->updateCapaian($id_renaksi_detail);
                        }
                    }

                }
                else{
                    $err = $this->form_validation->error_array();
					$errors = array_merge($errors,$err);
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                $data['post'] = $_POST;
                echo json_encode($data);
            }           
        }   
    }
    
    public function get_list($rowno=1)
    {
        $rencana_hasil = $this->input->post("rencana_hasil");
        if($this->input->is_ajax_request() && $rencana_hasil)
        {
            $data = $this->getContent($rencana_hasil,$rowno,false);
            echo json_encode($data);
        }
    }

    public function download($rencana_hasil)
    {
        
        $data = $this->getContent($rencana_hasil,1,true);

        $content = '
        <p style="text-align:center"><b>RENCANA AKSI</b><br>'.$this->input->get("desc").'</p>
        <table width="100%" border="1" cellpadding="5">
           
               <tr>
                   <th rowspan="2">No</th>
                   <th rowspan="2">Rencana Aksi</th>
                   <th colspan="12" style="text-align:center">Target (Bulan)</th>
                   <th rowspan="2">Satuan</th>
               </tr>
               <tr>';
                   foreach($this->Config->bulan as $key=>$value)
                   {
                       $content .= '<th style="text-align:center">'.$key.'</th>';
                   }
                   $content .='
               </tr>
           
           <tbody id="row-data">
               '.$data['content'].'
               
           </tbody>
       </table>
        ';

        //echo $content;
        $this->load->library('pdf');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('L');

        $pdf->writeHTML($content);
        ob_end_clean();
        $pdf->Output('Renaksi '.$this->input->get("desc").'.pdf', 'D');
    }

    private function getContent($rencana_hasil,$rowno=1,$download=false)
    {
        $param = array();
        $data = array();

        if(!$download)
        {
            $rowperpage = 10;
            $offset = ($rowno-1) * $rowperpage;
    
            
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;

        }
        

        $rencana_hasilArr = explode("-",$rencana_hasil);

        $detail = null;
        $satuan_desc = "";
        
        if($rencana_hasilArr[0]=="U")
        {
            $param['where']['renaksi.id_kinerja_utama'] = $rencana_hasilArr[1];

            $param_detail['where']['kinerja_utama.id_kinerja_utama']  = $rencana_hasilArr[1];
            $detail = $this->Kinerja_utama_model->get($param_detail)->row();

        }

        if($rencana_hasilArr[0]=="T")
        {
            $param['where']['renaksi.id_kinerja_tambahan'] = $rencana_hasilArr[1];
            
            $param_detail['where']["kinerja_tambahan.id_kinerja_tambahan"]  = $rencana_hasilArr[1];
            $detail = $this->Kinerja_tambahan_model->get($param_detail)->row();
        }

        if($rencana_hasilArr[0]=="I")
        {
            $param['where']['renaksi.id_instruksi_khusus'] = $rencana_hasilArr[1];

            $param_detail['where']["instruksi_khusus.id_instruksi_khusus"]  = $rencana_hasilArr[1];
            $detail = $this->Instruksi_model->get_instruksi_khusus($param_detail)->row();
        }

        

        $result = $this->Renaksi_model->get($param)->result();

        $content = '';
        foreach($result as $key=>$row)
        {
            $param_['where']['renaksi_detail.id_renaksi'] = $row->id_renaksi;
            $dt_detail = $this->Renaksi_model->get_detail($param_)->result();

            $result[$key]->detail = $dt_detail;
            
            $offset++;

            $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.$row->renaksi.'</td>';
                    
                    foreach($dt_detail as $d)
                    {
                        if($d->status_jadwal=="Y")
                        {
                            $content .= '<td align="center">'.$d->target.'</td>';
                        }
                        else{
                            $content .= '<td></td>';
                        }
                    }
            $content .=' <td>'.$row->satuan.'</td>';

            if(!$download)
            {
                $content .= '
                <td>
                    <div class="btn-group ">
                        <button onclick="edit('.$key.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-pencil"></i></button>
                        <button onclick="hapus('.$row->id_renaksi.')" type="button" class="btn btn-sm_ btn-default btn-outline waves-effect"><i class="fa fa-trash"></i></button>
                    </div>
                </td>';
            }
            
            $content .= '</tr>';

           
        }

        if(!$result)
        {
            $content = '<tr><td colspan="16" align="center">-Belum ada data-</td></tr>';
        }

        if(!$download)
        {
            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Renaksi_model->get($param)->num_rows();
    
    
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
            $data['row']        = $offset;

        }

        $data['csrf_hash']  = $this->security->get_csrf_hash();
        $data['result']     = $result;
        $data['param'] 		= $param;
        $data['content'] 	= $content;
        return $data;
    }

    public function delete()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Renaksi_model->delete($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Renaksi berhasil dihapus";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal menghapus renaksi";
                    }
                
                echo json_encode($data);
            }           
        }
    }
}