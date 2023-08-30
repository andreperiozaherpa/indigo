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
					<form method='post' enctype="multipart/form-data" method='post' >
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
															<input type="text" name="indeks" class="form-control" placeholder="Masukkan Indeks">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="">Kode</label>
															<input type="text" name="kode" class="form-control" placeholder="Masukkan Kode">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="">No Urut</label>
															<input type="text" value="<?=$urutan?>" name="no_urut" class="form-control" placeholder="Masukkan No Urut">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Perihal</label>
															<input type="text" name="perihal" class="form-control" placeholder="Masukkan Perihal">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Pengirim</label>
															<input type="text" name="pengirim" class="form-control" placeholder="Masukkan Program">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-4">
														<div class="form-group">
															<label class="">Tgl. Surat</label>
															<input type="text" name="tanggal_surat"  class="form-control mydatepicker" placeholder="Tanggal Surat">
														</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label class="">No. Surat</label>
															<input type="text" name="nomer_surat" class="form-control" placeholder="Masukkan No. Surat">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label class="col-md-12">Sifat Surat</label>
													<div class="col-md-3">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio1" value="biasa">
															<label for="radio1"> Biasa </label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio1" value="segera">
															<label for="radio1"> Segera </label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio2" value="sangat_segera">
															<label for="radio2"> Sangat Segera </label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio3" value="rahasia">
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
													<div class="col-md-12">
														<label>Pengarsipan Surat</label>
														<input type="checkbox" onchange="toggleArsip()" id="arsip_surat" class="js-switch" data-color="#6003C8" />
													</div>
													<div id="arsip" style="display: none">
														<div class="col-md-12">
														<hr></div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="">Lokasi Sampul </label>
															<input type="text" name="lokasi_smpl" class="form-control" placeholder="Masukkan Lokasi Sampul">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="">Lokasi BOX</label>
															<input type="text" name="lokasi_box" class="form-control" placeholder="Masukkan Lokasi BOX">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="">Lokasi Rak</label>
															<input type="text" name="lokasi_rak" class="form-control" placeholder="Masukkan Lokasi Rak">
														</div>
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

												<input type="hidden" name="id_skpd_penerima" value="<?=$this->session->userdata('id_skpd')?>">



												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Penerima Surat</label>
															<select id="id_pegawai" name="id_pegawai_penerima[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Pilih Penerima Surat" required>
																<?php foreach ($uk_bupati as $u): ?>
																	<optgroup label="<?=$u->nama_unit_kerja?>">
																		<?php foreach ($bupati[$u->id_unit_kerja] as $p): ?>
																			<option value="<?=$p->id_pegawai?>"><?=$p->nama_lengkap?> - <?=$p->nama_jabatan?></option>
																		<?php endforeach ?>
																	</optgroup>
																<?php endforeach ?>
																<?php foreach ($unit_kerja as $u): ?>
																	<optgroup label="<?=$u->nama_unit_kerja?>">
																		<?php foreach ($pegawai[$u->id_unit_kerja] as $p): ?>
																			<option value="<?=$p->id_pegawai?>"><?=$p->nama_lengkap?> - <?=$p->nama_jabatan?></option>
																		<?php endforeach ?>
																	</optgroup>
																<?php endforeach ?>
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
															<input type="text" name="isi_ringkasan" class="form-control" placeholder="Masukkan Program">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Scan Surat</label>
															<input type="file" name="file_surat" id="input-file-now" class="dropify" />
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Lampiran</label>
															<input type="file" name="lampiran" id="input-file-now" class="dropify" />
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="col-md-12">
														<div class="form-group">
															<label class="">Catatan</label>
															<textarea placeholder="Masukkan Catatan Surat" class="form-control" name="catatan"></textarea>
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
										<button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<script type="text/javascript">
					
					function getUnitkerja(){
						var id_skpd = $('#id_skpd').val();
						$.post('<?=base_url()?>surat_eksternal/get_unit_kerja', {id_skpd:id_skpd}, function(data){ 
							$('#id_unit_kerja').html(data); 
							$("#id_unit_kerja").select2("destroy");
							$("#id_unit_kerja").select2();
						});
				      //alert(id_skpd)
				  }
				  function getPegawai(){
				  	var id_unit_kerja = $('#id_unit_kerja').val();
				  	$.post('<?=base_url()?>surat_eksternal/get_pegawai', {id_unit_kerja:id_unit_kerja}, function(data){ 
				  		$('#id_pegawai').html(data); 
				  		$("#id_pegawai").select2("destroy");
				  		$("#id_pegawai").select2();
				  	});
				  }

				  function toggleArsip(){
				  	var s = $('#arsip_surat').prop('checked');
				  	if(s==true){
				  		$('#arsip').show();
				  	}else{
				  		$('#arsip').hide();
				  	}
				  }


				</script>
