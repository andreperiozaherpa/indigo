<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('bulan')) {
    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}
if (!function_exists('bulann')) {
    function bulann($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Agu";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}

if (!function_exists('hari_s')) {
    function hari_s($day)
    {
        switch ($day) {
            case 1:
                return "Sen";
                break;
            case 2:
                return "Sel";
                break;
            case 3:
                return "Rab";
                break;
            case 4:
                return "Kam";
                break;
            case 5:
                return "Jum";
                break;
            case 6:
                return "Sab";
                break;
            case 7:
                return "Min";
                break;
        }
    }
}
if (!function_exists('poee')) {
    function poee($day)
    {
        switch ($day) {
            case 1:
                return "Senin";
                break;
            case 2:
                return "Selasa";
                break;
            case 3:
                return "Rabu";
                break;
            case 4:
                return "Kamis";
                break;
            case 5:
                return "Jum'at";
                break;
            case 6:
                return "Sabtu";
                break;
            case 7:
                return "Minggu";
                break;
        }
    }
}

// if (! function_exists('hari')) {
//   function hari($day)
//   {
//
//   }
// }

//format tanggal yyyy-mm-dd
if (!function_exists('tanggal')) {
    function tanggal($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah); //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun; //hasil akhir
    }
}

if (!function_exists('tanggal_hari')) {
    function tanggal_hari($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $hari = poee(date('N', strtotime($ubah)));
        $pecah = explode("-", $ubah); //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $hari . ", " . $tanggal . ' ' . $bulan . ' ' . $tahun; //hasil akhir
    }
}

if (!function_exists('thn_hungkul')) {
    function thn_hungkul($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah); //memecah variabel berdasarkan -
        $tahun = $pecah[0];
        return $tahun; //hasil akhir
    }
}
if (!function_exists('bln_hungkul')) {
    function bln_hungkul($tanggal)
    {
        $bln = substr($tanggal, 5, 2);
        $bulan = bulann($bln);
        return $bulan; //hasil akhir
    }
}
if (!function_exists('tgl_hungkul')) {
    function tgl_hungkul($tanggal)
    {
        $tgl = substr($tanggal, 8, 2);
        return $tgl; //hasil akhir
    }
}
if (!function_exists('sdate')) {
    function sdate($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah); //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulann($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan; //hasil akhir
    }
}
if (!function_exists('g_month')) {
    function g_month($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah); //memecah variabel berdasarkan -
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $bulan . ' ' . $tahun; //hasil akhir
    }
}
if (!function_exists('stime')) {
    function stime($time)
    {
        $t = substr($time, 0, 5);
        return $t;
    }
}
if (!function_exists('poe')) {
    function poe($day)
    {
        $poe = poee($day);
        return $poe; //hasil akhir
    }
}

//format tanggal timestamp
if (!function_exists('tgl_indo_timestamp')) {

    function tgl_indo_timestamp($tgl)
    {
        $inttime = date('Y-m-d H:i:s', $tgl); //mengubah format menjadi tanggal biasa
        $tglBaru = explode(" ", $inttime); //memecah berdasarkan spaasi

        $tglBaru1 = $tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2 = $tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua = explode("-", $tglBaru1); //lalu memecah variabel berdasarkan -

        $tgl = $tglBarua[2];
        $bln = $tglBarua[1];
        $thn = $tglBarua[0];

        $bln = bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal = "$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal

        return $ubahTanggal;
    }
}

if (!function_exists('tgl_indo_full')) {

    function tgl_indo_full($tgl)
    {
        $inttime = $tgl; //mengubah format menjadi tanggal biasa
        $tglBaru = explode(" ", $inttime); //memecah berdasarkan spaasi

        $tglBaru1 = $tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2 = $tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua = explode("-", $tglBaru1); //lalu memecah variabel berdasarkan -

        $tgl = $tglBarua[2];
        $bln = $tglBarua[1];
        $thn = $tglBarua[0];

        $bln = bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal = "$tgl $bln $thn | $tglBaru2 "; //hasil akhir tanggal

        return $ubahTanggal;
    }
}

if (!function_exists('tgl_indo')) {

    function tgl_indo($tgl)
    {
        $inttime = $tgl; //mengubah format menjadi tanggal biasa
        $tglBaru = explode(" ", $inttime); //memecah berdasarkan spaasi

        $tglBaru1 = $tglBaru[0]; //mendapatkan variabel format yyyy-mm-dd
        $tglBaru2 = $tglBaru[1]; //mendapatkan fotmat hh:ii:ss
        $tglBarua = explode("-", $tglBaru1); //lalu memecah variabel berdasarkan -

        $tgl = $tglBarua[2];
        $bln = $tglBarua[1];
        $thn = $tglBarua[0];

        $bln = bulan($bln); //mengganti bulan angka menjadi text dari fungsi bulan
        $ubahTanggal = "$tgl $bln $thn"; //hasil akhir tanggal

        return $ubahTanggal;
    }
}

//format tanggal timestamp
if (!function_exists('convert_tgl')) {

    function convert_tgl($tgl)
    {
        return date("Y-m-d", strtotime($tgl));
    }
}
if (!function_exists('rupiah')) {

    function rupiah($angka)
    {
        $jadi = "Rp." . number_format($angka, 0, ',', '.');
        return $jadi;
    }
}

if (!function_exists('rp')) {

    function rp($angka)
    {
        $jadi = "Rp" . number_format($angka, 2, ',', '.');
        return $jadi;
    }
}

if (!function_exists('dot')) {

    function dot($angka)
    {
        $jadi = number_format($angka, 0, ',', '.');
        return $jadi;
    }
}

if (!function_exists('dot2')) {

    function dot2($angka)
    {
        $jadi = number_format($angka, 2, ',', '.');
        return $jadi;
    }
}

if (!function_exists('dot2_minus')) {

    function dot2_minus($angka)
    {
        if ($angka < 0) {
            $angka = abs($angka);
            $jadi = "(" . dot2($angka) . ")";
        } else {
            $jadi = dot2($angka);
        }

        return $jadi;
    }
}

if (!function_exists('rp_minus')) {

    function rp_minus($angka)
    {
        if ($angka < 0) {
            $angka = abs($angka);
            $jadi = "(" . rp($angka) . ")";
        } else {
            $jadi = rp($angka);
        }

        return $jadi;
    }
}

if (!function_exists('sel_jam')) {

    function sel_jam($awal, $akhir)
    {
        $start = date_create($awal);
        $end = date_create($akhir); // Current time and date
        $diff = date_diff($start, $end);
        // $a = explode(':', $awal);
        // $b = explode(':', $akhir);
        // $jam_start = $a['0'];
        // $menit_start = $a['1'];
        // $jam_end = $b['0'];
        // $menit_end = $b['1'];
        // $hasil = (intVal($jam_end) - intVal($jam_start)) * 60 + (intVal($menit_end) - intVal($menit_start));
        // $hasil = $hasil / 60;
        // $hasil = number_format($hasil,2);
        $jam = $diff->h;
        $men = $diff->i;
        if ($jam == 0) {
            $hasil = $men . " Menit";
        } elseif ($men == 0) {
            $hasil = $jam . " Jam";
        } elseif ($jam == 0 && $men == 0) {
            $hasil = 'Sekejap Mata';
        } else {
            $hasil = $jam . " Jam " . $men . " Menit";
        }
        return $hasil;
    }
}

