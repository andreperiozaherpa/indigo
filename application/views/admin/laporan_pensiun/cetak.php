<?php
function selisih($tgl1,$tgl2) // tgl1 < tgl2
{
	$hari1=gregoriantojd(date('m',strtotime($tgl1)),date('d',strtotime($tgl1)),date('Y',strtotime($tgl1)));
	$hari2=gregoriantojd(date('m',strtotime($tgl2)),date('d',strtotime($tgl2)),date('Y',strtotime($tgl2)));
	$selisih=$hari2 - $hari1;
	$tahun=round($selisih/365);
	$sisa=round($selisih%365);
	$bulan=round($sisa/30);
	$hari=round($sisa%30);
	return array(
		'tahun' => $tahun,
		'bulan' => $bulan,
		'hari'  => $hari
	);
}
?>
<html>
<head>
<title>Cetak </title>
 <!-- Bootstrap -->
    <link href="<?php echo base_url()."asset/admin/" ;?>js/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
       
<div class='row' >
<div class="col-md-2"></div>
<div class="col-md-8"><img src="<?php echo base_url()."data/images/kop/kop_bkd.jpg" ;?>" width="" alt="" /></div>
<div class="col-md-2"></div>
</div>


<div class='row' >
<div class="col-md-2"></div>
<div class="col-md-8">
<h4 align='center'>BIODATA PEGAWAI</h4>

<hr>
<h5> <strong> A. IDENTITAS PEGAWAI </strong></H5>
<hr>

