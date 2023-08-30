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
              <strong style="color:#761137;">Capaian Desa</strong>
              <br>
              <br>
              <div id="grafik-kepala" data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
              <a href="<?= base_url('data/PK_Kades.docx') ?>" class="btn btn-primary m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
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

        <div class="row" style="position: relative;">
          <i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#761137;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
          <div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
            <span style="font-weight: 450;text-transform: uppercase;">Sasaran Desa</span>
          </div>
        </div>
        <?php foreach ($sasaran as $k => $s) {
          $no = $k + 1;
          $capaian_sasaran = $s->capaian_sasaran;
        ?>
          <div class="row" style="margin-top: 30px">
            <p><span class="label label-primary" id="total-capaian-ss-0" style="min-width:50px"><?= $capaian_sasaran ?>%</span>&nbsp;&nbsp;
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
                    <th style="vertical-align: middle;text-align: center">Capaian</th>
                    <th style="vertical-align: middle;text-align: center">Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $indikator = $s->indikator;
                  foreach ($indikator as $kk => $i) {
                    $nn = $kk + 1;
                    $target = $i->target;
                  ?>
                    <tr>
                      <td class="text-center"><?= $no ?>.<?= $nn ?></td>
                      <td><?= $i->nama_indikator ?></td>
                      <td class="text-center"><?= $i->satuan ?></td>
                      <td class="text-center"><?= $target->target ?></td>
                      <td class="text-center"><?= $target->realisasi ?></td>
                      <td class="text-center"><?= $target->capaian ?>%</td>
                      <td class="text-center">
                        <?php
                        if ($i->satuan == 'KK') {
                        ?>
                          <a href="<?= base_url('sakip_desa/detail_realisasi_kk/' . $target->id_sd_target_indikator) ?>" class="btn btn-sm btn-primary btn-outline m-b-5">Lihat Realisasi KK</a>
                        <?php
                        }  ?>
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
        </div>
        <div class="panel-body">
          <?php
          if (empty($bidang)) {
          ?>
            <div class="alert alert-warning">
              Belum ada Bidang
            </div>
            <?php
          } else {
            foreach ($bidang as $k => $b) {
              $no = $k + 1;
            ?>
              <div style="margin-top: 30px">
                <p>

                  <strong>Bidang <?= $no ?>.</strong> <?= $b->nama_bidang ?>
                </p>
                <div class="table-responsive dragscroll">
                  <table class="table color-table muted-table">
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;text-align: center">No</th>
                        <th style="vertical-align: middle;text-align: center;width:570px">Nama Sub Bidang</th>
                        <th style="vertical-align: middle;text-align: center">Jumlah Kegiatan</th>
                        <th style="vertical-align: middle;text-align: center">Total Anggaran</th>
                        <th style="vertical-align: middle;text-align: center">Kegiatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sub_bidang = $b->sub_bidang;
                      if (empty($sub_bidang)) {
                      ?>
                        <tr>
                          <td colspan="6">
                            <center>Belum ada data</center>
                          </td>
                        </tr>
                        <?php
                      } else {
                        foreach ($sub_bidang as $kk => $sb) {
                          $nn = $kk + 1;
                          $jml_kegiatan = 0;
                          $anggaran = 0;
                          $kegiatan = $sb->kegiatan;
                          foreach ($kegiatan as $k) {
                            $jml_kegiatan += 1;
                            $anggaran += $k->anggaran;
                          }
                        ?>
                          <tr>
                            <td class="text-center"><?= $no ?>.<?= $nn ?></td>
                            <td><?= $sb->nama_sub_bidang ?></td>
                            <td class="text-center"><?= $jml_kegiatan ?></td>
                            <td class="text-center"><?= rupiah($anggaran) ?></td>
                            <td class="text-center">
                              <a target="blank" href="<?= base_url('sakip_desa/detail_kegiatan/' . $id_skpd . '/' . $tahun . '/' . $sb->id_sd_sub_bidang) ?>" target="blank" class="btn btn-sm btn-primary btn-outline m-b-5">Detail Kegiatan</a>
                            </td>

                          </tr>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
          <?php }
          } ?>
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
        <h4 class="modal-title" id="titleBidang">Tambah Bidang</h4>
      </div>
      <div class="modal-body">
        <form method="POST" id="formBidang">

          <div class="form-group">
            <label>Nama Bidang</label>
            <input type="text" name="nama_bidang" class="form-control" placeholder="Masukkan Nama Bidang">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnAddBidang" class="btn btn-primary" onclick="addBidang()"><i class="ti-save"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>
        </form>
      </div>
    </div>

  </div>
</div>

<div id="modalDeleteBidang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        Apakah Anda yakin akan menghapus Bidang ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnDeleteBidang" onclick="showDeleteBidang()"><i class="ti-check"></i> Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tidak</button>
      </div>
    </div>

  </div>
</div>


<div id="modalDeleteSubBidang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus</h4>
      </div>
      <div class="modal-body">
        Apakah Anda yakin akan menghapus Sub Bidang ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnDeleteSubBidang" onclick="showDeleteSubBidang()"><i class="ti-check"></i> Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tidak</button>
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
        <h4 class="modal-title" id="titleSubBidang">Tambah Sub Bidang</h4>
      </div>
      <div style="background-color:#761137;padding:15px;color:#fff">
        <span style="display: block;font-weight:10px;font-weight:500">Nama Bidang</span>
        <span id="namaBidang">Pelaksanaan Pembangunan Desa</span>
      </div>
      <div class="modal-body">
        <form method="POST" id="formSubBidang">
          <div class="form-group">
            <label>Nama Sub Bidang</label>
            <input type="text" name="nama_sub_bidang" class="form-control" placeholder="Masukkan Sub Nama Bidang">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnAddSubBidang" onclick="addSubBidang()"><i class="ti-save"></i> Simpan</button>
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
      <div style="background-color:#761137;padding:15px;color:#fff">
        <span style="display: block;font-weight:10px;font-weight:500">Nama Indikator</span>
        <span id="namaIndikator"></span>
      </div>
      <div class="modal-body">
        <form method="POST" id="formRealisasi">
          <div class="form-group">
            <label>Target</label>
            <span id="targetIndikator" style="display: block;">100%</span>
          </div>
          <div class="form-group">
            <label>Realisasi</label>
            <input type="text" name="realisasi" class="form-control" placeholder="Masukkan Realisasi">
          </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSaveRealisasi"><i class="ti-save"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close"></i> Tutup</button>

      </div>
    </div>

  </div>
</div>

<script>
  function updateRealisasi(id_sd_target_indikator) {
    $('#btnSaveRealisasi').attr('onclick', 'saveRealisasi(' + id_sd_target_indikator + ')');
    $.getJSON("<?= base_url('rkpdesa/getDetailTarget') ?>/" + id_sd_target_indikator, function(data) {
      $('#namaIndikator').html(data.nama_indikator);
      $('#targetIndikator').html(data.target + " " + data.satuan);
      $('[name="realisasi"]').val(data.realisasi);
      $('#modalUpdateRealisasi').modal('show');
    });
  }

  function saveRealisasi(id_sd_target_indikator) {
    $.post("<?= base_url('rkpdesa/updateRealisasiTarget') ?>/" + id_sd_target_indikator, $("#formRealisasi").serialize(), function(data) {
      if (data) {
        $('#modalUpdateRealisasi').modal('hide');
        swal("Berhasil", "Realisasi Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showAddBidang() {
    $('[name="nama_bidang"]').val('');
    $('#btnAddBidang').attr('onclick', 'addBidang()');
    $('#titleBidang').html('Tambah Bidang');
    $('#modalAddBidang').modal('show');
  }

  function addBidang() {
    $.post("<?= base_url('rkpdesa/addBidang/' . $id_skpd . "/" . $tahun) ?>", $("#formBidang").serialize(), function(data) {
      if (data) {
        $('#modalAddBidang').modal('hide');
        swal("Berhasil", "Bidang Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showEditBidang(id_sd_bidang) {
    $.getJSON("<?= base_url('rkpdesa/getDetailBidang') ?>/" + id_sd_bidang, function(data) {
      $('[name="nama_bidang"]').val(data.nama_bidang);
      $('#btnAddBidang').attr('onclick', 'updateBidang(' + id_sd_bidang + ')');
      $('#titleBidang').html('Edit Bidang');
      $('#modalAddBidang').modal('show');
    });
  }

  function updateBidang(id_sd_bidang) {
    $.post("<?= base_url('rkpdesa/updateBidang') ?>/" + id_sd_bidang, $("#formBidang").serialize(), function(data) {
      if (data) {
        $('#modalAddBidang').modal('hide');
        swal("Berhasil", "Bidang Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showDeleteBidang(id_sd_bidang) {
    $('#btnDeleteBidang').attr('onclick', 'deleteBidang(' + id_sd_bidang + ')');
    $('#modalDeleteBidang').modal('show');
  }

  function deleteBidang(id_sd_bidang) {
    $.post("<?= base_url('rkpdesa/deleteBidang') ?>/" + id_sd_bidang, function(data) {
      if (data) {
        $('#modalDeleteBidang').modal('hide');
        swal("Berhasil", "Bidang Berhasil Dihapus!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showAddSubBidang(id_sd_bidang) {
    $('#titleSubBidang').html('Tambah Sub Bidang');
    $('#btnAddSubBidang').attr('onclick', 'addSubBidang(' + id_sd_bidang + ')');
    $.getJSON("<?= base_url('rkpdesa/getDetailBidang') ?>/" + id_sd_bidang, function(data) {
      $('#namaBidang').html(data.nama_bidang);
      $('#modalAddSubBidang').modal('show');
    });
  }


  function addSubBidang(id_sd_bidang) {
    $.post("<?= base_url('rkpdesa/addSubBidang/') ?>/" + id_sd_bidang, $("#formSubBidang").serialize(), function(data) {
      if (data) {
        $('#modalAddSubBidang').modal('hide');
        swal("Berhasil", "Sub Bidang Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }



  function showEditSubBidang(id_sd_bidang, id_sd_sub_bidang) {
    $('#titleSubBidang').html('Edit Sub Bidang');
    $('#btnAddSubBidang').attr('onclick', 'updateSubBidang(' + id_sd_bidang + ')');
    $.getJSON("<?= base_url('rkpdesa/getDetailBidang') ?>/" + id_sd_bidang, function(data) {
      $('#namaBidang').html(data.nama_bidang);
      $.getJSON("<?= base_url('rkpdesa/getDetailSubBidang') ?>/" + id_sd_sub_bidang, function(data) {
      $('[name="nama_sub_bidang"]').val(data.nama_sub_bidang);
        $('#modalAddSubBidang').modal('show');
      });
    });
  }

  function updateSubBidang(id_sd_bidang) {
    $.post("<?= base_url('rkpdesa/updateSubBidang/') ?>/" + id_sd_bidang, $("#formSubBidang").serialize(), function(data) {
      if (data) {
        $('#modalAddSubBidang').modal('hide');
        swal("Berhasil", "Sub Bidang Berhasil Disimpan!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }

  function showDeleteSubBidang(id_sd_sub_bidang) {
    $('#btnDeleteSubBidang').attr('onclick', 'deleteSubBidang(' + id_sd_sub_bidang + ')');
    $('#modalDeleteSubBidang').modal('show');
  }

  function deleteSubBidang(id_sd_sub_bidang) {
    $.post("<?= base_url('rkpdesa/deleteSubBidang') ?>/" + id_sd_sub_bidang, function(data) {
      if (data) {
        $('#modalDeleteSubBidang').modal('hide');
        swal("Berhasil", "Sub Bidang Berhasil Dihapus!", "success");
        location.reload(false);
      } else {
        alert('Terjadi kesalahan');
      }
    });
  }
</script>