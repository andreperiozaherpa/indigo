
 <div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Sasaran Strategis</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li class="active">Sasaran Strategis</li>
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
         
             <button type="button" onclick="new_data();" class="btn btn-primary btn-block e m-t-20"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Sasaran Strategis</button>
       
        </div>
        <form method="POST">
          <?php if($user_level=='Administrator'){ ?>

          <div class="col-md-3">
            <div class="form-group">
              <label>Nama Sasaran</label>
              <input type="text" class="form-control" placeholder="Nama Sasaran" name='nama_ss'>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="exampleInputEmail1">SKPD</label>
              <select name="id_unit_kerja" class="form-control select2">
                <option value="">Pilih SKPD</option>
                <?php 
                foreach($unit_kerja as $uk){
                  echo'<option value="'.$uk->id_unit_kerja.'">'.$uk->nama_unit_kerja.'</option>';
                }
                ?>
              </select>     
            </div>
          </div>
          <?php } ?>
          <div class="col-md-3">
            <div class="form-group">

              <br>
              <button type="submit" class="btn btn-primary m-t-5 btn-outline">Filter</button>
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


<?php 
  if($this->session->level_unit_kerja==0){
?>
             <div class="form-group">
              <label for="data-id_misi" class="control-label">Misi</label>
              <select id="data-id_misi" class="form-control" name="id_misi" required>
                <?php foreach ($misi as $value): ?>
                  <option value="<?=$value->id_misi?>"><?=$value->misi?></option>
                <?php endforeach ?>
              </select>
            </div>
<?php } ?>
<?php 
  if($this->session->level_unit_kerja==1){
?>
   <div class="form-group">
              <label for="data-id_ss_induk" class="control-label">Sasaran Strategis Induk</label>
            <select id="data-id_ss_induk" name="id_ss_induk" class="form-control">
              <option value="">Pilih</option>
              <?php 
              foreach($sasaran_strategis as $r){
                echo'<option value="'.$r->id_sasaran_strategis.'">'.$r->kode_sasaran_strategis.' - '.$r->sasaran_strategis.'</option>';
              }
              ?>
            </select>
            </div>
            <?php } ?>

            <div class="form-group">
              <label for="data-kode_sasaran_strategis" class="control-label">Kode</label>
              <input id="data-kode_sasaran_strategis" type="text" class="form-control" name="kode_sasaran_strategis" value="SS-<?=$this->session->userdata('kode_unit_kerja')?>." readonly required>
            </div>

            <div class="form-group">
              <label for="data-sasaran_strategis" class="control-label">Sasaran Strategis</label>
              <textarea id="data-sasaran_strategis" class="form-control" name="sasaran_strategis" required></textarea>
            </div><?php
  if($user_level=='Administrator'){
    ?>

        <div class="row">
         <div class="form-group">
           <div class="col-md-12">
            <label class="control-label">Unit Kerja </label>
            <select name="id_unit" class="form-control">
              <option value="">Pilih Unit Kerja</option>
              <?php 
              foreach($unit_kerja as $r){
                    echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    <?php
  }else{
    ?>
            <input type="hidden" name="id_unit" value="<?=$this->session->userdata('unit_kerja_id')?>">
    <?php
  }
?>

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

<?php $no=1; foreach ($result as $key => $value): ?>
<div class="col-md-4 col-sm-6">
        <div style="background-color: #4e2a84;padding:10px">
          <div class="pull-left">
            <div class="btn-group m-r-10">
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-outline dropdown-toggle btn-circle " type="button"><i class="icon-options-vertical"></i></button>
              <ul role="menu" class="dropdown-menu animated flipInX">
                <li><a  href="#!" onclick="edit_data('<?=$value->id_sasaran_strategis;?>');" >Edit</a></li>
                <li><a href="#!" onclick="delete_data('<?=$value->id_sasaran_strategis;?>');"  >Hapus</a></li>
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
         <a href="<?=base_url('sasaran_strategis/detail/'.$value->id_sasaran_strategis.'')?>">
         <div class="white-box">
          <div class="row">
            <div class="col-md-6 text-center b-r">
              <h3 class="box-title m-b-0">Kode SS</h3>
              <?=$value->kode_sasaran_strategis?>
             </div>

             <div class="col-md-6 text-center ">
              <h3 class="box-title m-b-0">Jumlah IKU</h3>
              8 IKU
             </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">Nama SS</h3>
              <small><?=$value->sasaran_strategis?></small>
            </div>
          </div>

           <hr>
          <div class="row">
            <div class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">SKPD</h3>
              <small><?=$value->nama_unit_kerja?></small>
            </div>
          </div>

           <hr>
          <div class="row">
            <div class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">Unit Kerja</h3>
              <small><?=$value->nama_unit_kerja?></small>
            </div>
          </div>


        </div>
      </a>
      </div>
 <?php $no++; endforeach ?>


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

    var kode = "SS-<?=$this->session->userdata('kode_unit_kerja')?>.";
    $.ajax({
      url:"<?php echo base_url('sasaran_strategis/get_kode');?>",
      type:"POST",
      data: "kode="+kode,
      dataType: "text",

      success:function(resp){
        $("#data-kode_sasaran_strategis").val(resp);
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#data-modal").unblock();
      }
    })
  }

  function add_data() {
    block_ui("#data-modal");

    $.ajax({
      url:"<?php echo base_url('sasaran_strategis/add_data');?>",
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
      url:"<?php echo base_url('sasaran_strategis/get_data');?>/"+id,
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
          $("#data-modal").modal();
          $("#data-form")[0].reset();
          $("#data-title").text("Ubah Data");
          $("#data-button").text("Simpan Data");
          $("#data-button").attr("onclick", "save_data("+id+");");

          if (resp[0].id_misi) { $("#data-id_misi").val(resp[0].id_misi); }
          if (resp[0].kode_sasaran_strategis) { $("#data-kode_sasaran_strategis").val(resp[0].kode_sasaran_strategis); }
          if (resp[0].sasaran_strategis) { $("#data-sasaran_strategis").val(resp[0].sasaran_strategis); }
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
      url:"<?php echo base_url('sasaran_strategis/update_data');?>/"+id,
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
      url:"<?php echo base_url('sasaran_strategis/get_data');?>/"+id,
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
              url:"<?php echo base_url('sasaran_strategis/delete_data');?>/"+resp[0].id_sasaran_strategis,
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