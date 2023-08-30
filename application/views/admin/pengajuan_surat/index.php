<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Pengajuan Surat</h4>
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
							<div class="col-md-4">
								<div class="row">
									<div class="form-group">
										<label>Jenis Pengajuan Surat</label>
										<select class="form-control" name="jenis" id="" style="width:95%">
											<option value="">--Pilih--</option>
											<?php foreach ($jenis_pengajuan_surat as $jps) { ?>
												<option value="<?= $jps->id_ref_jenis_pengajuan_surat ?>" <?php if (!empty($jenis)) {
																											echo ($jps->id_ref_jenis_pengajuan_surat == $jenis) ? 'selected' : null;
																										} ?>><?= $jps->jenis_pengajuan_surat ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="form-group">
										<label>Periode Tanggal </label>
										<div class="input-daterange input-group" id="datepicker">
											<input type="text" class="form-control" name="start" placeholder="Start" />
											<span class="input-group-addon bg-primary b-0 text-white">Sampai</span>
											<input type="text" class="form-control" name="end" placeholder="End" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 b-l text-center">
							<div class="form-group">
								<br>
								<button type="submit" class="btn btn-primary m-t-5 btn-outline btn-block"><i class="ti-filter"></i> Filter</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
					<a href="<?php echo base_url('/pengajuan_surat/add'); ?> " class="btn btn-primary"><i class="icon-plus"></i> Tambah Pengajuan Surat </a>
				</div>
				<div class="col-md-10">
					<?php if ($this->session->flashdata('sukses')) : ?>
						<div class="alert alert-success text-center">
							<?php echo $this->session->flashdata('sukses'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<?php if ($list == false) : ?>
				<br>
				<div class="col-md-12">
					<div class="alert alert-danger">
						Belum ada Pengajuan Surat
					</div>
				</div>
			<?php endif; ?>
			<?php foreach ($list as $pj) : ?>
				<div class="mail col-md-3">
					<?php if ($pj->status == 'Belum Diverifikasi') {
						$color = '#00b4eb';
						$icon = 'ti-time';
					} else {
						$color = '#5ab190';
						$icon = 'ti-check-box';
					} ?>
					<div class="mail-status info" style="background-color: <?= $color ?>">
						<i class="<?= $icon ?>"></i> <?= $pj->status ?>
					</div>

					<div class="white-box body">
						<div class="row">
							<h4 class="mail-title"><?= $pj->lembaga_pendidikan ?></h4>
							<div>
								<span class="label label-primary"><i class="fa fa-flag"></i> <?= $pj->jenis_pengajuan_surat ?></span>
							</div>

							<div class="mail-footer"><span class="label label-primary pull-left" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?= tanggal(date('Y-m-d', strtotime($pj->created_at))) ?></span>
								<a href="https://e-office.sumedangkab.go.id/pengajuan_surat/detail/<?= $pj->id_pengajuan_surat ?>" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail Pengajuan</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
	<div class="row">
		<div class="col-md-12 pager">
			<?php
			if (!empty($list)) {
				echo make_pagination($pages, $current);
			}
			?>
		</div>
	</div>