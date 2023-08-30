<html>
	<head>
		<title>REKAP PEGAWAI <?= strtoupper($jenis_laporan);?></title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<?php $colspan= $download? 9 : 6 ;?>
				<td colspan=<?=$colspan;?> align=center><h4>REKAPITULASI DATA PNS DAN CPNS
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<br><?= strtoupper($jenis_laporan);?>
					<?php if($nama_skpd!="") echo "<br>(" .strtoupper($nama_skpd).")";?>
				</h4></td>
			</tr>
			<tr >
				<?php $colspan= $download? 6 : 3 ;?>
				<td colspan=<?=$colspan;?>><b><?= $config[0]->nm_instansi;?></b></td>
				<td colspan=3 align=right>Keadaan bulan <?=$bulan." ".$tahun;?></td>
			</tr>
		</table>
		<?php $border = $download? 0 : 1;?>
		<table class="table" border=<?=$border;?> style="border-collapse:collapse" width='100%'>
			<tr align=center>
				<td rowspan=2>NO URUT</td>
				<?php $colspan= $download==0 ? 0 : 4 ;?>
				<td rowspan=2 colspan=<?=$colspan;?>>UNIT KERJA</td>
				<td colspan=4>Jenis Kelamin</td>
			</tr>
			<tr align=center>
				<td>Laki-laki</td><td>Perempuan</td><td>Lain-lain</td>
				<td>Jumlah</td>
			</tr>
			<tr align=center>
			<?php
				for($i=1;$i<=6;$i++){
					if ($i!=2)
						echo"<td>$i</td>";
					else 
						echo"<td colspan=$colspan>$i</td>";
				}
			?>
			</tr>
			<?php
				$no=1;
				$total_laki2=0;
				$total_perempuan=0;
				$total_lain2=0;
				
				$TOTAL_ALL =0;
				foreach($data as $row)
				{
					$margin = $download==0 ? ($row['level_skpd'] * 2 ) - 2 : $row['level_skpd'];
					$spasi = "";
					for($x=1;$x<=$margin;$x++)
					{
						if ($download==0)
							$spasi .="&nbsp";
					}
					if ($download){
						switch($row['level_skpd']){
							case 1 :
								$td = "<td colspan=4 align=left>$row[nama_skpd]</td>";
								break;
							case 2 :
								$td = "<td width='1px'></td><td colspan=3 align=left>$row[nama_skpd]</td>";
								break;
							case 3 :
								$td = "<td width='1px'></td><td width='1px'></td><td colspan=2 align=left>$row[nama_skpd]</td>";
								break;
							case 4 :
								$td = "<td width='1px'></td><td width='1px'></td><td width='1px'></td><td colspan=1 align=left>$row[nama_skpd]</td>";
								break;
						}
						
					}
					else{
						$td = "<td align=left>$spasi".strtoupper($row['nama_skpd'])."</td>";
					}
					$LAKI2 = $row['LAKI2'];
					if ($row['level_skpd']==1) $total_laki2 += $LAKI2;
					$LAIN2 = $row['LAIN2'];
					if ($row['level_skpd']==1) $total_lain2 += $LAIN2;
					$PEREMPUAN= $row['PEREMPUAN'];
					if ($row['level_skpd']==1) $total_perempuan += $PEREMPUAN;
					
					$SUB_TOTAL = $LAKI2 + $PEREMPUAN + $LAIN2;
					
					if ($row['level_skpd']==1) $TOTAL_ALL += $SUB_TOTAL;
					echo"
						<tr align=center>
							<td>$no</td>
							$td
							<td>$LAKI2</td>
							<td>$PEREMPUAN</td>
							<td>$LAIN2</td>
							<td>$SUB_TOTAL</td>
						</tr>
					";
					$no++;
				}
				$colspan= $download? 5 : 2;
				echo "
					<tr align=center>
						<td colspan=".($colspan).">Total</td>
						<td>$total_laki2</td>
						<td>$total_perempuan</td>
						<td>$total_lain2</td>
						<td>$TOTAL_ALL</td>
					</tr>
				";
			?>
		</table>
	</body>
</html>