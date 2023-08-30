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
<div class="container-fluid">
	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Laporan Kegiatan Tim</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- row -->
	<div class="row">
		<div class="col-md-3 col-xs-12">
      <div class="white-box">
        <div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
          <div class="overlay-box">
            <div class="user-content" style="padding-bottom:15px;">
              <a href="javascript:void(0)"><img src="<?php echo $data_by_bkd->foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url()."data/foto/pegawai/".$data_by_bkd->foto_pegawai : base_url()."data/foto/pegawai/user-default.png";?>" class="thumb-lg img-circle" style=" object-fit: cover;

              width: 100px;
              height: 100px;border-radius: 50%;
              " alt="img"></a>
              <h5 class="text-white"><b><?=isset($data_by_bkd->nama_lengkap) ? $data_by_bkd->nama_lengkap : '-' ?></b></h5>
              <h6 class="text-white"><?=isset($data_by_bkd->nip) ? $data_by_bkd->nip : '-' ?></h6>
            </div>
          </div>
        </div>
        <div class="user-btm-box">
          <div class="row">
            <div class="col-md-12 b-b text-center">
              <h6><b>SKPD
              </b></h6>
              <h6><?=isset($data_by_bkd->nama_skpd) ? $data_by_bkd->nama_skpd : '-' ?>
            </h6>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 b-r text-center">
            <h6><b>Unit Kerja</b></h6>
            <h6>
              <?=isset($data_by_bkd->nama_unit_kerja) ? $data_by_bkd->nama_unit_kerja : '-' ?>
            </h6>
          </div>
          <div class="col-md-6 text-center">
            <h6><b>Jabatan</b></h6>
            <h6>
              <?=isset($data_by_bkd->nama_jabatan) ? $data_by_bkd->nama_jabatan : '-' ?>
            </h6>
          </div>
        </div>
      </div>
    </div>
  </div>

	<div class="col-md-9">
		<div class="white-box">
			<hr>
			<h5> <strong> A. IDENTITAS PEGAWAI </strong></H5>
			<hr>

			<table class='table'>
			<tr>
			<td>1. </td> <td>NIP </td> <td>:<td align="left"><?=$pegawai['nip'];?></td><td align="right">Karpeg </td> <td>:<td align="left"><?= $pegawai['karpeg'];?></td></tr>
			<tr><td>2. </td> <td>a. NAMA </td> <td>:<td align="left" colspan='4'><?=$pegawai['nama_lengkap'];?></td></tr>
			<tr><td> </td> <td>b. Gelar Depan </td><td>:</td><td><?=$pegawai['nama_gelardepan'];?></td><td align="right">Gelar Belakang </td><td>:</td><td><?=$pegawai['nama_gelarbelakang'];?></td></tr>
			<tr><td>3. </td> <td> Tempat, Tgl. Lahir </td> <td>:<td align="left" colspan='4'><?= $pegawai['tempat_lahir']." ". date("d M Y",strtotime($pegawai['tgl_lahir']));?></td></tr>
			<tr><td>4. </td> <td> Jenis Kelamin </td> <td>:<td align="left" colspan='4'><?= $pegawai['jenis_kelamin']=="1"? "Laki-laki":"Perempuan";?></td></tr>
			<tr><td>5. </td> <td> Agama </td> <td>:<td align="left" colspan='4'><?= $pegawai['nama_agama'];?></td></tr>
			<tr><td>6. </td> <td>Pendidikan Terakhir </td> <td>:<td align="left" colspan='4'> </td></tr>
			<tr><td> </td> <td>a. Tingkat </td><td>:</td><td colspan='3'><?=isset($data_by_bkd->pendidikan) ? $data_by_bkd->pendidikan : '-' ?> </td></tr>
			<tr><td> </td> <td>b. Tahun Lulus </td><td>:</td><td colspan='3'><?=isset($data_by_bkd->lulus) ? $data_by_bkd->lulus : '-' ?> </td></tr>
			<tr><td> </td> <td>c. Jurusan </td><td>:</td><td colspan='3'><?=isset($data_by_bkd->jurusan) ? $data_by_bkd->jurusan : '-' ?></td></tr>
			<tr><td> </td> <td>d. Nama Sekolah </td><td>:</td><td colspan='3'><?=isset($data_by_bkd->lembaga) ? $data_by_bkd->lembaga : '-' ?> </td></tr>
			<tr><td>7. </td> <td>a. Pangkat/GOL. Ruang/TMT </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat)?$pangkat[0]->golongan." / ". $pangkat[0]->pangkat ." / ". date('d M Y',strtotime($pangkat[0]->tmt_berlaku)) :"";?></td></tr>
			<tr><td> </td> <td>b. Pejabat yang menetapkan </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat)? $pangkat[0]->nama_pejabat : "";?></td></tr>
			<tr><td> </td> <td>c. Nomor / Tanggal SK </td> <td>:<td align="left" colspan='4'><?= !empty($pangkat) ? $pangkat[0]->no_sk ." - ". date('d M Y',strtotime($pangkat[0]->tgl_sk)):"";?></td></tr>
			<tr><td> </td> <td>d. Masa Kerja Sesuai SK </td> <td>:<td align="left" colspan='4'>
			<?php
			$masa_kerja_pangkat = "";
			if (!empty($pangkat)){
				$masa_pangkat = selisih($pangkat[0]->tgl_sk,$pangkat[0]->tmt_berlaku);
				$masa_kerja_pangkat = $masa_pangkat['tahun'] . " tahun " . $masa_pangkat['bulan'] . " bulan";
			}
			?>
			<?= $masa_kerja_pangkat;?></td></tr>
			<tr><td>8. </td> <td>a. Jabatan/TMT </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan)? $jabatan[0]->nama_jabatan ." / ". date('d M Y',strtotime($jabatan[0]->tgl_akhir)) : "";?></td></tr>
			<tr><td> </td> <td>b. Pejabat yang menetapkan </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan) ? $jabatan[0]->nama_pejabat : "" ;?></td></tr>
			<tr><td> </td> <td>c. Nomor / Tanggal PAK </td> <td>:<td align="left" colspan='4'><?= !empty($jabatan)? $jabatan[0]->no_sk ." / ". date('d M Y',strtotime($jabatan[0]->tgl_sk)) : "";?></td></tr>
			<tr><td> </td> <td>d. Jenis Jabatan </td> <td>:<td align="left" colspan='4'> ? </td></tr>
			<tr><td> </td> <td>e. Eselon </td> <td>:<td align="left" colspan='4'> ?</td></tr>
			<tr><td> </td> <td>f. Jenis Jabatan </td> <td>:<td align="left"  colspan='4'> ? </td></tr>
			<tr><td> </td> <td> - Sumpah Jabatan </td><td>:<td align="left"  colspan='4'>?</td> </tr>
			<tr><td> </td> <td> - Angka Kredit</td><td>:<td align="left"  colspan='4'> ? </td> </tr>
			<tr><td> 9.</td> <td>Diklat Penjenjangan  </td> <td>:<td align="left"  colspan='4'>  </td></tr>
			<tr><td> </td> <td> - Jumlah Jam </td><td>:<td align="left"  colspan='4'>?</td> </tr>
			<tr><td> </td> <td> - Tahun Lulus</td><td>:<td align="left"  colspan='4'> ? </td> </tr>
			<tr><td> 10.</td> <td>a.Status Kepegawaian  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kedudukan_pegawai'];?></td></tr>
			<tr><td> </td> <td>b. Status Guru  </td> <td>:<td align="left"  colspan='4'> ?</td></tr>
			<tr><td> 11.</td> <td>a.Jenis Kepegawaian  </td> <td>:<td align="left"  colspan='4'> ?  </td></tr>
			<tr><td> </td> <td>b. Jenis Pekerjaan  </td> <td>:<td align="left"  colspan='4'> ?  </td></tr>
			<tr><td>12. </td> <td>Kedudukan Hukum Pegawai </td> <td>:<td align="left" colspan='4'> ? </td></tr>
			<tr><td>13. </td> <td>a.No Statik Sekolah </td> <td>:<td align="left" colspan='4'><?= !empty($unit_kerja)? $unit_kerja[0]->id_unit_kerja : "?";?></td></tr>
			<tr><td> </td> <td>b. Nama SKPD  </td> <td>:<td align="left" colspan='4'><?=isset($data_by_bkd->nama_skpd) ? $data_by_bkd->nama_skpd : '-' ?></td></tr>
			<tr><td> </td> <td>c. Alamat SKPD </td> <td>:<td align="left" colspan='4'><?=isset($data_by_bkd->alamat_skpd) ? $data_by_bkd->alamat_skpd : '-' ?></td></tr>
			<tr><td> </td> <td>d. Masa Kerja Sesuai SK </td> <td>:<td align="left" colspan='4'>
				<?php
					$masa_kerja_unit = "";
					if (!empty($unit_kerja)){
						$masa_unit = selisih($unit_kerja[0]->tmt_awal,$unit_kerja[0]->tmt_akhir);
						$masa_kerja_unit = $masa_unit['tahun'] . " tahun " . $masa_unit['bulan'] . " bulan";
					}

					echo $masa_kerja_unit;
				?>
			</td></tr>
			<tr><td> </td> <td>e. Mulai Tugas di unit kerja </td> <td>:<td align="left" colspan='4'> <?= !empty($unit_kerja)? date("d M Y",strtotime($unit_kerja[0]->tmt_awal)):"";?></td></tr>
			<tr><td> 14. </td> <td>a.Tugas Utama</td> <td>:<td align="left" > -  </td><td>Jumlah </td><td>-</td></tr>
			<tr><td> </td> <td>b. Tugas lainya</td> <td>:<td align="left" > -  </td><td>Jumlah </td><td>-</td></tr>
			<tr><td> </td> <td> </td> <td> <td align="left" >  </td><td>Jumlah </td><td>-</td></tr>
			<tr><td> 15.</td> <td colspan='5'>Kenaikan Gaji Berkala  </td > </tr>
			<tr><td> </td> <td>-TMT Terakhir  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-Masa Kerja  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-No. SK Gaji Berkala , Tanggal  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> 16.</td> <td colspan='5'>Pengangkatan Sebagai PNS  </td > </tr>
			<tr><td> </td> <td>-TMT   </td> <td>:<td align="left"  colspan='4'><?=isset($data_by_bkd->tmtpns) ? tanggal($data_by_bkd->tmtpns) : '-' ?></td></tr>
			<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-SK PNS  </td> <td>:<td align="left"  colspan='4'> Nomor : -  </td></tr>
			<tr><td> 17.</td> <td colspan='5'>Pengangkatan Sebagai CPNS  </td > </tr>
			<tr><td> </td> <td>-TMT   </td> <td>:<td align="left"  colspan='4'><?=isset($data_by_bkd->tmtcpns) ? tanggal($data_by_bkd->tmtcpns) : '-' ?></td></tr>
			<tr><td> </td> <td>-Gol Ruang  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-Pejabat Yang Menetapkan  </td> <td>:<td align="left"  colspan='4'>  -  </td></tr>
			<tr><td> </td> <td>-SK CPNS  </td> <td>:<td align="left"  colspan='4'> Nomor : -  </td></tr>
			<tr><td> </td> <td>-Masa Kerja  </td> <td>:<td align="left"  colspan='4'> 						<?php
									$awal = new DateTime (isset($data_by_bkd->tmtcpns) ? $data_by_bkd->tmtcpns : date("Y-m-d") );
									$skrng = new DateTime (isset($data_by_bkd->tmtpns) ? $data_by_bkd->tmtpns : date("Y-m-d") );
									$hasil = $skrng->diff($awal);
									$tahun = $hasil->y;
									$bulan = $hasil->m;
									$hari = $hasil->d;
									echo $tahun.' Tahun '.$bulan.' Bulan '.$hari.' Hari ';
									?>  </td></tr>
			<tr><td> 18.</td> <td colspan='5'>Nomer-Nomer Kartu  </td > </tr>
			<tr><td> </td> <td>-Kartu ASKES   </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kartu_askes'];?></td></tr>
			<tr><td> </td> <td>-Kartu Taspen  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['kartu_taspen'];?></td></tr>
			<tr><td> </td> <td>-Karis/Karsu</td> <td>:<td align="left"  colspan='4'><?= $pegawai['karis_karsu'];?></td></tr>
			<tr><td> </td> <td>-NPWP  </td> <td>:<td align="left"  colspan='4'><?= $pegawai['npwp'];?></td></tr>
			<tr><td> 19.</td> <td colspan='5'>Alamat Tempat Tinggal  </td > </tr>
			<tr><td> </td> <td>jln.    </td> <td>:<td align="left"  colspan='4'><?=$pegawai['alamat'];?></td></tr>
			<tr><td> </td> <td>RT  </td> <td>:<td align="left"><?= $pegawai['RT'];?></td><td align="right"> RW  </td> <td>:<td align="left"><?= $pegawai['RW'];?></td></tr>
			<tr><td> </td> <td>Telepon  </td> <td>:<td align="left"><?=$pegawai['telepon'];?></td><td align="right"> Kode POS  </td> <td>:<td align="left"><?=$pegawai['kode_pos'];?></td></tr>
			<tr><td> </td> <td>Desa / Kelurahan</td> <td>:<td align="left"  colspan='4'><?=$pegawai['desa'];?></td></tr>
			<tr><td> </td> <td>Kecamatan  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['kecamatan'];?></td></tr>
			<tr><td> </td> <td>Kabupaten  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['kabupaten'];?></td></tr>
			<tr><td> 20.</td><td>Status Perwaninan </td><td > :</td ><td colspan='4'><?=$pegawai['nama_statusmenikah'];?></td> </tr>
			<tr><td> </td> <td>Jumlah Tanggungan Anak.    </td> <td>:<td align="left"  colspan='4'><?=$pegawai['jml_tanggungan_anak'];?></td></tr>
			<tr><td> </td> <td>Jumlah Seluruh Anak  </td> <td>:<td align="left"  colspan='4'><?=$pegawai['jml_seluruh_anak'];?></td></tr>
			<tr><td> 21.</td> <td colspan='5'>Keterangan Badan  </td > </tr>
			<tr><td> </td> <td>Golongan Darah  </td> <td>:<td align="left"><?= $pegawai['golongan_darah'];?>  </td><td align="right"> Tinggi  </td> <td>:<td align="left">  <?= $pegawai['tinggi'];?>  </td></tr>
			<tr><td> </td> <td>Berat Badan </td> <td>:<td align="left"><?= $pegawai['berat_badan'];?>  </td><td align="right"> Rambut  </td> <td>:<td align="left">  <?= $pegawai['rambut'];?>  </td></tr>
			<tr><td> </td> <td>Bentuk Muka </td> <td>:<td align="left">  <?= $pegawai['bentuk_muka'];?>  </td><td align="right"> Warna Kulit  </td> <td>:<td align="left">  <?= $pegawai['warna_kulit'];?>  </td></tr>
			<tr><td> </td> <td>Ciri Khas </td> <td>:<td align="left">  <?= $pegawai['ciri_khas'];?>  </td><td align="right"> Cacat Tubuh </td> <td>:<td align="left">  <?= $pegawai['cacat_tubuh'];?> </td></tr>
			<tr><td>22. </td> <td> Hobby </td> <td>:<td align="left" colspan='4'>-</td></tr>
			</table>

			<hr>
			<h5> <strong> B. KEMAMPUAN BAHASA </strong></H5>
			<hr>
			<div class="row">
				<div class="col-md-6">
					1. Bahasa Daerah
					<table class="table table-bordered">
					<tr><td>No</td><td>Nama Bahasa</td><td>Kemampuan Bahasa </td>
					<?php
				if (!empty($bahasa)){
					$no = 1;
					foreach($bahasa as $row){
						echo"
					<tr><td>$no</td><td>$row->nama_bahasa</td><td>$row->kemampuan </td>";
					$no++;
				}
			}
			else{
					echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
				}
				?>



					</table>
				</div>
				<div class="col-md-6">
					2. Bahasa Asing
					<table class="table table-bordered">
					<tr><td>No</td><td>Nama Bahasa</td><td>Kemampuan Bahasa </td>
					<?php
				if (!empty($bahasa_asing)){
					$no = 1;
					foreach($bahasa_asing as $row){
						echo"
					<tr><td>$no</td><td>$row->nama_bahasa_asing</td><td>$row->kemampuan </td>";
					$no++;
				}
			}
			else{
					echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
				}
				?>
					</table>
				</div>
			</div>


			<hr>
			<h5> <strong> C. RIWAYAT PENDIDIKAN </strong></H5>
			<hr>


					<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2">Nama Sekolah</td><td rowspan="2" >Jurusan Pendidikan</td><td rowspan="2" >Tempat</td><td colspan="3" >
			STTB/ Tanda Lulus / Ijazah
			</td>
			</tr>
			<tr><td>Nomor</td><td>Tahun</td><td>Pejabat</td></tr>
			<?php
				if(!empty($pendidikan)){
					foreach($pendidikan as $row){
						echo"<tr><td >$row->nama_tempatpendidikan</td><td >$row->nama_jurusan</td><td >?</td><td >$row->nomor_sk</td><td >".date('Y',strtotime($row->tgl_sk))."</td><td >$row->nama_pejabat</td></tr>";
					}
				}
				else{
					echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
				}
			?>


			</tbody>
			</table>


			<hr>
			<h5> <strong> D. RIWAYAT KEPANGKATAN </strong></H5>
			<hr>


			<table class="table table-bordered">
			<tbody>
			<tr><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Pangkat</td><td rowspan="2" >Berlaku Tmt</td><td rowspan="2">Gaji Pokok</td><td colspan="3">Surat Keputusan</td></tr>
			<tr><td >Pejabat</td><td >Nomor</td><td >Tanggal</td></tr>
			<?php
				if (!empty($pangkat)){
					foreach($pangkat as $pangkat){
					echo"<tr>
						<td>$pangkat->golongan</td>
						<td>$pangkat->pangkat</td>
						<td>".date('d M Y',strtotime($pangkat->tmt_berlaku))."</td>
						<td>".number_format($pangkat->gaji_pokok)."</td>
						<td>$pangkat->nama_pejabat</td>
						<td>$pangkat->no_sk</td>
						<td>".date('d M Y',strtotime($pangkat->tgl_sk))."</td>
					</tr>";
					}
				}
				else{
					echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>



			<hr>
			<h5> <strong> E. RIWAYAT PEKERJAAN / JABATAN </strong></H5>
			<hr>


			<table class="table table-bordered">
			<tbody>
			<tr><td rowspan="2" >Pekerjaan/ Jabatan</td><td colspan="2"  >Tanggal - Bulan - Tahun </td><td rowspan="2" >Gol. Ruang</td><td rowspan="2" >Gaji Pokok</td><td colspan="3"  >Surat Keputusan</td></tr>
			<tr><td>Mulai</td><td>Sampai</td><td>Pejabat</td><td>Nomor</td><td>Tanggal</td></tr>
			<?php
				if (!empty($jabatan)){
					foreach($jabatan as $row){
						$tgl_akhir_ = $row->tgl_akhir == "9999-12-31" ? "Sekarang" : date('d M Y',strtotime($row->tgl_akhir));
					echo"<tr>
						<td>$row->nama_jabatan</td>
						<td>".date('d M Y',strtotime($row->tgl_mulai))." </td>
						<td>".$tgl_akhir_." </td>
						<td>$row->golongan</td>
						<td>".number_format($pangkat->gaji_pokok)."</td>
						<td>$row->nama_pejabat</td>
						<td>$row->no_sk</td>
						<td>".date('d M Y',strtotime($row->tgl_sk))."</td>
					</tr>";
					}
				}
				else{
					echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
				}
			?>
			</tbody>
			</table>


			<hr>
			<h5> <strong>F. RIWAYAT PENDIDIKAN DAN LATIHAN STRUKTURAL/FUNGSIONAL/TEKNIS </strong></H5>
			<hr>


			<table class="table table-bordered">
			<tbody>
			<tr><td rowspan="2" >Jenis Diklat</td><td rowspan="2" >Nama</td>
			<td rowspan="2" >Tempat</td>
			<td rowspan="2" >Penyelenggara</td>
			<td rowspan="2" >Angkatan</td>
			<td colspan="3">Lama Diklat</td>
			<td colspan="2">STTPL</td>
			</tr>

			<tr>
			<td>Mulai</td>
			<td>Sampai</td>
			<td>Jam</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			</tr>

			<?php
				if (!empty($diklat)){
					foreach($diklat as $row){
						echo"
							<tr>
								<td>$row->nama_jenisdiklat</td>
								<td>$row->nama_diklat</td>
								<td>$row->tempat</td>
								<td>$row->penyelenggara</td>
								<td>$row->angkatan</td>
								<td>".date('d M Y',strtotime($row->tgl_mulai))."</td>
								<td>".date('d M Y',strtotime($row->tgl_akhir))."</td>
								<td>?</td>
								<td>$row->no_sptl</td>
								<td>".date('d M Y',strtotime($row->tgl_sptl))."</td>
							</tr>
						";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>



			<hr>
			<h5> <strong>G. RIWAYAT PENATARAN STRUKTURAL/FUNGSIONAL/TEKNIS </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Jenis </td>
			<td rowspan="2" >Nama</td>
			<td rowspan="2" >Tempat</td>
			<td rowspan="2" >Penyelenggara</td>
			<td rowspan="2" >Angkatan</td>
			<td colspan="3">Lama Penataran</td>
			<td colspan="2">Sttpl</td>
			</tr>

			<tr>
			<td>Mulai</td>
			<td>Sampai</td>
			<td>Jam</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			</tr>
			<?php
				if (!empty($penataran)){
					foreach($penataran as $row){
						echo"
							<tr>
			<tr>
			<td> $row->nama_penataran</td>
			<td> $row->nama_riwayat_penataran</td>
			<td> $row->tempat</td>
			<td> $row->penyelenggara</td>
			<td> $row->angkatan</td>
			<td> $row->tgl_mulai_penataran</td>
			<td> $row->tgl_akhir_penataran</td>
			<td> $row->jam_penataran </td>
			<td> $row->nomer_stpl</td>
			<td> $row->tgl_stpl</td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>


			</tbody>
			</table>



			<hr>
			<h5> <strong>H. RIWAYAT SEMINAR / LOKAKARYA / SIMPOSIUM </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Jenis</td>
			<td rowspan="2" >Nama</td>
			<td rowspan="2" >Tempat</td>
			<td rowspan="2" >Penyelenggara</td>
			<td rowspan="2" >Angkatan</td>
			<td colspan="3">Lama</td>
			<td colspan="2">Sertifikat/Tanda Bukti</td>
			</tr>

			<tr>
			<td>Mulai</td>
			<td>Sampai</td>
			<td>Jam</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			</tr>

			<?php
				if (!empty($seminar)){
					foreach($seminar as $row){
						echo"
							<tr>
			<tr>
			<td> $row->nama_jenisseminar</td>
			<td> $row->nama_riwayat_seminar</td>
			<td> $row->tempat</td>
			<td> $row->penyelenggara</td>
			<td> $row->angkatan</td>
			<td> $row->tgl_mulai_seminar</td>
			<td> $row->tgl_akhir_seminar</td>
			<td> $row->jam_seminar </td>
			<td> $row->nomer_stpl</td>
			<td> $row->tgl_stpl</td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>



			<hr>
			<h5> <strong>I. RIWAYAT KURSUS / LATIHAN  </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Jenis</td>
			<td rowspan="2" >Nama</td>
			<td rowspan="2" >Tempat</td>
			<td rowspan="2" >Penyelenggara</td>
			<td rowspan="2" >Angkatan</td>
			<td colspan="3">Lama</td>
			<td colspan="2">STTPL</td>
			</tr>

			<tr>
			<td>Mulai</td>
			<td>Sampai</td>
			<td>Jam</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			</tr>

			<?php
				if (!empty($kursus)){
					foreach($kursus as $row){
						echo"
							<tr>
			<tr>
			<td> $row->nama_kursus</td>
			<td> $row->nama_riwayat_kursus</td>
			<td> $row->tempat</td>
			<td> $row->penyelenggara</td>
			<td> $row->angkatan</td>
			<td> $row->tgl_mulai_kursus</td>
			<td> $row->tgl_akhir_kursus</td>
			<td> $row->jam_kursus </td>
			<td> $row->nomer_stpl</td>
			<td> $row->tgl_stpl</td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>




			<hr>
			<h5> <strong>J. TANDA JASA / PENGHARGAAN / KEHORMATAN  </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Nama Tanda Jasa / Penghargaan / Kehormatan</td>
			<td rowspan="2" >Tahun</td>
			<td rowspan="2" >Asal Perolehan</td>
			<td colspan="3">Surat Keputusan</td>
			</tr>

			<tr>
			<td>Penandatangan</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			</tr>
			<?php
				if (!empty($penghargaan)){
					foreach($penghargaan as $row){
						echo"
							<tr>
								<td>$row->nama_jenispenghargaan</td>
								<td>$row->tahun</td>
								<td>$row->asal_perolehan</td>
								<td>$row->penandatangan</td>
								<td>$row->no_penghargaan</td>
								<td>".date('d M Y',strtotime($row->tgl_penghargaan))."</td>
							</tr>
						";
					}
				}
				else{
					echo"<tr><td colspan='6'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>





			<hr>
			<h5> <strong>K. PENUGASAN KE LUAR NEGERI  </strong></H5>
			<hr>
			<table class="table table-bordered">

			<tbody>
			<tr>
			<td rowspan="2" >Negara/Kota Tujuan</td>
			<td rowspan="2" >Jenis/Kegiatan Penugasan</td>
			<td colspan="3">Surat Keputusan</td>
			<td colspan="2">Lama Penugasan</td>
			</tr>

			<tr>
			<td>Pejabat Yang Mentapkan</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			<td>Tgl Mulai</td>
			<td>Tgl. Selesai</td>
			</tr>
			<?php
				if (!empty($penugasan)){
					foreach($penugasan as $row){
						echo"
							<tr>
			<tr>
			<td> $row->tempat</td>
			<td> $row->nama_jenispenugasan</td>
			<td> $row->pejabat_penetap</td>
			<td> $row->nomer_sk</td>
			<td> $row->tgl_sk</td>
			<td> $row->tgl_mulai_penugasan </td>
			<td> $row->tgl_akhir_penugasan </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>

			<hr>
			<h5> <strong>L. RIWAYAT CUTI   </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Jenis Cuti</td>
			<td rowspan="2" >Keterangan</td>
			<td colspan="3">Surat Keputusan</td>
			<td colspan="2">Lama Cuti</td>
			</tr>

			<tr>
			<td>Pejabat Yang Mentapkan</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			<td>Tgl Mulai</td>
			<td>Tgl. Selesai</td>
			</tr>

			<?php
				if (!empty($cuti)){
					foreach($cuti as $row){
						echo"
							<tr>
								<td>$row->nama_jeniscuti</td>
								<td>$row->keterangan</td>
								<td>$row->pejabat_penetapan</td>
								<td>$row->no_sk</td>
								<td>".date('d M Y',strtotime($row->tgl_sk))."</td>
								<td>".date('d M Y',strtotime($row->tgl_awal_cuti))."</td>
								<td>".date('d M Y',strtotime($row->tgl_akhir_cuti))."</td>
							</tr>
						";
					}
				}
				else{
					echo"<tr><td colspan='7'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>


			<hr>
			<h5> <strong>M. RIWAYAT HUKUMAN DISIPLIN   </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td rowspan="2" >Jenis Hukuman Disiplin</td>
			<td rowspan="2" >Keterangan</td>
			<td colspan="3">Surat Keputusan</td>
			<td colspan="2">Lama Hukuman Disiplin</td>
			</tr>

			<tr>
			<td>Pejabat Yang Mentapkan</td>
			<td>Nomor</td>
			<td>Tanggal</td>
			<td>Tgl Mulai</td>
			<td>Tgl. Selesai</td>
			</tr>

			<?php
				if (!empty($hukuman)){
					foreach($hukuman as $row){
						echo"
							<tr>
			<tr>

			<td> $row->nama_jenishukuman</td>
			<td> $row->keterangan</td>
			<td> $row->pejabat_penetap</td>
			<td> $row->nomer_sk</td>
			<td> $row->tgl_sk</td>
			<td> $row->tgl_mulai_hukuman </td>
			<td> $row->tgl_akhir_hukuman </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>


			<hr>
			<h5> <strong>N. KETERANGAN KELUARGA   </strong></H5>
			<hr>
			a.  ISTRI / SUAMI
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td>Nama</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Tgl. Menikah</td>
			<td>Pendidikan Umum</td>
			<td>Pekerjaan</td>
			<td>Keterangan</td>
			</tr>

			<?php
				if (!empty($pernikahan)){
					foreach($pernikahan as $row){
						echo"
							<tr>
			<tr>

			<td> $row->nama</td>
			<td> $row->tempat_lahir</td>
			<td> $row->tgl_lahir</td>
			<td> $row->tgl_menikah</td>
			<td> $row->nama_jenjangpendidikan</td>
			<td> $row->pekerjaan </td>
			<td> $row->keterangan </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>

			</tbody>
			</table>

			b.  ANAK

			<table class="table table-bordered">
			<tbody>
			<tr>
			<td>Nama</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Jenis Kelamin</td>
			<td>Pendidikan Umum</td>
			<td>Pekerjaan</td>
			<td>Keterangan</td>
			</tr>

			<?php
				if (!empty($anak)){
					foreach($anak as $row){
						echo"
							<tr>
			<tr>

			<td> $row->nama</td>
			<td> $row->tempat_lahir</td>
			<td> $row->tgl_lahir</td>
			<td> $row->jenis_kelamin</td>
			<td> $row->nama_jenjangpendidikan</td>
			<td> $row->pekerjaan </td>
			<td> $row->keterangan </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>


			</tbody>
			</table>

			c.  BAPAK DAN IBU KANDUNG

			<table class="table table-bordered">
			<tbody>
			<tr>
			<td>Nama</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Jenis Kelamin</td>
			<td>Pendidikan Umum</td>
			<td>Pekerjaan</td>
			<td>Keterangan</td>
			</tr>

			<?php
				if (!empty($orangtua)){
					foreach($orangtua as $row){
						echo"
							<tr>
			<tr>

			<td> $row->nama</td>
			<td> $row->tempat_lahir</td>
			<td> $row->tgl_lahir</td>
			<td> $row->jenis_kelamin</td>
			<td> $row->nama_jenjangpendidikan</td>
			<td> $row->pekerjaan </td>
			<td> $row->keterangan </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>


			</tbody>
			</table>

			d.  BAPAK DAN IBU MERTUA

			<table class="table table-bordered">
			<tbody>
			<tr>
			<td>Nama</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Jenis Kelamin</td>
			<td>Pendidikan Umum</td>
			<td>Pekerjaan</td>
			<td>Keterangan</td>
			</tr>

			<?php
				if (!empty($mertua)){
					foreach($mertua as $row){
						echo"
							<tr>
			<tr>

			<td> $row->nama</td>
			<td> $row->tempat_lahir</td>
			<td> $row->tgl_lahir</td>
			<td> $row->jenis_kelamin</td>
			<td> $row->nama_jenjangpendidikan</td>
			<td> $row->pekerjaan </td>
			<td> $row->keterangan </td>
			</tr>";
					}
				}
				else{
					echo"<tr><td colspan='10'>Tidak ada data</td></tr>";
				}
			?>


			</tbody>
			</table>

			<hr>
			<h5> <strong>O. PENILAIAN SKP TAHUN TERAKHIR   </strong></H5>
			<hr>
			<table class="table table-bordered">
			<tbody>
			<tr>
			<td>Unsur Yang Dinilai</td>
			<td>Angka</td>
			<td>Unsur Yang Dinilai</td>
			<td>Angka</td>
			</tr>

			<tr>
			<td>A. Kesetiaan</td>
			<td> </td>
			<td>E. Kejujuran</td>
			<td> </td>
			</tr>

			<tr>
			<td>B. Prestasi Kerja</td>
			<td> </td>
			<td>F. Kerjasama</td>
			<td> </td>
			</tr>

			<tr>
			<td>C. Tanggung Jawab</td>
			<td> </td>
			<td>G. Prakarsa</td>
			<td> </td>
			</tr>

			<tr>
			<td>D. Ketaatan</td>
			<td> </td>
			<td>H. Kepemimpinan</td>
			<td> </td>
			</tr>

			</tbody>
			</table>
		</div>
	</div>
</div>

<!-- .right-sidebar -->
