
<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Program RPJMD</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>admin">Dashboard</a></li>
        <li class="active">Program RPJMD</li>
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

             <button type="button" onclick="addProgram();" class="btn btn-primary btn-block e m-t-20"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Program </button>
           </div>
           <form method="POST">
            <?php if($user_level=='Administrator'){ ?>


              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Program</label>
                  <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Program RPJMD" name="program_rpjmd" value="<?=($filter) ? $filter_data['program_rpjmd'] : ''?>">
                </div>
              </div>
            <?php } ?>
            <div class="col-md-3">
              <div class="form-group">
                <input type="hidden" name="filter" value="1">
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


  
  <div id="modalProgram" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="data-title">Tambah Program RPJMD</h4>
        </div>
        <div class="modal-body">
          <form id="formProgram" method="POST">
            <div id="hidden"></div>
            <div class="form-group">
              <label for="data-id_misi" class="control-label">Misi</label>
              <select id="data-id_misi" name="id_misi" class="form-control" onchange="get_tujuan()" required>
                <option value="">Pilih Misi</option>
                <?php foreach ($misi as $key): ?>
                  <option value="<?=$key->id_misi?>"><?=$key->misi?></option>
                <?php endforeach ?>

              </select>
            </div>

            <div class="form-group">
              <label for="data-id_tujuan" class="control-label">Tujuan</label>
              <select id="data-id_tujuan" name="id_tujuan" class="form-control" onchange="get_sasaran()" required>
                <option value="">Pilih Tujuan</option>
              </select>
            </div>


            <div class="form-group">
              <label for="data-id_sasaran" class="control-label">Sasaran</label>
              <select id="data-id_sasaran" name="id_sasaran_rpjmd" class="form-control" required>
                <option value="">Pilih Sasaran</option>
              </select>
            </div>


            <div class="form-group">
              <label for="data-sasaran-rpjmd" class="control-label"> Nama Program </label>
              <textarea placeholder="Masukkan Nama Program" id="data-sasaran-rpjmd" class="form-control" name="program_rpjmd" required></textarea>
            </div>


            <button type="submit" id="data-form-submit" hidden></button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="data-button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
      <!-- /#data-content -->
    </div>
    <!-- /#data-dialog -->
  </div>


  <div id="hapusProgram" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="panel-heading">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myLargeModalLabel1" style="color:white;">Hapus Program</h4>
        </div>
        <div class="modal-body">
          Apakah anda yakin akan menghapus Program RPJMD ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Tidak</button>
          <a style="color: #fff !important" href="" id="btnDeleteProgram" class="btn btn-primary waves-effect text-left">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


  <div class="col-md-12">


    <?php
    if (!empty($message)){
      ?>
      <div class="alert alert-<?= $type;?> alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?= $message;?>
      </div>
    <?php }?>

    <div class="row">


     <?php foreach($list as $l){
      $j_indikator = count($this->program_rpjmd_model->get_indikator_by_id_p($l->id_program_rpjmd));
      $total_anggaran = rupiah($this->program_rpjmd_model->get_total_anggaran($l->id_program_rpjmd));
      ?>
      <div class="col-md-4 col-sm-6">
        <div style="background-color: #4e2a84;padding:10px">
          <div class="pull-left">
            <div class="btn-group m-r-10">
              <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary btn-outline dropdown-toggle btn-circle " type="button"><i class="icon-options-vertical"></i></button>
              <ul role="menu" class="dropdown-menu animated flipInX">
                <li><a  href="javascript:void(0)" onclick="editProgram(<?=$l->id_program_rpjmd?>)" >Edit</a></li>
                <li><a  href="javascript:void(0)" onclick="hapusProgram(<?=$l->id_program_rpjmd?>)">Hapus</a></li>
                <!-- <li><a href="#">Detail</a></li> -->
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <center>
               <img style="width:60%;margin-top:-20px;" src="<?=base_url()."data/images/sp.png";?>" alt="user" class="img-responsive">
             </center>
           </div>
         </div>
       </div>
       <a href="<?=base_url('program_rpjmd/detail/'.$l->id_program_rpjmd.'')?>">
         <div class="white-box">
          <div class="row">
            <div class="col-md-6 text-center b-r">
              <h3 class="box-title m-b-0">Total Anggaran</h3>
              <small>
              <?=$total_anggaran?> </small>
            </div>

            <div class="col-md-6 text-center ">
              <h3 class="box-title m-b-0">Jumlah IKU</h3>
              <?=$j_indikator?> 
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 text-center m-t-10">
              <h3 class="box-title m-b-0">Nama Program</h3>
              <small><?=$l->program_rpjmd?></small>
            </div>
          </div>


          <hr>



        </div>
      </a>
    </div>
  <?php } ?>


