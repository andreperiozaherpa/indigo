<style>
  th,
  td {
    vertical-align: middle !important;
  }

  td {
    background-color: #fff !important;
  }
</style>
<?php 

$j_kegiatan = 0;
$j_anggaran = 0;
foreach($kegiatan as $k){
  $j_kegiatan +=1;
  $j_anggaran += $k->anggaran;
}
?>
<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Kegiatan RKP Desa</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
        <li>RKPDesa</li>
        <li>2020</li>
        <li>Detail</li>
        <li class="active">Kegiatan</li>
      </ol>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
       <div class="col-md-12">
        <a href="<?=base_url('rkpdesa/detail_tahun')?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali ke Detail RKP</a>
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
                        <td style="width: 150px;">Nama Kepala Desa</td>
                        <td>:</td>
                        <td> -<strong></strong></td>
                      </tr>
                      <tr>
                        <td style="width: 150px;">Jumlah Pegawai</td>
                        <td>:</td>
                        <td> 243 Org<strong></strong></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          Detail Sub Bidang
        </div>
        <div class="panel panel-body">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-12">Nama Bidang</label>
              <div class="col-md-9">
                <p class="form-control-static"> Pelaksanaan Pembangunan Desa </p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Nama Sub Bidang</label>
              <div class="col-md-9">
                <p class="form-control-static">Sub Bidang 1</p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Total Kegiatan</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=$j_kegiatan?> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Total Anggaran</label>
              <div class="col-md-9">
                <p class="form-control-static"> <?=rupiah($j_anggaran)?> </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
          Kegiatan
          <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right " style="position:relative;bottom:6px;color: #6003C8 !important" onclick="showAddKegiatan()"><i class="ti-plus"></i> Tambah Kegiatan</a>
        </div>
        <div class="panel panel-body ">

          <div class="table-responsive">
            <table class="table color-table muted-table">
              <thead>
                <tr>
                  <th style="text-align: center">No.</th>
                  <th style="text-align: center">Nama Kegiatan</th>
                  <th style="text-align: center">Anggaran Kegiatan</th>
                  <th class=" " style="text-align: center">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($kegiatan as $n => $k){
                    $no = $n+1;
                ?>
                <tr>
                  <td style="text-align: center"><?=$no?></td>
                  <td style="text-align: center"><?=$k->nama_kegiatan?></td>
                  <td style="text-align: center"><?=rupiah($k->anggaran)?></td>
                  <td class=" " style="text-align: center">
                      <a href="javascript:void(0)" onclick="editKegiatan()" class="btn btn-circle btn-info" style="color:#fff"><i class="ti-pencil"></i></a>
                      <a href="javascript:void(0)" onclick="delKegiatan()" class="btn btn-circle btn-danger" style="color:#fff"><i class="ti-trash"></i></a> </td>
                </tr>
                  <?php 
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>


<div id="modalAddKegiatan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form method="POST">

          <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Kegiatan">
          </div>
          <div class="form-group">
            <label>Anggaran Kegiatan</label>
            <input type="text" class="form-control" placeholder="Masukkan Anggaran Kegiatan">
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
  function showAddKegiatan() {
    $('#modalAddKegiatan').modal('show');
  }
</script>