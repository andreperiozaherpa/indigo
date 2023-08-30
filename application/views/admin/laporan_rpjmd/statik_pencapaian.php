 <div class="container-fluid">

 	<div class="row bg-title">
 		<!-- .page title -->
 		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
 			<h4 class="page-title">Laporan Pencapaian</h4>
 		</div>
 		<!-- /.page title -->
 		<!-- .breadcrumb -->
 		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

 			<ol class="breadcrumb">
 				<li><a href="<?= base_url();?>/admin">Dashboard</a></li>
 				<li class="active">Laporan Pencapaian</li>
 			</ol>
 		</div>
 		<!-- /.breadcrumb -->
 	</div>

 	 	<div class="row">
 		<div class="col-md-12">
 			<div class="white-box">
 				<div class="row">
 					<form method="POST">
            <div class="col-md-3">
             <div class="form-group">
              <label for="exampleInputEmail1">Tahun</label>
              <select name="tahun_rkt" class="form-control">
                <?php 
                foreach($tahun as $r){
                  echo'<option value="'.$r->tahun_rkt.'">'.$r->tahun_rkt.'</option>';
                }
                ?>
              </select>				
            </div>
          </div>
          <?php if($user_level=='Administrator'){ ?>
          <div class="col-md-6">
           <div class="form-group">
            <label for="exampleInputEmail1">Unit kerja</label>
            <select name="id_unit_kerja" class="form-control">
             <option value="">Semua Unit Kerja</option>
             <?php 
             foreach($unit_kerja as $r){
              echo'<option value="'.$r->id_unit_kerja.'">'.$r->nama_unit_kerja.'</option>';
            }
            ?>
          </select>				
        </div>
      </div>
    <?php } ?>
      <div class="col-md-3">
       <div class="form-group">

        <br>
        <button type="submit" class="btn btn-primary m-t-5">Filter</button>
        <a href="<?=base_url('laporan/cetak_perencanaan')?>" class="btn btn-danger m-t-5 pull-right"><i class="fa fa-print"></i> Cetak Laporan </a>
      </div>
    </div>

  </form>
</div>

</div>
</div>

</div>
<style>
#table1 th 
{
    text-align: center; 
    vertical-align: middle;
    background-color: #55a3a7; 
}
</style>

 	<div class="row" style="overflow-x: auto;overflow-y: auto; ">
 		<div class="col-md-12" style="overflow-x: auto;overflow-y: auto; ">
 			<div class="white-box" style="overflow-x: auto;overflow-y: auto; ">

				<table id="table1" class="table color-table dark-table table-hover table-bordered">
					<thead>													
					<tr>
						<th  rowspan="3">Kode</th>
						<th  rowspan="3" >Misi/Tujuan/Sasaran Program Pembangunan Daerah</th>
						<th  rowspan="3">Indikator Kinerja (tujuan/impact/outcome)</th>
						<th rowspan="3" >Kondisi Kinerja Awal RPJMD (Tahun 0)</th>
						<th colspan="18" >Capaian Kinerja Program dan Kerangka Pendanaan</th>

						<th rowspan="3">Perangkat Daerah Penanggung Jawab</th>
					</tr>

					<tr>
					
						<th colspan="4" >2019</th>

						<th colspan="4"  >2020</th>

						<th colspan="4" >2021</th>

						<th colspan="4" >2023</th>

						<th colspan="2" >Kondisi Kinerja pada akhir periode RPJMD</th>

					</tr>
					<tr>
						<th >target</th>
						<th >Rp</th>
						<th >Realisasi</th>
						<th >Capaian</th>
						<th >target</th>
						<th >Rp</th>
						<th >Realisasi</th>
						<th >Capaian</th>
						<th >target</th>
						<th >Rp</th>
						<th >Realisasi</th>
						<th >Capaian</th>
						<th >target</th>
						<th >Rp</th>
						<th >Realisasi</th>
						<th >Capaian</th>
						<th >target</th>
						<th >Rp</th>
			
					</tr>
					<tr>
						<th >1</th>
						<th >2</th>
						<th >3</th>
						<th >4</th>
						<th >5</th>
						<th >6</th>
						<th >7</th>
						<th >8</th>
						<th >9</th>
						<th >10</th>
						<th >11</th>
						<th >12</th>
						<th >13</th>
						<th >14</th>
						<th >15</th>
						<th >16</th>
						<th >17</th>
						<th >18</th>
						<th >19</th>
						<th >20</th>
						<th >21</th>
						<th >22</th>
						<th >23</th>
					</tr>
						</thead>

					<tr>
						<td colspan="23" >MISI 1 : Memenuhi kebutuhan dasar masyarakat secara mudah dan terjangkau </td>
					</tr>
					<tr>
						<td ></td>
						<td >TUJUAN 1 : Terwujudnya pelayanan kesehatan yang berkualitas dan berkeadilan bagi masyarakat Sumedang </td>
						<td >Indeks Pembangunan Manusia</td>
						<td >70.33</td>
						<td >70,38-70,76</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >70,61-70,98</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >70,83-71,19</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >71,24-71,59</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >71,24-71,59</td>
						<td ></td>
						<td ></td>
					</tr>
					<tr>
						<td ></td>
						<td >SASARAN 1 : Meningkatnya kualitas tenaga Kesehatan serta menyediakan fasilitas pelayanan kesehatan yang mudah dan responsif dalam memberikan pelayanan kesehatan bagi masyarakat </td>
						<td >Indikator Sasaran 1 : Cakupan pelayanan kesehatan rujukan </td>
						<td >100%</td>
						<td >100%</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >100%</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >100%</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >100%</td>
						<td ></td>
						<td ><div class="label label-table label-danger">Belum disi</div></td>
						<td ><div class="label label-table label-success">0%</div></td>
						<td >100%</td>
						<td ></td>
						<td >DINAS KESEHATAN</td>
					</tr>
					<tr>
						<td ></td>
						<td ></td>
						<td >Indikator Sasaran 2 : Jumlah kematian Ibu</td>
						<td >22</td>
						<td >
							<22
							</td>
							<td ></td>
							<td ><div class="label label-table label-danger">Belum disi</div></td>
							<td ><div class="label label-table label-success">0%</div></td>
							<td >
								<22
								</td>
								<td ></td>
								<td ><div class="label label-table label-danger">Belum disi</div></td>
								<td ><div class="label label-table label-success">0%</div></td>
								<td >
									<22
									</td>
									<td ></td>
									<td ><div class="label label-table label-danger">Belum disi</div></td>
									<td ><div class="label label-table label-success">0%</div></td>
									<td >
										<22
										</td>
										<td ></td>
										<td ><div class="label label-table label-danger">Belum disi</div></td>
										<td ><div class="label label-table label-success">0%</div></td>
										<td >
											<22
											</td>
											<td ></td>
											<td >DINAS KESEHATAN</td>
										</tr>
										<tr>
											<td ></td>
											<td ></td>
											<td >Indikator Sasaran 3 : Jumlah kematian bayi</td>
											<td >146</td>
											<td >
												<146
												</td>
												<td ></td>
												<td ><div class="label label-table label-danger">Belum disi</div></td>
												<td ><div class="label label-table label-success">0%</div></td>
												<td >
													<146
													</td>
													<td ></td>
													<td ><div class="label label-table label-danger">Belum disi</div></td>
													<td ><div class="label label-table label-success">0%</div></td>
													<td >
														<146
														</td>
														<td ></td>
														<td ><div class="label label-table label-danger">Belum disi</div></td>
														<td ><div class="label label-table label-success">0%</div></td>
														<td >
															<146
															</td>
															<td ></td>
															<td ><div class="label label-table label-danger">Belum disi</div></td>
															<td ><div class="label label-table label-success">0%</div></td>
															<td >
																<146
																</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Sasaran 4 : Indeks Kepuasan Masyarakat Terhadap Pelayanan Bidang Kesehatan</td>
																<td >78,73</td>
																<td >79</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >81</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >83</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >83</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Sasaran 5 :
Prevalensi anak stunting</td>
																<td >23%</td>
																<td >23%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >23%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >23%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >23%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >23%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Sasaran 6 :
Cakupan pelayanan kesehatan rujukan</td>
																<td >98%</td>
																<td >98%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >98%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >99%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >99%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >99%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td >Program 1 :
Program Upaya Kesehatan Masyarakat</td>
																<td >Indikator Program 1 :
Rasio Puskesmas per Satuan Penduduk</td>
																<td >0%</td>
																<td >100%</td>
																<td >9446966806.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td >9948600743.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td >10473289947.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td >11595239117.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td >11595239117.00</td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 2 :
Persentase PPK BLUD memiliki IKM Kategori Baik</td>
																<td >78.73%</td>
																<td >79%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >81%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >83%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >83%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 3 :
Cakupan penanganan kegawatdaruratan kesehatan</td>
																<td >0%</td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 4 :
Peningkatan jumlah jenis pemeriksaan labkesling</td>
																<td >2 jenis</td>
																<td >2 jenis</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >2 jenis</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >2 jenis</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >2 jenis</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >2 jenis</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 5 :
