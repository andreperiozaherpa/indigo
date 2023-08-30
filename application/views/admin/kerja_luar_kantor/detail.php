<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Ajuan Surat Kerja Luar Kantor</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="">Markonah</a></li>
				<li class="active">Detail Ajuan Surat Kerja Luar Kantor</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="white-box">
				<center>
					<img style="width: 200px;border-radius:50%;object-fit:cover" src="<?= base_url('data/foto/pegawai/' . $self_pegawai->user_picture) ?>">
					<h4 style="margin-bottom:0px"><?= $self_pegawai->nama_lengkap ?></h4>
					<p style="color:#6003c8"><?= $self_pegawai->nip ?></p>
				</center>
				<hr style="border-color:#6003c8">
				<?php
				if ($self_pegawai->kepala_skpd == 'Y') {
					$jenis_surat = 'surat_eksternal';
				} else {
					$jenis_surat = 'surat_internal';
				}

				?>
				<?php
				if ($detail->id_surat_keluar&&$this->surat_keluar_model->get_status_surat($detail->id_surat_keluar)) {
					$id_surat_keluar = $detail->id_surat_keluar;
					$detail_surat = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					$s = icon_surat($status_surat);
				?>

					<div class="text-center">
						<b>Status Perjalanan Surat</b><br><br>
						<p>
							<i style="font-size: 70px;" class="text-<?= $s['c1'] ?> <?= $s['i1'] ?>"></i>
						</p>
						<p>
							<span class="text-<?= $s['c1'] ?>">
								<i style="background-color: <?= $s['c2'] ?>;border-radius: 50%;color: #fff;padding: 5px;" class="<?= $s['i2'] ?>"></i> <?= $s['text'] ?>
							</span>
						</p>
					</div>
					<br>
					<?php
					if ($status_surat == 'sudah_ditandatangani') {
					?>
						<a href="<?= base_url('data/' . $jenis_surat . '/ttd/' . $detail_surat->file_ttd . '') ?>" class="btn btn-primary btn-block btn-outline"><i class="ti-download"></i> Download Surat</a>
					<?php
					}
					?>
					<a target="blank" href="<?= base_url($jenis_surat . "/detail_surat_keluar/$id_surat_keluar") ?>" class="btn btn-primary btn-block"><i class="ti-eye"></i> Lihat Surat Keluar</a>
				<?php
				} else {
				?>
					<a href="<?= base_url($jenis_surat . '/tambah_surat_keluar/903') ?>?id_kerja_luar_kantor=<?= $detail->id_kerja_luar_kantor ?>" target="_blank" class="btn btn-primary btn-block"><i class="ti-envelope"></i> Buat Surat Pengajuan</a>
					<a href="<?= base_url('kerja_luar_kantor/edit/' . $detail->id_kerja_luar_kantor) ?>" class="btn btn-info btn-outline btn-block"><i class="ti-pencil"></i> Edit Pengajuan</a>
					<a href="javascript:void(0)" data-toggle="modal" data-target="#modalHapus" class="btn btn-danger btn-outline btn-block"><i class="ti-trash"></i> Hapus Pengajuan</a>
				<?php
				}
				?>
			</div>
		</div>
		<div class="col-md-9">
			<div class="white-box" style="border-top:solid 3px #6003c8;">
				<h4 class="box-title" style="color:#6003c8;margin-bottom:40px">
					Detail Ajuan Surat Kerja Luar Kantor
					<!-- <span class="label label-warning pull-right">Belum Diajukan</span> -->
				</h4>

				<?php
				if (isset($message)) {
					echo '<div class="alert alert-' . $message_type . '">' . $message . '</div>';
				}
				?>

				<div class="form-group">
					<label>Nama Kegiatan</label>
					<p><?= $detail->nama_kegiatan ?></p>
				</div>
				<div class="form-group">
					<label><i class="ti-location-pin"></i> Lokasi Pengerjaan</label>
					<p><?= normal_string($detail->lokasi_pengerjaan) ?></p>
				</div>
				<div class="form-group">
					<label>Tanggal Kegiatan</label>
					<p><?= tanggal($detail->tanggal_awal) ?> <span style="font-weight:bold;color:#6003c8">s.d.</span> <?= tanggal($detail->tanggal_akhir) ?></p>
				</div>
				<div class="form-group">
					<label>Deskripsi Kegiatan</label>
					<p><?= $detail->deskripsi_kegiatan ?></p>
				</div>
				<div class="form-group">
					<label>Target Kegiatan</label>
					<p><?= $detail->target_kegiatan ?></p>
				</div>
				<div class="form-group">
					<label>Verifikator Kegiatan</label>
					<p><?= $detail->nama_pegawai_verifikator ?> - <?= $detail->jabatan_pegawai_verifikator ?></p>
				</div>
			</div>

			<?php
				if ($detail->id_surat_keluar&&$this->surat_keluar_model->get_status_surat($detail->id_surat_keluar)) {
					$id_surat_keluar = $detail->id_surat_keluar;
					$detail_surat = $this->surat_keluar_model->get_detail_by_id($id_surat_keluar);
					if($detail_surat->status_ttd == 'sudah_ditandatangani'){
						?>
			<div class="white-box">
			<h4 class="box-title" style="color:#6003c8;">
					DAFTAR RENCANA PEKERJAAN TERKAIT SURAT IZIN
					<a class="label label-primary pull-right" target="blank" href="<?=base_url('kegiatan_personal')?>">Lihat Detail Semua Rencana</a>
				</h4>
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
									<b> <span><a href="https://e-office.sumedangkab.go.id/kegiatan_personal/detail_kegiatan/<?= $this->session->userdata('id_pegawai') ?>/<?= $keg->id_kegiatan_personal ?>" target="_blank" style="color:#4f5467"><?= $keg->nama_kegiatan; ?></a> </span></b>
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
							<small>Anda belum membuat Rencana Kerja</small> <span class="text-muted"><a href="<?php echo base_url('kegiatan_personal'); ?> ">Lihat Daftar Rencana Kerja</a> </span></li>
					<?php endif; ?>
				</ul>
			</div>
					<?php }
					} ?>
			<div class="row">
				<div class="col-md-12">
					<a href="<?= base_url('kerja_luar_kantor') ?>" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali ke Daftar Pengajuan</a>
				</div>
			</div>
		</div>

	</div>

	<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myLargeModalLabel">Konfirmasi Hapus</h4>
				</div>
				<div class="modal-body">
					Apakah anda yakin akan menghapus pengajuan ini?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Tidak</button>
					<a href="<?= base_url('kerja_luar_kantor/delete/' . $detail->id_kerja_luar_kantor) ?>" class="btn btn-primary waves-effect text-left">Ya</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->