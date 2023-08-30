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
					<form method="POST">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">SKPD</label>
								<select name="id_skpd" class="form-control select2">
									<?php if ($this->session->userdata('level') == "Administrator"): ?>
									<option value="">Pilih SKPD</option>
									<?php endif ?>
									<?php 
									foreach($skpd as $s){
										$selected = ($s->id_skpd == $_POST['id_skpd']) ? "selected" : "" ;
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
								<select name="tahun" class="form-control">
									<?php 

									for($tahun=2019;$tahun<=2023;$tahun++){
										$selected = ($tahun == $_POST['tahun']) ? "selected" : "" ;
										echo'<option value="'.$tahun.'" '.$selected.'>'.$tahun.'</option>';
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
	<!-- .row -->
	<div class="row dragscroll" style="overflow: auto; height: 350px;">	
		<div class="col-md-12">
			<div class="container">

				<?php 
				if(!empty($_POST['id_skpd'])){
					$id_skpd = $_POST['id_skpd'];
					?>
					<ul id="tree-data" style="display:none">
						<li id="root">
							<!-- visi -->
							<div class="panel panel-primary" > 
								<div class="panel-heading"> 
									Visi
								</div> 
								<div class="panel-body"> 

									<?= !empty($visi->visi) ? $visi->visi : "";?> 
								</div> 
							</div>
							<!-- end visi -->
							<ul id="misi">
								<!--- Level 1 -->
								<!-- Misi 1 -->
								<?php 



								$misi = $this->laporan_sakip_model->get_misi_by_visi($visi->id_visi);
								foreach($misi as $m){
									$tujuan = $this->laporan_sakip_model->get_tujuan_by_misi($m->id_misi);
									// print_r($tujuan);
									$is_misi_kosong = true;
									foreach($tujuan as $t){
										$sasaran_strategis = $this->laporan_sakip_model->get_sasaran_strategis_by_tujuan_skpd($t->id_tujuan,$id_skpd);
										// print_r($sasaran_strategis);
										if(!empty($sasaran_strategis)){
											$is_misi_kosong = false;
											break;
										}
									}
									if(!$is_misi_kosong){
										?>
										<li id="list_misi">
											<div class="panel panel-primary" > 
												<div class="panel-heading"> 
													Misi
												</div> 
												<div class="panel-body"> 
													<?=$m->misi?>
												</div> 
											</div>
											<ul id="tujuan">
												<?php 
											// print_r($tujuan);
												foreach($tujuan as $t){
													$sasaran_strategis = $this->laporan_sakip_model->get_sasaran_strategis_by_tujuan_skpd($t->id_tujuan,$id_skpd);
													if(!empty($sasaran_strategis)){
														?>
														<li id="list_tujuan">
															<div class="panel panel-primary" > 
																<div class="panel-heading"> 
																	TUJUAN
																</div> 
																<div class="panel-body"> 
																	<?=$t->tujuan?>
																</div> 
															</div>

															<ul id="sasaran_strategis">
																<?php 
																foreach($sasaran_strategis as $ss){
														// echo "string";
																	$iku = $this->laporan_sakip_model->get_iku_sasaran_strategis($ss->id_sasaran_strategis_renstra);
																	?>
																	<li id="list_tujuan">
																		<div class="panel panel-primary" > 
																			<div class="panel-heading" style="position: relative;"> 
																				SASARAN STRATEGIS
																				<div style="position: absolute;right: 15px;top: 15px;">
																					<a href="javascript:void(0)" onclick="getIndikator('ss',<?=$ss->id_sasaran_strategis_renstra?>)" class="btn btn-default float-right pull-right btn-circle" style="color: #6003C8;text-align: center;"><i style="margin: 0px;" class="ti-view-list-alt"></i></a>
																				</div>
																			</div> 
																			<div class="panel-body"> 
																				<?=$ss->sasaran_strategis_renstra?>
																			</div> 
																		</div>

																		<ul id="sasaran_program">
																			<?php 
																			$sasaran_program = $this->laporan_sakip_model->get_sasaran_program_by_sasaran_strategis_skpd($ss->id_sasaran_strategis_renstra,$id_skpd);
																			foreach($sasaran_program as $sp){
																	// echo "string";
																				?>
																				<li id="list_tujuan">
																					<div class="panel panel-primary" > 
																						<div class="panel-heading" style="position: relative;"> 
																							SASARAN PROGRAM
																							<div style="position: absolute;right: 15px;top: 15px;">
																								<a href="javascript:void(0)" onclick="getIndikator('sp',<?=$sp->id_sasaran_program_renstra?>)" class="btn btn-default float-right pull-right btn-circle" style="color: #6003C8;text-align: center;"><i style="margin: 0px;" class="ti-view-list-alt"></i></a>
																							</div>
																						</div> 
																						<div class="panel-body"> 
																							<?=$sp->sasaran_program_renstra?>
																						</div> 
																					</div>
																					<ul id="sasaran_kegiatan">
																						<?php 
																						$sasaran_kegiatan = $this->laporan_sakip_model->get_sasaran_kegiatan_by_sasaran_program_skpd($sp->id_sasaran_program_renstra,$id_skpd);
																						foreach($sasaran_kegiatan as $sk){
																		// print_r($sasaran_kegiatan);
																			// echo "string";
																							?>
																							<li id="list_tujuan">
																								<div class="panel panel-primary" > 
																									<div class="panel-heading" style="position: relative;"> 
																										SASARAN KEGIATAN
																										<div style="position: absolute;right: 15px;top: 15px;">
																											<a href="javascript:void(0)" onclick="getIndikator('sk',<?=$sk->id_sasaran_kegiatan_renstra?>)" class="btn btn-default float-right pull-right btn-circle" style="color: #6003C8;text-align: center;"><i style="margin: 0px;" class="ti-view-list-alt"></i></a>
																										</div>
																									</div> 
																									<div class="panel-body"> 
																										<?=$sk->sasaran_kegiatan_renstra?>
																									</div> 
																								</div>
																							</li>
																							<?php
																						}
																						?>
																					</ul>
																				</li>
																				<?php
																			}
																			?>
																		</ul>
																	</li>
																	<?php
																}
																?>
															</ul>
														</li>
														<?php
													} }
													?>
												</ul>
											</li>
										<?php } } ?>

									</ul>

								</li>

							</ul>
			<div id="tree-view" style="transform: matrix(0.5, 0, 0, 0.5, 0, 0); height: 350px; padding-top: 200px;"></div>    
						<?php } ?>  
					</div>
					<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalIndikator">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header" style="border-color: #3e4d6c;background-color: #6003c8">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#ffffff">×</button>
									<h4 class="modal-title" id="myLargeModalLabel" style="color:#ffffff">Indikator Kinerja Utama Sasaran Strategis</h4>
								</div>
								<div class="modal-body">
									<span id="namaSasaran">Sasaran</span> : <b><span id="dSasaran">-</span></b>
									<table class="table table-bordered table-hover" style="margin-bottom: 15px;margin-top: 10px;">
										<thead class="active">
											<tr class="info">
																	<th style="vertical-align: middle;text-align: center">No</th>
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
										<tbody id="rowIndikator">	
										<tr>
											<td rowspan="10">
												<center>Memuat ...</center>
											</td>
										</tr>					
										</tbody>
										<!----></table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary waves-effect text-left" data-dismiss="modal">Tutup</button>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<script type="text/javascript">

							var _gaq = _gaq || [];
							_gaq.push(['_setAccount', 'UA-36251023-1']);
							_gaq.push(['_setDomainName', 'jqueryscript.net']);
							_gaq.push(['_trackPageview']);

							(function() {
								var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
								ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
							})();

							function getIndikator(type,id){
								$.get( "<?=base_url('laporan/get_indikator')?>/"+type+"/"+id, function( data ) {
									var name;
									if(type=='ss'){
										name = 'Sasaran Strategis';
									}else if(type=='sp'){
										name = 'Sasaran Program';
									}else if(type=='sk'){
										name = 'Sasaran Kegiatan';
									}
									$('#dSasaran').html(data.sasaran_renstra);
									$('.modal-title').html('Indikator Kinerja Utama '+name);
									$('#namaSasaran').html(name);
									$('#rowIndikator').html(data.html);
									$('#modalIndikator').modal('show');
								},"json");
							}
						</script>
					</div>
					<!-- .row -->

				</div>



