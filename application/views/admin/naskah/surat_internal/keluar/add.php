<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<!--			<h4 class="page-title">Surat Internal</h4>-->
			<h4 class="page-title">Naskah Internal</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<!--				<li class="active">Tambah Surat Keluar</li>-->
				<li class="active">Tambah Naskah Keluar</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="white-box" style="border-top: solid 3px #6003c8;border-radius: 2px">
		<div class="row">
			<div class="col-lg-1 col-md-2 hidden-sm hidden-xs">
				<div class="row">
					<div class="col-md-12">
						<i class="ti-envelope"
							style="position:relative;color:#6003c8;font-size: 30px;background-color:#fff;border:solid 2px #6003c8;padding:14px;border-radius:50%"><i
								style="position: absolute; font-size: 10px" class="ti-plus"></i></i>
					</div>
				</div>
			</div>
			<div class="col-lg-11 col-md-10 col-sm-12">
				<div class="row">
					<div class="col-md-12">
						<!--						<h4 style="margin: 0px">Tambah Surat Keluar</h4>-->
						<h4 style="margin: 0px">Tambah Naskah Keluar</h4>
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
	<?php } ?>
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
				if ($skpd_pegawai) {
					$kop_surat[] = array('label' => $skpd_pegawai->nama_skpd, 'value' => $skpd_pegawai->id_skpd);
				} else {
					$kop_surat[] = array("label" => "Anda tidak memiliki SKPD", "value" => "none");
				}
				// if($skpd_pegawai->nama_skpd!=="SEKRETARIAT DAERAH"){
				// 	$kop_surat[] = array('label' => 'Sekretariat Daerah',"value" => "sekda");
				// }
				if (!empty($detail->template_file_bupati) && $skpd_pegawai->id_skpd == 1) {
					$kop_surat[] = array('label' => 'Bupati', "value" => "bupati");
				}
				foreach ($kop_surat as $k => $s) {
					?>
					<div class="col-md-4">
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
			<?php
			// print_r($detail_cuti);
			?>
			<div class="col-md-12 ">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Kode Klasifikasi <span class="text-danger">*</span></label>
							<input type="text" class="form-control" placeholder="Pilih Klasifikasi Surat"
								name="surat_klasifikasi" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>No. Surat <span class="text-danger">(Pilih Kode Klasifikasi terlebih
									dahulu)*</span></label>
							<input type="text" name="nomer_surat" id="nomer_surat" class="form-control"
								placeholder="Masukan No. Surat" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Perihal <span class="text-danger">*</span></label>
					<input type="text" name="perihal" class="form-control" placeholder="Masukan Perihal Surat" <?= $klk ? 'value="' . $detail->nama_surat . '" readonly' : (($detail_cuti) ? 'value="Surat Izin ' . $detail_cuti->nama_jenis_cuti . '"' : '') ?>>
				</div>
				<div class="form-group">
					<label>Lampiran <span class="text-danger">*</span></label>
					<input type="text" class="form-control" name="lampiran" placeholder="Masukan Daftar Lampiran"
						<?= $klk ? 'value="-"' : (($detail_cuti) ? 'value="-"' : '') ?>>
				</div>

				<!-- <div class="form-group">
						<label>Berkas Lampiran</label>
						<input type="file" name="lampiran_surat" class="form-control">
					</div> -->
				<div class="form-group">
					<!--					<label>Sifat <span class="text-danger">*</span></label><br>-->
					<label>Kecepatan Proses <span class="text-danger">*</span></label><br>
					<?php
					//					$sifat_surat = array('biasa', 'penting', 'rahasia');
					$sifat_surat = array('kilat', 'segera', 'penting', 'biasa');
					foreach ($sifat_surat as $k => $s) {
						$checked = $s == 'biasa' && $klk || $s == 'biasa' && $detail_cuti ? ' checked' : '';
						?>
						<div class="col-lg-3 col-md-2 col-sm-3 col-xs-12">
							<div class="radio radio-primary">
								<input name="sifat_surat" type="radio" id="radioss<?= $k ?>" value="<?= $s ?>" <?= $checked ?>>
								<label for="radioss<?= $k ?>"> <?= ucfirst($s) ?> </label><span
									class="badge badge-info pull-right" data-toggle="tooltip" data-placement="top"
									title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
							</div>
						</div>
					<?php } ?>
				</div>
				<br><br>
				<div class="form-group" <?= $klk || $detail_cuti ? 'style="display:none"' : '' ?>>
					<label>Pilih Penerima <span class="text-danger">*</span></label>
					<br>
					<a href="javascript:void(0)" onclick="selectAll()" class="btn btn-primary btn-xs">Pilih Semua
						Penerima</a>
					<br><br>
					<select multiple id="optgroup" name="id_penerima[]">
						<?php
						foreach ($pegawai as $p) {
							// $staff = ($p->jenis_pegawai=="staff") ? "(Staff) " : "" ;
							echo '<option value=' . $p->id_pegawai . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
						}
						?>
					</select>
					<!-- <a href='#' id='select-all'>select all</a>
						<a href='#' id='deselect-all'>deselect all</a>
					</div>
					<script>
					$('#select-all').click(function() {
						alert('tes');
						$('#optgroup').multiSelect('select_all');
						return false;
					});
					$('#deselect-all').click(function() {
						$('#optgroup').multiSelect('deselect_all');
						return false;
					});
				</script> -->
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
				<?php
				if ($klk) {
					?>
					<input type="hidden" name="id_kerja_luar_kantor" value="<?= $klk->id_kerja_luar_kantor ?>">
					<div class="form-group">
						<label>Nama Kegiatan</label>
						<p>
							<?= $klk->nama_kegiatan ?>
						</p>
					</div>
					<div class="form-group">
						<label><i class="ti-location-pin"></i> Lokasi Pengerjaan</label>
						<p>
							<?= normal_string($klk->lokasi_pengerjaan) ?>
						</p>
					</div>
					<div class="form-group">
						<label>Tanggal Kegiatan</label>
						<p>
							<?= tanggal($klk->tanggal_awal) ?> <span style="font-weight:bold;color:#6003c8">s.d.</span>
							<?= tanggal($klk->tanggal_akhir) ?>
						</p>
					</div>
					<div class="form-group">
						<label>Deskripsi Kegiatan</label>
						<p>
							<?= $klk->deskripsi_kegiatan ?>
						</p>
					</div>
					<div class="form-group">
						<label>Target Kegiatan</label>
						<p>
							<?= $klk->target_kegiatan ?>
						</p>
					</div>
					<?php
				} elseif ($detail_cuti) {
					?>
					<input type="hidden" name="id_permintaan_cuti" value="<?= $detail_cuti->id_permintaan_cuti ?>">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>NIP</label>
								<p>
									<?= $detail_cuti->nip ?>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Pegawai</label>
								<p>
									<?= $detail_cuti->nama_lengkap ?>
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<label>Jenis Cuti</label>
							<p>
								<?= $detail_cuti->nama_jenis_cuti ?>
							</p>
						</div>
						<div class="col-md-6">
							<label>Tanggal Pengajuan</label>
							<p>
								<?= tanggal($detail_cuti->tanggal_pengajuan) ?>
							</p>
						</div>
						<div class="col-md-6">
							<label>Periode Cuti</label>
							<p>
								<?= tanggal($detail_cuti->tanggal_awal) ?>
								<?= !empty($detail_cuti->tanggal_akhir) ? ' s.d. ' . tanggal($detail_cuti->tanggal_akhir) : null ?>
							</p>
						</div>
						<div class="col-md-6">
							<label>Alamat Selama Menjalankan Cuti</label>
							<p>
								<?= $detail_cuti->alamat ?>
							</p>
						</div>
						<div class="col-md-12">
							<label>Keterangan</label>
							<p>
								<?= $detail_cuti->keterangan ?>
							</p>
						</div>
					</div>
					<?php
				} else {
					foreach ($field as $f) { ?>
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
										<select class="<?= $f->field_class ?> select2" name="<?= $f->field_name ?>">
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
													id="<?= $f->r_table ?><?= $f->id_field ?>" class="<?= $f->field_class ?> select2"
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
														id="<?= $f->r_table ?><?= $f->id_field ?>" class="<?= $f->field_class ?> select2"
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
															class="<?= $f->field_class ?> select2" name="<?= $f->field_name ?>">
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

					<!-- <div class="panel panel-default">
										<div class="panel-heading">
											Penutup Surat
										</div>
										<div class="panel-body">
											<div class="form-group">
												<label>Penutup <span class="text-danger">*</span></label>
												<textarea class="textarea_editor form-control" name="penutup" placeholder="Masukkan Penutup"></textarea>
											</div>
										</div>
									</div> -->
					<?php
				}
				?>

			</div>
		</div>
		<?php
	} ?>

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
								$selected = '';
								if ($klk) {
									$selected = $p->id_pegawai == $klk->id_pegawai_verifikator_kegiatan ? ' selected' : '';
								}
								echo '<option value="' . $p->id_pegawai . '"' . $selected . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
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
								$selected = '';
								if ($klk) {
									$selected = $p->kd_skpd == $klk->id_skpd && $p->kepala_skpd == "Y" ? ' selected' : '';
								}
								$certificated = ($p->certificate) ? "" : "(Belum memiliki sertifikat)";
								echo '<option value="' . $p->id_pegawai . '"' . $selected . '>' . $p->nama_lengkap . ' - ' . $p->jabatan . $certificated . '</option>';
							}


							if ($jenis_surat != "internal") {
								$certificated = ($pegawai1->certificate) ? "" : " (Belum memiliki sertifikat)";
								echo '<option value=' . $pegawai1->id_pegawai . '>' . $pegawai1->nama_lengkap . ' - ' . $pegawai1->jabatan . $certificated . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-12">Tembusan Surat</label>
				<select name="tembusan_surat[]" class="m-b-10 select2 select2-multiple" multiple="multiple">
					<?php
					foreach ($pegawai_tembusan as $p) {
						echo '<option value="' . $p->id_pegawai . '"">' . $p->nama_lengkap . ' - ' . $p->jabatan . '</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>

	<!-- <div class="panel panel-default">
								<div class="panel-heading">
									Tautan Surat
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label">Unit Kerja</label>
										<select onchange="getSasaran()" name="id_unit_kerja_tautan" id="id_unit_kerja" class="form-control select2">
											<option value="">Pilih Unit Kerja</option>
											<?php
											foreach ($unit_kerja as $u) {
												$selected = ($u->id_unit_kerja == $this->session->userdata('id_unit_kerja')) ? ' selected' : '';
												echo '<option value="' . $u->id_unit_kerja . '"' . $selected . '>' . $u->nama_unit_kerja . '</option>';
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Berdasarkan IKU</label>
										<input type="checkbox" name="check_tautan" id="tIKU" class="js-switch" data-color="#6003c8" onchange="toggleIKU()" />
									</div>
									<div id="divIKU" style="display: none;background-color: #f1e7fe;padding: 15px 10px;margin-bottom: 10px;">
										<div class="form-group">
											<label class="control-label">Sasaran</label>
											<select onchange="getIKU()" name="id_sasaran_tautan" id="id_sasaran" class="form-control">
												<option value="">Pilih Sasaran</option>
												<?= $sasaran ?>
											</select>
										</div>
										<input type="hidden" id="jenis_sasaran">
										<div class="form-group">
											<label class="control-label">IKU</label>
											<select onchange="getRenaksi()" name="id_iku_tautan" id="id_iku" class="form-control">
												<option value="">Tidak ada IKU</option>
											</select>
										</div>
										<div class="form-group">
											<label class="control-label">Renaksi</label>
											<select name="id_renaksi_tautan" id="id_renaksi" class="form-control">
												<option value="">Tidak ada Renaksi</option>
											</select>
										</div>
									</div>
								</div>
							</div> -->
	<div class="pull-right">
		<a href="<?php echo base_url('naskah/surat_internal/kategori_surat_keluar'); ?>"
			class="btn btn-default btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
		<button type="submit" name="draft" class="btn btn-primary" style="margin-right: 4px"><i class="ti-save"></i>
			Simpan Surat</button>
	</div>
	</form>

	<script type="text/javascript">
		function getUnitkerja() {
			var id_skpd = $('#id_skpd').val();
			$.post('<?= base_url() ?>naskah/surat_internal/get_unit_kerja', {
				id_skpd: id_skpd
			}, function (data) {
				$('#id_unit_kerja').html(data);
				$("#id_unit_kerja").select2("destroy");
				$("#id_unit_kerja").select2();
			});
			//alert(id_skpd)
		}

		function getPegawai() {
			var id_unit_kerja = $('#id_unit_kerja').val();
			$.post('<?= base_url() ?>naskah/surat_internal/get_pegawai', {
				id_unit_kerja: id_unit_kerja
			}, function (data) {
				$('#id_pegawai').html(data);
				$("#id_pegawai").select2("destroy");
				$("#id_pegawai").select2();
			});
		}
	</script>

	<script type="text/javascript">
		function getSasaran() {
			var id = $('#id_unit_kerja').val();
			$.post("<?= base_url('kegiatan/get_sasaran/') ?>/" + id, {}, function (obj) {
				$('#id_sasaran').html(obj);
			});
		}

		function getIKU() {
			var id = $('#id_unit_kerja').val();
			var s = $('#id_sasaran').val();
			var sid = s.split("_");
			var jenis = sid[0];
			var id_s = sid[1];

			$.post("<?= base_url('kegiatan/get_iku/') ?>/" + id_s + "/" + id + "/" + jenis, {}, function (obj) {
				$('#id_iku').html(obj);
			});
		}

		function getRenaksi() {
			var id = $('#id_iku').val();

			var s = $('#id_sasaran').val();
			var sid = s.split("_");
			var jenis = sid[0];

			$.post("<?= base_url('kegiatan/get_renaksi_by_id_iku/') ?>/" + id + "/" + jenis, {}, function (obj) {
				$('#id_renaksi').html(obj);
			});
		}

		function toggleIKU() {
			var tIku = $('#tIKU').prop('checked');
			if (tIku == true) {
				$('#divIKU').show();
			} else {
				$('#divIKU').hide();
			}
		}

		function selectAll() {

			$('#optgroup').multiSelect('select_all');
		}

	</script>

	<!--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
	<script>

		$(document).ready(function () {

			$('[name="surat_klasifikasi"]').select2({
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

			$('[name="surat_klasifikasi"]').on('change', function () {
				var id = $(this).val();
				$.getJSON("<?= base_url('naskah/arsip_dinamis/berkas_aktif/get_classification') ?>?suratKlasifikasi=" + id, function (data) {
					if (data) {
						switch (formatPenomoran) {
							case "arsip_nomor_tahun":
								$("#nomer_surat").val(data.kode_gabungan + "/      /" + year);
								break;
							case "nomor-naskah_arsip_bulan_tahun":
								$("#nomer_surat").val("     /" + data.kode_gabungan + "/      /" + month + "/" + year);
								break;
							case "keamanan_nomor_arsip_bulan_tahun":
								$("#nomer_surat").val((data.hak_akses ? data.hak_akses : "B") + "/    /" + data.kode_gabungan + "/" + month + "/" + year);
								break;
						}

						$("#nomer_surat").prop('disabled', false);
					}
				});
			});

			$(".tembusan_surat").select2({
				width: "100%",
				placeholder: "Pilih Tembusan Surat"
			});

			$(".classification").select2({
				width: "100%",
				ajax: {
					url: "<?= base_url('arsip_dinamis/berkas_aktif/get_classifications') ?>",
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

			$("#nomer_surat").prop('disabled', true);
			let formatPenomoran = "<?= $kategori_surat; ?>";
			const d = new Date();
			let year = d.getFullYear();
			let month = d.getMonth() + 1;

			switch (month) {
				case 1:
					month = "I";
					break;
				case 2:
					month = "II";
					break;
				case 3:
					month = "III";
					break;
				case 4:
					month = "IV";
					break;
				case 5:
					month = "V";
					break;
				case 6:
					month = "VI";
					break;
				case 7:
					month = "VII";
					break;
				case 8:
					month = "VIII";
					break;
				case 9:
					month = "IX";
					break;
				case 10:
					month = "X";
					break;
				case 11:
					month = "XI";
					break;
				case 12:
					month = "XII";
					break;
			}

			$('#classification').on('select2:select', function (e) {
				var data = e.params.data;

				if (data) {
					switch (formatPenomoran) {
						case "arsip_nomor_tahun":
							$("#nomer_surat").val(data.kode_gabungan + "/      /" + year);
							break;
						case "nomor-naskah_arsip_bulan_tahun":
							$("#nomer_surat").val("     /" + data.kode_gabungan + "/      /" + month + "/" + year);
							break;
						case "keamanan_nomor_arsip_bulan_tahun":
							$("#nomer_surat").val((data.hak_akses ? data.hak_akses : "B") + "/    /" + data.kode_gabungan + "/" + month + "/" + year);
							break;
					}

					$("#nomer_surat").prop('disabled', false);
				}
			});
		});


	</script>