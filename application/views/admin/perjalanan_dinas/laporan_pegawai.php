<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan Perjalanan Dinas Pegawai</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Laporan Pegawai</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="GET">
            <div class="col-md-6">
              <div class="col-md-6">

                <div class="form-group">
                  <label class="control-label"> Bagian</label>
                  <select class="form-control select2" name="id_unit_kerja" id="id_unit_kerja">
                    <option value="">Semua Bagian</option>
                    <?php
                    foreach ($bagian as $b) {
                      $selected = $b->id_unit_kerja == $id_unit_kerja ? ' selected' : null;
                      echo '<option value="' . $b->id_unit_kerja . '"' . $selected . '>' . $b->nama_unit_kerja . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label"> Bulan</label>
                  <select class="form-control select2" name="bulan" id="bulan">
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                      $selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
                      $b = date("M", strtotime(date("Y") . "-" . $i . "-01"));
                      echo "<option $selected value='$i' >$b</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="control-label"> Tahun</label>
                  <select class="form-control select2" id="tahun" name="tahun">
                    <?php
                    for ($i = 2020; $i <= date("Y"); $i++) {
                      $selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

                      echo "<option $selected value='$i' >$i</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <br>
                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <a href="javascript:void(0)" onclick="selectPerdinBKU(<?= $id_unit_kerja ?>)" class="btn btn-primary m-t-5 float-right pull-right"><i class="ti-download"></i> Download Rekap Pencairan</a>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
  <!--row -->
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">

        <center>
          <h4 class="box-title">
            <span class="text-purple">LAPORAN PERJALANAN DINAS PEGAWAI</span><br>
            <?= isset($unit_kerja) ? $unit_kerja->nama_unit_kerja : "BAGIAN-BAGIAN" ?> SEKRETARIAT DAERAH<br>
            BULAN <?= bulan($bulan) ?> TAHUN <?= $tahun ?>
          </h4>
        </center>
        <table class="table color-table primary-table">
          <thead>
            <tr>
              <th style="text-align: center;">No.</th>
              <th style="text-align: center;">NIP</th>
              <th style="text-align: center;">Nama Pegawai</th>
              <th style="text-align: center;">Jabatan</th>
              <th style="text-align: center;">Jumlah Perjalanan Dinas</th>
              <th style="text-align: center;">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $no = 1;
            foreach ($pegawai as $p) {
              $list = $this->perjalanan_dinas_model->get_by_pegawai($p->id_pegawai,$bulan,$tahun);
              $t = 0;
            ?>
            <tr>
              <td class="text-center"><?=$no?></td>
              <td><?=$p->nip?></td>
              <td><?=$p->nama_lengkap?></td>
              <td><?=$p->jabatan?></td>
              <td class="text-center" style="font-weight: 500;"><?=count($list)?></td>
              <td><a href="<?=base_url('perjalanan_dinas/laporan_pegawai/'.$p->id_pegawai.'/'.$bulan.'/'.$tahun)?>" class="btn btn-primary"><i class="ti-download"></i> Download Rekap</a></td>
            </tr>
            <?php $no++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="modalRekap" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Pilih SPJ</h4>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="id_unit_kerja">
          <input type="hidden" name="bln" value="<?= $bulan ?>">
          <input type="hidden" name="thn" value="<?= $tahun ?>">
          <table class="table color-table primary-table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>No.</th>
                <th>Kegiatan</th>
                <th>Jenis Perjalanan</th>
                <th>Waktu</th>
                <th>Tujuan</th>
              </tr>
            </thead>
            <tbody id="tableRekap">
              <tr>

                <td colspan="6">
                  <center>Memuat Perjalanan Dinas ...</center>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="submit" name="action" value="rekap_pencairan" class="btn btn-primary waves-effect text-left"><i class="ti-download"></i> Download</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="modalRekapBKU" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Pilih SPJ</h4>
      </div>
      <div class="modal-body">
        <form method="POST">
          <input type="hidden" name="id_unit_kerja">
          <input type="hidden" name="bln" value="<?= $bulan ?>">
          <input type="hidden" name="thn" value="<?= $tahun ?>">
          <table class="table color-table primary-table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>No.</th>
                <th>Kegiatan</th>
                <th>Jenis Perjalanan</th>
                <th>Waktu</th>
                <th>Tujuan</th>
              </tr>
            </thead>
            <tbody id="tableRekapBKU">
              <tr>

                <td colspan="6">
                  <center>Memuat Perjalanan Dinas ...</center>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="submit" name="action" value="bku" class="btn btn-primary waves-effect text-left"><i class="ti-download"></i> Download</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>
  function selectPerdin(id_unit_kerja) {
    $('#modalRekap [name="id_unit_kerja"]').val(id_unit_kerja);
    $('#modalRekap').modal('show');
    $.get("<?= base_url('perjalanan_dinas/getPerjalananDinas') ?>/" + id_unit_kerja + "/<?= $bulan ?>/<?= $tahun ?>", function(data) {
      $('#tableRekap').html(data);
    });
  }

  function selectPerdinBKU(id_unit_kerja) {
    $('#modalRekapBKU [name="id_unit_kerja"]').val(id_unit_kerja);
    $('#modalRekapBKU').modal('show');
    $.get("<?= base_url('perjalanan_dinas/getPerjalananDinas') ?>/" + id_unit_kerja + "/<?= $bulan ?>/<?= $tahun ?>", function(data) {
      $('#tableRekapBKU').html(data);
    });
  }
</script>