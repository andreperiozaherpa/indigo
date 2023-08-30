 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Tambah Sasaran</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
 				<li class="active">Tambah Sasaran</li>
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
 						<select name="id_ss_induk" id="id_ss_induk" class="form-control" onchange="getIndikatorInduk()">
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_strategis as $r){
 								echo'<option value="'.$r->id_sasaran_strategis.'">'.$r->kode_sasaran_strategis.' - '.$r->sasaran_strategis.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					<?php }
 					else if($_type=="SP"){?>
 					<div class="form-group">
 						<label class="control-label">Sasaran Program Induk</label>
 						<select name="id_ss_induk" id="id_ss_induk" class="form-control" onchange="getIndikatorInduk()">
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_program as $r){
 								echo'<option value="'.$r->id_sasaran_program.'">'.$r->kode_sasaran_program.' - '.$r->sasaran_program.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					<?php }
 					else {?>
 					<div class="form-group">
 						<label class="control-label">Sasaran Kegiatan Induk</label>
 						<select name="id_ss_induk" id="id_ss_induk" class="form-control" onchange="getIndikatorInduk()">
 							<option value="0">Pilih</option>
 							<?php 
 							foreach($sasaran_kegiatan as $r){
 								echo'<option value="'.$r->id_sasaran_kegiatan.'">'.$r->kode_sasaran_kegiatan.' - '.$r->sasaran_kegiatan.'</option>';
 							}
 							?>
 						</select>
 					</div>
 					
 					<?php } ?>
 					<div class="form-group">
 						<label class="control-label">Indikator Induk</label>
 						<select name="id_indikator_induk" id="id_indikator_induk" class="form-control">
 							<option value="0">Pilih</option>
 							
 						</select>
 					</div>
					    <input type="hidden" name="level_unit_kerja" value="<?= $rkt->level_unit_kerja ;?>" />
					    <input type="hidden" name="id_unit_kerja" value="<?= $rkt->id_unit_kerja;?>" />

					<?php if(!empty($ss_atasanArr)){?>
 					<div class="form-group">
 						<label class="control-label">SS Atasan</label>
 						<select name="ss_atasan" id="ss_atasan" class="form-control" onchange="getSSAtasan()">
					      <option value="">Pilih</option>
					      <?php 
					      foreach($ss_atasanArr as $ss){
					        echo'<option value="'.$ss->id_sasaran_atasan.','.$ss->type_atasan.','.$ss->metode.','.$ss->uid_ss_atasan.'">'.$ss->kode_sasaran_atasan.' - '.$ss->nama_sasaran_atasan.'</option>';
					      }
					      ?>
 						</select>
 						<input type="hidden" value="" name="id_sasaran_atasan" id ="id_sasaran_atasan" />
 					</div>
 					<div class="form-group">
 						<label class="control-label">IKU Atasan</label>
 						<select name="uid_iku_atasan" id="uid_iku_atasan" class="form-control">
 							<option value="">Pilih</option>
 							
 						</select>
 					</div>
 					<?php } ?>





 					<div class="form-group">
 						<label class="control-label">Kode  SS</label>
 						<input name="kode_sasaran" id="kode_sasaran" type="text"  class="form-control" placeholder="" value="<?=$kode_sasaran;?>"  readonly>
 					</div>


 					<div class="form-group">
 						<label class="control-label">Nama Sasaran</label>
 						<input name="nama_sasaran" id="nama_sasaran" type="text"  class="form-control" placeholder="">
 					</div>

 					<div class="form-group">
 						<label class="control-label">Deskripsi Sasaran</label>
 						<textarea class="form-control" name="deskripsi_sasaran" id="deskripsi_sasaran"></textarea>
 					</div>


 									<div class="form-group">
 										<label class="control-label">Target</label>
 										<textarea class="form-control" name="target" id="target"></textarea>
 									</div>



 					




 				</div>
 				<div class="pull-right">
 					<a href="<?=base_url('rencana_kerja_tahunan')?>/detail_unitkerja/<?= $rkt->id_rkt ;?>" class="btn btn-default ">Batal</a>
 					 <button type="submit" class="btn btn-danger " ></i> Simpan</button>
 				</div>
 			</div> 
 			<!--
 			<div class="col-md-6">
 				<div class="white-box">
 					<div class="row">

 						<div class="col-md-12">
 							<div class="form-group">
 										<label class="control-label">Metode Cascading</label>
 										<select name="metode_penurunan" class="form-control">
 											<option value="">Pilih</option>
 											<?php
 												foreach ($metode_penurunanArr as $key => $value) {
 													$selected = ($metode_penurunan == $key) ? "selected" : "";
 													echo "<option value='$key' $selected>$value</option>";
 												}
 											?>
 										</select>
 									</div>

 									<table class="table">
 										<thead>
 										<tr><th>Unit Kerja</th><th>Penanggung Jawab<th></tr>
 										</thead>
 										<tbody>
									      <?php 
									      foreach($unit_kerja as $r){
									        echo'<tr><td>'.$r->nama_unit_kerja.'</td><td><input type="checkbox" name="unit_kerja_bawah[]" value="'.$r->id_unit_kerja.'"><td></tr>';
									      }
									      ?>


 										</tbody>	
 									</table>
 						</div>

 						

 						
		
 					</div>

 				</div>
 				
 			</div>

			-->

 		</div>

 		<form>


 		</div>



 		<script type="text/javascript">
 			function getSSAtasan()
 			{
 				var ss_atasan = $("#ss_atasan").val();
 				if(ss_atasan!=""){
	 				var res = ss_atasan.split(",");
	 				var id_sasaran_atasan = res[0];
	 				var type = res[1];
	 				var metode = res[2];
	 				var uid_ss_atasan = res[3];
	 				$("#id_sasaran_atasan").val(id_sasaran_atasan);
	 				console.log(uid_ss_atasan);
	 				if(metode=="AL")
	 				{
	 					document.getElementById("kode_sasaran").disabled = true;
	 					document.getElementById("nama_sasaran").disabled = true;
	 					document.getElementById("deskripsi_sasaran").disabled = true;
	 					document.getElementById("target").disabled = true;
	 				}
	 				$.post("<?= base_url();?>rencana_kerja_tahunan/getss",
	 					{
	 						'id_sasaran' : id_sasaran_atasan,
	 						'type'		 : type,
	 					},
	 					function(result)
	 					{
	 						var jData = JSON.parse(result);
	 						var data = jData.data;
	 						//console.log(result);
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
	 						// document.getElementById("kode_sasaran").value = kode_sasaran;
		 					// document.getElementById("nama_sasaran").value = nama_sasaran;
			 				// document.getElementById("deskripsi_sasaran").value = deskripsi_sasaran;
	 					});

 					$.post("<?= base_url();?>rencana_kerja_tahunan/getikuatasan",
			 			{
			 				'uid_ss_atasan' : uid_ss_atasan,
			 				'type' 			: "<?= $_type;?>",
			 				'id_unit_kerja'	: "<?= $rkt->id_unit_kerja;?>",
			 			},
			 			function(result)
			 			{
			 				//console.log(result);
			 				$("#uid_iku_atasan").html(result);
			 			}
		 			);
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
 			function getIndikatorInduk()
 			{
 				var id_ss_induk = $("#id_ss_induk").val();
 				var _type = "<?= $_type;?>";
 				$.post("<?= base_url();?>rencana_kerja_tahunan/getikuinduk",
		 			{
		 				'id_ss_induk' : id_ss_induk,
		 				'type'		 : _type,
		 			},
		 			function(result)
		 			{
		 				$("#id_indikator_induk").html(result);
		 			}
	 			);
	 			<?php if ($_type=="SS"): ?>
	 				<?php foreach ($sasaran_strategis as $r) { ?>
	 					nama_sasaran[<?=$r->id_sasaran_strategis?>] = '<?=$r->sasaran_strategis?>';
	 				<?php } ?>
	 			<?php elseif ($_type=="SP"): ?>
	 				<?php foreach ($sasaran_program as $r) { ?>
	 					nama_sasaran[<?=$r->id_sasaran_program?>] = '<?=$r->sasaran_program?>';
	 				<?php } ?>
	 			<?php else: ?>
	 				<?php foreach ($sasaran_kegiatan as $r) { ?>
	 					nama_sasaran[<?=$r->id_sasaran_kegiatan?>] = "<?=preg_replace('/\s+/', ' ', $r->sasaran_kegiatan);?>";
	 				<?php } ?>
	 			<?php endif ?>

	 						// document.getElementById("kode_sasaran").value = kode_sasaran;
		 					document.getElementById("nama_sasaran").value = nama_sasaran[id_ss_induk];
			 				document.getElementById("deskripsi_sasaran").value = nama_sasaran[id_ss_induk];

 			}
 		</script>


