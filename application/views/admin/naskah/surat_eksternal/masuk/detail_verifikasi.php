<?php
if ($detail->status_verifikasi == 'sudah_diverifikasi') {
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-letter";
  $icon2 = "icon-check";
} elseif ($detail->status_verifikasi == "ditolak") {
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-envelope-open";
  $icon2 = "icon-close";
} elseif ($detail->status_verifikasi == "belum_diverifikasi") {
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
}
?>

<?php
if ($detail->surat_desa) {
  $url = "https://e-officedesa.sumedangkab.go.id";
} elseif ($detail->surat_dewan) {
  $url = "https://e-officedprd.sumedangkab.go.id";
} else {
  $url = base_url();
}
?>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Verifikasi Surat Masuk Eksternal</h4>
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
  <div class="col-md-12">
    <a href="<?= base_url('surat_eksternal/surat_masuk') ?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a><br><br>
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
                        <i style="background-color: <?= $color2 ?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?= $icon2 ?>"></i> <?= normal_string($detail->status_verifikasi) ?>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Pengirim</h6>
                    <h5><?= $detail->pengirim ?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tanggal_surat) ?></span>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12 text-center">
                    <h6 style="font-weight: 500">Penerima</h6>
                    <h5><?= empty($detail->nama_lengkap) ? '<span class="text-danger">Surat belum diteruskan</span>' : $detail->nama_lengkap ?></h5>
                    <span class="badge" style="background-color: grey;font-size:10px;"><?= tanggal($detail->tgl_input) ?></span>
                  </div>
                </div>
                <hr>
                <a href="<?= $url ?>/data/surat_eksternal/surat_masuk/<?= $detail->file_surat ?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
          <?php 
            if($detail->status_verifikasi=='sudah_diverifikasi'){
              ?>
              <a disabled style="color:white" href="javascript:void(0)"  class="btn btn-success btn-block btn-disabled"><i class="ti-check"></i> Sudah diteruskan</a>
              <?php }else{?>
                <a style="color:white" href="javascript:void(0)" onclick="modalTeruskan()" class="btn btn-primary btn-block"><i class="ti-shift-right-alt"></i> Teruskan Surat</a>
              <?php } ?>
                <!-- <a href="<?php echo base_url('surat_eksternal/edit_surat_masuk/' . $detail->id_surat_masuk) ?>" class="btn btn-info btn-block btn-outline"><i class="ti-pencil"></i> Edit Surat</a> -->
                <!-- <a href="javascript:void(0)" onclick="delete_ss_(<?= $detail->id_surat_masuk ?>)" class="btn btn-danger btn-block btn-outline"><i class="fa fa-trash"></i> Hapus Surat</a> -->
              </div>
            </div>
          </div>

          <?php 
            if($detail->status_verifikasi=='sudah_diverifikasi'){
              ?>
              <div class="col-md-12 col-sm-6">
                <div class="white-box">
                  <h4 class="box-title">DITERUSKAN KEPADA</h4>
                  <div style="display: flex;">
                    <img src="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai) ?>" style="width:50px;height:50px;object-fit:cover">
                    <div style="display:flex;flex-direction:column;margin-left:10px">
                      <span style="font-weight:500" class="text-purple"><?= $detail->nama_lengkap ?></span>
                      <span><?= $detail->jabatan ?></span>
                    </div>
                  </div>
                  <p class="text-muted" style="margin-top:5px"><small><i class="ti-calendar"></i> <?=$detail->tgl_verifikasi?></small></p>
                </div>
              </div>
              <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-body" style="border-top: solid 5px #6003C8">

            <h3 style="color: #6003C8" class="box-title"><span style="color: #222">PERIHAL : </span> <?= $detail->perihal ?></h3>

            <br>
            <div class="col-md-6">
              <table class="table b-b">
                <tr>
                  <td style="width: 100px;">No Surat </td>
                  <td>:</td>
                  <td> <strong><?= ($detail->jenis_surat == 'eksternal') ? $detail->nomer_surat : $detail->indeks . '/' . $detail->kode . '/' . $detail->no_urut ?> </strong>
                </tr>
                <tr>
                  <td style="width: 100px;">Sifat</td>
                  <td>:</td>
                  <td> <strong><?= humanize($detail->sifat) ?></strong>
                </tr>
              </table>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <table class="table b-b">
                <tr>
                  <td style="width: 100px;">Catatan </td>
                  <td>:</td>
                  <td> <strong><?= empty($detail->catatan) ? '-' : $detail->catatan ?> </strong>
                </tr>
                <tr>
                  <td style="width: 100px;">Ringkasan </td>
                  <td>:</td>
                  <td> <strong><?= empty($detail->isi_ringkasan) ? '-' : $detail->isi_ringkasan ?> </strong>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
          <?php
          if ($detail->status_verifikasi == 'sudah_diverifikasi') {
          ?>
            <div class="alert alert-success">
              <i class="ti-check"></i> Surat ini sudah diverifikasi dan sudah diteruskan kepada Penerima.
            </div>
          <?php
          } else {
          ?>
            <div class="alert alert-danger">
              <i class="ti-info"></i> Dokumen dibawah ini hanya versi preview (pratinjau), untuk melihat dokumen asli silahkan download surat ini.
            </div>
          <?php
          }
          ?>
          <iframe src="https://docs.google.com/viewer?url=<?= $url ?>/data/surat_eksternal/surat_masuk/<?= $detail->file_surat ?>&embedded=true" width="100%" height="700" style="border: none;"></iframe>
        </div>
      </div>
      <span style="background-color: #fff;padding: 10px;font-weight: 500;border-left: solid 3px #6003C8;margin-bottom: 10px;">Lampiran</span>
      <br>
      <br>
      <?php
      if (!empty($detail->lampiran) && $detail->lampiran !== "-") { ?>
        <div class="row">
          <div class="col-md-2">
            <div class="panel panel-default text-center">
              <div class="panel-body">
                <i class="ti-file" style="font-size:60px;"></i>
                <p style="word-wrap: break-word;margin: 10px 0px"><?= $detail->lampiran ?></p>
                <a href="<?= $url ?>/data/surat_eksternal/lampiran/<?= $detail->lampiran ?>" class="btn btn-primary btn-block"><i class="ti-download"></i> Download</a>
              </div>
            </div>
          </div>
        </div>
      <?php } else {
        echo "Tidak ada lampiran";
      } ?>


    </div>
  </div>


  <div id="modalTeruskan" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Teruskan Surat</h4>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label class="">Teruskan verifikasi kepada :</label>
              <select id="id_pegawai" name="id_pegawai" class="select2 m-b-10 form-control" data-placeholder="Pilih Verifikator" required>
                <option value="">Pilih Anggota Dewan</option>
                <?php
                foreach ($pegawai_teruskan as $pt) {
                  echo '<option value="' . $pt->id_pegawai . '">' . $pt->nama_lengkap . ' - ' . $pt->jabatan . '</option>';
                }
                ?>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" type="submit"><span class="btn-label"><i class="ti-shift-right"></i></span>Setujui & Teruskan</button>
          </form>
        </div>
      </div>

    </div>
  </div>

  <script>
    function modalTeruskan() {
      $('#modalTeruskan').modal('show');
    }
  </script>