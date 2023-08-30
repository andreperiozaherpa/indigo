<div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Filter laporan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <form id="laporan" class="form-horizontal form-label-left" method=post target="_blank" action="<?=base_url()."rekapdata/laporan_duk/";?>">					
						<div class="form-group" id="induk1">
							<label>SKPD</label>
							<select onchange="get_sub_induk(1)" class="form-control" name="skpd_level1" id="skpd_level1">
								
								<option value="" selected>Pilih</option>
								<?php
									foreach($skpd_level1 as $row){
										echo "<option value='$row->kd_skpd'>$row->nama_skpd</option>";
									}
								?>
							</select>
						</div>
						<?php
						for($i=2;$i<=7;$i++){
							$display = "none";
							$val = $option = "";
							echo'
							<div class="form-group" id="induk'.$i.'" style="display:'.$display.'">
								  <select onchange="get_sub_induk('.$i.')" class="form-control" name="skpd_level'.$i.'" id="skpd_level'.$i.'">
									<option value="'.$val.'">'.$option.'</option>
								  </select>
							</div>
						';
						}
					?>
								<div class="form-group">
                                  <label>Jenis Jabatan</label>
                                    <select class="form-control" id='jenis_jabatan' name="jenis_jabatan" onchange="getJabatan()">
                                      <option value='' selected>Pilih</option>
                                      <?php 
										for($i=1; $i <= count($arr_jenis_jabatan); $i++)
										{
											echo "<option value='$i'>$arr_jenis_jabatan[$i]</option>";
										}
										
									  ?>
                                    </select>
                                 
                                </div>
								
								<div class="form-group" id="induk_jab1">
									<label>Jabatan</label>
										<select onchange="get_sub_induk_jab(1)" class="form-control" name="jab_level1" id="jab_level1">
										<option value="" selected>Pilih</option>
										</select>
								</div>
								<?php
								for($i=2;$i<=7;$i++){
									$display = "none";
									$val = $option = "";
									echo'
									<div class="form-group" id="induk_jab'.$i.'" style="display:'.$display.'">
										<select onchange="get_sub_induk_jab('.$i.')" class="form-control" name="jab_level'.$i.'" id="jab_level'.$i.'">
											<option value="'.$val.'">'.$option.'</option>
										</select>
									</div>
								';
								}?>
								
						<div class="form-group">
							<label>Tahun <i>(wajib)</i></label>
						</div>
						<div class="form-group" >
							<select class="form-control" name="tahun" id="tahun">
								
								<option value="" selected>Pilih</option>
								<?php
									$tahun = date('Y');
									while($tahun > $tahun_minimal){
										echo "<option value='$tahun'>$tahun</option>";
										$tahun--;
									}
								?>
							</select>
						</div>
                      <div class="form-group">
							<input type="hidden" id="download" name="download"/>
                          <a href='<?= base_url()."rekapdata/filter/".$id;?>' class="btn btn-default">Reset</a>
                          <a onclick="submit_()" class="btn btn-success">Tampilkan data</a>
						  <a onclick="submit_(1)" class="btn btn-danger" >Download</a>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

<script>
	function get_sub_induk(no)
	{
		var id_induk = $('#skpd_level'+no).val();
		no++;
		reset(no);
		if (id_induk!=""){
			$('#induk'+no).show();
			$.post("<?php echo base_url();?>ref_skpd/get_induk",{'id_induk':id_induk},function(obj){
				if (obj!="")
					$('#skpd_level'+no).html(obj);
				else 
					$('#induk'+no).hide();
			});
		}
	}
	function reset(no){
		while(no <= 7){
			$('#skpd_level'+no).val('');
			$('#induk'+no).hide();
			no++;
		}
	}
	function submit_(download)
	{
		var tahun = $("#tahun").val();
		if (tahun!=""){
			if (download)
				$("#download").val(1);
			else
				$("#download").val(0);
			$("#laporan").submit();
		}
		else{
			alert("Tahun wajib diisi");
		}
	}
	//jabatan
	function get_sub_induk_jab(no)
	{
		var id_induk = $('#jab_level'+no).val();
		no++;
		reset_jab(no);
		if (id_induk!=""){
			$('#induk_jab'+no).show();
			$.post("<?php echo base_url();?>ref_jabatan/get_induk",{'id_induk':id_induk},function(obj){
				if (obj!="")
					$('#jab_level'+no).html(obj);
				else 
					$('#induk_jab'+no).hide();
			});
		}
		//console.log("id_induk="+id_induk);
	}
	function reset_jab(no){
		while(no <= 7){
			$('#jab_level'+no).val('');
			$('#induk_jab'+no).hide();
			no++;
		}
	}
	function getJabatan()
	{
		var jenis_jabatan = $("#jenis_jabatan").val();
		$.post("<?= base_url();?>ref_jabatan/get_jabatan",
			{
				'jenis_jabatan':jenis_jabatan
			},
			function(response){
				$("#jab_level1").html(response);
			});
		reset_jab(2);
		if (jenis_jabatan=="") $("#jab_level1").html("<option value=''>Pilih</option>");
	}
</script>