<?php
$CI =& get_instance();
$CI->load->model('company_profile_model');
$CI->load->model("ref_skpd_model");
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


		<div class="all-listing-section margin-top-15">
			<div class="add-listing-headline">
				<h3><?= (!empty($detail->nama_skpd)) ? $detail->nama_skpd : ""?> </h3>
			</div>

		</div>
		<?php
		if(empty($unit_kerja)){
		 ?>
		 <center>
				 <i style="font-size: 80px;display: block" class="ti-briefcase"></i>
				 <span style="display: block;margin-top: 30px;margin-bottom:10px;font-size: 20px;">Belum ada unit kerja pada SKPD ini.</span>
				 <a href="" onClick=”goBack()” class="btn btn-primary" style="font-size:15px"> <i class="ti-back-left"></i> Kembali</a>
		 </center>
		 <?php
		 }else{

		 foreach($unit_kerja as $u){
				 ?>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">

						<div class="row">
							<div class="add-listing-section margin-top-15">

								<!-- Switcher ON-OFF Content -->
								<div class="switcher-coasntent" style="margin-top:30px;">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-4" style="border-right:1px solid black;">
													<div class="text-center">
													<img src="<?= base_url('data/logo/skpd/sumedang.png')?> " width="150px" alt="">
													</div>
												</div>
												<div class="col-md-7">
													<div class="container">
												  <h3 style="background-color:#6610f2;color:white;padding:5px"><?=$u->nama_unit_kerja?></h3>
												  <div class="panel-group">
												    <div class="panel panel-default">
												      <div class="panel-heading"></div>
															<br>
												      <div class="panel-body">
													  	<?php
														  $nama= "";
														  $jumlah_staff=0;
														  if($u->level_unit_kerja==0)
														  {
															  $kepala = $CI->ref_skpd_model->get_kepala_skpd($id_skpd);
															  $nama= $kepala->nama_lengkap;
														  }
														  else{
															$kepala = $CI->ref_skpd_model->get_kepala_unit_kerja($u->id_unit_kerja);
															$nama= $kepala->nama_lengkap;
														  }
														  $staff= $CI->ref_skpd_model->get_staff_unit_kerja($u->id_unit_kerja);
														  $jumlah_staff = count($staff);
														?>
																Nama : <?=$nama;?>
																<hr>
																Jumlah Staf : <?=$jumlah_staff;?>
																<hr>
															</div>
												    </div>
												  </div>
												</div>
												</div>
											</div>
											<br>
											<div class="row">
												<?php
												$empty = true;
												foreach($jenis as $j => $v){
														$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$u->id_unit_kerja,$tahun);
														if(!empty($sasaran)){
																$empty = false;
														}
												}
												if(!$empty){
												foreach($jenis as $j => $v){
														$name = $this->renja_perencanaan_model->name($j);
														$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$u->id_unit_kerja,$tahun);
														if(!empty($sasaran)){
														?>
														<div class="col-md-12">
															<p class="text-left" style="background-color:#6610f2;font-size:15px;color:white;margin-left:-20px;margin-right:-20px;padding-left:20px" disabled>Sasaran Srategis</p>
														</div>
														<?php
						                $no=1;
						                foreach($sasaran as $s){
						                    $tSasaran = $name['tSasaran'];
						                    $cSasaran = $name['cSasaran'];
						                    $iku = $this->renja_perencanaan_model->get_iku($j,$s->$cSasaran,$tahun,$u->id_unit_kerja);
						                    ?>
												 <p><strong>Sasaran <?=$no?>.</strong> <?=$s->$tSasaran?> </p>
												<div class="table-responsive">
														<table class="table">
																<thead class="thead-light">
																	<tr>
																		<th style="vertical-align: middle;text-align: center">Kode</th>
																		<th style="vertical-align: middle;text-align: center">Indikator</th>
																		<th style="vertical-align: middle;text-align: center">Satuan</th>
																		<th style="vertical-align: middle;text-align: center">Target</th>
																		<th style="vertical-align: middle;text-align: center">Realisasi</th>
																		<th style="vertical-align: middle;text-align: center">Polarisasi</th>
																		<th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th>
																		<th style="vertical-align: middle;text-align: center">Jml Renaksi</th>
																		<th style="vertical-align: middle;text-align: center">Jenis Casecading</th>
																		<th style="vertical-align: middle;text-align: center">Casecading ke</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
	                                $n=1;
	                                    $tIku = $name['tIku'];
	                                    $cIku = $name['cIku'];
	                                    $taIkuRenja = $name['taIkuRenja'];
	                                    $aIkuRenja = $name['aIkuRenja'];
	                                    $rIkuRenja = $name['rIkuRenja'];
	                                    foreach($iku as $i){
	                                    $unit_kerja = $this->renstra_realisasi_model->get_unit_iku($j,$i->$cIku);
	                                    $a_unit_kerja = array();
	                                    foreach($unit_kerja as $u){
	                                      $a_unit_kerja[] = $u->nama_unit_kerja;
	                                    }
	                                    $unit_kerja = implode(', ', $a_unit_kerja);

	                                ?>
	                                <tr>
	                                    <td><?=$no?>.<?=$n?></td>
	                                    <td><?=$i->$tIku?></td>
	                                    <td><?=$i->satuan?></td>
	                                    <td><?=$i->$taIkuRenja?></td>
	                                    <td><?=$i->$rIkuRenja?></td>
	                                    <td><?=$i->polorarisasi?></td>

	                                    <td><?=$i->bobot_tertimbang?>%</td>

	                                    <td>2</td>
	                                    <td><?=$i->jenis_casecading?></td>
	                                    <td><?=$unit_kerja?></td>
	                                <?php $n++; } ?>
																</tbody>
														</table>
												</div>
												<?php $no++;  } } } }else{
													?>
													<div style="visibility: hidden;">
														<p>_______________________________________________________________________________________________________________________________________________________</p>
													</div>
													<div class="alert alert-danger col-md-12" role="alert">
													 Belum ada Sasaran yang diturunkan
												 </div>
													<?php
											} ?>
										</div>
										</div>
									</div>
									<!-- Switcher ON-OFF Content / End -->
								</div>

								<!-- Section / End -->
							</div>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			<!-- Section / End -->
		</div>
	<?php }
	} ?>
	</div>
</section>
