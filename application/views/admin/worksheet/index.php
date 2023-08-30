<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Worksheet</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                   
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_project">All worksheet</a>
							</li>
							<li class="active">		
								<strong>Add</strong>
							</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                <div class="col-sm-3">
                <div class="white-box">
                    <form method="POST">
                <div class="form-group">
                    <label class="control-label">Project Name</label>
                    <input type="text" name="project_name" id="firstName" class="form-control" placeholder="">
                </div>

                  <div class="form-group">
                    <label class="control-label">Services</label>
                    <select name="id_services" class="form-control">
                        <option value="">All</option>
                        <?php foreach ($services as $key): ?>
                            <option value="<?php echo $key->id_services ?>"><?php echo $key->nama_services ?></option>
                        <?php endforeach ?>
                    </select>
                 </div>

                 <div class="form-group">
                    <label class="control-label">Client</label>
                    <select name="id_client" class="form-control">
                        <option value="">All</option>
                        <?php foreach ($client as $key): ?>
                            <option value="<?php echo $key->id_client ?>"><?php echo $key->nama_client ?></option>
                        <?php endforeach ?>
                    </select>
                 </div>

                 <div class="form-group">
                    <label class="control-label">Priority</label>
                    <select name="priority" class="form-control">
                        <option value="">All</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                 </div>

                

                   <button class="btn btn-info pull-right" type="submit"> Filter</button>
                   <br>
                </form>
                </div>
                </div>


                    <div class="col-sm-9">
                        <div class="white-box">
<?php if (!empty($message)) echo "
				<div class='alert alert-$message_type'>$message</div>";?>
 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                        	
                            
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">

<table class="table table-striped datatable" id="data">
	<thead>
		<tr>
			<th>#</th>
            <th>Worksheet</th>
			<th>Member </th>
            <th>Project Name </th>
			<th>Client </th>
            <th>Priority </th>
			<th>Date </th>
            <th>Status</th>
			<th width=100px>Action</th>
		</tr>
	</thead>
	<tbody>
        
        
		<?php $no=0; foreach ($query as $key): $no++;?>
                    <?php 
                        if ($key->status_worksheet=="progress"){
                            $hiddenproses = "";
                            $hiddenkirim = "hidden";
                            $status_label = "info";
                        } elseif ($key->status_worksheet=="approved") {
                            $hiddenproses = "hidden";
                            $hiddenkirim = "hidden";
                            $status_label = "success";
                        } elseif ($key->status_worksheet=="rejected") {
                            $hiddenproses = "hidden";
                            $hiddenkirim = "hidden";
                            $status_label = "danger";
                        } else {
                            $hiddenproses = "hidden";
                            $hiddenkirim = "";
                            $status_label = "primary";
                        }
                    ?>
					<tr>
						<td><?php echo $no ?></td>
                        <td><?php echo $key->jobs ?></td>
                        <td><ul><?php foreach ($employee as $em){ $array_member = explode(',', $key->member); $selecting = (array_search($em->employee_id, $array_member) === false ) ? '' : 'selecting'; if (!empty($selecting)) echo "<li>{$em->employee_name}</li>" ;} ?></ul></td>
                        <td><?php echo $key->project_name ?></td>
                        <td><?php echo $key->nama_client ?></td>
                        <td><?php echo $key->priority ?></td>
                        <td>
                            <?php echo $key->date_start." to ".$key->date_end ?>
                            <?php if(!empty($key->date_exp) AND $key->date_exp!="0000-00-00" AND date("Y-m-d")<=$key->date_exp) : $tgl_awal = new datetime(date("Y-m-d")); $tgl_akhir = new datetime($key->date_exp); echo $tgl_akhir->diff($tgl_awal)->format("<br/>Current : <b>%a</b>");?> Day(s) Remaining <?php endif ?>
                        </td>
                        <td><button id="button-status-<?php echo $key->worksheet_id;?>" type="button" class="fcbtn btn btn-outline btn-<?php echo $status_label;?> btn-rounded btn-1e" title="" data-toggle="popover" data-placement="right" data-content="<?php echo $key->note ?>"> <?php echo $status_approve = (empty($key->status_worksheet)) ? "unchecked" : $key->status_worksheet ; ?> </button></td>
						<td>
						<?php echo "
						<a href='".base_url()."manage_worksheet/detail/{$key->project_id}' class='btn-xs' title='view' data-toggle=\"tooltip\" data-original-title=\"view\">
										
										<i class=\"fa fa-eye text-inverse m-r-10\"></i> 
									</a>
							"; ?>

						</td>
					</tr>
            <?php endforeach ?>
				
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
            title: "Are you sure?",   
            text: "You will not be able to recover this imaginary file!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false 
        }, function(){   
        	window.location = "<?php echo base_url();?>manage_project/delete/"+id;
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
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