<table class='table'>
<tr>
<td>1. </td> <td>NIP </td> <td>:<td align="left"><?=$pegawai['nip_baru'];?></td><td align="right">Karpeg </td> <td>:<td align="left"><?= $pegawai['karpeg'];?></td></tr>
<tr><td>2. </td> <td>a. NAMA </td> <td>:<td align="left" colspan='4'><?=$pegawai['nama_lengkap'];?></td></tr>
<tr><td> </td> <td>b. Gelar Depan </td><td>:</td><td><?=$pegawai['nama_gelardepan'];?></td><td align="right">Gelar Belakang </td><td>:</td><td><?=$pegawai['nama_gelarbelakang'];?></td></tr>
<tr><td>3. </td> <td> Tempat, Tgl. Lahir </td> <td>:<td align="left" colspan='4'><?= $pegawai['tempat_lahir']." ". date("d M Y",strtotime($pegawai['tgl_lahir']));?></td></tr>
<tr><td>4. </td> <td> Jenis Kelamin </td> <td>:<td align="left" colspan='4'><?= $pegawai['jenis_kelamin']=="1"? "Laki-laki":"Perempuan";?></td></tr>
<tr><td>5. </td> <td> Agama </td> <td>:<td align="left" colspan='4'><?= $pegawai['nama_agama'];?></td></tr>
<tr><td>6. </td> <td>Pendidikan Terakhir </td> <td>:<td align="left" colspan='4'> </td></tr>
<tr><td> </td> <td>a. Tingkat </td><td>:</td><td colspan='3'><?= !empty($pendidikan)? $pendidikan[0]->nama_jenjangpendidikan : "";?> </td></tr>
<tr><td> </td> <td>b. Tahun Lulus </td><td>:</td><td colspan='3'><?= !empty($pendidikan)? date('Y',strtotime($pendidikan[0]->tgl_sk)) : "";?> </td></tr>
<tr><td> </td> <td>c. Jurusan </td><td>:</td><td colspan='3'><?= !empty($pendidikan)? $pendidikan[0]->nama_jurusan:"";?></td></tr>
<tr><td> </td> <td>d. Nama Sekolah </td><td>:</td><td colspan='3'><?= !empty($pendidikan)?$pendidikan[0]->nama_tempatpendidikan:"";?> </td></tr>
<tr><td>7. </td> <td>a. Pangkat/GOL. Ruang/TMT </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat)?$pangkat[0]->golongan." / ". $pangkat[0]->pangkat ." / ". date('d M Y',strtotime($pangkat[0]->tmt_berlaku)) :"";?></td></tr>
<tr><td> </td> <td>b. Pejabat yang menetapkan </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat)? $pangkat[0]->nama_pejabat : "";?></td></tr>
<tr><td> </td> <td>c. Nomor / Tanggal SK </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat) ? $pangkat[0]->no_sk ." - ". date('d M Y',strtotime($pangkat[0]->tgl_sk)):"";?></td></tr>
<tr><td> </td> <td>d. Masa Kerja Sesuai SK </td> <td>:<td align="left" colspan='4'>
<?php
$masa_kerja_pangkat = "";
if (!empty($pangkat)){
	$masa_pangkat = selisih($pangkat[0]->tgl_sk,$pangkat[0]->tmt_berlaku);
	$masa_kerja_pangkat = $masa_pangkat['tahun'] . " tahun " . $masa_pangkat['bulan'] . " bulan";
}
?>
<?= $masa_kerja_pangkat;?></td></tr>
<tr><td>8. </td> <td>a. Jabatan/TMT </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan)? $jabatan[0]->nama_jabatan ." / ". date('d M Y',strtotime($jabatan[0]->tgl_akhir)) : "";?></td></tr>
<tr><td> </td> <td>b. Pejabat yang menetapkan </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan) ? $jabatan[0]->nama_pejabat : "" ;?></td></tr>
<tr><td> </td> <td>c. Nomor / Tanggal PAK </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan)? $jabatan[0]->no_sk ." / ". date('d M Y',strtotime($jabatan[0]->tgl_sk)) : "";?></td></tr>
<tr><td> </td> <td>d. Jenis Jabatan </td> <td>:<td align="left" colspan='4'> ? </td></tr>
<tr><td> </td> <td>e. Eselon </td> <td>:<td align="left" colspan='4'> ?</td></tr>
<tr><td> </td> <td>f. Jenis Jabatan </td> <td>:<td align="left"  colspan='4'> ? </td></tr>
<tr><td> </td> <td> - Sumpah Jabatan </td><td>:<td align="left"  colspan='4'>?</td> </tr>
<tr><td> </td> <td> - Angka Kredit</td><td>:<td align="left"  colspan='4'> ? </td> </tr>
<tr><td> 9.</td> <td>Diklat Penjenjangan  </td> <td>:<td align="left"  colspan='4'>  </td></tr>
<tr><td> </td> <td> - Jumlah Jam </td><td>:<td align="left"  colspan='4'>?</td> </tr>
<tr><td> </td> <td> - Tahun Lulus</td><td>:<td align="left"  colspan='4'> ? </td> </tr>
<tr><td> 10.</td> <td>a.Status Kepegawaian  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kedudukan_pegawai'];?></td></tr>
<tr><td> </td> <td>b. Status Guru  </td> <td>:<td align="left"  colspan='4'> ?</td></tr>
<tr><td> 11.</td> <td>a.Jenis Kepegawaian  </td> <td>:<td align="left"  colspan='4'> ?  </td></tr>
<tr><td> </td> <td>b. Jenis Pekerjaan  </td> <td>:<td align="left"  colspan='4'> ?  </td></tr>
<tr><td>12. </td> <td>Kedudukan Hukum Pegawai </td> <td>:<td align="left" colspan='4'> ? </td></tr>
<tr><td>13. </td> <td>a.No Statik Sekolah </td> <td>:<td align="left" colspan='4'>?<?= !empty($unit_kerja)? $unit_kerja[0]->id_unit_kerja : "";?></td></tr>
<tr><td> </td> <td>b. Nama Unit Kerja </td> <td>:<td align="left" colspan='4'>?<?= !empty($unit_kerja)? $unit_kerja[0]->nama_skpd : "";?></td></tr>
<tr><td> </td> <td>c. Alamat Unit Kerja</td> <td>:<td align="left" colspan='4'>?<?= !empty($unit_kerja)? $unit_kerja[0]->alamat : "";?></td></tr>
<tr><td> </td> <td>d. Masa Kerja Sesuai SK </td> <td>:<td align="left" colspan='4'>
	<?php
		$masa_kerja_unit = "";
		if (!empty($unit_kerja)){
			$masa_unit = selisih($unit_kerja[0]->tmt_awal,$unit_kerja[0]->tmt_akhir);
			$masa_kerja_unit = $masa_unit['tahun'] . " tahun " . $masa_unit['bulan'] . " bulan";
		}
		
		echo $masa_kerja_unit;
	?>
