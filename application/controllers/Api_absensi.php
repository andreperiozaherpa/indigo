<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Api_absensi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index_get()
    {
        $response['error'] = false;
        $response['message'] = 'Horray';
        $this->response($response);
    }
    public function pegawai_get()
    {
        $api_key = $this->get('api_key');
        if ($api_key != '') {
            $check = $this->check_api_key($api_key);
            if ($check) {
                $tanggal_awal = $this->get('date_start');
                $tanggal_akhir = $this->get('date_end');
                if ($tanggal_awal != '') {
                    $this->db->where('tanggal >=', $tanggal_awal);
                }
                if ($tanggal_akhir != '') {
                    $this->db->where('tanggal <=', $tanggal_akhir);
                }
                $this->db->select('pegawai.nip,absen_log.tanggal,absen_log.jam_masuk,absen_log.jam_pulang,absen_log.masuk_telat,absen_log.pulang_cepat,,absen_log.waktu_kerja');
                $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai', 'left');
                $all = $this->db->get('absen_log')->result();
                $response['error'] = false;
                $response['count'] = count($all);
                $response['data'] = $all;
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key';
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key not provided';
        }
        $this->response($response);
    }

    private function check_api_key($api_key)
    {

        $api_q = $this->db->get_where('keys', array('api_key' => $api_key));
        $check = $api_q->num_rows();
        if ($check > 0) {
            $this->db->where('api_key',$api_key)->set('hit','hit+1',false)->update('keys');
            return true;
        }else{
            return false;
        }
    }
}
