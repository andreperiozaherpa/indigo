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
 						<label class="control-label">Ref. Renstra</label>
 						<select name="id_renstra" class="form-control">
 							<option value="">Pilih Renstra</option>
 							<?php 
 							foreach($renstra as $r){
 								echo'<option value="'.$r->id_renstra.'">'.$r->renstra.'</option>';
 							}
 							?>
 						</select>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Unit Kerja</label>
					    <select name="id_unit_kerja" class="form-control">
					      <option value="">Pilih Unit Kerja</option>
					      <?php 
					      foreach($unit_kerja as $r){
					      	if ($this->session->userdata('unit_kerja_id')>0) {
					      		if ($this->session->userdata('unit_kerja_id') == $r->id_unit_kerja) {
					      			echo'<option value="'.$r->id_unit_kerja.'" selected>'.$r->nama_unit_kerja.'</option>';
					      		}
					      	} else {
					      		echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
					      	}
					        
					      }
					      ?>
					    </select>
 					</div>




 					<div class="form-group">
 						<label class="control-label">Tahun</label>
 						<select name="tahun_rkt" class="form-control">
 							<option value="">Pilih Tahun</option>
 							<?php 
 							$year = date('Y');
 							for ($i=$year-10; $i < $year+10 ; $i++) { 
 								echo'<option value="'.$i.'">'.$i.'</option>';
 							}
 							?>
 						</select>
 					</div>


 					<div class="form-group">
 						<label class="control-label">SS Atasan</label>
 						<select name="id_renstra" class="form-control">
					      <option value="">Pilih SS Atasan</option>
					      <?php 
					      foreach($ss_atasan as $ss){
					        echo'<option value="'.$ss->id_rkt_sasaran.'">'.$ss->kode_ss.' - '.$ss->nama_unit_kerja.'</option>';
					      }
					      ?>
 						</select>
 					</div>







 					<div class="form-group">
 						<label class="control-label">Kode  SS</label>
 						<input name="nama_kegiatan" type="text"  class="form-control" placeholder="">
 					</div>


 					<div class="form-group">
 						<label class="control-label">Nama Sasaran</label>
 						<input name="nama_kegiatan" type="text"  class="form-control" placeholder="">
 					</div>

 					<div class="form-group">
 						<label class="control-label">Deskripsi Sasaran</label>
 						<textarea class="form-control"></textarea>
 					</div>





 					




 				</div>
 			</div> 

 			<div class="col-md-6">
 				<div class="white-box">
 					<div class="row">

 						<div class="col-md-12">
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
 										<tr><th>Unit Kerja</th><th>Penanggung Jawab<th></tr>
 										</thead>
 										<tbody>
									      <?php 
									      foreach($unit_kerja as $r){
									      	if ($this->session->userdata('unit_kerja_id')>0) {
									      		if (in_array($this->session->userdata('unit_kerja_id'), explode("|", $r->ket_induk))) {
									      			echo'<tr><td>'.$r->nama_unit_kerja.'</td><td><input type="checkbox" name=""><td></tr>';
									      		}
									      	} else {
									        	echo'<tr><td>'.$r->nama_unit_kerja.'</td><td><input type="checkbox" name=""><td></tr>';
									    	}
									      }
									      ?>


 										</tbody>	
 									</table>
 						</div>

 						

 						
		
 					</div>

 				</div>
 				<div class="pull-right">
 					<a href="<?=base_url('rencana_kerja_tahunan')?>" class="btn btn-default ">Batal</a>
 					 <button type="submit" class="btn btn-danger " ></i> Simpan</button>
 				</div>
 			</div>



 		</div>

 		<form>


 		</div>


