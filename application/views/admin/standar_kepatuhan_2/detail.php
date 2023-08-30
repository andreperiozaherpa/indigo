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
									<table class="table table-borderless">
										<thead>
											<?php foreach($indikator as $v) { ?>
													<tr>
														<th style="vertical-align: middle;"><?=$v['variabel']?></th>
														<th>
															<?php
															$CI =& get_instance();
															$CI->load->model('standar_kepatuhan_2_model', 'skm');
															foreach($v['indikator'] as $value){
																$isi = $CI->skm->get_standar_kepatuhan_isi($detail['id_standar_kepatuhan'],$value['id_standar_kepatuhan_indikator']);
																?>
																<div class="form-group">
																	<!-- <label for="">Apakah tersedia <?=ucwords(str_replace("_"," ", $value['indikator']))?> ? <sup class="text-danger" title="wajib diisi">*</sup></label> -->
																	<div class="col-md-12">
																		<?php if (!empty($isi['foto'])) {
																			if (file_exists('./data/standar_kepatuhan/'.$isi['foto'])) { ?>
																			<div class="col-md-12">
																				<div class="form-group">
																					<h4 style="font: weight 800px;"><?=ucwords(str_replace("_"," ", $value['indikator']))?></h4>
																					<label>Data Pendukung <u><?=ucwords(str_replace("_"," ", $value['indikator']))?></u></label>
																					<?php 
																						$ext = explode('.',$isi['foto']);
																						if ($ext[1] == 'pdf') { ?>
																							<div>
																								<object
																									data='<?=base_url('./data/standar_kepatuhan/'.$isi['foto'])?>'
																									type="application/pdf"
																									width="50%"
																									height="500"
																								>

																									<iframe
																									src='<?=base_url('./data/standar_kepatuhan/'.$isi['foto'])?>'
																									width="50%"
																									height="500"
																									>
																									<p>This browser does not support PDF!</p>
																									</iframe>

																								</object>
																								</div>
																						<?php }else{ ?>
																							<br>
																							<a href="<?=base_url('data/standar_kepatuhan/'.$isi['foto'])?>" target="_blank">
																								<img src="<?=base_url('data/standar_kepatuhan/'.$isi['foto'])?>" width="50%" style="object-fit:cover;" alt="">
																							</a>
																						<?php }
																						?>
																				</div>
																			</div>
																			<?php }
																		} ?>
																		<?php if (!empty($isi['file'])) {
																			if (file_exists('./data/standar_kepatuhan/'.$isi['file'])) { ?>
																				<div class="col-md-12">
																					<div class="form-group">
																						<label>Ketersediaan Standar Pelayanan <u><?=ucwords(str_replace("_"," ", $value['indikator']))?></u> </label>
																						<?php 
																						$ext = explode('.',$isi['file']);
																						if ($ext[1] == 'pdf') { ?>
																							<div>
																								<object
																									data='<?=base_url('./data/standar_kepatuhan/'.$isi['file'])?>'
																									type="application/pdf"
																									width="50%"
																									height="500"
																								>

																									<iframe
																									src='<?=base_url('./data/standar_kepatuhan/'.$isi['file'])?>'
																									width="50%"
																									height="500"
																									>
																									<p>This browser does not support PDF!</p>
																									</iframe>

																								</object>
																								</div>
																						<?php }else{ ?>
																							<br>
																							<a href="<?=base_url('data/standar_kepatuhan/'.$isi['file'])?>" target="_blank">
																								<img src="<?=base_url('data/standar_kepatuhan/'.$isi['file'])?>" width="300" height="300" style="object-fit:cover;" alt="">
																							</a>
																						<?php }
																						?>
																					</div>
																				</div>
																			<?php }
																		} ?>
																		<?php if (empty($isi['foto']) && empty($isi['file'])) :?>
																			<h4 style="font: weight 800px;"><?=ucwords(str_replace("_"," ", $value['indikator']))?></h4>
																			<small>Tidak Tersedia</small>
																		<?php endif ?>
																	</div>
																</div>
																
															<?php } ?>
														</th>
													</tr>
											<?php } ?>
										</thead>
									</table>
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
						<?php if ($detail['status'] == 'Y') { ?>
							<table>
								<tbody>
									<tr>
										<td><b>Nilai Review</b> </td>
										<td>&nbsp;<span class="badge badge-success"><?=$detail['nilai']?></span></td>
									</tr>
									<?php if($detail['catatan'] != null){ ?>
									<tr>
										<td><b>Catatan</b></td>
										<td>&nbsp;<?=$detail['catatan']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							 
						<?php }else{ 
							if ($user_level == 'Administrator' or (in_array('standar_kepatuhan', $user_privileges) && $id_skpd == 1)) { ?>
								<form method="POST">
									<div class="form-group">
											<label for="">Nilai Review</label>
											<input type="text" name="nilai" class="form-control">
									</div>
									<div class="form-group">
											<label for="">Catatan Review (optional)</label>
											<textarea cols="10" rows="5" name="catatan" class="form-control"></textarea>
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