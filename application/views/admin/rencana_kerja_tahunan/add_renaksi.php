 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Tambah Renaksi</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
		        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
		            <li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
		            <li><a href="<?= base_url();?>/rencana_kerja_tahunan/detail_indikator/<?= $id_rkt.'/'.$id_indikator ;?>">Indikator</a></li>
		            <li class="active">Renaksi</li>
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
 						<label class="control-label">Unit Kerja</label>
					    <select name="id_unit_kerja" class="form-control">
					      <option value="<?= $rkt->id_unit_kerja;?>"><?= $rkt->nama_unit_kerja;?></option>
					    </select>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Indikator Kinerja</label>
 						<select name="id_indikator" class="form-control">
 							<option value="<?= $indikator[0]->id_indikator;?>"><?= $indikator[0]->id_indikator .' - '. $indikator[0]->nama_indikator;?></option> 
 						</select>
 					</div>

 					
 					


 					<div class="form-group">
 						<label class="control-label">Keterangan</label>
 						<textarea class="form-control" name="keterangan"></textarea>
 					</div>

 					<div class="form-group">
 						<label class="control-label">Satuan</label>
 						<select name="id_satuan" class="form-control">
 											<?php
 												echo "<option value='".$indikator[0]->id_satuan."'>".$indikator[0]->satuan."</option>";
 											?>
 						</select>
 					</div>





 					




 				</div>
 			</div> 

 			<div class="col-md-6">
 				<div class="white-box">
 					<div class="row">

 						<div class="col-md-12">
 							<table class="table">
 								<tr><td>Realisasi Kegiatan </td><td>Bulan </td><td>Target</td></tr>
 								<?php
 								foreach ($GLOBALVAR['bulan'] as $key => $value) {
 									echo '
 									<tr><td><input type="checkbox"  class="js-switch" name="bulan[]" id="bulan_'.$key.'" value="'.$key.'" data-color="#13dafe" /></td>
 									<td>'.$value.'</td><td><input  name="target['.$key.']" id="target_'.$key.'" type="text" class="form-control"></td></tr>
 								';
 								}
 								?>		
 							</table>
 							</div>





 						</div>

 					</div>
 					<div class="pull-right">
 						<a href="<?=base_url('rencana_kerja_tahunan/detail_indikator').'/'.$_type.'/'.$id_rkt.'/'.$id_indikator?>" class="btn btn-default ">Batal</a>
 						<button type="submit" class="btn btn-danger " ></i> Simpan</button>
 					</div>
 				</div>



 			</div>

 			<form>


 			</div>


