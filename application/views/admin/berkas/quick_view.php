<style type="text/css">
	.dataTables_filter, .dataTables_info { display: none; }
</style>
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Semua berkas</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Beranda</a>
				</li>
				<li>	
					<a href="<?php echo base_url();?>manage_category_finance">Daftar berkas</a>
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


				<div class="col-sm-12 col-md-12">
					<div class="white-box">
						<a href="javascript:void(0)" class="btn btn-primary pull-right" onclick="export_excel()"><i class="ti-export"></i> Export Excel</a>
						<div class="row">
						<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped datatable" id="quick_table">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Unit Kerja</th>
										<th>Nama Kegiatan</th>
										<th>Waktu Input</th>
										<th width=100px>Aksi</th>
									</tr>
									<tr>
										<th></th>
										<th style="font-weight: lighter;">Nama Unit Kerja</th>
										<th style="font-weight: lighter;">Nama Kegiatan</th>
										<th style="font-weight: lighter;">Waktu Input</th>
										<th width=100px></th>
									</tr>
								</thead>
								<tbody>

									<?php $no=1; foreach($data as $a){?>
										<tr>
											<td><?php echo $no?></td>
											<td><?php echo $a->nama_unit_kerja?></td>
											<td><?php echo $a->nama_kegiatan?></td>
											<td><?php echo tanggal($a->tanggal_input).' '.stime($a->waktu_input)?></td>
											<td>
												<a href='javascript:void(0)' id="btn<?php echo $a->id_berkas ?>" onclick="detail(<?php echo $a->id_berkas ?>)" class='btn btn-primary'>
													<i class="icon-eye"></i> Lihat
												</a>
											</td>
										</tr>
										<?php $no++; } ?>

									</tbody>
								</table>
							</div>
						</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		</div>

		<div id="file_list" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Detail Berkas</h4> 
      </div>
      <div class="modal-body">
      	<div id="content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
		<div id="export_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Export Excel</h4> 
      </div>
      <div class="modal-body">
      	<div id="content">
      		<?=form_open('berkas/export_excel',array('class'=>'form-horizontal'))?>
                    <div class="form-group">
                        <label class="col-md-12">Unit Kerja</label>
                        <div class="col-md-12">
                        	<select name="id_unit_kerja" class="form-control select2">
                        		<option value="all">Semua Unit Kerja</option>
                        		<?php foreach($unit_kerja as $u){
                        			echo '<option value="'.$u->id_unit_kerja.'">'.$u->nama_unit_kerja.'</option>';
                        		} ?>
                        	</select>
                     	</div>
                 	</div>

                    <div class="form-group">
                        <label class="col-md-12">Rentang Waktu</label>
                        <!-- <div class="row"> -->
                        	<div class="col-md-4">
                        		<select onchange="toggleRentang()" id="j_rentang" name="j_rentang" class="form-control">
                        			<option value="semua">Semua Waktu</option>
                        			<option value="tanggal">Tanggal Terpilih</option>
                        		</select>
                        	</div>
                        <div id="div_rentang" style="display: none" class="col-md-8">
                        	<input type="text" name="rentang_waktu" class="form-control input-daterange-datepicker">
                     	<!-- </div> -->
                     	</div>
                 	</div>

<!--                     <div class="form-group">
                        <label class="col-md-12">User</label>
                        <div class="col-md-12">
                        	<select class="form-control">
                        		<option value="">Semua User</option>
                        	</select>
                     	</div>
                 	</div> -->
                    <div class="form-group">
                        <label class="col-md-12">Ukuran Kertas</label>
                        <div class="col-md-12">
                        	<select name="kertas" class="form-control">
                        		<option value="A4">A4</option>
                        		<option value="F5">F5</option>
                        	</select>
                     	</div>
                 	</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Download</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
      		</form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
				window.location = "<?php echo base_url();?>berkas/delete/"+id;
				swal("Berhasil!", "Data telah terhapus.", "success"); 
			});
		}
		function detail(id){
			$('#btn'+id).html('<i class="fa fa-circle-o-notch fa-spin"></i> Memuat ...');
			$.ajax({
				url : "http://imcreativestudio.com:80/sidapel/berkas/fetch_berkas/" + id,
				type: "GET",
				success: function(data)
				{
					$('#content').html(data); 
					$('#file_list').modal('show'); 
					$('#btn'+id).html('<i class="icon-eye"></i> Lihat');
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert("Gagal mendapatkan data");
				}
			});
		}

		function export_excel(){
			$('#export_modal').modal('show'); 
		}
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
		function toggleRentang(){
			var j_rentang = $('#j_rentang').val();
			if(j_rentang=='tanggal'){
				$('#div_rentang').css('display','block');
			}else{

				$('#div_rentang').css('display','none');
			}
		}
	</script>
