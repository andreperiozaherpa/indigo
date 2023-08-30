<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Alokasi Kegiatan KL</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>manage_category_finance">Daftar Alokasi Kegiatan</a>
				</li>
				<li class="active">		
					<strong>Tambah</strong>
				</li>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- .row -->
	<div class="row">
		<div class="col-sm-12">


			<?php if (!empty($message)) echo "
			<div class='alert alert-$message_type'>$message</div>";?>
			<div class="row">

				<div class="col-sm-12 col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">Tambah Realisasi
							<div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"></a></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;"><a href="<?php echo base_url();?>realisasi_kegiatan_kl/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a>
										<br>

									</div>
								</div> 
							</div>
							
						</div>
					</div>

					
				</div>


				<div class="col-sm-12 col-md-9">
						
						


				</div>


			</div>
		</div>
		<!--akhir row -->

		<div class="row">

			<div class="col-sm-12 col-md-12">
				<div class="white-box">


					<div class="table-responsive">

						<table class="table table-bordered table-striped datatable table-responsive" id="example23">

							<thead>
								<tr>
									<th align="center" rowspan="2" >Tahun</th>
									<th align="center" rowspan="2" >Triwulan</th>
									<th align="center" rowspan="2" >Kementerian Koordinator</th>
									<th align="center" rowspan="2" >Kementerian/Lembaga</th>

									<th align="center" rowspan="2">Jumlah Anggaran</th>
									<th align="center" colspan="2" >Rencana Waktu</th>
									<th align="center" rowspan="2">Keterangan</th>
									<th align="center" rowspan="2" >Aksi</th>
								</tr>
								<tr>
									<th align="center" width="111px">Tanggal Awal</th>
									<th align="center" width="111px">Tanggal Akhir</th>
								</tr>

							</thead>
							<tbody>
								<?php 
								foreach($data as $d){
									$this->ref_instansi_model->id_instansi = $d->id_koordinator;
									$nama_koordinator = $this->ref_instansi_model->get_by_id()->nama_instansi;
									$this->ref_instansi_model->id_instansi = $d->id_sub_koordinator;
									$nama_lembaga = $this->ref_instansi_model->get_by_id()->nama_instansi;
								?>
								<tr " class="">
									<td ><?php echo $d->tahun_realisasi_kegiatan_kl ?></td>
									<td ><?php echo $d->triwulan ?></td>
									<td ><?php echo $nama_koordinator ?></td>
									<td ><?php echo $nama_lembaga ?></td>
									<td ><?php echo rupiah($d->jumlah_anggaran) ?></td>
									<td ><?php echo tanggal($d->tanggal_awal) ?></td>
									<td ><?php echo tanggal($d->tanggal_akhir) ?></td>
									<td ><?php echo $d->keterangan_realisasi ?></td>
									<td>
										<a href='<?php echo site_url('realisasi_kegiatan_kl/detail/'.$d->id_realisasi_kegiatan_kl.'') ?>' class='btn-xs' title='Detail' data-toggle="tooltip" data-original-title="Detail">
											<i class="fa fa-list text-primary m-r-10"></i> 
										</a>
										<a href='<?php echo site_url('realisasi_kegiatan_kl/edit/'.$d->id_realisasi_kegiatan_kl.'') ?>' class='btn-xs' title='Edit' data-toggle="tooltip" data-original-title="Edit">
											<i class="fa fa-pencil text-inverse m-r-10"></i> 
										</a>
										<a class='btn-xs' title='Delete'  onclick='delete_("<?php echo $d->id_realisasi_kegiatan_kl ?>")' data-toggle="tooltip" data-original-title="Close">
											<i class="fa fa-close text-danger"></i>
										</a>
									</td>
								</tr>
<?php } ?>

							</tbody>


						</table>
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
        	window.location = "<?php echo base_url();?>realisasi_kegiatan_kl/delete/"+id;
            swal("Berhasil!", "Data telah terhapus.", "success"); 
        });
	}
</script>