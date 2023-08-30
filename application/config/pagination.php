<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['page_query_string'] = TRUE;
$config['reuse_query_string'] = TRUE;

$config['full_tag_open']    = '<nav aria-label="Page navigation example"><ul class="pagination pagination-primary justify-content-center mt-2">';
$config['full_tag_close']   = '</ul></nav>';

$config['data_page_attr']   = ' class="page-link" ';

$config['first_link'] = '';
$config['first_tag_open'] = '<div class="page-item prev-item">';
$config['first_tag_close'] = '</div>';

$config['last_link'] = '';
$config['last_tag_open'] = '<div class="page-item next-item">';
$config['last_tag_close'] = '</div>';

$config['next_link'] = '';
$config['next_tag_open'] = '<div class="page-item next-item">';
$config['next_tag_close'] = '</div>';

$config['prev_link'] = '';
$config['prev_tag_open'] = '<div class="page-item prev-item">';
$config['prev_tag_close'] = '</div>';

$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
$config['cur_tag_close'] = '</span></li>';

$config['num_tag_open'] = '<div class="page-item">';
$config['num_tag_close'] = '</div>';