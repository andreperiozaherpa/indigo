<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Api_dprd extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->model('surat_masuk_model');
        $this->load->model('surat_keluar_model');
        $this->load->model('notification_model');
        $this->load->model('ref_skpd_model');
        $this->load->model('logs_model');
    }

    function emit($name, $notif_data)
    {

        $client = new Client(new Version2X('https://localhost:3000', ['context' => ['ssl' => ['verify_peer_name' => false, 'verify_peer' => false]]]));
        $client->initialize();
        $client->emit($name, $notif_data);
        $client->close();
    }

    function list_skpd_get($dev = "")
    {
        $list = array('kecamatan', 'skpd');
        if ($dev) {
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

    function tanda_tangan_surat_post()
    {
        $data['status'] = false;
        if (isset($_POST['hash_id']) && isset($_POST['status'])) {
            $hash_id = $_POST['hash_id'];
            $status = $_POST['status'];
            $berkas      = $this->surat_keluar_model->get_detail_by_hash_id($hash_id);
            $id_surat_keluar = $berkas->id_surat_keluar;
            $testing = '';
            if ($status == 'terima') {
                if (isset($_POST['nik']) && isset($_POST['passpharse'])) {
                    $nik = $_POST['nik'];
                    $cur_date      = date("Ymdhis");
                    $src          = "./data/surat_eksternal/draf_pdf/{$berkas->file_verifikasi}";
                    $output_name = "surat{$cur_date}{$berkas->hash_id}_(signed).pdf";
                    $dest          = "./data/surat_eksternal/ttd";
                    $passpharse       = $_POST['passpharse'];
                    $ttd = tanda_tangan_cloud($src, $dest, $nik, $passpharse, $output_name, 264358);
                    if (!$ttd['error']) {
                        $file_ttd = $ttd['file_ttd'];
                        $source = "./data/surat_eksternal/ttd/{$file_ttd}";
                        $dest = "./data/surat_eksternal/surat_masuk/{$file_ttd}";
                        copy($source, $dest);
                        //baca notifikasi
                        $read = $this->notification_model->read('surat_eksternal/tanda_tangan_detail', $id_surat_keluar);

                        $this->surat_keluar_model->update_surat_keluar(array('status_ttd' => 'sudah_ditandatangani', 'tgl_ttd' => date('Y-m-d'), 'file_ttd' => $file_ttd), $id_surat_keluar);
                        $data['message'] = $ttd['message'];
                        $data['type'] = "success";
                        $data['status'] = true;
                        $data['file_ttd'] = $file_ttd;


                        //kirim notif ke pembuat surat
                        $notif_data = array();
                        $notif_data['title'] = 'Tandatangan Surat';
                        $notif_data['message'] = 'Surat dengan nomor registrasi ' . $berkas->hash_id . ' telah selesai ditandatangani dan di teruskan ke penerima';
                        $notif_data['data'] = 'surat_eksternal/detail_surat_keluar';
                        $notif_data['data_id'] = $id_surat_keluar;
                        $notif_data['ntime'] = date('H:i:s');
                        $notif_data['ndate'] = date('Y-m-d');
                        $notif_data['user_id'] = $berkas->id_user_input;
                        $notif_data['category'] = 'surat_eksternal/surat_keluar';
                        $this->notification_model->insert($notif_data);
                        $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
                        $this->emit('new_notification', $notif_data);
                        $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));

                        $send_surat = $this->surat_masuk_model->add_by_surat_keluar($id_surat_keluar);
                        foreach ($send_surat as $s) {
                            if (isset($s['id_surat_masuk_verifikasi'])) {
                                //kirim notif ke verifikator
                                $detail_surat_masuk = $this->surat_masuk_model->get_detail_verifikasi($s['id_surat_masuk_verifikasi']);
                                $detail_pegawai_penerima = $this->master_pegawai_model->get_by_id($detail_surat_masuk->id_pegawai_penerima);
                                $notif_data = array();
                                $notif_data['title'] = 'Verifikasi Surat Masuk';
                                $notif_data['message'] = 'Ada surat masuk untuk ' . $detail_pegawai_penerima->nama_lengkap . ' menunggu diverifikasi oleh Anda dengan perihal ' . $detail_surat_masuk->perihal;
                                $notif_data['data'] = 'surat_eksternal/detail_surat_masuk_verifikasi';
                                $notif_data['data_id'] = $s['id_surat_masuk_verifikasi'];
                                $notif_data['ntime'] = date('H:i:s');
                                $notif_data['ndate'] = date('Y-m-d');
                                $notif_data['user_id'] = $s['id_user'];
                                $notif_data['category'] = 'surat_eksternal/surat_masuk_verifikasi';
                                $this->notification_model->insert($notif_data);
                                $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
                                $this->emit('new_notification', $notif_data);
                                $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
                            } else {

                                //kirim notif ke penerima
                                $detail_surat_masuk = $this->surat_masuk_model->get_detail_by_id($s['id_surat_masuk']);
                                $notif_data = array();
                                $notif_data['title'] = 'Surat Masuk';
                                $notif_data['message'] = 'Ada surat masuk baru dengan perihal ' . $detail_surat_masuk->perihal;
                                $notif_data['data'] = 'surat_eksternal/detail_surat_masuk';
                                $notif_data['data_id'] = $s['id_surat_masuk'];
                                $notif_data['ntime'] = date('H:i:s');
                                $notif_data['ndate'] = date('Y-m-d');
                                $notif_data['user_id'] = $s['id_user'];
                                $notif_data['category'] = 'surat_eksternal/surat_masuk';
                                $this->notification_model->insert($notif_data);
                                $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
                                $this->emit('new_notification', $notif_data);
                                $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
                            }
                        }
                        $tembusan_s = $this->surat_keluar_model->get_tembusan_by_surat_keluar($id_surat_keluar);

                        foreach ($tembusan_s as $t) {
                            //kirim notif ke penerima
                            $notif_data = array();
                            $notif_data['title'] = 'Surat Tembusan';
                            $notif_data['message'] = 'Ada surat tembusan baru dengan perihal ' . $t->perihal;
                            $notif_data['data'] = 'surat_tembusan/detail';
                            $notif_data['data_id'] = $t->id_surat_keluar_tembusan;
                            $notif_data['ntime'] = date('H:i:s');
                            $notif_data['ndate'] = date('Y-m-d');
                            $notif_data['user_id'] = $t->id_user;
                            $notif_data['category'] = 'surat_tembusan/index/' . $t->jenis_surat;
                            $this->notification_model->insert($notif_data);
                            $notif_data['link'] = base_url($notif_data['data'] . '/' . $notif_data['data_id']);
                            $this->emit('new_notification', $notif_data);
                            $this->emit('refresh_notification', array('user_id' => $notif_data['user_id']));
                        }

                        $detail = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
                        $log_data = array(
                            'action' => 'melakukan',
                            'function' => 'tandatangan surat',
                            'key_name' => 'nomor registrasi sistem',
                            'key_value' => $detail->hash_id,
                            'category' => $this->uri->segment(1),
                        );
                        $this->logs_model->insert_log($log_data);
                    } else {
                        $data['message'] = $ttd['message'];
                        $data['type'] = "info";
                        $log_data = array(
                            'action' => 'gagal melakukan',
                            'function' => 'tandatangan surat dikarenakan ' . $ttd['message'],
                            'key_name' => 'nomor registrasi sistem',
                            'key_value' => $berkas->hash_id,
                            'category' => 'surat_' . $berkas->jenis_surat,
                        );
                        $this->logs_model->insert_log($log_data);
                    }
                } else {
                    $data['message'] = 'Parameter belum lengkap';
                }
            }
        } else {
            $data['message'] = 'Parameter belum lengkap';
        }
        $this->response($data);
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