</div>    


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
<!-- .row -->

</div>
<script type="text/javascript">

  function get_tujuan(id_misi=null) {
    if (id_misi == null) {
      var id_misi = $("#data-id_misi").val();
    }
    $("#data-id_tujuan").attr("readonly",true);
    $.ajax({
      url:"<?php echo base_url('program_rpjmd/get_tujuan_by_misi');?>",
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

  function get_sasaran(id_tujuan=null) {
    if (id_tujuan == null) {
      var id_tujuan = $("#data-id_tujuan").val();
    }
    $("#data-id_sasaran").attr("readonly",true);
    $.ajax({
      url:"<?php echo base_url('program_rpjmd/get_sasaran_by_tujuan');?>",
      type:"GET",
      data: "id_tujuan="+id_tujuan,
      dataType: "text",

      success:function(resp){
        $("#data-id_sasaran").attr("readonly",false);
        $("#data-id_sasaran").html(resp);
      },
      error:function(event, textStatus, errorThrown) {
        alert('Error Message: '+ textStatus + ' , HTTP Error: '+ errorThrown);
        $("#data-modal").unblock();
        $("#data-id_sasaran").html("");
        $("#data-id_sasaran").attr("readonly",true);
      }
    })
  }

  function addProgram(){
    $('#formProgram')[0].reset(); 
    $('#modalProgram #hidden').html('');
    $('#modalProgram').modal('show');
    $('#modalProgram .modal-title').html('Tambah Program');
  }


  function editProgram(id_program_rpjmd){
    $('#formProgram')[0].reset(); 
    $('#modalProgram #hidden').html('<input type="hidden" value="" name="id_program_rpjmd"/>');
    $.ajax({
      url : "<?php echo base_url('program_rpjmd/get_program_by_id/')?>/" + id_program_rpjmd,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id_program_rpjmd"]').val(data.id_program_rpjmd);
        $('[name="id_misi"]').val(data.id_misi); 
        $.post("<?= base_url('program_rpjmd/get_tujuan_by_misi')?>/"+data.id_misi,{},function(obj){
          $('[name="id_tujuan"]').html(obj);
          $('[name="id_tujuan"]').val(data.id_tujuan);

        });
        $.post("<?= base_url('program_rpjmd/get_sasaran_by_tujuan')?>/"+data.id_tujuan,{},function(obj){
          $('[name="id_sasaran_rpjmd"]').html(obj);
          $('[name="id_sasaran_rpjmd"]').val(data.id_tujuan);

        });
        $('[name="program_rpjmd"]').val(data.program_rpjmd);
        $('#modalProgram').modal('show'); 
        $('#modalProgram .modal-title').html('Ubah Program');

      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert("Gagal mendapatkan data");
      }
    });
  }

  function hapusProgram(id_program_rpjmd){
    $('#hapusProgram').modal('show');
    $('#btnDeleteProgram').attr('href','<?=base_url('program_rpjmd/delete_program')?>/'+id_program_rpjmd);
  }
</script>