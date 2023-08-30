
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Kegiatan Tim</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-md-3 col-xs-12">
      <div class="white-box">
        <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
          <div class="overlay-box">
            <div class="user-content" style="padding-bottom:15px;">
              <a href="javascript:void(0)"><img src="<?php echo $data_by_bkd->foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url()."data/foto/pegawai/".$data_by_bkd->foto_pegawai : base_url()."data/foto/pegawai/user-default.png";?>" class="thumb-lg img-circle" style=" object-fit: cover;

              width: 100px;
              height: 100px;border-radius: 50%;
              " alt="img"></a>
              <h5 class="text-white"><b><?=isset($data_by_bkd->nama_lengkap) ? $data_by_bkd->nama_lengkap : '-' ?></b></h5>
              <h6 class="text-white"><?=isset($data_by_bkd->nip) ? $data_by_bkd->nip : '-' ?></h6>
            </div>
          </div>
        </div>
        <div class="user-btm-box">
          <div class="row">
            <div class="col-md-12 b-b text-center">
              <h6><b>SKPD
              </b></h6>
              <h6><?=isset($data_by_bkd->nama_skpd) ? $data_by_bkd->nama_skpd : '-' ?>
            </h6>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 b-r text-center">
            <h6><b>Unit Kerja</b></h6>
            <h6>
              <?=isset($data_by_bkd->nama_unit_kerja) ? $data_by_bkd->nama_unit_kerja : '-' ?>
            </h6>
          </div>
          <div class="col-md-6 text-center">
            <h6><b>Jabatan</b></h6>
            <h6>
              <?=isset($data_by_bkd->nama_jabatan) ? $data_by_bkd->nama_jabatan : '-' ?>
            </h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-9 col-xs-12">
   <div class="row">
    <div class="col-md-12">
      <div class="white-box">
       <div class="row">
        <form method="POST">
					<div class="col-md-10">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nama Kegiatan</label>
								<input type="text" class="form-control" name="nama_kegiatan" placeholder="...">
							</div>
						</div>
						<div class="col-md-4">
						 <div class="form-group">
							 <label for="">Tanggal Awal</label>
							 <input type="text" class="form-control" name="tanggal_awal" id="datepicker" placeholder="mm-dd-yyyy" value="">
						 </div>
					 </div>
					 <div class="col-md-4">
						 <div class="form-group">
							 <label for="">Tanggal akhir</label>
							 <input type="text" class="form-control" name="tanggal_akhir" id="datepicker" placeholder="mm-dd-yyyy" value="">
						 </div>
					 </div>
					</div>


         <div class="col-md-2  b-l">
           <div class="form-group text-center">
            <br>
            <button type="submit" class="btn btn-primary btn-outline m-t-5 btn-block"><i class="ti-filter"></i> Filter</button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
<?php
$total = count($kegiatan);
$selesai = 0;
$belum_selesai = 0;
foreach($kegiatan as $q){
  $progress = $this->realisasi_kegiatan_model->get_progress($q->id_kegiatan);

  if($progress<100){
    $belum_selesai++;
  }else{
    $selesai++;
  }
}
?>
<div class="col-md-12">
 <div class="col-md-4 col-xs-12 col-sm-6">
  <div class="white-box text-center bg-purple">
    <p class="text-white">Total Kegiatan Tim</p>
    <h1 class="text-white counter"><?=$total?></h1>
  </div>
</div>
<div class="col-md-4 col-xs-12 col-sm-6">
  <div class="white-box text-center bg-purple">
    <p class="text-white">Kegiatan Selesai</p>
    <h1 class="text-white counter"><?=$selesai?></h1>
  </div>
</div>
<div class="col-md-4 col-xs-12 col-sm-6">
  <div class="white-box text-center bg-purple">
    <p class="text-white">Kegiatan Belum Selesai</p>
    <h1 class="text-white counter"><?=$belum_selesai?></h1>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- /.row -->
<div class="row">
  <div class="col-sm-12">
    <div class="table-responsive" style="background-color:white;">
      <table class="table color-table muted-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Tgl. Kegiatan</th>
            <th>Nama Kegiatan</th>
            <th style="width:30%">Uraian Tugas</th>
            <th>Ketua Tim</th>
            <th>Status Kegiatan</th>
            <th>Tgl. Selesai</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $n=1;
          foreach($kegiatan as $q){
            $progress = $this->realisasi_kegiatan_model->get_progress($q->id_kegiatan);
            $last = $this->realisasi_kegiatan_model->get_last($q->id_kegiatan);
            print_r($last);
            ?>

            <tr>
              <td><?=$n?></td>
              <td><?=tanggal($q->tgl_mulai_kegiatan).' s.d. '.tanggal($q->tgl_mulai_kegiatan)?></td>
              <td><?=$q->nama_kegiatan?></td>
              <td><?=$q->uraian_kegiatan?></td>
              <td><?=$q->nama_lengkap?></td>
              <td>
                <?php
                if($progress<100){
                  ?>
                  <i class="fa fa-calendar-o" style="color:red"></i> Belum Selesai
                  <?php
                }else{
                  ?>
                  <i class="fa fa-calendar-check-o" style="color:#6003c8"></i> Selesai
                <?php } ?>
              </td>
              <td>

                <?php
                if($progress<100){
                  ?>
                  -
                  <?php
                }else{
                  ?>
                  <?=tanggal($last->tgl_update)?>
                <?php } ?>
              </td>
              <td><a href="<?=base_url('realisasi_kegiatan/detail/'.$q->id_kegiatan)?>" class="label label-primary label-rounded">Detail</a></td>
            </tr>
            <?php
            $n++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <a href="#" class="label label-rounded pull-right" style="margin-top:15px;background-color:orange">DOWNLOAD XLS</a>
</div>

<!-- .right-sidebar -->
