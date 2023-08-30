<style type="text/css">
.alert-default{
	border: solid 1px #6003c8;
	color: #6003c8;
	font-weight: 400;
}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ren. Kerja</h4> </div>
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li class="active">Ren. Kerja</li>				
				</ol>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="<?=base_url('renja_rka/view/'.$id_skpd.'')?>" style="margin-bottom: 10px;" class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if ($this->session->flashdata('msg')): ?>
					<div class="alert alert-<?=$this->session->flashdata('type')?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?=$this->session->flashdata('msg')?> </div>
					<?php endif ?>
					<div class="white-box">
						<div class="row">
							<form method="POST">
								<div class="col-md-12">
									<div class="panel-wrapper collapse in" aria-expanded="true">
										<div class="panel panel-primary">
											<div class="panel panel-heading">
												<span style="display: block;position: absolute;top:8px;font-weight: 300;font-size: 10px">SKPD</span>
												<?=$skpd->nama_skpd?>
												<?php
												if($is_renja_skpd_exist){
													?>
													<!-- <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahanSKPD(<?=$id_skpd?>)"><i class="ti-pencil"></i> Ubah PK Perubahan</a> -->
													<?php
												}else{
													?>
													<!-- <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahanSKPD(<?=$id_skpd?>)"><i class="ti-pencil-alt2"></i> Buat PK Perubahan</a> -->
													<?php
												}
												?>
											</div>
											<div class="panel-body">
												<table class="table">
													<tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <?=$kepala_skpd->nama_lengkap?><strong></strong></td></tr>
													<tr><td style="width: 120px;">Jumlah Staf</td><td>:</td><td> <?=$jumlah_pegawai?> Org<strong></strong></td></tr>
												</table>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>

						<?php

						$empty = true;
						foreach($jenis as $j => $v){
							$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
							$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
							$sasaran = array_merge($sasaran, $sasaran_inisiatif);
							if (!empty($sasaran)) {
								$empty = false;
							}
							if(!empty($sasaran)){
								$empty = false;
							}
						}
						if(!$empty){
							foreach($jenis as $j => $v){
								$name = $this->renja_perencanaan_model->name($j);
								$sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
								$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
								$sasaran = array_merge($sasaran, $sasaran_inisiatif);
								if (!empty($sasaran)) {
									$empty = false;
								}
								if(!empty($sasaran)){
									?>
									<div class="row" style="position: relative;">
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
										$aIkuRenja = $name['aIkuRenja'];
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
										<div class="row" style="margin-top: 30px">
											<div class="p-10" style="border-left: 5px solid #6003c8!important;border: 1px solid rgba(120,130,140,.21);"><h5 class="m-l-10"><strong>Sasaran <?=$no?>.</strong> <?=$s->nama_sasaran?> <!-- <span class="pull-right text-primary">Rp<strong class="counter"><?=number_format($s->$aIkuRenja)?></strong></span> --> <span class="label label-success">Inisiatif</span></h5></div>
									<?php
								} else {
									?>
									<div class="row" style="margin-top: 30px">
										<div class="p-10" style="border-left: 5px solid #6003c8!important;border: 1px solid rgba(120,130,140,.21);"><h5 class="m-l-10"><strong>Sasaran <?=$no?>.</strong> <?=$s->$tSasaran?> <!-- <span class="pull-right text-primary">Rp<strong class="counter"><?=number_format($s->$aIkuRenja)?></strong></span> --></h5></div>
								<?php } ?>
								
											<?php
											$n=1;
											$cIkuRenja = $name['cIkuRenja'];
											$tIku = $name['tIku'];
											foreach ($iku as $i): 
												$rka = $this->renja_rka_model->get_rka($j,$i->$cIkuRenja,$tahun,$id_skpd);
												$total_rka[$i->$cIkuRenja] = 0;
												foreach ($rka as $r) {
													$total_rka[$i->$cIkuRenja] += $r->anggaran;
												}
												?>
												<div class="panel panel-default">
													<div class="panel-heading" role="tab" id="iku_<?=$i->$cIkuRenja?>">
														<h4 class="panel-title"> <strong>IKU <?=$no?>.<?=$n?>.</strong> <?=$i->$tIku?> <span class="pull-right text-primary">Rp<strong class="counter b-r p-r-10 m-r-5"><?=number_format(round($total_rka[$i->$cIkuRenja]))?></strong> <button class="btn btn-sm btn-primary btn-outline btn-rounded" onclick="open_modal_tambah_dpa('<?=$j?>','<?=$i->$cIkuRenja?>','<?=$tahun?>','<?=$id_skpd?>');">Tambah DPA</button> <a href="<?php echo base_url('renja_perencanaan/detail/'.$id_skpd.'/'.$tahun.'#iku_'.$i->$cIkuRenja);?>" class="btn btn-sm btn-info btn-rounded btn-outline"> Detail IKU </a></span></h4>
													</div>
													<?php if ($rka): ?>
														<div class="panel-body">
															<?php $nr=1; foreach ($rka as $r): $persen_rka = round(($r->anggaran/$total_rka[$i->$cIkuRenja])*100,2)?>
															<div class="col-md-4 row-in-br">
																<div class="col-in row">
																	<div class="col-md-4"> <span class="btn btn-xs btn-circle btn-primary btn-outline"><?=$nr?></span> <?=$r->kode_rka?>
																	<h5 class="text-muted vb"><?=$r->nama_rka?></h5> </div>
																	<div class="col-md-8">
																		<h4 class="text-right m-t-15 text-primary">Rp<strong class="counter"><?=number_format(round($r->anggaran))?></strong></h4> </div>
																		<div class="col-md-12">
																			<div class="progress">
																				<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$persen_rka?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_rka?>%"> <span class="sr-only"><?=$persen_rka?>% Anggaran (used)</span> </div>
																			</div>
																			<div class="pull-right">
																				<button class="btn btn-xs btn-primary btn-outline" onclick="open_modal_ubah_dpa('<?=$r->id_rka?>');"><span class="fa fa-edit"> Ubah</span></button>
																				<button class="btn btn-xs btn-default btn-outline" onclick="delete_dpa('<?=$r->id_rka?>')"><span class="fa fa-trash"> Hapus</span></button>
																			</div>
																		</div>
																	</div>
																</div>
																<?php $nr++; endforeach ?>
															</div>
														<?php endif ?>
													</div>
													<?php $n++; endforeach ?>
													<?php $no++; 
													?>
									</div>
												<?php } } } }else{
														?>

														<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
														<?php
													} ?>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											<?php 
											$count_total_capaian_kepala = 0;
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

										<?php

										if(empty($unit_kerja)){
											?>
											<center>
												<i style="font-size: 80px;display: block" class="ti-briefcase"></i>
												<span style="display: block;margin-top: 20px;margin-bottom:20px;font-size: 15px;">Belum ada unit kerja pada SKPD ini.</span>
												<a href="<?=base_url('renja_rka/view/'.$id_skpd)?>" class="btn btn-primary"><i class="ti-back-left"></i> Kembali</a>
											</center>
											<?php
										}else{
											foreach($unit_kerja as $u){
              // echo $u->nama_unit_kerja;
												$kepala = $this->ref_skpd_model->get_kepala_unit_kerja($u->id_unit_kerja);
												$staff = $this->ref_skpd_model->get_staff_unit_kerja($u->id_unit_kerja);


												$is_renja_exist = false;
												foreach($jenis as $key => $value){
													$renja = $this->renja_rka_model->get_renja_unit_kerja($key,$u->id_unit_kerja,$tahun);
													if(!empty($renja)){
														$is_renja_exist = true;
														break;
													}
												}
												
										$empty = true;
										foreach ($jenis as $j => $v) {
											$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
											$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
											$sasaran = array_merge($sasaran, $sasaran_inisiatif);
											if (!empty($sasaran)) {
												$empty = false;
											}
										}
												?>
												<div class="row" id="unit_kerja_<?=$u->id_unit_kerja?>">
													<div class="col-md-12">
														<div class="white-box">
															<div class="row">
																<form method="POST">
																	<div class="col-md-12">
																		<div class="panel-wrapper collapse in" aria-expanded="true">
																			<div class="panel panel-primary">
																				<div class="panel panel-heading">
																					<span style="display: block;position: absolute;top:8px;font-weight: 300;font-size: 10px">Unit Kerja</span>
																					<?=$u->nama_unit_kerja?>
																					<?php
																					if($is_renja_exist){
																						?>
																						<!-- <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahan(<?=$u->id_unit_kerja?>)"><i class="ti-pencil"></i> Ubah PK Perubahan</a> -->
																						<?php
																					}else{
																						?>
																						<!-- <a href="javascript:void(0)" class="btn btn-default m-1-5 pull-right" style="position:relative;bottom:6px;color: #6003c8" onclick="buatPKPerubahan(<?=$u->id_unit_kerja?>)"><i class="ti-pencil-alt2"></i> Buat PK Perubahan</a> -->
																						<?php
																					}
																					?>
																				</div>
																				<div class="panel-body">
																					<table class="table">
																						<tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <?=$kepala->nama_lengkap?><strong></strong></td></tr>
																						<tr><td style="width: 120px;">Jumlah Staf</td><td>:</td><td> <?=count($staff)?> Org<strong></strong></td></tr>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
															<?php
															if(!$empty){
																foreach($jenis as $j => $v){
																	$name = $this->renja_perencanaan_model->name($j);
																	$sasaran = $this->renja_perencanaan_model->get_sasaran($j, $u->id_unit_kerja, $tahun);
																	$sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $u->id_unit_kerja, $tahun);
																	$sasaran = array_merge($sasaran, $sasaran_inisiatif);
																	if(!empty($sasaran)){
																		?>
																		<div class="row" style="position: relative;">
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
																			$aIkuRenja = $name['aIkuRenja'];
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
										<div class="row" style="margin-top: 30px">
											<div class="p-10" style="border-left: 5px solid #6003c8!important;border: 1px solid rgba(120,130,140,.21);"><h5 class="m-l-10"><strong>Sasaran <?=$no?>.</strong> <?=$s->nama_sasaran?> <!-- <span class="pull-right text-primary">Rp<strong class="counter"><?=number_format($s->$aIkuRenja)?></strong></span> --> <span class="label label-success">Inisiatif</span></h5></div>
									<?php
								} else {
									?>
									<div class="row" style="margin-top: 30px">
										<div class="p-10" style="border-left: 5px solid #6003c8!important;border: 1px solid rgba(120,130,140,.21);"><h5 class="m-l-10"><strong>Sasaran <?=$no?>.</strong> <?=$s->$tSasaran?> <!-- <span class="pull-right text-primary">Rp<strong class="counter"><?=number_format($s->$aIkuRenja)?></strong></span> --></h5></div>
								<?php } ?>


																				<?php
																				$n=1;
																				$cIkuRenja = $name['cIkuRenja'];
																				$tIku = $name['tIku'];
																				foreach ($iku as $i): 
																					$rka = $this->renja_rka_model->get_rka($j,$i->$cIkuRenja,$tahun,$id_skpd,$u->id_unit_kerja);
																					$total_rka[$i->$cIkuRenja] = 0;
																					foreach ($rka as $r) {
																						$total_rka[$i->$cIkuRenja] += $r->anggaran;
																					}
																					?>

																					<div class="panel panel-default">
																						<div class="panel-heading" role="tab" id="iku_<?=$i->$cIkuRenja?>">
																							<h4 class="panel-title"> <strong>IKU <?=$no?>.<?=$n?>.</strong> <?=$i->$tIku?> <span class="pull-right text-primary">Rp<strong class="counter b-r p-r-10 m-r-5"><?=number_format(round($total_rka[$i->$cIkuRenja]))?></strong> <button class="btn btn-sm btn-primary btn-outline btn-rounded" onclick="open_modal_tambah_dpa('<?=$j?>','<?=$i->$cIkuRenja?>','<?=$tahun?>','<?=$id_skpd?>','<?=$u->id_unit_kerja?>');">Tambah DPA</button> <a href="<?php echo base_url('renja_perencanaan/detail/'.$id_skpd.'/'.$tahun.'#iku_'.$i->$cIkuRenja);?>" class="btn btn-sm btn-info btn-rounded btn-outline"> Detail IKU </a></span></h4>
																						</div>
																						<?php if ($rka): ?>
																							<div class="panel-body">
																								<?php $nr=1; foreach ($rka as $r): $persen_rka = round(($r->anggaran/$total_rka[$i->$cIkuRenja])*100,2)?>
																								<div class="col-md-4 row-in-br">
																									<div class="col-in row">
																										<div class="col-md-4"> <span class="btn btn-xs btn-circle btn-primary btn-outline"><?=$nr?></span> <?=$r->kode_rka?>
																										<h5 class="text-muted vb"><?=$r->nama_rka?></h5> </div>
																										<div class="col-md-8">
																											<h4 class="text-right m-t-15 text-primary">Rp<strong class="counter"><?=number_format(round($r->anggaran))?></strong></h4> </div>
																											<div class="col-md-12">
																												<div class="progress">
																													<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$persen_rka?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen_rka?>%"> <span class="sr-only"><?=$persen_rka?>% Anggaran (used)</span> </div>
																												</div>
																												<div class="pull-right">
																													<button class="btn btn-xs btn-primary btn-outline" onclick="open_modal_ubah_dpa('<?=$r->id_rka?>');"><span class="fa fa-edit"> Ubah</span></button>
																													<button class="btn btn-xs btn-default btn-outline" onclick="delete_dpa('<?=$r->id_rka?>')"><span class="fa fa-trash"> Hapus</span></button>
																												</div>
																											</div>
																										</div>
																									</div>
																									<?php $nr++; endforeach ?>
																								</div>
																							<?php endif ?>
																						</div>
																						<?php $n++; endforeach ?>
																					</div>
																						<?php $no++; } } } }else{
																							?>

																							<div class="alert alert-default"><i class="ti-alert"></i> Belum ada Sasaran yang diturunkan</div>
																							<?php
																						} ?>
																				</div>
																			</div>
																		</div>
																	<?php }?>
																<?php } ?>
																<!--Update Realisasi Renja-->
																<div id="modaldpa" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
																	<div class="modal-dialog modal-md">
																		<div class="modal-content">
																			<div class="panel panel-primary">
																				<div class="panel-heading">
																					<h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Form DPA</h4>
																				</div>
																			</div>
																			<div class="modal-body">
																				<form class="form-horizontal" method="POST">
																					<input type="hidden" name="jenis_sasaran" id="jenis_sasaran">
																					<input type="hidden" name="id_iku" id="id_iku">
																					<input type="hidden" name="tahun" id="tahun">
																					<input type="hidden" name="id_skpd" id="id_skpd">
																					<input type="hidden" name="id_unit_kerja" id="id_unit_kerja">
																					<input type="hidden" name="id_rka" id="id_rka">
																					<div class="form-group">
																						<label class="col-sm-12">Kode</label>
																						<div class="col-md-12">
																							<input type="text" name="kode_rka" id="kode_rka" class="form-control" placeholder="Masukkan Kode">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-12">Nama</label>
																						<div class="col-md-12">
																							<input type="text" name="nama_rka" id="nama_rka" class="form-control" placeholder="Masukkan Nama">
																						</div>
																					</div>
																					<div class="form-group">
																						<label class="col-sm-12">Anggaran</label>
																						<div class="col-md-12">
																							<input type="text" name="anggaran" id="anggaran" class="form-control" placeholder="Masukkan Anggaran">
																						</div>
																					</div>
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
																					<button type="submit" name="tambah_rka" id="tambah_rka" class="btn btn-primary waves-effect text-left">Simpan</button>
																					<button type="submit" name="update_rka" id="update_rka" class="btn btn-primary waves-effect text-left">Simpan</button>
																				</form>
																			</div>
																		</div>
																		<!-- /.modal-content -->
																	</div>
																	<!-- /.modal-dialog -->
																</div>

																<form method="POST"><input type="hidden" name="id_rka" id="id_rka_hapus"><input type="submit" name="delete_rka" id="delete_rka" class="hide"></form>

																<script type="text/javascript">

																	function open_modal_tambah_dpa(jenis,id_iku,tahun,id_skpd,id_unit_kerja=0){
																		$('#jenis_sasaran').val(jenis);
																		$('#id_iku').val(id_iku);
																		$('#tahun').val(tahun);
																		$('#id_skpd').val(id_skpd);
																		$('#id_unit_kerja').val(id_unit_kerja);
																		
																		$('#kode_rka').val("");
																		$('#nama_rka').val("");
																		$('#anggaran').val("");
																		$('#tambah_rka').show();
																		$('#update_rka').hide();
																		$('#modaldpa').modal('show');
																	}

																	function open_modal_ubah_dpa(id_rka) {
																		$.getJSON( "<?=base_url('renja_rka/get_rka')?>/"+id_rka, function(data) {
																			$('#id_rka').val(id_rka);
																			$('#kode_rka').val(data.kode_rka);
																			$('#nama_rka').val(data.nama_rka);
																			$('#anggaran').val(data.anggaran);
																			$('#tambah_rka').hide();
																			$('#update_rka').show();
																			$('#modaldpa').modal('show');
																		});
																	}

																	function delete_dpa(id_rka) {
																		swal({   
																			title: "Apakah anda yakin?",   
																			text: "Data yang sudah dihapus, tidak dapat dikembalikan!",   
																			type: "warning",   
																			showCancelButton: true,   
																			confirmButtonColor: "#DD6B55",   
																			confirmButtonText: "Ya, hapus!",   
																			cancelButtonText: "Tidak, kembali!",   
																			closeOnConfirm: false,   
																			closeOnCancel: false 
																		}, function(isConfirm){   
																			if (isConfirm) {   
																				$.getJSON( "<?=base_url('renja_rka/get_rka')?>/"+id_rka, function(data) {
																					$('#id_rka_hapus').val(id_rka);
																					swal("Dihapus!", "Data berhasil dihapus.", "success"); 
																					$('#delete_rka').click(); 
																				}); 
																			} else {     
																				swal("Batal", "Batal menghapus data.", "error");   
																			} 
																		});
																	}
																</script>

