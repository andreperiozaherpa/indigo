<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once(APPPATH . "third_party/Common/Autoloader.php");
include_once(APPPATH . "third_party/PhpWord/Autoloader.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Parser.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/HTMLCleaner.php");
include_once(APPPATH . "third_party/HTMLtoOpenXML/src/Scripts/ProcessProperties.php");
//include_once(APPPATH."core/Front_end.php");
use Dompdf\Dompdf;

use PhpOffice\Common\Autoloader as CAutoloader;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\Style\TablePosition;

Autoloader::register();
CAutoloader::register();
Settings::loadConfig();

include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
include_once(APPPATH . "third_party/PHPExcel/PHPExcel.php");


class Test extends CI_Controller
{

    public function perilaku_get_menilai($nip)
    {
        $this->load->model("kinerja/Perilaku_model");
        $pegawai = $this->db->where("nip", $nip)->get("pegawai")->row();
        $dt = $this->Perilaku_model->getPegawai($pegawai->id_user);
        echo "<pre>";
        print_r($dt);
        die;
    }

    public function info()
    {
        phpinfo();
    }

    public function ok()
    {
        echo "ok\n";
    }

    public function test_calendar()
    {
        $bulan = date("m");
        $tahun = date("Y");
        $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        echo $jml_hari;
    }
    public function test_curl()
    {


        $server_ip = 'tte.sumedangkab.go.id';
        $server_user = 'esign';
        $server_pass = '9DyhDH4fV4fHyCKF';
        $error = false;
        $message = "";
        $file_ttd = "";
        $postData = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $server_ip . '/api/sign/pdf');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        // curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // curl_setopt($ch, CURLOPT_USERPWD, "$server_user:$server_pass");

        $result = curl_exec($ch);

