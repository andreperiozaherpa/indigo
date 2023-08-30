<?php 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"skp".bulan($this->uri->segment(4)).$this->uri->segment(3)."_".date("Y-m-d").".xls\"");
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
		<th colspan="2">FORMULIR SASARAN KERJA</th>
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
		<th>NO</th>
		<th colspan="2">I. PEJABAT PENILAI</th>
		<th>NO</th>
		<th colspan="4">II. PEGAWAI NEGERI SIPIL YANG DINILAI</th>
	</tr>
	<tr>
		<td>1</td>
		<td>Nama</td>
		<td><?= @$pegawai_atasan->nama_lengkap ?></td>
		<td>1</td>
		<td>Nama</td>
		<td colspan="3"><?= $pegawai->nama_lengkap ?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>NIP</td>
		<td class="str"><?= @$pegawai_atasan->nip ?></td>
		<td>2</td>
		<td>NIP</td>
		<td colspan="3" class="str"><?= $pegawai->nip ?></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Pangkat Gol. Ruang</td>
		<td><?= @$pegawai_atasan->pangkat ?> - <?= @$pegawai_atasan->golongan ?></td>
		<td>3</td>
		<td>Pangkat Gol. Ruang</td>
		<td colspan="3"><?= $pegawai->pangkat ?> - <?= $pegawai->golongan ?></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Jabatan</td>
		<td><?= @$pegawai_atasan->jabatan ?></td>
		<td>4</td>
		<td>Jabatan</td>
		<td colspan="3"><?= $pegawai->jabatan ?></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Unit Kerja</td>
		<td><?= @$pegawai_atasan->nama_unit_kerja ?></td>
		<td>5</td>
		<td>Unit Kerja</td>
		<td colspan="3"><?= $pegawai->nama_unit_kerja ?></td>
	</tr>

	<tr>
		<th rowspan="2">NO</th>
		<th rowspan="2" colspan="2">III. KEGIATAN TUGAS JABATAN</th>
		<th rowspan="2">AK</th>
		<th colspan="4">TARGET</th>
	</tr>
	<tr>
		<th>KUANT/OUTPUT</th>
		<th>KUAL/MUTU</th>
		<th>WAKTU</th>
		<th>BIAYA</th>
	</tr>

	<?php
	 $nu=1; 
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
              	<td><?= $u->kuantitas_target ?></td>
              	<td><?= $u->kualitas_target ?></td>
              	<td><?= $u->waktu_target ?></td>
              	<td><?= dot($u->biaya_target) ?></td>
              </tr>
                        <?php $nu++; endforeach; ?>
                        <?php 
                      } ?>
				
			</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
			<table>

	<tr class="noBorder">
		<td colspan="4" align="center"></td>
		<td colspan="4" align="center">Sumedang,  Mei 2021</td>
	</tr>
	<tr class="noBorder">
		<td colspan="4" align="center">Pejabat Penilai,</td>
		<td colspan="4" align="center">Pegawai Negeri Sipil yang Dinilai,</td>
	</tr>
	<tr>
		<td colspan="8"></td>
	</tr>
	<tr>
		<td colspan="8"></td>
	</tr>
	<tr class="noBorder">
		<td colspan="4" align="center"><u><?= @$pegawai_atasan->nama_lengkap ?></u></td>
		<td colspan="4" align="center"><u><?= $pegawai->nama_lengkap ?></u></td>
	</tr>
	<tr class="noBorder">
		<td colspan="4" align="center" class="str"><?= @$pegawai_atasan->nip ?></td>
		<td colspan="4" align="center" class="str"><?= $pegawai->nip ?></td>
	</tr>

	<tr class="noBorder">
		<td colspan="8">Catatan:</td>
	</tr>
	<tr class="noBorder">
		<td colspan="8">* AK Bagi PNS yang memangku jabatan fungsional tertentu</td>
	</tr>
				
			</table>
		</td>
	</tr>
</table>