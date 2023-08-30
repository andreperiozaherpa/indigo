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

 <div class="col-sm-12 col-md-4">

                <div class="white-box">
                	<div class="row">
        <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12 " style="text-align:center;"><a href="<?php echo base_url();?>berkas/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a>
                <hr/>
              </div>
            </div>

                	<form method="POST">
                   <div class="form-group">
                	<label class="control-label">Unit Kerja</label>
                            <select name="id_unit_kerja" class="form-control select2">
                                <option value="">Pilih Unit Kerja</option>
                                <?php 
                                foreach($unit_kerja as $u){
                                    echo'<option value="'.$u->id_unit_kerja.'">'.$u->nama_unit_kerja.'</option>';
                                }
                                ?>
                            </select>
                </div>

				<div class="form-group">
                	<label class="control-label">Nama Kegiatan</label>
                	<input type="text" id="firstName" name="nama_kegiatan" class="form-control" placeholder="">
                </div>
					 
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <a href='<?php echo base_url('berkas') ?>' class="btn btn-default">Reset</a>
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
			<th>Nama Unit Kerja</th>
			<th>Nama Kegiatan</th>
			<th>Waktu Input</th>
			<th width=100px>Aksi</th>
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
				<a href='<?=site_url('berkas/detail/'.$a->id_berkas.'')?>' class='btn btn-primary btn-circle' title='Detail' data-toggle="tooltip" data-original-title="Detail">
					<i class="icon-eye"></i>
				</a>
				<a href='<?=site_url('berkas/edit/'.$a->id_berkas.'')?>' class='btn btn-default btn-circle' title='Edit' data-toggle="tooltip" data-original-title="Edit">
					<i class="icon-pencil"></i>
				</a>
                <a class='btn btn-danger btn-circle' title='Delete'  onclick='delete_("<?=$a->id_berkas?>")' data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon-trash"></i>
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
        	window.location = "<?php echo base_url();?>berkas/delete/"+id;
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
