<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Monitoring Kegiatan</h4>
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
    <div class="white-box">
     <div class="row">
      <form method="POST">
        <div class="col-md-5">
         <div class="form-group">
          <label for="">Unit Kerja</label>
          <select name="id_unit_kerja" class="form-control select2">
           <option value="">Pilih Unit Kerja</option>
           <?php
           foreach($unit_kerja as $u){
            if($u->id_unit_kerja==set_value('id_unit_kerja')){
              $selected = ' selected';
            }else{
              $selected = '';
            }
            echo'<option value="'.$u->id_unit_kerja.'"'.$selected.'>'.$u->nama_unit_kerja.'</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="col-md-4">
     <label for="">Tanggal Kegiatan</label>
     <div class="input-daterange input-group">
      <input type="text" id="datepicker" class="form-control" value="<?=set_value('tgl_awal')?>" name="tgl_awal" placeholder="Tanggal Awal"/>
      <span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
      <input type="text" id="datepicker" class="form-control" value="<?=set_value('tgl_akhir')?>" name="tgl_akhir" placeholder="Tanggal Akhir" />
    </div>
  </div>
  <div class="col-md-3">
   <div class="form-group text-center">
    <br>
    <button type="submit" class="btn btn-primary btn-outline m-t-5"><i class="ti-search"></i> Cari Kegiatan</button>
  </div>
</div>
</form>
</div>

</div>
</div>

</div>
<div class="row">
  <br>
  <?php
  if(!empty($message)){
   ?>
   <div class="col-md-12">
    <div class="alert alert-primary">
      <i class="ti-alert"></i> <?=$message?>
    </div>
  </div>
  <?php
}else{
  if(isset($result)){
    $unit_kerja = $this->ref_unit_kerja_model->get_by_id(set_value('id_unit_kerja'));
    if(empty($result)){
      ?>
      <div class="col-md-12">
        <div class="alert alert-primary">
          <i class="ti-alert"></i> Kegiatan Unit Kerja <b><?=$unit_kerja->nama_unit_kerja?></b> <?php if(!empty(set_value('tgl_awal'))){ ?> dari Tanggal <b><?=tanggal(set_value('tgl_awal'))?></b> <?php } if( !empty(set_value('tgl_akhir'))){?> sampai Tanggal <b><?=tanggal(set_value('tgl_akhir'))?></b> <?php } ?> Tidak Ditemukan.
        </div>
      </div>
      <?php
    }else{
      if(!empty($_POST)){
        ?>
        <div class="col-md-12">
          <div class="alert" style="background-color: #fff;border-left: solid 3px #6003c8">
            Menampilkan Kegiatan Unit Kerja <b><?=$unit_kerja->nama_unit_kerja?></b> <?php if(!empty(set_value('tgl_awal'))){ ?> dari Tanggal <b><?=tanggal(set_value('tgl_awal'))?></b> <?php } if( !empty(set_value('tgl_akhir'))){?> sampai Tanggal <b><?=tanggal(set_value('tgl_akhir'))?></b> <?php }
          } ?>
        </div>
      </div>
      <div class="col-md-4 b-r">
        <div class="box-title text-center">
          <label>Daftar Pekerjaan</label>
        </div>
        <br>
        <div class="col-md-12">
          <?php
          if(!empty($daftar_pekerjaan)){
            foreach($daftar_pekerjaan as $dp){
              $jumlah = $this->realisasi_kegiatan_model->get_jumlah($dp->id_kegiatan);
              $progress = ($jumlah['verifikasi']/$jumlah['jumlah'])*100;
              ?>
              <div class="white-box">
                <span><?=$dp->nama_kegiatan?></span>
                <?php 
                if(empty($_POST)){
                  ?>
                  <span class="pull-right" style="background-color: #6003c8;padding: 3px;color: #fff;font-size: 10px"><?=$dp->nama_unit_kerja?></span>
                <?php } ?>
                <div class="row">
                  <div class="col-md-3">
                    <div style="margin-top: 10px">
                      <i class="fa fa-check-circle" style="color: #6003c8"></i> <span><?=$jumlah['verifikasi']?>/<?=$jumlah['jumlah']?></span>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="col-md-12">
                      <div class="user-img">
                        <img title="<?=$dp->nama_lengkap?>" data-toggle="tooltip" src="<?php echo base_url('data/foto/pegawai/');?>/<?=empty($dp->foto_pegawai) ? 'user-default.png' : $dp->foto_pegawai?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                        <span class="profile-status online" style="margin-top: 10px">Ketua Tim</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="pull-right" style="margin-top:10px;">
                      <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                      <ul role="menu" class="dropdown-menu">
                        <li>
                          <a href="<?=base_url('realisasi_kegiatan/detail/'.$dp->id_kegiatan.'')?>">Detail Progres Kegiatan</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br>
                <div class="progress m-b-0">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$progress?>%;"> </div>
                </div>
              </div>
            <?php } }else{
              ?>
              <div class="alert alert-primary"><i class="ti-alert"></i> Data tidak tersedia</div>
              <?php
            } ?>
          </div>
        </div>
        <div class="col-md-4 b-r">
          <div class="box-title text-center">
            <label>Sedang Dikerjakan</label>
          </div>
          <br>
          <div class="col-md-12">
            <?php
            if(!empty($sedang_dikerjakan)){
              foreach($sedang_dikerjakan as $dp){
                $jumlah = $this->realisasi_kegiatan_model->get_jumlah($dp->id_kegiatan);
                $progress = @($jumlah['verifikasi']/$jumlah['jumlah'])*100;
                ?>
                <div class="white-box">
                  <span><?=$dp->nama_kegiatan?></span>
                <?php 
                if(empty($_POST)){
                  ?>
                  <span class="pull-right" style="background-color: #6003c8;padding: 3px;color: #fff;font-size: 10px"><?=$dp->nama_unit_kerja?></span>
                <?php } ?>
                  <div class="row">
                    <div class="col-md-3">
                      <div style="margin-top: 10px">
                        <i class="fa fa-check-circle" style="color: #6003c8"></i> <span><?=$jumlah['verifikasi']?>/<?=$jumlah['jumlah']?></span>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="col-md-12">
                        <div class="user-img">
                          <img title="<?=$dp->nama_lengkap?>" data-toggle="tooltip" src="<?php echo base_url('data/foto/pegawai/');?>/<?=empty($dp->foto_pegawai) ? 'user-default.png' : $dp->foto_pegawai?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                          <span class="profile-status online" style="margin-top: 10px">Ketua Tim</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="pull-right" style="margin-top:10px;">
                        <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                        <ul role="menu" class="dropdown-menu">
                          <li>
                            <a href="<?=base_url('realisasi_kegiatan/detail/'.$dp->id_kegiatan.'')?>">Detail Progres Kegiatan</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="progress m-b-0">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$progress?>%;"> </div>
                  </div>
                </div>
              <?php } }else{
                ?>
                <div class="alert alert-primary"><i class="ti-alert"></i> Data tidak tersedia</div>
                <?php
              } ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box-title text-center">
              <label>Selesai Dikerjakan</label>
            </div>
            <br>
            <div class="col-md-12">

              <?php
              if(!empty($selesai_dikerjakan)){
                foreach($selesai_dikerjakan as $dp){
                  $jumlah = $this->realisasi_kegiatan_model->get_jumlah($dp->id_kegiatan);
                  $progress = ($jumlah['verifikasi']/$jumlah['jumlah'])*100;
                  ?>
                  <div class="white-box">
                    <span><?=$dp->nama_kegiatan?></span>
                <?php 
                if(empty($_POST)){
                  ?>
                  <span class="pull-right" style="background-color: #6003c8;padding: 3px;color: #fff;font-size: 10px"><?=$dp->nama_unit_kerja?></span>
                <?php } ?>
                    <div class="row">
                      <div class="col-md-3">
                        <div style="margin-top: 10px">
                          <i class="fa fa-check-circle" style="color: #6003c8"></i> <span><?=$jumlah['verifikasi']?>/<?=$jumlah['jumlah']?></span>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="col-md-12">
                          <div class="user-img">
                            <img title="<?=$dp->nama_lengkap?>" data-toggle="tooltip" src="<?php echo base_url('data/foto/pegawai/');?>/<?=empty($dp->foto_pegawai) ? 'user-default.png' : $dp->foto_pegawai?>" alt="user" class="img-circle" width="40px" style="border:3px solid white">
                            <span class="profile-status online" style="margin-top: 10px">Ketua Tim</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="pull-right" style="margin-top:10px;">
                          <a href="" class="icon-options-vertical" data-toggle="dropdown" style="font-size:20px;color:grey"></a>
                          <ul role="menu" class="dropdown-menu">
                            <li>
                              <a href="<?=base_url('realisasi_kegiatan/detail/'.$dp->id_kegiatan.'')?>">Detail Progres Kegiatan</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="progress m-b-0">
                      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$progress?>%;"> </div>
                    </div>
                  </div>
                <?php } }else{
                  ?>
                  <div class="alert alert-primary"><i class="ti-alert"></i> Data tidak tersedia</div>
                  <?php
                } ?>
              </div>
            </div>
          <?php } } } ?>
        </div>
      </div>
