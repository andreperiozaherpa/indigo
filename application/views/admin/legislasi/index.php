<div class="container-fluid">

	<div class="row bg-title">
		<!-- .page title -->
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Legislasi</h4>
		</div>
		<!-- /.page title -->
		<!-- .breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li><a href="<?= base_url(); ?>/admin">Dashboard</a></li>
				<li class="active">Legislasi</li>
			</ol>
		</div>
		<!-- /.breadcrumb -->
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row">
					<div class="col-md-3">
						<br>
						<a href="<?php echo base_url(); ?>legislasi/add" class="btn btn-block btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Legislasi Baru</a>
					</div>
					<div class="col-md-9 b-l">
						<form method="POST">
							<div class="row">
								<div class="col-md-6">
									<label class="control-label">Judul / Tema</label>
									<input type="text" name="judul" id="firstName" class="form-control" placeholder="Cari Judul / Tema">
								</div>

								<div class="col-md-3">
									<label class="control-label">Status</label>
									<select name="status" class="form-control select2">
										<option value="">Semua</option>
										<option value="publik">Publik</option>
										<option value="rahasia">Rahasia</option>
									</select>
								</div>
								<div class="col-md-3">
									<label class="control-label" style="display:block">&nbsp;</label>
									<a class="btn btn-default" href="<?= base_url($this->uri->segment(1)) ?>"> Reset</a>
									<button class="btn btn-primary" type="submit"> Filter</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="col-sm-12">
			<div class="white-box">
				<h4 class="box-title">DAFTAR LEGISLASI</h4>
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>"; ?>
				<div class="table-responsive">

					<table class="table table-striped datatable" id="data">
						<thead>
							<tr>
								<th>#</th>
								<th>Judul Kegiatan</th>
								<th>Ketua</th>
								<th>Tanggal Rapat </th>
								<th>Status</th>
								<th width=100px>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							if (!empty($query)) {
								// print_r($query);
								foreach ($query as $q) { ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $q->judul ?></td>
										<td><?= $q->nama_lengkap_ketua ?></td>
										<td><?= tanggal($q->tanggal_pelaksanaan) ?></td>
										<td><?= ucwords($q->status) ?></td>
										<td>
											<a href="<?= base_url('legislasi/detail/' . $q->id_legislasi) ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> </a>
											<a href="<?= site_url('legislasi/edit/' . $q->id_legislasi . '') ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
											<a href="<?= base_url('legislasi/delete/' . $q->id_legislasi) ?>" onclick='return confirm("Apakah Anda yakin akan menghapus data ini?")' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
										</td>
									</tr>
								<?php $no++;
								}
							} else {
								?>
								<tr>
									<td colspan="7">
										<center>Belum ada kegiatan</center>
									</td>
								</tr>
							<?php
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</div>
</div>