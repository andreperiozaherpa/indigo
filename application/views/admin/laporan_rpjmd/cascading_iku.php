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
				<li><a href="<?= base_url();?>admin">Dashboard</a></li>
				<li class="active">Laporan Perencanaan</li>
			</ol>
		</div>
		<!-- /.breadcrumb -->
	</div>

	<div class="row" style="overflow-x: auto;">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<form method="POST">
						<div class="col-md-1">
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

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">Unit kerja</label>
	 							<select name="id_unit_penanggungjawab" id="id_unit_penanggungjawab" onchange="getIndikator()" class="form-control">
	 								<option value="">Pilih</option>
	 								<?php 
	 								foreach($unit_kerja as $r){
	 									$selected = (!empty($id_unit_penanggungjawab) && $id_unit_penanggungjawab==$r->id_unit_kerja) ? "selected" : "";
	 									echo'<option '.$selected.' value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
	 								}?>
	 							</select>				
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputEmail1">IKU</label>
								<select name="id_indikator" id="id_indikator" class="form-control">
									<option value="">Pilih</option>
									<?php 
	 								foreach($indikator as $r){
	 									$selected = (!empty($id_indikator) && $id_indikator==$r->id_indikator) ? "selected" : "";
	 									echo'<option '.$selected.' value="'.$r->id_indikator.'">'.$r->nama_indikator.'</option>';
	 								}?>
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
	<div class="row" style="overflow-x: auto;">	

<?php 
if(!empty($id_indikator) && $id_indikator!=""){
	$CI =& get_instance();
	$CI->load->model("indikator_model");
	$param = array(
		'id_indikator' => $id_indikator,
		'type'			=> $_type
	);
	$indikator = $CI->indikator_model->getIndikator($param);
	//var_dump($indikator);
	$GLOBALVAR = GLOBALVAR;
	echo'
	<div class="row" style="overflow-x: auto;">	
		<div class="col-md-12">
			<div class="container">
				<ul id="tree-data" style="display:none">
					<li id="root">
						<!-- unit kerja  -->
						<div class="white-box">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<h3 class="box-title m-b-0">'.$indikator[0]->nama_unit_kerja.'<br>
									<span class="label label-success m-l-5">'.$GLOBALVAR['metode_penurunan'][$indikator[0]->metode_penurunan].'</span> 
									</h3>
									<h4>'.$indikator[0]->kode_indikator.' - '.$indikator[0]->nama_indikator.'</h4>
									<h5>Target : '.$indikator[0]->target.'</h5>



								</div>
							</div>
						</div>
						<ul>';
							$type_bawahan = "SS";
								if($_type=="SS"){
									$type_bawahan = "SP";
								}
								else if($_type=="SP"){
									$type_bawahan="SK";
								}
								if($indikator[0]->level_unit_kerja==-1) $type_bawahan="SS";
								$param2 = array(
									'type'	=> $_type,
									'type_bawahan' => $type_bawahan,
									'level_unit_kerja' => $indikator[0]->level_unit_kerja,
									'where'	=> array(
										'indikator_turunan.uid_iku_atasan' => $indikator[0]->uid_iku,
									),

								);
								$indikator2 = $CI->indikator_model->getIndikatorTurunan($param2,"indikator_turunan.uid_iku_bawahan is not null");

								foreach ($indikator2 as $i2) {
									echo'
									<li id="node1">
										<div class="white-box">
											<div class="row">
												<div class="col-md-12 col-sm-12">
													<h3 class="box-title m-b-0">'.$i2->nama_unit_kerja.' <br>
													<span class="label label-success m-l-5">'.$GLOBALVAR['metode_penurunan'][$i2->metode].'</span> 
													</h3>
													<h4>'.$i2->kode_indikator_bawahan2.' - '.$i2->nama_indikator_bawahan2.'</h4>
													<h5>Target : '.$i2->target_bawahan2.'</h5>
												</div>
											</div>
										</div>
										<ul>';

										if($i2->type_bawahan=="SS"){
											$type_bawahan = "SP";
										}
										else if($i2->type_bawahan=="SP"){
											$type_bawahan="SK";
										}
										if($indikator[0]->level_unit_kerja==-1) $type_bawahan=$i2->type_bawahan;
										$param3 = array(
													'type'	=> $i2->type_bawahan,
													'type_bawahan'	=> $type_bawahan,
													'where'	=> array(
														'indikator_turunan.uid_iku_atasan' => $i2->uid_iku_bawahan,
													),
												);
												$indikator3 = $CI->indikator_model->getIndikatorTurunan($param3,"indikator_turunan.uid_iku_bawahan is not null");

												foreach ($indikator3 as $i3) {
													echo'
													<li id="node1">
														<div class="white-box">
															<div class="row">
																<div class="col-md-12 col-sm-12">
																	<h3 class="box-title m-b-0">'.$i3->nama_unit_kerja.' <br>
																	<span class="label label-success m-l-5">'.$GLOBALVAR['metode_penurunan'][$i3->metode].'</span> 
																	</h3>
																	<h4>'.$i3->kode_indikator_bawahan2.' - '.$i3->nama_indikator_bawahan2.'</h4>
																	<h5>Target : '.$i3->target_bawahan2.'</h5>
																</div>
															</div>
														</div>
														<ul>';

														if($i3->type_bawahan=="SS"){
															$type_bawahan = "SP";
														}
														else if($i3->type_bawahan=="SP"){
															$type_bawahan="SK";
														}
														if($indikator[0]->level_unit_kerja==-1) $type_bawahan=$i3->type_bawahan;
														$param4 = array(
																	'type'	=> $i3->type_bawahan,
																	'type_bawahan'	=> $type_bawahan,
																	'where'	=> array(
																		'indikator_turunan.uid_iku_atasan' => $i3->uid_iku_bawahan,
																	),
																);
																$indikator4 = $CI->indikator_model->getIndikatorTurunan($param4,"indikator_turunan.uid_iku_bawahan is not null");

																foreach ($indikator4 as $i4) {
																	echo'
																	<li id="node1">
																		<div class="white-box">
																			<div class="row">
																				<div class="col-md-12 col-sm-12">
																					<h3 class="box-title m-b-0">'.$i4->nama_unit_kerja.' <br>
																					<span class="label label-success m-l-5">'.$GLOBALVAR['metode_penurunan'][$i4->metode].'</span> 
																					</h3>
																					<h4>'.$i4->kode_indikator_bawahan2.' - '.$i4->nama_indikator_bawahan2.'</h4>
																					<h5>Target : '.$i4->target_bawahan2.'</h5>
																				</div>
																			</div>
																		</div>
																	</li>';
																}	
													echo'</ul>
													</li>';
												}	

				echo'					</ul>
									</li>';
								}
				echo'			
						</ul>
					</li>
				</ul>
			</div>
		</div>

	</div>

	<div id="tree-view"></div> 
	';
	}
?>   
</div>
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


		function getIndikator()
 			{
 				var id_unit_penanggungjawab = $("#id_unit_penanggungjawab").val();
 				$.post("<?= base_url();?>laporan/getiku",
		 			{
		 				'id_unit' : id_unit_penanggungjawab,
		 			},
		 			function(result)
		 			{
		 				$("#id_indikator").html(result);
		 				console.log(result);
		 			}
	 			);

 			}

</script>
</div>
<!-- .row -->

</div>



