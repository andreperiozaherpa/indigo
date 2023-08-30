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
				<th rowspan="2">#</th>
				<th rowspan="2">ID</th>
				<th rowspan="2">Nama</th>
				<th rowspan="2">NIP</th>
				<!-- <th rowspan="2">Jabatan SIMPEG</th> -->
				<th rowspan="2">Jabatan E-OFFICE</th>
				<!-- <th rowspan="2">Eselon SIMPEG</th> -->
				<th rowspan="2">Eselon E-OFFICE</th>
				<!-- <th rowspan="2">Instansi SIMPEG</th> -->
				<th rowspan="2">Instansi E-OFFICE</th>
				<th rowspan="2">Pangkat</th>
				<th rowspan="2">Jabatan</th>
				<th rowspan="2">Pendidikan</th>
				<th rowspan="2">Pelatihan</th>
				<th rowspan="2">Lengkap</th>
			</tr>
			<tr>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($pegawai as $key => $value): 

				if (@$masa_kerja[$key]['golongan']->kode_golongan >= $value->id_golongan_akhir) {
					if (!empty($masa_kerja[$key]['golongan']->berkas)) {
						if (isset($masa_kerja[$key]['golongan']->id_update)) {
							$pangkat_berkas = "V";
						} else {
							$pangkat_berkas = "Y";
						}
					} else {
						$pangkat_berkas = "T";
					}
				} else {
					$pangkat_berkas = "T";
				}

				if (@$jabatan[$key]['data']->tmt_berlaku >= $value->tmt_jabatan) {
					if (!empty($jabatan[$key]['data']->berkas)) {
						if (isset($jabatan[$key]['data']->id_update)) {
							$jabatan_berkas = "V";
						} else {
							$jabatan_berkas = "Y";
						}
					} else {
						$jabatan_berkas = "T";
					}
				} else {
					$jabatan_berkas = "T";
				}

				if (@$pendidikan[$key]->kode_tingkatpendidikan >= $value->id_tingkat_pendidikan) {
					if (!empty($pendidikan[$key]->berkas)) {
						if (isset($pendidikan[$key]->id_update)) {
							$pendidikan_berkas = "V";
						} else {
							$pendidikan_berkas = "Y";
						}
					} else {
						$pendidikan_berkas = "T";
					}
				} else {
					$pendidikan_berkas = "T";
				}

				if (@$pelatihan['diklat'][$key] > 0) {
					$pelatihan_berkas = "Y";
				} else {
					$pelatihan_berkas = "T";
				}

				if ($pangkat_berkas == "Y" AND $jabatan_berkas == "Y" AND $pendidikan_berkas == "Y" AND $pelatihan_berkas == "Y") {
					$semua_berkas = "Y";
				} elseif ($pangkat_berkas == "T" OR $jabatan_berkas == "T" OR $pendidikan_berkas == "T" OR $pelatihan_berkas == "T") {
					$semua_berkas = "T";
				} else {
					$semua_berkas = "V";
				}

			?>
			<?php if (/*@$jabatan[$key]['eselon']->kode_eselon < 60 AND @$jabatan[$key]['eselon']->kode_eselon*/ @$pendidikan[$key]->nilai_ipk > 0 OR true): ?>
				<tr>
					<td><?=$no?></td>
					<td class="str"><?=$value->id_pegawai?></td>
					<td><?=$value->nama_lengkap?></td>
					<td class="str"><?=$value->nip_baru?></td>
					<!-- <td class="str"><?=@$jabatan[$key]['jabatan']?></td> -->
					<td class="str"><?=@$pegawai_office[$value->nip_baru]->jabatan?></td>
					<!-- <td class="str"><?=@$jabatan[$key]['eselon']->nama_eselon?></td> -->
					<td class="str"><?=@$pegawai_office[$value->nip_baru]->eselon?></td>
					<!-- <td class="str"><?=@$jabatan[$key]['skpd']?></td> -->
					<td class="str"><?=@$pegawai_office[$value->nip_baru]->nama_skpd?></td>
					<td class="str"><?=@$pangkat_berkas?></td>
					<td class="str"><?=@$jabatan_berkas?></td>
					<td class="str"><?=@$pendidikan_berkas?></td>
					<td class="str"><?=@$pelatihan_berkas?></td>
					<td class="str"><?=@$semua_berkas?></td>
					<!-- <td class="str"><?=@print_r($masa_kerja[$key]['golongan'])?></td> -->
				</tr>
				<?php $no++; ?>
			<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>