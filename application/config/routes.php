<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin/login';
$route['login'] = 'admin/login';
$route['login/google'] = 'auth_oa2/session/google';
$route['logout'] = 'auth/logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['share/(:any)'] = 'share/index/$1';

$route['quick_view'] = 'berkas/quick_view';
$route['api/v1/user/login'] = 'api_user/login';
$route['api/v1/user/logout'] = 'api_user/logout';
$route['api/v1/user/change-password'] = 'api_user/change_password';
$route['api/v1/user/refresh-token'] = 'api_user/refresh_token';
$route['api/v1/user/get-notification'] = 'api_user/get_notification';
$route['api/v1/user/get-pengumuman'] = 'api_user/get_pengumuman';
$route['api/v1/user/profile'] = 'api_user/profile';

$route['api/v1/surat/masuk'] = 'api_surat/masuk';
$route['api/v2/surat/masuk'] = 'api_surat/masuk_v2';
$route['api/v1/surat/masuk/disposisi/get'] = 'api_surat/get_disposisi';
$route['api/v1/surat/masuk/detail'] = 'api_surat/get_detail_surat_masuk';

$route['api/v1/surat/keluar'] = 'api_surat/keluar';
$route['api/v1/surat/keluar/detail'] = 'api_surat/get_detail_surat_keluar';

$route['api/v1/surat/disposisi/get'] = 'api_surat/get_disposisi_surat';
$route['api/v1/surat/disposisi/masuk'] = 'api_surat/get_disposisi_masuk';
$route['api/v1/surat/disposisi/keluar'] = 'api_surat/get_disposisi_keluar';
$route['api/v1/surat/disposisi/add'] = 'api_surat/add_disposisi';
$route['api/v1/surat/disposisi/detail'] = 'api_surat/get_detail_disposisi_surat';
$route['api/v2/surat/disposisi/detail'] = 'api_surat/get_detail_disposisi_surat_v2';

$route['api/v1/surat/tembusan/get'] = 'api_surat/tembusan';
$route['api/v1/surat/tembusan/detail'] = 'api_surat/get_detail_tembusan';

$route['api/v1/surat/verifikasi/get'] = 'api_surat/get_verifikasi';
$route['api/v1/surat/verifikasi'] = 'api_surat/verifikasi';

$route['api/v1/surat/ttd/get'] = 'api_surat/get_ttd';

$route['api/v1/surat/ttd'] = 'api_surat/ttd';

$route['api/v1/surat/unread'] = 'api_surat/get_unread';

$route['api/v1/pegawai/get'] = 'api_pegawai/get_pegawai';

$route['api/v1/skpd/get'] = 'api_skpd/get_skpd';

// absen
$route['api/v1/absen/inquiry'] = 'api/absen/inquiry';
$route['api/v2/absen/inquiry'] = 'api/absen/inquiry_v2';
$route['api/v3/absen/inquiry'] = 'api/absen/inquiry_v3';
$route['api/v1/absen/insert-log'] = 'api/absen/insert_log';
$route['api/v2/absen/insert-log'] = 'api/absen/insert_log_v2';
$route['api/v1/absen/shift'] = 'api/absen/shift';
$route['api/v1/absen/change-shift'] = 'api/absen/change_shift';

// LKH
$route['api/v1/lkh/add'] = 'api/lkh/add';
$route['api/v1/lkh/edit'] = 'api/lkh/edit';
$route['api/v1/lkh/delete'] = 'api/lkh/delete';
$route['api/v1/lkh/verifikator'] = 'api/lkh/verifikator';
$route['api/v1/lkh/list'] = 'api/lkh/list';
$route['api/v2/lkh/list'] = 'api/lkh/list_v2';
$route['api/v1/lkh/verifikasi/list'] = 'api/lkh/verifikasi_list';
$route['api/v2/lkh/verifikasi/list'] = 'api/lkh/verifikasi_list_v2';
$route['api/v3/lkh/verifikasi/list'] = 'api/lkh/verifikasi_list_v3';
$route['api/v1/lkh/verifikasi'] = 'api/lkh/verifikasi';
$route['api/v2/lkh/verifikasi'] = 'api/lkh/verifikasi_v2';
$route['api/v1/lkh/rencana-hasil'] = 'api/lkh/rencana_hasil';
$route['api/v1/lkh/renaksi'] = 'api/lkh/renaksi';
$route['api/v1/lkh/detail/list'] = 'api/lkh/detail_list';


// Kepegawaian
$route['api/v2/pegawai/get'] = 'api/kepegawaian/pegawai/list';
$route['api/v2/skpd/get'] = 'api/kepegawaian/skpd/list';
$route['api/v1/jabatan'] = 'api/kepegawaian/jabatan/list';
$route['api/v1/jabatan/tersedia'] = 'api/kepegawaian/jabatan/tersedia';
$route['api/v1/jabatan/skpd'] = 'api/kepegawaian/jabatan/skpd';
$route['api/v1/jabatan/pejabat-ttd-proyeksi'] = 'api/kepegawaian/jabatan/pejabat_ttd_proyeksi';
$route['api/v1/jabatan/struktur'] = 'api/kepegawaian/jabatan/struktur';
$route['api/v1/jabatan/update'] = 'api/kepegawaian/jabatan/update';
$route['api/v1/proyeksi/validate'] = 'api/kepegawaian/proyeksi/validate';
$route['api/v1/proyeksi/release'] = 'api/kepegawaian/proyeksi/release';


$route['api/surat/ekosistem/klasifikasi-arsip'] = 'api/surat/klasifikasi';
$route['api/surat/ekosistem/tujuan'] = 'api/surat/tujuan';
$route['api/surat/ekosistem/jenis-naskah'] = 'api/surat/jenis';
$route['api/surat/ekosistem/sifat-naskah'] = 'api/surat/sifat';
$route['api/surat/ekosistem/jenis-lampiran'] = 'api/surat/jenis_lampiran';
$route['api/surat/ekosistem/kirim-naskah'] = 'api/surat/kirim';
$route['api/surat/ekosistem/cek-status'] = 'api/surat/cek_status';



// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/klasifikasi-arsip
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/tujuan
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/jenis-naskah
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/sifat-naskah
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/jenis-lampiran
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/kirim-naskah
// https: //e-office.sumedangkab.go.id/api/surat/ekosistem/cek-status
