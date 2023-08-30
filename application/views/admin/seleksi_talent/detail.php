<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Analisis Kebutuhan</h4>
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
					<strong>Detail</strong>
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
								<p>Sekretariat Daerah</p>
							</div>
							<div class="form-group">
								<label class="control-label"> Eselon</label>
								<p>II</p>
							</div>

							<div class="form-group">
								<label class="control-label"> Unit Kerja</label>
								<p>Bagian Keuangan</p>
							</div>

							<div class="form-group">
								<label class="control-label"> Jabatan</label>
								<p>Kepala Bagian Keuangan</p>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Dibuka</label>
										<p>1 Januari 2020</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Ditutup</label>
										<p>30 Januari 2020</p>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label"> Persyaratan</label>
								<ul>
									<?php
									$persyaratan = array('Memiliki pangkat serendah-rendahnya Pembina Tk. I (IV/b)','Jabatan Administrator paling singkat 4 tahun','Jabatan Fungsional jenjang Ahli Madya paling singkat 4 tahun','Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a','Usia paling tinggi 56 tahun pada saat pendaftaran, kecuali bagi pelamar yang sedang menduduki Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a dan Jabatan Fungsional Jenjang Ahli Madya.','Berpendidikan paling rendah sarjana (S1) sesuai bidang yang diminatinya, diutamakan pelamar dengan latar belakang pendidikan magister/pascasarjana (S2).');
									foreach($persyaratan as $p){
									?>
									<li><?=$p?></li>
                                    <?php } ?>
                                </ul>
							</div>

							<div class="form-group">
								<a href="" class="btn btn-info btn-sm"><i class="ti-pencil"></i> Edit</a>
								<a href="" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Hapus</a>
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