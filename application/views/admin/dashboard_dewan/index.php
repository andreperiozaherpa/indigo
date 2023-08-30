<style type="text/css">
	.posisi tbody tr td {
		width: 100px;
		height: 100px;
		text-align: center;
		vertical-align: middle;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard User</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<div class="col-md-12">
			<?php if ($this->session->userdata('msg') == true) : ?>
				<?= $this->session->userdata('msg'); ?>
			<?php endif; ?>
			<div class="alert alert-primary"><i class="ti-alert"></i> Apabila terdapat kesalahan dalam data informasi pegawai, Anda dapat mengubahnya pada menu <a style="color: white" href="<?= base_url('pengaturan_akun') ?>"><b>Pengaturan Akun</b></a></div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url(); ?>/data/images/header/header2.jpg">
					<div class="overlay-box">
						<div class="user-content" style="padding-top:1px;">
							<a href="javascript:void(0)"><img src="<?php echo $foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url() . "data/foto/pegawai/$foto_pegawai" : $foto_pegawai; ?>" class="thumb-lg img-circle" style=" object-fit: cover;

  width: 75px;
  height: 75px;border-radius: 50%;
  " alt="img"></a>
							<h5 class="text-white"><b><?= $full_name ?></b></h5>
							<h6 class="text-white"><?= isset($user->nip) ? $user->nip : '-' ?></h6>
							<div class="btn-group dropup m-r-10">
								<form method="post" action="<?= base_url('dashboard_user/updateKetersediaan/' . $id_user) ?>">
									<select class="btn btn-<?= $user->warna_ketersediaan ?>" id="ketersediaan" name="ketersediaan" onchange="this.form.submit();">
										<option value="<?= $user->id_ketersediaan ?>" style="background-color:<?= $user->kode_warna_ketersediaan ?>;cursor: pointer;"><?= $user->nama_ketersediaan ?></option>
										<?php foreach ($ketersediaan as $k) : ?>
											<option value="<?= $k->id_ketersediaan ?>" style="background-color:<?= $k->kode_warna_ketersediaan ?>;cursor: pointer;"><?= $k->nama_ketersediaan ?></option>
										<?php endforeach; ?>
									</select>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="user-btm-box">
					<!-- <div class="row">
						<div class="col-md-12 b-b text-center">
							<h6><b>SKPD
								</b></h6>
							<h6><?= isset($user->nama_skpd) ? ($user->nama_skpd) : "-"; ?>
							</h6>
						</div>
					</div> -->
					<div class="row">
						<div class="col-md-6 b-r text-center">
							<h6><b>Unit Kerja</b></h6>
							<h6>
								<?= isset($user->nama_unit_kerja) ? ($user->nama_unit_kerja) : "-"; ?>
							</h6>
						</div>
						<div class="col-md-6 text-center">
							<h6><b>Jabatan</b></h6>
							<h6>
								<?= isset($user->jabatan) ? ($user->jabatan) : "-"; ?>
							</h6>
						</div>
					</div>
				</div>
			</div>
			<a href="<?= base_url('pengaturan_akun') ?>" class="btn btn-primary btn-block"><i class="fa fa-cog"></i> Pengaturan Akun</a>
			<a href="javascript:void(0)" onclick="resToken(<?= $user->id_pegawai ?>)" class="btn btn-warning btn-block"><i class="fa fa-refresh"></i> Reset Login Android</a>


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
							<form action="<?= base_url('dashboard_user/updatePassword/' . $id_user) ?>" method="post">
								<div class="form-group">
									<label for="recipient-name" class="control-label">Password Lama</label>
									<input type="password" class="form-control" name="old_password" placeholder="masukan password lama anda">
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label">Password Baru</label>
									<input type="password" class="form-control" name="n_password" placeholder="masukan password baru anda">
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label">Konfirmasi Password Baru</label>
									<input type="password" class="form-control" name="cn_password" placeholder="konfirmasi password baru anda">
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
			<!-- <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi KGB</b></h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-4 b-r text-center">
                    <h6><b>TMT</b></h6>
                    <h6>
                      01-10-2016
                    </h6>
                  </div>
                  <div class="col-md-4 b-r text-center">
                    <h6><b>Masa Kerja</b></h6>
                    <h6>
                      14-04
                    </h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <h6><b>Gaji Pokok</b></h6>
                    <h6>
                      3.456.200
                    </h6>
                  </div>
                </div>
              </div>
              <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi Kenaikan Pangkat</b></h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Pangkat / Golongan</b></h6>
                    <h6><?= isset($data_by_bkd->pangkat) ? $data_by_bkd->pangkat : "-"; ?><?= isset($data_by_bkd->gol) ? $data_by_bkd->gol : "-"; ?></h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-4 b-r text-center">
                    <h6><b>TMT</b></h6>
                    <h6>
                      01-10-2016
                    </h6>
                  </div>
                  <div class="col-md-4 b-r text-center">
                    <h6><b>Masa Kerja</b></h6>
                    <h6>
                      14-04
                    </h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <h6><b>Gaji Pokok</b></h6>
                    <h6>
                      3.456.200
                    </h6>
                  </div>
                </div>
              </div>
              <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi Kenaikan Pangkat</b></h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>TMT</b></h6>
                    <h6>01-02-2031</h6>
                  </div>
                </div>
              </div>
              <a href="#" class="btn btn-primary btn-block disabled">Update Profile Kepegawaian</a> -->
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Kotak Masuk</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-envelope-o text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= $total_surat_masuk ?> </span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Agenda</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-calendar text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;">
									<?= $total_agenda; ?>
								</span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Catatan</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-bell-o text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= $total_catatan ?></span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Kegiatan</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-bookmark text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= count($kegiatan_personal); ?></span>
							</li>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php if ($pengumuman == true) : ?>
				<div class="row">
					<div class="m-b-15" style="background-color:#A3A0FB;">
						<div id="myCarouse2" class="carousel vcarousel slide p-20">
							<!-- Carousel items -->
							<div class="carousel-inner ">
								<?php
								$no = 1;
								$item_class = 'active ';
								foreach ($pengumuman as $png) :
								?>
									<div class="<?= $item_class ?>item">
										<p style="color:#FFED00"><span class="fa fa-bell"></span> Informasi / Pengumuman Hari Ini <small class="pull-right" style="color:white"><?= $no ?> / <?= count($pengumuman) ?></small></p>
										<p class="text-center" style="color:white;">" <?= $png->isi ?> "</p>
										<i class="text-right" style="color:white;"><small> Oleh : <?= $png->nama_lengkap ?></small></i>
									</div>
								<?php
									$item_class = '';
									$no++;
								endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="row">
					<div class="col-md-5">
						<div class="white-box" style="height:609px;">
							<div class="row b-b">
								Daftar Kegiatan Personal
								<a href="<?= base_url() ?>/kegiatan_personal" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<br>
							<ul class="list-task list-group" data-role="tasklist">
								<?php if ($kegiatan_personal == true) : ?>
									<?php
									$i = 0;
									foreach ($kegiatan_personal as $keg) : ?>
										<li class="list-group-item" data-role="task">
										<li class="list-group-item" data-role="task">
											<?php
											if ($keg->status_kegiatan != "SELESAI DIVERIFIKASI") {
											?>
												<i class="fa fa-calendar-o" style="font-size:20px;color:red"></i>
												<b> <span><?= $keg->nama_kegiatan; ?> </span> </b>
											<?php
											} else {
											?>
												<i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
												<b> <span><a href="<?= base_url() ?>/kegiatan_personal/detail_kegiatan/<?= $user_id ?>/<?= $keg->id_kegiatan_personal ?>" target="_blank" style="color:#4f5467"><?= $keg->nama_kegiatan; ?></a> </span></b>
											<?php
											}
											?>
											<?php
											$warna = "danger";
											if ($keg->status_kegiatan == "BELUM DIKERJAKAN") {
												$nilai = 0;
											} elseif ($keg->status_kegiatan == "MENUNGGU VERIFIKASI") {
												$nilai = 50;
											} elseif ($keg->status_kegiatan == "SELESAI DIVERIFIKASI") {
												$warna = "primary";
												$nilai = 100;
											}
											?>
											<div class="pull-right"><small><?= $nilai; ?>%</small></div>
											<div class="progress">
												<div class="progress-bar progress-bar-<?= $warna ?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= $nilai ?>%"> <span class="sr-only">52% Complete</span></div>
											</div>
										</li>
									<?php
										if (++$i == 7) break;
									endforeach; ?>
								<?php else : ?>
									<li class="list-group-item" data-role="task" style="margin-top:-5px">
										<small>BELUM ADA KEGIATAN YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('realisasi_kegiatan'); ?> ">Lihat Kegiatan</a> </span></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-md-7" style="height:609px;overflow:hidden;">
						<div class="white-box">
							<div class="row b-b">
								Log Aktivitas
								<a href="<?= base_url('logs') ?>" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<br>
							<div class="steamline">
								<?php
								foreach ($logs as $l) {
								?>
									<div class="sl-item">
										<div class="sl-left"> <img class="img-circle" alt="user" src="<?= base_url() . 'data/foto/pegawai/' . $l->user_picture ?>"> </div>
										<div class="sl-right">
											<div><a href="#"><?= $l->full_name ?></a></div>
											<p style="margin: 0;padding: 0;line-height: 2"><?= $l->activity ?>
											</p>
											<span class="sl-date"><?php
																	$e = explode(' ', $l->time);
																	$date = tanggal($e[0]);
																	$t = stime($e[1]);
																	echo $date . ' ' . $t;
																	?></span>
										</div>
									</div>
								<?php } ?>
								<hr>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-5">
						<div class="white-box" style="min-height:290px">
							<div class="row b-b">
								Agenda Pribadi
								<a href="<?= base_url() ?>/agenda_pribadi" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<ul class="feeds" style="padding-top:10px;">
								<?php if ($agenda_pribadi == true) {
									$i = 0;
									foreach ($agenda_pribadi as $ap) {
										$start = new DateTime(date("Y-m-d"));
										$end = new DateTime($ap->start_date);
										$interval = $start->diff($end);
										$hrs = $interval->d;
										if ($start <= $end) {
											if (count($ap->id) >= 1) {
												if ($ap == true) {
													if (++$i == 4) break;
													if ($hrs == 0) : ?>
														<li style="margin-top:-5px">
															<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $ap->title ?> <span class="text-muted">Hari ini </span>
														</li>
														<li style="margin-top:-5px">
														<?php elseif ($hrs >= 1) : ?>
														<li style="margin-top:-5px">
															<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $ap->title ?> <span class="text-muted"><?= $hrs . " Hari lagi"; ?> </span>
														</li>
														<li style="margin-top:-5px">
														<?php endif; ?>
										<?php  }
											}
										}
									}
								} else { ?>
														<li style="margin-top:-5px">
															<small>BELUM ADA AGENDA YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('agenda_pribadi'); ?> ">Lihat Agenda</a> </span></li>
														<li style="margin-top:-5px">
														<?php	 }  ?>
							</ul>
						</div>
					</div>
					<div class="col-md-7">
						<div class="white-box" style="min-height:290px">
							<div class="row b-b">
								Agenda Umum
								<a href="<?= base_url() ?>/agenda_umum" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<ul class="feeds" style="padding-top:10px;">
								<?php if ($agenda_umum == true) : ?>
									<?php
									$i = 0;
									foreach ($agenda_umum as $au) { ?>
										<?php
										$start = new DateTime(date("Y-m-d"));
										$end = new DateTime($au->start_date);
										$interval = $start->diff($end);
										$hrs = $interval->d;
										?>
										<?php if ($start <= $end) :
											if (++$i == 4) break;
										?>
											<?php if ($hrs == 0) : ?>
												<li style="margin-top:-5px">
													<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div><?= $au->title ?><span class="text-muted">Hari ini </span><span class="pull-right" style="margin-top:30px;"><small>Oleh </small><i><?= $au->nama_lengkap ?></i></span>
												</li>
												<li style="margin-top:-5px">
												<?php elseif ($hrs >= 1) : ?>
												<li style="margin-top:-5px">
													<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $au->title ?> <span class="text-muted"><?= $hrs . " Hari lagi"; ?> </span>
													<h6 class="pull-right" style="margin-top:30px;"><small>Oleh </small><i><?= $au->nama_lengkap ?></i></h6>
												</li>
												<li style="margin-top:-5px">
												<?php endif; ?>
											<?php endif; ?>
										<?php }  ?>
									<?php else : ?>
												<li style="margin-top:-5px">
													<small>BELUM ADA AGENDA YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('agenda_umum'); ?> ">Lihat Agenda</a> </span></li>
												<li style="margin-top:-5px">
												<?php endif; ?>

							</ul>
						</div>

					</div>
				</div>
				<div class="row" style="visibility : hidden">
					<div class="demo-container" style="height:1px;display:none;">
						<div id="placeholder" class="demo-placeholder"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-line-chart"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-line-chart-moving"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-bar-chart"></div>
					</div>
					<div class="flot-chart" style="height:1px;">
						<div class="sales-bars-chart" style="height:1px;"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>

		<div id="modalLogTPP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Detail Log TPP</h4>
					</div>
					<div class="modal-body">
						<h4>Overflowing text to show scroll behavior</h4>
						<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
						<p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!-- /.row -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() . "asset/chartjs-plugin-labels/"; ?>src/chartjs-plugin-labels.js"></script>
		<script>
			function resToken(id) {
				swal({
						title: "Reset Token",
						text: "Apakah anda yakin akan mereset token akun ini?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: '#DD6B55',
						confirmButtonText: 'Ya',
						cancelButtonText: "Tidak",
						closeOnConfirm: false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								url: "<?= base_url('dashboard_user/reset_token') ?>/" + id,
								type: "POST",
								dataType: "JSON",
								success: function(data) {
									$('#modalMisi').modal('hide');
									swal("Berhasil", "Token berhasil direset!", "success");
									location.reload();
								},
								error: function(jqXHR, textStatus, errorThrown) {
									alert('Error deleting data');
								}
							});
						}
					});
			}

			function showLogTPP(bulan, tahun) {
				$('#modalLogTPP').modal('show');
			}
		</script>