<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Tambah Iklan Layanan</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>tahu/manage_media/iklan_layanan">Iklan Layanan</a>
							</li>
							<li class="active">		
								<strong>Tambah</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
						<div class="row">
							<div class="col-md-12">
								
								<div class="panel panel-primary" data-collapsed="0">
								
									
									<div class="panel-body">
										<?php if (!empty($message)) echo "
										<div class='alert alert-$message_type'>$message</div>";?>
										<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
										<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
											<div class="form-group">
												<label class="col-sm-2 control-label">Judul</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" name='nama_iklan' placeholder="">
												</div>
											</div>
											
										

											<div class="form-group">
												<label class="col-sm-2 control-label">Deskripsi</label>
												<div class="col-sm-5">
													<textarea class="form-control" rows="4" name="deskripsi" id="deskripsi"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Chanel</label>
												<div class="col-sm-5">
													<select name="chanel" class="form-control" id="">
														<option value="Semua">Semua</option>
														<option value="Pendidikan">Pendidikan</option>
														<option value="Layanan">Layanan</option>
														<option value="Kesehatan">Kesehatan</option>
														<option value="Destinasi">Destinasi</option>
														<option value="Pajak">Pajak</option>
														<option value="Ketenaga Kerjaan">Ketenaga Kerjaan</option>
													</select>
												</div>
											</div>
											
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Status</label>
												
												<div class="col-sm-2">
													
													<select name="status" class="form-control selectboxit" data-first-option="false">
														<option>Pilih</option>
														<option value="Y" selected>Aktif</option>
														<option value="N">Nonaktif</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Gambar</label>
												
												<div class="col-sm-5">
													
													<input type="file" name='userfile' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
													<p>
														Max : 2000px | 2MB
													</p>
												</div>
											</div>
											<div class="form-group">
												
												<div class="col-sm-7">
													<button type="submit" class="btn btn-primary waves-effect waves-light pull-right" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>

												</div>
												
											</div>
										</form>
									
									</div>

								</div>
							</div>
						</div>
                  </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->