
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Kegiatan Personal</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="#">Laporan</a></li>
				<li class="active">Kegiatan Personal</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-md-3 col-xs-12">
			<div class="white-box">
						<div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
								<div class="overlay-box">
										<div class="user-content" style="padding-bottom:15px;">
												<a href="javascript:void(0)"><img src="<?php echo $data_by_bkd->foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url()."data/foto/pegawai/".$data_by_bkd->foto_pegawai : base_url()."data/foto/pegawai/user-default.png";?>" class="thumb-lg img-circle" style=" object-fit: cover;

		width: 100px;
		height: 100px;border-radius: 50%;
		" alt="img"></a>
												<h5 class="text-white"><b><?=isset($data_by_bkd->nama_lengkap) ? $data_by_bkd->nama_lengkap : '-' ?></b></h5>
												<h6 class="text-white"><?=isset($data_by_bkd->nip) ? $data_by_bkd->nip : '-' ?></h6>
										</div>
								</div>
					</div>
					<!-- <div class="user-btm-box">
						<div class="row">
							<div class="col-md-12 b-b text-center">
								<h6><b>SKPD
								</b></h6>
								<h6><?=isset($data_by_bkd->nama_skpd) ? $data_by_bkd->nama_skpd : '-' ?>
								</h6>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 b-r text-center">
								<h6><b>Unit Kerja</b></h6>
								<h6>
									<?=isset($data_by_bkd->nama_unit_kerja) ? $data_by_bkd->nama_unit_kerja : '-' ?>
								</h6>
							</div>
							<div class="col-md-6 text-center">
								<h6><b>Jabatan</b></h6>
								<h6>
									<?=isset($data_by_bkd->nama_jabatan) ? $data_by_bkd->nama_jabatan : '-' ?>
								</h6>
							</div>
						</div>
					</div> -->
			</div>
		</div>

		<div class="col-md-9 col-xs-12">
			<div class="row">
				<!-- <div class="col-md-12">
		 			<div class="white-box">
		 				<div class="row">
		 					<form method="POST">
		            <div class="col-md-3">
		            <div class="form-group">
		              <label for="">Nama Kegiatan</label>
		              <input type="text" class="form-control" name="">
		            </div>
		          </div>
		            <div class="col-md-3">
			            <div class="form-group">
			              <label for="">Tanggal Awal</label>
										<input type="text" class="form-control" name="" id="datepicker" placeholder="mm-dd-yyyy" value="">
			            </div>
			          </div>
		            <div class="col-md-3">
			            <div class="form-group">
			              <label for="">Tanggal akhir</label>
										<input type="text" class="form-control" name="" id="datepicker" placeholder="mm-dd-yyyy" value="">
			            </div>
			          </div>

		 					<div class="col-md-3  b-l">
		 						<div class="form-group text-center">
		 							<br>
		 							<button type="submit" class="btn btn-primary btn-outline m-t-5">Filter</button>
		 						</div>
		 					</div>
		 				</form>
		 				</div>

		 			</div>
		 		</div> -->
				<div class="col-md-12">
					<div class="col-md-4 col-xs-12 col-sm-6">
              <div class="white-box text-center bg-purple">
									<p class="text-white">Total Kegiatan Personal</p>
                  <h1 class="text-white counter"><?=count($kegiatan_personal);?></h1>
              </div>
          </div>
					<div class="col-md-4 col-xs-12 col-sm-6">
              <div class="white-box text-center bg-purple">
									<p class="text-white">Diverifikasi</p>
                  <h1 class="text-white counter"><?=count($kegiatan_personal_verif);?></h1>
              </div>
          </div>
					<div class="col-md-4 col-xs-12 col-sm-6">
              <div class="white-box text-center bg-purple">
									<p class="text-white">Belum diverifikasi</p>
                  <h1 class="text-white counter"><?=count($kegiatan_personal_unverif);?></h1>
              </div>
          </div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="table-responsive">
					<table id="example23" class="display nowrap" cellspacing="0" width="100%">
								<thead>
										<tr>
												<th>No</th>
												<th>Tgl. Kegiatan</th>
												<th>Nama Kegiatan</th>
												<th style="width:30%">Deskripsi Hasil</th>
												<th>Lampiran</th>
												<th>Status Verifikasi</th>
												<th>Tgl. Verifikasi</th>
												<th>Verifikator</th>
										</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($kegiatan_personal as $kp): ?>
										<tr>
												<td><?=$i?></td>
												<td><?=tanggal($kp->tgl_selesai_kegiatan);?></td>
												<td><?=$kp->nama_kegiatan?></td>
												<td><?=$kp->deskripsi?></td>
												<td><a href="<?=base_url('data/kegiatan_personal/'.$kp->id_pegawai_input.'/'.$kp->lampiran);?>" class="label label-primary label-rounded">Lihat</a></td>
												<td>
													<?php if ($kp->status_kegiatan == "SELESAI DIVERIFIKASI"): ?>
														<i class="fa fa-calendar-check-o" style="color:#6003c8"></i> Diverifikasi
													<?php else: ?>
														<i class="fa fa-calendar-o" style="color:red"></i> Belum diverifikasi
													<?php endif; ?>
												</td>
												<td><?=isset($kp->tgl_verifikasi) ? tanggal($kp->tgl_verifikasi) : '<center>-</center>' ;?></td>
												<td class="text-center">
													<p><?=$kp->nama_lengkap?></p>
													<p><small><?=$kp->nip?></small> </p>
												</td>
										</tr>
									<?php
									$i++;
								 endforeach; ?>
								</tbody>
						</table>
				</div>
			</div>

	<!-- .right-sidebar -->
