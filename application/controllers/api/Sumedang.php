<?php
defined('BASEPATH') or exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Sumedang extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $headers = $this->input->request_headers();
        $this->api_key = (!empty($headers['SKey'])) ? $headers['SKey'] : null;
        $this->api_key = (!empty($headers['Skey'])) ? $headers['Skey'] : $this->api_key;
    }
    public function skpd_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $jenis_skpd = $this->get('jenis_skpd');
                if ($jenis_skpd != '') {
                    $this->db->where('jenis_skpd', $jenis_skpd);
                }
                $all = $this->db->get('ref_skpd')->result();
                $response['error'] = false;
                $response['count'] = count($all);
                $response['data'] = $all;
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
            $response['data'] = $this->input->request_headers();
        }
        $this->response($response);
    }
    public function skpd_multi_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $jenis_skpd = $this->get('jenis_skpd');
                if ($jenis_skpd != '') {
                    $js = explode(',', $jenis_skpd);
                    foreach ($js as $j) {
                        $this->db->or_where('jenis_skpd', trim($j));
                    }
                }
                $all = $this->db->get('ref_skpd')->result();
                $response['error'] = false;
                $response['count'] = count($all);
                $response['data'] = $all;
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }
    public function skpd_jumlah_pegawai_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $id_skpd = $this->get('id_skpd');
                if ($id_skpd != '') {
                    $this->db->where('id_skpd', $id_skpd);
                    $all = $this->db->get_where('pegawai')->num_rows();
                    $response['error'] = false;
                    $response['data'] = $all;
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Invalid parameter';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }
    public function skpd_detail_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $id_skpd = $this->get('id_skpd');
                if ($id_skpd != '') {
                    $this->db->where('id_skpd', $id_skpd);
                    $all = $this->db->get_where('ref_skpd')->row();
                    $response['error'] = false;
                    $response['data'] = $all;
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Invalid parameter';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }
    public function skpd_struktur_get()
    {
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $id_skpd = $this->get('id_skpd');
                if ($id_skpd != '') {
                    $this->db->where('pegawai.id_skpd', $id_skpd);
                    $this->db->where('jenis_pegawai', 'kepala');
                    $this->db->where('pensiun !=', '1');
                    $this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan');
                    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
                    $this->db->order_by('ref_unit_kerja.level_unit_kerja');
                    $this->db->select('pegawai.nama_lengkap as nama_pejabat,pegawai.foto_pegawai,ref_jabatan_baru.nama_jabatan,ref_unit_kerja.nama_unit_kerja');
                    $all = $this->db->get_where('pegawai')->result();
                    $response['error'] = false;
                    $response['count'] = count($all);
                    $response['data'] = $all;
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Invalid parameter';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }

    public function skpd_sakip_get()
    {
        $this->load->model('evaluasi_model');
        $this->load->model('renja_perencanaan_model');
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $id_skpd = $this->get('id_skpd');
                $tahun = $this->get('tahun');
                if ($id_skpd != '') {
                    $all = $this->evaluasi_model->get_by_tahun($id_skpd, $tahun);
                    if ($all) {
                        $response['error'] = false;
                        $nilai = $all->nilai;
                        $abjad = "";
                        if ($nilai > 90) {
                            $abjad = "AA";
                        } elseif ($nilai > 80) {
                            $abjad = "A";
                        } elseif ($nilai > 70) {
                            $abjad = "BB";
                        } elseif ($nilai > 60) {
                            $abjad = "B";
                        } elseif ($nilai > 50) {
                            $abjad = "CC";
                        } elseif ($nilai > 30) {
                            $abjad = "C";
                        } else {
                            $abjad = "D";
                        }
                        $all->nilai_abjad = $abjad;
                        $list_sasaran = array();

                        $tahun = $tahun - 1;
                        $jenis = array('ss' => 'Sasaran Strategis', 'sp' => 'Sasaran Program', 'sk' => 'Sasaran Kegiatan');
                        $empty = true;
                        foreach ($jenis as $j => $v) {
                            $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);

                            if (!empty($sasaran)) {
                                $empty = false;
                            }
                        }
                        $total_indeks = 0;
                        $jumlah_jenis = 0;
                        if (!$empty) {
                            foreach ($jenis as $j => $v) {
                                $name = $this->renja_perencanaan_model->name($j);

                                $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
                                if (!empty($sasaran)) {
                                    $no = 1;

                                    foreach ($sasaran as $s) {
                                        $tSasaran = $name['tSasaran'];
                                        $cSasaran = $name['cSasaran'];
                                        $iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);


                                        $capaian = array();
                                        foreach ($iku as $i) {
                                            $tIku = $name['tIku'];
                                            $cIku = $name['cIku'];
                                            $cIkuRenja = $name['cIkuRenja'];
                                            $taIkuRenja = $name['taIkuRenja'];
                                            $aIkuRenja = $name['aIkuRenja'];
                                            $rIkuRenja = $name['rIkuRenja'];
                                            $target = $i->$taIkuRenja;
                                            $realisasi = $i->$rIkuRenja;
                                            $pola = $i->polorarisasi;
                                            $capaian[] = $i->capaian; //get_capaian($target,$realisasi,$pola);
                                        }
                                        $t_iku = count($iku) * 100;
                                        if ($t_iku == 0) $t_iku = 1;
                                        $t_hasil = array_sum($capaian);
                                        $t_indeks = ($t_hasil / $t_iku) * 100;
                                        $t_indeks_ =  number_format($t_indeks, 1);
                                        $t_sasaran = count($s) * 100;
                                        $tt_indeks_ = ($t_indeks_ / $t_sasaran) * 100;
                                        $ts_indeks_[$tSasaran] = $tt_indeks_;
                                        $total_indeks += $tt_indeks_;
                                        $jumlah_jenis++;

                                        $list_sasaran[] = array('sasaran' => $s->$tSasaran, 'persentase' => $ts_indeks_[$tSasaran] . "%");
                                    }
                                }
                            }
                        }
                        $response['data'] = array('nilai_sakip' => $all, 'sasaran' => $list_sasaran);
                    } else {

                        $response['error'] = true;
                        $response['message'] = 'Record not found';
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Invalid parameter';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }

    public function skpd_lakip_get()
    {
        $this->load->model('berkas_lakip_model');
        if ($this->api_key != '') {
            $check = $this->check_api_key($this->api_key);
            if ($check) {
                $id_skpd = $this->get('id_skpd');
                // $tahun = $this->get('tahun');
                if ($id_skpd != '') {
                    $get_data = $this->berkas_lakip_model->select_by_id_skpd($id_skpd);
                    if ($get_data) {
                        $response['data'] = array('item' => $get_data);
                    } else {

                        $response['error'] = true;
                        $response['message'] = 'Record not found';
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = 'Invalid parameter';
                }
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid API key' . $this->api_key;
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'No API key provided';
        }
        $this->response($response);
    }

    private function check_api_key($api_key)
    {

        $api_q = $this->db->get_where('keys', array('api_key' => $api_key));
        $check = $api_q->num_rows();
        if ($check > 0) {
            $this->db->where('api_key', $api_key)->set('hit', 'hit+1', false)->update('keys');
            return true;
        } else {
            return false;
        }
    }
}
