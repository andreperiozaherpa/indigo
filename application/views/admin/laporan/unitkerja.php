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
								<label for="exampleInputEmail1">Tahun</label>
								<select name="tahun_rkt" class="form-control">
									<?php 
									foreach($tahun as $r){
										echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
									}
									?>
								</select>				
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">

								<br>
								<button type="submit" class="btn btn-primary m-t-5">Filter</button>
								<a href="<?=base_url('laporan/cetak_perencanaan')?>" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
							</div>
						</div>

					</form>
				</div>

			</div>
		</div>

	</div>
	<!-- .row -->
	<?php
		$CI =& get_instance();
		$CI->load->model("ref_unit_kerja_model");
		$CI->load->model("pencapaian_model");
		$unit0 = $CI->ref_unit_kerja_model->getUnit(array('level_unit_kerja' => 0));
		$capaian0 = $CI->pencapaian_model->getCapaianTahunan($unit0[0]->id_unit_kerja,$tahun_rkt);
	?>

	<div class="row" style="overflow-x: auto;">	
		<div class="col-md-12">
			<div class="container">
				<ul id="tree-data" style="display:none">
					<li id="root">
						<!-- unit kerja  -->
						<div class="white-box">
							<div class="row">
								<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".modal-<?=$unit0[0]->id_unit_kerja;?>">

									<div data-label="<?= number_format($capaian0) ;?> %" class="css-bar css-bar-<?= number_format($capaian0) ;?> css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
									</a>
								</div>
								<div class="col-md-8 col-sm-8">
									<h3 class="box-title m-b-0"><?= $unit0[0]->nama_unit_kerja;?></h3>
									<h4><span class="label label-danger m-l-5"><?= number_format($capaian0);?>%</span> Capaian Kinerja</h4>
								</div>
							</div>
						</div>
					<!-- end unitkerja -->
						<ul>
							
							<?php
								$param1 = array(
									'level_unit_kerja' 	=> 1,
									'id_induk'			=> $unit0[0]->id_unit_kerja,
								);
								$unit1 = $CI->ref_unit_kerja_model->getUnit($param1);
								$modalArr = array();
								foreach ($unit1 as $u1) {
									$capaian1 = $CI->pencapaian_model->getCapaianTahunan($u1->id_unit_kerja,$tahun_rkt);
									echo '
										<li id="node1">
											<div class="white-box">
												<div class="row">
													<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".modal-'.$u1->id_unit_kerja.'">

														<div data-label="'.number_format($capaian1).'%" class="css-bar css-bar-'.number_format($capaian1).' css-bar-lg css-bar-danger"><img src="'.base_url().'data/icon/office.png" alt="unitkerja" class="img-circle"/></div>
														</a>
													</div>
													<div class="col-md-8 col-sm-8">
														<h3 class="box-title m-b-0">'.$u1->nama_unit_kerja.'</h3>
														<h4><span class="label label-danger m-l-5">'.number_format($capaian1).'%</span> Capaian Kinerja</h4>
													</div>
												</div>
											</div>
											<ul>';


											$param2 = array(
												'level_unit_kerja' 	=> 2,
												'id_induk'			=> $u1->id_unit_kerja,
											);
											$unit2 = $CI->ref_unit_kerja_model->getUnit($param2);
											foreach ($unit2 as $u2) {
												$capaian2 = $CI->pencapaian_model->getCapaianTahunan($u2->id_unit_kerja,$tahun_rkt);
												echo '
													<li id="node1">
														<div class="white-box">
															<div class="row">
																<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".modal-'.$u2->id_unit_kerja.'">

																	<div data-label="'.number_format($capaian2).'%" class="css-bar css-bar-'.number_format($capaian2).' css-bar-lg css-bar-danger"><img src="'.base_url().'data/icon/office.png" alt="unitkerja" class="img-circle"/></div>
																	</a>
																</div>
																<div class="col-md-8 col-sm-8">
																	<h3 class="box-title m-b-0">'.$u2->nama_unit_kerja.'</h3>
																	<h4><span class="label label-danger m-l-5">'.number_format($capaian2).'%</span> Capaian Kinerja</h4>
																</div>
															</div>
														</div>
														<ul>';
														
														$param3 = array(
															'level_unit_kerja' 	=> 3,
															'id_induk'			=> $u2->id_unit_kerja,
														);
														$unit3 = $CI->ref_unit_kerja_model->getUnit($param3);
														foreach ($unit3 as $u3) {
															$capaian3 = $CI->pencapaian_model->getCapaianTahunan($u3->id_unit_kerja,$tahun_rkt);
															echo '
																<li id="node1">
																	<div class="white-box">
																		<div class="row">
																			<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".modal-'.$u3->id_unit_kerja.'">

																				<div data-label="'.number_format($capaian3).'%" class="css-bar css-bar-'.number_format($capaian3).' css-bar-lg css-bar-danger"><img src="'.base_url().'data/icon/office.png" alt="unitkerja" class="img-circle"/></div>
																				</a>
																			</div>
																			<div class="col-md-8 col-sm-8">
																				<h3 class="box-title m-b-0">'.$u3->nama_unit_kerja.'</h3>
																				<h4><span class="label label-danger m-l-5">'.number_format($capaian3).'%</span> Capaian Kinerja</h4>
																			</div>
																		</div>
																	</div>
																	<ul>';
																	
																	$param4 = array(
																		'level_unit_kerja' 	=> 4,
																		'id_induk'			=> $u3->id_unit_kerja,
																	);
																	$unit4 = $CI->ref_unit_kerja_model->getUnit($param4);
																	foreach ($unit4 as $u4) {
																		$capaian4 = $CI->pencapaian_model->getCapaianTahunan($u4->id_unit_kerja,$tahun_rkt);
																		echo '
																			<li id="node1">
																				<div class="white-box">
																					<div class="row">
																						<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".modal-'.$u4->id_unit_kerja.'">

																							<div data-label="'.number_format($capaian4).'%" class="css-bar css-bar-'.number_format($capaian4).' css-bar-lg css-bar-danger"><img src="'.base_url().'data/icon/office.png" alt="unitkerja" class="img-circle"/></div>
																							</a>
																						</div>
																						<div class="col-md-8 col-sm-8">
																							<h3 class="box-title m-b-0">'.$u4->nama_unit_kerja.'</h3>
																							<h4><span class="label label-danger m-l-5">'.number_format($capaian4).'%</span> Capaian Kinerja</h4>
																						</div>
																					</div>
																				</div>
																				<ul>';
																				

																		echo'	</ul>
																			</li>

																		';
																	}

															echo'	</ul>
																</li>

															';
														}
												echo'	</ul>
													</li>

												';
											}
									echo'	</ul>
										</li>

									';
								}
							?>

							
						</ul>

					</li>

				</ul>

