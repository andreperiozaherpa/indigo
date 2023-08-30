<?php
$CI = &get_instance();
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
	.listing-thumbnail {
		margin: 0;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	.listing-thumbnail span {
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
					<a href="<?php echo base_url() ?>home">Home</a>
					<a href="<?php echo base_url() ?>perencanaan_kinerja">Perencaan Kinerja</a>
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
				<h3><?= $detail->nama_skpd ?> </h3>
			</div>

		</div>
		<?php
		if (empty($unit_kerja)) {
		?>
			<center>
				<i style="font-size: 80px;display: block" class="ti-briefcase"></i>
				<span style="display: block;margin-top: 30px;margin-bottom:10px;font-size: 20px;">Belum ada unit kerja pada SKPD ini.</span>
				<a href="" onClick=”goBack()” class="btn btn-primary" style="font-size:15px"> <i class="ti-back-left"></i> Kembali</a>
			</center>
			<?php
		} else {
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
														<div id="specificChartKepala" class="donut-size">
															<div class="pie-wrapper">
																<span class="label">
																	<span class="num">0</span><span class="smaller">%</span>
																</span>
																<div class="pie">
																	<div class="left-side half-circle"></div>
																	<div class="right-side half-circle"></div>
																</div>
																<div class="shadow"></div>
															</div>
														</div>
													</div>
													<div class="col-md-8">
														<div class="container">
															<h3 style="background-color:#6610f2;color:white;padding:5px"><?= $skpd->nama_skpd?></h3>
															<div class="panel-group">
																<div class="panel panel-default">
																	<div class="panel-heading"></div>
																	<br>
																	<div class="panel-body">
																		Nama Kepala : <?= $kepala_skpd->nama_lengkap ?>
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
													foreach ($jenis as $j => $v) {
														$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);

														if (!empty($sasaran)) {
															$empty = false;
														}
													}
													$total_indeks = 0;
													$jumlah_jenis = 0;
													if (!$empty) {
														foreach ($jenis as $j => $v) {
															$name = $this->renja_perencanaan_model->name($j);
															
															$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
															if (!empty($sasaran)) {
													?>
																<div class="col-md-12">
																	<p class="text-left" style="background-color:#6610f2;font-size:15px;color:white;margin-left:-20px;margin-right:-20px;padding-left:20px" disabled><?= $v ?></p>
																</div>
																<?php
																$no = 1;

																foreach ($sasaran as $s) {
																	$tSasaran = $name['tSasaran'];
																	$cSasaran = $name['cSasaran'];
																		$iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);

																?>
																	<?php

																	$capaian = array();
																	foreach ($iku as $i) :
																		$tIku = $name['tIku'];
																		$cIku = $name['cIku'];
																		$cIkuRenja = $name['cIkuRenja'];
																		$taIkuRenja = $name['taIkuRenja'];
																		$aIkuRenja = $name['aIkuRenja'];
																		$rIkuRenja = $name['rIkuRenja'];
																		$target = $i->$taIkuRenja;
																		$realisasi = $i->$rIkuRenja;
																		$pola = $i->polorarisasi;
																		$capaian[] = $i->capaian; //get_capaian($target,$realisasi,$pola);
																	endforeach;
																	$t_iku = count($iku) * 100;
																	if ($t_iku == 0) $t_iku = 1;
																	$t_hasil = array_sum($capaian);
																	$t_indeks = ($t_hasil / $t_iku) * 100;
																	$t_indeks_ =  number_format($t_indeks, 1);
																	$t_sasaran = count($s) * 100;
																	$tt_indeks_ = ($t_indeks_ / $t_sasaran) * 100;
																	$ts_indeks_[$tSasaran] = $tt_indeks_;
																	$total_indeks += $tt_indeks_;
																	$jumlah_jenis++;
																	?>
																	<p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?>%</span> <strong>Sasaran <?= $no ?>.</strong> <?= $s->$tSasaran ?> </p>
																	<div class="table-responsive">
																		<table class="table">
																			<thead class="thead-light">
																				<tr>
																					<th style="vertical-align: middle;text-align: center">Indeks Capaian Iku</th>
																					<th style="vertical-align: middle;text-align: center">Kode</th>
																					<th style="vertical-align: middle;text-align: center" width="30%">Indikator</th>
																					<th style="vertical-align: middle;text-align: center">Satuan</th>
																					<th style="vertical-align: middle;text-align: center">Target</th>
																					<th style="vertical-align: middle;text-align: center">Realisasi</th>
																					<th style="vertical-align: middle;text-align: center">Polarisasi</th>
																					<th style="vertical-align: middle;text-align: center">Jml Renaksi</th>
																					<th style="vertical-align: middle;text-align: center">Casecading ke</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$n = 1;
																				$tIku = $name['tIku'];
																				$cIku = $name['cIku'];
																				$taIkuRenja = $name['taIkuRenja'];
																				$aIkuRenja = $name['aIkuRenja'];
																				$rIkuRenja = $name['rIkuRenja'];
																				foreach ($iku as $i) {
																					$unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
																					$a_unit_kerja = array();
																					foreach ($unit_kerjaz as $uk) {
																						$a_unit_kerja[] = $uk->nama_unit_kerja;
																					}
																					$unit_kerjaz = implode(', ', $a_unit_kerja);
																					$target = $i->$taIkuRenja;
																					$realisasi = $i->$rIkuRenja;
																					$pola = $i->polorarisasi;

																					$capaian = $i->capaian;
																					$jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));

																				?>
																					<tr>
																						<td style="vertical-align: middle;"><span class="badge badge-warning" style="min-width:50px"><?= $capaian ?>%</span></td>
																						<td style="vertical-align: middle;"><?= $no ?>.<?= $n ?></td>
																						<td style="vertical-align: middle;"><?= $i->$tIku ?></td>
																						<td style="vertical-align: middle;text-align: center"><?= $i->satuan ?></td>
																						<td style="vertical-align: middle;text-align: center"><?= $i->$taIkuRenja ?></td>
																						<td style="vertical-align: middle;text-align: center"><?= $i->$rIkuRenja ?></td>
																						<td style="vertical-align: middle;text-align: center"><?= $i->polorarisasi ?></td>


																						<td style="vertical-align: middle;text-align: center"><?=$jml_renaksi?></td>
																						<td style="vertical-align: middle;"><span class="readmore"><?= $unit_kerjaz ?></span></td>
																					</tr>
																					<?php $n++;
																				} ?>
																			</tbody>
																		</table>
																	</div>
														<?php $no++;
																}
															}
														}
														$jumlah_indeks = $total_indeks / $jumlah_jenis; ?>

														<script type="text/javascript">
															document.addEventListener('DOMContentLoaded', function() {
																updateDonutChart('#specificChartKepala', <?= $jumlah_indeks ?>, true);
															}, false);
														</script>

													<?php } else {
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

<?php
			foreach ($unit_kerja as $u) {
				if($u->id_unit_kerja==0){
					continue;
				}
				$kepala = $this->ref_skpd_model->get_kepala_unit_kerja($u->id_unit_kerja);
				$staff = $this->ref_skpd_model->get_staff_unit_kerja($u->id_unit_kerja);
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
														<div id="specificChart<?= $u->id_unit_kerja ?>" class="donut-size">
															<div class="pie-wrapper">
																<span class="label">
																	<span class="num">0</span><span class="smaller">%</span>
																</span>
																<div class="pie">
																	<div class="left-side half-circle"></div>
																	<div class="right-side half-circle"></div>
																</div>
																<div class="shadow"></div>
															</div>
														</div>
													</div>
													<div class="col-md-8">
														<div class="container">
															<h3 style="background-color:#6610f2;color:white;padding:5px"><?= $u->nama_unit_kerja?></h3>
															<div class="panel-group">
																<div class="panel panel-default">
																	<div class="panel-heading"></div>
																	<br>
																	<div class="panel-body">
																		Nama Kepala : <?= $kepala->nama_lengkap ?>
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
													foreach ($jenis as $j => $v) {
														if ($u->id_unit_kerja == 0) {
															$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
														} else {
															$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
														}

														if (!empty($sasaran)) {
															$empty = false;
														}
													}
													$total_indeks = 0;
													$jumlah_jenis = 0;
													if (!$empty) {
														foreach ($jenis as $j => $v) {
															$name = $this->renja_perencanaan_model->name($j);
															if ($u->id_unit_kerja == 0) {
																$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
															} else {
																$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
															}
															if (!empty($sasaran)) {
													?>
																<div class="col-md-12">
																	<p class="text-left" style="background-color:#6610f2;font-size:15px;color:white;margin-left:-20px;margin-right:-20px;padding-left:20px" disabled><?= $v ?></p>
																</div>
																<?php
																$no = 1;

																foreach ($sasaran as $s) {
																	$tSasaran = $name['tSasaran'];
																	$cSasaran = $name['cSasaran'];
																	if ($u->id_unit_kerja == 0) {
																		$iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
																	} else {
																		$iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $u->id_unit_kerja);
																	}

																?>
																	<?php

																	$capaian = array();
																	foreach ($iku as $i) :
																		$tIku = $name['tIku'];
																		$cIku = $name['cIku'];
																		$cIkuRenja = $name['cIkuRenja'];
																		$taIkuRenja = $name['taIkuRenja'];
																		$aIkuRenja = $name['aIkuRenja'];
																		$rIkuRenja = $name['rIkuRenja'];
																		$target = $i->$taIkuRenja;
																		$realisasi = $i->$rIkuRenja;
																		$pola = $i->polorarisasi;
																		$capaian[] = $i->capaian; //get_capaian($target,$realisasi,$pola);
																	endforeach;
																	$t_iku = count($iku) * 100;
																	if ($t_iku == 0) $t_iku = 1;
																	$t_hasil = array_sum($capaian);
																	$t_indeks = ($t_hasil / $t_iku) * 100;
																	$t_indeks_ =  number_format($t_indeks, 1);
																	$t_sasaran = count($s) * 100;
																	$tt_indeks_ = ($t_indeks_ / $t_sasaran) * 100;
																	$ts_indeks_[$tSasaran] = $tt_indeks_;
																	$total_indeks += $tt_indeks_;
																	$jumlah_jenis++;
																	?>
																	<p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?>%</span> <strong>Sasaran <?= $no ?>.</strong> <?= $s->$tSasaran ?> </p>
																	<div class="table-responsive">
																		<table class="table">
																			<thead class="thead-light">
																				<tr>
																					<th style="vertical-align: middle;text-align: center">Indeks Capaian Iku</th>
																					<th style="vertical-align: middle;text-align: center">Kode</th>
																					<th style="vertical-align: middle;text-align: center" width="30%">Indikator</th>
																					<th style="vertical-align: middle;text-align: center">Satuan</th>
																					<th style="vertical-align: middle;text-align: center">Target</th>
																					<th style="vertical-align: middle;text-align: center">Realisasi</th>
																					<th style="vertical-align: middle;text-align: center">Polarisasi</th>
																					<th style="vertical-align: middle;text-align: center">Jml Renaksi</th>
																					<th style="vertical-align: middle;text-align: center">Casecading ke</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$n = 1;
																				$tIku = $name['tIku'];
																				$cIku = $name['cIku'];
																				$taIkuRenja = $name['taIkuRenja'];
																				$aIkuRenja = $name['aIkuRenja'];
																				$rIkuRenja = $name['rIkuRenja'];
																				foreach ($iku as $i) {
																					$unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
																					$a_unit_kerja = array();
																					foreach ($unit_kerjaz as $uk) {
																						$a_unit_kerja[] = $uk->nama_unit_kerja;
																					}
																					$unit_kerjaz = implode(', ', $a_unit_kerja);
																					$target = $i->$taIkuRenja;
																					$realisasi = $i->$rIkuRenja;
																					$pola = $i->polorarisasi;

																					$capaian = $i->capaian; //get_capaian($target,$realisasi,$pola);
																					$jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));

																				?>
																				<tr>
																					<td style="vertical-align: middle;"><span class="badge badge-warning" style="min-width:50px"><?= $capaian ?>%</span></td>
																					<td style="vertical-align: middle;"><?= $no ?>.<?= $n ?></td>
																					<td style="vertical-align: middle;"><?= $i->$tIku ?></td>
																					<td style="vertical-align: middle;text-align: center"><?= $i->satuan ?></td>
																					<td style="vertical-align: middle;text-align: center"><?= $i->$taIkuRenja ?></td>
																					<td style="vertical-align: middle;text-align: center"><?= $i->$rIkuRenja ?></td>
																					<td style="vertical-align: middle;text-align: center"><?= $i->polorarisasi ?></td>


																					<td style="vertical-align: middle;text-align: center"><?=$jml_renaksi?></td>
																					<td style="vertical-align: middle;"><span class="readmore"><?= $unit_kerjaz ?></span></td>
																				</tr>

																					<?php $n++;
																				} ?>
																			</tbody>
																		</table>
																	</div>
														<?php $no++;
																}
															}
														}
														$jumlah_indeks = $total_indeks / $jumlah_jenis; ?>

														<script type="text/javascript">
															document.addEventListener('DOMContentLoaded', function() {
																updateDonutChart('#specificChart<?= $u->id_unit_kerja ?>', <?= $jumlah_indeks ?>, true);
															}, false);
														</script>

													<?php } else {
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