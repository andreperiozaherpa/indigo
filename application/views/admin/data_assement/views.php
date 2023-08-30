<style type="text/css">
	.posisi tbody tr td{
		width: 100px;
		height: 100px;
		text-align: center;
		vertical-align: middle;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Assesment : Profilling Kompetensi Eselon III</h4>
			<h4 class="page-title"><small>Tanggal : 2019 | Tempat : Sumedang</small></h4>
		 </div>
			<div class="col-lg-6 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<?php echo breadcrumb($this->uri->segment_array()); ?>
				</ol>
			</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="white-box">
						<div class="row">
								<a href="#" style="color:grey"><i class="ti-printer pull-right"></i></a>
						</div>
						<div class="row">
							<h5 class="text-center"><b>LAPORAN HASIL Profilling Kompetensi Eselon III</b></h5>
							<br>
							<div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td style="width:20%">Nama</td>
                            <td>: Nandang Koswara</td>
                        </tr>
                        <tr>
                            <td style="width:20%">NIP</td>
                            <td>: 1234567890</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Jabatan</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Golongan</td>
                            <td>: IV/a</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Jenis Kelamin</td>
                            <td>: Laki-laki</td>
                        </tr>
                    </tbody>
                </table>
            </div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<th>Jabatan yang dilamar</th>
									</tr>
									<tr>
										<td>Sekretaris Dinas DMPTSP</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<th colspan="2">Peringkat</th>
									</tr>
									<tr>
										<td>1</td>
										<td>Dari 60 pelamar</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<th>Nilai Kompetensi</th>
										<th>Nilai Kinerja</th>
									</tr>
									<tr>
										<td>97</td>
										<td>85</td>
									</tr>
								</table>
							</div>
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<th>Nilai Kinerja Pegawai</th>
										<th>Nilai Perilaku</th>
										<th>Sasaran Kinerja Pegawai</th>
									</tr>
									<tr>
										<td>87</td>
										<td>93</td>
										<td>94</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-4 col-xs-12">
					<div class="white-box">
						<?php 
							$kompetensi = 50;
							$kinerja = 50;

							if($kompetensi<=50){
								$n_kompetensi = 1;
							}elseif($kompetensi>50 && $kompetensi <= 85){
								$n_kompetensi = 2;
							}elseif($kompetensi>85){
								$n_kompetensi = 3;
							}


							if($kinerja<=70){
								$n_kinerja = 1;
							}elseif($kinerja>70 && $kinerja <= 97){
								$n_kinerja = 2;
							}elseif($kinerja>97){
								$n_kinerja = 3;
							}

							//box 1
							if($n_kompetensi==1&&$n_kinerja==1){ 
								$posisi = "I";
							}
							//box 2 
							elseif($n_kompetensi==2&&$n_kinerja==1)
							{
								$posisi = "II";
							}
							//box 3
							elseif($n_kompetensi==3&&$n_kinerja==1)
							{
								$posisi = "III";
							}
							//box 4
							elseif($n_kompetensi==1&&$n_kinerja==2)
							{
								$posisi = "IV";
							}
							//box 5
							elseif($n_kompetensi==1&&$n_kinerja==3)
							{
								$posisi = "V";
							}
							//box 6
							elseif($n_kompetensi==2&&$n_kinerja==2)
							{
								$posisi = "VI";
							}
							//box 7
							elseif($n_kompetensi==3&&$n_kinerja==2)
							{
								$posisi = "VII";
							}
							//box 8
							elseif($n_kompetensi==2&&$n_kinerja==3)
							{
								$posisi = "VIII";
							}
							//box 9
							elseif($n_kompetensi==3&&$n_kinerja==3)
							{
								$posisi = "IX";
							}

							$image = '<img src="https://e-office.sumedangkab.go.id/data/foto/pegawai/user-default.png" alt="user-img" style=" object-fit: cover;width: 40px;height: 40px;border-radius: 50%;">';
						?>
						<div class="table-responsive">
							<table class="table table-bordered posisi">
								<tbody>
									<tr>
										<td>MS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi=="III" ? $image : "III"?></b></td>
										<td style="background-color:#00FF00;color:black;"><b><?=$posisi=="VII" ? $image : "VII"?></b></td>
										<td style="background-color:green;color:black;"><b><?=$posisi=="IX" ? $image : "IX"?></b></td>
									</tr>
									<tr>
										<td>MMS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi=="II" ? $image : "II"?></b></td>
										<td class="text-center" style="background-color:yellow;"><b><?=$posisi=="VI" ? $image : "VI"?></b></td>
										<td style="background-color:#00FF00;color:black;"><b><?=$posisi=="VIII" ? $image : "VIII"?></b></td>
									</tr>
									<tr>
										<td >BMS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi=="I" ? $image : "I"?></b></td>
										<td class="warning" style="background-color:yellow;color:black;"><b><?=$posisi=="IV" ? $image : "IV"?></b></td>
										<td class="warning" style="background-color:yellow;color:black;"><b><?=$posisi=="V" ? $image : "V"?></b></td>
									</tr>
									<tr>
										<td></td>
										<td>K</td>
										<td>C</td>
										<td>B</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<td colspan="2" class="text-center"> KOMPETENSI</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td width="30%">MS</td>
										<td width="70%">Memenuhi Syarat</td>
									</tr>
									<tr>
										<td width="30%">MMS</td>
										<td width="70%">Masih Memenuhi Syarat</td>
									</tr>
									<tr>
										<td width="30%">BMS</td>
										<td width="70%">Belum Memenuhi Syarat</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<td colspan="2" class="text-center"> KINERJA</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td width="30%">K</td>
										<td width="70%">Kurang</td>
									</tr>
									<tr>
										<td width="30%">C</td>
										<td width="70%">Cukup</td>
									</tr>
									<tr>
										<td width="30%">B</td>
										<td width="70%">Baik</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
      </div>