Persentase puskesmas yang melaksanakan upaya kesehatan masyarakat</td>
																<td >100%</td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 6 :
Persentase puskesmas yang melaksanakan upaya kesehatan kerja</td>
																<td >100%</td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >100%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td >Program 2 :
Program Pencegenahan dan Penanggulangan Penyakit menular, penyakit tidak menular dan surveilans epidemiologi
</td>
																<td >Indikator Program 1 :
Angka kesembuhan TB</td>
																<td >85%</td>
																<td >85%</td>
																<td >6471319000.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >85%</td>
																<td >6814946039.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >85%</td>
																<td >7174366293.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >85%</td>
																<td >7942918902.00</td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >85%</td>
																<td >7942918902.00</td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 2 :
CNR TB</td>
																<td >114%</td>
																<td >95%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >95%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >95%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >95%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >95%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 3 :
Deteksi dini hepatitis B pada bumil</td>
																<td >20%</td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 4 :
Penemuan kasus diare semua umur</td>
																<td >81%</td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 5 :
penemuan kasus pnemonia pada balita</td>
																<td >89%</td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td ><div class="label label-table label-danger">Belum disi</div></td>
																<td ><div class="label label-table label-success">0%</div></td>
																<td >80%</td>
																<td ></td>
																<td >DINAS KESEHATAN</td>
															</tr>
															<tr>
																<td ></td>
																<td ></td>
																<td >Indikator Program 6 :
proporsi penemuan kasus kusta cacat tk 2</td>
																<td >36%</td>
																<td >
																	<15%
																	</td>
																	<td ></td>
																	<td ><div class="label label-table label-danger">Belum disi</div></td>
																	<td ><div class="label label-table label-success">0%</div></td>
																	<td >
																		<15%
																		</td>
																		<td ></td>
																		<td ><div class="label label-table label-danger">Belum disi</div></td>
																		<td ><div class="label label-table label-success">0%</div></td>
																		<td >
																			<15%
																			</td>
																			<td ></td>
																			<td ><div class="label label-table label-danger">Belum disi</div></td>
																			<td ><div class="label label-table label-success">0%</div></td>
																			<td >
																				<15%
																				</td>
																				<td ></td>
																				<td ><div class="label label-table label-danger">Belum disi</div></td>
																				<td ><div class="label label-table label-success">0%</div></td>
																				<td >
																					<15%
																					</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 7 :
Cakupan POPM Kecacingan
</td>
																					<td >98%</td>
																					<td >95%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 8 :
Insident Rate DBD</td>
																					<td >22/100.000 penduduk</td>
																					<td >< 49/100.000 penduduk
																					</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >< 49/100.000 penduduk
																					</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >< 49/100.000 penduduk
																					</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >< 49/100.000 penduduk
																					</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >< 49/100.000 penduduk
																					</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 9 :
Persentase Kasus HIV yang diobati</td>
																					<td >55%</td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 10 :
Persentase usia 15-59 yg mendapat screening PTM</td>
																					<td >11%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 11 :
Persentase penanganan penyakit tidak menular sesuai standar</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 12 :
Cakupan Desa/kelurahan Universal Child Immunization (UCI) </td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 13 :
Cakupan Desa/Kelurahan mengalami KLB yang dilakukan penyelidikan epidemiologi < 24 jam
																					</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program Standarisasi Pelayanan Kesehatan</td>
																					<td >Indikator Program 1 :
Persentase sarana kesehatan yang Terakreditasi
</td>
																					<td >23%</td>
																					<td >28%</td>
																					<td >1353492600.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >30%</td>
																					<td >1425363057.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >32%</td>
																					<td >1500536705.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35%</td>
																					<td >1661281410.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35%</td>
																					<td >1661281410.00</td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Jumlah Puskesmas menerapkan Sistem informasi Kesehatan terintegrasi online</td>
																					<td >0</td>
																					<td >15</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >20</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Peningkatan Kesehatan Keluarga dan Gizi Masyarakat
</td>
																					<td >Indikator Program 1 :
Persentase Anemia Pada Ibu Hamil </td>
																					<td >8.50%</td>
																					<td >8.50%</td>
																					<td >5604999000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8.25%</td>
																					<td >5902624447.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.08</td>
																					<td >6213928860.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.50%</td>
																					<td >6879594794.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.50%</td>
																					<td >6879594794.00</td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase BBLR</td>
																					<td >3.48%</td>
																					<td >3.48%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.19%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.32%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.32%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase balita gizi lebih</td>
																					<td >1.02%</td>
																					<td >1.02%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.02%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.02%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.02%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.02%</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase anak kelas 1-7 dan 10 mendapat screening kesehatan
</td>
																					<td >88.54%</td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td >DINAS KESEHATAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 :
Program Pelayanan Kesehatan Pada BLUD RSUD</td>
																					<td >Indikator Program 1 :
Bed Occupancy Rate (BOR)</td>
																					<td >80-60</td>
																					<td >80-60</td>
																					<td >197241545000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80-60</td>
																					<td >207715071039.50</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80-60</td>
																					<td >218669963886.12</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80-60</td>
																					<td >242094941695.32</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80-60</td>
																					<td >242094941695.00</td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Respon Time (IGD)</td>
																					<td >≤5 menit</td>
																					<td >≤5 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >≤5 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >≤5 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >≤5 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >≤5 menit</td>
																					<td ></td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Waktu tunggu poli klinik</td>
																					<td >120 menit</td>
																					<td >100 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >60 menit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100 menit</td>
																					<td ></td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Kematian pasien > 48 jam (Rawat Inap)</td>
																					<td >76.92%</td>
																					<td >75.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >75.48%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >75.96%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.92%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.00%</td>
																					<td ></td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Kematian pasien < 24jam (IGD)
																					</td>
																					<td >17/1000</td>
																					<td >15/1000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11/1000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7/1000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2/1000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2/1000</td>
																					<td ></td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program pengadaan peningkatan sarana dan prasarana rumah sakit/rumah sakit jiwa/rumah sakit paru/rumah sakit mata</td>
																					<td >Persentase pengadaan Kelengkapan alat kesehatan rumah sakit</td>
																					<td >0.8</td>
																					<td >0.85</td>
																					<td >5000000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.9</td>
																					<td >5265500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.95</td>
																					<td >5543202470.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >5833555415.38</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >82048566533.00</td>
																					<td >RUMAH SAKIT UMUM DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 2 : Terwujudnya pelayanan sistem pendidikan yang Berkualitas dan Merata</td>
																					<td >Indeks Pembangunan Manusia</td>
																					<td >70.099999999999994</td>
																					<td >71.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.099999999999994</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.7</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.900000000000006</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.900000000000006</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatnya Kuantitas dan kualitas Sarana dan Prasarana Pendidikan serta tenaga pengajar untuk mewujudkan pelayanan sistem pendidikan yang merata (Meningkatnya Kualitas Pelayanan Pendidikan Yang merata)</td>
																					<td >Indikator Sasaran 1 :
Rata-rata peningkatan hasil UN</td>
																					<td >46,13</td>
																					<td >49,82</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >53,51</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >57,20</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >64,58</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >64,58</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
APK PAUD</td>
																					<td >59.25</td>
																					<td >62.21</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.180000000000007</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >68.14</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.06</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.06</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
Rata-rata lama sekolah</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Peningkatan Mutu Pendidik dan Tenaga Kependidikan</td>
																					<td >Indikator Program 1 :
Guru yang memenuhi kualifikasi S1/D-IV </td>
																					<td >97.20</td>
																					<td >97.49</td>
																					<td >694000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >97.78</td>
																					<td >730851400.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.07</td>
																					<td >769396503.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.66</td>
																					<td >851817955.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.66</td>
																					<td >851817955.00</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase Guru yang Bersertifikasi</td>
																					<td >84.69</td>
																					<td >86.38</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >88.08</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >89.77</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93.16</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93.16</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Manajemen Pelayanan Pendidikan</td>
																					<td >Indikator Program 1 :
Rasio guru terhadap murid pendidikan dasar</td>
																					<td >372.33</td>
																					<td >396.53</td>
																					<td >1620000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >420.73</td>
																					<td >1706022000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >444.93</td>
																					<td >1795997600.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >493.33</td>
																					<td >1988393498.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >493.33</td>
																					<td >1988393498.00</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Rasio guru/murid per kelas rata-rata sekolah pendidikan dasar</td>
																					<td >37.23</td>
																					<td >37.27</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >37.31</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >37.34</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >37.42</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >37.42</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program wajib pendidikan dasar sembilan tahun</td>
																					<td >Indikator Program 1 :
