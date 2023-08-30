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
				<h3 class="box-title">Tambah Inovasi Daerah</h3>
				<?php echo validation_errors(); ?>
				<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<?=$this->session->flashdata('success')?>
					</div>
				<?php } ?>
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
						<label for="">Nama Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="text" class="form-control" name="jumlah_jenis_pelayanan" id="" value="<?=set_value('jumlah_jenis_pelayanan')?>" placeholder="Masukan Jumlah dalam Angka (misal : 3)">
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tahapan Inovasi <sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio1" value="option1" checked>
									<label for="radio1">Inisiatif</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">Uji Coba</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">Penerapan</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Inisiator Inovasi Daerah <sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio1" value="option1" checked>
									<label for="radio1">Kepala Daerah</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">Anggota DPRD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">OPD</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">ASN</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">Masyarakat</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Jenis Inovasi<sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio1" value="option1" checked>
									<label for="radio1">Digital</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">Non Digital</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Bentuk Inovasi<sup class="text-danger" title="wajib diisi">*</sup></label>
						<div class="radio-list">
							<label class="radio-inline p-0">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio1" value="option1" checked>
									<label for="radio1">Non COVID 19</label>
								</div>
							</label>
							<label class="radio-inline">
								<div class="radio radio-info">
									<input type="radio" name="radio" id="radio2" value="option2">
									<label for="radio2">COVID 19</label>
								</div>
							</label>
						</div>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Urusan Inovasi Daerah<sup class="text-danger" title="wajib diisi">*</sup></label>
						<select name="" class="form-control" id="">
							<option value="">-- Pilih</option>
						</select>
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Uji Coba Inovasi Daerah<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" class="form-control">
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Waktu Penerapan<sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="date" class="form-control">
						<small class="text-danger">
							<?php echo form_error('jumlah_jenis_pelayanan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label>Anggaran (Jika Diperlukan) <sup class="text-danger" title="wajib diisi">*</sup></label>
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
					<div class="form-group">
						<label>Profil Bisnis .ppt (Jika Ada) <sup class="text-danger" title="wajib diisi">*</sup></label>
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
					<div class="row">
						<div class="pull-right">
							<div class="col-md-12">
								<a href="<?= base_url('helpdesk') ?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
								<button type="submit" name="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
							</div>
						</div>
					</div>
					</form>
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