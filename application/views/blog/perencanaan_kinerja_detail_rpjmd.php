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
				<h3>Visi</h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						 <strong><?php echo $visi->visi ?> </strong>
						 </div>
					</div>
				</div>

			</div>
		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3>Misi</h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="table-responsive">
								<table style="margin-top: 20px" class="basic-table" >
									<thead>
										<tr>
											<th>NO</th>
											<th>Nama</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($misi as $m): ?>
											<tr>
												<td><?=$m->id_misi?></td>
												<td><?=$m->misi?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						 </div>
					</div>
				</div>
		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3>Tujuan</h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="table-responsive">
							 <table style="margin-top: 20px" class="basic-table" >
								 <thead>
									 <tr>
										 <th>NO</th>
										 <th>Ref. Misi</th>
										 <th>Tujuan</th>
									 </tr>
								 </thead>
								 <tbody>
									 <?php
									 $no = 1;
									 foreach ($tujuan as $m): ?>
										 <tr>
											 <td><?=$no?></td>
											 <td><?=$m->misi?></td>
											 <td><?=$m->tujuan?></td>
										 </tr>
										<?php $no++; endforeach?>
									 </tbody>
								 </table>
							 </div>
						 </div>
							</div>
						</div>
					</div>
				</div>
				<!-- Switcher ON-OFF Content / End -->
			<!-- Section / End -->
			<div class="add-listing-section margin-top-15">

				<!-- Headline -->
				<div class="add-listing-headline">
					<h3>Sasaran</h3>
				</div>

				<!-- Switcher ON-OFF Content -->
				<div class="switcher-coasntent">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<?php
								foreach ($sasaran as $s): ?>
								<strong><?php echo $s->sasaran_rpjmd ?> </strong>
								<div class="table-responsive">
								 <table style="margin-top: 20px" class="basic-table" >
									 <thead>
										 <tr>
											 <th>No</th>
						            <th>Indikator</th>
						            <th>Target 2019</th>
						            <th>Target 2020</th>
						            <th>Target 2021</th>
						            <th>Target 2022</th>
						            <th>Target 2023</th>
						            <th>Satuan</th>
						            <th>SKPD Penanggung Jawab</th>
										 </tr>
									 </thead>
									 <tbody>
							<?php
							$indikator = $this->sasaran_rpjmd_model->get_indikator_by_id_s($s->id_sasaran_rpjmd);
							$no=1;
							foreach($indikator as $i){
							?>
										 <tr>
										 <td><?=$no?></td>
		                 <td><?=$i->iku_sasaran_rpjmd?></td>
		                 <td><?=$i->target_2019?></td>
		                 <td><?=$i->target_2020?></td>
		                 <td><?=$i->target_2021?></td>
		                 <td><?=$i->target_2022?></td>
		                 <td><?=$i->target_2023?></td>
		                 <td><?=$i->satuan?></td>
		                 <td>
                                <?php 
                                $list_skpd = array();
                                foreach($i->skpd as $s){
                                  $list_skpd[] = $s->nama_skpd;
                                }
                                echo implode(', ', $list_skpd);
                                ?></td>
									 </tr>
								 <?php $no++; } 
								 if(count($indikator)==0){
									echo "<td colspan='9' >Belum ada data</td>";
								} ?>
										 </tbody>
									 </table>
								 </div>
								 <?php endforeach; ?>

								
							 </div>
								</div>
							</div>
						</div>
					</div>
					<!-- Switcher ON-OFF Content / End -->
				<!-- Section / End -->
</section>


<!-- Resntra Modal -->