Sekolah pendidikan Dasar kondisi Bangunan baik </td>
																					<td >14.79%</td>
																					<td >16.27%</td>
																					<td >100248182000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Rasio ketersediaan sekolah/penduduk usia sekolah pendidikan dasar </td>
																					<td >56.30</td>
																					<td >57.43</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Angka Putus Sekolah (APS) SD </td>
																					<td >0.05</td>
																					<td >0.04</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Angka Putus Sekolah (APS) SMP </td>
																					<td >0.03</td>
																					<td >0.03</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Angka Melanjutkan (AM) dari SD ke SMP/MTs </td>
																					<td >100,29</td>
																					<td >100,39</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 6 :
Angka Melanjutkan (AM) dari SMP ke SMA/SMK/MA </td>
																					<td >88,69</td>
																					<td >88,78</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 7 :
Angka Partisipasi Sekolah SD</td>
																					<td >100.00</td>
																					<td >100.10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 8 :
Angka Partisipasi Sekolah SMP</td>
																					<td >93.73</td>
																					<td >94.48</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 9 :
Angka Partisipasi Murni SD</td>
																					<td >101.35</td>
																					<td >101.45</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 10 :
Angka Partisipasi Murni SMP</td>
																					<td >97.73</td>
																					<td >97.93</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 11 :
APK SD</td>
																					<td >59.25</td>
																					<td >62.21</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 12 :
APK SMP</td>
																					<td >101.73</td>
																					<td >101.83</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Pendidikan Dasar </td>
																					<td >Indikator Program 1 :
Sekolah pendidikan Dasar kondisi Bangunan baik </td>
																					<td >14.79%</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >17.75%</td>
																					<td >105571360464.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >19.23%</td>
																					<td >105571360464.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.19%</td>
																					<td >116960664997.59</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.19%</td>
																					<td >123044958790.77</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Rasio ketersediaan sekolah/penduduk usia sekolah pendidikan dasar </td>
																					<td >56.30</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >58.55</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >59.68</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >61.93</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >61.93</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Angka Putus Sekolah (APS) SD </td>
																					<td >0.05</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.03</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.02</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.00</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.00</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Angka Putus Sekolah (APS) SMP </td>
																					<td >0.03</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.03</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >-0.00</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >-0.00</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >-0.00</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Angka Melanjutkan (AM) dari SD ke SMP/MTs </td>
																					<td >100,29</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100,49</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100,79</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100,79</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 6 :
Angka Melanjutkan (AM) dari SMP ke SMA/SMK/MA </td>
																					<td >88,69</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >88,87</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >88,96</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >89,13</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >89,13</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 7 :
Angka Partisipasi Sekolah SD</td>
																					<td >100.00</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.20</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.30</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.50</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.50</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 8 :
Angka Partisipasi Sekolah SMP</td>
																					<td >93.73</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95.23</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >95.98</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >97.47</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >97.47</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 9 :
Angka Partisipasi Murni SD</td>
																					<td >101.35</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >101.55</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >101.65</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >101.86</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >101.86</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 10 :
Angka Partisipasi Murni SMP</td>
																					<td >97.73</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.12</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.32</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.71</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >98.71</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 11 :
APK SD</td>
																					<td >59.25</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.18</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >68.14</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.06</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.06</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 12 :
APK SMP</td>
																					<td >101.73</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >101.93</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >102.04</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >102.23865</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >102.24</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 :
Program Pendidikan Anak Usia Dini</td>
																					<td >Indikator Program 1 :
Persentase PAUD yang terakreditasi</td>
																					<td >40.48%</td>
																					<td >42.50%</td>
																					<td >22003900000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >44.52%</td>
																					<td >22003900000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >46.55%</td>
																					<td >23172307090.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.60%</td>
																					<td >25672194000.89</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.60%</td>
																					<td >27007661532.82</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program Pendidikan non formal</td>
																					<td >Indikator Program 1 :
Angka Partisipasi Sekolah Paket A</td>
																					<td >3.32</td>
																					<td >3.10</td>
																					<td >50000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Angka Partisipasi Sekolah Paket B</td>
																					<td >67.16</td>
																					<td >66.80</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 7 :
Program Kesetaraan</td>
																					<td >Indikator Program 1 :
Angka Partisipasi Sekolah Paket A</td>
																					<td >3.32</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.90</td>
																					<td >52655000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.70</td>
																					<td >55432024.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.30</td>
																					<td >61370169.68</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2.2999999999999998</td>
																					<td >61370170.00</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Angka Partisipasi Sekolah Paket B</td>
																					<td >67.16</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >66.50</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >66.20</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.50</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.5</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 3 : Terwujudnya penanggulangulangan PMKS serta Pemberdayaan Perempuan dan Perlindungan anak</td>
																					<td >Indikator Tujuan 1:
Angka Kemiskinan</td>
																					<td >9.76</td>
																					<td >9,74-9,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9,18-8,94</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,89-8,52</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Indeks Pembangunan Gender*</td>
																					<td >94.4</td>
																					<td >94.45</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >94.49</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >94.54</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 3:
Indeks Pemberdayaan Gender*</td>
																					<td >68.7</td>
																					<td >68.73</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >68.77</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >68.80</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatnya Pengarusutamaan Gender dan perlindungan anak</td>
																					<td >Indikator Sasaran 1 :
Persentase Perempuan dan Anak Korban Tindak Kekerasan </td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Persentase kebijakan pelaksanaan PUG yang dihasikan</td>
																					<td >1 Kebijakan</td>
																					<td >1 Kebijakan</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 Kebijakan</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 Kebijakan</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 Kebijakan</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 Kebijakan</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 Persentase Perempuan Kepala Keluarga yang meningkat Ekonomi Keluarganya</td>
																					<td >0.37</td>
																					<td >7.0000000000000007E-2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.0000000000000007E-2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.0000000000000007E-2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.0000000000000007E-2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.0000000000000007E-2</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 4 :
Kabupaten Layak Anak</td>
																					<td >500</td>
																					<td >500</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >525</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >550</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >600</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >600</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Penguatan Kelembagaan PUG dan Anak</td>
																					<td >Indikator Program 1 :
Persentase OPD Responsif Gender</td>
																					<td >9.68%</td>
																					<td >6.45%</td>
																					<td >220000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >17.74%</td>
																					<td >231682000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >27.42%</td>
																					<td >243900908.68</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.58%</td>
																					<td >270028746.60</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >96.77%</td>
																					<td >270028747.00</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Peningkatan Kualitas Hidup dan Perlindungan Perempuan dan Anak
</td>
																					<td >Indikator Program 1 :
Persentase Pengaduan tindak kekerasan perempuan dan anak yang ditangani </td>
																					<td >100%</td>
																					<td >100%</td>
																					<td >188000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >197982800.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >208424412.87</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >230751838.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >230751838.00</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 : Persentase kecamatan yang telah membentuk forum anak dan Sekolah Ramah Anak</td>
																					<td >3.85%</td>
																					<td >15.38%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11.54%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11.54%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >19.23%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >69.23%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 2 :
Meningkatnya kualitas penanggulangan kemiskinan dan penanggulangan Penyandang Masalah Kesejahteraan Sosial</td>
																					<td >Indikator Sasaran 1 :
Persentase Pelayananan Penyandang Masalah Kesejahteraan Sosial (PMKS)</td>
																					<td >1.96% (115.190 PMKS)</td>
																					<td >0.12%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.17%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.21%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.24%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.95%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Pemberdayaan Fakir Miskin, Komunitas Adat Terpencil (KAT) dan Penyandang Masalah Kesejahteraan Sosial (PMKS) Lainnya</td>
																					<td >Indikator Program 1 :
Persentase PMKS yang Menerima Program Pemberdayaan Sosial Melalui Kelompok Usaha Bersama (KUBE) atau Kelompok Sosial Sejenisnya</td>
																					<td >1.16%</td>
																					<td >0.07%</td>
																					<td >138500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.06%</td>
																					<td >145854350.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.08%</td>
																					<td >153546708.42</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.08%</td>
																					<td >169995370.02</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.36%</td>
																					<td >169995370.02</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Jaminan Sosial</td>
																					<td >Indikator Program 1 :
Persentase Penyandang Masalah Kesejahteraan Sosial yang menerima Jaminan Sosial</td>
																					<td >70.78%</td>
																					<td >87.46%</td>
																					<td >1850000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >87.46%</td>
																					<td >1948235000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >87.46%</td>
																					<td >2050984913.90</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >87.46%</td>
																					<td >2270696278.19</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >87.46%</td>
																					<td >2270696278.19</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program Perlindungan Sosial
</td>
																					<td >Indikator Program 1 :
Persentase Korban Bencana Alam dan Sosial yang Terpenuhi Kebutuhan Dasarnya pada saat dan Setelah Tanggap Darurat Bencana</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td >200000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >210620000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >210620000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >245480678.72</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >245480678.72</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Pelayanan dan Rehabilitasi Kesejahteraan Sosial</td>
																					<td >Indikator Program 1 :
