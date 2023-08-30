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
        <li><a href="#">Dashboard</a></li>
        <li class="active">Program RPJMD</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">

      <div class="col-md-12">
        <div class="white-box">
          <div class="row">
            <div class="col-md-3 b-r">

             <button type="button" onclick="add()" class="btn btn-primary btn-block e m-t-20"><i class="fa fa-plus"></i> Tambah Program </button>

           </div>
           <form method="POST">

            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Program</label>
                <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Program RPJMD" name="search" id="search" onkeyup="loadPagination(1)" value="">
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

  


  



<div class="col-md-12">



  <div class="white-box">

    <table class="table">
      <thead>
        <tr>
          <th width="50px">No.</th>
          <th width="100px">Kode</th>
          <th>Nama Program</th>
          <th width="100px">Opsi</th>

        </tr>
      </thead>
      <tbody id="row-data">
      </tbody>

    </table>


  </div>    


</div>




</div>

<div class="row">

  <div class="col-md-12 pager">

    <div class="btn-group" id="pagination">

    </div>

  </div>
</div>
</div>


<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="data-title">Tambah Program</h4>
        </div>
        <div class="modal-body">
          <form id="form-data" action="#!">



           <div class="form-group">
            <label for="data-id_misi" class="control-label">Misi</label>
            <select id="id_misi" name="id_misi" class="form-control select2 input_select" onchange="get_tujuan()" >
             <option value="">Pilih</option>
             <?php foreach($dt_misi as $misi){
              echo '<option value="'.$misi->id_misi.'">'.$misi->misi.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_misi"></div>
          </div>

          <div class="form-group">
            <label for="id_tujuan" class="control-label">Tujuan</label>
            <select id="id_tujuan" name="id_tujuan" class="form-control select2 input_select" onchange="get_indikator()">
             <option value="">Pilih</option>
           </select>
           <div class="text-danger error" id="err_id_tujuan"></div>
          </div>
          <div class="form-group">
            <label for="id_indikator_tujuan" class="control-label">Indikator Tujuan</label>
            <select id="id_indikator_tujuan" name="id_indikator_tujuan" class="form-control select2 input_select" onchange="get_sasaran()">
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_indikator_tujuan"></div>
          </div>

          <div class="form-group">
            <label for="id_sasaran_rpjmd" class="control-label"> Tujuan OPD</label>
            <select id="id_sasaran_rpjmd" name="id_sasaran_rpjmd" class="form-control select2 input_select" onchange="get_indikator_sasaran()">
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_sasaran_rpjmd"></div>
          </div>
          

          <div class="form-group">
            <label for="ids_indikator_sasaran_rpjmd" class="control-label">Indikator Sasaran</label>
            <select id="ids_indikator_sasaran_rpjmd" multiple  class="form-control_ select2 input_select" >
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_ids_indikator_sasaran_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_urusan" class="control-label">Urusan</label>
            <select  name="id_urusan" id="id_urusan" class="form-control select2 input_select" onchange="get_sub_urusan_by_urusan()">
              <option value="">Pilih</option>
              <?php foreach($dt_urusan as $u){
                echo"<option value='$u->id_urusan'>$u->kode_urusan - $u->nama_urusan</option>";
              }
              ?>
            </select>
            <div class="text-danger error" id="err_id_urusan"></div>
          </div>

          <div class="form-group">
            <label for="id_sub_urusan" class="control-label">Sub Urusan</label>
            <select  name="id_sub_urusan"  id="id_sub_urusan" class="form-control select2 input_select" onchange="get_program_by_sub_urusan()">
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_sub_urusan"></div>
          </div>


          

          <div class="form-group">
            <label for="id_ref_program" class="control-label">Pilih Program</label>
            <select  name="id_ref_program" id="id_ref_program" class="form-control select2 input_select"  >
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_ref_program"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="data-button" class="btn btn-primary" onclick="save()">Simpan</button>
      </div>
    </div>
    <!-- /#data-content -->
  </div>
  <!-- /#data-dialog -->
</div>

<script type="text/javascript">
  var action = "";
  var page=1;
  var id_program=0;

  function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/rpjmd/program/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
      },
      success: function (data) {
        console.log(data.pagination);
        $("#row-data").html(data.content);
        $("#pagination").html(data.pagination);
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
        swal("Opps", "Terjadi kesalahan", "error");
      }
    });
   }

   function add()
   {
      $('#form-data')[0].reset();
      $(".modal-title").html("Tambah Program");
      $(".input_text").val("");
      $(".input_select").val("").trigger("change");
      action = "add";
      id_program = 0;
      reset_error();
      $("#data-modal").modal();
   }

   function reset_error()
   {
      $(".error").html("");
   }

   function save()
   {
      reset_error();
      var formdata = new FormData(document.getElementById('form-data'));
      formdata.append("action",action);
      formdata.append("id_program",id_program);
      formdata.append("ids_indikator_sasaran_rpjmd",$("#ids_indikator_sasaran_rpjmd").val());
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/program/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){
           console.log(data);
            if(data.status){
               $('#data-modal').modal('toggle');
               swal(
               'Berhasil',
               data.message,
               'success'
               );
               loadPagination(page);
            }
            else{
               for(err in data.errors)
               {
                  $("#err_"+err).html(data.errors[err]);
               }
               if(data.errors.length==0){
                  swal(
                  'Opps',
                  data.message,
                  'warning');
               }
            }
         },
         error: function(xhr, status, error) {
            console.log(xhr);
         }
      });
   }


   function get_tujuan()
   {
      $("#id_tujuan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/tujuan/get_tujuan_by_misi/",
         type: 'post',
         dataType: 'json',
         data: {
            id_misi : $("#id_misi").val(),
         },
         success: function (data) {
            $("#id_tujuan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
   }
   function get_indikator()
   {
      $("#id_indikator_tujuan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/tujuan/get_indikator_by_tujuan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_tujuan : $("#id_tujuan").val(),
         },
         success: function (data) {
            $("#id_indikator_tujuan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_sasaran()
    {
      $("#id_sasaran_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/sasaran/get_sasaran_by_indikator/",
         type: 'post',
         dataType: 'json',
         data: {
            id_indikator_tujuan : $("#id_indikator_tujuan").val(),
         },
         success: function (data) {
            $("#id_sasaran_rpjmd").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    function get_indikator_sasaran()
    {
      $("#ids_indikator_sasaran_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/sasaran_indikator/get_indikator_by_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_rpjmd : $("#id_sasaran_rpjmd").val(),
         },
         success: function (data) {
            $("#ids_indikator_sasaran_rpjmd").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
    function get_sub_urusan_by_urusan()
    {
      $("#id_sub_urusan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/urusan/get_sub_urusan_by_urusan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_urusan : $("#id_urusan").val(),
         },
         success: function (data) {
            $("#id_sub_urusan").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
    
    function get_program_by_sub_urusan()
    {
      $("#id_ref_program").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/program/get_program_by_sub_urusan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sub_urusan : $("#id_sub_urusan").val(),
         },
         success: function (data) {
            $("#id_ref_program").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }
</script>