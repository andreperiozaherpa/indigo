<style type="text/css">
	.alert-default{
		border: solid 1px #6003c8;
		color: #6003c8;
		font-weight: 400;
	}
</style>
    <script>
    	$(document).ready(function () {
      // create a tree
      $("#tree-data").jOrgChart({
      	chartElement: $("#tree-view"), 
      	nodeClicked: nodeClicked
      });
      
      // lighting a node in the selection
      function nodeClicked(node, type) {
      	node = node || $(this);
      	$('.jOrgChart .selected').removeClass('selected');
      	node.addClass('selected');
      }
  });
</script>


<div class="container-fluid">

	<div class="row bg-title">
		<!-- .page title -->
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Perencanaan</h4>
		</div>
		<!-- /.page title -->
		<!-- .breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
				<li class="active">Laporan Perencanaan</li>
			</ol>
		</div>
		<!-- /.breadcrumb -->
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="GET">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">SKPD</label>
								<select name="id_skpd" class="form-control select2" required>
									<?php if ($this->session->userdata('level') == "Administrator"): ?>
									<option value="">Pilih SKPD</option>
									<?php endif ?>
									<?php 
									foreach($ref_skpd as $s){
										$selected = ($s->id_skpd == $_GET['id_skpd']) ? "selected" : "" ;
										if ($this->session->userdata('level') == "Administrator") {
											echo '<option value="'.$s->id_skpd.'" '.$selected.'>'.$s->nama_skpd.'</option>';
										} elseif ($this->session->userdata('id_skpd') == $s->id_skpd) {
											echo '<option value="'.$s->id_skpd.'" '.$selected.'>'.$s->nama_skpd.'</option>';
										}
										
									}
									?>
								</select>				
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">Tahun</label>
								<select name="tahun" class="form-control" required>
									<?php 

									for($ref_tahun=2019;$ref_tahun<=2023;$ref_tahun++){
										$selected = ($ref_tahun == $_GET['tahun']) ? "selected" : "" ;
										echo'<option value="'.$ref_tahun.'" '.$selected.'>'.$ref_tahun.'</option>';
									}
									?>
								</select>				
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">

								<br>
								<button type="submit" class="btn btn-primary m-t-5">Filter</button>
								<a href="<?=base_url('laporan/cetak_perencanaan')?>" class="btn btn-danger m-t-5 pull-right disabled"><i class="fa fa-print"></i> Cetak Laporan (Ujicoba) </a>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>

	</div>
	
<!-- <div id="pohon">
  <p>
  tes
  </p>
  <p>
  oke ya
  </p>
