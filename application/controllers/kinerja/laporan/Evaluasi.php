<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluasi extends CI_Controller
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
        $this->load->model("sicerdas/Skpd_model");
        $this->load->model("kinerja/Skpd");
        $this->load->model("kinerja/Skp_model");

        $this->load->model("kinerja/Kinerja_utama_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");

        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Laporan_model");
        
	}

    public function index()
    {
        $data['title']		    = 'Hasil Evaluasi Kinerja Pegawai | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/evaluasi/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert','sparkline'];
        $data['active_menu']    = "laporan";

        $param = array();
        if($this->id_skpd)
        {
            $param['where']['skpd.id_skpd'] = $this->id_skpd;
        }

        $data['dt_skpd']        = $this->Skpd->get($param);

        
        
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
            
			$data = array();
    
            if($this->input->post("id_skpd"))
            {
                $param['where']['pegawai.id_skpd'] = $this->input->post("id_skpd");
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
                $param['where']['skp.tahun'] = $this->input->post("tahun");
            }

            $param['where']['skp.status'] = "Sudah Diverifikasi";


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
            

            $result = $this->Skp_model->get($param)->result();

            $content = '';

            foreach($result as $key=>$row)
            {
                
                $offset++;

                $token = md5("SKP".$row->id_skp);

                $triwulan = $this->input->post("triwulan");

                $action = '<a class="btn btn-default btn-outline btn-sm" href="'.base_url().'kinerja/laporan/evaluasi/download/'.$token.'?triwulan='.$triwulan.'" title="Download"><i class="ti ti-download"></i></a>';
                $action .= '&nbsp;<a target="_blank" class="btn btn-default btn-outline btn-sm" href="'.base_url().'kinerja/laporan/evaluasi/download/'.$token.'?triwulan='.$triwulan.'&preview=1" title="Lihat Preview"><i class="ti ti-search"></i></a>';
                $action .= '&nbsp;<a class="btn btn-default btn-outline btn-sm" href="'.base_url().'kinerja/laporan/evaluasi/kuadran/'.$token.'?triwulan='.$triwulan.'" title="Lihat Kuadran"><i class="ti ti-layout-grid2"></i></a>';
                
                if($this->pegawai && $this->pegawai->id_pegawai == $row->id_pegawai_atasan)
                {
                    $action .= '&nbsp;<a class="btn btn-default btn-outline btn-sm" href="'.base_url().'kinerja/laporan/evaluasi/form/'.$token.'?triwulan='.$triwulan.'" title="Lakukan Evaluasi"><i class="ti  ti-check"></i></a>';
                }

                $content .= '
                <tr>
                    <td>'.$offset.'</td>
                    <td>'.$row->nip.'</td>
                    <td>'.$row->nama_lengkap.'</td>
                    <td>'.$row->jabatan.'</td>
                    <td>'.$row->nama_unit_kerja.'</td>
                    <td>'.$action.'</td>
                </tr>
                ';
            }

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
    
    public function get_unit_kerja()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request() && $this->input->post("id_skpd"))
        {
            $this->load->model("sicerdas/Skpd_model");
            $dt_unit_kerja = $this->Skpd_model->get_unit_kerja($this->input->post('id_skpd'));



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
                $selected =  ($row->id_unit_kerja == $this->input->post("id_unit_kerja"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_unit_kerja.'">'.$pad.$row->nama_unit_kerja.$unit_kerja_induk.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function get_pegawai()
    {
        $content = '<option value="">Pilih</option>';
        if($this->input->is_ajax_request())
        {
            if($this->input->post("id_unit_kerja"))
            {
                $dt_pegawai = $this->db
                ->where("id_unit_kerja",$this->input->post("id_unit_kerja"))
                ->where("(id_pegawai_penilai_kerja = '".$this->pegawai->id_pegawai."') ")
                ->get("pegawai")->result();
            }
            else{
                $dt_pegawai = $this->db
                ->where("(id_pegawai = '".$this->pegawai->id_pegawai."' OR id_pegawai_penilai_kerja = '".$this->pegawai->id_pegawai."') ")
                ->get("pegawai")->result();
            }
            foreach($dt_pegawai as $row)
            {
                $selected = ($row->id_pegawai == $this->input->post("id_pegawai"))  ? "selected" : "";
                $content .= '<option '.$selected.' value="'.$row->id_pegawai.'">'.$row->nama_lengkap.'</option>';
            }           
        }
        $data['content'] = $content;
        echo json_encode($data);
    }

    public function download($token)
    {
        
        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }


        $param_pegawai['where']['pegawai.id_pegawai'] =$detail->id_pegawai;
        $param_pegawai['where']['pegawai.pensiun'] = 0;
        $dt_pegawai = $this->Pegawai_model->get($param_pegawai)->row();

        $this->role_pimpinan = ($dt_pegawai && $dt_pegawai->kepala_skpd == "Y" && in_array($dt_pegawai->jenis_skpd,['skpd','kecamatan']));


        //echo "<pre>";print_r($dt_pegawai);die;
        
        $content = $this->getContent($detail);

        if($this->input->get("preview")==1)
        {
            
        }
        else{
            $filename = "Evaluasi_Kinerja_" . $detail->nama_lengkap . "_tahun_".$detail->tahun_desc.".xls";
            $filename = str_replace(" ","_",$filename);
            $filename = str_replace(",","",$filename);
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
        }
        echo $content;
        
    }

    private function getContent($detail)
    {
        $triwulan = $this->input->get("triwulan");
        if($triwulan)
        {
            if($triwulan==1)
            {
                $param_summary['bulan'] = [1,2,3];
            }
            else if($triwulan==2)
            {
                $param_summary['bulan'] = [4,5,6];
            }
            else if($triwulan==3)
            {
                $param_summary['bulan'] = [7,8,9];
            }
            else if($triwulan==4)
            {
                $param_summary['bulan'] = [10,11,12];
            }
        }
        //$param_summary['str_where'] = "((renaksi.id_kinerja_utama is not null AND renaksi.id_kinerja_tambahan is null) OR (renaksi.id_kinerja_utama is null AND renaksi.id_kinerja_tambahan is not null))";
        $param_summary['where']['skp.tahun'] = $detail->tahun;
        $param_summary['where']['skpd.id_skpd'] = $detail->id_skpd;
        $param_summary['group_by'] = "skpd";

        $summary = $this->Laporan_model->getSummary($param_summary)->row();
        //echo "<pre>";print_r($summary);die;

        $capaian = ($summary) ? $summary->capaian : 0;

        $capaian_skpd = array(
            'capaian'  => number_format($capaian,2),
            'capaian_desc' => $this->Laporan_model->_capaian_skpd($capaian)
        );

        $detail->capaian_skpd = $capaian_skpd;

        unset($param_summary['where']['skpd.id_skpd']);
        unset($param_summary['group_by']);

        

        $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
        $summary = $this->Laporan_model->getSummary($param_summary)->row();
        $rating = ($summary) ? $summary->capaian : 0;

        $rating_hasil_kerja = array(
            'rating'  => number_format($rating,2),
            'rating_desc' => $this->Laporan_model->_rating_hasil_kerja($rating)
        );

        $detail->rating_hasil_kerja = $rating_hasil_kerja;


        $capaian_perilaku = $this->Perilaku_model->getCapaian($detail->id_skp);
        
        $rating_perilaku = array(
            'rating'  => number_format($capaian_perilaku,2),
            'rating_desc' => $this->Laporan_model->_rating_perilaku($capaian_perilaku)
        );

        

        $detail->rating_perilaku = $rating_perilaku;

        $predikat_kinerja = array(
            'predikat' => $this->Laporan_model->_predikat_kinerja($rating_hasil_kerja['rating_desc'],$rating_perilaku['rating_desc'])
        );

        $detail->predikat_kinerja = $predikat_kinerja;

        if($this->role_pimpinan)
        {
            return $this->_pimpinan($detail);   
        }
        else{
            return $this->_pegawai($detail);
        }
    }

    private function _pimpinan($detail)
    {
        //echo "<pre>";print_r($detail);die;
        $triwulan = $this->input->get("triwulan");
        $periode = "AKHIR";
        $periode_penilaian = "1 JANUARI S.D. 31 DESEMBER " . $detail->tahun_desc;
        if($triwulan && $triwulan <=4)
        {
            $periode = "TRIWULAN KE-" . $triwulan;
            if($triwulan==1)
            {
                $periode_penilaian = "1 JANUARI S.D. 31 MARET ". $detail->tahun_desc;
            }
            else if($triwulan==2)
            {
                $periode_penilaian = "1 APRIL S.D. 30 JUNI ". $detail->tahun_desc;
            }
            else if($triwulan==3)
            {
                $periode_penilaian = "1 JULI S.D. 30 SEPTEMBER ". $detail->tahun_desc;
            }
            else if($triwulan==4)
            {
                $periode_penilaian = "1 OKTOBER S.D. 31 DESEMBER ". $detail->tahun_desc;
            }
        }
        $content = '
            <html>
                <head>
                    <title>HASIL EVALUASI KINERJA PEGAWAI</title>
                </head>
                <body>
                    <table width="1700px">
                        <tr>
                            <td align="center" colspan="10">HASIL EVALUASI KINERJA PEGAWAI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="10">PENDEKATAN HASIL KERJA KUANTITATIF</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="10">BAGI PEJABAT PIMPINAN TINGGI DAN PIMPINAN UNIT KERJA MANDIRI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="10">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="10">PERIODE : '.$periode.'</td>
                        </tr>
                        <tr>
                            <td colspan="4">'.$detail->nama_skpd.'</td>
                            <td colspan="6">PERIODE PENILAIAN: '.$periode_penilaian.'</td>
                        </tr>
                    </table>
                    <table width="" style="border-collapse:collapse;" border="1" cellpandding="5" cellspacing="5">
                        <tr align="center">
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="3">PEGAWAI YANG DINILAI</td>
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="5">PEJABAT PENILAI KINERJA</td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>NAMA</td>
                            <td width="300px" colspan="2">'.$detail->nama_lengkap.'</td>
                            <td align="center" width="50px">1</td>
                            <td colspan="2">NAMA</td>
                            <td colspan="3">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center" width="50px">2</td>
                            <td width="300px">NIP</td>
                            <td colspan="2">\''.$detail->nip.' </td>
                            <td align="center">2</td>
                            <td colspan="2">NIP</td>
                            <td colspan="3">\''.$detail->nip_atasan.' </td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td colspan="2">'.$detail->pangkat.'</td>
                            <td align="center">3</td>
                            <td colspan="2">PANGKAT/GOL. RUANG</td>
                            <td colspan="3">'.$detail->pangkat_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td colspan="2">JABATAN</td>
                            <td>'.$detail->jabatan.'</td>
                            <td align="center">4</td>
                            <td colspan="2">JABATAN</td>
                            <td colspan="3">'.$detail->jabatan_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td colspan="2">'.$detail->nama_unit_kerja.'</td>
                            <td align="center">5</td>
                            <td colspan="2">INSTANSI</td>
                            <td colspan="3">'.$detail->nama_skpd_atasan.'</td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>CAPAIAN KINERJA ORGANISASI*</b>
                            <br>'.$detail->capaian_skpd['capaian_desc'].' ('.$detail->capaian_skpd['capaian'].')
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>POLA DISTRIBUSI</b>
                            <br>(diisi dengan gambar pola distribusi)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="10">HASIL KERJA</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td>No</td>
                            <td>Rencana Hasil Kerja / Sasaran</td>
                            <td colspan="3">Indikator Kinerja Individu</td>
                            <td>Target</td>
                            <td>Satuan</td>
                            <td>Perspektif</td>
                            <td>Realisasi Berdasarkan Bukti Dukung</td>
                            <td>Umpan Balik Berkelanjutan Berdasarkan Butki Dukung</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td width="50px">1</td>
                            <td width="300px">2</td>
                            <td width="400px" colspan="3">3</td>
                            <td width="150px">4</td>
                            <td width="200px">5</td>
                            <td width="200px">6</td>
                            <td width="150px">7</td>
                            <td width="150px">8</td>
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="10">A. UTAMA</td>
                        </tr>
                        '.$this->_kinerjaUtama($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="10">B. INSTRUKSI KHUSUS PIMPINAN</td>
                        </tr>
                        '.$this->_instruksi($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="10">C. TAMBAHAN</td>
                        </tr>
                        '.$this->_kinerjaTambahan($detail).'
                        <tr>
                            <td colspan="11"><b>RATING HASIL KERJA*</b>
                            <br>'.$detail->rating_hasil_kerja['rating_desc'].' ('.$detail->rating_hasil_kerja['rating'].')
                            </td>
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="10">PERILAKU KERJA</td>
                        </tr>
                        '.$this->_perilaku($detail->id_skp).'
                        <tr>
                            <td colspan="11"><b>RATING PERILAKU KERJA*</b>
                            <br>'.$detail->rating_perilaku['rating_desc'].' ('.$detail->rating_perilaku['rating'].')
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>PREDIKAT KINERJA PEGAWAI*</b>
                            <br>'.$detail->predikat_kinerja['predikat'].'
                            </td>
                        </tr>
                    </table>

                    <table width="1700px">
                        <tr align="center">
                            <td colspan="5" width="50%">&nbsp;</td>
                            <td colspan="5" width="50%"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="5">(tempat), (tanggal, bulan, tahun)</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="5">Pejabat Penilai Kinerja</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="5">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="5">'.$detail->nip_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                    </table>
                </body>
            </html>
        ';

        return $content;
    }

    private function _pegawai($detail)
    {
        //echo "<pre>";print_r($detail);die;

        $triwulan = $this->input->get("triwulan");
        $periode = "AKHIR";
        $periode_penilaian = "1 JANUARI S.D. 31 DESEMBER " . $detail->tahun_desc;
        if($triwulan && $triwulan <=4)
        {
            $periode = "TRIWULAN KE-" . $triwulan;
            if($triwulan==1)
            {
                $periode_penilaian = "1 JANUARI S.D. 31 MARET ". $detail->tahun_desc;
            }
            else if($triwulan==2)
            {
                $periode_penilaian = "1 APRIL S.D. 30 JUNI ". $detail->tahun_desc;
            }
            else if($triwulan==3)
            {
                $periode_penilaian = "1 JULI S.D. 30 SEPTEMBER ". $detail->tahun_desc;
            }
            else if($triwulan==4)
            {
                $periode_penilaian = "1 OKTOBER S.D. 31 DESEMBER ". $detail->tahun_desc;
            }
        }

        $content = '
            <html>
                <head>
                    <title>HASIL EVALUASI KINERJA PEGAWAI</title>
                </head>
                <body>
                    <table width="2000px" border="0">
                        <tr>
                            <td align="center" colspan="11">HASIL EVALUASI KINERJA PEGAWAI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="11">PENDEKATAN HASIL KERJA KUANTITATIF</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="11">BAGI PEJABAT ADMINISTRASI DAN PEJABAT FUNGSIONAL</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="11">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="11">PERIODE : '.$periode.'</td>
                        </tr>
                        <tr>
                            <td colspan="4">'.$detail->nama_skpd.'</td>
                            <td colspan="6">PERIODE PENILAIAN: '.$periode_penilaian.'</td>
                        </tr>
                    </table>
                    <table width="" style="border-collapse:collapse;" border="1" cellpandding="5" cellspacing="5">
                        <tr align="center">
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="3">PEGAWAI YANG DINILAI</td>
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="6">PEJABAT PENILAI KINERJA</td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>NAMA</td>
                            <td width="300px" colspan="2">'.$detail->nama_lengkap.'</td>
                            <td align="center" width="50px">1</td>
                            <td>NAMA</td>
                            <td colspan="5">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center" width="50px">2</td>
                            <td width="300px">NIP</td>
                            <td colspan="2">\''.$detail->nip.' </td>
                            <td align="center">2</td>
                            <td>NIP</td>
                            <td colspan="5">\''.$detail->nip_atasan.' </td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td colspan="2">'.$detail->pangkat.'</td>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td colspan="5">'.$detail->pangkat_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>JABATAN</td>
                            <td colspan="2">'.$detail->jabatan.'</td>
                            <td align="center">4</td>
                            <td>JABATAN</td>
                            <td colspan="5">'.$detail->jabatan_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td colspan="2">'.$detail->nama_unit_kerja.'</td>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td colspan="5">'.$detail->nama_unit_kerja_atasan.'</td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>CAPAIAN KINERJA ORGANISASI*</b>
                            <br>'.$detail->capaian_skpd['capaian_desc'].' ('.$detail->capaian_skpd['capaian'].')
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>POLA DISTRIBUSI</b>
                            <br>(diisi dengan gambar pola distribusi)
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11">HASIL KERJA</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td>No</td>
                            <td>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</td>
                            <td>Rencana Hasil Kerja</td>
                            <td colspan="2">Aspek</td>
                            <td>Kegiatan / Sub Kegiatan</td>
                            <td>Indikator Kinerja Individu</td>
                            <td>Target</td>
                            <td>Satuan</td>
                            <td>Realisasi Berdasarkan Bukti Dukung</td>
                            <td>Umpan Balik Berkelanjutan Berdasarkan Butki Dukung</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td width="50px">1</td>
                            <td width="300px">2</td>
                            <td width="300px">3</td>
                            <td width="150px" colspan="2">4</td>
                            <td width="300px">5</td>
                            <td width="300px">6</td>
                            <td width="150px">7</td>
                            <td width="150px">8</td>
                            <td width="150px">9</td>
                            <td width="150px">10</td>
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="11">A. UTAMA</td>
                        </tr>
                        '.$this->_kinerjaUtama($detail).'

                        <tr style="background-color:#e4eef2">
                            <td colspan="11">B. INSTRUKSI KHUSUS PIMPINAN</td>
                        </tr>
                        '.$this->_instruksi($detail).'

                        <tr style="background-color:#e4eef2">
                            <td colspan="11">C. TAMBAHAN</td>
                        </tr>
                        '.$this->_kinerjaTambahan($detail).'
                        
                        <tr>
                            <td colspan="11"><b>RATING HASIL KERJA*</b>
                            <br>'.$detail->rating_hasil_kerja['rating_desc'].' ('.$detail->rating_hasil_kerja['rating'].')
                            </td>
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="11">PERILAKU KERJA</td>
                        </tr>
                        '.$this->_perilaku($detail->id_skp).'
                        <tr>
                            <td colspan="11"><b>RATING PERILAKU KERJA*</b>
                            <br>'.$detail->rating_perilaku['rating_desc'].' ('.$detail->rating_perilaku['rating'].')
                            </td>
                        </tr>
                        <tr>
                            <td colspan="11"><b>PREDIKAT KINERJA PEGAWAI*</b>
                            <br>'.$detail->predikat_kinerja['predikat'].'
                            </td>
                        </tr>
                    </table>

                    <table width="2000px" border="0">
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5" width="50%"></td>
                            <td colspan="6" width="50%">(tempat), (tanggal, bulan, tahun)</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="6">Pejabat Penilai Kinerja</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="6"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="6">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5"></td>
                            <td colspan="6">'.$detail->nip_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="5">&nbsp;</td>
                            <td colspan="6"></td>
                        </tr>
                    </table>
                </body>
            </html>
        ';

        return $content;
    }

    
    private function _kinerjaUtama($detail)
    {
        
        $param['where']['kinerja_utama.id_skp'] = $detail->id_skp;

        $result = $this->Kinerja_utama_model->get($param)->result();
        $tahun = $detail->tahun;
        $content = "";

        $triwulan = $this->input->get("triwulan");
        if($triwulan)
        {
            if($triwulan==1)
            {
                $param_summary['bulan'] = [1,2,3];
            }
            else if($triwulan==2)
            {
                $param_summary['bulan'] = [4,5,6];
            }
            else if($triwulan==3)
            {
                $param_summary['bulan'] = [7,8,9];
            }
            else if($triwulan==4)
            {
                $param_summary['bulan'] = [10,11,12];
            }
        }

        $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
        $param_summary['group_by'] = "kinerja_utama";

        $summary = $this->Laporan_model->getSummary($param_summary)->result();

        $dt_capaian = array();
        foreach($summary as $s)
        {
            $dt_capaian[$s->id_kinerja_utama] = $s;
        }

        foreach($result as $key=>$row)
        {
            $capaian = 0;
            $field = ($triwulan) ? "umpan_balik_".$triwulan : "umpan_balik";
            $umpan_balik = ($row->$field);

            if(!empty($dt_capaian[$row->id_kinerja_utama]))
            {
                $capaian = number_format($dt_capaian[$row->id_kinerja_utama]->capaian,2);
            }
            

            if($this->role_pimpinan)
            {
                $dt_perspektif = ($row->perspektif!="") ? explode(",",$row->perspektif) : [];

                $perspektif = '';
                if($dt_perspektif)
                {
                    $perspektif = '
                    - '.implode("<br>- ",$dt_perspektif);
                }


                $target = "sasaran_target_tahun_" . $tahun;
                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$row->nama_sasaran_renstra.'</td>
                    <td colspan="3">'.$row->nama_indikator_sasaran_renstra.'</td>
                    <td>'.$row->$target.'</td>
                    <td>'.$row->sasaran_satuan.'</td>
                    <td>'.$perspektif.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>
                ';

            }
            else{

                $indikator_atasan = '';
                $nama_indikator = '';
                $kegiatan = '';
                if($row->flag=="kegiatan")
                {
                    $indikator_atasan = $row->nama_indikator_sasaran_renstra;
                    $kegiatan = $row->nama_kegiatan;
                    $nama_indikator = $row->nama_indikator_kegiatan;
                    $target = "kegiatan_target_tahun_" . $tahun;
                    $satuan = "kegiatan_satuan";
                }
                if($row->flag=="sub_kegiatan")
                {
                    $indikator_atasan = $row->nama_indikator_kegiatan;
                    $kegiatan = $row->nama_sub_kegiatan;
                    $nama_indikator = $row->nama_indikator_sub_kegiatan;
                    $target = "sub_kegiatan_target";
                    $satuan = "sub_kegiatan_satuan";
                }
                
                $dt_aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $aspek = '';
                if($dt_aspek)
                {
                    $aspek = '
                    - '.implode("<br>- ",$dt_aspek);
                }

                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$indikator_atasan.'</td>
                    <td>'.$row->rencana_hasil_kerja.'</td>
                    <td colspan="2">'.$aspek.'</td>
                    <td>'.$kegiatan.'</td>
                    <td>'.$nama_indikator.'</td>
                    <td>'.$row->$target.'</td>
                    <td>'.$row->$satuan.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>';

            }

        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="10" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="11" align="center">-Belum ada data-</td></tr>';
            }
        }

        return $content;
    }

    private function _instruksi($detail)
    {
        $param['where']['instruksi_khusus.id_skp'] = $detail->id_skp;

        $result = $this->Instruksi_model->get_instruksi_khusus($param)->result();
        $tahun = $detail->tahun;
        $content = "";

        $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
        $param_summary['group_by'] = "instruksi_khusus";

        $triwulan = $this->input->get("triwulan");
        if($triwulan)
        {
            if($triwulan==1)
            {
                $param_summary['bulan'] = [1,2,3];
            }
            else if($triwulan==2)
            {
                $param_summary['bulan'] = [4,5,6];
            }
            else if($triwulan==3)
            {
                $param_summary['bulan'] = [7,8,9];
            }
            else if($triwulan==4)
            {
                $param_summary['bulan'] = [10,11,12];
            }
        }

        $summary = $this->Laporan_model->getSummary($param_summary)->result();

        $dt_capaian = array();
        foreach($summary as $s)
        {
            $dt_capaian[$s->id_instruksi_khusus] = $s;
        }

        foreach($result as $key=>$row)
        {
            $capaian = 0;
            $field = ($triwulan) ? "umpan_balik_".$triwulan : "umpan_balik";
            $umpan_balik = ($row->$field);
            if(!empty($dt_capaian[$row->id_instruksi_khusus]))
            {
                $capaian = number_format($dt_capaian[$row->id_instruksi_khusus]->capaian,2);
                
            }
            
            if($this->role_pimpinan)
            {
                $dt_perspektif = ($row->perspektif!="") ? explode(",",$row->perspektif) : [];

                $perspektif = '';
                if($dt_perspektif)
                {
                    $perspektif = '
                    - '.implode("<br>- ",$dt_perspektif);
                }


                $target = "sasaran_target_tahun_" . $tahun;
                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$row->nama_instruksi.'</td>
                    <td colspan="3">'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    <td>'.$perspektif.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>
                ';

            }
            else{

                $aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $dt_aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $aspek = '';
                if($dt_aspek)
                {
                    $aspek = '
                    - '.implode("<br>- ",$dt_aspek);
                }

                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$row->nama_instruksi_atasan.'</td>
                    <td>'.$row->nama_instruksi.'</td>
                    <td colspan="2">'.$aspek.'</td>
                    <td>-</td>
                    <td>'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>';

                
            }

        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="10" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="11" align="center">-Belum ada data-</td></tr>';
            }
        }

        return $content;
    }
    
    private function _kinerjaTambahan($detail)
    {
        $param['where']['kinerja_tambahan.id_skp'] = $detail->id_skp;

        $result = $this->Kinerja_tambahan_model->get($param)->result();
        $tahun = $detail->tahun;
        $content = "";

        $param_summary['where']['capaian.id_skp'] = $detail->id_skp;
        $param_summary['group_by'] = "kinerja_tambahan";

        $triwulan = $this->input->get("triwulan");
        if($triwulan)
        {
            if($triwulan==1)
            {
                $param_summary['bulan'] = [1,2,3];
            }
            else if($triwulan==2)
            {
                $param_summary['bulan'] = [4,5,6];
            }
            else if($triwulan==3)
            {
                $param_summary['bulan'] = [7,8,9];
            }
            else if($triwulan==4)
            {
                $param_summary['bulan'] = [10,11,12];
            }
        }

        $summary = $this->Laporan_model->getSummary($param_summary)->result();

        $dt_capaian = array();
        foreach($summary as $s)
        {
            $dt_capaian[$s->id_kinerja_tambahan] = $s;
        }

        foreach($result as $key=>$row)
        {
            $capaian = 0;
            $field = ($triwulan) ? "umpan_balik_".$triwulan : "umpan_balik";
            $umpan_balik = ($row->$field);

            if(!empty($dt_capaian[$row->id_kinerja_tambahan]))
            {
                $capaian = number_format($dt_capaian[$row->id_kinerja_tambahan]->capaian,2);
                
            }
            
            if($this->role_pimpinan)
            {
                $dt_perspektif = ($row->perspektif!="") ? explode(",",$row->perspektif) : [];

                $perspektif = '';
                if($dt_perspektif)
                {
                    $perspektif = '
                    - '.implode("<br>- ",$dt_perspektif);
                }


                $target = "sasaran_target_tahun_" . $tahun;
                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$row->rencana_hasil_kerja.'</td>
                    <td colspan="3">'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    <td>'.$perspektif.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>
                ';

            }
            else{

                $aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $dt_aspek = ($row->aspek!="") ? explode(",",$row->aspek) : [];

                $aspek = '';
                if($dt_aspek)
                {
                    $aspek = '
                    - '.implode("<br>- ",$dt_aspek);
                }

                $content .= '
                <tr>
                    <td align="center">'.($key+1).'</td>
                    <td>'.$row->rencana_hasil_kerja_atasan.'</td>
                    <td>'.$row->rencana_hasil_kerja.'</td>
                    <td colspan="2">'.$aspek.'</td>
                    <td>-</td>
                    <td>'.$row->indikator_kinerja_individu.'</td>
                    <td>'.$row->target.'</td>
                    <td>'.$row->satuan_desc.'</td>
                    <td>'.$capaian.'</td>
                    <td>'.$umpan_balik.'</td>
                </tr>';

            }

        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="10" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="11" align="center">-Belum ada data-</td></tr>';
            }
        }

        return $content;
    }

    private function _perilaku($id_skp)
    {
        $offset = 0;
        $param = array();

        $data = array();

        $param['where']['perilaku.id_skp'] = $id_skp;

        $result = $this->Perilaku_model->get($param)->result();

        $dt_aspek = $this->Perilaku_model->getAspek()->result();

        $aspek = array();

        foreach($dt_aspek as $row)
        {
            $aspek[$row->id_ref_perilaku][] = $row->nama_aspek;
        }

        $catatan = '';

        //echo "<pre>" ;print_r($aspek);die;

        $content = '';
        foreach($result as $key=>$row)
        {
            $nama_perilaku = $row->nama_perilaku;
            $nama_aspek = implode("<br>-",$aspek[$row->id_ref_perilaku]);

            $nama_perilaku .= "<br>-$nama_aspek";
            if($this->role_pimpinan)
            {
                $content .= '
                    <tr valign="top">
                        <td>'.($key+1).'</td>
                        <td colspan="3">'.$nama_perilaku.'</td>
                        <td colspan="6">Ekspektasi Khusus Pimpinan: <br>'.$row->ekspektasi.'</td>
                    </tr>
                ';
            }
            else{
                $content .= '
                    <tr valign="top">
                        <td>'.($key+1).'</td>
                        <td colspan="5">'.$nama_perilaku.'</td>
                        <td colspan="5">Ekspektasi Khusus Pimpinan: <br>'.$row->ekspektasi.'</td>
                    </tr>
                ';
            }

        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="10" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="11" align="center">-Belum ada data-</td></tr>';
            }
        }

        return $content;
    }


    public function kuadran($token)
    {
        
        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }

        
        $data['title']		    = 'Kuadran | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/evaluasi/kuadran";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = [];
        $data['active_menu']    = "laporan";

        $param_summary['where']['capaian.id_skp'] = $detail->id_skp;

        $triwulan = $this->input->get("triwulan");
        if($triwulan)
        {
            if($triwulan==1)
            {
                $param_summary['bulan'] = [1,2,3];
            }
            else if($triwulan==2)
            {
                $param_summary['bulan'] = [4,5,6];
            }
            else if($triwulan==3)
            {
                $param_summary['bulan'] = [7,8,9];
            }
            else if($triwulan==4)
            {
                $param_summary['bulan'] = [10,11,12];
            }
        }

        $summary = $this->Laporan_model->getSummary($param_summary)->row();
        $rating = ($summary) ? $summary->capaian : 0;
        $hasil_kerja = $this->Laporan_model->_rating_hasil_kerja($rating);

        $capaian_perilaku = $this->Perilaku_model->getCapaian($detail->id_skp);
        $perilaku = $this->Laporan_model->_rating_perilaku($capaian_perilaku);

        $data['box'] = $this->Laporan_model->_get_box($hasil_kerja,$perilaku);

        $data['detail']         = $detail;

        $data['triwulan']       = $triwulan;

        //echo "<pre>";print_r($detail);die;

        $this->load->view('admin/main', $data);
    }

    public function form($token)
    {
        
        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token || $detail->id_pegawai_atasan != $this->pegawai->id_pegawai)
        {
            show_404();
        }


        $data['title']		    = 'Evaluasi Kinerja Pegawai | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/laporan/evaluasi/form/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "laporan";


        $data['detail'] = $detail;

        $data['triwulan'] = $this->input->get("triwulan");

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

                $umpan_balik = $this->input->post("umpan_balik");
                $triwulan = $this->input->post("triwulan");

                $field = "umpan_balik";
                if($triwulan && $triwulan >=1 && $triwulan <= 4)
                {
                    $field = "umpan_balik_" . $triwulan;
                }

                if($umpan_balik)
                {
                    if(!empty($umpan_balik['kinerja_utama']))
                    {
                        foreach($umpan_balik['kinerja_utama'] as $id_kinerja_utama => $catatan)
                        {
                            $this->db->set($field,$catatan)->where("id_kinerja_utama",$id_kinerja_utama)->update("ekinerja_utama");
                        }
                    }

                    if(!empty($umpan_balik['instruksi']))
                    {
                        foreach($umpan_balik['instruksi'] as $id_instruksi_khusus => $catatan)
                        {
                            $this->db->set($field,$catatan)->where("id_instruksi_khusus",$id_instruksi_khusus)->update("ekinerja_instruksi_khusus");
                        }
                    }

                    if(!empty($umpan_balik['kinerja_tambahan']))
                    {
                        foreach($umpan_balik['kinerja_tambahan'] as $id_kinerja_tambahan => $catatan)
                        {
                            $this->db->set($field,$catatan)->where("id_kinerja_tambahan",$id_kinerja_tambahan)->update("ekinerja_tambahan");
                        }
                    }

                }
                
                $data['status'] = true;
                $data['message'] = "Evaluasi Berhasil Disimpan";

                
                $data['post'] = $_POST;
                
                echo json_encode($data);
            }           
        }   
    }

    public function get_curva()
    {
        $content = '';
        $tahun = $this->input->post("tahun");
        $id_skpd = $this->input->post("id_skpd");
        if($this->input->is_ajax_request() && $tahun && $id_skpd)
        {
            $triwulan = $this->input->post("triwulan");
            if($triwulan)
            {
                if($triwulan==1)
                {
                    $param_summary['bulan'] = [1,2,3];
                }
                else if($triwulan==2)
                {
                    $param_summary['bulan'] = [4,5,6];
                }
                else if($triwulan==3)
                {
                    $param_summary['bulan'] = [7,8,9];
                }
                else if($triwulan==4)
                {
                    $param_summary['bulan'] = [10,11,12];
                }
            }
            //$param_summary['str_where'] = "((renaksi.id_kinerja_utama is not null AND renaksi.id_kinerja_tambahan is null) OR (renaksi.id_kinerja_utama is null AND renaksi.id_kinerja_tambahan is not null))";
            $param_summary['where']['skp.tahun'] = $tahun;
            $param_summary['where']['skpd.id_skpd'] = $id_skpd;
            $param_summary['group_by'] = "skpd";

            $summary = $this->Laporan_model->getSummary($param_summary)->row();
            //echo "<pre>";print_r($summary);die;

            $capaian = ($summary) ? $summary->capaian : 0;

            $capaian_skpd = array(
                'capaian'  => number_format($capaian,2),
                'capaian_desc' => $this->Laporan_model->_capaian_skpd($capaian)
            );

            


            $sangat_kurang = 0;
            $kurang = 0;
            $butuh_perbaikan = 0;
            $baik = 0;
            $sangat_baik = 0;

            $param_summary['group_by'] = "ASN";
            unset($param_summary['where']['skpd.id_skpd']);
            $param_summary['where']['pegawai.id_skpd'] = $id_skpd;
            $dt_summary = $this->Laporan_model->getSummary($param_summary)->result();
            foreach($dt_summary as $row)
            {
                $capaian = $row->capaian;
                $capaian_desc = $this->Laporan_model->_capaian_skpd($capaian);

                if($capaian_desc=="SANGAT KURANG")
                {
                    $sangat_kurang++;
                }
                else if($capaian_desc=="KURANG")
                {
                    $kurang++;
                }
                else if($capaian_desc=="BUTUH PERBAIKAN")
                {
                    $butuh_perbaikan++;
                }
                else if($capaian_desc=="BAIK")
                {
                    $baik++;
                }
                else
                {
                    $sangat_baik++;
                }
            }

            
            $content = '
            <h4 class="box-title_">'.strtoupper('Kurva Distribusi Predikat Kinerja Pegawai').'</h4>
                <h5 class="box-title_">'.strtoupper('Dengan Capaian Kinerja Organisasi '.$capaian_skpd['capaian_desc']).'</h5>
                <div class="stats-row">
                    <div class="stat-item">
                        <h6>Sangat<br>Kurang</h6>
                        <b>'.number_format($sangat_kurang).'</b>
                    </div>
                    <div class="stat-item">
                        <h6>Kurang/<br>Misconduct</h6>
                        <b>'.number_format($kurang).'</b>
                    </div>
                    <div class="stat-item">
                        <h6>Butuh<br>Perbaikan</h6>
                        <b>'.number_format($butuh_perbaikan).'</b>
                    </div>
                    <div class="stat-item">
                        <h6>Baik</h6>
                        <b>'.number_format($baik).'</b>
                    </div>
                    <div class="stat-item">
                        <h6>Sangat<br>Baik</h6>
                        <b>'.number_format($sangat_baik).'</b>
                    </div>
                </div>
                <div  id="curva-chart"></div>
                ';

            $chart = [$sangat_kurang,$kurang,$butuh_perbaikan,$baik,$sangat_baik];
            $data['chart'] = $chart;
        }
        $data['content'] = $content;
        echo json_encode($data);
    }
}