<div class="container-fluid">
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Hak Akses</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
					<a href="<?php echo base_url();?>manage_user"><i class="entypo-home"></i>User</a>
				</li>
                <li class="active">Akses</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
</div>
<!-- /.container-fluid -->
<!-- sample modal content -->
<!-- /.modal -->
<div id="access-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal Content is Responsive</h4> <small id="sub-title"></small>
            </div>
            <div class="modal-body">
            	<div id="access-data">
                    <div class="row">
                        <div class="col-md-4 b-r"> <strong>Status</strong>
                            <br>
                            <p class="text-muted" id="access-status-data">
                            	<span id="access-status-data-n" class="label label-danger hide" data-toggle="tooltip" title="This Access can't be accessed except Administrator."> Not Accessible</span>
                            	<span id="access-status-data-o" class="label label-info hide" data-toggle="tooltip" title="This Access is open access for all user."> Open Access</span>
                            	<span id="access-status-data-y" class="label label-success hide" data-toggle="tooltip" title="This Access can only be accessed by user that having access."> Allowed Only</span>
                            </p>
                        </div>
                        <div class="col-md-4 b-r"> <strong>Login</strong>
                            <br>
                            <p class="text-muted" id="access-login-data">
                            	<span id="access-login-data-n" class="label label-danger hide" data-toggle="tooltip" title="The user no need to LOGIN to enter this access."> No</span>
                            	<span id="access-login-data-y" class="label label-success hide" data-toggle="tooltip" title="The user must LOGIN to enter this access."> Yes</span>
                        	</p>
                        </div>
                        <div class="col-md-4"> <strong>Classification</strong>
                            <br>
                            <p class="text-muted" id="access-class-data">
                            	<span id="access-class-data-b" class="label label-primary hide"> Back-End Application</span>
                            	<span id="access-class-data-f" class="label label-info hide"> Front-End Application</span>
                            	<span id="access-class-data-j" class="label label-success hide"> Journal Report</span>
                            	<span id="access-class-data-i" class="label label-warning hide"> Index Reference</span>
                            	<span id="access-class-data-s" class="label label-danger hide"> System Setting</span>

                            	<span id="access-class-data-c" class="label label-primary hide"> Create</span>
                            	<span id="access-class-data-r" class="label label-success hide"> Read</span>
                            	<span id="access-class-data-u" class="label label-info hide"> Update</span>
                            	<span id="access-class-data-d" class="label label-danger hide"> Delete</span>
                            	<span id="access-class-data-a" class="label label-warning hide"> Additional</span>
                        	</p>
                        </div>
                    </div>
                    <hr/>
            		<div class="row">
            			<div class="col-md-12">
		            		<div class="well well-sm">
			                    <h5 class="font-bold">Access Detail</h5>
			                    <p id="access-detail-data">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
		                    </div>
            			</div>
            		</div>
            		<div class="row">
            			<div class="col-md-12">
            				<blockquote style="font-size: 14px;">
			                    <h5 class="font-bold">Message on Error</h5>
			                    <p id="access-message-data">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
			                    <small>Redirecting to <code id="access-redirect-data">example.com</code></small>
            				</blockquote>
            			</div>
            		</div>
            	</div>
                <form id="access-form" action="#!" hidden>
                    <div class="form-group">
                        <label for="access-name" class="control-label">Name*:</label>
                        <input type="text" class="form-control" name="access_name" id="access-name" placeholder="Access name." required>
                        <span class="help-block hide" id="access-name-taken"> This access is already taken.</span>
                    </div>
                    <div class="form-group">
                        <label for="access-alias" class="control-label">Alias:</label>
                        <input type="text" class="form-control" name="access_alias" id="access-alias" placeholder="Name to display.">
                    </div>
                    <div class="form-group">
                        <label for="access-detai" class="control-label">Detail:</label>
                        <textarea class="form-control" name="access_detail" id="access-detail" placeholder="More details about this access."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="access-message" class="control-label">Message on Error:</label>
                        <textarea class="form-control" name="access_message" id="access-message" placeholder="Can use variable {full_name}."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="access-redirect" class="control-label">Redirect Page:</label>
                        <div class="input-group"> <span class="input-group-addon"><?=base_url();?></span>
                        	<input type="text" class="form-control" name="access_redirect" id="access-redirect" placeholder="your_redirect_address">
                    	</div>
                    </div>
                    <div class="form-group">
                        <label for="access-status" class="control-label">Status*:</label>
	                    <div class="btn-group" data-toggle="buttons" id="access-status">
							<label class="btn btn-danger btn-outline waves-effect tooltip-danger" id="label-access-status-1" data-toggle="tooltip" title="This Access can't be accessed except Administrator.">
							    <input type="radio" name="access_status" id="access-status-1" value="N" checked=""> Not Accessible
							</label>
							<label class="btn btn-info btn-outline waves-effect tooltip-info" id="label-access-status-2" data-toggle="tooltip" title="This Access is open access for all user.">
							    <input type="radio" name="access_status" id="access-status-2" value="O"> Open Access
							</label>
							<label class="btn btn-success btn-outline waves-effect tooltip-success" id="label-access-status-3" data-toggle="tooltip" title="This Access can only be accessed by user that having access.">
							    <input type="radio" name="access_status" id="access-status-3" value="Y"> Allowed Only
							</label>
						</div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="access_login" value="N">
                        <div class="checkbox checkbox-circle">
	                        <input type="checkbox" name="access_login" id="access-login" value="Y">
                        	<label for="access-login" class="control-label"> The user must <strong>LOGIN</strong> to enter this access.</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="access-class" class="control-label">Classification*:</label>
                        <select class="form-control" name="access_class" id="access-class" required>
                        	<option value="">Select Access Class</option>

                        	<option value="B" class="access-class-c" hidden>Back-End Application</option>
                        	<option value="F" class="access-class-c" hidden>Front-End Application</option>
                        	<option value="J" class="access-class-c" hidden>Journal Report</option>
                        	<option value="I" class="access-class-c" hidden>Index Reference</option>
                        	<option value="S" class="access-class-c" hidden>System Setting</option>

                        	<option value="C" class="access-class-m" hidden>Create</option>
                        	<option value="R" class="access-class-m" hidden>Read</option>
                        	<option value="U" class="access-class-m" hidden>Update</option>
                        	<option value="D" class="access-class-m" hidden>Delete</option>
                        	<option value="A" class="access-class-m" hidden>Additional</option>
                        </select>
                    </div>
                    <button type="submit" id="access-form-submit" hidden></button>
                </form>
                <form id="status-access-form" action="#!" hidden>
                    <div class="form-group">
                        <label for="status-access-status" class="control-label">Status*:</label>
	                    <div class="btn-group" data-toggle="buttons" id="status-access-status">
							<label class="btn btn-danger btn-outline waves-effect tooltip-danger" id="status-label-access-status-1" data-toggle="tooltip" title="This Access can't be accessed except Administrator.">
							    <input type="radio" name="access_status" id="status-access-status-1" value="N" checked=""> Not Accessible
							</label>
							<label class="btn btn-info btn-outline waves-effect tooltip-info" id="status-label-access-status-2" data-toggle="tooltip" title="This Access is open access for all user.">
							    <input type="radio" name="access_status" id="status-access-status-2" value="O"> Open Access
							</label>
							<label class="btn btn-success btn-outline waves-effect tooltip-success" id="status-label-access-status-3" data-toggle="tooltip" title="This Access can only be accessed by user that having access.">
							    <input type="radio" name="access_status" id="status-access-status-3" value="Y"> Allowed Only
							</label>
						</div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="access_login" value="N">
                        <div class="checkbox checkbox-circle">
	                        <input type="checkbox" name="access_login" id="status-access-login" value="Y">
                        	<label for="status-access-login" class="control-label"> The user must <strong>LOGIN</strong> to enter this access.</label>
                        </div>
                    </div>
                    <button type="submit" id="status-access-form-submit" hidden></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button id="access-button" type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- .row -->
