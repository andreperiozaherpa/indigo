<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
				$tipe = (empty($error))? "info" : "danger";
				if (!empty($message)){
					?>
					<div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<?= $message;?>
					</div>
					<?php }?>
					<div class="x_panel">
						<form method='post' enctype="multipart/form-data" >
							<div class="x_content">
								<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
									<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
									</button>
									<label id='status'></label>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="panel panel-default" style="border-top:10px solid #6003C8">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Indeks</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Indeks">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Kode</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Kode">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">No Urut</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan No Urut">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Perihal</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Perihal">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Pengirim</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Program">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
															<div class="form-group">
																<label class="">Tgl. Surat</label>
																<input type="text" class="form-control mydatepicker" placeholder="Tanggal Surat">
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label class="">No. Surat</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Program">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<label class="col-md-12">Sifat Surat</label>
														<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="radio" id="radio1" value="option2">
															<label for="radio1"> Segera </label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="radio" id="radio2" value="option2">
															<label for="radio2"> Sangat Segera </label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="radio" id="radio3" value="option2">
															<label for="radio3"> Rahasia </label>
														</div>
													</div>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default" style="border-top:10px solid #6003C8">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Lokasi SMPL </label>
																<input type="text" name="" class="form-control" placeholder="Masukkan">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Lokasi BOX</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Lokasi Rak</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="panel panel-default" style="border-top:10px solid #6003C8">
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Penerima</label>
																<select class="form-control select2">
																	<option>Select</option>
																	<optgroup label="Alaskan/Hawaiian Time Zone">
																		<option value="AK">Alaska</option>
																		<option value="HI">Hawaii</option>
																	</optgroup>
																	<optgroup label="Pacific Time Zone">
																		<option value="CA">California</option>
																		<option value="NV">Nevada</option>
																	</optgroup>
																	<optgroup label="Mountain Time Zone">
																		<option value="AZ">Arizona</option>
																		<option value="CO">Colorado</option>
																	</optgroup>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Isi Ringkasan</label>
																<input type="text" name="" class="form-control" placeholder="Masukkan Program">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Scan Surat</label>
																<input type="file" id="input-file-now" class="dropify" />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Lampiran</label>
																<input type="file" id="input-file-now" class="dropify" />
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Catatan</label>
																<textarea class="form-control"></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>
									<div class="col-md-12">
										<div class="pull-right">
											<a href="#" class="btn btn-default" style="min-width:150px;">Batal</a>
											<a href="#" class="btn btn-primary" style="min-width:150px;">Simpan</a>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
