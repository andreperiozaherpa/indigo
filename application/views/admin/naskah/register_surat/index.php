<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Registrasi Surat Keluar</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Registrasi Surat Keluar</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="POST">
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="">Nomer Surat</label>
										<input type="text" name="nomer_surat" id="" value="<?=isset($nomer_surat) ? $nomer_surat : NULL ?>" class="form-control" placeholder="Nomer Surat">
									</div>
								</div>
								<div class="form-group">
									<label>Periode Tanggal Surat </label>
									<div class="input-daterange input-group" id="datepicker">
										<input type="text" class="form-control" name="start" placeholder="YYYY-MM-DD" value="<?=isset($start) ? $start : NULL ?>" />
										<span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
										<input type="text" class="form-control" name="end" placeholder="YYYY-MM-DD" value="<?=isset($end) ? $end : NULL ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 text-center">
							<div class="row">
								<div class="form-group">
									<br>
									<button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Verifikasi</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="white-box" style="border-left:3px solid #6003c8">
				<div class="row" >
					<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
						<img src="<?php echo base_url('asset/logo/surat.png');?>" width="80px" height="60px" alt="">
					</div>
					<div class="col-md-10 col-sm-10"  >
						<div class="row b-b">
							<div class="col-md-12 text-center" style="color: #6003c8">
								<b>STATUS SURAT</b>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 text-center b-r">
								<h3 class="box-title m-b-0"><?=count($total)?></h3>
								<a style="color: #6003c8" href="<?=base_url('register_surat')?>">Total Surat</a>
							</div>
							<div class="col-md-4 text-center b-r">
								<h3 class="box-title m-b-0"><?=count($registered)?></h3>
								<a style="color: #6003c8" href="<?=base_url('register_surat/index/status_register/Sudah Diregistrasi')?>">Sudah Diregistrasi</a>
							</div>
							<div class="col-md-4 text-center b-r ">
								<h3 class="box-title m-b-0"><?=count($unregistered)?></h3>
								<a style="color: #6003c8" href="<?=base_url('register_surat/index/status_register/Belum Diregistrasi')?>">Belum Diregistrasi</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div>
			</div>
			<div class="x_content">
				<?php if(count($total) == 0){
					echo "<div class='alert alert-danger'>Belum ada Surat</div>";
				}elseif (count($list) == 0) {
					echo "<div class='alert alert-danger'>Belum ada Surat dengan pencarian tersebut</div>";
				}else{ ?>
					<?php foreach($list as $l){
						$penerima = $this->surat_keluar_model->get_penerima($l->id_surat_keluar);
						if($l->status_register == 'Sudah Diregistrasi'){
							$color1 = "success";
							$color2 = "#00c292";
							$icon = "icon-envelope-open";
							$icon2 = "icon-check";
							$l->status_penomoran = 'Sudah Diregistrasi';
						}elseif ($l->status_register == 'Belum Diregistrasi') {
							$color1 = "warning";
							$color2 = "#f8c255";
							$icon = "icon-clock";
							$icon2 = "icon-info";
							$l->status_penomoran = 'Belum Diregistrasi';
						};
						?>
							<div class="mail col-md-4">
									<div class="mail-status <?=$color1?>">
										<i class="<?=$icon2?>"></i> <?=normal_string($l->status_penomoran)?>
									</div>

									<div class="white-box body">
										<div class="row">
										<h4 class="mail-title"><?=strlen($l->perihal)>=70 ? substr($l->perihal,0,70)."..." : $l->perihal?></h4>
										<div style="width: 80%;">
											<span class="label label-primary"><i class="fa fa-envelope-square"></i> <?=humanize($l->sifat_surat)?></span>
											<span class="label label-primary"><i class="fa fa fa-hashtag"></i> <?=$l->hash_id?></span>
											<span class="label label-<?=$l->jenis_surat=='internal' ? 'success' : 'danger'?>"><i class="fa fa-tag"></i> <?=humanize($l->jenis_surat)?></span>
										</div>
										<center>
										</center>

										<div class="mail-receiver">
											<i class="icon-people"></i> <span class="text">Penerima</span>
										</div>

										<?php
										$i=1;

										if(count($penerima) < 2)
										{
											$selebihnya = "";
										}
										else{
											$selebihnya = count($penerima) - 2;
										}
										$pp = '';

										foreach($penerima as $k => $p) {
											?>
											<?php
											if($p->jenis_surat=='internal'){
												$t = $p->nama_lengkap;
											}elseif($p->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
												$t = "Kepala ".$p->nama_skpd;
											}else{
												$t = $p->nama_penerima;
											}

											if(count($penerima)>1){
												if(strlen($t)>=15){
													$t = substr($t, 0, 15)."..";
												}
												if($k!==1){
													$t .= ', ';
												}
											}else{
												if(strlen($t)>=40){
													$t = substr($t, 0, 40)."..";
												}
											}

											$pp .= $t;


											?>
											<?php
											if ($i++ == 2) break;

										}
										echo $pp;
										?>

										<?php
										if(count($penerima) <= 2) {
											$selebihnya = "";
										}
										else
										{
											echo '<span style="background-color: #6003C8;border-radius: 50%;padding: 5px;font-size: 10px;color: #fff;font-weight: 500">+'.$selebihnya.'</span>';
										}
										?>

										<div class="mail-receiver">
											<i class="icon-paper-plane"></i> <span class="text">Pengirim</span> <span class="label label-primary pull-right" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?=tanggal($l->tgl_buat)?></span>
										</div>
										<?=strlen($l->nama_skpd)>=35 ? substr($l->nama_skpd,0,35)."..." : $l->nama_skpd?>
										<div class="mail-footer">
											<a href="<?php echo base_url('register_surat/detail/'.$l->id_surat_keluar);?>" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail Surat</a>
										</div>
									</div>
								</div>
							</div>
					<?php }} ?>
				</div>
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
