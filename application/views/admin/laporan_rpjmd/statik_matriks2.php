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
					<tr  style="text-align: center;">
						<th style="min-width:50px" rowspan="3" align="center" valign="midle" >Kode</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Misi/Tujuan/Sasaran Program Pembangunan Daerah</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle"> Indikator Kinerja (tujuan/impact/outcome)</th>
						<th style="min-width:50px"  rowspan="3" align="center" valign="midle">Kondisi Kinerja Awal RPJMD (Tahun 0)</th>
						<th style="min-width:50px" colspan="12" align="center" valign="midle">Capaian Kinerja Program dan Kerangka Pendanaan</th>
						<th style="min-width:50px" rowspan="3" align="center" valign="midle">Perangkat Daerah Penanggung Jawab</th>
					</tr>
					<tr>

						<th style="min-width:50px" colspan="2" align="center" valign="midle">2019</th>
						<th style="min-width:50px" colspan="2" align="center" valign="midle">2020</th>
						<th style="min-width:50px" colspan="2" align="center" valign="midle">2021</th>
						<th style="min-width:50px" colspan="2" align="center" valign="midle">2022</th>
						<th style="min-width:50px" colspan="2" align="center" valign="midle">2023</th>
						<th style="min-width:50px" colspan="2" align="center" valign="midle">Kondisi Kinerja pada akhir periode RPJMD</th>
					</tr>
					<tr>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
						<th style="min-width:50px" align="center" valign="midle">target</th>
						<th style="min-width:50px" align="center" valign="midle">Rp</th>
					</tr>
					<tr>
						<th style="min-width:50px" align="center" valign="midle">1</th>
						<th style="min-width:50px" align="center" valign="midle">2</th>
						<th style="min-width:50px" align="center" valign="midle" >3</th>
						<th style="min-width:50px" align="center" valign="midle">4</th>
						<th style="min-width:50px" align="center" valign="midle">5</th>
						<th style="min-width:50px" align="center" valign="midle">6</th>
						<th style="min-width:50px" align="center" valign="midle">7</th>
						<th style="min-width:50px" align="center" valign="midle">8</th>
						<th style="min-width:50px" align="center" valign="midle">9</th>
						<th style="min-width:50px" align="center" valign="midle">10</th>
						<th style="min-width:50px" align="center" valign="midle">11</th>
						<th style="min-width:50px" align="center" valign="midle">12</th>
						<th style="min-width:50px" align="center" valign="midle">13</th>
						<th style="min-width:50px" align="center" valign="midle">14</th>
						<th style="min-width:50px" align="center" valign="midle">15</th>
						<th style="min-width:50px" align="center" valign="midle">16</th>
						<th style="min-width:50px" align="center" valign="midle">17</th>
					</tr>
				</thead>
				<tbody>
					<tr class="success">
						<td style="min-width:50px" colspan="17">MISI 1 : Memenuhi kebutuhan dasar masyarakat secara mudah dan terjangkau </td>
					</tr>
					<tr class="warning">
						<td style="min-width:50px"></td>
						<td style="min-width:50px">TUJUAN 1 : Terwujudnya pelayanan kesehatan yang berkualitas dan berkeadilan bagi masyarakat Sumedang </td>
						<td style="min-width:50px">Indeks Pembangunan Manusia</td>
						<td style="min-width:50px">70.33</td>
						<td style="min-width:50px">70,38-70,76</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">70,61-70,98</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">70,83-71,19</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">71,04-71,39</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">71,24-71,59</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">71,24-71,59</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px"></td>
					</tr>
					<tr>
						<td style="min-width:50px"></td>
						<td style="min-width:50px" rowspan="6">SASARAN 1 : Meningkatnya kualitas tenaga Kesehatan serta menyediakan fasilitas pelayanan kesehatan yang mudah dan responsif dalam memberikan pelayanan kesehatan bagi masyarakat </td>
						<td style="min-width:50px">Indikator Sasaran 1 : Cakupan pelayanan kesehatan rujukan </td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">100%</td>
						<td style="min-width:50px"></td>
						<td style="min-width:50px">DINAS KESEHATAN</td>
					</tr>
					<tr>
						
						<td style="min-width:50px"></td>
						<td style="min-width:50px">Indikator Sasaran 2 : Jumlah kematian Ibu</td>
						<td style="min-width:50px">22</td>
						<td style="min-width:50px">
							<22
							</td>
							<td style="min-width:50px"></td>
							<td style="min-width:50px">
								<22
								</td>
								<td style="min-width:50px"></td>
								<td style="min-width:50px">
									<22
									</td>
									<td style="min-width:50px"></td>
									<td style="min-width:50px">
										<22
										</td>
										<td style="min-width:50px"></td>
										<td style="min-width:50px">
											<22
											</td>
											<td style="min-width:50px"></td>
											<td style="min-width:50px">
												<22
												</td>
												<td style="min-width:50px"></td>
												<td style="min-width:50px">DINAS KESEHATAN</td>
											</tr>
											<tr>
											
												<td style="min-width:50px"></td>
												<td style="min-width:50px">Indikator Sasaran 3 : Jumlah kematian bayi</td>
												<td style="min-width:50px">146</td>
												<td style="min-width:50px">
													<146
													</td>
													<td style="min-width:50px"></td>
													<td style="min-width:50px">
														<146
														</td>
														<td style="min-width:50px"></td>
														<td style="min-width:50px">
															<146
															</td>
															<td style="min-width:50px"></td>
															<td style="min-width:50px">
																<146
																</td>
																<td style="min-width:50px"></td>
																<td style="min-width:50px">
																	<146
																	</td>
																	<td style="min-width:50px"></td>
																	<td style="min-width:50px">
																		<146
																		</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																	
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">Indikator Sasaran 4 : Indeks Kepuasan Masyarakat Terhadap Pelayanan Bidang Kesehatan</td>
																		<td style="min-width:50px">78,73</td>
																		<td style="min-width:50px">79</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">81</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">82</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">83</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">83</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																
																		<td style="min-width:50px">Indikator Sasaran 5 :
Prevalensi anak stunting</td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">23%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																		
																		<td style="min-width:50px">Indikator Sasaran 6 :
Cakupan pelayanan kesehatan rujukan</td>
																		<td style="min-width:50px">98%</td>
																		<td style="min-width:50px">98%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">98%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">99%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">99%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">99%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">99%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px" rowspan="6">Program 1 :
Program Upaya Kesehatan Masyarakat</td>
																		<td style="min-width:50px">Indikator Program 1 :
Rasio Puskesmas per Satuan Penduduk</td>
																		<td style="min-width:50px">0%</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">9446966806.00</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">9948600743.00</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">10473289947.00</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">11021880874.000</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">11595239117.00</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">11595239117.00</td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px">Indikator Program 2 :
Persentase PPK BLUD memiliki IKM Kategori Baik</td>
																		<td style="min-width:50px">78.73%</td>
																		<td style="min-width:50px">79%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">81%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">82%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">83%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">83%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																
																		<td style="min-width:50px">Indikator Program 3 :
Cakupan penanganan kegawatdaruratan kesehatan</td>
																		<td style="min-width:50px">0%</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px">Indikator Program 4 :
Peningkatan jumlah jenis pemeriksaan labkesling</td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">2 jenis</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px">Indikator Program 5 :
Persentase puskesmas yang melaksanakan upaya kesehatan masyarakat</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px">Indikator Program 6 :
Persentase puskesmas yang melaksanakan upaya kesehatan kerja</td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">100%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px" rowspan="13">Program 2 :
Program Pencegenahan dan Penanggulangan Penyakit menular, penyakit tidak menular dan surveilans epidemiologi
</td>
																		<td style="min-width:50px">Indikator Program 1 :
Angka kesembuhan TB</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">6471319000.00</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">6814946039.00</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">7174366293.00</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">7550159599.000</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">7942918902.00</td>
																		<td style="min-width:50px">85%</td>
																		<td style="min-width:50px">7942918902.00</td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																	
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">Indikator Program 2 :
CNR TB</td>
																		<td style="min-width:50px">114%</td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">95%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px" >Indikator Program 3 :
Deteksi dini hepatitis B pada bumil</td>
																		<td style="min-width:50px">20%</td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																
																		<td style="min-width:50px">Indikator Program 4 :
Penemuan kasus diare semua umur</td>
																		<td style="min-width:50px">81%</td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																	
																		<td style="min-width:50px">Indikator Program 5 :
penemuan kasus pnemonia pada balita</td>
																		<td style="min-width:50px">89%</td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">80%</td>
																		<td style="min-width:50px"></td>
																		<td style="min-width:50px">DINAS KESEHATAN</td>
																	</tr>
																	<tr>
																		<td style="min-width:50px"></td>
																		
																		<td style="min-width:50px">Indikator Program 6 :
proporsi penemuan kasus kusta cacat tk 2</td>
																		<td style="min-width:50px">36%</td>
																		<td style="min-width:50px">
																			<15%
																			</td>
																			<td style="min-width:50px"></td>
																			<td style="min-width:50px">
																				<15%
																				</td>
																				<td style="min-width:50px"></td>
																				<td style="min-width:50px">
																					<15%
																					</td>
																					<td style="min-width:50px"></td>
																					<td style="min-width:50px">
																						<15%
																						</td>
																						<td style="min-width:50px"></td>
																						<td style="min-width:50px">
																							<15%
																							</td>
																							<td style="min-width:50px"></td>
																							<td style="min-width:50px">
																								<15%
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 7 :
Cakupan POPM Kecacingan
</td>
																								<td style="min-width:50px">98%</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 8 :
Insident Rate DBD</td>
																								<td style="min-width:50px">22/100.000 penduduk</td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">< 49/100.000 penduduk
																								</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 9 :
Persentase Kasus HIV yang diobati</td>
																								<td style="min-width:50px">55%</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																					
																								<td style="min-width:50px">Indikator Program 10 :
Persentase usia 15-59 yg mendapat screening PTM</td>
																								<td style="min-width:50px">11%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 11 :
Persentase penanganan penyakit tidak menular sesuai standar</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 12 :
Cakupan Desa/kelurahan Universal Child Immunization (UCI) </td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 13 :
Cakupan Desa/Kelurahan mengalami KLB yang dilakukan penyelidikan epidemiologi < 24 jam
																								</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="2">Program 3 :
