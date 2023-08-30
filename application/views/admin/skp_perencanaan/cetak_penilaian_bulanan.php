<?php 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"penilaianskp".bulan($this->uri->segment(4)).$this->uri->segment(3)."_".date("Y-m-d").".xls\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style> 
.str{ mso-number-format:\@; } 
tr.noBorder td {
  /*border:none !important;*/
}
tr.noBorder th {
  /*border:none !important;*/
}
tr.noBorder{
  /*border:none !important;*/
}
</style>
<table border="0">
	<tr class="noBorder">
		<th colspan="2">PENILAIAN SASARAN KERJA</th>
	</tr>
  <tr class="noBorder">
    <th colspan="2">PEGAWAI NEGERI SIPIL*</th>
  </tr>
	<tr class="noBorder">
		<th colspan="2">BULAN <?=strtoupper(bulan($bulan))?> TAHUN <?=$tahun?></th>
	</tr>
	<tr>
		<td colspan="2">
			<table border="1">

	<tr>
		<th rowspan="2">NO</th>
		<th rowspan="2" colspan="2">I. KEGIATAN TUGAS JABATAN</th>
		<th rowspan="2">AK</th>
		<th colspan="6">TARGET</th>
		<th rowspan="2">AK</th>
		<th colspan="6">REALISASI</th>
		<th rowspan="2">PENGHITUNGAN</th>
		<th rowspan="2">NILAI CAPAIAN SKP</th>
	</tr>
	<tr>
		<th colspan="2">KUANT/OUTPUT</th>
		<th>KUAL/MUTU</th>
		<th colspan="2">WAKTU</th>
		<th>BIAYA</th>
		<th colspan="2">KUANT/OUTPUT</th>
		<th>KUAL/MUTU</th>
		<th colspan="2">WAKTU</th>
		<th>BIAYA</th>
	</tr>
	<tr style="background: #eee">
		<td align="center">1</td>
		<td colspan="2" align="center">2</td>
		<td align="center">3</td>
		<td colspan="2" align="center">4</td>
		<td align="center">5</td>
		<td colspan="2" align="center">6</td>
		<td align="center">7</td>
		<td align="center">8</td>
		<td colspan="2" align="center">9</td>
		<td align="center">10</td>
		<td colspan="2" align="center">11</td>
		<td align="center">12</td>
		<td align="center">13</td>
		<td align="center">14</td>
	</tr>

	<?php
	 $nu=1; 
	 $nskp=0;
   $induk = $this->db->group_by('id_urtug')->get_where('iku_urtug_bulanan',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'bulan' => $bulan))->result();
   foreach ($induk as $k) {
    $i = $this->db->get_where('iku_urtug',array('id_urtug' => $k->id_urtug))->row();

    $urtug = $this->db->get_where('iku_urtug_bulanan',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'bulan' => $bulan,'id_urtug' => $k->id_urtug))->result();
   ?>
              <tr>
              	<td></td>
              	<td colspan="2"><b>Indikator:</b> <?= $i->kegiatan_tugas_jabatan ?></td>
              </tr>
              <?php /*$nu=1;*/ foreach ($urtug as $u): ?>
              <tr>
              	<td><?= $nu; ?></td>
              	<td colspan="2"><?= $u->kegiatan_tugas_jabatan ?></td>
                <td>-</td>
                <td class="num"><?= $u->kuantitas_target ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_target ?></td>
                <td class="num"><?= $u->waktu_target ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_target) ?></td>
                <td>-</td>
                <td class="num"><?= $u->kuantitas_realisasi ?></td>
                <td><?= convert_satuan($u->kuantitas_satuan) ?></td>
                <td class="num"><?= $u->kualitas_realisasi ?></td>
                <td class="num"><?= $u->waktu_realisasi ?></td>
                <td><?= convert_satuan($u->waktu_satuan) ?></td>
                <td class="num"><?= @dot($u->biaya_realisasi) ?></td>
                <td class="num"><?= number_format(penghitungan_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi),2,',','') ?></td>
                <td class="num"><?= number_format(capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi),2,',','') ?></td>
              </tr>
                        <?php $nskp+=capaian_skp($u->kuantitas_target,$u->kuantitas_realisasi,$u->kualitas_target,$u->kualitas_realisasi,$u->waktu_target,$u->waktu_realisasi,$u->biaya_target,$u->biaya_realisasi); $nu++; endforeach; ?>
                        <?php 
                      } ?>
				<tr>
					<th colspan="18" rowspan="2">NILAI CAPAIAN SKP</th>
          			<th class="num"><?= @number_format($nskp/($nu-1),2,',','') ?></th>
				</tr>
				<tr>
					<th><?= @konversi_nilai_skp($nskp/($nu-1)) ?></th>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<table>

	<tr class="noBorder">
		<td colspan="15" align="center"></td>
		<td colspan="4" align="center">Sumedang,  Mei 2021</td>
	</tr>
	<tr class="noBorder">
		<td colspan="15" align="center"></td>
		<td colspan="4" align="center">Pejabat Penilai,</td>
	</tr>
	<tr>
		<td colspan="19"></td>
	</tr>
	<tr>
		<td colspan="19"></td>
	</tr>
	<tr class="noBorder">
		<td colspan="15" align="center"><u></u></td>
		<td colspan="4" align="center"><u><?= @$pegawai_atasan->nama_lengkap ?></u></td>
	</tr>
	<tr class="noBorder">
		<td colspan="15" align="center" class="str"></td>
		<td colspan="4" align="center" class="str"><?= @$pegawai_atasan->nip ?></td>
	</tr>
				
			</table>
		</td>
	</tr>
</table>