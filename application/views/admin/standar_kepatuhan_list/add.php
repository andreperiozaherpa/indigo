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
				<h3 class="box-title">Buat Standar Kepatuhan Baru</h3>
				<?= form_open_multipart() ?>
				<?php
				if (isset($message)) {
				?>
					<div class="alert alert-<?= $type ?>"><?= $message ?></div>
				<?php } ?>
				<div class="form-group">
					<label>Judul</label>
					<input type="text" name="judul" value="<?= set_value('judul') ?>" class="form-control" placeholder="Masukkan Judul Standar Kepatuhan">
				</div>

				<div class="form-group">
					<label>Deskripsi</label>
					<textarea rows="10" class="textarea_editor form-control" name="deskripsi" placeholder="Uraikan masalah anda disini"><?= set_value('isi') ?></textarea>
				</div>
				
				<div class="row">
					<div class="pull-right">
						<div class="col-md-12">
							<a href="<?= base_url('helpdesk') ?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
							<button type="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>

</div>