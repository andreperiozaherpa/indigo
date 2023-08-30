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

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name    = $this->user_model->full_name;
        $this->user_level    = $this->user_model->level;

        $this->load->model("absen_model");

        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        if (!$this->user_id) {
            redirect("admin");
        }

        if ($this->user_level !== "Administrator" && !in_array('kepegawaian', $this->user_privileges) && !in_array('op_kepegawaian', $this->user_privileges)) {
            show_404();
        }
    }



    public function index($testing = '')
    {

        $data['title']        = "Presensi - Laporan";
        $data['content']    = "absensi/laporan2";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;


        $this->load->model('ref_skpd_model');
        if (in_array('kepegawaian', $this->user_privileges)) {
            $data['skpd_kepegawaian'] = $this->session->userdata('id_skpd');
            $data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
        } else {
            $data['skpd'] = $this->ref_skpd_model->get_all();
        }
        $id_skpd = $data['skpd'][0]->id_skpd;
        $param = array();

        $bulan = date("m");
        $tahun = date("Y");

        //var_dump( $this->session->userdata("id_pegawai"));


        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("id_skpd")) {
            $id_skpd = $this->input->get("id_skpd", true);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }

        $download = $this->input->get("download");
        if ($download) {
            $this->download2($id_skpd, $bulan, $tahun);
        }

        $download_zip = $this->input->get("download_zip");



        $param['where']['ref_skpd.id_skpd'] = $id_skpd;
        $param['where']['month(tanggal)'] = $bulan;
        $param['where']['year(tanggal)'] = $tahun;

        $data['dt_pegawai'] = $this->absen_model->get_pegawai_new($id_skpd, $bulan, $tahun);

        // $pegawai_absen = array();

        // $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
        // $peg = $this->db->get_where('pegawai', array('pegawai.id_skpd' => $id_skpd, 'pensiun' => 0))->result();

        // foreach ($data['dt_pegawai'] as $d) {
        //     $pegawai_absen[] = $d->id_pegawai;
        // }

        // foreach ($peg as $p) {
        //     if (!in_array($p->id_pegawai, $pegawai_absen)) {
        //         $data['dt_pegawai'][] = (object) array('api_key' => 0, 'nip' => $p->nip, 'id_pegawai' => $p->id_pegawai, 'nama_lengkap' => $p->nama_lengkap, 'nama_skpd' => $p->nama_skpd, 'jumlah' => 0, 'jumlah_tap' => 0, 'total_masuk_telat' => 0, 'total_pulang_cepat' => 0, 'total_waktu_kerja' => 0);
        //     }
        // }



        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['id_skpd'] = $id_skpd;

        if ($download_zip) {
            //die("fitur masih dalam pengerjaan");
            $this->download_zip($data['dt_pegawai'], $bulan, $tahun, $id_skpd);
        }

        if ($testing == 1) {
            echo "<pre>";
            print_r($data['dt_pegawai']);
            die;
        }

        $this->load->view('admin/index', $data);
    }

    

    public function dinas_dalam($testing = '')
    {

        $data['title']        = "Presensi - Laporan";
        $data['content']    = "absensi/laporan_dinas_dalam";
        $data['user_picture'] = $this->user_picture;
        $data['full_name']        = $this->full_name;
        $data['user_level']        = $this->user_level;


        $this->load->model('ref_skpd_model');
        if (in_array('kepegawaian', $this->user_privileges)) {
            $data['skpd_kepegawaian'] = $this->session->userdata('id_skpd');
            $data['skpd'][] = $this->ref_skpd_model->get_by_id($this->session->userdata('id_skpd'));
        } else {
            $data['skpd'] = $this->ref_skpd_model->get_all();
        }
        $param = array();

        $bulan = date("m");
        $tahun = date("Y");



        if ($this->input->get("bulan")) {
            $bulan = $this->input->get("bulan", true);
        }

        if ($this->input->get("tahun")) {
            $tahun = $this->input->get("tahun", true);
        }


        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->db->join('pegawai','pegawai.id_pegawai = absen_log.id_pegawai');
        $get_absen = $this->db->get_where('absen_log',array('MONTH(tanggal)'=>$bulan,'YEAR(tanggal)'=>$tahun))->result();
        $data_rekap = array();

        foreach($get_absen as $k => $v){
            $tanggal = (int) explode('-',$v->tanggal)[2];
            $jenis_absen = empty($v->tempat) ? 'kantor' : code_string($v->tempat);
            if(isset($data_rekap[$v->id_skpd][$tanggal][$jenis_absen])){
                $data_rekap[$v->id_skpd][$tanggal][$jenis_absen] += 1;
            }else{
                $data_rekap[$v->id_skpd][$tanggal][$jenis_absen] = 1;
            }
        }

        $data['data_rekap'] = $data_rekap;

        $this->load->view('admin/index', $data);
    }


    private function download_zip($dt_pegawai, $bulan, $tahun, $id_skpd)
    {
        $filename = "Rekapitulasi Absen";
        if ($id_skpd !== '') {
            $this->load->model('ref_skpd_model');
            $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;
            $filename .= " SKPD " . $nama_skpd;
        }
        if ($bulan !== '') {
            $filename .= " Bulan " . bulan($bulan);
        }
        if ($tahun !== '') {
            $filename .= " Tahun " . $tahun;
        }
        $filedir = './data/' . $filename . '.zip';
        $zip = new ZipArchive;
        //die;

        //echo "<pre>";print_r($dt_pegawai);die;

        $arr_path = array();
        if ($zip->open($filedir, ZipArchive::CREATE) === TRUE) {
            foreach ($dt_pegawai as $row) {

                $user = $this->user_model->checkApiKey($row->api_key);

                if ($user && $row->api_key != null) {
                    $param = array();
                    $param['where']['id_pegawai'] = $user->id_pegawai;
                    $param['where']['month(tanggal)'] = $bulan;
                    $param['where']['year(tanggal)'] = $tahun;


                    $dt_log = $this->absen_model->get_log($param)->result();

                    $bulan = date("M", strtotime(date("Y") . "-" . $bulan . "-01"));

                    $this->load->library('pdf');

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                    $pdf->setPrintFooter(false);
                    $pdf->setPrintHeader(false);
                    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                    $pdf->AddPage('P');
                    $pdf->Write(0, 'REKAPITULASI ABSEN', '', 0, 'C', true, 0, false, false, 0);
                    $filename = "Rekapitulasi Absen " . $user->full_name . " Bulan " . $bulan . " Tahun " . $tahun;

                    $pdf->Write(0, 'NAMA : ' . $user->full_name, '', 0, 'C', true, 0, false, false, 0);
                    $pdf->Write(0, strtoupper($bulan) . ' ' . $tahun, '', 0, 'C', true, 0, false, false, 0);


                    $pdf->SetFont('');


                    $content = '
                    <br><br>
                    <table class="table" border="1" width="100%">
                        <thead>
                            <tr>
                                <th width="5%" align="center" valign="center">No</th>
                                <th width="15%" align="center">Tanggal</th>
                                <th width="15%" align="center">Jam Masuk</th>
                                <th width="15%" align="center">Jam Pulang</th>
                                <th width="25%" align="center">Koordinat masuk</th>
                                <th width="25%" align="center">Koordinat pulang</th>
                            </tr>
                        </thead>
                    <tbody>';

                    $no = 1;
                    foreach ($dt_log  as $row) {
                        $content .= '
                        <tr class="odd">
                            <td width="5%" align="center">' . $no . '</td>
                            <td width="15%" align="center">' . date("d/m/Y", strtotime($row->tanggal)) . '</td>
                            <td width="15%" align="center">' . $row->jam_masuk . '</td>
                            <td width="15%" align="center">' . $row->jam_pulang . '</td>
                            <td width="25%" align="center">Lat: ' . $row->latitude_masuk . '
                                <br>Lng: ' . $row->longitude_masuk . '
                            </td>
                            <td width="25%" align="center">Lat: ' . $row->latitude_pulang . '
                                <br>Lng: ' . $row->longitude_pulang . '
                            </td>

                        </tr>
                        ';
                        $no++;
                    }

                    $content .= '</tobdy></table>';

                    $filename = str_replace(",", "", $filename);
                    // $filename = str_replace(".","", $filename);
                    $filename = str_replace(" ", "_", $filename);
                    $filename = str_replace("/", "_", $filename);

                    $pdf->writeHTML($content);

                    $path = FCPATH . "data/" . $filename . ".pdf";
                    $arr_path[] = $path;

                    ob_clean();
                    $pdf->Output($path, 'F');

                    $zip->addFile($path, $filename . ".pdf");
                }
            }
            ob_clean();
            $zip->close();
            foreach ($arr_path as $f) {
                unlink($f);
            }
            // die;
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($filedir) . '"');
            header('Content-Length: ' . filesize($filedir));

            flush();
            readfile($filedir);
            // delete file
            unlink($filedir);
        }
    }

    private function download($id_skpd, $bulan, $tahun)
    {
        $param['where']['ref_skpd.id_skpd'] = $id_skpd;
        $param['where']['month(tanggal)'] = $bulan;
        $param['where']['year(tanggal)'] = $tahun;
        $dt_pegawai = $this->absen_model->get_pegawai($param)->result();

        $bulan = date("M", strtotime(date("Y") . "-" . $bulan . "-01"));

        $this->load->library('pdf');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('P');
        $pdf->Write(0, 'REKAPITULASI ABSEN', '', 0, 'C', true, 0, false, false, 0);
        $filename = "Rekapitulasi Absen Bulan " . $bulan . " Tahun " . $tahun;

        $this->load->model('ref_skpd_model');
        $nama_skpd = $this->ref_skpd_model->get_by_id($id_skpd)->nama_skpd;


        $pdf->Write(0, 'SKPD : ' . $nama_skpd, '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, strtoupper($bulan) . ' ' . $tahun, '', 0, 'C', true, 0, false, false, 0);


        $pdf->SetFont('');


        $content = '
                <br><br>
                <table class="table" border="1" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" align="center" valign="center">No</th>
                            <th width="20%" align="center">NIP</th>
                            <th width="30%" align="center">Nama</th>
                            <th width="10%" align="center">Jumlah Hari</th>
                            <th width="10%" align="center">Total Masuk Telat</th>
                            <th width="10%" align="center">Total Pulang Cepat</th>
                            <th width="15%" align="center">Total Waktu Kerja</th>
                        </tr>
                    </thead>
                <tbody>';

        $no = 1;
        foreach ($dt_pegawai  as $row) {
            $content .= '
                    <tr class="odd">
                        <td width="5%" align="center">' . $no . '</td>
                        <td width="20%" align="center">' . $row->nip . '</td>
                        <td width="30%" align="left">' . $row->nama_lengkap . '</td>
                        <td width="10%" align="center">' . $row->jumlah . '</td>
                        <td width="10%" align="center">' . number_format($row->total_masuk_telat) . ' menit</td>
                        <td width="10%" align="center">' . number_format($row->total_pulang_cepat) . ' menit</td>
                        <td width="15%" align="center">' . floor($row->total_waktu_kerja / 60) . ' jam ' . $row->total_waktu_kerja % 60 . ' menit' . '</td>
                    </tr>
                    ';
            $no++;
        }

        $content .= '</tobdy></table>';

        $pdf->writeHTML($content);
        ob_end_clean();
        $pdf->Output($filename . '.pdf', 'D');
    }


    private function download2($id_skpd = '', $bulan = '', $tahun = '')
    {
        // $this->benchmark->mark('code_start');
        if (empty($id_skpd) || empty($bulan) || empty($tahun)) {
            show_404();
        } else {
            ini_set('max_execution_time', '300');
            $param['where']['ref_skpd.id_skpd'] = $id_skpd;
            $param['where']['month(tanggal)'] = $bulan;
            $param['where']['year(tanggal)'] = $tahun;
            $data['dt_pegawai'] = $this->absen_model->get_pegawai_new($id_skpd, $bulan, $tahun);

            // print_r($data['dt_pegawai']);die;
            // $pegawai_absen = array();

            // $this->db->join('ref_skpd', 'ref_skpd.id_skpd = pegawai.id_skpd');
            // $peg = $this->db->get_where('pegawai', array('pegawai.id_skpd' => $id_skpd, 'pensiun' => 0))->result();

            // foreach ($data['dt_pegawai'] as $d) {
            //     $pegawai_absen[] = $d->id_pegawai;
            // }

            // foreach ($peg as $p) {
            //     if (!in_array($p->id_pegawai, $pegawai_absen)) {
            //         $data['dt_pegawai'][] = (object) array('api_key' => 0, 'nip' => $p->nip, 'id_pegawai' => $p->id_pegawai, 'nama_lengkap' => $p->nama_lengkap, 'nama_skpd' => $p->nama_skpd, 'jumlah' => 0, 'jumlah_tap' => 0, 'total_masuk_telat' => 0, 'total_pulang_cepat' => 0, 'total_waktu_kerja' => 0);
            //     }
            // }
            $this->load->model('ref_skpd_model');
            $data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;

            $filename = "Rekapitulasi Absen Bulan " . bulan($bulan) . " Tahun " . $tahun . ".docx";
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $phpWord->getCompatibility()->setOoxmlVersion(14);
            $phpWord->getCompatibility()->setOoxmlVersion(15);
            $template_path = './template/absen.docx';
            $template = $phpWord->loadTemplate($template_path);
            $template->setValue('bulan', strtoupper(bulan($data['bulan'])));
            $template->setValue('tahun', $data['tahun']);
            $template->setValue('nama_skpd', $data['detail_skpd']->nama_skpd);

            $template->cloneRow('n', count($data['dt_pegawai']));
            foreach ($data['dt_pegawai'] as $k => $row) {
                $ket_log = ['sakit', 'cuti', 'tk', 'dd', 'dl', 'im', 'wfh', 'mpp'];

                $no = $k + 1;
                $template->setValue('n#' . $no, $no);
                $template->setValue('nip#' . $no, $row->nip);
                $template->setValue('nama_lengkap#' . $no, $row->nama_lengkap);
                $template->setValue('h#' . $no, $row->hadir);
                $template->setValue('tap#' . $no, $row->tap);
                foreach ($ket_log as $log) {
                    $template->setValue($log . '#' . $no, $row->$log);
                }
                $template->setValue('t_masuk_telat#' . $no, convert_minute($row->masuk_telat));
                $template->setValue('t_pulang_cepat#' . $no, convert_minute($row->pulang_cepat));
                // echo $parser->fromHTML($v->hasil_kegiatan);
            }

            ob_clean();
            $template->saveAs("./data/laporan_tpp/" . $filename);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize("./data/laporan_tpp/" . $filename));
            flush();
            readfile("./data/laporan_tpp/" . $filename);
            unlink("./data/laporan_tpp/" . $filename);
        }
        // $this->benchmark->mark('code_end');

        // echo $this->benchmark->elapsed_time('code_start', 'code_end');
    }


    public function download_rekapitulasi_pegawai($api_key = null, $bulan = null, $tahun = null)
    {
        if ($api_key && $bulan && $tahun) {

            $user = $this->user_model->checkApiKey($api_key);
            /*
            $url = "http://localhost/absensi/rekapitulasi/generate_download/$bulan/$tahun/$user->api_key";
            $path = "data/absen/rekapitulasi/".$user->api_key.".pdf";
            exec("xvfb-run -a wkhtmltopdf $url ".FCPATH."$path");
            redirect($path);
            */


            if ($user) {
                $param = array();
                $param['where']['id_pegawai'] = $user->id_pegawai;
                $param['where']['month(tanggal)'] = $bulan;
                $param['where']['year(tanggal)'] = $tahun;


                $dt_log = $this->absen_model->get_log($param)->result();

                $bulan = date("M", strtotime(date("Y") . "-" . $bulan . "-01"));

                $this->load->library('pdf');

                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->setPrintFooter(false);
                $pdf->setPrintHeader(false);
                $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                $pdf->AddPage('P');
                $pdf->Write(0, 'REKAPITULASI ABSEN', '', 0, 'C', true, 0, false, false, 0);
                $filename = "Rekapitulasi Absen " . $user->full_name . " Bulan " . $bulan . " Tahun " . $tahun;

                $pdf->Write(0, 'NAMA : ' . $user->full_name, '', 0, 'C', true, 0, false, false, 0);
                $pdf->Write(0, strtoupper($bulan) . ' ' . $tahun, '', 0, 'C', true, 0, false, false, 0);


                $pdf->SetFont('');


                $content = '
                <br><br>
                <table class="table" border="1" width="100%">
                    <thead>
                        <tr>
                            <th width="5%" align="center" valign="center">No</th>
                            <th width="15%" align="center">Tanggal</th>
                            <th width="15%" align="center">Jam Masuk</th>
                            <th width="15%" align="center">Jam Pulang</th>
                        </tr>
                    </thead>
                <tbody>';

                $no = 1;
                foreach ($dt_log  as $row) {
                    $content .= '
                    <tr class="odd">
                        <td width="5%" align="center">' . $no . '</td>
                        <td width="15%" align="center">' . date("d/m/Y", strtotime($row->tanggal)) . '</td>
                        <td width="15%" align="center">' . $row->jam_masuk . '</td>
                        <td width="15%" align="center">' . $row->jam_pulang . '</td>

                    </tr>
                    ';
                    $no++;
                }

                $content .= '</tobdy></table>';

                $pdf->writeHTML($content);
                ob_end_clean();
                $pdf->Output($filename . '.pdf', 'D');
            } else {
                show_404();
            }
        }
    }

    public function testing()
    {


        $this->db->select(
            "user.api_key,pegawai.id_pegawai,pegawai.nip,pegawai.nama_lengkap,
        (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NOT NULL AND jam_masuk IS NOT NULL ) as hadir,
        (SELECT COUNT(absen_log.id_log) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun AND jam_pulang IS NULL AND jam_masuk IS NOT NULL ) as tap,
        (SELECT sum(masuk_telat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun ) as masuk_telat,
        (SELECT sum(pulang_cepat) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as pulang_cepat,
        (SELECT sum(waktu_kerja) FROM absen_log WHERE absen_log.id_pegawai = pegawai.id_pegawai AND MONTH(absen_log.tanggal) = $bulan AND YEAR(absen_log.tanggal) = $tahun) as waktu_kerja
        "
        );
        $this->db->join('user', 'user.id_pegawai = pegawai.id_pegawai');
        $pegawai = $this->db->get_where('pegawai', array('id_skpd' => $id_skpd, 'pensiun' => 0))->result();


        $this->db->where('MONTH(tanggal_awal)', $bulan);
        $this->db->where('YEAR(tanggal_awal)', $tahun);
        $this->db->where('id_skpd', $id_skpd);
        $this->db->join('ref_ket_absen', 'ref_ket_absen.id_ket_absen = absen_ket_log.id_ket_absen');
        $log =  $this->db->get('absen_ket_log')->result();

        foreach ($pegawai as $k => $p) {
            $ket_log = ['sakit', 'cuti', 'tk', 'dd', 'dl', 'im', 'wfh', 'mpp'];
            foreach ($ket_log as $l) {
                $pegawai[$k]->$l = 0;
                foreach ($log as $lo) {
                    if ($lo->id_pegawai == $p->id_pegawai && $lo->group_ket == $l) {
                        $pegawai[$k]->$l += $lo->jumlah;
                    }
                }
            }
        }
    }
}
