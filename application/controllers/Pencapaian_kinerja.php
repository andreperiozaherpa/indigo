<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pencapaian_kinerja extends CI_Controller {
	public $user_id;

	public function __construct(){
		parent ::__construct();
		$this->default_tahun = 2019;
		$this->load->model('visitor_model');
        $this->load->model("kinerja/Config");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("kinerja/Laporan_model");
        $this->load->model("master_pegawai_model");
		$this->load->helper('text');
		$this->load->helper('typography');
		$this->load->helper('file');
		$this->visitor_model->cek_visitor();

		$this->load->model('company_profile_model');

		$this->company_profile_model->set_identity();
	}

	public function index()
	{
        $data['title']		    = 'Laporan Pencapaian Kinerja SKPD | ' . $this->Config->app_name;
		// $data['content']	    = "kinerja/laporan/skpd/index";
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "pencapaian_kinerja";

		$this->load->view('blog/src/header',$data);
		$this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/pencapaian_kinerja',$data);
		$this->load->view('blog/src/footer',$data);
	}

	public function detail($id_skpd=null,$tahun=null,$iframe=false)
	{
		if ($id_skpd == null || $tahun ==null) {
			redirect('pengukuran_kinerja/index/'.date("Y"));
		}
		$valid_tahun = [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026];
		if (!in_array($tahun, $valid_tahun)) {
			show_404();
		}
		$data['title'] = "Detail Pengukuran Kinerja - " .$this->company_profile_model->nama;
		$data['active_menu'] ="pengukuran_kinerja";
		// $data['level'] = $level;
		// $data['id_induk'] = $id_induk;
		$data['detail'] = $this->ref_skpd_model->get_by_id($id_skpd);

		$jenis = array('ss'=>'Sasaran Strategis','sp'=>'Sasaran Program','sk'=>'Sasaran Kegiatan');
		if(!empty($_POST)){
			foreach($jenis as $j => $v){
				$name = $this->renja_perencanaan_model->name($j);
				if(!empty($_POST[$name['cIku']])){
					$id = $_POST[$name['cIku']];
					foreach($id as $i){
						$insert = array(
							$name['cIku']  => $i,
							$name['taIkuRenja'] => $_POST[$name['taIkuRenja'].$i],
							$name['aIkuRenja'] =>$_POST[$name['aIkuRenja'].$i],
							'id_unit_kerja' => $_POST['id_unit_kerja'],
							'tahun_renja' => $_POST['tahun_renja']
						);
						$cek_iku = $this->renja_perencanaan_model->cek_iku_renja($j,$i);
						if(!$cek_iku){
							$in = $this->renja_perencanaan_model->insert_iku_renja($j,$insert);
						}
					}
				}
			}
		}

		$data['tahun'] = $tahun;
		$data['id_skpd'] = $id_skpd;
		$data['skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
		$data['kepala_skpd'] = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
		$data['jumlah_pegawai'] = $this->master_pegawai_model->get_jml_by_id_skpd($id_skpd);
		$data['unit_kerja'] = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($id_skpd);

		$data['jenis'] = $jenis;

		$this->load->view('blog/src/header',$data);
		if($iframe==false) $this->load->view('blog/src/top_nav',$data);
		$this->load->view('blog/pengukuran_kinerja_detail2',$data);
		if($iframe==false) $this->load->view('blog/src/footer',$data);
	}

	public function download_file($id_berkas_file){
		$id_berkas_file = explode('_', $id_berkas_file);
		$id_berkas_file = $id_berkas_file[0];
		$this->berkas_file_model->id_berkas_file = $id_berkas_file;
		$data = $this->berkas_file_model->get_by_id();
		$file = urldecode($data->hash_file);
		$filepath = $data->path_file . $file;
		echo $filepath;
		if(file_exists($filepath)) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($data->nama_file).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filepath));
			flush();
			readfile($filepath);
			exit;
		}
	}

    public function get_list($rowno=1)
    {
        if($this->input->is_ajax_request())
        {
            // Row per page
            $rowperpage = 100;
            $offset = ($rowno-1) * $rowperpage;

            $param = array();
            $param['limit']     = $rowperpage;
            $param['offset']    = $offset;
            
			$data = array();
    
            if($this->input->post("search"))
            {
                $param['search'] = $this->input->post("search");
            }

            // $param['where'] = array(
            //     "skpd.jenis_skpd" => 'skpd',
            //     "skpd.jenis_skpd" => 'kecamatan'
            // );
            $param['str_where'] = "(skpd.jenis_skpd = 'skpd' OR skpd.jenis_skpd = 'kecamatan')";

            $result = $this->Skpd_model->get($param)->result();

			$content = $this->getContent($result,$offset,false,$_POST);
			if(!$result)
			{
				$content = '<tr><td colspan="4" align="center">-Belum ada data-</td></tr>';
			}

            unset($param['limit']);
            unset($param['offset']);
            $total_rows = $this->Skpd_model->get($param)->num_rows();


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
        if($tahun)
        {
            $param = array();
            if($this->input->get("search"))
            {
                $param['search'] = $this->input->get("search");
            }

            $result = $this->Skpd_model->get($param)->result();

			$content = $this->getContent($result,0,false,$_GET);

            $data = '
            <p style="text-align:center"><b>LAPORAN PENCAPAIAN KINERJA SKPD '.'</b><br>PEMERINTAH KABUPATEN SUMEDANG</p>
            <table width="100%" border="1" cellpadding="5">
                <thead>
                    <tr style="background-color:#000000;color:#FFFFFF">
                        <th>No</th>
                        <th>Nama SKPD</th>
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
            $pdf->AddPage('P');

            $pdf->writeHTML($data);
            ob_end_clean();
            $pdf->Output('Laporan_pencapaian_kinerja_skpd.pdf', 'D');
        }
    }


    private function getContent($data,$offset=0,$download=false,$filter=array())
    {
        $content = '';

        $ids = array();

        foreach($data as $row)
        {
            $ids[] = $row->id_skpd;
        }

        if($ids)
        {
            $param = array();
            $tahun = '';
            $bulan = '';
            if(!empty($filter['tahun']))
            {
                $param['where']['skp.tahun'] = $filter['tahun'];
                $tahun = $filter['tahun'];
            }
            if(!empty($filter['bulan']))
            {
                $param['bulan'] = $filter['bulan'];
                $bulan = $filter['bulan'];
            }

            $param['group_by'] = "skpd";

            $summary = $this->Laporan_model->getSummary($param)->result();

            $dt_capaian = array();
            foreach($summary as $s)
            {
                $dt_capaian[$s->id_skpd] = $s;
            }

            foreach($data as $key=>$row)
            {
                $btn_aksi = '';
                if(!$download)
                {
                    $link =  base_url()."pencapaian_kinerja/unit_kerja?id_skpd=".$row->id_skpd.'&tahun='.$tahun."&bulan=".$bulan;
                    $btn_aksi = '<td><a target="_blank" href="'.$link.'" class="btn btn-default btn-outline btn-sm">Detail</a></td>';
                }
                $btn_aksi = '';
    
                $offset++;

                $capaian = 0;

                if(!empty($dt_capaian[$row->id_skpd]))
                {
                    $capaian = number_format($dt_capaian[$row->id_skpd]->capaian,2);
                }

                $kepala_skpd = $this->master_pegawai_model->get_pegawai_kepala_skpd($row->id_skpd);

                $foto_kepala = '<img style="width: 30px;height:30px;object-fit:cover" src="'.base_url().'data/foto/pegawai/'.@$kepala_skpd->foto_pegawai.'" alt="user" class="img-circle" />&nbsp;';
                
                if($kepala_skpd){
                    $content .= '
                    <tr>
                        <td>'.$offset.'</td>
                        <td>'.$row->nama_skpd.'</td>
                        <td style="white-space: nowrap;">'.$foto_kepala.$kepala_skpd->nama_lengkap.'</td>
                        <td><span style="color:#FFFFFF;font-size:13px;background-color:#6441EB;padding:2px 5px;border-radius:30px;">'.$capaian.'</span></td>
                        '.$btn_aksi.'
                    </tr>
                    ';
                }
            }
        }


        return $content;
    }

}
?>
