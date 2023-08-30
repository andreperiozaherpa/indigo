<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penganggaran extends CI_Controller
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
		$this->load->model("sigesit/Program_model");
        $this->load->model("sigesit/Realisasi_model");
		$this->load->model("Ref_skpd_model");
	}


	public function index()
	{
		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/penganggaran/index";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

		if($this->id_skpd)
		{
			$token = md5("SKPD".$this->id_skpd);
			redirect('/sigesit/penganggaran/skpd/'.$token);
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
									<a href="'.base_url().'/sigesit/penganggaran/skpd/'.md5("SKPD".$row->id_skpd).'">
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

	public function skpd($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/penganggaran/detail_skpd";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = [];

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
			//echo "<pre>";print_r($detail);die;
			$this->load->view('admin/main_lite', $data);
		}
		else{
			show_404();
		}
		
		
	}

	public function detail($token)
	{

		$data['title']		= "sigesit - " . app_name;
		$data['content']	= "sigesit/penganggaran/detail_penganggaran";
		$data['active_menu'] = "sigesit";
		$data['user_picture'] = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
		$data['plugins'] = ['select','sweetalert','rangeslider','rangeslider_sigesit'];

		$data['token'] = $token;

		$param['where']["md5(concat('KEGIATAN',kegiatan.id_kegiatan))"] = $token;
		$detail = $this->Kegiatan_model->get($param)->row();

        
		if($detail)
		{
            $data['dt_kecamatan'] = $this->Globalvar->get_kecamatan();
            $data['dt_rts'] = $this->Globalvar->get_rts();
            $data['dt_sasaran'] = $this->Globalvar->get_sasaran();
			$data['dt_program']	= $this->Program_model->get_penganggaran($detail->id_skpd)->result();

			$dt_realisasi = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_realisasi_anggaran")->row();
            if(!$dt_realisasi)
            {
                $dt_realisasi = $detail;
                $dt_realisasi->total_realisasi_anggaran  = $this->Realisasi_model->get_total_pagu($detail->kode_sub_kegiatan, $detail->tahun);
                $dt_realisasi->target_realisasi  = $detail->target;
                $dt_realisasi->satuan_realisasi  = $detail->satuan;
            }
            //echo "<pre>";print_r($dt_realisasi);die;
            $data['dt_realisasi'] = $dt_realisasi;
			if($data['dt_realisasi'])
			{
				$data['dt_kegiatan'] = $this->Kegiatan_model->get_kegiatan($data['dt_realisasi']->id_ref_program,false)->result();
				$data['dt_sub_kegiatan'] = $this->Kegiatan_model->get_sub_kegiatan($data['dt_realisasi']->id_ref_kegiatan,false)->result();
			}
			
			$dt_realisasi_anggaran = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_realisasi_anggaran_detail")->result();
            if(!$dt_realisasi_anggaran)
            {
                $dt_realisasi_anggaran = $this->db->where("id_kegiatan",$detail->id_kegiatan)->get("sigesit_alokasi_anggaran")->result();
                
            }
            $data['dt_realisasi_anggaran'] = $dt_realisasi_anggaran;

			

			$data['detail'] = $detail;
			
			$this->load->view('admin/main', $data);
		}
		else{
			show_404();
		}
		
		
	}

	public function save_penganggaran()
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
                        'field' => 'id_ref_program',
                        'label' => 'Program',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_ref_kegiatan',
                        'label' => 'Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_ref_sub_kegiatan',
                        'label' => 'Sub Kegiatan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'total_realisasi_anggaran',
                        'label' => 'Realisasi Anggaran',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
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

                    $param['where']["kegiatan.id_kegiatan"] = $post_data['id_kegiatan'];
		            $detail = $this->Kegiatan_model->get($param)->row();
                    if($detail)
                    {
                        $total_pagu = $this->Realisasi_model->get_total_pagu($detail->kode_sub_kegiatan, $detail->tahun);
                        $total_realisasi_anggaran = str_replace(",","",$post_data['total_realisasi_anggaran']);
    
                        if($total_realisasi_anggaran > $total_pagu)
                        {
                            $data['status'] = false;
                            $data['message'] = "Anggaran melebihi jumlah pagu. Maksimal anggaran Rp. ".number_format($total_pagu);
                        }
                        else{
                            $dt = array(
                                'id_ref_program'    => $post_data['id_ref_program'],
                                'id_ref_kegiatan'    => $post_data['id_ref_kegiatan'],
                                'id_ref_sub_kegiatan'    => $post_data['id_ref_sub_kegiatan'],
                                'total_realisasi_anggaran'    =>  $total_realisasi_anggaran,
                                'id_kegiatan'    => $post_data['id_kegiatan'],
                                'target_realisasi'    => $post_data['target_realisasi'],
                                'satuan_realisasi'    => $post_data['satuan_realisasi'],
                            );
        
                            $cek = $this->db 
                            ->where("id_kegiatan",$post_data['id_kegiatan'])
                            ->get("sigesit_realisasi_anggaran")
                            ->row();
        
                            if($cek){
                                $this->db->where("id_kegiatan",$post_data['id_kegiatan'])->update("sigesit_realisasi_anggaran",$dt);
                            }
                            else{
                                $this->db->insert("sigesit_realisasi_anggaran",$dt);
                            }
        
                            // update kegiatan
                            $this->db
                            ->set("realisasi_anggaran",$total_realisasi_anggaran)
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
                else{
                    $errors = $this->form_validation->error_array();
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }

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
                    $realisasi_anggaran = $this->input->post("realisasi_anggaran");
                    if(isset($realisasi_anggaran['nama_kegiatan']))
                    {
                        $this->db->where("id_kegiatan",$post_data['id_kegiatan'])->delete("sigesit_realisasi_anggaran_detail");

                        $total_realisasi_anggaran = 0;
                        foreach($realisasi_anggaran['nama_kegiatan'] as $key => $value)
                        {
                            if($value){
                                $jumlah = isset($realisasi_anggaran['jumlah'][$key]) ? $realisasi_anggaran['jumlah'][$key] : 0;
                                $harga = isset($realisasi_anggaran['harga'][$key]) ? str_replace(",","",$realisasi_anggaran['harga'][$key]) : 0;
                                $sub_total = ($jumlah * $harga);
                                
                                $total_realisasi_anggaran += $sub_total;
                            }
						}

                        $param['where']["kegiatan.id_kegiatan"] = $post_data['id_kegiatan'];
                        $detail = $this->Kegiatan_model->get($param)->row();
                        if($detail)
                        {
                            $total_pagu = $this->Realisasi_model->get_total_pagu($detail->kode_sub_kegiatan, $detail->tahun);
                            
                            if($total_realisasi_anggaran != $total_pagu)
                            {
                                $data['status'] = false;
                                $data['message'] = "Jumlah Anggaran tidak sama. Total anggaran harus Rp. ".number_format($total_pagu);
                            }
                            else{
                                foreach($realisasi_anggaran['nama_kegiatan'] as $key => $value)
                                {
                                    if($value){
                                        $jumlah = isset($realisasi_anggaran['jumlah'][$key]) ? $realisasi_anggaran['jumlah'][$key] : 0;
                                        $harga = isset($realisasi_anggaran['harga'][$key]) ? str_replace(",","",$realisasi_anggaran['harga'][$key]) : 0;
                                        $satuan = isset($realisasi_anggaran['satuan'][$key]) ? $realisasi_anggaran['satuan'][$key] : '';
                                        $total = ($jumlah * $harga);
                                        $realisasi = array(
                                            'nama_kegiatan'     => $value,
                                            'jumlah'            => $jumlah,
                                            'harga'             => $harga,
                                            'satuan'            => $satuan,
                                            'total'             => $total,
                                            'id_kegiatan'       => $post_data['id_kegiatan']
                                        );
            
                                        $this->db->insert("sigesit_realisasi_anggaran_detail",$realisasi);
                                    }
                                }
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
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }


	public function get_kegiatan()
    {
        $content = '<option value="">Pilih</option>';
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $dt = $this->Kegiatan_model->get_kegiatan($id,false);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_kegiatan.'">'.$row->kode_kegiatan.' '.$row->nama_kegiatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }


    public function get_sub_kegiatan()
    {
        $content = '<option value="">Pilih</option>';
        $id = $this->input->post("id");
        if($this->input->is_ajax_request() && $id)
        {
            $dt = $this->Kegiatan_model->get_sub_kegiatan($id,false);
            foreach($dt->result() as $row)
            {
                $content .= '<option value="'.$row->id_sub_kegiatan.'">'.$row->kode_sub_kegiatan.' '.$row->nama_sub_kegiatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}