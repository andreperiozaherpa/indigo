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
								Terwujudnya Pemandu Penanaman Modal dan Pelayanan Perizinan yang Prima Tahun 2018 
							</div> 
						</div>
						<!-- end visi -->
						<ul>
							<!--- Level 1 -->
							<!-- Misi 1 -->
							<li id="node1">
								<div class="panel panel-primary" > 
									<div class="panel-heading"> 
										Misi
									</div> 
									<div class="panel-body"> 
										Melaksanakan pelayanan perizinan usaha yang prima dan terintegrasi dengan regulasi, promosi dan kerjasama
									</div> 
								</div>
								<ul>
									<!-- Sasaran Strategis -->
									<li id="node11">
										<div class="panel panel-success"> 
											<div class="panel-heading" >								
												Sasaran Strategis
												<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
											</div> 
											<div class="panel-body"> Meningkatnya Investasi di Kabupaten Sumedang </div>
										</div>

										<ul>
											<!-- Sasaran Program -->
											<li id="node11">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
														<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
													</div> 
													<div class="panel-body"> Meningkatnya Iklim Investasi dan Realisasi Investasi  </div>
												</div>
												<ul >
													<!-- Sasaran Kegiatan -->
													<li id="node11">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body"> Terlaksananya Penyusunan Kebijakan Pelayanan  </div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

													<!-- Sasaran Kegiatan -->
													<li id="node11">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body"> Terlaksananya Pemantauan, pembinaan, pengawasan, dan pengendalian kegiatan penanaman modal dan perizinan  </div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->


												</ul>	
											</li>
											<!-- End Sasaran Program -->

											<!-- Sasaran Program -->
											<li id="node17">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
														<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
													</div> 
													<div class="panel-body"> Meningkatnyua promosi dan kerjasama Investasi  </div>
												</div>
												<ul>
													<!-- Sasaran Kegiatan -->
													<li id="node18">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body"> Terlaksananya Pembuatan Dokumen Daya Tarik Daerah dan Pameran Peluang Investasi Unggulan daerah </div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

													<!-- Sasaran Kegiatan -->
													<li id="node19">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body" > Terlaksananya Peningkatan Kerjasama Investasi</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

												</ul>
											</li>
											<!-- End Sasaran Program -->


										</ul>
									</li>
									<!-- end Sasaran Strategis -->

								</ul>
							</li>
							<!-- end Misi 1 --> 

							<!-- Misi 2 -->
							<li id="node2">
								<div class="panel panel-primary" > 
									<div class="panel-heading"> 
										Misi
									</div> 
									<div class="panel-body"> 
										Melaksanakan pelayanan yang lebih adil bagi segenap usaha
									</div> 
								</div>
								<ul>

									<!-- Sasaran Strategis -->
									<li id="node21">
										<div class="panel panel-success" > 
											<div class="panel-heading" >								
												Sasaran Strategis
												<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
											</div> 
											<div class="panel-body">Meningkatnya Kualitas Pelayanan Perizinan dan Non Perizinan di Kabupaten Sumedang </div>
										</div>
										<ul>
											<!-- Sasaran Program -->
											<li id="node11">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
														<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
													</div> 
													<div class="panel-body"> Meningkatnya Pelayanan Perijinan </div>
												</div>
												<ul >
													<!-- Sasaran Kegiatan -->
													<li id="node19">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body" > Terlaksananya Peningkatan Pelayanan Perizinan</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

													<!-- Sasaran Kegiatan -->
													<li id="node19">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body" > Terlaksananya Peningkatan Pengendalian dan Penanganan Pengaduan PTSP</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

													<!-- Sasaran Kegiatan -->
													<li id="node19">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body" > Terlaksananya Pengelolaan Data dan Pelaporan Penyelenggaraan PTSP</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->

													<!-- Sasaran Kegiatan -->
													<li id="node19">
														<div class="panel panel-warning" > 
															<div class="panel-heading" >								
																Sasaran Kegiatan
																<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
															</div> 
															<div class="panel-body" > Terseleggaranya Optimalisasi Penyelenggaraan Pelayanan Terpadu Satu Pintu Secara Elektronik</div>
														</div>
													</li>
													<!-- End Sasaran Kegiatan -->
												</ul>
											</li>
											<!-- End Sasaran Program -->

											<!-- Sasaran Program -->
											<li id="node11">
												<div class="panel panel-info" > 
													<div class="panel-heading" >								
														Sasaran Program
														<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
													</div> 
													<div class="panel-body"> Tersedianya Potensi Sumber Daya, sarana dan Prasarana Daerah</div>
												</div>
											</li>
											<!-- End Sasaran Program -->
											<ul>	
												<!-- Sasaran Kegiatan -->
												<li id="node19">
													<div class="panel panel-warning" > 
														<div class="panel-heading" >								
															Sasaran Kegiatan
															<div class="panel-action"> <a href="#" style="margin-left: 4px;"  data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn btn-default btn-circle btn-xs btn-outline" style="margin-top: -4px;margin-left: 4px; "><i class="fa fa-list" style="margin-right: 6px;"></i> </button></a></div>
														</div> 
														<div class="panel-body" > Terselenggaranya  Sistem Informasi Penanaman Modal </div>
													</div>
												</li>
												<!-- End Sasaran Kegiatan -->

											</ul>


										</ul>
									</li>
									<!-- end Sasaran Strategis -->


								</ul>	
							</li>
							<!-- end Misi 2 --> 


						</ul>

					</li>

				</ul>


				<!-- sample modal content -->
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
											<th>Target 2019</th>
											<th>Target 2020</th>
											<th>Target 2021</th>
											<th>Target 2022</th>
											<th>Satuan</th>
											<th>Unit Penanggung Jawab</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>01</td>
											<td>Persentase meningkatnya daya tangkal masyarakat dari pengaruh radikal terorisme</td>
											<td>50</td>
											<td>60</td>
											<td>70</td>
											<td>80</td>
											<td>persen</td>
											<th>Bidang Perizinan, Bidang Promosi</th>
										</tr>
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



