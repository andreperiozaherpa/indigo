<div id="main-content" class="container-fluid">

	<div class="row bg-title">
		<!-- .page title -->
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Program RPJMD</h4>
		</div>
		<!-- /.page title -->
		<!-- .breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li><a href="">Dashboard</a></li>
				<li><a href="">Program RPJMD</a></li>
				<li class="active">Detail</li>
			</ol>
		</div>
		<!-- /.breadcrumb -->
	</div>
	<!-- .row -->
	<div class="row">



		<div class="col-md-12">



			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<div class="panel panel-default block6">
						<div class="panel-heading"> Detail Program
							<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
						</div>
						<div class="panel-wrapper collapse in" aria-expanded="true">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 b-r">
										<div class="row">
											<div class="col-md-12 b-b-">
												<h3 class="box-title m-b-0">Visi</h3>
												<p><?=$detail->visi;?></p>
											</div>
											<div class="col-md-12 b-b-">
												<h3 class="box-title m-b-0">Misi</h3>
												<p><?=$detail->misi;?></p>
											</div>

											<div class="col-md-12 b-b-">
												<h3 class="box-title m-b-0">Tujuan</h3>
												<p><?=$detail->tujuan;?></p>
											</div>
											<div class="col-md-12">
												<h3 class="box-title m-b-0">Indikator Tujuan</h3>
												<p><?=$detail->nama_indikator_tujuan;?></p>
											</div>


										</div>
										
									</div>
									<div class="col-md-6">




										<div class="col-md-12">
											<h3 class="box-title m-b-0">Tujuan OPD</h3>
											<p><?=$detail->nama_sasaran_rpjmd;?></p>
										</div>

										<div class="col-md-12">
											<h3 class="box-title m-b-0">Indikator Sasaran</h3>
											<p><?=$detail->nama_indikator_sasaran_rpjmd;?></p>
										</div>

										<div class="col-md-12">
											<h3 class="box-title m-b-0">Urusan</h3>
											<p><?=$detail->nama_urusan;?> </p>
										</div>
										<div class="col-md-12">
											<h3 class="box-title m-b-0">Sub Urusan</h3>
											<p><?=$detail->kode_sub_urusan.' '. $detail->nama_sub_urusan;?> </p>
										</div>

									</div>

								</div>

							</div>
						</div>
					</div>





					<div class="white-box">
						
						<div class="btn-group m-r-10">
							<button aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-gear m-r-5"></i> <span class="caret"></span></button>
							<ul role="menu" class="dropdown-menu">
								<li><a href="javascript:void(0)" onclick="edit_program();">Edit</a></li>
								<li>
									<a href="javascript:void(0)" title="" onclick="delete_program()"> Hapus </a>
								</li>
							</ul>
						</div>

						<strong>Program :</strong> <?=$detail->kode_program.' - '. $detail->nama_program;?>
						
						<hr>

						<table class="table table-bordered table-striped table-hover table-responsive " id="row-data">
							
						</table>
					</div>

					<div class="col-md-12 text-right">
						<a class="btn btn-default" href="<?=base_url();?>sicerdas/rpjmd/program">Kembali</a>
						<button type="button" class="btn btn-primary  full-right" onclick="addIndikator();"><i class="fa fa-plus"></i> Tambah Indikator</button>
					</div>
					<div class="col-12 text-center">
				        <nav class="mt-4 mb-3">
				            <ul class="pagination justify-content-center mb-0" id="pagination">
				            </ul>
				        </nav>
				      </div>
				</div>
				<!-- .row -->

			</div>

			<!-- Modal Tambah -->
			<div id="modal-indikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content  panel-primary">
						<div class="panel-heading">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="myLargeModalLabel2" style="color:white;">Tambah Indikator</h4>
						</div>
						<div class="modal-body">

							<form  id="formIndikator" class="form-horizontal">
								<div id="hidden"></div>
								<div class="form-group">
									<div class="col-md-12">
										<label class="col-md-12">Nama Indikator</label>
										<div class="col-md-12">
											<input type="text" name="nama_indikator_program_rpjmd" id="nama_indikator_program_rpjmd" class="form-control" placeholder="Masukkan Nama Indikator">
											<div class="text-danger error" id="err_nama_indikator_program_rpjmd"></div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<label class="col-sm-12">Satuan Pengukuran</label>
										<div class="col-sm-12">
											<select name="satuan" id="satuan" class="form-control select2 input_select">
												<option value="">Pilih Satuan Pengukuran</option>
												<?php foreach($dt_satuan as $row)
												{
													echo '<option value="'.$row->id_satuan.'">'.$row->satuan.'</option>';
												}
												?>
											</select>
											<div class="text-danger error" id="err_satuan"></div>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12">
										<label class="col-sm-12">Pagu digabungkan degan indikator:</label>
										<div class="col-sm-12">
											<select name="sumber_pagu" onchange="setPagu()" id="sumber_pagu" class="form-control select2 input_select">
												<option value="">-</option>
												<?php foreach($dt_indikator as $row)
												{
													echo '<option value="'.$row->id_indikator_program_rpjmd.'">'.$row->nama_indikator_program_rpjmd.'</option>';
												}
												?>
											</select>
											<div class="text-danger error" id="err_sumber_pagu"></div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">


										<div class="col-md-6">
											<table class="table table-bordered p-t-20">
												<tr class="active">
													<td colspan="2" style="text-align: center;"><b>Kondisi Awal</b></td>
												</tr>
												<tr>
													<td style="text-align: center;"><b>Target</b></td>
													<td style="text-align: center;"><b>Rupiah</b></td>
												</tr>
												<tr>
													<td>
														<input type="text" name="target_awal" id="target_awal" class="form-control" placeholder="Masukkan Kondisi target">
														<div class="text-danger error" id="err_target_awal"></div>
													</td>
													<td>
														<input type="number" name="target_awal_rp" id="target_awal_rp" class="form-control target_rp" placeholder="Masukkan Rupiah">
														<div class="text-danger error" id="err_target_awal_rp"></div>
													</td>
												</tr>
											</table>
										</div>

										<?php foreach($dt_tahun as $t => $tahun){?>
											<div class="col-md-6">
												<table class="table table-bordered p-t-20">
													<tr class="active">
														<td colspan="2" style="text-align: center;"><b>Tahun <?=$tahun;?></b></td>
													</tr>
													<tr>
														<td style="text-align: center;"><b>Target</b></td>
														<td style="text-align: center;"><b>Rupiah</b></td>
													</tr>
													<tr>
														<td>
															<input type="text" name="target_tahun_<?=($t+1);?>" id="target_tahun_<?=($t+1);?>" class="form-control" placeholder="Masukkan Kondisi target">
															<div class="text-danger error" id="err_target_tahun_<?=($t+1);?>"></div>
														</td>
														<td>
															<input type="number" name="target_tahun_<?=($t+1);?>_rp" id="target_tahun_<?=($t+1);?>_rp" class="form-control target_rp" placeholder="Masukkan Rupiah">
															<div class="text-danger error" id="err_target_tahun_<?=($t+1);?>_rp"></div>
														</td>
													</tr>
												</table>
											</div>
										<?php }?>

										<div class="col-md-6">
											<table class="table table-bordered p-t-20">
												<tr class="active">
													<td colspan="2" style="text-align: center;"><b>Kondisi Akhir</b></td>
												</tr>
												<tr>
													<td style="text-align: center;"><b>Target</b></td>
													<td style="text-align: center;"><b>Rupiah</b></td>
												</tr>
												<tr>
													<td>
														<input type="text" name="target_akhir" id="target_akhir" class="form-control" placeholder="Masukkan Kondisi target">
														<div class="text-danger error" id="err_target_akhir"></div>
													</td>
													<td>
														<input type="number" name="target_akhir_rp" id="target_akhir_rp" class="form-control target_rp" placeholder="Masukkan Rupiah">
														<div class="text-danger error" id="err_target_akhir_rp"></div>
													</td>
												</tr>
											</table>
										</div>


										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<label class="col-sm-12">SKPD Penanggung Jawab</label>
											<div class="col-sm-12">
												<select  id="ids_skpd" multiple class="select2 input_select">
													<option value="">Pilih SKPD</option>
													<?php foreach($dt_skpd as $row)
													{
														echo '<option value="'.$row->id_skpd.'">'.$row->nama_skpd.'</option>';
													}
													?>
												</select>
												<div class="text-danger error" id="err_ids_skpd"></div>
											</div>
										</div>
									</div>
								
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary waves-effect text-left" onclick="saveIndikator()">Simpan</button>

						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>

		</div>
	</div>
