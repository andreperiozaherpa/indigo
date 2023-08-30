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
				<h3 class="box-title">Buat Bantuan Baru</h3>
				<?=form_open_multipart()?>
				<?php
				if(isset($message)){
					?>
					<div class="alert alert-<?=$type?>"><?=$message?></div>
				<?php } ?>
				<div class="form-group">
					<label>Subjek</label>
					<input type="text" name="subjek" value="<?=set_value('subjek')?><?=$detail->subjek?>" class="form-control" placeholder="Masukkan Subjek Bantuan">
				</div>
				<div class="form-group">
					<label>Kategori</label>
					<select name="kategori" id="kategori" onchange="toggleBug()" class="form-control">
						<option value="">Pilih Kategori</option>
						<?php
						$kat = ['koreksi_absen','bug', 'bantuan'];
						foreach($kat as $k){
							if(set_value('kategori')==$k){
								$selected = ' selected';
							}else{
								$selected = '';
							}
							echo '<option value="'.$k.'"'.$selected.'>'.normal_string($k).'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group" id="bug" style="<?=set_value('kategori')=='bug' ? 'display: block' : 'display: none'?>">
					<label>URL Bug</label>
					<input type="text" value="<?=set_value('url_bug')?><?=$detail->url_bug?>" class="form-control" name="url_bug" placeholder="Masukkan URL Bug">
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<textarea rows="10" class="textarea_editor form-control" name="isi" placeholder="Uraikan masalah anda disini"><?=set_value('isi')?><?=$detail->isi?></textarea>
				</div>
				<div class="form-group">
					<label>Lampiran</label><br>
					<p><div class="alert alert-danger"><i class="ti-info"></i>Ekstensi file yang diizinkan jpg, jpeg, png, doc, docx, ppt, pptx, txt, xls, xlsx, pdf <br>Ukuran maksimal 3MB per file</div></p>
					<div class="row" id="row-file">
						<?php foreach ($lampiran as $l): ?>
							<div class="col-md-3" id="file-1">
									<input type="file" class="dropify" name="file[]">
							</div>
						<?php endforeach; ?>
						<div class="col-md-3" id="file-1">
								<input type="file" onchange="addOther(1)" class="dropify" name="file[]">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="pull-right">
						<div class="col-md-12">
							<a href="<?=base_url('helpdesk')?>" class="btn btn-primary btn-outline"><i class="ti-arrow-circle-left"></i> Kembali</a>
							<button type="submit" class="btn btn-primary"><i class="ti-save"></i> Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

</div>

<script type="text/javascript">
	function addOther(){
		file = int + 1;
		$('#file-'+int).append('<a href="javascript:void(0)" onclick="deleteFile('+int+')" style="position: absolute;z-index: 9999;right: 0;top:0;margin-right: 15px;margin-top: 5px" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>');
		$('#row-file').append('<div class="col-md-3" id="file-'+file+'"><input type="file" onchange="addOther('+file+')" class="dropify" name="file[]"></div>');
		$('.dropify').dropify();
	}
	
	function addOther(int){
		file = int + 1;
		$('#file-'+int).append('<a href="javascript:void(0)" onclick="deleteFile('+int+')" style="position: absolute;z-index: 9999;right: 0;top:0;margin-right: 15px;margin-top: 5px" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>');
		$('#row-file').append('<div class="col-md-3" id="file-'+file+'"><input type="file" onchange="addOther('+file+')" class="dropify" name="file[]"></div>');
		$('.dropify').dropify();
	}
	function deleteFile(int){
		$("#file-"+int).remove();
	}
	function toggleBug(){
		var kategori = $('#kategori').val();
		if(kategori=='bug'){
			$('#bug').show();
		}else{
			$('#bug').hide();
		}
	}
</script>
