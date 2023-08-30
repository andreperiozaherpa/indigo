<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Masuk Internal</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?= breadcrumb($this->uri->segment_array()) ?>
			</ol>
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
										<label class="control-label">Perihal Surat</label>
										<input type="text" id="" name="perihal" placeholder="Masukan Perihal Surat"
											class="form-control" value="<?= ($filter) ? $filter_data['perihal'] : '' ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">Tgl. Penerimaan Surat</label>
										<input type="text" class="form-control" name="tgl_input" id="datepicker"
											placeholder="Pilih Tanggal"
											value="<?= ($filter) ? $filter_data['tgl_input'] : '' ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">Pengirim</label>
										<input type="text" class="form-control" name="pengirim"
											placeholder="Masukan Pengirim"
											value="<?= ($filter) ? $filter_data['pengirim'] : '' ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label">Penerima</label>
										<input type="text" class="form-control" name="nama_skpd"
											placeholder="Masukan Penerima"
											value="<?= ($filter) ? $filter_data['nama_skpd'] : '' ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 b-l text-center">
							<div class="form-group">
								<br>
								<button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i
										class="ti-filter"></i> Filter</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="row">
			<div id="tambahSuratEksternal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
				aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">
									Tambah/Distribusikan Surat Masuk Internal</h4>
							</div>
						</div>
						<div class="modal-body">
							<form class="form-horizontal">
								<div class="form-group">
									<div class="row">
										<div class="col-md-4">
											<label class="col-md-12">Indeks</label>
											<input type="text" class="form-control" placeholder="Indeks">
										</div>

										<div class="col-md-4">
											<label class="col-md-12">Kode</label>
											<input type="text" class="form-control" placeholder="Kode">
										</div>

										<div class="col-md-4">
											<label class="col-md-12">No. Urut</label>
											<input type="text" class="form-control" placeholder="No. Urut">
										</div>


									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12">Perihal</label>
									<div class="col-md-12">
										<input type="text" class="form-control" placeholder="Masukan perihal surat">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12">Isi Ringkasan</label>
									<div class="col-md-12">
										<textarea class="form-control"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12">Dari</label>
									<div class="col-md-12">
										<input type="text" class="form-control" placeholder="Masukan perihal surat">
									</div>
								</div>


								<div class="form-group">
									<div class="col-md-4">
										<label class="col-sm-12">Tgl. Surat</label>
										<div class="col-sm-12">
											<input type="text" class="form-control mydatepicker"
												placeholder="mm/dd/yyyy">
										</div>
									</div>

									<div class="col-md-8">
										<label class="col-sm-12">No. Surat</label>
										<div class="col-sm-12">
											<input type="text" class="form-control ">
										</div>
									</div>



								</div>

								<div class="form-group">
									<label class="col-md-12">Sifat Surat</label>
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-3">
												<div class="radio radio-info">
													<input type="radio" name="radio" id="radio2" value="option2">
													<label for="radio2"> Biasa </label>
												</div>
											</div>
											<div class="col-md-3">
												<div class="radio radio-info">
													<input type="radio" name="radio" id="radio2" value="option2">
													<label for="radio2"> Penting </label>
												</div>
											</div>

											<div class="col-md-3">
												<div class="radio radio-info">
													<input type="radio" name="radio" id="radio2" value="option2">
													<label for="radio2"> Rahasia </label>
												</div>
											</div>
											<div class="col-md-3">

											</div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12">Scan Surat</label>
									<div class="col-md-12">
										<input type="file" id="input-file-now" class="dropify" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-12">Lampiran Surat</label>
									<div class="col-md-12">
										<input type="file" id="input-file-now" class="dropify" />
									</div>
								</div>



								<div class="form-group">
									<label class="col-md-12">Penerima</label>
									<div class="col-md-12">
										<select class="form-control select2">
											<option value="AK">Pegawai 1 - Jabatan</option>
											<option value="HI">Pegawai 2 - Jabatan</option>
											<option value="CA">Pegawai 3 - Jabatan</option>
											<option value="NV">Pegawai 4 - Jabatan</option>

										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-12">Catatan</label>
									<div class="col-md-12">
										<textarea class="form-control"></textarea>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect text-left"
								data-dismiss="modal">Batal</button>
							<button type="button" class="btn btn-primary waves-effect text-left"
								data-dismiss="modal">Simpan</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="white-box" style="border-left: solid 3px #6003c8">
			<div class="row">
				<div class="col-md-2 col-sm-2 text-center b-r" style="min-height:70px;">
					<img src="<?php echo base_url('asset/logo/surat.png'); ?>" width="80px" height="60px" alt="">
				</div>
				<div class="col-md-10 col-sm-10">
					<div class="row b-b">
						<div class="col-md-12 text-center" style="color: #6003c8">
							<b>STATUS SURAT</b>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 text-center b-r">
							<h3 class="box-title m-b-0">
								<?= count($total) ?>
							</h3>
							<a style="color: #6003c8" href="<?= base_url('naskah/surat_internal/surat_masuk') ?>">Total
								Surat</a>
						</div>
						<div class="col-md-3 text-center b-r">
							<h3 class="box-title m-b-0">
								<?= count($unread) ?>
							</h3>
							<a style="color: #6003c8"
								href="<?= base_url('naskah/surat_internal/surat_masuk') ?>/status_surat/Belum Dibaca">Belum
								dibaca</a>
						</div>
						<div class="col-md-3 text-center b-r ">
							<h3 class="box-title m-b-0">
								<?= count($read) ?>
							</h3>
							<a style="color: #6003c8"
								href="<?= base_url('naskah/surat_internal/surat_masuk') ?>/status_surat/Sudah Dibaca">Sudah
								dibaca</a>
						</div>
						<div class="col-md-3 text-center b-r ">
							<h3 class="box-title m-b-0">
								<?= count($mustread) ?>
							</h3>
							<a style="color: #6003c8"
								href="<?= base_url('naskah/surat_internal/surat_masuk') ?>/status_surat/Perlu Tanggapan">Perlu
								tanggapan</a>
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
				<?php
				if (!empty($summary_value) && !empty($summary_field)) {
					echo '<div class="alert alert-primary">Menampilkan data surat dengan ' . normal_string($summary_field) . ' = ' . normal_string($summary_value) . '</div>';
				}
				if (count($list) == 0) {
					echo "<div class='alert alert-danger'>Belum ada Surat</div>";
				} else { ?>
					<?php foreach ($list as $l) {
						if ($l->status_surat == 'Sudah Dibaca') {
							$color1 = "success";
							$color2 = "#00c292";
							$icon = "icon-envelope-letter";
							$icon2 = "icon-check";

						} elseif ($l->status_surat == "Belum Dibaca") {
							$color1 = "danger";
							$color2 = "#F75B36";
							$icon = "icon-envelope-open";
							$icon2 = "icon-close";

						} elseif ($l->status_surat == "Perlu Tanggapan") {
							$color1 = "warning";
							$color2 = "#f8c255";
							$icon = "icon-clock";
							$icon2 = "icon-info";
						}
						?>

						<div class="mail col-md-4">
							<div class="mail-status <?= $color1 ?>">
								<i class="<?= $icon ?>"></i> <?= normal_string($l->status_surat) ?>
							</div>

							<div class="white-box body">
								<div class="row">
									<h4 class="mail-title">
										<?= strlen($l->perihal) >= 70 ? substr($l->perihal, 0, 70) . "..." : $l->perihal ?></h4>
									<div style="width: 80%;">
										<span class="label label-primary"><i class="fa fa-envelope-square"></i>
											<?= humanize($l->sifat) ?></span>
									</div>
									<center>
									</center>

									<div class="mail-receiver">
										<i class="icon-people"></i> <span class="text">Penerima</span><span
											class="label label-primary pull-right"
											style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?= tanggal($l->tgl_input) ?></span>
									</div>

									<?= strlen($l->nama_skpd) >= 35 ? substr($l->nama_skpd, 0, 35) . "..." : $l->nama_skpd ?>

									<div class="mail-receiver">
										<i class="icon-paper-plane"></i> <span class="text">Pengirim</span> <span
											class="label label-primary pull-right"
											style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?= tanggal($l->tanggal_surat) ?></span>
									</div>
									<?= strlen($l->pengirim) >= 35 ? substr($l->pengirim, 0, 35) . "..." : $l->pengirim ?>
									<div class="mail-footer">
										<a href="<?php echo base_url('naskah/surat_internal/detail_surat_masuk/' . $l->id_surat_masuk); ?>"
											class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail
											Surat</a>
									</div>
								</div>
							</div>
						</div>

					<?php }
				} ?>



			</div>

		</div>

		<div class="row">
			<div class="col-md-12 pager">
				<?php
				if (!$filter) {
					echo make_pagination($pages, $current);
				}
				?>
			</div>
		</div>