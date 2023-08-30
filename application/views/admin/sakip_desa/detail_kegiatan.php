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
        <a href="<?=base_url('sakip_desa/detail/'.$id_skpd)?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali ke Detail RKP</a>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r text-center">
              <strong style="color:#761137;">Capaian Sasaran</strong>
              <br>
              <br>
              <div id="grafik-kepala" data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
            </div>
            <div class="col-md-9">
              <div class="panel-wrapper collapse in" aria-expanded="true">
         
              <div class="panel panel-primary">
            <div class="panel-heading"> <?=$detail_skpd->nama_skpd?>
                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table">
                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></tr>
                        <tr><td style="width: 120px;">Alamat SKPD </td><td>:</td><td> <strong><?=$detail_skpd->alamat_skpd?></strong></tr>
                        <tr><td style="width: 120px;">Email/tlp </td><td>:</td><td> <strong><?=$detail_skpd->email_skpd?> / <?=$detail_skpd->telepon_skpd?></strong>
                    </table>
                  </div>
                </div>
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
                <p class="form-control-static"> <?=$detail_sub_bidang->nama_bidang?> </p>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12">Nama Sub Bidang</label>
              <div class="col-md-9">
                <p class="form-control-static"><?=$detail_sub_bidang->nama_sub_bidang?></p>
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
        </div>
        <div class="panel panel-body ">

          <div class="table-responsive">
            <table class="table color-table muted-table">
              <thead>
                <tr>
                  <th style="text-align: center">No.</th>
                  <th>Nama Kegiatan</th>
                  <th>Anggaran Kegiatan</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(empty($kegiatan)){
                  ?>
                  <tr>
                    <td colspan="4">
                      <center>Belum ada data</center>
                    </td>
                  </tr>
                  <?php
                }else{
                  foreach($kegiatan as $n => $k){
                    $no = $n+1;
                ?>
                <tr>
                  <td style="text-align: center"><?=$no?></td>
                  <td><?=$k->nama_kegiatan?></td>
                  <td><?=rupiah($k->anggaran)?></td>
                </tr>
                  <?php 
                } } ?>
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
        <h4 class="modal-title" id="titleKegiatan">Tambah Kegiatan</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="formKegiatan">

          <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukkan Nama Kegiatan">
          </div>
          <div class="form-group">
            <label>Anggaran Kegiatan</label>
            <input type="number" name="anggaran" class="form-control" placeholder="Masukkan Anggaran Kegiatan">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnAddKegiatan" onclick="addKegiatan()"><i class="ti-save"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
        </form>
      </div>
    </div>

  </div>
</div>


<div id="modalDeleteKegiatan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        Apakah Anda yakin akan menghapus Kegiatan ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnDeleteKegiatan" onclick="showDeleteKegiatan()"><i class="ti-check"></i> Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tidak</button>
      </div>
    </div>

  </div>
</div>


<script>
  function showAddKegiatan() {
    $('[name="nama_kegiatan"]').val('');
    $('[name="anggaran"]').val(0);
    $('#btnAddKegiatan').attr('onclick', 'addKegiatan()');
    $('#titleKegiatan').html('Tambah Kegiatan');
    $('#modalAddKegiatan').modal('show');
  }
  function addKegiatan() {
    $.post("<?= base_url('rkpdesa/addKegiatan/' . $detail_sub_bidang->id_sd_sub_bidang) ?>", $("#formKegiatan").serialize(), function(data) {
      if (data) {
        $('#modalAddKegiatan').modal('hide');
        swal("Berhasil", "Kegiatan Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }
  function showEditKegiatan(id_sd_kegiatan) {
    $.getJSON("<?= base_url('rkpdesa/getDetailKegiatan') ?>/" + id_sd_kegiatan, function(data) {
      $('[name="nama_kegiatan"]').val(data.nama_kegiatan);
      $('[name="anggaran"]').val(data.anggaran);
      $('#btnAddKegiatan').attr('onclick', 'updateKegiatan(' + id_sd_kegiatan + ')');
      $('#titleKegiatan').html('Edit Kegiatan');
      $('#modalAddKegiatan').modal('show');
    });
  }

  function updateKegiatan(id_sd_kegiatan) {
    $.post("<?= base_url('rkpdesa/updateKegiatan') ?>/" + id_sd_kegiatan, $("#formKegiatan").serialize(), function(data) {
      if (data) {
        $('#modalAddKegiatan').modal('hide');
        swal("Berhasil", "Kegiatan Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showDeleteKegiatan(id_sd_kegiatan) {
    $('#btnDeleteKegiatan').attr('onclick', 'deleteKegiatan(' + id_sd_kegiatan + ')');
    $('#modalDeleteKegiatan').modal('show');
  }

  function deleteKegiatan(id_sd_kegiatan) {
    $.post("<?= base_url('rkpdesa/deleteKegiatan') ?>/" + id_sd_kegiatan, function(data) {
      if (data) {
        $('#modalDeleteKegiatan').modal('hide');
        swal("Berhasil", "Kegiatan Berhasil Dihapus!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }
</script>