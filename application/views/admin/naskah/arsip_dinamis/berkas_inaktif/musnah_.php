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
		<div class="col-md-12 col-sm-12 col-xs-12">
			<?php
			
			if (!empty($message)) {
			?>

			<?php } ?>
			<div class="x_panel">
				<form method='post' action="<?= base_url('arsip_dinamis/berkas_inaktif/musnah') ?>">
					<div class="x_content">
						<div class="panel panel-primary">
							<div class="panel-heading">Form Usulan Musnah
							</div>

							<!-- begin table -->
							<span class="border border-black">
								<div class="col-md-12">
								<div class="white-box">
									<table class="table" id="berkas_aktif_table">
									<thead>
													<tr>
														<th>#</th>
														<th width="50px">No.</th>
														<th width="100px">
															<center>Kode Klasifikasi</center>
														</th>
														<th>Nama Berkas</th>
														<th>Kurun Waktu</th>
														<th>Jumlah Item</th>
														<th>Akhir Retensi Aktif</th>                            
														<th>Penyusutan Akhir</th>
													</tr>
									</thead>
									<tbody id="row-data">
													<?php if (!empty($files)) {
														$no = 1;
														foreach ($files as $file) { ?>
															<tr>
																<td></td>
																<td><?= $no++; ?></td>
																<td><?= $file->id_surat_klasifikasi->kode_gabungan; ?></td>
																<td><?= $file->nama_berkas; ?></td>
																<td><?= $file->id_surat_klasifikasi->kurun_waktu; ?></td>
																<td>0</td>
																<td><?= $file->id_surat_klasifikasi->akhir_retensi_aktif; ?></td>
																<td><?= $file->id_surat_klasifikasi->penyusutan_akhir; ?></td>
															</tr>
													<?php }
													} ?>
									</tbody>

									</table>
								</div>    
								</div>
							</span>
							<!-- end table -->


						</div>

						<div class="pull-right">
							<a href='<?= base_url("arsip_dinamis/berkas_aktif"); ?>' class='btn btn-default'>Back</a>
							<button type='submit' class='btn btn-primary'>Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	function classificationCode() {
		var code = $("#classification").val();

		$.get("<?= base_url('arsip_dinamis/berkas_aktif/get_retention_by_code') ?>", {
				code: code
			}, function(data, status) {
				var dao = JSON.parse(data);

				$("#retention_active").val(dao.retention.retensi_aktif);
				$("#retention_inactive").val(dao.retention.retensi_inaktif);
				$("#penyusutan_akhir").val(dao.retention.penyusutan_akhir);
				$("#surat_klasifikasi").val(dao.retention.id_surat_klasifikasi);
				$("#number_file").val(dao.number_file.nomor_berkas + 1);
			})
			.done(function() {
				console.log("done executed");
			})
			.fail(function() {
				swal("Kesalahan", "Gagal memuat data...", "error");
			})
	}
</script>
<script type="text/javascript">
	function change_kepala() {
		if ($('#kepala_skpd').is(':checked') == true) {
			// $('#hide-unit').addClass('hidden');
			$('#id_unit_kerja').attr('disabled', true);
			$('#id_jabatan').attr('disabled', true);
			$('#jenis_pegawai').attr('readonly', true);
			$('#jenis_pegawai').val("kepala");
		} else {
			// $('#hide-unit').removeClass('hidden');
			$('#id_unit_kerja').attr('disabled', false);
			$('#id_jabatan').attr('disabled', false);
			$('#jenis_pegawai').attr('readonly', false);
		}
	}
</script>

