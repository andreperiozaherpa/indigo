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
				<h3 class="box-title">Ubah Parameter Penilaian</h3>
				<h3><small>Label bertanda (<sup class="text-danger" title="wajib diisi">*</sup>) Wajib diisi</small></h3>
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
					<div class="form-group">
						<label for="">Indikator <sup class="text-danger" title="wajib diisi">*</sup></label>
						<input type="text" class="form-control" name="indikator" id="" value="<?=$detail->indikator ?? set_value('indikator') ?>" placeholder="Masukan indikator penilaian">
						<small class="text-danger">
							<?php echo form_error('indikator'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Definisi Operasional <sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="definisi_operasional" class="form-control" id="" cols="30" rows="3">
							<?=$detail->definisi_operasional ?? set_value('definisi_operasional')?>
						</textarea>
						<small class="text-danger">
							<?php echo form_error('definisi_operasional'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Bobot</label>
						<input type="number" class="form-control" name="bobot" id="" value="<?=$detail->bobot ?? set_value('bobot')?>" placeholder="Masukan bobot penilaian">
						<small class="text-danger">
							<?php echo form_error('bobot'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Parameter Pertama <sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="parameter_pertama" class="form-control" id="" cols="30" rows="3">
							<?=$detail->parameter_pertama ?? set_value('parameter_pertama')?>
						</textarea>
						<small class="text-danger">
							<?php echo form_error('parameter_pertama'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Parameter Kedua <sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="parameter_kedua" class="form-control" id="" cols="30" rows="3">
							<?=$detail->parameter_kedua ?? set_value('parameter_kedua')?>
						</textarea>
						<small class="text-danger">
							<?php echo form_error('parameter_kedua'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Parameter Ketiga <sup class="text-danger" title="wajib diisi">*</sup></label>
						<textarea name="parameter_ketiga" class="form-control" id="" cols="30" rows="3">
							<?=$detail->parameter_ketiga ?? set_value('parameter_ketiga')?>
						</textarea>
						<small class="text-danger">
							<?php echo form_error('parameter_ketiga'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Informasi Penginputan </label>
						<input type="text" class="form-control" name="informasi_inputan" id="" value="<?=$detail->informasi_inputan ?? set_value('informasi_inputan')?>" placeholder="Masukan informasi penginputan">
						<small class="text-danger">
							<?php echo form_error('informasi_inputan'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Tipe Input </label>
						<select name="type_input" id="" class="form-control">
							<option value="document"<?=($detail->type_input == 'document') ? 'selected' : null; ?>>Document</option>
							<option value="text"<?=($detail->type_input == 'text') ? 'selected' : null; ?>>Text</option>
						</select>
						<small class="text-danger">
							<?php echo form_error('type_input'); ?>
						</small>
					</div>
					<div class="form-group">
						<label for="">Urutan</label>
						<input type="number" class="form-control" name="urutan" id="" value="<?=$detail->urutan ?? set_value('urutan')?>" placeholder="Masukan urutan">
						<small class="text-danger">
							<?php echo form_error('urutan'); ?>
						</small>
					</div>
					<div class="row">
						<div class="pull-right">
							<div class="col-md-12">
								<a href="<?= base_url('parameter_penilaian_indeks_inovasi') ?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
								<button type="submit" name="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
							</div>
						</div>
					</div>
					</form>
			</div>
		</div>
	</div>

</div>