</div>

<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="data-title">Tambah Program</h4>
        </div>
        <div class="modal-body">
          <form id="form-data" action="#!">



           <div class="form-group">
            <label for="data-id_misi" class="control-label">Misi</label>
            <select id="id_misi" name="id_misi" class="form-control select2 input_select" onchange="get_tujuan()" >
             <option value="">Pilih</option>
             <?php foreach($dt_misi as $misi){
             	$selected = ($detail->id_misi == $misi->id_misi) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$misi->id_misi.'">'.$misi->misi.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_misi"></div>
          </div>

          <div class="form-group">
            <label for="id_tujuan" class="control-label">Tujuan</label>
            <select id="id_tujuan" name="id_tujuan" class="form-control select2 input_select" onchange="get_indikator()">
             <option value="">Pilih</option>
             <?php foreach($dt_tujuan as $row){
             	$selected = ($detail->id_tujuan == $row->id_tujuan) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_tujuan.'">'.$row->tujuan.'</option>';
            }
            ?>
           </select>
           <div class="text-danger error" id="err_id_tujuan"></div>
          </div>
          <div class="form-group">
            <label for="id_indikator_tujuan" class="control-label">Indikator Tujuan</label>
            <select id="id_indikator_tujuan" name="id_indikator_tujuan" class="form-control select2 input_select" onchange="get_sasaran()">
              <option value="">Pilih</option>
             <?php foreach($dt_indikator_tujuan as $row){
             	$selected = ($detail->id_indikator_tujuan == $row->id_indikator_tujuan) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_indikator_tujuan.'">'.$row->nama_indikator_tujuan.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_indikator_tujuan"></div>
          </div>

          <div class="form-group">
            <label for="id_sasaran_rpjmd" class="control-label"> Tujuan OPD</label>
            <select id="id_sasaran_rpjmd" name="id_sasaran_rpjmd" class="form-control select2 input_select" onchange="get_indikator_sasaran()">
              <option value="">Pilih</option>
             <?php foreach($dt_sasaran->result() as $row){
             	$selected = ($detail->id_sasaran_rpjmd == $row->id_sasaran_rpjmd) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_sasaran_rpjmd.'">'.$row->nama_sasaran_rpjmd.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_sasaran_rpjmd"></div>
          </div>
          

          <div class="form-group">
            <label for="id_indikator_sasaran_rpjmd" class="control-label">Indikator Sasaran</label>
            <select id="ids_indikator_sasaran_rpjmd" multiple class="form-control_ select2 input_select" >
              <option value="">Pilih</option>
             <?php foreach($dt_sasaran_indikator->result() as $row){
             	$selected = (in_array($row->id_indikator_sasaran_rpjmd, $detail->ids_indikator_sasaran_rpjmd)) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_indikator_sasaran_rpjmd.'">'.$row->nama_indikator_sasaran_rpjmd.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_indikator_sasaran_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_urusan" class="control-label">Urusan</label>
            <select  name="id_urusan" id="id_urusan" class="form-control select2 input_select" onchange="get_sub_urusan_by_urusan()">
              <option value="">Pilih</option>
              <?php foreach($dt_urusan as $u){
              	$selected = ($detail->id_urusan == $u->id_urusan) ? "selected" : "";
                echo "<option $selected value='$u->id_urusan'>$u->nama_urusan</option>";
              }
              ?>
            </select>
            <div class="text-danger error" id="err_id_urusan"></div>
          </div>

          <div class="form-group">
            <label for="id_sub_urusan" class="control-label">Sub Urusan</label>
            <select  name="id_sub_urusan"  id="id_sub_urusan" class="form-control select2 input_select" onchange="get_program_by_sub_urusan()">
              <option value="">Pilih</option>
             <?php foreach($dt_sub_urusan->result() as $row){
             	$selected = ($detail->id_sub_urusan == $row->id_sub_urusan) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_sub_urusan.'">'.$row->nama_sub_urusan.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_sub_urusan"></div>
          </div>

          <div class="form-group">
            <label for="id_ref_program" class="control-label">Pilih Program</label>
            <select  name="id_ref_program" id="id_ref_program" class="form-control select2 input_select"  >
              <option value="">Pilih</option>
             <?php foreach($dt_program->result() as $row){
             	$selected = ($detail->id_ref_program == $row->id_ref_program) ? "selected" : "";
              	echo '<option '.$selected.' value="'.$row->id_ref_program.'">'.$row->kode_program.' - '.$row->nama_program.'</option>';
            }
            ?>
        	</select>
            <div class="text-danger error" id="err_id_ref_program"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="data-button" class="btn btn-primary" onclick="save()">Simpan</button>
      </div>
    </div>
    <!-- /#data-content -->
  </div>
  <!-- /#data-dialog -->
</div>

<script type="text/javascript">
	var action = '';
	var id_program_rpjmd = '<?=$detail->id_program_rpjmd;?>';;
	var id_indikator = 0;
	var rowData = {};

	
	function edit_program()
   	{
      $(".modal-title").html("Edit program");
      action = "edit";
      reset_error();
      $("#data-modal").modal();
   	}

   function reset_error()
   {
      $(".error").html("");
   }

   function save()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action",action);
      formdata.append("id_program_rpjmd",id_program_rpjmd);
      formdata.append("ids_indikator_sasaran_rpjmd",$("#ids_indikator_sasaran_rpjmd").val());
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/program/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){

            if(data.status){
               $('#data-modal').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               	setTimeout(function(){
               		location.reload();
           		},500);
               
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal(
                  'Opps',
                  data.message,
                  'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
   }

   

   function delete_program() {
   	swal({
   		title: "Hapus program ?",
			//text: "Apakah anda yakin akan menghapus data ini?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Ya',
			cancelButtonText: "Tidak",
			closeOnConfirm: false
		},
		function (isConfirm) {
			if (isConfirm) {
				$.ajax({
					url: "<?=base_url()?>sicerdas/rpjmd/program/delete",
					type: 'post',
					dataType: 'json',
					data: {
						id: '<?=$detail->id_program_rpjmd;?>',
					},
					success: function (data) {
						//console.log(data);
						if (data.status == true) {
							swal({
								type: 'success',
								title: 'Berhasil',
								text: data.message,
								showConfirmButton: false,
								timer: 1500
							});

							window.location = '<?=base_url();?>sicerdas/rpjmd/program';
						} else {
							swal("Opps", data.message, "error");
						}
					},
					error: function (xhr, status, error) {
						//swal("Opps","Error","error");
						console.log(xhr);
					}
				});
			}
		});
   }

   function addIndikator()
   {
   	$(".modal-title").html("Tambah Indikator");
   	$('#formIndikator')[0].reset();
   	$("#satuan").val("").trigger("change");
	$("#sumber_pagu").val("").trigger("change");
   	action = "add";
   	id_indikator = 0;
   	id_program_rpjmd = '<?=$detail->id_program_rpjmd;?>';
   	reset_error();
   	$("#modal-indikator").modal();
   }

   function editIndikator(i)
   {
   	$(".modal-title").html("Edit Indikator");
   	$('#formIndikator')[0].reset();
   	action = "edit";
   	id_indikator = rowData[i].id_indikator_program_rpjmd;
   	id_sasaran = '<?=$detail->id_sasaran_rpjmd;?>';
   	reset_error();

   	$("#nama_indikator_program_rpjmd").val(rowData[i].nama_indikator_program_rpjmd);
   	$("#satuan").val(rowData[i].satuan).trigger("change");
	$("#sumber_pagu").val(rowData[i].sumber_pagu).trigger("change");
   	$("#target_awal").val(rowData[i].target_awal);
   	$("#target_akhir").val(rowData[i].target_akhir);
   	$("#target_tahun_1").val(rowData[i].target_tahun_1);
   	$("#target_tahun_2").val(rowData[i].target_tahun_2);
   	$("#target_tahun_3").val(rowData[i].target_tahun_3);
   	$("#target_tahun_4").val(rowData[i].target_tahun_4);
   	$("#target_tahun_5").val(rowData[i].target_tahun_5);

   	$("#target_awal_rp").val(rowData[i].target_awal_rp);
   	$("#target_akhir_rp").val(rowData[i].target_akhir_rp);
   	$("#target_tahun_1_rp").val(rowData[i].target_tahun_1_rp);
   	$("#target_tahun_2_rp").val(rowData[i].target_tahun_2_rp);
   	$("#target_tahun_3_rp").val(rowData[i].target_tahun_3_rp);
   	$("#target_tahun_4_rp").val(rowData[i].target_tahun_4_rp);
   	$("#target_tahun_5_rp").val(rowData[i].target_tahun_5_rp);

   	$("#ids_skpd").val(rowData[i].ids_skpd).trigger("change");

   	$("#modal-indikator").modal();
   	//console.log(rowData[i]);
   }

   function reset_error()
   {
   	$(".error").html("");
   }


   function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/rpjmd/program_indikator/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
      	id_program_rpjmd : id_program_rpjmd,
      },
      success: function (data) {
        $("#row-data").html(data.content);
        $("#pagination").html(data.pagination);
        rowData = data.result;
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
   }


   function saveIndikator()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('formIndikator'));
      formdata.append("action",action);
      formdata.append("id_program_rpjmd",id_program_rpjmd);
      formdata.append("id_indikator",id_indikator);
      formdata.append("ids_skpd",$("#ids_skpd").val());
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/program_indikator/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
         	console.log(data);
            if(data.status){
               $('#modal-indikator').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               //loadPagination(1);
			   setTimeout(() => {
				   location.reload();
			   }, 1500);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal(
                  'Opps',
                  data.message,
                  'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
   }

   function hapusIndikator(id) {
   	swal({
   		title: "Hapus Indikator ?",
   		type: "warning",
   		showCancelButton: true,
   		confirmButtonColor: '#DD6B55',
   		confirmButtonText: 'Ya',
   		cancelButtonText: "Tidak",
   		closeOnConfirm: false
   	},
   	function(isConfirm) {
   		if (isConfirm) {
   			$.ajax({
   				url        : "<?=base_url()?>sicerdas/rpjmd/program_indikator/delete",
   				type       : 'post',
   				dataType   : 'json',
   				data       : {
   					id      : id,
   				},
   				success    : function(data){
   					if(data.status==true)
   					{
   						swal({
   							type: 'success',
   							title: 'Berhasil',
   							text: data.message,
   							showConfirmButton: false,
   							timer: 1500
   						});

   						loadPagination(1);
   					}
   					else{
   						swal("Opps",data.message,"error");
   					}
   				},
   				error: function(xhr, status, error) {
   					console.log(xhr);
   				}
   			});
   		}
   	});   
   }


   function get_tujuan()
   {
      $("#id_tujuan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/tujuan/get_tujuan_by_misi/",
         type: 'post',
         dataType: 'json',
         data: {
            id_misi : $("#id_misi").val(),
         },
         success: function (data) {
            $("#id_tujuan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
   }
   function get_indikator()
   {
      $("#id_indikator_tujuan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/tujuan/get_indikator_by_tujuan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_tujuan : $("#id_tujuan").val(),
         },
         success: function (data) {
            $("#id_indikator_tujuan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_sasaran()
    {
      $("#id_sasaran_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/sasaran/get_sasaran_by_indikator/",
         type: 'post',
         dataType: 'json',
         data: {
            id_indikator_tujuan : $("#id_indikator_tujuan").val(),
         },
         success: function (data) {
            $("#id_sasaran_rpjmd").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_indikator_sasaran()
    {
      $("#id_indikator_sasaran_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/sasaran_indikator/get_indikator_by_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_rpjmd : $("#id_sasaran_rpjmd").val(),
         },
         success: function (data) {
            $("#id_indikator_sasaran_rpjmd").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
    function get_sub_urusan_by_urusan()
    {
      $("#id_sub_urusan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/urusan/get_sub_urusan_by_urusan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_urusan : $("#id_urusan").val(),
         },
         success: function (data) {
            $("#id_sub_urusan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
    
    function get_program_by_sub_urusan()
    {
      $("#id_ref_program").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/program/get_program_by_sub_urusan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sub_urusan : $("#id_sub_urusan").val(),
         },
         success: function (data) {
            $("#id_ref_program").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
	function setPagu()
	{
		let sumber_pagu = $("#sumber_pagu").val();
		if(sumber_pagu)
		{
			
			$(".target_rp").attr("disabled",true);
			$(".target_rp").val("");
			//console.log(sumber_pagu);
		}
		else{
			$(".target_rp").attr("disabled",false);
		}
		
	}
</script>