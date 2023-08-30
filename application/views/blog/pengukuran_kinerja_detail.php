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

<link href="<?=base_url()?>asset/pixel//plugins/bower_components/css-chart/css-chart.css" rel="stylesheet">
<!-- Titlebar
	================================================== -->
<section class="banner_area" style="min-height: unset;">
			<div class="banner_inner d-flex align-items-center">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="" style="transform: translateY(-37.7529px);"></div>
				<div class="container">
					<div class="banner_content text-left">
						<div class="page_link">
							<a href="<?php echo base_url()?>home">Home</a>
							<a href="<?php echo base_url()?>pengukuran_kinerja">Pengukuran Kinerja</a>
						</div>
						<h2>E-SAKIP Kab. Sumedang</h2>
					</div>
				</div>
			</div>
		</section>


<!-- Content
	================================================== -->
<section class="">
	<div class="container">
		<div class="row">
		<div class="col-md-4">
		<div class="add-listing-section margin-top-45">
			<!-- Headline -->
			<div class="switcher-coasntent">
				<div class="row">
						<center>
							<div class='square-box margin-top-45'>
									<div class='square-content'><div data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div></div>
							</div>
							<hr>
							<h4 class="box-title"><?=$u->nama_skpd?></h4>
						</center>
					</div>
						</div>
						</div>
		</div>
		<div class="col-md-8">
		<div class="add-listing-section margin-top-45">
			<!-- Headline -->
			<div class="add-listing-headline">
				<h4><i class="sl sl-icon-book-open"></i> Detail Capaian Target</h4>
			</div>
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">


						<table class="basic-table">
							<thead>
								<tr  align="center">
									<th>No.</th>
									<th>IKU / IKK</th>
									<th>Target</th>
									<th>Realisasi</th>
									<th>Persentase</th>
								</tr>

							</thead>
							<tbody>
								<tr>
									<td align="right"></td>
									<td></td>
									<td></td>
									<td></td>
									<td><span class=" text-semibold"></span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
			<!-- Section / End -->
		</div>
</div>
</section>
