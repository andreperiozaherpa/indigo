
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard Operator</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<!-- <ol class="breadcrumb">
					<li class="active">Surat Disposisi</li>
				</ol> -->
			</div>
			<!-- /.col-lg-12 -->
		</div>

<div class="row">

				<div class="col-md-12">
					<?php if ($this->session->userdata('msg') == true): ?>
						<?=$this->session->userdata('msg');?>
					<?php endif; ?>
				</div>
			</div>
		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="white-box">
					<div class="user-bg"> <img width="110%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
						<div class="overlay-box">
							<div class="user-content"  style="margin-top:-5px">
								<a href="javascript:void(0)"><img src="<?php echo base_url();?>/data/logo/skpd/sumedang.png" width="200px" alt="img"></a>
							</div>
						</div>
					</div>
					<div class="user-btm-box">
						<div class="row">
							<div class="col-md-12 b-b text-center">
								<h6><b>SKPD</b></h6>
								<h6><?=$skpd->nama_skpd?></h6>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-md-6 b-r">
								<div class="col-md-12 text-center">
									<h6><b>Telepon</b></h6>
									<h6>
										<?=$skpd->telepon_skpd?>
									</h6>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<h6><b>Email</b></h6>
								<h6>
									<?=$skpd->email_skpd?>
								</h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 b-b text-center">
								<h6><b>Alamat</b></h6>
								<h6>
									<?=$skpd->alamat_skpd?>, Kode Pos <?=$skpd->kode_pos?>
								</h6>
							</div>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url();?>ref_skpd/view/<?=$this->session->userdata('id_skpd')?>" class="btn btn-primary btn-block"><i data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> Kelola Data SKPD</a>
				<a href="javascript:void(0)" class="btn btn-primary btn-block" data-toggle="modal" data-target="#updateSettingModal"><i class="ti-settings"></i> Pengaturan Akun</a>
				<br>
				<div class="white-box" style="border-top:10px solid #6003C8">
					<div class="row">
						<p><i class="fa fa-link"></i> 
									<?=$skpd->website?></p>
					</div>
					<?php 
						if(!empty($skpd->facebook_skpd)){
					?>
					<div class="row">
						<p><i class="fa fa-facebook-square"></i><?=$skpd->facebook_skpd?></p>
					</div>
				<?php } ?>
					<?php 
						if(!empty($skpd->instagram_skpd)){
					?>
					<div class="row">
						<p><i class="fa fa-instagram"></i> <?=$skpd->instagram_skpd?></p>
					</div>
				<?php } ?>
					<?php 
						if(!empty($skpd->twitter_skpd)){
					?>
					<div class="row">
						<p><i class="fa fa-twitter-square"></i> <?=$skpd->twitter_skpd?></p>
					</div>
				<?php } ?>
				</div>
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="row">

                            <div class="col-lg-4 col-sm-12 ">
                                <div style="padding-bottom: 43px" class="white-box">
                                    <h3 class="box-title">JUMLAH PEGAWAI</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-people" style="color: #6003c8"></i></li>
                                        <li class="text-right"><span class="counter"><?=$jml_pegawai?></span></li>
                                    </ul>
                                </div>
                            </div>

							<div class="col-lg-4 col-sm-12">
								<div class="white-box">
									<div class="col-in row">
										<div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-check-box"></i>
											<h5 class="text-muted vb">Mempunyai Akun</h5> </div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<h3 class="counter text-right m-t-15" style="color: #6003c8"><?=$jml_r?></h3> </div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="progress">
														<div class="progress-bar"  role="progressbar" aria-valuenow="<?=($jml_r/$jml_pegawai) * 100?>" aria-valuemin="0" aria-valuemax="100" style="background-color: #6003c8; width: <?=($jml_r/$jml_pegawai) * 100?>%"> <span class="sr-only"><?=($jml_r/$jml_pegawai) * 100?>% Terdaftar</span> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-sm-12">
										<div class="white-box">
											<div class="col-in row">
												<div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-alert"></i>
													<h5 class="text-muted vb">Belum Register</h5> </div>
													<div class="col-md-6 col-sm-6 col-xs-6">
														<h3 class="counter text-right m-t-15" style="color: #6003c8"><?=$jml_nr?></h3> </div>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="progress">
																<div class="progress-bar"  role="progressbar" aria-valuenow="<?=($jml_nr/$jml_pegawai) * 100?>" aria-valuemin="0" aria-valuemax="100" style="background-color: #6003c8; width: <?=($jml_nr/$jml_pegawai) * 100?>%"> <span class="sr-only"><?=($jml_nr/$jml_pegawai) * 100?>% belum terdaftar</span> </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="white-box">
													<div class="row b-b">
														Log Aktivitas
													</div>
													<br>
													<div class="steamline">
														<div class="sl-item">
															<div class="sl-left"> <img class="img-circle" alt="user" src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg"> </div>
															<div class="sl-right">
																<div><a href="#">John Doe</a></div>
																<p>Menambah Agenda Baru</p>
																<span class="sl-date">22 April 2019</span>
															</div>
														</div>
														<div class="sl-item">
															<div class="sl-left"> <img class="img-circle" alt="user" src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg"> </div>
															<div class="sl-right">
																<div><a href="#">John Doe</a></div>
																<p>Menambah Agenda Baru</p>
																<span class="sl-date">22 April 2019</span>
															</div>
														</div>
														<div class="sl-item">
															<div class="sl-left"> <img class="img-circle" alt="user" src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg"> </div>
															<div class="sl-right">
																<div><a href="#">John Doe</a></div>
																<p>Menambah Agenda Baru</p>
																<span class="sl-date">22 April 2019</span>
															</div>
														</div>
														<div class="sl-item">
															<div class="sl-left"> <img class="img-circle" alt="user" src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg"> </div>
															<div class="sl-right">
																<div><a href="#">John Doe</a></div>
																<p>Menambah Agenda Baru</p>
																<span class="sl-date">22 April 2019</span>
															</div>
														</div>
														<div class="sl-item">
															<div class="sl-left"> <img class="img-circle" alt="user" src="<?php echo base_url('asset/pixel');?>/plugins/images/users/genu.jpg"> </div>
															<div class="sl-right">
																<div><a href="#">John Doe</a></div>
																<p>Menambah Agenda Baru</p>
																<span class="sl-date">22 April 2019</span>
															</div>
														</div>
														<hr>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>

								<!-- /.row -->


							<!--MODAL SETTING ACCOUNT-->
							<div class="modal fade" id="updateSettingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
								<div class="modal-dialog" role="document">
										<div class="modal-content">
												<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title">Ubah Password</h4>
												</div>
												<div class="modal-body">
													<?php echo validation_errors(); ?>
														<form  action="<?=base_url('dashboard_user/updatePassword/'.$id_user.'/operator')?>" method="post">
																<div class="form-group">
																		<label for="recipient-name" class="control-label">Password Lama</label>
																		<input type="password" class="form-control"  name="old_password" placeholder="masukan password lama anda">
																</div>
																<div class="form-group">
																		<label for="message-text" class="control-label">Password Baru</label>
																		<input type="password" class="form-control"  name="n_password" placeholder="masukan password baru anda">
																</div>
																<div class="form-group">
																		<label for="message-text" class="control-label">Konfirmasi Password Baru</label>
																		<input type="password" class="form-control"  name="cn_password" placeholder="konfirmasi password baru anda">
																</div>
												</div>
												<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
														<button type="submit" class="btn btn-primary" name="tombol_update">Update</button>
												</div>
											</form>
										</div>
								</div>
						</div>