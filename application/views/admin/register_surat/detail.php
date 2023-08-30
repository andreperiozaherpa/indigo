<?php 
if ($detail->jenis_surat=="internal") {
  $jenis_surat = "surat_keluar_internal";
} elseif ($detail->jenis_surat=="eksternal") {
  $jenis_surat = "surat_keluar_eksternal";
}

if($detail->status_register == 'Sudah Diregistrasi'){
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-open";
  $icon2 = "icon-check";
  $detail->status_penomoran = 'Sudah Diregistrasi';

}elseif($detail->status_register == 'Belum Diregistrasi'){
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
  $detail->status_penomoran = 'Belum Diregistrasi';
}
?>
<div class="container-fluid">

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Registrasi <?=ucwords(humanize($jenis_surat));?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li class="active">Detail</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php 
          if(isset($message)){
            ?>
            <div class="alert alert-<?=$type?>"><?=$message?></div>
            <?php
          }
          ?>
        </div>
    </div>
    <div class="col-md-12">
        <a href="<?=base_url('penomoran_surat')?>" class="pull-right btn btn-primary btn-outline"><i
                class="ti-back-left"></i> Kembali</a><br><br>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <div class="col-md-12 col-sm-6">
                        <div class="panel panel-primary">
                            <div class="panel-body" style="border-top: solid 5px #6003C8">
                                <div class="row b-b">
                                    <div class="text-center">
                                        <p>
                                            <i style="font-size: 70px;" class="text-<?=$color1?> <?=$icon?>"></i>
                                        </p>
                                        <p>
                                            <span class="text-<?=$color1?>">
                                                <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;"
                                                    class="<?=$icon2?>"></i> <?=$detail->status_penomoran?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h6>Pengirim</h6>
                                        <h5> <?=$detail->nama_skpd?></h5>
                                        <span class="badge"
                                            style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_buat)?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h6>Penerima</h6>
                                        <?php 
                        foreach($penerima as $p){
                          ?>

                                        <div
                                            style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                                            <?php
                            if($p->jenis_surat=='internal'){
                              ?>

                                            <?php
                              ?>
                                            <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i>
                                                <?=$p->nama_lengkap?></small>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-bar-chart"></i> <?=$p->nama_jabatan?></small>
                                            <?php }elseif($p->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
                              ?>
                                            <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1"
                                                    class="linea-icon linea-aerrow fa-fw"></i>Kepala
                                                <?=$p->nama_skpd?></small>
                                            <?php
                            }else{
                              ?>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-flag-alt"></i> <?=$p->nama_penerima?></small>
                                            <small style="display: block"><i style="color: #5D03C1"
                                                    class="ti-location-pin"></i> <?=$p->alamat_penerima?></small>
                                            <?php
                            }
                            ?>

                                        </div>
                                        <?php
                        } ?>
                                        <center>
                                            <span class="badge"
                                                style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_surat)?></span>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body" style="border-top: solid 5px #6003C8">
                        <h3 style="color: #6003C8" class="box-title"><?=$detail->nama_surat?></h3>
                        <br>
                        <div class="col-md-6">
                            <table class="table b-b">
                                <tr>
                                    <td style="width: 100px;">No Surat </td>
                                    <td>:</td>
                                    <td> <strong><?=$detail->nomer_surat?></strong>
                                </tr>
                                <tr>
                                    <td style="width: 100px;">Perihal </td>
                                    <td>:</td>
                                    <td> <strong><?=$detail->perihal?></strong>
                                </tr>
                            </table>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <table class="table b-b">
                                <tr>
                                    <td style="width: 200px">Nomor Registrasi Sistem</td>
                                    <td>:</td>
                                    <td> <strong><?=ucwords($detail->hash_id)?></strong>
                                </tr>
                                <tr>
                                    <td>Sifat</td>
                                    <td>:</td>
                                    <td> <strong><?=ucwords($detail->sifat_surat)?></strong>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <iframe
                        src="https://docs.google.com/viewer?url=<?=base_url('data/surat_eksternal/ttd/'.$detail->file_ttd.'')?>&embedded=true"
                        width="720" height="700" style="border: none;"></iframe>
                </div>
            </div>
            <div class="white-box">
                <div class="row" style="margin-bottom: 15px">
                    <span style="float: left">
                        <?php 
                  if($detail->status_register=='Sudah Diregistrasi'){
                    $a_type = 'primary';
                    $icon = 'ti-check';
                    $a_message = '<i class="ti-check"></i> Surat sudah diregistrasi';
                  }else{
                    $a_type = 'danger';
                    $icon = 'ti-alert';
                    $detail->status_register = 'Belum Diregistrasi';
                    $a_message = '<i class="ti-alert"></i> Surat belum diregistrasi, silahkan klik tombol dibawah untuk melakukan proses registrasi surat.';
                  }
                  ?>
                        <h5 class="box-title"><i
                                style="color:#fff;background-color: #6003C8;padding: 5px;border-radius: 50%"
                                class="ti-check-box"></i> <span style="border-bottom: solid 2px #6003C8">Register
                                Surat</span></h5></span>
                    <span style="float: right;text-align: center;margin-top: -10px;">
                        <p style="display: block;margin:2px">Status Register</p>
                        <i style="position: absolute;z-index: 999;color:#fff;background-color: #6003C8;padding: 6px;border-radius: 50%;margin-top: -2px"
                            class="<?=$icon?>"></i> <span
                            style="position: relative;padding:6px;border :solid 1px #cdcdcd;color:#6003C8 "
                            class="label"><span
                                style="margin-left: 22px"><?=normal_string($detail->status_register)?></span></span>
                    </span>
                </div>
                <div class="alert alert-<?=$a_type?>">
                    <?=$a_message?>
                </div>
                <?php 
                if($detail->status_register=='Sudah Diregistrasi'){
                  ?>
                <div class="form-group">
                    <label>No. Surat</label>
                    <p><?=$detail->nomer_surat?></p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lokasi Box</label>
                            <p><?=$detail->lokasi_box?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lokasi Rak</label>
                            <p><?=$detail->lokasi_rak?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lokasi Sampul</label>
                            <p><?=$detail->lokasi_smpl?></p>
                        </div>
                    </div>
                </div>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-default"
                    type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Registrasi Ulang Surat</a>
                <?php
                }else{
                  ?>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-primary"
                    type="button"><span class="btn-label"><i class="ti-check-box"></i></span> Registrasi Surat</a>
                <?php } ?>
                <a href="<?=base_url('data/surat_eksternal/ttd/'.$detail->file_ttd.'')?>" class="btn btn-primary"
                    type="button"><span class="btn-label"><i class="ti-cloud-down"></i></span> Download Surat</a>
            </div>

        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registrasi Surat</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>No. Surat</label>
                            <input type="text" class="form-control" name="nomer_surat" placeholder="Masukkan No. Surat"
                                value="<?=$detail->nomer_surat?>">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Lokasi Box</label>
                                    <input type="text" class="form-control" name="lokasi_box"
                                        placeholder="Masukkan Lokasi Box" value="<?=$detail->lokasi_box?>"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Lokasi Rak</label>
                                    <input type="text" class="form-control" name="lokasi_rak"
                                        placeholder="Masukkan Lokasi Rak" value="<?=$detail->lokasi_rak?>"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Lokasi Sampul</label>
                                    <input type="text" class="form-control" name="lokasi_smpl"
                                        placeholder="Masukkan Lokasi Sampul" value="<?=$detail->lokasi_smpl?>"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal"><i
                            class="ti-close"></i> Tutup</button>
                    <button type="submit" class="btn btn-primary btn-rounded"><i class="ti-check-box"></i>
                        Registrasi</button>
                    </form>
                </div>
            </div>

        </div>
    </div>