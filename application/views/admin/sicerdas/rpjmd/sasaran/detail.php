<div id="main-content" class="container-fluid">

	<div class="row bg-title">
		<!-- .page title -->
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Tujuan OPD</h4>
		</div>
		<!-- /.page title -->
		<!-- .breadcrumb -->
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li><a href="#">Dashboard</a></li>
				<li><a href="#">Tujuan OPD</a></li>
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
						<div class="panel-heading"> Detail Sasaran
							<div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> <a href="#" data-perform="panel-dismiss"><i class="ti-close"></i></a> </div>
						</div>
						<div class="panel-wrapper collapse in" aria-expanded="true">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6 b-r">
										<div class="row">
											<div class="col-md-12 b-b">
												<h3 class="box-title m-b-0">Visi</h3>
												<p><?=$detail->visi;?></p>
											</div>
											<div class="col-md-12">
												<h3 class="box-title m-b-0">Misi</h3>
												<p><?=$detail->misi;?></p>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="col-md-12 b-b">
											<h3 class="box-title m-b-0">Tujuan</h3>
											<p><?=$detail->tujuan;?></p>
										</div>

										<div class="col-md-12">
											<h3 class="box-title m-b-0">Indikator Tujuan</h3>
											<p><?=$detail->nama_indikator_tujuan;?></p>
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
									<li><a href="javascript:void(0)" onclick="edit_sasaran();">Edit</a></li>
									<li>
										<a href="javascript:void(0)" title="" onclick="delete_sasaran()"> Hapus </a>
									</li>
								</ul>
							</div>

							<strong>Nama Sasaran :</strong> <?=$detail->nama_sasaran_rpjmd;?>
						
						<hr>

						<table class="table table-bordered table-striped table-hover table-responsive " id="row-data">
							
						</table>
					</div>

					<div class="col-md-12 text-right">
						<a class="btn btn-default" href="<?=base_url();?>sicerdas/rpjmd/sasaran">Kembali</a>
						<button type="button" class="btn btn-primary  full-right" onclick="add();"><i class="fa fa-plus"></i> Tambah Indikator</button>
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
			<div id="modal-indikator" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true" >
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
									<label class="col-md-12">Nama Indikator</label>
									<div class="col-md-12">
										<input type="text" name="nama_indikator_sasaran_rpjmd" id="nama_indikator_sasaran_rpjmd" class="form-control input_text" placeholder="Masukkan Nama Indikator">
										<div class="text-danger error" id="err_nama_indikator_sasaran_rpjmd"></div>
									</div>
								</div>

								<div class="form-group">
									
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

								<div class="form-group">


									<div class="col-md-6">
										<table class="table table-bordered p-t-20">
											<tr class="active">
												<td style="text-align: center;"><b>Target Kondisi Awal</b></td>
											</tr>
											<tr>
												<td>
													<input type="text" name="target_awal" id="target_awal" class="form-control input_text" placeholder="Masukkan target awal">
													<div class="text-danger error" id="err_target_awal"></div>
												</td>
											</tr>
										</table>
									</div>

									<?php foreach($dt_tahun as $t => $tahun){?>
									<div class="col-md-6">
										<table class="table table-bordered p-t-20">
											<tr class="active">
												<td style="text-align: center;"><b>Target Tahun <?=$tahun;?></b></td>
											</tr>
											<tr>
												<td>
													<input type="text" name="target_tahun_<?=($t+1);?>" id="target_tahun_<?=($t+1);?>"  class="form-control input_text" placeholder="Masukkan target <?=$tahun;?>">
													<div class="text-danger error" id="err_target_tahun_<?=($t+1);?>"></div>
												</td>
											</tr>
										</table>
									</div>
									<?php }?>

									<div class="col-md-6">
										<table class="table table-bordered p-t-20">
											<tr class="active">
												<td style="text-align: center;"><b>Kondisi Akhir</b></td>
											</tr>
											<tr>
												<td>
													<input type="text" name="target_akhir" id="target_akhir" class="form-control input_text"  placeholder="Masukkan target akhir">
													<div class="text-danger error" id="err_target_akhir"></div>
												</td>
											</tr>
										</table>
									</div>



									<hr>


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


