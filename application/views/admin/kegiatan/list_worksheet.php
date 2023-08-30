<script type="text/javascript" wsc="<?php echo base_url()."asset/plugins/" ;?>jQuery/jQuery-2.1.3.min.js"></script>

<script type="text/javascript">
    function add_ws(no) {
        var i = no; i++;
        $("#btn-add-ws").attr("onclick", "add_ws('"+i+"')");
        $("#input-add-ws").attr("onclick", "add_ws('"+i+"')");
        $("#jumlah-worksheet").attr("value", no);

        document.getElementById('add-ws-'+no).innerHTML = '<td class="text-center"><input type="text" name="worksheet_order'+no+'" id="worksheet-order-'+no+'" class="form-control" placeholder="no"></td><td><input type="text" name="jobs'+no+'" id="jobs-'+no+'" class="form-control" placeholder="jobs"></td><td><select name="member'+no+'[]" id="member-'+no+'" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose">'+member_option+'</select></td><td><input class="form-control input-limit-datepicker date-limit" type="text" name="daterange'+no+'" id="daterange-'+no+'" value="" /></td><td><textarea name="note'+no+'" id="note-'+no+'" class="form-control" placeholder="note"></textarea> </td><td><input name="file'+no+'" id="file-'+no+'" type="file" placeholder="file"><input name="old_file'+no+'" type="hidden"> </td><td class="text-right">   <button onclick="delete_ws(\''+no+'\')" class="btn btn-warning" type="button"> Delete </button>  </td>';
        var p = document.getElementById('add-ws-'+no);
        var newElement = document.createElement('tr');
        newElement.setAttribute('id', 'add-ws-'+i);
        p.parentNode.insertBefore(newElement, p.nextSibling);
        $("#jobs-"+no).focus();
        $("#worksheet-order-"+no).val(no);

        jumlah = $("#jumlah-worksheet").val() + 1;
        task=task+1;
        progressbar();

        // RECALL FUNCTION
        $("#member-"+no).select2();
        $('.input-limit-datepicker').daterangepicker({
            format: 'MM/DD/YYYY',
            minDate: $mindate,
            maxDate: $maxdate,
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-success',
            cancelClass: 'btn-inverse',
            // dateLimit: {
            //     days: $dayslimit
            // }
        });
    }

    function delete_ws(no) {
        $("#add-ws-"+no).hide();
        $("#worksheet-order-"+no).val('');
        $("#jobs-"+no).val('');
        $("#note-"+no).val('');
        $("#file-"+no).val('');
        
        task=task-1;
        progressbar();
    }
