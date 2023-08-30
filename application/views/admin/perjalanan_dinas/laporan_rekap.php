<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan Perjalanan Dinas</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Perjalanan Dinas</a></li>
        <li class="active">Laporan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="GET">
            <div class="col-md-8">
              <div class="col-md-4">
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
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label"> Jenis Perjalanan</label>
                  <select class="form-control select2" name="jenis_perjalanan" id="jenis_perjalanan">
                    <option value="">Semua Jenis Perjalanan</option>
                    <?php
                    $ljenisperjalanan = array('dalam_daerah', 'luar_daerah', 'luar_negeri');
                    foreach ($ljenisperjalanan as $lj) {
                      $selected = $jenis_perjalanan == $lj ? ' selected' : null;
                      echo "<option value=\"$lj\"$selected>" . normal_string($lj) . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
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
              <div class="col-md-2">
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
            <div class="col-md-4">
              <div class="form-group">
                <br>
                <button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <a href="javascript:void(0)" onclick="selectPerdin(<?= $id_unit_kerja ?>)" class="btn btn-primary m-t-5 float-right pull-right"><i class="ti-download"></i> Download Rekap Pencairan</a>
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
            <span class="text-purple">PENCAIRAN PERJALANAN DINAS</span><br>
            <?= !empty($jenis_perjalanan) ? normal_string($jenis_perjalanan) : null ?><br>
            <?= isset($unit_kerja) ? $unit_kerja->nama_unit_kerja : "BAGIAN-BAGIAN" ?> SEKRETARIAT DAERAH<br>
            BULAN <?= bulan($bulan) ?> TAHUN <?= $tahun ?>
          </h4>
        </center>
        <table class="table color-table primary-table">
          <thead>
            <tr>
              <th style="text-align: center;">No.</th>
              <th style="text-align: center;">Maksud</th>
              <th style="text-align: center;">Waktu</th>
              <th style="text-align: center;">Tujuan</th>
              <th style="text-align: center;">Nomor Rekening</th>
              <th style="text-align: center;">Jumlah Pencairan</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $no = 1;
            $t = 0;
            foreach ($list as $l) {
              $detail = $this->perjalanan_dinas_model->get_by_id($l->id_perjalanan_dinas);
              $pembiayaan = $this->perjalanan_dinas_model->get_pembiayaan($l->id_perjalanan_dinas);
              $jumlah_transport = 0;
              $jumlah_refresentasi = 0;
              $jumlah_uh = 0;
              $jumlah_total_uh = 0;
              $jumlah_bp = 0;
              $jumlah_total_bp = 0;
              $jumlah_total = 0;
              foreach ($pembiayaan as $k => $p) {
                $jumlah_uh += $p->nominal_uh;
                $jumlah_total_uh += ($p->nominal_uh * $p->volume_uh);
                $jumlah_bp += $p->nominal_bp;
                $jumlah_total_bp += ($p->nominal_bp * $p->volume_bp);
                if ($k == 0) {
                  $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh) + $detail->biaya_transport + $detail->uang_refresentasi;
                  $jumlah_transport += $detail->biaya_transport;
                  $jumlah_refresentasi += $detail->uang_refresentasi;
                } else {
                  $total = ($p->nominal_bp * $p->volume_bp) + ($p->nominal_uh * $p->volume_uh);
                }

                if ($k % 2 !== 0) {
                  $style_ttd = ' style="text-align:right"';
                } else {
                  $style_ttd = '';
                }
                $jumlah_total += $total;
              }
              $t += $jumlah_total;
            ?>
              <tr>
                <td style="text-align: center;"><?= $no ?></td>
                <td><?= $l->deskripsi_kegiatan ?></td>
                <td><?= tanggal($l->tanggal_awal) ?> <?= !empty($l->tanggal_akhir) ? "s.d " . tanggal($l->tanggal_akhir) : '' ?></td>
                <td style="text-align: center;"><?= $l->tujuan ?></td>
                <td style="text-align: center;"><?= $l->nomor_rekening ?></td>
                <td style="text-align: right;font-weight:500"><?= rupiah($jumlah_total) ?></td>
              </tr>
            <?php $no++;
            } ?>
            <tr>
              <td style="background-color:#f5f5f5;font-weight:500" colspan="5">
                <center>Jumlah Total Pencairan</center>
              </td>
              <td style="background-color:#f5f5f5;text-align: right;font-weight:500;font-size:20px"><?= rupiah($t) ?></td>
            </tr>
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
    $.get("<?= base_url('perjalanan_dinas/getPerjalananDinas') ?>/" + id_unit_kerja + "/<?= $bulan ?>/<?= $tahun ?>/<?=$jenis_perjalanan?>", function(data) {
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