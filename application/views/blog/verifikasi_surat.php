<?php
$CI =& get_instance();
$CI->load->model('company_profile_model');
$CI->company_profile_model->set_identity();
$p_nama = $CI->company_profile_model->nama;
$p_tentang = $CI->company_profile_model->tentang;
$p_alamat = $CI->company_profile_model->alamat;
$p_logo = $CI->company_profile_model->logo;
$p_email = $CI->company_profile_model->email;
$p_facebook = $CI->company_profile_model->facebook;
$p_twitter = $CI->company_profile_model->twitter;
$p_telepon = $CI->company_profile_model->telepon;
$p_youtube = $CI->company_profile_model->youtube;
$p_gmap = $CI->company_profile_model->gmap;
$p_tentang = $CI->company_profile_model->tentang;
$p_instagram = $CI->company_profile_model->instagram;
?>
<style type="text/css">
.listing-thumbnail{
	margin: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
.listing-thumbnail span{
	font-size: 100px;
	color: #f91942;
}
.head-surat{
	z-index:999;position:absolute;background: linear-gradient(to right, #8252fa 0%, #eca2f1 100%), radial-gradient(circle at top left, #8252fa, #eca2f1);
	width: 400px;
	color: #fff;
	padding: 10px;
	border-radius: 2px 2px 40px 2px;
}
.button.download{
	color: #fff !important;
	margin-bottom: 10px;

}

.iframe-surat{
	border:solid 2px #8252fa;
}
.frame-surat{
	width: 100%;height:740px;border: none;
}
@media(max-width: 768px){
	.head-surat{
		width: 300px;
	}
	.add-listing-section{
		padding: 10px !important;
	}

	.preview-surat{
		margin-top: 30px;
	}
	.frame-surat{
		height: 500px;
	}
	.detail-surat{
		margin-top: 60px;
	}
}

</style>
<!-- Titlebar
	================================================== -->
	<section class="banner_area" style="min-height: unset;">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="" style="transform: translateY(-37.7529px);"></div>
			<div class="container">
				<div class="banner_content text-left">
					<div class="page_link">
						<a href="<?php echo base_url()?>home">Home</a>
						<a href="<?php echo base_url()?>verifikasi_surat">Verifikasi Surat</a>
					</div>
					<h2>Verifikasi Surat</h2>
				</div>
			</div>
		</div>


<!-- Content
	================================================== -->
	<section class="">
		<div class="container">
			<?php 
			if($type=='no'){
				?>
				<div class="add-listing-section margin-top-45">
					<div class="add-listing-headline">
						<h3><i class="sl sl-icon-check"></i> Verifikasi Surat</h3>
					</div>
					<div class="row">
						<div class="col-md-12">			
							<form method="post">
								<div class="row">

									<div class="col-md-10">
										<div class="form-group">
											<label style="font-weight: bold;">Nomor Surat</label>
											<input type="text"  value="<?=set_value('no_surat')?>" name="no_surat" placeholder="Cari berdasarkan Nomor Surat ...">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<button style="width: 100%;margin-top: 30px;" class="button pull-right" ><i class="sl sl-icon-magnifier"></i> Cari</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<?php
			}elseif($type=="not_found"){
				?>
					<div class="margin-top-45">
						<div style="border-radius:27px 0px 0px 27px;background-color: #FCFCFC; padding: 15px;position: relative;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);">
							<i style="border-radius:50%;font-size:20px;background-color: #22a7f0;color: #fff;padding: 17px;position: absolute;margin-top: -15px;margin-left: -13px;" class="sl sl-icon-info"></i> 
							<span style="margin-left: 50px;">Surat Masih Dalam Proses Peninjauan</span>
						</div>

						<div style="font-weight: 300;margin-top: 20px;background-color: #FCFCFC; padding: 15px;position: relative;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);">
							Surat ini <b>TIDAK VALID</b> karena masih dalam proses peninjauan sehingga belum dibubuhi Tanda Tangan Digital.
						</div>
					</div>
				<?php
			}
			if(isset($detail)){
				if(!$detail){?>
					<div class="margin-top-45">
						<div style="border-radius:27px 0px 0px 27px;background-color: #FCFCFC; padding: 15px;position: relative;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);">
							<i style="border-radius:50%;font-size:20px;background-color: #f44a40;color: #fff;padding: 17px;position: absolute;margin-top: -15px;margin-left: -13px;" class="sl sl-icon-close"></i> 
							<span style="margin-left: 50px;">Surat <?php if($type=='no'){?> dengan nomor <b><?=set_value('no_surat')?></b><?php } ?> tidak ditemukan</span>
						</div>
					</div>
				<?php }elseif($detail->status_ttd!=='sudah_ditandatangani'){
					?>
					<div class="margin-top-45">
						<div style="border-radius:27px 0px 0px 27px;background-color: #FCFCFC; padding: 15px;position: relative;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);">
							<i style="border-radius:50%;font-size:20px;background-color: #f44a40;color: #fff;padding: 17px;position: absolute;margin-top: -15px;margin-left: -13px;" class="sl sl-icon-refresh"></i> 
							<span style="margin-left: 50px;">Surat <?php if($type=='no'){?> dengan nomor <b><?=set_value('no_surat')?></b><?php } ?> masih dalam proses</span>
						</div>
					</div>
					<?php
				}else{?>
					<div class="margin-top-45">
						<div style="border-radius:27px 0px 0px 27px;background-color: #FCFCFC; padding: 15px;position: relative;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);">
							<i style="border-radius:50%;font-size:20px;background-color: #8252fa;color: #fff;padding: 17px;position: absolute;margin-top: -15px;margin-left: -13px;" class="sl sl-icon-check"></i> 
							<span style="margin-left: 50px;">Surat <?php if($type=='no'){?> dengan nomor <b><?=set_value('no_surat')?></b><?php } ?> terdaftar pada sistem</span>
						</div>
					</div>
					<div class="margin-top-30">
						<div class="head-surat"> <i style="font-size: 30px;" class="sl 
							sl-icon-envelope-open"></i> <h3 style="display: inline-block;margin-right: 30px;">INFORMASI SURAT</h3></div>
							<div class="add-listing-section margin-top-45" style="padding: 40px;padding-top: 80px;">
								<div class="row detail-surat">
									<div class="col-md-4">
										<div style="display: block;">
											<span style="color: #8252fa">Nomor Surat</span>
											<h4 style="font-size: 17px;"><?=$detail->nomer_surat?></h4>
										</div>
										<div style="display: block;">
											<span style="color: #8252fa">No. Reg. Sistem</span>
											<h3><?=$detail->hash_id?></h3>
										</div>
										<div style="display: block;margin-top: 10px">
											<span style="color: #8252fa">Jenis Surat</span>
											<h3><?=$detail->nama_surat?></h3>
										</div>
										<div style="display: block;margin-top: 10px">
											<span style="color: #8252fa">Perihal</span>
											<h3><?=$detail->perihal?></h3>
										</div>
										<div style="display: block;margin-top: 10px">
											<span style="color: #8252fa">Sifat Surat</span>
											<h3><?=ucwords($detail->sifat_surat)?></h3>
										</div>
										<div style="display: block;margin-top: 10px">
											<span style="color: #8252fa">Pengirim</span>
											<span class="badge badge-primary" style="border-radius:0px 10px 10px 0px;padding:5px; background-color: #8252fa;font-weight: 300"><?=tanggal($detail->tgl_buat)?><i style="background-color: #eca2f1;border-radius:50%;margin-left:20px;margin-right:-10px;padding: 8px;" class="sl sl-icon-clock"></i></span>
											<h3><?=$detail->nama_skpd?></h3>
										</div>
										<div style="display: block;margin-top: 10px">
											<span style="color: #8252fa">Penerima</span>
											<span class="badge badge-primary" style="border-radius:0px 10px 10px 0px;padding:5px; background-color: #8252fa;font-weight: 300"><?=tanggal($detail->tgl_surat)?> <i style="background-color: #eca2f1;border-radius:50%;margin-left:20px;margin-right:-10px;padding: 8px;" class="sl sl-icon-clock"></i></span>
											<?php 
											foreach($penerima as $p){
												?>

												<div style="margin-top:10px;box-shadow: 0 0 12px 0 rgba(0,0,0,0.06);text-align: left !important;padding:4px">
													<?php
													if($p->jenis_surat=='internal'){
														?>

														<?php
														?>
														<small style="display: block"><i style="color: #5D03C1" class="ti-user"></i> <?=$p->nama_lengkap?></small>
														<small style="display: block"><i style="color: #5D03C1" class="ti-bar-chart"></i> <?=$p->nama_jabatan?></small>
													<?php }elseif($p->jenis_surat=='eksternal'&&$p->jenis_penerima=='skpd'){
														?>
														<small style="display: block"><i data-icon="&#xe030;" style="color: #5D03C1" class="linea-icon linea-aerrow fa-fw"></i>Kepala <?=$p->nama_skpd?></small>
														<?php
													}else{
														?>
														<small style="display: block"><i style="color: #5D03C1" class="ti-flag-alt"></i> <?=$p->nama_penerima?></small>
														<small style="display: block"><i style="color: #5D03C1" class="ti-location-pin"></i> <?=$p->alamat_penerima?></small>
														<?php
													}
													?>

												</div>
												<?php
											} ?>
										</div>
									</div>
									<div class="col-md-8 preview-surat">
										<a href="<?=base_url('data/'.$detail->jenis_surat.'/ttd/'.$detail->file_ttd.'')?>" class="button download"><i class="sl sl-icon-cloud-download"></i> Download Surat</a>
										<div class="iframe-surat">
											<iframe src="https://docs.google.com/viewerng/viewer?url=<?=base_url('data/'.$detail->jenis_surat.'/ttd/'.$detail->file_ttd.'')?>&embedded=true&rand=<?=rand(1,9999)?>" class="frame-surat">
												Memuat Dokumen ...
											</iframe>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } } ?>
				</div>

			</section>
