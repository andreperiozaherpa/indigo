 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Rencana Kerja Tahunan</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="#">Dashboard</a></li>
 				<li class="active">Starter Page</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>

 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">
 					<div class="col-md-3">
 						<div class="form-group">
 							<label for="exampleInputEmail1">Tahun</label>
 							<select name="tahun_rkt" class="form-control">
 								<option value="">Semua Tahun</option>
 								<?php 
 								foreach($tahun as $r){
 									echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
 								}
 								?>
 							</select>				
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="exampleInputEmail1">Unit kerja</label>
 							<select name="id_unit_penanggungjawab" class="form-control">
 								<option value="">Semua Unit Kerja</option>
 								<?php 
 								foreach($unit_kerja as $r){
 									echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
 								}
 								?>
 							</select>				
 						</div>
 					</div>
 					<div class="col-md-3">
 						<div class="form-group">

 							<br>
 							<button type="submit" class="btn btn-primary m-t-5">Filter</button>
 						</div>
 					</div>
 				</form>
 				</div>

 			</div>
 		</div>

 	</div>
 	<!-- .row -->
 	<div class="row">	
 		<div class="col-md-12">
 			<div class="row">
 				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 					<div class="white-box">
 						<a href="<?=base_url('ref_rkt/tambah')?>"<button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i> Tambah Rencana Kerja Tahunan</button></a>
 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Tahun</th>
 									<th> Ref. Renstra</th>
 									<th>Indikator </th>
 									<th>Penanggung jawab</th>
 									<th>Opsi</th>
 								</tr>
 							</thead>
 							<tbody>
 								<?php 
 								$no=1;
 								foreach($item as $t){
 									?>
 									<tr>
 										<td><?=$no?></td>
 										<td><?=$t->tahun_rkt?></td>
 										<td><?=$t->renstra?></td>
 										<td><?=$t->indikator_hasil?></td>
 										<td><?=$t->nama_unit_kerja?></td>
 										<td style="width:150px">
 											<a href="<?=base_url('ref_rkt/detail/'.$t->id_rkt.'')?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Detail</a> 
 											<a href="<?=base_url('ref_rkt/edit/'.$t->id_rkt.'')?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a> <a href="javascript:void(0)" onclick="delete_(<?=$t->id_rkt?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
 										</td>
 									</tr>

 									<?php $no++; } ?>


 								</tbody>



 							</table>



 						</div>
 					</div>

 				</div>    


 			</div>
 			<!-- .row -->

 		</div>


 		<script type="text/javascript">

 			function delete_(id){
 				swal({
 					title: "Hapus Data",
 					text: "Apakah anda yakin akan menghapus data ini?",
 					type: "warning",
 					showCancelButton: true,
 					confirmButtonColor: '#DD6B55',
 					confirmButtonText: 'Ya',
 					cancelButtonText: "Tidak",
 					closeOnConfirm: false
 				},
 				function(isConfirm){
 					if (isConfirm){
 						$.ajax({
 							url : "<?=base_url().'ref_rkt/delete/'?>"+id,
 							type: "POST",
 							dataType: "JSON",
 							success: function(data)
 							{
 								swal("Berhasil", "Data Berhasil Dihapus!", "success");
 								location.reload();
 							},
 							error: function (jqXHR, textStatus, errorThrown)
 							{
 								alert('Error deleting data');
 							}
 						});
 					}
 				});
 			}
 		</script>