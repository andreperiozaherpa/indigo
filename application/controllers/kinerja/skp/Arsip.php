<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
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
        $this->load->model("kinerja/Arsip_model");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("sicerdas/Skpd_model");
	}

    

    public function index()
    {
        $data['title']		    = 'Arsip SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/arsip/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        $this->load->view('admin/main', $data);
    }
    
    public function get_list($rowno=1)
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
    
            if($this->input->post("id_skpd"))
            {
                $param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
            }

            if($this->input->post("id_unit_kerja"))
            {
                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,$this->input->post("id_unit_kerja"));
                $ids = array($this->input->post("id_unit_kerja"));
                $ids = array_merge($ids,$dt_unit_kerja[0]->id_unit_kerja_bawahan);
                $param['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$ids).") )";
            }

            if($this->input->post("id_pegawai"))
            {
                $param['where']['pegawai.id_pegawai'] = $this->input->post("id_pegawai");
            }
            else if($this->pegawai){
                $dt_pegawai = $this->db
                ->where("(id_pegawai = '".$this->pegawai->id_pegawai."' OR id_pegawai_penilai_kerja = '".$this->pegawai->id_pegawai."') ")
                ->get("pegawai")->result();
                $ids_pegawai = array();
                foreach($dt_pegawai as $row)
                {
                    $ids_pegawai[] = $row->id_pegawai;
                }

                if($ids_pegawai)
                {
                    $this->db->where_in("pegawai.id_pegawai",$ids_pegawai);
                }
            }

            if($this->input->post("tahun"))
            {
                $param['where']['arsip.tahun'] = $this->input->post("tahun");
            }

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }


            $result = $this->Arsip_model->get($param)->result();

			$content = "";

            foreach($result as $key => $row)
            {
                $token = md5("SKP".$row->id_arsip);
                $btn_skp = '<a href="'.base_url().'kinerja/skp/arsip/skp/'.$token.'" class="btn btn-sm btn-default btn-outline"><i class="ti ti-archive"></i> Buka</a>';
                $btn_dokumentasi = '<a href="'.base_url().'kinerja/skp/arsip/dokumentasi/'.$token.'" class="btn btn-sm btn-default btn-outline"><i class="ti ti-archive"></i> Buka</a>';
                $btn_lkh = '<a href="'.base_url().'kinerja/skp/arsip/lkh/'.$token.'" class="btn btn-sm btn-default btn-outline"><i class="ti ti-archive"></i> Buka</a>';

                $content .= '
                <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$row->nip.'</td>
                    <td>'.$row->nama_lengkap.'</td>
                    <td>'.$row->tahun.'</td>
                    <td>'.date("d M Y H:i:s",strtotime($row->tanggal)).'</td>
                    <td>'.$btn_skp.'</td>
                    <td>'.$btn_dokumentasi.'</td>
                    <td>'.$btn_lkh.'</td>
                </tr>
                ';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);

            if(!empty($ids_pegawai) && $ids_pegawai)
            {
                $this->db->where_in("pegawai.id_pegawai",$ids_pegawai);
            }

            $total_rows = $this->Arsip_model->get($param)->num_rows();


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

    public function create()
    {
        if($this->input->is_ajax_request())
        {
            if($_POST)
            {
                $data['status'] = true;
                
                $status = $this->Arsip_model->create($this->input->post("id"));
                    
                    if($status){
                        $data['message'] = "Arsip berhasil dibuat";
                        
                    }
                    else{
                        $data['status'] = FALSE;
                        $data['message'] = "Gagal membuat arsip";
                    }
                
                echo json_encode($data);
            }           
        }
    }


    public function skp($token)
    {
        
        $data['title']		    = 'SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/arsip/view";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select'];
        $data['active_menu']    = "arsip";


        $param['where']["md5(CONCAT('SKP',arsip.id_arsip))"] = $token;

        $detail = $this->Arsip_model->get($param)->row();

        if(!$detail || !$detail->skp)
        {
            show_404();
        }

        $data['html'] = $detail->skp;

        $this->load->view('admin/main', $data);
    }

    public function dokumentasi($token)
    {
        
        $data['title']		    = 'SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/arsip/view";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select'];
        $data['active_menu']    = "arsip";


        $param['where']["md5(CONCAT('SKP',arsip.id_arsip))"] = $token;

        $detail = $this->Arsip_model->get($param)->row();

        if(!$detail || !$detail->dokumentasi)
        {
            show_404();
        }

        $data['html'] = $detail->dokumentasi;

        $this->load->view('admin/main', $data);
    }

    public function lkh($token)
    {
        
        $data['title']		    = 'SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/arsip/view";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select'];
        $data['active_menu']    = "arsip";


        $param['where']["md5(CONCAT('SKP',arsip.id_arsip))"] = $token;

        $detail = $this->Arsip_model->get($param)->row();

        if(!$detail || !$detail->lkh)
        {
            show_404();
        }

        $data['html'] = $detail->lkh;

        $this->load->view('admin/main', $data);
    }
}