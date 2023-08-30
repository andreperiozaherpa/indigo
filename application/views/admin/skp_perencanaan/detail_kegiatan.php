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
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <a style="margin-bottom: 10px" href="<?=base_url('kegiatan_personal')?>" class="btn btn-primary btn-outline pull-right"><i class="icon-arrow-left-circle"></i> Kembali</a><br><br>
    </div>
    <div class="col-md-8">
        <div class="white-box">
          <div class="row">
            <div class="col-md-2 b-r">
              <h1><strong style="color: #6003c8"><?=tgl_hungkul($kegiatan->tgl_selesai_kegiatan);?></strong></h1>
              <h1 style="margin-top:-30px;"><small class="muted"><?=bln_hungkul($kegiatan->tgl_selesai_kegiatan);?> <sup style="font-size:10px;font-weight: bold;"><?=thn_hungkul($kegiatan->tgl_selesai_kegiatan);?></sup> </small> </h1>
            </div>
            <div class="col-md-7">
              <h3><small><strong><?=$kegiatan->nama_kegiatan?></strong> </small></h3>
            </div>
            <div class="col-md-3">
              <span class="label label-<?=$kegiatan->status_kegiatan=="MENUNGGU VERIFIKASI" ? 'warning' : 'success'?>"><?=$kegiatan->status_kegiatan?></span>
            </div>
          </div>
        </div>
        <div class="white-box">
          <div class="row">
            <h3><strong>Deskripsi Pekerjaan</strong> </h3>
            <?=$kegiatan->deskripsi?>
          </div>
      </div>
        <div class="white-box">
          <div class="row">
            <h3><strong>Uraian Aktifitas Kerja Harian</strong> </h3>
            <?=$kegiatan->uraian_aktifitas?>
          </div>
      </div>
        <div class="white-box">
          <div class="row">
            <h3><strong>Hasil Pekerjaan / Output</strong> </h3>
            <?=$kegiatan->deskripsi_hasil?>
          </div>
      </div>
      <div class="white-box">
        <div class="row">
          <h3><strong>Verifikator</strong> </h3>
          <?=$kegiatan->nama_lengkap?>
        </div>
    </div>
      <div class="row">
        <div class="col-md-12">
       <a href="<?=base_url('data/kegiatan_personal/'.$kegiatan->id_pegawai_input.'/'.$kegiatan->lampiran);?>"><span class="btn btn-primary"><i class="ti-clip"> </i> Download Lampiran</span></a>
       </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="white-box" >
          <div class="row text-center">
          <b>Log	Aktivitas Pekerjaan</b>
          </div>
          <br>
          <div class="steamline">
            <?php foreach ($logs as $log): ?>
              <div class="sl-item">
                  <div class="sl-left"> <img class="img-circle" alt="user" src="<?=base_url('data/foto/pegawai/'.$log->foto_pegawai);?>" style="-webkit-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);
box-shadow: 0px 0px 10px -2px rgba(0,0,0,0.75);border:2px solid white;"> </div>
                  <div class="sl-right">
                      <div><b><?=$log->full_name;?></b></div>
                      <p><?=$log->status;?></p>
                      <span class="sl-date"><?=poee(date('N', strtotime($log->date)));?>, <?=tanggal($log->date);?></span>
                      <span class="sl-date"><?=date('H:i', strtotime($log->time));?> WIB</span>
                  </div>
              </div>
            <?php endforeach; ?>
              <hr>
          </div>
      </div>
    </div>
    </div>
  </div>
