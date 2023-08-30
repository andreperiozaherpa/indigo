
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Masuk Eksternal</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?=breadcrumb($this->uri->segment_array()) ?>
				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">

							<form method="POST">

								<div class="col-md-10">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Perihal Surat</label>
												<input type="text" id="" name="perihal" placeholder="Masukan Perihal Surat" class="form-control" value="<?=($filter) ? $filter_data['perihal'] : ''?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Tgl. Penerimaan Surat</label>
												<input type="text" class="form-control" name="tgl_input" id="datepicker" placeholder="Pilih Tanggal" value="<?=($filter) ? $filter_data['tgl_input'] : ''?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Pengirim</label>
												<input type="text" class="form-control"  name="pengirim" placeholder="Masukan Pengirim" value="<?=($filter) ? $filter_data['pengirim'] : ''?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Penerima</label>
												<input type="text" class="form-control" name="nama_skpd" placeholder="Masukan Penerima" value="<?=($filter) ? $filter_data['nama_skpd'] : ''?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2 b-l text-center">
									<div class="form-group">
										<br>
										<button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-12">
			<div class="white-box" style="border-left: solid 3px #6003c8">
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
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=count($total)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_masuk')?>">Total Surat</a>
							</div>
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=count($unread)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_masuk')?>/status_surat/Belum Dibaca">Belum dibaca</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=count($read)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_masuk')?>/status_surat/Sudah Dibaca">Sudah dibaca</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=count($mustread)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_eksternal/surat_masuk')?>/status_surat/Perlu Tanggapan">Perlu tanggapan</a>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_content">
							<?php
					if(!empty($summary_value)&&!empty($summary_field)){
						echo '<div class="alert alert-primary">Menampilkan data surat dengan '.normal_string($summary_field).' = '.normal_string($summary_value).'</div>';
					}
					 if(count($list) == 0){
									echo "<div class='alert alert-danger'>Belum ada Surat</div>";
								}else{ ?>
						<?php foreach($list as $l){
							if($l->status_verifikasi=='sudah_diverifikasi'){
								$color1 = "success";
								$color2 = "#00c292";
								$icon = "icon-envelope-letter";
								$icon2 = "icon-check";

							}elseif($l->status_verifikasi=="ditolak"){
								$color1 = "danger";
								$color2 = "#F75B36";
								$icon = "icon-envelope-open";
								$icon2 = "icon-close";

							}elseif($l->status_verifikasi=="belum_diverifikasi"){
								$color1 = "warning";
								$color2 = "#f8c255";
								$icon = "icon-clock";
								$icon2 = "icon-info";
							}
							?>

							<div class="mail col-md-4">
									<div class="mail-status <?=$color1?>">
										<i class="<?=$icon?>"></i> <?=normal_string($l->status_verifikasi)?>
									</div>

									<div class="white-box body">
										<div class="row">
										<h4 class="mail-title"><?=strlen($l->perihal)>=70 ? substr($l->perihal,0,70)."..." : $l->perihal?></h4>
										<div style="width: 80%;">
											<span class="label label-primary"><i class="fa fa-envelope-square"></i> <?=humanize($l->sifat)?></span>
										</div>
										<center>
										</center>

										<div class="mail-receiver">
											<i class="icon-people"></i> <span class="text">Penerima</span><span class="label label-primary pull-right" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?=tanggal($l->tgl_input)?></span>
										</div>
										<!-- <span style="display:block;font-weight:500" class="text-purple"><?=$l->nama_penerima?></span> -->
										<?=strlen($l->nama_skpd)>=35 ? substr($l->nama_skpd,0,35)."..." : $l->nama_skpd?>

										<div class="mail-receiver">
											<i class="icon-paper-plane"></i> <span class="text">Pengirim</span> <span class="label label-primary pull-right" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?=tanggal($l->tanggal_surat)?></span>
										</div>
										<?=strlen($l->pengirim)>=35 ? substr($l->pengirim,0,35)."..." : $l->pengirim?>
										<div class="mail-footer">
											<a href="<?php echo base_url('surat_eksternal/detail_surat_masuk_verifikasi/'.$l->id_surat_masuk_verifikasi);?>" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail Surat</a>
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
