<!-- xeditable css -->
<link
    href="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css"
    rel="stylesheet" />

<script type="text/javascript">
    function confirm_kirim(no) {
        $('#send-message').attr('onclick', "kirim('" + no + "');");
    }

    function kirim(no) {
        data = new FormData($('#form')[0]);
        $.ajax({
            url: "<?php echo base_url('manage_project/verifikasi/"+no+"/kirim'); ?>",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (resp) {
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
            error: function (event, textStatus, errorThrown) {
                alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
            }
        })
    }

    function save(table) {
        $.ajax({
            url: "<?php echo base_url('manage_user/save_"+table+"/' . $user_id); ?>",
            type: "POST",
            data: $('#form-' + table).serialize(),
            success: function (resp) {
                document.getElementById("form-" + table).reset();
                $('#' + table + '-modal').modal('hide');
                swal("Good job!", "Data has been added.", "success");
            },
            error: function (event, textStatus, errorThrown) {
                swal("Error!", 'Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown, "error");
            }
        })
        reload_table('' + table);
    }

    function reload_table(table) {
        $.ajax({
            url: "<?php echo base_url('manage_user/reload_table/' . $user_id . '/"+table+"'); ?>",
            type: "POST",
            success: function (resp) {
                $('#table-' + table).html(resp);
            }
        })
    }

    function progressbar() {
        var progress = (done / task) * 100;
        $('#progress-bar').attr('style', 'width: ' + progress + '%;');
        document.getElementById('progress-bar').innerHTML = " " + progress + "% ";
    }

    function save_setting(employee_id) {
        var full_name = '<?= escape_single_quote($detail->nama_lengkap) ?>';
        var email = '<?= $email ?>';

        $.ajax({
            url: "<?php echo base_url('manage_user/change_password/"+employee_id+"'); ?>",
            type: "POST",
            data: $('#form-setting').serialize(),
            success: function (data) {
                var data = JSON.parse(data);

                //data.username = "test";
                if (data.isSuccess && $("input[name=password]").val() != "") {
                  
                        $("#message").html(data.msg);
                        $("#btnSetting").html('Update Profile');

                }
                else {
                    $("#message").html(data.msg);
                    $("#btnSetting").html('Update Profile');
                }
            }
            , beforeSend: function () {
                $("#message").html('');
                $("#btnSetting").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please wait ...');
            }

        })

        return false;
    }

    function save_sertifikat(employee_id) {
        data = new FormData($('#form-sertifikat')[0]);
        $.ajax({
            url: "<?php echo base_url('manage_user/change_sertifikat/"+employee_id+"'); ?>",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $("#message-sertifikat").html(data);
                $("#btnSertifikat").html('Update Sertifikat');
            },
            beforeSend: function () {
                $("#message-sertifikat").html('');
                $("#btnSertifikat").html('<i class="fa fa-circle-o-notch fa-spin"></i> Please wait ...');
            }

        })

        return false;
    }

    function x_update(name, value) {
        // data = new FormData($('#form')[0]);   
        $.ajax({
            url: "<?php echo base_url('manage_user/x_update_profile'); ?>",
            type: "POST",
            data: {
                id: '<?php echo $user_id; ?>',
                name: name,
                value: value
            },
            success: function (resp) {
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
            error: function (event, textStatus, errorThrown) {
                alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
            }
        })
    }

    function x_update_image() {
        data = new FormData($('#form-profile-image')[0]);
        $.ajax({
            url: "<?php echo base_url('manage_user/x_update_profile_image/' . $user_id); ?>",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#input-file-user-picture').attr("disabled", true);
            },
            success: function (resp) {
                alert(resp);
                $('#input-file-user-picture').attr("disabled", false);
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
            error: function (event, textStatus, errorThrown) {
                alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
            }
        })
    }
</script>


<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profil</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('home') ?>">Dashboard</a></li>
                            <li class="active">Halaman Profil</li>
                        </ol>
                    </div> -->
    </div>
    <!-- /.row -->
    <!-- .row -->
    <div class="row">
        <?php if ($this->router->class != "master_pegawai"): ?>
            <div class="col-md-4 col-xs-12">
                <div class="white-box">
                    <form action="#" method="POST" id="form-profile-image" class="form-horizontal form-material">
                        <div class="user-bg">
                            <input type="file" name='userfile' id="input-file-user-picture"
                                class="dropify thumb-lg img-circle" style="max-height: 100% !important"
                                data-default-file="<?php echo base_url('data/foto/pegawai/' . $picture); ?>"
                                data-show-remove="false" onchange="x_update_image();" />
                        </div>
                    </form>
                    <div class="user-btm-box" style="padding: 0">
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-12">
                                <?php if (!empty($error))
                                    echo "<div class='alert alert-info'>$error</div>"; ?>
                                <h4>
                                    <a href="#" id="inline-fullname" style="color: #f75b36" data-type="text" data-pk="1"
                                        data-placement="right" data-placeholder="Required" data-title="Enter your name">
                                        <?php echo $full_name; ?>
                                    </a>
                                </h4>

                            </div>
                        </div>
                        <!-- /.row -->
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-12"><strong>Unit Kerja</strong>
                                <p>
                                    <a href="#" id="inline-unit_kerja" data-type="select" data-pk="1"
                                        data-value="<?php echo $unit_kerja_id; ?>" data-placeholder="Required"
                                        data-title="Select Unit Kerja"></a>
                                </p>

                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-6 b-r"><strong>E-mail</strong>
                                <p>
                                    <a href="#" id="inline-email" data-type="email" data-pk="1" data-placement="right"
                                        data-placeholder="Required" data-title="Enter your email">
                                        <?php echo $email; ?>
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6"><strong>Phone</strong>
                                <p>
                                    <a href="#" id="inline-phone" data-type="text" data-pk="1" data-placement="right"
                                        data-placeholder="Required" data-title="Enter your phone number">
                                        <?php echo $phone; ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /.row -->
                        <hr>
                        <!-- .row -->
                        <div class="row text-center m-t-10">
                            <div class="col-md-12"><strong>Alamat</strong>
                                <p><a href="#" id="inline-address" data-type="textarea" data-pk="1"
                                        data-placeholder="Your address here..." data-title="Enter address">
                                        <?php echo $bio; ?>
                                    </a></p>

                            </div>
                        </div>
                        <hr>
                        <!-- /.row -->
                        <!-- </br>
                                <div class="col-md-12">
                                </br>
                                <button class='btn btn-success' type="submit" style='width:100%'>Save Profile</button>
                                </div> -->

                        <!-- <div class="col-md-12">
                                <br>
                               
                                <button class='btn btn-danger' style='width:100%'>Register Profile</button>

                                
                               
                                </div> -->

                        <div class="col-md-12">
                            <br>

                            <button type="button" class='btn btn-default' style='width:100%'
                                onclick="delete_('<?= $user_id; ?>');">Hapus Pengguna</button>



                        </div>

                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php if ($this->router->class != "master_pegawai"): ?>
            <div class="col-md-8 col-xs-12">
            <?php else: ?>
                <div class="col-md-12 col-xs-12">
                <?php endif ?>
                <div class="white-box">
                    <ul class="nav nav-tabs tabs customtab">
                        <?php if ($this->router->class != "master_pegawai"): ?>
                            <li class="active tab">
                                <a href="#home" data-toggle="tab"> <span class="visible-xs"><i
                                            class="fa fa-home"></i></span> <span class="hidden-xs">Aktifitas</span> </a>
                            </li>
                        <?php endif ?>
                        <!-- <li class="tab">
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
                                </li> -->


                        <li class="<?= ($this->router->class != 'master_pegawai') ? '' : 'active' ?> tab">
                            <a href="#privilege" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                        class="fa fa-user"></i></span> <span class="hidden-xs">Hak Akses</span> </a>
                        </li>


                        <li class="tab">
                            <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                        class="fa fa-cog"></i></span> <span class="hidden-xs"> Akun</span> </a>
                        </li>


                        <li class="tab">
                            <a href="#sertifikat" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                        class="fa fa-doc"></i></span> <span class="hidden-xs"> Sertifikat</span> </a>
                        </li>

                        <?php if ($id_pegawai) { ?>
                            <!-- <li class="tab fill">
                                    <a href="<?php echo base_url() . 'master_pegawai/detail/' . $id_pegawai; ?>"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs"><i class="ti-user"></i> Detail Pegawai</span> </a>
                                </li> -->
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php if ($this->router->class != "master_pegawai"): ?>
                            <div class="tab-pane active" id="home">
                                <div class="steamline">
                                    <?php foreach ($logs as $row) { ?>
                                        <div class="sl-item">
                                            <div class="sl-left"> <img
                                                    src="<?php echo base_url('data/foto/pegawai/' . $picture); ?>" alt="user"
                                                    class="img-circle" /> </div>
                                            <div class="sl-right">
                                                <div class="m-l-40"><a href="#" class="text-info"><b>
                                                            <?php echo $full_name; ?>
                                                        </b></a> <span class="sl-date">
                                                        <?php echo $row->time; ?>
                                                    </span>
                                                    <p>
                                                        <?php echo $row->activity; ?>
                                                        <?php echo $row->description; ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                    <?php } ?>

                                </div>
                            </div>
                        <?php endif ?>
                        <div class="tab-pane" id="project">


                        </div>
                        <div class="tab-pane" id="employ">



                        </div>

                        <div class="tab-pane" id="education">



                        </div>


                        <div class="tab-pane" id="family">
                            <div class="row">

                            </div>

                        </div>

                        <div class="tab-pane" id="work_ex">
                            <div class="row">

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
                                        <input type="text" value="<?= $username ?>" name="username"
                                            class="form-control form-control-line">
                                        <input type="hidden" value="<?= $username ?>" name="old_username"
                                            class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input name="password" type="password" placeholder="Masukan Password Baru"
                                            class="form-control form-control-line">
                                        <small>*Kosongkan jika tidak mengubah Password Baru</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Ulangi Password</label>
                                    <div class="col-md-12">
                                        <input name="conf_password" type="password"
                                            placeholder="Masukan Kembali Password"
                                            class="form-control form-control-line">
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="button" id="btnSetting" onclick="save_setting(<?= $user_id ?>)"
                                        class="btn btn-success">Ubah Password</button>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="sertifikat">
                            <div id="message-sertifikat">
                                <!-- <div class="alert alert-success">User Setting successfully changed</div> -->
                            </div>
                            <form action="#" method="POST" id="form-sertifikat" class="form-horizontal form-material">

                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Sertifikat .p12</label>
                                    <div class="col-sm-12">
                                        <input type="file" name='certificate'
                                            class="form-control file2 inline btn btn-primary" accept=".p12"
                                            data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                        <p>
                                            <?php echo (empty($certificate)) ? "contoh : <i>sertifikat.crt</i>" : "dipakai : <i>{$certificate}</i> <a href='" . base_url('data/sertifikat/' . $user_id . '/' . $certificate) . "' class='btn btn-xs btn-primary btn-outline'>download</a>"; ?>
                                        </p>
                                        <?php if (!empty($error_certificate))
                                            echo "
                                                    <div class='alert alert-warning'>$error_certificate</div>"; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Sertifikat .key</label>
                                    <div class="col-sm-12">
                                        <input type="file" name='dot_key'
                                            class="form-control file2 inline btn btn-primary" accept=".key"
                                            data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                        <p>
                                            <?php echo (empty($dot_key)) ? "contoh : <i>sertifikat.key</i>" : "dipakai : <i>{$dot_key}</i> <a href='" . base_url('data/sertifikat/' . $user_id . '/' . $dot_key) . "' class='btn btn-xs btn-primary btn-outline'>download</a>"; ?>
                                        </p>
                                        <?php if (!empty($error_key))
                                            echo "
                                                    <div class='alert alert-warning'>$error_key</div>"; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Sertifikat Password</label>
                                    <div class="col-sm-12">
                                        <input type="password" class="form-control" name='pass_key'
                                            placeholder="Biarkan kosong jika tidak akan diubah.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Scan TTD.</label>
                                    <div class="col-sm-12">
                                        <div class="profile_img">
                                            <div id="crop-avatar">
                                                <input type="file" name='scan_ttd'
                                                    class="form-control file2 inline btn btn-primary" accept=".png"
                                                    data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
                                                <p>
                                                    Max : 500px | 1MB
                                                </p>
                                                <?php if (!empty($error_scan_ttd))
                                                    echo "
                                                    <div class='alert alert-warning'>$error_scan_ttd</div>"; ?>
                                                <!-- Current avatar -->
                                                <?php
                                                if (!empty($scan_ttd)) {
                                                    echo "
                                                  <img class='img-responsive avatar-view' src='" . base_url() . "data/sertifikat/{$user_id}/{$scan_ttd}' class='img-rounded'  />";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="button" id="btnSertifikat"
                                            onclick="save_sertifikat(<?= $user_id ?>)" class="btn btn-success">Ubah
                                            Sertifikat</button>
                                    </div>
                                </div>
                            </form>
                        </div>




                        <div class="tab-pane <?= ($this->router->class != 'master_pegawai') ? '' : 'active' ?>"
                            id="privilege">
                            <form class="form-horizontal form-material" method="POST"
                                action="<?php echo base_url() . 'manage_user/update_privileges/' . $user_id . '?source=' . current_url(); ?>">

                                <hr>

                                <div class="form-group">
                                    <label class="col-md-5">
                                        <h3>DEFAULT</h3>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="checkbox" class="js-switch" data-color="#6164c1" checked
                                            disabled />
                                        <input type="hidden" name="user_privileges[]" value="default">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-md-5">
                                        <h3>PROGRAM</h3>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="checkbox" name="user_privileges[]" value="program"
                                            class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('program', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-md-5">
                                        <h3>KEPEGAWAIAN</h3>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="checkbox" name="user_privileges[]" value="kepegawaian"
                                            class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('kepegawaian', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label class="col-md-5">
                                        <h3>TU PIMPINAN</h3>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="checkbox" name="user_privileges[]" value="tu_pimpinan"
                                            class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('tu_pimpinan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                    </div>
                                </div>

                                <?php
                                if ($user_level != 4) {
                                    ?>
                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>EKSEKUTIF VIEW</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="eksekutif_view"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('eksekutif_view', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>INSPEKTORAT</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="inspektorat"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('inspektorat', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>PENGISI RB/ZI</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="rb_zi" class="js-switch"
                                                data-color="#6164c1" <?php echo $checked = (array_search('rb_zi', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>AUDITOR LKE</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="auditor_lke"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('auditor_lke', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>MANAJEMEN TALENTA</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="talenta"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('talenta', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>OPERATOR KEPEGAWAIAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="op_kepegawaian"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('op_kepegawaian', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>PENGUMUMAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="pengumuman"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('pengumuman', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>DIKLAT</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="diklat" class="js-switch"
                                                data-color="#6164c1" <?php echo $checked = (array_search('diklat', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SAKIP DESA</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="sakip_desa"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('sakip_desa', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>ADMIN WEB SKPD</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="web_skpd"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('web_skpd', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>KEUANGAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="keuangan"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('keuangan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>TATA PEMERINTAHAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="tata_pemerintahan"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('tata_pemerintahan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>RPJMD SICERDAS</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="sicerdas_rpjmd"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('sicerdas_rpjmd', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>RENSTRA SICERDAS</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="sicerdas_renstra"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('sicerdas_renstra', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>STANDAR KEPATUHAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="standar_kepatuhan"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('standar_kepatuhan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>ADMIN STANDAR KEPATUHAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="admin_standar_kepatuhan"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('admin_standar_kepatuhan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SIKOMPLIT</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="indeks_inovasi"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('indeks_inovasi', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>ADMIN SIKOMPLIT</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="admin_indeks_inovasi"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('admin_indeks_inovasi', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SIGESIT</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="sigesit"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('sigesit', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>UMKM</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="umkm" class="js-switch"
                                                data-color="#6164c1" <?php echo $checked = (array_search('umkm', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SIMANJA</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="simanja"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('simanja', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>ADMIN SIMANJA</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="admin_simanja"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('admin_simanja', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>TAPEM</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="tapem" class="js-switch"
                                                data-color="#6164c1" <?php echo $checked = (array_search('tapem', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SETTING POKJA RB - ZI</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="setting_pokja"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('setting_pokja', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>OPERATOR PENGAWASAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="auditor"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('auditor', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-5">
                                            <h3>SIMAPAN</h3>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="checkbox" name="user_privileges[]" value="simapan"
                                                class="js-switch" data-color="#6164c1" <?php echo $checked = (array_search('simapan', explode(';', $user_privileges)) === false) ? '' : 'checked'; ?> />
                                        </div>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success" type="submit">Update Hak Akses</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="family-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
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
                                    <input type="text" name="jobs" class="form-control" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Close</button>
                                <button type="button" onclick="save('family');"
                                    class="btn btn-danger waves-effect waves-light">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <div id="work_ex-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" style="display: none;">
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
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Close</button>
                                <button type="button" onclick="save('work_ex');"
                                    class="btn btn-danger waves-effect waves-light">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function delete_(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                window.location = "<?php echo base_url(); ?>manage_user/delete/" + id + "<?php echo '?source=' . current_url() ?>";
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        }
    </script>


    <!-- jQuery -->
    <script src="<?php echo base_url() . "asset/pixel/"; ?>plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . "asset/pixel/inverse/"; ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/moment/moment.js"></script>

    <script type="text/javascript"
        src="<?php echo base_url() . "asset/pixel/"; ?>/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript">
        $('#inline-username').editable({
            type: 'text',
            pk: 1,
            name: 'username',
            title: 'Enter username',
            mode: 'inline'
        });

        $('#inline-fullname').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success: function (resnponse, newValue) {
                x_update("full_name", newValue);
            }
        });

        $('#inline-phone').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success: function (resnponse, newValue) {
                x_update("phone", newValue);
            }
        });

        $('#inline-email').editable({
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            success: function (resnponse, newValue) {
                x_update("email", newValue);
            }
        });

        $('#inline-unit_kerja').editable({
            prepend: "not selected",
            validate: function (value) {
                if ($.trim(value) == '') return 'This field is required';
            },
            showbuttons: 'bottom',
            mode: 'inline',
            source: [
                <?php foreach ($get_unit_kerja as $row): ?> {
                        value: <?= $row->id_unit_kerja ?>,
                        text: '<?= $row->nama_unit_kerja ?>'
                    },
                <?php endforeach ?>
            ],
            display: function (value, sourceData) {
                var colors = {
                    "": "#98a6ad",
                },
                    elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                if (elem.length) {
                    $(this).text(elem[0].text).css("color", colors[value]);
                } else {
                    $(this).empty();
                }
            },
            success: function (resnponse, newValue) {
                x_update("unit_kerja_id", newValue);
            }
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
            success: function (resnponse, newValue) {
                x_update("bio", newValue);
            }
        });
    </script>