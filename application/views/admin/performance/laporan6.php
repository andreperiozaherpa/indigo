<html>
	<head>
		<title>REKAP PEGAWAI <?= strtoupper($jenis_laporan);?></title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<?php $colspan= $download? 20 : 17 ;?>
				<td colspan=<?=$colspan;?> align=center><h4>REKAPITULASI DATA PNS DAN CPNS
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<br><?= strtoupper($jenis_laporan);?>
					<?php if($nama_skpd!="") echo "<br>(" .strtoupper($nama_skpd).")";?>
				</h4></td>
			</tr>
			<tr >
				<?php $colspan= $download? 12 : 9 ;?>
				<td colspan=<?=$colspan;?>><b><?= $config[0]->nm_instansi;?></b></td>
				<td colspan=8 align=right>Keadaan bulan <?=$bulan." ".$tahun;?></td>
			</tr>
		</table>
		<?php $border = $download? 0 : 1;?>
		<table class="table" border=<?=$border;?> style="border-collapse:collapse" width='100%'>
			<tr align=center>
				<td rowspan=2>NO URUT</td>
				<?php $colspan= $download==0 ? 0 : 4 ;?>
				<td rowspan=2 colspan=<?=$colspan;?>>UNIT KERJA</td>
				<td rowspan=2>LAIN-LAIN</td>
				<td rowspan=2>PELAKSANA</td>
				<td rowspan=2>FUNGSIONAL</td>
				<td colspan=11>STRUKTURAL / ESELON</td>
				<td rowspan=2>JUMLAH PEGAWAI</td>
			</tr>
			<tr align=center>
				<td>I.A</td><td>I.B</td><td>II.A</td><td>II.B</td><td>III.A</td>
				<td>III.B</td><td>IV.A</td><td>IV.B</td><td>V.A</td><td>V.B</td>
				<td>JUMLAH</td>
			</tr>
			<tr align=center>
			<?php
				for($i=1;$i<=17;$i++){
					if ($i!=2)
						echo"<td>$i</td>";
					else 
						echo"<td colspan=$colspan>$i</td>";
				}
			?>
			</tr>
			<?php
				$no=1;
				$total_fungsional=0;
				$total_pelaksana=0;
				$total_lain2=0;
				
				$TOTAL_IA = 0;
				$TOTAL_IB = 0;
								
				$TOTAL_IIA = 0;
				$TOTAL_IIB = 0;
				
				$TOTAL_IIIA = 0;
				$TOTAL_IIIB = 0;
				
				$TOTAL_IVA = 0;
				$TOTAL_IVB = 0;
				
				$TOTAL_VA = 0;
				$TOTAL_VB = 0;
				
				$TOTAL_STRUKTURAL=0;
				
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
					$FUNGSIONAL = $row['FUNGSIONAL'];
					if ($row['level_skpd']==1) $total_fungsional += $FUNGSIONAL;
					$LAIN2 = $row['LAIN2'];
					if ($row['level_skpd']==1) $total_lain2 += $LAIN2;
					$PELAKSANA= $row['PELAKSANA'];
					if ($row['level_skpd']==1) $total_pelaksana += $PELAKSANA;
					$IA = $row['IA'];
					if ($row['level_skpd']==1) $TOTAL_IA += $IA;
					$IB = $row['IB'];
					if ($row['level_skpd']==1) $TOTAL_IB += $IB;
					
					$IIA = $row['IIA'];
					if ($row['level_skpd']==1) $TOTAL_IIA += $IIA;
					$IIB = $row['IIB'];
					if ($row['level_skpd']==1) $TOTAL_IIB += $IIB;
					
					$IIIA = $row['IIIA'];
					if ($row['level_skpd']==1) $TOTAL_IIIA += $IIIA;
					$IIIB = $row['IIIB'];
					if ($row['level_skpd']==1) $TOTAL_IIIB += $IIIB;
					
					$IVA = $row['IVA'];
					if ($row['level_skpd']==1) $TOTAL_IVA += $IVA;
					$IVB = $row['IVB'];
					if ($row['level_skpd']==1) $TOTAL_IVB += $IVB;
					
					$VA = $row['VA'];
					if ($row['level_skpd']==1) $TOTAL_VA += $VA;
					$VB = $row['VB'];
					if ($row['level_skpd']==1) $TOTAL_VB += $VB;
					
					$SUB_TOTAL_STRUKTURAL = $IA + $IB + $IIA + $IIB + $IIIA + $IIIB + $IVA + $IVB + $VA + $VB;
					$SUB_TOTAL = $FUNGSIONAL + $SUB_TOTAL_STRUKTURAL;
					
					if ($row['level_skpd']==1) $TOTAL_STRUKTURAL += $SUB_TOTAL_STRUKTURAL;
					if ($row['level_skpd']==1) $TOTAL_ALL += $SUB_TOTAL;
					echo"
						<tr align=center>
							<td>$no</td>
							$td
							<td>$LAIN2</td>
							<td>$PELAKSANA</td>
							<td>$FUNGSIONAL</td>
							<td>$IA</td><td>$IB</td>
							<td>$IIA</td><td>$IIB</td>
							<td>$IIIA</td><td>$IIIB</td>
							<td>$IVA</td><td>$IVB</td>
							<td>$VA</td><td>$VB</td>
							<td>$SUB_TOTAL_STRUKTURAL</td>
							<td>$SUB_TOTAL</td>
						</tr>
					";
					$no++;
				}
				$colspan= $download? 5 : 2;
				echo "
					<tr align=center>
						<td colspan=".($colspan).">Total</td>
						<td>$total_lain2</td>
						<td>$total_pelaksana</td>
						<td>$total_fungsional</td>
						<td>$TOTAL_IA</td><td>$TOTAL_IB</td>
						<td>$TOTAL_IIA</td><td>$TOTAL_IIB</td>
						<td>$TOTAL_IIIA</td><td>$TOTAL_IIIB</td>
						<td>$TOTAL_IVA</td><td>$TOTAL_IVB</td>
						<td>$TOTAL_VA</td><td>$TOTAL_VB</td>
						<td>$TOTAL_STRUKTURAL</td>
						<td>$TOTAL_ALL</td>
					</tr>
				";
			?>
		</table>
	</body>
</html>