Persentase Penyandang Disabilitas yang menerima Bantuan Kebutuhan Dasar</td>
																					<td >4.66%</td>
																					<td >0.25%</td>
																					<td >803500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.98%</td>
																					<td >846165850.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.98%</td>
																					<td >890792636.93</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.47%</td>
																					<td >986218626.77</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td >986218626.77</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase Tuna Sosial yang Terpenuhi Kebutuhan Dasarnya </td>
																					<td >2.13%</td>
																					<td >2.13%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.94%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.38%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.38%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >19.89%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase Anak Terlantar yang Terpenuhi Kebutuhan Dasarnya
</td>
																					<td >21.95%</td>
																					<td >9.76%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >14.63%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >14.63%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >17.07%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.17%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase Lanjut Usia yang Terpenuhi Kebutuhan Dasarnya </td>
																					<td >0.83%</td>
																					<td >0.07%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.13%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.13%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.20%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.85%</td>
																					<td ></td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 :
Program Pemberdayaan Kelembagaan Sosial</td>
																					<td >Indikator Program 1 :
Persentase Potensi Sumber kesejahteraan sosial yang aktif</td>
																					<td >50.00%</td>
																					<td >50.00%</td>
																					<td >200000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >58.33%</td>
																					<td >210620000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >58.33%</td>
																					<td >221728098.80</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >58.33%</td>
																					<td >245480678.72</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >58.33%</td>
																					<td >245480678.72</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program Ketahanan Keluarga dan Kesejahteraan Keluarga</td>
																					<td >Indikator Program 1 :
Persentase Perempuan Yang Mendapatkan Pemberdayaan Dalam Peningkatan Ekonomi Keluarga</td>
																					<td >7.78%</td>
																					<td >1.48%</td>
																					<td >1050000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.67%</td>
																					<td >1105755000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.70%</td>
																					<td >1164072518.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.67%</td>
																					<td >1288773563.30</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8.19%</td>
																					<td >1288773563.30</td>
																					<td >DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																				</tr>
																				<tr>
																					<td colspan="23" >MISI 2 : Menguatkan norma agama dalam tatanan kehidupan sosial masyarakat dan pemerintahan </td>

																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 1 : Terwujudnya kehidupan yang agamis di Kabupaten Sumedang </td>
																					<td >Indeks Kerukunan Umat Beragama</td>
																					<td >72.2</td>
																					<td >72.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.5</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Menguatnya kondisi kehidupan kerukunan umat beragama untuk meningkatkan rasa toleransi dan saling pengertian intra dan antara para pemeluk agama dalam menciptakan kehidupan yang berlandaskan norma agama</td>
																					<td >Indikator Sasaran 1 :
Indeks Kerukunan Umat Beragama</td>
																					<td >72.2</td>
																					<td >72.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.5</td>
																					<td ></td>
																					<td >KANTOR KESATUAN BANGSA DAN POLITIK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Produk hukum daerah yang terbentuk (jumlah) </td>
																					<td >NA</td>
																					<td >5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >20</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
Persentase Penegakan Perda </td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >SATUAN POLISI PAMONG PRAJA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 : Program Kerukunan Umat Beragama</td>
																					<td >Indikator Program 1 :
Jumlah Konflik Sara dan Keagamaan</td>
																					<td >0</td>
																					<td >0</td>
																					<td >0.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0</td>
																					<td >500000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0</td>
																					<td >526370000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0</td>
																					<td >582757284.98</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0</td>
																					<td >582757284.98</td>
																					<td >KANTOR KESATUAN BANGSA DAN POLITIK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Penataan Peraturan Perundang-undangan
</td>
																					<td >Indikator Program 1 :
Cakupan produk hukum yang ditetapkan </td>
																					<td ></td>
																					<td >100%</td>
																					<td >0.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >1860000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >1958096400.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2167857100.11</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2167857100.11</td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program pemeliharaan ketentraman dan ketertiban masyarakat</td>
																					<td >Indikator Program 1 :
Persentase penegakan peraturan daerah</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td >495000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >521284500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >548777044.53</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >607564679.84</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >607564679.84</td>
																					<td >SATPOL PP</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Sasaran 2:
Penguatan pendidikan karakter berbasis pendekatan keagamaan bagi siswa usia pendidikan dasar</td>
																					<td >Indikator Sasaran 1 :
Persentase siswa bersertifikat Diniyah*</td>
																					<td ></td>
																					<td >10%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >30%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >60%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program penyelenggaraan pendidikan wajib diniyah kabupaten</td>
																					<td >Indikator Program 1 :
Persentase siswa yang berpartisipasi aktif dalam pendidikan diniyah</td>
																					<td ></td>
																					<td >-</td>
																					<td >0.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >5000000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >5263700000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >5827572849.76</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >5827572849.76</td>
																					<td >DINAS PENDIDIKAN</td>
																				</tr>
																				<tr>
																					<td colspan="23" >MISI 3 : Mengembangkan wilayah ekonomi didukung dengan peningkatan infrastruktur, serta penguatan budaya dan kearifan lokal</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 1 :
Terwujudnya pembangunan Infrastruktur yang mendukung percepatan pengembangan wilayah ekonomi</td>
																					<td >Persentase panjang jaringan jalan dalam kondisi Mantap</td>
																					<td >66.30%</td>
																					<td >68.35%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70.41%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.53%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatnya kualitas dan kuantitas infrastruktur jalan untuk meningkatkan aksesibilitas dan konektivitas daerah</td>
																					<td >Indikator Sasaran 1 :
Persentase panjang jaringan jalan dalam kondisi Mantap</td>
																					<td >66.30%</td>
																					<td >68.35%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70.41%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.53%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td ></td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Persentase Ketersediaan Rambu-rambu</td>
																					<td >4.75%</td>
																					<td >6.07%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7.38%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8.70%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11.33%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11.33%</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
Persentase Ketersediaan Penerangan Jalan Umum</td>
																					<td >26.88%</td>
																					<td >31.82%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33.79%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >37.74%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >42.34%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >42.34%</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Penanganan Jalan dan Jembatan</td>
																					<td >Indikator Program 1 :
Persentase tingkat kondisi jalan kabupaten/kota baik dan sedang </td>
																					<td >66.30%</td>
																					<td >68.35%</td>
																					<td >95730015000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70.41%</td>
																					<td >100813278796.50</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.53%</td>
																					<td >106130171120.23</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td >117499345282.04</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76.15%</td>
																					<td >117499345282.04</td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Pembangunan, Rehabilitasi dan Pemeliharaan Sarana Prasarana Perhubungan
</td>
																					<td >Indikator Program 1 :
Jumlah Penerangan Jalan Umum</td>
																					<td >4.086 titik</td>
																					<td >750</td>
																					<td >8100000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >300</td>
																					<td >8530110000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >600</td>
																					<td >8979988001.40</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100</td>
																					<td >9941967488.30</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6436</td>
																					<td >9941967488.30</td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Pemasangan Rambu Rambu lalu lintas</td>
																					<td >722</td>
																					<td >200</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >200</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >200</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >200</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1722</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 2 :
Tersedianya sistem transportasi yang dapat mendukung mobilitas masyarakat</td>
																					<td >Indikator Sasaran 1 :
Cakupan trayek angkutan umum</td>
																					<td >58.45%</td>
																					<td >59.85%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >61.24%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62.64%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.43%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.43%</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Rata-rata peningkatan penumpang angkutan umum</td>
																					<td >37.45%</td>
																					<td >38.34%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >39.24%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >40.13%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >41.92%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >41.92%</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Pelayanan Bidang Perhubungan, Pengawasan, Pengendalian dan Pengamanan Lalu Lintas Angkutan Jalan
</td>
																					<td >Indikator Program 1 :
Cakupan Trayek Angkutan Umum;</td>
																					<td >58.45%</td>
																					<td >59.85%</td>
																					<td >607500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >61.24%</td>
																					<td >639758250.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62.64%</td>
																					<td >673499100.11</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.43%</td>
																					<td >745647561.62</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65.43%</td>
																					<td >745647561.62</td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Rata-rata Peningkatan Penumpang Angkutan Umum;</td>
																					<td >37.45%</td>
																					<td >38.34%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >39.24%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >40.13%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >41.92%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >41.92%</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Peningkatan jumlah KIR angkutan umum</td>
																					<td >9.396 unit</td>
																					<td >10.000 unit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10.100 unit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10.200 unit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10.400 Unit</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10.400 Unit</td>
																					<td ></td>
																					<td >DINAS PERHUBUNGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 2 : Terwujudnya pengembangan wilayah ekonomi dengan mendorong peningkatan produktivitas komoditas unggulan</td>
																					<td >Indikator Tujuan 1 :
Nilai Tukar Petani</td>
																					<td >108.39</td>
																					<td >108.4</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >108.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >108.6</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >108.8</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >108.8</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Angka Kemiskinan</td>
																					<td >9.76</td>
																					<td >9,74-9,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9,18-8,94</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,89-8,52</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatnya produktivitas komoditas unggulan daerah</td>
																					<td >Indikator Sasaran 1 :
Rasio jaringan irigasi</td>
																					<td >33.25</td>
																					<td >33.630000000000003</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34.18</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34.61</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35.76</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35.76</td>
																					<td ></td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Persentase daerah irigasi dalam kondisi baik</td>
																					<td >49%</td>
																					<td >49.69%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.60%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >51.57%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >53.68%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >53.68%</td>
																					<td ></td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
