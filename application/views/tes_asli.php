<?php 
// header("Content-Type: application/force-download");
// header("Content-Type: application/octet-stream");
// header("Content-Type: application/download");
// header("Content-Disposition: attachment; filename=\"tes_360.xls\"");
// header("Content-Transfer-Encoding: binary");
// header("Pragma: no-cache");
// header("Expires: 0");
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
				<th colspan="3">Assestment</th>
				<th colspan="5">Pendidikan</th>
				<th colspan="3">Masa Kerja</th>
				<th colspan="3">Jabatan</th>
				<th colspan="4">Pelatihan</th>
				<th rowspan="2">PPK PNS</th>
				<th colspan="4">Prestasi</th>
				<th colspan="2">Penugasan</th>
				<th colspan="2">Kedisiplinan</th>
				<th colspan="4">Absensi</th>
			</tr>
			<tr>
				<th>Kompetensi</th>
				<th>Potensi</th>
				<th>Skor</th>
				<th>Instansi</th>
				<th>Tingkat</th>
				<th>Akreditasi</th>
				<th>IPK</th>
				<th>Skor</th>
				<th>Golongan</th>
				<th>Bulan</th>
				<th>Skor</th>
				<th>Eselon</th>
				<th>Bulan</th>
				<th>Skor</th>
				<th>Diklat</th>
				<th>Pelatihan</th>
				<th>Workshop</th>
				<th>Skor</th>
				<th>Meraih</th>
				<th>Skor</th>
				<th>Nominator</th>
				<th>Skor</th>
				<th>List</th>
				<th>Skor</th>
				<th>Tingkat</th>
				<th>Skor</th>
				<th>Terlambat</th>
				<th>Skor</th>
				<th>Absen</th>
				<th>Skor</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($pegawai as $key => $value): 
				$skor_assestment = $skor_pendidikan = $skor_masa_kerja = $skor_jabatan = $skor_pelatihan = 0;
				$skor_ppk_pns = $skor_prestasi_meraih = $skor_prestasi_nominator = $skor_penugasan = $skor_kedisiplinan = $skor_absensi['terlambat'] = $skor_absensi['absen'] = 0;

				$skor_assestment = (@$indikator[$key]['assestment']->assestment_potensi > 0) ? $indikator[$key]['assestment']->assestment_potensi : $skor_assestment;
				$skor_assestment = (@$indikator[$key]['assestment']->assestment_kompetensi > 0) ? $indikator[$key]['assestment']->assestment_kompetensi : $skor_assestment;

				$skor_pendidikan = skor_pendidikan(@$pendidikan[$key]->kode_tingkatpendidikan,@$pendidikan[$key]->akreditasi,@$pendidikan[$key]->nilai_ipk);

				$skor_masa_kerja = @$masa_kerja[$key]['golongan']->level * @$masa_kerja[$key]['mk'];

				if (@empty($jabatan[$key]['eselon']->nama_eselon) OR @$jabatan[$key]['eselon']->level < 3) {
					@$jabatan[$key]['eselon']->level = 3;
					@$jabatan[$key]['eselon']->nama_eselon = 'III.b';
					@$jabatan[$key]['mm'] = floor($jabatan[$key]['mm'] / 2);
				}
				$skor_jabatan = @$jabatan[$key]['eselon']->level * @$jabatan[$key]['mm'];

				$skor_pelatihan = skor_pelatihan(@$pelatihan['diklat'][$key],@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,@$pelatihan['kursus'][$key]['workshop']->jumlah_jam);

				$array_skor_prestasi_meraih = $array_skor_prestasi_nominator = $array_skor_penugasan = array();
				foreach ($prestasi[$key] as $row) {
					if ($row->medali == "Meraih") {
						$skor_prestasi_meraih += skor_prestasi(@$row->medali,@$row->kelas_prestasi);
						$array_skor_prestasi_meraih[] = skor_prestasi(@$row->medali,@$row->kelas_prestasi);
					} else {
						$skor_prestasi_nominator += skor_prestasi(@$row->medali,@$row->kelas_prestasi);
						$array_skor_prestasi_nominator[] = skor_prestasi(@$row->medali,@$row->kelas_prestasi);
					}
				}

				foreach ($penugasan[$key] as $row) {
					$skor_penugasan += skor_penugasan(@$row->kode_penugasan);
					$array_skor_penugasan[] = skor_penugasan(@$row->kode_penugasan);
				}

				$skor_kedisiplinan = skor_kedisiplinan(@$hukuman[$key]->tingkat_jenishukuman);

				$skor_absensi['terlambat'] = skor_absensi_terlambat(@$absen['terlambat'][$key]);
				$skor_absensi['absen'] = skor_absensi_absen(@$absen['absen'][$key]);
			?>
			<?php if (/*@$jabatan[$key]['eselon']->kode_eselon < 60 AND @$jabatan[$key]['eselon']->kode_eselon*/ @$pendidikan[$key]->nilai_ipk > 0): ?>
				<tr>
					<td><?=$no?></td>
					<td class="str"><?=$value->id_pegawai?></td>
					<td><?=$value->nama_lengkap?></td>
					<td class="str"><?=$value->nip_baru?></td>
					<td class="num"><?=@number_format($indikator[$key]['assestment']->assestment_kompetensi,2,',','')?></td>
					<td class="num"><?=@number_format($indikator[$key]['assestment']->assestment_potensi,2,',','')?></td>
					<td class="num"><?=number_format($skor_assestment,2,',','')?></td>
					<td><?=@$pendidikan[$key]->nama_instansi?></td>
					<td><?=@$pendidikan[$key]->nama_tingkatpendidikan?></td>
					<td><?=@$pendidikan[$key]->akreditasi?></td>
					<td class="num"><?=@number_format($pendidikan[$key]->nilai_ipk,2,',','')?></td>
					<td class="num"><?=number_format($skor_pendidikan,2,',','')?></td>
					<td><?=@$masa_kerja[$key]['golongan']->pangkat_golongan?></td>
					<td class="num"><?=@number_format($masa_kerja[$key]['mk'],2,',','')?></td>
					<td class="num"><?=number_format($skor_masa_kerja,2,',','')?></td>
					<td><?=@$jabatan[$key]['eselon']->nama_eselon?></td>
					<td class="num"><?=@number_format($jabatan[$key]['mm'],2,',','')?></td>
					<td class="num"><?=number_format($skor_jabatan,2,',','')?></td>
					<td><?=@($pelatihan['diklat'][$key]>0)?'Ya':'Tidak'?></td>
					<td class="num"><?=@number_format($pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,2,',','')?></td>
					<td class="num"><?=@number_format($pelatihan['kursus'][$key]['workshop']->jumlah_jam,2,',','')?></td>
					<td class="num"><?=number_format($skor_pelatihan,2,',','')?></td>
					<td class="num"><?=@number_format($indikator[$key]['ppk_pns']->nilai_ppk_pns,2,',','')?></td>
					<td class="str">
						<!-- <ol> -->
							<?php foreach ($prestasi[$key] as $row): ?>
								<?php if ($row->medali == "Meraih"): ?>
									<!-- <li><?=$row->kelas_prestasi?>:<?=$row->medali?> (<?=$row->tahun?>)</li> -->
								<?php endif ?>
							<?php endforeach ?>
									<?= implode(' + ', $array_skor_prestasi_meraih)?>
						<!-- </ol> -->
					</td>
					<td class="num"><?=number_format($skor_prestasi_meraih,2,',','')?></td>
					<td class="str">
						<!-- <ol> -->
							<?php foreach ($prestasi[$key] as $row): ?>
								<?php if ($row->medali != "Meraih"): ?>
									<!-- <li><?=$row->kelas_prestasi?>:<?=$row->medali?> (<?=$row->tahun?>)</li> -->
								<?php endif ?>
							<?php endforeach ?>
									<?= implode(' + ', $array_skor_prestasi_nominator)?>
						<!-- </ol> -->
					</td>
					<td class="num"><?=number_format($skor_prestasi_nominator,2,',','')?></td>
					<td class="str">
						<!-- <ol> -->
							<?php foreach ($penugasan[$key] as $row): ?>
								<!-- <li><?=$row->nama_penugasan?>:<?=$row->jenis_penugasan?> (<?=$row->tahun?>)</li> -->
							<?php endforeach ?>
								<?= implode(' + ', $array_skor_penugasan)?>
						<!-- </ol> -->
					</td>
					<td class="num"><?=number_format($skor_penugasan,2,',','')?></td>
					<td><?=@$hukuman[$key]->tingkat_jenishukuman?></td>
					<td class="num"><?=number_format($skor_kedisiplinan,2,',','')?></td>
					<td class="num"><?=@number_format(floor($absen['terlambat'][$key]/60),2,',','')?></td>
					<td class="num"><?=number_format($skor_absensi['terlambat'],2,',','')?></td>
					<td class="num"><?=@number_format($absen['absen'][$key],2,',','')?></td>
					<td class="num"><?=number_format($skor_absensi['absen'],2,',','')?></td>
				</tr>
				<?php $no++; ?>
			<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>