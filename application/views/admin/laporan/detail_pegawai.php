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
			<h4 class="page-title">Detail Laporan Pegawai</h4>
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
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url();?>/data/images/header/header2.jpg">
					<div class="overlay-box">
						<div class="user-content" style="padding-bottom:15px;">
							<a href="javascript:void(0)"><img src="<?php echo $details_pegawai->foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url()."data/foto/pegawai/".$details_pegawai->foto_pegawai : base_url()."data/foto/pegawai/user-default.png";?>" class="thumb-lg img-circle" style=" object-fit: cover;

							width: 100px;
							height: 100px;border-radius: 50%;
							" alt="img"></a>
							<h5 class="text-white"><b><?=isset($details_pegawai->nama_lengkap) ? $details_pegawai->nama_lengkap : '-' ?></b></h5>
							<h6 class="text-white"><?=isset($details_pegawai->nip) ? $details_pegawai->nip : '-' ?></h6>
						</div>
					</div>
				</div>
				<div class="user-btm-box">
					<div class="row">
						<div class="col-md-12 b-b text-center">
							<h6><b>SKPD
							</b></h6>
							<h6><?=isset($details_pegawai->nama_skpd) ? $details_pegawai->nama_skpd : '-' ?>
						</h6>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 b-r text-center">
						<h6><b>Unit Kerja</b></h6>
						<h6>
							<?=isset($details_pegawai->nama_unit_kerja) ? $details_pegawai->nama_unit_kerja : '-' ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Jabatan</b></h6>
						<h6>
							<?=isset($details_pegawai->jabatan) ? $details_pegawai->jabatan : '-' ?>
						</h6>
					</div>
				</div>
			</div>
		</div>
		<div class="white-box" style="border-top:10px solid #6003C8">
			<div class="row b-t">
				<div class="col-md-12 b-b text-center">
					<h6><b>Masa Kerja</b></h6>
					<h6>
						<?php
						$awal = new DateTime (isset($data_by_bkd->tmtcpns) ? $data_by_bkd->tmtcpns : date("Y-m-d") );
						$skrng = new DateTime (date("Y-m-d"));
						$hasil = $skrng->diff($awal);
						$tahun = $hasil->y;
						$bulan = $hasil->m;
						$hari = $hasil->d;
						echo $tahun.' Tahun '.$bulan.' Bulan '.$hari.' Hari ';
						?>
					</h6>
				</div>
			</div>
			<div class="row b-b">
				<div class="col-md-6 b-r text-center">
					<h6><b>TMT CPNS</b></h6>
					<h6>
						<?=isset($data_by_bkd->tmtcpns) ? tanggal($data_by_bkd->tmtcpns) : "-" ; ?>
					</h6>
				</div>
				<div class="col-md-6 text-center">
					<h6><b>TMT PNS</b></h6>
					<h6>
						<?=isset($data_by_bkd->tmtpns) ? tanggal($data_by_bkd->tmtpns) : "-" ; ?>
					</h6>
				</div>
			</div>
			<div class="row b-b">
				<div class="col-md-6 b-r text-center">
					<h6><b>NIP</b></h6>
					<h6>
						<?=isset($data_by_bkd->nip) ? $data_by_bkd->nip : "-" ; ?>
					</h6>
				</div>
				<div class="col-md-6 text-center">
					<h6><b>Agama</b></h6>
					<h6>
						<?=isset($data_by_bkd->agama) ? $data_by_bkd->agama : "-" ;?>
					</h6>
				</div>
			</div>
			<div class="row b-b">
				<div class="col-md-6 b-r text-center">
					<h6><b>Tempat Lahir</b></h6>
					<h6>
						<?=isset($data_by_bkd->temlahir) ? $data_by_bkd->temlahir : "-" ;?>
					</h6>
				</div>
				<div class="col-md-6 text-center">
					<h6><b>Tgl Lahir</b></h6>
					<h6>
						<?=isset($data_by_bkd->tgllahir) ? tanggal($data_by_bkd->tgllahir) : "-" ;?>
					</h6>
				</div>
			</div>
			<div class="row b-b">
				<div class="col-md-6 b-r text-center">
					<h6><b>Jenis Kelamin</b></h6>
					<h6>
						<?=isset($data_by_bkd->kelamin) ? $data_by_bkd->kelamin : "-" ;?>
					</h6>
				</div>
				<div class="col-md-6 text-center">
					<h6><b>Pendidikan</b></h6>
					<h6>
						<?=isset($data_by_bkd->pendidikan) ? $data_by_bkd->pendidikan : "-" ;?>
					</h6>
				</div>
			</div>
			<div class="row b-b">
				<div class="col-md-6 b-r text-center">
					<h6><b>Pangkat / Golongan</b></h6>
					<h6>
						<?=isset($data_by_bkd->pangkat) ? $data_by_bkd->pangkat : "-" ;?> / <?=isset($data_by_bkd->gol) ? $data_by_bkd->gol : "-" ;?>
					</h6>
				</div>
				<div class="col-md-6 text-center">
					<h6><b>TMT Pangkat</b></h6>
					<h6>
						<?=isset($data_by_bkd->tmtpang) ? tanggal($data_by_bkd->tmtpang) : "-" ;?>
					</h6>
				</div>
			</div>
		</div>
		<a href="<?=base_url('laporan/biodata_pegawai/'.$this->uri->segment(3));?>" class="btn btn-primary btn-block">Details Biodata Pegawai</a>
		<br>
		<div class="white-box" >
			<div class="row b-b">
				Log Aktivitas Sistem
			</div>
			<br>
			<div class="steamline">
				<?php
					foreach($logs as $l){
				?>
				<div class="sl-item">
					<div class="sl-left"> <img class="img-circle" alt="user" src="<?=base_url().'data/foto/pegawai/'.$l->user_picture?>"> </div>
					<div class="sl-right">
						<div><a href="#"><?=$l->full_name?></a></div>
						<p style="margin: 0;padding: 0;line-height: 2"><?=$l->activity?>
					</p>

						<small><?=$l->description?></small><br>
						<span class="sl-date"><?php
							$e = explode(' ', $l->time);
							$date = tanggal($e[0]);
							$t = stime($e[1]);
							echo $date.' '.$t;
						?></span>
					</div>
				</div>
			<?php } ?>
				<hr>
				<a href="#" class="pull-right"><small>Lihat Semuanya</small> </a>
			</div>
		</div>
	</div>

	<div class="col-md-8 col-xs-12">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4 col-xs-12 col-sm-6">
					<div class="white-box text-center">
						<p class="text-muted">Total Kegiatan Personal</p>
						<h1 class="counter"><?=count($kegiatan_personal);?></h1>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-6">
					<div class="white-box text-center">
						<p class="text-muted">Total Kegiatan Tim</p>
						<h1 class="counter"><?=count($kegiatan)?></h1>
					</div>
				</div>
				<div class="col-md-4 col-xs-12 col-sm-6">
					<div class="white-box text-center">
						<p class="text-muted">Total Indikator Kinerja</p>
						<h1 class="counter"><?=$total_indikator?></h1>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="white-box">
					<!-- Nav tabs -->
					<ul class="list-inline two-part" role="tablist">
						<li>Grafik absensi</li>
						<li class="dropdown">
							<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">Bulan <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#januaritab" role="tab" data-toggle="tab">Jan</a></li>
								<li><a href="#februaritab" role="tab" data-toggle="tab">Feb</a></li>
								<li><a href="#marettab" role="tab" data-toggle="tab">Mar</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<div class="tab-content">
					<div class="tab-pane active" id="januaritab">
						<div class="flot-chart" style="height:150px;">
							<div class="flot-chart-content" id="flot-pie-chart"></div>
						</div>
					</div>
					<div class="tab-pane" id="februaritab">Grafik Februari</div>
					<div class="tab-pane" id="marettab">Grafik Maret</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="white-box" style="min-height:300px;">
				<div class="row b-b">
					Data capaian perjanjian kinerja
				</div>
				<br>
				<?php 
				if ($iku_ss==null&&$iku_sp==null&&$iku_sk==null) {
					echo "Belum ada data";
				}else{
				$i = 1;
				foreach ($iku_ss as $ss) {

					$list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($ss->jenis_sasaran,$ss->nip,$ss->id_iku);
					$realisasi_by_pegawai = 0;
					foreach($list_iku_kinerja as $l){
						$realisasi_by_pegawai += $l->realisasi;
					}
				?>
				<div class="row">
					<small>Indikator <?$i?> : <?=$ss->iku_ss_renstra?> </small>
					<div class="pull-right"><?=$ss->capaian;//get_capaian($ss->target_ss_renja, $realisasi_by_pegawai, $ss->polorarisasi);?>%</div>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$ss->capaian;//get_capaian($ss->target_ss_renja, $realisasi_by_pegawai, $ss->polorarisasi);?>%;"> <span class="sr-only">48% Complete</span></div>
					</div>
				</div>
				<?php $i++; } ?>
				<?php 
				$i = 1;
				foreach ($iku_sp as $sp) { 
					$list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($sp->jenis_sasaran,$sp->nip,$sp->id_iku);
					$realisasi_by_pegawai = 0;
					foreach($list_iku_kinerja as $l){
						$realisasi_by_pegawai += $l->realisasi;
					}
				?>
				<div class="row">
					<small>Indikator <?$i?> : <?=$sp->iku_sp_renstra?> </small>
					<div class="pull-right"><?=$sp->capaian;//get_capaian($sp->target_sp_renja, $realisasi_by_pegawai, $sp->polorarisasi);?>%</div>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$sp->capaian;//get_capaian($sp->target_sp_renja, $realisasi_by_pegawai, $sp->polorarisasi);?>%;"> <span class="sr-only">48% Complete</span></div>
					</div>
				</div>
				<?php $i++; } ?>
				<?php 
				$i = 1;
				foreach ($iku_sk as $sk) { 
					$list_iku_kinerja = $this->kinerja_pegawai_model->get_iku($sk->jenis_sasaran,$sk->nip,$sk->id_iku);
					$realisasi_by_pegawai = 0;
					foreach($list_iku_kinerja as $l){
						$realisasi_by_pegawai += $l->realisasi;
					}
					?>
				<div class="row">
					<small>Indikator <?$i?> : <?=$sk->iku_sk_renstra?> </small>
					<div class="pull-right"><?=$sk->capaian;//get_capaian($sk->target_sk_renja, $realisasi_by_pegawai, $sk->polorarisasi);?>%</div>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$sk->capaian;//get_capaian($sk->target_sk_renja, $realisasi_by_pegawai, $sk->polorarisasi);?>%;"> <span class="sr-only">48% Complete</span></div>
					</div>
				</div>
				<?php $i++; } ?>
				<a href="#" class="pull-right"><small>Lihat Semuanya</small> </a>
				<?php } ?>
			</div>
		</div>

		<div class="col-md-5">
			<div class="white-box" style="height:450px;">
				<div class="row b-b">
					Daftar Kegiatan Personal
					<a href="<?=base_url('laporan/detail_kegiatan_personal/'.$this->uri->segment(3));?>" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
				</div>
				<br>
				<ul class="list-task list-group" data-role="tasklist">
					<?php if ($kegiatan_personal == true): ?>
						<?php
						$i = 0;
						foreach ($kegiatan_personal as $keg): ?>
							<li class="list-group-item" data-role="task">
								<?php
									if($keg->status_kegiatan != "SELESAI DIVERIFIKASI"){
										?>
								<i class="fa fa-calendar-o" style="font-size:20px;color:red"></i>
							<b> <span><?=$keg->nama_kegiatan; ?> </span> </b>
										<?php
									}else{
										?>
								<i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
							<b> <span><a href="https://e-office.sumedangkab.go.id/kegiatan_personal/detail_kegiatan/<?=$user_id?>/<?=$keg->id_kegiatan_personal?>" target="_blank" style="color:#4f5467"><?=$keg->nama_kegiatan;?></a> </span></b>
										<?php
									}
								?>

								<?php
								$warna = "danger";
								if ($keg->status_kegiatan == "BELUM DIKERJAKAN") {
									$nilai = 0;
								}elseif ($keg->status_kegiatan == "MENUNGGU VERIFIKASI") {
									$nilai = 50;
								}elseif ($keg->status_kegiatan == "SELESAI DIVERIFIKASI") {
									$warna = "primary";
									$nilai = 100;
								}
								?>
								<div class="pull-right"><small><?=$nilai;?>%</small></div>
								<div class="progress">
									<div class="progress-bar progress-bar-<?=$warna?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$nilai?>%"> <span class="sr-only">52% Complete</span></div>
								</div>
							</li>
							<?php
							if (++$i == 7) break;
						endforeach; ?>
						<?php else: ?>
							<li class="list-group-item" data-role="task" style="margin-top:-5px">
								<small>BELUM ADA KEGIATAN YANG AKAN DATANG</small></li>
							<?php endif; ?>
						</ul>

					</div>
				</div>
				<div class="col-md-7">
					<div class="white-box" style="height:450px;">
						<div class="row b-b">
							Daftar Kegiatan Tim
							<a href="<?=base_url('laporan/detail_kegiatan_tim/'.$this->uri->segment(3));?>" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
						</div>
						<br>
						<ul class="list-task list-group" data-role="tasklist">
							<?php
							if(!empty($kegiatan)){
								$n=1;
							foreach($kegiatan as $k){
								if($n>5){
									break;
								}
								$progress = $this->realisasi_kegiatan_model->get_progress($k->id_kegiatan);
								?>

								<li class="list-group-item" data-role="task">
									<?php
										if($progress<100){
											?>
									<i class="fa fa-calendar-o" style="font-size:20px;color:red"></i>
											<?php
										}else{
											?>
									<i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
											<?php
										}
									?>
									<label for="inputSchedule"> <span><?=$k->nama_kegiatan?> </span> </label>
									<div class="pull-right"><small><?=$progress?>%</small></div>
									<div class="progress">
										<div class="progress-bar progress-bar-<?=($progress<100) ? 'danger' : 'primary'?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?=$progress?>%;"> <span class="sr-only"><?=$progress?>% Complete</span></div>
									</div>
								</li>
								<?php
								$n++;
							}
						}else{
							?>

							<li class="list-group-item" data-role="task" style="margin-top:-5px">
								<small>BELUM ADA KEGIATAN YANG AKAN DATANG</small></li>
							<?php
						}

							?>
						</ul>

					</div>
				</div>
			</div>
			<!-- /.row -->

			<div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header primary">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Detail Pekerjaan</h4>
						</div>
						<div class="modal-body">

							<table>
								<tr><td><strong>Sosialisasi perizinan</strong> </td></tr>
							</table>
							<hr>
							<div class="row text-center m-t-10">
								<div class="col-md-6 b-r"><strong>Kode IKU</strong>
									<p>IKU011 </p>
								</div>
								<div class="col-md-6"><strong>Prioritas</strong>
									<p>Tinggi</p>
								</div>
							</div>

							<hr>
							<div class="row text-center m-t-10">
								<div class="col-md-6 b-r"><strong>Tanggal Mulai</strong>
									<p>20 November 2018 </p>
								</div>

								<div class="col-md-6"><strong>Tanggal Selesai</strong>
									<p>30 November 2018</p>
								</div>
							</div>

							<hr>
							<div class="row text-center m-t-10">
								<div class="col-md-12"><strong>Deskripsi Pekerjaan</strong>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
								</div>
							</div>
							<hr>
							<div class="row text-center m-t-10">
								<div class="col-md-12"><strong>Uraian Tugas</strong>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
								</div>
							</div>

							<hr>
							<div class="row text-center m-t-10">
								<div class="col-md-6 b-r"><strong>Status Pekerjaan</strong>
									<p>Di Setujui </p>
								</div>
								<div class="col-md-6"><strong>Tgl. Diperiksa</strong>
									<p>27 November 2018</p>
								</div>
							</div>

						</div>
						<div class="row" style="visibility : hidden">
							<div class="demo-container" style="width:1px;height:1px;display:none;">
								<div id="placeholder" class="demo-placeholder"></div>
							</div>
							<div class="flot-chart" style="width:1px;height:1px;display:none;">
								<div class="flot-chart-content" id="flot-line-chart"></div>
							</div>
							<div class="flot-chart" style="width:1px;height:1px;display:none;">
								<div class="flot-chart-content" id="flot-line-chart-moving"></div>
							</div>
							<div class="flot-chart" style="width:1px;height:1px;display:none;">
								<div class="flot-chart-content" id="flot-bar-chart"></div>
							</div>
							<div class="flot-chart" style="width:1px;height:1px;">
								<div class="sales-bars-chart" style="width:1px;height:1px;"> </div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

						</div>
					</div>
				</div>
			</div>


			<!-- .right-sidebar -->
