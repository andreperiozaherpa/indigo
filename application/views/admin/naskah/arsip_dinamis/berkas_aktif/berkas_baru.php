<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">
				<?php echo title($title) ?>
			</h4>
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
				<form method='post' action="<?= base_url('naskah/arsip_dinamis/berkas_aktif/save') ?>">
					<div class="x_content">
						<div class="panel panel-primary">
							<div class="panel-heading">Form Berkas Baru
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<!-- <input type="number" name="surat_klasifikasi" id="surat_klasifikasi" required hidden> -->
										<div class="form-group">
											<label>Nama Berkas</label>
											<input type="text" class="form-control" name="name_file" required
												placeholder="Masukan Nama Berkas">
										</div>

										<div class="form-group">
											<label>Klasifikasi</label>
											<input type="text" class="form-control"
												placeholder="Pilih Klasifikasi Surat" name="classification" required>
										</div>

										<div class="row m-b-20">
											<div class="col-md-6">
												<label>Retensi Aktif</label>
												<input type="number" class="form-control" name="retention_active"
													id="retention_active" readonly required
													placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
											</div>
											<div class="col-md-6">
												<label>Retensi Inaktif</label>
												<input type="number" class="form-control" name="retention_inactive"
													id="retention_inactive" readonly required
													placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
											</div>
										</div>
										<div class="form-group">
											<label>Nomor Berkas</label>
											<input type="number" class="form-control" name="number_file"
												id="number_file" required readonly
												placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
										</div>

										<div class="form-group">
											<label>Penyusutan Akhir</label>
											<input type="text" class="form-control" name="penyusutan_akhir"
												id="penyusutan_akhir" required readonly
												placeholder="Diisi berdasarkan Kode Klasifikasi Berkas">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Lokasi Fisik</label>
											<textarea rows="5" class="form-control" name="location_file"
												placeholder="Masukan Lokasi Fisik Berkas"></textarea>
										</div>

										<div class="form-group">
											<label>Uraian</label>
											<textarea rows="5" class="form-control" name="description" required
												placeholder="Masukan uraian/deskripsi berkas"></textarea>
										</div>

										<div class="form-group">
											<label>Kategori Berkas</label>
											<input type="text" class="form-control" name="category"
												placeholder="Masukan kategori berkas">
										</div>

										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="arsip_vital" value="1"
												id="arsip_vital">
											<label class="form-check-label" for="arsip_vital">
												Berkas Kategori Arsip Vital
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="arsip_terjaga"
												value="1" id="arsip_terjaga">
											<label class="form-check-label" for="arsip_terjaga">
												Berkas Kategori Arsip Terjaga
											</label>
										</div>

										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="mkb" value="1"
												id="mkb">
											<label class="form-check-label" for="mkb">
												Berkas Kategori MKB (Memori Kolektif Bangsa)
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="pull-right">
							<a href='<?= base_url("naskah/arsip_dinamis/berkas_aktif"); ?>'
								class='btn btn-default'>Kembali</a>
							<button type='submit' class='btn btn-primary'>Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->

<script>

	$(document).ready(function () {


		$('[name="classification"]').select2({
			minimumInputLength: 2,
			allowClear: true,
			placeholder: 'Pilih Klasifikasi Surat',
			ajax: {
				dataType: 'json',
				url: "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classifications') ?>",
				data: function (term, page) {
					return {
						search: term, //search term
					};
				},
				results: function (data, page) {
					return {
						results: data
					};
				},
			}
		});

		$('[name="classification"]').on('change', function () {
			var id = $(this).val();
			$.getJSON("<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classification') ?>?suratKlasifikasi=" + id, function (data) {
				if (data) {

					$("#retention_active").val(data.retensi_aktif);
					$("#retention_inactive").val(data.retensi_inaktif);
					$("#penyusutan_akhir").val(data.penyusutan_akhir);
				}
			});
		});

		$("#classification").select2({
			width: "100%",
			placeholder: "Pilih Kode Klasifikasi",
			ajax: {
				url: "<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classifications') ?>",
				dataType: "json",
				type: "get",
				delay: 250,
				data: function (params) {
					return {
						search: params.term,
						page: params.page || 1
					}
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results: data.results,
						pagination: {
							more: (params.page * 20) < data.totalRows
						}
					};
				},
				cache: true
			},
			placeholder: 'Masukan nama klasifikasi',
			// minimumInputLength: 0,
			templateResult: formatRepo,
			templateSelection: formatRepoSelection
		});

		function formatRepo(repo) {
			if (repo.loading) {
				return repo.text;
			}

			var $container = $(
				"<div class='select2-result-repository clearfix'>" +
				"<div class='select2-result-repository__meta'>" +
				"<div class='select2-result-repository__title'></div>" +
				"<div class='select2-result-repository__description'></div>" +
				"<div class='select2-result-repository__statistics'>" +
				"</div>" +
				"</div>" +
				"</div>"
			);

			$container.find(".select2-result-repository__title").text(repo.kode_gabungan);
			$container.find(".select2-result-repository__description").text(repo.nama_klasifikasi);

			return $container;
		}

		function formatRepoSelection(repo) {
			return repo.nama_klasifikasi || repo.text;
		}

		$('#classification').on('select2:select', function (e) {
			var data = e.params.data;

			$("#retention_active").val(data.retensi_aktif);
			$("#retention_inactive").val(data.retensi_inaktif);
			$("#penyusutan_akhir").val(data.penyusutan_akhir);
		});
	});
</script>