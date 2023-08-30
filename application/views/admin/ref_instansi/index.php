<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Semua Instansi</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Beranda</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_category_finance">Daftar Instansi</a>
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
              <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;"><a href="<?php echo base_url();?>ref_instansi/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a>
                <hr/>
              </div>
            </div>

                	<form method="POST">
                   <div class="form-group">
                	<label class="control-label"> Nama Instansi</label>
                	<input type="text" id="firstName" name="nama_instansi" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Telepon</label>
                	<input type="text" id="firstName" name="telepon" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Email</label>
                	<input type="text" id="firstName" name="email" class="form-control" placeholder="">
                </div>

				<div class="form-group">
                	<label class="control-label"> Website</label>
                	<input type="text" id="firstName" name="website" class="form-control" placeholder="">
                </div>



              	  <div class="form-group">
                	<label class="control-label">Tipe</label>
                	<select onchange="ganti()" id="type" name="level" class="form-control">
                        <option value="">Pilih Tipe</option>
                        <option value="koordinator">Koordinator</option>
                        <option value="lembaga">Lembaga</option>
                    </select>
               	 </div>

               	 <div id="switch" class="form-group">
                	<label class="control-label">Pilih Koordinator</label>
                	<select name="id_koordinator" class="form-control">
                        <option value="">Pilih Koordinator</option>
						<?php 
							foreach ($koordinator as $k) {
								echo "<option value='$k->id_instansi'>$k->nama_instansi</option>";
							}
						?>
                    </select>
               	 </div>

				


               	 	 <div class="form-group">
                	<label class="control-label">Keterangan </label>
	    			 <textarea class="form-control" name="keterangan"></textarea>

               	 </div>
					 
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <a href='<?php echo base_url('ref_instansi_') ?>' class="btn btn-default">Reset</a>
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
			<th>Nama Instansi</th>
			<th>Email</th>
			<th>Telepon</th>
			<th>Level</th>
			<th>Koordinator</th>

			<th width=70px>Aksi</th>
		</tr>
	</thead>
	<tbody>
		
	<?php $no=1; foreach($koordinator as $a){?>
		<tr>
			<td><?php echo $no?></td>
			<td><?php echo $a->nama_instansi?></td>
			<td><?php echo $a->email?></td>
			<td><?php echo $a->telepon?></td>
			<td><?php echo ucfirst($a->level)?></td>
			<td>
				<?php 
					$id = $a->id_koordinator;
					if($id==0){
						echo'-';
					}else{
						$this->ref_instansi_model->id_instansi = $a->id_koordinator;
						$nama = $this->ref_instansi_model->get_by_id()->nama_instansi;
						echo $nama;
					}
				?>
			</td>
			<td>
				<a href='<?=site_url('ref_instansi/edit/'.$a->id_instansi.'')?>' class='btn-xs' title='Edit' data-toggle="tooltip" data-original-title="Edit">
                                        
                                        <i class="fa fa-pencil text-inverse m-r-10"></i> 
                                    </a>
                                    <a class='btn-xs' title='Delete'  onclick='delete_("<?=$a->id_instansi?>")' data-toggle="tooltip" data-original-title="Close">
                                        <i class="fa fa-close text-danger"></i>
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
        	window.location = "<?php echo base_url();?>ref_instansi/delete/"+id;
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