</script>

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
                                    <h4 class="font-bold">Worksheet </h4>
                                                    <hr>
                                                    <form role="form" method='post' enctype="multipart/form-data">
                                        <table class="table table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="80px">No. Order</th>
                                                    <th class="text-center">Jobs</th>
                                                    <th class="text-center">Member</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Note</th>
                                                    <th class="text-center">File</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no_ws=0; $jumlah_ws=count($worksheet); foreach ($worksheet as $ws) : $no_ws++; $approved = ($ws->status_worksheet=="approved") ? "disabled" : ""?>
                                                <tr id="add-ws-<?php echo $no_ws;?>">
                                                    <td class="text-center"><input type="text" name="worksheet_order<?php echo $no_ws;?>" id="worksheet-order-<?php echo $no_ws;?>" class="form-control" placeholder="no" value="<?php echo $ws->worksheet_order ?>" <?php echo $approved;?>></td>
                                                    <td><input type="text" name="jobs<?php echo $no_ws;?>" id="jobs-<?php echo $no_ws;?>" class="form-control" placeholder="jobs" value="<?php echo $ws->jobs ?>" <?php echo $approved;?>></td>
                                                    <td>
                                                        <select name="member<?php echo $no_ws;?>[]" id="member-<?php echo $no_ws;?>" class="select2 m-b-10 select2-multiple" multiple="multiple" data-placeholder="Choose" <?php echo $approved;?>>
                                                            <?php foreach ($employee as $key): $array_team = explode(',', $pr->team); $selecting = (array_search($key->id_pegawai, $array_team) === false ) ? '' : 'selecting'; $array_member = explode(',', $ws->member); $selected = (array_search($key->id_pegawai, $array_member) === false ) ? '' : 'selected'?>
                                                                <?php if (!empty($selecting)) echo "<option value='{$key->id_pegawai}' {$selected}>{$key->nama_lengkap}</option>" ?>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td><input class="form-control input-limit-datepicker date-limit" type="text" name="daterange<?php echo $no_ws;?>" id="daterange-<?php echo $no_ws;?>" value="<?php echo date_format(date_create($ws->date_start),'m/d/Y').' - '.date_format(date_create($ws->date_exp),'m/d/Y') ?>" <?php echo $approved;?> /></td>
                                                    <td><textarea name="note<?php echo $no_ws;?>" id="note-<?php echo $no_ws;?>" class="form-control" placeholder="note" <?php echo $approved;?> ><?php echo $ws->note ?></textarea> </td>
                                                    <td><a href="<?php echo base_url().'data/project/'.$ws->file  ?>" target="_blank"><?php echo $ws->file ?></a><input name="file<?php echo $no_ws;?>" id="file-<?php echo $no_ws;?>" type="file" placeholder="file" <?php echo $approved;?>><input type="hidden" name='old_file<?php echo $no_ws;?>' value="<?php echo $ws->file?>" <?php echo $approved;?>></td>
                                                    <td class="text-right">   <button onclick="delete_ws('<?php echo $no_ws;?>')" class="btn btn-<?php echo $class_approved = ($ws->status_worksheet=="approved") ? "success" : "warning"?>" type="button" <?php echo $approved;?>> <?php echo $text_approved = ($ws->status_worksheet=="approved") ? "Approved" : "Delete"?> </button>  </td>
                                                </tr>
                                                <?php endforeach;?>
                                                <tr id="add-ws-<?php $add_ws = $no_ws + 1; echo $add_ws;?>"></tr>
                                                <?php if ($pr->project_status == "Y") :?>
                                               <tr>
                                                    <td colspan="6"><input id="input-add-ws" onclick="add_ws('<?php echo $add_ws;?>')" type="text" placeholder="Add New" class="form-control" readonly/></td>
                                                    <td class="text-right">   <button id="btn-add-ws" onclick="add_ws('<?php echo $add_ws;?>')" class="btn btn-primary" type="button"> ADD </button>
                                                    <input type="hidden" name="jumlah_worksheet" id="jumlah-worksheet" value="<?php echo $jumlah_ws;?>"/> </td>
                                                </tr>
                                                <?php endif;?>
                                               
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <a href="<?php echo base_url('manage_project/detail/'.$pr->project_id); ?>" class="btn btn-default"> CANCEL</a>
                                        <?php if ($pr->project_status == "Y") :?>
                                        <button class="btn btn-info" type="submit"> SAVE</button>
                                        <?php endif;?>
                                        
                                    </div>
                                </div>
                            </div>
                            </form>
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

    <?php 
        $selected = "";
        $member_option = "";
        foreach ($employee as $key){ 
            $selecting = (array_search($key->id_pegawai, $array_team) === false ) ? '' : 'selecting';
            if (!empty($selecting)) $member_option .= "<option value='{$key->id_pegawai}' {$selected}>{$key->nama_lengkap}</option>";
        } 
    ?>

    <script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
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

<script type="text/javascript">
    var done = <?php echo $done = (!empty($done)) ? $done : 0 ; ?>;
    var task = <?php echo $count_worksheet = (!empty($worksheet)) ? count($worksheet) : 1; ?>;

    var member_option = "<?php echo $member_option ?>";

    $mindate = "<?php echo date_format(date_create($pr->date_start),'m/d/Y') ?>";
    $maxdate = "<?php echo date_format(date_create($pr->date_end),'m/d/Y') ?>";
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