Pertumbuhan Sektor Pertanian </td>
																					<td >6.79%</td>
																					<td >6.80%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.81%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.82%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.84%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.84%</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Pengembangan dan Pengelolaan Jaringan Irigasi, Rawa, dan Jaringan Pengairan</td>
																					<td >Indikator Program 1 :
Panjang Jaringan Irigasi Kabupaten dalam kondisi baik</td>
																					<td >883.90</td>
																					<td >893.90</td>
																					<td >26929497000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >908.56</td>
																					<td >28359453290.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >919.98</td>
																					<td >29855130857.25</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >950.47</td>
																					<td >33053356006.21</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >950.47</td>
																					<td >33053356006.21</td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Peningkatan Produksi hasil peternakan </td>
																					<td >Indikator Program 1 :
Persentase Peningkatan populasi ternak</td>
																					<td >0.63</td>
																					<td >0.34</td>
																					<td >2309000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.34</td>
																					<td >2431607900.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.34</td>
																					<td >2559850900.65</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.34</td>
																					<td >2834074435.86</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.34</td>
																					<td >2834074435.86</td>
																					<td >DINAS PERIKANAN DAN PETERNAKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program peningkatan pengelolaan dan pemasaran hasil produksi peternakan</td>
																					<td >Indikator Program 1 :
Persentase pertambahan unit usaha peternakan</td>
																					<td >15%</td>
																					<td >25%</td>
																					<td >132500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25%</td>
																					<td >139535750.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25%</td>
																					<td >146894865.46</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25%</td>
																					<td >162630949.65</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25%</td>
																					<td >162630949.65</td>
																					<td >DINAS PERIKANAN DAN PETERNAKAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program peningkatan produksi pertanian/perkebunan</td>
																					<td >Indikator Program 1 :
Jumlah produksi Tanaman Pangan </td>
																					<td >860.862 ton</td>
																					<td >860862</td>
																					<td >2650000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >860862</td>
																					<td >2790715000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >860862</td>
																					<td >2937897309.10</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >860862</td>
																					<td >3252618993.09</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >860862</td>
																					<td >3252618993.09</td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Jumlah produksi Hortikultura </td>
																					<td >62.413 ton</td>
																					<td >62413</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62413</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62413</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62413</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >62413</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Jumlah Produksi Perkebunan</td>
																					<td >6.436,69 ton</td>
																					<td >6436.69</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6436.69</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6436.69</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6436.69</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6436.69</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 :
Program Peningkatan Penerapan Teknologi Pertanian/Perkebunan</td>
																					<td >Indikator Program 1 :
Cakupan Percepatan Olah Lahan dan Tanam Terhadap Luas Areal Tanam </td>
																					<td >30%</td>
																					<td >30%</td>
																					<td >22466174000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >31.59%</td>
																					<td >23659127839.40</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33.26%</td>
																					<td >24906910241.65</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >36.82%</td>
																					<td >27575058209.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >36.82%</td>
																					<td >27575058209.20</td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Luas Lahan Yang Terairi</td>
																					<td >3.750 hektar</td>
																					<td >3750</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3949.125</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4157.44134375</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4602.8283163647</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4602.8283163647</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td > Indikator Program 3 :
Ketersediaan Jalan Pertanian</td>
																					<td >4 km</td>
																					<td >4</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.2124</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.43607844</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.9113158235997</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.9113158235997</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program Pengolahan dan Pemasaran hasil pertanian/perkebunan</td>
																					<td >Indikator Program 1 :
Cakupan Kelompok Tani Pengolah Hasil Pertanian</td>
																					<td >20%</td>
																					<td >20%</td>
																					<td >1300000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >21.06%</td>
																					<td >1369030000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.17%</td>
																					<td >1441232642.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24.55%</td>
																					<td >1595624411.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24.55%</td>
																					<td >1595624411.70</td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 7 :
Program Pemberdayaan Penyuluhan Pertanian/Perkebunan Lapangan</td>
																					<td >Indikator Program 1 :
Cakupan kelompok tani yang mendapatkan Pelayanan Penyuluhan Pertanian</td>
																					<td >20%</td>
																					<td >20%</td>
																					<td >1593542000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >21.06%</td>
																					<td >1678159080.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.17%</td>
																					<td >1766665190.09</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24.55%</td>
																					<td >1955918858.67</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24.55%</td>
																					<td >1955918858.67</td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Sasaran 2:
Menjamin Ketahanan Pangan Daerah </td>
																					<td >Indikator Sasaran 1:
Skor Pola Pangan Harapan</td>
																					<td >86.10</td>
																					<td >87.30</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >88.50</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >89.60</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92.50</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92.50</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1:
Program Peningkatan Ketahanan Pangan Pertanian/Perkebunan</td>
																					<td >Indikator Program 1 :
Ketersediaan Pangan Utama</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td >1645000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >1732349500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >1823713612.63</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2019078582.50</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2019078582.50</td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Ketersediaan energi dan protein per kapita</td>
																					<td >93%</td>
																					<td >93%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93%</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Pembinaan keamanan pangan segar</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 3 :
Terwujudnya kota yang berwawasan lingkungan sebagai Wilayah Perkotaan yang berkelanjutan dan lestari</td>
																					<td >Indikator Tujuan 1:
Indeks Kualitas Lingkungan Hidup</td>
																					<td >53.93</td>
																					<td >54.04</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >54.15</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >54.26</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >54.48</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >54.48</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Indeks Risiko Bencana</td>
																					<td >162</td>
																					<td >162</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >161.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >161</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >160</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >160</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatknya pengelolaan lingkungan hidup sesuai dengan prinsip-prinsip pembangunan berkelanjutan</td>
																					<td >Indikator Sasaran 1 :
Persentase penanganan sampah perkotaan</td>
																					<td >38%</td>
																					<td >37.34%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34.96%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34.54%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33.58%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33.58%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Indeks kualitas air</td>
																					<td >42.46</td>
																					<td >42,66</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >42,86</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >43,06</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >43,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >43,46</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 :
Indeks kualitas udara</td>
																					<td >69.88</td>
																					<td >70,03</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,18</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,33</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,63</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,63</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 4 :
Indeks Tutupan Lahan</td>
																					<td >50,57</td>
																					<td >50,58</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50,60</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50,61</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50,62</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 5 :
Persentase kesesuaian peruntukan lahan dengan tata ruang</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 6 :
Persentase pengurangan sampah</td>
																					<td >3,87%</td>
																					<td >3,90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,30%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,77%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,15%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,15</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 7 : Persentase lingkungan yang tertata</td>
																					<td >0.2</td>
																					<td >11.25%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >12.50%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >12.50%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 8 :
Persentase Rumah Tangga Bersanitasi</td>
																					<td >55%</td>
																					<td >55.15%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >55.30%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >55.45%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >55.75%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >55.75%</td>
																					<td ></td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 9 :
Persentase Penduduk Berakses Air Minum</td>
																					<td >0.7</td>
																					<td >70.45%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >71.05%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >71.65%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.70%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72.70%</td>
																					<td ></td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 10 :
Rasio Rumah Layak Huni </td>
																					<td >80%</td>
																					<td >80.05%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.11%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.17%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.28%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.28%</td>
																					<td ></td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Pengendalian Pencemaran dan Perusakan Lingkungan Hidup</td>
																					<td >Indikator Program 1 :
Persentase Pembinaan dan Pengawasan terkait ketaatan penanggung jawab usaha dan/atau kegiatan yang diawasi ketaatannya terhadap izin lingkungan, izin PPLH dan PUU LH d yang diterbitkan oleh Pemerintah Daerah kabupaten/kota</td>
																					<td >26.90%</td>
																					<td >20.90%</td>
																					<td >250000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >21.50%</td>
																					<td >263275000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >22.40%</td>
																					<td >277160123.50</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >27.00%</td>
																					<td >306850848.40</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.10%</td>
																					<td >306850848.40</td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase Penyelesaian sengketa lingkungan hidup</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase Akreditasi Laboratorium Lingkungan Hidup;</td>
																					<td >15%</td>
																					<td >30%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase Sungai dipantau kualitas airnya</td>
																					<td >80%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Persentase kecukupan instrumen pengelolaan lingkungan</td>
																					<td >100%</td>
																					<td >97%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 6 :
Persentase masyarakat/kelompok masyarakat / lembaga yang berperan aktif dalam pengembangan kapasitas lingkungan</td>
																					<td >2.93%</td>
																					<td >3.28%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.28%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.28%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.28%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.86%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 7 :
Persentase titik pantau kualitas
udara</td>
																					<td >100%</td>
																					<td >74%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >81.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Pengembangan Kinerja Pengelolaan Persampahan</td>
																					<td >Indikator Program 1 :