</div> -->
	<?php 
	if($_GET){
		?>
	<?php $total_capaian_kepala = 0; $count_total_capaian_kepala = 0; ?>
	<!-- sample modal content -->
	<div id="detail-kepala" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="border-color: #3e4d6c;;background-color: #3e4d6c">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myLargeModalLabel" style="color:#ffffff">Indikator Kinerja Utama</h4>
				</div>
				<div class="modal-body">


					<div class="row">
						<div class="col-md-4">
							<div class="add-listing-section margin-top-45">
								<!-- Headline -->
								<div class="white-box">
									<div class="row">
										<center> 
											<div class="square-box margin-top-45">
												<div class="square-content"><div id="grafik-kepala" data-label="0%" class="css-bar css-bar-0 css-bar-lg css-bar-danger"></div></div>
											</div>
											<hr>
											<h4 class="box-title"><?=$skpd->nama_skpd?></h4>
										</center> 
									</div>
								</div>
							</div> 
						</div>
						<div class="col-md-8">
							<div class="add-listing-section margin-top-45">
								<!-- Headline -->

								<div class="white-box">
									<div class="panel panel-inverse">
										<div class="panel-heading"> <?=$skpd->nama_skpd?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
									</div>
									<div class="panel-wrapper collapse in" aria-expanded="true">
										<div class="panel-body">
											<table class="table">
												<tbody><tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala_skpd->nama_lengkap?></strong></td></tr>
													<tr><td>Jumlah Pegawai </td><td>:</td><td> <strong><?=$jumlah_pegawai?> Orang</strong></td></tr>

												</tbody></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="white-box">
									<?php

									$empty = true;
									foreach($jenis as $j => $v){
										$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j,$id_skpd,$tahun);
										if(!empty($sasaran)){
											$empty = false;
										}
									}
									if(!$empty){
										foreach($jenis as $j => $v){
											$name = $this->renja_perencanaan_model->name($j);
											$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j,$id_skpd,$tahun);
											if(!empty($sasaran)){
												?>

												<div class="row" style="position: relative;margin-top: 30px;">
													<i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
													<div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
														<span style="font-weight: 450;text-transform: uppercase;"><?=$v?></span>
													</div>
												</div>
												<?php
												$no=1;
												foreach($sasaran as $ks => $s){
													$tSasaran = $name['tSasaran'];
													$cSasaran = $name['cSasaran'];
													$iku = $this->renja_perencanaan_model->get_iku_skpd($j,$s->$cSasaran,$tahun,$id_skpd);
													?>
													<div class="row" style="margin-top: 30px">
														<p><span class="badge badge-warning" id="total-capaian-<?=$j?>-<?=$ks?>" style="min-width:50px">0</span>&nbsp;&nbsp;<strong>Sasaran <?=$no?>.</strong> <?=$s->$tSasaran?> </p>
														<div class="table-responsive dragscroll">
															<table class="table color-table muted-table">
																<thead>
																	<tr>
																		<th style="vertical-align: middle;text-align: center">Indeks Capaian Iku</th>
																		<th style="vertical-align: middle;text-align: center">Kode</th>
																		<th style="vertical-align: middle;text-align: center">Indikator</th>
																		<th style="vertical-align: middle;text-align: center">Satuan</th>
																		<th style="vertical-align: middle;text-align: center">Target</th>
																		<th style="vertical-align: middle;text-align: center">Realisasi</th>
																		<th style="vertical-align: middle;text-align: center">Anggaran</th>
																		<th style="vertical-align: middle;text-align: center">Polarisasi</th>
																		<th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th>
																		<th style="vertical-align: middle;text-align: center">Jml Renaksi</th>
																		<th style="vertical-align: middle;text-align: center">Jenis Casecading</th>
																		<th style="vertical-align: middle;text-align: center">Casecading ke</th>
																		<th style="vertical-align: middle;text-align: center">Opsi</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$n=1;
																	$tIku = $name['tIku'];
																	$cIku = $name['cIku'];
																	$cIkuRenja = $name['cIkuRenja'];
																	$taIkuRenja = $name['taIkuRenja'];
																	$aIkuRenja = $name['aIkuRenja'];
																	$rIkuRenja = $name['rIkuRenja'];
																	$total_capaian = 0;
																	foreach($iku as $i){
																		$rka = $this->renja_rka_model->get_rka($j,$i->$cIkuRenja,$tahun,$id_skpd);
																		$total_rka[$i->$cIkuRenja] = 0;
																		foreach ($rka as $r) {
																			$total_rka[$i->$cIkuRenja] += $r->anggaran;
																		}

																		$uk = $this->renstra_realisasi_model->get_unit_iku($j,$i->$cIku);
																		$a_unit_kerja = array();
																		foreach($uk as $u){
																			$a_unit_kerja[] = $u->nama_unit_kerja;
																		}
																		$uk = implode(', ', $a_unit_kerja);
																		$target = $i->$taIkuRenja;
																		$realisasi = $i->$rIkuRenja;
																		$pola = $i->polorarisasi;

																		$capaian = $i->capaian;//get_capaian($target,$realisasi,$pola);
																		$total_capaian += $capaian;
																		?>
																		<tr>
																			<td><span class="badge badge-warning" style="min-width:50px"><?=$capaian?></span></td>
																			<td><?=$no?>.<?=$n?></td>
																			<td><a href="<?php echo base_url('renaksi/detail/'.$j.'/'.$i->$cIkuRenja.'/'.$_GET['id_skpd'].'/'.$_GET['tahun']);?>" target="_blank"><?=$i->$tIku?></a></td>
																			<td><?=$i->satuan?></td>
																			<td><?=$i->$taIkuRenja?></td>
																			<td><?=$i->$rIkuRenja?></td>
																			<td><?=number_format(round($total_rka[$i->$cIkuRenja]))?></td>
																			<td><?=$i->polorarisasi?></td>
																			<td><?=$i->bobot_tertimbang?>%</td>
																			<td>2</td>
																			<td><?=$i->jenis_casecading?></td>
																			<td><?=$uk?></td>
																			<td><a href="<?php echo base_url('renaksi/detail/'.$j.'/'.$i->$cIkuRenja.'/'.$_GET['id_skpd'].'/'.$_GET['tahun']);?>" target="_blank" class="btn btn-outline btn-primary"> Detail </a></td>
																		</tr>
																		<?php $n++; } $total_capaian = $total_capaian/count($iku); $total_capaian_kepala += $total_capaian; $count_total_capaian_kepala++; ?>
																	</tbody>
																</table>
															</div>
														</div>
														<script type="text/javascript">
															document.getElementById("total-capaian-<?=$j?>-<?=$ks?>").innerHTML = "<?=round($total_capaian,1)?>";
														</script>
														<?php $no++; } } } }else{
															?>

															<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
															<?php
														} ?>


											<script type="text/javascript">
												<?php 
												if($count_total_capaian_kepala>0){
													$capaian_kepala = $total_capaian_kepala/$count_total_capaian_kepala;
												}else{
													$capaian_kepala = 0;
												}

												?>
												document.getElementById("grafik-kepala").setAttribute("data-label","<?=round($capaian_kepala,1)?>%");
												document.getElementById("grafik-kepala").classList.remove("css-bar-0");
												document.getElementById("grafik-kepala").classList.add("css-bar-<?=roundfive($capaian_kepala)?>");
											</script>

								</div>
							</div>
						</div>
						<!-- Section / End -->
					</div>

				</div>
				<div class="modal-footer">
					<!-- <a href="<?php echo base_url(). "laporan/detail_unitkerja/" ;?>"><button type="button" class="btn btn-default waves-effect text-left">Detail Unitkerja</button></a> -->
					<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<?php
	$results = array();
	$results = array_merge($results, $unit_kerja);
	foreach ($unit_kerja as $u) {
		$kepala[$u->id_unit_kerja] = $this->ref_skpd_model->get_kepala_unit_kerja($u->id_unit_kerja);
		$staff[$u->id_unit_kerja] = $this->ref_skpd_model->get_staff_unit_kerja($u->id_unit_kerja);

		$unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u->id_unit_kerja);
		$results = array_merge($results, $unit_kerja_2);

		foreach ($unit_kerja_2 as $u2) {
			$kepala[$u2->id_unit_kerja] = $this->ref_skpd_model->get_kepala_unit_kerja($u2->id_unit_kerja);
			$staff[$u2->id_unit_kerja] = $this->ref_skpd_model->get_staff_unit_kerja($u2->id_unit_kerja);

			$unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u2->id_unit_kerja);
			$results = array_merge($results, $unit_kerja_3);

			foreach($unit_kerja_3 as $u3){
				$kepala[$u3->id_unit_kerja] = $this->ref_skpd_model->get_kepala_unit_kerja($u3->id_unit_kerja);
				$staff[$u3->id_unit_kerja] = $this->ref_skpd_model->get_staff_unit_kerja($u3->id_unit_kerja);

				$unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u3->id_unit_kerja);
				$results = array_merge($results, $unit_kerja_4);

				foreach($unit_kerja_4 as $u4){
					$kepala[$u4->id_unit_kerja] = $this->ref_skpd_model->get_kepala_unit_kerja($u4->id_unit_kerja);
					$staff[$u4->id_unit_kerja] = $this->ref_skpd_model->get_staff_unit_kerja($u4->id_unit_kerja);
				}
			}
		}
	}
	?>

	<?php foreach ($results as $ress): ?>
	<?php $tt_indeks_ = 0; ?>
	<!-- sample modal content -->
	<div id="detail-unitkerja-<?=$ress->id_unit_kerja?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="border-color: #3e4d6c;;background-color: #3e4d6c">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myLargeModalLabel" style="color:#ffffff">Indikator Kinerja Utama</h4>
				</div>
				<div class="modal-body">


					<div class="row">
						<div class="col-md-4">
							<div class="add-listing-section margin-top-45">
								<!-- Headline -->
								<div class="white-box">
									<div class="row">
										<center> 
											<div class="square-box margin-top-45">
												<div class="square-content"><div id="grafik-unitkerja-<?=$ress->id_unit_kerja?>" data-label="0%" class="css-bar css-bar-0 css-bar-lg css-bar-danger"></div></div>
											</div>
											<hr>
											<h4 class="box-title"><?=$ress->nama_unit_kerja?></h4>
										</center> 
									</div>
								</div>
							</div> 
						</div>
						<div class="col-md-8">
							<div class="add-listing-section margin-top-45">
								<!-- Headline -->

								<div class="white-box">
									<div class="panel panel-inverse">
										<div class="panel-heading"> <?=$ress->nama_unit_kerja?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
									</div>
									<div class="panel-wrapper collapse in" aria-expanded="true">
										<div class="panel-body">
											<table class="table">
												<tbody><tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$kepala[$ress->id_unit_kerja]->nama_lengkap?></strong></td></tr>
													<tr><td>Jumlah Staff </td><td>:</td><td> <strong><?=count($staff[$ress->id_unit_kerja])?> Orang</strong></td></tr>

												</tbody></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="white-box">
									<?php

									$empty = true;
									foreach($jenis as $j => $v){
										$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$ress->id_unit_kerja,$tahun);
										if(!empty($sasaran)){
											$empty = false;
										}
									}
									$total_indeks = 0;
									$jumlah_jenis = 0;
									if(!$empty){
										foreach($jenis as $j => $v){
											$name = $this->renja_perencanaan_model->name($j);
											$sasaran = $this->renja_perencanaan_model->get_sasaran($j,$ress->id_unit_kerja,$tahun);
											if(!empty($sasaran)){
												?>
												<div class="row" style="position: relative;margin-top: 30px;">
													<i style="position:absolute;display:inline-block;font-size:15px;color:#fff;background-color:#6003c8;padding:17px;border-radius: 50% 0px 0px 50%;line-height: 18px" class="ti-target"></i>
													<div style="margin-left:48px;display:inline-block;border: solid 1px #E4E7EA;padding: 15px;width: 90%">
														<span style="font-weight: 450;text-transform: uppercase;"><?=$v?></span>
													</div>
												</div>
												<?php
												$no=1;
												foreach($sasaran as $s){
													$tSasaran = $name['tSasaran'];
													$cSasaran = $name['cSasaran'];

													$jumlah_jenis ++;

													$iku = $this->renja_perencanaan_model->get_iku($j,$s->$cSasaran,$tahun,$ress->id_unit_kerja);
													$capaian = array();
													foreach ($iku as $i):
														$tIku = $name['tIku'];
														$cIku = $name['cIku'];
														$cIkuRenja = $name['cIkuRenja'];
														$taIkuRenja = $name['taIkuRenja'];
														$aIkuRenja = $name['aIkuRenja'];
														$rIkuRenja = $name['rIkuRenja'];
														$target = $i->$taIkuRenja;
														$realisasi = $i->$rIkuRenja;
														$pola = $i->polorarisasi;
														$capaian[] = $i->capaian;//get_capaian($target,$realisasi,$pola);
													endforeach;

													$t_iku = count($iku)*100;
													if($t_iku==0) $t_iku = 1;
													$t_hasil = array_sum($capaian);
													$t_indeks = ($t_hasil/$t_iku)*100;
													$t_indeks_ =  number_format($t_indeks, 1);
													$t_sasaran = count($s)*100;
													$tt_indeks_ = ($t_indeks_/$t_sasaran)*100;
													$total_indeks += $tt_indeks_;
													?>
													<div class="row" style="margin-top: 30px">
														<p><span class="badge badge-warning" style="min-width:50px"><?=$t_indeks_?></span>&nbsp&nbsp<strong>Sasaran <?=$no?>.</strong> <?=$s->$tSasaran?> </p>
														<div class="table-responsive dragscroll">
															<table class="table color-table muted-table">
																<thead>
																	<tr>
																		<th style="vertical-align: middle;text-align: center">Indeks Capaian Iku</th>
																		<th style="vertical-align: middle;text-align: center">Kode</th>
																		<th style="vertical-align: middle;text-align: center">Indikator</th>
																		<th style="vertical-align: middle;text-align: center">Satuan</th>
																		<th style="vertical-align: middle;text-align: center">Target</th>
																		<th style="vertical-align: middle;text-align: center">Realisasi</th>
																		<th style="vertical-align: middle;text-align: center">Anggaran</th>
																		<th style="vertical-align: middle;text-align: center">Polarisasi</th>
																		<th style="vertical-align: middle;text-align: center">Bobot Tertimbang</th>
																		<th style="vertical-align: middle;text-align: center">Jml Renaksi</th>
																		<th style="vertical-align: middle;text-align: center">Jenis Casecading</th>
																		<th style="vertical-align: middle;text-align: center">Casecading ke</th>
																		<th style="vertical-align: middle;text-align: center">Opsi</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$n=1;
																	$tIku = $name['tIku'];
																	$cIku = $name['cIku'];
																	$cIkuRenja = $name['cIkuRenja'];
																	$taIkuRenja = $name['taIkuRenja'];
																	$aIkuRenja = $name['aIkuRenja'];
																	$rIkuRenja = $name['rIkuRenja'];
																	foreach($iku as $i){
																		$rka = $this->renja_rka_model->get_rka($j,$i->$cIkuRenja,$tahun,$id_skpd);
																		$total_rka[$i->$cIkuRenja] = 0;
																		foreach ($rka as $r) {
																			$total_rka[$i->$cIkuRenja] += $r->anggaran;
																		}

																		$unit_kerja_modal = $this->renstra_realisasi_model->get_unit_iku($j,$i->$cIku);
																		$a_unit_kerja = array();
																		foreach($unit_kerja_modal as $u_m){
																			$a_unit_kerja[] = $u_m->nama_unit_kerja;
																		}
																		$unit_kerja_modal = implode(', ', $a_unit_kerja);
																		$target = $i->$taIkuRenja;
																		$realisasi = $i->$rIkuRenja;
																		$pola = $i->polorarisasi;

																		$capaian = $i->capaian;//get_capaian($target,$realisasi,$pola);
																		?>
																		
																		<tr>
																			<td><span class="badge badge-warning" style="min-width:50px"><?=$capaian?></span></td>
																			<td><?=$no?>.<?=$n?></td>
																			<td><a href="<?php echo base_url('renaksi/detail/'.$j.'/'.$i->$cIkuRenja.'/'.$_GET['id_skpd'].'/'.$_GET['tahun']);?>" target="_blank"><?=$i->$tIku?></a></td>
																			<td><?=$i->satuan?></td>
																			<td><?=$i->$taIkuRenja?></td>
																			<td><?=$i->$rIkuRenja?></td>
																			<td><?=number_format(round($total_rka[$i->$cIkuRenja]))?></td>
																			<td><?=$i->polorarisasi?></td>
																			<td><?=$i->bobot_tertimbang?>%</td>
																			<td>2</td>
																			<td><?=$i->jenis_casecading?></td>
																			<td><?=$unit_kerja_modal?></td>
																			<td><a href="<?php echo base_url('renaksi/detail/'.$j.'/'.$i->$cIkuRenja.'/'.$_GET['id_skpd'].'/'.$_GET['tahun']);?>" target="_blank" class="btn btn-outline btn-primary"> Detail </a></td>
																		</tr>
																		<?php $n++; } ?>
																	</tbody>
																</table>
															</div>
														</div>
														<?php $no++; } } } }else{
															?>

															<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
															<?php
														} ?>

											<script type="text/javascript">
												<?php 
												// if($count_total_capaian_kepala>0){
												// 	$capaian_kepala = $total_capaian_kepala/$count_total_capaian_kepala;
												// }else{
												// 	$capaian_kepala = 0;
												// }
												$capaian_unit_kerja[$ress->id_unit_kerja] = $total_indeks / $jumlah_jenis;

												?>
												document.getElementById("grafik-unitkerja-<?=$ress->id_unit_kerja?>").setAttribute("data-label","<?=round($capaian_unit_kerja[$ress->id_unit_kerja],1)?>%");
												document.getElementById("grafik-unitkerja-<?=$ress->id_unit_kerja?>").classList.remove("css-bar-0");
												document.getElementById("grafik-unitkerja-<?=$ress->id_unit_kerja?>").classList.add("css-bar-<?=roundfive($capaian_unit_kerja[$ress->id_unit_kerja])?>");
											</script>
								</div>
							</div>
						</div>
						<!-- Section / End -->
					</div>

				</div>
				<div class="modal-footer">
					<!-- <a href="<?php echo base_url(). "laporan/detail_unitkerja/" ;?>"><button type="button" class="btn btn-default waves-effect text-left">Detail Unitkerja</button></a> -->
					<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<?php endforeach ?>

	<!-- .row -->
	<div class="row dragscroll" style="overflow: auto;">	
		<div class="col-md-12">
			<div class="container">

			<?php 
			if(count($unit_kerja)>=1){
				?>

				<ul id="tree-data" style="display:none">
					<li id="root">

						<!-- unit kerja  -->
						<div class="white-box">
							<div class="row">
								<div class="col-md-4 col-sm-4 text-center">
									<a href="#" data-toggle="modal" data-target="#detail-kepala">
										<div data-label="<?=round($capaian_kepala,1)?>%" class="css-bar css-bar-<?=roundfive($capaian_kepala)?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
									</a>
								</div>
								<div class="col-md-8 col-sm-8">
									<h3 class="box-title m-b-0"><?=$detail->nama_skpd?></h3>
									<h4><span class="label label-danger m-l-5"><?=round($capaian_kepala,1)?>%</span> Capaian Kinerja</h4>
								</div>
							</div>
						</div>
						<!-- end unitkerja -->
						<ul>
							<!--- Level 1 -->
							<!-- Misi 1 -->
							<?php foreach($unit_kerja as $u){?>
							<li>
								<!-- unit kerja  -->
								<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center">
											<a href="#" data-toggle="modal" data-target="#detail-unitkerja-<?=$u->id_unit_kerja?>">
												<div data-label="<?=round($capaian_unit_kerja[$u->id_unit_kerja],1)?>%" class="css-bar css-bar-<?=roundfive($capaian_unit_kerja[$u->id_unit_kerja])?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
											</a>
										</div>
										<div class="col-md-8 col-sm-8">
											<h3 class="box-title m-b-0"><?=$u->nama_unit_kerja?></h3>
											<h4><span class="label label-danger m-l-5"><?=round($capaian_unit_kerja[$u->id_unit_kerja],1)?>%</span> Capaian Kinerja</h4>
										</div>
									</div>
								</div>

								<?php  
								$unit_kerja_2 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u->id_unit_kerja);
								?>
								<?php if(count($unit_kerja_2)!==0){?>
								<ul>
									<!--- Level 1 -->
									<!-- Misi 1 -->
									<?php foreach($unit_kerja_2 as $u2){?>
									<li>
										<!-- unit kerja  -->
										<div class="white-box">
											<div class="row">
												<div class="col-md-4 col-sm-4 text-center">
													<a href="#" data-toggle="modal" data-target="#detail-unitkerja-<?=$u2->id_unit_kerja?>">
														<div data-label="<?=round($capaian_unit_kerja[$u2->id_unit_kerja],1)?>%" class="css-bar css-bar-<?=roundfive($capaian_unit_kerja[$u2->id_unit_kerja])?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
													</a>
												</div>
												<div class="col-md-8 col-sm-8">
													<h3 class="box-title m-b-0"><?=$u2->nama_unit_kerja?></h3>
													<h4><span class="label label-danger m-l-5"><?=round($capaian_unit_kerja[$u2->id_unit_kerja],1)?>%</span> Capaian Kinerja</h4>
												</div>
											</div>
										</div>

										<?php  
										$unit_kerja_3 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u2->id_unit_kerja);
										?>
										<?php if(count($unit_kerja_3)!==0){?>
										<ul>
											<!--- Level 1 -->
											<!-- Misi 1 -->
											<?php foreach($unit_kerja_3 as $u3){?>
											<li>
												<!-- unit kerja  -->
												<div class="white-box">
													<div class="row">
														<div class="col-md-4 col-sm-4 text-center">
															<a href="#" data-toggle="modal" data-target="#detail-unitkerja-<?=$u3->id_unit_kerja?>">
																<div data-label="<?=round($capaian_unit_kerja[$u3->id_unit_kerja],1)?>%" class="css-bar css-bar-<?=roundfive($capaian_unit_kerja[$u3->id_unit_kerja])?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
															</a>
														</div>
														<div class="col-md-8 col-sm-8">
															<h3 class="box-title m-b-0"><?=$u3->nama_unit_kerja?></h3>
															<h4><span class="label label-danger m-l-5"><?=round($capaian_unit_kerja[$u3->id_unit_kerja],1)?>%</span> Capaian Kinerja</h4>
														</div>
													</div>
												</div>

												<?php  
												$unit_kerja_4 = $this->ref_skpd_model->get_unit_kerja_by_id_induk($detail->id_skpd,$u3->id_unit_kerja);
												?>
												<?php if(count($unit_kerja_4)!==0){?>
												<ul>
													<!--- Level 1 -->
													<!-- Misi 1 -->
													<?php foreach($unit_kerja_4 as $u4){?>
													<li>
														<!-- unit kerja  -->
														<div class="white-box">
															<div class="row">
																<div class="col-md-4 col-sm-4 text-center">
																	<a href="#" data-toggle="modal" data-target="#detail-unitkerja-<?=$u4->id_unit_kerja?>">
																		<div data-label="<?=round($capaian_unit_kerja[$u4->id_unit_kerja],1)?>%" class="css-bar css-bar-<?=roundfive($capaian_unit_kerja[$u4->id_unit_kerja])?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
																	</a>
																</div>
																<div class="col-md-8 col-sm-8">
																	<h3 class="box-title m-b-0"><?=$u4->nama_unit_kerja?></h3>
																	<h4><span class="label label-danger m-l-5"><?=round($capaian_unit_kerja[$u4->id_unit_kerja],1)?>%</span> Capaian Kinerja</h4>
																</div>
															</div>
														</div>

														<!-- end unitkerja -->
													</li>
													<?php } ?>

												</ul>
												<?php } ?>

												<!-- end unitkerja -->
											</li>
											<?php } ?>

										</ul>
										<?php } ?>

										<!-- end unitkerja -->
									</li>
									<?php } ?>

								</ul>
								<?php } ?>

								<!-- end unitkerja -->
							</li>
							<?php } ?>

						</ul>

					</li>

				</ul>

			<?php } ?>

			<div id="tree-view"></div>    

			<!-- sample modal content -->
			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header" style="border-color: #3e4d6c;;background-color: #3e4d6c">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myLargeModalLabel" style="color:#ffffff">Indikator Kinerja Utama</h4>
						</div>
						<div class="modal-body">


							<div class="row">
								<div class="col-md-4">
									<div class="add-listing-section margin-top-45">
										<!-- Headline -->
										<div class="white-box">
											<div class="row">
												<center> 
													<div class="square-box margin-top-45">
														<div class="square-content"><div data-label="75%" class="css-bar css-bar-75 css-bar-lg css-bar-danger"></div></div>
													</div>
													<hr>
													<h4 class="box-title">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</h4>
												</center> 
											</div>
										</div>
									</div> 
								</div>
								<div class="col-md-8">
									<div class="add-listing-section margin-top-45">
										<!-- Headline -->

										<div class="white-box">
											<div class="panel panel-inverse">
												<div class="panel-heading"> Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu									<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
											</div>
											<div class="panel-wrapper collapse in" aria-expanded="true">
												<div class="panel-body">
													<table class="table">
														<tbody><tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>Ade Setiawan</strong></td></tr>
															<tr><td>Jumlah Pegawai </td><td>:</td><td> <strong>65 Orang</strong></td></tr>

														</tbody></table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">
										<hr>
										<h4>SS1 - Meningkatnya Investasi di Kabupaten Sumedang</h4>
										<p>Bobot SS : 50% </p>
										<table class="basic-table table table-bordered">
											<thead>
												<tr align="center" class="info">
													<th>No.</th>
													<th>IKU / IKK</th>
													<th>Bobot IKU</th>
													<th>Sumber IKU</th>
													<th>Target</th>
													<th>Realisasi</th>
													<th>Persentase</th>
													<th>Cascading</th>
													<th>Metode Cascading</th>

												</tr> 

											</thead>
											<tbody>

												<tr>
													<td align="right">1</td>
													<td>Meningkatnya Investasi di Kabupaten Sumedang</td>
													<td>50%</td>
													<td>Sekretariat</td>
													<td>10 Izin</td>
													<td>5 Izin</td>
													<td><span class="label label-danger m-l-5"> 75.00%</span></td>
													<td>Bidang Perizinan</td>
													<td>Adobe Langsung</td> 
												</tr>


											</tbody>

										</table>
										<hr>

										<h4>SS2 - Meningkatnya Kualitas Pelayanan Perizinan dan Non Perizinan di Kabupaten Sumedang</h4>
										<p>Bobot SS : 50% </p>
										<table class="basic-table table table-bordered">
											<thead>
												<tr align="center" class="info">
													<th>No.</th>
													<th>IKU / IKK</th>
													<th>Bobot IKU</th>
													<th>Sumber IKU</th>
													<th>Target</th>
													<th>Realisasi</th>
													<th>Persentase</th>
													<th>Cascading</th>
													<th>Metode Cascading</th>

												</tr> 

											</thead>
											<tbody>

												<tr>
													<td align="right">1</td>
													<td>Terselenggranya pelayanan perizinan usaha sesuai dan berorientasi pada kepuasaan dan keadilan masyarakat dunia usaha</td>
													<td>50%</td>
													<td>Sekretariat</td>
													<td>10 Izin</td>
													<td>5 Izin</td>
													<td><span class="label label-danger m-l-5"> 75.00%</span></td>
													<td>Bidang Perizinan</td>
													<td>Adobe Langsung</td> 
												</tr>

												<tr>
													<td align="right">1</td>
													<td>Dokumen laporan penyelenggaraan PTSP</td>
													<td>50%</td>
													<td>Sekretariat</td>
													<td>10 Dokumen</td>
													<td>5 Dokumen</td>
													<td><span class="label label-danger m-l-5"> 65.00%</span></td>
													<td>- tidak di cascading -</td>
													<td></td> 
												</tr>


											</tbody>

										</table>


									</div>
								</div>
								<!-- Section / End -->
							</div>

						</div>
						<div class="modal-footer">
							<a href="<?php echo base_url(). "laporan/detail_unitkerja" ;?>"><button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Detail Unitkerja</button></a>
							<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
				</div>
			</div>
		</div>
	</div>

	<?php } ?>

</div>
<!-- .row -->

</div>


