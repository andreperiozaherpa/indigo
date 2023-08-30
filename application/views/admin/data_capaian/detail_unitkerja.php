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
 				<li><a href="<?= base_url();?>admin">Dashboard</a></li>
                <li><a href="<?= base_url();?>data_capaian">Data Capaian</a></li>
 				<li class="active">Detail Unit Kerja</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>
     <div class="row">
     	
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
                            <div class="panel-heading"> <?= $rkt->nama_unit_kerja;?>
                                <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a>  </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <table class="table">
                                        <tr><td style="width: 120px;">Nama Kepala </td><td>:</td><td> <strong><?= $detail_unit['nama_kepala'];?></strong></tr>
                                        <tr><td style="width: 120px;">Jabatan </td><td>:</td><td> <strong><?= $detail_unit['nama_jabatan'];?></strong></tr>
                                        <tr><td style="width: 120px;">Jumlah Staff </td><td>:</td><td> <strong><?= $detail_unit['jumlah_pegawai'];?></strong></tr>

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
 					

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Tahun</th>
                                    <th>Bobot</th>
 									<th>Kode SS </th>
 									<th>Sasaran Strategis</th>
                                    <th>Capaian</th>
 									<th>Opsi</th>
 								</tr>
 							</thead>
 							<tbody>
                            <?php
                            $i=1;
                            foreach ($sasaran as $row) {
                                echo '
 								<tr>
 									<td>'.$i.'</td>
 									<td>'.$row->tahun.'</td>
                                    <td>'.$row->bobot.' %</td>
 									<td>'.$row->$kode_sasaran.'</td>
 									<td>'.$row->$nama_sasaran.'</td>
                                    <td>'.number_format($row->capaian,2).' %</td>
 									<td>
 									 <a href="'.base_url('data_capaian/detail_sasaran').'/'.$_type.'/'.$rkt->id_rkt.'/'.$row->$id_sasaran.'"<button type="button" class="btn btn-primary " > Detail</button></a>
 									 </td> 
 								</tr>
                                ';
                                $i++;
                            }
                            ?>
                               
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