<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Laporan per Bagian Perjalanan Dinas</h4>
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
            <div class="col-md-6">
              <div class="col-md-6">

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
              <div class="col-md-6">
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
                <a href="<?=base_url("perjalanan_dinas/rekap_bagian/$bulan/$tahun")?>" class="btn btn-primary m-t-5 pull-right"><i class="ti-download"></i> Download Rekap per Bagian</a>
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
        <h4 class="box-title text-center">DAFTAR PENGAJUAN PERJALANAN DINAS KE LUAR DAERAH PER BAGIAN BULAN <?=strtoupper(bulan($bulan))?> <?=$tahun?></h4>
        <div class="table-responsive">
          <?php 
            $total = array();
          ?>
          <table class="table color-table primary-table table-striped">
            <thead>
              <tr>
                <?php
                foreach ($bagian as $b) { 
                    $total[$b->id_unit_kerja] = 0;
                   ?>
                  <th style="text-align: center;font-size:13px"><?= $b->nama_alias ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < $total_row; $i++) {
              ?>
                <tr>
                  <?php
                  foreach ($bagian as $b) {
                    $nominal = number_format($jumlah_bagian[$b->id_unit_kerja][$i]['nominal'],0,",",".");
                    $total[$b->id_unit_kerja] += $jumlah_bagian[$b->id_unit_kerja][$i]['nominal'];
                    ?>
                    <td style="font-size: 13px;text-align:right"><?= !empty($nominal) ? '<a  href="javascript:void(0)" onclick="showBuktiSPJ('.$jumlah_bagian[$b->id_unit_kerja][$i]['id_perjalanan_dinas'].')">'.$nominal.'</a>': $nominal ?></td>
                  <?php } ?>
                </tr>
              <?php } ?>
              <tr>
                <?php
                foreach ($bagian as $b) { 
                   ?>
                  <td style="font-weight: bold;font-size: 13px;text-align:right"><?= number_format($total[$b->id_unit_kerja],0,",",".") ?></td>
                <?php } ?></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="modalBuktiSPJ" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Bukti SPJ</h4>
      </div>
      <div class="modal-body" id="spjBody">
            <center>Memuat bukti SPJ ...</center>
      </div>
      <div class="modal-footer">
        <button type="submit" name="action" value="bku" class="btn btn-primary waves-effect text-left"><i class="ti-download"></i> Download</button>
        <button type="button" class="btn btn-primary btn-outline waves-effect text-left" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script>

  function showBuktiSPJ(id_perjalanan_dinas){
    $('#modalBuktiSPJ').modal('show');
    $.get("<?= base_url('perjalanan_dinas/getBuktiSPJ') ?>/" + id_perjalanan_dinas, function(data) {
      $('#spjBody').html(data);
    });
  }
</script>