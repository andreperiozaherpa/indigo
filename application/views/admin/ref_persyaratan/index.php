<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Ref. Persyaratan Analisis Kebutuhan</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>manage_category_finance">Persyaratan Analisis Kebutuhan </a>
				</li>
				<li class="active">		
					<strong>Semua</strong>
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

				<div class="col-sm-12 col-md-4">

					<div class="white-box">
						<div class="row">
							<div class="form-group">
								<div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;">
									<a href="<?php echo base_url()."talenta/persyaratan/add" ?>" class="btn btn-primary waves-effect waves-light"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Persyaratan</a>
									<hr/>
								</div>
							</div>

							<form method="POST">
								<div class="form-group">
									<label class="control-label"> Eselon</label>
									<select class="form-control" name="eselon">
										<option value="">Pilih Eselon</option>
										<option value="I">I</option>
										<option value="II">II</option>
										<option value="III">III</option>
										<option value="IV">IV</option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label"> Persyaratan</label>
									<input type="text" name="persyaratan" class="form-control" placeholder="Masukkan Persyaratan">
								</div>



								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<a href='<?php echo base_url('ref_satuan') ?>' class="btn btn-default">Ulangi</a>
										<input type="submit" class="btn btn-primary" value="Saring" name="filter">
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-8">
					<div class="white-box">


						<div class="table-responsive">

							<table class="table table-striped datatable" id="myTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Eselon</th>
										<th>Persyaratan</th>

										<th width=70px>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
									//$persyaratan = array('Memiliki pangkat serendah-rendahnya Pembina Tk. I (IV/b)','Jabatan Administrator paling singkat 4 tahun','Jabatan Fungsional jenjang Ahli Madya paling singkat 4 tahun','Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a','Usia paling tinggi 56 tahun pada saat pendaftaran, kecuali bagi pelamar yang sedang menduduki Jabatan Pimpinan Tinggi Pratama atau jabatan yang disetarakan dengan jabatan struktural eselon II.a dan Jabatan Fungsional Jenjang Ahli Madya.','berpendidikan paling rendah sarjana (S1) sesuai bidang yang diminatinya, diutamakan pelamar dengan latar belakang pendidikan magister/pascasarjana (S2).');
									foreach($persyaratan as $p){
									?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$p->eselon;?></td>
										<td><?=$p->persyaratan?></td>
										<td>
											<a href='' class='btn-xs' title='Edit' data-toggle="tooltip" data-original-title="Edit">

												<i class="fa fa-pencil text-inverse m-r-10"></i> 
											</a>
											<a class='btn-xs' title='Delete'  onclick='delete_("")' data-toggle="tooltip" data-original-title="Close">
												<i class="fa fa-close text-danger"></i>
											</a>
										</td>
									</tr>
								<?php
								$no++;
								} ?>
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
				window.location = "<?php echo base_url();?>ref_satuan/delete/"+id;
				swal("Berhasil!", "Data telah terhapus.", "success"); 
			});
		}
	</script>

	<script type="text/javascript">
		var responsiveHelper;
		var breakpointDefinition = {
			tablet: 1024,
			phone : 480
		};
		var tableContainer;

		jQuery(document).ready(function($)
		{
			tableContainer = $("#data");

			tableContainer.dataTable({
				"sPaginationType": "bootstrap",
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"bStateSave": true,


		    // Responsive Settings
		    bAutoWidth     : false,
		    fnPreDrawCallback: function () {
		        // Initialize the responsive datatables helper once.
		        if (!responsiveHelper) {
		        	responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
		        }
		    },
		    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		    	responsiveHelper.createExpandIcon(nRow);
		    },
		    fnDrawCallback : function (oSettings) {
		    	responsiveHelper.respond();
		    }
		});

			$(".dataTables_wrapper select").select2({
				minimumResultsForSearch: -1
			});
		});

	</script>
	<script type="text/javascript">
		function ganti(){
			var type = $('#type').val();
			if(type=='lembaga'){
				$('#switch').css('display','block');
			}else{

				$('#switch').css('display','none');
			}
		}
	</script>
