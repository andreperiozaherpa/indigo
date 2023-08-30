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
                <li><a href="<?= base_url();?>berkas_unit_kerja">Berkas Tahunan</a></li>
 				<li class="active">Detail</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>
     <br>

 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">
 					<div class="col-md-3 b-r">
 						<center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>   
 					</div>
 					<div class="col-md-9">
 						<div class="panel panel-inverse">
                            <div class="panel-heading"> <?=$item[0]->nama_unit_kerja?>
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <table class="table">
                                    	<tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?=$item[0]->nama_lengkap?></strong></tr>
                                    	<tr><td style="width: 120px;">Nama Jabatan </td><td>:</td><td> <strong><?=$item[0]->nama_jabatan?></strong></tr>

                                    </table>
                                </div>
                            </div>
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
 						<a href="<?=base_url('berkas_unit_kerja/tambah/?id_unit_kerja='.$this->uri->segment(3))?>"><button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i>  Tambah Berkas Tahunan</button></a>


 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
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
                                    <td><?=$t->tahun_berkas?></td>
                                    <td>
                                    	<?php if ($t->set_renstra == "on"): ?>
                                    		<?php if (!empty($t->renstra)):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->renstra.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a> <a href="javascript:void(0)" onclick="delete_berkas(<?=$t->id_berkas?>,'renstra')" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus</a><?php else:?><a href="#!" onclick="upload_berkas(<?=$t->id_berkas?>,'renstra')" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Unggah</a><?php endif;?></td>
                                    	<?php endif ?>
                                    <td>
                                    	<?php if ($t->set_rkt == "on"): ?>
                                    		<?php if (!empty($t->rkt)):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->rkt.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a> <a href="javascript:void(0)" onclick="delete_berkas(<?=$t->id_berkas?>,'rkt')" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus</a><?php else:?><a href="#!" onclick="upload_berkas(<?=$t->id_berkas?>,'rkt')" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Unggah</a><?php endif;?></td>
                                    	<?php endif ?>
                                    <td>
                                    	<?php if ($t->set_pk == "on"): ?>
                                    		<?php if (!empty($t->pk)):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->pk.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a> <a href="javascript:void(0)" onclick="delete_berkas(<?=$t->id_berkas?>,'pk')" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus</a><?php else:?><a href="#!" onclick="upload_berkas(<?=$t->id_berkas?>,'pk')" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Unggah</a><?php endif;?></td>
                                    	<?php endif ?>
                                    <td>
                                    	<?php if ($t->set_lkj == "on"): ?>
                                    		<?php if (!empty($t->lkj)):?><a href="<?=base_url('data/berkas_unit_kerja/'.$t->lkj.'')?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Unduh</a> <a href="javascript:void(0)" onclick="delete_berkas(<?=$t->id_berkas?>,'lkj')" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Hapus</a><?php else:?><a href="#!" onclick="upload_berkas(<?=$t->id_berkas?>,'lkj')" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> Unggah</a><?php endif;?></td>
                                    	<?php endif ?>
                                    <td style="width:150px">
                                        <a href="javascript:void(0)" onclick="delete_(<?=$t->id_berkas?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
 								</tr>
                                    <?php $no++; } ?>
 							</table>



 						</div>
 					</div>

 				</div>    


 			</div>
 			<!-- .row -->

 		</div>

                <!-- sample modal content -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                            </div>
                        	<form id="form-upload" method="POST" enctype="multipart/form-data" >
                            <div class="modal-body">
                            		<div class="form-group">
									  <label class="control-label">Unggah Berkas</label>
									  <input type="file" name='userfile' id="input-file-now-custom-3" class="dropify" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
									</div>
                            </div>
                            <div class="modal-footer">
                            	<button type="submit" class="btn btn-primary ">Simpan</button>
                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        	</form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->


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

 			function delete_berkas(id,col){
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
 							url : "<?=base_url().'berkas_unit_kerja/delete_berkas/'?>"+id+"/"+col,
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

 			function upload_berkas(id,col) {
 				$('#myModal').modal();
 				$('#myModalLabel').text('Unggah berkas '+col);
 				$('#form-upload').attr('action',"<?=base_url().'berkas_unit_kerja/upload_berkas/'?>"+id+"/"+col);
 			}
 		</script>