<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Upload berkas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li> 
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>talenta/seleksi">Seleksi</a>
				</li>
				<li class="active">		
					<strong>Upload berkas</strong>
				</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">
			<a href="<?=base_url('talenta/kebutuhan')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
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
							<input type="hidden" name="id_pendaftaran" value="<?=$id_pendaftaran;?>">
							<div class="form-group">
                                <label>Scan Nilai Kompetensi</label>
                                <input type="file" class="dropify" name="file_kompetensi">

                            </div>

							<div class="form-group">
                                <label>Scan Nilai Potensi</label>
                                <input type="file" class="dropify" name="file_potensi">
                            </div>
							
							

							<div class="form-group">
								<button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="icon-cloud-upload"></i></span>Upload</button>
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
	function get_unit()
	{
		var id_skpd = $("#id_skpd").val();
		$.post('<?=base_url()."talenta/resource/get_unit_kerja_by_skpd";?>',
			{'id_skpd' : id_skpd},
			function(opt){
				$("#id_unit_kerja").html(opt);
				$("#id_unit_kerja").trigger('change');
			});
	}

	function get_jabatan()
	{
		var id_unit_kerja = $("#id_unit_kerja").val();
		$.post('<?=base_url()."talenta/resource/get_jabatan_by_unit_kerja";?>',
			{'id_unit_kerja' : id_unit_kerja},
			function(opt){
				$("#id_jabatan").html(opt);
				$("#id_jabatan").trigger('change');
			});
	}

	function get_persyaratan()
	{
		var eselon = $("#eselon").val();
		
		$.post('<?=base_url()."talenta/resource/get_persyaratan_by_eselon";?>',
			{'eselon' : eselon},
			function(opt){
				console.log(opt);
				$("#persyaratan").html(opt);
			});
	}
	
</script>