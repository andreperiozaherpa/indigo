<div id="main-content" class="container-fluid">
   <div class="row bg-title">
      <!-- .page title -->
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">penganggaran</h4>
      </div>
      <!-- /.page title -->
      <!-- .breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">penganggaran</li>
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
   						<center><img style="width: 80%" src="<?=base_url();?>//data/logo/skpd/sumedang.png" alt="user" class="img-circle"> </center>
   					</div>
   					<div class="col-md-9">
   						<div class="panel panel-primary">
   							<div class="panel-heading"><?= strtoupper($detail->nama_skpd) ;?> <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
	   						</div>
	   						<div class="panel-wrapper collapse in" aria-expanded="true">
	   							<div class="panel-body">
	   								<table class="table">
	   									<tbody>
                                    <tr>
	   											<td style="width: 120px;">Nama Kepala </td>
	   											<td>:</td>
	   											<td> <strong><?=($kepala) ? $kepala->nama_lengkap : "" ;?></strong></td>
	   										</tr>
	   										<tr>
	   											<td style="width: 120px;">Alamat SKPD </td>
	   											<td>:</td>
	   											<td> <strong><?=$detail->alamat_skpd;?></strong></td>
	   										</tr>
	   										<tr>
	   											<td style="width: 120px;">Email/tlp </td>
	   											<td>:</td>
	   											<td> <strong><?=$detail->email_skpd;?> / <?=$detail->telepon_skpd;?></strong>
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
            
           
         <table class="table table-bordered">
               <thead>
                  <tr>
                     <th style="text-align:center" rowspan="2" width="30px">No.</th>
                     <th style="text-align:center" rowspan="2" width="50px">tahun</th>
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
      url: "<?=base_url()?>sigesit/monev/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        search: $("#search").val(),
        id_skpd : '<?=$detail->id_skpd;?>',
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