</td></tr>
<tr><td> </td> <td>e. Mulai Tugas di unit kerja </td> <td>:<td align="left" colspan='4'> <?= !empty($unit_kerja)? date("d M Y",strtotime($unit_kerja[0]->tmt_awal)):"";?></td></tr>
<tr><td> 14. </td> <td>a.Tugas Utama</td> <td>:<td align="left" > -  </td><td>Jumlah </td><td>-</td></tr>
<tr><td> </td> <td>b. Tugas lainya</td> <td>:<td align="left" > -  </td><td>Jumlah </td><td>-</td></tr>
<tr><td> </td> <td> </td> <td> <td align="left" >  </td><td>Jumlah </td><td>-</td></tr>
<tr><td> 15.</td> <td colspan='5'>Kenaikan Gaji Berkala  </td > </tr>
<tr><td> </td> <td>-TMT Terakhir  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Masa Kerja  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-No. SK Gaji Berkala , Tanggal  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> 16.</td> <td colspan='5'>Pengangkatan Sebagai PNS  </td > </tr>
<tr><td> </td> <td>-TMT   </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-SK PNS  </td> <td>:<td align="left"  colspan='4'> Nomor : -  </td></tr>
<tr><td> 17.</td> <td colspan='5'>Pengangkatan Sebagai CPNS  </td > </tr>
<tr><td> </td> <td>-TMT   </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
<tr><td> </td> <td>-SK CPNS  </td> <td>:<td align="left"  colspan='4'> Nomor : -  </td></tr>
<tr><td> </td> <td>-Masa Kerja  </td> <td>:<td align="left"  colspan='4'> - Tahun ,  - Bulan  </td></tr>
<tr><td> 18.</td> <td colspan='5'>Nomer-Nomer Kartu  </td > </tr>
<tr><td> </td> <td>-Kartu ASKES   </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kartu_askes'];?></td></tr>
<tr><td> </td> <td>-Kartu Taspen  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kartu_taspen'];?></td></tr>
<tr><td> </td> <td>-Karis/Karsu</td> <td>:<td align="left"  colspan='4'><?= $pegawai['karis_karsu'];?></td></tr>
<tr><td> </td> <td>-NPWP  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['npwp'];?></td></tr>
<tr><td> 19.</td> <td colspan='5'>Alamat Tempat Tinggal  </td > </tr>
<tr><td> </td> <td>jln.    </td> <td>:<td align="left"  colspan='4'><?=$pegawai['alamat'];?></td></tr>
<tr><td> </td> <td>RT  </td> <td>:<td align="left"><?= $pegawai['RT'];?></td><td align="right"> RW  </td> <td>:<td align="left"><?= $pegawai['RW'];?></td></tr>
<tr><td> </td> <td>Telepon  </td> <td>:<td align="left"><?=$pegawai['telepon'];?></td><td align="right"> Kode POS  </td> <td>:<td align="left"><?=$pegawai['kode_pos'];?></td></tr>
<tr><td> </td> <td>Desa / Kelurahan</td> <td>:<td align="left"  colspan='4'><?=$pegawai['desa'];?></td></tr>
<tr><td> </td> <td>Kecamatan  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['kecamatan'];?></td></tr>
<tr><td> </td> <td>Kabupaten  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['kabupaten'];?></td></tr>
<tr><td> 20.</td><td>Status Perwaninan </td><td > :</td ><td colspan='4'><?=$pegawai['nama_statusmenikah'];?></td> </tr>
<tr><td> </td> <td>Jumlah Tanggungan Anak.    </td> <td>:<td align="left"  colspan='4'><?=$pegawai['jml_tanggungan_anak'];?></td></tr>
<tr><td> </td> <td>Jumlah Seluruh Anak  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['jml_seluruh_anak'];?></td></tr>
<tr><td> 21.</td> <td colspan='5'>Keterangan Badan  </td > </tr>
<tr><td> </td> <td>Golongan Darah  </td> <td>:<td align="left">  -  </td><td align="right"> Tinggi  </td> <td>:<td align="left">  -  </td></tr>
<tr><td> </td> <td>Berat Badan </td> <td>:<td align="left">  -  </td><td align="right"> Rambut  </td> <td>:<td align="left">  -  </td></tr>
<tr><td> </td> <td>Bentuk Muka </td> <td>:<td align="left">  -  </td><td align="right"> Warna Kulit  </td> <td>:<td align="left">  -  </td></tr>
<tr><td> </td> <td>Ciri Khas </td> <td>:<td align="left">  -  </td><td align="right"> Cacat Tubuh </td> <td>:<td align="left">  -  </td></tr>
<tr><td>22. </td> <td> Hobby </td> <td>:<td align="left" colspan='4'>-</td></tr>
</table>