Program Standarisasi Pelayanan Kesehatan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase sarana kesehatan yang Terakreditasi
</td>
																								<td style="min-width:50px">23%</td>
																								<td style="min-width:50px">28%</td>
																								<td style="min-width:50px">1353492600.00</td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px">1425363057.00</td>
																								<td style="min-width:50px">32%</td>
																								<td style="min-width:50px">1500536705.00</td>
																								<td style="min-width:50px">35%</td>
																								<td style="min-width:50px">1579534817.000</td>
																								<td style="min-width:50px">35%</td>
																								<td style="min-width:50px">1661281410.00</td>
																								<td style="min-width:50px">35%</td>
																								<td style="min-width:50px">1661281410.00</td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 2 :
Jumlah Puskesmas menerapkan Sistem informasi Kesehatan terintegrasi online</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="4">Program 4 :
Program Peningkatan Kesehatan Keluarga dan Gizi Masyarakat
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Anemia Pada Ibu Hamil </td>
																								<td style="min-width:50px">8.50%</td>
																								<td style="min-width:50px">8.50%</td>
																								<td style="min-width:50px">5604999000.00</td>
																								<td style="min-width:50px">8.25%</td>
																								<td style="min-width:50px">5902624447.00</td>
																								<td style="min-width:50px">0.08</td>
																								<td style="min-width:50px">6213928860.00</td>
																								<td style="min-width:50px">7.75%</td>
																								<td style="min-width:50px">6539414454.000</td>
																								<td style="min-width:50px">7.50%</td>
																								<td style="min-width:50px">6879594794.00</td>
																								<td style="min-width:50px">7.50%</td>
																								<td style="min-width:50px">6879594794.00</td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 2 :
Persentase BBLR</td>
																								<td style="min-width:50px">3.48%</td>
																								<td style="min-width:50px">3.48%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.19%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2.90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2.61%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2.32%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2.32%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 3 :
Persentase balita gizi lebih</td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 4 :
Persentase anak kelas 1-7 dan 10 mendapat screening kesehatan
</td>
																								<td style="min-width:50px">88.54%</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KESEHATAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="5">Program 5 :
Program Pelayanan Kesehatan Pada BLUD RSUD</td>
																								<td style="min-width:50px">Indikator Program 1 :
Bed Occupancy Rate (BOR)</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">197241545000.00</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">207715071039.50</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">218669963886.12</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">230123896594.48</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">242094941695.32</td>
																								<td style="min-width:50px">80-60</td>
																								<td style="min-width:50px">242094941695.00</td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 2 :
Respon Time (IGD)</td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">≤5 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 3 :
Waktu tunggu poli klinik</td>
																								<td style="min-width:50px">120 menit</td>
																								<td style="min-width:50px">100 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">60 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100 menit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 4 :
Kematian pasien > 48 jam (Rawat Inap)</td>
																								<td style="min-width:50px">76.92%</td>
																								<td style="min-width:50px">75.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">75.48%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">75.96%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.44%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 5 :
Kematian pasien < 24jam (IGD)
																								</td>
																								<td style="min-width:50px">17/1000</td>
																								<td style="min-width:50px">15/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2/1000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program pengadaan peningkatan sarana dan prasarana rumah sakit/rumah sakit jiwa/rumah sakit paru/rumah sakit mata</td>
																								<td style="min-width:50px">Persentase pengadaan Kelengkapan alat kesehatan rumah sakit</td>
																								<td style="min-width:50px">0.8</td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px">5000000000.00</td>
																								<td style="min-width:50px">0.9</td>
																								<td style="min-width:50px">5265500000.00</td>
																								<td style="min-width:50px">0.95</td>
																								<td style="min-width:50px">5543202470.00</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">5833555415.38</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">5833555415.38</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">82048566533.00</td>
																								<td style="min-width:50px">RUMAH SAKIT UMUM DAERAH</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 2 : Terwujudnya pelayanan sistem pendidikan yang Berkualitas dan Merata</td>
																								<td style="min-width:50px">Indeks Pembangunan Manusia</td>
																								<td style="min-width:50px">70.099999999999994</td>
																								<td style="min-width:50px">71.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.099999999999994</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.7</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.3</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.900000000000006</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.900000000000006</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="3">SASARAN 1 :
Meningkatnya Kuantitas dan kualitas Sarana dan Prasarana Pendidikan serta tenaga pengajar untuk mewujudkan pelayanan sistem pendidikan yang merata (Meningkatnya Kualitas Pelayanan Pendidikan Yang merata)</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Rata-rata peningkatan hasil UN</td>
																								<td style="min-width:50px">46,13</td>
																								<td style="min-width:50px">49,82</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">53,51</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">57,20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">60,89</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">64,58</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">64,58</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																					
																								<td style="min-width:50px">Indikator Sasaran 3 :
APK PAUD</td>
																								<td style="min-width:50px">59.25</td>
																								<td style="min-width:50px">62.21</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.180000000000007</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.14</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">71.099999999999994</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.06</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.06</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																				
																								<td style="min-width:50px">Indikator Sasaran 3 :
Rata-rata lama sekolah</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="2">Program 1 :
Program Peningkatan Mutu Pendidik dan Tenaga Kependidikan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Guru yang memenuhi kualifikasi S1/D-IV </td>
																								<td style="min-width:50px">97.20</td>
																								<td style="min-width:50px">97.49</td>
																								<td style="min-width:50px">694000000.00</td>
																								<td style="min-width:50px">97.78</td>
																								<td style="min-width:50px">730851400.00</td>
																								<td style="min-width:50px">98.07</td>
																								<td style="min-width:50px">769396503.00</td>
																								<td style="min-width:50px">98.37</td>
																								<td style="min-width:50px">809697492.000</td>
																								<td style="min-width:50px">98.66</td>
																								<td style="min-width:50px">851817955.00</td>
																								<td style="min-width:50px">98.66</td>
																								<td style="min-width:50px">851817955.00</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 2 :
Persentase Guru yang Bersertifikasi</td>
																								<td style="min-width:50px">84.69</td>
																								<td style="min-width:50px">86.38</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88.08</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89.77</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">91.47</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93.16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93.16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="2">Program 2 :
Program Manajemen Pelayanan Pendidikan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Rasio guru terhadap murid pendidikan dasar</td>
																								<td style="min-width:50px">372.33</td>
																								<td style="min-width:50px">396.53</td>
																								<td style="min-width:50px">1620000000.00</td>
																								<td style="min-width:50px">420.73</td>
																								<td style="min-width:50px">1706022000.00</td>
																								<td style="min-width:50px">444.93</td>
																								<td style="min-width:50px">1795997600.00</td>
																								<td style="min-width:50px">469.13</td>
																								<td style="min-width:50px">1890071955.000</td>
																								<td style="min-width:50px">493.33</td>
																								<td style="min-width:50px">1988393498.00</td>
																								<td style="min-width:50px">493.33</td>
																								<td style="min-width:50px">1988393498.00</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 2 :
Rasio guru/murid per kelas rata-rata sekolah pendidikan dasar</td>
																								<td style="min-width:50px">37.23</td>
																								<td style="min-width:50px">37.27</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.31</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.34</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.38</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.42</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.42</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="12">Program 3 :
Program wajib pendidikan dasar sembilan tahun</td>
																								<td style="min-width:50px">Indikator Program 1 :
Sekolah pendidikan Dasar kondisi Bangunan baik </td>
																								<td style="min-width:50px">14.79%</td>
																								<td style="min-width:50px">16.27%</td>
																								<td style="min-width:50px">100248182000.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 2 :
Rasio ketersediaan sekolah/penduduk usia sekolah pendidikan dasar </td>
																								<td style="min-width:50px">56.30</td>
																								<td style="min-width:50px">57.43</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 3 :
Angka Putus Sekolah (APS) SD </td>
																								<td style="min-width:50px">0.05</td>
																								<td style="min-width:50px">0.04</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 4 :
Angka Putus Sekolah (APS) SMP </td>
																								<td style="min-width:50px">0.03</td>
																								<td style="min-width:50px">0.03</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 5 :
Angka Melanjutkan (AM) dari SD ke SMP/MTs </td>
																								<td style="min-width:50px">100,29</td>
																								<td style="min-width:50px">100,39</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 6 :
Angka Melanjutkan (AM) dari SMP ke SMA/SMK/MA </td>
																								<td style="min-width:50px">88,69</td>
																								<td style="min-width:50px">88,78</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 7 :
Angka Partisipasi Sekolah SD</td>
																								<td style="min-width:50px">100.00</td>
																								<td style="min-width:50px">100.10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																					
																								<td style="min-width:50px">Indikator Program 8 :
Angka Partisipasi Sekolah SMP</td>
																								<td style="min-width:50px">93.73</td>
																								<td style="min-width:50px">94.48</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 9 :
Angka Partisipasi Murni SD</td>
																								<td style="min-width:50px">101.35</td>
																								<td style="min-width:50px">101.45</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																					
																								<td style="min-width:50px">Indikator Program 10 :
Angka Partisipasi Murni SMP</td>
																								<td style="min-width:50px">97.73</td>
																								<td style="min-width:50px">97.93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 11 :
APK SD</td>
																								<td style="min-width:50px">59.25</td>
																								<td style="min-width:50px">62.21</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 12 :
APK SMP</td>
																								<td style="min-width:50px">101.73</td>
																								<td style="min-width:50px">101.83</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px" rowspan="12">Program 4 :
Program Pendidikan Dasar </td>
																								<td style="min-width:50px">Indikator Program 1 :
Sekolah pendidikan Dasar kondisi Bangunan baik </td>
																								<td style="min-width:50px">14.79%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">17.75%</td>
																								<td style="min-width:50px">105571360464.00</td>
																								<td style="min-width:50px">19.23%</td>
																								<td style="min-width:50px">105571360464.20</td>
																								<td style="min-width:50px">20.71%</td>
																								<td style="min-width:50px">111139194015.082</td>
																								<td style="min-width:50px">22.19%</td>
																								<td style="min-width:50px">116960664997.59</td>
																								<td style="min-width:50px">22.19%</td>
																								<td style="min-width:50px">123044958790.77</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 2 :
Rasio ketersediaan sekolah/penduduk usia sekolah pendidikan dasar </td>
																								<td style="min-width:50px">56.30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">58.55</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">59.68</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">60.81</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">61.93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">61.93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 3 :
