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
																<input type="text" name="indeks" class="form-control" placeholder="Masukkan Indeks" value="<?=$detail->indeks?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Kode</label>
																<input type="text" name="kode" class="form-control" placeholder="Masukkan Kode" value="<?=$detail->kode?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">No Urut</label>
																<input type="text" name="no_urut" class="form-control" placeholder="Masukkan No Urut" value="<?=$detail->no_urut?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Perihal</label>
																<input type="text" name="perihal" class="form-control" placeholder="Masukkan Perihal" value="<?=$detail->perihal?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Pengirim</label>
																<input type="text" name="pengirim" class="form-control" placeholder="Masukkan pengirim" value="<?=$detail->pengirim?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
															<div class="form-group">
																<label class="">Tgl. Surat</label>
																<input type="text" name="tanggal_surat"  class="form-control mydatepicker" placeholder="Tanggal Surat" value="<?=$detail->tanggal_surat?>">
															</div>
														</div>
														<div class="col-md-8">
															<div class="form-group">
																<label class="">No. Surat</label>
																<input type="text" name="nomer_surat" class="form-control" placeholder="Masukan No Surat" value="<?=$detail->nomer_surat?>">
															</div>
														</div>
													</div>
												</div>

												
												<div class="row">
													<div class="col-md-12">
														<label class="col-md-12">Sifat Surat</label>
														<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio1" value="segera" <?php if ($detail->sifat == 'segera') echo 'checked="checked"'; ?>" >
															<label for="radio1"> Segera </label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio2" value="sangat_segera"  <?php if ($detail->sifat == 'sangat_segera') echo 'checked="checked"'; ?>" >
															<label for="radio2"> Sangat Segera </label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="radio radio-primary">
															<input type="radio" name="sifat" id="radio3" value="rahasia"  <?php if ($detail->sifat == 'rahasia') echo 'checked="checked"'; ?>" >
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
																<input type="text" name="lokasi_smpl" class="form-control" placeholder="Masukkan" value="<?=$detail->lokasi_smpl?>" >
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Lokasi BOX</label>
																<input type="text" name="lokasi_box" class="form-control" placeholder="Masukkan" value="<?=$detail->lokasi_box?>">
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label for="">Lokasi Rak</label>
																<input type="text" name="lokasi_rak" class="form-control" placeholder="Masukkan" value="<?=$detail->lokasi_rak?>">
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
														<div class="form-group">
														<label>Scan Surat</label>

														  <iframe src="https://docs.google.com/viewer?url=<?=base_url()?>/data/surat_eksternal/surat_masuk/<?=$detail->file_surat?>
												            &embedded=true" width="620"
												            height="700"
												            style="border: none;"></iframe>
													</div>
												</div>

												<div class="col-md-12">
															<div class="form-group">
																<label class="">Scan Surat</label>
																<input type="file" name="file_surat" id="input-file-now" class="dropify" />
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
																<label class="">SKPD Penerima</label>
																<select name="id_skpd_penerima" class="form-control select2" onchange="getUnitkerja()" id="id_skpd">
																     <?php
												                        foreach($skpd as $row){
												                          $selected = $row->id_skpd == $detail->id_skpd_penerima ? "selected" : "";
												                          echo "<option value='$row->id_skpd' $selected>$row->nama_skpd</option>";
												                        }
												                        
												                      ?>

																</select>
															</div>
														</div>
													</div>



													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Unit Kerja Penerima</label>
																<select name="id_unitkerja_penerima" onchange="getPegawai()" id="id_unit_kerja" class="form-control select2">
											                    <option value="">Pilih Unitkerja</option>
											                </select>
															</div>
														</div>
													</div>





													<div class="col-md-12">
														<div class="col-md-12">
															<div class="form-group">
																<label class="">Pegawai Penerima</label>
																 <select id="id_pegawai" name="id_pegawai_penerima" class="form-control select2">
														                <option value="">Pilih Pegawai</option>
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
																<input type="text" name="isi_ringkasan" class="form-control" placeholder="Masukkan " value="<?=$detail->isi_ringkasan?>">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														 Lampiran
													        <br>
													        <div class="col-md-2">
													          <div class="panel panel-default text-center">
													            <br>
													            <i class="fa fa-file-text" style="font-size:60px;" ></i>
													            <br>
													            <a href="<?=base_url()?>/data/surat_eksternal/lampiran/<?=$detail->lampiran?>" class="btn btn-primary btn-block">Download</a>
													          </div>
													        </div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">


														<div class="col-md-12">
															<div class="form-group">
																<label class="">Upload Lampiran Baru</label>
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
																<textarea class="form-control" name="catatan"><?=$detail->catatan?></textarea>
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


				</script>
