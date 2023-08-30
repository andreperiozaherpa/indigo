<?php
if (isset($u)) {
  foreach ($u as $k => $v) {
    $$k = $v;
    $info[$k] = $v;
  }
}
?>

<input type="hidden" value="<?= $tokenCmdbuild; ?>" id="tokenCmdbuild"
  class="form-control form-control-line"><!--ADD BY AYU-->

<div class="container-fluid">

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
    <div class="col-md-12">
      <a href="<?= base_url('master_pegawai') ?>" style="margin-bottom: 10px;"
        class="btn btn-primary btn-outline pull-right"><i class="ti-back-left"></i> Kembali</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <?php
      $tipe = (empty($error)) ? "info" : "danger";
      if (!empty($message)) {
        ?>
        <div class="alert alert-<?= $tipe; ?> alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <?= $message; ?>
        </div>
      <?php } ?>
      <div class="x_panel">
        <div class="x_content">
          <div class="alert alert-danger alert-dismissible fade in" role="alert" id='pesan' style='display:none'>
            <button type="button" onclick='hideMe()' class="close" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <label id='status'></label>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">Foto Pegawai</div>
              <div class="panel-body">
                <div class="row">
                  <center>
                    <img style="width: 300px;height: 300px;object-fit: cover;" class="img-circle img-responsive"
                      src="<?= base_url('data/foto/pegawai/' . $detail->foto_pegawai . '') ?>">
                  </center>
                  <div class="m-t-15">
                    <a href="<?= base_url('master_pegawai/edit/' . $detail->id_pegawai . '') ?>"
                      class="btn btn-primary btn-outline btn-block"><i class="ti-pencil"></i> Edit Pegawai</a>
                    <?php
                    if ($cek_user) {

                      if ((!empty($u->api_key)) || (!empty($u->app_token))) {
                        ?>
                        <a href="javascript:void(0)" onclick="resToken(<?= $detail->id_pegawai ?>)"
                          class="btn btn-warning btn-outline btn-block"><i class="fa fa-refresh"></i> Reset Token</a>
                        <?php
                      }
                      ?>

                      <a href="javascript:void(0)" onclick="resPassword(<?= $detail->id_user ?>)"
                        class="btn btn-danger btn-outline btn-block"><i class="ti-reload"></i> Reset Password</a>
                      <a href="javascript:void(0)" onclick="delAccount(<?= $detail->id_pegawai ?>)"
                        class="btn btn-danger btn-outline btn-block"><i class="ti-close"></i> Hapus Akun</a>
                      <?php
                    } else { ?>

                      <a href="javascript:void(0)" onclick="regAccount()" class="btn btn-success btn-outline btn-block"><i
                          class="ti-user"></i> Register Akun</a>
                      <?php

                    }
                    ?>

                    <?php
                    if ($detail->pensiun == 1) {
                      ?>
                      <a href="javascript:void(0)" onclick="batalPensiunkanPegawai()"
                        class="btn btn-danger btn-outline btn-block"><i class="ti-close"></i> Batalkan Pensiunkan
                        Pegawai</a>
                      <?php
                    } else {
                      ?>
                      <a href="javascript:void(0)" onclick="pensiunkanPegawai()"
                        class="btn btn-success btn-outline btn-block"><i class="ti-user"></i> Pensiunkan Pegawai</a>
                      <?php
                    }
                    ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#hapusPegawai"
                      class="btn btn-danger btn-outline btn-block"><i class="ti-trash"></i> Hapus Pegawai</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="panel panel-default">
              <div class="panel-heading">
                Informasi Pegawai
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Lengkap</label>
                      <p>
                        <?= $detail->nama_lengkap ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>NIP</label>
                      <p>
                        <?= $detail->nip ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>SKPD</label>
                      <p>
                        <?= $skpd->nama_skpd ?>
                      </p>
                    </div>
                  </div>
                  <?php if ($detail->id_unit_kerja > 0): ?>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Unit Kerja</label>
                        <p>
                          <?= $unit_kerja->nama_unit_kerja ?>
                        </p>
                      </div>
                    </div>
                  <?php endif ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Jabatan</label>
                      <p>
                        <?= $detail->jabatan ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <?php if (isset($user_id)): ?>
                <?php $CI = &get_instance();
                $CI->load->view('admin/user/contact', $info) ?>
              <?php endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="hapusPegawai" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
  aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Pegawai</h4>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus Pegawai ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
        <a style="color: #fff !important" href="<?= base_url('master_pegawai/delete/' . $detail->id_pegawai . '') ?>"
          class="btn btn-primary waves-effect text-left">Ya</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div id="regAccount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel1">Ubah Misi</h4>
      </div>
      <div class="modal-body">
        <form id="formAccount">
          <div id="hidden">
            <input type="hidden" name="id_pegawai" value="<?= $detail->id_pegawai ?>">
          </div>
          <div id="message"></div>
          <div class="form-group">
            <label for="message-text" class="control-label">Username</label>
            <input type="text" value="<?= $detail->nip ?>" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Password</label>
            <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Konfirmasi Password</label>
            <input type="password" class="form-control" placeholder="Masukkan Konfirmasi Password" name="c_password">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="registerA()" id="btnSave" class="btn btn-primary">Register</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  var save_method;

  /*ADD BY AYU*/
  var urlToken = '<?= $this->config->item("urlToken"); ?>';
  var urlUsers = '<?= $this->config->item("urlUsers"); ?>';
  var urlRole = '<?= $this->config->item("urlRole"); ?>';
  var urlTenant = '<?= $this->config->item("urlTenant"); ?>';

  var token = "";

  var users = [];
  var userData = {};
  var roles = [];
  var tenants = [];

  $(document).ready(function () {
    token = $("input#tokenCmdbuild").val();

    if (token == "") {
      //get cmdbuild token
      GetCmdbuildToken('<?= $this->config->item("adminCmdbuild"); ?>', '<?= $this->config->item("passwordCmdbuild"); ?>');
    }

    if (token != "") {
      //get all users
      GetAllUsers(token);

      //get all tenants
      GetAllTenants(token);

      //get all roles
      GetRoles();
    }
  });

  function GetCmdbuildToken(username, password) {
    $.ajax({
      url: urlToken,
      type: 'POST',
      async: false,
      contentType: 'application/json',
      data: '{"username":"' + username + '", "password":"' + password + '"}',
      success: function (e) {
        token = e.data._id;
        console.log(e.data._id);
      },
      error: function (request, status, error) {
        alert(request.responseText);
      }
    });
  }

  function GetTenantByDesc(arrTenant, tenantName) {
    for (var i = 0; i < arrTenant.length; i++) {
      var item = arrTenant[i];
      if (item.Description == tenantName) {
        return item._id;
      }
    }

    return "";
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
      success: function (data) {
        //console.log(data);
        users = data.data;
        /*users = JSON.parse( '{"success":true,"data":[{"_id":55,"username":"workflow","description":"workflow","email":null,"active":true,"service":true,"_can_write":true},{"_id":27,"username":"admin","description":null,"email":null,"active":true,"service":false,"_can_write":true},{"_id":5141516,"username":"test","description":null,"email":null,"active":false,"service":false,"_can_write":true}],"meta":{"total":3}}');*/
        //users = users.data;
      },
      error: function (request, status, error) {
        alert(error);
      }
    });
  }

  function GetAllTenants(token) {

    $.ajax({
      url: urlTenant,
      type: 'GET',
      async: false,
      headers: {
        'Cmdbuild-authorization': token
      },
      contentType: 'application/json',
      data: '',
      success: function (data) {
        console.log(data);
        tenants = data.data;
      },
      error: function (request, status, error) {
        alert(error);
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
      success: function (data) {
        //console.log(data);
        userData = data.data;
      },
      error: function (request, status, error) {
        alert(error);
      }
    });
  }

  function UpdateUserCmdbuild(userIdCmdbuild) {
    //var data = '{"groupsLength":0,"initialPage":"","multiTenantActivationPrivileges":"any","userTenants":[],"userGroups":[],"active":true,"multiGroup":false,"defaultUserGroup":"","service":false,"email":"test@gmail.com","description":"test desc","username":"test"}'

    /*var data = '{"groupsLength":0,"password":"test123","confirmPassword":"test123","language":"","initialPage":"","multiTenantActivationPrivileges":"any","userTenants":[],"userGroups":[{"_id":29,"name":"SuperUser","description":"SuperUser","_description_translation":"SuperUser"}],"active":true,"multiGroup":false,"defaultUserGroup":"","service":false,"email":"","description":"","username":"test"}';
    
    data = '{"_id":5141516,"username":"test","description":null,"email":null,"active":false,"service":false,"_can_write":true,"userTenants":[],"defaultUserTenant":null,"userGroups":[{"_id":29,"name":"SuperUser","description":"SuperUser","_description_translation":"SuperUser"}],"defaultUserGroup":null,"_defaultUserGroup_description":null,"language":"","initialPage":null,"multiGroup":false,"multiTenantActivationPrivileges":"any","changePasswordRequired":false}';		
    
    data = JSON.parse(data);			
    
    data.password = "test123";
    data.confirmPassword = "test123";*/
    //console.log("data");
    //console.log(data);

    //userData.password = "test123";
    //userData.confirmPassword = "test123";		

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
      success: function (e) {
        //alert('Success');
        $("#message").append(e);
      },
      error: function (request, status, error) {
        $("#message").append(error);
        //alert(error);
      }
    });
  }

  function CreateUserCmdbuild(dataUser) {
    $.ajax({
      url: urlUsers,
      type: 'POST',
      async: false,
      headers: {
        'Cmdbuild-authorization': token
      },
      contentType: 'application/json',
      data: dataUser,
      success: function (e) {
        return true;
      },
      error: function (request, status, error) {
        alert(error);
        return false;
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
      success: function (data) {
        //console.log(data);
        roles = data.data;
      },
      error: function (request, status, error) {
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


  /*DEV BY AYU*/

</script>
<script type="text/javascript">
  function regAccount() {
    save_method = 'add';
    $('#formAccount')[0].reset();
    $('#regAccount').modal('show');
    $('.modal-title').text('Register Akun');
  }

  function registerA() {
    $('#btnSave').text('Menyimpan...');
    $('#message').html('');
    $('#btnSave').attr('disabled', true);
    var url;
    var formData = new FormData($('#formAccount')[0]);
    url = "<?= base_url('master_pegawai/reg_account') ?>";

    //console.log($('#formAccount').serializeArray());
    var arrForm = $('#formAccount').serializeArray();
    //var userRole = GetRoleByRoleName(roles,"SuperUser");
    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function (data) {

        if (data.status) {
              $('#regAccount').modal('hide');
              swal("Berhasil", "Berhasil didaftarkan!", "success");

              location.reload();
        } else {
          $('#message').html('<div class="alert alert-danger">' + data.message + '</div>');
        }
        $('#btnSave').text('Register');
        $('#btnSave').attr('disabled', false);

      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSave').text('Register');
        $('#btnSave').attr('disabled', false);

      }
    });


  }

  function delAccount(id) {
    swal({
      title: "Hapus Akun",
      text: "Apakah anda yakin akan menghapus akun ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "<?= base_url('master_pegawai/del_account') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
              $('#modalMisi').modal('hide');
              swal("Berhasil", "Akun Berhasil Dihapus!", "success");
              location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });
  }

  function resToken(id) {
    swal({
      title: "Reset Token",
      text: "Apakah anda yakin akan mereset token akun ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "<?= base_url('master_pegawai/reset_token') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
              $('#modalMisi').modal('hide');
              swal("Berhasil", "Token berhasil direset!", "success");
              location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });
  }




  function resPassword(id) {
    swal({
      title: "Reset Password",
      text: "Apakah anda yakin akan mereset password akun ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "<?= base_url('master_pegawai/reset_password') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {

              $('#modalMisi').modal('hide');
              swal("Berhasil", "Password berhasil direset!", "success");
              location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });
  }

  function pensiunkanPegawai() {
    swal({
      title: "Konfirmasi",
      text: "Apakah anda yakin akan mempensiunkan Pegawai ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "<?= base_url('master_pegawai/pensiunkan/' . $detail->id_pegawai) ?>/1",
            type: "POST",
            dataType: "JSON",
            success: function (data) {
              swal("Berhasil", "Pegawai sudah dipensiunkan!", "success");
              window.location.reload(false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });
  }


  function batalPensiunkanPegawai() {
    swal({
      title: "Konfirmasi",
      text: "Apakah anda yakin akan membatalkan pensiun Pegawai ini?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Ya',
      cancelButtonText: "Tidak",
      closeOnConfirm: false
    },
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: "<?= base_url('master_pegawai/pensiunkan/' . $detail->id_pegawai) ?>/0",
            type: "POST",
            dataType: "JSON",
            success: function (data) {
              swal("Berhasil", "Pensiun pegawai sudah dibatalkan", "success");
              window.location.reload(false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert('Error deleting data');
            }
          });
        }
      });
  }
</script>