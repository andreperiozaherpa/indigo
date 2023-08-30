<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-md-12">
						<h2 class="content-header-title float-left mb-0">Tambah Pegawai</h2>
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url();?>master_pegawai/">Home</a>
								</li>
								<li class="breadcrumb-item "><a href="<?=base_url();?>master_pegawai/detail">Tambah Pegawai</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</div>
		
		<div class="content-body">

			<!-- Form wizard with number tabs section start -->
			<section id="number-tabs">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title"></h4>
							</div>
							<div class="card-content">
								<div class="card-body">
									<p></p>
									<form id="wizard-tambah-pegawai-2" class="wizard-circle" role="form" method='post' enctype="multipart/form-data">
										<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />

										<!-- Step 1 -->
										<h6>Step 1</h6>
										<fieldset>

											<div class="row">
												<div class="col-xl-5 col-md-5 col-sm-12 profile-card-2 display-flex">
													<div class="card border-primary">
														<div class="card-header mx-auto pb-0">
															<div class="row m-0">
																<div class="col-sm-12 text-center">
																	<h4>Tambah Orang</h4>
																</div>
																<div class="col-sm-12 text-center">
																	<p class="">Untuk didaftarkan kedalam tabel referensi Orang.</p>
																</div>
															</div>
														</div>
														<div class="card-content">
															<div class="card-body text-center mx-auto">
																<div class="avatar avatar-xl">
																	<img class="img-fluid" src="<?=base_url();?>/data/user_picture/useravatar.png" alt="img placeholder">
																</div>
																<a href="<?=base_url('master_pegawai/add_orang')?>" class="btn gradient-light-success btn-block mt-2">Pilih</a>
															</div>
														</div>
													</div>
												</div>

												<div class="col-xl-2 col-md-2 col-sm-12 display-flex align-items-center">
													<h1 class="center text-center text-muted"> - Atau - </h1>
												</div>

												<div class="col-xl-5 col-md-5 col-sm-12 profile-card-2 display-flex">
													<div class="card border-primary">
														<div class="card-header mx-auto pb-0">
															<div class="row m-0">
																<div class="col-sm-12 text-center">
																	<h4>Tambah Pegawai ASN</h4>
																</div>
																<div class="col-sm-12 text-center">
																	<p class="">Untuk didaftarkan kedalam tabel Master Pegawai.</p>
																</div>
															</div>
														</div>
														<div class="card-content">
															<div class="card-body text-center mx-auto">
																<div class="avatar avatar-xl">
																	<img class="img-fluid" src="<?=base_url();?>/data/user_picture/useravatar.png" alt="img placeholder">
																</div>
																<a href="<?=base_url('master_pegawai/add_pegawai')?>" class="btn gradient-light-success btn-block mt-2">Pilih</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</fieldset>

										<!-- Step 2 -->
										<h6>Step 2</h6>
										<fieldset>
											<div class="card">
												<div class="card-content">
													<div class="card-body">
														<div class="row justify-content-center">
															<div class="col-12 col-md-8">
																<h5 class="mt-2 mb-1 mt-sm-0"></h5>
																<div class="row" style="margin-top: 32px">

																	<div class="col-12 col-md-12">
																		<h5 class="mb-1"><i class="feather icon-user mr-25"></i>Biodata</h5>
																		<?php echo flashdata_notif();?>
																		<div class="row">
																			<div class="col-md-3">
																				<div class="form-group">
																					<div class="controls">
																						<label>Kartu Identitas <span class="text-danger">*</span></label>
																						<select name="id_kartu_identitas" class="form-control <?=validation_error_class('id_kartu_identitas')?>" required="">
																							<option value="1" <?=validation_set_value_select('id_kartu_identitas','1')?>>KTP</option>
																							<option value="2" <?=validation_set_value_select('id_kartu_identitas','2')?>>Paspor</option>
																							<option value="3" <?=validation_set_value_select('id_kartu_identitas','3')?>>SIM</option>
																						</select>
																						<?=validation_error_message('id_kartu_identitas')?>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-9">
																				<div class="form-group">
																					<div class="controls">
																						<label>No. Identitas <span class="text-danger">*</span></label>
																						<input type="text" name="no_kartu_identitas" value="<?=validation_set_value_input('no_kartu_identitas')?>" class="form-control <?=validation_error_class('no_kartu_identitas')?>" required="">
																						<?=validation_error_message('no_kartu_identitas')?>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-12">
																				<div class="form-group">
																					<div class="controls">
																						<label>Kode BKN</label>
																						<input type="text" name="kode_bkn_orang" value="<?=validation_set_value_input('kode_bkn_orang')?>" class="form-control <?=validation_error_class('kode_bkn_orang')?>">
																						<?=validation_error_message('kode_bkn_orang')?>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-12">
																				<div class="form-group">
																					<div class="controls">
																						<label>Nama Lengkap <span class="text-danger">*</span></label>
																						<input type="text" name="nama_lengkap" value="<?=validation_set_value_input('nama_lengkap')?>" class="form-control <?=validation_error_class('nama_lengkap')?>" required="">
																						<?=validation_error_message('nama_lengkap')?>
																					</div>
																				</div>
																			</div>


																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Jenis Kelamin <span class="text-danger">*</span></label>
																						<ul class="list-unstyled mb-0 <?=validation_error_class('jenis_kelamin')?>">
																							<li class="d-inline-block mr-2">
																								<fieldset>
																									<div class="vs-radio-con">
																										<input type="radio" name="jenis_kelamin" value="L" <?=validation_set_value_radio('jenis_kelamin','L')?>>
																										<span class="vs-radio">
																											<span class="vs-radio--border"></span>
																											<span class="vs-radio--circle"></span>
																										</span>
																										<span class="">Laki - Laki </span>
																									</div>
																								</fieldset>
																							</li>
																							<li class="d-inline-block mr-2">
																								<fieldset>
																									<div class="vs-radio-con">
																										<input type="radio" name="jenis_kelamin" value="P" <?=validation_set_value_radio('jenis_kelamin','P')?>>
																										<span class="vs-radio">
																											<span class="vs-radio--border"></span>
																											<span class="vs-radio--circle"></span>
																										</span>
																										<span class="">Perempuan</span>
																									</div>
																								</fieldset>
																							</li>                                     
																						</ul>
																						<?=validation_error_message('jenis_kelamin')?>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label> Agama <span class="text-danger">*</span></label>
																						<select class="form-control <?=validation_error_class('id_agama')?>" name="id_agama" required="">
																							<option value="">Pilih</option>
																							<?php foreach ($ref_agama as $row): ?>
																								<option value="<?=$row->kode_agama?>" <?=validation_set_value_select('id_agama',$row->kode_agama)?>><?=$row->nama_agama?></option>
																							<?php endforeach ?>
																						</select>
																						<?=validation_error_message('id_agama')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Tanggal Lahir<span class="text-danger">*</span></label>
																						<input type="date" name="tanggal_lahir" value="<?=validation_set_value_input('tanggal_lahir')?>" class="form-control <?=validation_error_class('tanggal_lahir')?>" required="">
																						<?=validation_error_message('tanggal_lahir')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label><i class="feather icon-map-pin"></i> Tempat Lahir <span class="text-danger">*</span></label>
																						<select class="form-control select2_wizard <?=validation_error_class('id_tempat_lahir')?>" name="id_tempat_lahir" required="">
																							<option value="">Pilih</option>
																							<?php foreach ($ref_kelahiran as $row): ?>
																								<option value="<?=$row->kode_kelahiran?>" <?=validation_set_value_select('id_tempat_lahir',$row->kode_kelahiran)?>><?=$row->nama_kelahiran?></option>
																							<?php endforeach ?>
																						</select>
																						<?=validation_error_message('id_tempat_lahir')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Alamat Lengkap <span class="text-danger">*</span></label>
																						<textarea name="alamat" class="form-control <?=validation_error_class('alamat')?>" required=""><?=validation_set_value_input('alamat')?></textarea>
																						<?=validation_error_message('alamat')?>
																					</div>
																				</div>

																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Kode Pos</label>
																						<input type="text" name="kode_pos" value="<?=validation_set_value_input('kode_pos')?>" class="form-control <?=validation_error_class('kode_pos')?>">
																						<?=validation_error_message('kode_pos')?>
																					</div>
																				</div>
																			</div>


																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>No. Akta Kelahiran</label>
																						<input type="text" name="no_akta_kelahiran" value="<?=validation_set_value_input('no_akta_kelahiran')?>" class="form-control <?=validation_error_class('no_akta_kelahiran')?>">
																						<?=validation_error_message('no_akta_kelahiran')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>No. Akta Kematian</label>
																						<input type="text" name="no_akta_kematian" value="<?=validation_set_value_input('no_akta_kematian')?>" class="form-control <?=validation_error_class('no_akta_kematian')?>">
																						<?=validation_error_message('no_akta_kematian')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Tgl. Kematian</label>
																						<input type="date" name="tanggal_kematian" value="<?=validation_set_value_input('tanggal_kematian')?>" class="form-control <?=validation_error_class('tanggal_kematian')?>">
																						<?=validation_error_message('tanggal_kematian')?>
																					</div>
																				</div>
																			</div>


																			<div class="col-md-12">
																				<div class="divider divider-primary">
																					<div class="divider-text">Pendidikan & Pekerjaan</div>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Gelar Depan</label>
																						<input type="text" name="gelar_depan" value="<?=validation_set_value_input('gelar_depan')?>" class="form-control <?=validation_error_class('gelar_depan')?>">
																						<?=validation_error_message('gelar_depan')?>
																					</div>
																				</div>

																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Gelar Belakang</label>
																						<input type="text" name="gelar_belakang" value="<?=validation_set_value_input('gelar_belakang')?>" class="form-control <?=validation_error_class('gelar_belakang')?>">
																						<?=validation_error_message('gelar_belakang')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Tingkat Pendidikan</label>
																						<select name="id_tingkat_pendidikan" class="form-control <?=validation_error_class('id_tingkat_pendidikan')?>" required="">
																							<option value="">Pilih</option>
																							<?php foreach ($ref_tingkatpendidikan as $row): ?>
																								<option value="<?=$row->kode_tingkatpendidikan?>" <?=validation_set_value_select('id_tingkat_pendidikan',$row->kode_tingkatpendidikan)?>><?=$row->nama_tingkatpendidikan?></option>
																							<?php endforeach ?>
																						</select>
																						<?=validation_error_message('id_tingkat_pendidikan')?>
																					</div>
																				</div>
																			</div>


																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Pendidikan Terakhir</label>
																						<select name="id_pendidikan_terakhir" class="form-control select2_wizard <?=validation_error_class('id_pendidikan_terakhir')?>" required="">
																							<option value="">Pilih</option>
																							<?php foreach ($ref_pendidikan as $row): ?>
																								<option value="<?=$row->kode_pendidikan?>" <?=validation_set_value_select('id_pendidikan_terakhir',$row->kode_pendidikan)?>><?=$row->nama_pendidikan?></option>
																							<?php endforeach ?>
																						</select>
																						<?=validation_error_message('id_pendidikan_terakhir')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Tgl.  Kelulusan</label>
																						<input type="date" name="tanggal_kelulusan" value="<?=validation_set_value_input('tanggal_kelulusan')?>" class="form-control <?=validation_error_class('tanggal_kelulusan')?>">
																						<?=validation_error_message('tanggal_kelulusan')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Pekerjaan</label>
																						<input type="text" name="pekerjaan" value="<?=validation_set_value_input('pekerjaan')?>" class="form-control <?=validation_error_class('pekerjaan')?>">
																						<?=validation_error_message('pekerjaan')?>
																					</div>
																				</div>
																			</div>




																			<div class="col-md-12">
																				<div class="divider divider-primary">
																					<div class="divider-text">Keluarga</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Nama Ayah <span class="text-danger">*</span></label>
																						<input type="text" name="nama_ayah" value="<?=validation_set_value_input('nama_ayah')?>" class="form-control <?=validation_error_class('nama_ayah')?>" required="">
																						<?=validation_error_message('nama_ayah')?>
																					</div>
																				</div>

																			</div>
																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Nama Ibu <span class="text-danger">*</span></label>
																						<input type="text" name="nama_ibu" value="<?=validation_set_value_input('nama_ibu')?>" class="form-control <?=validation_error_class('nama_ibu')?>" required="">
																						<?=validation_error_message('nama_ibu')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Anak Ke</label>
																						<input type="text" name="anak_ke" value="<?=validation_set_value_input('anak_ke')?>" class="form-control <?=validation_error_class('anak_ke')?>">
																						<?=validation_error_message('anak_ke')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-12">
																				<div class="divider divider-primary">
																					<div class="divider-text"></div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Status Kawin</label>
																						<select name="id_status_kawin" class="form-control <?=validation_error_class('id_status_kawin')?>" required="">
																							<option value="">Pilih</option>
																							<?php foreach ($ref_kawin as $row): ?>
																								<option value="<?=$row->kode_kawin?>" <?=validation_set_value_select('id_status_kawin',$row->kode_kawin)?>><?=$row->nama_kawin?></option>
																							<?php endforeach ?>
																						</select>
																						<?=validation_error_message('id_status_kawin')?>
																					</div>
																				</div>
																			</div>


																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Karis / Karsu</label>
																						<input type="text" name="karis_karsu" value="<?=validation_set_value_input('karis_karsu')?>" class="form-control <?=validation_error_class('karis_karsu')?>">
																						<?=validation_error_message('karis_karsu')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>Anak Tanggungan</label>
																						<input type="text" name="anak_tanggungan" value="<?=validation_set_value_input('anak_tanggungan')?>" class="form-control <?=validation_error_class('anak_tanggungan')?>">
																						<?=validation_error_message('anak_tanggungan')?>
																					</div>
																				</div>
																			</div>




																		</div>
																		<div class="divider divider-primary">
																			<div class="divider-text">Kontak</div>
																		</div>
																		<div class="row">


																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>No. HP </label>
																						<input type="text" name="no_hp" value="<?=validation_set_value_input('no_hp')?>" class="form-control <?=validation_error_class('no_hp')?>">
																						<?=validation_error_message('no_hp')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>No. Telp</label>
																						<input type="text" name="no_telepon" value="<?=validation_set_value_input('no_telepon')?>" class="form-control <?=validation_error_class('no_telepon')?>">
																						<?=validation_error_message('no_telepon')?>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-6">
																				<div class="form-group">
																					<div class="controls">
																						<label>e-mail</label>
																						<input type="text" name="email" value="<?=validation_set_value_input('email')?>" class="form-control <?=validation_error_class('email')?>">
																						<?=validation_error_message('email')?>
																					</div>
																				</div>
																			</div>

																		</div>


																	</div>


																</div>


															</div>
														</div>



														<!-- users edit Info form ends -->
													</div>
												</div>
											</div>


										</fieldset>

										<!-- Step 3 -->
										<h6>Step 3</h6>
										<fieldset>
											<div class="card">
												<div class="card-content">
													<div class="card-body">
														<div class="row justify-content-center">
															<div class="col-12 col-md-8">
																<h5 class="mt-2 mb-1 mt-sm-0"></h5>
																<div class="row" style="margin-top: 32px">
																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>NPWP</label>
																				<input type="text" name="npwp" value="<?=validation_set_value_input('npwp')?>" class="form-control <?=validation_error_class('npwp')?>">
																				<?=validation_error_message('npwp')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Tgl. NPWP</label>
																				<input type="date" name="tanggal_npwp" value="<?=validation_set_value_input('tanggal_npwp')?>" class="form-control <?=validation_error_class('tanggal_npwp')?>">
																				<?=validation_error_message('tanggal_npwp')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-12">
																		<div class="divider divider-primary">
																			<div class="divider-text">Asuransi</div>
																		</div>
																	</div>

																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="controls">
																				<label>No. BPJS</label>
																				<input type="text" name="no_bpjs" value="<?=validation_set_value_input('no_bpjs')?>" class="form-control <?=validation_error_class('no_bpjs')?>">
																				<?=validation_error_message('no_bpjs')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Faskes BPJS </label>
																				<input type="text" name="faskes_bpjs" value="<?=validation_set_value_input('faskes_bpjs')?>" class="form-control <?=validation_error_class('faskes_bpjs')?>">
																				<?=validation_error_message('faskes_bpjs')?>
																			</div>
																		</div>
																	</div>


																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Kelas BPJS </label>
																				<select name="kelas_bpjs" class="form-control <?=validation_error_class('kelas_bpjs')?>" required="">
																					<option value="">Pilih</option>
																					<option value="1" <?=validation_set_value_select('kelas_bpjs','1')?>>kelas 1</option>
																					<option value="2" <?=validation_set_value_select('kelas_bpjs','2')?>>kelas 2</option>
																				</select>
																				<?=validation_error_message('kelas_bpjs')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-12">
																		<div class="divider divider-primary">
																			<div class="divider-text">Surat Keterangan</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Ket. Sehat Dokter </label>
																				<input type="text" name="keterangan_sehat_dokter" value="<?=validation_set_value_input('keterangan_sehat_dokter')?>" class="form-control <?=validation_error_class('keterangan_sehat_dokter')?>">
																				<?=validation_error_message('keterangan_sehat_dokter')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Ket. Tanggal Sehat </label>
																				<input type="date" name="tanggal_keterangan_sehat" value="<?=validation_set_value_input('tanggal_keterangan_sehat')?>" class="form-control <?=validation_error_class('tanggal_keterangan_sehat')?>">
																				<?=validation_error_message('tanggal_keterangan_sehat')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>No. Bebas Narkoba </label>
																				<input type="text" name="no_keterangan_bebas_narkoba" value="<?=validation_set_value_input('no_keterangan_bebas_narkoba')?>" class="form-control <?=validation_error_class('no_keterangan_bebas_narkoba')?>">
																				<?=validation_error_message('no_keterangan_bebas_narkoba')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Tgl . Ket Bebas Narkoba </label>
																				<input type="date" name="tanggal_keterangan_bebas_narkoba" value="<?=validation_set_value_input('tanggal_keterangan_bebas_narkoba')?>" class="form-control <?=validation_error_class('tanggal_keterangan_bebas_narkoba')?>">
																				<?=validation_error_message('tanggal_keterangan_bebas_narkoba')?>
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>No. Ket. Kelakuan Baik </label>
																				<input type="text" name="no_keterangan_kelakuan_baik" value="<?=validation_set_value_input('no_keterangan_kelakuan_baik')?>" class="form-control <?=validation_error_class('no_keterangan_kelakuan_baik')?>">
																				<?=validation_error_message('no_keterangan_kelakuan_baik')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Tgl . Ket Kelakuan Baik </label>
																				<input type="date" name="tanggal_keterangan_kelakuan_baik" value="<?=validation_set_value_input('tanggal_keterangan_kelakuan_baik')?>" class="form-control <?=validation_error_class('tanggal_keterangan_kelakuan_baik')?>">
																				<?=validation_error_message('tanggal_keterangan_kelakuan_baik')?>
																			</div>
																		</div>
																	</div>


																	<div class="col-md-12">		
																		<div class="divider divider-primary">
																			<div class="divider-text">Media Sosial</div>
																		</div>
																	</div>


																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Facebook</label>
																				<input type="text" name="facebook" value="<?=validation_set_value_input('facebook')?>" class="form-control <?=validation_error_class('facebook')?>">
																				<?=validation_error_message('facebook')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Twitter </label>
																				<input type="text" name="twitter" value="<?=validation_set_value_input('twitter')?>" class="form-control <?=validation_error_class('twitter')?>">
																				<?=validation_error_message('twitter')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6">
																		<div class="form-group">
																			<div class="controls">
																				<label>Instagram </label>
																				<input type="text" name="instagram" value="<?=validation_set_value_input('instagram')?>" class="form-control <?=validation_error_class('instagram')?>">
																				<?=validation_error_message('instagram')?>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-12">
																		<div class="divider divider-primary">
																			<div class="divider-text">Foto</div>
																		</div>
																	</div>

																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="controls">
																				<label>File Foto</label>
																				<input type="file" class="dropify form-control" name="foto" id="foto">
																				<small class="">* jpg,jpeg,png | Max: 1000 Kb</small>
																			</div>
																		</div>

																	</div>
																</div>


															</div>
														</div>



														<!-- users edit Info form ends -->
													</div>
												</div>
											</div>


										</fieldset>
										<!-- <input type="submit" id="form-submit" class="hidden"> -->
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Form wizard with number tabs section end -->

		</div>

	</div>

	<!-- page users view end -->




</div>
</div>

<script type="text/javascript" defer="">
	document.addEventListener('DOMContentLoaded', function(){ 
    // your code goes here
    // $('.select2').select2("destroy");
 //    var $select = $('.select2_wizard').select2();
	// //console.log($select);
	// $select.each(function(i,item){
	//   //console.log(item);
	//   $(item).select2("destroy");
	// });
	$('.select2_wizard').select2({
		minimumInputLength: 3
	});
}, false);


</script>