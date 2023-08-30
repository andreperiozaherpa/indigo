<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail ASN Pendaftar</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>talenta/pendaftar">ASN Pendaftar</a>
				</li>
				<li class="active">		
					<strong>Detail</strong>
				</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?=base_url('talenta/pendaftar')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
			<br><br><br>
			<div class="white-box">
				<div class="text-center">
					<small><b style="color: #6003c8" >SELEKSI UNTUK</b></small>
					<br>

					<span style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon <?= $dt_pendaftaran->eselon;?></span>
					<span style="margin-right: 10px;"><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> <?= $dt_pendaftaran->nama_skpd;?></span>
					<span><i style="color: #6003c8" class="ti-bar-chart"></i> <?= $dt_pendaftaran->nama_jabatan;?></span>
				</div>
			</div>
			<div class="white-box">
				<div class="user-bg"> <img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
					<div class="overlay-box">
						<div class="col-md-3">
							<div class="user-content"> <a href="javascript:void(0)"><img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/<?= $pegawai['foto_pegawai'];?>" class="thumb-lg img-circle" style=" object-fit: cover;
							width: 80px;
							height: 80px;border-radius: 50%;
							" alt="img">
							<h5 class="text-white"><b><?= $pegawai['nama_lengkap'];?> </b></h5>
							<h6 class="text-white"><?= $pegawai['nip'];?></h6>
						</div>
					</div>
					<div class="col-md-3" style="border-right: 1px solid grey;border-left: 1px solid grey;">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>SKPD</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_skpd'];?></h6>
						</div>
					</div>
					<div class="col-md-3" style="border-right: 1px solid grey;">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>Unit Kerja</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_unit_kerja'];?></h6>
						</div>
					</div>
					<div class="col-md-3">
						<br>
						<div class="user-content" style="padding-bottom:15px;">
							<h5 class="text-white"><b>Jabatan</b></h5>
							<h6 class="text-white"><?= $pegawai['nama_jabatan'];?></h6>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

