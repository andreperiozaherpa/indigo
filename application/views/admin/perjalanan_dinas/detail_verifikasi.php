<?php
if ($detail->status_verifikasi == 'sudah_diverifikasi') {
  $cstatus = 'success';
} else if ($detail->status_verifikasi == 'ditolak') {
  $cstatus = 'danger';
} else {
  $cstatus = 'warning';
}
?>
<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Perjalanan Dinas</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
      <a href="<?= base_url('perjalanan_dinas') ?>" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">

    <div class="white-box">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">INFORMASI PERJALANAN DINAS : <?= $detail->nama_unit_kerja ?><div class="pull-right">
                <?php
                if ($detail->status_verifikasi !== 'sudah_diverifikasi') {
                  if ($status_file == true) {
                ?>

                    <a onclick="return confirm('Apakah Anda yakin akan memverifikasi Ajuan Perjalanan Dinas ini?')" href="<?= base_url('perjalanan_dinas/action_verifikasi/' . $detail->id_perjalanan_dinas . '/sudah_diverifikasi') ?>" class="btn btn-success" style="margin-top:-7.5px;margin-left:5px"><i class="ti-check"></i> Verifikasi</a>
                  <?php
                  } else {
                  ?>
                    <a onclick="return alert('Masih ada file yang belum diverifikasi')" href="javascript:void(0)" class="btn btn-success" style="margin-top:-7.5px;margin-left:5px"><i class="ti-check"></i> Verifikasi</a>
                  <?php } ?>
                  <a href="javascript:void(0)" onclick="tolakVerifikasi()" class="btn btn-danger" style="margin-top:-7.5px;margin-left:5px"><i class="ti-close"></i> Tolak</a>
                <?php
                } else {
                ?>       <?php
                if ($detail->status_pencairan !== 'sudah_dicairkan') {
                  ?>
                  <a href="javascript:void(0)" onclick="sudahDicairkan()" class="btn btn-info" style="margin-top:-7.5px;margin-left:5px;color:#ffffff"><i class="ti-check"></i> Tandai Sudah Dicairkan</a>
                  <?php
                }else{
                  ?>
                  <a href="javascript:void(0)" class="btn btn-primary btn-outline" style="margin-top:-7.5px;margin-left:5px;color:#6003c8"><i class="ti-check"></i> Sudah Dicairkan</a>
                  <?php
                }
                ?>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <?php
                if ($detail->status_verifikasi == 'sudah_diverifikasi') {
                  $message_v = 'Ajuan ini sudah terverifikasi';
                } else if ($detail->status_verifikasi == 'ditolak') {
                  $message_v = 'Ajuan ini telah ditolak dengan alasan : ' . $detail->alasan_penolakan;
                } else {
                  $message_v = 'Ajuan ini sedang menunggu verifikasi dari Anda';
                }
                ?>
                <div class="alert alert-<?= $cstatus ?>"><?= $message_v ?></div>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width: 180px;">Status Verifikasi</td>
                        <td>:</td>
                        <td class="text-<?= $cstatus ?>"><strong><?= normal_string($detail->status_verifikasi) ?> </strong> <?=$detail->status_pencairan=='sudah_dicairkan' ? ' - Dicairkan tanggal '.tanggal($detail->tanggal_pencairan) : null?></td>
                      </tr>
                      <tr>
                        <td style="width: 180px;">Jenis Perjalanan </td>
                        <td>:</td>
                        <td> <strong><?= normal_string($detail->jenis_perjalanan) ?> <?= $detail->jenis_perjalanan == "biasa" ? "- " . normal_string($detail->sub_jenis_perjalanan) : null ?></strong></td>
                      </tr>
                      <tr>
                        <td style="width: 180px;">Tujuan </td>
                        <td>:</td>
                        <td> <strong><?= ($detail->tujuan) ?> </strong></td>
                      </tr>
                      <tr>
                        <td style="width: 180px;">Waktu Pelaksanaan</td>
                        <td>:</td>
                        <td> <strong> <?= tanggal($detail->tanggal_awal) ?> <?= !empty($detail->tanggal_akhir) ? "s.d " . tanggal($detail->tanggal_akhir) : '' ?></strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 180px;">Deskripsi Kegiatan</td>
                        <td>:</td>
                        <td> <strong> <?= $detail->deskripsi_kegiatan ?> </strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <h3 class="box-title">PEMBIAYAAN <a href="<?= base_url('perjalanan_dinas/edit_verifikasi/pembiayaan/' . $detail->id_perjalanan_dinas) ?>" class="btn btn-info pull-right"><i class="ti-pencil"></i> EDIT PEMBIAYAAN</a> </h3>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Nomor BKU</label>
              <p><?= !empty($detail->no_bku) ?  $detail->no_bku :  '<span class="text-muted">Belum Diisi</span>' ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kode Rekening</label>
              <p><?= $detail->kode_rekening ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Nomor Rekening</label>
              <p><?= $detail->nomor_rekening ?></p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Biaya Transport</label>
              <p><?= rupiah($detail->biaya_transport) ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Transportasi</label>
              <p><?= normal_string($detail->jenis_transportasi) ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Uang Refresentasi</label>
              <p><?= rupiah($detail->uang_refresentasi) ?></p>
            </div>
          </div>
        </div>
        <table class="table table-bordered color-table primary-table" id="tablePegawai">
          <thead>
            <tr>
              <th rowspan="2" style="vertical-align: middle;text-align:center;width:30%">Nama Pegawai</th>
              <th colspan="2" style="vertical-align: middle;text-align:center">Uang Harian</th>
              <th colspan="2" style="vertical-align: middle;text-align:center">Biaya Penginapan</th>
            </tr>
            <tr>
              <th style="vertical-align: middle;text-align:center;">Vol</th>
              <th style="vertical-align: middle;text-align:center">Rp</th>
              <th style="vertical-align: middle;text-align:center">Vol</th>
              <th style="vertical-align: middle;text-align:center">Rp</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($pembiayaan as $k => $p) {
            ?>
              <tr>
                <td>
                  <?= !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai ?>
                  <?= ($p->is_koordinator == "Y") ? '<span class="label label-success">Koordinator</span>' : null ?>
                  <?= ($p->jenis_pegawai_p == "non_pns") ? '<span class="label label-primary">Non PNS</span>' : null ?>
                </td>
                <td style="text-align: center;">
                  <?= $p->volume_uh ?>
                </td>
                <td style="text-align: center;">

                  <?= rupiah($p->nominal_uh) ?>
                </td>

                <td style="text-align: center;">
                  <?= $p->volume_bp ?>
                </td>
                <td style="text-align: center;">

                  <?= rupiah($p->nominal_bp) ?>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-4">
      <div class="white-box">
        <h3 class="box-title">Download Template</h3>
        <a class="btn btn-primary btn-block" href="<?= base_url('perjalanan_dinas/ajuan_rekap/non_ttd/' . $detail->id_perjalanan_dinas) ?>""><i class=" ti-download"></i> Ajuan Rekap Tandatangan</a>
        <a class="btn btn-primary btn-block" href="<?= base_url('perjalanan_dinas/ajuan_rekap/ttd/' . $detail->id_perjalanan_dinas) ?>""><i class=" ti-download"></i> Ajuan Rekap Tandatangan</a>
        <a class="btn btn-primary btn-block" href="<?= base_url('perjalanan_dinas/ceklis_pemeriksaan/' . $detail->id_perjalanan_dinas) ?>""><i class=" ti-download"></i> Ceklis Pemeriksaan </a>
        <?php
        foreach ($pembiayaan as $k => $p) {
        ?>
          <a class="btn btn-primary btn-block" href="<?= base_url('perjalanan_dinas/fakta_integritas/' . $p->id_perjalanan_dinas_pembiayaan) ?>"><i class="ti-download"></i> Fakta Integritas <?= !empty($p->id_pegawai) ? $p->nama_lengkap : $p->nama_pegawai ?></a>
        <?php
        }
        ?>
      </div>
    </div>
    <div class="col-md-8">
      <div class="white-box">
        <h3 class="box-title">FILE PENDUKUNG</h3>
        <?= form_open_multipart() ?>
        <table id="tableFile" class="table table-bordered color-table primary-table">
          <thead>
            <tr>
              <th style="vertical-align: middle;text-align:center;width:60%">Nama File</th>
              <th style="vertical-align: middle;text-align:center">Upload</th>
              <th style="vertical-align: middle;text-align:center;width:20%"></th>
            </tr>
          </thead>
          <tbody>
            <?php


            foreach ($files as $r) {
              $cek = $this->perjalanan_dinas_model->get_file_by_name($r['label'], $detail->id_perjalanan_dinas);
            ?>
              <tr>
                <td style="vertical-align: middle;">
                <?php 
                  if($r['type']=='static'){
                ?>
                  <span style="display: block;"><?= $r['label'] ?></span>
                  <input type="hidden" class="form-control" value="<?= $r['label'] ?>" name="nama_file[]" placeholder="Masukkan Nama File" readonly>
                <?php } else{ ?>
                  <input type="text" class="form-control m-b-10" value="<?= $r['label'] ?>" name="nama_file[]" placeholder="Masukkan Nama File">
                <?php } ?>
                  <?php
                  if ($cek) {
                    if ($cek->status_verifikasi !== 'menunggu_verifikasi') {
                      echo status_perdin($cek->status_verifikasi);
                    }
                    if ($cek->status_verifikasi == 'ditolak') {
                  ?>
                      <span style="display: block;"><b>Alasan : </b><span class="text-danger"><?= $cek->alasan_penolakan ?></span></span>
                  <?php
                    }
                  }
                  ?>
                </td>
                <td>
                  <input type="file" class="form-control" name="path[]">
                  <?php
                  if ($cek) {
                  ?>
                    <a href="<?= base_url('data/file_pendukung_perjalanan_dinas/' . $cek->path) ?>" class="btn btn-primary btn-xs" style="margin-top: 10px;"><?= strlen($cek->path) > 40 ?  substr($cek->path, 0, 40) . "..." :  $cek->path ?></a>
                  <?php
                  }
                  ?>
                </td>
                <td style="vertical-align: middle;text-align:center"> <?php
                                                                      if ($cek) {
                                                                      ?>
                    <a onclick="return confirm('Apakah Anda yakin akan memverifikasi file ini?')" href="<?= base_url('perjalanan_dinas/action_verifikasi_file/' . $detail->id_perjalanan_dinas . '/' . $cek->id_perjalanan_dinas_file . '/sudah_diverifikasi') ?>" class="btn btn-success btn-circle"><i class="ti-check"></i></a>
                    <button type="button" onclick="tolakFile(<?= $cek->id_perjalanan_dinas_file ?>)" class="btn btn-warning btn-circle"><i class="ti-close"></i></button> <?php
                                                                                                                                                                      }
                                                                                                                                                                        ?>
                  <button type="button" class="btn btn-danger btn-circle deleteFile"><i class="ti-trash"></i></button>
                </td>
              </tr>
            <?php } ?>


            <tr>
              <td>
                <input type="text" class="form-control" name="nama_file[]" placeholder="Masukkan Nama File">
              </td>
              <td>
                <input type="file" class="form-control" name="path[]">
              </td>
              <td style="vertical-align: middle;text-align:center">
                <button type="button" class="btn btn-danger btn-circle deleteFile"><i class="ti-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-md-12">
            <button id="addFile" type="button" class="btn btn-primary pull-right"><i class="ti-plus"></i> Tambah File</button>
          </div>
        </div>
        <hr>
        <button type="submit" name="type" value="file" class="btn btn-primary"><i class="ti-save"></i> Simpan File Pendukung</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="modalTolakVerifikasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Tolak Pengajuan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('perjalanan_dinas/action_verifikasi/' . $detail->id_perjalanan_dinas . '/ditolak') ?>">
          <label>Alasan Penolakan</label>
          <textarea class="form-control" name="alasan_penolakan" placeholder="Masukkan Alasan Penolakan"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger waves-effect">Tolak</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="modalTolakFile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalFile">Tolak Pengajuan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="formTolakFile">
          <label>Alasan Penolakan</label>
          <textarea class="form-control" name="alasan_penolakan" placeholder="Masukkan Alasan Penolakan"></textarea>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger waves-effect">Tolak</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="modalCairkan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalCairkan">Tandai Sudah Dicairkan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="formCairkan">
          <label>Tanggal Pencairan</label>
          <input type="text" class="form-control mydatepicker" placeholder="Masukkan Tanggal Pencairan" autocomplete="off" name="tanggal_pencairan"/>
      </div>
      <div class="modal-footer">
        <button type="submit" name="type" value="sudah_dicairkan" class="btn btn-primary"><i class="ti-save"></i> Simpan File Pendukung</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
  function sudahDicairkan() {
    $('#modalCairkan').modal('show');
  }
  function tolakVerifikasi() {
    $('#modalTolakVerifikasi').modal('show');
  }

  function tolakFile(id_perjalanan_dinas_file) {
    $('#formTolakFile').attr('action', '<?= base_url('perjalanan_dinas/action_verifikasi_file/' . $detail->id_perjalanan_dinas) ?>/' + id_perjalanan_dinas_file + '/ditolak');
    $('#modalTolakFile').modal('show');
  }
</script>
<script>
  $(document).ready(function() {

    $('#divTerhitung').hide();
    $('#divPeriode').hide();

    $('[name="id_pegawai[]"]').select2({
      minimumInputLength: 2,
      allowClear: true,
      placeholder: 'Pilih Pegawai',
      ajax: {
        dataType: 'json',
        url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
        data: function(term, page) {
          return {
            search: term, //search term
          };
        },
        results: function(data, page) {
          return {
            results: data
          };
        },
      }
    });
    <?php

    foreach ($pembiayaan as $k => $p) { ?>
      var ALL_OPTION<?= $k ?> = {
        id: '<?= $p->id_pegawai ?>',
        text: '<?= $p->nama_lengkap ?>'
      };

      $('#pegawai<?= $k ?>').select2('data', ALL_OPTION<?= $k ?>);
    <?php } ?>

  });
</script>


<script>
  $('#addPegawai').click(function() {
    $("#tablePegawai tbody tr:last").find('[name="id_pegawai[]"]').select2('destroy');
    var append = $("#tablePegawai tbody tr:last").clone();
    append.find('input:text').val('');
    append.find('input:radio').prop('checked', false)
    append.find('textarea').text('');
    append.find('textarea').val('');
    append.find('select').val('');
    append.find('select').trigger('change');
    $("#tablePegawai tbody").append(append);
    $('[name="id_pegawai[]"]').select2({
      minimumInputLength: 2,
      allowClear: true,
      placeholder: 'Pilih Pegawai',
      ajax: {
        dataType: 'json',
        url: '<?= base_url('perjalanan_dinas/get_pegawai') ?>',
        data: function(term, page) {
          return {
            search: term, //search term
          };
        },
        results: function(data, page) {
          return {
            results: data
          };
        },
      }
    });

  })
  $("#tablePegawai").on('click', '.deletePegawai', function() {
    var table = document.getElementById('tablePegawai');
    var rowCount = table.rows.length;
    // alert(rowCount);
    if (rowCount > 2) {
      $(this).parent().parent().remove();
    }
  });
</script>

<script>
  $('#addFile').click(function() {
    var append = $("#tableFile tbody tr:last").clone();
    append.find('input:text').val('');
    append.find('input:file').val('');
    append.find('input:radio').prop('checked', false)
    append.find('textarea').text('');
    append.find('textarea').val('');
    append.find('select').val('');
    append.find('select').trigger('change');
    $("#tableFile tbody").append(append);

  })
  $("#tableFile").on('click', '.deleteFile', function() {
    var table = document.getElementById('tableFile');
    var rowCount = table.rows.length;
    // alert(rowCount);
    if (rowCount > 2) {
      $(this).parent().parent().remove();
    }
  });
</script>