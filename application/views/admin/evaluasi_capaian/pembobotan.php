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
     		<a href="#"><button class="btn  btn-default waves-effect waves-light pull-right"> <i class="fa fa-heart m-r-5"></i> <span>Butuh Bantuan ?</span></button> </a>
     	</div>
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
                            <div class="panel-heading"> Unit Kerja 1
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <table class="table">
                                    	<tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong>Nandang Koswara</strong></tr>
                                    	<tr><td>Jumlah Pegawai </td><td>:</td><td> <strong>30 Orang</strong></tr>

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
 						<form>




 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Kode SS</th>
 									<th>Nama Sasaran Strategis</th>
 									<th>Bobot % </th>
 								</tr>
 							</thead>
 							<tbody>
 								<tr>
 									<td>1</td>
 									<td>SS 01</td>
 									<td>Sasaran Strategis 1</td>
 									<td><input type="text" name="" class="form-control" value="8.3333333"></td>
 								</tr>
                                <tr>
                                    <td>2</td>
                                    <td>SS 01</td>
                                    <td>Sasaran Strategis 1</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>SS 01</td>
                                    <td>Sasaran Strategis 1</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>SS 01</td>
                                    <td>Sasaran Strategis 1</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>SS 01</td>
                                    <td>Sasaran Strategis 1</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>SS 01</td>
                                    <td>Sasaran Strategis 1</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                               
                                <tr>
                                    <td>7</td>
                                    <td>SS 07</td>
                                    <td>Sasaran Strategis 7</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>SS 08</td>
                                    <td>Sasaran Strategis 8</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>SS 09</td>
                                    <td>Sasaran Strategis 9</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>SS 10</td>
                                    <td>Sasaran Strategis 10</td>
                                    <td><input type="text" name="" class="form-control" value="8.3333333"></td>
                                </tr>

                                 <tr>
                                    <td colspan="2"></td>
                                    
                                    <td>Total</td>
                                    <td>100%</td>
                                </tr>

 							</table>
                                <button type="submit"  class="btn btn-primary pull-right">Simpan</button>

                        <a href="<?=base_url('rencana_kerja_tahunan/detail_unitkerja')?>"<button type="button" class="btn btn-default pull-right " style="margin-right: 5px;" > Batal</button></a>
                                </form>

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