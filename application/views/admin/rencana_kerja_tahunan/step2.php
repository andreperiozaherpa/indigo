 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Rencana Kerja Tahunan (langkah 2)</h4>
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
 						<table class="table">
 							<tr><td>No.</td><td>Satuan Kerja</td><td>Diturunkan</td><td>Penanggung Jawab</td></tr>
 							<tr><td>1</td><td>Unit Kerja 1</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 2</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 3</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 4</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 5</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 6</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 							<tr><td>1</td><td>Unit Kerja 7</td><td><input id="checkbox33" type="checkbox"></td><td><input id="checkbox33" type="checkbox"></td></tr>
 						</table>
 					
 				</div> 
 			</div>
 			<div class="col-md-6">
 				<div class="white-box">
 					<div class="row">

 						<div class="col-md-12">
 							<table class="table">
 							<tr><td>Triwulan </td><td>Target</td></tr>
 							<tr><td>1</td><td><input type="text" class="form-control"></td></tr>
 							<tr><td>2</td><td><input type="text" class="form-control"></td></tr>
 							<tr><td>3</td><td><input type="text" class="form-control"></td></tr>

 							
 						</table>
 						</div>

 						<div class="col-md-12">
 							<div class="form-group">
 								<label class="control-label">Catatan</label>
 								<textarea class="form-control">	
 								</textarea>
 							</div>
 						</div>

 						
		
 					</div>

 				</div>
 				<div class="pull-right">
 					<a href="<?=base_url('rencana_kerja_tahunan')?>" class="btn btn-default ">Batal</a>
 					<a href="<?=base_url('rencana_kerja_tahunan/step3')?>" > <button type="button" class="btn btn-danger " ></i> Simpan</button></a>
 				</div>
 			</div>



 		</div>

 		<form>


 		</div>


