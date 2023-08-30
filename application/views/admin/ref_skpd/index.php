
<div class="container-fluid">
	
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ref. SKPD</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
				<ol class="breadcrumb">
					<li class="active">Ref. SKPD</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">
							<div class="col-md-3 b-r">
								<a href="<?php echo base_url();?>ref_skpd/add">
									<button class="btn btn-primary m-t-15 btn-block"><i class="ti-plus"></i> Tambah SKPD</button>
								</a>
							</div>
							<form method="POST">

								<div class="col-md-6">
									<div class="form-group">
										<label>Nama SKPD </label>
										<input type="text" class="form-control" placeholder="Cari berdasarkan Nama SKPD" name="nama_skpd" value="<?=($filter) ? $filter_data['nama_skpd'] : ''?>">
									</div>
								</div>


								<div class="col-md-3">
									<div class="form-group">
										<br>
										<button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i> Filter</button>
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


			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="x_content">

						<?php foreach($list as $l){
							$unit_kerja = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($l->id_skpd);
							$pegawai = $this->ref_skpd_model->get_count_pegawai_by_id_skpd($l->id_skpd);
						?>

							<div class="col-md-4 col-sm-6">
								<div class="white-box">
									<div class="row b-b" style="min-height: 120px;" >
										<div class="col-md-4 col-sm-4 text-center b-r" style="min-height: 120px;">
											<img src="<?=base_url()?>data/logo/skpd/<?= ($l->logo_skpd=='') ? 'sumedang.png' : $l->logo_skpd  ?>" alt="user" class="img-circle img-responsive">
										</div>
										<div class="col-md-8 col-sm-8">
											<br>
											<h3 class="box-title m-b-0"><?=$l->nama_skpd?></h3>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-6 b-r text-center">
											<h3 class="box-title m-b-0"><?=count($unit_kerja)?></h3>
											Unit Kerja
										</div>
										<div class="col-md-6 text-center">
											<h3 class="box-title m-b-0"><?=$pegawai?></h3>
											Pegawai
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>ref_skpd/view/<?=$l->id_skpd?>">
													<button class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail SKPD</button>
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
							if(!$filter){
								echo make_pagination($pages,$current);
							}
							?>
						</div>
					</div>
				</div>

			</div>
