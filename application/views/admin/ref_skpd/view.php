<style type="text/css">
	.nav-tabs>li {
		width: 33.33333%;
		text-align: center;
		text-transform: uppercase;
	}

	.customtab li.active a,
	.customtab li.active a:focus,
	.customtab li.active a:hover {
		border-bottom: 2px solid #6003C8;
		color: #6003C8;
	}

	.nav-tabs>li>a {
		border-radius: 0px;
	}
</style>
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
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
			if (!empty($message)) {
			?>
				<div class="alert alert-<?= $type; ?> alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<?= $message; ?>
				</div>
			<?php } ?>
			<div class="x_panel">
				<div class="x_content">
					<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
						<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<label id='status'></label>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="panel panel-primary">
								<div class="panel-heading">Logo SKPD</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group" style="text-align:center">
												<center>
													<img src="<?= base_url() ?>data/logo/skpd/<?= ($detail->logo_skpd == '') ? 'sumedang.png' : $detail->logo_skpd  ?>" alt="user" class="img-responsive" style="width: 200px;">
												</center>
											</div>
										</div>
									</div>
									<a href="" class="fcbtn btn btn-outline btn-primary btn-block" style="margin-left: 7px;" data-toggle="modal" data-target="#editSKPD"><i class="ti-pencil"></i>Edit SKPD</a>
									<a href="" class="fcbtn btn btn-outline btn-primary btn-block" style="margin-left: 7px;" data-toggle="modal" data-target="#hapusSKPD"><i class="ti-trash"></i>Hapus SKPD</a>
								</div>
								<div id="editSKPD" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="panel-heading">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Edit SKPD</h4>
											</div>
											<div class="modal-body">
												<form method="POST">
													<div class="form-group">
														<label for="exampleInputuname">Nama SKPD</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-user"></i></div>
															<input name="nama_skpd" value="<?= $detail->nama_skpd ?>" type="text" class="form-control" id="skpd" placeholder="Nama SKPD">
														</div>
													</div>
													<div class="form-group">
														<label for="exampleInputEmail1">Nama Alias</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-user"></i></div>
															<input name="nama_skpd_alias" value="<?= $detail->nama_skpd_alias ?>" type="text" class="form-control" id="alias" placeholder="Nama Alias">
														</div>
													</div>
													<div class="form-group">
														<label>Jenis SKPD</label>
														<select name="jenis_skpd" class="form-control select2" required>
															<option value="">Pilih Jenis SKPD</option>
															<?php
															foreach ($jenis_skpd as $j) {
																$label = ($j == 'skpd' || $j == 'uptd') ? strtoupper($j) : ucwords($j);
																$selected = $j == $detail->jenis_skpd ? ' selected' : '';
																echo '<option value="' . $j . '"' . $selected . '>' . $label . '</option>';
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label>SKPD Induk</label>
														<select name="id_skpd_induk" class="form-control select2">
															<option value="">Tidak Memiliki Induk</option>
															<?php
															foreach ($skpd as $s) {
																$selected = $s->id_skpd == $detail->id_skpd_induk ? ' selected' : '';
																echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
															}
															?>
														</select>
													</div>

													<div class="form-group">
														<label for="exampleInputpwd1">Telepon</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-mobile"></i></div>
															<input name="telepon_skpd" value="<?= $detail->telepon_skpd ?>" type="text" class="form-control" id="telepon" placeholder="Telepon">
														</div>
													</div>

													<div class="form-group">
														<label for="exampleInputpwd1">Fax</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-mobile"></i></div>
															<input name="fax" value="<?= $detail->fax ?>" type="text" class="form-control" id="telepon" placeholder="Fax">
														</div>
													</div>


													<div class="form-group">
														<label for="exampleInputpwd2">Email</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-email"></i></div>
															<input name="email_skpd" value="<?= $detail->email_skpd ?>" type="email" class="form-control" placeholder="Email">
														</div>
													</div>

													<div class="form-group">
														<label for="exampleInputpwd2">Website</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-email"></i></div>
															<input name="website" value="<?= $detail->website ?>" type="text" class="form-control" placeholder="Website">
														</div>
													</div>


													<div class="form-group">
														<label for="exampleInputpwd2">Alamat</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-home"></i></div>
															<input name="alamat_skpd" value="<?= $detail->alamat_skpd ?>" type="textarea" class="form-control" id="alamat" placeholder="Alamat">
														</div>
													</div>

													<div class="form-group">
														<label for="exampleInputpwd2">Kode Pos</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-email"></i></div>
															<input name="kode_pos" value="<?= $detail->kode_pos ?>" type="text" class="form-control" id="email" placeholder="Kode Pos">
														</div>
													</div>

													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputpwd2">Latitude</label>
																<input name="latitude" value="<?= $detail->latitude ?>" type="text" class="form-control" id="latitude" placeholder="Latitude">
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputpwd2">Longitude</label>
																<input name="longitude" value="<?= $detail->longitude ?>" type="text" class="form-control" id="longitude" placeholder="Longitude">
															</div>
														</div>

														<div class="col-md-12">
															<div id="googleMapEdit" class="gmaps"></div>
														</div>
													</div>


													<hr>
													<div class="form-group">
														<label for="exampleInputpwd2">Instagram</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-instagram"></i></div>
															<input name="instagram_skpd" value="<?= $detail->instagram_skpd ?>" type="text" class="form-control" id="instagram" placeholder="Instagram">
														</div>
													</div>
													<div class="form-group">
														<label for="exampleInputpwd2">Twitter</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-twitter-alt"></i></div>
															<input name="twitter_skpd" value="<?= $detail->twitter_skpd ?>" type="text" class="form-control" id="twitter" placeholder="Twitter">
														</div>
													</div>
													<div class="form-group">
														<label for="exampleInputpwd2">Facebook</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-facebook"></i></div>
															<input name="facebook_skpd" value="<?= $detail->facebook_skpd ?>" type="text" class="form-control" id="facebook" placeholder="Facebook">
														</div>
													</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
											</div>
											</form>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
								<div id="hapusSKPD" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="panel-heading">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus SKPD</h4>
											</div>
											<div class="modal-body">
												Apakah anda yakin akan menghapus SKPD ini dan seluruh Unit Kerjanya?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
												<a style="color: #fff !important" href="<?= base_url('ref_skpd/delete/' . $detail->id_skpd . '') ?>" class="btn btn-primary waves-effect text-left">Ya</a>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
							</div>
							<br>
							<br>
							<div class="panel panel-primary">
								<div class="panel-heading">
									Detail SKPD
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama SKPD</label>
												<p><?= ucwords($detail->nama_skpd) ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Alias</label>
												<p><?= $detail->nama_skpd_alias ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jenis SKPD</label>
												<p><?= ucwords($detail->jenis_skpd) ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>SKPD Induk</label>
												<p><?= $detail->nama_skpd_induk ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Telepon</label>
												<p><?= $detail->telepon_skpd ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Fax</label>
												<p><?= $detail->fax ?></p>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>E-mail</label>
												<p><?= $detail->email_skpd ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Website</label>
												<p><?= $detail->website ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Alamat</label>
												<p><?= $detail->alamat_skpd ?></p>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Kode Pos</label>
												<p><?= $detail->kode_pos ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Latitude</label>
												<p><?= $detail->latitude ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Longitude</label>
												<p><?= $detail->longitude ?></p>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="panel panel-primary">
								<div class="panel-heading">
									Sosial Media
								</div>
								<div class="panel-body">
									<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Instagram</label>

												<p><?= $detail->instagram_skpd ?></p>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Twitter</label>

												<p><?= $detail->twitter_skpd ?></p>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Facebook</label>

												<p><?= $detail->facebook_skpd ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-9">
							<div class="white-box">
								<!-- Nav tabs -->
								<ul class="nav customtab nav-tabs" role="tablist">
									<li role="presentation" class="<?= ($active_tab == 'unit_kerja' ? 'active' : '') ?>">
										<a href="#tabUnitKerja" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-briefcase"></i></span><span class="hidden-xs"><i class="ti-briefcase"></i> Unit Kerja</span></a>
									</li>
									<li role="presentation" class="<?= ($active_tab == 'jabatan' ? 'active' : '') ?>">
										<a href="#tabJabatan" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-bar-chart"></i></span> <span class="hidden-xs"><i class="ti-bar-chart"></i> Jabatan</span></a>
									</li>
									<li role="presentation" class="<?= ($active_tab == 'sub_office' ? 'active' : '') ?>">
										<a href="#tabSubOffice" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-bar-chart"></i></span> <span class="hidden-xs"><i class="ti-layers-alt"></i> Sub Office</span></a>
									</li>
								</ul>
								<!-- Tab panes -->
							</div>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade <?= ($active_tab == 'unit_kerja' ? 'active in' : '') ?>" id="tabUnitKerja">
									<div style="margin-top: -50px;" class="white-box">
										<a href="javascript:void(0)" class="fcbtn btn btn-primary btn-block" onclick="tambahUnitKerja()">Tambah Unit Kerja </a>
									</div>
									<div id="hapusUnitKerja" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Unit Kerja</h4>
												</div>
												<div class="modal-body">
													Apakah anda yakin akan menghapus Unit Kerja ini dan semua Unit Kerja dibawahnya?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
													<a style="color: #fff !important" href="" id="btnDeleteUnitKerja" class="btn btn-primary waves-effect text-left">Ya</a>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<div id="tambahUnitKerja" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Tambah Unit Kerja</h4>
												</div>
												<div class="modal-body">
													<form id="formUnitKerja" method="POST">
														<div id="hidden"></div>
														<div class="form-group">
															<label for="exampleInputuname">Nama Unit Kerja</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="ti-user"></i></div>
																<input type="text" class="form-control" id="skpde" name="nama_unit_kerja" placeholder="Nama Unit Kerja">
															</div>
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">Level Unit Kerja</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="ti-pulse"></i></div>
																<select id="level_unit_kerja" onchange="toggleLevelUnitKerja()" name="level_unit_kerja" class="form-control">
																	<option value="">Pilih Level Unit Kerja</option>
																	<option value="1">I</option>
																	<option value="2">II</option>
																	<option value="3">III</option>
																	<option value="4">IV</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<input type="checkbox" class="js-switch" data-color="#13dafe" />
														</div>

														<div style="display: none" id="divUnitKerjaInduk" class="form-group">
															<label for="exampleInputEmail1">Unit Kerja Induk</label>
															<div class="input-group">
																<div class="input-group-addon"><i class="ti-server"></i></div>
																<select id="id_induk" name="id_induk" class="form-control">
																	<option value="0">Pilih Unit Kerja Induk</option>
																</select>
															</div>
														</div>
														<label for="exampleInputEmail1">Berkas-berkas</label>
														<div class="checkbox checkbox-circle">
															<input id="checkbox1" type="checkbox" name="b_renstra" value="1">
															<label for="checkbox1"> RENSTRA </label>
														</div>
														<div class="checkbox checkbox-circle">
															<input id="checkbox2" type="checkbox" name="b_rkt" value="1">
															<label for="checkbox2"> RKT </label>
														</div>
														<div class="checkbox checkbox-circle">
															<input id="checkbox3" type="checkbox" name="b_pk" value="1">
															<label for="checkbox3"> PK </label>
														</div>
														<div class="checkbox checkbox-circle">
															<input id="checkbox4" type="checkbox" name="b_lkj" value="1">
															<label for="checkbox4"> LKJ </label>
														</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
													</form>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>

									<div id="tree-view"></div>

									<?php
									if (empty($unit_kerja)) {
									?>
										<div class="alert alert-primary">
											<i class="ti-alert"></i> Belum ada Unit Kerja
										</div>
									<?php } else { ?>
										<div class="col-md-6">
											<ul type="vertical" id="tree-data" style="display:none">
												<?php
												if (count($unit_kerja) >= 1) {
												?>
													<li>
														<div class="panel panel-primary">
															<div class="panel-wrapper collapse in" aria-expanded="true">
																<div class="panel-body">
																	<div class="col-md-3 text-center b-r" style="min-height:50px;">
																		<center><img style="width: 80%" src="<?= base_url() ?>data/logo/skpd/<?= ($detail->logo_skpd == '') ? 'sumedang.png' : $detail->logo_skpd  ?>" alt="user" class="img-circle" /> </center>
																	</div>
																	<div class="col-md-9">
																		<br>
																		<p class="text-center"><strong><?= $detail->nama_skpd ?></strong></p>
																	</div>
																</div>
															</div>
														</div>
														<ul type="vertical">
														<?php } ?>
														<?php foreach ($unit_kerja as $u) { ?>
															<li>
																<div class="panel panel-primary">
																	<div class="panel-wrapper collapse in" aria-expanded="true">
																		<div class="pull-right">
																			<a href="javascript:void(0)" onclick="editUnitKerja(<?= $u->id_unit_kerja ?>)" class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"><i class="ti-pencil" style="color:white;"></i></a>
																			<a href="javascript:void(0)" onclick="hapusUnitKerja(<?= $u->id_unit_kerja ?>)" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="ti-trash" style="color:white;"></i></a>
																		</div>
																		<div class="panel-body">
																			<div class="col-md-3 text-center b-r" style="min-height:50px;">
																				<center><img style="width: 80%" src="<?php echo base_url() . "data/logo/bnpt.png"; ?>" alt="user" class="img-circle" /> </center>
																			</div>
																			<div class="col-md-9">
																				<br>
																				<p class="text-center"><strong><?= $u->nama_unit_kerja ?></strong></p>
																			</div>
																		</div>
																	</div>
																</div>
																<?php
																$unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd, $u->id_unit_kerja);
																?>
																<?php if (count($unit_kerja_2) !== 0) { ?>
																	<ul type="vertical">
																		<?php
																		foreach ($unit_kerja_2 as $u2) {
																		?>
																			<li>
																				<div class="panel panel-primary">
																					<div class="panel-wrapper collapse in" aria-expanded="true">
																						<div class="pull-right">
																							<a href="javascript:void(0)" onclick="editUnitKerja(<?= $u2->id_unit_kerja ?>)" class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"><i class="ti-pencil" style="color:white;"></i></a>
																							<a href="javascript:void(0)" onclick="hapusUnitKerja(<?= $u2->id_unit_kerja ?>)" class=" btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="ti-trash" style="color:white;"></i></a>
																						</div>
																						<div class="panel-body">
																							<div class="col-md-3 text-center b-r" style="min-height:50px;">
																								<center><img style="width: 80%" src="<?php echo base_url() . "data/logo/bnpt.png"; ?>" alt="user" class="img-circle" /> </center>
																							</div>
																							<div class="col-md-9">
																								<br>
																								<p class="text-center"><strong><?= $u2->nama_unit_kerja ?></strong></p>
																							</div>
																						</div>
																					</div>
																				</div>
																				<?php
																				$unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd, $u2->id_unit_kerja);
																				?>
																				<?php if (count($unit_kerja_3) !== 0) { ?>
																					<ul type="vertical">
																						<?php
																						foreach ($unit_kerja_3 as $u3) {
																						?>
																							<li>
																								<div class="panel panel-primary">
																									<div class="panel-wrapper collapse in" aria-expanded="true">
																										<div class="pull-right">
																											<a href="javascript:void(0)" onclick="editUnitKerja(<?= $u3->id_unit_kerja ?>)" class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"><i class="ti-pencil" style="color:white;"></i></a>
																											<a href="javascript:void(0)" onclick="hapusUnitKerja(<?= $u3->id_unit_kerja ?>)" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="ti-trash" style="color:white;"></i></a>
																										</div>
																										<div class="panel-body">
																											<div class="col-md-3 text-center b-r" style="min-height:50px;">
																												<center><img style="width: 80%" src="<?php echo base_url() . "data/logo/bnpt.png"; ?>" alt="user" class="img-circle" /> </center>
																											</div>
																											<div class="col-md-9">
																												<br>
																												<p class="text-center"><strong><?= $u3->nama_unit_kerja ?></strong></p>
																											</div>
																										</div>
																									</div>
																								</div>
																								<?php
																								$unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd, $u3->id_unit_kerja);
																								?>
																								<?php if (count($unit_kerja_4) !== 0) { ?>
																									<ul type="vertical">
																										<?php
																										foreach ($unit_kerja_4 as $u4) {
																										?>
																											<li>
																												<div class="panel panel-primary">
																													<div class="panel-wrapper collapse in" aria-expanded="true">
																														<div class="pull-right">
																															<a href="javascript:void(0)" onclick="editUnitKerja(<?= $u4->id_unit_kerja ?>)" class="btn btn-primary btn-xs" title="Edit" data-toggle="tooltip"><i class="ti-pencil" style="color:white;"></i></a>
																															<a href="javascript:void(0)" onclick="hapusUnitKerja(<?= $u4->id_unit_kerja ?>)" class="btn btn-danger btn-xs" title="Hapus" data-toggle="tooltip"><i class="ti-trash" style="color:white;"></i></a>
																														</div>
																														<div class="panel-body">
																															<div class="col-md-3 text-center b-r" style="min-height:50px;">
																																<center><img style="width: 80%" src="<?php echo base_url() . "data/logo/bnpt.png"; ?>" alt="user" class="img-circle" /> </center>
																															</div>
																															<div class="col-md-9">
																																<br>
																																<p class="text-center"><strong><?= $u4->nama_unit_kerja ?></strong></p>
																															</div>
																														</div>
																													</div>
																												</div>
																											</li>
																										<?php } ?>
																									</ul>
																								<?php } ?>
																							</li>
																						<?php } ?>
																					</ul>
																				<?php } ?>
																			</li>
																		<?php } ?>
																	</ul>
																<?php } ?>
															</li>
														<?php } ?>
														</ul>
														<?php
														if (count($unit_kerja) > 1) {
														?>
													</li>
											</ul>
										<?php } ?>
										</div>
									<?php } ?>
								</div>
								<div role="tabpanel" class="tab-pane fade <?= ($active_tab == 'jabatan' ? 'active in' : '') ?>" id="tabJabatan">

									<div style="margin-top: -50px;" class="white-box">
										<a href="javascript:void(0)" class="fcbtn btn btn-primary btn-block" onclick="tambahJabatan()">Tambah Jabatan </a>
									</div>
									<!-- <div class="row"> -->
									<?php foreach ($jabatan as $j) { ?>
										<div class="col-md-6">
											<div class="white-box">
												<div class="row">
													<div class="col-md-3 b-r">
														<center>
															<i style="font-size: 30px;color:#6003c8;border:solid 2px #6003c8;padding:10px;border-radius: 50%" class=" icon-chart"></i>
														</center>
													</div>
													<div class="col-md-9">
														<div class="btn-group m-r-10 pull-right">
															<button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle waves-effect waves-light btn-circle" type="button"><i class="fa fa-ellipsis-v"></i></button>
															<ul role="menu" class="dropdown-menu">
																<li><a href="javascript:void(0)" onclick="editJabatan(<?= $j->id_jabatan ?>)"><i class="ti-pencil"></i> Edit</a></li>
																<li><a href="javascript:void(0)" onclick="hapusJabatan(<?= $j->id_jabatan ?>)"><i class="ti-trash"></i> Hapus</a></li>
															</ul>
														</div>

														<span style="font-weight:400;display:block;font-size: 14px;text-transform: uppercase;"><?= $j->nama_jabatan ?></span>
														<small style="display: block;"><?= $j->nama_unit_kerja ?></small>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
									<!-- </div> -->
								</div>

								<div role="tabpanel" class="tab-pane fade <?= ($active_tab == 'sub_office' ? 'active in' : '') ?>" id="tabSubOffice">

									<div style="margin-top: -50px;" class="white-box">
										<a href="javascript:void(0)" class="fcbtn btn btn-primary btn-block" onclick="tambahSubOffice()">Tambah Sub Office </a>
									</div>
									<div class="white-box">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Lokasi</th>
														<th>Koordinat</th>
														<th class="text-nowrap">Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$no=1;
														foreach($sub_office as $s){
													?>
													<tr>
														<td><?=$no?></td>
														<td><?=$s->nama_sub?></td>
														<td><?=$s->latitude?>, <?=$s->longitude?></td>
														<td class="text-nowrap">
															<a href="javascript:void(0)" onclick="editSubOffice(<?=$s->id_ref_skpd_sub?>)" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
															<a href="javascript:void(0)" onclick="hapusSubOffice(<?=$s->id_ref_skpd_sub?>)" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
														</td>
													</tr>
													<?php $no++; } ?>
												</tbody>
											</table>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="hapusJabatan" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Jabatan</h4>
					</div>
					<div class="modal-body">
						Apakah anda yakin akan menghapus Jabatan ini?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
						<a style="color: #fff !important" href="" id="btnDeleteJabatan" class="btn btn-primary waves-effect text-left">Ya</a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div id="tambahJabatan" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Tambah Jabatan</h4>
					</div>
					<div class="modal-body">
						<form id="formJabatan" method="POST">
							<div id="hidden"></div>
							<div class="form-group">
								<label for="exampleInputuname">Nama Jabatan</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="ti-bar-chart"></i></div>
									<input type="text" class="form-control" name="nama_jabatan" placeholder="Nama Jabatan">
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Level Unit Kerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="ti-pulse"></i></div>
									<select id="level_unit_kerja_jabatan" onchange="toggleLevelUnitKerjaJabatan()" name="level_unit_kerja" class="form-control">
										<option value="">Pilih Level Unit Kerja</option>
										<option value="1">I</option>
										<option value="2">II</option>
										<option value="3">III</option>
										<option value="4">IV</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Unit Kerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-database"></i></div>
									<select id="id_unit_kerja" name="id_unit_kerja" class="form-control">
										<option value="">Pilih Unit Kerja</option>
									</select>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
						</form>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		
		<div id="tambahSubOffice" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Tambah Sub Office</h4>
					</div>
					<div class="modal-body">
						<form id="formSubOffice" method="POST">
							<div id="hidden"></div>
							<div class="form-group">
								<label for="exampleInputuname">Nama Sub Office</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="ti-layers"></i></div>
									<input type="text" class="form-control" name="nama_sub" placeholder="Nama Sub Office">
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputuname">Latitude</label>
									<input type="text" class="form-control" name="latitude" placeholder="Latitude">
							</div>
							<div class="form-group">
								<label for="exampleInputuname">Longitude</label>
									<input type="text" class="form-control" name="longitude" placeholder="Longitude">
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary waves-effect text-left">Kirim</button>
						</form>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<div id="hapusSubOffice" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Sub Office</h4>
					</div>
					<div class="modal-body">
						Apakah anda yakin akan menghapus Sub Office ini?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
						<a style="color: #fff !important" href="" id="btnDeleteSubOffice" class="btn btn-primary waves-effect text-left">Ya</a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>


		<script>
			function toggleLevelUnitKerja() {
				var level = $('#level_unit_kerja').val();
				if (level != '') {
					if (level == 1) {
						$('#divUnitKerjaInduk').hide();
						$('#id_induk').val('0');
					} else {
						$('#divUnitKerjaInduk').show();
						$.post("<?= base_url(); ?>ref_skpd/get_unit_kerja_by_level/<?= $detail->id_skpd ?>/" + parseInt(level - 1), {}, function(obj) {
							$('#id_induk').html(obj);
						});
					}
				}
			}

			function tambahJabatan() {
				$('#tambahJabatan').modal('show');
				$('#tambahJabatan .modal-title').html('Tambah Jabatan');
			}

			function tambahUnitKerja() {
				$('#formUnitKerja')[0].reset();
				$('#tambahUnitKerja #hidden').html('');
				$('#divUnitKerjaInduk').hide();
				$('#tambahUnitKerja').modal('show');
				$('#tambahUnitKerja .modal-title').html('Tambah Unit Kerja');
			}

			function editUnitKerja(id_unit_kerja) {
				$('#formUnitKerja')[0].reset();
				$('#tambahUnitKerja #hidden').html('<input type="hidden" value="" name="id_unit_kerja"/>');
				$.ajax({
					url: "<?php echo base_url('ref_skpd/get_unit_kerja/') ?>/" + id_unit_kerja,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						$('[name="id_unit_kerja"]').val(data.id_unit_kerja);
						$('[name="nama_unit_kerja"]').val(data.nama_unit_kerja);
						$('[name="level_unit_kerja"]').val(data.level_unit_kerja);
						if (data.level_unit_kerja > 1) {
							$('#divUnitKerjaInduk').show();
							$.post("<?= base_url(); ?>ref_skpd/get_unit_kerja_by_level/<?= $detail->id_skpd ?>/" + parseInt(data.level_unit_kerja - 1), {}, function(obj) {
								$('#id_induk').html(obj);
								$('[name="id_induk"]').val(data.id_induk);
							});
						}
						if (data.b_renstra == 1) {
							$('[name="b_renstra"]').prop('checked', true);
						}
						if (data.b_rkt == 1) {
							$('[name="b_rkt"]').prop('checked', true);
						}
						if (data.b_pk == 1) {
							$('[name="b_pk"]').prop('checked', true);
						}
						if (data.b_lkj == 1) {
							$('[name="b_lkj"]').prop('checked', true);
						}
						$('#tambahUnitKerja').modal('show');
						$('#tambahUnitKerja .modal-title').html('Ubah Unit Kerja');

					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Gagal mendapatkan data");
					}
				});
			}



			function editJabatan(id_jabatan) {
				$('#formJabatan')[0].reset();
				$('#tambahJabatan #hidden').html('<input type="hidden" value="" name="id_jabatan"/>');
				$.ajax({
					url: "<?php echo base_url('ref_skpd/get_jabatan/') ?>/" + id_jabatan,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						$('[name="id_jabatan"]').val(data.id_jabatan);
						$('[name="nama_jabatan"]').val(data.nama_jabatan);
						$('#level_unit_kerja_jabatan').val(data.level_unit_kerja);

						var level = $('#level_unit_kerja_jabatan').val();
						if (level != '') {
							$.post("<?= base_url(); ?>ref_skpd/get_unit_kerja_by_level/<?= $detail->id_skpd ?>/" + level, {}, function(obj) {
								$('#id_unit_kerja').html(obj);
								$('#id_unit_kerja').val(data.id_unit_kerja);

							});
						}
						$('#tambahJabatan').modal('show');
						$('#tambahJabatan .modal-title').html('Ubah Jabatan');

					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Gagal mendapatkan data");
					}
				});
			}

			function hapusJabatan(id_jabatan) {
				$('#hapusJabatan').modal('show');
				$('#btnDeleteJabatan').attr('href', '<?= base_url('ref_skpd/delete_jabatan') ?>/' + id_jabatan);
			}

			function hapusUnitKerja(id_unit_kerja) {
				$('#hapusUnitKerja').modal('show');
				$('#btnDeleteUnitKerja').attr('href', '<?= base_url('ref_skpd/delete_unit_kerja') ?>/' + id_unit_kerja);
			}


			function toggleLevelUnitKerjaJabatan() {
				var level = $('#level_unit_kerja_jabatan').val();
				if (level != '') {
					$.post("<?= base_url(); ?>ref_skpd/get_unit_kerja_by_level/<?= $detail->id_skpd ?>/" + level, {}, function(obj) {
						$('#id_unit_kerja').html(obj);
					});
				}
			}


			function loadMap() {



				var lat = <?= ($detail->latitude != null) ? $detail->latitude : "-6.859751"; ?>;
				var lng = <?= ($detail->longitude != null) ? $detail->longitude : "107.920779"; ?>;

				if (lat != "" && lng != "") {
					var location = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

				}
				var mapProp = {
					center: location,
					zoom: 15,
					//disableDefaultUI: true,
					//mapTypeId:google.maps.MapTypeId.HYBRID
				};
				var map = new google.maps.Map(document.getElementById("googleMapEdit"), mapProp);

				var marker = new google.maps.Marker({
					position: location,
					//map: map,
					//animation: google.maps.Animation.BOUNCE
				});



				var infowindow = new google.maps.InfoWindow({
					content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
				});

				//if(lat!="" && lng!=""){
				marker.setMap(map);
				markers.push(marker);
				infowindow.open(map, marker);
				//}


				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map, marker);
				});


				google.maps.event.addListener(map, 'click', function(event) {
					placeMarker(map, event.latLng);
				});


			}
			var markers = [];

			function placeMarker(map, location) {
				var marker = new google.maps.Marker({
					position: location,
					map: map,
					animation: google.maps.Animation.BOUNCE,
				});
				var infowindow = new google.maps.InfoWindow({
					content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
				});

				//hapus tanda
				for (var i = 0; i < markers.length; i++) {
					markers[i].setMap(null);
				}

				infowindow.open(map, marker);
				markers.push(marker);
				$("#latitude").val(location.lat());
				$("#longitude").val(location.lng());
			}
			

			function tambahSubOffice() {
				$('#tambahSubOffice #hidden').html('');
				$('#formSubOffice')[0].reset();
				$('#tambahSubOffice .modal-title').html('Tambah Sub Office');
				$('#tambahSubOffice').modal('show');
            }
            
            
			function editSubOffice(id_ref_skpd_sub) {
				$('#formSubOffice')[0].reset();
				$('#tambahSubOffice #hidden').html('<input type="hidden" value="" name="id_ref_skpd_sub"/>');
				$.ajax({
					url: "<?php echo base_url('ref_skpd/get_sub/') ?>/" + id_ref_skpd_sub,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						$('[name="id_ref_skpd_sub"]').val(data.id_ref_skpd_sub);
						$('[name="nama_sub"]').val(data.nama_sub);
						$('[name="latitude"]').val(data.latitude);
						$('[name="longitude"]').val(data.longitude);
						$('#tambahSubOffice').modal('show');
						$('#tambahSubOffice .modal-title').html('Ubah Sub Office');

					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Gagal mendapatkan data");
					}
				});
			}

			function hapusSubOffice(id_ref_skpd_sub) {
				$('#hapusSubOffice').modal('show');
				$('#btnDeleteSubOffice').attr('href', '<?= base_url('ref_skpd/delete_sub') ?>/' + id_ref_skpd_sub);
			}
		</script>