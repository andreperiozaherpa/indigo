<style>
.fa-check {
    color: #02b502;
}
</style>
<div class="container-fluid">
    <?php if (isset($passResponse))
    print_r($passResponse); ?>
    <?php if (isset($urlUser))
    print_r($urlUser); ?>

    <!--ADD BY AYU-->
    <input type="hidden" value="<?= $passwordSuccess; ?>" id="passMsg" class="form-control form-control-line">
    <input type="hidden" value="<?= $tokenCmdbuild; ?>" id="tokenCmdbuild" class="form-control form-control-line">
    <!--ADD BY AYU-->

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">
                <?php echo title($title) ?>
            </h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <?php echo breadcrumb($this->uri->segment_array()); ?>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php
            if (!empty($message)) {
                ?>
            <div class="alert alert-<?= $type; ?> alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
                </button>
                <?= $message; ?>
            </div>
            <?php } ?>
            <?= $this->session->userdata('error'); ?>
            <div class="x_panel">
                <div class="x_content">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan'
                        style='display:none'>
                        <button type="button" onclick='hideMe()' class="close" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                        <label id='status'></label>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Foto Profil</div>
                            <div class="panel-body">
                                <?= form_open_multipart() ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label>Upload Foto
                                        </label>
                                        <?php
                                        if ($detail->foto_pegawai !== 'user-default.png') {
                                            ?>
                                        <button type="submit" name="delete_pic"
                                            class="pull-right btn btn-danger btn-xs"><i class="ti-trash"></i> Hapus Foto
                                            Profil</button>
                                        <?php } ?>
                                        <input type="file" name="foto_pegawai"
                                            data-default-file="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai . '') ?>"
                                            class="dropify form-control" name="">
                                    </div>
                                    <button type="submit" name="profil_pic" class="btn btn-primary btn-block"><i
                                            class="ti-gallery"></i> Ganti Foto Profil</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-body" style="padding-top: 10px">
                                <!-- Nav tabs -->
                                <ul class="nav customtab nav-tabs" role="tablist">
                                    <li role="presentation" class="<?= isset($_GET['password']) ? null : "active" ?>"><a
                                            href="#home1" aria-controls="home" role="tab" data-toggle="tab"
                                            aria-expanded="true"><span class="visible-xs"><i
                                                    class="ti-briefcase"></i></span><span class="hidden-xs"><i
                                                    class="ti-briefcase"></i> Kepegawaian</span></a>
                                    </li>
                                    <li role="presentation" class=""><a href="#identitas" aria-controls="profile"
                                            role="tab" data-toggle="tab" aria-expanded="false"><span
                                                class="visible-xs"><i class="ti-credit-card"></i></span> <span
                                                class="hidden-xs"><i class="ti-credit-card"></i> Identitas</span></a>
                                    </li>
                                    <li role="presentation" class="<?= isset($_GET['password']) ? "active" : null ?>"><a
                                            href="#profile1" aria-controls="profile" role="tab" data-toggle="tab"
                                            aria-expanded="false"><span class="visible-xs"><i
                                                    class="ti-user"></i></span> <span class="hidden-xs"><i
                                                    class="ti-user"></i> Akun</span></a></li>
                                    <li role="certificate" class=""><a href="#certificate1" aria-controls="certificate"
                                            role="tab" data-toggle="tab" aria-expanded="false"><span
                                                class="visible-xs"><i class="ti-medall"></i></span> <span
                                                class="hidden-xs"><i class="ti-medall"></i> Sertifikat</span></a></li>
                                    <li role="certificate" class=""><a href="#atasan" aria-controls="certificate"
                                            role="tab" data-toggle="tab" aria-expanded="false"><span
                                                class="visible-xs"><i class="ti-medall"></i></span> <span
                                                class="hidden-xs"><i class="ti-stats-up"></i> Atasan</span></a>
                                    </li>
                                    <li role="certificate" class=""><a href="#lokasi" aria-controls="certificate"
                                            role="tab" data-toggle="tab" aria-expanded="false"><span
                                                class="visible-xs"><i class="ti-medall"></i></span> <span
                                                class="hidden-xs"><i class="ti-map-alt"></i> Lokasi</span></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel"
                                        class="tab-pane fade <?= isset($_GET['password']) ? null : "active in" ?>"
                                        id="home1">
                                        <?= form_open() ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap"
                                                        value="<?= $detail->nama_lengkap ?>" class="form-control"
                                                        placeholder="Masukkan Nama Lengkap">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>NIP / NRP</label>
                                                    <input type="text" name="nip" id="nip" class="form-control"
                                                        placeholder="Masukkan NIP / NRP" value="<?= $detail->nip ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Pangkat</label>
                                                    <input type="text" name="pangkat" value="<?= $detail->pangkat ?>"
                                                        id="pangkat" class="form-control"
                                                        placeholder="Masukkan Pangkat">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Golongan</label>
                                                    <input type="text" name="golongan" value="<?= $detail->golongan ?>"
                                                        id="golongan" class="form-control"
                                                        placeholder="Masukkan Golongan">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>SKPD</label>
                                                    <select readonly onchange="getUnitKerja()" name="id_skpd"
                                                        class="form-control" id="id_skpd">
                                                        <option value="">Pilih SKPD</option>
                                                        <?php
                                                        foreach ($skpd as $s) {
                                                            if ($s->id_skpd == $detail->id_skpd) {
                                                                $selected = ' selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                            echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Unit Kerja</label>
                                                    <select
                                                        style="<?= isset($_GET['unit_kerja']) ? 'border-color: #96281b !important' : '' ?>"
                                                        onchange="getJabatan()" name="id_unit_kerja"
                                                        class="form-control" id="id_unit_kerja">
                                                        <option value="">Pilih Unit Kerja</option>
                                                        <?php
                                                        foreach ($unit_kerja as $u) {
                                                            if ($u->id_unit_kerja == $detail->id_unit_kerja) {
                                                                $selected = ' selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                            echo '<option value="' . $u->id_unit_kerja . '"' . $selected . '>' . $u->nama_unit_kerja . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Jabatan</label>
                                                    <input type="text" class="form-control" name="jabatan"
                                                        value="<?= $detail->jabatan ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Jenis Pegawai</label>
                                                    <select name="jenis_pegawai" class="form-control"
                                                        id="jenis_pegawai">
                                                        <option value="">Pilih Jenis Pegawai</option>
                                                        <?php
                                                        $jenis = array('kepala', 'staff');
                                                        foreach ($jenis as $j) {
                                                            if ($j == $detail->jenis_pegawai) {
                                                                $selected = ' selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                            echo '<option value="' . $j . '"' . $selected . '>' . ucwords($j) . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>No. Handphone</label>
                                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                        placeholder="Masukkan Nomor Handphone"
                                                        value="<?= $detail->no_hp ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button name="account" class="btn btn-primary pull-right"
                                                    type="submit"><i class="ti-save"></i> Simpan Perubahan</button>
                                            </div>
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="identitas">
                                        <?= form_open_multipart() ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input type="text" name="nik" id="nip" class="form-control"
                                                    placeholder="Masukkan NIK" value="<?= $detail->nik ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Scan / Foto KTP</label>
                                            <input type="file" name="file_ktp" id="input-file-now" class="dropify"
                                                data-default-file="<?= base_url() ?>data/ktp/<?= $detail->file_ktp ?>"
                                                accept="image/*">
                                        </div>
                                        <button name="identitas" class="btn btn-primary pull-right" type="submit"><i
                                                class="ti-save"></i> Simpan Perubahan</button>

                                        <?= form_close() ?>
                                    </div>
                                    <div role="tabpanel"
                                        class="tab-pane fade <?= isset($_GET['password']) ? "active in" : null ?>"
                                        id="profile1">
                                        <?php
                                        if (isset($_GET['password'])) {
                                            ?>
                                        <div class="alert alert-danger" role=" alert">
                                            <span style="font-weight:500"><i class="ti-alert"></i> Peringatan</span>
                                            <p>Saat ini Kata Sandi Anda tidak aman , silahkan ganti Kata Sandi
                                                Anda sesuai dengan kriteria dibawah.</p>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <?= form_open() ?>
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label">Password Lama</label>
                                            <input type="password" class="form-control" name="old_password"
                                                placeholder="Masukkan Password Lama">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Password Baru</label>
                                            <input type="password" class="form-control" id="password" name="n_password"
                                                placeholder="Masukkan Password Baru" autocomplete="off">
                                            <div id="popover-password">
                                                <p><span id="result"></span></p>
                                                <div class="progress">
                                                    <div id="password-strength" class="progress-bar" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                        style="width:0%">
                                                    </div>
                                                </div>
                                                <ul class="list-unstyled">
                                                    <li class="">
                                                        <span class="low-upper-case">
                                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            &nbsp;Huruf Kecil &amp; Huruf Besar
                                                        </span>
                                                    </li>
                                                    <li class="">
                                                        <span class="one-number">
                                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            &nbsp;Angka (0-9)
                                                        </span>
                                                    </li>
                                                    <li class="">
                                                        <span class="one-special-char">
                                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            &nbsp;Karakter Spesial (!@#$%^&*)
                                                        </span>
                                                    </li>
                                                    <li class="">
                                                        <span class="eight-character">
                                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                                            &nbsp;Setidaknya memiliki 8 Karakter
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Konfirmasi Password
                                                Baru</label>
                                            <input type="password" class="form-control" name="cn_password"
                                                placeholder="Konfirmasi Password Baru">
                                        </div>
                                        <button id="btnPassword" name="password"
                                            class="btn btn-primary pull-right btn-disabled" type="submit" disabled><i
                                                class="ti-save"></i> Simpan Perubahan</button>

                                        <?= form_close() ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="certificate1">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="file" name="certificate" id="input-file-now"
                                                    class="dropify"
                                                    data-default-file="<?= base_url() ?>data/sertifikat/<?= $details->certificate ?>"
                                                    accept=".p12">
                                            </div>
                                            <span>* Upload file sertifikat dalam format .p12</span>
                                            <p></p>
                                            <button type="submit" name="upload_certificate"
                                                class="btn btn-primary btn-block"><i class="ti-save"></i> Simpan
                                            </button>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="atasan">
                                        <form method="post">
                                            <div class="form-group">
                                                <label>SKPD</label>
                                                <select onchange="getPegawaiSKPD()" class="form-control select2"
                                                    id="id_skpd_atasan">
                                                    <option value="">Pilih SKPD</option>
                                                    <?php
                                                    foreach ($skpd as $s) {
                                                        if (empty($detail->id_pegawai_atasan_langsung)) {
                                                            $selected = $s->id_skpd == $detail->id_skpd ? ' selected' : '';
                                                        } else {
                                                            $datasan = $detail->id_pegawai_atasan_langsung;
                                                            $id_skpd_atasan = $this->master_pegawai_model->get_by_id($datasan)->id_skpd;
                                                            $selected = $s->id_skpd == $id_skpd_atasan ? ' selected' : '';
                                                        }
                                                        echo '<option value="' . $s->id_skpd . '"' . $selected . '>' . $s->nama_skpd . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Pegawai Atasan Langsung</label>
                                                <select name="id_pegawai_atasan_langsung" class="form-control select2">
                                                    <option value="">Pilih Pegawai</option>
                                                    <?php
                                                    if (!empty($detail->id_pegawai_atasan_langsung)) {
                                                        $datasan = $detail->id_pegawai_atasan_langsung;
                                                        $id_skpd_atasan = $this->master_pegawai_model->get_by_id($datasan)->id_skpd;
                                                        $atasan = $this->master_pegawai_model->get_by_id_skpd($id_skpd_atasan);
                                                    }
                                                    foreach ($atasan as $a) {
                                                        $selected = $detail->id_pegawai_atasan_langsung == $a->id_pegawai ? ' selected' : '';
                                                        echo '<option value="' . $a->id_pegawai . '"' . $selected . '><br>' . $a->nip . ' : ' . $a->nama_lengkap . ' - ' . $a->jabatan . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="atasan" class="btn btn-primary btn-block"><i
                                                    class="ti-save"></i> Simpan </button>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="lokasi">
                                        <form method="post">
                                            <div class="form-group">
                                                <label>Lokasi Kantor</label>
                                                <select class="form-control select2" name="id_ref_skpd_sub"
                                                    id="id_ref_skpd_sub">
                                                    <option value="">Kantor Utama <?= $detail->nama_skpd ?></option>
                                                    <?php
                                                    foreach ($sub_office as $s) {
                                                        $selected = $detail->id_ref_skpd_sub == $s->id_ref_skpd_sub ? " selected" : "";
                                                        echo '<option value="' . $s->id_ref_skpd_sub . '"' . $selected . '>' . $s->nama_sub . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="lokasi" class="btn btn-primary btn-block"><i
                                                    class="ti-save"></i> Simpan </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/*ADD BY AYU*/
var urlToken = '<?= $this->config->item("urlToken"); ?>';
var urlUsers = '<?= $this->config->item("urlUsers"); ?>';
var urlRole = '<?= $this->config->item("urlRole"); ?>';

var token = "";
var users = [];
var userData = {};
var roles = [];

$(document).ready(function() {
    var passSuccess = $("input#passMsg").val();
    token = $("input#tokenCmdbuild").val();

    if (token == "") {
        //get cmdbuild token
        GetCmdbuildToken('<?= $this->config->item("adminCmdbuild"); ?>',
            '<?= $this->config->item("passwordCmdbuild"); ?>');
    }

    if (token != "") {
        //get all users
        GetAllUsers(token);

        //get all roles
        GetRoles();

        if (passSuccess == "success") {
            var userName = "<?= $details->username ?>";
            var userPass = "<?= $details->password ?>";
            var newPassword = "<?= $newPassword ?>";
            var full_name = "<?= $detail->nama_lengkap ?>";
            var email = "<?= $email ?>";
            var userRole = GetRoleByRoleName(roles, "<?= $this->config->item("groupUser"); ?>");

            /*var dataUser = '{"username":"'+userName+'","description":"'+userName+'","email":"","lastExpiringNotification":null,"lastPasswordChange":null,"passwordExpiration":null,"service":false,"defaultUserGroup":"","multiGroup":false,"active":true,"userGroups":[{"_id":'+userRole["_id"]+',"name":"'+userRole["name"]+'","description":"'+userRole["description"]+'"}],"userTenants":[],"password":"'+newPassword+'","multiTenantActivationPrivileges":"any","initialPage":"","language":"","changePasswordRequired":false,"groupsLength":1,"confirmPassword":"'+newPassword+'"}';
            
            //console.log(dataUser);
            CreateUserCmdbuild(dataUser);*/

            ///get id by username
            var userIdCmdbuild = GetIdByUsername(users, userName);

            //get data by id 
            GetUserById(userIdCmdbuild);

            //change user password
            userData.password = newPassword;
            userData.confirmPassword = newPassword;
            userData.description = full_name;
            userData.email = email;

            UpdateUserCmdbuild(userIdCmdbuild);
        }
    }
});

function GetCmdbuildToken(username, password) {
    $.ajax({
        url: urlToken,
        type: 'POST',
        async: false,
        contentType: 'application/json',
        data: '{"username":"' + username + '", "password":"' + password + '"}',
        success: function(e) {
            token = e.data._id;
            //console.log(e.data._id);			   
        },
        error: function(request, status, error) {
            alert(request.responseText);
        }
    });
}

function GetIdByUsername(arrUser, username) {
    for (var i = 0; i < arrUser.length; i++) {
        var item = arrUser[i];
        if (item.username == username) {
            return item._id;
        }
    }

    return "";
}

function GetUserByUsername(arrUser, username) {
    for (var i = 0; i < arrUser.length; i++) {
        var item = arrUser[i];
        if (item.username == username) {
            return item;
        }
    }

    return "";
}


function GetAllUsers(token) {

    $.ajax({
        url: urlUsers,
        type: 'GET',
        async: false,
        headers: {
            'Cmdbuild-authorization': token
        },
        contentType: 'application/json',
        data: '',
        success: function(data) {
            //console.log(data);
            users = data.data;
            /*users = JSON.parse( '{"success":true,"data":[{"_id":55,"username":"workflow","description":"workflow","email":null,"active":true,"service":true,"_can_write":true},{"_id":27,"username":"admin","description":null,"email":null,"active":true,"service":false,"_can_write":true},{"_id":5141516,"username":"test","description":null,"email":null,"active":false,"service":false,"_can_write":true}],"meta":{"total":3}}');
            users = users.data;*/
        },
        error: function(request, status, error) {
            //alert(error);
        }
    });
}

function GetUserById(userId) {
    $.ajax({
        url: urlUsers + "/" + userId,
        type: 'GET',
        async: false,
        headers: {
            'Cmdbuild-authorization': token
        },
        contentType: 'application/json',
        data: '',
        success: function(data) {
            //console.log(data);
            userData = data.data;
        },
        error: function(request, status, error) {
            alert(error);
        }
    });
}

function UpdateUserCmdbuild(userIdCmdbuild) {
    userData = JSON.stringify(userData);

    $.ajax({
        url: urlUsers + "/" + userIdCmdbuild,
        type: 'PUT',
        async: false,
        headers: {
            'Cmdbuild-authorization': token
        },
        contentType: 'application/json',
        data: userData,
        success: function(e) {
            //alert('Success');
            $("#message").append(e);
        },
        error: function(request, status, error) {
            alert(error);
        }
    });
}

function GetRoles() {
    $.ajax({
        url: urlRole,
        type: 'GET',
        async: false,
        headers: {
            'Cmdbuild-authorization': token
        },
        contentType: 'application/json',
        data: '',
        success: function(data) {
            //console.log(data);
            roles = data.data;
        },
        error: function(request, status, error) {
            console.log(error);
        }
    });
}

function GetRoleByRoleName(arrRoles, roleName) {
    for (var i = 0; i < arrRoles.length; i++) {
        var item = arrRoles[i];
        if (item.name == roleName) {
            return item;
        }
    }

    return "";
}
/*ADD BY AYU*/

function getUnitKerja() {
    var id_skpd = $('#id_skpd').val();
    if (id_skpd != '') {
        $.post("<?= base_url(); ?>master_pegawai/get_unit_kerja_by_skpd/" + id_skpd, {}, function(obj) {
            $('#id_unit_kerja').html(obj);
        });
    }
}

function getJabatan() {
    var id_unit_kerja = $('#id_unit_kerja').val();
    if (id_unit_kerja != '') {
        $.post("<?= base_url(); ?>master_pegawai/get_jabatan_by_unit_kerja/" + id_unit_kerja, {}, function(obj) {
            $('#id_jabatan').html(obj);
        });
    }
}

function setUnitKerja() {
    $('#id_unit_kerja').val(<?= $detail->id_unit_kerja ?>);
}

function setJabatan() {
    $('#id_jabatan').val(<?= $detail->id_jabatan ?>);
}

function searchPegawai() {
    var nip = $('#nip').val();
    $.ajax({
        url: '<?= base_url('master_pegawai/get_pegawai/') ?>/' + nip,
        timeout: false,
        type: 'GET',
        dataType: 'JSON',
        success: function(hasil) {
            $("#nip").removeAttr("disabled", "disabled");
            $("#btnSearch").html('<i class="ti-search"></i>');
            if (hasil.result) {
                $('[name="nama_lengkap"]').val(hasil.nama_lengkap);
                $('[name="pangkat"]').val(hasil.pangkat);
                $('[name="golongan"]').val(hasil.gol);
                $("#id_skpd option").filter(function() {
                    return $(this).text() == hasil.unitkerja.toUpperCase();
                }).attr('selected', true);
                $("#nip").attr("readonly", "readonly");
                $('[name="nama_lengkap"]').attr("readonly", "readonly");
                $('[name="pangkat"]').attr("readonly", "readonly");
                $('[name="golongan"]').attr("readonly", "readonly");
                $("#id_skpd").attr("readonly", "readonly");
            } else {
                $('[name="nama_lengkap"]').val('');
                $('[name="pangkat"]').val('');
                $('[name="golongan"]').val('');
                $('#message').html(hasil.message);
            }
            getUnitKerja();
        },
        error: function(a, b, c) {
            $("#nip").removeAttr("disabled", "disabled");
            $("#btnSearch").html('<i class="ti-search"></i>');
            $('#message').html(c);
        },
        beforeSend: function() {
            $("#nip").attr("disabled", "disabled");
            $("#btnSearch").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        }
    });
}

function getPegawaiSKPD() {
    var id_skpd = $('#id_skpd_atasan').val();
    if (id_skpd != '') {
        $.post("<?= base_url(); ?>master_pegawai/get_pegawai_by_skpd/" + id_skpd, {}, function(obj) {
            $('[name="id_pegawai_atasan_langsung"]').html(obj);
            $('[name="id_pegawai_atasan_langsung"]').select2("destroy").select2();
        });
    }
}
</script>


<script>
let password = document.getElementById("password");
let passwordStrength = document.getElementById("password-strength");
let lowUpperCase = document.querySelector(".low-upper-case i");
let number = document.querySelector(".one-number i");
let specialChar = document.querySelector(".one-special-char i");
let eightChar = document.querySelector(".eight-character i");

password.addEventListener("keyup", function() {
    let pass = document.getElementById("password").value;
    let strength = checkStrength(pass);
    if (strength) {
        $('#btnPassword').removeAttr('disabled');
        $('#btnPassword').removeClass('btn-disabled');
        $('#btnPassword').removeAttr('onclick');
    } else {
        $('#btnPassword').attr('disabled', 'disabled');
        $('#btnPassword').addClass('btn-disabled');
        $('#btnPassword').attr('onclick', 'return alert("Password belum memenuhi kriteria")');
    }
});

function checkStrength(password) {
    let strength = 0;

    let valid = true;

    //If password contains both lower and uppercase characters
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
        strength += 1;
        lowUpperCase.classList.remove('fa-circle');
        lowUpperCase.classList.add('fa-check');
    } else {
        lowUpperCase.classList.add('fa-circle');
        lowUpperCase.classList.remove('fa-check');
        valid = false;
    }
    //If it has numbers and characters
    if (password.match(/([0-9])/)) {
        strength += 1;
        number.classList.remove('fa-circle');
        number.classList.add('fa-check');
    } else {
        number.classList.add('fa-circle');
        number.classList.remove('fa-check');
        valid = false;
    }
    //If it has one special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
        specialChar.classList.remove('fa-circle');
        specialChar.classList.add('fa-check');
    } else {
        specialChar.classList.add('fa-circle');
        specialChar.classList.remove('fa-check');
        valid = false;
    }
    //If password is greater than 7
    if (password.length > 7) {
        strength += 1;
        eightChar.classList.remove('fa-circle');
        eightChar.classList.add('fa-check');
    } else {
        eightChar.classList.add('fa-circle');
        eightChar.classList.remove('fa-check');
        valid = false;
    }

    // If value is less than 2
    if (strength < 2) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.add('progress-bar-danger');
        passwordStrength.style = 'width: 10%';
        valid = false;
    } else if (strength == 3) {
        passwordStrength.classList.remove('progress-bar-success');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-warning');
        passwordStrength.style = 'width: 60%';
        valid = false;
    } else if (strength == 4) {
        passwordStrength.classList.remove('progress-bar-warning');
        passwordStrength.classList.remove('progress-bar-danger');
        passwordStrength.classList.add('progress-bar-success');
        passwordStrength.style = 'width: 100%';
    }
    return valid;
}
</script>