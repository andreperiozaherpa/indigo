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
			<a style="margin-bottom: 10px" href="<?= base_url('inovasi_daerah') ?><?= isset($_GET['page']) ? '?page=' . $_GET['page'] : ''; ?>" class="btn btn-default pull-right"><i class="icon-arrow-left-circle"></i> Kembali</a><br><br>
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
						<div class="panel-heading">DETAIL PROPOSAL INOVASI
						</div>
						<div class="panel-body">
							<div class="row m-b">
								<div class="col-md-12">
									<div class="form-group">
										<label>SKPD</label>
										<span class="label label-primary"><?= $detail->nama_skpd ?></span> </p>
									</div>
									<div class="form-group">
										<label>Diinput pada tanggal</label>
										<p style="line-height: 0"><?=date('d, M Y', strtotime($detail->created_at))?></b></p>
									</div>
									<div class="form-group">
										<label>Nama Inovasi</label>
										<p style="line-height: 0"><?=$detail->nama?></p>
									</div>
									<div class="form-group">
										<label>Tahapan Inovasi</label>
										<p style="line-height: 0">
										<?php
											if ($detail->tahapan == 'Penerapan') {
													$color = 'success';
												}elseif($detail->tahapan == 'Inisiatif'){
													$color = 'info';
												}else{
													$color = 'primary';
												}
											?>
											<span class="badge badge-<?=$color?> ">
												<?=$detail->tahapan?>
											</span>
										</p>
									</div>
									<div class="form-group">
										<label>Inisiator Inovasi Daerah</label>
										<p style="line-height: 0"><?=$detail->inisiator?></p>
									</div>
									<div class="form-group">
										<label>Jenis Inovasi Daerah</label>
										<p style="line-height: 0"><?=$detail->jenis?></p>
									</div>
									<div class="form-group">
										<label>Bentuk Inovasi Daerah</label>
										<p style="line-height: 0"><?=$detail->bentuk?></p>
									</div>
									<div class="form-group">
										<label>Urusan Inovasi Daerah</label>
										<p style="line-height: 0"><?=$detail->urusan?></p>
									</div>
									<div class="form-group">
										<label>Waktu Uji Coba Inovasi Daerah</label>
										<p style="line-height: 0"><?=date('d, M Y', strtotime($detail->waktu_ujicoba))?></p>
									</div>
									<div class="form-group">
										<label>Waktu Implementasi Inovasi Daerah</label>
										<p style="line-height: 0"><?=date('d, M Y', strtotime($detail->waktu_implementasi))?></p>
									</div>
									<div class="form-group">
										<label>Rancang Bangun</label>
										<p><?=$detail->rancang_bangun?></p>
									</div>
									<div class="form-group">
										<label>Tujuan</label>
										<p><?=$detail->tujuan?></p>
									</div>
									<div class="form-group">
										<label>Manfaat</label>
										<p><?=$detail->manfaat?></p>
									</div>
									<div class="form-group">
										<label>Hasil</label>
										<p><?=$detail->hasil?></p>
									</div>
									<?php if (!empty($detail->anggaran_file)) {
										if (file_exists('./data/inovasi_daerah/'.$detail->anggaran_file)) { ?>
											<div class="form-group">
												<label>Jumlah Jenis Pelayanan File Pendukung(berdasarkan SK Standar Pelayanan)</label>
												<br>
												<?php 
												$ext = explode('.',$detail->anggaran_file);
												if ($ext[1] == 'pdf') { ?>
													<div>
														<object
															data='<?=base_url('./data/inovasi_daerah/'.$detail->anggaran_file)?>'
															type="application/pdf"
															width="500"
															height="500"
														>

															<iframe
															src='<?=base_url('./data/inovasi_daerah/'.$detail->anggaran_file)?>'
															width="500"
															height="500"
															>
															<p>This browser does not support PDF!</p>
															</iframe>

														</object>
														</div>
												<?php }else{ ?>
													<a href="<?=base_url('data/inovasi_daerah/'.$detail->anggaran_file)?>" target="_blank">
														<img src="<?=base_url('data/inovasi_daerah/'.$detail->anggaran_file)?>" width="300" height="300" style="object-fit:cover;" alt="">
													</a>
												<?php }
												?>
											</div>
										<?php }
									} ?>
									<?php if (!empty($detail->profile_file)) {
										if (file_exists('./data/inovasi_daerah/'.$detail->profile_file)) { ?>
											<div class="form-group">
												<label>Jumlah Jenis Pelayanan File Pendukung(berdasarkan SK Standar Pelayanan)</label>
												<br>
												<?php 
												$ext = explode('.',$detail->profile_file);
												if ($ext[1] == 'pdf') { ?>
													<div>
														<object
															data='<?=base_url('./data/inovasi_daerah/'.$detail->profile_file)?>'
															type="application/pdf"
															width="500"
															height="500"
														>

															<iframe
															src='<?=base_url('./data/inovasi_daerah/'.$detail->profile_file)?>'
															width="500"
															height="500"
															>
															<p>This browser does not support PDF!</p>
															</iframe>

														</object>
														</div>
												<?php }else{ ?>
													<a href="<?=base_url('data/inovasi_daerah/'.$detail->profile_file)?>" target="_blank">
														<img src="<?=base_url('data/inovasi_daerah/'.$detail->profile_file)?>" width="300" height="300" style="object-fit:cover;" alt="">
													</a>
												<?php }
												?>
											</div>
										<?php }
									} ?>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th><h4><b>SKOR :</b> </h4> </th>
										<th class="text-right" id="totalSkor"><h4><b><?=$total_skor->total?></b> </h4> (Lihat rincian skor <a target="_blank" href="<?=base_url('inovasi_daerah/indikator/'.$detail->id_inovasi_daerah)?>">disini</a> )</th>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>