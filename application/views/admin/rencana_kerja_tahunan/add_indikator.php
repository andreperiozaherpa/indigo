 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Tambah Indikator</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
		        <li><a href="<?= base_url();?>/admin">Dashboard</a></li>
		        <li><a href="<?= base_url();?>/rencana_kerja_tahunan">Rencana Kerja Tahunan</a></li>
		        <li><a href="<?= base_url();?>/rencana_kerja_tahunan/detail_sasaran/<?= $_type .'/'.$id_rkt.'/'.$id_sasaran ;?>">Detail Sasaran</a></li>
		        <li class="active">Tambah Indikator</li>
		      </ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>


 	<!-- .row -->

 	<div class="row">  
 		<?php if (!empty($message)) echo "
 		<div class='alert alert-$message_type'>$message</div>";?>
 		<form method="POST" id="mForm">
 			<div class="row">
 				<div class="col-sm-12">
 					<div class="white-box">
 						<h3 class="box-title m-b-0">Indikator Kinerja Utama</h3>
 						<p class="text-muted m-b-30 font-13"> Silakan isi form dibawah ini</p>
 						<div id="submit_wizard" class="wizard">
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
 										<select name="iku_atasan" id="iku_atasan" class="form-control" onchange="getIkuAtasan()" readonly>
 											<?php 
 											foreach ($indikator_atasan as $row) {
 												$selected = (!empty($iku_atasan) && $iku_atasan == $row->id_indikator_atasan) ? "selected" : "";
 												echo "<option $selected value='$row->uid_iku_atasan'>$row->kode_indikator_atasan - $row->nama_indikator_atasan</option>";
 											}
 											?>

 										</select>
 										<input type="hidden" name="id_indikator_atasan" id="id_indikator_atasan" value="<?= !empty($id_indikator_atasan) ? $id_indikator_atasan : "" ;?>" />
 									</div>
 									<div class="form-group">
 										<label class="control-label">Target IKU Atasan</label>
 										<input  name="target_indikator_atasan" id="target_indikator_atasan" type="text"  class="form-control" value="<?= !empty($indikator_atasan[0]->target_indikator_atasan) ? $indikator_atasan[0]->target_indikator_atasan : '' ;?>" readonly> 
 									</div>

 									<div class="form-group">
 										<label class="control-label">Kode  IKU</label>
 										<input  name="kode_indikator" id="kode_indikator" type="text"  class="form-control" value="<?= !empty($kode_indikator) ? $kode_indikator : $new_kode_indikator ;?>">
 									</div>

 									<div class="form-group">
 										<label class="control-label">Nama IKU</label>
 										<input name="nama_indikator" id="nama_indikator" type="text"  class="form-control" placeholder="" value="<?= !empty($nama_indikator) ? $nama_indikator : "" ;?>">
 									</div>

 									<div class="form-group">
 										<label class="control-label">Deskipsi IKU</label>
 										<textarea class="form-control" name="deskripsi" id="deskripsi"><?= !empty($deskripsi) ? $deskripsi : "" ;?></textarea>
 									</div>
 									<div class="form-group">
 										<label class="control-label">Satuan IKU</label>
 										<select name="id_satuan" id="id_satuan" class="form-control" readonly>
 											<option value="">Pilih</option>
 											<?php
 											$id_satuan = (!empty($indikator_atasan[0]->id_satuan_indikator_atasan)) ? $indikator_atasan[0]->id_satuan_indikator_atasan : "";
 											foreach ($satuan as $row) {
 												$selected = (!empty($id_satuan) && $id_satuan == $row->id_satuan) ? "selected" : "";
 												echo "<option $selected value='$row->id_satuan'>$row->satuan</option>";
 											}
 											?>
 										</select>
 									</div>

 									<div class="form-group">
 										<label class="control-label">Frekuensi Waktu</label>
 										<select name="frekuensi" id="frekuensi" class="form-control">
 										<?php
 											foreach ($GLOBALVAR['frekuensi_indikator'] as $key => $value) {
 												$selected = (!empty($frekuensi) && $frekuensi == $key) ? "selected" : "";
 												echo "<option value='$key' $selected>$value</option>";
 											}
 										?>
 										</select>
 									</div>

 									
 									<div class="form-group">
 										<label class="control-label">Cara Perhitungan</label>
 										<textarea class="form-control" id="cara_perhitungan" name="cara_perhitungan"><?= !empty($cara_perhitungan) ? $cara_perhitungan : "" ;?></textarea>
 									</div>

 								

 									<div class="form-group">
 										<label class="control-label">Polarisasi </label>
 										<select name="polaritas" id="polaritas" class="form-control">
 											<?php
 											foreach ($GLOBALVAR['polarisasi'] as $key => $value) {
 												$selected = (!empty($polaritas) && $polaritas == $key) ? "selected" : "";
 												echo "<option value='$key' $selected>$value</option>";
 											}
 										?>
 											
 										</select>
 									</div>

 									

 									<div class="form-group">
 										<label class="control-label">Target</label>
 										<input name="target" id="target" type="text" class="form-control" placeholder="" value="<?= !empty($target) ? $target :"" ;?>">
 									</div>


 									





 								</div>
 								

 								<div class="wizard-pane" role="tabpanel">

 									<div class="form-group">
 										<label class="control-label">Metode Cascading</label>
 										<select name="metode_penurunan" id="metode_penurunan" class="form-control">
 										<?php
 											foreach ($GLOBALVAR['metode_penurunan'] as $key => $value) {
 												$selected = (!empty($metode_penurunan) && $metode_penurunan == $key) ? "selected" : "";
 												echo "<option value='$key' $selected>$value</option>";
 											}
 										?>
 										</select>
 									</div>

 									<table class="table">
 										<thead>
 										<tr><th>Unit Kerja</th><th>Diturunkan<th></tr>
 										</thead>
 										<tbody>
 										<?php 
									      foreach($unit_kerja as $r){
									        echo'<tr><td>'.$r->nama_unit_kerja.'</td><td><input type="checkbox" name="unit_kerja_bawah[]" value="'.$r->id_unit_kerja.'"><td></tr>';
									      }
									      ?>


 										</tbody>	
 									</table>

 									<div class="form-group">
 										<label class="control-label">Perhitungan Ke atasan</label>
 										<select name="perhitungan" id="perhitungan" class="form-control">
 										<?php
 											foreach ($GLOBALVAR['perhitungan_indikator'] as $key => $value) {
 												$selected = (!empty($perhitungan) && $perhitungan == $key) ? "selected" : "";
 												echo "<option value='$key' $selected>$value</option>";
 											}
 										?>
 										</select>
 									</div>

 								</div>

 								
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<!-- /.row -->


 			<form>


 			</div>
 		<script type="text/javascript">
 			function getIkuAtasan()
 			{
 				
 				var iku_atasan = $("#iku_atasan").val();
 				//console.log(iku_atasan);
 				if(iku_atasan!=""){

	 				$.post("<?= base_url();?>/rencana_kerja_tahunan/getiku",
	 					{
	 						'id_indikator' : iku_atasan,
	 					},
	 					function(result)
	 					{
	 						var jData = JSON.parse(result);
	 						var data = jData.data;
	 						//console.log(data[0]);
	 						var kode_indikator = data[0]['kode_indikator'];
	 						var nama_indikator = data[0]['nama_indikator'];
	 						var deskripsi = data[0]['deskripsi'];
	 						console.log(data[0]);
	 						//$("#kode_indikator").val(kode_indikator);
	 						document.getElementById("kode_indikator").value = kode_indikator;
		 					document.getElementById("nama_indikator").value = nama_indikator;
			 				document.getElementById("deskripsi").value = deskripsi;
			 				if(data[0]['metode_penurunan']=="AL")
			 				{
			 					document.getElementById("id_satuan").value = data[0]['id_satuan'];
			 					document.getElementById("frekuensi").value = data[0]['frekuensi'];
			 					document.getElementById("perhitungan").value = data[0]['perhitungan'];
			 					document.getElementById("cara_perhitungan").value = data[0]['cara_perhitungan'];
			 					document.getElementById("validasi").value = data[0]['validasi'];
			 					document.getElementById("polaritas").value = data[0]['polaritas'];
			 					document.getElementById("penanggung_jawab").value = data[0]['penanggung_jawab'];
			 					document.getElementById("metode_penurunan").value = 'TD';

			 					document.getElementById("kode_indikator").disabled = true;
			 					document.getElementById("nama_indikator").disabled = true;
				 				document.getElementById("deskripsi").disabled = true;
				 				document.getElementById("id_satuan").disabled = true;
			 					document.getElementById("frekuensi").disabled = true;
			 					document.getElementById("perhitungan").disabled = true;
			 					document.getElementById("cara_perhitungan").disabled = true;
			 					document.getElementById("validasi").disabled = true;
			 					document.getElementById("polaritas").disabled = true;
			 					document.getElementById("penanggung_jawab").disabled = true;
			 					document.getElementById("metode_penurunan").disabled = true;
			 				}
	 					});
 				}
 				else{
	 				document.getElementById("kode_indikator").value = "";
 					document.getElementById("nama_indikator").value = "";
	 				document.getElementById("deskripsi").value = "";

	 				document.getElementById("id_satuan").value = "";
			 					document.getElementById("frekuensi").selectedIndex = "0";
			 					document.getElementById("perhitungan").selectedIndex = "0";
			 					document.getElementById("cara_perhitungan").value = "";
			 					document.getElementById("validasi").selectedIndex = "0"
			 					document.getElementById("polaritas").selectedIndex = "0";
			 					document.getElementById("penanggung_jawab").value = "";
			 					document.getElementById("metode_penurunan").selectedIndex = '3';

			 					document.getElementById("kode_indikator").disabled = false;
			 					document.getElementById("nama_indikator").disabled = false;
				 				document.getElementById("deskripsi").disabled = false;
				 				document.getElementById("id_satuan").disabled = false;
			 					document.getElementById("frekuensi").disabled = false;
			 					document.getElementById("perhitungan").disabled = false;
			 					document.getElementById("cara_perhitungan").disabled = false;
			 					document.getElementById("validasi").disabled = false;
			 					document.getElementById("polaritas").disabled = false;
			 					document.getElementById("penanggung_jawab").disabled = false;
			 					document.getElementById("metode_penurunan").disabled = false;
 				}
 			}
 		</script>
 		

