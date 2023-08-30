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
			$tipe = (empty($error)) ? "info" : "danger";
			if (!empty($message)) {
			?>
				<div class="alert alert-<?= $tipe; ?> alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<?= $message; ?>
				</div>
			<?php } ?>
			<div class="x_panel">
				<form method='post' enctype="multipart/form-data">
					<div class="x_content">
						<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
							<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
							</button>
							<label id='status'></label>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
								<div class="panel-heading">File Foto</div>
								<div class="panel-body">
									<div class="row">
										<div class="form-group">
											<label>Upload Foto</label>
											<input type="file" name="foto_pegawai" data-default-file="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai . '') ?>" class="dropify form-control" name="">
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">Scan KTP</div>
								<div class="panel-body">
									<div class="row">
										<div class="form-group">
											<label>Upload Scan / Foto KTP</label>
											<input type="file" name="file_ktp" data-default-file="<?= base_url('data/ktp/' . $detail->file_ktp . '') ?>" class="dropify form-control" name="">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="panel panel-default">
								<div class="panel-heading">
									Edit Pegawai
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Nama Lengkap</label>
												<input type="text" name="nama_lengkap" value="<?= $detail->nama_lengkap ?>" class="form-control" placeholder="Masukkan Nama Lengkap">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>NIP / NRP</label>
												<div class="input-group m-t-10">
													<input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP / NRP" value="<?= $detail->nip ?>"> <span class="input-group-btn">
														<button id="btnSearch" type="button" onclick="searchPegawai()" class="btn waves-effect waves-light btn-info"><i class="ti-search"></i></button>
													</span> </div>
												<small>
													<div id="message"></div>
												</small>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>NIK</label>
												<input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" value="<?= $detail->nik ?>">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Pangkat / Golongan</label>
												<select name="golongan" class="form-control select2">
													<option value="">Pilih Pangkat & Golongan</option>
													<?php 
														foreach($golongan_list as $p){
															if($p->pangkat == $detail->golongan){
																echo '<option value="'.$p->pangkat.'" selected>'.$p->golongan.' - '.$p->pangkat.' </option>';
															}else{
																echo '<option value="'.$p->pangkat.'">'.$p->golongan.' - '.$p->pangkat.' </option>';
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Eselon</label>
												<select name="eselon" class="form-control select2">
													<option value="">Pilih Eselon</option>
													<?php 
														foreach($eselon_list as $e){
															if($e->nama_eselon == $detail->eselon){
																echo '<option value="'.$e->nama_eselon.'" selected>'.$e->nama_eselon.' </option>';
															}else{
																echo '<option value="'.$e->nama_eselon.'">'.$e->nama_eselon.' </option>';
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>SKPD</label>
												<select onchange="getUnitKerja()" name="id_skpd" class="form-control select2" id="id_skpd">
													<option value="">Pilih SKPD</option>
													<?php
													foreach ($skpd as $s) {
														if ($s->id_skpd == $detail->id_skpd) {
															$selected = ' selected';
														} else {
															$selected = '';
														}
														echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label><i class="ti-location-pin"></i> Lokasi Kantor</label>
												<select  name="id_ref_skpd_sub" class="form-control select2" id="id_ref_skpd_sub">
													<option value="">Kantor Utama <?=$detail->nama_skpd?></option>
													<?php
													foreach ($sub_office as $s) {
														if ($s->id_ref_skpd_sub == $detail->id_ref_skpd_sub) {
															$selected = ' selected';
														} else {
															$selected = '';
														}
														echo '<option value="' . $s->id_ref_skpd_sub . '"' . $selected . '>' . $s->nama_sub . '</option>';
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Kepala SKPD</label>
												<input type="checkbox" id="kepala_skpd" name="kepala_skpd" value="Y" class="js-switch" data-color="#13dafe" onchange="change_kepala();" <?= ($detail->kepala_skpd == "Y") ? "checked" : "" ?> />
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Unit Kerja </label>
												<select name="id_unit_kerja" class="form-control select2" id="id_unit_kerja">
													<option value="">Pilih Unit Kerja</option>
													<?php
													foreach ($unit_kerja as $u) {
														if ($u->id_unit_kerja == $detail->id_unit_kerja) {
															$selected = ' selected';
														} else {
															$selected = '';
														}
														echo '<option value="' . $u->id_unit_kerja . '"' . $selected . '>' . $u->nama_unit_kerja . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jabatan

													<a href="javascript:void(0)" onclick="addJabatan()" class="btn btn-primary btn-xs"><i class="ti-plus"></i> Tambah Jabatan</a>
												</label>
												<!-- <input type="text" class="form-control" name="jabatan" value="<?= $detail->jabatan ?>"> -->
												<select name="id_jabatan" onchange="getDetailJabatan()" class="form-control select2">
													<option value="">Pilih Jabatan</option>
													<?php
													foreach ($jabatan_list as $j) {
														$selected = $j->id_jabatan == $detail->id_jabatan ? ' selected' : '';
														echo '<option value="' . $j->id_jabatan . '"' . $selected . '>' . $j->nama_jabatan . '</option>';
													}
													?>
												</select>
											</div>
										</div>
										<div id="divJabatan" style="display: none;">
											<div class="col-md-12">
												<div class="form-group">
													<label>Grade</label>
													<input type="text" class="form-control" name="grade" id="grade">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>TPP</label>
													<input type="text" class="form-control" name="tpp" id="tpp">
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Jenis Pegawai</label>
												<select name="jenis_pegawai" class="form-control" id="jenis_pegawai">
													<option value="">Pilih Jenis Pegawai</option>
													<?php
													$jenis = array('kepala', 'staff');
													foreach ($jenis as $j) {
														if ($j == $detail->jenis_pegawai) {
															$selected = ' selected';
														} else {
															$selected = '';
														}
														echo '<option value="' . $j . '"' . $selected . '>' . ucwords($j) . '</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="pull-right">
								<a href='<?= base_url(); ?>master_pegawai' class='btn btn-default'>Back</a>
								<button type='submit' class='btn btn-primary'>Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		getDetailJabatan();
	});

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

	function getJabatanSKPD(id_skpd='', selected = '') {
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
					$(".select2").select2("destroy").select2();
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