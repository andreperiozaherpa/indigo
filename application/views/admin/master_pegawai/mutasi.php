<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Mutasi Pegawai</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>



	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="white-box">

				<div class="table-responsive">
					<table id="tblPegawai" class="table table-striped">
						<thead>
							<tr>
								<th width="7%">No</th>
								<th>NIP</th>
								<th>Nama Lengkap</th>
								<th>SKPD</th>
								<th>Unit Kerja</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMutasi">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Mutasi Pegawai</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Pegawai</label>
					<p id="info_pegawai"></p>
					<input type="hidden" name="id_pegawai">
				</div>
				<hr>
				<div class="form-group">
					<label>SKPD Baru</label>
					<select name="id_skpd" onchange="getUnitKerja()" class="form-control select2">
						<option value="">Pilih SKPD</option>
						<?php
						foreach ($skpd as $s) {
							echo '<option value="' . $s->id_skpd . '">' . $s->nama_skpd . '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Unit Kerja Baru</label>
					<select onchange="getJabatanBaru()" name="id_unit_kerja" class="form-control select2">
						<option value="">Pilih Unit Kerja</option>
					</select>
				</div>
				<div class="well">
					<div class="form-group">
						<label>Jabatan Baru</label>
						<select name="id_jabatan" onchange="detailJabatan()" class="form-control select2">
							<option value="">Pilih Jabatan</option>
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
			</div>
			<div class="modal-footer">
				<button type="button" onclick="saveMutasi()" class="btn btn-primary">Simpan</button>
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
			"order": [
				[1, "asc"]
			],
			"ajax": {
				url: base_url + 'master_pegawai/list_pegawai',
				type: 'POST'
			},
		}); // End of DataTable

	}); // End of DataTable

	function mutasi(id_pegawai) {
		$('[name="id_pegawai"]').val('');
		$('[name="grade"]').val('');
		$('[name="tpp"]').val('');
		$('[name="id_skpd"]').val('').select2('destroy').select2();
		$('[name="id_unit_kerja"]').html('<option value="">Pilih Unit Kerja</option>').select2('destroy').select2();
		$('[name="id_jabatan"]').html('');
		$('[name="id_jabatan"]').select2('destroy').select2();
		$.getJSON("<?= base_url(); ?>master_pegawai/fetch_pegawai/" + id_pegawai, function(data) {
			$('#info_pegawai').html(data.nip + ' - ' + data.nama_lengkap);
			$('[name="id_pegawai"]').val(data.id_pegawai);
			$('#modalMutasi').modal('show');
		});
	}

	function getUnitKerja() {
		var id_skpd = $('[name="id_skpd"]').val();
		if (id_skpd != '') {
			$.post("<?= base_url(); ?>master_pegawai/get_unit_kerja_by_skpd/" + id_skpd, {}, function(obj) {
				$('[name="id_unit_kerja"]').html(obj);
				$('[name="id_unit_kerja"]').select2('destroy').select2();
				getJabatanBaru(false);
			});
		}
	}

	function getJabatanBaru(unit_kerja = true) {
		var id_skpd = $('[name="id_skpd"]').val();
		var id_unit_kerja = '';
		if(unit_kerja){
			id_unit_kerja = $('[name="id_unit_kerja"]').val();
		}
		$.getJSON("<?= base_url('master_pegawai/get_jabatan_baru') ?>/" + id_skpd + "/" + id_unit_kerja, function(data) {
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

	function saveMutasi() {
		var id_pegawai = $('[name="id_pegawai"]').val();
		var id_skpd = $('[name="id_skpd"]').val();
		var id_unit_kerja = $('[name="id_unit_kerja"]').val();
		var id_jabatan = $('[name="id_jabatan"]').val();
		var grade = $('[name="grade"]').val();
		var tpp = $('[name="tpp"]').val();
		if (id_pegawai == '' || id_skpd == '' || id_unit_kerja == '' || id_jabatan == '' || grade == '' || tpp == '') {
			alert('Data belum lengkap');
		} else {
			$.post("<?= base_url(); ?>master_pegawai/insert_mutasi/", {
				id_pegawai: id_pegawai,
				id_skpd: id_skpd,
				id_unit_kerja: id_unit_kerja,
				id_jabatan: id_jabatan,
				grade: grade,
				tpp: tpp,
			}, function(obj) {
				var data = JSON.parse(obj);
				if (data.result) {
					$('#tblPegawai').DataTable().ajax.reload();
					swal("Sukses", "Mutasi Pegawai Berhasil", "success");
				} else {
					swal("Gagal", "Terajadi Kesalahan", "error");

				}
				$('#modalMutasi').modal('hide');
			});
		}
	}
</script>