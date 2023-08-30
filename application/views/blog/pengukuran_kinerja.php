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

	@-webkit-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	@-o-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	@keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	.progress {
		height: 20px;
		margin-bottom: 20px;
		overflow: hidden;
		background-color: #f5f5f5;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	}

	.progress-bar {
		float: left;
		width: 0;
		height: 100%;
		font-size: 12px;
		line-height: 20px;
		color: #fff;
		text-align: center;
		background-color: #337ab7;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
		-webkit-transition: width .6s ease;
		-o-transition: width .6s ease;
		transition: width .6s ease;
	}

	.progress-striped .progress-bar,
	.progress-bar-striped {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		-webkit-background-size: 40px 40px;
		background-size: 40px 40px;
	}

	.progress.active .progress-bar,
	.progress-bar.active {
		-webkit-animation: progress-bar-stripes 2s linear infinite;
		-o-animation: progress-bar-stripes 2s linear infinite;
		animation: progress-bar-stripes 2s linear infinite;
	}

	.progress-bar-success {
		background-color: #5cb85c;
	}

	.progress-striped .progress-bar-success {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-info {
		background-color: #5bc0de;
	}

	.progress-striped .progress-bar-info {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-warning {
		background-color: #f0ad4e;
	}

	.progress-striped .progress-bar-warning {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	.progress-bar-danger {
		background-color: #d9534f;
	}

	.progress-striped .progress-bar-danger {
		background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
		background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
	}

	progress {
		display: inline-block;
		vertical-align: baseline;
	}

	.progress {
		-webkit-box-shadow: none !important;
		background-color: rgba(120, 130, 140, .21);
		box-shadow: none !important;
		height: 15px;
		border-radius: 3px;
		margin-bottom: 18px;
		overflow: hidden
	}

	.progress-bar {
		box-shadow: none;
		font-size: 8px;
		font-weight: 600;
		line-height: 12px
	}

	.progress.progress-sm {
		height: 8px !important
	}

	.progress.progress-sm .progress-bar {
		font-size: 8px;
		line-height: 5px
	}

	.progress.progress-md {
		height: 15px !important
	}

	.progress.progress-md .progress-bar {
		font-size: 10.8px;
		line-height: 14.4px
	}

	.progress.progress-lg {
		height: 20px !important
	}

	.progress.progress-lg .progress-bar {
		font-size: 12px;
		line-height: 20px
	}

	.progress-bar-danger {
		background-color: #6441eb
	}
</style>
<!-- Titlebar
	================================================== -->
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
				<h2 style="margin-top:5px">Pengukuran Kinerja, Hayu ah Kuykeun..</h2>
			</div>
		</div>
	</div>
</section>

<!-- Content
	================================================== -->
<section class="">
	<div class="container">
		<div class="add-listing-section margin-top-45">

			<!-- Headline -->
			<div class="add-listing-headline">
				<h3><i class="sl sl-icon-book-open"></i> Pengukuran Kinerja <?= $tahun_ ?></h3>
			</div>

			<!-- Switcher ON-OFF Content -->
			<div class="switcher-coasntent">
				<div class="row">
					<div class="col-md-12">
						<?php
						if ($level > 1) {
							if ($level == 2) {
								$link = 1;
							} else {
								$this->ref_unit_kerja_model->id_unit_kerja = $id_induk;
								$aa = $this->ref_unit_kerja_model->get_by_id();
								$n = $level - 1;
								$link = $n . '/' . $aa->id_induk;
							}
						?>
							<a href="<?= base_url('pengukuran_kinerja/index/' . $tahun_ . '/' . $link . '') ?>" class="button border pull-right">Kembali</a>
						<?php } ?>
					</div>
				</div>
				<form method="GET">
					<div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label style="font-weight: bold;">TAHUN</label>
								<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class=""><?php
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
																																										if ($tahun_ == $year) {
																																											$selected = "selected";
																																										}
																																										echo '<option value="' . base_url("pengukuran_kinerja/index/" . $year) . '" ' . $selected . '>' . $year . '</option>';
																																									}
																																									?></select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label style="font-weight: bold;">SKPD</label>
								<select name="id_unit" class="select2">
									<option value="">Pilih Unit Kerja</option>
									<?php
									foreach ($list as $u) {
										$selected = (!empty($id_unit) && $u->id_skpd == $id_unit) ? "selected" : "";
										echo '<option ' . $selected . ' value="' . $u->id_skpd . '">' . $u->nama_skpd . '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label style="font-weight: bold;">&nbsp;FILTER</label>
								<button style="margin-right: -20px" class="button pull-right">Filter</button>
							</div>
						</div>
					</div>
					<hr>
				</form>
				<table style="margin-top: 20px" class="basic-table">
					<thead>
						<tr>
							<th style="text-align: center">DATA CAPAIAN</th>
							<?php if ($level < 4) { ?>
								<!-- <th style="text-align: center" width="10%">CASCADING</th> -->
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$CI = &get_instance();
						$CI->load->model("pencapaian_model");
						$no = 1;
						foreach ($list as $uk) {
							$rand = rand(0, 100);
							//$tw1 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,1,3);
							//$tw2 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,4,6);
							//$tw3 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,7,9);
							//$tw4 = $CI->pencapaian_model->getCapaianTriwulan($uk->id_unit_kerja,$tahun_,10,12);
							$level_n = $level + 1;
							$kepala_skpd = $this->master_pegawai_model->get_pegawai_kepala_skpd($uk->id_skpd);
						?>
							<tr class="" id="tr_1">
								<td>

									<div class="col-md-2">
										<center>
											<img style="width: 120px;height:120px;object-fit:cover" src="<?= base_url() ?>data/foto/pegawai/<?=@$kepala_skpd->foto_pegawai?>" alt="user" class="img-circle" /> </center>
									</div>
									<div class="col-md-10">
										<h4><?= $uk->nama_skpd ?></h4>
										<span style="display: block;font-size:11px">Kepala : <span style="color:#6441EB"><?=@$kepala_skpd->nama_lengkap?></span></span>
										<small>Capaian IKU/Sasaran Strategis</small>
										<div class="pull-right"><?= round($grafik_capaian_ss[$uk->id_skpd], 1) ?>% </div>
										<div class="progress">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= round($grafik_capaian_ss[$uk->id_skpd], 1) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($grafik_capaian_ss[$uk->id_skpd], 1) ?>%;"> <span class="sr-only"><?= round($grafik_capaian_ss[$uk->id_skpd], 1) ?>% Complete</span></div>
										</div>
										<small>Capaian Program/Kegiatan/Sub Kegiatan</small>
										<div class="pull-right"><?= round($grafik_capaian[$uk->id_skpd], 1) ?>% </div>
										<div class="progress">
											<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= round($grafik_capaian[$uk->id_skpd], 1) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($grafik_capaian[$uk->id_skpd], 1) ?>%;"> <span class="sr-only"><?= round($grafik_capaian[$uk->id_skpd], 1) ?>% Complete</span></div>
										</div>
										<a href="<?= base_url('pengukuran_kinerja/detail/' . $uk->id_skpd . '/' . $tahun_) ?>" target="_blank" class="button border pull-right">Detail</a>
									</div>
								</td>
								<?php if ($level < 4) { ?>
									<!-- <td style="text-align: center; ">
						<a href="<?= base_url() . 'pengukuran_kinerja/index/' . $tahun_ . '/' . $level_n . '/' . $uk->id_skpd . '' ?>"> <button class="button pull-right"><i class="sl sl-icon-layers"></i></button></a></td> -->
							</tr>
						<?php } ?>
					<?php $no++;
						} ?>
					</tbody>
				</table>
			</div>
			<!-- Switcher ON-OFF Content / End -->
		</div>
		<!-- Section / End -->
	</div>

</section>