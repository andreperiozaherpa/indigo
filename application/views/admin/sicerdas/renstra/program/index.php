<div id="main-content" class="container-fluid">

  <div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Ren. Strategis</h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li class="active">Ren. Strategis</li>
      </ol>
    </div>
    <!-- /.breadcrumb -->
  </div>
  <!-- .row -->
  <div class="row">

    <div class="col-md-12">
      <div class="white-box">
        <div class="row">
          <form method="POST">
            <div class="col-md-3 b-r">
              <center><img style="width: 80%" src="https://e-office.sumedangkab.go.id//data/logo/skpd/sumedang.png" alt="user" class="img-circle"> </center>
            </div>
            <div class="col-md-9">
              <div class="panel panel-default">
                <div class="panel-heading"><?=$dt_skpd->nama_skpd;?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td style="width: 120px;">Nama Kepala </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->kepala->nama_lengkap;?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Alamat SKPD </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->alamat_skpd;?></strong></td>
                        </tr>
                        <tr>
                          <td style="width: 120px;">Email/tlp </td>
                          <td>:</td>
                          <td> <strong><?=$dt_skpd->email_skpd;?> / <?=$dt_skpd->telepon_skpd;?></strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
     </div>

    <div class="col-md-12">


      <div class="white-box">
        <button type="button" onclick="add()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Program </button>

        <table class="table">
          <thead>
            <tr>
              <th width="50px">No.</th>
              <th width="100px">Kode</th>
              <th>Nama Program</th>
              <th>Sasaran</th>
              <!-- <th>Indikator Program RPJMD</th> -->
              <th>Jml. Indikator</th>
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
            <label for="id_program_rpjmd" class="control-label">Program Dari RPJMD:</label>
            <select id="id_program_rpjmd" name="id_program_rpjmd" class="form-control select2 input_select" onchange="get_indikator_rpjmd()" >
             <option value="">Pilih</option>
             <?php foreach($dt_program_rpjmd as $row){
              echo '<option value="'.$row->id_program_rpjmd.'">'.$row->kode_program.' - '.$row->nama_program.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_program_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_indikator_program_rpjmd" class="control-label">Indikator Program dari RPJMD:</label>
            <select id="id_indikator_program_rpjmd" name="id_indikator_program_rpjmd[]" multiple class="form-control_ select2 input_select">
              
            </select>
            <div class="text-danger error" id="err_id_indikator_program_rpjmd"></div>
          </div>

          <div class="form-group">
            <label for="id_sasaran_renstra" class="control-label">Sasaran dari Renstra:</label>
            <select id="id_sasaran_renstra" name="id_sasaran_renstra" class="form-control select2 input_select" onchange="get_indikator_sasaran()">
              <option value="">Pilih</option>
              <?php foreach($dt_sasaran as $row){
              echo '<option value="'.$row->id_sasaran_renstra.'">'.$row->nama_sasaran_renstra.'</option>';
            }
            ?>
            </select>
            <div class="text-danger error" id="err_id_sasaran_renstra"></div>
          </div>
          

          <div class="form-group">
            <label for="id_indikator_sasaran_renstra" class="control-label">Indikator Sasaran:</label>
            <select id="id_indikator_sasaran_renstra" name="id_indikator_sasaran_renstra[]" multiple class="form-control_ select2 input_select" >
              <option value="">Pilih</option>
            </select>
            <div class="text-danger error" id="err_id_indikator_sasaran_renstra"></div>
          </div>

          <div class="row" id="row-unit-kerja">
                  
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
      url: "<?=base_url()?>sicerdas/renstra/program/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
        id_skpd : '<?= $dt_skpd->id_skpd;?>',
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
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renstra/program/save",
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
               setTimeout(function(){
                location.reload();
               },500)
            }
            else{
               for(err in data.errors)
               {
                 let er = err.replaceAll('[','');
                 er = er.replaceAll(']','');
                  $("#err_"+er).html(data.errors[err]);
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


   
   function get_indikator_rpjmd()
   {
      $("#id_indikator_program_rpjmd").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/program_indikator/get_indikator_by_program/",
         type: 'post',
         dataType: 'json',
         data: {
            id_program_rpjmd : $("#id_program_rpjmd").val(),
            id_skpd : '<?=$dt_skpd->id_skpd;?>',
         },
         success: function (data) {
            $("#id_indikator_program_rpjmd").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });
    }

    

    function get_indikator_sasaran()
    {
      $("#id_indikator_sasaran_renstra").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/renstra/sasaran_indikator/get_indikator_by_sasaran/",
         type: 'post',
         dataType: 'json',
         data: {
            id_sasaran_renstra : $("#id_sasaran_renstra").val(),
         },
         success: function (data) {
            $("#id_indikator_sasaran_renstra").html(data.content);
         },
         error: function (xhr, status, error) {
            console.log(xhr.responseText);
            swal("Opps", "Terjadi kesalahan", "error");
         }
      });

      get_unit_kerja();
    }

    function check(id)
    {
      var is_checked = $("#checkbox_"+id).prop("checked");
      $(".unit-"+id).prop("checked",is_checked);
    }

    function get_unit_kerja()
    {
      /* var id_sasaran_renstra = $("#id_sasaran_renstra").val();
      $("#row-unit-kerja").html("");
      if(id_sasaran_renstra != "")
      {
        
        $.ajax({
           url: "<?=base_url()?>sicerdas/renstra/program/get_unit_kerja/",
           type: 'post',
           dataType: 'json',
           data: {
              id_sasaran_renstra : $("#id_sasaran_renstra").val(),
              id_skpd : '<?=$dt_skpd->id_skpd;?>'
           },
           success: function (data) {
              $("#row-unit-kerja").html(data.content);
           },
           error: function (xhr, status, error) {
              console.log(xhr.responseText);
              swal("Opps", "Terjadi kesalahan", "error");
           }
        });
      } */

    }

    
</script>