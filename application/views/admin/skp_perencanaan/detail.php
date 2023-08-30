<style type="text/css">
  tr.pt-tr td {
    padding-top: 30px !important;
  }
  .pt-tr {
    background: #eee;
    border-top: 2px solid #6003c8;
  }
</style>

<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran Kinerja Pegawai</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>/skp_perencanaan">Sasaran Kinerja Pegawai</a></li>
        <li class="active">List</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

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
</div>
<div class="row">

  <div class="white-box">
    <h3 class="box-title">DAFTAR KEGIATAN TAHUN <?=$this->uri->segment(3)?> <a href="<?=base_url('skp_perencanaan/detail_bulanan/'.$this->uri->segment(3))?>" class="btn btn-primary btn-outline pull-right" style="margin-right: -7px"><i class="fa fa-folder"></i> Rincian SKP Bulanan</a> <a href="<?=base_url('skp_perencanaan/kesenjangan_kinerja/'.$this->uri->segment(3))?>" class="btn btn-primary btn-outline pull-right m-r-10" style="margin-right: -7px"><i class="fa fa-file"></i> Informasi kesenjangan Kinerja</a></h3>

    <?php

    $empty = true;
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
        ?>
        <!-- <strong style="color:#3F0090;">Capaian Sasaran</strong><br><br> -->
        <?php
        $jumlah_indeks = $total_indeks / $jumlah_jenis;
        ?>
        <!-- <div data-label="<?= isset($jumlah_indeks) ? round($jumlah_indeks, 1) : 0; ?>%" class="css-bar css-bar-<?= isset($jumlah_indeks) ? roundfive($jumlah_indeks) : 0; ?> css-bar-lg"></div> -->
        <?php
      } else {
        ?>
        <!-- <div data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div> -->
        <?php
      } ?>
      <?php
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
          <div class="row" style="position: relative;">
            <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
            <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
              <span style="font-weight: 450;text-transform: uppercase;"><?= $v ?></span>
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle pull-right" type="button" style="position: absolute; right: 0; top: 8.5px"><i class="fa fa-print"></i> Cetak SKP</button>
              <ul role="menu" class="dropdown-menu" style="right: 0; left: unset; top: 95%;">
                  <li><a href="<?=base_url('skp_perencanaan/cetak/'.$this->uri->segment(3))?>">Perencanaan</a></li>
                  <li><a href="<?=base_url('skp_perencanaan/cetak/'.$this->uri->segment(3).'/penilaian')?>">Penilaian</a></li>
              </ul>
            </div>
          </div>
          <?php
          $no = 1;
          foreach ($sasaran as $s) {
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
            if (!empty($s->inisiatif)) {
              ?>

              <div class="row" style="margin-top: 30px;background-color:#eee8f4;padding:10px;border-radius:3px">
                <p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?></span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->nama_sasaran ?> <span class="label label-success">Inisiatif</span></p>
                <?php
              } else {
                ?>
                <div class="row" style="margin-top: 30px">
                  <p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?></span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->$tSasaran ?> </p>
                  <?php
                }
                ?>
                <div class="table-responsive">
                  <table class="table color-table muted-table">
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian Iku</th>
                        <th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
                        <th colspan="2" style="vertical-align: middle;text-align: center;">Indikator</th>
                        <th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Target</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
                        <th style="vertical-align: middle;text-align: center;width:100px">Anggaran</th>
                        <th style="vertical-align: middle;text-align: center;width:82px">Polarisasi</th>
                        <!-- <th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th> -->
                        <th style="vertical-align: middle;text-align: center;width:70px">Jml Renaksi</th>
                        <!-- <th style="vertical-align: middle;text-align: center">Jenis Casecading</th> -->
                        <th style="vertical-align: middle;text-align: center;width:200px">Casecading ke</th>
                      </tr>
                    </thead>
                    <tbody>
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
                        $total_rka[$i->$cIkuRenja] = 0;
                        foreach ($rka as $r) {
                          $total_rka[$i->$cIkuRenja] += $r->anggaran;
                        }


                        $unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
                        $a_unit_kerja = array();
                        foreach ($unit_kerjaz as $uu) {
                          $a_unit_kerja[] = $uu->nama_unit_kerja;
                        }
                        $unit_kerjaz = implode(', ', $a_unit_kerja);
                        if (strlen($unit_kerjaz) >= 100) {
                          $unit_kerjaz = substr($unit_kerjaz, 0, 100) . " ...";
                        }
                        $target = $i->$taIkuRenja;
                        $realisasi = $i->$rIkuRenja;
                        $pola = $i->polorarisasi;

                        $jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));
                        // $capaian = get_capaian($target,$realisasi,$pola);
                        $capaian = $i->capaian;

                        $urtug = $this->db->get_where('iku_urtug', array('jenis_renja' => $j, 'id_iku_renja' => $i->$cIkuRenja, 'id_pegawai_input' => $id_pegawai))->result();
                        ?>
                        <tr id="iku_<?= $i->$cIkuRenja ?>" class="pt-tr">
                          <td><span class="badge badge-warning" style="min-width:50px"><?=round($capaian,2)?></span></td>
                          <td class="text-center"><?= $no ?>.<?= $n ?></td>
                          <td colspan="2"><?= $i->$tIku ?></td>
                          <td class="text-center"><?= $i->satuan ?></td>
                          <td class="text-right"><?= $i->$taIkuRenja ?></td>
                          <td class="text-right"><?= $i->$rIkuRenja ?></td>
                          <td class="text-right"><?= number_format(round($total_rka[$i->$cIkuRenja])) ?></td>
                          <td class="text-center"><?= $i->polorarisasi ?></td>
                          <!-- <td><?= $i->bobot_tertimbang ?>%</td> -->
                          <td class="text-right"><?= $jml_renaksi ?></td>
                          <!-- <td><?= $i->jenis_casecading ?></td> -->
                          <td><?= $unit_kerjaz ?></td>
                        </tr>

                        <tr>
                          <td colspan="2">
                            <button class="btn btn-primary btn-block btn-sm btn-rounded" data-toggle="modal" data-target="#AddModal<?=$i->$cIkuRenja?>"><i class="fa fa-plus"></i></button>
                          </td>
                          <td class="" colspan="8"><h4 style="margin: 5px 0;">KEGIATAN TUGAS JABATAN</h4></td>
                          <td>
                              <!-- <button type="button" class="btn btn-primary btn-block btn-sm"><i class="fa fa-print"></i> Cetak SKP</button> -->
                          </td>
                        </tr>

                        

                        <?php $nu=1; foreach ($urtug as $u): ?>
                        <tr id="urtug_<?= $u->id_urtug ?>">
                          <td rowspan="5"><span class="badge badge-warning" style="min-width:50px"><?=round($u->capaian,2)?></span></td>
                          <td rowspan="5" class="text-center"><?= $nu ?></td>
                          <td rowspan="5"><?= $u->kegiatan_tugas_jabatan ?></td>
                          <td class="text-right"><b>Kuantitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kuantitas_target ?></td>
                          <td class="text-right"><?= $u->kuantitas_realisasi ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td rowspan="5">
                            <blockquote><?= $u->status_kegiatan ?></blockquote>
                            <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                              <input type="hidden" name="id_urtug" value="<?=$u->id_urtug?>">
                            <?php if ($u->status_kegiatan == "Perencanaan"): ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#EditModal<?=$u->id_urtug?>"><i class="fa fa-pencil"></i> Ubah Target</button>
                              <button type="button" class="btn btn-primary btn-block btn-sm" onclick="simpan_perencanaan(<?=$u->id_urtug?>)"><i class="fa fa-check"></i> Simpan Perencanaan</button>
                              <button type="button" class="btn btn-danger btn-block btn-sm" onclick="hapus_kegiatan(<?=$u->id_urtug?>)"><i class="fa fa-trash"></i> Hapus Kegiatan</button>
                              <button type="submit" class="hidden" name="set" id="submit_set<?=$u->id_urtug?>"></button>
                              <button type="submit" class="hidden" name="delete" id="submit_delete<?=$u->id_urtug?>"></button>
                            <?php elseif ($u->status_kegiatan == "Realisasi"): ?>
                              <?php if ($j): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#SubModal<?=$u->id_urtug?>"><i class="fa fa-list"></i> Casecading ke</button>
                              <?php endif ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#UpdateModal<?=$u->id_urtug?>"><i class="fa fa-edit"></i> Update Realisasi</button>
                              <?php if ($u->kuantitas_realisasi!=''): ?>
                              <button type="button" class="btn btn-success btn-block btn-sm" onclick="simpan_skp(<?=$u->id_urtug?>)"><i class="fa fa-location-arrow"></i> Simpan SKP</button>
                              <?php endif ?>
                              <button type="submit" class="hidden" name="save" id="submit_save<?=$u->id_urtug?>"></button>
                            <?php elseif ($u->status_kegiatan == "Mutasi"): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#AddModal<?=$i->$cIkuRenja?>"><i class="fa fa-refresh"></i> Ambil Alih Kegiatan</button>
                            <?php elseif ($u->status_kegiatan == "Selesai"): ?>
                              <?php if ($j): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#SubModal<?=$u->id_urtug?>"><i class="fa fa-list"></i> Casecading ke</button>
                              <?php endif ?>
                            <?php else: ?>
                            <?php endif ?>
                            </form>
                            <?php if ($u->kuantitas_realisasi>0): ?>
                              <div class="white-box text-center" style="border: #ff6849 1px solid;border-radius: 50%;margin: 5%;">
                                <h1 class="counter"><?=round($u->capaian,2)?></h1>
                                <p class="text-muted"><?=strtoupper(konversi_nilai_skp($u->capaian))?></p>
                              </div>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kualitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kualitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kualitas_target ?></td>
                          <td class="text-right"><?= $u->kualitas_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Waktu</b></td>
                          <td class="text-center"><?= convert_satuan($u->waktu_satuan) ?></td>
                          <td class="text-right"><?= $u->waktu_target ?></td>
                          <td class="text-right"><?= $u->waktu_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Biaya</b></td>
                          <td class="text-center"><?= convert_satuan($u->biaya_satuan) ?></td>
                          <td class="text-right"><?= dot($u->biaya_target) ?></td>
                          <td class="text-right"><?= @dot($u->biaya_realisasi) ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Tgl. Update</b></td>
                          <td></td>
                          <td class="text-right"><?= tgl_indo($u->tanggal_perencanaan) ?></td>
                          <td class="text-right"><?= @tgl_indo($u->tanggal_realisasi) ?></td>
                        </tr>

                        <?php 
                          $sub_kegiatan = $this->db->group_by('tanggal_perencanaan')->get_where('iku_urtug',array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc'))->result();
                        ?>
                        <?php $nus=1; foreach ($sub_kegiatan as $sk): ?>

                        <?php 
                          $sub_casecading = $this->db->limit(4,0)->join('pegawai', 'pegawai.id_pegawai = iku_urtug.id_pegawai_input', 'left')->get_where('iku_urtug', array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc', 'tanggal_perencanaan' => $sk->tanggal_perencanaan))->result();
                          $sca = $this->db->get_where('iku_urtug', array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc', 'tanggal_perencanaan' => $sk->tanggal_perencanaan))->result();
                          $scl = array();
                          foreach ($sca as $row) {
                            $scl[] = $row->id_pegawai_input;
                          }
                          $sc = $sub_casecading;
                        ?>

                        <tr id="sub_urtug_<?= $sk->id_urtug ?>">
                          <td rowspan="6"><span class="badge badge-inverse" style="min-width:50px">SUB</span></td>
                          <td rowspan="6" class="text-center"><?= $nu.'.'.$nus ?></td>
                          <td rowspan="6"><?= $sk->kegiatan_tugas_jabatan ?></td>
                          <td class="text-right"><b>Casecading ke</b></td>
                          <td colspan="2"></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                          <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                            <td class="text-right" style="white-space: nowrap;">
                              <?php if(@$sc[$ic]->status_kegiatan == "Mutasi"): ?>
                                <s class="text-danger"><?= @$sc[$ic]->nama_lengkap; ?></s>
                              <?php else: ?>
                                <?= @$sc[$ic]->nama_lengkap; ?>
                              <?php endif ?> 
                              <?php if(@$sc[$ic]->status_kegiatan == "Mutasi"): ?>
                                <button type="button" class="btn btn-xs btn-info btn-outline"><i class="fa fa-pencil"></i></button>
                              <?php endif ?> 
                              <?php if(isset($sc[$ic]) AND $sc[$ic]->status_kegiatan != "Selesai"): ?>
                                  <button type="button" class="btn btn-xs btn-danger btn-outline" onclick="remove_sub(<?=$sc[$ic]->id_urtug?>)"><i class="fa fa-times"></i></button>
                                  <input type="hidden" name="id_urtug" value="<?=$sc[$ic]->id_urtug?>">
                                  <button type="submit" class="hidden" name="removesub" id="submit_removesub<?=$sc[$ic]->id_urtug?>"></button>
                              <?php endif ?>
                            </td>
                          </form>
                          <?php } ?>
                          <td rowspan="6">
                            <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                              <input type="hidden" name="id_iku_renja" value="<?=$sk->id_iku_renja?>">
                              <input type="hidden" name="tanggal_perencanaan" value="<?=$sk->tanggal_perencanaan?>">
                              <button type="button" class="btn btn-sm btn-primary btn-block btn-outline" data-toggle="modal" data-target="#AddSubModal<?=$sk->id_urtug?>"><i class="fa fa-plus"></i> Tambah Casecading</button>
                              <button type="button" class="btn btn-sm btn-info btn-block btn-outline" data-toggle="modal" data-target="#EditSubModal<?=$sk->id_urtug?>"><i class="fa fa-edit"></i> Edit Sub</button>
                              <button type="button" class="btn btn-sm btn-danger btn-block btn-outline" onclick="hapus_sub(<?=$sk->id_urtug?>)"><i class="fa fa-trash"></i> Hapus Sub</button>
                              <button type="submit" class="hidden" name="deletesub" id="submit_deletesub<?=$sk->id_urtug?>"></button>
                            </form>
                          </td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kuantitas</b></td>
                          <td class="text-center"><?= convert_satuan($sk->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $sk->kuantitas_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->kuantitas_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kualitas</b></td>
                          <td class="text-center"><?= convert_satuan($sk->kualitas_satuan) ?></td>
                          <td class="text-right"><?= $sk->kualitas_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->kualitas_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Waktu</b></td>
                          <td class="text-center"><?= convert_satuan($sk->waktu_satuan) ?></td>
                          <td class="text-right"><?= $sk->waktu_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->waktu_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Biaya</b></td>
                          <td class="text-center"><?= convert_satuan($sk->biaya_satuan) ?></td>
                          <td class="text-right"><?= dot($sk->biaya_target) ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?php if(isset($sc[$ic])): ?><?= @dot($sc[$ic]->biaya_realisasi); ?><?php endif ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Tgl. Update</b></td>
                          <td></td>
                          <td class="text-right"><?= tgl_indo($sk->tanggal_perencanaan) ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @tgl_indo($sc[$ic]->tanggal_realisasi); ?></td>
                          <?php } ?>
                        </tr>

                        <div class="modal fade" id="EditSubModal<?=$sk->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Edit Sub Kegiatan</h4>
                              </div>
                              <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>
                                  <input type="hidden" name="tanggal_perencanaan" value="<?= $sk->tanggal_perencanaan ?>" required>

                                  <div class="well">
                                    <p>Indikator: <b><?= $u->kegiatan_tugas_jabatan ?></b></p>
                                    <p>Kuant/Output: <b><?= $u->kuantitas_target ?> <?= convert_satuan($u->kuantitas_satuan) ?></b></p>
                                    <p>Kual/Mutu: <b><?= $u->kualitas_target ?> <?= convert_satuan($u->kualitas_satuan) ?></b></p>
                                    <p>Waktu: <b><?= $u->waktu_target ?> <?= convert_satuan($u->waktu_satuan) ?></b></p>
                                    <p>Biaya: <b><?= convert_satuan($u->biaya_satuan) ?> <?= $u->biaya_target ?></b></p>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan untuk Bawahan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"><?= $sk->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $sk->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $sk->kuantitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $sk->kualitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $sk->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $sk->waktu_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $sk->biaya_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="editsub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="AddSubModal<?=$sk->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Tambah Casecading</h4>
                              </div>
                              <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>
                                  <input type="hidden" name="tanggal_perencanaan" value="<?= $sk->tanggal_perencanaan ?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Casecading ke</label>
                                    <select name="id_pegawai[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Casecading ke" required="">
                                        <?php foreach ($pegawai_bawahan as $row): ?>
                                          <?php if (!in_array($row->id_pegawai, $scl)): ?>
                                            <option value="<?=$row->id_pegawai?>"><?=$row->nama_lengkap?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="addsub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <?php $nus++; endforeach ?>


                        <div class="modal fade" id="EditModal<?=$u->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Ubah URTUG</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="id_urtug" value="<?=$u->id_urtug?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"><?= $u->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $u->kuantitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $u->kualitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $u->waktu_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $u->biaya_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="edit" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="UpdateModal<?=$u->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Update Realisasi</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="id_urtug" value="<?=$u->id_urtug?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control" readonly=""><?= $u->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $u->kuantitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kuantitas_realisasi" value="<?= $u->kuantitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $u->kualitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kualitas_realisasi" value="<?= $u->kualitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $u->waktu_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="waktu_realisasi" value="<?= $u->waktu_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $u->biaya_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="biaya_realisasi" value="<?= $u->biaya_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <!-- <div class="form-group">
                                    <label for="recipient-name" class="control-label">Total Capaian</label>
                                    <div class="input-group m-t-10">
                                      <input type="number" name="capaian" class="form-control" step=".01" value="<?= $u->capaian ?>">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div> -->
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="update" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="SubModal<?=$u->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Casecading Sub Kegiatan</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>

                                  <div class="well">
                                    <p>Indikator: <b><?= $u->kegiatan_tugas_jabatan ?></b></p>
                                    <p>Kuant/Output: <b><?= $u->kuantitas_target ?> <?= convert_satuan($u->kuantitas_satuan) ?></b></p>
                                    <p>Kual/Mutu: <b><?= $u->kualitas_target ?> <?= convert_satuan($u->kualitas_satuan) ?></b></p>
                                    <p>Waktu: <b><?= $u->waktu_target ?> <?= convert_satuan($u->waktu_satuan) ?></b></p>
                                    <p>Biaya: <b><?= convert_satuan($u->biaya_satuan) ?> <?= $u->biaya_target ?></b></p>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Casecading ke</label>
                                    <select name="id_pegawai[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Casecading ke" required="">
                                        <?php foreach ($pegawai_bawahan as $row): ?>
                                          <option value="<?=$row->id_pegawai?>"><?=$row->nama_lengkap?></option>
                                        <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan untuk Bawahan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target">
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="sub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <?php $nu++; endforeach ?>

                        <div class="modal fade" id="AddModal<?=$i->$cIkuRenja?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Tambah URTUG</h4>
                              </div>
                              <form method="post" action="#iku_<?=$i->$cIkuRenja?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="<?=$j?>" required>
                                  <input type="hidden" name="id_iku_renja" value="<?=$i->$cIkuRenja?>" required>

                                  <div class="well">
                                    <p>Indikator: <b><?= $i->$tIku ?></b></p>
                                    <p>Target: <b><?= $i->$taIkuRenja ?> (<?= $i->satuan ?>)</b></p>
                                    <p>Realisasi: <b><?= $i->$rIkuRenja ?> (<?= $i->satuan ?>)</b></p>
                                    <p>Anggaran: <b>Rp<?= number_format(round($total_rka[$i->$cIkuRenja])) ?></b></p>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="insert" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php $n++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <?php $no++;
            }
          }
        }
        ?>


      </div>


      <?php
      $sub = $this->db->select('iku_urtug.*,iku.id_pegawai_input as id_pegawai_cc')->group_by('iku.id_pegawai_input')->join('iku_urtug iku','iku.id_urtug = iku_urtug.id_iku_renja','left')->get_where('iku_urtug',array('iku_urtug.id_pegawai_input' => $id_pegawai,'iku_urtug.tahun' => $tahun,'iku_urtug.jenis_renja' => 'cc'))->result();

      foreach ($sub as $a => $b) {
        $sub_b = $this->db->select('iku_urtug.*')->group_by('iku_urtug.id_iku_renja')->join('iku_urtug iku','iku.id_urtug = iku_urtug.id_iku_renja','left')->get_where('iku_urtug',array('iku_urtug.id_pegawai_input' => $id_pegawai,'iku_urtug.tahun' => $tahun,'iku_urtug.jenis_renja' => 'cc','iku.id_pegawai_input' => $b->id_pegawai_cc))->result();
        $array_b = array();
        foreach ($sub_b as $s_row) {
          $array_b[] = $s_row->id_iku_renja;
        }
        $s = $this->db->join('pegawai','pegawai.id_pegawai = iku_urtug.id_pegawai_input','left')->get_where('iku_urtug',array('id_urtug' => $b->id_iku_renja))->row();
        $induk = $this->db->group_by('id_iku_renja')->where_in('id_iku_renja', $array_b)->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'jenis_renja' => 'cc'))->result();
        // print_r($this->db->last_query());
          ?>
        <div class="white-box">
          <div class="row p-b-20" style="position: relative;">
            <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
            <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%" id="skp_<?=$a?>">
              <span style="font-weight: 450;text-transform: uppercase;">Casecading dari <?=$s->nama_lengkap?> </span>
              <?php if (empty($sasaran) AND $a == 0): ?>
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle pull-right" type="button" style="position: absolute; right: 0; top: 8.5px"><i class="fa fa-print"></i> Cetak SKP</button>
              <ul role="menu" class="dropdown-menu" style="right: 0; left: unset; top: 95%;">
                  <li><a href="<?=base_url('skp_perencanaan/cetak/'.$this->uri->segment(3))?>">Perencanaan</a></li>
                  <li><a href="<?=base_url('skp_perencanaan/cetak/'.$this->uri->segment(3).'/penilaian')?>">Penilaian</a></li>
              </ul>
              <?php endif ?>
            </div>
          </div>
          <?php
          $no = 1;
          if ($induk) {
            ?>

                <div class="table-responsive">
                  <table class="table color-table muted-table">
                      <?php
                      $n = 1;
                      foreach ($induk as $k) {
                        $i = $this->db->get_where('iku_urtug',array('id_urtug' => $k->id_iku_renja))->row();

                        $urtug = $this->db->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'id_iku_renja' => $k->id_iku_renja))->result();
                        ?>
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian</th>
                        <th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
                        <th style="vertical-align: middle;text-align: center;" colspan="2">Indikator Kegiatan</th>
                        <th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Target</th>
                        <th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
                        <th style="vertical-align: middle;text-align: center;width:100px" colspan="3">Waktu</th>
                        <th style="vertical-align: middle;text-align: center;width:200px">Biaya</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr id="iku_<?= $i->id_urtug ?>" class="pt-tr">
                          <td><span class="badge badge-warning" style="min-width:50px"><?=round($i->capaian,2)?></span></td>
                          <td class="text-center"><?= $n ?></td>
                          <td class="text-left" colspan="2"><?= $i->kegiatan_tugas_jabatan ?></td>
                          <td class="text-center"><?= convert_satuan($i->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $i->kuantitas_target ?></td>
                          <td class="text-right"><?= $i->kuantitas_realisasi ?></td>
                          <td class="text-center" colspan="3"><?= $i->waktu_target ?> <?= convert_satuan($i->waktu_satuan) ?></td>
                          <td class="text-right">Rp<?= number_format(round($i->biaya_target)) ?></td>
                        </tr>

                        <tr>
                          <td colspan="2">
                          </td>
                          <td class="" colspan="9"><h4 style="margin: 5px 0;">KEGIATAN TUGAS JABATAN</h4></td>
                          <!-- <td> -->
                              <!-- <button type="button" class="btn btn-primary btn-block btn-sm"><i class="fa fa-print"></i> Cetak SKP</button> -->
                          <!-- </td> -->
                        </tr>

                        

                        <?php $nu=1; foreach ($urtug as $u): ?>
                        <tr id="urtug_<?= $u->id_urtug ?>">
                          <td rowspan="5"><span class="badge badge-warning" style="min-width:50px"><?=round($u->capaian,2)?></span></td>
                          <td rowspan="5" class="text-center"><?= $n ?>.<?= $nu ?></td>
                          <td rowspan="5"><?= $u->kegiatan_tugas_jabatan ?></td>
                          <td class="text-right"><b>Kuantitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kuantitas_target ?></td>
                          <td class="text-right"><?= $u->kuantitas_realisasi ?></td>
                          <td colspan="3"></td>
                          <td rowspan="5">
                            <blockquote><?= $u->status_kegiatan ?></blockquote>
                            <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                              <input type="hidden" name="id_urtug" value="<?=$u->id_urtug?>">
                            <?php if ($u->status_kegiatan == "Perencanaan"): ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#EditModal<?=$u->id_urtug?>"><i class="fa fa-pencil"></i> Ubah Target</button>
                              <button type="button" class="btn btn-primary btn-block btn-sm" onclick="simpan_perencanaan(<?=$u->id_urtug?>)"><i class="fa fa-check"></i> Simpan Perencanaan</button>
                              <button type="button" class="btn btn-danger btn-block btn-sm" onclick="hapus_kegiatan(<?=$u->id_urtug?>)"><i class="fa fa-trash"></i> Hapus Kegiatan</button>
                              <button type="submit" class="hidden" name="set" id="submit_set<?=$u->id_urtug?>"></button>
                              <button type="submit" class="hidden" name="delete" id="submit_delete<?=$u->id_urtug?>"></button>
                            <?php elseif ($u->status_kegiatan == "Realisasi"): ?>
                              <?php if ($pegawai->jenis_pegawai != "staff"): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#SubModal<?=$u->id_urtug?>"><i class="fa fa-list"></i> Casecading ke</button>
                              <?php endif ?>
                              <button type="button" class="btn btn-info btn-block btn-sm" data-toggle="modal" data-target="#UpdateModal<?=$u->id_urtug?>"><i class="fa fa-edit"></i> Update Realisasi</button>
                              <?php if ($u->kuantitas_realisasi!=''): ?>
                              <button type="button" class="btn btn-success btn-block btn-sm" onclick="simpan_skp(<?=$u->id_urtug?>)"><i class="fa fa-location-arrow"></i> Simpan SKP</button>
                              <?php endif ?>
                              <button type="submit" class="hidden" name="save" id="submit_save<?=$u->id_urtug?>"></button>
                            <?php elseif ($u->status_kegiatan == "Mutasi"): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#AddModal<?=$i->$cIkuRenja?>"><i class="fa fa-refresh"></i> Ambil Alih Kegiatan</button>
                            <?php elseif ($u->status_kegiatan == "Selesai"): ?>
                              <?php if ($pegawai->jenis_pegawai != "staff"): ?>
                              <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#SubModal<?=$u->id_urtug?>"><i class="fa fa-list"></i> Casecading ke</button>
                              <?php endif ?>
                            <?php else: ?>
                            <?php endif ?>
                            </form>
                            <?php if ($u->kuantitas_realisasi>0): ?>
                              <div class="white-box text-center" style="border: #ff6849 1px solid;border-radius: 50%;margin: 5%;">
                                <h1 class="counter"><?=round($u->capaian,2)?></h1>
                                <p class="text-muted"><?=strtoupper(konversi_nilai_skp($u->capaian))?></p>
                              </div>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kualitas</b></td>
                          <td class="text-center"><?= convert_satuan($u->kualitas_satuan) ?></td>
                          <td class="text-right"><?= $u->kualitas_target ?></td>
                          <td class="text-right"><?= $u->kualitas_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Waktu</b></td>
                          <td class="text-center"><?= convert_satuan($u->waktu_satuan) ?></td>
                          <td class="text-right"><?= $u->waktu_target ?></td>
                          <td class="text-right"><?= $u->waktu_realisasi ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Biaya</b></td>
                          <td class="text-center"><?= convert_satuan($u->biaya_satuan) ?></td>
                          <td class="text-right"><?= dot($u->biaya_target) ?></td>
                          <td class="text-right"><?= @dot($u->biaya_realisasi) ?></td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Tgl. Update</b></td>
                          <td></td>
                          <td class="text-right"><?= tgl_indo($u->tanggal_perencanaan) ?></td>
                          <td class="text-right"><?= @tgl_indo($u->tanggal_realisasi) ?></td>
                        </tr>

                        <?php 
                          $sub_kegiatan = $this->db->group_by('tanggal_perencanaan')->get_where('iku_urtug',array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc'))->result();
                        ?>
                        <?php $nus=1; foreach ($sub_kegiatan as $sk): ?>

                        <?php 
                          $sub_casecading = $this->db->limit(4,0)->join('pegawai', 'pegawai.id_pegawai = iku_urtug.id_pegawai_input', 'left')->get_where('iku_urtug', array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc', 'tanggal_perencanaan' => $sk->tanggal_perencanaan))->result();
                          $sca = $this->db->get_where('iku_urtug', array('id_iku_renja' => $u->id_urtug, 'jenis_renja' => 'cc', 'tanggal_perencanaan' => $sk->tanggal_perencanaan))->result();
                          $scl = array();
                          foreach ($sca as $row) {
                            $scl[] = $row->id_pegawai_input;
                          }
                          $sc = $sub_casecading;
                        ?>

                        <tr id="sub_urtug_<?= $sk->id_urtug ?>">
                          <td rowspan="6"><span class="badge badge-inverse" style="min-width:50px">SUB</span></td>
                          <td rowspan="6" class="text-center"><?= $nu.'.'.$nus ?></td>
                          <td rowspan="6"><?= $sk->kegiatan_tugas_jabatan ?></td>
                          <td class="text-right"><b>Casecading ke</b></td>
                          <td colspan="2"></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                          <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                            <td class="text-right" style="white-space: nowrap;">
                              <?php if(@$sc[$ic]->status_kegiatan == "Mutasi"): ?>
                                <s class="text-danger"><?= @$sc[$ic]->nama_lengkap; ?></s>
                              <?php else: ?>
                                <?= @$sc[$ic]->nama_lengkap; ?>
                              <?php endif ?> 
                              <?php if(@$sc[$ic]->status_kegiatan == "Mutasi"): ?>
                                <button type="button" class="btn btn-xs btn-info btn-outline"><i class="fa fa-pencil"></i></button>
                              <?php endif ?> 
                              <?php if(isset($sc[$ic]) AND $sc[$ic]->status_kegiatan != "Selesai"): ?>
                                  <button type="button" class="btn btn-xs btn-danger btn-outline" onclick="remove_sub(<?=$sc[$ic]->id_urtug?>)"><i class="fa fa-times"></i></button>
                                  <input type="hidden" name="id_urtug" value="<?=$sc[$ic]->id_urtug?>">
                                  <button type="submit" class="hidden" name="removesub" id="submit_removesub<?=$sc[$ic]->id_urtug?>"></button>
                              <?php endif ?>
                            </td>
                          </form>
                          <?php } ?>
                          <td rowspan="6">
                            <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                              <input type="hidden" name="id_iku_renja" value="<?=$sk->id_iku_renja?>">
                              <input type="hidden" name="tanggal_perencanaan" value="<?=$sk->tanggal_perencanaan?>">
                              <button type="button" class="btn btn-sm btn-primary btn-block btn-outline" data-toggle="modal" data-target="#AddSubModal<?=$sk->id_urtug?>"><i class="fa fa-plus"></i> Tambah Casecading</button>
                              <button type="button" class="btn btn-sm btn-info btn-block btn-outline" data-toggle="modal" data-target="#EditSubModal<?=$sk->id_urtug?>"><i class="fa fa-edit"></i> Edit Sub</button>
                              <button type="button" class="btn btn-sm btn-danger btn-block btn-outline" onclick="hapus_sub(<?=$sk->id_urtug?>)"><i class="fa fa-trash"></i> Hapus Sub</button>
                              <button type="submit" class="hidden" name="deletesub" id="submit_deletesub<?=$sk->id_urtug?>"></button>
                            </form>
                          </td>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kuantitas</b></td>
                          <td class="text-center"><?= convert_satuan($sk->kuantitas_satuan) ?></td>
                          <td class="text-right"><?= $sk->kuantitas_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->kuantitas_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Kualitas</b></td>
                          <td class="text-center"><?= convert_satuan($sk->kualitas_satuan) ?></td>
                          <td class="text-right"><?= $sk->kualitas_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->kualitas_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Waktu</b></td>
                          <td class="text-center"><?= convert_satuan($sk->waktu_satuan) ?></td>
                          <td class="text-right"><?= $sk->waktu_target ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @$sc[$ic]->waktu_realisasi; ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Biaya</b></td>
                          <td class="text-center"><?= convert_satuan($sk->biaya_satuan) ?></td>
                          <td class="text-right"><?= dot($sk->biaya_target) ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?php if(isset($sc[$ic])): ?><?= @dot($sc[$ic]->biaya_realisasi); ?><?php endif ?></td>
                          <?php } ?>
                        </tr>
                        <tr id="">
                          <td class="text-right"><b>Tgl. Update</b></td>
                          <td></td>
                          <td class="text-right"><?= tgl_indo($sk->tanggal_perencanaan) ?></td>
                          <?php for ($ic=0; $ic < 4; $ic++) { ?>
                            <td class="text-right"><?= @tgl_indo($sc[$ic]->tanggal_realisasi); ?></td>
                          <?php } ?>
                        </tr>

                        <div class="modal fade" id="EditSubModal<?=$sk->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Edit Sub Kegiatan</h4>
                              </div>
                              <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>
                                  <input type="hidden" name="tanggal_perencanaan" value="<?= $sk->tanggal_perencanaan ?>" required>

                                  <div class="well">
                                    <p>Indikator: <b><?= $u->kegiatan_tugas_jabatan ?></b></p>
                                    <p>Kuant/Output: <b><?= $u->kuantitas_target ?> <?= convert_satuan($u->kuantitas_satuan) ?></b></p>
                                    <p>Kual/Mutu: <b><?= $u->kualitas_target ?> <?= convert_satuan($u->kualitas_satuan) ?></b></p>
                                    <p>Waktu: <b><?= $u->waktu_target ?> <?= convert_satuan($u->waktu_satuan) ?></b></p>
                                    <p>Biaya: <b><?= convert_satuan($u->biaya_satuan) ?> <?= $u->biaya_target ?></b></p>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan untuk Bawahan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"><?= $sk->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $sk->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $sk->kuantitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $sk->kualitas_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $sk->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $sk->waktu_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $sk->biaya_target ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="editsub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="AddSubModal<?=$sk->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Tambah Casecading</h4>
                              </div>
                              <form method="post" action="#sub_urtug_<?= $sk->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>
                                  <input type="hidden" name="tanggal_perencanaan" value="<?= $sk->tanggal_perencanaan ?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Casecading ke</label>
                                    <select name="id_pegawai[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Casecading ke" required="">
                                        <?php foreach ($pegawai_bawahan as $row): ?>
                                          <?php if (!in_array($row->id_pegawai, $scl)): ?>
                                            <option value="<?=$row->id_pegawai?>"><?=$row->nama_lengkap?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="addsub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <?php $nus++; endforeach ?>

                        <div class="modal fade" id="UpdateModal<?=$u->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Update Realisasi</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="id_urtug" value="<?=$u->id_urtug?>" required>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Kegiatan Tugas Jabatan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control" readonly=""><?= $u->kegiatan_tugas_jabatan ?></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->kuantitas_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target" value="<?= $u->kuantitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kuantitas_realisasi" value="<?= $u->kuantitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target" value="<?= $u->kualitas_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="kualitas_realisasi" value="<?= $u->kualitas_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1" disabled="">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>" <?= ($row->id_satuan == $u->waktu_satuan) ? "selected" : "" ?>><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target" value="<?= $u->waktu_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="waktu_realisasi" value="<?= $u->waktu_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target" value="<?= $u->biaya_target ?>" readonly="">
                                      </div>
                                    </div>
                                    <div class="col-md-5">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Realisasi</label>
                                        <input type="text" class="form-control" name="biaya_realisasi" value="<?= $u->biaya_realisasi ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <!-- <div class="form-group">
                                    <label for="recipient-name" class="control-label">Total Capaian</label>
                                    <div class="input-group m-t-10">
                                      <input type="number" name="capaian" class="form-control" step=".01" value="<?= $u->capaian ?>">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                  </div> -->
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="update" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" id="SubModal<?=$u->id_urtug?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel1">Casecading Sub Kegiatan</h4>
                              </div>
                              <form method="post" action="#urtug_<?= $u->id_urtug ?>">
                                <div class="modal-body">
                                  <input type="hidden" name="jenis_renja" value="cc" required>
                                  <input type="hidden" name="id_iku_renja" value="<?= $u->id_urtug ?>" required>

                                  <div class="well">
                                    <p>Indikator: <b><?= $u->kegiatan_tugas_jabatan ?></b></p>
                                    <p>Kuant/Output: <b><?= $u->kuantitas_target ?> <?= convert_satuan($u->kuantitas_satuan) ?></b></p>
                                    <p>Kual/Mutu: <b><?= $u->kualitas_target ?> <?= convert_satuan($u->kualitas_satuan) ?></b></p>
                                    <p>Waktu: <b><?= $u->waktu_target ?> <?= convert_satuan($u->waktu_satuan) ?></b></p>
                                    <p>Biaya: <b><?= convert_satuan($u->biaya_satuan) ?> <?= $u->biaya_target ?></b></p>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Casecading ke</label>
                                    <select name="id_pegawai[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Casecading ke" required="">
                                        <?php foreach ($pegawai_bawahan as $row): ?>
                                          <option value="<?=$row->id_pegawai?>"><?=$row->nama_lengkap?></option>
                                        <?php endforeach ?>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="recipient-name" class="control-label">Sub Kegiatan Tugas Jabatan untuk Bawahan</label>
                                    <textarea name="kegiatan_tugas_jabatan" class="form-control"></textarea>
                                  </div>

                                  <label>Kuantitas/Output</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="kuantitas_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kuantitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Kualitas/Mutu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="kualitas_satuan" value="59">
                                      <input type="text" class="form-control" value="%" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="kualitas_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Waktu</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <select name="waktu_satuan" class="form-control select2" data-placeholder="Pilih Satuan" tabindex="1">
                                        <option value="">-- PILIH --</option>
                                        <?php foreach ($ref_satuan as $row): ?>
                                          <?php if ($row->jenis == "waktu"): ?>
                                            <option value="<?=$row->id_satuan?>"><?=$row->satuan?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="waktu_target">
                                      </div>
                                    </div>
                                  </div>
                                  <hr/>

                                  <label>Biaya</label>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="control-label" style="font-weight: 100">Satuan</label>
                                      <input type="hidden" name="biaya_satuan" value="62">
                                      <input type="text" class="form-control" value="Rupiah (Rp.)" disabled="">
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="recipient-name" class="control-label" style="font-weight: 100">Target</label>
                                        <input type="text" class="form-control" name="biaya_target">
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" name="sub" class="btn btn-primary" onclick='swal("Berhasil!", "", "success");'>Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <?php $nu++; endforeach ?>

                        <?php $n++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              <?php $no++;
            }
            ?>
            </div>

            <!-- <div class="white-box">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading"> Inverse Panel
                            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
                        </div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div> -->
        <?php
          }
        
        ?>

    </div>



    <script type="text/javascript">
      function simpan_perencanaan(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah disimpan, Anda tidak dapat kembali ke perencanaan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#6003c8",   
            confirmButtonText: "Ya, Simpan Perencanaan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Perencanaan sudah disimpan.", "success"); 
            $('#submit_set'+id).click();
        });
      }

      function hapus_kegiatan(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Kegiatan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Perencanaan sudah dihapus.", "success"); 
            $('#submit_delete'+id).click();
        });
      }

      function hapus_sub(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Sub Kegiatan!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Sub Kegiatan sudah dihapus.", "success"); 
            $('#submit_deletesub'+id).click();
        });
      }

      function remove_sub(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah dihapus, Data Realisasi tidak dapat dikembalikan!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#f75b36",   
            confirmButtonText: "Ya, Hapus Casecading!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "Casecading sudah dihapus.", "success"); 
            $('#submit_removesub'+id).click();
        });
      }

      function simpan_skp(id) {
        swal({   
            title: "Apakah sudah Yakin?",   
            text: "Setelah disimpan, Anda tidak dapat kembali ke realisasi!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#00c292",   
            confirmButtonText: "Ya, Simpan SKP!",   
            closeOnConfirm: false 
        }, function(){   
            swal("Berhasil!", "SKP sudah disimpan.", "success"); 
            $('#submit_save'+id).click();
        });
      }
    </script>