<?php
$unit = $CI->ref_unit_kerja_model->getUnit();
$CI->load->model("sasaran_strategis_model");
$CI->load->model("sasaran_program_model");
$CI->load->model("sasaran_kegiatan_model");
$CI->load->model("ref_rkt_model");
$CI->load->model("indikator_model");
$CI->load->model("ref_unit_kerja_model");
$CI->tahun_rkt = $tahun_rkt;

//var_dump($GLOBALVAR);
foreach ($unit as $row) {
	$capaian = $CI->pencapaian_model->getCapaianTahunan($row->id_unit_kerja,$tahun_rkt);
	$detail_unit = $CI->ref_unit_kerja_model->detail_unit($row->id_unit_kerja);
	echo '
	<!-- sample modal content -->
	<div class="modal fade bs-example-modal-lg modal-'.$row->id_unit_kerja.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
												<div class="square-content"><div data-label="'.number_format($capaian).'%" class="css-bar css-bar-'.number_format($capaian).' css-bar-lg css-bar-danger"></div></div>
											</div>
											<hr>
											<h4 class="box-title">'.$row->nama_unit_kerja.'</h4>
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
										<div class="panel-heading">'.$row->nama_unit_kerja.'<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
									</div>
									<div class="panel-wrapper collapse in" aria-expanded="true">
										<div class="panel-body">
											<table class="table">
												<tbody>
                                    <table class="table">
                                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>'.$detail_unit['nama_kepala'].'</strong></tr>
                                        <tr><td style="width: 120px;">Jabatan </td><td>:</td><td> <strong>'.$detail_unit['nama_jabatan'].'</strong></tr>
                                        <tr><td style="width: 120px;">Jumlah Staff </td><td>:</td><td> <strong>'.$detail_unit['jumlah_pegawai'].'</strong>

												</tbody></table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr>';
						$CI->ref_rkt_model->id_unit_penanggungjawab = $row->id_unit_kerja;
						$rkt = $CI->ref_rkt_model->get_all();
						$id_rkt = (!empty($rkt[0]->id_rkt)) ? $rkt[0]->id_rkt : null;
						$paramS = array(
							'id_unit'	=> $row->id_unit_kerja,
							'tahun'		=> $tahun_rkt
						);
						if($row->level_unit_kerja==0){
							$SS = $CI->sasaran_strategis_model->getData($paramS,$id_rkt);
							$kode_sasaran = "kode_sasaran_strategis";
							$id_sasaran = "id_sasaran_strategis";
							$nama_sasaran = "sasaran_strategis";
							$type = "SS";
						}
						elseif($row->level_unit_kerja==1){
							$SS = $CI->sasaran_program_model->getData($paramS,$id_rkt);
							$kode_sasaran = "kode_sasaran_program";
							$id_sasaran = "id_sasaran_program";
							$nama_sasaran = "sasaran_program";
							$type = "SP";
						}
						else{
							$SS = $CI->sasaran_kegiatan_model->getData($paramS,$id_rkt);
							$kode_sasaran = "kode_sasaran_kegiatan";
							$id_sasaran = "id_sasaran_kegiatan";
							$nama_sasaran = "sasaran_kegiatan";
							$type = "SK";
						}

						if(empty($SS)) {
							echo '
								<h5>Tidak ada data SS</h5>
							';
						}

						foreach ($SS as $ss) {
							
							echo '
							<div class="row">
								<div class="col-md-12">
									<hr>
									<h4>'.$ss->$kode_sasaran.' - '.$ss->$nama_sasaran.'</h4>
									<p>Bobot SS : '.$ss->bobot.'% </p>
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
										<tbody>';
										$paramI = array(
											'id_sasaran' => $ss->$id_sasaran,
											'type'		=> $type,
										);
										if($id_rkt!=null) $paramI['id_rkt'] = $id_rkt;
										$IKU = $CI->indikator_model->getIndikator($paramI);
										$i=1;
										foreach ($IKU as $iku) {
											$bobotIKU = !empty($iku->bobot) ? $iku->bobot : 0;
											$targetIKU = !empty($iku->target) ? $iku->target : '';
											$realisasiIKU = !empty($iku->realisasi) ? $iku->realisasi : '';
											$capaianIKU = !empty($iku->capaian) ? $iku->capaian : 0;

											$paramIT = array(
												'type' => $type,
												'where' => array(
													'indikator_turunan.uid_iku_atasan' => $iku->uid_iku,
												)
											);
											$iku_turunan = $CI->indikator_model->getIndikatorTurunan($paramIT);
											$cascading = "<ol>";
											foreach ($iku_turunan as $r) {
												$cascading .= "<li>$r->nama_unit_kerja</li>";
											}
											$cascading .= "</ol>";
											echo'
											<tr>
												<td align="right">'.$i.'</td>
												<td>'.$iku->nama_indikator.'</td>
												<td>'.$bobotIKU.'%</td>
												<td>'.$row->nama_unit_kerja.'</td>
												<td>'.$targetIKU.' '.$iku->satuan.'</td>
												<td>'.$realisasiIKU.' '.$iku->satuan.'</td>
												<td><span class="label label-danger m-l-5"> '.number_format($capaianIKU).'%</span></td>
												<td>'.$cascading.'</td>
												<td>'.$GLOBALVAR['metode_penurunan'][$iku->metode_penurunan].'</td> 
											</tr>
											';
											$i++;
										}
										if(empty($IKU)){
											echo '
												<tr><td colspan=9>Tidak ada data</td></tr>
											';
										}
							echo'

										</tbody>

									</table>
									<hr>

									


								</div>
							</div>';
						}

						echo '
					</div>

				</div>
				<div class="modal-footer">
					<a class="btn btn-default" href="'.base_url().'laporan/detail_unitkerja/'.$row->id_unit_kerja.'/'.$tahun_rkt.'" target="blank">Detail unit kerja</a>
					<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>';
}
?>

	<div id="tree-view"></div>    
</div><script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
</div>
<!-- .row -->

</div>