Angka Putus Sekolah (APS) SD </td>
																								<td style="min-width:50px">0.05</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.03</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.02</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.01</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 4 :
Angka Putus Sekolah (APS) SMP </td>
																								<td style="min-width:50px">0.03</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.03</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-0.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								
																								<td style="min-width:50px">Indikator Program 5 :
Angka Melanjutkan (AM) dari SD ke SMP/MTs </td>
																								<td style="min-width:50px">100,29</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100,49</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100,69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100,79</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100,79</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 6 :
Angka Melanjutkan (AM) dari SMP ke SMA/SMK/MA </td>
																								<td style="min-width:50px">88,69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88,87</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88,96</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89,04</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89,13</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89,13</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 7 :
Angka Partisipasi Sekolah SD</td>
																								<td style="min-width:50px">100.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.40</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 8 :
Angka Partisipasi Sekolah SMP</td>
																								<td style="min-width:50px">93.73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95.23</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95.98</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">96.73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">97.47</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">97.47</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 9 :
Angka Partisipasi Murni SD</td>
																								<td style="min-width:50px">101.35</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.55</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.65</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.76</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.86</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.86</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 10 :
Angka Partisipasi Murni SMP</td>
																								<td style="min-width:50px">97.73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">98.12</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">98.32</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">98.51</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">98.71</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">98.71</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																							
																								<td style="min-width:50px">Indikator Program 11 :
APK SD</td>
																								<td style="min-width:50px">59.25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.18</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.14</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">71.10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.06</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.06</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																						
																								<td style="min-width:50px">Indikator Program 12 :
APK SMP</td>
																								<td style="min-width:50px">101.73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">101.93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">102.04</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">102.14</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">102.23865</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">102.24</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 5 :
Program Pendidikan Anak Usia Dini</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase PAUD yang terakreditasi</td>
																								<td style="min-width:50px">40.48%</td>
																								<td style="min-width:50px">42.50%</td>
																								<td style="min-width:50px">22003900000.00</td>
																								<td style="min-width:50px">44.52%</td>
																								<td style="min-width:50px">22003900000.00</td>
																								<td style="min-width:50px">46.55%</td>
																								<td style="min-width:50px">23172307090.00</td>
																								<td style="min-width:50px">48.57%</td>
																								<td style="min-width:50px">24394414565.93</td>
																								<td style="min-width:50px">50.60%</td>
																								<td style="min-width:50px">25672194000.89</td>
																								<td style="min-width:50px">50.60%</td>
																								<td style="min-width:50px">27007661532.82</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program Pendidikan non formal</td>
																								<td style="min-width:50px">Indikator Program 1 :
Angka Partisipasi Sekolah Paket A</td>
																								<td style="min-width:50px">3.32</td>
																								<td style="min-width:50px">3.10</td>
																								<td style="min-width:50px">50000000.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Angka Partisipasi Sekolah Paket B</td>
																								<td style="min-width:50px">67.16</td>
																								<td style="min-width:50px">66.80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 7 :
Program Kesetaraan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Angka Partisipasi Sekolah Paket A</td>
																								<td style="min-width:50px">3.32</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2.90</td>
																								<td style="min-width:50px">52655000.00</td>
																								<td style="min-width:50px">2.70</td>
																								<td style="min-width:50px">55432024.70</td>
																								<td style="min-width:50px">2.50</td>
																								<td style="min-width:50px">58335554.15</td>
																								<td style="min-width:50px">2.30</td>
																								<td style="min-width:50px">61370169.68</td>
																								<td style="min-width:50px">2.2999999999999998</td>
																								<td style="min-width:50px">61370170.00</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Angka Partisipasi Sekolah Paket B</td>
																								<td style="min-width:50px">67.16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">66.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">66.20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 3 : Terwujudnya penanggulangulangan PMKS serta Pemberdayaan Perempuan dan Perlindungan anak</td>
																								<td style="min-width:50px">Indikator Tujuan 1:
Angka Kemiskinan</td>
																								<td style="min-width:50px">9.76</td>
																								<td style="min-width:50px">9,74-9,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9,18-8,94</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,89-8,52</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,46-7,93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Indeks Pembangunan Gender*</td>
																								<td style="min-width:50px">94.4</td>
																								<td style="min-width:50px">94.45</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.49</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.54</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.64</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.64</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 3:
Indeks Pemberdayaan Gender*</td>
																								<td style="min-width:50px">68.7</td>
																								<td style="min-width:50px">68.73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.77</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.84</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.87</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">68.87</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Meningkatnya Pengarusutamaan Gender dan perlindungan anak</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase Perempuan dan Anak Korban Tindak Kekerasan </td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Persentase kebijakan pelaksanaan PUG yang dihasikan</td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 Kebijakan</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 Persentase Perempuan Kepala Keluarga yang meningkat Ekonomi Keluarganya</td>
																								<td style="min-width:50px">0.37</td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.0000000000000007E-2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 4 :
Kabupaten Layak Anak</td>
																								<td style="min-width:50px">500</td>
																								<td style="min-width:50px">500</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">525</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">550</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">575</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">600</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">600</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Penguatan Kelembagaan PUG dan Anak</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase OPD Responsif Gender</td>
																								<td style="min-width:50px">9.68%</td>
																								<td style="min-width:50px">6.45%</td>
																								<td style="min-width:50px">220000000.00</td>
																								<td style="min-width:50px">17.74%</td>
																								<td style="min-width:50px">231682000.00</td>
																								<td style="min-width:50px">27.42%</td>
																								<td style="min-width:50px">243900908.68</td>
																								<td style="min-width:50px">22.58%</td>
																								<td style="min-width:50px">256676438.28</td>
																								<td style="min-width:50px">22.58%</td>
																								<td style="min-width:50px">270028746.60</td>
																								<td style="min-width:50px">96.77%</td>
																								<td style="min-width:50px">270028747.00</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Peningkatan Kualitas Hidup dan Perlindungan Perempuan dan Anak
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Pengaduan tindak kekerasan perempuan dan anak yang ditangani </td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">188000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">197982800.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">208424412.87</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">219341683.62</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">230751838.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">230751838.00</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 : Persentase kecamatan yang telah membentuk forum anak dan Sekolah Ramah Anak</td>
																								<td style="min-width:50px">3.85%</td>
																								<td style="min-width:50px">15.38%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11.54%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11.54%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11.54%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">19.23%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">69.23%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 2 :
Meningkatnya kualitas penanggulangan kemiskinan dan penanggulangan Penyandang Masalah Kesejahteraan Sosial</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase Pelayananan Penyandang Masalah Kesejahteraan Sosial (PMKS)</td>
																								<td style="min-width:50px">1.96% (115.190 PMKS)</td>
																								<td style="min-width:50px">0.12%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.17%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.21%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.21%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.24%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Pemberdayaan Fakir Miskin, Komunitas Adat Terpencil (KAT) dan Penyandang Masalah Kesejahteraan Sosial (PMKS) Lainnya</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase PMKS yang Menerima Program Pemberdayaan Sosial Melalui Kelompok Usaha Bersama (KUBE) atau Kelompok Sosial Sejenisnya</td>
																								<td style="min-width:50px">1.16%</td>
																								<td style="min-width:50px">0.07%</td>
																								<td style="min-width:50px">138500000.00</td>
																								<td style="min-width:50px">0.06%</td>
																								<td style="min-width:50px">145854350.00</td>
																								<td style="min-width:50px">0.08%</td>
																								<td style="min-width:50px">153546708.42</td>
																								<td style="min-width:50px">0.07%</td>
																								<td style="min-width:50px">161589485.01</td>
																								<td style="min-width:50px">0.08%</td>
																								<td style="min-width:50px">169995370.02</td>
																								<td style="min-width:50px">0.36%</td>
																								<td style="min-width:50px">169995370.02</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Jaminan Sosial</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Penyandang Masalah Kesejahteraan Sosial yang menerima Jaminan Sosial</td>
																								<td style="min-width:50px">70.78%</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">1850000000.00</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">1948235000.00</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">2050984913.90</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">2158415503.69</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">2270696278.19</td>
																								<td style="min-width:50px">87.46%</td>
																								<td style="min-width:50px">2270696278.19</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program Perlindungan Sosial
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Korban Bencana Alam dan Sosial yang Terpenuhi Kebutuhan Dasarnya pada saat dan Setelah Tanggap Darurat Bencana</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">200000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">210620000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">210620000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">221728098.800</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">245480678.72</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">245480678.72</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 :
Program Pelayanan dan Rehabilitasi Kesejahteraan Sosial</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Penyandang Disabilitas yang menerima Bantuan Kebutuhan Dasar</td>
																								<td style="min-width:50px">4.66%</td>
																								<td style="min-width:50px">0.25%</td>
																								<td style="min-width:50px">803500000.00</td>
																								<td style="min-width:50px">0.98%</td>
																								<td style="min-width:50px">846165850.00</td>
																								<td style="min-width:50px">0.98%</td>
																								<td style="min-width:50px">890792636.93</td>
																								<td style="min-width:50px">1.23%</td>
																								<td style="min-width:50px">937452355.25</td>
																								<td style="min-width:50px">1.47%</td>
																								<td style="min-width:50px">986218626.77</td>
																								<td style="min-width:50px">4.91%</td>
																								<td style="min-width:50px">986218626.77</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Persentase Tuna Sosial yang Terpenuhi Kebutuhan Dasarnya </td>
																								<td style="min-width:50px">2.13%</td>
																								<td style="min-width:50px">2.13%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.94%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.38%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.19%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.38%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">19.89%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Persentase Anak Terlantar yang Terpenuhi Kebutuhan Dasarnya
</td>
																								<td style="min-width:50px">21.95%</td>
																								<td style="min-width:50px">9.76%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">14.63%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">14.63%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">17.07%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">17.07%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.17%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Persentase Lanjut Usia yang Terpenuhi Kebutuhan Dasarnya </td>
																								<td style="min-width:50px">0.83%</td>
																								<td style="min-width:50px">0.07%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.13%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.13%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.33%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.20%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 5 :
