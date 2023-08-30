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

				<div class="white-box">
					<div class="user-bg" style="height: 180px;"> 
						<img width="100%" height="100%" alt="user" src="https://e-office.sumedangkab.go.id/data/images/header/header2.jpg">
						<div class="overlay-box">
							<div class="col-md-3">
								<div class="user-content">
									<a href="javascript:void(0)">
										<img src="<?=base_url('data/foto/pegawai/'.$detail->foto_pegawai.'')?>" class="thumb-lg img-circle" style=" object-fit: cover;
										width: 55px;
										height: 55px;border-radius: 50%;
										" alt="img">
									</a>
									<h5 class="text-white"><b><?=$detail->nama_lengkap?></b></h5>
									<h6 class="text-white"><?=$detail->nip?></h6>
								</div>
							</div>
							<div class="col-md-3" style="border-right: 1px solid rgba(255,255,255,0.3);border-left: 1px solid rgba(255,255,255,0.3);height: 150px;margin-top: 20px;">
								<div class="user-content">
									<h5 class="text-white"><b>SKPD</b></h5>
									<h6 class="text-white"><?=$detail->nama_skpd?></h6>
								</div>
							</div>
							<div class="col-md-3" style="border-right: 1px solid rgba(255,255,255,0.3);height: 150px;margin-top: 20px;">
								<div class="user-content">
									<h5 class="text-white"><b>Unit Kerja</b></h5>
									<h6 class="text-white"><?=$detail->nama_unit_kerja?></h6>
								</div>
							</div>
							<div class="col-md-3" style="margin-top: 20px;height: 150px">
								<div class="user-content">
									<h5 class="text-white"><b>Jabatan</b></h5>
									<h6 class="text-white"><?=$detail->nama_jabatan?></h6>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="x_panel">
					<form method='post' enctype="multipart/form-data" >
						<div class="x_content">

							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										Input Usulan Pensiun
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Perihal</label>
													<select class="form-control" name="perihal">
														<option value="">Pilih Perihal</option>
														<?php 
														$perihal = array('janda_duda'=>'Janda / Duda','aps'=>'Atas Permintaan Sendiri (APS)','bup'=>'Batas Usia Pensiun (BUP)','uzur'=>'Uzur');
														foreach($perihal as $k => $p){
															echo '<option value="'.$k.'">'.$p.'</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Nomor Urut</label>  
													<input type="text" name="nomor_urut"class="form-control" placeholder="Masukkan Nomor Urut">
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