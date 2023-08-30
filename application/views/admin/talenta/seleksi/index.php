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
                        <div class="col-md-3">

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
                        <div class="col-md-3">


                            <div class="form-group">
                                <label class="control-label"> SKPD</label>
                                <select class="form-control select2" id="id_skpd" name="id_skpd" onchange="get_unit()">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Unit Kerja</label>
                                <select class="form-control select2" id="id_unit_kerja" name="id_unit_kerja" onchange="get_jabatan()">
									<option value="">Pilih</option>
                                    <?php 
												
												foreach($dt_unit_kerja as $row){
													$selected = (!empty($id_unit_kerja) && $id_unit_kerja==$row->id_unit_kerja) ? "selected" : "";
													echo "<option $selected value='".$row->id_unit_kerja."'>".$row->nama_unit_kerja."</option>";
												}
										?>
								</select>
                            </div>
                        </div>
                        <div class="col-md-3">

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
                foreach($dt_kebutuhan as $row){ 
            ?>
            <div class="col-md-4 col-sm-6" >
                <div class="white-box" style="height:200px">
                    <div class="row">
                        <span class="pull-right label label-primary"><?=date('d M', strtotime($row->tanggal_buka)) .' - '. date('d M Y', strtotime($row->tanggal_tutup)) ;?></span>
                        <h5><b><?= $row->nama_jabatan;?></b></h5>
                        <h5><small><i style="color: #6003c8" class="ti-pulse fa-fw"></i> Eselon <?= $row->eselon;?></small></h5>
                        <h5><small><i style="color: #6003c8" data-icon="&#xe030;" class="linea-icon linea-aerrow fa-fw"></i> <?=$row->nama_skpd;?></small></h5>
                    </div>
                    <div class="row">
                    <a href="<?=base_url('talenta/seleksi/detail')."/".$row->id_kebutuhan?>" class="btn btn-xs btn-primary btn-outline">Detail</a>
                        <!--
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-primary btn-outline">Lihat Persyaratan</a>
                        -->
                        <?php if(!in_array($row->id_kebutuhan,$ids_kebutuhan)){?>
                        <a href="javascript:void(0)" onclick="daftar(<?= $row->id_kebutuhan ;?>)" class="btn btn-primary pull-right"><i class="ti-check"></i> Ikut Serta</a>
                        
                        <?php } ?>
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


        

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Persyaratan</h4> </div>
                    <div class="modal-body">

                        <ul>
                            <?php
                            $persyaratan = array('Memiliki pangkat serendah-rendahnya Pembina Tk. I (IV/b)','Jabatan Administrator paling singkat 4 tahun','Jabatan Fungsional jenjang Ahli Madya paling singkat 4 tahun','Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a','Usia paling tinggi 56 tahun pada saat pendaftaran, kecuali bagi pelamar yang sedang menduduki Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a dan Jabatan Fungsional Jenjang Ahli Madya.','Berpendidikan paling rendah sarjana (S1) sesuai bidang yang diminatinya, diutamakan pelamar dengan latar belakang pendidikan magister/pascasarjana (S2).');
                            foreach($persyaratan as $p){
                                ?>
                                <li><?=$p?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
<script type="text/javascript">
    function delete_(id)
    {
        $('#confirm_title').html('Konfirmasi');
        $('#confirm_content').html('Apakah anda yakin akan menghapus data pegawai?');
        $('#confirm_btn').html('Hapus');
        $('#confirm_btn').attr('href',"<?php echo base_url();?>master_pegawai/delete/"+id);
    }

</script>


<script type="text/javascript">
	function get_unit()
	{
		var id_skpd = $("#id_skpd").val();
		$.post('<?=base_url()."talenta/resource/get_unit_kerja_by_skpd";?>',
			{'id_skpd' : id_skpd},
			function(opt){
				$("#id_unit_kerja").html(opt);
				$("#id_unit_kerja").trigger('change');
                get_jabatan();
			});
	}

	function get_jabatan()
	{
		var id_unit_kerja = $("#id_unit_kerja").val();
		$.post('<?=base_url()."talenta/resource/get_jabatan_by_unit_kerja";?>',
			{'id_unit_kerja' : id_unit_kerja},
			function(opt){
				$("#id_jabatan").html(opt);
				$("#id_jabatan").trigger('change');
			});
	}

	
</script>

<script type="text/javascript">
		function daftar(id)
		{
			swal({   
				title: "Apakah anda yakin akan mendaftar seleksi?",   
				//text: "",   
				type: "warning",   
				showCancelButton: true,   
				//confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Ya",
				closeOnConfirm: false 
			}, function(){   
				window.location = "<?php echo base_url();?>talenta/seleksi/daftar/"+id;
				
			});
		}
	</script>