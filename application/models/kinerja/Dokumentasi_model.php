<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumentasi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("kinerja/Lkh_model");
    }

    function getContent($tahun, $bulan, $id_pegawai,$download=false)
    {
        $content = '';

        $this->load->model("kinerja/Skp_model");
        $param_skp['where']['skp.tahun'] = $tahun;
        $param_skp['where']['skp.id_pegawai'] = $id_pegawai;

        $dt_skp = $this->Skp_model->get($param_skp)->row();

        if($dt_skp)
        {

            //$param['where']['renaksi.tahun'] = $tahun;
            //$param['where']['skp.id_pegawai'] = $id_pegawai;
            $param['where']['skp.id_skp'] = $dt_skp->id_skp;
            $param['where']['renaksi_detail.bulan'] = $bulan;
            $param['where']['renaksi_detail.status_jadwal'] = "Y";
    
            $data['param'] = $param;
            
            $result = $this->Renaksi_model->get_detail($param)->result();  
            
            $ids_renaksi_detail = array();
            foreach($result as $row)
            {
                $ids_renaksi_detail[] = $row->id_renaksi_detail;
            }
    
            $lkh = array();
    
            if($ids_renaksi_detail)
            {
                $param_lkh['str_where'] = "(lkh.id_renaksi_detail in (".implode(",",$ids_renaksi_detail).") )";
                $dt_lkh = $this->Lkh_model->get($param_lkh)->result();
                foreach($dt_lkh as $row)
                {
                    if($row->lampiran)
                    {
                        $lkh[$row->id_renaksi_detail][] = $row->lampiran;
                    }
                }
            }
            
            
    
            $hasil_kerja = "";
    
            foreach($result as $key => $row)
            {
                $lampiran = '';
                $dt_lampiran = array();
                if(!empty($lkh[$row->id_renaksi_detail]))
                {
                    foreach($lkh[$row->id_renaksi_detail] as $key => $val)
                    $dt_lampiran[] = '<a target="_blank" class="btn_ btn-default_" href="'.base_url().'data/kegiatan_personal/'.$id_pegawai.'/'.$val.'">'.$val.'</a>';
                }
    
                if($dt_lampiran)
                {
                    $lampiran = '<ul><li>'.implode("</li><li>",$dt_lampiran).'</li></ul>';
                }
                /* if($row->lampiran)
                {
                    $lampiran = '<a target="_blank" class="btn btn-default" href="'.base_url().'data/kegiatan_personal/'.$row->id_pegawai.'/'.$row->lampiran.'">Lihat</a>';
                } */
    
                $indikator_kinerja_individu = $row->indikator_kinerja_individu;
    
                if($row->id_kinerja_utama)
                {
                    if($row->flag=="kegiatan")
                    {
                        $indikator_kinerja_individu = $row->nama_indikator_kegiatan;
                    }
                    if($row->flag=="sub_kegiatan")
                    {
                        $indikator_kinerja_individu = $row->nama_indikator_sub_kegiatan;
                    }
                }
                else if($row->id_kinerja_tambahan)
                {
                    $indikator_kinerja_individu = $row->indikator_kinerja_individu_tambahan;
                }
    
                if($hasil_kerja != $indikator_kinerja_individu)
                {
                    $hasil_kerja = $indikator_kinerja_individu;
                    $hasil_kerja_view = $hasil_kerja;
                }
                else{
                    $hasil_kerja_view = '';
                }
    
                $col_lampiran = ($download) ? "" : '<td>'.$lampiran.'</td>';
                
    
                $content .= '
                    <tr>
                        <!--<td>'.($key+1).'</td>-->
                        <td><b>'.$hasil_kerja_view.'</b></td>
                        <td>'.$row->renaksi.'</td>
                        <td>'.$row->capaian_lkh.'</td>
                        '.$col_lampiran.'
                    </tr>
                ';
            }
        }


        return $content;
    }
}