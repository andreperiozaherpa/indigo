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
				<span style="color:#FFFFFF;display:block;margin-bottom:10px;font-size:15px">E-SAKIP Kabupaten Sumedang</span>
				<span style="color:#FFFFFF;font-size:16px;background-color:#6441EB;padding:5px 15px;border-radius:30px;margin-bottom:300px">MAUTI (Mari Unjuk Kinerja untuk Sumedang Simpati)</span>
				<!-- <div class="page_link">
							<a href="<?php echo base_url() ?>home">Home</a>
							<a href="<?php echo base_url() ?>perencanaan_kinerja">Perencaan Kinerja</a>
						</div> -->
				<h2 style="margin-top:5px">Perencanaan Kinerja, Gaskeun !</h2>
			</div>
		</div>
	</div>
</section>




<section class="">

	<!-- Content
	================================================== -->
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><i class="sl sl-icon-book-open"></i> Perencanaan Kinerja <?= $tahun_ ?> <div class="pull-right"><select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class=""><?php
																																																																	$current_year = date("Y");
																																																																	$array_year = array();
																																																																	foreach ($tahun as $r) {
																																																																		if ($r->tahun_berkas > 0) {
																																																																			array_push($array_year, $r->tahun_berkas);
																																																																		}
																																																																	}
																																																																	rsort($array_year);
																																																																	$min_year = ($array_year[0] < $current_year - 5) ? $array_year[0] : $current_year - 5;
																																																																	$max_year = ($array_year[count($array_year) - 1] > $current_year + 5) ? $array_year[count($array_year) - 1] : $current_year + 5;
																																																																	for ($i = $min_year; $i < $max_year; $i++) {
																																																																		array_push($array_year, $i);
																																																																	}
																																																																	$array_year = array_unique($array_year);
																																																																	rsort($array_year);
																																																																	foreach ($array_year as $year) {
																																																																		$selected = "";
																																																																		if ($this->uri->segment(3) == $year) {
																																																																			$selected = "selected";
																																																																		}
																																																																		echo '<option value="' . base_url("perencanaan_kinerja/index/" . $year) . '" ' . $selected . '>' . $year . '</option>';
																																																																	}
																																																																	?></select></div>
				</h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table style="margin-top: 20px" class="basic-table">
								<thead>
									<tr>
										<th>NO</th>
										<th>SKPD</th>
										<?php if ($level <= 1) { ?>
											<th style="text-align: center; "><span class="fa fa-book"></span> </th>
											<th style="text-align: center; ">RENJA</th>
										<?php } ?>
										<th style="text-align: center; ">PK</th>
										<th style="text-align: center; ">IKU</th>
										<?php if ($level < 4) { ?>
											<th>CASCADING</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<tr style="background-color:rgba(0,0,255,0.3);">
										<td>1</td>
										<td>Kabupaten Sumedang</td>
										<td style="text-align: center; background-color: rgba(0,255,0,0.3); color: white"><a href="<?= base_url('perencanaan_kinerja/detail_rpjmd/' . $tahun_) ?>" target="_blank">RPJMD <i class="fa fa-search"></a></td>
										<td style="text-align: center; ">-</td>
										<td style="text-align: center; ">-</td>
										<td style="text-align: center; ">-</td>
										<td style="text-align: center; ">-</td>
									</tr>
									<tr>
										<?php $no = 2; ?>
										<?php foreach ($list as $l) {
											$unit_kerja = $this->ref_skpd_model->get_unit_kerja_by_id_skpd($l->id_skpd);
										?>
											<td><?php echo $no; ?></td>
											<td><?= $l->nama_skpd ?></td>
											<td style="text-align: center; background-color: rgba(0,255,0,0.3); color: white"><a href="<?php echo base_url(); ?>perencanaan_kinerja/detail_renstra/<?= $l->id_skpd ?>/<?= $tahun_ ?>" target="_blank">Renstra <i class="fa fa-search"></a></td>
											<td style="text-align: center; "><a href="<?php echo base_url(); ?>perencanaan_kinerja/detail_renja/<?= $l->id_skpd ?>/<?= $tahun_ ?>" target="_blank" title="RENJA"><i class="fa fa-search"></i></a></td>
											<td style="text-align: center; "><a href="<?php echo base_url(); ?>perencanaan_kinerja/detail_pk/<?= $l->id_skpd ?>/<?= $tahun_ ?>" target="_blank" title="PK"><i class="fa fa-search"></i></a></td>
											<td style="text-align: center; "><a href="<?php echo base_url(); ?>perencanaan_kinerja/iku_skpd/<?= $l->id_skpd ?>" target="_blank" title="Lihat IKU"><i class="fa fa-search"></i></a></td>
											<td style="text-align: center; ">-</td>
									</tr>
									<?php $no++; ?>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- Switcher ON-OFF Content / End -->

		</div>
		<!-- Section / End -->
	</div>




</section>

<!-- Resntra Modal -->