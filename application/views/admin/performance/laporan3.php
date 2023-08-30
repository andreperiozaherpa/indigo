<html>
	<head>
		<title>REKAP PEGAWAI <?= strtoupper($jenis_laporan);?></title>
	</head>
	<body>
		<table align=center width='100%'>
			<tr>
				<?php 
				$jml_jenjang = count($jenjang_pendidikan);
				$colspan= $download? ($jml_jenjang+6) : ($jml_jenjang+3) ;?>
				<td colspan=<?=$colspan;?> align=center><h4>REKAPITULASI DATA PNS DAN CPNS
					<br>PEMERINTAH KABUPATEN SUMEDANG
					<br><?= strtoupper($jenis_laporan);?>
					<?php if($nama_skpd!="") echo "<br>(" .strtoupper($nama_skpd).")";?>
				</h4></td>
			</tr>
			<tr >
				<?php $colspan= $download? ((round(($jml_jenjang+3)/2))+3) : (round(($jml_jenjang+3)/2)) ;?>
				<td colspan=<?=$colspan;?>><b><?= $config[0]->nm_instansi;?></b></td>
				<td colspan=3 align=right>Keadaan bulan <?=$bulan." ".$tahun;?></td>
			</tr>
		</table>
		<?php $border = $download? 0 : 1;?>
		<table class="table" border=<?=$border;?> style="border-collapse:collapse" width='100%'>
			<tr align=center>
				<td>NO URUT</td>
				<?php $colspan= $download==0 ? 0 : 4 ;?>
				<td colspan=<?=$colspan;?>>JABATAN</td>
				<?php
					$TOTAL = array();
					foreach($jenjang_pendidikan as $row){
						echo "<td>$row->nama_jenjangpendidikan</td>";
						
						$TOTAL[$row->id_jenjangpendidikan] = 0;
					}
				?>
				<td>Jumlah</td>
			</tr>
			
			<tr align=center>
			<?php
				for($i=1;$i<=($jml_jenjang+3);$i++){
					if ($i!=2)
						echo"<td>$i</td>";
					else 
						echo"<td colspan=$colspan>$i</td>";
				}
			?>
			</tr>
			<?php
				
				$no=1;
				$TOTAL_ALL =0;
				foreach($data as $row)
				{
					$margin = $download==0 ? ($row['level_jabatan'] * 2 ) - 2 : $row['level_jabatan'];
					$spasi = "";
					for($x=1;$x<=$margin;$x++)
					{
						if ($download==0)
							$spasi .="&nbsp";
					}
					if ($download){
						switch($row['level_jabatan']){
							case 1 :
								$td = "<td colspan=4 align=left>$row[nama_jabatan]</td>";
								break;
							case 2 :
								$td = "<td width='1px'></td><td colspan=3 align=left>$row[nama_jabatan]</td>";
								break;
							case 3 :
								$td = "<td width='1px'></td><td width='1px'></td><td colspan=2 align=left>$row[nama_jabatan]</td>";
								break;
							case 4 :
								$td = "<td width='1px'></td><td width='1px'></td><td width='1px'></td><td colspan=1 align=left>$row[nama_jabatan]</td>";
								break;
						}
						
					}
					else{
						$td = "<td align=left>$spasi".strtoupper($row['nama_jabatan'])."</td>";
					}
					
					$SUB_TOTAL = 0;
					
					if ($row['level_jabatan']==1) $TOTAL_ALL += $SUB_TOTAL;
					echo"
						<tr align=center>
							<td>$no</td>
							$td";
							foreach($jenjang_pendidikan as $row2)
							{
								$data = $row[$row2->id_jenjangpendidikan];
								$SUB_TOTAL += $data;
								if ($row['level_jabatan']==1)
									$TOTAL[$row2->id_jenjangpendidikan] += $data;
								echo "<td>$data</td>";
							}
					echo"	<td>$SUB_TOTAL</td>
						</tr>
					";
					if ($row['level_jabatan']==1) $TOTAL_ALL += $SUB_TOTAL;
					$no++;
				}
				$colspan= $download? 5 : 2;
				echo "
					<tr align=center>
						<td colspan=".($colspan).">Total</td>
						";
							foreach($jenjang_pendidikan as $row2)
							{
								echo "<td>".$TOTAL[$row2->id_jenjangpendidikan]."</td>";
							}
				echo"		
						<td>$TOTAL_ALL</td>
					</tr>
				";
			?>
		</table>
	</body>
</html>