Program Pemberdayaan Kelembagaan Sosial</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Potensi Sumber kesejahteraan sosial yang aktif</td>
																								<td style="min-width:50px">50.00%</td>
																								<td style="min-width:50px">50.00%</td>
																								<td style="min-width:50px">200000000.00</td>
																								<td style="min-width:50px">58.33%</td>
																								<td style="min-width:50px">210620000.00</td>
																								<td style="min-width:50px">58.33%</td>
																								<td style="min-width:50px">221728098.80</td>
																								<td style="min-width:50px">58.33%</td>
																								<td style="min-width:50px">233342216.62</td>
																								<td style="min-width:50px">58.33%</td>
																								<td style="min-width:50px">245480678.72</td>
																								<td style="min-width:50px">58.33%</td>
																								<td style="min-width:50px">245480678.72</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program Ketahanan Keluarga dan Kesejahteraan Keluarga</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Perempuan Yang Mendapatkan Pemberdayaan Dalam Peningkatan Ekonomi Keluarga</td>
																								<td style="min-width:50px">7.78%</td>
																								<td style="min-width:50px">1.48%</td>
																								<td style="min-width:50px">1050000000.00</td>
																								<td style="min-width:50px">1.67%</td>
																								<td style="min-width:50px">1105755000.00</td>
																								<td style="min-width:50px">1.70%</td>
																								<td style="min-width:50px">1164072518.70</td>
																								<td style="min-width:50px">1.67%</td>
																								<td style="min-width:50px">1225046637.23</td>
																								<td style="min-width:50px">1.67%</td>
																								<td style="min-width:50px">1288773563.30</td>
																								<td style="min-width:50px">8.19%</td>
																								<td style="min-width:50px">1288773563.30</td>
																								<td style="min-width:50px">DINAS SOSIAL, PEMBERDAYAAN PEREMPUAN DAN PERLINDUNGAN ANAK</td>
																							</tr>
																							<tr class="success">
																								<td style="min-width:50px" colspan="17">MISI 2 : Menguatkan norma agama dalam tatanan kehidupan sosial masyarakat dan pemerintahan </td>

																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 1 : Terwujudnya kehidupan yang agamis di Kabupaten Sumedang </td>
																								<td style="min-width:50px">Indeks Kerukunan Umat Beragama</td>
																								<td style="min-width:50px">72.2</td>
																								<td style="min-width:50px">72.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Menguatnya kondisi kehidupan kerukunan umat beragama untuk meningkatkan rasa toleransi dan saling pengertian intra dan antara para pemeluk agama dalam menciptakan kehidupan yang berlandaskan norma agama</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Indeks Kerukunan Umat Beragama</td>
																								<td style="min-width:50px">72.2</td>
																								<td style="min-width:50px">72.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">KANTOR KESATUAN BANGSA DAN POLITIK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Produk hukum daerah yang terbentuk (jumlah) </td>
																								<td style="min-width:50px">NA</td>
																								<td style="min-width:50px">5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 :
Persentase Penegakan Perda </td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SATUAN POLISI PAMONG PRAJA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 : Program Kerukunan Umat Beragama</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Konflik Sara dan Keagamaan</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">500000000.00</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">526370000.00</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">553941260.600</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">582757284.98</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">582757284.98</td>
																								<td style="min-width:50px">KANTOR KESATUAN BANGSA DAN POLITIK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Penataan Peraturan Perundang-undangan
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan produk hukum yang ditetapkan </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1860000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1958096400.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2060661489.432</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2167857100.11</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2167857100.11</td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program pemeliharaan ketentraman dan ketertiban masyarakat</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase penegakan peraturan daerah</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">495000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">521284500.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">548777044.53</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">577521986.122</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">607564679.84</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">607564679.84</td>
																								<td style="min-width:50px">SATPOL PP</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Sasaran 2:
Penguatan pendidikan karakter berbasis pendekatan keagamaan bagi siswa usia pendidikan dasar</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase siswa bersertifikat Diniyah*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">60%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program penyelenggaraan pendidikan wajib diniyah kabupaten</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase siswa yang berpartisipasi aktif dalam pendidikan diniyah</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-</td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">5000000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">5263700000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">5539412606.000</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">5827572849.76</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">5827572849.76</td>
																								<td style="min-width:50px">DINAS PENDIDIKAN</td>
																							</tr>
																							<tr class="success">
																								<td style="min-width:50px" colspan="17">MISI 3 : Mengembangkan wilayah ekonomi didukung dengan peningkatan infrastruktur, serta penguatan budaya dan kearifan lokal</td>
																								
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 1 :
Terwujudnya pembangunan Infrastruktur yang mendukung percepatan pengembangan wilayah ekonomi</td>
																								<td style="min-width:50px">Persentase panjang jaringan jalan dalam kondisi Mantap</td>
																								<td style="min-width:50px">66.30%</td>
																								<td style="min-width:50px">68.35%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70.41%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.53%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Meningkatnya kualitas dan kuantitas infrastruktur jalan untuk meningkatkan aksesibilitas dan konektivitas daerah</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase panjang jaringan jalan dalam kondisi Mantap</td>
																								<td style="min-width:50px">66.30%</td>
																								<td style="min-width:50px">68.35%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70.41%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.53%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Persentase Ketersediaan Rambu-rambu</td>
																								<td style="min-width:50px">4.75%</td>
																								<td style="min-width:50px">6.07%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7.38%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8.70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.01%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11.33%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11.33%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 :
Persentase Ketersediaan Penerangan Jalan Umum</td>
																								<td style="min-width:50px">26.88%</td>
																								<td style="min-width:50px">31.82%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">33.79%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">37.74%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.68%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">42.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">42.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Penanganan Jalan dan Jembatan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase tingkat kondisi jalan kabupaten/kota baik dan sedang </td>
																								<td style="min-width:50px">66.30%</td>
																								<td style="min-width:50px">68.35%</td>
																								<td style="min-width:50px">95730015000.00</td>
																								<td style="min-width:50px">70.41%</td>
																								<td style="min-width:50px">100813278796.50</td>
																								<td style="min-width:50px">72.53%</td>
																								<td style="min-width:50px">106130171120.23</td>
																								<td style="min-width:50px">74.50%</td>
																								<td style="min-width:50px">111689269483.505</td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px">117499345282.04</td>
																								<td style="min-width:50px">76.15%</td>
																								<td style="min-width:50px">117499345282.04</td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Pembangunan, Rehabilitasi dan Pemeliharaan Sarana Prasarana Perhubungan
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Penerangan Jalan Umum</td>
																								<td style="min-width:50px">4.086 titik</td>
																								<td style="min-width:50px">750</td>
																								<td style="min-width:50px">8100000000.00</td>
																								<td style="min-width:50px">300</td>
																								<td style="min-width:50px">8530110000.00</td>
																								<td style="min-width:50px">600</td>
																								<td style="min-width:50px">8979988001.40</td>
																								<td style="min-width:50px">600</td>
																								<td style="min-width:50px">9450359772.913</td>
																								<td style="min-width:50px">100</td>
																								<td style="min-width:50px">9941967488.30</td>
																								<td style="min-width:50px">6436</td>
																								<td style="min-width:50px">9941967488.30</td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Pemasangan Rambu Rambu lalu lintas</td>
																								<td style="min-width:50px">722</td>
																								<td style="min-width:50px">200</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">200</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">200</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">200</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">200</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1722</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 2 :
Tersedianya sistem transportasi yang dapat mendukung mobilitas masyarakat</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Cakupan trayek angkutan umum</td>
																								<td style="min-width:50px">58.45%</td>
																								<td style="min-width:50px">59.85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">61.24%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62.64%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">64.04%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.43%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">65.43%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Rata-rata peningkatan penumpang angkutan umum</td>
																								<td style="min-width:50px">37.45%</td>
																								<td style="min-width:50px">38.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">39.24%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">40.13%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.03%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Pelayanan Bidang Perhubungan, Pengawasan, Pengendalian dan Pengamanan Lalu Lintas Angkutan Jalan
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan Trayek Angkutan Umum;</td>
																								<td style="min-width:50px">58.45%</td>
																								<td style="min-width:50px">59.85%</td>
																								<td style="min-width:50px">607500000.00</td>
																								<td style="min-width:50px">61.24%</td>
																								<td style="min-width:50px">639758250.00</td>
																								<td style="min-width:50px">62.64%</td>
																								<td style="min-width:50px">673499100.11</td>
																								<td style="min-width:50px">64.04%</td>
																								<td style="min-width:50px">708776982.969</td>
																								<td style="min-width:50px">65.43%</td>
																								<td style="min-width:50px">745647561.62</td>
																								<td style="min-width:50px">65.43%</td>
																								<td style="min-width:50px">745647561.62</td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Rata-rata Peningkatan Penumpang Angkutan Umum;</td>
																								<td style="min-width:50px">37.45%</td>
																								<td style="min-width:50px">38.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">39.24%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">40.13%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.03%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">41.92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Peningkatan jumlah KIR angkutan umum</td>
																								<td style="min-width:50px">9.396 unit</td>
																								<td style="min-width:50px">10.000 unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.100 unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.200 unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.300 Unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.400 Unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10.400 Unit</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERHUBUNGAN</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 2 : Terwujudnya pengembangan wilayah ekonomi dengan mendorong peningkatan produktivitas komoditas unggulan</td>
																								<td style="min-width:50px">Indikator Tujuan 1 :
Nilai Tukar Petani</td>
																								<td style="min-width:50px">108.39</td>
																								<td style="min-width:50px">108.4</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">108.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">108.6</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">108.7</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">108.8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">108.8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Angka Kemiskinan</td>
																								<td style="min-width:50px">9.76</td>
																								<td style="min-width:50px">9,74-9,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9,18-8,94</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,89-8,52</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,46-7,93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Meningkatnya produktivitas komoditas unggulan daerah</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Rasio jaringan irigasi</td>
																								<td style="min-width:50px">33.25</td>
																								<td style="min-width:50px">33.630000000000003</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">34.18</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">34.61</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35.18</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35.76</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35.76</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Persentase daerah irigasi dalam kondisi baik</td>
																								<td style="min-width:50px">49%</td>
																								<td style="min-width:50px">49.69%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50.60%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">51.57%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">52.60%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">53.68%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">53.68%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 :