<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Tambah Sasaran</h4>
         </div>
         <div class="modal-body">
            <form id="form-data" >
               <div class="form-group">
                  <label for="id_misi" class="control-label">Misi</label>
                  <select id="id_misi" name="id_misi" class="form-control" onchange="get_tujuan()" readonly>
                     <option value="<?=$detail->id_misi;?>"><?=$detail->misi;?></option>
                  </select>
                  <div class="text-danger error" id="err_id_misi"></div>
               </div>
               <div class="form-group">
                  <label for="id_tujuan" class="control-label">Tujuan</label>
                  <select id="id_tujuan" name="id_tujuan" class="form-control" onchange="get_indikator()" readonly>
                     <option value="<?=$detail->id_tujuan;?>"><?=$detail->tujuan;?></option>
                  </select>
                  <div class="text-danger error" id="err_id_tujuan"></div>
               </div>
               <div class="form-group">
                  <label for="id_indikator_tujuan" class="control-label">Indikator Tujuan</label>
                  <select id="id_indikator_tujuan" name="id_indikator_tujuan" class="form-control" readonly>
                     <option value="<?=$detail->id_indikator_tujuan;?>"><?=$detail->nama_indikator_tujuan;?></option>
                  </select>
                  <div class="text-danger error" id="err_id_indikator_tujuan"></div>
               </div>
               <div class="form-group">
                  <label for="nama_sasaran_rpjmd" class="control-label"> Nama Sasaran </label>
                  <textarea id="nama_sasaran_rpjmd" class="form-control" name="nama_sasaran_rpjmd" ><?=$detail->nama_sasaran_rpjmd;?></textarea>
                  <div class="text-danger error" id="err_nama_sasaran_rpjmd"></div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript">
	var action = '';
	var id_sasaran = '<?=$detail->id_sasaran_rpjmd;?>';;
	var id_indikator = 0;
	var rowData = {};

  
	function edit_sasaran()
   	{
      $(".modal-title").html("Edit sasaran");
      $(".input_text").val("");
      $(".input_select").val("").trigger("change");
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
      formdata.append("id_sasaran",id_sasaran);
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/sasaran/save",
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

   

   function delete_sasaran() {
   	swal({
   		title: "Hapus sasaran ?",
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
					url: "<?=base_url()?>sicerdas/rpjmd/sasaran/delete",
					type: 'post',
					dataType: 'json',
					data: {
						id: '<?=$detail->id_sasaran_rpjmd;?>',
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

							window.location = '<?=base_url();?>sicerdas/rpjmd/sasaran';
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

   function add()
   {
   	$(".modal-title").html("Tambah Indikator");
   	$('#formIndikator')[0].reset();
   	$("#satuan").val("").trigger("change");
   	action = "add";
   	id_indikator = 0;
   	id_sasaran = '<?=$detail->id_sasaran_rpjmd;?>';
   	reset_error();
   	$("#modal-indikator").modal();
   }

   function editIndikator(i)
   {
   	$(".modal-title").html("Edit Indikator");
   	$('#formIndikator')[0].reset();
   	action = "edit";
   	id_indikator = rowData[i].id_indikator_sasaran_rpjmd;
   	id_sasaran = '<?=$detail->id_sasaran_rpjmd;?>';
   	reset_error();

   	$("#nama_indikator_sasaran_rpjmd").val(rowData[i].nama_indikator_sasaran_rpjmd);
   	$("#satuan").val(rowData[i].satuan).trigger("change");
   	$("#target_awal").val(rowData[i].target_awal);
   	$("#target_akhir").val(rowData[i].target_akhir);
   	$("#target_tahun_1").val(rowData[i].target_tahun_1);
   	$("#target_tahun_2").val(rowData[i].target_tahun_2);
   	$("#target_tahun_3").val(rowData[i].target_tahun_3);
   	$("#target_tahun_4").val(rowData[i].target_tahun_4);
   	$("#target_tahun_5").val(rowData[i].target_tahun_5);

   	$("#modal-indikator").modal();
   }

   function reset_error()
   {
   	$(".error").html("");
   }


   function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/rpjmd/sasaran_indikator/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
      	id_sasaran : id_sasaran,
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
      formdata.append("id_sasaran",id_sasaran);
      formdata.append("id_indikator",id_indikator);
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/sasaran_indikator/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){

            if(data.status){
               $('#modal-indikator').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               loadPagination(1);
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
   				url        : "<?=base_url()?>sicerdas/rpjmd/sasaran_indikator/delete",
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


</script>