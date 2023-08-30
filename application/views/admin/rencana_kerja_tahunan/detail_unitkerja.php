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
     <!-- <div class="row">
     	<div class="col-md-12">
     		<a href="#"><button class="btn  btn-default waves-effect waves-light pull-right"> <i class="fa fa-heart m-r-5"></i> <span>Butuh Bantuan ?</span></button> </a>
     	</div>
     </div> -->
     <br>

 	<div class="row">

 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
                    <?php if (!empty($message)) echo "
        <div class='alert alert-$message_type'>$message</div>";?>

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
                                        <tr><td style="width: 120px;">Jumlah Staff </td><td>:</td><td> <strong><?= $detail_unit['jumlah_pegawai'];?></strong>

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
 						<a href="<?=base_url('rencana_kerja_tahunan/add_sasaran').'/'.$_type.'/'.$rkt->id_rkt?>"<button type="button" class="btn btn-danger " ><i class="fa fa-plus"></i> 1.  Tambah Sasaran</button></a>

 						<a href="<?=base_url('rencana_kerja_tahunan/cetak_ss').'/'.$rkt->id_rkt?>"<button type="button" class="btn btn-default pull-right " style="margin-left: 5px;" ><i class="fa fa-plus"></i> 3. Cetak SS</button></a>


 						<a href="<?=base_url('rencana_kerja_tahunan/pembobotan').'/'.$_type.'/'.$rkt->id_rkt?>"<button type="button" class="btn btn-warning pull-right " ><i class="fa fa-plus"></i> 2. Lakukan Pembobotan SS</button></a>


 						<br>
 						<hr>

 						<table class="table color-table dark-table table-hover">

 							<thead>
 								<tr>
 									<th>#</th>
 									<th>Tahun</th>
 									<th>Unit Kerja</th>
 									<th>Kode SS </th>
 									<th>Sasaran Strategis</th>
 									<th>Jumlah IKU </th>
 									<th>Jumlah Pagu </th>
 									<th>Bobot SS</th>
 									<th>Opsi</th>
 								</tr>
 							</thead>
 							<tbody>
                            <?php
                            $i=1;
                            $CI = & get_instance();
                            $CI->load->model("indikator_model");
                            $CI->load->model("renaksi_model");
                            foreach ($sasaran as $row) {

                                if($rkt->level_unit_kerja<=0){
                                    $kode_sasaran = "kode_sasaran_strategis";
                                    $nama_sasaran = "sasaran_strategis";
                                    $id_sasaran = "id_sasaran_strategis";
                                    $type = "SS";
                                }
                                else if($rkt->level_unit_kerja==1){
                                    $kode_sasaran = "kode_sasaran_program";
                                    $nama_sasaran = "sasaran_program";
                                    $id_sasaran = "id_sasaran_program";
                                    $type = "SP";
                                }
                                else{
                                    $kode_sasaran = "kode_sasaran_kegiatan";
                                    $nama_sasaran = "sasaran_kegiatan";
                                    $id_sasaran = "id_sasaran_kegiatan";
                                    $type="SK";
                                }
                                $jumlahIndikator = $CI->indikator_model->getTotal($type,$row->id_unit_kerja,$rkt->tahun_rkt,$row->uid_ss);
                                $totalPagu = $CI->renaksi_model->getTotalPagu($type,$row->id_unit_kerja,$rkt->tahun_rkt,$row->uid_ss);
                                $warning_bobot = ($row->bobot==0)  ? "<p style='color:red'>Bobot belum di atur</p>" : "";
                                echo '
 								<tr>
 									<td>'.$i.'</td>
 									<td>'.$row->tahun.'</td>
 									<td>'.$row->nama_unit_kerja.'</td>
 									<td>'.$row->$kode_sasaran.'</td>
 									<td>'.$row->$nama_sasaran.'</td>
 									<td>'.number_format($jumlahIndikator).'</td>
 									<td>'.number_format($totalPagu).'</td>
 									<td>'.$row->bobot.' %'.$warning_bobot.'</td>
 									<td>
 										<a href="'.base_url('rencana_kerja_tahunan/edit_sasaran').'/'.$type.'/'.$rkt->id_rkt.'/'.$row->$id_sasaran.'"<button type="button" class="btn btn-default " > Edit Sasaran</button></a>
 									 <a href="'.base_url('rencana_kerja_tahunan/detail_sasaran').'/'.$type.'/'.$rkt->id_rkt.'/'.$row->$id_sasaran.'"<button type="button" class="btn btn-primary " > Detail</button></a>
                                     <a href="javascript:void(0)" onclick="hapus('.$row->$id_sasaran.')" class="btn btn-default "/> Hapus</a>

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

 			function hapus(id){
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
                            url : "<?=base_url().'rencana_kerja_tahunan/delete_ss/'?>"+id+"/<?= $rkt->id_rkt;?>",
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal("Berhasil", "Data Berhasil Dihapus!", "success");
                                location.reload();
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
                            }
                        });
                    }
                });
 			}
 		</script>
