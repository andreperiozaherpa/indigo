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
					<a href="<?php echo base_url();?>talenta/kebutuhan">Analisis Kebutuhan</a>
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

							<div class="form-group">
								<label class="control-label"> Eselon</label>
								<select class="form-control select2" name="eselon" id="eselon" onchange="get_persyaratan()">
									<option value="">Pilih Eselon</option>
										<?php 
												$eselonArr = array("I","II","III","IV");
												foreach($eselonArr as $key=>$val){
													$selected = (!empty($eselon) && $eselon==$val) ? "selected" : "";
													echo "<option $selected value='".$val."'>".$val."</option>";
												}
										?>
								</select>
								<?= form_error("eselon",'<p class="text-info">','</p>');?>
							</div>
							<div class="form-group">
								<label class="control-label"> SKPD</label>
								<select class="form-control select2" id="id_skpd" name="id_skpd" onchange="get_jabatan()">
									<option value="">Pilih</option>
										<?php 
												
												foreach($dt_skpd as $row){
													$selected = (!empty($id_skpd) && $id_skpd==$row->id_skpd) ? "selected" : "";
													echo "<option $selected value='".$row->id_skpd."'>".$row->nama_skpd."</option>";
												}
										?>
								</select>
								<?= form_error("id_skpd",'<p class="text-info">','</p>');?>
							</div>

							

							<div class="form-group">
								<label class="control-label"> Jabatan</label>
								<select class="form-control select2" name="id_jabatan" id="id_jabatan">
									<option value="">Pilih</option>
									
								</select>
								<?= form_error("id_jabatan",'<p class="text-info">','</p>');?>
							</div>

							<div class="form-group">
								<label class="control-label">Kategori Jabatan</label>
								<select class="form-control select2" id="id_kategori_jabatan" name="id_kategori_jabatan">
									<option value="">Pilih</option>
										<?php 
												
												foreach($dt_kategori_jabatan as $row){
													$selected = (!empty($id_kategori_jabatan) && $id_kategori_jabatan==$row->id_kategori_jabatan) ? "selected" : "";
													echo "<option $selected value='".$row->id_kategori_jabatan."'>".$row->kategori_jabatan."</option>";
												}
										?>
								</select>
								<?= form_error("id_kategori_jabatan",'<p class="text-info">','</p>');?>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Dibuka</label>
										<input type="text" class="form-control" id="datepicker" name="tanggal_buka" placeholder="Pilih Tanggal">
										<?= form_error("tanggal_buka",'<p class="text-info">','</p>');?>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Ditutup</label>
										<input type="text" class="form-control" id="datepicker" name="tanggal_tutup" placeholder="Pilih Tanggal">
										<?= form_error("tanggal_tutup",'<p class="text-info">','</p>');?>
									</div>
									
								</div>
							</div>

							<div class="form-group">
								<label class="control-label"> Persyaratan</label>

								<div id="persyaratan">
								<?php
									$i=1;
									foreach($dt_persyaratan as $row)
									{
										$checked = (!empty($persyaratan) && in_array($row->id_persyaratan,$persyaratan)) ? "checked" : "";
										echo '
										<div class="checkbox checkbox-primary checkbox-circle">
											<input '.$checked.' id="checkbox-'.$i.'" type="checkbox" value="'.$row->id_persyaratan.'" name="persyaratan[]">
											<label for="checkbox-'.$i.'"> '.$row->persyaratan.' </label>
										</div>';
										$i++;
									}
									if(!$dt_persyaratan){
										echo '<p class="text-muted">Tidak ada data</p>';
									}
									?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">Kualifikasi Minimal Pangkat / Gol Ruang</label>
								<select class="form-control select2" id="kualifikasi_golongan" name="kualifikasi_golongan">
									<option value="">Pilih</option>
										<?php 
												
												foreach($dt_golongan as $row){
													$selected = (!empty($kualifikasi_golongan) && $kualifikasi_golongan==$row->id_golongan) ? "selected" : "";
													echo "<option $selected value='".$row->id_golongan."'>".$row->golongan." (".$row->pangkat.") </option>";
												}
										?>
								</select>
								<?= form_error("kualifikasi_golongan",'<p class="text-info">','</p>');?>
							</div>
							
							<div class="form-group">
								<label class="control-label">Kualifikasi Minimal Tingkat Pendidikan</label>
								<select class="form-control select2" id="kualifikasi_pendidikan" name="kualifikasi_pendidikan">
									<option value="">Pilih</option>
										<?php 
												
												foreach($dt_pendidikan as $row){
													$selected = (!empty($kualifikasi_pendidikan) && $kualifikasi_pendidikan==$row->id_jenjangpendidikan) ? "selected" : "";
													echo "<option $selected value='".$row->id_jenjangpendidikan."'>".$row->nama_jenjangpendidikan."</option>";
												}
										?>
								</select>
								<?= form_error("kualifikasi_pendidikan",'<p class="text-info">','</p>');?>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>Simpan</button>
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
	

	function get_jabatan()
	{
		var id_skpd = $("#id_skpd").val();
		$.post('<?=base_url()."talenta/resource/get_jabatan_by_skpd";?>',
			{'id_skpd' : id_skpd},
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