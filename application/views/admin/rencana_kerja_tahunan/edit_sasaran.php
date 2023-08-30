 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Edit Sasaran</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
 				<li class="active">Edit Sasaran</li>
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
 					<?php if($_type=="SS"){?>
 					<div class="form-group">
 						<label class="control-label">Sasaran Strategis Induk</label>
 						<select name="id_ss_induk" class="form-control" disabled>
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_strategis as $r){
 								$selected = ($editdata[0]->id_ss_induk == $r->id_sasaran_strategis) ? "selected" : "";
 								echo'<option '.$selected.' value="'.$r->id_sasaran_strategis.'">'.$r->kode_sasaran_strategis.' - '.$r->sasaran_strategis.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					<?php }
 					else if($_type=="SP"){?>
 					<div class="form-group">
 						<label class="control-label">Sasaran Program Induk</label>
 						<select name="id_sp_induk" class="form-control" disabled>
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_program as $r){
 								$selected = ($editdata[0]->id_sp_induk == $r->id_sasaran_program) ? "selected" : "";
 								echo'<option '.$selected.' value="'.$r->id_sasaran_program.'">'.$r->kode_sasaran_program.' - '.$r->sasaran_program.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					<?php }
 					else {?>
 					<div class="form-group">
 						<label class="control-label">Sasaran Kegiatan Induk</label>
 						<select name="id_sk_induk" class="form-control" disabled>
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_kegiatan as $r){
 								$selected = ($editdata[0]->id_sk_induk == $r->id_sasaran_kegiatan) ? "selected" : "";
 								echo'<option '.$selected.' value="'.$r->id_sasaran_kegiatan.'">'.$r->kode_sasaran_kegiatan.' - '.$r->sasaran_kegiatan.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					<?php } ?>
					    <input type="hidden" name="level_unit_kerja" value="<?= $editdata[0]->level_unit_kerja ;?>" />
					    <input type="hidden" name="id_unit_kerja" value="<?= $editdata[0]->id_unit_kerja;?>" />


					<div class="form-group">
 						<label class="control-label">Indikator Induk</label>
 						<select name="id_indikator_induk" id="id_indikator_induk" class="form-control" disabled>
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($indikator_induk as $r){
 								$selected = ($editdata[0]->id_indikator_induk == $r->id_indikator) ? "selected" : "";
 								echo'<option '.$selected.' value="'.$r->id_indikator.'">'.$r->nama_indikator.'</option>';
 							}
 							?>
 						</select>
 					</div>

 					


 					<div class="form-group">
 						<label class="control-label">SS Atasan</label>
 						<select name="ss_atasan" id="ss_atasan" class="form-control" onchange="getSSAtasan()" disabled>
					      
					      <?php
					      echo '<option value="">Pilih</option>';
					  	if($editdata[0]->id_sasaran_strategis == null){ 
					  		
					      foreach($ss_atasan as $ss){
					        echo'<option value="'.$ss->id_sasaran.'-'.$ss->type.'-'.$ss->metode.'">'.$ss->kode.' - '.$ss->nama_sasaran.'</option>';
					      }
					  	}
					  	else{
					  		if($editdata[0]->level_unit_kerja==1){
					  			echo'<option value="'.$editdata[0]->id_sasaran_strategis.'-SS-'.$editdata[0]->metode.'">'.$editdata[0]->kode_sasaran_strategis.' - '.$editdata[0]->sasaran_strategis.'</option>'; 
					  		}
					  		else if($editdata[0]->level_unit_kerja>1){
					  			echo'<option value="'.$editdata[0]->id_sasaran_program.'-SP-'.$editdata[0]->metode.'">'.$editdata[0]->kode_sasaran_program.' - '.$editdata[0]->sasaran_program.'</option>'; 
					  		}
					  	}
					      ?>
 						</select>
 						<input type="hidden" value="" name="id_sasaran_atasan" id ="id_sasaran_atasan" />
 					</div>







 					<div class="form-group">
 						<label class="control-label">Kode  SS</label>
 						<input <?= (isset($editdata[0]->metode)&&$editdata[0]->metode=="AL") ? "disabled" : "" ;?> name="kode_sasaran" id="kode_sasaran" type="text" value="<?= $kode_sasaran;?>"  class="form-control" placeholder="">
 					</div>


 					<div class="form-group">
 						<label class="control-label">Nama Sasaran</label>
 						<input <?= (isset($editdata[0]->metode)&&$editdata[0]->metode=="AL") ? "disabled" : "" ;?> name="nama_sasaran" id="nama_sasaran" type="text" value="<?= $nama_sasaran;?>"  class="form-control" placeholder="">
 					</div>

 					<div class="form-group">
 						<label class="control-label">Deskripsi Sasaran</label>
 						<textarea <?= (isset($editdata[0]->metode)&&$editdata[0]->metode=="AL") ? "disabled" : "" ;?> class="form-control" name="deskripsi_sasaran"  id="deskripsi_sasaran"><?= $editdata[0]->deskripsi;?></textarea>
 					</div>

 									<div class="form-group">
 										<label class="control-label">Target</label>
 						<textarea <?= (isset($editdata[0]->metode)&&$editdata[0]->metode=="AL") ? "disabled" : "" ;?> class="form-control" name="target"  id="target"><?= (!empty($target[0]->target)) ? $target[0]->target : "";?></textarea>
 									</div>






 					




 				</div>
 				<div class="pull-right">
 					<a href="<?=base_url('rencana_kerja_tahunan')?>/detail_unitkerja/<?= $id_rkt ;?>" class="btn btn-default ">Batal</a>
 					<?php if(isset($editdata[0]->metode)&&$editdata[0]->metode!="AL"){ 
 						echo '<button type="submit" class="btn btn-danger " ></i> Ubah</button>'; }?>
 				</div>
 			</div> 
 			

 		</div>

 		<form>


 		</div>
 		<script type="text/javascript">
 			function getSSAtasan()
 			{
 				var ss_atasan = $("#ss_atasan").val();
 				if(ss_atasan!=""){
	 				var res = ss_atasan.split("-");
	 				var id_sasaran_atasan = res[0];
	 				var type = res[1];
	 				var metode = res[2];
	 				$("#id_sasaran_atasan").val(id_sasaran_atasan);
	 				if(metode=="AL")
	 				{
	 					document.getElementById("kode_sasaran").disabled = true;
	 					document.getElementById("nama_sasaran").disabled = true;
	 					document.getElementById("deskripsi_sasaran").disabled = true;
	 				}
	 				$.post("<?= base_url();?>/rencana_kerja_tahunan/getss",
	 					{
	 						'id_sasaran' : id_sasaran_atasan,
	 						'type'		 : type,
	 					},
	 					function(result)
	 					{
	 						var jData = JSON.parse(result);
	 						var data = jData.data;
	 						//console.log(data[0]['sasaran_program']);
	 						var kode_sasaran = "";
	 						var nama_sasaran = "";
	 						var deskripsi_sasaran = data[0]['deskripsi'];
	 						if(type=="SS"){
	 							kode_sasaran = data[0]['kode_sasaran_strategis'];
	 							nama_sasaran = data[0]['sasaran_strategis'];
	 						}
	 						else if(type=="SP"){
	 							kode_sasaran = data[0]['kode_sasaran_program'];
	 							nama_sasaran = data[0]['sasaran_program'];
	 						}
	 						else if(type=="SK"){
	 							kode_sasaran = data[0]['kode_sasaran_kegiatan'];
	 							nama_sasaran = data[0]['sasaran_kegiatan'];
	 						}
	 						document.getElementById("kode_sasaran").value = kode_sasaran;
		 					document.getElementById("nama_sasaran").value = nama_sasaran;
			 				document.getElementById("deskripsi_sasaran").value = deskripsi_sasaran;
	 					});
 				}
 				else{
 					document.getElementById("kode_sasaran").disabled = false;
 					document.getElementById("nama_sasaran").disabled = false;
	 				document.getElementById("deskripsi_sasaran").disabled = false;
	 				document.getElementById("kode_sasaran").value = "";
 					document.getElementById("nama_sasaran").value = "";
	 				document.getElementById("deskripsi_sasaran").value = "";
 				}
 			}
 		</script>