Pertumbuhan Sektor Pertanian </td>
																								<td style="min-width:50px">6.79%</td>
																								<td style="min-width:50px">6.80%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.81%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.82%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.83%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.84%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.84%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Pengembangan dan Pengelolaan Jaringan Irigasi, Rawa, dan Jaringan Pengairan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Panjang Jaringan Irigasi Kabupaten dalam kondisi baik</td>
																								<td style="min-width:50px">883.90</td>
																								<td style="min-width:50px">893.90</td>
																								<td style="min-width:50px">26929497000.00</td>
																								<td style="min-width:50px">908.56</td>
																								<td style="min-width:50px">28359453290.70</td>
																								<td style="min-width:50px">919.98</td>
																								<td style="min-width:50px">29855130857.25</td>
																								<td style="min-width:50px">935.25</td>
																								<td style="min-width:50px">31418942611.55</td>
																								<td style="min-width:50px">950.47</td>
																								<td style="min-width:50px">33053356006.21</td>
																								<td style="min-width:50px">950.47</td>
																								<td style="min-width:50px">33053356006.21</td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Peningkatan Produksi hasil peternakan </td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Peningkatan populasi ternak</td>
																								<td style="min-width:50px">0.63</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2309000000.00</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2431607900.00</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2559850900.65</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2693935890.82</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2834074435.86</td>
																								<td style="min-width:50px">0.34</td>
																								<td style="min-width:50px">2834074435.86</td>
																								<td style="min-width:50px">DINAS PERIKANAN DAN PETERNAKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program peningkatan pengelolaan dan pemasaran hasil produksi peternakan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase pertambahan unit usaha peternakan</td>
																								<td style="min-width:50px">15%</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">132500000.00</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">139535750.00</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">146894865.46</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">154589218.508</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">162630949.65</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">162630949.65</td>
																								<td style="min-width:50px">DINAS PERIKANAN DAN PETERNAKAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 :
Program peningkatan produksi pertanian/perkebunan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah produksi Tanaman Pangan </td>
																								<td style="min-width:50px">860.862 ton</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">2650000000.00</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">2790715000.00</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">2937897309.10</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">3091784370.15</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">3252618993.09</td>
																								<td style="min-width:50px">860862</td>
																								<td style="min-width:50px">3252618993.09</td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Jumlah produksi Hortikultura </td>
																								<td style="min-width:50px">62.413 ton</td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">62413</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Jumlah Produksi Perkebunan</td>
																								<td style="min-width:50px">6.436,69 ton</td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6436.69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 5 :
Program Peningkatan Penerapan Teknologi Pertanian/Perkebunan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan Percepatan Olah Lahan dan Tanam Terhadap Luas Areal Tanam </td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px">22466174000.00</td>
																								<td style="min-width:50px">31.59%</td>
																								<td style="min-width:50px">23659127839.40</td>
																								<td style="min-width:50px">33.26%</td>
																								<td style="min-width:50px">24906910241.65</td>
																								<td style="min-width:50px">35.00%</td>
																								<td style="min-width:50px">26211534200.11</td>
																								<td style="min-width:50px">36.82%</td>
																								<td style="min-width:50px">27575058209.20</td>
																								<td style="min-width:50px">36.82%</td>
																								<td style="min-width:50px">27575058209.20</td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Luas Lahan Yang Terairi</td>
																								<td style="min-width:50px">3.750 hektar</td>
																								<td style="min-width:50px">3750</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3949.125</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4157.44134375</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4375.2289085423</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4602.8283163647</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4602.8283163647</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"> Indikator Program 3 :
Ketersediaan Jalan Pertanian</td>
																								<td style="min-width:50px">4 km</td>
																								<td style="min-width:50px">4</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.2124</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.43607844</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.6684624090794</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.9113158235997</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.9113158235997</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program Pengolahan dan Pemasaran hasil pertanian/perkebunan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan Kelompok Tani Pengolah Hasil Pertanian</td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px">1300000000.00</td>
																								<td style="min-width:50px">21.06%</td>
																								<td style="min-width:50px">1369030000.00</td>
																								<td style="min-width:50px">22.17%</td>
																								<td style="min-width:50px">1441232642.20</td>
																								<td style="min-width:50px">23.33%</td>
																								<td style="min-width:50px">1516724408.00</td>
																								<td style="min-width:50px">24.55%</td>
																								<td style="min-width:50px">1595624411.70</td>
																								<td style="min-width:50px">24.55%</td>
																								<td style="min-width:50px">1595624411.70</td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 7 :
Program Pemberdayaan Penyuluhan Pertanian/Perkebunan Lapangan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan kelompok tani yang mendapatkan Pelayanan Penyuluhan Pertanian</td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px">1593542000.00</td>
																								<td style="min-width:50px">21.06%</td>
																								<td style="min-width:50px">1678159080.20</td>
																								<td style="min-width:50px">22.17%</td>
																								<td style="min-width:50px">1766665190.09</td>
																								<td style="min-width:50px">23.33%</td>
																								<td style="min-width:50px">1859203112.75</td>
																								<td style="min-width:50px">24.55%</td>
																								<td style="min-width:50px">1955918858.67</td>
																								<td style="min-width:50px">24.55%</td>
																								<td style="min-width:50px">1955918858.67</td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Sasaran 2:
Menjamin Ketahanan Pangan Daerah </td>
																								<td style="min-width:50px">Indikator Sasaran 1:
Skor Pola Pangan Harapan</td>
																								<td style="min-width:50px">86.10</td>
																								<td style="min-width:50px">87.30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89.60</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90.80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">92.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">92.50</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1:
Program Peningkatan Ketahanan Pangan Pertanian/Perkebunan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Ketersediaan Pangan Utama</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1645000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1732349500.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1823713612.63</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1919239731.66</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2019078582.50</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2019078582.50</td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Ketersediaan energi dan protein per kapita</td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Pembinaan keamanan pangan segar</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERTANIAN DAN KETAHANAN PANGAN</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 3 :
Terwujudnya kota yang berwawasan lingkungan sebagai Wilayah Perkotaan yang berkelanjutan dan lestari</td>
																								<td style="min-width:50px">Indikator Tujuan 1:
Indeks Kualitas Lingkungan Hidup</td>
																								<td style="min-width:50px">53.93</td>
																								<td style="min-width:50px">54.04</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">54.15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">54.26</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">54.37</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">54.48</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">54.48</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Indeks Risiko Bencana</td>
																								<td style="min-width:50px">162</td>
																								<td style="min-width:50px">162</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">161.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">161</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Meningkatknya pengelolaan lingkungan hidup sesuai dengan prinsip-prinsip pembangunan berkelanjutan</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase penanganan sampah perkotaan</td>
																								<td style="min-width:50px">38%</td>
																								<td style="min-width:50px">37.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">34.96%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">34.54%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">34.06%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">33.58%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">33.58%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Indeks kualitas air</td>
																								<td style="min-width:50px">42.46</td>
																								<td style="min-width:50px">42,66</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">42,86</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">43,06</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">43,26</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">43,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">43,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 :
Indeks kualitas udara</td>
																								<td style="min-width:50px">69.88</td>
																								<td style="min-width:50px">70,03</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,18</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,33</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,48</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,63</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,63</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 4 :
Indeks Tutupan Lahan</td>
																								<td style="min-width:50px">50,57</td>
																								<td style="min-width:50px">50,58</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50,60</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50.59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50,61</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50,62</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 5 :
Persentase kesesuaian peruntukan lahan dengan tata ruang</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 6 :
Persentase pengurangan sampah</td>
																								<td style="min-width:50px">3,87%</td>
																								<td style="min-width:50px">3,90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,30%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,77%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,66%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 7 : Persentase lingkungan yang tertata</td>
																								<td style="min-width:50px">0.2</td>
																								<td style="min-width:50px">11.25%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">12.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">12.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">12.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">58.75%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 8 :
Persentase Rumah Tangga Bersanitasi</td>
																								<td style="min-width:50px">55%</td>
																								<td style="min-width:50px">55.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55.30%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55.45%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55.60%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55.75%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55.75%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 9 :
Persentase Penduduk Berakses Air Minum</td>
																								<td style="min-width:50px">0.7</td>
																								<td style="min-width:50px">70.45%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">71.05%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">71.65%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.25%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72.70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 10 :
Rasio Rumah Layak Huni </td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">80.05%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.11%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.17%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.23%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Pengendalian Pencemaran dan Perusakan Lingkungan Hidup</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Pembinaan dan Pengawasan terkait ketaatan penanggung jawab usaha dan/atau kegiatan yang diawasi ketaatannya terhadap izin lingkungan, izin PPLH dan PUU LH d yang diterbitkan oleh Pemerintah Daerah kabupaten/kota</td>
																								<td style="min-width:50px">26.90%</td>
																								<td style="min-width:50px">20.90%</td>
																								<td style="min-width:50px">250000000.00</td>
																								<td style="min-width:50px">21.50%</td>
																								<td style="min-width:50px">263275000.00</td>
																								<td style="min-width:50px">22.40%</td>
																								<td style="min-width:50px">277160123.50</td>
																								<td style="min-width:50px">25.30%</td>
																								<td style="min-width:50px">291677770.77</td>
																								<td style="min-width:50px">27.00%</td>
																								<td style="min-width:50px">306850848.40</td>
																								<td style="min-width:50px">50.10%</td>
																								<td style="min-width:50px">306850848.40</td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Persentase Penyelesaian sengketa lingkungan hidup</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Persentase Akreditasi Laboratorium Lingkungan Hidup;</td>
																								<td style="min-width:50px">15%</td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Persentase Sungai dipantau kualitas airnya</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 5 :
Persentase kecukupan instrumen pengelolaan lingkungan</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">97%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 6 :
Persentase masyarakat/kelompok masyarakat / lembaga yang berperan aktif dalam pengembangan kapasitas lingkungan</td>
																								<td style="min-width:50px">2.93%</td>
																								<td style="min-width:50px">3.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.28%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.86%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 7 :