<script>
	function getUnitKerja(selected = null) {
		var id_skpd = $('#id_skpd').val();
		if (id_skpd != '') {
			$.post("<?= base_url(); ?>master_pegawai/get_unit_kerja_by_skpd/" + id_skpd, {}, function(obj) {
				$('#id_unit_kerja').html(obj);
				if (selected) {
					$("#id_unit_kerja option").filter(function() {
						// console.log(selected);
						return $(this).text() == selected;
					}).attr('selected', true);
				}
				$('#id_unit_kerja').trigger('change');
				getJabatanSKPD(id_skpd);
			});
		}
	}

	function getJabatanSKPD(id_skpd = '', selected = '') {
		// alert('post');
		if (id_skpd != '') {
			$.post("<?= base_url(); ?>master_pegawai/get_jabatan_by_skpd/" + id_skpd, {}, function(obj) {
				$('[name="id_jabatan"]').html(obj);
				if (selected !== '') {
					$('[name="id_jabatan"]').val(selected);
				}
				$('[name="id_jabatan"]').trigger('change');
			});
		}
	}

	function getDetailJabatan() {
		var id_jabatan = $('[name="id_jabatan"]').val();
		$('#divJabatan').hide();
		if (id_jabatan != '') {
			$.getJSON("<?= base_url(); ?>master_pegawai/getDetailJabatan/" + id_jabatan, function(obj) {
				// $('#id_jabatan').html(obj);
				$('#divJabatan').show();
				$('#grade').val(obj.grade);
				$('#tpp').val(obj.tpp);
			});
		}
	}


	function getJabatan() {
		var id_unit_kerja = $('#id_unit_kerja').val();
		if (id_unit_kerja != '') {
			$.post("<?= base_url(); ?>master_pegawai/get_jabatan_by_unit_kerja/" + id_unit_kerja, {}, function(obj) {
				$('#id_jabatan').html(obj);
			});
		}
	}

	function searchPegawai() {
		var nip = $('#nip').val();
		$.ajax({
			url: '<?= base_url('master_pegawai/get_pegawai/') ?>/' + nip,
			timeout: false,
			type: 'GET',
			dataType: 'JSON',
			success: function(hasil) {
				$("#nip").removeAttr("disabled", "disabled");
				$("#btnSearch").html('<i class="ti-search"></i>');
				if (hasil.result) {
					$('[name="nama_lengkap"]').val(hasil.nama_lengkap);
					$('[name="pangkat"]').val(hasil.pangkat);
					$('[name="golongan"]').val(hasil.gol);
					$('[name="jabatan"]').val(hasil.nama_jabatan);
					$("#id_skpd option").filter(function() {
						return $(this).text() == hasil.unitkerja.toUpperCase();
					}).attr('selected', true);
					$("#nip").attr("readonly", "readonly");
					$('[name="nama_lengkap"]').attr("readonly", "readonly");
					$('[name="pangkat"]').attr("readonly", "readonly");
					$('[name="golongan"]').attr("readonly", "readonly");
					$("#id_skpd").attr("readonly", "readonly");
					var pada = hasil.nama_jabatan.split(" pada");
					var unit_kerja = pada[0].split(" " + hasil.unitkerja);
					if (unit_kerja[0].includes("Kepala ")) {
						$('#jenis_pegawai').val("kepala");
						var jenis = unit_kerja[0].split("Kepala ");
						getUnitKerja(jenis[1].trim());
					} else {
						getUnitKerja(unit_kerja[0].trim());
					}
				} else {
					$('[name="nama_lengkap"]').val('');
					$('[name="pangkat"]').val('');
					$('[name="golongan"]').val('');
					$('#message').html(hasil.message);
					getUnitKerja();
				}
			},
			error: function(a, b, c) {
				$("#nip").removeAttr("disabled", "disabled");
				$("#btnSearch").html('<i class="ti-search"></i>');
				$('#message').html(c);
			},
			beforeSend: function() {
				$("#nip").attr("disabled", "disabled");
				$("#btnSearch").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
			}
		});
	}

	function addJabatan() {
		var id_skpd = $('#id_skpd').val();
		if (id_skpd == '') {
			swal('Perhatian', 'Silahkan pilih SKPD terlebih dahulu', 'warning');
		} else {
			$('#formJabatan [name="id_skpd"]').val(id_skpd);
			$.post("<?= base_url(); ?>master_pegawai/get_unit_kerja_by_skpd/" + id_skpd, {}, function(obj) {
				$('#formJabatan [name="id_unit_kerja"]').html(obj);
				$('#formJabatan [name="id_unit_kerja"]').trigger('change');
				$('#modalJabatan').modal('show');
			});
		}
	}

	function simpanJabatan() {
		$.post("<?= base_url(); ?>master_pegawai/simpanJabatan", $('#formJabatan').serialize(), function(res) {
			// alert(obj);
			if (res.status) {
				swal('Berhasil', 'Jabatan Berhasil disimpan', 'success');
				var id_skpd = $('#formJabatan [name="id_skpd"]').val();
				getJabatanSKPD(id_skpd, res.data.id_jabatan);
				$('#modalJabatan').modal('hide');
			} else {
				alert('Terjadi kesalahan');
			}
		}, 'json');
	}
</script>

<div id="modalJabatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Jabatan</h4>
			</div>
			<div class="modal-body">
				<form id="formJabatan">
					<input type="hidden" name="id_skpd">
					<div class="form-group">
						<label>Unit Kerja </label>
						<select name="id_unit_kerja" class="form-control select2">
							<option value="">Pilih Unit Kerja</option>
						</select>
					</div>
					<div class="form-group">
						<label>Nama Jabatan</label>
						<input type="text" class="form-control" placeholder="Masukkan Nama Jabatan" name="nama_jabatan">
					</div>
					<div class="form-group">
						<label>Jenis Jabatan</label>
						<select name="jenis_jabatan" class="form-control select2">
							<option value="">Pilih Jenis Jabatan</option>
							<?php
							$jenis = ['Pelaksana', 'Fungsional', 'Struktural'];
							foreach ($jenis as $j) {
								echo '<option value="' . $j . '">' . $j . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Grade</label>
						<input type="number" class="form-control" placeholder="Masukkan Grade Jabatan" name="grade">
					</div>
					<div class="form-group">
						<label>TPP</label>
						<input type="number" class="form-control" placeholder="Masukkan TPP Jabatan" name="tpp">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="simpanJabatan()" class="btn btn-primary waves-effect">Simpan</button>
				<button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->