        print_r($result);
    }
    public function update_capaian($id_renaksi_detail)
    {
        $this->load->model("kinerja/Renaksi_model");
        $this->load->model("kinerja/Capaian_model");
        $param['where']['renaksi_detail.id_renaksi_detail'] = $id_renaksi_detail;
        $renaksi_detail = $this->Renaksi_model->get_detail($param)->row();
        //$this->Capaian_model->update($renaksi_detail);

        $data = $renaksi_detail;

        $id = $value = "";

        $bulan = $data->bulan;
        $id_skp = $data->id_skp;

        if (!empty($data->id_kinerja_utama)) {
            $id = "id_kinerja_utama";
            $value = $data->id_kinerja_utama;
        } else if (!empty($data->id_instruksi_khusus)) {
            $id = "id_instruksi_khusus";
            $value = $data->id_instruksi_khusus;
        } else if (!empty($data->id_kinerja_tambahan)) {
            $id = "id_kinerja_tambahan";
            $value = $data->id_kinerja_tambahan;
        }

        echo $id;

        if ($id != "") {
            $capaian = 0;
            $status_jadwal = "N";

            $this->db->select("avg(capaian_lkh) as 'capaian' ");
            $this->db->where("renaksi." . $id, $value);
            $this->db->where("renaksi_detail.bulan", $bulan);
            $this->db->where("renaksi_detail.status_jadwal", "Y");
            $this->db->join("ekinerja_renaksi renaksi", "renaksi.id_renaksi = renaksi_detail.id_renaksi", "left");
            $summary = $this->db->get("ekinerja_renaksi_detail renaksi_detail")->row();

            if ($summary && $summary->capaian) {
                $capaian = $summary->capaian;
                $status_jadwal = "Y";
            }



            $update = array(
                'capaian' => $capaian,
                'status_jadwal' => $status_jadwal
            );


            if (!empty($data->tahun)) {
                $update['tahun'] = $data->tahun;
            }

            if (!empty($data->tahun_desc)) {
                $update['tahun_desc'] = $data->tahun_desc;
            }



            $status = $this->db
                ->where($id, $value)
                ->where("bulan", $bulan)
                ->where("id_skp", $id_skp)
                ->update("ekinerja_capaian", $update);

            echo "value=" . $value;
            echo "bulan=" . $bulan;
            echo "id_skp=" . $id_skp;
            echo "<pre>";
            print_r($status);

            // hitung ulang skp..
            /* $this->load->model("kinerja/Skp_model");
            $this->Skp_model->hitung_capaian($id_skp); */

            //echo "<pre>";print_r($summary);

        }

        echo "<pre>";
        print_r($renaksi_detail);
        die;
    }

    public function verifikasi_lkh($id_pegawai)
    {
        $this->load->model('laporan_kinerja_harian_model');
        $list = $this->laporan_kinerja_harian_model->get_verifikasi_by_pegawai($id_pegawai, true);
        echo "<pre>";
        print_r($list);
        die;
    }

    public function rsud()
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://smartrsud.sumedangkab.go.id:8282/api/auth/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'email=admin%40gmail.com&password=password',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            )
        );
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }
    public function tes_tpp()
    {
        $this->load->model('tpp/tpp_perhitungan_model');
        $tpp = $this->tpp_perhitungan_model->get_tpp(10396);
        print_r($tpp);
    }
    public function get_radius()
    {
        $id_pegawai = 10352;
        $pegawai = $this->db
            ->join("ref_skpd", "ref_skpd.id_skpd = pegawai.id_skpd", "left")
            ->where("id_pegawai", $id_pegawai)
            ->get("pegawai")->row();

        // echo "<pre>";print_r($pegawai);-6.8428583,107.9264645

        $latitude = floatval("-6.849129");
        $longitude = floatval("108.244602");

        $latitude2 = floatval("-6.848628"); //$pegawai->latitude
        $longitude2 = floatval("108.244672"); // $pegawai->longitude;

        if ($latitude && $longitude && $latitude2 && $longitude2) {
            $this->load->helper("distance");
            $distance = distance($latitude, $longitude, $latitude2, $longitude2, "M");
            //$distance = vincentyGreatCircleDistance($latitude,$longitude,floatval($pegawai->latitude),floatval($pegawai->longitude));
            echo number_format($distance) . " Meter";
            /*
            $url ="https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=-6.8323912,107.9224318&destinations=-6.8428583,107.9264645";
            $ch = curl_init();
            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);
            // Execute
            $result=curl_exec($ch);
            // Closing
            curl_close($ch);
            $result_array=json_decode($result);
            print_r($result_array);
            */
        }
    }
    public function tanpa_keterangan()
    {
        $id_pegawai = 317;
        $tanggal = "2020-10-02";
        $cek = $this->db->where("id_pegawai", $id_pegawai)
            ->where("tanggal", $tanggal)
            ->get("absen_log");

        if ($cek->num_rows() == 0) {
            $this->load->model("absen_model");
            $this->absen_model->tanpa_keterangan($id_pegawai, $tanggal);
        }
    }

    public function get_month()
    {
        $tanggal = "2020-10-03";
        $bulan = date("n", strtotime($tanggal . " -1 days"));

        echo $bulan;
    }

    public function auto_absen()
    {
        $tanggal_awal = "2020-10-01";
        $tanggal_akhir = "2020-10-10";
        while ($tanggal_awal <= $tanggal_akhir) {
            echo $tanggal_awal . "<br>";
            $tanggal_awal = date("Y-m-d", strtotime($tanggal_awal . " +1 days"));
        }
    }
    public function tpp_absen()
    {
        $param = array(
            'id_pegawai' => 26,
            'bulan' => 9,
            'tahun' => 2020,
            'id_ket_log' => "A1",
        );
        $this->load->model("tpp/Tpp_perhitungan_model");
        $tpp_absen = $this->Tpp_perhitungan_model->tpp_absen($param);
        echo "<pre>";
        print_r($tpp_absen);
        die;
    }

    public function notif()
    {
        require(APPPATH . 'libraries/PushNotification/Firebase.php');
        $firebase = new Firebase();
        $title = "Test4";
        $message = "Just Test 4";
        $click_action = "surat_keluar";
        $data_id = "1";
        $data = array(
            'id_surat_keluar' => 1,
            'perihal' => 'perihal',
            'tgl_surat' => date('Y-m-d'),
        );
        $raw_data = json_encode($data);

        $regId = "ffMk4K7yOXc:APA91bEgRGx1OOk8C4OYaAWVLcDjhcsAQIiVEdmZuDO5HTUyMx-71CxDtohM30MBU_gO9e-C7vFm4OwsRcwvhXZUtpNJzH2VmxN96jeIto2TJ91UwQHDNBoRjpgHUi8xTlWNasMrWfnP";
        $regIds = array("ffMk4K7yOXc:APA91bEgRGx1OOk8C4OYaAWVLcDjhcsAQIiVEdmZuDO5HTUyMx-71CxDtohM30MBU_gO9e-C7vFm4OwsRcwvhXZUtpNJzH2VmxN96jeIto2TJ91UwQHDNBoRjpgHUi8xTlWNasMrWfnP");
        //$response = $firebase->send($regId, $title, $message,$click_action,$data_id,$raw_data);
        //$response = $firebase->send($regId, $title, $message,$data);
        //$response = $firebase->sendToTopic("global", $title, $message,$data);
        //$response = $firebase->sendToTopic("/topics/global", $title, $message,$data);
        $response = $firebase->sendMulti($regIds, $title, $message, $click_action, $data_id, $raw_data);
        var_dump($response);
    }
    public function get_surat_keluar($id_surat_keluar)
    {
        $this->db->where('surat_keluar_penerima.id_surat_keluar', $id_surat_keluar);

        $this->db->select("*, surat_keluar_penerima.id_skpd as id_skpd_eksternal, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.id_skpd as id_skpd_penerima, pegawai_penerima.id_unit_kerja as id_unit_kerja_penerima, pegawai_penerima.id_pegawai as id_pegawai_penerima, user.app_token");

        $this->db->join('surat_keluar', 'surat_keluar_penerima.id_surat_keluar = surat_keluar.id_surat_keluar', 'left');

        $this->db->join('pegawai as pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');

        $this->db->join('pegawai as pegawai_penerima', 'surat_keluar_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
        $this->db->join('user', 'user.id_pegawai = surat_keluar_penerima.id_pegawai', 'left');

        $get = $this->db->get('surat_keluar_penerima')->result();

        echo "<pre>";
        print_r($get);
        die;
    }
    public function get_all_token()
    {
        $this->db->select("app_token");
        $this->db->where("app_token is not null");
        $token = $this->db->get("user")->result_array();
        echo "<pre>";
        print_r(array_values($token));
    }

    public function htmltoxml()
    {
        $this->load->library('HTMLtoOpenXML');
        $toOpenXML = HTMLtoOpenXML::getInstance()->fromHTML("<p>te<b>s</b>t</p>");
        echo $toOpenXML;
    }

    public function fix_surat_masuk()
    {
        // copy('./data/surat_internal/ttd/surat20201110101314MGZINDRL_(signed).pdf', './data/surat_internal/surat_masuk/surat20201110101314MGZINDRL_(signed).pdf');
    }

    public function repair_lkh()
    {
        $file = './data/ex.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        $data = array();
        $key = 0;
        foreach ($sheets as $s) {
            if (!empty($s['B'])) {
                $tanggal = explode(',', $s['B']);
                $tanggal = trim($tanggal[1]);
                $tanggal = explode(' ', $tanggal);
                $tanggal = '2020-06-' . $tanggal[0];
                $data[$key]['tanggal'] = $tanggal;
                $data[$key]['id_pegawai'] = 3123;
                $data[$key]['id_skpd'] = 23;
                $data[$key]['lampiran'] = NULL;
                $data[$key]['id_verifikator'] = 930;
                $data[$key]['status_verifikasi'] = 'sudah_diverifikasi';
            }
            if (!empty($s['C'])) {
                if (empty($data[$key]['rincian_kegiatan'])) {
                    $data[$key]['rincian_kegiatan'] = '';
                }
                $data[$key]['rincian_kegiatan'] .= $s['C'] . "\n";
                if (empty($data[$key]['hasil_kegiatan'])) {
                    $data[$key]['hasil_kegiatan'] = '';
                }
                $data[$key]['hasil_kegiatan'] .= $s['D'] . "\n";
            } else {
                $key++;
            }
        }
        foreach ($data as $d) {
            // $this->db->insert('laporan_kerja_harian',$d);
        }
    }

    public function test_waktu()
    {
        if (date('Y-m-d') == '2020-07-20' && (date('H:i') >= '10:00' && date('H:i') < '12:00')) {
            echo "aktif";
        } else {
            echo "tidak";
        }
    }


    public function delete_duplicate_absen()
    {
        $this->db->select("id_pegawai,tanggal, count(tanggal) as 'jumlah' ");
        $this->db->group_by("id_pegawai");
        $this->db->group_by("tanggal");
        $this->db->order_by("count(tanggal)", "DESC");
        $this->db->limit(100);
        $rs = $this->db->get("absen_log");

        $rows = array();


        foreach ($rs->result() as $row) {
            if ($row->jumlah > 1) {
                $rows[] = $row;
            }
        }

        //echo "<pre>";print_r($rows); die;

        $ids = array();

        foreach ($rows as $row) {
            $this->db->where("id_pegawai", $row->id_pegawai);
            $this->db->where("tanggal", $row->tanggal);
            $dt = $this->db->get("absen_log")->result();

            $i = 0;
            foreach ($dt as $da) {
                if ($i > 0) {
                    $ids[] = $da->id_log;
                }
                $i++;
            }
        }

        //echo "<pre>";print_r($ids); die;
        $this->db->where_in("id_log", $ids);
        $this->db->delete("absen_log");
    }

    public function get_jabatan_simpeg()
    {
        $data = file_get_contents('http://simpeg.sumedangkab.go.id/api/public/pegawai?key=050610');
        $data = json_decode($data);
        foreach ($data as $n => $d) {
            $d->nama_jabatan = explode(' pada ', $d->nama_jabatan)[0];
            $no = $n + 1;
            if (!empty($d->nama_jabatan)) {
                $cek = $this->db->get_where('ref_jabatan_new', array('nama_jabatan' => $d->nama_jabatan))->num_rows();
                if ($cek == 0) {
                    // $this->db->insert('ref_jabatan_new', array('nama_jabatan' => $d->nama_jabatan));
                    echo "[$no] Sukses : " . $d->nama_jabatan . "\n";
                }
            }
        }
    }

    public function fix_absen()
    {
        $tanggal = "2020-10-02";
        $this->db->join('absen_shift', 'absen_shift.id_shift = absen_shift_setting.id_shift');
        $this->db->where("id_pegawai NOT IN (select id_pegawai FROM absen_log where tanggal='$tanggal')", NULL, FALSE);
        $pegawai = $this->db->get('absen_shift_setting')->result();
        echo tanggal($tanggal) . "\n";
        foreach ($pegawai as $n => $p) {
            // if ($p->jam_masuk == '07:30:00') {
            $no = $n + 1;
            $data = array(
                'id_pegawai' => $p->id_pegawai,
                'tanggal' => $tanggal,
                'jam_masuk' => $p->jam_masuk,
                'jam_pulang' => $p->jam_pulang
            );
            $this->db->insert('absen_log', $data);
            $id = $this->db->insert_id();
            // $id = $no;
            echo "[$no][$id] Sukses : $data[id_pegawai] - $data[jam_masuk] s.d $data[jam_pulang] \n";
            // die;
            // }
        }
    }


    public function fix_absen_all()
    {
        $tanggal = "2020-10-02";
        $this->db->select('absen_log.*,absen_shift.jam_masuk as jam_masuk_shift,absen_shift.jam_pulang as jam_pulang_shift');
        $this->db->join('absen_shift_setting', 'absen_shift_setting.id_pegawai = absen_log.id_pegawai');
        $this->db->join('absen_shift', 'absen_shift.id_shift = absen_shift_setting.id_shift');
        $pegawai = $this->db->get_where('absen_log', array('tanggal' => $tanggal))->result();
        echo tanggal($tanggal) . "\n";
        foreach ($pegawai as $n => $p) {
            // if ($p->jam_masuk == '07:30:00') {
            $no = $n + 1;
            $this->db->update('absen_log', array('jam_masuk' => $p->jam_masuk_shift, 'jam_pulang' => $p->jam_pulang_shift), array('id_log' => $p->id_log));
            echo "[$no][$p->id_log] Sukses : $p->id_pegawai - $p->jam_masuk_shift s.d $p->jam_pulang_shift \n";
            // die;
            // }
        }
    }


    public function fix_absenn()
    {
        $tanggal = "2020-10-02";
        echo tanggal($tanggal) . "<br>";
        $this->db->select('absen_log.*,absen_shift.jam_masuk as jam_masuk_shift,absen_shift.jam_pulang as jam_pulang_shift');
        $this->db->join('absen_shift_setting', 'absen_shift_setting.id_pegawai = absen_log.id_pegawai');
        $this->db->join('absen_shift', 'absen_shift.id_shift = absen_shift_setting.id_shift');
        $pegawai = $this->db->get_where('absen_log', array('tanggal' => $tanggal, 'absen_log.jam_pulang' => NULL))->result();
        foreach ($pegawai as $n => $p) {
            $no = $n + 1;
            $data = array(
                'id_pegawai' => $p->id_pegawai,
                'tanggal' => $tanggal,
                'jam_masuk' => $p->jam_masuk_shift,
                'jam_pulang' => $p->jam_pulang_shift
            );
            // $this->db->insert('absen_log',$data);
            // $id = $this->db->insert_id();
            // $this->db->update('absen_log',array('jam_pulang'=>$p->jam_pulang_shift),array('id_log'=>$p->id_log));
            $id = $no;
            echo "[$no][$id] $data[id_pegawai] - $data[jam_masuk] s.d $data[jam_pulang] - $p->jam_masuk s.d $p->jam_pulang \n";
        }
    }

    public function move_lkh()
    {
        $tanggal = "2020-08-02";
        echo tanggal($tanggal) . "<br>";
        $this->db->select('laporan_kerja_harian.*,pegawai.nama_lengkap,pegawai.id_skpd as id_skpd_baru');
        $this->db->join('pegawai', 'pegawai.id_pegawai = laporan_kerja_harian.id_pegawai');
        $lkh = $this->db->get_where('laporan_kerja_harian', array('tanggal' => $tanggal))->result();
        $no = 1;
        foreach ($lkh as $l) {
            if ($l->id_skpd !== $l->id_skpd_baru) {
                $this->db->update('laporan_kerja_harian', array('id_skpd' => $l->id_skpd_baru), array('id_laporan_kerja_harian' => $l->id_laporan_kerja_harian));
                echo "[$no] $l->nama_lengkap, Lama : $l->id_skpd, Baru : $l->id_skpd_baru<br>";
                $no++;
            }
        }
    }

    public function insert_talen()
    {
        if (!isset($_SERVER['HTTP_HOST'])) {
            $_SERVER['HTTP_HOST'] = 'localhost';
        }
        $file = './data/talen.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        // $uniquePids = array_unique(array_map(function ($i) { return $i['M']; }, $sheets));
        // print_r($uniquePids);

        $update = array();
        foreach ($sheets as $key => $s) {
            $data_update = array(
                'nip' => $s['B'],
                'rumpun' => $s['E'],
                'pendidikan' => $s['G'],
                'eselon' => $s['H'],
                'nilai_ppkpns' => $s['K'],
                'hukuman_disiplin' => strtolower($s['L'])
            );

            if ($s['I'] == 'Sesuai' || $s['I'] == 'sesuai') {
                $hasil_asesmen = 'sesuai';
            } elseif ($s['I'] == 'Sesuai Dengan Pengembangan' || $s['I'] == 'Sesuai dengan Pengembangan') {
                $hasil_asesmen = 'sesuai_dengan_pengembangan';
            } elseif ($s['I'] == 'Perlu Pengembangan Lebih Lanjut') {
                $hasil_asesmen = 'perlu_pengembangan_lebih_lanjut';
            } elseif ($s['I'] == 'Perlu Pengembangan') {
                $hasil_asesmen = 'perlu_pengembangan';
            } else {
                $hasil_asesmen = '';
            }
            $data_update['hasil_asesmen'] = $hasil_asesmen;

            if ($s['J'] == 'DiklatPIM Tk. II' || $s['J'] == 'Diklat PIM Tk. II' || $s['J'] == 'DIKLATPIM Tk.II') {
                $diklat_pim = 'II';
            } elseif ($s['J'] == 'DIKLATPIM Tk.III' || $s['J'] == 'DiklatPIM Tk. III' || $s['J'] == 'Diklat PIM Tk. III' || $s['J'] == 'DIKLATPIM TK. III' || $s['J'] == 'Diklat PIM Tk.III') {
                $diklat_pim = 'III';
            } elseif ($s['J'] == 'DIKLATPIM Tk.IV' || $s['J'] == 'Diklat PIM Tk. IV' || $s['J'] == 'DIKLATPIM TK. IV' || $s['J'] == 'DIKLATPIM IV' || $s['J'] == 'DIKLATPIM TK.IV') {
                $diklat_pim = 'IV';
            } elseif ($s['J'] == 'Diklat PIM Tk. I') {
                $diklat_pim = 'I';
            } else {
                $diklat_pim = '';
            }
            $data_update['diklat_pim'] = $diklat_pim;

            if ($s['M'] == 'KURANG 3 TAHUN') {
                $masa_kerja = "< 3";
            } elseif ($s['M'] == '3 S/D 5 TAHUN' || $s['M'] == '3 S/D 5 Tahun') {
                $masa_kerja = "3 s.d 5";
            } elseif ($s['M'] == 'Lebih 5 Tahun') {
                $masa_kerja = "> 5";
            } else {
                $masa_kerja = "";
            }
            $data_update['masa_kerja'] = $masa_kerja;
            $update[] = $data_update;
        }
        foreach ($update as $u) {
            $data = $u;
            unset($data['nip']);
            $up = $this->db->update('pegawai', $data, array('nip' => $u['nip']));
            echo "Sukses : $u[nip] \n";
        }
    }


    public function update_tpp_simpeg()
    {
        $data = file_get_contents('http://simpeg.sumedangkab.go.id/api/public/pegawai?key=050610');
        $data = json_decode($data);
        foreach ($data as $n => $d) {
            $nip = $d->nip;
            $grade = $d->grade;
            $tpp = $d->tpp;
            $jenis_jabatan = $d->jenis_jabatan;
            // $up = $this->db->update('pegawai', array('grade'=>$grade,'tpp'=>$tpp), array('nip' => $nip));
            $up = $this->db->update('pegawai', array('jenis_jabatan' => $jenis_jabatan), array('nip' => $nip));
            // echo "[$n] $d->nama_lengkap - $nip, TPP : $tpp,Grade : $grade \n";
            echo "[$n] $d->nama_lengkap - $nip, Jenis Jabatan : $jenis_jabatan \n";
            // die;
        }
    }

    public function update_talen()
    {
        $file = './data/talent_bos.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[0]);
        unset($sheets[1]);
        unset($sheets[2]);
        $n = 1;
        foreach ($sheets as $s) {
            $nip = trim($s['B']);
            $pegawai = $this->db->get_where('pegawai', array('nip' => $nip))->row();
            if ($pegawai) {
                $id_pegawai = $pegawai->id_pegawai;
                $data_insert = array(
                    'id_pegawai' => $id_pegawai,
                    'skor1' => $s['G'],
                    'nilai1' => $s['H'],
                    'skor2' => $s['J'],
                    'nilai2' => $s['K'],
                    'skor3' => $s['M'],
                    'nilai3' => $s['M'],
                    'skor4' => $s['P'],
                    'nilai4' => $s['Q'],
                    'skor5' => $s['S'],
                    'nilai5' => $s['T'],
                    'nilai_kompetensi' => $s['U'],
                    'kategori_kompetensi' => strtolower($s['V']),
                    'skor6' => $s['W'],
                    'nilai6' => $s['X'],
                    'skor7' => $s['Z'],
                    'nilai7' => $s['AA'],
                    'skor8' => $s['AC'],
                    'nilai8' => $s['AD'],
                    'nilai_kinerja' => $s['AE'],
                    'kategori_kinerja' => strtolower($s['AF'])
                );
                $cek = $this->db->get_where('pegawai_skor_talent', array('id_pegawai' => $id_pegawai))->num_rows();
                if ($cek < 1) {
                    $this->db->insert('pegawai_skor_talent', $data_insert);
                    echo "[$n] Sukses : $id_pegawai \n";
                    $n++;
                    // break;
                }
            }
        }
    }

    public function idata_simpeg()
    {
        //display error true
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $data = file_get_contents('http://simpeg.sumedangkab.go.id/api/public/pegawai?key=050610');
        $data = json_decode($data);
        foreach ($data as $n => $d) {
            $din = (array) $d;
            // print_r($din);
            // die;
            $in = $this->db->insert('pegawai_bkd2', $din);
            echo "[$n] $d->nama_lengkap - $d->nip \n";
            // die;
        }
    }

    public function convert_new_jabatan()
    {
        $pegawai = $this->db->get('pegawai')->result();
        $n = 1;
        foreach ($pegawai as $k => $p) {
            $d['id_unit_kerja'] = $p->id_unit_kerja;
            $d['id_skpd'] = $p->id_skpd;
            $d['nama_jabatan'] = $p->jabatan;
            $d['jenis_jabatan'] = $p->jenis_jabatan;
            $d['grade'] = $p->grade;
            $d['tpp'] = $p->tpp;
            if (!empty($d['id_skpd'])) {
                $cek = $this->db->get_where('pegawai_bkd', array('nip' => $p->nip))->row();
                if ($cek) {
                    $cek_jabatan = $this->db->get_where('ref_jabatan_baru', array('id_skpd' => $d['id_skpd'], 'nama_jabatan' => $d['nama_jabatan']))->row();
                    if ($cek_jabatan) {
                        $id_jabatan = $cek_jabatan->id_jabatan;
                    } else {
                        $in = $this->db->insert('ref_jabatan_baru', $d);
                        $id_jabatan = $this->db->insert_id();
                    }
                    $up = $this->db->update('pegawai', array('id_jabatan' => $id_jabatan), array('id_pegawai' => $p->id_pegawai));

                    echo "[$n] $p->nama_lengkap - " . $d['nama_jabatan'] . " \n";
                    $n++;
                    // die;
                }
            }

            // if ($k > 100) {
            //         break;
            // }
        }
    }

    public function az()
    {
        echo "asdkpoasdkpodkas";
    }


    public function insert_tpp_log_absen($bulan, $tahun)
    {
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $this->load->model('tpp/tpp_perhitungan_model');
        $this->load->model('tpp/tpp_model');
        // $this->db->where('id_pegawai', 2677);
        // $this->db->where('id_skpd', 2);
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();
        // $pegawai = $this->db->get_where('pegawai',array('id_pegawai'=>10472))->result();
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            $param = array(
                'id_pegawai' => $p->id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A1",
            );

            // A1 = TPP Masuk Telat dan pulang cepat
            $save = $this->tpp_model->simpan($param);

            $param_tap = array(
                'id_pegawai' => $p->id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $this->tpp_model->simpan($param_tap);
            //        print_r($save);continue;
            if ($save) {
                $ket = $save['keterangan'];
            } else {
                $ket = '';
            }
            // if ($p->id_pegawai == 2641) {
            // print_r($save);
            // break;
            // }
            echo "[$n] $p->nama_lengkap - $ket" . "\n";
            // if(!empty($ket)){
            //         die;
            // }
            // die;
        }
    }

    public function insert_tpp_tk5($bulan, $tahun)
    {
        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $this->load->model('tpp/tpp_perhitungan_model');
        $this->load->model('tpp/tpp_model');
        // $this->db->where('id_pegawai', 310);
        $this->db->where('id_skpd', 18);
        $pegawai = $this->db->get('pegawai')->result();

        // $pegawai = $this->db->get_where('pegawai',array('id_pegawai'=>10472))->result();
        foreach ($pegawai as $n => $p) {
            $param = array(
                'id_pegawai' => $p->id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A4",
            );


            // A4 = Tanpa Keterangan lebih dari 5 hari
            $save = $this->tpp_model->simpan($param);
            if ($save) {
                $ket = $save['keterangan'];
            } else {
                $ket = '';
            }
            // die;
            echo "[$n] $p->nama_lengkap - $ket" . "\n";
            // die;

            if (!empty($ket)) {
                break;
                die;
            }
        }
    }
    public function insert_tpp_lkh($bulan, $tahun)
    {
        $this->load->model('tpp/tpp_perhitungan_model');
        $this->load->model('tpp/tpp_model');
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('ref_hari_kerja_efektif_model');
        $pegawai = $this->laporan_kinerja_harian_model->get_all_pegawai('', $bulan, $tahun);
        $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);
        // $pegawai = $this->db->get('pegawai')->result();
        // $pegawai = $this->db->get_where('pegawai',array('id_pegawai'=>10472))->result();
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            if ($p->jumlah_lkh == 0 || $efektif == 0) {
                $persentase = 0;
            } else {
                $persentase = round(($p->jumlah_lkh / $efektif) * 100, 2);
            }

            $tpp = $this->tpp_perhitungan_model->get_tpp($p->id_pegawai);
            $param = array('id_ket_log' => 'L1', 'persentase' => $persentase, 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai, 'tpp' => $tpp);
            $save = $this->tpp_model->simpan($param);
            if ($save) {
                $ket = $save['keterangan'];
            } else {
                $ket = '';
            }
            // if ($p->id_pegawai == 2641) {
            // print_r($save);
            // break;
            // }
            echo "[$n] $p->nama_lengkap - $ket" . "\n";
            // die;
            // if($n>100){
            // break;
            // }
        }
    }

    public function update_skpd_user()
    {
        $user = $this->db->get('user')->result();
        foreach ($user as $u) {
            $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $u->id_pegawai))->row();
            if ($pegawai) {
                $this->db->update('user', array('kd_skpd' => $pegawai->id_skpd, 'unit_kerja_id' => $pegawai->id_unit_kerja), array('user_id' => $u->user_id));
                echo $u->full_name . "\n";
                // die;
            }
        }
    }

    public function set_pensiun()
    {

        $pegawai = $this->db->get('pegawai')->result();
        foreach ($pegawai as $n => $p) {
            $cek = $this->db->get_where('pegawai_bkd', array('nip' => $p->nip))->row();
            if (!$cek) {
                $this->db->update('pegawai', array('pensiun' => 1), array('id_pegawai' => $p->id_pegawai));
                echo "[$n] $p->nama_lengkap - Pensiun" . "\n";
            }
        }
    }

    public function dinkes()
    {

        $file = './data/dinkes.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1], $sheets[2], $sheets[3], $sheets[4], $sheets[5], $sheets[6]);
        // print_r($sheets);
        $data = array();
        foreach ($sheets as $n => $s) {
            $nip = trim(str_replace(' ', '', $s['B']));
            $unit = $s['L'];
            $jabatan = $s['G'];
            $jabatan = explode(' pada ', $jabatan)[0];
            $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
            $pegawai = $this->db->get_where('pegawai', array('nip' => $nip))->row();
            if ($pegawai) {
                if (strpos($unit, 'UPT Pusat Kesehatan') !== false || strpos($unit, 'UPT Gudang') !== false || strpos($unit, 'UPT Laboratorium') !== false) {
                    $skpd = $this->db->get_where('ref_skpd', array('nama_skpd' => $unit))->row();

                    if (strpos($jabatan, 'Kepala UPT') !== false) {
                        $kepala_skpd = "Y";
                    } else {
                        $kepala_skpd = NULL;
                    }
                    if (strpos($jabatan, 'Kepala') !== false) {
                        $jenis_pegawai = "kepala";
                    } else {
                        $jenis_pegawai = "staff";
                    }


                    // $cek_jabatan = $this->db->get_where('ref_jabatan_baru', array('id_skpd' => $skpd->id_skpd, 'nama_jabatan' => $jabatan))->row();
                    // if ($cek_jabatan) {
                    //         $id_jabatan = $cek_jabatan->id_jabatan;
                    // } else {
                    //         $d['id_skpd'] = $skpd->id_skpd;
                    //         $d['id_unit_kerja'] = 0;
                    //         $d['nama_jabatan'] = $jabatan;
                    //         $d['jenis_jabatan'] = $pegawai->jenis_jabatan;
                    //         $d['grade'] = $pegawai->grade;
                    //         $d['tpp'] = $pegawai->tpp;
                    //         $in = $this->db->insert('ref_jabatan_baru', $d);
                    //         $id_jabatan = $this->db->insert_id();
                    // }
                    // $this->db->update('pegawai', array('id_skpd' => $skpd->id_skpd, 'id_unit_kerja' => 0, 'id_jabatan' => $id_jabatan, 'kepala_skpd' => $kepala_skpd, 'jenis_pegawai' => $jenis_pegawai), array('id_pegawai' => $pegawai->id_pegawai));

                    echo "$nip -  $pegawai->nama_skpd - $unit - $skpd->id_skpd - $jabatan<br>";
                    // break;
                }
            } else {
                echo "$nip - <b>GAADA</b> - $unit<br>";
            }
        }
    }

    public function get_tanpa_keterangan_skpd($bulan, $tahun, $skpd)
    {
        $this->load->model('Absen_model');
        // $this->db->where('pegawai.id_pegawai', 428);
        // $this->db->where('pegawai.id_skpd', 16);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'pegawai.id_skpd ' => $skpd, 'bebas_absen' => NULL))->result();
        $k = 1;
        // print_r(($pegawai));die;
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $tk = 0;
            for ($tanggal = 1; $tanggal <= $jml_hari; $tanggal++) {
                $t = str_pad($tanggal, 2, '0', STR_PAD_LEFT);
                $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
                $tanggal_absen = "$tahun-$bulan-$t";
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $p->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($tanggal_absen));
                $fhari = "hari" . $hari;


                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }

                if ($shift->$fhari == "Y") {

                    $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
                    $tanggal_libur = array();
                    foreach ($libur as $l) {
                        $tanggal_libur[] = $l->tanggal_libur;
                    }

                    $absen = $this->db->get_where('absen_log', array('id_pegawai' => $p->id_pegawai, 'tanggal' => $tanggal_absen))->num_rows();
                    $log = $this->db
                        ->where('absen_ket_log.id_pegawai', $p->id_pegawai)
                        ->where('absen_ket_log_detail.tanggal', $tanggal_absen)
                        ->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log')
                        ->get('absen_ket_log_detail')
                        ->num_rows();
                    if (!in_array($tanggal_absen, $tanggal_libur) && empty($absen) && empty($log)) {
                        //Eksekusi
                        $this->Absen_model->tanpa_keterangan($p->id_pegawai, $tanggal_absen);
                        // echo $tanggal_absen;
                        $tk++;
                    }
                }
            }

            if ($tk > 0) {
                // if($tk>5){
                //         $param = array(
                //                 'id_pegawai'  => $p->id_pegawai,
                //                 'bulan'       => $bulan,
                //                 'tahun'       => $tahun,
                //                 'id_ket_log'  => "A4",
                //                 'jumlah'      => $tk,
                //         );
                //         $this->load->model("tpp/tpp_model");
                //         $this->tpp_model->simpan($param);
                //         $lebih = "\033[31m Lebih dari 5 hari";
                // }else{
                //         $lebih = "";
                // }

                echo "[$k] $p->id_pegawai $p->nama_lengkap - $p->nama_skpd [$tk Hari]\n";
                $k++;
            }
            // die;
            // if($k>5){
            //         break;
            // }
        }
    }


    public function get_tanpa_keterangan($bulan, $tahun)
    {
        $this->load->model('Absen_model');
        // $this->db->where('pegawai.id_pegawai', 428);
        // $this->db->where('pegawai.id_skpd', 16);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        // $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'pegawai.id_skpd !=' => 0, 'bebas_absen' => NULL))->result();
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'ref_skpd.jenis_skpd =' => 'kecamatan', 'bebas_absen' => NULL))->result();
        //$pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'ref_skpd.jenis_skpd =' => 'uptd', 'ref_skpd.id_skpd_induk' => '5', 'bebas_absen' => NULL))->result();
        $k = 1;
        // print_r(($pegawai));die;
        foreach ($pegawai as $n => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $tk = 0;
            for ($tanggal = 1; $tanggal <= $jml_hari; $tanggal++) {
                $t = str_pad($tanggal, 2, '0', STR_PAD_LEFT);
                $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
                $tanggal_absen = "$tahun-$bulan-$t";
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $p->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($tanggal_absen));
                $fhari = "hari" . $hari;


                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }

                if ($shift->$fhari == "Y") {

                    $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
                    $tanggal_libur = array();
                    foreach ($libur as $l) {
                        $tanggal_libur[] = $l->tanggal_libur;
                    }

                    $absen = $this->db->get_where('absen_log', array('id_pegawai' => $p->id_pegawai, 'tanggal' => $tanggal_absen))->num_rows();
                    $log = $this->db
                        ->where('absen_ket_log.id_pegawai', $p->id_pegawai)
                        ->where('absen_ket_log_detail.tanggal', $tanggal_absen)
                        ->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log')
                        ->get('absen_ket_log_detail')
                        ->num_rows();
                    if (!in_array($tanggal_absen, $tanggal_libur) && empty($absen) && empty($log)) {
                        //Eksekusi
                        $this->Absen_model->tanpa_keterangan($p->id_pegawai, $tanggal_absen);
                        // echo $tanggal_absen;
                        $tk++;
                    }
                }
            }

            if ($tk > 0) {
                // if($tk>5){
                //         $param = array(
                //                 'id_pegawai'  => $p->id_pegawai,
                //                 'bulan'       => $bulan,
                //                 'tahun'       => $tahun,
                //                 'id_ket_log'  => "A4",
                //                 'jumlah'      => $tk,
                //         );
                //         $this->load->model("tpp/tpp_model");
                //         $this->tpp_model->simpan($param);
                //         $lebih = "\033[31m Lebih dari 5 hari";
                // }else{
                //         $lebih = "";
                // }

                echo "[$k] $p->id_pegawai $p->nama_lengkap - $p->nama_skpd [$tk Hari]\n";
                $k++;
            }
            // die;
            // if($k>5){
            //         break;
            // }
        }
    }

    function color()
    {
        echo "\033[31m some colored text \033[0m some white text \n";
    }

    public function hitung_ulang_tpp($bln, $thn)
    {
        $this->load->model('ref_ket_absen_model');
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('absen_model');
        $this->load->model('tpp/tpp_model');
        $this->load->model('tpp/tpp_perhitungan_model');
        $this->load->model('master_pegawai_model');
        $this->load->model('ref_hari_kerja_efektif_model');

        $this->db->where('id_pegawai', 1358);
        $this->db->where('MONTH(tanggal_awal)', $bln);
        $this->db->where('YEAR(tanggal_awal)', $thn);
        $log = $this->db->get_where('absen_ket_log')->result();
        // print_r($log);die;
        foreach ($log as $n => $l) {
            $id_pegawai = $l->id_pegawai;
            $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
            $bulan = date("m", strtotime($l->tanggal_awal));
            $tahun = date("Y", strtotime($l->tanggal_awal));
            $lkh_p = $this->laporan_kinerja_harian_model->get_single_pegawai($id_pegawai, $bulan, $tahun);

            $efektif = $this->ref_hari_kerja_efektif_model->get_by_bulan($bulan);
            $ket_absen = $this->ref_ket_absen_model->get_by_id($l->id_ket_absen);
            // pengecualian :
            // DL = Dinas Luar; DD = Dinas Dalam; WH = Work from home, IM = Isolasi mandiri
            // Dianggap hadir (tidak masuk potongan TPP)
            if (in_array($l->id_ket_absen, ['DL', 'DD', 'WH', 'IM'])) {
                $tanggal = $l->tanggal_awal;
                $tanggal_akhir = $l->tanggal_akhir;
                while ($tanggal <= $tanggal_akhir) {
                    $this->absen_model->insert_absen($id_pegawai, $tanggal);
                    $tanggal = date("Y-m-d", strtotime($tanggal . " +1 days"));
                }
            } else {
                $param = array(
                    'id_pegawai' => $id_pegawai,
                    'bulan' => date("m", strtotime($l->tanggal_awal)),
                    'tahun' => date("Y", strtotime($l->tanggal_awal)),
                    'id_ket_log' => $l->id_ket_absen,
                    'jumlah' => 0
                );
                $save_tpp = $this->tpp_model->simpan($param);
            }


            //Sakit dan Cuti
            if (in_array($l->id_ket_absen, [5, 6, 7, 8, 9])) {
                $range = getDatesFromRange($l->tanggal_awal, $l->tanggal_akhir);
                foreach ($range as $tgl_lkh) {
                    $data_lkh = array(
                        'id_pegawai' => $id_pegawai,
                        'id_skpd' => $pegawai->id_skpd,
                        'tanggal' => $tgl_lkh,
                        'rincian_kegiatan' => $ket_absen->ket_absen,
                        'hasil_kegiatan' => '-',
                        'lampiran' => NULL,
                        'id_verifikator' => 0,
                        'status_verifikasi' => 'sudah_diverifikasi',
                        'automated' => 1
                    );
                    //Insert ke Laporan Kinerja Harian
                    $insert_lkh = $this->laporan_kinerja_harian_model->insert($data_lkh);

                    if ($lkh_p) {
                        if ($lkh_p->jumlah_lkh == 0 || $efektif == 0) {
                            $persentase = 0;
                        } else {
                            $persentase = round(($lkh_p->jumlah_lkh / $efektif) * 100, 2);
                        }
                    } else {
                        $persentase = 0;
                    }

                    if ($bulan == $bln && $tahun == $thn) {
                        $tpp = $this->tpp_perhitungan_model->get_tpp($id_pegawai);
                        $param = array('id_ket_log' => 'L1', 'persentase' => $persentase, 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $id_pegawai, 'tpp' => $tpp);
                        $save = $this->tpp_model->simpan($param);
                    }
                    $where_absen = array(
                        'id_pegawai' => $id_pegawai,
                        'tanggal' => $tgl_lkh,
                    );
                    //Hapus Absen
                    $delete_absen = $this->absen_model->delete_log($where_absen);
                }
            }
            echo "[$n] HITUNG ULANG $id_pegawai - $pegawai->nama_lengkap\n";
            if ($n >= 10) {
                // break;
            }
        }
    }

    public function hitung_ulang_lkh_pegawai($id_pegawai)
    {
        $this->load->model('ref_ket_absen_model');
        $this->load->model('laporan_kinerja_harian_model');
        $this->load->model('absen_model');
        $log = $this->db->get_where('absen_ket_log', array('id_pegawai' => $id_pegawai))->result();
        foreach ($log as $l) {
            $pegawai = $this->master_pegawai_model->get_by_id($id_pegawai);
            $ket_absen = $this->ref_ket_absen_model->get_by_id($l->id_ket_absen);
            if (in_array($l->id_ket_absen, [5, 6, 7, 8, 9])) {
                $range = getDatesFromRange($l->tanggal_awal, $l->tanggal_akhir);
                foreach ($range as $tgl_lkh) {
                    $data_lkh = array(
                        'id_pegawai' => $id_pegawai,
                        'id_skpd' => $pegawai->id_skpd,
                        'tanggal' => $tgl_lkh,
                        'rincian_kegiatan' => $ket_absen->ket_absen,
                        'hasil_kegiatan' => '-',
                        'lampiran' => NULL,
                        'id_verifikator' => 0,
                        'status_verifikasi' => 'sudah_diverifikasi',
                        'automated' => 1
                    );
                    //Insert ke Laporan Kinerja Harian
                    $insert_lkh = $this->laporan_kinerja_harian_model->insert($data_lkh);
                    $where_absen = array(
                        'id_pegawai' => $id_pegawai,
                        'tanggal' => $tgl_lkh,
                    );
                    //Hapus Absen
                    $delete_absen = $this->absen_model->delete_log($where_absen);
                }
            }
        }
    }

    public function hapus_potongan_bebas_absen()
    {
        $q = $this->db->query('SELECT * FROM `tpp_log` INNER JOIN pegawai ON pegawai.id_pegawai = tpp_log.id_pegawai WHERE pegawai.bebas_absen = "Y" AND tpp_log.id_ket_log = "L1" ORDER BY `id_log` DESC')->result();
        foreach ($q as $qq) {
            $this->db->delete('tpp_log', array('id_log' => $qq->id_log));
        }
    }

    public function get_absen_kosong($bulan, $tahun)
    {
        $this->load->model('absen_model');
        $this->load->model('tpp/tpp_model');
        $this->db->where('jam_pulang is null');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $get = $this->db->get('absen_log')->result();
        foreach ($get as $n => $g) {
            $id_pegawai = $g->id_pegawai;
            $id_log = $g->id_log;
            echo $id_pegawai . " - $id_log";
            $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $g->id_pegawai))->row();
            if (!$shift_setting) {
                $id_shift = 1;
            } else {
                $id_shift = $shift_setting->aktif_shift;
            }
            $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
            $pulang = $shift->jam_pulang;
            $jam_masuk = $g->jam_masuk;
            $jam_pulang = date('H:i:s', strtotime("-92 minutes", strtotime($pulang)));
            $data_update = array('jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang, 'flag' => 'H');
            $data_update['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk);
            $data_update['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang);
            $data_update['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang);
            // print_r($data_update);die;
            // $up = $this->db->update('absen_log', $data_update, array('id_log' => $g->id_log));
            // if ($up) {
            //         // echo $id_pegawai;
            //         // print_r($data_update);
            //         // die;
            //         // break;
            //         $param = array(
            //                 'id_pegawai'  => $g->id_pegawai,
            //                 'bulan'       => $bulan,
            //                 'tahun'       => $tahun,
            //                 'id_ket_log'  => "A1",
            //         );

            //         // A1 = TPP Masuk Telat dan pulang cepat
            //         $simpan_tpp = $this->tpp_model->simpan($param);
            //         print_r($simpan_tpp);
            //         // if ($n >= 100) {
            //         die;
            //         break;
            // }
            // }
        }
    }

    public function insert_tpp_absen_kosong($bulan, $tahun)
    {
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'id_skpd !=' => 0, 'bebas_absen' => NULL))->result();
        // print_r($pegawai);die;
        $this->load->model('tpp/tpp_model');
        foreach ($pegawai as $key => $row) {
            $param = array('id_ket_log' => 'A3', 'bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $row->id_pegawai);
            $save = $this->tpp_model->simpan($param);
            // print_r($save);die;
            if ($save) {
                echo "[$key] $row->nama_lengkap " . rupiah($save['nominal_potongan']) . " $save[keterangan]\n";
                // die;
            }
            // if($key==100){
            // break;
            // }
        }
    }

    public function get_kasubag_puskesmas()
    {
        $this->db->where('ref_skpd.jenis_skpd', 'puskesmas');
        $this->db->like('ref_jabatan_baru.nama_jabatan', "Kepala Sub Bagian");
        $this->db->join('ref_jabatan_baru', 'ref_jabatan_baru.id_jabatan = pegawai.id_jabatan');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai');
        $pegawai = $this->db->get('pegawai')->result();
        foreach ($pegawai as $p) {
            $privilege = $p->user_privileges;
            $ex = explode(';', $privilege);
            unset($ex[1]);
            $ex[] = "kepegawaian";
            $privilege = implode(';', $ex);
            $this->db->update('user', array('user_privileges' => $privilege), array('user_id' => $p->user_id));
            echo $p->id_pegawai . " - " . $p->nama_lengkap . "<br>";
            // die;
        }
    }

    public function delete_duplicate_tk()
    {
        $this->db->where('tanggal_awal', '2020-09-30');
        $this->db->where('tanggal_akhir', '2020-09-30');
        $this->db->where('id_ket_absen ', 'A2');
        $this->db->group_by("id_pegawai");
        $get = $this->db->get('absen_ket_log')->result();
        print_r($get);
        die;
        foreach ($get as $n => $row) {
            $this->db->where("id_pegawai", $row->id_pegawai);
            $dt = $this->db->get("absen_ket_log")->result();
            $i = 0;
            $ids = array();
            foreach ($dt as $da) {
                if ($i > 0) {
                    $ids[] = $da->id_ket_log;
                }
                $i++;
            }

            if (!empty($ids)) {

                $this->db->where_in("id_ket_log", $ids);
                $this->db->delete("absen_ket_log");
                // simpan tpp tanpa keterangan
                $param = array(
                    'id_pegawai' => $row->id_pegawai,
                    'bulan' => 9,
                    'tahun' => 2020,
                    'id_ket_log' => "A2",
                    'jumlah' => 1,
                );
                $this->load->model("tpp/tpp_model");
                $this->tpp_model->simpan($param);
                echo "[$n] $row->id_pegawai, Hapus " . count($ids) . " Absen\n";
                // break;
            }
        }
    }

    public function disdik()
    {
        $file = './data/disdik.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        unset($sheets[2]);
        $data = array();
        $nips = array();
        $n = 1;
        foreach ($sheets as $key => $s) {
            $nip = $s['B'];
            $nip = explode('/', $nip);
            $nip = trim($nip[1]);
            $nips[] = $nip;
            // $pegawai = $this->db->get_where('pegawai',array('nip'=>$nip))->row();
            // echo "[$n]".$pegawai->nama_lengkap." - $pegawai->id_skpd <br>";
            // $n++;
        }

        $pegawai = $this->db->get_where('pegawai', array('id_skpd' => 4, 'pensiun' => 0))->result();
        print_r($pegawai);
        die;
        $no = 1;
        foreach ($pegawai as $k => $p) {
            if (in_array($p->nip, $nips)) {
                // echo "[$no]".$p->nama_lengkap."<br>";
            } else {
                if (!in_array($p->id_pegawai, ['1120', '9829'])) {
                    $this->db->update('pegawai', array('id_skpd' => 400), array('id_pegawai' => $p->id_pegawai));
                    echo "[$no]" . $p->nama_lengkap . " - $p->jabatan <br>";
                    $no++;
                    // die;
                }
            }
        }
    }


    public function disdik2()
    {
        $file = './data/disdik2.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        $data = array();

        $nips = array();
        $namas = array();
        foreach ($sheets as $key => $s) {
            $nip = $s['B'];
            $nama = $s['A'];
            $nip = str_replace(',', '', $nip);
            $nip = str_replace(' ', '', $nip);
            $nip = str_replace('\'', '', $nip);
            $nips[] = trim($nip);
            $namas[] = trim($nama);
        }

        // print_r($namas);die;

        $pegawai = $this->db->get_where('pegawai', array('id_skpd' => 4))->result();
        $no = 1;
        foreach ($pegawai as $k => $p) {
            // if (empty($p->jabatan)) {
            // if (!in_array($p->nip, $nips)) {
            if (strpos($p->jabatan, "Penilik") !== false || strpos($p->jabatan, "Pengawas") !== false) {
                $this->db->update('pegawai', array('id_skpd' => 400), array('id_pegawai' => $p->id_pegawai));
                echo "[$no]" . $p->nama_lengkap . " - $p->nip - " . $p->jabatan . "<br>";
                $no++;
                // die;
            }
            // }
            // }
        }
    }

    public function fix_cuti_sakit()
    {
        $tanggal = '2020-10-02';
        $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
        $this->db->where("'$tanggal' BETWEEN tanggal_awal AND tanggal_akhir");
        $this->db->group_start();
        $this->db->where('ref_ket_absen.group_ket', 'cuti');
        $this->db->or_where('ref_ket_absen.group_ket', 'sakit');
        $this->db->group_end();
        $query = $this->db->get('absen_ket_log')->result();
        foreach ($query as $q) {
            $this->db->delete('absen_log', array('id_pegawai' => $q->id_pegawai, 'tanggal' => $tanggal));
            // die;
            echo $this->db->affected_rows();
            echo " - $q->id_pegawai<br>";
            // die;
        }
    }

    public function input_absen_bulan()
    {
        $this->load->model('absen_model');
        $bulan = 8;
        $tahun = 2020;
        $id_pegawai = 1786;
        $get_tanggal = $this->db->get_where('absen_log', array('id_pegawai' => 3011, 'month(tanggal)' => $bulan, 'year(tanggal)' => $tahun))->result();
        foreach ($get_tanggal as $g) {
            $tanggal = $g->tanggal;
            $this->absen_model->insert_absen($id_pegawai, $tanggal);
            echo $tanggal . "<br>";
        }
    }

    public function insert_log_detail()
    {
        $log = $this->db->get('absen_ket_log')->result();
        $n = 1;
        foreach ($log as $l) {
            $dates = array();
            if (empty($l->tanggal_akhir)) {
                $dates[] = $l->tanggal_awal;
            } else {
                $dates = getDatesFromRange($l->tanggal_awal, $l->tanggal_akhir);
            }
            $hari = 0;
            foreach ($dates as $d) {
                $cek = $this->db->get_where('absen_ket_log_detail', array('id_ket_log' => $l->id_ket_log, 'tanggal' => $d))->num_rows();
                if ($cek == 0) {
                    $insert = $this->db->insert('absen_ket_log_detail', array('id_ket_log' => $l->id_ket_log, 'tanggal' => $d));
                    $hari++;
                }
            }
            echo "[$n] [$l->id_ket_log] Sukses $hari hari \n";
            $n++;
            // die;
        }
    }

    public function log_baru()
    {
        $this->load->model('tpp/tpp_model');
        $jumlah = $this->tpp_model->get_absen_ket_log(10039, 10, 2020, '8');
        print_r($jumlah);
        $jumlah = $this->tpp_model->get_jumlah_ket_log(10039, 10, 2020, '8');
        print_r($jumlah);
    }

    public function lkh_baru()
    {
        $this->load->model('laporan_kinerja_harian_model');
        $id_pegawai = 393;
        $bulan = 10;
        $tahun = 2020;
        $tpp = $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai, $bulan, $tahun);
        print_r($tpp);
    }

    public function fix_bebas_absen()
    {
        $bulan = 01;
        $tahun = 2023;
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->db->order_by('nama_lengkap');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        // $this->db->where('pegawai.id_skpd', 1);
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur = array();
        foreach ($libur as $l) {
            $tanggal_libur[] = $l->tanggal_libur;
        }



        $n = 1;
        foreach ($pegawai as $k => $v) {

            $tanggal_log = array();

            $this->db->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log');
            $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
            $log = $this->db->get_where('absen_ket_log_detail', array('id_pegawai' => $v->id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();

            $ket = array('cuti', 'sakit', 'tk');
            foreach ($log as $lo) {
                if (in_array($lo->group_ket, $ket)) {
                    $tanggal_log[] = $lo->tanggal;
                }
            }

            if ($v->id_skpd_induk == 5 || $v->id_skpd == 400) {
                continue;
            }
            // if($v->id_pegawai==2405){
            //         continue;
            // }
            $absen_log = $this->db->get_where('absen_log', array('id_pegawai' => $v->id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
            foreach ($absen_log as $l) {
                $id_pegawai = $v->id_pegawai;
                $tanggal = $l->tanggal;
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $v->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($l->tanggal));
                $fhari = "hari" . $hari;

                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }


                if ($shift->$fhari !== "Y" || in_array($l->tanggal, $tanggal_libur) || in_array($l->tanggal, $tanggal_log)) {
                    $this->db->delete('absen_log', array('id_pegawai' => $v->id_pegawai, 'tanggal' => $l->tanggal));
                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);
                    // echo $id_pegawai;die;

                    echo "[$n] $v->nama_lengkap - $v->nama_skpd [" . tanggal_hari($l->tanggal) . "] $id_shift \n";
                    $n++;
                    // die;
                }
            }
        }
    }


    public function fix_tanpa_keterangan()
    {
        $bulan = 10;
        $tahun = 2022;
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->db->order_by('nama_lengkap');
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        // $this->db->where('ref_skpd.id_skpd_induk', 5);
        // $this->db->where('ref_skpd.id_skpd', 20);
        // $this->db->where('pegawai.id_pegawai', 10489);
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0))->result();

        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        $tanggal_libur = array();
        foreach ($libur as $l) {
            $tanggal_libur[] = $l->tanggal_libur;
        }

        $n = 1;
        // print_r(count($pegawai));die;
        foreach ($pegawai as $k => $v) {

            if ($v->id_skpd_induk == 5 || $v->id_skpd == 400) {
                continue;
            }
            // if($v->id_pegawai==2405){
            //         continue;
            // }
            $log = $this->db->get_where('absen_ket_log', array('id_ket_absen' => 'A2', 'id_pegawai' => $v->id_pegawai, 'MONTH(tanggal_awal)' => $bulan, 'YEAR(tanggal_awal)' => $tahun))->result();
            foreach ($log as $l) {
                $id_pegawai = $v->id_pegawai;
                // echo $id_pegawai;die;
                $tanggal = $l->tanggal_awal;
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $v->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($l->tanggal_awal));
                $fhari = "hari" . $hari;

                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }
                $absen = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal))->row();
                if ($shift->$fhari !== "Y" || in_array($l->tanggal_awal, $tanggal_libur) || $absen || $tanggal > date('Y-m-d')) {
                    if ($v->id_skpd_induk == 5 && $hari == 7) {
                        continue;
                    }
                    // if ($v->id_skpd_induk !== 5 && in_array($l->tanggal_awal, $tanggal_libur)) {
                    //Hapus Tanpa Keterangan
                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);
                    echo "[$n] $v->nama_lengkap - $v->nama_skpd [" . tanggal_hari($l->tanggal_awal) . "] $l->id_ket_absen \n";
                    // die;
                    $n++;
                    // }
                }
            }
        }
    }

    public function insert_talent_pelaksana()
    {

        $file = './data/talent_pelaksana1.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        unset($sheets[2]);
        $file_rumpun = './data/talent_pelaksana2.xlsx';
        $load_rumpun = PHPExcel_IOFactory::load($file_rumpun);
        $rumpuns = $load_rumpun->getActiveSheet()->toArray(null, true, true, true);
        unset($rumpuns[1]);
        unset($rumpuns[2]);
        $list_rumpun = array();
        foreach ($rumpuns as $r) {
            $nip = str_replace(' ', '', $r['C']);
            $list_rumpun[$nip] = $r['F'];
        }
        $n = 1;
        foreach ($sheets as $s) {
            // print_r($s);die;
            $nip = str_replace(' ', '', $s['C']);
            if (isset($list_rumpun[$nip])) {
                $rumpun = $list_rumpun[$nip];
                $this->db->update('pegawai', array('rumpun' => $rumpun), array('nip' => $nip));

                $pegawai = $this->db->get_where('pegawai', array('nip' => $nip))->row();
                if ($pegawai) {
                    $id_pegawai = $pegawai->id_pegawai;
                    $nilai_kompetensi = $s['P'];
                    $nilai_kinerja = $s['AA'];

                    if ($nilai_kompetensi > 5.293895023) {
                        $kategori_kompetensi = "tinggi";
                    } elseif ($nilai_kompetensi > 4.662487955) {
                        $kategori_kompetensi = "sedang";
                    } else {
                        $kategori_kompetensi = "rendah";
                    }

                    if ($nilai_kinerja > 35.31472722) {
                        $kategori_kinerja = "tinggi";
                    } elseif ($nilai_kinerja > 37.12322853) {
                        $kategori_kinerja = "sedang";
                    } else {
                        $kategori_kinerja = "rendah";
                    }


                    $cek = $this->db->get_where('pegawai_skor_talent2', array('id_pegawai' => $id_pegawai))->num_rows();
                    if ($cek == 0) {
                        $data_insert = array(
                            'id_pegawai' => $id_pegawai,
                            'jenis_jabatan' => 'pelaksana',
                            'jabatan' => $s['D'],
                            'nilai_kompetensi' => $nilai_kompetensi,
                            'kategori_kompetensi' => $kategori_kompetensi,
                            'nilai_kinerja' => $nilai_kinerja,
                            'kategori_kinerja' => $kategori_kinerja
                        );
                        $insert = $this->db->insert('pegawai_skor_talent2', $data_insert);
                        echo "[$n] $nip $s[B] - $rumpun [Kompetensi : $nilai_kompetensi - $kategori_kompetensi] [Kinerja : $nilai_kinerja - $kategori_kinerja]<br>";
                        $n++;
                    }
                }
            }
        }
    }

    public function insert_talent_fungsional()
    {

        $file = './data/talent_fungsional.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        unset($sheets[2]);
        $n = 1;
        foreach ($sheets as $s) {
            // print_r($s);die;
            $nip = str_replace(' ', '', $s['C']);

            $pegawai = $this->db->get_where('pegawai', array('nip' => $nip))->row();
            if ($pegawai) {
                $id_pegawai = $pegawai->id_pegawai;
                $nilai_kompetensi = $s['K'];
                $nilai_kinerja = $s['P'];

                if ($nilai_kompetensi > 340) {
                    $kategori_kompetensi = "tinggi";
                } elseif ($nilai_kompetensi > 78) {
                    $kategori_kompetensi = "sedang";
                } else {
                    $kategori_kompetensi = "rendah";
                }

                if ($nilai_kinerja > 88) {
                    $kategori_kinerja = "tinggi";
                } elseif ($nilai_kinerja > 80) {
                    $kategori_kinerja = "sedang";
                } else {
                    $kategori_kinerja = "rendah";
                }


                $cek = $this->db->get_where('pegawai_skor_talent2', array('id_pegawai' => $id_pegawai))->num_rows();
                if ($cek == 0) {
                    $data_insert = array(
                        'id_pegawai' => $id_pegawai,
                        'jenis_jabatan' => 'fungsional',
                        'jabatan' => $s['F'],
                        'nilai_kompetensi' => $nilai_kompetensi,
                        'kategori_kompetensi' => $kategori_kompetensi,
                        'nilai_kinerja' => empty($nilai_kinerja) ? 0 : $nilai_kinerja,
                        'kategori_kinerja' => $kategori_kinerja
                    );
                    // print_r($data_insert);die;
                    $insert = $this->db->insert('pegawai_skor_talent2', $data_insert);
                    echo "[$n] $nip $s[B] -  [Kompetensi : $nilai_kompetensi - $kategori_kompetensi] [Kinerja : $nilai_kinerja - $kategori_kinerja]<br>";
                    $n++;
                }
            }
        }
    }

    public function delete_tanpa_keterangan()
    {
        $this->load->model('absen_model');
        $bulan = 12;
        $tahun = 2020;
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_ket_log.id_pegawai');
        // $this->db->where('pegawai.id_skpd', 1);
        $log = $this->db->get_where('absen_ket_log', array('id_ket_absen' => 'A2', 'MONTH(tanggal_awal)' => $bulan, 'YEAR(tanggal_awal)' => $tahun))->result();
        $n = 1;
        foreach ($log as $l) {
            $tanggal = $l->tanggal_awal;
            $id_pegawai = $l->id_pegawai;
            $absen = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal))->row();

            $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
            $tanggal_libur = array();
            foreach ($libur as $le) {
                $tanggal_libur[] = $le->tanggal_libur;
            }
            if ($absen || $tanggal > date('Y-m-d') || in_array($tanggal, $tanggal_libur)) {
                if (isset($absen->id_log)) {
                    $id_log = $absen->id_log;
                } else {
                    $id_log = 0;
                }
                $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
                echo "[$n] $l->nama_lengkap $id_log [" . tanggal_hari($l->tanggal_awal) . "] $l->id_ket_absen \n";
                $n++;
            }
        }
    }

    public function madasihh()
    {
        $a = curlMadasih('list_desa');
        print_r($a);
    }

    // public function fix_unsend_surat_masuk()
    // {
    //         $id_surat_keluar = 11652;

    //                 $this->db->where('surat_keluar_penerima.id_surat_keluar', $id_surat_keluar);

    //                 $this->db->select("*, surat_keluar_penerima.id_skpd as id_skpd_eksternal, pegawai_input.nama_lengkap as nama_lengkap_input, pegawai_penerima.nama_lengkap as nama_lengkap_penerima, pegawai_penerima.id_skpd as id_skpd_penerima, pegawai_penerima.id_unit_kerja as id_unit_kerja_penerima, pegawai_penerima.id_pegawai as id_pegawai_penerima, user.app_token");

    //                 $this->db->join('surat_keluar', 'surat_keluar_penerima.id_surat_keluar = surat_keluar.id_surat_keluar', 'left');

    //                 $this->db->join('pegawai as pegawai_input', 'surat_keluar.id_pegawai_input = pegawai_input.id_pegawai', 'left');

    //                 $this->db->join('pegawai as pegawai_penerima', 'surat_keluar_penerima.id_pegawai = pegawai_penerima.id_pegawai', 'left');
    //                 $this->db->join('user', 'user.id_pegawai = surat_keluar_penerima.id_pegawai', 'left');
    //                 $this->db->group_by("surat_keluar_penerima.id_surat_keluar_penerima");
    //                 $penerima = $this->db->get('surat_keluar_penerima')->result();
    //                 foreach ($penerima as $p) {
    //                         $masuk = $this->db->get_where('surat_masuk', array('id_pegawai_penerima' => $p->id_pegawai, 'hash_id' => $p->hash_id))->row();
    //                         if ($masuk) {
    //                                 echo "$p->nama_lengkap SUDAH MASUK<br>";
    //                         } else {
    //                                 echo "$p->nama_lengkap BELUM MASUK<br>";
    //                                 $row = $p;
    //                                 $id_skpd_penerima = $row->id_skpd_penerima;
    //                                 $id_unit_kerja_penerima = $row->id_unit_kerja_penerima;
    //                                 $id_pegawai_penerima = $row->id_pegawai_penerima;
    //                                 $data = array(
    //                                         'jenis_surat' => $row->jenis_surat,
    //                                         'perihal' => $row->perihal,
    //                                         'pengirim' => $row->nama_lengkap_input,
    //                                         'tanggal_surat' => $row->tgl_buat,
    //                                         'nomer_surat' => $row->nomer_surat,
    //                                         'sifat' => $row->sifat_surat,
    //                                         'isi_ringkasan' => $row->isi_surat,
    //                                         'file_surat' => $row->file_ttd,
    //                                         'lampiran' => $row->file_lampiran,
    //                                         'id_pegawai_input' => $row->id_pegawai_input,
    //                                         'tgl_input' => date('Y-m-d'),
    //                                         'status_surat' => 'Belum Dibaca',
    //                                         'id_skpd_penerima' => $id_skpd_penerima,
    //                                         'id_unitkerja_penerima' => $id_unit_kerja_penerima,
    //                                         'id_pegawai_penerima' => $id_pegawai_penerima,
    //                                         'hash_id' => $row->hash_id
    //                                 );
    //                                 // print_r($data);die;
    //                                 $this->db->insert('surat_masuk', $data);
    //                         }
    //                 }
    // }

    public function fix_tap($bulan, $tahun)
    {

        $this->load->model('Absen_model');
        $this->load->model('tpp/Tpp_model');
        $this->load->model('tpp/Tpp_perhitungan_model');
        // $this->db->where('id_pegawai',26);
        // $this->db->where('pegawai.id_skpd', 18);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'pegawai.id_skpd !=' => 0, 'bebas_absen' => NULL))->result();

        foreach ($pegawai as $k => $p) {
            if ($p->id_skpd == 400) {
                continue;
            }
            $n = $k + 1;
            $id_pegawai = $p->id_pegawai;
            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $simpan = $this->Tpp_model->simpan($param_tap);
            echo "[$n] $p->nama_lengkap \n";
        }
    }


    public function add_absensi($bulan, $tahun)
    {
        $this->load->model('absen_model');
        $this->load->model('tpp/Tpp_model');
        $this->db->where('pegawai.id_skpd', 4);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai', array('pensiun' => 0, 'pegawai.id_skpd !=' => 0, 'bebas_absen' => NULL))->result();
        $k = 1;
        // print_r(count($pegawai));die;
        foreach ($pegawai as $n => $p) {
            $k = $n + 1;
            $id_pegawai = $p->id_pegawai;
            $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $p->id_pegawai))->row();
            if (!$shift_setting) {
                $id_shift = 1;
            } else {
                $id_shift = $shift_setting->aktif_shift;
            }
            $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
            $jam_masuk = $shift->jam_masuk;
            $jam_pulang = $shift->jam_pulang;

            $this->db->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log');
            $log_tk = $this->db->get_where('absen_ket_log_detail', array('id_pegawai' => $p->id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun, 'id_ket_absen' => 'A2'))->result();

            $ctk = count($log_tk);
            $koreksi = round($ctk * 70 / 100);

            $koreksied = 0;
            if ($ctk > 5) {
                foreach ($log_tk as $ntk => $tk) {
                    if ($ntk + 1 > $koreksi) {
                        break;
                    }
                    $tanggal = $tk->tanggal;
                    $cek = $this->absen_model->if_absen_exist($tanggal, $id_pegawai);
                    if (!$cek) {
                        $lop = array('-', '+');

                        $op = $lop[rand(0, 1)];
                        $rand = rand(0, 20);
                        $jam_masuk = date("H:i:s", strtotime("$op $rand minutes", strtotime($jam_masuk)));

                        $lop = array('-', '+', '+', '+');
                        $op = $lop[rand(0, 3)];
                        $rand = rand(0, 20);
                        $jam_pulang = date("H:i:s", strtotime("$op $rand minutes", strtotime($jam_pulang)));

                        $data_insert = array('id_pegawai' => $id_pegawai, 'tanggal' => $tanggal, 'jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang, 'flag' => 'H');
                        $data_insert['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk);
                        $data_insert['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang);
                        $data_insert['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang);
                        $in = $this->db->insert('absen_log', $data_insert);

                        // echo $id_pegawai;die;

                        //Hapus Tanpa Keterangan
                        $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
                        $koreksied++;
                    }
                }
                echo "[$k] $id_pegawai $p->nama_lengkap - TK : $ctk, Koreksi : $koreksied \n";
                // die;
            }

            $this->db->where('jam_pulang is null');
            $this->db->where('MONTH(tanggal)', $bulan);
            $this->db->where('YEAR(tanggal)', $tahun);
            $this->db->where('id_pegawai', $id_pegawai);
            $tap = $this->db->get('absen_log')->result();
            $ctap = count($tap);

            if ($ctap > 0) {
                foreach ($tap as $t) {
                    $tanggal = $t->tanggal;
                    $lop = array('-', '+', '+', '+');
                    $op = $lop[rand(0, 3)];
                    $rand = rand(0, 20);
                    $jam_pulang = date("H:i:s", strtotime("$op $rand minutes", strtotime($jam_pulang)));
                    $data_update = array('jam_pulang' => $jam_pulang, 'flag' => 'H');
                    $data_update['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $t->jam_masuk, $jam_pulang);
                    $up = $this->db->update('absen_log', $data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
                }

                echo "[$k] $id_pegawai $p->nama_lengkap - TAP : $ctap \n";
            }

            $param = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
            );
            $this->Tpp_model->simpan($param);

            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $this->Tpp_model->simpan($param_tap);

            // if ($k > 10) {
            //         break;
            // }
        }
    }

    public function insert_bansos()
    {

        $file = './data/bansos.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        $n = 1;
        foreach ($sheets as $k => $s) {
            $nik = trim($s['BX']);
            $nama_kepala = trim($s['Q']);
            $idbdt = trim($s['B']);
            $ruta6 = trim($s['C']);
            $no_peserta_pbdt = trim($s['D']);
            $no_peserta_pkh = trim($s['L']);
            $no_peserta_pbi = trim($s['N']);
            $id_desa = trim($s['E']) . trim($s['F']) . trim($s['G']) . trim($s['I']);
            $id_kecamatan = trim($s['E']) . trim($s['F']) . trim($s['G']);
            $alamat = trim($s['K']);


            $data = array(
                'nik' => $nik,
                'nama_kepala' => $nama_kepala,
                'idbdt' => $idbdt,
                'ruta6' => $ruta6,
                'no_peserta_pbdt' => $no_peserta_pbdt,
                'no_peserta_pkh' => $no_peserta_pkh,
                'no_peserta_pbi' => $no_peserta_pbi,
                'id_desa' => $id_desa,
                'id_kecamatan' => $id_kecamatan,
                'alamat' => $alamat,
                'status' => 'belum'
            );

            $in = $this->db->insert('penduduk_bansos', $data);
            $id = $this->db->insert_id();

            if ($id) {
                $jenisban = trim($s['BY']);

                $id_bantuans = array();

                if ($jenisban == "BANPROV") {
                    $id_bantuans[] = 1;
                } elseif ($jenisban == "BLT DANA DESA") {
                    $id_bantuans[] = 2;
                } elseif ($jenisban == "BPNT") {
                    $id_bantuans[] = 3;
                } elseif ($jenisban == "BST KEMENSOS") {
                    $id_bantuans[] = 4;
                } elseif ($jenisban == "JPS KABUPATEN SUMEDANG") {
                    $id_bantuans[] = 5;
                } elseif ($jenisban == "PKH") {
                    $id_bantuans[] = 6;
                } elseif ($jenisban == "PKH DAN BPNT") {
                    $id_bantuans[] = 3;
                    $id_bantuans[] = 6;
                }

                if (!empty($id_bantuans)) {
                    foreach ($id_bantuans as $id_bantuan) {
                        $this->db->insert('penduduk_bansos_detail', array('id_penduduk_bansos' => $id, 'id_ref_bansos' => $id_bantuan));
                    }
                }
            }
        }

        echo "[$n] $data[nik] \n";

        $n++;
    }

    public function add_sub_office()
    {

        $uptd = $this->db->get_where('ref_skpd', array('jenis_skpd' => 'uptd'))->result();
        foreach ($uptd as $u) {
            $pegawai = $this->db->get_where('pegawai', array('id_skpd' => $u->id_skpd))->num_rows();
            if ($pegawai < 1) {
                // echo $u->nama_skpd." : $u->latitude, $u->longitude<br>";
                $latitude = !empty($u->latitude) ? $u->latitude : 0;
                $longitude = !empty($u->longitude) ? $u->longitude : 0;
                $check = $this->db->get_where('ref_skpd_sub', array('nama_sub' => $u->nama_skpd, 'id_skpd' => $u->id_skpd_induk))->row();
                if (!$check) {
                    $this->db->insert('ref_skpd_sub', array('nama_sub' => $u->nama_skpd, 'id_skpd' => $u->id_skpd_induk, 'latitude' => $latitude, 'longitude' => $longitude));
                    echo $u->nama_skpd . "<br>";
                    // die;
                }
            }
        }
    }

    public function cek_ttd_hilang()
    {
        $tanggal = "2021-01-15";

        // $this->db->where('id_surat_keluar',17593)
        $surat = $this->db->get_where('surat_keluar', array('tgl_ttd' => $tanggal, 'status_ttd' => 'sudah_ditandatangani'))->result();

        $n = 1;
        foreach ($surat as $s) {
            $path = "./data/surat_$s->jenis_surat/ttd/" . $s->file_ttd;
            if (!file_exists($path)) {
                $this->db->update('surat_keluar', array('tgl_ttd' => NULL, 'status_ttd' => 'menunggu_verifikasi', 'file_ttd' => NULL), array('id_surat_keluar' => $s->id_surat_keluar));
                echo "$path\n";
            }
            $n++;
        }
    }

    public function fix_surat_keupdate()
    {
        $lama = $this->load->database('lama', TRUE);
        $surat_lama = $lama->get('surat_keluar')->result();
        $surat_baru = $this->db->get('surat_keluar')->result();

        foreach ($surat_lama as $k => $s) {

            // if ($s->status_ttd == 'sudah_ditandatangani') {
            $this->db->update('surat_keluar', array(
                'tgl_ttd' => $s->tgl_ttd,
                'status_ttd' => $s->status_ttd,
                'file_ttd' => $s->file_ttd
            ), array('id_surat_keluar' => $s->id_surat_keluar));
            echo "$s->id_surat_keluar \n";

            // if($k==100){
            //         break;

            // }
            // }
        }
    }

    public function pengungsi()
    {

        $file = './data/lokasi.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1], $sheets[2]);
        $data = array();
        $key = 0;

        $list = array();
        $alamat = "";
        $pengungsian = "";
        $zona = "";
        foreach ($sheets as $s) {
            if (!empty(trim($s['B']))) {
                $nama = $s['B'];
                $alamat = $s['C'];
                $pengungsian = $s['I'];
                $zona = $s['H'];
                $list[] = array('nama' => $nama, 'alamat' => $alamat, 'pengungsian' => $pengungsian, 'zona' => $zona);
                if (!empty(trim($s['G']))) {
                    $nama = $s['G'];
                    $list[] = array('nama' => $nama, 'alamat' => $alamat, 'pengungsian' => $pengungsian, 'zona' => $zona);
                }
            }

            if (empty(trim($s['B']))) {
                $nama = $s['G'];
                $list[] = array('nama' => $nama, 'alamat' => $alamat, 'pengungsian' => $pengungsian, 'zona' => $zona);
            }
        }

        echo "<table>";
        foreach ($list as $k => $l) {
            $n = $k + 1;
            echo "
        <tr>
        <td>$n</td>
        <td>$l[nama]</td>
        <td>$l[alamat]</td>
        <td>-</td>
        <td>$l[zona]</td>
        <td>$l[pengungsian]</td>
        </tr>
        ";
        }
        echo "</table>";
    }

    public function test_bebas()
    {
        $bulan = 04;
        $tahun = 2023;
        $this->load->model('absen_model');
        $this->load->model('tpp/Tpp_model');
        $this->db->where('pegawai.bebas_absen', 'Y');
        $this->db->group_start();
        $this->db->or_where('pegawai_posisi.id_skpd', 11);
        $this->db->or_where('ref_skpd.id_skpd_induk', 11);
        $this->db->group_end();
        // $this->db->where('pegawai_posisi.id_pegawai', 2084);
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai_posisi.id_skpd');
        $this->db->join('pegawai', 'pegawai_posisi.id_pegawai = pegawai.id_pegawai');
        $pegawai = $this->db->get('pegawai_posisi')->result();
        // print_r($pegawai);
        // die;
        foreach ($pegawai as $p) {
            $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $tanggal = "$tahun-$bulan-01";
            $tanggal2 = date('Y-m-t', strtotime($tanggal));
            $id_pegawai = $p->id_pegawai;
            echo "$p->nama_lengkap \n";
            while ($tanggal <= $tanggal2) {
                $this->absen_model->insert_absen($id_pegawai, $tanggal);
                $tanggal = date("Y-m-d", strtotime($tanggal . " +1 days"));
            }
            $param = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
            );
            $this->Tpp_model->simpan($param);

            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $this->Tpp_model->simpan($param_tap);
        }
    }

    public function test_absen() //khusus eksekutif
    {

        $pegawais = [1486, 10472, 447];

        $bulan = 03;
        $tahun = 2023;
        $this->load->model('absen_model');
        $this->load->model('tpp/Tpp_model');
        $this->db->group_start();
        foreach ($pegawais as $i) {
            $this->db->or_where('pegawai_posisi.id_pegawai', $i);
        }
        $this->db->group_end();

        // $this->db->where('pegawai.bebas_absen', 'Y');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->join('pegawai', 'pegawai_posisi.id_pegawai = pegawai.id_pegawai');
        $pegawai = $this->db->get('pegawai_posisi')->result();
        // print_r($pegawai);die;
        foreach ($pegawai as $p) {
            $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $tanggal = "$tahun-$bulan-01";
            $tanggal2 = date('Y-m-t', strtotime($tanggal));
            $id_pegawai = $p->id_pegawai;
            echo "$p->nama_lengkap \n";
            while ($tanggal <= $tanggal2) {
                $in = $this->absen_model->insert_absen($id_pegawai, $tanggal, 'all', true);
                $tanggal = date("Y-m-d", strtotime($tanggal . " +1 days"));
            }
            $param = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
            );
            $this->Tpp_model->simpan($param);

            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $this->Tpp_model->simpan($param_tap);
        }
    }


    public function generate_absen($tanggal = '')
    {
        $this->load->model('absen_model');
        $this->load->model('tpp/Tpp_model');
        if ($tanggal !== '') {
            if (validateDate($tanggal, 'Y-m-d')) {
                // $tanggal = '2023-04-26';
                // $this->db->where('id_skpd', 11);
                // $this->db->where('pensiun', 0);
                $this->db->where('bulan', date('m', strtotime($tanggal)));
                $this->db->where('tahun', date('Y', strtotime($tanggal)));
                $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai');
                $pegawai = $this->db->get('pegawai_posisi')->result();
                echo "Tanggal : " . tanggal($tanggal) . "\n";
                $mode = "all";
                // print_r($pegawai);die;
                foreach ($pegawai as $n => $p) {
                    $k = $n + 1;
                    $id_pegawai = $p->id_pegawai;
                    echo "[$k] $p->nama_lengkap \n";

                    //Insert Absen
                    $this->absen_model->insert_absen($id_pegawai, $tanggal, $mode);

                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);


                    //Hapus Tanpa Keterangan
                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);
                    // die;
                }
            } else {
                echo "Format tanggal salah\n";
            }
        } else {
            echo "Tanggal Kosong\n";
        }
    }

    public function apply_bebas_absen($bulan, $tahun)
    {
        $this->db->like('jabatan', 'Pramu Kebersihan');
        $this->db->where('id_skpd', 4);
        $this->db->where('pensiun', 0);
        $pegawai = $this->db->get('pegawai')->result();
        foreach ($pegawai as $k => $p) {
            $no = $k + 1;
            $up = $this->db->update('tpp_log', array('nominal_potongan' => 0), array('id_pegawai' => $p->id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun));
            echo "[$k] $p->nama_lengkap<br>";
            // die;
            // die;
        }
    }

    public function hitung_ulang_absen($bulan, $tahun)
    {
        $this->load->model('absen_model');
        $this->load->model('tpp/Tpp_model');
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        // $this->db->where('pegawai.id_skpd', 18);
        // $this->db->where('absen_log.id_pegawai', 2965);
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai');
        $pegawai = $this->db->get_where('absen_log', array('pegawai.pensiun' => 0))->result();

        $n_pegawai = 0;
        $n_tanggal = 1;

        $last_pegawai = 0;

        // echo count($pegawai);die;

        foreach ($pegawai as $p) {
            $log = array();
            $id_pegawai = $p->id_pegawai;
            $tanggal = $p->tanggal;
            //     $log['tanggal'] = $p->tanggal;
            $log['masuk_telat'] = $this->absen_model->get_masuk_telat($p->id_pegawai, $p->jam_masuk, $tanggal);
            if (!empty($p->jam_pulang)) {
                $log['pulang_cepat'] = $this->absen_model->get_pulang_cepat($p->id_pegawai, $p->jam_pulang, $tanggal);
                $log['waktu_kerja'] = $this->absen_model->get_waktu_kerja($p->id_pegawai, $p->jam_masuk, $p->jam_pulang, $tanggal);
            }
            // if($tanggal=='2022-04-04'){
            // print_r($log);die;
            // }
            $this->db->where("id_log", $p->id_log);
            $this->db->update("absen_log", $log);
            // print_r($log);
            $param = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
            );
            $this->Tpp_model->simpan($param);

            $param_tap = array(
                'id_pegawai' => $id_pegawai,
                'bulan' => date("m", strtotime($tanggal)),
                'tahun' => date("Y", strtotime($tanggal)),
                'id_ket_log' => "A3", //Tidak Absen Pulang
            );
            $this->Tpp_model->simpan($param_tap);

            if ($last_pegawai !== $id_pegawai) {
                $last_pegawai = $id_pegawai;
                $n_tanggal = 1;
                $n_pegawai++;
            }

            echo "[$n_pegawai.$n_tanggal] " . $p->nama_lengkap . " - $p->id_skpd | $log[masuk_telat] - $log[pulang_cepat] - $log[waktu_kerja]\n";
            $n_tanggal++;
            // $n++;

            // if($n==38){
            //     // break;
            // }

        }
    }

    function cc()
    {
        print_r(shell_exec('ls', $val, $err));
    }

    public function move_plt()
    {
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->load->model("laporan_kinerja_harian_model");
        $bulan = 02;
        $tahun = 2023;
        $id_pegawai_asal = 98;
        $id_pegawai_tujuan = 11900;

        $pegawai_tujuan = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai_tujuan))->row();
        $absen_asal = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        $absen_tujuan = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // print_r($absen_tujuan);die;

        echo $pegawai_tujuan->nama_lengkap . "<br>";

        $tanggal_tujuan = array();
        foreach ($absen_tujuan as $kt => $vt) {
            $tanggal_tujuan[] = $vt->tanggal;
        }

        echo "<h4>Absen</h4>";
        foreach ($absen_asal as $k => $v) {
            if (in_array($v->tanggal, $tanggal_tujuan)) {
                continue;
            } else {
                $cek = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal))->row();
                if (!$cek) {
                    $id_pegawai = $id_pegawai_tujuan;
                    $tanggal = $v->tanggal;

                    $data_in = (array) $v;
                    unset($data_in['id_log']);
                    $data_in['id_pegawai'] = $id_pegawai_tujuan;
                    // print_r($data_in);
                    $this->db->insert('absen_log', $data_in);

                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);

                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);

                    echo "[$k]" . $v->tanggal . "<br>";
                }

                // die;
            }

            flush();
            ob_flush();
        }


        echo "<h4>LKH</h4>";
        $lkh_asal = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // $lkh_tujuan = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();

        foreach ($lkh_asal as $k => $v) {
            $cek = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal, 'rincian_kegiatan' => $v->rincian_kegiatan))->row();

            if (!$cek) {
                $data_in = (array) $v;
                unset($data_in['id_laporan_kerja_harian']);
                $data_in['id_pegawai'] = $id_pegawai_tujuan;
                $data_in['id_skpd'] = $pegawai_tujuan->id_skpd;
                $this->laporan_kinerja_harian_model->insert($data_in);
                echo $v->tanggal . "<br>";
                // break;

            }

            flush();
            ob_flush();
        }
        $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai_tujuan, $bulan, $tahun);
    }

    public function test_looping()
    {
        for ($i = 1; $i <= 100; $i++) {
            echo $i . "<br>";
            flush();
            ob_flush();
            sleep(1);
            set_time_limit(0);
        }
    }

    public function test_looping_waktu()
    {
        $start_time = time(); // get starting timestamp
        $end_time = $start_time + 30; // set ending timestamp (30 seconds later)

        while (time() < $end_time) {
            $current_time = time() - $start_time; // calculate current time
            echo "Time elapsed: " . $current_time . " seconds<br>";
            flush(); // flush output to the browser
            sleep(1); // pause for 1 second
        }
    }


    public function fix_grade()
    {
        $this->load->model("tpp/tpp_perhitungan_model");
        $id_pegawai = 3240;
        $get_tpp = $this->tpp_perhitungan_model->get_tpp($id_pegawai);

        print_r($get_tpp);
    }

    public function jafung()
    {
        $file = './data/jafung.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        // unset($sheets[1]);
        $data = array();

        foreach ($sheets as $s) {
            $nip = trim($s['C']);
            $jabatan = trim($s['D']);
            $id_skpd = trim($s['E']);

            $pegawai = $this->db->get_where('pegawai', array('nip' => $nip))->row();
            if ($pegawai) {
                $id_jabatan = '';
                $cek = $this->db->get_where('ref_jabatan_baru', array('nama_jabatan' => $jabatan, 'id_skpd' => $id_skpd))->row();
                if ($cek) {
                    $id_jabatan = $cek->id_jabatan;
                } else {
                    $data_in = array('id_unit_kerja' => 0, 'id_skpd' => $id_skpd, 'jenis_jabatan' => 'Fungsional', 'nama_jabatan' => $jabatan, 'grade' => 0, 'tpp' => 0);
                    $this->db->insert('ref_jabatan_baru', $data_in);
                    $id_jabatan = $this->db->insert_id();
                }
                $data_update = array('id_jabatan' => $id_jabatan, 'jabatan' => $jabatan, 'id_skpd' => $id_skpd, 'id_unit_kerja' => 0);
                $this->db->update('pegawai', $data_update, array('id_pegawai' => $pegawai->id_pegawai));
                echo $nip . " - " . $pegawai->id_pegawai . " - $id_jabatan<br>";
                // die;

            }
        }
    }

    public function fix_terlambat()
    {
        $this->load->model('absen_model');
        $this->load->model("tpp/Tpp_model");
        $id_pegawai = 10301;
        $bulan = 04;
        $tahun = 2021;
        $absen_log = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        foreach ($absen_log as $k => $l) {
            $tanggal = $l->tanggal;
            $jam_masuk = $l->jam_masuk;
            $jam_pulang = $l->jam_pulang;
            $data_update = array('jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang, 'flag' => 'H');
            $data_update['masuk_telat'] = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk);
            $data_update['pulang_cepat'] = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang);
            $data_update['waktu_kerja'] = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang);
            $up = $this->db->update('absen_log', $data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));
            // break;
        }
        $param = array(
            'id_pegawai' => $id_pegawai,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
        );
        $this->Tpp_model->simpan($param);

        $param_tap = array(
            'id_pegawai' => $id_pegawai,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_ket_log' => "A3", //Tidak Absen Pulang
        );
        $this->Tpp_model->simpan($param_tap);
    }

    public function fix_ramadhan()
    {
        $this->load->model('absen_model');
        $this->load->model("tpp/Tpp_model");
        $awal = "2021-05-01";
        $akhir = "2021-05-13";
        $this->db->where('MONTH(tanggal)', 5);
        $this->db->where('YEAR(tanggal)', 2021);
        $this->db->where('aktif_shift', 1);
        $this->db->where('pegawai.id_skpd', 4);
        $this->db->join('absen_shift_setting', 'absen_shift_setting.id_pegawai = absen_log.id_pegawai');
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai');
        $get = $this->db->get('absen_log')->result();
        foreach ($get as $n => $g) {
            $id_pegawai = $g->id_pegawai;
            $tanggal = $g->tanggal;

            $jam_masuk = $g->jam_masuk;
            $jam_pulang = $g->jam_pulang;
            if (!empty($jam_masuk) && !empty($jam_pulang)) {
                if ($g->aktif_shift == 1) {
                    if ($tanggal >= $awal && $tanggal <= $akhir) {
                        $masuk = "08:00:00";
                        $pulang = "15:00:00";
                        $hari = date("N", strtotime($g->tanggal));
                        if ($hari == 5) {
                            $pulang = "15:30:00";
                        }
                    } else {
                        $masuk = "07:30:00";
                        $pulang = "16:00:00";

                        $hari = date("N", strtotime($g->tanggal));
                        if ($hari == 5) {
                            $pulang = "16:30:00";
                        }
                    }
                } elseif ($g->aktif_shift == 4) {

                    if ($tanggal >= $awal && $tanggal <= $akhir) {
                        $masuk = "08:00:00";
                        $pulang = "14:45:00";

                        $hari = date("N", strtotime($g->tanggal));
                        if ($hari == 5) {
                            $pulang = "11:00:00";
                        } else if ($hari == 6) {
                            $pulang = "12:30:00";
                        }
                    } else {
                        $masuk = "07:30:00";
                        $pulang = "14:00:00";

                        $hari = date("N", strtotime($g->tanggal));
                        if ($hari == 5) {
                            $pulang = "11:00:00";
                        } else if ($hari == 6) {
                            $pulang = "13:00:00";
                        }
                    }
                } else {
                    continue;
                }

                $data_update = array('jam_masuk' => $jam_masuk, 'jam_pulang' => $jam_pulang);
                $masuk_telat = 0;
                $jam_masuk = strtotime($jam_masuk);
                $_jam_masuk = strtotime($masuk);
                if ($jam_masuk > $_jam_masuk) {
                    $masuk_telat = ($jam_masuk - $_jam_masuk) / 60;
                }
                $data_update['masuk_telat'] = $masuk_telat;
                $pulang_cepat = 0;
                $jam_pulang = strtotime($jam_pulang);
                $_jam_pulang = strtotime($pulang);
                if ($jam_pulang < $_jam_pulang) {
                    $pulang_cepat = ($_jam_pulang - $jam_pulang) / 60;
                }

                $data_update['pulang_cepat'] = $pulang_cepat;


                $jam_masuk = ($jam_masuk);
                if ($jam_masuk < strtotime($masuk)) {
                    $jam_masuk = strtotime($masuk);
                }

                $jam_pulang = ($jam_pulang);
                if ($jam_pulang > strtotime($pulang)) {
                    $jam_pulang = strtotime($pulang);
                }


                $waktu_kerja = 0;
                if ($jam_pulang > $jam_masuk) {
                    $waktu_kerja = ($jam_pulang - $jam_masuk);
                } else {
                    $waktu_kerja = (strtotime("23:59:59") - $jam_masuk) + ($jam_pulang - strtotime("00:00:00"));
                }

                $waktu_kerja = ($waktu_kerja / 60);

                $data_update['waktu_kerja'] = $waktu_kerja;

                $up = $this->db->update('absen_log', $data_update, array('tanggal' => $tanggal, 'id_pegawai' => $id_pegawai));

                $param = array(
                    'id_pegawai' => $id_pegawai,
                    'bulan' => date("m", strtotime($g->tanggal)),
                    'tahun' => date("Y", strtotime($g->tanggal)),
                    'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                );
                $this->Tpp_model->simpan($param);

                echo "[$n] " . $g->nama_lengkap . " $tanggal\n";
                die;
            }
        }
    }

    public function fix_tap_ramadhan()
    {

        $this->load->model('absen_model');
        $this->load->model("tpp/Tpp_model");
        $awal = "2021-05-01";
        $akhir = "2021-05-13";
        $this->db->where('MONTH(tanggal)', 5);
        $this->db->where('YEAR(tanggal)', 2021);
        $this->db->where('aktif_shift', 4);
        // $this->db->where('id_skpd', 17);
        $this->db->where('jam_pulang is null');
        $this->db->join('absen_shift_setting', 'absen_shift_setting.id_pegawai = absen_log.id_pegawai');
        $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai');
        $get = $this->db->get('absen_log')->result();
        echo count($get);
        die;
        foreach ($get as $k => $g) {
            $this->db->update('absen_log', array('pulang_cepat' => 0, 'waktu_kerja' => 0), array('id_log' => $g->id_log));
            $param = array(
                'id_pegawai' => $g->id_pegawai,
                'bulan' => date("m", strtotime($g->tanggal)),
                'tahun' => date("Y", strtotime($g->tanggal)),
                'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
            );
            $this->Tpp_model->simpan($param);
            echo "[$k]" . $g->nama_lengkap . " " . $g->tanggal . "\n";
        }
    }

    function hitung_ulang_terlambat($bulan = '', $tahun = '')
    {

        $this->load->model('absen_model');
        if (empty($tahun)) {
            $tahun = date('Y');
        }

        if (empty($bulan)) {
            $bulan = date('m');
        }

        // $this->db->where('id_pegawai', 434);
        // $this->db->where('tanggal', '2023-04-13');
        // $this->db->where('id_skpd', 16);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        // $this->db->join('pegawai', 'pegawai.id_pegawai = absen_log.id_pegawai');
        $absen = $this->db->get('absen_log')->result();
        $start = date("Y-m-d H:i:s");
        echo "Bulan : " . $bulan . "\n";
        echo "Tahun : " . $tahun . "\n";
        echo "Jumlah : " . count($absen) . "\n";
        echo "Mulai : " . $start . "\n";
        echo "---------------------------------\n";
        sleep(2);
        foreach ($absen as $n => $a) {
            $no = $n + 1;
            $id_pegawai = $a->id_pegawai;
            $jam_masuk = $a->jam_masuk;
            $jam_pulang = $a->jam_pulang;
            $tanggal = $a->tanggal;
            $id_shift = $a->id_shift;
            $masuk_telat = $this->absen_model->get_masuk_telat($id_pegawai, $jam_masuk, $tanggal, $id_shift);
            $data_update = array('masuk_telat' => $masuk_telat);

            if (empty($jam_pulang)) {
                $data_update['pulang_cepat'] = 0;
                $data_update['waktu_kerja'] = 0;
            } else {
                $pulang_cepat = $this->absen_model->get_pulang_cepat($id_pegawai, $jam_pulang, $tanggal, $id_shift);
                $waktu_kerja = $this->absen_model->get_waktu_kerja($id_pegawai, $jam_masuk, $jam_pulang, $tanggal, $id_shift);
                $data_update['pulang_cepat'] = $pulang_cepat;
                $data_update['waktu_kerja'] = $waktu_kerja;
            }

            $this->db->update('absen_log', $data_update, array('id_log' => $a->id_log));
            echo "[$no] " . $id_pegawai . " : " . $a->tanggal . "\n";
            // break;
        }
        echo "---------------------------------\n";
        $end = date("Y-m-d H:i:s");
        echo "Selesai : " . $end . "\n";
        $total_waktu = strtotime($end) - strtotime($start);
        echo "Total Waktu : " . gmdate('H:i:s', $total_waktu) . " \n";
        echo "---------------------------------\n";
    }

    function searchArray($array, $field, $value)
    {
        foreach ($array as $key => $product) {
            if ($array[$field] === $value)
                return $key;
        }
        return false;
    }

    public function fix_dinsos()
    {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Pegawai.xls");
        $file_1 = './data/dinsos_1.xlsx';
        $load_1 = PHPExcel_IOFactory::load($file_1);
        $dinsos_desa = $load_1->getActiveSheet()->toArray(null, true, true, true);
        $file_2 = './data/dinsos_2.xlsx';
        $load_2 = PHPExcel_IOFactory::load($file_2);
        $dinsos_kabupaten = $load_2->getActiveSheet()->toArray(null, true, true, true);
        unset($dinsos_kabupaten[1], $dinsos_kabupaten[2], $dinsos_desa[1]);
        // print_r($dinsos_kabupaten[3]);
        // print_r($dinsos_desa[2]);
        // die;
        $jumlah_awal = count($dinsos_kabupaten);
        echo "<table>";
        foreach ($dinsos_kabupaten as $k => $d) {
            $nik = $d['B'];
            $cek_array = array_search($nik, array_column($dinsos_desa, 'C'));
            if ($cek_array) {
                // echo "$nik <span style='color:red'>DOUBLE</span><br>";
                // unset($dinsos_kabupaten[$k]);

                // echo $nik."<br>";
                echo "<tr>";
                foreach ($d as $k => $e) {
                    if ($k == "B" || $k == "H" || $k == "I" || $k == "J" || $k == "K") {
                        $e = "'$e";
                    }
                    echo "<td>$e</td>";
                }
                echo "</tr>";
            } else {
                // echo $nik."<br>";
                // echo "<tr>";
                // foreach ($d as $k => $e) {
                //         if ($k == "B" || $k == "H" || $k == "I" || $k == "J" || $k == "K") {
                //                 $e = "'$e";
                //         }
                //         echo "<td>$e</td>";
                // }
                // echo "</tr>";
            }
            // break;
            // flush();
            // ob_flush();
        }
        $jumlah_akhir = count($dinsos_kabupaten);
        echo "</table>";
        // echo "<br>";
        // echo "Jumlah Awal : <b>$jumlah_awal</b> ";
        // echo "Jumlah Akhir : <b>$jumlah_akhir</b> ";
    }

    public function validasi_dinsos()
    {

        $file_1 = './data/dinsos_fix.xlsx';
        $load_1 = PHPExcel_IOFactory::load($file_1);
        $data_dinsos = $load_1->getActiveSheet()->toArray(null, true, true, true);
        unset($data_dinsos[1], $data_dinsos[2]);
        foreach ($data_dinsos as $k => $v) {
            // print_r($v);
            $nik = str_replace("'", "", $v['B']);
            if (!empty($nik)) {
                $nik16 = false;
                $nik0000 = false;

                if (strlen($nik) !== 16) {
                    $nik16 = true;
                }
                if (substr($nik, -4, 4) == 0000) {
                    $nik0000 = true;
                }
                $vnik16 = $nik16 ? " <span style='color:red'>NIK " . strlen($nik) . " digit</span>" : null;
                $vnik0000 = $nik0000 ? " <span style='color:red'>NIK belakang 0000</span>" : null;
                echo $nik . $vnik16 . $vnik0000 . "<br>";
            }
            flush();
            ob_flush();
            // die;
        }
    }


    function curlDisduk($url, $postData = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://124.158.169.179/index.php/api/' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        if (!empty($postData)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        $headers = array();
        $headers[] = 'Accept: */*';
        $headers[] = 'Skey: c630643500720b255abb22e2ab2c31f6';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            die;
        }
        curl_close($ch);
        return json_decode($result);
    }

    public function validasi_dinsos_2()
    {
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data Pegawai.xls");
        $file_2 = './data/dinsos_fix.xlsx';
        $load_2 = PHPExcel_IOFactory::load($file_2);
        $dinsos_kabupaten = $load_2->getActiveSheet()->toArray(null, true, true, true);
        unset($dinsos_kabupaten[1], $dinsos_kabupaten[2]);
        $jumlah_awal = count($dinsos_kabupaten);
        echo "<table>";
        foreach ($dinsos_kabupaten as $k => $d) {
            $nik = str_replace("'", "", $d['B']);
            if (!empty($nik)) {
                // if (trim($d['A']) == "861") {
                $nik16 = false;
                $nik0000 = false;

                if (strlen($nik) !== 16) {
                    $nik16 = true;
                }
                if (substr($nik, -4, 4) == 0000) {
                    $nik0000 = true;
                }


                echo "<tr>";
                foreach ($d as $kk => $e) {
                    $style = '';
                    if ($nik16 || $nik0000) {
                        $style = 'background-color:yellow';
                        if ($kk == "B") {
                            $tnik = substr(trim($nik), 0, 6);
                            $nama_lengkap = trim($d['C']);
                            $url = 'koreksi_nik?nik=' . $tnik . '&nama_lengkap=' . urlencode($nama_lengkap);
                            $cek = $this->curlDisduk($url);
                            // var_dump($cek);
                            if ($cek && $cek->error == false) {
                                $e = "'" . $cek->data;
                                $style = 'background-color:green';
                            }
                        }
                    }
                    echo "<td style='$style'>$e</td>";
                }
                echo "</tr>";
                // }
            }
        }
        $jumlah_akhir = count($dinsos_kabupaten);
        echo "</table>";
    }

    public function input_sicerdas()
    {
        $file = './data/sicerdas.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);

        $id_urusan = 0;
        $id_sub_urusan = 0;
        $id_program = 0;
        $id_kegiatan = 0;
        foreach ($sheets as $k => $v) {
            if (!empty($v['B'])) {
                $bidang = code_string($v['A']);
                $keterangan = $v['B'];
                $ex_keterangan = explode(" ", $keterangan);
                $kode = trim($ex_keterangan[0]);
                unset($ex_keterangan[0]);
                $deskripsi = trim(implode(" ", $ex_keterangan));

                $digit = count(explode(".", $kode));

                if ($digit == 1) {
                    $data_in = ['kode_urusan' => $kode, 'bidang' => $bidang, 'nama_urusan' => $deskripsi];
                    $this->db->insert('sc_ref_urusan', $data_in);
                    $id_urusan = $this->db->insert_id();
                } elseif ($digit == 2) {
                    $data_in = ['kode_sub_urusan' => $kode, 'id_urusan' => $id_urusan, 'nama_sub_urusan' => $deskripsi];
                    $this->db->insert('sc_ref_sub_urusan', $data_in);
                    $id_sub_urusan = $this->db->insert_id();
                } elseif ($digit == 3) {
                    $data_in = ['kode_program' => $kode, 'id_sub_urusan' => $id_sub_urusan, 'id_urusan' => $id_urusan, 'nama_program' => $deskripsi];
                    $this->db->insert('sc_ref_program', $data_in);
                    $id_program = $this->db->insert_id();
                } elseif ($digit == 5) {
                    $data_in = ['kode_kegiatan' => $kode, 'id_sub_urusan' => $id_sub_urusan, 'nama_kegiatan' => $deskripsi, 'id_urusan' => $id_urusan, 'id_program' => $id_program];
                    $this->db->insert('sc_ref_kegiatan', $data_in);
                    $id_kegiatan = $this->db->insert_id();
                } elseif ($digit == 6) {
                    $data_in = ['kode_sub_kegiatan' => $kode, 'id_sub_urusan' => $id_sub_urusan, 'nama_sub_kegiatan' => $deskripsi, 'id_urusan' => $id_urusan, 'id_program' => $id_program, 'id_kegiatan' => $id_kegiatan];
                    $this->db->insert('sc_ref_sub_kegiatan', $data_in);
                }

                echo "[$k] $kode $digit digit - $deskripsi <br>";
            }
        }
    }

    public function update_pegawai_eselon()
    {
        $file = './data/jabatan_agustus.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1]);
        // print_r($sheets);
        $no = 1;
        echo "[";
        foreach ($sheets as $k => $v) {
            $nip = trim($v['B']);
            $nama = trim($v['C']);
            $jabatan = trim($v['H']);
            if (!empty($nip)) {

                $eselon = trim($v['I']);
                $no_eselon = strtolower(explode(".", $eselon)[0]);
                if ($no_eselon == "iii") {
                    // $pegawai = $this->db->get_where('pegawai',['nip'=>$nip])->row();
                    // if($pegawai){

                    // $this->db->update('pegawai', ['eselon' => $eselon], ['nip' => $nip]);
                    echo "\"$nip\",";
                    // }
                    // $no++;
                }
                // die;
            }
        }
        echo "]";
    }


    public function get_tpp_pegawai()
    {
        $bulan = 7;
        $tahun = 2021;
        $this->load->model('tpp/tpp_perhitungan_model');
        // $this->db->limit(1000);
        // $this->db->where('pegawai.id_skpd',16);
        $this->db->join('ref_jabatan_baru as sekarang', 'sekarang.id_jabatan = pegawai.id_jabatan', 'left');
        $this->db->join('ref_jabatan_baru as lama', 'lama.id_jabatan = pegawai.id_jabatan_lama', 'left');
        $this->db->group_start();
        $this->db->where('pegawai.id_skpd !=', 34);
        $this->db->where('pegawai.id_skpd !=', 73);
        $this->db->where('pegawai.id_skpd !=', 400);
        $this->db->where('pegawai.id_jabatan !=', 0);
        $this->db->where('pegawai.id_skpd !=', 0);
        $this->db->group_end();
        // $this->db->not_like('pegawai.jabatan','Plt');
        $this->db->select('pegawai.*,lama.nama_jabatan as nama_jabatan_lama,lama.grade as grade_lama,lama.tpp as tpp_lama,lama.id_skpd as id_skpd_lama, lama.id_unit_kerja as id_unit_kerja_lama,sekarang.nama_jabatan as nama_jabatan_sekarang,sekarang.grade as grade_sekarang,sekarang.tpp as tpp_sekarang,sekarang.id_skpd as id_skpd_sekarang, sekarang.id_unit_kerja as id_unit_kerja_sekarang');
        $pegawai = $this->db->get_where('pegawai', ['pensiun' => 0])->result();
        // echo count($pegawai);

        echo "<table>";

        $skpd = $this->db->get('ref_skpd')->result();
        $list_skpd = array();
        foreach ($skpd as $s) {
            $list_skpd[$s->id_skpd] = $s->nama_skpd;
        }
        $no = 1;
        foreach ($pegawai as $p) {
            $jabatan = !empty($p->nama_jabatan_lama) ? $p->nama_jabatan_lama : $p->nama_jabatan_sekarang;
            $grade = !empty($p->nama_jabatan_lama) ? $p->grade_lama : $p->grade_sekarang;
            $tpp = !empty($p->nama_jabatan_lama) ? $p->tpp_lama : $p->tpp_sekarang;
            $id_skpd = !empty($p->nama_jabatan_lama) ? $p->id_skpd_lama : $p->id_skpd_sekarang;


            $jenis_potongan = ['lkh', 'absen', 'hukdis'];
            $cek_tpp = $this->tpp_perhitungan_model->cek_tidak_dapat_tpp($p->id_pegawai, $bulan, $tahun);
            if ($cek_tpp) {
                $list_potongan = array();
                foreach ($jenis_potongan as $j) {
                    $list_potongan[$j] = 0;
                }
                $hasil_pengurangan = 0;
                $pph21 = 0;
                $dibayar = 0;
            } else {
                $pajak = $this->tpp_perhitungan_model->get_pajak($p->id_pegawai);

                $list_potongan = array();
                foreach ($jenis_potongan as $j) {
                    $list_potongan[$j] = $this->tpp_perhitungan_model->get_potongan_by_jenis($p->id_pegawai, $bulan, $tahun, $j);
                }


                $potongan = $this->tpp_perhitungan_model->get_potongan($p->id_pegawai, $bulan, $tahun);
                if ($potongan) {
                    $potongan = round($potongan->jml_potongan);
                } else {
                    $potongan = 0;
                }
                $hasil_pengurangan = $tpp - $potongan;
                if (isset($_GET['testing'])) {
                    // $potongan = (int) $potongan;
                    // $tpp = (int) $tpp;
                    $hasil_pengurangan = round($tpp - $potongan);
                }

                if (!empty($pajak)) {
                    $pph21 = $hasil_pengurangan * $pajak / 100;
                } else {
                    $pph21 = 0;
                }
                $dibayar = $hasil_pengurangan - $pph21;
            }

            echo "<tr>
        <td>$no</td>
        <td>'$p->nip</td>
        <td>$p->nama_lengkap</td>
        <td>$jabatan</td>
        <td>$grade</td>
        <td>$tpp</td>
        <td>$dibayar</td>
        <td>$list_skpd[$id_skpd]</td>
        </tr>";
            $no++;
            flush();
            ob_flush();
        }

        echo "</table>";
    }

    public function bkn_simpeg()
    {

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://wstraining.bkn.go.id/oauth/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'client_id=sumedangtraining&grant_type=client_credentials',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Origin: http://localhost:20000',
                    'Authorization: Basic ' . base64_encode("sumedangtraining:asdf1234")
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        if ($response) {
            return json_decode($response);
        } else {
            return false;
        }
    }

    public function get_bkd($nip = '')
    {
        $token = $this->bkn_simpeg();
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://wstraining.bkn.go.id/bkn-resources-server/api/pns/data-utama/' . $nip,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Origin: http://localhost:20000',
                    'Authorization: Bearer ' . $token->access_token
                ),
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $data = json_decode($response->data);
        // echo "<pre>";
        print_r($data);
    }

    public function generate_ulang_tpp()
    {
        $bulan = 8;
        $tahun = 2021;

        $this->load->model('tpp/tpp_model');

        $this->db->join('pegawai', 'pegawai.id_pegawai = tpp_log.id_pegawai');
        $this->db->join('ref_jabatan_baru as sekarang', 'sekarang.id_jabatan = pegawai.id_jabatan', 'left');
        $this->db->join('ref_jabatan_baru as lama', 'lama.id_jabatan = pegawai.id_jabatan_lama', 'left');
        $this->db->select('tpp_log.*,pegawai.*,lama.nama_jabatan as nama_jabatan_lama,lama.grade as grade_lama,lama.tpp as tpp_lama,lama.id_skpd as id_skpd_lama, lama.id_unit_kerja as id_unit_kerja_lama,sekarang.nama_jabatan as nama_jabatan_sekarang,sekarang.grade as grade_sekarang,sekarang.tpp as tpp_sekarang,sekarang.id_skpd as id_skpd_sekarang, sekarang.id_unit_kerja as id_unit_kerja_sekarang');
        $get = $this->db->get_where('tpp_log', ['bulan' => $bulan, 'tahun' => $tahun])->result();
        // echo count($get);
        foreach ($get as $p) {
            $nominal_potongan = $p->nominal_potongan;
            $jabatan = !empty($p->nama_jabatan_lama) ? $p->nama_jabatan_lama : $p->nama_jabatan_sekarang;
            $grade = !empty($p->nama_jabatan_lama) ? $p->grade_lama : $p->grade_sekarang;
            $tpp = !empty($p->nama_jabatan_lama) ? $p->tpp_lama : $p->tpp_sekarang;
            $id_skpd = !empty($p->nama_jabatan_lama) ? $p->id_skpd_lama : $p->id_skpd_sekarang;
            $dinamis = ($tpp * 30 / 100);
            $potongan_baru = $dinamis * $p->persen_potongan / 100;
            $this->db->update('tpp_log', ['nominal_potongan' => $potongan_baru], ['id_log' => $p->id_log]);
            echo "$p->nama_lengkap - $p->id_ket_log - $jabatan $tpp $dinamis [$nominal_potongan -> $potongan_baru]<br>";
        }
    }

    public function fix_tpp_double()
    {
        $q = $this->db->query("select id_pegawai, bulan, tahun,id_ket_log, count(*) as jumlah from tpp_log group by id_pegawai, bulan, tahun,id_ket_log having jumlah > 1")->result();
        foreach ($q as $k => $v) {
            $jumlah = $v->jumlah - 1;
            $get = $this->db->limit($jumlah)->get_where('tpp_log', ['id_pegawai' => $v->id_pegawai, 'bulan' => $v->bulan, 'tahun' => $v->tahun, 'id_ket_log' => $v->id_ket_log])->result();
            // print_r($get);die;
            foreach ($get as $g) {
                $this->db->delete('tpp_log', ['id_log' => $g->id_log]);
                echo $g->id_log . "<br>";
            }
            // die;
        }
    }

    public function fix_disdik()
    {
        $get = $this->db->get_where('pegawai', ['id_skpd' => 400])->result();
        foreach ($get as $g) {
            $id_jabatan = $g->id_jabatan;
            if (!empty($id_jabatan)) {
                $this->db->update('ref_jabatan_baru', ['id_skpd' => 400], ['id_jabatan' => $id_jabatan]);
                echo $id_jabatan;
            }
        }
    }

    public function generate_tpp_agustus()
    {
        $this->load->model("tpp/tpp_perhitungan_model");
        $bulan = 8;
        $tahun = 2021;
        $this->db->where('id_skpd !=', 400);
        $this->db->where('id_skpd !=', 0);
        // $this->db->where('id_pegawai',1486);
        $pegawai = $this->db->get_where('pegawai', ['pensiun' => 0])->result();
        foreach ($pegawai as $p) {
            if (!empty($p->id_jabatan_lama)) {
                $jl = $this->db->get_where('ref_jabatan_baru', ['id_jabatan' => $p->id_jabatan_lama])->row();
                $id_skpd = $jl->id_skpd;
                $jabatan = $jl->nama_jabatan;
                $id_jabatan = $jl->id_jabatan;
                $tpp = $jl->tpp;
                $grade = $jl->grade;
            } else {
                $id_skpd = $p->id_skpd;
                $jabatan = $p->jabatan;
                $id_jabatan = $p->id_jabatan;
                $get_tpp = $this->tpp_perhitungan_model->get_tpp($p->id_pegawai);
                // var_dump($get_tpp);
                $tpp = !empty($get_tpp) ? $get_tpp['tpp'] : 0;
                $grade = !empty($get_tpp) ? $get_tpp['grade'] : 0;
            }
            $data_insert = ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai, 'id_skpd' => $id_skpd, 'id_jabatan' => $id_jabatan, 'jabatan' => $jabatan];
            $pajak = $this->tpp_perhitungan_model->get_pajak($p->id_pegawai);
            $data_insert['grade'] = $grade;
            $data_insert['tpp'] = $tpp;
            $data_insert['pph'] = $pajak;

            // print_r($data_insert);die;
            $cek = $this->db->get_where('pegawai_posisi', ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai])->row();
            if (!$cek) {
                $this->db->insert('pegawai_posisi', $data_insert);
                echo "$p->nama_lengkap \n";
            }
            // die;


        }
    }

    public function fix_nominal()
    {
        $this->db->join('pegawai', 'pegawai.id_pegawai = pegawai_posisi.id_pegawai');
        $posisi = $this->db->get_where('pegawai_posisi', ['bulan' => 10, 'tahun' => 2021])->result();
        $no = 1;
        foreach ($posisi as $p) {
            $update_data = ['id_unit_kerja' => $p->id_unit_kerja, 'jenis_jabatan' => $p->jenis_jabatan, 'grade' => $p->grade, 'tpp' => $p->tpp];
            $update = $this->db->update('ref_jabatan_baru', $update_data, ['id_jabatan' => $p->id_jabatan]);
            // print_r($update_data);
            echo "[$no] $p->id_jabatan $p->jabatan\n";
            $no++;
            // die;
        }
    }

    public function statistik_pegawai_skpd()
    {

        $tahun = 2021;
        // $this->db->or_where('id_pegawai', 578);
        // $this->db->or_where('id_pegawai', 10774);
        $this->db->or_where('id_pegawai', 10763);
        $this->db->or_where('id_pegawai', 392);
        $pegawai = $this->db->get_where('pegawai', ['pensiun' => 0])->result();
        echo "<table>
            <tr>
            <td>No.</td>
            <td>NIP</td>
            <td>Nama</td>
            <td>Jabatan</td>
            <td>Buat Surat</td>
            <td>Verifikasi</td>
            <td>Tandatangan</td>
            <td>Disposisi</td>
            </tr>
        ";
        $no = 1;
        foreach ($pegawai as $p) {
            $jml_buat = 0;
            $jml_verifikasi = 0;
            $jml_ttd = 0;
            $jml_disposisi = 0;
            $this->db->where('YEAR(tgl_buat)', $tahun);
            // $this->db->where('id_skpd_pengirim', 21);
            $jml_buat = $this->db->get_where('surat_keluar', ['id_pegawai_input' => $p->id_pegawai])->num_rows();
            $this->db->where('YEAR(tgl_verifikasi)', $tahun);
            // $this->db->where('id_skpd_pengirim', 21);
            $jml_verifikasi1 = $this->db->get_where('surat_keluar', ['id_pegawai_verifikasi' => $p->id_pegawai, 'status_verifikasi' => 'sudah_diverifikasi'])->num_rows();
            $this->db->where('YEAR(tgl_verifikasi)', $tahun);
            $jml_verifikasi2 = $this->db->get_where('surat_keluar_verifikasi', ['id_pegawai_verifikasi' => $p->id_pegawai, 'status_verifikasi' => 'sudah_diverifikasi'])->num_rows();
            $jml_verifikasi = $jml_verifikasi1 + $jml_verifikasi2;
            $this->db->where('YEAR(tgl_ttd)', $tahun);
            // $this->db->where('id_skpd_pengirim', 21);
            $jml_ttd = $this->db->get_where('surat_keluar', ['id_pegawai_ttd' => $p->id_pegawai, 'status_ttd' => 'sudah_ditandatangani'])->num_rows();
            $this->db->where('YEAR(tgl_terima)', $tahun);
            // $this->db->where('id_skpd', 21);
            $jml_disposisi = $this->db->get_where('disposisi_surat_masuk', ['id_pegawai' => $p->id_pegawai])->num_rows();
            echo "
                <tr>
                    <td>$no</td>
                    <td>$p->nip</td>
                    <td>$p->nama_lengkap</td>
                    <td>$p->jabatan</td>
                    <td>$jml_buat</td>
                    <td>$jml_verifikasi</td>
                    <td>$jml_ttd</td>
                    <td>$jml_disposisi</td>
                </tr>
            ";
            $no++;
        }
        echo "</table>";
    }

    public function get_surat_notfound()
    {
        $this->db->or_where('tgl_ttd', '2021-11-24');
        $this->db->or_where('tgl_ttd', '2021-11-23');
        $surat = $this->db->get_where('surat_keluar', ['status_ttd' => 'sudah_ditandatangani'])->result();
        foreach ($surat as $s) {
            $dir = './data/surat_' . $s->jenis_surat . '/ttd/' . $s->file_ttd;
            // echo $dir." ";
            if (!file_exists($dir)) {
                $this->db->update('surat_keluar', ['status_ttd' => 'menunggu_verifikasi', 'tgl_ttd' => NULL, 'file_ttd' => NULL], ['id_surat_keluar' => $s->id_surat_keluar]);
                $this->db->delete('surat_masuk', ['hash_id' => $s->hash_id]);
                echo "$s->id_surat_keluar $s->perihal";
                echo "<br>";
                // die;
            }
        }
    }

    public function register_account()
    {
        $this->db->where('id_user', 0);
        $this->db->where('id_skpd', 30);
        $pegawai = $this->db->get('pegawai')->result();
        foreach ($pegawai as $p) {
            echo $p->nama_lengkap . "<br>";
            // continue;
            $this->load->model('user_model');
            $this->load->model('pegawai_model');
            $id_pegawai = $p->id_pegawai;

            // $this->pegawai_model->id_pegawai = $id_pegawai;
            $detail = $this->pegawai_model->get_by_id($id_pegawai);
            $cek_username = $this->user_model->cek_username($p->nip);
            $cek_user = $this->pegawai_model->cek_user($id_pegawai);

            $_POST['password'] = $p->nip;
            $_POST['c_password'] = $p->nip;

            if (cekForm($_POST) == TRUE) {
                echo json_encode(array("status" => FALSE, "message" => "Masih ada form yang kosong"));
            } elseif ($_POST['password'] !== $_POST['c_password']) {
                echo json_encode(array("status" => FALSE, "message" => "Konfirmasi Password tidak sama"));
            } elseif ($cek_username == FALSE) {
                echo json_encode(array("status" => FALSE, "message" => "Username sudah terdaftar"));
            } elseif ($cek_user) {
                echo json_encode(array("status" => FALSE, "message" => "pegawai ini telah didaftarkan"));
            } else {
                $this->user_model->username = $p->nip;
                $this->user_model->full_name = $detail->nama_lengkap;
                $this->user_model->email = code_string($detail->nama_lengkap) . "@gmail.com";
                $this->user_model->password = $p->nip;
                $this->user_model->phone = "-";
                $this->user_model->user_picture = 'user_default.png';
                $this->user_model->user_status = 'Active';
                $this->user_model->user_level = 2;
                $this->user_model->id_pegawai = $id_pegawai;
                $this->user_model->user_privileges = '';
                $this->user_model->unit_kerja_id = $detail->id_unit_kerja;
                $this->user_model->id_skpd = $detail->id_skpd;
                $insert = $this->user_model->insert();
                $data = array('id_user' => $insert);
                $update = $this->pegawai_model->update($data, $id_pegawai);
                echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function inject_lkh()
    {
        $file = './data/koreksi_lkh_s.xlsx';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        // print_r($sheets);
        unset($sheets[1]);
        $no = 1;
        foreach ($sheets as $s) {
            $id_pegawai = $s['A'];
            $tanggal = $s['B'];
            $rincian = $s['C'];
            $hasil = $s['D'];
            if (!empty($id_pegawai) && !empty($tanggal) && !empty($rincian)) {
                $this->db->or_where('id_pegawai', $id_pegawai);
                $this->db->or_where('nip', $id_pegawai);
                $pegawai = $this->db->get('pegawai')->row();
                if ($pegawai) {
                    $id_skpd = $pegawai->id_skpd;
                    $id_verifikator = $pegawai->id_pegawai_atasan_langsung;
                    if (empty($id_verifikator)) {
                        $v = $this->db
                            ->order_by('id_laporan_kerja_harian', 'desc')
                            ->where('id_pegawai', $pegawai->id_pegawai)
                            ->get('laporan_kerja_harian')->row();
                        $id_verifikator = $v->id_verifikator;
                    }
                    $status_verifikasi = 'sudah_diverifikasi';
                    $data_insert = ['id_pegawai' => $pegawai->id_pegawai, 'tanggal' => $tanggal, 'rincian_kegiatan' => $rincian, 'hasil_kegiatan' => $hasil, 'id_skpd' => $id_skpd, 'id_verifikator' => $id_verifikator, 'status_verifikasi' => $status_verifikasi];
                    $check = $this->db->get_where('laporan_kerja_harian', $data_insert)->num_rows();
                    if ($check == 0) {
                        $in = $this->db->insert('laporan_kerja_harian', $data_insert);
                        $id = $this->db->insert_id();
                        if ($in) {
                            $this->db->insert('laporan_kerja_harian_rating', ['id_laporan_kerja_harian' => $id, 'rating' => 5]);
                            echo "[$no] $pegawai->nama_lengkap - $tanggal <br>";
                            $no++;
                        }
                    }
                } else {
                    echo "<span style='color:red'>$id_pegawai  tidak ditemukan</span><br>";
                }
            }


            flush();
            ob_flush();
        }
    }

    public function tes_get_tpp()
    {
        // $id_pegawai = 1486;
        // $tanggal = '2021-12-03';
        $this->db->where('tanggal_awal >=', '2021-12-01');
        $this->db->where('tanggal_akhir <=', '2021-12-31');
        $this->db->where('id_ket_absen', 'A2');
        // $this->db->where('id_skpd',16);
        $log = $this->db->get('absen_ket_log')->result();
        foreach ($log as $l) {
            $id_pegawai = $l->id_pegawai;
            $tanggal = $l->tanggal_awal;
            $this->load->model('absen_model');
            $this->load->model('tpp/Tpp_model');
            $this->load->model("tpp/tpp_perhitungan_model");
            $tpp = $this->tpp_perhitungan_model->get_tpp($id_pegawai);
            $tk = $this->absen_model->tanpa_keterangan($id_pegawai, $tanggal);
            echo $id_pegawai . " - $tanggal\n";
            flush();
            ob_flush();
            // die;
        }
        // print_r($tk);
    }

    public function register_uptd()
    {
        $id_skpd_induk = 21;
        $sub_office = $this->db->get_where('ref_skpd_sub', ['id_skpd' => $id_skpd_induk])->result();
        // print_r($sub_office);
        // die;
        $no = 1;
        echo "<table>
        <tr>
        <th>No.</th>
        <th>Nama Lengkap</th>
        <th>Jabatan</th>
        <th>SKPD SUB</th>
        <th>Unit Kerja</th>
        <th>SKPD Baru</th>
        <th>Unit Kerja Baru</th>
        </tr>";
        foreach ($sub_office as $s) {

            if ($s->id_ref_skpd_sub != 6) {

                $nama_skpd = $s->nama_sub;

                $cek_skpd = $this->db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd, 'id_skpd_induk' => $id_skpd_induk])->row();
                $id_skpd = '';
                if ($cek_skpd) {
                    $id_skpd = $cek_skpd->id_skpd;
                    $data_update = ['latitude' => $s->latitude, 'longitude' => $s->longitude];
                    $this->db->update('ref_skpd', $data_update, ['id_skpd' => $id_skpd]);
                } else {
                    $data_insert = ['nama_skpd' => strtoupper($nama_skpd), 'id_skpd_induk' => $id_skpd_induk, 'jenis_skpd' => 'uptd', 'logo_skpd' => 'sumedang.png', 'latitude' => $s->latitude, 'longitude' => $s->longitude];
                    $in = $this->db->insert('ref_skpd', $data_insert);
                    if ($in) {
                        $id_skpd = $this->db->insert_id();
                    }
                }

                if ($id_skpd !== '') {
                    $skpd = $this->db->get_where('ref_skpd', ['id_skpd' => $id_skpd])->row();
                    $this->db->join('ref_unit_kerja', 'ref_unit_kerja.id_unit_kerja = pegawai.id_unit_kerja', 'left');
                    $pegawai = $this->db->get_where('pegawai', ['id_ref_skpd_sub' => $s->id_ref_skpd_sub, 'pensiun' => 0])->result();

                    foreach ($pegawai as $p) {
                        $kepala_skpd = NULL;
                        $id_unit_kerja = NULL;
                        if (strpos(strtolower($p->jabatan), 'upt') && $p->jenis_pegawai == 'kepala') {
                            $kepala_skpd = "Y";
                            $id_unit_kerja = NULL;
                        }
                        if (strpos(strtolower($p->jabatan), 'tata usaha') || strpos(strtolower($p->jabatan), 'umum')) {
                            $kepala_skpd = "";
                            $unit_kerja = $this->db->get_where('ref_unit_kerja', ['nama_unit_kerja' => 'Sub Bagian Tata Usaha', 'id_skpd' => $id_skpd])->row();
                            if ($unit_kerja) {
                                $id_unit_kerja = $unit_kerja->id_unit_kerja;
                            } else {
                                $inu = $this->db->insert('ref_unit_kerja', ['id_skpd' => $id_skpd, 'level_unit_kerja' => 1, 'nama_unit_kerja' => 'Sub Bagian Tata Usaha']);
                                if ($inu) {
                                    $id_unit_kerja = $this->db->insert_id();
                                }
                            }
                        }

                        $data_update_pegawai = ['id_skpd' => $id_skpd, 'id_unit_kerja' => $id_unit_kerja, 'id_ref_skpd_sub' => NULL, 'kepala_skpd' => $kepala_skpd];
                        $update_pegawai = $this->db->update('pegawai', $data_update_pegawai, ['id_pegawai' => $p->id_pegawai]);

                        echo "<tr>
                    <td>$no</td>
                    <td>$p->nama_lengkap</td>
                    <td>$p->jabatan</td>
                    <td>$s->nama_sub</td>
                    <td>$p->nama_unit_kerja</td>
                    <td>$skpd->nama_skpd <b>$kepala_skpd</b></td>
                    <td>$id_unit_kerja</td>
                    </tr>";
                        $no++;
                    }
                }
            }
        }
        echo "</table>";

        // print_r($unit_kerja);
        // foreach ($unit_kerja as $k => $v) {

        //     $nama_skpd = $v->nama_unit_kerja;

        //     $cek_skpd = $this->db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd, 'id_skpd_induk' => $id_skpd_induk])->row();
        //     $id_skpd = '';
        //     if ($cek_skpd) {
        //         $id_skpd = $cek_skpd->id_skpd;
        //     } else {
        //         $data_insert = ['nama_skpd'=>$nama_skpd,'id_skpd_induk'=>$id_skpd_induk,'jenis_skpd'=>'uptd','logo_skpd'=>'sumedang.png'];
        //         $in = $this->db->insert('ref_skpd', $data_insert);
        //         if ($in) {
        //             $id_skpd = $this->db->insert_id();
        //         }
        //     }



        //     // $pegawai = 
        //     // $pegawai = $this->db->get_where('pegawai',['id_unit_kerja'=>$v->id_unit_kerja])->result();



        //     // print_r($pegawai);
        // }

        // print_r($unit_kerja);

        // $skpd = $this->db->get_where('ref_skpd',['id_skpd_induk'=>$id_skpd_induk])->result();
        // print_r($skpd);


    }


    public function recover($bulan, $tahun, $id_pegawai_asal, $id_pegawai_tujuan)
    {
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->load->model("laporan_kinerja_harian_model");
        // $bulan = 05;
        // $tahun = 2022;
        // $id_pegawai_asal = 10557;
        // $id_pegawai_tujuan = 10542;

        $pegawai_tujuan = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai_tujuan))->row();
        $absen_asal = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        $absen_tujuan = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // print_r($absen_tujuan);die;

        echo $pegawai_tujuan->nama_lengkap . "<br>";

        $tanggal_tujuan = array();
        foreach ($absen_tujuan as $kt => $vt) {
            $tanggal_tujuan[] = $vt->tanggal;
        }

        echo "<h4>Absen</h4>";
        foreach ($absen_asal as $k => $v) {
            if (in_array($v->tanggal, $tanggal_tujuan)) {
                continue;
            } else {
                $cek = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal))->row();
                if (!$cek) {
                    $id_pegawai = $id_pegawai_tujuan;
                    $tanggal = $v->tanggal;

                    $data_in = (array) $v;
                    unset($data_in['id_log']);
                    $data_in['id_pegawai'] = $id_pegawai_tujuan;
                    // print_r($data_in);
                    $this->db->insert('absen_log', $data_in);

                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);

                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);

                    echo "[$k]" . $v->tanggal . "<br>";
                }

                // die;
            }
            flush();
            ob_flush();
        }



        echo "<h4>LKH</h4>";
        $lkh_asal = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // $lkh_tujuan = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();

        foreach ($lkh_asal as $k => $v) {
            $cek = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal, 'rincian_kegiatan' => $v->rincian_kegiatan))->row();

            if (!$cek) {
                $data_in = (array) $v;
                unset($data_in['id_laporan_kerja_harian']);
                $data_in['id_pegawai'] = $id_pegawai_tujuan;
                $data_in['id_skpd'] = $pegawai_tujuan->id_skpd;
                $this->laporan_kinerja_harian_model->insert($data_in);
                echo $v->tanggal . "<br>";
                // break;

            }

            flush();
            ob_flush();
        }
        $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai_tujuan, $bulan, $tahun);
    }

    public function recover_lkh($bulan, $tahun, $id_pegawai_asal, $id_pegawai_tujuan)
    {
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->load->model("laporan_kinerja_harian_model");
        // $bulan = 05;
        // $tahun = 2022;
        // $id_pegawai_asal = 10557;
        // $id_pegawai_tujuan = 10542;

        $pegawai_tujuan = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai_tujuan))->row();
        $absen_asal = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        $absen_tujuan = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // print_r($absen_tujuan);die;

        echo $pegawai_tujuan->nama_lengkap . "<br>";

        $tanggal_tujuan = array();
        foreach ($absen_tujuan as $kt => $vt) {
            $tanggal_tujuan[] = $vt->tanggal;
        }



        echo "<h4>LKH</h4>";
        $lkh_asal = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // $lkh_tujuan = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();

        foreach ($lkh_asal as $k => $v) {
            $cek = $this->db->get_where('laporan_kerja_harian', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal, 'rincian_kegiatan' => $v->rincian_kegiatan))->row();

            if (!$cek) {
                $data_in = (array) $v;
                unset($data_in['id_laporan_kerja_harian']);
                $data_in['id_pegawai'] = $id_pegawai_tujuan;
                $data_in['id_skpd'] = $pegawai_tujuan->id_skpd;
                $this->laporan_kinerja_harian_model->insert($data_in);
                echo $v->tanggal . "<br>";
                // break;

            }

            flush();
            ob_flush();
        }
        $this->laporan_kinerja_harian_model->hitung_ulang_tpp($id_pegawai_tujuan, $bulan, $tahun);
    }

    public function recover_absen($bulan, $tahun, $id_pegawai_asal, $id_pegawai_tujuan)
    {
        $this->load->model("tpp/Tpp_model");
        $this->load->model("absen_model");
        $this->load->model("laporan_kinerja_harian_model");
        // $bulan = 05;
        // $tahun = 2022;
        // $id_pegawai_asal = 10557;
        // $id_pegawai_tujuan = 10542;

        $pegawai_tujuan = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai_tujuan))->row();
        $absen_asal = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_asal, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        $absen_tujuan = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'MONTH(tanggal)' => $bulan, 'YEAR(tanggal)' => $tahun))->result();
        // print_r($absen_tujuan);die;

        echo $pegawai_tujuan->nama_lengkap . "<br>";

        $tanggal_tujuan = array();
        foreach ($absen_tujuan as $kt => $vt) {
            $tanggal_tujuan[] = $vt->tanggal;
        }

        echo "<h4>Absen</h4>";
        foreach ($absen_asal as $k => $v) {
            if (in_array($v->tanggal, $tanggal_tujuan)) {
                continue;
            } else {
                $cek = $this->db->get_where('absen_log', array('id_pegawai' => $id_pegawai_tujuan, 'tanggal' => $v->tanggal))->row();
                if (!$cek) {
                    $id_pegawai = $id_pegawai_tujuan;
                    $tanggal = $v->tanggal;

                    $data_in = (array) $v;
                    unset($data_in['id_log']);
                    $data_in['id_pegawai'] = $id_pegawai_tujuan;
                    // print_r($data_in);
                    $this->db->insert('absen_log', $data_in);

                    $param = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A1", //Terlambat dan Pulang Cepat
                    );
                    $this->Tpp_model->simpan($param);

                    $param_tap = array(
                        'id_pegawai' => $id_pegawai,
                        'bulan' => date("m", strtotime($tanggal)),
                        'tahun' => date("Y", strtotime($tanggal)),
                        'id_ket_log' => "A3", //Tidak Absen Pulang
                    );
                    $this->Tpp_model->simpan($param_tap);

                    $this->absen_model->delete_tanpa_keterangan($id_pegawai, $tanggal);

                    echo "[$k]" . $v->tanggal . "<br>";
                }

                // die;
            }

            flush();
            ob_flush();
        }
    }

    public function test_looping2()
    {
        // @apache_setenv('no-gzip', 1);
        @set_time_limit(0);
        @ob_end_clean();
        @ob_end_flush();
        @ini_set('output_buffering', 'off');
        @ini_set('zlib.output_compression', false);
        while (@ob_end_flush())
            ;
        @ini_set('implicit_flush', true);
        @ob_implicit_flush(true);


        if (!ob_get_level()) {
            ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
        } else {
            ob_end_clean();
            ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
        }
        for ($i = 0; $i < 10; $i++) {
            //For Nginx we have to reach minimum  buffer size, 
            //so if it is not enough increment output
            echo str_pad($i . '<br>', 1024 + 10, ' ', STR_PAD_RIGHT);
            flush();
            ob_flush();
            sleep(1);
        }
    }


    public function morowali_pegawai()
    {
        $db = $this->load->database('dummy', TRUE);
        $file = './data/morowali.xls';
        $load = PHPExcel_IOFactory::load($file);
        $sheets = $load->getActiveSheet()->toArray(null, true, true, true);
        unset($sheets[1], $sheets[2], $sheets[3], $sheets[4], $sheets[5], $sheets[6], $sheets[7]);
        // print_r($sheets);
        $no = 1;
        foreach ($sheets as $s) {
            $nama_skpd = $s['BE'];
            $nama_skpd_induk = $s['BG'];
            $nama_jabatan = $s['AS'];
            if (!empty($nama_skpd) && !empty($nama_jabatan)) {
                $id_unit_kerja = 0;
                //INSERT SKPD
                if (in_array($nama_skpd_induk, ['PEMDA KAB. MOROWALI UTARA', 'PEMERINTAH DAERAH KABUPATEN MOROWALI UTARA'])) {
                    $cek_skpd = $db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd])->row();
                    if ($cek_skpd) {
                        $id_skpd = $cek_skpd->id_skpd;
                    } else {
                        $in = $db->insert('ref_skpd', ['nama_skpd' => $nama_skpd, 'jenis_skpd' => 'skpd']);
                        $id_skpd = $db->insert_id();
                    }
                } else {
                    $cek_skpd = $db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd_induk])->row();
                    if ($cek_skpd) {
                        $id_skpd = $cek_skpd->id_skpd;
                    } else {
                        $in = $db->insert('ref_skpd', ['nama_skpd' => $nama_skpd_induk, 'jenis_skpd' => 'skpd']);
                        $id_skpd = $db->insert_id();
                    }
                    $cek_unit_kerja = $db->get_where('ref_unit_kerja', ['nama_unit_kerja' => $nama_skpd, 'id_skpd' => $id_skpd])->row();
                    if ($cek_unit_kerja) {
                        $id_unit_kerja = $cek_unit_kerja->id_unit_kerja;
                    } else {
                        $in = $db->insert('ref_unit_kerja', ['nama_unit_kerja' => $nama_skpd, 'level_unit_kerja' => 1, 'id_skpd' => $id_skpd]);
                        $id_unit_kerja = $db->insert_id();
                    }
                }


                //INSERT JABATAN
                $cek_jabatan = $db->get_where('ref_jabatan_baru', ['nama_jabatan' => $nama_jabatan, 'id_skpd' => $id_skpd])->row();
                if ($cek_jabatan) {
                    $id_jabatan = $cek_jabatan->id_jabatan;
                } else {
                    $in = $db->insert('ref_jabatan_baru', ['nama_jabatan' => $nama_jabatan, 'id_skpd' => $id_skpd]);
                    $id_jabatan = $db->insert_id();
                }
                //INSERT PEGAWAI
                $nip = $s['C'];

                $cek_pegawai = $db->get_where('pegawai', ['nip' => $nip])->row();
                if (!$cek_pegawai) {
                    $nama_lengkap = $s['E'];
                    if (!empty($s['F'])) {
                        $gdepan = $s['F'] . ". ";
                    } else {
                        $gdepan = "";
                    }
                    if (!empty($s['G'])) {
                        $gbelakang = ", " . $s['G'];
                    } else {
                        $gbelakang = "";
                    }

                    $nama_lengkap = $gdepan . $nama_lengkap . $gbelakang;
                    $nik = $s['P'];

                    if (strpos(strtolower($nama_jabatan), 'kepala') !== false) {
                        $jenis_pegawai = 'kepala';
                    } else {
                        $jenis_pegawai = 'staff';
                    }

                    $keyword = ['kepala dinas', 'kepala badan', 'kepala upt', 'sekretaris daerah', 'sekretaris dprd', 'camat ', 'inspektur daerah'];
                    $match = (str_replace($keyword, '', strtolower($nama_jabatan)) != strtolower($nama_jabatan));
                    if ($match) {
                        $kepala_skpd = "Y";
                    } else {
                        $kepala_skpd = NULL;
                    }

                    $foto_pegawai = 'user-default.png';

                    $golongan = $s['AL'];

                    $data_in = ['nik' => $nik, 'nip' => $nip, 'nama_lengkap' => $nama_lengkap, 'jenis_pegawai' => $jenis_pegawai, 'id_skpd' => $id_skpd, 'id_jabatan' => $id_jabatan, 'kepala_skpd' => $kepala_skpd, 'golongan' => $golongan, 'jabatan' => $nama_jabatan, 'ttd_cloud' => 'Y', 'id_unit_kerja' => $id_unit_kerja];

                    $db->insert('pegawai', $data_in);
                    echo "[$no] $nip $nama_lengkap\n";
                    // die;
                    $no++;
                }
            }
        }
    }

    public function fix_posisi_pegawai()
    {
        $bulan = 5;
        $tahun = 2022;
        $this->db->order_by('id_pegawai');

        // $this->db->where('id_skpd',6);
        $get = $this->db->get_where('pegawai_posisi', ['bulan' => $bulan, 'tahun' => $tahun])->result();
        $no = 1;
        foreach ($get as $g) {
            $bulan_sebelumnya = $bulan - 1;
            $cek_bulan_sebelumnya = $this->db->get_where('pegawai_posisi', ['id_pegawai' => $g->id_pegawai, 'bulan' => $bulan_sebelumnya, 'tahun' => $tahun])->row();
            echo "Checking $g->id_pegawai.";
            if ($cek_bulan_sebelumnya) {
                if ($g->id_jabatan == $cek_bulan_sebelumnya->id_jabatan) {
                    $bulan_sebelumnya_lagi = $bulan_sebelumnya - 1;
                    $get_bulan_sebelumnya_lagi = $this->db->get_where('pegawai_posisi', ['id_pegawai' => $g->id_pegawai, 'bulan' => $bulan_sebelumnya_lagi, 'tahun' => $tahun])->row();
                    if ($get_bulan_sebelumnya_lagi) {
                        if ($cek_bulan_sebelumnya->id_jabatan !== $get_bulan_sebelumnya_lagi->id_jabatan) {
                            $data_update = $get_bulan_sebelumnya_lagi;
                            unset($data_update->id_pegawai_posisi, $data_update->id_pegawai, $data_update->bulan, $data_update->tahun);
                            // print_r($data_update);
                            $this->db->update('pegawai_posisi', $data_update, ['id_pegawai_posisi' => $cek_bulan_sebelumnya->id_pegawai_posisi]);
                            echo "[$no] $g->id_pegawai $g->id_skpd";
                            $no++;
                            // die;
                        }
                    }
                }
            }
            echo "\n";
        }
    }

    public function verif_lkh_by_id_verifikator($id_verifikator = '', $bulan = '', $tahun = '')
    {
        if ($id_verifikator !== '' && $bulan !== '' && $tahun !== '') {
            $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $this->db->where('id_verifikator', $id_verifikator);
            $this->db->where('MONTH(tanggal)', $bulan);
            $this->db->where('YEAR(tanggal)', $tahun);
            $this->db->where('status_verifikasi', 'belum_diverifikasi');
            $get = $this->db->get('laporan_kerja_harian')->result();
            $n = 1;
            foreach ($get as $g) {
                $up = $this->db->update('laporan_kerja_harian', ['status_verifikasi' => 'sudah_diverifikasi'], ['id_laporan_kerja_harian' => $g->id_laporan_kerja_harian]);
                if ($up) {
                    echo "[$n] $g->id_pegawai $g->tanggal";
                    $in = $this->db->insert('laporan_kerja_harian_rating', ['id_laporan_kerja_harian' => $g->id_laporan_kerja_harian, 'rating' => 5]);
                    if ($in) {
                        echo " Rating 5";
                    }
                    echo "\n";
                }
                $n++;

                flush();
                ob_flush();
            }
        }
    }


    public function verif_lkh_by_id_pegawai($id_pegawai = '', $bulan = '', $tahun = '')
    {
        if ($id_pegawai !== '' && $bulan !== '' && $tahun !== '') {
            $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
            $this->db->where('id_pegawai', $id_pegawai);
            $this->db->where('MONTH(tanggal)', $bulan);
            $this->db->where('YEAR(tanggal)', $tahun);
            $this->db->where('status_verifikasi', 'belum_diverifikasi');
            $get = $this->db->get('laporan_kerja_harian')->result();
            $n = 1;
            echo "Verifikasi LKH $id_pegawai Bulan $bulan Tahun $tahun<br>\n";
            echo "Found " . count($get) . " LKH<br>\n";
            foreach ($get as $g) {
                $up = $this->db->update('laporan_kerja_harian', ['status_verifikasi' => 'sudah_diverifikasi'], ['id_laporan_kerja_harian' => $g->id_laporan_kerja_harian]);
                if ($up) {
                    echo "[$n] $g->id_pegawai $g->tanggal";
                    $in = $this->db->insert('laporan_kerja_harian_rating', ['id_laporan_kerja_harian' => $g->id_laporan_kerja_harian, 'rating' => 5]);
                    if ($in) {
                        echo " Rating 5";
                    }
                    echo "<br>\n";
                }
                $n++;

                flush();
                ob_flush();
            }
        }
    }


    public function convert_guru()
    {
        $this->db->where('unitkerja', 'Dinas Pendidikan');
        $this->db->group_start();
        $this->db->like('nama_jabatan', 'Guru Muda');
        $this->db->or_like('nama_jabatan', 'Guru Madya');
        $this->db->or_like('nama_jabatan', 'Guru Pertama');
        $this->db->or_like('nama_jabatan', 'Guru Utama');
        // $this->db->or_like('nama_jabatan','Pengelola Keuangan SMPN');
        // $this->db->or_like('nama_jabatan','Pengelola Kepegawaian SMPNs');
        $this->db->group_end();
        $data = $this->db->get('pegawai_bkd2')->result();
        // $string_jabatan = ['Guru Madya','Guru Muda','Guru Pertama','Guru Utama','Pengelola Keuangan','Pengelola Kepegawaian'];
        $string_jabatan = ['Guru Madya', 'Guru Muda', 'Guru Pertama', 'Guru Utama'];
        $no = 1;
        echo "Found : " . count($data) . " Data\n\n";
        foreach ($data as $k => $v) {
            echo "[$no]";
            $nama_jabatan = $v->nama_jabatan;

            //replace with blank array of string_jabatan in nama_jabatan
            $nama_skpd = str_replace($string_jabatan, '', $nama_jabatan);

            $nama_jabatan = str_replace($nama_skpd, '', $nama_jabatan);

            //get string Kecamatan to end in nama_skpd
            $kecamatan = preg_replace('/.*Kecamatan/', '', $nama_skpd);
            //remove string Kabupaten Sumedang
            $kecamatan = str_replace('Kabupaten Sumedang', '', $kecamatan);
            //remove all symbol except space
            $kecamatan = preg_replace('/[^A-Za-z0-9 ]/', '', $kecamatan);
            //trim
            $kecamatan = trim($kecamatan);
            if ($kecamatan == 'Ujungjaya') {
                $kecamatan == 'Ujung Jaya';
            }
            //get skpd kecamatan
            $wil_kecamatan = $this->db->get_where('SETUP_KEC', ['NAMA_KEC' => strtoupper($kecamatan), 'NO_PROP' => 32, 'NO_KAB' => 11])->row();
            if ($wil_kecamatan) {
                $id_kecamatan = $wil_kecamatan->NO_PROP . $wil_kecamatan->NO_KAB . $wil_kecamatan->NO_KEC;
            } else {
                $id_kecamatan = NULL;
            }
            //replace with blank from string Kecamatan to end in nama_skpd
            $nama_skpd = trim(preg_replace('/Kecamatan.*/', '', $nama_skpd));
            $cek_skpd = $this->db->get_where('ref_skpd', ['nama_skpd' => $nama_skpd])->row();
            if ($cek_skpd) {
                $id_skpd = $cek_skpd->id_skpd;
            } else {
                echo colorize('yellow', "SKPD $nama_skpd not found") . " insert new SKPD ";
                $data_skpd = [
                    'nama_skpd' => $nama_skpd,
                    'nama_skpd_alias' => $nama_skpd,
                    'jenis_skpd' => 'skpd',
                    // 'id_skpd_induk' => 4,
                    'logo_skpd' => 'sumedang.png'
                ];
                $insert = $this->db->insert('ref_skpd', $data_skpd);
                $id_skpd = $this->db->insert_id();
            }

            $cek_jabatan = $this->db->get_where('ref_jabatan_baru', ['nama_jabatan' => $nama_jabatan, 'id_skpd' => $id_skpd])->row();
            if ($cek_jabatan) {
                $id_jabatan = $cek_jabatan->id_jabatan;
            } else {
                echo colorize('yellow', "Jabatan $nama_jabatan not found") . " insert new Jabatan ";
                $data_jabatan = [
                    'nama_jabatan' => $nama_jabatan,
                    'id_skpd' => $id_skpd,
                    'id_unit_kerja' => 0,
                    'jenis_jabatan' => $v->jenis_jabatan,
                    'grade' => $v->grade,
                    'tpp' => $v->tpp
                ];
                $insert = $this->db->insert('ref_jabatan_baru', $data_jabatan);
                $id_jabatan = $this->db->insert_id();
            }

            $cek_pegawai = $this->db->get_where('pegawai', ['nip' => $v->nip])->row();

            //if pegawai not exist then insert with data nip, nama_lengkap, id_jabatan, id_skpd
            if (!$cek_pegawai) {
                echo colorize('green', "Insert new pegawai $v->nama_lengkap") . " ";
                $data_pegawai = [
                    'nip' => $v->nip,
                    'nama_lengkap' => $v->nama_lengkap,
                    'id_jabatan' => $id_jabatan,
                    'id_skpd' => $id_skpd,
                    'id_unit_kerja' => 0,
                    'jenis_pegawai' => 'staff',
                    'jabatan' => $nama_jabatan,
                    'foto_pegawai' => 'user-default.png',
                    'pangkat' => $v->pangkat,
                    'golongan' => $v->gol,
                    'pendidikan' => $v->pendidikan
                ];
                $insert = $this->db->insert('pegawai', $data_pegawai);
                if ($insert) {
                    $id_pegawai_insert = $this->db->insert_id();
                    $cek_username = $this->db->get_where('user', ['username' => $v->nip])->row();
                    if ($cek_username) {
                        echo colorize('green', "User Found") . ", updating pegawai and user";
                        $this->db->update('pegawai', ['id_user' => $cek_username->user_id], ['id_pegawai' => $id_pegawai_insert]);
                        $this->db->update('user', ['kd_skpd' => $id_skpd, 'id_pegawai' => $id_pegawai_insert, 'full_name' => $v->nama_lengkap], ['user_id' => $cek_username->user_id]);
                    } else {
                        echo colorize('yellow', "User Not Found") . ", insert new user";
                        $data_insert_user = [
                            'username' => $v->nip,
                            'password' => md5($v->nip),
                            'kd_skpd' => $id_skpd,
                            'id_pegawai' => $id_pegawai_insert,
                            'full_name' => $v->nama_lengkap,
                            'user_level' => 2,
                            'user_privileges' => 'default',
                            'user_picture' => 'user_default.png',
                            'reg_date' => date('Y-m-d H:i:s'),
                            'user_status' => 'Active'
                        ];
                        $insert_user = $this->db->insert('user', $data_insert_user);
                    }
                } else {
                    echo $v->nama_lengkap . colorize('red', " gagal diinsert\n");
                }
            } else {
                //if pegawai exist then update with data id_jabatan, id_skpd
                echo colorize('yellow', "Update pegawai $v->nama_lengkap") . " ";
                $data_pegawai = [
                    'id_jabatan' => $id_jabatan,
                    'id_skpd' => $id_skpd,
                    'jabatan' => $nama_jabatan,
                    'pangkat' => $v->pangkat,
                    'golongan' => $v->gol,
                    'pendidikan' => $v->pendidikan,
                    'id_unit_kerja' => 0
                ];
                $this->db->where('nip', $v->nip);
                $update = $this->db->update('pegawai', $data_pegawai);
                if ($update) {
                    $cek_user = $this->db->get_where('user', ['user_id' => $v->id_user])->row();
                    if ($cek_user) {
                        echo colorize('green', "User Found") . ", updating data";
                        $data_user = ['kd_skpd' => $id_skpd, 'full_name' => $v->nama_lengkap];
                        $update_user = $this->db->update('user', $data_user, ['user_id' => $v->id_user]);
                    }
                    echo $v->nama_lengkap . colorize('green', " berhasil diupdate\n");
                } else {
                    echo $v->nama_lengkap . colorize('red', " gagal diupdate\n");
                }
            }
            echo "\n";
            $no++;
            // if($no>=1000){
            //     die;
            // }
        }
    }

    public function test_file()
    {
        $filename = "./data/login_exception.txt";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        $contents = explode("\n", $contents);
        $contents = array_filter($contents);
        $contents = array_map('trim', $contents);
        print_r($contents);
    }

    public function test_curl_file()
    {

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'https://e-office.sumedangkab.go.id//api/surat/kirim',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'unit_pencipta' => '49',
                    'tid' => '32000023011709472311056',
                    'nomor_naskah' => '21/31/221',
                    'kode_klasifikasi' => 'HM',
                    'tanggal' => '2023-03-09',
                    'tujuan' => '["d45d20b61104ffa1158f00798fc03b1c"]',
                    'hal' => 'Testing Kirim Surat',
                    'jenis_naskah' => 'b901819904d04c8b78e2870af6f4fc49',
                    'isi' => 'Testing Isi',
                    'sifat_naskah' => 'b6c2b00e302c61013c6897568b67e1da',
                    'jenis_lampiran' => 'b6c2b00e302c61013c6897568b67e1da',
                    'jumlah_lampiran' => '1',
                    'tembusan' => '["d45d20b61104ffa1158f00798fc03b1c"]',
                    'penandatangan' => 'Khalid',
                    'tempat_penandatangan' => 'Sumedang',
                    'tanggal_persetujuan' => '2023-03-09',
                    'nip_pejabat' => '2000192012031000',
                    'nama_pejabat' => 'Khalid',
                    'jabatan' => 'Progammer',
                    'file' => curl_file_create('./data/surat_eksternal/surat_masuk/surat20230310075646YJM2N2VI_(signed).pdf', 'application/pdf', 'surat_masuk.pdf'),
                    'kode_wilayah' => '3200'
                ),
                CURLOPT_HTTPHEADER => array(
                    'SKey: 1919e7f6a95c15a718109517f77411de'
                ),
            )
        );

        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    public function tid()
    {

        $date = date('YmdHis');
        //3 digit miliseconds
        $milliseconds = round(microtime(true) * 1000);
        $milliseconds = substr($milliseconds, -3);
        $tid = "3211" . $date . "-" . $milliseconds . "-1";
        echo $tid;
    }

    public function azz()
    {
        echo "asd";
    }

    public function get_tpp_all_dinas_per_tahun($tahun = "", $id_skpd = "")
    {
        if ($tahun) {
            if ($id_skpd > 0) {
                $this->db->where('id_skpd', $id_skpd);
            }
            echo "REKAP TAHUN " . $tahun . "\n";
            echo "GET ALL SKPD.. \n";
            $skpd = $this->db->group_start()->where('jenis_skpd', 'skpd')->or_where('jenis_skpd', 'kecamatan')->group_end()->get('ref_skpd')->result();
            echo "FETCHED SKPD : " . count($skpd) . "\n";
            foreach ($skpd as $row) {
                echo "REKAP : " . $row->nama_skpd . "\n";
                for ($i = 1; $i <= 12; $i++) {
                    echo "-- BULAN " . $i . "\n";
                    $this->download_laporan($row->id_skpd, $i, $tahun);
                }
            }
        }
        echo "DONE..\n";
    }

    public function download_laporan($id_skpd = '', $bulan = '', $tahun = '')
    {
        if (empty($id_skpd) || empty($bulan) || empty($tahun)) {
            echo "not oke\n";
            return;
            show_404();
        } else {
            $this->load->model('ref_skpd_model');
            $this->load->model("absen_model");
            $this->load->model("ref_ket_absen_model");
            $this->load->model("master_pegawai_model");
            $this->load->model("tpp/tpp_perhitungan_model");
            $this->load->model("tpp/tpp_model");
            $this->load->model("pegawai_posisi_model");
            $this->load->model("kinerja/Laporan_model", "Laporan_kinerja_model");
            $data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

            $static_data = false;
            echo "-GET PEGAWAI\n";
            $data_posisi = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun);

            if (!empty($data_posisi)) {
                $data['dt_pegawai'] = $data_posisi;
                $static_data = true;
            } else {

                $data['dt_pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd, false, false, false, $bulan, $tahun);
            }

            $data['static_data'] = $static_data;


            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['id_skpd'] = $id_skpd;

            echo "-GET TEMPLATE\n";
            $filename = "Laporan TPP " . $data['detail_skpd']->nama_skpd;
            if (!empty($bulan)) {
                $filename .= " Bulan " . bulan($bulan);
                $data['bulan'] = ($bulan);
            }
            if (!empty($tahun)) {
                $filename .= " Tahun $tahun";
                $data['tahun'] = $tahun;
            }
            $filename .= "_" . time() . ".docx";
            $filename = str_replace(",", "", $filename);
            $filename = str_replace("/", "_", $filename);
            $filename = str_replace(" ", "_", $filename);

            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $phpWord->getCompatibility()->setOoxmlVersion(14);
            $phpWord->getCompatibility()->setOoxmlVersion(15);
            $template_path = './template/tpp.docx';
            $template = $phpWord->loadTemplate($template_path);
            $template->setValue('bulan', strtoupper(bulan($data['bulan'])));
            $template->setValue('tahun', $data['tahun']);
            $template->setValue('nama_skpd', $data['detail_skpd']->nama_skpd);

            $template->cloneRow('n', count($data['dt_pegawai']));
            $total = array('pagu_tpp' => 0, 'besar_tpp' => 0, 'pengurangan' => 0, 'p_lkh' => 0, 'p_absen' => 0, 'p_hukdis' => 0, 'pph21' => 0, 'dibayar' => 0);
            echo "-GENERATE LAPORAN\n";
            foreach ($data['dt_pegawai'] as $k => $row) {

                $jenis_potongan = ['lkh', 'absen', 'hukdis'];
                $cek_tpp = $this->tpp_perhitungan_model->cek_tidak_dapat_tpp($row->id_pegawai, $bulan, $tahun);
                if ($cek_tpp) {
                    $list_potongan = array();
                    foreach ($jenis_potongan as $j) {
                        $list_potongan[$j] = 0;
                    }
                    $tpp = 0;
                    $hasil_pengurangan = 0;
                    $pph21 = 0;
                    $dibayar = 0;
                } else {


                    if ($static_data) {
                        $tpp = $row->tpp;
                        $pajak = $row->pph;
                        $grade = $row->grade;
                    } else {
                        $get_tpp = $this->tpp_perhitungan_model->get_tpp($row->id_pegawai);
                        // var_dump($get_tpp);
                        $tpp = !empty($get_tpp) ? $get_tpp['tpp'] : 0;
                        $pajak = $this->tpp_perhitungan_model->get_pajak($row->id_pegawai);
                        $grade = $get_tpp['grade'];
                    }

                    $list_potongan = array();
                    foreach ($jenis_potongan as $j) {
                        $list_potongan[$j] = $this->tpp_perhitungan_model->get_potongan_by_jenis($row->id_pegawai, $bulan, $tahun, $j);
                    }

                    $potongan = $this->tpp_perhitungan_model->get_potongan($row->id_pegawai, $bulan, $tahun);
                    if ($potongan) {
                        $potongan = round($potongan->jml_potongan);
                    } else {
                        $potongan = 0;
                    }
                    if ($potongan >= $tpp) {
                        $hasil_pengurangan = 0;
                        $pph21 = 0;
                        $dibayar = 0;
                    } else {
                        $hasil_pengurangan = round($tpp - $potongan);

                        if (!empty($pajak)) {
                            $pph21 = $hasil_pengurangan * $pajak / 100;
                        } else {
                            $pph21 = 0;
                        }
                        $dibayar = $hasil_pengurangan - $pph21;
                    }
                }
                $total['pagu_tpp'] += $tpp;
                $total['pengurangan'] += $potongan;
                $total['p_lkh'] += $list_potongan['lkh'];
                $total['p_absen'] += $list_potongan['absen'];
                $total['p_hukdis'] += $list_potongan['hukdis'];
                $total['besar_tpp'] += $hasil_pengurangan;
                $total['pph21'] += $pph21;
                $total['dibayar'] += $dibayar;

                $no = $k + 1;
                $template->setValue('n#' . $no, $no);
                $template->setValue('nip#' . $no, $row->nip);
                $template->setValue('nama_lengkap#' . $no, $row->nama_lengkap);
                $template->setValue('jabatan#' . $no, $row->jabatan);
                $template->setValue('grd#' . $no, $grade);
                $template->setValue('pagu#' . $no, rupiah($tpp));
                $template->setValue('p_lkh#' . $no, rupiah($list_potongan['lkh']));
                $template->setValue('p_absen#' . $no, rupiah($list_potongan['absen']));
                $template->setValue('p_hukdis#' . $no, rupiah($list_potongan['hukdis']));
                $template->setValue('besar_tpp#' . $no, rupiah($hasil_pengurangan));
                $template->setValue('pph#' . $no, rupiah($pph21));
                $template->setValue('dibayar#' . $no, rupiah($dibayar));
                // echo $parser->fromHTML($v->hasil_kegiatan);
            }
            $template->setValue('j_pagu', rupiah($total['pagu_tpp']));
            $template->setValue('j_p_lkh', rupiah($total['p_lkh']));
            $template->setValue('j_p_absen', rupiah($total['p_absen']));
            $template->setValue('j_p_hukdis', rupiah($total['p_hukdis']));
            $template->setValue('j_besar_tpp', rupiah($total['besar_tpp']));
            $template->setValue('j_pph', rupiah($total['pph21']));
            $template->setValue('j_dibayar', rupiah($total['dibayar']));

            ob_clean();
            $dir = './data/laporan_tpp/rekap';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $dir = './data/laporan_tpp/rekap/' . date('Y-m-d');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $template->saveAs($dir . "/" . $filename);
            echo "PATH: " . $dir . "/" . $filename . "\n";
        }
    }


    public function generate_tpp($bulan = '', $tahun = '', $id_skpd = '')
    {

        if (empty($bulan) || empty($tahun)) {
            echo "Bulan dan tahun harus diisi";
            die();
        }

        $this->load->model('ref_skpd_model');
        $bulan = (int) $bulan;
        echo "Generate TPP\n";
        if ($id_skpd == '') {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun\n";
        echo "--------------------------------------\n\n";

        $this->load->model("tpp/tpp_perhitungan_model");
        // $bulan = 02;
        // $tahun = 2021;
        $this->db->where('id_skpd !=', 400);
        $this->db->where('id_skpd !=', 0);

        if ($id_skpd !== '') {
            $this->db->where('id_skpd', $id_skpd);
        }

        $this->db->order_by('nama_lengkap');
        $pegawai = $this->db->get_where('pegawai')->result();
        // print_r(count($pegawai));
        // die;
        $no = 1;
        foreach ($pegawai as $p) {
            $data_insert = ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai, 'id_skpd' => $p->id_skpd, 'id_jabatan' => $p->id_jabatan, 'jabatan' => $p->jabatan];
            $jabatan = $this->db->get_where('ref_jabatan_baru', ['id_jabatan' => $p->id_jabatan])->row();
            if ($jabatan) {
                $tpp = $jabatan->tpp;
                $grade = $jabatan->grade;
                $pajak = $this->tpp_perhitungan_model->get_pajak($p->id_pegawai);
                $data_insert['grade'] = $grade;
                $data_insert['tpp'] = $tpp;
                $data_insert['pph'] = $pajak;
                $cek = $this->db->get_where('pegawai_posisi', ['bulan' => $bulan, 'tahun' => $tahun, 'id_pegawai' => $p->id_pegawai])->row();
                if ($p->pensiun == 0) {
                    if (!$cek) {
                        $this->db->insert('pegawai_posisi', $data_insert);
                        echo "[$no] $p->nama_lengkap [INSERT NEW] \n";
                    } else {
                        if ($cek->lock == "N") {
                            $this->db->update('pegawai_posisi', $data_insert, ['id_pegawai_posisi' => $cek->id_pegawai_posisi]);
                            echo "[$no] $p->nama_lengkap [UPDATE] \n";
                        }
                    }
                } else {
                    if ($cek) {
                        $this->db->delete('pegawai_posisi', ['id_pegawai_posisi' => $cek->id_pegawai_posisi]);
                        echo "[$no] $p->nama_lengkap [PENSIUN] \n";
                    }
                }
                $no++;
            }
            flush();
            ob_flush();
        }
    }


    public function hitung_tk($id_skpd = '', $bulan, $tahun)
    {
        // show error
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        $this->load->model('ref_skpd_model');
        $this->load->model('pegawai_posisi_model');
        $bulan = (int) $bulan;
        $start = date('Y-m-d H:i:s');
        echo "Hitung Tanpa Keterangan \n";
        echo "Start : " . $start . " \n";
        if (empty($id_skpd)) {
            $nama_skpd = 'Semua SKPD';
        } else {
            $skpd = $this->ref_skpd_model->get_by_id($id_skpd);
            $nama_skpd = $skpd->nama_skpd;
        }
        echo "$nama_skpd - " . bulan($bulan) . " $tahun\n";
        echo "--------------------------------------\n\n";
        $this->load->model('Absen_model');
        $pegawai = $this->pegawai_posisi_model->get_posisi($id_skpd, $bulan, $tahun);
        $k = 1;
        // print_r(count($pegawai));die;
        // print_r(($pegawai));die;
        $libur = $this->db->get_where('ref_hari_libur', array('MONTH(tanggal_libur)' => $bulan, 'YEAR(tanggal_libur)' => $tahun))->result();
        foreach ($pegawai as $n => $p) {
            // if ($n < 7684) {
            //     continue;
            // }
            if ($p->id_skpd == 400) {
                continue;
            }
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            // var_dump($jml_hari);die;
            echo "[$n] Checking $p->nama_lengkap .. ";
            $tk = 0;
            for ($tanggal = 1; $tanggal <= $jml_hari; $tanggal++) {
                $t = str_pad($tanggal, 2, '0', STR_PAD_LEFT);
                $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);
                $tanggal_absen = "$tahun-$bulan-$t";
                $shift_setting = $this->db->get_where('absen_shift_setting', array('id_pegawai' => $p->id_pegawai))->row();
                if (!$shift_setting) {
                    $id_shift = 1;
                } else {
                    $id_shift = $shift_setting->aktif_shift;
                }
                $shift = $this->db->get_where('absen_shift', array('id_shift' => $id_shift))->row();
                $hari = date("N", strtotime($tanggal_absen));
                $fhari = "hari" . $hari;


                if ($id_shift == 12 || $id_shift == 16 || $id_shift == 17 || $id_shift == 13 || $id_shift == 14 || $id_shift == 15) {
                    for ($h = 1; $h <= 6; $h++) {
                        $fh = "hari" . $h;
                        $shift->$fh = "Y";
                    }
                }

                if ($shift->$fhari == "Y") {

                    $tanggal_libur = array();
                    foreach ($libur as $l) {
                        $tanggal_libur[] = $l->tanggal_libur;
                    }

                    $absen = $this->db->get_where('absen_log', array('id_pegawai' => $p->id_pegawai, 'tanggal' => $tanggal_absen))->num_rows();
                    $log = $this->db
                        ->where('absen_ket_log.id_pegawai', $p->id_pegawai)
                        ->where('absen_ket_log_detail.tanggal', $tanggal_absen)
                        ->join('absen_ket_log', 'absen_ket_log.id_ket_log = absen_ket_log_detail.id_ket_log')
                        ->get('absen_ket_log_detail')
                        ->num_rows();
                    if (!in_array($tanggal_absen, $tanggal_libur) && empty($absen) && empty($log)) {
                        //Eksekusi
                        $this->Absen_model->tanpa_keterangan($p->id_pegawai, $tanggal_absen);
                        // echo $tanggal_absen;

                        // echo "<span style='color:red'>" . tanggal_hari($tanggal_absen) . "</span> ";
                        echo colorize("red", tanggal_hari($tanggal_absen) . " ");
                        $tk++;
                    }
                }
                flush();
                ob_flush();
            }

            if ($tk == 0) {
                // echo "<span style='color:green'>OK</span> ";
                echo colorize("green", 'OK ');
            }

            echo "\n";
            $k++;
            flush();
            ob_flush();
        }
        $end = date('Y-m-d H:i:s');
        echo "End : " . $end . " \n";
        $execution_time = (strtotime($end) - strtotime($start));
        echo "Execution Time : " . convert_minute($execution_time) . " \n";
    }

    public function peringkat_award()
    {
        $this->load->model("sicerdas/Skpd_model", "Skpd_sicerdas_model");
        $this->load->model("kinerja/Laporan_model");
        $this->db->group_start();
        // $this->db->or_where('jenis_skpd', 'skpd');
        $this->db->or_where('jenis_skpd', 'kecamatan');
        $this->db->group_end();
        // $this->db->where('id_skpd', 3);
        $skpd = $this->db->get_where('ref_skpd')->result();

        $tanggal_awal = '2023-01-01';
        $tanggal_akhir = date('Y-m-d');

        $data_statistik = [];

        $id_skpds = [];
        foreach ($skpd as $s) {
            $id_skpds[] = $s->id_skpd;
        }


        $tahun = 2023;
        $bulan_mulai = 2;
        $bulan_akhir = 4;
        $data_kinerja = [];
        for ($bulan = $bulan_mulai; $bulan <= $bulan_akhir; $bulan++) {
            $param['group_by'] = "skpd";
            $param['tahun'] = $tahun;
            $param['bulan'] = $bulan;
            $summary = $this->Laporan_model->getSummary($param)->result();
            // $data_kinerja[$bulan] = $summary;
            foreach ($summary as $s) {
                $data_kinerja[$s->id_skpd][$bulan] = $s->capaian;
            }
        }

        $data_absen = [];

        $this->db->where('tanggal >=', $tanggal_awal);
        $this->db->where('tanggal <=', $tanggal_akhir);
        $this->db->group_by('pegawai_posisi.id_skpd');
        $this->db->where_in('pegawai_posisi.id_skpd', $id_skpds);
        $this->db->join('pegawai_posisi', 'pegawai_posisi.id_pegawai = absen_log.id_pegawai');
        $this->db->select("id_skpd,count(*) as total_absen, SUM(IF(masuk_telat > 0, 1, 0)) AS jml_masuk_telat, SUM(IF(pulang_cepat > 0, 1, 0)) AS jml_pulang_cepat");
        $absen = $this->db->get('absen_log')->result();

        foreach ($absen as $a) {
            $data_absen[$a->id_skpd] = [
                'total_absen' => $a->total_absen,
                'jml_masuk_telat' => $a->jml_masuk_telat,
                'jml_pulang_cepat' => $a->jml_pulang_cepat,
                'persentase_masuk_telat' => round($a->jml_masuk_telat / $a->total_absen * 100, 2),
                'persentase_pulang_cepat' => round($a->jml_pulang_cepat / $a->total_absen * 100, 2)
            ];


        }

        foreach ($skpd as $k => $s) {
            $statistik_surat = [];
            $this->db->where('tgl_surat >=', $tanggal_awal);
            $this->db->where('tgl_surat <=', $tanggal_akhir);
            $this->db->where('id_skpd_pengirim', $s->id_skpd);
            $this->db->select("COUNT(*) as produksi,SUM(IF(status_ttd = 'sudah_ditandatangani', 1, 0)) AS ttd");
            $surat_keluar = $this->db->get('surat_keluar')->row();

            if ($surat_keluar) {
                $statistik_surat['produksi'] = $surat_keluar->produksi;
                $statistik_surat['ttd'] = $surat_keluar->ttd;
            }



            // $this->db->where('tgl_terima >=', $tanggal_awal);
            // $this->db->where('tgl_terima <=', $tanggal_akhir);
            // $this->db->where('id_skpd', $s->id_skpd);
            // $this->db->select("COUNT(*) as disposisi");
            // $disposisi = $this->db->get('disposisi_surat_masuk')->row();

            // if ($disposisi) {
            //     $statistik_surat['disposisi'] = $disposisi->disposisi;
            // }



            $this->db->where('tgl_input >=', $tanggal_awal);
            $this->db->where('tgl_input <=', $tanggal_akhir);
            $this->db->where('id_skpd_penerima', $s->id_skpd);
            $this->db->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk = surat_masuk.id_surat_masuk', 'left');
            $this->db->group_by('surat_masuk.id_surat_masuk');
            $this->db->select("COUNT(*) as masuk, SUM(IF(id_disposisi_masuk IS NOT NULL, 1, 0)) AS jml_disposisi");
            $surat_masuk = $this->db->get('surat_masuk')->result();
            $jml_disposisi = 0;
            foreach ($surat_masuk as $m) {
                if ($m->jml_disposisi > 0) {
                    $jml_disposisi += 1;
                }
            }

            $statistik_surat['masuk'] = count($surat_masuk);
            $statistik_surat['disposisi'] = $jml_disposisi;


            $statistik_kinerja = [];

            if (isset($data_kinerja[$s->id_skpd])) {
                $statistik_kinerja = $data_kinerja[$s->id_skpd];
            }

            $statistik_absen = [];
            if (isset($data_absen[$s->id_skpd])) {
                $statistik_absen = $data_absen[$s->id_skpd];
            }


            $statistik_skpd = [
                'id_skpd' => $s->id_skpd,
                'nama_skpd' => $s->nama_skpd,
                'statistik_surat' => $statistik_surat,
                'statistik_kinerja' => $statistik_kinerja,
                'statistik_absen' => $statistik_absen
            ];

            $data_statistik[] = $statistik_skpd;


        }

        // print_r($data_statistik);
        // die;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama SKPD')
            ->setCellValue('C1', 'Produksi')
            ->setCellValue('D1', 'TTD')
            ->setCellValue('E1', 'Masuk')
            ->setCellValue('F1', 'Disposisi')
            ->setCellValue('G1', 'Kinerja 2')
            ->setCellValue('H1', 'Kinerja 3')
            ->setCellValue('I1', 'Kinerja 4')
            ->setCellValue('J1', 'Masuk Telat')
            ->setCellValue('K1', 'Pulang Cepat')
            // ->setCellValue('K1', 'Waktu Kerja')
        ;

        $row = 2;
        $no = 1;
        foreach ($data_statistik as $ds) {

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $no)
                ->setCellValue('B' . $row, $ds['nama_skpd'])
                ->setCellValue('C' . $row, $ds['statistik_surat']['produksi'])
                ->setCellValue('D' . $row, $ds['statistik_surat']['ttd'])
                ->setCellValue('E' . $row, $ds['statistik_surat']['masuk'])
                ->setCellValue('F' . $row, $ds['statistik_surat']['disposisi'])
                ->setCellValue('G' . $row, $ds['statistik_kinerja'][2])
                ->setCellValue('H' . $row, $ds['statistik_kinerja'][3])
                ->setCellValue('I' . $row, $ds['statistik_kinerja'][4])
                ->setCellValue('J' . $row, $ds['statistik_absen']['persentase_masuk_telat'])
                ->setCellValue('K' . $row, $ds['statistik_absen']['persentase_pulang_cepat'])
                // ->setCellValue('K' . $row, $ds['statistik_absen']['total_waktu_kerja']);
            ;
            $row++;
            $no++;
        }

        ob_clean();
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function update_tgl_lahir()
    {
        $data_simpeg = curlSimpeg('get_all_orang');
        if ($data_simpeg) {
            $data_simpeg = json_decode($data_simpeg);
            $data_pegawai = $this->db->get('pegawai')->result();

            $no = 1;
            foreach ($data_pegawai as $d) {
                $nip = $d->nip;
                // echo $nip;die;
                // search in data_simpeg by nip column
                $key = array_search($nip, array_column($data_simpeg, 'nip_pns'));
                if ($key !== false) {
                    $tanggal_lahir = $data_simpeg[$key]->tanggal_lahir;
                    if (!empty($tanggal_lahir)) {
                        $update = $this->db->update('pegawai', ['tanggal_lahir' => $tanggal_lahir], ['id_pegawai' => $d->id_pegawai]);
                        if ($update) {
                            echo "[$no] $nip $d->nama_lengkap - $tanggal_lahir \n";
                            $no++;
                            // die;
                        }
                    }
                }
            }


        }
    }

    public function generate_perhitungan_tpp($bulan = '', $tahun = '')
    {
        if (empty($bulan) || empty($tahun)) {
            echo "Bulan dan tahun harus diisi";
            die();
        }
        $this->db->select('jenis, id_pegawai,sum(nominal_potongan) as jml_potongan');
        $this->db->group_by('id_pegawai');
        $this->db->group_by('jenis');
        $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = tpp_log.id_ket_log');
        $potongan = $this->db->get_where('tpp_log', array('bulan' => $bulan, 'tahun' => $tahun))->result();
        $jenis_potongan = ['lkh', 'absen', 'hukdis'];

        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $posisi = $this->db->get('pegawai_posisi')->result();

        $n = 1;
        foreach ($posisi as $p) {
            $total_potongan = 0;
            $list_potongan = array();
            foreach ($jenis_potongan as $j) {
                $list_potongan[$j] = 0;
            }

            foreach ($potongan as $po) {
                if ($po->id_pegawai == $p->id_pegawai) {
                    $list_potongan[$po->jenis] = $po->jml_potongan;
                    $total_potongan += $po->jml_potongan;
                }
            }

            $tpp = $p->tpp;
            $pajak = $p->pph;
            $potongan = $total_potongan;

            $dibayar = ($tpp - $potongan) - (($tpp - $potongan) * $pajak / 100);


            $data_update = array(
                'dibayar' => $dibayar
            );

            foreach ($list_potongan as $k => $lp) {
                $data_update['pengurangan_' . $k] = $lp;
            }

            $update = $this->db->update('pegawai_posisi', $data_update, array('id_pegawai_posisi' => $p->id_pegawai_posisi));

            echo "[$n] $p->id_pegawai $p->id_skpd\n";
            // die;
            $n++;
        }

    }


}