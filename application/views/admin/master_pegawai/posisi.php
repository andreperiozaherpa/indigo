<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Posisi Pegawai</h4>
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
			<div class="white-box">
				<div class="row">
					<form method="GET">
						<div class="col-md-9">

							<div class="col-md-6">

								<div class="form-group">
									<label class="control-label">SKPD</label>
									<select name="id_skpd_filter" class="form-control select2">
										<?php
										echo $all_skpd ? '<option value="">Semua SKPD</option>' : null;
										foreach ($skpd as $s) {
											$selected = (!empty($id_skpd) && $id_skpd == $s->id_skpd) ? ' selected' : '';
											echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">

								<div class="form-group">
									<label class="control-label"> Bulan</label>
									<select class="form-control select2" name="bulan" id="bulan">
										<?php
										for ($i = 1; $i <= 12; $i++) {
											$selected = (!empty($bulan) && $bulan == $i) ? "selected" : "";
											echo "<option $selected value='$i' >" . bulan($i) . "</option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">


								<div class="form-group">
									<label class="control-label"> Tahun</label>
									<select class="form-control select2" id="tahun" name="tahun">
										<?php
										for ($i = 2020; $i <= date("Y"); $i++) {
											$selected = (!empty($tahun) && $tahun == $i) ? "selected" : "";

											echo "<option $selected value='$i' >$i</option>";
										}
										?>
									</select>
								</div>
							</div>

						</div>
						<div class="col-md-3">
							<div class="form-group">
								<br>
								<button type="submit" value="1" name="filter" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="white-box">
				<center>
					<span style="display: block;font-weight:500">POSISI PEGAWAI</span>
					<span style="display: block;font-weight:500;font-size:20px"><?= !empty($selected_skpd) ? $selected_skpd->nama_skpd : 'SEMUA SKPD' ?></span>
					<span style="display: block;font-weight:400">Bulan <?= bulan($bulan) ?> Tahun <?= $tahun ?></span>
				</center>
				<div class="table-responsive">
					<table id="tblPegawai" class="table table-striped">
						<thead>
							<tr>
								<th width="7%">No</th>
								<th>NIP</th>
								<th>Nama Lengkap</th>
								<th>SKPD</th>
								<th>Jabatan</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

		</div>

	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalPosisi">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Posisi Pegawai</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Pegawai</label>
					<p id="info_pegawai"></p>
					<input type="hidden" name="id_pegawai">
					<input type="hidden" name="id_pegawai_posisi">
				</div>
				<hr>
				<div class="form-group">
					<label>SKPD</label>
					<select name="id_skpd" onchange="getJabatanBaru()" class="form-control select2">
						<option value="">Pilih SKPD</option>
						<?php
						foreach ($skpd as $s) {
							echo '<option value="' . $s->id_skpd . '">' . $s->nama_skpd . '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Jabatan</label>
					<select name="id_jabatan" onchange="detailJabatan()" class="form-control select2">
						<option value="">Pilih Jabatan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Golongan</label>
					<select name="golongan" class="form-control select2">
						<option value="">Pilih Golongan</option>
						<?php
						$golongan = ['I', 'II', 'III', 'IV'];
						foreach ($golongan as $g) {
							$ruang = ['a', 'b', 'c', 'd'];
							if ($g == 'IV') {
								$ruang[] = 'e';
							}
							foreach ($ruang as $r) {
								echo '<option value="' . $g . '/' . $r . '">' . $g . '/' . $r . '</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Grade TPP</label>
					<input type="text" class="form-control" name="grade" placeholder="Masukkan Grade TPP">
				</div>
				<div class="form-group">
					<label>Nominal TPP</label>
					<input type="number" class="form-control" name="tpp" placeholder="Masukkan Nominal TPP">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="savePosisi()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		$('#tblPegawai').DataTable({
			"pageLength": 10,
			"serverSide": true,
			"processing": true,
			"order": [
				[1, "asc"]
			],
			"ajax": {
				url: base_url + 'master_pegawai/list_pegawai_posisi/<?= $id_skpd . "/" . $bulan . "/" . $tahun ?>',
				type: 'POST'
			},
		}); // End of DataTable

	}); // End of DataTable

	function posisi(id_pegawai_posisi) {
		$('[name="id_pegawai"]').val('');
		$('[name="grade"]').val('');
		$('[name="tpp"]').val('');
		$('[name="id_skpd"]').val('').select2('destroy').select2();
		$('[name="id_unit_kerja"]').html('<option value="">Pilih Unit Kerja</option>').select2('destroy').select2();
		$('[name="id_jabatan"]').html('');
		$('[name="id_jabatan"]').select2('destroy').select2();
		$.getJSON("<?= base_url(); ?>master_pegawai/fetch_pegawai_posisi/" + id_pegawai_posisi, function(data) {
			$('#info_pegawai').html(data.nip + ' - ' + data.nama_lengkap);
			$('[name="id_pegawai"]').val(data.id_pegawai);
			$('[name="id_pegawai_posisi"]').val(data.id_pegawai_posisi);
			$('[name="id_skpd"]').val(data.id_skpd).trigger('change');

			$.getJSON("<?= base_url('master_pegawai/get_jabatan_baru') ?>/" + data.id_skpd + '/0/' + data.id_jabatan, function(data) {
				$('[name="id_jabatan"]').html(data.list);
				$('[name="id_jabatan"]').select2('destroy').select2();
			});
			$('[name="golongan"]').val(data.golongan);
			$('[name="grade"]').val(data.grade);
			$('[name="tpp"]').val(data.tpp);
			$('#modalPosisi').modal('show');
		});
	}

	function getUnitKerja() {
		var id_skpd = $('[name="id_skpd"]').val();
		if (id_skpd != '') {
			$.post("<?= base_url(); ?>master_pegawai/get_unit_kerja_by_skpd/" + id_skpd, {}, function(obj) {
				$('[name="id_unit_kerja"]').html(obj);
				$('[name="id_unit_kerja"]').select2('destroy').select2();
			});
		}
	}

	function getJabatanBaru() {
		var id_skpd = $('[name="id_skpd"]').val();
		$.getJSON("<?= base_url('master_pegawai/get_jabatan_baru') ?>/" + id_skpd, function(data) {
			$('[name="id_jabatan"]').html(data.list);
			$('[name="id_jabatan"]').select2('destroy').select2();
		});
	}


	function detailJabatan() {
		var id_jabatan = $('[name="id_jabatan"]').val();
		$('[name="grade"]').attr('disabled', 'disabled');
		$('[name="tpp"]').attr('disabled', 'disabled');
		$.getJSON("<?= base_url('master_pegawai/get_detail_jabatan') ?>/" + id_jabatan, function(data) {
			// $('[name="id_jabatan"]').html(data.list);
			$('[name="grade"]').val(data.grade);
			$('[name="tpp"]').val(data.tpp);
			$('[name="grade"]').removeAttr('disabled');
			$('[name="tpp"]').removeAttr('disabled');
			// $('[name="id_jabatan"]').select2('destroy').select2();
		});
	}

	function savePosisi() {
		var id_pegawai_posisi = $('[name="id_pegawai_posisi"]').val();
		var id_pegawai = $('[name="id_pegawai"]').val();
		var id_skpd = $('[name="id_skpd"]').val();
		var golongan = $('[name="golongan"]').val();
		var id_jabatan = $('[name="id_jabatan"]').val();
		var grade = $('[name="grade"]').val();
		var tpp = $('[name="tpp"]').val();
		if (id_pegawai_posisi == '' || id_pegawai == '' || id_skpd == '' || golongan == '' || id_jabatan == '' || grade == '' || tpp == '') {
			alert('Data belum lengkap');
		} else {
			$.post("<?= base_url(); ?>master_pegawai/update_posisi/<?= $bulan . "/" . $tahun ?>", {
				id_pegawai_posisi: id_pegawai_posisi,
				id_pegawai: id_pegawai,
				id_skpd: id_skpd,
				golongan: golongan,
				id_jabatan: id_jabatan,
				grade: grade,
				tpp: tpp,
			}, function(obj) {
				var data = JSON.parse(obj);
				if (data.result) {
					$('#tblPegawai').DataTable().ajax.reload();
					swal("Sukses", "Edit Posisi Pegawai berhasil", "success");
				} else {
					swal("Gagal", "Terajadi Kesalahan", "error");

				}
				$('#modalPosisi').modal('hide');
			});
		}
	}
</script>