<hr>
<h5> <strong> B. KEMAMPUAN BAHASA </strong></H5>
<hr>
<div class="row">
	<div class="col-md-6">
		1. Bahasa Daerah
		<table class="table table-bordered">
		<tr><td>No</td><td>Nama Bahasa</td><td>Kemampuan Bahasa </td>
		<tr><td>1</td><td>-</td><td>- </td>
		<tr><td>2</td><td>-</td><td>- </td>
		</table>
	</div>
	<div class="col-md-6">
		2. Bahasa Asing
		<table class="table table-bordered">
		<tr><td>No</td><td>Nama Bahasa</td><td>Kemampuan Bahasa </td>
		<tr><td>1</td><td>-</td><td>- </td>
		<tr><td>2</td><td>-</td><td>- </td>
		</table>
	</div>
</div>	


<hr>
<h5> <strong> C. RIWAYAT PENDIDIKAN </strong></H5>
<hr>


		<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2">Nama Sekolah</td><td rowspan="2" >Jurusan Pendidikan</td><td rowspan="2" >Tempat</td><td colspan="3" >
STTB/ Tanda Lulus / Ijazah
</td>
</tr>
<tr><td>Nomor</td><td>Tahun</td><td>Pejabat</td></tr>
<?php
	if(!empty($pendidikan)){
		foreach($pendidikan as $row){
			echo"<tr><td >$row->nama_tempatpendidikan</td><td >$row->nama_jurusan</td><td >?</td><td >$row->nomor_sk</td><td >".date('Y',strtotime($row->tgl_sk))."</td><td >$row->nama_pejabat</td></tr>";
		}
	}
	else{
		echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
	}
?>


</tbody>
</table>


<hr>
<h5> <strong> D. RIWAYAT KEPANGKATAN </strong></H5>
<hr>


<table class="table table-bordered">
<tbody>
<tr><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Pangkat</td><td rowspan="2" >Berlaku Tmt</td><td rowspan="2">Gaji Pokok</td><td colspan="3">Surat Keputusan</td></tr>
<tr><td >Pejabat</td><td >Nomor</td><td >Tanggal</td></tr>
<?php
	if (!empty($pangkat)){
		foreach($pangkat as $pangkat){
		echo"<tr>
			<td>$pangkat->golongan</td>
			<td>$pangkat->pangkat</td>
			<td>".date('d M Y',strtotime($pangkat->tmt_berlaku))."</td>
			<td>".number_format($pangkat->gaji_pokok)."</td>
			<td>$pangkat->nama_pejabat</td>
			<td>$pangkat->no_sk</td>
			<td>".date('d M Y',strtotime($pangkat->tgl_sk))."</td>
		</tr>";
		}
	}
	else{
		echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
	}
?>

</tbody>
</table>



<hr>
<h5> <strong> E. RIWAYAT PEKERJAAN / JABATAN </strong></H5>
<hr>


