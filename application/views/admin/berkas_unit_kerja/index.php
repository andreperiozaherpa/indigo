 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Berkas Tahunan Unit Kerja</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>admin">Dashboard</a></li>
 				<li class="active">Berkas Tahunan</li>
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
 							<select name="tahun_berkas" class="form-control">
 								<option value="">Semua Tahun</option>
 								<?php 
						        $array_year = array();
						        foreach($tahun as $r){
						          if ($r->tahun_berkas>0) {
						            array_push($array_year, $r->tahun_berkas);
						          }
						        }
 								$array_year = array_unique($array_year);
						        rsort($array_year);
						        foreach ($array_year as $year) {
						          echo'<option value="'.$year.'">'.$year.'</option>';
						        }
 								?>
 							</select>				
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label for="exampleInputEmail1">Unit kerja</label>
 							<select name="id_unit_kerja" class="form-control">
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
 						<a href="<?=base_url('berkas_unit_kerja/tambah')?>"><button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i> Tambah Berkas Tahunan</button></a>
 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Unit Kerja</th>
 									<th>Tahun</th>
 									<th>Renstra</th>
 									<th>RKT</th>
 									<th>PK</th>
 									<th>LKJ</th>
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
 										<td><?=$t->nama_unit_kerja?></td>
 										<td><?=$t->tahun_berkas?></td>
 										<td><?php if (!empty($t->renstra) AND $t->set_renstra == "on"):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->renstra.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a><?php endif;?></td>
 										<td><?php if (!empty($t->rkt) AND $t->set_rkt == "on"):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->rkt.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a><?php endif;?></td>
 										<td><?php if (!empty($t->pk) AND $t->set_pk == "on"):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->pk.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a><?php endif;?></td>
 										<td><?php if (!empty($t->lkj) AND $t->set_lkj == "on"):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->lkj.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a><?php endif;?></td>
 										<td style="width:150px">
 											<a href="<?=base_url('berkas_unit_kerja/detail/'.$t->id_unit_kerja.'')?>" class="btn btn-success btn-sm"><i class="fa fa-folder"></i> Detail</a> <a href="javascript:void(0)" onclick="delete_(<?=$t->id_berkas?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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
 							url : "<?=base_url().'berkas_unit_kerja/delete/'?>"+id,
 							type: "POST",
 							success: function(data)
 							{
 								swal("Berhasil", "Data Berhasil Dihapus!", "success");
 								location.reload();
 							},
 							error: function (jqXHR, textStatus, errorThrown)
 							{
 								alert('Error deleting data');
 								location.reload();
 							}
 						});
 					}
 				});
 			}
 		</script>