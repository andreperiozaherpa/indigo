<style>
  th,
  td {
    vertical-align: middle !important;
  }

  td {
    background-color: #fff !important;
  }
</style>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail RPJM Desa</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>RPJMDesa</li>
        <li>Perencanaan</li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id/data/logo/skpd/sumedang.png" alt="user" class="img-circle" /> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-primary">
                <div class="panel-heading"> Desa Cijati <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td style="width: 120px;">Nama Kepala </td>
                        <td>:</td>
                        <td> <strong>Data belum tersedia</strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Alamat SKPD </td>
                        <td>:</td>
                        <td> <strong>-</strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Email/tlp </td>
                        <td>:</td>
                        <td> <strong>email@emai.com / -</strong>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          SASARAN
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
          <div class="panel-body">
            <?php foreach ($sasaran as $k => $s) {
              $no = $k + 1;
            ?>
              <div style="padding:15px;border-radius:5px;background-color:#f6f6f6;margin-bottom:15px;">
                <span style="font-weight: 500;margin-bottom:20px" class="text-purple">Sasaran <?= $no ?>.</span> <?= $s->nama_sasaran ?>
                <div class="table-responsive dragscroll">
                  <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                    <thead>
                      <tr>
                        <th class="text-center">Kode</th>
                        <th style="width: 327px;" class="text-center">Indikator</th>
                        <th class="text-center">Satuan</th>
                        <?php
                        for ($t = 2020; $t <= 2026; $t++) {
                        ?>
                          <th class="text-center">Target <?= $t ?></th>
                        <?php
                        }
                        ?>
                        <th class="text-center">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $indikator = $s->indikator;
                      foreach ($indikator as $kk => $i) {
                        $nn = $kk+1;
                      ?>
                        <tr>
                          <td class="text-center"><?=$no?>.<?=$nn?></td>
                          <td><?=$i->nama_indikator?></td>
                          <td class="text-center"><?=$i->satuan?></td>
                          <?php
                          for ($t = 2020; $t <= 2026; $t++) {
                          ?>
                            <td class="text-center">
                              0
                              <?php 
                                if($i->satuan=='KK'){
                              ?>
                              <a target="blank" href="<?= base_url('rtangga_miskin/detail/') ?>" class="btn btn-xs btn-outline btn-primary btn-block">Isi KK</a>
                                <?php } ?>
                            </td>
                          <?php
                          }
                          ?>
                          <td class="text-center"><a href="javascript:void(0)" onclick="detailSasaran()" class="btn btn-primary" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="modalDetailSasaran" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Sasaran</h4>
      </div>
      <div style="background-color:#6003c8;padding:15px;color:#fff">
        <span style="display: block;font-weight:10px;font-weight:500">NAMA INDIKATOR</span>
        Jumlah Rumah Tangga Miskin (Desil 1 dan Desil 2)
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="row">
            <?php
            for ($t = 2020; $t <= 2025; $t++) {
            ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Target <?= $t ?></label>
                  <input type="text" class="form-control" placeholder="Masukkan Target Tahun <?= $t ?>">
                </div>
              </div>
            <?php
            }
            ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="ti-save"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
        </form>
      </div>
    </div>

  </div>
</div>


<script>
  function detailSasaran() {
    $('#modalDetailSasaran').modal('show');
  }
</script>