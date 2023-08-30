<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Globalvar extends CI_Model
{
    private $tahun = array(2021,2022,2023);

    public function get_tahun()
    {
       return $this->tahun;
    }
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

    public function get_sumber_anggaran()
    {
        return $this->db->get("sigesit_sumber_anggaran")->result();
    }

    public function get_kecamatan($id_kabupaten="3211")
    {
        $this->db->where("id_kabupaten",$id_kabupaten);
        return $this->db->get("kecamatan")->result();
    }
    public function get_desa($id_kecamatan)
    {
        $this->db->where("id_kecamatan",$id_kecamatan);
        return $this->db->get("desa")->result();
    }

    public function get_rts()
    {
        return array(
            'Pendidikan',
            'Kesehatan',
            'Perumahan dan Pemukiman',
            'Sosial',
            'Tenaga Kerja',
            'UMKM',
            'Pertanian', 
            'Peternakan dan Perikanan', 
            'Lainnya'
        );
    }

    public function get_sasaran()
    {
        return array(
            'KKS', 'PBI', 'KIP','PKH','BPNT'
        );
    }
    public function _status_penerima()
    {
        return array(
            'Selesai','Ditunda','Dibatalkan'
        );
    }
}