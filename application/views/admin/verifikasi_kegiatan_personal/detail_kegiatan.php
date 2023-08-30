<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Detail Kegiatan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Monitoring Kegiatan</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
    <div class="col-md-8">
        <div class="white-box">
          <div class="row">
            <div class="col-md-2 b-r">
              <h1><strong class="text-dark"><?=tgl_hungkul($kegiatan->tgl_selesai_kegiatan);?></strong></h1>
              <h1 style="margin-top:-30px;"><small class="muted"><?=bln_hungkul($kegiatan->tgl_selesai_kegiatan);?> <sup style="font-size:10px;font-weight: bold;"><?=thn_hungkul($kegiatan->tgl_selesai_kegiatan);?></sup> </small> </h1>
            </div>
            <div class="col-md-7">
              <h3><small><strong><?=$kegiatan->nama_kegiatan?></strong> </small></h3>
            </div>
            <?php
            $warna = 'primary';
            if ($kegiatan->status_kegiatan == 'REVISI KEGIATAN') {
              $warna = 'warning';
            }elseif ($kegiatan->status_kegiatan == 'MENUNGGU VERIFIKASI') {
              $warna = 'success';
            } ?>
            <div class="col-md-3">
              <span class="label label-<?=$warna?>"><?=$kegiatan->status_kegiatan?></span>
            </div>
          </div>
        </div>
        <div class="white-box">
          <div class="row">
            <h3><strong>Deskirpsi Kegiatan</strong> </h3>
            <?=$kegiatan->deskripsi?>
          </div>
      </div>
        <div class="white-box">
          <div class="row">
            <h3><strong>Hasil Kegiatan</strong> </h3>
            <?=$kegiatan->deskripsi_hasil?>
          </div>
      </div>
      <div class="row">
       <a href="<?=base_url('data/kegiatan_personal/'.$kegiatan->id_pegawai.'/'.$kegiatan->lampiran);?>"><span class="label label-warning label-rounded"><i class="fa fa-file"> </i> Download Lampiran</span></a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="white-box" >
          <div class="row text-center">
          <b>Log	Aktivitas Pekerjaan</b>
          </div>
          <br>
          <div class="steamline">
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip//asset/pixel/plugins/images/users/genu.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b>Desi Rahmati</b><span class="sl-date pull-right">22 April 2019</span></div>
                      <p>Pekerjaan dibuat</p>
                  </div>
              </div>
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip/asset/pixel/plugins/images/users/genu.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b>Desi Rahmati</b><span class="sl-date pull-right">22 April 2019</span></div>
                      <p>Pekerjaan Diselesaikan</p>
                  </div>
              </div>
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip/asset/pixel/plugins/images/users/varun.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b>Nandang Koswara</b><span class="sl-date pull-right">22 April 2019</span></div>
                      <p>Pekerjaan Dievaluasi dan diberi catatan</p>
                  </div>
              </div>
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip/asset/pixel/plugins/images/users/genu.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b>Desi Rahmati</b><span class="sl-date pull-right">22 April 2019</span></div>
                      <p>Pekerjaan direvisi dan diverifikasi ulang</p>
                  </div>
              </div>
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="http://202.93.229.205:80/sakip/asset/pixel/plugins/images/users/varun.jpg" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b>Nandang Koswara</b><span class="sl-date pull-right">22 April 2019</span></div>
                      <p>Pekerjaan Diverifikasi</p>
                  </div>
              </div>
              <hr>
          </div>
      </div>
    </div>
    </div>
  </div>
