

<div id="main-content" class="container-fluid">
   <div class="row bg-title">
      <!-- .page title -->
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">Urusan</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         <ol class="breadcrumb">
            <li><a href="https://e-office.sumedangkab.go.id/admin">Dashboard</a></li>
            <li class="active">Urusan</li>
         </ol>
      </div>
   </div>
   <div class="row">
      
      <div class="col-md-12">

         <div class="white-box">
          <div class="btn-group pull-right">
            <div class="input-group">
              <input type="text" onkeyup="loadPagination(1)" id="search" class="form-control" placeholder="Cari kode, nama urusan">
              <span class="input-group-btn">
                <button type="button" onclick="loadPagination(1)" class="btn waves-effect waves-light btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle waves-effect waves-light m-r-5" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-flag m-r-5"></i>  <b class="caret"></b></button>
            <ul class="dropdown-menu" role="menu" id="opt_kategori">
              <li>
                <a href='javascript:void(0)' onclick='get_urusan("")'>Semua Urusan</a>
              </li>
              <?php foreach ($dt_urusan as $key => $row) {
               echo "
               <li>
               <a href='javascript:void(0)' onclick='get_urusan($row->id_urusan)'>$row->nama_urusan</a>
               </li>
               ";
             }
             ?>

           </ul>
         </div>

            <table class="table">
               <thead>
                  <tr>
                     <th width="50px">No.</th>
                     <th width="80px">Kode</th>
                     <th>Urusan</th>
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

<script type="text/javascript">
  var action = "";
  var page=1;
  var id_urusan='';

  function loadPagination(page_num) {
    
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sicerdas/rpjmd/urusan/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
        id_urusan : id_urusan,
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

   function get_urusan(id)
   {
    id_urusan = id;
    loadPagination(1);
   }
   
</script>

