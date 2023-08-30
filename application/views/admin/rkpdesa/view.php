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
      <a href="<?= base_url('rkpdesa') ?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
    </div>
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
            <div style="padding:15px;border-radius:5px;background-color:#f6f6f6;margin-bottom:15px;">
              <span style="font-weight: 500;margin-bottom:20px" class="text-purple">Sasaran 1.</span> Menurunnya Jumlah Rumah Tangga Miskin
              <div class="table-responsive dragscroll">
                <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th class="text-center">Kode</th>
                      <th class="text-center">Indikator</th>
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
                    <tr>
                      <td class="text-center">1.1</td>
                      <td>Jumlah Rumah Tangga Miskin (Desil 1 dan Desil 2)</td>
                      <td class="text-center">KK</td>
                      <?php
                      for ($t = 2020; $t <= 2026; $t++) {
                      ?>
                        <td class="text-center">
                          0
                        <a href="<?=base_url('rtangga_miskin/detail/')?>" class="btn btn-xs btn-outline btn-primary btn-block">Isi KK</a>
                        </td>
                      <?php
                      }
                      ?>
                      <td class="text-center"><a href="javascript:void(0)" onclick="detailSasaran()" class="btn btn-primary" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div style="padding:15px;border-radius:5px;background-color:#f6f6f6;margin-bottom:15px;">
              <span style="font-weight: 500;margin-bottom:20px" class="text-purple">Sasaran 2.</span> Meningkatnya
              pencegahan Stunting
              Terintegrasi
              <div class="table-responsive dragscroll">
                <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th class="text-center">Kode</th>
                      <th class="text-center">Indikator</th>
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
                    <tr>
                      <td class="text-center">2.1</td>
                      <td>Meningkatnya
                        pencegahan Stunting
                        Terintegrasi</td>
                      <td class="text-center">%</td>
                      <?php
                      for ($t = 2020; $t <= 2026; $t++) {
                      ?>
                        <td class="text-center">0</td>
                      <?php
                      }
                      ?>
                      <td class="text-center"><a href="javascript:void(0)" onclick="detailSasaran()" class="btn btn-primary" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div style="padding:15px;border-radius:5px;background-color:#f6f6f6;margin-bottom:15px;">
              <span style="font-weight: 500;margin-bottom:20px" class="text-purple">Sasaran 2.</span> Meningkatnya
              kualitas pelayanan
              publik di Desa
              <div class="table-responsive dragscroll">
                <table class="table color-table muted-table table-bordered" style="margin-top:10px">
                  <thead>
                    <tr>
                      <th class="text-center">Kode</th>
                      <th class="text-center">Indikator</th>
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
                    <tr>
                      <td class="text-center">3.1</td>
                      <td>Meningkatnya
                        kualitas pelayanan
                        publik di Desa</td>
                      <td class="text-center">Point</td>
                      <?php
                      for ($t = 2020; $t <= 2026; $t++) {
                      ?>
                        <td class="text-center">0</td>
                      <?php
                      }
                      ?>
                      <td class="text-center"><a href="javascript:void(0)" onclick="detailSasaran()" class="btn btn-primary" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
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