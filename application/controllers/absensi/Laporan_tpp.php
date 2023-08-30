<?php
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

class Laporan_tpp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('user_model');
        $this->user_model->user_id = $this->user_id;
        $this->user_model->set_user_by_user_id();
        $this->user_picture = $this->user_model->user_picture;
        $this->full_name = $this->user_model->full_name;
        $this->user_level = $this->user_model->level;

        $this->load->model("absen_model");
        $this->load->model("ref_ket_absen_model");
        $this->load->model("master_pegawai_model");
        $this->load->model("tpp/tpp_perhitungan_model");
        $this->load->model("tpp/tpp_model");
        $this->load->model("pegawai_posisi_model");
        $this->load->model("kinerja/Laporan_model", "Laporan_kinerja_model");

        $this->user_privileges = explode(";", $this->session->userdata('user_privileges'));

        if (!$this->user_id) {
            redirect("admin");
        }

        if ($this->user_level !== "Administrator" && !in_array('kepegawaian', $this->user_privileges) && !in_array('op_kepegawaian', $this->user_privileges)) {
            show_404();
        }
    }

    public function index()
    {

        $data['title'] = "Laporan TPP Pegawai";
        $data['content'] = "absensi/laporan_tpp";
        $data['user_picture'] = $this->user_picture;
        $data['full_name'] = $this->full_name;
        $data['user_level'] = $this->user_level;


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
            $this->download($id_skpd, $bulan, $tahun);
        }

        $static_data = false;

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

        $data['selected_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);


        $ids = [];
        foreach ($data['dt_pegawai'] as $dp) {
            $ids[] = $dp->id_pegawai;
        }

        // error_reporting(1);

        $param['group_by'] = "ASN";
        $param['str_where'] = "(pegawai.id_pegawai in (" . implode(",", $ids) . ") )";
        $summary = $this->Laporan_kinerja_model->getSummary($param)->result();
        $data['summaryLKH'] = $summary;
        // print_r($summary);
        // die;

        $this->load->view('admin/index', $data);
    }

    public function download($id_skpd = '', $bulan = '', $tahun = '', $testing = '')
    {
        if (empty($id_skpd) || empty($bulan) || empty($tahun)) {
            show_404();
        } else {
            if (isset($_POST['id_pegawai'])) {
                $id_pegawai = $this->session->userdata('id_pegawai');
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
            }
            $this->load->model('ref_skpd_model');
            $data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

            $data['dt_pegawai'] = $this->master_pegawai_model->get_by_id_skpd($id_skpd, false, false, false, $bulan, $tahun);


            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['id_skpd'] = $id_skpd;

            $filename = "Laporan TPP " . $data['detail_skpd']->nama_skpd;
            if (!empty($bulan)) {
                $filename .= " Bulan " . bulan($bulan);
                $data['bulan'] = ($bulan);
            }
            if (!empty($tahun)) {
                $filename .= " Tahun $tahun";
                $data['tahun'] = $tahun;
            }
            $filename .= "_" . time() . ".pdf";
            $filename = str_replace(",", "", $filename);
            // $filename = str_replace(".","", $filename);
            // $filename = str_replace(" ","_", $filename);
            $filename = str_replace("/", "_", $filename);
            $filename = str_replace(" ", "_", $filename);

            $html = $this->load->view('admin/absensi/view_laporan_tpp', $data, TRUE);
            if ($testing == 1) {
                echo $html;
                die;
            }
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser

            $dompdf->stream($filename);
        }
    }
    public function download_laporan($id_skpd = '', $bulan = '', $tahun = '')
    {
        if (empty($id_skpd) || empty($bulan) || empty($tahun)) {
            show_404();
        } else {
            if (isset($_POST['id_pegawai'])) {
                $id_pegawai = $this->session->userdata('id_pegawai');
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
            }
            $this->load->model('ref_skpd_model');
            $data['detail_skpd'] = $this->ref_skpd_model->get_by_id($id_skpd);

            $static_data = false;

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

            $template->saveAs("./data/laporan_tpp/" . $filename);
            ob_clean();
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
    }

    public function get_pengurangan_tpp($id_pegawai = '', $bulan = '', $tahun = '')
    {
        if (!empty($id_pegawai) || !empty($bulan) || !empty($tahun)) {
            $pengurangan = $this->db->get_where('tpp_log', array('id_pegawai' => $id_pegawai, 'bulan' => $bulan, 'tahun' => $tahun))->result();
            $total_persen = 0;
            $total_nominal = 0;
            foreach ($pengurangan as $k => $p) {
                $total_nominal += $p->nominal_potongan;
                $pengurangan[$k]->nominal_potongan = rupiah($p->nominal_potongan);
                $total_persen += $p->persen_potongan;
            }

            $pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $id_pegawai))->row();
            echo json_encode(array('pegawai' => $pegawai, 'pengurangan' => $pengurangan, 'total_persen' => $total_persen, 'total_nominal' => rupiah($total_nominal)));
        }
    }

    public function download_all_laporan()
    {

        $tahun = 2022;
        $this->load->model('ref_skpd_model');
        echo "Download Laporan TPP Tahun $tahun\n";
        echo "====================================\n";
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            echo "Bulan " . bulan($bulan) . "\n";
            $this->db->or_where('jenis_skpd', 'kecamatan');
            $this->db->or_where('jenis_skpd', 'uptd');
            $this->db->or_where('jenis_skpd', 'skpd');
            $this->db->or_where('jenis_skpd', 'kelurahan');
            $skpd = $this->db->get('ref_skpd')->result();
            foreach ($skpd as $k => $s) {
                $no = $k + 1;

                echo "\t[$no]" . $s->nama_skpd;

                $id_skpd = $s->id_skpd;
                $static_data = false;
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

                $filename = "Laporan TPP " . $s->nama_skpd;
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
                $template->setValue('nama_skpd', $s->nama_skpd);

                $template->cloneRow('n', count($data['dt_pegawai']));
                $total = array('pagu_tpp' => 0, 'besar_tpp' => 0, 'pengurangan' => 0, 'p_lkh' => 0, 'p_absen' => 0, 'p_hukdis' => 0, 'pph21' => 0, 'dibayar' => 0);
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

                $path_save = './data/laporan_tpp/';

                // check tahun folder
                if (!file_exists($path_save . $data['tahun'])) {
                    mkdir($path_save . $data['tahun'], 0777, true);
                }

                // check bulan folder
                if (!file_exists($path_save . $data['tahun'] . '/' . $data['bulan'])) {
                    mkdir($path_save . $data['tahun'] . '/' . $data['bulan'], 0777, true);
                }
                $template->saveAs($path_save . $data['tahun'] . '/' . $data['bulan'] . "/" . $filename);
                echo colorize(" Done", "green");
                echo "\n";
                // die;
            }
        }
    }
}