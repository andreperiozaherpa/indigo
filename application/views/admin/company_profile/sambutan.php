<ol class="breadcrumb bc-3">
	<li>
		<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
	</li>
	<li>	
		<a href="#">Company profile</a>
	</li>
	<li class="active">		
		<strong>Sambutan</strong>
	</li>
</ol>
<table width='100%'>
	<tr>
		<td><h2>Sambutan</h2></td>
		<td align=right><a href='<?php echo base_url();?>manage_company_profile/add_sambutan' class="btn btn-blue">Add new</a></td>
	</tr>
</table>

<table class="table table-bordered datatable" id="data">
	<thead>
		<tr>
			<th width=70px>#</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th width=60px>Foto</th>
			<th width=70px>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$num = 1;
			foreach ($query as $row) {
				echo"
					<tr>
						<td>$num</td>
						<td>$row->nama</td>
						<td>$row->jabatan</td>
						<td>
							<img src='".base_url()."/data/images/sambutan/$row->foto' style='max-width:50px' />
						</td>
						
						<td>
							<a href='".base_url()."manage_company_profile/edit_sambutan/$row->id_sambutan' class='btn-xs' title='Edit'>
								
								<i class='entypo-pencil'></i>
							</a>
							<a class='btn-xs' title='Delete' onclick='jQuery(\"#confirm\").modal(\"show\");delete_(\"$row->id_sambutan\")'>
								<i class='entypo-cancel'></i>
							</a>
							
						</td>
					</tr>
				";

				$num++;
			}
		?>
	</tbody>
</table>
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
	function delete_(id)
	{
		$('#confirm_title').html('Confirmation');
		$('#confirm_content').html('Are you sure want to delete it?');
		$('#confirm_btn').html('Delete');
		$('#confirm_btn').attr('href',"<?php echo base_url();?>manage_company_profile/delete_sambutan/"+id);
	}
</script>
<link rel="stylesheet" href="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/css/datatables.responsive.css">
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/TableTools.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/lodash.min.js"></script>
<script src="<?php echo base_url()."asset/neon/neon-admin/" ;?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>