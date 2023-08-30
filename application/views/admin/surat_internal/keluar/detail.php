<?php
if ($detail->status_surat == 'Sudah Dibaca') {
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-letter";
  $icon2 = "icon-check";
} elseif ($detail->status_surat == "Belum Dibaca") {
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-envelope-open";
  $icon2 = "icon-close";
} elseif ($detail->status_surat == "Perlu Tanggapan") {
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
}
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
?>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Surat Keluar Internal</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <?= breadcrumb($this->uri->segment_array()) ?>
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
  <div class="row">
    <div class="col-md-12">
      <a href="<?= base_url('surat_internal/surat_keluar') ?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a>
      <button onclick="show_monitoring();" data-toggle="modal" data-target="#monitoring" class="m-r-10 pull-right btn btn-primary"><i class="ti-zoom-in"></i> Monitoring Surat</button>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="panel panel-primary">
              <div class="panel-body" style="border-top: solid 5px #6003C8">
                <div class="text-center">

                  <p>
                    <i style="font-size: 70px;" class="text-<?= $c1 ?> <?= $i1 ?>"></i>
                  </p>
                  <p>
                    <span class="text-<?= $c1 ?>">
                      <i style="background-color: <?= $c2 ?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?= $i2 ?>"></i> <?= $text ?>
                    </span>
                  </p>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Pengirim</h6>
                    <h5> <?= $detail->nama_skpd ?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_buat) ?></span>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Penerima</h6>
                    <?php
                    foreach ($penerima as $p) {
                    ?>

                      <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                        <?php
                        if ($status_surat == "sudah_ditandatangani") {
                          if ($p->dibaca == "Y") {
                        ?>
                            <i data-toggle="tooltip" data-placement="top" title="Sudah Dibaca" style="background:#00c292;padding:4px;font-size:12px;border-radius:50%;position: absolute;right: 15px;color: #fff" class="icon-envelope-open"></i>
                          <?php
                          } else {
                          ?>
                            <i data-toggle="tooltip" data-placement="top" title="Belum Dibaca" style="background:#F75B36;padding:4px;font-size:12px;border-radius:50%;position: absolute;right: 15px;color: #fff" class="icon-envelope-letter"></i>
                          <?php
                          }
                          ?>
                        <?php
                        }

                        ?>
                        <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?= $p->nama_lengkap ?></small>
                        <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?= ($p->id_unit_kerja > 0) ? $p->nama_jabatan : "Kepala SKPD" ?></small>
                      </div>
                    <?php } ?>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_surat) ?></span>
                  </div>
                </div>
                <hr />
                <?php
                if (!empty($tembusan)) {
                ?>
                  <h6 style="font-weight: 500;text-align: center;">Tembusan</h6>
                <?php } ?>

                <?php
                foreach ($tembusan as $p) {
                ?>
                  <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px;position: relative;">

                    <?php
                    if ($status_surat == "sudah_ditandatangani") {
                      if ($p->status_tembusan == "Sudah Dibaca") {
                    ?>
                        <i data-toggle="tooltip" data-placement="top" title="Sudah Dibaca" style="background:#00c292;padding:4px;font-size:12px;border-radius:50%;position: absolute;right: 15px;color: #fff" class="icon-envelope-open"></i>
                      <?php
                      } else {
                      ?>
                        <i data-toggle="tooltip" data-placement="top" title="Belum Dibaca" style="background:#F75B36;padding:4px;font-size:12px;border-radius:50%;position: absolute;right: 15px;color: #fff" class="icon-envelope-letter"></i>
                      <?php
                      }
                      ?>
                    <?php
                    }

                    ?>
                    <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?= $p->nama_lengkap ?></small>
                    <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?= $p->jabatan ?></small>
                  </div>
                <?php
                } ?>
                <hr>
                <?php
                if ($detail->status_ttd == "sudah_ditandatangani") {
                ?>
                  <a href="<?= base_url('data/surat_internal/ttd/' . $detail->file_ttd . '') ?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
                <?php
                } else {
                ?>
                  <a href="<?= base_url('data/surat_internal/keluar/' . $detail->file_draft_surat . '') ?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
                <?php } ?>
                <?php
                if ($detail->status_verifikasi !== 'sudah_diverifikasi') {
                ?>
                  <a href="javascript:void(0)" onclick="deleteSurat(<?= $detail->id_surat_keluar ?>)" class="btn btn-danger btn-block btn-outline"><i class="fa fa-trash"></i> Hapus Surat</a>
                  <a href="<?= base_url('surat_internal/edit_surat_keluar/' . $detail->id_ref_surat . '/' . $detail->id_surat_keluar) ?>" class="btn btn-info btn-block btn-outline"><i class="ti-pencil"></i> Edit Surat</a>
                <?php } ?>

                <?php
                if ($status_surat == 'belum_diupload') {
                ?>
                  <a href="<?= base_url('surat_internal/buat_ulang_surat/' . $detail->id_surat_keluar) ?>" class="btn btn-info btn-block" style="color: #fff !important"><i class="ti-reload"></i> Refresh Surat</a>
                <?php
                }
                ?>
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
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-body" style="border-top: solid 5px #6003C8">
          <h3 style="color: #6003C8" class="box-title"><?= $detail->nama_surat ?></h3>
          <br>
          <div class="col-md-6">
            <table class="table b-b">
              <tr>
                <td class="table-title-1">No Surat </td>
                <td width="10px">:</td>
                <td> <strong><?= $detail->nomer_surat ?></strong></td>
              </tr>
              <tr>
                <td>Perihal </td>
                <td>:</td>
                <td> <strong><?= $detail->perihal ?></strong></td>
              </tr>
            </table>
          </div>
          <!--/span-->
          <div class="col-md-6">
            <table class="table b-b">
              <tr>
                <td class="table-title-2">Nomor Registrasi Sistem</td>
                <td width="10px">:</td>
                <td> <strong><?= ucwords($detail->hash_id) ?></strong></td>
              </tr>
              <tr>
                <td>Sifat</td>
                <td>:</td>
                <td> <strong><?= ucwords($detail->sifat_surat) ?></strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <?php
          if ($detail->status_ttd == "sudah_ditandatangani") {
            $viewer = "https://docs.google.com/viewer?url=" . base_url('data/surat_internal/ttd/' . $detail->file_ttd . '');
            $m_icon = "ti-check";
            $m_alert = "success";
            $m_text = "Surat yang Anda buat telah selesai ditandatangani dan sudah diteruskan ke penerima.";
          } else {
            $viewer = "https://view.officeapps.live.com/op/embed.aspx?src=" . base_url('data/surat_internal/keluar/' . $detail->file_draft_surat . '');
            $m_icon = "ti-info";
            $m_alert = "danger";
            $m_text = "Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.";
          }
          ?>
          <div class="alert alert-<?= $m_alert ?>">
            <i class="<?= $m_icon ?>"></i> <?= $m_text ?>
          </div>

          <iframe src="<?= $viewer ?>&embedded=true" width="100%" height="700" style="border: none;"></iframe>
        </div>
      </div>
      <div class="white-box">
        <div class="row" style="margin-bottom: 15px">
          <span style="float: left">
            <?php
            $tolak = '';
            if ($detail->status_verifikasi == 'sudah_diverifikasi') {
              if ($status_surat == 'ditolak_ttd') {
                $a_type = 'danger';
                $icon = 'ti-close';
                $a_message = '<i class="ti-close"></i> Surat ditolak oleh <b>Penandatangan</b>, silahkan koreksi surat anda lalu upload kembali';
                $tolak = 'ttd';
              } elseif ($status_surat == 'ditolak_penomoran') {
                $a_type = 'danger';
                $icon = 'ti-close';
                $a_message = '<i class="ti-close"></i> Surat ditolak oleh <b>Bagian Penomoran</b>, silahkan koreksi surat anda lalu upload kembali';
                $tolak = 'penomoran';
              } else {
                $a_type = 'primary';
                $icon = 'ti-check';
                $a_message = '<i class="ti-check"></i> Surat sudah disetujui oleh verifikator, untuk melihat perjalanan surat silahkan cek menu <a style="color:#fff;font-weight:500" href="' . base_url('monitoring_surat_keluar') . '">Monitoring Surat Keluar</a>';
              }
            } elseif ($detail->status_verifikasi == 'menunggu_verifikasi') {
              $a_type = 'info';
              $icon = 'ti-time';
              $a_message = '<i class="ti-time"></i> Surat sedang dalam proses verifikasi';
            } elseif ($detail->status_verifikasi == 'ditolak') {
              $a_type = 'danger';
              $icon = 'ti-close';
              $a_message = '<i class="ti-close"></i> Surat ditolak oleh <b>Verifikator</b>, silahkan koreksi surat anda lalu upload kembali';
              $tolak = 'verifikasi';
            } else {
              $a_type = 'danger';
              $icon = 'ti-alert';
              $detail->status_verifikasi = 'Belum mengupload';
              $a_message = '<i class="ti-alert"></i> Anda belum meng-upload draf surat, silahkan klik tombol Download dibawah lalu Upload kembali';
            }
            ?>
            <h5 class="box-title"><i style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%" class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Verifikasi Surat</span></h5></span>
          <span class="mail-status-message">
            <p class="hidden-xs" class="status-label">Status Verifikasi</p>
            <i class="status-icon <?= $icon ?>"></i>
            <span class="label hidden-xs status-container">
              <span class="status-text"><?= normal_string($detail->status_verifikasi) ?></span>
            </span>
          </span>
        </div>
        <div class="alert alert-<?= $a_type ?>">
          <?= $a_message ?>
        </div>
        <?php
        if (!empty($tolak)) {
          if ($tolak == 'verifikasi') {
            $alasan_penolakan = $detail->alasan_penolakan_verifikasi;
          } elseif ($tolak == 'ttd') {
            $alasan_penolakan = $detail->alasan_penolakan_ttd;
          } elseif ($tolak == 'penomoran') {
            $alasan_penolakan = $detail->alasan_penolakan_penomoran;
          }
        ?>
          <div class="row">
            <div class="col-md-12">
              <b>Alasan Penolakan</b> : <span class="text-danger" style="font-weight: 400"><?= $alasan_penolakan ?></span>
            </div>
          </div>
        <?php
        }

        ?>

        <div class="row">
          <?php
          if ($detail->status_ttd == "sudah_ditandatangani") {
          ?>
            <a href="<?= base_url('data/surat_internal/ttd/' . $detail->file_ttd . '') ?>" class="btn btn-primary" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat Selesai TTD</a>
          <?php
          } else {
          ?>
          <div class="col-lg-4 col-md-5 col-sm-6 btn-margin-top">
            <a href="<?= base_url('data/surat_internal/keluar/' . $detail->file_draft_surat . '') ?>" class="btn btn-primary btn-block" type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Draf Surat</a>
          </div>
            <?php
            if ($detail->status_verifikasi == 'sudah_diverifikasi' && empty($tolak)) {
            ?>
              <a href="javascript:void(0)" class="btn btn-default btn-outline" type="button" disabled><span class="btn-label"><i class="ti-cloud-up"></i></span>
                <?= empty($detail->file_verifikasi) || is_null($detail->file_verifikasi) ? "Upload" : "Upload Ulang" ?> Draf Surat</a>
            <?php } else {
            ?>
            <div class="col-lg-4 col-md-5 col-sm-6 btn-margin-top">
              <a href="javascript:void(0)" class="btn btn-default btn-outline btn-block" type="button" data-toggle="modal" data-target="#myModal"><span class="btn-label"><i class="ti-cloud-up"></i></span>
                <?= empty($detail->file_verifikasi) || is_null($detail->file_verifikasi) ? "Upload" : "Upload Ulang" ?> Draf Surat</a>
          </div>
            <?php
            } ?>
          <?php
          }
          ?>
        </div>

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
            <label>File Surat (.docx)</label>
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

  <script type="text/javascript">
    function deleteSurat(id) {
      swal({
          title: "Hapus Data",
          text: "Apakah anda yakin akan menghapus data ini?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Ya',
          cancelButtonText: "Tidak",
          closeOnConfirm: false
        },
        function(isConfirm) {
          if (isConfirm) {
            $.ajax({
              url: "<?= base_url() . 'surat_internal/delete_surat_keluar/' ?>" + id,
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                swal("Berhasil", "Data Berhasil Dihapus!", "success");
                // location.reload();
                window.location.href = "<?= base_url() . 'surat_internal/surat_keluar' ?>";
              },
              error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
              }
            });
          }
        });
    }
  </script>
  <div id="monitoring" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Monitoring Surat</h4>
        </div>
        <div class="modal-body" id="monitoring-body">
          loading..
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript">
    function show_monitoring() {
      $.post("<?= base_url('monitoring_surat_keluar/detail/' . $detail->id_surat_keluar) ?>", {}, function(obj) {
        $('#monitoring-body').html(obj);
      });
    }
  </script>