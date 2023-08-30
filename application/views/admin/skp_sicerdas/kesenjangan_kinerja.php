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
      <h4 class="page-title">Informasi kesenjangan Kinerja</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url(); ?>/skp_perencanaan">Informasi kesenjangan Kinerja</a></li>
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

  <div class="white-box table-responsive">
    <h3 class="box-title text-center">INFORMASI KESENJANGAN KINERJA</h3>

      <table class="table table-striped table-bordered color-table primary-table" border="">
<thead>
  <tr>
    <th rowspan="2">NO</th>
    <th rowspan="2" colspan="2">URAIAN TUGAS JABATAN</th>
    <th colspan="6">TARGET</th>
    <th colspan="6">REALISASI</th>
    <th colspan="6">KETIMPANGAN</th>
    <th colspan="4">NILAI</th>
    <th rowspan="2">RATA-RATA NILAI</th>
    <th rowspan="2">KET</th>
  </tr>
  <tr>
    <th colspan="2">KUANT/OUTPUT</th>
    <th>KUAL/MUTU</th>
    <th colspan="2">WAKTU</th>
    <th>BIAYA</th>
    <th colspan="2">KUANT/OUTPUT</th>
    <th>KUAL/MUTU</th>
    <th colspan="2">WAKTU</th>
    <th>BIAYA</th>
    <th colspan="2">KUANT/OUTPUT</th>
    <th>KUAL/MUTU</th>
    <th colspan="2">WAKTU</th>
    <th>BIAYA</th>
    <th>KUANT/OUTPUT</th>
    <th>KUAL/MUTU</th>
    <th>WAKTU</th>
    <th>BIAYA</th>
  </tr>
  <tr style="background: #eee">
    <td align="center">1</td>
    <td colspan="2" align="center">2</td>
    <td colspan="2" align="center">3</td>
    <td align="center">4</td>
    <td colspan="2" align="center">5</td>
    <td align="center">6</td>
    <td colspan="2" align="center">7</td>
    <td align="center">8</td>
    <td colspan="2" align="center">9</td>
    <td align="center">10</td>
    <td colspan="2" align="center">11</td>
    <td align="center">12</td>
    <td colspan="2" align="center">13</td>
    <td align="center">14</td>
    <td align="center">15</td>
    <td align="center">16</td>
    <td align="center">17</td>
    <td align="center">18</td>
    <td align="center">19</td>
    <td align="center">20</td>
  </tr>
  </thead>
  <tbody>

  <?php
   $nskp=0;
   $nu=1; 
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
              <!-- <tr>
                <td></td>
                <td colspan="2"><b>Sasaran:</b> <?= $s->nama_sasaran ?></td>
              </tr> -->
                <?php
              } else {
                ?>
              <!-- <tr>
                <td></td>
                <td colspan="2"><b>Sasaran:</b> <?= $s->$tSasaran ?></td>
              </tr> -->
                  <?php
                }
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
              <!-- <tr>
                <td></td>
                <td colspan="2"><b>Indikator:</b> <?= $i->$tIku ?></td>
              </tr> -->
              <?php /*$nu=1;*/ foreach ($urtug as $u): ?>
              <tr>
                <td><?= $nu; ?></td>
                <td colspan="2"><?= $u->kegiatan_tugas_jabatan ?></td>
                <!-- <td>-</td> -->
                <td class="num"><?= $u->kuantitas_target ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_target ?></td>
                <td class="num"><?= $u->waktu_target ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_target) ?></td>
                <!-- <td>-</td> -->
                <td class="num"><?= $u->kuantitas_realisasi ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_realisasi ?></td>
                <td class="num"><?= $u->waktu_realisasi ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_realisasi) ?></td>
                <td class="num"><?= ($u->kuantitas_realisasi - $u->kuantitas_target) ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= ($u->kualitas_realisasi - $u->kualitas_target) ?></td>
                <td class="num"><?= ($u->waktu_realisasi - $u->waktu_target) ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot(($u->biaya_realisasi - $u->biaya_target)) ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->kuantitas_target,$u->kuantitas_realisasi,FALSE),2,',','') ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->kualitas_target,$u->kualitas_realisasi,FALSE),2,',','') ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->waktu_target,$u->waktu_realisasi,TRUE),2,',','') ?></td>
                <td class="num"><?= @dot(nilai_indeks($u->biaya_target,$u->biaya_realisasi,TRUE)) ?></td>
                <td class="num"><?= number_format(capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi),2,',','') ?></td>
                <td class="num"><?= @konversi_nilai_skp(capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi)) ?></td>
              </tr>
                        <?php $nskp+=capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi); $nu++; endforeach; ?>

                        <?php $n++;
                      } ?>

              <?php $no++;
            }
          }
        }
        ?>

                        <?php 
                        $sub = $this->db->select('iku_urtug.*')->group_by('iku.id_pegawai_input')->join('iku_urtug iku','iku.id_urtug = iku_urtug.id_iku_renja','left')->get_where('iku_urtug',array('iku_urtug.id_pegawai_input' => $id_pegawai,'iku_urtug.tahun' => $tahun,'iku_urtug.jenis_renja' => 'cc'))->result();
                        foreach ($sub as $a => $b):
        $s = $this->db->join('pegawai','pegawai.id_pegawai = iku_urtug.id_pegawai_input','left')->get_where('iku_urtug',array('id_urtug' => $b->id_iku_renja))->row();
        $induk = $this->db->group_by('id_iku_renja')->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'id_iku_renja','jenis_renja' => 'cc'))->result(); ?>
                        <?php foreach ($induk as $k) {
                        $i = $this->db->get_where('iku_urtug',array('id_urtug' => $k->id_iku_renja))->row();

                        $urtug = $this->db->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'id_iku_renja' => $k->id_iku_renja))->result();
                        ?>
              <!-- <tr>
                <td></td>
                <td colspan="2"><b>Casecading:</b> <?= $i->kegiatan_tugas_jabatan ?></td>
              </tr> -->
              <?php foreach ($urtug as $u): ?>
              <tr>
                <td><?= $nu; ?></td>
                <td colspan="2"><?= $u->kegiatan_tugas_jabatan ?></td>
                <!-- <td>-</td> -->
                <td class="num"><?= $u->kuantitas_target ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_target ?></td>
                <td class="num"><?= $u->waktu_target ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_target) ?></td>
                <!-- <td>-</td> -->
                <td class="num"><?= $u->kuantitas_realisasi ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_realisasi ?></td>
                <td class="num"><?= $u->waktu_realisasi ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_realisasi) ?></td>
                <td class="num"><?= ($u->kuantitas_realisasi - $u->kuantitas_target) ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= ($u->kualitas_realisasi - $u->kualitas_target) ?></td>
                <td class="num"><?= ($u->waktu_realisasi - $u->waktu_target) ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot(($u->biaya_realisasi - $u->biaya_target)) ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->kuantitas_target,$u->kuantitas_realisasi,FALSE),2,',','') ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->kualitas_target,$u->kualitas_realisasi,FALSE),2,',','') ?></td>
                <td class="num"><?= number_format(nilai_indeks($u->waktu_target,$u->waktu_realisasi,TRUE),2,',','') ?></td>
                <td class="num"><?= @dot(nilai_indeks($u->biaya_target,$u->biaya_realisasi,TRUE)) ?></td>
                <td class="num"><?= number_format(capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi),2,',','') ?></td>
                <td class="num"><?= @konversi_nilai_skp(capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi)) ?></td>
              </tr>
              <?php $nskp+=capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi); $nu++; endforeach ?>
            <?php } ?>
                          
                        <?php endforeach ?>
        </tbody>
        <tr>
          <th colspan="24"></th>
          <th>JML</th>
          <th class="num"><?= number_format($nskp/($nu-1),2,',','') ?></th>
          <th><?= konversi_nilai_skp($nskp/($nu-1)) ?></th>
        </tr>
        <tr>
        </tr>
      </table>

    </div>
  </div>
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