if (!function_exists('randomKey')) {

    function randomKey($length)
    {
        $pool = array_merge(range(0, 9), range('A', 'Z'));
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }
        return $key;
    }
}

if (!function_exists('status_verifikasi')) {

    function status_verifikasi($status)
    {
        if ($status == 'terima') {
            $render = '<span class="label label-success">Diterima</span>';
        } elseif ($status == 'tolak') {
            $render = '<span class="label label-danger">Ditolak</span>';
        } else {
            $render = '<span class="label label-warning">Belum Diverifikasi</span>';
        }
        return $render;
    }
}



if (!function_exists('status_loker')) {

    function status_loker($status)
    {
        if ($status == 1) {
            $render = '<span class="label label-success">Dibuka</span>';
        } else {
            $render = '<span class="label label-danger">Ditutup</span>';
        }
        return $render;
    }
}

if (!function_exists('cekForm')) {
    function cekForm($array)
    {
        if (count(array_filter($array)) == count($array)) {
            return false;
        } else {
            return true;
        }
    }
}



if (!function_exists('isFormEmpty')) {
    function isFormEmpty($list_not_required, $list_array)
    {
        foreach ($list_not_required as $l) {
            foreach ($list_array as $k => $v) {
                if ($l == $k) {
                    unset($list_array[$k]);
                }
            }
        }
        if (count(array_filter($list_array)) == count($list_array)) {
            return false;
        } else {
            return true;
        }
    }
}


if (!function_exists('status_pekerjaan')) {

    function status_pekerjaan($status)
    {
        if ($status == 'approved') {
            $render = '<span class="label label-info m-l-5 ">Di Setujui</span>';
        } elseif ($status == 'declined') {
            $render = '<span class="label label-danger m-l-5 ">Di Tolak</span>';
        } else {
            $render = '<span class="label label-warning m-l-5 ">Proses Verfikasi</span>';
        }
        return $render;
    }
}
if (!function_exists('breadcrumb')) {

    function breadcrumb($segments)
    {

        $urls = array();
        $render = '';
        foreach ($segments as $key => $segment) {
            $urls[] = array(site_url(implode('/', array_slice($segments, 0, $key))), $segment);
        }
        $q = 1;
        if (!empty($urls)) {
            $render .= '<li><a href="' . base_url('admin') . '">Dashboard</a></li>';
            foreach ($urls as $key => $value) {
                if ($value[1] == 'admin') {
                    $render .= '<li class="active">Dashboard</li>';
                } else {
                    if ($q == count($urls)) {
                        $render .= '<li class="active">' . ucwords(str_replace('_', ' ', $value[1])) . '</li>';
                    } else {
                        $render .= '<li>' . anchor($value[0], ucwords(str_replace('_', ' ', $value[1]))) . '</li>';
                    }
                }
                $q++;
            }
        } else {
            $render .= '<li class="active">Dashboard</li>';
        }
        return $render;
    }
}
if (!function_exists('title')) {

    function title($title)
    {

        $title = explode('-', $title);
        $render = trim($title[0]);
        return $render;
    }
}

if (!function_exists('warna')) {

    function warna($jumlah)
    {
        if ($jumlah >= 100) {
            $render = '008000';
        } elseif ($jumlah >= 80 & $jumlah < 100) {
            $render = 'FFD700';
        } elseif ($jumlah < 80) {
            $render = 'FF0000';
        } else {
            $render = 'fff';
        }
        return $render;
    }
}

if (!function_exists('rc')) {

    function round_c($n, $x = 5)
    {
        $n = number_format($n);
        return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
    }
}



if (!function_exists('status_realisasi')) {

    function status_realisasi($status)
    {
        if ($status == 'disetujui') {
            $render = '<span class="label label-success m-l-5 pull-right">Di Setujui</span>';
        } elseif ($status == 'menunggu_verifikasi') {
            $render = '<span class="label label-info m-l-5 pull-right">Menunggu Verifikasi</span>';
        } elseif ($status == 'ditolak') {
            $render = '<span class="label label-danger m-l-5 pull-right">Ditolak</span>';
        } elseif ($status == 'belum_dikerjakan') {
            $render = '<span class="label label-default m-l-5 pull-right">Belum Dikerjakan</span>';
        }
        return $render;
    }
}

if (!function_exists('make_pagination')) {

    function make_pagination($pages, $current, $range = 3)
    {
        $res = '';

        $start = $current - $range;
        $end = $current + $range;

        if ($start > 1) {
            $res .= '<a href="?page=1" class="btn btn-primary">Awal</a> ';
        }

        if ($current > 1) {
            $res .= '<a href="?page=' . ($current - 1) . '" class="btn btn-primary">Sebelumnya</a> ';
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($current == $i) {
                $disabled = 'disabled';
            } else {
                $disabled = '';
            }

            if ($i >= 1 and $i <= $pages) {
                $res .= '<a href="?page=' . $i . '" class="btn btn-primary ' . $disabled . '">' . $i . '</a> ';
            }
        }

        if (($pages - $current) > 0) {
            $res .= '<a href="?page=' . ($current + 1) . '" class="btn btn-primary">Selanjutnya</a> ';
        }

        if (($pages - $end) > 0) {
            $res .= '<a href="?page=' . $pages . '" class="btn btn-primary">Akhir</a> ';
        }

        return $res;
    }
}

if (!function_exists('normal_string')) {

    function normal_string($string)
    {
        $string = str_replace('_', ' ', $string);
        $string = ucwords($string);
        return $string;
    }
}
if (!function_exists('code_string')) {

    function code_string($string)
    {
        $string = str_replace(' ', '_', $string);
        $string = strtolower($string);
        return $string;
    }
}


if (!function_exists('status_reviu')) {

    function status_reviu($status)
    {
        if ($status == 'kosong_semua') {
            $icon = 'ti-time';
        } elseif ($status == 'diterima_semua') {
            $icon = 'ti-star';
        } else {
            $icon = 'ti-alert';
        }
        return $icon;
    }
}

if (!function_exists('status_reviu_skpd')) {

    function status_reviu_skpd($status)
    {
        if ($status == 'sudah_direviu') {
            $icon = ' <div class="white-box-header primary">
            <i class="ti-check"></i> SUDAH DIREVIU
            </div>';
        } elseif ($status == 'belum_direviu') {
            $icon = '
            <div class="white-box-header danger">
            <i class="ti-close"></i> BELUM DIREVIU
            </div>';
        } elseif ($status == 'belum_ada_direviu') {
            $icon = '
            <div class="white-box-header danger">
            <i class="ti-close"></i> BELUM ADA INDIKATOR
            </div>';
        } else {
            $icon = '
            <div class="white-box-header warning">
            <i class="ti-time"></i> MASIH PERLU TANGGAPAN
            </div>';
        }
        return $icon;
    }
}
if (!function_exists('generate_hash')) {

    function generate_hash($string)
    {
        return substr(strtoupper(base64_encode(sha1($string))), 0, 8);
    }
}
if (!function_exists('refresh_url')) {
    function refresh_url($url)
    {
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "' . $url . '"';
        $string .= '</script>';

        return $string;
    }
}

