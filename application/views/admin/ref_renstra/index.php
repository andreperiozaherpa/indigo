 <div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Rencana Strategis</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">Starter Page</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">
    <div class="col-md-4">


      <div class="white-box">
        <center><img style="width: 80%" src="<?php echo base_url()."data/logo/bnpt.png" ;?>" alt="user" class="img-circle"/>   </center>         
        <div class="user-btm-box">
          <!-- .row -->
          <hr>
          <div class="row text-center m-t-10">

            <div class="col-md-12 "><strong>Badan Penanggunalangan Terorisme</strong>

            </div>

          </div>
          <!-- /.row -->
          <!-- /.row -->

          <!-- .row -->

          <div class="row text-center m-t-10">

          </div>



        </div>

      </div>


    </div>

    


    <div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="data-title">Tambah Rencana Kerja</h4>
          </div>
          <div class="modal-body">
            <form id="data-form" action="#!">

             <div class="form-group">
              <label for="data-id_tahun" class="control-label">Tahun</label>
              <select id="data-id_tahun" class="form-control" name="id_tahun" required>
               <option value="1">2014-2019</option>
               <option value="2">2019-2024</option>
             </select>
           </div>

           <div class="form-group">
            <label for="data-id_misi" class="control-label">Misi</label>
            <select id="data-id_misi" class="form-control" name="id_misi" required>
              <?php foreach ($misi as $key => $value): ?>
                <option value="<?=$value->id_misi?>"><?=$value->misi?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="data-renstra" class="control-label">Rencana Strategis</label>
            <textarea id="data-renstra" class="form-control" name="renstra" required></textarea>
          </div>


          
          <button type="submit" id="data-form-submit" hidden></button>
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



<div class="col-md-8">



  <div class="row">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="white-box">

      <table class="table color-table dark-table table-hover">

        <thead>
          <tr>
            <th>#</th>
            <th>Tahun</th>
            <th>Misi</th>
            <th>Rencana Strategis </th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($result as $key => $value): ?>
          <tr>
            <td><?=$no?></td>
            <td>2019-2024</td>
            <td><?=$value->misi?></td>
            <td><?=$value->renstra?></td>
            <td style="width:150px">
              <a href="#!" onclick="edit_data('<?=$value->id_renstra;?>');" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> edit</a> <a href="#!" onclick="delete_data('<?=$value->id_renstra;?>');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
            </td>
          </tr>
          <?php $no++; endforeach ?>
          

          
        </tbody>



      </table>

      <button type="button" onclick="new_data();" class="btn btn-danger e" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Renstra</button>

    </div>
  </div>

</div>    


</div>
<!-- .row -->

</div>

<script type="text/javascript">
  function block_ui(element) {
    $(element).block({
      message: '<h4><img src="<?=base_url('asset/pixel');?>/plugins/images/busy.gif" /> We are processing your request.</h4>',
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
  }

  function add_data() {
    block_ui("#data-modal");

    $.ajax({
      url:"<?php echo base_url('ref_renstra/add_data');?>",
      type:"POST",
      data: $('#data-form').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false); 
        } else if (resp == false) {
          $("#data-modal").unblock();
          $("#data-form-submit").click();
        } else {
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#data-modal").unblock();
      }
    })
  }

  function edit_data(id) {
    block_ui("#main-content");
    block_ui("#data-modal");

    $.ajax({
      url:"<?php echo base_url('ref_renstra/get_data');?>/"+id,
      type:"GET",
      dataType: "json",
      cache: false,

      success:function(resp){
        $("#main-content").unblock();
        $("#data-modal").unblock();

        if (resp == false) {
          $("#data-title").text("Data tidak ditemukan!");
          $("#data-button").attr("onclick", "");
        } else {
          new_data();
          $("#data-title").text("Ubah Data");
          $("#data-button").text("Simpan Data");
          $("#data-button").attr("onclick", "save_data("+id+");");

          if (resp[0].id_tahun) { $("#data-id_tahun").val(resp[0].id_tahun); }
          if (resp[0].id_misi) { $("#data-id_misi").val(resp[0].id_misi); }
          if (resp[0].renstra) { $("#data-renstra").val(resp[0].renstra); }
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#main-content").unblock();
        $("#data-modal").unblock();
      }
    })
  }

  function save_data(id) {
    block_ui("#data-modal");

    $.ajax({
      url:"<?php echo base_url('ref_renstra/update_data');?>/"+id,
      type:"POST",
      data: $('#data-form').serialize(),

      success:function(resp){
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
          alert('Error Message: '+ resp);
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#data-modal").unblock();
      }
    })
  }

  function delete_data(id) {
    block_ui("#main-content");

    $.ajax({
      url:"<?php echo base_url('ref_renstra/get_data');?>/"+id,
      type:"GET",
      dataType: "json",
      cache: false,

      success:function(resp){
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
          }, function(){   
            $.ajax({
              url:"<?php echo base_url('ref_renstra/delete_data');?>/"+resp[0].id_renstra,
              type:"GET",
              dataType: "json",
              cache: false,

              success:function(ret){
                if (ret == true) {
                  swal("Deleted!", "Data telah berhasil dihapus.", "success");
                  window.location.reload(false);  
                } else if (ret == "not found") {
                  swal("Sorry", "Data tidak ditemukan!", "error");
                } else {
                  alert('Error Message: '+ ret);
                }
              },
              error:function(event, textStatus, errorThrown) {
                alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
              }
            })
          });
        }
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#main-content").unblock();
      }
    })
  }
</script>