</div>
<div class="row">
	<div class="col-lg-12 col-sm-12 col-xs-12">
		<div class="white-box">
			<div class="panel panel-inverse">
				<div class="panel-heading text-center">
					Data Kepegawaian
				</div>
			</div>
			<!-- <p class="text-muted m-b-30">Use default tab with class <code>customtab</code></p> -->
			<!-- Nav tabs -->
			<ul class="nav customtab nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#biodata1" aria-controls="biodata" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-user"></i></span><span class="hidden-xs">Biodata</span></a></li>
				<li role="presentation" class=""><a href="#pangkat1" aria-controls="pangkat" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-star"></i></span> <span class="hidden-xs">Pangkat</span></a></li>
				<li role="presentation"  class=""><a href="#jabatan1" aria-controls="jabatan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-id-badge"></i></span> <span class="hidden-xs">Jabatan</span></a></li>
				<li role="presentation" class=""><a href="#pendidikan1" aria-controls="pendidikan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-briefcase"></i></span> <span class="hidden-xs">Pendidikan</span></a></li>
				<li role="presentation" class=""><a href="#latihan1" aria-controls="latihan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-flag-alt"></i></span> <span class="hidden-xs">Latihan</span></a></li>
				<li role="presentation" class=""><a href="#unit_kerja1" aria-controls="unit_kerja" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-bookmark"></i></span> <span class="hidden-xs">Unit Kerja</span></a></li>
				<li role="presentation" class=""><a href="#penghargaan1" aria-controls="penghargaan" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-medall"></i></span> <span class="hidden-xs">Penghargaan</span></a></li>
				<li role="presentation" class=""><a href="#absen1" aria-controls="absen" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-check-box"></i></span> <span class="hidden-xs">Absen</span></a></li>
				<li role="presentation" class=""><a href="#bahasa1" aria-controls="bahasa" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-themify-favicon"></i></span> <span class="hidden-xs">Bahasa</span></a></li>
				<li role="presentation" class=""><a href="#keluarga1" aria-controls="keluarga" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-heart"></i></span> <span class="hidden-xs">Keluarga</span></a></li>
				<!-- <li role="presentation" class=""><a href="#berkas1" aria-controls="berkas" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-package"></i></span> <span class="hidden-xs">Berkas</span></a></li> -->
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="biodata1">
					<div id="list_biodata">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
									<div class="panel-wrapper collapse in" aria-expanded="true">
										<div class="panel-body">
											<form class="form-horizontal" role="form">
												<div class="form-body">
													<h3 class="box-title">Nama Lengkap &amp; Gelar</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label col-md-6">Gelar di depan nama :</label>
																<div class="col-md-6">
																	<p class="form-control-static"><?= ($pegawai['nama_gelardepan']!="") ? $pegawai['nama_gelardepan'] : "-";?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label col-md-6">Nama Lengkap :</label>
																<div class="col-md-6">
																	<p class="form-control-static"> <?= $pegawai['nama_lengkap'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label col-md-6">Gelar di belakang nama :</label>
																<div class="col-md-6">
																	<p class="form-control-static"> <?= ($pegawai['nama_gelarbelakang']!="") ? $pegawai['nama_gelarbelakang'] : "-";?>  </p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-6">Tempat Lahir :</label>
																<div class="col-md-6">
																	<p class="form-control-static"> <?= $pegawai['tempat_lahir'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-6">Tanggal Lahir :</label>
																<div class="col-md-6">
																	<p class="form-control-static"> <?= ($pegawai['tgl_lahir']!="") ? date('d M Y',strtotime($pegawai['tgl_lahir'])) : "";?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-6">Agama :</label>
																<div class="col-md-6">
																	<p class="form-control-static"><?= $pegawai['nama_agama'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-6">Jenis Kelamin :</label>
																<div class="col-md-6"><?= $pegawai['jk'];?>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<h3 class="box-title">Alamat</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-3">Alamat:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['alamat'];?></p>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">RT:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['RT'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">RW:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['RW'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Kode Pos:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['kode_pos'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Telepon:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['telepon'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Provinsi:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['provinsi'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Kabupaten/Kota</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['kabupaten'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Kecamatan:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['kecamatan'];?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Kelurahan/Desa</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['desa'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<h3 class="box-title">Keluarga</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-4">Status Perkawinan:</label>
																<div class="col-md-8">
																	<p class="form-control-static"><?= $pegawai['nama_statusmenikah'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-4">Jumlah Tanggungan Anak:</label>
																<div class="col-md-8">
																	<p class="form-control-static"><?= $pegawai['jml_tanggungan_anak'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-12">
															<div class="form-group">
																<label class="control-label col-md-4">Jumlah Seluruh Anak:</label>
																<div class="col-md-8">
																	<p class="form-control-static"><?= $pegawai['jml_seluruh_anak'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<h3 class="box-title">Kedudukan Pegawai</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Status:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['status_pegawai'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Kategori:</label>
																<div class="col-md-9">
																	<p class="form-control-static"> <?=isset($pegawai['kedudukan_pegawai']) ? $pegawai['kedudukan_pegawai'] : "-" ?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<h3 class="box-title">Pengangkatan CPNS</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">TMT:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= date('d M Y',strtotime($pegawai['cpns_tmt']));?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">No. Persetujuan BAKN:</label>
																<div class="col-md-9">
																	<p class="form-control-static"> <?= $pegawai['cpns_no_bakn'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Gol. Ruang:</label>
																<div class="col-md-9"><?= $pegawai['pangkat_cpns'] ;?>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Pejabat:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['cpns_pejabat'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">No. SK CPNS:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['cpns_no_sk'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Pendidikan Saat CPNS:</label>
																<div class="col-md-9"><?= ($pegawai['cpns_tahun_pendidikan']!="0000-00-00") ? date('d M Y',strtotime($pegawai['cpns_tahun_pendidikan'])) : "-";?>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Masa Kerja (Tahun):</label>
																<div class="col-md-9">
																	<p class="form-control-static"> - </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Masa Kerja (Bulan):</label>
																<div class="col-md-9">
																	<p class="form-control-static"> - </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Tahun Lulus Pendidikan:</label>
																<div class="col-md-9">
																	<p class="form-control-static">-</p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<h3 class="box-title">Pengangkatan PNS</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">TMT:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= date('d M Y',strtotime($pegawai['pns_tmt']));?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Gol. Ruang:</label>
																<div class="col-md-9"><?= $pegawai['pangkat_pns'];?></div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Pejabat:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><? $pegawai['pns_pejabat'];?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">No. SK:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['pns_no_sk'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
														</div>
														<!--/row-->
														<h3 class="box-title">Nomor Induk Pegawai (NIP)</h3>
														<hr class="m-t-0 m-b-40">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Lama:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['nip_lama'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Baru:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['nip'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Karpeg:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['karpeg'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
														</div>
														<!--/row-->
														<h3 class="box-title">Nomor-nomor Kartu</h3>
														<hr class="m-t-0 m-b-40">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Kartu ASKES:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['kartu_askes'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">Kartu TASPEN:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['kartu_taspen'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">KARIS/KARSU:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['karis_karsu'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-md-3">NPWP:</label>
																	<div class="col-md-9">
																		<p class="form-control-static"><?= $pegawai['npwp'] ;?></p>
																	</div>
																</div>
															</div>
															<!--/span-->
														</div>
														<!--/row-->
														<h3 class="box-title">Riwayat Pendidikan Terakhir</h3>
														<hr class="m-t-0 m-b-40"> <div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Jenjang Pendidikan:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['nama_jenjangpendidikan'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Nama Sekolah:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['nama_tempatpendidikan'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Jurusan:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['nama_jurusan'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">No Ijazah:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['nomor_ijazah'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Tahun Lulus:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= ($pegawai['tgl_ijazah']!="0000-00-00") ? date('Y',strtotime($pegawai['tgl_ijazah'])) :"-" ;?> </p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Pejabat Penetapan:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['nama_pejabat_pendidikan'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->

													<h3 class="box-title">Riwayat Pangkat Terakhir</h3>
													<hr class="m-t-0 m-b-40">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Pangkat:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['riwayat_pangkat'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">TMT:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= ($pegawai['riwayat_pangkat_tmt']!="0000-00-00") ? date('d M Y', strtotime( $pegawai['riwayat_pangkat_tmt'])) : "-";?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Golongan:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['riwayat_pangkat_golongan'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">No. SK:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['riwayat_pangkat_no_sk'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Tgl. SK:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= ($pegawai['riwayat_pangkat_tgl_sk']!="0000-00-00") ? date('d M Y', strtotime( $pegawai['riwayat_pangkat_tgl_sk'])) : "-";?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Pejabat Penetap:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['riwayat_pangkat_nama_pejabat'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
														<div class="col-md-6">
															<div class="form-group">
																<label class="control-label col-md-3">Gaji Pokok:</label>
																<div class="col-md-9">
																	<p class="form-control-static"><?= $pegawai['riwayat_pangkat_gaji_pokok'];?></p>
																</div>
															</div>
														</div>
														<!--/span-->
													</div>
													<!--/row-->
													<hr class="m-t-0 m-b-40"><div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Jabatan:</label>
															<div class="col-md-9">
																<p class="form-control-static"><?= $pegawai['riwayat_jabatan'];?></p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">TMT:</label>
															<div class="col-md-9">
																<p class="form-control-static"><?= ($pegawai['riwayat_jabatan_tmt']!="0000-00-00") ? date('d M Y', strtotime( $pegawai['riwayat_jabatan_tmt'])) : "-";?></p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">No. SK:</label>
															<div class="col-md-9">
																<p class="form-control-static"><?= $pegawai['riwayat_jabatan_no_sk'];?></p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Tgl. SK:</label>
															<div class="col-md-9">
																<p class="form-control-static"><?= ($pegawai['riwayat_jabatan_tgl_sk']!="0000-00-00") ? date('d M Y', strtotime( $pegawai['riwayat_jabatan_tgl_sk'])) : "-";?></p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Pejabat Penetap:</label>
															<div class="col-md-9">
																<p class="form-control-static"><?= $pegawai['riwayat_jabatan_nama_pejabat'];?></p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Uraian Jabatan:</label>
															<div class="col-md-9">
																<p class="form-control-static"> - </p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row--><hr class="m-t-0 m-b-40">
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="pangkat1">
					<div id="table_riwayat_pangkat">
						<div class="table-responsive">
						<table class="table color-table primary-table">
							<thead>
								<tr>
									<th rowspan="2">#</th>
									<th rowspan="2">Golongan Ruang</th>
									<th rowspan="2">Pangkat</th>
									<th rowspan="2">Berlaku TMT</th>
									<th rowspan="2">Gaji Pokok</th>
									<th rowspan="2">Nama Pejabat</th>
									<th rowspan="2">No. SK</th>
									<th rowspan="2">Tgl. SK</th>
									<th colspan="2" class="text-center">Verifikasi</th>
									<th rowspan="2">File Lampiran</th>
									<th rowspan="2">Catatan</th>
									
								</tr>
								<tr>
									<th>BKD</th>
									<th>Pegawai</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$i = 1;
								foreach($dt_riwayat_pangkat as $row){
									$verifikasi_bkd = '<span class="label label-danger"><i class="ti ti-close"></i> </span>';
									if($row->verifikasi_bkd!=null || $row->verifikasi_bkd=="true"){
										$verifikasi_bkd = '<span class="label label-success"><i class="fa fa-check"></i> </span>';
									}
									
									$verifikasi_pegawai = '<span class="label label-danger"><i class="ti ti-close"></i> </span>';
									if($row->verifikasi_pegawai!=null || $row->verifikasi_pegawai=="true"){
										$verifikasi_pegawai = '<span class="label label-success"><i class="fa fa-check"></i> </span>';
									}

									$berkas = '';
									if($row->berkas!='')
									{
										$berkas  = '<a href="'.base_url().'/data/berkas/pangkat/'.$row->id_pegawai.'/'.$row->berkas.'" title="Download" download=""><i class="ti ti-download"></i></a> ';
									}
							?>
								<tr>
									<td><?= $i ;?></td>
									<td><?= $row->golongan;?></td>
									<td><?= $row->pangkat;?></td>
									<td><?= ($row->tmt_berlaku !="0000-00-00") ? date('d M Y', strtotime($row->tmt_berlaku)) :"" ;?></td>
									<td><?= number_format($row->gaji_pokok) ;?></td>
									<td><?= $row->nama_pejabat;?></td>
									<td><?= $row->no_sk;?></td>
									<td><?= date('d M Y', strtotime($row->tgl_sk));?></td>
									<td><?= $verifikasi_bkd;?></td>
									<td><?= $verifikasi_pegawai;?></td>
									<td><?= $berkas;?></td>
									<td><?= $row->catatan_verifikasi;?></td>
									
								</tr>
							<?php 
								$i++;
							} ?>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="jabatan1">
					<div id="table_riwayat_jabatan">

														<table class="table color-table primary-table">
															<thead>
																<tr>
																	<th rowspan="2">#</th>
																	<th rowspan="2">Tanggal Mulai</th>
																	<th rowspan="2">Tanggal Akhir</th>
																	<th rowspan="2">Gol. Ruang</th>
																	<th rowspan="2">Gaji Pokok</th>
																	<th rowspan="2">Nama Pejabat</th>
																	<th rowspan="2">No. SK</th>
																	<th rowspan="2">Tgl. SK</th>
																	<th colspan="2" class="text-center">Verifikasi</th>
																	<th rowspan="2">File Lampiran</th>
																	<th rowspan="2">Catatan</th>
																	
																</tr>
																<tr>
																	<th>BKD</th>
																	<th>Pegawai</th>
																</tr>
															</thead>
															<tbody>
																			<?php 
																			$i= 1;
																			foreach ($dt_riwayat_jabatan as $jabatan): 
																				$berkas = "";
																				if($jabatan->berkas!="")
																				{
																					$berkas = '<a href="'.base_url().'data/berkas/jabatan/'.$jabatan->id_pegawai.'/'.$jabatan->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																				}
																			?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($jabatan) ? tanggal($jabatan->tgl_mulai) : "" ?></td>
																						<td><?=isset($jabatan->tgl_akhir) ? tanggal($jabatan->tgl_akhir) : "Sampai Sekarang" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->pangkat : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->gaji_pokok : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->nama_pejabat : "" ?></td>
																						<td><?=isset($jabatan) ? $jabatan->no_sk : "" ?></td>
																						<td><?=isset($jabatan) ? tanggal($jabatan->tgl_sk) : "" ?></td>
																						<td>
																							<?php if ($jabatan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($jabatan->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($jabatan) ? $jabatan->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				
																			<?php $i++; endforeach; ?>
																		</tbody>
														</table>
													</div>
												</div>
												
										
													<div role="tabpanel" class="tab-pane fade" id="pendidikan1">
														<div id="table_riwayat_pendidikan">

															
																<table class="table color-table primary-table">
																	<thead>
																		<tr>
																			<th rowspan="2">#</th>
																			<th rowspan="2">Jenjang</th>
																			<th rowspan="2">Nama Sekolah</th>
																			<th rowspan="2">Jurusan</th>
																			<th rowspan="2">Nama Pejabat</th>
																			<th rowspan="2">No. SK</th>
																			<th rowspan="2">Tgl. SK</th>
																			<th colspan="2" class="text-center">Status</th>
																			<th rowspan="2">File Lampiran</th>
																			<th rowspan="2">Catatan</th>
																			
																		</tr>
																		<tr>
																			<th>BKD</th>
																			<th>Pegawai</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php 
																	$i = 1;
																	foreach ($dt_riwayat_pendidikan as $pendidikan): 
																		$berkas = "";
																		if($pendidikan->berkas!="")
																		{
																			$berkas = '<a href="'.base_url().'data/berkas/pendidikan/'.$pendidikan->id_pegawai.'/'.$pendidikan->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																		}
																	?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_tempatpendidikan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_jurusan : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nama_pejabat : "" ?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->nomor_sk : "" ?></td>
																						<td><?=isset($pendidikan) ? tanggal($pendidikan->tgl_sk) : "" ?></td>
																						<td>
																							<?php if ($pendidikan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($pendidikan->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($pendidikan) ? $pendidikan->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																	<?php $i++; endforeach  ?>
																	</tbody>
																</table>
															
														</div>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="latihan1">
														<div id="table_riwayat_diklat">
															<h4>Diklat</h4>
															
																<table class="table color-table primary-table">
																	<thead>
																		<tr>
																			<th rowspan="2">#</th>
																			<th rowspan="2">Jenis Diklat</th>
																			<th rowspan="2">Nama Diklat</th>
																			<th rowspan="2">Tempat</th>
																			<th rowspan="2">Penyelengara</th>
																			<th rowspan="2">Angkatan</th>
																			<th rowspan="2">Tgl. Mulai</th>
																			<th rowspan="2">Tgl. Akhir</th>
																			<th rowspan="2">No. SPTL</th>
																			<th rowspan="2">Tahun</th>
																			<th colspan="2" class="text-center">Verifikasi</th>
																			<th rowspan="2">File Lampiran</th>
																			<th rowspan="2">Catatan</th>
																			
																		</tr>
																		<tr>
																			<th>BKD</th>
																			<th>Pegawai</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php 
																	$i =1;
																	foreach ($dt_riwayat_diklat as $diklat): 
																		$berkas = "";
																		if($diklat->berkas!="")
																		{
																			$berkas = '<a href="'.base_url().'data/berkas/diklat/'.$diklat->id_pegawai.'/'.$diklat->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																		}
																	?>
																				<tr>
																						<td><?= $i ;?></td>
																						<td><?=isset($diklat) ? $diklat->nama_jenisdiklat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->nama_diklat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->tempat : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->penyelenggara : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->angkatan : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_mulai) : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_akhir) : "" ?></td>
																						<td><?=isset($diklat) ? $diklat->no_sptl : "" ?></td>
																						<td><?=isset($diklat) ? tanggal($diklat->tgl_sptl) : "" ?></td>
																						<td>
																							<?php if ($diklat->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($diklat->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($diklat) ? $diklat->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																		<?php $i++; endforeach;?>

																	</tbody>
																</table>
															</div>
															
														
														
															<div id="table_riwayat_penataran">
															<h4>Penataran</h4>
																<div class="table-responsive">
																	<table class="table color-table primary-table">
																		<thead>
																			<tr>
																				<th rowspan="2">#</th>
																				<th rowspan="2">Jenis Penataran</th>
																				<th rowspan="2">Nama Penataran</th>
																				<th rowspan="2">Tempat</th>
																				<th rowspan="2">Penyelengara</th>
																				<th rowspan="2">Angkatan</th>
																				<th rowspan="2">Tgl. Mulai</th>
																				<th rowspan="2">Tgl. Akhir</th>
																				<th rowspan="2">No. SPTL</th>
																				<th rowspan="2">Tahun</th>
																				<th colspan="2" class="text-center">Verifikasi</th>
																				<th rowspan="2">File Lampiran</th>
																				<th rowspan="2">Catatan</th>
																			
																			</tr>
																			<tr>
																				<th>BKD</th>
																				<th>Pegawai</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php 
																		$i =1;
																		foreach ($dt_riwayat_penataran as $penataran): 
																			$berkas = "";
																			if($penataran->berkas!="")
																			{
																				$berkas = '<a href="'.base_url().'data/berkas/penataran/'.$penataran->id_pegawai.'/'.$penataran->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																			}
																		?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($penataran) ? $penataran->nama_penataran : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->nama_riwayat_penataran : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->tempat : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->penyelenggara : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->angkatan : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_mulai_penataran) : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_akhir_penataran) : "" ?></td>
																						<td><?=isset($penataran) ? $penataran->nomer_stpl : "" ?></td>
																						<td><?=isset($penataran) ? tanggal($penataran->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($penataran->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($penataran->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($penataran) ? $penataran->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																			<?php $i++; endforeach;?>
																		</tbody>
																	</table>
																</div>
																<hr>
															</div>
															
																<div id="table_riwayat_seminar">
																<h4>Seminar</h4>
																	<div class="table-responsive">
																		<table class="table color-table primary-table">
																			<thead>
																				<tr>
																					<th rowspan="2">#</th>
																					<th rowspan="2">Jenis Seminar</th>
																					<th rowspan="2">Nama Seminar</th>
																					<th rowspan="2">Tempat</th>
																					<th rowspan="2">Penyelengara</th>
																					<th rowspan="2">Angkatan</th>
																					<th rowspan="2">Tgl. Mulai</th>
																					<th rowspan="2">Tgl. Akhir</th>
																					<th rowspan="2">No. SPTL</th>
																					<th rowspan="2">Tahun</th>
																					<th colspan="2" class="text-center">Verifikasi</th>
																					<th rowspan="2">File Lampiran</th>
																					<th rowspan="2">Catatan</th>
																					
																				</tr>
																				<tr>
																					<th>BKD</th>
																					<th>Pegawai</th>
																				</tr>
																			</thead>
																			<tbody>
																			<?php 
																			$i = 1;
																			foreach ($dt_riwayat_seminar as $seminar): 
																				$berkas = "";
																				if($seminar->berkas!="")
																				{
																					$berkas = '<a href="'.base_url().'data/berkas/seminar/'.$seminar->id_pegawai.'/'.$seminar->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																				}
																			?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($seminar) ? $seminar->nama_jenisseminar : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->nama_riwayat_seminar : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->tempat : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->penyelenggara : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->angkatan : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_mulai_seminar) : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_akhir_seminar) : "" ?></td>
																						<td><?=isset($seminar) ? $seminar->nomer_stpl : "" ?></td>
																						<td><?=isset($seminar) ? tanggal($seminar->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($seminar->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($seminar->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($seminar) ? $seminar->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																			<?php $i++; endforeach; ?>
																			</tbody>
																		</table>
																	</div>
																	<hr>
																</div>
																
																	<div id="table_riwayat_kursus">
																				<h4>Kursus</h4>
																		<div class="table-responsive">
																			<table class="table color-table primary-table">
																				<thead>
																					<tr>
																						<th rowspan="2">#</th>
																						<th rowspan="2">Jenis Kursus</th>
																						<th rowspan="2">Nama Kursus</th>
																						<th rowspan="2">Tempat</th>
																						<th rowspan="2">Penyelengara</th>
																						<th rowspan="2">Angkatan</th>
																						<th rowspan="2">Tgl. Mulai</th>
																						<th rowspan="2">Tgl. Akhir</th>
																						<th rowspan="2">No. SPTL</th>
																						<th rowspan="2">Tahun</th>
																						<th colspan="2" class="text-center">Verifikasi</th>
																						<th rowspan="2">File Lampiran</th>
																						<th rowspan="2">Catatan</th>
																						
																					</tr>
																					<tr>
																						<th>BKD</th>
																						<th>Pegawai</th>
																					</tr>
																				</thead>
																				<?php 
																				$i = 1;
																				foreach ($dt_riwayat_kursus as $kursus): 
																					$berkas = "";
																					if($kursus->berkas!="")
																					{
																						$berkas = '<a href="'.base_url().'data/berkas/kursus/'.$kursus->id_pegawai.'/'.$kursus->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																					}
																				?>
																				<tr>
																						<td><?= $i ;?></td>
																						<td><?=isset($kursus) ? $kursus->nama_kursus : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->nama_riwayat_kursus : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->tempat : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->penyelenggara : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->angkatan : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_mulai_kursus) : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_akhir_kursus) : "" ?></td>
																						<td><?=isset($kursus) ? $kursus->nomer_stpl : "" ?></td>
																						<td><?=isset($kursus) ? tanggal($kursus->tgl_stpl) : "" ?></td>
																						<td>
																							<?php if ($kursus->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($kursus->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($kursus) ? $kursus->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++; endforeach;?>
																				<tbody>
																				</tbody>
																			</table>
																		</div>
																		<hr>
																	</div>
																	
																</div>	
																	<div role="tabpanel" class="tab-pane fade" id="unit_kerja1">
																		<div id="table_riwayat_unit_kerja">

																			
																				<table class="table color-table primary-table">
																					<thead>
																						<tr>
																							<th rowspan="2">#</th>
																							<th rowspan="2">Unit Kerja</th>
																							<th rowspan="2">TMT Awal</th>
																							<th rowspan="2">TMT Akhir</th>
																							<th rowspan="2">No. SK Awal</th>
																							<th rowspan="2">No. SK Akhir</th>
																							<th colspan="2" class="text-center">Verifikasi</th>
																							<th rowspan="2">File Lampiran</th>
																							<th rowspan="2">Catatan</th>
																							
																						</tr>
																						<tr>
																							<th>BKD</th>
																							<th>Pegawai</th>
																						</tr>
																					</thead>
																					<tbody>
																					<?php 
																					$i=1;
																					foreach ($dt_riwayat_unit_kerja as $unit_kerja): 
																					
																						$berkas = "";
																						if($unit_kerja->berkas!="")
																						{
																							$berkas = '<a href="'.base_url().'data/berkas/unit_kerja/'.$unit_kerja->id_pegawai.'/'.$unit_kerja->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																						}
																					?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->nama_unit_kerja : "" ?></td>
																						<td><?=($unit_kerja->tmt_awal!="0000-00-00") ? tanggal($unit_kerja->tmt_awal) : "" ?></td>
																						<td><?=($unit_kerja->tmt_akhir!="0000-00-00") ? tanggal($unit_kerja->tmt_akhir) : "" ?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->no_sk_awal : "" ?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->no_sk_akhir : "" ?></td>
																						<td>
																							<?php if ($unit_kerja->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($unit_kerja->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($unit_kerja) ? $unit_kerja->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++; endforeach;?>

																					</tbody>
																				</table>
																			</div>
																			<hr>
																		</div>
																		
																	<div role="tabpanel" class="tab-pane fade" id="penghargaan1">
																		<div id="table_riwayat_penghargaan">

																			<div class="table-responsive">
																				<table class="table color-table primary-table">
																					<thead>
																						<tr>
																							<th rowspan="2">#</th>
																							<th rowspan="2">Jenis Penghargaan</th>
																							<th rowspan="2">Nama Penghargaan</th>
																							<th rowspan="2">Tahun</th>
																							<th rowspan="2">Asal Perolehan</th>
																							<th rowspan="2">Penandatangan</th>
																							<th rowspan="2">Nomor</th>
																							<th rowspan="2">Tanggal</th>
																							<th colspan="2" class="text-center">Verifikasi</th>
																							<th rowspan="2">File Lampiran</th>
																							<th rowspan="2">Catatan</th>
																							
																						</tr>
																						<tr>
																							<th>BKD</th>
																							<th>Pegawai</th>
																						</tr>
																					</thead>
																					<tbody>
																					<?php 
																					$i=1;
																					foreach ($dt_riwayat_penghargaan as $penghargaan): 
																						$berkas = "";
																						if($penghargaan->berkas!="")
																						{
																							$berkas = '<a href="'.base_url().'data/berkas/penghargaan/'.$penghargaan->id_pegawai.'/'.$penghargaan->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																						}
																					?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->nama_jenispenghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->nama_penghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->tahun : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->asal_perolehan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->penandatangan : "" ?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->no_penghargaan : "" ?></td>
																						<td><?=isset($penghargaan) ? tanggal($penghargaan->tgl_penghargaan) : "" ?></td>
																						<td>
																							<?php if ($penghargaan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($penghargaan->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($penghargaan) ? $penghargaan->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++; endforeach;?>
																					</tbody>
																				</table>
																			</div>
																			<hr>
																		</div>
																		
																		</div>
																		<div role="tabpanel" class="tab-pane fade" id="absen1">
																			<div id="table_riwayat_penugasan">
																				<h4>Penugasan</h4>
																				<div class="table-responsive">
																					<table class="table color-table primary-table">
																						<thead>
																							<tr>
																								<th rowspan="2">#</th>
																								<th rowspan="2">Jenis Penugasan</th>
																								<th rowspan="2">Tempat</th>
																								<th rowspan="2">Pejabat Penetapan</th>
																								<th rowspan="2">Nomor SK</th>
																								<th rowspan="2">Tanggal SK</th>
																								<th rowspan="2">Tgl. Awal Penugasan</th>
																								<th rowspan="2">Tgl. Akhir Penugasan</th>
																								<th colspan="2" class="text-center">Verifikasi</th>
																								<th rowspan="2">File Lampiran</th>
																								<th rowspan="2">Catatan</th>
																								
																							</tr>
																							<tr>
																								<th>BKD</th>
																								<th>Pegawai</th>
																							</tr>
																						</thead>
																						<tbody>
																						<?php 
																						$i=1;
																						foreach ($dt_riwayat_penugasan as $penugasan): 
																							$berkas = "";
																							if($penugasan->berkas!="")
																							{
																								$berkas = '<a href="'.base_url().'data/berkas/penugasan/'.$penugasan->id_pegawai.'/'.$penugasan->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																							}
																						?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($penugasan) ? $penugasan->nama_jenispenugasan : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->tempat : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->pejabat_penetap : "" ?></td>
																						<td><?=isset($penugasan) ? $penugasan->nomer_sk : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_sk) : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_mulai_penugasan) : "" ?></td>
																						<td><?=isset($penugasan) ? tanggal($penugasan->tgl_akhir_penugasan) : "" ?></td>
																						
																						<td><?= $berkas;?></td>
																						<td><?=isset($penugasan) ? $penugasan->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++; endforeach;?>
																						</tbody>
																					</table>
																				</div>
																				<hr>
																			</div>
																			
																				<div id="table_riwayat_cuti">
																					<h4>Cuti</h4>
																					<div class="table-responsive">
																						<table class="table color-table primary-table">
																							<thead>
																								<tr>
																									<th rowspan="2">#</th>
																									<th rowspan="2">Jenis Cuti</th>
																									<th rowspan="2">Keterangan</th>
																									<th rowspan="2">Pejabat Penetapan</th>
																									<th rowspan="2">Nomor SK</th>
																									<th rowspan="2">Tanggal SK</th>
																									<th rowspan="2">Tgl. Awal Cuti</th>
																									<th rowspan="2">Tgl. Akhir Cuti</th>
																									<th colspan="2" class="text-center">Verifikasi</th>
																									<th rowspan="2">File Lampiran</th>
																									<th rowspan="2">Catatan</th>
																									
																								</tr>
																								<tr>
																									<th>BKD</th>
																									<th>Pegawai</th>
																								</tr>
																							</thead>
																							<tbody>
																							<?php 
																							$i=1;
																							foreach ($dt_riwayat_cuti as $cuti): 
																								$berkas = "";
																								if($cuti->berkas!="")
																								{
																									$berkas = '<a href="'.base_url().'data/berkas/cuti/'.$cuti->id_pegawai.'/'.$cuti->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																								}
																							?>
																					<tr>
																						<td><?=$i;?></td>
																						<td><?=isset($cuti) ? $cuti->nama_jeniscuti : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->keterangan : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->pejabat_penetapan : "" ?></td>
																						<td><?=isset($cuti) ? $cuti->no_sk : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_sk) : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_awal_cuti) : "" ?></td>
																						<td><?=isset($cuti) ? tanggal($cuti->tgl_akhir_cuti) : "" ?></td>
																						<td>
																							<?php if ($cuti->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($cuti->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($cuti) ? $cuti->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																							</tbody>
																						</table>
																					</div>
																					<hr>
																				</div>
																				
																					<div id="table_riwayat_hukuman">
																					<h4>Riwayat Hukuman</h4>
																						<div class="table-responsive">
																							<table class="table color-table primary-table">
																								<thead>
																									<tr>
																										<th rowspan="2">#</th>
																										<th rowspan="2">Jenis Hukuman</th>
																										<th rowspan="2">Keterangan</th>
																										<th rowspan="2">Pejabat Penetapan</th>
																										<th rowspan="2">Nomor SK</th>
																										<th rowspan="2">Tanggal SK</th>
																										<th rowspan="2">Tgl. Awal Hukuman</th>
																										<th rowspan="2">Tgl. Akhir Hukuman</th>
																										<th colspan="2" class="text-center">Verifikasi</th>
																										<th rowspan="2">File Lampiran</th>
																										<th rowspan="2">Catatan</th>
																										
																									</tr>
																									<tr>
																										<th>BKD</th>
																										<th>Pegawai</th>
																									</tr>
																								</thead>
																								<tbody>
																								<?php 
																								$i=1;
																								foreach ($dt_riwayat_hukuman as $hukuman): 
																									$berkas = "";
																									if($hukuman->berkas!="")
																									{
																										$berkas = '<a href="'.base_url().'data/berkas/hukuman/'.$hukuman->id_pegawai.'/'.$hukuman->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																									}
																								?>
																				<tr>
																						<td><?=$i;?></td>
																						<td><?=isset($hukuman) ? $hukuman->nama_jenishukuman : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->keterangan : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->pejabat_penetap : "" ?></td>
																						<td><?=isset($hukuman) ? $hukuman->nomer_sk : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_sk) : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_mulai_hukuman) : "" ?></td>
																						<td><?=isset($hukuman) ? tanggal($hukuman->tgl_akhir_hukuman) : "" ?></td>
																						<td>
																							<?php if ($hukuman->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($hukuman->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($hukuman) ? $hukuman->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																								</tbody>
																							</table>
																						</div>
																						<hr>
																					</div>
																					
																					</div>
																					<div role="tabpanel" class="tab-pane fade" id="bahasa1">
																						<div id="table_riwayat_bahasa">
																						<h4>Kemampuan Bahasa</h4>
																							<div class="table-responsive">
																								<table class="table color-table primary-table">
																									<thead>
																										<tr>
																											<th rowspan="2">#</th>
																											<th rowspan="2">Nama Bahasa</th>
																											<th rowspan="2">Kemampuan Bahasa</th>
																											<th colspan="2" class="text-center">Verifikasi</th>
																											<th rowspan="2">File Lampiran</th>
																											<th rowspan="2">Catatan</th>
																											
																										</tr>
																										<tr>
																											<th>BKD</th>
																											<th>Pegawai</th>
																										</tr>
																									</thead>
																									<tbody>
																									<?php 
																									$i=1;
																									foreach ($dt_riwayat_bahasa as $bahasa): 
																										$berkas= "";
																										if($bahasa->berkas!="")
																										{
																											$berkas = '<a href="'.base_url().'data/berkas/bahasa/'.$bahasa->id_pegawai.'/'.$bahasa->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																										}
																									?>
																				<tr>
																						<td><?=$i;?></td>
																						<td><?=isset($bahasa) ? $bahasa->nama_bahasa : "" ?></td>
																						<td><?=isset($bahasa) ? $bahasa->kemampuan : "" ?></td>
																						<td>
																							<?php if ($bahasa->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($bahasa->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($bahasa) ? $bahasa->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																									</tbody>
																								</table>
																							</div>
																						</div>
																						
																							<hr>
																							<div id="table_riwayat_bahasa_asing">
																								<h4>Kemampuan Bahasa Asing</h4>
																								<div class="table-responsive">
																									<table class="table color-table primary-table">
																										<thead>
																											<tr>
																												<th rowspan="2">#</th>
																												<th rowspan="2">Nama Bahasa</th>
																												<th rowspan="2">Kemampuan Bahasa</th>
																												<th colspan="2" class="text-center">Verifikasi</th>
																												<th rowspan="2">File Lampiran</th>
																												<th rowspan="2">Catatan</th>
																												
																											</tr>
																											<tr>
																												<th>BKD</th>
																												<th>Pegawai</th>
																											</tr>
																										</thead>
																										<tbody>
																										<?php 
																										$i=1;
																										foreach ($dt_riwayat_bahasa_asing as $bahasa_asing): 
																											$berkas = "";
																											if($bahasa_asing->berkas!="")
																											{
																												$berkas = '<a href="'.base_url().'data/berkas/bahasa_asing/'.$bahasa_asing->id_pegawai.'/'.$bahasa_asing->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																											}
																										?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($bahasa_asing) ? $bahasa_asing->nama_bahasa_asing : "" ?></td>
																						<td><?=isset($bahasa_asing) ? $bahasa_asing->kemampuan : "" ?></td>
																						<td>
																							<?php if ($bahasa_asing->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($bahasa_asing->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($bahasa_asing) ? $bahasa_asing->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																										</tbody>
																									</table>
																								</div>
																								<hr>
																							</div>

																						</div>
																						<div role="tabpanel" class="tab-pane fade" id="keluarga1">
																							<div id="table_riwayat_pernikahan">
																								<h4>Riwayat Pernikahan</h4>
																								<div class="table-responsive">
																									<table class="table color-table primary-table">
																										<thead>
																											<tr>
																												<th rowspan="2">#</th>
																												<th rowspan="2">Nama</th>
																												<th rowspan="2">Tempat Lahir</th>
																												<th rowspan="2">Tgl. Lahir</th>
																												<th rowspan="2">Tgl. Menikah</th>
																												<th rowspan="2">Pendidikan Umum</th>
																												<th rowspan="2">Pekerjaan</th>
																												<th rowspan="2">Keterangan</th>
																												<th colspan="2" class="text-center">Verifikasi</th>
																												<th rowspan="2">File Lampiran</th>
																												<th rowspan="2">Catatan</th>
																												
																											</tr>
																											<tr>
																												<th>BKD</th>
																												<th>Pegawai</th>
																											</tr>
																										</thead>
																										<tbody>
																										<?php 
																										$i=1;
																										foreach ($dt_riwayat_pernikahan as $pernikahan): 
																											$berkas = "";
																											if($pernikahan->berkas!="")
																											{
																												$berkas = '<a href="'.base_url().'data/berkas/pernikahan/'.$pernikahan->id_pegawai.'/'.$pernikahan->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																											}
																										?>
																				<tr>
																						<td><?=$i;?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->nama : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tempat_lahir : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tgl_lahir : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->tgl_menikah : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->pekerjaan : "" ?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->keterangan : "" ?></td>
																						<td>
																							<?php if ($pernikahan->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($pernikahan->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($pernikahan) ? $pernikahan->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																										</tbody>
																									</table>
																								</div>
																								<hr>
																							</div>
																							
																								<div id="table_riwayat_anak">
																								<h4>Anak</h4>
																									<div class="table-responsive">
																										<table class="table color-table primary-table">
																											<thead>
																												<tr>
																													<th rowspan="2">#</th>
																													<th rowspan="2">Nama</th>
																													<th rowspan="2">Tempat Lahir</th>
																													<th rowspan="2">Tgl. Lahir</th>
																													<th rowspan="2">Jenis Kelamin</th>
																													<th rowspan="2">Pendidikan Umum</th>
																													<th rowspan="2">Pekerjaan</th>
																													<th rowspan="2">Keterangan</th>
																													<th colspan="2" class="text-center">Verifikasi</th>
																													<th rowspan="2">File Lampiran</th>
																													<th rowspan="2">Catatan</th>
																													
																												</tr>
																												<tr>
																													<th>BKD</th>
																													<th>Pegawai</th>
																												</tr>
																											</thead>
																											<tbody>
																											<?php 
																											$i=1;
																											foreach ($dt_riwayat_anak as $anak): 
																												$berkas = "";
																												if($anak->berkas!="")
																												{
																													$berkas = '<a href="'.base_url().'data/berkas/anak/'.$anak->id_pegawai.'/'.$anak->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																												}
																												?>
																				<tr>
																						<td><?=$i;?></td>
																						<td><?=isset($anak) ? $anak->nama : "" ?></td>
																						<td><?=isset($anak) ? $anak->tempat_lahir : "" ?></td>
																						<td><?=isset($anak) ? $anak->tgl_lahir : "" ?></td>
																						<td><?=isset($anak) ? $anak->jenis_kelamin : "" ?></td>
																						<td><?=isset($anak) ? $anak->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($anak) ? $anak->pekerjaan : "" ?></td>
																						<td><?=isset($anak) ? $anak->keterangan : "" ?></td>
																						<td>
																							<?php if ($anak->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($anak->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($anak) ? $anak->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																											</tbody>
																										</table>
																									</div>
																									<hr>
																								</div>
																								
																									<div id="table_riwayat_orangtua">
																									<h4>Orang Tua</h4>
																										<div class="table-responsive">
																											<table class="table color-table primary-table">
																												<thead>
																													<tr>
																														<th rowspan="2">#</th>
																														<th rowspan="2">Nama</th>
																														<th rowspan="2">Tempat Lahir</th>
																														<th rowspan="2">Tgl. Lahir</th>
																														<th rowspan="2">Jenis Kelamin</th>
																														<th rowspan="2">Pendidikan Umum</th>
																														<th rowspan="2">Pekerjaan</th>
																														<th rowspan="2">Keterangan</th>
																														<th colspan="2" class="text-center">Verifikasi</th>
																														<th rowspan="2">File Lampiran</th>
																														<th rowspan="2">Catatan</th>
																														
																													</tr>
																													<tr>
																														<th>BKD</th>
																														<th>Pegawai</th>
																													</tr>
																												</thead>
																												<tbody>
																												<?php 
																												$i=1;
																												foreach ($dt_riwayat_orangtua as $orangtua): 
																													$berkas = "";
																													if($orangtua->berkas!="")
																													{
																														$berkas = '<a href="'.base_url().'data/berkas/orangtua/'.$orangtua->id_pegawai.'/'.$orangtua->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																													}
																													?>
																												?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($orangtua) ? $orangtua->nama : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->tempat_lahir : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->tgl_lahir : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->jenis_kelamin : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->pekerjaan : "" ?></td>
																						<td><?=isset($orangtua) ? $orangtua->keterangan : "" ?></td>
																						<td>
																							<?php if ($orangtua->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($orangtua->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($orangtua) ? $orangtua->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																												</tbody>
																											</table>
																										</div>
																										<hr>
																									</div>
																									
																										<div id="table_riwayat_mertua">
																										<h4>Mertua</h4>

																											<div class="table-responsive">
																												<table class="table color-table primary-table">
																													<thead>
																														<tr>
																															<th rowspan="2">#</th>
																															<th rowspan="2">Nama</th>
																															<th rowspan="2">Tempat Lahir</th>
																															<th rowspan="2">Tgl. Lahir</th>
																															<th rowspan="2">Jenis Kelamin</th>
																															<th rowspan="2">Pendidikan Umum</th>
																															<th rowspan="2">Pekerjaan</th>
																															<th rowspan="2">Keterangan</th>
																															<th colspan="2" class="text-center">Verifikasi</th>
																															<th rowspan="2">File Lampiran</th>
																															<th rowspan="2">Catatan</th>
																															
																														</tr>
																														<tr>
																															<th>BKD</th>
																															<th>Pegawai</th>
																														</tr>
																													</thead>
																													<tbody>
																													<?php 
																													$i=1;
																													foreach ($dt_riwayat_mertua as $mertua): 
																														$berkas = "";
																														if($mertua->berkas!="")
																														{
																															$berkas = '<a href="'.base_url().'data/berkas/mertua/'.$mertua->id_pegawai.'/'.$mertua->berkas.'" title="Download" download><i class="ti ti-download"></i></a> ';
																														}
																													?>
																				<tr>
																						<td><?= $i;?></td>
																						<td><?=isset($mertua) ? $mertua->nama : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->tempat_lahir : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->tgl_lahir : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->jenis_kelamin : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->nama_jenjangpendidikan : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->pekerjaan : "" ?></td>
																						<td><?=isset($mertua) ? $mertua->keterangan : "" ?></td>
																						<td>
																							<?php if ($mertua->verifikasi_bkd == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td>
																							<?php if ($mertua->verifikasi_pegawai == "true"): ?>
																								<span class="label label-success"><i class="ti ti-check"></i></span>
																								<?php else: ?>
																								<span class="label label-danger"><i class="ti ti-close"></i> </span>
																							<?php endif; ?>
																						</td>
																						<td><?= $berkas;?></td>
																						<td><?=isset($mertua) ? $mertua->catatan_verifikasi : "" ?></td>
																						
																				</tr>
																				<?php $i++;endforeach;?>
																													</tbody>
																												</table>
																											</div>
																											<hr>
																										</div>
																										
																										</div>
																									</div>
                    <!-- <div role="tabpanel" class="tab-pane fade" id="berkas1">
                        <div class="col-md-6">
                            <h3>Just do Settings</h3>
                            <h4>you can use it with the small code</h4>
                        </div>
                        <div class="col-md-5 pull-right">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                </div>

				<!--
                <div class="white-box">

                	<div class="vtabs ">
                		<ul class="nav tabs-vertical">
																														
                			<li class="tab active">
                				<a data-toggle="tab" href="#home3" aria-expanded="true"> <span class="visible-xs"><i class="ti-home"></i></span> <span class="hidden-xs">Input Assessment</span> </a>
                			</li>
                			<li class="tab">
                				<a data-toggle="tab" href="#profile3" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Catatan dari APIP</span> </a>
                			</li>
                			<li class="tab">
                				<a aria-expanded="false" data-toggle="tab" href="#messages3"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Nilai 360°</span> </a>
                			</li>
                			<li class="tab">
                				<a aria-expanded="false" data-toggle="tab" href="#hukdis"> <span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Hukuman Disiplin</span> </a>
                			</li>
                		</ul>
                		<div class="tab-content">
                			<div id="home3" class="tab-pane active">
                				<div class="row">
                					<div class="col-md-12">
									<!--
                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-3">
                									<label>TIU</label>
                								</div>
                								<div class="col-md-9">
                									<input type="" class="form-control" name="" style="width: 100%">
                								</div>
                							</div>
                						</div>
                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-3">
                									<label>TWK</label>
                								</div>
                								<div class="col-md-9">
                									<input type="" class="form-control" name="" style="width: 100%">
                								</div>
                							</div>
                						</div>
                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-3">
                									<label>TKP</label>
                								</div>
                								<div class="col-md-9">
                									<input type="" class="form-control" name="" style="width: 100%">
                								</div>
                							</div>
                						</div>

                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-3">
                									<label>Total</label>
                								</div>
                								<div class="col-md-9">
                									<p>100</p>
                								</div>
                							</div>
                						</div>

                						<div class="form-group">

                							<a href="javascript:void(0)" data-toggle="modal" data-target="#myModalc" class="btn btn-primary"><i class="ti-check"></i> Simpan</a>
                						</div> 
										--
									<form id="input-nilai">
										<div class="form-group">
                							<div class="row">
                								<div class="col-md-6">
                									<label>Nilai Kompetensi</label>
                								</div>
                								<div class="col-md-6">
                									<input type="text" class="form-control" id="kompetensi" name="kompetensi">
                								</div>
                							</div>
                						</div>
                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-6">
                									<label>NKP (Nilai Kinerja Pegawai)Nilai Kinerja</label>
                								</div>
                								<div class="col-md-6">
                									<input type="text" class="form-control" id="kinerja" name="kinerja">
                								</div>
                							</div>
                						</div>
                						<div class="form-group">
                							<div class="row">
                								<div class="col-md-6">
                									<label>NP (Nilai Perilaku)	</label>
                								</div>
                								<div class="col-md-6">
                									<input type="text" class="form-control" id="perilaku" name="perilaku" >
                								</div>
                							</div>
                						</div>
										<div class="form-group">
                							<div class="row">
                								<div class="col-md-6">
                									<label>SKP (Sasaran Kinerja Pegawai)</label>
                								</div>
                								<div class="col-md-6">
                									<input type="text" class="form-control" id="sasaran_kinerja" name="sasaran_kinerja" >
                								</div>
                							</div>
                						</div>
									</form>

                						<div class="form-group">
                							<a href="javascript:void(0)" onclick='simpan_nilai()' class="btn btn-primary"><i class="ti-check"></i> Simpan</a>
                						</div> 

                					</div>
                				</div>
                			</div>
                			<div id="profile3" class="tab-pane">
                				<p>Tidak ada catatan</p>
                			</div>
                			<div id="messages3" class="tab-pane">

                				<div style="color:#fff;background-color: #6003c8;padding: 10px;margin-bottom: 5px;font-weight: 500">Penilaian dari atasan</div>
                				<div style="padding:10px;border: solid 1px rgba(120,130,140,.21)">
                					<h4><img class="img-responsive img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="https://www.windstream.com/getmedia/b2e4e38a-7cb6-4ca9-9544-54dfeaca6304/icon_user-circle.png.aspx?width=60"><b style="color: #6003c8">John Doe</b><br/><small>Kepala SKPD</small></h4>
                					<hr>
                					<b style="color: #6003c8"><i class="ti-comment"></i> Komentar</b>
                					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                				</div>
                				<div style="color:#fff;background-color: #6003c8;padding: 10px;margin-bottom: 5px;margin-top:10px;font-weight: 500">Penilaian dari rekan kerja</div>
                				<div style="padding:10px;border: solid 1px rgba(120,130,140,.21)">
                					<h4><img class="img-responsive img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="https://www.windstream.com/getmedia/b2e4e38a-7cb6-4ca9-9544-54dfeaca6304/icon_user-circle.png.aspx?width=60"><b style="color: #6003c8">Alex Brown</b><br/><small>KEPALA BIDANG PERENCANAAN DAN PENGEMBANGAN IKLIM PENANAMAN MODAL</small></h4>
                					<hr>
                					<b style="color: #6003c8"><i class="ti-comment"></i> Komentar</b>
                					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                						tempor incididunt ut labore et dolore magna aliqua..</p>
                				</div>
                				<div style="padding:10px;border: solid 1px rgba(120,130,140,.21)">
                					<h4><img class="img-responsive img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="https://www.windstream.com/getmedia/b2e4e38a-7cb6-4ca9-9544-54dfeaca6304/icon_user-circle.png.aspx?width=60"><b style="color: #6003c8">J. Carroll</b><br/><small>KEPALA BIDANG PELAYANAN PERIZINAN</small></h4>
                					<hr>
                					<b style="color: #6003c8"><i class="ti-comment"></i> Komentar</b>
                					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                						tempor incididunt ut labore et dolore magna aliqua..</p>
                				</div>
                				<div style="color:#fff;background-color: #6003c8;padding: 10px;margin-bottom: 5px;margin-top:10px;font-weight: 500">Penilaian dari bawahan</div>
                				<div style="padding:10px;border: solid 1px rgba(120,130,140,.21)">
                					<h4><img class="img-responsive img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="https://www.windstream.com/getmedia/b2e4e38a-7cb6-4ca9-9544-54dfeaca6304/icon_user-circle.png.aspx?width=60"><b style="color: #6003c8">Nicole Benton</b><br/><small>KEPALA SUB BAGIAN KEUANGAN</small></h4>
                					<hr>
                					<b style="color: #6003c8"><i class="ti-comment"></i> Komentar</b>
                					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                						tempor incididunt ut labore et dolore magna aliqua..</p>
                				</div>
                			</div>

                			<div id="hukdis" class="tab-pane">


                		<a href="javascript:void(0)" data-toggle="modal" data-target="#mhukdis" class="btn btn-primary"><i class="ti-check"></i> Tambah Data Hukuman Disiplin</a>
                		<hr>
																												<table class="table table-bordered">
																													<thead>
																														<tr style="background-color: #dad3e2">
																															<th rowspan="2" style="vertical-align: middle;text-align: center">#</th>
																															<th rowspan="2" style="vertical-align: middle;text-align: center">Jenis</th>
																															<th rowspan="2" style="vertical-align: middle;text-align: center">Keterangan</th>
																															<th colspan="3" style="vertical-align: middle;text-align: center;">Surat Keputusan</th>
																															<th colspan="2" style="vertical-align: middle;text-align: center;">Lama Hukuman Disiplin</th>
																															<th rowspan="2" style="vertical-align: middle;text-align: center">Aksi</th>
																														</tr>
																														<tr style="background-color: #dad3e2">
																															<th>Pejabat Yang menetapkan
																															<th>Nomor</th>
																															<th>Tanggal</th>
																															<th>Tgl. Mulai</th>
																															<th>Tgl. Selesai</th>
																														</tr>
																													</thead>
																													<tbody>
																														<tr>
																															<td>1</td>
																															<td>Ringan</td>
																															<td>Loremipsum dolor sit amet</td>
																															<td>John Doe</td>
																															<td>394/12/2019</td>
																															<td>9 Juni 2019</td>
																															<td>10 Juni 2019</td>
																															<td>17 Juni 2019</td>
																															<td>
																																<a href="" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
																																<a href="" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
																															</td>
																														</tr>
																													</tbody>
																												</table>
                			</div>
                		</div>
                	</div>-->

        <!--         	<h3 style="color: #6003c8;font-weight: 600">HASIL SELEKSI</h3>

                	<div class="form-group">
                		<label class="control-label"> Skor Keseluruhan</label>
                		<input type="text" class="form-control" name="" placeholder="Masukkan Skor Keseluruhan">
                	</div>
                	<div class="form-group">
                		<label class="control-label"> Status</label>
                		<select class="form-control">
                			<option value="">Pilih Status</option>
                			<option value="">Lolos</option>
                			<option value="">Tidak Lolos</option>
                		</select>
                	</div>
                	<div class="form-group">
                		<label class="control-label"> Catatan</label>
                		<textarea class="form-control" placeholder="Masukkan Catatan Tambahan"></textarea>
                	</div>
                	<div class="form-group">

                		<a href="javascript:void(0)" data-toggle="modal" data-target="#myModalc" class="btn btn-primary"><i class="ti-check"></i> Selesai</a>
                	</div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->
</div>



<div id="myModalc" class="modal fade" tabindex="" index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Konfirmasi</h4> </div>
				<div class="modal-body">
					<p>Apakah anda yakin akan ikut serta dalam seleksi calon talent?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tidak</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>




<div id="mhukdis" class="modal fade" tabindex="" index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Hukuman Disiplin</h4> </div>
				<div class="modal-body">
					<div class="form-group">
						<label>Jenis Hukuman</label>
						<select class="form-control">
							<option value="">Pilih Jenis Hukuman</option>
							<option value="">Ringan</option>
							<option value="">Sedang</option>
							<option value="">Berat</option>
						</select>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Pejabat yang memutuskan</label>
						<input type="text" class="form-control" name="">
					</div>
					<div class="form-group">
						<label>Nomor SK</label>
						<input type="text" class="form-control" name="">
					</div>
					<div class="form-group">
						<label>Tanggal SK</label>
						<input type="text" id="datepicker" class="form-control" name="">
					</div>
					<div class="form-group">
						<label>Tanggal Mulai Hukuman</label>
						<input type="text" id="datepicker" class="form-control" name="">
					</div>
					<div class="form-group">
						<label>Tanggal Selesai Hukuman</label>
						<input type="text" id="datepicker" class="form-control" name="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Simpan</button>
					<button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tidak</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

<script>
	function simpan_nilai()
	{
		var kompetensi = $("#kompetensi").val();
		var kinerja = $("#kinerja").val();
		var perilaku = $("#perilaku").val();
		var sasaran_kinerja = $("#sasaran_kinerja").val();
	   $.post("<?=base_url()?>talenta/pendaftar/simpan_nilai/",
	   		{
				'kompetensi' : kompetensi,
				'kinerja' : kinerja,
				'perilaku' : perilaku,
				'sasaran_kinerja' : sasaran_kinerja,
				'id_pendaftaran' : "<?= $id_pendaftaran;?>"
			},
			function(obj){
			console.log(obj);
			var data = JSON.parse(obj);
			if(data.status){
				
				swal("Pesan", data.message, "success");
			}
			else{
				
				if(data.errors.length==0){
					swal("Pesan", data.message, "warning");
				}
			}
	   });
	   
	}
</script>