if (!function_exists('generate_qr')) {
    function generate_qr($content)
    {
        $CI = &get_instance();
        $CI->load->library('Ci_qr_code');
        $CI->config->load('qr_code');

        $qr_code_config = array();
        $qr_code_config['cacheable'] = $CI->config->item('cacheable');
        $qr_code_config['cachedir'] = $CI->config->item('cachedir');
        $qr_code_config['imagedir'] = $CI->config->item('imagedir');
        $qr_code_config['errorlog'] = $CI->config->item('errorlog');
        $qr_code_config['ciqrcodelib'] = $CI->config->item('ciqrcodelib');
        $qr_code_config['quality'] = $CI->config->item('quality');
        $qr_code_config['size'] = $CI->config->item('size');
        $qr_code_config['black'] = $CI->config->item('black');
        $qr_code_config['white'] = $CI->config->item('white');
        $CI->ci_qr_code->initialize($qr_code_config);

        $image_name = "QR_" . rand(1111, 9999) . time() . ".png";

        $servername = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $port = filter_input(INPUT_SERVER, 'SERVER_PORT');
        $codeContents = $content;
        $params['data'] = $codeContents;
        $params['level'] = 'H';
        $params['size'] = 2;

        $params['savename'] = FCPATH . $qr_code_config['imagedir'] . $image_name;
        $CI->ci_qr_code->generate($params);

        $CI->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;
        return $file = $params['savename'];
    }
}

if (!function_exists('get_qr_code')) {
    function get_qr_code($imagepath, $indeks = '', $eks = 'png', $debugg = false)
    {

        $za = new ZipArchive();

        $za->open($imagepath);

        $image_files = array();
        for ($i = 0; $i < $za->numFiles; $i++) {
            $stat = $za->statIndex($i);
            $filename = basename($stat['name']) . PHP_EOL;
            $ex = explode('.', $filename);
            if (isset($ex[1])) {
                $ext = trim($ex[1]);
                if ($ext == $eks) {
                    $image_files[] = $filename;
                }
            }
        }
        usort($image_files, function ($a, $b) {

            preg_match("/([0-9]+)\.[a-zA-Z]+$/", $a, $matches);
            $firstimage = $matches[1];
            preg_match("/([0-9]+)\.[a-zA-Z]+$/", $b, $matches);
            $lastimage = $matches[1];

            if ($firstimage == $lastimage) {
                return 0;
            }
            return ($firstimage < $lastimage) ? -1 : 1;
        });

        $image_files = array_reverse($image_files);
        if ($debugg) {
            return ($image_files);
        }
        return trim($image_files[$indeks]);
    }
}

if (!function_exists('get_capaian')) {
    function get_capaian($target, $realisasi, $pola)
    {
        $target = str_replace(',', '.', $target);
        if (($target == 0 || $realisasi == 0)) {
            $capaian = 0;
        } else {
            if ($pola == "Maximaze" || $pola == "Maximize") {
                $capaian = ($realisasi / $target) * 100;
            } elseif ($pola == "Minimaze" || $pola == "Minimize") {
                $capaian = (1 + (1 - $realisasi / $target)) * 100;
            } elseif ($pola == "Stabilize") {
                if ($realisasi > $target) {
                    //salah
                    $ca = $realisasi / $target * 100;
                    $capaian = (100 - ($ca - 100));
                } elseif ($realisasi < $target) {
                    //salah
                    $capaian = $capaian = $realisasi / $target * 100;
                } else {
                    $capaian = 100;
                }
            } else {
                $capaian = 0;
            }
        }
        return round($capaian, 2);
    }
}

if (!function_exists('get_capaian_iku')) {
    function get_capaian_iku($total_capaian, $jumlah_iku)
    {
        if ($total_capaian == 0 && $jumlah_iku == 0) {
            $capaian = 0;
        } else {
            $capaian = $total_capaian / $jumlah_iku;
        }
        return round($capaian, 2);
    }
}

function waktu_lalu($timestamp)
{
    $selisih = time() - strtotime($timestamp);
    $detik = $selisih;
    $menit = round($selisih / 60);
    $jam = round($selisih / 3600);
    $hari = round($selisih / 86400);
    $minggu = round($selisih / 604800);
    $bulan = round($selisih / 2419200);
    $tahun = round($selisih / 29030400);
    if ($detik <= 60) {
        $waktu = $detik . ' detik yang lalu';
    } else if ($menit <= 60) {
        $waktu = $menit . ' menit yang lalu';
    } else if ($jam <= 24) {
        $waktu = $jam . ' jam yang lalu';
    } else if ($hari <= 7) {
        $waktu = $hari . ' hari yang lalu';
    } else if ($minggu <= 4) {
        $waktu = $minggu . ' minggu yang lalu';
    } else if ($bulan <= 12) {
        $waktu = $bulan . ' bulan yang lalu';
    } else {
        $waktu = $tahun . ' tahun yang lalu';
    }
    return $waktu;
}

function roundfive($n, $x = 5)
{
    return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
}

function tanda_tangan_cloud($path_pdf, $path_output, $nik, $passphrase, $filename, $testing = null, $data_specimen = '')
{
    $server_ip = 'tte.sumedangkab.go.id';
    $server_user = 'esign';
    $server_pass = '9DyhDH4fV4fHyCKF';
    $error = false;
    $message = "";
    $file_ttd = "";

    if ($testing == 264358) {
        $source = $path_pdf;
        $dest = "./{$path_output}/{$filename}";
        copy($source, $dest);
        $file_ttd = $filename;
        $message = "Surat telah berhasil ditandatangani secara elektronik";
        return array(
            'error' => false,
            'message' => $message,
            'file_ttd' => $file_ttd,
        );
    }
    $postData = array(
        'file' => curl_file_create($path_pdf, 'application/pdf'),
        'nik' => $nik,
        'passphrase' => $passphrase,
        'tampilan' => 'INVISIBLE',
        'location' => 'Sumedang'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $server_ip . '/api/sign/pdf');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if ($data_specimen != '') {
        $postData['tampilan'] = 'visible';
        $postData['page'] = 1;
        $postData['image'] = true;
        $postData['imageTTD'] = curl_file_create($data_specimen['image_ttd'], 'image/png');
        $postData['xAxis'] = $data_specimen['llx'];
        $postData['height'] = $data_specimen['lly'];
        $postData['width'] = $data_specimen['urx'];
        $postData['yAxis'] = $data_specimen['ury'];
    }

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    // curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_USERPWD, "$server_user:$server_pass");

    $result = curl_exec($ch);
    $curl_error = false;
    if (curl_errno($ch)) {
        $curl_error = true;
        $curl_message = curl_error($ch);
    }
    curl_close($ch);

    if ($curl_error) {
        $error = true;
        $message = $curl_message;
    } else {
        $res = json_decode($result);
        if (isset($res->error)) {
            $error = true;
            $message = $res->error;
        } else {
            file_put_contents("./{$path_output}/{$filename}", $result);
            $error = false;
            $message = 'Surat berhasil ditanda tangani secara elektronik';
            $file_ttd = $filename;
        }
    }
    return array(
        'error' => $error,
        'message' => $message,
        'file_ttd' => $file_ttd,
        // 'result' => $result
    );
}

