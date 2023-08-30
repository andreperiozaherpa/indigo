<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Detail Analisis Kebutuhan</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>talenta/kebutuhan">Analisis Kebutuhan</a>
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
			<a href="<?=base_url('talenta/kebutuhan')?>" class="btn btn-primary btn-outline pull-right">Kembali</a>
			<br><br><br>
			<div class="white-box">

				<div class="row">
					<div class="col-md-12">

						<div class="panel panel-primary" data-collapsed="0">



						</div>
						<div class="panel-body">
						

							<?php echo form_open_multipart() ?>

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
								<a href="/talenta/kebutuhan/edit/<?=$detail->id_kebutuhan;?>" class="btn btn-info btn-sm"><i class="ti-pencil"></i> Edit</a>
								<a href="#" onclick='delete_(<?= $detail->id_kebutuhan;?>)' class="btn btn-danger btn-sm"><i class="ti-trash"></i> Hapus</a>
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
		function delete_(id)
		{
			swal({   
				title: "Apakah anda yakin?",   
				text: "Anda tidak dapat mengembalikan data ini lagi jika sudah terhapus!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Hapus",
				closeOnConfirm: false 
			}, function(){   
				window.location = "<?php echo base_url();?>talenta/kebutuhan/delete/"+id;
				
			});
		}
	</script>