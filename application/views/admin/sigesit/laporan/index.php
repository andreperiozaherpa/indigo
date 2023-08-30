<div id="main-content" class="container-fluid">
   <div class="row bg-title">
      <!-- .page title -->
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">Laporan</h4>
      </div>
      <!-- /.page title -->
      <!-- .breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         <ol class="breadcrumb">
            <li><a href="#">Sigesit</a></li>
            <li class="active">Laporan</li>
         </ol>
      </div>
      <!-- /.breadcrumb -->
   </div>

   <div class="row">
		<div class="col-md-12">
			<div class="white-box">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama SKPD </label>
							<input type="text" class="form-control" placeholder="Cari berdasarkan Nama SKPD"
								name="nama_skpd" value="" id="search" onkeyup="loadPagination(1)">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">

							<br>
							<button type="submit" onclick="loadPagination(1)" class="btn btn-primary m-t-5 btn-outline"><i class="ti-filter"></i>
								Filter</button>
						</div>
					</div>

				</div>

			</div>
		</div>

	</div>

   <div class="row">
   	
      <div class="col-md-12">
         <div class="white-box">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th style="text-align:center" rowspan="2" width="30px">No.</th>
                     <th style="text-align:center" rowspan="2" width="50px">tahun</th>
                     <th style="text-align:center" rowspan="2">SKPD</th>
                     <th style="text-align:center" rowspan="2">Program</th>
                     <th style="text-align:center" rowspan="2">Kegiatan</th>
                     <th style="text-align:center" rowspan="2">Sub Kegiatan</th>
                     <th style="text-align:center" rowspan="2">Output</th>
                     <th style="text-align:center" rowspan="2">Kelompok Sasaran</th>
                     <th style="text-align:center" rowspan="2">Sumber Anggaran</th>
                     <th style="text-align:center" colspan="3">RKPD</th>
                     <th style="text-align:center" colspan="3">APBD</th>
                     <th style="text-align:center" colspan="4">REALISASI</th>
                     <th style="text-align:center" rowspan="2">Status</th>
                  </tr>
                  <tr>
                     <th style="text-align:center">Target</th>
                     <th style="text-align:center">Satuan</th>
                     <th style="text-align:center">Anggaran</th>
                     <th style="text-align:center">Target</th> 
                     <th style="text-align:center">Satuan</th>
                     <th style="text-align:center">Anggaran</th>
                     <th style="text-align:center">Anggaran</th>
                     <th style="text-align:center">Capaian Anggaran</th>
                     <th style="text-align:center">Kinerja</th>
                     <th style="text-align:center">Capaian Kinerja</th>
                  </tr>
               </thead>
               <tbody id="row-data">
                 
               </tbody>
            </table>
         </div>
      </div>
      <div class="col-12 text-center">
        <nav class="mt-4 mb-3">
            <ul class="pagination justify-content-center mb-0" id="pagination"></ul>
        </nav>
      </div>
   </div>
</div>



<script type="text/javascript">
  var action = "";
  var page=1;
  
  function loadPagination(page_num) {
    
    page = page_num;

    $.ajax({
      url: "<?=base_url()?>sigesit/laporan/get_list/" + page_num,
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

   
</script>
