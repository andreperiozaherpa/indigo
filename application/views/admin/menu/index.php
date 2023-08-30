
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Menu Frontend</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
							<li>
								<a href="<?php echo base_url();?>admin"><i class="entypo-home"></i>Home</a>
							</li>
							<li>	
								<a href="<?php echo base_url();?>manage_menu">Menu</a>
							</li>
							<li class="active">		
								<strong>All Menu</strong>
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
                            <h3 class="box-title"><a href="<?php echo base_url();?>manage_menu/add_menu" class="btn btn-success btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>Add</a></h3>
                            <p class="text-muted m-b-20"></p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
		<tr>
			<th>#</th>
			<th>Nama menu</th>
			<th>Parent</th>
			<th>Link</th>
			<th width=100px>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$num = 1;
			foreach ($query as $row) {
				echo"
					<tr>
						<td>$num</td>
						<td>$row->menu</td>
						<td>$row->parent_id</td>
						<td>$row->link</td>
						<td>
															<a href='".base_url()."manage_menu/edit_menu/$row->id_menu' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\">
																
																<i class=\"fa fa-pencil text-inverse m-r-10\"></i> 
															</a>
															<a class='btn-xs' title='Delete'  onclick='delete_(\"$row->id_menu\")' data-toggle=\"tooltip\" data-original-title=\"Close\">
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
        	window.location = "<?php echo base_url();?>manage_menu/delete/"+id;
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        });
	}
</script>