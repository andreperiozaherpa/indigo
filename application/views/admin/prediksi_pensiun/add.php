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
					<div style="margin-top: 24px;" class="panel panel-default">
						<div class="panel-heading">
							<span class="text-primary">Input</span> Usulan Pensiun
						</div>
						<div class="panel-body">
							<div class="row">
								<form method='post' enctype="multipart/form-data" >
									<div class="col-md-12">
										<div class="form-group">
											<label>Perihal</label>
											<select onchange="togglePerihal()" class="form-control" id="fPerihal" name="id_alasan_pensiun">
												<option value="">Pilih Perihal</option>
												<?php 
												foreach($perihal as $p){
													echo '<option value="'.$p->id_alasan_pensiun.'">'.$p->perihal.'</option>';
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Nomor Usul</label>  
											<input type="text" name="nomor_urut"class="form-control" placeholder="Masukkan Nomor Usul">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Tanggal Pensiun</label>  
											<input value="<?=$detail->prediksi_pensiun?>" type="text" name="tgl_pensiun" id="datepicker" class="form-control" placeholder="Pilih Tanggal Pensiun">
										</div>
									</div>
									<div class="col-md-12" id="divJanda" style="display: none">
										<div class="form-group">
											<label>Tanggal Meninggal Dunia</label>  
											<input type="text" name="tgl_meninggal" id="datepicker" class="form-control fJanda" placeholder="Pilih Tanggal Meninggal Dunia">
										</div>
									</div>  
									<div class="col-md-12">
									<div class="pull-right">
										<a href='<?= base_url();?>master_pegawai' class='btn btn-default'><i class="ti-arrow-circle-left"></i> Back</a>
										<button type='submit' class='btn btn-primary'><i class="ti-save"></i> Simpan</button>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	function togglePerihal(){
		var perihal = $('#fPerihal').val();
		if(perihal==1){
			$('#divJanda').show();
			$('.fJanda').removeAttr('disabled');
		}else{
			$('#divJanda').hide();
			$('.fJanda').Attr('disabled','disabled');
		}
	}

</script>