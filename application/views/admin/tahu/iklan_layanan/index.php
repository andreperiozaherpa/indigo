
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Semua Iklan Layanan</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>tahu/manage_media/iklan_layanan">Iklan Layanan</a>
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
                        	<div class="pull-right">
                        		<form role="search" class="app-search hidden-xs m-r-10">
		                            <input type="text" name="s" placeholder="Search..." class="form-control" style="background:#eee;"> <a href="" class="active"><i class="fa fa-search"></i></a>
		                        </form>
                        	</div>
                            <h3 class="box-title"><a href="<?php echo base_url();?>tahu/manage_media/add_iklan_layanan" class="btn btn-primary btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Tambah Baru</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">
                                
<table class="table table-striped datatable" id="">
	<thead>
		<tr>
			<th>#</th>
			<th>Judul</th>
			<th>Gambar</th>
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
						<td>$row->nama_iklan</td>
						
						<td><a href='".base_url()."data/images/iklan_layanan/{$row->gambar}' class='image-popup-no-margins'><img src='".base_url()."data/images/iklan_layanan/{$row->gambar}' class='img-responsive thumbnail m-r-15' style='max-height:200px;'></a></td>
						<td>$row->status</td>
						<td>
							<a href='".base_url()."tahu/manage_media/edit_iklan_layanan/$row->id_iklan' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">
																
																<i class=\"fa fa-pencil text-inverse m-r-10\"></i> 
															</a>
															<a class='btn-xs' title='Delete'  onclick='delete_(\"$row->id_iklan\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
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
        	window.location = "<?php echo base_url();?>tahu/manage_media/delete_iklan_layanan/"+id;
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