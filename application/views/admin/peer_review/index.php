<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Penilaian Perilaku</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li><a href="https://e-office.sumedangkab.go.id/kegiatan_personal">Penilaian Perilaku</a></li>
        <li class="active">Rekap</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="white-box text-center">
      <h3>PENILAIAN PERILAKU</h3>
      <p>Bulan <span style="font-weight: 500;" class="text-purple"><?=bulan($bulan)?></span> Tahun <span style="font-weight: 500;" class="text-purple"><?=$tahun?></span></p>
        <!-- <h4 class="box-title text-purple">Filter Bulan dan Tahun</h4> -->
      </div>
    </div>
    <div class="col-md-6">
      <div class="white-box" style="border-bottom:solid 3px #6003c8">
        <div class="row b-b">
          <div class="col-md-12 text-center" style="color: #6003c8;margin-bottom:15px">
            <b><i class="icon-briefcase"></i> REKAP Penilaian Perilaku</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center b-r">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px">0</h3>
            <a style="color: #6003c8" href="#!">Total Pegawai</a>
          </div>
          <div class="col-md-4 text-center b-r">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px">0</h3>
            <a style="color: #6003c8" href="#!">Sudah di Nilai</a>
          </div>
          <div class="col-md-4 text-center">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px">0</h3>
            <a style="color: #6003c8" href="#!">Belum di Nilai</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--row -->
  <div class="row">
    <?php
    foreach ($menilai as $m) {
      $penilaian = $this->peer_review_model->get_penilai($m->id_pegawai,$id_pegawai_penilai,$bulan,$tahun);
    ?>
      <div class="col-md-4 col-sm-4">
        <div class="white-box">
          <div class="row">
            <div class="col-md-4 col-sm-4 text-center">
              <center>
                <a href="<?= base_url(); ?>peer_review/detail/<?="$m->id_pegawai/$bulan/$tahun"?>"><img style="object-fit: cover;height:100px;width:100px" src="<?= base_url() ?>/data/foto/pegawai/<?= $m->foto_pegawai ?>" alt="user" class="img-circle img-responsive"></a>

              </center>
            </div>
            <div class="col-md-8 col-sm-8">
              <h3 style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%" class="box-title m-b-0"><?= $m->nama_lengkap ?></h3>
              <p style="padding:0px;font-size:85%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%"><?= $m->jabatan ?></p>
              <div class="b-t" style="padding-top:10px;margin-top:3px;">
                <p>Status Penilaian:<br>
                <?php 
                  if($penilaian){
                    ?>
                    <span class="label label-success">Sudah</span>
                    <?php
                  }else{
                    ?>
                    <span class="label label-warning">Belum</span>
                    <?php
                  }
                ?>
                </p>
              </div>
            </div>
            <div class="col-md-12">
              <a href="<?= base_url(); ?>peer_review/detail/<?="$m->id_pegawai/$bulan/$tahun"?>" class="btn btn-outline btn-primary btn-block m-t-10 btn-rounded">Lakukan Penilaian</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- <div class="row">
      <div class="col-md-12 pager">
        <a href="?page=1" class="btn btn-primary disabled">1</a> <a href="?page=2" class="btn btn-primary ">2</a> <a href="?page=3" class="btn btn-primary ">3</a> <a href="?page=4" class="btn btn-primary ">4</a> <a href="?page=2" class="btn btn-primary">Selanjutnya</a> <a href="?page=30" class="btn btn-primary">Akhir</a>
      </div>
    </div> -->
  </div>