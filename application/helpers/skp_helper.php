<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function persen_nilai($target,$realisasi) {
        @$data = 100-($realisasi/$target*100);
        return $data;
    }

    function realisasi_persen_nilai($target,$realisasi,$condition=FALSE) {
        if ($condition) {
            @$data = 76-((((1.76*$target-$realisasi)/$target)*100)-100);
        } else {
            @$data = ((1.76*$target-$realisasi)/$target)*100;
        }
        return $data;
    }

    function nilai_indeks($target,$realisasi,$condition=FALSE)
    {
        if ($condition) {
            $persen_nilai = persen_nilai($target,$realisasi);
            if ($persen_nilai>24) {
                $data = realisasi_persen_nilai($target,$realisasi,TRUE);
            } else {
                $data = realisasi_persen_nilai($target,$realisasi,FALSE);
            }
        } else {
            $data = $realisasi/$target*100;
        }
        return $data;
    }

    function penghitungan_skp($target_output,$realisasi_output,$target_mutu,$realisasi_mutu,$target_waktu,$realisasi_waktu,$target_biaya,$realisasi_biaya)
    {
        $nilai_output   = nilai_indeks($target_output,$realisasi_output,FALSE);
        $nilai_mutu     = nilai_indeks($target_mutu,$realisasi_mutu,FALSE);
        $nilai_waktu    = nilai_indeks($target_waktu,$realisasi_waktu,TRUE);
        $nilai_biaya    = nilai_indeks($target_biaya,$realisasi_biaya,TRUE);
        if ($nilai_biaya>0) {
            $data = $nilai_output + $nilai_mutu + $nilai_waktu + $nilai_biaya;
        } else {
            $data = $nilai_output + $nilai_mutu + $nilai_waktu;
        }
        return $data;
    }

    function capaian_skp($target_output,$realisasi_output,$target_mutu,$realisasi_mutu,$target_waktu,$realisasi_waktu,$target_biaya,$realisasi_biaya)
    {
        $nilai_output   = nilai_indeks($target_output,$realisasi_output,FALSE);
        $nilai_mutu     = nilai_indeks($target_mutu,$realisasi_mutu,FALSE);
        $nilai_waktu    = nilai_indeks($target_waktu,$realisasi_waktu,TRUE);
        $nilai_biaya    = nilai_indeks($target_biaya,$realisasi_biaya,TRUE);
        if ($nilai_biaya>0) {
            $data = $nilai_output + $nilai_mutu + $nilai_waktu + $nilai_biaya;
            $data = $data/4;
        } else {
            $data = $nilai_output + $nilai_mutu + $nilai_waktu;
            $data = $data/3;
        }
        return $data;
    }

    function konversi_nilai_skp($nilai)
    {
        switch (TRUE) {
            case $nilai <= 50:
                $data = "Buruk";
                break;

            case $nilai <= 60:
                $data = "Sedang";
                break;

            case $nilai <= 75:
                $data = "Cukup";
                break;

            case $nilai <= 90.99:
                $data = "Baik";
                break;
            
            default:
                $data = "Sangat Baik";
                break;
        }
        return $data;
    }

    function konversi_nilai_kesenjangan($nilai)
    {
        switch (TRUE) {
            case $nilai < 50:
                $data = "Sangat Kurang";
                break;

            case $nilai < 70:
                $data = "Kurang";
                break;

            case $nilai < 90:
                $data = "Cukup";
                break;

            case $nilai < 120:
                $data = "Baik";
                break;
            
            default:
                $data = "Sangat Baik";
                break;
        }
        return $data;
    }

