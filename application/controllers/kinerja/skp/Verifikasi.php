<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
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
        $this->load->model("sicerdas/Globalvar");
	}

    public function index()
    {
        $data['title']		    = 'Verifikasi SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/verifikasi/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select'];
        $data['active_menu']    = "verifikasi_skp";

        $data['pegawai']        = $this->pegawai;
        $data['role_pimpinan']  = $this->role_pimpinan;

        $this->load->view('admin/main', $data);
    }

    public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 12;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();
    
            if($this->input->post("tahun"))
            {
                $param['where']['skp.tahun'] = $this->input->post("tahun");
            }

            if($this->input->post("status"))
            {
                $param['where']['skp.status'] = $this->input->post("status");
            }

			if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            
            if($this->pegawai)
            {
                $param['where']['skp.id_pegawai_atasan'] = $this->pegawai->id_pegawai;
            }

            

            $result = $this->Skp_model->get($param)->result();

			$content = '';
            foreach($result as $key=>$row)
            {

                $color = 'primary';
                $color2 = 'success';
                if($row->status == "Belum Diverifikasi")
                {
                    $color = "warning";
                    $color2 = 'default';
                }
                else if($row->status == "Sudah Diverifikasi")
                {
                    $color = "primary";
                    $color2 = 'success';
                }
                else if($row->status == "Ditolak")
                {
                    $color = "danger";
                    $color2 = 'success';
                }

                $token = md5("SKP".$row->id_skp);

                $created_at = date("d M Y H:i:s",strtotime($row->created_at));
                $verified_at = ($row->verified_at) ? date("d M Y H:i:s",strtotime($row->verified_at)) : '-';

                $alasan_penolakan = '';
                if($row->alasan_penolakan)
                {
                    $alasan_penolakan = '<dt>Alasan penolakan</dt>
                    <dd>'.$row->alasan_penolakan.'</dd>';
                }

                $content .= '
                <div class="col-md-6 col-lg-4 col-sm-6">
                    <div class="panel panel-'.$color.'">
                        <div class="panel-heading text-center">'.$row->status.'</div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <dl>
                                            <dt>Nama</dt>
                                            <dd>'.$row->nama_lengkap.'</dd>
                                            <dt>NIP</dt>
                                            <dd>'.$row->nip.'</dd>
                                            <dt>Jabatan</dt>
                                            <dd>'.$row->jabatan.'</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-12 col-lg-6 col-sm-12">
                                        <dl>
                                            <dt>Tahun SKP</dt>
                                            <dd>'.$row->tahun_desc.'</dd>
                                            <dt>Dibuat pada</dt>
                                            <dd>'.$created_at.'</dd>
                                            <dt>Diverifikasi pada</dt>
                                            <dd>'.$verified_at.'</dd>
                                            '.$alasan_penolakan.'
                                        </dl>
                                    </div>
                                </div>
                                <a href="'.base_url().'kinerja/skp/verifikasi/detail/'.$token.'" class="btn btn-'.$color.' btn-outline btn-block btn-rounded_">DETAIL</a>
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
                <div class="col-md-12">
                    <div class="well_ well-sm text-center">
                        <h4>Oppss</h4>
                        <p>Tidak ada data</p>
                    </div>
                </div>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Skp_model->get($param)->num_rows();


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
            $data['result']     = $result;
            $data['row']        = $offset;
            $data['csrf_hash']  = $this->security->get_csrf_hash();
            $data['param'] 		= $param;
			$data['content'] 	= $content;
            echo json_encode($data);


        }
    }

    public function detail($token)
    {
        $data['title']		    = 'Detail SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/verifikasi/detail/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "verifikasi_skp";

        
        

        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }

        if($detail->status!="Belum Diverifikasi")
        {
            $token = md5("SKP".$detail->id_skp);
            redirect("kinerja/skp/detail/view?token=".$token);
        }

        $data['detail'] = $detail;

        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));

        $data['role_pimpinan']  = $role_pimpinan;

        $this->load->view('admin/main', $data);
    }

    public function submit()
    {
        if($this->input->is_ajax_request()  )
        {
            $id_skp = $this->input->post("id_skp");
            if($_POST && $id_skp)
            {

                $param_skp['where']['skp.id_skp'] = $id_skp;
                $skp = $this->Skp_model->get($param_skp)->row();

                if($skp->status == "Belum Diverifikasi")
                {
                    $data['status'] = true;
                    $data['message'] = "Data berhasil diverifikasi";
                    
                    $update = array(
                        'verified_at'   => date("Y-m-d H:i:s"),
                        'status'        => 'Sudah Diverifikasi'
                    );

                    $this->Skp_model->update($update,$id_skp);
                    $umpan_balik = $this->input->post("umpan_balik");
                    if($umpan_balik)
                    {
                        if(!empty($umpan_balik['kinerja_utama']))
                        {
                            foreach($umpan_balik['kinerja_utama'] as $id_kinerja_utama => $catatan)
                            {
                                $this->db->set("catatan",$catatan)->where("id_kinerja_utama",$id_kinerja_utama)->update("ekinerja_utama");
                            }
                        }

                        if(!empty($umpan_balik['instruksi']))
                        {
                            foreach($umpan_balik['instruksi'] as $id_instruksi_khusus => $catatan)
                            {
                                $this->db->set("catatan",$catatan)->where("id_instruksi_khusus",$id_instruksi_khusus)->update("ekinerja_instruksi_khusus");
                            }
                        }

                        if(!empty($umpan_balik['kinerja_tambahan']))
                        {
                            foreach($umpan_balik['kinerja_tambahan'] as $id_kinerja_tambahan => $catatan)
                            {
                                $this->db->set("catatan",$catatan)->where("id_kinerja_tambahan",$id_kinerja_tambahan)->update("ekinerja_tambahan");
                            }
                        }

                        if(!empty($umpan_balik['perilaku']))
                        {
                            foreach($umpan_balik['perilaku'] as $id_perilaku => $ekspektasi)
                            {
                                $this->db->set("ekspektasi",$ekspektasi)->where("id_perilaku",$id_perilaku)->update("ekinerja_perilaku");
                            }
                        }

                        if(!empty($umpan_balik['lampiran']))
                        {
                            foreach($umpan_balik['lampiran'] as $id_lampiran => $catatan)
                            {
                                $this->db->set("catatan",$catatan)->where("id_lampiran",$id_lampiran)->update("ekinerja_lampiran");
                            }
                        }
                    }

                    // riwayat
                    $this->load->model("kinerja/Skp_riwayat_model");
                    $this->Skp_riwayat_model->insert($id_skp);
                    
                }
                else{
                    $data['status'] = false;
                    $data['message'] = "Data tidak valid";
                }

                
                $data['post'] = $_POST;
                
                echo json_encode($data);
            }           
        }   
    }

    public function reject()
    {
        if($this->input->is_ajax_request()  )
        {
            $id_skp = $this->input->post("id_skp");
            if($_POST && $id_skp)
            {

                $param_skp['where']['skp.id_skp'] = $id_skp;
                $skp = $this->Skp_model->get($param_skp)->row();

                if($skp->status == "Belum Diverifikasi")
                {
                    if($this->input->post("alasan_penolakan"))
                    {
                        $data['status'] = true;
                        $data['message'] = "Data berhasil ditolak";
                        
                        $update = array(
                            'verified_at'   => date("Y-m-d H:i:s"),
                            'status'        => 'Ditolak',
                            'alasan_penolakan'  => $this->input->post("alasan_penolakan")
                        );
    
                        $this->Skp_model->update($update,$id_skp);
                    }
                    else{
                        $data['status'] = false;
                        $data['errors'] = array(
                            'alasan_penolakan'  => 'Alasan penolakan diperlukan'
                        );
                    }
                    
                    
                }
                else{
                    $data['status'] = false;
                    $data['message'] = "Data tidak valid";
                }

                
                $data['post'] = $_POST;
                
                echo json_encode($data);
            }           
        }   
    }

}