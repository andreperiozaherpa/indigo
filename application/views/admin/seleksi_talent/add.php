<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Tambah Analisis Kebutuhan</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>ref_satuan">Analisis Kebutuhan</a>
				</li>
				<li class="active">		
					<strong>Tambah</strong>
				</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?=base_url('analisis_kebutuhan')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
			<br><br><br>
			<div class="white-box">

				<div class="row">
					<div class="col-md-12">

						<div class="panel panel-primary" data-collapsed="0">



						</div>
						<div class="panel-body">
							<?php if (!empty($message)) echo "
							<div class='alert alert-$message_type'>$message</div>";?>

							<?php echo form_open_multipart() ?>

							<div class="form-group">
								<label class="control-label"> SKPD</label>
								<select class="form-control">
									<option value="">Pilih SKPD</option>
									<option value="1">Sekretariat Daerah</option>
									<option value="2">Dinas Kesehatan</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label"> Eselon</label>
								<select class="form-control">
									<option value="">Pilih Eselon</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label"> Unit Kerja</label>
								<select class="form-control">
									<option value="">Pilih Unit Kerja</option>
									<option value="1">Bagian Keuangan</option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label"> Jabatan</label>
								<select class="form-control">
									<option value="">Pilih Jabatan</option>
									<option value="1">Kepala Bagian Keuangan</option>
								</select>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Dibuka</label>
										<input type="text" class="form-control" id="datepicker" name="" placeholder="Pilih Tanggal">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Ditutup</label>
										<input type="text" class="form-control" id="datepicker" name="" placeholder="Pilih Tanggal">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label"> Persyaratan</label>

									<?php
									$persyaratan = array('Memiliki pangkat serendah-rendahnya Pembina Tk. I (IV/b)','Jabatan Administrator paling singkat 4 tahun','Jabatan Fungsional jenjang Ahli Madya paling singkat 4 tahun','Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a','Usia paling tinggi 56 tahun pada saat pendaftaran, kecuali bagi pelamar yang sedang menduduki Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a dan Jabatan Fungsional Jenjang Ahli Madya.','Berpendidikan paling rendah sarjana (S1) sesuai bidang yang diminatinya, diutamakan pelamar dengan latar belakang pendidikan magister/pascasarjana (S2).');
									foreach($persyaratan as $p){
									?>
                                        <div class="checkbox checkbox-primary checkbox-circle">
                                            <input id="checkbox-9" type="checkbox">
                                            <label for="checkbox-9"> <?=$p?> </label>
                                        </div>
                                    <?php } ?>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Simpan</button>
							</div>
						</form>


					</div>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
<script type="text/javascript">
	$('#category_name').on('input', function() {
		var permalink;
    // Trim empty space
    permalink = $.trim($(this).val());
    // replace more then 1 space with only one
    permalink = permalink.replace(/\s+/g,' ');
    $('#category_slug').val(permalink.toLowerCase());
    $('#category_slug').val($('#category_slug').val().replace(/\W/g, ' '));
    $('#category_slug').val($.trim($('#category_slug').val()));
    $('#category_slug').val($('#category_slug').val().replace(/\s+/g, '-'));
    var gappermalink = $('#category_slug').val();
    $('#slug').html(gappermalink);
});
</script>
<script type="text/javascript">
	function ganti(){
		var type = $('#type').val();
		if(type=='lembaga'){
			$('#switch').css('display','block');
		}else{

			$('#switch').css('display','none');
		}
	}
</script>