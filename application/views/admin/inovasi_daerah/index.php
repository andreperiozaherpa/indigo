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
		<div class="col-md-12">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-4 col-xs-12 col-sm-6">
							<div class="white-box text-center bg-info">
								<h1 class="text-white counter"><?= count($inisiatif) ?></h1>
								<p class="text-white">Inisiatif</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-6">
							<div class="white-box text-center">
								<h1 class="counter"><?= count($ujicoba) ?></h1>
								<p class="text-muted">Uji Coba</p>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-6">
							<div class="white-box text-center bg-success">
								<h1 class="text-white counter"><?= count($penerapan) ?></h1>
								<p class="text-white">Penerapan</p>
							</div>
						</div>
					</div>
					<?php
					$date = date('Y-m-d');
					if ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup) { ?>
						<span>* Formulir penginputan akan ditutup <b id="demo"></b> lagi</span>
						<br><br>
					<?php } ?>
					<div class="white-box">
						<ul class="nav customtab nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> Semua</span></a></li>
							<li role="presentation" class=""><a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Inisiatif</span></a></li>
							<li role="presentation" class=""><a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Uji Coba</span></a></li>
							<li role="presentation" class=""><a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Penerapan</span></a></li>
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="home1">
								<?php if ($this->session->flashdata('success')) { ?>
									<div class="alert alert-success">
										<?= $this->session->flashdata('success') ?>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<!-- <?php if (in_array('admin_indeks_inovasi', $user_privileges) || in_array('indeks_inovasi', $user_privileges) || $user_level == 'Administrator') {
														$date = date('Y-m-d');
														if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) { ?> -->
											<a href="<?= base_url('inovasi_daerah/add') ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Inovasi</a>
											<!-- <?php
														}
													?>
											<?php } ?> -->
										</div>
										<div class="col-md-6 text-right">
											<?php if (in_array('admin_indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
												<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#tutupForm">
													<i class="fa fa-cog"></i> Setting Form
												</button>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="modal fade" id="tutupForm" tabindex="-1" role="dialog" aria-labelledby="tutupFormLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="tutupFormLabel">Apakah anda yakin untuk menutup Form ?</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="POST">
													<div class="form-group">
														<label for="">Tanggal dibuka pengipuntan</label>
														<input type="date" name="tanggal_mulai" value="<?= $status_form->tanggal_mulai ?>" class="form-control" required>
													</div>
													<div class="form-group">
														<label for="">Tanggal ditutup penginputan</label>
														<input type="date" name="tanggal_tutup" value="<?= $status_form->tanggal_tutup ?>" class="form-control" required>
													</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="submit" name="setting-form" class="btn btn-primary">Simpan</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<br>
								<div class="table-responsive">
									<table id="inovasi1" class="" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Inovasi</th>
												<th>Nama Perangkat Daerah</th>
												<th>Tahapan Inovasi</th>
												<th>Waktu Uji Coba Inovasi Daerah</th>
												<th>Waktu Penerapan Inovasi Daerah</th>
												<th>Waktu Penginputan</th>
												<?php if (in_array('admin_indeks_inovasi', $user_privileges) || in_array('indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
													<th>Kematangan</th>
													<th>Aksi</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$CI = &get_instance();
											$CI->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
											foreach ($list as $key => $v) {
												$skor = $CI->ppiim->get_total_skor($v->id_inovasi_daerah);
											?>
												<tr>
													<td><?= $no++ ?></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" target="_blank">
															<b><?= $v->nama ?></b>
														</a>
													</td>
													<td>
														<b><?= $v->nama_skpd ?></b>
														<?php if ($v->nama_desa != null) { ?>
															<br>
															<i><small>(<?= $v->nama_desa ?>)</small> </i>
														<?php } ?>
													</td>
													<td class="text-center">
														<?php
														if ($v->tahapan == 'Penerapan') {
															$color = 'success';
														} elseif ($v->tahapan == 'Inisiatif') {
															$color = 'info';
														} else {
															$color = 'primary';
														}
														?>
														<span class="badge badge-<?= $color ?> ">
															<?= $v->tahapan ?>
														</span>
													</td>
													<td><?= date('d, M Y', strtotime($v->waktu_ujicoba)) ?></td>
													<td><?= date('d, M Y', strtotime($v->waktu_implementasi)) ?></td>
													<td><?= date('d, M Y H:i:s', strtotime($v->created_at)) ?></td>
													<?php if (in_array('admin_indeks_inovasi', $user_privileges) || in_array('indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
														<td><b><?= isset($v->kematangan) ? $v->kematangan . ' <i class="fa fa-check-circle text-success" title="Skor Final"></i> ' : $skor->total . ' <i class="fa fa-robot text-warning" title="Skor Otomatis"></i> '; ?></b></td>
														<td>
															<a href="<?= base_url('inovasi_daerah/indikator/' . $v->id_inovasi_daerah) ?>" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
															<?php if ($v->status_kirim == 'Y') { ?>
																<i class="fa fa-check text-success" title="Sudah terkirim ke Bapppeda"></i>
																<?php if (in_array('admin_indeks_inovasi', $user_privileges) || $user_level == 'Administrator') { ?>
																	<a href="<?= base_url('inovasi_daerah/delete/' . $v->id_inovasi_daerah) ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
																<?php } ?>
															<?php } else { ?>
																<a href="<?= base_url('inovasi_daerah/delete/' . $v->id_inovasi_daerah) ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
																<a href="<?= base_url('inovasi_daerah/kirim/' . $v->id_inovasi_daerah) ?>" title="Kirim ke Bapppeda"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
																<a href="<?= base_url('inovasi_daerah/edit/' . $v->id_inovasi_daerah) ?>" title="Edit Proposal" target="_blank"><i class="text-muted fa fa-edit"></i></a>&nbsp;
															<?php } ?>
															<a href="<?= base_url('inovasi_daerah/pdf/' . $v->id_inovasi_daerah) ?>" title="Export Proposal" target="_blank"><i class="text-muted fa fa-file"></i></a>&nbsp;
															<!-- <a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" title="Lihat Proposal" target="_blank"><i class="text-muted fa fa-eye"></i></a>&nbsp; -->
														</td>
													<?php } ?>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="profile1">
								<div class="table-responsive">
									<table id="inovasi5" class="" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Inovasi</th>
												<th>Nama Perangkat Daerah</th>
												<th>Tahapan Inovasi</th>
												<th>Waktu Uji Coba Inovasi Daerah</th>
												<th>Waktu Penerapan Inovasi Daerah</th>
												<th>Kematangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$CI = &get_instance();
											$CI->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
											foreach ($inisiatif as $key => $v) {
												$skor = $CI->ppiim->get_total_skor($v->id_inovasi_daerah);
											?>
												<tr>
													<td><?= $no++ ?></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" target="_blank">
															<b><?= $v->nama ?></b>
														</a>
													</td>
													<td>
														<b><?= $v->nama_skpd ?></b>
													</td>
													<td class="text-center">
														<?php
														if ($v->tahapan == 'Penerapan') {
															$color = 'success';
														} elseif ($v->tahapan == 'Inisiatif') {
															$color = 'info';
														} else {
															$color = 'primary';
														}
														?>
														<span class="badge badge-<?= $color ?> ">
															<?= $v->tahapan ?>
														</span>
													</td>
													<td><?= date('d, M Y', strtotime($v->waktu_ujicoba)) ?></td>
													<td><?= date('d, M Y', strtotime($v->waktu_implementasi)) ?></td>
													<td><b><?= $skor->total ?></b></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/indikator/' . $v->id_inovasi_daerah) ?>" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<?php if ($v->status_kirim == 'Y') { ?>
															<i class="fa fa-check text-success" title="Sudah terkirim ke Bapppeda"></i>
														<?php } else { ?>
															<a href="<?= base_url('inovasi_daerah/kirim/' . $v->id_inovasi_daerah) ?>" title="Kirim ke Bapppeda"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/edit/' . $v->id_inovasi_daerah) ?>" title="Edit Proposal" target="_blank"><i class="text-muted fa fa-edit"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/delete/' . $v->id_inovasi_daerah) ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
														<?php } ?>
														<a href="<?= base_url('inovasi_daerah/pdf/' . $v->id_inovasi_daerah) ?>" title="Export Proposal" target="_blank"><i class="text-muted fa fa-file"></i></a>&nbsp;
														<!-- <a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" title="Lihat Proposal" target="_blank"><i class="text-muted fa fa-eye"></i></a>&nbsp; -->
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="messages1">
								<div class="table-responsive">
									<table id="inovasi3" class="p" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Inovasi</th>
												<th>Nama Perangkat Daerah</th>
												<th>Tahapan Inovasi</th>
												<th>Waktu Uji Coba Inovasi Daerah</th>
												<th>Waktu Penerapan Inovasi Daerah</th>
												<th>Kematangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$CI = &get_instance();
											$CI->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
											foreach ($ujicoba as $key => $v) {
												$skor = $CI->ppiim->get_total_skor($v->id_inovasi_daerah);
											?>
												<tr>
													<td><?= $no++ ?></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" target="_blank">
															<b><?= $v->nama ?></b>
														</a>
													</td>
													<td>
														<b><?= $v->nama_skpd ?></b>
													</td>
													<td class="text-center">
														<?php
														if ($v->tahapan == 'Penerapan') {
															$color = 'success';
														} elseif ($v->tahapan == 'Inisiatif') {
															$color = 'info';
														} else {
															$color = 'primary';
														}
														?>
														<span class="badge badge-<?= $color ?> ">
															<?= $v->tahapan ?>
														</span>
													</td>
													<td><?= date('d, M Y', strtotime($v->waktu_ujicoba)) ?></td>
													<td><?= date('d, M Y', strtotime($v->waktu_implementasi)) ?></td>
													<td><b><?= $skor->total ?></b></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/indikator/' . $v->id_inovasi_daerah) ?>" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<?php if ($v->status_kirim == 'Y') { ?>
															<i class="fa fa-check text-success" title="Sudah terkirim ke Bapppeda"></i>
														<?php } else { ?>
															<a href="<?= base_url('inovasi_daerah/kirim/' . $v->id_inovasi_daerah) ?>" title="Kirim ke Bapppeda"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/edit/' . $v->id_inovasi_daerah) ?>" title="Edit Proposal" target="_blank"><i class="text-muted fa fa-edit"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/delete/' . $v->id_inovasi_daerah) ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
														<?php } ?>
														<a href="<?= base_url('inovasi_daerah/pdf/' . $v->id_inovasi_daerah) ?>" title="Export Proposal" target="_blank"><i class="text-muted fa fa-file"></i></a>&nbsp;
														<!-- <a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" title="Lihat Proposal" target="_blank"><i class="text-muted fa fa-eye"></i></a>&nbsp; -->
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="settings1">
								<div class="table-responsive">
									<table id="inovasi4" class="" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Inovasi</th>
												<th>Nama Perangkat Daerah</th>
												<th>Tahapan Inovasi</th>
												<th>Waktu Uji Coba Inovasi Daerah</th>
												<th>Waktu Penerapan Inovasi Daerah</th>
												<th>Kematangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$CI = &get_instance();
											$CI->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
											foreach ($penerapan as $key => $v) {
												$skor = $CI->ppiim->get_total_skor($v->id_inovasi_daerah);
											?>
												<tr>
													<td><?= $no++ ?></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" target="_blank">
															<b><?= $v->nama ?></b>
														</a>
													</td>
													<td>
														<b><?= $v->nama_skpd ?></b>
													</td>
													<td class="text-center">
														<?php
														if ($v->tahapan == 'Penerapan') {
															$color = 'success';
														} elseif ($v->tahapan == 'Inisiatif') {
															$color = 'info';
														} else {
															$color = 'primary';
														}
														?>
														<span class="badge badge-<?= $color ?> ">
															<?= $v->tahapan ?>
														</span>
													</td>
													<td><?= date('d, M Y', strtotime($v->waktu_ujicoba)) ?></td>
													<td><?= date('d, M Y', strtotime($v->waktu_implementasi)) ?></td>
													<td><b><?= $skor->total ?></b></td>
													<td>
														<a href="<?= base_url('inovasi_daerah/indikator/' . $v->id_inovasi_daerah) ?>" title="Input Indikator Satuan Inovasi Daerah"><i class="text-muted fa fa-folder"></i></a>&nbsp;
														<?php if ($v->status_kirim == 'Y') { ?>
															<i class="fa fa-check text-success" title="Sudah terkirim ke Bapppeda"></i>
														<?php } else { ?>
															<a href="<?= base_url('inovasi_daerah/kirim/' . $v->id_inovasi_daerah) ?>" title="Kirim ke Bapppeda"><i class="text-muted fa fa-paper-plane"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/edit/' . $v->id_inovasi_daerah) ?>" title="Edit Proposal" target="_blank"><i class="text-muted fa fa-edit"></i></a>&nbsp;
															<a href="<?= base_url('inovasi_daerah/delete/' . $v->id_inovasi_daerah) ?>" onclick="return confirm('apakah anda yakin menghapus data ini?')" title="Hapus Proposal"><i class="text-muted fa fa-trash"></i></a>&nbsp;
														<?php } ?>
														<a href="<?= base_url('inovasi_daerah/pdf/' . $v->id_inovasi_daerah) ?>" title="Export Proposal" target="_blank"><i class="text-muted fa fa-file"></i></a>&nbsp;
														<!-- <a href="<?= base_url('inovasi_daerah/detail/' . $v->id_inovasi_daerah) ?>" title="Lihat Proposal" target="_blank"><i class="text-muted fa fa-eye"></i></a>&nbsp; -->
													</td>
												</tr>
											<?php } ?>
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
<script>
	function confirmDelete() {
		if (confirm("Confirm message")) {
			// do stuff
		} else {
			return false;
		}
	}
	<?php if ($status_form->tanggal_mulai && $status_form->tanggal_tutup) { ?>

		var countDownDate = new Date("<?= $status_form->tanggal_tutup ?>").getTime();

		var x = setInterval(function() {

			var now = new Date().getTime();

			var distance = countDownDate - now;

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			document.getElementById("demo").innerHTML = days + "h " + hours + "j " +
				minutes + "m " + seconds + "d ";

			if (distance < 0) {
				clearInterval(x);
				document.getElementById("demo").innerHTML = "EXPIRED";
			}
		}, 1000);

	<?php } ?>
</script>