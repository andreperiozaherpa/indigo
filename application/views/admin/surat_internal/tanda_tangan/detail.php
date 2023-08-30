<?php

if ($detail->status_ttd == 'sudah_ditandatangani') {
  $color1 = "success";
  $color2 = "#00c292";
  $icon = 'icon-check';
  $icon2 = "icon-check";
} elseif ($detail->status_ttd == "ditolak") {
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-close";
  $icon2 = "icon-close";
} elseif ($detail->status_ttd == "menunggu_verifikasi") {
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
  $detail->status_ttd = "menunggu_ditandatangani";
}
?>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Tandatangan Surat Internal</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
      if (isset($message)) {
      ?>
        <div class="alert alert-<?= $type ?>"><?= $message ?></div>
      <?php
      }
      ?>
    </div>
  </div>
  <div class="col-md-12">
    <a href="<?= base_url('surat_internal/tanda_tangan') ?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
  </div>
  <div class="col-md-3">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
          <div class="col-md-12 col-sm-6">
            <div class="panel panel-primary">
              <div class="panel-body" style="border-top: solid 5px #6003C8">
                <div class="row b-b">
                  <div class="text-center">
                    <p>
                      <i style="font-size: 70px;" class="text-<?= $color1 ?> <?= $icon ?>"></i>
                    </p>
                    <p>
                      <span class="text-<?= $color1 ?>">
                        <i style="background-color: <?= $color2 ?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?= $icon2 ?>"></i> <?= normal_string($detail->status_ttd) ?>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6>Pengirim</h6>
                    <h5> <?= $detail->nama_skpd ?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_buat) ?></span>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6>Penerima</h6>
                    <?php
                    foreach ($penerima as $p) {
                    ?>
                      <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                        <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?= $p->nama_lengkap ?></small>
                        <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?= ($p->id_unit_kerja > 0) ? $p->nama_jabatan : "Kepala SKPD" ?></small>
                      </div>
                    <?php } ?>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_surat) ?></span>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if (!empty($detail->file_lampiran)) { ?>
              <div class="panel panel-primary">
                <div class="panel-body">
                  <h3 style="color: #6003C8">LAMPIRAN SURAT</h3>
                  <div class="text-center">
                    <i class="ti-file" style="font-size: 100px"></i>
                    <p style="margin-top: 10px"><?= $detail->file_lampiran ?></p>
                    <a target="blank" href="<?= base_url('data/surat_internal/lampiran/' . $detail->file_lampiran . '') ?>" style="color: #fff" class="btn btn-primary btn-block"><i class="ti-cloud-down"></i> Download Lampiran</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-body" style="border-top: solid 5px #6003C8">
          <h3 style="color: #6003C8" class="box-title"><?= $detail->nama_surat ?></h3>
          <br>
          <div class="col-md-6">
            <table class="table b-b">
              <tr>
                <td style="width: 100px;">No Surat </td>
                <td>:</td>
                <td> <strong><?= $detail->nomer_surat ?></strong>
              </tr>
              <tr>
                <td style="width: 100px;">Perihal </td>
                <td>:</td>
                <td> <strong><?= $detail->perihal ?></strong>
              </tr>
            </table>
          </div>
          <!--/span-->
          <div class="col-md-6">
            <table class="table b-b">
              <tr>
                <td style="width: 200px">Nomor Registrasi Sistem</td>
                <td>:</td>
                <td> <strong><?= ucwords($detail->hash_id) ?></strong>
              </tr>
              <tr>
                <td>Sifat</td>
                <td>:</td>
                <td> <strong><?= ucwords($detail->sifat_surat) ?></strong>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
          <?php
          if ($detail->status_ttd == "sudah_ditandatangani") {
            $viewer = "https://docs.google.com/viewer?url=" . base_url('data/surat_internal/ttd/' . $detail->file_ttd . '');
            $m_icon = "ti-check";
            $m_alert = "success";
            $m_text = "Surat ini telah selesai ditandatangani dan sudah diteruskan ke penerima.";
          } else {
            $name =  $detail->file_verifikasi;
            $ext = explode('.', $name)[1];
            if ($ext == "docx") {
              $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=" . base_url('data/surat_internal/keluar/' . $detail->file_verifikasi . '');
            } else {
              $viewer = "https://docs.google.com/viewer?url=" . base_url('data/surat_internal/draf_pdf/' . $detail->file_verifikasi . '');
            }
            $m_icon = "ti-info";
            $m_alert = "danger";
            $m_text = "Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.";
          }
          ?>
          <div class="alert alert-<?= $m_alert ?>">
            <i class="<?= $m_icon ?>"></i> <?= $m_text ?>
          </div>
          <iframe src="<?= $viewer ?>
                  &embedded=true" width="100%" height="700" style="border: none;"></iframe>
        </div>
        <?php if ($detail->status_ttd == "menunggu_ditandatangani") { ?>
          <div class="panel-footer">
            <form method="POST">
              <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#passphrase"><span class="btn-label"><i class="ti-check"></i></span> Tanda Tangani</a>
              <a href="javascript:void(0)" class="btn btn-danger" data-toggle="modal" data-target="#mdTolak"><span class="btn-label"><i class="ti-close"></i></span>Tolak</a>
          </div>
          <!--    <button class="btn btn-default btn-outline" type="button" data-toggle="modal" data-target="#mdKembali"><span class="btn-label"><i class="ti-back-left"></i></span>Kembali Perbaiki</button>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#mdTolak"><span class="btn-label"><i class="ti-close"></i></span>Tolak Peredaran</button> -->
          </form>
      </div>
    <?php } ?>
    <div class="white-box">
      <div class="row" style="margin-bottom: 15px">
        <span style="float: left">
          <?php
          if ($detail->status_ttd == 'sudah_ditandatangani') {
            $a_type = 'primary';
            $icon = 'ti-check';
            $a_message = '<i class="ti-check"></i> Surat sudah ditandatangani';
          } elseif ($detail->status_ttd == 'ditolak') {
            $a_type = 'danger';
            $icon = 'ti-close';
            $a_message = '<i class="ti-close"></i> Surat ditolak';
          } else {
            $a_type = 'warning';
            $icon = 'ti-time';
            $a_message = '<i class="ti-time"></i> Surat sedang dalam proses penandatanganan';
          }
          ?>
          <h5 class="box-title"><i style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%" class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Verifikasi Surat</span></h5></span>
        <span style="float: right;text-align: center;margin-top: -10px;">
          <p style="display: block;margin:2px">Status Verifikasi</p>
          <i style="position: absolute;z-index: 999;color:#fff;background-color: #6003C8;padding: 6px;border-radius: 50%;margin-top: -2px" class="<?= $icon ?>"></i> <span style="position: relative;padding:6px;border :solid 1px #cdcdcd;color:#6003C8 " class="label"><span style="margin-left: 22px"><?= normal_string($detail->status_ttd) ?></span></span>
        </span>
      </div>
      <div class="alert alert-<?= $a_type ?>">
        <?= $a_message ?>
      </div>
      <?php if ($detail->file_ttd) { ?>
        <a href="<?= base_url('data/surat_internal/ttd/' . $detail->file_ttd . '') ?>" class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat Selesai TTD</a>

      <?php } else {
      ?>

        <a href="<?= base_url('data/surat_internal/draf_pdf/' . $detail->file_verifikasi . '') ?>" class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat</a>
      <?php
      } ?>
    </div>

    </div>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Draf Surat</h4>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
            <label>File Surat (.pdf)</label>
            <input type="file" name="file_verifikasi" class="dropify">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
          <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-cloud-up"></i> Upload</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <div id="passphrase" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Passpharse Sertifikat Digital</h4>
        </div>
        <div class="modal-body">
          <div id="passMessage"></div>
          <form method="POST" enctype="multipart/form-data" id="ttdForm">
            <label>Passpharse</label>
            <input type="password" placeholder="Masukkan Passpharse sertifikat digital Anda" name="passkey" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
          <button class="btn btn-primary" type="submit" name="terima"><span class="btn-label"><i class="ti-check"></i></span> Tanda Tangani</button>
          </form>
        </div>
      </div>

    </div>
  </div>
  <script>
    function tandaTangani() {
      $('#btnTTD').html('<span class="btn-label"><i class="fa fa-circle-o-notch fa-spin"></i></span> Menandatangani ...');
      $('#passMessage').html('');
      // $.ajaxSetup({timeout:30000});
      $.get("<?= base_url('dummy') ?>")
        .done(function() {
          $('#btnTTD').attr('type', 'submit');
          $('#btnTTD').click();
        })
        .fail(function() {
          $('#passMessage').html('<div class="alert alert-danger">Tampaknya ada masalah pada Koneksi Internet Anda, silahkan coba lagi</div>');
          $('#btnTTD').html('<span class="btn-label"><i class="ti-check"></i></span> Tanda Tangani');
        });
    }
  </script>


  <div id="mdKembali" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tolak TTD Surat</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea class="form-control" name="alasan_penolakan_ttd" placeholder="Masukkan Alasan Penolakan"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" type="submit" name="kembali"><span class="btn-label"><i class="ti-back-left"></i></span>Kembalikan ke Draf</button>
          </form>
        </div>
      </div>

    </div>
  </div>



  <div id="mdTolak" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tolak Tandatangan Surat</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea class="form-control" name="alasan_penolakan_ttd" placeholder="Masukkan Alasan Penolakan"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" type="submit" name="tolak"><span class="btn-label"><i class="ti-close"></i></span>Tolak</button>
          </form>
        </div>
      </div>

    </div>
  </div>