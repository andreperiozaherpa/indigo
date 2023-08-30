<?php
error_reporting(E_ALL ^  E_NOTICE);
?>
<div class="container-fluid">
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan Kinerja Pegawai</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="#">Laporan</a></li>
        <li class="active">Kinerja Pegawai</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- row -->

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <?php if ($user_level == 'Administrator') { ?>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">SKPD</label>
                  <select name="id_skpd" class="form-control select2">
                    <option value="">Semua SKPD</option>
                    <?php
                    foreach ($skpd as $s) { ?>
                      <option value="<?= $s->id_skpd ?>" <?= $selected = ($s->id_skpd == $id_skpd) ? "selected" : null; ?>><?= $s->nama_skpd ?></option>
                    <?php }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Pegawai" value="<?= isset($nama_lengkap) ? $nama_lengkap : null; ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tahun</label>
                  <select name="tahun" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control">
                    <?php
                    $current_year = date("Y");
                    $array_year = array();
                    foreach ($tahun as $r) {
                      if ($r->tahun_berkas > 0) {
                        array_push($array_year, $r->tahun_berkas);
                      }
                    }
                    rsort($array_year);
                    $min_year = ($array_year[0] < $current_year - 5) ? $array_year[0] : $current_year - 5;
                    $max_year = ($array_year[count($array_year) - 1] > $current_year + 5) ? $array_year[count($array_year) - 1] : $current_year + 5;
                    for ($i = $min_year; $i < $max_year; $i++) {
                      array_push($array_year, $i);
                    }
                    $array_year = array_unique($array_year);
                    rsort($array_year);
                    foreach ($array_year as $year) {
                      $selected = "";
                      if ($this->uri->segment(4) == $year) {
                        $selected = "selected";
                      }
                      echo '<option value="' . base_url("laporan/pegawai/index/" . $year) . '" ' . $selected . '>' . $year . '</option>';
                    }
                    ?></select>
                </div>
              </div>


            <?php } ?>
            <div class="col-md-2">
              <div class="form-group">

                <br>
                <button type="submit" class="btn btn-primary m-t-5"> <i class="ti ti-filter"></i> Filter</button>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>

  </div>


  <div class="row">
    <!-- .col -->
    <?php
    $CI = &get_instance();
    $pp = 1;
    foreach ($pegawai as $p) {
      if ($p->id_skpd == 33) {
        continue;
      }
      $CI->load->model('kegiatan_model');
      $CI->load->model('pegawai_model');
      $pekerjaan = $CI->kegiatan_model->get_pekerjaan($p->id_pegawai);

      $jumlah = count($pekerjaan);
      $total = 0;
      foreach ($pekerjaan as $pe) {
        $presentase = $CI->kegiatan_model->get_capaian($pe->id_kegiatan, $p->id_pegawai);
        $total += $presentase;
      }
      if ($total == 0) {
        $p_total = 0;
      } else {
        $p_total = $total / $jumlah;
      }

      $details_pegawai = $CI->pegawai_model->get_by_id($p->id_pegawai);
      $id_unit_kerja = $details_pegawai->id_unit_kerja;
      $iku_ss = $CI->kinerja_pegawai_model->get_kinerja('ss', $details_pegawai->nip);
      $iku_sp = $CI->kinerja_pegawai_model->get_kinerja('sp', $details_pegawai->nip);
      $iku_sk = $CI->kinerja_pegawai_model->get_kinerja('sk', $details_pegawai->nip);

      $iku_ss_total = 0;
      foreach ($iku_ss as $ss) {
        $list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($ss->jenis_sasaran, $ss->nip, $ss->id_iku);
        $realisasi_by_pegawai = 0;
        foreach ($list_iku_kinerja as $l) {
          $realisasi_by_pegawai += $l->realisasi;
        }
        // if ($ss->perhitungan_capaian_renja == 'otomatis') {
        // $iku_ss_total += get_capaian($ss->target_ss_renja, $realisasi_by_pegawai, $ss->polorarisasi);
        // }else{
        $iku_ss_total += $ss->capaian;
        // }
      }
      $iku_sp_total = 0;
      foreach ($iku_sp as $sp) {
        $list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($sp->jenis_sasaran, $sp->nip, $sp->id_iku);
        $realisasi_by_pegawai = 0;
        foreach ($list_iku_kinerja as $l) {
          $realisasi_by_pegawai += $l->realisasi;
        }
        $iku_sp_total += get_capaian($sp->target_sp_renja, $realisasi_by_pegawai, $sp->polorarisasi);
      }
      $iku_sk_total = 0;
      foreach ($iku_sk as $sk) {
        $list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($sk->jenis_sasaran, $sk->nip, $sk->id_iku);
        $realisasi_by_pegawai = 0;
        foreach ($list_iku_kinerja as $l) {
          $realisasi_by_pegawai += $l->realisasi;
        }
        $iku_sk_total += get_capaian($sk->target_sk_renja, $realisasi_by_pegawai, $sk->polorarisasi);
      }


      $jumlah_iku = count($iku_ss) + count($iku_sp) + count($iku_sk);
      $total_capaian = ($iku_ss_total + $iku_sp_total + $iku_sk_total);
      $hasil_akhir = get_capaian_iku($total_capaian, $jumlah_iku);
    ?>
      <div class="col-md-4 col-sm-4">
        <div class="white-box">
          <div class="row">
            <div class="col-md-3">
              <div data-label="<?= roundfive($hasil_akhir, $x = 5); ?>" class="css-bar css-bar-<?= roundfive($hasil_akhir, $x = 5); ?> css-bar-md css-bar-default float-left" style="margin-left:-10px;margin-bottom: 0px;"><img src="<?= base_url() ?>/data/user_picture/useravatar.png" alt="User"></div>
              <center><span style="text-align: center;font-weight: bold;"><?= $hasil_akhir ?>%</span></center>
            </div>
            <div class="col-md-8 col-sm-8">
              <br>
              <h3 class="box-title m-b-0"><?= $p->nama_lengkap ?></h3>
              <div style="height: 100px" class="well"><small><?= $p->jabatan ?></small></div>
              <address>
                <a href="<?php echo base_url(); ?>laporan/detail_pegawai/<?= $p->id_pegawai ?>/<?= $CI->uri->segment(4) ?>">

                  <button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Profil</button>
                </a>
              </address>
              <p></p>
            </div>
          </div>
        </div>
      </div>
    <?php 
    $pp++;
    if($pp>=30){
    break;
    }
  } ?>
    <!-- /.col -->
  </div>