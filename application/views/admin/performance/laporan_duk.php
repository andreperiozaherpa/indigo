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
		<title>LAPORAN DUK PEGAWAI</title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<td colspan=14 align=center><h4>DAFTAR URUT KEPANGKATAN PEGAWAI NEGERI SIPIL
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<?php echo "<br>" .strtoupper($config[0]->nm_instansi);?>
				</h4></td>
			</tr>
			<tr>
				<td colspan=14 align=right>TAHUN <?=$tahun;?></td>
			</tr>
		</table>
		<?php $border = $download? 0 : 1;?>
		<table class="table" border=<?=$border;?> style="border-collapse:collapse" width='100%'>
			<tr align=center>
				<td rowspan=2>NO URUT</td>
				<td rowspan=2>NO URUT GOL.</td>
				<td rowspan=2>NAMA/NIP</td>
				<td rowspan=2>GOL. RUANG/TMT</td>
				<td rowspan=2>JABATAN/TMT</td>
				<td colspan=2>MASA KERJA</td>
				<td colspan=2>LATIHAN JABATAN</td>
				<td colspan=3>PENDIDIKAN</td>
				<td rowspan=2>USIA</td>
				<td rowspan=2>KETERANGAN</td>
			</tr>
			<tr align=center>
				<td>THN</td><td>BLN</td>
				<td>NAMA</td><td>TGL STPPL</td>
				<td>NAMA</td><td>LULUS THN</td><td>TINGKAT IJAZAH</td>
			</tr>
			
			<?php
				echo "<tr align=center>";
				for($x=1;$x<=14;$x++){
					echo "<td>$x</td>";
				}
				echo "</tr>";
				$no=1;
				$no_urut=1;
				foreach($data as $row){
					$tmt_berlaku = $row->tmt_berlaku==null ? "" : date('d M Y',strtotime($row->tmt_berlaku));
					$tgl_mulai = $row->tgl_mulai==null ? "" : date('d M Y',strtotime($row->tgl_mulai));
					$tgl_sptl = $row->tgl_sptl==null ? "" : date('d M Y',strtotime($row->tgl_sptl));
					
					$tgl1 = $row->cpns_tmt;
					$tgl2 = $tahun=date("Y") ? date('Y-m-d') : $tahun."-12-31";
					if ($tgl1!="0000-00-00")
						$masa_kerja = selisih($tgl1,$tgl2);
					else
						$masa_kerja = array ('tahun' => '','bulan' => '');
					
					$tgl1 = $row->tgl_lahir;
					if ($tgl1!="0000-00-00")
						$usia = selisih($tgl1,$tgl2);
					else
						$usia = array ('tahun' => '','bulan' => '');
					
					
					if ($no>1){
						$i = ($no-2);
						if ($row->pangkat== $data[$i]->pangkat)
							$no_urut++;
						else
							$no_urut=1;
					}
					else $no_urut=1;
					echo"<tr>
						<td align=center>$no</td>
						<td align=center>$no_urut</td>
						<td>$row->nama_lengkap / $row->nip_baru</td>
						<td align=center>$row->pangkat / $tmt_berlaku</td>
						<td>$row->golongan / $tgl_mulai</td>
						<td align=center>".$masa_kerja['tahun']."</td>
						<td align=center>".$masa_kerja['bulan']."</td>
						<td>$row->nama_diklat</td>
						<td>$tgl_sptl</td>
						<td>$row->keterangan</td>
						<td align=center>$row->tahun_lulus</td>
						<td align=center>$row->nama_jenjangpendidikan</td>
						<td align=center>".$usia['tahun']." Thn ".$usia['bulan']." Bln</td>
						<td>$row->nama_skpd</td>
					</tr>";
					$no++;
					
				}
				if (empty($data)){
					echo "<tr><td colspan=14 align=center>Tidak ada data</td></tr>";
				}
			?>
		</table>
	</body>
</html>