function tanda_tangan_digital($path_pdf, $sertifikat, $path_output, $passkey, $inputname, $filename, $testing = "")
{
    $error = false;
    $message = "";
    $file_ttd = "";

    // if ($testing == 264358) {

    // $source = $path_pdf;
    // $dest = "./{$path_output}/{$filename}";
    // copy($source, $dest);
    // $file_ttd = $filename;
    // $message = "[GAGAL] Tandatangan Digital sedang dalam perbaikan";
    // return array(
    //     'error'     => true,
    //     'message'   => $message,
    //     'file_ttd'  => $file_ttd,
    // );
    // }
    if (file_exists($sertifikat)) {
        $path_jar = './application/third_party/jpdf/JSignPdf.jar';
        // $path_pdf = $berkas;
        $path_p12 = $sertifikat; //dicek berdasarkan akun di sistem
        $output_path = "./data/tmp";
        // $gambar = 'ttd.png';
        // $signed_name = "_(signed)";

        $passphrase = $passkey; //POST dr user

        $tsa_url = "http://tsa-bsre.bssn.go.id/"; // free TSA/NTP -> timestamping

        $ocsp = "http://cvs-bsre.bssn.go.id/ocsp"; //ocsp

        // $command = 'java -jar "'.$path_jar.'" "'.$path_pdf.'" -kst PKCS12 -ksf "'.$path_p12.'" -ksp "'.$passphrase.'" -l "Sumedang" -r "ditandatangani secara elektronik" -c "kontak yang bisa dihubungi" -tsh SHA256 -ha SHA256 -d "'.$output_path.'" -os "" -V --l4-text "" --l2-text ""  ';

        $command = 'java -jar "' . $path_jar . '" "' . $path_pdf . '" -kst PKCS12 -ksf "' . $path_p12 . '" -ksp "' . $passphrase . '" -l "Sumedang" -r "ditandatangani secara elektronik" -c "kontak yang bisa dihubungi" -tsh SHA256 -ha SHA256 -d "' . $output_path . '" -os "" -ts ' . $tsa_url . ' -ta PASSWORD -tsu "coba" -tsp "1234" --ocsp --ocsp-server-url "' . $ocsp . '" -V --l4-text "" --l2-text ""  ';

        (exec($command, $val, $er)); //eksekusi dan cek hasil nya

        if ($testing == 1) {
            // print_r($val,$er);
        }

        if ($er == 0 || $er == 3) { //exit code 0 = berhasil
            // return redirect('siup')->with('flash_message', 'Surat Izin Berhasil Ditandatangani Secara Elektronik'); //dapat menyesuaikan

            // echo("sukses".$er);
            $source = "./data/tmp/{$inputname}";
            $dest = "./{$path_output}/{$filename}";
            copy($source, $dest);
            unlink($source);
            $file_ttd = $filename;
            $message = "Surat berhasil ditanda tangani secara elektronik";
        } else {
            // echo('gagal'.$er);
            //return redirect('siup')->with('danger_message', 'Passphrase Yang Anda Masukan Salah atau Dokumen Sudah Ditandatangani');
            $error = true;
            $message = "Passphrase salah";
        }
    } else {
        $error = true;
        $message = "Sertifikat P12 tidak ditemukan : " . $sertifikat;
    }
    return array(
        'error' => $error,
        'message' => $message,
        'file_ttd' => $file_ttd,
    );
}


if (!function_exists('getPrediksiPensiun')) {
    function getPrediksiPensiun($tgl_lahir, $jenis_jabatan)
    {
        if ($jenis_jabatan == "Struktural") {
            $masa_kerja = 58;
        } else {
            $masa_kerja = 60;
        }
        $pensiun = date('Y-m-d', strtotime('+' . $masa_kerja . ' year', strtotime($tgl_lahir)));
        $pensiun = date('Y-m-d', strtotime('first day of next month', strtotime($pensiun)));
        return $pensiun;
    }
}
if (!function_exists('status_usulan')) {

    function status_usulan($status, $class = "")
    {
        if ($status == 'terima') {
            $render = '<span class="label label-success ' . $class . '"><i class="ti-check"></i> Diterima</span>';
        } elseif ($status == 'tolak') {
            $render = '<span class="label label-danger ' . $class . '"><i class="ti-close"></i> Ditolak</span>';
        } elseif ($status == 'pending') {
            $render = '<span class="label label-warning ' . $class . '"><i class="ti-time"></i> Menunggu Verifikasi</span>';
        } else {
            $render = '<span class="label label-danger ' . $class . '"><i class="ti-alert"></i> Belum Diajukan</span>';
        }
        return $render;
    }
}
if (!function_exists('status_text')) {

    function status_text($status)
    {
        if ($status == 'terima') {
            $render = 'Diterima';
        } elseif ($status == 'tolak') {
            $render = 'Ditolak';
        } elseif ($status == 'pending') {
            $render = 'Menunggu Verifikasi';
        } else {
            $render = 'Belum Diajukan';
        }
        return $render;
    }
}

function icon_surat($status_surat)
{
    if ($status_surat == "belum_diupload") {
        $c1 = "warning";
        $c2 = "#f8c255";
        $i1 = "ti-cloud-up";
        $i2 = "icon-info";
        $text = "Upload Surat";
    } elseif ($status_surat == "menunggu_verifikasi") {
        $c1 = "info";
        $c2 = "#008efa";
        $i1 = "ti-write";
        $i2 = "icon-clock";
        $text = "Menunggu Verifikasi";
    } elseif ($status_surat == "ditolak_verifikasi") {
        $c1 = "danger";
        $c2 = "#F75B36";
        $i1 = "ti-write";
        $i2 = "icon-close";
        $text = "Verifikasi Ditolak";
    } elseif ($status_surat == "menunggu_penomoran") {
        $c1 = "info";
        $c2 = "#008efa";
        $i1 = "ti-layout-cta-left";
        $i2 = "icon-clock";
        $text = "Menunggu Penomoran";
    } elseif ($status_surat == "ditolak_penomoran") {
        $c1 = "danger";
        $c2 = "#F75B36";
        $i1 = "ti-layout-cta-left";
        $i2 = "icon-close";
        $text = "Penomoran Ditolak";
    } elseif ($status_surat == "menunggu_tandatangan") {
        $c1 = "info";
        $c2 = "#008efa";
        $i1 = "ti-pencil-alt";
        $i2 = "icon-clock";
        $text = "Menunggu Tandatangan";
    } elseif ($status_surat == "ditolak_ttd") {
        $c1 = "danger";
        $c2 = "#F75B36";
        $i1 = "ti-pencil-alt";
        $i2 = "icon-close";
        $text = "Tandatangan Ditolak";
    } elseif ($status_surat == "sudah_ditandatangani") {
        $c1 = "success";
        $c2 = "#00c292";
        $i1 = "ti-pencil-alt";
        $i2 = "icon-check";
        $text = "Sudah Ditandatangani";
    } else {
        $c1 = "warning";
        $c2 = "#f8c255";
        $i1 = "ti-timer";
        $i2 = "icon-clock";
        $text = "Dalam Proses";
    }
    return array('c1' => $c1, 'c2' => $c2, 'i1' => $i1, 'i2' => $i2, 'text' => $text);
}

