<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Rencana Kerja Pemerintah Desa</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li>RKP Desa</li>
				<li class="active">Perencanaan</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">

					<form method="POST">

						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Desa </label>
								<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Desa" name="nama_skpd" value="<?= ($filter) ? $filter_data['nama_skpd'] : '' ?>">
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">

								<br>
								<button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>
								<?php
								if ($filter) {
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


	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="x_content">

				<?php foreach ($list as $l) {
					$j_ss = 1;
					$j_sp = 1;
					$j_sk = 3;
					$j_iku = 3;


				?>


					<div class="col-md-4 col-sm-6">
						<div class="white-box">
							<div class="row b-b" style="min-height: 150px;">
								<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 150px;">
									<img src="<?= base_url() ?>data/logo/skpd/<?= ($l->logo_skpd == '') ? 'sumedang.png' : $l->logo_skpd  ?>" alt="user" class="img-circle img-responsive">
								</div>
								<div class="col-md-8 col-sm-8">
									<p>&nbsp;</p>
									<h3 class="box-title m-b-0"><?= $l->nama_skpd ?></h3>
								</div>
							</div>
							<div class="row b-b">
								<div class="col-md-12 text-center">
									<p></p>
									<h3 class="box-title m-b-0"><?= $j_iku ?></h3>
									Sasaran

								</div>
							</div>
							<div class="row b-b">
								<div class="col-md-4 col-sm-4 text-center b-r">
									<h3 class="box-title m-b-0"><?= $j_ss ?></h3>
									Bidang
								</div>
								<div class="col-md-4 col-sm-4 text-center b-r">
									<h3 class="box-title m-b-0"><?= $j_sp ?></h3>
									Sub Bidang
								</div>
								<div class="col-md-4 col-sm-4 text-center ">
									<h3 class="box-title m-b-0"><?= $j_sk ?></h3>
									Kegiatan
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<br>
									<address>
										<a href="<?php echo base_url(); ?>rkpdesa/detail/<?= $l->id_skpd ?>">
											<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Desa</button>
										</a>
									</address>
								</div>
							</div>
						</div>
					</div>

				<?php } ?>


				<!-- /.col -->
			</div>



			<div class="row">
				<div class="col-md-12 pager">
					<?php
					if (!$filter) {
						echo make_pagination($pages, $current);
					}
					?>
				</div>
			</div>


		</div>

	</div>