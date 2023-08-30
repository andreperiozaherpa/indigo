<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		if (!$this->user_id) {
            redirect('admin');
        }

        $this->load->model("kinerja/Config");
        $this->load->model("kinerja/Skp_model");
        $this->load->model("sicerdas/Globalvar");
        $this->load->model("kinerja/Kinerja_utama_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Perilaku_model");

        $this->role_pimpinan = null;
	}


    public function index()
    {
        $token = $this->input->get("token");


        $data['title']		    = 'Detail SKP | ' . $this->Config->app_name;
		$data['content']	    = "kinerja/skp/detail/index";
		$data['user_picture']   = $this->user_picture;
		$data['full_name']		= $this->full_name;
		$data['user_level']		= $this->user_level;
        $data['plugins']        = ['select','sweetalert'];
        $data['active_menu']    = "detail_skp";

        $param['where']["md5(CONCAT('SKP',skp.id_skp))"] = $token;

        $detail = $this->Skp_model->get($param)->row();

        if(!$detail || !$token)
        {
            show_404();
        }

        //echo "<pre>";print_r($detail);die;

        $this->role_pimpinan  = ($detail->id_unit_kerja == 0 && $detail->jenis_pegawai == "kepala");
        
        $content = $this->getContent($detail);

        if($this->input->get("preview")==1)
        {
            
        }
        else{
            $filename = "SKP_" . $detail->nama_lengkap . "_tahun_".$detail->tahun_desc.".xls";
            $filename = str_replace(" ","_",$filename);
            $filename = str_replace(",","",$filename);
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
        }
        echo $content;
        
    }

    private function getContent($detail)
    {
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

        $content = '
            <html>
                <head>
                    <title>Download SKP</title>
                </head>
                <body>
                    <table width="1300px">
                        <tr>
                            <td align="center" colspan="8">SASARAN KINERJA PEGAWAI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="8">PENDEKATAN HASIL KERJA KUANTITATIF</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="8">BAGI PEJABAT PIMPINAN TINGGI DAN PIMPINAN UNIT KERJA MANDIRI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="8">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">'.$detail->nama_skpd.'</td>
                            <td colspan="5">PERIODE PENILAIAN: TAHUN '.$detail->tahun_desc.'</td>
                        </tr>
                    </table>
                    <table width="" style="border-collapse:collapse;" border="1" cellpandding="5" cellspacing="5">
                        <tr align="center">
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="2">PEGAWAI YANG DINILAI</td>
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="4">PEJABAT PENILAI KINERJA</td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>NAMA</td>
                            <td width="300px">'.$detail->nama_lengkap.'</td>
                            <td align="center" width="50px">1</td>
                            <td colspan="2">NAMA</td>
                            <td colspan="2">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center" width="50px">2</td>
                            <td width="300px">NIP</td>
                            <td>\''.$detail->nip.' </td>
                            <td align="center">2</td>
                            <td colspan="2">NIP</td>
                            <td colspan="2">\''.$detail->nip_atasan.' </td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td>'.$detail->pangkat.'</td>
                            <td align="center">3</td>
                            <td colspan="2">PANGKAT/GOL. RUANG</td>
                            <td colspan="2">'.$detail->pangkat_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>JABATAN</td>
                            <td>'.$detail->jabatan.'</td>
                            <td align="center">4</td>
                            <td colspan="2">JABATAN</td>
                            <td colspan="2">'.$detail->jabatan_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td>'.$detail->nama_unit_kerja.'</td>
                            <td align="center">5</td>
                            <td colspan="2">INSTANSI</td>
                            <td colspan="2">'.$detail->nama_skpd_atasan.'</td>
                        </tr>
                        <tr>
                            <td colspan="8">HASIL KERJA</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td>No</td>
                            <td>Rencana Hasil Kerja / Sasaran</td>
                            <td colspan="3">Indikator Kinerja Individu</td>
                            <td>Target</td>
                            <td>Satuan</td>
                            <td>Perspektif</td>
                        </tr>
                        <tr align="center" style="background-color:#e4eef2">
                            <td width="50px">1</td>
                            <td width="300px">2</td>
                            <td width="400px" colspan="3">3</td>
                            <td width="150px">4</td>
                            <td width="200px">5</td>
                            <td width="200px">6</td>
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="8">A. UTAMA</td>
                        </tr>
                        '.$this->_kinerjaUtama($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="8">B. INSTRUKSI KHUSUS PIMPINAN</td>
                        </tr>
                        '.$this->_instruksi($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="8">C. TAMBAHAN</td>
                        </tr>
                        '.$this->_kinerjaTambahan($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="8">PERILAKU KERJA</td>
                        </tr>
                        '.$this->_perilaku($detail->id_skp).'
                    </table>

                    <table width="1300px">
                        <tr align="center">
                            <td colspan="3">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="3"></td>
                            <td colspan="5">(tempat), (tanggal, bulan, tahun)</td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">Pegawai Yang Dinilai</td>
                            <td colspan="5">Pejabat Penilai Kinerja</td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">&nbsp;</td>
                            <td colspan="5"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">'.$detail->nama_lengkap.'</td>
                            <td colspan="5">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">'.$detail->nip.'</td>
                            <td colspan="5">'.$detail->nip_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="3">&nbsp;</td>
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

        $content = '
            <html>
                <head>
                    <title>Download SKP</title>
                </head>
                <body>
                    <table width="1700px">
                        <tr>
                            <td align="center" colspan="9">SASARAN KINERJA PEGAWAI</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="9">PENDEKATAN HASIL KERJA KUANTITATIF</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="9">BAGI PEJABAT ADMINISTRASI DAN PEJABAT FUNGSIONAL</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="9">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">'.$detail->nama_skpd.'</td>
                            <td colspan="5">PERIODE PENILAIAN: TAHUN '.$detail->tahun_desc.'</td>
                        </tr>
                    </table>
                    <table width="" style="border-collapse:collapse;" border="1" cellpandding="5" cellspacing="5">
                        <tr align="center">
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="3">PEGAWAI YANG DINILAI</td>
                            <td style="border:1px solid #000">NO</td>
                            <td style="border:1px solid #000" colspan="4">PEJABAT PENILAI KINERJA</td>
                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td>NAMA</td>
                            <td width="300px" colspan="2">'.$detail->nama_lengkap.'</td>
                            <td align="center" width="50px">1</td>
                            <td>NAMA</td>
                            <td colspan="3">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center" width="50px">2</td>
                            <td width="300px">NIP</td>
                            <td colspan="2">\''.$detail->nip.' </td>
                            <td align="center">2</td>
                            <td>NIP</td>
                            <td colspan="3">\''.$detail->nip_atasan.' </td>
                        </tr>
                        <tr>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td colspan="2">'.$detail->pangkat.'</td>
                            <td align="center">3</td>
                            <td>PANGKAT/GOL. RUANG</td>
                            <td colspan="3">'.$detail->pangkat_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">4</td>
                            <td>JABATAN</td>
                            <td colspan="2">'.$detail->jabatan.'</td>
                            <td align="center">4</td>
                            <td>JABATAN</td>
                            <td colspan="3">'.$detail->jabatan_atasan.'</td>
                        </tr>
                        <tr>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td colspan="2">'.$detail->nama_unit_kerja.'</td>
                            <td align="center">5</td>
                            <td>UNIT KERJA</td>
                            <td colspan="2">'.$detail->nama_unit_kerja_atasan.'</td>
                        </tr>
                        <tr>
                            <td colspan="9">HASIL KERJA</td>
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
                        </tr>
                        <tr style="background-color:#e4eef2">
                            <td colspan="9">A. UTAMA</td>
                        </tr>
                        '.$this->_kinerjaUtama($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="9">B. INSTRUKSI KHUSUS PIMPINAN</td>
                        </tr>
                        '.$this->_instruksi($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="9">C. TAMBAHAN</td>
                        </tr>
                        '.$this->_kinerjaTambahan($detail).'
                        <tr style="background-color:#e4eef2">
                            <td colspan="9">PERILAKU KERJA</td>
                        </tr>
                        '.$this->_perilaku($detail->id_skp).'
                    </table>

                    <table width="1700px">
                        <tr align="center">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="4"></td>
                            <td colspan="4">(tempat), (tanggal, bulan, tahun)</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">Pegawai Yang Dinilai</td>
                            <td colspan="4">Pejabat Penilai Kinerja</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="4"></td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">'.$detail->nama_lengkap.'</td>
                            <td colspan="4">'.$detail->nama_lengkap_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">'.$detail->nip.'</td>
                            <td colspan="4">'.$detail->nip_atasan.'</td>
                        </tr>
                        <tr align="center">
                            <td colspan="4">&nbsp;</td>
                            <td colspan="4"></td>
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

        foreach($result as $key=>$row)
        {
            
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
                </tr>';

            }

            //$offset++;
        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="9" align="center">-Belum ada data-</td></tr>';
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

        foreach($result as $key=>$row)
        {
            
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
                </tr>';

            }

            //$offset++;
        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="9" align="center">-Belum ada data-</td></tr>';
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
                        <td>'.($offset+1).'</td>
                        <td colspan="3">'.$nama_perilaku.'</td>
                        <td colspan="6">Ekspektasi Khusus Pimpinan: <br>'.$row->ekspektasi.'</td>
                    </tr>
                ';
            }
            else{
                $content .= '
                    <tr valign="top">
                        <td>'.($offset+1).'</td>
                        <td colspan="5">'.$nama_perilaku.'</td>
                        <td colspan="5">Ekspektasi Khusus Pimpinan: <br>'.$row->ekspektasi.'</td>
                    </tr>
                ';
            }

            $offset++;
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

       
        foreach($result as $key=>$row)
        {
            
            
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
                </tr>';

                
            }

            //$offset++;
        }

        if(!$result)
        {
            if($this->role_pimpinan)
            {
                $content = '<tr><td colspan="8" align="center">-Belum ada data-</td></tr>';
            }
            else{
                $content = '<tr><td colspan="9" align="center">-Belum ada data-</td></tr>';
            }
        }

        return $content;
    }
}