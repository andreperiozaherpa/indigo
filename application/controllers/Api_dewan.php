<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Api_madasih extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model('surat_masuk_model');
        $this->load->model('ref_skpd_model');
    }

    function emit($name, $notif_data)
    {

        $client = new Client(new Version2X('https://localhost:3000', ['context' => ['ssl' => ['verify_peer_name' => false, 'verify_peer' => false]]]));
        $client->initialize();
        $client->emit($name, $notif_data);
        $client->close();
    }

    function list_skpd_get($dev="")
    {
        $list = array('kecamatan','skpd');
        if($dev){
            $list[] = 'demo';
        }
        $get = $this->ref_skpd_model->get_multiple_jenis($list);
        $this->response($get);
    }
    function detail_skpd_get()
    {
        $id_skpd = $_GET['id_skpd'];
        $get = $this->ref_skpd_model->get_by_id($id_skpd);
        $kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
        $get->kepala = $kepala;
        $this->response($get);
    }
    function detail_kecamatan_get()
    {
        $id_kecamatan = $_GET['id_kecamatan'];
        $kecamatan = $this->db->get_where('ref_skpd', array('id_kecamatan' => $id_kecamatan, 'jenis_skpd' => 'kecamatan'))->row();
        if ($kecamatan) {
            $id_skpd = $kecamatan->id_skpd;
            $get = $this->ref_skpd_model->get_by_id($id_skpd);
            $kepala = $this->ref_skpd_model->get_kepala_skpd($id_skpd);
            $get->kepala = $kepala;
            $get->status = true;
        } else {
            $get = array('status' => false);
        }
        $this->response($get);
    }


    function send_surat_post()
    {
        if (!empty($_POST)) {
            $row = json_decode(json_encode($_POST));
            $id_skpd = $row->id_skpd;
            $kepala = $this->db->get_where('pegawai', array('id_skpd' => $id_skpd, 'kepala_skpd' => 'Y'))->result();
            foreach ($kepala as $k) {
                $data = array(
                    'jenis_surat' => 'eksternal',
                    'perihal' => $row->perihal,
                    'pengirim' => $row->pengirim,
                    'tanggal_surat' => $row->tanggal_surat,
                    'nomer_surat' => $row->nomer_surat,
                    'sifat' => $row->sifat,
                    'file_surat' => $row->file_surat,
                    'lampiran' => $row->file_lampiran,
                    'id_pegawai_input' => 0,
                    'tgl_input' => date('Y-m-d'),
                    'status_surat' => 'Belum Dibaca',
                    'id_skpd_penerima' => $id_skpd,
                    'id_unitkerja_penerima' => 0,
                    'id_pegawai_penerima' => $k->id_pegawai,
                    'hash_id' => $row->hash_id,
                    'surat_dewan' => 1
                );
                $this->db->insert('surat_masuk', $data);
                $id_surat_masuk = $this->db->insert_id();

                $detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($id_surat_masuk);
                $notif_data = array();
                $notif_data['title'] = 'Surat Masuk';
                $notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
                $notif_data['data'] = 'surat_' . $detail_surat_masuk->jenis_surat . '/detail_surat_masuk';
                $notif_data['data_id'] = $id_surat_masuk;
                $notif_data['ntime'] = date('H:i:s');
                $notif_data['ndate'] = date('Y-m-d');
                $notif_data['user_id'] = $k->id_user;
                $notif_data['category'] = 'surat_' . $detail_surat_masuk->jenis_surat . '/surat_masuk';
                $this->notification_model->insert($notif_data);
                $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);

                $this->emit('new_notification', $notif_data);
                $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
            }
            $this->response(array('status' => true, 'send' => count($kepala)));
        }
    }
}
