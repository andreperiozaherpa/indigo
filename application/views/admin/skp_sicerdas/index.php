<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">SKP</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <?php echo breadcrumb($this->uri->segment_array()); ?>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
<?php 
  if(empty($id_unit_kerja) && $pegawai->kepala_skpd !== "Y"){
    ?>
    <center>
      <h4>Anda belum memiliki Unit Kerja</h4>
      <p>Klik tombol dibwah untuk mengubah Unit Kerja</p>
      <a href="<?=base_url('pengaturan_akun')?>" class="btn btn-primary">Pengaturan Akun</a>
    </center>
    <?php
  }else{

?>

  <div class="row">
    <div class="white-box">
      <div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
        <div class="overlay-box">
          <div class="col-md-3">
            <div class="user-content"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/<?= $pegawai->foto_pegawai ?>" class="thumb-lg img-circle" style=" object-fit: cover;
            width: 80px;
            height: 80px;border-radius: 50%;
            " alt="img">
            <h5 class="text-white"><b><?= $pegawai->nama_lengkap ?></b></h5>
            <h6 class="text-white"><?= $pegawai->nip ?></h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>SKPD</b></h5>
            <h6 class="text-white"><?= $pegawai->nama_skpd ?></h6>
          </div>
        </div>
        <div class="col-md-3" style="border-right: 1px solid grey;">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Unit Kerja</b></h5>
            <h6 class="text-white"><?= $pegawai->nama_unit_kerja ?></h6>
          </div>
        </div>
        <div class="col-md-3">
          <br>
          <div class="user-content" style="padding-bottom:15px;">
            <h5 class="text-white"><b>Jabatan</b></h5>
            <h6 class="text-white"><?= $pegawai->jabatan ?></h6>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="row">

    <?php
    for ($tahun = 2022; $tahun <= 2023; $tahun++) {
      if ($pegawai->jenis_pegawai == "staff"||$pegawai->jenis_pegawai == "") {
        $capaian  = 0;
        $total_pk = 0;
        $total_renaksi = 0;
        $total_anggaran = 0;

        $sasaran = $this->skp_model->get_sasaran($id_pegawai,$id_unit_kerja,$tahun);
        $total_pk = count($sasaran);
        foreach($sasaran as $ss){
          $indikator = $this->skp_model->get_indikator($ss->id_sasaran_skp);
          foreach($indikator as $i){
            $total_renaksi += 1;
            $capaian += $i->capaian;
            $total_anggaran += $i->anggaran;
          }
        }

        if($capaian==0||$total_renaksi==0){
          $jumlah_indeks = 0;
        } else{
          $jumlah_indeks = $capaian/$total_renaksi;
        }

        ?>
        
        <div class="col-md-12">
          <a href="<?= base_url(); ?>skp_sicerdas/detail/<?= $tahun ?>">
            <div class="panel panel-primary">
              <div class="panel-heading">
                Sasaran Kinerja Pegawai <?= $tahun ?> <span class="label label-<?= $tahun == date('Y') ? "info" : "danger" ?> m-l-5 pull-right"><?= $tahun == date('Y') ? "Aktif" : "Nonaktif" ?></span> </div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="col-sm-2 b-r text-center" style="max-height:110px;">

                    <div data-label="<?= isset($jumlah_indeks) ? round($jumlah_indeks, 1) : 0; ?>%" class="css-bar css-bar-<?= isset($jumlah_indeks) ? $jumlah_indeks >= 100 ? 100 :  roundfive($jumlah_indeks) : 0; ?> css-bar-lg"></div>
                  </div>

                  <div class="col-sm-2 b-r text-center">
                    <br>
                    <h3 class="panel-title"><?= $total_pk ?></h3>
                    Sasaran Strategis
                    <br>
                    &nbsp
                  </div>

                  <div class="col-sm-2 b-r text-center">
                    <br>
                    <h3 class="panel-title"><?= $total_renaksi ?></h3>
                    Indikator Sasaran
                    <br>
                    &nbsp
                  </div>

                  <div class="col-sm-6 b-r text-center">
                    <br>
                    <h3 class="panel-title"><?= rupiah($total_anggaran) ?></h3>
                    Total Anggaran
                    <br>
                    &nbsp
                  </div>
                </div>
              </div>
            </div>

          </a>
        </div>
        <?php
      } else {
        $empty = true;
        $total_pk = 0;
        $total_anggaran = 0;
        $total_renaksi = 0;
        foreach ($jenis as $j => $v) {
          if ($pegawai->kepala_skpd == "Y") {
            $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
            $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
          } else {
            $sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
            $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
          }
          $sasaran = array_merge($sasaran, $sasaran_inisiatif);
          if (!empty($sasaran)) {
            $empty = false;
          }

          $total_pk += count($sasaran);
        }
        if (!$empty) {
          $total_indeks = 0;
          $jumlah_jenis = 0;
          foreach ($jenis as $j => $v) {
            $name = $this->renja_perencanaan_model->name($j);
            if ($pegawai->kepala_skpd == "Y") {
              $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
              $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
            } else {
              $sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
              $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
            }
            $sasaran = array_merge($sasaran, $sasaran_inisiatif);
            if (!empty($sasaran)) {
    ?>
              <?php
              $no = 1;
              foreach ($sasaran as $s) {
                $jumlah_jenis++;
                $tSasaran = $name['tSasaran'];
                $cSasaran = $name['cSasaran'];
                $cSasaranInisiatif = $name['cSasaranInisiatif'];
                if ($pegawai->kepala_skpd == "Y") {
                  if (!empty($s->inisiatif)) {
                    $iku = $this->renja_perencanaan_model->get_iku_inisiatif_skpd($j, $s->$cSasaranInisiatif, $tahun, $id_skpd);
                  } else {
                    $iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
                  }
                } else {
                  if (!empty($s->inisiatif)) {
                    $iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $id_unit_kerja);
                  } else {
                    $iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $id_unit_kerja);
                  }
                }
              ?>
                <?php

                $capaian = array();
                foreach ($iku as $i) :
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
                  $total_renaksi += count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));
                endforeach;
                $t_iku = count($iku) * 100;
                if ($t_iku == 0) $t_iku = 1;
                $t_hasil = array_sum($capaian);
                $t_indeks = ($t_hasil / $t_iku) * 100;
                $t_indeks_ =  number_format($t_indeks, 1);
                $t_sasaran = count($s) * 100;
                $tt_indeks_ = ($t_indeks_ / $t_sasaran) * 100;
                $ts_indeks_[$tSasaran] = $tt_indeks_;
                $total_indeks += $tt_indeks_;
                ?>
                <?php
                $n = 1;
                $tIku = $name['tIku'];
                $cIku = $name['cIku'];
                $cIkuRenja = $name['cIkuRenja'];
                $taIkuRenja = $name['taIkuRenja'];
                $aIkuRenja = $name['aIkuRenja'];
                $rIkuRenja = $name['rIkuRenja'];
                foreach ($iku as $i) {
                  if ($pegawai->kepala_skpd == "Y") {
                    $rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd);
                  } else {
                    $rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd, $id_unit_kerja);
                  }
                  foreach ($rka as $r) {
                    $total_anggaran += $r->anggaran;
                  }
                  $unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
                  $a_unit_kerja = array();
                  foreach ($unit_kerjaz as $uu) {
                    $a_unit_kerja[] = $uu->nama_unit_kerja;
                  }
                  $unit_kerjaz = implode(', ', $a_unit_kerja);
                  $target = $i->$taIkuRenja;
                  $realisasi = $i->$rIkuRenja;
                  $pola = $i->polorarisasi;

                  $capaian = $i->capaian; //(?) get_capaian($target,$realisasi,$pola);
                ?>

                <?php $n++;
                } ?>

                <!-- <strong style="color:#3F0090;"><?= $v ?></strong><br><br> -->
                <!-- <div data-label="<?= isset($tt_indeks_) ? $tt_indeks_ : 0; ?>%" class="css-bar css-bar-<?= isset($tt_indeks_) ? roundfive($tt_indeks_) : 0; ?> css-bar-lg"></div> -->
        <?php $no++;
              }
            }
          }

          $jumlah_indeks = $total_indeks / $jumlah_jenis;
        } else {
          $jumlah_indeks = 0;
        }
        ?>
        <div class="col-md-12">
          <a href="<?= base_url(); ?>skp_sicerdas/detail/<?= $tahun ?>">
            <div class="panel panel-primary">
              <div class="panel-heading">
                Sasaran Kinerja Pegawai <?= $tahun ?> <span class="label label-<?= $tahun == date('Y') ? "info" : "danger" ?> m-l-5 pull-right"><?= $tahun == date('Y') ? "Aktif" : "Nonaktif" ?></span> </div>
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="col-sm-2 b-r text-center" style="max-height:110px;">

                    <div data-label="<?= isset($jumlah_indeks) ? round($jumlah_indeks, 1) : 0; ?>%" class="css-bar css-bar-<?= isset($jumlah_indeks) ? $jumlah_indeks >= 100 ? 100 :  roundfive($jumlah_indeks) : 0; ?> css-bar-lg"></div>
                  </div>

                  <div class="col-sm-6 b-r text-center">
                    <br>
                    <h3 class="panel-title">60<small class="text-dark">/60</small></h3>
                    Realisasi SKP
                    <br>
                    &nbsp
                  </div>

                  <div class="col-sm-2 b-r text-center">
                    <br>
                    <h3 class="panel-title"><?= $total_pk ?></h3>
                    Perencanaan SKP
                    <br>
                    &nbsp
                  </div>

                  <div class="col-sm-2 b-r text-center">
                    <br>
                    <h3 class="panel-title"><?= $total_renaksi ?></h3>
                    Tugas Tambahan SKP
                    <br>
                    &nbsp
                  </div>
                </div>
              </div>
            </div>

          </a>
        </div>
    <?php
      }
    }
    ?>

  </div>

<?php } ?>