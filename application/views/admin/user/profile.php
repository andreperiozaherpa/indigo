<script type="text/javascript">
    function confirm_kirim (no) {
        $('#send-message').attr('onclick',"kirim('"+no+"');");
    }

    function kirim(no){   
      data = new FormData($('#form')[0]);   
      $.ajax({
        url:"<?php echo base_url('manage_project/verifikasi/"+no+"/kirim');?>",
        type:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success:function(resp){
            window.location.reload(false); 
            //$('#status-'+no).html('<span class="label label-danger">Ditangguhkan</span>');
            /*$('#proses-'+no).removeClass('hidden');
            $('#kirim-'+no).addClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-info btn-rounded btn-1e');
            //$('#button-status-'+no).attr('data-content',$('#note').val());
            document.getElementById('button-status-'+no).innerHTML = " progress ";
            document.getElementById("form").reset();
            //progressbar();
            $('#status-'+no).val('progress');*/
        },
        error:function(event, textStatus, errorThrown) {
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    }

    function save(table){   
      $.ajax({
        url:"<?php echo base_url('manage_user/save_"+table+"/'.$this->uri->segment(3));?>",
        type:"POST",
        data: $('#form-'+table).serialize(),
        success:function(resp){
            document.getElementById("form-"+table).reset();
            $('#'+table+'-modal').modal('hide');
            swal("Good job!", "Data has been added.", "success");
        },
        error:function(event, textStatus, errorThrown) {
            swal("Error!", 'Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown, "error");   
        }
      })
      reload_table(''+table);
    }

    function reload_table (table) {
        $.ajax({
            url:"<?php echo base_url('manage_user/reload_table/'.$this->uri->segment(3).'/"+table+"');?>",
            type:"POST",
            success:function(resp){
                $('#table-'+table).html(resp);
            }
        })
    }

    function progressbar () {
        var progress = (done/task)*100;
        $('#progress-bar').attr('style','width: '+progress+'%;');
        document.getElementById('progress-bar').innerHTML = " "+progress+"% ";
    }

    function save_setting(employee_id){
        $.ajax({
        url:"<?php echo base_url('manage_user/save_setting/"+employee_id+"');?>",
            type : "POST",
            data: $('#form-setting').serialize(),
            success:function(data){
                $("#message").html(data);
                $("#btnSetting").html('Update Profile');
            }
            ,beforeSend:function()
                {
                $("#message").html('');
                $("#btnSetting").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please wait ...');
            }

        })

        return false;
    }
</script>


<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Profile page</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('home') ?>">Dashboard</a></li>
                            <li class="active">Profile page</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo base_url('data/user_picture/'.$picture);?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"><img src="<?php echo base_url('data/user_picture/'.$picture);?>" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white"><?php echo $employee_name; ?></h4>
                                        <h5 class="text-white"><?php echo $employee_identity; ?></h5>
                                    </div>
                                </div>
                            </div>
                              <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Departement</strong>
                                        <p><?php echo $nama_departemen; ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Designation</strong>
                                        <p><?php echo $employee_designation; ?></p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Email ID</strong>
                                        <p><?php echo $employee_email; ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Phone</strong>
                                        <p><?php echo $employee_phone; ?></p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Address</strong>
                                        <p><?php echo $employee_address; ?>
                                           
                                    </div>
                                </div>
                                <hr>
                                <!-- /.row -->
                                <div class="col-md-4 col-sm-4 text-center">
                                    <a href="<?php echo $facebook; ?>" class="text-purple"><i class="ti-facebook"></i></a>
                                   
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                      <a href="<?php echo $twitter; ?>" class="text-orange"><i class="ti-twitter"></i></a>
                                   
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                     <a href="<?php echo $google; ?>" class="text-red"><i class="ti-google"></i></a>
                              
                                </div>
                                </br>
                                <div class="col-md-12">
                                <br>
                                <?php
                                echo "
                                <a href='".base_url()."manage_user/edit/$employee_id' class='btn-xs' title='Edit' data-toggle=\"tooltip\" data-original-title=\"Edit\"> 
                                <button class='btn btn-success' style='width:100%'>Edit Profile</button>

                                </a>
                                ";

                                ?>
                                </div>

                                 <div class="col-md-12">
                                <br>
                               
                                <button class='btn btn-danger' style='width:100%'>Register Profile</button>

                                </a>
                               
                                </div>

                                 <div class="col-md-12">
                                <br>
                               
                                <button class='btn btn-default' style='width:100%' onclick="delete_('<?=$employee_id;?>');">Delete User</button>

                                </a>
                               
                                </div>

                            </div>
                    </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav nav-tabs tabs customtab">
                                <li class="active tab">
                                    <a href="#home" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Activity</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#project" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Project</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#employ" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Data</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#education" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Education</span> </a>
                                </li>

                                 <li class="tab">
                                    <a href="#family" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Family</span> </a>
                                </li>

                                 <li class="tab">
                                    <a href="#work_ex" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="fa fa-envelope-o"></i></span> <span class="hidden-xs">Work Ex</span> </a>
                                </li>



                                <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Settings</span> </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="steamline">
                                    	<?php foreach ($logs as $row) { ?>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img src="<?php echo base_url('data/user_picture/'.$picture);?>" alt="user" class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info"><b><?php echo $employee_name; ?></b></a> <span class="sl-date"><?php echo $row->time; ?></span>
                                                    <p><?php echo $row->activity; ?>  <?php echo $row->description; ?></a></p>
                                                   </div>
                                            </div>
                                        </div>
                                        <hr>
                                       
                                    <?php } ?>

                                    </div>
                                </div>
                                <div class="tab-pane" id="project">
                                    
                                
                                   
                                    <hr>
                                    <h5>Project 1 <span class="pull-right">80%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>HTML 5 <span class="pull-right">90%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>jQuery <span class="pull-right">50%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                    <h5>Photoshop <span class="pull-right">70%</span></h5>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="employ">

                                <h3 class="text-orange">Personal Data :</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Birthday</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $birthday; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Gender</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $gender; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Address</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $employee_address; ?></p>
                                        </div>
                                        
                                    </div>
                                    <hr>


                                <h3 class="text-orange">Identity Number :</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>KTP</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $ktp; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>NPWP</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $npwp; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>BPJS Ketenagakerjaan</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $bpjs; ?></p>
                                        </div>
                                         <div class="col-md-3 col-xs-6"> <strong>BPJS Kesehatan</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $bpjs_kesehatan; ?></p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <h3 class="text-orange">Employee Status :</h3>
                                    <hr>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Status Employee</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $status_name; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Joining Date</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $date_joining; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Leaving Date</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $date_leaving; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"> <strong> Employee ID</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $employee_identity; ?></p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <h3 class="text-orange">Bank Account :</h3>
                                    <hr>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Bank Name</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $bank_name; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Bank Account</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $bank_account; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Bank Account Holder</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $bank_account_holder; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6"> <strong> </strong>
                                            <br>
                                            <p class="text-muted"></p>
                                        </div>
                                    </div>
                                    <hr>




                                </div>

                                 <div class="tab-pane" id="education">


                                    
                                    <div class="row">
                            <div id="education-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="#" id="form-education">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add Education</h4>
                                            </div>
                                            <div style="padding:40px;" class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label">Grade</label>
                                                    <select name="grade" class="form-control">
                                                        <option value="Elementary School">Elementary School</option>
                                                        <option value="Junior High School">Junior High School</option>
                                                        <option value="Senior High School">Senior High School</option>
                                                        <option value="College Student">College Student</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">  Institution Name</label>
                                                    <input type="text" class="form-control" name="institution_name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Start Year
                                                    </label>
                                                    <input type="text" class="form-control mydatepicker" name="start_year">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        End Year
                                                    </label>
                                                    <input type="text" class="form-control mydatepicker" name="end_year">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Score
                                                    </label>
                                                    <input type="text" class="form-control" name="score">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="save('education');" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                                    <a href="" data-toggle="modal" data-target="#education-modal" class="btn btn-success btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>ADD</a>
                                    <hr>
                                    
                                    <table id="table-education" class="table table-striped">
                                    <tr> <th>No.</th><th>Grade </th><th>Institution Name </th><th>Start Year </th><th>End Year</th><th>Score</th></tr>
                                    <?php 
                                    $num = 1;
                                    foreach ($education as $row) { ?>
                                    <tr> <td><?php echo $num; ?></td><td><?php echo $row->grade;?> </td><td><?php echo $row->institution_name ;?> </td><td> <?php echo $row->start_year ;?> </td><td><?php echo $row->end_year ;?></td><td><?php echo $row->score ;?></td></tr>

                                    
                                    <?php $num++; } ?>

                                    </table>
                                    </div>

                                 </div>


                                 <div class="tab-pane" id="family">                                   
                                    <div class="row">

                                    <a href="" data-toggle="modal" data-target="#family-modal" class="btn btn-success btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>ADD</a>
                                    <hr>
                                    
                                    <table id="table-family" class="table table-striped">
                                    <tr> <th>No.</th><th>Full Name </th><th>Gender </th><th>Relationship </th><th>Birthday</th><th>Marital Status</th><th>Jobs</th></tr>
                                    <?php 
                                    $num = 1;
                                    foreach ($family as $row) { ?>
                                    <tr> <td><?php echo $num; ?></td><td><?php echo $row->fullname;?> </td><td><?php echo $row->gender ;?> </td><td> <?php echo $row->relationship ;?> </td><td><?php echo $row->birthday ;?></td><td><?php echo $row->marital_status ;?></td><td><?php echo $row->jobs ;?></td></tr>

                                    
                                    <?php $num++; } ?>

                                    </table>
                                    </div>

                                 </div>

                                  <div class="tab-pane" id="work_ex">                                   
                                    <div class="row">

                                    <a href="" data-toggle="modal" data-target="#work_ex-modal" class="btn btn-success btn-sm waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>ADD</a>
                                    <hr>
                                    
                                    <table id="table-work_ex" class="table table-striped">
                                    <tr> <th>No.</th><th>Company Name </th><th>Position </th><th>Start Date </th><th>End Date</th><th>Description</th></tr>
                                    <?php 
                                    $num = 1;
                                    foreach ($work_ex as $row) { ?>
                                    <tr> <td><?php echo $num; ?></td><td><?php echo $row->company_name;?> </td><td><?php echo $row->position ;?> </td><td> <?php echo $row->start_date ;?> </td><td><?php echo $row->end_date ;?></td><td><?php echo $row->description ;?></td></tr>

                                    
                                    <?php $num++; } ?>

                                    </table>
                                    </div>

                                 </div>





                                <div class="tab-pane" id="settings">
                                    <div id="message">
                                        <!-- <div class="alert alert-success">User Setting successfully changed</div> -->
                                    </div>
                                    <form action="#" method="POST" id="form-setting" class="form-horizontal form-material">
                                        <div class="form-group">
                                            <label class="col-md-12">Username</label>
                                            <div class="col-md-12">
                                                <input type="text" value="<?=$username?>" name="username" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Password</label>
                                            <div class="col-md-12">
                                                <input name="password" type="password" placeholder="Input New Password" class="form-control form-control-line">
                                                <small>*Leave blank if you do not want to change your password</small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Repeat Password</label>
                                            <div class="col-md-12">
                                                <input name="conf_password" type="password" placeholder="Password Confirmation" class="form-control form-control-line">
                                            </div>
                                        </div>
                                    </form>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button id="btnSetting" onclick="save_setting(<?=$this->uri->segment(3)?>)" class="btn btn-success">Update Profile</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                                                <div id="family-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="#" id="form-family">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add Family</h4>
                                            </div>
                                            <div style="padding:40px;" class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label">Full Name</label>
                                                    <input type="text" class="form-control" name="fullname">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                       Relationship
                                                    </label>
                                                    <select class="form-control" name="relationship">
                                                        <option value="Parent">Parent</option>
                                                        <option value="Grandparent">Grandparent</option>
                                                        <option value="Son">Son</option>
                                                        <option value="Daughter">Daughter</option>
                                                        <option value="Brother">Brother</option>
                                                        <option value="Sister">Sister</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Birthday
                                                    </label>
                                                    <input type="text" class="form-control mydatepicker" name="birthday">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                       Marital Status
                                                    </label>
                                                    <select class="form-control" name="marital_status">
                                                        <option value="married">Married</option>
                                                        <option value="single">Single</option>
                                                        <option value="divorced">Divorced</option>
                                                        <option value="widowed">Widowed</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                       Gender
                                                    </label>
                                                    <select class="form-control" name="gender">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                       Job
                                                    </label>
                                                    <input type="text" name="jobs" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="save('family');" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                                                <div id="work_ex-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="#" id="form-work_ex">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add Family</h4>
                                            </div>
                                            <div style="padding:40px;" class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label">Company Name</label>
                                                    <input type="text" class="form-control" name="company_name">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Position</label>
                                                    <input type="text" class="form-control" name="position">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Start Date
                                                    </label>
                                                    <input type="text" class="form-control mydatepicker" name="start_date">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        End Date
                                                    </label>
                                                    <input type="text" class="form-control mydatepicker" name="end_date">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">
                                                       Description
                                                    </label>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="save('work_ex');" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

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
            window.location = "<?php echo base_url();?>manage_user/delete/"+id;
            swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        });
    }
</script>