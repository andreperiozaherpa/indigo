
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Surat Eksternal</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Edit Surat Keluar</li>				</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="white-box" style="border-top: solid 3px #6003c8;border-radius: 2px">
				<div class="row">
					<div class="col-md-1 col-sm-1">
						<div class="row">
							<div class="col-md-12">
								<i class="ti-envelope" style="position:relative;color:#6003c8;font-size: 30px;background-color:#fff;border:solid 2px #6003c8;padding:14px;border-radius:50%"><i style="position: absolute; font-size: 10px" class="ti-plus"></i></i>
							</div>
						</div>
					</div>
					<div class="col-md-11 col-sm-11">
						<div class="row">
							<div class="col-md-12">
								<h4 style="margin: 0px">Edit Surat Keluar</h4>
								<small><b><?=$detail->nama_surat?></b></small>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			if(isset($messages)){
				?>
				<div class="alert alert-<?=$type?>"><?=$messages?></div>
			<?php } ?>
			<div class="alert alert-primary">
				<i class="ti-alert" style="color: #fff"></i> Kolom yang bertanda (<span class="text-danger"><b>*</b></span>) <b>wajib</b> diisi.
			</div>
			<form method="POST" id="formSurat">
				<div class="panel panel-default">
					<div class="panel-heading">
						Kepala Surat
					</div>
					<div class="panel-body">
						<div class="col-md-12 ">
							<div class="form-group">
								<label>No. Surat <span class="text-danger">*</span></label>
								<input type="text" name="nomer_surat" value="<?=$detail->nomer_surat?>" class="form-control" placeholder="Masukan No. Surat">
							</div>
							<div class="form-group">
								<label>Perihal <span class="text-danger">*</span></label>
								<input type="text" name="perihal" value="<?=$detail->perihal?>" class="form-control" placeholder="Masukan Perihal Surat">
							</div>
							<div class="form-group">
								<label>Lampiran <span class="text-danger">*</span></label>
								<input type="text" value="<?=$detail->lampiran?>" class="form-control" name="lampiran" placeholder="Masukan Daftar Lampiran">
							</div>
							<div class="form-group">
								<label>Sifat <span class="text-danger">*</span></label><br>
								<?php 
								$sifat_surat = array('biasa','penting','rahasia');
								foreach($sifat_surat as $s){
									if($s==$detail->sifat_surat){
										$checked = ' checked';
									}else{
										$checked = '';
									}
									?>
									<div class="col-lg-4 col-md-2 col-sm-4 col-xs-12">
										<div class="radio radio-primary">
											<input name="sifat_surat" type="radio" id="radio1" value="<?=$s?>"<?=$checked?>>
											<label for="radio1"> <?=ucfirst($s)?> </label><span class="badge badge-info pull-right"  data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="ti-info" style="font-size:9px"></i></span>
										</div>
									</div>
								<?php } ?>
							</div><br><br>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Jenis Penerima <span class="text-danger">*</span></label>
										<div class="radio radio-primary">
											<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio" id="jenis_penerima" value="skpd" <?=$detail->jenis_penerima=='skpd' ? 'checked' : ''?>>
											<label for="radio1"> SKPD </label>
										</div>
										<div class="radio radio-primary">
											<input name="jenis_penerima" onclick="toggleJenisPenerima()" type="radio" id="jenis_penerima" value="non_skpd">
											<label for="radio1"> Non SKPD <?=$detail->jenis_penerima=='non_skpd' ? 'checked' : ''?></label>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div id="jSkpd" style="display: <?=$detail->jenis_penerima=='skpd' ? 'block' : 'none'?>">
										<div class="form-group">
											<label>Pilih SKPD Penerima <span class="text-danger">*</span></label>
											<select name="id_skpd[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Pilih SKPD Penerima">
												<?php 
													foreach($skpd as $s){
														$selected = '';
														if($detail->jenis_penerima=='skpd'){
															$selected = array();
															foreach($penerima as $p){
																if($p->id_skpd==$s->id_skpd){
																	$selected[] = $s->id_skpd;
																}
															}

															if(in_array($s->id_skpd, $selected)){
																$ss = ' selected';
															}else{
																$ss = '';
															}
														}
														echo'<option value="'.$s->id_skpd.'"'.$ss.'>'.ucwords(strtolower($s->nama_skpd)).'</option>';
													}
												?>
											</select>
										</div>
									</div>
									<div id="jNonSkpd" style="display:  <?=$detail->jenis_penerima=='non_skpd' ? 'block' : 'none'?>">
										<div class="form-group">
											<label>Nama Penerima <span class="text-danger">*</span></label>
											<input type="text" value="<?=$penerima[0]->nama_penerima?>" class="form-control" placeholder="Masukkan Nama Penerima" name="nama_penerima">
										</div>
										<div class="form-group">
											<label>Alamat Penerima <span class="text-danger">*</span></label>
											<input type="text" value="<?=$penerima[0]->alamat_penerima?>" class="form-control" placeholder="Masukkan Alamat Penerima" name="alamat_penerima">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
				if($id_ref_surat!=='custom'){
					?>
					<div class="panel panel-default">
						<div class="panel-heading">
							Badan Surat
						</div>
						<div class="panel-body">
							<?php foreach($field as $f) {
								$name = $f->field_name;
								?>
								<div class="form-group">
									<?php if($f->input_type!=='header') {?>
										<label><?=$f->field_label?> <span class="text-danger">*</span></label>
										<?php if($f->input_type=='text'||$f->input_type=='date'||$f->input_type=='number'||$f->input_type=='file'){ ?>
											<input type="<?=$f->input_type?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>" placeholder="<?=empty($f->field_placeholder) ? 'Masukkan '.$f->field_label : $f->field_placeholder?>" value="<?=$detail->$name?>">
										<?php }elseif($f->input_type=='select'){
											?>
											<?php 
											if($f->r_table==''&&$f->r_value==''){
												?>
												<select class="<?=$f->field_class?>" name="<?=$f->field_name?>">
													<option value="">-- Pilih <?=$f->field_label?> --</option>
													<?php
													$option = $this->ref_surat_model->get_option($f->id_field);
													foreach($option as $o){
														if($o->option_value==$detail->$name){
															$selected = ' selected';
														}else{
															$selected = '';
														}
														echo '<option value="'.$o->option_value.'"'.$selected.'>'.$o->option_label.'</option>';
													}
												}elseif($f->r_table=='kabupaten'){
													?>
													<select  onchange="getKecamatanPemohon<?=$f->id_field?>()" id="<?=$f->r_table?><?=$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
														<?php
														echo '<option value="">-- Pilih '.$f->field_label.' --</option>';
														$data = $this->ref_wilayah_model->get_kabupaten(null,32);
														foreach($data as $row){
															echo "<option value='".$row->id_kabupaten."'>$row->kabupaten</option>";
														}
														?>
														<?php
													}elseif($f->r_table=='provinsi'){                             
														?>
														<select  onchange="getKabupatenPemohon<?=$f->id_field?>()" id="<?=$f->r_table?><?=$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
															<?php
															echo '<option value="">-- Pilih '.$f->field_label.' --</option>';
															$data = $this->ref_wilayah_model->get_provinsi(null,null);
															foreach($data as $row){
																echo "<option value='".$row->id_provinsi."'>$row->provinsi</option>";
															}
															?>
															<?php

														}elseif($f->r_table=='kecamatan'||$f->r_table=='desa'){
															if($f->r_table=='kecamatan'){
																$ajax = 'onchange="getDesaPemohon'.$f->id_field.'()" ';
															}else{
																$ajax = '';
															}
															?>
															<select <?=$ajax?> id="<?=$f->r_table.$f->id_field?>" class="<?=$f->field_class?>" name="<?=$f->field_name?>">
																<option value="">-- Pilih <?=$f->field_label?> --</option>
																<?php

															}else{
																?>
																<select class="<?=$f->field_class?>" name="<?=$f->field_name?>">
																	<option value="">-- Pilih <?=$f->field_label?> --</option>
																	<?php
																	$option = $this->ref_surat_model->get_option($f->id_field,$f->r_table);
																	foreach($option as $o){
																		$value = $f->r_value;
																		$label = $f->r_label;
																		if($o->$value==$detail->$name){
																			$selected = ' selected';
																		}else{
																			$selected = '';
																		}
																		echo '<option value="'.$o->$value.'"'.$selected.'>'.$o->$label.'</option>';
																	}
																}
																?>
															</select>
															<?php
														}elseif($f->input_type=='textarea'){
															?>
															<textarea rows="10" placeholder="<?=$f->field_placeholder?>" class="textarea_editor <?=$f->field_class?>" name="<?=$f->field_name?>"><?=$detail->$name?></textarea>
															<?php
														}elseif($f->input_type=='checkbox-group'||$f->input_type=='radio-group'){
															if($f->input_type=='checkbox-group'){
																$type = 'checkbox';
															}else{
																$type = 'radio';
															}
															if($f->r_table==''&&$f->r_value==''){
																$option = $this->ref_surat_model->get_option($f->id_field);
																foreach($option as $o){
																	if($o->option_value==$detail->$name){
																		$checked = ' checked';
																	}else{
																		$checked = '';
																	}
																	echo '<br>
																	<input type="'.$type.'" value="'.$o->option_value.'" name="'.$f->field_name.'"'.$checked.'>'.$o->option_label.'
																	';
																}
															}else{
																$option = $this->ref_surat_model->get_option($f->id_field,$f->r_table);
																foreach($option as $o){
																	$value = $f->r_value;
																	$label = $f->r_label;
																	if($o->$value==$detail->$name){
																		$checked = ' checked';
																	}else{
																		$checked = '';
																	}
																	echo '
																	<br>
																	<input type="'.$type.'" value="'.$o->$value.'" name="'.$f->field_name.'"'.$checked.'>'.$o->$label.'
																	';
																}
															}

														}
														?>
													<?php }else{ ?>
														<label> </label>
														<<?=$f->field_subtype?> style="font-size:20px"><?=$f->field_label?></<?=$f->field_subtype?>>
													<?php } ?>
												</div>
											<?php } ?>

										</div>

									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											Penutup Surat
										</div>
										<div class="panel-body">
											<div class="form-group">
												<label>Penutup <span class="text-danger">*</span></label>
												<textarea class="textarea_editor form-control" name="penutup" placeholder="Masukkan Penutup"><?=$detail->penutup?></textarea>
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										Entitas Surat
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-12">Pemeriksa <span class="text-danger">*</span></label>
													<select class="form-control select2" name="id_pegawai_verifikasi">
														<option value="">Pilih Pemeriksa</option>
														<?php 
														foreach($pegawai as $p){
															if($p->id_pegawai==$detail->id_pegawai_verifikasi){
																$selected = ' selected';
															}else{
																$selected = '';
															}
															echo '<option value="'.$p->id_pegawai.'"'.$selected.'>'.$p->nama_lengkap.' - '.$p->jabatan.'</option>';
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
														foreach($pegawai as $p){
															if($p->id_pegawai==$detail->id_pegawai_ttd){
																$selected = ' selected';
															}else{
																$selected = '';
															}
															echo '<option value="'.$p->id_pegawai.'"'.$selected.'>'.$p->nama_lengkap.' - '.$p->jabatan.'</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-12" >Tembusan Surat</label>
											<select name="tembusan_surat[]" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Pilih Penerima Tembusan">
												<?php 
												foreach($pegawai_tembusan as $p){
													foreach($tembusan_surat as $t){
														if($t->id_pegawai==$p->id_pegawai){
															$selected = ' selected';
														}else{
															$selected = '';
														}
													}
													echo '<option value="'.$p->id_pegawai.'""'.$selected.'>'.$p->nama_lengkap.' - '.$p->jabatan.'</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="pull-right">
									<a href="<?php echo base_url('surat_eksternal/detail_surat_keluar/'.$detail->id_surat_keluar);?>" class="btn btn-default btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
									<button type="submit" name="draft" class="btn btn-primary btn-outline" style="margin-right: 4px"><i class="ti-save"></i> Simpan</button>
									</form>

									<script type="text/javascript">

function toggleJenisPenerima(){
	var jenis_penerima = $('#jenis_penerima:checked').val();
	if(jenis_penerima=='skpd'){
		$('#jSkpd').show();
		$('#jNonSkpd').hide();
	}else if(jenis_penerima=='non_skpd'){
		$('#jSkpd').hide();
		$('#jNonSkpd').show();
	}
}

function submitDownload(){
	$("form#formSurat :input").each(function(){
 		var input = $(this);
 		input.val('');
	});
}


				</script>
