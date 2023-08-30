
<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Iklan Layanan</h4>
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
								<strong>Edit</strong>
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
													<input type="text" class="form-control" name='nama_iklan' value="<?= set_value('nama_iklan') ? set_value('nama_iklan') : $nama_iklan ?>" placeholder="">
												</div>
											</div>
											
										

											<div class="form-group">
												<label class="col-sm-2 control-label">Deskripsi</label>
												<div class="col-sm-5">
													<textarea class="form-control" rows="4" name="deskripsi" id="deskripsi"><?= set_value('deskripsi') ? set_value('deskripsi') : $deskripsi ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Chanel</label>
												<div class="col-sm-5">
													<select name="chanel" class="form-control" id="">
														<option value="Semua"<?php echo set_select('chanel', 'Semua', False); ?> <?= ($chanel == 'Semua') ? 'selected' : null;?>>Semua</option>
														<option value="Pendidikan"<?php echo set_select('chanel', 'Pendidikan', False); ?> <?= ($chanel == 'Pendidikan') ? 'selected' : null ?>>Pendidikan</option>
														<option value="Layanan"<?php echo set_select('chanel', 'Layanan'); ?> <?= ($chanel == 'Layanan') ? 'selected' : null ?>>Layanan</option>
														<option value="Kesehatan"<?php echo set_select('chanel', 'Kesehatan', False); ?> <?= ($chanel == 'Kesehatan') ? 'selected' : null ?>>Kesehatan</option>
														<option value="Destinasi"<?php echo set_select('chanel', 'Destinasi', False); ?> <?= ($chanel == 'Destinasi') ? 'selected' : null ?>>Destinasi</option>
														<option value="Pajak"<?php echo set_select('chanel', 'Pajak'); ?> <?= ($chanel == 'Pajak') ? 'selected' : null ?>>Pajak</option>
														<option value="Ketenaga Kerjaan"<?php echo set_select('chanel', 'Ketenaga Kerjaan', False); ?> <?= ($chanel == 'Ketenaga Kerjaan') ? 'selected' : null ?>>Ketenaga Kerjaan</option>
													</select>
												</div>
											</div>
											
											
											<div class="form-group">
												<label class="col-sm-2 control-label">Status</label>
												
												<div class="col-sm-2">
													
													<select name="status" class="form-control selectboxit" data-first-option="false">
														<option>Pilih</option>
														<option value="Y"<?= ($status == 'Y') ? 'selected' : null ?>>Aktif</option>
														<option value="N"<?= ($status == 'N') ? 'selected' : null ?>>Nonaktif</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Gambar</label>
												
												<div class="col-sm-5">
													
													<input type="file" name='userfile' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" data-default-file="<?=base_url('data/images/iklan_layanan/'.$gambar)?>" />
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
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->