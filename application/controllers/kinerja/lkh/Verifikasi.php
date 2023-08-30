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


        $hasPrivilege = true;

        $this->pegawai = $dt_pegawai;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Lkh_model");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("laporan_kinerja_harian_model");
	}


    public function index()
    {
        $data['title']		    = 'Verifikasi LKH | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/lkh/verifikasi/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "lkh";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        
        $data['rating_desc'] = $this->laporan_kinerja_harian_model->getRatingDesc();
        //echo "<pre>";print_r($this->pegawai);die;

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
            
            $param['verifikasi'] = true;

			$data = array();
    
            if($this->input->post("id_skpd"))
            {
                //$param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
                $param['str_where_2'] = "(pegawai.id_skpd = '".$this->input->post("id_skpd")."' OR  skpd.id_skpd_induk = '".$this->input->post("id_skpd")."')";
            }
            

            
            if($this->input->post("id_unit_kerja"))
            {
                $param['where']['pegawai.id_unit_kerja'] = $this->input->post("id_unit_kerja");
                $ids = array($this->input->post("id_unit_kerja"));
                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,$this->input->post('id_unit_kerja'));
                $ids = array_merge($ids,$dt_unit_kerja[0]->id_unit_kerja_bawahan);
                $param['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$ids).") )";
            }
            

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            if($this->input->post("tahun"))
            {
                $param['where']['year(laporan_kerja_harian.tanggal)'] = $this->input->post("tahun");
            }
            if($this->input->post("bulan"))
            {
                $param['where']['month(laporan_kerja_harian.tanggal)'] = $this->input->post("bulan");
            }


            if($this->input->post("id_pegawai"))
            {
                $param['where']['pegawai.id_pegawai'] = $this->input->post("id_pegawai");
            }
            
            if($this->pegawai){
                $param['where']['laporan_kerja_harian.id_verifikator'] = $this->pegawai->id_pegawai;
            }
            
            if($this->input->post("status_verifikasi"))
            {
                $param['where']['laporan_kerja_harian.status_verifikasi'] = $this->input->post("status_verifikasi");
            }


            $result = $this->Lkh_model->get($param)->result();

            $content = '';

            foreach($result as $key=>$row)
            {
                
                $offset++;

                $sudah_diverifikasi = ($row->sudah_diverifikasi == $row->jumlah_laporan) ? true : false;

                $status_desc = ($sudah_diverifikasi) ? '<span class="text-success">Sudah Diverifikasi</span>' : '<span class="text-danger">Belum Diverifikasi</span>';

                $action = '<button onclick="detail('.$row->id_pegawai.',\''.$row->tanggal.'\')" class="btn btn-default btn-outline btn-sm" title="Detail"><i class="ti ti-eye"></i></button>';
                if(!$sudah_diverifikasi)
                {
                    $action .= '&nbsp;<button onclick="verifikasi_langsung('.$row->id_pegawai.',\''.$row->tanggal.'\')"  class="btn btn-default btn-outline btn-sm" title="Verifikasi"><i class="ti ti-check"></i></button>';
                }
              
                $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.date("d M Y",strtotime($row->tanggal)).'</td>
                    <td>'.$row->nip.'</td>
                    <td>'.$row->nama_pegawai.'</td>
                    <td>'.$status_desc.'</td>
                    <td>'.$action.'</td>
                </tr>
                ';
            }

			if(!$result)
			{
				$content = '<tr><td colspan="7" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);


            $total_rows = $this->Lkh_model->get($param)->num_rows();


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
    
    

    public function submit()
    {
        
        $id_pegawai = $this->input->post("id_pegawai");
        $tanggal = $this->input->post("tanggal");
        if($this->input->is_ajax_request() && $id_pegawai && $tanggal)
        {
            $param['where']['laporan_kerja_harian.id_pegawai'] = $id_pegawai;
            $param['where']['laporan_kerja_harian.tanggal'] = $tanggal;
            $this->db->group_by("laporan_kerja_harian.id_laporan_kerja_harian");
            $result = $this->Lkh_model->get($param)->result();
            foreach($result as $key => $row)
            {
                $id_laporan_kerja_harian = $row->id_laporan_kerja_harian;

                if ($this->input->post("rating")) {
                    $dt_rating = array(
                        'id_laporan_kerja_harian'   => $id_laporan_kerja_harian,
                        'rating'                    => $this->input->post("rating"),
                        'komentar'                  => $this->input->post("komentar"),
                    );
                    $this->db->insert("laporan_kerja_harian_rating", $dt_rating);
                }
                $data = array(
                    'status_verifikasi' => $this->input->post("status_verifikasi"),
                );
    
                $update = $this->laporan_kinerja_harian_model->update($data, $id_laporan_kerja_harian);
    
    
    
                $detail = $this->laporan_kinerja_harian_model->get_by_id($id_laporan_kerja_harian);
                $detail = (array) $detail;
                $insert_log = $this->laporan_kinerja_harian_model->insert_log($detail, $id_laporan_kerja_harian);
    
                $id_pegawai = $detail['id_pegawai'];
                $bulan = date("m", strtotime($detail['tanggal']));
                $tahun = date("Y", strtotime($detail['tanggal']));
                $hitung_ulang_lkh = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);
            }
            $data['status'] = true;
            $data['message'] = "LKH Berhasil Diverifikasi";
        }
        $data['post'] = $_POST;
        echo json_encode($data);
    }
}