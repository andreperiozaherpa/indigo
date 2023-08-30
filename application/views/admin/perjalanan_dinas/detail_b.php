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
            <div class="panel-heading">INFORMASI PERJALANAN DINAS<div class="pull-right">
            <a href="#" class="btn btn-primary btn-outline" style="color: #6003c8;margin-top:-7.5px;margin-left:5px"><i class="ti-download"></i> Download Laporan</a>
            <a href="#" class="btn btn-info" style="margin-top:-7.5px;margin-left:5px"><i class="ti-pencil"></i> Edit</a>
            <a href="#" class="btn btn-danger" style="margin-top:-7.5px;margin-left:5px"><i class="ti-trash"></i> Hapus</a>
             </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width: 180px;">Nama Kegiatan</td>
                        <td style="width: 20px;">:</td>
                        <td> <strong><?= $detail->nama_kegiatan ?></strong></td>
                      </tr>
                      <tr>
                        <td style="width: 180px;">Jenis Perjalanan </td>
                        <td>:</td>
                        <td> <strong><?= normal_string($detail->jenis_perjalanan) ?> </strong></td>
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
        <h3 class="box-title">PEMBIAYAAN</h3>
        <form method="POST">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Biaya Transport</label>
                <input type="text" name="biaya_transport" value="<?= $detail->biaya_transport ?>" class="form-control" placeholder="Masukkan Biaya Transport" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jenis Transportasi</label>
                <select name="jenis_transportasi" class="form-control select2" required>
                  <option value="">Pilih Jenis Transportasi</option>
                  <?php
                  $ljenisperjalanan = array('mobil', 'pesawat_terbang', 'bus', 'kereta', 'sepeda_motor', 'taksi', 'kapal_feri');
                  foreach ($ljenisperjalanan as $lj) {
                    $selected = $lj == $detail->jenis_transportasi ? ' selected' : null;
                    echo "<option value=\"$lj\"$selected>" . normal_string($lj) . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <table class="table table-bordered color-table primary-table" id="tablePegawai">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align: middle;text-align:center;width:30%">Nama Pegawai</th>
                <th colspan="2" style="vertical-align: middle;text-align:center">Uang Harian</th>
                <th colspan="2" style="vertical-align: middle;text-align:center">Biaya Penginapan</th>
                <th rowspan="2" style="vertical-align: middle;text-align:center;"></th>
              </tr>
              <tr>
                <th style="vertical-align: middle;text-align:center;">Volume</th>
                <th style="vertical-align: middle;text-align:center">Rp</th>
                <th style="vertical-align: middle;text-align:center">Volume</th>
                <th style="vertical-align: middle;text-align:center">Rp</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($pembiayaan as $k => $p) {
              ?>
                <tr>
                  <td>

                    <input type="text" id="pegawai<?= $k ?>" class="form-control" placeholder="Pilih Pegawai" name="id_pegawai[]" required>
                  </td>
                  <td>
                    <input type="text" class="form-control" value="<?= $p->volume_uh ?>" name="volume_uh[]" placeholder="Masukkan Volume">
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input type="text" class="form-control" value="<?= $p->nominal_uh ?>" name="nominal_uh[]" placeholder="Masukkan Nominal">
                    </div>
                  </td>
                  <td>
                    <input type="text" class="form-control" value="<?= $p->volume_bp ?>" name="volume_bp[]" placeholder="Masukkan Volume">
                  </td>
                  <td>
                    <div class="input-group">
                      <span class="input-group-addon">Rp.</span>
                      <input type="text" class="form-control" value="<?= $p->nominal_bp ?>" name="nominal_bp[]" placeholder="Masukkan Nominal">
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-circle deletePegawai"><i class="ti-trash"></i></button>
                  </td>
                </tr>
              <?php
              }
              ?>
              <tr>
                <td>

                  <input type="text" id="pegawai" class="form-control" placeholder="Pilih Pegawai" name="id_pegawai[]" required>
                </td>
                <td>
                  <input type="text" class="form-control" name="volume_uh[]" placeholder="Masukkan Volume">
                </td>
                <td>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" name="nominal_uh[]" placeholder="Masukkan Nominal">
                  </div>
                </td>
                <td>
                  <input type="text" class="form-control" name="volume_bp[]" placeholder="Masukkan Volume">
                </td>
                <td>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" name="nominal_bp[]" placeholder="Masukkan Nominal">
                  </div>
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-circle deletePegawai"><i class="ti-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-12">
              <button type="button" id="addPegawai" class="btn btn-primary pull-right"><i class="ti-plus"></i> Tambah Pegawai</button>
            </div>
          </div>
          <hr>

          <button type="submit" name="type" value="pembiayaan" class="btn btn-primary"><i class="ti-save"></i> Simpan Pembiayaan</button>
        </form>
      </div>
    </div>
    <div class="col-md-12">
      <div class="white-box">
        <h3 class="box-title">FILE PENDUKUNG</h3>
        <?=form_open_multipart()?>
          <table id="tableFile" class="table table-bordered color-table primary-table">
            <thead>
              <tr>
                <th style="vertical-align: middle;text-align:center">Nama File</th>
                <th style="vertical-align: middle;text-align:center">Upload</th>
                <th style="vertical-align: middle;text-align:center"></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach($file as $f){
                ?>
                
              <tr>
                <td>
                  <input type="text" class="form-control" name="nama_file[]" value="<?=$f->nama_file?>" placeholder="Masukkan Nama File" required>
                </td>
                <td>
                  <input type="file" class="form-control" name="path[]">
                <a href="<?=base_url('data/file_pendukung_perjalanan_dinas/'.$f->path)?>" class="btn btn-primary btn-xs" style="margin-top: 10px;"><?=$f->path?></a>
                </td>
                <td style="vertical-align: middle;text-align:center">
                  <button type="button" class="btn btn-danger btn-circle deleteFile"><i class="ti-trash"></i></button>
                </td>
              </tr>
                <?php
              }
            ?>
              <tr>
                <td>
                  <input type="text" class="form-control" name="nama_file[]" placeholder="Masukkan Nama File" required>
                </td>
                <td>
                  <input type="file" class="form-control" name="path[]" required>
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
      var ALL_OPTION<?=$k?> = {
        id: '<?= $p->id_pegawai ?>',
        text: '<?= $p->nama_lengkap ?>'
      };

			$('#pegawai<?=$k?>').select2('data', ALL_OPTION<?=$k?>);
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