<div class="row" id="main-content">
    <div class="col-md-12">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			    <div class="panel panel-inverse">
			        <div class="panel-heading"> New Acces
			            <div class="pull-right">
			            	<?=($total_updated)?$total_updated:"";?>
			            	<a href="#!" onclick="new_access();"><i class="ti-plus"></i></a> 
			            	<a href="#!" data-perform="panel-dismiss"><i class="ti-close"></i></a> 
			            </div>
			        </div>
			    </div>
			    <div class="panel panel-inverse">
			        <div class="panel-heading"> Check Update
			            <div class="pull-right">
			            	<?=($total_rows)?$total_rows:"";?>
			            	<a href="#!" onclick="check_update();"><i class="ti-reload"></i></a> 
			            	<a href="#!" data-perform="panel-dismiss"><i class="ti-close"></i></a> 
			            </div>
			        </div>
			    </div>
			</div>
			<?php if ($total_rows > 0) :
				foreach ($controller as $c) :
					switch ($c->access_class) {
						case 'B':
							$c_class = "panel-primary";
							//Back-End Apllication
							break;

						case 'F':
							$c_class = "panel-info";
							//Front-End Apllication
							break;

						case 'J':
							$c_class = "panel-success";
							//Journal Report
							break;

						case 'I':
							$c_class = "panel-warning";
							//Index Reference
							break;

						case 'S':
							$c_class = "panel-danger";
							//System Setting
							break;
						
						default:
							$c_class = "panel-inverse";
							break;
					}

					switch ($c->access_status) {
						case 'N':
							$c_status = "text-danger";
							break;

						case 'O':
							$c_status = "text-info";
							break;

						case 'Y':
							$c_status = "text-success";
							break;
						
						default:
							$c_status = "";
							break;
					}
			?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			    <div class="panel <?=$c_class?>">
			        <div class="panel-heading"> <?=($c->access_alias)?$c->access_alias:$c->access_name;?>
			            <div class="pull-right">
			            	<?php if ($c->access_login == "Y"): ?><i class="fa fa-check-circle b-all img-circle"></i><?php endif ?>
			            	<i class="fa fa-circle b-all img-circle <?=$c_status?>"></i>
                            <div class="btn-group">
	                            <a href="#!" aria-expanded="false" data-toggle="dropdown"><i class="ti-settings"></i></a>
	                            <ul role="menu" class="dropdown-menu">
	                                <li><a href="#!" onclick="view_access('<?=$c->access_id;?>');" style="color: #5A738E !important;"><i class="fa fa-search"></i> View</a></li>
	                                <li><a href="#!" onclick="edit_access('<?=$c->access_id;?>');" style="color: #5A738E !important;"><i class="fa fa-pencil"></i> Edit</a></li>
	                                <li><a href="#!" onclick="status_access('<?=$c->access_id;?>');" style="color: #5A738E !important;"><i class="fa fa-check-square-o"></i> Status</a></li>
	                                <?php if ($c->access_name != "user_access"): ?><li><a href="#!" onclick="delete_access('<?=$c->access_id;?>');" style="color: #5A738E !important;"><i class="fa fa-trash"></i> Delete</a></li><?php endif ?>
	                            </ul>
	                        </div>
			            	<a href="#!" data-perform="panel-collapse"><i class="ti-minus"></i></a> 
			            	<a href="#!" data-perform="panel-dismiss"><i class="ti-close"></i></a> 
			            </div>
			        </div>
			        <div class="panel-wrapper collapse in" aria-expanded="true">
			            <div class="panel-body">
                            <div class="btn-group m-r-10 m-b-5">
                                <button onclick="new_method('<?=$c->access_id;?>');" class="btn btn-xs btn-default dropdown-toggle waves-effect waves-light" type="button"> <i class="fa fa-plus"></i> </button>
                            </div>
							<?php
								foreach ($result[$c->access_id] as $m) :
									if ($m->access_name != "index") :
										switch ($m->access_class) {
											case 'C':
												$m_class = "btn-primary";
												//Create
												break;

											case 'R':
												$m_class = "btn-success";
												//Read
												break;

											case 'U':
												$m_class = "btn-info";
												//Update
												break;

											case 'D':
												$m_class = "btn-danger";
												//Delete
												break;

											case 'A':
												$m_class = "btn-warning";
												//Additional
												break;
											
											default:
												$m_class = "btn-default";
												break;
										}

										switch ($m->access_status) {
											case 'N':
												$m_status = "text-danger";
												break;

											case 'O':
												$m_status = "text-info";
												break;

											case 'Y':
												$m_status = "text-success";
												break;
											
											default:
												$m_status = "";
												break;
										}
							?>
                            <div class="btn-group m-r-10 m-b-5">
                                <button aria-expanded="false" data-toggle="dropdown" class="btn btn-xs <?=$m_class?> dropdown-toggle waves-effect waves-light" type="button">
                                	<?=($m->access_alias)?$m->access_alias:$m->access_name;?> 
                            		<?php if ($m->access_login == "Y" AND $m->access_login != $c->access_login ): ?>
                            			<i class="fa fa-check-circle b-all img-circle"></i>
                            		<?php endif ?>
                            		<?php if ($m->access_status != $c->access_status ): ?>
                            			<i class="fa fa-circle b-all img-circle <?=$m_status?>"></i>
                            		<?php endif ?>
                                </button>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="#!" onclick="view_access('<?=$m->access_id;?>');"><i class="fa fa-search"></i> View</a></li>
                                    <li><a href="#!" onclick="edit_access('<?=$m->access_id;?>');"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#!" onclick="delete_access('<?=$m->access_id;?>');"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
							<?php endif; endforeach;?>
			            </div>
			        </div>
			    </div>
			</div>
			<?php endforeach; endif;?>
		</div>
    </div>
