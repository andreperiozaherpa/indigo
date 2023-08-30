<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Data Assement</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
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
						<div class="col-md-4">
							<div class="form-group">
								<label>NIP</label>
										<input type="number" max-length="18" class="form-control" placeholder="Cari berdasarkan NIP" name="nip" value="<?=($filter) ? $filter_data['nip'] : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Lengkap</label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Lengkap" name="nama_lengkap" value="<?=($filter) ? $filter_data['nama_lengkap'] : ''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">SKPD</label>
								<select name="id_skpd" class="form-control select2">
									<option value="">Pilih SKPD</option>
									<?php
									foreach($skpd as $s){
										if($filter){
											if($filter_data['id_skpd']==$s->id_skpd){
												$selected = ' selected';
											}else{
												$selected = '';
											}
										}else{
											$selected = '';
										}
										echo'<option value="'.$s->id_skpd.'"'.$selected.'>'.$s->nama_skpd.'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<!-- <div class="col-md-3">
							<div class="form-group">
								<label>Status Verifikasi</label>
								<select class="form-control" name="status_verifikasi">
									<option value="">Pilih</option>
									<?php
									$selected1 = "";
									$selected2 = "";
									$selected3 = "";
									if ($filter_data['status_verifikasi'] == 1){
										$selected1 = "selected";
									}elseif ($filter_data['status_verifikasi'] == 2){
										$selected2 = "selected";
									}elseif ($filter_data['status_verifikasi'] == 3){
										$selected3 = "selected";
									} ?>
									<option value="true" <?=$selected1?>>SUDAH DIVERIFIKASI</option>
									<option value="false" <?=$selected2?>>BELUM DIVERIFIKASI</option>
									<option value="process" <?=$selected3?>>PERLU TANGGAPAN</option>
								</select>
							</div>
						</div> -->
					</div>
					<div class="col-md-2">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>
              </div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-12">
			<div class="white-box" style="border-left: solid 3px #6003c8">
					<div class="row" >
						<div class="col-md-2 col-sm-2 text-center b-r" >
							<i class="ti-user mt-2" style="font-size:70px;color: #6003c8"></i>
						</div>
						<div class="col-md-10 col-sm-10"  >
							<div class="row b-b">
							<div class="col-md-12 text-center" style="color: #6003c8">
								<b>STATUS VERIFIKASI</b>
							</div>
							</div>
						<div class="row">
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=$total_pegawai;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/">Total Pegawai</a>
							</div>
							<div class="col-md-3 text-center b-r">
								<h3 class="box-title m-b-0"><?=$total_pegawai_true;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/true">Sudah Diverifikasi</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=$total_pegawai_false;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/false">Belum Diverifikasi</a>
							</div>
							<div class="col-md-3 text-center b-r ">
								<h3 class="box-title m-b-0"><?=$total_pegawai_process;?></h3>
								<a style="color: #6003c8" href="https://e-office.sumedangkab.go.id/data_assement/index/status_verifikasi_data/process">Perlu Tanggapan</a>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
			<!-- <br>
			<br>
			<br>
</div> -->

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<?php
		$color = "";
		$color_code = "";
		$icon = "";
		$status = "";
		for ($i=1; $i <= 3 ; $i++) { ?>
			<div class="col-md-4 col-sm-6">
				<div class="verify-data-status <?=$color?>">
				<i class="<?=$icon?>"></i> <?=$status?>
				</div>
				<div class="white-box" style="height:300px;width:auto;">
					<div class="row b-b" style="height:120px;">
						<div class="col-md-4 col-xs-4 b-r text-center" style="height:120px;">
							<br>
							<img src="<?=base_url('data/foto/pegawai/user_default.png')?>" alt="user" style=" object-fit: cover;
				  width: 80px;
				  height: 80px;border-radius: 50%;
				  ">
						</div>
						<div class="col-md-8  col-xs-8">
							<br>
							<h5><b>Nandang Koswara</b></h5>
							<h5><small>1234567890</small></h5>
						</div>
					</div>
					<div class="row b-b" style="height:85px;">
						<div class="text-center">
							<br>
							<b><i class="fa fa-users"></i> SKPD</b>
							<br>
							<small>DPMPTSP</small>
						</div>
					</div>
					<div class="row">
						<br>
						<a href="https://e-office.sumedangkab.go.id/individual_development_plan/add/">
							<button class="btn btn-primary btn-block btn btn-<?=$color?> btn-outline btn-1b btn-block">Formulir IDP</button>
						</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>


<!-- <div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

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

	</div> -->
</div>
