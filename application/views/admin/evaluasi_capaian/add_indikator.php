 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Rencana Kerja Tahunan</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="#">Dashboard</a></li>
 				<li class="active">Starter Page</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>


 	<!-- .row -->

 	<div class="row">  
 		<?php if (!empty($message)) echo "
 		<div class='alert alert-$message_type'>$message</div>";?>
 		<form method="POST">
 			<div class="row">
 				<div class="col-sm-12">
 					<div class="white-box">
 						<h3 class="box-title m-b-0">Indikator Kinerja Utama</h3>
 						<p class="text-muted m-b-30 font-13"> Silakan isi form dibawah ini</p>
 						<div id="exampleBasic" class="wizard">
 							<ul class="wizard-steps" role="tablist">
 								<li class="active" role="tab">
 									<h4><span>1</span>IKU</h4>
 								</li>
 							
 								<li role="tab">
 									<h4><span>2</span>Cascading</h4>
 								</li>

 								

 							</ul>
 							<div class="wizard-content">
 								<div class="wizard-pane active" role="tabpanel">
 									<div class="form-group">
 										<label class="control-label">IKU Atasan</label>
 										<select name="id_renstra" class="form-control">
 											<option value="">IKU 1 </option>
 											<option value="">IKU 2 </option>
 											<option value="">IKU 3 </option>

 										</select>
 									</div>
 									

 									<div class="form-group">
 										<label class="control-label">Kode  IKU</label>
 										<input name="nama_kegiatan" type="text"  class="form-control" placeholder="">
 									</div>

 									<div class="form-group">
 										<label class="control-label">Nama IKU</label>
 										<input name="nama_kegiatan" type="text"  class="form-control" placeholder="">
 									</div>

 									<div class="form-group">
 										<label class="control-label">Deskipsi IKU</label>
 										<textarea class="form-control"></textarea>
 									</div>
 									<div class="form-group">
 										<label class="control-label">Satuan IKU</label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Satuan 1 </option>
 											<option value="">Satuan 2 </option>
 											<option value="">Satuan 3</option>
 										</select>
 									</div>

 									<div class="form-group">
 										<label class="control-label">Frekuensi Waktu</label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Bulanan </option>
 											<option value="">Semester </option>
 											<option value="">Tahunan</option>
 										</select>
 									</div>

 									<div class="form-group">
 										<label class="control-label">Perhitungan Ke atasan</label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Akumulasi </option>
 											<option value="">Kontribusi </option>
 											<option value="">Sama Persis</option>
 											<option value="">Rata-rata</option>
 										</select>
 									</div>
 									<div class="form-group">
 										<label class="control-label">Cara Perhitungan</label>
 										<textarea class="form-control"></textarea>
 									</div>

 									<div class="form-group">
 										<label class="control-label">Validasi </label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Lead Input </option>
 											<option value="">Lead Proses </option>
 											<option value="">Lag Output</option>
 											<option value="">Lag Outcome</option>
 										</select>
 									</div>

 									<div class="form-group">
 										<label class="control-label">Polarisasi </label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Maximize </option>
 											<option value="">Minimize </option>
 											<option value="">Stabilize</option>
 											
 										</select>
 									</div>


 									

 									





 								</div>
 								

 								<div class="wizard-pane" role="tabpanel">

 									<div class="form-group">
 										<label class="control-label">Metode Cascading</label>
 										<select name="id_renstra" class="form-control">
 											<option value="">Adobe Langsung </option>
 											<option value="">Komponen Pembentuk </option>
 											<option value="">Dipersempit</option>
 											<option value="">Tidak Diturunkan</option>
 										</select>
 									</div>

 									<table class="table">
 										<thead>
 										<tr><th>Unit Kerja</th><th>Penanggung Jawab<th><th>Diturunkan<th></tr>
 										</thead>
 										<tbody>
 										<tr><td>Unit Kerja 1 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>
 										<tr><td>Unit Kerja 2 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>
 										<tr><td>Unit Kerja 3 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>
 										<tr><td>Unit Kerja 4 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>
 										<tr><td>Unit Kerja 5 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>
 										<tr><td>Unit Kerja 6 </td><td><input type="checkbox" name=""><td><td><input type="checkbox" name=""><td></tr>


 										</tbody>	
 									</table>

 								</div>

 								
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<!-- /.row -->


 			<form>


 			</div>


