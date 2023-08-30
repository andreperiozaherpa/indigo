<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_riwayat_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("kinerja/Skp_model");
        $this->load->model("kinerja/Kinerja_utama_model");
        $this->load->model("kinerja/Kinerja_tambahan_model");
        $this->load->model("kinerja/Instruksi_model");
        $this->load->model("kinerja/Perilaku_model");
        $this->load->model("kinerja/Lampiran_model");
        $this->load->model("kinerja/Config");
    }

    public function get($param=null)
    {

        if(!empty($param['search']))
        {
            $this->db->where("(pegawai.nama_lengkap like '%".$param['search']."%' OR pegawai.nip like '%".$param['search']."%' )");
        }

        if(!empty($param['where']))
        {
            foreach ($param['where'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        if(!empty($param['str_where']))
        {
            $this->db->where($param['str_where']);
        }
        
        if(isset($param['limit']) && isset($param['offset']))
        {
            $this->db->limit($param['limit'],$param['offset']);
        }

        $this->db->join("pegawai","pegawai.id_pegawai = skp_riwayat.id_pegawai","left");

        $query = $this->db->get("ekinerja_skp_riwayat skp_riwayat");    
        
        
        return $query;
    }

    public function insert($id_skp)
    {

        $param['where']["skp.id_skp"] = $id_skp;
        $detail = $this->Skp_model->get($param)->row();

        $dt = array(
            'id_pegawai'    => $detail->id_pegawai,
            'tahun'         => $detail->tahun,
            'tahun_desc'    => $detail->tahun_desc,
            'content'       => $this->generate($detail),
            'verified_at'   => $detail->verified_at
        );

        $this->db->insert("ekinerja_skp_riwayat",$dt);
    }

    public function generate($detail,$judul=null)
    {
        $role_pimpinan = ($detail->kepala_skpd == "Y" && in_array($detail->jenis_skpd,['skpd','kecamatan']));

        $kinerja_utama = $this->get_kinerja_utama($detail,$role_pimpinan);
        $instruksi_khusus = $this->get_instruksi_khusus($detail,$role_pimpinan);
        $kinerja_tambahan = $this->get_kinerja_tambahan($detail,$role_pimpinan);
        $perilaku = $this->get_perilaku($detail);
        $lampiran = $this->get_lampiran($detail);

        if(!$judul)
        {
            $judul = 'Riwayat SKP Tahun '.$detail->tahun_desc;
        }
        $content = '
        
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">'.$judul.'</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li>'.$this->Config->app_name.'</li>
                        <li>SKP</li>
                        <li class="active">Detail</li>
                    </ol>
                </div>
            </div>
        
        
            <div class="row">
                <form id="form-verifikasi">
        
                <div class="col-md-6">
                    <div class="white-box" style="min-height:380px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title m-t-5">Pegawai yang dinilai</h3>
                                <table width="100%" class="table">
                                    <thead>
                                        <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td>'.$detail->nama_lengkap.'</td></tr>
                                        <tr valign="top"><td>NIP</td><td>:</td><td>'.$detail->nip.'</td></tr>
                                        <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td>'.$detail->pangkat.'</td></tr>
                                        <tr valign="top"><td>Jabatan</td><td>:</td><td>'.$detail->jabatan.'</td></tr>
                                        <tr valign="top"><td>Unit Kerja</td><td>:</td><td>'.$detail->nama_unit_kerja.'</td></tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
        
                    </div>
                </div>
        
                <div class="col-md-6">
                    <div class="white-box" style="min-height:380px">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <h3 class="box-title m-t-5">Pejabat penilai kerja</h3>
                                <table width="100%" class="table">
                                    <thead>
                                        <tr valign="top"><td width="30%">Nama</td><td width="5%">:</td><td>'.$detail->nama_lengkap_atasan.'</td></tr>
                                        <tr valign="top"><td>NIP</td><td>:</td><td>'.$detail->nip_atasan.'</td></tr>
                                        <tr valign="top"><td>Pangkat/Gol</td><td>:</td><td>'.$detail->pangkat_atasan.'</td></tr>
                                        <tr valign="top"><td>Jabatan</td><td>:</td><td>'.$detail->jabatan_atasan.'</td></tr>
                                        <tr valign="top"><td>Unit Kerja</td><td>:</td><td>'.$detail->nama_unit_kerja_atasan.'</td></tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                '
                .$kinerja_utama
                .$instruksi_khusus 
                .$kinerja_tambahan
                .$perilaku
                .$lampiran
                .'
            </div>
        </div>';

        

        return $content;

        //echo "<pre>";print_r($detail);die;
    }

    private function get_kinerja_utama($detail,$role_pimpinan)
    {
        $content = '';

        $row_data = $this->Kinerja_utama_model->getContent($detail);

        $content .= '
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">KINERJA UTAMA</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark">'.$detail->nama_skpd.'</p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>';

                                    if($role_pimpinan){
                                        $content .= '
                                            <tr>
                                                <th width="5px">No</th>
                                                <th>Rencana Hasil Kerja / Sasaran</th>
                                                <th>Indikator Kinerja Individu</th>
                                                <th>Target</th>
                                                <th>Satuan</th>
                                                <th>Perspektif</th>
                                            </tr>';
                                    }
                                    else{
                                        $content .= '
                                        <tr>
                                            <th width="5px">No</th>
                                            <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                            <th>Rencana Hasil Kerja</th>
                                            <th>Aspek</th>
                                            <th>Kegiatan / Sub Kegiatan</th>
                                            <th>Indikator Kinerja Individu</th>
                                            <th>Target</th>
                                            <th>Satuan</th>
                                        </tr>';
                                    }

                                $content .='    
                                </thead>
                                <tbody>
                                    '.$row_data.'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $content;

    }

    private function get_instruksi_khusus($detail,$role_pimpinan)
    {
        $content = '';

        $row_data = $this->Instruksi_model->getContent($detail);

        $content .= '
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">INSTRUKSI KHUSUS PIMPINAN</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark">'.$detail->nama_skpd.'</p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>';

                                    if($role_pimpinan){
                                        $content .= '
                                        <tr>
                                            <th width="5px">No</th>
                                            <th>Rencana Hasil Kerja</th>
                                            <th>Indikator Kinerja Individu</th>
                                            <th>Target</th>
                                            <th>Satuan</th>
                                            <th>Perspektif</th>
                                        </tr>';
                                    }
                                    else{
                                        $content .= '
                                        <tr>
                                            <th width="5px">No</th>
                                            <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                            <th>Rencana Hasil Kerja</th>
                                            <th>Aspek</th>
                                            <th>Indikator Kinerja Individu</th>
                                            <th>Target</th>
                                            <th>Satuan</th>
                                        </tr>';
                                    }

                                $content .='    
                                </thead>
                                <tbody>
                                    '.$row_data.'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $content;

    }

    private function get_kinerja_tambahan($detail,$role_pimpinan)
    {
        $content = '';

        $row_data = $this->Kinerja_tambahan_model->getContent($detail);

        $content .= '
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">KINERJA TAMBAHAN</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark">'.$detail->nama_skpd.'</p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>';

                                    if($role_pimpinan){
                                        $content .= '
                                        <tr>
                                            <th width="5px">No</th>
                                            <th>Rencana Hasil Kerja</th>
                                            <th>Indikator Kinerja Individu</th>
                                            <th>Target</th>
                                            <th>Satuan</th>
                                            <th>Perspektif</th>
                                        </tr>';
                                    }
                                    else{
                                        $content .= '
                                        <tr>
                                            <th width="5px">No</th>
                                            <th>Rencana Hasil Kinerja Pimpinan Yang Di Intervensi</th>
                                            <th>Rencana Hasil Kerja</th>
                                            <th>Aspek</th>
                                            <th>Indikator Kinerja Individu</th>
                                            <th>Target</th>
                                            <th>Satuan</th>
                                        </tr>';
                                    }

                                $content .='    
                                </thead>
                                <tbody>
                                    '.$row_data.'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $content;

    }

    private function get_perilaku($detail)
    {
        $content = '';

        $row_data = $this->Perilaku_model->getContent($detail->id_skp);

        $content .= '
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">Perilaku Kerja/Behavior</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark">'.$detail->nama_skpd.'</p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                
                                    <th width="5px">No</th>
                                    <th>Perilaku</th>
                                    <th>Ekspektasi Khusus Pimpinan / Leader</th>
                                    
                                </thead>
                                <tbody>
                                    '.$row_data.'
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>';

        return $content;

    }

    private function get_lampiran($detail)
    {
        $content = '';

        $row_data = $this->Lampiran_model->getContent($detail->id_skp);

        $content .= '
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center box-title m-b-0">LAMPIRAN SASARAN KINERJA PEGAWAI</h3>
                        <p class="text-center text-dark m-b-0">PEMERINTAH KABUPATEN SUMEDANG</p>
                        <p class="text-center text-dark">'.$detail->nama_skpd.'</p>
                        <div class="table-responsive">
                            '.$row_data.'
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $content;

    }
}