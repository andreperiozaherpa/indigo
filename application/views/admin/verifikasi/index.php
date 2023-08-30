<div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">Verifikasi</h4> 
     </div>
     <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
           <li class="active">Verifikasi</li>				
       </ol>
   </div>
   <!-- /.col-lg-12 -->
</div>
<?php 
    if($type=='no'){
?>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <form method="POST">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="form-group">
                                <label>Nomor Surat </label>
                                <input type="text" class="form-control" value="<?=set_value('no_surat')?>" placeholder="Cari berdasarkan Nomor Surat" name="no_surat" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="form-group" style="margin-left: 15px">
                                <br>
                                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-check-box"></i> Verifikasi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php
    if(isset($detail)){
        if(!$detail){
            ?>
            <div class="alert alert-danger">
                <i class="ti-alert"></i> Surat<?php if($type=='no'){?> dengan nomor <b><?=set_value('no_surat')?></b><?php } ?> tidak ditemukan.
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-primary">
                <i class="ti-check"></i> Surat<?php if($type=='no'){?> dengan nomor <b><?=set_value('no_surat')?></b><?php } ?> terdaftar pada sistem.
            </div>
            <div class="row">
                

    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_content">
            <div class="col-md-12 col-sm-6" >
              <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    INFORMASI SURAT
                </div>
                <div class="panel-body">
                  <div class="row b-b" style="max-height: 120px;">
                    <div class="text-center">
                      <h1 data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#6003c8;"></h1>
                      <b>No. Reg: <?=$detail->nomer_surat?></b>
                    </div>
                  </div>
                  <div class="row b-b">
                    <div class="col-md-12 text-center">
                      <h6>Pengirim</h6>
                      <h5> <?=$detail->nama_skpd?></h5>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_buat)?></span>
                    </div>
                  </div>
                  <div class="row b-b">
                    <div class="col-md-12 text-center">
                      <h6>Penerima</h6>
                      <?php 
                        foreach($penerima as $p){
                      ?>
                      <div style="margin-bottom:10px;border: solid 1px #cdcdcd;text-align: left !important;padding:4px">
                        <small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?=$p->nama_lengkap?></small>
                        <small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?=$p->nama_jabatan?></small>
                      </div>
                    <?php } ?>
                      <span class="badge" style="background-color: grey;font-size:10px;"><?=tanggal($detail->tgl_surat)?></span>
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
            <div class="panel-heading">

            </div>
            <div class="panel-body">
             <?=$detail->nama_surat?>
              <br>
              <br>
                <div class="col-md-6">
                  <table class="table b-b">
                    <tr><td style="width: 100px;">No Surat </td><td>:</td><td> <strong><?=$detail->nomer_surat?></strong></tr>
                </table>
                  </div>                    <!--/span-->
                  <div class="col-md-6">
                    <table class="table b-b">
                    <tr><td style="width: 100px;">Sifat</td><td>:</td><td> <strong><?=ucwords($detail->sifat_surat)?></strong></tr>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="panel panel-default">
          <div class="panel-body">
            <iframe src="https://docs.google.com/viewer?url=<?=base_url('data/surat_eksternal/keluar/'.$detail->file_draft_surat.'')?>
            &embedded=true" width="720"
            height="700"
            style="border: none;"></iframe>
          </div>
        </div>

      </div>
    </div>
            </div>
            <?php
        }
    }
?>
</div>