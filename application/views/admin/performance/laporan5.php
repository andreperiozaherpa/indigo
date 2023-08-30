<html>
	<head>
		<title>REKAP PEGAWAI <?= strtoupper($jenis_laporan);?></title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<?php $colspan= $download? 28 : 25 ;?>
				<td colspan=<?=$colspan;?> align=center><h4>REKAPITULASI DATA PNS DAN CPNS
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<br><?= strtoupper($jenis_laporan);?>
					<?php if($nama_skpd!="") echo "<br>(" .strtoupper($nama_skpd).")";?>
				</h4></td>
			</tr>
			<tr >
				<?php $colspan= $download? 16 : 13 ;?>
				<td colspan=<?=$colspan;?>><b><?= $config[0]->nm_instansi;?></b></td>
				<td colspan=12 align=right>Keadaan bulan <?=$bulan." ".$tahun;?></td>
			</tr>
		</table>
		<?php $border = $download? 0 : 1;?>
		<table class="table" border=<?=$border;?> style="border-collapse:collapse" width='100%'>
			<tr align=center>
				<td rowspan=2>NO URUT</td>
				<?php $colspan= $download==0 ? 0 : 4 ;?>
				<td rowspan=2 colspan=<?=$colspan;?>>UNIT KERJA</td>
				<td rowspan=2>LAIN LAIN</td>
				<td colspan=5>GOLONGAN I</td>
				<td colspan=5>GOLONGAN II</td>
				<td colspan=5>GOLONGAN III</td>
				<td colspan=6>GOLONGAN IV</td>
				<td rowspan=2>JUMLAH SELURUH</td>
			</tr>
			<tr align=center>
				<td>I/a</td><td>I/b</td><td>I/c</td><td>I/d</td><td>JUM</td>
				<td>II/a</td><td>II/b</td><td>II/c</td><td>II/d</td><td>JUM</td>
				<td>III/a</td><td>III/b</td><td>III/c</td><td>III/d</td><td>JUM</td>
				<td>IV/a</td><td>IV/b</td><td>IV/c</td><td>IV/d</td><td>IV/e</td><td>JUM</td>
			</tr>
			<tr align=center>
			<?php
				for($i=1;$i<=25;$i++){
					if ($i!=2)
						echo"<td>$i</td>";
					else 
						echo"<td colspan=$colspan>$i</td>";
				}
			?>
			</tr>
			<?php
				$no=1;
				$total_cpns=0;
				$TOTAL_IA = 0;
				$TOTAL_IB = 0;
				$TOTAL_IC = 0;
				$TOTAL_ID = 0;
				$TOTAL_I = 0;
				$TOTAL_IIA = 0;
				$TOTAL_IIB = 0;
				$TOTAL_IIC = 0;
				$TOTAL_IID = 0;
				$TOTAL_II = 0;
				$TOTAL_IIIA = 0;
				$TOTAL_IIIB = 0;
				$TOTAL_IIIC = 0;
				$TOTAL_IIID = 0;
				$TOTAL_III = 0;
				$TOTAL_IVA = 0;
				$TOTAL_IVB = 0;
				$TOTAL_IVC = 0;
				$TOTAL_IVD = 0;
				$TOTAL_IVE = 0;
				$TOTAL_IV =0;
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
					$CPNS = $row['CPNS'];
					if ($row['level_skpd']==1) $total_cpns += $CPNS;
					$IA = $row['I/A'];
					if ($row['level_skpd']==1) $TOTAL_IA += $IA;
					$IB = $row['I/B'];
					if ($row['level_skpd']==1) $TOTAL_IB += $IB;
					$IC = $row['I/C'];
					if ($row['level_skpd']==1) $TOTAL_IC += $IC;
					$ID = $row['I/D'];
					if ($row['level_skpd']==1) $TOTAL_ID += $ID;
					$IIA = $row['II/A'];
					if ($row['level_skpd']==1) $TOTAL_IIA += $IIA;
					$IIB = $row['II/B'];
					if ($row['level_skpd']==1) $TOTAL_IIB += $IIB;
					$IIC = $row['II/C'];
					if ($row['level_skpd']==1) $TOTAL_IIC += $IIC;
					$IID = $row['II/D'];
					if ($row['level_skpd']==1) $TOTAL_IID += $IID;
					$IIIA = $row['III/A'];
					if ($row['level_skpd']==1) $TOTAL_IIIA += $IIIA;
					$IIIB = $row['III/B'];
					if ($row['level_skpd']==1) $TOTAL_IIIB += $IIIB;
					$IIIC = $row['III/C'];
					if ($row['level_skpd']==1) $TOTAL_IIIC += $IIIC;
					$IIID = $row['III/D'];
					if ($row['level_skpd']==1) $TOTAL_IIID += $IIID;
					$IVA = $row['IV/A'];
					if ($row['level_skpd']==1) $TOTAL_IVA += $IVA;
					$IVB = $row['IV/B'];
					if ($row['level_skpd']==1) $TOTAL_IVB += $IVB;
					$IVC = $row['IV/C'];
					if ($row['level_skpd']==1) $TOTAL_IVC += $IVC;
					$IVD = $row['IV/D'];
					if ($row['level_skpd']==1) $TOTAL_IVD += $IVD;
					$IVE = $row['IV/E'];
					if ($row['level_skpd']==1) $TOTAL_IVE += $IVE;
					$SUB_TOTAL_I = $IA+$IB+$IC+$ID;
					if ($row['level_skpd']==1) $TOTAL_I += $SUB_TOTAL_I;
					$SUB_TOTAL_II = $IIA+$IIB+$IIC+$IID;
					if ($row['level_skpd']==1) $TOTAL_II += $SUB_TOTAL_II;
					$SUB_TOTAL_III = $IIIA+$IIIB+$IIIC+$IIID;
					if ($row['level_skpd']==1) $TOTAL_III += $SUB_TOTAL_III;
					$SUB_TOTAL_IV = $IVA+$IVB+$IVC+$IVD+$IVE;
					if ($row['level_skpd']==1) $TOTAL_IV += $SUB_TOTAL_IV;
					$SUB_TOTAL = $SUB_TOTAL_I + $SUB_TOTAL_II +$SUB_TOTAL_III+$SUB_TOTAL_IV+$CPNS;
					if ($row['level_skpd']==1) $TOTAL_ALL += $SUB_TOTAL;
					echo"
						<tr align=center>
							<td>$no</td>
							$td
							<td>$CPNS</td>
							<td>$IA</td><td>$IB</td><td>$IC</td><td>$ID</td><td>$SUB_TOTAL_I</td>
							<td>$IIA</td><td>$IIB</td><td>$IIC</td><td>$IID</td><td>$SUB_TOTAL_II</td>
							<td>$IIIA</td><td>$IIIB</td><td>$IIIC</td><td>$IIID</td><td>$SUB_TOTAL_III</td>
							<td>$IVA</td><td>$IVB</td><td>$IVC</td><td>$IVD</td><td>$IVE</td><td>$SUB_TOTAL_IV</td>
							<td>$SUB_TOTAL</td>
						</tr>
					";
					$no++;
				}
				$colspan= $download? 5 : 2;
				echo "
					<tr align=center>
						<td colspan=".($colspan).">Total</td>
						<td>$total_cpns</td>
						<td>$TOTAL_IA</td><td>$TOTAL_IB</td><td>$TOTAL_IC</td><td>$TOTAL_ID</td><td>$TOTAL_I</td>
						<td>$TOTAL_IIA</td><td>$TOTAL_IIB</td><td>$TOTAL_IIC</td><td>$TOTAL_IID</td><td>$TOTAL_II</td>
						<td>$TOTAL_IIIA</td><td>$TOTAL_IIIB</td><td>$TOTAL_IIIC</td><td>$TOTAL_IIID</td><td>$TOTAL_III</td>
						<td>$TOTAL_IVA</td><td>$TOTAL_IVB</td><td>$TOTAL_IVC</td><td>$TOTAL_IVD</td><td>$TOTAL_IVE</td><td>$TOTAL_IV</td>
						<td>$TOTAL_ALL</td>
					</tr>
				";
			?>
		</table>
	</body>
</html>