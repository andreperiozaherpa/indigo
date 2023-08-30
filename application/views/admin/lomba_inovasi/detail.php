<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<a style="margin-bottom: 10px" href="<?= base_url('standar_kepatuhan') ?><?= isset($_GET['page']) ? '?page=' . $_GET['page'] : ''; ?>" class="btn btn-default pull-right"><i class="icon-arrow-left-circle"></i> Kembali</a><br><br>
			<?php if ($this->session->flashdata('error')) : ?>
				<div class="col-md-10">
					<div class="alert alert-warning">
						<p>File gagal diupload, silahkan coba kembali</p>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('success')) { ?>
				<div class="alert alert-success">
					<?=$this->session->flashdata('success')?>
				</div>
			<?php } ?>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">DETAIL RESPONDEN
						</div>
						<div class="panel-body">
							<div class="row m-b">
								<div class="col-md-12">
									<div class="form-group">
										<label>SKPD</label>
										<span class="label label-primary"><?= $detail['nama_skpd'] ?></span> </p>
									</div>
									<div class="form-group">
										<label>Nama Responden</label>
										<p style="line-height: 0">
											<b>
												<i>
													<?=$detail['nama_lengkap']?>	
												</i>
											</b>
										 </p>
									</div>
									<div class="form-group">
										<label>Diinput pada tanggal</label>
										<p style="line-height: 0"><?=date('d, M Y')?></b></p>
									</div>
									<div class="form-group">
										<label>Jumlah Jenis Pelayanan (berdasarkan SK Standar Pelayanan)</label>
										<p style="line-height: 0"><?=$detail['jumlah_jenis_pelayanan']?></p>
									</div>
									<?php if (!empty($detail['jumlah_jenis_pelayanan_file'])) {
										if (file_exists('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])) { ?>
											<div class="form-group">
												<label>Jumlah Jenis Pelayanan File Pendukung(berdasarkan SK Standar Pelayanan)</label>
												<br>
												<?php 
												$ext = explode('.',$detail['jumlah_jenis_pelayanan_file']);
												if ($ext[1] == 'pdf') { ?>
													<div>
														<object
															data='<?=base_url('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])?>'
															type="application/pdf"
															width="500"
															height="500"
														>

															<iframe
															src='<?=base_url('./data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])?>'
															width="500"
															height="500"
															>
															<p>This browser does not support PDF!</p>
															</iframe>

														</object>
														</div>
												<?php }else{ ?>
													<a href="<?=base_url('data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])?>" target="_blank">
														<img src="<?=base_url('data/standar_kepatuhan/'.$detail['jumlah_jenis_pelayanan_file'])?>" width="300" height="300" style="object-fit:cover;" alt="">
													</a>
												<?php }
												?>
											</div>
										<?php }
									} ?>
									<?php foreach ($column as $key => $value) {
										if ($value->name == 'id_user' || $value->name == 'created_at' || $value->name == 'updated_at' || $value->name == 'id_standar_kepatuhan' || $value->name == 'id_skpd' 
											|| $value->name == 'jumlah_jenis_pelayanan' || $value->name == 'jumlah_jenis_pelayanan_file' || substr($value->name, -5) == '_file' || substr($value->name, -5) == '_foto'
											|| $value->name == 'status_review' || $value->name == 'nilai_review' || $value->name == 'catatan_review') {
											continue;
										}
									?>
									<div class="form-group">
										<label>Apakah tersedia <?=ucwords(str_replace("_"," ", $value->name))?> ?</label>
										<p style="line-height: 0">
										<?php if ($detail[$value->name] == 'YA') {
											$type = 'success';
										}else{
											$type = 'danger';
										} ?>
										<span class="label label-<?=$type?>">
											<?=$detail[$value->name]?>
										</span>
										</p>
									</div>
									<div class="row">
										<div class="col-md-12">
											<?php if (!empty($detail[$value->name.'_foto'] && $type == 'success')) {
												if (file_exists('./data/standar_kepatuhan/'.$detail[$value->name.'_foto'])) { ?>
												<div class="col-md-6">
													<div class="form-group">
														<label>Data Pendukung <?=ucwords(str_replace("_"," ", $value->name))?></label>
														<?php 
															$ext = explode('.',$detail[$value->name.'_foto']);
															if ($ext[1] == 'pdf') { ?>
																<div>
																	<object
																		data='<?=base_url('./data/standar_kepatuhan/'.$detail[$value->name.'_foto'])?>'
																		type="application/pdf"
																		width="500"
																		height="500"
																	>

																		<iframe
																		src='<?=base_url('./data/standar_kepatuhan/'.$detail[$value->name.'_foto'])?>'
																		width="500"
																		height="500"
																		>
																		<p>This browser does not support PDF!</p>
																		</iframe>

																	</object>
																	</div>
															<?php }else{ ?>
																<a href="<?=base_url('data/standar_kepatuhan/'.$detail[$value->name.'_foto'])?>" target="_blank">
																	<img src="<?=base_url('data/standar_kepatuhan/'.$detail[$value->name.'_foto'])?>" width="300" height="300" style="object-fit:cover;" alt="">
																</a>
															<?php }
															?>
													</div>
												</div>
												<?php }
											} ?>
											<?php if (!empty($detail[$value->name.'_file'] && $type == 'success')) {
												if (file_exists('./data/standar_kepatuhan/'.$detail[$value->name.'_file'])) { ?>
													<div class="col-md-6">
														<div class="form-group">
															<label>Ketersediaan Standar Pelayanan</label>
															<?php 
															$ext = explode('.',$detail[$value->name.'_file']);
															if ($ext[1] == 'pdf') { ?>
																<div>
																	<object
																		data='<?=base_url('./data/standar_kepatuhan/'.$detail[$value->name.'_file'])?>'
																		type="application/pdf"
																		width="500"
																		height="500"
																	>

																		<iframe
																		src='<?=base_url('./data/standar_kepatuhan/'.$detail[$value->name.'_file'])?>'
																		width="500"
																		height="500"
																		>
																		<p>This browser does not support PDF!</p>
																		</iframe>

																	</object>
																	</div>
															<?php }else{ ?>
																<a href="<?=base_url('data/standar_kepatuhan/'.$detail[$value->name.'_file'])?>" target="_blank">
																	<img src="<?=base_url('data/standar_kepatuhan/'.$detail[$value->name.'_file'])?>" width="300" height="300" style="object-fit:cover;" alt="">
																</a>
															<?php }
															?>
														</div>
													</div>
												<?php }
											} ?>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">REVIEW
						</div>
						<div class="panel-body">
						<?php if ($detail['status_review'] == 'Sudah Direview') { ?>
							<table>
								<tbody>
									<tr>
										<td><b>Nilai Review</b> </td>
										<td>&nbsp;<span class="badge badge-success"><?=$detail['nilai_review']?></span></td>
									</tr>
									<?php if($detail['catatan_review'] != null){ ?>
									<tr>
										<td><b>Catatan</b></td>
										<td>&nbsp;<?=$detail['catatan_review']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							 
						<?php }else{ 
							if ($user_level == 'Administrator' or (in_array('standar_kepatuhan', $user_privileges) && $id_skpd == 1)) { ?>
								<form method="POST">
									<div class="form-group">
											<label for="">Nilai Review</label>
											<input type="text" name="nilai_review" class="form-control">
									</div>
									<div class="form-group">
											<label for="">Catatan Review (optional)</label>
											<textarea cols="10" rows="5" name="catatan_review" class="form-control"></textarea>
									</div>
									<button type="submit" name="review" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim Hasil Review</button>
								</form>
							<?php }else{
								echo 'Belum direview.';
							} ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

	</div>