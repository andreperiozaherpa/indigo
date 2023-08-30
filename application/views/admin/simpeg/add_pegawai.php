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

											<div class="row justify-content-center">
												<div class="col-xl-8 col-md-8 col-sm-12 profile-card-2 display-flex">
													<div class="card border-primary">
														<div class="card-header mx-auto pb-0">
															<div class="row m-0">
																<div class="col-sm-12 text-center">
																	<h4>Pilih Biodata Pribadi ASN</h4>
																</div>
																<div class="col-sm-12">
																	<div class="row justify-content-center">
																		<div class="col-xl-9 col-md-9 col-sm-12 profile-card-1">
																			<div class="card with-dropdown text-white bg-gradient-success" style="height: 148.2px;">

																				<?php if (isset($search_data)): ?>
																					<a href="<?=base_url('master_pegawai/detail/'.$search_data->id_orang);?>" target="_blank">
																						<div class="card-content">
																							<div class="media user-list">
																								<img class="align-self-center mr-2 user-img" src="<?=base_url('data/user_picture/'.$search_data->foto);?>" alt="">
																								<div class="media-body text-left">
																									<h5 class="mt-0 mb-0 font-weight-bold text-white"><?=$search_data->nama_lengkap?></h5>
																									<span class="user-role text-white"><?=$search_no?></span>
																									<hr style="border-top: 1px solid rgb(0 0 0 / 15%);">
																									<p class="mb-0 mt-0 text-white"><i class="feather icon-briefcase"></i> PTSP</p>
																								</div>
																							</div>
																						</div>
																					</a>
																					<?php else: ?>
																						<div class="card-content">
																							<div class="card-body text-center mx-auto">
																								<div class="avatar avatar-xl">
																									<img class="img-fluid" src="<?=base_url();?>/data/user_picture/useravatar.png" alt="img placeholder">
																								</div>
																							</div>
																						</div>
																					<?php endif ?>

																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="card-content">
																<div class="card-body text-center mx-auto">
																	<fieldset class="form-group position-relative has-icon-left input-divider-left">
																		<div class="input-group">
																			<select name="id_kartu_identitas" id="id_kartu_identitas" class="round form-control" style="max-width: 250px;" required="">
																				<option value="1" <?=($search_id==1)?"selected":""?>>KTP</option>
																				<option value="2" <?=($search_id==2)?"selected":""?>>Paspor</option>
																				<option value="3" <?=($search_id==3)?"selected":""?>>SIM</option>
																			</select>
																			<input type="text" value="<?=$search_no?>" name="no_kartu_identitas" id="no_kartu_identitas" class="round form-control" placeholder="Masukkan nomor identitas">
																			<input type="hidden" value="<?=@$search_data->id_orang?>" name="id_orang" id="id_orang" class="round form-control" placeholder="Masukkan nomor identitas">
																			<input type="hidden" value="<?=@$search_data->kode_bkn_orang?>" name="kode_bkn_orang" id="kode_bkn_orang" class="round form-control" placeholder="Masukkan nomor identitas">
																			<div class="form-control-position">
																				<i class="feather icon-user"></i>
																			</div>
																			<div class="input-group-append" id="button-addon2">
																				<button onclick="search_ktp();" class="btn btn-primary round waves-effect waves-light" type="button"><i class="feather icon-search"></i></button>
																			</div>
																		</div>
																	</fieldset>
																	<?php echo flashdata_notif();?>


																	<div class="col-md-12">
																		<div class="divider divider-primary">
																			<div class="divider-text">Atau</div>
																		</div>
																	</div>
																	<a href="<?=base_url('master_pegawai/add_orang')?>" class="btn gradient-light-success btn-block mt-2">Tambah Orang</a>
																</div>
															</div>
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
																		<div class="col-12 col-sm-12">
																			<h5 class="mb-1"><i class="feather icon-user mr-25"></i>Data PNS</h5>
																			<div class="row">
																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>NIP Baru<span class="text-danger">*</span></label>
																							<input type="text" name="nip_baru" value="<?=validation_set_value_input('nip_baru')?>" class="form-control <?=validation_error_class('nip_baru')?>">
																							<?=validation_error_message('nip_baru')?>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>NIP Lama</label>
																							<input type="text" name="nip_lama" value="<?=validation_set_value_input('nip_lama')?>" class="form-control <?=validation_error_class('nip_lama')?>">
																							<?=validation_error_message('nip_lama')?>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Kartu Pegawai Elektronik </label>
																							<input type="text" name="kpe" value="<?=validation_set_value_input('kpe')?>" class="form-control <?=validation_error_class('kpe')?>">
																							<?=validation_error_message('kpe')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Kartu Pegawai</label>
																							<input type="text" name="kartu_pegawai" value="<?=validation_set_value_input('kartu_pegawai')?>" class="form-control <?=validation_error_class('kartu_pegawai')?>">
																							<?=validation_error_message('kartu_pegawai')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Jenis Pegawai <span class="text-danger">*</span></label>
																							<select class="form-control <?=validation_error_class('id_jenis_pegawai')?>" name="id_jenis_pegawai" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_jenispegawai as $row): ?>
																									<option value="<?=$row->kode_jenispegawai?>" <?=validation_set_value_select('id_jenis_pegawai',$row->kode_jenispegawai)?>><?=$row->nama_jenispegawai?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_jenis_pegawai')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Kedudukan Hukum <span class="text-danger">*</span></label>
																							<select class="form-control <?=validation_error_class('id_kedudukan_hukum')?>" name="id_kedudukan_hukum" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_kedudukan as $row): ?>
																									<option value="<?=$row->kode_kedudukan?>" <?=validation_set_value_select('id_kedudukan_hukum',$row->kode_kedudukan)?>><?=$row->nama_kedudukan?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_kedudukan_hukum')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Jenis Pengadaan </label>
																							<select class="form-control <?=validation_error_class('id_jenis_pengadaan')?>" name="id_jenis_pengadaan" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_jenispengadaan as $row): ?>
																									<option value="<?=$row->kode_jenispengadaan?>" <?=validation_set_value_select('id_jenis_pengadaan',$row->kode_jenispengadaan)?>><?=$row->nama_jenispengadaan?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_jenis_pengadaan')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Status <span class="text-danger">*</span></label>
																							<ul class="list-unstyled mb-0 <?=validation_error_class('status_cpns_pns')?>">
																								<li class="d-inline-block mr-2">
																									<fieldset>
																										<div class="vs-radio-con">
																											<input type="radio" name="status_cpns_pns" value="C" <?=validation_set_value_radio('status_cpns_pns','C')?>>
																											<span class="vs-radio">
																												<span class="vs-radio--border"></span>
																												<span class="vs-radio--circle"></span>
																											</span>
																											<span class="">CPNS </span>
																										</div>
																									</fieldset>
																								</li>
																								<li class="d-inline-block mr-2">
																									<fieldset>
																										<div class="vs-radio-con">
																											<input type="radio" name="status_cpns_pns" value="P" <?=validation_set_value_radio('status_cpns_pns','P')?>>
																											<span class="vs-radio">
																												<span class="vs-radio--border"></span>
																												<span class="vs-radio--circle"></span>
																											</span>
																											<span class="">PNS</span>
																										</div>
																									</fieldset>
																								</li>                                     
																							</ul>
																							<?=validation_error_message('status_cpns_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">CPNS</div>
																					</div>
																				</div>

																				<div class="col-md-12">
																					<div class="form-group">
																						<div class="controls">
																							<label> No. SK CPNS <span class="text-danger">*</span></label>
																							<input type="text" name="no_sk_cpns" value="<?=validation_set_value_input('no_sk_cpns')?>" class="form-control <?=validation_error_class('no_sk_cpns')?>">
																							<?=validation_error_message('no_sk_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. SK CPNS <span class="text-danger">*</span></label>
																							<input type="date" name="tanggal_sk_cpns" value="<?=validation_set_value_input('tanggal_sk_cpns')?>" class="form-control <?=validation_error_class('tanggal_sk_cpns')?>" required="">
																							<?=validation_error_message('tanggal_sk_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT CPNS <span class="text-danger">*</span></label>
																							<input type="date" name="tmt_cpns" value="<?=validation_set_value_input('tmt_cpns')?>" class="form-control <?=validation_error_class('tmt_cpns')?>" required="">
																							<?=validation_error_message('tmt_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. Nota Persetujuan CPNS</label>
																							<input type="text" name="no_np_cpns" value="<?=validation_set_value_input('no_np_cpns')?>" class="form-control <?=validation_error_class('no_np_cpns')?>">
																							<?=validation_error_message('no_np_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Nota Persetujuan CPNS</label>
																							<input type="date" name="tanggal_np_cpns" value="<?=validation_set_value_input('tanggal_np_cpns')?>" class="form-control <?=validation_error_class('tanggal_np_cpns')?>" required="">
																							<?=validation_error_message('tanggal_np_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Spesimen Pejabat CPNS</label>
																							<input type="text" name="spesimen_pejabat_cpns" value="<?=validation_set_value_input('spesimen_pejabat_cpns')?>" class="form-control <?=validation_error_class('spesimen_pejabat_cpns')?>">
																							<?=validation_error_message('spesimen_pejabat_cpns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Spesimen Pengadaan</label>
																							<input type="text" name="spesimen_pengadaan" value="<?=validation_set_value_input('spesimen_pengadaan')?>" class="form-control <?=validation_error_class('spesimen_pengadaan')?>">
																							<?=validation_error_message('spesimen_pengadaan')?>
																						</div>
																					</div>
																				</div>





																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">PNS</div>
																					</div>
																				</div>



																				<div class="col-md-12">
																					<div class="form-group">
																						<div class="controls">
																							<label> No. SK PNS</label>
																							<input type="text" name="no_sk_pns" value="<?=validation_set_value_input('no_sk_pns')?>" class="form-control <?=validation_error_class('no_sk_pns')?>">
																							<?=validation_error_message('no_sk_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. SK PNS</label>
																							<input type="date" name="tanggal_sk_pns" value="<?=validation_set_value_input('tanggal_sk_pns')?>" class="form-control <?=validation_error_class('tanggal_sk_pns')?>" required="">
																							<?=validation_error_message('tanggal_sk_pns')?>
																						</div>
																					</div> 
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT PNS</label>
																							<input type="date" name="tmt_pns" value="<?=validation_set_value_input('tmt_pns')?>" class="form-control <?=validation_error_class('tmt_pns')?>" required="">
																							<?=validation_error_message('tmt_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. Nota Persetujuan PNS </label>
																							<input type="text" name="no_np_pns" value="<?=validation_set_value_input('no_np_pns')?>" class="form-control <?=validation_error_class('no_np_pns')?>">
																							<?=validation_error_message('no_np_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Nota Persetujuan PNS </label>
																							<input type="date" name="tanggal_np_pns" value="<?=validation_set_value_input('tanggal_np_pns')?>" class="form-control <?=validation_error_class('tanggal_np_pns')?>" required="">
																							<?=validation_error_message('tanggal_np_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Spesimen NIP </label>
																							<input type="text" name="spesimen_nip" value="<?=validation_set_value_input('spesimen_nip')?>" class="form-control <?=validation_error_class('spesimen_nip')?>">
																							<?=validation_error_message('spesimen_nip')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Penetapan NIP </label>
																							<input type="date" name="tanggal_penetapan_nip" value="<?=validation_set_value_input('tanggal_penetapan_nip')?>" class="form-control <?=validation_error_class('tanggal_penetapan_nip')?>" required="">
																							<?=validation_error_message('tanggal_penetapan_nip')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. Surat Dokter</label>
																							<input type="text" name="no_surat_dokter" value="<?=validation_set_value_input('no_surat_dokter')?>" class="form-control <?=validation_error_class('no_surat_dokter')?>">
																							<?=validation_error_message('no_surat_dokter')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Surat Dokter</label>
																							<input type="date" name="tanggal_surat_dokter" value="<?=validation_set_value_input('tanggal_surat_dokter')?>" class="form-control <?=validation_error_class('tanggal_surat_dokter')?>" required="">
																							<?=validation_error_message('tanggal_surat_dokter')?>
																						</div>
																					</div>
																				</div>





																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label> No. STTPL </label>
																							<input type="text" name="no_sttpl" value="<?=validation_set_value_input('no_sttpl')?>" class="form-control <?=validation_error_class('no_sttpl')?>">
																							<?=validation_error_message('no_sttpl')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. STTPL</label>
																							<input type="date" name="tanggal_sttpl" value="<?=validation_set_value_input('tanggal_sttpl')?>" class="form-control <?=validation_error_class('tanggal_sttpl')?>" required="">
																							<?=validation_error_message('tanggal_sttpl')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label> No. SPMT </label>
																							<input type="text" name="no_spmt" value="<?=validation_set_value_input('no_spmt')?>" class="form-control <?=validation_error_class('no_spmt')?>">
																							<?=validation_error_message('no_spmt')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Tugas</label>
																							<input type="date" name="tanggal_tugas" value="<?=validation_set_value_input('tanggal_tugas')?>" class="form-control <?=validation_error_class('tanggal_tugas')?>" required="">
																							<?=validation_error_message('tanggal_tugas')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label> No. Pertimbangan Teknis CPNS PNS </label>
																							<input type="text" name="no_pt_cpns_pns" value="<?=validation_set_value_input('no_pt_cpns_pns')?>" class="form-control <?=validation_error_class('no_pt_cpns_pns')?>">
																							<?=validation_error_message('no_pt_cpns_pns')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label> Tgl Pertimbangan Teknis CPNS PNS </label>
																							<input type="date" name="tanggal_pt_cpns_pns" value="<?=validation_set_value_input('tanggal_pt_cpns_pns')?>" class="form-control <?=validation_error_class('tanggal_pt_cpns_pns')?>" required="">
																							<?=validation_error_message('tanggal_pt_cpns_pns')?>
																						</div>
																					</div>
																				</div>



																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. ASKES </label>
																							<input type="text" name="no_askes" value="<?=validation_set_value_input('no_askes')?>" class="form-control <?=validation_error_class('no_askes')?>">
																							<?=validation_error_message('no_askes')?>
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

											<!-- Step 4 -->
											<h6>Step 4</h6>
											<fieldset>
												<div class="card">
													<div class="card-content">
														<div class="card-body">
															<div class="row justify-content-center">
																<div class="col-12 col-md-8">
																	<h5 class="mt-2 mb-1 mt-sm-0"></h5>
																	<div class="row" style="margin-top: 32px">

																		<div class="col-12 col-sm-12">
																			<h5 class="mt-2 mb-1 mt-sm-0"></h5>
																			<div class="row" style="margin-top: 32px">
																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">Pangkat dan Golongan</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Gologan Awal </label>
																							<select class="form-control <?=validation_error_class('id_golongan_awal')?>" name="id_golongan_awal" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_golongan as $row): ?>
																									<option value="<?=$row->kode_golongan?>" <?=validation_set_value_select('id_golongan_awal',$row->kode_golongan)?>><?=$row->nama_golongan?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_golongan_awal')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Gologan Akhir </label>
																							<select class="form-control <?=validation_error_class('id_golongan_akhir')?>" name="id_golongan_akhir" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_golongan as $row): ?>
																									<option value="<?=$row->kode_golongan?>" <?=validation_set_value_select('id_golongan_akhir',$row->kode_golongan)?>><?=$row->nama_golongan?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_golongan_akhir')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT. Golongan </label>
																							<input type="date" name="tmt_golongan" value="<?=validation_set_value_input('tmt_golongan')?>" class="form-control <?=validation_error_class('tmt_golongan')?>" required="">
																							<?=validation_error_message('tmt_golongan')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Spesimen Kenaikan Pangkat </label>
																							<input type="text" name="spesimen_kenaikan_pangkat" value="<?=validation_set_value_input('spesimen_kenaikan_pangkat')?>" class="form-control <?=validation_error_class('spesimen_kenaikan_pangkat')?>">
																							<?=validation_error_message('spesimen_kenaikan_pangkat')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Eselon</label>
																							<select class="form-control <?=validation_error_class('id_eselon')?>" name="id_eselon" required="">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_eselon as $row): ?>
																									<option value="<?=$row->kode_eselon?>" <?=validation_set_value_select('id_eselon',$row->kode_eselon)?>><?=$row->nama_eselon?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_eselon')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT. Eselon </label>
																							<input type="date" name="tmt_eselon" value="<?=validation_set_value_input('tmt_eselon')?>" class="form-control <?=validation_error_class('tmt_eselon')?>" required="">
																							<?=validation_error_message('tmt_eselon')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Gaji Pokok</label>
																							<input type="text" name="gaji_pokok" value="<?=validation_set_value_input('gaji_pokok')?>" class="form-control <?=validation_error_class('gaji_pokok')?>">
																							<?=validation_error_message('gaji_pokok')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT Melaksakan Tugas</label>
																							<input type="date" name="tmt_melaksanakan_tugas" value="<?=validation_set_value_input('tmt_melaksanakan_tugas')?>" class="form-control <?=validation_error_class('tmt_melaksanakan_tugas')?>" required="">
																							<?=validation_error_message('tmt_melaksanakan_tugas')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Kredit Utama</label>
																							<input type="text" name="kredit_utama" value="<?=validation_set_value_input('kredit_utama')?>" class="form-control <?=validation_error_class('kredit_utama')?>">
																							<?=validation_error_message('kredit_utama')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Kredit Penunjang</label>
																							<input type="text" name="kredit_penunjang" value="<?=validation_set_value_input('kredit_penunjang')?>" class="form-control <?=validation_error_class('kredit_penunjang')?>">
																							<?=validation_error_message('kredit_penunjang')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">Jabatan</div>
																					</div>
																				</div>


																				<div class="col-md-12">
																					<div class="form-group">
																						<div class="controls">
																							<label>KPKN <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_kpkn')?>" name="id_kpkn" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_kpkn as $row): ?>
																									<option value="<?=$row->kode_kpkn?>" <?=validation_set_value_select('id_kpkn',$row->kode_kpkn)?>><?=$row->nama_kpkn?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_kpkn')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Instansi Kerja <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_instansi_kerja')?>" name="id_instansi_kerja" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_instansi as $row): ?>
																									<option value="<?=$row->kode_instansi?>" <?=validation_set_value_select('id_instansi_kerja',$row->kode_instansi)?>><?=$row->nama_instansi?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_instansi_kerja')?>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Instansi Induk <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_instansi_induk')?>" name="id_instansi_induk" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_instansi as $row): ?>
																									<option value="<?=$row->kode_instansi?>" <?=validation_set_value_select('id_instansi_induk',$row->kode_instansi)?>><?=$row->nama_instansi?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_instansi_induk')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Satuan Kerja <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_satuan_kerja')?>" name="id_satuan_kerja" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_satuankerja as $row): ?>
																									<option value="<?=$row->kode_satuankerja?>" <?=validation_set_value_select('id_satuan_kerja',$row->kode_satuankerja)?>><?=$row->nama_satuankerja?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_satuan_kerja')?>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Satuan Kerja Induk <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_satuan_kerja_induk')?>" name="id_satuan_kerja_induk" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_satuankerja as $row): ?>
																									<option value="<?=$row->kode_satuankerja?>" <?=validation_set_value_select('id_satuan_kerja_induk',$row->kode_satuankerja)?>><?=$row->nama_satuankerja?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_satuan_kerja_induk')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Unit Kerja <span class="text-danger">*</span></label>
																							<select class="form-control">
																								<option>Unit 1</option>
																								<option>Unit 2</option>								
																							</select>
																							<p id="err_nik" class="text-danger"></p>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Lokasi Kerja <span class="text-danger">*</span></label>
																							<select class="form-control select2_wizard <?=validation_error_class('id_lokasi_kerja')?>" name="id_lokasi_kerja" required="" style="width: 100%">
																								<option value="">Pilih</option>
																								<?php foreach ($ref_kelahiran as $row): ?>
																									<option value="<?=$row->kode_kelahiran?>" <?=validation_set_value_select('id_lokasi_kerja',$row->kode_kelahiran)?>><?=$row->nama_kelahiran?></option>
																								<?php endforeach ?>
																							</select>
																							<?=validation_error_message('id_lokasi_kerja')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Jabatan <span class="text-danger">*</span></label>
																							<select class="form-control">
																								<option>Jabatan 1</option>
																								<option>Jabatan 2</option>								
																							</select>
																							<p id="err_nik" class="text-danger"></p>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT Jabatan <span class="text-danger">*</span></label>
																							<input type="date" name="tmt_jabatan" value="<?=validation_set_value_input('tmt_jabatan')?>" class="form-control <?=validation_error_class('tmt_jabatan')?>" required="">
																							<?=validation_error_message('tmt_jabatan')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">Pensiun</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Masa Kerja Tahun <span class="text-danger">*</span></label>
																							<input type="text" name="masa_kerja_tahun" value="<?=validation_set_value_input('masa_kerja_tahun')?>" class="form-control <?=validation_error_class('masa_kerja_tahun')?>">
																							<?=validation_error_message('masa_kerja_tahun')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Masa Kerja Bulan <span class="text-danger">*</span></label>
																							<input type="text" name="masa_kerja_bulan" value="<?=validation_set_value_input('masa_kerja_bulan')?>" class="form-control <?=validation_error_class('masa_kerja_bulan')?>">
																							<?=validation_error_message('masa_kerja_bulan')?>
																						</div>
																					</div>
																				</div>


																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Sudah DPCP</label>
																							<ul class="list-unstyled mb-0 <?=validation_error_class('sudah_dpcp')?>">
																								<li class="d-inline-block mr-2">
																									<fieldset>
																										<div class="vs-radio-con">
																											<input type="radio" name="sudah_dpcp" value="Y" <?=validation_set_value_radio('sudah_dpcp','Y')?>>
																											<span class="vs-radio">
																												<span class="vs-radio--border"></span>
																												<span class="vs-radio--circle"></span>
																											</span>
																											<span class="">Ya </span>
																										</div>
																									</fieldset>
																								</li>
																								<li class="d-inline-block mr-2">
																									<fieldset>
																										<div class="vs-radio-con">
																											<input type="radio" name="sudah_dpcp" value="T" <?=validation_set_value_radio('sudah_dpcp','T')?>>
																											<span class="vs-radio">
																												<span class="vs-radio--border"></span>
																												<span class="vs-radio--circle"></span>
																											</span>
																											<span class="">Tidak</span>
																										</div>
																									</fieldset>
																								</li>                                     
																							</ul>
																							<?=validation_error_message('sudah_dpcp')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Spesimen Pensiun </label>
																							<input type="text" name="spesimen_pensiun" value="<?=validation_set_value_input('spesimen_pensiun')?>" class="form-control <?=validation_error_class('spesimen_pensiun')?>">
																							<?=validation_error_message('spesimen_pensiun')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. Taspen </label>
																							<input type="text" name="no_taspen" value="<?=validation_set_value_input('no_taspen')?>" class="form-control <?=validation_error_class('no_taspen')?>">
																							<?=validation_error_message('no_taspen')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>TMT Pensiun </label>
																							<input type="date" name="tmt_pensiun" value="<?=validation_set_value_input('tmt_pensiun')?>" class="form-control <?=validation_error_class('tmt_pensiun')?>" required="">
																							<?=validation_error_message('tmt_pensiun')?>
																						</div>
																					</div>
																				</div>




																				<div class="col-md-12">
																					<div class="divider divider-primary">
																						<div class="divider-text">Lainnya</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. SK Konveksi </label>
																							<input type="text" name="no_sk_konveksi" value="<?=validation_set_value_input('no_sk_konveksi')?>" class="form-control <?=validation_error_class('no_sk_konveksi')?>">
																							<?=validation_error_message('no_sk_konveksi')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>No. Urut Konveksi </label>
																							<input type="text" name="no_urut_konveksi" value="<?=validation_set_value_input('no_urut_konveksi')?>" class="form-control <?=validation_error_class('no_urut_konveksi')?>">
																							<?=validation_error_message('no_urut_konveksi')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. SK Konveksi </label>
																							<input type="date" name="tanggal_konveksi" value="<?=validation_set_value_input('tanggal_konveksi')?>" class="form-control <?=validation_error_class('tanggal_konveksi')?>" required="">
																							<?=validation_error_message('tanggal_konveksi')?>
																						</div>
																					</div>
																				</div>

																				<div class="col-md-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>Tgl. Perbaikan SK </label>
																							<input type="date" name="tanggal_perbaikan_sk" value="<?=validation_set_value_input('tanggal_perbaikan_sk')?>" class="form-control <?=validation_error_class('tanggal_perbaikan_sk')?>" required="">
																							<?=validation_error_message('tanggal_perbaikan_sk')?>
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

	<script type="text/javascript" defer>
		function search_ktp() {
			var id = $('#id_kartu_identitas').val();
			var no = $('#no_kartu_identitas').val();
			if (id != '' && no != '') {
				window.location.replace(encodeURI("<?=base_url('master_pegawai/add_pegawai')?>/"+id+"/"+no));
			} else {
				swal('Maaf!','Isi field terlebih dahulu.','error')
			}
		}
		document.addEventListener('DOMContentLoaded', function(){ 
			<?php if (isset($search_data) AND $search_data->pns != "Y"): ?>
				$('#wizard-tambah-pegawai-2').find('a[href="#next"]').show();
				<?php else: ?>
					$('#wizard-tambah-pegawai-2').find('a[href="#next"]').hide();
				<?php endif ?>
			}, false);
		</script>

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