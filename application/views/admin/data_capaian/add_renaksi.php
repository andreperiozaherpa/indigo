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
 			<div class="col-md-6">
 				<div class="white-box">

 					<div class="form-group">
 						<label class="control-label">unit Kerja</label>
 						<select name="" class="form-control" disabled="">
 							<option value="">Unit Kerja 1</option>
 						</select>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Indikator Kinerja</label>
 						<select name="id_unit_kerja" class="form-control">
 							<option value="">IKU1 - Indikator Kinerja 1</option> 
 						</select>
 					</div>


 					<div class="form-group">
 						<label class="control-label">Output</label>
 						<select name="id_unit_kerja" class="form-control">
 							<option value="">O1 - Output Indikator Kinerja 1</option> 
 							<option value="">O2 - Output Indikator Kinerja 2</option> 
 							<option value="">O3 - Output Indikator Kinerja 3</option> 
 						</select>
 					</div>



 					<hr>


 					<div class="form-group">
 						<label class="control-label">Komponen</label>
 						<select name="id_unit_kerja" class="form-control">
 							<option value="">001 - Komponen 1</option> 
 							<option value="">001 - Komponen 2</option> 
 							<option value="">001 - Komponen 3</option> 
 						</select>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Sub. Komponen</label>
 						<select name="id_unit_kerja" class="form-control">
 							<option value="">001 - Sub.Komponen 1</option> 
 							<option value="">002 - Sub.Komponen 2</option> 
 							<option value="">003 - Sub.Komponen 3</option> 
 						</select>
 					</div>



 					<div class="form-group">
 						<label class="control-label">Jumlah Pagu</label>
 						<input name="" type="text"  class="form-control" placeholder="">
 					</div>


 					<div class="form-group">
 						<label class="control-label">Keterangan</label>
 						<textarea class="form-control"></textarea>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Satuan</label>
 						<select name="id_unit_kerja" class="form-control">
 							<option value="">Satuan 1</option> 
 							<option value="">Satuan 2</option> 
 							<option value="">Satuan 3</option> 
 						</select>
 					</div>





 					




 				</div>
 			</div> 

 			<div class="col-md-6">
 				<div class="white-box">
 					<div class="row">

 						<div class="col-md-12">
 							<table class="table">
 										<tr><td>Realisasi Kegiatan </td><td>Bulan </td><td>Target</td><td>Satuan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Januari</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Februari</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Maret</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Mei</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Juni</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Juli</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Agustus</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>September</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Oktober</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>November</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										<tr><td><input type="checkbox" checked class="js-switch"  data-color="#13dafe" /></td><td>Desember</td><td><input type="text" class="form-control"></td><td>Kegiatan</td></tr>
 										
 									</table>
 							</div>





 						</div>

 					</div>
 					<div class="pull-right">
 						<a href="<?=base_url('rencana_kerja_tahunan/detail_indikator')?>" class="btn btn-default ">Batal</a>
 						<button type="submit" class="btn btn-danger " ></i> Simpan</button>
 					</div>
 				</div>



 			</div>

 			<form>


 			</div>


