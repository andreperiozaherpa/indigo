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
   						<div class="panel panel-default">
   							<div class="panel-heading">SEKRETARIAT DAERAH <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a> </div>
	   						</div>
	   						<div class="panel-wrapper collapse in" aria-expanded="true">
	   							<div class="panel-body">
	   								<table class="table">
	   									<tbody>
	   										<tr>
	   											<td style="width: 120px;">Nama Kepala </td>
	   											<td>:</td>
	   											<td> <strong>Drs. HERMAN SURYATMAN, M.Si</strong></td>
	   										</tr>
	   										<tr>
	   											<td style="width: 120px;">Alamat SKPD </td>
	   											<td>:</td>
	   											<td> <strong>Jl. Prabu Gajah Agung No. 9</strong></td>
	   										</tr>
	   										<tr>
	   											<td style="width: 120px;">Email/tlp </td>
	   											<td>:</td>
	   											<td> <strong>humas_sumedang@yahoo.com / (0261) 201313</strong>
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
            
           
            <table class="table">
               <thead>
                  <tr>
                     <th width="50px">No.</th>
                     <th width="80px">Program</th>
                     <th>Kegiatan</th>
                     <th>Sub Kegiatan</th>
                     <th>Output</th>
                     <th>Target Rencana</th>
                     <th>Target Penyesuaian</th>
                     <th>Satuan</th>
                     <th>Kelompok Sasaran</th>
                     <th>Anggaran</th>
                     <th>Penyesuaian Anggaran</th>
                     <th width="300px">Opsi</th>
                  </tr>
               </thead>
               <tbody id="row-data">
                  <tr>
                   <td>1</td>
                   <td>Program Sosial</td>
                   <td>Kegiatan Pertanian</td>
                   <td>Pemberian Bantuan Pertanian</td>
                   <td>terselenggaranya perbantuan modal</td>
                   <td>10</td>
                   <td>10</td>
                   <td>Kelompok Tani</td>
                   <td>PHK</td>
                   <td>20.000.000</td>
                   <td> - </td>
                   <td> <a href="<?=base_url();?>sigesit/penganggaran/detail_penganggaran"><button class="btn btn-outline btn-primary"> Penyesuaian Anggaran</button></a></td>
                </tr>
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

