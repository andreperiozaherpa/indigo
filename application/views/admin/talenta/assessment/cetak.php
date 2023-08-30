<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cetak Assessment</title>
    <link href="<?php echo base_url()."asset/pixel/inverse/" ;?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
	<style type="text/css">
	.posisi tbody tr td{
		width: 100px;
		height: 100px;
		text-align: center;
		vertical-align: middle;
	}
</style>
</head>

<body>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Assesment : Profilling Kompetensi Eselon <?= $detail->eselon;?></h4>
			<h4 class="page-title"><small>Tanggal : <?= date('d M Y', strtotime($detail->tgl_daftar)) ;?> | Tempat : Sumedang</small></h4>
		 </div>
			
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-md-8 col-xs-8">
					<div class="white-box">
						<div class="row">
								<a href="#" style="color:grey"><i class="ti-printer pull-right"></i></a>
						</div>
						<div class="row">
							<h5 class="text-center" style="margin-top:40px;margin-bottom:40px"><b>LAPORAN HASIL Profilling Kompetensi Eselon <?=$detail->eselon;?></b></h5>
							<br>
							<div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width:20%">Nama</td>
                                            <td>: <?= $detail->nama_lengkap;?></td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%">NIP</td>
                                            <td>: <?= $detail->nip;?></td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%">Jabatan</td>
                                            <td>: <?= $pegawai[0]['nama_jabatan'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Golongan</td>
                                            <td>: IV/a</td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%">Jenis Kelamin</td>
                                            <td>: <?=$pegawai[0]['jk'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
						<br>
						<div class="row">
							<div class="col-md-6 col-xs-6">
								<table class="table table-bordered">
									<tr>
										<th>Jabatan yang dilamar</th>
									</tr>
									<tr>
										<td><?= $detail->nama_jabatan;?></td>
									</tr>
								</table>
							</div>
							<div class="col-md-6 col-xs-6">
								<table class="table table-bordered">
									<tr>
										<th colspan="2">Peringkat</th>
									</tr>
									<tr>
										<td><?= $peringkat;?></td>
										<td>Dari <?= count($dt_summary);?> pelamar</td>
									</tr>
								</table>
							</div>
						</div>
						<?php 
						$param_potensi = array(
							1 => 'Kurang',
							2 => 'Cukup',
							3 => 'Baik'
						);
						$param_kompetensi = array(
							1 => 'Belum memenuhi syarat',
							2 => 'Masih memenuhi syarat',
							3 => 'Memenuhi syarat'
						);
							$kompetensi = $param_kompetensi[$detail->kompetensi];
							$potensi = $param_potensi[$detail->potensi];
							$posisi = $detail->box;
							
							$image = '<img src="'.base_url().'data/foto/pegawai/'.$pegawai[0]["foto_pegawai"].'" alt="user-img" style=" object-fit: cover;width: 40px;height: 40px;border-radius: 50%;">';
							?>
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<table class="table table-bordered">
									<tr>
										<th>Nilai Kompetensi</th>
										<th>Nilai Potensi</th>
									</tr>
									<tr>
										<td><?= $kompetensi;?></td>
										<td><?= $potensi;?></td>
									</tr>
								</table>
							</div>
							
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-4 col-xs-4">
					<div class="white-box">
						
						<div class="table-responsive">
							<table class="table table-bordered posisi">
								<tbody>
									<tr>
										<td>MS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi==3 ? $image : "III"?></b></td>
										<td style="background-color:#00FF00;color:black;"><b><?=$posisi==7 ? $image : "VII"?></b></td>
										<td style="background-color:green;color:black;"><b><?=$posisi==9 ? $image : "IX"?></b></td>
									</tr>
									<tr>
										<td>MMS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi==2 ? $image : "II"?></b></td>
										<td class="text-center" style="background-color:yellow;"><b><?=$posisi==6 ? $image : "VI"?></b></td>
										<td style="background-color:#00FF00;color:black;"><b><?=$posisi==8 ? $image : "VIII"?></b></td>
									</tr>
									<tr>
										<td >BMS</td>
										<td style="background-color:red;color:black;"><b><?=$posisi==1 ? $image : "I"?></b></td>
										<td class="warning" style="background-color:yellow;color:black;"><b><?=$posisi==4 ? $image : "IV"?></b></td>
										<td class="warning" style="background-color:yellow;color:black;"><b><?=$posisi==5 ? $image : "V"?></b></td>
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
										<td colspan="2" class="text-center"> POTENSI</td>
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

</body>
</html>