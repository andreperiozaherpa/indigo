<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
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

        $this->allow_all = ($this->user_level == "Administrator" || $this->role_pimpinan || in_array('tu_pimpinan',$array_privileges)) ? true : false;

        $this->pegawai = $dt_pegawai;

        if(!$hasPrivilege)
        {
            show_404();
        }

        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Laporan_model");
        
	}

    public function index()
    {
        $data['title']		    = 'Laporan Pencapaian Kinerja ASN | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/pegawai/index";
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
        else{
            $param['all'] = true;
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
            else if($this->pegawai && !$this->allow_all){
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

            

            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }


            $result = $this->Pegawai_model->get($param)->result();

			$content = $this->getContent($result,$offset,$_POST);
			if(!$result)
			{
				$content = '<tr><td colspan="6" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);

            if(!empty($ids_pegawai) && $ids_pegawai)
            {
                $this->db->where_in("pegawai.id_pegawai",$ids_pegawai);
            }

            $total_rows = $this->Pegawai_model->get($param)->num_rows();


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

    public function download()
    {
        $tahun = $this->input->get("tahun");
        $id_skpd = $this->input->get("id_skpd");
        $nama_skpd = $this->input->get("nama_skpd");
        if($tahun && $id_skpd)
        {
            $param = array();
           
            if($this->input->get("id_skpd"))
            {
                $param['where']['pegawai.id_skpd'] = $this->input->get("id_skpd");
            }

            if($this->input->get("id_unit_kerja"))
            {
                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,$this->input->get("id_unit_kerja"));
                $ids = array($this->input->get("id_unit_kerja"));
                $ids = array_merge($ids,$dt_unit_kerja[0]->id_unit_kerja_bawahan);
                $param['str_where'] = "(pegawai.id_unit_kerja in (".implode(",",$ids).") )";
            }

            if($this->input->get("search"))
            {
                $param['search'] = $this->input->get("search");
            }


            $result = $this->Pegawai_model->get($param)->result();

			$content = $this->getContent($result,$offset,$_GET);

            $data = '
            <p style="text-align:center"><b>LAPORAN PENCAPAIAN KINERJA PEGAWAI '.'</b><br>PEMERINTAH KABUPATEN SUMEDANG<br>'.$nama_skpd.'</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama </th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Capaian (%)</th>
                    </tr>
                </thead>
                <tbody>
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

            $pdf->writeHTML($data);
            ob_end_clean();
            $pdf->Output('Laporan_pencapaian_kinerja_pegawai.pdf', 'D');
        }
    }


    private function getContent($data,$offset=0,$filter=array())
    {
        $content = '';

        $ids = array();
        foreach($data as $row)
        {
            $ids[] = $row->id_pegawai;
        }

        if($ids)
        {
            $param = array();
            if(!empty($filter['tahun']))
            {
                $param['where']['skp.tahun'] = $filter['tahun'];
            }
            if(!empty($filter['bulan']))
            {
                $param['bulan'] = $filter['bulan'];
            }

            if(!empty($filter['id_skpd']))
            {
                $param['where']['pegawai.id_skpd'] = $filter['id_skpd'];
            }

            $param['group_by'] = "ASN";
            $param['str_where'] = "(pegawai.id_pegawai in (".implode(",",$ids).") )";

            if(!empty($filter['id_unit_kerja']))
            {
                //$param['where']['pegawai.id_unit_kerja'] = $filter['id_unit_kerja'];
                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,$filter['id_unit_kerja']);
                $ids_id_unit_kerja = array($filter['id_unit_kerja']);
                $ids_id_unit_kerja = array_merge($ids_id_unit_kerja,$dt_unit_kerja[0]->id_unit_kerja_bawahan);

                $param['str_where'] .= " AND (pegawai.id_unit_kerja in (".implode(",",$ids_id_unit_kerja).") )";
            }
            

            $summary = $this->Laporan_model->getSummary($param)->result();

            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_pegawai] = $s;
            }

            //echo "<pre>";print_r($dt_capaian);

            foreach($data as $key=>$row)
            {
                
                $capaian = 0;

                if(!empty($dt_capaian[$row->id_pegawai]))
                {
                    $capaian = number_format($dt_capaian[$row->id_pegawai]->capaian,2);
                }

                $offset++;
    
                $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.$row->nip.'</td>
                    <td>'.$row->nama_lengkap.'</td>
                    <td>'.$row->jabatan.'</td>
                    <td>'.$row->nama_unit_kerja.'</td>
                    <td>'.$capaian.'</td>
                </tr>
                ';
            }
        }

        


        return $content;
    }
    
    public function get_unit_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {

            if($this->pegawai->id_unit_kerja && !$this->allow_all)
            {
                $dt_unit_kerja = $this->db->where("id_unit_kerja",$this->pegawai->id_unit_kerja)->get("ref_unit_kerja")->result();
            }
            else{
                $this->load->model("sicerdas/Skpd_model");
                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($this->input->post('id_skpd'));
            }

            foreach($dt_unit_kerja as $row)
            {
                $pad = "";
                if($row->level_unit_kerja==2)
                {
                  $pad = '-';
                }
                else if($row->level_unit_kerja==3)
                {
                  $pad = '--';
                }
                else if($row->level_unit_kerja==4)
                {
                  $pad = '---';
                }
                $unit_kerja_induk = ($row->level_unit_kerja!=1)  ? " < ".$row->nama_unit_kerja_induk : "";
                $selected = (($this->pegawai->id_unit_kerja && !$this->allow_all) || ($row->id_unit_kerja == $this->input->post("id_unit_kerja")))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_unit_kerja.'">'.$pad.$row->nama_unit_kerja.$unit_kerja_induk.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_pegawai()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_unit_kerja"))
        {
            if($this->pegawai && !$this->allow_all)
            {
                $dt_pegawai = $this->db->where("id_pegawai",$this->pegawai->id_pegawai)->get("pegawai")->result();
            }
            else{

                $dt_unit_kerja = $this->Skpd_model->get_unit_kerja(null,$this->input->post("id_unit_kerja"));
                $ids = array($this->input->post("id_unit_kerja"));
                $ids = array_merge($ids,$dt_unit_kerja[0]->id_unit_kerja_bawahan);

                $dt_pegawai = $this->db->where("(pegawai.id_unit_kerja in (".implode(",",$ids).") )")->get("pegawai")->result();
            }



            foreach($dt_pegawai as $row)
            {
                $selected = (($this->pegawai && !$this->role_pimpinan) || ($row->id_pegawai == $this->input->post("id_pegawai")))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}