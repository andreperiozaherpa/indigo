<style type="text/css">
	.posisi tbody tr td {
		width: 100px;
		height: 100px;
		text-align: center;
		vertical-align: middle;
	}
</style>
<div class="container-fluid">

	<div class="row bg-title">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard User</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<?php echo breadcrumb($this->uri->segment_array()); ?>
			</ol>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<div class="col-md-12">
			<?php if ($this->session->userdata('msg') == true) : ?>
				<?= $this->session->userdata('msg'); ?>
			<?php endif; ?>
			<div class="alert alert-primary"><i class="ti-alert"></i> Apabila terdapat kesalahan dalam data informasi pegawai, Anda dapat mengubahnya pada menu <a style="color: white" href="<?= base_url('pengaturan_akun') ?>"><b>Pengaturan Akun</b></a></div>
		</div>
		<div class="col-md-4 col-xs-12">
			<div class="white-box">
				<div class="user-bg"> <img width="100%" height="100%" alt="user" src="<?php echo base_url(); ?>/data/images/header/header2.jpg">
					<div class="overlay-box">
						<div class="user-content" style="padding-top:1px;">
							<a href="javascript:void(0)"><img src="<?php echo $foto_pegawai = (!empty($this->session->userdata('username'))) ? base_url() . "data/foto/pegawai/$foto_pegawai" : $foto_pegawai; ?>" class="thumb-lg img-circle" style=" object-fit: cover;

  width: 75px;
  height: 75px;border-radius: 50%;
  " alt="img"></a>
							<h5 class="text-white"><b><?= $full_name ?></b></h5>
							<h6 class="text-white"><?= isset($user->nip) ? $user->nip : '-' ?></h6>
							<div class="btn-group dropup m-r-10">
								<form method="post" action="<?= base_url('dashboard_user/updateKetersediaan/' . $id_user) ?>">
									<select class="btn btn-<?= $user->warna_ketersediaan ?>" id="ketersediaan" name="ketersediaan" onchange="this.form.submit();">
										<option value="<?= $user->id_ketersediaan ?>" style="background-color:<?= $user->kode_warna_ketersediaan ?>;cursor: pointer;"><?= $user->nama_ketersediaan ?></option>
										<?php foreach ($ketersediaan as $k) : ?>
											<option value="<?= $k->id_ketersediaan ?>" style="background-color:<?= $k->kode_warna_ketersediaan ?>;cursor: pointer;"><?= $k->nama_ketersediaan ?></option>
										<?php endforeach; ?>
									</select>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="user-btm-box">
					<div class="row">
						<div class="col-md-12 b-b text-center">
							<h6><b>SKPD
								</b></h6>
							<h6><?= isset($user->nama_skpd) ? ($user->nama_skpd) : "-"; ?>
							</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 b-r text-center">
							<h6><b>Unit Kerja</b></h6>
							<h6>
								<?= isset($user->nama_unit_kerja) ? ($user->nama_unit_kerja) : "-"; ?>
							</h6>
						</div>
						<div class="col-md-6 text-center">
							<h6><b>Jabatan</b></h6>
							<h6>
								<?= isset($user->jabatan) ? ($user->jabatan) : "-"; ?>
							</h6>
						</div>
					</div>
				</div>
			</div>
			<a href="<?= base_url('pengaturan_akun') ?>" class="btn btn-primary btn-block"><i class="fa fa-cog"></i> Pengaturan Akun</a>
			<a href="<?= base_url('dashboard_user/details_kepegawaian') ?>" class="btn btn-primary btn-block"><i class="fa fa-user"></i> Details Kepegawaian</a>

			<a href="javascript:void(0)" onclick="resToken(<?= $user->id_pegawai ?>)" class="btn btn-warning btn-block"><i class="fa fa-refresh"></i> Reset Login Android</a>


			<!--MODAL SETTING ACCOUNT-->
			<div class="modal fade" id="updateSettingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Ubah Password</h4>
						</div>
						<div class="modal-body">
							<?php echo validation_errors(); ?>
							<form action="<?= base_url('dashboard_user/updatePassword/' . $id_user) ?>" method="post">
								<div class="form-group">
									<label for="recipient-name" class="control-label">Password Lama</label>
									<input type="password" class="form-control" name="old_password" placeholder="masukan password lama anda">
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label">Password Baru</label>
									<input type="password" class="form-control" name="n_password" placeholder="masukan password baru anda">
								</div>
								<div class="form-group">
									<label for="message-text" class="control-label">Konfirmasi Password Baru</label>
									<input type="password" class="form-control" name="cn_password" placeholder="konfirmasi password baru anda">
								</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary" name="tombol_update">Update</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			<!--MODAL END-->
			<br>
			<!-- <div class="white-box" style="border-top:10px solid #6003C8">
				<div class="row b-t">
					<div class="col-md-12 b-b text-center">
						<h6><b>Masa Kerja</b></h6>
						<h6>
							<?php
							$awal = new DateTime(isset($data_by_bkd->tmtcpns) ? $data_by_bkd->tmtcpns : date("Y-m-d"));
							$skrng = new DateTime(date("Y-m-d"));
							$hasil = $skrng->diff($awal);
							$tahun = $hasil->y;
							$bulan = $hasil->m;
							$hari = $hasil->d;
							echo $tahun . ' Tahun ' . $bulan . ' Bulan ' . $hari . ' Hari ';
							?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>TMT CPNS</b></h6>
						<h6>
							<?= isset($data_by_bkd->tmtcpns) ? tanggal($data_by_bkd->tmtcpns) : "-"; ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>TMT PNS</b></h6>
						<h6>
							<?= isset($data_by_bkd->tmtpns) ? tanggal($data_by_bkd->tmtpns) : "-"; ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>NIP</b></h6>
						<h6>
							<?= isset($data_by_bkd->nip) ? $data_by_bkd->nip : "-"; ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Agama</b></h6>
						<h6>
							<?= isset($data_by_bkd->agama) ? $data_by_bkd->agama : "-"; ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Tempat Lahir</b></h6>
						<h6>
							<?= isset($data_by_bkd->temlahir) ? $data_by_bkd->temlahir : "-"; ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Tgl Lahir</b></h6>
						<h6>
							<?= isset($data_by_bkd->tgllahir) ? tanggal($data_by_bkd->tgllahir) : "-"; ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Jenis Kelamin</b></h6>
						<h6>
							<?= isset($data_by_bkd->kelamin) ? $data_by_bkd->kelamin : "-"; ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Pendidikan</b></h6>
						<h6>
							<?= isset($data_by_bkd->pendidikan) ? $data_by_bkd->pendidikan : "-"; ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Pangkat / Golongan</b></h6>
						<h6>
							<?= isset($data_by_bkd->pangkat) ? $data_by_bkd->pangkat : "-"; ?><?= isset($data_by_bkd->gol) ? $data_by_bkd->gol : "-"; ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>TMT Pangkat</b></h6>
						<h6>
							<?= isset($data_by_bkd->tmtpang) ? tanggal($data_by_bkd->tmtpang) : "-"; ?>
						</h6>
					</div>
				</div>
			</div> -->
			
			<br>
			<div class="white-box" style="border-top:10px solid #6003C8">
				<?php
				// if ($talent) {
				// 	$kuadran = get_kuadran($talent->kategori_kompetensi, $talent->kategori_kinerja);
				// } else {
				// 	$kuadran = 0;
				// }
				$get_talent = $this->db->where('nip',$user->nip)->where('tahun',date('Y'))->get('pegawai_talent_simpeg')->row();
				if ($get_talent) {
					$kuadran = $get_talent->posisi_box;
				} else {
					$kuadran = 0;
				}
				$skor_peer = (@$get_talent->skor_peer > 2) ? '<i class="fa fa-thumbs-o-up">' : '<i class="fa fa-thumbs-o-down">';

				$foto_string = '<img src="' . $foto_pegawai . '" class="thumb-lg img-circle" style="width:20px; object-fit: cover;width: 50px;height: 50px;border-radius: 50%;" alt="img">';
				$detail_string = '
				<a class="mytooltip" href="javascript:void(0)" style="color: #6003c8;"> '.$foto_string .' <span class="tooltip-content5" style="width: 600px; Left: -355%; margin: 0 0 30px -98px;"><span class="tooltip-text3" style="background: #f6f3ff; padding: unset; border-bottom: 10px solid #6003c8;"><span class="tooltip-inner2" style="padding: unset">
					<div class="col-xs-6 tooltip-inner2" style="background: #f6f3ff; padding: 10px;">
					<h5>Assestment <span class="pull-right">'. @$get_talent->skor_assestment .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_assestment .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_assestment .'%;"> <span class="sr-only">'. @$get_talent->skor_assestment .'% Complete</span> </div>
					</div>
					<h5>Pendidikan <span class="pull-right">'. @$get_talent->skor_pendidikan .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_pendidikan .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_pendidikan .'%;"> <span class="sr-only">'. @$get_talent->skor_pendidikan .'% Complete</span> </div>
					</div>
					<h5>Pangkat/Golongan <span class="pull-right">'. @$get_talent->skor_masa_kerja .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_masa_kerja .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_masa_kerja .'%;"> <span class="sr-only">'. @$get_talent->skor_masa_kerja .'% Complete</span> </div>
					</div>
					<h5>Jabatan <span class="pull-right">'. @$get_talent->skor_jabatan .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'. @$get_talent->skor_jabatan .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_jabatan .'%;"> <span class="sr-only">'. @$get_talent->skor_jabatan .'% Complete</span> </div>
					</div>
					<h5>Pelatihan <span class="pull-right">'. @$get_talent->skor_pelatihan .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_pelatihan .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_pelatihan .'%;"> <span class="sr-only">'. @$get_talent->skor_pelatihan .'% Complete</span> </div>
					</div>
					</div>
					<div class="col-xs-6 tooltip-inner2" style="background: #f6f3ff; padding: 10px;">
					<h5>PPK PNS <span class="pull-right">'. @$get_talent->skor_ppk_pns .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'. @$get_talent->skor_ppk_pns .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_ppk_pns .'%;"> <span class="sr-only">'. @$get_talent->skor_ppk_pns .'% Complete</span> </div>
					</div>
					<h5>Prestasi <span class="pull-right">'. @$get_talent->skor_prestasi .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'. @$get_talent->skor_prestasi .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_prestasi .'%;"> <span class="sr-only">'. @$get_talent->skor_prestasi .'% Complete</span> </div>
					</div>
					<h5>Penugasan <span class="pull-right">'. @$get_talent->skor_penugasan .'</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="'. @$get_talent->skor_penugasan .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_penugasan .'%;"> <span class="sr-only">'. @$get_talent->skor_penugasan .'% Complete</span> </div>
					</div>
					<h5>Perilaku <span class="pull-right">'. @$get_talent->skor_peer .' '. $skor_peer .' </i></span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_peer .'" aria-valuemin="0" aria-valuemax="5" style="width:'. @$get_talent->skor_peer*20 .'%;"> <span class="sr-only">'. @$get_talent->skor_peer*20 .'% Complete</span> </div>
					</div>
					<h5>Presensi <span class="pull-right">'. @$get_talent->skor_tpp .'%</span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'. @$get_talent->skor_tpp .'" aria-valuemin="0" aria-valuemax="100" style="width:'. @$get_talent->skor_tpp .'%;"> <span class="sr-only">'. @$get_talent->skor_tpp .'% Complete</span> </div>
					</div>
					<h5>Kinerja Harian <span class="pull-right">'. @$get_talent->skor_lkh .' <i class="fa fa-star-o"></i></span></h5>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'. @$get_talent->skor_lkh .'" aria-valuemin="0" aria-valuemax="5" style="width:'. @$get_talent->skor_lkh*20 .'%;"> <span class="sr-only">'. @$get_talent->skor_lkh*20 .'% Complete</span> </div>
					</div>
					</div>
				</span></span></span></a>';
				?>
				<div class="">
					<table class="table table-bordered posisi">
						<tbody>
							<tr>
								<td rowspan="3" style="width:10px"><span style="writing-mode: tb-rl;
        transform: rotate(-180deg);">Kinerja</span></td>
								<td style="background-color:#fad859;color:black;"><b><?= $kuadran == 4 ? $detail_string : 4 ?></b></td>
								<td style="background-color:#049372;color:white;"><b><?= $kuadran == 7 ? $detail_string : 7 ?></b></td>
								<td style="background-color:#1e824c;color:white;"><b><?= $kuadran == 9 ? $detail_string : 9 ?></b></td>
							</tr>
							<tr>
								<td style="background-color:#f03434;color:white;"><b><?= $kuadran == 2 ? $detail_string : 2 ?></b></td>
								<td style="background-color:#fad859;color:black;"><b><?= $kuadran == 5 ? $detail_string : 5 ?></b></td>
								<td style="background-color:#049372;color:white;"><b><?= $kuadran == 8 ? $detail_string : 8 ?></b></td>
							</tr>
							<tr>
								<td style="background-color:#f03434;color:white;"><b><?= $kuadran == 1 ? $detail_string : 1 ?></b></td>
								<td style="background-color:#f03434;color:white;"><b><?= $kuadran == 3 ? $detail_string : 3 ?></b></td>
								<td style="background-color:#fad859;color:black;"><b><?= $kuadran == 6 ? $detail_string : 6 ?></b></td>
							</tr>
							<tr>
								<td style="padding:10px;height:10px" colspan="4">Potensi</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="row b-b b-t">
					<div class="col-md-6 b-r text-center">
						<h6><b>Rumpun</b></h6>
						<h6>
							<?= $pegawai->rumpun ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Pangkat/Gol</b></h6>
						<h6>
							<?= $pegawai->pangkat . " / " . $pegawai->golongan ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Pendidikan</b></h6>
						<h6>
							<?= @$get_talent->nama_tingkatpendidikan ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Eselon</b></h6>
						<h6>
							<?= $pegawai->eselon ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Hasil Asesmen</b></h6>
						<h6>
							<?= @$get_talent->skor_assestment ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Diklat PIM</b></h6>
						<h6>
							<?php if(@$get_talent->diklat =="Tidak"){
								echo "Belum";
							}else {
								echo "Sudah";
							}
							?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-6 b-r text-center">
						<h6><b>Nilai PPKPNS</b></h6>
						<h6>
							<?= !empty(@$get_talent->skor_ppk_pns) ? @$get_talent->skor_ppk_pns : '-' ?>
						</h6>
					</div>
					<div class="col-md-6 text-center">
						<h6><b>Hukuman Disiplin</b></h6>
						<h6>
							<?= ucwords($pegawai->hukuman_disiplin) ?>
						</h6>
					</div>
				</div>
				<div class="row b-b">
					<div class="col-md-12 text-center">
						<h6><b>Masa Kerja Jabatan</b></h6>
						<h6>
							<?= $pegawai->masa_kerja ?> Tahun
						</h6>
					</div>
				</div>
			</div>
			<!-- <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi KGB</b></h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-4 b-r text-center">
                    <h6><b>TMT</b></h6>
                    <h6>
                      01-10-2016
                    </h6>
                  </div>
                  <div class="col-md-4 b-r text-center">
                    <h6><b>Masa Kerja</b></h6>
                    <h6>
                      14-04
                    </h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <h6><b>Gaji Pokok</b></h6>
                    <h6>
                      3.456.200
                    </h6>
                  </div>
                </div>
              </div>
              <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi Kenaikan Pangkat</b></h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Pangkat / Golongan</b></h6>
                    <h6><?= isset($data_by_bkd->pangkat) ? $data_by_bkd->pangkat : "-"; ?><?= isset($data_by_bkd->gol) ? $data_by_bkd->gol : "-"; ?></h6>
                  </div>
                </div>
                <div class="row b-b">
                  <div class="col-md-4 b-r text-center">
                    <h6><b>TMT</b></h6>
                    <h6>
                      01-10-2016
                    </h6>
                  </div>
                  <div class="col-md-4 b-r text-center">
                    <h6><b>Masa Kerja</b></h6>
                    <h6>
                      14-04
                    </h6>
                  </div>
                  <div class="col-md-4 text-center">
                    <h6><b>Gaji Pokok</b></h6>
                    <h6>
                      3.456.200
                    </h6>
                  </div>
                </div>
              </div>
              <div class="white-box" style="border-top:10px solid #6003C8">
                <div class="row b-t">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>Prediksi Kenaikan Pangkat</b></h6>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 b-b text-center">
                    <h6><b>TMT</b></h6>
                    <h6>01-02-2031</h6>
                  </div>
                </div>
              </div>
              <a href="#" class="btn btn-primary btn-block disabled">Update Profile Kepegawaian</a> -->
		</div>
		<div class="col-md-8 col-xs-12">
			<div class="row">
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Kotak Masuk</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-envelope-o text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= $total_surat_masuk ?> </span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Agenda</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-calendar text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;">
									<?= $total_agenda; ?>
								</span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Catatan</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-bell-o text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= $total_catatan ?></span>
							</li>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="white-box">
						<h6 class="box-title">Kegiatan</h6>
						<ul class="list-inline two-part">
							<li><i class="fa fa-bookmark text-primary" style="font-size:25px;"></i>
							<li class="text-right">
								<span class="counter" style="font-size:25px;"><?= count($kegiatan_personal); ?></span>
							</li>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
			// if (isset($_GET['testing'])) {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="white-box">
						<h3 class="box-title">Tambahan Penghasilan Pegawai</h3>
						<div class="row">
							<div class="col-md-6 b-r">
								<?php
								$tpp['utuh_bulan_lalu'] = !empty($tpp_pegawai['tpp']) ? $tpp_pegawai['tpp'] : 0;
								if ($tpp['utuh_bulan_lalu'] == 0) {
									$tpp['bulan_lalu'] = 0;
									$tpp['persentase_bl'] = 0;
								} else {
									$tpp['pengurangan_bl'] = $this->tpp_perhitungan_model->get_potongan($pegawai->id_pegawai, date('m') - 1, $tahun_sekarang);
									$pengurangan_bl = !empty($tpp['pengurangan_bl']) ? $tpp['pengurangan_bl']->jml_potongan : 0;
									$tpp['bulan_lalu'] = ($tpp['utuh_bulan_lalu'] - $pengurangan_bl);
									$tpp['persentase_bl'] = round($tpp['bulan_lalu']  / $tpp['utuh_bulan_lalu'] * 100, 2);
								}

								?>
								<center><i class="ti-calendar"></i> Bulan <?= bulan(date('m') - 1) ?></center>
								<b> <?= rupiah($tpp['bulan_lalu']) ?></b>
								<div class="pull-right"><small><?= $tpp['persentase_bl'] ?>%</small></div>
								<div class="progress">
									<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $tpp['persentase_bl'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $tpp['persentase_bl'] ?>%"> <span class="sr-only"><?= $tpp['persentase_bl'] ?>% Complete</span></div>
								</div>
								<?php
								if (isset($_GET['testing'])) {
								?>
									<div class="pull-right" style="margin-top:-10px"><a href="javascript:void(0)" onclick="showLogTPP(<?= date('m') - 1 ?>,<?= $tahun_sekarang ?>)" class="text-purple" style="font-size: 12px;">Lihat Detail TPP</a></div>
								<?php
								} else {
								?>
									<div class="pull-right" style="margin-top:-10px"><a href="javascript:void(0)" onclick="return swal('Dalam Proses')" class="text-purple" style="font-size: 12px;">Lihat Detail TPP</a></div>
								<?php
								}
								?>
							</div>
							<div class="col-md-6">
								<?php
								$tpp['utuh_bulan_ini'] = !empty($tpp_pegawai['tpp']) ? $tpp_pegawai['tpp'] : 0;
								if ($tpp['utuh_bulan_ini'] == 0) {
									$tpp['bulan_ini'] = 0;
									$tpp['persentase_bi'] = 0;
								} else {
									$tpp['pengurangan_bi'] = $this->tpp_perhitungan_model->get_potongan($pegawai->id_pegawai, date('m'), $tahun_sekarang);
									$pengurangan_bi = !empty($tpp['pengurangan_bi']) ? $tpp['pengurangan_bi']->jml_potongan : 0;
									$tpp['bulan_ini'] = ($tpp['utuh_bulan_ini'] - $pengurangan_bi);
									$tpp['persentase_bi'] = round($tpp['bulan_ini']  / $tpp['utuh_bulan_ini'] * 100, 2);
								}

								?>
								<center><i class="ti-calendar"></i> Bulan <?= bulan(date('m')) ?></center>
								<b> <?= rupiah($tpp['bulan_ini']) ?></b>
								<div class="pull-right"><small><?= $tpp['persentase_bi'] ?>%</small></div>
								<div class="progress">
									<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?= $tpp['persentase_bi'] ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $tpp['persentase_bi'] ?>%"> <span class="sr-only"><?= $tpp['persentase_bi'] ?>% Complete</span></div>
								</div>
								<div class="pull-right" style="margin-top:-10px"><a href="javascript:void(0)" onclick="return swal('Dalam Proses')" class="text-purple" style="font-size: 12px;">Lihat Detail TPP</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			// }
			?>
			<?php if ($pengumuman == true) : ?>
				<div class="row">
					<div class="m-b-15" style="background-color:#A3A0FB;">
						<div id="myCarouse2" class="carousel vcarousel slide p-20">
							<!-- Carousel items -->
							<div class="carousel-inner ">
								<?php
								$no = 1;
								$item_class = 'active ';
								foreach ($pengumuman as $png) :
								?>
									<div class="<?= $item_class ?>item">
										<p style="color:#FFED00"><span class="fa fa-bell"></span> Informasi / Pengumuman Hari Ini <small class="pull-right" style="color:white"><?= $no ?> / <?= count($pengumuman) ?></small></p>
										<p class="text-center" style="color:white;">" <?= $png->isi ?> "</p>
										<i class="text-right" style="color:white;"><small> Oleh : <?= $png->nama_lengkap ?></small></i>
									</div>
								<?php
									$item_class = '';
									$no++;
								endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

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
				<div class="col-md-7 hidden">
					<div class="white-box" style="min-height:300px;">
						<div class="row b-b">
							Data capaian perjanjian kinerja
						</div>
						<br>
						<?php
						if ($iku_ss == null && $iku_sp == null && $iku_sk == null) {
							echo "Belum ada data";
						} else {
							$i = 1;
							foreach ($iku_ss as $ss) { ?>
								<div class="row">
									<small>Indikator
										<?$i?> : <?= $ss->iku_ss_renstra ?> </small>
									<div class="pull-right"><?= $ss->capaian; //get_capaian($ss->target_ss_renja, $realisasi_by_pegawai, $ss->polorarisasi);
															?>%</div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= $ss->capaian; //get_capaian($ss->target_ss_renja, $realisasi_by_pegawai, $ss->polorarisasi);
																																												?>%;"> <span class="sr-only">48% Complete</span></div>
									</div>
								</div>
							<?php $i++;
							} ?>
							<?php
							$i = 1;
							foreach ($iku_sp as $sp) { ?>
								<div class="row">
									<small>Indikator
										<?$i?> : <?= $sp->iku_sp_renstra ?> </small>
									<div class="pull-right"><?= $sp->capaian; //get_capaian($sp->target_sp_renja, $realisasi_by_pegawai, $sp->polorarisasi);
															?>%</div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= $sp->capaian; //get_capaian($sp->target_sp_renja, $realisasi_by_pegawai, $sp->polorarisasi);
																																												?>%;"> <span class="sr-only">48% Complete</span></div>
									</div>
								</div>
							<?php $i++;
							} ?>
							<?php
							$i = 1;
							foreach ($iku_sk as $sk) { ?>
								<div class="row">
									<small>Indikator
										<?$i?> : <?= $sk->iku_sk_renstra ?> </small>
									<div class="pull-right"><?= $sk->capaian; //get_capaian($sk->target_sk_renja, $realisasi_by_pegawai, $sk->polorarisasi);
															?>%</div>
									<div class="progress">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= $sk->capaian; //get_capaian($sk->target_sk_renja, $realisasi_by_pegawai, $sk->polorarisasi);
																																												?>%;"> <span class="sr-only">48% Complete</span></div>
									</div>
								</div>
							<?php $i++;
							} ?>
							<a href="#" class="pull-right"><small>Lihat Semuanya</small> </a>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-7">
					<div class="white-box" style="min-height:300px;">
						<div class="row b-b">
							Data capaian perjanjian kinerja
						</div>
						<br>
						
                        <div class="table-responsive">
                            <table style="" class="table table-striped_">
                                <thead>
                                    <tr>
                                        <!-- <th>No</th> -->
                                        <th>Hasil Kerja</th>
                                        <th>Rencana Aksi</th>
                                        <th>Capaian (%)</th>
                                        <!-- <th width="120px">Bukti Dukung</th> -->
                                    </tr>
                                </thead>
                                <tbody id="row-data">
                                    
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<div class="white-box" style="height:609px;">
							<div class="row b-b">
								Daftar Kegiatan Personal
								<a href="<?= base_url() ?>/kegiatan_personal" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<br>
							<ul class="list-task list-group" data-role="tasklist">
								<?php if ($kegiatan_personal == true) : ?>
									<?php
									$i = 0;
									foreach ($kegiatan_personal as $keg) : ?>
										<li class="list-group-item" data-role="task">
										<li class="list-group-item" data-role="task">
											<?php
											if ($keg->status_kegiatan != "SELESAI DIVERIFIKASI") {
											?>
												<i class="fa fa-calendar-o" style="font-size:20px;color:red"></i>
												<b> <span><?= $keg->nama_kegiatan; ?> </span> </b>
											<?php
											} else {
											?>
												<i class="fa fa-calendar-check-o" style="font-size:20px;color:blue"></i>
												<b> <span><a href="<?= base_url() ?>/kegiatan_personal/detail_kegiatan/<?= $user_id ?>/<?= $keg->id_kegiatan_personal ?>" target="_blank" style="color:#4f5467"><?= $keg->nama_kegiatan; ?></a> </span></b>
											<?php
											}
											?>
											<?php
											$warna = "danger";
											if ($keg->status_kegiatan == "BELUM DIKERJAKAN") {
												$nilai = 0;
											} elseif ($keg->status_kegiatan == "MENUNGGU VERIFIKASI") {
												$nilai = 50;
											} elseif ($keg->status_kegiatan == "SELESAI DIVERIFIKASI") {
												$warna = "primary";
												$nilai = 100;
											}
											?>
											<div class="pull-right"><small><?= $nilai; ?>%</small></div>
											<div class="progress">
												<div class="progress-bar progress-bar-<?= $warna ?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?= $nilai ?>%"> <span class="sr-only">52% Complete</span></div>
											</div>
										</li>
									<?php
										if (++$i == 7) break;
									endforeach; ?>
								<?php else : ?>
									<li class="list-group-item" data-role="task" style="margin-top:-5px">
										<small>BELUM ADA KEGIATAN YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('realisasi_kegiatan'); ?> ">Lihat Kegiatan</a> </span></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-md-7" style="height:609px;overflow:hidden;">
						<div class="white-box">
							<div class="row b-b">
								Log Aktivitas
								<a href="<?= base_url('logs') ?>" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<br>
							<div class="steamline">
								<?php
								foreach ($logs as $l) {
								?>
									<div class="sl-item">
										<div class="sl-left"> <img class="img-circle" alt="user" src="<?= base_url() . 'data/foto/pegawai/' . $l->user_picture ?>"> </div>
										<div class="sl-right">
											<div><a href="#"><?= $l->full_name ?></a></div>
											<p style="margin: 0;padding: 0;line-height: 2"><?= $l->activity ?>
											</p>
											<span class="sl-date"><?php
																	$e = explode(' ', $l->time);
																	$date = tanggal($e[0]);
																	$t = stime($e[1]);
																	echo $date . ' ' . $t;
																	?></span>
										</div>
									</div>
								<?php } ?>
								<hr>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-5">
						<div class="white-box" style="min-height:290px">
							<div class="row b-b">
								Agenda Pribadi
								<a href="<?= base_url() ?>/agenda_pribadi" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<ul class="feeds" style="padding-top:10px;">
								<?php if ($agenda_pribadi == true) {
									$i = 0;
									foreach ($agenda_pribadi as $ap) {
										$start = new DateTime(date("Y-m-d"));
										$end = new DateTime($ap->start_date);
										$interval = $start->diff($end);
										$hrs = $interval->d;
										if ($start <= $end) {
											if (count($ap->id) >= 1) {
												if ($ap == true) {
													if (++$i == 4) break;
													if ($hrs == 0) : ?>
														<li style="margin-top:-5px">
															<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $ap->title ?> <span class="text-muted">Hari ini </span>
														</li>
														<li style="margin-top:-5px">
														<?php elseif ($hrs >= 1) : ?>
														<li style="margin-top:-5px">
															<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $ap->title ?> <span class="text-muted"><?= $hrs . " Hari lagi"; ?> </span>
														</li>
														<li style="margin-top:-5px">
														<?php endif; ?>
										<?php  }
											}
										}
									}
								} else { ?>
														<li style="margin-top:-5px">
															<small>BELUM ADA AGENDA YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('agenda_pribadi'); ?> ">Lihat Agenda</a> </span></li>
														<li style="margin-top:-5px">
														<?php	 }  ?>
							</ul>
						</div>
					</div>
					<div class="col-md-7">
						<div class="white-box" style="min-height:290px">
							<div class="row b-b">
								Agenda Umum
								<a href="<?= base_url() ?>/agenda_umum" class="pull-right"><small style="font-size:10px">Lihat Semuanya</small> </a>
							</div>
							<ul class="feeds" style="padding-top:10px;">
								<?php if ($agenda_umum == true) : ?>
									<?php
									$i = 0;
									foreach ($agenda_umum as $au) { ?>
										<?php
										$start = new DateTime(date("Y-m-d"));
										$end = new DateTime($au->start_date);
										$interval = $start->diff($end);
										$hrs = $interval->d;
										?>
										<?php if ($start <= $end) :
											if (++$i == 4) break;
										?>
											<?php if ($hrs == 0) : ?>
												<li style="margin-top:-5px">
													<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div><?= $au->title ?><span class="text-muted">Hari ini </span><span class="pull-right" style="margin-top:30px;"><small>Oleh </small><i><?= $au->nama_lengkap ?></i></span>
												</li>
												<li style="margin-top:-5px">
												<?php elseif ($hrs >= 1) : ?>
												<li style="margin-top:-5px">
													<div class="bg-info"><i class="fa fa-bell-o text-white"></i></div> <?= $au->title ?> <span class="text-muted"><?= $hrs . " Hari lagi"; ?> </span>
													<h6 class="pull-right" style="margin-top:30px;"><small>Oleh </small><i><?= $au->nama_lengkap ?></i></h6>
												</li>
												<li style="margin-top:-5px">
												<?php endif; ?>
											<?php endif; ?>
										<?php }  ?>
									<?php else : ?>
												<li style="margin-top:-5px">
													<small>BELUM ADA AGENDA YANG AKAN DATANG</small> <span class="text-muted"><a href="<?php echo base_url('agenda_umum'); ?> ">Lihat Agenda</a> </span></li>
												<li style="margin-top:-5px">
												<?php endif; ?>

							</ul>
						</div>

					</div>
				</div>
				<div class="row" style="visibility : hidden">
					<div class="demo-container" style="height:1px;display:none;">
						<div id="placeholder" class="demo-placeholder"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-line-chart"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-line-chart-moving"></div>
					</div>
					<div class="flot-chart" style="height:1px;display:none;">
						<div class="flot-chart-content" id="flot-bar-chart"></div>
					</div>
					<div class="flot-chart" style="height:1px;">
						<div class="sales-bars-chart" style="height:1px;"> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>

		<div id="modalLogTPP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Detail Log TPP</h4>
					</div>
					<div class="modal-body">
						<h4>Overflowing text to show scroll behavior</h4>
						<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
						<p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

		<!-- /.row -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() . "asset/chartjs-plugin-labels/"; ?>src/chartjs-plugin-labels.js"></script>
		<script>
			function resToken(id) {
				swal({
						title: "Reset Token",
						text: "Apakah anda yakin akan mereset token akun ini?",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: '#DD6B55',
						confirmButtonText: 'Ya',
						cancelButtonText: "Tidak",
						closeOnConfirm: false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								url: "<?= base_url('dashboard_user/reset_token') ?>/" + id,
								type: "POST",
								dataType: "JSON",
								success: function(data) {
									$('#modalMisi').modal('hide');
									swal("Berhasil", "Token berhasil direset!", "success");
									location.reload();
								},
								error: function(jqXHR, textStatus, errorThrown) {
									alert('Error deleting data');
								}
							});
						}
					});
			}

			function showLogTPP(bulan, tahun) {
				$('#modalLogTPP').modal('show');
			}


			function getData()
			{
				isloading = false;
				$.ajax({
					url: "<?=base_url()?>kinerja/dokumentasi/get_data/",
					type: 'post',
					dataType: 'json',
					data: {
						tahun: "<?=date('Y') - 2018?>",
						bulan: "<?=date('n')?>",
						id_pegawai: "<?=$this->session->userdata('id_pegawai')?>"
					},
					success: function (data) {
						console.log(data);
						$("#row-data").html(data.content);
						isloading = false;
					},
					error: function (xhr, status, error) {
						console.log(xhr.responseText);
						swal("Opps", "Terjadi kesalahan", "error");
						isloading = false;
					}
				});
			}
			getData();
		</script>