<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function skor_pendidikan($jenjang,$akreditasi,$ipk)
{
    switch ($jenjang) {
        //D3
        case 30:
            $poin = 60;
            break;
        //D4
        case 35:
            $poin = 80;
            break;
        //S1
        case 40:
            $poin = 80;
            break;
        //S2
        case 45:
            $poin = 90;
            break;
        //S3
        case 50:
            $poin = 100;
            break;
        
        default:
            $poin = 0;
            break;
    }

    switch ($akreditasi) {
        case 'A':
            $angka = 100;
            break;
        case 'B':
            $angka = 80;
            break;
        case 'C':
            $angka = 60;
            break;
        case 'LN':
            $angka = 100;
            break;
        default:
            $angka = 0;
            break;
    }

    $skor = ($ipk>0) ? ($poin+$angka+($ipk*25))/3 : 0;

    return $skor;
}

function skor_pendidikan_old($jenjang,$akreditasi,$ipk)
{
    switch ($jenjang) {
        //D3
        case 30:
            switch ($akreditasi) {
                case 'A':
                    $poin = 25;
                    break;
                case 'B':
                    $poin = 20;
                    break;
                case 'C':
                    $poin = 15;
                    break;
                case 'LN':
                    $poin = 25;
                    break;
                default:
                    $poin = 15;
                    break;
            }
            break;
        //D4
        case 35:
            switch ($akreditasi) {
                case 'A':
                    $poin = 35;
                    break;
                case 'B':
                    $poin = 25;
                    break;
                case 'C':
                    $poin = 20;
                    break;
                case 'LN':
                    $poin = 35;
                    break;
                default:
                    $poin = 20;
                    break;
            }
            break;
        //S1
        case 40:
            switch ($akreditasi) {
                case 'A':
                    $poin = 50;
                    break;
                case 'B':
                    $poin = 40;
                    break;
                case 'C':
                    $poin = 30;
                    break;
                case 'LN':
                    $poin = 60;
                    break;
                default:
                    $poin = 30;
                    break;
            }
            break;
        //S2
        case 45:
            switch ($akreditasi) {
                case 'A':
                    $poin = 80;
                    break;
                case 'B':
                    $poin = 70;
                    break;
                case 'C':
                    $poin = 60;
                    break;
                case 'LN':
                    $poin = 90;
                    break;
                default:
                    $poin = 60;
                    break;
            }
            break;
        //S3
        case 50:
            switch ($akreditasi) {
                case 'A':
                    $poin = 90;
                    break;
                case 'B':
                    $poin = 80;
                    break;
                case 'C':
                    $poin = 70;
                    break;
                case 'LN':
                    $poin = 100;
                    break;
                default:
                    $poin = 70;
                    break;
            }
            break;
        
        default:
            $poin = 0;
            break;
    }

    $skor = ($ipk>0) ? $poin*$ipk : $poin;

    return $skor;
}

function skor_pelatihan($eselon,$list_diklat,$pelatihan,$workshop)
{
    switch ($eselon) {
        //Eselon IV
        case '42':
        case '41':
            $limit = [2,3,4,5];
            break;

        //Eselon III
        case '32':
        case '31':
            $limit = [3,4,5];
            break;

        //Eselon II
        case '22':
        case '21':
            $limit = [4,5];
            break;
        
        default:
            $limit = [];
            break;
    }
    
    $diklat = 0;
    foreach ($list_diklat as $row) {
        if(in_array($row->kode_latihan,$limit)){
            $diklat++;
        }
    }

    $skor = 0;
    if ($diklat>0) {
      $skor += 50;  
    }
    if ($pelatihan >20) {
      $skor += 30;  
    }
    if ($workshop>0) {
      $skor += 20;  
    }
    // if ($diklat>0 AND $pelatihan>20) {
    //     $skor = 80;
    // } elseif ($diklat>0) {
    //     $skor = 40;
    // } elseif ($pelatihan>20) {
    //     $skor = 20;
    // } else {
    //     $skor = 0;
    // }

    // if ($workshop>10) {
    //     $skor += 20;
    // } elseif ($workshop>5) {
    //     $skor += 10;
    // } elseif ($workshop>0) {
    //     $skor += 5;
    // }

    return $skor;
}