Persentase titik pantau kualitas
udara</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">74%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">81.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Pengembangan Kinerja Pengelolaan Persampahan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Timbulan sampah yang ditangani</td>
																								<td style="min-width:50px">38 % (Perkotaan)</td>
																								<td style="min-width:50px">37,4 % (Perkotaan)</td>
																								<td style="min-width:50px">5123807000.00</td>
																								<td style="min-width:50px">34,96 % (Perkotaan)</td>
																								<td style="min-width:50px">5395881151.70</td>
																								<td style="min-width:50px">34,54 % (Perkotaan)</td>
																								<td style="min-width:50px">5680459923.64</td>
																								<td style="min-width:50px">34,06 % (Perkotaan)</td>
																								<td style="min-width:50px">5978002414.44</td>
																								<td style="min-width:50px">33,58 % (Perkotaan)</td>
																								<td style="min-width:50px">6288978100.04</td>
																								<td style="min-width:50px">33,58 %</td>
																								<td style="min-width:50px">6288978100.04</td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Persentase jumlah sampah yang terkurangi melalui 3R</td>
																								<td style="min-width:50px">3,87%</td>
																								<td style="min-width:50px">0.70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.80%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.10%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1,1 %</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Persentase cakupan area pelayanan</td>
																								<td style="min-width:50px">5,38</td>
																								<td style="min-width:50px">3,90</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0,16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0,16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0,16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0,16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Persentase Operasionalisasi TPA/TPST/SPA di Kabupaten</td>
																								<td style="min-width:50px">68,53</td>
																								<td style="min-width:50px">69</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">69,33</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">69,67</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,67</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70,67</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 5 :
Indeks kepuasan masyarakat</td>
																								<td style="min-width:50px">71,31</td>
																								<td style="min-width:50px">77</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">77,2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">77,5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">77,8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 6 :
Persentase jumlah sampah yang terkurangi melalui 3R dan sektor informal</td>
																								<td style="min-width:50px">3,87</td>
																								<td style="min-width:50px">3,90</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,77</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,66</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS LINGKUNGAN HIDUP DAN KEHUTANAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program pengembangan dan penataan wilayah</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase penataan lingkungan </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">30</td>
																								<td style="min-width:50px">9129300000.00</td>
																								<td style="min-width:50px">30</td>
																								<td style="min-width:50px">9614065830.00</td>
																								<td style="min-width:50px">20</td>
																								<td style="min-width:50px">10121111661.87</td>
																								<td style="min-width:50px">20</td>
																								<td style="min-width:50px">10651255490.72</td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px">11205333801.35</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">11205333801.35</td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Jumlah Bangunan yang Memiliki Sertifikasi Laik Fungsi</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 :
Program Penataan Ruang</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase kesesuaian peruntukan lahan dengan rencana tata ruang wilayah</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2820000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2969742000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3126366193.08</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3290125254.27</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3461277570.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3461277570.00</td>
																								<td style="min-width:50px">DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 5 :
Penyediaan dan Pengelolaan Air Baku</td>
																								<td style="min-width:50px">Indikator 1 :
Jumlah Sarana Air Minum yang terbangun</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">7422499442.00</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">7816634162.37</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">8228883448.09</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">8659912363.10</td>
																								<td style="min-width:50px">27</td>
																								<td style="min-width:50px">9110401004.23</td>
																								<td style="min-width:50px">162</td>
																								<td style="min-width:50px">9110401004.23</td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program Penyediaan Sarana dan Pengelolaan Limbah Domestik</td>
																								<td style="min-width:50px">Indikator 1 :
Jumlah Sanitasi yang terbangun</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">-</td>
																								<td style="min-width:50px">9</td>
																								<td style="min-width:50px">1000000000.00</td>
																								<td style="min-width:50px">9</td>
																								<td style="min-width:50px">1052740000.00</td>
																								<td style="min-width:50px">9</td>
																								<td style="min-width:50px">1107882521.20</td>
																								<td style="min-width:50px">9</td>
																								<td style="min-width:50px">1165514569.95</td>
																								<td style="min-width:50px">69</td>
																								<td style="min-width:50px">1165514569.95</td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 7 :
Program Penanganan dan Pengembangan Perumahan dan Kawasan Permukiman
</td>
																								<td style="min-width:50px">Indikator 1 :
Cakupan Ketersediaan Rumah Layak Huni</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">80.05%</td>
																								<td style="min-width:50px">4129000000.00</td>
																								<td style="min-width:50px">80.11%</td>
																								<td style="min-width:50px">4348249900.00</td>
																								<td style="min-width:50px">80.17%</td>
																								<td style="min-width:50px">4577576599.73</td>
																								<td style="min-width:50px">80.23%</td>
																								<td style="min-width:50px">4817350062.02</td>
																								<td style="min-width:50px">80.28%</td>
																								<td style="min-width:50px">5067948612.25</td>
																								<td style="min-width:50px">80.28%</td>
																								<td style="min-width:50px">5067948612.25</td>
																								<td style="min-width:50px">DINAS PERUMAHAN, KAWASAN PERMUKIMAN DAN PERTANAHAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 2 :
Pengurangan indeks resiko bencana </td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Penurunan Indeks Risiko bencana</td>
																								<td style="min-width:50px">162</td>
																								<td style="min-width:50px">162</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">161.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">161</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">160</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Pencegahan Dini dan Penanggulangan Korban Bencana Alam</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase Peningkatan Jumlah Desa/Kelurahan Rawan Bencana yang Mendapatkan Informasi Peringatan Dini Bencana</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">7270752000.00</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">7656828931.20</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">8060650089.03</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">8482866940.695</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">8924145678.95</td>
																								<td style="min-width:50px">276 Desa</td>
																								<td style="min-width:50px">8924145678.95</td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Persentase Desa/Kelurahan Tangguh Bencana</td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 Desa</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Respons Time Tanggap Darurat</td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">24 Jam </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Persentase Korban Bencana yang diberikan bantuan</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 5 :
Prosentase Rencana Pemulihan Pasca Bencana Yang Berhasil Di Realisasikan
</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENANGGULANGAN BENCANA DAERAH</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 4 :Terwujudnya Sumedang sebagai tujuan wisata yang berdaya saing</td>
																								<td style="min-width:50px">Indikator Tujuan 1 :
PAD Sektor Pariwisata (Rp)</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15000000000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15450000000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15913500000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16390905000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16882632150</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16882632150</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Angka Kemiskinan</td>
																								<td style="min-width:50px">9.76</td>
																								<td style="min-width:50px">9,74-9,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9,18-8,94</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,89-8,52</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,46-7,93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 :
Meningkatnya pelestarian budaya, situs, sejarah, seni dan pengembangan destinasi wisata untuk mewujudkan Sumedang sebagai tujuan wisata</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Jumlah kunjungan wisatawan</td>
																								<td style="min-width:50px">432569</td>
																								<td style="min-width:50px">519083</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">622900</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">747479</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">896975</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1076368</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
PAD sektor pariwisata</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15000000000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15450000000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15913500000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16390905000</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16882632150</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16882632150</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program pengelolaan kekayaan budaya</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah seni budaya yang dilindungi, dikembangkan dan dimanfaatkan</td>
																								<td style="min-width:50px">6</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">350000000.00</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">368585000.00</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">388024172.90</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">408348879.077</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">429591187.77</td>
																								<td style="min-width:50px">11</td>
																								<td style="min-width:50px">429591187.77</td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program pengembangan Destinasi pariwisata</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Destinasi Wisata yang dkembangkan dan dipromosikan</td>
																								<td style="min-width:50px">n.a</td>
																								<td style="min-width:50px">4</td>
																								<td style="min-width:50px">3944231000.00</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program Pembangunan Kepariwisataan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Destinasi Wisata yang dkembangkan dan dipromosikan</td>
																								<td style="min-width:50px">n.a</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">2</td>
																								<td style="min-width:50px">4153669666.10</td>
																								<td style="min-width:50px">2</td>
																								<td style="min-width:50px">4372734204.29</td>
																								<td style="min-width:50px">2</td>
																								<td style="min-width:50px">4601778021.911</td>
																								<td style="min-width:50px">2</td>
																								<td style="min-width:50px">4841162514.61</td>
																								<td style="min-width:50px">12</td>
																								<td style="min-width:50px">4841162514.61</td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr class="success">
																								<td style="min-width:50px" colspan="17">MISI 4 : Menata birokrasi pemerintah yang responsif dan bertanggung jawab secara profesional dalam pelayanan masyarakat.</td>

																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 1: Terwujudnya Birokrasi yang bersih dan bebas KKN
</td>
																								<td style="min-width:50px">Opini BPK</td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1:
Meningkatnya kinerja keuangan daerah yang transparan dan akuntabel</td>
																								<td style="min-width:50px">Indikator Sasaran 1:
Opini BPK</td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">WTP</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2:
Persentase temuan yang ditindaklanjuti</td>
																								<td style="min-width:50px">75%</td>
																								<td style="min-width:50px">75%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">83%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3:
Tingkat maturitas SPIP</td>
																								<td style="min-width:50px">3,1</td>
																								<td style="min-width:50px">3,2</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3,3</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3,5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3,8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 4 :
