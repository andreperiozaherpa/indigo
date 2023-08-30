<div class="app-content content">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-md-12">
						<h2 class="content-header-title float-left mb-0">Detail Pegawai</h2>
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?=base_url();?>master_pegawai/">Home</a>
								</li>
								<li class="breadcrumb-item "><a href="<?=base_url();?>master_pegawai/detail">Detail Pegawai</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>

		</div>
		
		<div class="content-body">

			<section class="users-edit">
				<div class="card">
					<div class="card-content">
						<div class="card-body">

							<form class="" id="form-data">
								<div class="row mt-1">

									<div class="col-12 col-sm-6">
										<h5 class="mb-1"><i class="feather icon-user mr-25"></i>Biodata</h5>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="controls">
														<label>Nama Lengkap <span class="text-danger">*</span></label>
														<input type="text" name="nama_mentor" id="nama_mentor" class="form-control birthdate-picker" placeholder="Masukkan Nama Lengkap">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Jenis Kelamin <span class="text-danger">*</span></label>
														<ul class="list-unstyled mb-0">
															<li class="d-inline-block mr-2">
																<fieldset>
																	<div class="vs-radio-con">
																		<input type="radio" name="vueradio" checked="" value="false">
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
																		<input type="radio" name="vueradio" value="false">
																		<span class="vs-radio">
																			<span class="vs-radio--border"></span>
																			<span class="vs-radio--circle"></span>
																		</span>
																		<span class="">Perempuan</span>
																	</div>
																</fieldset>
															</li>                                     
														</ul>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label> Agama <span class="text-danger">*</span></label>
														<select class="form-control">
															<option>1</option>
															<option>2</option>
														</select>
														<p id="err_alamat" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tanggal Lahir<span class="text-danger">*</span></label>
														<input type="date" name="#" class="form-control" >
														<p id="" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label><i class="feather icon-map-pin"></i> Tempat Lahir <span class="text-danger">*</span></label>
														<select class="form-control">
															<option>Kabupaten 1</option>
															<option>Kabupaten 2</option>

														</select>
														<p id="err_alamat" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Alamat Lengkap <span class="text-danger">*</span></label>
														<textarea class="form-control"></textarea>
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Kode Pos <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control birthdate-picker" placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Akta Kelahiran <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Akta Kematian <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>tgl. Kematian <span class="text-danger">*</span></label>
														<input type="date" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-12">
												<div class="divider divider-primary">
													<div class="divider-text">Pendidikan</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Gelar Depan <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Gelar Belakang <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tingkat Pendidikan <span class="text-danger">*</span></label>
														<select class="form-control">
															<option>SD</option>
															<option>SMP</option>

														</select>
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Pendidikan Terakhir<span class="text-danger">*</span></label>
														<select class="form-control">
															<option>SD</option>
															<option>SMP</option>

														</select>
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tgl.  Kelulusan <span class="text-danger">*</span></label>
														<input type="date" name="" id="" class="form-control" placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
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
														<input type="text" name="" id="" class="form-control birthdate-picker" placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Nama Ibu <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="Masukkan Nama Lengkap">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Jenis Anak <span class="text-danger">*</span></label>
														<select class="form-control">
															<option>Jenis 1</option>
															<option>Jenis 2</option>
														</select>
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Anak Tanggungan <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="Masukkan Nama Lengkap">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Karis / Karsu<span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="Masukkan Nama Lengkap">
														<p id="err_nama_mentor" class="text-danger"></p>
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
														<label>No. HP <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Telp <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>e-mail <span class="text-danger">*</span></label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

										</div>

										
									</div>
									<div class="col-12 col-sm-6">
										<h5 class="mt-2 mb-1 mt-sm-0"></h5>
										<div class="row" style="margin-top: 32px">
											<div class="col-md-12">
												<div class="form-group">
													<div class="controls">
														<label>No. KTP</label>
														<input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan Nomor KTP">
														<p id="err_nik" class="text-danger"></p>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>NPWP</label>
														<input type="text" name="" id="nik" class="form-control" placeholder="">
														<p id="err_nik" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tgl. NPWP</label>
														<input type="date" name="nik" id="nik" class="form-control" placeholder="">
														<p id="err_nik" class="text-danger"></p>
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
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Faskes BPJS </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Kelas BPJS </label>
														<select class="form-control">
															<option>kelas 1</option>
															<option>kelas 2</option>								
														</select>
														<p id="err_nama_mentor" class="text-danger"></p>
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
														<label>Ket. Tanggal Sehat </label>
														<input type="date" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Ket. Sehat Dokter </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Bebas Narkoba </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tgl . Ket Bebas Narkoba </label>
														<input type="date" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Bebas Narkoba </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Tgl . Ket Kelakuan Baik </label>
														<input type="date" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>No. Ket. Kelakuan Baik </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
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
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Twitter </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
													</div>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<div class="controls">
														<label>Instagram </label>
														<input type="text" name="" id="" class="form-control " placeholder="">
														<p id="err_nama_mentor" class="text-danger"></p>
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
														<div class="dropify-wrapper"<input type="file" class="dropify form-control" name="foto" id="foto"></div>
														<small class="">* jpg,jpeg,png | Max: 1000 Kb</small>
														<p id="err_foto" class="text-danger"></p>
													</div>
												</div>

											</div>
										</div>


									</div>

									


									<!-- users edit Info form ends -->
								</div>
							</div>
						</div>


					</section>

					<section>
						<div class="card">
							<div class="card-content">
								<div class="card-body">

									<form class="" id="form-data">
										<div class="row mt-1">

											<div class="col-12 col-sm-6">
												<h5 class="mb-1"><i class="feather icon-user mr-25"></i>Data PNS</h5>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>NIP Baru<span class="text-danger">*</span></label>
																<input type="text" name="" id="" class="form-control birthdate-picker" placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>NIP Lama <span class="text-danger">*</span></label>
																<input type="text" name="" id="" class="form-control" placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Kartu Pegawai Elektronik <span class="text-danger">*</span></label>
																<input type="text" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Kartu Pegawai <span class="text-danger">*</span></label>
																<input type="text" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>


													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label><i class="feather icon-map-pin"></i> Jenis Pegawai <span class="text-danger">*</span></label>
																<select class="form-control">
																	<option> 1</option>
																	<option> 2</option>

																</select>
																<p id="err_alamat" class="text-danger"></p>
															</div>
														</div>
													</div>


													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label><i class="feather icon-map-pin"></i> Kedudukan Hukum <span class="text-danger">*</span></label>
																<select class="form-control">
																	<option>1</option>
																	<option>2</option>

																</select>
																<p id="err_alamat" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label><i class="feather icon-map-pin"></i> Jenis Pengadaan <span class="text-danger">*</span></label>
																<select class="form-control">
																	<option>1</option>
																	<option>2</option>

																</select>
																<p id="err_alamat" class="text-danger"></p>
															</div>
														</div>
													</div>


													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Status <span class="text-danger">*</span></label>
																<ul class="list-unstyled mb-0">
																	<li class="d-inline-block mr-2">
																		<fieldset>
																			<div class="vs-radio-con">
																				<input type="radio" name="vueradio" checked="" value="false">
																				<span class="vs-radio">
																					<span class="vs-radio--border"></span>
																					<span class="vs-radio--circle"></span>
																				</span>
																				<span class="">CPNS</span>
																			</div>
																		</fieldset>
																	</li>
																	<li class="d-inline-block mr-2">
																		<fieldset>
																			<div class="vs-radio-con">
																				<input type="radio" name="vueradio" value="false">
																				<span class="vs-radio">
																					<span class="vs-radio--border"></span>
																					<span class="vs-radio--circle"></span>
																				</span>
																				<span class="">PNS</span>
																			</div>
																		</fieldset>
																	</li>                                     
																</ul>
															</div>
														</div>
													</div>

													<div class="col-md-12">
														<div class="divider divider-primary">
															<div class="divider-text">CPNS</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label> No. SK CPNS <span class="text-danger">*</span></label>
																<input type="text" name="" id="" class="form-control" placeholder="">
																<p id="err_alamat" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Tgl. SK CPNS <span class="text-danger">*</span></label>
																<input type="date" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>TMT CPNS <span class="text-danger">*</span></label>
																<input type="date" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>No. Nota Persetujuan CPNS <span class="text-danger">*</span></label>
																<input type="text" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Tgl. Nota Persetujuan CPNS <span class="text-danger">*</span></label>
																<input type="date" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Spesimen Pejabat CPNS <span class="text-danger">*</span></label>
																<input type="text" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Spesimen Pengadaan <span class="text-danger">*</span></label>
																<input type="text" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div>
													</div>





													<div class="col-md-12">
														<div class="divider divider-primary">
															<div class="divider-text">PNS</div>
														</div>
													</div>

													

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label> No. SK PNS <span class="text-danger">*</span></label>
																<input type="text" name="" id="" class="form-control" placeholder="">
																<p id="err_alamat" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Tgl. SK PNS <span class="text-danger">*</span></label>
																<input type="date" name="#" class="form-control" >
																<p id="" class="text-danger"></p>
															</div>
														</div> </div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>TMT PNS <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>No. Nota Persetujuan PNS <span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Tgl. Nota Persetujuan PNS <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Tgl. Penetapan NIP <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Spesimen NIP <span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>No. Surat Dokter <span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Tgl. Surat Dokter <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>





														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label> No. STTPL <span class="text-danger">*</span></label>
																	<input type="text" name="" id="" class="form-control" placeholder="">
																	<p id="err_alamat" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Tgl. STTPL <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Tgl. Tugas <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label> No. Pertimbangan Teknis CPNS PNS <span class="text-danger">*</span></label>
																	<input type="text" name="" id="" class="form-control" placeholder="">
																	<p id="err_alamat" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label> Tgl Pertimbangan Teknis CPNS PNS <span class="text-danger">*</span></label>
																	<input type="date" name="" id="" class="form-control" placeholder="">
																	<p id="err_alamat" class="text-danger"></p>
																</div>
															</div>
														</div>



														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>No. ASKES <span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>



													</div>

												</div>
												<div class="col-12 col-sm-6">
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
																	<label>Gologan Awal <span class="text-danger">*</span></label>
																	<select class="form-control">
																		<option>Gol 1</option>
																		<option>Gol 2</option>

																	</select>
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Gologan Akhir <span class="text-danger">*</span></label>
																	<select class="form-control">
																		<option>Gol 1</option>
																		<option>Gol 2</option>

																	</select>
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>TMT. Golongan <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Spesimen Kenaikan Pangkat </label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Eselon<span class="text-danger">*</span></label>
																	<select class="form-control">
																		<option>Eselon 1</option>
																		<option>Eselon 2</option>
																	</select>
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>TMT. Eselon <span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Gajih Pokok<span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>TMT Melaksakan Tugas<span class="text-danger">*</span></label>
																	<input type="date" name="#" class="form-control" >
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Kredit Utama<span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Kredit Penunjang<span class="text-danger">*</span></label>
																	<input type="text" name="#" class="form-control" >
																	<p id="err_nama_mentor" class="text-danger"></p>
																</div>
															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Instansi Kerja</label>
																	<select class="form-control">
																		<option>Instansi 1</option>
																		<option>Instansi 2</option>								
																	</select>
																</p>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Instansi Induk</label>
																<select class="form-control">
																	<option>Instansi 1</option>
																	<option>Instansi 2</option>								
																</select>
																<p id="err_nik" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Satuan Kerja</label>
																	<select class="form-control">
																		<option>Satker 1</option>
																		<option>Satker 2</option>								
																	</select>
																</p>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Satuan Kerja Induk</label>
																<select class="form-control">
																	<option>Satker 1</option>
																	<option>Satker 2</option>								
																</select>
																<p id="err_nik" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Unit Kerja</label>
																<select class="form-control">
																	<option>Instansi 1</option>
																	<option>Instansi 2</option>								
																</select>
																<p id="err_nik" class="text-danger"></p>
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
																<label>Masa Kerja Tahun</label>
																<input type="text" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Masa Kerja Bulan </label>
																<input type="text" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>


													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Sudah DPCP<span class="text-danger">*</span></label>
																<ul class="list-unstyled mb-0">
																	<li class="d-inline-block mr-2">
																		<fieldset>
																			<div class="vs-radio-con">
																				<input type="radio" name="vueradio" checked="" value="false">
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
																				<input type="radio" name="vueradio" value="false">
																				<span class="vs-radio">
																					<span class="vs-radio--border"></span>
																					<span class="vs-radio--circle"></span>
																				</span>
																				<span class="">Tidak</span>
																			</div>
																		</fieldset>
																	</li>                                     
																</ul>
															</div>
														</div>
													</div>

													<div class="col-md-6">
															<div class="form-group">
																<div class="controls">
																	<label>Spesimen Pensiun </label>
																	<input type="text" name="#" class="form-control" >
																	<p id="" class="text-danger"></p>
																</div>
															</div>
														</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>No. Taspen </label>
																<input type="text" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>TMT Pensiun </label>
																<input type="date" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>




													<div class="col-md-12">
														<div class="divider divider-primary">
															<div class="divider-text">Lainya</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>No. SK Konveksi </label>
																<input type="text" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>No. Urut Konveksi </label>
																<input type="text" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Tgl. SK Konveksi </label>
																<input type="date" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<div class="controls">
																<label>Tgl. Perbaikan SK </label>
																<input type="date" name="" id="" class="form-control " placeholder="">
																<p id="err_nama_mentor" class="text-danger"></p>
															</div>
														</div>
													</div>
													

												</div>


											</div>

										</form>

										<div class="row">
											<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
												<button id="btn_save" type="submit" onclick="save()" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-light">Simpan</button>
												<a href="http://119.235.16.116:84/ref_mentor" class="btn btn-outline-warning waves-effect waves-light">Kembali</a>
											</div>
										</div>

										<!-- users edit Info form ends -->
									</div>
								</div>
							</div>
						</section>
					</div>

				</div>

				<!-- page users view end -->




			</div>
		</div>