Timbulan sampah yang ditangani</td>
																					<td >38 % (Perkotaan)</td>
																					<td >37,4 % (Perkotaan)</td>
																					<td >5123807000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34,96 % (Perkotaan)</td>
																					<td >5395881151.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >34,54 % (Perkotaan)</td>
																					<td >5680459923.64</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33,58 % (Perkotaan)</td>
																					<td >6288978100.04</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >33,58 %</td>
																					<td >6288978100.04</td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase jumlah sampah yang terkurangi melalui 3R</td>
																					<td >3,87%</td>
																					<td >0.70%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.80%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.10%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1,1 %</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase cakupan area pelayanan</td>
																					<td >5,38</td>
																					<td >3,90</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0,16</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0,16</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0,16</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,15</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase Operasionalisasi TPA/TPST/SPA di Kabupaten</td>
																					<td >68,53</td>
																					<td >69</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >69,33</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >69,67</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,67</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70,67</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Indeks kepuasan masyarakat</td>
																					<td >71,31</td>
																					<td >77</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >77,2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >77,5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 6 :
Persentase jumlah sampah yang terkurangi melalui 3R dan sektor informal</td>
																					<td >3,87</td>
																					<td >3,90</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,30</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,77</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,15</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,15</td>
																					<td ></td>
																					<td >DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program pengembangan dan penataan wilayah</td>
																					<td >Indikator Program 1 :
Persentase penataan lingkungan </td>
																					<td ></td>
																					<td >30</td>
																					<td >9129300000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >30</td>
																					<td >9614065830.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >20</td>
																					<td >10121111661.87</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10</td>
																					<td >11205333801.35</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td >11205333801.35</td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Jumlah Bangunan yang Memiliki Sertifikasi Laik Fungsi</td>
																					<td ></td>
																					<td >10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Penataan Ruang</td>
																					<td >Indikator Program 1 :
Persentase kesesuaian peruntukan lahan dengan rencana tata ruang wilayah</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td >2820000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2969742000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >3126366193.08</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >3461277570.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >3461277570.00</td>
																					<td >DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 :
Penyediaan dan Pengelolaan Air Baku</td>
																					<td >Indikator 1 :
Jumlah Sarana Air Minum yang terbangun</td>
																					<td >27</td>
																					<td >27</td>
																					<td >7422499442.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >27</td>
																					<td >7816634162.37</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >27</td>
																					<td >8228883448.09</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >27</td>
																					<td >9110401004.23</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >162</td>
																					<td >9110401004.23</td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program Penyediaan Sarana dan Pengelolaan Limbah Domestik</td>
																					<td >Indikator 1 :
Jumlah Sanitasi yang terbangun</td>
																					<td ></td>
																					<td ></td>
																					<td >-</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9</td>
																					<td >1000000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9</td>
																					<td >1052740000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9</td>
																					<td >1165514569.95</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >69</td>
																					<td >1165514569.95</td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 7 :
Program Penanganan dan Pengembangan Perumahan dan Kawasan Permukiman
</td>
																					<td >Indikator 1 :
Cakupan Ketersediaan Rumah Layak Huni</td>
																					<td >80%</td>
																					<td >80.05%</td>
																					<td >4129000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.11%</td>
																					<td >4348249900.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.17%</td>
																					<td >4577576599.73</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.28%</td>
																					<td >5067948612.25</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80.28%</td>
																					<td >5067948612.25</td>
																					<td >DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 2 :
Pengurangan indeks resiko bencana </td>
																					<td >Indikator Sasaran 1 :
Penurunan Indeks Risiko bencana</td>
																					<td >162</td>
																					<td >162</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >161.5</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >161</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >160</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >160</td>
																					<td ></td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Pencegahan Dini dan Penanggulangan Korban Bencana Alam</td>
																					<td >Indikator Program 1 :
Persentase Peningkatan Jumlah Desa/Kelurahan Rawan Bencana yang Mendapatkan Informasi Peringatan Dini Bencana</td>
																					<td >276 Desa</td>
																					<td >276 Desa</td>
																					<td >7270752000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >276 Desa</td>
																					<td >7656828931.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >276 Desa</td>
																					<td >8060650089.03</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >276 Desa</td>
																					<td >8924145678.95</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >276 Desa</td>
																					<td >8924145678.95</td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase Desa/Kelurahan Tangguh Bencana</td>
																					<td >5 Desa</td>
																					<td >5 Desa</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 Desa</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 Desa</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 Desa</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 Desa</td>
																					<td ></td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Respons Time Tanggap Darurat</td>
																					<td >24 Jam </td>
																					<td >24 Jam </td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24 Jam </td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24 Jam </td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24 Jam </td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >24 Jam </td>
																					<td ></td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase Korban Bencana yang diberikan bantuan</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Prosentase Rencana Pemulihan Pasca Bencana Yang Berhasil Di Realisasikan
</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td >BADAN PENANGGULANGAN BENCANA DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 4 :Terwujudnya Sumedang sebagai tujuan wisata yang berdaya saing</td>
																					<td >Indikator Tujuan 1 :
PAD Sektor Pariwisata (Rp)</td>
																					<td ></td>
																					<td >15000000000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15450000000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15913500000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Angka Kemiskinan</td>
																					<td >9.76</td>
																					<td >9,74-9,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9,18-8,94</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,89-8,52</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 :
Meningkatnya pelestarian budaya, situs, sejarah, seni dan pengembangan destinasi wisata untuk mewujudkan Sumedang sebagai tujuan wisata</td>
																					<td >Indikator Sasaran 1 :
Jumlah kunjungan wisatawan</td>
																					<td >432569</td>
																					<td >519083</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >622900</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >747479</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1076368</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
PAD sektor pariwisata</td>
																					<td ></td>
																					<td >15000000000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15450000000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15913500000</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >#VALUE!</td>
																					<td ></td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program pengelolaan kekayaan budaya</td>
																					<td >Indikator Program 1 :
Jumlah seni budaya yang dilindungi, dikembangkan dan dimanfaatkan</td>
																					<td >6</td>
																					<td >11</td>
																					<td >350000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11</td>
																					<td >368585000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11</td>
																					<td >388024172.90</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11</td>
																					<td >429591187.77</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >11</td>
																					<td >429591187.77</td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program pengembangan Destinasi pariwisata</td>
																					<td >Indikator Program 1 :
Jumlah Destinasi Wisata yang dkembangkan dan dipromosikan</td>
																					<td >n.a</td>
																					<td >4</td>
																					<td >3944231000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program Pembangunan Kepariwisataan</td>
																					<td >Indikator Program 1 :
Jumlah Destinasi Wisata yang dkembangkan dan dipromosikan</td>
																					<td >n.a</td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2</td>
																					<td >4153669666.10</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2</td>
																					<td >4372734204.29</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >2</td>
																					<td >4841162514.61</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >12</td>
																					<td >4841162514.61</td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td colspan="23" >MISI 4 : Menata birokrasi pemerintah yang responsif dan bertanggung jawab secara profesional dalam pelayanan masyarakat.</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 1: Terwujudnya Birokrasi yang bersih dan bebas KKN
</td>
																					<td >Opini BPK</td>
																					<td >WTP</td>
																					<td >WTP</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1:
Meningkatnya kinerja keuangan daerah yang transparan dan akuntabel</td>
																					<td >Indikator Sasaran 1:
Opini BPK</td>
																					<td >WTP</td>
																					<td >WTP</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >WTP</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >WTP</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2:
Persentase temuan yang ditindaklanjuti</td>
																					<td >75%</td>
																					<td >75%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >85%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >85%</td>
																					<td ></td>
																					<td >INSPEKTORAT KABUPATEN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3:
Tingkat maturitas SPIP</td>
																					<td >3,1</td>
																					<td >3,2</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3,3</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3,5</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >4</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >4</td>
																					<td ></td>
																					<td >INSPEKTORAT KABUPATEN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 4 :
Persentase PAD terhadap pendapatan</td>
																					<td >18,04%</td>
																					<td >18.48%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >20.20%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >21%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >22.74%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >22.74%</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 : Program Peningkatan dan Pengembangan Pengelolaan Keuangan Daerah</td>
																					<td >Indikator Program 1 : Tingkat akurasi dokumen penganggaran</td>
																					<td >90%</td>
																					<td >91%</td>
																					<td >6661276600.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92%</td>
																					<td >7014990387.46</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >93%</td>
																					<td >7384960980.49</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >8176073504.66</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >8176073504.66</td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 : Cakupan dokumen pengajuan pembayaran yang sesuai dengan aturan</td>
																					<td >90%</td>
																					<td >90.50%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >91%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92.50%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 : Tingkat Kesesuaian Laporan Kegiatan OPD dan LKPD dengan standar akuntansi pemerintah</td>
																					<td >80%</td>
																					<td >85%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 : Tingkat ketepatan waktu penyampaian LK OPD</td>
																					<td >80%</td>
																					<td >85%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >92%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 : Keakuratan Penatausahaan Aset (Materealitas)</td>
																					<td >86%</td>
																					<td >87%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >88%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >89%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >91%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >91%</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Penataan dan Peningkatan Sistem Pengawasan Internal dan Pengendalian Pelaksanaan Kebijakan KDH</td>
																					<td >Indikator Program 1 :
