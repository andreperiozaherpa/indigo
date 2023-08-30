
    <!-- xeditable css -->
    <link href="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <script type="text/javascript">

    function save_setting(){
        $.ajax({
        url:"<?php echo base_url('manage_user/change_password/'.$this->session->userdata('user_id'));?>",
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

    function x_update(name,value){   
      // data = new FormData($('#form')[0]);   
      $.ajax({
        url:"<?php echo base_url('manage_user/x_update_profile');?>",
        type:"POST",
        data: {id:'<?php echo $this->session->userdata('user_id');?>', name:name, value:value},
        success:function(resp){
            //alert(resp);
            // window.location.reload(false); 
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

    function x_update_image(){   
      data = new FormData($('#form-profile-image')[0]);   
      $.ajax({
        url:"<?php echo base_url('manage_user/x_update_profile_image/'.$this->session->userdata('user_id'));?>",
        type:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function() {
            $('#input-file-user-picture').attr("disabled",true);
        },
        success:function(resp){
            alert(resp);
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
           $('#input-file-user-picture').attr("disabled",false);
           $('#form-profile-image')[0].reset();
        }
      })
    }
</script>

<div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">User Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('admin');?>">Dashboard</a></li>
                            <li class="active">User</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo base_url('data/user_picture/'.$picture);?>">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <form action="#" method="POST" id="form-profile-image" class="form-horizontal form-material">
                                            <input type="file" name='userfile' id="input-file-user-picture" class="hide"onchange="x_update_image();" />
                                        </form>
                                        <a href="javascript:void(0)"><img src="<?php echo base_url('data/user_picture/'.$picture);?>" class="thumb-lg img-circle" alt="img" onclick="$('#input-file-user-picture').trigger('click');"></a>
                                        <h4 class="text-white"><a href="#" id="inline-fullname" style="color: #fff" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your name"><?php echo $full_name; ?></a></h4>
                                        <h5 class="text-white">Terdaftar sejak <?php echo date('d M Y',strtotime($reg_date)) ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="user-btm-box" style="padding: 0">
                                <!-- .row -->
                                <div class="row text-center m-t-30">
                                    <div class="col-md-12">
                                        <?php if (!empty($error)) echo "<div class='alert alert-info'>$error</div>";?>
                                           
                                    </div>
                                </div>
                                <!-- /.row -->
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Instansi</strong>
                                        <p>
                                            <?php echo $nama_instansi; ?>
                                        </p>
                                           
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>E-mail</strong>
                                        <p>
                                            <a href="#" id="inline-email" data-type="email" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your email"><?php echo $email; ?></a>
                                        </p>
                                    </div>
                                    <div class="col-md-6"><strong>Telepon</strong>
                                        <p>
                                            <a href="#" id="inline-phone" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your phone number"><?php echo $phone; ?></a>
                                        </p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Alamat</strong>
                                        <p><a href="#" id="inline-address" data-type="textarea" data-pk="1" data-placeholder="Your address here..." data-title="Enter address"><?php echo $bio; ?></a></p>
                                           
                                    </div>
                                </div>
                                <hr>
                                 <div class="col-md-12">
                               
                                <button type="button" class='btn btn-default' style='width:100%' data-toggle="modal" data-target="#change_pasword">Ganti Password</button>

                                <!-- sample modal content -->
                                <div id="change_pasword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="message">
                                                    <!-- <div class="alert alert-success">User Setting successfully changed</div> -->
                                                </div>
                                                <form action="#" method="POST" id="form-setting" class="form-horizontal form-material">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Username</label>
                                                        <div class="col-md-12">
                                                            <input type="text" value="<?=$username?>" name="username" class="form-control form-control-line">
                                                            <input type="hidden" value="<?=$username?>" name="old_username" class="form-control form-control-line">
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btnSetting" onclick="save_setting()" class="btn btn-success">Ganti Password</button>
                                                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                               
                                </div>
                                        

                            </div>
                        </div>
                    </div>
                    <!-- .row -->
                    <div class="col-md-9 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">DAFTAR AGENDA </h3>
                            <?php 
                                $total_agenda = 0;
                                foreach ($agenda as $n => $a) {
                                    $array_team = explode(',', $a->penerima);
                                    if (!array_search($this->session->userdata('instansi_id'), $array_team) === false OR $this->session->userdata('level') == "Administrator") { $total_agenda++; }
                                }
                                if ($total_agenda<=0) {
                                    echo '<div class="well"><p class="text-center" style="margin: auto; min-height: 430px"><strong><i>Untuk sementara tidak ada agenda.</i></strong></p></div>';
                                } else {
                            ?>
                            <section class="cd-horizontal-timeline" style="margin: auto">
                                <div class="timeline">
                                    <div class="events-wrapper">
                                        <div class="events">
                                            <ol>
                                    			<?php 
                                    				$selected = "";
                                    				$select = FALSE;
                                    				$current_date = date('Ymd');
                                    				foreach ($agenda as $n => $a): 
                                                        $array_team = explode(',', $a->penerima);
                                                        if (!array_search($this->session->userdata('instansi_id'), $array_team) === false OR $this->session->userdata('level') == "Administrator") :
                                        					$target_date = date('Ymd',strtotime($a->tgl_mulai));
                                        					if ($current_date <= $target_date AND $select == FALSE) {
                                        						$selected = "selected";
                                        						$select = TRUE;
                                        					} else {
                                        						$selected = "";
                                        					}
                                    			?>
                                                <li><a href="#!" data-date="<?php echo date('d/m/Y',strtotime($a->tgl_mulai)) ?>" class="<?=$selected?>"><?php echo date('d M',strtotime($a->tgl_mulai)) ?></a></li>
                                                <?php endif; endforeach; ?>
                                            </ol>
                                            <span class="filling-line" aria-hidden="true"></span>
                                        </div>
                                        <!-- .events -->
                                    </div>
                                    <!-- .events-wrapper -->
                                    <ul class="cd-timeline-navigation">
                                        <li><a href="#0" class="prev inactive">Sblmnya</a></li>
                                        <li><a href="#0" class="next">Brktnya</a></li>
                                    </ul>
                                    <!-- .cd-timeline-navigation -->
                                </div>
                                <!-- .timeline -->
                                <div class="events-content" style="margin: auto; min-height: 404px">
                                    <ol>
                                    	<?php 
                            				$selected = "";
                            				$select = FALSE;
                            				$current_date = date('Ymd');
                            				foreach ($agenda as $n => $a): 
                                                $array_team = explode(',', $a->penerima);
                                                if (!array_search($this->session->userdata('instansi_id'), $array_team) === false OR $this->session->userdata('level') == "Administrator") :
                                					$target_date = date('Ymd',strtotime($a->tgl_mulai));
                                					if ($current_date <= $target_date AND $select == FALSE) {
                                						$selected = "selected";
                                						$select = TRUE;
                                					} else {
                                						$selected = "";
                                					}

    							                    $title = $a->tema;
    							                    $title = preg_replace("/<img[^>]+\>/i", "(gambar) ", $title);
    							                    $title = preg_replace("/<table[^>]+\>/i", "(tabel) ", $title);
    							                    $title = preg_replace("/<ol[^>]+\>/i", "", $title);
    							                    $title = preg_replace("/<ul[^>]+\>/i", "", $title);
    							                    $title = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $title);
    							                    $title = character_limiter(auto_typography($title), 66, '&#8230;');
    							                    $title = str_ireplace('<p>','',$title); $title=str_ireplace('</p>','',$title);
    							                    $title = str_ireplace('<ol>','',$title); $title=str_ireplace('</ol>','',$title);
    							                    $title = str_ireplace('<ul>','',$title); $title=str_ireplace('</ul>','',$title);
    							                    $title = str_ireplace('<li>','',$title); $title=str_ireplace('</li>','',$title);
    							                    
    							                    $detail = $a->isi_agenda;
    							                    $detail = preg_replace("/<img[^>]+\>/i", "(gambar) ", $detail);
    							                    $detail = preg_replace("/<table[^>]+\>/i", "(tabel) ", $detail);
    							                    $detail = preg_replace("/<ol[^>]+\>/i", "", $detail);
    							                    $detail = preg_replace("/<ul[^>]+\>/i", "", $detail);
    							                    $detail = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $detail);
    							                    $detail = character_limiter(auto_typography($detail), 444, '&#8230;');
    							                    $detail = str_ireplace('<p>','',$detail); $detail=str_ireplace('</p>','',$detail);
    							                    $detail = str_ireplace('<ol>','',$detail); $detail=str_ireplace('</ol>','',$detail);
    							                    $detail = str_ireplace('<ul>','',$detail); $detail=str_ireplace('</ul>','',$detail);
    							                    $detail = str_ireplace('<li>','',$detail); $detail=str_ireplace('</li>','',$detail);
                                    	?>

                                        <li class="<?=$selected?>" data-date="<?php echo date('d/m/Y',strtotime($a->tgl_mulai)) ?>">
                                            <h2><img class="img-responsive img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="<?php echo base_url('data/user_picture/'.$a->user_picture);?>"> <?php echo $title?><br/><small><?php echo date('d M Y',strtotime($a->tgl_mulai)) ?> - <?=$a->full_name?></small> <button data-toggle="modal" data-target=".detail-event-<?php echo $n ?>" class="btn btn-info btn-rounded btn-outline visible-xs">Selengkapnya</button></h2>
                                            <hr class="m-t-10">
                                            <p class="m-t-10">
                                                <?php echo $detail ?>
                                                <button data-toggle="modal" data-target=".detail-event-<?php echo $n ?>" class="btn btn-info btn-rounded btn-outline hidden-xs">Selengkapnya</button>
                                            </p>
                                        </li>

			                            <!-- sample modal content -->
			                            <div class="modal fade detail-event-<?php echo $n ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			                                <div class="modal-dialog modal-lg">
			                                    <div class="modal-content">
			                                        <div class="modal-header">
			                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                                            <h4 class="modal-title" id="myLargeModalLabel">Detail Agenda</h4>
			                                        </div>
			                                        <div class="modal-body">
										                <!-- row -->
										                <div class="row">
										                    <div class="col-md-4 col-xs-12">
										                        <div class="white-box">

										                            <div class="user-bg"> <img width="100%" alt="user" src="<?php echo base_url('data/user_picture/'.$a->user_picture);?>">
										                                <div class="overlay-box">
										                                    <div class="user-content">
										                                        <a href="javascript:void(0)"><img src="<?php echo base_url('data/user_picture/'.$a->user_picture);?>" class="thumb-lg img-circle" alt="img"></a>
										                                        <h4 class="text-white"><?=$a->full_name?></h4>
										                                        <h5 class="text-white">Diposting pada <?php echo date('d M Y',strtotime($a->tgl_posting)) ?></h5>
										                                    </div>
										                                </div>
										                            </div>
										                            <div class="user-btm-box">
										                                <!-- .row -->
										                                <div class="row text-center m-t-10">
										                                    <div class="col-md-6 b-r"><strong>Mulai</strong>
										                                        <p><?php echo date('d M Y',strtotime($a->tgl_mulai)) ?></p>
										                                    </div>
										                                    <div class="col-md-6"><strong>Selesai</strong>
										                                        <p><?php echo date('d M Y',strtotime($a->tgl_selesai)) ?></p>
										                                    </div>
										                                </div>
										                                <!-- /.row -->
										                                <hr>
										                                <!-- .row -->
										                                <div class="row text-center m-t-10">
										                                    <div class="col-md-6 b-r"><strong>Jam</strong>
										                                        <p><?=$a->jam?></p>
										                                    </div>
										                                    <div class="col-md-6"><strong>Pengirim</strong>
										                                        <p><?=$a->pengirim?></p>
										                                    </div>
										                                </div>
										                                <!-- /.row -->
										                                <hr>
										                                <!-- .row -->
										                                <div class="row text-center m-t-10">
										                                    <div class="col-md-12"><strong>Tempat</strong>
										                                        <p><?=$a->tempat?></p>
										                                    </div>
										                                </div>
										                            </div>
										                        </div>
										                    </div>
										                    <div class="col-md-8 col-xs-12">
										                        <div class="white-box">
						                                            <h4><?=$a->tema?></h4>
						                                            <p><?=$a->isi_agenda?></p>
                                                                    <blockquote>
                                                                        <p class="box-title">Ditujukan kepada</p>
                                                                        <small>
                                                                            <cite>
                                                                                <?php 
                                                                                    $all_koordinator    = 0;
                                                                                    $all_lembaga        = 0;

                                                                                    foreach ($instansi_penerima as $row) {
                                                                                        if ($row->level == "koordinator") {
                                                                                            $all_koordinator++;
                                                                                        } elseif ($row->level == "lembaga") {
                                                                                            $all_lembaga++;
                                                                                        }
                                                                                    }

                                                                                    if (count($instansi_penerima) == count($array_team)) {
                                                                                        echo "<b>Semua Instansi</b>";
                                                                                    } else {
                                                                                        foreach ($instansi_penerima as $key) {
                                                                                            $selecting = (array_search($key->id_instansi, $array_team) === false ) ? '' : 'selecting';
                                                                                            if (!empty($selecting)) {
                                                                                                if ($key->id_instansi == $this->session->userdata('instansi_id')) {
                                                                                                    echo "<b>{$key->nama_instansi}</b>, ";
                                                                                                } else {
                                                                                                    echo "{$key->nama_instansi}, ";
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </cite>
                                                                        </small>
                                                                    </blockquote>
										                        </div>
										                    </div>
										                </div>
			                                        </div>
			                                        <div class="modal-footer">
                                                        <?php if ($a->nama_file): ?>
                                                        <a href="<?php echo base_url('data/agenda/'.$a->nama_file);?>" target="_blank"><button type="button" class="btn btn-primary waves-effect text-left"><i class="fa fa-download"></i>Unduh Berkas</button></a> 
                                                        <?php endif ?>
			                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tutup</button>
			                                        </div>
			                                    </div>
			                                    <!-- /.modal-content -->
			                                </div>
			                                <!-- /.modal-dialog -->
			                            </div>
			                            <!-- /.modal -->
                                    	<?php endif; endforeach; ?>
                                    </ol>
                                </div>
                                <!-- .events-content -->
                            </section>
                            <?php } ?>
                        </div>
                    </div>
                	<!-- /.row -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-user"></i>
                                            <h5 class="text-muted vb">USER</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-danger"><?php echo $user; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-pencil-alt"></i>
                                            <h5 class="text-muted vb">BERITA</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-info"><?php echo $post; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-mouse-alt"></i>
                                            <h5 class="text-muted vb">MODUL</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-success"><?php echo $download; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6  b-0">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="ti-receipt"></i>
                                            <h5 class="text-muted vb">VIDEO</h5> </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-warning"><?php echo $video; ?></h3> </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Aktifitas </h3>
                            <div class="steamline">
                                <?php foreach ($logs as $row) { ?>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="<?php echo base_url('data/user_picture/'.$row->user_picture);?>" alt="user" class="img-circle" /> </div>
                                    <div class="sl-right">
                                        <div class="m-l-40"><a href="#" class="text-info"><b><?php echo $row->full_name; ?></b></a> <span class="sl-date"><?php echo $row->time; ?></span>
                                            <p><?php echo $row->activity; ?>  <?php echo $row->description; ?></a></p>
                                           </div>
                                    </div>
                                </div>
                                <hr>
                               
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                    	<div class="row">
                    		<div class="col-md-12 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Lembaga</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-people text-info"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $lembaga;?></span></li>
                                    </ul>
                                </div>
		                    </div>
                    		<div class="col-md-12 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title"> Koordinator</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder text-purple"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $koordinator; ?></span></li>
                                    </ul>
                                </div>
		                    </div>
                    		<div class="col-md-12 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Total Kegiatan K/L</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder-alt text-danger"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $kegiatan; ?></span></li>
                                    </ul>
                                </div>
		                    </div>
                    		<!-- <div class="col-md-12 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title">Total Kegiatan Provinsi</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="ti-wallet text-success"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $kegiatan_prov; ?></span></li>
                                    </ul>
                                </div>
		                    </div> -->
		                </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="news-slide m-b-15">
                                    <div class="vcarousel slide">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">

                                        <?php foreach ($header as $no => $h): ?>
                                          <?php if($no==1) { $z="active"; } else { $z=""; };?>
                                            <div class="<?php echo $z;?> item">
                                                <div class="overlaybg"><img src="<?php echo base_url().'data/images/header/'.$h->gbr_header;?>" /></div>
                                                <div class="news-content"><span class="label label-danger label-rounded"><?php echo $h->judul; ?></span>
                                                    <h2><?php echo $h->deskripsi; ?></h2></p><a href="#">Read More</a></div>
                                            </div>

                                           <?php endforeach ?>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="bg-theme m-b-15">
                                    <div class="row weather p-20">
                                        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 m-t-40">
                                            <h3>&nbsp;</h3>
                                            <h3  class="text-white"><?=$notice_board?></h3>
                                            <p class="text-white">admin</p>
                                        </div>
                                        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 text-right"> <i class="ti-announcement"></i>
                                            <br/>
                                            <br/> <b class="text-white">Notice Board</b>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-7 col-lg-9 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">MONITORING </h3>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab1m" role="tab" data-toggle="tab" aria-expanded="true"><span><i class="fa fa-bar-chart"></i></span></a></li>
                                <li class=""><a href="#tab2m" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-line-chart"></i></span> </a></li>
                                <li class=""><a href="#tab3m" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-area-chart"></i></span></a></li>
                                <li class=""><a href="#tab4m" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-pie-chart"></i></span></a></li>
                                <li class=""><a href="#tab5m" role="tab" data-toggle="tab" aria-expanded="false"><span><i class="fa fa-support"></i></span></a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab1m">
                                    <canvas id="barChartm"></canvas>  
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab2m">
                                    <canvas id="lineChartm"></canvas>  
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab3m">
                                    <canvas id="areaChartm"></canvas>  
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab4m">
                                    <canvas id="pieChartm"></canvas>  
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab5m">
                                    <canvas id="doughnutChartm"></canvas>  
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                            <!-- .col -->
                            <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-megna">
                                    <h1 class="text-white counter"><?=$totalgrafik?></h1>
                                    <p class="text-white">Total Realisasi Kegiatan</p>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-3 col-sm-6 col-xs-12">
                                <div class="white-box text-center bg-info">
                                    <h1 class="counter text-white"><?=$totalgrafikt?></h1>
                                    <p class="text-white">Total Target Kegiatan</p>
                                </div>
                            </div>
                            <!-- /.col -->

                    <div class="col-md-9 col-lg-3 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Realisasi Kegiatan Yang Dilaporkan</h3>
                            <div class="table-responsive"><table class="table table-hover">
                          <thead>
                                    <tr>
                                      <th scope="col">Triwulan I</th>
                                      <th scope="col">Triwulan II</th>
                                      <th scope="col">Triwulan II</th>
                                      <th scope="col">Triwulan IV</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><?=$grafik1[1]?></td>
                                  <td><?=$grafik1[2]?></td>
                                  <td><?=$grafik1[3]?></td>
                                  <td><?=$grafik1[4]?></td>
                              </tr>
                              <tr>
                                  <td><?php echo ($totalgrafik==0) ? "0" : round(($grafik1[1] / $totalgrafik) * 100, 2 )?>%</td>
                                  <td><?php echo ($totalgrafik==0) ? "0" : round(($grafik1[2] / $totalgrafik) * 100, 2 )?>%</td>
                                  <td><?php echo ($totalgrafik==0) ? "0" : round(($grafik1[3] / $totalgrafik) * 100, 2 )?>%</td>
                                  <td><?php echo ($totalgrafik==0) ? "0" : round(($grafik1[4] / $totalgrafik) * 100, 2 )?>%</td>
                              </tr>
                          </tbody>
                      </table></div>
                        </div>
                    </div>




                </div>
                <!--row -->

               
              
            </div>

        </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/morrisjs/morris.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/moment/moment.js"></script>

<script type="text/javascript" src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript">
        $('#inline-username').editable({
            type: 'text',
            pk: 1,
            name: 'username',
            title: 'Enter username',
            mode: 'inline'
        });

        $('#inline-fullname').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success : function (resnponse, newValue){ x_update("full_name",newValue);}
        });

        $('#inline-phone').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success : function (resnponse, newValue){ x_update("phone",newValue);}
        });

        $('#inline-email').editable({
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success : function (resnponse, newValue){ x_update("email",newValue);}
        });

        $('#inline-instansi').editable({
            prepend: "not selected",
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            source: [
            <?php foreach ($instansi as $row): ?>
            {
                value: <?=$row->id_instansi?>,
                text: '<?=$row->nama_instansi?>'
            },   
            <?php endforeach ?>
            ],
            display: function(value, sourceData) {
                var colors = {
                        "": "#98a6ad",
                        1: "#5fbeaa",
                        2: "#5d9cec"
                    },
                    elem = $.grep(sourceData, function(o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            },
            success : function (resnponse, newValue){ x_update("instansi_id",newValue);}
        });

        $('#inline-status').editable({
            mode: 'inline'
        });

        $('#inline-group').editable({
            showbuttons: false,
            mode: 'inline'
        });

        $('#inline-dob').editable({
            mode: 'inline'
        });

        $('#inline-address').editable({
            showbuttons: 'bottom',
            mode: 'inline',
            success : function (resnponse, newValue){ x_update("bio",newValue);}
        });


    </script>