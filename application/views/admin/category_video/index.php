<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Semua Kategori Video</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_category_video">Kategori Video</a>
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
                        <div class="white-box">

<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        	<div class="pull-right">
                        		<form role="search" class="app-search hidden-xs m-r-10">
		                            <input type="text" name="s" placeholder="Search..." class="form-control" style="background:#eee;"> <a href="" class="active"><i class="fa fa-search"></i></a>
		                        </form>
                        	</div>
                            <h3 class="box-title"><a href="<?php echo base_url();?>manage_category_video/add" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">

<table class="table table-striped datatable" id="data">
	<thead>
		<tr>
			<th>#</th>
			<th>Kategori Video</th>
			<th>Status</th>
			<th width=70px>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$num = 1;
			foreach ($query as $row) {
				echo"
					<tr>
						<td>$num</td>
						<td>$row->category_video_name</td>
						<td>$row->category_video_status</td>
						<td>
							<a href='".base_url()."manage_category_video/edit/$row->category_video_id' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">
										
										<i class=\"fa fa-pencil text-inverse m-r-10\"></i> 
									</a>
									<a class='btn-xs' title='Delete'  onclick='delete_(\"$row->category_video_id\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
										<i class=\"fa fa-close text-danger\"></i>
									</a>
							
						</td>
					</tr>
				";

				$num++;
			}
		?>
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
        	window.location = "<?php echo base_url();?>manage_category_video/delete/"+id;
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
<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/css/datatables.responsive.css">
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/TableTools.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/lodash.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>