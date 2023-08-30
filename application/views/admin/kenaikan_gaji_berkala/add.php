<div class="container-fluid">
	
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><?php echo title($title) ?></h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php
				$tipe = (empty($error))? "info" : "danger";
				if (!empty($message)){
					?>
					<div class="alert alert-<?= $tipe;?> alert-dismissible fade in" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button>
						<?= $message;?>
					</div>
				<?php }?>
				<div class="x_panel">
					<form method='post' enctype="multipart/form-data" >
						<div class="x_content">
							<div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
								<button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<label id='status'></label>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">File Foto</div>
									<div class="panel-body">
										<div class="row">
											<div class="form-group">
												<label>Upload Foto</label>
												<input type="file" name="foto_pegawai" class="dropify form-control" name="">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="panel panel-default">
									<div class="panel-heading">
										Tambah Pegawai Baru
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Nama Lengkap</label>
													<input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>NIP / NRP</label>  <div class="input-group m-t-10">
														<input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP / NRP"> <span class="input-group-btn">
															<button id="btnSearch" type="button" onclick="searchPegawai()" class="btn waves-effect waves-light btn-info"><i class="ti-search"></i></button>
														</span> </div>
														<small><div id="message"></div></small>

													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label>SKPD</label>
														<select onchange="getUnitKerja()" name="id_skpd" class="form-control" id="id_skpd">
															<option value="">Pilih SKPD</option>
															<?php 
															foreach($skpd as $s){
																echo'<option value="'.$s->id_skpd.'">'.$s->nama_skpd.'</option>';
															}
															?>
														</select>
													</div>
												</div>


												<div class="col-md-12">
													<div class="form-group">
														<label>Kepala SKPD</label>
														<input type="checkbox" id="kepala_skpd" name="kepala_skpd" value="Y" class="js-switch" data-color="#13dafe" onchange="change_kepala();" /> 
													</div>
												</div>



												<div id="hide-unit">
													<div class="col-md-12">
														<div class="form-group">
															<label>Unit Kerja</label>
															<select onchange="getJabatan()" name="id_unit_kerja" class="form-control select2" id="id_unit_kerja" >
																<option value="">Pilih Unit Kerja</option>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Jabatan</label>
															<select name="id_jabatan" class="form-control" id="id_jabatan">
																<option value="">Pilih Jabatan</option>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label>Jenis Pegawai</label>
															<select name="jenis_pegawai" class="form-control" id="jenis_pegawai">
																<option value="">Pilih Jenis Pegawai</option>
																<?php 
																$jenis = array('kepala','staff');
																foreach($jenis as $j){
																	echo'<option value="'.$j.'">'.ucwords($j).'</option>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>  
									<div class="pull-right">
										<a href='<?= base_url();?>master_pegawai' class='btn btn-default'>Back</a>
										<button type='submit' class='btn btn-primary'>Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function change_kepala() {
				if ($('#kepala_skpd').is(':checked') == true){
		      // $('#hide-unit').addClass('hidden');
		      $('#id_unit_kerja').attr('disabled',true);
		      $('#id_jabatan').attr('disabled',true);
		      $('#jenis_pegawai').attr('readonly',true);
		      $('#jenis_pegawai').val("kepala");
		  } else {
		      // $('#hide-unit').removeClass('hidden');
		      $('#id_unit_kerja').attr('disabled',false);
		      $('#id_jabatan').attr('disabled',false);
		      $('#jenis_pegawai').attr('readonly',false);
		  }
		}

	</script>

	<script>


		function getUnitKerja(){
			var id_skpd = $('#id_skpd').val();
			if(id_skpd!=''){
				$.post("<?= base_url();?>master_pegawai/get_unit_kerja_by_skpd/"+id_skpd,{},function(obj){
					$('#id_unit_kerja').html(obj);
				});
			}
		}

		function getJabatan(){
			var id_unit_kerja = $('#id_unit_kerja').val();
			if(id_unit_kerja!=''){
				$.post("<?= base_url();?>master_pegawai/get_jabatan_by_unit_kerja/"+id_unit_kerja,{},function(obj){
					$('#id_jabatan').html(obj);
				});
			}
		}

		function searchPegawai(){
			var nip = $('#nip').val();
			$.ajax({
				url:'<?=base_url('master_pegawai/get_pegawai/')?>/'+nip,
				timeout:false,
				type:'GET',
				dataType:'JSON',
				success:function(hasil){
					$("#nip").removeAttr("disabled","disabled");
					$("#btnSearch").html('<i class="ti-search"></i>');
					if(hasil.result){
						$('[name="nama_lengkap"]').val(hasil.nama_lengkap);
						$("#id_skpd option").filter(function() {
						  return $(this).text() == hasil.unitkerja.toUpperCase();
						}).attr('selected', true);
						$("#nip").attr("readonly","readonly");
						$('[name="nama_lengkap"]').attr("readonly","readonly");
						$("#id_skpd").attr("readonly","readonly");
					}else{
						$('[name="nama_lengkap"]').val('');
						$('#message').html(hasil.message);
					}
					getUnitKerja();
				}
				,error:function(a,b,c)
				{
					$("#nip").removeAttr("disabled","disabled");
					$("#btnSearch").html('<i class="ti-search"></i>');
					$('#message').html(c);
				}
				,beforeSend:function()
				{
					$("#nip").attr("disabled","disabled");
					$("#btnSearch").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
				}
			});
		}

		


	</script>