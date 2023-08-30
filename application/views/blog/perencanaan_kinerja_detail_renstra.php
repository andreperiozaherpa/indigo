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
		<?php
		 $j_ss = $this->renstra_perencanaan_model->get_total_ss($detail->id_skpd);
		 $iku_ss = $this->renstra_perencanaan_model->get_total_iku_ss($detail->id_skpd);

		 $j_sp = $this->renstra_perencanaan_model->get_total_sp($detail->id_skpd);
		 $iku_sp = $this->renstra_perencanaan_model->get_total_iku_sp($detail->id_skpd);

		 $j_sk = $this->renstra_perencanaan_model->get_total_sk($detail->id_skpd);
		 $iku_sk = $this->renstra_perencanaan_model->get_total_iku_sk($detail->id_skpd);
		 ?>
<section class="">

<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3>Sasaran Strategis</h3>
			</div>
			<?php
				if(count($sasaran_strategis)==0) :
					echo 'TIDAK ADA DATA';
				else :
					$n=1;
					foreach ($sasaran_strategis as $key => $ss): ?>
			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							 <p><strong>Sasaran <?=$n?>.</strong> <?=$ss['sasaran_strategis_renstra']?>  </p>
							 <?php if (count($iku_sasaran_strategis[$key])>0): ?>
							<div class="table-responsive">
									<table class="table">
											<thead class="thead-light">
													<tr>
															<th>Kode</th>
															<th>Indikator</th>
															<th>Satuan</th>
															<th>Target  2019</th>
															<th>Target  2020</th>
															<th>Target  2021</th>
															<th>Target  2022</th>
															<th>Target  2023</th>
															<th>Bobot Iku</th>
															<th>Unit Penanggung Jawab</th>
															<th>Status Reviu</th>
													</tr>
											</thead>
											<tbody>
												<?php
													$nn=1;
													foreach ($iku_sasaran_strategis[$key] as $keys => $iku_ss):
														$array_smartc = array('s','m','a','r','t','c');
														foreach ($array_smartc as $a) {
															$array_status_smartc[$a] = $iku_ss['status_'.$a];
														}

														if (in_array('2', $array_status_smartc)) {
															$status_reviu = "ti-alert";
														} elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
															$status_reviu = "ti-star";
														} else {
															$status_reviu = "ti-time";
														}
												?>
													<tr>
															<td><?=$n?>.<?=$nn?></td>
															<td><?=$iku_ss['iku_ss_renstra']?></td>
															<td><?=$iku_ss['satuan']?></td>
															<?php for ($i=2019; $i <= 2023; $i++) { ?>
																<td><?=$iku_ss['target_'.$i]?></td>
															<?php } ?>
															<td><?=$iku_ss['bobot_tertimbang']?></td>
															<td>
																<?php
																// foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
																//   echo "{$row['nama_unit_kerja']}; ";
																// }
																$a_unit_kerja = array();
																foreach($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
																	$a_unit_kerja[] = $row['nama_unit_kerja'];
																}
																$unit_kerja = implode(', ', $a_unit_kerja);
																echo $unit_kerja;
																?>
															</td>
															<td><i class="<?=$status_reviu?>"></i></td>
													</tr>
												<?php $nn++; endforeach ?>
											</tbody>
									</table>
							</div>
							<?php endif ?>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<?php $n++; endforeach; endif; ?>
			<!-- Section / End -->
		</div>
		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3>Sasaran Program</h3>
			</div>
			<?php
				if(count($sasaran_program)==0) :
					echo 'TIDAK ADA DATA';
				else :
					$n=1;
					foreach ($sasaran_program as $key => $sp): ?>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">

						<div class="row">
							<p><strong>Sasaran <?=$n?>.</strong> <?=$sp['sasaran_program_renstra']?></p>
							<?php if (count($iku_sasaran_program[$key])>0): ?>
							 <div class="table-responsive">
									<table class="table">
											<thead class="thead-light">
												<tr>
														<th>Kode</th>
														<th>Indikator</th>
														<th>Satuan</th>
														<th>Target  2019</th>
														<th>Target  2020</th>
														<th>Target  2021</th>
														<th>Target  2022</th>
														<th>Target  2023</th>
														<th>Bobot IKU </th>
														<th>Unit Penanggung Jawab</th>
														<th>Status Reviu</th>
														<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$nn=1;
													foreach ($iku_sasaran_program[$key] as $keys => $iku_sp):
														$array_smartc = array('s','m','a','r','t','c');
														foreach ($array_smartc as $a) {
															$array_status_smartc[$a] = $iku_sp['status_'.$a];
														}

														if (in_array('2', $array_status_smartc)) {
															$status_reviu = "ti-alert";
														} elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
															$status_reviu = "ti-star";
														} else {
															$status_reviu = "ti-time";
														}
												?>
												<tr>
														<td><?=$n?>.<?=$nn?></td>
														<td><?=$iku_sp['iku_sp_renstra']?></td>
														<td><?=$iku_sp['satuan']?></td>
														<?php for ($i=2019; $i <= 2023; $i++) { ?>
															<td><?=$iku_sp['target_'.$i]?></td>
														<?php } ?>

														<td><?=$iku_sp['bobot']?>%</td>
														<td>
															<?php
															// foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
															//   echo "{$row['nama_unit_kerja']}; ";
															// }
															$a_unit_kerja = array();
															foreach($iku_sasaran_program_unit_kerja[$key][$keys] as $row){
																$a_unit_kerja[] = $row['nama_unit_kerja'];
															}
															$iku_unit_kerja = implode(', ', $a_unit_kerja);
															echo $iku_unit_kerja;
															?>
														</td>
														<td><i class="<?=$status_reviu?>" data-toggle="modal" data-target="#statusIndikatorsp<?=$keys?>"></i></td>
														<td><a href="<?php echo base_url('renstra_perencanaan/detail/sp/'.$iku_sp['id_sasaran_program_renstra'].'/'.$iku_sp['id_iku_sp_renstra']);?>" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
												</tr>
												<?php $nn++; endforeach ?>
											</tbody>
									</table>
							</div>
							<?php endif ?>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<?php $n++; endforeach; endif; ?>
			<!-- Section / End -->
		</div>

		<div class="add-listing-section margin-top-15">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3>Sasaran Kegiatan</h3>
			</div>
			<?php
				if(count($sasaran_kegiatan)==0) :
					echo 'TIDAK ADA DATA';
				else :
					$n=1;
					foreach ($sasaran_kegiatan as $key => $sk): ?>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">

						<div class="row">
							<?php if (count($iku_sasaran_kegiatan[$key])>0): ?>
							 <div class="table-responsive">
									<table class="table">
											<thead class="thead-light">
												<tr>
														<th>Kode</th>
														<th>Indikator</th>
														<th>Satuan</th>
														<th>Target  2019</th>
														<th>Target  2020</th>
														<th>Target  2021</th>
														<th>Target  2022</th>
														<th>Target  2023</th>
														<th>Bobot IKU </th>
														<th>Unit Penanggung Jawab</th>
														<th>Status Reviu</th>
														<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$nn=1;
													foreach ($iku_sasaran_kegiatan[$key] as $keys => $iku_sk):
														$array_smartc = array('s','m','a','r','t','c');
														foreach ($array_smartc as $a) {
															$array_status_smartc[$a] = $iku_sk['status_'.$a];
														}

														if (in_array('2', $array_status_smartc)) {
															$status_reviu = "ti-alert";
														} elseif (count(array_unique($array_status_smartc)) == 1 AND in_array('1', $array_status_smartc)) {
															$status_reviu = "ti-star";
														} else {
															$status_reviu = "ti-time";
														}
												?>
												<tr>
														<td><?=$n?>.<?=$nn?></td>
														<td><?=$iku_sk['iku_sk_renstra']?></td>
														<td><?=$iku_sk['satuan']?></td>
														<?php for ($i=2019; $i <= 2023; $i++) { ?>
															<td><?=$iku_sk['target_'.$i]?></td>
														<?php } ?>

														<td><?=$iku_sk['bobot']?>%</td>
														<td>
															<?php
															// foreach ($iku_sasaran_strategis_unit_kerja[$key][$keys] as $row){
															//   echo "{$row['nama_unit_kerja']}; ";
															// }
															$a_unit_kerja = array();
															foreach($iku_sasaran_kegiatan_unit_kerja[$key][$keys] as $row){
																$a_unit_kerja[] = $row['nama_unit_kerja'];
															}
															$iku_unit_kerja = implode(', ', $a_unit_kerja);
															echo $iku_unit_kerja;
															?>
														</td>
														<td><i class="<?=$status_reviu?>" data-toggle="modal" data-target="#statusIndikatorsk<?=$keys?>"></i></td>
														<td><a href="<?php echo base_url('renstra_perencanaan/detail/sk/'.$iku_sk['id_sasaran_kegiatan_renstra'].'/'.$iku_sk['id_iku_sk_renstra']);?>" class="btn btn-info" style="color:white;"><i class="ti-eye"></i> Detail</a></td>
												</tr>
												<?php $nn++; endforeach ?>
											</tbody>
									</table>
							</div>
							<?php endif ?>
						</div>
					</div>

				</div>
				<!-- Switcher ON-OFF Content / End -->

			</div>
			<?php $n++; endforeach; endif; ?>
			<!-- Section / End -->
		</div>

	</div>
</section>


<!-- Resntra Modal -->