Persentase penyelesaian tindaklanjut hasil pemeriksaan Inspektorat Kabupaten Sumedang</td>
																					<td >80%</td>
																					<td >85%</td>
																					<td >3645000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td >3838549500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td >4040994600.63</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >4473885369.74</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >2236942684.87</td>
																					<td >INSPEKTORAT KABUPATEN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 : Program Peningkatan Profesionalisme Tenaga Pemeriksa dan Aparatur Pengawasan</td>
																					<td >Indikator Program 1 : Tingkat IACM</td>
																					<td >Level 3 Dengan Catatan (DC)</td>
																					<td >Level 3 DC</td>
																					<td >210000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >Level 3 DC</td>
																					<td >221151000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >Level 3 Penuh</td>
																					<td >232814503.74</td>
																					<td ></td>
																					<td ></td>
																					<td >Level 3 Penuh</td>
																					<td >257754712.66</td>
																					<td ></td>
																					<td ></td>
																					<td >Level 3 Penuh</td>
																					<td >257754712.66</td>
																					<td >INSPEKTORAT KABUPATEN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 : Program Penegakan Integritas</td>
																					<td >Indikator Program 1 : Cakupan zona integritas</td>
																					<td >75%</td>
																					<td >80%</td>
																					<td >295000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >85%</td>
																					<td >310664500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td >327048945.73</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >362084001.12</td>
																					<td ></td>
																					<td ></td>
																					<td >95%</td>
																					<td >362084001.12</td>
																					<td >INSPEKTORAT KABUPATEN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 5 : Program Peningkatan dan Pengembangan Pengelolaan Pendapatan Daerah</td>
																					<td >Indikator Program 1 : Nilai survei kepuasan masyarakat pelayanan pajak daerah</td>
																					<td >65%</td>
																					<td >70%</td>
																					<td >10679212750.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70%</td>
																					<td >11246278947.03</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >75%</td>
																					<td >11839407698.69</td>
																					<td ></td>
																					<td ></td>
																					<td >80%</td>
																					<td >13107701970.51</td>
																					<td ></td>
																					<td ></td>
																					<td >80%</td>
																					<td >13107701970.51</td>
																					<td >BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Persentase potensi pajak daerah</td>
																					<td >0.6</td>
																					<td >0.65</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.65</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.7</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >0.8</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >0.8</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase rata-rata wajib pajak yang membayar sesuai ketentuan</td>
																					<td >0.7</td>
																					<td >0.75</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.7</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.85</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >0.85</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >0.85</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Cakupan regulasi PDRD yang disempurnakan</td>
																					<td >0</td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td ></td>
																					<td >BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 6 :
Program pemantapan pemerintahan dan pembangunan desa</td>
																					<td >Indikator Program 1 :
Persentase desa yang menerapkan administrasi pemerintahan desa sesuai aturan</td>
																					<td >0.64</td>
																					<td >0.71</td>
																					<td >812000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.78</td>
																					<td >855117200.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.86</td>
																					<td >900216081.13</td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td >996651555.62</td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td >996651555.62</td>
																					<td >DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 2:
Terwujudnya pelayanan publik yang berkualitas terhadap masyarakat</td>
																					<td >Indeks Kepuasan Masyarakat terhadap Pelayanan Publik (%)</td>
																					<td >79,17</td>
																					<td >80.05</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80,10</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80,15</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >80,25</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >80,25</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1:
Meningkatnya profesionalitas ASN</td>
																					<td >Indikator Sasaran 1:
Skor Lakip</td>
																					<td >B</td>
																					<td >BB</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >BB</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >BB</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >A</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >A</td>
																					<td ></td>
																					<td >INSPEKTORAT KABUPATEN, SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2:
IKM bidang pelayanan perizinan</td>
																					<td >79.75</td>
																					<td >81.25</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >82.75</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >84.25</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >87.25</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >87.25</td>
																					<td ></td>
																					<td >DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 3 : Nilai LPPD</td>
																					<td >3.5190000000000001</td>
																					<td >3.5190000000000001</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.5190000000000001</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >3.5190000000000001</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >3.5190000000000001</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >3.5190000000000001</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 4 : IKM Bidang Kependudukan</td>
																					<td >76</td>
																					<td >77</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78.5</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >80</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >80</td>
																					<td ></td>
																					<td >DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Administrasi Pemerintahan dan Penataan Organisasi Pemda</td>
																					<td >Indikator Program 1 :
Laporan penyelenggaran pemda yang sesuai dan tepat waktu
</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2525000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2658168500.00</td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td >2942924289.13</td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td >1565772555.24</td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Tingkat indeks Penilaian Mandiri Reformasi Birokrasi
</td>
																					<td >71</td>
																					<td >72</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >72</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >75</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >75</td>
																					<td >1535071132.59</td>
																					<td >SETDA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 3 :
Persentase koordinasi penyelenggaraan pemerintah daerah</td>
																					<td >2 kali per tahun dari 12 kali = 16%</td>
																					<td >50.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >50.00%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >66.67%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >1</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 4 :
Persentase peningkatan kualitas penyelenggaraan pemerintahan kecamatan dan kelurahan</td>
																					<td >0%</td>
																					<td >10%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >10%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >25%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >25%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 5 :
Persentase kelembagaan sesuai dengan urusan dan kewenangannya</td>
																					<td >80%</td>
																					<td >85%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >85%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >90%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 6 :
Cakupan OPD yang sudah memiliki dan menerapkan SOP dan standar pelayanan</td>
																					<td >40%</td>
																					<td >64%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >64%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >76%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 7 :
Tingkat ketepatan dan kesesuaian penyampaian laporan OPD terkait survei kepuasan masyarakat</td>
																					<td >50%</td>
																					<td >70%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >70%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >80%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 8 :
Persentase tertib administrasi kewilayahan</td>
																					<td >100%</td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 9 :
Persentase penegasan batas wilayah kecamatan dan kelurahan</td>
																					<td >0% dari jumlah penegasan batas wilayah (33)</td>
																					<td >6.06%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6.06%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9.09%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >15.15%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >15.15%</td>
																					<td ></td>
																					<td >SEKRETARIAT DAERAH</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program Peningkatan pelayanan perizinan</td>
																					<td >Indikator Program 1 :
Persentase izin yang terbit tepat waktu</td>
																					<td >NA</td>
																					<td >0.75</td>
																					<td >630984000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.76</td>
																					<td >664489250.40</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.77</td>
																					<td >699534413.47</td>
																					<td ></td>
																					<td ></td>
																					<td >0.85</td>
																					<td >774471902.92</td>
																					<td ></td>
																					<td ></td>
																					<td >0.85</td>
																					<td >774471902.92</td>
																					<td >DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3:
Program Penataan Administrasi Kependudukan</td>
																					<td >Indikator Program 1 :
Persentase layanan yang sesuai standar
manajemen mutu</td>
																					<td >n/a</td>
																					<td >100%</td>
																					<td >2770000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >2917087000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >100%</td>
																					<td >3070934168.38</td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td >3399907400.32</td>
																					<td ></td>
																					<td ></td>
																					<td >100%</td>
																					<td >3399907400.32</td>
																					<td >DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Pelayanan Administrasi Kependudukan</td>
																					<td >Indikator Program 1 :
Cakupan Kepemilikan Dokumen Kependudukan</td>
																					<td >81%</td>
																					<td >83%</td>
																					<td >240000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >84,5%</td>
																					<td >252744000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >86%</td>
																					<td >266073718.56</td>
																					<td ></td>
																					<td ></td>
																					<td >90%</td>
																					<td >294576814.47</td>
																					<td ></td>
																					<td ></td>
																					<td >90%</td>
																					<td >294576814.47</td>
																					<td >DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 :
Cakupan Kepemilikan Dokumen Catatan Sipil</td>
																					<td >74%</td>
																					<td >76%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >78%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >81%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >86%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >86%</td>
																					<td ></td>
																					<td >DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 2:
Tersedianya sistem pelayanan terpadu yang didukung oleh IT</td>
																					<td >Indikator Sasaran 1 :
Pelayanan publik berbasis IT</td>
																					<td >10 OPD</td>
																					<td >16</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >55</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >55</td>
																					<td ></td>
																					<td >DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program pengembangan komunikasi, informasi, media massa dan pemanfaatan teknologi informasi</td>
																					<td >Indikator Program 1 : Presentase perangkat daerah yang sudah menerapkan e-goverment/Aplikasi yang terintegrasi</td>
																					<td >0.18181818181818182</td>
																					<td >29.09%</td>
																					<td >3101000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >45.45%</td>
																					<td >3265663100.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >63.64%</td>
																					<td >3437894171.89</td>
																					<td ></td>
																					<td ></td>
																					<td >100.00%</td>
																					<td >3806177923.61</td>
																					<td ></td>
																					<td ></td>
																					<td >100.00%</td>
																					<td >3806177923.61</td>
																					<td >DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Program 2 : Presentase perangkat daerah yang sudah melaksanakan keterbukaan informasi publik</td>
																					<td >0.18181818181818182</td>
																					<td >29.09%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >45.45%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >63.64%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td ></td>
																					<td ></td>
																					<td >100.00%</td>
																					<td ></td>
																					<td >DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																				</tr>
																				<tr>
																					<td colspan="23">MISI 5 : Mengembangkan sarana prasarana dan sistem perekonomian yang mendukung kreativitas dan inovasi masyarakat Kabupaten Sumedang</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >TUJUAN 1:
Terwujudnya perekonomian Sumedang yang kreatif dan berdaya saing</td>
																					<td >Indikator Tujuan 1 :
Laju Pertumbuhan Ekonomi</td>
																					<td >6.34</td>
																					<td >5,94-6,97</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,07-7,04</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,20-7,12</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,40-7,29</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,40-7,29</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Angka Kemiskinan</td>
																					<td >9.76</td>
																					<td >9,74-9,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9,18-8,94</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,89-8,52</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1:
Meningkatnya kualitas sumberdaya manusia dari usaha mikro lokal</td>
																					<td >Indikator Sasaran 1:
Pertumbuhan sektor industri pengolahan (usaha mikro yang bergerak dalam industri pengolahan)</td>
																					<td >5.29%</td>
																					<td >5.30%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.32%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.34%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.36%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.36%</td>
																					<td ></td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2:
Pertumbuhan sektor Perdagangan</td>
																					<td >4.94%</td>
																					<td >4.95%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.97%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >4.99%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.02%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.02%</td>
																					<td ></td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program pengembangan industri kecil dan menengah</td>
																					<td >Indikator Program 1 :
Pertumbuhan jumlah IKM</td>
																					<td >0</td>
																					<td >240</td>
																					<td >300000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >240</td>
																					<td >315930000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >240</td>
																					<td >332592148.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >240</td>
																					<td >368221018.09</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1200</td>
																					<td >368221018.09</td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program peningkatan efisiensi perdagangan dalam negeri
</td>
																					<td >Indikator Program 2 :
Cakupan pelaku usaha perdagangan yang dibina</td>
																					<td >0</td>
																					<td >150 orang</td>
																					<td >725000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65 orang</td>
																					<td >763497500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65 orang</td>
																					<td >803764358.15</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >65 orang</td>
																					<td >889867460.37</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >310</td>
																					<td >889867460.37</td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 2:
Tersedianya Fasilitas pendukung wirausaha</td>
																					<td >Indikator Sasaran 1:
Persentase Koperasi aktif </td>
																					<td >72.01%</td>
																					<td >73.37%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.53%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >73.69%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.01%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >74.01%</td>
																					<td ></td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
Persentase pasar tradisional yang direvitalisasi
</td>
																					<td ></td>
																					<td >1 pasar</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 pasar</td>
																					<td ></td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program Penguatan Kelembagaan Koperasi</td>
																					<td >Indikator Program 1 :
Jumlah Koperasi aktif </td>
																					<td >423</td>
																					<td >436</td>
																					<td >485000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >450</td>
																					<td >510753500.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >454</td>
																					<td >537690639.59</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >458</td>
																					<td >595290645.90</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >458</td>
																					<td >595290645.90</td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program pengembangan lembaga ekonomi pedesaan</td>
																					<td >Indikator Program 1 :
Persentase lembaga ekonomi pedesaan yang aktif</td>
																					<td >35</td>
																					<td >43%</td>
																					<td >358312000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >36%</td>
																					<td >377338367.20</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >39%</td>
																					<td >397239192.69</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >45%</td>
																					<td >439793364.77</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >45%</td>
																					<td >439793364.77</td>
																					<td >DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Program pemberdayaan, penataan dan perlindungan pasar rakyat</td>
																					<td >Indikator Program 1 :
Jumlah pasar yang di revitalisasi</td>
																					<td ></td>
																					<td >1 pasar</td>
																					<td >1092500000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td >1150511750.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td >1211189739.70</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1 pasar</td>
																					<td >1340938207.53</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5 pasar</td>
																					<td >1340938207.53</td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 3 : Meningkatnya penanaman modal di Kabupaten Sumedang</td>
																					<td >Indikator Sasaran 1 : Jumlah nilai investasi di Sumedang</td>
																					<td >9966078815</td>
																					<td >7063682158</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7464857128</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8230032097</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9396382036</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9396382036</td>
																					<td ></td>
																					<td >DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program peningkatan penanaman modal daerah</td>
																					<td >Indikator Program 1 :
Persentase peningkatan jumlah investor</td>
																					<td >NA</td>
																					<td >0.1</td>
																					<td >770000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.1</td>
																					<td >810887000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.1</td>
																					<td >853653180.38</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.1</td>
																					<td >945100613.09</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >0.1</td>
																					<td >945100613.09</td>
																					<td >DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program peningkatan promosi dan kemitraan penanaman modal</td>
																					<td >Indikator Program 1 :
Persentase kerjasama penanaman modal yang ditindaklanjuti</td>
																					<td >NA</td>
																					<td >0</td>
																					<td >0.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >500000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >526370000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >582757284.98</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1</td>
																					<td >582757284.98</td>
																					<td >DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Tujuan 2:
Terwujudnya perluasan kesempatan kerja, pelatihan kerja serta sertifikasi keahlian sehingga mampu memenuhi kebutuhan lapangan kerja</td>
																					<td >Indikator Tujuan 1 :
Tingkat Pengangguran Terbuka</td>
																					<td >7.04%</td>
																					<td >7,41-6,45</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,29-6,38</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,17-6,30</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,97-6,14</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >6,97-6,14</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Tujuan 2:
Angka Kemiskinan</td>
																					<td >9.76</td>
																					<td >9,74-9,59</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9,18-8,94</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >8,89-8,52</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >7,87-7,46</td>
																					<td ></td>
																					<td ></td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >SASARAN 1 : Membuka lapangan kerja dan menciptakan tenaga kerja kompeten yang memenuhi kebutuhan pasar</td>
																					<td >Indikator Sasaran 1 :
Persentase Tenaga Kerja yang ditempatkan</td>
																					<td >16%</td>
																					<td >16%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td ></td>
																					<td >DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td ></td>
																					<td >Indikator Sasaran 2 :
jumlah wirausahawan </td>
																					<td ></td>
																					<td >1.000*</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.000*</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.000*</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >1.000*</td>
																					<td ></td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >5.000*</td>
																					<td ></td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 1 :
Program peningkatan kesempatan kerja</td>
																					<td >Indikator Program 1 :
cakupan tenaga kerja yang terdaftar yang ditempatkan</td>
																					<td >16%</td>
																					<td >16%</td>
																					<td >620000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td >652922000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td >687357106.28</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td >760990104.04</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >16%</td>
																					<td >760990104.04</td>
																					<td >DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 2 :
Program peningkatan kualitas dan produktivitas tenaga kerja</td>
																					<td >Indikator Program 1 :
Cakupan tenaga kerja yang bersertifikasi</td>
																					<td >10%</td>
																					<td >15%</td>
																					<td >2830046000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >20%</td>
																					<td >2980321442.60</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >25%</td>
																					<td >3137503595.48</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35%</td>
																					<td >3473608064.49</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >35%</td>
																					<td >3473608064.49</td>
																					<td >DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 3 :
Pengembangan kewirausahaan dan keunggulan kompetitif usaha kecil menengah
</td>
																					<td >Indikator Program 1 :
Peningkatan jumlah wirausaha dan usaha kecil menengah</td>
																					<td >15.467 UMKM</td>
																					<td >15.482 UMKM</td>
																					<td >1454000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15.502 UMKM</td>
																					<td >1531207400.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15.527 UMKM</td>
																					<td >1611963278.28</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15.592 UMKM</td>
																					<td >1784644534.32</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >15.592 UMKM</td>
																					<td >1784644534.32</td>
																					<td >DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																				</tr>
																				<tr>
																					<td ></td>
																					<td >Program 4 :
Program Pengembangan Ekonomi Kreatif
</td>
																					<td >Indikator Program 1 :
Jumlah Sektor Ekonomi Kreatif yang dikembangkan</td>
																					<td >9 SUBSEKTOR</td>
																					<td >9 SUBSEKTOR</td>
																					<td >400000000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9 SUBSEKTOR</td>
																					<td >421240000.00</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9 SUBSEKTOR</td>
																					<td >443456197.60</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9 SUBSEKTOR</td>
																					<td >490961357.45</td>
																					<td ><div class="label label-table label-danger">Belum disi</div></td>
																					<td ><div class="label label-table label-success">0%</div></td>
																					<td >9 SUBSEKTOR</td>
																					<td >490961357.45</td>
																					<td >DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																				</tr>
																			</table>
														
																		 	</div>
																		 	 	</div>
																		 	 	 	</div>
																		 	 	 	 	</div>