function short_text($text, $max = 150)
{
    if (strlen($text) > $max) {
        $res = substr($text, 0, $max);
        $res .= "...";
    } else {
        $res = $text;
    }
    $res = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $res);
    return trim(strip_tags($res));
}
function getDatesFromRange($start, $end, $format = 'Y-m-d')
{
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach ($period as $date) {
        $array[] = $date->format($format);
    }

    return $array;
}

function isDateContinous($dates)
{
    $previous = new DateTime($dates[0]);
    unset($dates[0]);

    foreach ($dates as $v) {
        $current = new DateTime($v);
        $diff = $current->diff($previous);

        if ($diff->days == 1) {
            $previous = new DateTime($v);
        } else {
            return false;
        }
    }
    return true;
}

function groupDate($dates)
{
    if (count($dates) == 1) {
        $res = tanggal($dates[0]);
    } else {
        $is_con = isDateContinous($dates);
        if ($is_con) {
            $res = tanggal($dates[0]) . " s.d " . tanggal($dates[count($dates) - 1]);
        } else {
            $list = array();
            foreach ($dates as $d) {
                $list[] = tanggal($d);
            }
            $res = implode(' ,', $list);
        }
    }
    return $res;
}

function get_kuadran($kompetensi, $kinerja)
{
    if ($kompetensi == "rendah" && $kinerja == "rendah") {
        $kuadran = 1;
    } elseif ($kompetensi == "rendah" && $kinerja == "sedang") {
        $kuadran = 3;
    }
    if ($kompetensi == "rendah" && $kinerja == "tinggi") {
        $kuadran = 6;
    }
    if ($kompetensi == "sedang" && $kinerja == "rendah") {
        $kuadran = 2;
    }
    if ($kompetensi == "sedang" && $kinerja == "sedang") {
        $kuadran = 5;
    }
    if ($kompetensi == "sedang" && $kinerja == "tinggi") {
        $kuadran = 8;
    }
    if ($kompetensi == "tinggi" && $kinerja == "rendah") {
        $kuadran = 4;
    }
    if ($kompetensi == "tinggi" && $kinerja == "sedang") {
        $kuadran = 7;
    }
    if ($kompetensi == "tinggi" && $kinerja == "tinggi") {
        $kuadran = 9;
    }
    return $kuadran;
}

function get_kuadran_nilai($nilai_potensi, $nilai_kompetensi)
{
    if ($nilai_potensi >= 75) {
        $potensi = "tinggi";
    } elseif ($nilai_potensi >= 25) {
        $potensi = "sedang";
    } else {
        $potensi = "rendah";
    }

    if ($nilai_kompetensi >= 55) {
        $kompetensi = "tinggi";
    } elseif ($nilai_kompetensi >= 25) {
        $kompetensi = "sedang";
    } else {
        $kompetensi = "rendah";
    }

    if ($kompetensi == "rendah" && $potensi == "rendah") {
        $kuadran = 1;
    } elseif ($kompetensi == "rendah" && $potensi == "sedang") {
        $kuadran = 3;
    }
    if ($kompetensi == "rendah" && $potensi == "tinggi") {
        $kuadran = 6;
    }
    if ($kompetensi == "sedang" && $potensi == "rendah") {
        $kuadran = 2;
    }
    if ($kompetensi == "sedang" && $potensi == "sedang") {
        $kuadran = 5;
    }
    if ($kompetensi == "sedang" && $potensi == "tinggi") {
        $kuadran = 8;
    }
    if ($kompetensi == "tinggi" && $potensi == "rendah") {
        $kuadran = 4;
    }
    if ($kompetensi == "tinggi" && $potensi == "sedang") {
        $kuadran = 7;
    }
    if ($kompetensi == "tinggi" && $potensi == "tinggi") {
        $kuadran = 9;
    }
    return $kuadran;
}

function get_kuadran_nilai_var($nilai_potensi, $nilai_kompetensi, $data_potensi, $data_kompetensi)
{
    // $data_potensi = array_filter($data_potensi);
    $mean_potensi = array_sum($data_potensi) / count($data_potensi);
    $stdev_potensi = getStand_Deviation($data_potensi);

    // $data_kompetensi = array_filter($data_kompetensi);
    $mean_kompetensi = array_sum($data_kompetensi) / count($data_kompetensi);
    $stdev_kompetensi = getStand_Deviation($data_kompetensi);

    // $std_up_po = $mean_potensi+$stdev_potensi;
    // $std_do_po = $mean_potensi-$stdev_potensi;
    // $std_up_ko = $mean_kompetensi+$stdev_kompetensi;
    // $std_do_ko = $mean_kompetensi-$stdev_kompetensi;

    $std_up_po = getPercentile($data_potensi, 84.14);
    $std_do_po = getPercentile($data_potensi, 27.18);
    $std_up_ko = getPercentile($data_kompetensi, 84.14);
    $std_do_ko = getPercentile($data_kompetensi, 27.18);


    if ($nilai_potensi >= $std_up_po) {
        $potensi = "tinggi";
    } elseif ($nilai_potensi >= $std_do_po) {
        $potensi = "sedang";
    } else {
        $potensi = "rendah";
    }

    if ($nilai_kompetensi >= $std_up_ko) {
        $kompetensi = "tinggi";
    } elseif ($nilai_kompetensi >= $std_do_ko) {
        $kompetensi = "sedang";
    } else {
        $kompetensi = "rendah";
    }

    if ($kompetensi == "rendah" && $potensi == "rendah") {
        $kuadran = 1;
        $kuadran = 2;
    } elseif ($kompetensi == "rendah" && $potensi == "sedang") {
        $kuadran = 3;
    }
    if ($kompetensi == "rendah" && $potensi == "tinggi") {
        $kuadran = 6;
    }
    if ($kompetensi == "sedang" && $potensi == "rendah") {
        $kuadran = 2;
    }
    if ($kompetensi == "sedang" && $potensi == "sedang") {
        $kuadran = 5;
    }
    if ($kompetensi == "sedang" && $potensi == "tinggi") {
        $kuadran = 8;
    }
    if ($kompetensi == "tinggi" && $potensi == "rendah") {
        $kuadran = 4;
    }
    if ($kompetensi == "tinggi" && $potensi == "sedang") {
        $kuadran = 7;
    }
    if ($kompetensi == "tinggi" && $potensi == "tinggi") {
        $kuadran = 9;
    }
    return $kuadran;
}

