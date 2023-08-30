<?php 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=\"skp".$this->uri->segment(3)."_".date("Y-m-d").".xls\"");
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
		<th colspan="2">TAHUN <?=$tahun?></th>
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
    $empty = true;
    foreach ($jenis as $j => $v) {
      if ($pegawai->kepala_skpd == "Y") {
        $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
        $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
      } else {
        $sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
        $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
      }
      $sasaran = array_merge($sasaran, $sasaran_inisiatif);
      if (!empty($sasaran)) {
        $empty = false;
      }
    }
    if (!$empty) {
      $total_indeks = 0;
      $jumlah_jenis = 0;
      foreach ($jenis as $j => $v) {
        $name = $this->renja_perencanaan_model->name($j);
        if ($pegawai->kepala_skpd == "Y") {
          $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
          $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
        } else {
          $sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
          $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
        }
        $sasaran = array_merge($sasaran, $sasaran_inisiatif);
        if (!empty($sasaran)) {
          ?>
          <?php
          $no = 1;
          foreach ($sasaran as $s) {
            $jumlah_jenis++;
            $tSasaran = $name['tSasaran'];
            $cSasaran = $name['cSasaran'];
            $cSasaranInisiatif = $name['cSasaranInisiatif'];
            if ($pegawai->kepala_skpd == "Y") {
              if (!empty($s->inisiatif)) {
                $iku = $this->renja_perencanaan_model->get_iku_inisiatif_skpd($j, $s->$cSasaranInisiatif, $tahun, $id_skpd);
              } else {
                $iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
              }
            } else {
              if (!empty($s->inisiatif)) {
                $iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $id_unit_kerja);
              } else {
                $iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $id_unit_kerja);
              }
            }
            ?>
            <?php

            $capaian = array();
            foreach ($iku as $i) :
              $tIku = $name['tIku'];
              $cIku = $name['cIku'];
              $cIkuRenja = $name['cIkuRenja'];
              $taIkuRenja = $name['taIkuRenja'];
              $aIkuRenja = $name['aIkuRenja'];
              $rIkuRenja = $name['rIkuRenja'];
              $target = $i->$taIkuRenja;
              $realisasi = $i->$rIkuRenja;
              $pola = $i->polorarisasi;
                $capaian[] = $i->capaian; //get_capaian($target,$realisasi,$pola);
              endforeach;
              $t_iku = count($iku) * 100;
              if ($t_iku == 0) $t_iku = 1;
              $t_hasil = array_sum($capaian);
              $t_indeks = ($t_hasil / $t_iku) * 100;
              $t_indeks_ =  number_format($t_indeks, 1);
              $t_sasaran = count($s) * 100;
              $tt_indeks_ = ($t_indeks_ / $t_sasaran) * 100;
              $ts_indeks_[$tSasaran] = $tt_indeks_;
              $total_indeks += $tt_indeks_;
              ?>
              <?php
              $n = 1;
              $tIku = $name['tIku'];
              $cIku = $name['cIku'];
              $cIkuRenja = $name['cIkuRenja'];
              $taIkuRenja = $name['taIkuRenja'];
              $aIkuRenja = $name['aIkuRenja'];
              $rIkuRenja = $name['rIkuRenja'];
              foreach ($iku as $i) {
                $unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
                $a_unit_kerja = array();
                foreach ($unit_kerjaz as $uu) {
                  $a_unit_kerja[] = $uu->nama_unit_kerja;
                }
                $unit_kerjaz = implode(', ', $a_unit_kerja);
                $target = $i->$taIkuRenja;
                $realisasi = $i->$rIkuRenja;
                $pola = $i->polorarisasi;

                $capaian = $i->capaian; //(?) get_capaian($target,$realisasi,$pola);
                ?>

                <?php $n++;
              } ?>

              <!-- <strong style="color:#3F0090;"><?= $v ?></strong><br><br> -->
              <!-- <div data-label="<?= isset($tt_indeks_) ? $tt_indeks_ : 0; ?>%" class="css-bar css-bar-<?= isset($tt_indeks_) ? roundfive($tt_indeks_) : 0; ?> css-bar-lg"></div> -->
              <?php $no++;
            }
          }
        }
        ?>
        <!-- <strong style="color:#3F0090;">Capaian Sasaran</strong><br><br> -->
        <?php
        $jumlah_indeks = $total_indeks / $jumlah_jenis;
        ?>
        <!-- <div data-label="<?= isset($jumlah_indeks) ? round($jumlah_indeks, 1) : 0; ?>%" class="css-bar css-bar-<?= isset($jumlah_indeks) ? roundfive($jumlah_indeks) : 0; ?> css-bar-lg"></div> -->
        <?php
      } else {
        ?>
        <!-- <div data-label="0%" class="css-bar css-bar-0 css-bar-lg"></div> -->
        <?php
      } ?>
      <?php
      foreach ($jenis as $j => $v) {
        $name = $this->renja_perencanaan_model->name($j);
        if ($pegawai->kepala_skpd == "Y") {
          $sasaran = $this->renja_perencanaan_model->get_sasaran_skpd($j, $id_skpd, $tahun);
          $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_skpd_inisiatif($j, $id_skpd, $tahun);
        } else {
          $sasaran = $this->renja_perencanaan_model->get_sasaran($j, $id_unit_kerja, $tahun);
          $sasaran_inisiatif = $this->renja_perencanaan_model->get_sasaran_inisiatif($j, $id_unit_kerja, $tahun);
        }
        $sasaran = array_merge($sasaran, $sasaran_inisiatif);
        if (!empty($sasaran)) {
          ?>
        <?php
          $no = 1;
          foreach ($sasaran as $s) {
            $tSasaran = $name['tSasaran'];
            $cSasaran = $name['cSasaran'];
            $cSasaranInisiatif = $name['cSasaranInisiatif'];
            if ($pegawai->kepala_skpd == "Y") {
              if (!empty($s->inisiatif)) {
                $iku = $this->renja_perencanaan_model->get_iku_inisiatif_skpd($j, $s->$cSasaranInisiatif, $tahun, $id_skpd);
              } else {
                $iku = $this->renja_perencanaan_model->get_iku_skpd($j, $s->$cSasaran, $tahun, $id_skpd);
              }
            } else {
              if (!empty($s->inisiatif)) {
                $iku = $this->renja_perencanaan_model->get_iku_inisiatif($j, $s->$cSasaranInisiatif, $tahun, $id_unit_kerja);
              } else {
                $iku = $this->renja_perencanaan_model->get_iku($j, $s->$cSasaran, $tahun, $id_unit_kerja);
              }
            }
            ?>

            <?php
            if (!empty($s->inisiatif)) {
              ?>
              <tr>
              	<td></td>
              	<td colspan="2"><b>Sasaran:</b> <?= $s->nama_sasaran ?></td>
              </tr>
                <?php
              } else {
                ?>
              <tr>
              	<td></td>
              	<td colspan="2"><b>Sasaran:</b> <?= $s->$tSasaran ?></td>
              </tr>
                  <?php
                }
                ?>
                      <?php
                      $n = 1;
                      $tIku = $name['tIku'];
                      $cIku = $name['cIku'];
                      $cIkuRenja = $name['cIkuRenja'];
                      $taIkuRenja = $name['taIkuRenja'];
                      $aIkuRenja = $name['aIkuRenja'];
                      $rIkuRenja = $name['rIkuRenja'];
                      foreach ($iku as $i) {
                        if ($pegawai->kepala_skpd == "Y") {
                          $rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd);
                        } else {
                          $rka = $this->renja_rka_model->get_rka($j, $i->$cIkuRenja, $tahun, $id_skpd, $id_unit_kerja);
                        }
                        $total_rka[$i->$cIkuRenja] = 0;
                        foreach ($rka as $r) {
                          $total_rka[$i->$cIkuRenja] += $r->anggaran;
                        }


                        $unit_kerjaz = $this->renstra_realisasi_model->get_unit_iku($j, $i->$cIku);
                        $a_unit_kerja = array();
                        foreach ($unit_kerjaz as $uu) {
                          $a_unit_kerja[] = $uu->nama_unit_kerja;
                        }
                        $unit_kerjaz = implode(', ', $a_unit_kerja);
                        if (strlen($unit_kerjaz) >= 100) {
                          $unit_kerjaz = substr($unit_kerjaz, 0, 100) . " ...";
                        }
                        $target = $i->$taIkuRenja;
                        $realisasi = $i->$rIkuRenja;
                        $pola = $i->polorarisasi;

                        $jml_renaksi = count($this->renja_perencanaan_model->get_renaksi($j, $i->$cIku));
                        // $capaian = get_capaian($target,$realisasi,$pola);
                        $capaian = $i->capaian;
                        $urtug = $this->db->get_where('iku_urtug', array('jenis_renja' => $j, 'id_iku_renja' => $i->$cIkuRenja, 'id_pegawai_input' => $id_pegawai))->result();

                        ?>
              <tr>
              	<td></td>
              	<td colspan="2"><b>Indikator:</b> <?= $i->$tIku ?></td>
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

                        <?php $n++;
                      } ?>

              <?php $no++;
            }
          }
        }
        ?>

                        <?php 
      $sub = $this->db->select('iku_urtug.*,iku.id_pegawai_input as id_pegawai_cc')->group_by('iku.id_pegawai_input')->join('iku_urtug iku','iku.id_urtug = iku_urtug.id_iku_renja','left')->get_where('iku_urtug',array('iku_urtug.id_pegawai_input' => $id_pegawai,'iku_urtug.tahun' => $tahun,'iku_urtug.jenis_renja' => 'cc'))->result();

      foreach ($sub as $a => $b) :
        $sub_b = $this->db->select('iku_urtug.*')->group_by('iku_urtug.id_iku_renja')->join('iku_urtug iku','iku.id_urtug = iku_urtug.id_iku_renja','left')->get_where('iku_urtug',array('iku_urtug.id_pegawai_input' => $id_pegawai,'iku_urtug.tahun' => $tahun,'iku_urtug.jenis_renja' => 'cc','iku.id_pegawai_input' => $b->id_pegawai_cc))->result();
        $array_b = array();
        foreach ($sub_b as $s_row) {
          $array_b[] = $s_row->id_iku_renja;
        }
        $s = $this->db->join('pegawai','pegawai.id_pegawai = iku_urtug.id_pegawai_input','left')->get_where('iku_urtug',array('id_urtug' => $b->id_iku_renja))->row();
        $induk = $this->db->group_by('id_iku_renja')->where_in('id_iku_renja', $array_b)->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'jenis_renja' => 'cc'))->result(); ?>

        <tr>
          <td></td>
          <td colspan="2">Casecading dari<b> <?= $s->nama_lengkap ?></b></td>
        </tr
                        <?php foreach ($induk as $k) {
                        $i = $this->db->get_where('iku_urtug',array('id_urtug' => $k->id_iku_renja))->row();

                        $urtug = $this->db->get_where('iku_urtug',array('id_pegawai_input' => $id_pegawai,'tahun' => $tahun,'id_iku_renja' => $k->id_iku_renja))->result();
                        ?>
              <tr>
                <td></td>
                <td colspan="2"><b>Casecading:</b> <?= $i->kegiatan_tugas_jabatan ?></td>
              </tr>
              <?php foreach ($urtug as $u): ?>
              <tr>
                <td><?= $nu; ?></td>
                <td colspan="2"><?= $u->kegiatan_tugas_jabatan ?></td>
                <td>-</td>
                <td><?= $u->kuantitas_target ?></td>
                <td><?= $u->kualitas_target ?></td>
                <td><?= $u->waktu_target ?></td>
                <td><?= dot($u->biaya_target) ?></td>
              </tr>
              <?php $nu++; endforeach ?>
            <?php } ?>
                          
                        <?php endforeach ?>
				
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