<table class="table table-bordered">
<tbody>
<tr><td rowspan="2" >Pekerjaan/ Jabatan</td><td colspan="2"  >Tanggal - Bulan - Tahun </td><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Gaji Pokok</td><td colspan="3"  >Surat Keputusan</td></tr>
<tr><td>Mulai</td><td>Sampai</td><td>Pejabat</td><td>Nomor</td><td>Tanggal</td></tr>
<?php
	if (!empty($jabatan)){
		foreach($jabatan as $row){
			$tgl_akhir_ = $row->tgl_akhir == "9999-12-31" ? "Sekarang" : date('d M Y',strtotime($row->tgl_akhir));
		echo"<tr>
			<td>$row->nama_jabatan</td>
			<td>".date('d M Y',strtotime($row->tgl_mulai))." </td>
			<td>".$tgl_akhir_." </td>
			<td>$row->golongan</td>
			<td>".number_format($pangkat->gaji_pokok)."</td>
			<td>$row->nama_pejabat</td>
			<td>$row->no_sk</td>
			<td>".date('d M Y',strtotime($row->tgl_sk))."</td>
		</tr>";
		}
	}
	else{
		echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
	}
?>
</tbody>
</table>


<hr>
<h5> <strong>F. RIWAYAT PENDIDIKAN DAN LATIHAN STRUKTURAL/FUNGSIONAL/TEKNIS </strong></H5>
<hr>


<table class="table table-bordered">
<tbody>
<tr><td rowspan="2" >Jenis Diklat</td><td rowspan="2" >Nama</td>
<td rowspan="2" >Tempat</td>
<td rowspan="2" >Penyelenggara</td>
<td rowspan="2" >Angkatan</td>
<td colspan="3">Lama Diklat</td>
<td colspan="2">STTPL</td>
</tr>

<tr>
<td>Mulai</td>
<td>Sampai</td>
<td>Jam</td>
<td>Nomor</td>
<td>Tanggal</td>
</tr>

<?php
	if (!empty($diklat)){
		foreach($diklat as $row){
			echo"
				<tr>
					<td>$row->nama_jenisdiklat</td>
					<td>$row->nama_diklat</td>
					<td>$row->tempat</td>
					<td>$row->penyelenggara</td>
					<td>$row->angkatan</td>
					<td>".date('d M Y',strtotime($row->tgl_mulai))."</td>
					<td>".date('d M Y',strtotime($row->tgl_akhir))."</td>
					<td>?</td>
					<td>$row->no_sptl</td>
					<td>".date('d M Y',strtotime($row->tgl_sptl))."</td>
				</tr>
			";
		}
	}
	else{
		echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
	}
?>

</tbody>
</table>



<hr>
<h5> <strong>G. RIWAYAT PENATARAN STRUKTURAL/FUNGSIONAL/TEKNIS </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Jenis </td>
<td rowspan="2" >Nama</td>
<td rowspan="2" >Tempat</td>
<td rowspan="2" >Penyelenggara</td>
<td rowspan="2" >Angkatan</td>
<td colspan="3">Lama Penataran</td>
<td colspan="2">Sttpl</td>
</tr>

<tr>
<td>Mulai</td>
<td>Sampai</td>
<td>Jam</td>
<td>Nomor</td>
<td>Tanggal</td>
</tr>

<tr>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>

</tbody>
</table>



<hr>
<h5> <strong>H. RIWAYAT SEMINAR / LOKAKARYA / SIMPOSIUM </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Jenis</td>
<td rowspan="2" >Nama</td>
<td rowspan="2" >Tempat</td>
<td rowspan="2" >Penyelenggara</td>
<td rowspan="2" >Angkatan</td>
<td colspan="3">Lama</td>
<td colspan="2">Sertifikat/Tanda Bukti</td>
</tr>

<tr>
<td>Mulai</td>
<td>Sampai</td>
<td>Jam</td>
<td>Nomor</td>
<td>Tanggal</td>
</tr>

