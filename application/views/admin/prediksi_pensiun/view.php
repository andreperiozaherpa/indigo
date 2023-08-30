<?php 
if(isset($u)){
      foreach($u as $k => $v){
        $$k = $v;
        $info[$k] = $v;
      }
    }
?>

<div class="container-fluid">
  
  <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?php echo title($title) ?></h4> </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
        <ol class="breadcrumb">
          <?php echo breadcrumb($this->uri->segment_array()); ?>
        </ol>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
        $tipe = (empty($error))? "info" : "danger";
        if (!empty($message)){
          ?>
          <div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <?= $message;?>
          </div>
        <?php }?>
              <div class="row">
          <div class="white-box">
            <div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
              <div class="overlay-box">
                <div class="col-md-3">
                  <div class="user-content">
                    <a href="javascript:void(0)"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/image11.gif" class="thumb-lg img-circle" style=" object-fit: cover;
                    width: 80px;
                    height: 80px;border-radius: 50%;
                    " alt="img"></a>
                    <h5 class="text-white"><b>Drs. ATANG SUTARNO.,M.Si</b></h5>
                    <h6 class="text-white">196709201992031007</h6>
                  </div>
                </div>
                <div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
                  <br>
                  <div class="user-content" style="padding-bottom:15px;">
                    <h5 class="text-white"><b>SKPD</b></h5>
                    <h6 class="text-white">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</h6>
                  </div>
                </div>
                <div class="col-md-3" style="border-right: 1px solid grey;">
                  <br>
                  <div class="user-content" style="padding-bottom:15px;">
                    <h5 class="text-white"><b>Unit Kerja</b></h5>
                    <h6 class="text-white">Sekretariat</h6>
                  </div>
                </div>
                <div class="col-md-3">
                  <br>
                  <div class="user-content" style="padding-bottom:15px;">
                    <h5 class="text-white"><b>Jabatan</b></h5>
                    <h6 class="text-white">Sekretaris Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</h6>
                  </div>
                </div>

              </div>
            </div>
        </div>
      </div>
        <div class="x_panel">
            <div class="x_content">
              <div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
                <button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <label id='status'></label>
              </div>
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">Foto Pegawai</div>
                  <div class="panel-body">
                    <div class="row">
                      <center>
                      <img class="img-circle img-responsive" src="<?=base_url('data/foto/pegawai/'.$detail->foto_pegawai.'')?>">
                    </center>
                    <div class="m-t-15">
                    <a href="<?=base_url('master_pegawai/edit/'.$detail->id_pegawai.'')?>" class="btn btn-primary btn-outline btn-block"><i class="ti-pencil"></i> Edit Pegawai</a>
              <?php 
                if($cek_user){
                  ?>

              <a href="javascript:void(0)" onclick="delAccount(<?=$detail->id_pegawai?>)" class="btn btn-danger btn-outline btn-block"><i class="ti-close"></i> Hapus Akun</a>
                  <?php
                }else{?>

              <a href="javascript:void(0)" onclick="regAccount()" class="btn btn-success btn-outline btn-block"><i class="ti-user"></i> Register Akun</a>
                  <?php

                }
              ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#hapusPegawai" class="btn btn-danger btn-outline btn-block"><i class="ti-trash"></i> Hapus Pegawai</a>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    Informasi Pegawai
                  </div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <p><?=$detail->nama_lengkap?></p>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>NIP / NRP</label>
                          <p><?=$detail->nip?></p>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>SKPD</label>
                          <p><?=$skpd->nama_skpd?></p>
                        </div>
                      </div>
                      <?php if ($detail->id_unit_kerja>0): ?>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Unit Kerja</label>
                          <p><?=$unit_kerja->nama_unit_kerja?></p>
                        </div>
                      </div>
                      <?php endif ?>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Jabatan</label>
                          <p><?=($detail->id_jabatan>0)?$jabatan->nama_jabatan:"Kepala SKPD"?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>   
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>