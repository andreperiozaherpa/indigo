<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Target Kegiatan KL</h4>
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
					<strong>Semua Target Kegiatan K/L</strong>
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
						<div class="panel-heading">Tambah Target
							<div class="panel-action"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"></a></div>
						</div>
						<div class="panel-wrapper collapse in">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
										<a href="<?php echo base_url();?>target_kegiatan_kl/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a><br>

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
									<th align="center"  >Kode Kegiatan</th>
									<th align="center"  >Tahun</th>
									<th align="center"  >Koordinator</th>
									<th align="center"  >Sub Koordinator</th>
									<th align="center" >Jumlah Target Kegiatan</th>
									<th align="center" >Alokasi Anggaran</th>
									<th align="center" >Sisa Target Kegiatan</th>
									<th align="center" >Sisa Alokasi Anggaran</th>
									<th align="center" >Prensentasi Pelaksanaan</th>
									<th align="center"  >Status</th>
									<th align="center"  >Aksi</th>
								</tr>

							</thead>
							<tbody>
								<?php foreach($data as $d){
									$this->ref_instansi_model->id_instansi = $d->id_koordinator;
									$nama_koordinator = $this->ref_instansi_model->get_by_id()->nama_instansi;
									if($d->id_sub_koordinator!=0){
										$this->ref_instansi_model->id_instansi = $d->id_sub_koordinator;
										$nama_lembaga = $this->ref_instansi_model->get_by_id()->nama_instansi;
									}else{
										$nama_lembaga = '-';
									}
									$this->target_kegiatan_kl_model->id_target_kegiatan_kl = $d->id_target_kegiatan_kl;
									$sisa_target = $this->target_kegiatan_kl_model->get_sisa_target();
									$sisa_anggaran = $this->target_kegiatan_kl_model->get_sisa_anggaran();
									$presentasi = $this->target_kegiatan_kl_model->get_presentasi();
								?>
								<tr>
									<td ><?php echo $d->kode ?></td>
									<td ><?php echo $d->tahun_target_kegiatan_kl ?></td>
									<td ><?php echo $nama_koordinator ?></td>
									<td ><?php echo $nama_lembaga ?></td>
									<td ><?php echo $d->jumlah_target_kegiatan ?></td>
									<td ><?php echo rupiah($d->alokasi_anggaran)?></td>
									<td ><?php echo $sisa_target ?></td>
									<td ><?php echo rupiah($sisa_anggaran) ?></td>
									<td ><?php echo $presentasi ?>%</td>
									<td ><?php echo $d->status ?></td>
									<td>
										<a href='<?php echo site_url('target_kegiatan_kl/detail/'.$d->id_target_kegiatan_kl.'') ?>' class='btn btn-xs' title='Detail' data-toggle="tooltip" data-original-title="Edit">
											<i class="fa fa-list text-primary m-r-10"></i> 
										</a>
										<a href='<?php echo site_url('target_kegiatan_kl/edit/'.$d->id_target_kegiatan_kl.'') ?>' class='btn btn-xs' title='Edit' data-toggle="tooltip" data-original-title="Edit">
											<i class="fa fa-pencil text-inverse m-r-10"></i> 
										</a>
										<a class='btn btn-xs' title='Delete'  onclick='delete_("<?php echo $d->id_target_kegiatan_kl ?>")' data-toggle="tooltip" data-original-title="Close">
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
        	window.location = "<?php echo base_url();?>target_kegiatan_kl/delete/"+id;
            swal("Berhasil!", "Data telah terhapus.", "success"); 
        });
	}
</script>