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
      <h4 class="page-title">Detail RKP Desa Tahun 2020</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>RKPDesa</li>
        <li>2020</li>
        <li class="active">Detail</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="col-md-12">
      <a href="<?= base_url('rkpdesa/detail/'.$id_skpd) ?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali ke Daftar Tahun</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r text-center">
              <strong style="color:#3F0090;">Capaian Sasaran</strong>
              <br>
              <br>
              <div id="grafik-kepala" data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
              <a href="<?=base_url('data/PK_Kades.docx')?>" class="btn btn-primary m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
            </div>
            <div class="col-md-9">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel panel-primary">
                  <div class="panel panel-heading">
                    DESA CIJATI
                  </div>
                  <div class="panel-body">
                    <table class="table">
                      <tr>
                        <td style="width: 120px;">Nama Kepala Desa</td>
                        <td>:</td>
                        <td> -<strong></strong>
                      </tr>
                      <tr>
                        <td style="width: 120px;">Jumlah Pegawai</td>
                        <td>:</td>
                        <td> 243 Org<strong></strong>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="row" style="position: relative;">
          <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
          <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
            <span style="font-weight: 450;text-transform: uppercase;">Sasaran Desa</span>
          </div>
        </div>
        <?php foreach ($sasaran as $k => $s) {
          $no = $k + 1;
        ?>
          <div class="row" style="margin-top: 30px">
            <p><span class="label label-primary" id="total-capaian-ss-0" style="min-width:50px">0%</span>&nbsp;&nbsp;
              <span style="font-weight: 500;margin-bottom:20px" class="text-purple">Sasaran <?= $no ?>.</span> <?= $s->nama_sasaran ?></p>
            <div class="table-responsive dragscroll">
              <table class="table color-table muted-table">
                <thead>
                  <tr>
                    <th style="vertical-align: middle;text-align: center">Kode</th>
                    <th style="vertical-align: middle;text-align: center;width:700px">Indikator</th>
                    <th style="vertical-align: middle;text-align: center">Satuan</th>
                    <th style="vertical-align: middle;text-align: center">Target</th>
                    <th style="vertical-align: middle;text-align: center">Realisasi</th>
                    <th style="vertical-align: middle;text-align: center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $indikator = $s->indikator;
                  foreach ($indikator as $kk => $i) {
                    $nn = $kk + 1;
                  ?>
                    <tr>
                      <td class="text-center"><?= $no ?>.<?= $nn ?></td>
                      <td><?= $i->nama_indikator ?></td>
                      <td class="text-center"><?= $i->satuan ?></td>
                      <td class="text-center">100</td>
                      <td class="text-center">0</td>
                      <td class="text-center">
                      <?php 
                        if($i->satuan=='KK'){
                          ?>
                          <a target="blank" href="<?= base_url('rtangga_miskin/detail/') ?>" class="btn btn-sm btn-primary btn-outline m-b-5">Update Realisasi KK</a>
                          <?php
                        }else{
                      ?><a href="javascript:void(0)" class="btn btn-sm btn-primary btn-outline m-b-5" onclick="updateRealisasi()">Update Realisasi</a>
                        <?php } ?>
                    </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          Bidang
          <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right " style="position:relative;bottom:6px;color: #6003C8 !important" onclick="showAddBidang()"><i class="ti-plus"></i> Tambah Bidang</a>
        </div>
        <div class="panel-body">
          <?php 
            foreach($bidang as $k => $b){
              $no = $k+1;
          ?>
          <div style="margin-top: 30px">
            <p><strong>Bidang <?=$no?>.</strong> <?=$b->nama_bidang?>
              <a href="javascript:void(0)" onclick="showAddSubBidang()" class="btn btn-primary btn-xs btn-rounded" style="color:#fff">Tambah Sub Bidang</a></p>
            <div class="table-responsive dragscroll">
              <table class="table color-table muted-table">
                <thead>
                  <tr>
                    <th style="vertical-align: middle;text-align: center">No</th>
                    <th style="vertical-align: middle;text-align: center;width:570px">Nama Sub Bidang</th>
                    <th style="vertical-align: middle;text-align: center">Jumlah Kegiatan</th>
                    <th style="vertical-align: middle;text-align: center">Total Anggaran</th>
                    <th style="vertical-align: middle;text-align: center">Kegiatan</th>
                    <th style="vertical-align: middle;text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sub_bidang = $b->sub_bidang;
                    foreach($sub_bidang as $kk => $sb){
                      $nn = $kk+1;
                      $kegiatan = 0;
                      $anggaran = 0;
                      foreach($sb->kegiatan as $k){
                        $kegiatan +=1;
                        $anggaran += $k->anggaran;
                      }
                  ?>
                  <tr id="iku_42">
                    <td class="text-center"><?=$no?>.<?=$nn?></td>
                    <td><?=$sb->nama_sub_bidang?></td>
                    <td class="text-center"><?=$kegiatan?></td>
                    <td class="text-center"><?=rupiah($anggaran)?></td>
                    <td class="text-center">
                      <a href="<?= base_url('rkpdesa/detail_kegiatan') ?>" target="blank" class="btn btn-sm btn-primary btn-outline m-b-5">Update Kegiatan</a>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" onclick="editSubBidang()" class="btn btn-circle btn-info" style="color:#fff"><i class="ti-pencil"></i></a>
                      <a href="javascript:void(0)" onclick="delSubBidang()" class="btn btn-circle btn-danger" style="color:#fff"><i class="ti-trash"></i></a>
                    </td>

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


<div id="modalAddBidang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Bidang</h4>
      </div>
      <div class="modal-body">
        <form method="POST">

          <div class="form-group">
            <label>Nama Bidang</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Bidang">
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

<div id="modalAddSubBidang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Sub Bidang</h4>
      </div>
      <div style="background-color:#6003c8;padding:15px;color:#fff">
        <span style="display: block;font-weight:10px;font-weight:500">NAMA BIDANG</span>
        Pelaksanaan Pembangunan Desa
      </div>
      <div class="modal-body">
        <form method="POST">

          <div class="form-group">
            <label>Nama Sub Bidang</label>
            <input type="text" class="form-control" placeholder="Masukkan Sub Nama Bidang">
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

<div id="modalUpdateRealisasi" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Realisasi</h4>
      </div>
      <div style="background-color:#6003c8;padding:15px;color:#fff">
        <span style="display: block;font-weight:10px;font-weight:500">NAMA Indikator</span>Cakupan layanan
        konvergensi
        stunting
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label>Target</label>
            <span style="display: block;">100%</span>
          </div>
          <div class="form-group">
            <label>Realisasi</label>
            <input type="text" class="form-control" placeholder="Masukkan Realisasi">
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
  function showAddSubBidang() {
    $('#modalAddSubBidang').modal('show');
  }

  function showAddBidang() {
    $('#modalAddBidang').modal('show');
  }

  function updateRealisasi() {
    $('#modalUpdateRealisasi').modal('show');
  }
</script>