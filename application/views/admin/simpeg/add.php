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
								<li class="breadcrumb-item"><a href="<?=base_url();?>simpeg/">Home</a>
								</li>
								<li class="breadcrumb-item "><a href="<?=base_url();?>simpeg/detail">Tambah Pegawai</a></li>
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
									<form id="wizard-tambah-pegawai-1" action="#" class="wizard-circle">

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
																<a href="<?=base_url('simpeg/add_orang')?>" class="btn gradient-light-success btn-block mt-2">Pilih</a>
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
																<a href="<?=base_url('simpeg/add_pegawai')?>" class="btn gradient-light-success btn-block mt-2">Pilih</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</fieldset>

										<!-- Step 2 -->
										<h6>Step 2</h6>
										<fieldset>
										</fieldset>

										<!-- Step 3 -->
										<h6>Step 3</h6>
										<fieldset>
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