<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title" style="margin-bottom:0px;color:#6003C8">Markonah</h4>
			<p>Mari Kerja Online dari Rumah</p>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Markonah</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>



	<div class="col-md-4">
		<div class="row">
			<div class="add-button-container">
				<a href="<?= base_url('kerja_luar_kantor/add') ?>" class="btn btn-lg btn-rounded btn-primary btn-block"><span class="btn-label"><i data-icon="&#xe003;" class="linea-icon linea-elaborate"></i></span>Tambah Ajuan Surat Kerja Luar Kantor</a>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="white-box" style="border-left: solid 3px #6003c8">
			<div class="row">
				<div class="col-md-2 col-sm-2 text-center b-r hidden-xs" style="min-height:70px;">
					<img src="<?= base_url() ?>asset/logo/surat.png" width="80px" height="60px" alt="">
				</div>
				<div class="col-md-10 col-sm-10 col-xs-12">
					<div class="row b-b">
						<div class="col-md-12 text-center" style="color: #6003c8">
							<b>STATUS SURAT</b>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-xs-6 text-center b-r">
							<h3 class="box-title m-b-0"><?= $total ?></h3>
							<a style="color: #6003c8" href="<?= base_url() ?>surat_eksternal/surat_keluar">Total Surat</a>
						</div>
						<div class="col-md-3 col-xs-6  text-center b-r">
							<h3 class="box-title m-b-0">0</h3>
							<a style="color: #6003c8" href="<?= base_url() ?>surat_eksternal/surat_keluar/status_surat/perlu_tanggapan">Perlu tanggapan</a>
						</div>
						<div class="col-md-3 col-xs-6  text-center b-r ">
							<h3 class="box-title m-b-0">0</h3>
							<a style="color: #6003c8" href="<?= base_url() ?>surat_eksternal/surat_keluar/status_surat/dalam_proses">Dalam Proses</a>
						</div>
						<div class="col-md-3 col-xs-6  text-center b-r ">
							<h3 class="box-title m-b-0">0</h3>
							<a style="color: #6003c8" href="<?= base_url() ?>surat_eksternal/surat_keluar/status_surat/selesai">Selesai</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_content">
			
				<?php
				if (!empty($list)) {
					foreach ($list as $l) {

						if ($l->id_surat_keluar !== NULL && $this->surat_keluar_model->get_status_surat($l->id_surat_keluar)) {
							$status_surat = $this->surat_keluar_model->get_status_surat($l->id_surat_keluar);
							$s = icon_surat($status_surat);
						} else {
							$s['c1'] = "warning";
							$s['c2'] = "#f8c255";
							$s['i1'] = "icon-envelope-open";
							$s['i2'] = "icon-envelope-open";
							$s['text'] = "Ajukan Surat";
						}

				?>

						<div class="mail col-md-4">
							<div class="mail-status <?= $s['c1'] ?>" style="background-color: <?= $s['c2'] ?>">
								<i class="<?= $s['i1'] ?>"></i> <?= $s['text'] ?>
							</div>
							<div class="white-box body">
								<div class="row">
									<h4 class="mail-title"><?= $l->nama_kegiatan ?></h4>
									<div style="width: 80%;">
										<span class="label label-primary"><i class="ti-location-pin"></i> <?= normal_string($l->lokasi_pengerjaan) ?></span>
									</div><div class="mail-receiver">
										<i class="ti-bookmark-alt"></i> <span class="text">Deskripsi Kegiatan</span> <span data-toggle="tooltip" data-placement="top" title="Tanggal Mulai Kegiatan" class="label label-primary pull-right" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?= tanggal($l->tanggal_awal) ?></span>
									</div>
									<div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; !important">
										<?= $l->deskripsi_kegiatan ?>
									</div>
									<div class="mail-receiver">
										<i class="ti-target"></i> <span class="text">Target</span> <span data-toggle="tooltip" data-placement="top" title="Tanggal Akhir Kegiatan" class="label label-primary pull-right" style="background-color: #fff;color: #6003C8;border:solid 1px #6003C8;border-radius: 0;"><?= tanggal($l->tanggal_akhir) ?></span>
									</div>
									<div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; !important">
										<?= $l->target_kegiatan ?>
									</div>
									<div class="mail-footer">
										<a href="<?= base_url('kerja_luar_kantor/detail/' . $l->id_kerja_luar_kantor) ?>" class="btn btn-primary pull-right"><i class="ti-arrow-circle-right"></i> Detail Pengajuan</a>
									</div>
								</div>
							</div>
						</div>

					<?php }
				} else {
					?>
					<center><br><br>
						<img src="<?= base_url('data/upload/email.png') ?>" style="width:100px;">
						<h4 style="color: #6003C8;font-weight:500">TIDAK ADA PENGAJUAN DITEMUKAN</h4>
						<p>Silahkan klik tombol "Tambah Ajuan Surat Kerja Luar Kantor" untuk membuat Surat Izin</p>
					</center>
				<?php
				} ?>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12 pager">
				<?php
				echo make_pagination($pages, $current);
				?>
			</div>
		</div>
	</div>
	<!-- /#page-wrapper -->
</div>

<div class="modal fade bs-example-modal-lg" id="modalAjuanKerjaRumah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myLargeModalLabel">Pernyataan Kesediaan</h4>
			</div>
			<div class="modal-body">
				<center><img style="width: 75px;background-color:#6003c8;padding:10px;border-radius:50%" src="<?= base_url('data/upload/online-tracking.png') ?>"></center>
				<p style="margin-top:20px">Dengan dibuatnya usulan ini, maka saya bersedia <b>dipantau</b> melalui <i>Geolocation</i> dan apabila ternyata terbukti melakukan kecurangan maka saya bersedia diproses sesuai peraturan yang berlaku.</p>
			</div>
			<div class="modal-footer">
				<a href="<?= base_url('dashboard_user') ?>" class="btn btn-default waves-effect text-left">Tidak</a>
				<button type="button" class="btn btn-primary waves-effect text-left" data-dismiss="modal">Ya, Saya Bersedia</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->