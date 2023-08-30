<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
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

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Pegawai_model");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("sicerdas/Ref_satuan_model");
        $this->load->model("kinerja/Cascading");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("sicerdas/Cascading_model");
        $this->load->model("kinerja/Capaian_model");

        $param_pegawai['where']['pegawai.id_user'] =  $this->session->id_user;

        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));

        $this->pegawai = $dt_pegawai;

        
	}

    public function index()
    {
        $data['title']		    = 'Formulir SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/form/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "form_skp";

        $data['pegawai']        = $this->pegawai;
        $data['role_pimpinan']  = $this->role_pimpinan;

        $param_atasan['where']['pegawai.id_pegawai'] = $this->pegawai->id_pegawai_penilai_kerja;
        $data['atasan'] = $this->Pegawai_model->get($param_atasan)->row();

        if($data['atasan'])
        {
            $param_pajabat_penilai_kerja['where']['pegawai.id_skpd'] = $data['atasan']->id_skpd;
            $data['dt_pejabat'] = $this->Pegawai_model->get($param_pajabat_penilai_kerja);
        }
        else{
            $data['dt_pejabat'] = null;
        }


        //echo "<pre>";print_r($data['dt_pejabat']->result());die;

        if($this->id_skpd)
        {
            $param_skpd['where']['skpd.id_skpd'] = $this->id_skpd;
            $data['detail_skpd'] = $this->Skpd->get($param_skpd)->row();
            if($data['detail_skpd']->id_skpd_induk)
            {
                $param['str_where'] = "(skpd.id_skpd = '".$data['detail_skpd']->id_skpd_induk."' OR skpd.id_skpd = '".$this->id_skpd."' )";
            }
        }

        $param['all'] = true;
        $data['dt_skpd']        = $this->Skpd->get($param);

        $data['dt_satuan'] = $this->Ref_satuan_model->get();

        if($this->input->get("token"))
        {
            $token = $this->input->get("token");
            $data['token'] = $token;

            $param_detail['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

            $detail = $this->Skp_model->get($param_detail)->row();
    
            if(!$detail || !$token)
            {
                show_404();
            }
    
            $data['detail'] = $detail;

            $param_kinerja_tambahan['where']['kinerja_tambahan.id_skp'] = $detail->id_skp;
            $dt_kinerja_tambahan = $this->Kinerja_tambahan_model->get($param_kinerja_tambahan)->result();
            $data['dt_kinerja_tambahan'] = $dt_kinerja_tambahan;

            //echo "<pre>";print_r($dt_kinerja_tambahan);die;
        }


        $this->load->view('admin/main', $data);
    }

    public function get_pejabat_penilai_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
			$id_pegawai_penilai_kerja = $this->input->post("id_pegawai_penilai_kerja");
			$param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
            $dt = $this->Pegawai_model->get($param);
            foreach($dt->result() as $row)
            {
                $selected = ($id_pegawai_penilai_kerja && $row->id_pegawai==$id_pegawai_penilai_kerja) ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.' - '.$row->jabatan.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function save_atasan()
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
                        'field' => 'id_pegawai',
                        'label' => 'Pegawai',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    [
                        'field' => 'id_skpd',
                        'label' => 'SKPD',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ],
                    
                    [
                        'field' => 'id_pegawai_penilai_kerja',
                        'label' => 'Nama pejabat',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '%s diperlukan',
                        ]
                    ]
                    
                    
                ];

                

                $this->form_validation->set_rules( $validation_rules );

				$errors = array();
                
                if( $this->form_validation->run() && !$errors)
                {
                    $id_pegawai = $post_data['id_pegawai'];
					
					$status = $this->db
                    ->set("id_pegawai_penilai_kerja",$post_data['id_pegawai_penilai_kerja'])
                    ->where("id_pegawai",$id_pegawai)
                    ->update("pegawai");
                    
                    if($status){
					    $data['message'] = "Pejabat penilai berhasil diubah";
                    }
                    
                    else{
                        $data['message'] = "Error";
                        $data['status'] = FALSE;
                    }

                    

                }
                else{
                    $err = $this->form_validation->error_array();
					$errors = array_merge($errors,$err);
                    $data['status'] = FALSE;
                    $data['errors'] = $errors;
                    $data['post'] = $_POST;
                }
                echo json_encode($data);
            }           
        }   
    }

    public function submit()
    {
        if($this->input->is_ajax_request()  )
        {
            $data = array();
            $data['status'] = false;
            $errors = $this->validate($_POST);
            if(!$errors)
            {
                $id_skp = $this->input->post("id_skp");
                $tahun = $this->input->post("tahun");
                $tahun_desc = $this->input->post("tahun_desc");
                $id_pegawai = $this->input->post("id_pegawai");
                $id_pegawai_atasan = $this->input->post("id_pegawai_atasan");
                if($_POST && $id_pegawai_atasan && $id_pegawai)
                {
                    $is_valid = true;
                    $message = "";
                    if($id_skp)
                    {
                        $param_skp['where']['skp.id_skp'] = $id_skp;
                        $skp = $this->Skp_model->get($param_skp)->row();
                    }
                    else{
                        $param_skp['where']['skp.tahun'] = $tahun;
                        $param_skp['where']['skp.id_pegawai'] = $id_pegawai;
                        $param_skp['str_where'] = "(skp.status != 'Ditolak' )";
                        $skp = $this->Skp_model->get($param_skp)->row();

                        if($skp)
                        {
                            $is_valid = false;
                            $message = "Data SKP tahun $tahun_desc sudah ada";;
                        }
                    }
    
                    if($is_valid)
                    {
                        $data['status'] = true;
                        $action = "";
                        
                        if($id_skp)
                        {
                            $dt_skp = array(
                                'status'             => 'Belum Diverifikasi',
                                'verified_at'        => null
                            );
                            $this->Skp_model->update($dt_skp,$id_skp);
                            $action = "edit";
                        }
                        else{
                            $dt_skp = array(
                                'tahun'             => $tahun,
                                'tahun_desc'        => $tahun_desc,
                                'id_pegawai'        => $id_pegawai,
                                'id_pegawai_atasan' => $id_pegawai_atasan
                            );
                            $id_skp = $this->Skp_model->insert($dt_skp);
                            $action = "add";
                        }


                        $dt_capaian = array(
                            'id_skp'            => $id_skp,
                            'tahun'             => $tahun,
                            'tahun_desc'        => $tahun_desc,
                        );
        
                        if($this->input->post("kinerja_utama"))
                        {
                            $dt_rencana_hasil_kerja = $_POST['kinerja_utama']['rencana_hasil_kerja'];
                            $dt_id_kinerja_utama = $_POST['kinerja_utama']['id_kinerja_utama'];

                            $ids_kinerja_utama = array();
                            if(!empty($_POST['kinerja_utama']['aspek']))
                            {
                                foreach($_POST['kinerja_utama']['aspek'] as $id_cascading => $aspek)
                                {
                                    $rencana_hasil_kerja = (!empty($dt_rencana_hasil_kerja[$id_cascading])) ? $dt_rencana_hasil_kerja[$id_cascading] : "";

                                    $id_kinerja_utama = (!empty($dt_id_kinerja_utama[$id_cascading])) ? $dt_id_kinerja_utama[$id_cascading] : 0;
                                    
                                    if($id_kinerja_utama)
                                    {
                                        $dt_kinerja_utama = array(
                                            'rencana_hasil_kerja'    => $rencana_hasil_kerja,
                                            'aspek'             => implode(",",$aspek)
                                        );
                                        $this->db
                                        ->where("id_kinerja_utama",$id_kinerja_utama)
                                        ->update("ekinerja_utama",$dt_kinerja_utama);
                                    }
                                    else{
                                        $id_cascading = $this->Cascading->insertFromKinerja($id_cascading,$id_skp);
                                        $dt_kinerja_utama = array(
                                            'id_skp'            => $id_skp,
                                            'id_cascading'      => $id_cascading,
                                            'rencana_hasil_kerja'    => $rencana_hasil_kerja,
                                            'aspek'             => implode(",",$aspek)
                                        );
                                        $this->db->insert("ekinerja_utama",$dt_kinerja_utama);

                                        $id_kinerja_utama = $this->db->insert_id();
                                    }

                                    $ids_kinerja_utama[] = $id_kinerja_utama;
                                }
                            }
        
                            if(!empty($_POST['kinerja_utama']['perspektif']))
                            {
                                foreach($_POST['kinerja_utama']['perspektif'] as $id_cascading => $perspektif)
                                {
                                    $rencana_hasil_kerja = (!empty($dt_rencana_hasil_kerja[$id_cascading])) ? $dt_rencana_hasil_kerja[$id_cascading] : "";
    
                                    $id_kinerja_utama = (!empty($dt_id_kinerja_utama[$id_cascading])) ? $dt_id_kinerja_utama[$id_cascading] : 0;

                                    if($id_kinerja_utama)
                                    {
                                        $dt_kinerja_utama = array(
                                            'rencana_hasil_kerja'    => $rencana_hasil_kerja,
                                            'perspektif'        => implode(",",$perspektif)
                                        );
                                        $this->db
                                        ->where("id_kinerja_utama",$id_kinerja_utama)
                                        ->update("ekinerja_utama",$dt_kinerja_utama);
                                    }
                                    else{
                                        $id_cascading = $this->Cascading->insertFromKinerja($id_cascading,$id_skp);
                                        $dt_kinerja_utama = array(
                                            'id_skp'            => $id_skp,
                                            'id_cascading'      => $id_cascading,
                                            'rencana_hasil_kerja'    => $rencana_hasil_kerja,
                                            'perspektif'        => implode(",",$perspektif)
                                        );
                                        $this->db->insert("ekinerja_utama",$dt_kinerja_utama);

                                        $id_kinerja_utama = $this->db->insert_id();
                                    }
                                    $ids_kinerja_utama[] = $id_kinerja_utama;
                                }
                            }

                            if($ids_kinerja_utama)
                            {
                                $this->db
                                ->where_not_in("id_kinerja_utama",$ids_kinerja_utama)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_utama");

                                $this->db
                                ->where_not_in("id_kinerja_utama",$ids_kinerja_utama)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_capaian");

                                foreach($ids_kinerja_utama as $id)
                                {
                                    $dt_capaian['id_kinerja_utama'] = $id;
                                    $this->Capaian_model->init($dt_capaian);
                                }
                            }

                            
                        }
                        else{
                            $this->db
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_utama");

                            $this->db
                                ->where("(id_kinerja_utama is not null)")
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_capaian");
                        }

                        unset($dt_capaian['id_kinerja_utama']);
        
                        if($this->input->post("instruksi"))
                        {
                            $dt_indikator_kinerja_individu = $_POST['instruksi']['indikator_kinerja_individu'];
                            $dt_id_instruksi_khusus = $_POST['instruksi']['id_instruksi_khusus'];
                            $ids_instruksi_khusus = array();
                            if(!empty($_POST['instruksi']['aspek']))
                            {
                                
                                foreach($_POST['instruksi']['aspek'] as $id_instruksi => $aspek)
                                {
                                    $indikator_kinerja_individu = (!empty($dt_indikator_kinerja_individu[$id_instruksi])) ? $dt_indikator_kinerja_individu[$id_instruksi] : "";

                                    $id_instruksi_khusus = (!empty($dt_id_instruksi_khusus[$id_instruksi])) ? $dt_id_instruksi_khusus[$id_instruksi] : 0;

                                    if($id_instruksi_khusus)
                                    {
                                        $dt_instruksi = array(
                                            'indikator_kinerja_individu'    => $indikator_kinerja_individu,
                                            'aspek'             => implode(",",$aspek)
                                        );
                                        $this->db
                                        ->where("id_instruksi_khusus",$id_instruksi_khusus)
                                        ->update("ekinerja_instruksi_khusus",$dt_instruksi);

                                    }
                                    else{
                                        $this->Cascading->insertFromInstruksi($id_instruksi,$id_skp);
                                        $dt_instruksi = array(
                                            'id_skp'            => $id_skp,
                                            'id_instruksi'      => $id_instruksi,
                                            'indikator_kinerja_individu'    => $indikator_kinerja_individu,
                                            'aspek'             => implode(",",$aspek)
                                        );
                                        $this->db->insert("ekinerja_instruksi_khusus",$dt_instruksi);

                                        $id_instruksi_khusus = $this->db->insert_id();
                                    }

                                    $ids_instruksi_khusus[] = $id_instruksi_khusus;
                                }
                            }
        
                            if(!empty($_POST['instruksi']['perspektif']))
                            {
                                foreach($_POST['instruksi']['perspektif'] as $id_instruksi => $perspektif)
                                {
                                    $indikator_kinerja_individu = (!empty($dt_indikator_kinerja_individu[$id_instruksi])) ? $dt_indikator_kinerja_individu[$id_instruksi] : "";
                                    
                                    $id_instruksi_khusus = (!empty($dt_id_instruksi_khusus[$id_instruksi])) ? $dt_id_instruksi_khusus[$id_instruksi] : 0;

                                    if($id_instruksi_khusus)
                                    {
                                        $dt_instruksi = array(
                                            'indikator_kinerja_individu'    => $indikator_kinerja_individu,
                                            'perspektif'        => implode(",",$perspektif)
                                        );
                                        $this->db
                                        ->where("id_instruksi_khusus",$id_instruksi_khusus)
                                        ->update("ekinerja_instruksi_khusus",$dt_instruksi);
                                    }
                                    else{
                                        $this->Cascading->insertFromInstruksi($id_instruksi,$id_skp);
                                        $dt_instruksi = array(
                                            'id_skp'            => $id_skp,
                                            'id_instruksi'      => $id_instruksi,
                                            'indikator_kinerja_individu'    => $indikator_kinerja_individu,
                                            'perspektif'        => implode(",",$perspektif)
                                        );
                                        $this->db->insert("ekinerja_instruksi_khusus",$dt_instruksi);

                                        $id_instruksi_khusus = $this->db->insert_id();
                                    }

                                    $ids_instruksi_khusus[] = $id_instruksi_khusus;
                                }
                            }

                            if($ids_instruksi_khusus)
                            {
                                $this->db
                                ->where_not_in("id_instruksi_khusus",$ids_instruksi_khusus)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_instruksi_khusus");

                                $this->db
                                ->where_not_in("id_instruksi_khusus",$ids_instruksi_khusus)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_instruksi_khusus");

                                foreach($ids_instruksi_khusus as $id)
                                {
                                    $dt_capaian['id_instruksi_khusus'] = $id;
                                    $this->Capaian_model->init($dt_capaian);
                                }
                            }
                        }
                        else{
                            $this->db
                            ->where("id_skp",$id_skp)
                            ->delete("ekinerja_instruksi_khusus");

                            $this->db
                                ->where("(id_instruksi_khusus is not null)")
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_capaian");
                        }
        
                        unset($dt_capaian['id_instruksi_khusus']);
                        if($this->input->post("kinerja_tambahan"))
                        {
                            $ids_kinerja_tambahan = array();
                            $kinerja_tambahan = $this->input->post("kinerja_tambahan");
                            if(!empty($kinerja_tambahan['rencana_hasil_kerja']))
                            {
                                foreach($kinerja_tambahan['rencana_hasil_kerja'] as $key => $value)
                                {
                                    $rencana_hasil_kerja_atasan         = (!empty($kinerja_tambahan['rencana_hasil_kerja_atasan'][$key])) ? $kinerja_tambahan['rencana_hasil_kerja_atasan'][$key] : '';
                                    $indikator_kinerja_individu         = (!empty($kinerja_tambahan['indikator_kinerja_individu'][$key])) ? $kinerja_tambahan['indikator_kinerja_individu'][$key] : '';
                                    $target                             = (!empty($kinerja_tambahan['target'][$key])) ? $kinerja_tambahan['target'][$key] : '';
                                    $satuan                             = (!empty($kinerja_tambahan['satuan'][$key])) ? $kinerja_tambahan['satuan'][$key] : '';
                                    $aspek                              = (!empty($kinerja_tambahan['aspek'][$key])) ? implode(",",$kinerja_tambahan['aspek'][$key]) : '';
                                    $perspektif                         = (!empty($kinerja_tambahan['perspektif'][$key])) ? implode(",",$kinerja_tambahan['perspektif'][$key]) : '';

                                    $id_kinerja_tambahan                = (!empty($kinerja_tambahan['id_kinerja_tambahan'][$key])) ? $kinerja_tambahan['id_kinerja_tambahan'][$key] : 0 ;
                                    
                                    $dt_kinerja_tambahan = array(
                                        'id_skp'                        => $id_skp,
                                        'rencana_hasil_kerja'           => $value,
                                        'rencana_hasil_kerja_atasan'    => $rencana_hasil_kerja_atasan,
                                        'indikator_kinerja_individu'    => $indikator_kinerja_individu,
                                        'aspek'                         => $aspek,
                                        'perspektif'                    => $perspektif,
                                        'target'                        => $target,
                                        'satuan'                        => $satuan
                                    );

                                    if($id_kinerja_tambahan)
                                    {
                                        $this->db
                                        ->where("id_kinerja_tambahan",$id_kinerja_tambahan)
                                        ->update("ekinerja_tambahan",$dt_kinerja_tambahan);
                                    }
                                    else{
                                        $this->db->insert("ekinerja_tambahan",$dt_kinerja_tambahan);

                                        $id_kinerja_tambahan = $this->db->insert_id();
                                    }
                                    
                                    $ids_kinerja_tambahan[] = $id_kinerja_tambahan;
                                    
                                }
                            }

                            if($ids_kinerja_tambahan)
                            {
                                $dt_deleted = $this->db
                                ->where_not_in("id_kinerja_tambahan",$ids_kinerja_tambahan)
                                ->where("id_skp",$id_skp)
                                ->get("ekinerja_tambahan")->result();

                                $ids_deleted = array();
                                foreach($dt_deleted as $row)
                                {
                                    $ids_deleted[] = $row->id_kinerja_tambahan;
                                }

                                if($ids_deleted)
                                {

                                    // delete renaksi

                                    $ids_renaksi = array();
                                    $dt_renaksi = $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->get("ekinerja_renaksi")->result();
                                    foreach($dt_renaksi as $row)
                                    {
                                        $ids_renaksi[]  = $row->id_renaksi;
                                    }

                                    if($ids_renaksi)
                                    {
                                        $this->db->where_in("id_renaksi",$ids_renaksi)->delete("ekinerja_renaksi_detail");    
                                    }

                                    $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->delete("ekinerja_renaksi");

                                    $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->delete("ekinerja_capaian");            
                                }
                                
                                $this->db
                                ->where_not_in("id_kinerja_tambahan",$ids_kinerja_tambahan)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_tambahan");

                                $this->db
                                ->where_not_in("id_kinerja_tambahan",$ids_kinerja_tambahan)
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_tambahan");

                                foreach($ids_kinerja_tambahan as $id)
                                {
                                    $dt_capaian['id_kinerja_tambahan'] = $id;
                                    $this->Capaian_model->init($dt_capaian);
                                }
                            }
                        }
                        else{

                            $dt_deleted = $this->db
                            ->where("id_skp",$id_skp)
                            ->get("ekinerja_tambahan")->result();

                            $ids_deleted = array();
                            foreach($dt_deleted as $row)
                            {
                                $ids_deleted[] = $row->id_kinerja_tambahan;
                            }

                            if($ids_deleted)
                            {
                                // delete renaksi

                                $ids_renaksi = array();
                                $dt_renaksi = $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->get("ekinerja_renaksi")->result();
                                foreach($dt_renaksi as $row)
                                {
                                    $ids_renaksi[]  = $row->id_renaksi;
                                }

                                if($ids_renaksi)
                                {
                                    $this->db->where_in("id_renaksi",$ids_renaksi)->delete("ekinerja_renaksi_detail");    
                                }

                                $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->delete("ekinerja_renaksi");
                                
                                $this->db->where_in("id_kinerja_tambahan",$ids_deleted)->delete("ekinerja_capaian");            
                            }

                            $this->db
                            ->where("id_skp",$id_skp)
                            ->delete("ekinerja_tambahan");

                            $this->db
                                ->where("(id_kinerja_tambahan is not null)")
                                ->where("id_skp",$id_skp)
                                ->delete("ekinerja_capaian");
                        }
        
                        /* if($this->input->post("perilaku"))
                        {
                            $perilaku = $this->input->post("perilaku");
                            if(!empty($perilaku['ekspektasi']))
                            {
                                $dt_id_perilaku = $_POST['perilaku']['id_perilaku'];

                                foreach($perilaku['ekspektasi'] as $id_ref_prilaku => $ekspektasi)
                                {
                                    $id_perilaku = (!empty($dt_id_perilaku[$id_ref_prilaku])) ? $dt_id_perilaku[$id_ref_prilaku] : 0;

                                    if($id_perilaku)
                                    {
                                        $dt_perilaku = array(
                                            'ekspektasi'        => $ekspektasi
                                        );
                                        $this->db
                                        ->where("id_perilaku",$id_perilaku)
                                        ->update("ekinerja_perilaku",$dt_perilaku);
                                    }
                                    else{
                                        $dt_perilaku = array(
                                            'id_skp'            => $id_skp,
                                            'id_ref_prilaku'    => $id_ref_prilaku,
                                            'ekspektasi'        => $ekspektasi
                                        );
                                        $this->db->insert("ekinerja_perilaku",$dt_perilaku);
                                    }

                                }
                            }
                        } */

                        if($action=="add")
                        {
                            $ref_perilaku = $this->db->get("ekinerja_ref_perilaku")->result();
                            foreach($ref_perilaku as $row)
                            {
                                $dt_perilaku = array(
                                    'id_skp'            => $id_skp,
                                    'id_ref_prilaku'    => $row->id_ref_perilaku,
                                    'ekspektasi'        => ''
                                );
                                $this->db->insert("ekinerja_perilaku",$dt_perilaku);
                            }
                        }
        
                        if($this->input->post("lampiran"))
                        {
                            $lampiran = $this->input->post("lampiran");
                            $jenis_lampiran = $this->Config->jenis_lampiran;
                            $dt_id_lampiran = $lampiran['id_lampiran'];
                            foreach($lampiran['nama_lampiran'] as $i => $row_lampiran)
                            {
                                foreach($row_lampiran as $r => $nama_lampiran)
                                {
                                    $id_lampiran = (!empty($dt_id_lampiran[$i][$r])) ? $dt_id_lampiran[$i][$r] : 0;
                                    if($id_lampiran)
                                    {
                                        $dt_lampiran = array(
                                            'nama_lampiran'     => $nama_lampiran,
                                            'jenis'             => $jenis_lampiran[$i]
                                        );
                
                                        $this->db
                                        ->where("id_lampiran",$id_lampiran)
                                        ->update("ekinerja_lampiran",$dt_lampiran);
                                    }
                                    else{
                                        $dt_lampiran = array(
                                            'id_skp'            => $id_skp,
                                            'nama_lampiran'     => $nama_lampiran,
                                            'jenis'             => $jenis_lampiran[$i]
                                        );
                
                                        $this->db->insert("ekinerja_lampiran",$dt_lampiran);
                                    }
                                }
                            }
                        }
                        $data['message'] = "Data berhasil dikirim";
                    }
                    else{
                        $data['status'] = false;
                        $data['message'] = $message;
                    }
    
                    
                    
                }    
            } 
            else{
                $data['errors'] = $errors;
                $data['message'] = "Data belum lengkap. Mohon periksa kembali data anda.";
            } 
            $data['post'] = $_POST;
                    
            echo json_encode($data);    
        }   
    }

    private function validate($data)
    {
        $errors = array();

        // Kinerja Utama
        $param = array();
        $param['where']['cascading.tahun'] = $data['tahun']; 
        if($this->role_pimpinan)
        {
            $param['where']['cascading.flag'] = "sasaran";
            $param['where']['sasaran.id_skpd'] = $this->id_skpd;
        }
        else{
            $param['str_where'] = "(cascading.flag in ('kegiatan','sub_kegiatan') )";
            $param['where']['cascading.id_pegawai'] = $this->pegawai->id_pegawai;
        }
        $result = $this->Cascading_model->get($param)->result();
        foreach($result as $row)
        {
            if($this->role_pimpinan)
            {
                if(empty($data['kinerja_utama']['perspektif'][$row->id_cascading]))
                {
                    $errors['kinerja_utama_perspektif_'.$row->id_cascading] = "Perspektif diperlukan";
                }
            }
            else{
                if(empty($data['kinerja_utama']['aspek'][$row->id_cascading]))
                {
                    $errors['kinerja_utama_aspek_'.$row->id_cascading] = "Aspek diperlukan";
                }
                
                if(empty($data['kinerja_utama']['rencana_hasil_kerja'][$row->id_cascading]))
                {
                    $errors['kinerja_utama_rencana_hasil_kerja_'.$row->id_cascading] = "Rencana Hasil Kerja diperlukan";
                }
            }

        }

        // end of Kinerja Utama


        // instruksi khusus
        $param = array();
        $param['where']['cascading.flag'] = "instruksi";
        $param['where']['cascading.tahun'] = $data['tahun'];
        $param['where']['cascading.id_pegawai'] = $this->pegawai->id_pegawai;
        
        $result = $this->Cascading_model->get($param)->result();
        foreach($result as $row)
        {
            if($this->role_pimpinan)
            {
                if(empty($data['instruksi']['perspektif'][$row->id_instruksi]))
                {
                    $errors['instruksi_perspektif_'.$row->id_instruksi] = "Perspektif diperlukan";
                }
            }
            else{
                if(empty($data['instruksi']['aspek'][$row->id_instruksi]))
                {
                    $errors['instruksi_aspek_'.$row->id_instruksi] = "Aspek diperlukan";
                }
            }

            if(empty($data['instruksi']['indikator_kinerja_individu'][$row->id_instruksi]))
            {
                $errors['instruksi_indikator_kinerja_individu_'.$row->id_instruksi] = "Indikator diperlukan";
            }
        }
        return $errors;
    }
    
}