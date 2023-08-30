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
		<div class="col-md-12">
			<div class="text-right ">
				<a href="<?=base_url('inovasi_daerah')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
				<br><br>
			</div>
			<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
							<h2><b>Nama Inovasi</b> :  <?=$detail->nama?></h2>
							<h4><b>SKPD</b> : <?=$detail->nama_skpd?></h4>
						<div class="table-responsive">
										<table class="table" >
											<thead>
												<tr>
													<th>No</th>
													<th>Indikator</th>
													<th>Keterangan</th>
													<th>Informasi</th>
													<th>Skor</th>
													<th>Pilih Parameter</th>
													<th>Data Pendukung</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$CI =& get_instance();
												$CI->load->model('parameter_penilaian_indeks_inovasi_model', 'ppiim');
												foreach ($indikator as $key => $v) { 
													$skor = $CI->ppiim->get_skor_parameter_by($detail->id_inovasi_daerah,$v->id);

													$status_parameter = 'Belum Diupload';
													$status_parameter_badge = 'danger';
													$none = 'display:none';
													$parameter = null;
													$download = '#';
													$skorer = 0;
													$downloadFileName = null;
													$icon_file = null;
													if ($skor) {
														$status_parameter = 'Sudah Diupload';
														$status_parameter_badge = 'success';
														$none = null;
														if ($skor[0]->parameter == 1) {
															$skorer = 1;
															$parameter = $v->parameter_pertama;
														}elseif($skor[0]->parameter == 2){
															$skorer = 3;
															$parameter = $v->parameter_kedua;
														}elseif($skor[0]->parameter == 3){
															$skorer = 5;
															$parameter = $v->parameter_ketiga;
														}
														$downloadFileName = $skor[0]->isi;
														if ($v->type_input == 'document') {
															$download = base_url('data/skor_penilaian/'.$skor[0]->isi);
															$icon_file = '<i class="fa fa-download" ></i>';
														}else{
															$download = $skor[0]->isi;
															$icon_file = '<i class="fa fa-link" ></i>';
														}
													}
													if ($v->informasi_inputan) {
														$informasi = $v->informasi_inputan;
													}else{
														$informasi = 'File yang diupload berformat <b>pdf,jpg,png dan doc</b> dengan max size <b>10MB</b>';
													}
												?>
												
													<tr>
														<td><?=$no++?></td>
														<td><?=$v->indikator?></td>
														<td><?=$v->definisi_operasional?></td>
														<td><?=$informasi?></td>
														<td id="skorResult<?=$v->id?>" data-skor="<?=$skorer?>"><?=$skorer?></td>
														<td>
															<?php if ($detail->status_kirim != 'Y') { ?>
																Pilih Parameter <a  data-p1="<?=$v->parameter_pertama?>" data-p2="<?=$v->parameter_kedua?>" data-p3="<?=$v->parameter_ketiga?>" onclick="showParams(this,<?=$v->id?>,'<?=$v->type_input?>')" style="cursor:pointer"><i class="fa fa-pencil"></i> </a>
															<?php } ?>
														</td>
														<td>
															<span id="paramsVal<?=$v->id?>"><?=$parameter?></span>
															<?php if ($detail->status_kirim != 'Y') { ?>
																<form id="tambah" enctype="multipart/form-data">
																	<input type="hidden" name="id_inovasi_daerah" value="<?=$detail->id_inovasi_daerah?>">
																	<input type="hidden" id="id_parameter_penilaian" name="id_parameter_penilaian" value="">
																	<input type="hidden" id="parameter" name="parameter" value="">
																	<label for="upload" id="uploadLabel<?=$v->id?>" style="display:none;cursor:pointer"><i class="fa fa-folder"></i> Upload </label>
																	<div id="inputLabel<?=$v->id?>" style="display:none">
																		<div class="form-group">
																			<input type="text" id="inputText" name="inputText" onkeyup="addDataValue(this.value,<?=$v->id?>)" class="form-control" placeholder="Masukan link video">
																		</div>
																		<a id="statusSubmit<?=$v->id?>" class="btn btn-primary btn-sm" data-value="" onclick="handleForm('<?=$v->type_input?>',this)">Submit</a>
																	</div>
																	<input id="upload" type="file" name="file" onchange="handleForm('<?=$v->type_input?>','')" style="display:none">
																</form>
															<?php } ?>
															<span id="statusUpload<?=$v->id?>"></span>
														</td>
														<td>
															<div class="text-center" >
																<span id="statusParameter<?=$v->id?>" class="badge badge-<?=$status_parameter_badge?>"><?=$status_parameter?></span>
																<div style="margin-top:10px">
																	<a href="<?=$download?>" id="downloadFile<?=$v->id?>" download class="text-dark" style="<?=$none?>" title="<?=$downloadFileName?>"><?=$icon_file?><span id="fileName<?=$v->id?>">&nbsp;<?=$downloadFileName?></span> </a>
																</div>
															</div>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th><h4><b>TOTAL SKOR :</b> </h4> </th>
									<th class="text-right" id="totalSkor"><h4><b><?=$total_skor->total ?? 0?></b> </h4></th>
								</tr>
								<?php if($detail->kematangan > 0) { ?>
									<tr>
										<th><h4><b>SKOR FINAL :</b> </h4> </th>
										<th class="text-right" id="finalSkor"><h4><b><?=$detail->kematangan?></b> </h4></th>
									</tr>
								<?php } ?>
							</table>
						</div>
						
                        </div>
                    </div>
			</div>
		</div>
	</div>
	<!--.row-->
	<?php if (in_array('admin_indeks_inovasi', $user_privileges) || $user_level == 'Administrator'){ ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading"> Verifikasi</div>
				<div class="panel-wrapper collapse in" aria-expanded="true">
					<div class="panel-body">
						<form method="POST" class="form-horizontal">
							<div class="form-body">
								<h3 class="box-title">Verifikasi Penilaian Skor Manual</h3>
								<hr class="m-t-0 m-b-40">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Skor Final</label>
											<div class="col-md-3">
												<input type="text" class="form-control" name="kematangan" value="<?=$detail->kematangan ?? 0?>"> <span class="help-block"> Masukan Skor Final </span> </div>
										</div>
									</div>
									<!--/span-->
								</div>
							</div>
							<div class="form-actions">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn btn-success">Submit</button>
											</div>
										</div>
									</div>
									<div class="col-md-6"> </div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<!--./row-->
	<!-- sample modal content -->
	<div class="modal fade" id="chooseParams" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="mySmallModalLabel">Pilih Parameter</h4> </div>
				<div class="modal-body"> 
					<div class="form-group">
						<label class="control-label">Parameter</label>
						<div class="radio-list">
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="paramsChoose1" data-parameter="" data-tipe="" onclick="showChooseParams(this,1)" value="">
									<label for="paramsChoose1" id="paramsChoose1Label">Option 1</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="paramsChoose2" data-parameter="" data-tipe="" onclick="showChooseParams(this,2)" value="">
									<label for="paramsChoose2" id="paramsChoose2Label">Option 2 </label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="paramsChoose3" data-parameter="" data-tipe="" onclick="showChooseParams(this,3)" value="">
									<label for="paramsChoose3" id="paramsChoose3Label">Option 3 </label>
								</div>
							</label>
						</div>
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->


</div>
<script>
	function confirmDelete() {
		if (confirm("Confirm message")) {
		// do stuff
		} else {
			return false;
		}
	}

	function showParams(document,paramsId,tipe)
	{
		var p1 = document.getAttribute('data-p1');
		var p2 = document.getAttribute('data-p2');
		var p3 = document.getAttribute('data-p3');

		$('#paramsChoose1').val(p1);
		$('#paramsChoose1').attr('data-parameter',paramsId);
		$('#paramsChoose1').attr('data-tipe',tipe);
		$('#paramsChoose1Label').html(p1);
		$('#paramsChoose2').val(p2);
		$('#paramsChoose2').attr('data-parameter',paramsId);
		$('#paramsChoose2').attr('data-tipe',tipe);
		$('#paramsChoose2Label').html(p2);
		$('#paramsChoose3').val(p3);
		$('#paramsChoose3').attr('data-parameter',paramsId);
		$('#paramsChoose3').attr('data-tipe',tipe);
		$('#paramsChoose3Label').html(p3);

		$('#chooseParams').modal('show');

	}

	function showChooseParams(document,id)
	{
		var id_parameter = document.getAttribute('data-parameter');
		var tipe = document.getAttribute('data-tipe');
		var parameter = id;
		var val_parameter = document.value;

		$('#chooseParams').modal('hide');
		$('#id_parameter_penilaian').val(id_parameter);
		$('#parameter').val(parameter);
		if (tipe == 'document') {
			$('#uploadLabel'+id_parameter).show();
		}else if (tipe = 'text'){
			$('#inputLabel'+id_parameter).show();
		}
		$('#paramsVal'+id_parameter).html(val_parameter);
	}

	function addDataValue(val,id)
	{
		$('#statusSubmit'+id).attr('data-value',val);
	}

	//Aksi Tambah

	async function handleForm(tipe,el) {

		const tambah = document.getElementById('tambah');

		const id_inovasi_daerah = tambah.id_inovasi_daerah.value;
		const id_parameter_penilaian = tambah.id_parameter_penilaian.value;
		const parameter = tambah.parameter.value;
		if (tipe == 'document') {
			var file = $('#upload')[0].files[0];
			$('#statusUpload'+id_parameter_penilaian).html('Uploading...');
		}else if (tipe = 'text'){
			var file = el.getAttribute('data-value');
			$('#statusSubmit'+id_parameter_penilaian).html('Submiting...');
		}

		console.log(file);


		var skor = 0;
		if (parameter == 1) {
			skor = 1;
		}else if(parameter == 2){
			skor = 3;
		}else if(parameter == 3){
			skor = 5;
		}

		let formData = new FormData();
		formData.append("id_inovasi_daerah", id_inovasi_daerah);
		formData.append("id_parameter_penilaian", id_parameter_penilaian);
		formData.append("parameter", parameter);
		formData.append("skor", skor);
		formData.append("id_user", <?=$user_id?>);
		formData.append("file", file);
		formData.append("type", tipe);

		try {
			let response = await fetch("<?=base_url('inovasi_daerah/tambah_skor')?>", {
				method: "POST",
				body: formData
			});
			var r = await response.json();

			console.log(r);
			if (r.status == 'berhasil') {
				if (r.tipe == 'document') {
					$('#uploadLabel'+r.data.id_parameter_penilaian).hide();
					$('#statusUpload'+r.data.id_parameter_penilaian).hide();
				}else if(r.tipe == 'text'){
					$('#statusSubmit'+id_parameter_penilaian).html('Submit');
					$('#inputLabel'+r.data.id_parameter_penilaian).hide();
				}
				$('#downloadFile'+r.data.id_parameter_penilaian).show();
				$('#downloadFile'+r.data.id_parameter_penilaian).attr('href',r.data.link);
				$('#statusParameter'+r.data.id_parameter_penilaian).html('Sudah Diupload');
				$('#statusParameter'+r.data.id_parameter_penilaian).addClass('badge-success').removeClass('badge-danger');
				$('#skorResult'+r.data.id_parameter_penilaian).html(r.data.skor);
				$('#skorResult'+r.data.id_parameter_penilaian).attr('data-skor',r.data.skor);
				$('#fileName'+r.data.id_parameter_penilaian).html(' '+r.data.isi)
				$('#totalSkor').html(r.total_skor);
				$('#upload').val('');
			}else{
				$('#statusUpload').html('Maaf, gagal !');
			}

		} catch (err) {
			console.log(err);
		}

		return false;
	};
</script>