function get_nilai_kuadran($eselon = null)
{
    $CI = &get_instance();
    if ($eselon == 'II.') {
        $data_potensi = $CI->db->select('nilai_potensi')->where('tahun', date('Y'))->like('eselon', 'II.', 'after')->get('pegawai_talent_simpeg')->result_array();
        $data_potensi = array_map('current', $data_potensi);

        $data_kompetensi = $CI->db->select('nilai_kompetensi')->where('tahun', date('Y'))->like('eselon', 'II.', 'after')->get('pegawai_talent_simpeg')->result_array();
        $data_kompetensi = array_map('current', $data_kompetensi);
    } elseif ($eselon == 'III.') {
        $data_potensi = $CI->db->select('nilai_potensi')->where('tahun', date('Y'))->group_start()->like('eselon', 'III.', 'after')->group_end()->get('pegawai_talent_simpeg')->result_array();
        $data_potensi = array_map('current', $data_potensi);

        $data_kompetensi = $CI->db->select('nilai_kompetensi')->where('tahun', date('Y'))->group_start()->like('eselon', 'III.', 'after')->group_end()->get('pegawai_talent_simpeg')->result_array();
        $data_kompetensi = array_map('current', $data_kompetensi);
    } elseif ($eselon == 'IV.') {
        $data_potensi = $CI->db->select('nilai_potensi')->where('tahun', date('Y'))->group_start()->or_not_like('eselon', 'II.', 'both')->or_where('eselon', null)->group_end()->get('pegawai_talent_simpeg')->result_array();
        $data_potensi = array_map('current', $data_potensi);

        $data_kompetensi = $CI->db->select('nilai_kompetensi')->where('tahun', date('Y'))->group_start()->or_not_like('eselon', 'II.', 'both')->or_where('eselon', null)->group_end()->get('pegawai_talent_simpeg')->result_array();
        $data_kompetensi = array_map('current', $data_kompetensi);
    }

    $ret['std_up_po'] = getPercentile(@$data_potensi, 84.14);
    $ret['std_do_po'] = getPercentile(@$data_potensi, 27.18);
    $ret['std_up_ko'] = getPercentile(@$data_kompetensi, 84.14);
    $ret['std_do_ko'] = getPercentile(@$data_kompetensi, 27.18);
    $ret['max_po'] = max(@$data_potensi);
    $ret['min_po'] = min(@$data_potensi);
    $ret['max_ko'] = max(@$data_kompetensi);
    $ret['min_ko'] = min(@$data_kompetensi);
    if ($eselon) {
        return $ret;
    } else {
        return false;
    }
}

function getPercentile($array, $percentile)
{
    $percentile = min(100, max(0, $percentile));
    $array = array_values($array);
    sort($array);
    $index = ($percentile / 100) * (count($array) - 1);
    $fractionPart = $index - floor($index);
    $intPart = floor($index);

    $percentile = $array[$intPart];
    $percentile += ($fractionPart > 0) ? $fractionPart * ($array[$intPart + 1] - $array[$intPart]) : 0;

    return $percentile;
}

function getStand_Deviation($arr)
{
    $num_of_elements = count($arr);

    $variance = 0.0;

    // calculating mean using array_sum() method
    $average = array_sum($arr) / $num_of_elements;

    foreach ($arr as $i) {
        // sum of squares of differences between 
        // all numbers and means.
        $variance += pow(($i - $average), 2);
    }

    return (float) sqrt($variance / $num_of_elements);
}

function curlMadasih($url, $postData = '', $emptyPost = false)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://e-officedesa.sumedangkab.go.id/api_eoffice/' . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    if (!empty($postData) || $emptyPost) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }
    // $headers = array();
    // $headers[] = 'Accept: */*';
    // $headers[] = 'Content-Type: multipart/form-data';
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    // print_r(curl_getinfo($ch));
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $result;
}

function curlDewan($url, $postData = '', $emptyPost = false)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://e-officedprd.sumedangkab.go.id/api_eoffice/' . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    if (!empty($postData) || $emptyPost) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }
    // $headers = array();
    // $headers[] = 'Accept: */*';
    // $headers[] = 'Content-Type: multipart/form-data';
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    // print_r(curl_getinfo($ch));
    if (curl_errno($ch)) {
        return false;
    }
    curl_close($ch);
    return $result;
}

function status_lkh($status)
{
    if ($status == 'sudah_diverifikasi') {
        $r = '<span class="text-success"><i class="ti-check"></i> Sudah Diverifikasi</span>';
    } elseif ($status == 'belum_diverifikasi') {
        $r = '<span class="text-warning"><i class="ti-time"></i> Belum diverifikasi</span>';
    } elseif ($status == 'ditolak') {
        $r = '<span class="text-danger"><i class="ti-close"></i> Ditolak</span>';
    } else {
        $r = '<span class="text-warning"><i class="ti-info"></i> Belum diisi</span>';
    }
    return $r;
}

function nextMonth($date)
{
    $currentMonth = date("m", strtotime($date));
    $nextMonth = date("m", strtotime($date . "+1 month"));
    if ($currentMonth == $nextMonth - 1) {
        $nextDate = date('Y-m-d', strtotime($date . " +1 month"));
    } else {
        $nextDate = date('Y-m-d', strtotime("last day of next month", strtotime($date)));
    }
    return $nextDate;
}


function get_capaian_desa($target, $realisasi)
{
    if ($target == 0) {
        $capaian = 0;
    } else {
        $capaian = $realisasi / $target * 100;
    }
    return round($capaian, 2);
}

function status_realisasi_kk($status)
{
    if ($status == 1) {
        $icon = "check";
        $text = "Sudah";
        $color = "success";
    } else {
        $icon = "close";
        $text = "Belum";
        $color = "danger";
    }
    $render = "<span class=\"text-$color\"><i class=\"ti-$icon\"></i> $text</span>";
    return $render;
}

function convert_minute($init)
{
    $res = "";
    $init = $init * 60;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;
    if (!empty($hours)) {
        $res .= $hours . " jam ";
    }
    if (!empty($minutes)) {
        $res .= $minutes . " menit ";
    }
    if (!empty($seconds)) {
        $res .= $seconds . " detik";
    }
    if (empty($res)) {
        $res = "-";
    }
    return trim($res);
}

function number_to_alphabet($number)
{
    $number = intval($number);
    if ($number <= 0) {
        return '';
    }
    $alphabet = '';
    while ($number != 0) {
        $p = ($number - 1) % 26;
        $number = intval(($number - $p) / 26);
        $alphabet = chr(65 + $p) . $alphabet;
    }
    return $alphabet;
}

function alphabet_to_number($string)
{
    $string = strtoupper($string);
    $length = strlen($string);
    $number = 0;
    $level = 1;
    while ($length >= $level) {
        $char = $string[$length - $level];
        $c = ord($char) - 64;
        $number += $c * (26 ** ($level - 1));
        $level++;
    }
    return $number;
}

function text_kuseioner($number)
{
}

if (!function_exists('convert_satuan')) {
    function convert_satuan($id)
    {
        $CI = &get_instance();
        $data = $CI->db->get_where('ref_satuan', array('id_satuan' => $id))->row();

        return $data->satuan;
    }
}

function curlSimpeg($url, $postData = '')
{
    // $url = 'tes';
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, 'https://simpeg.sumedangkab.go.id/api_eoffice/' . $url);
    curl_setopt($ch, CURLOPT_URL, 'https://10.20.1.12/api_eoffice/' . $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    if (!empty($postData)) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }

    // $headers = array();
    // $headers[] = 'Accept: */*';
    // $headers[] = 'Content-Type: multipart/form-data';
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        die;
    }
    curl_close($ch);
    // var_dump($result);die();
    return $result;
}

