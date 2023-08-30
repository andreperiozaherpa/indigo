<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Detail Target Kegiatan K/L</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_category_finance">Target Kegiatan K/L</a>
							</li>
							<li class="active">		
								<strong>Detail</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">

<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			
				
			</div>
			<div class="panel-body">
				<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
				<form role="form" class="form-horizontal " method='post' enctype="multipart/form-data">
					<div class="row">
					<div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Kode Kegiatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->kode.' - '.$detail->keterangan ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tahun</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->tahun_target_kegiatan_kl ?></p>
                            </div>
                        </div>
                        <?php 

                                    $this->ref_instansi_model->id_instansi = $detail->id_koordinator;
                                    $nama_koordinator = $this->ref_instansi_model->get_by_id()->nama_instansi;
                                    if($detail->id_sub_koordinator!=0){
                                        $this->ref_instansi_model->id_instansi = $detail->id_sub_koordinator;
                                        $nama_lembaga = $this->ref_instansi_model->get_by_id()->nama_instansi;
                                    }else{
                                        $nama_lembaga = '-';
                                    }

                                    if($detail->id_satuan==''||$detail->id_satuan==0||is_null($detail->id_satuan)){
                                        $nama_satuan = '-';
                                    }else{
                                        $this->ref_satuan_model->id_satuan = $detail->id_satuan;
                                        $nama_satuan = $this->ref_satuan_model->get_by_id()->satuan;
                                    }
                        ?>
                        <div class="form-group">
                            <label class="col-md-12">Koordinator</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $nama_koordinator ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Sub Koordinator</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $nama_lembaga ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Alokasi Anggaran</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->alokasi_anggaran ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Jumlah Target Kegiatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->jumlah_target_kegiatan ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-12">
                                <p class="form-control-static">
                                    <?php echo $detail->volume_kegiatan ?> <?php echo $nama_satuan ?>
                                        
                                    </p>
                            </div>
                        </div>
					</div>
					<div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Awal</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->tanggal_awal ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Tanggal Akhir</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->tanggal_akhir ?></p>
                                 </div>
                        </div>
                             <div class="form-group">
                            <label class="col-md-12">Provinsi</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_provinsi($detail->id_provinsi_target) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kabupaten</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_kabupaten($detail->id_kabupaten_target) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Kecamatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_kecamatan($detail->id_kecamatan_target) ?></p> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Desa</label>
                            <div class="col-md-12">
                                <p class="form-control-static"> <?php echo $this->ref_wilayah_model->get_nama_desa($detail->id_desa_target) ?></p> 
                            </div>
                        </div>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-md-12">Tempat Kegiatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->tempat ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Rencana Kegiatan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->rencana_kegiatan ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <p class="form-control-static"><?php echo $detail->keterangan_kegiatan ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                            	<div class="pull-right">
									<a href="<?php echo base_url('target_kegiatan_kl') ?>" class="btn btn-default waves-effect waves-light">Kembali</a>
								</div>
                            </div>
                        </div>
                        </div>
                    </div>
					</div>
				</form>
			
			</div>

		</div>
	</div>

</div>
</div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
<script type="text/javascript">
    function getLembaga(){
      var id_koordinator = $('#id_koordinator').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_lembaga') ?>', {id_koordinator:id_koordinator}, function(data){ 
        $('#id_lembaga').html(data); 
        $("#id_lembaga").select2("destroy");
        $("#id_lembaga").select2();
      });
    }
    function getKabupaten(){
      var id_provinsi = $('#id_provinsi').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kabupaten') ?>', {id_provinsi:id_provinsi}, function(data){ 
        $('#id_kabupaten').html(data); 
        $("#id_kabupaten").select2("destroy");
        $("#id_kabupaten").select2();
      });
    }
    function getKecamatan(){
      var id_kabupaten = $('#id_kabupaten').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_kecamatan') ?>', {id_kabupaten:id_kabupaten}, function(data){ 
        $('#id_kecamatan').html(data); 
        $("#id_kecamatan").select2("destroy");
        $("#id_kecamatan").select2();
      });
    }
    function getDesa(){
      var id_kecamatan = $('#id_kecamatan').val();
      $.post('<?php echo site_url('target_kegiatan_kl/get_desa') ?>', {id_kecamatan:id_kecamatan}, function(data){ 
        $('#id_desa').html(data); 
        $("#id_desa").select2("destroy");
        $("#id_desa").select2();
      });
    }
</script>