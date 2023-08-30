<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Verifikasi Kegiatan Personal</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
        <li class="active">Verifikasi Kegiatan Personal</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <div class="row">
   <div class="col-md-12">
    <div class="white-box">
     <div class="row">
      <form method="POST">
        <div class="col-md-3">
         <div class="form-group">
          <label for="">Nama Kegiatan</label>
          <input type="text" class="form-control" name="nama_kegiatan_filter" value="<?=isset($nama) ? $nama :''?>" placeholder="Enter text ...">
      </div>
    </div>
    <div class="col-md-3">
     <label for="">Tanggal Kegiatan</label>
     <input type="text" class="form-control" id="datepicker" name="tgl_filter" value="<?=isset($tgl) ? $tgl : ''?>" placeholder="MM-DD-YYYY">
  </div>
    <div class="col-md-3">
     <label for="">Status Kegiatan</label>
     <select class="form-control" name="status_kegiatan">
       <option value="">Belum diverifikasi</option>
       <option value="">Sudah diverifikasi</option>
     </select>
  </div>
  <div class="col-md-3">
   <div class="form-group text-center">
    <br>
    <button type="submit" class="btn btn-primary btn-outline m-t-5"><i class="ti-search"></i> Filter Pekerjaan</button>
  </div>
</div>
</form>
</div>

</div>
</div>

</div>
<div class="row">
    <br>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-success" style="cursor:default !important; width: 100%">Belum Diverifikasi</label>
            </div>
          </div>
        </div>
        <div class="col-md-4 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-warning" style="cursor:default !important; width: 100%">Revisi Pekerjaan</label>
            </div>
          </div>
        </div>
        <div class="col-md-4 b-r p-b-20">
          <div class="col-md-12">
            <div class="box-title text-center bg-white">
              <label class="btn btn-outline btn-primary" style="cursor:default !important; width: 100%">Selesai Diverifikasi</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <?php if ($daftar_kegiatan == false): ?>
      <div class="col-md-12">
        <div class="alert alert-info">
          <p class="text-center">Belum Ada Pekerjaan</p>
        </div>
      </div>
      <?php else: ?>
        <div class="col-md-4 b-r p-b-20">
          <?php if ($menunggu_verifikasi == false): ?>
            <div class="alert alert-success">
              <p class="text-center">Belum ada Kegiatan</p>
            </div>
          <?php elseif ($menunggu_verifikasi == true): ?>
          <?php foreach ($menunggu_verifikasi as $mv): ?>
            <div class="col-md-12">
              <div class="white-box">
              <span class="label label-success pull-right" style="font-size:8px"><?=$mv->status_kegiatan?></span>
                  <div class="row">
                    <img src="<?=base_url()?>/data/foto/pegawai/user-default.png" alt="user" class="img-circle" width="40px" style="border:3px solid white;margin-left:10px;-webkit-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                      -moz-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                      box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75)">
                    <span class="profile-status online"><small style="font-weight:bold"><?=$mv->nama_lengkap?></small> </span>
                  </div>
                <br>
                <p><?=$mv->nama_kegiatan?></p>
                <div class="col-md-5">
                  <i class="fa fa-calendar text-success"></i> <small><?=tanggal($mv->tgl_kegiatan_mulai)?></small>
                </div>
                <div class="col-md-5">
                  <!-- <i class="fa fa-calendar text-success"></i> -->
                </div>
                <div class="col-md-2">
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <a href="<?=base_url('verifikasi_kegiatan_personal/detail_verifikasi_kegiatan/'.$mv->id_pegawai_input.'/'.$mv->id_kegiatan_personal);?>" class="btn btn-outline btn-success btn-block">Detail</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="col-md-4 b-r p-b-20">
          <?php if ($revisi_kegiatan == false): ?>
            <div class="alert alert-warning">
              <p class="text-center">Belum ada Pekerjaan</p>
            </div>
          <?php elseif ($revisi_kegiatan == true): ?>
          <?php foreach ($revisi_kegiatan as $rk): ?>
            <div class="col-md-12">
              <div class="white-box">
              <span class="label label-warning label-rounded pull-right"><?=$rk->status_kegiatan?> <i class="icon-refresh"></i></span>
                <div class="row">
                  <img src="<?=base_url()?>data/foto/pegawai/user-default.png" alt="user" class="img-circle" width="40px" style="border:3px solid white;margin-left:10px;-webkit-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                    -moz-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                    box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75)">
                  <span class="profile-status online"><small style="font-weight: bold"><?=$rk->nama_lengkap?></small> </span>
                </div>
                <br>
                <p><?=$rk->nama_kegiatan?></p>

                <div class="col-md-5">
                  <i class="fa fa-calendar text-warning"></i> <small><?=$rk->tgl_kegiatan_mulai?></small>
                </div>
                <div class="col-md-5">
                  <i class="fa fa-calendar-check-o text-warning"></i> <small><?=$rk->tgl_selesai_kegiatan?></small>
                </div>
                <div class="col-md-2">
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <a href="<?=base_url('verifikasi_kegiatan_personal/detail_verifikasi_kegiatan/'.$rk->id_pegawai_input.'/'.$rk->id_kegiatan_personal);?>" class="btn btn-outline btn-warning btn-block">Detail</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="col-md-4 b-r p-b-20">
          <?php if ($selesai_diverifikasi == false): ?>
            <div class="alert alert-primary">
              <p class="text-center">Belum ada Pekerjaan</p>
            </div>
          <?php elseif ($selesai_diverifikasi == true): ?>
          <?php foreach ($selesai_diverifikasi as $sd): ?>
            <div class="col-md-12">
              <div class="white-box">
              <span class="label label-primary label-rounded pull-right"><?=$sd->status_kegiatan?></span>
                <div class="row">
                  <img src="<?=base_url()?>data/foto/pegawai/user-default.png" alt="user" class="img-circle" width="40px" style="border:3px solid white;margin-left:10px;-webkit-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                    -moz-box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75);
                    box-shadow: 0px 6px 9px -5px rgba(0,0,0,0.75)">
                  <span class="profile-status online"><small style="font-weight: bold"><?=$sd->nama_lengkap?></small> </span>
                </div>
                <br>
                <p><?=$sd->nama_kegiatan?></p>
                <div class="col-md-4">
                  <i class="fa fa-calendar text-primary"></i> <small><?=isset($sd->tgl_kegiatan_akhir) ? tanggal($sd->tgl_kegiatan_akhir) : '-'?></small>
                </div>
                <div class="col-md-4">
                  <i class="fa fa-calendar-check-o text-primary"></i> <small><?=isset($sd->tgl_selesai_kegiatan) ? tanggal($sd->tgl_selesai_kegiatan) : '-'?></small>
                </div>
                <div class="col-md-4">
                  <i class="fa fa-check-square-o text-primary"></i> <small><?=isset($sd->tgl_verifikasi) ? tanggal($sd->tgl_verifikasi) : '-'?></small>
                </div>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <a href="<?=base_url('verifikasi_kegiatan_personal/detail_verifikasi_kegiatan/'.$sd->id_pegawai_input.'/'.$sd->id_kegiatan_personal);?>" class="btn btn-outline btn-primary btn-block">Detail</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      
				<div class="row">
					<div class="col-md-12 pager">
						<?php
						if(!$filter){
							echo make_pagination($pages,$current);
						}
						?>
					</div>
				</div>

  </div>
