<div class="container-fluid">
    
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Peringkat Hasil Seleksi Talent</h4> </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <?php echo breadcrumb($this->uri->segment_array()); ?>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="row">
                    <form method="POST">
                    <div class="col-md-10">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label"> Eselon</label>
                                <select class="form-control select2" name="eselon" id="eselon" onchange="get_persyaratan()">
									<option value="">Pilih Eselon</option>
										<?php 
												$eselonArr = array("I","II","III","IV");
												foreach($eselonArr as $key=>$val){
													$selected = (!empty($eselon) && $eselon==$val) ? "selected" : "";
													echo "<option $selected value='".$val."'>".$val."</option>";
												}
										?>
								</select>
                                <?= form_error("eselon",'<p class="text-info">','</p>');?>
                            </div>
                        </div>
                        <div class="col-md-4">


                            <div class="form-group">
                                <label class="control-label"> SKPD</label>
                                <select class="form-control select2" id="id_skpd" name="id_skpd" onchange="get_jabatan()">
									<option value="">Pilih</option>
										<?php 
												
												foreach($dt_skpd as $row){
													$selected = (!empty($id_skpd) && $id_skpd==$row->id_skpd) ? "selected" : "";
													echo "<option $selected value='".$row->id_skpd."'>".$row->nama_skpd."</option>";
												}
										?>
								</select>
                                <?= form_error("id_skpd",'<p class="text-info">','</p>');?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label"> Jabatan</label>
                                <select class="form-control select2" name="id_jabatan" id="id_jabatan">
									<option value="">Pilih</option>
									<?php 
												
												foreach($dt_jabatan as $row){
													$selected = (!empty($id_jabatan) && $id_jabatan==$row->id_jabatan) ? "selected" : "";
													echo "<option $selected value='".$row->id_jabatan."'>".$row->nama_jabatan."</option>";
												}
										?>
								</select>
                                <?= form_error("id_jabatan",'<p class="text-info">','</p>');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                
              </div>
                    </div>
                </form>
              </div>

          </div>
      </div>
  </div>

<?php if(!empty($dt_summary)){?>  
  <div class="row">
    <div class="white-box">
        <div class="row">
			<a target="_blank" href="<?=base_url();?>talenta/peringkat/download_all/?<?= !empty($filter) ? http_build_query($filter) : "" ;?>" >
            <i class="fa fa-file-pdf-o pull-right"></i>
            </a>
		</div>
        <div class="text-center">
            <small><b style="color: #6003c8">PERINGKAT UNTUK</b></small>
            <br>

            <span style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon <?=$eselon;?></span>
            <span style="margin-right: 10px;"><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> <?=$dt_summary[0]->nama_skpd;?></span>
            <span><i style="color: #6003c8" class="ti-bar-chart"></i> <?=$dt_summary[0]->nama_jabatan;?></span>
        </div>
        <hr>
        <table class="table color-table primary-table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Skor</th>
                    <th>Download </th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
            foreach($dt_summary as $row){?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$row->nip;?></td>
                    <td><?=$row->nama_lengkap;?></td>
                    <td><?=$row->total;?></td>
                    <td><a href="<?=base_url('talenta/peringkat/download/'.$row->id_pendaftaran);?>" target="_blank" >
                        <button class="btn btn-primary btn-outline"><i class="fa fa-file-pdf-o"></i> Download</button>
                        </a>
                    </td>
                </tr>
            <?php $i++; } ?>
            </tbody>
        </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="row">
                <div class="col-md-12 pager">
                    <?= make_pagination($pages,$current);  ?>
                </div>

            </div>

        </div>
</div>
<?php }?>
    <script type="text/javascript">
	function get_jabatan()
	{
		var id_skpd = $("#id_skpd").val();
		$.post('<?=base_url()."talenta/resource/get_jabatan_buka";?>',
			{'id_skpd' : id_skpd},
			function(opt){
				$("#id_jabatan").html(opt);
				$("#id_jabatan").trigger('change');
			});
	}

	
</script>