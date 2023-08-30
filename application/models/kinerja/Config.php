<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Model
{
    
    public $app_name = "MAK SITI";

    public $perspektif = array('Penerima Layanan','Proses Bisnis','Pengutan Internal','Anggaran');
    
    public $aspek = array('Kuantitas','Kualitas','Waktu','Biaya');

    public $status_skp = array('Belum Diverifikasi','Sudah Diverifikasi','Ditolak');

    public $jenis_lampiran = array('Dukungan Sumber Daya','Skema Pertanggungjawaban','Konsekuensi');

    public $bulan = array(
        1   => 'Januari',
        2   => 'Februari',
        3   => 'Maret',
        4   => 'April',
        5   => 'Mei',
        6   => 'Juni',
        7   => 'Juli',
        8   => 'Agustus',
        9   => 'September',
        10  => 'Oktober',
        11  => 'Nopember',
        12  => 'Desember'
    );

    public function pagination_config()
    {
        $config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
        $config['first_tag_open'] = '';
        $config['first_tag_close'] = '';
        $config['last_tag_open'] = '';
        $config['last_tag_close'] = '';
        $config['next_tag_open'] = '';
        $config['next_tag_close'] = '';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<strong>';
        $config['cur_tag_close'] = '</strong>';
        $config['num_tag_open'] = '';
        $config['num_tag_close'] = '';
        $config['first_link'] = '&lsaquo; First';
        $config['last_link'] = 'Last &rsaquo;';
        $config['prev_link'] = '<';
        $config['next_link'] = '>';
        $config['page_query_string'] = false;
        $config['display_pages'] = true;
        $config['data_page_attr'] = 'data-ci-pagination-page';
        $config['use_global_url_suffix'] = false;
        $config['reuse_query_string'] = false;
        return $config;
    }

}