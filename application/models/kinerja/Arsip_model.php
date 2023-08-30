<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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

        $this->db->join("pegawai","pegawai.id_pegawai = arsip.id_pegawai","left");

        $query = $this->db->get("ekinerja_arsip arsip");    
        
        
        return $query;
    }

    public function create($id_skp)
    {

        

        $this->load->model("kinerja/Skp_riwayat_model");
        $this->load->model("kinerja/Skp_model");

        $param['where']["skp.id_skp"] = $id_skp;
        $detail = $this->Skp_model->get($param)->row();

        $judul = 'Arsip SKP Tahun '.$detail->tahun_desc;

        $skp = $this->Skp_riwayat_model->generate($detail,$judul);

        $dokumentasi = $this->generate_dokumentasi($detail);
        $lkh = $this->generate_lkh($detail);
 
        $dt = array(
            'id_pegawai'    => $detail->id_pegawai,
            'tahun'    => $detail->tahun_desc,
            'skp'   => $skp,
            'dokumentasi' => $dokumentasi,
            'lkh'       => $lkh
        );


        $this->db
        ->where("id_pegawai",$detail->id_pegawai)
        ->where("tahun",$detail->tahun_desc)
        ->delete("ekinerja_arsip");

        $this->db->insert("ekinerja_arsip",$dt);

        return true;
    }

    private function generate_dokumentasi($detail)
    {
        $this->load->model("kinerja/Dokumentasi_model");
        $judul = 'Arsip Pendokumentasian Kinerja';

        
        $rows = '';
        $bulanArr = array();
        for($i=1; $i <= 12 ; $i++)
        {
            $nama_bulan = strtoupper(date("F",strtotime($detail->tahun."-".$i."-01"))) . ' ' .$detail->tahun_desc;
            $rowData = $this->Dokumentasi_model->getContent($detail->tahun, $i, $detail->id_pegawai,true);

            $rows .= '
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center box-title m-b-0" id="title">PENDOKUMENTASIAN KINERJA</h3>
                                <p class="text-center text-dark m-b-0">'.$detail->nama_lengkap.' / '.$detail->nip.'</p>
                                <p class="text-center text-dark m-b-0">BULAN '.$nama_bulan.'</p>
                                    <table style="margin-top:50px" class="table table-striped_">
                                        <thead>
                                            <tr>
                                                <th>Hasil Kerja</th>
                                                <th>Rencana Aksi</th>
                                                <th>Capaian (%)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row-data">
                                            '.$rowData.'
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }

        
        

        $content = '
        
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h4 class="page-title">'.$judul.'</h4>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <ol class="breadcrumb">
                        <li>'.$this->Config->app_name.'</li>
                        <li>Pendokumentasian Kinerja</li>
                        <li class="active">Detail</li>
                    </ol>
                </div>
            </div>

            '.$rows.'

        </div>';

        

        return $content;
    }

    private function generate_lkh($detail)
    {
        $this->load->model("kinerja/Lkh_model");
        $judul = 'Arsip LKH';
        

        $rowData = '';

        $param['where']['renaksi.id_skp'] = $detail->id_skp;
        
        $result = $this->Lkh_model->get($param)->result();
        foreach($result as $key=>$row)
        {
            
            $offset = $key + 1;

            $hasil_kegiatan = '';
            if($row->hasil_kegiatan)
            {
                $hasil_kegiatan = number_format($row->hasil_kegiatan);
            }

            $status_desc = ($row->status_verifikasi == "sudah_diverifikasi") ? 'Sudah Diverifikasi' : 'Belum Diverifikasi';
            
            $rowData .= '
            <tr>
                <td>'.$offset.'</td>
                <td>'.tanggal_hari($row->tanggal).'</td>
                <td>'.$row->rencana_hasil_kerja.'</td>
                <td>'.$row->renaksi.'</td>
                <td>'.$row->rincian_kegiatan.'</td>
                <td>'.$hasil_kegiatan.'</td>
                <td>'.$status_desc.'</td>
            </tr>
            ';
        }

        $content = '
        
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h4 class="page-title">'.$judul.'</h4>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <ol class="breadcrumb">
                        <li>'.$this->Config->app_name.'</li>
                        <li>LKH</li>
                        <li class="active">Pegawai</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center box-title m-b-0" id="title">LAPORAN KINERJA HARIAN PEGAWAI</h3>
                                <p class="text-center text-dark m-b-0">'.$detail->nama_lengkap.' / '.$detail->nip.'</p>
                                    <table style="margin-top:50px" class="table table-striped_">
                                        <thead>
                                            <tr>
                                                <th width="30px">No</th>
                                                <th width="150px">Hari / Tanggal</th>
                                                <th>Rencana Hasil</th>
                                                <th>Renaksi</th>
                                                <th>Laporan Hasil Kegiatan</th>
                                                <th>Realisasi (%)</th>
                                                <th width="150px">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="row-data">
                                            '.$rowData.'
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>';

        

        return $content;
    }
}