function base_simpeg($url = "")
{
    // $simpeg = "https://simpeg.sumedangkab.go.id:84/";
    $simpeg = base_url();
    return $simpeg . $url;
}

function base_tahu($url = "")
{
    $simpeg = "https://tahu.sumedangkab.go.id/";
    // $simpeg = base_url();
    return $simpeg . $url;
}


if (!function_exists('array_bulan')) {
    function array_bulan()
    {
        $bulan = array(
            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember",
        );
        return $bulan;
    }
}


if (!function_exists('convert_data')) {
    function convert_data($array, $index, $key, $value)
    {
        if (!empty($key)) {
            $search = array_search($key, array_column($array, $index));
            return $array[$search]->$value;
        } else {
            return "";
        }
    }
}

if (!function_exists('get_status_riwayat_simpeg')) {
    function get_status_riwayat_simpeg($row)
    {
        $status = '';
        if (@$row->status_update == 'DELETE') {
            $status = 'danger';
        } elseif (@$row->status_verifikasi == 'Proses') {
            $status = 'warning';
        } elseif (@$row->status_verifikasi == 'Ditolak') {
            $status = 'danger';
        } elseif (@$row->status_verifikasi == 'Diterima') {
            $status = 'success';
        } elseif ($row->status == 'Y') {
            $status = 'bg-gradient-primary text-white';
        }
        return $status;
    }
}

if (!function_exists('get_info_riwayat_simpeg')) {
    function get_info_riwayat_simpeg($row)
    {
        $info = '';
        if (@$row->status_verifikasi == 'Proses') {
            $info = '<div class="badge badge-pill badge-glow badge-light-primary mr-1 mb-1"></div>';
        } elseif (@$row->status_verifikasi == 'Ditolak') {
            $info = '<div class="alert alert-danger mb-2" role="alert">
                        Ditolak : dengan alasan
                    </div>';
        } elseif (@$row->status_verifikasi == 'Diterima') {
            $info = '<div class="alert alert-success mb-2" role="alert">
                        Diterima
                    </div>';
        }
        return $info;
    }
}

if (!function_exists('get_foto_pegawai_by_nip')) {
    function get_foto_pegawai_by_nip($nip)
    {
        $CI = &get_instance();
        $CI->db->select('foto_pegawai');
        $CI->db->where('nip', $nip);
        $query = $CI->db->get('pegawai');
        $data = $query->row();
        $foto = @$data->foto_pegawai;
        if ($foto) {
            return base_url('data/foto/pegawai/' . $foto);
        } else {
            return base_url('data/foto/pegawai/user-default.png');
        }
    }
}

if (!function_exists('get_foto_pegawai_path_by_nip')) {
    function get_foto_pegawai_path_by_nip($nip)
    {
        $CI = &get_instance();
        $CI->db->select('foto_pegawai');
        $CI->db->where('nip', $nip);
        $query = $CI->db->get('pegawai');
        $data = $query->row();
        $foto = @$data->foto_pegawai;
        if ($foto) {
            return './data/foto/pegawai/' . $foto;
        } else {
            return './data/foto/pegawai/user-default.png';
        }
    }
}

if (!function_exists('get_pegawai')) {
    function get_pegawai($id)
    {
        $CI = &get_instance();
        // $CI->db->select('foto_pegawai');
        $CI->db->where('user_id', $id);
        $query = $CI->db->get('user');
        $data = $query->row();
        return $data;
    }
}

if (!function_exists('status_perdin')) {

    function status_perdin($status)
    {
        if ($status == 'sudah_diverifikasi') {
            $render = '<span class="label label-success">Sudah Diverifikasi</span>';
        } elseif ($status == 'ditolak') {
            $render = '<span class="label label-danger">Ditolak</span>';
        } else {
            $render = '<span class="label label-warning">Menunggu Verifikasi</span>';
        }
        return $render;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = (float) $angka;
        $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        );

        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int) ($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('seratus %s', terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int) ($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('seribu %s', terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int) ($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
            $hasil_mod = $angka % 1000;
            return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
        } else if ($angka < 1000000000) {

            // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
            $hasil_bagi = (int) ($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            // bilangan 'milyaran'
            $hasil_bagi = (int) ($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s miliar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            // bilangan 'triliun'                           
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
        } else {
            return 'Format angka melebihi batas';
        }
    }
}

if (!function_exists('terbilang_decimal')) {
    function terbilang_decimal($angka, $round = 2)
    {
        $angka = (float) $angka;
        $angka = round($angka, $round);
        $decimal = "";
        $exp_decimal = explode('.', $angka);
        $angka_decimal = (isset($exp_decimal[1])) ? $exp_decimal[1] : 0;
        $nol = (@$exp_decimal[0] == 0) ? "nol" : "";
        if ($angka_decimal > 0) {
            $nol_koma = (substr($angka_decimal, 0, 1) == 0) ? "nol " : "";
            $decimal = $nol . " koma " . $nol_koma . terbilang($angka_decimal);
        }
        return $decimal;
    }
}

if (!function_exists('terbilang_koma')) {
    function terbilang_koma($angka)
    {
        $rupiah = ($angka != 0) ? " rupiah" : "";
        return ($angka != 0) ? terbilang($angka) . terbilang_decimal($angka) . $rupiah : 'nol rupiah';
    }
}

if (!function_exists('terbilang_koma_minus')) {

    function terbilang_koma_minus($angka)
    {
        if ($angka < 0) {
            $angka = abs($angka);
            $jadi = "negatif " . terbilang_koma($angka);
        } else {
            $jadi = terbilang_koma($angka);
        }

        return $jadi;
    }
}



if (!function_exists('label_status')) {
    function label_status($status = 'belum')
    {
        switch ($status) {
            case 'belum':
                return 'label-warning';
                break;

            case 'setuju':
                return 'label-primary';
                break;

            case 'ditolak':
                return 'label-danger';
                break;
        }
    }
}

function status_cuti($status_pengajuan, $status_verifikasi_kepegawaian, $status_verifikasi_bkd, $verifikasi_bkd)
{
    $status = 'belum_diajukan';
    if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'menunggu_verifikasi') {
        $status = "menunggu_verifikasi_kepegawaian";
    } else if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'ditolak') {
        $status = "ditolak_kepegawaian";
    } else if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'sudah_diverifikasi' && $verifikasi_bkd == false) {
        $status = "selesai_kepegawaian";
    } else if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'sudah_diverifikasi' && $verifikasi_bkd == true && $status_verifikasi_bkd == 'menunggu_verifikasi') {
        $status = "menunggu_verifikasi_bkd";
    } else if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'sudah_diverifikasi' && $verifikasi_bkd == true && $status_verifikasi_bkd == 'ditolak') {
        $status = "ditolak_bkd";
    } else if ($status_pengajuan == 'sudah_diajukan' && $status_verifikasi_kepegawaian == 'sudah_diverifikasi' && $verifikasi_bkd == true && $status_verifikasi_bkd == 'sudah_diverifikasi') {
        $status = "selesai_bkd";
    }
    return $status;
}

