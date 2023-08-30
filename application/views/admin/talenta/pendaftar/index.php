<div class="container-fluid">
<?php 
    $filter = '';
?>
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Assement</h4> </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                <?php
                if($filter){
                  ?>
                  <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                  <?php
                }
                ?>
              </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
        
        foreach($dt_pendaftaran as $row) { 
            $color = ($row->verifikasi=="1") ? "primary" : "danger";
            $color_status = ($row->status_seleksi=="Lolos") ? "primary" : "danger";
            $color_code = "";
            $icon = "";
            $status = "";
        ?>
            <div class="col-md-6 col-sm-6">
                <div class="verify-data-status">
                <i class="<?=$icon?>"></i> <?=$status?>
                </div>
                <div class="white-box" style="height:350px;width:auto;">
                    <div class="row b-b" style="height:140px;">
                        <div class="col-md-4 col-xs-4 b-r text-center" style="height:120px;">
                            <br>
                            <img src="<?=base_url('data/foto/pegawai/user_default.png')?>" alt="user" style=" object-fit: cover;
                  width: 80px;
                  height: 80px;border-radius: 50%;
                  ">
                        </div>
                        <div class="col-md-8  col-xs-8">
                            <br>
                            <h5><b><?= $row->nama_lengkap;?></b></h5>
                            <h5><small><?= $row->nip;?></small></h5>
                            <h5>
                                <label class="label label-<?=$color_status;?>"><?=$row->status_seleksi;?></label>
                                <?php if(!empty($row->skor)) {?>
                                <label class="label label-success">Skor : <?=$row->skor;?></label>
                                <?php }?>
                                <?php if($row->verifikasi==1){?>
                                <label class="label label-info"><i class="fa fa-cube"></i> BOX <?=$row->box;?></label>
                                <br><br>
                                <small class="m-t-10 " ><i class="icon-check text-success"></i> Diverifikasi oleh : <?=$row->nama_verifikator;?></small>
                                <?php }?>

                            </h5>

                        </div>
                    </div>
                    <div class="row b-b" style="height:85px;">
                        <div class="text-center">
                            <br>
                            <b style="color: #6003c8">Jabatan</b>
                            <br>
                            <small><?= $row->nama_jabatan;?></small><br>
                        <small style="margin-right: 10px;"><i style="color: #6003c8" class="ti-pulse "></i> Eselon <?= $row->eselon;?></small>
                        <small><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow "></i> <?= $row->nama_skpd;?></small>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <a href="<?=base_url('talenta/pendaftar/detail/').'/'.$row->id_pendaftaran?>" class="btn btn-default btn-block">
                            Detail Pegawai
                        </a>
                        <?php if($row->verifikasi!=1){?>
                        <a href="<?=base_url('talenta/pendaftar/verifikasi/').'/'.$row->id_pendaftaran?>" class="btn btn-primary btn-block">
                            Verifikasi
                        </a>
                        <?php } else{ ?>
                            <a href="<?=base_url('talenta/pendaftar/verifikasi/').'/'.$row->id_pendaftaran?>" class="btn btn-success btn-block">
                            Verifikasi ulang
                        </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php } ?>
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


        <div id="myModalc" class="modal fade" tabindex="" index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4> </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin akan ikut serta dalam seleksi calon talent?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">Ya</button>
                            <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tidak</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

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