<tr>
<td>-</td>
<td>-</td>
<td>- </td>
<td> -</td>
<td> -</td>
<td>- </td>
<td>- </td>
<td>- </td>
<td>- </td>
<td>- </td>
</tr>

</tbody>
</table>



<hr>
<h5> <strong>I. RIWAYAT KURSUS / LATIHAN  </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Jenis</td>
<td rowspan="2" >Nama</td>
<td rowspan="2" >Tempat</td>
<td rowspan="2" >Penyelenggara</td>
<td rowspan="2" >Angkatan</td>
<td colspan="3">Lama</td>
<td colspan="2">STTPL</td>
</tr>

<tr>
<td>Mulai</td>
<td>Sampai</td>
<td>Jam</td>
<td>Nomor</td>
<td>Tanggal</td>
</tr>

<tr>
<td>-</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>

</tbody>
</table>




<hr>
<h5> <strong>J. TANDA JASA / PENGHARGAAN / KEHORMATAN  </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Nama Tanda Jasa / Penghargaan / Kehormatan</td>
<td rowspan="2" >Tahun</td>
<td rowspan="2" >Asal Perolehan</td>
<td colspan="3">Surat Keputusan</td>
</tr>

<tr>
<td>Penandatangan</td>
<td>Nomor</td>
<td>Tanggal</td>
</tr>
<?php
	if (!empty($penghargaan)){
		foreach($penghargaan as $row){
			echo"
				<tr>
					<td>$row->nama_jenispenghargaan</td>
					<td>$row->tahun</td>
					<td>$row->asal_perolehan</td>
					<td>$row->penandatangan</td>
					<td>$row->no_penghargaan</td>
					<td>".date('d M Y',strtotime($row->tgl_penghargaan))."</td>
				</tr>
			";
		}
	}
	else{
		echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
	}
?>

</tbody>
</table>





<hr>
<h5> <strong>K. PENUGASAN KE LUAR NEGERI  </strong></H5>
<hr>
<table class="table table-bordered">

<tbody>
<tr>
<td rowspan="2" >Negara/Kota Tujuan</td>
<td rowspan="2" >Jenis/Kegiatan Penugasan</td>
<td colspan="3">Surat Keputusan</td>
<td colspan="2">Lama Penugasan</td>
</tr>

<tr>
<td>Pejabat Yang Mentapkan</td>
<td>Nomor</td>
<td>Tanggal</td>
<td>Tgl Mulai</td>
<td>Tgl. Selesai</td>
</tr>

<tr>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>

</tbody>
</table>

<hr>
<h5> <strong>L. RIWAYAT CUTI   </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Jenis Cuti</td>
<td rowspan="2" >Keterangan</td>
<td colspan="3">Surat Keputusan</td>
<td colspan="2">Lama Cuti</td>
</tr>

<tr>
<td>Pejabat Yang Mentapkan</td>
<td>Nomor</td>
<td>Tanggal</td>
<td>Tgl Mulai</td>
<td>Tgl. Selesai</td>
</tr>

<?php
	if (!empty($cuti)){
		foreach($cuti as $row){
			echo"
				<tr>
					<td>$row->nama_jeniscuti</td>
					<td>$row->keterangan</td>
					<td>$row->pejabat_penetapan</td>
					<td>$row->no_sk</td>
					<td>".date('d M Y',strtotime($row->tgl_sk))."</td>
					<td>".date('d M Y',strtotime($row->tgl_awal_cuti))."</td>
					<td>".date('d M Y',strtotime($row->tgl_akhir_cuti))."</td>
				</tr>
			";
		}
	}
	else{
		echo"<tr><td colspan='7'>Tidak ada data</td></tr>";
	}
?>

</tbody>
</table>


<hr>
<h5> <strong>M. RIWAYAT HUKUMAN DISIPLIN   </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td rowspan="2" >Jenis Hukuman Disiplin</td>
<td rowspan="2" >Keteranagn</td>
<td colspan="3">Surat Keputusan</td>
<td colspan="2">Lama Hukuman Disiplin</td>
</tr>

