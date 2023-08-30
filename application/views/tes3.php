<?php 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"tes_360.xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style> .str{ mso-number-format:'\@'; } .num{ mso-number-format:'0\.00'; } </style>
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th width="10px">No</th>
				<th>NIP</th>
				<th>Nama Lengkap</th>
				<th>Jabatan</th>
				<th>Eselon</th>
				<th>Nilai Potensi</th>
				<th>Nilai Kinerja</th>
				<th>Rata-Rata</th>
				<th width="200px" class="text-center">Kuadran</th>
				<th class="text-center">Ranking</th>
			</tr>
			<tr>
			</tr>
		</thead>
		<tbody>
			<?php
			$n = 1;
			foreach ($list as $l) {
			?>
			    <tr>
			        <td><?= $n ?></td>
			        <td><?= "'" . $l->nip ?></td>
			        <td><?= $l->nama_lengkap ?></td>
			        <td><?= $l->jabatan ?></td>
			        <td><?= $l->eselon ?></td>
			        <td><?= $l->nilai_potensi ?></td>
			        <td><?= $l->nilai_kompetensi ?></td>
			        <td><?= $l->jumlah_nilai ?></td>
			        <td>
			            <center><span class="text-center"><b><?= $l->kuadran ?></b></span></center>
			        </td>
			        <td class="text-center"><b><?= $n ?></b></td>
			    </tr>
			<?php
			    $n++;
			}
			?>
		</tbody>
	</table>
</body>
</html>