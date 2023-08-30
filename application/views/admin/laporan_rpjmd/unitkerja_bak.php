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
						<!-- unit kerja  -->
						<div class="white-box">
							<div class="row">
								<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

									<div data-label="70%" class="css-bar css-bar-70 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
								</a>
							</div>
							<div class="col-md-8 col-sm-8">
								<h3 class="box-title m-b-0">DMPTSP Kab. Sumedang</h3>
								<h4><span class="label label-danger m-l-5">75%</span> Capaian Kinerja</h4>
							</div>
						</div>
					</div>
					<!-- end unitkerja -->
					<ul>
						<!--- Level 1 -->
						<!-- Misi 1 -->
						<li id="node1">
							<!-- unit kerja  -->
							<div class="white-box">
								<div class="row">
									<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

										<div data-label="70%" class="css-bar css-bar-55 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
									</a>
								</div>
								<div class="col-md-8 col-sm-8">
									<h3 class="box-title m-b-0">Sekertariat</h3>
									<h4><span class="label label-danger m-l-5">55%</span> Capaian Kinerja</h4>
								</div>
							</div>
						</div>
						<!-- end unitkerja -->
						<ul>
							<!-- end unitkerja -->
							<li id="node11">
								<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="70%" class="css-bar css-bar-55 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Sub Bagian Program</h3>
										<h4><span class="label label-danger m-l-5">55%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- end unitkerja -->

						<!-- end unitkerja -->
							<li id="node11">
								<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="65%" class="css-bar css-bar-65 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Sub Bagian Umum, Aset dan Kepegawaian</h3>
										<h4><span class="label label-danger m-l-5">65%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- end unitkerja -->


						<!-- end unitkerja -->
							<li id="node11">
								<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Sub Bagian Keuangan</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- end unitkerja -->


					</ul>
				</li>
				<!-- end Misi 1 --> 

				<!-- Misi 2 -->
				<li id="node2">
					<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Bidang Perencanaan dan Pengembangan Iklim Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
					<ul>

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Perencanaan Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Pengembangan Iklim Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->



					</ul>	
				</li>
				<!-- end Misi 2 --> 

				<li id="node2">
					<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Bidang Promosi dan Fasilitasi Kemitraan Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
					<ul>

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Promosi Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Fasilitasi Kemitraan Penanaman Modal</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->
					</ul>	
				</li>
				<!-- end Misi 2 --> 


				<li id="node2">
					<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0"> Bidang Pengendalian, Penanganan Pengaduan, Data dan Pelaporan PTSP</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
					<ul>

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Pengendalian dan Penanganan Pengaduan PTSP</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->

						<!-- Unit Kerja -->
						<li id="node21">
							<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0">Seksi Data dan Pelaporan PTSP</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
						</li>
						<!-- Unit Kerja -->
						


					</ul>	
				</li>
				<!-- end Misi 2 --> 

				<li id="node2">
					<div class="white-box">
									<div class="row">
										<div class="col-md-4 col-sm-4 text-center"><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">

											<div data-label="30%" class="css-bar css-bar-30 css-bar-lg css-bar-danger"><img src="<?php echo base_url()."data" ;?>/icon/office.png" alt="unitkerja" class="img-circle"/></div>
										</a>
									</div>
									<div class="col-md-8 col-sm-8">
										<h3 class="box-title m-b-0"> Bidang Pelayanan Perizinan PTSP</h3>
										<h4><span class="label label-danger m-l-5">30%</span> Capaian Kinerja</h4>
									</div>
								</div>
							</div>
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



