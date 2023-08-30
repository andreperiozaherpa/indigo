<script type="text/javascript" wsc="<?php echo base_url()."asset/plugins/" ;?>jQuery/jQuery-2.1.3.min.js"></script>

<?php foreach ($query as $pr){} ?>
 <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Project Detail</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Project</a></li>
                            <li class="active">Detail</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                        <div class="row">
                        	<div class="col-md-2">
                            	<h3><b>Progress</b></h3>
                            </div>
                            <div class="col-md-8">
		                      
		                       <div class="progress progress-lg" style="margin-top:15px;">
                               <?php $done = 0; $task = count($worksheet); foreach ($worksheet as $pb) {if ($pb->status_worksheet=="approved")$done++;} $progressbar = ($task>0) ? ($done/$task)*100 : "0";?>
                                        <div id="progress-bar" class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo $progressbar ?>%;" role="progressbar" > <?php echo round($progressbar) ?>% </div>
								</div></h3>
							</div>

							<div class="col-md-2">
                                <h3 class="pull-right"><b><?php if ($pr->project_status == "N") {echo "PROJECT CLOSED";} else {$tgl_awal = new datetime(date("Y-m-d")); $tgl_akhir = new datetime($pr->date_end); echo (date("Y-m-d")<=$pr->date_end) ? $tgl_akhir->diff($tgl_awal)->format("%a Day(s) Remaining") : "OUT OF DATE";}?></b></h3>
                            </div>

							</div>
                            <hr>
                            <div class="row">
                                <div class="col-md-5">
                              
                                   <table class="table datatable" id="data">
                                    <h3> &nbsp;<b class="text-danger"><?php echo $pr->project_name ?></b><?php if ($pr->project_status == "Y") :?><a href="<?php echo base_url('manage_project/edit_project/'.$pr->project_id); ?>" class="fcbtn btn btn-xs btn-info btn-outline btn-1c pull-right"><i class="fa fa-edit"></i> Edit</a><?php endif;?></h3>
                                   <tr><td>Project Name</td><td>:</td><td><?php echo $pr->project_name ?></td></tr>
                                    <tr><td>Priority</td><td>:</td><td><?php echo $pr->priority ?></td></tr>
                                    <tr><td>Description</td><td>:</td><td><?php echo $pr->project_description ?></td></tr>
                                    <tr><td>File</td><td>:</td><td><a href="<?php echo base_url().'data/project/'.$pr->file  ?>" target="_blank"><?php echo $pr->file ?></a></td></tr>
                                   </table>
                                      
                                    </div>
                                    <div class="col-md-5">
                                    
                                    </div>
                                    

                                    <div class="col-md-2">
                                        <address>
                                           
                                            <h4 class="font-bold">Team </h4>
                                            <p class="text-muted m-l-30">
                                            	<strong><?php echo "{$pr->nama_lengkap} (Leader)" ?></strong>,<br/>
                                                <?php foreach ($employee as $key): $array_team = explode(',', $pr->team); $selecting = (array_search($key->id_pegawai, $array_team) === false ) ? '' : 'selecting'?>
                                                    <?php if (!empty($selecting)) echo "{$key->nama_lengkap},<br/>" ?>
                                                <?php endforeach ?>
                     
                                            <p class="m-t-30"><b>Project Date :</b> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($pr->date_start),"D, j M Y") ?></p>
                                            <p><b>Due Date :</b> <i class="fa fa-calendar"></i> <?php echo date_format(date_create($pr->date_end),"D, j M Y") ?></p>
                                        </address>
                                    </div>
                               

                                <div class="col-md-12 white-box" >
                                    <div class="table-responsive m-t-40">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-left">Jobs</th>
                                                    <th class="text-left">Member</th>
                                                    <th class="text-left">Report</th>
                                                    <th class="text-left">File</th>
                                                    <th class="text-left">Date</th>
                                                    <th class="text-center">Status Approve</th>
                                                    <th class="text-right"><?php if ($pr->project_status == "Y") :?><a href="<?php echo base_url('manage_project/list_worksheet/'.$pr->project_id); ?>" class="fcbtn btn btn-xs btn-info btn-outline btn-1c pull-right"><i class="fa fa-list"></i> Job List</a><?php endif;?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no_ws=0; foreach ($worksheet as $ws) : $no_ws++;?>
                                                <?php 
                                                    if ($ws->status_worksheet=="progress"){
                                                        $hiddenproses = "hidden";
                                                        $hiddenselesai = "";
                                                        $hiddenditolak = "";
                                                        $status_label = "info";
                                                    } elseif ($ws->status_worksheet=="approved") {
                                                        $hiddenproses = "";
                                                        $hiddenselesai = "hidden";
                                                        $hiddenditolak = "hidden";
                                                        $status_label = "success";
                                                    } elseif ($ws->status_worksheet=="rejected") {
                                                        $hiddenproses = "";
                                                        $hiddenselesai = "hidden";
                                                        $hiddenditolak = "hidden";
                                                        $status_label = "danger";
                                                    } else {
                                                        $hiddenproses = "hidden";
                                                        $hiddenselesai = "hidden";
                                                        $hiddenditolak = "hidden";
                                                        $status_label = "primary";
                                                    }

                                                    if ($pr->project_status=="N") {
                                                        $hiddenproses = "hidden";
                                                        $hiddenselesai = "hidden";
                                                        $hiddenditolak = "hidden";
                                                    }
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $no_ws;?></td>
                                                    <td class="text-left" id="col-jobs-<?php echo $ws->worksheet_id;?>"><?php echo $ws->jobs ?></td>
                                                    <td class="text-left"><ul><?php foreach ($employee as $em){ $array_member = explode(',', $ws->member); $selecting = (array_search($em->id_pegawai, $array_member) === false ) ? '' : 'selecting'; if (!empty($selecting)) echo "<li>{$em->nama_lengkap}</li>" ;} ?></ul></td>
                                                    <td class="text-left" id="col-report-<?php echo $ws->worksheet_id;?>">
                                                        <?php echo $ws->report ?>
                                                        <?php if (!empty($ws->note)): ?>
                                                            <hr/>
                                                            <i>Note :</i> <?php echo $ws->note ?>
                                                        <?php endif ?>   
                                                    </td>
                                                    <td class="text-left" id="col-file-<?php echo $ws->worksheet_id;?>">
                                                        <ul>
                                                            <?php if (!empty($ws->file)): ?>
                                                                <li><small><a href="<?php echo base_url().'data/project/'.$ws->file  ?>" target="_blank"><?php echo $ws->file ?></a> by <i><?php echo "{$pr->nama_lengkap} (Leader)" ?></i><input id="old-job-file-<?php echo $ws->worksheet_id;?>" value="<?php echo $ws->file;?>" type="hidden"></small></li>
                                                            <?php endif ?>
                                                            <?php if (!empty($ws->job_file)): ?>
                                                                <li><small><a href="<?php echo base_url().'data/project/'.$ws->job_file  ?>" target="_blank"><?php echo $ws->job_file ?></a> by <i><?php echo "{$ws->nama_lengkap}" ?></i><input id="old-job-file-<?php echo $ws->worksheet_id;?>" value="<?php echo $ws->job_file;?>" type="hidden"></small></li>
                                                            <?php endif ?>
                                                        </ul>
                                                    </td>
                                                    <td class="text-left" id="col-date-<?php echo $ws->worksheet_id;?>">
                                                        <ul>
                                                            <?php if(!empty($ws->date_exp) AND $ws->date_exp!="0000-00-00" AND date("Y-m-d")<=$ws->date_exp) : $tgl_awal = new datetime(date("Y-m-d")); $tgl_akhir = new datetime($ws->date_exp); echo $tgl_akhir->diff($tgl_awal)->format("<b>%a</b>");?> Day(s) Remaining <?php endif ?>
                                                            <small>
                                                            <?php if (!empty($ws->date_start) AND $ws->date_start!="0000-00-00"): ?>
                                                                <li><i>Start</i> : <strong><?php echo date_format(date_create($ws->date_start),"D, j M Y") ?></strong></li>
                                                            <?php endif ?>
                                                            <?php if (!empty($ws->date_exp) AND $ws->date_exp!="0000-00-00"): ?>
                                                                <li><i>Expire</i> : <strong><?php echo date_format(date_create($ws->date_exp),"D, j M Y") ?></strong></li>
                                                            <?php endif ?>
                                                            <?php if (!empty($ws->date_done) AND $ws->date_done!="0000-00-00"): ?>
                                                                <li><i>Done</i> : <strong><?php echo date_format(date_create($ws->date_done),"D, j M Y") ?></strong></li>
                                                            <?php endif ?>
                                                            </small>
                                                        </ul>
                                                    </td>
                                                    <td class="text-center"><button id="button-status-<?php echo $ws->worksheet_id;?>" type="button" class="fcbtn btn btn-outline btn-<?php echo $status_label;?> btn-rounded btn-1e waves-effect waves-light" title="" data-toggle="popover" data-placement="right" data-content="<?php echo $ws->note ?>"> <?php echo $status_approve = (empty($ws->status_worksheet)) ? "unchecked" : $ws->status_worksheet ; ?> </button></td>
                                                    <td class="text-right">
                                                        <input id="status-<?php echo $ws->worksheet_id;?>" value="<?php echo $ws->status_worksheet;?>" type="hidden">
                                                        <button id="proses-<?php echo $ws->worksheet_id;?>" onclick="batal('<?php echo $ws->worksheet_id;?>');" class="btn btn-warning <?php echo $hiddenproses ?>" type="button"> Cancel </button> 
                                                        <button id="selesai-<?php echo $ws->worksheet_id;?>" onclick="setuju('<?php echo $ws->worksheet_id;?>');" class="btn btn-success <?php echo $hiddenselesai ?>" type="submit"> Approve </button>
                                                        <button id="ditolak-<?php echo $ws->worksheet_id;?>" onclick="confirm_tolak('<?php echo $ws->worksheet_id;?>');" class="btn btn-danger <?php echo $hiddenditolak ?>" data-toggle="modal" data-target="#reject" data-whatever="@fat"> Reject </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach;?>
                                               
                                            </tbody>
                                        </table>
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
                                            <form action="#" id="form">
                                                
                                                <div class="form-group">
                                                    <label for="message-text" class="control-label">Note:</label>
                                                    <textarea name="note" id="note" class="form-control"></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button id="send-message" type="button" class="btn btn-primary" data-dismiss="modal">Send message</button>
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
                                        <?php if ($pr->project_status == "Y") :?>
                                            <button class="btn btn-info" type="button" onclick="closed();"> Close Project </button>
                                        <?php elseif ($pr->project_status == "N") :?>
                                            <button class="btn btn-info" type="button" onclick="reopen();"> Reopen Project </button>
                                        <?php endif;?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<script type="text/javascript">
    var done = <?php echo $done = (!empty($done)) ? $done : 0 ; ?>;
    var task = <?php echo $count_worksheet = (!empty($worksheet)) ? count($worksheet) : 1; ?>;
