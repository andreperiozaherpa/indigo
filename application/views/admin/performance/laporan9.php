<html>
	<head>
		<title>REKAP PEGAWAI <?= strtoupper($jenis_laporan);?></title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<?php 
				$jml_umur = count($umur);
				$jml_masa_kerja = count ($masa_kerja);
				$colspan= $download? ($jml_umur+$jml_masa_kerja+2+6) : ($jml_umur+$jml_masa_kerja+2+3) ;?>
				<td colspan=<?=$colspan;?> align=center><h4>REKAPITULASI DATA PNS DAN CPNS
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<br><?= strtoupper($jenis_laporan);?>
					<?php if($nama_skpd!="") echo "<br>(" .strtoupper($nama_skpd).")";?>
				</h4></td>
			</tr>
			<tr >
				<?php $colspan= $download? ((round(($jml_umur+$jml_masa_kerja+2+3)/2))+3) : (round(($jml_umur+$jml_masa_kerja+2+3)/2)) ;?>
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
				<td colspan=<?=($jml_umur+1);?>>KELOMPOK UMUR</td>
				<td colspan=<?=($jml_masa_kerja+1);?>>KELOMPOK MASA KERJA</td>
			</tr>
			<tr align=center>
				<?php
					$TOTAL_UMUR = array();
					for($u=0;$u<$jml_umur;$u++){
						echo "<td>$umur[$u]</td>";
						$TOTAL_UMUR[$u] = 0;
					}
					$TOTAL_UMUR[($u+1)] = 0;
					echo "<td>JUMLAH</td>";
					
					$TOTAL_MASA_KERJA = array();
					for($u=0;$u<$jml_masa_kerja;$u++){
						echo "<td>$masa_kerja[$u]</td>";
						$TOTAL_MASA_KERJA[$u] = 0;
					}
					$TOTAL_MASA_KERJA[($u+1)] = 0;
					echo "<td>JUMLAH</td>";
				?>
				
			</tr>
			
			<tr align=center>
			<?php
				for($i=1;$i<=($jml_umur+$jml_masa_kerja+4);$i++){
					if ($i!=2)
						echo"<td>$i</td>";
					else 
						echo"<td colspan=$colspan>$i</td>";
				}
			?>
			</tr>
			<?php
				
				$no=1;
				
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
					
					$SUB_TOTAL_UMUR = 0;
					$SUB_TOTAL_MASA_KERJA=0;
					echo"
						<tr align=center>
							<td>$no</td>
							$td";
							
							
							for($u=0;$u<$jml_umur;$u++)
							{
								$data = $row['UMUR'][$u];
								$SUB_TOTAL_UMUR += $data;
								if ($row['level_skpd']==1)
									$TOTAL_UMUR[$u] += $data;
								echo "<td>$data</td>";
							}
							if ($row['level_skpd']==1) $TOTAL_UMUR[($u+1)] += $SUB_TOTAL_UMUR;
					echo"	<td>$SUB_TOTAL_UMUR</td>";
					
							for($u=0;$u<$jml_masa_kerja;$u++)
							{
								$data = $row['MASA_KERJA'][$u];
								$SUB_TOTAL_MASA_KERJA += $data;
								if ($row['level_skpd']==1)
									$TOTAL_MASA_KERJA[$u] += $data;
								echo "<td>$data</td>";
							}
							if ($row['level_skpd']==1) $TOTAL_MASA_KERJA[($u+1)] += $SUB_TOTAL_MASA_KERJA;
					echo"	<td>$SUB_TOTAL_MASA_KERJA</td>";
					
					echo"
						</tr>
					";
					
					$no++;
				}
				$colspan= $download? 5 : 2;
				echo "
					<tr align=center>
						<td colspan=".($colspan).">Total</td>
						";
							for($u=0;$u<$jml_umur;$u++)
							{
								echo "<td>$TOTAL_UMUR[$u]</td>";
							}
							
					echo"	<td>".$TOTAL_UMUR[($u+1)]."</td>";
					
							for($u=0;$u<$jml_masa_kerja;$u++)
							{
								echo "<td>$TOTAL_MASA_KERJA[$u]</td>";
							}
							
					echo"	<td>".$TOTAL_MASA_KERJA[($u+1)]."</td>
					
					</tr>
				";
			?>
		</table>
	</body>
</html>