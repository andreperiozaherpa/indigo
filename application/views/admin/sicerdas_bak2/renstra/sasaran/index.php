

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
            <button type="button" onclick="add();" class="btn btn-primary e" ><i class="fa fa-plus"></i> Tambah Sasaran </button>
            <table class="table">
               <thead>
                  <tr>
                     <th width="50px">No.</th>
                     <th width="80px">Kode</th>
                     <th>Nama Sasaran</th>
                     <th>Tujuan</th>
                     <th>Urusan</th>
                     <th>Jml. Indikator</th>
                     <th width="100px">Opsi</th>
                  </tr>
               </thead>
               <tbody id="row-data">
                  
               </tbody>
            </table>
         </div>
      </div>
      <div class="col-12 text-center">
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
                  <label for="id_tujuan" class="control-label">Tujuan</label>
                  <select id="id_tujuan" name="id_tujuan" class="form-control select2 input_select" onchange="get_indikator()">
                     <option value="">Pilih</option>
                        <?php foreach($dt_tujuan as $row){
                        echo '<option value="'.$row->id_tujuan.'">'.$row->tujuan.'</option>';
                        }
                        ?>
                  </select>
                  <div class="text-danger error" id="err_id_tujuan"></div>
               </div>
               <div class="form-group">
                  <label for="id_indikator_tujuan" class="control-label">Indikator Tujuan</label>
                  <select id="id_indikator_tujuan" name="id_indikator_tujuan" class="form-control select2 input_select" >
                     <option value="">Pilih</option>
                  </select>
                  <div class="text-danger error" id="err_id_indikator_tujuan"></div>
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
                  <select  name="id_sub_urusan"  id="id_sub_urusan" class="form-control select2 input_select">
                    <option value="">Pilih</option>
                  </select>
                  <div class="text-danger error" id="err_id_sub_urusan"></div>
                </div>
               <div class="form-group">
                  <label for="nama_sasaran_renstra" class="control-label"> Nama Sasaran </label>
                  <textarea id="nama_sasaran_renstra" class="form-control input_text" name="nama_sasaran_renstra" ></textarea>
                  <div class="text-danger error" id="err_nama_sasaran_renstra"></div>
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
      url: "<?=base_url()?>sicerdas/renstra/sasaran/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
        id_skpd : "<?= $dt_skpd->id_skpd;?>",
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
      $(".modal-title").html("Tambah sasaran");
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
      formdata.append("id_skpd","<?= $dt_skpd->id_skpd;?>");
      
      $.ajax({
         url        : "<?=base_url()?>sicerdas/renstra/sasaran/save",
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


   
   function get_indikator()
   {
      $("#id_indikator_tujuan").html("");
      $.ajax({
         url: "<?=base_url()?>sicerdas/rpjmd/tujuan/get_indikator_by_tujuan/",
         type: 'post',
         dataType: 'json',
         data: {
            id_tujuan : $("#id_tujuan").val(),
            id_skpd   : '<?=$dt_skpd->id_skpd;?>',
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
</script>

