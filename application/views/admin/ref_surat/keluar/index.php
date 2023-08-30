
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Internal</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Surat Internal</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<div class="row">

							<form method="POST">

								<div class="col-md-10">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
                        <label class="control-label">Nama Surat</label>
                        <input type="text" id="" class="form-control" placeholder="">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Tgl. Penerimaan Surat</label>
												<input type="text" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Pengirim</label>
												<select class="form-control select2">
                                <option>Select</option>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                </optgroup>
                        </select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Penerima</label>
												<select class="form-control select2">
																<option>Select</option>
																<optgroup label="Alaskan/Hawaiian Time Zone">
																		<option value="AK">Alaska</option>
																		<option value="HI">Hawaii</option>
																</optgroup>
																<optgroup label="Pacific Time Zone">
																		<option value="CA">California</option>
																		<option value="NV">Nevada</option>
																</optgroup>
																<optgroup label="Mountain Time Zone">
																		<option value="AZ">Arizona</option>
																		<option value="CO">Colorado</option>
																</optgroup>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2 b-l text-center">
									<div class="form-group">
										<br>
										<button type="submit" class="btn btn-primary m-t-5 btn-outline">Filter</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="row">
					<a href="<?php echo base_url('surat_internal/kategori_surat_keluar');?>" class="btn btn-primary btn-block"> Tambah Surat Keluar Internal</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="white-box">
					<div class="row" >
						<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;" >
							<img src="<?php echo base_url('asset/logo/surat.png');?>" width="80px" height="60px" alt="">
						</div>
						<div class="col-md-10 col-sm-10"  >
							<div class="row b-b">
								<div class="col-md-12 text-center">
									Status Surat
								</div>
							</div>
							<div class="row">
								<div class="col-md-3 text-center b-r">
									<h3 class="box-title m-b-0">3</h3>
									Total Surat
								</div>
								<div class="col-md-3 text-center b-r">
									<h3 class="box-title m-b-0">4</h3>
									Sudah dibaca
								</div>
								<div class="col-md-3 text-center b-r ">
									<h3 class="box-title m-b-0">5</h3>
									Sudah dibaca
								</div>
								<div class="col-md-3 text-center b-r ">
									<h3 class="box-title m-b-0">5</h3>
									Perlu tanggapan
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_content">
						<div class="col-md-4 col-sm-6" >
							<div class="panel panel-primary">
								<div class="panel-heading">
									Sudah dibaca
									<span class="badge pull-right" style="background-color: white;color:black;">penting</span>
								</div>
								<div class="panel-body">
									<div class="row b-b" style="min-height: 30px;">
										<div class="col-md-4 col-sm-4 text-center b-r">
											<i data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#6003c8;"></i>
										</div>
										<div class="col-md-8 col-sm-8"  >
											<h5>Surat Undangan Sosialisasi
																									Pembayaran Retribusi Melalui
																									ATM dan Mobile Bank </h5>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>Bank BJB Cabang Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>DPMTSP Kab. Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>renstra_perencanaan/view">
													<a href="<?php echo base_url('surat_internal/detail_masuk');?>" class="fcbtn btn btn-primary btn-outline btn-1b btn-block">Detail Surat</a>
												</a>
											</address>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="panel panel-danger">
								<div class="panel-heading">
									Belum dibaca
									<span class="badge pull-right" style="background-color: white;color:black;">biasa</span>
								</div>
								<div class="panel-body">
									<div class="row b-b" style="min-height: 30px;">
										<div class="col-md-4 col-sm-4 text-center b-r">
											<i data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#f75b36;"></i>
										</div>
										<div class="col-md-8 col-sm-8"  >
											<h5>Surat Undangan Sosialisasi
																									Pembayaran Retribusi Melalui
																									ATM dan Mobile Bank </h5>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>Bank BJB Cabang Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>DPMTSP Kab. Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>renstra_perencanaan/view">
													<a href="<?php echo base_url('surat_internal/detail_masuk');?>" class="fcbtn btn btn-danger btn-outline btn-1b btn-block">Detail Surat</a>
												</a>
											</address>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="panel panel-warning">
								<div class="panel-heading">
									Perlu Tanggapan
								</div>
								<div class="panel-body">
									<div class="row b-b" style="min-height: 30px;">
										<div class="col-md-4 col-sm-4 text-center b-r">
											<i data-icon="&" class="linea-icon linea-basic" style="font-size:80px;color:#f8c255;"></i>
										</div>
										<div class="col-md-8 col-sm-8"  >
											<h5>Surat Undangan Sosialisasi
																									Pembayaran Retribusi Melalui
																									ATM dan Mobile Bank </h5>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>Bank BJB Cabang Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row b-b">
										<div class="col-md-12 text-center">
											<h6>Pengirim</h6>
											<h5>DPMTSP Kab. Sumedang</h5>
											<span class="badge" style="background-color: grey;font-size:10px;">22 april 2019</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<br>
											<address>
												<a href="<?php echo base_url();?>renstra_perencanaan/view">
													<a href="<?php echo base_url('surat_internal/detail_masuk');?>" class="fcbtn btn btn-warning btn-outline btn-1b btn-block">Detail Surat</a>
												</a>
											</address>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col -->
					</div>

				</div>
