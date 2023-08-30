<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Urusan</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
        <li class="active">Urusan RPJMD</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">

    <div class="row">
      <div class="col-md-12">
        <div class="white-box">
          <div class="row">
            <div class="col-md-3 b-r">

              <button type="button" onclick="new_data();" class="btn btn-primary btn-block e m-t-20" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Urusan </button>

            </div>
            <form method="POST">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Urusan</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Sasaran RPJMD" name="sasaran_rpjmd" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">

                  <br>
                  <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                </div>
              </div>

            </form>
          </div>

        </div>
      </div>

    </div>


    <div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="data-title">Tambah Urusan</h4>
          </div>
          <div class="modal-body">
            <form id="data-form" action="#!">




              <div class="form-group">
                <label for="data-id_tujuan" class="control-label">Urusan Atas</label>
                <select class="form-control" required="">
                  <option value="">- tidak ada --</option>
                  
                  <option value="">Urusan 1</option>
                  <option value="">Urusan 2</option>
                </select>
              </div>

              <div class="form-group">
                <label for="data-sasaran-rpjmd" class="control-label"> Kode </label>
                <input type="text" class="form-control"> 
              </div>

              <div class="form-group">
                <label for="data-sasaran-rpjmd" class="control-label"> Nama Urusan </label>
                <textarea id="data-sasaran-rpjmd" class="form-control" name="nama_urusan" required=""></textarea>
              </div>


              <button type="submit" id="data-form-submit" hidden=""></button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="data-button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
        <!-- /#data-content -->
      </div>
      <!-- /#data-dialog -->
    </div>



    <div class="col-md-12">



      <div class="white-box">


        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kode.</th>
              <th>Nama Urusan</th>
              <th>Opsi</th>

            </tr>
          </thead>
          <tbody>

          <?php 
          $no=1;
          foreach($list as $l)

            { ?>
          <tr>
              <td><?=$no;?></td>
              <td><?=$l->kode_urusan;?></td>
              <td><?=$l->nama_urusan;?></td>
              <td>
                <a href="javascript:void(0)" onclick="editIndikator(2)" class="btn btn-info btn-circle"><i class="ti-pencil"></i></a>
                <a href="javascript:void(0)" onclick="hapusIndikator(2)" class="btn btn-danger btn-circle"><i class="ti-trash"></i></a>
              </td>
            </tr>
            <?php 
              $no++;
            } ?>

           


          </tbody>

        </table>


      </div>


    </div>
    <!-- .row -->



  </div>

  <script type="text/javascript">
    function block_ui(element) {
      $(element).block({
        message: '<h4><img src="https://e-office.sumedangkab.go.id/asset/pixel/plugins/images/busy.gif" /> We are processing your request.</h4>',
        css: {
          border: '1px solid #fff'
        }
      });
    }

    function new_data() {
      $("#data-modal").modal();
      $("#data-title").text("Tambah Data");
      // $("#data-sub-title").text("");
      $("#data-form")[0].reset();
      $("#data-button").text("Simpan Data");
      $("#data-button").attr("onclick", "add_data();");
      get_tujuan('1');

      // var kode = "SS-.";
      // $.ajax({
      //   url:"https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_kode",
      //   type:"POST",
      //   data: "kode="+kode,
      //   dataType: "text",

      //   success:function(resp){
      //     $("#data-kode_sasaran_rpjmd").val(resp);
      //   },
      //   error:function(event, textStatus, errorThrown) {
      //     alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
      //     $("#data-modal").unblock();
      //   }
      // })
    }

    function get_tujuan(id_misi = null) {
      if (id_misi == null) {
        var id_misi = $("#data-id_misi").val();
      }
      $("#data-id_tujuan").attr("readonly", true);
      $.ajax({
        url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_tujuan_by_misi",
        type: "GET",
        data: "id_misi=" + id_misi,
        dataType: "text",

        success: function(resp) {
          $("#data-id_tujuan").attr("readonly", false);
          $("#data-id_tujuan").html(resp);
        },
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#data-modal").unblock();
          $("#data-id_tujuan").html("");
          $("#data-id_tujuan").attr("readonly", true);
        }
      })
    }

    function add_data() {
      block_ui("#data-modal");

      $.ajax({
        url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/add_data",
        type: "POST",
        data: $('#data-form').serialize(),

        success: function(resp) {
          if (resp == true) {
            swal("Success!", "Data baru telah ditambahkan.", "success");
            window.location.reload(false);
          } else if (resp == false) {
            $("#data-id_tujuan").attr("readonly", false);
            $("#data-modal").unblock();
            $("#data-form-submit").click();
          } else {
            alert('Error Message: ' + resp);
          }
        },
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#data-modal").unblock();
        }
      })
    }

    function edit_data(id) {
      block_ui("#main-content");
      block_ui("#data-modal");

      $.ajax({
        url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_data/" + id,
        type: "GET",
        dataType: "json",
        cache: false,

        success: function(resp) {
          $("#main-content").unblock();
          $("#data-modal").unblock();

          if (resp == false) {
            $("#data-title").text("Data tidak ditemukan!");
            $("#data-button").attr("onclick", "");
          } else {
            $("#data-form")[0].reset();
            $("#data-title").text("Ubah Data");
            $("#data-button").text("Simpan Data");
            $("#data-button").attr("onclick", "save_data(" + id + ");");
            $("#data-id_misi").val(resp.id_misi);
            $.post("https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_tujuan_by_misi/" + $("#data-id_misi").val(), {}, function(obj) {
              $('#data-id_tujuan').html(obj);
              $("#data-id_tujuan").val(resp.id_tujuan);
            });
            if (resp.sasaran_rpjmd) {
              $("#data-sasaran-rpjmd").text(resp.sasaran_rpjmd);
            }
          }
          $("#data-modal").modal();
        },
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#main-content").unblock();
          $("#data-modal").unblock();
        }
      })
    }

    function save_data(id) {
      block_ui("#data-modal");

      $.ajax({
        url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/update_data/" + id,
        type: "POST",
        data: $('#data-form').serialize(),

        success: function(resp) {
          if (resp == true) {
            swal("Success!", "Data telah berhasil diubah.", "success");
            window.location.reload(false);
          } else if (resp == "not found") {
            $("#data-modal").unblock();
            swal("Sorry", "Data tidak ditemukan!", "error");
          } else if (resp == false) {
            $("#data-modal").unblock();
            $("#data-form-submit").click();
          } else {
            alert('Error Message: ' + resp);
          }
        },
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#data-modal").unblock();
        }
      })
    }

    function delete_data(id) {
      block_ui("#main-content");

      $.ajax({
        url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/get_data/" + id,
        type: "GET",
        dataType: "json",
        cache: false,

        success: function(resp) {
          $("#main-content").unblock();
          if (resp == false) {
            swal("Sorry", "Data tidak ditemukan!");
          } else {
            swal({
              title: "Apakah anda yakin?",
              text: "Data yang telah dihapus tidak dapat dikembalikan!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya, hapus!",
              closeOnConfirm: false
            }, function() {
              $.ajax({
                url: "https://e-office.sumedangkab.go.id/sasaran_rpjmd/delete_data/" + resp.id_sasaran_rpjmd,
                type: "GET",
                dataType: "json",
                cache: false,

                success: function(ret) {
                  if (ret == true) {
                    swal("Deleted!", "Data telah berhasil dihapus.", "success");
                    window.location.reload(false);
                  } else if (ret == "not found") {
                    swal("Sorry", "Data tidak ditemukan!", "error");
                  } else {
                    alert('Error Message: ' + ret);
                  }
                },
                error: function(event, textStatus, errorThrown) {
                  alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
                }
              })
            });
          }
        },
        error: function(event, textStatus, errorThrown) {
          alert('Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown);
          $("#main-content").unblock();
        }
      })
    }
  </script>
</div>