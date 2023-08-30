
<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li class="active">Sasaran RPJMD</li>
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

             <button type="button" onclick="new_data();" class="btn btn-primary btn-block e m-t-20"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Sasaran </button>

           </div>
           <form method="POST">
            <?php if($user_level=='Administrator'){ ?>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Sasaran</label>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Sasaran RPJMD" name="sasaran_rpjmd" value="<?=($filter) ? $filter_data['sasaran_rpjmd'] : ''?>">
                </div>
              </div>
            <?php } ?>
            <div class="col-md-3">
              <div class="form-group">

                <br>
                <button type="submit" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>Filter</button>
                    <?php 
                      if($filter){
                        ?>
                        <a href="" class="btn btn-default m-t-5"><i class="ti-back-left"></i> Reset</a>
                        <?php
                      }
                    ?>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="data-title">Tambah Sasaran Strategis</h4>
        </div>
        <div class="modal-body">
          <form id="data-form" action="#!">



           <div class="form-group">
            <label for="data-id_misi" class="control-label">Misi</label>
            <select id="data-id_misi" class="form-control" onchange="get_tujuan()" required>
              <option value="">Pilih Misi</option>
              <?php foreach ($misi as $key): ?>
                <option value="<?=$key->id_misi?>"><?=$key->misi?></option>
              <?php endforeach ?>

            </select>
          </div>

          <div class="form-group">
            <label for="data-id_tujuan" class="control-label">Tujuan</label>
            <select id="data-id_tujuan" name="id_tujuan" class="form-control" required>
              <option value="">Pilih Tujuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="data-sasaran-rpjmd" class="control-label"> Nama Sasaran </label>
            <textarea id="data-sasaran-rpjmd" class="form-control" name="sasaran_rpjmd" required></textarea>
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



<div class="col-md-12">



  <div class="row">

    <?php foreach($list as $l){
      $j_program = count($this->sasaran_rpjmd_model->get_program_by_id_s($l->id_sasaran_rpjmd));
      $j_indikator = count($this->sasaran_rpjmd_model->get_indikator_by_id_s($l->id_sasaran_rpjmd));
      ?>

      <div class="col-md-4 col-sm-6" style="min-height: 350px">
        <div style="background-color: #4e2a84;padding:10px">
          <div class="pull-left">
            <div class="btn-group m-r-10">
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-outline dropdown-toggle btn-circle " type="button"><i class="icon-options-vertical"></i></button>
              <ul role="menu" class="dropdown-menu animated flipInX">
                <li><a  href="javascript:void(0)" onclick="edit_data(<?=$l->id_sasaran_rpjmd?>)" >Edit</a></li>
                <li><a  href="javascript:void(0)" onclick="delete_data(<?=$l->id_sasaran_rpjmd?>)">Hapus</a></li>
                <!-- <li><a href="#">Detail</a></li> -->
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <center>
               <img style="width:60%;margin-top:-20px;" src="<?=base_url()."data/images/ss.png";?>" alt="user" class="img-responsive">
             </center>
           </div>
         </div>
       </div>
       <a href="<?php echo base_url();?>sasaran_rpjmd/detail/<?=$l->id_sasaran_rpjmd?>">
         <div class="white-box">
          
         
          <div class="row">
            <div class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">Nama SS</h3>
              <small><?=$l->sasaran_rpjmd?></small>
            </div>
          </div>

          <hr>
          <div class="row">
            <div class="col-md-6 text-center b-r">
              <h3 class="box-title m-b-0">Jumlah Program</h3>
             <?=$j_program?> 
            </div>

            <div class="col-md-6 text-center ">
              <h3 class="box-title m-b-0">Jumlah IKU</h3>
              <?=$j_indikator?>
            </div>
          </div>



        </div>
      </a>
    </div>

  <?php } ?>

</div>    


</div>
<!-- .row -->


          <div class="row">
            <div class="col-md-12 pager">
              <?php 
              if(!$filter){
                echo make_pagination($pages,$current);
              }
              ?>
            </div>
          </div>
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
    get_tujuan('<?=$misi[0]->id_misi?>');

    // var kode = "SS-<?=$this->session->userdata('kode_unit_kerja')?>.";
    // $.ajax({
    //   url:"<?php echo base_url('sasaran_rpjmd/get_kode');?>",
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

  function get_tujuan(id_misi=null) {
    if (id_misi == null) {
      var id_misi = $("#data-id_misi").val();
    }
    $("#data-id_tujuan").attr("readonly",true);
    $.ajax({
      url:"<?php echo base_url('sasaran_rpjmd/get_tujuan_by_misi');?>",
      type:"GET",
      data: "id_misi="+id_misi,
      dataType: "text",

      success:function(resp){
        $("#data-id_tujuan").attr("readonly",false);
        $("#data-id_tujuan").html(resp);
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#data-modal").unblock();
        $("#data-id_tujuan").html("");
        $("#data-id_tujuan").attr("readonly",true);
      }
    })
  }

  function add_data() {
    block_ui("#data-modal");

    $.ajax({
      url:"<?php echo base_url('sasaran_rpjmd/add_data');?>",
      type:"POST",
      data: $('#data-form').serialize(),

      success:function(resp){
        if (resp == true) {
          swal("Success!", "Data baru telah ditambahkan.", "success");
          window.location.reload(false); 
        } else if (resp == false) {
          $("#data-id_tujuan").attr("readonly",false);
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
      url:"<?php echo base_url('sasaran_rpjmd/get_data');?>/"+id,
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
          $("#data-form")[0].reset();
          $("#data-title").text("Ubah Data");
          $("#data-button").text("Simpan Data");
          $("#data-button").attr("onclick", "save_data("+id+");");
          $("#data-id_misi").val(resp.id_misi); 
          $.post("<?= base_url();?>sasaran_rpjmd/get_tujuan_by_misi/"+$("#data-id_misi").val(),{},function(obj){
            $('#data-id_tujuan').html(obj);
             $("#data-id_tujuan").val(resp.id_tujuan);
          });
          if (resp.sasaran_rpjmd) { $("#data-sasaran-rpjmd").text(resp.sasaran_rpjmd); }
        }
          $("#data-modal").modal();
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
      url:"<?php echo base_url('sasaran_rpjmd/update_data');?>/"+id,
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
      url:"<?php echo base_url('sasaran_rpjmd/get_data');?>/"+id,
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
              url:"<?php echo base_url('sasaran_rpjmd/delete_data');?>/"+resp.id_sasaran_rpjmd,
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