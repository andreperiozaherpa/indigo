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
				if (!empty($message)){
					?>
					<div class="alert alert-<?= $type;?> alert-dismissible fade in" role="alert">
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
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-heading">Logo SKPD</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<input type="file" id="input-file-now" name="logo_skpd" class="dropify" />
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
									<div class="col-md-9">	
										<div class="panel panel-default">
											<div class="panel-heading">
												Detail SKPD
											</div>
											<div class="panel-body">
												<div class="row">

													<div class="col-md-12">
														<div class="form-group">
															<label>Nama SKPD</label>
															<input type="text" name="nama_skpd" class="form-control" placeholder="Masukkan Nama SKPD" required>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Nama Alias </label>
															<input type="text" name="nama_skpd_alias" class="form-control" placeholder="Masukkan Nama Alias SKPD">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Jenis SKPD</label>
															<select name="jenis_skpd" class="form-control select2" required>
																<option value="">Pilih Jenis SKPD</option>
																<?php 
																	foreach($jenis_skpd as $j){
																		$label = ($j=='skpd'||$j=='uptd'||$j=='bumd') ? strtoupper($j) : ucwords($j);
																		echo '<option value="'.$j.'">'.$label.'</option>';
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>SKPD Induk</label>
															<select name="id_skpd_induk" class="form-control select2">
																<option value="">Tidak Memiliki Induk</option>
																<?php 
																	foreach($skpd as $s){
																		echo '<option value="'.$s->id_skpd.'">'.$s->nama_skpd.'</option>';
																	}
																?>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Telepon</label>
															<input type="text" name="telepon_skpd" class="form-control" placeholder="Masukkan Telepon" required>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Fax</label>
															<input type="text" name="fax" class="form-control" placeholder="Masukkan Fax">
														</div>
													</div>


													<div class="col-md-12">
														<div class="form-group">
															<label>E-mail</label>
															<input type="text" name="email_skpd" class="form-control" placeholder="Masukkan E-mail" required>
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label>Website</label>
															<input type="text" name="website" class="form-control" placeholder="Masukkan Website">
														</div>
													</div>



													<div class="col-md-12">
														<div class="form-group">
															<label>Alamat</label>
															<textarea class="form-control" name="alamat_skpd"></textarea>
														</div>
													</div>


													<div class="col-md-12">
														<div class="form-group">
															<label>Kode Pos</label>
															<input type="text" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos">
														</div>
													</div>



												</div>
											</div>
										</div>  

								<div class="panel panel-default">
											<div class="panel-heading">
												Sosial Media
											</div>
											<div class="panel-body">
												<div class="row">
												
													<div class="col-md-12">
														<div class="form-group">
															<label>Instagram</label>
															<input type="text" name="instagram_skpd" class="form-control" placeholder="Masukkan Instagram">
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label>Twitter</label>
															<input type="text" name="twitter_skpd" class="form-control" placeholder="Masukkan Twitter">
														</div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
															<label>Facebook</label>
															<input type="text" name="facebook_skpd" class="form-control" placeholder="Masukkan Alamat Facebook">
														</div>
													</div>
												</div>
											</div>
											</div>



										<button type='submit' class='btn btn-primary pull-right' style="margin-left: 6px;">Submit</button> 
										<a href='<?= base_url();?>master_pegawai' class='btn btn-default pull-right'>Back</a>
										


									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<script>

					function hideMe()
					{$('#pesan').hide();}

					function getKabupaten(){
						var id = $('#id_provinsi').val();
						$('#id_desa').html('<option value="">Pilih</option>');
						$('#id_kecamatan').html('<option value="">Pilih</option>');
						$.post("<?= base_url();?>master_pegawai/get_kabupaten/"+id,{},function(obj){
							$('#id_kabupaten').html(obj);
						});

					}
					function getKecamatan(){
						$('#id_desa').html('<option value="">Pilih</option>');
						var id = $('#id_kabupaten').val();
						$.post("<?= base_url();?>master_pegawai/get_kecamatan/"+id,{},function(obj){
							$('#id_kecamatan').html(obj);
						});

					}
					function getDesa(){
						var id = $('#id_kecamatan').val();
						$.post("<?= base_url();?>master_pegawai/get_desa/"+id,{},function(obj){
							$('#id_desa').html(obj);
						});
					}

					function getLevelJabatan(){
						$("#level_jabatan").select2("val", "");
						$("#id_jabatan").select2("val", "");
						var id = $('#id_unit_kerja').val();
						$.post("<?= base_url();?>master_pegawai/get_level_jabatan/"+id,{},function(obj){
							$('#level_jabatan').html(obj);
							$("#level_jabatan").select2();
							$('#id_jabatan').html("");
							$("#id_jabatan").select2();
						});
					}

					function getJabatan(){
						$("#id_jabatan").select2("val", "");
						var id = $('#id_unit_kerja').val();
						var level = $('#level_jabatan').val();
						$.post("<?= base_url();?>master_pegawai/get_jabatan/"+id+"/"+level,{},function(obj){
							$('#id_jabatan').html(obj);
							$("#id_jabatan").select2();
						});
					}
				</script>