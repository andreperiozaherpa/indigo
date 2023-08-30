
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Keluar Internal</h4> </div>
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
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Perihal Surat</label>
											<input type="text" id="" name="perihal" placeholder="Masukkan Perihal Surat" class="form-control" placeholder="" value="<?=($filter) ? $filter_data['perihal'] : ''?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">No. Reg Sistem</label>
											<input type="text" id="" name="hash_id" placeholder="Masukkan No. Registrasi Sistem" class="form-control" placeholder="" value="<?=($filter) ? $filter_data['hash_id'] : ''?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Tgl. Penerimaan Surat</label>
											<input type="text" class="form-control" name="tgl_buat" id="datepicker" placeholder="Pilih Tanggal Penerimaan" value="<?=($filter) ? $filter_data['tgl_buat'] : ''?>">
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


		<div class="col-md-4">
			<div class="row">
				<div style="height: 120px;display: table-cell;vertical-align: middle;width: 999px">
				<a href="<?php echo base_url('surat_internal/kategori_surat_keluar');?>" style="font-size: 15px;" class="btn btn-lg btn-rounded btn-primary btn-block"><span class="btn-label"><i data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Tambah Surat Keluar internal</a>
			</div>
			</div>
		</div>
		<div class="col-md-8">
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
								<a style="color: #6003c8" href="<?=base_url('surat_internal/surat_keluar')?>">Total Surat</a>
							</div>
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=count($perlu_tanggapan)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_internal/surat_keluar')?>/status_surat/perlu_tanggapan">Perlu tanggapan</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=count($dalam_proses)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_internal/surat_keluar')?>/status_surat/dalam_proses">Dalam Proses</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=count($selesai)?></h3>
								<a style="color: #6003c8" href="<?=base_url('surat_internal/surat_keluar')?>/status_surat/selesai">Selesai</a>
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
						echo '<div class="col-md-12"><div class="alert alert-primary">Menampilkan data surat dengan '.normal_string($summary_field).' = '.normal_string($summary_value).'</div></div>';
					}
					if(count($list) == 0){
						echo "<div class='alert alert-danger'>Belum ada Surat</div>";
					}else{
						?>

						<?php foreach($list as $l){
							$penerima = $this->surat_keluar_model->get_penerima($l->id_surat_keluar);
							$status_surat = $this->surat_keluar_model->get_status_surat($l->id_surat_keluar);
							if($l->status_surat=='Sudah Dibaca'){
								$color1 = "success";
								$color2 = "#00c292";
								$icon = "icon-envelope-open";
								$icon2 = "icon-check";

							}elseif($l->status_surat=="Belum Dibaca"){
								$color1 = "danger";
								$color2 = "#F75B36";
								$icon = "icon-envelope-letter";
								$icon2 = "icon-close";

							}elseif($l->status_surat=="Perlu Tanggapan"){
								$color1 = "warning";
								$color2 = "#f8c255";
								$icon = "icon-clock";
								$icon2 = "icon-info";
							}

							if($status_surat=="belum_diupload"){
								$c1 = "warning";
								$c2 = "#f8c255";
								$i1 = "ti-cloud-up";
								$i2 = "icon-info";
								$text = "Upload Surat";
							}elseif($status_surat=="menunggu_verifikasi"){
								$c1 = "info";
								$c2 = "#008efa";
								$i1 = "ti-write";
								$i2 = "icon-clock";
								$text = "Menunggu Verifikasi";
							}elseif($status_surat=="ditolak_verifikasi"){
								$c1 = "danger";
								$c2 = "#F75B36";
								$i1 = "ti-write";
								$i2 = "icon-close";
								$text = "Verifikasi Ditolak";
							}elseif($status_surat=="menunggu_penomoran"){
								$c1 = "info";
								$c2 = "#008efa";
								$i1 = "ti-layout-cta-left";
								$i2 = "icon-clock";
								$text = "Menunggu Penomoran";
							}elseif($status_surat=="ditolak_penomoran"){
								$c1 = "danger";
								$c2 = "#F75B36";
								$i1 = "ti-layout-cta-left";
								$i2 = "icon-close";
								$text = "Penomoran Ditolak";
							}elseif($status_surat=="menunggu_tandatangan"){
								$c1 = "info";
								$c2 = "#008efa";
								$i1 = "ti-pencil-alt";
								$i2 = "icon-clock";
								$text = "Menunggu Tandatangan";
							}elseif($status_surat=="ditolak_ttd"){
								$c1 = "danger";
								$c2 = "#F75B36";
								$i1 = "ti-pencil-alt";
								$i2 = "icon-close";
								$text = "Tandatangan Ditolak";
							}elseif($status_surat=="sudah_ditandatangani"){
								$c1 = "success";
								$c2 = "#00c292";
								$i1 = "ti-pencil-alt";
								$i2 = "icon-check";
								$text = "Sudah Ditandatangani";
							}else{
								$c1 = "warning";
								$c2 = "#f8c255";
								$i1 = "ti-timer";
								$i2 = "icon-clock";
								$text = "Dalam Proses";
							}
							?>

							<div class="mail col-md-4">
								<div class="mail-status <?=$c1?>" style="background-color: <?=$c2?>">
									<i class="<?=$i1?>"></i> <?=$text?>
								</div>

									<div class="white-box body">
										<div class="row">
										<h4 class="mail-title"><?=strlen($l->perihal)>=70 ? substr($l->perihal,0,70)."..." : $l->perihal?></h4>
										<div style="width: 80%;">
											<span class="label label-primary"><i class="fa fa-envelope-square"></i> <?=humanize($l->sifat_surat)?></span>
											<span class="label label-primary"><i class="fa fa fa-hashtag"></i> <?=$l->hash_id?></span>
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
											<a href="<?php echo base_url('surat_internal/detail_surat_keluar/'.$l->id_surat_keluar);?>" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail Surat</a>
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
