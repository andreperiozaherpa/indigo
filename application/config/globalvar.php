<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Konfigurasi Variabel
$globalvar = array();

$globalvar['frekuensi_indikator'] = array(
	'BL'	=> 'Bulan',
	'TW'	=> 'Triwulan',
	'SM'	=> 'Semester',
	'TH'	=> 'Tahun',
);

$globalvar['perhitungan_indikator'] = array(
	'AK'		=> 'Akumulasi',
	'RR'		=> 'Rata – rata',
	'SP'		=> 'Sama Persis',
	'KO'		=> 'Kontribusi',
	'KS'		=> 'KPI Sendiri',
);

$globalvar['validasi_indikator'] = array(
	'LI'		=> 'Lead Input',
	'LP'		=> 'Lead Proses',
	'LOP'		=> 'Lag Output',
	'LOC'		=> 'Lag Outcome',
);

$globalvar['metode_penurunan'] = array(
	'AL'		=> 'Adobe Langsung',
	'KP'		=> 'Komponen Pembentuk',
	'DS'		=> 'Dipersempit',
	'TD'		=> 'Tidak diturunkan',
);

$globalvar['status_data'] = array(
	'PRD'		=> 'Hasil Perhitungan Raw Data',
	'RD'		=> 'Raw Data',
);

$globalvar['polarisasi'] = array(
	'MAX'		=> 'Maximize',
	'MIN'		=> 'Minimize',
	'STA'		=> 'Stabilize',
);

$globalvar['bulan'] = array(
	1			=> 'Januari',
	2			=> 'Februari',
	3 			=> 'Maret',
	4 			=> 'April',
	5 			=> 'Mei',
	6 			=> 'Juni',
	7			=> 'Juli',
	8 			=> 'Agustus',
	9 			=> 'September',
	10 			=> 'Oktober',
	11 			=> 'Nopember',
	12 			=> 'Desember',
);
$globalvar['status_capaian'] = array(
	0 => 'Belum disetujui',
	1 => 'Disetujui',
);
$globalvar['max_capaian'] = 100;
define('GLOBALVAR',$globalvar);