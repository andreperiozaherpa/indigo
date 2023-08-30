<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Eksternal</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Tambah Surat Keluar</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="white-box" style="border-top: solid 3px #6003c8;border-radius: 2px">
		<div class="row">
			<div class="col-md-1 col-sm-1">
				<div class="row">
					<div class="col-md-12">
						<i class="ti-envelope"
							style="position:relative;color:#6003c8;font-size: 30px;background-color:#fff;border:solid 2px #6003c8;padding:14px;border-radius:50%"><i
								style="position: absolute; font-size: 10px" class="ti-plus"></i></i>
					</div>
				</div>
			</div>
			<div class="col-md-11 col-sm-11">
				<div class="row">
					<div class="col-md-12">
						<h4 style="margin: 0px">Tambah Surat Keluar</h4>
						<small><b>
								<?= $detail->nama_surat ?>
							</b></small>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($messages)) {
		?>
		<div class="alert alert-<?= $type ?>"><?= $messages ?></div>
	<?php } elseif (isset($_GET['error'])) {
		?>

		<div class="alert alert-danger">Terjadi kesalahan saat upload file Lampiran</div>
		<?php
	} ?>
	<div class="alert alert-primary">
		<i class="ti-alert" style="color: #fff"></i> Kolom yang bertanda (<span class="text-danger"><b>*</b></span>)
		<b>wajib</b> diisi.
	</div>
	<?= form_open_multipart() ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			Kop Surat
		</div>
		<div class="panel-body">

			<div class="form-group">
				<?php
				$kop_surat = array();
				// print_r($skpd_pegawai);
				// echo $this->session->userdata('id_skpd');
				if ($user_level == 'Dewan') {

					if ($skpd_pegawai) {
						$kop_surat[] = array('label' => $skpd_pegawai->nama_skpd, 'value' => $skpd_pegawai->id_skpd);
					} else {
						$kop_surat[] = array("label" => "Anda tidak memiliki SKPD", "value" => "none");
					}
					$kop_surat[] = array('label' => 'Sekretariat DPRD', 'value' => 3);
				} else {

					if ($skpd_pegawai) {
						$kop_surat[] = array('label' => $skpd_pegawai->nama_skpd, 'value' => $skpd_pegawai->id_skpd);
					} else {
						$kop_surat[] = array("label" => "Anda tidak memiliki SKPD", "value" => "none");
					}
					if ($skpd_pegawai && $skpd_pegawai->nama_skpd !== "SEKRETARIAT DAERAH") {
						$kop_surat[] = array('label' => 'Sekretariat Daerah', "value" => "sekda");
					}
					if (!empty($detail->template_file_bupati)) {
						$kop_surat[] = array('label' => 'Bupati', "value" => "bupati");
					}
					if ($skpd_pegawai && $skpd_pegawai->nama_skpd == "SEKRETARIAT DPRD") {
						$kop_surat[] = array('label' => 'Dewan Perwakilan Rakyat Daerah', "value" => "231");
					}
				}
				foreach ($kop_surat as $k => $s) {
					?>
					<div class="col-md-<?= count($kop_surat) > 3 ? 3 : 4 ?>">
						<div class="radio radio-primary">
							<input name="kop_surat" type="radio" id="radioks<?= $k ?>" value="<?= $s['value'] ?>"
								<?= ($s['value'] == "none") ? ' disabled' : '' ?> 	<?= ($k == 0) ? ' checked' : '' ?>>
							<label for="radioks<?= $k ?>"> <?= $s['label'] ?> </label>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Kepala Surat
		</div>
		<div class="panel-body">
			<div class="col-md-12 ">
				<?php if ($kgb) { ?>
					<input type="hidden" name="id_riwayat_kgb" value="<?= $kgb->id_riwayat_kgb ?>">
				<?php } ?>
				<div class="form-group">
					<label>No. Surat <span class="text-danger">*</span></label>
					<input type="text" name="nomer_surat" class="form-control" placeholder="Masukan No. Surat"
						value="<?= $kgb ? $kgb->nomor_kgb : '' ?>">
				</div>
				<div class="form-group">
					<label>Perihal <span class="text-danger">*</span></label>
					<input type="text" name="perihal" class="form-control" placeholder="Masukan Perihal Surat"
						value="<?= $kgb ? "Kenaikan Gaji Berkala" : '' ?>">
				</div>
				<div class="form-group">
					<label>Lampiran <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="lampiran" placeholder="Masukan Jumlah Lampiran"
						value="<?= $kgb ? "-" : '' ?>">
				</div>
				<div class="form-group">
					<label>Sifat <span class="text-danger">*</span></label><br>
					<?php
					$sifat_surat = array('biasa', 'penting', 'rahasia');
					foreach ($sifat_surat as $n => $s) {
						$checked = $s == "biasa" ? $kgb ? 'checked' : '' : '';
						?>
						<div class="col-lg-4 col-md-2 col-sm-4 col-xs-12">
							<div class="radio radio-primary">
								<input name="sifat_surat" type="radio" id="radio<?= $n ?>" value="<?= $s ?>" <?= $checked ?>>
								<label for="radio<?= $n ?>"> <?= ucfirst($s) ?> </label><span
									class="badge badge-info pull-right" data-toggle="tooltip" data-placement="top"
									title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
							</div>
						</div>
					<?php } ?>
				</div><br><br>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenis Penerima <span class="text-danger">*</span></label>
							<div class="radio radio-primary">
								<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio"
									id="jenis_penerima1" value="skpd" checked>
								<label for="jenis_penerima1"> SKPD </label>
							</div>
							<div class="radio radio-primary">
								<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio"
									id="jenis_penerima3" value="desa">
								<label for="jenis_penerima3"> Desa </label>
							</div>
							<div class="radio radio-primary">
								<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio"
									id="jenis_penerima4" value="jabar">
								<label for="jenis_penerima4"> Ekosistem Jawa Barat </label>
							</div>
							<div class="radio radio-primary">
								<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio"
									id="jenis_penerima2" value="non_skpd">
								<label for="jenis_penerima2"> Non SKPD </label>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div id="jSkpd" style="display: block">
							<div class="form-group">
								<label>Pilih SKPD Penerima <span class="text-danger">*</span></label>
								<br>
								<a href="javascript:void(0)" onclick="selectAll()" class="btn btn-primary btn-xs">Pilih
									Semua SKPD Penerima</a>
								<br><br>
								<select name="id_skpd[]" id="skpdPenerima" class="select2 m-b-10 select2-multiple"
									multiple="multiple" data-placeholder="Pilih SKPD Penerima">
									<?php
									foreach ($skpd as $s) {
										$selected = $s->id_skpd == 25 ? $kgb ? ' selected' : '' : '';
										echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . ucwords(strtolower($s->nama_skpd)) . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div id="jDesa" style="display: none">
							<div class="form-group">
								<label>Pilih Desa Penerima <span class="text-danger">*</span></label>
								<br>
								<a href="javascript:void(0)" onclick="selectAllDesa()"
									class="btn btn-primary btn-xs">Pilih Semua Desa Penerima</a>
								<br><br>
								<select name="id_skpd_desa[]" id="desaPenerima" class="select2 m-b-10 select2-multiple"
									multiple="multiple" data-placeholder="Pilih Desa Penerima">
									<?php
									foreach ($desa as $s) {
										echo '<option value="' . $s->id_skpd . '">' . ucwords(strtolower($s->nama_skpd)) . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div id="jJabar" style="display: none">
							<div class="form-group">
								<label>Pilih Ekosistem <span class="text-danger">*</span></label>
								<select name="kode_wilayah_jabar" id="kodeWilayah" class="form-control select2"
									onchange="initJabar()">
									<option value="">Pilih Ekosistem</option>
									<?php
									foreach ($ekosistem_jabar as $e) {
										echo '<option value="' . $e->kode_wilayah . '">' . ucwords(strtolower($e->nama_instansi)) . '</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Pilih Instansi Penerima <span class="text-danger">*</span></label>
								<select name="jabar_tujuan[]" id="tujuan" class="select2 select2-multiple"
									multiple="multiple" data-placeholder="Pilih Instansi Penerima">
								</select>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label>Klasifikasi <span class="text-danger">*</span></label>
									<select name="jabar_kode_klasifikasi" id="kodeKlasifikasi"
										class="form-control select2">
									</select>
								</div>
								<div class="col-md-3">
									<label>Jenis Surat <span class="text-danger">*</span></label>
									<select name="jabar_jenis_naskah" id="jenisNaskah" class="form-control select2">
									</select>
								</div>
								<div class="col-md-3">
									<label>Sifat Surat <span class="text-danger">*</span></label>
									<select name="jabar_sifat_naskah" id="sifatNaskah" class="form-control select2">
									</select>
								</div>
								<div class="col-md-3">
									<label>Jenis Lampiran <span class="text-danger">*</span></label>
									<select name="jabar_jenis_lampiran" id="jenisLampiran" class="form-control select2">
									</select>
								</div>
							</div>
						</div>
						<div id="jNonSkpd" style="display: none">
							<div class="form-group">
								<label>Nama Penerima <span class="text-danger">*</span></label>
								<input type="text" class="form-control" placeholder="Masukkan Nama Penerima"
									name="nama_penerima">
							</div>
							<div class="form-group">
								<label>Alamat Penerima <span class="text-danger">*</span></label>
								<input type="text" class="form-control" placeholder="Masukkan Alamat Penerima"
									name="alamat_penerima">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ($id_ref_surat !== 'custom') {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				Badan Surat
			</div>
			<div class="panel-body">
				<?php foreach ($field as $f) { ?>
					<div class="form-group">
						<?php if ($f->input_type !== 'header') { ?>
							<label>
								<?= $f->field_label ?> <span class="text-danger">*</span>
							</label>
							<?php if ($f->input_type == 'text' || $f->input_type == 'date' || $f->input_type == 'number' || $f->input_type == 'file') { ?>
								<input type="<?= $f->input_type ?>" class="<?= $f->field_class ?>" name="<?= $f->field_name ?>"
									placeholder="<?= empty($f->field_placeholder) ? 'Masukkan ' . $f->field_label : $f->field_placeholder ?>">
							<?php } elseif ($f->input_type == 'select') {
								?>
								<?php
								if ($f->r_table == '' && $f->r_value == '') {
									?>
									<select class="<?= $f->field_class ?>" name="<?= $f->field_name ?>">
										<option value="">Pilih
											<?= $f->field_label ?>
										</option>
										<?php
										$option = $this->ref_surat_model->get_option($f->id_field);
										foreach ($option as $o) {
											echo '<option value="' . $o->option_value . '">' . $o->option_label . '</option>';
										}
								} elseif ($f->r_table == 'pegawai') {
									?>
										<select class="<?= $f->field_class ?> select2" name="<?= $f->field_name ?>">
											<option value="">Pilih Pegawai</option>
											<?php
											$this->load->model('master_pegawai_model');
											$option = $this->master_pegawai_model->get_by_id_skpd($this->session->userdata('id_skpd'), false, true);
											foreach ($option as $o) {
												echo '<option value="' . $o->id_pegawai . '">' . $o->nama_lengkap . '</option>';
											}
								} elseif ($f->r_table == 'kabupaten') {
									?>
											<select onchange="getKecamatanPemohon<?= $f->id_field ?>()"
												id="<?= $f->r_table ?><?= $f->id_field ?>" class="<?= $f->field_class ?>"
												name="<?= $f->field_name ?>">
												<?php
												echo '<option value="">-- Pilih ' . $f->field_label . ' --</option>';
												$data = $this->ref_wilayah_model->get_kabupaten(null, 32);
												foreach ($data as $row) {
													echo "<option value='" . $row->id_kabupaten . "'>$row->kabupaten</option>";
												}
												?>
												<?php
								} elseif ($f->r_table == 'provinsi') {
									?>
												<select onchange="getKabupatenPemohon<?= $f->id_field ?>()"
													id="<?= $f->r_table ?><?= $f->id_field ?>" class="<?= $f->field_class ?>"
													name="<?= $f->field_name ?>">
													<?php
													echo '<option value="">-- Pilih ' . $f->field_label . ' --</option>';
													$data = $this->ref_wilayah_model->get_provinsi(null, null);
													foreach ($data as $row) {
														echo "<option value='" . $row->id_provinsi . "'>$row->provinsi</option>";
													}
													?>
													<?php

								} elseif ($f->r_table == 'kecamatan' || $f->r_table == 'desa') {
									if ($f->r_table == 'kecamatan') {
										$ajax = 'onchange="getDesaPemohon' . $f->id_field . '()" ';
									} else {
										$ajax = '';
									}
									?>
													<select <?= $ajax ?> id="<?= $f->r_table . $f->id_field ?>"
														class="<?= $f->field_class ?>" name="<?= $f->field_name ?>">
														<option value="">-- Pilih
															<?= $f->field_label ?> --
														</option>
														<?php

								} else {
									?>
														<select class="<?= $f->field_class ?> select2" name="<?= $f->field_name ?>">
															<option value="">Pilih
																<?= $f->field_label ?>
															</option>
															<?php
															$option = $this->ref_surat_model->get_option($f->id_field, $f->r_table);
															foreach ($option as $o) {
																$value = $f->r_value;
																$label = $f->r_label;
																echo '<option value="' . $o->$value . '">' . $o->$label . '</option>';
															}
								}
								?>
													</select>
													<?php
							} elseif ($f->input_type == 'textarea') {
								?>
													<textarea rows="10" placeholder="<?= $f->field_placeholder ?>"
														class="textarea_editor <?= $f->field_class ?>"
														name="<?= $f->field_name ?>"> </textarea>
													<?php
							} elseif ($f->input_type == 'checkbox-group' || $f->input_type == 'radio-group') {
								if ($f->input_type == 'checkbox-group') {
									$type = 'checkbox';
								} else {
									$type = 'radio';
								}
								if ($f->r_table == '' && $f->r_value == '') {
									$option = $this->ref_surat_model->get_option($f->id_field);
									foreach ($option as $o) {
										echo '<br>
															<input type="' . $type . '" value="' . $o->option_value . '" name="' . $f->field_name . '">' . $o->option_label . '
															';
									}
								} else {
									$option = $this->ref_surat_model->get_option($f->id_field, $f->r_table);
									foreach ($option as $o) {
										$value = $f->r_value;
										$label = $f->r_label;
										echo '
															<br>
															<input type="' . $type . '" value="' . $o->$value . '" name="' . $f->field_name . '">' . $o->$label . '
															';
									}
								}
							}
							?>
											<?php } else { ?>
												<label> </label>
												<<?= $f->field_subtype ?> style="font-size:20px">
													<?= $f->field_label ?>
												</<?= $f->field_subtype ?>>
											<?php } ?>
					</div>
				<?php } ?>

			</div>

		</div>
	<?php } ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			Berkas Lampiran
		</div>
		<div class="panel-body">
			Silahkan pilih file lampiran apabila terdapat <b>Lampiran Surat</b> melalui form dibawah ini<br>
			<small><span style="font-weight: bold;color: red;">Catatan</span> : Ekstensi yang diizinkan adalah <b>doc,
					docx, pdf, xls, xlsx, ppt, pptx, txt, zip, rar</b> dengan Maksimal ukuran file
				<b>2MB</b></small><br><br>
			<input type="file" name="file_lampiran" class="dropify">
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Entitas Surat
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-12">Pemeriksa <span class="text-danger">*</span> <small>(Atasan
								Langsung)</small></label>
						<select class="form-control select2" name="id_pegawai_verifikasi">
							<option value="">Pilih Pemeriksa</option>
							<?php
							foreach ($pegawai as $p) {
								echo '<option value=' . $p->id_pegawai . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="col-md-12">Penandatangan <span class="text-danger">*</span></label>
						<select class="form-control select2" name="id_pegawai_ttd">
							<option value="">Pilih Penandatangan</option>
							<?php
							foreach ($pegawai as $p) {
								$certificated = ($p->certificate) ? "" : " (Belum memiliki sertifikat)";
								echo '<option value=' . $p->id_pegawai . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . $certificated . '</option>';
							}

							$certificated = ($pegawai1->certificate) ? "" : " (Belum memiliki sertifikat)";
							echo '<option value=' . $pegawai1->id_pegawai . '>' . $pegawai1->nama_lengkap . ' - ' . $pegawai1->jabatan . $certificated . '</option>';
							?>

						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-12">Tembusan Surat</label>
				<select name="tembusan_surat[]" class="select2 m-b-10 select2-multiple" multiple="multiple"
					data-placeholder="Pilih Penerima Tembusan">
					<?php
					foreach ($list_tembusan as $p) {
						echo '<option value="' . $p->id_pegawai . '"">' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="pull-right">
		<a href="<?php echo base_url('surat_internal/kategori_surat_keluar'); ?>" class="btn btn-default btn-outline"><i
				class="ti-arrow-circle-left"></i> Kembali</a>
		<button type="submit" name="draft" class="btn btn-primary" style="margin-right: 4px"><i class="ti-save"></i>
			Simpan Surat</button>
	</div>
	</form>

	<script type="text/javascript">
		function toggleJenisPenerima() {
			var jenis_penerima = $('input[name="jenis_penerima"]:checked').val();
			if (jenis_penerima == 'skpd') {
				$('#jSkpd').show();
				$('#jNonSkpd').hide();
				$('#jDesa').hide();
				$('#jJabar').hide();
			} else if (jenis_penerima == 'non_skpd') {
				$('#jSkpd').hide();
				$('#jNonSkpd').show();
				$('#jDesa').hide();
				$('#jJabar').hide();
			} else if (jenis_penerima == 'desa') {
				$('#jSkpd').hide();
				$('#jDesa').show();
				$('#jNonSkpd').hide();
				$('#jJabar').hide();
			} else if (jenis_penerima == 'jabar') {
				$('#jSkpd').hide();
				$('#jDesa').hide();
				$('#jNonSkpd').hide();
				$('#jJabar').show();
			}
		}

		function selectAll() {

			$('#skpdPenerima').multiSelect('select_all');
		}

		function selectAllDesa() {

			$('#desaPenerima').multiSelect('select_all');
		}
		// function submitDownload(){
		// 	$("form#formSurat :input").each(function(){
		//  		var input = $(this);
		//  		input.val('');
		// 	});
		// }

		function initJabar() {
			let kode_wilayah = $('#kodeWilayah').val();
			// make ajax request to surat_eksternal/init_jabar with method get json
			$.ajax({
				url: '<?= base_url('surat_eksternal/init_jabar') ?>/' + kode_wilayah,
				type: 'get',
				dataType: 'json',
				success: function (response) {
					if (response.status) {
						let data = response.data;
						let listTujuan = data.tujuan;
						let optionTujuan = '';
						listTujuan.forEach(function (item) {
							optionTujuan += '<option value="' + item.id + '">' + item.name + '</option>';
						});
						$('#tujuan').html(optionTujuan);

						let listKlasifikasi = data.klasifikasi;
						let optionKlasifikasi = '';
						listKlasifikasi.forEach(function (item, index) {
							optionKlasifikasi += '<option value="' + item.id + '">' + item.id + ' - ' + item.name + '</option>';
						});
						$('#kodeKlasifikasi').html(optionKlasifikasi);

						let listJenisNaskah = data.jenis_naskah;
						let optionJenisNaskah = '';
						listJenisNaskah.forEach(function (item) {
							optionJenisNaskah += '<option value="' + item.id + '">' + item.name + '</option>';
						});
						$('#jenisNaskah').html(optionJenisNaskah);

						let listJenisLampiran = data.jenis_lampiran;
						let optionJenisLampiran = '';
						listJenisLampiran.forEach(function (item) {
							optionJenisLampiran += '<option value="' + item.id + '">' + item.name + '</option>';
						});
						$('#jenisLampiran').html(optionJenisLampiran);

						let listSifatNaskah = data.sifat_naskah;
						let optionSifatNaskah = '';
						listSifatNaskah.forEach(function (item) {
							optionSifatNaskah += '<option value="' + item.id + '">' + item.name + '</option>';
						});
						$('#sifatNaskah').html(optionSifatNaskah);


					}
				}
			});
		}
	</script>