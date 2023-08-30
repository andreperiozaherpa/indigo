

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
            <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
            <li class="active">Sasaran RPJMD</li>
         </ol>
      </div>
      <!-- /.breadcrumb -->
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="white-box">
            <div class="row">
               <div class="col-md-3 b-r">
                  <button type="button" onclick="add();" class="btn btn-primary btn-block e m-t-20" ><i class="fa fa-plus"></i> Tambah Sasaran </button>
               </div>
               <form method="POST">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nama Sasaran</label>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan Nama Sasaran RPJMD" name="search" id="search" onkeyup="loadPagination(1)" value="">
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
                     <th>No.</th>
                     <th>Kode</th>
                     <th>Nama Sasaran</th>
                     <th>Opsi</th>
                  </tr>
               </thead>
               <tbody id="row-data">
                  
               </tbody>
            </table>
         </div>
      </div>
      <div class="col-12">
        <nav class="mt-4 mb-3">
            <ul class="pagination justify-content-center mb-0" id="pagination">
            </ul>
        </nav>
      </div>
   </div>
</div>
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="data-title">Tambah Sasaran Strategis</h4>
         </div>
         <div class="modal-body">
            <form id="form-data" >
               <div class="form-group">
                  <label for="id_misi" class="control-label">Misi</label>
                  <select id="id_misi" name="id_misi" class="form-control" onchange="get_tujuan()" >
                     <option value="">Pilih Misi</option>
                     <?php foreach($dt_misi as $misi){
                        echo '<option value="'.$misi->id_misi.'">'.$misi->misi.'</option>';
                        }
                        ?>
                  </select>
                  <div class="text-danger error" id="err_id_misi"></div>
               </div>
               <div class="form-group">
                  <label for="id_tujuan" class="control-label">Tujuan</label>
                  <select id="id_tujuan" name="id_tujuan" class="form-control" onchange="get_indikator()">
                     <option value="">Pilih Tujuan</option>
                  </select>
                  <div class="text-danger error" id="err_id_tujuan"></div>
               </div>
               <div class="form-group">
                  <label for="id_indikator_tujuan" class="control-label">Indikator Tujuan</label>
                  <select id="id_indikator_tujuan" name="id_indikator_tujuan" class="form-control" >
                     <option value="">Pilih Indikator Tujuan</option>
                  </select>
                  <div class="text-danger error" id="err_id_indikator_tujuan"></div>
               </div>
               <div class="form-group">
                  <label for="nama_sasaran_rpjmd" class="control-label"> Nama Sasaran </label>
                  <textarea id="nama_sasaran_rpjmd" class="form-control" name="nama_sasaran_rpjmd" ></textarea>
                  <div class="text-danger error" id="err_nama_sasaran_rpjmd"></div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
  var action = "";
  var page=1;
  var id_sasaran=0;

  function loadPagination(page_num) {
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/rpjmd/sasaran/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
      },
      success: function (data) {
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
      $(".modal-tittle").html("Tambah sasaran");
      $(".input_text").val("");
      $(".input_select").val("").trigger("change");
      action = "add";
      id_sasaran = 0;
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
      formdata.append("id_sasaran",id_sasaran);
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/rpjmd/sasaran/save",
         type       : 'post',
         dataType   : 'json',
         data       : formdata,
         processData:false,
         contentType:false,
         cache:false,
         async:false,
         success    : function(data){

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
   
</script>

