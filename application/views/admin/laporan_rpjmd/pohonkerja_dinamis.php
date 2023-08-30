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
								Visi
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
						$CI->load->model('sasaran_strategis_model');
						$CI->load->model('sasaran_program_model');
						$CI->load->model('sasaran_kegiatan_model');
						$CI->load->model('indikator_model');
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

								
								$dataSS = $CI->sasaran_strategis_model->getByMisi($m->id_misi,$tahun_rkt);

								foreach ($dataSS as $ss) {
									echo '
								<li id="node11">
									<div class="panel panel-success"> 
										<div class="panel-heading" >								
											Sasaran Strategis
											<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".modal'.$modal.'"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
										</div> 
										<div class="panel-body">'.$ss->sasaran_strategis.'</div>
									</div>

									<ul>';

										$paramInd = array(
											'type'	=> "SS",
											'id_sasaran'	=> $ss->id_sasaran_strategis,
										);
										$dataInd = $CI->indikator_model->getIndikator($paramInd);
										$data_iku = array();
										$i = 0;
										foreach ($dataInd as $ind) {
											$temp = array();
											$temp['nomor'] = ($i+1);
											$temp['kode_indikator'] = $ind->kode_indikator;
											$temp['nama_indikator'] = $ind->nama_indikator;
											$temp['target'] = $ind->target;
											$temp['satuan'] = $ind->satuan;
											$temp['nama_unit_kerja'] = $ind->nama_unit_kerja;

											$params3 = array(
												'type'	=> 'SS',
												'where'	=> array(
													'indikator_turunan.uid_iku_atasan' => $ind->uid_iku,
												)
											);
											$indikator_bawahan = $CI->indikator_model->getIndikatorTurunan($params3);
											$cascading = "<ol>";
											foreach ($indikator_bawahan as $row) {
								                $cascading .= "<li>".$row->nama_unit_kerja."</li>";
								              }
											$cascading .= "</ol>";

											$temp['cascading'] = $cascading;
											$data_iku[$i] = $temp;
											$i++;
										}
										$IKU[$modal] = $data_iku;
										$modal++;

										// NEW
										$param2 = array(
											'type'	=> 'SS',
											//'type_bawahan' => $type_bawahan,
											'level_unit_kerja' => -1,
											'where'	=> array(
												'indikator_turunan.uid_ss_atasan' => $ss->uid_ss,
											),

										);
										$SS_Bawahan = $CI->indikator_model->getIndikatorTurunan($param2,"indikator_turunan.uid_ss_bawahan is not null");
										//echo "<li>"; print_r($param2); echo"</li>";
								foreach ($SS_Bawahan as $ss_bawahan) {
											
								echo '
									<li id="node11">
										<div class="panel panel-success"> 
											<div class="panel-heading" >								
												Sasaran Strategis
												<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".modal'.$modal.'"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
											</div> 
											<div class="panel-body">'.$ss_bawahan->nama_sasaran_bawahan.'</div>
										</div>

										<ul>';

										$paramInd = array(
											'type'	=> "SS",
											'id_sasaran'	=> $ss_bawahan->id_sasaran_bawahan,
										);
										$dataInd = $CI->indikator_model->getIndikator($paramInd);
										$data_iku = array();
										$i = 0;
										foreach ($dataInd as $ind) {
											$temp = array();
											$temp['nomor'] = ($i+1);
											$temp['kode_indikator'] = $ind->kode_indikator;
											$temp['nama_indikator'] = $ind->nama_indikator;
											$temp['target'] = $ind->target;
											$temp['satuan'] = $ind->satuan;
											$temp['nama_unit_kerja'] = $ind->nama_unit_kerja;

											$params3 = array(
												'type'	=> 'SS',
												'where'	=> array(
													'indikator_turunan.uid_iku_atasan' => $ind->uid_iku,
												)
											);
											$indikator_bawahan = $CI->indikator_model->getIndikatorTurunan($params3);
											$cascading = "<ol>";
											foreach ($indikator_bawahan as $row) {
								                $cascading .= "<li>".$row->nama_unit_kerja."</li>";
								              }
											$cascading .= "</ol>";

											$temp['cascading'] = $cascading;
											$data_iku[$i] = $temp;
											$i++;
										}
										$IKU[$modal] = $data_iku;
										$modal++;


										$paramSP = array('sasaran_program.id_sasaran_strategis' => $ss_bawahan->id_sasaran_bawahan);
										$dataSP = $CI->sasaran_program_model->getData($paramSP);
										//echo "<li>"; print_r($paramSP); echo"</li>";

										foreach ($dataSP as $sp) {
											echo '

											<li id="node11">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
														<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".modal'.$modal.'"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
													</div> 
													<div class="panel-body">'.$sp->sasaran_program.'</div>
												</div>
												<ul >';

												$paramInd = array(
													'type'	=> "SP",
													'id_sasaran'	=> $sp->id_sasaran_program,
												);
												$dataInd = $CI->indikator_model->getIndikator($paramInd);
												$data_iku = array();
												$i = 0;
												foreach ($dataInd as $ind) {
													$temp = array();
													$temp['nomor'] = ($i+1);
													$temp['kode_indikator'] = $ind->kode_indikator;
													$temp['nama_indikator'] = $ind->nama_indikator;
													$temp['target'] = $ind->target;
													$temp['satuan'] = $ind->satuan;
													$temp['nama_unit_kerja'] = $ind->nama_unit_kerja;

													$params3 = array(
														'type'	=> 'SP',
														'where'	=> array(
															'indikator_turunan.uid_iku_atasan' => $ind->uid_iku,
														)
													);
													$indikator_bawahan = $CI->indikator_model->getIndikatorTurunan($params3);
													$cascading = "<ol>";
													foreach ($indikator_bawahan as $row) {
										                $cascading .= "<li>".$row->nama_unit_kerja."</li>";
										              }
													$cascading .= "</ol>";

													$temp['cascading'] = $cascading;
													$data_iku[$i] = $temp;
													$i++;
												}
												$IKU[$modal] = $data_iku;
												$modal++;

												$paramSK = array('sasaran_kegiatan.id_sasaran_program' => $sp->id_sasaran_program);
												$dataSK = $CI->sasaran_kegiatan_model->getData($paramSK);
												foreach ($dataSK as $sk) {
													

											echo '
													<!-- Sasaran Kegiatan -->
													<li id="node11">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".modal'.$modal.'"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body">'.$sk->sasaran_kegiatan.'</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->
													';

													$paramInd = array(
														'type'	=> "SK",
														'id_sasaran'	=> $sk->id_sasaran_kegiatan,
													);
													$dataInd = $CI->indikator_model->getIndikator($paramInd);
													$data_iku = array();
													$i = 0;
													foreach ($dataInd as $ind) {
														$temp = array();
														$temp['nomor'] = ($i+1);
														$temp['kode_indikator'] = $ind->kode_indikator;
														$temp['nama_indikator'] = $ind->nama_indikator;
														$temp['target'] = $ind->target;
														$temp['satuan'] = $ind->satuan;
														$temp['nama_unit_kerja'] = $ind->nama_unit_kerja;

														$params3 = array(
															'type'	=> 'SK',
															'where'	=> array(
																'indikator_turunan.uid_iku_atasan' => $ind->uid_iku,
															)
														);
														$indikator_bawahan = $CI->indikator_model->getIndikatorTurunan($params3);
														$cascading = "<ol>";
														foreach ($indikator_bawahan as $row) {
											                $cascading .= "<li>".$row->nama_unit_kerja."</li>";
											              }
														$cascading .= "</ol>";

														$temp['cascading'] = $cascading;
														$data_iku[$i] = $temp;
														$i++;
													}
													$IKU[$modal] = $data_iku;
													$modal++;
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

	<?php 
		foreach ($IKU as $modal => $data_iku) {
			echo '
				<div class="modal fade bs-example-modal-lg modal'.$modal.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header" style="border-color: #3e4d6c;;background-color: #3e4d6c">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myLargeModalLabel" style="color:#ffffff">Indikator Kinerja Utama</h4>
							</div>
							<div class="modal-body">
								<table class="table table-bordered table-hover" style="margin-bottom: 15px;">
									<thead class="active">
										<tr class="info">
											<th width="60px">No</th>
											<th>Kode</th> <th>Nama</th>
											<th>Target </th>
											<th>Satuan</th>
											<th>Unit Penanggung Jawab</th>
											<th>Cascading </th>
										</tr>
									</thead>
									<tbody>';
									foreach ($data_iku as $row) {
										

										echo '
										<tr>
											<td>'.$row['nomor'].'</td>
											<td>'.$row['kode_indikator'].'</td>
											<td>'.$row['nama_indikator'].'</td>
											<td>'.$row['target'].'</td>
											<td>'.$row['satuan'].'</td>
											<th>'.$row['nama_unit_kerja'].'</th>
											<th>'.$row['cascading'].'</th>
										</tr>';
									}
				echo '						
									</tbody>
									<!----></table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>

			';			
		}
	?>
				

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



