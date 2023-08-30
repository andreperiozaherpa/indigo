<?php
if($detail->status_tembusan=='Sudah Dibaca'){
  $color1 = "success";
  $color2 = "#00c292";
  $icon = "icon-envelope-letter";
  $icon2 = "icon-check";

}elseif($detail->status_tembusan=="Belum Dibaca"){
  $color1 = "danger";
  $color2 = "#F75B36";
  $icon = "icon-envelope-open";
  $icon2 = "icon-close";

}else{
  $color1 = "warning";
  $color2 = "#f8c255";
  $icon = "icon-clock";
  $icon2 = "icon-info";
}
?>


<div class="container-fluid">

  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Surat Tembusan <?=ucfirst($detail->jenis_surat_keluar)?></h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <?=breadcrumb($this->uri->segment_array()) ?>   
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
      <a href="<?=base_url('surat_tembusan/index/'.$detail->jenis_surat_keluar)?>" class="pull-right btn btn-primary btn-outline"><i class="ti-back-left"></i> Kembali</a>
      <br><br>
    </div>
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="col-md-12 col-sm-6" >
              <div class="panel panel-primary">
                <div class="panel-body" style="border-top: solid 5px #6003C8">
                  <div class="row b-b">
                    <div class="text-center">

                      <p>
                        <i style="font-size: 70px;" class="text-<?=$color1?> <?=$icon?>"></i>
                      </p>
                      <p>
                        <span class="text-<?=$color1?>">
                          <i style="background-color: <?=$color2?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?=$icon2?>"></i> <?=$detail->status_tembusan?>
                        </span>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Pengirim</h6>
                      <h5> <?=$detail->nama_skpd?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_buat)?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h6 style="font-weight: 500">Penerima</h6>
                      
                      <?php 
                      foreach($penerima as $p){
                        ?>
                        <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                          <?php
                          if($p->jenis_surat=='internal'){
                            ?>
                            <?php
                            ?>
                            <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?=$p->nama_lengkap?></small>
                            <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?=$p->nama_jabatan?></small>
                          <?php }elseif($p->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
                            ?>
                            <small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1" class="linea-icon linea-aerrow fa-fw"></i>Kepala <?=$p->nama_skpd?></small>
                            <?php
                          }else{
                            ?>
                            <small style="display: block"><i style="color: #5D03C1" class="ti-flag-alt"></i> <?=$p->nama_penerima?></small>
                            <small style="display: block"><i style="color: #5D03C1" class="ti-location-pin"></i> <?=$p->alamat_penerima?></small>
                            <?php
                          }
                          ?>

                        </div>
                        <?php
                      } ?>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_surat)?></span>
                    </div>
                  </div>
                  <hr/>
                  <?php 
                  if($detail->status_ttd=="sudah_ditandatangani"){
                    ?>

                    <a href="<?=base_url('data/surat_eksternal/ttd/'.$detail->file_ttd.'')?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
                    <?php
                  }else{
                    ?>
                    <a href="<?=base_url('data/surat_eksternal/keluar/'.$detail->file_draft_surat.'')?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
                  <?php } ?>
                  <?php 
                  if($detail->status_verifikasi!=='sudah_diverifikasi'){
                    ?>
                    <a href="javascript:void(0)" onclick="deleteSurat(<?=$detail->id_surat_keluar?>)" class="btn btn-danger btn-block btn-outline"><i class="fa fa-trash"></i> Hapus Surat</a>
                    <a href="<?=base_url('surat_eksternal/edit_surat_keluar/'.$detail->id_ref_surat.'/'.$detail->id_surat_keluar)?>" class="btn btn-info btn-block btn-outline"><i class="ti-pencil"></i> Edit Surat</a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="row">
        <div class="panel panel-primary">
          <div class="panel-body" style="border-top: solid 5px #6003C8">
           <h3 style="color: #6003C8" class="box-title"><?=$detail->nama_surat?></h3>
           <br>
           <div class="col-md-6">
            <table class="table b-b">
              <tr><td style="width: 100px;">No Surat </td><td>:</td><td> <strong><?=$detail->nomer_surat?></strong></tr>
                <tr><td style="width: 100px;">Perihal </td><td>:</td><td> <strong><?=$detail->perihal?></strong></tr>
                </table>
              </div>                    <!--/span-->
              <div class="col-md-6">
                <table class="table b-b">
                  <tr><td style="width: 200px">Nomor Registrasi Sistem</td><td>:</td><td> <strong><?=ucwords($detail->hash_id)?></strong></tr>
                    <tr><td>Sifat</td><td>:</td><td> <strong><?=ucwords($detail->sifat_surat)?></strong></tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="panel panel-default">
                <div class="panel-body">
                      <?php 
                            $viewer = "https://docs.google.com/viewer?url=".base_url('data/surat_eksternal/ttd/'.$detail->file_ttd.'');
                         
                    ?>
                  <iframe src="<?=$viewer?>
                  &embedded=true" width="100%"
                  height="700"
                  style="border: none;"></iframe>
                </div>
              </div>
            </div>
            </div>