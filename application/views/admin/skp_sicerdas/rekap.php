<div class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title"><?= $title ?></h4>
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
    <div class="col-md-6">
      <div class="white-box">
        <!-- <h4 class="box-title text-purple">Filter Bulan dan Tahun</h4> -->
        <form method="POST">
        <div class="row">
          <div class="col-md-5">
            <label><i class="icon-user text-purple"></i> Nama Pegawai</label>
            <input type="text" class="form-control" value="<?=set_value('nama')?>" name="nama" placeholder="Cari Nama Pegawai">
          </div>
          <div class="col-md-4">
            <label>Bulan</label>
            <select name="bulan" class="form-control">
              <option value="">Semua Bulan</option>
              <?php 
                for($i=1;$i<=12;$i++){
                  $selected = set_value('bulan') == $i ? ' selected' : '';
                  echo '<option value="'.$i.'"'.$selected.'>'.bulan($i).'</option>';
                }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Tahun</label>
            <select name="tahun" class="form-control">
              <option value="">Semua Tahun</option>
              <?php 
                for($i=2020;$i<=2025;$i++){
                  $selected = set_value('tahun') == $i ? ' selected' : '';
                  echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                }
              ?>
            </select>
          </div>
        </div>
        <div class="row" style="margin-top:10px">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block"><i class="icon-magnifier"></i> Cari</button>
          </div>
        </div>
              </form>
      </div>
    </div>
    <div class="col-md-6">
      <div class="white-box" style="border-bottom:solid 3px #6003c8">
        <div class="row b-b">
          <div class="col-md-12 text-center" style="color: #6003c8;margin-bottom:15px">
            <b><i class="icon-briefcase"></i> REKAP KEGIATAN</b>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center b-r">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px"><?= $total_pegawai ?></h3>
            <a style="color: #6003c8" href="#!">Total Pegawai Input</a>
          </div>
          <div class="col-md-4 text-center b-r">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px"><?= $total_pekerjaan ?></h3>
            <a style="color: #6003c8" href="#!">Total Pekerjaan</a>
          </div>
          <div class="col-md-4 text-center">
            <h3 class="box-title m-b-0" style="font-size: 20px;padding-top:15px"><?= $pekerjaan_selesai ?></h3>
            <a style="color: #6003c8" href="#!">Pekerjaan Diselesaikan</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--row -->
  <div class="row">
    <?php
    if(empty($pegawai)){
      ?>
      <div class="col-md-12">
      <div class="alert alert-danger">
      Data tidak ditemukan
      </div></div>
      <?php
    }else{
    foreach ($pegawai as $p) {
      $total = count($this->kegiatan_personal_model->total_by_pegawai($p->id_pegawai_input));
      $selesai = count($this->kegiatan_personal_model->total_by_pegawai($p->id_pegawai_input, 'SELESAI DIVERIFIKASI'));
      $proses = count($this->kegiatan_personal_model->total_by_pegawai($p->id_pegawai_input, 'MENUNGGU VERIFIKASI'));
      $belum = count($this->kegiatan_personal_model->total_by_pegawai($p->id_pegawai_input, 'BELUM DIKERJAKAN'));
      $persen = $selesai/$total*100;
      $persen = round($persen,2);
    ?>
      <div class="col-md-4 col-sm-4">
        <div class="white-box">
          <div class="row">
            <div class="col-md-4 col-sm-4 text-center">
              <center>
                <a href="<?= base_url('kegiatan_personal/rekap_detail/'.$p->id_pegawai_input) ?>"><img style="object-fit: cover;height:100px;width:100px" src="<?= base_url('data/foto/pegawai/' . $p->foto_pegawai) ?>" alt="user" class="img-circle img-responsive"></a>
                <a href="<?= base_url('kegiatan_personal/rekap_detail/'.$p->id_pegawai_input) ?>" class="btn btn-primary btn-block m-t-10 btn-rounded">Detail</a>
              </center>
            </div>
            <div class="col-md-8 col-sm-8">
              <h3 style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%" class="box-title m-b-0"><?= $p->nama_lengkap ?></h3>
              <p style="padding:0px;font-size:85%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width:100%"><?= $p->jabatan ?></p>
              <div class="b-t" style="padding-top:10px;margin-top:3px;">
                <p>Total Pekerjaan : <b><?= $total ?></b></p>
                <span class="text-purple"><?=$persen?>%</span>
                <div class="progress m-b-0">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$persen?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$persen?>%;"> <span class="sr-only"><?=$persen?>% Complete</span> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }
    } ?>
  </div>
  

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