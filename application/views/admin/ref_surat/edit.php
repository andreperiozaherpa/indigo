<style type="text/css">
	.clear-all, .save-template{
		color: #fff !important;
	}
	.get-data{
		display: none !important;
	}
</style>
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
								<div class="col-md-4">
									<div class="panel panel-primary">
										<div class="panel-heading">Edit Surat</div>
										<div class="panel-body">
											<form method="POST">
												<div class="form-group">
													<label>Nama Surat</label>
													<input type="text" class="form-control" name="nama_surat" placeholder="Masukkan Nama Surat" value="<?=$detail->nama_surat?>">
												</div>
												<div class="form-group">
													<label>Jenis Surat</label>
													<div class="row">
														<div class="col-md-4">
															<div class="radio radio-primary">
																<input type="radio" name="jenis_surat" id="radio1" value="umum" <?=$detail->jenis_surat=='umum' ? 'checked' : ''?>>
																<label for="radio1"> Umum </label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="radio radio-primary">
																<input type="radio" name="jenis_surat" id="radio1" value="internal" <?=$detail->jenis_surat=='internal' ? 'checked' : ''?>>
																<label for="radio1"> Internal </label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="radio radio-primary">
																<input type="radio" name="jenis_surat" id="radio1" value="eksternal"<?=$detail->jenis_surat=='eksternal' ? 'checked' : ''?>>
																<label for="radio1"> Eksternal </label>
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Template </label><a href="<?=base_url('data/template_surat/template_surat_kosong.docx')?>" style="color: #fff;margin-bottom:5px" class="btn btn-warning btn-xs btn-rounded pull-right">Download Draft</a>
													<input type="file" data-default-file="<?=base_url('data/template_surat/'.$detail->template_file.'')?>" name="template_file" id="input-file-now" class="dropify" />
												</div>
												<div class="form-group">
													<label>Template Desa/Kelurahan</label>
													<input type="file" data-default-file="<?=base_url('data/template_surat/'.$detail->template_file_kel.'')?>" name="template_file_kel" id="input-file-now" class="dropify" />
												</div>
												<div class="form-group">
													<label>Template Puskesmas</label>
													<input type="file" data-default-file="<?=base_url('data/template_surat/'.$detail->template_file_pus.'')?>" name="template_file_pus" id="input-file-now" class="dropify" />
												</div>
												<div class="form-group">
													<label>Template UPTD</label>
													<input type="file" data-default-file="<?=base_url('data/template_surat/'.$detail->template_file_uptd.'')?>" name="template_file_uptd" id="input-file-now" class="dropify" />
												</div>
												<div class="form-group">
													<label>Template Bupati</label>
													<input type="checkbox" onchange="toggleKopSurat()" id="tKopSurat" class="js-switch" data-color="#6003C8" data-size="small" <?=empty($detail->template_file_bupati) ? "" : "checked"?>/>
													<div style="display: <?=empty($detail->template_file_bupati) ? "none" : "block"?>;" id="dKopSurat" class="form-group">
														<a href="<?=base_url('data/template_surat/template_surat_kosong.docx')?>" style="color: #fff;margin-bottom:5px" class="btn btn-warning btn-xs btn-rounded pull-right">Download Draft</a>
														<input type="file" <?=empty($detail->template_file_bupati) ? "" : 'data-default-file="'.base_url('data/template_surat/')."/".$detail->template_file_bupati.'"'?> name="template_file_bupati" id="input-file-now" class="dropify" />
													</div>
												</div>
												<div class="form-group">
													<label>Template DPRD</label>
													<input type="file" data-default-file="<?=base_url('data/template_surat/'.$detail->template_file_dprd.'')?>" name="template_file_dprd" id="input-file-now" class="dropify" />
												</div>
											</div>
										</div>

										<div class="panel panel-primary">
											<div class="panel-heading">Informasi String Default</div>
											<div class="panel-body">
												<div class="table-responsive">
													<table class="table table-striped">
														<thead>
															<tr>
																<th>No.</th>
																<th>Nama Kolom</th>
																<th>Nama Variabel</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>1</td>
																<td>Nama SKPD</td>
																<td>${nama_skpd}</td>
															</tr>
															<tr>
																<td>2</td>
																<td>Alamat SKPD</td>
																<td>${alamat}</td>
															</tr>
															<tr>
																<td>3</td>
																<td>Nomor Telepon SKPD</td>
																<td>${no_telp}</td>
															</tr>
															<tr>
																<td>4</td>
																<td>Website SKPD</td>
																<td>${website}</td>
															</tr>
															<tr>
																<td>5</td>
																<td>Email SKPD</td>
																<td>${email}</td>
															</tr>
															<tr>
																<td>6</td>
																<td>Kode Pos SKPD</td>
																<td>${kode_pos}</td>
															</tr>
															<tr>
																<td>7</td>
																<td>Nomor Surat</td>
																<td>${nomer_surat}</td>
															</tr>
															<tr>
																<td>8</td>
																<td>Perihal Surat</td>
																<td>${perihal}</td>
															</tr>
															<tr>
																<td>9</td>
																<td>Lampiran Surat</td>
																<td>${lampiran}</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-8">	
										<div class="panel panel-primary">
											<div class="panel-heading">
												Formulir
											</div>
											<div class="panel-body">

												<div id="form-builder"></div>
												<textarea rows="20" class="form-control" name="json_form" id="data" style="display: none"></textarea>
											</div>
										</div>  



										<button type='submit' class='btn btn-primary pull-right' style="margin-left: 6px;">Submit</button> 
										<a href='<?= base_url();?>ref_surat' class='btn btn-default pull-right'>Back</a>

									</form>

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			
			<script type="text/javascript">
				function toggleKopSurat(){
					var tKopSurat = $('#tKopSurat').prop('checked');
					if(tKopSurat==true){
						$('#dKopSurat').show();
					}else{
						$('#dKopSurat').hide();
					}
				}
			</script>