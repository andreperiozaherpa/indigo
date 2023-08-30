 <script type="text/javascript" wsc="<?php echo base_url()."asset/plugins/" ;?>jQuery/jQuery-2.1.3.min.js"></script>

<?php foreach ($query as $pr){} ?>
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
                                        <input name="project_name" type="text" id="firstName" class="form-control" value="<?php echo $pr->project_name ?>" placeholder="">
                                     </div>

                                      <div class="form-group">
                                        <label class="control-label">Services</label>
                                        <select name="id_services" class="form-control" required>
                                            <option>Select</option>
                                            <?php foreach ($services as $key): $selected = ($pr->id_services==$key->id_services)? 'selected' : '';?>
                                                <option value="<?php echo $key->id_services ?>" <?php echo $selected ?>><?php echo $key->nama_services ?></option>
                                            <?php endforeach ?>
                                        </select>
                                     </div>

                                     <div class="form-group">
                                        <label class="control-label">Client</label>
                                        <select name="id_client" class="form-control" required>
                                            <option>Select</option>
                                            <?php foreach ($client as $key): $selected = ($pr->id_client==$key->id_client)? 'selected' : '';?>
                                                <option value="<?php echo $key->id_client ?>" <?php echo $selected ?>><?php echo $key->nama_client ?></option>
                                            <?php endforeach ?>
                                        </select>
                                     </div>

                                     <div class="form-group">
                                        <label class="control-label">Priority</label>
                                        <select name="priority" class="form-control">
                                            <option <?php echo $selected = ($pr->priority=="High")? 'selected' : ';' ?>>High</option>
                                            <option <?php echo $selected = ($pr->priority=="Medium")? 'selected' : ';' ?>>Medium</option>
                                            <option <?php echo $selected = ($pr->priority=="Low")? 'selected' : ';' ?>>Low</option>
                                        </select>
                                     </div>

                                      <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea name="project_description" class="form-control"><?php echo $pr->project_description ?></textarea>
                                     </div>

                                      <div class="form-group">
                                        <label class="control-label">File</label>
                                         <input type="file" name='file' id="input-file-now-custom-3" class="dropify" value="<?php echo $pr->file ?>" data-default-file="<?php echo base_url()."data/project/{$pr->file}";?>" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                        <input type="hidden" name='old_file' value="<?php echo $pr->file?>">
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
                                                            <?php foreach ($employee as $key): $selected = ($pr->project_leader==$key->employee_id)? 'selected' : '';?>
                                                                <option value="<?php echo $key->employee_id ?>" <?php echo $selected ?>><?php echo "{$key->employee_name} ({$key->employee_designation})" ?></option>
                                                            <?php endforeach ?>
                                                           </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Team</label>
                                                         <select name="team[]" multiple="multiple" id='pre-selected-options' multiple='multiple'>
                                                            <?php foreach ($employee as $key): $array_team = explode(',', $pr->team); $selected = (array_search($key->employee_id, $array_team) === false ) ? '' : 'selected'?>
                                                                <option value="<?php echo $key->employee_id ?>" <?php echo $selected ?>><?php echo "{$key->employee_name}" ?></option>
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
                                                             <input name="date_start" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" value="<?php echo $pr->date_start ?>">
                                                             <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                        </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label class="control-label">End</label>
                                                             <input name="date_end" type="text" class="form-control mydatepicker" placeholder="mm/dd/yyyy" value="<?php echo $pr->date_end ?>">
                                                             <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                                        </div>
                                                        </div>

                                                 </div>
                                                </div>
                                            </div>


                                           


                                        </div>

                                <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="exampleModalLabel1">Note of reject</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">Note:</label>
                                                    <textarea class="form-control" id="message-text1"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Send message</button>
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
                                        <a href="<?php echo base_url('manage_project/detail/'.$pr->project_id); ?>" class="btn btn-default"> CANCEL</a>
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