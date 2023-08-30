
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Kinerja Pegawai</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			>
			<ol class="breadcrumb">
				<li><a href="#">Laporan</a></li>
				<li class="active">Kinerja Pegawai</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- row -->

	<div class="row">
   <div class="col-md-12">
    <div class="white-box">
     <div class="row">
      <form method="POST">
      <?php if($user_level=='Administrator'){ ?>
        <div class="col-md-6">
         <div class="form-group">
          <label for="exampleInputEmail1">Unit kerja</label>
          <select name="id_unit_kerja" class="form-control select2">
           <option value="">Semua Unit Kerja</option>
           <?php 
           foreach($unit_kerja as $r){
            $selected = (!empty($id_unit_kerja) && $id_unit_kerja ==$r->id_unit_kerja) ? "selected" : "";
            echo'<option '.$selected.' value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
          }
          ?>
        </select>				
      </div>
    </div>
  <?php } ?>
  <div class="col-md-3">
   <div class="form-group">

    <br>
    <button type="submit" class="btn btn-primary m-t-5">Filter</button>
  </div>
</div>

</form>
</div>

</div>
</div>

</div>


<div class="row">
  <!-- .col -->
  <?php 
  $CI =& get_instance();
  foreach($pegawai as $p){
    $CI->load->model('kegiatan_model');
    $pekerjaan = $CI->kegiatan_model->get_pekerjaan($p->id_pegawai);

    $jumlah = count($pekerjaan);
    $total = 0;
    foreach($pekerjaan as $pe){
      $presentase = $CI->kegiatan_model->get_capaian($pe->id_kegiatan,$p->id_pegawai);
      $total += $presentase;
    }
    if($total==0){
      $p_total = 0;
    }else{
      $p_total = $total/$jumlah; 
    }

    ?>
    <div class="col-md-4 col-sm-4">
      <div class="white-box">
        <div class="row">
          <div class="col-md-4 col-sm-4 text-center">
            <div class="chart easy-pie-chart-1" data-percent="<?=$p_total?>"> <span><img src="<?=base_url()?>/data/user_picture/useravatar.png" alt="user" class="img-circle"></span> <canvas height="100" width="100"></canvas></div>
          </div>
          <div class="col-md-8 col-sm-8">
            <br>
            <h3 class="box-title m-b-0"><?=$p->nama_lengkap?></h3>
            <div style="height: 100px" class="well"><small><?=$p->nama_jabatan?></small></div>
            <address>
              <a href="<?php echo base_url();?>laporan/detail_pegawai/<?=$p->id_pegawai?>">
                <button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Profil</button>
              </a>
            </address>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- /.col -->
</div>


