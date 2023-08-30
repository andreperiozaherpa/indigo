<div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Filter laporan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <form id="laporan" class="form-horizontal form-label-left" method=post target="_blank" action="<?=base_url()."rekapdata/laporan/";?>">
						<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<?php
					if ($id<5){?>
						<div class="form-group">
							<label>SKPD</label>
						</div>
					
						<div class="form-group" id="induk1">
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
					}?>
						<div class="form-group">
							<label>Bulan <i>(wajib)</i></label>
						</div>
						<div class="form-group" >
							<select class="form-control" name="bulan" id="bulan">
								
								<option value="" selected>Pilih</option>
								<?php
									for($bln=1;$bln<=12;$bln++){
										echo "<option value='$bln'>$bulan[$bln]</option>";
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Tahun <i>(wajib)</i></label>
						</div>
						<div class="form-group" >
							<select class="form-control" name="tahun" id="tahun">
								
								<option value="" selected>Pilih</option>
								<?php
									$tahun = date('Y');
									$tahun_minimal = '2009';
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
                          <a class="btn btn-success">Tampilkan data</a>
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
		var bulan = $("#bulan").val();
		var tahun = $("#tahun").val();
		if (bulan!="" && tahun!=""){
			if (download)
				$("#download").val(1);
			else
				$("#download").val(0);
			$("#laporan").submit();
		}
		else{
			alert("Bulan dan tahun wajib diisi");
		}
	}
</script>