function skor_prestasi($prestasi)
{
    $skor = $skor_max = 0;
    foreach ($prestasi as $row) {
        if ($row->medali == "Meraih") {
           if ($row->kelas_prestasi == "IN" OR $row->kelas_prestasi == "NS") {
               $skor = 100;
           } elseif ($row->kelas_prestasi == "PR") {
               $skor = 80;
           } elseif ($row->kelas_prestasi == "KB") {
               $skor = 60;
           } else {
               $skor = 40;
           }
        } elseif ($row->medali == "Nominator") {
           if ($row->kelas_prestasi == "IN" OR $row->kelas_prestasi == "NS") {
               $skor = 75;
           } elseif ($row->kelas_prestasi == "PR") {
               $skor = 50;
           } elseif ($row->kelas_prestasi == "KB") {
               $skor = 35;
           } else {
               $skor = 20;
           }
        }
        $skor_max = ($skor > $skor_max) ? $skor : $skor_max;
    }

    return $skor_max;
}

function skor_penugasan($penugasan)
{
    // print_r($penugasan); die();
    $skor = $tim1 = $tim2 = $tim3 = $mandiri1 = $mandiri2 = $mandiri3 = 0;
    foreach ($penugasan as $row) {
        if ($row->jenis_penugasan == "Tim") {
            if ($row->kode_penugasan == 1) {
                $tim1++;
            } elseif ($row->kode_penugasan == 2) {
                $tim2++;
            } elseif ($row->kode_penugasan == 3) {
                $tim3++;
            }
        } elseif ($row->jenis_penugasan == "Mandiri") {
            if ($row->kode_penugasan == 1) {
                $mandiri1++;
            } elseif ($row->kode_penugasan == 2) {
                $mandiri2++;
            } elseif ($row->kode_penugasan == 3) {
                $mandiri3++;
            }
        }
    }

    if ($tim1 > 2) {
        $skor += 45;
    } elseif ($tim1 > 0) {
        $skor += 40;
    }

    if ($tim2 > 2) {
        $skor += 35;
    } elseif ($tim2 > 0) {
        $skor += 30;
    }

    if ($tim3 > 2) {
        $skor += 20;
    } elseif ($tim3 > 0) {
        $skor += 15;
    }

    if ($mandiri1 > 2) {
        $skor += 45;
    } elseif ($mandiri1 > 0) {
        $skor += 40;
    }

    if ($mandiri2 > 2) {
        $skor += 35;
    } elseif ($mandiri2 > 0) {
        $skor += 30;
    }

    if ($mandiri3 > 2) {
        $skor += 20;
    } elseif ($mandiri3 > 0) {
        $skor += 15;
    }

    $data['skor'] = $skor/2;
    $data['tim1'] = $tim1;
    $data['tim2'] = $tim2;
    $data['tim3'] = $tim3;
    $data['mandiri1'] = $mandiri1;
    $data['mandiri2'] = $mandiri2;
    $data['mandiri3'] = $mandiri3;

    return $data;
}

function skor_kedisiplinan($tingkat)
{
    if ($tingkat == "B") {
        $skor = 0;
    } elseif ($tingkat == "S") {
        $skor = 20;
    } elseif ($tingkat == "R") {
        $skor = 40;
    } else {
        $skor = 100;
    }

    return $skor;
}

function skor_absensi_terlambat($terlambat)
{
    if ($terlambat >= 0 AND $terlambat < 60) {
        $skor = 100;
    } elseif ($terlambat >= 60 AND $terlambat < 120) {
        $skor = 80;
    } elseif ($terlambat >= 120 AND $terlambat < 180) {
        $skor = 60;
    } elseif ($terlambat >= 180 AND $terlambat < 240) {
        $skor = 40;
    } elseif ($terlambat >= 240 AND $terlambat < 300) {
        $skor = 20;
    } elseif ($terlambat >= 300) {
        $skor = 0;
    } else {
        $skor = 0;
    }

    return $skor;
}

function skor_absensi_absen($absen)
{
    if ($absen >= 0 AND $absen < 3) {
        $skor = 100;
    } elseif ($absen >= 3 AND $absen < 6) {
        $skor = 50;
    } elseif ($absen > 6) {
        $skor = 0;
    } else {
        $skor = 0;
    }

    return $skor;
}