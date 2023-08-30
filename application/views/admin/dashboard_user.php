
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
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        <ol class="breadcrumb">
                            <li class="active">Dashboard</li>
                            <li><a href="<?php echo base_url('admin/dashboard');?>">SIKAP</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="collapse m-t-15" id="pgr1" aria-expanded="true"> <pre class="line-numbers language-javascript m-t-0"></pre> </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title"> Jumlah Sasaran</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-compass text-info"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $sasaran; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="white-box">
                                    <h3 class="box-title"> Jumlah IKU</h3>
                                    <ul class="list-inline two-part">
                                        <li><i class="icon-folder text-success"></i></li>
                                        <li class="text-right"><span class="counter"><?php echo $iku; ?></span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12">
                                <div class="white-box">
		                            <h3 class="box-title">Total anggaran</h3>
                                    <ul class="list-inline two-part">
                                        <li><span class="counter"><h1> Rp.445.234.700.000,00</h1></span></li>
                                    </ul>
		                        </div>
                            </div>
                        </div>
                    </div>
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
                                    <div class="col-md-12"><strong>Unit Kerja</strong>
                                        <p>
                                            <?php echo $nama_unit_kerja; ?>
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
                    <!-- /.row -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                
                <div class="row">
					<div class="col-md-3">
					<div class="white-box">
						<!-- Headline -->
						<div class="switcher-coasntent">
							<div class="row">
									<center> 
										<div class='square-box margin-top-45'>
                                            <div class='square-content'><div data-label="<?=$capaian?>%" class="css-bar css-bar-<?=($capaian<=100) ? round_c($capaian) : 100?> css-bar-lg css-bar-danger"></div></div>
										</div>
										<hr>
										<h4 class="box-title">Sekretariat Utama</h4>
									</center> 
								</div>
									</div>
									</div> 
					</div>
					<div class="col-md-9">
					<div class="white-box">
						<!-- Headline -->
						<h3 class="box-title"> Detail Capaian Target </h3>
							<div class="row">
								<div class="col-md-12">


									<table class="table table-hover color-table red-table">
										<thead>
											<tr  align="center">
												<th>No.</th>
												<th>IKU / IKK</th>
												<th>Target</th>
												<th>Realisasi</th>
												<th>Persentase</th>   
											</tr> 

										</thead>
										<tbody>
                                            <?php
                                            $i=1;
                                            foreach ($detail_pecapaian as $row) {
                                                echo '
                                                <tr>
                                                    <td align="right">'.$i.'</td>
                                                    <td>'.$row->nama_indikator.'</td>
                                                    <td>'.$row->target.' '.$row->satuan.'</td>
                                                    <td>'.$row->realisasi.' '.$row->satuan.'</td>
                                                    <td><span class="text-danger text-semibold"></i> '.number_format($row->capaian,2).'%</span></td> 
                                                </tr>
                                                ';
                                                $i++;
                                            }
                                            ?>
										</tbody>

									</table>

								</div>
							</div>
						</div>
					</div>
				</div>

               
              
            </div>

        </div>

    <!-- jQuery -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>plugins/bower_components/morrisjs/morris.js"></script>


    <!-- Bootstrap Core JavaScript --><!-- 
    <script src="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()."asset/pixel/" ;?>/plugins/bower_components/moment/moment.js"></script> -->

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

        $('#inline-unit_kerja').editable({
            prepend: "not selected",
            validate: function(value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            source: [
            <?php foreach ($unit_kerja as $row): ?>
            {
                value: <?=$row->id_unit_kerja?>,
                text: '<?=$row->nama_unit_kerja?>'
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
            success : function (resnponse, newValue){ x_update("unit_kerja_id",newValue);}
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