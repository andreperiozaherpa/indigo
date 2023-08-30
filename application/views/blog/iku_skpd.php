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
</style>

<section class="banner_area" style="min-height: unset;">
			<div class="banner_inner d-flex align-items-center">
				<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background="" style="transform: translateY(-37.7529px);"></div>
				<div class="container">
					<div class="banner_content text-left">
						<div class="page_link">
							<a href="<?php echo base_url()?>home">Home</a>
							<a href="<?php echo base_url()?>perencanaan_kinerja">Perencaan Kinerja</a>
						</div>
						<h2>E-SAKIP Kab. Sumedang</h2>
					</div>
				</div>
			</div>
		</section>

<section class="">

<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><?=$detail->nama_skpd?></h3>
			</div>
			<?php if (count($perencanaan)==0):
				echo "TIDAK ADA DATA";
			else:
				?>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="table-responsive">
								<table style="margin-top: 20px; margin-bottom:20px" class="basic-table" >
									<thead>
										<tr>
											<th>IKU RPJMD</th>
											<th>Target 2019</th>
											<th>Target 2020</th>
											<th>Target 2021</th>
											<th>Target 2022</th>
											<th>Target 2023</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($perencanaan as $p): ?>
												<tr>
													<td><?php echo $p['iku_sasaran_rpjmd'] ?> </td>
													<td><?php echo $p['target_2019'] ?></td>
													<td><?php echo $p['target_2020'] ?></td>
													<td><?php echo $p['target_2021'] ?></td>
													<td><?php echo $p['target_2022'] ?></td>
													<td><?php echo $p['target_2023'] ?></td>
												</tr>
										</tbody>
										<?php endforeach; ?>
									</table>
								</div>
							</div>
							</div>
						</div>
						 </div>
						 <?php endif; ?>
					</div>
				</div>

</section>


<!-- Resntra Modal -->
