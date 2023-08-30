 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Data Capaian Kinerja</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>admin">Dashboard</a></li>
 				<li class="active">Data Capaian</li>
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
 									$selected = (!empty($tahun_rkt) && $tahun_rkt==$r->tahun_rkt) ? "selected" : "";
 									echo'<option '.$selected.' value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
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
 									$selected = (!empty($id_unit_penanggungjawab) && $id_unit_penanggungjawab==$r->id_unit_kerja) ? "selected" : "";
 									echo'<option '.$selected.' value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
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

  <!-- .row -->
  <div class="row">

   <?php 

                $no=1;
                $CI = & get_instance();
                $CI->load->model("sasaran_strategis_model");
                $CI->load->model("sasaran_program_model");
                $CI->load->model("sasaran_kegiatan_model");
                $CI->load->model("indikator_model");
                $CI->load->model("renaksi_model");
                
                foreach ($item as $row) {
                  if($row->level_unit_kerja<=0){
                    $jumlahSS = $CI->sasaran_strategis_model->getTotalByUnit($row->id_unit_kerja,$row->tahun_rkt);
                    $type="SS";
                  }
                  else if($row->level_unit_kerja==1){
                    $jumlahSS = $CI->sasaran_program_model->getTotalByUnit($row->id_unit_kerja,$row->tahun_rkt);
                    $type="SP";
                  }
                  else{
                    $jumlahSS = $CI->sasaran_kegiatan_model->getTotalByUnit($row->id_unit_kerja,$row->tahun_rkt);
                    $type="SK";
                  }
                  $jumlahIndikator = $CI->indikator_model->getTotal($type,$row->id_unit_kerja,$row->tahun_rkt);
                  $totalPagu = $CI->renaksi_model->getTotalPagu($type,$row->id_unit_kerja,$row->tahun_rkt);
  ?>
<div class="col-md-4 col-sm-6">
        <div style="background-color: #4e2a84;padding:10px">
          <div class="row">
          <div class="pull-left">
            <div class="btn-group m-r-10">
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-outline dropdown-toggle  btn-circle" type="button"><i class="icon-options-vertical"></i></button>
              <ul role="menu" class="dropdown-menu animated flipInX">
                <li><a href="<?=base_url('data_capaian/detail_unitkerja/'.$row->id_rkt.'')?>" >Detail</a></li>
                <li><a href="#!" onclick="delete_('<?=$row->id_rkt;?>');"  >Hapus</a></li>
                <!-- <li><a href="#">Detail</a></li> -->
              </ul>
            </div>
          </div>
                <center><b style="line-height:40px;color: #fff">Data Capaian</b></center>
        </div>
        </div>
       <a href="<?=base_url('data_capaian/detail_unitkerja/'.$row->id_rkt.'')?>">
         <div class="white-box">
          <div class="row">
            <div class="col-md-6 text-center b-r">
              <h3 class="box-title m-b-0">TAHUN</h3>
              <!-- <?=$value->kode_sasaran_kegiatan?> -->
             </div>

             <div class="col-md-6 text-center ">
              <!-- <h3 class="box-title m-b-0">Jumlah IKU</h3> -->
             <span class="label label-primary"><?=$row->tahun_rkt?></span>
             </div>
          </div>
           <hr>
          <div class="row">
            <div style="min-height: 75px;" class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">Nama Unit Kerja</h3>
              <small><?=$row->nama_unit_kerja?></small>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-6 text-center b-r" style="color: #222">
              <?=number_format($jumlahSS)?> Sasaran
             </div>

             <div class="col-md-6 text-center " style="color: #222">
              <?=number_format($jumlahIndikator)?> IKU
                          </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 text-center" style="color: #222">
             <a href="<?=base_url('data_capaian/detail_unitkerja').'/'.$row->id_rkt.''?>" class="btn btn-primary btn-block">Data Capaian</a>
             </div>

          </div>


        </div>
        </a>
      </div>
 <?php 
                  $no++;
                } ?>
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