</div>
<!-- .row -->

<script type="text/javascript">
	function block_ui(element) {
        $(element).block({
            message: '<h4><img src="<?=base_url('asset/pixel');?>/plugins/images/busy.gif" /> We are processing your request.</h4>',
            css: {
                border: '1px solid #fff'
            }
        });
	}

	function new_access() {
		$("#access-modal").modal();
		$(".modal-title").text("New Access");
		$("#sub-title").text("");
		$("#access-form")[0].reset();
		$("#access-form").show();
		$("#status-access-form").hide();
		$("#access-data").hide();
  		$("#access-name-taken").addClass("hide");
		$("#label-access-status-1").addClass("active");
		$("#label-access-status-2").removeClass("active");
		$("#label-access-status-3").removeClass("active");
		$("#access-login").attr("checked", true);
		$(".access-class-c").show();
		$(".access-class-m").hide();
		$("#access-button").text("Save Access");
		$("#access-button").attr("onclick", "add_access();");
	}

	function new_method(id) {
		new_access();
		$(".modal-title").text("New Method");
		$(".access-class-c").hide();
		$(".access-class-m").show();
		$("#access-button").text("Save Method");
		$("#access-button").attr("onclick", "add_method("+id+");");
	}

	function add_access() {
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/add_access');?>",
	        type:"POST",
	        data: $('#access-form').serialize(),

	        success:function(resp){
	        	if (resp == true) {
	        		swal("Success!", "New Access has been added.", "success");
	          		window.location.reload(false); 
	          	} else if (resp == "taken") {
	          		$("#access-modal").unblock();
	          		$("#access-name").focus();
	          		$("#access-name-taken").removeClass("hide");
	          	} else if (resp == false) {
	          		$("#access-modal").unblock();
					$("#access-form-submit").click();
	          	} else {
	          		alert('Error Message: '+ resp);
	          	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#access-modal").unblock();
	      	}
	    })
	}

	function add_method(id) {
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/add_method');?>/"+id,
	        type:"POST",
	        data: $('#access-form').serialize(),

	        success:function(resp){
	        	if (resp == true) {
	        		swal("Success!", "New Method has been added.", "success");
	          		window.location.reload(false); 
	          	} else if (resp == "taken") {
	          		$("#access-modal").unblock();
	          		$("#access-name").focus();
	          		$("#access-name-taken").removeClass("hide");
	          	} else if (resp == false) {
	          		$("#access-modal").unblock();
					$("#access-form-submit").click();
	          	} else {
	          		alert('Error Message: '+ resp);
	          	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#access-modal").unblock();
	      	}
	    })
	}

	function view_access(id) {
		block_ui("#main-content");

		$("#access-status-data-n").addClass("hide");
		$("#access-status-data-o").addClass("hide");
		$("#access-status-data-y").addClass("hide");

		$("#access-login-data-n").addClass("hide");
		$("#access-login-data-y").addClass("hide");

		$("#access-class-data-b").addClass("hide");
		$("#access-class-data-f").addClass("hide");
		$("#access-class-data-i").addClass("hide");
		$("#access-class-data-j").addClass("hide");
		$("#access-class-data-s").addClass("hide");

		$("#access-class-data-c").addClass("hide");
		$("#access-class-data-r").addClass("hide");
		$("#access-class-data-u").addClass("hide");
		$("#access-class-data-d").addClass("hide");
		$("#access-class-data-a").addClass("hide");

	    $.ajax({
	        url:"<?php echo base_url('user_access/get_data_access');?>/"+id,
	        type:"GET",
            dataType: "json",
            cache: false,

	        success:function(resp){
	        	$("#main-content").unblock();
				$("#access-modal").modal();
				$("#access-form").hide();
				$("#status-access-form").hide();
				$("#access-data").show();
				$("#access-button").text("Edit Access");
				$("#access-button").attr("onclick", "edit_access("+id+");");

	        	if (resp == false) {
	        		$(".modal-title").text("Not Found!");
					$("#access-button").attr("onclick", "");
	        	} else {
	        		if (resp[0].access_alias) {
	        			$(".modal-title").text(resp[0].access_alias);
	        			if (resp[0].access_name) { $("#sub-title").text(resp[0].access_name); }
	        		}
	        		else if (resp[0].access_name) {
	        			$(".modal-title").text(resp[0].access_name);
	        			$("#sub-title").text("");
	        		}
	        		else {
	        			$(".modal-title").text("Error!");
	        			$("#sub-title").text("");
	        		}

	        		if (resp[0].access_status == "N") { $("#access-status-data-n").removeClass("hide"); }
	        		else if (resp[0].access_status == "O") { $("#access-status-data-o").removeClass("hide"); }
	        		else if (resp[0].access_status == "Y") { $("#access-status-data-y").removeClass("hide"); }
	        		else {
						$("#access-status-data-n").addClass("hide");
						$("#access-status-data-o").addClass("hide");
						$("#access-status-data-y").addClass("hide");
	        		}

	        		if (resp[0].access_login == "N") { $("#access-login-data-n").removeClass("hide"); }
	        		else if (resp[0].access_login == "Y") { $("#access-login-data-y").removeClass("hide"); }
	        		else {
						$("#access-login-data-n").addClass("hide");
						$("#access-login-data-y").addClass("hide");
	        		}

	        		if (resp[0].access_class == "B") { $("#access-class-data-b").removeClass("hide"); }
	        		else if (resp[0].access_class == "F") { $("#access-class-data-f").removeClass("hide"); }
	        		else if (resp[0].access_class == "I") { $("#access-class-data-i").removeClass("hide"); }
	        		else if (resp[0].access_class == "J") { $("#access-class-data-j").removeClass("hide"); }
	        		else if (resp[0].access_class == "S") { $("#access-class-data-s").removeClass("hide"); }

	        		else if (resp[0].access_class == "C") { $("#access-class-data-c").removeClass("hide"); }
	        		else if (resp[0].access_class == "R") { $("#access-class-data-r").removeClass("hide"); }
	        		else if (resp[0].access_class == "U") { $("#access-class-data-u").removeClass("hide"); }
	        		else if (resp[0].access_class == "D") { $("#access-class-data-d").removeClass("hide"); }
	        		else if (resp[0].access_class == "A") { $("#access-class-data-a").removeClass("hide"); }

	        		else {
						$("#access-class-data-b").addClass("hide");
						$("#access-class-data-f").addClass("hide");
						$("#access-class-data-i").addClass("hide");
						$("#access-class-data-j").addClass("hide");
						$("#access-class-data-s").addClass("hide");

						$("#access-class-data-c").addClass("hide");
						$("#access-class-data-r").addClass("hide");
						$("#access-class-data-u").addClass("hide");
						$("#access-class-data-d").addClass("hide");
						$("#access-class-data-a").addClass("hide");
	        		}

	        		$("#access-detail-data").text(resp[0].access_detail);
	        		$("#access-message-data").text(resp[0].access_message);
	        		$("#access-redirect-data").text("<?=base_url();?>"+resp[0].access_redirect);
	        	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#main-content").unblock();
	      	}
	    })
	}

	function edit_access(id) {
		block_ui("#main-content");
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/get_data_access');?>/"+id,
	        type:"GET",
            dataType: "json",
            cache: false,

	        success:function(resp){
	        	$("#main-content").unblock();
	        	$("#access-modal").unblock();
				
	        	if (resp == false) {
	        		$(".modal-title").text("Not Found!");
					$("#access-button").attr("onclick", "");
	        	} else {
		        	if (resp[0].access_level == "1") {
		        		new_access();
						$(".modal-title").text("Edit Access");
						$("#access-button").text("Save Access");
						$("#access-button").attr("onclick", "save_access("+id+");");
		        	} else if (resp[0].access_level == "2") {
		        		new_method();
						$(".modal-title").text("Edit Method");
						$("#access-button").text("Save Method");
						$("#access-button").attr("onclick", "save_access("+id+");");
		        	}

	        		if (resp[0].access_name) { $("#access-name").val(resp[0].access_name); }
	        		if (resp[0].access_alias) { $("#access-alias").val(resp[0].access_alias); }
	        		if (resp[0].access_detail) { $("#access-detail").val(resp[0].access_detail); }
	        		if (resp[0].access_message) { $("#access-message").val(resp[0].access_message); }
	        		if (resp[0].access_redirect) { $("#access-redirect").val(resp[0].access_redirect); }
	        		if (resp[0].access_status) {
	        			if (resp[0].access_status == "N") {
	        				$("#access-status-1").attr("checked", true);
	        				$("#access-status-2").attr("checked", false);
	        				$("#access-status-3").attr("checked", false);

							$("#label-access-status-1").addClass("active");
							$("#label-access-status-2").removeClass("active");
							$("#label-access-status-3").removeClass("active");
	        			} else if (resp[0].access_status == "O") {
	        				$("#access-status-1").attr("checked", false);
	        				$("#access-status-2").attr("checked", true);
	        				$("#access-status-3").attr("checked", false);
	        				
							$("#label-access-status-1").removeClass("active");
							$("#label-access-status-2").addClass("active");
							$("#label-access-status-3").removeClass("active");
	        			} else if (resp[0].access_status == "Y") {
	        				$("#access-status-1").attr("checked", false);
	        				$("#access-status-2").attr("checked", false);
	        				$("#access-status-3").attr("checked", true);
	        				
							$("#label-access-status-1").removeClass("active");
							$("#label-access-status-2").removeClass("active");
							$("#label-access-status-3").addClass("active");
	        			}
	        		}
	        		if (resp[0].access_login == "Y") { $("#access-login").attr("checked", true); } else { $("#access-login").attr("checked", false); }
	        		if (resp[0].access_class) { $("#access-class").val(resp[0].access_class); }
	        	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#main-content").unblock();
	        	$("#access-modal").unblock();
	      	}
	    })
	}

	function save_access(id) {
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/update_access');?>/"+id,
	        type:"POST",
	        data: $('#access-form').serialize(),

	        success:function(resp){
	        	if (resp == true) {
	        		swal("Success!", "Access has been updated.", "success");
	          		window.location.reload(false); 
	          	} else if (resp == "not found") {
	          		$("#access-modal").unblock();
	        		swal("Sorry", "Access not found!", "error");
	          	} else if (resp == "taken") {
	          		$("#access-modal").unblock();
	          		$("#access-name").focus();
	          		$("#access-name-taken").removeClass("hide");
	          	} else if (resp == false) {
	          		$("#access-modal").unblock();
					$("#access-form-submit").click();
	          	} else {
	          		alert('Error Message: '+ resp);
	          	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#access-modal").unblock();
	      	}
	    })
	}

	function delete_access(id) {
		block_ui("#main-content");

	    $.ajax({
	        url:"<?php echo base_url('user_access/get_data_access');?>/"+id,
	        type:"GET",
            dataType: "json",
            cache: false,

	        success:function(resp){
    			$("#main-content").unblock();
	        	if (resp == false) {
        			swal("Sorry", "Access not found!");
	        	} else {
			        swal({   
			            title: "Are you sure?",   
			            text: "You will not be able to recover this access!",   
			            type: "warning",   
			            showCancelButton: true,   
			            confirmButtonColor: "#DD6B55",   
			            confirmButtonText: "Yes, delete it!",   
			            closeOnConfirm: false 
			        }, function(){   
					    $.ajax({
					        url:"<?php echo base_url('user_access/delete_access');?>/"+resp[0].access_id+"/"+resp[0].access_level,
					        type:"GET",
				            dataType: "json",
				            cache: false,

					        success:function(ret){
					        	if (ret == true) {
				            		swal("Deleted!", "Access has been deleted.", "success");
		          					window.location.reload(false);  
		          				} else if (ret == "not found") {
		          					swal("Sorry", "Access not found!", "error");
		          				} else {
					          		alert('Error Message: '+ ret);
					          	}
					        },
					      	error:function(event, textStatus, errorThrown) {
					         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
					      	}
					    })
			        });
	        	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#main-content").unblock();
	      	}
	    })
	}

	function check_update() {
        swal({   
            title: "Are you sure?",   
            text: "You want to update all access!",   
            type: "warning",   
            showCancelButton: true,    
            confirmButtonText: "Yes, update all!",   
            closeOnConfirm: false 
        }, function(){  
        	block_ui(".sweet-alert"); 
		    $.ajax({
		        url:"<?php echo base_url('user_access/check_update');?>",
		        type:"GET",
	            dataType: "json",
	            cache: false,

		        success:function(resp){
		        	$(".sweet-alert").unblock();
		        	if (resp > 0) {
	            		swal("Success!", resp+" Access has been updated.", "success");
      					window.location.reload(false);  
      				} else if (resp == 0) {
      					swal("Sorry", "No Access has been updated.", "error");
      				} else {
		          		alert('Error Message: '+ ret);
		          	}
		        },
		      	error:function(event, textStatus, errorThrown) {
		         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
		         	$(".sweet-alert").unblock();
		      	}
		    })
        });
	        
	}

	function status_access(id) {
		block_ui("#main-content");
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/get_data_access');?>/"+id,
	        type:"GET",
            dataType: "json",
            cache: false,

	        success:function(resp){
	        	$("#main-content").unblock();
	        	$("#access-modal").unblock();
				
	        	if (resp == false) {
	        		$(".modal-title").text("Not Found!");
					$("#access-button").attr("onclick", "");
	        	} else {
	        		new_access();
					$("#access-form").hide();
					$("#status-access-form").show();
					$(".modal-title").text("Update Status");
					$("#access-button").text("Update Status");
					$("#access-button").attr("onclick", "update_status("+id+");");

	        		if (resp[0].access_status) {
	        			if (resp[0].access_status == "N") {
	        				$("#status-access-status-1").attr("checked", true);
	        				$("#status-access-status-2").attr("checked", false);
	        				$("#status-access-status-3").attr("checked", false);

							$("#status-label-access-status-1").addClass("active");
							$("#status-label-access-status-2").removeClass("active");
							$("#status-label-access-status-3").removeClass("active");
	        			} else if (resp[0].access_status == "O") {
	        				$("#status-access-status-1").attr("checked", false);
	        				$("#status-access-status-2").attr("checked", true);
	        				$("#status-access-status-3").attr("checked", false);
	        				
							$("#status-label-access-status-1").removeClass("active");
							$("#status-label-access-status-2").addClass("active");
							$("#status-label-access-status-3").removeClass("active");
	        			} else if (resp[0].access_status == "Y") {
	        				$("#status-access-status-1").attr("checked", false);
	        				$("#status-access-status-2").attr("checked", false);
	        				$("#status-access-status-3").attr("checked", true);
	        				
							$("#status-label-access-status-1").removeClass("active");
							$("#status-label-access-status-2").removeClass("active");
							$("#status-label-access-status-3").addClass("active");
	        			}
	        		}
	        		if (resp[0].access_login == "Y") { $("#status-access-login").attr("checked", true); } else { $("#status-access-login").attr("checked", false); }
	        	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#main-content").unblock();
	        	$("#access-modal").unblock();
	      	}
	    })
	}

	function update_status(id) {
		block_ui("#access-modal");

	    $.ajax({
	        url:"<?php echo base_url('user_access/update_status');?>/"+id,
	        type:"POST",
	        data: $('#status-access-form').serialize(),

	        success:function(resp){
	        	if (resp == true) {
	        		swal("Success!", "Access has been updated.", "success");
	          		window.location.reload(false); 
	          	} else if (resp == "not found") {
	          		$("#access-modal").unblock();
	        		swal("Sorry", "Access not found!", "error");
	          	} else if (resp == false) {
	          		$("#access-modal").unblock();
					$("#status-access-form-submit").click();
	          	} else {
	          		alert('Error Message: '+ resp);
	          	}
	        },
	      	error:function(event, textStatus, errorThrown) {
	         	alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        		$("#access-modal").unblock();
	      	}
	    })
	}
</script>