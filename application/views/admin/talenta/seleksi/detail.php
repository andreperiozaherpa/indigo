<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Seleksi calon talent</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>talenta/seleksi">Seleksi</a>
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
			<a href="<?=base_url('talenta/seleksi')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
			<br><br><br>
			<div class="white-box">

				<div class="row">
					<div class="col-md-12">

						<div class="panel panel-primary" data-collapsed="0">
                        <?php if($dt_pendaftaran){?>
                        <div class="alert alert-success"> Anda sudah mendaftar untuk seleksi ini. </div>
                        <?php } ?>
						</div>
						<div class="panel-body">
						


							<div class="form-group">
								<label class="control-label"> SKPD</label>
								<p><?=$detail->nama_skpd;?></p>
							</div>
							<div class="form-group">
								<label class="control-label"> Eselon</label>
								<p><?= $detail->eselon;?></p>
							</div>

							

							<div class="form-group">
								<label class="control-label"> Jabatan</label>
								<p><?= $detail->nama_jabatan;?></p>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Dibuka</label>
										<p><?= date('d M Y',strtotime($detail->tanggal_buka)) ;?></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label"> Tanggal Ditutup</label>
										<p><?= date('d M Y',strtotime($detail->tanggal_tutup)) ;?></p>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label"> Persyaratan</label>
								<ul>
									<?php
									foreach($dt_persyaratan as $p){
									?>
									<li><?=$p->persyaratan?></li>
                                    <?php } ?>
                                </ul>
							</div>

							<div class="form-group">
								<label class="control-label">Kualifikasi Minimal Pangkat / Gol Ruang</label>
								<p><?= $detail->golongan." (".$detail->pangkat.")";?></p>
							</div>

							<div class="form-group">
								<label class="control-label"> Kualifikasi Minimal Tingkat Pendidikan</label>
								<p><?= $detail->nama_jenjangpendidikan;?></p>
							</div>

							<div class="form-group">
							<?php if(!$dt_pendaftaran) {?>
								<a href="#" onclick='daftar(<?= $detail->id_kebutuhan;?>)' class="btn btn-success btn-sm">Daftar</a>
							<?php }
							 else {
								 if($dt_pendaftaran[0]->status_seleksi=="Belum diverifikasi" && !$dt_pendaftaran[0]->file_kompetensi){?> 
                        		<button class="btn btn-primary" data-toggle="modal" data-target="#kompetensi" >Upload scan kompetensi</button>
							<?php }
								if($dt_pendaftaran[0]->status_seleksi=="Belum diverifikasi" && !$dt_pendaftaran[0]->file_potensi){?> 
									<button class="btn btn-primary" data-toggle="modal" data-target="#potensi" >Upload scan potensi</button>
								<?php }
							} ?>
                            </div>
						


					</div>

				</div>
			</div>

		</div>
	</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
<?php if($dt_pendaftaran){?>
<div id="kompetensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Upload berkas</h4> </div>
                    <form method="POST" enctype='multipart/form-data' action="<?=base_url();?>talenta/seleksi/upload_kompetensi">
                    <input type="hidden" name="id_pendaftaran" value="<?=$dt_pendaftaran[0]->id_pendaftaran;?>" id="id_pendaftaran_kompetensi"/>
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Scan Berkas Kompetensi</label>
                                <input type="file" class="dropify" name="file_kompetensi">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect"><i class="fa icon-upload"></i> Upload</button>
                        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        <div id="potensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Upload berkas</h4> </div>
                    <form method="POST" enctype='multipart/form-data' action="<?=base_url();?>talenta/seleksi/upload_potensi">
                    <input type="hidden" name="id_pendaftaran" value="<?=$dt_pendaftaran[0]->id_pendaftaran;?>" id="id_pendaftaran_potensi"/>
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label>Scan Berkas Potensi</label>
                                <input type="file" class="dropify" name="file_potensi">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect"><i class="fa icon-upload"></i> Upload</button>
                        <button type="button" class="btn btn-primary btn-outline waves-effect" data-dismiss="modal">Tutup</button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
<?php }?>
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