function color_status_cuti($status, $class = '')
{
    $icon = "";
    $text = "";
    $color = "";
    if ($status == 'belum_diajukan') {
        $icon = "ti-alert";
        $text = normal_string($status);
        $color = "warning";
    } elseif ($status == 'menunggu_verifikasi_kepegawaian' || $status == 'menunggu_verifikasi_bkd') {
        $icon = "ti-time";
        $text = normal_string($status);
        $color = "info";
    } elseif ($status == 'ditolak_kepegawaian' || $status == 'ditolak_bkd') {
        $icon = "ti-close";
        $text = normal_string($status);
        $color = "danger";
    } elseif ($status == 'selesai_kepegawaian' || $status == 'selesai_bkd') {
        $icon = "ti-check";
        $text = normal_string($status);
        $color = "success";
    }
    return "<span class='label label-$color $class'><i class='$icon'></i> $text</span>";
}

if (!function_exists('parsing_kodering')) {
    function parsing_kodering($kodering = '')
    {
        $parsing = array();
        if ($kodering) {
            $parsing['kodering'] = $kodering;
            $parsing['urusan'] = substr($kodering, 0, 1);
            $parsing['sub_urusan'] = substr($kodering, 0, 4);
            $parsing['unit'] = substr($kodering, 0, 17) . ".0000";
            $parsing['sub_unit'] = substr($kodering, 0, 22);
            $parsing['program'] = substr($kodering, 23, 7);
            $parsing['kegiatan'] = substr($kodering, 23, 12);
            $parsing['sub_kegiatan'] = substr($kodering, 23, 15);
            $parsing['peruntukan'] = substr($kodering, 39, 17);

            // 1.02.03.2.02.02.5.1.02.02.01.0014
        }
        return $parsing;
    }
}

if (!function_exists('posisi_kertas_kerja')) {
    function posisi_kertas_kerja($board_position = '')
    {
        switch ($board_position) {
            case "board-to-do":
                return "Daftar Pekerjaan";
                break;
            case "board-in-progres":
                return "Proses Pengerjaan";
                break;
            case "board-in-review":
                return "Menunggu Pengkajian";
                break;
            case "board-done":
                return "Pekerjaan Selesai";
                break;
            default:
                return $board_position;
                break;
        }
    }
}


function colorize($color, $text)
{
    $colors = array(
        'black' => '0;30',
        'dark_gray' => '1;30',
        'blue' => '0;34',
        'light_blue' => '1;34',
        'green' => '0;32',
        'light_green' => '1;32',
        'cyan' => '0;36',
        'light_cyan' => '1;36',
        'red' => '0;31',
        'light_red' => '1;31',
        'purple' => '0;35',
        'light_purple' => '1;35',
        'brown' => '0;33',
        'yellow' => '1;33',
        'light_gray' => '0;37',
        'white' => '1;37',
    );
    $colored_string = "";
    if (isset($colors[$color])) {
        $colored_string .= "\033[" . $colors[$color] . "m";
    }
    $colored_string .= $text . "\033[0m";
    return $colored_string;
}

function week($year = null)
{
    $CI = &get_instance();
    $year = ($year) ? $year : date('Y');
    $week = $CI->db->get_where('ref_tanggal', ['year' => $year])->result();
    return $week;
}


function current_week($year = null)
{
    $year = ($year) ? $year : date('Y');
    if ($year == date('Y')) {
        $date = new DateTime(date('Y-m-d'));
    } elseif ($year < date('Y')) {
        $date = new DateTime($year . '-12-31');
    }
    return $date->format("W");
}

function generate_week($year = null)
{
    $CI = &get_instance();
    $year = ($year) ? $year : date('Y');
    // $year = 2027;
    $max_week[$year] = "01";
    for ($curr_month = 1; $curr_month <= 12; $curr_month++) {
        $week_month = 1;
        $curr_week = 0;
        $month = str_pad($curr_month, 2, "0", STR_PAD_LEFT);
        $first_date = "{$year}-{$month}-01";
        $last_date = date("Y-m-t", strtotime($first_date));
        $last_day = date("t", strtotime($first_date));
        for ($curr_day = 1; $curr_day <= $last_day; $curr_day++) {
            $day = str_pad($curr_day, 2, "0", STR_PAD_LEFT);
            $curr_date = "{$year}-{$month}-{$day}";
            $date = new DateTime($curr_date);
            if ($date->format("o") < $year) {
                $week = "01";
            } elseif ($date->format("o") > $year) {
                $week = $max_week[$year];
            } else {
                $week = $date->format("W");
                $max_week[$year] = $week;
            }
            if ($curr_week == 0) {
                $curr_week = $week;
            } elseif ($curr_week != $week) {
                $curr_week = $week;
                $week_month++;
            }
            $data[$year . $week]['dateid'] = $year . $week;
            $data[$year . $week]['year'] = $year;
            $data[$year . $week]['month'] = $month;
            $data[$year . $week]['week'] = $week;
            $data[$year . $week]['week_month'] = $week_month;
            $data[$year . $week]['first_date'] = (isset($data[$year . $week]['first_date']) and $data[$year . $week]['first_date'] < $curr_date) ? $data[$year . $week]['first_date'] : $curr_date;
            $data[$year . $week]['last_date'] = (isset($data[$year . $week]['last_date']) and $data[$year . $week]['last_date'] > $curr_date) ? $data[$year . $week]['last_date'] : $curr_date;
            $data[$year . $week]['list_date'][] = $curr_date;
            // echo "{$curr_date} - Weeknummer: $week";
            // echo "<br>";
        }
    }

    foreach ($data as $key => $value) {
        $data[$key]['list_date'] = implode(",", $value['list_date']);
    }

    $CI->db->delete('ref_tanggal', ['year' => $year]);
    $CI->db->insert_batch('ref_tanggal', $data);
}

function get_aspek($type, $key)
{
    $aspek = array(
        "kebijakan" => "Administrasi Kebijakan",
        "kelembagaan" => "Administrasi Kelembagaan",
        "pegawai" => "Administrasi Pegawai",
        "keuangan" => "Administrasi Keuangan",
        "barang" => "Administrasi Barang",
        "urusan" => "Urusan",
        "kinerja" => "Kinerja",
        "pengendalian" => "Sistem Pengendalian",
        "3e" => "Ekonomis Efisien Efektif",
        "kepatuhan" => "Kepatuhan",
        "perencanaan" => "Perencanaan",
        "pelaksanaan" => "Pelaksanaan",
        "pelaporan" => "Pelaporan"
    );
    $return = false;
    if ($type == "jenis") {
        $return = array_search($key, $aspek);
    } elseif ($type == "label") {
        $return = $aspek[$key];
    }
    return $return;
}


function is_json($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function escape_single_quote($string)
{
    return str_replace("'", "\'", $string);
}

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}

function newLine()
{
    $mode = php_sapi_name();
    if ($mode == "cli") {
        echo "\n";
    } else {
        echo "<br>";
    }
}

function flushOutput()
{
    $mode = php_sapi_name();
    if ($mode !== "cli") {
        ob_flush();
        flush();
    }
}