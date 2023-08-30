<style type="text/css">
	.alert-default {
		border: solid 1px #6003c8;
		color: #6003c8;
		font-weight: 400;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ren. Kerja</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li class="active">Ren. Kerja</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="<?= base_url('renja_perencanaan/view/' . $id_skpd . '') ?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
			<a href="<?= base_url('renja_perencanaan/sasaran_inisiatif/' . $id_skpd . '/' . $tahun) ?>" target="blank" style="margin-bottom: 10px;margin-right:10px" class="btn btn-primary pull-right"><i class="ti-plus"></i> Tambah Sasaran Inisiatif</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="POST">
						<div class="col-md-3 b-r text-center">
							<strong style="color:#3F0090;">Sasaran Strategis</strong>
							<br>
							<br>
							<?php $total_capaian_kepala = 0;
							$count_total_capaian_kepala = 0; ?>
							<div id="grafik-kepala" data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
							<?php
							if ($is_renja_skpd_exist) {
							?>
								<a href="<?= base_url('renja_perencanaan/download_pk_renja/skpd/' . $id_skpd . '/' . $tahun) ?>" class="btn btn-primary m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
							<?php } else {
							?>
								<a href="javascript:void(0)" class="btn btn-default disabled m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
							<?php
							} ?>
						</div>
						<div class="col-md-9">
							<div class="panel-wrapper collapse in" aria-expanded="true">
								<div class="panel panel-primary">
									<div class="panel panel-heading">
										<span style="display: block;position: absolute;top:8px;font-weight: 300;font-size: 10px">SKPD</span>
										<?= $skpd->nama_skpd ?>
										<?php
										if ($is_renja_skpd_exist) {
										?>
											<a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahanSKPD(<?= $id_skpd ?>)"><i class="ti-pencil"></i> Buat PK Perubahan</a>
										<?php
										} else {

										?>
											<a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahanSKPD(<?= $id_skpd ?>)"><i class="ti-pencil-alt2"></i> Turunkan ke renja</a>
										<?php
										}
										?>
									</div>
									<div class="panel-body">
										<table class="table">
											<tr>
												<td style="width: 120px;">Nama Kepala </td>
												<td>:</td>
												<td> <?= $kepala_skpd->nama_lengkap ?><strong></strong>
											</tr>
											<tr>
												<td style="width: 120px;">Jumlah Staf</td>
												<td>:</td>
												<td> <?= $jumlah_pegawai ?> Org<strong></strong>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>

				<?php

				$empty = true;
				foreach ($jenis as $j => $v) {
					$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
					$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
					$sasaran = array_merge($sasaran, $sasaran_inisiatif);
					if (!empty($sasaran)) {
						$empty = false;
					}
				}
				if (!$empty) {
					foreach ($jenis as $j => $v) {
						$name = $this->renja_perencanaan_model->name($j);
						$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
						$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
						$sasaran = array_merge($sasaran, $sasaran_inisiatif);
						if (!empty($sasaran)) {
				?>
							<div class="row" style="position: relative;">
								<i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
								<div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
									<span style="font-weight: 450;text-transform: uppercase;"><?= $v ?></span>
								</div>
							</div>
							<?php
							$no = 1;
							foreach ($sasaran as $ks => $s) {
								$tSasaran = $name['tSasaran'];
								$cSasaran = $name['cSasaran'];
								$cSasaranInisiatif = $name['cSasaranInisiatif'];

								if (!empty($s->inisiatif)) {
									$iku = $this->renja_perencanaan_model->get_iku_inisiatif_skpd($j, $s->$cSasaranInisiatif, $tahun, $id_skpd);
								} else {
									$iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
								}
							?>
								<?php
								if (!empty($s->inisiatif)) {
								?>

									<div class="row" style="margin-top: 30px;background-color:#eee8f4;padding:10px;border-radius:3px">
										<p><span class="badge badge-warning" id="total-capaian-<?= $j ?>-<?= $ks ?>" style="min-width:50px">0</span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->nama_sasaran ?> <span class="label label-success">Inisiatif</span></p>
									<?php
								} else {
									?>
										<div class="row" style="margin-top: 30px">
											<p><span class="badge badge-warning" id="total-capaian-<?= $j ?>-<?= $ks ?>" style="min-width:50px">0</span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->$tSasaran ?> </p>
										<?php
									}
										?>

										<div class="table-responsive dragscroll">
											<table class="table color-table muted-table">
												<thead>
													<tr>
														<th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian Iku</th>
														<th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
														<th style="vertical-align: middle;text-align: center;">Indikator</th>
														<th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
														<th style="vertical-align: middle;text-align: center;width:76px">Target</th>
														<th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
														<th style="vertical-align: middle;text-align: center;width:100px">Anggaran</th>
														<th style="vertical-align: middle;text-align: center;width:82px">Polarisasi</th>
														<!-- <th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th> -->
														<th style="vertical-align: middle;text-align: center;width:70px">Jml Renaksi</th>
														<!-- <th style="vertical-align: middle;text-align: center">Jenis Casecading</th> -->
														<th style="vertical-align: middle;text-align: center;width:200px">Casecading ke</th>
														<th style="vertical-align: middle;text-align: center;width:130px">Renaksi</th>
														<th style="vertical-align: middle;text-align: center;width:130px">Opsi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$n = 1;
													$tIku = $name['tIku'];
													$cIku = $name['cIku'];
													$cIkuRenja = $name['cIkuRenja'];
													$taIkuRenja = $name['taIkuRenja'];
													$aIkuRenja = $name['aIkuRenja'];
													$rIkuRenja = $name['rIkuRenja'];
													$total_capaian = 0;
													foreach ($iku as $i) {
														$rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd);
														$total_rka[$i->$cIkuRenja] = 0;
														foreach ($rka as $r) {
															$total_rka[$i->$cIkuRenja] += $r->anggaran;
														}

														$uk = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
														$a_unit_kerja = array();
														foreach ($uk as $u) {
															$a_unit_kerja[] = $u->nama_unit_kerja;
														}
														$uk = implode(', ', $a_unit_kerja);
														if (strlen($uk) >= 100) {
															$uk = substr($uk, 0, 100) . " ...";
														}
														$target = $i->$taIkuRenja;
														$realisasi = $i->$rIkuRenja;

														$pola = $i->polorarisasi;

														// $capaian = get_capaian($target,$realisasi,$pola);
														$capaian = $i->capaian;
														$total_capaian += $capaian;

														$jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));


													?>
														<tr id="iku_<?= $i->$cIkuRenja ?>">
															<td><span class="badge badge-warning" style="min-width:50px"><?= $capaian ?></span></td>
															<td class="text-center"><?= $no ?>.<?= $n ?></td>
															<td><?= $i->$tIku ?></td>
															<td class="text-center"><?= $i->satuan ?></td>
															<td class="text-center"><?= $i->$taIkuRenja ?></td>
															<td class="text-center"><?= $i->$rIkuRenja ?></td>
															<td class="text-center"><?= number_format(round($total_rka[$i->$cIkuRenja])) ?></td>
															<td class="text-center"><?= $i->polorarisasi ?></td>
															<!-- <td><?= $i->bobot_tertimbang ?>%</td> -->
															<td class="text-center"><?= $jml_renaksi ?></td>
															<!-- <td><?= $i->jenis_casecading ?></td> -->
															<td><?= $uk ?></td>
															<td class="text-center">
																<?php
																if ($jml_renaksi > 0) {
																?>

																	<a href="<?php echo base_url('renja_perencanaan/detail_iku/' . $id_skpd . '/' . $j . '/' . $i->$cIkuRenja); ?>" class="btn btn-primary btn-outline btn-sm">Ubah Renaksi</a>
																<?php
																} else {
																?>
																	<a href="<?php echo base_url('renja_perencanaan/detail_iku/' . $id_skpd . '/' . $j . '/' . $i->$cIkuRenja); ?>" class="btn btn-primary btn-sm" style="color:white;">Tambah Renaksi</a>
																<?php } ?>
															</td>
															<td class="text-center"><a href="javascript:void(0)" class="btn btn-sm btn-primary btn-outline m-b-5" onclick="updateRealisasiRenja('<?= $i->$cIkuRenja ?>','<?= $j ?>','<?= $kepala_skpd->id_pegawai ?>')">Update Realisasi</a> <a style="background: #fff;" href="<?php echo base_url('renja_rka/detail/' . $id_skpd . '/' . $tahun . '#iku_' . $i->$cIkuRenja); ?>" class="btn btn-sm btn-info btn-outline m-b-5"> Detail RKA </a></td>
														</tr>
													<?php $n++;
													}
													$total_capaian = $total_capaian / count($iku);
													$total_capaian_kepala += $total_capaian;
													$count_total_capaian_kepala++; ?>
												</tbody>
											</table>
										</div>
										</div>
										<script type="text/javascript">
											document.getElementById("total-capaian-<?= $j ?>-<?= $ks ?>").innerHTML = "<?= round($total_capaian, 1) ?>";
										</script>
							<?php $no++;
							}
						}
					}
				} else {
							?>

							<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
						<?php
					} ?>
									</div>
			</div>
		</div>
		<script type="text/javascript">
			<?php
			if ($count_total_capaian_kepala > 0) {
				$capaian_kepala = $total_capaian_kepala / $count_total_capaian_kepala;
			} else {
				$capaian_kepala = 0;
			}

			?>
			document.getElementById("grafik-kepala").setAttribute("data-label", "<?= round($capaian_kepala, 1) ?>%");
			document.getElementById("grafik-kepala").classList.remove("css-bar-0");
			document.getElementById("grafik-kepala").classList.add("css-bar-<?= roundfive($capaian_kepala) ?>");
		</script>

		<?php

		if (empty($unit_kerja)) {
		?>
			<center>
				<i style="font-size: 80px;display: block" class="ti-briefcase"></i>
				<span style="display: block;margin-top: 20px;margin-bottom:20px;font-size: 15px;">Belum ada unit kerja pada SKPD ini.</span>
				<a href="<?= base_url('renja_perencanaan/view/' . $id_skpd) ?>" class="btn btn-primary"><i class="ti-back-left"></i> Kembali</a>
			</center>
			<?php
		} else {
			foreach ($unit_kerja as $u) {
				// echo $u->nama_unit_kerja;
				$kepala = $this->ref_skpd_model->get_kepala_unit_kerja($u->id_unit_kerja);
				$staff = $this->ref_skpd_model->get_staff_unit_kerja($u->id_unit_kerja);


				$is_renja_exist = false;
				foreach ($jenis as $key => $value) {
					$renja = $this->renja_perencanaan_model->get_renja_unit_kerja($key, $u->id_unit_kerja, $tahun);
					if (!empty($renja)) {
						$is_renja_exist = true;
						break;
					}
				}
			?>
				<div class="row" id="unit_kerja_<?= $u->id_unit_kerja ?>">
					<div class="col-md-12">
						<div class="white-box">
							<div class="row">
								<form method="POST">
									<div class="col-md-3 b-r text-center">
										<?php

										$empty = true;
										foreach ($jenis as $j => $v) {
											$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
											$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
											$sasaran = array_merge($sasaran, $sasaran_inisiatif);
											if (!empty($sasaran)) {
												$empty = false;
											}
										}
										if (!$empty) {
											$total_indeks = 0;
											$jumlah_jenis = 0;
											foreach ($jenis as $j => $v) {
												$name = $this->renja_perencanaan_model->name($j);
												$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
												$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
												$sasaran = array_merge($sasaran, $sasaran_inisiatif);
												if (!empty($sasaran)) {
										?>
													<?php
													$no = 1;
													foreach ($sasaran as $s) {
														$jumlah_jenis++;
														$tSasaran = $name['tSasaran'];
														$cSasaran = $name['cSasaran'];
														$cSasaranInisiatif = $name['cSasaranInisiatif'];
														if (!empty($s->inisiatif)) {
															$iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $u->id_unit_kerja);
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
														?>
														<?php
														$n = 1;
														$tIku = $name['tIku'];
														$cIku = $name['cIku'];
														$cIkuRenja = $name['cIkuRenja'];
														$taIkuRenja = $name['taIkuRenja'];
														$aIkuRenja = $name['aIkuRenja'];
														$rIkuRenja = $name['rIkuRenja'];
														foreach ($iku as $i) {
															$unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
															$a_unit_kerja = array();
															foreach ($unit_kerjaz as $uu) {
																$a_unit_kerja[] = $uu->nama_unit_kerja;
															}
															$unit_kerjaz = implode(', ', $a_unit_kerja);
															$target = $i->$taIkuRenja;
															$realisasi = $i->$rIkuRenja;
															$pola = $i->polorarisasi;

															$capaian = $i->capaian; //(?) get_capaian($target,$realisasi,$pola);
														?>

														<?php $n++;
														} ?>

														<!-- <strong style="color:#3F0090;"><?= $v ?></strong><br><br> -->
														<!-- <div data-label="<?= isset($tt_indeks_) ? $tt_indeks_ : 0; ?>%" class="css-bar css-bar-<?= isset($tt_indeks_) ? roundfive($tt_indeks_) : 0; ?> css-bar-lg"></div> -->
											<?php $no++;
													}
												}
											}
											?>
											<strong style="color:#3F0090;">Capaian Sasaran</strong><br><br>
											<?php
											$jumlah_indeks = $total_indeks / $jumlah_jenis;
											?>
											<div data-label="<?= isset($jumlah_indeks) ? round($jumlah_indeks, 1) : 0; ?>%" class="css-bar css-bar-<?= isset($jumlah_indeks) ? roundfive($jumlah_indeks) : 0; ?> css-bar-lg"></div>
										<?php
										} else {
										?>
											<div data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div>
										<?php
										} ?>


										<?php


										$empty = true;
										$disabled = true;
										foreach ($jenis as $j => $v) {
											$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
											$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
											$sasaran = array_merge($sasaran, $sasaran_inisiatif);
											if (!empty($sasaran)) {
												$empty = false;
											}

											$ikuz = $this->renja_perencanaan_model->get_casecade_sasaran_by_unit_kerja($j, $u->id_unit_kerja);
											if (!empty($ikuz)) {
												$disabled = false;
											}
										}
										?>
										<?php
										if ($empty) {
										?>
											<a href="javascript:void(0)" class="btn btn-default disabled m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
										<?php

										} else {
										?>
											<a href="<?= base_url('renja_perencanaan/download_pk_renja/unit_kerja/' . $id_skpd . '/' . $tahun . '/' . $u->id_unit_kerja) ?>" class="btn btn-primary m-1-5 btn-block "><i class="ti-cloud-down"></i> Download Perjanjian Kinerja</a>
										<?php } ?>
									</div>
									<div class="col-md-9">
										<div class="panel-wrapper collapse in" aria-expanded="true">
											<div class="panel panel-primary">
												<div class="panel panel-heading">
													<span style="display: block;position: absolute;top:8px;font-weight: 300;font-size: 10px">Unit Kerja</span>
													<?= $u->nama_unit_kerja ?>
													<?php
													if ($is_renja_exist) {
													?>
														<a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahan(<?= $u->id_unit_kerja ?>)"><i class="ti-pencil"></i> Buat PK Perubahan</a>
													<?php
													} else {
													?>
														<a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" <?= $disabled ? 'disabled' : 'onclick="buatPKPerubahan(' . $u->id_unit_kerja . ')"' ?>><i class="ti-pencil-alt2"></i> Turunkan ke Renja</a>
													<?php
													}
													?>
												</div>
												<div class="panel-body">
													<table class="table">
														<tr>
															<td style="width: 120px;">Nama Kepala </td>
															<td>:</td>
															<td> <?= $kepala->nama_lengkap ?><strong></strong>
														</tr>
														<tr>
															<td style="width: 120px;">Jumlah Staf</td>
															<td>:</td>
															<td> <?= count($staff) ?> Org<strong></strong>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<?php
							if (!$empty) {
								foreach ($jenis as $j => $v) {
									$name = $this->renja_perencanaan_model->name($j);
									$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
									$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
									$sasaran = array_merge($sasaran, $sasaran_inisiatif);
									if (!empty($sasaran)) {
							?>
										<div class="row" style="position: relative;">
											<i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
											<div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
												<span style="font-weight: 450;text-transform: uppercase;"><?= $v ?></span>
											</div>
										</div>
										<?php
										$no = 1;
										foreach ($sasaran as $s) {
											$tSasaran = $name['tSasaran'];
											$cSasaran = $name['cSasaran'];
											$cSasaranInisiatif = $name['cSasaranInisiatif'];
											if (!empty($s->inisiatif)) {
												$iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $u->id_unit_kerja);
											} else {
												$iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $u->id_unit_kerja);
											}
										?>

											<?php
											if (!empty($s->inisiatif)) {
											?>

												<div class="row" style="margin-top: 30px;background-color:#eee8f4;padding:10px;border-radius:3px">
													<p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?></span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->nama_sasaran ?> <span class="label label-success">Inisiatif</span></p>
												<?php
											} else {
												?>
													<div class="row" style="margin-top: 30px">
														<p><span class="badge badge-warning" style="min-width:50px"><?= $ts_indeks_[$tSasaran] ?></span>&nbsp;&nbsp;<strong>Sasaran <?= $no ?>.</strong> <?= $s->$tSasaran ?> </p>
													<?php
												}
													?>
													<div class="table-responsive dragscroll">
														<table class="table color-table muted-table">
															<thead>
																<tr>
																	<th style="vertical-align: middle;text-align: center;width:71px">Indeks Capaian Iku</th>
																	<th style="vertical-align: middle;text-align: center;width:50px">Kode</th>
																	<th style="vertical-align: middle;text-align: center;">Indikator</th>
																	<th style="vertical-align: middle;text-align: center;width:68px">Satuan</th>
																	<th style="vertical-align: middle;text-align: center;width:76px">Target</th>
																	<th style="vertical-align: middle;text-align: center;width:76px">Realisasi</th>
																	<th style="vertical-align: middle;text-align: center;width:100px">Anggaran</th>
																	<th style="vertical-align: middle;text-align: center;width:82px">Polarisasi</th>
																	<!-- <th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th> -->
																	<th style="vertical-align: middle;text-align: center;width:70px">Jml Renaksi</th>
																	<!-- <th style="vertical-align: middle;text-align: center">Jenis Casecading</th> -->
																	<th style="vertical-align: middle;text-align: center;width:200px">Casecading ke</th>
																	<th style="vertical-align: middle;text-align: center;width:130px">Renaksi</th>
																	<th style="vertical-align: middle;text-align: center;width:130px">Opsi</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$n = 1;
																$tIku = $name['tIku'];
																$cIku = $name['cIku'];
																$cIkuRenja = $name['cIkuRenja'];
																$taIkuRenja = $name['taIkuRenja'];
																$aIkuRenja = $name['aIkuRenja'];
																$rIkuRenja = $name['rIkuRenja'];
																foreach ($iku as $i) {
																	$rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd, $u->id_unit_kerja);
																	$total_rka[$i->$cIkuRenja] = 0;
																	foreach ($rka as $r) {
																		$total_rka[$i->$cIkuRenja] += $r->anggaran;
																	}

																	
															$unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
															$a_unit_kerja = array();
															foreach ($unit_kerjaz as $uu) {
																$a_unit_kerja[] = $uu->nama_unit_kerja;
															}
															$unit_kerjaz = implode(', ', $a_unit_kerja);
																	if (strlen($unit_kerjaz) >= 100) {
																		$unit_kerjaz = substr($unit_kerjaz, 0, 100) . " ...";
																	}
																	$target = $i->$taIkuRenja;
																	$realisasi = $i->$rIkuRenja;
																	$pola = $i->polorarisasi;

																	$jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));
																	// $capaian = get_capaian($target,$realisasi,$pola);
																	$capaian = $i->capaian;
																?>
																	<tr id="iku_<?= $i->$cIkuRenja ?>">
																		<td><span class="badge badge-warning" style="min-width:50px"><?= $capaian ?></span></td>
																		<td class="text-center"><?= $no ?>.<?= $n ?></td>
																		<td><?= $i->$tIku ?></td>
																		<td class="text-center"><?= $i->satuan ?></td>
																		<td class="text-center"><?= $i->$taIkuRenja ?></td>
																		<td class="text-center"><?= $i->$rIkuRenja ?></td>
																		<td class="text-center"><?= number_format(round($total_rka[$i->$cIkuRenja])) ?></td>
																		<td class="text-center"><?= $i->polorarisasi ?></td>
																		<!-- <td><?= $i->bobot_tertimbang ?>%</td> -->
																		<td class="text-center"><?= $jml_renaksi ?></td>
																		<!-- <td><?= $i->jenis_casecading ?></td> -->
																		<td><?= $unit_kerjaz ?></td>
																		<td class="text-center">

																			<?php
																			if ($jml_renaksi > 0) {
																			?>

																				<a href="<?php echo base_url('renja_perencanaan/detail_iku/' . $id_skpd . '/' . $j . '/' . $i->$cIkuRenja); ?>" class="btn btn-primary btn-outline btn-sm">Ubah Renaksi</a>
																			<?php
																			} else {
																			?>
																				<a href="<?php echo base_url('renja_perencanaan/detail_iku/' . $id_skpd . '/' . $j . '/' . $i->$cIkuRenja); ?>" class="btn btn-primary btn-sm" style="color:white;">Tambah Renaksi</a>
																			<?php } ?>
																		</td>
																		<td class="text-center"><a href="javascript:void(0)" class="btn btn-sm btn-primary btn-outline m-b-5" onclick="updateRealisasiRenja('<?= $i->$cIkuRenja ?>','<?= $j ?>','<?= isset($kepala->id_pegawai) ? $kepala->id_pegawai : 0 ?>')">Update Realisasi</a> <a style="background: #fff;" href="<?php echo base_url('renja_rka/detail/' . $id_skpd . '/' . $tahun . '#iku_' . $i->$cIkuRenja); ?>" class="btn btn-sm btn-info btn-outline m-b-5"> Detail RKA </a></td>
																	</tr>
																<?php $n++;
																} ?>
															</tbody>
														</table>
													</div>
													</div>
										<?php $no++;
										}
									}
								}
							} else {
										?>

										<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
									<?php
								} ?>
												</div>
						</div>
					</div>
			<?php }
		} ?>
			<!--Update Realisasi Renja-->
			<div id="updateRealisasiRenja" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Update Realisasi Renja</h4>
							</div>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" method="POST">
								<input type="hidden" name="jenis" id="jenis">
								<input type="hidden" name="id_iku" id="id_iku">
								<input type="hidden" name="id_pegawai" id="id_pegawai">
								<div class="form-group">
									<label class="col-sm-12">Realisasi</label>
									<div class="col-md-12">
										<input type="text" name="realisasi" id="realisasi_renja" class="form-control" placeholder="Masukkan Realisasi Renja">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-12">
										<input type="checkbox" id="rPerhitungan" name="perhitungan_capaian_renja" value="manual" checked class="js-switch" onchange="toggleCapaian()" data-color="#6003c8" data-size="small" /> Hitung Capaian Manual
										<small style="display: block;margin-top:5px">Aktifkan Capaian Manual apabila realisasi <b>bukan</b> angka. (misal. A, Baik, dll)</small>
									</div>
								</div>
								<div class="form-group" id="formCapaian" style="display: none;">
									<label class="col-sm-12">Capaian</label>
									<div class="col-md-12">
										<input type="text" id="txtCapaian" class="form-control" name="capaian">
									</div>
								</div>




						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
							<button type="submit" name="update_realisasi" class="btn btn-primary waves-effect text-left">Simpan</button>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!--Update Realisasi Renja-->
			<div id="buatPKPerubahan" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Buat PK Perubahan</h4>
							</div>
						</div>
						<div class="modal-body">
							<form method="POST" id="formPKPerubahan" class="form-horizontal">
								<div id="tablePerubahanPK">
									Belum ada sasaran
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
						</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>

			<div id="modalSasaranInisiatif" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Tambah Sasaran Inisiatif</h4>
							</div>
						</div>
						<div class="modal-body" style="padding:10px 25px">
							<form method="POST" id="formSasaranInisiatif" class="form-horizontal">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary waves-effect text-left">Simpan</button>
						</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>

			<script type="text/javascript">
				function buatPKPerubahan(id_unit_kerja) {
					// $('#formReviu')[0].reset();
					$('#buatPKPerubahan').modal('show');
					$('#tablePerubahanPK').html("<center><i class='fa fa-circle-o-notch fa-spin'></i> Mengambil Data ...</center>");
					$.ajax({
						url: "<?= base_url(); ?>renja_perencanaan/get_iku_sasaran_by_unit_kerja/" + id_unit_kerja + "/<?= $tahun ?>",
						type: "GET",
						// dataType: "JSON",
						success: function(data) {
							if (data != '') {
								$('#tablePerubahanPK').html(data);
							} else {
								$('#tablePerubahanPK').html('<div class="alert alert-primary"><i class="ti-alert"></i> Belum ada sasaran untuk Unit Kerja ini</div>');
							}

						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert("Gagal mendapatkan data");
						}
					});
				}

				function buatPKPerubahanSKPD(id_skpd) {
					// $('#formReviu')[0].reset();
					$('#buatPKPerubahan').modal('show');
					$('#tablePerubahanPK').html("<center><i class='fa fa-circle-o-notch fa-spin'></i> Mengambil Data ...</center>");
					$.ajax({
						url: "<?= base_url(); ?>renja_perencanaan/get_iku_sasaran_by_skpd/" + id_skpd + "/<?= $tahun ?>",
						type: "GET",
						// dataType: "JSON",
						success: function(data) {
							if (data != '') {
								$('#tablePerubahanPK').html(data);
							} else {
								$('#tablePerubahanPK').html('<div class="alert alert-primary"><i class="ti-alert"></i> Belum ada sasaran untuk SKPD ini</div>');
							}

						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert("Gagal mendapatkan data");
						}
					});
				}

				function updateRealisasiRenja(id_iku, jenis, id_pegawai) {
					if (id_pegawai == 0) {
						alert('Kepala SKPD/Unit Kerja tidak ditemukan');
					} else {
						$('#jenis').val('');
						$('#id_iku').val('');
						$.getJSON("<?= base_url('renja_perencanaan/get_iku_renja/') ?>/" + jenis + "/" + id_iku, function(data) {
							$('#jenis').val(jenis);
							$('#id_iku').val(id_iku);
							$('#id_pegawai').val(id_pegawai);
							$('#realisasi_renja').val(data.realisasi);
							if (data.perhitungan_capaian_renja == 'manual') {
								$('#rPerhitungan').prop('checked', false);
								$('#rPerhitungan').next().trigger('click');
								$('#formCapaian').show();
							} else {
								$('#rPerhitungan').prop('checked', true);
								$('#rPerhitungan').next().trigger('click');
								$('#formCapaian').hide();
							}

							$('#txtCapaian').val(data.capaian);
							$('#updateRealisasiRenja').modal('show');
						});
					}
				}

				function checkAll() {
					var parent = $('input:checkbox.checkall').prop('checked');
					$('.child').prop('checked', parent);
				}

				function cekParent(id) {
					if ($('input:checkbox.checkall').prop('checked') == true) {
						$('.child').each(function(i, obj) {
							if ($(this).prop('checked') == false) {
								$('input:checkbox.checkall').prop('checked', false);
							}
						});
					} else {
						var check_all = true;
						$('.child').each(function(i, obj) {
							if ($(this).prop('checked') == false) {
								check_all = false;
								return false;
							}
						});
						$('input:checkbox.checkall').prop('checked', check_all);
					}

					var cb = $('#cb_' + id).prop('checked');
					if (cb == true) {
						$('#target_' + id).removeAttr('disabled');
						$('#anggaran_' + id).removeAttr('disabled');
					} else {
						$('#target_' + id).attr('disabled', true);
						$('#anggaran_' + id).attr('disabled', true);
					}
				}
				<?php
				if (isset($_GET['jumpto'])) {
				?>
					document.getElementById('unit_kerja_<?= $_GET['jumpto'] ?>').scrollIntoView();
					window.history.replaceState({}, document.title, "/" + "renja_perencanaan/detail/<?= $this->uri->segment(3) ?>/<?= $this->uri->segment(4) ?>");
				<?php
				}
				?>

				function toggleCapaian() {
					$('#formCapaian').toggle();
				}

				function addSasaranInisiatif() {
					$('#modalSasaranInisiatif').modal('show');
				}
			</script>