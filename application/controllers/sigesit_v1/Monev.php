<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monev extends CI_Controller
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

		if ($this->user_level == "Administrator" OR in_array('sigesit', $array_privileges)) {	}
		else{show_404();}

		$this->load->model("sigesit/Globalvar");
		$this->load->model("sigesit/Kegiatan_model");
		$this->load->model("sigesit/Realisasi_model");
		$this->load->model("sigesit/Penerima_model");
		$this->load->model("Ref_skpd_model");
	}


	public function index()
	{
		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/monev/index";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

		if($this->id_skpd)
		{
			$token = md5("SKPD".$this->id_skpd);
			redirect('/sigesit/monev/skpd/'.$token);
		}
		
		$this->load->view('admin/main_lite', $data);
		
	}

	public function get_skpd($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 6;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array(); 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

			
            $result = $this->Ref_skpd_model->get($param)->result();

			$ids_skpd = array();
			foreach($result as $row)
			{
				$ids_skpd[] = $row->id_skpd;
			}

			$total = array();
			if($ids_skpd)
			{
				$param_total['str_where'] = "(kegiatan.id_skpd in (".implode(",",$ids_skpd)."))";
				$param_total['group_by'] = "skpd";
				$dt_total = $this->Kegiatan_model->get_total($param_total)->result();
				foreach($dt_total as $row)
				{
					$total[$row->id_skpd] = $row->total;
				}
			}

			$content = '';
            foreach($result as $key=>$row)
            {
				$jml_kegiatan = isset($total[$row->id_skpd]) ? $total[$row->id_skpd] : 0 ;
                $content .= '
				<div class="col-md-4 col-sm-6">
					<div class="white-box">
						<div class="row b-b" style="min-height: 150px;">
							<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 150px;">
								<img src="'.base_url().'/data/logo/skpd/sumedang.png" alt="user"
									class="img-circle img-responsive">
							</div>
							<div class="col-md-8 col-sm-8">
								<p>&nbsp;</p>
								<h3 class="box-title m-b-0">'.strtoupper($row->nama_skpd).'</h3>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-md-12 text-center">
								
								<h3 class="box-title m-b-0">'.$jml_kegiatan.'</h3>
								<p>Jumlah Kegiatan</p>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<br>
								<address>
									<a href="'.base_url().'/sigesit/monev/skpd/'.md5("SKPD".$row->id_skpd).'">
										<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail
										</button>
									</a>
								</address>
							</div>
						</div>
					</div>
				</div>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<div class="col-md-12 col-sm-12">
					<div class="white-box">
						<p class="text-center">Data tidak ditemukan</p>
					</div>
				</div>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Ref_skpd_model->get($param)->num_rows();


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
            echo json_encode($data);


        }
    }

	public function skpd($token,$page=1)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/monev/skpd";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['knob'];

		$data['token'] = $token;

		$param['where']["md5(concat('SKPD',id_skpd))"] = $token;
		$detail = $this->Ref_skpd_model->get($param)->row();

		if($detail)
		{

			$data['kepala'] = $this->db
			->where("jenis_pegawai","kepala")
			->where("id_unit_kerja",0)
			->where("pensiun",0)
			->where("id_skpd",$detail->id_skpd)
			->get("pegawai")
			->row();

			$data['detail'] = $detail;

			
//			$data['dt_list'] = $this->get_list($detail->id_skpd,$token, $page);

//			echo "<pre>";print_r($detail);die;
			$this->load->view('admin/main_lite', $data);
		}
		else{
			show_404();
		}
		
		
	}

	public function detail($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/monev/detail";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['select','sweetalert','rangeslider','rangeslider_sigesit'];

		$data['token'] = $token;

		$param['where']["md5(concat('KEGIATAN',kegiatan.id_kegiatan))"] = $token;
		$detail = $this->Kegiatan_model->get($param)->row();

        //echo "<pre>";print_r($param);die;
		if($detail)
		{
			$data['dt_anggaran'] = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_anggaran_detail")->result();
			
			$dt_realisasi_anggaran = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_realisasi_anggaran")->result();
            if(!$dt_realisasi_anggaran)
            {
				$total_anggaran = 0;
                foreach($data['dt_anggaran'] as $row)
                {
                    $realisasi_anggaran = array(
                        'id_kegiatan'   => $row->id_kegiatan,
                        'nama_kegiatan'   => $row->nama_kegiatan,
                        'jumlah'   => $row->jumlah,
                        'harga'   => $row->harga,
                        'satuan'   => $row->satuan,
                        'total'   => $row->total
                    );
                    $this->db->insert("sigesit_realisasi_anggaran",$realisasi_anggaran);
					$total_anggaran += $row->total;
                }

                $dt_realisasi_anggaran = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_realisasi_anggaran")->result();

				// update kegiatan
				$this->db->set("realisasi_anggaran",$total_anggaran)
				->where("id_kegiatan",$detail->id_kegiatan)
				->update("sigesit_kegiatan");


				$detail = $this->Kegiatan_model->get($param)->row();

            }
            $data['dt_realisasi_anggaran'] = $dt_realisasi_anggaran;

			$data['dt_kecamatan'] = $this->Globalvar->get_kecamatan();
            $data['dt_status'] = $this->Globalvar->_status_penerima();
			$data['dt_sasaran'] = $this->Globalvar->get_sasaran();

			$total_digunakan = $this->Realisasi_model->total_digunakan($detail->id_kegiatan);
            $data['total_digunakan'] = ($total_digunakan) ? number_format($total_digunakan->total) : 0;
			$data['p_digunakan'] = ($total_digunakan->total > 0) ? number_format($total_digunakan->total/$detail->anggaran*100) : 0;
			$data['detail'] = $detail;

			$param_penerima = array();
			$param_penerima['where']['penerima.final'] = "Y";
			$param_penerima['where']['penerima.status !='] = "Dibatalkan";
			$param_penerima['where']['penerima.id_kegiatan'] = $detail->id_kegiatan;

			$total_final = $this->Penerima_model->get_total($param_penerima)->row();
			$data['total_final'] = ($total_final) ? number_format($total_final->total) : 0;

			
			$param_penerima['where']['penerima.status'] = "Selesai";
			$total_terima = $this->Penerima_model->get_total($param_penerima)->row();
			$data['total_terima'] = ($total_terima) ? number_format($total_terima->total) : 0;

			$data['p_terima'] = ($total_terima->total > 0) ? number_format($total_terima->total/$total_final->total*100) : 0;
			
			$data['total_aktivitas'] = number_format($detail->anggaran);
			$data['p_aktivitas'] = ($detail->anggaran > 0) ? ($detail->anggaran / $detail->rencana_anggaran * 100) : 0;
			


			$this->load->view('admin/main', $data);
		}
		else{
			show_404();
		}
		
		
	}


	public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 25;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array(); 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            if($this->id_skpd)
            {
                $param['where']['kegiatan.id_skpd'] = $this->id_skpd;
            }

            if($this->input->post("id_skpd"))
            {
                $param['where']['kegiatan.id_skpd'] = $this->input->post("id_skpd");
            }

            $result = $this->Kegiatan_model->get($param)->result();

            $ids_kegiatan = array();
                foreach($result as $row)
                {
                    $ids_kegiatan[] = $row->id_kegiatan;
                }
    
                $total = array();
                if($ids_kegiatan)
                {
                    $param_total['str_where'] = "(penerima.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_total['group_by'] = "id_kegiatan";
					$param_total['where']['penerima.final'] = "Y";
					$param_total['where']['penerima.status !='] = "Dibatalkan";
                    $dt_total = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total as $row)
                    {
                        $total[$row->id_kegiatan]['total'] = $row->total;
                    }

					$param_total['where']['penerima.status'] = "Selesai";
                    $dt_total_selesai = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total_selesai as $row)
                    {
                        $total[$row->id_kegiatan]['selesai'] = $row->total;
                    }

					$param_realisasi['str_where'] = "(realisasi.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_realisasi['group_by'] = "id_kegiatan";
					$dt_realisasi = $this->Realisasi_model->get_total($param_realisasi)->result();
                    foreach($dt_realisasi as $row)
                    {
                        $total[$row->id_kegiatan]['realisasi'] = $row->total;
                    }
                }

			$content = '';
            foreach($result as $key=>$row)
            {
				$token = md5("KEGIATAN".$row->id_kegiatan) ;

                $capaian = "-";
                if($row->realisasi_anggaran>0)
                {
                    $capaian = number_format($row->realisasi_anggaran / $row->total_anggaran * 100)."%";
                }

                

                $total_penerima = !empty($total[$row->id_kegiatan]['total']) ? $total[$row->id_kegiatan]['total'] : 0;
				$total_selesai = !empty($total[$row->id_kegiatan]['selesai']) ? $total[$row->id_kegiatan]['selesai'] : 0;

				$total_realisasi = !empty($total[$row->id_kegiatan]['realisasi']) ? $total[$row->id_kegiatan]['realisasi'] : 0;

                $capaian_anggaran = ($total_realisasi) ? ($total_realisasi / $row->realisasi_anggaran * 100) : 0;

				$progress = ($total_selesai > 0) ? ($total_selesai / $total_penerima * 100) : 0;

                $status = "Belum selesai";
                $color = "yellow";
                if($total_selesai >0 && $total_selesai == $total_penerima)
                {
                    $status = "Selesai";
                    $color = "#bbf0c6";
                }

				$btn_action = '<a href="'.base_url().'sigesit/monev/detail/'.$token.'" class="btn btn-primary">Detail</a>';

                $content .= '
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$row->tahun.'</td>
                        <td>'.$row->kode_program.' '.$row->nama_program.'</td>
                        <td>'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</td>
                        <td>'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</td>
                        <td>'.$row->output_kegiatan.'</td>
                        <td>'.$row->sasaran.'</td>
                        <td>'.$row->nama_sumber_anggaran.'</td>
                        <td>'.$row->target.'</td>
                        <td>'.$row->satuan.'</td>
                        <td>'.number_format($row->total_anggaran).'</td>
                        <td>'.$row->target_anggaran.'</td>
                        <td>'.$row->satuan_anggaran.'</td>
                        <td>'.number_format($row->realisasi_anggaran).'</td>
                        <td>'.number_format($total_realisasi).'</td>
                        <td>'.$capaian_anggaran.'</td>
                        <td>'.$total_selesai.'</td>
                        <td>'.$progress.'%</td>
                        <td>'.$btn_action.'</td>
                    </tr>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<tr>
                    <td colspan="20" align="center">Tidak ada data</td>
                </tr>
				';
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

	/* public function get_list($id_skpd,$_token, $rowno=1)
    {
        if($this->input->is_ajax_request() or true)
        {
            // Row per page
            $rowperpage = 5;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array(); 

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            $param['where']['kegiatan.id_skpd'] = $id_skpd;//$this->input->post("id_skpd");
            $result = $this->Kegiatan_model->get($param)->result();

                $ids_kegiatan = array();
                foreach($result as $row)
                {
                    $ids_kegiatan[] = $row->id_kegiatan;
                }
    
                $total = array();
                if($ids_kegiatan)
                {
                    $param_total['str_where'] = "(penerima.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_total['group_by'] = "id_kegiatan";
					$param_total['where']['penerima.final'] = "Y";
					$param_total['where']['penerima.status !='] = "Dibatalkan";
                    $dt_total = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total as $row)
                    {
                        $total[$row->id_kegiatan]['total'] = $row->total;
                    }

					$param_total['where']['penerima.status'] = "Selesai";
                    $dt_total_selesai = $this->Penerima_model->get_total($param_total)->result();
                    foreach($dt_total_selesai as $row)
                    {
                        $total[$row->id_kegiatan]['selesai'] = $row->total;
                    }

					$param_realisasi['str_where'] = "(realisasi.id_kegiatan in (".implode(",",$ids_kegiatan)."))";
                    $param_realisasi['group_by'] = "id_kegiatan";
					$dt_realisasi = $this->Realisasi_model->get_total($param_realisasi)->result();
                    foreach($dt_realisasi as $row)
                    {
                        $total[$row->id_kegiatan]['realisasi'] = $row->total;
                    }
                }
            

			$content = '';
            foreach($result as $key=>$row)
            {
				$token = md5("KEGIATAN".$row->id_kegiatan) ;

				$total_penerima = !empty($total[$row->id_kegiatan]['total']) ? $total[$row->id_kegiatan]['total'] : 0;
				$total_selesai = !empty($total[$row->id_kegiatan]['selesai']) ? $total[$row->id_kegiatan]['selesai'] : 0;

				$total_realisasi = !empty($total[$row->id_kegiatan]['realisasi']) ? $total[$row->id_kegiatan]['realisasi'] : 0;

				$progress = ($total_selesai > 0) ? ($total_selesai / $total_penerima * 100) : 0;

				$status = ($progress>=100) ? "Selesai" : "Progress";
				$color_status = ($progress>=100) ? "success" : "danger";

                $content .= '
				<a href="'.base_url().'sigesit/monev/detail/'.$token.'" style="color:#636e72">
					<div class="panel panel-primary">
					<div class="panel-heading">
						Tahun '.$row->tahun.' <span class="label label-'.$color_status.' m-l-5 pull-right">'.$status.'</span> </div>
					<div class="panel-wrapper collapse in" aria-expanded="true">
						<div class="panel-body">
						<div class="col-sm-2 b-r text-center" style="max-height:110px;">
						<input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#00b5c2" value="'.$progress.'" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
						</div>
						<div class="col-sm-2 b-r text-center">
							<br>
							Program
							<h3 class="panel-title">'.$row->nama_program.'</h3>
			
							<br>
							&nbsp;
						</div>
			
						<div class="col-sm-2 b-r text-center">
							<br>
							Kegiatan
							<h3 class="panel-title">'.$row->nama_kegiatan.'</h3>
							<br>
							&nbsp;
						</div>
			
						<div class="col-sm-2 b-r text-center">
							<br>
							Sub-Kegiatan
							<h3 class="panel-title">'.$row->nama_sub_kegiatan.'</h3>
							<br>
							&nbsp;
							Output Sub-Kegiatan
							<h3 class="panel-title">'.$row->output_kegiatan.'</h3>
						</div>
			
			
						<div class="col-sm-4 b-r0">
							<div class="col-sm-12 b-b">
							
			
							<div class="col-sm-12 text-center">
								<table class="table table-bordered">
									<tr>
										<td>Satuan</td>
										<td>Target Kinerja</td>
										<td>Realisasi Kinerja</td>
									</tr>
									</tr>
										<td>Org</td>
										<td>'.$total_penerima.'</td>
										<td>'.$total_selesai.'</td>
									</tr>
								</table>
			
							</div>
			
							</div>
							<div class="col-sm-4 text-center" style="margin-top:10px">
								APBD
								<h3 class="panel-title" style="padding-top:5px;">Rp '.number_format($row->total_anggaran).'</h3>
			
							</div>
							<div class="col-sm-8 text-center" style="margin-top:10px">
							<table class="table table-bordered">
								<tr>
									<td>Satuan</td>
									<td>Target Anggaran</td>
									<td>Realisasi Angaran</td>
								</tr>
								</tr>
									<td>'.$row->satuan_anggaran.'</td>
									<td>'.number_format($row->target_anggaran).'</td>
									<td>'.number_format($row->realisasi_anggaran).'</td>
								</tr>
							</table>
							</div>
			
						</div>
						</div>
					</div>
					</div>
				</a>
				';
                $offset++;
            }

			if(!$result)
			{
				$content = '
				<div class="col-md-12 col-sm-12">
					<div class="white-box">
						<p class="text-center">Tidak ada data</p>
					</div>
				</div>
				';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Kegiatan_model->get($param)->num_rows();


            $this->load->library('pagination');



            // Pagination Configuration
            $config['base_url'] = base_url()."sigesit/monev/skpd/".$_token;
            $config['use_page_numbers'] = true;
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

			return $data;
            //echo json_encode($data);


        }
    } */

	public function save_realisasi()
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
                        'field' => 'id_kegiatan',
                        'label' => 'Id Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                ];
                

                $this->form_validation->set_rules( $validation_rules );
                
                if( $this->form_validation->run() )
                {
                    $anggaran = $this->input->post("realisasi");
                    if(isset($anggaran['nama_kegiatan']))
                    {
                        $this->db->where("id_kegiatan",$post_data['id_kegiatan'])->delete("sigesit_realisasi_anggaran");

                        $total_anggaran = 0;
                        foreach($anggaran['nama_kegiatan'] as $key => $value)
                        {
                            if($value){
                                $jumlah = isset($anggaran['jumlah'][$key]) ? $anggaran['jumlah'][$key] : 0;
                                $harga = isset($anggaran['harga'][$key]) ? str_replace(",","",$anggaran['harga'][$key]) : 0;
                                $sub_total = ($jumlah * $harga);
                                
                                $total_anggaran += $sub_total;
                            }
						}

                        $param['where']["kegiatan.id_kegiatan"] = $post_data['id_kegiatan'];
                        $detail = $this->Kegiatan_model->get($param)->row();
                        if($detail)
                        {
                            if($total_anggaran > $detail->total_anggaran)
                            {
                                $data['status'] = false;
                                $data['message'] = "Jumlah Anggaran melebihi batas maksimal anggaran. Maksimal anggaran Rp. ".number_format($detail->total_anggaran);
                            }
                            else{
                                foreach($anggaran['nama_kegiatan'] as $key => $value)
                                {
                                    if($value){
                                        $jumlah = isset($anggaran['jumlah'][$key]) ? $anggaran['jumlah'][$key] : 0;
                                        $harga = isset($anggaran['harga'][$key]) ? str_replace(",","",$anggaran['harga'][$key]) : 0;
                                        $satuan = isset($anggaran['satuan'][$key]) ? $anggaran['satuan'][$key] : '';
                                        $total = ($jumlah * $harga);
                                        $realisasi = array(
                                            'nama_kegiatan'     => $value,
                                            'jumlah'            => $jumlah,
                                            'harga'             => $harga,
                                            'satuan'            => $satuan,
                                            'total'             => $total,
                                            'id_kegiatan'       => $post_data['id_kegiatan']
                                        );
            
                                        $this->db->insert("sigesit_realisasi_anggaran",$realisasi);
                                    }
                                }

								// update kegiatan
								$this->db->set("realisasi_anggaran",$total_anggaran)
								->where("id_kegiatan",$post_data['id_kegiatan'])
								->update("sigesit_kegiatan");

                                $data['message'] = "Realisasi berhasil disimpan";
                            }
                        }
                        else{
                            $data['status'] = false;
                            $data['message'] = "Invalid data";
                        }
					}

					
                }
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    
                }
                $data['post'] = $_POST;
                echo json_encode($data);
            }           
        }   
    }

}