<tr>
<td>Pejabat Yang Mentapkan</td>
<td>Nomor</td>
<td>Tanggal</td>
<td>Tgl Mulai</td>
<td>Tgl. Selesai</td>
</tr>

<tr>
<td>-</td>
<td>- </td>
<td>- </td>
<td>- </td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>

</tbody>
</table>


<hr>
<h5> <strong>N. KETERANGAN KELUARGA   </strong></H5>
<hr>
a.  ISTRI / SUAMI 
<table class="table table-bordered">
<tbody>
<tr>
<td>Nama</td>
<td>Tempat Lahir</td>
<td>Tanggal Lahir</td>
<td>Tgl. Menikah</td>
<td>Pendidikan Umum</td>
<td>Pekerjaan</td>
<td>Keterangan</td>
</tr>

<tr>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>

</tbody>
</table>

b.  ANAK

<table class="table table-bordered">
<tbody>
<tr>
<td>Nama</td>
<td>Tempat Lahir</td>
<td>Tanggal Lahir</td>
<td>Jenis Kelamin</td>
<td>Pendidikan Umum</td>
<td>Pekerjaan</td>
<td>Keterangan</td>
</tr>

<tr>
<td>- </td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>


</tbody>
</table>

c.  BAPAK DAN IBU KANDUNG

<table class="table table-bordered">
<tbody>
<tr>
<td>Nama</td>
<td>Tempat Lahir</td>
<td>Tanggal Lahir</td>
<td>Jenis Kelamin</td>
<td>Pendidikan Umum</td>
<td>Pekerjaan</td>
<td>Keterangan</td>
</tr>

<tr>
<td>- </td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>


</tbody>
</table>

d.  BAPAK DAN IBU MERTUA

<table class="table table-bordered">
<tbody>
<tr>
<td>Nama</td>
<td>Tempat Lahir</td>
<td>Tanggal Lahir</td>
<td>Jenis Kelamin</td>
<td>Pendidikan Umum</td>
<td>Pekerjaan</td>
<td>Keterangan</td>
</tr>

<tr>
<td>- </td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
<td> -</td>
</tr>


</tbody>
</table>

<hr>
<h5> <strong>O. PENILAIAN SKP TAHUN TERAKHIR   </strong></H5>
<hr>
<table class="table table-bordered">
<tbody>
<tr>
<td>Unsur Yang Dinilai</td>
<td>Angka</td>
<td>Unsur Yang Dinilai</td>
<td>Angka</td>
</tr>

<tr>
<td>A. Kesetiaan</td>
<td> </td>
<td>E. Kejujuran</td>
<td> </td>
</tr>

<tr>
<td>B. Prestasi Kerja</td>
<td> </td>
<td>F. Kerjasama</td>
<td> </td>
</tr>

<tr>
<td>C. Tanggung Jawab</td>
<td> </td>
<td>G. Prakarsa</td>
<td> </td>
</tr>

<tr>
<td>D. Ketaatan</td>
<td> </td>
<td>H. Kepemimpinan</td>
<td> </td>
</tr>

</tbody>
</table>




<p>Dengan ini saya menyatakan bahwa data yang telah diisi atau tercatat dalam formulir ini adalah benar, jelas dan lengkap menurut keadaan yang sebenarnya.</p>
<div class="row" style="margin-top:40px;">
	<div class="col-md-4">
	   Mengetahui Atasan Langsung :	<br>
	   Kepala .......................
	   <br>
	   <br>
	   <br>
	   <br>
	   <br>
	   Nama..........<br>
	   Pangkat.......<br>
	   NIP...........<br>
	   
	</div>
	
	<div class="col-md-4">
	</div>
	
	<div class="col-md-4">
	Sumedang,         ............... <br>
	 Pegawai ASN .......................
	   <br>
	   <br>
	   <br>
	   <br>
	   <br>
	   Nama..........<br>
	   NIP...........<br>
	</div>
</div>









</div>
<div class="col-md-2"></div>
</div>





	   
	   
</body>
</html>