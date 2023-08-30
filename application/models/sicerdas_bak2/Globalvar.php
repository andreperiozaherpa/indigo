<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Globalvar extends CI_Model
{
   private $tahun = array(2019,2020,2021,2022,2023);

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
}