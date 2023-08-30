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
				<li class="active">Laporan Pohon Kerja</li>
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
	<script type="text/javascript">
		var IKU = [];
	</script>
	<div class="row" style="overflow-x: auto;">	
		<div class="col-md-12">
			<div class="container">
				<ul id="tree-data" style="display:none">
					<li id="root">
						<!-- visi -->
						<div class="panel panel-primary" > 
							<div class="panel-heading"> 
								Visis
							</div> 
							<div class="panel-body"> 
								<?= !empty($visi->visi) ? $visi->visi : "";?> 
							</div> 
						</div>
						<!-- end visi -->
						<ul>
							<!--- Level 1 -->
							<!-- Misi 1 -->

					<?php 
						$CI =& get_instance();
						$CI->load->model('pohon_kerja_model');
						$IKU = array();
						$modal = 0;
						foreach ($misi as $m) {
							echo '
							<li id="node1">
								<div class="panel panel-primary" > 
									<div class="panel-heading"> 
										Misi
									</div> 
									<div class="panel-body"> 
										'.$m->misi.'
									</div> 
								</div>
								<ul>';

								
								$dataSS = $CI->pohon_kerja_model->getTujuan($m->id_misi);

								foreach ($dataSS as $ss) {

										echo '
											<li id="node11">
												<div class="panel panel-success"> 
													<div class="panel-heading" >								
														Sasaran Strategis
													</div> 
													<div class="panel-body">'.$ss->tujuan.'</div>

												</div>

												<ul>';
										$dataSP = $CI->pohon_kerja_model->getSasaranRPJMD($ss->id_tujuan);
										//echo "<li>"; print_r($paramSP); echo"</li>";
										foreach ($dataSP as $sp) {
												$dataInd = $CI->pohon_kerja_model->getIndikatorRPJMD($sp->id_sasaran_rpjmd
);

											echo '

											<li id="node11">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
													</div> 
													<div class="panel-body">'.$sp->sasaran_rpjmd
.'</div>
													<table class="table table-bordered">';

										foreach ($dataInd as $ind) {
											echo'
														<tr>
															<td>
															<small><b>Indikator</b></small><br>
															'.$ind->nama_indikator.'</td>
															<td>
															<small><b>Target</b></small><br>'.$ind->target.' '.$ind->satuan.'</td>
														</tr>
														<tr>
														<td colspan="2">
															<small><b>Unit Penanggung Jawab</b></small><br>'.$ind->nama_unit_kerja.'</td>
														</tr>';
													}
														echo'
													</table>
												</div>
												<ul >';


												$paramSK = array('sasaran_kegiatan.id_sasaran_program' => $sp->id_sasaran_program);
												$dataSK = $CI->sasaran_kegiatan_model->getData($paramSK);
												foreach ($dataSK as $sk) {

													$paramInd = array(
														'type'	=> "SK",
														'id_sasaran'	=> $sk->id_sasaran_kegiatan,
													);
													$dataInd = $CI->indikator_model->getIndikator($paramInd);


													

											echo '
													<!-- Sasaran Kegiatan -->
													<li id="node11">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
															</div> 
															<div class="panel-body">'.$sk->sasaran_kegiatan.'</div>
													<table class="table table-bordered">';

										foreach ($dataInd as $ind) {
											echo'
														<tr>
															<td>
															<small><b>Indikator</b></small><br>
															'.$ind->nama_indikator.'</td>
															<td>
															<small><b>Target</b></small><br>'.$ind->target.' '.$ind->satuan.'</td>
														</tr>
														<tr>
														<td colspan="2">
															<small><b>Unit Penanggung Jawab</b></small><br>'.$ind->nama_unit_kerja.'</td>
														</tr>';
													}
														echo'
													</table>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->
													';
												}
											echo '

												</ul>	
											</li>
											';
										}

									echo '
											</ul>
										</li>';
								}

							echo'
								</ul>
							</li>
							';
						}
					?>	
						</ul>

					</li>

				</ul>
					<div id="tree-view"></div>    
				</div>
				<?php 
					//echo "<pre>";print_r($IKU); echo "</pre>";
				?>
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
				</script>
			</div>
			<!-- .row -->

		</div>



