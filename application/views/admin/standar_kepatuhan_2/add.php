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
			<div class="white-box">
				<h3 class="box-title">Formulir Penilaian Mandiri Kepatuhan Terhadap Standar Pelayanan Publik</h3>
				<?php echo validation_errors(); ?>
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<?=$this->session->flashdata('success')?>
					</div>
				<?php } ?>
				<?php
				$date = date('Y-m-d');
				if ($this->session->userdata('id_skpd') == 16 || ($date > $status_form->tanggal_mulai && $date < $status_form->tanggal_tutup)) { ?>
					<?= form_open_multipart() ?>
					<?php
					if (isset($message)) {
					?>
						<div class="alert alert-<?= $type ?>"><?= $message ?></div>
					<?php } ?>
					<?php if ($user_level == 'Administrator') { ?>
					<div class="form-group">
						<label>Nama Perangkat Daerah <sup class="text-danger" title="wajib diisi">*</sup> </label>
							<select name="id_skpd" class="form-control select2" id="">
								<?php foreach ($skpd as $key => $value) {
									?>
									<option value="<?=$value->id_skpd?>" <?=($id_skpd == $value->id_skpd) ? 'selected' : null?>><?=$value->nama_skpd?></option>
								<?php } ?>
							</select>
							<small class="text-danger">
								<?php echo form_error('id_skpd'); ?>
							</small>
						</div>
					<?php } ?>
					<div class="form-group">
						<label for="">Jumlah Jenis Pelayanan (berdasarkan SK Standar Pelayanan) <sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="number" class="form-control" name="jumlah_jenis_pelayanan" id="" value="<?=set_value('jumlah_jenis_pelayanan')?>" placeholder="Masukan Jumlah dalam Angka (misal : 3)">
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Ketersediaan Standar Pelayanan <sup class="text-danger" title="wajib diisi">*</sup></label>
						<br>
						<small>Unit penyelenggara pelayanan diminta untuk mengisi dan mengupload data dukungan berupa foto</small>
						<div class="row" id="row-file">
							<div class="col-md-3" id="file-1">
								<input type="file" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="png jpg jpeg pdf" name="jumlah_jenis_pelayanan_file">
							</div>
						</div>
						<small>*Max file size 2MB, tipe file yang diizinkan: png,jpg,jpeg dan pdf .</small>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan_file'); ?>
						</small>
					</div>
					
					<table class="table table-borderless">
						<thead>
							<?php foreach($indikator as $v) { ?>
									<tr>
										<th style="vertical-align: middle;"><?=$v['variabel']?></th>
										<th>
											<?php foreach($v['indikator'] as $value){
												?>
												<div class="form-group">
													<label for="">Apakah tersedia <?=ucwords(str_replace("_"," ", $value['indikator']))?> ? <sup class="text-danger" title="wajib diisi">*</sup></label>
													<div class="radio radio-primary">
														<input type="radio" name="<?=$value['id_standar_kepatuhan_indikator']?>" id="<?=$value['indikator']?>_ya" value="Ya" onclick="check_ketersediaan('<?=$value['id_standar_kepatuhan_indikator']?>')" <?=(set_value($value['indikator']) == 'Ya') ? 'checked' : null?>>
														<label for="<?=$value['indikator']?>_ya"> Ya </label>
													</div>
													<div class="radio radio-primary">
														<input type="radio" name="<?=$value['id_standar_kepatuhan_indikator']?>" id="<?=$value['indikator']?>_tidak" value="Tidak" onclick="check_ketersediaan('<?=$value['id_standar_kepatuhan_indikator']?>')"<?=(set_value($value['indikator']) == 'Tidak') ? 'checked' : null?>>
														<label for="<?=$value['indikator']?>_tidak"> Tidak </label>
													</div>
													<small class="text-danger">
														<?php echo form_error($value['indikator']); ?>
													</small>
												</div>
												<?php 
												$display = 'display:none';
												if (set_value($value['indikator']) == 'Ya') {
													$display = 'display:block';
												} ?>
													<div class="form-group" id="<?=$value['id_standar_kepatuhan_indikator']?>_doc" style="<?=$display?>">
														<div class="row">
															<div class="col-md-12">
																<div class="col-md-6">
																	<label>Data Pendukung <?=ucwords(str_replace("_"," ", $value['indikator']))?></label>
																	<br>
																	<small>Foto persyaratan yang telah dipublikasi diruang pelayanan</small>
																	<div class="row" id="row-file">
																		<div class="col-md-10" id="file-1">
																			<input type="file" class="dropify" data-max-file-size="2M" data-allowed-file-extensions="png jpg jpeg pdf" name="<?=$value['id_standar_kepatuhan_indikator']?>_foto">
																		</div>
																	</div>
																	<small>*Max file size 2MB, tipe file yang diizinkan: png,jpg,jpeg dan pdf .</small>
																</div>
															</div>
														</div>
													</div>
											<?php } ?>
										</th>
									</tr>
							<?php } ?>
						</thead>
					</table>
					<div class="row">
						<div class="pull-right">
							<div class="col-md-12">
								<a href="<?= base_url('helpdesk') ?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
								<button type="submit" name="submit" class="btn btn-primary"><i class="ti-save"></i> Simpan</button>
							</div>
						</div>
					</div>
					</form>
				<?php } else{
					echo 'Form penilaian sedang ditutup.';
				 } ?>
			</div>
		</div>
	</div>

</div>
<script>
	function check_ketersediaan(label){
		var nilai = $("input[name="+label+"]:checked").val();
		if (nilai == 'Ya') {
			$('#'+label+'_doc').show();
		}else{
			$('#'+label+'_doc').hide();
		}
	}
</script>