
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ref. Surat</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Ref. Surat</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">

							<form method="POST">
								<?php
									?>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Nama Surat </label>
												<input type="text" class="form-control" placeholder="Cari berdasarkan Nama Surat" name="nama_surat" value="<?=($filter) ? $filter_data['nama_surat'] : ''?>">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Jenis Surat</label>
												<select class="form-control" name="jenis_surat">
													<option value="">Semua</option>
													<?php
													$jenis = array('internal','eksternal');
													foreach($jenis as $j){
														$selected = '';
														if($filter){
															if($filter_data['jenis_surat']==$j){
																$selected = ' selected';
															}
														}
														echo '<option value="'.$j.'"'.$selected.'>'.ucwords($j).'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
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

			<div class="col-md-4">
				<div class="white-box">
					<div class="row">
						<a href="<?=base_url('ref_surat/add')?>" class="btn btn-block btn-primary btn-rounded waves-effect waves-light"> <span class="btn-label"><i class="fa fa-plus"></i></span> Tambah Ref. Surat</a>

					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="white-box">
					<div class="row" >
						<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
							<img src="<?php echo base_url('asset/logo/surat.png');?>" width="80px" height="60px" alt="">
						</div>
						<div class="col-md-10 col-sm-10"  >
							<div class="row b-b">
								<div class="col-md-12 text-center">
									Status Surat
								</div>
							</div>
							<div class="row">
								<div class="col-md-2 text-center b-r">
									<h3 class="box-title m-b-0"><?=$total_surat?></h3>
									Total Surat
								</div>
								<div class="col-md-5 text-center b-r">
									<h3 class="box-title m-b-0"><?=$total_internal?></h3>
									Surat Internal
								</div>
								<div class="col-md-5 text-center b-r ">
									<h3 class="box-title m-b-0"><?=$total_eksternal?></h3>
									Surat Eksternal
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
						<?php foreach($list as $l){
							if($l->jenis_surat=='internal'){
								$type = 'primary';
								$color = '6003c8';
							}elseif($l->jenis_surat=='eksternal'){
								$type = 'danger';
								$color = 'f75b36';
							}else{
								$type = "default";
								$color = '6003c8';
								$text_color = '6003c8';
							}
							?>
							<div class="col-md-4 col-sm-6" >
								<div class="panel panel-<?=$type?>">
									<div class="panel-heading text-center"<?=isset($text_color) ? ' style="color: #'.$text_color.'"' : ''?>>
										Surat <?=$l->jenis_surat?>
									</div>
									<div class="panel-body">
										<div class="row b-b" style="min-height: 30px;">
											<div class="col-md-4 col-sm-4 text-center b-r">
												<i data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#<?=$color?>;"></i>
											</div>
											<div class="col-md-8 col-sm-8"  >
												<h5><?=$l->nama_surat?></h5>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<br>
												<address>
														<a href="<?php echo base_url('ref_surat/detail/'.$l->id_ref_surat.'');?>" class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Surat</a>
												</address>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
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
		</div>