</script>

<script type="text/javascript">
    function closed()
    {
        swal({   
            title: "Are you sure?",   
            text: "You want to close this project!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, close it!",
            closeOnConfirm: false 
        }, function(){   
            window.location = "<?php echo base_url();?>manage_project/closed/<?php echo $this->uri->segment(3);?>";
            swal("Closed!", "This project has been closed.", "success"); 
        });
    }

    function reopen()
    {
        swal({   
            title: "Are you sure?",   
            text: "You want to reopen this project!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, reopen it!",
            closeOnConfirm: false 
        }, function(){   
            window.location = "<?php echo base_url();?>manage_project/reopen/<?php echo $this->uri->segment(3);?>";
            swal("Reopened!", "This project has been reopened.", "success"); 
        });
    }
</script>


<script type="text/javascript">
    function setuju(no){          
    $('#selesai-'+no).addClass('hidden');
    $('#ditolak-'+no).addClass('hidden');
      $.ajax({
        url:"<?php echo base_url('manage_project/verifikasi/"+no+"/setuju');?>",
        type:"POST",
        success:function(resp){
            //$('#status-'+no).html('<span class="label label-success">Penandatanganan</span>');
            $('#proses-'+no).removeClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-success btn-rounded btn-1e');
            $('#button-status-'+no).attr('data-content','');
            document.getElementById('button-status-'+no).innerHTML = " approved ";
            done=done+1;
            progressbar();
            $('#status-'+no).val('approved');
        },
        error:function(event, textStatus, errorThrown) {
            $('#selesai-'+no).removeClass('hidden');
            $('#ditolak-'+no).removeClass('hidden');
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    }

    function confirm_tolak (no) {
        $('#send-message').attr('onclick',"tolak('"+no+"');");
    }

    function tolak(no){       
    $('#selesai-'+no).addClass('hidden');
    $('#ditolak-'+no).addClass('hidden');   
      $.ajax({
        url:"<?php echo base_url('manage_project/verifikasi/"+no+"/tolak');?>",
        type:"POST",
        data: $('#form').serialize(),
        success:function(resp){
            //$('#status-'+no).html('<span class="label label-danger">Ditangguhkan</span>');
            $('#proses-'+no).removeClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-danger btn-rounded btn-1e');
            $('#button-status-'+no).attr('data-content',$('#note').val());
            document.getElementById('button-status-'+no).innerHTML = " rejected ";
            document.getElementById("form").reset();
            progressbar();
            $('#status-'+no).val('rejected');
        },
        error:function(event, textStatus, errorThrown) {
            $('#selesai-'+no).removeClass('hidden');
            $('#ditolak-'+no).removeClass('hidden');
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    }

    function batal(no){      
    $('#proses-'+no).addClass('hidden')    
      $.ajax({
        url:"<?php echo base_url('manage_project/verifikasi/"+no+"/batal');?>",
        type:"POST",
        success:function(resp){
            //$('#status-'+no).html('<span class="label label-info">Proses</span>');;
            $('#selesai-'+no).removeClass('hidden');
            $('#ditolak-'+no).removeClass('hidden');
            $('#button-status-'+no).attr('class','fcbtn btn btn-outline btn-info btn-rounded btn-1e');
            $('#button-status-'+no).attr('data-content','');
            document.getElementById('button-status-'+no).innerHTML = " progress ";
            if ($('#status-'+no).val()=='approved') {
            done=done-1;
            };
            progressbar();
            $('#status-'+no).val('progress');
        },
        error:function(event, textStatus, errorThrown) {
            $('#proses-'+no).removeClass('hidden');
           alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        }
      })
    }

    function progressbar () {
        var progress = 0;
        if (task!=0) { progress = (done/task)*100;};
        $('#progress-bar').attr('style','width: '+progress+'%;');
        document.getElementById('progress-bar').innerHTML = " "+Math.round(progress)+"% ";
        //window.location.reload(false); 
    }
</script>