Persentase PAD terhadap pendapatan</td>
																								<td style="min-width:50px">18,04%</td>
																								<td style="min-width:50px">18.48%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">20.20%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">21%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">21.85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">22.74%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">22.74%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 : Program Peningkatan dan Pengembangan Pengelolaan Keuangan Daerah</td>
																								<td style="min-width:50px">Indikator Program 1 : Tingkat akurasi dokumen penganggaran</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">91%</td>
																								<td style="min-width:50px">6661276600.00</td>
																								<td style="min-width:50px">92%</td>
																								<td style="min-width:50px">7014990387.46</td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px">7384960980.49</td>
																								<td style="min-width:50px">94%</td>
																								<td style="min-width:50px">7771785236.65</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">8176073504.66</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">8176073504.66</td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 : Cakupan dokumen pengajuan pembayaran yang sesuai dengan aturan</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">90.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">91%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">92.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">94.50%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 : Tingkat Kesesuaian Laporan Kegiatan OPD dan LKPD dengan standar akuntansi pemerintah</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 : Tingkat ketepatan waktu penyampaian LK OPD</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">92%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">93%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 5 : Keakuratan Penatausahaan Aset (Materealitas)</td>
																								<td style="min-width:50px">86%</td>
																								<td style="min-width:50px">87%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">89%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">91%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">91%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN KEUANGAN DAN ASET</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Penataan dan Peningkatan Sistem Pengawasan Internal dan Pengendalian Pelaksanaan Kebijakan KDH</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase penyelesaian tindaklanjut hasil pemeriksaan Inspektorat Kabupaten Sumedang</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px">3645000000.00</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">3838549500.00</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">4040994600.63</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">4252661897.81</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">4473885369.74</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">2236942684.87</td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 : Program Peningkatan Profesionalisme Tenaga Pemeriksa dan Aparatur Pengawasan</td>
																								<td style="min-width:50px">Indikator Program 1 : Tingkat IACM</td>
																								<td style="min-width:50px">Level 3 Dengan Catatan (DC)</td>
																								<td style="min-width:50px">Level 3 DC</td>
																								<td style="min-width:50px">210000000.00</td>
																								<td style="min-width:50px">Level 3 DC</td>
																								<td style="min-width:50px">221151000.00</td>
																								<td style="min-width:50px">Level 3 Penuh</td>
																								<td style="min-width:50px">232814503.74</td>
																								<td style="min-width:50px">Level 3 Penuh</td>
																								<td style="min-width:50px">245009327.45</td>
																								<td style="min-width:50px">Level 3 Penuh</td>
																								<td style="min-width:50px">257754712.66</td>
																								<td style="min-width:50px">Level 3 Penuh</td>
																								<td style="min-width:50px">257754712.66</td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 : Program Penegakan Integritas</td>
																								<td style="min-width:50px">Indikator Program 1 : Cakupan zona integritas</td>
																								<td style="min-width:50px">75%</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">295000000.00</td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px">310664500.00</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">327048945.73</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">344179769.51</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">362084001.12</td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px">362084001.12</td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 5 : Program Peningkatan dan Pengembangan Pengelolaan Pendapatan Daerah</td>
																								<td style="min-width:50px">Indikator Program 1 : Nilai survei kepuasan masyarakat pelayanan pajak daerah</td>
																								<td style="min-width:50px">65%</td>
																								<td style="min-width:50px">70%</td>
																								<td style="min-width:50px">10679212750.00</td>
																								<td style="min-width:50px">70%</td>
																								<td style="min-width:50px">11246278947.03</td>
																								<td style="min-width:50px">75%</td>
																								<td style="min-width:50px">11839407698.69</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">12459555873.95</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">13107701970.51</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">13107701970.51</td>
																								<td style="min-width:50px">BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Persentase potensi pajak daerah</td>
																								<td style="min-width:50px">0.6</td>
																								<td style="min-width:50px">0.65</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.65</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.7</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.75</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.8</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Persentase rata-rata wajib pajak yang membayar sesuai ketentuan</td>
																								<td style="min-width:50px">0.7</td>
																								<td style="min-width:50px">0.75</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.7</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Cakupan regulasi PDRD yang disempurnakan</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BADAN PENGELOLAAN PENDAPATAN DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 6 :
Program pemantapan pemerintahan dan pembangunan desa</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase desa yang menerapkan administrasi pemerintahan desa sesuai aturan</td>
																								<td style="min-width:50px">0.64</td>
																								<td style="min-width:50px">0.71</td>
																								<td style="min-width:50px">812000000.00</td>
																								<td style="min-width:50px">0.78</td>
																								<td style="min-width:50px">855117200.00</td>
																								<td style="min-width:50px">0.86</td>
																								<td style="min-width:50px">900216081.13</td>
																								<td style="min-width:50px">0.93</td>
																								<td style="min-width:50px">947369399.46</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">996651555.62</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">996651555.62</td>
																								<td style="min-width:50px">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 2:
Terwujudnya pelayanan publik yang berkualitas terhadap masyarakat</td>
																								<td style="min-width:50px">Indeks Kepuasan Masyarakat terhadap Pelayanan Publik (%)</td>
																								<td style="min-width:50px">79,17</td>
																								<td style="min-width:50px">80.05</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80,10</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80,15</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80,20</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80,25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80,25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1:
Meningkatnya profesionalitas ASN</td>
																								<td style="min-width:50px">Indikator Sasaran 1:
Skor Lakip</td>
																								<td style="min-width:50px">B</td>
																								<td style="min-width:50px">BB</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BB</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BB</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">BB</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">A</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">A</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">INSPEKTORAT KABUPATEN, SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2:
IKM bidang pelayanan perizinan</td>
																								<td style="min-width:50px">79.75</td>
																								<td style="min-width:50px">81.25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">82.75</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">84.25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">85.75</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">87.25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">87.25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 3 : Nilai LPPD</td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">3.5190000000000001</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 4 : IKM Bidang Kependudukan</td>
																								<td style="min-width:50px">76</td>
																								<td style="min-width:50px">77</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78.5</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">79</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Administrasi Pemerintahan dan Penataan Organisasi Pemda</td>
																								<td style="min-width:50px">Indikator Program 1 :
Laporan penyelenggaran pemda yang sesuai dan tepat waktu
</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2525000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2658168500.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2797403366.030</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2942924289.13</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">1565772555.24</td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Tingkat indeks Penilaian Mandiri Reformasi Birokrasi
</td>
																								<td style="min-width:50px">71</td>
																								<td style="min-width:50px">72</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">72</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">75</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">75</td>
																								<td style="min-width:50px">1535071132.59</td>
																								<td style="min-width:50px">SETDA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 3 :
Persentase koordinasi penyelenggaraan pemerintah daerah</td>
																								<td style="min-width:50px">2 kali per tahun dari 12 kali = 16%</td>
																								<td style="min-width:50px">50.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">50.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">66.67%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">83.33%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 4 :
Persentase peningkatan kualitas penyelenggaraan pemerintahan kecamatan dan kelurahan</td>
																								<td style="min-width:50px">0%</td>
																								<td style="min-width:50px">10%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">10%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 5 :
Persentase kelembagaan sesuai dengan urusan dan kewenangannya</td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">85%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 6 :
Cakupan OPD yang sudah memiliki dan menerapkan SOP dan standar pelayanan</td>
																								<td style="min-width:50px">40%</td>
																								<td style="min-width:50px">64%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">64%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">76%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">88%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 7 :
Tingkat ketepatan dan kesesuaian penyampaian laporan OPD terkait survei kepuasan masyarakat</td>
																								<td style="min-width:50px">50%</td>
																								<td style="min-width:50px">70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">70%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">80%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 8 :
Persentase tertib administrasi kewilayahan</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 9 :
Persentase penegasan batas wilayah kecamatan dan kelurahan</td>
																								<td style="min-width:50px">0% dari jumlah penegasan batas wilayah (33)</td>
																								<td style="min-width:50px">6.06%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6.06%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9.09%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">12.12%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">15.15%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SEKRETARIAT DAERAH</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program Peningkatan pelayanan perizinan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase izin yang terbit tepat waktu</td>
																								<td style="min-width:50px">NA</td>
																								<td style="min-width:50px">0.75</td>
																								<td style="min-width:50px">630984000.00</td>
																								<td style="min-width:50px">0.76</td>
																								<td style="min-width:50px">664489250.40</td>
																								<td style="min-width:50px">0.77</td>
																								<td style="min-width:50px">699534413.47</td>
																								<td style="min-width:50px">0.8</td>
																								<td style="min-width:50px">736176026.04</td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px">774471902.92</td>
																								<td style="min-width:50px">0.85</td>
																								<td style="min-width:50px">774471902.92</td>
																								<td style="min-width:50px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3:
Program Penataan Administrasi Kependudukan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase layanan yang sesuai standar
manajemen mutu</td>
																								<td style="min-width:50px">n/a</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2770000000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">2917087000.00</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3070934168.38</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3231789700.12</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3399907400.32</td>
																								<td style="min-width:50px">100%</td>
																								<td style="min-width:50px">3399907400.32</td>
																								<td style="min-width:50px">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 :
Program Pelayanan Administrasi Kependudukan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan Kepemilikan Dokumen Kependudukan</td>
																								<td style="min-width:50px">81%</td>
																								<td style="min-width:50px">83%</td>
																								<td style="min-width:50px">240000000.00</td>
																								<td style="min-width:50px">84,5%</td>
																								<td style="min-width:50px">252744000.00</td>
																								<td style="min-width:50px">86%</td>
																								<td style="min-width:50px">266073718.56</td>
																								<td style="min-width:50px">88%</td>
																								<td style="min-width:50px">280010659.938</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">294576814.47</td>
																								<td style="min-width:50px">90%</td>
																								<td style="min-width:50px">294576814.47</td>
																								<td style="min-width:50px">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 :
Cakupan Kepemilikan Dokumen Catatan Sipil</td>
																								<td style="min-width:50px">74%</td>
																								<td style="min-width:50px">76%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">78%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">81%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">84%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">86%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">86%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 2:
Tersedianya sistem pelayanan terpadu yang didukung oleh IT</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Pelayanan publik berbasis IT</td>
																								<td style="min-width:50px">10 OPD</td>
																								<td style="min-width:50px">16</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">25</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">35</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">55</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program pengembangan komunikasi, informasi, media massa dan pemanfaatan teknologi informasi</td>
																								<td style="min-width:50px">Indikator Program 1 : Presentase perangkat daerah yang sudah menerapkan e-goverment/Aplikasi yang terintegrasi</td>
																								<td style="min-width:50px">0.18181818181818182</td>
																								<td style="min-width:50px">29.09%</td>
																								<td style="min-width:50px">3101000000.00</td>
																								<td style="min-width:50px">45.45%</td>
																								<td style="min-width:50px">3265663100.00</td>
																								<td style="min-width:50px">63.64%</td>
																								<td style="min-width:50px">3437894171.89</td>
																								<td style="min-width:50px">83.64%</td>
																								<td style="min-width:50px">3617971068.62</td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px">3806177923.61</td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px">3806177923.61</td>
																								<td style="min-width:50px">DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Program 2 : Presentase perangkat daerah yang sudah melaksanakan keterbukaan informasi publik</td>
																								<td style="min-width:50px">0.18181818181818182</td>
																								<td style="min-width:50px">29.09%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">45.45%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">63.64%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">83.64%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">100.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOMUNIKASI, INFORMATIKA, PERSANDIAN DAN STATISTIK</td>
																							</tr>
																							<tr class="success">
																								<td style="min-width:50px" colspan="17">MISI 5 : Mengembangkan sarana prasarana dan sistem perekonomian yang mendukung kreativitas dan inovasi masyarakat Kabupaten Sumedang</td>
																								
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">TUJUAN 1:
Terwujudnya perekonomian Sumedang yang kreatif dan berdaya saing</td>
																								<td style="min-width:50px">Indikator Tujuan 1 :
Laju Pertumbuhan Ekonomi</td>
																								<td style="min-width:50px">6.34</td>
																								<td style="min-width:50px">5,94-6,97</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,07-7,04</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,20-7,12</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,31-7,19</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,40-7,29</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,40-7,29</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Angka Kemiskinan</td>
																								<td style="min-width:50px">9.76</td>
																								<td style="min-width:50px">9,74-9,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9,18-8,94</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,89-8,52</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,46-7,93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1:
Meningkatnya kualitas sumberdaya manusia dari usaha mikro lokal</td>
																								<td style="min-width:50px">Indikator Sasaran 1:
Pertumbuhan sektor industri pengolahan (usaha mikro yang bergerak dalam industri pengolahan)</td>
																								<td style="min-width:50px">5.29%</td>
																								<td style="min-width:50px">5.30%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.32%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.34%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.35%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.36%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.36%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2:
Pertumbuhan sektor Perdagangan</td>
																								<td style="min-width:50px">4.94%</td>
																								<td style="min-width:50px">4.95%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.97%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">4.99%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.00%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.02%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program pengembangan industri kecil dan menengah</td>
																								<td style="min-width:50px">Indikator Program 1 :
Pertumbuhan jumlah IKM</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">240</td>
																								<td style="min-width:50px">300000000.00</td>
																								<td style="min-width:50px">240</td>
																								<td style="min-width:50px">315930000.00</td>
																								<td style="min-width:50px">240</td>
																								<td style="min-width:50px">332592148.20</td>
																								<td style="min-width:50px">240</td>
																								<td style="min-width:50px">350013324.92</td>
																								<td style="min-width:50px">240</td>
																								<td style="min-width:50px">368221018.09</td>
																								<td style="min-width:50px">1200</td>
																								<td style="min-width:50px">368221018.09</td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program peningkatan efisiensi perdagangan dalam negeri
</td>
																								<td style="min-width:50px">Indikator Program 2 :
Cakupan pelaku usaha perdagangan yang dibina</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">150 orang</td>
																								<td style="min-width:50px">725000000.00</td>
																								<td style="min-width:50px">65 orang</td>
																								<td style="min-width:50px">763497500.00</td>
																								<td style="min-width:50px">65 orang</td>
																								<td style="min-width:50px">803764358.15</td>
																								<td style="min-width:50px">65 orang</td>
																								<td style="min-width:50px">845865535.230</td>
																								<td style="min-width:50px">65 orang</td>
																								<td style="min-width:50px">889867460.37</td>
																								<td style="min-width:50px">310</td>
																								<td style="min-width:50px">889867460.37</td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 2:
Tersedianya Fasilitas pendukung wirausaha</td>
																								<td style="min-width:50px">Indikator Sasaran 1:
Persentase Koperasi aktif </td>
																								<td style="min-width:50px">72.01%</td>
																								<td style="min-width:50px">73.37%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.53%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.69%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">73.86%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.01%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">74.01%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
Persentase pasar tradisional yang direvitalisasi
</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5 pasar</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program Penguatan Kelembagaan Koperasi</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Koperasi aktif </td>
																								<td style="min-width:50px">423</td>
																								<td style="min-width:50px">436</td>
																								<td style="min-width:50px">485000000.00</td>
																								<td style="min-width:50px">450</td>
																								<td style="min-width:50px">510753500.00</td>
																								<td style="min-width:50px">454</td>
																								<td style="min-width:50px">537690639.59</td>
																								<td style="min-width:50px">456</td>
																								<td style="min-width:50px">565854875.29</td>
																								<td style="min-width:50px">458</td>
																								<td style="min-width:50px">595290645.90</td>
																								<td style="min-width:50px">458</td>
																								<td style="min-width:50px">595290645.90</td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program pengembangan lembaga ekonomi pedesaan</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase lembaga ekonomi pedesaan yang aktif</td>
																								<td style="min-width:50px">35</td>
																								<td style="min-width:50px">43%</td>
																								<td style="min-width:50px">358312000.00</td>
																								<td style="min-width:50px">36%</td>
																								<td style="min-width:50px">377338367.20</td>
																								<td style="min-width:50px">39%</td>
																								<td style="min-width:50px">397239192.69</td>
																								<td style="min-width:50px">42%</td>
																								<td style="min-width:50px">418046581.599</td>
																								<td style="min-width:50px">45%</td>
																								<td style="min-width:50px">439793364.77</td>
																								<td style="min-width:50px">45%</td>
																								<td style="min-width:50px">439793364.77</td>
																								<td style="min-width:50px">DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Program pemberdayaan, penataan dan perlindungan pasar rakyat</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah pasar yang di revitalisasi</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px">1092500000.00</td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px">1150511750.00</td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px">1211189739.70</td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px">1274631858.26</td>
																								<td style="min-width:50px">1 pasar</td>
																								<td style="min-width:50px">1340938207.53</td>
																								<td style="min-width:50px">5 pasar</td>
																								<td style="min-width:50px">1340938207.53</td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 3 : Meningkatnya penanaman modal di Kabupaten Sumedang</td>
																								<td style="min-width:50px">Indikator Sasaran 1 : Jumlah nilai investasi di Sumedang</td>
																								<td style="min-width:50px">9966078815</td>
																								<td style="min-width:50px">7063682158</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7464857128</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8230032097</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8813207066</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9396382036</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9396382036</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program peningkatan penanaman modal daerah</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase peningkatan jumlah investor</td>
																								<td style="min-width:50px">NA</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">770000000.00</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">810887000.00</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">853653180.38</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">898367533.968</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">945100613.09</td>
																								<td style="min-width:50px">0.1</td>
																								<td style="min-width:50px">945100613.09</td>
																								<td style="min-width:50px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program peningkatan promosi dan kemitraan penanaman modal</td>
																								<td style="min-width:50px">Indikator Program 1 :
Persentase kerjasama penanaman modal yang ditindaklanjuti</td>
																								<td style="min-width:50px">NA</td>
																								<td style="min-width:50px">0</td>
																								<td style="min-width:50px">0.00</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">500000000.00</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">526370000.00</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">553941260.600</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">582757284.98</td>
																								<td style="min-width:50px">1</td>
																								<td style="min-width:50px">582757284.98</td>
																								<td style="min-width:50px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
																							</tr>
																							<tr class="warning">
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Tujuan 2:
Terwujudnya perluasan kesempatan kerja, pelatihan kerja serta sertifikasi keahlian sehingga mampu memenuhi kebutuhan lapangan kerja</td>
																								<td style="min-width:50px">Indikator Tujuan 1 :
Tingkat Pengangguran Terbuka</td>
																								<td style="min-width:50px">7.04%</td>
																								<td style="min-width:50px">7,41-6,45</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,29-6,38</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,17-6,30</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,06-6,23</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,97-6,14</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">6,97-6,14</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Tujuan 2:
Angka Kemiskinan</td>
																								<td style="min-width:50px">9.76</td>
																								<td style="min-width:50px">9,74-9,59</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">9,18-8,94</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,89-8,52</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">8,46-7,93</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">7,87-7,46</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">SASARAN 1 : Membuka lapangan kerja dan menciptakan tenaga kerja kompeten yang memenuhi kebutuhan pasar</td>
																								<td style="min-width:50px">Indikator Sasaran 1 :
Persentase Tenaga Kerja yang ditempatkan</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Indikator Sasaran 2 :
jumlah wirausahawan </td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">1.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">5.000*</td>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 1 :
Program peningkatan kesempatan kerja</td>
																								<td style="min-width:50px">Indikator Program 1 :
cakupan tenaga kerja yang terdaftar yang ditempatkan</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">620000000.00</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">652922000.00</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">687357106.28</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">723360871.507</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">760990104.04</td>
																								<td style="min-width:50px">16%</td>
																								<td style="min-width:50px">760990104.04</td>
																								<td style="min-width:50px">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 2 :
Program peningkatan kualitas dan produktivitas tenaga kerja</td>
																								<td style="min-width:50px">Indikator Program 1 :
Cakupan tenaga kerja yang bersertifikasi</td>
																								<td style="min-width:50px">10%</td>
																								<td style="min-width:50px">15%</td>
																								<td style="min-width:50px">2830046000.00</td>
																								<td style="min-width:50px">20%</td>
																								<td style="min-width:50px">2980321442.60</td>
																								<td style="min-width:50px">25%</td>
																								<td style="min-width:50px">3137503595.48</td>
																								<td style="min-width:50px">30%</td>
																								<td style="min-width:50px">3301846033.814</td>
																								<td style="min-width:50px">35%</td>
																								<td style="min-width:50px">3473608064.49</td>
																								<td style="min-width:50px">35%</td>
																								<td style="min-width:50px">3473608064.49</td>
																								<td style="min-width:50px">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 3 :
Pengembangan kewirausahaan dan keunggulan kompetitif usaha kecil menengah
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Peningkatan jumlah wirausaha dan usaha kecil menengah</td>
																								<td style="min-width:50px">15.467 UMKM</td>
																								<td style="min-width:50px">15.482 UMKM</td>
																								<td style="min-width:50px">1454000000.00</td>
																								<td style="min-width:50px">15.502 UMKM</td>
																								<td style="min-width:50px">1531207400.00</td>
																								<td style="min-width:50px">15.527 UMKM</td>
																								<td style="min-width:50px">1611963278.28</td>
																								<td style="min-width:50px">15.557 UMKM</td>
																								<td style="min-width:50px">1696397914.792</td>
																								<td style="min-width:50px">15.592 UMKM</td>
																								<td style="min-width:50px">1784644534.32</td>
																								<td style="min-width:50px">15.592 UMKM</td>
																								<td style="min-width:50px">1784644534.32</td>
																								<td style="min-width:50px">DINAS KOPERASI, USAHA KECIL MENENGAH, PERINDUSTRIAN DAN PERDAGANGAN</td>
																							</tr>
																							<tr>
																								<td style="min-width:50px"></td>
																								<td style="min-width:50px">Program 4 :
Program Pengembangan Ekonomi Kreatif
</td>
																								<td style="min-width:50px">Indikator Program 1 :
Jumlah Sektor Ekonomi Kreatif yang dikembangkan</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">400000000.00</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">421240000.00</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">443456197.60</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">466684433.23</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">490961357.45</td>
																								<td style="min-width:50px">9 SUBSEKTOR</td>
																								<td style="min-width:50px">490961357.45</td>
																								<td style="min-width:50px">DINAS PARIWISATA, KEBUDAYAAN, KEPEMUDAAN DAN OLAHRAGA</td>
																							</tr>
																							</tbody>
																						</table>
																		 	</div>
																		 	 	</div>
																		 	 	 	</div>
																		 	 	 	 	</div>