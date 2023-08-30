<div id="main-content" class="container-fluid">
   <div class="row bg-title">
      <!-- .page title -->
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
         <h4 class="page-title">Perencanaan</h4>
      </div>
      <!-- /.page title -->
      <!-- .breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Perencanaan</li>
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
   						<div class="panel panel-default">
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
             <a href="<?=base_url();?>sigesit/kegiatan/add/<?=$token;?>">
            <button type="button"class="btn btn-primary e"><i class="fa fa-plus"></i> Tambah Kegiatan </button>
             </a>
            <table class="table">
               <thead>
                  <tr>
                     <th width="50px">No.</th>
                     <th width="80px">Program</th>
                     <th>Kegiatan</th>
                     <th>Sub Kegiatan</th>
                     <th>Output</th>
                     <th>Target</th>
                     <th>Kelompok Sasaran</th>
                     <th>Anggaran</th>
                     <!-- <th>Realisasi Anggaran</th> -->
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
      url: "<?=base_url()?>sigesit/kegiatan/get_list/" + page_num,
      type: 'post',
      dataType: 'json',
      data: {
        //search: $("#search").val(),
        perencanaan : 1,
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
