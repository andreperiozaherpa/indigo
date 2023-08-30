<html>
	<head>
	 <!-- Bootstrap -->
    <link href="<?php echo base_url()."asset/admin/" ;?>js/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.verticalTableHeader{
		 text-align:center;
		 vertical-align:middle !important; 
		}
    </style>
    
		<title>REKAPITULASI PERIZINAN</title>
	</head>
	<body>



<h4 align="center">
	REALISASI INVESTASI PMDN PROYEK/KEGIATAN USAHA TIDAK WAJIB LKPM (NON LKPM / NON SPIPISE)	<br>														
BERDASARKAN IZIN USAHA BARU YANG DITERBITKAN KABUPATEN SUMEDANG	<br>														
TANGGAL <?=$tgl_awal;?> SAMPAI DENGAN TANGGAL <?=$tgl_akhir;?>	</br>												
								
</h4>
<br>



<table class="table table-bordered table-striped" border="1">
	<thead>
		<tr>
			<th class='verticalTableHeader' rowspan="2">NO</th>
			<th class='verticalTableHeader' rowspan="2">NAMA PERUSAHAAN</th>
			<th class='verticalTableHeader' rowspan="2">BENTUK USAHA</th>
			<th class='verticalTableHeader' rowspan="2">ALAMAT PERUSAHAAN / NO HP</th>
			<th class='verticalTableHeader' rowspan="2">NO SIUP (BARU)</th>
			<th class='verticalTableHeader' rowspan="2">TANGGAL SIUP</th>
			<th class='verticalTableHeader' rowspan="2">NPWP</th>
			<th class='verticalTableHeader' rowspan="2">NAMA PEMILIK / PENANGGUNG JAWAB</th>
			<th class='verticalTableHeader' rowspan="2">SEKTOR</th>
			<th class='verticalTableHeader' rowspan="2">BIDANG USAHA</th>
			<th class='verticalTableHeader' rowspan="2">KBLI</th>
			<th class='verticalTableHeader' rowspan="2">JENIS BARANG / JASA DAGANGAN UTAMA</th>
			<th class='verticalTableHeader' rowspan="2">NILAI INVESTASI (Rp)</th>
			<th class='verticalTableHeader' colspan="2">JML TENAGA KERJA</th>
		</tr>
		<tr>
			<th class='verticalTableHeader'>TKI</th>
			<th class='verticalTableHeader'>TKA</th>
		</tr>
		<tr>
			<td class='verticalTableHeader'>1</td>
			<td class='verticalTableHeader'>2</td>
			<td class='verticalTableHeader'>3</td>
			<td class='verticalTableHeader'>4</td>
			<td class='verticalTableHeader'>5</td>
			<td class='verticalTableHeader'>6</td>
			<td class='verticalTableHeader'>7</td>
			<td class='verticalTableHeader'>8</td>
			<td class='verticalTableHeader'>9</td>
			<td class='verticalTableHeader'>10</td>
			<td class='verticalTableHeader'>11</td>
			<td class='verticalTableHeader'>12</td>
			<td class='verticalTableHeader'>13</td>
			<td class='verticalTableHeader'>14</td>
			<td class='verticalTableHeader'>15</td>
		</tr>
		
	</thead>
	<?=$row_data;?>
 </table>
	</body>
</html>