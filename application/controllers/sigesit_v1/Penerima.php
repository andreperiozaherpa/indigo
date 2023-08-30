<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerima extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
		$this->user_model->set_user_by_user_id();
		$this->user_picture = $this->user_model->user_picture;
		$this->full_name	= $this->user_model->full_name;
		$this->user_level	= $this->user_model->level;
		$this->id_pegawai = $this->user_model->id_pegawai;
		$this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

		if (!$this->user_id) {
            show_404();
        }

		if ($this->user_level == "Administrator" OR in_array('sigesit', $this->user_privileges)) {	}
		else{show_404();}

        $this->load->model("sigesit/Globalvar");
        $this->load->model("sigesit/Penerima_model");
	}

    public function get_dtks($rowno=1)
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

            if($this->input->post("kdkec"))
            {
                $param['where']['dtks.kdkec'] = $this->input->post("kdkec");
            }

            if($this->input->post("kddesa"))
            {
                $param['where']['dtks.kddesa'] = $this->input->post("kddesa");
            }
            if($this->input->post("rts"))
            {
                $param['where']['dtks.rts'] = $this->input->post("rts");
            }

            $param_temp['where']['temp.user_id'] = $this->user_id;
            $dt_temp = $this->Penerima_model->get_temp($param_temp)->result();
            if($dt_temp)
            {
                $temp = array();
                foreach($dt_temp as $row)
                {
                    $temp[] = $row->id_dtks;
                }

                $param['str_where'] = "(dtks.id_dtks not in (".implode(",",$temp).") )";
            }

            $today = date("Y-m-d");
            if($this->input->post("usia_1"))
            {
                $usia_1 = $this->input->post("usia_1");
                $tgl_lahir_1 = date("Y-m-d",strtotime($today." -".$usia_1." years"));
                $param['where']['dtks.tgllahir <= '] = $tgl_lahir_1;
            }

            if($this->input->post("usia_2"))
            {
                $usia_2 = $this->input->post("usia_2");
                $tgl_lahir_2 = date("Y-m-d",strtotime($today." -".$usia_2." years"));
                $param['where']['dtks.tgllahir >= '] = $tgl_lahir_2;
            }

            if($this->input->post("kks"))
            {
                $param['where']['dtks.ada_kks'] = 1;
            }
            if($this->input->post("pbi"))
            {
                $param['where']['dtks.ada_pbi'] = 1;
            }
            if($this->input->post("kip"))
            {
                $param['where']['dtks.ada_kip'] = 1;
            }
            if($this->input->post("pkh"))
            {
                $param['where']['dtks.ada_pkh'] = 1;
            }
            if($this->input->post("bpnt"))
            {
                $param['where']['dtks.ada_bpnt'] = 1;
            }
            

			
            $result = $this->Penerima_model->get_dtks($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {
                $kks = ($row->ada_kks == 1) ? "success" : "default" ;
                $pbi = ($row->ada_pbi == 1) ? "success" : "default" ;
                $kip = ($row->ada_kip == 1) ? "success" : "default" ;
                $pkh = ($row->ada_pkh == 1) ? "success" : "default" ;
                $bpnt = ($row->ada_bpnt == 1) ? "success" : "default" ;

                $tgl1=date_create($row->tgllahir);
                $tgl2=date_create($today);
                $diff = date_diff($tgl1,$tgl2);
                $usia = $diff->format("%Yth");
				$content .= '
				<div class="col-md-12" style="border:1px solid #eaeaea;border-radius:3px; margin-bottom:10px">
				    <div class="row panel-body">
				        <table width="100%">
				            <tr>
				                <td>
				                    <b>'.$row->nama.' </b>| NIK '.$row->nik.' | '.$usia.'
				                    <br>
				                    <span>'.$row->desa.', '.$row->nmkec.'</span>
				                    <br>
				                    <div style="margin-top:10px">
				                        <span class="label label-info"><i class="fa fa-tag"></i> '.$row->rts.'</span>
				                        <span class="label label-'.$kks.'">KKS</span>
				                        <span class="label label-'.$pbi.'">PBI</span>
				                        <span class="label label-'.$kip.'">KIP</span>
				                        <span class="label label-'.$pkh.'">PKH</span>
				                        <span class="label label-'.$bpnt.'">BPNT</span>
				                    </div>
				                </td>
				                <td width="100px" align="right">
				                    <div class="btn-group m-b-20">
				                        <button onclick="detail_penerima('.$row->id_dtks.')" type="button" class="btn btn-default btn-sm btn-outline waves-effect"><i
				                                class="fa fa-eye"></i></button>
				                        <button onclick="tambah_penerima('.$row->id_dtks.')" type="button" class="btn btn-default btn-sm btn-outline waves-effect"><i
				                                class="fa fa-arrow-right"></i></button>
				                    </div>
				                </td>
				            </tr>
				        </table>
				    </div>
				</div>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<div class="col-md-12" style="border:1px solid #eaeaea;border-radius:3px; margin-bottom:10px">
				    <div class="row panel-body">
						<p class="text-center">Data tidak ditemukan</p>
					</div>
				</div>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Penerima_model->get_dtks($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $total_rows;
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Globalvar->pagination_config());
            
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
            $data['post']       = $_POST;
            echo json_encode($data);


        }
    }

    public function get_penerima($rowno=1)
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

            if($this->input->post("kdkec"))
            {
                $param['where']['dtks.kdkec'] = $this->input->post("kdkec");
            }

            if($this->input->post("kddesa"))
            {
                $param['where']['dtks.kddesa'] = $this->input->post("kddesa");
            }
            if($this->input->post("rts"))
            {
                $param['where']['dtks.rts'] = $this->input->post("rts");
            }

            if($this->input->post("final"))
            {
                $param['where']['penerima.final'] = $this->input->post("final");
            }

            if($this->input->post("status"))
            {
                $param['where']['penerima.status'] = $this->input->post("status");
            }

            $today = date("Y-m-d");
            if($this->input->post("usia_1"))
            {
                $usia_1 = $this->input->post("usia_1");
                $tgl_lahir_1 = date("Y-m-d",strtotime($today." -".$usia_1." years"));
                $param['where']['dtks.tgllahir <= '] = $tgl_lahir_1;
            }

            if($this->input->post("usia_2"))
            {
                $usia_2 = $this->input->post("usia_2");
                $tgl_lahir_2 = date("Y-m-d",strtotime($today." -".$usia_2." years"));
                $param['where']['dtks.tgllahir >= '] = $tgl_lahir_2;
            }

            if($this->input->post("kks"))
            {
                $param['where']['dtks.ada_kks'] = 1;
            }
            if($this->input->post("pbi"))
            {
                $param['where']['dtks.ada_pbi'] = 1;
            }
            if($this->input->post("kip"))
            {
                $param['where']['dtks.ada_kip'] = 1;
            }
            if($this->input->post("pkh"))
            {
                $param['where']['dtks.ada_pkh'] = 1;
            }
            if($this->input->post("bpnt"))
            {
                $param['where']['dtks.ada_bpnt'] = 1;
            }
            


            if($this->input->post("id_kegiatan"))
            {
                $param['where']['penerima.id_kegiatan'] = $this->input->post("id_kegiatan");
                $result = $this->Penerima_model->get_penerima($param)->result();
            }
            else{
                $param['where']['temp.user_id'] = $this->user_id;
                $result = $this->Penerima_model->get_temp($param)->result();
            }
            
            $dt_status = $this->Globalvar->_status_penerima();

			$content = '';
            foreach($result as $key=>$row)
            {
                $kks = ($row->ada_kks == 1) ? "success" : "default" ;
                $pbi = ($row->ada_pbi == 1) ? "success" : "default" ;
                $kip = ($row->ada_kip == 1) ? "success" : "default" ;
                $pkh = ($row->ada_pkh == 1) ? "success" : "default" ;
                $bpnt = ($row->ada_bpnt == 1) ? "success" : "default" ;

                $tgl1=date_create($row->tgllahir);
                $tgl2=date_create($today);
                $diff = date_diff($tgl1,$tgl2);
                $usia = $diff->format("%Yth");

                if($this->input->post("id_kegiatan"))
                {
                    $status = '';
                    $action_btn = '';
                    if($this->input->post("flag")=="realisasi")
                    {
                         
                        if($row->final=="Y")
                        {
                            $action_btn = '<button onclick="update_final(\'N\','.$row->id_penerima_bantuan.')" type="button" class="btn btn-rounded btn-success btn-sm btn-outline waves-effect"><i
                            class="fa fa-check"></i> Disetujui </button>';
                        }
                        else{
                            $action_btn = '<button onclick="update_final(\'Y\','.$row->id_penerima_bantuan.')" type="button" class="btn btn-rounded btn-default btn-sm btn-outline waves-effect"><i
                            class="fa fa-file"></i> Ditunda </button>';
                        }

                        $status = '<td align="center">'.$action_btn.'</td>';
                    }

                    $catatan = '';

                    if($this->input->post("flag")=="monev")
                    {
                        $ic = '';
                        $color = 'default';
                        if($row->status=="Selesai")
                        {
                            $ic = '<i class="fa m-r-2 fa-check"></i>';
                            $color = 'success';
                        }
                        else if($row->status=="Ditunda")
                        {
                            $ic = '<i class="fa m-r-2 fa-clock-o"></i>';
                        }
                        else if($row->status=="Dibatalkan")
                        {
                            $ic = '<i class="fa m-r-2 fa-minus-circle"></i>';
                            $color = 'danger';
                        }

                        
                        $btn_opt = '';

                        foreach($dt_status as $k=>$val)
                        {
                            if($val != $row->status){
                                $btn_opt .= '<li><a href="javascript:void(0)" onclick="set_status(\''.$val.'\','.$row->id_penerima_bantuan.')" >'.$val.'</a></li>';
                            }
                        }


                        $btn_status = '
                        <div class="btn-group dropup">
                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-'.$color.' btn-outline btn-rounded btn-sm dropdown-toggle waves-effect waves-light" type="button"> '.$ic.' '.$row->status.'<span class="caret m-l-5"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                '.$btn_opt.'
                            </ul>
                        </div>';

                        $status = '<td align="center">'.$btn_status.'</td>';

                        $catatan = '<td>
                            <input value="'.$row->catatan.'" onclick="show_hint('.$key.')" onblur="hide_hint('.$key.')" onkeydown="save_catatan('.$key.','.$row->id_penerima_bantuan.')"  id="catatan_'.$key.'" type="text" class="form-control_ text-center" style="border:0px" placeholder="Masukan catatan"/>
                            <p style="display:none" id="hint_catatan_'.$key.'" class="text-center text-info">Tekan Enter untuk menyimpan catatan</p>
                        </td>';
                    }

                    $content .= '
                        <tr>
                            <td>'.($key+1).'</td>
                            <td>'.$row->nama.' ('.$usia.')</td>
                            <td>'.$row->nik.'</td>
                            <td>'.$row->desa.'</td>
                            <td>'.$row->nmkec.'</td>
                            <td>'.$row->rts.'</td>
                            <td align="center"><span class="text-'.$kks.'"><i class="fa fa-check"></i></span></td>
                            <td align="center"><span class="text-'.$pbi.'"><i class="fa fa-check"></i></span></td>
                            <td align="center"><span class="text-'.$kip.'"><i class="fa fa-check"></i></span></td>
                            <td align="center"><span class="text-'.$pkh.'"><i class="fa fa-check"></i></span></td>
                            <td align="center"><span class="text-'.$bpnt.'"><i class="fa fa-check"></i></span></td>
                            '.$status.'
                            <td align="center">
                                <button onclick="detail_penerima('.$row->id_dtks.')" type="button" class="btn btn-rounded btn-default btn-sm btn-outline waves-effect"><i
                                class="fa fa-eye"></i> Detail </button>
                            </td>
                            '.$catatan.'
                        </tr>
                    ';
				
                }
                else{

                    
                    
                    $content .= '
                        <div class="col-md-12" style="border:1px solid #eaeaea;border-radius:3px; margin-bottom:10px">
                            <div class="row panel-body">
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <b>'.$row->nama.' </b>| NIK '.$row->nik.' | '.$usia.'
                                            <br>
                                            <span>'.$row->desa.', '.$row->nmkec.'</span>
                                            <br>
                                            <div style="margin-top:10px">
                                                <span class="label label-info"><i class="fa fa-tag"></i> '.$row->rts.'</span>
                                                <span class="label label-'.$kks.'">KKS</span>
                                                <span class="label label-'.$pbi.'">PBI</span>
                                                <span class="label label-'.$kip.'">KIP</span>
                                                <span class="label label-'.$pkh.'">PKH</span>
                                                <span class="label label-'.$bpnt.'">BPNT</span>
                                            </div>
                                        </td>
                                        <td width="100px" align="right">
                                            <div class="btn-group m-b-20">
                                                <button onclick="detail_penerima('.$row->id_dtks.')" type="button" class="btn btn-default btn-sm btn-outline waves-effect"><i
                                                        class="fa fa-eye"></i></button>
                                                <button onclick="hapus_penerima('.$row->id.')" type="button" class="btn btn-default btn-sm btn-outline waves-effect"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        ';
                }
                $offset++;
            }

			if(!$result)
			{

                $msg = "Tidak ada data";

                if($this->input->post("id_kegiatan"))
                {
                    $content = '
                        <tr>
                            <td colspan="12" align="center">'.$msg.'</td>
                        </tr>
                    ';
                }
                else{
                    $content = '
                    <div class="col-md-12" style="border:1px solid #eaeaea;border-radius:3px; margin-bottom:10px">
                        <div class="row panel-body">
                            <p class="text-center">'.$msg.'</p>
                        </div>
                    </div>
                    ';
                }
			}

            unset($param['limit']);
            unset($param['offset']);
            if($this->input->post("id_kegiatan"))
            {
                $param_total['where']['penerima.id_kegiatan'] = $this->input->post("id_kegiatan");   
                if($this->input->post("flag")=="realisasi")
                {
                    //$total_rows = $this->Penerima_model->get_penerima($param)->num_rows();
                    
                    $data['total_rows'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                    
                    $param_total['where']['penerima.final'] = "Y";
                    $data['total_final'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                    $param_total['where']['penerima.final'] = "N";
                    $data['total_draft'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                }
                else if($this->input->post("flag")=="monev"){
                    
                    $param_total['where']['penerima.final'] = "Y";
                    $data['total_rows'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                    
                    $param_total['where']['penerima.status'] = "N";
                    $data['total_belum_terima'] = $this->Penerima_model->get_penerima($param_total)->num_rows();

                    $param_total['where']['penerima.status'] = "Y";
                    $data['total_sudah_terima'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                }
                else{
                    $data['total_rows'] = $this->Penerima_model->get_penerima($param_total)->num_rows();
                }
            }
            else{
                //$total_rows = $this->Penerima_model->get_temp($param)->num_rows();
                $param_total['where']['temp.user_id'] = $this->user_id;
                $data['total_rows'] = $this->Penerima_model->get_temp($param_total)->num_rows();
            }

            


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = "";
            $config['use_page_numbers'] = TRUE;
            $config['total_rows'] = $data['total_rows'];
            $config['per_page'] = $rowperpage;
            $config['attributes'] = array('class' => 'btn btn-default btn-outline btn-xm');

            $config = array_merge($config,$this->Globalvar->pagination_config());
            
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

    public function tambah_penerima()
    {
        $id_dtks = $this->input->post("id_dtks");
        if($this->input->is_ajax_request() && $id_dtks)
        {
            $dt = array(
                'id_dtks'   => $id_dtks,
                'user_id'   => $this->user_id,
            );
            $this->db->insert("sigesit_penerima_bantuan_temp",$dt);
            $data['status'] = true;
            echo json_encode($data);
        }
    }

    public function hapus_penerima()
    {
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $this->db
            ->where("id",$id)
            ->delete("sigesit_penerima_bantuan_temp");
            $data['status'] = true;
            echo json_encode($data);
        }
    }

    public function detail_penerima()
    {
        $id_dtks = $this->input->post("id_dtks");
        if($this->input->is_ajax_request() && $id_dtks)
        {

            $param['where']['dtks.id_dtks'] = $id_dtks;
            $detail = $this->Penerima_model->get_dtks($param)->row();

            $kks = ($detail->ada_kks == 1) ? "success" : "default" ;
            $pbi = ($detail->ada_pbi == 1) ? "success" : "default" ;
            $kip = ($detail->ada_kip == 1) ? "success" : "default" ;
            $pkh = ($detail->ada_pkh == 1) ? "success" : "default" ;
            $bpnt = ($detail->ada_bpnt == 1) ? "success" : "default" ;

            $content = '
                <div class="row p0">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>: <strong>'.$detail->nama.'</strong></td>
                        </tr>
                        <tr>
                            <td>RTS</td>
                            <td>: 
                                <span class="label label-info"><i class="fa fa-tag"></i> '.$detail->rts.'</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Bantuan</td>
                            <td>: 
                                <span class="label label-'.$kks.'"><i class="fa fa-check"></i> KKS</span>
                                <span class="label label-'.$pbi.'"><i class="fa fa-check"></i> PBI</span>
                                <span class="label label-'.$kip.'"><i class="fa fa-check"></i> KIP</span>
                                <span class="label label-'.$pkh.'"><i class="fa fa-check"></i> PKH</span>
                                <span class="label label-'.$bpnt.'"><i class="fa fa-check"></i> BPNT</span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIK / KK</td>
                            <td>: '.$detail->nik.' / '.$detail->nokk.'</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: '.$detail->desa.', '.$detail->nmkec.'</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: '.$detail->jenis_kelamin.'</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>: '.$detail->tmplahir.', '.date("d M Y",strtotime($detail->tgllahir)).'</td>
                        </tr>
                        <tr>
                            <td>Usia</td>
                            <td>: '.$detail->umur.'</td>
                        </tr>
                        <tr>
                            <td>STA Kawin</td>
                            <td>: '.$detail->sta_kawin.'</td>
                        </tr>
                        <tr>
                            <td>Akta Nikah</td>
                            <td>: '.$detail->ada_akta_nikah.'</td>
                        </tr>
                        <!--
                        <tr>
                            <td>DIKK</td>
                            <td>: '.$detail->ada_dikk.'</td>
                        </tr>
                        <tr>
                            <td>Krtu Identitas</td>
                            <td>: '.$detail->ada_kartu_identitas.'</td>
                        </tr>
                        <tr>
                            <td>STA Hamil</td>
                            <td>: '.$detail->sta_hamil.'</td>
                        </tr>
                        <tr>
                            <td>NUK</td>
                            <td>: '.$detail->nuk.'</td>
                        </tr>

                        <tr>
                            <td>STA bekerja</td>
                            <td>: '.$detail->sta_bekerja.'</td>
                        </tr>
                        <tr>
                            <td>Jumlah jam kerja</td>
                            <td>: '.$detail->jumlah_jamkerja.'</td>
                        </tr>

                        <tr>
                            <td>Status bekerjaan</td>
                            <td>: '.$detail->status_pekerjaan.'</td>
                        </tr>
                        <tr>
                            <td>STA keberadaan art</td>
                            <td>: '.$detail->sta_keberadaan_art.'</td>
                        </tr>
                        <tr>
                            <td>STA kepesertaan pbi</td>
                            <td>: '.$detail->sta_kepesertaan_pbi.'</td>
                        </tr>

                        -->
                        <tr>
                            <td>Hub KRT</td>
                            <td>: '.$detail->hubkrt.'</td>
                        </tr>

                        <tr>
                            <td>Hub Keluarga</td>
                            <td>: '.$detail->hubkel.'</td>
                        </tr>
                        
                        <tr>
                            <td>IDBDT / IDARTBDT</td>
                            <td>: '.$detail->idbdt.' / '.$detail->idartbdt.'</td>
                        </tr>
                        <tr>
                            <td>No Peserta PKH</td>
                            <td>: '.$detail->nopesertapkh.'</td>
                        </tr>
                        

                        <tr>
                            <td>Jenis Cacat</td>
                            <td>: '.$detail->jenis_cacat.'</td>
                        </tr>
                        <tr>
                            <td>Penyakit Kronis</td>
                            <td>: '.$detail->penyakit_kronis.'</td>
                        </tr>
                        <tr>
                            <td>Partisipasi sekolah</td>
                            <td>: '.$detail->partisipasi_sekolah.'</td>
                        </tr>
                        <tr>
                            <td>Pendidikan tertinggi</td>
                            <td>: '.$detail->pendidikan_tertinggi.'</td>
                        </tr>
                        <tr>
                            <td>Kelas tertinggi</td>
                            <td>: '.$detail->kelas_tertinggi.'</td>
                        </tr>
                        <tr>
                            <td>Ijazah tertinggi</td>
                            <td>: '.$detail->ijazah_tertinggi.'</td>
                        </tr>
                        
                        <tr>
                            <td>Lapangan usaha</td>
                            <td>: '.$detail->lapangan_usaha.'</td>
                        </tr>
                        
                        <tr>
                            <td>Anak diluar rt</td>
                            <td>: '.$detail->anak_diluar_rt.'</td>
                        </tr>
                        <tr>
                            <td>Nama gadis ibu kandung</td>
                            <td>: '.$detail->namagadis_ibukandung.'</td>
                        </tr>
                    </table>
                </div>
            ';

            $data['content'] = $content;

            $data['status'] = true;

            echo json_encode($data);
        }
    }

    public function update_final()
    {
        $id_kegiatan = $this->input->post("id_kegiatan");
        $id = $this->input->post("id");
        $final = $this->input->post("final");
        if($this->input->is_ajax_request() && $id_kegiatan && $final)
        {
            $data['status'] = true;
            $this->db->set("final",$final);
            $this->db->where("id_kegiatan",$id_kegiatan);
            if($id){
                $this->db->where("id_penerima_bantuan",$id);
            }
            $this->db->update("sigesit_penerima_bantuan");
            echo json_encode($data);
                      
        }
    }
    public function status()
    {
        $id_kegiatan = $this->input->post("id_kegiatan");
        $id = $this->input->post("id");
        $status = $this->input->post("status");
        if($this->input->is_ajax_request() && $id_kegiatan && $status)
        {
            $data['status'] = true;
            $this->db->set("status",$status);
            $this->db->where("id_kegiatan",$id_kegiatan);
            if($id){
                $this->db->where("id_penerima_bantuan",$id);
            }
            $this->db->update("sigesit_penerima_bantuan");
            echo json_encode($data);
                      
        }
    }

    public function catatan()
    {
        $id = $this->input->post("id");
        $catatan = $this->input->post("catatan");
        if($this->input->is_ajax_request() && $catatan)
        {
            $data['status'] = true;
            $this->db->set("catatan",$catatan);
            $this->db->where("id_penerima_bantuan",$id);
            $this->db->update("sigesit_penerima_bantuan");
            echo json_encode($data);
                      
        }
    }
}