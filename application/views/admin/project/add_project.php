 <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add Project </h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Project</a></li>
                            <li class="active">Add</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                  
                        <div class="row">
                        	<div class="col-md-2">
                            	

							</div>
                            <hr>
                            <form role="form" method='post' enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5 white-box">
                              		 <div class="form-group">
					                	<label class="control-label">Project Name</label>
					                	<input name="project_name" type="text" id="firstName" class="form-control" placeholder="">
					               	 </div>

					               	  <div class="form-group">
					                	<label class="control-label">Services</label>
					                	<select name="id_services" class="form-control" required>
                                            <option>Select</option>
                                            <?php foreach ($services as $key): ?>
                                                <option value="<?php echo $key->id_services ?>"><?php echo $key->nama_services ?></option>
                                            <?php endforeach ?>
                                        </select>
					               	 </div>

					               	 <div class="form-group">
					                	<label class="control-label">Client</label>
					                	<select name="id_client" class="form-control" required>
                                            <option>Select</option>
                                            <?php foreach ($client as $key): ?>
                                                <option value="<?php echo $key->id_client ?>"><?php echo $key->nama_client ?></option>
                                            <?php endforeach ?>
                                        </select>
					               	 </div>

					               	 <div class="form-group">
					                	<label class="control-label">Priority</label>
					                	<select name="priority" class="form-control">
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
					               	 </div>

					               	  <div class="form-group">
					                	<label class="control-label">Description</label>
					                	<textarea name="project_description" class="form-control"></textarea>
					               	 </div>

					               	  <div class="form-group">
					                	<label class="control-label">File</label>
					               		 <input type="file" name='file' id="input-file-now-custom-3" class="dropify"  data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
					               	 </div>

					               	 



                                  
                                      
                                    </div>
                                    <div class="col-md-1">
                                    
                                    </div>
                                    

                                    <div class="col-md-6 ">

                                    	<div class="row">
                                    		<div class="col-md-12 white-box">
		                                        <address>
		                                           
		                                            <h4 class="font-bold">Team </h4>
		                                            <hr>
		                                            <div class="form-group">
							                			<label class="control-label">Project Leader</label>
							                			 <select name="project_leader" class="form-control select2">
							                                <option>Select</option>
                                                            <?php foreach ($employee as $key): ?>
                                                                <option value="<?php echo $key->employee_id ?>"><?php echo "{$key->employee_name} ({$key->employee_designation})" ?></option>
                                                            <?php endforeach ?>
							                               </select>
							               		    </div>

							               		    <div class="form-group">
							                			<label class="control-label">Team</label>
							                			 <select name="team[]" multiple="multiple" id='pre-selected-options'>
                                                            <?php foreach ($employee as $key): ?>
                                                                <option value="<?php echo $key->employee_id ?>"><?php echo "{$key->employee_name}" ?></option>
                                                            <?php endforeach ?>
				                                        </select>
							                		</div>


		                     
		                                           
		                                        </address>
                                        	</div>
                                        </div>

                                        <div class="row">
                                    		<div class="col-md-12 white-box">
                                    			<div class="row">
		                                            <h4 class="font-bold">Project Date </h4>
		                                            <hr>
		                                         		<div class="col-md-6">
			                                            <div class="form-group">
								                			<label class="control-label">Start</label>
								                			 <input name="date_start" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
	                                           				 <span class="input-group-addon"><i class="icon-calender"></i></span> 
	                                           			</div>
	                                           			</div>

	                                           			<div class="col-md-6">
	                                           			 <div class="form-group">
								                			<label class="control-label">End</label>
								                			 <input name="date_end" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy">
	                                           				 <span class="input-group-addon"><i class="icon-calender"></i></span> 
	                                           			</div>
	                                           			</div>

	                                           	 </div>
		                     					</div>
                                        	</div>


                                    	   


                                    	</div>

                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <a href="<?php echo base_url('manage_project/'); ?>" class="btn btn-default"> CANCEL</a>
                                        <button class="btn btn-info" type="submit"> SAVE</button>
                                        
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                   <script type="text/javascript">
    $(document).ready(function() {
        // Nestable
        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        $('#nestable').nestable({
            group: 1
        }).on('change', updateOutput);

        $('#nestable2').nestable({
            group: 1
        }).on('change', updateOutput);

        updateOutput($('#nestable').data('output', $('#nestable-output')));
        updateOutput($('#nestable2').data('output', $('#nestable2-output')));

        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('#nestable-menu').nestable();
    });
    </script>