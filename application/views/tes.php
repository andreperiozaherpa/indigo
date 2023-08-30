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
				<th colspan="4">Assestment</th>
				<th colspan="6">Pendidikan</th>
				<th colspan="4">Pangkat</th>
				<th colspan="4">Jabatan</th>
				<th colspan="5">Pelatihan</th>
				<th rowspan="2">Potensi</th>
				<th colspan="2">PPK PNS</th>
				<th colspan="4">Prestasi</th>
				<th colspan="3">Penugasan</th>
				<th colspan="2">Penilaian Prilaku</th>
				<th colspan="2">Presensi</th>
				<th colspan="2">Kualitas LKH</th>
				<th rowspan="2">Kompetensi</th>
				<th rowspan="2">Nilai</th>
				<th rowspan="2">Box</th>
			</tr>
			<tr>
				<th>Kompetensi</th>
				<th>Potensi</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Instansi</th>
				<th>Tingkat</th>
				<th>Akreditasi</th>
				<th>IPK</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Golongan</th>
				<!-- <th>Nilai</th> -->
				<th>Bulan</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Eselon</th>
				<th>Bulan</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Diklat</th>
				<th>Pelatihan</th>
				<th>Workshop</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Meraih</th>
				<th>Nominator</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>List</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Skor</th>
				<th>Nilai</th>
				<th>Persentase</th>
				<th>Nilai</th>
				<th>Skor</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($pegawai as $key => $value): 
				$skor_assestment = $skor_pendidikan = $skor_masa_kerja = $skor_jabatan = $skor_pelatihan = 0;
				$skor_ppk_pns = $skor_prestasi = $skor_penugasan = $skor_peer = $skor_tpp = $skor_lkh = 0;

				$bobot_assestment 			= 25;
				$bobot_pendidikan 			= 20;
				$bobot_masa_kerja 			= 20;
				$bobot_jabatan 				= 20;
				$bobot_pelatihan 			= 15;

				$bobot_ppk_pns 				= 20;
				$bobot_prestasi				= 20;
				$bobot_penugasan 			= 25;
				$bobot_peer 				= 15;
				$bobot_tpp	 				= 5;
				$bobot_lkh	 				= 15;

				$skor_assestment = (@$indikator[$key]['assestment']->assestment_potensi > 0) ? $indikator[$key]['assestment']->assestment_potensi : $skor_assestment;
				$skor_assestment = (@$indikator[$key]['assestment']->assestment_kompetensi > 0) ? $indikator[$key]['assestment']->assestment_kompetensi : $skor_assestment;

				// $pendidikan[$key]->nilai_ipk = ($pendidikan[$key]->nilai_ipk > 0) ? $pendidikan[$key]->nilai_ipk : rand(300,400)/100;
				$skor_pendidikan = skor_pendidikan(@$pendidikan[$key]->kode_tingkatpendidikan,@$pendidikan[$key]->akreditasi,@$pendidikan[$key]->nilai_ipk);

				$bobot_golongan = array(0,0,0,0,0,0,0,0,0,0,0,0,40,70,100,100,110,120);
				$level_golongan = $masa_kerja[$key]['golongan']->level;
				$skor_masa_kerja = (@$bobot_golongan[$level_golongan] * 0.80) + (@$masa_kerja[$key]['mk'] * 0.20);

				// if (@empty($jabatan[$key]['eselon']->nama_eselon) OR @$jabatan[$key]['eselon']->level < 3) {
				// 	@$jabatan[$key]['eselon']->level = 3;
				// 	@$jabatan[$key]['eselon']->nama_eselon = 'III.b';
				// 	@$jabatan[$key]['mm'] = floor($jabatan[$key]['mm'] / 2);
				// }
				$bobot_eselon = array(0,0,0,50,100,90,100,100,105,110);
				$level_eselon = @$jabatan[$key]['eselon']->level;
				$skor_jabatan = (@$bobot_eselon[$level_eselon] * 0.80) + (@$jabatan[$key]['mm'] * 0.20);

				$skor_pelatihan = skor_pelatihan(@$pelatihan['diklat'][$key],@$pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,@$pelatihan['kursus'][$key]['workshop']->jumlah_jam);

				if ($prestasi[$key]) {
					$hitung_prestasi = skor_prestasi($prestasi[$key]);
					$skor_prestasi = $hitung_prestasi;
				}

				if ($penugasan[$key]) {
					$hitung_penugasan = skor_penugasan($penugasan[$key]);
					$skor_penugasan = $hitung_penugasan['skor'];
				}
				
				$skor_peer = (@$peer[$key]->total_pertanyaan) > 0 ? round($peer[$key]->total_nilai/$peer[$key]->total_pertanyaan,2) : 0;
				// $skor_peer = ($skor_peer > 0) ? $skor_peer : rand(400,500)/100;

				$skor_tpp = $tpp[$key];

				$skor_lkh = 5;

				$nilai_assestment = $skor_assestment*($bobot_assestment/100);
				$nilai_pendidikan = $skor_pendidikan*($bobot_pendidikan/100);
				$nilai_masa_kerja = $skor_masa_kerja*($bobot_masa_kerja/100);
				$nilai_jabatan = $skor_jabatan*($bobot_jabatan/100);
				$nilai_pelatihan = $skor_pelatihan*($bobot_pelatihan/100);

				$nilai_potensi = $nilai_assestment + $nilai_pendidikan + $nilai_masa_kerja + $nilai_jabatan + $nilai_pelatihan;

				$skor_ppk_pns = @$indikator[$key]['ppk_pns']->nilai_ppk_pns;

				$nilai_ppk_pns = $skor_ppk_pns*($bobot_ppk_pns/100);
				$nilai_prestasi = $skor_prestasi*($bobot_prestasi/100);
				$nilai_penugasan = $skor_penugasan*($bobot_penugasan/100);
				$nilai_peer = $skor_peer*20*($bobot_peer/100);
				$nilai_tpp = $skor_tpp*($bobot_tpp/100);
				$nilai_lkh = $skor_lkh*20*($bobot_lkh/100);

				$nilai_prestasi = ($nilai_prestasi > $bobot_prestasi) ? $bobot_prestasi : $nilai_prestasi;
				$nilai_penugasan = ($nilai_penugasan > $bobot_penugasan) ? $bobot_penugasan : $nilai_penugasan;

				$nilai_kompetensi = $nilai_ppk_pns + $nilai_prestasi + $nilai_penugasan + $nilai_peer + $nilai_tpp + $nilai_lkh;

				$nilai_talent = ($nilai_potensi + $nilai_kompetensi) / 2;
				$posisi_box = floor($nilai_talent / 10);
			?>
			<?php if (/*@$jabatan[$key]['eselon']->kode_eselon < 60 AND @$jabatan[$key]['eselon']->kode_eselon*/ @$pendidikan[$key]->nilai_ipk > 0 OR TRUE): ?>
				<tr>
					<td><?=$no?></td>
					<td class="str"><?=$value->id_pegawai?></td>
					<td><?=$value->nama_lengkap?></td>
					<td class="str"><?=$value->nip_baru?></td>
					<td class="num"><?=@number_format($indikator[$key]['assestment']->assestment_kompetensi,2,',','')?></td>
					<td class="num"><?=@number_format($indikator[$key]['assestment']->assestment_potensi,2,',','')?></td>
					<td class="num"><?=number_format($skor_assestment,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_assestment<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_assestment,2,',','')?></td>
					<td><?=@$pendidikan[$key]->nama_instansi?></td>
					<td><?=@$pendidikan[$key]->nama_tingkatpendidikan?></td>
					<td><?=@$pendidikan[$key]->akreditasi?></td>
					<td class="num"><?=@number_format($pendidikan[$key]->nilai_ipk,2,',','')?></td>
					<td class="num"><?=number_format($skor_pendidikan,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_pendidikan<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_pendidikan,2,',','')?></td>
					<td><?=@$masa_kerja[$key]['golongan']->pangkat_golongan?></td>
					<!-- <td><?=@$bobot_golongan[$level_golongan]?></td> -->
					<td class="num"><?=@number_format($masa_kerja[$key]['mk'],2,',','')?></td>
					<td class="num"><?=number_format($skor_masa_kerja,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_masa_kerja<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_masa_kerja,2,',','')?></td>
					<td><?=@$jabatan[$key]['eselon']->nama_eselon?></td>
					<td class="num"><?=@number_format($jabatan[$key]['mm'],2,',','')?></td>
					<td class="num"><?=number_format($skor_jabatan,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_jabatan<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_jabatan,2,',','')?></td>
					<td><?=@($pelatihan['diklat'][$key]>0)?'Ya':'Tidak'?></td>
					<td class="num"><?=@number_format($pelatihan['kursus'][$key]['pelatihan']->jumlah_jam,2,',','')?></td>
					<td class="num"><?=@number_format($pelatihan['kursus'][$key]['workshop']->jumlah_jam,2,',','')?></td>
					<td class="num"><?=number_format($skor_pelatihan,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_pelatihan<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_pelatihan,2,',','')?></td>
					<td class="num" style="background-color: darkred; color: white"><?=number_format($nilai_potensi,2,',','')?></td>
					<td class="num"><?=@number_format($skor_ppk_pns,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_ppk_pns<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_ppk_pns,2,',','')?></td>
					<td class="str">
						<ol>
							<?php foreach ($prestasi[$key] as $row): ?>
								<?php if ($row->medali == "Meraih"): ?>
									<li><?=$row->kelas_prestasi?>:<?=$row->medali?> (<?=$row->tahun?>)</li>
								<?php endif ?>
							<?php endforeach ?>
						</ol>
					</td>
					<td class="str">
						<ol>
							<?php foreach ($prestasi[$key] as $row): ?>
								<?php if ($row->medali == "Nominator"): ?>
									<li><?=$row->kelas_prestasi?>:<?=$row->medali?> (<?=$row->tahun?>)</li>
								<?php endif ?>
							<?php endforeach ?>
						</ol>
					</td>
					<td class="num"><?=number_format($skor_prestasi,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_prestasi<=0)?'darkgray':'darkgray'?>; color: white"><?=number_format($nilai_prestasi,2,',','')?></td>
					<td class="str">
						<ol>
							<?php foreach ($penugasan[$key] as $row): if ($row->jenis_penugasan):?>
								<li><?=$row->nama_penugasan?>:<?=$row->jenis_penugasan?> (<?=$row->tahun?>)</li>
							<?php endif; endforeach; ?>
						</ol>
					</td>
					<td class="num"><?=number_format($skor_penugasan,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_penugasan<=0)?'darkgray':'darkgray'?>; color: white"><?=number_format($nilai_penugasan,2,',','')?></td>
					<td class="num"><?=number_format($skor_peer,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_peer<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_peer,2,',','')?></td>
					<td class="num"><?=number_format($skor_tpp,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_tpp<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_tpp,2,',','')?></td>
					<td class="num"><?=number_format($skor_lkh,2,',','')?></td>
					<td class="num" style="background-color: <?=($nilai_lkh<=0)?'red':'darkgray'?>; color: white"><?=number_format($nilai_lkh,2,',','')?></td>
					<td class="num" style="background-color: darkred; color: white"><?=number_format($nilai_kompetensi,2,',','')?></td>
					<td class="num" style="background-color: darkgreen; color: white"><?=number_format($nilai_talent,2,',','')?></td>
					<td class="num" style="background-color: black; color: white"><?=$posisi_box?></td>
				</tr>
				<?php $no++; ?>
			<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>