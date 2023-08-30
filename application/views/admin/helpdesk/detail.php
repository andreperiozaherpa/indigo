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
			<?php if ($this->session->flashdata('error')) : ?>
				<div class="col-md-10">
					<div class="alert alert-warning">
						<p>File gagal diupload, silahkan coba kembali</p>
					</div>
				</div>
			<?php endif; ?>
			<a style="margin-bottom: 10px" href="<?= base_url('helpdesk') ?><?= isset($_GET['page']) ? '?page=' . $_GET['page'] : ''; ?>" class="btn btn-default pull-right"><i class="icon-arrow-left-circle"></i> Kembali</a><br><br>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">DETAIL HELPDESK
							<?php

							if ($detail->status == 'selesai') {
								$color = 'success';
								$icon = 'ti-check';
							} elseif ($detail->status == 'sedang_diproses') {
								$color = 'info';
								$icon = 'icon-options';
							} elseif ($detail->status == 'tutup') {
								$color = 'danger';
								$icon = 'icon-shield';
							} else {
								$color = 'warning';
								$icon = 'ti-time';
							}
							?>

							<span style="font-size: 12px !important" class="label label-<?= $color ?> pull-right"><i class="<?= $icon ?>"></i> <?= normal_string($detail->status) ?></span>
						</div>
						<div class="panel-body">
							<div class="row m-b">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nomor Bantuan</label>
										<p style="line-height: 0">
											<span class="label label-primary">#<?= $detail->no_bantuan ?></span> </p>
									</div>
									<div class="form-group">
										<label>Dibuat Oleh</label>
										<p style="line-height: 0"><?= $detail->full_name ?> - <b><?= $detail->username ?></b></p>
										<?php if ($user_level == "Administrator") { ?>
											<?= $detail->id_pegawai ?>
										<?php } ?>
									</div>
									<div class="form-group">
										<label>Pada</label>
										<p style="line-height: 0"><?= tanggal($detail->tgl_laporan) ?> <?= stime($detail->jam_laporan) ?></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Kategori</label>
										<p style="line-height: 0"><?= normal_string($detail->kategori) ?></p>
									</div>
									<?php
									if ($detail->kategori == 'bug') {
									?>
										<div class="form-group">
											<label>URL Bug</label>
											<p style="line-height: 0"><a target="_blank" href="<?= ($detail->url_bug) ?>"><?= ($detail->url_bug) ?></a></p>
										</div>
									<?php } ?>
								</div>
								<div class="row">
									<div class="col-md-12">
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<span style="border : solid 1px #cdcdcd;padding: 10px 10px 10px 0px;font-weight: 500">
											<i style="background-color: #6003c8;padding: 12px;color: #fff;margin-right: 10px" class="fa fa-paper-plane-o"></i><?= $detail->subjek ?> </span>
										<p style="margin-top: 10px"><?= $detail->isi ?></p>
									</div>
								</div>
								<?php
								if (!empty($lampiran)) {
								?>
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<b><i class="icon-paper-clip"></i> Lampiran</b>
												</div>
											</div>
											<?php
											foreach ($lampiran as $l) {
											?>
												<a target="_blank" href="<?= base_url('data/helpdesk/' . $l->file . '') ?>" class="btn btn-primary" style="color: #fff"><i class="icon-doc"></i> <?= $l->file ?></a>
											<?php
											}
											?>
										</div>
									</div>
								<?php
								}
								?>
							</div>
							<hr>
							<?php
							// if ($user_level == "Administrator" || in_array('kepegawaian', $privileges)) {
							if ($detail->status !== "menunggu_respon" && $detail->kategori == "koreksi_absen") {
								$this->db->join('pegawai', 'pegawai.id_pegawai = absen_koreksi.id_pegawai');
								$list_koreksi = $this->db->get_where('absen_koreksi', array('id_helpdesk' => $detail->id_helpdesk))->result();
							?>
								Daftar Absensi yang Sudah Dikoreksi
								<table class="table table-striped color-table primary-table">
									<thead>
										<tr>
											<th>No.</th>
											<th>NIP / Nama</th>
											<th>Tanggal Absensi</th>
											<th>Jam Masuk</th>
											<th>Jam Pulang</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (empty($list_koreksi)) {
										?>
											<tr>
												<td colspan="5" class="text-center">Belum ada absen yang di koreksi</td>
											</tr>
											<?php
										} else {
											foreach ($list_koreksi as $n => $l) {
												$no = $n + 1;
											?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $l->nip . " - " . $l->nama_lengkap ?></td>
													<td><?= tanggal($l->tanggal) ?></td>
													<td><?= $l->jam_masuk ?></td>
													<td><?= $l->jam_pulang ?></td>
												</tr>
										<?php }
										} ?>
									</tbody>
								</table>
								<hr>
							<?php
							}
							// }
							?>
							<?php if ($detail->status != 'tutup' && $detail->status != 'selesai') : ?>


								<form method="post">
									<?php if ($user_level == "Administrator" || (in_array('kepegawaian', $privileges) && $jenis_skpd !=='puskesmas' )) : ?>
										<?php if ($detail->status == "menunggu_respon") : ?>
											<button type="submit" name="prosess" class="btn btn-info pull-right"><i class="ti-loop"></i> Proses</button>
										<?php else : ?>
											<button type="submit" onclick="return confirm('Apakah anda yakin akan menyelesaikan proses ini?')" name="selesai" class="btn btn-success pull-right"><i class="ti-check"></i> Selesai</button>
											<?php
											if ($detail->kategori == "koreksi_absen") {
											?>
												<button type="button" onclick="showKoreksiAbsen()" class="btn btn-primary pull-right m-r-5"><i class="ti-share-alt"></i> Proses Koreksi Absen</button>
											<?php
											}
											?>
										<?php endif; ?>
									<?php else : ?>
										<!-- <a href="<?= base_url('helpdesk/ubah/' . $detail->id_helpdesk) ?>" class="btn btn-info pull-right" style="min-width:100px">Edit</a> -->
										<button type="submit" name="tutup" class="btn btn-danger pull-right">Tutup</button>
									<?php endif; ?>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="white-box">
						<div class="row">
							<div class="col-md-12">
								<div class="white-box">
									<h3 class="box-title">Respons</h3>
									<?php if ($respons == false) : ?>
										<h5>Belum ada komentar</h5>
									<?php endif; ?>
									<div class="comment-center">
										<?php foreach ($respons as $respon) : ?>
											<div class="comment-body col-md-12">
												<div class="user-img"> <img src="<?= base_url('data/foto/pegawai/' . $respon->user_picture); ?>" alt="user" class="img-circle"></div>
												<div class="mail-contnet">
													<h5><?= $respon->full_name ?>
														<a href="#" class="action" style="display:none"><i class="ti-check text-success"></i> </a>
														<?php if ($respon->level == $user_level && $respon->level != "Administrator") : ?>
															<a href="#" data-toggle="modal" data-target="#deleteRespons<?= $respon->id_helpdesk_respons ?>" class="action"><i class="ti-close text-danger "></i> </a>
														<?php elseif ($user_level == "Administrator") : ?>
															<a href="#" data-toggle="modal" data-target="#deleteRespons<?= $respon->id_helpdesk_respons ?>" class="action"><i class="ti-close text-danger "></i> </a>
														<?php endif; ?>
													</h5>
													<!-- modal delete respons -->
													<div id="deleteRespons<?= $respon->id_helpdesk_respons ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<!-- modal-content -->
															<div class="modal-content">
																<div class="modal-header" style="background-color:#f75b36">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	<h4 class="modal-title" id="myModalLabel" style="color:white">Alert !</h4>
																</div>
																<div class="modal-body">
																	<p> Apakah anda yakin akan menghapus komentar ini ?</p>
																	<blockquote>
																		<span style="font-size: 14px;
					 																				    margin: 8px 0;
					 																				    line-height: 25px;
					 																				    color: #848a96;
					 																				    height: 50px;
					 																				    overflow: hidden;"><?= $respon->isi ?></span>
																		<?php
																		$respons_file = $this->helpdesk_model->get_respons_file($respon->id_helpdesk_respons);
																		if ($respons_file == true) : ?>
																			<br>
																			<a href="<?= base_url('data/helpdesk/respons/' . $respon->id_helpdesk . '/' . $respons_file['file']); ?>"><small><?= $respons_file['file']; ?></small> </a>
																		<?php endif; ?>
																		<span class="time"><?= poee(date('N', strtotime($respon->waktu_respon))); ?>, <?= tanggal($respon->tgl_respon); ?>&nbsp;&nbsp;&nbsp;<?= date('H:i', strtotime($respon->waktu_respon)); ?> WIB</span>
																	</blockquote>
																</div>
																<div class="modal-footer">
																	<form method="post" enctype="multipart/form-data">
																		<input type="hidden" name="id_helpdesk_respons" value="<?= $respon->id_helpdesk_respons; ?>">
																		<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
																		<button type="submit" class="btn btn-danger waves-effect" name="hapusRespons">Hapus</button>
																	</form>
																</div>
															</div>
															<!-- /.modal-content -->
														</div>
													</div>
													<!-- /.modal-dialog -->
													<span style="font-size: 14px;
																				    margin: 8px 0;
																				    line-height: 25px;
																				    color: #848a96;
																				    height: 50px;
																				    overflow: hidden;"><?= $respon->isi ?></span>
													<?php
													$respons_file = $this->helpdesk_model->get_respons_file($respon->id_helpdesk_respons);
													if ($respons_file == true) : ?>
														<br>
														<i class="icon-paper-clip"> <a href="<?= base_url('data/helpdesk/respons/' . $respon->id_helpdesk . '/' . $respons_file['file']); ?>"><?= $respons_file['file']; ?></a> </i>
													<?php endif; ?>
													<span class="time"><?= poee(date('N', strtotime($respon->waktu_respon))); ?>, <?= tanggal($respon->tgl_respon); ?>&nbsp;&nbsp;&nbsp;<?= date('H:i', strtotime($respon->waktu_respon)); ?> WIB</span>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<br>
							<?php if ($detail->status != 'tutup' && $detail->status != 'selesai') : ?>
								<div class="col-md-12">
									<br>
									<form method="post" enctype="multipart/form-data">
										<div class="form-group">
											<textarea class="form-control" rows="3" name="isi" placeholder="Tulis komentar"></textarea>
											<small><i style="color:red">*</i> <i>format file yang diperbolehkan : gif|jpg|png|doc|docx|word|ppt|pdf|xls|rar|7zip|pptx|xlsx|jpeg (max 2 MB)</i> </small>
											<br>
											<label class="icon-paper-clip" for="file_respons" id="name_file" style="cursor:pointer"> <a href="#"></a> </label>

											<input type="file" name="file_respons" id="file_respons" style="display:none;">
											<input type="hidden" name="file_lama" value="default">
											<div class="form-group">
												<button type="submit" class="btn btn-success pull-right" name="respons">Submit</button>
											</div>
										</div>
									</form>
								</div>
							<?php else : ?>
								<div class="text-center" style="top:900px;">
									<div class="row">
										<h3 style="font-weight:bold"> kasus sudah <i class="text-danger">tutup</i> / <i class="text-success">selesai</i></h3>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

	<div id="modalKoreksiAbsen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">Koreksi Absen</h4>
				</div>
				<div class="modal-body">
					<form id="formKoreksiAbsen">
						<div class="form-group">
							<label style="display: block;">NIP / Nama Lengkap</label>
							<input type="text" name="id_pegawai" class="form-control">
						</div>
						<div class="form-group">
							<label style="display: block;">Tanggal</label>
							<input style="margin-top:10px" type="text" name="tanggal" onchange="checkAbsensi()" class="form-control" placeholder="Tanggal Kehadiran" id="datepicker" autocomplete="off">
							<small id="messageKoreksi"></small>
							<!-- <input type="checkbox" class="js-switch" name="rentang" onchange="toggleTanggal()" data-color="#6003c8" data-size="small" /> Rentang Tanggal
							<div id="tanggalSingle">
								<input style="margin-top:10px" type="text" name="tanggal" class="form-control" placeholder="Tanggal Kehadiran" id="datepicker" autocomplete="off">
							</div>
							<div id="tanggalMulti" style="display: none;">
								<div class="input-group" style="margin-top:10px">
									<input type="text" placeholder="Tanggal Awal" name="tanggal_awal" autocomplete="off" class="form-control " id="datepicker">
									<span class="input-group-addon">s.d</span>
									<input type="text" placeholder="Tanggal Akhir" name="tanggal_akhir" autocomplete="off" class="form-control " id="datepicker">
								</div>
							</div> -->
						</div>
						<div class="form-group">
							<label style="display: block;">Shift</label>
							<select name="id_shift" onchange="getShift()" class="form-control">
								<option value="">Pilih Shift</option>
								<?php 
									foreach($shift as $s){
										echo '<option value="'.$s->id_shift.'">'.$s->nama_shift.' ('.$s->jam_masuk.' - '.$s->jam_pulang.')</option>';
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label style="display: block;">Waktu Absensi </label>
							<input type="checkbox" class="js-switch" onchange="getShift()" id="toggleShift" data-color="#6003c8" data-size="small" /> Sesuaikan dengan Shift
							<div class="input-group" style="margin-top:10px">
								<input type="time" placeholder="Jam Masuk" onclick="changeJamMasuk()" name="jam_masuk" autocomplete="off" class="form-control">
								<span class="input-group-addon">s.d</span>
								<input type="time" placeholder="Jam Pulang" onclick="changeJamPulang()" name="jam_pulang" autocomplete="off" class="form-control">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
					<button type="button" class="btn btn-primary waves-effect" id="btnSimpan"><i class="ti-save"></i> Simpan</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script>
		function showKoreksiAbsen() {
			$('#modalKoreksiAbsen').modal('show');
		}

		$(document).ready(function() {
			var ALL_OPTION = {
				id: '<?= $detail->id_pegawai ?>',
				text: '<?= str_replace("'","\'",$detail->full_name) ?> - <?= $detail->username ?>'
			};
			$('[name="id_pegawai"]').select2({
				_minimumInputLength: 2,
				_ajaxQuery: Select2.query.ajax({
					url: '<?= base_url('helpdesk/get_pegawai') ?>',
					dataType: 'json',
					data: function(term, page) {
						return {
							search: term, //search term
						};
					},
					results: function(data, page) {
						return {
							results: data
						};
					}
				}),
				query: function(options) {
					if (options.term.length >= this._minimumInputLength) {
						this._ajaxQuery.call(this, options);
					} else {
						options.callback({
							results: [ALL_OPTION]
						});
					}
				}
			});
			$('[name="id_pegawai"]').select2('data', ALL_OPTION);

			function instrumentTooShortMessage($element) {
				var data = $element.data('select2'),
					$container = data.container,
					$dropDown = $container.find('.select2-drop'),
					$searchBox = $dropDown.find('.select2-search').find('input'),
					minLength = data.opts._minimumInputLength,
					$message = $('<div></div>')
					.text('Ketik kata kunci untuk melakukan Pencarian')
					.appendTo($dropDown);

				function toggleMessage() {
					var tooShort = ($searchBox.val().length < minLength);
					$message.toggle(tooShort);
				}

				$searchBox.on('input', function() {
					toggleMessage();
				});
				$element.on('select2-open', function() {
					toggleMessage();
				});
			}

			instrumentTooShortMessage($('[name="id_pegawai"]'));
			// $('[name="id_pegawai"]').select2({
			// 	minimumInputLength: 2,
			// 	allowClear: true,
			// 	placeholder: 'Cari NIP / Nama Pegawai',
			// 	ajax: {
			// 		dataType: 'json',
			// 		url: '<?= base_url('helpdesk/get_pegawai') ?>',
			// 		data: function(term, page) {
			// 			return {
			// 				search: term, //search term
			// 			};
			// 		},
			// 		results: function(data, page) {
			// 			return {
			// 				results: data
			// 			};
			// 		},
			// 	}
			// });
		}); // End of DataTable

		function toggleTanggal() {
			$('#tanggalSingle').toggle();
			$('#tanggalMulti').toggle();
		}


		function simpanKoreksi() {
			$.post("<?= base_url('helpdesk/simpanKoreksi/' . $detail->id_helpdesk) ?>", $("#formKoreksiAbsen").serialize(), function(data) {
				swal('Sukses', 'Absen berhasil dikoreksi', 'success');
				window.location.reload(false);
			});
		}

		function checkAbsensi() {
			var id_pegawai = $('[name="id_pegawai"]').val();
			var tanggal = $('[name="tanggal"]').val();
			$('#messageKoreksi').html('');
			$.getJSON("<?= base_url('helpdesk/checkAbsensi') ?>/" + id_pegawai + "/" + tanggal, function(data) {
				$('#btnSimpan').attr('onclick', 'simpanKoreksi()');
				if (data.status) {
					if (data.jam_masuk !== null && data.jam_pulang !== null) {
						$('#messageKoreksi').css('color', 'green');
						$('#messageKoreksi').html('Absensi pada tanggal tersebut ditemukan, dan <b>Sudah Lengkap</b>');
						$('[name="jam_masuk"]').val(data.jam_masuk);
						$('[name="jam_masuk"]').prop("readonly", true);
						$('[name="jam_pulang"]').val(data.jam_pulang);
						$('[name="jam_pulang"]').prop("readonly", true);
						$('[name="id_shift"]').val(data.id_shift);
						$('[name="id_shift"]').prop("readonly", true);
						// $('#btnSimpan').attr('onclick', 'return swal("Absen Sudah Lengkap","Jam Masuk dan Pulang sudah terisi, Anda tidak dapat mengubahnya lagi","warning")');
					} else {
						$('#messageKoreksi').css('color', 'green');
						$('#messageKoreksi').html('Absensi pada tanggal tersebut ditemukan, silahkan isi Jam yang masih kosong');
						$('[name="id_shift"]').val(data.id_shift);
						$('[name="id_shift"]').prop("readonly", true);
						if (data.jam_masuk !== "" && data.jam_masuk !== null) {
							$('[name="jam_masuk"]').val(data.jam_masuk);
							$('[name="jam_masuk"]').prop("readonly", true);
						} else {
							$('[name="jam_masuk"]').val('');
							$('[name="jam_masuk"]').prop("readonly", false);
						}
						if (data.jam_pulang !== "" && data.jam_pulang !== null) {
							$('[name="jam_pulang"]').val(data.jam_pulang);
							$('[name="jam_pulang"]').prop("readonly", true);
						} else {
							$('[name="jam_pulang"]').val('');
							$('[name="jam_pulang"]').prop("readonly", false);
						}
					}
				} else {
					$('#messageKoreksi').css('color', 'red');
					$('#messageKoreksi').html('Absensi pada tanggal tersebut tidak ditemukan, silahkan isi Jam Masuk dan Jam Keluar');
					$('[name="jam_masuk"]').val('');
					$('[name="jam_masuk"]').prop("readonly", false);
					$('[name="jam_pulang"]').val('');
					$('[name="jam_pulang"]').prop("readonly", false);
					$('[name="id_shift"]').val('');
					$('[name="id_shift"]').prop("readonly", false);
				}
			});
		}

		function getShift() {
			var id_pegawai = $('[name="id_pegawai"]').val();
			var id_shift = $('[name="id_shift"]').val();
			var tanggal = $('[name="tanggal"]').val();
			var toggle = $('#toggleShift').prop('checked');
			if (toggle == true) {
				if(id_shift === ''){
					alert('Pilih shift terlebih dahulu');
				}else{
					$.getJSON("<?= base_url('helpdesk/get_shift/') ?>/" + id_shift, function(data) {
					if (data.status) {
						if ($('[name="jam_masuk"]').prop('readonly') !== true) {
							$('[name="jam_masuk"]').val(data.jam_masuk);
						}
						if ($('[name="jam_pulang"]').prop('readonly') !== true) {
							$('[name="jam_pulang"]').val(data.jam_pulang);
						}
					} else {
						if ($('[name="jam_masuk"]').prop('readonly') !== true) {
							$('[name="jam_masuk"]').val('');
						}
						if ($('[name="jam_pulang"]').prop('readonly') !== true) {
							$('[name="jam_pulang"]').val('');
						}
					}
				});
				}
			} else {
				if ($('[name="jam_masuk"]').prop('readonly') !== true) {
					$('[name="jam_masuk"]').val('');
				}
				if ($('[name="jam_pulang"]').prop('readonly') !== true) {
					$('[name="jam_pulang"]').val('');
				}
			}
		}

		function changeJamMasuk() {

			if ($('[name="jam_masuk"]').prop('readonly') == true) {
				swal({
					title: "Apakah Anda Yakin?",
					text: "Akan mengubah Jam Masuk pegawai yang sebelumnya sudah ada?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ya",
					closeOnConfirm: true
				}, function(isConfirm) {
					if (!isConfirm) return;
					$('[name="jam_masuk"]').prop("readonly", false);
				});
			}
		}

		function changeJamPulang() {
			if ($('[name="jam_pulang"]').prop('readonly') == true) {
				swal({
					title: "Apakah Anda Yakin?",
					text: "Akan mengubah Jam Pulang pegawai yang sebelumnya sudah ada?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ya",
					closeOnConfirm: true
				}, function(isConfirm) {
					if (!isConfirm) return;
					$('[name="jam_pulang"]').prop("readonly", false);
				});
			}
		}
	</script>